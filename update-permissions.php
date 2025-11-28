<?php
// Run this command: php artisan db:seed --class=RolePermissionSeeder

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Artisan;

Artisan::call('db:seed', ['--class' => 'RolePermissionSeeder']);

echo "Permissions updated successfully!\n";
echo "Role Privileges Summary:\n";
echo "========================\n";
echo "ADMIN: Full system access - Can do everything\n";
echo "HR: Staff management + reports - Cannot manage keys/locations/users\n";  
echo "SECURITY: Kiosk operations only - Can process transactions, view basic info\n";
echo "AUDITOR: Read-only access - Can view everything but cannot modify\n";
echo "========================\n";
