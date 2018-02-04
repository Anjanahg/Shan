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


    function sendLocations(Request $request)

    {

        $cId = $request->cId;

        error_log($cId);
        $areaIdArray = DB::table('collectors')
            ->select('collectors.areaId')
            ->where('id', '=', $cId)
            ->get();
        $areaId= object_get($areaIdArray[0],"areaId",null);


        $Lplaces = DB::select("SELECT `order_requests`.`id`,`users`.`Lplace` FROM `order_requests`,`users` WHERE `state`=1 AND `order_requests`.`areaId`=" . $areaId . " AND `order_requests`.`uId`=`users`.`id`");

       return $Lplaces;

    }





    function collectorSend(Request $request)

    {

        $organic = $request->organic;
        $plastic = $request->plastic;
        $paper = $request->paper;
        $glass = $request->glass;
        $metal = $request->metal;
        $electronic = $request->electronic;
        $requestId = $request->requestId;


        DB::table('order_requests')
            ->where('id', $requestId)
            ->update([
                'realOrganicQuantity' => $organic,
                'realPlasticQuantity'=>$plastic,
                'realPaperQuantity'=>$paper,
                'realGlassQuantity'=>$glass,
                'realMetalQuantity'=>$metal,
                'realElectronicQuantity'=>$electronic,
                'state'=>0]);

        return response()->json([
            'error'=>false,
            'message'=>"Success!"
        ]);







    }
}
