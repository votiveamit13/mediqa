<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\VaccinationRequest;
use App\Http\Requests\EvidenceRequest;
use App\Services\Admins\VaccinationServices;
use App\Services\Admins\EvidenceServices;
use App\Repository\Eloquent\VaccinationRepository;
use App\Repository\Eloquent\EvidenceRepository;
use App\Repository\Eloquent\ImmStatusRepository;
use App\Services\Admins\ImmStatusServices;
use App\Http\Requests\ImmStatusRequest;

class VaccinationController extends Controller
{
    protected $vaccinationServices;
    protected $evidenceServices;
    protected $vaccinationRepository;
    protected $evidenceRepository;
    protected $immStatusRepository;
    protected $immStatusServices;

    public function __construct(
        VaccinationServices $vaccinationServices,
        VaccinationRepository $vaccinationRepository,
        EvidenceServices $evidenceServices,
        EvidenceRepository $evidenceRepository,
        ImmStatusRepository $immStatusRepository,
        ImmStatusServices $immStatusServices,
    ) {
        $this->vaccinationServices = $vaccinationServices;
        $this->vaccinationRepository = $vaccinationRepository;
        $this->evidenceServices = $evidenceServices;
        $this->evidenceRepository = $evidenceRepository;
        $this->immStatusRepository = $immStatusRepository;
        $this->immStatusServices = $immStatusServices;
    }

    // this is Degree  data in database
    public function VaccinationList(Request $request)
    {
        try {
            $vaccData  = $this->vaccinationRepository->getAll();
            return view('admin.vaccination_list', compact('vaccData'));
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/VaccinationList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addVaccination(VaccinationRequest $request)
    {
        try {
            return $this->vaccinationServices->addVaccination($request);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/addVaccination :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteVaccination(Request $request)
    {
        try {
            return $this->vaccinationServices->deleteVaccination($request);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/deleteVaccination :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateVaccination(VaccinationRequest $request)
    {
        try {
            return $this->vaccinationServices->updateVaccination($request);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/updateVaccination :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getVaccination(Request $request)
    {
        try {
            return $this->vaccinationRepository->get(['id' => $request->id]);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/getVaccination :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    // this is Evidence  data in database
    public function EvidenceList(Request $request)
    {
        try {
            $eviData  = $this->evidenceRepository->getAll();
            return view('admin.evidence_list', compact('eviData'));
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/EvidenceList:' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addEvidence(EvidenceRequest $request)
    {
        try {
            return $this->evidenceServices->addEvidence($request);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/addEvidence :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function getEvidence(Request $request)
    {
        try {
            return $this->evidenceRepository->get(['id' => $request->id]);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/getEvidence :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateEvidence(EvidenceRequest $request)
    {
        try {
            return $this->evidenceServices->updateEvidence($request);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/updateEvidence :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deleteEvidence(Request $request)
    {
        try {
            return $this->evidenceServices->deleteEvidence($request);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/deleteEvidence :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    // this is Evidence  data in database
    public function imStatusList(Request $request)
    {
        try {
            $immstatusData  = $this->immStatusRepository->getAll();
            return view('admin.immu_status_list', compact('immstatusData'));
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/imStatusList:' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addImmStatus(ImmStatusRequest $request)
    {
        try {
            return $this->immStatusServices->addImmStatus($request);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/addImmStatus :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getImmStatus(Request $request)
    {
        try {
            return $this->immStatusRepository->get(['id' => $request->id]);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/getImmStatus :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateImmStatus(ImmStatusRequest $request)
    {
        try {
            return $this->immStatusServices->updateImmStatus($request);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/updateImmStatus :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }


    public function deleteImmStatus(Request $request)
    {
        try {
            return $this->immStatusServices->deleteImmStatus($request);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/deleteEvidence :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
}
