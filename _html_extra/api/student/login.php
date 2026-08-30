<?php
declare(strict_types=1);

require_once __DIR__ . '/../lib/quiz-app.php';

$config = dsm_load_config();
$error = null;
$notice = null;
$target = safe_target((string) ($_GET['next'] ?? $_POST['next'] ?? '/'));
$isModal = (string) ($_GET['modal'] ?? $_POST['modal'] ?? '') === '1';
$activeTab = (string) ($_GET['tab'] ?? '') === 'signup' ? 'signup' : 'signin';

try {
    $pdo = dsm_database_ready($config);
} catch (Throwable $exception) {
    http_response_code(500);
    echo '<!doctype html><meta charset="utf-8"><title>Course sign in</title>';
    echo '<h1>Course sign in</h1>';
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
        if ($isModal) {
            render_auth_success($target);
        }
        header('Location: ' . $target);
        exit;
    } else {
        dsm_start_admin_session($config);
        if (dsm_login_admin($pdo, (string) ($_POST['identifier'] ?? ''), (string) ($_POST['password'] ?? ''))) {
            if ($isModal) {
                render_auth_success($target);
            }
            header('Location: ' . $target);
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
  <title>Course sign in</title>
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
.modal-body { background: white; }
.modal-body { font-size: 0.792rem; }
.modal-body .shell { max-width: none; padding: 10px 12px 12px; }
.modal-body h1 { display: none; }
.modal-body p { margin: 0; font-size: 0.7rem; line-height: 1.3; }
.modal-body form { gap: 9px; }
.modal-body label { gap: 3px; font-size: 0.74rem; }
.modal-body input { padding: 6px 7px; min-height: 2rem; }
.modal-body button { padding: 6px 10px; min-height: 2rem; }
.modal-body .secondary-link { font-size: 0.7rem; }
.modal-body .tabs { margin-top: 0; }
.modal-body .tab-list { border-radius: 6px 6px 0 0; }
.modal-body .tab-list label { padding: 6px 8px; font-size: 0.74rem; }
.modal-body .tab-panels { padding: 10px; border-radius: 0 0 6px 6px; }
.modal-body #tab-signin:checked ~ .tab-panels .signin-panel,
.modal-body #tab-signup:checked ~ .tab-panels .signup-panel { gap: 9px; }
.modal-body .section-title { font-size: 0.815rem; }
.modal-body .section-note { margin: -2px 0 0; }
  </style>
</head>
<body<?php echo $isModal ? ' class="modal-body"' : ''; ?>>
  <main class="shell">
    <h1>Course sign in</h1>
    <?php if ($notice !== null): ?><p class="notice"><?php echo dsm_h($notice); ?></p><?php endif; ?>
    <?php if ($error !== null): ?><p class="alert"><?php echo dsm_h($error); ?></p><?php endif; ?>
    <div class="tabs">
      <input type="radio" id="tab-signin" name="student-tab" <?php echo $activeTab === 'signin' ? 'checked' : ''; ?>>
      <input type="radio" id="tab-signup" name="student-tab" <?php echo $activeTab === 'signup' ? 'checked' : ''; ?>>
      <div class="tab-list" role="tablist" aria-label="Student account">
        <label for="tab-signin" role="tab">Sign in</label>
        <label for="tab-signup" role="tab">Sign up</label>
      </div>
      <div class="tab-panels">
        <section class="tab-panel signin-panel">
          <form method="post">
            <input type="hidden" name="action" value="login">
            <input type="hidden" name="next" value="<?php echo dsm_h($target); ?>">
            <?php if ($isModal): ?><input type="hidden" name="modal" value="1"><?php endif; ?>
            <label>University ID or Email <input name="identifier" autocomplete="username" required></label>
            <label>Password <input type="password" name="password" autocomplete="current-password" required></label>
            <button type="submit">Sign in</button>
            <a class="secondary-link" href="/api/student/change-password.php?next=<?php echo rawurlencode($target); ?>">Forgot password?</a>
          </form>
        </section>
        <section class="tab-panel signup-panel">
          <form method="post">
            <h2 class="section-title email-title">Verify University Email</h2>
            <p class="section-note">Enter your active course SIS Login ID, or that ID as a university email such as ID@umsystem.edu or ID@mst.edu.</p>
            <input type="hidden" name="action" value="request_link">
            <input type="hidden" name="next" value="<?php echo dsm_h($target); ?>">
            <?php if ($isModal): ?><input type="hidden" name="modal" value="1"><?php endif; ?>
            <input name="email" autocomplete="email" placeholder="sisloginid or sisloginid@umsystem.edu" required>
            <button type="submit">Send Verification Email</button>
            <p class="section-note">After sending, check your Spam/Junk folder if it doesn't arrive within a few minutes.</p>
          </form>
        </section>
      </div>
    </div>
  </main>
</body>
</html>
<?php

function render_auth_success(string $target): never
{
    $jsonTarget = json_encode($target, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    echo '<!doctype html><html lang="en"><head><meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<title>Signed in</title>';
    echo '<style>body{margin:0;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;color:#24292f;background:#f6f8fa}.shell{max-width:520px;margin:0 auto;padding:32px}p{color:#57606a}a{color:#0969da}</style>';
    echo '</head><body><main class="shell"><h1>Signed in</h1><p>Returning to the course page.</p>';
    echo '<p><a href="' . dsm_h($target) . '" target="_top">Continue</a></p></main>';
    echo '<script>';
    echo 'var target=' . $jsonTarget . ';';
    echo 'if(window.parent&&window.parent!==window){window.parent.postMessage({source:"think-book-auth",type:"auth-success",target:target},window.location.origin);}else{window.location.href=target;}';
    echo '</script></body></html>';
    exit;
}

function safe_target(string $target): string
{
    if ($target === '' || $target[0] !== '/' || str_starts_with($target, '//')) {
        return '/';
    }
    return $target;
}
