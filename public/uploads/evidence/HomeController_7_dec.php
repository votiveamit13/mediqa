<?php

namespace App\Http\Controllers\nurse;

use App\Models\CountryModel;
use App\Models\User;
use App\Models\ProfessionModel;
use App\Models\EligibilityToWorkModel;
use App\Models\WorkingChildrenCheckModel;
use App\Models\PoliceCheckModel;


use App\Http\Requests\AddnewsletterRequest;

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
use Helpers;
use Mail;
use Validator;
use DB;
use URL;
use Session;
use File;
use App\Services\Admins\SpecialityServices;

use App\Models\SpecialityModel;
use App\Models\EducationModel;
use App\Models\ExperienceModel;
use App\Models\MandatoryTrainModel;
use App\Models\InterviewModel;
use App\Models\PreferencesModel;
use App\Models\WorkPreferencesModel;
use App\Models\VaccinationFrontModel;
use App\Models\AdditionalInfo;
use App\Models\ProfessionalAssocialtionModel;
use App\Models\AddReferee;
use App\Repository\Eloquent\SpecialityRepository;

class HomeController extends Controller
{

    protected $specialityServices;
    protected $specialityRepository;
    protected $authServices;
  
    public function __construct(SpecialityServices $specialityServices , SpecialityRepository $specialityRepository,AuthServices $authServices){
        $this->specialityServices = $specialityServices;
        $this->specialityRepository = $specialityRepository;
        $this->authServices = $authServices;
       
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
    public function contact($message = '')
    {
        $phoneCode = CountryModel::orderBy('id','DESC')->get();
        return view('nurse.contact', compact( 'message','phoneCode'));
    }
    public function index_main($message = '')
    {
         if (!Auth::guard('nurse_middle')->check()) {
            $title = "Login";
            
            
            $trendingData=$this->specialityRepository->getAll(['is_featured'=>1]);
            $trendingData2=$this->specialityRepository->get_specialitiess(['is_featured'=>1]);
         
           return view('nurse.main-home', compact( 'message','trendingData','trendingData2'));
        } else {
            

            return redirect()->route('nurse.dashboard');
        }
        
    }
    public function medical_facilities($message = '')
    {
         if (!Auth::guard('nurse_middle')->check()) {
            $title = "Login";
           return view('nurse.medical-facilities', compact( 'message'));
        } else {
            

            return redirect()->route('nurse.dashboard');
        }
        
    }
    public function login($message = '')
    {
       
        if (!Auth::guard('nurse_middle')->check()) {
            $title = "Login";
            return view('nurse.login', compact('title', 'message'));
        } else {
            

            return redirect()->route('nurse.dashboard');
        }
    }
    public function nurse_register($message = '')
    {
         return view('nurse.nurseRegister', compact( 'message'));
    }
    public function manage_profile($message = '')
    {
         return view('nurse.profile', compact( 'message'));
    }
       public function upload_profile_image(Request $request)
    {

        if ($request->hasFile('image')) {
            $profile_image = time() . '.' . $request->image->extension();

            if ($request->image->move(public_path('/nurse/assets/imgs/'), $profile_image)) {
                $insert['profile_img'] = '/nurse/assets/imgs/' . $profile_image;
            }
        }
        $data = User::where('id', Auth::guard('nurse_middle')->user()->id)->update($insert);
        if ($data) {
            $output['status'] = 1;
            $output['message'] = 'Your query has been submitted successfully.';
            Session::flash('message', 'Your query has been submitted successfully.');
        } else {
            $output['status'] = 0;
            $output['message'] = 'Something went wrong.';
            Session::flash('message', 'Something went wrong.');
        }

        echo json_encode($output);
    }
    public function fetchSubspecialty(Request $request)
        {
            $data['subspecialty'] = SpecialityModel::where("parent", $request->specialty_id)
            ->get(["name", "id"]);
      
            return response()->json($data);
        }
        
     public function do_nurse_register(Request $request)
    {
        if (User::where("email", $request->email)->doesntExist()) {
            
            if(User::where("email", $request->email)->doesntExist()){
                    

            $password = $request->password;
            
            $orderform = rand(10000, 99999);
            $lot = '#' . str_pad($orderform + 1, 4, "0", STR_PAD_LEFT);
          
            $to = $request->email;
            $emailToken = Crypt::encryptString($request->email);

            $verificationUrl = url('nurse/email-verification/' . $emailToken);

            $mailData = [

                'subject' => 'Registration successful!',

                'email' => $to,

                'verificationUrl' => $verificationUrl,

                'password' => $password,

                'body' => '<p>Hello  ' . $request->fullname .' '. $request->lastname. ', </p><p>Welcome and thank you for registering.</p>  <p>Click the link below to verify your account. </p><p><a href="' . $verificationUrl . '">Verify Now</a></p><p>If the above link doesn\'t work, copy and paste the link below into your browser.</p><p>' . $verificationUrl . '</p>',


            ];
            
            $randnum = rand(1111111111, 9999999999);
            Mail::to($to)->send(new \App\Mail\DemoMail($mailData));
            
            $companyinsert['name'] = $request->fullname;
            $companyinsert['lastname'] = $request->lastname;
            $companyinsert['email'] = $request->email;
            $companyinsert['country'] = country_id($request->countryCode);
            $companyinsert['country_code'] = $request->countryCode;
            $companyinsert['country_iso'] = $request->countryiso;
            $companyinsert['phone'] = $request->contact;
            $companyinsert['post_code'] = $request->post_code;
            $companyinsert['password'] = Hash::make($password);
            $companyinsert['ps'] = $password;
            
            
            
            
            
            $companyinsert['nursetype'] = json_encode($request->nurseType);
            $companyinsert['nurseTypeJob'] = json_encode($request->nurseTypeJob);
            $companyinsert['nurseTypeJob'] = json_encode($request->nurseTypeJob);
            $companyinsert['nurse_practitioner_speciality'] = json_encode($request->nurse_practitioner_speciality);
            $companyinsert['assistent_level'] = $request->assistent_level;
            $companyinsert['specialties'] = json_encode($request->specialties);
            $companyinsert['subSpecialties'] = json_encode($request->subSpecialties);
            $companyinsert['Sub-Speciality-One'] = json_encode($request->surgicalsubSpecialties);
            $companyinsert['Sub-Speciality-Two'] = json_encode($request->surgicalsuboneSpecialties);
            $companyinsert['degree'] = json_encode($request->degree);
            
       
           
            $companyinsert['emailToken'] = $emailToken;
            $companyinsert['type'] = '1';
            $companyinsert['created_at'] = Carbon::now('Asia/Kolkata');

            $companyinsert['entry_level_nursing'] = json_encode($request->nursing_type_1);
            $companyinsert['registered_nurses'] = json_encode($request->nursing_type_2);
            $companyinsert['advanced_practioner'] = json_encode($request->nursing_type_3);
            $companyinsert['nurse_prac'] = json_encode($request->nurse_practitioner_menu);
            $companyinsert['adults'] = json_encode($request->speciality_entry_1);
            $companyinsert['maternity'] = json_encode($request->speciality_entry_2);
            $companyinsert['paediatrics_neonatal'] = json_encode($request->speciality_entry_3);
            $companyinsert['community'] = json_encode($request->speciality_entry_4);
            $companyinsert['surgical_preoperative'] = json_encode($request->surgical_row_box);
            $companyinsert['operating_room'] = json_encode($request->surgical_operative_care_1);
            $companyinsert['operating_room_scout'] = json_encode($request->surgical_operative_care_2);
            $companyinsert['operating_room_scrub'] = json_encode($request->surgical_operative_care_3);
            $companyinsert['surgical_obstrics_gynacology'] = json_encode($request->surgical_obs_care);
            $companyinsert['neonatal_care'] = json_encode($request->neonatal_care);
            $companyinsert['paedia_surgical_preoperative'] = json_encode($request->surgical_rowpad_box);
            $companyinsert['pad_op_room'] = json_encode($request->surgical_operative_carep_1);
            $companyinsert['pad_qr_scout'] = json_encode($request->surgical_operative_carep_2);
            $companyinsert['pad_qr_scrub'] = json_encode($request->surgical_operative_carep_3);

            $run = User::insert($companyinsert);
            $r = User::where("email", $request->email)->first();
           
            if ($run) {
                Session::put('user_id', $r->id);
               
                $json['status'] = 1;
                $json['url'] = url('nurse/email-verification-pending');
                // $json['url'] = url('nurse/my-profile');
                $json['message'] = 'Congratulations! Your registration was successful. Please check your email; we have sent you a verification email to your registered address!';
             } else {
                $json['status'] = 0;
                $json['message'] = 'Please Try Again';
            }
        }else
        {
        $json['status'] = 0;
        $json['message'] = 'Email is already registered.!';
    }
        } else {
            $json['status'] = 0;
            $json['message'] = ' Email address is already registered.!';
        }
        echo json_encode($json);
    }
     public function emailVerificationPending()
    {
       
        if (Auth::guard('nurse_middle')->user()) {
           
            if (Auth::guard('nurse_middle')->user()->emailVerified == 1 &&  Auth::guard('nurse_middle')->user()->user_stage == 1 && Auth::guard('nurse_middle')->user()->type == 1) {
               
                return redirect()->route('nurse.profile-under-reviewed');
            }elseif(Auth::guard('nurse_middle')->user()->emailVerified == 1 &&  Auth::guard('nurse_middle')->user()->type == 0){
                 return redirect()->route('nurse.dashboard');
            } else {
                $title = "";
                $message = "";
                
                return view('auth.email-verification-pending', compact('title', 'message'));
            }
        } else if (Session::get('user_id')) {
            $user_id = Session::get('user_id');
           
            $title = 'sa';
            $message = "";
            $r = User::where("id", $user_id)->first();
            Auth::guard('nurse_middle')->attempt(['email' => $r->email, 'password' => $r->ps]);
            return redirect('/nurse/my-profile?page=my_profile');
            return view('auth.email-verification-pending', compact('title', 'message'));
        } else {
            $title = "s";
            return redirect()->route('nurse.login');
        }
    }
    
    public function indexs($message = '')
    {
       
        if (!Auth::guard('nurse_middle')->check()) {
            $title = "Login";
            return view('Merchant.login', compact('title', 'message'));
        } else {

            return redirect()->route('nurse.dashboard');
        }
    }

    public function signup()
    {
        $country_phone_code = CountryModel::where('status', '1')->select('phonecode')->groupBy('phonecode')->orderBy("phonecode", "asc")->get();
        return view('Merchant.signup', compact('country_phone_code'));
    }
    
    public function mail_exist(Request $request)
    {


        if (User::where('email',$request->email)->where('status', '!=', '0')->exists()) {
            return response()->json([
                'status' => 1,
                'message' => 'This email is already registered with us !'
            ], 200);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Email can be registered !'
            ], 200);
        }
    }
    public function store_License_exist(Request $request)
    {


        if (User::where('email',$request->storeLicense)->where('status', '!=', '0')->exists()) {
            return response()->json([
                'status' => 1,
                'message' => 'This Store License is Already registered with us !'
            ], 200);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Store License can be registered !'
            ], 200);
        }
    }
    public function do_signup(Request $request)
    {

        $rules =  [
            'email' => 'required|email',
            'password' => 'required',
            'companyName' => 'required',
            'ownerName' => 'required',
            'contact' => 'required',
            'Ownercontact' => 'required',
            'countryCode' => 'required',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            $json['validation'] = $validator->errors();

            $json['status'] = 0;
        } elseif (User::where("email", $request->email)->doesntExist()) {
            
            if(User::where("store_license", $request->storeLicense)->doesntExist()){
                    

            $password = $request->password;
            
            $orderform = rand(10000, 99999);
            $lot = '#' . str_pad($orderform + 1, 4, "0", STR_PAD_LEFT);
          
            $to = $request->email;
            $emailToken = Crypt::encryptString($request->email);

            $verificationUrl = url('merchant/email-verification/' . $emailToken);

            $mailData = [

                'subject' => 'Registration successfully!',

                'email' => $to,

                'verificationUrl' => $verificationUrl,

                'password' => $password,

                'body' => '<p>Hello  ' . $request->ownerName . ', </p><p>Welcome and thank you for registering.</p>  <p>Click the link below to verify your account. </p><p><a href="' . $verificationUrl . '">Verify Now</a></p><p>If the above link doesn\'t work, copy and paste the link below into your browser.</p><p>' . $verificationUrl . '</p>',


            ];
            $randnum = rand(1111111111, 9999999999);
            Mail::to($to)->send(new \App\Mail\DemoMail($mailData));

            if ($request->file('store_logo')) {
                $fileName = time() . '.' . $request->file('store_logo')->extension();
                $path = '/assets/store_image/';
                $request->file('store_logo')->move(public_path($path), $fileName);
                $image = $path . $fileName;
                $store_image = '/store_image/' . $fileName;
                $companyinsert['store_logo'] = $store_image;
            }

            $companyinsert['store_name'] = $request->companyName;
            // $companyinsert['store_logo'] = $request->store_logo;

            $companyinsert['store_country_code'] = $request->countryCode;
            $companyinsert['store_phone'] = $request->contact;
            $companyinsert['store_license'] = $request->storeLicense;

            $companyinsert['email'] = $request->email;
            $companyinsert['store_address'] = $request->address;

            $companyinsert['password'] = Hash::make($password);
            $companyinsert['ps'] = $password;

            $companyinsert['name'] = $request->ownerName;
            $companyinsert['owner_country_code'] = $request->ownercountryCode;
            $companyinsert['owner_phone'] = $request->Ownercontact;

            $companyinsert['accountId'] = $lot;
            $companyinsert['emailToken'] = $emailToken;

            // $companyinsert['companylogo'] = 'common/image/Unknown_person.jpg';

            $companyinsert['type'] = '1';
            $companyinsert['emailToken'] = $emailToken;

            $companyinsert['ps'] = $password;

            $companyinsert['created_at'] = Carbon::now('Asia/Kolkata');

            $run = User::insert($companyinsert);
            $r = User::where("email", $request->email)->first();
            if ($run) {
                Session::put('user_id', $r->id);

                $json['status'] = 1;
                $json['url'] = url('merchant/email-verification-pending');
                $json['message'] = 'Congratulations! Your registration was successful. Please check your email. We have sent email on your registered email address!';
             } else {
                $json['status'] = 0;
                $json['message'] = 'Please Try Again';
            }
        }else
        {
        $json['status'] = 0;
        $json['message'] = 'Store License is already registered.!';
    }
        } else {
            $json['status'] = 0;
            $json['message'] = 'Store Email address is already registered.!';
        }
        echo json_encode($json);
    }

   
    
    public function profileUnderReviewed()
    {
        // die();
       
        if (Auth::guard('nurse_middle')->user()) {
            if (Auth::guard('nurse_middle')->user()->user_stage == 2) {
                
                return redirect()->route('nurse.dashboard');
            } else {
                $title = "";
                $message = "";
                return view('auth.profile-under-reviewed', compact('title', 'message'));
            }
        }else {
           
            return redirect()->route('nurse.login');
        }
    }
    public function email_verification($emailToken)
    {

        $email = Crypt::decryptString($emailToken);
        $title = "email-verification";

        if (User::where("email", $email)->exists()) {
            if (User::where("email", $email)->where("emailVerified", '1')->exists()) {
                $message = '<h6 style="color:green">Your email address already verified.!</h6>';
                $status = 1;
                if (!Auth::guard('nurse_middle')->check()) {
                    $title = "Login";

                    return view('nurse.login', compact('message', 'title', 'status'))->with('do', '0');
                } else {


                    return redirect()->route('nurse.dashboard')->with([
                        'message' => $message,
                        'title' => '',
                        'status' => $status
                    ]);
                }
            } else {
                if (User::where("emailToken", $emailToken)->exists()) {

                    $r = User::where("email", $email)->first();

                    $update['emailVerified'] = '1';
                    $update['user_stage'] = '1';
                    $update['emailToken'] = '';

                    $run = User::where(['email' => $email])->update($update);
                    if (!Auth::guard('nurse_middle')->user()) {
                        Session::put('user_id', $r->id);
                        Auth::guard('nurse_middle')->attempt(['email' => $r->email, 'password' => $r->ps]);
                    }
                    if (Auth::guard('nurse_middle')->user()) {
                    }
                    if ($run) {
                        $msg = "Email has been Verified Successfully";
                        $message = '<h6 style="color:green">Your email address has been verified successfully. Now You can access to you account!</h6>';
                        $status = 1;

                        return redirect()->route('nurse.dashboard')->with([
                            'message' => $message,
                            'title' => '',
                            'status' => $status
                        ]);

                        // return view('auth.verification-screen', compact('message', 'title', 'status'))->with('do', '1');
                    } else {
                        return back()->with('error', '<div claas="alert alert-danger mt-3">Something went wrong.</div>');
                    }
                } else {
                    $message = '<h6 style="color:red">Verification link has been expired.!</h6>';
                    $status = 0;

                    // return view('auth.verification-screen', compact('message', 'title', 'status'))->with('do', '0');
                    if (!Auth::guard('nurse_middle')->check()) {
                        $title = "Login";

                        return view('nursenurse.login', compact('message', 'title', 'status'))->with('do', '0');
                    } elseif (Auth::guard('user')->user()->emailVerified == 0) {
                        return redirect()->route('nurse.email-verification-pending');
                    } else {


                        return view('nurse.profile', compact('message', 'status'));
                    }
                }
            }
        }
    }

    public function userloginAction(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //  if (User::where("email", $request->email)->where('emailVerified','0')->exists()){
        //       return back()->with('error','Account is not Verified !');
        // }else
        // Auth::guard('nurse_middle')->logout();
        if (User::where("email", $request->email)->where('status', '2')->exists()) {
            return back()->with('error', 'Your account has been blocked by the admin. Please contact the administrator.');
        } elseif (User::where("email", $request->email)->where('status', '0')->exists()) {
            return back()->with('error', 'No user found with this email. None of the accounts are associated with this detail.');
        } elseif (Auth::guard('nurse_middle')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if(isset($request->remember_me) && !empty($request->remember_me)){
                setcookie("email",$request->email,time()+3600);
                setcookie("password",$request->password,time()+3600);
            }else{
                setcookie("email","");
                setcookie("password","");
            }
            return redirect('/nurse/my-profile?page=my_profile')->with('success', 'You are Logged in sucessfully.');
        } else {
            return back()->with('error', 'Invalid login details.');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('nurse_middle')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('nurse');
    }


    public function forgotPassword()
    {
        // if (Auth::check('')) {
        //     return redirect('merchant.dashboard');
        // }
        $title = "forget-password";

        return view('nurse.forget-password', compact('title'));
    }
    public function SendResetPasswordLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users'
        ], [
            'email.exists' => 'This email is not registered with us'
        ]);

        if ($validator->fails()) {
            //return $this->sendError('Validation Error.', $validator->errors()->all());

            $errors = $validator->errors()->all();
            $message = '';
            foreach ($errors as $error) {
                $message .= '' . $error;
            }
            $message .= '';
            return response()->json([
                'status' => 0,
                'message' => $message
            ], 200);
        } else {

            $user = User::where('email', $request->email)->first();
            $email = $request->email;
            $checklink = DB::table('password_reset_tokens')
                ->where([
                    'email' => $email
                ])->first();
               
            if ($checklink == '') {
                $token = Str::random(64);
                DB::table('password_reset_tokens')
                ->insert([
                    'email' => $email,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
            } else {
                $token = $checklink->token;
                // $token = Str::random(64);
                // DB::table('password_reset_tokens')
                //         ->where('email',$email)
                //             ->update(['token'=>$token]);
            }
            
            $emailToken = Crypt::encryptString($request->email);


            $verificationUrl = URL::to('/nurse/') . '/reset-password/' . $token . '/' . $emailToken;

            $data['data'] = '<p>Hello ' . $user->name . ', </p><p>We\'ve received a password reset request for your '.env('APP_NAME').' account (' . $user->email . ').</p>';
            $data['data'] .= '<p>If you initiated this request, please click the link below to reset your password.</p>';
            $data['data'] .= '<p><a href="' . $verificationUrl . '" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #000000; text-decoration: none;  text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #000000; display: inline-block;">Reset Password</a></p>';
            $to = $user->email;
            $mailData = [

                'subject' => 'Forgot password',

                'email' =>  $user->email,

                'verificationUrl' => $verificationUrl,

                'body' => $data['data'],


            ];






            try {
                Mail::to($to)->send(new \App\Mail\DemoMail($mailData));
            } catch (\Exception $e) {

                return response()->json([
                    'status' => 0,
                    'message' => 'Something went wrong, try again later.'
                ], 200);
            }

            return response()->json([
                'status' => 1,
                'message' => 'Please check your email for the password reset link.'
            ], 200);
        }
    }
    public function ResetPassword(Request $request)
    {

        $title = "reset-pass";

        $rt = $request->route('lp');

        $email =  Crypt::decryptstring($rt);
        //         $checklink = DB::table('password_resets')
        //             ->where([
        //                 'token' => $request->route('token'),'status' => '0'
        //             ])->first();
        //         if($checklink){
        //                         $hide_form = true;

        //  DB::table('password_resets')
        //                 ->where(['email' =>  $email])->delete();

        //             session()->flash('message', '<div class="alert alert-danger">Link has been expired.!</div>');

        //             return redirect('login')->with(['hide_form' => $hide_form, 'title' => $title]);


        //         }

        if (session()->has('message') && session()->has('hide_form')) {


            return view('nurse.reset-password', ['request' => $request, 'title' => $title, 'hide_form' => session()->get('hide_form')]);
        }

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'token' => $request->token
            ])->first();
        // if (!$updatePassword) {echo "data";print_r($updatePassword);}



        if (!$updatePassword) {

            $hide_form = true;


            session()->flash('message', '<div class="alert alert-danger">Link has been expired.!</div>');


            return redirect('nurse/login')->with(['hide_form' => $hide_form, 'title' => $title]);
            if (Auth::guard('user')->user()) {
                return view('auth.verification-screen', compact('message', 'hide_form', 'title', 'status'))->with('do', '1');
            } else {
                return redirect('nurse/login')->with(['hide_form' => $hide_form, 'title' => $title]);
            }
            // return view('creator.reset-password', ['request' => $request, 'hide_form' => $hide_form]);

        }


        // DB::table('password_resets')
        //         ->where('email',$email)
        //             ->update(['status'=>'0']);
        return view('nurse.reset-password', ['request' => $request, 'title' => $title]);
    }
    public function UpdatePassword(Request $request)
    {
        $token = $request->token;
        $rt = $request->email;

        $email =  Crypt::decryptstring($request->email);


        $validator = Validator::make($request->all(), [
            // 'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            //return $this->sendError('Validation Error.', $validator->errors()->all());

            $errors = $validator->errors()->all();
            $message = ' <div class="alert alert-warning" role="alert">';
            foreach ($errors as $error) {
                $message .= '' . $error . '.!<br>';
            }
            $message .= '</div>';
            return back()->withInput()->with('message', $message);
        } else {


            $updatePassword = DB::table('password_reset_tokens')
                ->where([
                    'email' => $email,
                    'token' => $request->token
                ])->first();

            if (!$updatePassword) {
                return redirect('nurse/login')->withInput()->with('message', '<div class="alert alert-danger">Invalid token.!</div>');
            }


            $user = User::where('email', $email)
                ->update(['password' => Hash::make($request->password), 'ps' => $request->password]);

            DB::table('password_reset_tokens')
                ->where(['email' => $email])->delete();


            //session()->flash('message', '<div class="alert alert-success">Your password has been changed!</div>');
            //return view('user.reset-password' ,['message'=> '<div class="alert alert-success">Your password has been changed!</div>','hide_form'=>true]);


            return redirect('nurse/login')->with(['message_pass' => '<div class="alert alert-success">Your password has been changed.</div>', 'hide_form' => true]);
        }
    }

   
    public function resentVerification()
    {

        $to = Auth::guard('nurse_middle')->user()->email;
        $user = User::where('email', $to)->first();
        // $emailToken = Crypt::encryptString( $to );
        $emailToken = $user->emailToken;

        $verificationUrl = url('nurse/email-verification/' .  $emailToken);
        $update['emailToken'] =  $emailToken;


        $uid = User::where('id', Auth::guard('nurse_middle')->user()->id)->update($update);

        $mailData = [

            'subject' => 'Email verification',

            'email' => $to,

            'verificationUrl' => $verificationUrl,


            'body' => '<p>Hello  ' . Auth::guard('nurse_middle')->user()->name . ', </p>  <p>Welcome and thank you for registering.</p><p>Click the link below to verify your account. </p><p><a href="' . $verificationUrl . '">Verify Now</a></p><p>If the above link doesn\'t work, copy and paste the link below into your browser.</p><p>' . $verificationUrl . '</p>',


        ];

        Mail::to($to)->send(new \App\Mail\DemoMail($mailData));

        try {
            Mail::to($to)->send(new \App\Mail\DemoMail($mailData));
            $output['status'] = 1;
        } catch (\Exception $e) {
            $output['status'] = 0;
        }
        echo json_encode($output);
    }
    public function dashboard()

    {
        return view('nurse.dashboard');
    }
     public function updateProfile(UserUpdateProfile $request)
    {
        try {
            $run = $this->authServices->updateAdminProfile($request);
             if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo',['parameter' =>'Profile'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            log::error('Error in SettingController/updateProfile :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateProfession(Request $request){
        $nurse_type = json_encode($request->nurseType);
        $nursing_type_1 = json_encode($request->nursing_type_1);
        $nursing_type_2 = json_encode($request->nursing_type_2);
        $nursing_type_3 = json_encode($request->nursing_type_3);
        $nurse_practitioner_menu = json_encode($request->nurse_practitioner_menu);
        $specialties = json_encode($request->specialties);
        $speciality_entry_1 = json_encode($request->speciality_entry_1);
        $speciality_entry_2 = json_encode($request->speciality_entry_2);
        $speciality_entry_3 = json_encode($request->speciality_entry_3);
        $speciality_entry_4 = json_encode($request->speciality_entry_4);
        $surgical_row_box = json_encode($request->surgical_row_box);
        $surgical_obs_care = json_encode($request->surgical_obs_care);
        $surgical_operative_care_1 = json_encode($request->surgical_operative_care_1);
        $surgical_operative_care_2 = json_encode($request->surgical_operative_care_2);
        $surgical_operative_care_3 = json_encode($request->surgical_operative_care_3);
        $neonatal_care = json_encode($request->neonatal_care);
        $surgical_rowpad_box = json_encode($request->surgical_rowpad_box);
        $surgical_operative_carep_1 = json_encode($request->surgical_operative_carep_1);
        $surgical_operative_carep_2 = json_encode($request->surgical_operative_carep_2);
        $surgical_operative_carep_3 = json_encode($request->surgical_operative_carep_3);
        
        $assistent_level = $request->assistent_level;
        $declare_information = $request->declare_information;
        $bio = $request->bio;
        $degree = json_encode($request->degree);
        $employee_status = $request->employee_status;
        $permanent_status = $request->permanent_status;
        $temporary_status = $request->temporary_status;

        if($employee_status == "Permanent"){
            $permanent_status1 = $permanent_status;
        }else{
            $permanent_status1 = "";
        }

        if($employee_status == "Temporary"){
            $temporary_status1 = $temporary_status;
        }else{
            $temporary_status1 = "";
        }

        $post = User::find($request->user_id);
        $post->nurseType = $nurse_type;
        $post->entry_level_nursing = $nursing_type_1;
        $post->registered_nurses = $nursing_type_2;
        $post->advanced_practioner = $nursing_type_3;
        $post->nurse_prac = $nurse_practitioner_menu;
        $post->specialties = $specialties;
        $post->adults = $speciality_entry_1;
        $post->maternity = $speciality_entry_2;
        $post->paediatrics_neonatal = $speciality_entry_3;
        $post->community = $speciality_entry_4;
        $post->surgical_preoperative = $surgical_row_box;
        $post->surgical_obstrics_gynacology = $surgical_obs_care;
        $post->operating_room = $surgical_operative_care_1;
        $post->operating_room_scout = $surgical_operative_care_2;
        $post->operating_room_scrub = $surgical_operative_care_3;
        $post->neonatal_care = $neonatal_care;
        $post->paedia_surgical_preoperative = $surgical_rowpad_box;
        $post->pad_op_room = $surgical_operative_carep_1;
        $post->pad_qr_scout = $surgical_operative_carep_2;
        $post->pad_qr_scrub = $surgical_operative_carep_3;
        
        $post->assistent_level = $assistent_level;
        $post->declaration_status = $declare_information;
        $post->bio = $bio;
        $post->degree = $degree;
        $post->current_employee_status = $employee_status;
        $post->permanent_status = $permanent_status1;
        $post->temporary_status = $temporary_status1;
        $post->professional_info_status = "1";
        $run = $post->save();

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/my-profile');
            $json['message'] = 'Professional Information Updated Successfully';
         } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }
        
        echo json_encode($json);
    }
    
    public function changepassword(UserChangePasswordRequest $request)
    {
        try {
            $data = $request->all();
            $run = $this->authServices->changePassword($data);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo',['parameter' =>'Password'])]);
            } else {
                return response()->json(['status' => '0', 'message' => "old password doesn't match"]);
            }
        }catch (\Exception $e) {
            log::error('Error in SettingController/changepassword :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    
     public function update_profession(Request $request)
    {       
          if ($request->hasFile('image_evidence')) {
            $profile_image = time() . '.' . $request->image_evidence->extension();

            if ($request->image_evidence->move(public_path('/nurse/assets/imgs/evidence_of_year_level/'), $profile_image)) {
                $professioninsert['evidence_of_year_level'] = '/nurse/assets/imgs/evidence_of_year_level/' . $profile_image;
            }
        }
        
            $lastRecord =ProfessionModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
            if ($lastRecord) { $lastRecord->delete(); }
            $professioninsert['profession'] = $request->profession;
            $professioninsert['practitioner_type'] = $request->practitioner_type;
            $professioninsert['year_level'] = $request->assistent_level;
            $professioninsert['evidence_type'] = $request->evidence_type;
            $professioninsert['user_id'] =  Auth::guard('nurse_middle')->user()->id;
           
            $professioninsert['status'] = '0';
            $professioninsert['created_at'] = Carbon::now('Asia/Kolkata');

            $run = ProfessionModel::insert($professioninsert);
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

    // public function updateEducation(Request $request){
    //     $degree = json_encode($request->ndegree);

    //     $institution = $request->institution;
        
    //     $user_id = $request->user_id;
    //     $graduation_start_date = $request->graduation_start_date;
        
    //     $professional_certification = json_encode($request->professional_certification);
    //     $license_number = $request->license_number;
    //     $country = $request->country;
    //     $state = $request->state;
    //     $expiration_date = $request->expiration_date;
    //     $training_courses = $request->training_courses;
    //     $training_workshop = json_encode($request->training_workshop);
    //     $declare_information = $request->declare_information_edu;

    //     $training_courses = $request->training_courses;
    //     $additional_license_number = $request->additional_license_number;
    //     $additional_expiry = $request->additional_expiry;
    //     $additional_upload_certification = $request->file('additional_upload_certification');
    //     //echo count($additional_license_number);die;
    //     $getedudata = DB::table("user_education_cerification")->where("user_id",$user_id)->first();

    //     //$certificate_array = array();
    //     // for($i=0;$i<count($training_courses);$i++){
    //     //     if(!empty($additional_upload_certification[$i])){
    //     //         $name1=$additional_upload_certification[$i]->getClientOriginalName();
    //     //         $name= time().$name1;
    //     //         $destinationPathcert = public_path()."/uploads/certificates"; 
    //     //         $additional_upload_certification[$i]->move($destinationPathcert,$name);
    //     //     }else{
    //     //         $certificate_data = json_decode($getedudata->additional_training_data);
    //     //         if(!empty($certificate_data) && !empty($certificate_data[$i])){
    //     //             $name = $certificate_data[$i]->additional_upload_certification;
    //     //         }else{
    //     //             $name = "";
    //     //         }
    //     //     }
            
    //     //     $certificate_array[] = array("training_courses"=>$training_courses[$i],"additional_license_number"=>$additional_license_number[$i],"additional_expiry"=>$additional_expiry[$i],"additional_upload_certification"=>$name);
    //     // }

    //     // $certificate_json = json_encode($certificate_array);

    //     $training_certificate = $request->training_certificate;
    //     $certificate_license_number = $request->certificate_license_number;
    //     $certificate_expiry = $request->certificate_expiry;
    //     $regulating_body = $request->regulating_body;
    //     $certificate_upload_certification = $request->file('certificate_upload_certification');

    //     $new_certificate_array = array();
    //     if(!empty($training_certificate)){
    //         for($i=0;$i<count($training_certificate);$i++){
    //             if(!empty($certificate_upload_certification[$i])){
    //                 $name1=$certificate_upload_certification[$i]->getClientOriginalName();
    //                 $name= time().$name1;
    //                 $destinationPathcert = public_path()."/uploads/certificates"; 
    //                 $certificate_upload_certification[$i]->move($destinationPathcert,$name);
    //             }else{
    //                 $certificate_data = json_decode($getedudata->additional_certification);
    //                 //print_r($certificate_data);die;
    //                 if(!empty($certificate_data) && !empty($certificate_data[$i])){
    //                     $name = $certificate_data[$i]->certificate_upload_certification;
    //                 }else{
    //                     $name = "";
    //                 }
    //             }
                
    //             $new_certificate_array[] = array("certificate_id"=>$i+1,"training_certificate"=>$training_certificate[$i],"certificate_license_number"=>$certificate_license_number[$i],"certificate_expiry"=>$certificate_expiry[$i],"regulating_body"=>$regulating_body[$i],"certificate_upload_certification"=>$name);
    //         }

    //         $new_certificate_json = json_encode($new_certificate_array);
    //     }else{
    //         $new_certificate_json = '';
    //     }

    //     $bls_data = $request->bls_data;
    //     if($bls_data){
    //         $bls_count = count($bls_data);
    //     }else{
    //         $bls_count = 0;
    //     }
    //     $bls_license_number = $request->bls_license_number;
    //     $bls_expiry = $request->bls_expiry;
    //     $bls_upload_certification = $request->file('bls_upload_certification');

    //     $bls_data_array = array();
    //     if($getedudata){
    //     $certificate_data = json_decode($getedudata->bls_data);
    //     }else{
    //         $certificate_data = '' ;
    //     }

    //     for($i=0;$i<$bls_count;$i++){
    //         if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
    //             $blsimg = json_decode($certificate_data[$i]->bls_upload_certification);
    //         }else{
    //             $blsimg = '';
    //         }
            
    //         //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
    //         if(!empty($bls_upload_certification[$i])){
    //             $bls_img = Helpers::multipleFileUpload($bls_upload_certification[$i],$blsimg);
    //         }else{
    //             $bls_img = Helpers::multipleFileUpload('',$blsimg);
    //         }
            
    //         $bls_data_array[] = array("bls_certification_id"=>$bls_data[$i],"bls_license_number"=>$bls_license_number[$i],"bls_expiry"=>$bls_expiry[$i],"bls_upload_certification"=>$bls_img);
    //     }

    //     if(!empty($bls_data_array)){
    //         $bls_data_json = json_encode($bls_data_array);
    //     }else{
    //         $bls_data_json = '';
    //     }
        
        

    //     $acls_data = $request->acls_data;
    //     if($acls_data){
    //         $acls_count = count($acls_data);
    //     }else{
    //         $acls_count = 0;
    //     }
    //     $aclsnamearr = $request->aclsnamearr;
    //     $acls_license_number = $request->acls_license_number;
    //     $acls_expiry = $request->acls_expiry;
    //     $acls_upload_certification = $request->file('acls_upload_certification');

    //     $acls_data_array = array();
    //     if($getedudata){
    //     $certificate_data = json_decode($getedudata->acls_data);
    //     }else{
    //         $certificate_data = '' ;
    //     }

    //     for($i=0;$i<$acls_count;$i++){
    //         if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
    //             $aclsimg = json_decode($certificate_data[$i]->acls_upload_certification);
    //         }else{
    //             $aclsimg = '';
    //         }
    //         //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
    //         if(!empty($acls_upload_certification[$i])){
    //             $acls_img = Helpers::multipleFileUpload($acls_upload_certification[$i],$aclsimg);
    //         }else{
    //             $acls_img = Helpers::multipleFileUpload('',$aclsimg);
    //         }
    //         //echo $acls_img;
            
    //         $acls_data_array[] = array("acls_certification_id"=>$aclsnamearr[$i],"acls_license_number"=>$acls_license_number[$i],"acls_expiry"=>$acls_expiry[$i],"acls_upload_certification"=>$acls_img);
    //     }

    //     if(!empty($acls_data_array)){
    //         $acls_data_json = json_encode($acls_data_array);
    //     }else{
    //         $acls_data_json = '';
    //     }

    //     $cpr_data = $request->cpr_data;
    //     if($cpr_data){
    //         $cpr_count = count($cpr_data);
    //     }else{
    //         $cpr_count = 0;
    //     }
    //     $cprnamearr = $request->cprnamearr;

    //     $cpr_license_number = $request->cpr_license_number;
    //     $cpr_expiry = $request->cpr_expiry;
    //     $cpr_upload_certification = $request->file('cpr_upload_certification');

    //     $cpr_data_array = array();
    //     if($getedudata){
    //     $certificate_data = json_decode($getedudata->cpr_data);
    //     }else{
    //         $certificate_data = '' ;
    //     }

    //     for($i=0;$i<$cpr_count;$i++){
    //         if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
    //             $cprimg = json_decode($certificate_data[$i]->cpr_upload_certification);
    //         }else{
    //             $cprimg = '';
    //         }
            
    //         //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
    //         if(!empty($cpr_upload_certification[$i])){
    //             $cpr_img = Helpers::multipleFileUpload($cpr_upload_certification[$i],$cprimg);
    //         }else{
    //             $cpr_img = Helpers::multipleFileUpload('',$cprimg);
    //         }
            
    //         $cpr_data_array[] = array("cpr_certification_id"=>$cprnamearr[$i],"cpr_license_number"=>$cpr_license_number[$i],"cpr_expiry"=>$cpr_expiry[$i],"cpr_upload_certification"=>$cpr_img);
    //     }

    //     if(!empty($cpr_data_array)){
    //         $cpr_data_json = json_encode($cpr_data_array);
            
    //     }else{
    //         $cpr_data_json = '';
    //     }

    //     $nrp_data = $request->nrp_data;
    //     if($nrp_data){
    //         $nrp_count = count($nrp_data);
    //     }else{
    //         $nrp_count = 0;
    //     }
    //     $nrpnamearr = $request->nrpnamearr;
    //     $nrp_license_number = $request->nrp_license_number;
    //     $nrp_expiry = $request->nrp_expiry;
    //     $nrp_upload_certification = $request->file('nrp_upload_certification');

    //     $nrp_data_array = array();
    //     if($getedudata){
    //     $certificate_data = json_decode($getedudata->nrp_data);
    //     }else{
    //         $certificate_data = '' ;
    //     }

    //     for($i=0;$i<$nrp_count;$i++){
    //         if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
    //             $nrpimg = json_decode($certificate_data[$i]->nrp_upload_certification);
    //         }else{
    //             $nrpimg = '';
    //         }
            
    //         //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
    //         if(!empty($nrp_upload_certification[$i])){
    //             $nrp_img = Helpers::multipleFileUpload($nrp_upload_certification[$i],$nrpimg);
    //         }else{
    //             $nrp_img = Helpers::multipleFileUpload('',$nrpimg);
    //         }
            
    //         $nrp_data_array[] = array("nrp_certification_id"=>$nrpnamearr[$i],"nrp_license_number"=>$nrp_license_number[$i],"nrp_expiry"=>$nrp_expiry[$i],"nrp_upload_certification"=>$nrp_img);
    //     }

    //     if(!empty($nrp_data_array)){
    //         $nrp_data_json = json_encode($nrp_data_array);
    //     }else{
    //         $nrp_data_json = '';
    //     }

    //     $pls_data = $request->pls_data;
    //     if($pls_data){
    //         $pls_count = count($pls_data);
    //     }else{
    //         $pls_count = 0;
    //     }
    //     $plsnamearr = $request->plsnamearr;
    //     $pls_license_number = $request->pls_license_number;
    //     $pls_expiry = $request->pls_expiry;
    //     $pls_upload_certification = $request->file('pls_upload_certification');

    //     $pls_data_array = array();
    //     if($getedudata){
    //     $certificate_data = json_decode($getedudata->pals_data);
    //     }else{
    //         $certificate_data = '' ;
    //     }
    

    //     for($i=0;$i<$pls_count;$i++){
    //         if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
    //             $plsimg = json_decode($certificate_data[$i]->pls_upload_certification);
    //         }else{
    //             $plsimg = '';
    //         }
            
    //         //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
    //         if(!empty($pls_upload_certification[$i])){
    //             $pls_img = Helpers::multipleFileUpload($pls_upload_certification[$i],$plsimg);
    //         }else{
    //             $pls_img = Helpers::multipleFileUpload('',$plsimg);
    //         }
            
    //         $pls_data_array[] = array("pls_certification_id"=>$plsnamearr[$i],"pls_license_number"=>$pls_license_number[$i],"pls_expiry"=>$pls_expiry[$i],"pls_upload_certification"=>$pls_img);
    //     }

    //     if(!empty($pls_data_array)){
    //         $pls_data_json = json_encode($pls_data_array);
    //     }else{
    //         $pls_data_json = '';
    //     }

    //     $rn_data = $request->rn_data;
    //     if($rn_data){
    //         $rn_count = count($rn_data);
    //     }else{
    //         $rn_count = 0;
    //     }
    //     $rnnamearr = $request->rnnamearr;
    //     $rn_license_number = $request->rn_license_number;
    //     $rn_expiry = $request->rn_expiry;
    //     $rn_upload_certification = $request->file('rn_upload_certification');

    //     $rn_data_array = array();
    //     if($getedudata){
    //     $certificate_data = json_decode($getedudata->rn_data);
    //     }else{
    //         $certificate_data = '' ;
    //     }

    //     for($i=0;$i<$rn_count;$i++){
    //         if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
    //             $rnimg = json_decode($certificate_data[$i]->rn_upload_certification);
    //         }else{
    //             $rnimg = '';
    //         }
            
    //         //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
    //         if(!empty($rn_upload_certification[$i])){
    //             $rn_img = Helpers::multipleFileUpload($rn_upload_certification[$i],$rnimg);
    //         }else{
    //             $rn_img = Helpers::multipleFileUpload('',$rnimg);
    //         }
            
    //         $rn_data_array[] = array("rn_certification_id"=>$rnnamearr[$i],"rn_license_number"=>$rn_license_number[$i],"rn_expiry"=>$rn_expiry[$i],"rn_upload_certification"=>$rn_img);
    //     }

    //     if(!empty($rn_data_array)){
    //         $rn_data_json = json_encode($rn_data_array);
    //     }else{
    //         $rn_data_json = '';
    //     }

    //     $np_data = $request->np_data;
    //     if($np_data){
    //         $np_count = count($np_data);
    //     }else{
    //         $np_count = 0;
    //     }
    //     $npnamearr = $request->npnamearr;
    //     $np_license_number = $request->np_license_number;
    //     $np_expiry = $request->np_expiry;
    //     $np_upload_certification = $request->file('np_upload_certification');

    //     $np_data_array = array();
    //     if($getedudata){
    //     $certificate_data = json_decode($getedudata->np_data);
    //     }else{
    //         $certificate_data = '' ;
    //     }

    //     for($i=0;$i<$np_count;$i++){
    //         if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
    //             $npimg = json_decode($certificate_data[$i]->np_upload_certification);
    //         }else{
    //             $npimg = '';
    //         }
            
    //         //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
    //         if(!empty($np_upload_certification[$i])){
    //             $np_img = Helpers::multipleFileUpload($np_upload_certification[$i],$npimg);
    //         }else{
    //             $np_img = Helpers::multipleFileUpload('',$npimg);
    //         }
            
    //         $np_data_array[] = array("np_certification_id"=>$npnamearr[$i],"np_license_number"=>$np_license_number[$i],"np_expiry"=>$np_expiry[$i],"np_upload_certification"=>$np_img);
    //     }

    //     if(!empty($np_data_array)){
    //         $np_data_json = json_encode($np_data_array);
    //     }else{
    //         $np_data_json = '';
    //     }

    //     $cn_data = $request->cn_data;
    //     if($cn_data){
    //         $cn_count = count($cn_data);
    //     }else{
    //         $cn_count = 0;
    //     }
    //     $cnnamearr = $request->cnnamearr;
    //     $cn_license_number = $request->cn_license_number;
    //     $cn_expiry = $request->cn_expiry;
    //     $cn_upload_certification = $request->file('cn_upload_certification');
    //     //print_r($cn_upload_certification);die;
    //     $cn_data_array = array();
    //     if($getedudata){
    //     $certificate_data = json_decode($getedudata->cna_data);
    //     }else{
    //     $certificate_data = '' ;
    //     }
        

    //     for($i=0;$i<$cn_count;$i++){
    //         if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
    //             $cnimg = json_decode($certificate_data[$i]->cn_upload_certification);
    //         }else{
    //             $cnimg = '';
    //         }
            
    //         //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
    //         if(!empty($cn_upload_certification[$i])){

    //             $cn_img = Helpers::multipleFileUpload($cn_upload_certification[$i],$cnimg);
    //         }else{
    //             $cn_img = Helpers::multipleFileUpload('',$cnimg);
    //         }
            
    //         $cn_data_array[] = array("cn_certification_id"=>$cnnamearr[$i],"cn_license_number"=>$cn_license_number[$i],"cn_expiry"=>$cn_expiry[$i],"cn_upload_certification"=>$cn_img);
    //     }
        

    //     if(!empty($cn_data_array)){
    //         $cn_data_json = json_encode($cn_data_array);
    //     }else{
    //         $cn_data_json = '';
    //     }

    //     $lpn_data = $request->lpn_data;
    //     if($lpn_data){
    //         $lpn_count = count($lpn_data);
    //     }else{
    //         $lpn_count = 0;
    //     }
    //     $lpnnamearr = $request->lpnnamearr;
    //     $lpn_license_number = $request->lpn_license_number;
    //     $lpn_expiry = $request->lpn_expiry;
    //     $lpn_upload_certification = $request->file('lpn_upload_certification');

    //     $lpn_data_array = array();
    //     if($getedudata){
    //     $certificate_data = json_decode($getedudata->lpn_data);
    //     }else{
    //     $certificate_data = '' ;
    //     }
        
    //     for($i=0;$i<$lpn_count;$i++){
    //         if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
    //             $lpnimg = json_decode($certificate_data[$i]->lpn_upload_certification);
    //         }else{
    //             $lpnimg = '';
    //         }
            
    //         //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
    //         if(!empty($lpn_upload_certification[$i])){

    //             $lpn_img = Helpers::multipleFileUpload($lpn_upload_certification[$i],$lpnimg);
    //         }else{
    //             $lpn_img = Helpers::multipleFileUpload('',$lpnimg);
    //         }
            
    //         $lpn_data_array[] = array("lpn_certification_id"=>$lpnnamearr[$i],"lpn_license_number"=>$lpn_license_number[$i],"lpn_expiry"=>$lpn_expiry[$i],"lpn_upload_certification"=>$lpn_img);
    //     }

    //     if(!empty($lpn_data_array)){
    //         $lpn_data_json = json_encode($lpn_data_array);
    //     }else{
    //         $lpn_data_json = '';
    //     }

    //     $crna_data = $request->crn_data;
    //     if($crna_data){
    //         $crna_count = count($crna_data);
    //     }else{
    //         $crna_count = 0;
    //     }
    //     $crnanamearr = $request->crnanamearr;
    //     //print_r($crna_count);die;
    //     $crna_license_number = $request->crna_license_number;
    //     $crna_expiry = $request->crna_expiry;
    //     $crna_upload_certification = $request->file('crna_upload_certification');

    //     $crna_data_array = array();
    //     if($getedudata){
    //     $certificate_data = json_decode($getedudata->crna_data);
    //     }else{
    //     $certificate_data = '' ;
    //     }


    //     for($i=0;$i<$crna_count;$i++){
    //         if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
    //             $crnaimg = json_decode($certificate_data[$i]->crna_upload_certification);
    //         }else{
    //             $crnaimg = '';
    //         }
            
    //         //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
    //         if(!empty($crna_upload_certification[$i])){

    //             $crna_img = Helpers::multipleFileUpload($crna_upload_certification[$i],$crnaimg);
    //         }else{
    //             $crna_img = Helpers::multipleFileUpload('',$crnaimg);
    //         }
            
    //         $crna_data_array[] = array("crna_certification_id"=>$crnanamearr[$i],"crna_license_number"=>$crna_license_number[$i],"crna_expiry"=>$crna_expiry[$i],"crna_upload_certification"=>$crna_img);
    //     }
        
    //     if(!empty($crna_data_array)){
    //         $crna_data_json = json_encode($crna_data_array);
    //     }else{
    //         $crna_data_json = '';
    //     }

    //     $cnm_data = $request->cnm_data;
    //     if($cnm_data){
    //         $cnm_count = count($cnm_data);
    //     }else{
    //         $cnm_count = 0;
    //     }
    //     $cnmnamearr = $request->cnmnamearr;
    //     //print_r($crna_count);die;
    //     $cnm_license_number = $request->cnm_license_number;
    //     $cnm_expiry = $request->cnm_expiry;
    //     $cnm_upload_certification = $request->file('cnm_upload_certification');

    //     $cnm_data_array = array();
    //     if($getedudata){
    //     $certificate_data = json_decode($getedudata->cnm_data);
    //     }else{
    //     $certificate_data = '' ;
    //     }


    //     for($i=0;$i<$cnm_count;$i++){
    //         if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
    //             $cnmimg = json_decode($certificate_data[$i]->cnm_upload_certification);
    //         }else{
    //             $cnmimg = '';
    //         }
            
    //         //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
    //         if(!empty($cnm_upload_certification[$i])){

    //             $cnm_img = Helpers::multipleFileUpload($cnm_upload_certification[$i],$cnmimg);
    //         }else{
    //             $cnm_img = Helpers::multipleFileUpload('',$cnmimg);
    //         }
            
    //         $cnm_data_array[] = array("cnm_certification_id"=>$cnmnamearr[$i],"cnm_license_number"=>$cnm_license_number[$i],"cnm_expiry"=>$cnm_expiry[$i],"cnm_upload_certification"=>$cnm_img);
    //     }
        
    //     if(!empty($cnm_data_array)){
    //         $cnm_data_json = json_encode($cnm_data_array);
    //     }else{
    //         $cnm_data_json = '';
    //     }

    //     $ons_data = $request->ons_data;
    //     if($ons_data){
    //         $ons_count = count($ons_data);
    //     }else{
    //         $ons_count = 0;
    //     }
    //     $onsnamearr = $request->onsnamearr;
    //     //print_r($crna_count);die;
    //     $ons_license_number = $request->ons_license_number;
    //     $ons_expiry = $request->ons_expiry;
    //     $ons_upload_certification = $request->file('ons_upload_certification');

    //     $ons_data_array = array();
    //     if($getedudata){
    //     $certificate_data = json_decode($getedudata->ons_data);
    //     }else{
    //     $certificate_data = '' ;
    //     }
       

    //     for($i=0;$i<$ons_count;$i++){
    //         if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
    //             $onsimg = json_decode($certificate_data[$i]->ons_upload_certification);
    //         }else{
    //             $onsimg = '';
    //         }
            
    //         //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
    //         if(!empty($ons_upload_certification[$i])){

    //             $ons_img = Helpers::multipleFileUpload($ons_upload_certification[$i],$onsimg);
    //         }else{
    //             $ons_img = Helpers::multipleFileUpload('',$onsimg);
    //         }
            
    //         $ons_data_array[] = array("ons_certification_id"=>$onsnamearr[$i],"ons_license_number"=>$ons_license_number[$i],"ons_expiry"=>$ons_expiry[$i],"ons_upload_certification"=>$ons_img);
    //     }
        
    //     if(!empty($ons_data_array)){
    //         $ons_data_json = json_encode($ons_data_array);
    //     }else{
    //         $ons_data_json = '';
    //     }

    //     $msw_data = $request->msw_data;
    //     if($msw_data){
    //         $msw_count = count($msw_data);
    //     }else{
    //         $msw_count = 0;
    //     }
    //     $mswnamearr = $request->mswnamearr;
        
    //     $msw_license_number = $request->msw_license_number;
    //     $msw_expiry = $request->msw_expiry;
    //     $msw_upload_certification = $request->file('msw_upload_certification');

    //     $msw_data_array = array();
    //     if($getedudata){
    //     $certificate_data = json_decode($getedudata->msw_data);
    //     }else{
    //     $certificate_data = '' ;
    //     }


    //     for($i=0;$i<$msw_count;$i++){
    //         if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
    //             $mswimg = json_decode($certificate_data[$i]->msw_upload_certification);
    //         }else{
    //             $mswimg = '';
    //         }
            
    //         //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
    //         if(!empty($msw_upload_certification[$i])){

    //             $msw_img = Helpers::multipleFileUpload($msw_upload_certification[$i],$mswimg);
    //         }else{
    //             $msw_img = Helpers::multipleFileUpload('',$mswimg);
    //         }
            
    //         $msw_data_array[] = array("msw_certification_id"=>$mswnamearr[$i],"msw_license_number"=>$msw_license_number[$i],"msw_expiry"=>$msw_expiry[$i],"msw_upload_certification"=>$msw_img);
    //     }
    //     //print_r(count($msw_data_array));die;
    //     if(!empty($msw_data_array)){
    //         $msw_data_json = json_encode($msw_data_array);
    //     }else{
    //         $msw_data_json = '';
    //     }

    //     $ain_data = $request->ain_data;
    //     if($ain_data){
    //         $ain_count = count($ain_data);
    //     }else{
    //         $ain_count = 0;
    //     }
    //     $ainnamearr = $request->ainnamearr;
    //     //print_r($crna_count);die;
    //     $ain_license_number = $request->ain_license_number;
    //     $ain_expiry = $request->ain_expiry;
    //     $ain_upload_certification = $request->file('ain_upload_certification');

    //     $ain_data_array = array();
    //     if($getedudata){
    //     $certificate_data = json_decode($getedudata->ain_data);
    //     }else{
    //     $certificate_data = '' ;
    //     }
        

    //     for($i=0;$i<$ain_count;$i++){
    //         if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
    //             $ainimg = json_decode($certificate_data[$i]->ain_upload_certification);
    //         }else{
    //             $ainimg = '';
    //         }
            
    //         //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
    //         if(!empty($ain_upload_certification[$i])){

    //             $ain_img = Helpers::multipleFileUpload($ain_upload_certification[$i],$ainimg);
    //         }else{
    //             $ain_img = Helpers::multipleFileUpload('',$ainimg);
    //         }
            
    //         $ain_data_array[] = array("ain_certification_id"=>$ainnamearr[$i],"ain_license_number"=>$ain_license_number[$i],"ain_expiry"=>$ain_expiry[$i],"ain_upload_certification"=>$ain_img);
    //     }
        
    //     if(!empty($ain_data_array)){
    //         $ain_data_json = json_encode($ain_data_array);
    //     }else{
    //         $ain_data_json = '';
    //     }

    //     $rpn_data = $request->rpn_data;
    //     if($rpn_data){
    //         $rpn_count = count($rpn_data);
    //     }else{
    //         $rpn_count = 0;
    //     }
    //     $rpnnamearr = $request->rpnnamearr;
    //     //print_r($crna_count);die;
    //     $rpn_license_number = $request->rpn_license_number;
    //     $rpn_expiry = $request->rpn_expiry;
    //     $rpn_upload_certification = $request->file('rpn_upload_certification');
    //     if($getedudata){
    //     $certificate_data = json_decode($getedudata->rpn_data);
    //     }else{
    //     $certificate_data = '' ;
    //     }
      

    //     $rpn_data_array = array();

    //     for($i=0;$i<$rpn_count;$i++){
    //         if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
    //             $rpnimg = json_decode($certificate_data[$i]->rpn_upload_certification);
    //         }else{
    //             $rpnimg = '';
    //         }
            
    //         //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
    //         if(!empty($rpn_upload_certification[$i])){

    //             $rpn_img = Helpers::multipleFileUpload($rpn_upload_certification[$i],$rpnimg);
    //         }else{
    //             $rpn_img = Helpers::multipleFileUpload('',$rpnimg);
    //         }
            
    //         $rpn_data_array[] = array("rpn_certification_id"=>$rpnnamearr[$i],"rpn_license_number"=>$rpn_license_number[$i],"rpn_expiry"=>$rpn_expiry[$i],"rpn_upload_certification"=>$rpn_img);
    //     }
        
    //     if(!empty($rpn_data_array)){
    //         $rpn_data_json = json_encode($rpn_data_array);
    //     }else{
    //         $rpn_data_json = '';
    //     }

    //     if($request->nl_data){
    //         $nl_data = json_encode($request->nl_data);
    //     }else{
    //         $nl_data = '';
    //     }

    //     $file = $request->file('degree_transcript');
    //     if($getedudata){
    //     $dtranaimg = json_decode($getedudata->degree_transcript);
      
    //     $dtranimgs = Helpers::multipleFileUpload($file,$dtranaimg);
    //    }else{
    //       $dtranimgs = Helpers::multipleFileUpload($file,'');
    //    }
        
        
        
    //     if(!empty($getedudata)>0){

    //         $post1 = User::find($user_id);
    //         $post1->degree = $degree;
    //         $post1->save();

            
            
            
            
    //         $run = EducationModel::where('user_id',$user_id)->update(['institution'=>$institution,'graduate_start_date'=>$graduation_start_date,'professional_certifications'=>$professional_certification,'licence_number'=>$license_number,'country'=>$country,'state'=>$state,'expiration_date'=>$expiration_date,'training_courses'=>$training_courses,'training_workshops'=>$training_workshop,'complete_status'=>1,'declaration_status'=>$declare_information,'acls_data'=>$acls_data_json,'bls_data'=>$bls_data_json,'cpr_data'=>$cpr_data_json,'nrp_data'=>$nrp_data_json,'pals_data'=>$pls_data_json,'rn_data'=>$rn_data_json,'np_data'=>$np_data_json,'cna_data'=>$cn_data_json,'lpn_data'=>$lpn_data_json,'crna_data'=>$crna_data_json,'cnm_data'=>$cnm_data_json,'ons_data'=>$ons_data_json,'msw_data'=>$msw_data_json,'ain_data'=>$ain_data_json,'rpn_data'=>$rpn_data_json,'nl_data'=>$nl_data,'additional_certification'=>$new_certificate_json]);
    //     }else{

            

    //         $post = new EducationModel();
    //         $post->user_id = $user_id;
            
    //         $post->institution = $institution;
    //         $post->graduate_start_date = $graduation_start_date;
    //         $post->degree_transcript = $dtranimgs;
    //         $post->professional_certifications = $professional_certification;
    //         $post->acls_data = $acls_data_json;
    //         $post->bls_data = $bls_data_json;
    //         $post->cpr_data = $cpr_data_json;
    //         $post->nrp_data = $nrp_data_json;
    //         $post->pals_data = $pls_data_json;
    //         $post->rn_data = $rn_data_json;
    //         $post->np_data = $np_data_json;
    //         $post->cna_data = $cn_data_json;
    //         $post->lpn_data = $lpn_data_json;
    //         $post->crna_data = $crna_data_json;
    //         $post->cnm_data = $cnm_data_json;
    //         $post->ons_data = $ons_data_json;
    //         $post->msw_data = $msw_data_json;
    //         $post->ain_data = $ain_data_json;
    //         $post->rpn_data = $rpn_data_json;
    //         $post->nl_data = $nl_data;
    //         // $post->licence_number = $license_number;
    //         // $post->country = $country;
    //         // $post->state = $state;
    //         // $post->expiration_date = $expiration_date;
    //         // $post->training_courses = $training_courses;
    //         // $post->training_workshops = $training_workshop;
            
    //         $post->additional_certification = $new_certificate_json;
    //         $post->complete_status = 1;
    //         $run = $post->save();

    //         $post1 = User::find($user_id);
    //         $post1->degree = $degree;
    //         $post1->save();
    //     }

    //     if ($run) {
    //         $json['status'] = 1;
    //         $json['url'] = url('nurse/my-profile');
    //         $json['message'] = 'Education Information Updated Successfully';
    //      } else {
    //         $json['status'] = 0;
    //         $json['message'] = 'Please Try Again';
    //     }
        
    //     echo json_encode($json);
    // }
    public function updateEducation(Request $request){
       dd($request->file('test_img'));
        $degree = json_encode($request->ndegree);

        $institution = $request->institution;
        
        $user_id = $request->user_id;
        $graduation_start_date = $request->graduation_start_date;
        
        $professional_certification = json_encode($request->professional_certification);
        $license_number = $request->license_number;
        $country = $request->country;
        $state = $request->state;
        $expiration_date = $request->expiration_date;
        $training_courses = $request->training_courses;
        $training_workshop = json_encode($request->training_workshop);
        $declare_information = $request->declare_information_edu;

        $training_courses = $request->training_courses;
        $additional_license_number = $request->additional_license_number;
        $additional_expiry = $request->additional_expiry;
        $additional_upload_certification = $request->file('additional_upload_certification');
        //echo count($additional_license_number);die;
        $getedudata = DB::table("user_education_cerification")->where("user_id",$user_id)->first();

        //$certificate_array = array();
        // for($i=0;$i<count($training_courses);$i++){
        //     if(!empty($additional_upload_certification[$i])){
        //         $name1=$additional_upload_certification[$i]->getClientOriginalName();
        //         $name= time().$name1;
        //         $destinationPathcert = public_path()."/uploads/certificates"; 
        //         $additional_upload_certification[$i]->move($destinationPathcert,$name);
        //     }else{
        //         $certificate_data = json_decode($getedudata->additional_training_data);
        //         if(!empty($certificate_data) && !empty($certificate_data[$i])){
        //             $name = $certificate_data[$i]->additional_upload_certification;
        //         }else{
        //             $name = "";
        //         }
        //     }
            
        //     $certificate_array[] = array("training_courses"=>$training_courses[$i],"additional_license_number"=>$additional_license_number[$i],"additional_expiry"=>$additional_expiry[$i],"additional_upload_certification"=>$name);
        // }

        // $certificate_json = json_encode($certificate_array);

        $training_certificate = $request->training_certificate;
        $certificate_license_number = $request->certificate_license_number;
        $certificate_expiry = $request->certificate_expiry;
        $regulating_body = $request->regulating_body;
        $certificate_upload_certification = $request->file('certificate_upload_certification');

        $new_certificate_array = array();
        if(!empty($training_certificate)){
            for($i=0;$i<count($training_certificate);$i++){
                if(!empty($certificate_upload_certification[$i])){
                    $name1=$certificate_upload_certification[$i]->getClientOriginalName();
                    $name= time().$name1;
                    $destinationPathcert = public_path()."/uploads/certificates"; 
                    $certificate_upload_certification[$i]->move($destinationPathcert,$name);
                }else{
                    $certificate_data = json_decode($getedudata->additional_certification);
                    //print_r($certificate_data);die;
                    if(!empty($certificate_data) && !empty($certificate_data[$i])){
                        $name = $certificate_data[$i]->certificate_upload_certification;
                    }else{
                        $name = "";
                    }
                }
                
                $new_certificate_array[] = array("certificate_id"=>$i+1,"training_certificate"=>$training_certificate[$i],"certificate_license_number"=>$certificate_license_number[$i],"certificate_expiry"=>$certificate_expiry[$i],"regulating_body"=>$regulating_body[$i],"certificate_upload_certification"=>$name);
            }

            $new_certificate_json = json_encode($new_certificate_array);
        }else{
            $new_certificate_json = '';
        }

        $bls_data = $request->bls_data;
        if($bls_data){
            $bls_count = count($bls_data);
        }else{
            $bls_count = 0;
        }
        $bls_license_number = $request->bls_license_number;
        $bls_expiry = $request->bls_expiry;
        $bls_upload_certification = $request->file('bls_upload_certification');

        $bls_data_array = array();
        if($getedudata){
        $certificate_data = json_decode($getedudata->bls_data);
        }else{
            $certificate_data = '' ;
        }

        for($i=0;$i<$bls_count;$i++){
            if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                $blsimg = json_decode($certificate_data[$i]->bls_upload_certification);
            }else{
                $blsimg = '';
            }
            
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            if(!empty($bls_upload_certification[$i])){
                $bls_img = Helpers::multipleFileUpload($bls_upload_certification[$i],$blsimg);
            }else{
                $bls_img = Helpers::multipleFileUpload('',$blsimg);
            }
            
            $bls_data_array[] = array("bls_certification_id"=>$bls_data[$i],"bls_license_number"=>$bls_license_number[$i],"bls_expiry"=>$bls_expiry[$i],"bls_upload_certification"=>$bls_img);
        }

        if(!empty($bls_data_array)){
            $bls_data_json = json_encode($bls_data_array);
        }else{
            $bls_data_json = '';
        }
        
        

        $acls_data = $request->acls_data;
        if($acls_data){
            $acls_count = count($acls_data);
        }else{
            $acls_count = 0;
        }
        $aclsnamearr = $request->aclsnamearr;
        $acls_license_number = $request->acls_license_number;
        $acls_expiry = $request->acls_expiry;
        $acls_upload_certification = $request->file('acls_upload_certification');

        $acls_data_array = array();
        if($getedudata){
        $certificate_data = json_decode($getedudata->acls_data);
        }else{
            $certificate_data = '' ;
        }

        for($i=0;$i<$acls_count;$i++){
            if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                $aclsimg = json_decode($certificate_data[$i]->acls_upload_certification);
            }else{
                $aclsimg = '';
            }
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            if(!empty($acls_upload_certification[$i])){
                $acls_img = Helpers::multipleFileUpload($acls_upload_certification[$i],$aclsimg);
            }else{
                $acls_img = Helpers::multipleFileUpload('',$aclsimg);
            }
            //echo $acls_img;
            
            $acls_data_array[] = array("acls_certification_id"=>$aclsnamearr[$i],"acls_license_number"=>$acls_license_number[$i],"acls_expiry"=>$acls_expiry[$i],"acls_upload_certification"=>$acls_img);
        }

        if(!empty($acls_data_array)){
            $acls_data_json = json_encode($acls_data_array);
        }else{
            $acls_data_json = '';
        }

        $cpr_data = $request->cpr_data;
        if($cpr_data){
            $cpr_count = count($cpr_data);
        }else{
            $cpr_count = 0;
        }
        $cprnamearr = $request->cprnamearr;

        $cpr_license_number = $request->cpr_license_number;
        $cpr_expiry = $request->cpr_expiry;
        $cpr_upload_certification = $request->file('cpr_upload_certification');

        $cpr_data_array = array();
        if($getedudata){
        $certificate_data = json_decode($getedudata->cpr_data);
        }else{
            $certificate_data = '' ;
        }

        for($i=0;$i<$cpr_count;$i++){
            if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                $cprimg = json_decode($certificate_data[$i]->cpr_upload_certification);
            }else{
                $cprimg = '';
            }
            
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            if(!empty($cpr_upload_certification[$i])){
                $cpr_img = Helpers::multipleFileUpload($cpr_upload_certification[$i],$cprimg);
            }else{
                $cpr_img = Helpers::multipleFileUpload('',$cprimg);
            }
            
            $cpr_data_array[] = array("cpr_certification_id"=>$cprnamearr[$i],"cpr_license_number"=>$cpr_license_number[$i],"cpr_expiry"=>$cpr_expiry[$i],"cpr_upload_certification"=>$cpr_img);
        }

        if(!empty($cpr_data_array)){
            $cpr_data_json = json_encode($cpr_data_array);
            
        }else{
            $cpr_data_json = '';
        }

        $nrp_data = $request->nrp_data;
        if($nrp_data){
            $nrp_count = count($nrp_data);
        }else{
            $nrp_count = 0;
        }
        $nrpnamearr = $request->nrpnamearr;
        $nrp_license_number = $request->nrp_license_number;
        $nrp_expiry = $request->nrp_expiry;
        $nrp_upload_certification = $request->file('nrp_upload_certification');

        $nrp_data_array = array();
        if($getedudata){
        $certificate_data = json_decode($getedudata->nrp_data);
        }else{
            $certificate_data = '' ;
        }

        for($i=0;$i<$nrp_count;$i++){
            if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                $nrpimg = json_decode($certificate_data[$i]->nrp_upload_certification);
            }else{
                $nrpimg = '';
            }
            
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            if(!empty($nrp_upload_certification[$i])){
                $nrp_img = Helpers::multipleFileUpload($nrp_upload_certification[$i],$nrpimg);
            }else{
                $nrp_img = Helpers::multipleFileUpload('',$nrpimg);
            }
            
            $nrp_data_array[] = array("nrp_certification_id"=>$nrpnamearr[$i],"nrp_license_number"=>$nrp_license_number[$i],"nrp_expiry"=>$nrp_expiry[$i],"nrp_upload_certification"=>$nrp_img);
        }

        if(!empty($nrp_data_array)){
            $nrp_data_json = json_encode($nrp_data_array);
        }else{
            $nrp_data_json = '';
        }

        $pls_data = $request->pls_data;
        if($pls_data){
            $pls_count = count($pls_data);
        }else{
            $pls_count = 0;
        }
        $plsnamearr = $request->plsnamearr;
        $pls_license_number = $request->pls_license_number;
        $pls_expiry = $request->pls_expiry;
        $pls_upload_certification = $request->file('pls_upload_certification');

        $pls_data_array = array();
        if($getedudata){
        $certificate_data = json_decode($getedudata->pals_data);
        }else{
            $certificate_data = '' ;
        }
    

        for($i=0;$i<$pls_count;$i++){
            if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                $plsimg = json_decode($certificate_data[$i]->pls_upload_certification);
            }else{
                $plsimg = '';
            }
            
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            if(!empty($pls_upload_certification[$i])){
                $pls_img = Helpers::multipleFileUpload($pls_upload_certification[$i],$plsimg);
            }else{
                $pls_img = Helpers::multipleFileUpload('',$plsimg);
            }
            
            $pls_data_array[] = array("pls_certification_id"=>$plsnamearr[$i],"pls_license_number"=>$pls_license_number[$i],"pls_expiry"=>$pls_expiry[$i],"pls_upload_certification"=>$pls_img);
        }

        if(!empty($pls_data_array)){
            $pls_data_json = json_encode($pls_data_array);
        }else{
            $pls_data_json = '';
        }

        $rn_data = $request->rn_data;
        if($rn_data){
            $rn_count = count($rn_data);
        }else{
            $rn_count = 0;
        }
        $rnnamearr = $request->rnnamearr;
        $rn_license_number = $request->rn_license_number;
        $rn_expiry = $request->rn_expiry;
        $rn_upload_certification = $request->file('rn_upload_certification');

        $rn_data_array = array();
        if($getedudata){
        $certificate_data = json_decode($getedudata->rn_data);
        }else{
            $certificate_data = '' ;
        }

        for($i=0;$i<$rn_count;$i++){
            if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                $rnimg = json_decode($certificate_data[$i]->rn_upload_certification);
            }else{
                $rnimg = '';
            }
            
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            if(!empty($rn_upload_certification[$i])){
                $rn_img = Helpers::multipleFileUpload($rn_upload_certification[$i],$rnimg);
            }else{
                $rn_img = Helpers::multipleFileUpload('',$rnimg);
            }
            
            $rn_data_array[] = array("rn_certification_id"=>$rnnamearr[$i],"rn_license_number"=>$rn_license_number[$i],"rn_expiry"=>$rn_expiry[$i],"rn_upload_certification"=>$rn_img);
        }

        if(!empty($rn_data_array)){
            $rn_data_json = json_encode($rn_data_array);
        }else{
            $rn_data_json = '';
        }

        $np_data = $request->np_data;
        if($np_data){
            $np_count = count($np_data);
        }else{
            $np_count = 0;
        }
        $npnamearr = $request->npnamearr;
        $np_license_number = $request->np_license_number;
        $np_expiry = $request->np_expiry;
        $np_upload_certification = $request->file('np_upload_certification');

        $np_data_array = array();
        if($getedudata){
        $certificate_data = json_decode($getedudata->np_data);
        }else{
            $certificate_data = '' ;
        }

        for($i=0;$i<$np_count;$i++){
            if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                $npimg = json_decode($certificate_data[$i]->np_upload_certification);
            }else{
                $npimg = '';
            }
            
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            if(!empty($np_upload_certification[$i])){
                $np_img = Helpers::multipleFileUpload($np_upload_certification[$i],$npimg);
            }else{
                $np_img = Helpers::multipleFileUpload('',$npimg);
            }
            
            $np_data_array[] = array("np_certification_id"=>$npnamearr[$i],"np_license_number"=>$np_license_number[$i],"np_expiry"=>$np_expiry[$i],"np_upload_certification"=>$np_img);
        }

        if(!empty($np_data_array)){
            $np_data_json = json_encode($np_data_array);
        }else{
            $np_data_json = '';
        }

        $cn_data = $request->cn_data;
        if($cn_data){
            $cn_count = count($cn_data);
        }else{
            $cn_count = 0;
        }
        $cnnamearr = $request->cnnamearr;
        $cn_license_number = $request->cn_license_number;
        $cn_expiry = $request->cn_expiry;
        $cn_upload_certification = $request->file('cn_upload_certification');
        //print_r($cn_upload_certification);die;
        $cn_data_array = array();
        if($getedudata){
        $certificate_data = json_decode($getedudata->cna_data);
        }else{
        $certificate_data = '' ;
        }
        

        for($i=0;$i<$cn_count;$i++){
            if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                $cnimg = json_decode($certificate_data[$i]->cn_upload_certification);
            }else{
                $cnimg = '';
            }
            
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            if(!empty($cn_upload_certification[$i])){

                $cn_img = Helpers::multipleFileUpload($cn_upload_certification[$i],$cnimg);
            }else{
                $cn_img = Helpers::multipleFileUpload('',$cnimg);
            }
            
            $cn_data_array[] = array("cn_certification_id"=>$cnnamearr[$i],"cn_license_number"=>$cn_license_number[$i],"cn_expiry"=>$cn_expiry[$i],"cn_upload_certification"=>$cn_img);
        }
        

        if(!empty($cn_data_array)){
            $cn_data_json = json_encode($cn_data_array);
        }else{
            $cn_data_json = '';
        }

        $lpn_data = $request->lpn_data;
        if($lpn_data){
            $lpn_count = count($lpn_data);
        }else{
            $lpn_count = 0;
        }
        $lpnnamearr = $request->lpnnamearr;
        $lpn_license_number = $request->lpn_license_number;
        $lpn_expiry = $request->lpn_expiry;
        $lpn_upload_certification = $request->file('lpn_upload_certification');

        $lpn_data_array = array();
        if($getedudata){
        $certificate_data = json_decode($getedudata->lpn_data);
        }else{
        $certificate_data = '' ;
        }
        
        for($i=0;$i<$lpn_count;$i++){
            if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                $lpnimg = json_decode($certificate_data[$i]->lpn_upload_certification);
            }else{
                $lpnimg = '';
            }
            
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            if(!empty($lpn_upload_certification[$i])){

                $lpn_img = Helpers::multipleFileUpload($lpn_upload_certification[$i],$lpnimg);
            }else{
                $lpn_img = Helpers::multipleFileUpload('',$lpnimg);
            }
            
            $lpn_data_array[] = array("lpn_certification_id"=>$lpnnamearr[$i],"lpn_license_number"=>$lpn_license_number[$i],"lpn_expiry"=>$lpn_expiry[$i],"lpn_upload_certification"=>$lpn_img);
        }

        if(!empty($lpn_data_array)){
            $lpn_data_json = json_encode($lpn_data_array);
        }else{
            $lpn_data_json = '';
        }

        $crna_data = $request->crn_data;
        if($crna_data){
            $crna_count = count($crna_data);
        }else{
            $crna_count = 0;
        }
        $crnanamearr = $request->crnanamearr;
        //print_r($crna_count);die;
        $crna_license_number = $request->crna_license_number;
        $crna_expiry = $request->crna_expiry;
        $crna_upload_certification = $request->file('crna_upload_certification');

        $crna_data_array = array();
        if($getedudata){
        $certificate_data = json_decode($getedudata->crna_data);
        }else{
        $certificate_data = '' ;
        }


        for($i=0;$i<$crna_count;$i++){
            if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                $crnaimg = json_decode($certificate_data[$i]->crna_upload_certification);
            }else{
                $crnaimg = '';
            }
            
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            if(!empty($crna_upload_certification[$i])){

                $crna_img = Helpers::multipleFileUpload($crna_upload_certification[$i],$crnaimg);
            }else{
                $crna_img = Helpers::multipleFileUpload('',$crnaimg);
            }
            
            $crna_data_array[] = array("crna_certification_id"=>$crnanamearr[$i],"crna_license_number"=>$crna_license_number[$i],"crna_expiry"=>$crna_expiry[$i],"crna_upload_certification"=>$crna_img);
        }
        
        if(!empty($crna_data_array)){
            $crna_data_json = json_encode($crna_data_array);
        }else{
            $crna_data_json = '';
        }

        $cnm_data = $request->cnm_data;
        if($cnm_data){
            $cnm_count = count($cnm_data);
        }else{
            $cnm_count = 0;
        }
        $cnmnamearr = $request->cnmnamearr;
        //print_r($crna_count);die;
        $cnm_license_number = $request->cnm_license_number;
        $cnm_expiry = $request->cnm_expiry;
        $cnm_upload_certification = $request->file('cnm_upload_certification');

        $cnm_data_array = array();
        if($getedudata){
        $certificate_data = json_decode($getedudata->cnm_data);
        }else{
        $certificate_data = '' ;
        }


        for($i=0;$i<$cnm_count;$i++){
            if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                $cnmimg = json_decode($certificate_data[$i]->cnm_upload_certification);
            }else{
                $cnmimg = '';
            }
            
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            if(!empty($cnm_upload_certification[$i])){

                $cnm_img = Helpers::multipleFileUpload($cnm_upload_certification[$i],$cnmimg);
            }else{
                $cnm_img = Helpers::multipleFileUpload('',$cnmimg);
            }
            
            $cnm_data_array[] = array("cnm_certification_id"=>$cnmnamearr[$i],"cnm_license_number"=>$cnm_license_number[$i],"cnm_expiry"=>$cnm_expiry[$i],"cnm_upload_certification"=>$cnm_img);
        }
        
        if(!empty($cnm_data_array)){
            $cnm_data_json = json_encode($cnm_data_array);
        }else{
            $cnm_data_json = '';
        }

        $ons_data = $request->ons_data;
        if($ons_data){
            $ons_count = count($ons_data);
        }else{
            $ons_count = 0;
        }
        $onsnamearr = $request->onsnamearr;
        //print_r($crna_count);die;
        $ons_license_number = $request->ons_license_number;
        $ons_expiry = $request->ons_expiry;
        $ons_upload_certification = $request->file('ons_upload_certification');

        $ons_data_array = array();
        if($getedudata){
        $certificate_data = json_decode($getedudata->ons_data);
        }else{
        $certificate_data = '' ;
        }
       

        for($i=0;$i<$ons_count;$i++){
            if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                $onsimg = json_decode($certificate_data[$i]->ons_upload_certification);
            }else{
                $onsimg = '';
            }
            
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            if(!empty($ons_upload_certification[$i])){

                $ons_img = Helpers::multipleFileUpload($ons_upload_certification[$i],$onsimg);
            }else{
                $ons_img = Helpers::multipleFileUpload('',$onsimg);
            }
            
            $ons_data_array[] = array("ons_certification_id"=>$onsnamearr[$i],"ons_license_number"=>$ons_license_number[$i],"ons_expiry"=>$ons_expiry[$i],"ons_upload_certification"=>$ons_img);
        }
        
        if(!empty($ons_data_array)){
            $ons_data_json = json_encode($ons_data_array);
        }else{
            $ons_data_json = '';
        }

        $msw_data = $request->msw_data;
        if($msw_data){
            $msw_count = count($msw_data);
        }else{
            $msw_count = 0;
        }
        $mswnamearr = $request->mswnamearr;
        
        $msw_license_number = $request->msw_license_number;
        $msw_expiry = $request->msw_expiry;
        $msw_upload_certification = $request->file('msw_upload_certification');

        $msw_data_array = array();
        if($getedudata){
        $certificate_data = json_decode($getedudata->msw_data);
        }else{
        $certificate_data = '' ;
        }


        for($i=0;$i<$msw_count;$i++){
            if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                $mswimg = json_decode($certificate_data[$i]->msw_upload_certification);
            }else{
                $mswimg = '';
            }
            
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            if(!empty($msw_upload_certification[$i])){

                $msw_img = Helpers::multipleFileUpload($msw_upload_certification[$i],$mswimg);
            }else{
                $msw_img = Helpers::multipleFileUpload('',$mswimg);
            }
            
            $msw_data_array[] = array("msw_certification_id"=>$mswnamearr[$i],"msw_license_number"=>$msw_license_number[$i],"msw_expiry"=>$msw_expiry[$i],"msw_upload_certification"=>$msw_img);
        }
        //print_r(count($msw_data_array));die;
        if(!empty($msw_data_array)){
            $msw_data_json = json_encode($msw_data_array);
        }else{
            $msw_data_json = '';
        }

        $ain_data = $request->ain_data;
        if($ain_data){
            $ain_count = count($ain_data);
        }else{
            $ain_count = 0;
        }
        $ainnamearr = $request->ainnamearr;
        //print_r($crna_count);die;
        $ain_license_number = $request->ain_license_number;
        $ain_expiry = $request->ain_expiry;
        $ain_upload_certification = $request->file('ain_upload_certification');

        $ain_data_array = array();
        if($getedudata){
        $certificate_data = json_decode($getedudata->ain_data);
        }else{
        $certificate_data = '' ;
        }
        

        for($i=0;$i<$ain_count;$i++){
            if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                $ainimg = json_decode($certificate_data[$i]->ain_upload_certification);
            }else{
                $ainimg = '';
            }
            
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            if(!empty($ain_upload_certification[$i])){

                $ain_img = Helpers::multipleFileUpload($ain_upload_certification[$i],$ainimg);
            }else{
                $ain_img = Helpers::multipleFileUpload('',$ainimg);
            }
            
            $ain_data_array[] = array("ain_certification_id"=>$ainnamearr[$i],"ain_license_number"=>$ain_license_number[$i],"ain_expiry"=>$ain_expiry[$i],"ain_upload_certification"=>$ain_img);
        }
        
        if(!empty($ain_data_array)){
            $ain_data_json = json_encode($ain_data_array);
        }else{
            $ain_data_json = '';
        }

        $rpn_data = $request->rpn_data;
        if($rpn_data){
            $rpn_count = count($rpn_data);
        }else{
            $rpn_count = 0;
        }
        $rpnnamearr = $request->rpnnamearr;
        //print_r($crna_count);die;
        $rpn_license_number = $request->rpn_license_number;
        $rpn_expiry = $request->rpn_expiry;
        $rpn_upload_certification = $request->file('rpn_upload_certification');
        if($getedudata){
        $certificate_data = json_decode($getedudata->rpn_data);
        }else{
        $certificate_data = '' ;
        }
      

        $rpn_data_array = array();

        for($i=0;$i<$rpn_count;$i++){
            if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                $rpnimg = json_decode($certificate_data[$i]->rpn_upload_certification);
            }else{
                $rpnimg = '';
            }
            
            //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
            if(!empty($rpn_upload_certification[$i])){

                $rpn_img = Helpers::multipleFileUpload($rpn_upload_certification[$i],$rpnimg);
            }else{
                $rpn_img = Helpers::multipleFileUpload('',$rpnimg);
            }
            
            $rpn_data_array[] = array("rpn_certification_id"=>$rpnnamearr[$i],"rpn_license_number"=>$rpn_license_number[$i],"rpn_expiry"=>$rpn_expiry[$i],"rpn_upload_certification"=>$rpn_img);
        }
        
        if(!empty($rpn_data_array)){
            $rpn_data_json = json_encode($rpn_data_array);
        }else{
            $rpn_data_json = '';
        }

        if($request->nl_data){
            $nl_data = json_encode($request->nl_data);
        }else{
            $nl_data = '';
        }

        $file = $request->file('degree_transcript');
        if($getedudata){
        $dtranaimg = json_decode($getedudata->degree_transcript);
      
        $dtranimgs = Helpers::multipleFileUpload($file,$dtranaimg);
       }else{
        $dtranimgs = Helpers::multipleFileUpload($file,'');
       }

       $file2 = $request->test_img;

        if($getedudata){
        $timg = json_decode($getedudata->test_data);
      
        $timg = Helpers::multipleFileUpload($file2,$timg);
       }else{
        $timg = Helpers::multipleFileUpload($file2,'');
       }
        

        
        if(!empty($getedudata)>0){

            $post1 = User::find($user_id);
            $post1->degree = $degree;
            $post1->save();

            
            
            
            
            $run = EducationModel::where('user_id',$user_id)->update(['institution'=>$institution,'graduate_start_date'=>$graduation_start_date,'professional_certifications'=>$professional_certification,'licence_number'=>$license_number,'country'=>$country,'state'=>$state,'expiration_date'=>$expiration_date,'training_courses'=>$training_courses,'training_workshops'=>$training_workshop,'complete_status'=>1,'declaration_status'=>$declare_information,'acls_data'=>$acls_data_json,'bls_data'=>$bls_data_json,'cpr_data'=>$cpr_data_json,'nrp_data'=>$nrp_data_json,'pals_data'=>$pls_data_json,'rn_data'=>$rn_data_json,'np_data'=>$np_data_json,'cna_data'=>$cn_data_json,'lpn_data'=>$lpn_data_json,'crna_data'=>$crna_data_json,'cnm_data'=>$cnm_data_json,'ons_data'=>$ons_data_json,'msw_data'=>$msw_data_json,'ain_data'=>$ain_data_json,'rpn_data'=>$rpn_data_json,'nl_data'=>$nl_data,'additional_certification'=>$new_certificate_json,'test_data'=> $timg]);
        }else{

            

            $post = new EducationModel();
            $post->user_id = $user_id;
            
            $post->institution = $institution;
            $post->graduate_start_date = $graduation_start_date;
            $post->degree_transcript = $dtranimgs;
            $post->professional_certifications = $professional_certification;
            $post->acls_data = $acls_data_json;
            $post->bls_data = $bls_data_json;
            $post->cpr_data = $cpr_data_json;
            $post->nrp_data = $nrp_data_json;
            $post->pals_data = $pls_data_json;
            $post->rn_data = $rn_data_json;
            $post->np_data = $np_data_json;
            $post->cna_data = $cn_data_json;
            $post->lpn_data = $lpn_data_json;
            $post->crna_data = $crna_data_json;
            $post->cnm_data = $cnm_data_json;
            $post->ons_data = $ons_data_json;
            $post->msw_data = $msw_data_json;
            $post->ain_data = $ain_data_json;
            $post->rpn_data = $rpn_data_json;
            $post->nl_data = $nl_data;
            // $post->licence_number = $license_number;
            // $post->country = $country;
            // $post->state = $state;
            // $post->expiration_date = $expiration_date;
            // $post->training_courses = $training_courses;
            // $post->training_workshops = $training_workshop;
            
            $post->additional_certification = $new_certificate_json;
            $post->complete_status = 1;
            $run = $post->save();

            $post1 = User::find($user_id);
            $post1->degree = $degree;
            $post1->save();
        }

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/my-profile');
            $json['message'] = 'Education Information Updated Successfully';
         } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }
        
        echo json_encode($json);
    }

    public function updateExperience(Request $request){
        

        $year_experience = $request->assistent_level;
        $user_id = $request->user_id;
        $previous_employer_name = $request->previous_employer_name;
        $positions_held = json_encode($request->positions_held);
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $present_box = $request->present_box;
        $job_responeblities = $request->job_responeblities;
        $achievements = $request->achievements;
        $employeement_type = $request->employeement_type;
        $skills_compantancies = json_encode($request->skills_compantancies);
        $type_of_evidence = json_encode($request->type_of_evidence);
        $i = 0;    
        $work_experience_array = array();
        foreach ($previous_employer_name as $pname) {
            $previous_employer_name1 = $pname;
            $positions_held1 = $positions_held[$i];
            $start_date1 = $start_date[$i];
            $end_date1 = $end_date[$i];
            
            if (isset($present_box[$i])) {
                    $p_box = 1;
                }else{
                    $p_box = 0;
                }
            $employeement_type1 = $employeement_type[$i];
            $job_responeblities1 = $job_responeblities[$i];
            $achievements1 = $achievements[$i];

            $work_experience_array[] = array("previous_employer_name1"=>$previous_employer_name1,"positions_held1"=>$positions_held1,"start_date1"=>$start_date1,"end_date1"=>$end_date1,"present_box1"=>$p_box,"employeement_type1"=>$employeement_type1,"job_responeblities1"=>$job_responeblities1,"achievements1"=>$achievements1);
            $i++;
        }

        if(!empty($work_experience_array)){
            $work_experience_json = json_encode($work_experience_array);
        }else{
            $work_experience_json = '';
        }

        $file = $request->file('upload_evidence');

        
        
        //$post = User::find($request->user_id);

        if(!empty($file)){
            $destinationPath = public_path() . '/uploads/evidence';

            $file->move($destinationPath,time().$file->getClientOriginalName());
            $upload_evidence = time().$file->getClientOriginalName();
            
        }else{
            $upload_evidence = $getedudata->upload_evidence;
        }
        
        
        $getexperiencedata = DB::table("user_experience")->where("user_id",$user_id)->first();
        //$post = User::find($request->user_id);
        
        if(!empty($getexperiencedata)>0){
            $post1 = User::find($user_id);
            $post1->assistent_level = $year_experience;
            $post1->save();
            
            $run = ExperienceModel::where('user_id',$user_id)->update(['work_experience'=>$work_experience_json,'upload_evidence'=>$upload_evidence,'evidence_type'=>$type_of_evidence,'skills_compantancies'=>$skills_compantancies,'complete_status'=>1]);
        }else{

            

            $post = new ExperienceModel();
            $post->user_id = $user_id;
            
            //$post->year_experience = $year_experience;
            $post->work_experience = $work_experience_json;
            $post->skills_compantancies = $skills_compantancies;
            $post->upload_evidence = $upload_evidence;
            $post->evidence_type = $type_of_evidence;
            $post->complete_status = 1;
            $run = $post->save();

            $post1 = User::find($user_id);
            $post1->assistent_level = $year_experience;
            $post1->save();
        }

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/my-profile');
            $json['message'] = 'Education Information Updated Successfully';
         } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }
        
        echo json_encode($json);
    }

    public function updateReference(Request $request){
        $user_id = $request->user_id;
        $first_name = $request->first_name;
        
        $last_name = $request->last_name;
        $email = $request->email;
        $phone_no = $request->phone_no;
        $reference_relationship = $request->reference_relationship;
        $worked_together = $request->worked_together;
        $position_with_referee = $request->position_with_referee;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $still_working = $request->still_working;
        $reference_no = $request->reference_no;
        
        $getrefereedata = DB::table("referee")->where("user_id",$user_id)->get();

        $referee_no_array = array();

        foreach ($getrefereedata as $r_data) {
            $referee_no_array[] = $r_data->referee_no;
        }
        

        for($i=0;$i<count($first_name);$i++){
            if(in_array($i+1, $referee_no_array)){
                if (isset($still_working[$i])) {
                    $working = 1;
                }else{
                    $working = 0;
                }
                $run = AddReferee::where('user_id',$user_id)->where('referee_no',$i+1)->update(['first_name'=>$first_name[$i],'last_name'=>$last_name[$i],'email'=>$email[$i],'phone_no'=>$phone_no[$i],'relationship'=>$reference_relationship[$i],'worked_together'=>$worked_together[$i],'position_with_referee'=>$position_with_referee[$i],'start_date'=>$start_date[$i],'end_date'=>$end_date[$i],'still_working'=>$working]);
            }else{
                if (isset($still_working[$i])) {
                    $working = 1;
                }else{
                    $working = 0;
                }
                $referee = new AddReferee;
                $referee->referee_no = $i+1;
                $referee->user_id = $user_id;
                $referee->first_name = $first_name[$i];
                $referee->last_name = $last_name[$i];
                $referee->email = $email[$i];
                $referee->phone_no = $phone_no[$i];
                $referee->relationship = $reference_relationship[$i];
                $referee->worked_together = $worked_together[$i];
                $referee->position_with_referee = $position_with_referee[$i];
                $referee->start_date = $start_date[$i];
                $referee->end_date = $end_date[$i];
                $referee->still_working = $working;
                $referee->save();
            }
        }
        
        
        

        $json['status'] = 1;

        echo json_encode($json);

    }

    public function deleteReferee(Request $request){
        $user_id = $request->user_id;
        $referee_id = $request->referee_id;

        $deleteData = DB::table("referee")->where("user_id",$user_id)->where("referee_id",$referee_id)->delete();

        if($deleteData){
            return 1;
        }
    }

    public function deleteCertification(Request $request){
        $user_id = $request->user_id;
        $certificate_id = $request->certificate_id;

        $getEducationData = DB::table("user_education_cerification")->where("user_id",$user_id)->first();

        //print_r($getEducationData);
        $getCertificateData = json_decode($getEducationData->additional_certification);

        $certificate_id_array = array();

        foreach ($getCertificateData as $c_id) {
            $certificate_id_array[] = $c_id->certificate_id;
        }

        $certificate_index = array_search($certificate_id, $certificate_id_array);

        array_splice($getCertificateData, $certificate_index, 1);    

        //unset($getCertificateData[$certificate_index]);
        

        if(!empty($getCertificateData)){
            $CertificateData = json_encode($getCertificateData);
        }else{
            $CertificateData = '';
        }

        $deleteData = EducationModel::where('user_id',$user_id)->update(['additional_certification'=>$CertificateData]);

        if($deleteData){
            return 1;
        }
    }

    public function deleteImg(Request $request){
        $user_id = $request->user_id;
        $img = $request->img;

        $getEducationData = DB::table("user_education_cerification")->where("user_id",$user_id)->first();

        $gettransimg = json_decode($getEducationData->degree_transcript);

        

        $img_index = array_search($img, $gettransimg);
        
        array_splice($gettransimg, $img_index, 1);

        if(!empty($gettransimg)){
            $tranimgData = json_encode($gettransimg);
        }else{
            $tranimgData = '';
        }



        $deleteData = EducationModel::where('user_id',$user_id)->update(['degree_transcript'=>$tranimgData]);

        $destinationPath = public_path() . '/uploads/education_degree/'.$img;
        
        if(File::exists($destinationPath)) {
            File::delete($destinationPath);
        }

        if($deleteData){
            return 1;
        }

        //print_r($gettransimg);
        
    }

    public function deleteImgtest(Request $request){
        $user_id = $request->user_id;
        $img = $request->img;

        $getEducationData = DB::table("user_education_cerification")->where("user_id",$user_id)->first();

        $gettransimg = json_decode($getEducationData->test_data);

        

        $img_index = array_search($img, $gettransimg);
     
        
        array_splice($gettransimg, $img_index, 1);
        //    dd(array_splice($gettransimg, $img_index, 0));
// dd($gettransimg);
        if(!empty($gettransimg)){
            $tranimgData = json_encode($gettransimg);
        }else{
            $tranimgData = '';
        }



        $deleteData = EducationModel::where('user_id',$user_id)->update(['test_data'=>$tranimgData]);

        $destinationPath = public_path() . '/uploads/education_degree/'.$img;
        
        if(File::exists($destinationPath)) {
            File::delete($destinationPath);
        }

        if($deleteData){
            return 1;
        }

        //print_r($gettransimg);
        
    }

    public function deleteImg1(Request $request){
        $user_id = $request->user_id;
        $img = $request->img;
        $country_name = $request->country_name;
        $img_text = $request->img_text;

        $getEducationData = DB::table("edu_fields")->where("user_id",$user_id)->first();
        $getEducationData1 = (array)$getEducationData;
        $gettransimg = (array)json_decode($getEducationData1[$img_text]);
        $gettransimg1 = json_decode($gettransimg[$country_name]);
        

        $img_index = array_search($img, $gettransimg1);
        
        array_splice($gettransimg1, $img_index, 1);

        if(!empty($gettransimg1)){
            $tranimgData = json_encode($gettransimg1);
        }else{
            $tranimgData = '';
        }
        
        $gettransimg[$country_name] = $tranimgData;

        if(!empty($gettransimg)){
            $tranimgData1 = json_encode($gettransimg);
        }else{
            $tranimgData1 = '';
        }

        //print_r($gettransimg);die;

        $deleteData = DB::table("edu_fields")->where('user_id',$user_id)->update([$img_text=>$tranimgData1]);

        $destinationPath = public_path() . '/uploads/education_degree/'.$img;
        
        if(File::exists($destinationPath)) {
            File::delete($destinationPath);
        }

        if($deleteData){
            return 1;
        }

        //print_r($gettransimg);
        
    }

    public function deleteAnoImg1(Request $request){
        $user_id = $request->user_id;
        $img = $request->img;
        $country_name = $request->country_name;
        $img_text = $request->img_text;
        $getEducationData = DB::table("edu_fields")->where("user_id",$user_id)->first();
        $getEducationData1 = (array)$getEducationData;        
        $gettransimg = (array)json_decode($getEducationData1[$img_text]);
      
        $gettransimg1 = json_decode($gettransimg[$country_name]);
 
        $img_index = array_search($img, $gettransimg1);
        
        array_splice($gettransimg1, $img_index, 1);
        
        if(!empty($gettransimg1)){
            $tranimgData = json_encode($gettransimg1);
        }else{
            $tranimgData = '';
        }
       
        $gettransimg[$country_name] = $tranimgData;

        if(!empty($gettransimg)){
            $tranimgData1 = json_encode($gettransimg);
            // echo $tranimgData1;die;
        }else{
            $tranimgData1 = '';
        }


        $deleteData = DB::table("edu_fields")->where('user_id',$user_id)->update([$img_text=>$tranimgData1]);

        $destinationPath = public_path() . '/uploads/education_degree/'.$img;
        
        if(File::exists($destinationPath)) {
            File::delete($destinationPath);
        }

        if($deleteData){
            return 1;
        }

        //print_r($gettransimg);
        
    }

    public function vaccinationForm(Request $request){
        

        $vaccination_record = json_encode($request->vaccination_record);
        $user_id = $request->user_id;
        $immunization_status = $request->immunization_status;
        
        
        
        $getvaccinationdata = DB::table("vaccination_front")->where("user_id",$user_id)->first();
        //$post = User::find($request->user_id);
        
        if(!empty($getvaccinationdata)>0){
            
            
            $run = VaccinationFrontModel::where('user_id',$user_id)->update(['vaccination_records'=>$vaccination_record,'immunization_status'=>$immunization_status,'complete_status'=>1]);
        }else{

            

            $post = new VaccinationFrontModel();
            $post->user_id = $user_id;
            
            //$post->year_experience = $year_experience;
            $post->vaccination_records = $vaccination_record;
            $post->immunization_status = $immunization_status;
            
            $post->complete_status = 1;
            $run = $post->save();

        }

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/my-profile');
            $json['message'] = 'Education Information Updated Successfully';
         } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }
        
        echo json_encode($json);
    }

    public function updateInterview(Request $request){
        

        
        $user_id = $request->user_id;
        $interview_availablity = $request->interview_availablity;
        $reference_name = $request->reference_name;
        $reference_email = $request->reference_email;
        $reference_countryCode = $request->reference_countryCode;
        $reference_countryiso = $request->reference_countryiso;
        $reference_contact = $request->reference_contact;
        $reference_relationship = $request->reference_relationship;
        
        
        $getinterviewdata = DB::table("interview_references")->where("user_id",$user_id)->first();
        //$post = User::find($request->user_id);
        
        if(!empty($getinterviewdata)>0){
            
            
            $run = InterviewModel::where('user_id',$user_id)->update(['interview_availablity'=>$interview_availablity,'reference_name'=>$reference_name,'reference_email'=>$reference_email,'contact_country_code'=>$reference_countryCode,'contact_country_iso'=>$reference_countryiso,'reference_contact'=>$reference_contact,'reference_relationship'=>$reference_relationship]);
        }else{

            

            $post = new InterviewModel();
            $post->user_id = $user_id;
            
            //$post->year_experience = $year_experience;
            $post->interview_availablity = $interview_availablity;
            $post->reference_name = $reference_name;
            $post->reference_email = $reference_email;
            $post->contact_country_code = $reference_countryCode;
            $post->contact_country_iso = $reference_countryiso;
            $post->reference_contact = $reference_contact;
            $post->reference_relationship = $reference_relationship;
            
            
            $run = $post->save();

        }

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/my-profile');
            $json['message'] = 'Education Information Updated Successfully';
         } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }
        
        echo json_encode($json);
    }

    public function updatePreferences(Request $request){
        $user_id = $request->user_id;
        $preferred_work_schedule = $request->preferred_work_schedule;
        $country = $request->country;
        $state = $request->state;
        $specific_facilities = $request->specific_facilities;
        $work_environment = $request->work_environment;
        
        $shift_preferences = $request->shift_preferences;
        
        
        $getpreferencesdata = DB::table("personal_preferences")->where("user_id",$user_id)->first();
        //$post = User::find($request->user_id);
        
        if(!empty($getpreferencesdata)>0){
            
            
            $run = PreferencesModel::where('user_id',$user_id)->update(['preferred_work_schedule'=>$preferred_work_schedule,'country'=>$country,'state'=>$state,'specific_facilities'=>$specific_facilities,'work_environment'=>$work_environment,'shift_preferences'=>$shift_preferences]);
        }else{

            

            $post = new PreferencesModel();
            $post->user_id = $user_id;
            
            //$post->year_experience = $year_experience;
            $post->preferred_work_schedule = $preferred_work_schedule;
            $post->country = $country;
           
            $post->state = $state;
            $post->specific_facilities = $specific_facilities;
            $post->work_environment = $work_environment;
            $post->shift_preferences = $shift_preferences;
            
            
            $run = $post->save();

        }

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/my-profile');
            $json['message'] = 'Education Information Updated Successfully';
         } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }
        
        echo json_encode($json);
    }

    public function updateWorkPreference(Request $request){
        $user_id = $request->user_id;
        $des_job_role = json_encode($request->des_job_role);
        $salary_expectation = $request->salary_expectation;
        $benefit_prefer = json_encode($request->benefit_prefer);
        
        
        
        $getpreferencesdata = DB::table("work_preferences")->where("user_id",$user_id)->first();
        //$post = User::find($request->user_id);
        
        if(!empty($getpreferencesdata)>0){
            
            
            $run = WorkPreferencesModel::where('user_id',$user_id)->update(['desired_job_role'=>$des_job_role,'salary_expectations'=>$salary_expectation,'benefits_preferences'=>$benefit_prefer]);
        }else{

            

            $post = new WorkPreferencesModel();
            $post->user_id = $user_id;
            
            //$post->year_experience = $year_experience;
            $post->desired_job_role = $des_job_role;
            $post->salary_expectations = $salary_expectation;
           
            $post->benefits_preferences = $benefit_prefer;
           
            
            
            $run = $post->save();

        }

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/my-profile');
            $json['message'] = 'Education Information Updated Successfully';
         } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }
        
        echo json_encode($json);
    }

    public function updateAdditionalInfo(Request $request){
        $user_id = $request->user_id;
        $additional_info_language = $request->additional_info_language;
        $volunteer_experience = $request->volunteer_experience;
        $hobbies_interests = $request->hobbies_interests;
        
        
        
        $getinfodata = DB::table("additional_information")->where("user_id",$user_id)->first();
        //$post = User::find($request->user_id);
        
        if(!empty($getinfodata)>0){
            
            
            $run = AdditionalInfo::where('user_id',$user_id)->update(['additional_info_language'=>$additional_info_language,'volunteer_experience'=>$volunteer_experience,'hobbies_interests'=>$hobbies_interests]);
        }else{

            

            $post = new AdditionalInfo();
            $post->user_id = $user_id;
            
            //$post->year_experience = $year_experience;
            $post->additional_info_language = $additional_info_language;
            $post->volunteer_experience = $volunteer_experience;
           
            $post->hobbies_interests = $hobbies_interests;
           
            
            
            $run = $post->save();

        }

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/my-profile');
            $json['message'] = 'Education Information Updated Successfully';
         } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }
        
        echo json_encode($json);
    }

    public function updateProfessionalMembership(Request $request){
        $user_id = $request->user_id;
        $des_profession_association = json_encode($request->des_profession_association);
        $membership_numbers = $request->prof_membership_numbers;
        $membership_status = $request->prof_membership_status;
        
        
        
        $getassodata = DB::table("professional_membership")->where("user_id",$user_id)->first();
        //$post = User::find($request->user_id);
        
        if(!empty($getassodata)>0){
            
            
            $run = ProfessionalAssocialtionModel::where('user_id',$user_id)->update(['des_profession_association'=>$des_profession_association,'membership_numbers'=>$membership_numbers,'membership_status'=>$membership_status]);
        }else{

            

            $post = new ProfessionalAssocialtionModel();
            $post->user_id = $user_id;
            
            //$post->year_experience = $year_experience;
            $post->des_profession_association = $des_profession_association;
            $post->membership_numbers = $membership_numbers;
           
            $post->membership_status = $membership_status;
           
            
            
            $run = $post->save();

        }

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/my-profile');
            $json['message'] = 'Education Information Updated Successfully';
         } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }
        
        echo json_encode($json);
    }

    public function updateTraining(Request $request){
        $user_id = $request->user_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $institution = $request->institution;
        $mand_continue_education = $request->mand_continue_education;
        $mand_training = $request->mandatory_courses;
        $mand_education = $request->mandatory_education;
        $gettrainingdata = DB::table("mandatory_training")->where("user_id",$user_id)->first();

        $training_name = $request->training;
        $training_ins = $request->institution;
        $training_start_date = $request->tra_start_date;
        $training_end_date = $request->tra_end_date;
        $tra_exp = $request->tra_expiry;

        $other_tra_array = array();
        if(!empty($training_name)){
            for($i=0;$i<count($training_name);$i++){

            $other_tra_array[] = array("other_tra_id"=>$i+1,"training_name"=>$training_name[$i],"training_ins"=>$training_ins[$i],"training_start_date"=>$training_start_date[$i],"training_end_date"=>$training_end_date[$i],"tra_exp"=>$tra_exp[$i]);
            }

            $other_tra_json = json_encode($other_tra_array);
        }else{
            $other_tra_json = '';
        }


        $education_name = $request->education;
        $education_ins = $request->institution;
        $education_start_date = $request->start_date;
        $education_end_date = $request->end_date;
        $education_exp = $request->edu_expiry;
        $education_status = $request->edu_expiry;

        $other_edu_array = array();
        if(!empty($education_name)){
            for($i=0;$i<count($education_name);$i++){
            $other_edu_array[] = array("other_edu_id"=>$i+1,"education_name"=>$education_name[$i],"education_ins"=>$education_ins[$i],"education_start_date"=>$education_start_date[$i],"education_end_date"=>$education_end_date[$i],"education_exp"=>$education_exp[$i],"education_status"=>$education_status[$i]);
            }

            $other_edu_json = json_encode($other_edu_array);
        }else{
            $other_edu_json = '';
        }
        

        $well_data = $request->well_self_care_data;
        if($well_data){
            $well_count = count($well_data);
        }else{
            $well_count = 0;
        }
        $wellnamearr = $request->wellnamearr;
        $well_institution = $request->well_institution;
        $well_tra_start_date = $request->well_tra_start_date;
        $well_tra_end_date = $request->well_tra_end_date;
        $well_expiry = $request->well_expiry;

        $well_self_array = array();
        $training_data = json_decode($gettrainingdata->well_sel_data);

        for($i=0;$i<$well_count;$i++){

            $well_self_array[] = array("well_tra_id"=>$wellnamearr[$i],"well_institution"=>$well_institution[$i],"well_tra_start_date"=>$well_tra_start_date[$i],"well_tra_end_date"=>$well_tra_end_date[$i],"well_expiry"=>$well_expiry[$i]);
        }

        if(!empty($well_self_array)){
            $well_data_json = json_encode($well_self_array);
        }else{
            $well_data_json = '';
        } 

        // training sec
        if(!empty($tech_innvo_array)){
            $lead_data_json = json_encode($lead_pro_array);
        }else{
            $lead_data_json = '';
        }

        $tech_innvo_data = $request->tech_innvo_health_data;
        if($tech_innvo_data){
            $tech_innvo_count = count($tech_innvo_data);
        }else{
            $tech_innvo_count = 0;
        }
        $techinnvonamearr = $request->techinnvonamearr;
        $tech_institution = $request->tech_innvo_institution;
        $tech_start_date = $request->tech_innvo_tra_start_date;
        $tech_end_date = $request->tech_innvo_tra_end_date;
        $tech_expiry = $request->tech_innvo_expiry;
        $tech_innvo_array = array();
        $training_data = json_decode($gettrainingdata->tech_innvo_data);

        for($i=0;$i<$tech_innvo_count;$i++){
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
            $tech_innvo_array[] = array("tech_tra_id"=>$techinnvonamearr[$i],"tech_institution"=>$tech_institution[$i],"tech_start_date"=>$tech_start_date[$i],"tech_end_date"=>$tech_end_date[$i],"tech_expiry"=>$tech_expiry[$i]);
        }

        if(!empty($tech_innvo_array)){
            $tech_data_json = json_encode($tech_innvo_array);
        }else{
            $tech_data_json = '';
        }

        // thired
        $lead_pro_data = $request->leader_pro_dev_data;
        if($lead_pro_data){
            $lead_pro_count = count($lead_pro_data);
        }else{
            $lead_pro_count = 0;
        }
        $leaderpronamearr = $request->leaderpronamearr;
        $lead_pro_institution = $request->leader_pro_institution;
        $lead_pro_start_date = $request->leader_pro_tra_start_date;
        $lead_pro_end_date = $request->leader_pro_tra_end_date;
        $leader_pro_expiry = $request->leader_pro_expiry;
        $lead_pro_array = array();
        $training_data = json_decode($gettrainingdata->leader_pro_data);

        for($i=0;$i<$lead_pro_count;$i++){
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
            $lead_pro_array[] = array("lead_pro_tra_id"=>$leaderpronamearr[$i],"lead_pro_institution"=>$lead_pro_institution[$i],"lead_start_date"=>$lead_pro_start_date[$i],"lead_end_date"=>$lead_pro_end_date[$i],"lead_expiry"=>$leader_pro_expiry[$i]);
        }

        if(!empty($lead_pro_array)){
            $lead_data_json = json_encode($lead_pro_array);
        }else{
            $lead_data_json = '';
        }


        // fourth        
        $mid_spec_tra_data = $request->mid_spec_tra_data;
        if($mid_spec_tra_data){
            $mid_spec_count = count($mid_spec_tra_data);
        }else{
            $mid_spec_count = 0;
        }
        $midspecnamearr = $request->midspecnamearr;
        $mid_spec_institution = $request->mid_spec_institution;
        $mid_spec_tra_start_date = $request->mid_spec_tra_start_date;
        $mid_spec_tra_end_date = $request->mid_spec_tra_end_date;
        $mid_spec_expiry = $request->mid_spec_expiry;
        $mid_spec_array = array();
        $training_data = json_decode($gettrainingdata->mid_spec_data);

        

        for($i=0;$i<$mid_spec_count;$i++){
  
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
            $mid_spec_array[] = array("mid_spec_tra_id"=>$midspecnamearr[$i],"mid_spec_institution"=>$mid_spec_institution[$i],"mid_spec_start_date"=>$mid_spec_tra_start_date[$i],"mid_spec_end_date"=>$mid_spec_tra_start_date[$i],"mis_spec_expiry"=>$mid_spec_expiry[$i]);
        }
         if(!empty($mid_spec_array)){
            $mid_data_json = json_encode($mid_spec_array);
        }else{
            $mid_data_json = '';
        }


        // fifth
         $cli_skill_data = $request->clinic_skill_core_data;
        if($cli_skill_data){
            $cli_skill_count = count($cli_skill_data);
        }else{
            $cli_skill_count = 0;
        }
        $clinicskillnamearr = $request->clinicskillnamearr;
        $clinic_skill_institution = $request->clinic_skill_institution;
        $clinic_skill_tra_start_date = $request->clinic_skill_tra_start_date;
        $clinic_skill_tra_end_date = $request->clinic_skill_tra_end_date;
        $clinic_skill_expiry = $request->clinic_skill_expiry;
        $cli_skill_array = array();
        $training_data = json_decode($gettrainingdata->clinic_skill_data);

        for($i=0;$i<$cli_skill_count;$i++){        
            $cli_skill_array[] = array("cli_skill_tra_id"=>$clinicskillnamearr[$i],"clinic_skill_institution"=>$clinic_skill_institution[$i],"cli_skill_start_date"=>$clinic_skill_tra_start_date[$i],"cli_skill_end_date"=>$clinic_skill_tra_end_date[$i],"cli_skill_expiry"=>$clinic_skill_expiry[$i]);
        }

         if(!empty($cli_skill_array)){
            $cli_skill_data_json = json_encode($cli_skill_array);
        }else{
            $cli_skill_data_json = '';
        }

        //man education
        $emerging_data = $request->emerging_topic;
        if($emerging_data){
            $emerging_count = count($emerging_data);
        }else{
            $emerging_count = 0;
        }
        $emetopicarr = $request->emetopicarr;
        $eme_topic_institution = $request->eme_topic_institution;
        $eme_topic_start_date = $request->eme_topic_start_date;
        $eme_topic_end_date = $request->eme_topic_end_date;
        $eme_topic_status = $request->eme_topic_status;
        $eme_topic_expiry = $request->eme_topic_expiry;

        $emerging_array = array();
        $edu_data = json_decode($gettrainingdata->emerg_topic_data);

        for($i=0;$i<$emerging_count;$i++){            
            $emerging_array[] = array("emr_edu_id"=>$emetopicarr[$i],"eme_topic_institution"=>$eme_topic_institution[$i],"eme_topic_start_date"=>$eme_topic_start_date[$i],"eme_topic_end_date"=>$eme_topic_end_date[$i],"eme_topic_expiry"=>$eme_topic_expiry[$i],"eme_topic_status"=>$eme_topic_status[$i],);
        }

        if(!empty($emerging_array)){
            $eme_data_json = json_encode($emerging_array);
        }else{
            $eme_data_json = '';
        } 

        
        $safety_com_data = $request->safety_com;
        if($safety_com_data){
            $safety_com_count = count($safety_com_data);
        }else{
            $safety_com_count = 0;
        }
        $safetycomaarr = $request->safetycomaarr;
        $safety_com_institution = $request->safety_com_institution;
        $safety_com_start_date = $request->safety_com_start_date;
        $safety_com_end_date = $request->safety_com_end_date;
        $safety_com_status = $request->safety_com_status;
        $safety_com_expiry = $request->safety_com_expiry;

        $safety_com_array = array();
        $safety_com_data = json_decode($gettrainingdata->safety_com_data);

        for($i=0;$i<$safety_com_count;$i++){            
            $safety_com_array[] = array("saf_edu_id"=>$safetycomaarr[$i],"safety_com_institution"=>$safety_com_institution[$i],"safety_com_start_date"=>$safety_com_start_date[$i],"safety_com_end_date"=>$safety_com_end_date[$i],"safety_com_expiry"=>$safety_com_expiry[$i],"safety_com_status"=>$safety_com_status[$i],);
        }

        if(!empty($safety_com_array)){
            $safety_data_json = json_encode($safety_com_array);
        }else{
            $safety_data_json = '';
        } 


        $spec_area_data = $request->spec_area;
        if($spec_area_data){
            $spec_area_count = count($spec_area_data);
        }else{
            $spec_area_count = 0;
        }
        $specareaarr = $request->specareaarr;
        $spec_area_institution = $request->spec_area_institution;
        $spec_area_start_date = $request->spec_area_start_date;
        $spec_area_end_date = $request->spec_area_end_date;
        $spec_area_status = $request->spec_area_status;
        $spec_area_expiry = $request->spec_area_expiry;

        $spec_area_array = array();
        $spec_data = json_decode($gettrainingdata->spec_area_data);

        for($i=0;$i<$spec_area_count;$i++){            
            $spec_area_array[] = array("spec_edu_id"=>$specareaarr[$i],"spec_area_institution"=>$spec_area_institution[$i],"spec_area_start_date"=>$spec_area_start_date[$i],"spec_area_end_date"=>$spec_area_end_date[$i],"spec_area_expiry"=>$spec_area_expiry[$i],"spec_area_status"=>$spec_area_status[$i],);
        }

        if(!empty($spec_area_array)){
            $spec_area_json = json_encode($spec_area_array);
        }else{
            $spec_area_json = '';
        } 


        $mid_spe_data = $request->mid_spe_mandotry;
        if($mid_spe_data){
            $mid_spe_count = count($mid_spe_data);
        }else{
            $mid_spe_count = 0;
        }
        $midspearr = $request->midspearr;
        $mid_spe_institution = $request->mid_spe_institution;
        $mid_spe_start_date = $request->mid_spe_start_date;
        $mid_spe_end_date = $request->mid_spe_end_date;
        $mid_spe_status = $request->mid_spe_status;
        $mid_spe_expiry = $request->mid_spe_expiry;

        $mid_spe_array = array();
        $mid_data = json_decode($gettrainingdata->mid_spe_data);

        for($i=0;$i<$mid_spe_count;$i++){            
            $mid_spe_array[] = array("mid_spe_edu_id"=>$midspearr[$i],"mid_spe_institution"=>$mid_spe_institution[$i],"mid_spe_start_date"=>$mid_spe_start_date[$i],"mid_spe_end_date"=>$mid_spe_end_date[$i],"mid_spe_expiry"=>$mid_spe_expiry[$i],"mid_spe_status"=>$mid_spe_status[$i],);
        }

        if(!empty($mid_spe_array)){
            $mid_spe_json = json_encode($mid_spe_array);
        }else{
            $mid_spe_json = '';
        } 


        $core_man_data = $request->core_man_con_data;
        if($core_man_data){
            $core_man_count = count($core_man_data);
        }else{
            $core_man_count = 0;
        }
        $coremanarr  = $request->coremanarr;
        $core_man_institution = $request->core_man_institution;
        $coreman_start_date = $request->coreman_start_date;
        $coreman_end_date = $request->coreman_end_date;
        $coreman_status = $request->coreman_status;
        $core_man_expiry = $request->core_man_expiry;

        $core_man_array = array();
        $core_man_data = json_decode($gettrainingdata->core_man_data);

        for($i=0;$i<$core_man_count;$i++){            
            $core_man_array[] = array("core_man_edu_id"=>$coremanarr[$i],"core_man_institution"=>$core_man_institution[$i],"coreman_start_date"=>$coreman_start_date[$i],"coreman_end_date"=>$coreman_end_date[$i],"core_man_expiry"=>$core_man_expiry[$i],"coreman_status"=>$coreman_status[$i],);
        }

        if(!empty($core_man_array)){
            $core_man_json = json_encode($core_man_array);
        }else{
            $core_man_json = '';
        }
        
        // $gettrainingdata = DB::table("mandatory_training")->where("user_id",$user_id)->first();
        //$post = User::find($request->user_id);
        
        if(!empty($gettrainingdata)>0){
            $run = MandatoryTrainModel::where('user_id',$user_id)->update([
                'start_date'=>$start_date,
                'end_date'=>$end_date,
                'institutions'=>$institution,
                'continuing_education'=>$mand_continue_education,
                'well_sel_data'=>$well_data_json,
                'tech_innvo_data'=>$tech_data_json,
                'leader_pro_data'=>$lead_data_json,
                'mid_spec_data'=>$mid_data_json,
                'clinic_skill_data'=>$cli_skill_data_json,
                'other_tra_data' => $other_tra_json, 
                'man_training'    =>json_encode($mand_training),
                'man_education'    =>json_encode($mand_education),
                'emerg_topic_data'    =>$eme_data_json,
                'safety_com_data' =>$safety_data_json,
                'spec_area_data' =>$spec_area_json,
                'mid_spe_data'   =>$mid_spe_json,
                'core_man_data' =>$core_man_json,
                'other_edu_data' => $other_edu_json,
            ]);
        }else{
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
            $post->man_training   =json_encode($mand_training);
            $post->man_education    =json_encode($mand_education);
            $post->emerg_topic_data    = $eme_data_json;
            $post->safety_com_data = $safety_data_json;
            $post->spec_area_data = $spec_area_json;
            $post->mid_spe_data = $mid_spe_json;
            $post->core_man_data = $core_man_json;
            $post->other_edu_data = $other_edu_json;

            $run = $post->save();

        }

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/my-profile');
            $json['message'] = 'Education Information Updated Successfully';
         } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }
        
        echo json_encode($json);
    }

    public function uploadImgs(Request $request){
        $files = $request->file('upload_images');
        $user_id = $request->user_id;

        $getedudata = DB::table("user_education_cerification")->where("user_id",$user_id)->first();

        if($getedudata){
        $dtranaimg = json_decode($getedudata->degree_transcript);

        $dtranimgs = Helpers::multipleFileUpload($files,$dtranaimg);
        }else{
        $dtranimgs = Helpers::multipleFileUpload($files,'');
        }
        $run = EducationModel::where('user_id',$user_id)->update(['degree_transcript'=>$dtranimgs]);

        //print_r($files);
        return $dtranimgs;
    }

    public function uploadImgs1(Request $request){
        $files = $request->file('upload_images');
        $user_id = $request->user_id;
        $country_name = $request->country_name;
        $field_name = $request->field_name;
        //print_r($files);die;

        $getedufieldsdata = DB::table("edu_fields")->where("user_id",$user_id)->first();
        //print_r($getedufieldsdata);die;
        if(empty($getedufieldsdata)){

            
            $acls_img = Helpers::multipleFileUpload($files,'');
            $acls_data = array($country_name => $acls_img);
            $getImg_array = $acls_data;
            DB::table("edu_fields")->insert(["user_id"=>$user_id,$field_name=>json_encode($acls_data)]);
        }else{
            $getEdufieldsData1 = (array)$getedufieldsdata;
            $getImgfield = $getEdufieldsData1[$field_name];
            $getImg_array = (array)json_decode($getImgfield);
            
            if(array_key_exists($country_name,$getImg_array)){
                $available_imgs = (array)json_decode($getImg_array[$country_name]);
                $acls_img = Helpers::multipleFileUpload($files,$available_imgs);
                $getImg_array[$country_name] = $acls_img;
                DB::table("edu_fields")->where("user_id",$user_id)->update([$field_name=>json_encode($getImg_array)]);
            }else{
                $acls_img = Helpers::multipleFileUpload($files,'');
                $getImg_array[$country_name] = $acls_img;
                
                
                DB::table("edu_fields")->where("user_id",$user_id)->update([$field_name=>json_encode($getImg_array)]);
            }
            

        }

        return $acls_img;

    }
    
     public function update_profession_ahpra_numberI(Request $request)
    {      
            $insert['ahpra_code'] = $request->ahpra_code;
            $insert['ahpra_number'] = $request->ahpra_number;
            $data = User::where('id', Auth::guard('nurse_middle')->user()->id)->update($insert);
            if ($data) {
                $json['status'] = 1;
                $json['url'] = url('nurse/my-profile');
                $json['message'] = 'You have Successfully submitted the details.';
             } else {
                $json['status'] = 0;
                $json['message'] = 'Please Try Again';
            }
        
        echo json_encode($json);
    }
     public function update_eligibility_to_work(Request $request)
    {       
          if ($request->hasFile('image_support_document')) {
            $profile_image = time() . '.' . $request->image_support_document->extension();

            if ($request->image_support_document->move(public_path('/nurse/assets/imgs/support_document/'), $profile_image)) {
                $professioninsert['support_document'] = '/nurse/assets/imgs/support_document/' . $profile_image;
            }
        }
        
            $lastRecord =EligibilityToWorkModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
            if ($lastRecord) { $lastRecord->delete(); }
            $professioninsert['residency'] = $request->residency;
           
            $professioninsert['visa_subclass_number'] = $request->visa_subclass_number;
            $professioninsert['passport_number'] = $request->passport_number;
            $professioninsert['visa_grant_number'] = $request->visa_grant_number;
            $professioninsert['passport_country_of_Issue'] = $request->passport_country_of_Issue;
            $professioninsert['expiry_date'] = $request->expiry_date;
            $professioninsert['user_id'] =  Auth::guard('nurse_middle')->user()->id;
           
            $professioninsert['status'] = '0';
            $professioninsert['created_at'] = Carbon::now('Asia/Kolkata');

            $run = EligibilityToWorkModel::insert($professioninsert);
            if ($run) {
                $json['status'] = 1;
                $json['url'] = url('nurse/my-profile')."?page=work_clearances";
                $json['message'] = 'You have Successfully submitted the details.';
             } else {
                $json['status'] = 0;
                $json['message'] = 'Please Try Again';
            }
        
        echo json_encode($json);
    }
     public function update_children_to_work(Request $request)
    {       
          
        
            $lastRecord =WorkingChildrenCheckModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
            if ($lastRecord) { $lastRecord->delete(); }
            $professioninsert['clearance_number'] = $request->clearance_number;
           
            $professioninsert['state'] = $request->clearance_state;
            $professioninsert['expiry_date'] = $request->clearance_expiry_date;
         
            $professioninsert['user_id'] =  Auth::guard('nurse_middle')->user()->id;
            $professioninsert['status'] = '1';
            $professioninsert['created_at'] = Carbon::now('Asia/Kolkata');

            $run = WorkingChildrenCheckModel::insert($professioninsert);
            if ($run) {
                $json['status'] = 1;
                $json['url'] = url('nurse/my-profile')."?page=work_clearances";
                $json['message'] = 'You have Successfully submitted the details.';
             } else {
                $json['status'] = 0;
                $json['message'] = 'Please Try Again';
            }
        
        echo json_encode($json);
    }
      public function update_police_check_to_work(Request $request)
    {       
          if ($request->hasFile('image_support_document_police')) {
            $profile_image = time() . '.' . $request->image_support_document_police->extension();

            if ($request->image_support_document_police->move(public_path('/nurse/assets/imgs/police_check/'), $profile_image)) {
                $professioninsert['image'] = '/nurse/assets/imgs/police_check/' . $profile_image;
            }
        }
        
            $lastRecord =PoliceCheckModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
            if ($lastRecord) { $lastRecord->delete(); }
            $professioninsert['date'] = $request->date_acquired;
           
            $professioninsert['user_id'] =  Auth::guard('nurse_middle')->user()->id;
           
            $professioninsert['status'] = '0';
            $professioninsert['created_at'] = Carbon::now('Asia/Kolkata');

            $run = PoliceCheckModel::insert($professioninsert);
            if ($run) {
                $json['status'] = 1;
                $json['url'] = url('nurse/my-profile')."?page=work_clearances";
                // $json['url'] = url('nurse/my-profile#tab-myclearance-jobs');
                $json['message'] = 'You have Successfully submitted the details.';
             } else {
                $json['status'] = 0;
                $json['message'] = 'Please Try Again';
            }
        
        echo json_encode($json);
    }
    public function update_profession_profile_setting(Request $request)
    {       
            $update['medical_facilities'] = isset($request->medical_facilities) ? 'Yes' : 'No';
            $update['agencies'] = isset($request->agencies) ? 'Yes' : 'No';
            $update['individuals'] = isset($request->individuals) ? 'Yes' : 'No';
            $update['profile_status1'] = $request->profile_status;
            //$update['unavailable_profile_status'] = isset($request->profile_status) ? 'Yes' : 'No';
            $update['available_date'] = $request->available_date;
            $update['updated_at'] = Carbon::now('Asia/Kolkata');
            $run = User::where('id', Auth::guard('nurse_middle')->user()->id)->update($update);

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
    public function term_and_condition($message = '')
    {
           return view('nurse.term-&-condition', compact( 'message'));   
    }
    public function about($message = '')
    {
           return view('nurse.about-us', compact( 'message'));   
    }
    
    public function privacy($message = '')
    {
           return view('nurse.privacy', compact( 'message'));   
    }
    public function addnewsletters(AddnewsletterRequest $request)
    {
        try {
           return $this->specialityServices->addnewsletters($request);
        } catch (\Exception $e) {
            log::error('Error in HomeController/addnewsletters :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    //for Mandatory Training
    public function uploadmantraImgs1(Request $request){
        $files = $request->file('upload_images');
        $user_id = $request->user_id;
        $cat_name = $request->cat_name;
        $field_name = $request->field_name;
        // dd($field_name);die;  
        $getedufieldsdata = DB::table("edu_fields")->where("user_id",$user_id)->first();
        
        if(empty($getedufieldsdata)){  
            $acls_img = Helpers::multipleFileUpload($files,'');
            $acls_data = array($cat_name => $acls_img);
            $getImg_array = $acls_data;
            DB::table("edu_fields")->insert(["user_id"=>$user_id,$field_name=>json_encode($acls_data)]);
        }
        else{
            $getEdufieldsData1 = (array)$getedufieldsdata;
            $getImgfield = $getEdufieldsData1[$field_name];
            $getImg_array = (array)json_decode($getImgfield);
            
            if(array_key_exists($cat_name,$getImg_array)){
                $available_imgs = (array)json_decode($getImg_array[$cat_name]);
                $acls_img = Helpers::multipleFileUpload($files,$available_imgs);
                $getImg_array[$cat_name] = $acls_img;
                DB::table("edu_fields")->where("user_id",$user_id)->update([$field_name=>json_encode($getImg_array)]);
            }
            else{
                $acls_img = Helpers::multipleFileUpload($files,'');
                $getImg_array[$cat_name] = $acls_img;  
                DB::table("edu_fields")->where("user_id",$user_id)->update([$field_name=>json_encode($getImg_array)]);
            }
            

        }

        return $acls_img;

    }

    //for another Training
    public function uploadAnotherImgs(Request $request){
        $files = $request->file('upload_images');
        $user_id = $request->user_id;
        $cat_name = $request->cat_name;
        $field_name = $request->field_name;
        // dd($field_name);die;  
        $getedufieldsdata = DB::table("edu_fields")->where("user_id",$user_id)->first();
        
        if(empty($getedufieldsdata)){  
            $acls_img = Helpers::multipleFileUpload($files,'');
            $acls_data = array($cat_name => $acls_img);
            $getImg_array = $acls_data;
            DB::table("edu_fields")->insert(["user_id"=>$user_id,$field_name=>json_encode($acls_data)]);
        }
        else{
            $getEdufieldsData1 = (array)$getedufieldsdata;
            $getImgfield = $getEdufieldsData1[$field_name];
            $getImg_array = (array)json_decode($getImgfield);
            
            if(array_key_exists($cat_name,$getImg_array)){
                $available_imgs = (array)json_decode($getImg_array[$cat_name]);
                $acls_img = Helpers::multipleFileUpload($files,$available_imgs);
                $getImg_array[$cat_name] = $acls_img;
                DB::table("edu_fields")->where("user_id",$user_id)->update([$field_name=>json_encode($getImg_array)]);
            }
            else{
                $acls_img = Helpers::multipleFileUpload($files,'');
                $getImg_array[$cat_name] = $acls_img;  
                DB::table("edu_fields")->where("user_id",$user_id)->update([$field_name=>json_encode($getImg_array)]);
            }
            

        }

        return $acls_img;

    }
    
}