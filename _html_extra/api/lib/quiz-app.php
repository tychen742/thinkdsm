<?php
declare(strict_types=1);

function dsm_load_config(): array
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
        'file_store' => [
            'path' => '/var/www/dsm_private/dsm_quiz_attempts.jsonl',
        ],
        'auth' => [
            'session_name' => 'dsm_quiz_admin',
            'bootstrap_admins' => [],
        ],
    ];

    $paths = [];
    $envPath = getenv('DSM_QUIZ_CONFIG');
    if (is_string($envPath) && $envPath !== '') {
        $paths[] = $envPath;
    }
    $paths[] = '/var/www/dsm_private/quiz_config.php';
    $paths[] = '/home/tychen/dsm_private/quiz_config.php';

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

function dsm_connect_database(array $database): PDO
{
    return new PDO(
        (string) $database['dsn'],
        $database['username'] ?? null,
        $database['password'] ?? null,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
}

function dsm_initialize_schema(PDO $pdo): void
{
    $driver = (string) $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    $idColumn = $driver === 'sqlite'
        ? 'id INTEGER PRIMARY KEY AUTOINCREMENT'
        : 'id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY';

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS quiz_users (
            ' . $idColumn . ',
            email VARCHAR(255) NOT NULL UNIQUE,
            display_name VARCHAR(255) NULL,
            role VARCHAR(32) NOT NULL DEFAULT \'student\',
            password_hash VARCHAR(255) NULL,
            status VARCHAR(32) NOT NULL DEFAULT \'active\',
            canvas_user_id VARCHAR(64) NULL,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        )'
    );

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS quiz_attempts (
            ' . $idColumn . ',
            quiz_id VARCHAR(100) NOT NULL,
            chapter VARCHAR(100) NOT NULL,
            assignment_slug VARCHAR(100) NOT NULL,
            student_user_id INT NULL,
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

    dsm_add_column_if_missing($pdo, 'quiz_attempts', 'student_user_id', 'INT NULL');
}

function dsm_add_column_if_missing(PDO $pdo, string $table, string $column, string $definition): void
{
    $driver = (string) $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    if ($driver === 'sqlite') {
        $stmt = $pdo->query('PRAGMA table_info(' . $table . ')');
        foreach ($stmt->fetchAll() as $row) {
            if (($row['name'] ?? '') === $column) {
                return;
            }
        }
    } else {
        $stmt = $pdo->prepare('SHOW COLUMNS FROM ' . $table . ' LIKE :column');
        $stmt->execute(['column' => $column]);
        if ($stmt->fetch()) {
            return;
        }
    }

    $pdo->exec('ALTER TABLE ' . $table . ' ADD COLUMN ' . $column . ' ' . $definition);
}

function dsm_seed_admins(PDO $pdo, array $config): void
{
    foreach (($config['auth']['bootstrap_admins'] ?? []) as $admin) {
        $email = trim((string) ($admin['email'] ?? ''));
        $passwordHash = (string) ($admin['password_hash'] ?? '');
        if ($email === '' || $passwordHash === '') {
            continue;
        }

        $stmt = $pdo->prepare('SELECT id FROM quiz_users WHERE LOWER(email) = LOWER(:email) LIMIT 1');
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            continue;
        }

        $insert = $pdo->prepare(
            'INSERT INTO quiz_users (email, display_name, role, password_hash, status, canvas_user_id)
             VALUES (:email, :display_name, \'admin\', :password_hash, \'active\', :canvas_user_id)'
        );
        $insert->execute([
            'email' => $email,
            'display_name' => $admin['display_name'] ?? $email,
            'password_hash' => $passwordHash,
            'canvas_user_id' => $admin['canvas_user_id'] ?? null,
        ]);
    }
}

function dsm_database_ready(array $config): PDO
{
    $pdo = dsm_connect_database($config['database']);
    dsm_initialize_schema($pdo);
    dsm_seed_admins($pdo, $config);
    return $pdo;
}

function dsm_quiz_definition(string $quizId): ?array
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

function dsm_grade_attempt(array $quiz, array $answers): array
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
            'message' => $submitted === ''
                ? 'No answer submitted.'
                : ($isCorrect ? 'Correct.' : 'Try again.'),
        ];
    }

    return [
        'score' => $score,
        'max_score' => count($quiz['questions']),
        'answers' => $normalizedAnswers,
        'feedback' => $feedback,
    ];
}

function dsm_save_attempt_record(array $config, array $attempt): int|string
{
    try {
        $pdo = dsm_database_ready($config);
        return dsm_save_attempt($pdo, $attempt);
    } catch (Throwable $exception) {
        error_log('DSM quiz database save failed, using file fallback: ' . $exception->getMessage());
        return dsm_save_attempt_file($config['file_store'], $attempt, $exception->getMessage());
    }
}

function dsm_save_attempt(PDO $pdo, array $attempt): int
{
    $sql = 'INSERT INTO quiz_attempts (
        quiz_id, chapter, assignment_slug, student_user_id, canvas_course_id, canvas_assignment_id,
        canvas_user_id, student_identifier, score, max_score, answers_json, feedback_json,
        canvas_sync_status, canvas_sync_error, synced_to_canvas_at, ip_address, user_agent
    ) VALUES (
        :quiz_id, :chapter, :assignment_slug, :student_user_id, :canvas_course_id, :canvas_assignment_id,
        :canvas_user_id, :student_identifier, :score, :max_score, :answers_json, :feedback_json,
        :canvas_sync_status, :canvas_sync_error, :synced_to_canvas_at, :ip_address, :user_agent
    )';

    $stmt = $pdo->prepare($sql);
    $stmt->execute($attempt);
    return (int) $pdo->lastInsertId();
}

