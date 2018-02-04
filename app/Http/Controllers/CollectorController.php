<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class CollectorController extends Controller
{
    //
    function Login(Request $request){

        $collectorname=$request->collectorname;
        $password=($request->password);

        $cn=DB::table('collectors')
            ->select('collectors.collectorname')
            ->where('collectorname','=',$collectorname)
            ->get();
        $password=DB::table('collectors')
            ->select('collectors.password')
            ->where('password','=',$password)
            ->get();
        error_log($password);


if(!$cn->isEmpty()&&!$password->isEmpty()){
        $cId=DB::table('collectors')
            ->select('collectors.id')
            ->where('collectorname','=',$collectorname)
            ->get();
            $fcId=$cId[0];
            return response()->json([
                'error'=>FALSE,
                'cId'=>$fcId,
                'message' =>"success",
            ]);

        }
        else{

            return response()->json([
                'error'=>TRUE,
                'message'=>"Wrong credintials"
            ]);
        }
    }


    function Lplaces(Request $request){
        $areaId=$request->areaId;
        error_log($areaId);
        $Lplaces=DB::select("SELECT `users`.`id`,`users`.`Lplace` FROM `order_requests`,`users` WHERE `state`=1 AND `order_requests`.`areaId`=".$areaId." AND `order_requests`.`uId`=`users`.`id`");

        return response()->json([
            'Lplaces'=>$Lplaces
        ]);
    }
}
