<?php

namespace Modules\Integration\Models;

use Modules\Core\Models\CoreModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// use Modules\Integration\Database\Factories\SystemCollectionFactory;

class SystemCollection extends CoreModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name'];

    // protected static function newFactory(): SystemCollectionFactory
    // {
    //     // return SystemCollectionFactory::new();
    // }

    public function fields()
    {
        return $this->hasMany(SystemField::class, 'collection_id');
    }

    public function integrationCollections()
    {
        return $this->hasMany(IntegrationCollection::class, 'system_collection_id');
    }
}
