<?php

use Illuminate\Support\Facades\Route;
use Modules\HorizonPulse\Services\Redis\RedisConnectionFactory;

Route::get('/', function () {

    $redis = RedisConnectionFactory::make([
        'host' => 'app.redis',
        'port' => 6379,
        'database' => 0,
    ]);

    dump($redis->get('test:key'));

    return response()->json([
        'message' => 'Welcome to Horizon One.',
        'version' => '1.0.0',
    ]);
});
