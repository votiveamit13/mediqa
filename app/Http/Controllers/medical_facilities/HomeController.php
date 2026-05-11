<?php

namespace App\Http\Controllers\medical_facilities;

use App\Models\CountryModel;
use App\Models\User;
use App\Models\ProfessionModel;
use App\Models\EligibilityToWorkModel;
use App\Models\WorkingChildrenCheckModel;
use App\Models\PoliceCheckModel;
use App\Models\PractitionerTypeModel;

use App\Models\WorkPreferModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Log;
use App\Services\User\AuthServices;
use App\Http\Requests\UserUpdateProfile;
use App\Http\Requests\UserChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Str;
use Mail;
use Validator;
use DB;
use URL;
use Session;

use App\Models\SpecialityModel;

use App\Repository\Eloquent\SpecialityRepository;

class HomeController extends Controller
{
 protected $authServices;
 protected $specialityRepository;
      public function __construct(AuthServices $authServices, SpecialityRepository $specialityRepository){
        $this->authServices = $authServices;
        $this->specialityRepository = $specialityRepository;
    }
    public function index($message = '')
    {
         if (!Auth::guard('nurse_middle')->check()) {
            $title = "Login";
            return view('nurse.home', compact( 'message'));
        } else {


            return redirect()->route('nurse.dashboard');
        }

    }
    public function index_main($message = '')
    {
         if (!Auth::guard('nurse_middle')->check()) {
            $title = "Login";
            $practitioner_data = SpecialityModel::where("status",'1')->get();
            //print_r($practitioner_data);die;
            $speciality_data = PractitionerTypeModel::where("status",'1')->get();
            $work_preferences_data = WorkPreferModel::get();
           return view('nurse.medical-facilities', compact( 'message','practitioner_data','speciality_data','work_preferences_data'));
        } else {
            return redirect()->route('nurse.dashboard');
        }

    }
    public function registraion($message = '')
    {
         if (!Auth::guard('nurse_middle')->check()) {
            $title = "Login";
            $practitioner_data = SpecialityModel::where("status",'1')->get();
            //print_r($practitioner_data);die;
            $speciality_data = PractitionerTypeModel::where("status",'1')->get();
            $work_preferences_data = WorkPreferModel::get();
           return view('healthcare.medical-facilities-registraion', compact( 'message','practitioner_data','speciality_data','work_preferences_data'));
        } else {
            return redirect()->route('nurse.dashboard');
        }

    }

