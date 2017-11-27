<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings'; //定义表名

    protected $guarded = []; //黑名单属性

    protected $timestamp = false;

}
