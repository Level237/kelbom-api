<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            // On charge le fichier vendeur
            Route::middleware('web')
                ->group(base_path('routes/seller.php'));

            // On charge le fichier admin
            Route::middleware('web')
                ->group(base_path('routes/admin.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //$middleware->statefulApi();  // ← Active le mode cookie pour les routes API
    
        // Enregistrer les alias de middleware
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            /** @deprecated alias — préférer seller.stand */
            'seller.access' => \App\Http\Middleware\EnsureSellerHasStand::class,
            'seller.stand' => \App\Http\Middleware\EnsureSellerHasStand::class,
            'seller.onboarding' => \App\Http\Middleware\EnsureSellerOnboarding::class,
            'seller.role' => \App\Http\Middleware\EnsureSellerRole::class,
        ]);

        // Ou de façon plus explicite (équivalent) :
        // $middleware->api(prepend: [
        //     \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn(Request $request) => $request->is('api/*'),
        );
    })->create();
