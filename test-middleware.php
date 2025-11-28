<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🔍 Testing Middleware Registration...\n\n";

// Test 1: Check if custom middleware is registered
try {
    $kernel = app(\App\Http\Kernel::class);
    $middlewareAliases = $kernel->getMiddlewareAliases();
    
    echo "📋 Registered Middleware Aliases:\n";
    foreach ($middlewareAliases as $alias => $class) {
        echo "   {$alias} => {$class}\n";
    }
    
    if (isset($middlewareAliases['role'])) {
        echo "✅ SUCCESS: 'role' middleware is registered!\n";
    } else {
        echo "❌ FAILED: 'role' middleware is NOT registered\n";
    }
    
    if (isset($middlewareAliases['kiosk'])) {
        echo "✅ SUCCESS: 'kiosk' middleware is registered!\n";
    } else {
        echo "❌ FAILED: 'kiosk' middleware is NOT registered\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error checking middleware: " . $e->getMessage() . "\n";
}

// Test 2: Test if we can access keys route as admin
echo "\n🔐 Testing Route Access...\n";
try {
    $user = \App\Models\User::where('email', 'admin@stu.edu.gh')->first();
    if ($user) {
        auth()->login($user);
        echo "✅ Logged in as admin\n";
        
        // Test if user has required role
        if ($user->hasRole('admin')) {
            echo "✅ User has 'admin' role\n";
        } else {
            echo "❌ User does NOT have 'admin' role\n";
        }
        
        // Test route access
        $request = Illuminate\Http\Request::create('/keys', 'GET');
        $response = app()->handle($request);
        
        if ($response->getStatusCode() === 200) {
            echo "✅ SUCCESS: Can access /keys route\n";
        } else {
            echo "❌ FAILED: Cannot access /keys route (Status: {$response->getStatusCode()})\n";
        }
        
    } else {
        echo "❌ Admin user not found\n";
    }
} catch (Exception $e) {
    echo "❌ Error testing route access: " . $e->getMessage() . "\n";
}

echo "\n🎉 Test complete!\n";
