<?php

namespace App\Repository\Eloquent;

use App\Models\EvidenceModel;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Facades\Log;


class EvidenceRepository extends BaseRepository
{

    protected $model;
    protected $cache;

    public function __construct(EvidenceModel $model, Cache $cache)
    {
        $this->model = $model;
        parent::__construct($model, $cache);
    }

    // Degree data in database
    public function create($data)
    {
        try {
            return $this->model->create($data);
        } catch (\Exception $e) {
            Log::error("Error in EvidenceRepository.create(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function get($byWhere)
    {
        try {
            return $this->model->where($byWhere)->first();
        } catch (\Exception $e) {
            Log::error("Error in EvidenceRepository.get(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getAll()
    {
        try {
            return $this->model->orderBy('id', 'desc')->get();
        } catch (\Exception $e) {
            Log::error("Error in EvidenceRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function delete($byWhere)
    {
        try {
            return $this->model->where($byWhere)->delete();
        } catch (\Exception $e) {
            Log::error("Error in EvidenceRepository.delete(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function update($byWhere, $Data)
    {
        try {
            return $this->model->where($byWhere)->update($Data);
        } catch (\Exception $e) {
            Log::error("Error in EvidenceRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
}
