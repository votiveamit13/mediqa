<?php
namespace App\Services\Admins;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\SpecialityRepository;

class SpecialityServices
{
    protected $specialityRepository;

    public function __construct(SpecialityRepository $specialityRepository)
    {
        $this->specialityRepository = $specialityRepository;
    }

    // Profession data in database

    public function addnewsletters($data)
    {
        try {
            $allData['email'] = $data['emailNewsletter'];
            
            $run = $this->specialityRepository->create_newsletter($allData);
            if ($run) {
                // return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Newsletter'])]);
                return response()->json(['status' => '2', 'message' => 'Newsletter has been subscribed successfully']);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in SpecialityServices/addSpeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function contact_us_data($data)
    {
        try {
            $allData['email'] = $data['emailNewsletter'];
            
            $run = $this->specialityRepository->create_newsletter($allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Newsletter'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in SpecialityServices/addSpeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addSpeciality($data)
    {
        try {
            $allData['name'] = $data['speciality'];
            if(isset($data['trending'])){  $allData['is_featured'] = $data['trending'];}
            else{$allData['is_featured'] = '0';}
            $allData['parent'] = 0;
            $run = $this->specialityRepository->create($allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Profession'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in SpecialityServices/addSpeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteSpeciality($request)
    {
        try {
            $run = $this->specialityRepository->delete(['id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Profession'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in SpecialityServices/deleteSpeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateSpeciality($data)
    {
        try {

            $allData['name'] = $data['speciality'];
            if(isset($data['trending'])){  $allData['is_featured'] = $data['trending'];}
            else{$allData['is_featured'] = '0';}
            $allData['parent'] = 0;
            $id = $data['id'];
            $run= $this->specialityRepository->update(['id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Profession'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in SpecialityServices/updateSpeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    // Sub Profession data in database

    public function addSubspecialityJob($data)
    {
        try {
            $allData['name'] = $data['subspeciality'];
            if(isset($data['trending'])){  $allData['is_featured'] = $data['trending'];}
            else{$allData['is_featured'] = '0';}
            $allData['parent'] =$data['speciality'];
            $run = $this->specialityRepository->createSpeciality($allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Job Specialities Type'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in SpecialityServices/addSubspecialityJob(): ' . $e->getMessage());
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
            $run = $this->specialityRepository->create($allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Practitioner Type'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in SpecialityServices/addSubspeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteSubspeciality($request)
    {
        try {
            $run = $this->specialityRepository->delete(['id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Practitioner Type'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in SpecialityServices/deleteSubspeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateSubspeciality($data)
    {
        try {

            $allData['name'] = $data['subspeciality'];
            $allData['parent'] = $data['speciality'];
            if(isset($data['trending'])){  $allData['is_featured'] = $data['trending'];}
            else{$allData['is_featured'] = '0';}
            $id = $data['id'];
            $run= $this->specialityRepository->update(['id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Practitioner Type'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in SpecialityServices/updateSubspeciality(): ' . $e->getMessage());
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
            
            $run = $this->specialityRepository->createSpeciality($allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Speciality'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in SpecialityServices/addNewSpeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteNewSpeciality($request)
    {
        try {
            $run = $this->specialityRepository->deleteSpeciality(['id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Speciality'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in SpecialityServices/deleteNewSpeciality(): ' . $e->getMessage());
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
            $run= $this->specialityRepository->updateSpeciality(['id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Speciality'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in SpecialityServices/updateNewSpeciality(): ' . $e->getMessage());
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
            $run= $this->specialityRepository->updateSpeciality(['id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Sub Speciality Job Type'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in SpecialityServices/updateSubspeciality(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

        
}
