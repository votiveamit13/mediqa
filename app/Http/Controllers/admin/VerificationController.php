<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Services\Admins\VerificationServices;
use App\Repository\Eloquent\VerificationRepository;

class VerificationController extends Controller
{
    protected $verificationServices;
    protected $verificationRepository;
  
    public function __construct(VerificationServices $verificationServices , VerificationRepository $verificationRepository){
        $this->verificationServices = $verificationServices;
        $this->verificationRepository = $verificationRepository;
       
    }

    // Profession Verification management 

    public function professionVerificationList(Request $request)
    {
        try {
          
            $incommingVerificationData = $this->verificationRepository->getAll();
            return view('admin.profession-verification-list',compact('incommingVerificationData'));
        } catch (\Exception $e) {
            log::error('Error in VerificationController/professionVerificationList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function changeProfessionVerificationStatus(Request $request)
    {
        try {
           return $this->verificationServices->changeProfessionVerificationStatus($request);
        } catch (\Exception $e) {
            log::error('Error in VerificationController/changeProfessionVerificationStatus :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

     //  Police check Verification management 

     public function policeCheckVerificationList(Request $request)
    {
        try {
          
            $policeCheckVerificationData = $this->verificationRepository->getAllDataPoliceCheckVerification();
            return view('admin.police-check-verification-list',compact('policeCheckVerificationData'));
        } catch (\Exception $e) {
            log::error('Error in VerificationController/policeCheckVerificationList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function changePoliceCheckVerificationStatus(Request $request)
    {
        try {
           return $this->verificationServices->changePoliceCheckVerificationStatus($request);
        } catch (\Exception $e) {
            dd($e);
            log::error('Error in VerificationController/changePoliceCheckVerificationStatus :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
  

  

}
