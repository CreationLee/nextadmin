<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Facades\AdminFacades;
use Illuminate\Support\Facades\Auth;
use App\Models\DataType;

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

        if(!isset($menu)) {
            return false;
        }

        //event();//监听模式（什么鬼）

        $options = (object) $options;

        if (in_array($type, ['admin', 'admin_menu'])) {
            $permissions = AdminFacades::model('Permission')->all();
            $dataTypes = AdminFacades::model('DataType')->all();
            $prefix = trim(route('admin.dashboard', [], false), '/');
            $user_permissions = null;

            if(!Auth::guest()) {
                $user = AdminFacades::model('User')->find(Auth::id());
                $user_permissions = $user->role->permissions->pluck('key')->toArray();
            }

            $options->user = (object) compact('permissions', 'dataTypes', 'prefix', 'user_permissions');

            $type= 'admin.menu.'.$type;
        } else {
            if ( is_null($type)) {
                $type = 'admin.menu.default';
            } elseif($type=='bootstrap' && !view()->exists($type)) {
                $type = 'admin.menu.bootstrap';
            }
        }

        if(!isset($options->locale)) {
            $options->locale = app()->getLocale();
        }

        return new \Illuminate\Support\HtmlString(
            \Illuminate\Support\Facades\View::make($type, ['items' => $menu->parent_items, 'options' => $options])->render()
        );
    }
}
