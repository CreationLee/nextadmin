<?php

namespace App\Service;

use App\Models\User;

class AdminService
{

    protected $models = [
        'User' => User::class,
    ];

    public function model($name)
    {
        return app($this->models[studly_case($name)]);
    }

}