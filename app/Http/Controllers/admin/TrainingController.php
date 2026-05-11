<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\TrainingRequest;
use App\Services\Admins\TrainingServices;
use App\Repository\Eloquent\TrainingRepository;

class TrainingController extends Controller
{
    protected $trainingServices;
    protected $trainingRepository;
  
    public function __construct(TrainingServices $trainingServices , TrainingRepository $trainingRepository){
        $this->trainingServices = $trainingServices;
        $this->trainingRepository = $trainingRepository;
       
    }

    // this is Degree  data in database
    public function TrainingList(Request $request)
    {
        try {
            $trainingData  =  $this->trainingRepository->getAll();
            return view('admin.training_list',compact('trainingData'));
        } catch (\Exception $e) {
            log::error('Error in TrainingController/degreeList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addTraining(TrainingRequest $request)
    {
        try {
         
           return $this->trainingServices->addTraining($request);
        } catch (\Exception $e) {
            log::error('Error in TrainingController/addDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteTraining(Request $request)
    {
        try {
           return $this->trainingServices->deleteTraining($request);
        } catch (\Exception $e) {
            log::error('Error in TrainingController/deleteTraining :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateTraining(TrainingRequest $request)
    {
        try {
           return $this->trainingServices->updateTraining($request);
        } catch (\Exception $e) {
            log::error('Error in TrainingController/updateTraining :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getTraining(Request $request)
    {
        try {
           return $this->trainingRepository->get(['id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in TrainingController/getTraining :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    

  

}
