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
  <?php echo dsm_admin_nav('assignments'); ?>
  <main class="shell">
    <header class="topbar">
      <div>
        <h1>Assignment Settings</h1>
        <p>Control when answer cells are visible in the book.</p>
      </div>
    </header>

    <?php if ($notice !== null): ?><p class="alert ok"><?php echo dsm_h($notice); ?></p><?php endif; ?>
    <?php if ($error !== null): ?><p class="alert error"><?php echo dsm_h($error); ?></p><?php endif; ?>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th><button type="button" class="sort-header" data-sort-key="assignment">Assignment <span aria-hidden="true"></span></button></th>
            <th><button type="button" class="sort-header" data-sort-key="chapter">Chapter <span aria-hidden="true"></span></button></th>
            <th><button type="button" class="sort-header" data-sort-key="type">Type <span aria-hidden="true"></span></button></th>
            <th><button type="button" class="sort-header" data-sort-key="status">Answer Status <span aria-hidden="true"></span></button></th>
            <th><button type="button" class="sort-header" data-sort-key="updated">Updated <span aria-hidden="true"></span></button></th>
            <th>Canvas CSV</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="assignment-settings-rows">
        <?php foreach ($rows as $row): ?>
          <?php $unlocked = (int) ($row['answers_unlocked'] ?? 0) === 1; ?>
          <tr>
            <td data-sort-value="<?php echo dsm_h($row['assignment_id']); ?>"><?php echo dsm_h($row['assignment_id']); ?></td>
            <td data-sort-value="<?php echo dsm_h($row['chapter']); ?>"><?php echo dsm_h($row['chapter']); ?></td>
            <td data-sort-value="<?php echo dsm_h($row['assignment_slug']); ?>"><?php echo dsm_h($row['assignment_slug']); ?></td>
            <td data-sort-value="<?php echo $unlocked ? '1' : '0'; ?>"><span class="badge <?php echo $unlocked ? 'ok-badge' : 'locked-badge'; ?>"><?php echo $unlocked ? 'Unlocked' : 'Locked'; ?></span></td>
            <td data-sort-value="<?php echo dsm_h($row['updated_at'] ?? ''); ?>"><?php echo dsm_h($row['updated_at'] ?? ''); ?></td>
            <td>
              <a class="button secondary compact" href="/api/admin/canvas-export.csv.php?quiz_id=<?php echo rawurlencode((string) $row['assignment_id']); ?>">Export CSV</a>
            </td>
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
  <script>
  (function () {
    const sortKeys = ['assignment', 'chapter', 'type', 'status', 'updated'];
    const tbody = document.getElementById('assignment-settings-rows');
    const buttons = document.querySelectorAll('.sort-header');
    let activeKey = null;
    let activeDirection = 'asc';

    function cellValue(row, key) {
      const index = sortKeys.indexOf(key);
      const cell = row.children[index];
      return cell ? cell.dataset.sortValue.toLowerCase() : '';
    }

    function updateIndicators(selectedButton) {
      buttons.forEach(function (button) {
        const indicator = button.querySelector('span');
        button.removeAttribute('aria-sort');
        if (indicator) indicator.textContent = '';
      });

      selectedButton.setAttribute('aria-sort', activeDirection === 'asc' ? 'ascending' : 'descending');
      const indicator = selectedButton.querySelector('span');
      if (indicator) indicator.textContent = activeDirection === 'asc' ? '▲' : '▼';
    }

    buttons.forEach(function (button) {
      button.addEventListener('click', function () {
        const key = button.dataset.sortKey;
        if (activeKey === key) {
          activeDirection = activeDirection === 'asc' ? 'desc' : 'asc';
        } else {
          activeKey = key;
          activeDirection = key === 'updated' ? 'desc' : 'asc';
        }

        const direction = activeDirection === 'asc' ? 1 : -1;
        const rows = Array.from(tbody.querySelectorAll('tr'));
        rows.sort(function (left, right) {
          const leftValue = cellValue(left, key);
          const rightValue = cellValue(right, key);
          const result = leftValue.localeCompare(rightValue, undefined, { numeric: true, sensitivity: 'base' });
          return result * direction;
        });
        rows.forEach(function (row) { tbody.appendChild(row); });
        updateIndicators(button);
      });
    });
  }());
  </script>
</body>
</html>
<?php

function assignment_settings_css(): string
{
    return dsm_admin_nav_css() . '
body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; color: #24292f; background: #f6f8fa; }
.shell { max-width: 1180px; margin: 0 auto; padding: 32px; }
h1 { margin: 0 0 8px; font-size: 28px; }
.topbar { display: flex; justify-content: space-between; gap: 16px; align-items: center; margin-bottom: 20px; }
.topbar p { margin: 0; color: #57606a; }
button, .button { display: inline-block; padding: 10px 14px; border: 1px solid #0969da; border-radius: 6px; background: #0969da; color: white; font-weight: 700; text-decoration: none; cursor: pointer; white-space: nowrap; }
.button.secondary { background: white; color: #0969da; }
.button.compact { padding: 8px 10px; font-size: 13px; }
button.danger { border-color: #cf222e; background: #cf222e; }
.alert { padding: 12px 14px; border-radius: 6px; font-weight: 600; }
.alert.error { background: #ffebe9; color: #cf222e; }
.alert.ok { background: #dafbe1; color: #116329; }
.table-wrap { overflow-x: auto; border: 1px solid #d8dee4; border-radius: 8px; background: white; }
table { width: 100%; border-collapse: collapse; font-size: 14px; }
th, td { padding: 10px 12px; border-bottom: 1px solid #d8dee4; text-align: left; vertical-align: middle; }
th { background: #f6f8fa; font-weight: 700; }
.sort-header { display: inline-flex; align-items: center; gap: 6px; width: 100%; padding: 0; border: 0; background: transparent; color: #24292f; font: inherit; text-align: left; cursor: pointer; }
.sort-header span { display: inline-block; min-width: 1em; font-size: 11px; line-height: 1; color: #57606a; }
.sort-header:hover, .sort-header:focus { color: #0969da; outline: none; }
.sort-header:focus-visible { outline: 2px solid #0969da; outline-offset: 3px; border-radius: 3px; }
.badge { display: inline-block; padding: 3px 8px; border-radius: 999px; border: 1px solid #d8dee4; font-weight: 700; }
.ok-badge { color: #116329; background: #dafbe1; border-color: #aceebb; }
.locked-badge { color: #cf222e; background: #ffebe9; border-color: #ffcecb; }
form { margin: 0; }
@media (max-width: 900px) { .topbar { align-items: flex-start; flex-direction: column; } }
';
}
