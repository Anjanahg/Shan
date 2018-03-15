<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember = $request->rememberMe;
        if (Auth::attempt(['email' => $email, 'password' => $password],$remember)) {
            // Authentication passed...
            //return redirect()->intended('dashboard');
            $user = Auth::user();
            $token = $user->createToken('Access Token')->accessToken;
            $data = [
                'name'=>$user->fname." ".$user->lname,
                'email'=>$user->email,
                'user_type'=>User::find($user->id)->role->roleName,
                'created_at'=>$user->created_at->format('Y-m-d'),
                'updated_at'=>$user->updated_at->format('Y-m-d')
            ];
            return response()->json([
                'error'=>FALSE,
                'Token'=>$token,
                'user' =>$email,
            ]);
        }
        else
        {
            return response()->json([
                'error'=>TRUE,
                'message'=>"Login cridentials are wrong!"
            ],401);
        }
    }
}
