<?php
// final-setup.php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "🎯 Final STU Key Management Setup...\n\n";

// Step 1: Reset everything
echo "1. Resetting database...\n";
try {
    Artisan::call('migrate:reset', ['--force' => true]);
    echo "   ✅ Database reset\n";
} catch (Exception $e) {
    echo "   ⚠️ Reset warning: " . $e->getMessage() . "\n";
}

// Step 2: Run only our core migrations (in correct order)
echo "\n2. Running core migrations...\n";

$coreMigrations = [
    '0000_00_00_000000_create_users_table.php',
    '0000_00_00_000002_create_security_shifts_table.php',
    '0000_00_00_000003_create_locations_table.php',
    '0000_00_00_000004_create_keys_table.php',
    '0000_00_00_000005_create_key_tags_table.php',
    '0000_00_00_000006_create_hr_staff_table.php',
    '0000_00_00_000007_create_permanent_staff_manual_table.php',
    '0000_00_00_000008_create_temporary_staff_table.php',
    '0000_00_00_000009_create_key_logs_table.php',
    '0000_00_00_000010_create_notifications_table.php',
    '0000_00_00_000011_create_analytics_cache_table.php',
    '0000_00_00_000012_create_settings_table.php',
    '0000_00_00_000013_create_failed_jobs_table.php',
    '0000_00_00_000014_create_jobs_table.php',
    '0000_00_00_000015_add_keys_foreign_keys.php',
    '0000_00_00_000016_add_key_logs_foreign_keys.php'
];

foreach ($coreMigrations as $migration) {
    $path = database_path('migrations/' . $migration);
    if (file_exists($path)) {
        echo "   Running: $migration\n";
        try {
            Artisan::call('migrate', [
                '--path' => 'database/migrations/' . $migration,
                '--force' => true
            ]);
            echo "     ✅ Success\n";
        } catch (Exception $e) {
            echo "     ⚠️ Warning: " . $e->getMessage() . "\n";
        }
    } else {
        echo "   ❌ Missing: $migration\n";
    }
}

// Step 3: Run Spatie permissions migration separately
echo "\n3. Setting up permissions...\n";
try {
    // Publish Spatie migrations if not already done
    Artisan::call('vendor:publish', [
        '--provider' => 'Spatie\Permission\PermissionServiceProvider',
        '--tag' => 'permission-migrations',
        '--force' => true
    ]);
    
    // Run the Spatie migration
    Artisan::call('migrate', ['--force' => true]);
    echo "   ✅ Permissions setup\n";
} catch (Exception $e) {
    echo "   ⚠️ Permissions warning: " . $e->getMessage() . "\n";
}

// Step 4: Seed the database
echo "\n4. Seeding database...\n";
try {
    Artisan::call('db:seed', ['--force' => true]);
    echo "   ✅ Database seeded\n";
} catch (Exception $e) {
    echo "   ❌ Seeding failed: " . $e->getMessage() . "\n";
}

// Step 5: Final verification
echo "\n5. Final verification...\n";
$requiredTables = [
    'users', 'permissions', 'roles', 'model_has_permissions', 
    'model_has_roles', 'role_has_permissions', 'security_shifts',
    'locations', 'keys', 'key_tags', 'hr_staff', 'permanent_staff_manual',
    'temporary_staff', 'key_logs', 'notifications', 'analytics_cache', 'settings'
];

$allGood = true;
foreach ($requiredTables as $table) {
    if (Schema::hasTable($table)) {
        $count = DB::table($table)->count();
        echo "   ✅ $table ($count records)\n";
    } else {
        echo "   ❌ $table (MISSING)\n";
        $allGood = false;
    }
}

if ($allGood) {
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
    echo "   4. Login with admin credentials\n";
} else {
    echo "\n❌ Some tables are missing. Please check the errors above.\n";
}
