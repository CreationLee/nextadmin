<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Facades\AdminFacades;

class Role extends Model
{
    protected $guarded = [];


    public function permissions()
    {
        return $this->belongsToMany(AdminFacades::modelClass('Permission'));
    }
}
