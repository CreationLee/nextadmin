<?php

namespace App\Service;

use App\Models\MenuItem;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Models\Role;
use App\Models\Permission;
use App\Models\DataType;
use App\Traits\Translatable;

class AdminService
{

    protected $models = [
        'User' => User::class,
        'Role' => Role::class,
        'Permission' => Permission::class,
        'MenuItem' => MenuItem::class,
        'DataType' => DataType::class,
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

    public function translatable($model)
    {
        if (!config('admin.multilingual.enabled')) {
            return false;
        }

        if( is_string($model)) {
            $model = app($model);
        }

        if ($model instanceof Collection) {
            $model = $model->first();
        }

        if (!is_subclass_of($model, Model::class)) {
            return false;
        }

        $traits = class_uses_recursive(get_class($model));

        return dd(in_array(Translatable::class,$traits));
    }
}