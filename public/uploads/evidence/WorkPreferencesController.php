<?php

namespace App\Http\Controllers\nurse;
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
use App\Models\WorkPreferencesModel;
use App\Models\SalaryExpectation;

class WorkPreferencesController extends Controller{

    public function index()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['work_preferences_data'] = WorkPreferencesModel::where("user_id",$user_id)->first();

        return view('nurse.sector_preferences')->with($data);
    }

    public function updateSectorPreferences(Request $request)
    {
        $user_id = $request->user_id;
        $sector_preferences = $request->sector_preferences;

        $work_preferences_data = WorkPreferencesModel::where("user_id",$user_id)->first();

        //print_r($work_preferences_data);

        if(!empty($work_preferences_data)){
            
            $run = WorkPreferencesModel::where('user_id',$user_id)->update(['sector_preferences'=>$sector_preferences]);
        }else{
            
            $work_preferences = new WorkPreferencesModel();
            $work_preferences->user_id = $user_id;
            $work_preferences->sector_preferences = $sector_preferences;
            $run = $work_preferences->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
    }

    public function work_environment_preferences()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['work_preferences_data'] = WorkPreferencesModel::where("user_id",$user_id)->first();

        return view('nurse.work_environment_preferences')->with($data);
    }

    public function updateWorkPreferences(Request $request)
    {
        $user_id = $request->user_id;
        $subworkthlevel = json_encode($request->subworkthlevel);

        $work_preferences_data = WorkPreferencesModel::where("user_id",$user_id)->first();

        //print_r($work_preferences_data);

        if(!empty($work_preferences_data)){
            
            $run = WorkPreferencesModel::where('user_id',$user_id)->update(['work_environment_preferences'=>$subworkthlevel]);
        }else{
            
            $work_preferences = new WorkPreferencesModel();
            $work_preferences->user_id = $user_id;
            $work_preferences->work_environment_preferences = $subworkthlevel;
            $run = $work_preferences->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
    }

    public function employeement_type_preferences()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['employeement_type_preferences'] = DB::table("employeement_type_preferences")->where("sub_prefer_id","0")->get();
        
        //print_r($data['employeement_type_preferences']);die;
        $data['work_preferences_data'] = WorkPreferencesModel::where("user_id",$user_id)->first();

        if(!empty($data['work_preferences_data'] && $data['work_preferences_data']->emptype_preferences != NULL)){
            $emptype_data = (array)json_decode($data['work_preferences_data']->emptype_preferences);
            //print_r($emptype_data);
            $emptypeid = '';
            foreach($emptype_data as $index=>$empdata){
                $data['emptypeid'] = $index;
                $data['emptypearr'] = json_encode($empdata);
                $data['subemployeement_type_preferences'] = DB::table("employeement_type_preferences")->where("sub_prefer_id",$index)->get();
                $subemployeement_name = DB::table("employeement_type_preferences")->where("emp_prefer_id",$index)->first();
                $data['subemployeement_name'] = $subemployeement_name->emp_type;
            }   
        }else{
            $data['emptypeid'] = '';
        }
        
        

        return view('nurse.employeement_type_preferences')->with($data);
    }

    public function getEmpData(Request $request)
    {
        $sub_prefer_id = $request->sub_prefer_id;
        $employeement_type_name = DB::table("employeement_type_preferences")->where("emp_prefer_id",$sub_prefer_id)->first();
        
        
        $data['employeement_type_preferences'] = DB::table("employeement_type_preferences")->where("sub_prefer_id",$sub_prefer_id)->get();
        
        
        //print_r($employeement_type_preferences);die;
        $data['employeement_type_name'] = $employeement_type_name->emp_type;
        return json_encode($data);
    }

    public function updateEmpTypePreferences(Request $request)
    {
        $user_id = $request->user_id;
        $emptype_preferences = $request->emptype_preferences;
        $emptypelevel = json_encode($request->emptypelevel);

        $work_preferences_data = WorkPreferencesModel::where("user_id",$user_id)->first();

        //print_r($work_preferences_data);

        if(!empty($work_preferences_data)){
            
            $run = WorkPreferencesModel::where('user_id',$user_id)->update(['emptype_preferences'=>$emptypelevel]);
        }else{
            
            $work_preferences = new WorkPreferencesModel();
            $work_preferences->user_id = $user_id;
            $work_preferences->emptype_preferences = $emptypelevel;
            $run = $work_preferences->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
    }

    public function WorkShiftPreferences()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['shift_preferences_data'] = DB::table("work_shift_preferences")->where("shift_id","0")->get();
        $data['work_preferences_data'] = WorkPreferencesModel::where("user_id",$user_id)->first();
        
        return view('nurse.work_shift_preferences')->with($data);
    }

    public function getSubWorkData(Request $request)
    {
        $shift_id = $request->shift_id;
        $sub_shift_id = $request->sub_shift_id;

        $data['shift_preferences_data'] = DB::table("work_shift_preferences")->where("shift_id",$shift_id)->where("sub_shift_id",$sub_shift_id)->get();
        //print_r($data['shift_preferences_data']);die;
        
        if(!empty($data['shift_preferences_data'])){
            $shift_preferences_name = DB::table("work_shift_preferences")->where("shift_id",$shift_id)->where("work_shift_id",$sub_shift_id)->first();
            $data['shift_preferences_name'] = $shift_preferences_name->shift_name;
            $data['sub_shift_id'] = $sub_shift_id;
            return json_encode($data);
        }
        
    }

    public function updateShiftPreferences(Request $request)
    {
        $user_id = $request->user_id;
        $workshift_preferences = json_encode($request->shift_preferences);

        if(isset($request->shift_preferences1)){
            $subworkshift_preferences = json_encode($request->shift_preferences1);
        }else{
            $subworkshift_preferences = '';
        }

        $work_preferences_data = WorkPreferencesModel::where("user_id",$user_id)->first();

        //print_r($work_preferences_data);

        if(!empty($work_preferences_data)){
            
            $run = WorkPreferencesModel::where('user_id',$user_id)->update(['work_shift_preferences'=>$workshift_preferences,'subwork_shift_preferences'=>$subworkshift_preferences]);
        }else{
            
            $work_preferences = new WorkPreferencesModel();
            $work_preferences->user_id = $user_id;
            $work_preferences->work_shift_preferences = $workshift_preferences;
            $work_preferences->subwork_shift_preferences = $subworkshift_preferences;
            $run = $work_preferences->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
    }

    public function position_preferences()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['shift_preferences_data'] = DB::table("work_shift_preferences")->where("shift_id","0")->get();
        $data['work_preferences_data'] = WorkPreferencesModel::where("user_id",$user_id)->first();
        
        return view('nurse.position_preferences')->with($data);
    }

    public function updatePositionPreferences(Request $request)
    {
        $user_id = $request->user_id;
        $subpositions_held = json_encode($request->subpositions_held);
        

        

        $work_preferences_data = WorkPreferencesModel::where("user_id",$user_id)->first();

        //print_r($work_preferences_data);

        if(!empty($work_preferences_data)){
            
            $run = WorkPreferencesModel::where('user_id',$user_id)->update(['position_preferences'=>$subpositions_held]);
        }else{
            
            $work_preferences = new WorkPreferencesModel();
            $work_preferences->user_id = $user_id;
            $work_preferences->position_preferences = $subpositions_held;
            
            $run = $work_preferences->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
    }

    public function benefitsPreferences()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['benefits_preferences_data'] = DB::table("benefits_preferences")->where("subbenefit_id","0")->get();
        $data['work_preferences_data'] = WorkPreferencesModel::where("user_id",$user_id)->first();
        
        return view('nurse.benefits_preferences')->with($data);
    }

    public function updateBenefitsPreferences(Request $request)
    {
        $user_id = $request->user_id;
        $benefits_preferences = json_encode($request->benefits_preferences);
        

        $work_preferences_data = WorkPreferencesModel::where("user_id",$user_id)->first();

        //print_r($work_preferences_data);

        if(!empty($work_preferences_data)){
            
            $run = WorkPreferencesModel::where('user_id',$user_id)->update(['benefits_preferences'=>$benefits_preferences]);
        }else{
            
            $work_preferences = new WorkPreferencesModel();
            $work_preferences->user_id = $user_id;
            $work_preferences->benefits_preferences = $benefits_preferences;
            
            $run = $work_preferences->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
    }

    public function locationPreferences()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['countries_data'] = DB::table("countries")->where("other","1")->get();
        $data['countries_data_other'] = DB::table("countries")->where("other","!=","1")->get();
        $data['work_preferences_data'] = WorkPreferencesModel::where("user_id",$user_id)->first();
        
        return view('nurse.location_preferences')->with($data);
    }

    public function updateLocationPreferences(Request $request)
    {
        $user_id = $request->user_id;
        $location_status = $request->location_status;
        $prefered_location = $request->prefered_location;
        $singleDistance = $request->singleDistance;
        $autodetect_location = isset($request->autodetect_location)?1:0;
        $countries = json_encode($request->countries);
        $multiLocationInput = $request->multiLocationInput;
        $multiDistance = $request->multiDistance;

        $i = 0;
        $multiLocationArr = array();
        if(!empty($multiLocationInput)){
            foreach($multiLocationInput as $multiLocation){
                $multiLocationArr[] = array("location"=>$multiLocation,"distance"=>$multiDistance[$i]);
                $i++;
            }
        }


        //print_r($multiLocationArr);die;
        
        
        //print_r($request->other_countries);die;
        if($request->other_countries != NULL){
            $other_countries1 = json_encode($request->other_countries);
        }else{
            $other_countries1 = '';
        }

        $work_preferences_data = WorkPreferencesModel::where("user_id",$user_id)->first();

        //print_r($work_preferences_data);

        if(!empty($work_preferences_data)){
            if($location_status == "Current Location area (not willing to relocate)"){
                $run = WorkPreferencesModel::where('user_id',$user_id)->update(['location_status'=>$location_status,'prefered_location_current'=>$prefered_location,'prefered_location'=>'','prefered_distance'=>$singleDistance,'auto_detect_location'=>$autodetect_location,'countries'=>'','other_countries'=>'']);
            }
            if($location_status == "Multiple locations area (relocation within your country)"){
                
                $run = WorkPreferencesModel::where('user_id',$user_id)->update(['location_status'=>$location_status,'prefered_location_current'=>'','prefered_location'=>json_encode($multiLocationArr),'prefered_distance'=>'','auto_detect_location'=>'0','countries'=>'','other_countries'=>'']);
            }
            if($location_status == "International relocation"){
                $multiple_location = array();
                $run = WorkPreferencesModel::where('user_id',$user_id)->update(['location_status'=>$location_status,'prefered_location_current'=>'','prefered_location'=>'','prefered_distance'=>'','auto_detect_location'=>'0','countries'=>$countries,'other_countries'=>$other_countries1]);
            }
            
        }else{
            
            $work_preferences = new WorkPreferencesModel();
            $work_preferences->user_id = $user_id;
            if($location_status == "Current Location area (not willing to relocate)"){
                $work_preferences->location_status = $location_status;
                $work_preferences->prefered_location_current = $prefered_location;
                $work_preferences->prefered_distance = $singleDistance;
                $work_preferences->auto_detect_location = $autodetect_location;
                $work_preferences->countries = '';
                $work_preferences->other_countries = '';
            }
            if($location_status == "Multiple locations area (relocation within your country)"){
                $work_preferences->location_status = $location_status;
                $work_preferences->prefered_location = json_encode($multiLocationArr);
                $work_preferences->prefered_distance = '';
                $work_preferences->auto_detect_location = '0';
                $work_preferences->countries = '';
                $work_preferences->other_countries = '';
            }
            if($location_status == "International relocation"){
                $work_preferences->location_status = $location_status;
                $work_preferences->prefered_location = '';
                $work_preferences->prefered_distance = '';
                $work_preferences->auto_detect_location = '0';
                $work_preferences->countries = $countries;
                $work_preferences->other_countries = $other_countries1;
            }
            
            $run = $work_preferences->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
    }

    public function salaryExpectations()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['salary_expectation_data'] = SalaryExpectation::where("user_id",$user_id)->first();

        if(!empty($data['salary_expectation_data'])){
            $salary_range = $data['salary_expectation_data']->salary_range;
            if($salary_range != NULL){
                $sal_range_data = explode(" - ",$salary_range);
                $data['salary_min'] = $sal_range_data[0];
                $data['salary_max'] = $sal_range_data[1];
                $data['salary_range'] = json_encode(array($sal_range_data[0],$sal_range_data[1]));
                $data['payment_frequency'] = $data['salary_expectation_data']->payment_frequency;
            }else{
                $data['salary_min'] = "20";
                $data['salary_max'] = "150";
                $data['salary_range'] = json_encode(array(20,150));
                $data['payment_frequency'] = '';
            }
        }else{
            $data['salary_min'] = "20";
            $data['salary_max'] = "150";
            $data['salary_range'] = json_encode(array(20,150));
            $data['payment_frequency'] = '';
        }
        //print_r($data['salary_expectation_data']);die;
        return view('nurse.salary_expectations')->with($data);
    }

    public function updatesalaryExpectations(Request $request)
    {
        $user_id = $request->user_id;
        $payment_frequency = $request->payment_frequency;
        $salary_range = $request->salary_range;
        $fixed_salary_amount = $request->fixed_salary_amount;
        $negotiable_salary = isset($request->negotiable_salary)?1:0;
        $hourly_salary_amount = $request->hourly_salary_amount;
        $weekly_salary_amount = $request->weekly_salary_amount;
        $monthly_salary_amount = $request->monthly_salary_amount;
        $annual_salary_amount = $request->annual_salary_amount;

        $salary_expectation_data = SalaryExpectation::where("user_id",$user_id)->first();


        if(!empty($salary_expectation_data)){
            
            $run = SalaryExpectation::where('user_id',$user_id)->update(['payment_frequency'=>$payment_frequency,'salary_range'=>$salary_range,'fixed_salary'=>$fixed_salary_amount,'negotiable_salary'=>$negotiable_salary,'hourly_salary'=>$hourly_salary_amount,'weekly_salary'=>$weekly_salary_amount,'monthly_salary'=>$monthly_salary_amount,'annual_salary'=>$annual_salary_amount]);
        }else{
            
            $salary_expectation = new SalaryExpectation();
            $salary_expectation->user_id = $user_id;
            $salary_expectation->payment_frequency = $payment_frequency;
            $salary_expectation->salary_range = $salary_range;
            $salary_expectation->fixed_salary = $fixed_salary_amount;
            $salary_expectation->negotiable_salary = $negotiable_salary;
            $salary_expectation->hourly_salary = $hourly_salary_amount;
            $salary_expectation->weekly_salary = $weekly_salary_amount;
            $salary_expectation->monthly_salary = $monthly_salary_amount;
            $salary_expectation->annual_salary = $annual_salary_amount;
            $run = $salary_expectation->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
        
    }

    public function match_percentage()
    {
        $user_id = Auth::guard("nurse_middle")->user()->id;
        $nurse_profile_category_one = DB::table("users")->where("id",$user_id)->first();
        $nurseTypeData = json_decode($nurse_profile_category_one->nurseType);
        $entry_level_nursing = json_decode($nurse_profile_category_one->entry_level_nursing);
        $registered_nurses = json_decode($nurse_profile_category_one->registered_nurses);
        $advanced_practioner = json_decode($nurse_profile_category_one->advanced_practioner);

        if($nurse_profile_category_one->entry_level_nursing !="null"){
            $entry_arr = array();
            foreach($entry_level_nursing as $entry_level){
                $entry_data = DB::table("practitioner_type")->where("id",$entry_level)->first();
                $entry_arr[] = $entry_data->name;
            }
        }
        
        if($nurse_profile_category_one->registered_nurses !="null"){
            $register_arr = array();
            foreach($registered_nurses as $reg_level){
                $reg_data = DB::table("practitioner_type")->where("id",$reg_level)->first();
                $register_arr[] = $reg_data->name;
            }
        }

        if($nurse_profile_category_one->advanced_practioner !="null"){
            $advanced_arr = array();
            foreach($advanced_practioner as $advanced_level){
                $advanced_data = DB::table("practitioner_type")->where("id",$advanced_level)->first();
                $advanced_arr[] = $advanced_data->name;
            }
        }

        $nurse_cat_arr = array();
        foreach($nurseTypeData as $ntype){
            $nurse_data = DB::table("practitioner_type")->where("id",$ntype)->first();
            
            
            if($nurse_data->name == "Entry level nursing"){
                $nurse_cat_arr[] = array('category'=>$nurse_data->name,'special_role'=>$entry_arr);
            }

            if($nurse_data->name == "Registered Nurses (RNs)"){
                $nurse_cat_arr[] = array('category'=>$nurse_data->name,'special_role'=>$register_arr);
            }    

            if($nurse_data->name == "Advanced Practice Registered Nurses (APRNs)"){
                $nurse_cat_arr[] = array('category'=>$nurse_data->name,'special_role'=>$advanced_arr);
            }    

            
        }

        $job = [
            [
                'category' => 'Registered Nurses (RNs)',
                'special_role' => 'Academic Nurse Writer',
            ],
            [
                'category' => 'Entry level nursing',
                'special_role' => 'Certified Nursing Assistant (CNAs)',
            ]
        ];

        

        $user_data = DB::table("users")->where("id",$user_id)->first();
        $total_experience = $user_data->assistent_level;

        $user_experience_data = DB::table("user_experience")->where("user_id",$user_id)->get();

        $specialty_experience = array();
        $position_arr = array();
        $skill_arr = array();
        foreach($user_experience_data as $user_experience){
            
            if($user_experience->adults != "null"){
                $adults = json_decode($user_experience->adults);
                
                if($user_experience->operating_room != "null" || $user_experience->operating_room_scout != "null" || $user_experience->operating_room_scrub != "null"){
                    if($user_experience->operating_room != "null"){
                        $operating_room = json_decode($user_experience->operating_room);
                        foreach($operating_room as $spec){
                            $spec_data = DB::table("speciality")->where("id",$spec)->first();
                            $specialty_experience[$spec_data->name] = $user_experience->assistent_level;
                            
                        }
                    }

                    if($user_experience->operating_room_scout != "null"){
                        $operating_room = json_decode($user_experience->operating_room_scout);
                        foreach($operating_room as $spec){
                            $spec_data = DB::table("speciality")->where("id",$spec)->first();
                            $specialty_experience[$spec_data->name] = $user_experience->assistent_level;
                            
                        }
                    }

                    if($user_experience->operating_room_scrub != "null"){
                        $operating_room = json_decode($user_experience->operating_room_scrub);
                        foreach($operating_room as $spec){
                            $spec_data = DB::table("speciality")->where("id",$spec)->first();
                            $specialty_experience[$spec_data->name] = $user_experience->assistent_level;
                            
                        }
                    }
                }else{
                    foreach($adults as $spec){
                        $spec_data = DB::table("speciality")->where("id",$spec)->first();
                        $specialty_experience[$spec_data->name] = $user_experience->assistent_level;
                        
                    }
                }
                
                
            }

            if($user_experience->paediatrics_neonatal != "null"){
                $paediatrics_neonatal = json_decode($user_experience->paediatrics_neonatal);

                if($user_experience->pad_op_room != "null" || $user_experience->pad_qr_scout != "null" || $user_experience->pad_qr_scrub != "null"){
                    if($user_experience->pad_op_room != "null"){
                        $pad_op_room = json_decode($user_experience->pad_op_room);
                        foreach($pad_op_room as $spec){
                            $spec_data = DB::table("speciality")->where("id",$spec)->first();
                            $specialty_experience[$spec_data->name] = $user_experience->assistent_level;
                            
                        }
                    }

                    if($user_experience->pad_qr_scout != "null"){
                        $pad_op_room = json_decode($user_experience->pad_qr_scout);
                        foreach($pad_op_room as $spec){
                            $spec_data = DB::table("speciality")->where("id",$spec)->first();
                            $specialty_experience[$spec_data->name] = $user_experience->assistent_level;
                            
                        }
                    }

                    if($user_experience->pad_qr_scrub != "null"){
                        $pad_op_room = json_decode($user_experience->pad_qr_scrub);
                        foreach($pad_op_room as $spec){
                            $spec_data = DB::table("speciality")->where("id",$spec)->first();
                            $specialty_experience[$spec_data->name] = $user_experience->assistent_level;
                            
                        }
                    }
                }else{
                    if($user_experience->neonatal_care != "null"){
                        $neonatal_care = json_decode($user_experience->neonatal_care);
                        foreach($neonatal_care as $spec){
                            $spec_data = DB::table("speciality")->where("id",$spec)->first();
                            $specialty_experience[$spec_data->name] = $user_experience->assistent_level;
                            
                        }
                    }else{
                        foreach($paediatrics_neonatal as $spec){
                            $spec_data = DB::table("speciality")->where("id",$spec)->first();
                            $specialty_experience[$spec_data->name] = $user_experience->assistent_level;
                            
                        }
                    }
                    
                }
                
                
                
            }

            if($user_experience->maternity != "null"){
                $maternity = json_decode($user_experience->maternity);
                
                if($user_experience->surgical_obstrics_gynacology == "null"){
                    foreach($maternity as $spec){
                        $spec_data = DB::table("speciality")->where("id",$spec)->first();
                        $specialty_experience[$spec_data->name] = $user_experience->assistent_level;
                    }
                }else{
                    $surgical_obstrics_gynacology = json_decode($user_experience->surgical_obstrics_gynacology);
                    foreach($surgical_obstrics_gynacology as $surgical_obs){
                        $spec_data = DB::table("speciality")->where("id",$surgical_obs)->first();
                        $specialty_experience[$spec_data->name] = $user_experience->assistent_level;
                    }
                }
                
                
            }

            if($user_experience->community != "null"){
                $community = json_decode($user_experience->community);
                foreach($community as $spec){
                    $spec_data = DB::table("speciality")->where("id",$spec)->first();
                    $specialty_experience[$spec_data->name] = $user_experience->assistent_level;
                }
            }

            $position_held = json_decode($user_experience->position_held);
            //print_r($position_held);
            
            foreach($position_held as $p_held){
                foreach($p_held as $p_held1){
                    
                    if (is_numeric($p_held1)) {
                        
                        $pos_data = DB::table("employee_positions")->where("position_id",$p_held1)->first();
                        $position_arr[] = $pos_data->position_name;
                    }else{
                        $position_arr[] = $p_held1;
                    }
                }
            }

            if($user_experience->org_and_any_skill != "null"){
                $org_skills = json_decode($user_experience->org_and_any_skill);
                
                foreach($org_skills as $o_skill){
                    $spec_data = DB::table("skills")->where("id",$o_skill)->first();
                    $skill_arr[] = $spec_data->name;
                }
                
            }
            
        }

        
        
        //print_r($skill_arr);
        $jobRequirements = [
            'min_experience' => 5, // years
            'specialty_experience' => [
                'Coronary Care Unit (CCU)' => 1,
                'Cardiology' => 1,
            ],
            'positions' => ['Charge Nurse'],
            'skills' => ['IV Start', 'Ventilator Management'],
        ];
 
        $nurseProfile = [
            'total_experience' => $total_experience,
            'specialty_experience' => $specialty_experience,
            'positions' => $position_arr,
            'skills' => $skill_arr,
        ];

        $data['experience_score'] = $this->matchCategory3_Experience($jobRequirements,$nurseProfile);

        $user_education_data = DB::table("user_education_cerification")->where("user_id",$user_id)->first();

        $degrees = json_decode($user_data->degree);

        $certificate_arr = array();

        if(!empty($user_education_data) && $user_education_data->acls_data != NULL){
            $acls_data = json_decode($user_education_data->acls_data);
                
            foreach($acls_data as $cert){
                
                $certificate_arr[] = $cert->acls_certification_id;
            }
        }

        if(!empty($user_education_data) && $user_education_data->bls_data != NULL){
            $bls_data = json_decode($user_education_data->bls_data);
                
            foreach($bls_data as $cert){
                
                $certificate_arr[] = $cert->bls_certification_id;
            }
        }

        

        if(!empty($user_education_data) && $user_education_data->cpr_data != NULL){
            $cpr_data = json_decode($user_education_data->cpr_data);
                
            foreach($cpr_data as $cert){
                
                $certificate_arr[] = $cert->cpr_certification_id;
            }
        }

        if(!empty($user_education_data) && $user_education_data->nrp_data != NULL){
            $nrp_data = json_decode($user_education_data->nrp_data);
                
            foreach($nrp_data as $cert){
                
                $certificate_arr[] = $cert->nrp_certification_id;
            }
        }

        if(!empty($user_education_data) && $user_education_data->pals_data != NULL){
            $pals_data = json_decode($user_education_data->pals_data);
                
            foreach($pals_data as $cert){
                
                $certificate_arr[] = $cert->pls_certification_id;
            }
        }

        if(!empty($user_education_data) && $user_education_data->rn_data != NULL){
            $rn_data = json_decode($user_education_data->rn_data);
                
            foreach($rn_data as $cert){
                
                $certificate_arr[] = $cert->rn_certification_id;
            }
        }

        if(!empty($user_education_data) && $user_education_data->np_data != NULL){
            $np_data = json_decode($user_education_data->np_data);
                
            foreach($np_data as $cert){
                
                $certificate_arr[] = $cert->np_certification_id;
            }
        }

        if(!empty($user_education_data) && $user_education_data->cna_data != NULL){
            $cna_data = json_decode($user_education_data->cna_data);
                
            foreach($cna_data as $cert){
                
                $certificate_arr[] = $cert->cn_certification_id;
            }
        }

        if(!empty($user_education_data) && $user_education_data->lpn_data != NULL){
            $lpn_data = json_decode($user_education_data->lpn_data);
                
            foreach($lpn_data as $cert){
                
                $certificate_arr[] = $cert->lpn_certification_id;
            }
        }

        if(!empty($user_education_data) && $user_education_data->crna_data != NULL){
            $crna_data = json_decode($user_education_data->crna_data);
                
            foreach($crna_data as $cert){
                
                $certificate_arr[] = $cert->crna_certification_id;
            }
        }

        if(!empty($user_education_data) && $user_education_data->cnm_data != NULL){
            $cnm_data = json_decode($user_education_data->cnm_data);
                
            foreach($cnm_data as $cert){
                
                $certificate_arr[] = $cert->cnm_certification_id;
            }
        }

        if(!empty($user_education_data) && $user_education_data->pals_data != NULL){
            $pals_data = json_decode($user_education_data->pals_data);
                
            foreach($pals_data as $cert){
                
                $certificate_arr[] = $cert->pls_certification_id;
            }
        }

        if(!empty($user_education_data) && $user_education_data->ons_data != NULL){
            $ons_data = json_decode($user_education_data->ons_data);
                
            foreach($ons_data as $cert){
                
                $certificate_arr[] = $cert->ons_certification_id;
            }
        }

        if(!empty($user_education_data) && $user_education_data->msw_data != NULL){
            $msw_data = json_decode($user_education_data->msw_data);
                
            foreach($msw_data as $cert){
                
                $certificate_arr[] = $cert->msw_certification_id;
            }
        }

        if(!empty($user_education_data) && $user_education_data->ain_data != NULL){
            $ain_data = json_decode($user_education_data->ain_data);
                
            foreach($ain_data as $cert){
                
                $certificate_arr[] = $cert->ain_certification_id;
            }
        }

        if(!empty($user_education_data) && $user_education_data->rpn_data != NULL){
            $rpn_data = json_decode($user_education_data->rpn_data);
                
            foreach($rpn_data as $cert){
                
                $certificate_arr[] = $cert->rpn_certification_id;
            }
        }

        if(!empty($user_education_data) && $user_education_data->additional_certification != NULL){
            $additional_certification = json_decode($user_education_data->additional_certification);
                
            foreach($additional_certification as $cert){
                
                $certificate_arr[] = $cert->training_certificate;
            }
        }

        //for training
        $user_training_data = DB::table("mandatory_training")->where("user_id",$user_id)->first();

        $training_arr = array();

        if(!empty($user_training_data) && $user_training_data->tech_innvo_data != NULL){
            $tech_innvo_data = json_decode($user_training_data->tech_innvo_data);
                
            foreach($tech_innvo_data as $train){
                
                $training_arr[] = $train->tech_tra_id;
            }
        }

        if(!empty($user_training_data) && $user_training_data->well_sel_data != NULL){
            $well_sel_data = json_decode($user_training_data->well_sel_data);
                
            foreach($well_sel_data as $train){
                
                $training_arr[] = $train->well_tra_id;
            }
        }

        if(!empty($user_training_data) && $user_training_data->leader_pro_data != NULL){
            $leader_pro_data = json_decode($user_training_data->leader_pro_data);
                
            foreach($leader_pro_data as $train){
                
                $training_arr[] = $train->lead_pro_tra_id;
            }
        }

        if(!empty($user_training_data) && $user_training_data->mid_spec_data != NULL){
            $mid_spec_data = json_decode($user_training_data->mid_spec_data);
                
            foreach($mid_spec_data as $train){
                
                $training_arr[] = $train->mid_spec_tra_id;
            }
        }

        if(!empty($user_training_data) && $user_training_data->clinic_skill_data != NULL){
            $clinic_skill_data = json_decode($user_training_data->clinic_skill_data);
                
            foreach($clinic_skill_data as $train){
                
                $training_arr[] = $train->cli_skill_tra_id;
            }
        }

        if(!empty($user_training_data) && $user_training_data->other_tra_data != NULL){
            $other_tra_data = json_decode($user_training_data->other_tra_data);
                
            foreach($other_tra_data as $train){
                
                $training_arr[] = $train->other_tra_id;
            }
        }

        $education_arr = array();

        if(!empty($user_training_data) && $user_training_data->emerg_topic_data != NULL){
            $emerg_topic_data = json_decode($user_training_data->emerg_topic_data);
                
            foreach($emerg_topic_data as $education){
                
                $education_arr[] = $education->emr_edu_id;
            }
        }

        if(!empty($user_training_data) && $user_training_data->safety_com_data != NULL){
            $safety_com_data = json_decode($user_training_data->safety_com_data);
                
            foreach($safety_com_data as $education){
                
                $education_arr[] = $education->saf_edu_id;
            }
        }

        if(!empty($user_training_data) && $user_training_data->spec_area_data != NULL){
            $spec_area_data = json_decode($user_training_data->spec_area_data);
                
            foreach($spec_area_data as $education){
                
                $education_arr[] = $education->spec_edu_id;
            }
        }

        if(!empty($user_training_data) && $user_training_data->mid_spe_data != NULL){
            $mid_spe_data = json_decode($user_training_data->mid_spe_data);
                
            foreach($mid_spe_data as $education){
                
                $education_arr[] = $education->mid_spe_edu_id;
            }
        }

        if(!empty($user_training_data) && $user_training_data->core_man_data != NULL){
            $core_man_data = json_decode($user_training_data->core_man_data);
                
            foreach($core_man_data as $education){
                
                $education_arr[] = $education->core_man_edu_id;
            }
        }

        if(!empty($user_training_data) && $user_training_data->other_edu_data != NULL){
            $other_edu_data = json_decode($user_training_data->other_edu_data);
                
            foreach($other_edu_data as $education){
                
                $education_arr[] = $education->other_edu_id;
            }
        }

        $user_membership_data = DB::table("professional_membership")->where("user_id",$user_id)->first();
        $professional_arr = array();
        if(!empty($user_membership_data) && $user_membership_data->membership_question == "Yes"){
            $professional_memb_data = json_decode($user_membership_data->organization_data);
            foreach($professional_memb_data as $organization_data){
                foreach($organization_data as $org_data){
                    foreach($org_data as $index=>$o_data){
                        
                        $profess_data = DB::table("professional_organization")->where("organization_id",$index)->first();
                        
                        $professional_arr[] = $profess_data->organization_country;
                    
                    }
                    
                }
                
            }
        }

        $award_arr = array();

        if(!empty($user_membership_data) && $user_membership_data->award_question == "Yes"){
            $award_recognitions_data = json_decode($user_membership_data->award_recognitions);
            foreach($award_recognitions_data as $organization_data){
                
                foreach($organization_data as $index=>$o_data){
                    
                    $profess_data = DB::table("awards_recognitions")->where("award_id",$index)->first();
                    
                    $award_arr[] = $profess_data->award_name;
                
                }
                    
                
                
            }
        }

        $user_languages_data = DB::table("language_skills")->where("user_id",$user_id)->first();

        $lang_arr = array();
        if(!empty($user_languages_data) && $user_languages_data->langprof_level != NULL){
            $langprof_level = json_decode($user_languages_data->langprof_level);
            foreach($langprof_level as $user_languages){
                    
                foreach($user_languages as $index=>$u_languages){
                    
                    $language_data = DB::table("languages")->where("language_id",$index)->first();
                    
                    $lang_arr[] = $language_data->language_name;
                
                }
                    
                
                
            }
        }

        $nurseProfile_education = [
            'degrees' => $degrees,
            'certifications' => $certificate_arr,
            'training' => $training_arr,
            'continuing_ed' => $education_arr,
            'memberships' => $professional_arr,
            'awards' => $award_arr,
            'languages' => $lang_arr,
        ];

        $jobRequirements_edu = [
            'degrees' => ['BSN', 'Midwifery'],
            'certifications' => ['BLS', 'RN License'],
            'training' => ['Manual Handling', 'Infection Control'],
            'continuing_ed' => ['Neonatal Resuscitation'],
            'memberships' => ['NMC'],
            'awards' => ['Excellence in Nursing'],
            'languages' => ['English', 'Spanish'],
        ];

        $data['educationScore'] = $this->matchCategory4_EducationCerts($jobRequirements_edu, $nurseProfile_education);

        
        
        $user_vaccination_data = DB::table("vaccination_front")->where("user_id",$user_id)->get();

        $vaccination_arr = array();
        if(!empty($user_vaccination_data)){
            foreach($user_vaccination_data as $user_vaccination){
                $vaccination_data = DB::table("vaccination")->where("id",$user_vaccination->vaccination_id)->first();
                $vaccination_arr[] = $vaccination_data->name;
            }
        }

        //print_r($vaccination_arr);

        $jobRequirements_vaccine = [
            'vaccinations' => ['COVID-19', 'Influenza', 'Hepatitis B', 'MMR', 'Varicella', 'DTP', 'Tuberculosis']
        ];
        
        $nurseProfile_vaccine = [
            'vaccinations' => $vaccination_arr
        ];
        
        $data['vaccinationScore'] = $this->matchCategory5_Vaccinations($jobRequirements_vaccine, $nurseProfile_vaccine);


        $eligiblity_work_data = DB::table("eligibility_to_work")->where("user_id",$user_id)->first();
        $ndis_screening_check = DB::table("ndis_screening_check")->where("user_id",$user_id)->first();
        $working_children_check = DB::table("working_children_check")->where("user_id",$user_id)->first();
        $police_check = DB::table("police_check")->where("user_id",$user_id)->first();
        $speacilaized_clearance = DB::table("speacilaized_clearance")->where("user_id",$user_id)->first();

        $clearance_arr = array();

        if(!empty($eligiblity_work_data)){
            $clearance_arr[] = "Residency and Work Eligibility";
        }

        if(!empty($police_check)){
            $clearance_arr[] = "Police Clearance (National/State)";
        }

        if(!empty($ndis_screening_check)){
            $clearance_arr[] = "NDIS Worker Screening Check";
        }

        if(!empty($working_children_check)){
            $clearance_arr[] = "Working With Children Check (WWCC)";
        }

        if(!empty($speacilaized_clearance)){
            $clearance_arr[] = "Other Region-Specific Clearances";
        }

        $jobRequirements_clearance = [
            'clearances' => [
                'Residency and Work Eligibility',
                'Police Clearance',
                'NDIS Worker Screening Check',
                'Working With Children Check (WWCC)'
            ]
        ];

        $nurseProfile_clearance = [
            'clearances' => $clearance_arr
        ];

        $data['clearanceScore'] = $this->matchCategory6_Clearances($jobRequirements_clearance, $nurseProfile_clearance);

        
        $work_preferences = DB::table("work_preferences")->where("user_id",$user_id)->first();
        
        if ($work_preferences) {
            $sector_preference = $work_preferences->sector_preferences;
            $environment_preferences = json_decode($work_preferences->work_environment_preferences);
            $employment_type = json_decode($work_preferences->emptype_preferences);
            $shift_prefs = (array)json_decode($work_preferences->work_shift_preferences);
            $position_prefs = json_decode($work_preferences->position_preferences);
            $benefit_preferences = json_decode($work_preferences->benefits_preferences);
        } else {
            // Handle the case where there are no preferences for the given user_id
            // For example, you can set defaults or display an error message
            $sector_preference = null;
            $environment_preferences = null;
            $employment_type = null;
            $shift_prefs = null;
            $position_prefs = null;
            $benefit_preferences = null;
        
            // Optionally, log or notify about the missing preferences record
        }

        $env_arr = array();
        if(!empty($environment_preferences)){
            foreach($environment_preferences as $env_prefer){
                foreach($env_prefer as $e_prefer){
                    
                    foreach($e_prefer as $e_pre){
                        
                        
                        if (is_array($e_pre)) {
                            foreach($e_pre as $e_pre1){
                               
                                $environment_data = DB::table("work_enviornment_preferences")->where("prefer_id",$e_pre1)->first();
                                $env_arr[] =  $environment_data->env_name;
                            }
                        } else {
                            $environment_data = DB::table("work_enviornment_preferences")->where("prefer_id",$e_pre)->first();
                            $env_arr[] =  $environment_data->env_name;
                        }
                        
                    } 
                } 
            }
        }
        $emp_type = '';
        if(!empty($employment_type)){
            foreach($employment_type as $index=>$emp_type){
                $emptype_data = DB::table("employeement_type_preferences")->where("emp_prefer_id",$index)->first();
                $emp_type = $emptype_data->emp_type;
            }
        }

        $shift_arr = array();
        if(!empty($shift_prefs)){
            
            foreach($shift_prefs[1] as $sh_prefs){
                
                $shift_name = DB::table("work_shift_preferences")->where("work_shift_id",$sh_prefs)->first();
                $shift_arr[] = $shift_name->shift_name;
            }
            
        }

        $pos_arr = '';
        if(!empty($position_prefs)){
            
            foreach($position_prefs as $pos_prefs){
                foreach($pos_prefs as $pos_pref){
                    foreach($pos_pref as $ppref){

                        if (is_numeric($ppref)) {
                        
                            $pos_name = DB::table("employee_positions")->where("position_id",$ppref)->first();
                            $pos_arr = $pos_name->position_name;
                        }else{
                            $pos_arr = $ppref;
                        }
                        
                    }
                }
                
            }
            
        }

        $benefit_arr = array();
        if(!empty($benefit_preferences)){
            foreach($benefit_preferences as $bfit_preferences){
                foreach($bfit_preferences as $bfit_prefer){
                    $benefit_name = DB::table("benefits_preferences")->where("benefits_id",$bfit_prefer)->first();
                    $benefit_arr[] = $benefit_name->benefits_name;
                }
            }
        }
        
        
        $nurse_preferences = [
            'sector_preference' => $sector_preference,
            'environment_preferences' => $env_arr,
            'employment_type' => $emp_type,
            'shift_prefs' => $shift_arr,
            'position_preference' => $pos_arr,
            'benefit_preferences' => $benefit_arr,
            'location' => ['lat' => 40.7128, 'lng' => -74.0060], // e.g. New York
            'expected_salary' => 60000
        ];

        $job_preferences = [
            'sector' => 'Public',
            'environments' => ['Hospital', 'Clinic'],
            'employment_type' => 'Permanent',
            'shifts' => ['Night', 'Rotational'],
            'position' => 'Charge Nurse',
            'benefits' => ['Health Insurance', 'Gym Membership'],
            'location' => ['lat' => 40.730610, 'lng' => -73.935242], // also in New York
            'salary' => 62000
        ];
        
        $data['flexiblity_score'] = $this->calculateCategory7Score($nurse_preferences, $job_preferences);

        $speciality_data = DB::table("speciality")->get();

        $speciality_arr = array();

        if(!empty($speciality_data)){
            foreach($speciality_data as $spec_data){
                if($spec_data->parent == 0){
                    $parent_name = '';
                }else{
                    $p_name = DB::table("speciality")->where("id",$spec_data->parent)->first();
                    $parent_name = $p_name->name;
                }
                $speciality_arr[] = array("name"=>$spec_data->name,"parent_name"=>$parent_name);
                
            }
        }
        // echo "<pre>";
        // print_r($speciality_arr);die;

        $specialty_hierarchy = $this->build_specialty_hierarchy($speciality_arr);

        // echo "<pre>";
        // print_r($specialty_hierarchy);die;

        $nurse_specialties = ['Adults', 'Neonatal Care']; // example nurse specialties

        if(!empty($user_data)){
            if($user_data->specialties != "null"){
                $specialities = json_decode($user_data->specialties);
            }else{
                $specialities = [];
            }

            if($user_data->adults != "null"){
                $adults = json_decode($user_data->adults);
            }else{
                $adults = [];
            }

            if($user_data->maternity != "null"){
                $maternity = json_decode($user_data->maternity);
            }else{
                $maternity = [];
            }

            if($user_data->paediatrics_neonatal != "null"){
                $paediatrics_neonatal = json_decode($user_data->paediatrics_neonatal);
            }else{
                $paediatrics_neonatal = [];
            }

            if($user_data->community != "null"){
                $community = json_decode($user_data->community);
            }else{
                $community = [];
            }

            if($user_data->surgical_preoperative != "null"){
                $surgical_preoperative = json_decode($user_data->surgical_preoperative);
            }else{
                $surgical_preoperative = [];
            }

            if($user_data->operating_room != "null"){
                $operating_room = json_decode($user_data->operating_room);
            }else{
                $operating_room = [];
            }

            if($user_data->operating_room_scout != "null"){
                $operating_room_scout = json_decode($user_data->operating_room_scout);
            }else{
                $operating_room_scout = [];
            }

            if($user_data->operating_room_scrub != "null"){
                $operating_room_scrub = json_decode($user_data->operating_room_scrub);
            }else{
                $operating_room_scrub = [];
            }

            if($user_data->surgical_obstrics_gynacology != "null"){
                $surgical_obstrics_gynacology = json_decode($user_data->surgical_obstrics_gynacology);
            }else{
                $surgical_obstrics_gynacology = [];
            }

            if($user_data->neonatal_care != "null"){
                $neonatal_care = json_decode($user_data->neonatal_care);
            }else{
                $neonatal_care = [];
            }

            if($user_data->paedia_surgical_preoperative != "null"){
                $paedia_surgical_preoperative = json_decode($user_data->paedia_surgical_preoperative);
            }else{
                $paedia_surgical_preoperative = [];
            }

            if($user_data->pad_op_room != "null"){
                $pad_op_room = json_decode($user_data->pad_op_room);
            }else{
                $pad_op_room = [];
            }

            if($user_data->pad_qr_scout != "null"){
                $pad_qr_scout = json_decode($user_data->pad_qr_scout);
            }else{
                $pad_qr_scout = [];
            }

            if($user_data->pad_qr_scrub != "null"){
                $pad_qr_scrub = json_decode($user_data->pad_qr_scrub);
            }else{
                $pad_qr_scrub = [];
            }
            
            $combined = array_merge($specialities, $adults, $maternity,$paediatrics_neonatal,$community,$surgical_preoperative,$operating_room,$operating_room_scout,$operating_room_scrub,);

            //print_r($combined);
        }
        
        
        
        $specialty_hierarchy = [
            'Adults' => [
                'Surgical Preoperative and Postoperative Care' => [
                    'Operating Room (OR)' => [
                        'Scout (Circulating Nurse)',
                        'Scrub (Technician Nurse)'
                    ]
                ]
            ],
            'Maternity OB/GYN/MFM' => [
                'Surgical Obstetrics and Gynecology (OB/GYN)'
            ],
            'Paediatrics Neonatal Perinatal' => [
                'Neonatal Care',
                'Paediatric Surgical Preoperative and Postoperative Care'
            ],
            'Paediatric Operating Room (OR)' => [
                'Paediatric OR: Scout (Circulating Nurse)',
                'Paediatric OR: Scrub (Technician Nurse)'
            ],
            'Community' => []
        ];
        
        
        // $score_arr = array();

        // foreach($nurse_cat_arr as $nurse_cat){
        //     foreach($job as $jobs){
        //         //print_r($jobs);
        //         $score_arr[] = $this->calculateCategory1Score($jobs, $nurse_cat);
        //     }
        // }

        // //print_r();

        //print_r($nurseProfile_education);
        
        return view('nurse.match_percentage')->with($data);
    }

    public function build_specialty_hierarchy($specialties) {
        $lookup = [];
        $tree = [];
    
        // Build lookup by name
        foreach ($specialties as $specialty) {
            $lookup[$specialty['name']] = [
                'name' => $specialty['name'],
                'children' => []
            ];
        }
    
        // Build the tree
        foreach ($specialties as $specialty) {
            if (empty($specialty['parent_name'])) {
                // Top-level node
                $tree[$specialty['name']] = &$lookup[$specialty['name']];
            } else {
                // Attach to parent
                if (isset($lookup[$specialty['parent_name']])) {
                    $lookup[$specialty['parent_name']]['children'][$specialty['name']] = &$lookup[$specialty['name']];
                }
            }
        }
    
        // Cleanup: remove 'name' and flatten single children levels
        return $this->simplify_hierarchy($tree);
    }
    
    // Simplify function to match exactly your array format
    public function simplify_hierarchy($tree) {
        $result = [];
    
        foreach ($tree as $node) {
            if (empty($node['children'])) {
                // Leaf node — just add the name
                $result[] = $node['name'];
            } else {
                // Has children — build deeper
                $child_result = $this->simplify_hierarchy($node['children']);
                
                // If child result is only simple names, then flatten
                if (array_keys($child_result) === range(0, count($child_result) - 1)) {
                    $result[$node['name']] = $child_result;
                } else {
                    $result[$node['name']] = $child_result;
                }
            }
        }
    
        return $result;
    }

    public function calculateCategory1Score($job, $nurse) {
        // Weight distribution
        $totalWeight = 15; // Total weight for Category 1
        $categoryWeight = [
            'nurse_category' => 6,
            'special_role' => 6,
            'flexibility' => 3
        ];
        //print_r($job);die;
    
        $score = 0;
    
        // 1. Nurse Category Match (e.g., RN, APRN, Entry-Level)
        if ($job['category'] === $nurse['category']) {
            $score += $categoryWeight['nurse_category'];
        } elseif (
            ($job['category'] === 'Registered Nurses (RNs)' && in_array($nurse['category'], ['Entry level nursing', 'Registered Nurses (RNs)', 'Advanced Practice Registered Nurses (APRNs)', 'Nurse Practitioner (NP)'])) ||
            ($job['category'] === 'Entry Level' && $nurse['category'] !== null)
        ) {
            $score += $categoryWeight['nurse_category'] * 0.5; // Partial match
        } elseif (
            ($nurse['category'] === 'NP' && $job['category'] === 'RN')
        ) {
            $score += $categoryWeight['nurse_category'] * 0.75; // Overqualified
        }
    
        // 2. Special Role Match (e.g., ICU Nurse, Pediatric Nurse)
        if ($job['special_role'] === $nurse['special_role']) {
            $score += $categoryWeight['special_role'];
        } elseif (
            $this->areRolesRelated($job['special_role'], $nurse['special_role'])
        ) {
            $score += $categoryWeight['special_role'] * 0.5; // Related match
        }
    
        // 3. Flexibility / Compatibility
        if (
            $this->isOverqualified($nurse['category'], $job['category'])
        ) {
            $score += $categoryWeight['flexibility'] * 0.75;
        } elseif (
            $this->isCompatible($nurse, $job)
        ) {
            $score += $categoryWeight['flexibility'] * 0.5;
        }
    
        return $score;
    }
    
    // Example helper functions:
    public function areRolesRelated($nurse, $job) {
        $related_data1 = DB::table("practitioner_type")->where("parent",2)->get();
        $related_data2 = DB::table("practitioner_type")->where("parent",1)->get();
        $related_data3 = DB::table("practitioner_type")->where("parent",3)->get();

        $rel_arr1 = array();
        $rel_arr2 = array();
        $rel_arr3 = array();

        foreach($related_data1 as $reld1){
            $rel_arr1[] = $reld1->name;
        }

        foreach($related_data2 as $reld2){
            $rel_arr2[] = $reld2->name;
        }

        foreach($related_data3 as $reld3){
            $rel_arr3[] = $reld3->name;
        }


        //$entry_level_data = DB::table("")->where()->get();



        $relatedRoles = [
            $rel_arr1[0] => array_slice($rel_arr1, 1),
            $rel_arr1[1] => array_slice($rel_arr2, 1),
            $rel_arr1[2] => array_slice($rel_arr3, 1)
            // Add more mappings as needed
        ];
    
        return in_array($role2, $relatedRoles[$role1]);
    }
    
    public function isOverqualified($nurseCategory, $jobCategory) {
        $hierarchy = ['Entry level nursing' => 1, 'Registered Nurses (RNs)' => 2, 'Advanced Practice Registered Nurses (APRNs)' => 3, 'Nurse Practitioner (NP)' => 4];
        return $hierarchy[$nurseCategory] > $hierarchy[$jobCategory];
    }
    
    public function isCompatible($nurse, $job) {
        // Placeholder logic for compatibility (can be expanded)
        return $this->areRolesRelated($nurse, $job);
    }

    function matchCategory3_Experience($jobRequirements, $nurseProfile, $categoryWeight = 15) {
        // Weight distribution
        $weights = [
            'total_experience' => 5,
            'specialty_experience' => 5,
            'positions' => 2.5,
            'skills' => 2.5,
        ];
    
        $score = 0;
    
        // 1. Total Experience
        if (isset($jobRequirements['min_experience']) && isset($nurseProfile['total_experience'])) {
            $nurseYears = $nurseProfile['total_experience'];
            $requiredYears = $jobRequirements['min_experience'];
            $matchRatio = min($nurseYears / $requiredYears, 1); // cap at 1
            $score += $matchRatio * $weights['total_experience'];
        }

        
    
        // 2. Specialty Experience
        if (!empty($jobRequirements['specialty_experience']) && !empty($nurseProfile['specialty_experience'])) {
            $matched = 0;
            $total = count($jobRequirements['specialty_experience']);
            foreach ($jobRequirements['specialty_experience'] as $specialty => $minYears) {
                if (isset($nurseProfile['specialty_experience'][$specialty])) {
                    $nurseYears = $nurseProfile['specialty_experience'][$specialty];
                    $matchRatio = min($nurseYears / $minYears, 1); // cap at 1
                    $matched += $matchRatio;
                }
            }
            if ($total > 0) {
                $score += ($matched / $total) * $weights['specialty_experience'];
            }
        }
    
        // 3. Position Held
        if (!empty($jobRequirements['positions']) && !empty($nurseProfile['positions'])) {
            $matched = 0;
            $total = count($jobRequirements['positions']);
            foreach ($jobRequirements['positions'] as $requiredPos) {
                foreach ($nurseProfile['positions'] as $nursePos) {
                    if ($requiredPos === $nursePos) {
                        $matched += 1;
                        break;
                    } elseif (strpos($nursePos, $requiredPos) !== false || strpos($requiredPos, $nursePos) !== false) {
                        $matched += 0.5; // related match
                        break;
                    }
                }
            }
            if ($total > 0) {
                $score += ($matched / $total) * $weights['positions'];
            }
        }
    
        // 4. Skills / Expertise
        if (!empty($jobRequirements['skills']) && !empty($nurseProfile['skills'])) {
            $matched = count(array_intersect($jobRequirements['skills'], $nurseProfile['skills']));
            $total = count($jobRequirements['skills']);
            if ($total > 0) {
                $score += ($matched / $total) * $weights['skills'];
            }
        }
    
        return round($score, 2); // Return score out of 15%
    }

    public function matchCategory4_EducationCerts($jobRequirements, $nurseProfile, $categoryWeight = 15) {
        $weights = [
            'degrees' => 3,
            'certifications' => 3,
            'training' => 2,
            'continuing_ed' => 2,
            'memberships' => 1.5,
            'awards' => 1.5,
            'languages' => 2,
        ];
    
        $score = 0;
    
        // 1. Degrees
        if (!empty($jobRequirements['degrees']) && !empty($nurseProfile['degrees'])) {
            $matched = count(array_intersect($jobRequirements['degrees'], $nurseProfile['degrees']));
            $total = count($jobRequirements['degrees']);
            $score += ($total > 0) ? ($matched / $total) * $weights['degrees'] : 0;
        }
    
        // 2. Certifications / Licenses
        if (!empty($jobRequirements['certifications']) && !empty($nurseProfile['certifications'])) {
            $matched = count(array_intersect($jobRequirements['certifications'], $nurseProfile['certifications']));
            $total = count($jobRequirements['certifications']);
            $score += ($total > 0) ? ($matched / $total) * $weights['certifications'] : 0;
        }
    
        // 3. Mandatory Training
        if (!empty($jobRequirements['training']) && !empty($nurseProfile['training'])) {
            $matched = count(array_intersect($jobRequirements['training'], $nurseProfile['training']));
            $total = count($jobRequirements['training']);
            $score += ($total > 0) ? ($matched / $total) * $weights['training'] : 0;
        }
    
        // 4. Continuing Education
        if (!empty($jobRequirements['continuing_ed']) && !empty($nurseProfile['continuing_ed'])) {
            $matched = count(array_intersect($jobRequirements['continuing_ed'], $nurseProfile['continuing_ed']));
            $total = count($jobRequirements['continuing_ed']);
            $score += ($total > 0) ? ($matched / $total) * $weights['continuing_ed'] : 0;
        }
    
        // 5. Memberships
        if (!empty($jobRequirements['memberships']) && !empty($nurseProfile['memberships'])) {
            $matched = count(array_intersect($jobRequirements['memberships'], $nurseProfile['memberships']));
            $total = count($jobRequirements['memberships']);
            $score += ($total > 0) ? ($matched / $total) * $weights['memberships'] : 0;
        }
    
        // 6. Awards
        if (!empty($jobRequirements['awards']) && !empty($nurseProfile['awards'])) {
            $matched = count(array_intersect($jobRequirements['awards'], $nurseProfile['awards']));
            $total = count($jobRequirements['awards']);
            $score += ($total > 0) ? ($matched / $total) * $weights['awards'] : 0;
        }
    
        // 7. Language Proficiency
        if (!empty($jobRequirements['languages']) && !empty($nurseProfile['languages'])) {
            $matched = count(array_intersect($jobRequirements['languages'], $nurseProfile['languages']));
            $total = count($jobRequirements['languages']);
            $score += ($total > 0) ? ($matched / $total) * $weights['languages'] : 0;
        }
    
        return round($score, 2); // Score out of 15%
    }

    public function matchCategory5_Vaccinations($jobRequirements, $nurseProfile, $categoryWeight = 5) {
        if (empty($jobRequirements['vaccinations']) || empty($nurseProfile['vaccinations'])) {
            return 0;
        }
    
        $required = $jobRequirements['vaccinations'];
        $provided = $nurseProfile['vaccinations'];
    
        $matched = count(array_intersect($required, $provided));
        $total = count($required);
    
        if ($total === 0) return 0;
    
        $score = ($matched / $total) * $categoryWeight;
    
        return round($score, 2);
    }

    public function matchCategory6_Clearances($jobRequirements, $nurseProfile, $categoryWeight = 5) {
        if (empty($jobRequirements['clearances']) || empty($nurseProfile['clearances'])) {
            return 0;
        }
    
        // Optionally enforce residency eligibility
        if (in_array('Residency and Work Eligibility', $jobRequirements['clearances']) &&
            !in_array('Residency and Work Eligibility', $nurseProfile['clearances'])) {
            return 0; // Mandatory condition failed
        }
    
        $required = $jobRequirements['clearances'];
        $provided = $nurseProfile['clearances'];
    
        // Count all matches
        $matched = count(array_intersect($required, $provided));
        $total = count($required);
    
        if ($total === 0) return 0;
    
        $score = ($matched / $total) * $categoryWeight;
    
        return round($score, 2);
    }

    public function calculateCategory7Score($nurse, $job) {
        $category7_weight = 30; // Total weight of the category
        $subcategory_weight = $category7_weight / 8; // 8 subcategories
    
        $score = 0;
    
        // 1. Sector Preferences: Public / Private / Mixed
        if ($nurse['sector_preference'] == $job['sector']) {
            $score += $subcategory_weight;
        } elseif ($nurse['sector_preference'] == 'Mixed') {
            $score += $subcategory_weight * 0.75;
        } else {
            $score += $subcategory_weight * 0.3;
        }
    
        // 2. Work Environment Preferences
        $env_matches = array_intersect($nurse['environment_preferences'], $job['environments']);
        $env_score = count($nurse['environment_preferences']) > 0 
            ? count($env_matches) / count($nurse['environment_preferences']) 
            : 0;
        $score += $subcategory_weight * $env_score;
    
        // 3. Employment Type Preferences
        if ($nurse['employment_type'] == $job['employment_type'] || $nurse['employment_type'] == 'Both') {
            $score += $subcategory_weight;
        } else {
            $score += $subcategory_weight * 0.4;
        }
    
        // 4. Work-Life Balance & Shift Preferences
        $shift_score = $this->shift_preference_score($nurse['shift_prefs'], $job['shifts']); // 0 to 1
        $score += $subcategory_weight * $shift_score;
    
        // 5. Position Preferences
        if ($nurse['position_preference'] == $job['position']) {
            $score += $subcategory_weight;
        } elseif ($this->is_flexible_position_match($nurse['position_preference'], $job['position'])) {
            $score += $subcategory_weight * 0.6;
        } else {
            $score += $subcategory_weight * 0.3;
        }
    
        // 6. Benefits Preferences
        $benefit_matches = array_intersect($nurse['benefit_preferences'], $job['benefits']);
        $benefit_score = count($nurse['benefit_preferences']) > 0 
            ? count($benefit_matches) / count($nurse['benefit_preferences']) 
            : 0;
        $score += $subcategory_weight * $benefit_score;
    
        // 7. Location Preferences
        $distance_km = $this->calculate_distance($nurse['location'], $job['location']);
        if ($distance_km <= 25 || $nurse['willing_to_relocate']) {
            $score += $subcategory_weight;
        } elseif ($distance_km <= 50) {
            $score += $subcategory_weight * 0.7;
        } else {
            $score += $subcategory_weight * 0.3;
        }
    
        // 8. Salary Expectations
        if ($job['salary'] >= $nurse['expected_salary']) {
            $score += $subcategory_weight;
        } elseif ($job['salary'] >= $nurse['expected_salary'] * 0.9) {
            $score += $subcategory_weight * 0.7;
        } else {
            $score += $subcategory_weight * 0.3;
        }
    
        return round($score, 2); // Return score out of 30
    }
    
    public function shift_preference_score($nurseShifts, $jobShifts) {
        if (empty($nurseShifts) || empty($jobShifts)) {
            return 0;
        }
    
        $matches = array_intersect($nurseShifts, $jobShifts);
        $score = count($matches) / count($nurseShifts); // How many of the nurse's preferred shifts are offered
        return min(1, $score); // Return between 0 and 1
    }

    public function is_flexible_position_match($preferred, $actual) {
        $flexiblity_data = DB::table("employee_positions")->where("subposition_id","!=","0")->get();

        $flex_arr = array();

        if (!empty($flexiblity_data)) {
            foreach ($flexiblity_data as $flex_data) {
                $flex_arr[] = $flex_data->position_name;
            }
        }

        $flexiblity_map_data = array();

        if (!empty($flex_arr)) {
            foreach ($flex_arr as $f_data) {
                $flexiblity_map_data[$f_data] = array_diff($flex_arr, [$f_data]);
            }
        }
        

        $flexibility_map = $flexiblity_map_data;
    
        if (isset($flexibility_map[$preferred]) && in_array($actual, $flexibility_map[$preferred])) {
            return true;
        }
        return false;
    }

    public function calculate_distance($loc1, $loc2) {
        $earth_radius = 6371; // Earth radius in kilometers
    
        $lat1 = deg2rad($loc1['lat']);
        $lon1 = deg2rad($loc1['lng']);
        $lat2 = deg2rad($loc2['lat']);
        $lon2 = deg2rad($loc2['lng']);
    
        $delta_lat = $lat2 - $lat1;
        $delta_lon = $lon2 - $lon1;
    
        $a = sin($delta_lat/2) * sin($delta_lat/2) +
             cos($lat1) * cos($lat2) *
             sin($delta_lon/2) * sin($delta_lon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    
        $distance = $earth_radius * $c;
    
        return round($distance, 1); // distance in km
    }
    
    
}