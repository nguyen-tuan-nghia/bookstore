<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'user' => \App\Http\Middleware\user_Middleware::class,
        'admin' => \App\Http\Middleware\admin_Middleware::class,
        //order
        'delivery.index' => \App\Http\Middleware\delivery\index::class,
        'delivery.create' => \App\Http\Middleware\delivery\create::class,
        'delivery.delete' => \App\Http\Middleware\delivery\delete::class,
        'delivery.update' => \App\Http\Middleware\delivery\update::class,
        //product
        'product.index' => \App\Http\Middleware\product\index::class,
        'product.create' => \App\Http\Middleware\product\create::class,
        'product.delete' => \App\Http\Middleware\product\delete::class,
        'product.update' => \App\Http\Middleware\product\update::class,
        //category
        'category.index' => \App\Http\Middleware\category\index::class,
        'category.create' => \App\Http\Middleware\category\create::class,
        'category.delete' => \App\Http\Middleware\category\delete::class,
        'category.update' => \App\Http\Middleware\category\update::class,
        //order
        'order.index' => \App\Http\Middleware\order\index::class,
        'order.detail' => \App\Http\Middleware\order\detail::class,
        'order.delete' => \App\Http\Middleware\order\delete::class,
        'order.update' => \App\Http\Middleware\order\update::class,
        //customer
        'customer.index' => \App\Http\Middleware\customer\index::class,
        //admin
        'admin.index' => \App\Http\Middleware\admin\index::class,
        'admin.delete' => \App\Http\Middleware\admin\delete::class,
        'admin.update' => \App\Http\Middleware\admin\update::class,
        //web
        'web.index' => \App\Http\Middleware\web\index::class,
        //statistic
        'statistic.index' => \App\Http\Middleware\statistic\index::class,
        //phanquyen
        'phanquyen' => \App\Http\Middleware\phanquyen::class,

    ];
}
