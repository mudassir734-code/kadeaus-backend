<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->appendToGroup('admin', [
        //     \App\Http\Middleware\Admin::class,
        // ]);
        // $middleware->appendToGroup('check.user', [
        //     \App\Http\Middleware\CheckUser::class,
        // ]);
        $middleware->alias([
            // 'BlockUser' => \App\Http\Middleware\BlockCheckMiddleware::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'authCheck' => \App\Http\Middleware\RedirectIfAuthenticated::class,

        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
