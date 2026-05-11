<?php
namespace App\Services\Admins;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\LanguageSkillsRepository;

class LanguageSkillsServices
{
    protected $language_skills_repository;

    public function __construct(LanguageSkillsRepository $language_skills_repository)
    {
        $this->language_skills_repository = $language_skills_repository;
    }

    public function addLanguages($data)
    {
        
        try {
            
            $allData['language_name'] = $data['language_name'];

            if($data['form_type'] != "certification_form"){
                $allData['language_field'] = $data['language_field_type'];
                $allData['sub_language_id'] = $data['sub_language_id'];
            }
            
            $allData['test_id'] = $data['test_id'];
            $run = $this->language_skills_repository->create($allData);
            
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Language'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in MembershipServices/addCountry(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteLanguages($request)
    {
        try {
            $run = $this->language_skills_repository->delete(['language_id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Language'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/deleteDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateLanguages($data)
    {
        try {

            $allData['language_name'] = $data['language_name'];
            $allData['language_field'] = $data['language_field_type'];
           
            
            $id = $data['id'];
            $run= $this->language_skills_repository->update(['language_id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Language'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/updateDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }


}    