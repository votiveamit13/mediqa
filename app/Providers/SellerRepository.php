<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Facades\Log;


class SellerRepository extends BaseRepository{

    protected $model;
    protected $cache;

    public function __construct(User $model, Cache $cache){
        $this->model = $model;
        parent::__construct($model, $cache);
    }
    public function getIncomingSellerList(){
        try {
            return $this->model->where(['type'=>'1','user_stage' => '1'])->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in SellerRepository.getIncomingSellerList(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getCustomerList(){
        try {
            return $this->model->where(['type'=>'0','user_stage' => '1'])->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in SellerRepository.getIncomingSellerList(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function totalIncomingSeller(){
        try {
            return $this->model->where(['type'=>'1','user_stage' => '1'])->count();
        } catch(\Exception $e){
            Log::error("Error in SellerRepository.totalIncomingSeller(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getActiveSellerList(){
        try {
            return $this->model->where(['type'=>'1','user_stage' => '2'])->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in SellerRepository.getActiveSellerList(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function totalActiveSeller(){
        try {
            return $this->model->where(['type'=>'1','user_stage' => '2'])->count();
        } catch(\Exception $e){
            Log::error("Error in SellerRepository.totalActiveSeller(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateData($byWhere,$updateData){
        try {
             return $this->model->where($byWhere)->update($updateData);
        } catch(\Exception $e){
            Log::error("Error in SellerRepository.updateData(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteData($byWhere){
        try {
            return $this->model->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in SellerRepository.deleteData(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getOneUser($byWhere){
        try {
            return $this->model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in SellerRepository.getOneUser(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
}
