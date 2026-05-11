<?php

namespace App\Http\Controllers\nurse;

use App\Models\CountryModel;
use App\Models\User;
use App\Models\ProfessionModel;
use App\Models\EligibilityToWorkModel;
use App\Models\WorkingChildrenCheckModel;
use App\Models\PoliceCheckModel;
use App\Models\OtherVaccineModel;
use App\Models\EvidanceFileModel;
use App\Models\NdisWorker;
use App\Models\SpecializedClearance;


use App\Http\Requests\AddnewsletterRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



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

use App\Models\InterviewModel;
use App\Models\PreferencesModel;
use App\Models\WorkPreferencesModel;
use App\Models\VaccinationFrontModel;
use App\Models\AdditionalInfo;
use App\Models\ProfessionalAssocialtionModel;
use App\Models\SubClassModel;
use App\Models\WorkEvidenceModel;
use App\Repository\Eloquent\SpecialityRepository;


class ProfessionalController extends Controller
{

    protected $specialityServices;
    protected $specialityRepository;
    protected $authServices;

    public function __construct(SpecialityServices $specialityServices, SpecialityRepository $specialityRepository, AuthServices $authServices)
    {
        $this->specialityServices = $specialityServices;
        $this->specialityRepository = $specialityRepository;
        $this->authServices = $authServices;
    }
    public function workClearances()
    {
        //This function is for load the view for work clearance
        $user_id=Auth::guard('nurse_middle')->user()->id;
        $visaSubclasses = SubClassModel::where('residence_id', 2) 
                                    ->orderBy('id') 
                                    ->get()
                                    ->groupBy('subclass_head'); 
        $visaholderSubclasses = SubClassModel::where('residence_id', 3) 
                                    ->orderBy('id') 
                                    ->get();

        $work_eligibility   = EligibilityToWorkModel::where('user_id', $user_id)->first();   
        if(!empty($work_eligibility)){
            $work_evidence   = WorkEvidenceModel::where('type_id', $work_eligibility->id)->where('evidance_type', "1")->get();
        }else{
            $work_evidence   = array();
        }  
        //print_r($work_evidence);die;
        // echo "<pre>";        
        // print_r($work_evidence);  die;         
        $ndis               = NdisWorker::where('user_id', $user_id)->first();              
        
        if(!empty($ndis)){
            $work_evidence_ndis   = WorkEvidenceModel::where('type_id', $ndis->id)->where('evidance_type', "2")->get();  
        }else{
            $work_evidence_ndis   = array();
        }   
        $ww_child           = WorkingChildrenCheckModel::where('user_id', $user_id)->get();
        $policy_check       = PoliceCheckModel::where('user_id', $user_id)->first();
        
        if(!empty($policy_check)){
            $work_evidence_police   = WorkEvidenceModel::where('type_id', $policy_check->id)->where('evidance_type', "4")->get(); 
        }else{
            $work_evidence_police   = array();
        }   
        $specialize         = SpecializedClearance::where('user_id', $user_id)->get();
        

        return view('nurse.work_clearances',compact('visaSubclasses','visaholderSubclasses','work_eligibility','work_evidence','ndis','work_evidence_ndis','ww_child','policy_check','work_evidence_police','specialize'));
    }
    public function update_eligibility_to_work(Request $request)
    {
        //This function is for update the eligibility to work for nurse
        $lastRecord = EligibilityToWorkModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        // if($lastRecord)
        // {
        //     $professioninsert['original_file_name'] = $lastRecord['original_file_name'];
        //     $professioninsert['support_document']=$lastRecord['support_document'];

        //     $lastRecord->delete();
        // }
        
        $professioninsert['user_id'] =  Auth::guard('nurse_middle')->user()->id;
        $professioninsert['residency'] = $request->residency;

        if($request->residency == "Australian Citizen" && $request->evidence_type!='')
        {
            $professioninsert['evidence_type'] = $request->evidence_type;
        }
        if($request->residency == "Permanent Resident" && $request->evidence_type1!='')
        {
            $professioninsert['evidence_type'] = $request->evidence_type1;
        }
        if($request->residency == "Visa Holder" && $request->evidence_type2!='')
        {
            $professioninsert['evidence_type'] = $request->evidence_type2;
        }

        if($request->passport_number!='')
        {
            $professioninsert['passport_number'] = $request->passport_number;
        }
        if($request->passport_number1!='')
        {
            $professioninsert['passport_number'] = $request->passport_number1;
        }
        
        if($request->country_id!='')
        {
            $professioninsert['country_id']=$request->country_id;
        }
        if($request->country_id1!='')
        {
            $professioninsert['country_id']=$request->country_id1;
        }
        
        if($request->visa_subclass!='')
        {
            $professioninsert['visa_subclass']=$request->visa_subclass;
        }
        if($request->visa_subclass1!='')
        {
            $professioninsert['visa_subclass']=$request->visa_subclass1;
            if($request->visa_subclass1==40)
            {
                $professioninsert['other_visa_type']=$request->other_visa_type??'';
            }
        }
        
        if($request->visa_grant_number!='')
        {
            $professioninsert['visa_grant_number'] = $request->visa_grant_number;
        }
        if($request->visa_grant_number1!='')
        {
            $professioninsert['visa_grant_number'] = $request->visa_grant_number1;
        }
        
        
        $professioninsert['status'] = '0';
        $professioninsert['created_at'] = Carbon::now('Asia/Kolkata');
        $evidence_files = $request->file('upload_evidence0', []);
        $evidence_files1 = $request->file('upload_evidence1', []);
        $evidence_files2 = $request->file('upload_evidence2', []);

        //echo "<pre>";print_r($professioninsert);die();
        // print_r($lastRecord);
        // echo $request->residency."=>".$lastRecord->residency;
        
        if(!empty($lastRecord) && $request->residency == $lastRecord->residency){
            $work_model = EligibilityToWorkModel::find($lastRecord->id);
            $run = $work_model->update($professioninsert);
            $type_id = $lastRecord->id;
        }else{
            if(!empty($lastRecord)){
                $deleteImgData = WorkEvidenceModel::where("type_id",$lastRecord->id)->delete();
                $lastRecord->delete();
            }
            
            
            $run = EligibilityToWorkModel::insertGetId($professioninsert);
            $user_stage = update_user_stage(Auth::guard('nurse_middle')->user()->id,"Checks and Clearances(Residency and Work Eligibility)");
            $type_id = $run;
        }

        
        if (isset($evidence_files) && is_array($evidence_files)) {
                        
            foreach ($evidence_files as $file) {
                if ($file->isValid()) {
                    $filename = 'evidence_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $originalName = $file->getClientOriginalName();
                    $destinationPath = public_path('/uploads/evidence');
                    $file->move($destinationPath, $filename);
                    

                    $work                   = new WorkEvidenceModel();
                    $work->type_id     = $type_id;
                    $work->original_name    = $originalName;
                    $work->evidence_file    = $filename;
                    $work->evidance_type    = "1";
                    $work->created_at       = date('Y-m-d H:i:s');
                    $work->save();
                }
            }
        }

        if (isset($evidence_files1) && is_array($evidence_files1)) {
                        
            foreach ($evidence_files1 as $file) {
                if ($file->isValid()) {
                    $filename = 'evidence_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $originalName = $file->getClientOriginalName();
                    $destinationPath = public_path('/uploads/evidence');
                    $file->move($destinationPath, $filename);
                    

                    $work                   = new WorkEvidenceModel();
                    $work->type_id     = $type_id;
                    $work->original_name    = $originalName;
                    $work->evidence_file    = $filename;
                    $work->evidance_type    = "1";
                    $work->created_at       = date('Y-m-d H:i:s');
                    $work->save();
                }
            }
        }

        if (isset($evidence_files2) && is_array($evidence_files2)) {
                        
            foreach ($evidence_files2 as $file) {
                if ($file->isValid()) {
                    $filename = 'evidence_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $originalName = $file->getClientOriginalName();
                    $destinationPath = public_path('/uploads/evidence');
                    $file->move($destinationPath, $filename);
                    

                    $work                   = new WorkEvidenceModel();
                    $work->type_id     = $type_id;
                    $work->original_name    = $originalName;
                    $work->evidence_file    = $filename;
                    $work->evidance_type    = "1";
                    $work->created_at       = date('Y-m-d H:i:s');
                    $work->save();
                }
            }
        }

        
        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/workClearances') . "?page=work_clearances";
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }

