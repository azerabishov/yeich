<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $request->user()->sendEmailVerificationNotification();
        return \response(['message'=> 'your resend email sending']);

    }


    public function newPassword(Request $request,$id)
    {
        $user = User::find($id);
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password,$user->password)){
            return response(['message'=> 'your password incoorect']);
        }
        $request['password'] = bcrypt($request['password']);

        $user->update($request->except(['old_password','password_confirmation']));

        return response(['message' => 'your password succesfull updated']);

    }

    public function imageUpload(Request $request, User $user, $id)
    {
        $user = User::find($id);
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'),$imageName);


        $user->update(['photo' => public_path('images').'/'.$imageName]);

        return response(['message' => 'you succesfully upload image']);

    }

    public function destroy($id)
    {

    }



}
