<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\SubMantrainingRequest;
use App\Http\Requests\ManTrainingRequest;
use App\Services\Admins\ManTrainingServices;
use App\Repository\Eloquent\ManTrainingRepository;
use App\Models\ManTrainingCatModel;
use DB;

class MantrainingController extends Controller
{
    protected $manTrainingServices;
    protected $mantrainingRepository;
  
    public function __construct(ManTrainingServices $manTrainingServices , ManTrainingRepository $mantrainingRepository){
        $this->manTrainingServices = $manTrainingServices;
        $this->mantrainingRepository = $mantrainingRepository;
       
    }

    // this is Degree  data in database
    public function mantrainingList(Request $request)
    {
        try {
            $mantrainingData  =  $this->mantrainingRepository->getAll();
            return view('admin.mandatory-training-list',compact('mantrainingData'));
        } catch (\Exception $e) {
            log::error('Error in MantrainingController/mantrainingList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addManTraining(ManTrainingRequest $request)
    {
        try {
           return $this->manTrainingServices->addManTraining($request);
        } catch (\Exception $e) {
            log::error('Error in MantrainingController/addManTraining :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function getManTraining(Request $request)
    {
        try {
           return $this->mantrainingRepository->get(['id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/getManTraining :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateManTraining(ManTrainingRequest $request)
    {
        try {
           return $this->manTrainingServices->updateManTraining($request);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/updateSpeciality :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteManTraining(Request $request)
    {
        try {
           return $this->manTrainingServices->deleteManTraining($request);
        } catch (\Exception $e) {
            log::error('Error in MantrainingController/deleteManTraining :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    // Sub Mandatory Training and Education   List  data in database
    public function subManTrainingList(Request $request)
    {
  
        try {           
            $mantrainingData  =  $this->mantrainingRepository->getAllMantran(['parent'=>'0']);
           
            $submantrainingData  =  $this->mantrainingRepository->getAllMantran(['parent'=>$request->id]);
            
            $mantraining = $this->mantrainingRepository->get_man_tra(['id' => $request->id]);
       
            return view('admin.sub-training-education-list',compact('mantrainingData','mantraining','submantrainingData'));
        } catch (\Exception $e) {
            log::error('Error in MantrainingController/subManTrainingList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addSubMantraining(SubMantrainingRequest $request)
    {
        try {
           return $this->manTrainingServices->addSubMantraining($request);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/addSubspecialityJob :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteSubMantraining(Request $request)
    {
        try {
           return $this->manTrainingServices->deleteSubMantraining($request);
        } catch (\Exception $e) {
            log::error('Error in MantrainingController/deleteSubMantraining :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
   
    

    public function getSubMantraining(Request $request)
    {
        try {
           return $this->mantrainingRepository->getSubMantraining(['id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in MantrainingController/getSubMantraining :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    
     public function updateSubMantraining(SubMantrainingRequest $request)
    {

        try {
           return $this->manTrainingServices->updateSubMantraining($request);
        } catch (\Exception $e) {
            log::error('Error in MantrainingController/updateSubMantraining :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    
     public function getsubCertificate(Request $request)
    {
        try {
            // dd($request->id);
           return $this->professionalcerRepository->getsubcertificate(['professionalcert_id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in MantrainingController/getsubCertificate :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updatesubCertificate(subcertificateRequest $request)
    {
        try {
           return $this->manTrainingServices->updateSubCertificate($request);
        } catch (\Exception $e) {
            log::error('Error in MantrainingController/updateDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    
    
}
