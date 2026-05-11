<?php

namespace App\Repository\Eloquent;

use App\Models\DegreeModel;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Facades\Log;


class DegreeRepository extends BaseRepository{

    protected $model;
    protected $cache;

    public function __construct(DegreeModel $model, Cache $cache ){
        $this->model = $model;
        parent::__construct($model, $cache);
    }

    // Degree data in database

    public function create($data){
        try {
            return $this->model->create($data);
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
    public function getAll(){
        try {
            return $this->model->orderBy('id', 'desc')->get();
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
            return $this->model->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }


   
}
