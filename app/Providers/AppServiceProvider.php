<?php

namespace App\Providers;

use App\Services\NotificationService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(NotificationService::class, function ($app) {
            return new NotificationService;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
         if(env('REDIRECT_HTTPS'))
      {
        $url->forceScheme('https');
      }
        
        //URL::forceScheme('https');
    }
}
