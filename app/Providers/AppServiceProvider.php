<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * URL for MAGMA API
     *
     * @var string
     */
    public string $magmaApiUrl = 'https://magma.esdm.go.id/api';

    /**
     * MAGMA API url
     *
     * @return string
     */
    public function magmaApiUrl(): string
    {
        if (config()->has('magma.url')) {
            return config('magma.url');
        }

        return $this->magmaApiUrl;
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
