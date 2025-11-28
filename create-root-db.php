<?php
// create-root-db.php
$dbFile = 'database.sqlite';

echo "🔧 Creating SQLite database in root directory...\n";

// Remove any existing file
if (file_exists($dbFile)) {
    unlink($dbFile);
    echo "✅ Removed existing database file\n";
}

// Method 1: Try SQLite3 class first
if (class_exists('SQLite3')) {
    try {
        $db = new SQLite3($dbFile);
        if ($db) {
            // Test by creating and dropping a table
            $db->exec('CREATE TABLE IF NOT EXISTS test_init (id INTEGER PRIMARY KEY)');
            $db->exec('DROP TABLE test_init');
            $db->close();
            echo "✅ SQLite3: Database created successfully!\n";
        }
    } catch (Exception $e) {
        echo "❌ SQLite3 failed: " . $e->getMessage() . "\n";
    }
} else {
    echo "❌ SQLite3 class not available\n";
}

// Method 2: Try PDO
try {
    $pdo = new PDO('sqlite:' . $dbFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ATTR_ERRMODE_EXCEPTION);
    
    // Test the connection
    $pdo->exec('CREATE TABLE test_pdo (id INTEGER)');
    $pdo->exec('DROP TABLE test_pdo');
    
    echo "✅ PDO: Database created and tested!\n";
} catch (Exception $e) {
    echo "❌ PDO failed: " . $e->getMessage() . "\n";
    
    // Method 3: Simple file creation as last resort
    if (touch($dbFile)) {
        chmod($dbFile, 0666);
        echo "✅ Created database file using touch()\n";
    } else {
        echo "❌ All methods failed!\n";
        exit(1);
    }
}

// Verify final result
if (file_exists($dbFile)) {
    $size = filesize($dbFile);
    echo "📊 Final database file: " . realpath($dbFile) . " ($size bytes)\n";
    echo "🎉 SQLite database ready!\n";
} else {
    echo "❌ Database file was not created\n";
    exit(1);
}
