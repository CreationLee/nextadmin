<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AdminFacades extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'Admin';
    }
}