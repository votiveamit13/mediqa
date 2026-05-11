<?php

namespace App\Repository\Eloquent;

use App\Models\ManTrainingCatModel;
use App\Models\GeneralSubCertificate;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Facades\Log;


class ManTrainingRepository extends BaseRepository{

    protected $model;
    protected $secmodel;
    protected $cache;

    public function __construct(ManTrainingCatModel $model, Cache $cache,GeneralSubCertificate $secmodel ){
        $this->model = $model;
        $this->secmodel = $secmodel;
        parent::__construct($model,$secmodel, $cache);
    }

    // Degree data in database

    public function create($data){
        try {
            return $this->model->create($data);
        } catch(\Exception $e){
            Log::error("Error in ManTrainingRepository.create(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function get($byWhere){
        try {
            return $this->model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in ManTrainingRepository.get(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getAll(){
        try {
            return $this->model->orderBy('id', 'desc')->where('parent','=',0)->get();
        } catch(\Exception $e){
            Log::error("Error in ManTrainingRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function delete($byWhere){
        try {
            return $this->model->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in ManTrainingRepository.delete(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function update($byWhere,$Data){
        try {
            return $this->model->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in ManTrainingRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getAllMantran($byWhere){
        try {
            return $this->model->where($byWhere)->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in ManTrainingRepository.getAllMantran(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function get_man_tra($byWhere){
        try {
            return $this->model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in ManTrainingRepository.get_man_tra(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getSubMantraining($byWhere){
        try {
            return $this->model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in ManTrainingRepository.getSubMantraining(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    
    public function createsubmantra($data){
        try {
         
            return $this->model->create($data);
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.createsubmantra(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updatesub($byWhere,$Data){
        try {
            return $this->secmodel->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in ManTrainingRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteSub($byWhere){
        try {
            return $this->secmodel->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in ManTrainingRepository.deleteSub(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }


   
}
