<?php

namespace App\Repository\Eloquent;

use App\Models\ProfessionModel;
use App\Models\PoliceCheckModel;
use App\Models\EligibilityToWorkModel;
use App\Models\WorkingChildrenCheckModel;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Facades\Log;


class VerificationRepository extends BaseRepository{

    protected $model;
    protected $policeCheckModel;
    protected $eligibilityToWorkModel;
    protected $workingChildrenCheckModel;
    protected $cache;

    public function __construct(ProfessionModel $model, Cache $cache ,PoliceCheckModel $policeCheckModel,EligibilityToWorkModel $eligibilityToWorkModel,WorkingChildrenCheckModel $workingChildrenCheckModel){
        $this->model = $model;
        $this->policeCheckModel = $policeCheckModel;
        $this->eligibilityToWorkModel = $eligibilityToWorkModel;
        $this->workingChildrenCheckModel = $workingChildrenCheckModel;
        parent::__construct($model, $cache,$policeCheckModel,$eligibilityToWorkModel,$workingChildrenCheckModel);
    }

    //Profession Verification management 

    public function getAll(){
        try {
            return $this->model->orderBy('id', 'desc')->where('status','0')->get();
        } catch(\Exception $e){
            Log::error("Error in VerificationRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function get($byWhere){
        try {
            return $this->model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in VerificationRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function update($byWhere,$Data){
        try {
            return $this->model->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in VerificationRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }


    // Police Check Verification management 

    public function getAllDataPoliceCheckVerification(){
        try {
            return $this->policeCheckModel->orderBy('id', 'desc')->where('status','0')->get();
        } catch(\Exception $e){
            Log::error("Error in VerificationRepository.getAllDataPoliceCheckVerification(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getPoliceCheckVerificationData($byWhere){
        try {
            return $this->policeCheckModel->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in VerificationRepository.getPoliceCheckVerificationData(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updatePoliceCheckVerificationData($byWhere,$Data){
        try {
            return $this->policeCheckModel->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in VerificationRepository.updatePoliceCheckVerificationData(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    /* Eligibility To Work  */
    public function getEligibilityToWorkData($byWhere){
        try {
            return $this->eligibilityToWorkModel->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in VerificationRepository.getEligibilityToWorkData(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

      /* working Children Check   */
      public function getWorkingChildrenCheckData($byWhere){
        try {
            return $this->workingChildrenCheckModel->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in VerificationRepository.getWorkingChildrenCheckData(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }


   
}
