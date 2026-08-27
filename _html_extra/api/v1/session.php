<?php
declare(strict_types=1);

require_once __DIR__ . '/../lib/quiz-app.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

$config = dsm_load_config();
$pdo = dsm_database_ready($config);
$student = null;
$admin = null;

$studentSessionName = (string) ($config['student_auth']['session_name'] ?? 'dsm_student');
if (isset($_COOKIE[$studentSessionName])) {
    $student = dsm_current_student_user($pdo, $config);
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_write_close();
        $_SESSION = [];
    }
}

$adminSessionName = (string) ($config['auth']['session_name'] ?? 'dsm_quiz_admin');
if (isset($_COOKIE[$adminSessionName])) {
    dsm_start_admin_session($config);
    $admin = dsm_current_admin($pdo);
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_write_close();
        $_SESSION = [];
    }
}

if ($admin !== null) {
    echo json_encode([
        'ok' => true,
        'authenticated' => true,
        'role' => 'admin',
        'identity' => [
            'admin_user_id' => $admin['id'] ?? null,
            'display_name' => $admin['display_name'] ?? '',
            'email' => $admin['email'] ?? '',
        ],
    ], JSON_UNESCAPED_SLASHES);
    exit;
}

if ($student === null) {
    echo json_encode([
        'ok' => true,
        'authenticated' => false,
    ], JSON_UNESCAPED_SLASHES);
    exit;
}

$studentEmail = trim((string) ($student['email'] ?? ''));
if ($studentEmail !== '') {
    $stmt = $pdo->prepare(
        'SELECT id, email, display_name
         FROM quiz_users
         WHERE LOWER(email) = LOWER(:email)
           AND role = \'admin\'
           AND status = \'active\'
         LIMIT 1'
    );
    $stmt->execute(['email' => $studentEmail]);
    $adminFromStudentIdentity = $stmt->fetch(PDO::FETCH_ASSOC);
    if (is_array($adminFromStudentIdentity)) {
        echo json_encode([
            'ok' => true,
            'authenticated' => true,
            'role' => 'admin',
            'identity' => [
                'admin_user_id' => $adminFromStudentIdentity['id'] ?? null,
                'display_name' => $adminFromStudentIdentity['display_name'] ?? '',
                'email' => $adminFromStudentIdentity['email'] ?? '',
            ],
        ], JSON_UNESCAPED_SLASHES);
        exit;
    }
}

echo json_encode([
    'ok' => true,
    'authenticated' => true,
    'role' => 'student',
    'identity' => [
        'student_user_id' => $student['student_user_id'] ?? null,
        'student_identifier' => $student['student_identifier'] ?? '',
        'canvas_user_id' => $student['canvas_user_id'] ?? '',
        'display_name' => $student['display_name'] ?? '',
        'email' => $student['email'] ?? '',
        'lti_context_id' => $student['lti_context_id'] ?? '',
        'lti_resource_link_id' => $student['lti_resource_link_id'] ?? '',
        'lti_lineitem_url' => $student['lti_lineitem_url'] ?? '',
    ],
], JSON_UNESCAPED_SLASHES);
