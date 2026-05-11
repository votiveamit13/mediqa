<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\SpecialityModel;
use App\Models\PractitionerTypeModel;
use App\Models\User;
use App\Models\StateModel;
use App\Models\CountryModel;
use App\Models\CityModel;
use App\Models\Admin;
use App\Models\Product;

use  App\Services\Admins\ContentServices;
use  App\Services\Vendor\ProductServices;

use App\Http\Requests\ContactUsRequest;
use App\Http\Requests\SubscribeEmailRequest;





class HomeController extends Controller

{

    protected $contentServices;

    public function __construct(
     
        ContentServices $contentServices,
       
        
        )
    {
        $this->contentServices = $contentServices;
       
    }

    public function index()

    {
        $bannerData  = $this->bannerRepository->getBannerList();
        $categoryData  = $this->categoryRepository->getCategoryList();
        $isFeaturedCategory = CategoryModel::where('category.is_featured', 1)->get();
        $productDataAccordingDiscount = Product::orderBy('discount','DESC')->take(6)->get();
        return view('Vendor.home',compact('categoryData','isFeaturedCategory','bannerData','productDataAccordingDiscount'));
    }
    
    public function fetchProvinces(Request $request)
        {
            $data['province'] = StateModel::where("country_code", $request->country_id)
            ->get(["name", "id"]);
      
            return response()->json($data);
        }
    public function fetchVille(Request $request)
        {
          
            if($request->ut=='second'){
            $data['ville'] = CityModel::whereIn("state_id", $request->province_id)
            ->get(["name", "id"]);
            }else{
                $data['ville'] = CityModel::where("state_id", $request->province_id)
                ->get(["name", "id"]);
            }
                                          
            return response()->json($data);
        }
    public function fetchSubCat(Request $request)
        {
            $data['sub_cat'] = CategoryModel::where("parent_id", $request->category_id)
             ->get(["category_name", "id"]);
      
            return response()->json($data);
        }
    public function productData(Request $request)
    {
        try {
            $procuctData = Product::where('id', $request->id)->first();
            return view('Vendor.product-detail', compact('procuctData'));
        } catch (\Exception $e) {
            log::error('Error in BrandController/productDetail :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function nurseCareHome(Request $request){
        return view("nurse.nurse_care_home");
    }
    /* about us page  */
    public function aboutUs()
    {
        $section1 = $this->contentRepository->getSingleAboutusData(['id'=>1]);
        $section2 = $this->contentRepository->getSingleAboutusData(['id'=>2]);
        $section21 = $this->contentRepository->getSingleAboutusData(['id'=>3]);
        $section22 = $this->contentRepository->getSingleAboutusData(['id'=>4]);
        $section23 = $this->contentRepository->getSingleAboutusData(['id'=>5]);
        $section3 = $this->contentRepository->getSingleAboutusData(['id'=>6]);
        $aboutUsCountData = $this->contentRepository->getAboutusCountData();
        return view('Vendor.about_us',compact('section1','section2','section21','section22','section23','section3','aboutUsCountData'));
    }
    public function contactUs()
    {
        $comapnyContactData = Admin::where('type',0)->first();
        $faqData =  $this->contentRepository->getFaqList();
        $phoneCode = CountryModel::orderBy('id','DESC')->get();
        
        return view('Vendor.contact_us',compact('phoneCode','faqData','comapnyContactData'));
    }
    public function getNurseTypeJobs(Request $request)
    {
        $selectedNurseTypes = $request->nurseTypes;
        //print_r($selectedNurseTypes);die;
 
        // Query the database to fetch nurse type jobs based on the selected nurse types
        $nurseTypeJobs = SpecialityModel::where('parent', $selectedNurseTypes)->get();

        // Return the nurse type jobs data as JSON response
        return response()->json($nurseTypeJobs);
    }
    public function getSubSpecialties(Request $request)
    {
        $selectedspecialties = $request->specialties;

        // Query the database to fetch nurse type jobs based on the selected nurse types
        $selectedspecialties = PractitionerTypeModel::whereIn('parent', $selectedspecialties)->get();

        // Return the nurse type jobs data as JSON response
        return response()->json($selectedspecialties);
    }

    public function getNurseSpecialties(Request $request)
    {
        $selectedspecialties = $request->nurseTypeSpecialities;
        //print_r($selectedspecialties);die;
        //Query the database to fetch nurse type jobs based on the selected nurse types
        $selectedspecialties = SpecialityModel::where('parent', $selectedspecialties)->get();

        // Return the nurse type jobs data as JSON response
        return response()->json($selectedspecialties);
    }

    public function getsurgicalSpeciality(Request $request)
    {
        $selectedspecialties = $request->surgical_speciality;

        //print_r($selectedspecialties);die;
        //Query the database to fetch nurse type jobs based on the selected nurse types
        $selectedspecialties = PractitionerTypeModel::whereIn('parent', $selectedspecialties)->get();

        // Return the nurse type jobs data as JSON response
        return response()->json($selectedspecialties);
    }

    public function getsurgicalSubSpeciality(Request $request)
    {
        $selectedspecialties = $request->surgical_sub_speciality;
   
        //print_r($selectedspecialties);die;
        //Query the database to fetch nurse type jobs based on the selected nurse types
        $selectedspecialties = PractitionerTypeModel::whereIn('parent', $selectedspecialties)->get();

        // Return the nurse type jobs data as JSON response
        return response()->json($selectedspecialties);
    }

    public function termsCondition()
    {
        $termsconditionData  = $this->contentRepository->getTermsCondition();
        return view('Vendor.terms_condition',compact('termsconditionData'));
    }
    public function privacyPolicy()
    {
        $privacyPolicyData  = $this->contentRepository->getPrivacyPolicy();
        return view('Vendor.privacy',compact('privacyPolicyData'));
    }

    public function saveContact(ContactUsRequest $request)
    {
        return $this->contentServices->addContact($request);
        
    }
    public function subscribeEmail(SubscribeEmailRequest $request)
    {
        return $this->contentServices->subscribeEmail($request);
        
    }
    public function searchProduct(Request $request)
    {
        if($request->id != 'all'){
            $getParentCategoryId  = $this->categoryRepository->getParentCategory(['id'=>$request->id]);
        }else{
            $getParentCategoryId  = null;
        }
       
        $getAllBrand  = $this->brandRepository->getBrandList();
        $categoryAllData  = $this->categoryRepository->getCategoryList();
        $allSizeData = '';
        if($request->search){
            $getSearchString  = $request->search;
        }else{
            $getSearchString  = '';
        }
       
        $searchData['search'] = $request->search;
        $searchData['cate_id'] = $request->id;
        $searchData['sort_by'] = $request->sort_by;
        $searchData['brand_id'] = $request->brand_id;
        $searchData['size_id'] = $request->size_id;
        $searchData['price_id'] = $request->price_id;
        $searchData['rating_id'] = $request->rating_id;
        $searchData['max_price'] = $request->query('max_price') ? $request->query('max_price') : $request->max_price ;
        $searchData['min_price'] = $request->query('min_price') ? $request->query('min_price') : $request->min_price ;
        // dd($request->query('max_price'));
        $getProductList  = $this->productServices->filterService($searchData);
        $cateId = $request->id;
        $minPrice =  $request->query('min_price') ? $request->query('min_price') : $request->min_price ;
        $maxPrice = $request->query('max_price') ? $request->query('max_price') : $request->max_price ;
        
        // dd($getProductList);
        return view('Vendor.search-product',compact('getParentCategoryId','getSearchString','getAllBrand','categoryAllData','getProductList','cateId','minPrice','maxPrice'));
        
    }
}
