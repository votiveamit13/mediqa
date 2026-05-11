<?php

namespace App\Repository\Eloquent;

use App\Models\SpecialityModel;
use App\Models\PractitionerTypeModel;
use App\Models\NewsletterModel;
use App\Models\JobSpecialitiesModel;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Facades\Log;


class SpecialityRepository extends BaseRepository{

    protected $model;
    protected $newJobSpecialitiesModelData;
    protected $newslettermodel;
    protected $newSpecialityData;
    protected $cache;

    public function __construct(SpecialityModel $model,NewsletterModel $newslettermodel, Cache $cache ,PractitionerTypeModel $newSpecialityData,JobSpecialitiesModel $newJobSpecialitiesModelData){
        $this->model = $model;
        $this->newSpecialityData = $newSpecialityData;
        $this->newJobSpecialitiesModelData = $newJobSpecialitiesModelData;
        $this->newslettermodel = $newslettermodel;
        parent::__construct($model, $cache , $newJobSpecialitiesModelData,$newSpecialityData,$newslettermodel);
    }

    
    // Newsletter data in database

    public function create_newsletter($data){
        try {
            return $this->newslettermodel->create($data);
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.create_newsletter(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    // Practitioner data in database

    public function create($data){
        try {
            return $this->model->create($data);
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.create(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function get($byWhere){
        try {
            return $this->model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.get(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function get_specialities($byWhere){
        try {
            return $this->newSpecialityData->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.get_specialities(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function get_specialitiess($byWhere){
        try {
            return $this->newSpecialityData->where($byWhere)->get();
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.get_specialities(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
   
    public function getAllJob($byWhere){
        try {
            return $this->model->where($byWhere)->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getAllSpeciality($byWhere){
        try {
            return $this->newSpecialityData->where($byWhere)->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.getAllSpeciality(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getAll($byWhere){
        try {
            return $this->model->where($byWhere)->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function delete($byWhere){
        try {
            return $this->model->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.delete(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function update($byWhere,$Data){
        try {
            return $this->model->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }


    /* Speciality Data in database */

    public function createSpeciality($data){
        try {
         
            return $this->newSpecialityData->create($data);
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.create(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getSpeciality($byWhere){
        try {
            return $this->newSpecialityData->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.get(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
   
    public function deleteSpeciality($byWhere){
        try {
            return $this->newSpecialityData->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.deleteSpeciality(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateSpeciality($byWhere,$Data){
        try {
            return $this->newSpecialityData->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.updateSpeciality(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    // harshita's code
    public function getAllSubSpeciality(){
        try {
            return $this->newSpecialityData->where('parent','!=','0')->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.getAllSubSpeciality(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function getAllSubJob($byWhere){
        try {
            return $this->model->where('parent','!=',0)->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in SpecialityRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    
   
}
