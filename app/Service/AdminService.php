<?php

namespace App\Service;

use App\Models\User;
use App\Models\Setting;

class AdminService
{

    protected $models = [
        'User' => User::class,
    ];

    public function model($name)
    {
        return app($this->models[studly_case($name)]);
    }

    public function setting($key, $default = null)
    {
        $setting = Setting::where('key','=',$key)->first();

        if (isset($setting->id)) {
            return $setting->value;
        }


    }


}