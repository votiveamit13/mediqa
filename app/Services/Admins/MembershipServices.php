<?php
namespace App\Services\Admins;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\MembershipRepository;

class MembershipServices
{
    protected $membershipRepository;

    public function __construct(MembershipRepository $membershipRepository)
    {
        $this->membershipRepository = $membershipRepository;
    }

    // degree data in database

     public function addCountry($data)
    {
        try {
            $allData['organization_country'] = $data['country'];
            $allData['organization_name'] = $data['organization_name'];
            $allData['country_organiztions'] = $data['country_organiztions'];
            $allData['sub_organiztions'] = $data['sub_organiztions'];
            $run = $this->membershipRepository->create($allData);
            
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Country'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in MembershipServices/addCountry(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteCountry($request)
    {
        try {
            $run = $this->membershipRepository->delete(['organization_id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Country'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/deleteDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateCountry($data)
    {
        try {

            $allData['organization_country'] = $data['country'];
            $allData['organization_name'] = $data['organization_name'];
            
            $id = $data['id'];
            $run= $this->membershipRepository->update(['organization_id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Country'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/updateDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addMembershipType($data)
    {
        try {
            $allData['membership_name'] = $data['membership_type'];
            $allData['submember_id'] = $data['sub_membershiptype'];
            
            $run = $this->membershipRepository->createMember($allData);
            
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Membership'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in MembershipServices/addCountry(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateMembership($data)
    {
        try {

            $allData['membership_name'] = $data['membership_type'];
            $id = $data['id'];
            $run= $this->membershipRepository->updateMembership(['membership_id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Membership Type'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/updateDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deleteMembership($request)
    {
        try {
            $run = $this->membershipRepository->deleteMembership(['membership_id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Membership Type'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/deleteDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addAwards($data)
    {
        try {
            $allData['award_name'] = $data['award_name'];
            $allData['sub_award_id'] = $data['awards_id'];
            
            $run = $this->membershipRepository->createAwards($allData);
            
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Awards'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in MembershipServices/addCountry(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateAwards($data)
    {
        try {

            $allData['award_name'] = $data['award_name'];
            $id = $data['id'];
            $run= $this->membershipRepository->updateAwards(['award_id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Awards'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/updateDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deleteAwards($request)
    {
        try {
            $run = $this->membershipRepository->deleteAwards(['award_id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Awards'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/deleteDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

 

        
}
