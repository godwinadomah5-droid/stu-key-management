# STU Key Management - Quick Setup

## Setup Commands:
1. composer install
2. cp .env.example .env
3. php artisan key:generate
4. Configure database in .env
5. php artisan migrate --seed
6. php artisan storage:link
7. php artisan serve

## Default Users:
- Admin: admin@stu.edu.gh / admin123
- Security: security@stu.edu.gh / security123
- HR: hr@stu.edu.gh / hr123
- Auditor: auditor@stu.edu.gh / auditor123

## Important:
- Change passwords before production!
- Configure SMS provider in .env
- Set APP_ENV=production for deployment
