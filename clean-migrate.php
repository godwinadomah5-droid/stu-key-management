<?php
// clean-migrate.php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

echo "🧹 Cleaning up and running final migrations...\n";

// Remove any duplicate permission migrations
$files = glob(database_path('migrations/*create_permission_tables.php'));
foreach ($files as $file) {
    if (basename($file) !== '2014_10_12_100000_create_password_resets_table.php') {
        // Keep only the original Spatie migration
        if (strpos(basename($file), '2024_') === false && strpos(basename($file), '2025_') === false) {
            unlink($file);
            echo "✅ Removed duplicate: " . basename($file) . "\n";
        }
    }
}

// Run fresh migration
echo "\n🗃️ Running final migration...\n";
try {
    Artisan::call('migrate:fresh', ['--force' => true]);
    echo "✅ Migrations completed successfully!\n";
} catch (Exception $e) {
    echo "❌ Migration failed: " . $e->getMessage() . "\n";
    
    // Try alternative approach
    echo "\n🔄 Trying alternative migration approach...\n";
    Artisan::call('migrate:reset', ['--force' => true]);
    Artisan::call('migrate', ['--force' => true]);
}

// Seed the database
echo "\n🌱 Seeding database...\n";
try {
    Artisan::call('db:seed', ['--force' => true]);
    echo "✅ Database seeded successfully!\n";
} catch (Exception $e) {
    echo "❌ Seeding failed: " . $e->getMessage() . "\n";
}

echo "\n🎉 STU Key Management System Ready!\n";
echo "📋 Default Login Credentials:\n";
echo "   👑 Admin: admin@stu.edu.gh / admin123\n";
echo "   👥 HR: hr@stu.edu.gh / hr123\n";
echo "   🛡️ Security: security@stu.edu.gh / security123\n";
echo "   📊 Auditor: auditor@stu.edu.gh / auditor123\n";

echo "\n🚀 Next steps:\n";
echo "   1. Run: php artisan storage:link\n";
echo "   2. Run: php artisan serve\n";
echo "   3. Open: http://localhost:8000\n";
