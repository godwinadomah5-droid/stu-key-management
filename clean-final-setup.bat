@echo off
echo 🎯 STU Key Management - Clean Final Setup
echo.

echo 1. Running fresh migration and seeding...
php artisan migrate:fresh --seed --force
if %errorlevel% neq 0 (
    echo ❌ Setup failed!
    echo.
    echo 🔧 Trying alternative approach...
    php artisan migrate:reset --force
    php artisan migrate --force
    php artisan db:seed --class=RolePermissionSeeder --force
    php artisan db:seed --class=AdminUserSeeder --force
    php artisan db:seed --class=DemoDataSeeder --force
)

echo.
echo 2. Creating storage link...
php artisan storage:link

echo.
echo 3. Clearing caches...
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo.
echo 🎉 STU Key Management System Ready!
echo.
echo 📋 Default Login Credentials:
echo    👑 Admin: admin@stu.edu.gh / admin123
echo    👥 HR: hr@stu.edu.gh / hr123
echo    🛡️ Security: security@stu.edu.gh / security123
echo    📊 Auditor: auditor@stu.edu.gh / auditor123
echo.
echo 🚀 Starting development server...
echo 🌐 Open: http://localhost:8000
echo 🔑 Login with admin credentials above
echo.
php artisan serve
pause
