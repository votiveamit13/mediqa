@extends('admin.layouts.layout')
@section('content')
<style>
    span.select2.select2-container {
        padding: 5px !important;
        width: 100% !important;
    }

    .d-none {
        display: none !important;
        /* visibility: hidden !important;; */
    }


    .select2-container--default .select2-selection--multiple {
        /* background-color: white !important; */
        /* border: 1px solid #0000 !important; */
        border-radius: 4px !important;
        cursor: text !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #000 !important;
        border: 1px solid #000 !important;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide the default checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* Style for the slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 34px;
    }

    /* The circle inside the slider */
    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        border-radius: 50%;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: 0.4s;
    }

    /* When the checkbox is checked, move the slider */
    input:checked + .slider {
        background-color: black; /* Green */
    }

    /* When the checkbox is checked, move the circle */
    input:checked + .slider:before {
        transform: translateX(26px);
    }
</style>
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
            @include("admin.layouts.edit_nurse_tabs")
            <div class="tab-content border mt-2">
                <div class="tab-pane p-3 active show" id="navpill-1" role="tabpanel">
                    <div class=" w-100  overflow-hidden">
                        <div class="card-body p-3 px-md-4 pb-0">
                            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Registrations and Licences</h3>
                        </div>
                        <div class="card-body p-3 px-md-4">
                           <form id="training_form" method="POST" onsubmit="return updateMandatoryTraining()">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                            <!-- <p>Please add required courses or certifications completed for compliance or safety</p> -->
                            <h6 class="emergency_text">
                            Completed Mandatory Training
                            </h6>
                            <p>Please add required courses or certifications completed for compliance or safety</p>

                            <h6 class="emergency_text">
                            <!-- Mandatory Training -->
                            </h6>
                            <?php
                              if(!empty($trainingData)){
                                $organization_data = json_decode($trainingData->training_data);
                                
                              }else{
                                $organization_data = array(); 
                              }
                              
                              
                              $o_data = (array)$organization_data;
                              $p_memb_arr = array();

                              if(!empty($organization_data)){
                                foreach ($organization_data as $p_memb) {
                                
                                  //print_r($p_memb);
                                  $p_memb_arr[] = array_search($p_memb, (array)$organization_data);
                                  
                                }
                              }
                              

                              
                              $p_memb_json = json_encode($p_memb_arr);
                            ?>
                            <div class="form-group level-drp">
                                <input type="hidden" name="man_training" class="man_training" value="@if(!empty($trainingData)) {{ $trainingData->man_training }}@endif">

                                <label class="form-label" for="input-1">Please select all that apply</label>
                                <?php
                                $mandatory_courses = DB::table('man_training_category')->where('type', 'Training')->where('parent', 0)->get();
                                ?>
                                <input type="hidden" name="org_country" class="man_co" value='<?php echo $p_memb_json; ?>'>
                                <ul id="mandatory_courses_data" style="display:none;">
                                    @foreach($mandatory_courses as $m_courses)
                                    <li data-value="{{ $m_courses->id }}">{{ $m_courses->name }}</li>
                                    @endforeach
                                </ul>
                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="mandatory_courses_data" name="mandatory_courses[]" multiple="multiple" onchange="getSubCourses()"></select>
                                <span id="reqmantra" class="reqError text-danger valley"></span>
                            </div>
                            <div class="mandatory_sub_courses">
                              @foreach ($p_memb_arr as $p_arr)
                              <?php
                                //print_r($o_data[$p_arr]);
                                $country_name = DB::table("man_training_category")->where("id",$p_arr)->first();
                                $organization_list = DB::table("man_training_category")->where("parent",$p_arr)->orderBy('name', 'ASC')->get();
                                $os_data = (array)$o_data[$p_arr];
                                $sub_count_arr = array();
    
                                foreach ($os_data as $p_memb) {
                                  $sub_count_arr[] = array_search($p_memb, $os_data);
                                }
                                
                                
                                $p_memb_json = json_encode($sub_count_arr);
                              ?>
                              @if($p_arr != 564)
                              <div class="courses_div courses_div-{{ $p_arr }}">
                                <div class="form-group level-drp mandatory_courses_div  mandatory_tr_div_1">
                                  <input type="hidden" name="well_sel_data" class="well_sel_data" value="{{ $p_arr }}">
                                  <input type="hidden" name="country_org" class="country_org-{{ $p_arr }}" value='<?php echo $p_memb_json; ?>'>
                                  <label class="form-label courses_label courses_label-{{ $p_arr }}" for="input-1">{{ $country_name->name }}</label>
                                  <ul id="well_self_care_data-{{ $p_arr }}" style="display:none;">
                                    @if(!empty($organization_list))
                                    @foreach($organization_list as $org_list)
                                    <li data-value="{{ $org_list->id }}">{{ $org_list->name }}</li>
                                    
                                    @endforeach
                                    @endif
                                  </ul>
                                  <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="well_self_care_data-{{ $p_arr }}" name="well_self_care_data[]" onchange="showTrainingData('ap',{{ $p_arr }},'{{ $country_name->name }}')" multiple="multiple"></select>
                                  <span id="reqsubcourses-{{ $p_arr }}" class="reqError text-danger valley"></span>
                                </div>
                                <div class="well_self_care_div-{{ $p_arr }}">
                                  @foreach ($sub_count_arr as $p_arr1)
                                  <?php

                                    $country_name = DB::table("man_training_category")->where("id",$p_arr1)->first();
                                    $organization_list = DB::table("man_training_category")->where("parent",$p_arr1)->orderBy('name', 'ASC')->get();
                                    //echo $p_arr1;
                                    $oss_data = (array)$os_data[$p_arr1];
                                    //print_r($oss_data['institution']);die;
                                  ?>
                                  <div class="well_self_care_{{ $p_arr1 }}">
                                    <h6 class="coursesublabel">{{ $country_name->name }}</h6>
                                    <input type="hidden" name="well_sel_data" class="well_sel_data-{{ $p_arr }}" value="{{ $p_arr1 }}">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                        <label class="form-label" for="input-1">Institution/Regulating Body</label>
                                        <input type="hidden" name="wellnamearr[]" class="wellness_input_{{ $p_arr1 }}" value="{{ $p_arr1 }}">
                                        <input class="form-control well_institution well_institution-{{ $p_arr1 }}" type="text" name="well_institution[{{ $p_arr }}][{{ $p_arr1 }}][institution]" value="{{ $oss_data['institution'] }}">
                                        <span id="wellinstitutionvalid-{{ $p_arr1 }}" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="form-label" for="input-1">Training Start Date</label>
                                        <input class="form-control well_tra_start_date well_tra_start_date-{{ $p_arr1 }}" type="date" name="well_institution[{{ $p_arr }}][{{ $p_arr1 }}][training_start_date]" value="{{ $oss_data['training_start_date'] }}" onkeydown="return false">
                                        <span id="well_tra_start_datevalid-{{ $p_arr1 }}" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="form-label" for="input-1">Training End Date</label>
                                        <input class="form-control well_tra_end_date well_tra_end_date-{{ $p_arr1 }}" type="date" name="well_institution[{{ $p_arr }}][{{ $p_arr1 }}][training_end_date]" value="{{ $oss_data['training_end_date'] }}" onkeydown="return false">
                                        <span id="well_tra_end_datevalid-{{ $p_arr1 }}" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="form-label" for="input-1">Expiry</label>
                                        <input class="form-control well_expiry well_expiry-{{ $p_arr1 }}" type="date" name="well_institution[{{ $p_arr }}][{{ $p_arr1 }}][training_expiry_date]" value="{{ $oss_data['training_expiry_date'] }}">
                                        <span id="wellexpiryvalid-{{ $p_arr1 }}" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <?php
                                          $user_id = Auth::guard('nurse_middle')->user()->id;
                                          ?>
                                        <label class="form-label" for="input-1">Upload Certificate</label>
                                        <input type="hidden" name="well_institution[{{ $p_arr }}][{{ $p_arr1 }}][evidence_imgs]" class="well_sel_data-{{ $p_arr1 }}" value="@if(isset($oss_data['evidence_imgs'])){{ $oss_data['evidence_imgs'] }}@endif">
                                        <input class="form-control upload_evidence upload_evidence-{{ $p_arr1 }} well_upload_certification well_imgs_{{ $p_arr1 }} well_upload_certification-{{ $p_arr1 }}" type="file" name="" onchange="changeEvidenceImg({{ $user_id }},{{ $p_arr }},{{ $p_arr1 }},'well_sel_data')" multiple>
                                        <span id="reqwelluploadvalid-" class="reqError text-danger valley"></span>
                                        <div class="lang_evidence-{{ $p_arr1 }}">
                                          <?php
                                            if(isset($oss_data['evidence_imgs'])){
                                              $evidence_imgs = (array)json_decode($oss_data['evidence_imgs']);
                                              //$evorgimg = $evidence_imgs[$p_arr2];
                                              //print_r($evidence_imgs);
                                              $i = 0;
                                              ?>
                                              @if(!empty($evidence_imgs))
                                              @foreach ($evidence_imgs as $ev_img)
                                              <div class="trans_img trans_img-{{ $i+1 }}">
                                                <a href=""><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                                <div class="close_btn close_btn-' + i + '" onclick="deleteTrainingEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}',{{ $p_arr }},{{ $p_arr1 }},'well_sel_data')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
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
                                    
                                    </div>
                                  @endforeach
                                </div>
                              </div>
                              @endif
                              @endforeach
                            </div>
                            <div class="another_com_training">
                                <h6 class="emergency_text mt-2">Other Trainings
                                </h6>
                                <?php
                                if (!empty($trainingData)) {
                                  $additional_tra_data = json_decode($trainingData->other_tra_data);
                                } else {
                                  $additional_tra_data = "";
                                }
                                $i = 1;
                                $l = 0;
                                ?>
          
                                @if(!empty($additional_tra_data))
                                @foreach($additional_tra_data as $a_data)
                                <div class="training_div training_div_{{ $i }} row another_com_tra_div">
                                  <div class="form-group col-md-6">
                                    <label class="form-label training_div_count" for="input-1">Training {{ $i }}</label>
                                    <input class="form-control additional_tra_field additional_tra_field-{{ $i }}" type="text" name="training[]" value="@if(!empty($trainingData)){{ $a_data->training_name }}@endif">
                                    <span id="reqtraname-{{ $i }}" class="reqError text-danger valley"></span>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label class="form-label" for="input-1">Institution/Regulating Body</label>
                                    <input class="form-control institution institution--{{ $i }}" type="text" name="institution[]" value="@if(!empty($trainingData)){{ $a_data->training_ins }}@endif">
                                    <span id="reqinstitution-{{ $i }}" class="reqError text-danger valley"></span>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label class="form-label" for="input-1">Training Start Date</label>
                                    <input class="form-control tra_start_date tra_start_date-1" type="date" name="tra_start_date[]" value="@if(!empty($trainingData)){{ $a_data->training_end_date }}@endif" onkeydown="return false">
                                    <span id="reqtrastartdate-{{ $i }}" class="reqError text-danger valley"></span>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label class="form-label" for="input-1">Training End Date</label>
                                    <input class="form-control tra_end_date tra_end_date-{{ $i }}" type="date" name="tra_end_date[]" value="@if(!empty($trainingData)){{ $a_data->training_start_date }}@endif" onkeydown="return false">
                                    <span id="reqtraenddate-{{ $i }}" class="reqError text-danger valley"></span>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label class="form-label" for="input-1">Expiry</label>
                                    <input class="form-control tra_expiry tra_expiry-{{ $i }}" type="date" name="tra_expiry[]" value="@if(!empty($trainingData)){{$a_data->tra_exp}}@endif">
                                    <span id="reqtraenddate-{{ $i }}" class="reqError text-danger valley"></span>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                    <input class="form-control other_tran_img_tran_{{ $i }} additional_certifications-{{ $i }}" type="file" name="certificate_upload_certification[]" onchange="changeAnoImg('{{ $user_id }}','{{ $l }}','other_tran_img','tran_{{ $i}}')" multiple="">
                                    <?php
                                    $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();
          
                                    if (!empty($getedufieldsdata)) {
                                      $other_tra_img = (array)json_decode($getedufieldsdata->other_tran_img);
                                    } else {
                                      $other_tra_img = '';
                                    }
          
          
                                    if (!empty($other_tra_img)) {
                                      $other_tra_img_data = json_decode($other_tra_img["tran_$i"]);
                                    } else {
                                      $other_tra_img_data = "";
                                    }
                                    //print_r($acls_img[$acls_first_word_one]);
          
          
                                    //print_r($dtran_img);
          
                                    $user_id = Auth::guard('nurse_middle')->user()->id;
                                    ?>
                                    <div class="other_tran_imgtran_{{ $i }}">
                                      @if(!empty($other_tra_img_data))
                                      @foreach($other_tra_img_data as $other_img)
                                      <div class="trans_img edu_img-{{ $i }} edu_imgother_tran_imgtran_{{ $l }}">
                                        <a href="{{ url('/public/uploads/education_degree') }}/{{ $other_img }}"><i class="fa fa-file"></i>{{ $other_img }}</a>
                                        <div class="close_btn close_btn-{{ $i }}" onclick="deleteanoImg1('{{ $l }}','{{ $user_id }}','{{ $other_img }}','tran_{{$i  }}','other_tran_img')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                      </div>
                                      <?php
                                      $l++;
                                      ?>
                                      @endforeach
                                      @endif
                                    </div>
                                  </div>
                                  <?php
                                  $user_id = Auth::guard('nurse_middle')->user()->id;
                                  ?>
                                  <div class="col-md-12">
                                    <div class="add_new_cmp_training_div mb-3 mt-3"><a style="cursor: pointer;" class="delete_other_training" data-index="{{ $a_data->other_tra_id }}">- Delete Training</a></div>
                                  </div>
                                </div>
                                <?php
                                $i++;
                                ?>
                                @endforeach
          
                                @endif
                              </div>
                              <div class="add_new_cmp_training_div  mt-3" style="margin-bottom: 3rem !important;margin-top: 2rem !important;">
                                <a style="cursor: pointer;" onclick="add_listtraining()">+ Add another Completed Training</a>
                              </div>
                               <h6 class="mt-2">Mandatory Continuing Education</h6>
                                <p>Continuing Professional Development (CPD) for Australian nurses and midwives involves annual training that covers ethics, infection control, and clinical skills updates</p>
                                
                                <div class="form-group level-drp">
                                    <input type="hidden" name="man_education" class="man_education" value="@if(!empty($trainingData)) {{ $trainingData->man_education }}@endif">
                                    <p>Please add required ongoing education to stay updated in your field and maintain licensure</p>
                                    <label class="form-label" for="input-1">Please select all that apply</label>
                                    <?php
                                    $mandatory_courses = DB::table('man_training_category')->where('type', 'Education')->where('parent', 0)->orderBy('id', 'desc')->get();
                                    
                                    if(!empty($trainingData)){
                                      $organization_data = json_decode($trainingData->education_data);
                                      
                                    }else{
                                      $organization_data = array(); 
                                    }
                                    
                                    
                                    $o_data = (array)$organization_data;
                                    $p_memb_arr = array();

                                    if(!empty($organization_data)){
                                      foreach ($organization_data as $p_memb) {
                                      
                                        //print_r($p_memb);
                                        $p_memb_arr[] = array_search($p_memb, (array)$organization_data);
                                        
                                      }
                                    }
                                    
                                    //print_r($trainingData);
                                    
                                    $p_memb_json = json_encode($p_memb_arr);
                                    
                                    ?>
                                    <input type="hidden" name="org_country1" class="man_ed" value='<?php echo $p_memb_json; ?>'>
                                    <ul id="mandatory_education1" style="display:none;">
                                        @foreach($mandatory_courses as $m_courses)
                                        <li data-value="{{ $m_courses->id }}">{{ $m_courses->name }}</li>
                                        @endforeach
                                    </ul>
                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="mandatory_education1" name="mandatory_education[]" onchange="subEducation()" multiple="multiple"></select>
                                    <span id="reqmanedu" class="reqError text-danger valley"></span>
                                </div>
                                <div class="mandatory_sub_education">
                                  @foreach ($p_memb_arr as $p_arr)
                                  <?php
                                    //print_r($o_data[$p_arr]);
                                    $country_name = DB::table("man_training_category")->where("id",$p_arr)->first();
                                    $organization_list = DB::table("man_training_category")->where("parent",$p_arr)->orderBy('name', 'ASC')->get();
                                    $os_data = (array)$o_data[$p_arr];
                                    $sub_count_arr = array();

                                    foreach ($os_data as $p_memb) {
                                      $sub_count_arr[] = array_search($p_memb, $os_data);
                                    }
                                    
                                    
                                    $p_memb_json = json_encode($sub_count_arr);
                                  ?>
                                  <div class="education_course_div education_course_div-{{ $p_arr }}"><div class="form-group level-drp mandatory_edu_div">
                                    <input type="hidden" name="cli_data" class="cli_data" value="{{ $p_arr }}">
                                    <input type="hidden" name="country_org" class="country_org-{{ $p_arr }}" value='<?php echo $p_memb_json; ?>'>
                                    <label class="form-label education_label" for="input-1">{{ $country_name->name }}</label>
                                    <ul id="core_man_con_data-{{ $p_arr }}" style="display:none;">
                                      @if(!empty($organization_list))
                                      @foreach($organization_list as $org_list)
                                      <li data-value="{{ $org_list->id }}">{{ $org_list->name }}</li>
                                      
                                      @endforeach
                                      @endif
                                    </ul>
                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="core_man_con_data-{{ $p_arr }}" name="core_man_con_data[]" onchange="getEducationData('ap',{{ $p_arr }})" multiple="multiple"></select>
                                  </div>
                                  <div class="core_man_con_data_div-{{ $p_arr }}">
                                    @foreach ($sub_count_arr as $p_arr1)
                                  <?php
                                    //print_r($o_data[$p_arr]);
                                    $country_name = DB::table("man_training_category")->where("id",$p_arr1)->first();
                                    
                                  ?>

                                   
                                    <div class="core_man_div core_man_{{ $p_arr1 }}">
                                      <h6 class="education_courses_label">{{ $country_name->name }}</h6>
                                      <div class="core_man_div row core_man_institution">
                                        <div class="form-group col-md-12">
                                          <label class="form-label" for="input-1">Institution/Regulating Body</label>
                                          <input type="hidden" name="cli_data" class="cli_data-{{ $p_arr }}" value="{{ $p_arr1 }}">
                                          <input class="form-control core_man_institution core_man_institution-{{ $p_arr1 }}" type="text" name="core_man_institution[{{ $p_arr }}][{{ $p_arr1 }}][institution]" value="@if(!empty($os_data)){{ $os_data[$p_arr1]->institution }}@endif">
                                          <span id="coreinstitutionvalid-{{ $p_arr1 }}" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label class="form-label" for="input-1">Start Date</label>
                                          <input class="form-control coreman_start_date coreman_start_date-{{ $p_arr1 }}" type="date" name="core_man_institution[{{ $p_arr }}][{{ $p_arr1 }}][start_date]" value="@if(!empty($os_data)){{ $os_data[$p_arr1]->start_date }}@endif">
                                          <span id="coreman_start_datevalid-{{ $p_arr1 }}" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label class="form-label" for="input-1">End Date</label>
                                          <input class="form-control coreman_end_date coreman_end_date-{{ $p_arr1 }}" type="date" name="core_man_institution[{{ $p_arr }}][{{ $p_arr1 }}][end_date]" value="@if(!empty($os_data)){{ $os_data[$p_arr1]->end_date }}@endif">
                                          <span id="coreman_end_datevalid-{{ $p_arr1 }}" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label class="form-label" for="input-1">Status</label>
                                          <select class="form-control coreman_status coreman_status-{{ $p_arr1 }}" name="core_man_institution[{{ $p_arr }}][{{ $p_arr1 }}][status]">
                                            <option value="">select</option>
                                            <option value="Completed" @if(!empty($os_data) && $os_data[$p_arr1]->status == "Completed") selected @endif>Completed</option>
                                            <option value="Ongoing" @if(!empty($os_data) && $os_data[$p_arr1]->status == "Ongoing") selected @endif>Ongoing</option>
                                            <option value="Pending" @if(!empty($os_data) && $os_data[$p_arr1]->status == "Pending") selected @endif>Pending</option>
                                          </select>
                                          <span id="coreman_statusvalid-{{ $p_arr1 }}" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label class="form-label" for="input-1">Expiry</label>
                                          <input class="form-control core_man_expiry core_man_expiry-{{ $p_arr1 }}" type="date" name="core_man_institution[{{ $p_arr }}][{{ $p_arr1 }}][expiry_date]" value="@if(!empty($os_data)){{ $os_data[$p_arr1]->expiry_date }}@endif">
                                          <span id="coremanexpiryvalid-{{ $p_arr1 }}" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="form-group col-md-12">
                                          <label class="form-label" for="input-1">Upload Certificate</label>
                                          <input class="form-control upload_evidence upload_evidence-{{ $p_arr1 }} coreman_upload_certification core_man_imgs_{{ $p_arr1 }} coreman_upload_certification-{{ $p_arr1 }}" type="file" name="core_man_institution[{{ $p_arr }}][{{ $p_arr1 }}][documents][]" onchange="changeEvidenceImg({{ $user_id }},{{ $p_arr }},{{ $p_arr1 }},'core_man_data')" multiple>
                                          <div class="lang_evidence-{{ $p_arr1 }}">
                                            <?php
                                              if(isset($os_data['evidence_imgs'])){
                                                $evidence_imgs = (array)json_decode($os_data['evidence_imgs']);
                                                //$evorgimg = $evidence_imgs[$p_arr2];
                                                //print_r($evidence_imgs);
                                                $i = 0;
                                                ?>
                                                @if(!empty($evidence_imgs))
                                                @foreach ($evidence_imgs as $ev_img)
                                                <div class="trans_img trans_img-{{ $i+1 }}">
                                                  <a href=""><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                                  <div class="close_btn close_btn-' + i + '" onclick="deleteTrainingEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}',{{ $p_arr }},{{ $p_arr1 }},'well_sel_data')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
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
                                    </div>
                                    @endforeach
                                  </div>
                                  </div>
                                  @endforeach
                                </div>
                                <div class="another_education">
                                    <h6 class="emergency_text mt-2">Other Continuing Education
                                    </h6>
                                    <?php
                                    if (!empty($trainingData)) {
                                      $additional_edu_data = json_decode($trainingData->other_edu_data);
                                    } else {
                                      $additional_edu_data = "";
                                    }
                                    $i = 1;
                                    $l = 0;
                                    
                                    ?>
              
                                    @if(!empty($additional_edu_data))
                                    
                                    @foreach($additional_edu_data as $edu_data)
                                    <div class="eductiondiv eduction_div_{{ $i }} row another_edu_div">
                                      <div class="form-group col-md-6">
                                        <label class="form-label training_education_label" for="input-1">Course/Workshop {{ $i }}</label>
                                        <input class="form-control additional_course_field additional_course_field-{{ $i }}" type="text" name="education[]" value="@if(!empty($trainingData)){{ $edu_data->education_name }}@endif">
                                        <span id="reqeduname-{{ $i }}" class="reqError text-danger valley"></span>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label class="form-label" for="input-1">Institution/Regulating Body</label>
                                        <input class="form-control institution institution--{{ $i }}" type="text" name="institution[]" value="@if(!empty($trainingData)){{ $edu_data->education_ins }}@endif">
                                        <span id="reqinstitution-{{ $i }}" class="reqError text-danger valley"></span>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label class="form-label" for="input-1">Start Date</label>
                                        <input class="form-control start_date start_date-1" type="date" name="start_date[]" value="@if(!empty($trainingData)){{ $edu_data->education_start_date }}@endif" onkeydown="return false">
                                        <span id="reqstartdate--{{ $i }}" class="reqError text-danger valley"></span>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label class="form-label" for="input-1">End Date</label>
                                        <input class="form-control end_date end_date-{{ $i }}" type="date" name="end_date[]" value="@if(!empty($trainingData)){{ $edu_data->education_end_date }}@endif" onkeydown="return false">
                                        <span id="reqenddate-{{ $i }}" class="reqError text-danger valley"></span>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label class="form-label" for="input-{{ $i }}">Status</label>
                                        <select class="form-control edu_status edu_status-{{ $i }}" name="edu_status[]">
                                          <option value="Completed" @if($edu_data->education_status == 'Completed')selected @endif>Completed</option>
                                          <option value="Ongoing" @if($edu_data->education_status == 'Ongoing') selected @endif>Ongoing</option>
                                          <option value="Pending" @if($edu_data->education_status == 'Pending') selected @endif>Pending</option>
                                        </select>
                                        <span id="edu_statusvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label class="form-label" for="input-1">Expiry</label>
                                        <input class="form-control edu_expiry edu_expiry-{{ $i }}" type="date" name="edu_expiry[]" value="@if(!empty($trainingData)){{$edu_data->education_exp}}@endif" onkeydown="return false">
                                        <span id="reqedu_expiry{{ $i }}" class="reqError text-danger valley"></span>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                        <input class="form-control ano_education_imgs_edu_{{ $i }} additional_cour_certifications-{{ $i }}" type="file" name="cour_certificate_upload_certification[]" onchange="changeAnoImg('{{ $user_id }}','{{ $i }}','ano_education_imgs','edu_{{ $i}}')" multiple="">
                                        <?php
                                        $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();
              
                                        if (!empty($getedufieldsdata)) {
                                          $ano_education_img = (array)json_decode($getedufieldsdata->ano_education_imgs);
                                        } else {
                                          $ano_education_img = '';
                                        }
              
              
                                        if (!empty($ano_education_img)) {
                                          $ano_education_img_data = json_decode($ano_education_img["edu_$i"]);
                                        } else {
                                          $ano_education_img_data = "";
                                        }
                                        //print_r($acls_img[$acls_first_word_one]);
              
                                        //print_r($dtran_img);
              
                                        $user_id = Auth::guard('nurse_middle')->user()->id;
                                        ?>
                                        <div class="ano_education_imgsedu_{{ $i }}">
                                          @if(!empty($ano_education_img_data))
                                          @foreach($ano_education_img_data as $edu_img)
                                          <div class="trans_img edu_img-{{ $i }} edu_imgano_education_imgsedu_{{ $l }}">
                                            <a href="{{ url('/public/uploads/education_degree') }}/{{ $edu_img }}"><i class="fa fa-file"></i>{{ $edu_img }}</a>
                                            <div class="close_btn close_btn-{{ $i}}" onclick="deleteanoImg1('{{ $l }}','{{ $user_id }}','{{ $edu_img }}','edu_{{$i  }}','ano_education_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                          </div>
                                          <?php
                                          $l++;
                                          ?>
                                          @endforeach
                                          @endif
                                        </div>
                                      </div>
                                      <?php
                                      $user_id = Auth::guard('nurse_middle')->user()->id;
                                      ?>
                                      <div class="col-md-12">
                                        <div class="add_new_cmp_training_div mb-3 mt-3"><a style="cursor: pointer;" class="delete_countinuing_education" data-index="{{ $edu_data->other_edu_id }}">- Delete Continuing Education</a></div>
                                      </div>
                                    </div> 
                                    <?php
                                    $i++;
                                    ?>
                                    @endforeach
              
                                    @endif
              
                                  </div>
                                  <div class="add_new_education_div mt-3" style="margin-bottom: 3rem !important;margin-top: 2rem !important;">
                                    <a style="cursor: pointer;" onclick="add_listeduction()">+Add another Continuing Education</a>
                                  </div>
                                  <div class="declaration_box mt-2">
                                    <input type="checkbox" name="declare_information_man" class="declare_information_man" value="1" @if(!empty($trainingData)) @if($trainingData->declaration_status == 1) checked @endif @endif>
                                    <!-- Hidden Input to Ensure Value is Sent -->
                                    @if(!empty($trainingData) && $trainingData->declaration_status == 1)
                                    <input type="hidden" name="declare_information_man" value="1" @if(!empty($trainingData) && $trainingData->declaration_status == "1") checked @endif>
                                    @endif
                                    <label for="declare_information">I declare that the information provided is true and correct</label>
                                  </div>
                                  <span id="reqmantradeclare_information" class="reqError text-danger valley"></span>
                                  <div class="box-button mt-15">
                                    <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitTraining" @if(!email_verified()) disabled @endif>Save Changes</button>
                                  </div>
                            </form>    

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script src="{{ url('/public') }}/nurse/assets/js/jquery.ui.datepicker.monthyearpicker.js"></script>

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

    if ($(".man_co").val() != "") {
      var man_co = JSON.parse($(".man_co").val());
      console.log("man_co",man_co);
      $('.js-example-basic-multiple[data-list-id="mandatory_courses_data"]').select2().val(man_co).trigger('change');
      for(var i=0;i<man_co.length;i++){
        if ($(".country_org-"+man_co[i]).val() != "") {
          var suborg_country = JSON.parse($(".country_org-"+man_co[i]).val());
          $('.js-example-basic-multiple[data-list-id="well_self_care_data-'+man_co[i]+'"]').select2().val(suborg_country).trigger('change');
        }
      }  
    
    }

    if ($(".man_ed").val() != "") {
      var org_country1 = JSON.parse($(".man_ed").val());
      console.log("org_country1",org_country1);
      $('.js-example-basic-multiple[data-list-id="mandatory_education1"]').select2().val(org_country1).trigger('change');
      for(var i=0;i<org_country1.length;i++){
        if ($(".country_org-"+org_country1[i]).val() != "") {
          var suborg_country = JSON.parse($(".country_org-"+org_country1[i]).val());
          $('.js-example-basic-multiple[data-list-id="core_man_con_data-'+org_country1[i]+'"]').select2().val(suborg_country).trigger('change');
        }
      }  
    
    }

    function getSubCourses(){
        let selectedValues = $('.js-example-basic-multiple[data-list-id="mandatory_courses_data"]').val();
        console.log("selectedValues",selectedValues);

        $(".well_sel_data").each(function(i,val){
          var val = $(val).val();
          console.log("val",$(val).val());
          if(selectedValues.includes(val) == false){
            $(".courses_div-"+val).remove();
            
          }
        });

        for(var i=0;i<selectedValues.length;i++){
            if($(".mandatory_sub_courses .courses_div-"+selectedValues[i]).length < 1 && selectedValues[i] != 564){
                $("#submitProfessionalMembership").attr("disabled", true);
                $.ajax({
                    type: "GET",
                    url: "{{ url('/nurse/getMandatoryCourses') }}",
                    data: {courses_id:selectedValues[i],id:i},
                    cache: false,
                    success: function(data){
                        var data1 = JSON.parse(data);
                        console.log("data1",data1);
                        
                        var courses_text = "";
                        for(var j=0;j<data1.getCourses.length;j++){
                        
                            courses_text += "<li data-value='"+data1.getCourses[j].id+"'>"+data1.getCourses[j].name+"</li>"; 

                        }

                        var ap = '';
                        $(".mandatory_sub_courses").append('\<div class="courses_div courses_div-'+data1.courses_id+'"><div class="form-group level-drp mandatory_courses_div  mandatory_tr_div_1">\
                            <input type="hidden" name="well_sel_data" class="well_sel_data" value="'+data1.courses_id+'">\
                            <label class="form-label courses_label courses_label-'+data1.courses_id+'" for="input-1">'+data1.courses_name+'</label>\
                            <ul id="well_self_care_data-'+data1.courses_id+'" style="display:none;">'+courses_text+'</ul>\
                            <select class="js-example-basic-multiple'+data1.courses_id+' addAll_removeAll_btn" data-list-id="well_self_care_data-'+data1.courses_id+'" name="well_self_care_data[]" onchange="showTrainingData(\''+ap+'\',\''+data1.courses_id+'\',\''+data1.courses_name+'\')" multiple="multiple"></select>\
                            <span id="reqsubcourses-'+data1.courses_id+'" class="reqError text-danger valley"></span>\
                        </div><div class="well_self_care_div-'+data1.courses_id+'"></div></div>');

                        let $fields = $(".mandatory_sub_courses .courses_div");

                        let sortedFields = $fields.sort(function (a, b) {
                            return $(a).find(".courses_label").text().localeCompare($(b).find(".courses_label").text());
                        });

                        $(".mandatory_sub_courses").append(sortedFields);

                        selectTwoFunction(data1.courses_id);
                    }

                });
            }
        }
    }

    function showTrainingData(ap,id,name){
        
        if(ap == 'ap'){
          
          var selectedValues = $('.js-example-basic-multiple[data-list-id="well_self_care_data-'+id+'"]').val();
          
        }else{
          
          var selectedValues = $('.js-example-basic-multiple'+id+'[data-list-id="well_self_care_data-'+id+'"]').val();
        }
        
        console.log("selectedValues",'.js-example-basic-multiple'+id+'[data-list-id="well_self_care_data-'+id+'"]');

        $(".well_sel_data-"+id).each(function(i,val){
          var val = $(val).val();
          console.log("val",$(val).val());
          if(selectedValues.includes(val) == false){
            $(".well_self_care_"+val).remove();
            
          }
        });

        for(var i=0;i<selectedValues.length;i++){
            if($(".well_self_care_div-"+id+" .well_self_care_"+selectedValues[i]).length < 1){
                $.ajax({
                    type: "GET",
                    url: "{{ url('/nurse/getMandatoryCoursesName') }}",
                    data: {courses_id:selectedValues[i],id:i},
                    cache: false,
                    success: function(data){
                        var data1 = JSON.parse(data);
                        console.log("data1",data1);
                        var user_id = "<?php echo Auth::guard('nurse_middle')->user()->id; ?>";
                        var well_sal_data = "well_sel_data";
                        $(".well_self_care_div-"+id).append('<div class="well_self_care_'+id+' well_self_care_'+data1.courses_id+'">\
                            <h6 class="coursesublabel">'+data1.courses_name+'</h6>\
                            <input type="hidden" name="well_sel_data" class="well_sel_data-'+id+'" value="'+data1.courses_id+'">\
                            <div class="row">\
                                <div class="form-group col-md-12">\
                                <label class="form-label" for="input-1">Institution/Regulating Body</label>\
                                <input type="hidden" name="wellnamearr[]" class="wellness_input_'+data1.courses_id+'" value="'+data1.courses_id+'">\
                                <input class="form-control well_institution well_institution-'+data1.courses_id+'" type="text" name="well_institution['+id+']['+data1.courses_id+'][institution]">\
                                <span id="wellinstitutionvalid-'+data1.courses_id+'" class="reqError text-danger valley"></span>\
                                </div>\
                                <div class="form-group col-md-6">\
                                <label class="form-label" for="input-1">Training Start Date</label>\
                                <input class="form-control well_tra_start_date well_tra_start_date-'+data1.courses_id+'" type="date" name="well_institution['+id+']['+data1.courses_id+'][training_start_date]" onkeydown="return false">\
                                <span id="well_tra_start_datevalid-'+data1.courses_id+'" class="reqError text-danger valley"></span>\
                                </div>\
                                <div class="form-group col-md-6">\
                                <label class="form-label" for="input-1">Training End Date</label>\
                                <input class="form-control well_tra_end_date well_tra_end_date-'+data1.courses_id+'" type="date" name="well_institution['+id+']['+data1.courses_id+'][training_end_date]" onkeydown="return false">\
                                <span id="well_tra_end_datevalid-'+data1.courses_id+'" class="reqError text-danger valley"></span>\
                                </div>\
                                <div class="form-group col-md-6">\
                                <label class="form-label" for="input-1">Expiry</label>\
                                <input class="form-control well_expiry well_expiry-'+data1.courses_id+'" type="date" name="well_institution['+id+']['+data1.courses_id+'][training_expiry_date]">\
                                <span id="wellexpiryvalid-'+data1.courses_id+'" class="reqError text-danger valley"></span>\
                                </div>\
                                <div class="form-group col-md-6">\
                                <label class="form-label" for="input-1">Upload Certificate</label>\
                                <input type="hidden" name="well_institution['+id+']['+data1.courses_id+'][evidence_imgs]" class="well_sel_data-'+data1.courses_id+'">\
                                <input class="form-control upload_evidence-'+data1.courses_id+' well_upload_certification well_imgs_'+selectedValues[i]+' well_upload_certification-'+data1.courses_id+'" type="file" name="" onchange="changeEvidenceImg(\''+user_id+'\',\''+id+'\',\''+data1.courses_id+'\',\''+well_sal_data+'\')"  multiple>\
                                <span id="reqwelluploadvalid-{{ $i }}" class="reqError text-danger valley"></span>\
                                <div class="lang_evidence-'+data1.courses_id+'"></div>\
                                </div>\
                            </div>\
                            </div>\
                            </div>');

                            let $fields = $(".well_self_care_div-"+id+" .well_self_care_"+data1.courses_id);

                            let sortedFields = $fields.sort(function (a, b) {
                                return $(a).find(".coursesublabel").text().localeCompare($(b).find(".coursesublabel").text());
                            });

                            $(".well_self_care_div-"+id).append(sortedFields);
                    }
                });  
            }          
            
        }    
    }

    function subEducation(){
        let selectedValues = $('.js-example-basic-multiple[data-list-id="mandatory_education1"]').val();
        console.log("selectedValues",selectedValues);

        $(".cli_data").each(function(i,val){
          var val = $(val).val();
          console.log("val",$(val).val());
          if(selectedValues.includes(val) == false){
            $(".education_course_div-"+val).remove();
            
          }
        });

        for(var i=0;i<selectedValues.length;i++){
            if($(".mandatory_sub_education .education_course_div-"+selectedValues[i]).length < 1){
                $("#submitProfessionalMembership").attr("disabled", true);
                $.ajax({
                    type: "GET",
                    url: "{{ url('/nurse/getMandatoryCourses') }}",
                    data: {courses_id:selectedValues[i],id:i},
                    cache: false,
                    success: function(data){
                        var data1 = JSON.parse(data);
                        console.log("data1",data1);
                        
                        var courses_text = "";
                        for(var j=0;j<data1.getCourses.length;j++){
                        
                            courses_text += "<li data-value='"+data1.getCourses[j].id+"'>"+data1.getCourses[j].name+"</li>"; 

                        }

                        var ap = '';
                        if(data1.courses_id != "563"){
                            $(".mandatory_sub_education").append('\<div class="education_course_div education_course_div-'+data1.courses_id+'"><div class="form-group level-drp mandatory_edu_div">\
                        <input type="hidden" name="cli_data" class="cli_data" value="'+data1.courses_id+'">\
                        <label class="form-label education_label education_label-'+data1.courses_id+'" for="input-1">'+data1.courses_name+'</label>\
                        <ul id="core_man_con_data-'+data1.courses_id+'" style="display:none;">'+courses_text+'</ul>\
                        <select class="js-example-basic-multiple'+data1.courses_id+' addAll_removeAll_btn" data-list-id="core_man_con_data-'+data1.courses_id+'" name="core_man_con_data[]" onchange="getEducationData(\''+ap+'\',\''+data1.courses_id+'\')" multiple="multiple"></select>\
                        <span id="reqsubeducation-'+data1.courses_id+'" class="reqError text-danger valley"></span>\
                      </div><div class="core_man_con_data_div-'+data1.courses_id+'"></div></div>');
                        }
                        

                        let $fields = $(".mandatory_sub_education .education_course_div");

                        let sortedFields = $fields.sort(function (a, b) {
                            return $(a).find(".education_label").text().localeCompare($(b).find(".education_label").text());
                        });

                        $(".mandatory_sub_education").append(sortedFields);

                        selectTwoFunction(data1.courses_id);
                    }

                });
            }
        }
    }

    function getEducationData(ap,id){
        
        
        if(ap == 'ap'){
          var selectedValues = $('.js-example-basic-multiple[data-list-id="core_man_con_data-'+id+'"]').val();
          
        }else{
          var selectedValues = $('.js-example-basic-multiple'+id+'[data-list-id="core_man_con_data-'+id+'"]').val();
        }

        console.log("selectedValues",selectedValues);
        $(".cli_data-"+id).each(function(i,val){
          var val = $(val).val();
          console.log("val",$(val).val());
          if(selectedValues.includes(val) == false){
            $(".core_man_"+val).remove();
            
          }
        });

        for(var i=0;i<selectedValues.length;i++){
            if($(".core_man_con_data_div-"+id+" .core_man_"+selectedValues[i]).length < 1){
                $.ajax({
                    type: "GET",
                    url: "{{ url('/nurse/getMandatoryCoursesName') }}",
                    data: {courses_id:selectedValues[i],id:i},
                    cache: false,
                    success: function(data){
                        var data1 = JSON.parse(data);
                        console.log("data1",data1);
                        var user_id = "<?php echo Auth::guard('nurse_middle')->user()->id; ?>";
                        var well_sal_data = "core_man_data";
  
                        $(".core_man_con_data_div-"+id).append('<div class="core_man_div core_man_'+data1.courses_id+'">\
                          <h6 class="education_courses_label">'+data1.courses_name+'</h6>\
                          <input type="hidden" name="cli_data" class="cli_data-'+id+'" value="'+data1.courses_id+'">\
                          <div class="core_man_div row core_man_institution">\
                            <div class="form-group col-md-12">\
                              <label class="form-label" for="input-1">Institution/Regulating Body</label>\
                              <input type="hidden" name="coremanarr[]" class="coreman_input_'+data1.courses_id+'" value="'+data1.courses_id+'">\
                              <input class="form-control core_man_institution core_man_institution-'+data1.courses_id+'" type="text" name="core_man_institution['+id+']['+data1.courses_id+'][institution]">\
                              <span id="coreinstitutionvalid-'+data1.courses_id+'" class="reqError text-danger valley"></span>\
                            </div>\
                            <div class="form-group col-md-6">\
                              <label class="form-label" for="input-1">Start Date</label>\
                              <input class="form-control coreman_start_date coreman_start_date-'+data1.courses_id+'" type="date" name="core_man_institution['+id+']['+data1.courses_id+'][start_date]">\
                              <span id="coreman_start_datevalid-'+data1.courses_id+'" class="reqError text-danger valley"></span>\
                            </div>\
                            <div class="form-group col-md-6">\
                              <label class="form-label" for="input-1">End Date</label>\
                              <input class="form-control coreman_end_date coreman_end_date-'+data1.courses_id+'" type="date" name="core_man_institution['+id+']['+data1.courses_id+'][end_date]">\
                              <span id="coreman_end_datevalid-'+data1.courses_id+'" class="reqError text-danger valley"></span>\
                            </div>\
                            <div class="form-group col-md-6">\
                              <label class="form-label" for="input-1">Status</label>\
                              <select class="form-control coreman_status coreman_status-'+data1.courses_id+'" name="core_man_institution['+id+']['+data1.courses_id+'][status]">\
                                <option value="">select</option>\
                                <option value="Completed">Completed</option>\
                                <option value="Ongoing">Ongoing</option>\
                                <option value="Pending">Pending</option>\
                              </select>\
                              <span id="coreman_statusvalid-'+data1.courses_id+'" class="reqError text-danger valley"></span>\
                            </div>\
                            <div class="form-group col-md-6">\
                              <label class="form-label" for="input-1">Expiry</label>\
                              <input class="form-control core_man_expiry core_man_expiry-'+data1.courses_id+'" type="date" name="core_man_institution['+id+']['+data1.courses_id+'][expiry_date]">\
                              <span id="coremanexpiryvalid-'+data1.courses_id+'" class="reqError text-danger valley"></span>\
                            </div>\
                            <div class="form-group col-md-12">\
                              <label class="form-label" for="input-1">Upload Certificate</label>\
                              <input type="hidden" name="core_man_institution['+id+']['+data1.courses_id+'][evidence_imgs]" class="well_sel_data-'+data1.courses_id+'" value="">\
                              <input class="form-control upload_evidence-'+data1.courses_id+' coreman_upload_certification core_man_imgs_'+data1.courses_id+' coreman_upload_certification-'+data1.courses_id+'" type="file" name="" onchange="changeEvidenceImg(\''+user_id+'\',\''+id+'\',\''+data1.courses_id+'\',\''+well_sal_data+'\')" multiple>\
                              <div class="lang_evidence-'+data1.courses_id+'"></div>\
                            </div>\
                          </div>\
                        </div>');

                            let $fields = $(".core_man_con_data_div-"+id+" .core_man_"+data1.courses_id);

                            let sortedFields = $fields.sort(function (a, b) {
                                return $(a).find(".coursesublabel").text().localeCompare($(b).find(".coursesublabel").text());
                            });

                            $(".well_self_care_div-"+id).append(sortedFields);
                    }
                });  
            }          
            
        }    
    }

    let selectedEvidenceFiles = [];
    function changeEvidenceImg(user_id,lang_id,language_id,name_arr) {
    
      var files = $('.upload_evidence-'+language_id)[0].files;
      console.log("files", files);
      var form_data = "";
      form_data = new FormData();

      for (var i = 0; i < files.length; i++) {
        form_data.append(name_arr+"["+language_id+"][]", files[i], files[i]['name']);
      }

      form_data.append("user_id", user_id);
      form_data.append("lang_id", lang_id);
      form_data.append("language_id", language_id);
      form_data.append("img_field", name_arr);
      form_data.append("_token", '{{ csrf_token() }}');
      
      $.ajax({
        type: "post",
        url: "{{ route('nurse.uploadTrainingEvidenceImgs') }}",
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
            htmlData += '<div class="trans_img trans_img-' + (i + 1) + '"><a href="{{ url("/public") }}/uploads/education_degree/' + img_name + '" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>' + image_array[i] + '</a><div class="close_btn close_btn-' + i + '" onclick="deleteTrainingEvidenceImg(' + (i + 1) + ',' + user_id + ',\'' + img_name + '\',\''+lang_id+'\',\''+language_id+'\',\''+name_arr+'\')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div></div>';
          }
          $(".lang_evidence-"+language_id).html(htmlData);
        }
      });
    }

    function deleteTrainingEvidenceImg(i, user_id, img,lang_id,language_id,name_arr) {
      
      $.ajax({
        type: "post",
        url: "{{ route('nurse.deleteTrainingEvidenceImg') }}",
        data: {
          user_id: user_id,
          img: img,
          lang_id: lang_id,
          language_id: language_id,
          img_field: name_arr,
          _token: '{{ csrf_token() }}'
        },
        cache: false,
        success: function(data) {
          if (data == 1) {
            $(".lang_evidence-"+language_id+" .trans_img-" + i).remove();
          }
        }
      });
    }

    function updateMandatoryTraining(){
      var isValid = true;

      if ($('[name="mandatory_courses[]"]').val() == '') {

        document.getElementById("reqmantra").innerHTML = "* Please select the Mandatory Courses.";
        
        isValid = false;

      }

      $(".well_sel_data").each(function() {
        var val = $(this).val();
        var label = $(".courses_label-"+val).text();
        console.log("val",val);
        if ($(".js-example-basic-multiple" + val).length > 0) {
          if ($(".js-example-basic-multiple" + val).val() == '') {
            
            document.getElementById("reqsubcourses-" + val).innerHTML = "* Please select the "+label;
            isValid = false;
          }
        }

        $(".well_sel_data-"+val).each(function() {
          var val1 = $(this).val();
          if ($(".well_institution-" + val1).val() == '') {
            
            document.getElementById("wellinstitutionvalid-" + val1).innerHTML = "* Please enter the Institution/Regulating Body";
            isValid = false;
          }

          if ($(".well_tra_start_date-" + val1).val() == '') {
            
            document.getElementById("well_tra_start_datevalid-" + val1).innerHTML = "* Please enter the Training Start Date";
            isValid = false;
          }

          if ($(".well_tra_end_date-" + val1).val() == '') {
            
            document.getElementById("well_tra_end_datevalid-" + val1).innerHTML = "* Please enter the Training End Date";
            isValid = false;
          }

          if ($(".well_expiry-" + val1).val() == '') {
            
            document.getElementById("wellexpiryvalid-" + val1).innerHTML = "* Please enter the Expiry";
            isValid = false;
          }
        });
      });

      if ($('[name="mandatory_education[]"]').val() == '') {

        document.getElementById("reqmanedu").innerHTML = "* Please select the Mandatory Education.";
        
        isValid = false;

      }

      $(".cli_data").each(function() {
        var val = $(this).val();
        var label = $(".education_label-"+val).text();
        console.log("val",val);
        if ($(".js-example-basic-multiple" + val).length > 0) {
          if ($(".js-example-basic-multiple" + val).val() == '') {
            
            document.getElementById("reqsubeducation-" + val).innerHTML = "* Please select the "+label;
            isValid = false;
          }
        }

        $(".cli_data-"+val).each(function() {
          var val1 = $(this).val();
          if ($(".core_man_institution-" + val1).val() == '') {
            
            document.getElementById("coreinstitutionvalid-" + val1).innerHTML = "* Please enter the Institution/Regulating Body";
            isValid = false;
          }

          if ($(".coreman_start_date-" + val1).val() == '') {
            
            document.getElementById("coreman_start_datevalid-" + val1).innerHTML = "* Please enter the Training Start Date";
            isValid = false;
          }

          if ($(".coreman_end_date-" + val1).val() == '') {
            
            document.getElementById("coreman_end_datevalid-" + val1).innerHTML = "* Please enter the Training End Date";
            isValid = false;
          }

          if ($(".coreman_status-" + val1).val() == '') {
            
            document.getElementById("coreman_statusvalid-" + val1).innerHTML = "* Please enter the Status";
            isValid = false;
          }

          if ($(".core_man_expiry-" + val1).val() == '') {
            
            document.getElementById("coremanexpiryvalid-" + val1).innerHTML = "* Please enter the Expiry";
            isValid = false;
          }
        });
      });  

      var n = 1;
      $(".additional_tra_field").each(function() {
        if ($(".additional_tra_field-" + n).length > 0) {
          if ($(".additional_tra_field-" + n).val() == '') {
            document.getElementById("reqtraname-" + n).innerHTML = "* Please enter the training name";
            isValid = false;
          }
        }
        n++;
      });

      var o = 1;
      $(".institution").each(function() {

        if ($(".institution-" + o).length > 0) {
          if ($(".institution-" + o).val() == '') {
            document.getElementById("reqinstitution-" + o).innerHTML = "* Please enter the institution/regulating body";
            isValid = false;
          }
        }
        o++;
      });

      var p = 1;
      $(".tra_start_date").each(function() {

        if ($(".tra_start_date-" + p).length > 0) {
          if ($(".tra_start_date-" + p).val() == '') {
            document.getElementById("reqtrastartdate-" + p).innerHTML = "* Please enter the Training Start Date";
            isValid = false;
          }
        }
        p++;
      });

      var q = 1;
      $(".tra_end_date").each(function() {

        if ($(".tra_start_date-" + q).length > 0) {
          if ($(".tra_end_date-" + q).val() == '') {
            document.getElementById("reqtraenddate-" + q).innerHTML = "* Please enter the Training End Date";
            isValid = false;
          }
        }
        q++;
      });

      var r = 1;
      $(".tra_expiry").each(function() {

        if ($(".tra_expiry-" + r).length > 0) {
          if ($(".tra_expiry-" + r).val() == '') {
            document.getElementById("reqtra_expiry-" + r).innerHTML = "* Please enter the Expiry Date";
            isValid = false;
          }
        }
        q++;
      });

      if ($(".declare_information_man").prop('checked') == false) {
        document.getElementById("reqmantradeclare_information").innerHTML = "* Please check this checkbox";
        isValid = false;
      }

    if(isValid == true){

      $.ajax({
        url: "{{ route('nurse.updateMandatoryTraining') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#training_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitTraining').prop('disabled', true);
          $('#submitTraining').text('Process....');
        },
        success: function(res) {
          $('#submitTraining').prop('disabled', false);
          $('#submitTraining').text('Update Profile');

          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Training Information Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.mandatory_training') }}?page=mandatory_training";
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
          $('#submitTraining').prop('disabled', false);
          $('#submitTraining').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitExperience").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      });
    }  
    return false;
    }

    
</script>
<script type="text/javascript">
    $("#unavailableNow").click(function() {
      if ($("#unavailableNow").prop('checked') == true) {
        $(".available_date_field").removeClass("d-none");
        $(".available_start_dropdown").addClass("d-none");
      } else {
        $(".available_date_field").addClass("d-none");
      }
    });
    $("#availableNow").click(function() {
      $(".available_date_field").addClass("d-none");
      $(".available_start_dropdown").removeClass("d-none");
    });
    if ($("#unavailableNow").prop('checked') == true) {
      $(".available_date_field").removeClass("d-none");
      $(".available_start_dropdown").addClass("d-none");
    }

    if ($("#availableNow").prop('checked') == true) {
        $(".available_start_dropdown").removeClass("d-none");
    }

    $("#start_job_dropdown").change(function(){
        //alert($(this).val());
        var value = $(this).val();
        if(value == "More than 1 month"){
            $('#unavailableNow').prop('checked', true);
            $(".available_start_dropdown").addClass("d-none");
            $(".available_date_field").removeClass("d-none");
            $("#available_date").val('');
        }
    });

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    if (c == "setting_availablity") {

        $(".tab-pane").hide();
        $("#tab-my-profile-setting").css("opacity", "1");
        $("#tab-my-profile-setting").show();
        $(".profile_tabs").removeClass("active");
        //$("#professional_membership").addClass("active");

    }

    function doprofessionSeting_update() {
    event.preventDefault();
    $(".valley").html("");
    $('.submit-btn-120').prop('disabled', true);
    $('.submit-btn-1').show();
    $('.resetpassword').hide();

    let formData = new FormData($('#multi-step-form-nurseProfileForm')[0]);
    $.ajax({
      type: 'POST',
      url: "{{route('nurse.update-profession-profile-setting')}}",
      data: formData,
      dataType: 'JSON',
      processData: false,
      contentType: false,
      cache: false,
      headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      },

      beforeSend: function() {

        $('.submit-btn-120').prop('disabled', true);

        $('.submit-btn-1').show();

        $('.resetpassword').hide();



      },

      success: function(resp) {

        if (resp.status == 1) {

          $('.submit-btn-120').prop('disabled', false);

          $('.submit-btn-1').hide();

          $('.resetpassword').show();

          // $('#multi-step-form')[0].reset();

          Swal.fire({

            icon: 'success',

            title: 'Successfully!',

            text: resp.message,

          }).then(function() {

            // window.location = resp.url;

          });

        } else {

          $('.submit-btn-120').prop('disabled', false);

          $('.submit-btn-1').hide();

          $('.resetpassword').show();

          Swal.fire({

            'icon': 'error',

            'title': 'Error',

            'text': resp.message

          });

          printErrorMsg(resp.validation);

        }

      }

    });

    return false;

  }

  if ($(".any_help_input").val() != "") {
    var any_help_data = JSON.parse($(".any_help_input").val());
    $('.js-example-basic-multiple[data-list-id="any_help"]').select2().val(any_help_data).trigger('change');
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
