<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
    
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        // set macro for response
        Response::macro('data', function ($data = null, string $message = '', int $status = 200) {
            return response()->json(compact('message', 'data'), $status);
        });
        
        Response::macro('error', function (string $message = '', int $status = 400) {
            return response()->json(compact('message'), $status);
        });
        
        Response::macro('dataWithAdditional', function (AnonymousResourceCollection $data, array $additional = [], string $message = '', int $status = 200) {
            return $data->additional(array_merge(compact('message'), $additional))->response()->setStatusCode($status);
        });
        
    }
}
