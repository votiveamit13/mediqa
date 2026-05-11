@extends('nurse.layouts.layout')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ url('/public') }}/nurse/assets/css/jquery.ui.datepicker.monthyearpicker.css">
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

<style type="text/css">
  .hide_profile_image {
    display: none !important;
  }

  span.select2.select2-container {
    padding: 5px !important;
    width: 100% !important;
  }

  .select2-container--default .select2-selection--multiple {
    background-color: white !important;
    border: 1px solid #0000 !important;
    border-radius: 4px !important;
    cursor: text !important;
  }

  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #000 !important;
    border: 1px solid #000 !important;
    border-radius: 4px !important;
    cursor: default !important;
    color: #fff !important;
    float: left;
    padding: 0;
    padding-right: 0.75rem;
    margin-top: calc(0.375rem - 2px);
    margin-right: 0.375rem;
    padding-bottom: 2px;
    white-space: normal;
    line-height: 20px;
  }

  .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff !important;
    font-size: 20px !important;
    float: left;
    padding-right: 3px;
    padding-left: 3px;
    margin-right: 1px;
    margin-left: 3px;
    font-weight: 700;
    line-height: 20px;
  }

  .registration_progress {
    font-weight: 900;
    background-color: black;
    color: #fff;
  }

  form#language_skills_form ul.select2-selection__rendered {
    box-shadow: none;
    max-height: inherit;
    border: none;
    position: relative;
  }

  .sublang_main_div select{
    padding: 5px;
    border: 1px solid #dddddd;
    height: 50px;
  }

  .custom-select-wrapper {
  position: relative;
  width: 100%;
}

.custom-select {
  width: 100%;
  padding: 10px;
  appearance: none; /* Remove native arrow */
  -webkit-appearance: none;
  -moz-appearance: none;
  background: white;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
}

/* Custom arrow */
.custom-select-wrapper::after {
  content: "▼";
  position: absolute;
  top: 76%;
  right: 10px;
  transform: translateY(-50%);
  pointer-events: none;
  color: black;
  height: 36px !important;
  width: 20px;
}

</style>
@endsection

