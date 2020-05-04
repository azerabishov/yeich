<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\UserRegister;
use App\Notifications\ResetNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'city' => '',
            'country' => '',
            'address' => '',
            'birthday' => '',
            'gender' => '',
            'phone' => '',
            'bonus' => '',
        ]);

//        if( User::where('email',$request->email)->first() ) {
//            return response(['message' => 'this email exist. Please use another email']);
//        }

        $validateData['activation_key'] = rand(1000,9999);
        $validateData['activation_key_expire'] = date('Y-m-d H:i:s');
        $validateData['password'] = bcrypt($validateData['password']);
        $user = User::create($validateData);
        $accessToken = $user->createToken('authToken')->accessToken;
        Mail::to($user)->send(new UserRegister($user));
        return response(['token' => $accessToken]);
    }


    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!Auth::attempt($loginData)){
            return response(['message' => 'no']);
        }

        $accessToken = Auth::user()->createToken('access_token')->accessToken;

        return response(['token' => $accessToken]);

    }
}
