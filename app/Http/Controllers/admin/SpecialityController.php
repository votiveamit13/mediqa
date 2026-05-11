<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\SpecialityRequest;
use App\Http\Requests\SubspecialityRequest;
use App\Http\Requests\NewSpecialityRequest;
use App\Services\Admins\SpecialityServices;
use App\Repository\Eloquent\SpecialityRepository;

class SpecialityController extends Controller
{
    protected $specialityServices;
    protected $specialityRepository;
  
    public function __construct(SpecialityServices $specialityServices , SpecialityRepository $specialityRepository){
        $this->specialityServices = $specialityServices;
        $this->specialityRepository = $specialityRepository;
       
    }

    // this is Profession  data in database
    public function specialityList(Request $request)
    {
        try {
            $specialityData  =  $this->specialityRepository->getAll(['parent'=>0]);
            return view('admin.speciality-list',compact('specialityData'));
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/specialityList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addSpeciality(SpecialityRequest $request)
    {
        try {
           return $this->specialityServices->addSpeciality($request);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/addSpeciality :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteSpeciality(Request $request)
    {
        try {
           return $this->specialityServices->deleteSpeciality($request);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/deleteSpeciality :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateSpeciality(SpecialityRequest $request)
    {
        try {
           return $this->specialityServices->updateSpeciality($request);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/updateSpeciality :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getSpeciality(Request $request)
    {
        try {
           return $this->specialityRepository->get(['id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/getSpeciality :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    

    // Sub Profession  data in database
    public function subspecialityList(Request $request)
    {
        try {
            $specialityData  =  $this->specialityRepository->getAllJob(['parent'=>0]);
            $subspecialityData  =  $this->specialityRepository->getAllJob(['parent'=>$request->id]);
           
            $speciality=$this->specialityRepository->get(['id' => $request->id]);
            return view('admin.sub-speciality-list',compact('specialityData','speciality','subspecialityData'));
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/subspecialityList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    // Sub Job Specialities List  data in database
    public function subjobSpecialitiesList(Request $request)
    {
        try {
           
            $specialityData  =  $this->specialityRepository->getAllSpeciality(['parent'=>'0']);
           
            $subspecialityData  =  $this->specialityRepository->getAllSpeciality(['parent'=>$request->id]);
            
            $speciality=$this->specialityRepository->get_specialities(['id' => $request->id]);
           
            return view('admin.sub-speciality-list-job',compact('specialityData','speciality','subspecialityData'));
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/subjobSpecialitiesList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addSubspeciality(SubspecialityRequest $request)
    {
        try {
           return $this->specialityServices->addSubspeciality($request);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/addSubspeciality :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addSubspecialityJob(SubspecialityRequest $request)
    {
        try {
           return $this->specialityServices->addSubspecialityJob($request);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/addSubspecialityJob :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteSubspeciality(Request $request)
    {
        try {
           return $this->specialityServices->deleteSubspeciality($request);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/deleteSubspeciality :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateSubspeciality(SubspecialityRequest $request)
    {
        try {
           return $this->specialityServices->updateSubspeciality($request);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/updateSubspeciality :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getSubspeciality(Request $request)
    {
        try {
           return $this->specialityRepository->get(['id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/getSubspeciality :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    
    // this is speciality  data in database
    public function specialityNewList(Request $request)
    {
        try {
            $newSpecialityData  =   $this->specialityRepository->getAllSpeciality(['parent'=>'0']);
            return view('admin.speciality-list-new',compact('newSpecialityData'));
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/specialityNewList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNewSpeciality(NewSpecialityRequest $request)
    {
        try {
           return $this->specialityServices->addNewSpeciality($request);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/addNewSpeciality :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteNewSpeciality(Request $request)
    {
        try {
           return $this->specialityServices->deleteNewSpeciality($request);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/deleteNewSpeciality :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateNewSpeciality(NewSpecialityRequest $request)
    {
        try {
           return $this->specialityServices->updateNewSpeciality($request);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/updateNewSpeciality :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getNewSpeciality(Request $request)
    {
        try {
           return $this->specialityRepository->getSpeciality(['id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/getNewSpeciality :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function getSubspecialityJob(Request $request)
    {
        try {
           return $this->specialityRepository->getSpeciality(['id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/getSubspecialityJob :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateSubspecialityJob(SubspecialityRequest $request)
    {
        try {
           return $this->specialityServices->updateSubspecialityJob($request);
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/updateSubspecialityJob :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    // harshita's code

    // Sub Job Specialities List  data in database
    public function SubsubjobSpecialitiesList(Request $request)
    {
        try {
         
            $specialityData = $this->specialityRepository->getAllSubSpeciality();

            $subspecialityData  =  $this->specialityRepository->getAllSpeciality(['parent'=>$request->id]);
            
            $speciality=$this->specialityRepository->get_specialities(['id' => $request->id]);
           
            return view('admin.sub-sub-speciality-list-job',compact('specialityData','speciality','subspecialityData'));
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/subjobSpecialitiesList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    // Sub Job Specialities List  data in database
    public function SubmenujobSpecialitiesList(Request $request)
    {
        try {
         
            $specialityData = $this->specialityRepository->getAllSubSpeciality();

            $subspecialityData  =  $this->specialityRepository->getAllSpeciality(['parent'=>$request->id]);
            
            $speciality=$this->specialityRepository->get_specialities(['id' => $request->id]);
           
            return view('admin.sub-menu-speciality-list-job',compact('specialityData','speciality','subspecialityData'));
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/SubmenujobSpecialitiesList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    // Sub Profession  data in database
    public function SubtypeofNurse(Request $request)
    {
        try {
            $specialityData  =  $this->specialityRepository->getAllSubJob(['parent'=>0]);
            $subspecialityData  =  $this->specialityRepository->getAllJob(['parent'=>$request->id]);
           
            $speciality=$this->specialityRepository->get(['id' => $request->id]);
            return view('admin.nurse-job-sub-type-list',compact('specialityData','speciality','subspecialityData'));
        } catch (\Exception $e) {
            log::error('Error in SpecialityController/subspecialityList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    

   

}
