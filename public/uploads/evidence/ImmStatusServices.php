<?php

namespace App\Services\Admins;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\ImmStatusRepository;

class ImmStatusServices
{
    protected $immStatusRepository;

    public function __construct(ImmStatusRepository $immStatusRepository)
    {
        $this->immStatusRepository = $immStatusRepository;
    }

    //Evidence data in database
    public function addImmStatus($data)
    {
        try {
            $allData['name'] = $data['immu_status'];
            $run = $this->immStatusRepository->create($allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Immunization Status'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ImmStatusServices/addImmStatus(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteImmStatus($request)
    {
        try {
            $run = $this->immStatusRepository->delete(['id' => $request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Immunization Status'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ImmStatusServices/deleteImmStatus(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateImmStatus($data)
    {
        try {
            $allData['name'] = $data['immu_status'];
            $id = $data['id'];
            $run = $this->immStatusRepository->update(['id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Immunization Status'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ImmStatusServices/updateImmStatus(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
}
