<?php

namespace App\Repository\Eloquent;

use App\Models\MembershipModel;
use App\Models\ProfessionalMembershipModel;
use App\Models\AwardsModel;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Facades\Log;
use DB;


class MembershipRepository extends BaseRepository{

    protected $model;
    protected $professional_membership_model;
    protected $cache;

    public function __construct(MembershipModel $model,ProfessionalMembershipModel $professional_membership_model,AwardsModel $awards_model, Cache $cache ){
        $this->model = $model;
        $this->professional_membership_model = $professional_membership_model;
        $this->awards_model = $awards_model;
        parent::__construct($model, $cache);
    }

    // Degree data in database

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
            
            return $this->model->where($byWhere)->orderBy('organization_id', 'desc')->get();
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
            
            return DB::table("professional_organization")->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function getAllMember($byWhere){
        
        try {
            
            return $this->professional_membership_model->where($byWhere)->orderBy('membership_id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function createMember($data){
        
        try {
            return $this->professional_membership_model->insert($data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.create(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function getMember($byWhere){
        try {
            return $this->professional_membership_model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.get(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateMembership($byWhere,$Data){
        try {
            
            return DB::table("membership_type")->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deleteMembership($byWhere){
        try {
            return $this->professional_membership_model->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.delete(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function getAllAwards($byWhere){
        
        try {
            
            return $this->awards_model->where($byWhere)->orderBy('award_id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function createAwards($data){
        
        try {
            return $this->awards_model->insert($data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.create(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function getAwards($byWhere){
        try {
            return $this->awards_model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.get(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateAwards($byWhere,$Data){
        try {
            
            return DB::table("awards_recognitions")->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deleteAwards($byWhere){
        try {
            return $this->awards_model->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.delete(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }



   
}