@section('content')
<main class="main">
  <section class="section-box mt-0">
    <div class="">
      <div class="row m-0 profile-wrapper">
        <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">

        @include('nurse.sidebar_profile')
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 col-12 right_content">
          <div class="content-single content_profile">
            @if(!email_verified())
            <div class="container-fluid">
              <div class="alert alert-warning mt-2" role="alert">
                <span class="d-flex align-items-center justify-content-center "><img src="{{ asset('nurse/assets/imgs/info.png') }}" width="25px;" alt="info" class="mx-2"> Thank you for signing up with us. To get full access, please verify your email first. If you didn't receive the email, <a href="javascript:void(0);" class="link-opacity-100 mx-1" style="color: black;text-decoration-line: underline;
                  text-decoration-style: straight;" onclick="return resendEmailLink()"><b> click here to resend it.</b></a></span>
              </div>
            </div>
            @endif
            @if(!account_verified())
            <div class="container-fluid">
              <div class="alert alert-warning mt-2" role="alert">
                <span class="d-flex align-items-center justify-content-center "><img src="{{ asset('nurse/assets/imgs/info.png') }}" width="25px;" alt="info" class="mx-2">Thank you for verifying your email!<br>Please complete your profile, and once approved, you will be able to apply for jobs and make your profile visible.
                </span>
              </div>
            </div>
            @endif
            @if(!completeProfile())
            <div class="container-fluid">
              <div class="alert alert-warning mt-2" role="alert">
                <span class="d-flex align-items-center justify-content-center "><img src="{{ asset('nurse/assets/imgs/info.png') }}" width="25px;" alt="info" class="mx-2">Thank you for completing your profile.<br>We are currently reviewing your details and will get in touch with you shortly.
                </span>
              </div>
            </div>
            @endif
            @if(!approvedProfile())
            <div class="container-fluid">
              <div class="alert alert-warning mt-2" role="alert">
                <span class="d-flex align-items-center justify-content-center "><img src="{{ asset('nurse/assets/imgs/info.png') }}" width="25px;" alt="info" class="mx-2">Congratulations! Your profile has been successfully approved.<br>You can now apply for jobs, connect with employers, and receive interview requests.
                </span>
              </div>
            </div>
            @endif
            {{-- @if(!email_verified())
            <div class="alert alert-success mt-2" role="alert">
              <span class="d-flex align-items-center justify-content-center ">Please verify your email first to access your account </span>
            </div>
            @endif --}}

            <div class="tab-content">
                <?php $user_id=''; $i = 0;?>

                <div class="tab-pane fade" id="tab-my-profile-setting" style="display: block;opacity:1;">

                    
                    <div class="card shadow-sm border-0 p-4 mt-30">
                      <h3 class="mt-0 color-brand-1 mb-2">Language Skills</h3>
    
                      <form id="language_skills_form" method="POST" onsubmit="return update_language_skills()">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">

                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Language
                          </label>
                          <?php
                            if(!empty($language_skills) && $language_skills->langprof_level != NULL){
                              $language_skills_data = json_decode($language_skills->langprof_level);
                              
                            }else{
                              $language_skills_data = array(); 
                            }

                            $lang_data = (array)$language_skills_data;
                            //print_r($lang_data);

                            $lang_arr = array();

                            if(!empty($language_skills_data)){
                              foreach ($language_skills_data as $index=>$langdata) {
                              
                                //print_r($p_memb);
                                $lang_arr[] = $index;
                                
                              }
                            }
                          
                            $lang_json = json_encode($lang_arr);
                          ?>
                          <input type="hidden" name="mainlang" class="mainlang" value='<?php echo $lang_json; ?>'>
                          <ul id="main_languages" style="display:none;">
                             
                            @if(!empty($language_data))
                            @foreach($language_data as $langdata)
                            <li data-value="{{ $langdata->language_id }}">{{ $langdata->language_name }}</li>
                            @endforeach
                            @endif
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn main_languages_valid" data-list-id="main_languages" name="main_languages[]" multiple></select>
                          <span id='reqshiftlanguage' class='reqError text-danger valley'></span>
                        </div>
                        <div class="sub_languages_div">
                          @foreach ($lang_arr as $l_arr)
                          <?php
                            $sub_lang = (array)$lang_data[$l_arr];
                            $language_data = DB::table("languages")->where("language_id",$l_arr)->first();
                            $sublanguage_data = DB::table("languages")->where("sub_language_id",$l_arr)->orderBy("language_name","ASC")->get();
                            //print_r($sub_lang);   
                            $sub_lang_arr = array();
                            $sub_lang_text = '';

                            foreach ($sub_lang as $index=>$larr) {
                              if(!empty($language_data) && $language_data->language_field == "dropdown"){
                                $sub_lang_arr[] = $index;
                              }else{
                                $sub_lang_arr[] = $index;
                                //$sub_lang_text = $sub_lang[0];
                              }
                              
                            }
                            
                            
                            $sub_lang_json = json_encode($sub_lang_arr);
                          ?>
                          @if (!empty($language_data) && $language_data->language_field == "dropdown")
                          <div class="sublang_main_div sublang_main_div-{{ $l_arr }}">
                            <div class="sub_lang_div sub_lang_div-{{ $l_arr }} form-group level-drp">
                              <label class="form-label sub_lang_label sub_lang_label-{{ $l_arr }}" for="input-1">{{ $language_data->language_name }}</label>
                              <input type="hidden" name="sublang" class="sublang sublang-{{ $l_arr }}" value='<?php echo $sub_lang_json; ?>'>
                              <input type="hidden" name="sublang_list" class="sublang_list sublang_list-{{ $l_arr }}" value="{{ $l_arr }}">
                              <ul id="sub_lang_dropdown-{{ $l_arr }}" style="display:none;">
                                @if(!empty($sublanguage_data))
                                @foreach($sublanguage_data as $sublangdata)
                                <li data-value="{{ $sublangdata->language_id }}">{{ $sublangdata->language_name }}</li>
                                @endforeach
                                @endif
                              </ul>
                              <select class="js-example-basic-multiple addAll_removeAll_btn sub_lang_valid-{{ $l_arr }}" data-list-id="sub_lang_dropdown-{{ $l_arr }}" name="sub_languages[]" onchange="getProficiency('ap',{{ $l_arr }})" multiple="multiple"></select>
                              <span id="reqsublangvalid-{{ $l_arr }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="lang_proficiency_level-{{ $l_arr }}">
                              @foreach ($sub_lang_arr as $subl_arr)
                              <?php
                                $sublanguage_name = DB::table("languages")->where("language_id",$subl_arr)->first();
                                $prof_level = (array)$sub_lang[$subl_arr];
                                //print_r($prof_level);
                              ?>
                              <div class="custom-select-wrapper sublangprofdiv sublangprofdiv-{{ $subl_arr }} form-group level-drp" style="margin-bottom: 5px;">
                                <label class="form-label subproflabel-{{ $subl_arr }}" for="input-1">Proficiency Level ({{ $language_data->language_name }})</label>
                                <input type="hidden" name="sublangprof_list" class="sublangprof_list sublangprof_list-{{ $subl_arr }}" value="{{ $subl_arr }}">
                                <select class="langprof_level_valid-{{ $subl_arr }} custom-select form-input mr-10 langprof_level_valid-{{ $subl_arr }}" name="langprof_level[{{ $l_arr }}][{{ $subl_arr }}]">
                                  <option value="">select</option>
                                  <option value="Basic" @if($prof_level[0] == "Basic") selected @endif>Basic</option>
                                  <option value="Conversational" @if($prof_level[0] == "Conversational") selected @endif>Conversational</option>
                                  <option value="Fluent" @if($prof_level[0] == "Fluent") selected @endif>Fluent</option>
                                  <option value="Native" @if($prof_level[0] == "Native") selected @endif>Native</option>
                                </select>
                                
                              </div>
                              <span id="reqproflevelvalid-{{ $subl_arr }}" class="reqError text-danger valley"></span>
                              @endforeach
                            </div>
                          </div>
                          @endif
                          @if (!empty($language_data) && $language_data->language_field == "text")
                          <div class="sublang_main_div sublang_main_div-{{ $l_arr }}">
                            <div class="sub_lang_div sub_lang_div-{{ $l_arr }} form-group level-drp">
                              <label class="form-label sub_lang_label sub_lang_label-{{ $l_arr }}" for="input-1">{{ $language_data->language_name }}</label>
                              <input type="hidden" name="sublang_list" class="sub_lang_valid-{{ $l_arr }} sublang_list sublang_list-{{ $l_arr }}" value="{{ $l_arr }}">
                              <input type="text" name="sub_languages[]" class="sub_lang_valid-{{ $l_arr }} form-control fixed_salary_amount" onkeyup="getProficiency_text('ap',{{ $l_arr }})" value="@if(isset($sub_lang_arr[0])){{ $sub_lang_arr[0] }}@endif">
                              
                              <span id="reqsublangvalid-{{ $l_arr }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="lang_proficiency_level-{{ $l_arr }}">
                              @foreach ($sub_lang_arr as $subl_arr)
                              <?php
                                $sublanguage_name = DB::table("languages")->where("language_id",$subl_arr)->first();
                                $prof_level = (array)$sub_lang[$subl_arr];
                                //print_r($prof_level);
                              ?>
                              <div class="custom-select-wrapper sublangprofdiv sublangprofdiv-{{ $subl_arr }} form-group level-drp" style="margin-bottom: 5px;">
                                <label class="form-label subproflabel-{{ $subl_arr }}" for="input-1">Proficiency Level ({{ $language_data->language_name }})</label>
                                <input type="hidden" name="sublangprof_list" class="sublangprof_list sublangprof_list-{{ $subl_arr }}" value="{{ $subl_arr }}">
                                <select class="langprof_level_valid-{{ $subl_arr }} custom-select form-input mr-10 langprof_level_valid-{{ $subl_arr }}" name="langprof_level[{{ $l_arr }}][{{ $subl_arr }}]">
                                  <option value="">select</option>
                                  <option value="Basic" @if($prof_level[0] == "Basic") selected @endif>Basic</option>
                                  <option value="Conversational" @if($prof_level[0] == "Conversational") selected @endif>Conversational</option>
                                  <option value="Fluent" @if($prof_level[0] == "Fluent") selected @endif>Fluent</option>
                                  <option value="Native" @if($prof_level[0] == "Native") selected @endif>Native</option>
                                </select>
                                
                              </div>
                              <span id="reqproflevelvalid-{{ $subl_arr }}" class="reqError text-danger valley"></span>
                              @endforeach
                            </div>
                          </div>
                          
                          @endif
                          
                          @endforeach
                        </div>
                        <h6 class="emergency_text">
                          Language Proficiency Certifications
                        </h6>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">English Proficiency Tests
                          </label>
                          <?php
                            if(!empty($language_skills) && $language_skills->english_prof_cert != NULL){
                              $english_prof_data = json_decode($language_skills->english_prof_cert);
                              
                            }else{
                              $english_prof_data = array(); 
                            }

                            $english_data = (array)$english_prof_data;
                            //print_r($lang_data);

                            $eng_arr = array();

                            if(!empty($english_prof_data)){
                              foreach ($english_prof_data as $index=>$englishdata) {
                              
                                //print_r($p_memb);
                                $eng_arr[] = $index;
                                
                              }
                            }
                          
                            $eng_json = json_encode($eng_arr);
                          ?>
                          <input type="hidden" name="englang" class="englang" value='<?php echo $eng_json; ?>'>
                          <ul id="test_languages" style="display:none;">
                             
                            @if(!empty($test_data))
                            @foreach($test_data as $testdata)
                            <li data-value="{{ $testdata->language_id }}">{{ $testdata->language_name }}</li>
                            @endforeach
                            @endif
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn test_languages_valid" data-list-id="test_languages" name="main_languages[]" multiple></select>
                          <span id='reqengtest' class='reqError text-danger valley'></span>
                        </div>
                        <div class="tests_div">
                          @foreach ($eng_arr as $earr)
                            <?php
                              $engdata = (array)$english_data[$earr];
                              $eng_prof_name = DB::table("languages")->where("language_id",$earr)->first();
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              
                              //print_r($engdata['score_level']);
                            ?>
                            <div class="test_level_div test_level_div-{{ $earr }}">
                              <div class="strong_text inslabtext"><strong>{{ $eng_prof_name->language_name }}</strong></div>
                              <input type="hidden" name="engprof_list" class="engprof_list engprof_list-{{ $earr }}" value="{{ $earr }}">
                              <div class="form-group level-drp">
                                <label class="form-label" for="input-1">Score / Level Obtained</label>
                                <input type="text" name="english_prof_cert[{{ $earr }}][score_level]" class="form-control fixed_salary_amount testscore_level_valid-{{ $earr }}" value="{{ $engdata['score_level'] }}">
                                <span id="reqtestscore_level-{{ $earr }}" class="reqError text-danger valley"></span>
                              </div>
                              <div class="form-group level-drp">
                                <label class="form-label" for="input-1">Expiring date</label>
                                <input type="date" name="english_prof_cert[{{ $earr }}][expiring_date]" class="form-control fixed_salary_amount testexpiring_date_valid-{{ $earr }}" value="{{ $engdata['expiring_date'] }}">
                                <span id="reqtestexpiring_date-{{ $earr }}" class="reqError text-danger valley"></span>
                              </div>
                              <div class="form-group level-drp">
                                  <label class="form-label" for="input-1">Upload Evidence</label>
                                  <input type="hidden" name="english_prof_cert[{{ $earr }}][evidence_imgs]" class="english_prof_cert-{{ $earr }}" value="@if(isset($engdata['evidence_imgs'])){{ $engdata['evidence_imgs'] }}@endif">
                                  <input class="form-control upload_evidence upload_evidence-{{ $earr }}" type="file" name="" onchange="changeEvidenceImg({{ $user_id }},{{ $earr }},'english_prof_cert')" multiple="">
                                  <span id="requploadevidence-{{ $earr }}" class="reqError text-danger valley"></span>
                                  <div class="lang_evidence-{{ $earr }}">
                                    <?php
                                      if(isset($engdata['evidence_imgs'])){
                                        $evidence_imgs = (array)json_decode($engdata['evidence_imgs']);
                                        //$evorgimg = $evidence_imgs[$p_arr2];
                                        //print_r($evorgimg);
                                        $i = 0;
                                        ?>
                                        @if(!empty($evidence_imgs))
                                        @foreach ($evidence_imgs as $ev_img)
                                        <div class="trans_img trans_img-{{ $i+1 }}">
                                          <a href=""><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                          <div class="close_btn close_btn-' + i + '" onclick="deletelangEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}',{{ $earr }},'english_prof_cert')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                        </div>
                                        <?php
                                          $i++;
                                        ?>
                                        @endforeach
                                        @endif
                                        <?php
                                      }
                                      //print_r($evidence_imgs);
                                    ?>
                                  </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                        
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Other Language Proficiency Certifications
                          </label>
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
                          
                            $other_prof_json = json_encode($other_prof_arr);
                          ?>
                          <input type="hidden" name="other_proflang" class="other_proflang" value='<?php echo $other_prof_json; ?>'>
                          <ul id="other_test_languages" style="display:none;">
                             
                            @if(!empty($other_test_data))
                            @foreach($other_test_data as $othertestdata)
                            <li data-value="{{ $othertestdata->language_id }}">{{ $othertestdata->language_name }}</li>
                            @endforeach
                            @endif
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn other_languages_valid" data-list-id="other_test_languages" name="main_languages[]" multiple></select>
                          <span id='reqothertest' class='reqError text-danger valley'></span>
                        </div>
                        <div class="other_tests_div">
                          @foreach ($other_prof_arr as $otherarr)
                            <?php
                              $otherdata = (array)$otherprof_data[$otherarr];
                              $other_prof_name = DB::table("languages")->where("language_id",$otherarr)->first();
                              
                              //print_r($engdata['score_level']);
                            ?>
                          <div class="othertest_level_div othertest_level_div-{{ $otherarr }}">
                            <div class="strong_text inslabtext"><strong>{{ $other_prof_name->language_name }}</strong></div>
                            <input type="hidden" name="otherengprof_list" class="otherengprof_list otherengprof_list-{{ $otherarr }}" value="{{ $otherarr }}">
                            <div class="form-group level-drp">
                              <label class="form-label" for="input-1">Score / Level Obtained</label>
                              <input type="text" name="otherlangprof[{{ $otherarr }}][score_level]" class="form-control fixed_salary_amount otherscore_level_valid-{{ $otherarr }}" value="{{ $otherdata['score_level'] }}">
                              <span id="reqotherscore_level-{{ $otherarr }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group level-drp">
                              <label class="form-label" for="input-1">Expiring date</label>
                              <input type="date" name="otherlangprof[{{ $otherarr }}][expiring_date]" class="form-control fixed_salary_amount otherexpiring_date_valid-{{ $otherarr }}" value="{{ $otherdata['expiring_date'] }}">
                              <span id="reqotherexpiring_date-{{ $otherarr }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group level-drp">
                                <label class="form-label" for="input-1">Upload Evidence</label>
                                <input type="hidden" name="otherlangprof[{{ $otherarr }}][evidence_imgs]" class="other_prof_cert-{{ $otherarr }}" value="@if(isset($otherdata['evidence_imgs'])){{ $otherdata['evidence_imgs'] }}@endif">
                                <input class="form-control upload_evidence upload_evidence-{{ $otherarr }}" type="file" name="" onchange="changeEvidenceImg({{ $user_id }},{{ $otherarr }},'other_prof_cert')" multiple="">
                                <span id="requploadevidence-{{ $otherarr }}" class="reqError text-danger valley"></span>
                                <div class="lang_evidence-{{ $otherarr }}">
                                  <?php
                                    if(isset($otherdata['evidence_imgs'])){
                                      $evidence_imgs = (array)json_decode($otherdata['evidence_imgs']);
                                      //$evorgimg = $evidence_imgs[$p_arr2];
                                      //print_r($evidence_imgs);
                                      $i = 0;
                                      ?>
                                      @if(!empty($evidence_imgs))
                                      @foreach ($evidence_imgs as $ev_img)
                                      <div class="trans_img trans_img-{{ $i+1 }}">
                                        <a href=""><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                        <div class="close_btn close_btn-' + i + '" onclick="deletelangEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}',{{ $otherarr }},'other_prof_cert')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                      </div>
                                      <?php
                                        $i++;
                                      ?>
                                      @endforeach
                                      @endif
                                      <?php
                                    }
                                    //print_r($evidence_imgs);
                                  ?>
                                </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Specialized Language Skills
                          </label>
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
                          <input type="hidden" name="specialized_lang_skills_hidden" class="specialized_lang_skills" value='<?php echo $specialized_lang_json; ?>'>
                          <ul id="specialized_languages" style="display:none;">
                             
                            @if(!empty($specialized_lang_skills))
                            @foreach($specialized_lang_skills as $speclang)
                            <li data-value="{{ $speclang->language_id }}">{{ $speclang->language_name }}</li>
                            @endforeach
                            @endif
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn specialized_languages_valid" data-list-id="specialized_languages" name="main_languages[]" multiple></select>
                          <span id='reqspecializedskills' class='reqError text-danger valley'></span>
                        </div>
                        <div class="specialized_languages_div">
                          @foreach($specialized_langarr as $speclangarr)
                          <?php
                              $specializeddata = (array)$specialized_langskills[$speclangarr];
                              $specialized_lang_name = DB::table("languages")->where("language_id",$speclangarr)->first();
                              
                              //print_r($engdata['score_level']);
                            ?>
                          <div class="specialized_level_div specialized_level_div-{{ $speclangarr }}">
                            <div class="strong_text inslabtext"><strong>{{ $specialized_lang_name->language_name }}</strong></div>
                            <input type="hidden" name="specialized_level_list_hidden" class="specialized_level_list specialized_level_list-{{ $speclangarr }}" value="{{ $speclangarr }}">
                            <div class="form-group level-drp">
                              <label class="form-label" for="input-1">Upload Evidence</label>
                              <input type="hidden" name="specialized_lang_skills[{{ $speclangarr }}][evidence_imgs]" class="specialized_lang_skills-{{ $speclangarr }}" value="@if(isset($specializeddata['evidence_imgs'])){{ $specializeddata['evidence_imgs'] }}@endif">
                              <input class="form-control upload_evidence upload_evidence-{{ $speclangarr }}" type="file" name="" onchange="changeEvidenceImg({{ $user_id }},{{ $speclangarr }},'specialized_lang_skills')" multiple="">
                              <span id="requploadevidence-{{ $speclangarr }}" class="reqError text-danger valley"></span>
                              <div class="lang_evidence-{{ $speclangarr }}">
                                <?php
                                    if(isset($specializeddata['evidence_imgs'])){
                                      $evidence_imgs = (array)json_decode($specializeddata['evidence_imgs']);
                                      //$evorgimg = $evidence_imgs[$p_arr2];
                                      //print_r($evidence_imgs);
                                      $i = 0;
                                      ?>
                                      @if(!empty($evidence_imgs))
                                      @foreach ($evidence_imgs as $ev_img)
                                      <div class="trans_img trans_img-{{ $i+1 }}">
                                        <a href=""><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                        <div class="close_btn close_btn-' + i + '" onclick="deletelangEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}',{{ $speclangarr }},'specialized_lang_skills')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                      </div>
                                      <?php
                                        $i++;
                                      ?>
                                      @endforeach
                                      @endif
                                      <?php
                                    }
                                    //print_r($evidence_imgs);
                                  ?>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="declaration_box">
                          <input type="checkbox" name="professional_declare_information" class="professional_declare_information" value="1" @if(!empty($language_skills) && $language_skills->declare_info == "1") checked @endif>
                          <label for="declare_information">I declare that the information provided is true and correct</label>
                          
                        </div>
                        <span id="reqdeclare_information_profess" class="reqError text-danger valley"></span>
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitLanguageSkills" @if(!email_verified()) disabled  @endif>Save Changes</button>
                        </div>
                      </form>
    
    
                    </div>
    
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>


