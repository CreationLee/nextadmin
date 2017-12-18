<?php

namespace App\Models;

use App\Facades\AdminFacades;
use Illuminate\Database\Eloquent\Model;

class DataType extends Model
{

    public function rows()
    {
        return $this->hasMany(AdminFacades::modelClass('DataRow'))->orderBy('order');
    }

    public function readRows()
    {
      return $this->rows()->where('read',1);
    }
}
