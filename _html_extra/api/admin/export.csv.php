<?php
declare(strict_types=1);

require_once __DIR__ . '/../lib/quiz-app.php';

$config = dsm_load_config();
$pdo = dsm_database_ready($config);
dsm_start_admin_session($config);

if (dsm_current_admin($pdo) === null) {
    http_response_code(403);
    exit('Forbidden');
}

header('Content-Type: text/csv; charset=utf-8');
header('Cache-Control: no-store');
header('Content-Disposition: attachment; filename="dsm_assignment_scores.csv"');

$out = fopen('php://output', 'w');
fputcsv($out, [
    'submitted_at',
    'student_identifier',
    'canvas_user_id',
    'quiz_id',
    'chapter',
    'assignment_slug',
    'score',
    'max_score',
    'canvas_sync_status',
    'synced_to_canvas_at',
    'answers_json',
    'q1',
    'q2',
    'q3',
    'q4',
    'q5',
    'q6',
    'q7',
    'q8',
    'q9',
    'q10',
    'q11',
    'q12',
]);

foreach (dsm_list_attempts($pdo, 10000) as $attempt) {
    $answers = json_decode((string) $attempt['answers_json'], true);
    if (!is_array($answers)) {
        $answers = [];
    }

    fputcsv($out, [
        $attempt['submitted_at'] ?? '',
        $attempt['student_identifier'] ?? '',
        $attempt['canvas_user_id'] ?? '',
        $attempt['quiz_id'] ?? '',
        $attempt['chapter'] ?? '',
        $attempt['assignment_slug'] ?? '',
        $attempt['score'] ?? '',
        $attempt['max_score'] ?? '',
        $attempt['canvas_sync_status'] ?? '',
        $attempt['synced_to_canvas_at'] ?? '',
        $attempt['answers_json'] ?? '',
        $answers['q1'] ?? '',
        $answers['q2'] ?? '',
        $answers['q3'] ?? '',
        $answers['q4'] ?? '',
        $answers['q5'] ?? '',
        $answers['q6'] ?? '',
        $answers['q7'] ?? '',
        $answers['q8'] ?? '',
        $answers['q9'] ?? '',
        $answers['q10'] ?? '',
        $answers['q11'] ?? '',
        $answers['q12'] ?? '',
    ]);
}
