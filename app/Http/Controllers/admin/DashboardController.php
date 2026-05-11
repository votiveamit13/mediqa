<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAdminProfile;
use App\Http\Requests\ChangePasswordRequest;
use App\Services\Admins\AuthServices;

class DashboardController extends Controller
{
    protected $authServices;
  
    public function __construct(AuthServices $authServices){
        $this->authServices = $authServices;
       
    }
    public function index()
    {
        try {
            return view('admin.dashboard');
        } catch (\Exception $e) {
            log::error('Error in DashboardController/index :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function myProfile()
    {
        try {
            return view('admin.my-profile');
        } catch (\Exception $e) {
            log::error('Error in DashboardController/my_profile :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateProfile(UpdateAdminProfile $request)
    {
        try {
            $run = $this->authServices->updateProfile($request);
             if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo',['parameter' =>'Profile'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            log::error('Error in DashboardController/updateProfile :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function changePassword(ChangePasswordRequest $request)
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
            log::error('Error in DashboardController/changePassword :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

   

}
