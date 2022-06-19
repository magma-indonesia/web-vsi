<?php

namespace App\Providers;

use App\Services\Sipeg\Interfaces\SipegInterface;
use App\Services\Sipeg\SipegService;
use Illuminate\Support\ServiceProvider;

class SipegServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SipegInterface::class, SipegService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
