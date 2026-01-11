<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CampaignController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('event/{slug}')->name('campaign.')->group(function () {
    Route::get('/', [CampaignController::class, 'index'])->name('index');
    Route::post('/verify', [CampaignController::class, 'verify'])->name('verify');
    
    // Signed route for the main registration form
    Route::get('/register', [CampaignController::class, 'showForm'])
        ->name('form')
        ->middleware('signed');
        
    Route::post('/register', [CampaignController::class, 'store'])->name('store');
    Route::get('/thanks', [CampaignController::class, 'thanks'])->name('thanks');
});
