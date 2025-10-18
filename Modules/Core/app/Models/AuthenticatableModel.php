<?php

namespace Modules\Core\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;

class AuthenticatableModel extends CoreModel implements \Illuminate\Contracts\Auth\Authenticatable
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;
}
