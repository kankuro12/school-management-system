<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use App\ApiData as res;

//XXX Manage schools
class SchoolController extends Controller
{
    //XXX save and load school list
    public function index(Request $request){
        if($request->getMethod()=="POST"){
            if(User::where('email',$request->email)->count()){
                return res::f('The Email is Already in Use');
            }
            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=bcrypt( $request->password);
            $user->role=1;
            $user->save();

            $school=new School();
            $school->name=$request->name;
            $school->address=$request->address;
            $school->phone=$request->phone;
            $school->user_id=$user->id;
            $school->save();
            $school->user=$user;
            return res::s($school);
        }else{
            return res::s(School::with('user')->get());
        }
    }

    //XXX update School Info
    public function updateInfo(Request $request){
        $school=School::where('id',$request->id)->first();
        if($school==null){
            return res::f(['School Not Found']);
        }
        $school->name=$request->name;
        $school->address=$request->address;
        $school->phone=$request->phone;
        $school->save();
        return res::s('School Updates Sucessfully');
    }
    
    public function test(Request $request){
        // return res::s([$request->all(),$request->y->getClientOriginalName()]);
        dd($request);
    }

    public function info(){
        
    }
}
