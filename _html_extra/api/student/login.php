<?php
declare(strict_types=1);

require_once __DIR__ . '/../lib/quiz-app.php';

$config = dsm_load_config();
$error = null;
$notice = null;
$target = safe_target((string) ($_GET['next'] ?? $_POST['next'] ?? '/'));
$activeTab = 'signin';

try {
    $pdo = dsm_database_ready($config);
} catch (Throwable $exception) {
    http_response_code(500);
    echo '<!doctype html><meta charset="utf-8"><title>Course Sign In</title>';
    echo '<h1>Course Sign In</h1>';
    echo '<p>Database is not configured.</p>';
    echo '<pre>' . dsm_h($exception->getMessage()) . '</pre>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = (string) ($_POST['action'] ?? 'login');
    if ($action === 'request_link') {
        $activeTab = 'signup';
    }

    if ($action === 'request_link') {
        if (dsm_send_student_verification_link($pdo, $config, (string) ($_POST['email'] ?? ''), $target)) {
            $notice = 'Verification email sent. Check your university email to create your password.';
        } else {
            $error = 'Could not send a verification email. Use the active course SIS Login ID, or that ID as a university email.';
        }
    } elseif (dsm_login_student($pdo, $config, (string) ($_POST['identifier'] ?? ''), (string) ($_POST['password'] ?? ''))) {
        header('Location: ' . $target);
        exit;
    } else {
        dsm_start_admin_session($config);
        if (dsm_login_admin($pdo, (string) ($_POST['identifier'] ?? ''), (string) ($_POST['password'] ?? ''))) {
            header('Location: /api/admin/');
            exit;
        }

        $error = dsm_student_email_verification_required($config)
            ? 'Invalid login, or university email verification is still required.'
            : 'Invalid login.';
    }
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Course Sign In</title>
  <style>
body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; color: #24292f; background: #f6f8fa; }
.shell { max-width: 520px; margin: 0 auto; padding: 32px; }
h1 { margin: 0 0 8px; font-size: 28px; }
p { color: #57606a; }
form { display: grid; gap: 16px; margin: 0; }
label { display: grid; gap: 6px; font-weight: 600; }
input { padding: 10px; border: 1px solid #d0d7de; border-radius: 6px; font: inherit; }
button { padding: 10px 14px; border: 1px solid #0969da; border-radius: 6px; background: #0969da; color: white; font-weight: 700; cursor: pointer; }
.secondary-link { color: #0969da; font-size: 14px; font-weight: 400; justify-self: end; text-align: right; text-decoration: none; }
.secondary-link:hover { text-decoration: underline; }
.alert { padding: 12px 14px; border-radius: 6px; font-weight: 600; background: #ffebe9; color: #cf222e; }
.notice { padding: 12px 14px; border-radius: 6px; font-weight: 600; background: #dafbe1; color: #116329; }
.tabs { margin-top: 26px; }
.tabs > input { position: absolute; opacity: 0; pointer-events: none; }
.tab-list { display: grid; grid-template-columns: 1fr 1fr; border: 1px solid #d8dee4; border-bottom: 0; border-radius: 8px 8px 0 0; overflow: hidden; background: #f6f8fa; }
.tab-list label { display: block; padding: 12px 14px; text-align: center; cursor: pointer; color: #57606a; border-bottom: 1px solid #d8dee4; }
#tab-signin:checked ~ .tab-list label[for="tab-signin"],
#tab-signup:checked ~ .tab-list label[for="tab-signup"] { background: white; color: #0969da; border-bottom-color: white; }
.tab-panels { padding: 20px; border: 1px solid #d8dee4; border-radius: 0 0 8px 8px; background: white; }
.tab-panel { display: none; }
#tab-signin:checked ~ .tab-panels .signin-panel,
#tab-signup:checked ~ .tab-panels .signup-panel { display: grid; gap: 20px; }
.section-title { margin: 0; font-size: 18px; }
.section-note { margin: -10px 0 0; }
.email-title { font-size: 16px; }
  </style>
</head>
<body>
  <main class="shell">
    <h1>Course Sign In</h1>
    <?php if ($notice !== null): ?><p class="notice"><?php echo dsm_h($notice); ?></p><?php endif; ?>
    <?php if ($error !== null): ?><p class="alert"><?php echo dsm_h($error); ?></p><?php endif; ?>
    <div class="tabs">
      <input type="radio" id="tab-signin" name="student-tab" <?php echo $activeTab === 'signin' ? 'checked' : ''; ?>>
      <input type="radio" id="tab-signup" name="student-tab" <?php echo $activeTab === 'signup' ? 'checked' : ''; ?>>
      <div class="tab-list" role="tablist" aria-label="Student account">
        <label for="tab-signin" role="tab">Sign In</label>
        <label for="tab-signup" role="tab">Sign Up</label>
      </div>
      <div class="tab-panels">
        <section class="tab-panel signin-panel">
          <form method="post">
            <input type="hidden" name="action" value="login">
            <input type="hidden" name="next" value="<?php echo dsm_h($target); ?>">
            <label>University ID or Email <input name="identifier" autocomplete="username" required></label>
            <label>Password <input type="password" name="password" autocomplete="current-password" required></label>
            <button type="submit">Sign In</button>
            <a class="secondary-link" href="/api/student/change-password.php?next=<?php echo rawurlencode($target); ?>">Forget Password?</a>
          </form>
        </section>
        <section class="tab-panel signup-panel">
          <form method="post">
            <h2 class="section-title email-title">Verify University Email</h2>
            <p class="section-note">Enter your active course SIS Login ID, or that ID as a university email such as ID@umsystem.edu or ID@mst.edu.</p>
            <input type="hidden" name="action" value="request_link">
            <input type="hidden" name="next" value="<?php echo dsm_h($target); ?>">
            <input name="email" autocomplete="email" placeholder="sisloginid or sisloginid@umsystem.edu" required>
            <button type="submit">Send Verification Email</button>
          </form>
        </section>
      </div>
    </div>
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
