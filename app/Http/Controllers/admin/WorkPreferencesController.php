<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\LanguageRequest;

use App\Http\Requests\WorkEnvironmentRequest;
use App\Services\Admins\WorkPreferServices;
use App\Repository\Eloquent\WorkPreferencesRepository;


class WorkPreferencesController extends Controller{
    protected $work_prefer_services;
    protected $work_prefer_repository;
  
    public function __construct(WorkPreferServices $work_prefer_services , WorkPreferencesRepository $work_prefer_repository){
        $this->work_prefer_services = $work_prefer_services;
        $this->work_prefer_repository = $work_prefer_repository;
       
    }

    public function work_environment_list(Request $request)
    {
        
        try {
            $enviromentData  =  $this->work_prefer_repository->getAll(['sub_env_id'=>0,'sub_envp_id'=>0]);
            
            //print_r($enviromentData);
            return view('admin.work_environment_list',compact('enviromentData'));
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addWorkEnvironment(WorkEnvironmentRequest $request)
    {
        
        try {
         
            return $this->work_prefer_services->addWorkEnvironment($request);
         } catch (\Exception $e) {
             log::error('Error in DegreeController/addDegree :' . $e->getMessage() . 'in line' . $e->getLine());
             return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
         }
    }

    public function getEnvironment(Request $request)
    {
        
        try {
           return $this->work_prefer_repository->get(['prefer_id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/getDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deleteEnvironment(Request $request)
    {
        try {
           return $this->work_prefer_services->deleteEnvironment($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/deleteDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateWorkEnvironment(WorkEnvironmentRequest $request)
    {
        
        try {
           return $this->work_prefer_services->updateWorkEnvironment($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/updateDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function sub_env_list(Request $request)
    {
        
        try {
            $enviromentData  =  $this->work_prefer_repository->getAll(['sub_env_id'=>$request->id,'sub_envp_id'=>0]);
            $data['enviromentData'] = $enviromentData;
            $data['prefer_id'] = $request->id;
            
            return view('admin.sub_env_list')->with($data);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function subsub_env_list(Request $request)
    {
        
        try {
            $enviromentData  =  $this->work_prefer_repository->getAll(['sub_env_id'=>$request->id,'sub_envp_id'=>$request->sub_env_id]);
            $data['enviromentData'] = $enviromentData;
            $data['prefer_id'] = $request->id;
            $data['sub_env_id'] = $request->sub_env_id;
            return view('admin.subsub_env_list')->with($data);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function position_list(Request $request)
    {
        
        try {
            $position_data  =  $this->work_prefer_repository->getAllPositions(['subposition_id'=>0]);
            
            //print_r($enviromentData);
            return view('admin.position_list',compact('position_data'));
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addPosition(WorkEnvironmentRequest $request)
    {
        
        try {
         
            return $this->work_prefer_services->addPosition($request);
         } catch (\Exception $e) {
             log::error('Error in DegreeController/addDegree :' . $e->getMessage() . 'in line' . $e->getLine());
             return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
         }
    }

    public function getPosition(Request $request)
    {
        
        try {
           return $this->work_prefer_repository->getPosition(['position_id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/getDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deletePosition(Request $request)
    {
        try {
           return $this->work_prefer_services->deletePosition($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/deleteDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updatePosition(WorkEnvironmentRequest $request)
    {
        
        try {
           return $this->work_prefer_services->updatePosition($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/updateDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

     public function sub_position(Request $request)
    {
        
        try {
            $positionData  =  $this->work_prefer_repository->getAllPositions(['subposition_id'=>$request->id]);
            $data['positionData'] = $positionData;
            $data['position_id'] = $request->id;
            
            return view('admin.sub_position')->with($data);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function work_shift_preferences(Request $request)
    {
        
        try {
            $work_shift_data  =  $this->work_prefer_repository->getAllWorkShift(['shift_id'=>0,'sub_shift_id'=>NULL]);
            
            //print_r($enviromentData);
            return view('admin.work_shift_preferences',compact('work_shift_data'));
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addWorkShift(WorkEnvironmentRequest $request)
    {
        
        try {
         
            return $this->work_prefer_services->addWorkShift($request);
         } catch (\Exception $e) {
             log::error('Error in DegreeController/addDegree :' . $e->getMessage() . 'in line' . $e->getLine());
             return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
         }
    }

    public function getWorkShift(Request $request)
    {
        
        try {
           return $this->work_prefer_repository->getWorkShift(['work_shift_id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/getDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deleteWorkShift(Request $request)
    {
        try {
           return $this->work_prefer_services->deleteWorkShift($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/deleteDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateWorkShift(WorkEnvironmentRequest $request)
    {
        
        try {
           return $this->work_prefer_services->updateWorkShift($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/updateDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

     public function sub_work_shift(Request $request)
    {
        
        try {
            $work_shift_data  =  $this->work_prefer_repository->getAllWorkShift(['shift_id'=>$request->id,'sub_shift_id'=>NULL]);
            $data['work_shift_data'] = $work_shift_data;
            $data['work_shift_id'] = $request->id;
            
            return view('admin.sub_work_shift')->with($data);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function sub_balance_shift(Request $request)
    {
        
        try {
            $work_shift_data  =  $this->work_prefer_repository->getAllWorkShift(['shift_id'=>$request->id,'sub_shift_id'=>$request->shift_id]);
            $data['work_shift_data'] = $work_shift_data;
            $data['work_shift_id'] = $request->id;
            $data['shift_id'] = $request->shift_id;

            return view('admin.sub_balance_shift')->with($data);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function benefit_preferences(Request $request)
    {
        
        try {
            $benefit_data  =  $this->work_prefer_repository->getAllBenefits(['subbenefit_id'=>0]);
            
            //print_r($enviromentData);
            return view('admin.benefit_preferences',compact('benefit_data'));
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addBenefits(WorkEnvironmentRequest $request)
    {
        
        try {
         
            return $this->work_prefer_services->addBenefits($request);
         } catch (\Exception $e) {
             log::error('Error in DegreeController/addDegree :' . $e->getMessage() . 'in line' . $e->getLine());
             return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
         }
    }

    public function getBenefits(Request $request)
    {
        
        try {
           return $this->work_prefer_repository->getBenefits(['benefits_id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/getDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deleteBenefits(Request $request)
    {
        try {
           return $this->work_prefer_services->deleteBenefits($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/deleteDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateBenefits(WorkEnvironmentRequest $request)
    {
        
        try {
           return $this->work_prefer_services->updateBenefits($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/updateDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

     public function sub_benefits(Request $request)
    {
        
        try {
            $benefits_data  =  $this->work_prefer_repository->getAllBenefits(['subbenefit_id'=>$request->id]);
            $data['benefits_data'] = $benefits_data;
            $data['benefits_id'] = $request->id;
            
            return view('admin.sub_benefits')->with($data);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function employeement_type_list(Request $request)
    {
        
        try {
            $empTypeData  =  $this->work_prefer_repository->getAllEmpType(['sub_prefer_id'=>0]);
            
            
            //print_r($enviromentData);
            return view('admin.employeement_type_list',compact('empTypeData'));
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addEmplyeementType(WorkEnvironmentRequest $request)
    {
        
        try {
         
            return $this->work_prefer_services->addEmployeementType($request);
         } catch (\Exception $e) {
             log::error('Error in DegreeController/addDegree :' . $e->getMessage() . 'in line' . $e->getLine());
             return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
         }
    }

    public function getEmployeementType(Request $request)
    {
        
        try {
           return $this->work_prefer_repository->getEmpType(['emp_prefer_id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/getDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateEmployeementType(WorkEnvironmentRequest $request)
    {
        
        try {
           return $this->work_prefer_services->updateEmployeementType($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/updateDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deleteEmployeementType(Request $request)
    {
        try {
           return $this->work_prefer_services->deleteEmployeementType($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/deleteDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function sub_employeement_type(Request $request)
    {
        
        try {
            $empTypeData  =  $this->work_prefer_repository->getAllEmpType(['sub_prefer_id'=>$request->id]);
            $data['empTypeData'] = $empTypeData;
            $data['emp_prefer_id'] = $request->id;
            //print_r($enviromentData);
            return view('admin.sub_emp_list')->with($data);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

}    