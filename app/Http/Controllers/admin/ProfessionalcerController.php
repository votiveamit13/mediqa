<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\ProfessionalcerRequest;
use App\Http\Requests\subcertificateRequest;
use App\Services\Admins\ProfessionalCerServices;
use App\Repository\Eloquent\ProfessionalcerRepository;
use App\Models\GeneralSubCertificate;
use DB;

class ProfessionalcerController extends Controller
{
    protected $professionalCerServices;
    protected $professionalcerRepository;
  
    public function __construct(ProfessionalCerServices $professionalCerServices , ProfessionalcerRepository $professionalcerRepository){
        $this->professionalCerServices = $professionalCerServices;
        $this->professionalcerRepository = $professionalcerRepository;
       
    }

    // this is Degree  data in database
    public function certificateList(Request $request)
    {
        try {
            $certificateData  =  $this->professionalcerRepository->getAll();
            return view('admin.professional_certificate_list',compact('certificateData'));
        } catch (\Exception $e) {
            log::error('Error in ProfessionalcerController/degreeList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function certificateSubList(Request $request){
        $getProCertData = DB::table("professional_certificate")->get();

        $getCertData = DB::table("professional_certificate_table")->where("cert_id",$request->id)->get();
        //print_r($getCertData);
        $data['getCertID'] = $request->id;
        $data['getCertData'] = $getCertData;
        $data['getProCertData'] = $getProCertData;
        return view('admin.professionalsubcertlist',$data);
    }

    public function addGeneralCertificate(Request $request){
        $insertCertificate = new GeneralSubCertificate;

        $insertCertificate->cert_id = $request->general_certificate_name;
        $insertCertificate->name = $request->general_sub_certificate;
        $saveCertificate = $insertCertificate->save();

        if($saveCertificate){
            return response()->json(['status' => '2', 'message' => 'Certificate added successfully']);
        }

    }

    public function addCertificate(ProfessionalcerRequest $request)
    {
        try {
         
           return $this->professionalCerServices->addCertificate($request);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalcerController/addDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteCertificate(Request $request)
    {
        try {
           return $this->professionalCerServices->deleteCertificate($request);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalcerController/deleteCertificate :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateCertificate(ProfessionalcerRequest $request)
    {
        try {
           return $this->professionalCerServices->updateCertificate($request);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalcerController/updateDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getCertificate(Request $request)
    {
        try {
           return $this->professionalcerRepository->get(['id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalcerController/getDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
     public function getsubCertificate(Request $request)
    {
        try {
            // dd($request->id);
           return $this->professionalcerRepository->getsubcertificate(['professionalcert_id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalcerController/getsubCertificate :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updatesubCertificate(subcertificateRequest $request)
    {
        try {
           return $this->professionalCerServices->updateSubCertificate($request);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalcerController/updateDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteSubCertificate(Request $request)
    {
        try {
           return $this->professionalCerServices->deleteSubCertificate($request);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalcerController/deleteSubCertificate :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    

  

}
