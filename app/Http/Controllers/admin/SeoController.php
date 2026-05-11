<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\SeoRequest;
use App\Http\Requests\editSeoRequest;
use App\Services\Admins\SeoServices;
use App\Repository\Eloquent\SeoRepository;

class SeoController extends Controller
{
    protected $SeoServices;
    protected $SeoRepository;
  
    public function __construct(SeoServices $SeoServices , SeoRepository $SeoRepository){
        $this->SeoServices = $SeoServices;
        $this->SeoRepository = $SeoRepository;
       
    }

    // this is Degree  data in database
    public function SeoList(Request $request)
    {
        try {
            $SeoData  =  $this->SeoRepository->getAll();
            return view('admin.seo_list',compact('SeoData'));
        } catch (\Exception $e) {
            log::error('Error in SeoController/SeoList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addSeo(SeoRequest $request)
    {
        try {
           return $this->SeoServices->addSeo($request);
        } catch (\Exception $e) {
            log::error('Error in SeoController/addDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteSeo(Request $request)
    {
        try {
           return $this->SeoServices->deleteSeo($request);
        } catch (\Exception $e) {
            log::error('Error in SeoController/deleteSeo :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateSeo(editSeoRequest $request)
    {
        // dd('update-seo');
        try {
           return $this->SeoServices->updateSeo($request);
        } catch (\Exception $e) {
            log::error('Error in SeoController/updateSeo :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getSeo(Request $request)
    {
        try {
           return $this->SeoRepository->get(['id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in SeoController/getSeo :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    

  

}
