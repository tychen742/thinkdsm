# DSM Quiz API

This directory is copied into the published Jupyter Book by `./deploy`.

## Endpoint

`POST /api/v1/quiz-attempts.php`

Stores and grades a quiz attempt. If Canvas settings and Canvas IDs are available, the endpoint also attempts grade sync. Otherwise the attempt is saved with `pending` sync status.

The Chapter 01 preview page posts each student attempt to this endpoint. The browser does not contain the answer key; grading happens on the server.

Saved fields include:

- quiz ID, chapter, and assignment slug
- student identifier
- Canvas course, assignment, and user IDs when provided
- score and maximum score
- submitted answers and per-question feedback as JSON
- Canvas sync status and sync error
- submission timestamp, IP address, and user agent

## Production Configuration

Do not commit production secrets. Put configuration outside the repository, then point `DSM_QUIZ_CONFIG` to it or use the default path:

`/var/www/dsm_private/quiz_config.php`

On the current production server, `/home/tychen/dsm_private/quiz_config.php` is also supported. Keep that directory outside the public web root and grant Apache read access with a narrow ACL.

Example:

```php
<?php
return [
    'database' => [
        'driver' => 'mysql',
        'dsn' => 'mysql:host=127.0.0.1;dbname=dsm_quiz;charset=utf8mb4',
        'username' => 'dsm_quiz',
        'password' => 'CHANGE_ME',
    ],
    'canvas' => [
        'base_url' => 'https://YOUR_CANVAS_DOMAIN',
        'access_token' => 'CHANGE_ME',
        'enabled' => true,
    ],
    'auth' => [
        'bootstrap_admins' => [
            [
                'email' => 'you@example.edu',
                'display_name' => 'Your Name',
                'password_hash' => 'PASTE_PASSWORD_HASH_HERE',
            ],
        ],
    ],
];
```

Create the password hash on the server:

```bash
php -r 'echo password_hash("CHANGE_ME", PASSWORD_DEFAULT), PHP_EOL;'
```

For local development, if no config is found, the API tries SQLite at `/tmp/dsm_quiz_attempts.sqlite`. If the server does not have the needed PDO driver, the endpoint falls back to a newline-delimited JSON file at `/var/www/dsm_private/dsm_quiz_attempts.jsonl` so student submissions are still captured.

The JSONL fallback is a safety net, not the preferred production store. Configure MySQL/MariaDB before using the Canvas sync job for a class.

## Admin Gradebook

After the database and admin bootstrap config are in place, open:

`/api/admin/`

The admin module supports:

- password-protected admin login
- score table with student identifier, quiz, score, Canvas status, and submitted answers
- CSV export
- manual sync of pending or failed attempts to Canvas

The admin module requires a working PDO database connection. It does not read from the JSONL fallback store directly.

## Later Canvas Sync

Pending or failed attempts can be synced after submission:

```bash
php /var/www/dsm/api/cli/sync-canvas.php --limit=100
```

Run the command from cron after production configuration is in place. The script reads the same `DSM_QUIZ_CONFIG` file, finds saved attempts with `pending` or `failed` status, sends the saved score to Canvas, and updates each row to `synced`, `failed`, or `skipped`.

Rows can only sync when they include `canvas_course_id`, `canvas_assignment_id`, and `canvas_user_id`. If the book is opened directly without Canvas/LTI launch parameters, attempts still save, but Canvas sync is marked `skipped` until those IDs are available.
