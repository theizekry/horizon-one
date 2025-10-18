<?php

namespace Modules\Integration\Models;

use Modules\Core\Models\CoreModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterConnection extends CoreModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'db_type',
        'db_host',
        'db_port',
        'db_name',
        'db_username',
        'db_password',
        'integration_id',
    ];

    public function integration()
    {
        return $this->belongsTo(Integration::class);
    }
}
