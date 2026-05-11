<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\NurseRepository;
use App\Services\Admins\NurseServices;
use App\Repository\Eloquent\VerificationRepository;
use Illuminate\Support\Facades\Mail;

use App\Models\LicensesModel;
use App\Models\EligibilityToWorkModel;
use App\Models\WorkingChildrenCheckModel;
use App\Models\NdisWorker;
use App\Models\SpecializedClearance;
use App\Models\SubClassModel;
use App\Models\PoliceCheckModel;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Models\MandatoryTrainModel;
use Carbon\Carbon;
use File;
use DB;
use Helpers;

class NurseprofileController extends Controller
{
    protected $nurseRepository;
    protected $nurseServices;
    protected $verificationRepository;

    public function __construct(NurseRepository $nurseRepository, NurseServices $nurseServices, VerificationRepository $verificationRepository)
    {
        $this->nurseRepository = $nurseRepository;
        $this->nurseServices = $nurseServices;
        $this->verificationRepository = $verificationRepository;
    }

    public function setting_availablity_view(Request $request)
    {
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        return view('admin.setting_availability_view')->with($data);
    }

    public function profession_view(Request $request)
    {
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        return view('admin.view_profession')->with($data);
    }

    public function education_certification(Request $request)
    {
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['educationData']  = $this->nurseRepository->getEducationCerdetails(['user_id' => $request->id]);
        return view('admin.education_certification_view')->with($data);
    }

    public function registration_licenses(Request $request)
    {
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['licensesData']  = DB::table('user_licenses_details')->where("user_id",$request->id)->first();
        //print_r($data['licensesData']);
        return view('admin.registration_licenses_view')->with($data);
    }

    public function ahpra_reverify(Request $request)
    {
        DB::table('user_licenses_details')->where("user_id",$request->user_id)->update(["ahpra_reverify"=>$request->ahpra_reverify]);
    }

    public function experience_view(Request $request)
    {
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['experienceData']  = DB::table("user_experience")->where("user_id", $request->id)->get();
        //print_r($data['licensesData']);
        return view('admin.view_experience')->with($data);
    }

    public function professional_membership(Request $request)
    {
        
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['professional_membership']  = DB::table("professional_membership")->where("user_id", $request->id)->first();
        // echo "<pre>";
        // print_r($data['professional_membership']);
        return view('admin.view_professional_membership')->with($data);
    }

    public function language_skills(Request $request)
    {
        
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['language_skills']  = DB::table("language_skills")->where("user_id", $request->id)->first();
        // echo "<pre>";
        // print_r($data['professional_membership']);
        return view('admin.view_language_skills')->with($data);
    }

    public function view_references(Request $request)
    {
        
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['RefereData']  = $this->nurseRepository->getReferedetails(['user_id' => $request->id]);
        // echo "<pre>";
        //  print_r($data['RefereData']);
        return view('admin.references_view')->with($data);
    }

    public function vaccination_view(Request $request)
    {
        $data['other_vaccine']      = DB::table("other_vaccine")->where("user_id", $request->id)->get();   
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['vaccinationData']    = DB::table("vaccination_front")->where("user_id", $request->id)->get();
        $data['vccdata']            = DB::table('vaccination_front as vc')
                                    ->select('vc.*', 'v.name as vaccination_name', 'ims.name as imm_status', 'et.name as evidence_type_name')
                                    ->join('vaccination as v', 'vc.vaccination_id', '=', 'v.id')
                                    ->join('imm_status as ims', 'vc.immunization_status', '=', 'ims.id')
                                    ->join('evidence_type as et', 'vc.evidance_type', '=', 'et.id')
                                    ->where('vc.user_id', $request->id)
                                    ->get();

        // echo "<pre>";
        //  print_r($data['RefereData']);
        return view('admin.vaccination_view')->with($data);
    }

    public function checks_clearacnces(Request $request)
    {
        
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);

