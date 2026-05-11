<?php

namespace App\Http\Controllers\medical_facilities;

use App\Models\CountryModel;
use App\Models\User;
use App\Models\ProfessionModel;
use App\Models\EligibilityToWorkModel;
use App\Models\WorkingChildrenCheckModel;
use App\Models\PoliceCheckModel;
use App\Models\PractitionerTypeModel;
use App\Models\LanguageModel;

use App\Models\WorkPreferModel;
use App\Models\JobsModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NurseApplication;
use App\Events\JobPublished;
use App\Notifications\JobPublishedNotification;

use Illuminate\Support\Facades\Log;
use App\Services\User\AuthServices;
use App\Http\Requests\UserUpdateProfile;
use App\Http\Requests\UserChangePasswordRequest;
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

use App\Models\SpecialityModel;

use App\Repository\Eloquent\SpecialityRepository;

class JobPostingController extends Controller
{
    public function job_posting()
    {
        if(isset($_GET['job_id'])){
            $job_id = $_GET['job_id'];
        }else{
            $job_id = Session::get('jobId');
        }
        $data['job_data'] = JobsModel::where("id",$job_id)->first();
        $data['job_id'] = $job_id;

        $user_id = Auth::guard('healthcare_facilities')->user()->id;

        //expire_jobs($user_id);

        return view('healthcare.job_posting')->with($data);
    }

    public function change_password()
    {
        return view('healthcare.change_password');
    }

    public function getWorkplaceData(Request $request)
    {

        $place_id = $request->place_id;

        $data['work_data'] = DB::table("work_enviornment_preferences")->where("sub_env_id",$place_id)->where("sub_envp_id",0)->orderBy('env_name', 'ASC')->get();
        $environment_name = DB::table("work_enviornment_preferences")->where("prefer_id",$place_id)->first();
        //print_r(json_encode($data));
        $data['env_name'] = $environment_name->env_name;
        $data['prefer_id'] = $place_id;
        return json_encode($data);
    }

    public function getSubWorkplaceData(Request $request)
    {

        $place_id = $request->place_id;
        $subplace_id = $request->subplace_id;
        $data['work_data'] = DB::table("work_enviornment_preferences")->where("sub_env_id",$place_id)->where("sub_envp_id",$subplace_id)->orderBy('env_name', 'ASC')->get();
        $environment_name = DB::table("work_enviornment_preferences")->where("prefer_id",$subplace_id)->first();
        //print_r($data);die;
        $data['env_name'] = $environment_name->env_name;
        $data['prefer_id'] = $place_id;
        $data['subplace_id'] = $subplace_id;
        return json_encode($data);
    }

    public function updateBasicJobs(Request $request)
    {
        $user_id = $request->user_id;


        $job_id = $request->job_id;
        $sector_preferences = $request->sector_preferences;
        $job_title = $request->job_title;
        $position_open = $request->position_open;
        $type_of_nurse = $request->type_of_nurse;
        $subnursetype = $request->subnursetype;

        $subnursedata = DB::table("practitioner_type")->where("id",$subnursetype)->first();

        $sub_nurse_name = json_encode((array)$subnursedata->name);

        //$subnursetype = json_encode($request->subnursetype);
        $subwork = json_encode($request->input('subwork'));
        $subpwork = json_encode($request->input('subworkthlevel'));
        //print_r($subpwork);die;
        $main_speciality = $request->main_speciality;
        $subspeciality = $request->subspeciality['primary'];

        // start from first key
        $key = array_key_first($subspeciality);

        while (isset($subspeciality[$key])) {
            $next = $subspeciality[$key][0];

            // if next key does not exist, current key is the last key
            if (!isset($subspeciality[$next])) {
                $lastKeyArray = $subspeciality[$key];
                break;
            }

            $key = $next;
        }

        //print_r($lastKeyArray);

        //print_r($subspeciality['primary']);die;
        $speciality_experience = $request->speciality_experience;
        $willing_upskill = isset($request->willing_upskill)?1:0;
        $speciality = isset($request->subspeciality['secondary'])?json_encode($request->subspeciality['secondary']):'';

        //$job_id = Session::get('jobId');
        $job_post = JobsModel::find($job_id);

        $job_post->sector = $sector_preferences;

        //$job_post->nurse_type = $type_of_nurse;
        $job_post->nurse_type = $sub_nurse_name;
        $job_post->nurse_type_id = json_encode([$subnursetype]);
        $job_post->typeofspeciality = json_encode($lastKeyArray);
        //$job_post->sub_speciality = $subspeciality;
        $job_post->experience_level = $speciality_experience;
        $job_post->secondary_speciality = $speciality;
        $job_post->willing_to_upskill = $willing_upskill;
        $job_post->work_environment = $subpwork;
        $job_post->job_title = $job_title;
        $job_post->position_open = $position_open;
        $run = $job_post->save();



        if ($run) {
            $json['status'] = 1;


        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);
    }

