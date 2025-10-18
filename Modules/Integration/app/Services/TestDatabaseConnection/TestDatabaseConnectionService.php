<?php

namespace Modules\Integration\Services\TestDatabaseConnection;

use PDO;
use Throwable;
use MongoDB\Client;
use InvalidArgumentException;

class TestDatabaseConnectionService
{
    /**
     * The maximum number of retries to connect.
     */
    private int $retries = 3;

    /**
     * @throws Throwable
     *
     * @return true
     */
    public function testConnection(array $connection)
    {
        return match ($connection['db_type']) {
            'mysql'   => $this->testMysqlConnection($connection),
            'mongodb' => $this->testMongoConnection($connection),
            default   => throw new InvalidArgumentException("Unsupported database type: {$connection['db_type']}"),
        };
    }

    /**
     * @throws Throwable
     */
    private function retry(callable $callback): mixed
    {
        for ($i = 0; $i < $this->retries; $i++) {
            try {
                return $callback();
            } catch (\Throwable $e) {
                if ($i === $this->retries - 1) {
                    throw $e;
                }
                sleep(2);
            }
        }

        return false;
    }

    /**
     * @throws Throwable
     *
     * @return bool
     */
    private function testMysqlConnection(array $connection)
    {
        $dsn = "mysql:host={$connection['db_host']};port={$connection['db_port']};dbname={$connection['db_name']}";

        return $this->retry(function () use ($dsn, $connection) {
            new PDO($dsn, $connection['db_username'], $connection['db_password']);

            return true;
        });
    }

    /**
     * @throws Throwable
     */
    private function testMongoConnection(array $connection): bool
    {
        // Data Source Name
        $dsn = "mongodb://{$connection['db_username']}:{$connection['db_password']}@{$connection['db_host']}:{$connection['db_port']}/{$connection['db_name']}?authSource=admin";

        return $this->retry(function () use ($dsn) {
            $client = new Client($dsn);
            $client->listDatabases(); // force actual connection

            return true;
        });
    }
}
