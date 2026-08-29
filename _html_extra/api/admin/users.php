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
    $action = (string) ($_POST['action'] ?? '');
    try {
        if ($action === 'update_user') {
            update_user($pdo, $admin);
            $notice = 'User updated.';
        } elseif ($action === 'add_user') {
            add_user($pdo);
            $notice = 'User added.';
        }
    } catch (Throwable $exception) {
        $error = $exception->getMessage();
    }
}

$users = list_users($pdo);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Management</title>
  <style><?php echo users_css(); ?></style>
</head>
<body>
  <main class="shell">
    <header class="topbar">
      <div>
        <h1>User Management</h1>
        <p>Assign roles and manage account status.</p>
      </div>
      <nav>
        <a class="button secondary" href="/api/admin/">Attempts</a>
        <a class="button secondary" href="/api/admin/report.php">Score Report</a>
        <a class="button secondary" href="/api/admin/assignments.php">Assignments</a>
        <a class="button secondary" href="/api/admin/logout.php">Log out</a>
      </nav>
    </header>

    <?php if ($notice !== null): ?><p class="alert ok"><?php echo dsm_h($notice); ?></p><?php endif; ?>
    <?php if ($error !== null): ?><p class="alert error"><?php echo dsm_h($error); ?></p><?php endif; ?>

    <section class="status-note" aria-label="Status definitions">
      <p><strong>Active</strong> means the account is eligible to sign in and submit work. If email verification is required, the student must still verify before signing in. <strong>Inactive</strong> blocks sign-in and authenticated submissions without deleting the user or past attempts.</p>
    </section>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Email</th>
            <th>Name</th>
            <th>Student ID</th>
            <th>Role</th>
            <th>Status</th>
            <th>Verified</th>
            <th>Last login</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
          <?php $isSelf = (int) $user['id'] === (int) $admin['id']; ?>
          <tr class="user-row" tabindex="0" onclick="document.getElementById('user-dialog-<?php echo dsm_h($user['id']); ?>').showModal()" onkeydown="if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); this.click(); }">
            <td><?php echo dsm_h($user['email']); ?></td>
            <td><?php echo dsm_h($user['display_name']); ?></td>
            <td><?php echo dsm_h($user['student_identifier']); ?></td>
            <td><span class="badge"><?php echo dsm_h($user['role']); ?></span></td>
            <td><span class="badge <?php echo $user['status'] === 'active' ? 'ok-badge' : 'muted-badge'; ?>"><?php echo dsm_h($user['status']); ?></span></td>
            <td><?php echo $user['email_verified_at'] ? dsm_h($user['email_verified_at']) : 'no'; ?></td>
            <td><?php echo $user['last_login_at'] ? dsm_h($user['last_login_at']) : ''; ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php foreach ($users as $user): ?>
      <?php $isSelf = (int) $user['id'] === (int) $admin['id']; ?>
      <dialog class="user-dialog" id="user-dialog-<?php echo dsm_h($user['id']); ?>">
        <form method="post" class="modal-form">
          <input type="hidden" name="action" value="update_user">
          <input type="hidden" name="id" value="<?php echo dsm_h($user['id']); ?>">
          <div>
            <h2>Edit User</h2>
            <p><?php echo dsm_h($user['email']); ?></p>
          </div>
          <label>Name <input name="display_name" value="<?php echo dsm_h($user['display_name']); ?>"></label>
          <label>Student ID <input name="student_identifier" value="<?php echo dsm_h($user['student_identifier']); ?>"></label>
          <label>Role
            <select name="role" <?php echo $isSelf ? 'disabled' : ''; ?>>
              <option value="student" <?php echo $user['role'] === 'student' ? 'selected' : ''; ?>>student</option>
              <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>admin</option>
            </select>
            <?php if ($isSelf): ?><input type="hidden" name="role" value="admin"><?php endif; ?>
          </label>
          <label>Status
            <select name="status" <?php echo $isSelf ? 'disabled' : ''; ?>>
              <option value="active" <?php echo $user['status'] === 'active' ? 'selected' : ''; ?>>active</option>
              <option value="inactive" <?php echo $user['status'] === 'inactive' ? 'selected' : ''; ?>>inactive</option>
            </select>
            <?php if ($isSelf): ?><input type="hidden" name="status" value="active"><?php endif; ?>
          </label>
          <div class="dialog-actions">
            <button type="button" class="button secondary" onclick="this.closest('dialog').close()">Cancel</button>
            <button type="submit">Save</button>
          </div>
        </form>
      </dialog>
    <?php endforeach; ?>
  </main>
</body>
</html>
<?php

function list_users(PDO $pdo): array
{
    $stmt = $pdo->query(
        'SELECT id, email, display_name, role, status, student_identifier, email_verified_at, last_login_at, created_at
         FROM quiz_users
         ORDER BY role ASC, student_identifier ASC, email ASC'
    );
    return $stmt->fetchAll();
}

