<?php

if(!function_exists('admin_asset')) {

    function admin_asset($path, $secure = null )
    {
        return asset(config('admin.assets_path').'/'.$path, $secure);
    }
}

if(!function_exists('menu')) {

    function menu($menuName, $type = null, array $options = [])
    {
        return \App\Models\Menu::display($menuName,$type, $options);
    }
}

