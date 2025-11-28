<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Events\MigrationsStarted;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Disable permission cache during migrations
        Event::listen(MigrationsStarted::class, function () {
            config(['permission.cache.enabled' => false]);
        });
    }
}