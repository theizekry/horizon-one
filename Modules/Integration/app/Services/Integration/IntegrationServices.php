<?php

namespace Modules\Integration\Services\Integration;

use Modules\Integration\Models\Integration;

class IntegrationServices
{
    /**
     * Create a new Integration record in the database.
     */
    public function createNewIntegration(string $name): Integration
    {
        return Integration::create(['name' => $name]);
    }

    public function findIntegrationById(string $integrationId): Integration
    {
        return Integration::find($integrationId);
    }
}