    public function getEmpData(Request $request)
    {
        $sub_prefer_id = $request->sub_prefer_id;
        $employeement_type_name = DB::table("employeement_type_preferences")->where("emp_prefer_id",$sub_prefer_id)->first();


        $data['employeement_type_preferences'] = DB::table("employeement_type_preferences")->where("sub_prefer_id",$sub_prefer_id)->get();


        //print_r($employeement_type_preferences);die;
        $data['employeement_type_name'] = $employeement_type_name->emp_type;
        $data['employeement_type_id'] = $employeement_type_name->emp_prefer_id;
        return json_encode($data);
    }
    public function contract_pay()
    {
        if(isset($_GET['job_id'])){
            $job_id = $_GET['job_id'];
        }else{
            $job_id = Session::get('jobId');
        }
        $data['job_id'] = $job_id;
        $data['job_data'] = JobsModel::where("id",$job_id)->first();
        $data['employeement_type_preferences'] = DB::table("employeement_type_preferences")->where("sub_prefer_id","0")->get();
        return view('healthcare.contract-pay')->with($data);
    }

    public function updateContractPay(Request $request)
    {
        $emptype_preferences = $request->emptype_preferences;
        $emp_type = json_encode((array)$request->subemptype);
        //print_r($emp_type);

        //for permanent
        $per_hours_week = (!empty($request->per_hours_week))?$request->per_hours_week:'';
        $per_salary_format = (!empty($request->per_salary_format))?$request->per_salary_format:'';
        $per_salary_min = (!empty($request->per_salary_min))?$request->per_salary_min:'';
        $per_salary_max = (!empty($request->per_salary_max))?$request->per_salary_max:'';

        //for fixed-term
        $contract_length_value = (!empty($request->contract_length_value))?$request->contract_length_value:'';
        $contract_length_unit = (!empty($request->contract_length_unit))?$request->contract_length_unit:'';
        $fixed_term_hours_week = (!empty($request->fixed_term_hours_week))?$request->fixed_term_hours_week:'';
        $fixed_term_salary_format = (!empty($request->fixed_term_salary_format))?$request->fixed_term_salary_format:'';
        $fixed_term_salary_min = (!empty($request->fixed_term_salary_min))?$request->fixed_term_salary_min:'';
        $fixed_term_salary_max = (!empty($request->fixed_term_salary_max))?$request->fixed_term_salary_max:'';

        //for tmporary
        $temporary_hours_week = (!empty($request->temporary_hours_week))?$request->temporary_hours_week:'';
        $temporary_salary_format = (!empty($request->temporary_salary_format))?$request->temporary_salary_format:'';
        $temporary_salary_min = (!empty($request->temporary_salary_min))?$request->temporary_salary_min:'';
        $temporary_salary_max = (!empty($request->temporary_salary_min))?$request->temporary_salary_max:'';
        //echo Session::has('job_id');
        //$job_id = Session::get('jobId');
        $job_id = $request->job_id;

        $job_post = JobsModel::find($job_id);
        $job_post->main_emp_type = $emptype_preferences;
        $job_post->emplyeement_type = $emp_type;

        $job_post->hours_per_week_permanent = $per_hours_week;
        $job_post->salary_permanent = $per_salary_format;
        $job_post->per_salary_min = $per_salary_min;
        $job_post->per_salary_max = $per_salary_max;

        $job_post->contract_length_fixed_term = $contract_length_value;
        $job_post->contract_length_unit_fixed_term = $contract_length_unit;
        $job_post->hours_per_week_fixed_term = $fixed_term_hours_week;
        $job_post->salary_range_fix_term = $fixed_term_salary_format;
        $job_post->fixed_term_salary_min = $fixed_term_salary_min;
        $job_post->fixed_term_salary_max = $fixed_term_salary_max;

        $job_post->shift_date_time_temporary = $temporary_hours_week;
        $job_post->salary_range_temporary = $temporary_salary_format;
        $job_post->temporary_salary_min = $temporary_salary_min;
        $job_post->temporary_salary_max = $temporary_salary_max;

        $run = $job_post->save();

        if ($run) {
            $json['status'] = 1;


        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);
    }

