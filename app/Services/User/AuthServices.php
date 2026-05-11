<?php

namespace App\Services\User;

use Illuminate\Support\Facades\Log;
use App\Repository\User\AdminRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class AuthServices
{
    protected $adminRepository;
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
      
    }
   
    public function updateAdminProfile($request)
    {
        
        try {
            // print_r($request->all());
            // die;
            $companyinsert['name'] = $request->fullname;
            $companyinsert['lastname'] = $request->lastname;
            $companyinsert['country_code'] = $request->countryCode;
            $companyinsert['country_iso'] = $request->countryiso;
            $companyinsert['phone'] = $request->contact;
            $companyinsert['post_code'] = $request->post_code;
            
            
            //$companyinsert['bio'] = $request->bio;
            $companyinsert['personal_website'] = $request->website;
            //$companyinsert['bio'] = $request->bio;
           
            $companyinsert['country'] = $request->country;
            $companyinsert['state'] = $request->state;
            $companyinsert['gender'] = $request->gender;
            $companyinsert['city'] = $request->city;
            $companyinsert['date_of_birth'] = $request->date_of_birth;
            $companyinsert['home_address'] = $request->home_address;
            $companyinsert['emergency_conact_numeber'] = $request->emergency_conact_numeber;
            $companyinsert['emergergency_contact_email'] = $request->emergergency_contact_email;
            $companyinsert['emegency_country_code'] = $request->emergency_countryCode;
            $companyinsert['emergency_country_iso'] = $request->emergency_countryiso;
            //$companyinsert['user_stage'] = "5";
            // $companyinsert['registration_countries'] = array_values($request->register_record);
            // $companyinsert['qualification_countries'] = $request->qualification_countries;
            $companyinsert['basic_info_status'] = "1";
            $companyinsert['nationality'] = $request->nationality;
 
            //$companyinsert['created_at'] = Carbon::now('Asia/Kolkata');

            $id = Auth::guard('nurse_middle')->user()->id;
            return  $this->adminRepository->updateadminProfile(['id' => $id], $companyinsert);
        } catch (\Exception $e) {
            Log::error("Error in AuthServices.updateAdminProfile(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function changePassword($request)
    {
        try {
            $user = Auth::guard('nurse_middle')->user();
            if (Hash::check($request['old_password'], $user->password)) {
                $data = [
                    'password' => Hash::make($request['password'])
                ];
                $id = $user->id;
                return  $this->adminRepository->updatePassword(['id' => $id], $data);
            }
        } catch (\Exception $e) {
            Log::error("Error in AuthServices.changePassword(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
}
