<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\DegreeRequest;
use App\Services\Admins\DegreeServices;
use App\Repository\Eloquent\DegreeRepository;

class DegreeController extends Controller
{
    protected $degreeServices;
    protected $degreeRepository;
  
    public function __construct(DegreeServices $degreeServices , DegreeRepository $degreeRepository){
        $this->degreeServices = $degreeServices;
        $this->degreeRepository = $degreeRepository;
       
    }

    // this is Degree  data in database
    public function degreeList(Request $request)
    {
        try {
            $degreeData  =  $this->degreeRepository->getAll();
            return view('admin.degree-list',compact('degreeData'));
        } catch (\Exception $e) {
            log::error('Error in DegreeController/degreeList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addDegree(DegreeRequest $request)
    {
        try {
         
           return $this->degreeServices->addDegree($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/addDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteDegree(Request $request)
    {
        try {
           return $this->degreeServices->deleteDegree($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/deleteDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateDegree(DegreeRequest $request)
    {
        try {
           return $this->degreeServices->updateDegree($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/updateDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getDegree(Request $request)
    {
        try {
           return $this->degreeRepository->get(['id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/getDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    

  

}
