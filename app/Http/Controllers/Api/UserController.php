<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\UserRegister;
use App\User;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    use VerifiesEmails;

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function update(Request $request, User $user,$id)
    {
        $request->validate([
                'name' => 'required',
                'surname' => 'required',
                'city' => '',
                'country' => '',
                'address' => '',
                'birthday' => '',
                'gender' => '',
                'phone' => '',
                'bonus' => '',
            ]);


        $user->where('id',$id)
            ->update($request->all());
        return response(['message' => 'your data succesfully update']);

    }


    public function updateEmail(Request $request)
    {
        $user = Auth::user();
        $user->activation_key        = rand(1000,9999);
        $user->activation_key_expire = date('Y-m-d H:i:s');
        $user->email                 = $request->email;
        $user->save();
        Mail::to($user)->send(new UserRegister($user));
        return \response(['message'=> 'your resend email sending']);

    }


    public function newPassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'old_password' => 'required',
            'password'     => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password,$user->password)){
            return response(['message'=> 'your password incoorect']);
        }
        $request['password'] = bcrypt($request['password']);
        $user->update($request->only(['password']));
        return response(['message' => 'your password succesfull updated']);

    }

    public function imageUpload(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'),$imageName);
        $user->update(['image' => public_path('images').'/'.$imageName]);
        return response(['message' => 'you succesfully upload image']);

    }


}
