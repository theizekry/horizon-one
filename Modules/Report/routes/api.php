<?php

use Illuminate\Support\Facades\Route;
use Modules\Report\Http\Controllers\ReportController;

Route::middleware(['auth:api'])->prefix('v1')->group(function () {
    Route::post('/generate-report', [ReportController::class, 'generateReport'])->name('report.generate');
});
