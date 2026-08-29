<?php
declare(strict_types=1);

require_once __DIR__ . '/../lib/quiz-app.php';

$config = dsm_load_config();
$error = null;
$notice = null;

try {
    $pdo = dsm_database_ready($config);
} catch (Throwable $exception) {
    http_response_code(500);
    echo '<!doctype html><meta charset="utf-8"><title>DSM Quiz Admin</title>';
    echo '<h1>DSM Quiz Admin</h1>';
    echo '<p>Database is not configured. Configure MySQL/MariaDB in <code>/var/www/dsm_private/quiz_config.php</code>.</p>';
    echo '<pre>' . dsm_h($exception->getMessage()) . '</pre>';
    exit;
}

dsm_start_admin_session($config);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'login') {
    if (dsm_login_admin($pdo, (string) ($_POST['email'] ?? ''), (string) ($_POST['password'] ?? ''))) {
        header('Location: /api/admin/');
        exit;
    }
    $error = 'Invalid admin email or password.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'sync') {
    $admin = dsm_current_admin($pdo);
    if ($admin === null) {
        http_response_code(403);
        exit('Forbidden');
    }

    $summary = dsm_sync_pending_attempts($pdo, $config, 100);
    $notice = sprintf(
        'Canvas sync complete: %d synced, %d failed, %d skipped, %d checked.',
        $summary['synced'],
        $summary['failed'],
        $summary['skipped'],
        $summary['checked']
    );
}

$admin = dsm_current_admin($pdo);
if ($admin === null) {
    render_login($error);
    exit;
}

$attempts = dsm_list_attempts($pdo, 300);
render_dashboard($admin, $attempts, $notice);

function render_login(?string $error): void
{
    ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DSM Quiz Admin</title>
  <style><?php echo admin_css(); ?></style>
</head>
<body>
  <main class="shell narrow">
    <h1>DSM Quiz Admin</h1>
    <?php if ($error !== null): ?><p class="alert error"><?php echo dsm_h($error); ?></p><?php endif; ?>
    <form method="post" class="panel">
      <input type="hidden" name="action" value="login">
      <label>Email <input type="email" name="email" autocomplete="username" required></label>
      <label>Password <input type="password" name="password" autocomplete="current-password" required></label>
      <button type="submit">Sign in</button>
    </form>
  </main>
</body>
</html>
    <?php
}

function render_dashboard(array $admin, array $attempts, ?string $notice): void
{
    ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DSM Quiz Admin</title>
  <style><?php echo admin_css(); ?></style>
</head>
<body>
  <main class="shell">
    <header class="topbar">
      <div>
        <h1>Assignment Scores</h1>
        <p>Signed in as <?php echo dsm_h($admin['display_name'] ?: $admin['email']); ?></p>
      </div>
      <nav>
        <a class="button secondary" href="/api/admin/report.php">Score Report</a>
        <a class="button secondary" href="/api/admin/users.php">Users</a>
        <a class="button secondary" href="/api/admin/export.csv.php">Export CSV</a>
        <a class="button secondary" href="/api/admin/canvas-export.csv.php?quiz_id=ch01-preview">Preview Canvas CSV</a>
        <a class="button secondary" href="/api/admin/canvas-export.csv.php?quiz_id=ch01-lab">Lab Canvas CSV</a>
        <a class="button secondary" href="/api/admin/canvas-export.csv.php?quiz_id=ch02-preview">Ch02 Preview Canvas CSV</a>
        <a class="button secondary" href="/api/admin/canvas-export.csv.php?quiz_id=ch02-lab">Ch02 Lab Canvas CSV</a>
        <a class="button secondary" href="/api/admin/canvas-export.csv.php?quiz_id=ch02-homework">Ch02 Homework Canvas CSV</a>
        <a class="button secondary" href="/api/admin/logout.php">Log out</a>
      </nav>
    </header>

    <?php if ($notice !== null): ?><p class="alert ok"><?php echo dsm_h($notice); ?></p><?php endif; ?>

    <form method="post" class="toolbar">
      <input type="hidden" name="action" value="sync">
      <button type="submit">Sync Pending to Canvas</button>
    </form>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Submitted</th>
            <th>Student</th>
            <th>Quiz</th>
            <th>Score</th>
            <th>Canvas</th>
            <th>Answers</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($attempts as $attempt): ?>
          <?php $answers = json_decode((string) $attempt['answers_json'], true); ?>
          <tr>
            <td><?php echo dsm_h($attempt['submitted_at']); ?></td>
            <td><?php echo dsm_h($attempt['student_identifier'] ?: $attempt['canvas_user_id'] ?: 'Unknown'); ?></td>
            <td><?php echo dsm_h($attempt['quiz_id']); ?></td>
            <td><?php echo dsm_h($attempt['score']); ?> / <?php echo dsm_h($attempt['max_score']); ?></td>
            <td>
              <span class="status"><?php echo dsm_h($attempt['canvas_sync_status']); ?></span>
              <?php if (!empty($attempt['canvas_sync_error'])): ?>
                <small><?php echo dsm_h($attempt['canvas_sync_error']); ?></small>
              <?php endif; ?>
            </td>
            <td class="answers"><?php echo dsm_h(format_answers(is_array($answers) ? $answers : [])); ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>
    <?php
}

function format_answers(array $answers): string
{
    $parts = [];
    foreach ($answers as $key => $value) {
        if (is_array($value)) {
            $value = json_encode($value, JSON_UNESCAPED_SLASHES);
        }
        $parts[] = $key . '=' . $value;
    }
    return implode(', ', $parts);
}

function admin_css(): string
{
    return '
body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; color: #24292f; background: #f6f8fa; }
.shell { max-width: 1180px; margin: 0 auto; padding: 32px; }
.shell.narrow { max-width: 440px; }
h1 { margin: 0 0 8px; font-size: 28px; }
.topbar { display: flex; justify-content: space-between; gap: 16px; align-items: center; margin-bottom: 20px; }
.topbar p { margin: 0; color: #57606a; }
.panel { display: grid; gap: 16px; padding: 20px; border: 1px solid #d8dee4; border-radius: 8px; background: white; }
label { display: grid; gap: 6px; font-weight: 600; }
input { padding: 10px; border: 1px solid #d0d7de; border-radius: 6px; font: inherit; }
button, .button { display: inline-block; padding: 10px 14px; border: 1px solid #0969da; border-radius: 6px; background: #0969da; color: white; font-weight: 700; text-decoration: none; cursor: pointer; }
.button.secondary { background: white; color: #0969da; }
.toolbar { margin: 0 0 16px; }
.alert { padding: 12px 14px; border-radius: 6px; font-weight: 600; }
.alert.error { background: #ffebe9; color: #cf222e; }
.alert.ok { background: #dafbe1; color: #116329; }
.table-wrap { overflow-x: auto; border: 1px solid #d8dee4; border-radius: 8px; background: white; }
table { width: 100%; border-collapse: collapse; font-size: 14px; }
th, td { padding: 10px 12px; border-bottom: 1px solid #d8dee4; text-align: left; vertical-align: top; }
th { background: #f6f8fa; font-weight: 700; }
small { display: block; color: #57606a; margin-top: 4px; }
.answers { min-width: 360px; font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace; font-size: 12px; }
.status { font-weight: 700; }
';
}
