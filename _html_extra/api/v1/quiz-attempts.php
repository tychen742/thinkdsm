<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

set_exception_handler(static function (Throwable $exception): void {
    error_log('DSM quiz API error: ' . $exception->getMessage());
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

$quizId = sanitize_key((string) ($input['quiz_id'] ?? ''));
$quiz = quiz_definition($quizId);
if ($quiz === null) {
    respond(404, ['ok' => false, 'error' => 'unknown_quiz']);
}

$answers = $input['answers'] ?? null;
if (!is_array($answers)) {
    respond(400, ['ok' => false, 'error' => 'answers_required']);
}

$graded = grade_attempt($quiz, $answers);
$config = load_config();
$pdo = connect_database($config['database']);
initialize_schema($pdo);

$identity = [
    'canvas_course_id' => nullable_string($input['canvas_course_id'] ?? null, 64),
    'canvas_assignment_id' => nullable_string($input['canvas_assignment_id'] ?? null, 64),
    'canvas_user_id' => nullable_string($input['canvas_user_id'] ?? null, 64),
    'student_identifier' => nullable_string($input['student_identifier'] ?? null, 255),
];

$sync = [
    'status' => 'pending',
    'error' => null,
    'synced_at' => null,
];

if (canvas_ready($config, $identity)) {
    $sync = sync_canvas_grade($config['canvas'], $identity, (string) $graded['score']);
}

$attemptId = save_attempt($pdo, [
    'quiz_id' => $quizId,
    'chapter' => $quiz['chapter'],
    'assignment_slug' => $quiz['assignment_slug'],
    'score' => $graded['score'],
    'max_score' => $graded['max_score'],
    'answers_json' => json_encode($graded['answers'], JSON_UNESCAPED_SLASHES),
    'feedback_json' => json_encode($graded['feedback'], JSON_UNESCAPED_SLASHES),
    'canvas_course_id' => $identity['canvas_course_id'],
    'canvas_assignment_id' => $identity['canvas_assignment_id'],
    'canvas_user_id' => $identity['canvas_user_id'],
    'student_identifier' => $identity['student_identifier'],
    'canvas_sync_status' => $sync['status'],
    'canvas_sync_error' => $sync['error'],
    'synced_to_canvas_at' => $sync['synced_at'],
    'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
]);

respond(200, [
    'ok' => true,
    'attempt_id' => $attemptId,
    'quiz_id' => $quizId,
    'score' => $graded['score'],
    'max_score' => $graded['max_score'],
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

function quiz_definition(string $quizId): ?array
{
    $quizzes = [
        'ch01-preview' => [
            'chapter' => '01-intro',
            'assignment_slug' => 'preview',
            'questions' => [
                'q1' => 'A',
                'q2' => 'B',
                'q3' => 'A',
                'q4' => 'B',
                'q5' => 'C',
                'q6' => 'A',
                'q7' => 'B',
                'q8' => 'A',
                'q9' => 'A',
                'q10' => 'C',
                'q11' => 'A',
                'q12' => 'B',
            ],
        ],
    ];

    return $quizzes[$quizId] ?? null;
}

function grade_attempt(array $quiz, array $answers): array
{
    $feedback = [];
    $normalizedAnswers = [];
    $score = 0;

    foreach ($quiz['questions'] as $questionKey => $correctAnswer) {
        $submitted = strtoupper(trim((string) ($answers[$questionKey] ?? '')));
        $isCorrect = $submitted === $correctAnswer;
        if ($isCorrect) {
            $score++;
        }

        $normalizedAnswers[$questionKey] = $submitted !== '' ? $submitted : null;
        $feedback[$questionKey] = [
            'correct' => $isCorrect,
            'submitted' => $submitted !== '' ? $submitted : null,
            'correct_answer' => $correctAnswer,
        ];
    }

    return [
        'score' => $score,
        'max_score' => count($quiz['questions']),
        'answers' => $normalizedAnswers,
        'feedback' => $feedback,
    ];
}

function load_config(): array
{
    $default = [
        'database' => [
            'driver' => 'sqlite',
            'dsn' => 'sqlite:/tmp/dsm_quiz_attempts.sqlite',
            'username' => null,
            'password' => null,
        ],
        'canvas' => [
            'enabled' => false,
            'base_url' => null,
            'access_token' => null,
        ],
    ];

    $paths = [];
    $envPath = getenv('DSM_QUIZ_CONFIG');
    if (is_string($envPath) && $envPath !== '') {
        $paths[] = $envPath;
    }
    $paths[] = '/var/www/dsm_private/quiz_config.php';

    foreach ($paths as $path) {
        if (is_readable($path)) {
            $loaded = require $path;
            if (is_array($loaded)) {
                return array_replace_recursive($default, $loaded);
            }
        }
    }

    return $default;
}

function connect_database(array $database): PDO
{
    $pdo = new PDO(
        (string) $database['dsn'],
        $database['username'] ?? null,
        $database['password'] ?? null,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
    return $pdo;
}

function initialize_schema(PDO $pdo): void
{
    $driver = (string) $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    $idColumn = $driver === 'sqlite'
        ? 'id INTEGER PRIMARY KEY AUTOINCREMENT'
        : 'id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY';

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS quiz_attempts (
            ' . $idColumn . ',
            quiz_id VARCHAR(100) NOT NULL,
            chapter VARCHAR(100) NOT NULL,
            assignment_slug VARCHAR(100) NOT NULL,
            canvas_course_id VARCHAR(64) NULL,
            canvas_assignment_id VARCHAR(64) NULL,
            canvas_user_id VARCHAR(64) NULL,
            student_identifier VARCHAR(255) NULL,
            score INTEGER NOT NULL,
            max_score INTEGER NOT NULL,
            answers_json TEXT NOT NULL,
            feedback_json TEXT NOT NULL,
            canvas_sync_status VARCHAR(32) NOT NULL DEFAULT \'pending\',
            canvas_sync_error TEXT NULL,
            synced_to_canvas_at DATETIME NULL,
            ip_address VARCHAR(64) NULL,
            user_agent TEXT NULL,
            submitted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        )'
    );
}

function save_attempt(PDO $pdo, array $attempt): int
{
    $sql = 'INSERT INTO quiz_attempts (
        quiz_id, chapter, assignment_slug, canvas_course_id, canvas_assignment_id,
        canvas_user_id, student_identifier, score, max_score, answers_json, feedback_json,
        canvas_sync_status, canvas_sync_error, synced_to_canvas_at, ip_address, user_agent
    ) VALUES (
        :quiz_id, :chapter, :assignment_slug, :canvas_course_id, :canvas_assignment_id,
        :canvas_user_id, :student_identifier, :score, :max_score, :answers_json, :feedback_json,
        :canvas_sync_status, :canvas_sync_error, :synced_to_canvas_at, :ip_address, :user_agent
    )';

    $stmt = $pdo->prepare($sql);
    $stmt->execute($attempt);
    return (int) $pdo->lastInsertId();
}

function canvas_ready(array $config, array $identity): bool
{
    return !empty($config['canvas']['enabled'])
        && !empty($config['canvas']['base_url'])
        && !empty($config['canvas']['access_token'])
        && !empty($identity['canvas_course_id'])
        && !empty($identity['canvas_assignment_id'])
        && !empty($identity['canvas_user_id']);
}

function sync_canvas_grade(array $canvas, array $identity, string $postedGrade): array
{
    $baseUrl = rtrim((string) $canvas['base_url'], '/');
    $path = sprintf(
        '/api/v1/courses/%s/assignments/%s/submissions/%s',
        rawurlencode((string) $identity['canvas_course_id']),
        rawurlencode((string) $identity['canvas_assignment_id']),
        rawurlencode((string) $identity['canvas_user_id'])
    );

    $ch = curl_init($baseUrl . $path);
    curl_setopt_array($ch, [
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $canvas['access_token'],
        ],
        CURLOPT_POSTFIELDS => http_build_query([
            'submission' => ['posted_grade' => $postedGrade],
            'comment' => ['text_comment' => 'DSM quiz score synced automatically.'],
        ]),
    ]);

    $body = curl_exec($ch);
    $error = curl_error($ch);
    $status = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    curl_close($ch);

    if ($body !== false && $status >= 200 && $status < 300) {
        return [
            'status' => 'synced',
            'error' => null,
            'synced_at' => gmdate('Y-m-d H:i:s'),
        ];
    }

    return [
        'status' => 'failed',
        'error' => $error !== '' ? $error : 'Canvas returned HTTP ' . $status,
        'synced_at' => null,
    ];
}
