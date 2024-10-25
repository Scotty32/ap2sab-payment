<?php

namespace App\Providers;

use App\Communicators\CinetpayHttpClient;
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

        $this->app->singleton(CinetpayHttpClient::class, function (Application $app) {
            return new CinetpayHttpClient(
                config('services.cinetpay.api_key'),
                config('services.cinetpay.site_id'),
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
