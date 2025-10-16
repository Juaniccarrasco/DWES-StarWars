<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipController extends Controller
{
    public static function postShip(Request $request){
        $name_ship= $request->input('name_ship');
        $tripulation=$request->input('tripulation');
        
        $passangers=$request->input('passangers');
        if($request->has('model')){
            $model=$request->input('model');
        }
        if($request->has('class')){
            $class= $request->input('class');
        }
        

    }
}
