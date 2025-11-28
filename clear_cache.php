<?php
// Clear route cache script
echo "Clearing route cache...\n";
shell_exec('php artisan route:clear');
shell_exec('php artisan config:clear');
shell_exec('php artisan cache:clear');
echo "Cache cleared successfully!\n";
?>
