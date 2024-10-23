<?php

namespace App\Providers;

use CinetPay\CinetPay;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class CinetpayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        $this->app->bind(CinetPay::class, function (Application $app) {
            return new CinetPay(
                config('services.cinetpay.site_id'),
                config('services.cinetpay.api_key')
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
