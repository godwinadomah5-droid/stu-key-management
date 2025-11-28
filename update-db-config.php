<?php
// update-db-config.php
$configFile = 'config/database.php';
$content = file_get_contents($configFile);

// Replace the SQLite database path to use absolute path
$currentDir = __DIR__;
$newContent = str_replace(
    "database_path('database.sqlite')",
    "'$currentDir/database.sqlite'",
    $content
);

file_put_contents($configFile, $newContent);
echo "✅ Database configuration updated to use absolute path\n";

// Test the configuration
echo "🔍 Testing database file...\n";
echo "SQLite path: $currentDir/database.sqlite\n";
echo "File exists: " . (file_exists("$currentDir/database.sqlite") ? 'YES' : 'NO') . "\n";
