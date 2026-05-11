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
use App\Models\LanguageModel;
use App\Models\LanguageSkillsModel;

class LanguageSkillsContoller extends Controller{

    public function index()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['language_data'] = LanguageModel::where("sub_language_id",NULL)->where("test_id",NULL)->orderBy("language_name","ASC")->get();
        $data['test_data'] = LanguageModel::where("test_id","1")->orderBy("language_name","ASC")->get();
        $data['other_test_data'] = LanguageModel::where("test_id","2")->orderBy("language_name","ASC")->get();
        $data['specialized_lang_skills'] = LanguageModel::where("test_id","3")->orderBy("language_name","ASC")->get();
        $data['language_skills'] = LanguageSkillsModel::where("user_id",$user_id)->first();
        return view('nurse.language_skills')->with($data);
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
        $other_prof_cert = json_encode($request->otherlangprof);
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