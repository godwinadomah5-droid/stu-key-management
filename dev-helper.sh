#!/bin/bash
# dev-helper.sh - STU Key Management Development Helper

echo "🔧 STU Key Management - Development Helper"
echo "=========================================="

case "$1" in
    "start")
        echo "🚀 Starting development server..."
        php artisan serve
        ;;
    "migrate")
        echo "🗃️ Running migrations..."
        php artisan migrate:fresh --seed
        ;;
    "clear")
        echo "🗑️ Clearing all caches..."
        php artisan view:clear
        php artisan config:clear
        php artisan cache:clear
        php artisan route:clear
        echo "✅ All caches cleared!"
        ;;
    "test")
        echo "🧪 Running tests..."
        php artisan test
        ;;
    "health")
        echo "🔍 System health check..."
        php artisan about
        echo ""
        echo "📊 Database status:"
        php artisan db:show
        ;;
    *)
        echo "Usage: $0 {start|migrate|clear|test|health}"
        echo ""
        echo "Commands:"
        echo "  start   - Start development server"
        echo "  migrate - Fresh migrate and seed database"
        echo "  clear   - Clear all caches"
        echo "  test    - Run tests"
        echo "  health  - System health check"
        ;;
esac
