@echo off
echo 🎯 STU Key Management - Final Setup
echo.

echo 1. Resetting database...
php artisan migrate:reset --force
if %errorlevel% neq 0 (
    echo ⚠️  Reset had warnings, continuing...
)

echo.
echo 2. Running fresh migration...
php artisan migrate:fresh --force
if %errorlevel% neq 0 (
    echo ❌ Migration failed!
    pause
    exit /b 1
)

echo.
echo 3. Seeding database...
php artisan db:seed --force
if %errorlevel% neq 0 (
    echo ❌ Seeding failed!
    pause
    exit /b 1
)

echo.
echo 4. Creating storage link...
php artisan storage:link
if %errorlevel% neq 0 (
    echo ⚠️  Storage link warning, continuing...
)

echo.
echo 5. Clearing caches...
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
