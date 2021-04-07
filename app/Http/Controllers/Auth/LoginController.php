<?php

namespace App\Http\Controllers\Auth;
use App\ApiData as res;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function emaillogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $okk = true;
            $token = $user->createToken('logintoken')->accessToken;
            return res::s([ 'user' => $user,'token' => $token]);
        }
        return res::f('Login Failed');
    }

    public function changepass(Request $request)
    {
        $user = Auth::user();
        if (Hash::check($request->password, $user->password)) {
            $user->password = bcrypt($request->newpassword);
            $user->save();
            return res::s( "Password Changed Sucessfully");
        } else {
            return res::f( "Old Password Not Match");
        }
    }

    public function user(){
        $user=Auth::user();
        if($user->role==1){
            $user->school=School::where('user_id',$user->id)->first();
        }
        return res::s($user);
    }
}
