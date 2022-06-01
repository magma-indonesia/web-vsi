<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;

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
        Paginator::useBootstrap();

        Request::macro('wantsAjax', function () {
            return request()->ajax();
        });

        Http::macro('magma', function() {
            return Http::timeout(5)
                ->acceptJson()
                ->baseUrl('https://magma.esdm.go.id/api');
        });
    }
}
