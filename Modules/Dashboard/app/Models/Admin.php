<?php

namespace Modules\Dashboard\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\AuthenticatableModel;
use Modules\Dashboard\Traits\EloquentScopeSearch;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\Factories\AdminFactory;

class Admin extends AuthenticatableModel
{
    use EloquentScopeSearch, HasFactory, SoftDeletes;

    protected string $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'phone_number',
        'email',
        'password',
        'is_blocked',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_super'   => 'boolean',
        'is_blocked' => 'boolean',
    ];

    protected array $searchable = [
        'name',
        'username',
        'phone_number',
        'email',
    ];

    protected static function newFactory(): Factory|AdminFactory
    {
        return AdminFactory::new();
    }

    /**
     * Set Password attribute.
     */
    public function setPasswordAttribute($password)
    {
        if (Hash::needsRehash($password) && $password) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    /**
     * return profile image attribute.
     */
    public function getImageAttribute($image): string
    {
        if (! $image) {
            return asset('general/images/thumb/person-placeholder.jpg');
        }

        return asset('uploads/' . $image);
    }
}