    public function shift_scheduling()
    {
        $data['shift_types_data'] = DB::table("work_shift_preferences")->where("shift_id","1")->get();
        $data['shift_length_data'] = DB::table("work_shift_preferences")->where("shift_id","2")->get();
        $data['schedule_model_data'] = DB::table("work_shift_preferences")->where("shift_id","3")->get();
        $data['weekly_work_patters'] = DB::table("work_shift_preferences")->where("shift_id","4")->get();
        $data['shift_rotation_data'] = DB::table("work_shift_preferences")->where("shift_id","5")->get();
        $data['non_trad_shift'] = DB::table("work_shift_preferences")->where("shift_id","6")->get();
        $data['maternity_shift'] = DB::table("work_shift_preferences")->where("shift_id","7")->get();
        $data['days_off_data'] = DB::table("work_shift_preferences")->where("shift_id","8")->where("sub_shift_id",NULL)->get();
        $data['specific_days_off_data'] = DB::table("work_shift_preferences")->where("shift_id","9")->get();
        $data['specific_days_off_subdata'] = DB::table("work_shift_preferences")->where("shift_id","8")->where("sub_shift_id","61")->get();

        if(isset($_GET['job_id'])){
            $job_id = $_GET['job_id'];
        }else{
            $job_id = Session::get('jobId');
        }
        $data['job_data'] = DB::table("job_boxes")->where("id",$job_id)->first();
        $data['job_id'] = $job_id;
        //print_r($data['job_data']);die;

        return view('healthcare.shift_scheduling')->with($data);
    }

