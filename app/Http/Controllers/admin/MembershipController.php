<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\NurseRepository;
use App\Services\Admins\NurseServices;
use App\Repository\Eloquent\VerificationRepository;
use Illuminate\Support\Facades\Mail;
use App\Models\ProfessionalAssocialtionModel;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;
use File;
use DB;
use Helpers;

class MembershipController extends Controller
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

    public function index(Request $request){
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $user_id = $request->id;
        $data['organization_country'] = DB::table("professional_organization")->where("country_organiztions","0")->orderBy('organization_country', 'ASC')->get();
        $data['awards_recognitions'] = DB::table("awards_recognitions")->where("sub_award_id","0")->orderBy('award_name', 'ASC')->get();
        $data['user_id'] = $user_id;
        $data['professional_membership'] = DB::table("professional_membership")->where("user_id",$user_id)->first();
        return view("admin.edit_professional_membership")->with($data);
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
}