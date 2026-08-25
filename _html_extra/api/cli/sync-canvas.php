#!/usr/bin/env php
<?php
declare(strict_types=1);

require_once __DIR__ . '/../lib/quiz-app.php';

if (PHP_SAPI !== 'cli') {
    fwrite(STDERR, "This script must be run from the command line.\n");
    exit(1);
}

$limit = 100;
foreach ($argv as $argument) {
    if (str_starts_with($argument, '--limit=')) {
        $limit = max(1, (int) substr($argument, 8));
    }
}

$config = dsm_load_config();
$pdo = dsm_database_ready($config);
$summary = dsm_sync_pending_attempts($pdo, $config, $limit);

printf(
    "Canvas sync complete: %d synced, %d failed, %d skipped, %d checked.\n",
    $summary['synced'],
    $summary['failed'],
    $summary['skipped'],
    $summary['checked']
);
