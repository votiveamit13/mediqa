<?php

namespace App\Http\Controllers\agencies;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\User\AuthServices;
use App\Repository\Eloquent\SpecialityRepository;
use App\Models\SpecialityModel;
use App\Models\PractitionerTypeModel;
use App\Models\WorkPreferModel;

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
            $practitioner_data = SpecialityModel::where("status",'1')->get();
            //print_r($practitioner_data);die;
            $speciality_data = PractitionerTypeModel::where("status",'1')->get();
            $work_preferences_data = WorkPreferModel::get();
            return view('nurse.home', compact( 'message','practitioner_data','speciality_data','work_preferences_data'));
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
           return view('nurse.agencies', compact( 'message','practitioner_data','speciality_data','work_preferences_data'));
        } else {
            

            return redirect()->route('nurse.dashboard');
        }
        
    }
    public function registraion($message = '')
    {
         if (!Auth::guard('nurse_middle')->check()) {
            $practitioner_data = SpecialityModel::where("status",'1')->get();
            //print_r($practitioner_data);die;
            $speciality_data = PractitionerTypeModel::where("status",'1')->get();
            $work_preferences_data = WorkPreferModel::get();
            $title = "Login";
           return view('agencies.agencies-registraion', compact( 'message','practitioner_data','speciality_data','work_preferences_data'));
        } else {
            return redirect()->route('nurse.dashboard');
        }
        
    }

    public function login($message = '')
    {

        $practitioner_data = SpecialityModel::where("parent",0)->get();
        $speciality_data = PractitionerTypeModel::where("parent",0)->get();
        $work_preferences_data = WorkPreferModel::where("sub_env_id",0)->where("sub_envp_id",0)->get();
        $title = "Login";
        return view('nurse.login', compact('title', 'message','practitioner_data','speciality_data','work_preferences_data'));
        
    }
    
}