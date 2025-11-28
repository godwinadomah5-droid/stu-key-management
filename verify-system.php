<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🔍 Verifying STU Key Management System Setup...\n\n";

// Check if middleware is registered
try {
    $middleware = app('router')->getMiddleware();
    echo "✅ Middleware registry loaded\n";
    
    if (isset($middleware['role'])) {
        echo "✅ 'role' middleware registered\n";
    } else {
        echo "❌ 'role' middleware NOT registered\n";
    }
    
    if (isset($middleware['role_or_permission'])) {
        echo "✅ 'role_or_permission' middleware registered\n";
    } else {
        echo "❌ 'role_or_permission' middleware NOT registered\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error checking middleware: " . $e->getMessage() . "\n";
}

// Check if routes are loaded
try {
    $routes = app('router')->getRoutes()->getRoutes();
    echo "✅ Routes loaded (" . count($routes) . " routes found)\n";
    
    $keyRoutes = array_filter($routes, function($route) {
        return strpos($route->uri, 'keys') !== false;
    });
    echo "✅ Key routes found (" . count($keyRoutes) . " routes)\n";
    
} catch (Exception $e) {
    echo "❌ Error checking routes: " . $e->getMessage() . "\n";
}

// Check database connection and users
try {
    $userCount = \App\Models\User::count();
    echo "✅ Database connected ({$userCount} users found)\n";
    
    $adminUser = \App\Models\User::where('email', 'admin@stu.edu.gh')->first();
    if ($adminUser) {
        echo "✅ Admin user exists\n";
        echo "   👤 Name: {$adminUser->name}\n";
        echo "   📧 Email: {$adminUser->email}\n";
        echo "   🔑 Roles: " . $adminUser->getRoleNames()->implode(', ') . "\n";
    } else {
        echo "❌ Admin user not found\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error checking database: " . $e->getMessage() . "\n";
}

echo "\n🎉 Verification complete!\n";
echo "📱 Try accessing: http://127.0.0.1:8000\n";
echo "🔑 Login with: admin@stu.edu.gh / admin123\n";
