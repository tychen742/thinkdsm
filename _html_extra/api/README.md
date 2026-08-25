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
];
```

For local development, if no config is found, the API uses SQLite at `/tmp/dsm_quiz_attempts.sqlite`.

## Later Canvas Sync

Pending or failed attempts can be synced after submission:

```bash
php /var/www/dsm/api/bin/sync-canvas.php --limit=100
```

Run the command from cron after production configuration is in place. The script reads the same `DSM_QUIZ_CONFIG` file, finds saved attempts with `pending` or `failed` status, sends the saved score to Canvas, and updates each row to `synced`, `failed`, or `skipped`.

Rows can only sync when they include `canvas_course_id`, `canvas_assignment_id`, and `canvas_user_id`. If the book is opened directly without Canvas/LTI launch parameters, attempts still save, but Canvas sync is marked `skipped` until those IDs are available.
