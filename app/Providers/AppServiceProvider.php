<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\MemeObserver;
use App\Meme;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Meme::observe(MemeObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
