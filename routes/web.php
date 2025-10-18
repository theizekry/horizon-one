<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $x = 'sdsd';

    return response()->json([
        'message' => 'Welcome to Horizon One.',
        'version' => '1.0.0',
    ]);
});
