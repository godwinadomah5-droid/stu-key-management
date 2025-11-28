<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// Create admin user if doesn't exist
$admin = User::firstOrCreate(
    ['email' => 'admin@stu.edu.gh'],
    [
        'name' => 'System Administrator',
        'phone' => '0234567890',
        'password' => Hash::make('admin123'),
        'email_verified_at' => now(),
    ]
);

// Assign admin role
if ($admin->wasRecentlyCreated) {
    $admin->assignRole('admin');
    echo "Admin user created successfully!\n";
    echo "Email: admin@stu.edu.gh\n";
    echo "Password: admin123\n";
} else {
    echo "Admin user already exists.\n";
}

// Check if Spatie roles are set up
try {
    $roles = DB::table('roles')->get();
    if ($roles->isEmpty()) {
        echo "No roles found. Please run: php artisan db:seed --class=RolePermissionSeeder\n";
    } else {
        echo "Roles found: " . $roles->count() . "\n";
    }
} catch (Exception $e) {
    echo "Roles table might not exist: " . $e->getMessage() . "\n";
}
