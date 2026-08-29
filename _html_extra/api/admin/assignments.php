<?php
declare(strict_types=1);

require_once __DIR__ . '/../lib/quiz-app.php';

$config = dsm_load_config();
$pdo = dsm_database_ready($config);
dsm_start_admin_session($config);

$admin = dsm_current_admin($pdo);
if ($admin === null) {
    header('Location: /api/admin/');
    exit;
}

$notice = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $assignmentId = trim((string) ($_POST['assignment_id'] ?? ''));
        $answersUnlocked = (string) ($_POST['answers_unlocked'] ?? '0') === '1';
        dsm_update_assignment_answer_lock($pdo, $assignmentId, $answersUnlocked, (int) $admin['id']);
        $notice = $answersUnlocked ? 'Answers unlocked.' : 'Answers locked.';
    } catch (Throwable $exception) {
        $error = $exception->getMessage();
    }
}

$rows = dsm_list_assignment_settings($pdo);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Assignment Settings</title>
  <style><?php echo assignment_settings_css(); ?></style>
</head>
<body>
  <main class="shell">
    <header class="topbar">
      <div>
        <h1>Assignment Settings</h1>
        <p>Control when answer cells are visible in the book.</p>
      </div>
      <nav>
        <a class="button secondary" href="/api/admin/">Attempts</a>
        <a class="button secondary" href="/api/admin/report.php">Score Report</a>
        <a class="button secondary" href="/api/admin/users.php">Users</a>
        <a class="button secondary" href="/api/admin/logout.php">Log out</a>
      </nav>
    </header>

    <?php if ($notice !== null): ?><p class="alert ok"><?php echo dsm_h($notice); ?></p><?php endif; ?>
    <?php if ($error !== null): ?><p class="alert error"><?php echo dsm_h($error); ?></p><?php endif; ?>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Assignment</th>
            <th>Chapter</th>
            <th>Type</th>
            <th>Answer Status</th>
            <th>Updated</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $row): ?>
          <?php $unlocked = (int) ($row['answers_unlocked'] ?? 0) === 1; ?>
          <tr>
            <td><?php echo dsm_h($row['assignment_id']); ?></td>
            <td><?php echo dsm_h($row['chapter']); ?></td>
            <td><?php echo dsm_h($row['assignment_slug']); ?></td>
            <td><span class="badge <?php echo $unlocked ? 'ok-badge' : 'locked-badge'; ?>"><?php echo $unlocked ? 'Unlocked' : 'Locked'; ?></span></td>
            <td><?php echo dsm_h($row['updated_at'] ?? ''); ?></td>
            <td>
              <form method="post">
                <input type="hidden" name="assignment_id" value="<?php echo dsm_h($row['assignment_id']); ?>">
                <input type="hidden" name="answers_unlocked" value="<?php echo $unlocked ? '0' : '1'; ?>">
                <button type="submit" class="<?php echo $unlocked ? 'danger' : ''; ?>"><?php echo $unlocked ? 'Lock Answers' : 'Unlock Answers'; ?></button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>
<?php

function assignment_settings_css(): string
{
    return '
body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; color: #24292f; background: #f6f8fa; }
.shell { max-width: 1180px; margin: 0 auto; padding: 32px; }
h1 { margin: 0 0 8px; font-size: 28px; }
.topbar { display: flex; justify-content: space-between; gap: 16px; align-items: center; margin-bottom: 20px; }
.topbar p { margin: 0; color: #57606a; }
button, .button { display: inline-block; padding: 10px 14px; border: 1px solid #0969da; border-radius: 6px; background: #0969da; color: white; font-weight: 700; text-decoration: none; cursor: pointer; white-space: nowrap; }
.button.secondary { background: white; color: #0969da; }
button.danger { border-color: #cf222e; background: #cf222e; }
.alert { padding: 12px 14px; border-radius: 6px; font-weight: 600; }
.alert.error { background: #ffebe9; color: #cf222e; }
.alert.ok { background: #dafbe1; color: #116329; }
.table-wrap { overflow-x: auto; border: 1px solid #d8dee4; border-radius: 8px; background: white; }
table { width: 100%; border-collapse: collapse; font-size: 14px; }
th, td { padding: 10px 12px; border-bottom: 1px solid #d8dee4; text-align: left; vertical-align: middle; }
th { background: #f6f8fa; font-weight: 700; }
.badge { display: inline-block; padding: 3px 8px; border-radius: 999px; border: 1px solid #d8dee4; font-weight: 700; }
.ok-badge { color: #116329; background: #dafbe1; border-color: #aceebb; }
.locked-badge { color: #cf222e; background: #ffebe9; border-color: #ffcecb; }
form { margin: 0; }
@media (max-width: 900px) { .topbar { align-items: flex-start; flex-direction: column; } }
';
}