    public function healthcareRegistration(Request $request)
    {

        $hospital_name = $request->hospital_name;
        $emailaddress = $request->emailaddress;
        $mobile_no = $request->mobile_no;
        $post_code = $request->post_code;
        $address = $request->address;
        $password = $request->password;
        $country = $request->country;

        $user_data = User::where("email",$emailaddress)->first();

        if(empty($user_data)){
            $user = new User();
            $user->name = $hospital_name;
            $user->email = $emailaddress;
            $user->role = 2;
            $user->country_iso = $country;
            $user->password = Hash::make($password);
            $run = $user->save();
            $r   = User::where('email', $emailaddress)->first();
            //print_r($r->id);
            Auth::guard('healthcare_facilities')->login($r);
            $request->session()->regenerate();
            $request->session()->save();
            //Auth::login($r);
        }else{
            $run = 0;
        }

        //echo Auth::guard('healthcare_facilities')->check();die;

        if ($run) {
            if (empty($r->emailToken)) {
                $r->emailToken = Crypt::encryptString($r->email);
                $r->save();
            }

            $verificationUrl = url('healthcare-facilities/email-verification/' . $r->emailToken);

            $htmlBody = '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <title>Verify Your Account</title>
                </head>
                <body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, Helvetica, sans-serif;">
                    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:30px 0;">
                        <tr>
                            <td align="center">
                                <table width="100%" max-width="600" cellpadding="0" cellspacing="0"
                                    style="max-width:600px; background:#ffffff; border-radius:8px; overflow:hidden;">

                                    <!-- Header -->
                                    <tr>
                                            <td style="background:#000; padding:20px; text-align:center;">
                                                <h1 style="margin:0; color:#ffffff; font-size:22px;">
                                                    ' . e(env("APP_NAME")) . '
                                                </h1>
                                            </td>
                                    </tr>

                                    <!-- Body -->
                                    <tr>
                                        <td style="padding:30px; color:#333333;">
                                            <p style="margin:0 0 15px;">
                                                Hello <strong>' . e($r->name) . '</strong>,
                                            </p>

                                            <p style="margin:0 0 15px;">
                                                Welcome and thank you for registering at <strong>Mediqa</strong>.
                                            </p>

                                            <p style="margin:0 0 25px;">
                                                Please verify your account by clicking the button below.
                                            </p>

                                            <!-- Button -->
                                            <p style="text-align:center; margin:0 0 25px;">
                                                <a href="' . $verificationUrl . '" target="_blank"
                                                style="
                                                    display:inline-block;
                                                    padding:14px 26px;
                                                    background:#000000;
                                                    color:#ffffff;
                                                    text-decoration:none;
                                                    border-radius:5px;
                                                    font-size:16px;
                                                ">
                                                    Verify Account
                                                </a>
                                            </p>

                                            <p style="margin:0 0 10px; font-size:14px; color:#555;">
                                                If the button doesn’t work, copy and paste this link into your browser:
                                            </p>

                                            <p style="word-break:break-all; font-size:14px;">
                                                <a href="' . $verificationUrl . '" target="_blank" style="color:#0d6efd;">
                                                    ' . $verificationUrl . '
                                                </a>
                                            </p>

                                            <p style="margin:25px 0 0; font-size:14px; color:#777;">
                                                If you did not create an account, no action is required.
                                            </p>
                                        </td>
                                    </tr>

                                    <!-- Footer -->
                                    <tr>
                                        <td style="background:#f0f0f0; padding:15px; text-align:center; font-size:12px; color:#777;">
                                            © ' . '2024' . ' Mediqa. All rights reserved.
                                        </td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                    </table>
                </body>
                </html>
                ';

            try {
                \App\Helpers\ZeptoMailHelper::sendMail(
                    $r->email,
                    "Email Verification - Mediqa",
                    $htmlBody
                );

                \Log::info("Verification email sent", ['user_id' => $r->id]);
            } catch (\Throwable $ex) {
                \Log::error("Failed to send verification email", [
                    'user_id' => $r->id,
                    'error'   => $ex->getMessage()
                ]);
            }
            //Session::put('user_id', $r->id);
            //$request->session()->regenerate();
            $json['status'] = 1;
            $json['redirect'] = route('medical-facilities.email-verification-pending');
            $json['message'] = 'Congratulations! Your registration was successful. Please check your email; we have sent you a verification email to your registered address!';
        }else{
            $json['status'] = 0;
            $json['message'] = 'Email is already registered.!';
        }
        return response()->json($json);
    }

