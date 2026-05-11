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
use App\Models\MandatoryTrainModel;

class MandatortrainingController extends Controller{

    public function mandatory_training()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        // $data['organization_country'] = DB::table("professional_organization")->where("country_organiztions","0")->orderBy('organization_country', 'ASC')->get();
        // $data['awards_recognitions'] = DB::table("awards_recognitions")->where("sub_award_id","0")->orderBy('award_name', 'ASC')->get();
        
        // $data['professional_membership'] = DB::table("professional_membership")->where("user_id",$user_id)->first();
        $data['trainingData'] = DB::table("mandatory_training")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
        return view('nurse.mandatory_training')->with($data);
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
            $user_stage = update_user_stage($user_id,"Registrations and Licences");
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