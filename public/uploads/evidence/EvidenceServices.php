<?php

namespace App\Services\Admins;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\EvidenceRepository;

class EvidenceServices
{
    protected $evidenceRepository;

    public function __construct(EvidenceRepository $evidenceRepository)
    {
        $this->evidenceRepository = $evidenceRepository;
    }

    //Evidence data in database
    public function addEvidence($data)
    {
        try {
            $allData['name'] = $data['evidence'];
            $allData['type'] = $data['type'];
            $allData['dose'] = $data['dose'];
            $run = $this->evidenceRepository->create($allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Evidence'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in EvidenceServices/addEvidence(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteEvidence($request)
    {
        try {
            $run = $this->evidenceRepository->delete(['id' => $request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Evidence'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in EvidenceServices/deleteVaccination(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }


    public function updateEvidence($data)
    {
        try {
            $allData['name'] = $data['evidence'];
            $allData['type'] = $data['type'];
            $id = $data['id'];
            $allData['dose'] = $data['dose'];
            $run = $this->evidenceRepository->update(['id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Evidence'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in EvidenceServices/updateEvidence(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
}