@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script src="{{ url('/public') }}/nurse/assets/js/jquery.ui.datepicker.monthyearpicker.js"></script>
@include('nurse.front_profile_js');
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js">
</script>
<script>
    $('.addAll_removeAll_btn').on('select2:open', function() {
        var $dropdown = $(this);
        var searchBoxHtml = `
            
            <div class="extra-buttons">
                <button class="select-all-button" type="button">Select All</button>
                <button class="remove-all-button" type="button">Remove All</button>
            </div>`;

        // Remove any existing extra buttons before adding new ones
        $('.select2-results .extra-search-container').remove();
        $('.select2-results .extra-buttons').remove();

        // Append the new extra buttons and search box
        $('.select2-results').prepend(searchBoxHtml);

        // Handle Select All button for the current dropdown
        $('.select-all-button').on('click', function() {
            var $currentDropdown = $dropdown;
            var allValues = $currentDropdown.find('option').map(function() {
                return $(this).val();
            }).get();
            $currentDropdown.val(allValues).trigger('change');
        });

        // Handle Remove All button for the current dropdown
        $('.remove-all-button').on('click', function() {
            var $currentDropdown = $dropdown;
            $currentDropdown.val(null).trigger('change');
        });
    });
    $('.js-example-basic-multiple').on('select2:open', function() {
        var searchBoxHtml = `
            <div class="extra-search-container">
                <input type="text" class="extra-search-box" placeholder="Search...">
                <button class="clear-button" type="button">&times;</button>
            </div>`;
        
        if ($('.select2-results').find('.extra-search-container').length === 0) {
            $('.select2-results').prepend(searchBoxHtml);
        }

        var $searchBox = $('.extra-search-box');
        var $clearButton = $('.clear-button');

        $searchBox.on('input', function() {

            var searchTerm = $(this).val().toLowerCase();
            $('.select2-results__option').each(function() {
                var text = $(this).text().toLowerCase();
                if (text.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            $clearButton.toggle($searchBox.val().length > 0);
        });

        $clearButton.on('click', function() {
            $searchBox.val('');
            $searchBox.trigger('input');
        });
    });

    $('.js-example-basic-multiple').select2();

    // Dynamically add the clear button
    const clearButton = $('<span class="clear-btn">✖</span>');
    $('.select2-container').append(clearButton);

    // Handle the visibility of the clear button
    function toggleClearButton() {

        const selectedOptions = $('.js-example-basic-multiple').val();
        if (selectedOptions && selectedOptions.length > 0) {
            clearButton.show();
        } else {
            clearButton.hide();
        }
    }

    // Attach change event to select2
    $('.js-example-basic-multiple').on('change', toggleClearButton);

    // Clear button click event
    clearButton.click(function() {

        $('.js-example-basic-multiple').val(null).trigger('change');
        toggleClearButton();
    });

    // Initial check
    toggleClearButton();
    $('.js-example-basic-multiple').each(function() {
        let listId = $(this).data('list-id');

        let items = [];
        console.log("listId",listId);
        $('#' + listId + ' li').each(function() {
            console.log("value",$(this).data('value'));
            items.push({ id: $(this).data('value'), text: $(this).text() });
        });
        console.log("items",items);
        $(this).select2({
            data: items
        });
    });

    if ($(".englang").val() != "") {
      var englang = JSON.parse($(".englang").val());
      console.log("englang",englang);
      $('.js-example-basic-multiple[data-list-id="test_languages"]').select2().val(englang).trigger('change');
      
    }

    if ($(".other_proflang").val() != "") {
      var other_proflang = JSON.parse($(".other_proflang").val());
      console.log("englang",other_proflang);
      $('.js-example-basic-multiple[data-list-id="other_test_languages"]').select2().val(other_proflang).trigger('change');
      
    }

    if ($(".specialized_lang_skills").val() != "") {
      var specialized_lang_skills = JSON.parse($(".specialized_lang_skills").val());
      console.log("specialized_lang_skills",specialized_lang_skills);
      $('.js-example-basic-multiple[data-list-id="specialized_languages"]').select2().val(specialized_lang_skills).trigger('change');
      
    }

    if ($(".mainlang").val() != "") {
      var mainlang = JSON.parse($(".mainlang").val());
      $('.js-example-basic-multiple[data-list-id="main_languages"]').select2().val(mainlang).trigger('change');
      $(".sublang_list").each(function(){
        var val = $(this).val();
        console.log("sublang",$(".sublang-"+val).val());
        if ($(".sublang-"+val).val() != undefined) {
          var sublang = JSON.parse($(".sublang-"+val).val());
          console.log("sublang",sublang);
          $('.js-example-basic-multiple[data-list-id="sub_lang_dropdown-'+val+'"]').select2().val(sublang).trigger('change');
        }
      });
    }

    var selectedFiles1 = [];

    function changeEvidenceImg(user_id,language_id,name_arr) {
    
      if (!selectedFiles1[language_id]) {
        selectedFiles1[language_id] = [];
      }


      const newFiles = Array.from($('.upload_evidence-'+language_id)[0].files);

      newFiles.forEach(file => {
        const exists = selectedFiles1[language_id].some(f => f.name === file.name && f.lastModified === file.lastModified);
        if (!exists) {
            selectedFiles1[language_id].push(file);
        }
    });

        console.log("selectedFiles",selectedFiles1[language_id]);
      var form_data = "";
      form_data = new FormData();

      for (var i = 0; i < selectedFiles1[language_id].length; i++) {
        form_data.append(name_arr+"["+language_id+"][]", selectedFiles1[language_id][i], selectedFiles1[language_id][i]['name']);
      }

      form_data.append("user_id", user_id);
      form_data.append("language_id", language_id);
      form_data.append("img_field", name_arr);
      form_data.append("_token", '{{ csrf_token() }}');
      
      $.ajax({
        type: "post",
        url: "{{ route('nurse.uploadlangEvidenceImgs') }}",
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        data: form_data,

        success: function(data) {
          $("."+name_arr+"-"+language_id).val(data);
          var image_array = JSON.parse(data);
          console.log("evidence_imgs", image_array.length);
          var htmlData = '';
          for (var i = 0; i < image_array.length; i++) {
            //console.log("degree_transcript", image_array[i]);
            var img_name = image_array[i];
            console.log("img_name", 'deleteImg(' + (i + 1) + ',' + user_id + ',"' + img_name + '")');
            htmlData += '<div class="trans_img trans_img-' + (i + 1) + '"><a href="{{ url("/public") }}/uploads/education_degree/' + img_name + '" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>' + image_array[i] + '</a><div class="close_btn close_btn-' + i + '" onclick="deletelangEvidenceImg(' + (i + 1) + ',' + user_id + ',\'' + img_name + '\','+language_id+'\,\''+name_arr+'\')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div></div>';
          }
          $(".lang_evidence-"+language_id).html(htmlData);
        }
      });
    }

    function deletelangEvidenceImg(i, user_id, img,language_id,name_arr) {
      $.ajax({
        type: "post",
        url: "{{ route('nurse.deletelangEvidenceImg') }}",
        data: {
          user_id: user_id,
          img: img,
          language_id: language_id,
          img_field: name_arr,
          _token: '{{ csrf_token() }}'
        },
        cache: false,
        success: function(data) {
          if (data == 1) {
            var old_files = JSON.parse($("."+name_arr+"-"+language_id).val());
            console.log("old_files",old_files);
            const itemToRemove = img;

            const result = old_files.filter(item => item !== itemToRemove);

            console.log(result); // [1, 2, 4, 5]
            $("."+name_arr+"-"+language_id).val(JSON.stringify(result));
            $(".lang_evidence-"+language_id+" .trans_img-" + i).remove();
          }
        }
      });
    }

    

    $('.js-example-basic-multiple[data-list-id="main_languages"]').on('change', function() {
        let selectedValues = $(this).val();
        console.log("selectedValues",selectedValues);

        $(".sub_languages_div .sublang_list").each(function(i,val){
            var val1 = $(val).val();
            console.log("val",val1);
            if(selectedValues.includes(val1) == false){
              $(".sublang_main_div-"+val1).remove();
                
                
            }
        });

        for(var i=0;i<selectedValues.length;i++){
            if($(".sub_languages_div .sub_lang_div-"+selectedValues[i]).length < 1){
                $.ajax({
                    type: "GET",
                    url: "{{ url('/nurse/getLanguagesData') }}",
                    data: {language_id:selectedValues[i]},
                    cache: false,
                    success: function(data){
                        var data1 = JSON.parse(data);
                        console.log("data",data1.main_language_data.language_field);
                        if(data1.main_language_data.language_field == "text"){
                            var ap = '';
                            $(".sub_languages_div").append('\<div class="sublang_main_div sublang_main_div-'+data1.main_language_data.language_id+'">\
                            <div class="sub_lang_div sub_lang_div-'+data1.main_language_data.language_id+' form-group level-drp">\
                            <label class="form-label sub_lang_label sub_lang_label-'+data1.main_language_data.language_id+'" for="input-1">'+data1.main_language_data.language_name+'</label>\
                            <input type="hidden" name="sublang_list" class="sublang_list sublang_list-'+data1.main_language_data.language_id+'" value="'+data1.main_language_data.language_id+'">\
                            <input type="text" name="sub_languages[]" class="form-control fixed_salary_amount sub_lang_valid-'+data1.main_language_data.language_id+'" onkeyup="getProficiency_text(\''+ap+'\',\''+data1.main_language_data.language_id+'\')" value="">\
                            <span id="reqsublangvalid-'+data1.main_language_data.language_id+'" class="reqError text-danger valley"></span>\
                            </div>\
                            <div class="lang_proficiency_level-'+data1.main_language_data.language_id+'"></div>\
                            </div>');
                        }else{
                          if(data1.main_language_data.language_field == "dropdown"){
                            var sublang_text = "";
                            for(var j=0;j<data1.language_data.length;j++){
                            
                                sublang_text += "<li data-value='"+data1.language_data[j].language_id+"'>"+data1.language_data[j].language_name+"</li>"; 
                            
                            }
                            var ap = '';
                            $(".sub_languages_div").append('\<div class="sublang_main_div sublang_main_div-'+data1.main_language_data.language_id+'">\
                              <div class="sub_lang_div sub_lang_div-'+data1.main_language_data.language_id+' form-group level-drp">\
                                <label class="form-label sub_lang_label sub_lang_label-'+data1.main_language_data.language_id+'" for="input-1">'+data1.main_language_data.language_name+'</label>\
                                <input type="hidden" name="sublang_list" class="sublang_list sublang_list-'+data1.main_language_data.language_id+'" value="'+data1.main_language_data.language_id+'">\
                                <ul id="sub_lang_dropdown-'+data1.main_language_data.language_id+'" style="display:none;">'+sublang_text+'</ul>\
                                <select class="js-example-basic-multiple'+data1.main_language_data.language_id+' sub_lang_valid-'+data1.main_language_data.language_id+' addAll_removeAll_btn" data-list-id="sub_lang_dropdown-'+data1.main_language_data.language_id+'" name="sub_languages[]" onchange="getProficiency(\''+ap+'\',\''+data1.main_language_data.language_id+'\')" multiple="multiple"></select>\
                                <span id="reqsublangvalid-'+data1.main_language_data.language_id+'" class="reqError text-danger valley"></span>\
                              </div>\
                              <div class="lang_proficiency_level-'+data1.main_language_data.language_id+'"></div>\
                              </div>\
                            ');

                            
                            selectTwoFunction(data1.main_language_data.language_id);
                          }
                            
                        }
                        let $fields = $(".sub_languages_div .sublang_main_div");

                        let sortedFields = $fields.sort(function (a, b) {
                            return $(a).find(".sub_lang_label").text().localeCompare($(b).find(".sub_lang_label").text());
                        });
                        console.log("sortedFields",sortedFields);
                        $(".sub_languages_div").append(sortedFields);
                    }
                });
            }
        }
        
    });

    function getProficiency_text(ap,language_id){
      var val = $(".sub_lang_valid-"+language_id).val();
      
      if($(".lang_proficiency_level-"+language_id+" .sublangprofdiv-"+language_id).length < 1){
          $.ajax({
            type: "GET",
            url: "{{ url('/nurse/getSubLanguagesData') }}",
            data: {language_id:language_id},
            cache: false,
            success: function(data){
              var data1 = JSON.parse(data);
              console.log("data",data1.sub_language_data.language_name);

              $(".lang_proficiency_level-"+language_id).append('<div class="custom-select-wrapper sublangprofdiv sublangprofdiv-'+language_id+' form-group level-drp" style="margin-bottom: 5px;">\
                  <label class="form-label subproflabel-'+language_id+'" for="input-1">Proficiency Level ('+data1.sub_language_data.language_name+')</label>\
                  <input type="hidden" name="sublangprof_list" class="sublangprof_list sublangprof_list-'+language_id+'" value="'+language_id+'">\
                  <select class="custom-select form-input mr-10 select-active langprof_level_valid-'+language_id+'" name="langprof_level['+language_id+']['+val+']">\
                    <option value="">select</option>\
                    <option value="Basic">Basic</option>\
                    <option value="Conversational">Conversational</option>\
                    <option value="Fluent">Fluent</option>\
                    <option value="Native">Native</option>\
                  </select>\
                  </div>\
                  <span id="reqproflevelvalid-'+language_id+'" class="reqError text-danger valley"></span>\
                  ');
            }
          });  
        }
    }

    function getProficiency(ap,language_id){
      
      if(ap == 'ap'){
          var selectedValues = $('.js-example-basic-multiple[data-list-id="sub_lang_dropdown-'+language_id+'"]').val();
      }else{
        var selectedValues = $('.js-example-basic-multiple'+language_id+'[data-list-id="sub_lang_dropdown-'+language_id+'"]').val();  
      }

      console.log("selectedValues",selectedValues);
      
      $(".lang_proficiency_level-"+language_id+" .sublangprof_list").each(function(i,val){
          var val1 = $(val).val();
          console.log("val",val1);
          if(selectedValues.includes(val1) == false){
              $(".sublangprofdiv-"+val1).remove();
          }
      });

      for(var i=0;i<selectedValues.length;i++){
        if($(".lang_proficiency_level-"+language_id+" .sublangprofdiv-"+selectedValues[i]).length < 1){
          $.ajax({
            type: "GET",
            url: "{{ url('/nurse/getSubLanguagesData') }}",
            data: {language_id:selectedValues[i]},
            cache: false,
            success: function(data){
              var data1 = JSON.parse(data);
              console.log("data",data1.sub_language_data.language_name);

              $(".lang_proficiency_level-"+language_id).append('<div class="custom-select-wrapper sublangprofdiv sublangprofdiv-'+data1.sub_language_data.language_id+' form-group level-drp" style="margin-bottom: 5px;">\
                  <label class="form-label subproflabel-'+data1.sub_language_data.language_id+'" for="input-1">Proficiency Level ('+data1.sub_language_data.language_name+')</label>\
                  <input type="hidden" name="sublangprof_list" class="sublangprof_list sublangprof_list-'+data1.sub_language_data.language_id+'" value="'+data1.sub_language_data.language_id+'">\
                  <select class="custom-select form-input mr-10 select-active langprof_level_valid-'+data1.sub_language_data.language_id+'" name="langprof_level['+language_id+']['+data1.sub_language_data.language_id+']">\
                    <option value="">select</option>\
                    <option value="Basic">Basic</option>\
                    <option value="Conversational">Conversational</option>\
                    <option value="Fluent">Fluent</option>\
                    <option value="Native">Native</option>\
                  </select>\
                  </div>\
                  <span id="reqproflevelvalid-'+data1.sub_language_data.language_id+'" class="reqError text-danger valley"></span>\
                  ');
            }
          });  
        }
                        
        
                        
      }

    }

    $('.js-example-basic-multiple[data-list-id="test_languages"]').on('change', function() {
        let selectedValues = $(this).val();
        console.log("selectedValues",selectedValues);

        $(".tests_div .engprof_list").each(function(i,val){
          var val1 = $(val).val();
          console.log("val",val1);
          if(selectedValues.includes(val1) == false){
              $(".test_level_div-"+val1).remove();
          }
        });

        for(var i=0;i<selectedValues.length;i++){
          if($(".tests_div .test_level_div-"+selectedValues[i]).length < 1){
            $.ajax({
              type: "GET",
              url: "{{ url('/nurse/getTestLanguagesData') }}",
              data: {language_id:selectedValues[i]},
              cache: false,
              success: function(data){
                var data1 = JSON.parse(data);
                console.log("data",data1.test_language_data.language_name);
                var user_id = "<?php echo Auth::guard('nurse_middle')->user()->id; ?>";
                var eng_prof = "english_prof_cert";
                $(".tests_div").append('\<div class="test_level_div test_level_div-'+data1.language_id+'">\
                  <div class="strong_text inslabtext"><strong>'+data1.test_language_data.language_name+'</strong></div>\
                  <input type="hidden" name="engprof_list" class="engprof_list engprof_list-'+data1.language_id+'" value="'+data1.language_id+'">\
                  <div class="form-group level-drp">\
                    <label class="form-label" for="input-1">Score / Level Obtained</label>\
                    <input type="text" name="english_prof_cert['+data1.language_id+'][score_level]" class="form-control fixed_salary_amount testscore_level_valid-'+data1.language_id+'" value="">\
                    <span id="reqtestscore_level-'+data1.language_id+'" class="reqError text-danger valley"></span>\
                  </div>\
                  <div class="form-group level-drp">\
                    <label class="form-label" for="input-1">Expiring date</label>\
                    <input type="date" name="english_prof_cert['+data1.language_id+'][expiring_date]" class="form-control fixed_salary_amount testexpiring_date_valid-'+data1.language_id+'" value="">\
                    <span id="reqtestexpiring_date-'+data1.language_id+'" class="reqError text-danger valley"></span>\
                  </div>\
                  <div class="form-group level-drp">\
                    <label class="form-label" for="input-1">Upload Evidence</label>\
                    <input type="hidden" name="english_prof_cert['+data1.language_id+'][evidence_imgs]" class="english_prof_cert-'+data1.language_id+'">\
                    <input class="form-control upload_evidence upload_evidence-'+data1.language_id+'" type="file" name="" onchange="changeEvidenceImg(\''+user_id+'\',\''+data1.language_id+'\',\''+eng_prof+'\')" multiple="">\
                    <span id="requploadevidence-'+data1.language_id+'" class="reqError text-danger valley"></span>\
                    <div class="lang_evidence-'+data1.language_id+'"></div>\
                  </div>\
                </div>');

                let $fields = $(".tests_div .test_level_div");

                let sortedFields = $fields.sort(function (a, b) {
                    return $(a).find(".inslabtext strong").text().localeCompare($(b).find(".inslabtext strong").text());
                });
                console.log("sortedFields",sortedFields);
                $(".tests_div").append(sortedFields);
              }
           });    
          }
         
        }

    });    

    $('.js-example-basic-multiple[data-list-id="other_test_languages"]').on('change', function() {
        let selectedValues = $(this).val();
        console.log("selectedValues",selectedValues);

        $(".other_tests_div .otherengprof_list").each(function(i,val){
          var val1 = $(val).val();
          console.log("val",val1);
          if(selectedValues.includes(val1) == false){
              $(".othertest_level_div-"+val1).remove();
          }
        });

        for(var i=0;i<selectedValues.length;i++){
          if($(".other_tests_div .othertest_level_div-"+selectedValues[i]).length < 1){
            
            $.ajax({
              type: "GET",
              url: "{{ url('/nurse/getTestLanguagesData') }}",
              data: {language_id:selectedValues[i]},
              cache: false,
              success: function(data){
                var data1 = JSON.parse(data);
                console.log("data",data1.test_language_data.language_name);
                var user_id = "<?php echo Auth::guard('nurse_middle')->user()->id; ?>";
                var eng_prof = "other_prof_cert";
                $(".other_tests_div").append('\<div class="othertest_level_div othertest_level_div-'+data1.language_id+'">\
                  <div class="strong_text inslabtext"><strong>'+data1.test_language_data.language_name+'</strong></div>\
                  <input type="hidden" name="otherengprof_list" class="otherengprof_list otherengprof_list-'+data1.language_id+'" value="'+data1.language_id+'">\
                  <div class="form-group level-drp">\
                    <label class="form-label" for="input-1">Score / Level Obtained</label>\
                    <input type="text" name="otherlangprof['+data1.language_id+'][score_level]" class="form-control fixed_salary_amount otherscore_level_valid-'+data1.language_id+'" value="">\
                    <span id="reqotherscore_level-'+data1.language_id+'" class="reqError text-danger valley"></span>\
                  </div>\
                  <div class="form-group level-drp">\
                    <label class="form-label" for="input-1">Expiring date</label>\
                    <input type="date" name="otherlangprof['+data1.language_id+'][expiring_date]" class="form-control fixed_salary_amount otherexpiring_date_valid-'+data1.language_id+'" value="">\
                    <span id="reqotherexpiring_date-'+data1.language_id+'" class="reqError text-danger valley"></span>\
                  </div>\
                  <div class="form-group level-drp">\
                    <label class="form-label" for="input-1">Upload Evidence</label>\
                    <input type="hidden" name="otherlangprof['+data1.language_id+'][evidence_imgs]" class="other_prof_cert-'+data1.language_id+'" value="">\
                    <input class="form-control upload_evidence upload_evidence-'+data1.language_id+'" type="file" name="otherlangprof['+data1.language_id+'][engevimg]" onchange="changeEvidenceImg(\''+user_id+'\',\''+data1.language_id+'\',\''+eng_prof+'\')" multiple="">\
                    <span id="requploadevidence-'+data1.language_id+'" class="reqError text-danger valley"></span>\
                    <div class="lang_evidence-'+data1.language_id+'"></div>\
                  </div>\
                </div>');

                let $fields = $(".other_tests_div .othertest_level_div");

                let sortedFields = $fields.sort(function (a, b) {
                    return $(a).find(".inslabtext strong").text().localeCompare($(b).find(".inslabtext strong").text());
                });
                console.log("sortedFields",sortedFields);
                $(".other_tests_div").append(sortedFields);
              }
           });    
          }
         
        }

    });    

    $('.js-example-basic-multiple[data-list-id="specialized_languages"]').on('change', function() {
        let selectedValues = $(this).val();
        console.log("selectedValues",selectedValues);

        $(".specialized_languages_div .specialized_level_list").each(function(i,val){
          var val1 = $(val).val();
          console.log("val",val1);
          if(selectedValues.includes(val1) == false){
              $(".specialized_level_div-"+val1).remove();
          }
        });

        for(var i=0;i<selectedValues.length;i++){
          if($(".specialized_languages_div .specialized_level_div-"+selectedValues[i]).length < 1){
            $.ajax({
              type: "GET",
              url: "{{ url('/nurse/getTestLanguagesData') }}",
              data: {language_id:selectedValues[i]},
              cache: false,
              success: function(data){
                var data1 = JSON.parse(data);
                console.log("data",data1.test_language_data.language_name);
                var user_id = "<?php echo Auth::guard('nurse_middle')->user()->id; ?>";
                var eng_prof = "specialized_lang_skills";
                $(".specialized_languages_div").append('\<div class="specialized_level_div specialized_level_div-'+data1.language_id+'">\
                  <div class="strong_text inslabtext"><strong>'+data1.test_language_data.language_name+'</strong></div>\
                  <input type="hidden" name="specialized_level_list" class="specialized_level_list specialized_level_list-'+data1.language_id+'" value="'+data1.language_id+'">\
                  <div class="form-group level-drp">\
                    <label class="form-label" for="input-1">Upload Evidence</label>\
                    <input type="hidden" name="specialized_lang_skills['+data1.language_id+'][evidence_imgs]" class="specialized_lang_skills-'+data1.language_id+'" value="">\
                    <input class="form-control upload_evidence upload_evidence-'+data1.language_id+'" type="file" name="" onchange="changeEvidenceImg(\''+user_id+'\',\''+data1.language_id+'\',\''+eng_prof+'\')" multiple="">\
                    <div class="lang_evidence-'+data1.language_id+'"></div>\
                  </div>\
                </div>');

                let $fields = $(".specialized_languages_div .specialized_level_div");

                let sortedFields = $fields.sort(function (a, b) {
                    return $(a).find(".inslabtext strong").text().localeCompare($(b).find(".inslabtext strong").text());
                });
                console.log("sortedFields",sortedFields);
                $(".specialized_languages_div").append(sortedFields);
              }
           });    
          }
        }

    });    

    function update_language_skills() {
      var isValid = true;

      if ($('[name="main_languages[]"]').val() == '') {

        document.getElementById("reqshiftlanguage").innerHTML = "* Please select the Language.";
        isValid = false;

      }

      
      $(".sublang_list").each(function() {
        var val = $(this).val();
        var label = $(".sub_lang_label-"+val).text();
        console.log("val",val);
        if ($(".sub_lang_valid-" + val).length > 0) {
          if ($(".sub_lang_valid-" + val).val() == '') {
            
            document.getElementById("reqsublangvalid-" + val).innerHTML = "* Please select the "+label;
            isValid = false;
          }
        }
      });

      $(".sublangprof_list").each(function() {
        var val = $(this).val();
        var label = $(".subproflabel-"+val).text();
        console.log("val",val);
        if ($(".langprof_level_valid-" + val).length > 0) {
          if ($(".langprof_level_valid-" + val).val() == '') {
            
            document.getElementById("reqproflevelvalid-" + val).innerHTML = "* Please select the "+label;
            isValid = false;
          }
        }
      });

      $(".engprof_list").each(function() {
        var val = $(this).val();
        
        console.log("val",val);
        if ($(".testscore_level_valid-" + val).length > 0) {
          if ($(".testscore_level_valid-" + val).val() == '') {
            
            document.getElementById("reqtestscore_level-" + val).innerHTML = "* Please select the Score / Level Obtained";
            isValid = false;
          }
        }

        if ($(".testexpiring_date_valid-" + val).length > 0) {
          if ($(".testexpiring_date_valid-" + val).val() == '') {
            
            document.getElementById("reqtestexpiring_date-" + val).innerHTML = "* Please enter the Expiring date";
            isValid = false;
          }
        }

        if ($(".upload_evidence-" + val).length > 0) {
          var upload_evidence = $.trim($(".lang_evidence-" + val).text());
          console.log("upload_evidence",$.trim($(".lang_evidence-" + val).text()));
          if (upload_evidence == '') {
            console.log("upload_evidence",val);
            document.getElementById("requploadevidence-" + val).innerHTML = "* Please add at least one evidence document";
            isValid = false;
          }
        }
        
      });

      $(".otherengprof_list").each(function() {
        var val = $(this).val();
        
        console.log("val",val);
        if ($(".otherscore_level_valid-" + val).length > 0) {
          if ($(".otherscore_level_valid-" + val).val() == '') {
            
            document.getElementById("reqotherscore_level-" + val).innerHTML = "* Please select the Score / Level Obtained";
            isValid = false;
          }
        }

        if ($(".otherexpiring_date_valid-" + val).length > 0) {
          if ($(".otherexpiring_date_valid-" + val).val() == '') {
            
            document.getElementById("reqotherexpiring_date-" + val).innerHTML = "* Please enter the Expiring date";
            isValid = false;
          }
        }

        if ($(".upload_evidence-" + val).length > 0) {
          var upload_evidence = $.trim($(".lang_evidence-" + val).text());
          console.log("upload_evidence",$.trim($(".lang_evidence-" + val).text()));
          if (upload_evidence == '') {
            console.log("upload_evidence",val);
            document.getElementById("requploadevidence-" + val).innerHTML = "* Please add at least one evidence document";
            isValid = false;
          }
        }
        
      });

      $(".specialized_level_list").each(function() {
        var val = $(this).val();
        
        console.log("val",val);
        if ($(".upload_evidence-" + val).length > 0) {
          var upload_evidence = $.trim($(".lang_evidence-" + val).text());
          console.log("upload_evidence",$.trim($(".lang_evidence-" + val).text()));
          if (upload_evidence == '') {
            console.log("upload_evidence",val);
            document.getElementById("requploadevidence-" + val).innerHTML = "* Please add at least one evidence document";
            isValid = false;
          }
        }

      });  

      // if ($('.test_languages_valid').val() == '') {

      //   document.getElementById("reqengtest").innerHTML = "* Please select the English Proficiency Tests.";
      //   isValid = false;

      // }

      // if ($('.other_languages_valid').val() == '') {

      //   document.getElementById("reqothertest").innerHTML = "* Please select the English Proficiency Tests.";
      //   isValid = false;

      // }

      // if ($('.specialized_languages_valid').val() == '') {

      //   document.getElementById("reqspecializedskills").innerHTML = "* Please select the Specialized Language Skills.";
      //   isValid = false;

      // }

      if ($(".professional_declare_information").prop('checked') == false) {
      
        document.getElementById("reqdeclare_information_profess").innerHTML = "* Please check this checkbox";
        isValid = false;
      }

      

      if (isValid == true) {
        $.ajax({
        url: "{{ route('nurse.updateLanguageSkills') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#language_skills_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitLanguageSkills').prop('disabled', true);
          $('#submitLanguageSkills').text('Process....');
        },
        success: function(res) {
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Language Skiils Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.language_skills') }}?page=language_skills";
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: res.message,
            })
          }
        },
        error: function(errorss) {
          $('#submitLanguageSkills').prop('disabled', false);
          $('#submitLanguageSkills').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitLanguageSkills").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      
        });
      }

      return false;
    }

