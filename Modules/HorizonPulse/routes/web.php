<?php

use Illuminate\Support\Facades\Route;
use Modules\HorizonPulse\Http\Controllers\HorizonPulseController;

/*
|--------------------------------------------------------------------------
| Horizon Pulse Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Horizon Pulse routes for your application.
|
*/

Route::prefix('horizon-pulse')->group(function () {
    // Dashboard
    Route::get('/', [HorizonPulseController::class, 'index'])->name('horizon-pulse.index');

    // Metrics API
    Route::get('/metrics', [HorizonPulseController::class, 'getAllMetrics'])->name('horizon-pulse.metrics');
    Route::get('/overview', [HorizonPulseController::class, 'getOverview'])->name('horizon-pulse.overview');
    Route::get('/projects/{project}/metrics', [HorizonPulseController::class, 'getProjectMetrics'])->name('horizon-pulse.project-metrics');

    // Connection Testing
    Route::post('/projects/{project}/test-connection', [HorizonPulseController::class, 'testConnection'])->name('horizon-pulse.test-connection');
});
