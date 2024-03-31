<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view) {
            $view->with('metaTitle', $this->getMetaTitle());
        });
        //
        Schema::defaultStringLength(191);

    }

    private function getMetaTitle()
    {
        // You can implement your logic to determine the meta title here
        // For example, you might retrieve it from a configuration file or database
        return 'Default Meta Title';
    }
}
