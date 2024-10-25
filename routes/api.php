<?php

use App\Http\Controllers\API\CinetpayNotification;
use Illuminate\Support\Facades\Route;

Route::post('cinetpay/notification/handler', CinetpayNotification::class)->name('cinetpay.notification.handler');
Route::get('cinetpay/notification/handler', function() {
    return response("");
});
