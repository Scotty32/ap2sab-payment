<?php

use App\Http\Controllers\Contribution;
use App\Http\Controllers\Participation;
use Illuminate\Support\Facades\Route;



Route::prefix('evenement')
    ->name('evenement')
    ->group(function() {
        Route::name('.inscription')
        ->prefix('/inscription/{event}')
        ->group(function() {
            Route::get('/', [Participation::class, 'showParticipationForm'])->name('.show');
            Route::post('/', [Participation::class, 'addParticipant'])->name('.store');
        
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

Route::prefix('contribution/{project}')
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

        Route::get('/', [Contribution::class, 'showContributionForm'])->name('.show');
        Route::post('/', [Contribution::class, 'addContributor'])->name('.store');
    }
);
