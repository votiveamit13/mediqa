<?php

namespace App\Http\Controllers\medical_facilities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\User\AuthServices;
use App\Http\Requests\UserUpdateProfile;
use App\Http\Requests\UserChangePasswordRequest;
use App\Models\JobsModel;
use App\Models\Profession;
use App\Models\User;
use App\Models\PractitionerTypeModel;
use App\Models\SpecialityModel;
use App\Models\WorkshiftModel;
use App\Models\WorkPreferModel;
use App\Models\LanguageModel;
use App\Models\InterviewsNurse;
use App\Models\EmpTypeModel;
use App\Models\HealthcareSavedSearch;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Str;
use Mail;
use Validator;
use DB;
use URL;
use Session;
use Helpers;
use App\Repository\Eloquent\SpecialityRepository;
use App\Services\User\NurseJobMatchService;


class FindNurseController extends Controller
{
    public function index()
    {
            // $nurse_listing = DB::table('users')
            // ->select(
            //     'nurse_applications.status as application_status',
            //     'users.id',
            //     'ndis_screening_check.id as exist_ndis_screening',
            //     'working_children_check.id as exist_working_children',
            //       DB::raw('GROUP_CONCAT(DISTINCT profession_data.nurse_data) as type_of_nurse'),
            //       DB::raw('GROUP_CONCAT(DISTINCT profession_data.specialties) as speciality_type'),
            //       DB::raw('MAX(profession_data.assistent_level) as experience_level')
            // )
            // ->leftJoin('work_preferences', 'work_preferences.user_id', '=', 'users.id')
            // ->leftJoin('language_skills', 'language_skills.user_id', '=', 'users.id')
            // ->leftJoin('user_licenses_details', 'user_licenses_details.user_id', '=', 'users.id')
            // ->leftJoin('profession_data', 'profession_data.user_id', '=', 'users.id')
            // ->leftJoin('speciality', 'speciality.id', '=', 'profession_data.specialties')
            // ->leftJoin('practitioner_type', 'practitioner_type.id', '=', 'profession_data.nurse_data')
            // ->leftJoin('nurse_applications', 'nurse_applications.nurse_id', '=', 'users.id')
            // ->leftJoin('user_education_cerification', 'user_education_cerification.user_id', '=', 'users.id')
            // ->leftJoin('ndis_screening_check', 'ndis_screening_check.user_id', '=', 'users.id')
            // ->leftJoin('working_children_check', 'working_children_check.user_id', '=', 'users.id')
            // ->where([
            // 'users.role' => '1',
            // 'users.type' => '1',
            //  ])->whereIn('users.user_stage',['2','4'])
            // ->groupBy('users.id')
            // ->get();

            //  echo "<pre>";print_r($nurse_listing);die;

        $user = Auth::guard('healthcare_facilities')->user();
        $jobs = JobsModel::where('healthcare_id', $user->id)->where('save_draft', 2)->get();

       $list_saved_searches =  HealthcareSavedSearch::where('health_care_id',$user->id)->get();
        $nurse_list = User::where(['role' => '1','type' => '1'])->whereIn('user_stage', ['2', '4'])->orderBy('id', 'desc')->paginate(2);
        $jobs_count = JobsModel::where('healthcare_id', $user->id)->where('save_draft', 2)->count();
        // echo "<pre>"; print_r($nurse_list);die;
        return view('healthcare.find_nurse.job_find_nurse', compact('jobs','nurse_list','list_saved_searches','jobs_count'));
    }

    public function hFaddSavedSearches(Request $request)
    {
         $user_id = Auth::guard('healthcare_facilities')->user()->id;
        $saved = HealthcareSavedSearch::create([
            'health_care_id' => $user_id,
            'name' => $request->search_name,      
        ]);

        return response()->json([
            'status' => 1,
            'id' => $saved->id
        ]);
    }

    public function duplicateSearch(Request $request){
        $user_id = Auth::guard('healthcare_facilities')->user()->id;
        $saved = HealthcareSavedSearch::create([
            'health_care_id' => $user_id,
            'name' => $request->name,      
        ]);

        return response()->json([
            'success'=> true,
            'status' => 1,
            'id' => $saved->id
        ]);
    }


    public function shiftType_list(Request $request){
        
        $modal_no = $request->modal_no;
        $shiftType_list = WorkshiftModel::where('shift_id',0)->get();
        
        return view('healthcare.find_nurse.modal_category', compact('modal_no','shiftType_list'));
        // echo "test";die;
    }

    public function language_edit(Request $request){
        // echo "test";die;
        $modal_no = $request->modal_no;
        $language_skill = LanguageModel::where("sub_language_id",NULL)->where("test_id",NULL)->orderBy("language_name","ASC")->get();
        $specialized_lang_skills = LanguageModel::where("test_id","3")->orderBy("language_name","ASC")->get();
        
        return view('healthcare.find_nurse.edit_filter_modal', compact('modal_no','language_skill','specialized_lang_skills'));
    }

     public function shift_type_edit(Request $request){
        // echo "test";die;
        $modal_no = $request->modal_no;
        $shiftType_list = WorkshiftModel::where('shift_id',0)->get();
        
        return view('healthcare.find_nurse.edit_filter_modal', compact('modal_no','shiftType_list'));
    }
    public function employment_type_edit(Request $request){
        // echo "test";die;
        $modal_no = $request->modal_no;
        $employeement_type_list = EmpTypeModel::where('sub_prefer_id',0)->get();
        
        return view('healthcare.find_nurse.edit_filter_modal', compact('modal_no','employeement_type_list'));
    }
     public function nurse_type_edit(Request $request){
        // echo "test";die;
        $modal_no = $request->modal_no;
        $nurseType_list = SpecialityModel::where('parent',0)->get();
        
        return view('healthcare.find_nurse.edit_filter_modal', compact('modal_no','nurseType_list'));
    }
    public function getChildshiftType($parentId, Request $request)
    {
        $level = (int) $request->level;

        if ($level === 1) {
            // Level 2
            $children = WorkshiftModel::where('shift_id', $parentId)
                ->whereNull('sub_shift_id')
                ->get();
        } 
        elseif ($level === 2) {
            // Level 3
            $children = WorkshiftModel::where('sub_shift_id', $parentId)->get();
        } 
        else {
            $children = collect();
        }

        $children = $children->map(function($item) {
            $item->has_children = WorkshiftModel::where('sub_shift_id', $item->work_shift_id)->exists();
            return $item;
        });

        return response()->json($children);
    }

    public function language_list(Request $request){
        // echo "test";die;
        $modal_no = $request->modal_no;
        $language_skill = LanguageModel::where("sub_language_id",NULL)->where("test_id",NULL)->orderBy("language_name","ASC")->get();
        $specialized_lang_skills = LanguageModel::where("test_id","3")->orderBy("language_name","ASC")->get();
        return view('healthcare.find_nurse.modal_category', compact('modal_no','language_skill','specialized_lang_skills'));
        // echo "test";die;
    }
        public function apply_job_criteria(Request $request)
    {
        $savedSearchId = $request->saved_search_id;
        $jobId         = $request->job_id;

        // Fetch job detail from JobsModel
        $jobDetail = JobsModel::findOrFail($jobId);

        // Update HealthcareSavedSearch with job filters
        HealthcareSavedSearch::where('id', $savedSearchId)
            ->where('health_care_id', Auth::guard('healthcare_facilities')->user()->id)
            ->update([
                'job_id'                       => $jobDetail->id,
                'filter_summary'               => $jobDetail->filter_summary,
                'filters_nurse_type'           => $jobDetail->nurse_type_id ,
                'filters_employment_type'      => $jobDetail->emplyeement_type ,
                'result_count'                 => $jobDetail->result_count,
                'filters_shiftType'            => $jobDetail->shift_type,
                'filters_language'             => $jobDetail->filters_language,
                'filters_year_exp'             => $jobDetail->experience_level ,
                'filters_check_clearance'      => $jobDetail->checks_clearance_req,
                'filters_salary_expectance'    => $jobDetail->filters_salary_expectance,
                'filters_specialty'            => $jobDetail->typeofspeciality ,
                'filters_work_environment'     => $jobDetail->work_environment ,
                'filters_certification'        => $jobDetail->general_certification_req ,
                'filters_education'            => $jobDetail->degree,
            ]);

        return response()->json([
            'status'  => 1,
            'message' => 'Job criteria applied successfully.'
        ]);
    }
    public function nurseType_list(Request $request){
        
        $modal_no = $request->modal_no;
        $nurseType_list = SpecialityModel::where('parent',0)->get();
        
        return view('healthcare.find_nurse.modal_category', compact('modal_no','nurseType_list'));
        // echo "test";die;
    }

    public function speciality_edit(Request $request){

        $modal_no = $request->modal_no;
        $specialty_list = PractitionerTypeModel::where('parent',0)->get();
        
        return view('healthcare.find_nurse.edit_filter_modal', compact('modal_no','specialty_list'));
    }
      public function getChildnurseType($parentId)
    {
        $children = SpecialityModel::where('parent', $parentId)->get();
        $children = $children->map(function($item) {
            $item->has_children = SpecialityModel::where('parent', $item->id)->exists();
            return $item;
        });
        return response()->json($children);
    }
    public function speciality_list(Request $request){
        
        $modal_no = $request->modal_no;
        $speciality_list = PractitionerTypeModel::where('parent',0)->get();
        
        return view('healthcare.find_nurse.modal_category', compact('modal_no','speciality_list'));
        // echo "test";die;
    }

        public function getChildSpeciality($parentId)
    {
        $children = PractitionerTypeModel::where('parent', $parentId)->get();
        $children = $children->map(function($item) {
            $item->has_children = PractitionerTypeModel::where('parent', $item->id)->exists();
            return $item;
        });
        return response()->json($children);
    }

    public function work_environment_list(Request $request){
    
        $modal_no = $request->modal_no;
        $work_environment_list = WorkPreferModel::where('sub_env_id',0)->get();
        
        return view('healthcare.find_nurse.modal_category', compact('modal_no','work_environment_list'));
        // echo "test";die;
    }

    public function getChildWorkEnvironment($parentId, Request $request)
    {
        $level = $request->level;
        //echo $parentId;die;
        if ($level == 1) {
            // Load Level 2
            $children = WorkPreferModel::where('sub_env_id', $parentId)->where('sub_envp_id', 0)->get();
        } elseif ($level == 2) {
            // Load Level 3
            $children = WorkPreferModel::where('sub_envp_id', $parentId)->get();
        } else {
            $children = collect();
        }

        $children = $children->map(function($item) use ($level) {
            if ($level == 1) {
                $item->has_children = WorkPreferModel::where('sub_envp_id', $item->prefer_id)->exists();
            } else {
                $item->has_children = false;
            }
            return $item;
        });

        return response()->json($children);
    }

    public function employeement_type_list(Request $request){
    
        $modal_no = $request->modal_no;
        $employeement_type_list = EmpTypeModel::where('sub_prefer_id',0)->get();
        
        return view('healthcare.find_nurse.modal_category', compact('modal_no','employeement_type_list'));
        // echo "test";die;
    }

    

     public function getEmployeementType($parentId, Request $request)
    {
        $level = $request->level;
        //echo $parentId;die;
        if ($level == 1) {
            // Load Level 2
            $children = EmpTypeModel::where('sub_prefer_id', $parentId)->get();
        }

        $children = $children->map(function($item) use ($level) {
            if ($level == 1) {
                $item->has_children = EmpTypeModel::where('sub_prefer_id', $item->prefer_id)->exists();
            } else {
                $item->has_children = false;
            }
            return $item;
        });

        return response()->json($children);
    }

    public function international_hiring(Request $request){
        $modal_no = $request->modal_no;
        $get_countries = country_name_from_db();
        //print_r($get_countries);
        return view('healthcare.find_nurse.modal_category', compact('modal_no','get_countries'));
    }

    public function degree_list(Request $request){
    
        $modal_no = $request->modal_no;
        $degree_list = DB::table("degree")->get();
        
        return view('healthcare.find_nurse.modal_category', compact('modal_no','degree_list'));
        // echo "test";die;
    }

    public function certification_list(Request $request){
    
        $modal_no = $request->modal_no;
        $certification_list = DB::table("professional_certificate")->get();
        
        return view('healthcare.find_nurse.modal_category', compact('modal_no','certification_list'));
        // echo "test";die;
    }

    public function work_environment_edit(Request $request){
        // echo "test";die;
        $modal_no = $request->modal_no;
        $work_environment_list = WorkPreferModel::where('sub_env_id',0)->get();
        
        return view('healthcare.find_nurse.edit_filter_modal', compact('modal_no','work_environment_list'));
    }

    public function certification_edit(Request $request){
    
        $modal_no = $request->modal_no;
        $certification_edit = DB::table("professional_certificate")->get();
        
        return view('healthcare.find_nurse.edit_filter_modal', compact('modal_no','certification_edit'));
        // echo "test";die;
    }

     public function getCertificationType($parentId, Request $request)
    {
        
        $children = DB::table("professional_certificate_table")->where('cert_id', $parentId)->get();
        

        $children = $children->map(function($item) {
            
            $item->has_children = DB::table("professional_certificate_table")->where('cert_id', $item->professionalcert_id)->exists();
            
            return $item;
        });

        return response()->json($children);
    }

        
    // public function getChildSpeciality($parentId)
    // {
    //     $children = PractitionerTypeModel::where('parent', $parentId)->get();
    //     return response()->json($children);
    // }

    public function deleteMultipleSearches(Request $request){
         if (!$request->has('ids')) {
            return response()->json(['status' => 'error', 'message' => 'No IDs provided']);
        }
        HealthcareSavedSearch::whereIn('id', $request->ids)->delete();

        return response()->json(['status' => 'success']);
    }
    public function checkName(Request $request)
    {
        $user_id = Auth::guard('healthcare_facilities')->user()->id;
        $searchName = trim($request->search_name);

        $query = HealthcareSavedSearch::where('user_id', $user_id)
            ->whereRaw('LOWER(name) = ?', [strtolower($searchName)]);

        // Ignore same record (edit mode)
        if (!empty($request->id)) {
            $query->where('id', '!=', $request->id);
        }

        $exists = $query->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }
    public function checkNamerere(Request $request)
    {
       $user_id = Auth::guard('healthcare_facilities')->user()->id;
        $exists = HealthcareSavedSearch::where('user_id', $user_id)
            ->where('name', $request->search_name)
            ->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }

    public function commonModalEdit(Request $request){
        // echo "test";die;
        $modal_no = $request->modal_no;
        
        return view('healthcare.find_nurse.edit_filter_modal', compact('modal_no'));
    }
    public function apply_saved_search(Request $request)
    {
        $user_id = Auth::guard('healthcare_facilities')->user()->id;

        // Update the saved search record by id and health_care_id
        $updated = HealthcareSavedSearch::where('id', $request->selected_search_id)
            ->where('health_care_id', $user_id)
            ->update([
                'filter_summary' => !empty($request->filters_data_saved) ? json_encode($request->filters_data_saved) : "", 
                'filters_nurse_type' => !empty($request->filters_data_saved['nurse_type']) ? json_encode($request->filters_data_saved['nurse_type']) : "", 
                'filters_shiftType' => !empty($request->filters_data_saved['shiftType']) ? json_encode($request->filters_data_saved['shiftType']) : "", 
                'filters_language' => !empty($request->filters_data_saved['language']) ? json_encode($request->filters_data_saved['language']) : "", 
                'filters_employment_type' => !empty($request->filters_data_saved['employment_type']) ? json_encode($request->filters_data_saved['employment_type']) : "", 
                'filters_salary_expectance' => !empty($request->filters_data_saved['salary']) ? json_encode($request->filters_data_saved['salary']) : "", 
                'filters_year_exp' => !empty($request->filters_data_saved['year_experience']) ? $request->filters_data_saved['year_experience'] : "", 
                'filters_specialty' => !empty($request->filters_data_saved['specialty_type']) ? $request->filters_data_saved['specialty_type'] : "", 
                'filters_work_environment' => !empty($request->filters_data_saved['workEnvironment']) ? $request->filters_data_saved['workEnvironment'] : "", 
                'filters_certification' => !empty($request->filters_data_saved['certification']) ? $request->filters_data_saved['certification'] : "", 
                'filters_education' => !empty($request->filters_data_saved['degree']) ? $request->filters_data_saved['degree'] : "", 
                'filters_location' => !empty($request->filters_data_saved['location']) ? $request->filters_data_saved['location'] : "", 
                'filters_residency' => !empty($request->filters_data_saved['residency_status']) ? $request->filters_data_saved['residency_status'] : "", 
            ]);

        return response()->json([
            'status' => $updated ? 1 : 0,
            'id'     => $request->id,
            'health_care_id' => $user_id
        ]);
    }

      public function removeFilter(Request $request, $id)
{
    $savedSearch = DB::table("healthcare_saved_searches")
        ->where('id', $id)
        ->first();

    if (!$savedSearch) {
        return response()->json(['status' => 'error'], 404);
    }

    $filters = json_decode($savedSearch->filter_summary, true) ?? [];

    $key   = $request->input('key');
    $value = $request->input('value');

    if (isset($filters[$key]) && is_array($filters[$key])) {

        $filters[$key] = array_values(array_filter($filters[$key], function ($v) use ($value) {
            //echo $v."-".$value."<br>";
            
            return (string)$v !== (string)$value; // ✅ FIXED
        }));

        if (empty($filters[$key])) {
            unset($filters[$key]);
        }
    }

    DB::table("healthcare_saved_searches")
        ->where('id', $id)
        ->update([
            'filter_summary' => json_encode($filters, JSON_UNESCAPED_UNICODE)
        ]);

    return response()->json([
        'status' => 'success',
        'filters' => $filters
    ]);
} 
public function getCities(Request $request){
    $getlatlng = DB::table("states")->where("id",$request->state_code_value)->first();
    //$cities_data = DB::table("master_city")->where("city_state_id",$request->state_code_value)->get();
    //print_r($states_data);
    return json_encode($getlatlng);
}

public function apply_invite_message(Request $request)
    {

        $nurse = User::findOrFail($request->nurse_id);
        // Build message
        $message = $request->message ?? "You’re a strong match for this role and are invited to apply.";

        // If job_id exists, link to job
        $jobLink = null;
        if (!empty($request->job_id)) {
            $job = JobsModel::find($request->job_id);
            if ($job) {
                $jobLink = url('jobs/' . $job->id);
            }
        }

        // Build email body
        $htmlBody = '
            <!DOCTYPE html>
            <html lang="en">
            <head><meta charset="UTF-8"><title>Invitation to Apply</title></head>
            <body style="font-family: Arial, Helvetica, sans-serif; background:#f4f4f4; padding:20px;">
                <div style="max-width:600px; margin:auto; background:#fff; border-radius:8px; overflow:hidden;">
                    <div style="background:#000; padding:15px; text-align:center;">
                        <h2 style="color:#fff; margin:0;">Mediqa</h2>
                    </div>
                    <div style="padding:20px; color:#333;">
                        <p>Hello <strong>' . e($nurse->name) . '</strong>,</p>
                        <p>' . e($message) . '</p>';

        if ($jobLink) {
            $htmlBody .= '
                        <p style="text-align:center; margin:20px 0;">
                            <a href="' . $jobLink . '" target="_blank"
                            style="background:#000; color:#fff; padding:12px 24px; text-decoration:none; border-radius:5px;">
                            View Job & Apply
                            </a>
                        </p>';
        }

        $htmlBody .= '
                        <p style="font-size:14px; color:#777;">If you are not interested, you can ignore this email.</p>
                    </div>
                    <div style="background:#f0f0f0; padding:10px; text-align:center; font-size:12px; color:#777;">
                        © ' . date('Y') . ' Mediqa. All rights reserved.
                    </div>
                </div>
            </body>
            </html>
        ';

        try {
            \App\Helpers\ZeptoMailHelper::sendMail(
                $nurse->email,
                "Invitation to Apply - Mediqa",
                $htmlBody
            );
            \Log::info("Invite email sent", ['nurse_id' => $nurse->id]);
        } catch (\Throwable $ex) {
            \Log::error("Failed to send invite email", [
                'nurse_id' => $nurse->id,
                'error'   => $ex->getMessage()
            ]);
            return response()->json(['status' => 0, 'message' => 'Failed to send email.']);
        }

        return response()->json(['status' => 1, 'message' => 'Invitation sent successfully.']);
    }

    public function apply_invite_form(Request $request)
    {
        // Check if this nurse already has an application for this job
        $exists = NurseApplication::where('nurse_id', $request->nurse_id)
                                ->where('job_id', $request->job_id)
                                ->exists();

        if ($exists) {
            return response()->json([
                'status'  => 0,
                'message' => 'This nurse has already been invited to apply for the selected job.'
            ]);
        }

        // Create a new application record
        $application = new NurseApplication();
        $application->nurse_id    = $request->nurse_id;
        $application->job_id      = $request->job_id; // can be null
        $application->employer_id = $request->healthcare_id;
        $application->job_title   = $request->job_id 
                                    ? JobsModel::find($request->job_id)->job_title ?? null 
                                    : null;
        $application->status      = 3; // e.g. "shortlisted" or "invited"
        $application->applied_at  = now();

        $application->save();

        return response()->json([
            'status'  => 1,
            'message' => 'Invitation saved successfully.'
        ]);
    }

    public function modal_invite_apply(Request $request){
        // print_r($request->all());die;
        $modal_no = $request->modal_no;
        $healthcare_id = Auth::guard('healthcare_facilities')->user()->id;
        $nurse_detail = User::select('id','name','lastname','country','state')->where('id',$request->nurse_id)->first();
        $jobs_list = JobsModel::where('healthcare_id', $healthcare_id)->where('save_draft', 2)->get();
        return view('healthcare.find_nurse.modal_category', compact('modal_no','nurse_detail','healthcare_id','jobs_list'));
        // echo "test";die;
    }

   public function modal_invite_interview(Request $request){
        // print_r($request->all());die;
        $modal_no = $request->modal_no;
        $healthcare_id = Auth::guard('healthcare_facilities')->user()->id;
        $nurse_detail = User::select('id','name','lastname','country','state')->where('id',$request->nurse_id)->first();
        $jobs_list = JobsModel::where('healthcare_id', $healthcare_id)->where('save_draft', 2)->get();
        return view('healthcare.find_nurse.modal_category', compact('modal_no','nurse_detail','healthcare_id','jobs_list'));
        // echo "test";die;
    }

    public function interview_invite_form(Request $request)
    {
        // Prevent duplicate interview for same nurse/job on same date
        $exists = InterviewsNurse::where('nurse_id', $request->nurse_id)
                                ->where('job_id', $request->job_id)
                                // ->whereDate('scheduled_at', $request->preferred_date)
                                ->exists();

        if ($exists) {
            return response()->json([
                'status'  => 0,
                'message' => 'This nurse already has an interview scheduled for the selected job and date.'
            ]);
        }

        // Create new interview record
        $interview = new InterviewsNurse();
        $interview->nurse_id       = $request->nurse_id;
        $interview->job_id         = $request->job_id;
        $interview->employer_id    = $request->healthcare_id;
        $interview->meeting_type   = $request->meeting_mode; // maps to tinyint in schema
        $interview->scheduled_at   = $request->preferred_date . ' 00:00:00'; // store as datetime
        $interview->status         = 1; // default: scheduled
        $interview->notes          = $request->message;
        $interview->created_by     = $request->healthcare_id;
        $interview->updated_by     = $request->healthcare_id;

        $interview->save();

        return response()->json([
            'status'  => 1,
            'message' => 'Interview invitation saved successfully.'
        ]);
    }

        public function interview_invite_message(Request $request)
    {
        $nurse = User::findOrFail($request->nurse_id);

        // Build message
        $message = $request->message ?? "You’re invited to attend an interview for a nursing opportunity.";

        // If job_id exists, link to job
        $jobLink = null;
        if (!empty($request->job_id)) {
            $job = JobsModel::find($request->job_id);
            if ($job) {
                $jobLink = url('jobs/' . $job->id);
            }
        }

        // Build email body
        $htmlBody = '
            <!DOCTYPE html>
            <html lang="en">
            <head><meta charset="UTF-8"><title>Interview Invitation</title></head>
            <body style="font-family: Arial, Helvetica, sans-serif; background:#f4f4f4; padding:20px;">
                <div style="max-width:600px; margin:auto; background:#fff; border-radius:8px; overflow:hidden;">
                    <div style="background:#000; padding:15px; text-align:center;">
                        <h2 style="color:#fff; margin:0;">Mediqa</h2>
                    </div>
                    <div style="padding:20px; color:#333;">
                        <p>Hello <strong>' . e($nurse->name) . '</strong>,</p>
                        <p>' . e($message) . '</p>';

        if ($jobLink) {
            $htmlBody .= '
                        <p style="text-align:center; margin:20px 0;">
                            <a href="' . $jobLink . '" target="_blank"
                            style="background:#000; color:#fff; padding:12px 24px; text-decoration:none; border-radius:5px;">
                            View Job Details
                            </a>
                        </p>';
        }

        $htmlBody .= '
                        <p style="font-size:14px; color:#777;">Please confirm your availability for the interview. If you are not interested, you may ignore this email.</p>
                    </div>
                    <div style="background:#f0f0f0; padding:10px; text-align:center; font-size:12px; color:#777;">
                        © ' . date('Y') . ' Mediqa. All rights reserved.
                    </div>
                </div>
            </body>
            </html>
        ';

        try {
            \App\Helpers\ZeptoMailHelper::sendMail(
                $nurse->email,
                "Interview Invitation - Mediqa",
                $htmlBody
            );
            \Log::info("Interview invite email sent", ['nurse_id' => $nurse->id]);
        } catch (\Throwable $ex) {
            \Log::error("Failed to send interview invite email", [
                'nurse_id' => $nurse->id,
                'error'   => $ex->getMessage()
            ]);
            return response()->json(['status' => 0, 'message' => 'Failed to send interview email.']);
        }

        return response()->json(['status' => 1, 'message' => 'Interview invitation sent successfully.']);
    }
        public function get_saved_search_filters(Request $request)
    {
       
        $search = HealthcareSavedSearch::find($request->search_id);
        // print_r($search);die;
        if (!$search) {
            return response()->json(['status' => 0, 'message' => 'Saved search not found']);
        }

        return response()->json([
            'status' => 1,
            'filters' => json_decode($search->filter_summary, true) // assuming filters are stored as JSON
        ]);
    }
     public function getNurseSorting(Request $request, NurseJobMatchService $matchService)
    {

        // print_r($request->all());die;
        $query = DB::table('users')
            ->select(
                'nurse_applications.status as application_status',
                'users.*',
                'ndis_screening_check.id as exist_ndis_screening',
                'working_children_check.id as exist_working_children',
                  DB::raw('GROUP_CONCAT(DISTINCT profession_data.nurse_data) as type_of_nurse'),
                  DB::raw('GROUP_CONCAT(DISTINCT profession_data.specialties) as speciality_type'),
                  DB::raw('MAX(profession_data.assistent_level) as experience_level')
            )
            ->leftJoin('work_preferences', 'work_preferences.user_id', '=', 'users.id')
            ->leftJoin('language_skills', 'language_skills.user_id', '=', 'users.id')
            ->leftJoin('user_licenses_details', 'user_licenses_details.user_id', '=', 'users.id')
            ->leftJoin('profession_data', 'profession_data.user_id', '=', 'users.id')
            ->leftJoin('speciality', 'speciality.id', '=', 'profession_data.specialties')
            ->leftJoin('practitioner_type', 'practitioner_type.id', '=', 'profession_data.nurse_data')
            ->leftJoin('nurse_applications', 'nurse_applications.nurse_id', '=', 'users.id')
            ->leftJoin('user_education_cerification', 'user_education_cerification.user_id', '=', 'users.id')
            ->leftJoin('ndis_screening_check', 'ndis_screening_check.user_id', '=', 'users.id')
            ->leftJoin('working_children_check', 'working_children_check.user_id', '=', 'users.id')
            ->leftJoin('eligibility_to_work', 'eligibility_to_work.user_id', '=', 'users.id')
            ->leftJoin('salary_expectation', 'salary_expectation.user_id', '=', 'users.id')
            ->groupBy('users.id');

         if ($request->has('filters_data')) {
                $filters = $request->filters_data;
            if (!empty($filters['nurseType'])) {
                $values = $filters['nurseType'];

                $query->whereIn('profession_data.nurse_data', $values);
            }
            if (!empty($filters['speciality'])) {
                $values = $filters['speciality'];

                $query->whereIn('profession_data.specialties', $values);
            }
            if (!empty($filters['year_experience'])) {

                $value = is_array($filters['year_experience'])
                    ? max($filters['year_experience'])
                    : $filters['year_experience'];

                $query->having('experience_level', '>=', $value);
            }

            if (!empty($filters['check_clearance'])) {

                $values = $filters['check_clearance'];

                $query->where(function ($q) use ($values) {

                    if (in_array('ndis', $values)) {
                        $q->orWhereNotNull('ndis_screening_check.id');
                    }

                    if (in_array('wwcc', $values)) {
                        $q->orWhereNotNull('working_children_check.id');
                    }

                });
            }
            if (!empty($filters['shiftType'])) {
                $values = $filters['shiftType'];
                $query->where(function ($q) use ($values) {
                    foreach ($values as $id) {
                        
                        $q->orWhere('work_preferences.work_shift_preferences', 'LIKE', '%"'.$id.'"%');
                    }
                });
            }

            if (!empty($filters['residency_status'])) {
                $values = $filters['residency_status'];
                $query->where(function ($q) use ($values) {
                    foreach ($values as $id) {
                        
                        $q->orWhere('eligibility_to_work.residency', $id);
                    }
                });
            }

            if (!empty($filters['salary'])) {

                $min = $filters['salary']['min'];
                $max = $filters['salary']['max'];

                $query->whereRaw("
                    CAST(SUBSTRING_INDEX(REPLACE(annual_salary, '$', ''), '-', 1) AS UNSIGNED) <= ?
                    AND
                    CAST(SUBSTRING_INDEX(REPLACE(annual_salary, '$', ''), '-', -1) AS UNSIGNED) >= ?
                ", [$max, $min]);
            }

            if (!empty($filters['registration_values'])) {
                $values = $filters['registration_values'];

                
                    $query->where(function ($q) use ($values) {

                        foreach ($values as $id) {

                            if ($id == 1) {
                                $q->orWhere('user_licenses_details.ndis_status', 'registered');
                            }

                            if ($id == 2) {
                                $q->orWhere(function ($sub) {
                                    $sub->whereNotNull('user_licenses_details.medical_provider_no')
                                        ->where('user_licenses_details.medical_provider_no', '!=', '');
                                });
                            }

                            if ($id == 3) {
                                $q->orWhere(function ($sub) {
                                    $sub->whereNotNull('user_licenses_details.pbs_type')
                                        ->where('user_licenses_details.pbs_type', '!=', '');
                                });
                            }

                            if ($id == 4) {
                                $q->orWhere(function ($sub) {
                                    $sub->whereNotNull('user_licenses_details.immunization_state')
                                        ->where('user_licenses_details.immunization_state', '!=', '');
                                });
                            }

                            if ($id == 5) {
                                $q->orWhere(function ($sub) {
                                    $sub->whereNotNull('user_licenses_details.radiation_licence_type')
                                        ->where('user_licenses_details.radiation_licence_type', '!=', '');
                                });
                            }

                        }

                    });
                
            }

            if (!empty($filters['language'])) {
                $values = $filters['language'];

                $query->where(function ($q) use ($values) {
                    foreach ($values as $id) {
                        $q->orWhere(function ($subQ) use ($id) {
                            $subQ->where('language_skills.langprof_level', 'LIKE', '%"'.$id.'"%')
                                ->orWhere('language_skills.specialized_lang_skills', 'LIKE', '%"'.$id.'"%');
                        });
                    }
                });
            }
            if (!empty($filters['work_environment'])) {
                $values = $filters['work_environment'];
                $query->where(function ($q) use ($values) {
                    foreach ($values as $id) {
                        
                        $q->orWhere('work_preferences.work_environment_preferences', 'LIKE', '%"'.$id.'"%');
                    }
                });
            }

            if (!empty($filters['employment_type'])) {
                $values = $filters['employment_type'];
                $query->where(function ($q) use ($values) {
                    foreach ($values as $id) {
                        
                        $q->orWhere('work_preferences.emptype_preferences', 'LIKE', '%"'.$id.'"%');
                    }
                });
            }

            if (!empty($filters['degrees'])) {
                $values = $filters['degrees'];

                $query->where(function ($q) use ($values) {
                    foreach ($values as $id) {
                        $q->orWhereJsonContains('users.degree', $id);
                    }
                });
            }

            if (!empty($filters['certifications'])) {
                $values = $filters['certifications'];
                $query->where(function ($q) use ($values) {
                    foreach ($values as $id) {
                        
                        $q->orWhere('user_education_cerification.general_certification', 'LIKE', '%"'.$id.'"%');
                    }
                });
            }

            if (!empty($filters['location'])) {

                $lat    = (float) $filters['location']['lat'];
                $lng    = (float) $filters['location']['lng'];
                $radius = (float) $filters['location']['radius'];

                // Join states table (user state lat/lng)
                $query->join('states as s', 'users.state', '=', 's.id');

                // Optional country filter
                if (!empty($filters['location']['country'])) {
                    $query->where('users.active_country', $filters['location']['country']);
                }

                // Distance calculation
                $query->selectRaw("
                    users.*,
                    s.name as state_name,
                    (6371 * acos(
                        cos(radians(?)) 
                        * cos(radians(s.latitude)) 
                        * cos(radians(s.longitude) - radians(?)) 
                        + sin(radians(?)) 
                        * sin(radians(s.latitude))
                    )) AS distance
                ", [$lat, $lng, $lat]);

                // Bounding box (performance optimization)
                $latRange = $radius / 111;
                $lngRange = $radius / (111 * cos(deg2rad($lat)));

                $query->whereBetween('s.latitude', [$lat - $latRange, $lat + $latRange])
                    ->whereBetween('s.longitude', [$lng - $lngRange, $lng + $lngRange]);

                // Radius filter
                $query->having('distance', '<=', $radius);

                // Sort nearest first
                $query->orderBy('distance', 'asc');
            }

            

            if (!empty($filters['international_countries'])) {
                $values = $filters['international_countries'];
                $values_hiring = $filters['international_hiring'];
                //print_r($values_hiring);die;        
                if (!empty($values_hiring) && !empty($values)) {

                    $query->where(function ($mainQuery) use ($values_hiring, $values) {

                        // ✅ CASE: BOTH 1 & 2 selected
                        if (in_array("1", $values_hiring) && in_array("2", $values_hiring)) {

                            $mainQuery->where(function ($q) use ($values) {

                                foreach ($values as $country) {

                                    $q->orWhere(function ($sub) use ($country) {

                                        $sub->whereRaw("JSON_CONTAINS(users.registration_countries, '\"$country\"')")
                                            ->orWhereRaw("JSON_CONTAINS(work_preferences.countries, '\"$country\"')");

                                    });

                                }

                            });

                        }

                        // ✅ CASE: ONLY 1 selected
                        elseif (in_array("1", $values_hiring)) {

                            $mainQuery->where(function ($q) use ($values) {

                                foreach ($values as $country) {
                                    $q->orWhereRaw("JSON_CONTAINS(users.registration_countries, '\"$country\"')");
                                }

                            });

                        }

                        // ✅ CASE: ONLY 2 selected
                        elseif (in_array("2", $values_hiring)) {

                            $mainQuery->where(function ($q) use ($values) {

                                foreach ($values as $country) {

                                    $q->orWhere(function ($sub) use ($country) {

                                        $sub->whereRaw("JSON_CONTAINS(work_preferences.countries, '\"$country\"')")
                                            ->whereRaw("NOT JSON_CONTAINS(users.registration_countries, '\"$country\"')");

                                    });

                                }

                            });

                        }

                    });
                }
            }

        }

        // 🔍 Search
        if (!empty($request->nurse_registration)) {
            $query->where(function ($q) use ($request) {
                $q->where('users.name', 'LIKE', '%' . $request->nurse_registration . '%')
                ->orWhere('users.lastname', 'LIKE', '%' . $request->nurse_registration . '%')
                ->orWhere(DB::raw("CONCAT(users.name, ' ', users.lastname)"), 'LIKE', '%' . $request->nurse_registration . '%')
                ->orWhere('user_licenses_details.aphra_registration_no', 'LIKE', '%' . $request->nurse_registration . '%');
            });
        }

        // 🔍 Speciality / Role
        if (!empty($request->role_speciality)) {
            $query->where(function ($q) use ($request) {
                $q->where('speciality.name', 'LIKE', '%' . $request->role_speciality . '%')
                ->orWhere('practitioner_type.name', 'LIKE', '%' . $request->role_speciality . '%');
            });
        }

        if (!empty($request->available_to_start)) {
            $query->where('users.start_job_dropdown', $request->available_to_start);
        }

        // ✅ Fixed Conditions
        $query->where([
            'users.role' => '1',
            'users.type' => '1',
        ])->whereIn('users.user_stage',['2','4']);

        if (!empty($request->search_id) && is_numeric($request->search_id)) {
            $manage_save_search = HealthcareSavedSearch::where('id', $request->search_id)->first();

            if (!empty($manage_save_search->filters_nurse_type)) {
                $query->whereIn('profession_data.nurse_data', [$manage_save_search->filters_nurse_type]);
            }

            if (!empty($manage_save_search->filters_language)) {
                $values = json_decode($manage_save_search->filters_language, true);

                if (!empty($values)) {
                    $query->where(function ($q) use ($values) {
                        foreach ($values as $id) {
                            $q->orWhere(function ($subQ) use ($id) {
                                $subQ->where('language_skills.langprof_level', 'LIKE', '%"'.$id.'"%')
                                    ->orWhere('language_skills.specialized_lang_skills', 'LIKE', '%"'.$id.'"%');
                            });
                        }
                    });
                }
            }

            if (!empty($manage_save_search->filters_year_exp)) {
                $value = $manage_save_search->filters_year_exp;
                $query->having('experience_level', '>=', $value);
            }

            if (!empty($manage_save_search->filters_employment_type)) {
                // Decode JSON array from DB
                $values = json_decode($manage_save_search->filters_employment_type, true);

                if (!empty($values)) {
                    $query->where(function ($q) use ($values) {
                        foreach ($values as $id) {
                            $q->orWhere('work_preferences.emptype_preferences', 'LIKE', '%"'.$id.'"%');
                        }
                    });
                }
            }

            if (!empty($manage_save_search->filters_shiftType)) {
                // Decode JSON array from DB
                $values = json_decode($manage_save_search->filters_shiftType, true);

                if (!empty($values)) {
                    $query->where(function ($q) use ($values) {
                        foreach ($values as $id) {
                            $q->orWhere('work_preferences.work_shift_preferences', 'LIKE', '%"'.$id.'"%');
                        }
                    });
                }
            }

            if (!empty($manage_save_search->filters_salary_expectance)) {
                // Decode JSON object from DB
                $salary = json_decode($manage_save_search->filters_salary_expectance, true);

                if (!empty($salary['min']) && !empty($salary['max'])) {
                    $min = (int) $salary['min'];
                    $max = (int) $salary['max'];

                    $query->whereRaw("
                        CAST(SUBSTRING_INDEX(REPLACE(annual_salary, '$', ''), '-', 1) AS UNSIGNED) <= ?
                        AND
                        CAST(SUBSTRING_INDEX(REPLACE(annual_salary, '$', ''), '-', -1) AS UNSIGNED) >= ?
                    ", [$max, $min]);
                }
            }
            
            if (!empty($manage_save_search->filters_check_clearance)) {
                // Decode JSON array from DB
                $values = json_decode($manage_save_search->filters_check_clearance, true);

                if (!empty($values)) {
                    $query->where(function ($q) use ($values) {
                        if (in_array('ndis', $values)) {
                            $q->orWhereNotNull('ndis_screening_check.id');
                        }

                        if (in_array('wwcc', $values)) {
                            $q->orWhereNotNull('working_children_check.id');
                        }
                    });
                }
            }

            if (!empty($manage_save_search->filters_speciality_type)) {
                // Decode JSON array from DB
                $values = json_decode($manage_save_search->filters_speciality_type, true);

                if (!empty($values)) {
                    $query->whereIn('profession_data.specialties', $values);
                }
            }

            if (!empty($manage_save_search->filters_work_environment)) {

                $values = json_decode($manage_save_search->filters_work_environment, true);

                $flatIds = collect($values)->flatten()->unique();

                $query->where(function ($q) use ($flatIds) {
                    foreach ($flatIds as $id) {
                        $q->orWhereJsonContains(
                            'work_preferences.work_environment_preferences',
                            $id
                        );
                    }
                });
            }

            if (!empty($manage_save_search->filters_certification)) {
                $values = json_decode($manage_save_search->filters_certification, true);
                $query->where(function ($q) use ($values) {
                    foreach ($values as $id) {
                        
                        $q->orWhere('user_education_cerification.general_certification', 'LIKE', '%"'.$id.'"%');
                    }
                });
            }

            if (!empty($manage_save_search->location)) {
                $location_data = json_decode($manage_save_search->location);
                $lat    = (float) $location_data['location']['lat'];
                $lng    = (float) $location_data['location']['lng'];
                $radius = (float) $location_data['location']['radius'];

                // Join states table (user state lat/lng)
                $query->join('states as s', 'users.state', '=', 's.id');

                // Optional country filter
                if (!empty($filters['location']['country'])) {
                    $query->where('users.active_country', $location_data['location']['country']);
                }

                // Distance calculation
                $query->selectRaw("
                    users.*,
                    s.name as state_name,
                    (6371 * acos(
                        cos(radians(?)) 
                        * cos(radians(s.latitude)) 
                        * cos(radians(s.longitude) - radians(?)) 
                        + sin(radians(?)) 
                        * sin(radians(s.latitude))
                    )) AS distance
                ", [$lat, $lng, $lat]);

                // Bounding box (performance optimization)
                $latRange = $radius / 111;
                $lngRange = $radius / (111 * cos(deg2rad($lat)));

                $query->whereBetween('s.latitude', [$lat - $latRange, $lat + $latRange])
                    ->whereBetween('s.longitude', [$lng - $lngRange, $lng + $lngRange]);

                // Radius filter
                $query->having('distance', '<=', $radius);

                // Sort nearest first
                $query->orderBy('distance', 'asc');
            }

            if (!empty($manage_save_search->filters_residency)) {
                $values = json_decode($manage_save_search->filters_residency);

                $query->where(function ($q) use ($values) {
                    foreach ($values as $id) {
                        
                        $q->orWhere('eligibility_to_work.residency', $id);
                    }
                });
            }

            $manage_save_search->update(['last_run_at' => now()]);

        }

        $nurse_list = $query->get();

        $matchedData = [];

        // 👉 ONLY if job selected

        if (!empty($request->search_id && !is_numeric($request->search_id)))  {
            $job = DB::table('job_boxes')->where('job_box_id', $request->search_id)->first();

            if ($job) {
                foreach ($nurse_list as $nurse) {
                    $userId = $nurse->id;

                    // Profession Data
                    $nurseData = DB::table('profession_data')
                        ->where('user_id', $userId)
                        ->get();

                    $nurseTypes       = $nurseData->pluck('nurse_data')->toArray();
                    $nurseSpecialties = $nurseData->pluck('specialties')->toArray();
                    $experience_data  = $nurseData->pluck('assistent_level');

                    // Vaccination
                    $nurseVaccines = DB::table('vaccination_front')
                        ->where('user_id', $userId)
                        ->pluck('vaccination_id')
                        ->toArray();

                    // Checks
                    $eligibility     = DB::table('eligibility_to_work')->where('user_id', $userId)->first();
                    $policeCheck     = DB::table('police_check')->where('user_id', $userId)->exists();
                    $workingChildren = DB::table('working_children_check')->where('user_id', $userId)->exists();
                    $ndisCheck       = DB::table('ndis_screening_check')->where('user_id', $userId)->exists();

                    // Preferences
                    $preferences = DB::table('work_preferences')->where('user_id', $userId)->first();

                    // ✅ FIX: pass full nurse object, not just ID
                    $nurse->match_percentage = $matchService->calculateMatch(
                        $nurse,            // full object
                        $nurseTypes,
                        $nurseSpecialties,
                        $experience_data,
                        $nurseVaccines,
                        $eligibility,
                        $policeCheck,
                        $workingChildren,
                        $ndisCheck,
                        $preferences,
                        $job
                    );

                    $matchedData[] = $nurse;
                }

                // ✅ Sort by match %
                if ($request->sort_by == "top_matches") {
                    $matchedData = collect($matchedData)
                        ->sortByDesc('match_percentage')
                        ->values()
                        ->toArray();
                }
            }
        } else {
            // 🚫 No Job → No %
            foreach ($nurse_list as $nurse) {
                $nurse->match_percentage = null;
                $matchedData[] = $nurse;   
            }
        }

        $collection = collect($matchedData);

        $nurse_list = new \Illuminate\Pagination\LengthAwarePaginator(
            $collection->forPage($request->page ?? 1, 2),
            $collection->count(),
            2,
            $request->page ?? 1
        );

        if ($nurse_list->count() == 0) {
            return response()->json([
                'status' => false,
                'html' => ''
            ]);
        }

        return response()->json([
            'status' => true,
            'html' => view('healthcare.find_nurse.partial_find_nurse', compact('nurse_list'))->render()
        ]);
    }

}
