<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Traits\AdminUser;

class User extends AuthUser
{
    use AdminUser;
}
