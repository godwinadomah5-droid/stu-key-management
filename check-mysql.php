<?php
// check-mysql.php
try {
    $host = '127.0.0.1';
    $username = 'root';
    $password = '';
    
    // Connect to MySQL server
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ATTR_ERRMODE_EXCEPTION);
    
    echo "✅ Connected to MySQL server successfully!\n";
    
    // Check if database exists
    $result = $pdo->query("SHOW DATABASES LIKE 'stu_keys'");
    if ($result->rowCount() > 0) {
        echo "✅ Database 'stu_keys' exists!\n";
    } else {
        // Create database
        $pdo->exec("CREATE DATABASE stu_keys");
        echo "✅ Database 'stu_keys' created successfully!\n";
    }
    
} catch (PDOException $e) {
    echo "❌ MySQL Connection failed: " . $e->getMessage() . "\n";
    echo "\n💡 SOLUTIONS:\n";
    echo "1. Start MySQL service (XAMPP/WAMP/Laragon)\n";
    echo "2. Install MySQL if not installed\n";
    echo "3. Check if MySQL is running on port 3306\n";
}
