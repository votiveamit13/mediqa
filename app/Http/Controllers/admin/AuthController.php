<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Repository\Eloquent\AuthRepository;
use App\Services\Admins\AuthServices;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected $authRepository;
    protected $authServices;

    public function __construct(
        AuthRepository $authRepository,
        AuthServices  $authServices,
    ){
        $this->authRepository =  $authRepository;
        $this->authServices =  $authServices;
    }
    public function login()
    {
        try {
            return view('admin.login');
        } catch (\Exception $e) {
            log::error('Error in AuthController/login :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => 'Something went wrong']);
        }
    }
    public function doLogin(AuthRequest $request)
    {
        try {
            return $this->authServices->doLogin($request);
        } catch (\Exception $e) {
            log::error('Error in AuthController/doLogin :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => 'Something went wrong']);
        }
    }
    public function logout(Request $request)
    {
        try {
            return $this->authServices->logout($request);
        } catch (\Exception $e) {
            log::error('Error in AuthController/logout :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => 'Something went wrong']);
        }
    }
    public function forgotPassword()
    {
        try {
            return view('admin.forgot-password');
        } catch (\Exception $e) {
            log::error('Error in AuthController/forgotPassword :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function verifyEmail(VerifyEmailRequest $request)
    {
        try {
            return $this->authServices->verifyEmail($request);
        } catch (\Exception $e) {
            log::error('Error in AuthController/verifyEmail :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

   

}
