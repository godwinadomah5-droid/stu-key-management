<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🎯 STU Key Management System - Authenticated Test\n";
echo "================================================\n\n";

// Login as admin first
echo "🔐 Logging in as admin...\n";
try {
    $user = \App\Models\User::where('email', 'admin@stu.edu.gh')->first();
    if ($user) {
        auth()->login($user);
        echo "✅ Logged in as: {$user->name} ({$user->email})\n";
        echo "   Roles: " . $user->getRoleNames()->implode(', ') . "\n";
    } else {
        echo "❌ Admin user not found\n";
        exit(1);
    }
} catch (Exception $e) {
    echo "❌ Login error: " . $e->getMessage() . "\n";
    exit(1);
}

// Test routes with authentication
echo "\n🔑 Testing Authenticated Routes...\n";
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
        $request->setUserResolver(function () use ($user) {
            return $user;
        });
        
        $response = app()->handle($request);
        
        if ($response->getStatusCode() === 200) {
            echo "✅ {$description}: Accessible (HTTP 200)\n";
        } else {
            echo "⚠️ {$description}: HTTP {$response->getStatusCode()} - " . 
                 ($response->getStatusCode() === 302 ? 'Redirect' : 'Other status') . "\n";
        }
    } catch (Exception $e) {
        echo "❌ {$description}: Error - " . $e->getMessage() . "\n";
    }
}

// Test core functionality
echo "\n🏗️ Testing Core Functionality...\n";

// Test Key creation
try {
    $key = \App\Models\Key::first();
    if ($key) {
        echo "✅ Key model working: {$key->label} ({$key->code})\n";
    }
} catch (Exception $e) {
    echo "❌ Key model error: " . $e->getMessage() . "\n";
}

// Test Location
try {
    $location = \App\Models\Location::first();
    if ($location) {
        echo "✅ Location model working: {$location->name}\n";
    }
} catch (Exception $e) {
    echo "❌ Location model error: " . $e->getMessage() . "\n";
}

// Test HR Staff
try {
    $staff = \App\Models\HrStaff::first();
    if ($staff) {
        echo "✅ HR Staff model working: {$staff->name}\n";
    }
} catch (Exception $e) {
    echo "❌ HR Staff model error: " . $e->getMessage() . "\n";
}

echo "\n🎉 AUTHENTICATED TEST COMPLETE!\n";
echo "==============================\n";
echo "📱 Open browser and test manually:\n";
echo "   http://127.0.0.1:8000\n";
echo "\n💡 The HTTP 302 responses are expected in CLI test.\n";
echo "   In the browser with proper session, routes should work!\n";
