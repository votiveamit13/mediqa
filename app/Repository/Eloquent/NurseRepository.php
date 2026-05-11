<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Models\UserEducationCertiModel;
use App\Models\ExperienceModel;
use App\Models\MandatoryTrainModel;
use App\Models\InterviewModel;
use App\Models\PreferencesModel;
use App\Models\WorkPreferencesModel;
use App\Models\VaccinationFrontModel;
use App\Models\ProfessionalAssocialtionModel;
use App\Models\AddReferee;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Facades\Log;


class NurseRepository extends BaseRepository{

    protected $model;
    protected $usereducationcertification;
    protected $experience;
    protected $mandatoryTraing;
    protected $interviewRef;
    protected $preferences;
    protected $workpreferences;
    protected $vaccination;
    protected $promembership;
    protected $addReferee;
    protected $cache;

    public function __construct(User $model,UserEducationCertiModel $usereducationcertification,ExperienceModel $experience,MandatoryTrainModel $mandatoryTraing , 
    Cache $cache,InterviewModel $interviewRef,PreferencesModel $preferences,WorkPreferencesModel $workpreferences,VaccinationFrontModel $vaccination,ProfessionalAssocialtionModel $promembership,AddReferee $addReferee){
        $this->model = $model;
        $this->experience = $experience;
        $this->usereducationcertification = $usereducationcertification;
        $this->mandatoryTraing = $mandatoryTraing;
        $this->interviewRef = $interviewRef;
        $this->preferences = $preferences;
        $this->workpreferences = $workpreferences;
        $this->vaccination = $vaccination;
        $this->promembership = $promembership;
        $this->addReferee = $addReferee;
        parent::__construct($model, $cache);
    }
    public function getIncomingNurseList(){
        try {
            return $this->model->where(['type'=>'1','emailVerified'=>'1','user_stage' => '1','role' => '1'])->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getIncomingNurseList(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    
    public function getUnverifiedNurseList(){
        try {
            return $this->model->where(['type'=>'1','email_verify'=>'0','emailVerified'=>'0','user_stage' => '0','role' => '1'])->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getIncomingNurseList(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    
    public function getcompleteprofileNurseList(){
        try {
            return $this->model->where(['type'=>'1','emailVerified'=>'1','user_stage' => '4','role' => '1'])->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getcompleteprofileNurseList(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function getInProgressprofileNurseList(){
        try {
            return $this->model->where(['type'=>'1','emailVerified'=>'1','user_stage' => '5','role' => '1'])->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getInProgressprofileNurseList(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    
    public function getCustomerList(){
        try {
            return $this->model->where(['type'=>'0','user_stage' => '1'])->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getIncomingNurseList(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function totalIncomingNurse(){
        try {
            return $this->model->where(['type'=>'1','user_stage' => '1'])->count();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.totalIncomingNurse(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getActiveNurseList(){
        try {
            return $this->model->where(['type'=>'1','user_stage' => '2'])->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getActiveNurseList(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function totalActiveNurse(){
        try {
            return $this->model->where(['type'=>'1','user_stage' => '2'])->count();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.totalActiveNurse(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateData($byWhere,$updateData){
        try {
             return $this->model->where($byWhere)->update($updateData);
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.updateData(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteData($byWhere){
        try {
            return $this->model->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.deleteData(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getOneUser($byWhere){
        try {
            return $this->model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getOneUser(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getEducationCerdetails($byWhere){
    try {
        return $this->usereducationcertification->where($byWhere)->first();
    } catch(\Exception $e){
        Log::error("Error in NurseRepository.getEducationCerdetails(): " . $e->getMessage());
        return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
    }
    }
    public function getExperiencedetails($byWhere){
        try {
            return $this->experience->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getExperiencedetails(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
   }
   public function getMandatorytrainingdetails($byWhere){
        try {
            return $this->mandatoryTraing->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getMandatorytrainingdetails(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
   }
   public function getInterviewrefdetails($byWhere){
        try {
            return $this->interviewRef->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getInterviewrefdetails(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
   }
   public function getPersonalprefdetails($byWhere){
        try {
            return $this->preferences->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getPersonalprefdetails(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
   }
   public function getfindworkdetails($byWhere){
        try {
            return $this->workpreferences->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getfindworkdetails(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
   }
   public function getvaccinationdetails($byWhere){
        try {
            return $this->vaccination->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getvaccinationdetails(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
   }
   public function getProMembershipData($byWhere){
        try {
            return $this->promembership->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getProMembershipData(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
   }
   public function create($data){
        // DB::beginTransaction();
        try {
            $result = $this->model->create($data);
            return $result;
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.create(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getReferedetails($byWhere){
        try {
            return $this->addReferee->where($byWhere)->get();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getReferedetails(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
   }
}