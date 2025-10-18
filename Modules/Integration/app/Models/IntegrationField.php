<?php

namespace Modules\Integration\Models;

use Modules\Core\Models\CoreModel;
use Modules\Integration\Enums\FieldType;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// use Modules\Integration\Database\Factories\IntegrationFieldFactory;

class IntegrationField extends CoreModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['integration_collection_id', 'system_field_id', 'alias', 'type', 'config'];

    protected $casts = [
        'config' => 'array',
        'type'   => FieldType::class,
    ];

    // protected static function newFactory(): IntegrationFieldFactory
    // {
    //     // return IntegrationFieldFactory::new();
    // }

    public function integrationCollection()
    {
        return $this->belongsTo(IntegrationCollection::class);
    }

    public function systemField()
    {
        return $this->belongsTo(SystemField::class);
    }
}
