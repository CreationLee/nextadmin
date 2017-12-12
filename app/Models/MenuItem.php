<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;
use Illuminate\Support\Facades\Route;

class MenuItem extends Model
{
    use Translatable;

    protected $translateble = ['title'];

    public function children()
    {
        return $this->hasMany('App\Models\MenuItem','parent_id')
            ->with('children');
    }

    public function link($absolute = false)
    {
        return $this->prepareLink($absolute,$this->route,$this->parameters,$this->url);
    }

    public function prepareLink($absoulute, $route, $parameters, $url)
    {
        if(is_null($parameters)) {
            $parameters = [];
        }

        if(!is_array($parameters)) {
            $parameters = json_decode($parameters,true);
        }

        if(!is_null($route)) {
            if(!Route::has($route)) {
                return '#';
            }

            return route($route,$parameters,$absoulute);
        }

        if($absoulute) {
            return url($url);
        }

        return $url;
    }
}
