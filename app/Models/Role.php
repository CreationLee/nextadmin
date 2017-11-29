<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Facades\AdminFacades;

class Role extends Model
{
    protected $guarded = [];

<<<<<<< HEAD

=======
>>>>>>> b6039cf93e1f8404a815feb56fed0e359be33b4d
    public function permissions()
    {
        return $this->belongsToMany(AdminFacades::modelClass('Permission'));
    }
}
