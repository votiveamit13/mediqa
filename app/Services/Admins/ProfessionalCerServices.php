<?php
namespace App\Services\Admins;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\ProfessionalcerRepository;

class ProfessionalCerServices
{
    protected $professionalcerRepository;

    public function __construct(ProfessionalcerRepository $professionalcerRepository)
    {
        $this->professionalcerRepository = $professionalcerRepository;
    }

    // degree data in database

     public function addCertificate($data)
    {
        try {
            $allData['name'] = $data['certificate'];
            $run = $this->professionalcerRepository->create($allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Certificate'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ProfessionalCerServices/addCertificate(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteCertificate($request)
    {
        try {
            $run = $this->professionalcerRepository->delete(['id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Certificate'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ProfessionalCerServices/deleteDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateCertificate($data)
    {
        try {

            $allData['name'] = $data['certificate'];
            $id = $data['id'];
            $run= $this->professionalcerRepository->update(['id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Certificate'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ProfessionalCerServices/updateCertificate(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateSubCertificate($data)
    {
        try { 
            // dd($data) ;
            $allData['name'] = $data['general_sub_certificate'];
            $allData['cert_id'] = $data['general_certificate_name1'];
            $id = $data['id'];
            $run= $this->professionalcerRepository->updatesub(['professionalcert_id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Sub Certificate'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ProfessionalCerServices/updateSubCertificate(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteSubCertificate($request)
    {
        try {
            $run = $this->professionalcerRepository->deleteSub(['professionalcert_id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Certificate'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in ProfessionalCerServices/deleteSubCertificate(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

 

        
}
