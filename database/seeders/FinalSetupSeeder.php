<?php
// database/seeders/FinalSetupSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class FinalSetupSeeder extends Seeder
{
    public function run()
    {
        // System Settings
        $settings = [
            // General Settings
            ['key' => 'school_name', 'value' => 'STU University', 'type' => 'string', 'group' => 'general', 'description' => 'Institution name'],
            ['key' => 'school_logo', 'value' => '', 'type' => 'string', 'group' => 'general', 'description' => 'School logo path'],
            ['key' => 'timezone', 'value' => 'Africa/Accra', 'type' => 'string', 'group' => 'general', 'description' => 'System timezone'],
            
            // Notification Settings
            ['key' => 'notifications.checkout_enabled', 'value' => 'true', 'type' => 'boolean', 'group' => 'notifications', 'description' => 'Enable checkout notifications'],
            ['key' => 'notifications.return_enabled', 'value' => 'true', 'type' => 'boolean', 'group' => 'notifications', 'description' => 'Enable return notifications'],
            ['key' => 'notifications.overdue_enabled', 'value' => 'true', 'type' => 'boolean', 'group' => 'notifications', 'description' => 'Enable overdue notifications'],
            
            // Notification Templates
            ['key' => 'notifications.checkout_template', 'value' => 'Key {KEY_LABEL} ({LOCATION}) checked out by {NAME} at {TIME}. Expected return: {DUE}.', 'type' => 'string', 'group' => 'notifications', 'description' => 'Checkout SMS template'],
            ['key' => 'notifications.return_template', 'value' => 'Thanks, {NAME}. Key {KEY_LABEL} returned at {TIME}.', 'type' => 'string', 'group' => 'notifications', 'description' => 'Return confirmation template'],
            ['key' => 'notifications.overdue_template', 'value' => 'Reminder: Key {KEY_LABEL} is overdue. Please return ASAP.', 'type' => 'string', 'group' => 'notifications', 'description' => 'Overdue reminder template'],
            
            // PWA Settings
            ['key' => 'pwa.offline_tolerance', 'value' => '4', 'type' => 'integer', 'group' => 'pwa', 'description' => 'Offline tolerance in hours'],
            ['key' => 'pwa.background_sync', 'value' => 'true', 'type' => 'boolean', 'group' => 'pwa', 'description' => 'Enable background sync'],
            
            // Security Policies
            ['key' => 'security.require_signature_checkout', 'value' => 'true', 'type' => 'boolean', 'group' => 'security', 'description' => 'Require signature for checkout'],
            ['key' => 'security.require_signature_checkin', 'value' => 'false', 'type' => 'boolean', 'group' => 'security', 'description' => 'Require signature for checkin'],
            ['key' => 'security.photo_optional', 'value' => 'true', 'type' => 'boolean', 'group' => 'security', 'description' => 'Make photos optional'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('System settings configured successfully!');
        $this->command->info('Default users created:');
        $this->command->info('👑 Admin: admin@stu.edu.gh / admin123');
        $this->command->info('👥 HR: hr@stu.edu.gh / hr123');
        $this->command->info('🛡️ Security: security@stu.edu.gh / security123');
        $this->command->info('📊 Auditor: auditor@stu.edu.gh / auditor123');
    }
}
