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

$assignmentTypes = ['preview' => 'Preview', 'lab' => 'Lab', 'homework' => 'Homework'];
$selectedAssignmentType = strtolower(trim((string) ($_GET['assignment_type'] ?? '')));
if (!isset($assignmentTypes[$selectedAssignmentType])) {
    $selectedAssignmentType = '';
}

$assignmentNumbers = dsm_list_admin_report_assignment_numbers($pdo);
$selectedAssignmentNumber = strtolower(trim((string) ($_GET['assignment_number'] ?? '')));
if (!in_array($selectedAssignmentNumber, $assignmentNumbers, true)) {
    $selectedAssignmentNumber = '';
}

$scoreModes = ['best' => 'Best', 'all' => 'All'];
$selectedScoreMode = strtolower(trim((string) ($_GET['score_mode'] ?? 'best')));
if (!isset($scoreModes[$selectedScoreMode])) {
    $selectedScoreMode = 'best';
}

$selectedStudent = dsm_normalize_student_identifier((string) ($_GET['student_identifier'] ?? ''));

$studentOptions = dsm_list_admin_report_students($pdo);
$rows = dsm_list_admin_score_report(
    $pdo,
    $selectedAssignmentType !== '' ? $selectedAssignmentType : null,
    $selectedAssignmentNumber !== '' ? $selectedAssignmentNumber : null,
    $selectedStudent !== '' ? $selectedStudent : null,
    $selectedScoreMode
);
$scoreHeader = $selectedScoreMode === 'all' ? 'Score' : 'Best Score';
$attemptHeader = $selectedScoreMode === 'all' ? 'Attempt' : 'Attempts';
$submittedHeader = $selectedScoreMode === 'all' ? 'Submitted' : 'Last Submitted';
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
  <?php echo dsm_admin_nav('report'); ?>
  <main class="shell">
    <header class="topbar">
      <div>
        <h1>Score Report</h1>
        <p>Scores and attempt counts by student and assignment.</p>
      </div>
    </header>

    <form class="filters" method="get" action="/api/admin/report.php">
      <label>
        <span>Assignment Name</span>
        <select name="assignment_type">
          <option value="">All names</option>
          <?php foreach ($assignmentTypes as $assignmentType => $assignmentTypeLabel): ?>
            <option value="<?php echo dsm_h($assignmentType); ?>" <?php echo $selectedAssignmentType === $assignmentType ? 'selected' : ''; ?>>
              <?php echo dsm_h($assignmentTypeLabel); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </label>
      <label>
        <span>Assignment Number</span>
        <select name="assignment_number">
          <option value="">All numbers</option>
          <?php foreach ($assignmentNumbers as $assignmentNumber): ?>
            <option value="<?php echo dsm_h($assignmentNumber); ?>" <?php echo $selectedAssignmentNumber === $assignmentNumber ? 'selected' : ''; ?>>
              <?php echo dsm_h($assignmentNumber); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </label>
      <label>
        <span>Student</span>
        <select name="student_identifier">
          <option value="">All students</option>
          <?php foreach ($studentOptions as $student): ?>
            <?php $studentIdentifier = (string) $student['student_identifier']; ?>
            <option value="<?php echo dsm_h($studentIdentifier); ?>" <?php echo $selectedStudent === $studentIdentifier ? 'selected' : ''; ?>>
              <?php echo dsm_h($student['label']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </label>
      <label>
        <span>Score</span>
        <select name="score_mode">
          <?php foreach ($scoreModes as $scoreMode => $scoreModeLabel): ?>
            <option value="<?php echo dsm_h($scoreMode); ?>" <?php echo $selectedScoreMode === $scoreMode ? 'selected' : ''; ?>>
              <?php echo dsm_h($scoreModeLabel); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </label>
      <button class="button" type="submit">Apply</button>
      <a class="button secondary" href="/api/admin/report.php">Clear</a>
    </form>

    <p class="filter-summary"><?php echo count($rows); ?> row<?php echo count($rows) === 1 ? '' : 's'; ?> shown.</p>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th><button type="button" class="sort-header" data-sort-key="student">Student ID <span aria-hidden="true"></span></button></th>
            <th><button type="button" class="sort-header" data-sort-key="name">Name <span aria-hidden="true"></span></button></th>
            <th><button type="button" class="sort-header" data-sort-key="assignment">Assignment <span aria-hidden="true"></span></button></th>
            <th><button type="button" class="sort-header" data-sort-key="score"><?php echo dsm_h($scoreHeader); ?> <span aria-hidden="true"></span></button></th>
            <th><button type="button" class="sort-header" data-sort-key="attempts"><?php echo dsm_h($attemptHeader); ?> <span aria-hidden="true"></span></button></th>
            <th><button type="button" class="sort-header" data-sort-key="submitted"><?php echo dsm_h($submittedHeader); ?> <span aria-hidden="true"></span></button></th>
          </tr>
        </thead>
        <tbody id="score-report-rows">
        <?php if (count($rows) === 0): ?>
          <tr>
            <td class="empty" colspan="6">No scores match the selected filters.</td>
          </tr>
        <?php endif; ?>
        <?php foreach ($rows as $row): ?>
          <tr>
            <td data-sort-value="<?php echo dsm_h($row['student_identifier']); ?>"><?php echo dsm_h($row['student_identifier']); ?></td>
            <td data-sort-value="<?php echo dsm_h($row['display_name']); ?>"><?php echo dsm_h($row['display_name']); ?></td>
            <td data-sort-value="<?php echo dsm_h($row['quiz_id']); ?>"><?php echo dsm_h($row['quiz_id']); ?></td>
            <td data-sort-value="<?php echo dsm_h((string) ($row['best_score'] ?? '')); ?>"><?php echo dsm_h($row['best_score']); ?> / <?php echo dsm_h($row['max_score']); ?></td>
            <td data-sort-value="<?php echo dsm_h((string) ($row['attempt_count'] ?? '')); ?>"><?php echo dsm_h($row['attempt_count']); ?></td>
            <td data-sort-value="<?php echo dsm_h($row['last_submitted_at']); ?>"><?php echo dsm_h($row['last_submitted_at']); ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>
  <script>
  (function () {
    const sortKeys = ['student', 'name', 'assignment', 'score', 'attempts', 'submitted'];
    const numericKeys = new Set(['score', 'attempts']);
    const tbody = document.getElementById('score-report-rows');
    const buttons = document.querySelectorAll('.sort-header');
    let activeKey = null;
    let activeDirection = 'asc';

    function cellValue(row, key) {
      const index = sortKeys.indexOf(key);
      const cell = row.children[index];
      return cell ? cell.dataset.sortValue : '';
    }

    function compareValues(leftValue, rightValue, key) {
      if (numericKeys.has(key)) {
        const leftNumber = Number.parseFloat(leftValue);
        const rightNumber = Number.parseFloat(rightValue);
        if (Number.isFinite(leftNumber) && Number.isFinite(rightNumber)) {
          return leftNumber - rightNumber;
        }
      }
      return leftValue.localeCompare(rightValue, undefined, { numeric: true, sensitivity: 'base' });
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
          activeDirection = ['score', 'attempts', 'submitted'].includes(key) ? 'desc' : 'asc';
        }

        const direction = activeDirection === 'asc' ? 1 : -1;
        const rows = Array.from(tbody.querySelectorAll('tr'));
        rows.sort(function (left, right) {
          return compareValues(cellValue(left, key), cellValue(right, key), key) * direction;
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

function report_css(): string
{
    return dsm_admin_nav_css() . '
body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; color: #24292f; background: #f6f8fa; }
.shell { max-width: 1180px; margin: 0 auto; padding: 32px; }
h1 { margin: 0 0 8px; font-size: 28px; }
.topbar { display: flex; justify-content: space-between; gap: 16px; align-items: center; margin-bottom: 20px; }
.topbar p { margin: 0; color: #57606a; }
.filters { display: flex; flex-wrap: wrap; gap: 12px; align-items: flex-end; margin: 0 0 12px; }
.filters label { display: grid; gap: 6px; min-width: 0; width: max-content; font-size: 13px; font-weight: 700; color: #57606a; }
.filters select { width: max-content; max-width: 28rem; min-height: 40px; padding: 8px 34px 8px 10px; border: 1px solid #d0d7de; border-radius: 6px; background: white; color: #24292f; font: inherit; font-weight: 500; }
.button { display: inline-block; min-height: 40px; padding: 9px 14px; border: 1px solid #0969da; border-radius: 6px; background: #0969da; color: white; font: inherit; font-weight: 700; line-height: 20px; text-decoration: none; cursor: pointer; }
.button.secondary { background: white; color: #0969da; }
.filter-summary { margin: 0 0 12px; color: #57606a; font-size: 14px; }
.table-wrap { overflow-x: auto; border: 1px solid #d8dee4; border-radius: 8px; background: white; }
table { width: 100%; border-collapse: collapse; font-size: 14px; }
th, td { padding: 10px 12px; border-bottom: 1px solid #d8dee4; text-align: left; }
th { background: #f6f8fa; font-weight: 700; }
th:nth-child(4), td:nth-child(4), th:nth-child(5), td:nth-child(5) { width: 1%; white-space: nowrap; }
.empty { padding: 18px 12px; color: #57606a; text-align: center; }
.sort-header { display: inline-flex; align-items: center; gap: 6px; width: 100%; padding: 0; border: 0; background: transparent; color: #24292f; font: inherit; text-align: left; cursor: pointer; }
.sort-header span { display: inline-block; min-width: 1em; font-size: 11px; line-height: 1; color: #57606a; }
.sort-header:hover, .sort-header:focus { color: #0969da; outline: none; }
.sort-header:focus-visible { outline: 2px solid #0969da; outline-offset: 3px; border-radius: 3px; }
';
}