</script>
<script>

    function printErrorMsg(msg) {
      $(".print-error-msg").find("ul").html('');
      $(".print-error-msg").css('display', 'block');
      $(".error").remove();
      $.each(msg, function(key, value) {
        $('#district_id').after('<span class="error">' + value + '</span>');
        $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
      });
    }
  </script>
  
  <script>
    jQuery(document).ready(function() {
  
      var el;
      var options;
      var canvas;
      var span;
      var ctx;
      var radius;
  
      var createCanvasVariable = function(id) { // get canvas
        el = document.getElementById(id);
      };
  
      var createAllVariables = function() {
        options = {
          percent: el.getAttribute('data-percent') || 25,
          size: el.getAttribute('data-size') || 165,
          lineWidth: el.getAttribute('data-line') || 10,
          rotate: el.getAttribute('data-rotate') || 0,
          color: el.getAttribute('data-color')
        };
  
        canvas = document.createElement('canvas');
        span = document.createElement('span');
        span.textContent = options.percent + '%';
  
        if (typeof(G_vmlCanvasManager) !== 'undefined') {
          G_vmlCanvasManager.initElement(canvas);
        }
  
        ctx = canvas.getContext('2d');
        canvas.width = canvas.height = options.size;
  
        el.appendChild(span);
        el.appendChild(canvas);
  
        ctx.translate(options.size / 2, options.size / 2); // change center
        ctx.rotate((-1 / 2 + options.rotate / 180) * Math.PI); // rotate -90 deg
  
        radius = (options.size - options.lineWidth) / 2;
      };
      var drawCircle = function(color, lineWidth, percent) {
        percent = Math.min(Math.max(0, percent || 1), 1);
        ctx.beginPath();
        ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
        ctx.strokeStyle = color;
        ctx.lineCap = 'square'; // butt, round or square
        ctx.lineWidth = lineWidth;
        ctx.stroke();
      };
      var drawNewGraph = function(id) {
        el = document.getElementById(id);
        createAllVariables();
        drawCircle('#efefef', options.lineWidth, 100 / 100);
        drawCircle(options.color, options.lineWidth, options.percent / 100);
      };
      drawNewGraph('graph1');
    });
  
  </script>
@endsection