        $user_id=$request->id;
        $data['ndis']               = NdisWorker::where('user_id', $user_id)->first();              
        $data['ww_child']           = WorkingChildrenCheckModel::where('user_id', $user_id)->get();
        $data['policy_check']       = PoliceCheckModel::where('user_id', $user_id)->first();
        $data['specialize']         = SpecializedClearance::where('user_id', $user_id)->get();
        $data['work_eligibility']   = DB::table('eligibility_to_work as ew')
                                ->select('ew.*','c.name as country_name', DB::raw("IFNULL(vs.sublcass_text, '') as sublcass_text"))
                                ->leftJoin('visa_subclas as vs', 'ew.visa_subclass', '=', 'vs.id')
                                ->leftJoin('country as c', 'ew.country_id', '=', 'c.id')
                                ->where('ew.user_id', $request->id)
                                ->first();
        // echo "<pre>";
        //  print_r($data['RefereData']);
        return view('admin.checks_clearacnces_view')->with($data);
    }

    public function mandatory_training_view(Request $request)
    {
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['trainingData']  = DB::table("mandatory_training")->where("user_id",$request->id)->first();

        return view('admin.mandatory_training_view')->with($data);
    }

    public function add_registration_licences(Request $request)
    {
        $user_id = $request->id;
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['licenses_data'] = LicensesModel::where("user_id",$user_id)->first();
        return view ("admin.edit_registration_licences")->with($data);
    }

    public function ahepra_lookup(Request $request, AhpraLookupService11 $ahpra)
    {
       $ahpraNumber = $request->input('ahpraNumber');

    $queryUrl = 'https://www.ahpra.gov.au/Registration/Registers-of-Practitioners.aspx?' . http_build_query([
        'RegistrationNumber' => $ahpraNumber
    ]);

    try {
        // Set timeout and retries for better stability
        $response = Http::timeout(20)->retry(3, 1000)->get($queryUrl);

        if ($response->failed()) {
            Log::warning("AHPRA request failed. Status: " . $response->status());
            return response()->json(['error' => 'Failed to contact AHPRA register. Please try again later.'], 503);
        }

        $html = $response->body();

        // Basic "No Records" check
        if (stripos($html, 'No records found') !== false) {
            return response()->json(['error' => 'No practitioner found with this AHPRA number.'], 404);
        }

        // Parse the HTML
        libxml_use_internal_errors(true);
        $doc = new \DOMDocument();
        $doc->loadHTML($html);
        $xpath = new \DOMXPath($doc);

        $extract = function ($label) use ($xpath) {
            $nodeList = $xpath->query("//td[contains(text(), '$label')]/following-sibling::td");
            return $nodeList->length > 0 ? trim($nodeList->item(0)->textContent) : null;
        };

        $result = [
            'division' => $extract('Division'),
            'endorsements' => $extract('Endorsements'),
            'registration_type' => $extract('Registration Type'),
            'registration_status' => $extract('Registration Status'),
            'notations' => $extract('Notations'),
            'conditions' => $extract('Conditions'),
            'expiry' => $extract('Expiry Date'),
            'principal_place' => $extract('Principal Place of Practice'),
            'other_places' => $extract('Other Places of Practice'),
        ];

        // Check if all fields are null
        $allNull = empty(array_filter($result, fn($value) => !is_null($value)));

        if ($allNull) {
            return response()->json(['error' => 'No valid registration data found for this AHPRA number.']);
        }

        return response()->json($result);

    } catch (\Exception $e) {
        Log::error("AHPRA lookup exception: " . $e->getMessage());
        return response()->json(['error' => 'AHPRA service is currently unavailable. Please try again shortly.']);
    }

        
        
        
    }

    public function update_registration_licenses(Request $request){
        $ahpra_registration_status = $request->ahpra_registration_status;
        $user_id = $request->user_id;

        
        //print_r($authorizing_body_program);die;

        if($ahpra_registration_status == "RN" || $ahpra_registration_status == "RM" || $ahpra_registration_status == "RN_RM" || $ahpra_registration_status == "NP"){
            $ahpra_number = $request->ahpra_number;
            $ahpra_consent = isset($request->ahpra_consent)?1:0;
            
            $upload_register_evidence = $request->registration_upload;
            $last_verified_date = $request->last_verified_date;
            $api_verify = $request->api_verify;

            if($api_verify == 1){
                $division = $request->api_division;
                $endorsements = $request->api_endorsements;
                $registration_type = $request->api_reg_type;
                $registration_status = $request->api_reg_status;
                $notations = $request->api_notations;
                $other_notation = "";
                $conditions = $request->api_conditions;
                $other_condition = "";
                $expiry_date = $request->api_expiry;
                $principal_place = $request->api_principal_practice;
                $api_other_practices = $request->api_other_practices;
            }else{
                $division = $request->division;
                $endorsements = $request->endorsements;
                $registration_type = $request->reg_registration_type;
                $registration_status = $request->reg_registration_status;
                $notation_toggle = isset($request->notation_toggle)?1:0;

                if($notation_toggle == 1){
                    $notations = json_encode($request->notations);
                    $other_notation = $request->other_notation;
                }else{
                    $notations = "";
                    $other_notation = "";
                }

                $condition_toggle = isset($request->condition_toggle)?1:0;

                if($notation_toggle == 1){
                    $conditions = json_encode($request->conditions);
                    $other_condition = $request->other_condition;
                }else{
                    $conditions = "";
                    $other_condition = "";
                }
                
                
                $expiry_date = $request->expiry_date;
                $principal_place = $request->principal_place;
                $other_places = json_encode($request->other_places);
            }
            
            $upload_graduation_evidence = "";
            $upload_overseas_evidence = "";
            $upload_not_reg_evidence = "";
            $graduate_ahpra_number = "";
            $graduate_division = "";
            $graduate_registration_type = "";
            $graduate_registration_status = "";
            $graduate_date = "";

            $overseas_qualified = "";
            $overseas_other_text = "";

            $not_registered = "";
            $education_related = "";
            $returning_practice = "";
            $personal_career = "";
            $not_registered_other = "";
            
        }

        if($ahpra_registration_status == "Graduate_RN" || $ahpra_registration_status == "Graduate_RM" || $ahpra_registration_status == "Student_Nurse" || $ahpra_registration_status == "Student_Midwife"){
            $ahpra_number = "";
            $ahpra_consent = "";
            $division = "";
            $endorsements = "";
            $registration_type = "";
            $registration_status = "";
            $notations = "";
            $other_notation = "";
            $conditions = "";
            $expiry_date = "";
            $principal_place = "";
            $other_places = "";
            $last_verified_date = "";
            $api_verify = "";
            $api_division = "";
            $api_endorsements = "";
            $api_reg_type = "";
            $api_reg_status = "";
            $api_notations = "";
            $api_conditions = "";
            $api_expiry = "";
            $api_principal_practice = "";
            $api_other_practices = "";
            
            $other_condition = "";

            
            $graduate_ahpra_number = $request->graduate_ahpra_number;
            $graduate_division = $request->graduate_division;
            $graduate_registration_type = $request->graduate_registration_type;
            $graduate_registration_status = $request->graduate_registration_status;
            if($ahpra_registration_status == "Graduate_RN" || $ahpra_registration_status == "Graduate_RM"){
                $graduate_date = "";
            }else{
                
                $graduate_date = $request->graduation_expected_date;
            }
            $upload_graduation_evidence = $request->upload_graduation_evidence;
            $upload_register_evidence = "";
            $upload_overseas_evidence = "";
            $upload_not_reg_evidence = "";

            $overseas_qualified = "";
            $overseas_other_text = "";
            
            $not_registered = "";
            $education_related = "";
            $returning_practice = "";
            $personal_career = "";
            $not_registered_other = "";

            
        }

        if($ahpra_registration_status == "Overseas"){
            $ahpra_number = "";
            $ahpra_consent = "";
            $division = "";
            $endorsements = "";
            $registration_type = "";
            $registration_status = "";
            $notations = "";
            $other_notation = "";
            $conditions = "";
            $expiry_date = "";
            $principal_place = "";
            $other_places = "";
            $last_verified_date = "";
            $api_verify = "";
            $api_division = "";
            $api_endorsements = "";
            $api_reg_type = "";
            $api_reg_status = "";
            $api_notations = "";
            $api_conditions = "";
            $api_expiry = "";
            $api_principal_practice = "";
            $api_other_practices = "";
            
            $other_condition = "";

            
            $graduate_ahpra_number = "";
            $graduate_division = "";
            $graduate_registration_type = "";
            $graduate_registration_status = "";
            $graduate_date = "";

            $overseas_qualified = json_encode($request->overseas_qualified);
            $overseas_other_text = $request->overseas_other_textreason;
            $upload_overseas_evidence = $request->upload_overseas_evidence;
            $upload_register_evidence = "";
            $upload_graduation_evidence = "";
            $upload_not_reg_evidence = "";

            $not_registered = "";
            $education_related = "";
            $returning_practice = "";
            $personal_career = "";
            $not_registered_other = "";

        }

        if($ahpra_registration_status == "Not_Registered"){
            $ahpra_number = "";
            $ahpra_consent = "";
            $division = "";
            $endorsements = "";
            $registration_type = "";
            $registration_status = "";
            $notations = "";
            $other_notation = "";
            $conditions = "";
            $expiry_date = "";
            $principal_place = "";
            $other_places = "";
            $last_verified_date = "";
            $api_verify = "";
            $api_division = "";
            $api_endorsements = "";
            $api_reg_type = "";
            $api_reg_status = "";
            $api_notations = "";
            $api_conditions = "";
            $api_expiry = "";
            $api_principal_practice = "";
            $api_other_practices = "";
            
            $other_condition = "";

            
            $graduate_ahpra_number = "";
            $graduate_division = "";
            $graduate_registration_type = "";
            $graduate_registration_status = "";
            $graduate_date = "";

            $overseas_qualified = "";
            $overseas_other_text = "";

            $not_registered = json_encode($request->not_registered);
            $education_related = json_encode($request->education_related);
            $returning_practice = json_encode($request->returning_practice);
            $personal_career = json_encode($request->personal_career);
            $not_registered_other = $request->not_registered_other;
            $upload_not_reg_evidence = $request->upload_not_reg_evidence;
            $upload_overseas_evidence = "";
            $upload_register_evidence = "";
            $upload_graduation_evidence = "";
        }

        $ndis_status = $request->ndis_status;
        $upload_ndis_evidence = $request->upload_ndis_evidence;
        

        if($ndis_status == "registered"){
            $ndis_number = $request->ndis_number;
        }

        if($ndis_status == "compliant"){
            $ndis_number = "";
        }

        if($ndis_status == "not_compliant"){
            $ndis_number = "";
        }

        $meadical_provider_toggle = isset($request->meadical_provider_toggle)?1:0;

        if($meadical_provider_toggle == 1){
            $medical_provider_no = $request->medical_provider_no;
            $medical_upload_evidence = $request->medical_upload_evidence;
        }else{
            $medical_provider_no = "";
            $medical_upload_evidence = "";
        }

        $toggleCheckbox_prescribe = isset($request->toggleCheckbox_prescribe)?1:0;

        if($toggleCheckbox_prescribe == 1){
            $pbs_type = $request->pbs_type;
            $pbs_other_nursing = $request->pbs_other_nursing;
            $prescribe_no = $request->prescribe_no;
            $prescribe_evidence = $request->prescribe_evidence;
        }else{
            $pbs_type = "";
            $pbs_other_nursing = "";
            $prescribe_no = "";
            $prescribe_evidence = "";
        }

        $toggleCheckbox_immunization = isset($request->toggleCheckbox_immunization)?1:0;

        if($toggleCheckbox_immunization == 1){
            $immunization_state = json_encode($request->immunization_state);
            $authorizing_body_program = json_encode($request->authorizing_body_program);
            $date_authorised = $request->date_authorised;
            $immuzination_evidence = $request->immuzination_evidence;
            
        }else{
            $immunization_state = "";
            $authorizing_body_program = "";
            $date_authorised = "";
            $immuzination_evidence = "";
            
        }

        $toggleCheckbox_radiation = isset($request->toggleCheckbox_radiation)?1:0;

        if($toggleCheckbox_radiation == 1){
            $radiation_licence_type = json_encode($request->radiation_licence_type);

            $radiation_licence_content = json_encode($request->radiation_licenses_data);
            
            $licenses_type_other = $request->licenses_type_other;
            $radiation_licenses_no = $request->radiation_licenses_no;
            $radiation_state_issue = json_encode($request->radiation_state_issue);
            $radiation_issue_date = $request->radiation_issue_date;
            $radiation_expiry_date = $request->radiation_expiry_date;
            $radiation_evidence = $request->radiation_evidence;
            //print_r($request->radiation_state_data);die;
            $radiation_state_data = json_encode($request->radiation_state_data);
            //print_r($radiation_state_data);
        }else{
            $radiation_licence_type = "";
            $radiation_licence_content = "";
            
        }

        
        $licenses_data = LicensesModel::where("user_id",$user_id)->first();
        //print_r($licenses_data);die;
        if(!empty($licenses_data)){
            
            //$licenses_register = LicensesModel::find($user_id);
            $run = LicensesModel::where('user_id',$user_id)->update([
                'ahpra_registration_status'=>$ahpra_registration_status,
                'aphra_verifying_checkbox'=>$ahpra_consent,
                'aphra_registration_no'=>$ahpra_number,
                'api_verify'=>$api_verify,
                'register_division'=>$division,
                'register_endorsements'=>$endorsements,
                'register_reg_type'=>$registration_type,
                'register_reg_status'=>$registration_status,
                'register_notations'=>$notations,
                'register_conditions'=>$conditions,
                'register_principal_place'=>$principal_place,
                // 'register_other_place'=>$other_places,
                'register_other_notation_reason'=>$other_notation,
                'register_other_condition_reason'=>$other_condition,
                'register_expiry'=>$expiry_date,
                'register_upload_evidence'=>$upload_register_evidence,
                'last_verified'=>$last_verified_date,
                'graduate_student_reg_no'=>$graduate_ahpra_number,
                'graduate_division'=>$graduate_division,
                'graduate_reg_type'=>$graduate_registration_type,
                'graduate_reg_status'=>$graduate_registration_status,
                'graduation_date'=>$graduate_date,
                'graduation_upload_evidence'=>$upload_graduation_evidence,
                'overseas_qualified_specify'=>$overseas_qualified,
                'other_overseas_qualified'=>$overseas_other_text,
                'overseas_upload_evidence'=>$upload_overseas_evidence,
                'not_currently_registered_reason'=>$not_registered,
                'education_related_reason'=>$education_related,
                'returning_practice'=>$returning_practice,
                'personal_career'=>$personal_career,
                'other_not_registered_reason'=>$not_registered_other,
                'not_registered_evidence_file'=>$upload_not_reg_evidence,
                'ndis_status'=>$ndis_status,
                'ndis_registration_no'=>$ndis_number,
                'ndis_registration_evidence'=>$upload_ndis_evidence,
                'medical_provider_no'=>$medical_provider_no,
                'medical_upload_evidence'=>$medical_upload_evidence,
                'pbs_type'=>$pbs_type,
                'pbs_other_nursing'=>$pbs_other_nursing,
                'prescribe_no'=>$prescribe_no,
                'prescribe_evidence'=>$prescribe_evidence,
                'immunization_state'=>$immunization_state,
                'authorizing_body_program'=>$authorizing_body_program,
                'date_authorised'=>$date_authorised,
                'immuzination_evidence'=>$immuzination_evidence,
                'radiation_licence_type'=>$radiation_licence_type,
                'licenses_type_other'=>$licenses_type_other,
                'radiation_licenses_no'=>$radiation_licence_content,
                'radiation_state_data'=>$radiation_state_data
            ]);
            

        }else{
            $user_stage = update_user_stage($user_id,"Registrations and Licences");
            $licenses_register = new LicensesModel();
            $licenses_register->user_id = $user_id;
            $licenses_register->ahpra_registration_status = $ahpra_registration_status;
            $licenses_register->aphra_verifying_checkbox = $ahpra_consent;
            $licenses_register->aphra_registration_no = $ahpra_number;
            $licenses_register->api_verify = $api_verify;
            $licenses_register->register_division = $division;
            $licenses_register->register_endorsements = $endorsements;
            $licenses_register->register_reg_type = $registration_type;
            $licenses_register->register_reg_status = $registration_status;
            $licenses_register->register_notations = $notations;
            $licenses_register->register_conditions = $conditions;
            $licenses_register->register_principal_place = $principal_place;
            //$licenses_register->register_other_place = $other_places;
            $licenses_register->register_other_notation_reason = $other_notation;
            $licenses_register->register_other_condition_reason = $other_condition;
            $licenses_register->register_expiry = $expiry_date;
            $licenses_register->register_upload_evidence = $upload_register_evidence;
            $licenses_register->last_verified = $last_verified_date;
            $licenses_register->graduate_student_reg_no = $graduate_ahpra_number;
            $licenses_register->graduate_division = $graduate_division;
            $licenses_register->graduate_reg_type = $graduate_registration_type;
            $licenses_register->graduate_reg_status = $graduate_registration_status;
            $licenses_register->graduation_date = $graduate_date;
            $licenses_register->graduation_upload_evidence = $upload_graduation_evidence;
            $licenses_register->overseas_qualified_specify = $overseas_qualified;
            $licenses_register->other_overseas_qualified = $overseas_other_text;
            $licenses_register->overseas_upload_evidence = $upload_overseas_evidence;
            $licenses_register->not_currently_registered_reason = $not_registered;
            $licenses_register->education_related_reason = $education_related;
            $licenses_register->returning_practice = $returning_practice;
            $licenses_register->personal_career = $personal_career;
            $licenses_register->other_not_registered_reason = $not_registered_other;
            $licenses_register->not_registered_evidence_file = $upload_not_reg_evidence;
            $licenses_register->ndis_status = $ndis_status;
            $licenses_register->ndis_registration_no = $ndis_number;
            $licenses_register->ndis_registration_evidence = $upload_ndis_evidence;
            $licenses_register->medical_provider_no = $medical_provider_no;
            $licenses_register->medical_upload_evidence = $medical_upload_evidence;
            $licenses_register->pbs_type = $pbs_type;
            $licenses_register->pbs_other_nursing = $pbs_other_nursing;
            $licenses_register->prescribe_no = $prescribe_no;
            $licenses_register->prescribe_evidence = $prescribe_evidence;
            $licenses_register->immunization_state = $immunization_state;
            $licenses_register->authorizing_body_program = $authorizing_body_program;
            $licenses_register->date_authorised = $date_authorised;
            $licenses_register->immuzination_evidence = $immuzination_evidence;
            $licenses_register->radiation_licence_type = $radiation_licence_type;
            //$licenses_register->licenses_type_other = $licenses_type_other;
            $licenses_register->radiation_licenses_no = $radiation_licence_content;
            $licenses_register->radiation_state_data = $radiation_state_data;
            $run = $licenses_register->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);

        
    }

    public function uploadLicensesEvidenceImgs(Request $request){

        $img_field = $request->img_field;
        $evidence_name = $request->evidence_name;
        
        //print_r($files);die;
        $user_id = $request->user_id;

        

        $getLicensesdata = LicensesModel::where("user_id", $user_id)->first();
        
        //print_r($getLicensesdata);die;

        if(!empty($getLicensesdata)){
            $getLicensesdatas = $getLicensesdata->toArray();
        }else{
            $getLicensesdatas = "";
        }

        if(!empty($getLicensesdatas) && $getLicensesdatas[$evidence_name] != NULL){
            $ev_img = (array)json_decode($getLicensesdatas[$evidence_name]);
            
            if($evidence_name == "authorizing_body_program" || $evidence_name == "radiation_state_data"){
                $files = $request->file($evidence_name);
                
                //print_r($files);die;
                // $immunization_data = (array)json_decode($getLicensesdata->authorizing_body_program);
                $group_name_arr = explode("-",$img_field); 
                //print_r($group_name_arr);
                if (array_key_exists($group_name_arr[1], $ev_img)) {
                    
                    foreach($ev_img as $index=>$imdata){
                        //echo $index."=".$group_name_arr[1];
                        if($index == $group_name_arr[1]){
                            $ev_img_author = json_decode($imdata->evidence);
                            
                            $licensesimgs = Helpers::multipleFileUpload($files[$img_field], $ev_img_author);
                            $ev_img[$index]->evidence = $licensesimgs;
                            
                            $run = LicensesModel::where('user_id', $user_id)->update([$evidence_name => json_encode($ev_img)]);
                        }
                        
                        
                    }
                }else{
                    
                    $licensesimgs = Helpers::multipleFileUpload($files[$img_field], '');
                    // $ev_img[$group_name_arr[1]]->evidence = $licensesimgs;
                    // $run = LicensesModel::where('user_id', $user_id)->update([$evidence_name => json_encode($ev_img)]);
                }
                
            }else{
                $files = $request->file($evidence_name);
                $licensesimgs = Helpers::multipleFileUpload($files, $ev_img);
                $run = LicensesModel::where('user_id', $user_id)->update([$evidence_name => $licensesimgs]);
            }
            
        }else{
            $files = $request->file($evidence_name);

            if($evidence_name == "authorizing_body_program" || $evidence_name == "radiation_licenses_no"){
                $licensesimgs = Helpers::multipleFileUpload($files[$img_field], '');
                $run = LicensesModel::where('user_id', $user_id)->update([$evidence_name => $licensesimgs]);
            }else{
                $licensesimgs = Helpers::multipleFileUpload($files, '');
                $run = LicensesModel::where('user_id', $user_id)->update([$evidence_name => $licensesimgs]);
            }
            
            
        }

        

        //
        return $licensesimgs;
    }

    public function deleteLicensesEvidenceImg(Request $request)
    {
        $img_field = $request->img_field;
        $evidence_name = $request->evidence_name;
        $user_id = $request->user_id;
        
        $img = $request->img;

        $getLicensesdata = LicensesModel::where("user_id", $user_id)->first();

        if(!empty($getLicensesdata)){
            $getLicensesdatas = $getLicensesdata->toArray();
        }else{
            $getLicensesdatas = "";
        }

        if(!empty($getLicensesdatas) && $getLicensesdatas[$evidence_name] != NULL){
            $ev_img = (array)json_decode($getLicensesdatas[$evidence_name]);

            if($evidence_name == "authorizing_body_program" || $evidence_name == "radiation_state_data"){
                $group_name_arr = explode("-",$img_field); 
                foreach($ev_img as $index=>$imdata){
                    
                    if($index == $group_name_arr[1]){
                        $ev_img_author = json_decode($imdata->evidence);

                        $img_index = array_search($img, $ev_img_author);

                        array_splice($ev_img_author, $img_index, 1);
                        //print_r($ev_img_author);
                        
                        $ev_img[$index]->evidence = json_encode($ev_img_author);
                        
                        //print_r(json_encode($ev_img));
                        $deleteData = LicensesModel::where('user_id', $user_id)->update([$evidence_name => json_encode($ev_img)]);
                    }else{
                        $deleteData = 1;
                    }
                    
                    
                }
            }else{
                $img_index = array_search($img, $ev_img);

                array_splice($ev_img, $img_index, 1);

                $deleteData = LicensesModel::where('user_id', $user_id)->update([$evidence_name => json_encode($ev_img)]);
            
                
            }

            $destinationPath = public_path() . '/uploads/education_degree/' . $img;

            if (File::exists($destinationPath)) {
                File::delete($destinationPath);
            }
        }else{
            $deleteData = 1;
        }

        if ($deleteData) {
            return 1;
        }

    }

    public function mandatory_training_edit(Request $request)
    {
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $user_id = $request->id;
        
        $data['trainingData'] = DB::table("mandatory_training")->where("user_id", $user_id)->first();
        return view('admin.mandatory_training')->with($data);
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

    public function getMandatoryCoursesName(Request $request){
        $courses_id = $request->courses_id;
        $courses_name = DB::table("man_training_category")->where("id",$courses_id)->first();
        $data['courses_name'] = $courses_name->name;
        $data['courses_id'] = $courses_id;
        //print_r($getCourses);
        return json_encode($data);
    }    

    public function updateMandatoryTraining(Request $request){
        $well_institution = json_encode($request->well_institution);
        $core_man_institution = json_encode($request->core_man_institution);
        //print_r($request->core_man_institution);die;
        $training_name = $request->training;
        $training_ins = $request->institution;
        $training_start_date = $request->tra_start_date;
        $training_end_date = $request->tra_end_date;
        $tra_exp = $request->tra_expiry;
        $declare_information_man = $request->declare_information_man;

        //print_r($well_institution);die;
        $other_tra_array = array();
        if (!empty($training_name)) {
            for ($i = 0; $i < count($training_name); $i++) {

                $other_tra_array[] = array("other_tra_id" => $i + 1, "training_name" => $training_name[$i], "training_ins" => $training_ins[$i], "training_start_date" => $training_start_date[$i], "training_end_date" => $training_end_date[$i], "tra_exp" => $tra_exp[$i]);
            }

            $other_tra_json = json_encode($other_tra_array);
        } else {
            $other_tra_json = '';
        }

        $education_name = $request->education;
        $education_ins = $request->institution;
        $education_start_date = $request->start_date;
        $education_end_date = $request->end_date;
        $education_exp = $request->edu_expiry;
        $education_status = $request->edu_expiry;

        $other_edu_array = array();
        if (!empty($education_name)) {
            for ($i = 0; $i < count($education_name); $i++) {
                $other_edu_array[] = array("other_edu_id" => $i + 1, "education_name" => $education_name[$i], "education_ins" => $education_ins[$i], "education_start_date" => $education_start_date[$i], "education_end_date" => $education_end_date[$i], "education_exp" => $education_exp[$i], "education_status" => $education_status[$i]);
            }

            $other_edu_json = json_encode($other_edu_array);
        } else {
            $other_edu_json = '';
        }

        $user_id = $request->user_id;

        $gettrainingdata = DB::table("mandatory_training")->where("user_id", $user_id)->first();

        if (!empty($gettrainingdata) > 0) {
            $run = MandatoryTrainModel::where('user_id', $user_id)->update(["training_data"=>$well_institution,"education_data"=>$core_man_institution,"other_tra_data"=>$other_tra_json,"other_edu_data"=>$other_edu_json,"declaration_status"=>$declare_information_man]);
        }else{
            $post = new MandatoryTrainModel();
            $post->user_id = $user_id;
            $post->training_data   = $well_institution;
            $post->education_data   = $core_man_institution;
            $post->other_tra_data   = $other_tra_json;
            $post->other_edu_data   = $other_edu_json;
            $post->declaration_status   = $declare_information_man;
            $run = $post->save();
        }

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/mandatory_training');
            $json['message'] = 'Education Information Updated Successfully';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }

        echo json_encode($json);
    }

    public function uploadTrainingEvidenceImgs(Request $request)
    {
        $img_field = $request->img_field;
        $files = $request->file($img_field);
        $lang_id = $request->lang_id;
        $language_id = $request->language_id;
        $user_id = $request->user_id;

        $getLangdata = MandatoryTrainModel::where("user_id", $user_id)->first();

        if(!empty($getLangdata)){
            if($img_field == "well_sel_data"){
                $langprocert = $getLangdata->well_sel_data;
                $getLangImgs = (array)json_decode($langprocert);
            }

            

            if($img_field == "core_man_data"){
                $langprocert = $getLangdata->other_prof_cert;
                $getLangImgs = (array)json_decode($langprocert);
            }

            // if($img_field == "specialized_lang_skills"){
            //     $langprocert = $getLangdata->specialized_lang_skills;
            //     $getLangImgs = (array)json_decode($langprocert);
            // }
        }else{
            $langprocert = '';
            $getLangImgs = array();
        }

        // echo $lang_id;
        // echo $language_id;die;
        
        if(isset($getLangImgs[$lang_id])){
            $langid_arr = (array)$getLangImgs[$lang_id];
            if(isset($langid_arr[$language_id])){
                $getLangImg = $langid_arr[$language_id];
            }
            
        }else{
            $getLangImg = array();
        }
        
        //print_r($getLangImg);die;

        if (!empty($getLangdata) && $langprocert != NULL && isset($getLangImg->evidence_imgs)) {
            $langimg = (array)json_decode($getLangImg->evidence_imgs);
            //print_r($langimg);
            $langimgs = Helpers::multipleFileUpload($files[$language_id], $langimg);
        }else{
            $langimgs = Helpers::multipleFileUpload($files[$language_id], '');
            //$img_arr = json_decode($langimgs);
        }

        if(isset($getLangImgs[$lang_id])){
            $langid_arr = (array)$getLangImgs[$lang_id];
            if(isset($langid_arr[$language_id])){
                $getLangImg->evidence_imgs = $langimgs;
            }
            
        }
        
        //print_r($getLangImgs);die;

        $run = MandatoryTrainModel::where('user_id', $user_id)->update([$img_field => json_encode($getLangImgs)]);
        return $langimgs;
    }

    public function deleteTrainingEvidenceImg(Request $request)
    {
        $img_field = $request->img_field;
        $user_id = $request->user_id;
        $lang_id = $request->lang_id;
        $language_id = $request->language_id;
        $img = $request->img;

        $getLangdata = MandatoryTrainModel::where("user_id", $user_id)->first();
        if($img_field == "well_sel_data"){
            $langprocert = $getLangdata->training_data;
            $getLangImgs = (array)json_decode($langprocert);
        }

        if($img_field == "core_man_data"){
            $langprocert = $getLangdata->other_prof_cert;
            $getLangImgs = (array)json_decode($langprocert);
        }

        $langid_arr = (array)$getLangImgs[$lang_id];
        $getLangImg = $langid_arr[$language_id];
        //print_r($getLangImg->score_level);

        if (!empty($getLangdata) && $langprocert != NULL && isset($getLangImg->evidence_imgs)) {
            $getEvidenceimg = (array)json_decode($getLangImg->evidence_imgs);

            $img_index = array_search($img, $getEvidenceimg);

            array_splice($getEvidenceimg, $img_index, 1);

            
            if (!empty($getEvidenceimg)) {
                $EvidenceimgData = $getEvidenceimg;
            } else {
                $EvidenceimgData = array();
            }

            //print_r($EvidenceimgData);
            // $getEvidenceimg = $EvidenceimgData;
            $getLangImg->evidence_imgs = json_encode($EvidenceimgData);
           
            $deleteData = MandatoryTrainModel::where('user_id', $user_id)->update([$img_field => json_encode($getLangImgs)]);

            $destinationPath = public_path() . '/uploads/education_degree/' . $img;

            if (File::exists($destinationPath)) {
                File::delete($destinationPath);
            }

        }else{
            $deleteData = 1;
        }

        if ($deleteData) {
            return 1;
        }
    }

}