<?php

namespace Modules\Integration\Models;

use Modules\Core\Models\CoreModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// use Modules\Integration\Database\Factories\IntegrationCollectionFactory;

class IntegrationCollection extends CoreModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['integration_id', 'system_collection_id', 'alias'];

    // protected static function newFactory(): IntegrationCollectionFactory
    // {
    //     // return IntegrationCollectionFactory::new();
    // }

    public function integration()
    {
        return $this->belongsTo(Integration::class);
    }

    public function systemCollection()
    {
        return $this->belongsTo(SystemCollection::class, 'system_collection_id');
    }

    public function fields()
    {
        return $this->hasMany(IntegrationField::class);
    }
}
