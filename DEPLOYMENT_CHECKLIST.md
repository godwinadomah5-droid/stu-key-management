# STU Key Management System - Deployment Checklist
# ===============================================

## Pre-Deployment Setup
✅ [ ] Run: composer install --optimize-autoloader --no-dev
✅ [ ] Run: php artisan key:generate
✅ [ ] Run: php artisan storage:link
✅ [ ] Run: php artisan migrate --seed
✅ [ ] Run: php artisan config:cache
✅ [ ] Run: php artisan route:cache
✅ [ ] Run: php artisan view:cache

## Environment Configuration
✅ [ ] Configure database connection in .env
✅ [ ] Set APP_ENV=production
✅ [ ] Set APP_DEBUG=false
✅ [ ] Configure mail settings
✅ [ ] Set up queue workers (supervisor recommended)
✅ [ ] Configure SMS provider (Hubtel) credentials
✅ [ ] Set up SSL certificate

## File Permissions
✅ [ ] storage/ - 755 (recursive)
✅ [ ] bootstrap/cache/ - 755
✅ [ ] public/uploads/ - 755

## Security Hardening
✅ [ ] Change default user passwords
✅ [ ] Set strong app key
✅ [ ] Configure proper CORS settings
✅ [ ] Set up rate limiting
✅ [ ] Configure backup strategy

## Testing
✅ [ ] Test all user roles (Admin, HR, Security, Auditor)
✅ [ ] Test key checkout/checkin flow
✅ [ ] Test QR code scanning
✅ [ ] Test CSV imports
✅ [ ] Test SMS notifications
✅ [ ] Test offline functionality
✅ [ ] Test report generation
✅ [ ] Test API endpoints

## Monitoring
✅ [ ] Set up error tracking (Sentry/Laravel Telescope)
✅ [ ] Configure log rotation
✅ [ ] Set up performance monitoring
✅ [ ] Configure backup monitoring

## PWA Setup
✅ [ ] Verify service worker registration
✅ [ ] Test offline functionality
✅ [ ] Validate manifest.json
✅ [ ] Test install prompt

## Go-Live Checklist
✅ [ ] Final data migration
✅ [ ] DNS configuration
✅ [ ] SSL certificate installed
✅ [ ] Load testing completed
✅ [ ] User training conducted
✅ [ ] Support procedures established

## Post-Deployment
✅ [ ] Monitor system performance
✅ [ ] Check error logs regularly
✅ [ ] Verify backup procedures
✅ [ ] User feedback collection
✅ [ ] Performance optimization

# Default Login Credentials
- Admin: admin@stu.edu.gh / admin123
- HR: hr@stu.edu.gh / hr123  
- Security: security@stu.edu.gh / security123
- Auditor: auditor@stu.edu.gh / auditor123

# Emergency Contacts
- System Admin: [Admin Name] - [Phone]
- IT Support: [Support Name] - [Phone]
- Security Lead: [Security Name] - [Phone]