    public function updateShiftScheduling(Request $request)
    {
        $shift_types_data = $request->shift_types_data;
        $shift_length_data = json_encode($request->shift_length_data);
        $schedule_model_data = json_encode($request->schedule_model_data);
        $weekly_work_patters = json_encode($request->weekly_work_patters);
        $shift_rotation_data = json_encode($request->shift_rotation_data);
        $non_trad_shift = json_encode($request->non_trad_shift);
        $maternity_shift = json_encode($request->maternity_shift);
        $days_off_data = json_encode($request->days_off_data);
        $specific_days_off_subdata = json_encode($request->specific_days_off_subdata);
        $specific_days_off_data = json_encode($request->specific_days_off_data);

        $shift_mode = $request->shift_mode;

        if($shift_mode == 'single'){
            $temporarysingle_start_date = $request->temporarysingle_start_date;
            $temporarysingle_end_date = $request->temporarysingle_end_date;
        }

        if($shift_mode == 'range'){
            $temporaryrangestart_date = $request->temporaryrangestart_date;
            $temporaryrangeend_date = $request->temporaryrangeend_date;
            $temporaryrangenoshifts = $request->temporaryrangenoshifts;
            $temporaryrangenotes = $request->temporaryrangenotes;
        }

        $start_date_urgency = $request->start_date_urgency;

        if($start_date_urgency == "immediate"){
            $start_date_urgency1 =  $start_date_urgency;
        }

        if($start_date_urgency == "within_weeks"){
            $start_date_urgency1 =  $request->within_weeks_radio;
        }

        if($start_date_urgency == "scheduled_date"){
            $start_date_urgency1 =  $request->scheduled_date;
        }

        $contract_length_value =  $request->contract_length_value;
        $contract_length_unit =  $request->contract_length_unit;



        //print_r($schedule_model_data);die;
        $job_id = $request->job_id;
        //$job_id = Session::get('jobId');
        $job_post = JobsModel::find($job_id);

        $job_post->shift_type = $shift_types_data;
        $job_post->shift_length = $shift_length_data;
        $job_post->schedule_model = $schedule_model_data;
        $job_post->weekly_work_patterns = $weekly_work_patters;
        $job_post->shift_rotation = $shift_rotation_data;
        $job_post->non_trad_shift = $non_trad_shift;
        $job_post->maternity_shift = $maternity_shift;
        $job_post->days_off = $days_off_data;
        $job_post->perticular_days_off = $specific_days_off_subdata;
        $job_post->specific_days_off = $specific_days_off_data;

        if($job_post->main_emp_type == "3"){
            if($shift_mode == 'single'){
                $job_post->single_shift_start_datetime = $temporarysingle_start_date;
                $job_post->single_shift_end_datetime = $temporarysingle_end_date;
                $job_post->daterange_start_date = '';
                $job_post->daterange_end_date = '';
                $job_post->no_of_shifts = '';
                $job_post->notes = '';
            }

            if($shift_mode == 'range'){
                $job_post->single_shift_start_datetime = '';
                $job_post->single_shift_end_datetime = '';
                $job_post->daterange_start_date = $temporaryrangestart_date;
                $job_post->daterange_end_date = $temporaryrangeend_date;
                $job_post->no_of_shifts = $temporaryrangenoshifts;
                $job_post->notes = $temporaryrangenotes;
            }
        }

        if($job_post->main_emp_type == "1"){
            $job_post->start_date_urgency_permanent = $start_date_urgency1;

        }

        if($job_post->main_emp_type == "2"){
            $job_post->start_date_urgency_fixedterm = $start_date_urgency1;
            $job_post->fixed_term_contract_length = $contract_length_value." ".$contract_length_unit;
        }


        $run = $job_post->save();

        if ($run) {
            $json['status'] = 1;


        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);

    }

    public function job_benefits()
    {

        $data['benefits_preferences_data'] = DB::table("benefits_preferences")->where("subbenefit_id","0")->get();
        //print_r($data['benefits_preferences_data']);die;
        if(isset($_GET['job_id'])){
            $job_id = $_GET['job_id'];
        }else{
            $job_id = Session::get('jobId');
        }
        $data['job_data'] = DB::table("job_boxes")->where("id",$job_id)->first();
        //print_r($data['job_data']);die;
        $data['job_id'] = $job_id;
        return view('healthcare.job_benefits')->with($data);
    }

    public function updateBenefitsPreferences(Request $request)
    {
        $user_id = $request->user_id;
        $benefits_preferences = json_encode($request->benefits_preferences);

        //$job_id = Session::get('jobId');
        $job_id = $request->job_id;
        $work_preferences_data = JobsModel::where("id",$job_id)->first();

        //print_r($work_preferences_data);



        $run = JobsModel::where('id',$job_id)->update(['benefits'=>$benefits_preferences]);


        if ($run) {
            $json['status'] = 1;

        } else {
            $json['status'] = 0;

        }

        echo json_encode($json);
    }

    public function location_work_modal()
    {
        if(isset($_GET['job_id'])){
            $job_id = $_GET['job_id'];
        }else{
            $job_id = Session::get('jobId');
        }

        $data['job_data'] = DB::table("job_boxes")->where("id",$job_id)->first();
        $data['job_id'] = $job_id;
        return view('healthcare.location_work_modal')->with($data);
    }

