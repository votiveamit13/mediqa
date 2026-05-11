@extends('admin.layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="back_arrow" onclick="history.back()" title="Go Back">
        <i class="fa fa-arrow-left"></i>
    </div>
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8"> View Profile </h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted " href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">View Profile</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('admin/dist/images/breadcrumb/ChatBc.png') }}" alt=""
                            class="img-fluid" style="height: 125px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card w-100  overflow-hidden">
        <div class="card-body p-3 px-md-4 pb-0">
            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Personal Detail @if ($profileData->status == 1)
                <span class="badge bg-success ms-2">Unblock</span>
                @else
                <span class="badge bg-danger ms-2">Blocked</span>
                @endif
            </h3>
        </div>
        <div class="card-body p-3 px-md-4">
            <div class="row align-items-center justify-content-between">
                <div class="col ">
                    <div class="d-flex align-items-md-center gap-4 flex-column flex-md-row">
                        <div class="d-flex  mb-2 ">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center "
                                style="width: 144px; height: 144px;" ;>
                                <div class="border rounded-circle border-3 border-white d-flex align-items-center justify-content-center  overflow-hidden btn-light commingsoon"
                                    data-bs-toggle="modal" data-bs-target="#commingsoonModel"
                                    style="width: 140px; height: 140px;" ;>
                                    <img src="{{ asset($profileData->profile_img) }}" alt=""
                                        class="w-100 h-100">
                                </div>

                            </div>
                        </div>
                        <div class="w-100">
                            <div class="d-flex justify-content-between">
                                <h5 class="fs-5 mb-2 fw-bolder"> {{ ucwords($profileData->name)." ".ucwords($profileData->lastname) }} </h5>
                                <h5 class="fs-5 mb-2 fw-bolder"> </h5>

                            </div>
                            @if ($profileData->phone != '')
                            <p class="d-flex text-dark align-items-center gap-2 mb-1">
                                <i class="ti ti-phone fs-4"></i><strong> +{{ $profileData->country_code }}
                                    {{ $profileData->phone }}
                                </strong>
                            </p>
                            @endif
                            <div class="d-md-flex align-items-center gap-3 mb-2">
                                <p class="mb-0 d-flex text-dark align-items-center gap-2">
                                    <i class="ti ti-mail fs-4"></i>{{ $profileData->email }}
                                </p>

                            </div>
                            <div class="d-md-flex align-items-center gap-3 mb-2">
                                @if ($profileData->post_code != '')
                                <p class="fs-3 mb-0 fw-bolder">Post Code : {{ $profileData->post_code }}</p>
                                @endif
                                <h5 class="fs-5 mb-0 fw-bolder"> </h5>

                            </div>
                            <div class="d-md-flex align-items-center gap-3 mb-2">
                                @if ($profileData->preferred != '')
                                <p class="fs-3 mb-0 fw-bolder">Preferred Name : {{ $profileData->preferred }}</p>
                                @endif
                                <h5 class="fs-5 mb-0 fw-bolder"> </h5>

                            </div>
                            <div class="d-md-flex align-items-center gap-3 mb-">
                                @if ($profileData->store_url != '')
                                <p class="fs-3 mb-0 fw-bolder">Store URL: {{ $profileData->store_url }}</p>
                                @endif
                                <h5 class="fs-5 mb-0 fw-bolder"> </h5>

                            </div>


                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
    <div class="card list-drpdwns-set">
        <div class="card-body">
            @include("admin.layouts.nurse_view_tabs")
            <div class="tab-content border mt-2">
                <div class="tab-pane p-3 active show" id="navpill-1" role="tabpanel">
                    <div class=" w-100  overflow-hidden">
                        <div class="card-body p-3 px-md-4 pb-0">
                            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Language Skills</h3>
                        </div>
                        <div class="card-body p-3 px-md-4">
                            @if(!empty($language_skills))
                            <div class="language_skills_details">
                                <div class="mt-4">
                                     <?php
                                            if(!empty($language_skills) && $language_skills->langprof_level != NULL){
                                                $language_skills_data = json_decode($language_skills->langprof_level);
                                            
                                            }else{
                                                $language_skills_data = array(); 
                                            }

                                            $lang_data = (array)$language_skills_data;
                                            //print_r($lang_data);

                                            $langs_arr = array();
                                            $langid_arr = array();

                                            if(!empty($language_skills_data)){
                                                foreach ($language_skills_data as $index=>$langdata) {
                                                
                                                    $languages_name = DB::table("languages")->where("language_id",$index)->first();
                                                    //print_r($p_memb);
                                                    $langs_arr[] = $languages_name->language_name;
                                                    $langid_arr[] = $index;
                                                    
                                                }
                                            }
                                            $i = 0;
                                           
                                        ?>

                                <!-- Language Groups -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Language Groups</label>
                                    <div>
                                    @foreach($langs_arr as $langdata)    
                                    <span class="badge bg-dark me-1">{{ $langdata }}</span>
                                    
                                    @endforeach
                                    </div>
                                </div>
                                @foreach ($langid_arr as $l_arr)
                                <?php
                                    $sub_lang = (array)$lang_data[$l_arr];
                                    $language_data = DB::table("languages")->where("language_id",$l_arr)->first();
                                    $sublanguage_data = DB::table("languages")->where("sub_language_id",$l_arr)->orderBy("language_name","ASC")->get();
                                    //print_r($sub_lang);   
                                    $sub_lang_arr = array();
                                    $sublangid_arr = array();
                                    $sub_lang_text = '';

                                    foreach ($sub_lang as $index=>$larr) {
                                        $languages_name = DB::table("languages")->where("language_id",$index)->first();
                                        if(!empty($language_data) && $language_data->language_field == "dropdown"){
                                            
                                            $sub_lang_arr[] = $languages_name->language_name;
                                            $sublangid_arr[] = $index;
                                        }else{
                                            $sub_lang_arr[] = $languages_name->language_name;
                                            $sublangid_arr[] = $index;
                                            //$sub_lang_text = $sub_lang[0];
                                        }
                                    
                                    }
                                    
                                    
                                ?>
                                
                                    <!-- Asian Languages -->
                                <div class="mb-3">
                                    <label class="form-label">{{ $langs_arr[$i] }}</label>
                                    <div>
                                        @foreach ($sub_lang_arr as $sl_arr)
                                    <span class="badge bg-secondary me-1">{{ $sl_arr }}</span>
                                    @endforeach    
                                    
                                    </div>
                                </div>

                                <!-- Proficiency Level (Asian Languages) -->
                                <div class="mb-3">
                                    <label class="form-label">Proficiency Level ({{ $langs_arr[$i] }})</label>
                                    <div>
                                        @foreach ($sublangid_arr as $subl_arr)
                                        <?php
                                            $sublanguage_name = DB::table("languages")->where("language_id",$subl_arr)->first();
                                            $prof_level = (array)$sub_lang[$subl_arr];
                                            //print_r($prof_level);
                                            
                                        ?>
                                    <div class="mb-1">{{ $sublanguage_name->language_name }}: <strong>{{ $prof_level[0] }}</strong></div>
                                    @endforeach
                                    </div>
                                </div>
                                
                                <?php
                                    $i++;
                                ?>
                                @endforeach
                                
                                </div>
                                <div class="language_proficiency">
                                    <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center  mt-3" style="margin-bottom: 20px;">Language Proficiency Certifications</h4>
                                    <?php
                                        if(!empty($language_skills) && $language_skills->english_prof_cert != NULL){
                                        $english_prof_data = json_decode($language_skills->english_prof_cert);
                                        
                                        }else{
                                        $english_prof_data = array(); 
                                        }

                                        $english_data = (array)$english_prof_data;
                                        //print_r($lang_data);

                                        $eng_arr = array();
                                        $engid_arr = array();

                                        if(!empty($english_prof_data)){
                                            foreach ($english_prof_data as $index=>$englishdata) {
                                                $languages_name = DB::table("languages")->where("language_id",$index)->first();
                                                //print_r($p_memb);
                                                $engid_arr[] = $index;
                                                $eng_arr[] = $languages_name->language_name;
                                                
                                            }
                                        }
                                        
                                    ?>    
                                    @if(!empty($engid_arr))
                                    @foreach ($engid_arr as $engids)
                                    <?php
                                        $lang_data = DB::table("languages")->where("language_id",$engids)->first();
                                        $engdata = (array)$english_data[$engids];
                                    ?>
                                    <div style="margin-bottom: 30px; border-bottom: 1px solid #eee; padding-bottom: 20px;">
                                        <h4 style="margin-bottom: 10px; font-size: 16px;">
                                        {{ $lang_data->language_name }}
                                        </h4>
                                        <p><strong>Score / Level Obtained:</strong>{{ $engdata['score_level'] }}</p>
                                        <p><strong>Expiring Date:</strong>{{ $engdata['expiring_date'] }}</p>
                                        
                                        <div class="evidence_img_list">
                                            <p><strong>Evidence:</strong>
                                            <ul>
                                                <?php
                                                    if(isset($engdata['evidence_imgs'])){
                                                        $evidence_imgs = (array)json_decode($engdata['evidence_imgs']);
                                                    //$evorgimg = $evidence_imgs[$p_arr2];
                                                    //print_r($evorgimg);
                                                    $i = 0;
                                                    ?>
                                                @if(!empty($evidence_imgs))
                                                @foreach ($evidence_imgs as $ev_img)
                                                <li>
                                                    <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank" style="color: #007bff; text-decoration: none;">
                                                        📄 {{ $ev_img }}
                                                    </a>
                                                </li>
                                                @endforeach
                                                @endif
                                                <?php
                                                }
                                                //print_r($evidence_imgs);
                                                ?>
                                                
                                            
                                            </ul>
                                        </div>    
                                        
                                        </p>
                                    </div>
                                    @endforeach
                                    
                                    @endif
                                </div>
                              
                            
                                <div class="other_proficiency">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center  mt-3" style="margin-bottom: 20px;">Other Language Proficiency Certifications</h3>
                                    <?php
                                        if(!empty($language_skills) && $language_skills->other_prof_cert != NULL){
                                        $other_prof_data = json_decode($language_skills->other_prof_cert);
                                        
                                        }else{
                                        $other_prof_data = array(); 
                                        }

                                        $otherprof_data = (array)$other_prof_data;
                                        //print_r($lang_data);

                                        $other_prof_arr = array();

                                        if(!empty($other_prof_data)){
                                            foreach ($other_prof_data as $index=>$otherdata) {
                                            
                                                //print_r($p_memb);
                                                $other_prof_arr[] = $index;
                                                
                                            }
                                        }
                                    
                                    ?>
                                    <!-- Repeat this block for each certification -->
                                    @foreach ($other_prof_arr as $otherarr)
                                    <?php
                                        $otherdata = (array)$otherprof_data[$otherarr];
                                        $other_prof_name = DB::table("languages")->where("language_id",$otherarr)->first();
                                    
                                    //print_r($engdata['score_level']);
                                    ?>
                                    <div style="margin-bottom: 30px; border-bottom: 1px solid #eee; padding-bottom: 20px;">
                                        <h4 style="margin-bottom: 10px; font-size: 16px;">
                                        {{ $other_prof_name->language_name }}
                                        </h4>
                                        <p><strong>Score / Level Obtained:</strong>{{ $otherdata['score_level'] }}</p>
                                        <p><strong>Expiring Date:</strong> {{ $otherdata['expiring_date'] }}</p>
                                        
                                        <div class="evidence_img_list">
                                            <p><strong>Evidence:</strong>
                                            <ul>
                                                <?php
                                                    if(isset($otherdata['evidence_imgs'])){
                                                        $evidence_imgs = (array)json_decode($otherdata['evidence_imgs']);
                                                    //$evorgimg = $evidence_imgs[$p_arr2];
                                                    //print_r($evorgimg);
                                                    $i = 0;
                                                    ?>
                                                @if(!empty($evidence_imgs))
                                                @foreach ($evidence_imgs as $ev_img)
                                                <li>
                                                    <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank" style="color: #007bff; text-decoration: none;">
                                                        📄 {{ $ev_img }}
                                                    </a>
                                                </li>
                                                @endforeach
                                                @endif
                                                <?php
                                                }
                                                //print_r($evidence_imgs);
                                                ?>
                                                
                                            
                                            </ul>
                                        </div>    
                                        </p>
                                    </div>
                                    @endforeach
                                    
                                </div>

                                <div class="specialized_skills">
                                    <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center  mt-3" style="margin-bottom: 20px;">Specialized Language Skills</h4>
                                    <?php
                                        if(!empty($language_skills) && $language_skills->specialized_lang_skills != NULL){
                                        $specialized_lang_data = json_decode($language_skills->specialized_lang_skills);
                                        
                                        }else{
                                        $specialized_lang_data = array(); 
                                        }

                                        $specialized_langskills = (array)$specialized_lang_data;
                                        //print_r($lang_data);

                                        $specialized_langarr = array();

                                        if(!empty($specialized_lang_data)){
                                        foreach ($specialized_lang_data as $index=>$specializeddata) {
                                        
                                            //print_r($p_memb);
                                            $specialized_langarr[] = $index;
                                            
                                        }
                                        }
                                    
                                        $specialized_lang_json = json_encode($specialized_langarr);
                                    ?>
                                    <!-- Repeat this block for each certification -->
                                    @foreach($specialized_langarr as $speclangarr)
                                    <?php
                                        $specializeddata = (array)$specialized_langskills[$speclangarr];
                                        $specialized_lang_name = DB::table("languages")->where("language_id",$speclangarr)->first();
                                    
                                    //print_r($engdata['score_level']);
                                    ?>
                                    <div style="margin-bottom: 30px; border-bottom: 1px solid #eee; padding-bottom: 20px;">
                                        <h4 style="margin-bottom: 10px; font-size: 16px;">
                                        {{ $specialized_lang_name->language_name }}
                                        </h4>
                                        <div class="evidence_img_list">
                                            <p><strong>Evidence:</strong>
                                            <ul>
                                                <?php
                                                    if(isset($specializeddata['evidence_imgs'])){
                                                        $evidence_imgs = (array)json_decode($specializeddata['evidence_imgs']);
                                                    //$evorgimg = $evidence_imgs[$p_arr2];
                                                    //print_r($evorgimg);
                                                    $i = 0;
                                                    ?>
                                                @if(!empty($evidence_imgs))
                                                @foreach ($evidence_imgs as $ev_img)
                                                <li>
                                                    <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank" style="color: #007bff; text-decoration: none;">
                                                        📄 {{ $ev_img }}
                                                    </a>
                                                </li>
                                                @endforeach
                                                @endif
                                                <?php
                                                }
                                                //print_r($evidence_imgs);
                                                ?>
                                                
                                            
                                            </ul>
                                        </div>    
                                        
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                            @else
                            <div class="col-md-12">
                                <div class="text-center text-danger fs-5">No data found</div>
                            </div>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection