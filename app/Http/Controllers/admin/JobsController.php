<?php

namespace App\Http\Controllers\admin;
use App\Http\Requests\AddnewsletterRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Log;
use App\Services\User\AuthServices;
use App\Http\Requests\UserUpdateProfile;
use App\Http\Requests\UserChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Str;
use Helpers;
use Mail;
use Validator;
use DB;
use URL;
use Session;
use File;
use App\Services\Admins\SpecialityServices;
use Illuminate\Support\Facades\Storage;

use App\Models\JobsModel;
use App\Models\NurseApplication;

class JobsController extends Controller
{
    
    
    public function index()
    {
        return view("admin.add_jobs");
    }

    public function edit_jobs(Request $request)
    {
        $data['country'] = DB::table('country')->where('status', 1)->get();
        $data['agencies_list'] = DB::table('agencies')->where('status',1)->get();
        $data['job_list'] = DB::table("job_boxes")->where("id",$request->id)->first();
        return view("admin.edit_jobs")->with($data);
    }

    public function jobList()
    {
        $data['job_list'] = DB::table("job_boxes")->Where("save_draft",2)->orWhere("save_draft",1)->orWhere("save_draft",3)->orderBy("created_at","desc")->get();
        return view("admin.job_list")->with($data);
    }

        public function applied_nurse_list($id = null)
    {
        // $id = 51;
        $nurse_application = NurseApplication::with('nurse')->where('job_id', $id)->get();
        $job_information = JobsModel::select('job_title','job_box_id')->where('id',$id)->first();
        // echo "<pre>"; print_r($job_information);die;
        return view('admin.applied_nurse_list', compact('nurse_application','job_information'));
    }
    public function addJobs(Request $request)
    {
        $nurse_type_name = DB::table('practitioner_type')->where('id', $request->nurse_type)->pluck('name');
        $nurse_type = $request->nurse_type;
        //print_r($nurse_type);die;
        $typeofspeciality = $request->typeofspeciality;
        $degree = $request->ndegree;
        $certification_licenses = $request->certification_licenses;
        $location_name = $request->location_name;
        $agency_name = $request->agency_name;
        $experience_level = $request->experience_level;
        $sector = $request->sector;
        $emplyeement_type = $request->emplyeement_type;
        $emplyeement_positions = $request->emplyeement_positions;
        $mandatory_tarining = $request->mandatory_tarining;
        $mandatory_education = $request->mandatory_education;
        $professional_membership = $request->professional_membership;
        $award_recognition = $request->award_recognition;
        $language_proficiency = $request->language_proficiency;
        $language_certification = $request->language_certification;
        $shift_type = $request->shift_type;
        $work_environment = $request->work_environment;
        $benefits = $request->benefits;
        $salary = $request->salary;
        $job_id = $request->job_id;
        $application_submission_date = $request->application_submission_date;
        $urgent_hire_tag = isset($request->urgent_hire_tag)? 1: 0;

        if($job_id){
            $jobs = JobsModel::find($job_id);
            // $jobs->nurse_type = json_encode($nurse_type);
            $jobs->nurse_type = json_encode($nurse_type_name);
            $jobs->nurse_type_id = json_encode($nurse_type);
            $jobs->typeofspeciality = json_encode($typeofspeciality);
            $jobs->degree = json_encode($degree);
            $jobs->sector = $sector;
            $jobs->location_name = $location_name;
            $jobs->agency_name = $agency_name;
            $jobs->experience_level = $experience_level;
            $jobs->emplyeement_type = json_encode($emplyeement_type);
            $jobs->emplyeement_positions = json_encode($emplyeement_positions);
            $jobs->mandatory_tarining = json_encode($mandatory_tarining);
            $jobs->mandatory_education = json_encode($mandatory_education);
            $jobs->professional_membership = json_encode($professional_membership);
            $jobs->award_recognition = json_encode($award_recognition);
            $jobs->language_proficiency = json_encode($language_proficiency);
            $jobs->language_certification = json_encode($language_certification);
            $jobs->shift_type = json_encode($shift_type);
            $jobs->work_environment = json_encode($work_environment);
            $jobs->benefits = json_encode($benefits);
            $jobs->salary = $salary;
            $jobs->application_submission_date = $application_submission_date;
            $jobs->urgent_hire = $urgent_hire_tag;
            $run = $jobs->save();
        }else{
            $jobs = new JobsModel;
            $jobs->nurse_type = json_encode($nurse_type);
            $jobs->typeofspeciality = json_encode($typeofspeciality);
            $jobs->degree = json_encode($degree);
            $jobs->sector = $sector;
            $jobs->location_name = $location_name;
            $jobs->agency_name = $agency_name;
            $jobs->experience_level = $experience_level;
            $jobs->emplyeement_type = json_encode($emplyeement_type);
            $jobs->emplyeement_positions = json_encode($emplyeement_positions);
            $jobs->shift_type = json_encode($shift_type);
            $jobs->work_environment = json_encode($work_environment);
            $jobs->benefits = json_encode($benefits);
            $jobs->salary = $salary;
            $jobs->application_submission_date = $application_submission_date;
            $jobs->urgent_hire = $urgent_hire_tag;
            $run = $jobs->save();
        }
        

        if($run){
            return response()->json(['status' => '1']);
        }
        

        
    }

    public function job_details(Request $request){
        $job_id = $request->id;
        $data['jobs'] = DB::table("job_boxes")->where("id", $job_id)->first();
        $data['healthcare_data'] = DB::table("users")->where("id",$data['jobs']->healthcare_id)->first();
        $data['state_data'] = DB::table("states")->where("id",$data['jobs']->location_state)->first();
        return view('admin.view_job')->with($data);
    }
}