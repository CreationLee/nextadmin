<?php

if(!function_exists('is_bread_translatable')) {

    function is_bread_translatable($model)
    {
        return config('admin.multilingual.enabled')
            && isset($model,$model['translatable']);
    }
}