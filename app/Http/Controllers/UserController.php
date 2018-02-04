<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Logging\Log;
use Validator;
use Illuminate\Http\Request;
use DB;

use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\view;
use Illuminate\Support\ServiceProvider;

class UserController extends Controller
{
    //
    function Register(Request $request){

        $email=$request->input('email');

        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'Lplace'=>'required|string|max:255',
        ]);



        if($validator->fails())
        {
            return response()->json([
                'error'=>TRUE,
                'errorName'=>"Validation failed"
            ], 401);
        }
        else {

            error_log($request);
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


                $uId=DB::table('users')
                    ->select('users.id')
                    ->where('email','=',$email)
                    ->get();

                //echo $uId;


                return response()->json([
                    'error' => FALSE,

                    'uId'=>$uId,
                ]);
            } else {
                return response()->json([
                    'error' => TRUE,
                    'message' => "Unknown error occured"
                ]);
            }
        }
    }

    function Login(Request $request){
        $email=$request->email;
        $password = $request->password;
        $remember=false;

        if(Auth::attempt(['email' => $email, 'password' => $password],$remember)){
            $uId=DB::table('users')
                ->select('users.id')
                ->where('email','=',$email)
                ->get();
            $fuId=$uId[0];
            return response()->json([
                'error'=>FALSE,
                'uId'=>$fuId,
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


    function Spinner(Request $request){



          $details = DB::table('areas')
              ->select('areas.areaName','areas.id')
              ->orderBy('areaName')
              ->get();
          echo $details;

    }
}
