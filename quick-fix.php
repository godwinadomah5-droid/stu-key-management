<?php

// Quick fix for middleware registration
echo "🔧 Applying middleware fixes...\n";

// Clear route cache
Artisan::call('route:clear');
echo "✅ Route cache cleared\n";

// Clear config cache  
Artisan::call('config:clear');
echo "✅ Config cache cleared\n";

// Cache the new routes
Artisan::call('route:cache');
echo "✅ Routes cached\n";

echo "🎉 Middleware fixes applied! The application should now work properly.\n";
echo "📋 Test the following URLs:\n";
echo "   - http://127.0.0.1:8000/keys (should work for admin/hr/security)\n";
echo "   - http://127.0.0.1:8000/kiosk (should work for security only)\n";
echo "   - http://127.0.0.1:8000/admin (should work for admin only)\n";
