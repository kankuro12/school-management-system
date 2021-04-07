<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ApiData as res;
use App\Models\ExtraInfo;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use SNMP;

class StaffController extends Controller
{
    //XXX list a school's staff

    public function index($school_id)
    {
        return res::s(Staff::join('users', 'users.id', '=', 'staff.user_id')
            ->select(
                'staff.id',
                'staff.name',
                'staff.phone',
                'staff.post',
                'users.email'
            )
            ->where('staff.school_id', $school_id)->get());
    }

    public function single($staff_id)
    {
        $staff = Staff::find($staff_id);
        if ($staff == null) {
            return res::f(['Cannot Find Staff']);
        }
        $staff->user;
        $staff->files = ExtraInfo::where('foreign_id', $staff_id)->where('type', 1)->where('identifire', 101)->get();
        return res::s($staff);
    }

    //XXX add a staff
    public function add(Request $request)
    {
        DB::beginTransaction();
        try {
            DB::commit();

            if (User::where('email', $request->email)->count() > 0) {
                return res::f(['Email Already Used']);
            }
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt("123456");
            $user->role = $request->role;
            $user->save();

            $staff = new Staff();
            $staff->name = $request->name;
            $staff->address = $request->address;
            $staff->phone = $request->phone;
            $staff->post = $request->post;
            $staff->gender = $request->gender;
            $staff->salary = $request->salary;
            $staff->nationality = $request->nationality;
            $staff->acc_no = $request->acc_no;
            $staff->fathername = $request->fathername;
            $staff->mothername = $request->mothername;
            $staff->spousename = $request->spousename;
            $staff->academic_qualification = $request->academic_qualification;
            $staff->professional_qualification = $request->professional_qualification;
            $staff->experience = $request->experience;
            $staff->start_date = $request->start_date;
            $staff->dob = $request->dob;
            $staff->maritial_status = $request->maritial_status;
            $staff->school_id = $request->school_id;
            $staff->user_id = $user->id;
            $staff->image = $request->image->store('staff/profile');
            $staff->save();


            $temp = [];
            foreach ($request->uploads as $value) {
                $file = new ExtraInfo();
                $file->identifier = 101;
                $file->type = 1;
                $file->foreign_id = $staff->id;
                $file->name = $request->input("doc_name_" . $value);
                $file->value = $request->file("doc_image_" . $value)->store('staff/docs');
                $file->save();
                array_push($temp, $file);
            }
            $staff->docs = $temp;
            $staff->user = $user;
            DB::commit();
            return res::s($staff);
        } catch (\Exception $ex) {
            DB::rollBack();
            return res::f([$ex->getMessage()]);
        }
    }

    //XXX update a staff
    public function update(Request $request)
    {
        $staff = Staff::find($request->id);
        if ($staff == null) {
            return res::f(['staff not found']);
        }
        $staff->name = $request->name;
        $staff->address = $request->address;
        $staff->phone = $request->phone;
        $staff->post = $request->post;
        $staff->gender = $request->gender;
        $staff->salary = $request->salary;
        $staff->nationality = $request->nationality;
        $staff->acc_no = $request->acc_no;
        $staff->fathername = $request->fathername;
        $staff->mothername = $request->mothername;
        $staff->spousename = $request->spousename;
        $staff->academic_qualification = $request->academic_qualification;
        $staff->professional_qualification = $request->professional_qualification;
        $staff->experience = $request->experience;
        $staff->start_date = $request->start_date;
        $staff->dob = $request->dob;
        $staff->maritial_status = $request->maritial_status;
        $staff->save();
        return res::s('Staff Updated Sucessfully');
    }

    //XXX change profile
    public function changeImage(Request $request)
    {
        $staff = Staff::find($request->id);
        if ($staff == null) {
            return res::f(['Staff Not Found']);
        }
        $staff->image = $request->image->store('staff/profile');
        $staff->save();
        return res::s($staff->image);
    }
    //XXX delete a staff
    public function delete(Request $request)
    {
        $staff = Staff::find($request->id);
        if ($staff == null) {
            return res::f(['Staff Not Found']);
        }
        $staff->delete();
        return res::s(['Staff Deleted Sucessfully']);
    }

    //XXX archive a staff
    public function archive(Request $request)
    {
        $staff = Staff::find($request->id);
        if ($staff == null) {
            return res::f(['Staff Not Found']);
        }
        $staff->archived = 1;
        $staff->save();
        return res::s(['Staff Archived Sucessfully']);
    }



    //XXX list documents
    public function listDoc($staff_id)
    {
        if (Staff::where('id', $staff_id)->count() == 0) {
            return res::f(['Staff Not Found']);
        }
        return res::s(ExtraInfo::where('foreign_id', $staff_id)->where('type', 1)->where('identifier', 101)->list());
    }

    //XXX add a document
    public function addDoc(Request $request)
    {
        if (Staff::where('id', $request->staff_id)->count() == 0) {
            return res::f(['Staff Not Found']);
        }
        $file = new ExtraInfo();
        $file->identifier = 101;
        $file->type = 1;
        $file->foreign_id = $request->staff_id;
        $file->name = $request->input("doc_name");
        $file->value = $request->file("doc_image")->store('staff/profile');
        $file->save();
        return res::s($file);
    }
    //XXX delete document
    public function delDoc(Request $request)
    {
        $file = ExtraInfo::find($request->id);
        if ($file == null) {
            return res::f(['File Not Found']);
        }
        $file->delete();
        return res::s('File Deleted Sucessfully');
    }
}
