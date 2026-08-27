<?php
declare(strict_types=1);

require_once __DIR__ . '/../lib/quiz-app.php';

$config = dsm_load_config();
$pdo = dsm_database_ready($config);
$student = dsm_current_student_user($pdo, $config);

if ($student === null) {
    header('Location: /api/student/login.php?next=' . rawurlencode('/api/student/account.php'));
    exit;
}

$displayName = (string) ($student['display_name'] ?: $student['student_identifier']);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Account</title>
  <style><?php echo account_css(); ?></style>
</head>
<body>
  <main class="shell">
    <header class="topbar">
      <div>
        <h1>Account</h1>
        <p>Signed in as <?php echo dsm_h($displayName); ?></p>
      </div>
      <nav>
        <a class="button secondary" href="/">Book</a>
        <a class="button secondary" href="/api/student/scores.php">My Scores</a>
        <a class="button secondary" href="/api/student/logout.php">Sign Out</a>
      </nav>
    </header>

    <section class="card">
      <dl>
        <div>
          <dt>Name</dt>
          <dd><?php echo dsm_h($displayName); ?></dd>
        </div>
        <div>
          <dt>University ID</dt>
          <dd><?php echo dsm_h($student['student_identifier']); ?></dd>
        </div>
        <div>
          <dt>Email</dt>
          <dd><?php echo dsm_h($student['email']); ?></dd>
        </div>
      </dl>
      <a class="button" href="/api/student/change-password.php?next=<?php echo rawurlencode('/api/student/account.php'); ?>">Change Password</a>
    </section>
  </main>
</body>
</html>
<?php

function account_css(): string
{
    return '
body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; color: #24292f; background: #f6f8fa; }
.shell { max-width: 760px; margin: 0 auto; padding: 32px; }
h1 { margin: 0 0 8px; font-size: 28px; }
.topbar { display: flex; justify-content: space-between; gap: 16px; align-items: center; margin-bottom: 20px; }
.topbar p { margin: 0; color: #57606a; }
nav { display: flex; flex-wrap: wrap; gap: 8px; justify-content: flex-end; }
.button { display: inline-block; padding: 10px 14px; border: 1px solid #0969da; border-radius: 6px; background: #0969da; color: white; font-weight: 700; text-decoration: none; }
.button.secondary { background: white; color: #0969da; }
.card { border: 1px solid #d8dee4; border-radius: 8px; background: white; padding: 20px; }
dl { margin: 0 0 20px; }
dl div { display: grid; grid-template-columns: 150px 1fr; gap: 16px; padding: 12px 0; border-bottom: 1px solid #d8dee4; }
dl div:first-child { padding-top: 0; }
dt { font-weight: 700; }
dd { margin: 0; color: #57606a; }
';
}
