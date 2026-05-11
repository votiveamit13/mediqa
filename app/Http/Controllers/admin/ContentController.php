<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\NewsModel;
use Illuminate\Http\Request;
use App\Repository\Eloquent\ContentRepository;
use App\Services\Admins\ContentServices;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\ContentRequest;
use App\Http\Requests\AboutusRequest;

class ContentController extends Controller
{
    protected $contentRepository;
    protected $contentServices;

    public function __construct(ContentRepository $contentRepository,ContentServices $contentServices){
        $this->contentRepository = $contentRepository;
        $this->contentServices = $contentServices;
    }
    public function contactList()
    {
        try {
            $contactData  = $this->contentRepository->getContactList();
            return view('admin.contact-list',compact('contactData'));
        } catch (\Exception $e) {
            log::error('Error in ContentController/contactList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
      /* news management */
    public function newsList()
    {
        try {
            $faqData  = $this->contentRepository->getNewsList();
            return view('admin.news-list',compact('faqData'));
        } catch (\Exception $e) {
            log::error('Error in ContentController/newsList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
   
    public function addNews()
    {
        try {
        
            return view('admin.add-news');
        } catch (\Exception $e) {
            log::error('Error in ContentController/addNews :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNewsForm(NewsRequest $request)
    {
        try {
            return $this->contentServices->addNewss($request);
        } catch (\Exception $e) {
            log::error('Error in ContentController/addNewss :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function update_news(Request $request)
    {
        try {
            $data_news = NewsModel::where("id", $request->id)
            ->first();
            return view('admin.update-news',compact('data_news'));
        } catch (\Exception $e) {
            log::error('Error in ContentController/update_news :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
      public function fetchSubspecialty(Request $request)
        {
            $data['subspecialty'] = SpecialityModel::where("parent", $request->specialty_id)
            ->get(["name", "id"]);
      
            return response()->json($data);
        }

    public function update_news_store(NewsRequest $request)
    {
        try {
            return $this->contentServices->updateNews($request);
        } catch (\Exception $e) {
            log::error('Error in ContentController/update_news_store() :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateFaq(FaqRequest $request)
    {
        try {
            return $this->contentServices->updateFaq($request);
        } catch (\Exception $e) {
            log::error('Error in ContentController/updateFaq() :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteNews(Request $request)
    {
        try {
            $run = $this->contentRepository->deleteNews(['id' => $request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'News'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            log::error('Error in ContentController/deleteFaq :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    /* terms and condition management */
    public function getTermsCondition(){
        try {
            $termsconditionData = $this->contentRepository->getTermsCondition();
            return view('admin.terms-condition',compact('termsconditionData'));
        } catch (\Exception $e) {
            log::error('Error in ContentController/getTermsCondition :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateTermsCondition(ContentRequest $request){
        try {
            return $this->contentServices->updateTermsCondition($request);
        } catch (\Exception $e) {
            log::error('Error in ContentController/updateTermsCondition :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

     /* privacy policy management */
     public function getPrivacyPolicy(){
        try {
            $privacyPolicyData = $this->contentRepository->getPrivacyPolicy();
            return view('admin.privacy-policy',compact('privacyPolicyData'));
        } catch (\Exception $e) {
            log::error('Error in ContentController/getPrivacyPolicy :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updatePrivacyPolicy(ContentRequest $request){
        try {
            return $this->contentServices->updatePrivacyPolicy($request);
        } catch (\Exception $e) {
            log::error('Error in ContentController/updatePrivacyPolicy :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    /* About Us management */
    public function getAboutus(){
            try {
                $section1 = $this->contentRepository->getSingleAboutusData(['id'=>1]);
                $section2 = $this->contentRepository->getSingleAboutusData(['id'=>2]);
                $section21 = $this->contentRepository->getSingleAboutusData(['id'=>3]);
                $section22 = $this->contentRepository->getSingleAboutusData(['id'=>4]);
                $section23 = $this->contentRepository->getSingleAboutusData(['id'=>5]);
                $section3 = $this->contentRepository->getSingleAboutusData(['id'=>6]);
                $aboutUsCountData = $this->contentRepository->getAboutusCountData();
                return view('admin.about-us',compact('section1','section2','section21','section22','section23','section3','aboutUsCountData'));
            } catch (\Exception $e) {
                log::error('Error in ContentController/getAboutus :' . $e->getMessage() . 'in line' . $e->getLine());
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        }

    public function updateAboutus(AboutusRequest $request){
        try {
            return $this->contentServices->updateAboutus($request);
        } catch (\Exception $e) {
            log::error('Error in ContentController/updateAboutus :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

}
