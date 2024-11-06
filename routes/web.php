<?php

use App\Http\Controllers\Contribution;
use App\Http\Controllers\Participation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    Log::info('test');
    return view('welcome');
})->name('welcome');


Route::prefix('evenement')
    ->name('evenement')
    ->group(function() {
        Route::name('.inscription')
        ->prefix('/inscription')
        ->group(function() {
            Route::get('/{event}', [Participation::class, 'showParticipationForm'])->name('.show');
            Route::post('/{event}', [Participation::class, 'addParticipant'])->name('.store');
        
            Route::get('/success', function () {
                return view('participation.inscription-success');
            })            
            ->name('.success');
            Route::post('/success', function () {
                return redirect()->route('evenement.inscription.success');
            })
            ->name('.success.redirection');
        });
    }
);

Route::prefix('contribution')
    ->name('contribution')
    ->group(function() {
        Route::get('/success', function () {
            return view('participation.inscription-success');
        })
        ->name('.success');
        Route::post('/success', function () {
            return redirect()->route('evenement.inscription.success');
        })
        ->name('.success.redirection');

        Route::get('/{project}', [Contribution::class, 'showContributionForm'])->name('.show');
        Route::post('/{project}', [Contribution::class, 'addContributor'])->name('.store');
    }
);
