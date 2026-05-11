<?php
namespace App\Services\Admins;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthServices
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function doLogin($request)
    {
        try {
            $user = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
            if ($user) {
                return response()->json(['status' => '1', 'message' => __('message.statusLogin')]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusInvalid')]);
            }
        } catch (\Exception $e) {
            log::error('Error in AuthServices/doLogin :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function logout($request)
    {
        try {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $response = redirect()
                ->route('admin.login')
                ->with(['message2' => '<div class="alert alert-success">'.__('message.logout').'</div>']);
            return $response;
        } catch (\Exception $e) {
            log::error('Error in AuthServices/logout :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
   
    public function updateProfile($request){
    try {
        $data['name'] = $request['name'];
        if ($request->hasFile('file_image')) {
            $image = $request->file('file_image');
            $name = time() . "." . $image->getClientOriginalExtension();
            $imageData=$image->storeAs('profileImages', $name, 'public');
            $data['image'] = $imageData;
        }
        $id = Auth::guard('admin')->user()->id;

        return  $this->authRepository->update(['id' => $id], $data);
    } catch(\Exception $e){
        Log::error("Error in AuthServices.updateProfile(): " . $e->getMessage());
        return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
    }
    }
    public function changePassword($request){
        try {
            $user = Auth::guard('admin')->user();
            if (Hash::check($request['old_password'], $user->password)) {
                $data = [
                    'password' =>Hash::make( $request['password'])
                ];
                $id = $user->id;
                return  $this->authRepository->update(['id'=>$id],$data);
            }
        } catch(\Exception $e){
            Log::error("Error in AuthServices.changePassword(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function VerifyEmail($request){
        try {
             $adminData  = $this->authRepository->getData(['email'=>$request['email']]);
            if ($adminData) {
                $randomPassword = mt_rand(100000, 999999);
                $update['password'] = Hash::make($randomPassword);
                $uid = $this->authRepository->update(['id'=>$adminData['id']],['password'=>$update['password']]);
                $email = $adminData->email;

                $body = 'Hello, ' . $adminData->name;
                $body .= '<p>This is an automated message. If you did not recently initiate the Forgot Password process,please disgard this email.</p>';
                $body .= '<p> your password  is <b>' .  $randomPassword . '</b> for login use the password please do not share the password.</p>';

                $mailData = [
                    'subject' => __('message.forgotPassword'),
                    'email' => $email,
                    'password' => $randomPassword,
                    'body' => $body,
                ];
                 Mail::to($email)->send(new \App\Mail\DemoMail($mailData));
                 $run =Mail::to('tarunendra.webwiders@gmail.com')->send(new \App\Mail\DemoMail($mailData));
                if($run) {
                    return response()->json(['status' => '1', 'message' => __('message.checkEmail')]);
                } else {
                    return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
                }
            } else {
                    return response()->json(['status' => '0', 'message' =>__('message.notExist') ]);
             }
        } catch (\Exception $e) {
            log::error('Error in AuthServices/VerifyEmail :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

        
}