    public function getStates(Request $request)
    {


        $states_data = DB::table("states")->where("country_code",$request->country_code_value)->get();
        //print_r($states_data);
        return json_encode($states_data);
    }

    public function getCities(Request $request){
        $cities_data = DB::table("master_city")->where("city_state_id",$request->state_code_value)->get();
        //print_r($states_data);
        return json_encode($cities_data);
    }

    public function getCitiesLat(Request $request){
        $cities_data = DB::table("master_city")->where("city_id",$request->city_code_value)->first();
        //print_r($states_data);
        return json_encode($cities_data);
    }

    public function updateLocationModel(Request $request)
    {
        $user_id = $request->user_id;
        $country_code = $request->country_code;
        $job_state = $request->job_state;
        $city_suburb = $request->city_suburb;
        $primary_hiring_site = $request->primary_hiring_site;
        $site_rotation = $request->has('site_rotation')?1:0;
        $additional_sites = $request->additional_sites;
        $work_modal = $request->work_modal;
        $remote_teleneath_component = $request->has('remote_teleneath_component')?1:0;
        $remote_teleneath_modal = $request->remote_teleneath_modal;
        $remote_percent = $request->remote_percent;
        $city_lat = $request->city_lat;
        $city_long = $request->city_long;

        $user_data = User::where("id",$user_id)->first();


        $year = Carbon::now()->year;

        $number = random_int(10000, 99999);

        do {
        // Generate a random 5-digit number (10000 to 99999)
            $code = random_int(10000, 99999);

            // Check if the code already exists in your database table
            $codeExists = JobsModel::where('job_box_id', $code)->exists(); // Replace 'product_code' with your column name

        } while ($codeExists); // Loop if it exists


        $jobId = "MQ-".$user_data->country_code."-".$year."-".$code;

        //echo Session::has('job_id');
        //$job_data_id = Session::get('jobId');
        $job_data_id = $request->job_id;

        if($job_data_id){
            //echo $job_state;die;
            $job_post = JobsModel::find($job_data_id);
            $job_post->healthcare_id = $user_id;

            $job_post->location_country = $country_code;
            $job_post->location_state = $job_state;
            $job_post->location_city = $city_suburb;
            $job_post->city_lat = $city_lat;
            $job_post->city_long = $city_long;
            $job_post->location_primary_hiring_site = $primary_hiring_site;
            $job_post->multi_site_rotation = $site_rotation;
            $job_post->additional_sites = $additional_sites;
            $job_post->work_model = $work_modal;
            $job_post->remote_teleneath_work = $remote_teleneath_component;
            $job_post->remote_work_type = $remote_teleneath_modal;
            $job_post->percent_remote = $remote_percent;

            $run = $job_post->save();
        }else{
            $job_post = new JobsModel;
            $job_post->healthcare_id = $user_id;
            $job_post->job_box_id = $jobId;
            $job_post->location_country = $country_code;
            $job_post->location_state = $job_state;
            $job_post->location_city = $city_suburb;
            $job_post->city_lat = $city_lat;
            $job_post->city_long = $city_long;
            $job_post->location_primary_hiring_site = $primary_hiring_site;
            $job_post->multi_site_rotation = $site_rotation;
            $job_post->additional_sites = $additional_sites;
            $job_post->work_model = $work_modal;
            $job_post->remote_teleneath_work = $remote_teleneath_component;
            $job_post->remote_work_type = $remote_teleneath_modal;
            $job_post->percent_remote = $remote_percent;

            $run = $job_post->save();

            $job_id = $job_post->id;
            Session::put('jobId', $job_id);
        }




        if ($run) {
            $json['status'] = 1;


        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);
    }

