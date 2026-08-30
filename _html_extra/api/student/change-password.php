<?php
declare(strict_types=1);

require_once __DIR__ . '/../lib/quiz-app.php';

$config = dsm_load_config();
$error = null;
$notice = null;
$target = safe_target((string) ($_GET['next'] ?? $_POST['next'] ?? '/'));
$isModal = (string) ($_GET['modal'] ?? $_POST['modal'] ?? '') === '1';

try {
    $pdo = dsm_database_ready($config);
} catch (Throwable $exception) {
    http_response_code(500);
    echo '<!doctype html><meta charset="utf-8"><title>Change Password</title>';
    echo '<h1>Change Password</h1>';
    echo '<p>Database is not configured.</p>';
    echo '<pre>' . dsm_h($exception->getMessage()) . '</pre>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (dsm_send_student_verification_link($pdo, $config, (string) ($_POST['email'] ?? ''), $target)) {
        $notice = 'Verification email sent. Check your university email to create your password.';
    } else {
        $error = 'Could not send a verification email. Use the university email that matches a course student login ID.';
    }
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Change Password</title>
  <style>
body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; color: #24292f; background: #f6f8fa; }
.shell { max-width: 440px; margin: 0 auto; padding: 32px; }
h1 { margin: 0 0 8px; font-size: 28px; }
p { color: #57606a; }
form { display: grid; gap: 16px; padding: 20px; border: 1px solid #d8dee4; border-radius: 8px; background: white; }
label { display: grid; gap: 6px; font-weight: 600; }
input { padding: 10px; border: 1px solid #d0d7de; border-radius: 6px; font: inherit; }
button { padding: 10px 14px; border: 1px solid #0969da; border-radius: 6px; background: #0969da; color: white; font-weight: 700; cursor: pointer; }
.alert { padding: 12px 14px; border-radius: 6px; font-weight: 600; background: #ffebe9; color: #cf222e; }
.notice { padding: 12px 14px; border-radius: 6px; font-weight: 600; background: #dafbe1; color: #116329; }
.section-title { margin-top: 24px; font-size: 18px; }
.modal-body { background: white; font-size: 13px; }
.modal-body .shell { max-width: none; padding: 10px 12px 12px; }
.modal-body h1 { margin: 0 0 6px; font-size: 13px; font-weight: 400; line-height: 1.2; }
.modal-body p { margin: 0 0 8px; font-size: 13px; line-height: 1.3; }
.modal-body :where(h1, p, label, input, button) { font-weight: 400 !important; }
.modal-body form { gap: 9px; padding: 10px; border-radius: 6px; }
.modal-body label { gap: 3px; font-size: 13px; }
.modal-body input { box-sizing: border-box !important; height: 30px !important; min-height: 0 !important; max-height: 30px !important; padding: 0 7px !important; line-height: 1.2 !important; }
.modal-body button { padding: 6px 10px; min-height: 2rem; font-size: 13px; }
.modal-body .alert,
.modal-body .notice { margin-bottom: 8px; padding: 7px 8px; font-size: 13px; }
  </style>
</head>
<body<?php echo $isModal ? ' class="modal-body"' : ''; ?>>
  <main class="shell">
    <h1>Change Password</h1>
    <p>Verify with your university email, then set a new password.</p>
    <?php if ($notice !== null): ?><p class="notice"><?php echo dsm_h($notice); ?></p><?php endif; ?>
    <?php if ($error !== null): ?><p class="alert"><?php echo dsm_h($error); ?></p><?php endif; ?>

    <form method="post">
      <input type="hidden" name="next" value="<?php echo dsm_h($target); ?>">
      <?php if ($isModal): ?><input type="hidden" name="modal" value="1"><?php endif; ?>
      <label>University Email <input type="email" name="email" autocomplete="email" placeholder="studentid@umsystem.edu" required></label>
      <button type="submit">Send Verification Email</button>
    </form>
  </main>
</body>
</html>
<?php

function safe_target(string $target): string
{
    if ($target === '' || $target[0] !== '/' || str_starts_with($target, '//')) {
        return '/';
    }
    return $target;
}
