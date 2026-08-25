<?php
declare(strict_types=1);

require_once __DIR__ . '/../lib/quiz-app.php';

$config = dsm_load_config();
dsm_start_admin_session($config);
$_SESSION = [];
session_destroy();

header('Location: /api/admin/');
