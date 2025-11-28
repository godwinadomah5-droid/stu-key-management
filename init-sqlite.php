<?php
// init-sqlite.php
try {
    // Create a basic SQLite database with a test table
    $pdo = new PDO('sqlite:database/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ATTR_ERRMODE_EXCEPTION);
    
    // Test if we can create a table
    $pdo->exec('CREATE TABLE IF NOT EXISTS test (id INTEGER PRIMARY KEY)');
    $pdo->exec('DROP TABLE test');
    
    echo "✅ SQLite database initialized successfully!\n";
} catch (Exception $e) {
    echo "❌ SQLite initialization failed: " . $e->getMessage() . "\n";
    
    // Try alternative approach
    try {
        touch('database/database.sqlite');
        chmod('database/database.sqlite', 0666);
        echo "✅ Database file created with permissions\n";
    } catch (Exception $e2) {
        echo "❌ Alternative approach also failed: " . $e2->getMessage() . "\n";
    }
}
