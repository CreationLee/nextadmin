<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getSlug(Request $request)
    {
        if(isset($this->slug)) {
            $slug = $this->slug;
        }else{
            $slug = explode('.',$request->route()->getName())[1];
        }

        return $slug;
    }

    public function insertUpdateData($request, $slug, $rows, $data)
    {
        foreach ($rows as $row) {
            $options = json_decode($row->details);

            $content = $this->getContentBasedOnType($request, $slug ,$row);
        }

    }

    public function getContentBasedOnType(Request $request, $slug, $row)
    {
        $content = null;
        switch ($row->type) {
            /********** PASSWORD TYPE **********/
            case 'password':
                $pass_field = $request->input($row->field);

                if (isset($pass_field) && !empty($pass_field)) {
                    return bcrypt($request->input($row->field));
                }

                break;

            /********** CHECKBOX TYPE **********/
            case 'checkbox':
                $checkBoxRow = $request->input($row->field);

                if (isset($checkBoxRow)) {
                    return 1;
                }

                $content = 0;

                break;

            /******** FILE TYPE ***********/
            case 'file' :

        }

    }
}
