<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\SkillRequest;
use App\Services\Admins\SkillServices;
use App\Repository\Eloquent\SkillRepository;

class SkillController extends Controller
{
    protected $skillServices;
    protected $skillRepository;
  
    public function __construct(SkillServices $skillServices , SkillRepository $skillRepository){
        $this->skillServices = $skillServices;
        $this->skillRepository = $skillRepository;
       
    }

    // this is Skill  data in database
    public function skillList(Request $request)
    {
        try {
            $skillData  =  $this->skillRepository->getAll();
            return view('admin.skill-list',compact('skillData'));
        } catch (\Exception $e) {
            log::error('Error in SkillController/specialityList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addSkill(SkillRequest $request)
    {
        try {
           return $this->skillServices->addSkill($request);
        } catch (\Exception $e) {
            log::error('Error in SkillController/addSkill :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteSkill(Request $request)
    {
        try {
           return $this->skillServices->deleteSkill($request);
        } catch (\Exception $e) {
            log::error('Error in SkillController/deleteSkill :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateSkill(SkillRequest $request)
    {
        try {
           return $this->skillServices->updateSkill($request);
        } catch (\Exception $e) {
            log::error('Error in SkillController/updateSkill :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getSkill(Request $request)
    {
        try {
           return $this->skillRepository->get(['id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in SkillController/getSkill :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    

  

}
