<?php
declare(strict_types=1);

require_once __DIR__ . '/../lib/quiz-app.php';

$config = dsm_load_config();
$pdo = dsm_database_ready($config);
$student = dsm_current_student_user($pdo, $config);

if ($student === null) {
    header('Location: /api/student/login.php?next=' . rawurlencode('/api/student/scores.php'));
    exit;
}

$summary = dsm_list_student_score_summary($pdo, (int) $student['student_user_id']);
$attempts = dsm_list_student_attempts($pdo, (int) $student['student_user_id'], 100);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Scores</title>
  <style><?php echo scores_css(); ?></style>
</head>
<body>
  <main class="shell">
    <header class="topbar">
      <div>
        <h1>My Scores</h1>
        <p>Signed in as <?php echo dsm_h($student['display_name'] ?: $student['student_identifier']); ?></p>
      </div>
      <nav>
        <a class="button secondary" href="/">Book</a>
        <a class="button secondary" href="/api/student/logout.php">Sign Out</a>
      </nav>
    </header>

    <section>
      <h2>Best Scores</h2>
      <?php render_score_table($summary, true); ?>
    </section>

    <section>
      <h2>Attempts</h2>
      <?php render_score_table($attempts, false); ?>
    </section>
  </main>
</body>
</html>
<?php

function render_score_table(array $rows, bool $isSummary): void
{
    if ($rows === []) {
        echo '<p class="empty">No submissions yet.</p>';
        return;
    }
    ?>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Assignment</th>
            <th>Score</th>
            <?php if ($isSummary): ?><th>Attempts</th><?php else: ?><th>Canvas</th><?php endif; ?>
            <th><?php echo $isSummary ? 'Last Submitted' : 'Submitted'; ?></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $row): ?>
          <tr>
            <td><?php echo dsm_h($row['quiz_id']); ?></td>
            <td><?php echo dsm_h($isSummary ? $row['best_score'] : $row['score']); ?> / <?php echo dsm_h($row['max_score']); ?></td>
            <?php if ($isSummary): ?>
              <td><?php echo dsm_h($row['attempt_count']); ?></td>
              <td><?php echo dsm_h($row['last_submitted_at']); ?></td>
            <?php else: ?>
              <td><span class="status"><?php echo dsm_h($row['canvas_sync_status']); ?></span></td>
              <td><?php echo dsm_h($row['submitted_at']); ?></td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php
}

function scores_css(): string
{
    return '
body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; color: #24292f; background: #f6f8fa; }
.shell { max-width: 980px; margin: 0 auto; padding: 32px; }
h1 { margin: 0 0 8px; font-size: 28px; }
h2 { margin: 24px 0 12px; font-size: 18px; }
.topbar { display: flex; justify-content: space-between; gap: 16px; align-items: center; margin-bottom: 20px; }
.topbar p { margin: 0; color: #57606a; }
.button { display: inline-block; padding: 10px 14px; border: 1px solid #0969da; border-radius: 6px; background: white; color: #0969da; font-weight: 700; text-decoration: none; }
.table-wrap { overflow-x: auto; border: 1px solid #d8dee4; border-radius: 8px; background: white; }
table { width: 100%; border-collapse: collapse; font-size: 14px; }
th, td { padding: 10px 12px; border-bottom: 1px solid #d8dee4; text-align: left; }
th { background: #f6f8fa; font-weight: 700; }
.status { font-weight: 700; }
.empty { padding: 16px; border: 1px solid #d8dee4; border-radius: 8px; background: white; color: #57606a; }
';
}
