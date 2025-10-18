<?php

use Illuminate\Support\Facades\Route;
use Modules\HorizonPulse\Http\Controllers\HorizonPulseController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('horizonpulse', HorizonPulseController::class)->names('horizonpulse');
});
