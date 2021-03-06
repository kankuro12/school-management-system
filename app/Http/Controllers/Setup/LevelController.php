<?php

namespace App\Http\Controllers\Setup;
use App\ApiData as res;
use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Section;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    //XXX list all levels with section for a school
    public function index($school_id){
        return res::s(Level::where('school_id',$school_id)->with('sections')->get());
    }

    //XXX add a level
    public function add(Request $request){
        
            $level=new Level();
            $level->name=$request->name;
            $level->school_id=$request->school_id;
            $level->save();
            $level->sections=[];
            return res::s($level);
        
    }

    //XXX update a level

    public function update(Request $request){
        $level=Level::find($request->id);
        if($level==null){
            return res::f('Level Not found.',404);
        }
        $level->name=$request->name;
        $level->save();
        return res::s('Level Updated Successfully');
    }

    //XXX delete a level
    public function delete(Request $request){
        $level=Level::find($request->id);
        if($level==null){
            return res::f('Level Not found.',404);
        }
        $level->delete();
        return res::s('Level Deleted Successfully');
    }

    //XXX add a section
    public function AddSection(Request $request){
        $level=Level::find($request->level_id);
        if($level==null){
            return res::f('Level Not found.',404);
        }
        $section=new Section();
        $section->name=$request->name;
        $section->level_id=$request->level_id;
        $section->school_id=$request->school_id;
        $section->save();
        return res::s($section);
    }

    //XXX update a section
    public function updateSection(Request $request){
        $section=Section::find($request->id);
        if($section==null){
            return res::f('Level Not found.',404);
        }
      
        $section->name=$request->name;
        
        $section->save();
        return res::s("section updated Successfully");
    }

    //XXX delete a section
    public function deleteSection(Request $request){
        $section=Section::find($request->id);
        if($section==null){
            return res::f('Level Not found.',404);
        }
        $section->delete();
        return res::s("section Deleted Successfully");
    }
}
