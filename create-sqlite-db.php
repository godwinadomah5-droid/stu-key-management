<?php
// create-sqlite-db.php
try {
    $db = new PDO('sqlite:database/database.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ SQLite database created successfully!\n";
} catch (PDOException $e) {
    echo "❌ Failed to create SQLite database: " . $e->getMessage() . "\n";
}
