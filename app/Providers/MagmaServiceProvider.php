<?php

namespace App\Providers;

use App\Services\Magma\Interfaces\MagmaVenInterface;
use App\Services\Magma\MagmaVenService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class MagmaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MagmaVenInterface::class, MagmaVenService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Http::macro('magma', function () {
            return Http::timeout(5)
                ->acceptJson()
                ->baseUrl(config('magma.api_url'));
        });
    }
}
