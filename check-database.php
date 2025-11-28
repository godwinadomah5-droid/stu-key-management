<?php
// check-database.php

echo "🔍 Checking Database Configuration...\n";

// Check if .env file exists
if (!file_exists('.env')) {
    echo "❌ .env file not found!\n";
    exit(1);
}

// Read .env file
$envContent = file_get_contents('.env');
preg_match('/DB_HOST=(.*)/', $envContent, $hostMatches);
preg_match('/DB_PORT=(.*)/', $envContent, $portMatches);
preg_match('/DB_DATABASE=(.*)/', $envContent, $databaseMatches);
preg_match('/DB_USERNAME=(.*)/', $envContent, $usernameMatches);
preg_match('/DB_PASSWORD=(.*)/', $envContent, $passwordMatches);

$dbHost = trim($hostMatches[1] ?? '127.0.0.1');
$dbPort = trim($portMatches[1] ?? '3306');
$dbDatabase = trim($databaseMatches[1] ?? 'stu_key_management');
$dbUsername = trim($usernameMatches[1] ?? 'root');
$dbPassword = trim($passwordMatches[1] ?? '');

echo "📊 Database Configuration:\n";
echo "   Host: $dbHost\n";
echo "   Port: $dbPort\n";
echo "   Database: $dbDatabase\n";
echo "   Username: $dbUsername\n";
echo "   Password: " . (empty($dbPassword) ? '(empty)' : '***') . "\n";

// Test database connection
try {
    $dsn = "mysql:host=$dbHost;port=$dbPort";
    $pdo = new PDO($dsn, $dbUsername, $dbPassword);
    echo "✅ Connected to MySQL server successfully!\n";
    
    // Check if database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE '$dbDatabase'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Database '$dbDatabase' exists!\n";
    } else {
        echo "❌ Database '$dbDatabase' does not exist. Creating...\n";
        $pdo->exec("CREATE DATABASE $dbDatabase");
        echo "✅ Database '$dbDatabase' created successfully!\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    echo "\n💡 Troubleshooting Tips:\n";
    echo "   1. Make sure MySQL is running\n";
    echo "   2. Check if XAMPP/WAMP is started\n";
    echo "   3. Verify MySQL credentials\n";
    echo "   4. Try '127.0.0.1' instead of 'localhost'\n";
}
