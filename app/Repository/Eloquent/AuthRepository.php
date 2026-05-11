<?php

namespace App\Repository\Eloquent;

use App\Models\AdminModel;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Facades\Log;


class AuthRepository extends BaseRepository{

    protected $model;
    protected $cache;

    public function __construct(AdminModel $model, Cache $cache){
        $this->model = $model;
        parent::__construct($model, $cache);
    }
    public function update($byWhere, $allData){
        try {
            return $this->model->where($byWhere)->update($allData);
        } catch(\Exception $e){
            Log::error("Error in AdminRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getData($byWhere){
        try {
           
          return $this->model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in AdminRepository.getData(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
}
