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

$rows = dsm_list_admin_score_report($pdo);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Score Report</title>
  <style><?php echo report_css(); ?></style>
</head>
<body>
  <main class="shell">
    <header class="topbar">
      <div>
        <h1>Score Report</h1>
        <p>Best score and attempt count by student and assignment.</p>
      </div>
      <nav>
        <a class="button secondary" href="/api/admin/">Attempts</a>
        <a class="button secondary" href="/api/admin/users.php">Users</a>
        <a class="button secondary" href="/api/admin/export.csv.php">Export CSV</a>
        <a class="button secondary" href="/api/admin/logout.php">Sign Out</a>
      </nav>
    </header>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Assignment</th>
            <th>Best Score</th>
            <th>Attempts</th>
            <th>Last Submitted</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $row): ?>
          <tr>
            <td><?php echo dsm_h($row['student_identifier']); ?></td>
            <td><?php echo dsm_h($row['display_name']); ?></td>
            <td><?php echo dsm_h($row['quiz_id']); ?></td>
            <td><?php echo dsm_h($row['best_score']); ?> / <?php echo dsm_h($row['max_score']); ?></td>
            <td><?php echo dsm_h($row['attempt_count']); ?></td>
            <td><?php echo dsm_h($row['last_submitted_at']); ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>
<?php

function report_css(): string
{
    return '
body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; color: #24292f; background: #f6f8fa; }
.shell { max-width: 1180px; margin: 0 auto; padding: 32px; }
h1 { margin: 0 0 8px; font-size: 28px; }
.topbar { display: flex; justify-content: space-between; gap: 16px; align-items: center; margin-bottom: 20px; }
.topbar p { margin: 0; color: #57606a; }
.button { display: inline-block; padding: 10px 14px; border: 1px solid #0969da; border-radius: 6px; background: white; color: #0969da; font-weight: 700; text-decoration: none; }
.table-wrap { overflow-x: auto; border: 1px solid #d8dee4; border-radius: 8px; background: white; }
table { width: 100%; border-collapse: collapse; font-size: 14px; }
th, td { padding: 10px 12px; border-bottom: 1px solid #d8dee4; text-align: left; }
th { background: #f6f8fa; font-weight: 700; }
';
}
