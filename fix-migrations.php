<?php
// fix-migrations.php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "🔧 Fixing STU Key Management Migrations...\n";

// Drop all tables in correct order to avoid foreign key constraints
$tables = [
    'notifications',
    'analytics_cache',
    'key_logs',
    'key_tags', 
    'keys',
    'temporary_staff',
    'permanent_staff_manual',
    'hr_staff',
    'locations',
    'security_shifts',
    'model_has_permissions',
    'model_has_roles',
    'role_has_permissions',
    'permissions',
    'roles',
    'users',
    'settings',
    'failed_jobs',
    'jobs',
    'migrations'
];

foreach ($tables as $table) {
    if (Schema::hasTable($table)) {
        try {
            Schema::dropIfExists($table);
            echo "✅ Dropped table: $table\n";
        } catch (Exception $e) {
            echo "⚠️ Could not drop $table: " . $e->getMessage() . "\n";
        }
    }
}

// Run migrations in correct order
echo "\n🗃️ Running migrations in correct order...\n";

$migrations = [
    '0000_00_00_000000_create_users_table.php',
    '0000_00_00_000001_create_permission_tables.php',
    '0000_00_00_000002_create_security_shifts_table.php', 
    '0000_00_00_000003_create_locations_table.php',
    '0000_00_00_000004_create_keys_table.php', // Without foreign key to key_logs
    '0000_00_00_000005_create_key_tags_table.php',
    '0000_00_00_000006_create_hr_staff_table.php',
    '0000_00_00_000007_create_permanent_staff_manual_table.php',
    '0000_00_00_000008_create_temporary_staff_table.php',
    '0000_00_00_000009_create_key_logs_table.php', // Without circular foreign keys
    '0000_00_00_000010_create_notifications_table.php',
    '0000_00_00_000011_create_analytics_cache_table.php',
    '0000_00_00_000012_create_settings_table.php',
    '0000_00_00_000013_create_failed_jobs_table.php',
    '0000_00_00_000014_create_jobs_table.php',
    '0000_00_00_000015_add_keys_foreign_keys.php', // Add keys foreign keys
    '0000_00_00_000016_add_key_logs_foreign_keys.php', // Add key_logs foreign keys
];

foreach ($migrations as $migration) {
    $path = database_path('migrations/' . $migration);
    if (file_exists($path)) {
        echo "Running: $migration\n";
        try {
            Artisan::call('migrate', ['--path' => 'database/migrations/' . $migration, '--force' => true]);
            echo "✅ Success: $migration\n";
        } catch (Exception $e) {
            echo "❌ Failed: $migration - " . $e->getMessage() . "\n";
        }
    } else {
        echo "⚠️ Missing: $migration\n";
    }
}

// Seed the database
echo "\n🌱 Seeding database...\n";
try {
    Artisan::call('db:seed', ['--force' => true]);
    echo "✅ Database seeded successfully!\n";
} catch (Exception $e) {
    echo "❌ Seeding failed: " . $e->getMessage() . "\n";
}

echo "\n🎉 Migration fix completed!\n";
echo "📋 Default users created:\n";
echo "   👑 Admin: admin@stu.edu.gh / admin123\n";
echo "   👥 HR: hr@stu.edu.gh / hr123\n"; 
echo "   🛡️ Security: security@stu.edu.gh / security123\n";
echo "   📊 Auditor: auditor@stu.edu.gh / auditor123\n";
