<?php

namespace Modules\Integration\Models;

use Laravel\Passport\HasApiTokens;
use Modules\Core\Models\AuthenticatableModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Integration\Database\Factories\IntegrationFactory;

class Integration extends AuthenticatableModel
{
    use HasApiTokens, HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'status',
        'registration_step',
        'oauth_client_id',
    ];

    protected static function newFactory(): Factory|IntegrationFactory
    {
        return IntegrationFactory::new();
    }

    public function masterConnection()
    {
        return $this->hasOne(MasterConnection::class);
    }
}
