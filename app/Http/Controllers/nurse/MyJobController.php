<?php

namespace App\Http\Controllers\nurse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\MatchHelper;
use App\Models\User;
use App\Models\JobsModel;
use App\Models\NurseApplication;
use App\Models\SpecialityModel;
use Illuminate\Support\Facades\Auth;
use DB;

class MyJobController extends Controller
{
    public function nurseMyJobs(){
        
       return view('nurse.my_career.nurseMyJobs');
    }
}