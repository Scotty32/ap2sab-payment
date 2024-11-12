<?php

use App\Http\Controllers\API\CinetpayNotification;
use App\Http\Controllers\API\Events;
use App\Http\Controllers\API\Projects;
use App\Models\Event;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

Route::match(['GET', 'POST'], 'evenement/inscription/{event}/success', function (Event $event) {
        return redirect()->route('evenement.inscription.success', ['event', $event->id]);
    }
)->name('api.evenement.inscription.success');

Route::match(['GET', 'POST'], 'contribution/{project}/success', function (Project $project) {
        return redirect()->route('contribution.success', ['project' => $project->id]);
    }
)->name('api.contribution.success');

Route::post('cinetpay/notification/handler', CinetpayNotification::class)->name('cinetpay.notification.handler');
Route::get('cinetpay/notification/handler', function() {
    return response("");
});

Route::prefix('/events')->group(function () {
    Route::get('/', [Events::class, 'all']);
    Route::get('/pending', [Events::class, 'pending']);
    Route::post('/by-date', [Events::class, 'byDate']);
    Route::get('/done', [Events::class, 'getDoneEvents']);
});

Route::prefix('/projects')->group(function () {
    Route::get('/', [Projects::class, 'all']);
    Route::get('/pending', [Projects::class, 'pending']);
    Route::get('/done', [Projects::class, 'getDoneProjects']);
});