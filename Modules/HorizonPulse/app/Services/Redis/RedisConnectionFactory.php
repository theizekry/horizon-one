<?php

namespace Modules\HorizonPulse\Services\Redis;

use Illuminate\Redis\Connections\Connection;
use Illuminate\Support\Facades\Redis;

class RedisConnectionFactory
{
    /**
     * Create a new Redis connection dynamically.
     *
     * @param  array  $config
     * @return Connection
     */
    public static function make(array $config)
    {
        // Unique name for this connection
        $connectionName = $config['name'] ?? 'dynamic_' . md5(json_encode($config));

        // Register config temporarily
        config(["database.redis.$connectionName" => [
            'host'     => $config['host'],
            'password' => $config['password'] ?? null,
            'port'     => $config['port'],
            'database' => $config['database'],
        ]]);

        // Return ready Redis connection
        return Redis::connection($connectionName);
    }
}