    public function profileUnderReviewed()
    {
        // die();

        if (Auth::guard('healthcare_facilities')->user()) {
            if (Auth::guard('healthcare_facilities')->user()->user_stage == 2) {

                //return redirect()->route('nurse.dashboard');
            } else {
                $title = "";
                $message = "";
                return view('auth.profile-under-reviewed', compact('title', 'message'));
            }
        } else {

            return redirect()->route('medical-facilities.login');
        }
    }
        public function email_verification($emailToken)
    {
        $title = "email-verification";

        if (!User::where('emailToken', $emailToken)->exists()) {
            return $this->expiredLink();
        }

        try {
            $email = Crypt::decryptString($emailToken);
        } catch (\Throwable $e) {
            return $this->expiredLink();
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return $this->expiredLink();
        }

        if ($user->emailVerified == '1') {
            return $this->expiredLink();
        }

        $update = [
            'emailVerified'     => '1',
            'email_verify'      => 1,
            'email_verified_at' => now(),
            'emailToken'        => '',
            'user_stage'        => '1',
        ];

        $run = User::where('email', $email)->update($update);

        if (!$run) {
            return back()->with('error', 'Something went wrong.');
        }

        if (!Auth::guard('healthcare_facilities')->check()) {
            Session::put('user_id', $user->id);
            Auth::guard('healthcare_facilities')->attempt([
                'email'    => $user->email,
                'password' => $user->ps
            ]);
        }

        Mail::to("votivetester.vijendra@gmail.com")->send(
            new \App\Mail\DemoMail([
                'subject' => 'New Nurse',
                'email'   => 'votivetester.vijendra@gmail.com',
                'body'    => "
                    <p>Dear Mediqa Team,</p>
                    <p>A new Nurse/Midwife has successfully verified their email.</p>
                    <p><strong>Name:</strong> {$user->name} {$user->lastname}</p>
                    <p><strong>Email:</strong> {$user->email}</p>
                    <p><strong>Date:</strong> " . now()->format('Y-m-d') . "</p>
                "
            ])
        );

        return redirect('/healthcare-facilities/login')->with([
            'message' => '<h6 style="color:green">Your email has been verified successfully.</h6>',
            'status'  => 1
        ]);
    }
    private function expiredLink()
    {
        $message = '<h6 style="color:red">Verification link has expired.</h6>';
        $status  = 0;
        $title   = 'Email Verification';

        return response()
            ->view('nurse.verification-expired', compact('message', 'status', 'title'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }

    public function login($message = '')
    {
        $practitioner_data = SpecialityModel::where("parent",0)->get();
        $speciality_data = PractitionerTypeModel::where("parent",0)->get();
        $work_preferences_data = WorkPreferModel::where("sub_env_id",0)->where("sub_envp_id",0)->get();
        $title = "Login";
        //$prefix = $request->segment(2);die;
        return view('nurse.login', compact('title', 'message','practitioner_data','speciality_data','work_preferences_data'));
    }

    public function userloginAction(Request $request)
    {

        $user_data = User::where("email", $request->email)->first();
        if (Auth::guard('healthcare_facilities')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])  && $user_data->status == 1) {

            $user = Auth::guard('healthcare_facilities')->user();

            // Remember me
            if ($request->remember_me) {
                setcookie("email", $request->email, time() + 3600);
                setcookie("password", $request->password, time() + 3600);
            } else {
                setcookie("email", "");
                setcookie("password", "");
            }

            // Redirect based on role
            if ($user->role == 2) {

                return redirect('/healthcare-facilities/my-profile')
                    ->with('success', 'You are Logged in successfully.');

            } elseif ($user->role == 5) {

                if($user->email_verify == 0 && $user->emailVerified == 0 && $user->user_stage == 0){
                    return redirect('/healthcare-facilities/accept_invitation')
                    ->with('success', 'You are Logged in successfully.');
                }else{
                    return redirect('/healthcare-facilities/location_work_modal')
                    ->with('success', 'You are Logged in successfully.');
                }


            } else {

                Auth::guard('healthcare_facilities')->logout();
                return back()->with('error', 'Unauthorized access.');
            }

        } else {

            return back()->with('error', 'Invalid login details.');
        }
    }

    //  public function logout(Request $request)
    // {
    //     Auth::guard('healthcare_facilities')->logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return redirect('healthcare-facilities');
    // }

    public function logout(Request $request)
    {
        // Get user before logout
        $user = Auth::guard('healthcare_facilities')->user();

        if ($user) {
            // Clear online status from cache
            cache()->forget("user_{$user->id}_online");

            // Broadcast offline status BEFORE logging out
            try {
                // Use broadcast() without toOthers() to ensure it's sent
                broadcast(new \App\Events\UserOnlineStatus($user->id, false, now()));
                \Log::info('Healthcare logout: Broadcasted offline status for user ' . $user->id);
            } catch (\Exception $e) {
                \Log::error('Failed to broadcast offline status on healthcare logout: ' . $e->getMessage());
            }
        }

        // Now logout and destroy session
        Auth::guard('healthcare_facilities')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('healthcare-facilities');
    }

    public function accept_invitation()
    {
        return view('healthcare.settings.accept_invitation');
    }

