<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class MenuItem extends Model
{
    use Translatable;

    protected $translateble = ['title'];

    public function children()
    {
        return $this->hasMany('App\Models\MenuItem','parent_id')
            ->with('children');
    }



    public function prepareLink($absoulute, $route, $parameters, $url)
    {
        if(is_null($parameters)) {
            $parameters = [];
        }


    }
}
