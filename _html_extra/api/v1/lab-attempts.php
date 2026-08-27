<?php
declare(strict_types=1);

require_once __DIR__ . '/../lib/quiz-app.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

set_exception_handler(static function (Throwable $exception): void {
    error_log('DSM lab API error: ' . $exception->getMessage());
    http_response_code(500);
    echo json_encode([
        'ok' => false,
        'error' => 'server_error',
        'message' => $exception->getMessage(),
    ], JSON_UNESCAPED_SLASHES);
    exit;
});

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(405, ['ok' => false, 'error' => 'method_not_allowed']);
}

$input = json_decode((string) file_get_contents('php://input'), true);
if (!is_array($input)) {
    respond(400, ['ok' => false, 'error' => 'invalid_json']);
}

$labId = sanitize_key((string) ($input['lab_id'] ?? ''));
$lab = dsm_lab_definition($labId);
if ($lab === null) {
    respond(404, ['ok' => false, 'error' => 'unknown_lab']);
}

$config = dsm_load_config();
$pdo = dsm_database_ready($config);
$studentUser = dsm_current_student_user($pdo, $config);

$code = $input['code'] ?? null;
$answers = $input['answers'] ?? null;
if (is_array($code)) {
    $graded = dsm_grade_lab_code_attempt($lab, $code, $config['lab_grader'] ?? []);
} elseif (is_array($answers)) {
    $graded = dsm_grade_lab_attempt($lab, $answers);
} else {
    respond(400, ['ok' => false, 'error' => 'code_required']);
}

if (dsm_submission_auth_required($config) && $studentUser === null) {
    respond(401, [
        'ok' => false,
        'error' => 'login_required',
        'message' => 'Please sign in before submitting this assignment.',
    ]);
}

$identity = [
    'student_user_id' => is_array($studentUser) ? ($studentUser['student_user_id'] ?? null) : null,
    'canvas_course_id' => nullable_string($input['canvas_course_id'] ?? null, 64),
    'canvas_assignment_id' => nullable_string($input['canvas_assignment_id'] ?? null, 64),
    'canvas_user_id' => nullable_string($studentUser['canvas_user_id'] ?? $input['canvas_user_id'] ?? null, 64),
    'student_identifier' => nullable_string($studentUser['student_identifier'] ?? $input['student_identifier'] ?? null, 255),
    'lti_deployment_id' => nullable_string($studentUser['lti_deployment_id'] ?? null, 255),
    'lti_context_id' => nullable_string($studentUser['lti_context_id'] ?? null, 255),
    'lti_resource_link_id' => nullable_string($studentUser['lti_resource_link_id'] ?? null, 255),
    'lti_lineitem_url' => nullable_string($studentUser['lti_lineitem_url'] ?? null, 2048),
];

$sync = [
    'status' => 'pending',
    'error' => null,
    'synced_at' => null,
];

if (dsm_canvas_ready($config, $identity)) {
    try {
        if (dsm_is_score_at_least_best($pdo, $labId, $identity, (float) $graded['score'])) {
            $sync = dsm_sync_canvas_grade($config['canvas'], $identity, (string) $graded['score']);
        } else {
            $sync = [
                'status' => 'skipped',
                'error' => 'Lower than the student\'s highest attempt for this assignment.',
                'synced_at' => null,
            ];
        }
    } catch (Throwable $exception) {
        error_log('DSM lab best-score check failed before Canvas sync: ' . $exception->getMessage());
        $sync = dsm_sync_canvas_grade($config['canvas'], $identity, (string) $graded['score']);
    }
}

$attemptId = dsm_save_attempt_record($config, [
    'quiz_id' => $labId,
    'chapter' => $lab['chapter'],
    'assignment_slug' => $lab['assignment_slug'],
    'student_user_id' => $identity['student_user_id'],
    'score' => $graded['score'],
    'max_score' => $graded['max_score'],
    'answers_json' => json_encode($graded['answers'], JSON_UNESCAPED_SLASHES),
    'feedback_json' => json_encode($graded['feedback'], JSON_UNESCAPED_SLASHES),
    'canvas_course_id' => $identity['canvas_course_id'],
    'canvas_assignment_id' => $identity['canvas_assignment_id'],
    'canvas_user_id' => $identity['canvas_user_id'],
    'lti_deployment_id' => $identity['lti_deployment_id'],
    'lti_context_id' => $identity['lti_context_id'],
    'lti_resource_link_id' => $identity['lti_resource_link_id'],
    'lti_lineitem_url' => $identity['lti_lineitem_url'],
    'student_identifier' => $identity['student_identifier'],
    'canvas_sync_status' => $sync['status'],
    'canvas_sync_error' => $sync['error'],
    'synced_to_canvas_at' => $sync['synced_at'],
    'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
]);

$attemptSummary = ['attempt_count' => null, 'best_score' => null];
try {
    $attemptSummary = dsm_attempt_summary($pdo, $labId, $identity);
} catch (Throwable $exception) {
    error_log('DSM lab attempt summary failed: ' . $exception->getMessage());
}

respond(200, [
    'ok' => true,
    'attempt_id' => $attemptId,
    'lab_id' => $labId,
    'score' => $graded['score'],
    'max_score' => $graded['max_score'],
    'attempt_count' => $attemptSummary['attempt_count'],
    'best_score' => $attemptSummary['best_score'],
    'feedback' => $graded['feedback'],
    'canvas_sync_status' => $sync['status'],
]);

function respond(int $status, array $payload): never
{
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_SLASHES);
    exit;
}

function sanitize_key(string $value): string
{
    return preg_replace('/[^a-zA-Z0-9_.-]/', '', $value) ?? '';
}

function nullable_string(mixed $value, int $maxLength): ?string
{
    if ($value === null) {
        return null;
    }
    $value = trim((string) $value);
    if ($value === '') {
        return null;
    }
    return substr($value, 0, $maxLength);
}
