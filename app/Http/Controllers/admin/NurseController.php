<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\NurseRepository;
use App\Services\Admins\NurseServices;
use App\Repository\Eloquent\VerificationRepository;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Nurseform2Request;
use App\Http\Requests\Nurseform1Request;
use App\Http\Requests\Nurseform3Request;
use App\Http\Requests\Nurseform4Request;
use App\Http\Requests\Nurseform5Request;
use App\Http\Requests\Nurseform6Request;
use App\Models\EducationModel;
use App\Models\ExperienceModel;
use App\Models\EvidanceFileModel;
use App\Models\OtherVaccineModel;
use App\Models\VaccinationFrontModel;

use App\Models\EligibilityToWorkModel;
use App\Models\WorkingChildrenCheckModel;
use App\Models\NdisWorker;
use App\Models\SpecializedClearance;
use App\Models\SubClassModel;
use App\Models\PoliceCheckModel;
use App\Models\NurseApplication;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Models\MandatoryTrainModel;
use Carbon\Carbon;
use File;
use DB;
use Helpers;


class NurseController extends Controller
{
    protected $nurseRepository;
    protected $nurseServices;
    protected $verificationRepository;

    public function __construct(NurseRepository $nurseRepository, NurseServices $nurseServices, VerificationRepository $verificationRepository)
    {
        $this->nurseRepository = $nurseRepository;
        $this->nurseServices = $nurseServices;
        $this->verificationRepository = $verificationRepository;
    }


    public function nurse_application($id = null)
    {
        $nurse_application = NurseApplication::with('health_care')->where('nurse_id', $id)->get();
        return view('admin.nurse_appliction_list', compact('nurse_application'));
    }

