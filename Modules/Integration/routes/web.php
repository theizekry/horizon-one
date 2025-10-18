<?php

use Illuminate\Support\Facades\Route;
use Modules\Integration\Http\Controllers\Dashboard\IntegrationController;
use Modules\Integration\Http\Controllers\Dashboard\IntegrationOnboardingController;
use Modules\Integration\Http\Controllers\Dashboard\TestDatabaseConnectionController;

// Dashboard

Route::middleware(['dashboard-auth'])->group(function () {
    //    Route::get('/admin/clients/wizard/step', [ClientWizardController::class, 'getStep']);

    Route::group(['prefix' => 'integrations', 'as' => 'integrations.'], function () {

        Route::get('/create', [IntegrationOnboardingController::class, 'createNewIntegration'])->name('create');
        Route::post('wizard/step/general', [IntegrationOnboardingController::class, 'saveGeneralStep'])->name('general.save');
        Route::post('wizard/step/master-database', [IntegrationOnboardingController::class, 'saveMasterDatabaseConnection'])->name('master.db.save');
        Route::post('wizard/step/units-mapping', [IntegrationOnboardingController::class, 'saveUnitsMapping'])->name('units.mapping.save');

        Route::post('test-db-connection', [TestDatabaseConnectionController::class, 'testConnection'])->name('test.db.connection');

        Route::resource('/', IntegrationController::class)->except('create');
    });
});
