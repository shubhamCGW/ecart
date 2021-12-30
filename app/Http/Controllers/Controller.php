<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function formErrorToPlainArray($formError=[],$withKey=false) {
        $err=[];
        foreach($formError as $k=>$val){
            if($withKey){
                $err[$k]=$val[0] ?? $val;
            }else{
                $err[]=$val[0] ?? $val;
            }
        }
        return $err;
    }
}
