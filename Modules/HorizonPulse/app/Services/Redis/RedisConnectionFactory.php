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
        // Use the default connection and modify its config temporarily
        $connectionName = 'default';
        
        // Store original config
        $originalConfig = config("database.redis.$connectionName");
        
        // Set new config
        config(["database.redis.$connectionName" => [
            'url'      => null,
            'host'     => $config['host'],
            'username' => null,
            'password' => $config['password'] ?? null,
            'port'     => $config['port'],
            'database' => $config['database'],
            'options'  => [
                'prefix' => 'laravel_database_',
            ],
        ]]);

        // Get the connection
        $connection = Redis::connection($connectionName);
        
        // Restore original config
        config(["database.redis.$connectionName" => $originalConfig]);
        
        return $connection;
    }
}