<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\NurseRepository;
use App\Services\Admins\NurseServices;
use App\Http\Requests\LanguageRequest;
use App\Http\Requests\MembershipTypeRequest;
use App\Http\Requests\AwardsRequest;
use App\Services\Admins\LanguageSkillsServices;
use App\Repository\Eloquent\LanguageSkillsRepository;
use App\Models\LanguageModel;
use App\Models\LanguageSkillsModel;
use Helpers;

class LanguageSkillsController extends Controller{
    protected $language_skills_services;
    protected $language_skills_repository;
    protected $nurseRepository;
    protected $nurseServices;
  
    public function __construct(NurseRepository $nurseRepository, NurseServices $nurseServices,LanguageSkillsServices $language_skills_services , LanguageSkillsRepository $language_skills_repository){
        $this->language_skills_services = $language_skills_services;
        $this->language_skills_repository = $language_skills_repository;
        $this->nurseRepository = $nurseRepository;
        $this->nurseServices = $nurseServices;
    }

    public function language_list(Request $request)
    {
        
        try {
            $languageData  =  $this->language_skills_repository->getAll(['sub_language_id'=>NULL,'test_id'=>NULL]);
            

            return view('admin.language_list',compact('languageData'));
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addLanguages(LanguageRequest $request)
    {
        
        try {
         
            return $this->language_skills_services->addLanguages($request);
         } catch (\Exception $e) {
             log::error('Error in DegreeController/addDegree :' . $e->getMessage() . 'in line' . $e->getLine());
             return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
         }
    }

    public function getLanguages(Request $request)
    {
        try {
           return $this->language_skills_repository->get(['language_id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/getDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deleteLanguages(Request $request)
    {
        try {
           return $this->language_skills_services->deleteLanguages($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/deleteDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateLanguages(LanguageRequest $request)
    {
        
        try {
           return $this->language_skills_services->updateLanguages($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/updateDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function sub_language_list(Request $request)
    {
        
        try {
            $languageData  =  $this->language_skills_repository->getAll(['sub_language_id'=>$request->id,'test_id'=>NULL]);
            $data['languageData'] = $languageData;
            $data['language_id'] = $request->id;
            return view('admin.sub_language_list')->with($data);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function certification_list(Request $request)
    {
        
        try {
            $languageData  =  $this->language_skills_repository->getAll(['sub_language_id'=>NULL,['test_id', '!=', null]]);
            
            return view('admin.certification_list',compact('languageData'));
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function editLanguageSkills(Request $request){
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $user_id = $request->id;
        $data['language_data'] = LanguageModel::where("sub_language_id",NULL)->where("test_id",NULL)->orderBy("language_name","ASC")->get();
        $data['test_data'] = LanguageModel::where("test_id","1")->orderBy("language_name","ASC")->get();
        $data['other_test_data'] = LanguageModel::where("test_id","2")->orderBy("language_name","ASC")->get();
        $data['specialized_lang_skills'] = LanguageModel::where("test_id","3")->orderBy("language_name","ASC")->get();
        $data['language_skills'] = LanguageSkillsModel::where("user_id",$user_id)->first();
        $data['user_id'] = $user_id; 
        return view('admin.edit_language_skills')->with($data);
    }

    public function getLanguagesData(Request $request)
    {
        $language_id = $request->language_id;
        $data['main_language_data'] = LanguageModel::where("language_id",$language_id)->first();
        
        $data['language_data'] = LanguageModel::where("sub_language_id",$language_id)->orderBy("language_name","ASC")->get();
        //print_r(json_encode($data['language_data']));
        return json_encode($data);
    }

    public function getSubLanguagesData(Request $request)
    {
        $language_id = $request->language_id;
        $data['sub_language_data'] = LanguageModel::where("language_id",$language_id)->first();
        
        //print_r(json_encode($data['language_data']));
        return json_encode($data);
    }

    public function getTestLanguagesData(Request $request)
    {
        $language_id = $request->language_id;
        $data['test_language_data'] = LanguageModel::where("language_id",$language_id)->first();
        $data['language_id'] = $language_id;
        return json_encode($data);
    }

    public function updateLanguageSkills(Request $request)
    {
        $user_id = $request->user_id;
        $langprof_level = json_encode($request->langprof_level);
        $english_prof_cert = json_encode($request->english_prof_cert);
        $other_prof_cert = $request->otherlangprof ? json_encode($request->otherlangprof) : NULL;
        $specialized_lang_skills = json_encode($request->specialized_lang_skills);
        $declaration_status = $request->professional_declare_information;

        //print_r($langprof_level);die;
        $language_skills_data = LanguageSkillsModel::where("user_id",$user_id)->first();

        //print_r($english_prof_cert);
        if(!empty($language_skills_data)){

            $run = LanguageSkillsModel::where('user_id',$user_id)->update(['langprof_level'=>$langprof_level,'english_prof_cert'=>$english_prof_cert,'other_prof_cert'=>$other_prof_cert,'specialized_lang_skills'=>$specialized_lang_skills,'declare_info'=>$declaration_status]);
        }else{
            $user_stage = update_user_stage($user_id,"Language Skills");
            $language_skills = new LanguageSkillsModel();
            $language_skills->user_id = $user_id;
            $language_skills->langprof_level = $langprof_level;
            $language_skills->english_prof_cert = $english_prof_cert;
            $language_skills->other_prof_cert = $other_prof_cert;
            $language_skills->specialized_lang_skills = $specialized_lang_skills;
            $language_skills->declare_info = $declaration_status;
            $run = $language_skills->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
    }

    public function uploadlangEvidenceImgs(Request $request)
    {
        $img_field = $request->img_field;
        $files = $request->file($img_field);
        $language_id = $request->language_id;
        $user_id = $request->user_id;

        $getLangdata = LanguageSkillsModel::where("user_id", $user_id)->first();

        if(!empty($getLangdata)){
            if($img_field == "english_prof_cert"){
                $langprocert = $getLangdata->english_prof_cert;
                $getLangImgs = (array)json_decode($langprocert);
            }

            if($img_field == "other_prof_cert"){
                $langprocert = $getLangdata->other_prof_cert;
                $getLangImgs = (array)json_decode($langprocert);
            }

            if($img_field == "specialized_lang_skills"){
                $langprocert = $getLangdata->specialized_lang_skills;
                $getLangImgs = (array)json_decode($langprocert);
            }
        }else{
            $langprocert = '';
            $getLangImgs = array();
        }
        
        if(isset($getLangImgs[$language_id])){
            $getLangImg = $getLangImgs[$language_id];
        }else{
            $getLangImg = array();
        }
        
        //print_r($getLangImg->score_level);

        if (!empty($getLangdata) && $langprocert != NULL && isset($getLangImg->evidence_imgs)) {
            $langimg = (array)json_decode($getLangImg->evidence_imgs);
            //print_r($langimg);
            $langimgs = Helpers::multipleFileUpload($files[$language_id], $langimg);
        }else{
            $langimgs = Helpers::multipleFileUpload($files[$language_id], '');
            //$img_arr = json_decode($langimgs);
        }

        if(isset($getLangImgs[$language_id])){
            $getLangImg->evidence_imgs = $langimgs;
        }
        
        //print_r($getLangImgs);

        $run = LanguageSkillsModel::where('user_id', $user_id)->update([$img_field => json_encode($getLangImgs)]);
        return $langimgs;
    }

    public function deletelangEvidenceImg(Request $request)
    {
        $img_field = $request->img_field;
        $user_id = $request->user_id;
        $language_id = $request->language_id;
        $img = $request->img;

        $getLangdata = LanguageSkillsModel::where("user_id", $user_id)->first();
        
        if (!empty($getLangdata)) {
            if($img_field == "english_prof_cert"){
                $langprocert = $getLangdata->english_prof_cert ? $getLangdata->english_prof_cert : NULL;
                $getLangImgs = $langprocert ? (array)json_decode($langprocert) : NULL;
            }

            if($img_field == "other_prof_cert"){
                $langprocert = $getLangdata->other_prof_cert ? $getLangdata->other_prof_cert : NULL;
                $getLangImgs = $langprocert ? (array)json_decode($langprocert) : NULL;
            }

            if($img_field == "specialized_lang_skills"){
                $langprocert = $getLangdata->specialized_lang_skills ? $getLangdata->specialized_lang_skills : NULL;
                $getLangImgs = $langprocert ? (array)json_decode($langprocert) : NULL;
            }

            $getLangImg = isset($getLangImgs[$language_id]) ? $getLangImgs[$language_id] : NULL;
            //print_r($getLangImg->score_level);

            if ($langprocert != NULL && isset($getLangImg->evidence_imgs)) {
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
            
                $deleteData = LanguageSkillsModel::where('user_id', $user_id)->update([$img_field => json_encode($getLangImgs)]);

                $destinationPath = public_path() . '/uploads/education_degree/' . $img;

                if (File::exists($destinationPath)) {
                    File::delete($destinationPath);
                }

            }else{
                $deleteData = 1;
            }
        }
        else{
            $deleteData = 1;
        }

        if ($deleteData) {
            return 1;
        }
    }    


}    