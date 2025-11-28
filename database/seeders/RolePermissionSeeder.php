<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Dashboard & Basic Access
            'access dashboard',
            'view basic stats',
            
            // Kiosk Operations
            'access kiosk',
            'process checkout',
            'process checkin',
            'scan keys',
            'search staff',
            'create temporary staff',
            'create permanent staff manual',
            
            // Key Management
            'view keys',
            'view key details',
            'manage keys',
            'generate qr codes',
            'print qr tags',
            'mark keys lost',
            'delete keys',
            
            // Location Management
            'view locations',
            'view location details',
            'manage locations',
            'delete locations',
            
            // HR Management
            'view hr dashboard',
            'view hr staff',
            'view hr staff details',
            'manage hr staff',
            'import staff',
            'view manual staff',
            'manage manual staff',
            'view temporary staff',
            'manage temporary staff',
            'resolve discrepancies',
            'bulk resolve discrepancies',
            
            // Reports & Analytics
            'view reports',
            'view key activity reports',
            'view current holders report',
            'view overdue keys report',
            'view staff activity report',
            'view security performance report',
            'view analytics dashboard',
            'export data',
            'export csv',
            'export excel',
            'export pdf',
            
            // User Management
            'view users',
            'view user profiles',
            'manage users',
            'create users',
            'edit users',
            'delete users',
            'manage roles',
            'assign roles',
            
            // System Administration
            'manage settings',
            'view system health',
            'view system logs',
            'manage system maintenance',
            
            // Profile & Personal
            'view own profile',
            'edit own profile',
            'change own password',
            'view own activity',
            'view own shift history',
            'start own shift',
            'end own shift',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // ==================== ADMIN ROLE ====================
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminPermissions = [
            // Full system access EXCEPT kiosk operations
            'access dashboard', 'view basic stats',
            
            // NO KIOSK ACCESS - Removed: access kiosk, process checkout, process checkin, scan keys, etc.
            
            // Key & Location Management
            'view keys', 'view key details', 'manage keys', 'generate qr codes', 'print qr tags', 
            'mark keys lost', 'delete keys',
            'view locations', 'view location details', 'manage locations', 'delete locations',
            
            // HR Management
            'view hr dashboard', 'view hr staff', 'view hr staff details', 'manage hr staff', 
            'import staff', 'view manual staff', 'manage manual staff', 'view temporary staff', 
            'manage temporary staff', 'resolve discrepancies', 'bulk resolve discrepancies',
            
            // Reports & Analytics
            'view reports', 'view key activity reports', 'view current holders report', 
            'view overdue keys report', 'view staff activity report', 'view security performance report', 
            'view analytics dashboard', 'export data', 'export csv', 'export excel', 'export pdf',
            
            // User & System Management
            'view users', 'view user profiles', 'manage users', 'create users', 'edit users', 
            'delete users', 'manage roles', 'assign roles',
            'manage settings', 'view system health', 'view system logs', 'manage system maintenance',
            
            // Personal
            'view own profile', 'edit own profile', 'change own password', 'view own activity', 
            'view own shift history', 
            // Admin cannot start/end shifts - removed: start own shift, end own shift
        ];
        $adminRole->syncPermissions($adminPermissions);

        // ==================== HR ROLE ====================
        $hrRole = Role::firstOrCreate(['name' => 'hr', 'guard_name' => 'web']);
        $hrPermissions = [
            // Dashboard & Basic
            'access dashboard', 'view basic stats',
            
            // Limited Kiosk (view only, no transactions)
            'view keys', 'view key details',
            'view locations', 'view location details',
            
            // Full HR Management
            'view hr dashboard', 'view hr staff', 'view hr staff details', 'manage hr staff',
            'import staff', 'view manual staff', 'manage manual staff', 'view temporary staff', 
            'manage temporary staff', 'resolve discrepancies', 'bulk resolve discrepancies',
            
            // Reports & Analytics (HR-focused)
            'view reports', 'view key activity reports', 'view current holders report', 
            'view overdue keys report', 'view staff activity report', 'view analytics dashboard',
            'export data', 'export csv', 'export excel', 'export pdf',
            
            // Personal
            'view own profile', 'edit own profile', 'change own password', 'view own activity',
        ];
        $hrRole->syncPermissions($hrPermissions);

        // ==================== SECURITY ROLE ====================
        $securityRole = Role::firstOrCreate(['name' => 'security', 'guard_name' => 'web']);
        $securityPermissions = [
            // Dashboard & Basic
            'access dashboard', 'view basic stats',
            
            // Full Kiosk Operations (EXCLUSIVE to Security)
            'access kiosk', 'process checkout', 'process checkin', 'scan keys', 'search staff',
            'create temporary staff', 'create permanent staff manual',
            
            // Key Management (operational only)
            'view keys', 'view key details', 'mark keys lost',
            'view locations', 'view location details',
            
            // Limited HR (view staff for verification)
            'view hr staff', 'view manual staff', 'view temporary staff',
            
            // Limited Reports (operational only)
            'view reports', 'view current holders report', 'view overdue keys report',
            'view key activity reports',
            
            // Personal & Shift Management (EXCLUSIVE to Security)
            'view own profile', 'edit own profile', 'change own password', 'view own activity',
            'view own shift history', 'start own shift', 'end own shift',
        ];
        $securityRole->syncPermissions($securityPermissions);

        // ==================== AUDITOR ROLE ====================
        $auditorRole = Role::firstOrCreate(['name' => 'auditor', 'guard_name' => 'web']);
        $auditorPermissions = [
            // Dashboard & Basic
            'access dashboard', 'view basic stats',
            
            // Read-only system access
            'view keys', 'view key details',
            'view locations', 'view location details',
            'view hr dashboard', 'view hr staff', 'view hr staff details', 
            'view manual staff', 'view temporary staff',
            
            // Full Reports & Analytics (read-only)
            'view reports', 'view key activity reports', 'view current holders report', 
            'view overdue keys report', 'view staff activity report', 'view security performance report', 
            'view analytics dashboard', 'export data', 'export csv', 'export excel', 'export pdf',
            
            // Personal
            'view own profile', 'edit own profile', 'change own password', 'view own activity',
        ];
        $auditorRole->syncPermissions($auditorPermissions);

        $this->command->info('Roles and permissions seeded successfully!');
        $this->command->info('Admin: Full system access EXCEPT kiosk operations');
        $this->command->info('HR: Staff management + reports (no kiosk)');
        $this->command->info('Security: Kiosk operations ONLY (exclusive access)');
        $this->command->info('Auditor: Read-only access + full reports (no kiosk)');
    }
}
