<?php

namespace App\Http\Controllers;

use App\ManagePoints;
use App\userPoints;
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


        $areaIdArray = DB::table('collectors')
            ->select('collectors.areaId')
            ->where('id', '=', $cId)
            ->get();
        $areaId= object_get($areaIdArray[0],"areaId",null);


        $Lplaces = DB::select("SELECT `order_requests`.`id`,`users`.`Lplace` FROM `order_requests`,`users` WHERE `state`=1 AND `order_requests`.`areaId`=" . $areaId . " AND `order_requests`.`uId`=`users`.`id`");

       return $Lplaces;

    }


    function sendDogFoodLocations(Request $request)

    {

        $cId = $request->cId;


        $areaIdArray = DB::table('collectors')
            ->select('collectors.areaId')
            ->where('id', '=', $cId)
            ->get();
        $areaId= object_get($areaIdArray[0],"areaId",null);


        $Lplaces = DB::select("SELECT `dog_foods`.`id`,`users`.`Lplace` FROM `dog_foods`,`users` WHERE `state`=1 AND `dog_foods`.`areaId`=" . $areaId . " AND `dog_foods`.`uId`=`users`.`id`");

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



//points Calculation-----------------------------------------------------------------
        $organicPoints= DB::table('manage_points')
            ->select('manage_points.value')
            ->where('id', '=', '1')
            ->get();

        $plasticPoints= DB::table('manage_points')
            ->select('manage_points.value')
            ->where('id', '=', '2')
            ->get();

        $paperPoints= DB::table('manage_points')
            ->select('manage_points.value')
            ->where('id', '=', '3')
            ->get();

        $glassPoints= DB::table('manage_points')
            ->select('manage_points.value')
            ->where('id', '=', '4')
            ->get();

        $metalPoints= DB::table('manage_points')
            ->select('manage_points.value')
            ->where('id', '=', '5')
            ->get();

        $electronicPoints= DB::table('manage_points')
            ->select('manage_points.value')
            ->where('id', '=', '6')
            ->get();

        $id= DB::table('order_requests')
            ->select('order_requests.uId')
            ->where('id', '=', $requestId)
            ->get();

        $intOrganicPoints=(int)object_get($organicPoints[0],"value",null);
        $intPlasticPoints=(int)object_get($plasticPoints[0],"value",null);
        $intPaperPoints=(int)object_get($paperPoints[0],"value",null);
        $intGlassPoints=(int)object_get($glassPoints[0],"value",null);
        $intMetalPoints=(int)object_get($metalPoints[0],"value",null);
        $intElectronicPoints=(int)object_get($electronicPoints[0],"value",null);
        $uId=(int)object_get($id[0],"uId",null);




    //-------------------------------------------------
        $totalOrganicPoints=$intOrganicPoints*$organic;
        $totalPlasticPoints=$intPlasticPoints*$plastic;
        $totalPaperPoints=$intPaperPoints*$paper;
        $totalGlassPoints=$intGlassPoints*$glass;
        $totalMetalPoints=$intMetalPoints*$metal;
        $totalElectronicPoints=$intElectronicPoints*$electronic;

        $totalPoints=$totalOrganicPoints+$totalPlasticPoints+$totalPaperPoints+$totalGlassPoints+$totalMetalPoints+$totalElectronicPoints;


        $table=new UserPoints();
        $table->points=$totalPoints;
        $table->requestId=$requestId;

        $table->uId=$uId;
        $table->save();



        //--------------------------------------------------------------------------------

     $currentPoints=DB::table('user_points_redeems')
         ->select('user_points_redeems.totalPoints')
         ->where('uId', '=', $uId)
         ->get();

        $currentRemaining=DB::table('user_points_redeems')
            ->select('user_points_redeems.remaining')
            ->where('uId', '=', $uId)
            ->get();


     $newPoints=object_get($currentPoints[0],"totalPoints",null)+$totalPoints;
     $newRemainingPoints=(double)object_get($currentRemaining[0],"remaining",null)+$totalPoints;
        DB::table('user_points_redeems')
            ->where('uId', $uId)
            ->update([
                'totalPoints' => $newPoints,
                'remaining' => $newRemainingPoints,
                ]);

        return response()->json([
            'error'=>false,
            'message'=>"Success!"
        ]);


    }



    function collectorDogFoodSend(Request $request)

    {

        $realDogFoodQuantity = $request->realDogFoodQuantity;

        $requestId = $request->requestId;


        DB::table('dog_foods')
            ->where('id', $requestId)
            ->update([
                'realDogFoodQuantity' => $realDogFoodQuantity,
                'state'=>0]);

        return response()->json([
            'error'=>false,
            'message'=>"Success!"
        ]);







    }



    function  CheckPoints(Request $request){

        $uId = $request->uId;

        $remaining=DB::table('user_points_redeems')
            ->select('user_points_redeems.remaining')
            ->where('uId', '=', $uId)
            ->get();

        $pointValue=DB::table('manage_points')
            ->select('manage_points.value')
            ->where('id', '=', 7)
            ->get();

        $remainingBalance=(double)object_get($remaining[0],"remaining",null)*(double)object_get($pointValue[0],"value",null);


        return response()->json([
            'remainingBalance'=>$remainingBalance

        ]);

    }



    function PointsRedeem(Request $request)

    {

        $uId = $request->uId;

        $remaining=DB::table('user_points_redeems')
            ->select('user_points_redeems.remaining')
            ->where('uId', '=', $uId)
            ->get();

        $redeem=DB::table('user_points_redeems')
            ->select('user_points_redeems.redeem')
            ->where('uId', '=', $uId)
            ->get();

        $fremaining=object_get($remaining[0],"remaining",null);

        $fredeem=object_get($redeem[0],"redeem",null);

        $totalRedeem=(double)$fredeem+(double)$fremaining;

        DB::table('user_points_redeems')
            ->where('uId', '=', $uId)
            ->update([
                'redeem' => $totalRedeem,
                ]);

        DB::table('user_points_redeems')
            ->where('uId', '=', $uId)
            ->update([
                'remaining' => "0",
            ]);





    }



}