    public function requirements()
    {
        if(isset($_GET['job_id'])){
            $job_id = $_GET['job_id'];
        }else{
            $job_id = Session::get('jobId');
        }
        $data['language_data'] = DB::table("languages")->where("sub_language_id",NULL)->where("test_id",NULL)->orderBy("language_name","ASC")->get();

        $job_data = JobsModel::where("id",$job_id)->first();

        $state_data = DB::table("states")->where("id",$job_data->location_state)->first();
        $data['state_name'] = $state_data->name;
        $data['job_id'] = $job_id;
        $data['vaccine_data'] = DB::table("vcc_state_required")->where("state_id",$job_data->location_state)->get();

        return view('healthcare.requirements')->with($data);
    }

    public function getMandatoryCourses(Request $request){
        $courses_id = $request->courses_id;

        $data['getCourses'] = DB::table("man_training_category")->where("parent",$courses_id)->orderBy('name', 'ASC')->get();
        $courses_name = DB::table("man_training_category")->where("id",$courses_id)->first();
        $data['courses_id'] = $courses_id;
        $data['courses_name'] = $courses_name->name;
        //print_r($getCourses);
        return json_encode($data);
    }

    public function getLanguagesData(Request $request)
    {
        $language_id = $request->language_id;
        $data['main_language_data'] = LanguageModel::where("language_id",$language_id)->first();

        $data['language_data'] = LanguageModel::where("sub_language_id",$language_id)->orderBy("language_name","ASC")->get();
        //print_r(json_encode($data['language_data']));
        return json_encode($data);
    }

    public function updateJobRequirements(Request $request)
    {
        $mandatory_training = json_encode($request->mandatory_training);
        $education_req = json_encode($request->education_req);
        $reg_licenses_req = json_encode($request->reg_licenses_req);
        $sub_languages_req = json_encode($request->sub_languages);
        $special_lang_req = json_encode($request->special_lang_req);
        $vaccination_required = json_encode($request->vaccination_required);
        $residency = json_encode($request->residency);
        $other_evidence = json_encode($request->other_evidence);
        $documents_req = json_encode($request->documents_req);

        //$job_id = Session::get('jobId');
        $job_id = $request->job_id;
        $job_post = JobsModel::find($job_id);
        //print_r($job_post);die;
        $job_post->mandatory_training_req = $mandatory_training;
        $job_post->degree_req = $education_req;
        $job_post->reg_licenses_req = $reg_licenses_req;
        $job_post->sub_languages_req = $sub_languages_req;
        $job_post->specailized_language_req = $special_lang_req;
        $job_post->vaccination_req = $vaccination_required;
        $job_post->checks_clearance_req = $residency;
        $job_post->other_evidence = $other_evidence;
        $job_post->documents_required = $documents_req;

        $run = $job_post->save();

        if ($run) {
            $json['status'] = 1;


        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);

    }

    public function job_description()
    {
        if(isset($_GET['job_id'])){
            $job_id = $_GET['job_id'];
        }else{
            $job_id = Session::get('jobId');
        }

        $data['job_data'] = JobsModel::where("id",$job_id)->first();
        $data['job_id'] = $job_id;
        return view('healthcare.job_description')->with($data);
    }

    public function uploadJobImgs(Request $request)
    {
        $files = $request->file('job_attachments');
        $job_id = $request->job_id;

        $jobdata = DB::table("job_boxes")->where("id", $job_id)->first();

        if($jobdata->attachments != NULL){
            $job_imgs = Helpers::multipleFileUpload($files, json_decode($jobdata->attachments));
        }else{
            $job_imgs = Helpers::multipleFileUpload($files, '');
        }

        //print_r($job_imgs);
        return $job_imgs;
    }

    public function updateJobDescription(Request $request)
    {
        $about_role = $request->about_role;
        $key_responsiblities = $request->key_responsiblities;
        $role_specific = $request->role_specific;
        $contact_person = $request->contact_person;
        $job_attachments_file = $request->job_attachments_file;


        //echo Session::has('job_id');
        $job_id = $request->job_id;

        $job_post = JobsModel::find($job_id);
        $job_post->about_role = $about_role;
        $job_post->key_responsiblities = $key_responsiblities;
        $job_post->role_specific_work_environments = $role_specific;
        $job_post->contact_person_role = $contact_person;
         $job_post->attachments = $job_attachments_file;


        $run = $job_post->save();

        if ($run) {
            $json['status'] = 1;


        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);
    }