    public function incommingNurseList()
    {
        try {
            $incomingNurseUsers  = $this->nurseRepository->getIncomingNurseList();
            // dd($incomingNurseUsers);
            return view('admin.incoming-nurse-list', compact('incomingNurseUsers'));
        } catch (\Exception $e) {
            log::error('Error in NurseController/incommingNurseList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    
    public function unverified_nurse_list()
    {
        try {
            $unverified_nurse_list  = $this->nurseRepository->getUnverifiedNurseList();
            // dd($incomingNurseUsers);
            return view('admin.unverified_nurse_list', compact('unverified_nurse_list'));
        } catch (\Exception $e) {
            log::error('Error in NurseController/incommingNurseList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function inProgressprofileNurseList()
    {
        try {
            $inprogressprofileUsers  = $this->nurseRepository->getInProgressprofileNurseList();
            // dd($incomingNurseUsers);
            return view('admin.inprogress-profile-nurse-list', compact('inprogressprofileUsers'));
        } catch (\Exception $e) {
            log::error('Error in NurseController/incommingNurseList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function send_remainder(Request $request)
    {
        try {
            // $body = 'Dear ' . $request->name;
            // $body .= '<p>We hope this message finds you well.</p><p>We noticed that your profile is not yet complete. Finishing your profile will allow you to access a wide range of job opportunities from healthcare facilities, agencies, and individuals seeking nursing care at home.</p><p>To unlock these opportunities, please take a few minutes to complete your profile:</p><p>- Log in to your account:<a href="https://mediqa.com.au/nurse/login">Mediqa</a><br>- Fill in the remaining sections of your profile<br>- Submit your profile for approval.</p><p><strong>Once approved, you will be able to:</strong></p><p>- Apply for various shifts and permanent positions.<br>- Make your profile visible to potential employers.<br>- Receive interview requests and offers tailored to your preferences.</p><p>If you need any assistance, feel free to reach out to us at info@mediqa.com.au</p><p>Thank you for being part of our community. We look forward to seeing your completed profile soon.</p>';
            


            // $subject = 'Complete Your Profile to Access Nursing Job Opportunities';

            // $mailData = [
            //     'subject' =>  $subject,
            //     'email' => $request->email,
            //     'body' => $body,
            // ];

            // $sendMail = Mail::to($request->email)->send(new \App\Mail\DemoMail($mailData));

            $subject = 'Complete Your Profile to Access Nursing Job Opportunities';

            $body = '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <title>Complete Your Profile</title>
                </head>
                <body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, Helvetica, sans-serif;">
                    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:30px 0;">
                        <tr>
                            <td align="center">
                                <table width="100%" max-width="600" cellpadding="0" cellspacing="0"
                                    style="max-width:600px; background:#ffffff; border-radius:8px; overflow:hidden;">

                                    <!-- Header -->
                                    <tr>
                                        <td style="background:#000000; padding:20px; text-align:center;">
                                            <h1 style="margin:0; color:#ffffff; font-size:22px;">
                                                ' . e(env("APP_NAME")) . '
                                            </h1>
                                        </td>
                                    </tr>

                                    <!-- Body -->
                                    <tr>
                                        <td style="padding:30px; color:#333333;">
                                            <p style="margin:0 0 15px;">
                                                Dear <strong>' . e($request->name) . '</strong>,
                                            </p>

                                            <p style="margin:0 0 15px;">
                                                We hope this message finds you well.
                                            </p>

                                            <p style="margin:0 0 15px;">
                                                We noticed that your profile is not yet complete. Completing your profile will allow
                                                you to access a wide range of job opportunities from healthcare facilities, agencies,
                                                and individuals seeking nursing care at home.
                                            </p>

                                            <p style="margin:0 0 15px;">
                                                To unlock these opportunities, please take a few minutes to complete your profile:
                                            </p>

                                            <ul style="margin:0 0 20px 20px; padding:0; font-size:14px;">
                                                <li style="margin-bottom:8px;">
                                                    Log in to your account:
                                                    <a href="https://mediqa.com/nurse/login" style="color:#0d6efd; text-decoration:none;">
                                                        Mediqa
                                                    </a>
                                                </li>
                                                <li style="margin-bottom:8px;">Fill in the remaining sections of your profile</li>
                                                <li style="margin-bottom:8px;">Submit your profile for approval</li>
                                            </ul>

                                            <p style="margin:0 0 10px;"><strong>Once approved, you will be able to:</strong></p>

                                            <ul style="margin:0 0 20px 20px; padding:0; font-size:14px;">
                                                <li style="margin-bottom:8px;">Apply for various shifts and permanent positions</li>
                                                <li style="margin-bottom:8px;">Make your profile visible to potential employers</li>
                                                <li style="margin-bottom:8px;">Receive interview requests and offers tailored to your preferences</li>
                                            </ul>

                                            <p style="margin:0 0 15px; font-size:14px;">
                                                If you need any assistance, feel free to contact us at
                                                <a href="mailto:info@mediqa.com.au" style="color:#0d6efd; text-decoration:none;">
                                                    info@mediqa.com.au
                                                </a>.
                                            </p>

                                            <p style="margin:20px 0 0;">
                                                Thank you for being part of our community. We look forward to seeing your completed profile soon.
                                            </p>
                                        </td>
                                    </tr>

                                    <!-- Footer -->
                                    <tr>
                                        <td style="background:#f0f0f0; padding:15px; text-align:center; font-size:12px; color:#777;">
                                            © ' . date("Y") . ' Mediqa. All rights reserved.
                                        </td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                    </table>
                </body>
                </html>
                ';

            // --- Use ZeptoMailHelper here ---
            $sendMail = \App\Helpers\ZeptoMailHelper::sendMail(
                $request->email,
                $subject,
                htmlBody: $body
            );

            if ($sendMail) {
                return response()->json(['status' => '2', 'message' => 'Remainder has been sent successfully']);
            }

            return response()->json([
                'status' => '0',
                'message' => 'Failed to send email'
            ]);
        } catch (\Exception $e) {
            log::error('Error in NurseController/send_remainder :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function completeprofileNurseList()
    {
        try {
            $completeprofileUsers  = $this->nurseRepository->getcompleteprofileNurseList();
            // dd($incomingNurseUsers);
            return view('admin.complete-profile-nurse-list', compact('completeprofileUsers'));
        } catch (\Exception $e) {
            log::error('Error in NurseController/incommingNurseList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function customerList()
    {
        try {
            $Users  = $this->nurseRepository->getCustomerList();
            return view('admin.customer-list', compact('Users'));
        } catch (\Exception $e) {
            log::error('Error in NurseController/customerList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function activeNurseList()
    {
        try {
            $activeNurseUsers  = $this->nurseRepository->getActiveNurseList();
            return view('admin.active-nurse-list', compact('activeNurseUsers'));
        } catch (\Exception $e) {
            log::error('Error in NurseController/activeNurseList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function viewProfile(Request $request)
    {
        try {
            $professionVerificationData = $this->verificationRepository->get(['user_id' => $request->id]);
            $profileData  = $this->nurseRepository->getOneUser(['id' => $request->id]);
            $educationData  = $this->nurseRepository->getEducationCerdetails(['user_id' => $request->id]);
            $experienceData  = DB::table("user_experience")->where("user_id", $request->id)->get();
            $mandatorytrainingData  = $this->nurseRepository->getMandatorytrainingdetails(['user_id' => $request->id]);
            $RefereData  = $this->nurseRepository->getReferedetails(['user_id' => $request->id]);
            $interviewrefData  = $this->nurseRepository->getInterviewrefdetails(['user_id' => $request->id]);
            $personalprefData  = $this->nurseRepository->getPersonalprefdetails(['user_id' => $request->id]);
            $findworkData  = $this->nurseRepository->getfindworkdetails(['user_id' => $request->id]);
            
            // $vaccinationData  = $this->nurseRepository->getvaccinationdetails(['user_id' => $request->id]);
            //$policeCheckVerificationData = $this->verificationRepository->getPoliceCheckVerificationData(['user_id' => $request->id]);
            //$eligibilityToWorkData = $this->verificationRepository->getEligibilityToWorkData(['user_id' => $request->id]);
            //$workingChildrenCheckData = $this->verificationRepository->getWorkingChildrenCheckData(['user_id' => $request->id]);
            $user_id=$request->id;

            $proMembershipData = DB::table('professional_membership')->where('user_id', $user_id)->first();
            //$work_eligibility   = EligibilityToWorkModel::where('user_id', $user_id)->first();                     
            $ndis               = NdisWorker::where('user_id', $user_id)->first();              
            $ww_child           = WorkingChildrenCheckModel::where('user_id', $user_id)->get();
            $policy_check       = PoliceCheckModel::where('user_id', $user_id)->first();
            $specialize         = SpecializedClearance::where('user_id', $user_id)->get();
            $work_eligibility   = DB::table('eligibility_to_work as ew')
                                    ->select('ew.*','c.name as country_name', DB::raw("IFNULL(vs.sublcass_text, '') as sublcass_text"))
                                    ->leftJoin('visa_subclas as vs', 'ew.visa_subclass', '=', 'vs.id')
                                    ->leftJoin('country as c', 'ew.country_id', '=', 'c.id')
                                    ->where('ew.user_id', $request->id)
                                    ->first();
        //echo "<pre>";print_r($work_eligibility);die();
        
            

            $other_vaccine      = DB::table("other_vaccine")->where("user_id", $request->id)->get();
            $vaccinationData    = DB::table("vaccination_front")->where("user_id", $request->id)->get();
            $vccdata            = DB::table('vaccination_front as vc')
                                        ->select('vc.*', 'v.name as vaccination_name', 'ims.name as imm_status', 'et.name as evidence_type_name')
                                        ->join('vaccination as v', 'vc.vaccination_id', '=', 'v.id')
                                        ->join('imm_status as ims', 'vc.immunization_status', '=', 'ims.id')
                                        ->join('evidence_type as et', 'vc.evidance_type', '=', 'et.id')
                                        ->where('vc.user_id', $request->id)
                                        ->get();

            return view('admin.profile-view', compact(
                'profileData',
                'experienceData',
                'policy_check','work_eligibility', 'ndis', 'ww_child','specialize',
                'educationData',
                'mandatorytrainingData',
                'interviewrefData',
                'personalprefData',
                'findworkData',
                'vaccinationData',
                'other_vaccine',
                'vccdata',
                'proMembershipData',
                'RefereData'
            ));
        } catch (\Exception $e) {
            log::error('Error in NurseController/viewProfile :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addNurse(Request $request)
    {
        try {
            $professionVerificationData = $this->verificationRepository->get(['user_id' => 58]);
            $profileData  = $this->nurseRepository->getOneUser(['id' => 58]);
            $policeCheckVerificationData = $this->verificationRepository->getPoliceCheckVerificationData(['user_id' => 58]);
            $eligibilityToWorkData = $this->verificationRepository->getEligibilityToWorkData(['user_id' => 58]);
            $workingChildrenCheckData = $this->verificationRepository->getWorkingChildrenCheckData(['user_id' => 58]);
            return view('admin.add-nurse', compact('profileData', 'professionVerificationData', 'policeCheckVerificationData', 'eligibilityToWorkData', 'workingChildrenCheckData'));
        } catch (\Exception $e) {
            log::error('Error in NurseController/viewProfile :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addNursePostForm1(Nurseform1Request $request)
    {
        try {
            return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNursePostForm2(Request $request)
    {
        try {
            return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addNursePostForm3(Request $request)
    {
        try {
            return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addNursePostForm4(Request $request)
    {
        try {
            return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addNursePostForm5(Request $request)
    {
        try {
            return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addNursePostForm6(Nurseform6Request $request)
    {
        try {
            return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addNursePostForm7(Request $request)
    {
        try {
            return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addNursePostForm8(Request $request)
    {
        try {
            return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addNursePostForm9(Request $request)
    {
        try {
            return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addNursePostForm10(Request $request)
    {
        try {
            return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addNursePostForm11(Request $request)
    {
        try {
            return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addNursePostForm13(Request $request)
    {
        try {
            return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addNursePostForm14(Request $request)
    {
        try {
            return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addNursePostForm15(Request $request)
    {
        try {
            return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function EditNurse(Request $request)
    {
        try {
            $professionVerificationData = $this->verificationRepository->get(['user_id' => $request->id]);
            $profileData  = $this->nurseRepository->getOneUser(['id' => $request->id]);
            $educationData  = $this->nurseRepository->getEducationCerdetails(['user_id' => $request->id]);
            $experienceData  = $this->nurseRepository->getExperiencedetails(['user_id' => $request->id]);
            $mandatorytrainingData  = $this->nurseRepository->getMandatorytrainingdetails(['user_id' => $request->id]);
            $interviewrefData  = $this->nurseRepository->getInterviewrefdetails(['user_id' => $request->id]);
            $personalprefData  = $this->nurseRepository->getPersonalprefdetails(['user_id' => $request->id]);
            $findworkData  = $this->nurseRepository->getfindworkdetails(['user_id' => $request->id]);
            $vaccinationData  = $this->nurseRepository->getvaccinationdetails(['user_id' => $request->id]);
            $policeCheckVerificationData = $this->verificationRepository->getPoliceCheckVerificationData(['user_id' => $request->id]);
            $eligibilityToWorkData = $this->verificationRepository->getEligibilityToWorkData(['user_id' => $request->id]);
            $workingChildrenCheckData = $this->verificationRepository->getWorkingChildrenCheckData(['user_id' => $request->id]);
            $proMembershipData = $this->nurseRepository->getProMembershipData(['user_id' => $request->id]);
            $RefereData  = $this->nurseRepository->getReferedetails(['user_id' => $request->id]);
            return view('admin.edit-nurse', compact(
                'profileData',
                'experienceData',
                'policeCheckVerificationData',
                'eligibilityToWorkData',
                'workingChildrenCheckData',
                'educationData',
                'mandatorytrainingData',
                'interviewrefData',
                'personalprefData',
                'findworkData',
                'vaccinationData',
                'proMembershipData',
                'RefereData'
            ));
        } catch (\Exception $e) {
            log::error('Error in NurseController/EditNurse :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function EditNursePost(Request $request)
    {
        try {
            return $this->nurseServices->EditNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/EditNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            return $this->nurseServices->changeStatus($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/changeStatus :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function changeStatusDelete(Request $request)
    {
        try {
            return $this->nurseServices->changeStatusDelete($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/changeStatusDelete :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function changeStatusBlockUnblock(Request $request)
    {
        try {
            return $this->nurseServices->changeStatusBlockUnblock($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/changeStatusBlockUnblock :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deleteCertificateImg(Request $request)
    {
        $user_id = $request->user_id;
        $img = $request->img;

        $getEducationData = DB::table("user_education_cerification")->where("user_id", $user_id)->first();

        $gettransimg = json_decode($getEducationData->degree_transcript);



        $img_index = array_search($img, $gettransimg);

        array_splice($gettransimg, $img_index, 1);

        if (!empty($gettransimg)) {
            $tranimgData = json_encode($gettransimg);
        } else {
            $tranimgData = '';
        }

        $deleteData = EducationModel::where('user_id', $user_id)->update(['degree_transcript' => $tranimgData]);

        $destinationPath = public_path() . '/uploads/education_degree/' . $img;

        if (File::exists($destinationPath)) {
            File::delete($destinationPath);
        }

        if ($deleteData) {
            return 1;
        }
    }

    // for upload multiple  image
    public function UploadDegreeImg(Request $request)
    {
        $files = $request->file('upload_degree');
        $user_id = $request->user_id;

        // $getedudata = DB::table("user_education_cerification")->where("user_id",$user_id)->first();
        // $dtranaimg = json_decode($getedudata->degree_transcript);
        $dtranimgs = Helpers::multipleFileUpload($files, '');
        $run = EducationModel::where('user_id', $user_id)->update(['degree_transcript' => $dtranimgs]);
        // print_r( $run);die;
        return $dtranimgs;
    }

    public function deleteDegImg(Request $request)
    {
        $user_id = $request->user_id;
        $img = $request->img;

        $getEducationData = DB::table("user_education_cerification")->where("user_id", $user_id)->first();

        $gettransimg = json_decode($getEducationData->degree_transcript);



        $img_index = array_search($img, $gettransimg);

        array_splice($gettransimg, $img_index, 1);

        if (!empty($gettransimg)) {
            $tranimgData = json_encode($gettransimg);
        } else {
            $tranimgData = '';
        }



        $deleteData = EducationModel::where('user_id', $user_id)->update(['degree_transcript' => $tranimgData]);

        $destinationPath = public_path() . '/uploads/education_degree/' . $img;

        if (File::exists($destinationPath)) {
            File::delete($destinationPath);
        }

        if ($deleteData) {
            return 1;
        }

        //print_r($gettransimg);

    }

    public function uploadImgs(Request $request)
    {
        $files = $request->file('upload_images');
        $user_id = $request->user_id;
        $country_name = $request->country_name;
        $field_name = $request->field_name;
        //print_r($files);die;

        $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();
        //print_r($getedufieldsdata);die;
        if (empty($getedufieldsdata)) {
            $acls_img = Helpers::multipleFileUpload($files, '');
            $acls_data = array($country_name => $acls_img);
            $getImg_array = $acls_data;
            DB::table("edu_fields")->insert(["user_id" => $user_id, $field_name => json_encode($acls_data)]);
        } else {
            $getEdufieldsData1 = (array)$getedufieldsdata;
            $getImgfield = $getEdufieldsData1[$field_name];
            $getImg_array = (array)json_decode($getImgfield);

            if (array_key_exists($country_name, $getImg_array)) {
                $available_imgs = (array)json_decode($getImg_array[$country_name]);
                $acls_img = Helpers::multipleFileUpload($files, $available_imgs);
                $getImg_array[$country_name] = $acls_img;
                DB::table("edu_fields")->where("user_id", $user_id)->update([$field_name => json_encode($getImg_array)]);
            } else {
                $acls_img = Helpers::multipleFileUpload($files, '');
                $getImg_array[$country_name] = $acls_img;


                DB::table("edu_fields")->where("user_id", $user_id)->update([$field_name => json_encode($getImg_array)]);
            }
        }

        return $acls_img;
    }

    public function deleteImg1(Request $request)
    {
        $user_id = $request->user_id;
        $img = $request->img;
        $country_name = $request->country_name;
        $img_text = $request->img_text;

        $getEducationData = DB::table("edu_fields")->where("user_id", $user_id)->first();
        $getEducationData1 = (array)$getEducationData;
        $gettransimg = (array)json_decode($getEducationData1[$img_text]);
        $gettransimg1 = json_decode($gettransimg[$country_name]);

        $img_index = array_search($img, $gettransimg1);

        array_splice($gettransimg1, $img_index, 1);

        if (!empty($gettransimg1)) {
            $tranimgData = json_encode($gettransimg1);
        } else {
            $tranimgData = '';
        }

        $gettransimg[$country_name] = $tranimgData;

        if (!empty($gettransimg)) {
            $tranimgData1 = json_encode($gettransimg);
        } else {
            $tranimgData1 = '';
        }
        //print_r($gettransimg);die;
        $deleteData = DB::table("edu_fields")->where('user_id', $user_id)->update([$img_text => $tranimgData1]);

        $destinationPath = public_path() . '/uploads/education_degree/' . $img;

        if (File::exists($destinationPath)) {
            File::delete($destinationPath);
        }

        if ($deleteData) {
            return 1;
        }

        //print_r($gettransimg);

    }

    //for Mandatory Training
    public function uploadmantraImgs1(Request $request)
    {
        $files = $request->file('upload_images');
        $user_id = $request->user_id;
        $cat_name = $request->cat_name;
        $field_name = $request->field_name;
        // dd($field_name);die;  
        $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

        if (empty($getedufieldsdata)) {
            $acls_img = Helpers::multipleFileUpload($files, '');
            $acls_data = array($cat_name => $acls_img);
            $getImg_array = $acls_data;
            DB::table("edu_fields")->insert(["user_id" => $user_id, $field_name => json_encode($acls_data)]);
        } else {
            $getEdufieldsData1 = (array)$getedufieldsdata;
            $getImgfield = $getEdufieldsData1[$field_name];
            $getImg_array = (array)json_decode($getImgfield);

            if (array_key_exists($cat_name, $getImg_array)) {
                $available_imgs = (array)json_decode($getImg_array[$cat_name]);
                $acls_img = Helpers::multipleFileUpload($files, $available_imgs);
                $getImg_array[$cat_name] = $acls_img;
                DB::table("edu_fields")->where("user_id", $user_id)->update([$field_name => json_encode($getImg_array)]);
            } else {
                $acls_img = Helpers::multipleFileUpload($files, '');
                $getImg_array[$cat_name] = $acls_img;
                DB::table("edu_fields")->where("user_id", $user_id)->update([$field_name => json_encode($getImg_array)]);
            }
        }

        return $acls_img;
    }

    //for another Training
    public function uploadAnotherImgs(Request $request)
    {
        $files = $request->file('upload_images');
        $user_id = $request->user_id;
        $cat_name = $request->cat_name;
        $field_name = $request->field_name;
        // dd($field_name);die;  
        $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

        if (empty($getedufieldsdata)) {
            $acls_img = Helpers::multipleFileUpload($files, '');
            $acls_data = array($cat_name => $acls_img);
            $getImg_array = $acls_data;
            DB::table("edu_fields")->insert(["user_id" => $user_id, $field_name => json_encode($acls_data)]);
        } else {
            $getEdufieldsData1 = (array)$getedufieldsdata;
            $getImgfield = $getEdufieldsData1[$field_name];
            $getImg_array = (array)json_decode($getImgfield);

            if (array_key_exists($cat_name, $getImg_array)) {
                $available_imgs = (array)json_decode($getImg_array[$cat_name]);
                $acls_img = Helpers::multipleFileUpload($files, $available_imgs);
                $getImg_array[$cat_name] = $acls_img;
                DB::table("edu_fields")->where("user_id", $user_id)->update([$field_name => json_encode($getImg_array)]);
            } else {
                $acls_img = Helpers::multipleFileUpload($files, '');
                $getImg_array[$cat_name] = $acls_img;
                DB::table("edu_fields")->where("user_id", $user_id)->update([$field_name => json_encode($getImg_array)]);
            }
        }

        return $acls_img;
    }

    public function deleteAnoImg1(Request $request)
    {
        $user_id = $request->user_id;
        $img = $request->img;
        $country_name = $request->country_name;
        $img_text = $request->img_text;
        $getEducationData = DB::table("edu_fields")->where("user_id", $user_id)->first();
        $getEducationData1 = (array)$getEducationData;
        $gettransimg = (array)json_decode($getEducationData1[$img_text]);

        $gettransimg1 = json_decode($gettransimg[$country_name]);

        $img_index = array_search($img, $gettransimg1);

        array_splice($gettransimg1, $img_index, 1);

        if (!empty($gettransimg1)) {
            $tranimgData = json_encode($gettransimg1);
        } else {
            $tranimgData = '';
        }

        $gettransimg[$country_name] = $tranimgData;

        if (!empty($gettransimg)) {
            $tranimgData1 = json_encode($gettransimg);
            // echo $tranimgData1;die;
        } else {
            $tranimgData1 = '';
        }


        $deleteData = DB::table("edu_fields")->where('user_id', $user_id)->update([$img_text => $tranimgData1]);

        $destinationPath = public_path() . '/uploads/education_degree/' . $img;

        if (File::exists($destinationPath)) {
            File::delete($destinationPath);
        }

        if ($deleteData) {
            return 1;
        }

        //print_r($gettransimg);    
    }

    public function viewExpTab($id = null)
    {

        $experienceData  = "";
        if ($id) {

            $experienceData  = ExperienceModel::where('user_id', $id)->get();
        }

        return view('admin.experience-tab', compact('experienceData'));
    }

    public function Experienceupdate(Request $request)
    {

        // print_r(userid)
        // $userid = $request->input('user_exp_id');       
        $userid = $request->input('user_exp_id');
        $email = Session::get('nurseemail');
        //$user_id = User::where('email', $email)->first();
        // if ($user_id) {
        //     $userId = $user_id->id;
        // } else {
        //     $userId = $userid;
        // }
        $userId = $request->user_id;
        $facility_workplace_name = $request->facility_workplace_name;
        $nurseTypes = $request->input('nurseType', []);
        $nursingType1 = $request->input('nursing_type_1', []);
        $nursingType2 = $request->input('nursing_type_2', []);
        $nursingType3 = $request->input('nursing_type_3', []);
        $nurse_practitioner_menu = $request->input('nurse_practitioner_menu_experience', []);
        $specialties =  $request->input('specialties_experience', []);
        $speciality_entry_1 = $request->input('speciality_entry_experience_1', []);
        $speciality_entry_2 = $request->input('speciality_entry_experience_2', []);
        $speciality_entry_3 = $request->input('speciality_entry_experience_3', []);
        $speciality_entry_4 = $request->input('speciality_entry_experience_4', []);
        $surgical_row_box = $request->input('surgical_row_box_experience', []);
        $surgical_operative_care_1 = $request->input('surgical_operative_care_exp_1', []);
        $surgical_operative_care_2 = $request->input('surgical_operative_care_exp_2', []);
        $surgical_operative_care_3 = $request->input('surgical_operative_care_exp_3', []);
        $surgical_obs_care = $request->input('surgical_obs_care_exp', []);
        $neonatal_care = $request->input('neonatal_care_experience', []);
        $surgical_rowpad_box = $request->input('surgical_rowpad_box_experience', []);
        $surgical_operative_carep_1 =  $request->input('surgical_operative_carep_experience_1', []);
        $surgical_operative_carep_2 = $request->input('surgical_operative_carep_experience_2', []);
        $surgical_operative_carep_3 = $request->input('surgical_operative_carep_experience_3', []);
        $positions_held = $request->input('subpositions_held');

        $subwork = $request->input('subwork');
        
        $subpwork = $request->input('subworkthlevel');
        $start_date =  $request->input('start_date');
        $end_date = $request->input('end_date');
        $present_box = $request->input('present_box', []);
        $job_responeblities = $request->input('job_responeblities');
        $achievements =   $request->input('achievements');
        $employeement_type = $request->input('employeement_type');
        $skills_compantancies = $request->input('skills_compantancies', []);
        $type_of_evidence = $request->input('type_of_evidence', []);
        $level_of_exp = $request->input('exper_assistent_level', []);
        $permanent_status = $request->input('permanent_status');
        $evdience = $request->file('upload_evidence');
        $sub_skills_compantancies1 = $request->input('sub_skills_compantancies-8', []);
        $sub_skills_compantancies2 = $request->input('sub_skills_compantancies-9', []);
        $sub_skills_compantancies3 = $request->input('sub_skills_compantancies-10', []);
        $sub_skills_compantancies4 = $request->input('sub_skills_compantancies-11', []);
        $exp_id = $request->input('exp_id');
        $dec_status = $request->input('exp_declare_information');
        $oldfile = $request->input('old_file');

        //die;
        //Loop through nurse types and process them
        foreach ($nurseTypes as $key => $nurseType) {

            $evi1 = $evdience[$key] ?? null;
            $oldfile1 = $oldfile[$key] ?? null;
            $present_box1 = $present_box[$key] ?? null;

            if (isset($present_box1)) {
                $p_box = 1;
            } else {
                $p_box = 0;
            }

            $facility_workplace_name1 = $facility_workplace_name[$key] ?? null;
            $entryLevel = $nursingType1[$key] ?? null;
            $registered = $nursingType2[$key] ?? null;
            $advanced = $nursingType3[$key] ?? null;
            $specialties1 = $specialties[$key] ?? null;
            $nurse_practitioner_menu1 = $nurse_practitioner_menu[$key] ?? null;
            $speciality_entry_adult = $speciality_entry_1[$key] ?? null;
            $speciality_entry_maternity = $speciality_entry_2[$key] ?? null;
            $speciality_entry_paediatrics = $speciality_entry_3[$key] ?? null;
            $speciality_entry_community = $speciality_entry_4[$key] ?? null;
            $surgical_row_box1 = $surgical_row_box[$key] ?? null;
            $surgical_operative_care_1_1 = $surgical_operative_care_1[$key] ?? null;
            $surgical_operative_care_2_1 = $surgical_operative_care_2[$key] ?? null;
            $surgical_operative_care_3_1 = $surgical_operative_care_3[$key] ?? null;
            $surgical_obs_care_1 = $surgical_obs_care[$key] ?? null;
            $neonatal_care_1 = $neonatal_care[$key] ?? null;
            $surgical_rowpad_box_1 = $surgical_rowpad_box[$key] ?? null;
            $surgical_operative_carep_1_1 = $surgical_operative_carep_1[$key] ?? null;
            $surgical_operative_carep_2_1 = $surgical_operative_carep_2[$key] ?? null;
            $surgical_operative_carep_3_1 = $surgical_operative_carep_3[$key] ?? null;
            $positions_held1 = json_encode($positions_held[$key]) ?? null;
            $subpwork1 = json_encode($subpwork[$key]) ?? null;
            $start_date1 = $start_date[$key] ?? '0000-00-00';
            $end_date1 = $end_date[$key] ?? '0000-00-00';
            $job_responeblities1 = $job_responeblities[$key] ?? null;
            $achievements1 = $achievements[$key] ?? null;
            $employeement_type1 = $employeement_type[$key] ?? null;
            $skills_compantancies1 = $skills_compantancies[$key] ?? null;
            $type_of_evidence1 = $type_of_evidence[$key] ?? null;
            $level_of_exp1 = $level_of_exp[$key] ?? null;
            $permanent_status1 = $permanent_status[$key] ?? null;
            $temporary_status1 = $temporary_status[$key] ?? null;
            $sub_skills_compantancies1_1 = $sub_skills_compantancies1[$key] ?? null;
            $sub_skills_compantancies2_1 = $sub_skills_compantancies2[$key] ?? null;
            $sub_skills_compantancies3_1 = $sub_skills_compantancies3[$key] ?? null;
            $sub_skills_compantancies4_1 = $sub_skills_compantancies4[$key] ?? null;
            $exp_id_1 = $exp_id[$key] ?? null;
            if ($exp_id_1) {

                $checkdata = ExperienceModel::where('experience_id', $exp_id_1)->where('user_id', $userId)->first();
            } else {

                $checkdata  = "";
            }
            if ($checkdata != "") {
                $dtran = []; // Initialize the array to hold files

                // Check if evidence files exist and are valid
                if (isset($evi1) && !empty($evi1)) {

                    $oldfile2 = json_decode($oldfile1, true);

                    if ($oldfile1 != null) {

                        // Add old files if they exist
                        if (count($oldfile2) > 0) {
                            if (is_array($oldfile2)) {
                                $dtran = array_merge($dtran, $oldfile2); // Merge existing old files
                            } else {
                                $dtran[] = $oldfile1; // Add single old file if not in an array
                            }
                        }
                    }

                    // Process new evidence files
                    foreach ($evi1 as $dtrans) {
                        $destinationPath = public_path() . '/uploads/evidence';
                        $dtrans->move($destinationPath, $dtrans->getClientOriginalName());
                        $degree_transcript = $dtrans->getClientOriginalName();
                        $dtran[] = $degree_transcript;
                    }
                } else {

                    $oldfile2 = json_decode($oldfile1, true);
                    // Add old files if they exist
                    if (count($oldfile2) > 0) {
                        if (is_array($oldfile2)) {
                            $dtran = array_merge($dtran, $oldfile2); // Merge existing old files
                        } else {
                            $dtran[] = $oldfile1; // Add single old file if not in an array
                        }
                    }

                    // Process new evidence files
                    // foreach ($dtran as $dtrans) {
                    //     $destinationPath = public_path() . '/uploads/evidence';
                    //     $dtrans->move($destinationPath, $dtrans->getClientOriginalName());
                    //     $degree_transcript = $dtrans->getClientOriginalName();
                    //     $dtran[] = $degree_transcript;
                    // }
                }

                // If no files were added to $dtran, set it to null
                if (empty($dtran)) {
                    $dtran = [];
                }

                $run = ExperienceModel::where('experience_id', $exp_id_1)->update([
                    'facility_workplace_name' => $facility_workplace_name1,
                    'nurseType' => json_encode($nurseType),
                    'entry_level_nursing' => json_encode($entryLevel),
                    'registered_nurses' => json_encode($registered),
                    'advanced_practioner' => json_encode($advanced),
                    'nurse_prac' => json_encode($nurse_practitioner_menu1),
                    'specialties' => json_encode($specialties1),
                    'adults' => json_encode($speciality_entry_adult),
                    'maternity' => json_encode($speciality_entry_maternity),
                    'paediatrics_neonatal' => json_encode($speciality_entry_paediatrics),
                    'community' => json_encode($speciality_entry_community),
                    'surgical_preoperative' => json_encode($surgical_row_box1),
                    'operating_room' => json_encode($surgical_operative_care_1_1),
                    'operating_room_scout' => json_encode($surgical_operative_care_2_1),
                    'operating_room_scrub' => json_encode($surgical_operative_care_3_1),
                    'surgical_obstrics_gynacology' => json_encode($surgical_obs_care_1),
                    'pad_op_room' => json_encode($surgical_operative_carep_1_1),
                    'pad_qr_scout' => json_encode($surgical_operative_carep_2_1),
                    'pad_qr_scrub' => json_encode($surgical_operative_carep_3_1),
                    'neonatal_care' => json_encode($neonatal_care_1),
                    'paedia_surgical_preoperative' => json_encode($surgical_rowpad_box_1),
                    'position_held' => $positions_held1,
                    'facility_workplace_type' => $subpwork1,
                    'employeement_start_date' => $start_date1,
                    'employeement_end_date' => $end_date1,
                    'responsiblities' => $job_responeblities1,
                    'achievements' => $achievements1,
                    'employeement_type' => $employeement_type1,
                    'skills_compantancies' => json_encode($skills_compantancies1),
                    'evidence_type' => json_encode($type_of_evidence1),
                    'permanent_status' => $permanent_status1,
                    'temporary_status' => $temporary_status1,
                    'upload_evidence' => json_encode($dtran),
                    'sub_skills_compantancies' => json_encode($sub_skills_compantancies1),
                    'assistent_level' => $level_of_exp1,
                    'pre_box_status' => $p_box,
                    'inter_and_em_skill' => json_encode($sub_skills_compantancies1_1),
                    'lead_and_ment_skill' => json_encode($sub_skills_compantancies3_1),
                    'org_and_any_skill' => json_encode($sub_skills_compantancies2_1),
                    'tech_and_soft_pro' => json_encode($sub_skills_compantancies4_1),
                    'declaration_status' => $dec_status

                ]);
            } else {
                // echo "tewst";
                // die;

                if (isset($evi1) && is_iterable($evi1)) {
                    $dtran = []; // Initialize the array to hold file names

                    foreach ($evi1 as $dtrans) {
                        // Check if the individual file is valid
                        if ($dtrans->isValid()) {
                            $destinationPath = public_path() . '/uploads/evidence';
                            $dtrans->move($destinationPath, $dtrans->getClientOriginalName());
                            $degree_transcript = $dtrans->getClientOriginalName();
                            $dtran[] = $degree_transcript; // Add the file name to the array
                        }
                    }
                }
                $newExperience = new ExperienceModel();
                $newExperience->user_id = $userId;
                $newExperience->facility_workplace_name = $facility_workplace_name1;
                $newExperience->nurseType = json_encode($nurseType);
                $newExperience->entry_level_nursing = json_encode($entryLevel);
                $newExperience->registered_nurses = json_encode($registered);
                $newExperience->advanced_practioner = json_encode($advanced);
                $newExperience->nurse_prac = json_encode($nurse_practitioner_menu1);
                $newExperience->specialties = json_encode($specialties1);
                $newExperience->adults = json_encode($speciality_entry_adult);
                $newExperience->maternity = json_encode($speciality_entry_maternity);
                $newExperience->paediatrics_neonatal = json_encode($speciality_entry_paediatrics);
                $newExperience->community = json_encode($speciality_entry_community);
                $newExperience->surgical_preoperative = json_encode($surgical_row_box1);
                $newExperience->operating_room = json_encode($surgical_operative_care_1_1);
                $newExperience->operating_room_scout = json_encode($surgical_operative_care_2_1);
                $newExperience->operating_room_scrub = json_encode($surgical_operative_care_3_1);
                $newExperience->surgical_obstrics_gynacology = json_encode($surgical_obs_care_1);
                $newExperience->pad_op_room = json_encode($surgical_operative_carep_1_1);
                $newExperience->pad_qr_scout = json_encode($surgical_operative_carep_2_1);
                $newExperience->pad_qr_scrub = json_encode($surgical_operative_carep_3_1);
                $newExperience->neonatal_care = json_encode($neonatal_care_1);
                $newExperience->paedia_surgical_preoperative = json_encode($surgical_rowpad_box_1);
                $newExperience->position_held = $positions_held1;
                $newExperience->facility_workplace_type = $subpwork1;
                $newExperience->employeement_start_date = $start_date1;
                $newExperience->employeement_end_date = $end_date1;
                $newExperience->responsiblities = $job_responeblities1;
                $newExperience->achievements = $achievements1;
                $newExperience->employeement_type = $employeement_type1;
                $newExperience->skills_compantancies = json_encode($skills_compantancies1);
                $newExperience->evidence_type =  json_encode($type_of_evidence1);
                $newExperience->permanent_status = $permanent_status1;
                $newExperience->temporary_status = $temporary_status1;
                $newExperience->upload_evidence  = json_encode($dtran);
                $newExperience->sub_skills_compantancies = json_encode($sub_skills_compantancies1);
                $newExperience->assistent_level = $level_of_exp1;
                $newExperience->pre_box_status = $p_box;
                $newExperience->complete_status = 1;
                $newExperience->inter_and_em_skill = json_encode($sub_skills_compantancies1_1);
                $newExperience->org_and_any_skill = json_encode($sub_skills_compantancies2_1);
                $newExperience->lead_and_ment_skill = json_encode($sub_skills_compantancies3_1);
                $newExperience->tech_and_soft_pro = json_encode($sub_skills_compantancies4_1);
                $newExperience->declaration_status = $dec_status;

                $run = $newExperience->save();
            }
            $param = 'Experience and References';
        }

        if ($run) {
            return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => $param])]);
        } else {
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }



        echo json_encode($json);
    }

    public function addNurseVaccination(Request $request)
    {
        try {
            $email = Session::get('nurseemail');
            $user = User::where('email', $email)->first();
            $user_id                = $user->id;
            $vaccination_names      = $request->input('vaccination_name', []);
            $immunization_statuses  = $request->input('immunization_status', []);
            $evidence_types         = $request->input('evidence_type', []);
            $evidence_files         = $request->file('evidence_file', []);
            if (!empty($vaccination_names)) {
                if (count($vaccination_names) > 0) {
                    for ($i = 0; $i < count($vaccination_names); $i++) {
                        $vaccine = new OtherVaccineModel();
                        $vaccine->user_id = $user_id;
                        $vaccine->vaccination_name = $vaccination_names[$i];
                        $vaccine->immunization_status = $immunization_statuses[$i];
                        $vaccine->evidence_type = $evidence_types[$i];


                        if (isset($evidence_files[$i]) && $evidence_files[$i]->isValid()) {
                            $filename = 'evidence_file_' . time() . '.' . $evidence_files[$i]->getClientOriginalExtension();
                            $destinationPath = public_path() . '/uploads/evidence';
                            $evidence_files[$i]->move($destinationPath, $filename);

                            $vaccine->evidence_file = $filename;
                        }
                        $run = $vaccine->save();
                    }
                }
            }
            /**********[Vaccination Record Start]*************/
            $vaccination_record = json_decode($request->vaccination_record);
            $imm_status_status  = $request->imm_status_status;
            $covid_dose         = $request->covid_dose;
            $evidence_required  = $request->evidence_required;
            $evidancefile       = $request->evidancefile;



            if (!empty($vaccination_record)) {
                //Now add / update the vaccinaion record
                if (count($vaccination_record) > 0) {
                    foreach ($vaccination_record as $vaccination) {
                        $fvcc = new VaccinationFrontModel();
                        $fvcc->user_id = $user_id;


                        $fvcc->vaccination_id       = $vaccination;
                        $fvcc->immunization_status  = $imm_status_status[$vaccination][0];
                        $fvcc->evidance_type        = $evidence_required[$vaccination][0] ?? '';
                        $fvcc->covid_dose           = $covid_dose[$vaccination] ?? '';

                        $fvcc->save();
                        $vcc_id = $run = $fvcc->id;

                        if ($request->hasFile('evidancefile' . $vaccination)) {
                            foreach ($request->file('evidancefile' . $vaccination) as $file) {
                                $originalName = $file->getClientOriginalName();
                                $filename = 'evidence_file_' . time() . '.' . $file->getClientOriginalExtension();
                                $destinationPath = public_path() . '/uploads/evidence';
                                $file->move($destinationPath, $filename);

                                $evid                   = new EvidanceFileModel();
                                $evid->vcc_front_id     = $vcc_id;
                                $evid->original_name    = $originalName;
                                $evid->file_name        = $filename;
                                $evid->created_at       = date('Y-m-d H:i:s');
                                $run = $evid->save();
                            }
                        }
                    }
                }
            }

            $param = 'Vaccination Records';

            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => $param])]);
            } else {
                return response()->json(['status' => '0', 'message111' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {


            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0111', 'message' => __('message.statusZero')]);
        }
    }

    public function updateVaccinationRecord(Request $request)
    {
        //This function is for update the nurse vaccination record

        $other_vaccine = DB::table("other_vaccine")->where("user_id", $request->id)->get();
        $vaccinationData = DB::table("vaccination_front")->where("user_id", $request->id)->get();
        $vaccination_record = DB::table("vaccination")->get();


        $profileData  = $this->nurseRepository->getOneUser(['id' => $request->id]);

        return view('admin.update_vaccination_record', compact(
            'profileData',
            'vaccinationData',
            'vaccination_record',
            'other_vaccine'
        ));
    }
    public function getVaccinationData(Request $request)
    {

        //This function is for getting the user's vaccination data
        $user_id = $request->user_id;
        $id = $request->id;

        $vaccination = DB::table('vaccination')->where('id', $id)->first();
        $vcc_level_req = DB::table("vcc_level_req")->where('type', $id)->get();
        $imm_status = DB::table("imm_status")->get();
        $evidence_types = DB::table("evidence_type")->where('type', $id)->get();

        $getvaccinationdata = DB::table("vaccination_front")->where("user_id", $user_id)->where("vaccination_id", $id)->first();

        // If no data is found, return an empty response
        if (!$vaccination) {
            return response()->json(['html' => '']);
        }

        // Generate the HTML content for the vaccination record
        $html = view('admin.vaccination_record', [
            'id' => $id,
            'vaccination' => $vaccination,
            'vcc_level_req' => $vcc_level_req,
            'imm_status' => $imm_status,
            'evidence_types' => $evidence_types,
            'vaccination_data' => $getvaccinationdata
        ])->render();

        return response()->json(['html' => $html]);
    }
    public function removeEvidanceFile(Request $request)
    {
        //This function is for remove the vaccination file only
        $id = $request->id;

        $vaccine = EvidanceFileModel::find($id);

        if ($vaccine) {
            $filePath = 'uploads/evidence/' . $vaccine->file_name;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
            $vaccine->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Vaccine not found']);
    }

    public function removeEvidance(Request $request)
    {
        $id = $request->id;

        $vaccine = OtherVaccineModel::find($id);

        if ($vaccine) {
            $filePath = 'uploads/evidence/' . $vaccine->evidence_file;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
            $vaccine->evidence_file = null;
            $vaccine->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Vaccine not found']);
    }

    public function removeVaccine(Request $request)
    {
        //This function is for remove vaccine from other vaccine
        $id = $request->id;

        $vaccine = OtherVaccineModel::find($id);

        if ($vaccine) {
            $filePath = 'uploads/evidence/' . $vaccine->evidence_file;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
            $vaccine->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Vaccine not found']);
    }

    public function updateNurseVaccination(Request $request)
    {
        //This function is for add / update nurse vaccination data
        try {
            $user_id                = $request->user_id;
            /**[Other Vaccine Start]**/
            $other_ids              = $request->input('other_id', []);
            $vaccination_names      = $request->input('vaccination_name', []);
            $immunization_statuses  = $request->input('immunization_status', []);
            $evidence_types         = $request->input('evidence_type', []);
            $evidence_files         = $request->file('evidence_file', []);

            for ($i = 0; $i < count($vaccination_names); $i++) {
                if (isset($other_ids[$i])) {
                    $vaccine = OtherVaccineModel::find($other_ids[$i]);
                    if ($vaccine) {
                        $vaccine->vaccination_name = $vaccination_names[$i];
                        $vaccine->immunization_status = $immunization_statuses[$i];
                        $vaccine->evidence_type = $evidence_types[$i];


                        if (isset($evidence_files[$i]) && $evidence_files[$i]->isValid()) {
                            $filename = 'evidence_file_' . time() . '.' . $evidence_files[$i]->getClientOriginalExtension();
                            $destinationPath = public_path() . '/uploads/evidence';
                            $evidence_files[$i]->move($destinationPath, $filename);
                            $vaccine->evidence_file = $filename;
                        }
                        $vaccine->save();
                    }
                } else {
                    $vaccine = new OtherVaccineModel();
                    $vaccine->user_id = $user_id;
                    $vaccine->vaccination_name = $vaccination_names[$i];
                    $vaccine->immunization_status = $immunization_statuses[$i];
                    $vaccine->evidence_type = $evidence_types[$i];


                    if (isset($evidence_files[$i]) && $evidence_files[$i]->isValid()) {
                        $filename = 'evidence_file_' . time() . '.' . $evidence_files[$i]->getClientOriginalExtension();
                        $destinationPath = public_path() . '/uploads/evidence';
                        $evidence_files[$i]->move($destinationPath, $filename);

                        $vaccine->evidence_file = $filename;
                    }
                    $vaccine->save();
                }
            }
            /**[Other Vaccine End]**/

            /**********[Vaccination Record Start]*************/
            $vaccination_record = $request->vaccination_id;
            $imm_status_status  = $request->imm_status_status;
            $covid_dose         = $request->covid_dose;
            $evidence_required  = $request->evidence_required;
            $evidancefile       = $request->evidancefile;
            $record_id          = $request->record_id;


            if (!empty($vaccination_record)) {
                //Now delete the vaccination record which is not for update or add
                $selectedVaccinationIds = $request->input('vaccination_id', []);
                $selectedVaccinationIds = array_map('intval', $selectedVaccinationIds);

                $old_vals = DB::table('vaccination_front')
                    ->where('user_id', $user_id)
                    ->whereNotIn('vaccination_id', $selectedVaccinationIds)
                    ->get();

                if (!empty($old_vals)) {
                    foreach ($old_vals as $values) {
                        // Now remove the evidence for the old vaccination record
                        $id = $values->id;

                        // Get all evidence records with vcc_front_id matching the old vaccination record
                        $evidence = EvidanceFileModel::where('vcc_front_id', $id)->get();

                        if ($evidence->isNotEmpty()) {
                            foreach ($evidence as $ev_files) {
                                $filePath = 'uploads/evidence/' . $ev_files->file_name;

                                if (Storage::exists($filePath)) {
                                    Storage::delete($filePath);
                                }
                                $ev_files->delete();
                            }
                        }
                    }

                    //Now remove the vaccination record
                    DB::table('vaccination_front')
                        ->where('user_id', $user_id)
                        ->whereNotIn('vaccination_id', $selectedVaccinationIds)
                        ->delete();
                }

                //Now add / update the vaccinaion record

                if (count($vaccination_record) > 0) {
                    foreach ($vaccination_record as $vaccination) {
                        if ($record_id[$vaccination][0] != '') {
                            VaccinationFrontModel::where('id', $record_id[$vaccination][0])
                                ->update([
                                    'immunization_status' => $imm_status_status[$vaccination][0],
                                    'evidance_type' => $evidence_required[$vaccination][0] ?? '',
                                    'covid_dose' => $covid_dose[$vaccination] ?? ''
                                ]);

                            if ($request->hasFile('evidancefile' . $vaccination)) {
                                foreach ($request->file('evidancefile' . $vaccination) as $file) {
                                    $originalName = $file->getClientOriginalName();
                                    $filename = 'evidence_file_' . time() . '.' . $file->getClientOriginalExtension();
                                    $destinationPath = public_path() . '/uploads/evidence';
                                    $file->move($destinationPath, $filename);

                                    $evid                   = new EvidanceFileModel();
                                    $evid->vcc_front_id     = $record_id[$vaccination][0];
                                    $evid->original_name    = $originalName;
                                    $evid->file_name        = $filename;
                                    $evid->created_at       = date('Y-m-d H:i:s');
                                    $evid->save();
                                }
                            }
                        } else {

                            $fvcc = new VaccinationFrontModel();
                            $fvcc->user_id = $user_id;


                            $fvcc->vaccination_id       = $vaccination;
                            $fvcc->immunization_status  = $imm_status_status[$vaccination][0];
                            $fvcc->evidance_type        = $evidence_required[$vaccination][0] ?? '';
                            $fvcc->covid_dose           = $covid_dose[$vaccination] ?? '';

                            $fvcc->save();
                            $vcc_id = $fvcc->id;

                            if ($request->hasFile('evidancefile' . $vaccination)) {
                                foreach ($request->file('evidancefile' . $vaccination) as $file) {
                                    $originalName = $file->getClientOriginalName();
                                    $filename = 'evidence_file_' . time() . '.' . $file->getClientOriginalExtension();
                                    $destinationPath = public_path() . '/uploads/evidence';
                                    $file->move($destinationPath, $filename);

                                    $evid                   = new EvidanceFileModel();
                                    $evid->vcc_front_id     = $vcc_id;
                                    $evid->original_name    = $originalName;
                                    $evid->file_name        = $filename;
                                    $evid->created_at       = date('Y-m-d H:i:s');
                                    $evid->save();
                                }
                            }
                        }
                    }
                }
            }
            $param = 'Vaccination Records';
            return response()->json(['status' => '2', 'message' => __('message.UpdateOne', ['parameter' => $param])]);
        } catch (\Exception $e) {
            log::error('Error in NurseController/EditNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function getSkillsData(Request $request)
    {

        $id = $request->id;
        $skills = DB::table("skills")->where("parent_id", $id)->get();
        $skills_name = DB::table("skills")->where("id", $id)->first();
        $skills_array = array();
        foreach ($skills as $skills1) {
            $skills_array[] = array("parent_id" => $id, "parent_name" => $skills_name->name, "id" => $skills1->id, "name" => $skills1->name);
        }
        return json_encode($skills_array);
    }

    public function viewManTraTab($id = null)
    {
        $trainingData = "";
        if ($id) {
            $trainingData  = MandatoryTrainModel::where('user_id', $id)->first();
        }
        return view('admin.man-tra-tab', compact('trainingData'));
    }

    public function ManTraupdate(Request $request)
    {

        $email = Session::get('nurseemail');
        $user_id = User::where('email', $email)->first();
        if ($user_id) {
            $user_id = $user_id->id;
        } else {
        }
        $new_user_id = $request->new_user_id;
        // else {
        //     $userId = $userid;
        // }
        // $user_id = $request->user_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $institution = $request->institution;
        $mand_continue_education = $request->mand_continue_education;
        $mand_training = $request->mandatory_courses;
        $mand_education = $request->mandatory_education;
        $declare_information_man = $request->input('declare_information_man');
        $gettrainingdata = DB::table("mandatory_training")->where("user_id", $user_id)->first();
        $training_name = $request->training;
        $training_ins = $request->institution;
        $training_start_date = $request->tra_start_date;
        $training_end_date = $request->tra_end_date;
        $tra_exp = $request->tra_expiry;
        $other_tra_array = array();
        if (!empty($training_name)) {
            for ($i = 0; $i < count($training_name); $i++) {

                $other_tra_array[] = array("other_tra_id" => $i + 1, "training_name" => $training_name[$i], "training_ins" => $training_ins[$i], "training_start_date" => $training_start_date[$i], "training_end_date" => $training_end_date[$i], "tra_exp" => $tra_exp[$i]);
            }

            $other_tra_json = json_encode($other_tra_array);
        } else {
            $other_tra_json = '';
        }


        $education_name = $request->education;
        $education_ins = $request->institution;
        $education_start_date = $request->start_date;
        $education_end_date = $request->end_date;
        $education_exp = $request->edu_expiry;
        $education_status = $request->edu_expiry;

        $other_edu_array = array();
        if (!empty($education_name)) {
            for ($i = 0; $i < count($education_name); $i++) {
                $other_edu_array[] = array("other_edu_id" => $i + 1, "education_name" => $education_name[$i], "education_ins" => $education_ins[$i], "education_start_date" => $education_start_date[$i], "education_end_date" => $education_end_date[$i], "education_exp" => $education_exp[$i], "education_status" => $education_status[$i]);
            }

            $other_edu_json = json_encode($other_edu_array);
        } else {
            $other_edu_json = '';
        }


        $well_data = $request->well_self_care_data;
        if ($well_data) {
            $well_count = count($well_data);
        } else {
            $well_count = 0;
        }
        $wellnamearr = $request->wellnamearr;
        $well_institution = $request->well_institution;
        $well_tra_start_date = $request->well_tra_start_date;
        $well_tra_end_date = $request->well_tra_end_date;
        $well_expiry = $request->well_expiry;

        $well_self_array = array();
        // $training_data = json_decode($gettrainingdata->well_sel_data);

        for ($i = 0; $i < $well_count; $i++) {

            $well_self_array[] = array("well_tra_id" => $wellnamearr[$i], "well_institution" => $well_institution[$i], "well_tra_start_date" => $well_tra_start_date[$i], "well_tra_end_date" => $well_tra_end_date[$i], "well_expiry" => $well_expiry[$i]);
        }

        if (!empty($well_self_array)) {
            $well_data_json = json_encode($well_self_array);
        } else {
            $well_data_json = '';
        }

        // training sec
        // if (!empty($tech_innvo_array)) {
        //     $lead_data_json = json_encode($lead_pro_array);
        // } else {
        //     $lead_data_json = '';
        // }

        $tech_innvo_data = $request->tech_innvo_health_data;
        if ($tech_innvo_data) {
            $tech_innvo_count = count($tech_innvo_data);
        } else {
            $tech_innvo_count = 0;
        }
        $techinnvonamearr = $request->techinnvonamearr;
        $tech_institution = $request->tech_innvo_institution;
        $tech_start_date = $request->tech_innvo_tra_start_date;
        $tech_end_date = $request->tech_innvo_tra_end_date;
        $tech_expiry = $request->tech_innvo_expiry;
        $tech_innvo_array = array();
        // $training_data = json_decode($gettrainingdata->tech_innvo_data);

        for ($i = 0; $i < $tech_innvo_count; $i++) {
            // if(!empty($training_data) && array_key_exists($i,$training_data)){
            //     $aclsimg = json_decode($certificate_data[$i]->acls_upload_certification);
            // }else{
            //     $aclsimg = '';
            // }
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            // if(!empty($acls_upload_certification[$i])){
            //     $acls_img = Helpers::multipleFileUpload($acls_upload_certification[$i],$aclsimg);
            // }else{
            //     $acls_img = Helpers::multipleFileUpload('',$aclsimg);
            // }
            //echo $acls_img;        
            $tech_innvo_array[] = array("tech_tra_id" => $techinnvonamearr[$i], "tech_institution" => $tech_institution[$i], "tech_start_date" => $tech_start_date[$i], "tech_end_date" => $tech_end_date[$i], "tech_expiry" => $tech_expiry[$i]);
        }

        if (!empty($tech_innvo_array)) {
            $tech_data_json = json_encode($tech_innvo_array);
        } else {
            $tech_data_json = '';
        }

        // thired
        $lead_pro_data = $request->leader_pro_dev_data;
        if ($lead_pro_data) {
            $lead_pro_count = count($lead_pro_data);
        } else {
            $lead_pro_count = 0;
        }
        $leaderpronamearr = $request->leaderpronamearr;
        $lead_pro_institution = $request->leader_pro_institution;
        $lead_pro_start_date = $request->leader_pro_tra_start_date;
        $lead_pro_end_date = $request->leader_pro_tra_end_date;
        $leader_pro_expiry = $request->leader_pro_expiry;
        $lead_pro_array = array();
        // $training_data = json_decode($gettrainingdata->leader_pro_data);

        for ($i = 0; $i < $lead_pro_count; $i++) {
            // if(!empty($training_data) && array_key_exists($i,$training_data)){
            //     $aclsimg = json_decode($certificate_data[$i]->acls_upload_certification);
            // }else{
            //     $aclsimg = '';
            // }
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            // if(!empty($acls_upload_certification[$i])){
            //     $acls_img = Helpers::multipleFileUpload($acls_upload_certification[$i],$aclsimg);
            // }else{
            //     $acls_img = Helpers::multipleFileUpload('',$aclsimg);
            // }
            //echo $acls_img;        
            $lead_pro_array[] = array("lead_pro_tra_id" => $leaderpronamearr[$i], "lead_pro_institution" => $lead_pro_institution[$i], "lead_start_date" => $lead_pro_start_date[$i], "lead_end_date" => $lead_pro_end_date[$i], "lead_expiry" => $leader_pro_expiry[$i]);
        }

        if (!empty($lead_pro_array)) {
            $lead_data_json = json_encode($lead_pro_array);
        } else {
            $lead_data_json = '';
        }


        // fourth      

        $mid_spec_tra_data = $request->mid_spec_tra_data;
        if ($mid_spec_tra_data) {
            $mid_spec_count = count($mid_spec_tra_data);
        } else {
            $mid_spec_count = 0;
        }


        $midspecnamearr = $request->midspecnamearr;
        $mid_spec_institution = $request->mid_spec_institution;
        $mid_spec_tra_start_date = $request->mid_spec_tra_start_date;
        $mid_spec_tra_end_date = $request->mid_spec_tra_end_date;
        $mid_spec_expiry = $request->mid_spec_expiry;
        $mid_spec_array = array();
        // $training_data = json_decode($gettrainingdata->mid_spec_data);



        for ($i = 0; $i < $mid_spec_count; $i++) {

            // if(!empty($training_data) && array_key_exists($i,$training_data)){
            //     $aclsimg = json_decode($certificate_data[$i]->acls_upload_certification);
            // }else{
            //     $aclsimg = '';
            // }
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            // if(!empty($acls_upload_certification[$i])){
            //     $acls_img = Helpers::multipleFileUpload($acls_upload_certification[$i],$aclsimg);
            // }else{
            //     $acls_img = Helpers::multipleFileUpload('',$aclsimg);
            // }
            //echo $acls_img;        
            $mid_spec_array[] = array("mid_spec_tra_id" => $midspecnamearr[$i], "mid_spec_institution" => $mid_spec_institution[$i], "mid_spec_start_date" => $mid_spec_tra_start_date[$i], "mid_spec_end_date" => $mid_spec_tra_end_date[$i], "mis_spec_expiry" => $mid_spec_expiry[$i]);
        }
        if (!empty($mid_spec_array)) {
            $mid_data_json = json_encode($mid_spec_array);
        } else {
            $mid_data_json = '';
        }


        // fifth
        $cli_skill_data = $request->clinic_skill_core_data;
        if ($cli_skill_data) {
            $cli_skill_count = count($cli_skill_data);
        } else {
            $cli_skill_count = 0;
        }
        $clinicskillnamearr = $request->clinicskillnamearr;
        $clinic_skill_institution = $request->clinic_skill_institution;
        $clinic_skill_tra_start_date = $request->clinic_skill_tra_start_date;
        $clinic_skill_tra_end_date = $request->clinic_skill_tra_end_date;
        $clinic_skill_expiry = $request->clinic_skill_expiry;
        $cli_skill_array = array();
        // $training_data = json_decode($gettrainingdata->clinic_skill_data);

        for ($i = 0; $i < $cli_skill_count; $i++) {
            $cli_skill_array[] = array("cli_skill_tra_id" => $clinicskillnamearr[$i], "clinic_skill_institution" => $clinic_skill_institution[$i], "cli_skill_start_date" => $clinic_skill_tra_start_date[$i], "cli_skill_end_date" => $clinic_skill_tra_end_date[$i], "cli_skill_expiry" => $clinic_skill_expiry[$i]);
        }

        if (!empty($cli_skill_array)) {
            $cli_skill_data_json = json_encode($cli_skill_array);
        } else {
            $cli_skill_data_json = '';
        }

        //man education
        $emerging_data = $request->emerging_topic;
        if ($emerging_data) {
            $emerging_count = count($emerging_data);
        } else {
            $emerging_count = 0;
        }
        $emetopicarr = $request->emetopicarr;
        $eme_topic_institution = $request->eme_topic_institution;
        $eme_topic_start_date = $request->eme_topic_start_date;
        $eme_topic_end_date = $request->eme_topic_end_date;
        $eme_topic_status = $request->eme_topic_status;
        $eme_topic_expiry = $request->eme_topic_expiry;

        $emerging_array = array();
        // $edu_data = json_decode($gettrainingdata->emerg_topic_data);

        for ($i = 0; $i < $emerging_count; $i++) {
            $emerging_array[] = array("emr_edu_id" => $emetopicarr[$i], "eme_topic_institution" => $eme_topic_institution[$i], "eme_topic_start_date" => $eme_topic_start_date[$i], "eme_topic_end_date" => $eme_topic_end_date[$i], "eme_topic_expiry" => $eme_topic_expiry[$i], "eme_topic_status" => $eme_topic_status[$i],);
        }

        if (!empty($emerging_array)) {
            $eme_data_json = json_encode($emerging_array);
        } else {
            $eme_data_json = '';
        }


        $safety_com_data = $request->safety_com;
        if ($safety_com_data) {
            $safety_com_count = count($safety_com_data);
        } else {
            $safety_com_count = 0;
        }
        $safetycomaarr = $request->safetycomaarr;
        $safety_com_institution = $request->safety_com_institution;
        $safety_com_start_date = $request->safety_com_start_date;
        $safety_com_end_date = $request->safety_com_end_date;
        $safety_com_status = $request->safety_com_status;
        $safety_com_expiry = $request->safety_com_expiry;

        $safety_com_array = array();
        // $safety_com_data = json_decode($gettrainingdata->safety_com_data);

        for ($i = 0; $i < $safety_com_count; $i++) {
            $safety_com_array[] = array("saf_edu_id" => $safetycomaarr[$i], "safety_com_institution" => $safety_com_institution[$i], "safety_com_start_date" => $safety_com_start_date[$i], "safety_com_end_date" => $safety_com_end_date[$i], "safety_com_expiry" => $safety_com_expiry[$i], "safety_com_status" => $safety_com_status[$i],);
        }

        if (!empty($safety_com_array)) {
            $safety_data_json = json_encode($safety_com_array);
        } else {
            $safety_data_json = '';
        }


        $spec_area_data = $request->spec_area;
        if ($spec_area_data) {
            $spec_area_count = count($spec_area_data);
        } else {
            $spec_area_count = 0;
        }
        $specareaarr = $request->specareaarr;
        $spec_area_institution = $request->spec_area_institution;
        $spec_area_start_date = $request->spec_area_start_date;
        $spec_area_end_date = $request->spec_area_end_date;
        $spec_area_status = $request->spec_area_status;
        $spec_area_expiry = $request->spec_area_expiry;

        $spec_area_array = array();
        // $spec_data = json_decode($gettrainingdata->spec_area_data);

        for ($i = 0; $i < $spec_area_count; $i++) {
            $spec_area_array[] = array("spec_edu_id" => $specareaarr[$i], "spec_area_institution" => $spec_area_institution[$i], "spec_area_start_date" => $spec_area_start_date[$i], "spec_area_end_date" => $spec_area_end_date[$i], "spec_area_expiry" => $spec_area_expiry[$i], "spec_area_status" => $spec_area_status[$i],);
        }

        if (!empty($spec_area_array)) {
            $spec_area_json = json_encode($spec_area_array);
        } else {
            $spec_area_json = '';
        }


        $mid_spe_data = $request->mid_spe_mandotry;
        if ($mid_spe_data) {
            $mid_spe_count = count($mid_spe_data);
        } else {
            $mid_spe_count = 0;
        }
        $midspearr = $request->midspearr;
        $mid_spe_institution = $request->mid_spe_institution;
        $mid_spe_start_date = $request->mid_spe_start_date;
        $mid_spe_end_date = $request->mid_spe_end_date;
        $mid_spe_status = $request->mid_spe_status;
        $mid_spe_expiry = $request->mid_spe_expiry;

        $mid_spe_array = array();
        // $mid_data = json_decode($gettrainingdata->mid_spe_data);

        for ($i = 0; $i < $mid_spe_count; $i++) {
            $mid_spe_array[] = array("mid_spe_edu_id" => $midspearr[$i], "mid_spe_institution" => $mid_spe_institution[$i], "mid_spe_start_date" => $mid_spe_start_date[$i], "mid_spe_end_date" => $mid_spe_end_date[$i], "mid_spe_expiry" => $mid_spe_expiry[$i], "mid_spe_status" => $mid_spe_status[$i],);
        }

        if (!empty($mid_spe_array)) {
            $mid_spe_json = json_encode($mid_spe_array);
        } else {
            $mid_spe_json = '';
        }


        $core_man_data = $request->core_man_con_data;
        if ($core_man_data) {
            $core_man_count = count($core_man_data);
        } else {
            $core_man_count = 0;
        }
        $coremanarr  = $request->coremanarr;
        $core_man_institution = $request->core_man_institution;
        $coreman_start_date = $request->coreman_start_date;
        $coreman_end_date = $request->coreman_end_date;
        $coreman_status = $request->coreman_status;
        $core_man_expiry = $request->core_man_expiry;

        $core_man_array = array();
        // $core_man_data = json_decode($gettrainingdata->core_man_data);

        for ($i = 0; $i < $core_man_count; $i++) {
            $core_man_array[] = array("core_man_edu_id" => $coremanarr[$i], "core_man_institution" => $core_man_institution[$i], "coreman_start_date" => $coreman_start_date[$i], "coreman_end_date" => $coreman_end_date[$i], "core_man_expiry" => $core_man_expiry[$i], "coreman_status" => $coreman_status[$i],);
        }

        if (!empty($core_man_array)) {
            $core_man_json = json_encode($core_man_array);
        } else {
            $core_man_json = '';
        }


        // dd($declare_information_man);

        // $gettrainingdata = DB::table("mandatory_training")->where("user_id",$user_id)->first();
        //$post = User::find($request->user_id);

        if (!empty($new_user_id)) {
            $run = MandatoryTrainModel::where('user_id', $new_user_id)->update([
                'start_date' => $start_date,
                'end_date' => $end_date,
                'institutions' => $institution,
                'continuing_education' => $mand_continue_education,
                'well_sel_data' => $well_data_json,
                'tech_innvo_data' => $tech_data_json,
                'leader_pro_data' => $lead_data_json,
                'mid_spec_data' => $mid_data_json,
                'clinic_skill_data' => $cli_skill_data_json,
                'other_tra_data' => $other_tra_json,
                'man_training'    => json_encode($mand_training),
                'man_education'    => json_encode($mand_education),
                'emerg_topic_data'    => $eme_data_json,
                'safety_com_data' => $safety_data_json,
                'spec_area_data' => $spec_area_json,
                'mid_spe_data'   => $mid_spe_json,
                'core_man_data' => $core_man_json,
                'other_edu_data' => $other_edu_json,
                'declaration_status' =>  $declare_information_man,
            ]);
        } else {
            $post = new MandatoryTrainModel();
            $post->user_id = $user_id;
            $post->start_date   = $start_date;
            $post->end_date     = $end_date;
            $post->institutions = $institution;
            $post->continuing_education = $mand_continue_education;
            $post->well_sel_data = $well_data_json;
            $post->tech_innvo_data = $tech_data_json;
            $post->leader_pro_data = $lead_data_json;
            $post->mid_spec_data = $mid_data_json;
            $post->clinic_skill_data = $cli_skill_data_json;
            $post->other_tra_data = $other_tra_json;
            $post->man_training   = json_encode($mand_training);
            $post->man_education    = json_encode($mand_education);
            $post->emerg_topic_data    = $eme_data_json;
            $post->safety_com_data = $safety_data_json;
            $post->spec_area_data = $spec_area_json;
            $post->mid_spe_data = $mid_spe_json;
            $post->core_man_data = $core_man_json;
            $post->other_edu_data = $other_edu_json;
            $post->declaration_status = $declare_information_man;

            $run = $post->save();
        }
        $param = 'Mandatory Training';

        if ($run) {
            return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => $param])]);
        } else {
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }



        echo json_encode($json);
    }

    public function updateWorkClreance(Request $request)
    {
        //This function is for update the work clearance
        $user_id=$request->id;
        if(!$user_id)
        {
            $email = Session::get('nurseemail');
            if($email!='')
            {
                $user = User::where('email', $email)->first();
                $user_id                = $user->id;
            }
        }
        
        $visaSubclasses = SubClassModel::where('residence_id', 2) 
                ->orderBy('id') 
                ->get()
                ->groupBy('subclass_head'); 
        $visaholderSubclasses = SubClassModel::where('residence_id', 3) 
                ->orderBy('id') 
                ->get();

        $work_eligibility   = EligibilityToWorkModel::where('user_id', $user_id)->first();                     
        $ndis               = NdisWorker::where('user_id', $user_id)->first();              
        $ww_child           = WorkingChildrenCheckModel::where('user_id', $user_id)->get();
        $policy_check       = PoliceCheckModel::where('user_id', $user_id)->first();
        $specialize         = SpecializedClearance::where('user_id', $user_id)->get();

        $profileData  = $this->nurseRepository->getOneUser(['id' => $user_id]);
        
        
        return view('admin.check_clearance',compact('profileData',
                    'visaSubclasses',
                    'visaholderSubclasses',
                    'work_eligibility',
                    'ndis','ww_child',
                    'policy_check',
                    'specialize' ));
    }
    public function update_eligibility_to_work(Request $request)
    {
        //This function is for update the eligibility to work for nurse
        $user_id=$request->user_id;
        if(!$user_id)
        {
            $email = Session::get('nurseemail');
            if($email!='')
            {
                $user = User::where('email', $email)->first();
                $user_id                = $user->id;
            }
        }
        

        $lastRecord = EligibilityToWorkModel::where('user_id', $user_id)->first();
        if($lastRecord)
        {
            $professioninsert['original_file_name'] = $lastRecord['original_file_name'];
            $professioninsert['support_document']=$lastRecord['support_document'];

            $lastRecord->delete();
        }
        $professioninsert['user_id'] =  $user_id;
        $professioninsert['residency'] = $request->residency;

        if($request->evidence_type!='')
        {
            $professioninsert['evidence_type'] = $request->evidence_type;
        }
        if($request->evidence_type1!='')
        {
            $professioninsert['evidence_type'] = $request->evidence_type1;
        }
        if($request->evidence_type2!='')
        {
            $professioninsert['evidence_type'] = $request->evidence_type2;
        }

        if($request->passport_number!='')
        {
            $professioninsert['passport_number'] = $request->passport_number;
        }
        if($request->passport_number1!='')
        {
            $professioninsert['passport_number'] = $request->passport_number1;
        }
        
        if($request->country_id!='')
        {
            $professioninsert['country_id']=$request->country_id;
        }
        if($request->country_id1!='')
        {
            $professioninsert['country_id']=$request->country_id1;
        }
        
        if($request->visa_subclass!='')
        {
            $professioninsert['visa_subclass']=$request->visa_subclass;
        }
        if($request->visa_subclass1!='')
        {
            $professioninsert['visa_subclass']=$request->visa_subclass1;
            if($request->visa_subclass1==40)
            {
                $professioninsert['other_visa_type']=$request->other_visa_type??'';
            }
        }
        
        if($request->visa_grant_number!='')
        {
            $professioninsert['visa_grant_number'] = $request->visa_grant_number;
        }
        if($request->visa_grant_number1!='')
        {
            $professioninsert['visa_grant_number'] = $request->visa_grant_number1;
        }
        
        
        $professioninsert['status'] = '0';
        $professioninsert['created_at'] = Carbon::now('Asia/Kolkata');

        if ($request->hasFile('upload_evidence0')) 
        {
            $filename = 'evidence_file_' . time() . '.' . $request->upload_evidence0->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/support_document';
            $request->upload_evidence0->move($destinationPath, $filename);

            $professioninsert['original_file_name'] = $request->file('upload_evidence0')->getClientOriginalName();
            $professioninsert['support_document']=$filename;
        }
        if ($request->hasFile('upload_evidence1')) 
        {
            $filename = 'evidence_file_' . time() . '.' . $request->upload_evidence1->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/support_document';
            $request->upload_evidence1->move($destinationPath, $filename);

            $professioninsert['original_file_name'] = $request->file('upload_evidence1')->getClientOriginalName();
            $professioninsert['support_document']=$filename;
        }
        if ($request->hasFile('upload_evidence2')) 
        {
            $filename = 'evidence_file_' . time() . '.' . $request->upload_evidence2->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/support_document';
            $request->upload_evidence2->move($destinationPath, $filename);

            $professioninsert['original_file_name'] = $request->file('upload_evidence2')->getClientOriginalName();
            $professioninsert['support_document']=$filename;
        }
        

        $run = EligibilityToWorkModel::insert($professioninsert);
        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/workClearances') . "?page=work_clearances";
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }

        echo json_encode($json);
    }
    public function updateNdis(Request $request)
    {
        //This function is for update the ndis record
        $user_id=$request->user_id;
        if(!$user_id)
        {
            $email = Session::get('nurseemail');
            if($email!='')
            {
                $user = User::where('email', $email)->first();
                $user_id                = $user->id;
            }
        }

       $ndis['state_id']= $request->ndis_state;
       $ndis['clearance_number']= $request->ndis_worker_clearance_number;
       $ndis['expiry_date']= $request->ndis_expiry_date;
       
       if ($request->hasFile('ndis_evidence')) 
        {
            $filename = 'evidence_file_' . time() . '.' . $request->ndis_evidence->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/support_document';
            $request->ndis_evidence->move($destinationPath, $filename);

            $ndis['original_file_name'] = $request->file('ndis_evidence')->getClientOriginalName();
            $ndis['evidence_file']=$filename;
        }
        
        $lastRecord = NdisWorker::where('user_id', $user_id)->first();
        if($lastRecord)
        {
            $run=$lastRecord->update($ndis);
        }
        else
        {
            $ndis['created_at']= now();
            $ndis['user_id'] = $user_id; 
            $run= NdisWorker::create($ndis);
        }

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/workClearances') . "?page=work_clearances";
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }
        echo json_encode($json);
    } 
    public function update_children_to_work(Request $request)
    {
        //This function is for add / update wwcc
        $user_id=$request->user_id;
        if(!$user_id)
        {
            $email = Session::get('nurseemail');
            if($email!='')
            {
                $user = User::where('email', $email)->first();
                $user_id                = $user->id;
            }
        }
        
        
        $wwcc_state         = $request->input('wwcc_state', []);
        $clearance_number   = $request->input('wwcc_clearance_number', []);
        $wwcc_expiry_date   = $request->input('wwcc_expiry_date', []);
        $wwcc_evidence      = $request->file('wwcc_evidence', []);
        $wwcc_id            = $request->input('wwcc_id', []);
        
        for ($i = 0; $i < count($wwcc_state); $i++) {
            if (isset($wwcc_id[$i])) 
            {
                $wwcc = WorkingChildrenCheckModel::find($wwcc_id[$i]);
                if ($wwcc) {
                    $wwcc->state_id         = $wwcc_state[$i];
                    $wwcc->clearance_number = $clearance_number[$i];
                    $wwcc->expiry_date      = $wwcc_expiry_date[$i];


                    if (isset($wwcc_evidence[$i]) && $wwcc_evidence[$i]->isValid()) {
                        $filename = 'evidence_file_' . time() . '.' . $wwcc_evidence[$i]->getClientOriginalExtension();
                        $destinationPath = public_path() . '/uploads/support_document';
                        $wwcc_evidence[$i]->move($destinationPath, $filename);
    
                        $wwcc->evidence_original_name = $wwcc_evidence[$i]->getClientOriginalName();
                        $wwcc->wwcc_evidence = $filename;
                    }
                    $run= $wwcc->save();
                }
            }
            else
            {
                
                $wwcc = new WorkingChildrenCheckModel();
                $wwcc->user_id          = $user_id;
                $wwcc->state_id         = $wwcc_state[$i];
                $wwcc->clearance_number = $clearance_number[$i];
                $wwcc->expiry_date      = $wwcc_expiry_date[$i];


                if (isset($wwcc_evidence[$i]) && $wwcc_evidence[$i]->isValid()) {
                    $filename = 'evidence_file_' . time() . '.' . $wwcc_evidence[$i]->getClientOriginalExtension();
                    $destinationPath = public_path() . '/uploads/support_document';
                    $wwcc_evidence[$i]->move($destinationPath, $filename);

                    $wwcc->evidence_original_name = $wwcc_evidence[$i]->getClientOriginalName();
                    $wwcc->wwcc_evidence = $filename;
                }
                $wwcc->status = 1;
                $wwcc->created_at = Carbon::now('Asia/Kolkata');
                $run =$wwcc->save();
                
            }
        }
        
        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/workClearances') . "?page=work_clearances";
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }

        echo json_encode($json);
    }
    public function removeWwcc(Request $request)
    {
        //This function is for ajax for remove wwcc from db
        $id = $request->id;

        $wwcc = WorkingChildrenCheckModel::find($id);

        if ($wwcc) {
            $filePath = 'uploads/support_document/' . $wwcc->wwcc_evidence;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
            $wwcc->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'wwcc not found']);
    }
    public function update_police_check_to_work(Request $request)
    {
        $user_id=$request->user_id;
        if(!$user_id)
        {
            $email = Session::get('nurseemail');
            if($email!='')
            {
                $user = User::where('email', $email)->first();
                $user_id                = $user->id;
            }
        }

        $policy['issuance_date'] = $request->issuance_date;
        
        if ($request->hasFile('clearance_document')) 
        {
            $filename = 'evidence_file_' . time() . '.' . $request->clearance_document->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/support_document';
            $request->clearance_document->move($destinationPath, $filename);

            $policy['original_file_name'] = $request->file('clearance_document')->getClientOriginalName();
            $policy['evidence_file']=$filename;
        }
        
        $lastRecord = PoliceCheckModel::where('user_id', $user_id)->first();
        if($lastRecord)
        {
            $run=$lastRecord->update($policy);
        }
        else
        {
            $policy['created_at']= Carbon::now('Asia/Kolkata');
            $policy['user_id'] = $user_id; 
            $policy['status'] = '0';
            $run= PoliceCheckModel::create($policy);
        }

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/workClearances') . "?page=work_clearances";
            // $json['url'] = url('nurse/my-profile#tab-myclearance-jobs');
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }

        echo json_encode($json);
    }
    public function updateSpecializedClearance(Request $request)
    {
        //This function is for update the specialized clearance

        $user_id=$request->user_id;
        if(!$user_id)
        {
            $email = Session::get('nurseemail');
            if($email!='')
            {
                $user = User::where('email', $email)->first();
                $user_id                = $user->id;
            }
        }
        
        $clearance_state        = $request->input('clearance_state', []);
        $clearance_type         = $request->input('clearance_type', []);
        $clearance_number       = $request->input('clearance_number', []);
        $clearance_expiry_date  = $request->input('clearance_expiry_date',[]);
        $clearance_evidence     = $request->file('clearance_evidence', []);
        $s_clearance_id         = $request->input('s_clearance_id', []);

        for ($i = 0; $i < count($clearance_state); $i++) {

            if (isset($s_clearance_id[$i])) 
            {
                $specialized = SpecializedClearance::find($s_clearance_id[$i]);
                if ($specialized) {
                    $specialized->clearance_state       = $clearance_state[$i];
                    $specialized->clearance_type        = $clearance_type[$i];
                    $specialized->clearance_number      = $clearance_number[$i];
                    $specialized->clearance_expiry_date = $clearance_expiry_date[$i];


                    if (isset($clearance_evidence[$i]) && $clearance_evidence[$i]->isValid()) {
                        $filename = 'evidence_file_' . time() . '.' . $clearance_evidence[$i]->getClientOriginalExtension();
                        $destinationPath = public_path() . '/uploads/support_document';
                        $clearance_evidence[$i]->move($destinationPath, $filename);
    
                        $specialized->clearance_original_name = $clearance_evidence[$i]->getClientOriginalName();
                        $specialized->clearance_evidence = $filename;
                    }
                    $run= $specialized->save();
                }
            }
            else
            {
                
                $specialized    = new SpecializedClearance();
                $specialized->user_id               = $user_id;
                $specialized->clearance_state       = $clearance_state[$i];
                $specialized->clearance_type        = $clearance_type[$i];
                $specialized->clearance_number      = $clearance_number[$i];
                $specialized->clearance_expiry_date = $clearance_expiry_date[$i];


                if (isset($clearance_evidence[$i]) && $clearance_evidence[$i]->isValid()) {
                    $filename = 'evidence_file_' . time() . '.' . $clearance_evidence[$i]->getClientOriginalExtension();
                    $destinationPath = public_path() . '/uploads/support_document';
                    $clearance_evidence[$i]->move($destinationPath, $filename);

                    $specialized->clearance_original_name = $clearance_evidence[$i]->getClientOriginalName();
                    $specialized->clearance_evidence = $filename;
                }
                
                $specialized->created_at = Carbon::now('Asia/Kolkata');
                $run =$specialized->save();
                
            }
        }
        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/workClearances') . "?page=work_clearances";
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }

        echo json_encode($json);
    }
    public function removeSpecialized(Request $request)
    {
        $id = $request->id;

        $specialed = SpecializedClearance::find($id);

        if ($specialed) {
            $filePath = 'uploads/support_document/' . $specialed->clearance_evidence;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
            $specialed->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Specialized Clearance not found']);
    }

    public function professionalMembership(Request $request)
    {
        $data['organization_country'] = DB::table("professional_organization")->where("country_organiztions","0")->orderBy('organization_country', 'ASC')->get();
        $data['awards_recognitions'] = DB::table("awards_recognitions")->where("sub_award_id","0")->orderBy('award_name', 'ASC')->get();
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }else{
            $id = '';
        }
        
        $email = Session::get('nurseemail');
        $user = User::where("email",$email)->first();

        if($id){
            $data['user_id'] = $id;
        }else{
            $data['user_id'] = $user->id;
        }
        
        
        $data['professional_membership'] = DB::table("professional_membership")->where("user_id",$data['user_id'])->first();
        return view('admin.professional_membership')->with($data);
    }

    public function setting_availablity(Request $request){
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['user_data']  = DB::table("users")->where("id",$request->id)->first();
        return view('admin.setting_availablity')->with($data);
    }

    public function update_profession_profile_setting(Request $request)
    {
        $update['medical_facilities'] = isset($request->medical_facilities) ? 'Yes' : 'No';
        $update['agencies'] = isset($request->agencies) ? 'Yes' : 'No';
        $update['individuals'] = isset($request->individuals) ? 'Yes' : 'No';
        $update['profile_status1'] = $request->profile_status;
        //$update['unavailable_profile_status'] = isset($request->profile_status) ? 'Yes' : 'No';
        $update['available_date'] = $request->available_date;
        $update['start_job_dropdown'] = $request->start_job_dropdown;
        $update['any_help'] = json_encode($request->any_help);
        $update['updated_at'] = Carbon::now('Asia/Kolkata');
        //print_r($update);die;
        //echo $request->user_email;die;
        $run = DB::table("users")->where('email', $request->user_email)->update($update);
        //$user_stage = update_user_stage(Auth::guard('nurse_middle')->user()->id,"Setting & Availability");
        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/my-profile');
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }

        echo json_encode($json);
    }
    
        public function getRegisteredCountries(Request $request)
    {
        $data = DB::table('registration_profiles_countries')
            ->where('user_id', $request->user_id)
            ->where('type', 1)
            ->whereIn('status',[3,4,5,6,7])
            ->get();

        // attach country_name using helper
        $data = $data->map(function ($item) {
            $item->country_name = country_name($item->country_code);
            return $item;
        });

        return response()->json([
            'data' => $data
        ]);
    }


    public function updateRegisteredCountryStatus(Request $request)
    {
        DB::table('registration_profiles_countries')
            ->where('id', $request->id)
            ->update([
                'status' => $request->status,
                'updated_at' => now()
            ]);

        return response()->json([
            'status' => 1,
            'message' => 'Status updated successfully'
        ]);
    }
}