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

$quizId = sanitize_canvas_export_key((string) ($_GET['quiz_id'] ?? 'ch01-preview'));
$quiz = dsm_assignment_definition($quizId);
if ($quiz === null) {
    http_response_code(404);
    exit('Unknown assignment');
}

$assignmentColumn = sanitize_canvas_assignment_column(
    (string) ($_GET['assignment_column'] ?? ($quiz['canvas_assignment_column'] ?? 'preview_ch01'))
);
$filename = sanitize_canvas_export_key($quizId) . '-canvas-gradebook.csv';

header('Content-Type: text/csv; charset=utf-8');
header('Cache-Control: no-store');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$out = fopen('php://output', 'w');
fputcsv($out, ['Student', 'ID', 'SIS User ID', 'SIS Login ID', 'Section', $assignmentColumn]);
fputcsv($out, ['Points Possible', '', '', '', '', dsm_canvas_score_value($quiz['max_score'] ?? 10)]);

foreach (dsm_best_attempts_by_identifier($pdo, $quizId) as $attempt) {
    $studentIdentifier = (string) ($attempt['student_identifier'] ?? '');
    if (!dsm_is_canvas_sis_login_id($studentIdentifier)) {
        continue;
    }

    fputcsv($out, [
        '',
        '',
        '',
        $studentIdentifier,
        '',
        dsm_canvas_score_value($attempt['score'] ?? ''),
    ]);
}

function dsm_best_attempts_by_identifier(PDO $pdo, string $quizId): array
{
    $stmt = $pdo->prepare(
        'SELECT qa.student_identifier, qa.score, qa.submitted_at, qa.id
         FROM quiz_attempts qa
         INNER JOIN (
             SELECT student_identifier, MAX(score) AS best_score
             FROM quiz_attempts
             WHERE quiz_id = :quiz_id_best
               AND student_identifier IS NOT NULL
               AND student_identifier <> \'\'
             GROUP BY student_identifier
         ) best ON best.student_identifier = qa.student_identifier
              AND best.best_score = qa.score
         INNER JOIN (
             SELECT student_identifier, score, MAX(id) AS best_id
             FROM quiz_attempts
             WHERE quiz_id = :quiz_id_tie
               AND student_identifier IS NOT NULL
               AND student_identifier <> \'\'
             GROUP BY student_identifier, score
         ) tie ON tie.best_id = qa.id
              AND tie.student_identifier = qa.student_identifier
              AND tie.score = qa.score
         WHERE qa.quiz_id = :quiz_id
         ORDER BY qa.student_identifier ASC'
    );
    $stmt->execute([
        'quiz_id_best' => $quizId,
        'quiz_id_tie' => $quizId,
        'quiz_id' => $quizId,
    ]);
    return $stmt->fetchAll();
}

function dsm_canvas_score_value(mixed $value): string
{
    if ($value === null || $value === '') {
        return '';
    }
    $number = (float) $value;
    if (abs($number - round($number)) < 0.001) {
        return (string) (int) round($number);
    }
    return rtrim(rtrim(number_format($number, 2, '.', ''), '0'), '.');
}

function dsm_is_canvas_sis_login_id(string $value): bool
{
    return preg_match('/^[a-zA-Z0-9._-]{2,64}$/', $value) === 1;
}

function sanitize_canvas_export_key(string $value): string
{
    return preg_replace('/[^a-zA-Z0-9_.-]/', '', $value) ?? '';
}

function sanitize_canvas_assignment_column(string $value): string
{
    $value = trim($value);
    if ($value === '') {
        return 'preview_ch01';
    }
    return str_replace(["\r", "\n"], ' ', $value);
}
