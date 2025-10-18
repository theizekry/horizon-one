<?php

namespace Modules\Dashboard\Models;

use Modules\Core\Models\CoreModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\Factories\ProjectFactory;

class Project extends CoreModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'env',
        'redis_host',
        'redis_port',
        'redis_password',
        'redis_db',
        'horizon_prefix',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }
}
