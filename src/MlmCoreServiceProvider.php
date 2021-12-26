<?php

namespace Cryptolib\CryptoCore;


use Cryptolib\CryptoCore\Middleware\XApiVersionMiddleware;
use Cryptolib\CryptoCore\providers\MlmEventServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class MlmCoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(MlmEventServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/mlmcore.php', 'mlmcore');
        $this->publishes([
            __DIR__ . '/config' => base_path('config'),
        ]);
        $this->registerRoutes();
        $this->loadMigrationsFrom(__DIR__ . '/migrations');

        /*  $kernel = $this->app->make(Kernel::class);
          $kernel->pushMiddleware(XApiVersionMiddleware::class);*/

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('x-api', XApiVersionMiddleware::class);
    }


    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/routes.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('mlmcore.prefix'),
            'middleware' => config('mlmcore.middleware'),
        ];
    }
}
