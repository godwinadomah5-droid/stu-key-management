<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\HandleCors as Middleware;

class HandleCors extends Middleware
{
    /**
     * The paths that should be accessible.
     *
     * @var array<int, string>
     */
    protected $paths = [
        'api/*',
    ];
}
