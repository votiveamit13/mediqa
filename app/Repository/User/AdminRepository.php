<?php

namespace App\Repository\User;

use App\Models\User;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Facades\Log;


class AdminRepository extends BaseRepository{

    protected $model;
    protected $cache;

    public function __construct(User $model, Cache $cache){
        $this->model = $model;
        parent::__construct($model, $cache);
    }
    public function updateadminProfile($byWhere, $allData){
        try {
            return $this->model->where($byWhere)->update($allData);
        } catch(\Exception $e){
            Log::error("Error in AdminRepository.updateadminProfile(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updatePassword($byWhere, $adminPassword){
        try {
            return $this->model->where($byWhere)->update(['password' => $adminPassword['password']]);
        } catch(\Exception $e){
            Log::error("Error in AdminRepository.updatePassword(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getAdminData($byWhere){
        try {
            return $this->model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in AdminRepository.getAdminData(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
}
