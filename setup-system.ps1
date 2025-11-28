# STU Key Management System - Complete Setup Script for Windows/PowerShell

Write-Host "🚀 STU Key Management System - Complete Setup" -ForegroundColor Green
Write-Host "=============================================" -ForegroundColor Green

# Check if we're in a Laravel project
if (!(Test-Path "artisan")) {
    Write-Host "❌ Error: Not in a Laravel project directory" -ForegroundColor Red
    exit 1
}

# Generate application key
Write-Host "🔑 Generating application key..." -ForegroundColor Yellow
php artisan key:generate

# Run migrations
Write-Host "📊 Running migrations..." -ForegroundColor Yellow
php artisan migrate:fresh

# Seed the database
Write-Host "🌱 Seeding database..." -ForegroundColor Yellow
php artisan db:seed

# Create storage link
Write-Host "📁 Creating storage link..." -ForegroundColor Yellow
php artisan storage:link

# Publish vendor files
Write-Host "📦 Publishing vendor configurations..." -ForegroundColor Yellow
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"

# Clear caches
Write-Host "🧹 Clearing caches..." -ForegroundColor Yellow
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Generate IDE helper
Write-Host "💡 Generating IDE helper..." -ForegroundColor Yellow
php artisan ide-helper:generate
php artisan ide-helper:models --nowrite
php artisan ide-helper:meta

Write-Host "" -ForegroundColor Green
Write-Host "✅ Setup complete!" -ForegroundColor Green
Write-Host "" -ForegroundColor Green
Write-Host "📋 Default Login Credentials:" -ForegroundColor Cyan
Write-Host "   Admin:     admin@stu.edu.gh / admin123" -ForegroundColor White
Write-Host "   HR:        hr@stu.edu.gh / hr123" -ForegroundColor White
Write-Host "   Security:  security@stu.edu.gh / security123" -ForegroundColor White
Write-Host "   Auditor:   auditor@stu.edu.gh / auditor123" -ForegroundColor White
Write-Host "" -ForegroundColor Green
Write-Host "🚀 Start the development server:" -ForegroundColor Cyan
Write-Host "   php artisan serve" -ForegroundColor White
Write-Host "" -ForegroundColor Green
Write-Host "📱 Access the application at: http://localhost:8000" -ForegroundColor Cyan
Write-Host "" -ForegroundColor Green
Write-Host "🔧 Next steps:" -ForegroundColor Yellow
Write-Host "   1. Configure .env with your database and SMS settings" -ForegroundColor White
Write-Host "   2. Generate QR codes for keys in the admin panel" -ForegroundColor White
Write-Host "   3. Test the kiosk functionality" -ForegroundColor White
Write-Host "   4. Configure notification templates in settings" -ForegroundColor White
Write-Host "" -ForegroundColor Green
