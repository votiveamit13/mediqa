<?php
namespace App\Services\Admins;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\ManTrainingRepository;

class ManTrainingServices
{
    protected $manTrainingRepository;

    public function __construct(manTrainingRepository $manTrainingRepository)
    {
        $this->manTrainingRepository = $manTrainingRepository;
    }

    // Man data in database
    public function addManTraining($data)
    {
        try {
            $allData['name'] = $data['man_training'];
            $allData['type'] =$data['type'];
            if(isset($data['trending'])){  $allData['is_featured'] = $data['trending'];}
            else{$allData['is_featured'] = '0';}
            $allData['parent'] = 0;
            $run = $this->manTrainingRepository->create($allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Data'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ManTrainingServices/addSpeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteManTraining($request)
    {
        try {
            $run = $this->manTrainingRepository->delete(['id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Data'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ManTrainingServices/deleteSpeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateManTraining($data)
    {
        try {

            $allData['name'] = $data['man_training'];
            $allData['type'] =$data['type'];
            if(isset($data['trending'])){  $allData['is_featured'] = $data['trending'];}
            else{$allData['is_featured'] = '0';}
            $allData['parent'] = 0;
            $id = $data['id'];
            $run= $this->manTrainingRepository->update(['id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Data'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ManTrainingServices/updateManTraining(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    // Sub Profession data in database

    public function addSubMantraining($data)
    {
        try {
            $allData['name'] = $data['subtrainingeducation'];
            $allData['type'] = $data['type'];
            if(isset($data['trending'])){  $allData['is_featured'] = $data['trending'];}
            else{$allData['is_featured'] = '0';}
            $allData['parent'] =$data['speciality'];
            $run = $this->manTrainingRepository->createsubmantra($allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Data'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ManTrainingServices/addSubMantraining(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addSubspeciality($data)
    {
        try {
            $allData['name'] = $data['subspeciality'];
            $allData['parent'] =$data['speciality'];

            if(isset($data['trending'])){  $allData['is_featured'] = $data['trending'];}
            else{$allData['is_featured'] = '0';}
            $run = $this->manTrainingRepository->create($allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Practitioner Type'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ManTrainingServices/addSubspeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteSubMantraining($request)
    {
        try {
            $run = $this->manTrainingRepository->delete(['id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Data'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ManTrainingServices/deleteSubspeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateSubMantraining($data)
    {
        try {

            $allData['name'] = $data['subtrainingeducation'];
            $allData['parent'] = $data['speciality'];
            $allData['type'] = $data['type'];
            if(isset($data['trending'])){  $allData['is_featured'] = $data['trending'];}
            else{$allData['is_featured'] = '0';}
            $id = $data['id'];
            $run= $this->manTrainingRepository->update(['id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Data'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ManTrainingServices/updateSubspeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

     // speciality data in database

     public function addNewSpeciality($data)
    {
        try {
            $allData['name'] = $data['newSpeciality'];
            if(isset($data['trending'])){  $allData['is_featured'] = $data['trending'];}
            else{$allData['is_featured'] = '0';}
            
            $run = $this->manTrainingRepository->createSpeciality($allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Speciality'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ManTrainingServices/addNewSpeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteNewSpeciality($request)
    {
        try {
            $run = $this->manTrainingRepository->deleteSpeciality(['id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Speciality'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ManTrainingServices/deleteNewSpeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateNewSpeciality($data)
    {
        try {

            $allData['name'] = $data['newSpeciality'];
            if(isset($data['trending'])){  $allData['is_featured'] = $data['trending'];}
            else{$allData['is_featured'] = '0';}
            $id = $data['id'];
            $run= $this->manTrainingRepository->updateSpeciality(['id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Speciality'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ManTrainingServices/updateNewSpeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateSubspecialityJob($data)
    {
        try {

            $allData['name'] = $data['subspeciality'];
            $allData['parent'] = $data['speciality'];
            if(isset($data['trending'])){  $allData['is_featured'] = $data['trending'];}
            else{$allData['is_featured'] = '0';}
            $id = $data['id'];
            $run= $this->manTrainingRepository->updateSpeciality(['id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Sub Speciality Job Type'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ManTrainingServices/updateSubspeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

        
}