function update_user(PDO $pdo, array $admin): void
{
    $id = (int) ($_POST['id'] ?? 0);
    if ($id <= 0) {
        throw new RuntimeException('Missing user.');
    }

    $role = normalize_choice((string) ($_POST['role'] ?? 'student'), ['student', 'admin']);
    $status = normalize_choice((string) ($_POST['status'] ?? 'active'), ['active', 'inactive']);
    if ($id === (int) $admin['id']) {
        $role = 'admin';
        $status = 'active';
    }

    $stmt = $pdo->prepare(
        'UPDATE quiz_users
         SET display_name = :display_name,
             student_identifier = :student_identifier,
             role = :role,
             status = :status
         WHERE id = :id'
    );
    $stmt->execute([
        'display_name' => trim((string) ($_POST['display_name'] ?? '')),
        'student_identifier' => null_if_empty(dsm_normalize_student_identifier((string) ($_POST['student_identifier'] ?? ''))),
        'role' => $role,
        'status' => $status,
        'id' => $id,
    ]);
}

function add_user(PDO $pdo): void
{
    $email = strtolower(trim((string) ($_POST['email'] ?? '')));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new RuntimeException('Enter a valid email.');
    }
    $role = normalize_choice((string) ($_POST['role'] ?? 'student'), ['student', 'admin']);
    $status = normalize_choice((string) ($_POST['status'] ?? 'active'), ['active', 'inactive']);

    $stmt = $pdo->prepare(
        'INSERT INTO quiz_users (email, display_name, role, status, student_identifier, password_hash)
         VALUES (:email, :display_name, :role, :status, :student_identifier, NULL)'
    );
    $stmt->execute([
        'email' => $email,
        'display_name' => trim((string) ($_POST['display_name'] ?? '')),
        'role' => $role,
        'status' => $status,
        'student_identifier' => null_if_empty(dsm_normalize_student_identifier((string) ($_POST['student_identifier'] ?? ''))),
    ]);
}

function normalize_choice(string $value, array $allowed): string
{
    if (!in_array($value, $allowed, true)) {
        throw new RuntimeException('Invalid value.');
    }
    return $value;
}

function null_if_empty(string $value): ?string
{
    return $value === '' ? null : $value;
}

function users_css(): string
{
    return '
body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; color: #24292f; background: #f6f8fa; }
.shell { max-width: 1180px; margin: 0 auto; padding: 32px; }
h1 { margin: 0 0 8px; font-size: 28px; }
h2 { margin: 0 0 12px; font-size: 18px; }
.topbar { display: flex; justify-content: space-between; gap: 16px; align-items: center; margin-bottom: 20px; }
.topbar p { margin: 0; color: #57606a; }
label { display: grid; gap: 6px; font-weight: 600; }
input, select { width: 100%; box-sizing: border-box; padding: 8px; border: 1px solid #d0d7de; border-radius: 6px; font: inherit; }
button, .button { display: inline-block; padding: 9px 12px; border: 1px solid #0969da; border-radius: 6px; background: #0969da; color: white; font-weight: 700; text-decoration: none; cursor: pointer; white-space: nowrap; }
.button.secondary { background: white; color: #0969da; }
.alert { padding: 12px 14px; border-radius: 6px; font-weight: 600; }
.alert.error { background: #ffebe9; color: #cf222e; }
.alert.ok { background: #dafbe1; color: #116329; }
.status-note { background: #fff; border: 1px solid #d8dee4; border-radius: 8px; padding: 12px 14px; margin: 0 0 18px; }
.status-note p { color: #24292f; font-size: 14px; line-height: 1.45; margin: 0; }
.status-note strong { font-weight: 700; }
.table-wrap { overflow-x: auto; border: 1px solid #d8dee4; border-radius: 8px; background: white; }
table { width: 100%; border-collapse: collapse; font-size: 14px; }
th, td { padding: 10px 12px; border-bottom: 1px solid #d8dee4; text-align: left; vertical-align: middle; }
th { background: #f6f8fa; font-weight: 700; }
.user-row { cursor: pointer; }
.user-row:hover, .user-row:focus { background: #f6f8fa; outline: none; }
.badge { display: inline-block; padding: 3px 8px; border-radius: 999px; background: #f6f8fa; border: 1px solid #d8dee4; font-weight: 700; }
.ok-badge { color: #116329; background: #dafbe1; border-color: #aceebb; }
.muted-badge { color: #57606a; }
.user-dialog { width: min(480px, calc(100vw - 32px)); border: 1px solid #d8dee4; border-radius: 8px; padding: 0; box-shadow: 0 16px 48px rgba(31, 35, 40, 0.22); }
.user-dialog::backdrop { background: rgba(31, 35, 40, 0.35); }
.modal-form { display: grid; gap: 16px; padding: 20px; }
.modal-form h2 { margin: 0 0 4px; }
.modal-form p { margin: 0; color: #57606a; overflow-wrap: anywhere; }
.dialog-actions { display: flex; justify-content: flex-end; gap: 10px; }
@media (max-width: 900px) { .topbar { align-items: flex-start; flex-direction: column; } }
';
}
