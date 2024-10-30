<?php

use App\Http\Controllers\API\CinetpayNotification;
use Illuminate\Support\Facades\Route;

Route::match(['GET', 'POST'], 'evenement/inscription/success', function () {
        return redirect()->route('evenement.inscription.success');
    }
)->name('api.evenement.inscription.success');

Route::match(['GET', 'POST'], 'contribution/success', function () {
        return redirect()->route('contribution.success');
    }
)->name('api.contribution.success');

Route::post('cinetpay/notification/handler', CinetpayNotification::class)->name('cinetpay.notification.handler');
Route::get('cinetpay/notification/handler', function() {
    return response("");
});