        echo json_encode($json);
    }
    public function updateNdis(Request $request)
    {
        //This function is for update the ndis record
       $ndis['state_id']= $request->ndis_state;
       $ndis['clearance_number']= $request->ndis_worker_clearance_number;
       $ndis['expiry_date']= $request->ndis_expiry_date;
       $evidence_files = $request->file('ndis_evidence', []);
       
       
        
        $lastRecord = NdisWorker::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if($lastRecord)
        {
            $run=$lastRecord->update($ndis);
            $type_id = $lastRecord->id;
        }
        else
        {
            $ndis['created_at']= now();
            $ndis['user_id'] = Auth::guard('nurse_middle')->user()->id; 
            $run= NdisWorker::insertGetId($ndis);
            //$user_stage = update_user_stage(Auth::guard('nurse_middle')->user()->id,"Checks and Clearances(NDIS Worker Screening Check)");
            $type_id = $run;
        }

        if (isset($evidence_files) && is_array($evidence_files)) {
                        
            foreach ($evidence_files as $file) {
                if ($file->isValid()) {
                    $filename = 'evidence_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $originalName = $file->getClientOriginalName();
                    $destinationPath = public_path('/uploads/evidence');
                    $file->move($destinationPath, $filename);
                    

                    $work                   = new WorkEvidenceModel();
                    $work->type_id     = $type_id;
                    $work->original_name    = $originalName;
                    $work->evidence_file    = $filename;
                    $work->evidance_type    = "2";
                    $work->created_at       = date('Y-m-d H:i:s');
                    $work->save();
                }
            }
        }

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/workClearances') . "?page=work_clearances";
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }
        echo json_encode($json);
    }    
    public function update_children_to_work(Request $request)
    {
        //This function is for add / update wwcc


        $user_id =  Auth::guard('nurse_middle')->user()->id;
        
        $wwcc_state         = $request->input('wwcc_state', []);
        $clearance_number   = $request->input('wwcc_clearance_number', []);
        $wwcc_expiry_date   = $request->input('wwcc_expiry_date', []);
        $wwcc_evidence      = $request->file('wwcc_evidence', []);
        $wwcc_id            = $request->input('wwcc_id', []);
        $evidence_files = $request->file('wwcc_evidence', []);
        
        for ($i = 0; $i < count($wwcc_state); $i++) {
            if (isset($wwcc_id[$i])) 
            {
                $wwcc = WorkingChildrenCheckModel::find($wwcc_id[$i]);
                if ($wwcc) {
                    $wwcc->state_id         = $wwcc_state[$i];
                    $wwcc->clearance_number = $clearance_number[$i];
                    $wwcc->expiry_date      = $wwcc_expiry_date[$i];


                    $run= $wwcc->save();
                    $type_id = $wwcc->id;

                    if (isset($evidence_files[$i]) && is_array($evidence_files[$i])) {
                        
                        foreach ($evidence_files[$i] as $file) {
                            if ($file->isValid()) {
                                $filename = 'evidence_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                                $originalName = $file->getClientOriginalName();
                                $destinationPath = public_path('/uploads/evidence');
                                $file->move($destinationPath, $filename);
                                
            
                                $work                   = new WorkEvidenceModel();
                                $work->type_id     = $type_id;
                                $work->original_name    = $originalName;
                                $work->evidence_file    = $filename;
                                $work->evidance_type    = "3";
                                $work->created_at       = date('Y-m-d H:i:s');
                                $work->save();
                            }
                        }
                    }
                }
            }
            else
            {
                
                $wwcc = new WorkingChildrenCheckModel();
                $wwcc->user_id          = $user_id;
                $wwcc->state_id         = $wwcc_state[$i];
                $wwcc->clearance_number = $clearance_number[$i];
                $wwcc->expiry_date      = $wwcc_expiry_date[$i];

                $wwcc->status = 1;
                $wwcc->created_at = Carbon::now('Asia/Kolkata');
                $run =$wwcc->save();

                $type_id = $wwcc->id;
                //$user_stage = update_user_stage(Auth::guard('nurse_middle')->user()->id,"Checks and Clearances(Working With Children Check (WWCC))");
                if (isset($evidence_files[$i]) && is_array($evidence_files[$i])) {
                    
                    foreach ($evidence_files[$i] as $file) {
                        if ($file->isValid()) {
                            $filename = 'evidence_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                            $originalName = $file->getClientOriginalName();
                            $destinationPath = public_path('/uploads/evidence');
                            $file->move($destinationPath, $filename);
                            
        
                            $work                   = new WorkEvidenceModel();
                            $work->type_id     = $type_id;
                            $work->original_name    = $originalName;
                            $work->evidence_file    = $filename;
                            $work->evidance_type    = "3";
                            $work->created_at       = date('Y-m-d H:i:s');
                            $work->save();
                        }
                    }
                }
                
            }
        }
        
        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/workClearances') . "?page=work_clearances";
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }

        echo json_encode($json);
    }    public function removeWwcc(Request $request)
    {
        //This function is for ajax for remove wwcc from db
        $id = $request->id;

        $wwcc = WorkingChildrenCheckModel::find($id);

        if ($wwcc) {
            $filePath = 'uploads/support_document/' . $wwcc->wwcc_evidence;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
            $wwcc->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'wwcc not found']);
    }

    public function update_police_check_to_work(Request $request)
    {
        $policy['issuance_date'] = $request->issuance_date;
        $policy['is_declare'] = $request->is_declare=='on'?1:0;
        $evidence_files = $request->file('clearance_document', []);
        
        
        
        $lastRecord = PoliceCheckModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if($lastRecord)
        {
            $run=$lastRecord->update($policy);

            if (isset($evidence_files) && is_array($evidence_files)) {
                        
                foreach ($evidence_files as $file) {
                    if ($file->isValid()) {
                        $filename = 'evidence_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $originalName = $file->getClientOriginalName();
                        $destinationPath = public_path('/uploads/evidence');
                        $file->move($destinationPath, $filename);
                        
    
                        $work                   = new WorkEvidenceModel();
                        $work->type_id     = $lastRecord->id;
                        $work->original_name    = $originalName;
                        $work->evidence_file    = $filename;
                        $work->evidance_type    = "4";
                        $work->created_at       = date('Y-m-d H:i:s');
                        $work->save();
                    }
                }
            }
        }
        else
        {
            $policy['created_at']= Carbon::now('Asia/Kolkata');
            $policy['user_id'] = Auth::guard('nurse_middle')->user()->id; 
            $policy['status'] = '0';
            $run= PoliceCheckModel::insertGetId($policy);

            //$user_stage = update_user_stage(Auth::guard('nurse_middle')->user()->id,"Checks and Clearances(Police Clearance)");
            if (isset($evidence_files) && is_array($evidence_files)) {
                        
                foreach ($evidence_files as $file) {
                    if ($file->isValid()) {
                        $filename = 'evidence_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $originalName = $file->getClientOriginalName();
                        $destinationPath = public_path('/uploads/evidence');
                        $file->move($destinationPath, $filename);
                        
    
                        $work                   = new WorkEvidenceModel();
                        $work->type_id     = $run;
                        $work->original_name    = $originalName;
                        $work->evidence_file    = $filename;
                        $work->evidance_type    = "4";
                        $work->created_at       = date('Y-m-d H:i:s');
                        $work->save();
                    }
                }
            }
        }

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/workClearances') . "?page=work_clearances";
            // $json['url'] = url('nurse/my-profile#tab-myclearance-jobs');
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }

        echo json_encode($json);
    }
    public function updateSpecializedClearance(Request $request)
    {
        //This function is for update the specialized clearance

        $user_id =  Auth::guard('nurse_middle')->user()->id;
        
        $clearance_state        = $request->input('clearance_state', []);
        $clearance_type         = $request->input('clearance_type', []);
        $clearance_number       = $request->input('clearance_number', []);
        $clearance_expiry_date  = $request->input('clearance_expiry_date',[]);
        $clearance_evidence     = $request->file('clearance_evidence', []);
        $s_clearance_id         = $request->input('s_clearance_id', []);
        $evidence_files = $request->file('clearance_evidence', []);

        for ($i = 0; $i < count($clearance_state); $i++) {

            if (isset($s_clearance_id[$i])) 
            {
                $specialized = SpecializedClearance::find($s_clearance_id[$i]);
                if ($specialized) {
                    $specialized->clearance_state       = $clearance_state[$i];
                    $specialized->clearance_type        = $clearance_type[$i];
                    $specialized->clearance_number      = $clearance_number[$i];
                    $specialized->clearance_expiry_date = $clearance_expiry_date[$i];

                    $run= $specialized->save();
                    $lastId = $specialized->id;

                    if (isset($evidence_files[$i]) && is_array($evidence_files[$i])) {
                            
                        foreach ($evidence_files[$i] as $file) {
                            if ($file->isValid()) {
                                $filename = 'evidence_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                                $originalName = $file->getClientOriginalName();
                                $destinationPath = public_path('/uploads/evidence');
                                $file->move($destinationPath, $filename);
                                
            
                                $work                   = new WorkEvidenceModel();
                                $work->type_id     = $lastId;
                                $work->original_name    = $originalName;
                                $work->evidence_file    = $filename;
                                $work->evidance_type    = "5";
                                $work->created_at       = date('Y-m-d H:i:s');
                                $work->save();
                            }
                        }
                    }
                }
            }
            else
            {
                
                $specialized    = new SpecializedClearance();
                $specialized->user_id               = $user_id;
                $specialized->clearance_state       = $clearance_state[$i];
                $specialized->clearance_type        = $clearance_type[$i];
                $specialized->clearance_number      = $clearance_number[$i];
                $specialized->clearance_expiry_date = $clearance_expiry_date[$i];


                
                
                $specialized->created_at = Carbon::now('Asia/Kolkata');
                $run =$specialized->save();
                $lastId = $specialized->id;
                //$user_stage = update_user_stage(Auth::guard('nurse_middle')->user()->id,"Checks and Clearances(Specialized Clearances)");
                
                if (isset($evidence_files[$i]) && is_array($evidence_files[$i])) {
                        
                    foreach ($evidence_files[$i] as $file) {
                        if ($file->isValid()) {
                            $filename = 'evidence_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                            $originalName = $file->getClientOriginalName();
                            $destinationPath = public_path('/uploads/evidence');
                            $file->move($destinationPath, $filename);
                            
        
                            $work                   = new WorkEvidenceModel();
                            $work->type_id     = $lastId;
                            $work->original_name    = $originalName;
                            $work->evidence_file    = $filename;
                            $work->evidance_type    = "5";
                            $work->created_at       = date('Y-m-d H:i:s');
                            $work->save();
                        }
                    }
                }
                
            }
        }
        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/workClearances') . "?page=work_clearances";
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }

        echo json_encode($json);
   }
   public function removeSpecialized(Request $request)
   {
       $id = $request->id;

       $specialed = SpecializedClearance::find($id);

       if ($specialed) {
           $filePath = 'uploads/support_document/' . $specialed->clearance_evidence;
           if (Storage::exists($filePath)) {
               Storage::delete($filePath);
           }
           $specialed->delete();
           return response()->json(['success' => true]);
       }
       return response()->json(['success' => false, 'message' => 'Specialized Clearance not found']);
   }

    public function removeEligibilityFile(Request $request)
    {
        $img_id = $request->id;
        $work = WorkEvidenceModel::where('id', $img_id)->first();
        if ($work) {
            $filePath = 'uploads/support_document/' . $work->evidence_file;
      
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        
            

            $deleteImgData = WorkEvidenceModel::where("id",$img_id)->where("evidance_type","1")->delete();

            return response()->json(['success' => true, 'message' => 'File removed successfully']);
        }
        return response()->json(['success' => false, 'message' => 'File not found']);
    }

    public function removendisFile(Request $request)
    {
        $img_id = $request->id;
        $work = WorkEvidenceModel::where('id', $img_id)->first();
        if ($work) {
            $filePath = 'uploads/support_document/' . $work->evidence_file;
      
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        
            $deleteImgData = WorkEvidenceModel::where("id",$img_id)->where("evidance_type","2")->delete();

            return response()->json(['success' => true, 'message' => 'File removed successfully']);
        }
        return response()->json(['success' => false, 'message' => 'File not found']);
    }

    public function removewwccFile(Request $request)
    {
        $img_id = $request->id;
        $work = WorkEvidenceModel::where('id', $img_id)->first();

        if ($work) {
            $filePath = 'uploads/support_document/' . $work->wwcc_evidence;
      
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        
            $deleteImgData = WorkEvidenceModel::where("id",$img_id)->where("evidance_type","3")->delete();

            return response()->json(['success' => true, 'message' => 'File removed successfully']);
        }
        return response()->json(['success' => false, 'message' => 'File not found']);
    }

    public function removePolicyFile(Request $request)
    {
        $img_id = $request->id;
        $work = WorkEvidenceModel::where('id', $img_id)->first();
        if ($work) {
            $filePath = 'uploads/support_document/' . $work->evidence_file;
      
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        
            $deleteImgData = WorkEvidenceModel::where("id",$img_id)->where("evidance_type","4")->delete();

            return response()->json(['success' => true, 'message' => 'File removed successfully']);
        }
        return response()->json(['success' => false, 'message' => 'File not found']);
    }

    public function removeSpecializedFile(Request $request)
    {
        $img_id = $request->id;
        $work = WorkEvidenceModel::where('id', $img_id)->first();
        if ($work) {
            $filePath = 'uploads/support_document/' . $work->clearance_evidence;
      
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        
            $deleteImgData = WorkEvidenceModel::where("id",$img_id)->where("evidance_type","5")->delete();

            return response()->json(['success' => true, 'message' => 'File removed successfully']);
        }
        return response()->json(['success' => false, 'message' => 'File not found']);
    }
    
    public function professionalMembership()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['organization_country'] = DB::table("professional_organization")->where("country_organiztions","0")->orderBy('organization_country', 'ASC')->get();
        $data['awards_recognitions'] = DB::table("awards_recognitions")->where("sub_award_id","0")->orderBy('award_name', 'ASC')->get();
        
        $data['professional_membership'] = DB::table("professional_membership")->where("user_id",$user_id)->first();
        
        return view('nurse.professional_membership')->with($data);
    }

    public function getCountryOrgnizations(Request $request)
    {
        
        $organization_id = $request->organization_id;
        $data['country_organiztions'] = DB::table("professional_organization")->where("country_organiztions",$organization_id)->where("sub_organiztions","0")->orderBy('organization_country', 'ASC')->get();
        $country_name = DB::table("professional_organization")->where("organization_id",$organization_id)->first();
        //print_r(json_encode($data));
        $data['country_name'] = $country_name->organization_name;
        $data['organization_id'] = $organization_id;
        return json_encode($data);
    }

    public function getCountrySubOrgnizations(Request $request)
    {
        
        $organization_id = $request->organization_id;
        $country_org_id = $request->country_org_id;
        $data['country_organiztions'] = DB::table("professional_organization")->where("country_organiztions",$country_org_id)->where("sub_organiztions",$organization_id)->orderBy('organization_country', 'ASC')->get();
        $country_name = DB::table("professional_organization")->where("organization_id",$organization_id)->first();
        //print_r(json_encode($data));
        $data['country_name'] = $country_name->organization_country;
        $data['organization_id'] = $organization_id;
        return json_encode($data);
    }

    public function getMembershipData(Request $request)
    {
        $organization_id = $request->organization_id;
        $data['membership_type'] = DB::table("membership_type")->where("submember_id","0")->orderBy('membership_name', 'ASC')->get();
        $data['award_recognitions'] = DB::table("awards_recognitions")->where("sub_award_id","0")->orderBy('award_name', 'ASC')->get();
        $organization_name = DB::table("professional_organization")->where("organization_id",$organization_id)->first();
        $data['organization_id'] = $organization_id;
        $data['organization_name'] = $organization_name->organization_country;
        return json_encode($data);
    }

    public function getsubMembershipData(Request $request)
    {
        $organization_id = $request->organization_id;
        $data['membership_type'] = DB::table("membership_type")->where("submember_id",$organization_id)->orderBy('membership_name', 'ASC')->get();
        $organization_name = DB::table("membership_type")->where("membership_id",$organization_id)->first();
        $data['organization_id'] = $organization_id;
        $data['organization_name'] = $organization_name->membership_name;
        return json_encode($data);
    }

    public function getawardsRecognitions(Request $request)
    {
        $award_id = $request->award_id;
        $data['award'] = DB::table("awards_recognitions")->where("sub_award_id",$award_id)->orderBy('award_name', 'ASC')->get();
        $organization_name = DB::table("awards_recognitions")->where("award_id",$award_id)->first();
        $data['organization_id'] = $award_id;
        $data['award_name'] = $organization_name->award_name;
        return json_encode($data);
    }

    public function updateProfessionalMembership(Request $request)
    {
        $user_id = $request->user_id;
        
        $organization_country = $request->organization_country;
        $country_organization = $request->country_organization;
        $subcountry_organization = $request->subcountry_organization;
        $membership_type = $request->membership_type;
        $submembership_type = json_encode($request->submembership_type);
        $des_profession_association = json_encode($request->des_profession_association);
        $date_joined = json_encode($request->date_joined);
        $membership_status = json_encode($request->prof_membership_status);
        $awards_recognitions = $request->awards_recognitions;
        $award_organization = $request->award_organization;
        $membership_evidence = $request->file('membership_evidence');
        $declaration_status = $request->professional_declare_information;
        $profmemaward = $request->profmemaward;
        $award_question = $request->award_question;
        $inst_org = json_encode($request->inst_org);
        $award_evidence = $request->file('award_evidence');

        //print_r($subcountry_organization);die;

        $professional_membership_data = DB::table("professional_membership")->where("user_id",$user_id)->first();
        $awards_data = DB::table("awards_recognition_submission")->where("user_id",$user_id)->get();
        //print_r($award_evidence);die;
        

        if(!empty($professional_membership_data)){

            $award_evidence_imgs = (array)json_decode($professional_membership_data->award_evidence_imgs);
            $mem_evidence_imgs = (array)json_decode($professional_membership_data->evidence_imgs);

            $subc_org = array();

            if(!empty($subcountry_organization)){
                foreach($subcountry_organization as $s_org){
                    foreach($s_org as $s_org1){
                        foreach($s_org1 as $s_org2){
                            $subc_org[] = $s_org2;
                            
                        }
                    }
                }
            }

            if(!empty($mem_evidence_imgs)){
                foreach($mem_evidence_imgs as $index=>$aimgs){
                    if(!in_array($index, $subc_org)){
                        unset($mem_evidence_imgs[$index]);
                    }
                }
            }
            $mevimgs = json_encode($mem_evidence_imgs);


            //print_r($subc_org);die;

            $award_org_arr = array();

            if(!empty($award_organization)){
                foreach($award_organization as $aorg){
                    foreach($aorg as $aorg1){
                        $award_org_arr[] = $aorg1;
                        
                        
                    }
                    
                }
            }
            if(!empty($award_evidence_imgs)){
                foreach($award_evidence_imgs as $index=>$aimgs){
                    if(!in_array($index, $award_org_arr)){
                        unset($award_evidence_imgs[$index]);
                    }
                }
            }
            $aevimgs = json_encode($award_evidence_imgs);
            
            
            //print_r($award_evidence_imgs);die;

            
            if($profmemaward == "Yes"){
                if($award_question == "Yes"){
                    ProfessionalAssocialtionModel::where('user_id',$user_id)->update(['organization_data'=>$submembership_type,'des_profession_association'=>$des_profession_association,'date_joined'=>$date_joined,'membership_status'=>$membership_status,'membership_question'=>$profmemaward,'award_question'=>$award_question,'award_recognitions'=>$inst_org,'award_evidence_imgs'=>$aevimgs,'evidence_imgs'=>$mevimgs,'declare_info'=>$declaration_status]);
                }else{
                    ProfessionalAssocialtionModel::where('user_id',$user_id)->update(['organization_data'=>$submembership_type,'des_profession_association'=>$des_profession_association,'date_joined'=>$date_joined,'membership_status'=>$membership_status,'membership_question'=>$profmemaward,'award_question'=>$award_question,'award_evidence_imgs'=>$aevimgs,'evidence_imgs'=>$mevimgs,'declare_info'=>$declaration_status]);
                }
                
            }else{
                if($award_question == "Yes"){

                    ProfessionalAssocialtionModel::where('user_id',$user_id)->update(['membership_question'=>$profmemaward,'award_question'=>$award_question,'award_recognitions'=>$inst_org,'award_evidence_imgs'=>$aevimgs,'evidence_imgs'=>$mevimgs,'declare_info'=>$declaration_status]);
                }else{
                    ProfessionalAssocialtionModel::where('user_id',$user_id)->update(['membership_question'=>$profmemaward,'award_question'=>$award_question,'award_evidence_imgs'=>$aevimgs,'evidence_imgs'=>$mevimgs,'declare_info'=>$declaration_status]);
                }
                
            }
            
            $run = 1;
        }else{
            $user_stage = update_user_stage($user_id,"Professional Memberships & Awards");
            if($profmemaward == "Yes"){
                $img_arr = array();
                if(!empty($subcountry_organization)){
                    foreach($subcountry_organization as $s_org){
                        foreach($s_org as $s_org1){
                            foreach($s_org1 as $s_org2){
                                
                                $memimgs = Helpers::multipleFileUpload($membership_evidence[$s_org2], '');
                                $img_arr[$s_org2] = json_decode($memimgs);
                            }
                        }
                    }
                }
                if($award_question == "Yes"){
                    
                    $img_arr1 = array();
                    if(!empty($award_organization)){
                        foreach($award_organization as $a_org){
                            
                            foreach($a_org as $a_org1){
                                $memimgs = Helpers::multipleFileUpload($award_evidence[$a_org1], '');
                                $img_arr1[$a_org1] = json_decode($memimgs);
                            }            
                            
                                
                            
                        }
                    }
                
                    $post = new ProfessionalAssocialtionModel();
                    $post->user_id = $user_id;
                    $post->organization_data = $submembership_type;
                    $post->date_joined = $date_joined;
                    $post->membership_status = $membership_status;
                    $post->award_recognitions = $inst_org;
                    $post->evidence_imgs = json_encode($img_arr);
                    $post->award_evidence_imgs = json_encode($img_arr1);
                    $post->membership_question = $profmemaward;
                    $post->award_question = $award_question;
                    $post->declare_info = $declaration_status;
                    $run = $post->save();
                }else{
                    $post = new ProfessionalAssocialtionModel();
                    $post->user_id = $user_id;
                    $post->organization_data = $submembership_type;
                    $post->date_joined = $date_joined;
                    $post->membership_status = $membership_status;
                    
                    $post->evidence_imgs = json_encode($img_arr);
                    $post->membership_question = $profmemaward;
                    $post->award_question = $award_question;
                    $post->declare_info = $declaration_status;
                    $run = $post->save();
                }
                
            }else{
                
                if($award_question == "Yes"){
                    
                    $img_arr = array();
                    if(!empty($award_organization)){
                        foreach($award_organization as $a_org){
                            
                            foreach($a_org as $a_org1){
                                $memimgs = Helpers::multipleFileUpload($award_evidence[$a_org1], '');
                                $img_arr[$a_org1] = json_decode($memimgs);
                            }            
                            
                                
                            
                        }
                    }
                   
                   
                    $post = new ProfessionalAssocialtionModel();
                    $post->user_id = $user_id;
                    $post->award_recognitions = $inst_org;
                    $post->award_evidence_imgs = json_encode($img_arr);
                    $post->membership_question = $profmemaward;
                    $post->award_question = $award_question;
                    $post->declare_info = $declaration_status;
                    $run = $post->save();
                }else{
                    $post = new ProfessionalAssocialtionModel();
                    $post->user_id = $user_id;
                    $post->membership_question = $profmemaward;
                    $post->award_question = $profmemaward;
                    $post->declare_info = $declaration_status;
                    $run = $post->save();
                }
                
            }
            
        }
        
        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
        
        
    }

    public function uploadMembershipImgs(Request $request){
        $files = $request->file('membership_evidence');
        $sub_org_id = $request->sub_org_id;
        $user_id = $request->user_id;
        
        $getMembdata = DB::table("professional_membership")->where("user_id", $user_id)->first();
        
        if ($getMembdata && $getMembdata->evidence_imgs) {
            $membimg = (array)json_decode($getMembdata->evidence_imgs);
            if(isset($membimg[$sub_org_id])){
                
                $memim = $membimg[$sub_org_id];
            }else{
                $memim = '';
            }
            
            $memimgs = Helpers::multipleFileUpload($files[$sub_org_id], $memim);

            $membimg[$sub_org_id] = json_decode($memimgs);
            $img_arr = $membimg;
            
        } else {
            $membimgs = Helpers::multipleFileUpload($files[$sub_org_id], '');
            $img_arr = array($sub_org_id=>json_decode($membimgs));
        }
 
        //print_r(json_encode($img_arr));die;
        
        $run = ProfessionalAssocialtionModel::where('user_id', $user_id)->update(['evidence_imgs' => json_encode($img_arr)]);

        return json_encode($img_arr);
    }

    public function uploadAwardImgs(Request $request){
        $files = $request->file('award_evidence');
        $award_org_id = $request->award_org_id;
        $user_id = $request->user_id;
        
        $getMembdata = DB::table("professional_membership")->where("user_id", $user_id)->first();
        
        if ($getMembdata && $getMembdata->award_evidence_imgs) {
            $membimg = (array)json_decode($getMembdata->award_evidence_imgs);
            if(isset($membimg[$award_org_id])){
                
                $memim = $membimg[$award_org_id];
            }else{
                $memim = '';
            }
            
            $memimgs = Helpers::multipleFileUpload($files[$award_org_id], $memim);

            $membimg[$award_org_id] = json_decode($memimgs);
            $img_arr = $membimg;
            
        } else {
            $membimgs = Helpers::multipleFileUpload($files[$award_org_id], '');
            $img_arr = array($award_org_id=>json_decode($membimgs));
        }
 
        //print_r(json_encode($img_arr));die;
        
        $run = ProfessionalAssocialtionModel::where('user_id', $user_id)->update(['award_evidence_imgs' => json_encode($img_arr)]);

        return json_encode($img_arr);
    }
    

    public function deleteEvidenceImg(Request $request)
    {
        $user_id = $request->user_id;
        $sub_org_id = $request->sub_org_id;
        $img = $request->img;

        $getMembData = DB::table("professional_membership")->where("user_id", $user_id)->first();

        if(!empty($getMembData)){
            $getEvidenceimg = (array)json_decode($getMembData->evidence_imgs);

            $getevimg = $getEvidenceimg[$sub_org_id];
            //print_r($getevimg);die;

            $img_index = array_search($img, $getevimg);

            array_splice($getevimg, $img_index, 1);

            if (!empty($getevimg)) {
                $EvidenceimgData = $getevimg;
            } else {
                $EvidenceimgData = '';
            }

            
            $getEvidenceimg[$sub_org_id] = $EvidenceimgData;

            //print_r($getEvidenceimg);die;
            $deleteData = ProfessionalAssocialtionModel::where('user_id', $user_id)->update(['evidence_imgs' => json_encode($getEvidenceimg)]);

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

        //print_r($gettransimg);

    }

    public function deleteAwardEvidenceImg(Request $request)
    {
        $user_id = $request->user_id;
        $award_org_id = $request->award_org_id;
        $img = $request->img;

        $getMembData = DB::table("professional_membership")->where("user_id", $user_id)->first();

        if(!empty($getMembData)){
            $getEvidenceimg = (array)json_decode($getMembData->award_evidence_imgs);

            $getevimg = $getEvidenceimg[$award_org_id];
            //print_r($getevimg);die;

            $img_index = array_search($img, $getevimg);

            array_splice($getevimg, $img_index, 1);

            if (!empty($getevimg)) {
                $EvidenceimgData = $getevimg;
            } else {
                $EvidenceimgData = '';
            }

            
            $getEvidenceimg[$award_org_id] = $EvidenceimgData;

            //print_r($getEvidenceimg);die;
            $deleteData = ProfessionalAssocialtionModel::where('user_id', $user_id)->update(['award_evidence_imgs' => json_encode($getEvidenceimg)]);

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

        //print_r($gettransimg);

    }

    public function interview()
    {
        //This function is for interview prefrence
        return view('nurse.interview_references');
    }
    public function personalPreferences()
    {
        //This function is for personal preferences
        return view('nurse.personal_preferences');
    }
    public function jobSearch()
    {
        //This function is for job search preference
        return view('nurse.job_search');
    }
    public function additionalInfo()
    {
        //This function is for additional information
        return view('nurse.additional_info');
    }
}
