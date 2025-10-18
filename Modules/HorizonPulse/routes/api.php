<?php

use Illuminate\Support\Facades\Route;
use Modules\HorizonPulse\Http\Controllers\HorizonPulseController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('horizonpulse', HorizonPulseController::class)->names('horizonpulse');
});
