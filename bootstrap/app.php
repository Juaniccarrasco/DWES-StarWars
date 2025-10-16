<?php

use App\Http\Controllers\manteinanceController;
use App\Http\Controllers\pilotController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ManteinanceMiddleware;
use App\Http\Middleware\PilotMiddleware;
use App\Http\Middleware\PlanetMiddleware;
use App\Http\Middleware\ShipMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'manteinMid' => ManteinanceMiddleware::class,
            'pilotMid' => PilotMiddleware::class,
            'planetMid' => PlanetMiddleware::class,
            'shipMid' => ShipMiddleware::class,
            'adminMid' => AdminMiddleware::class,
            'userMid' => UserMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
