<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\UserRegister;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
date_default_timezone_set('Asia/Baku');


class VerificationController extends Controller
{




    use VerifiesEmails;


    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('auth:api');
//        $this->middleware('signed')->only('verify');
//        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(Request $request)
    {
        $user = Auth::user();

        if(date('Y-m-d H-i-s',time()) > date('Y-m-d H-i-s',strtotime('+180 minutes',strtotime($user['activation_key_expire'])))){
            return response(['message'=>'Your key expire']);
        }elseif ($user['activation_key']!=$request->key) {
            return response(['message'=>'wrong credential']);
        }

        $request->user()->markEmailAsVerified();
        return \response(['message'=>'your email verified']);
    }


    public function resend(Request $request)
    {
        $user = Auth::user();
        $user->activation_key = rand(1000,9999);
        $user->activation_key_expire = date('Y-m-d H:i:s');
        $user->save();
        Mail::to($user)->send(new UserRegister($user));
        return \response(['message'=> 'your resend email sending']);
    }
}
