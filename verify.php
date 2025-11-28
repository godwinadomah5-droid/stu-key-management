<?php
// Final Verification Script
echo '=========================================' . PHP_EOL;
echo 'FINAL VERIFICATION' . PHP_EOL;
echo '=========================================' . PHP_EOL;

// Bootstrap Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Check APP_KEY
$appKey = config('app.key');
echo 'APP_KEY: ' . ($appKey && $appKey !== 'base64:your-generated-key-here' ? '✓ VALID' : '✗ INVALID') . PHP_EOL;

// Check Database
$dbPath = config('database.connections.sqlite.database');
echo 'Database Path: ' . $dbPath . PHP_EOL;
echo 'Database File: ' . (file_exists($dbPath) ? '✓ EXISTS' : '✗ MISSING') . PHP_EOL;

// Test Database Connection
try {
    DB::select('SELECT 1');
    echo 'Database Connection: ✓ SUCCESS' . PHP_EOL;
} catch (Exception $e) {
    echo 'Database Connection: ✗ FAILED - ' . $e->getMessage() . PHP_EOL;
}

echo '=========================================' . PHP_EOL;
echo 'VERIFICATION COMPLETE' . PHP_EOL;
echo '=========================================' . PHP_EOL;
