<?php
namespace App\Services\Admins;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\WorkPreferencesRepository;

class WorkPreferServices
{
    protected $work_prefer_repository;

    public function __construct(WorkPreferencesRepository $work_prefer_repository)
    {
        $this->work_prefer_repository = $work_prefer_repository;
    }

     public function addWorkEnvironment($data)
    {
        try {
            $allData['env_name'] = $data['env_name'];
            $allData['sub_env_id'] = $data['sub_env_id'];
            $allData['sub_envp_id'] = $data['sub_envp_id'];
            $run = $this->work_prefer_repository->create($allData);
            
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Work Environment'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in MembershipServices/addCountry(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteEnvironment($request)
    {
        try {
            $run = $this->work_prefer_repository->delete(['prefer_id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Work Environment'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/deleteDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateWorkEnvironment($data)
    {
        //print_r($data['env_name']);die;
        try {

            $allData['env_name'] = $data['env_name'];
            
            
            $id = $data['id'];
            $run= $this->work_prefer_repository->update(['prefer_id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Work Environment'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/updateDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addPosition($data)
    {
        try {
            $allData['position_name'] = $data['position_name'];
            $allData['subposition_id'] = $data['subposition_id'];
            
            $run = $this->work_prefer_repository->createPosition($allData);
            
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Position'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in MembershipServices/addCountry(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deletePosition($request)
    {
        try {
            $run = $this->work_prefer_repository->deletePosition(['position_id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Position'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/deleteDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updatePosition($data)
    {
        //print_r($data['env_name']);die;
        try {

            $allData['position_name'] = $data['position_name'];
            
            
            $id = $data['id'];
            $run= $this->work_prefer_repository->updatePosition(['position_id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Position'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/updateDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addWorkshift($data)
    {
        try {
            $allData['shift_name'] = $data['work_shift_name'];
            $allData['shift_id'] = $data['shift_id'];
            $allData['sub_shift_id'] = $data['sub_shift_id'];
            
            $run = $this->work_prefer_repository->createWorkShift($allData);
            
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Work shift preferences'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in MembershipServices/addCountry(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteWorkshift($request)
    {
        try {
            $run = $this->work_prefer_repository->deleteWorkshift(['work_shift_id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Work shift preferences'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/deleteDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateWorkshift($data)
    {
        //print_r($data['env_name']);die;
        try {

            $allData['shift_name'] = $data['work_shift_name'];
            
            
            $id = $data['id'];
            $run= $this->work_prefer_repository->updateWorkShift(['work_shift_id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Work shift preferences'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/updateDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addBenefits($data)
    {
        try {
            $allData['benefits_name'] = $data['benefit_name'];
            $allData['subbenefit_id'] = $data['subbenefit_id'];

            if ($data->hasFile('icon')) {
                $file = $data->file('icon');
                $iconName = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/benefits'), $iconName);
                $allData['icon'] = $iconName;
            }
            
            $run = $this->work_prefer_repository->createBenefits($allData);
            
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Benefit preferences'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in MembershipServices/addCountry(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteBenefits($request)
    {
        try {
            $benefit = $this->work_prefer_repository
                ->getBenefits(['benefits_id' => $request->id]);

            if (!empty($benefit->icon) &&
                file_exists(public_path('uploads/benefits/'.$benefit->icon))) {
                unlink(public_path('uploads/benefits/'.$benefit->icon));
            }

            $run = $this->work_prefer_repository
                ->deleteBenefits(['benefits_id' => $request->id]);

            if ($run) {
                return response()->json([
                    'status' => '2',
                    'message' => __('message.statusThree', ['parameter' => 'Benefit preferences'])
                ]);
            }

            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);

        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/deleteBenefits(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateBenefits($data)
    {
        try {
            $id = $data['id'];

            $allData['benefits_name'] = $data['benefit_name'];

            $benefit = $this->work_prefer_repository
                ->getBenefits(['benefits_id' => $id]);

            if ($data->hasFile('icon')) {

                if (!empty($benefit->icon) &&
                    file_exists(public_path('uploads/benefits/'.$benefit->icon))) {
                    unlink(public_path('uploads/benefits/'.$benefit->icon));
                }

                $file = $data->file('icon');
                $iconName = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/benefits'), $iconName);
                $allData['icon'] = $iconName;
            }

            $run = $this->work_prefer_repository
                ->updateBenefits(['benefits_id' => $id], $allData);

            if ($run) {
                return response()->json([
                    'status' => '2',
                    'message' => __('message.statusTwo', ['parameter' => 'Benefit preferences'])
                ]);
            }

            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);

        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/updateBenefits(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addEmployeementType($data)
    {
        try {
            $allData['sub_prefer_id'] = $data['sub_prefer_id'];
            $allData['emp_type'] = $data['emp_type_name'];
            
            $run = $this->work_prefer_repository->createEmpType($allData);
            
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Employeement Type'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in MembershipServices/addCountry(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }    

    public function updateEmployeementType($data)
    {
        //print_r($data['env_name']);die;
        try {

            $allData['emp_type'] = $data['emp_type_name'];
            $allData['sub_prefer_id'] = $data['sub_prefer_id'];
            
            $id = $data['emp_prefer_id'];
            $run= $this->work_prefer_repository->updateEmpType(['emp_prefer_id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Employeement Type'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/updateDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deleteEmployeementType($request)
    {
        try {
            $run = $this->work_prefer_repository->deleteEmpType(['emp_prefer_id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Employeement Type'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/deleteDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

}