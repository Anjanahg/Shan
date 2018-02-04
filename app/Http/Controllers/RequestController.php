<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\orderRequest;
use DB;
use Carbon\Carbon;

class RequestController extends Controller
{



    function sendRequest(Request $request){




        $cDate= date('Y-m-d H:i:s');
        /*$req=OrderRequest::create([
                 'expectedOrganicQuantity' => $request['v1'],
                 'expectedPlasticQuantity' => $request['v2'],
                 'expectedPaperQuantity' => $request['v3'],
                 'expectedGlassQuantity' => $request['v4'],
                 'expectedMetalQuantity' => $request['v5'],
                 'expectedElectronicQuantity' => $request['v6'],
                 'requestedDate'=>$request[$cDate],



             ]);*/


        error_log($request->input('areaId'));
        $table=new orderRequest();
        $table->expectedOrganicQuantity=$request->input('v1');
        $table->expectedPlasticQuantity=$request->input('v2');
        $table->expectedPaperQuantity=$request->input('v3');
        $table->expectedGlassQuantity=$request->input('v4');
        $table->expectedMetalQuantity=$request->input('v5');
        $table->expectedElectronicQuantity=$request->input('v6');
        $table->areaId=$request->input('areaId');
        $table->requestedDate=$cDate;
        $table->state=1;
        $table->uId=$request->input('uId');
        $table->save();

        return response()->json([
            'error'=>false,
            'message'=>"Success!"
        ]);



    }

    function previousState(Request $request){

    }



    function displayRequest(Request $request){
        $userId=$request->input('uId');

        $details=DB::table('order_requests')
            ->select('order_requests.requestedDate','order_requests.id')
            ->where('uId','=',$userId)
            ->get();
        echo $details;

    }


    function listItemClick(Request $request){

        $id=$request->input('id');


        $details=DB::table('order_requests')
            ->select('order_requests.realOrganicQuantity',
                'order_requests.realPlasticQuantity',
                'order_requests.realPaperQuantity',
                'order_requests.realGlassQuantity',
                'order_requests.realMetalQuantity',
                'order_requests.realElectronicQuantity',
                'order_requests.state',
                'order_requests.expectedOrganicQuantity',
                'order_requests.expectedPlasticQuantity',
                'order_requests.expectedPaperQuantity',
                'order_requests.expectedGlassQuantity',
                'order_requests.expectedMetalQuantity',
                'order_requests.expectedElectronicQuantity')
            ->where('id','=',$id)
            ->get();
        echo $details;

    }
}
