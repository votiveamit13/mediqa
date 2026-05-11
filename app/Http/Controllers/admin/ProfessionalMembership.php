<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\MembershipRequest;
use App\Http\Requests\MembershipTypeRequest;
use App\Http\Requests\AwardsRequest;
use App\Services\Admins\MembershipServices;
use App\Repository\Eloquent\MembershipRepository;

class ProfessionalMembership extends Controller{
    protected $membershipServices;
    protected $membershipRepository;
  
    public function __construct(MembershipServices $membershipServices , MembershipRepository $membershipRepository){
        $this->membershipServices = $membershipServices;
        $this->membershipRepository = $membershipRepository;
       
    }

    public function countryList(Request $request)
    {
        
        try {
            $membershipData  =  $this->membershipRepository->getAll(['country_organiztions'=>"0",'sub_organiztions'=>NULL]);
            return view('admin.country-list',compact('membershipData'));
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addCountry(MembershipRequest $request)
    {
        //print_r($request);die;
        try {
         
            return $this->membershipServices->addCountry($request);
         } catch (\Exception $e) {
             log::error('Error in DegreeController/addDegree :' . $e->getMessage() . 'in line' . $e->getLine());
             return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
         }
    }

    public function getCountry(Request $request)
    {
        try {
           return $this->membershipRepository->get(['organization_id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/getDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deleteCountry(Request $request)
    {
        try {
           return $this->membershipServices->deleteCountry($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/deleteDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateCountry(MembershipRequest $request)
    {
        
        try {
           return $this->membershipServices->updateCountry($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/updateDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function subcountryList(Request $request)
    {
        
        try {
            $membershipData  =  $this->membershipRepository->getAll(['sub_organiztions'=>0,'country_organiztions'=>$request->id]);
            $data['country_data'] = $membershipData;
            $data['request_id'] = $request->id;
            // echo "<pre>";
            // print_r($country_data);
            return view('admin.subcountry-list')->with($data);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }    

    public function subcountry(Request $request)
    {
        
        try {
            $membershipData  =  $this->membershipRepository->getAll(['sub_organiztions'=>$request->id,'country_organiztions'=>$request->country_id]);
            $subcountry_id = $request->id;
            $country_id = $request->country_id;
            return view('admin.sub_country',compact('membershipData','country_id','subcountry_id'));
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function membershipType()
    {
        
        try {
            $membershipData  =  $this->membershipRepository->getAllMember(['submember_id'=>"0"]);
            //print_r($membershipData);
            return view('admin.membership_type',compact('membershipData'));
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function subMemberList(Request $request)
    {
        
        try {
            $membershipData  =  $this->membershipRepository->getAllMember(['submember_id'=>$request->id]);
            $data['membershipData'] = $membershipData;
            $data['membership_id'] = $request->id;
            
            return view('admin.submembership-list')->with($data);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }    

    public function addMembershipType(MembershipTypeRequest $request)
    {
        //print_r($request);die;
        try {
         
            return $this->membershipServices->addMembershipType($request);
         } catch (\Exception $e) {
             log::error('Error in DegreeController/addDegree :' . $e->getMessage() . 'in line' . $e->getLine());
             return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
         }
    }

    public function getMembership(Request $request)
    {
        try {

           return $this->membershipRepository->getMember(['membership_id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/getDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateMembership(MembershipTypeRequest $request)
    {
        
        
        try {
           return $this->membershipServices->updateMembership($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/updateDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deleteMembership(Request $request)
    {
        try {
           return $this->membershipServices->deleteMembership($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/deleteDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function awards_list(Request $request)
    {
        
        try {
            $awardsData  =  $this->membershipRepository->getAllAwards(['sub_award_id'=>"0"]);
            
            return view('admin.awards_list',compact('awardsData'));
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addAwards(AwardsRequest $request)
    {
        //print_r($request);die;
        try {
         
            return $this->membershipServices->addAwards($request);
         } catch (\Exception $e) {
             log::error('Error in DegreeController/addDegree :' . $e->getMessage() . 'in line' . $e->getLine());
             return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
         }
    }

    public function getAwards(Request $request)
    {
        try {

           return $this->membershipRepository->getAwards(['award_id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/getDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateAwards(AwardsRequest $request)
    {
        
        
        try {
           return $this->membershipServices->updateAwards($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/updateDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deleteAwards(Request $request)
    {
        try {
           return $this->membershipServices->deleteAwards($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/deleteDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function subAwardsList(Request $request)
    {
        
        try {
            $awardsData  =  $this->membershipRepository->getAllAwards(['sub_award_id'=>$request->id]);
            $data['awardsData'] = $awardsData;
            $data['award_id'] = $request->id;

            return view('admin.subawards_list')->with($data);;
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    
}