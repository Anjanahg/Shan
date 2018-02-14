<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Logging\Log;
use Validator;
use Illuminate\Http\Request;
use DB;

use App\User;
use App\UserPointsRedeem;
use App\Complain;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\view;
use Illuminate\Support\ServiceProvider;

class UserController extends Controller
{
    //
    function Register(Request $request)
    {

        $email = $request->input('email');

        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'Lplace' => 'required|string|max:255',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'error' => TRUE,
                'errorName' => "Validation failed"
            ], 401);
        } else {


            //if any user does not existed with email then create new user
            //admin creates normal users
            //or he invites to users via email
            //dd(User::all());
            $user = User::create([
                'fullname' => $request['fullname'],
                'email' => $request['email'],
                'address' => $request['address'],
                'mobileno' => $request['mobileno'],
                'password' => bcrypt($request['password']),
                'Lplace' => $request['Lplace'],
                'areaId' => $request['areaId']

            ]);


            /*if user is created then $user can not be NULL
            *
            *
            */

            if ($user) {


                $uId = DB::table('users')
                    ->select('users.id')
                    ->where('email', '=', $email)
                    ->get();


                //-------------------------------------------
                $table = new UserPointsRedeem();
                $table->uId = object_get($uId[0], "id", null);
                $table->totalPoints = 0;
                $table->remaining = 0;
                $table->redeem = 0;
                $table->save();


                return response()->json([
                    'error' => FALSE,

                    'uId' => $uId,
                ]);
            } else {
                return response()->json([
                    'error' => TRUE,
                    'message' => "Unknown error occured"
                ]);
            }
        }


    }

    function Login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember = false;

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            $uId = DB::table('users')
                ->select('users.id')
                ->where('email', '=', $email)
                ->get();
            $fuId = $uId[0];
            return response()->json([
                'error' => FALSE,
                'uId' => $fuId,
                'message' => "success",
            ]);
        } else {

            return response()->json([
                'error' => TRUE,
                'message' => "Wrong credintials"
            ]);
        }
    }


    function Spinner(Request $request)
    {


        $details = DB::table('areas')
            ->select('areas.areaName', 'areas.id')
            ->orderBy('areaName')
            ->get();
        echo $details;

    }

    function GetUsername(Request $request)
    {
        $uId = $request->uId;

        $name = DB::table('users')
            ->select('users.fullname')
            ->where('id', '=', $uId)
            ->get();

        echo $name;


    }


    function ViewProfile(Request $request)
    {
        $uId = $request->uId;

        $details = DB::table('users')
            ->select('users.fullname', 'users.mobileno', 'users.email', 'users.address','users.id')
            ->where('id', '=', $uId)
            ->get();

        echo $details;

    }

    function ViewPoints(Request $request)
    {
        $uId = $request->uId;

        $points = DB::table('user_points_redeems')
            ->select('user_points_redeems.totalPoints')
            ->where('uId', '=', $uId)
            ->get();

        $pointvalue = DB::table('manage_points')
            ->select('manage_points.value')
            ->where('category', '=', "points")
            ->get();
        $totalRupees = (double)object_get($points[0], "totalPoints", null) * (double)object_get($pointvalue[0], "value", null);

        $remaining = DB::table('user_points_redeems')
            ->select('user_points_redeems.remaining')
            ->where('uId', '=', $uId)
            ->get();
        $fremaining = object_get($remaining[0], "remaining", null) * (double)object_get($pointvalue[0], "value", null);


        $redeem = DB::table('user_points_redeems')
            ->select('user_points_redeems.redeem')
            ->where('uId', '=', $uId)
            ->get();

        $fredeem = object_get($redeem[0], "redeem", null) * (double)object_get($pointvalue[0], "value", null);


        return response()->json([
            'totalRupees' => $totalRupees,
            'remaining' => $fremaining,
            'redeem' => $fredeem
        ]);


    }




    function SendComplain(Request $request)
    {
        $uId = $request->uId;
        $complain = $request->txtComplain;



        $table=new Complain();
        $table->uId=$uId;
        $table->description=$complain;
        $table->state=1;
        $table->save();
        if($table){
            return response()->json([
                'error' => false,
                'message' => "Success"
            ]);

        }else{
            return response()->json([
                'error' => true,
                'message' => "Error!!"
            ]);
        }

    }



    function ComplainsList(Request $request)
    {
        $uId = $request->uId;





        $complainDate = DB::table('complains')
            ->select('complains.created_at','complains.id')
            ->where('uId', '=', $uId)
            ->get();


        echo $complainDate;




    }



    function ComplainDetails(Request $request)
    {
        $complainId = $request->complainId;






        $details = DB::table('complains')
            ->select('complains.description','complains.reply')
            ->where('id', '=', $complainId)
            ->get();


        echo $details;




    }
}
