<?php

namespace App\Repository\Eloquent;

use App\Models\ProfessionalCer;
use App\Models\GeneralSubCertificate;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Facades\Log;


class ProfessionalcerRepository extends BaseRepository{

    protected $model;
    protected $secmodel;
    protected $cache;

    public function __construct(ProfessionalCer $model, Cache $cache,GeneralSubCertificate $secmodel ){
        $this->model = $model;
        $this->secmodel = $secmodel;
        parent::__construct($model,$secmodel, $cache);
    }

    // Degree data in database

    public function create($data){
        try {
            return $this->model->create($data);
        } catch(\Exception $e){
            Log::error("Error in ProfessionalcerRepository.create(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function get($byWhere){
        try {
            return $this->model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in ProfessionalcerRepository.get(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getAll(){
        try {
            return $this->model->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in ProfessionalcerRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function delete($byWhere){
        try {
            return $this->model->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in ProfessionalcerRepository.delete(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function update($byWhere,$Data){
        try {
            return $this->model->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in ProfessionalcerRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getsubcertificate($byWhere){
        try {
            return $this->secmodel->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in ProfessionalcerRepository.getsubcertificate(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updatesub($byWhere,$Data){
        try {
            return $this->secmodel->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in ProfessionalcerRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteSub($byWhere){
        try {
            return $this->secmodel->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in ProfessionalcerRepository.deleteSub(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }


   
}
