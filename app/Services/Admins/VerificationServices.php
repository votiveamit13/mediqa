<?php
namespace App\Services\Admins;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\VerificationRepository;
use Illuminate\Support\Facades\Mail;

class VerificationServices
{
    protected $verificationRepository;

    public function __construct(VerificationRepository $verificationRepository)
    {
        $this->verificationRepository = $verificationRepository;
    }

    // Verification management 
    /*  approved or reject Profession verification   */
      public function changeProfessionVerificationStatus($request)
    {
        try {
            $data =  $this->verificationRepository->get(['id'=>$request->id]);
            if ($request->status == 1) {
                $updateData['status'] = '1';
                $run = $this->verificationRepository->update(['id' => $request->id], $updateData);
                
            } else {
                $updateData['status'] = '2';
                $updateData['evidence_type'] = null;
                $updateData['evidence_of_year_level'] = null;
                $updateData['reason'] = $request->reasonData;
                $run = $this->verificationRepository->update(['id' => $request->id], $updateData);
            }
            if ($run) {
                $userData = getUserDataById($data->user_id);
                $body = 'Hello, ' . $userData->name . ' ' . $userData->lastname;
                if ($request->status == 1) {
                    $body .= '<p>We are excited to inform you your <strong> Profession Verification Request </strong> has been  accepted!.';
                } else {
                    $body .= '<p>This mail to inform to inform you your <strong> Profession Verification Request </strong> has been rejected due to ' . $request->reasonData . '.';
                }
                if ($request->status == 1) {
                    $subject = 'Your Profession Verification Request Accepted!';
                } else {
                    $subject = 'Your Profession Verification Request Rejected!';
                }
                $mailData = [
                    'subject' =>  $subject,
                    'email' => $userData->email,
                    'body' => $body,
                ];
                $sendMail =  Mail::to($userData->email)->send(new \App\Mail\DemoMail($mailData));
                Mail::to('deeksha.webwiders@gmail.com')->send(new \App\Mail\DemoMail($mailData));
                if ($sendMail) {
                   
                    if ($request->status == 1) {
                        return response()->json(['status' => '2', 'message' => __('message.approved', ['parameter' => ' Verification'])]);
                    } else {
                        return response()->json(['status' => '2', 'message' => __('message.reject', ['parameter' => ' Verification'])]);
                    }
                } else {
                    return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
                }
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in VerificationServices.changeProfessionVerificationStatus(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

     /*  approved or reject police check verification   */
     public function changePoliceCheckVerificationStatus($request)
    {
        try {
          
            $data =  $this->verificationRepository->getPoliceCheckVerificationData(['id'=>$request->id]);
          
            if ($request->status == 1) {
                $updateData['status'] = 1;
                $run = $this->verificationRepository->updatePoliceCheckVerificationData(['id' => $request->id], $updateData);
                
            } else {
                $updateData['status'] = 2;
                $updateData['reason'] = $request->reasonData;
                $run = $this->verificationRepository->updatePoliceCheckVerificationData(['id' => $request->id], $updateData);
            }
            if ($run) {
                $userData = getUserDataById($data->user_id);
                $body = 'Hello, ' . $userData->name . ' ' . $userData->lastname;
                if ($request->status == 1) {
                    $body .= '<p>We are excited to inform you your <strong> Police Check Verification Request </strong> has been  accepted!.';
                } else {
                    $body .= '<p>This mail to inform to inform you your <strong> Police Check Verification Request </strong> has been rejected due to ' . $request->reasonData . '.';
                }
                if ($request->status == 1) {
                    $subject = 'Your Police Check Verification Request Accepted!';
                } else {
                    $subject = 'Your Police Check Verification Request Rejected!';
                }
                $mailData = [
                    'subject' =>  $subject,
                    'email' => $userData->email,
                    'body' => $body,
                ];
                $sendMail = Mail::to($userData->email)->send(new \App\Mail\DemoMail($mailData));
                 Mail::to('deeksha.webwiders@gmail.com')->send(new \App\Mail\DemoMail($mailData));
                if ($sendMail) {
                   
                    if ($request->status == 1) {
                        return response()->json(['status' => '2', 'message' => __('message.approved', ['parameter' => ' Verification'])]);
                    } else {
                        return response()->json(['status' => '2', 'message' => __('message.reject', ['parameter' => ' Verification'])]);
                    }
                } else {
                    return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
                }
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in VerificationServices.changePoliceCheckVerificationStatus(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }



        
}
