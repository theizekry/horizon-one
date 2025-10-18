<?php

namespace Modules\Integration\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Integration\Models\SystemCollection;

class IntegrationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mapping = config('integration.field_mapping');
        foreach ($mapping as $collectionName => $fields) {
            $collection = SystemCollection::firstOrCreate(['name' => $collectionName]);
            foreach ($fields as $field) {
                $collection->fields()->firstOrCreate(['name' => $field]);
            }
        }
    }
}
