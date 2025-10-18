<?php

namespace Modules\Integration\Models;

use Modules\Core\Models\CoreModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// use Modules\Integration\Database\Factories\SystemFieldFactory;

class SystemField extends CoreModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['collection_id', 'name'];

    // protected static function newFactory(): SystemFieldFactory
    // {
    //     // return SystemFieldFactory::new();
    // }

    public function collection()
    {
        return $this->belongsTo(SystemCollection::class, 'collection_id');

    }

    public function integrationFields()
    {
        return $this->hasMany(IntegrationField::class);
    }
}