    public function emailVerificationPending()
    {

        if (Auth::guard('healthcare_facilities')->user()) {


            if (Auth::guard('healthcare_facilities')->user()->emailVerified == 1 &&  Auth::guard('healthcare_facilities')->user()->user_stage == 1 && Auth::guard('healthcare_facilities')->user()->type == 1) {

                return redirect()->route('medical-facilities.profile-under-reviewed');
            } elseif (Auth::guard('healthcare_facilities')->user()->emailVerified == 1 &&  Auth::guard('healthcare_facilities')->user()->type == 0) {
                return redirect()->route('medical-facilities.dashboard');
            } else {
                $title = "";
                $message = "";
                //print_r(Auth::guard('healthcare_facilities')->user());die;
                return view('auth.email-verification-pending', compact('title', 'message'));
            }
        } else if (Session::get('user_id')) {
            $user_id = Session::get('user_id');

            $title = 'sa';
            $message = "";
            $r = User::where("id", $user_id)->first();
            Auth::guard('healthcare_facilities')->attempt(['email' => $r->email, 'password' => $r->ps]);
            // return redirect('/nurse/my-profile?page=my_profile');
            return redirect('/nurse/dashboard');
            return view('auth.email-verification-pending', compact('title', 'message'));
        } else {
            $title = "s";
            return redirect()->route('medical-facilities.login');
        }
    }

    public function manage_profile(){
        $user_id = Auth::guard('healthcare_facilities')->user()->id;
        $data['user_data'] = User::where("id",$user_id)->first();

        $get_matching_percent = sendJobAlertEmails();
        // die;
        return view('healthcare.settings.profile')->with($data);
    }

    public function updateProfile(Request $request){
        $user_id = Auth::guard('healthcare_facilities')->user()->id;
        $facility_name = $request->facility_name;
        $sector_preferences = $request->sector_preferences;
        $subwork = json_encode($request->input('subwork'));
        $subpwork = json_encode($request->input('subworkthlevel'));
        //print_r($subpwork);die;
        $country = $request->country;
        $site_data = json_encode($request->site_data);
        $work_environment_size = $request->work_environment_size;
        $staff_wellbeing_field = $request->staff_wellbeing_field;
        $other_text = $request->other_text;
        $emr_ehr_data = json_encode($request->emr_ehr_data);
        $emr_other_text = $request->emr_other_text;
        $equipment_field = $request->equipment_field;
        $digital_health_text = json_encode($request->digital_health_text);
        $professional_field = $request->professional_field;
        $professional_other_text = $request->professional_other_text;
        $full_name = $request->full_name;
        $role_position_field = $request->role_position_field;
        $email = $request->email;
        $phone = $request->phone;
        $communication_text = json_encode($request->communication_text);

        $subaccreditation_data = json_encode($request->subaccreditation_data);

        //print_r($subaccreditation_data);die;
        $profile_visiblity = $request->profile_visiblity;

        $request->validate([
            'facility_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user_data = User::find($user_id);

        if ($request->hasFile('facility_logo')) {

            $image = $request->file('facility_logo');

            $imageName = time().'_'.$image->getClientOriginalName();

            $image->move(public_path('healthcareimg/uploads'), $imageName);


        }else{
            $imageName = $user_data->profile_img;
        }

        //print_r($site_data);

        $user_data->name = $facility_name;
        $user_data->sector = $sector_preferences;
        $user_data->profile_img = $imageName;
        $user_data->facility_services = $subpwork;
        $user_data->country_iso = $country;
        $user_data->site_data = $site_data;
        $user_data->work_environment_size = $work_environment_size;
        $user_data->accreditations_certifications = $subaccreditation_data;
        $user_data->staff_wellbeing_programs = $staff_wellbeing_field;
        $user_data->other_staff_wellbeing = $other_text;
        $user_data->technology_emr_system = $emr_ehr_data;
        $user_data->other_technology_emr = $emr_other_text;
        $user_data->equipment_facilities = $equipment_field;
        $user_data->digital_health_integration = $digital_health_text;
        $user_data->professional_development = $professional_field;
        $user_data->other_professional_development = $professional_other_text;
        $user_data->contact_person_name = $full_name;
        $user_data->role_position = $role_position_field;
        $user_data->email = $email;
        $user_data->phone = $phone;
        $user_data->communication_method = $communication_text;
        $user_data->profile_visiblity = $profile_visiblity;
        $run = $user_data->save();

        if ($run) {
            $json['status'] = 1;


        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);
    }



    public function getAccreditationsData(Request $request){
        $id = $request->id;
        $data["accreditation_data"] = DB::table("accreditation_certifications")->where("parent",$id)->get();
        $accreditation_name = DB::table("accreditation_certifications")->where("id",$id)->first();
        $data["accreditation_id"] = $id;
        $data["accreditation_name"] = $accreditation_name->name;
        echo json_encode($data);

    }



}