<?php

namespace App\Repository\Eloquent;

use App\Models\WorkPreferModel;
use App\Models\PositionModel;
use App\Models\WorkshiftModel;
use App\Models\BenefitModel;
use App\Models\EmpTypeModel;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Facades\Log;
use DB;

class WorkPreferencesRepository extends BaseRepository{

    protected $model;
    protected $position_model;
    protected $work_shift_model;
    protected $benefit_model;
    protected $emp_type_model;
    protected $cache;

    public function __construct(EmpTypeModel $emp_type_model,WorkPreferModel $model,PositionModel $position_model,WorkshiftModel $work_shift_model,BenefitModel $benefit_model, Cache $cache ){
        $this->model = $model;
        $this->position_model = $position_model;
        $this->work_shift_model = $work_shift_model;
        $this->benefit_model = $benefit_model;
        $this->emp_type_model = $emp_type_model;
        parent::__construct($model, $cache);
    }

    public function create($data){
        
        try {
            return $this->model->insert($data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.create(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function get($byWhere){
        try {
            return $this->model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.get(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getAll($byWhere){
        
        try {
            
            return $this->model->where($byWhere)->orderBy('prefer_id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function delete($byWhere){
        try {
            return $this->model->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.delete(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function update($byWhere,$Data){
        try {
            
            return DB::table("work_enviornment_preferences")->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function createPosition($data){
        
        try {
            return $this->position_model->insert($data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.create(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getPosition($byWhere){
        try {
            return $this->position_model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.get(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getAllPositions($byWhere){
        
        try {
            
            return $this->position_model->where($byWhere)->orderBy('position_id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deletePosition($byWhere){
        try {
            return $this->position_model->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.delete(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updatePosition($byWhere,$Data){
        try {
            
            return DB::table("employee_positions")->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function createWorkShift($data){
        
        try {
            return $this->work_shift_model->insert($data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.create(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getWorkShift($byWhere){
        try {
            return $this->work_shift_model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.get(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getAllWorkShift($byWhere){
        
        try {
            
            return $this->work_shift_model->where($byWhere)->orderBy('work_shift_id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteWorkShift($byWhere){
        try {
            return $this->work_shift_model->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.delete(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateWorkShift($byWhere,$Data){
        try {
            
            return DB::table("work_shift_preferences")->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function createBenefits($data){
        
        try {
            return $this->benefit_model->insert($data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.create(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getBenefits($byWhere){
        try {
            return $this->benefit_model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.get(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getAllBenefits($byWhere){
        
        try {
            
            return $this->benefit_model->where($byWhere)->orderBy('benefits_id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteBenefits($byWhere){
        try {
            return $this->benefit_model->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.delete(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateBenefits($byWhere,$Data){
        try {
            
            return DB::table("benefits_preferences")->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function createEmpType($data){
        
        try {
            return $this->emp_type_model->insert($data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.create(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function getEmpType($byWhere){
        try {
            return $this->emp_type_model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.get(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getAllEmpType($byWhere){
        
        try {
            
            return $this->emp_type_model->where($byWhere)->orderBy('emp_prefer_id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteEmpType($byWhere){
        try {
            return $this->emp_type_model->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.delete(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateEmpType($byWhere,$Data){
        try {
            
            return DB::table("employeement_type_preferences")->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
}