<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facades\AdminFacades;
use Illuminate\Support\Facades\DB;

class AdminBreadController extends Controller
{

    public function index(Request $request)
    {
        //get the slug
        $slug = $this->getSlug($request);

        $dataType = AdminFacades::model('DataType')->where('slug','=',$slug)->first();

        //check permissions
        AdminFacades::canOrFail($dataType->name);

        $getter = $dataType->server_side ? "paginate" : "get";

        if(strlen($dataType->model_name) != 0){
            $model = app($dataType->model_name);

            //TODO deal with all the relationshios that the tables may happen
            if($model->timestamps) {
                $dataTypeContent = call_user_func([$model->latest(),$getter]);
            }else{
                $dataTypeContent = call_user_func([
                    $model->orderBy($model->getKeyName(),'DESC'),
                    $getter
                ]);
            }
        }else{
            $dataTypeContent = call_user_func([DB::table($dataType->name),$getter]);
            $model = false;
        }

        //check if it is translatble
        $isModelTranslatable = is_bread_translatable($model);

        $view = "admin.bread.browse";
        if(view()->exists("admin.$slug.browse")) {
            $view = "admin.$slug.browse";
        }

        return view($view,compact('dataType','dataTypeContent','isModelTranslatable'));
    }
    
}
