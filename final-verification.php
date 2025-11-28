<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🎯 STU Key Management System - Final Verification\n";
echo "================================================\n\n";

// Test 1: Database and Users
echo "🔐 Testing Authentication & Users...\n";
try {
    $users = \App\Models\User::all();
    echo "✅ Database connected - {$users->count()} users found\n";
    
    foreach ($users as $user) {
        $roles = $user->getRoleNames()->implode(', ');
        echo "   👤 {$user->name} ({$user->email}) - Roles: {$roles}\n";
    }
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n";
}

// Test 2: Key Routes
echo "\n🔑 Testing Key Routes...\n";
$routesToTest = [
    '/keys' => 'Key Management',
    '/kiosk' => 'Kiosk Interface', 
    '/hr/dashboard' => 'HR Dashboard',
    '/reports' => 'Reports',
    '/admin/users' => 'Admin Users',
];

foreach ($routesToTest as $route => $description) {
    try {
        $request = Illuminate\Http\Request::create($route, 'GET');
        $response = app()->handle($request);
        
        if ($response->getStatusCode() === 200) {
            echo "✅ {$description}: Accessible\n";
        } else {
            echo "❌ {$description}: HTTP {$response->getStatusCode()}\n";
        }
    } catch (Exception $e) {
        echo "❌ {$description}: Error - " . $e->getMessage() . "\n";
    }
}

// Test 3: Core Models
echo "\n🏗️ Testing Core Models...\n";
$modelsToTest = [
    'Key' => \App\Models\Key::class,
    'Location' => \App\Models\Location::class,
    'HrStaff' => \App\Models\HrStaff::class,
    'KeyLog' => \App\Models\KeyLog::class,
];

foreach ($modelsToTest as $name => $class) {
    try {
        $count = $class::count();
        echo "✅ {$name}: {$count} records\n";
    } catch (Exception $e) {
        echo "❌ {$name}: Error - " . $e->getMessage() . "\n";
    }
}

echo "\n🎉 VERIFICATION COMPLETE!\n";
echo "=======================\n";
echo "📱 System URL: http://127.0.0.1:8000\n";
echo "🔑 Default Logins:\n";
echo "   • Admin: admin@stu.edu.gh / admin123\n";
echo "   • Security: security@stu.edu.gh / security123\n";
echo "   • HR: hr@stu.edu.gh / hr123\n";
echo "   • Auditor: auditor@stu.edu.gh / auditor123\n";
echo "\n🚀 Next Steps:\n";
echo "   1. Test key checkout/checkin in the kiosk\n";
echo "   2. Import HR staff via CSV\n";
echo "   3. Generate QR codes for keys\n";
echo "   4. Test reporting features\n";
echo "\n💡 Remember: Role-based access is temporarily disabled\n";
echo "   All authenticated users can access all features for now.\n";
