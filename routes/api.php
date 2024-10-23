<?php

use App\Http\Controllers\NotifyPayment;
use Illuminate\Support\Facades\Route;

Route::post('receive', NotifyPayment::class);