function dsm_save_attempt_file(array $fileStore, array $attempt, string $storageWarning): string
{
    $path = (string) ($fileStore['path'] ?? (sys_get_temp_dir() . '/dsm_quiz_attempts.jsonl'));
    $directory = dirname($path);
    if (!is_dir($directory) && !@mkdir($directory, 0770, true) && !is_dir($directory)) {
        $path = sys_get_temp_dir() . '/dsm_quiz_attempts.jsonl';
    }

    $attemptId = gmdate('YmdHis') . '-' . bin2hex(random_bytes(4));
    $record = $attempt + [
        'id' => $attemptId,
        'submitted_at' => gmdate('Y-m-d H:i:s'),
        'storage_warning' => $storageWarning,
    ];

    $json = json_encode($record, JSON_UNESCAPED_SLASHES);
    if ($json === false || file_put_contents($path, $json . PHP_EOL, FILE_APPEND | LOCK_EX) === false) {
        throw new RuntimeException('Could not write quiz attempt file.');
    }

    return $attemptId;
}

function dsm_canvas_ready(array $config, array $identity): bool
{
    return !empty($config['canvas']['enabled'])
        && !empty($config['canvas']['base_url'])
        && !empty($config['canvas']['access_token'])
        && !empty($identity['canvas_course_id'])
        && !empty($identity['canvas_assignment_id'])
        && !empty($identity['canvas_user_id']);
}

function dsm_sync_canvas_grade(array $canvas, array $identity, string $postedGrade): array
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

function dsm_list_attempts(PDO $pdo, int $limit = 200): array
{
    $stmt = $pdo->prepare(
        'SELECT id, quiz_id, chapter, assignment_slug, canvas_course_id, canvas_assignment_id,
                canvas_user_id, student_identifier, score, max_score, answers_json,
                canvas_sync_status, canvas_sync_error, synced_to_canvas_at, submitted_at
         FROM quiz_attempts
         ORDER BY submitted_at DESC, id DESC
         LIMIT :limit'
    );
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function dsm_sync_pending_attempts(PDO $pdo, array $config, int $limit = 100): array
{
    $stmt = $pdo->prepare(
        'SELECT id, canvas_course_id, canvas_assignment_id, canvas_user_id, score
         FROM quiz_attempts
         WHERE canvas_sync_status IN (\'pending\', \'failed\')
         ORDER BY submitted_at ASC, id ASC
         LIMIT :limit'
    );
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    $attempts = $stmt->fetchAll();

    $summary = ['synced' => 0, 'failed' => 0, 'skipped' => 0, 'checked' => count($attempts)];
    foreach ($attempts as $attempt) {
        if (
            empty($attempt['canvas_course_id'])
            || empty($attempt['canvas_assignment_id'])
            || empty($attempt['canvas_user_id'])
        ) {
            dsm_update_sync_status($pdo, (int) $attempt['id'], [
                'status' => 'skipped',
                'error' => 'Missing Canvas course, assignment, or user ID.',
                'synced_at' => null,
            ]);
            $summary['skipped']++;
            continue;
        }

        if (empty($config['canvas']['enabled'])) {
            dsm_update_sync_status($pdo, (int) $attempt['id'], [
                'status' => 'failed',
                'error' => 'Canvas sync is not enabled.',
                'synced_at' => null,
            ]);
            $summary['failed']++;
            continue;
        }

        $result = dsm_sync_canvas_grade($config['canvas'], $attempt, (string) $attempt['score']);
        dsm_update_sync_status($pdo, (int) $attempt['id'], $result);
        $summary[$result['status'] === 'synced' ? 'synced' : 'failed']++;
    }

    return $summary;
}

function dsm_update_sync_status(PDO $pdo, int $attemptId, array $result): void
{
    $stmt = $pdo->prepare(
        'UPDATE quiz_attempts
         SET canvas_sync_status = :status,
             canvas_sync_error = :error,
             synced_to_canvas_at = :synced_at
         WHERE id = :id'
    );
    $stmt->execute([
        'status' => $result['status'],
        'error' => $result['error'],
        'synced_at' => $result['synced_at'],
        'id' => $attemptId,
    ]);
}

function dsm_start_admin_session(array $config): void
{
    session_name((string) $config['auth']['session_name']);
    session_start();
}

function dsm_current_admin(PDO $pdo): ?array
{
    $id = $_SESSION['admin_user_id'] ?? null;
    if (!is_int($id) && !ctype_digit((string) $id)) {
        return null;
    }

    $stmt = $pdo->prepare(
        'SELECT id, email, display_name, role, status
         FROM quiz_users
         WHERE id = :id AND role = \'admin\' AND status = \'active\'
         LIMIT 1'
    );
    $stmt->execute(['id' => (int) $id]);
    $admin = $stmt->fetch();
    return is_array($admin) ? $admin : null;
}

function dsm_login_admin(PDO $pdo, string $email, string $password): bool
{
    $stmt = $pdo->prepare(
        'SELECT id, password_hash
         FROM quiz_users
         WHERE LOWER(email) = LOWER(:email) AND role = \'admin\' AND status = \'active\'
         LIMIT 1'
    );
    $stmt->execute(['email' => trim($email)]);
    $admin = $stmt->fetch();
    if (!is_array($admin) || !password_verify($password, (string) $admin['password_hash'])) {
        return false;
    }

    $_SESSION['admin_user_id'] = (int) $admin['id'];
    return true;
}

function dsm_h(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
