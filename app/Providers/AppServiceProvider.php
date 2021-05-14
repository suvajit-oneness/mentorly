<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ContactUs;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('contact', ContactUs::where('type',0)->first());
    }
}
