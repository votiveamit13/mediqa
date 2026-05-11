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
use Mail;
use Validator;
use DB;
use URL;
use Session;
use App\Services\Admins\SpecialityServices;

use App\Models\SpecialityModel;
use App\Models\EducationModel;
use App\Repository\Eloquent\SpecialityRepository;

class HomeController extends Controller
{

    protected $specialityServices;
    protected $specialityRepository;
    protected $authServices;

    public function __construct(SpecialityServices $specialityServices, SpecialityRepository $specialityRepository, AuthServices $authServices)
    {
        $this->specialityServices = $specialityServices;
        $this->specialityRepository = $specialityRepository;
        $this->authServices = $authServices;
    }
    public function index($message = '')
    {
        if (!Auth::guard('nurse_middle')->check()) {
            $title = "Login";
            return view('nurse.home', compact('message'));
        } else {


            return redirect()->route('nurse.dashboard');
        }
    }
    public function contact($message = '')
    {
        $phoneCode = CountryModel::orderBy('id', 'DESC')->get();
        return view('nurse.contact', compact('message', 'phoneCode'));
    }
    public function index_main($message = '')
    {
        if (!Auth::guard('nurse_middle')->check()) {
            $title = "Login";

            $trendingData = $this->specialityRepository->getAll(['is_featured' => 1]);
            $trendingData2 = $this->specialityRepository->get_specialitiess(['is_featured' => 1]);

            return view('nurse.main-home', compact('message', 'trendingData', 'trendingData2'));
        } else {
            return redirect()->route('nurse.dashboard');
        }
    }
    public function medical_facilities($message = '')
    {
        if (!Auth::guard('nurse_middle')->check()) {
            $title = "Login";
            return view('nurse.medical-facilities', compact('message'));
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
        return view('nurse.nurseRegister', compact('message'));
    }
    public function manage_profile($message = '')
    {
        return view('nurse.profile', compact('message'));
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

            if (User::where("email", $request->email)->doesntExist()) {


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

                    'body' => '<p>Hello  ' . $request->fullname . ' ' . $request->lastname . ', </p><p>Welcome and thank you for registering.</p>  <p>Click the link below to verify your account. </p><p><a href="' . $verificationUrl . '">Verify Now</a></p><p>If the above link doesn\'t work, copy and paste the link below into your browser.</p><p>' . $verificationUrl . '</p>',


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
            } else {
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
            } elseif (Auth::guard('nurse_middle')->user()->emailVerified == 1 &&  Auth::guard('nurse_middle')->user()->type == 0) {
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


        if (User::where('email', $request->email)->where('status', '!=', '0')->exists()) {
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


        if (User::where('email', $request->storeLicense)->where('status', '!=', '0')->exists()) {
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

            if (User::where("store_license", $request->storeLicense)->doesntExist()) {


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
            } else {
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
        } else {

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

            $data['data'] = '<p>Hello ' . $user->name . ', </p><p>We\'ve received a password reset request for your ' . env('APP_NAME') . ' account (' . $user->email . ').</p>';
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
                'message' => 'Please check your registered email address. We have sent you a password reset link. !'
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
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Profile'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            log::error('Error in SettingController/updateProfile :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateProfession(Request $request)
    {
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
        $bio = $request->bio;
        $degree = json_encode($request->degree);
        $employee_status = $request->employee_status;

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
        $post->bio = $bio;
        $post->degree = $degree;
        $post->current_employee_status = $employee_status;
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
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Password'])]);
            } else {
                return response()->json(['status' => '0', 'message' => "old password doesn't match"]);
            }
        } catch (\Exception $e) {
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

        $lastRecord = ProfessionModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if ($lastRecord) {
            $lastRecord->delete();
        }
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

    public function updateEducation(Request $request)
    {
        $degree = json_encode($request->ndegree);

        $institution = $request->institution;
        $user_id = $request->user_id;
        $graduation_start_date = $request->graduation_start_date;
        $graduation_end_date = $request->graduation_end_date;
        $professional_certification = json_encode($request->professional_certification);
        $license_number = $request->license_number;
        $country = $request->country;
        $state = $request->state;
        $expiration_date = $request->expiration_date;
        $training_courses = json_encode($request->training_courses);
        $training_workshop = json_encode($request->training_workshop);

        $getedudata = DB::table("user_education_cerification")->where("user_id", $user_id)->first();
        //$post = User::find($request->user_id);

        if (!empty($getedudata) > 0) {

            $post1 = User::find($user_id);
            $post1->degree = $degree;
            $post1->save();

            $run = EducationModel::where('user_id', $user_id)->update(['institution' => $institution, 'graduate_start_date' => $graduation_start_date, 'graduate_end_date' => $graduation_end_date, 'professional_certifications' => $professional_certification, 'licence_number' => $license_number, 'country' => $country, 'state' => $state, 'expiration_date' => $expiration_date, 'training_courses' => $training_courses, 'training_workshops' => $training_workshop]);
        } else {



            $post = new EducationModel();
            $post->user_id = $user_id;

            $post->institution = $institution;
            $post->graduate_start_date = $graduation_start_date;
            $post->graduate_end_date = $graduation_end_date;
            $post->professional_certifications = $professional_certification;
            $post->licence_number = $license_number;
            $post->country = $country;
            $post->state = $state;
            $post->expiration_date = $expiration_date;
            $post->training_courses = $training_courses;
            $post->training_workshops = $training_workshop;
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

        $lastRecord = EligibilityToWorkModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if ($lastRecord) {
            $lastRecord->delete();
        }
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
            $json['url'] = url('nurse/my-profile');
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }

        echo json_encode($json);
    }
    public function update_children_to_work(Request $request)
    {


        $lastRecord = WorkingChildrenCheckModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if ($lastRecord) {
            $lastRecord->delete();
        }
        $professioninsert['clearance_number'] = $request->clearance_number;

        $professioninsert['state'] = $request->clearance_state;
        $professioninsert['expiry_date'] = $request->clearance_expiry_date;

        $professioninsert['user_id'] =  Auth::guard('nurse_middle')->user()->id;
        $professioninsert['status'] = '1';
        $professioninsert['created_at'] = Carbon::now('Asia/Kolkata');

        $run = WorkingChildrenCheckModel::insert($professioninsert);
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
    public function update_police_check_to_work(Request $request)
    {
        if ($request->hasFile('image_support_document_police')) {
            $profile_image = time() . '.' . $request->image_support_document_police->extension();

            if ($request->image_support_document_police->move(public_path('/nurse/assets/imgs/police_check/'), $profile_image)) {
                $professioninsert['image'] = '/nurse/assets/imgs/police_check/' . $profile_image;
            }
        }

        $lastRecord = PoliceCheckModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if ($lastRecord) {
            $lastRecord->delete();
        }
        $professioninsert['date'] = $request->date_acquired;

        $professioninsert['user_id'] =  Auth::guard('nurse_middle')->user()->id;

        $professioninsert['status'] = '0';
        $professioninsert['created_at'] = Carbon::now('Asia/Kolkata');

        $run = PoliceCheckModel::insert($professioninsert);
        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/my-profile');
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
        $update['profile_status'] = isset($request->profile_status) ? 'Yes' : 'No';
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
        return view('nurse.term-&-condition', compact('message'));
    }
    public function about($message = '')
    {
        return view('nurse.about-us', compact('message'));
    }

    public function privacy($message = '')
    {
        return view('nurse.privacy', compact('message'));
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
}
