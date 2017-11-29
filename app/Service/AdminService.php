<?php

namespace App\Service;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use App\Models\Role;
use App\Models\Permission;

class AdminService
{

    protected $models = [
        'User' => User::class,
        'Role' => Role::class,
        'Permission' => Permission::class,
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

        return $default;
    }

    public function image($file, $default='')
    {
        if (!empty($file) && Storage::disk(config('voyager.storage.disk'))->exists($file)) {
            return Storage::disk(config('voyager.storage.disk'))->url($file);
        }

        return $default;
    }

    public function modelClass($name)
    {
        return $this->models[$name];
    }
}