    public function visiblity_settings()
    {
        if(isset($_GET['job_id'])){
            $job_id = $_GET['job_id'];
        }else{
            $job_id = Session::get('jobId');
        }

        $data['job_data'] = DB::table("job_boxes")->where("id",$job_id)->first();
        $data['job_id'] = $job_id;
        return view('healthcare.visiblity_settings')->with($data);
    }

    public function updateVisiblitySettings(Request $request)
    {
        $visiblity_mode = $request->visiblity_mode;
        $application_deadline = $request->application_deadline;
        $listing_expiry = $request->listing_expiry;
        $custom_date = $request->custom_date;
        $priority_tags = isset($request->priority_tags)?1:0;
        $job_id = $request->job_id;

        $job_data = DB::table("job_boxes")->where("id",$job_id)->first();

        $date_only = date('Y-m-d', strtotime($job_data->updated_at));

        //$today_date = date('Y-m-d');

        if($listing_expiry == 1){
            $custom_date1 = date('Y-m-d', strtotime($date_only . ' +7 days'));
        }

        if($listing_expiry == 2){
            $custom_date1 = date('Y-m-d', strtotime($date_only . ' +14 days'));
        }

        if($listing_expiry == 3){
            $custom_date1 = date('Y-m-d', strtotime($date_only . ' +30 days'));
        }

        if($listing_expiry == 4){
            $custom_date1 = date('Y-m-d', strtotime($date_only . ' +60 days'));
        }

        if($listing_expiry == 5){
            $custom_date1 = $custom_date;
        }

        //echo $custom_date1;die;

        //$job_id = Session::get('jobId');

        $job_post = JobsModel::find($job_id);
        $job_post->visiblity = $visiblity_mode;
        $job_post->application_deadline = $application_deadline;
        $job_post->expiry_date = $listing_expiry;
        $job_post->custom_expiry_date = $custom_date1;
        $job_post->urgent_hire = $priority_tags;


        $run = $job_post->save();

        if ($run) {
            $json['status'] = 1;


        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);

    }

    public function reviewPublish()
    {
        if(isset($_GET['job_id'])){
            $job_id = $_GET['job_id'];
        }else{
            $job_id = Session::get('jobId');
        }

        $data['job_post'] = JobsModel::where("id",$job_id)->first();
        $data['job_id'] = $job_id;
        return view('healthcare.review_publish')->with($data);
    }

    public function saveDraft(Request $request)
    {
        $job_id = $request->job_id;
        $job_post = JobsModel::find($job_id);

        if(!$job_post){
            return response()->json(['status'=>0,'message'=>'Job not found']);
        }

        // already same state
        if($job_post->save_draft == $request->save){
            return response()->json(['status'=>2]);
        }
        $today_date = date('Y-m-d H:i:s');
        // update state
        $job_post->save_draft = $request->save;
        $job_post->updated_at = $today_date;
        $job_post->save();

        // return based on action
        if($request->save == 1){
            session()->forget('jobId');
            return response()->json(['status'=>1]); // draft saved
        }

        if($request->save == 2){
            session()->forget('jobId');
            sendJobAlertEmails();
            // Send database notifications to all nurses with app notifications enabled
            $nurses = User::whereHasAppNotifications()->get();
            foreach ($nurses as $nurse) {
                $nurse->notify(new JobPublishedNotification($job_post));
            }

            // Also dispatch real-time broadcast event
            JobPublished::dispatch($job_post);

            return response()->json(['status'=>3]); // published
        }

        return response()->json(['status'=>0]);
    }

