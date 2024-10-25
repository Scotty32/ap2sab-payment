<?php

namespace App\Providers;

use App\View\Composers\CountriesComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class BladeComposerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('components.forms.payment', CountriesComposer::class);
    }
}
