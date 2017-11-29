<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Facades\AdminFacades;

class Menu extends Model
{

    public function parent_items()
    {
        return $this->hasMany(AdminFacades::modelClass('MenuItem'))
            ->whereNull('parent_id');
    }

    public static function display($menuName, $type = null, array $options = [])
    {
        $menu = static::where('name','=',$menuName)
            ->with('parent_items.children')
            ->first();


    }
}
