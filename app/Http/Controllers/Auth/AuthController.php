<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\ApiData as res;
class AuthController extends Controller
{
    //XXX update user Email
    public function updateEmail(Request $request){
        $user=User::where('id',$request->user_id)->first();
        if($user==null){
            return res::f(['User Not Found']);
        }

        if(User::where('email',$request->email)->where('id','<>',$request->user_id)->count()>0){
            return res::f(['Email Already Used']);
        }

        $user->email=$request->email;
        $user->save();
        return res::s('Email Updated Sucessfully');
    }

    //XXX Update user Password
    public function updatePassword(Request $request){
        $user=User::where('id',$request->user_id)->first();
        if($user==null){
            return res::f(['User Not Found']);
        }
        $user->password=bcrypt( $request->password);
        $user->save();
        return res::s('Password Updated Sucessfully');
    }
}