    public function active_jobs()
    {
        $user_id = Auth::guard('healthcare_facilities')->user()->id;
        //$data['job_post_data'] = JobsModel::where("healthcare_id",$user_id)->where("save_draft","2")->orderBy('created_at','desc')->get();
        $user_data = DB::table("users")->where("id",$user_id)->first();
        $healthcare_id = $user_data->healthcare_id;
        $data['job_post_data'] = JobsModel::where(function ($query) use ($user_id, $healthcare_id) {

        $query->where('healthcare_id', $user_id)
              ->orWhere('healthcare_id', $healthcare_id);

    })
    ->where('save_draft', 2)
    ->orderBy('created_at','desc')
    ->get();
        // echo "<pre>";
        // print_r($data['job_post_data']);die;
        return view('healthcare.active_jobs')->with($data);

    }

    public function draft_jobs()
    {
        $user_id = Auth::guard('healthcare_facilities')->user()->id;
        // $data['job_post_data'] = JobsModel::where("healthcare_id", $user_id)
        //                         ->where(function($query){
        //                             $query->where("save_draft", "0")
        //                                   ->orWhere("save_draft", "1");
        //                         })
        //                         ->orderBy('created_at','desc')
        //                         ->get();

        $user_data = DB::table("users")->where("id",$user_id)->first();
        $healthcare_id = $user_data->healthcare_id;
        $data['job_post_data'] = JobsModel::where(function ($query) use ($user_id, $healthcare_id) {

        $query->where('healthcare_id', $user_id)
              ->orWhere('healthcare_id', $healthcare_id);

    })
    ->whereIn('save_draft', [0,1])
    ->orderBy('created_at','desc')
    ->get();

        return view('healthcare.draft_jobs')->with($data);

    }

    public function close_expire_jobs(Request $request)
    {
        $job_id = $request->job_id;

        $job_post = JobsModel::find($job_id);

        $job_post->save_draft = 3;
        $run = $job_post->save();
        if ($run) {
            $json['status'] = 1;


        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);

    }

    public function expired_jobs()
    {
        $user_id = Auth::guard('healthcare_facilities')->user()->id;
        $data['job_post_data'] = JobsModel::where("healthcare_id",$user_id)->where("save_draft","3")->orderBy('created_at','desc')->get();

        return view('healthcare.expired_jobs')->with($data);

    }

    public function delete_jobs(Request $request)
    {
        $job_id = $request->job_id;
        $run = JobsModel::where("id",$job_id)->delete();

        if ($run) {
            $json['status'] = 1;


        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);
    }

    public function publish_jobs(Request $request)
    {
        $job_id = $request->job_id;
        $job_post = JobsModel::find($job_id);

        // update state
        $job_post->save_draft = 2;
        $job_post->updated_at = now();
        $run = $job_post->save();

        if ($run) {
            $json['status'] = 1;


        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);
    }

    public function duplicateJobs(Request $request)
    {
        $job_id = $request->job_id;
        $job_post = JobsModel::find($job_id);
        $newJob = $job_post->replicate(); // clone all columns except id + timestamps
        $run = $newJob->save();

        if ($run) {
            $json['status'] = 1;


        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);


    }

    public function job_details(Request $request){
        $job_id = $request->job_id;
        $data['jobs'] = DB::table("job_boxes")->where("id", $job_id)->first();
        $data['healthcare_data'] = User::where("id",$data['jobs']->healthcare_id)->first();
        $data['state_data'] = DB::table("states")->where("id",$data['jobs']->location_state)->first();
        return view('healthcare.job_detail')->with($data);
    }

    public function nurse_applicants(){
        $nurse_application = NurseApplication::with('health_care')->orderBy("id","desc")->get();
        return view('healthcare.nurse_appliction_list', compact('nurse_application'));
    }

    public function change_application_status(Request $request){
        $application_id = $request->application_id;
        $status = $request->value;

        $job_post = NurseApplication::find($application_id);
        $job_post->status = $status;
        $run = $job_post->save();

        if ($run) {
            $json['status'] = 1;


        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);

    }


}