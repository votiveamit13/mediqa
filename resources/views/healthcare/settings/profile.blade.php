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
  top: 59%;
  right: 10px;
  transform: translateY(-50%);
  pointer-events: none;
  color: black;
  height: 36px !important;
  width: 20px;
}

form#update_profile_form ul.select2-selection__rendered {
    box-shadow: none;
    max-height: inherit;
    border: none;
    position: relative;
  }

</style>
@endsection

@section('content')
<main class="main">
  <section class="section-box mt-0">
    <div class="">
      <div class="row m-0 profile-wrapper">
        <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">

        @include('healthcare.settings.sidebar')
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 col-12 right_content">
          <div class="content-single content_profile">
            

            <div class="tab-content">
                <?php $user_id=''; $i = 0;?>

                <div class="tab-pane fade" id="tab-my-profile-setting" style="display: block;opacity:1;">

                    
                    <div class="card shadow-sm border-0 p-4 mt-30">
                      
                      <h3 class="mt-0 color-brand-1 mb-2">Profile</h3>
    
                      <form id="update_profile_form" method="POST" onsubmit="return update_profile_form()">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::guard('healthcare_facilities')->user()->id }}">
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Facility Name
                          </label>
                          <input class="form-control facility_name" type="text" name="facility_name"  value="@if($user_data->name != NULL) {{ $user_data->name }} @endif">
                          <span id='reqfacility_name' class='reqError text-danger valley'></span>
                        </div>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Logo
                          </label>
                          <input class="form-control logo" type="file" name="facility_logo" id="profile_image">
                          <span id='reqsector_preferences' class='reqError text-danger valley'></span>
                        </div>
                        @if($user_data->profile_img != "nurse/assets/imgs/nurse06.png")
                        <div class="show_logo">
                          <img src="{{ asset('/healthcareimg/uploads') }}/{{ $user_data->profile_img }}" style="width:100px;height:100px;">
                        </div>
                        
                        @endif
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Sector Preferences
                          </label>
                          
                          <select class="form-input mr-10 select-active sector_preferences" name="sector_preferences" id="sector_preferences">
                            <option value="">select</option>
                            <option value="1" @if($user_data->sector == 1) selected @endif>Public & Government</option>
                            <option value="2" @if($user_data->sector == 2) selected @endif>Private</option>
                            <option value="3" @if($user_data->sector == 3) selected @endif>Public Government & Private</option>
                          </select>
                          <span id='reqsector_preferences' class='reqError text-danger valley'></span>
                          
                        </div>
                        <div class="form-group level-drp">
                          
                            <label class="form-label" for="input-1">Facility Services & Care Areas</label>
                            <?php
                                
                                $workplace_data = DB::table('work_enviornment_preferences')->where("sub_env_id",0)->orderBy("env_name","asc")->get();
                                
                                if(!empty($user_data)){
                                  $facility_type = (array)json_decode($user_data->facility_services);
                                }else{
                                  $facility_type = array();
                                }
                                
                                
                                
                                $p_memb_arr = array();

                                if(!empty($facility_type) && !in_array("444", (array)$facility_type[1])){
                                    foreach ($facility_type[1] as $index => $p_memb) {
                                    
                                        //print_r($p_memb);
                                        $p_memb_arr[] = $index;
                                        
                                    }
                                }else{
                                  if(isset($facility_type[1])){
                                    $p_memb_arr[] = $facility_type[1];
                                  }
                                  
                                }
                                
                                $p_memb_json = json_encode(isset($p_memb_arr[0])?$p_memb_arr[0]:[]);
                            ?>
                            <input type="hidden" name="mainfactype" class="mainfactype mainfactype-1" value="{{ $p_memb_json }}">
                            <ul id="wp_data-1" style="display:none;">
                             
                              @if(!empty($workplace_data))
                              @foreach($workplace_data as $wp_data)
                              <li data-value="{{ $wp_data->prefer_id }}">{{ $wp_data->env_name }}</li>
                              @endforeach
                              @endif
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn facworktype facworktype-1" data-list-id="wp_data-1" name="subworkthlevels[1][]" multiple onchange="getWpData('',1)"></select>
                            <span id="reqfacworktype" class="reqError text-danger valley"></span>
                          
                        </div>
                        <div class="wp_data-1">
                            @if(isset($facility_type[1]) && !in_array("444", (array)$facility_type[1]))
                            @foreach ($p_memb_arr as $p_arr)
                            <?php
                                $sdata = (array)$facility_type[1];
                                $subface_data = (array)$sdata[$p_arr];
                                $environment_list = DB::table("work_enviornment_preferences")->where("sub_env_id",$p_arr)->where("sub_envp_id","0")->get();
                                $environment_name = DB::table("work_enviornment_preferences")->where("prefer_id",$p_arr)->first();
                                
                                $p_memb_arr = array();

                                if (array_key_exists(0, $subface_data)){
                                if(!empty($subface_data)){
                                    foreach ($subface_data as $index => $s_data) {
                                
                                    //print_r($p_memb);
                                    $p_memb_arr[] = $s_data;
                                    
                                    }
                                }
                                }else{
                                    if(!empty($subface_data)){
                                        foreach ($subface_data as $index => $s_data) {
                                    
                                        //print_r($p_memb);
                                        $p_memb_arr[] = $index;
                                        
                                        }
                                    }
                                }
                                

                                
                                //print_r($p_memb_arr);
                                $p_memb_json = json_encode($p_memb_arr);
                            ?>
                            <div class="wp_main_div wp_main_div-{{ $p_arr }}"><div class="subworkdiv subworkdiv-{{ $p_arr }} form-group level-drp">
                                <label class="form-label work_label work_label-1{{ $p_arr }}" for="input-1">{{ $environment_name->env_name }}</label>
                                <input type="hidden" name="subwork" class="subwork subwork-{{ $p_arr }}" value="1">
                                <input type="hidden" name="subwork_list" class="subwork_list subwork_list-1" value="{{ $p_arr }}">
                                <input type="hidden" name="subworkjs" class="subworkjs-1 subworkjs-1{{ $p_arr }}" value="{{ $p_memb_json }}">
                                <ul id="subwork_field-1{{ $p_arr }}" style="display:none;">
                                @if(!empty($environment_list))
                                @foreach($environment_list as $env_list)
                                <li data-value="{{ $env_list->prefer_id }}">{{ $env_list->env_name }}</li>
                                
                                @endforeach
                                @endif
                                </ul>
                                <select class="js-example-basic-multiple addAll_removeAll_btn work_valid-1 work_valid-1{{ $p_arr }}" data-list-id="subwork_field-1{{ $p_arr }}" name="subworkthlevel[1][{{ $p_arr }}][]" onchange="getWpSubData('',1,{{ $p_arr }})" multiple></select>
                                <span id="reqsubwork-1{{ $p_arr }}" class="reqError text-danger valley"></span>
                                </div>
                                <div class="showsubwpdata showsubwpdata-1{{ $p_arr }}">
                                @if(array_key_exists(0, $subface_data) == false)
                                @if(!empty($p_memb_arr))
                                @foreach ($p_memb_arr as $p_arr1)
                                <?php
                                    $subface_data1 = $subface_data[$p_arr1];
                                    $environment_list = DB::table("work_enviornment_preferences")->where("sub_env_id",$p_arr)->where("sub_envp_id",$p_arr1)->get();
                                    $environment_name = DB::table("work_enviornment_preferences")->where("prefer_id",$p_arr1)->first();
                                    
                                    

                                    $p_memb_json = json_encode($subface_data1);
                                ?>
                                <div class="subpworkdiv subpworkdiv-{{ $p_arr1 }} form-group level-drp">
                                    <label class="form-label pwork_label pwork_label-1{{ $p_arr1 }}" for="input-1">{{ $environment_name->env_name }}</label>
                                    <input type="hidden" name="subpwork" class="subpwork subpwork-{{ $p_arr1 }}" value="1">
                                    <input type="hidden" name="subpwork_list" class="subpwork_list subpwork_list-1" value="{{ $p_arr1 }}">
                                    <input type="hidden" name="subworkjs1" class="subworkjs1-1 subworkjs1-1{{ $p_arr1 }}" value="{{ $p_memb_json }}">
                                    <ul id="subpwork_field-1{{ $p_arr1 }}" style="display:none;">
                                    @if(!empty($environment_list))
                                    
                                    @foreach($environment_list as $env_list)
                                    <li data-value="{{ $env_list->prefer_id }}">{{ $env_list->env_name }}</li>
                                    
                                    @endforeach
                                    @endif
                                    </ul>
                                    <select class="js-example-basic-multiple addAll_removeAll_btn pwork_valid-{{ $p_arr1 }} pwork_valid-1{{ $p_arr1 }}" data-list-id="subpwork_field-1{{ $p_arr1 }}" name="subworkthlevel[1][{{ $p_arr }}][{{ $p_arr1 }}][]" multiple></select>
                                    <span id="reqsubpwork-1{{ $p_arr1 }}" class="reqError text-danger valley"></span>
                                </div>
                                @endforeach
                                @endif
                                @endif
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <h6 class="emergency_text">
                            Location 
    
                        </h6>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Operating Country
                          </label>
                          <select class="form-control form-select country_dropdown" name="country" id="countryI" onchange="getStates(this.value,1)">
                            <option value="">Select Country</option>
                            @php $country_data=country_name_from_db();@endphp
                            @foreach ($country_data as $data)
                            <option value="{{$data->iso2}}" <?= Auth::guard('healthcare_facilities')->user()->country_iso == $data->iso2 ? 'selected' : '' ?>> {{$data->name}} </option>
                            @endforeach
                          </select>
                          <span id='reqcountry' class='reqError text-danger valley'></span>
                          
                        </div>
                        <div class="location_block">
                          @php
                            $i = 1;
                          @endphp
                          @if($user_data->site_data != NULL)
                            @foreach(json_decode($user_data->site_data) as $site_data)
                            <div class="location_site_name location_site_name-1">
                              <h6 class="emergency_text">Site {{ $i }}</h6>
                              <input type="hidden" name="location_site_no" class="location_site_no" value="{{ $i }}">
                              <div class="form-group">
                                <label class="form-label" for="input-1">Site name</label>
                                
                                <input class="form-control site_name-{{ $i }}" type="text" name="site_data[{{ $i }}][site_name]"  value="@if(isset($site_data->site_name)){{ $site_data->site_name }}@endif">
                                <span id="reqsite_name-{{ $i }}" class="reqError text-danger valley"></span>
                              </div>
                              <div class="form-group">
                                <label class="form-label" for="input-1">Address (street/suburb/city)</label>
                                
                                <input class="form-control address-{{ $i }}" type="text" name="site_data[{{ $i }}][address]"  value="@if(isset($site_data->address)){{ $site_data->address }}@endif">
                                <span id="reqaddress-{{ $i }}" class="reqError text-danger valley"></span>
                              </div>
                              <div class="form-group">
                                <label class="form-label" for="input-1">State/Region (country-specific)</label>
                                
                                <select class="form-control form-select state-{{ $i }} job_state job_state-1" name="site_data[{{ $i }}][state]">
                                  <option value="">Select States</option>
                                  
                                </select>
                                <span id="reqstate-{{ $i }}" class="reqError text-danger valley"></span>
                              </div>
                              <div class="form-group">
                                <label class="form-label" for="input-1">Postcode</label>
                                
                                <input class="form-control post_code" type="text" name="site_data[{{ $i }}][post_code]" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="@if(isset($site_data->post_code)){{ $site_data->post_code }}@endif">
                                <span id="reqpost_code-{{ $i }}" class="reqError text-danger valley"></span>
                              </div>
                              <div class="delete_another_location_btn">
                                <a style="cursor:pointer" class="btn btn-default delete_location mb-2" onclick="delete_location({{ $i }})">Delete Location</a>
                              </div>
                            </div>
                            <?php
                              $i++;
                            ?>
                            @endforeach
                          @else
                          <div class="location_site_name location_site_name-1">
                            <h6 class="emergency_text">Site 1</h6>
                            <input type="hidden" name="location_site_no" class="location_site_no" value="1">
                            <div class="form-group">
                              <label class="form-label" for="input-1">Site name</label>
                              
                              <input class="form-control site_name-1" type="text" name="site_data[1][site_name]"  value="">
                              <span id="reqsite_name-1" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group">
                              <label class="form-label" for="input-1">Address (street/suburb/city)</label>
                              
                              <input class="form-control address-1" type="text" name="site_data[1][address]"  value="">
                              <span id="reqaddress-1" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group">
                              <label class="form-label" for="input-1">State/Region (country-specific)</label>
                              
                              <select class="form-control form-select state-1 job_state job_state-1" name="site_data[1][state]">
                                <option value="">Select States</option>
                                
                              </select>
                              <span id="reqstate-1" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group">
                              <label class="form-label" for="input-1">Postcode</label>
                              
                              <input class="form-control post_code-1" type="number" name="site_data[1][post_code]" class="phone" maxlength="10" value="">
                              <span id="reqpost_code-1" class="reqError text-danger valley"></span>
                            </div>
                            <div class="delete_another_location_btn">
                              <a style="cursor:pointer" class="btn btn-default delete_location mb-2" onclick="delete_location(1)">Delete Location</a>
                            </div>
                          </div>
                          @endif
                        </div>
                        <div class="add_another_location_btn">
                          <a style="cursor:pointer" class="btn btn-default another_location" onclick="another_location()">Add another Location</a>
                        </div>
                        @php
                          $get_accreditation = (!empty($user_data->accreditations_certifications))?json_decode($user_data->accreditations_certifications):[];  
                          
                        @endphp
                        @if(!empty($get_accreditation))
                        <div class="another_accreditations_data">
                        @foreach($get_accreditation as $index=>$accreditation)
                        <div class="form-group level-drp">
                            <input type="hidden" name="accreditation_no" class="accreditation_no" value="{{ $index }}">    
                            <label class="form-label" for="input-1">Accreditations & Certifications:</label>
                            <?php
                                
                                $accreditations_data = DB::table('accreditation_certifications')->where("parent",0)->orderBy("id","asc")->get();
                                
                                $acc_arr = [];
                                foreach($accreditation as $sub_index=>$acc){
                                  $acc_arr[] = $sub_index;
                                }

                                $acc_json = json_encode($acc_arr);
                                //print_r($acc_arr);
                                
                            ?>
                            <input type="hidden" name="mainfactype" class="acctype acctype-{{ $index }}" value="{{ $acc_json }}">
                            <ul id="accreditations_data-{{ $index }}" style="display:none;">
                             
                              @if(!empty($accreditations_data))
                              @foreach($accreditations_data as $ac_data)
                              <li data-value="{{ $ac_data->id }}">{{ $ac_data->name }}</li>
                              @endforeach
                              @endif
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn facworktype facworktype-1" data-list-id="accreditations_data-{{ $index }}" name="accreditations_data[1][]" multiple onchange="getAccreditationFields('',{{ $index }})"></select>
                            <span id="reqfacworktype" class="reqError text-danger valley"></span>
                                
                        </div>
                        <div class="accreditions_data-{{ $index }}">
                          @foreach($acc_arr as $accarr)
                          @php
                             $accreditations_subdata = DB::table('accreditation_certifications')->where("parent",$accarr)->orderBy("id","asc")->get();   
                             $accreditations_subdataname = DB::table('accreditation_certifications')->where("id",$accarr)->first(); 
                             $ac_data_arr = (array)$accreditation;
                             
                             $ac_data_json = json_encode($ac_data_arr[$accarr])
                          @endphp
                          <div class="accredition_main_div accredition_main_div-{{ $index }}{{ $accarr }}">
                            <div class="subaccreditiondiv subaccreditiondiv-{{ $index }}{{ $accarr }} form-group level-drp">
                              <label class="form-label accredition_label accredition_label-{{ $index }}{{ $accarr }}" for="input-1">{{ $accreditations_subdataname->name}}</label>
                              <input type="hidden" name="subaccredition" class="subaccredition subaccredition-{{ $index }}{{ $accarr }}" value="">
                              <input type="hidden" name="subaccredition_list" class="subaccredition_list-{{ $index }}" value="{{ $accarr }}">
                              <input type="hidden" name="mainfactype" class="subacctype subacctype-{{ $index }}{{ $accarr }}" value="{{ $ac_data_json }}">
                              <ul id="subaccredition_field-{{ $index }}{{ $accarr }}" style="display:none;">
                                @foreach($accreditations_subdata as $ac_data)
                                <li data-value="{{ $ac_data->id }}">{{ $ac_data->name }}</li>
                                @endforeach
                              </ul>
                              <select class="js-example-basic-multiple addAll_removeAll_btn accredition_valid accredition_valid-{{ $index }}{{ $accarr }}" data-list-id="subaccredition_field-{{ $index }}{{ $accarr }}" name="subaccreditation_data[{{ $index }}][{{ $accarr }}][]" multiple></select>
                              <span id="reqsubaccredition-{{ $accarr }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="showsubwpaccreditiondata showsubaccreditiondata-{{ $index }}{{ $accarr }}"></div>
                          </div>
                          @endforeach
                        </div>
                        
                        @endforeach   
                        </div>     
                        @else
                        <div class="form-group level-drp">
                            <input type="hidden" name="accreditation_no" class="accreditation_no" value="1">    
                            <label class="form-label" for="input-1">Accreditations & Certifications:</label>
                            <?php
                                
                                $accreditations_data = DB::table('accreditation_certifications')->where("parent",0)->orderBy("id","asc")->get();
                                
                                // if(!empty($user_data)){
                                //   $facility_type = (array)json_decode($user_data->facility_services);
                                // }else{
                                //   $facility_type = array();
                                // }
                                
                                
                                
                                // $p_memb_arr = array();

                                // if(!empty($facility_type) && !in_array("444", (array)$facility_type[1])){
                                //     foreach ($facility_type[1] as $index => $p_memb) {
                                    
                                //         //print_r($p_memb);
                                //         $p_memb_arr[] = $index;
                                        
                                //     }
                                // }else{
                                //   if(isset($facility_type[1])){
                                //     $p_memb_arr[] = $facility_type[1];
                                //   }
                                  
                                // }
                                
                                // $p_memb_json = json_encode(isset($p_memb_arr[0])?$p_memb_arr[0]:[]);
                            ?>
                            <!-- <input type="hidden" name="mainfactype" class="mainfactype mainfactype-1" value="{{ $p_memb_json }}"> -->
                            <ul id="accreditations_data-1" style="display:none;">
                             
                              @if(!empty($accreditations_data))
                              @foreach($accreditations_data as $ac_data)
                              <li data-value="{{ $ac_data->id }}">{{ $ac_data->name }}</li>
                              @endforeach
                              @endif
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn facworktype facworktype-1" data-list-id="accreditations_data-1" name="accreditations_data[1][]" multiple onchange="getAccreditationFields('',1)"></select>
                            <span id="reqfacworktype" class="reqError text-danger valley"></span>
                                
                        </div>
                        <div class="accreditions_data-1"></div>
                        <div class="another_accreditations_data"></div>
                        @endif
                        <div class="add_another_location_btn">
                          <a style="cursor:pointer" class="btn btn-default" onclick="another_accreditations()">Add another Accreditations & Certifications</a>
                        </div>
                        <h6 class="emergency_text">Work Environment Details</h6>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Size 
                          </label>
                          <select class="form-input mr-10 select-active work_environment_size" name="work_environment_size" id="work_environment_size">
                            <option value="">select</option>
                            <option value="1" @if($user_data->work_environment_size == 1) selected @endif>Small clinic</option>
                            <option value="2" @if($user_data->work_environment_size == 2) selected @endif>Medium hospital</option>
                            <option value="3" @if($user_data->work_environment_size == 3) selected @endif>Large tertiary centre</option>
                          </select>
                          <span id='reqsector_preferences' class='reqError text-danger valley'></span>
                          
                        </div>
                        <h6 class="emergency_text">Staff wellbeing programs</h6>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Role-specific details can also be added in each job posting. 
                          </label>
                          @php
                            $staff_data = DB::table("healthcare_profile_dropdowns")->where("parent",1)->get();    
                          @endphp
                          <select class="form-input mr-10 select-active staff_wellbeing_field" name="staff_wellbeing_field" id="staff_wellbeing_field" onchange="getStaff(this.value,'single')">
                            <option value="">select</option>
                            @foreach($staff_data as $st_data)
                            <option value="{{ $st_data->id }}" @if($user_data->staff_wellbeing_programs == $st_data->id) selected @endif>{{ $st_data->name }}</option>
                            @endforeach
                            
                          </select>
                          <span id='reqsector_preferences' class='reqError text-danger valley'></span>
                          
                        </div>
                        <div class="form-group level-drp staff_wellbeing_other @if($user_data->staff_wellbeing_programs != 7) d-none @endif">
                            <label class="form-label accredition_label accredition_label" for="input-1">Other</label>
                            
                            <input type="text" name="other_text" class="other_text" value="{{ $user_data->other_staff_wellbeing }}"/>
                            <span id="reqsubaccredition" class="reqError text-danger valley"></span>
                        </div>
                        <h6 class="emergency_text">Technology & Equipment</h6>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">EMR/EHR System 
                          </label>
                          @php
                            $emr_data = DB::table("healthcare_profile_dropdowns")->where("parent",2)->get();    
                          @endphp
                          <input type="hidden" class="show_emr_ehr" value="{{ $user_data->technology_emr_system }}"/>
                          <ul id="emr_ehr_data" style="display:none;">
                             
                            @if(!empty($emr_data))
                            @foreach($emr_data as $ac_data)
                            <li data-value="{{ $ac_data->id }}">{{ $ac_data->name }}</li>
                            @endforeach
                            @endif
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn facworktype facworktype-1" data-list-id="emr_ehr_data" name="emr_ehr_data[]" multiple onchange="getStaff('','multiple')"></select>
                          <span id='reqsector_preferences' class='reqError text-danger valley'></span>
                          
                        </div>
                        <div class="form-group level-drp emr_ehr_other d-none">
                            <label class="form-label accredition_label accredition_label" for="input-1">Other</label>
                            
                            <input type="text" name="emr_other_text" class="emr_other_text" value="{{ $user_data->other_technology_emr }}"/>
                            <span id="reqsubaccredition" class="reqError text-danger valley"></span>
                        </div>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Equipment & Facilities 
                          </label>
                          @php
                            $equipment_data = DB::table("healthcare_profile_dropdowns")->where("parent",3)->get();    
                          @endphp
                          <select class="form-input mr-10 select-active equipment_field" name="equipment_field" id="equipment_field">
                            <option value="">select</option>
                            @foreach($equipment_data as $st_data)
                            <option value="{{ $st_data->id }}" @if($user_data->equipment_facilities == $st_data->id) selected @endif>{{ $st_data->name }}</option>
                            @endforeach
                            
                          </select>
                          <span id='reqsector_preferences' class='reqError text-danger valley'></span>
                          
                        </div>
                        <div class="level-drp digital_health_checkboxes">
                            <label class="form-label accredition_label accredition_label" for="input-1">Digital Health Integration</label>
                            @php
                              $digital_health_data = DB::table("healthcare_profile_dropdowns")->where("parent",3)->get();
                              $digital_health_arr = (is_array(json_decode($user_data->digital_health_integration)))?json_decode($user_data->digital_health_integration):[];    
                            @endphp
                            @foreach($digital_health_data as $st_data)
                            <div class="digital_health_checkbox">
                              <input type="checkbox" name="digital_health_text[]" class="digital_health_text" @if(in_array($st_data->id, $digital_health_arr)) checked @endif value="{{ $st_data->id }}"/>  {{ $st_data->name }}
                            </div>
                            @endforeach
                            <span id="reqsubaccredition" class="reqError text-danger valley"></span>
                        </div>
                        <h6 class="emergency_text">Professional Development</h6>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Role-specific details can also be added in each job posting. 
                          </label>
                          @php
                            $professional_data = DB::table("healthcare_profile_dropdowns")->where("parent",5)->get();    
                          @endphp
                          <select class="form-input mr-10 select-active professional_field" name="professional_field" id="professional_field" onchange="getStaff(this.value,'single')">
                            <option value="">select</option>
                            @foreach($professional_data as $st_data)
                            <option value="{{ $st_data->id }}" @if($user_data->professional_development == $st_data->id) selected @endif>{{ $st_data->name }}</option>
                            @endforeach
                            
                          </select>
                          <span id='reqsector_preferences' class='reqError text-danger valley'></span>
                          
                        </div>
                        <div class="form-group level-drp professional_other @if($user_data->professional_development != 26) d-none @endif">
                            <label class="form-label accredition_label accredition_label" for="input-1">Other</label>
                            
                            <input type="text" name="professional_other_text" class="professional_other_text" value="{{ $user_data->other_professional_development }}"/>
                            <span id="reqsubaccredition" class="reqError text-danger valley"></span>
                        </div>
                        <h6 class="emergency_text">Contact Person</h6>
                        <div class="form-group level-drp">
                          <label class="form-label accredition_label accredition_label" for="input-1">Full Name</label>
                          
                          <input type="text" name="full_name" class="full_name" value="{{ $user_data->contact_person_name }}"/>
                          <span id="reqsubaccredition" class="reqError text-danger valley"></span>
                        </div>      
                        
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Role/Position 
                          </label>
                          @php
                            $role_data = DB::table("role_position")->get();    
                          @endphp
                          <select class="form-input mr-10 select-active role_position_field" name="role_position_field" id="role_position_field" onchange="getRole(this.value)">
                            <option value="">select</option>
                            @foreach($role_data as $r_data)
                            <option value="{{ $r_data->id }}" @if($user_data->role_position == $r_data->id) selected @endif>{{ $r_data->name }}</option>
                            @endforeach
                            
                          </select>
                          <span id='reqsector_preferences' class='reqError text-danger valley'></span>
                          
                        </div>  
                        <div class="form-group level-drp role_position_other d-none">
                            <label class="form-label accredition_label accredition_label" for="input-1">Other</label>
                            
                            <input type="text" name="role_position_other_text" class="role_position_other_text" value="{{ $user_data->role_position_other }}"/>
                            <span id="reqsubaccredition" class="reqError text-danger valley"></span>
                        </div>
                        <div class="form-group level-drp">
                          <label class="form-label accredition_label accredition_label" for="input-1">Email</label>
                          
                          <input type="email" name="email" class="email" value="@if($user_data->email != NULL) {{ $user_data->email }} @endif" readonly/>
                          <span id="reqsubaccredition" class="reqError text-danger valley"></span>
                        </div>
                        <div class="form-group level-drp">
                          <label class="form-label accredition_label accredition_label" for="input-1">Phone</label>
                          
                          <input type="number" name="phone" class="phone" maxlength="10" value="{{ $user_data->phone }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,10)">
                          <span id="reqsubaccredition" class="reqError text-danger valley"></span>
                        </div>  
                        @php
                          $communication_method = (is_array(json_decode($user_data->communication_method)))?json_decode($user_data->communication_method):[];
                        @endphp
                        <div class="level-drp">
                          <label class="form-label" for="input-1">Preferred Communication Method 
                          </label>
                          <div class="communication_checkbox">
                            <input type="checkbox" name="communication_text[]" @if(in_array(1,$communication_method)) checked @endif class="communication_text" value="1"/>  Email
                          </div>
                          <div class="communication_checkbox">
                            <input type="checkbox" name="communication_text[]" @if(in_array(2,$communication_method)) checked @endif class="communication_text" value="2"/>  Phone
                          </div>
                          <div class="communication_checkbox">
                            <input type="checkbox" name="communication_text[]" @if(in_array(3,$communication_method)) checked @endif class="communication_text" value="3"/>  In App
                          </div>      
                          <span id='reqsector_preferences' class='reqError text-danger valley'></span>
                          
                        </div>
                        <h6 class="emergency_text">Facility Profile Visibility</h6>
                        <div class="level-drp">
                          <div class="profile_visiblity_checkbox">
                            <input type="radio" name="profile_visiblity" class="profile_visiblity" @if($user_data->profile_visiblity == "1") checked @endif value="1"/>  Public
                          </div>
                          <div class="profile_visiblity_checkbox">
                            <input type="radio" name="profile_visiblity" class="profile_visiblity" @if($user_data->profile_visiblity == "2") checked @endif value="2"/>  Private
                          </div>
                        </div>
                        <div class="box-button mt-15">
                            <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitProfile">Save Changes</button>
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

    var i = 1;
    $(".job_state").each(function(){
      var countryI = $('#countryI').val();
      console.log("countryI",countryI);

      getStates(countryI,i);
      i++;
    });

    $(document).on('input', '.facility_name,.full_name', function () {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
    });

    function another_location(){
      var lastValue = $('.location_site_no').last().val();
      var nextValues = parseInt(lastValue)+1;

      var countryI = $('#countryI').val();
      console.log("countryI",countryI);

      getStates(countryI,nextValues);
      
      $(".location_block").append('\<div class="location_site_name location_site_name-'+nextValues+'">\
                <h6 class="emergency_text">Site '+nextValues+'</h6>\
                <input type="hidden" name="location_site_no" class="location_site_no" value="'+nextValues+'">\
                <div class="form-group">\
                  <label class="form-label" for="input-1">Site name</label>\
                  <input class="form-control site_name-'+nextValues+'" type="text" name="site_data['+nextValues+'][site_name]"  value="">\
                  <span id="reqsite_name-'+nextValues+'" class="reqError text-danger valley"></span>\
                </div>\
                <div class="form-group">\
                  <label class="form-label" for="input-1">Address (street/suburb/city)</label>\
                  <input class="form-control address-'+nextValues+'" type="text" name="site_data['+nextValues+'][address]"  value="">\
                  <span id="reqaddress-'+nextValues+'" class="reqError text-danger valley"></span>\
                </div>\
                <div class="form-group">\
                  <label class="form-label" for="input-1">State/Region (country-specific)</label>\
                  <select class="form-control form-select state-'+nextValues+' job_state-'+nextValues+'" name="site_data['+nextValues+'][state]">\
                    <option value="">Select States</option>\
                  </select>\
                  <span id="reqstate-'+nextValues+'" class="reqError text-danger valley"></span>\
                </div>\
                <div class="form-group">\
                  <label class="form-label" for="input-1">Postcode</label>\
                  <input class="form-control post_code-'+nextValues+'" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')" type="text" name="site_data['+nextValues+'][post_code]"  value="">\
                  <span id="reqpost_code-'+nextValues+'" class="reqError text-danger valley"></span>\
                </div>\
                <div class="delete_another_location_btn">\
                  <a style="cursor:pointer" class="btn btn-default delete_location mb-2" onclick="delete_location('+nextValues+')">Delete Location</a>\
                </div>\
              </div>');
              renumberLocations();
    }

    function another_accreditations(){
      var accreditations_data = '<?php echo json_encode($accreditations_data); ?>';

      var lastValue = $('.accreditation_no').last().val();
      var nextValues = parseInt(lastValue)+1;
      
      var parse_accreditations_data = JSON.parse(accreditations_data);
      console.log("accreditations_data",parse_accreditations_data);

      var acc_html = '';
      var ap = 'ap';
      for(var i=0;i<parse_accreditations_data.length;i++){
        acc_html += '<li data-value="'+parse_accreditations_data[i].id+'">'+parse_accreditations_data[i].name+'</li>'
      }
      $(".another_accreditations_data").append('\<div class="form-group level-drp">\
        <input type="hidden" name="accreditation_no" class="accreditation_no" value="'+nextValues+'">\
        <label class="form-label" for="input-1">Accreditations & Certifications:</label>\
        <ul id="accreditations_data-'+nextValues+'" style="display:none;">'+acc_html+'</ul>\
        <select class="js-example-basic-multiple_acc-'+nextValues+' addAll_removeAll_btn facworktype facworktype-1" data-list-id="accreditations_data-'+nextValues+'" name="accreditations_data['+nextValues+'][]" multiple onchange="getAccreditationFields(\''+ap+'\',\''+nextValues+'\')"></select>\
        <span id="reqfacworktype" class="reqError text-danger valley"></span>\
        </div><div class="accreditions_data-'+nextValues+'"></div>');

        selectTwoFunction("_acc-"+nextValues);
    }

    function getStaff(value,type){

      if(type == 'single'){
        if(value == 7){
          $(".staff_wellbeing_other").removeClass("d-none");
        }else{
          if(value == 26){
            $(".professional_other").removeClass("d-none");
          }else{

            $(".staff_wellbeing_other").addClass("d-none");
            $(".professional_other").addClass("d-none");
          }
          
        }
      }else{
        var selectedValues = $('.js-example-basic-multiple[data-list-id="emr_ehr_data"]').val();

        if(selectedValues.includes("13")){
          $(".emr_ehr_other").removeClass("d-none");
        }else{
          $(".emr_ehr_other").addClass("d-none");
        }
      }
    }

    function getRole(value){
      if(value == "6"){
        $(".role_position_other").removeClass("d-none");
      }else{
        $(".role_position_other").addClass("d-none");
      }
    }

    function delete_location(id){
    
      var totalLocations = $('.location_site_name').length;

      // ❌ Prevent deleting last remaining location
      if(totalLocations <= 1){
          alert("At least one location is required.");
          return;
      }

      $('.location_site_name-' + id).remove();
      renumberLocations();
    }

    function renumberLocations(){

      var totalLocations = $('.location_site_name').length;

      $('.location_site_name').each(function(index){

          var newNumber = index + 1;

          // Update class
          $(this)
              .removeClass(function(index, className) {
                  return (className.match(/location_site_name-\d+/g) || []).join(' ');
              })
              .addClass('location_site_name-' + newNumber);

          // Update heading
          $(this).find('.emergency_text').text('Site ' + newNumber);

          // Update hidden value
          $(this).find('.location_site_no').val(newNumber);

          // Update delete button
          var deleteBtn = $(this).find('.delete_location');
          deleteBtn.attr('onclick', 'delete_location(' + newNumber + ')');

          // 🚫 Hide delete button if only one location
          if(totalLocations <= 1){
              deleteBtn.hide();
          } else {
              deleteBtn.show();
          }

      });
    }

    function getWpData(ap, k){
        if(ap == 'ap'){
            var selectedValues = $('.js-example-basic-multiple'+k+'[data-list-id="wp_data-'+k+'"]').val();
        }else{
            var selectedValues = $('.js-example-basic-multiple[data-list-id="wp_data-'+k+'"]').val();
        }

        console.log("selectedValueswp",selectedValues);

        $(".wp_data-"+k+" .subwork_list").each(function(i,val){
            var val1 = $(val).val();
            console.log("val",val1);
            if(selectedValues.includes(val1) == false){
                $(".wp_main_div-"+val1).remove();
                
            }
        });

        for(var i=0;i<selectedValues.length;i++){
            if($(".wp_data-"+k+" .wp_main_div-"+selectedValues[i]).length < 1 && selectedValues[i] != "444"){
                $.ajax({
                    type: "GET",
                    url: "{{ url('/healthcare-facilities/getWorkplaceData') }}",
                    data: {place_id:selectedValues[i]},
                    cache: false,
                    success: function(data){
                        var data1 = JSON.parse(data);
                        console.log("data1",data1);

                        var wp_text = "";
                        for(var j=0;j<data1.work_data.length;j++){
                        
                            wp_text += "<li data-value='"+data1.work_data[j].prefer_id+"'>"+data1.work_data[j].env_name+"</li>"; 
                        
                        }

                        $('.js-example-basic-multiple[data-list-id="wp_data-1"]').removeAttr("name");
                        
                        var ap = "ap";
                        $(".wp_data-"+k).append('\<div class="wp_main_div wp_main_div-'+data1.prefer_id+'"><div class="subworkdiv subworkdiv-'+data1.prefer_id+' form-group level-drp">\
                            <label class="form-label work_label work_label-'+k+data1.prefer_id+'" for="input-1">'+data1.env_name+'</label>\
                            <input type="hidden" name="subwork" class="subwork subwork-'+data1.prefer_id+'" value="'+k+'">\
                            <input type="hidden" name="subwork_list" class="subwork_list subwork_list-'+k+'" value="'+data1.prefer_id+'">\
                            <ul id="subwork_field-'+k+data1.prefer_id+'" style="display:none;">'+wp_text+'</ul>\
                            <select class="js-example-basic-multiple'+k+data1.prefer_id+' addAll_removeAll_btn work_valid-'+k+' work_valid-'+k+data1.prefer_id+'" data-list-id="subwork_field-'+k+data1.prefer_id+'" name="subworkthlevel['+k+']['+data1.prefer_id+'][]" onchange="getWpSubData(\''+ap+'\',\''+k+'\',\''+data1.prefer_id+'\')" multiple></select>\
                            <span id="reqsubwork-'+k+data1.prefer_id+'" class="reqError text-danger valley"></span>\
                            </div><div class="showsubwpdata showsubwpdata-'+k+data1.prefer_id+'"></div></div>');

                            let $fields = $(".wp_data-"+k+" .wp_main_div");

                            let sortedFields = $fields.sort(function (a, b) {
                                return $(a).find(".work_label").text().localeCompare($(b).find(".work_label").text());
                            });

                            $(".wp_data-"+k).append(sortedFields);
                        
                        selectTwoFunction(k+data1.prefer_id);
                    }    
                });            
            }
        }
    }

    

    function getWpSubData(ap,k,l){
        if(ap == 'ap'){
            var selectedValues = $('.js-example-basic-multiple'+k+l+'[data-list-id="subwork_field-'+k+l+'"]').val();
        }else{
            var selectedValues = $('.js-example-basic-multiple[data-list-id="subwork_field-'+k+l+'"]').val();
        }

        console.log("selectedValues",selectedValues);

        $(".showsubwpdata-"+k+l+" .subpwork_list").each(function(i,val){
            var val1 = $(val).val();
            console.log("val",val1);
            if(selectedValues.includes(val1) == false){
                $(".subpworkdiv-"+val1).remove();
                
            }
        });

        var ne_st = k.toString() + l.toString();
        
        if($.trim($(".showsubwpdata-"+ne_st).html()) != ''){
           $('.js-example-basic-multiple[data-list-id="subwork_field-'+k+l+'"]').removeAttr("name");
        }

        for(var i=0;i<selectedValues.length;i++){
            if($(".showsubwpdata-"+k+l+" .subpworkdiv-"+selectedValues[i]).length < 1){
                $.ajax({
                    type: "GET",
                    url: "{{ url('/healthcare-facilities/getSubWorkplaceData') }}",
                    data: {place_id:l,subplace_id:selectedValues[i]},
                    cache: false,
                    success: function(data){
                        var data1 = JSON.parse(data);
                        console.log("data1",data1);
                        
                            
                        if(data1.work_data.length > 0){
                            var wp_text = "";
                            for(var j=0;j<data1.work_data.length;j++){
                            
                                wp_text += "<li data-value='"+data1.work_data[j].prefer_id+"'>"+data1.work_data[j].env_name+"</li>"; 
                            
                            }
                            
                            $('.js-example-basic-multiple'+k+l+'[data-list-id="subwork_field-'+k+l+'"]').removeAttr("name");
                            
                            
                            var ap = "";
                            $(".showsubwpdata-"+k+l).append('\<div class="subpworkdiv subpworkdiv-'+data1.subplace_id+' form-group level-drp">\
                                <label class="form-label pwork_label pwork_label-'+k+data1.subplace_id+'" for="input-1">'+data1.env_name+'</label>\
                                <input type="hidden" name="subpwork" class="subpwork subpwork-'+data1.subplace_id+'" value="'+k+'">\
                                <input type="hidden" name="subpwork_list" class="subpwork_list subpwork_list-'+k+'" value="'+data1.subplace_id+'">\
                                <ul id="subpwork_field-'+k+data1.subplace_id+'" style="display:none;">'+wp_text+'</ul>\
                                <select class="js-example-basic-multiple'+k+data1.subplace_id+' addAll_removeAll_btn pwork_valid-'+k+' pwork_valid-'+k+data1.subplace_id+'" data-list-id="subpwork_field-'+k+data1.subplace_id+'" name="subworkthlevel['+k+']['+l+']['+data1.subplace_id+'][]" multiple></select>\
                                <span id="reqsubpwork-'+k+data1.subplace_id+'" class="reqError text-danger valley"></span>\
                            </div>');

                            let $fields = $(".showsubwpdata-"+k+l+" .subpworkdiv");

                            let sortedFields = $fields.sort(function (a, b) {
                                return $(a).find(".pwork_label").text().localeCompare($(b).find(".pwork_label").text());
                            });

                            $(".showsubwpdata-"+k+l).append(sortedFields);

                            selectTwoFunction(k+data1.subplace_id);
                        }
                    }    
                });            
            }
        }
    }
    
    function selectTwoFunction(select_id) {

      let $select = $('.js-example-basic-multiple' + select_id);

      // === 1️⃣ Initialize ONLY if not already initialized ===
      if ($select.data('select2')) {
          return; // VERY IMPORTANT: stops re-init
      }

      // === 2️⃣ Load options from UL (clone per dropdown) ===
      let listId = $select.data('list-id');
      let items = [];

      $('#' + listId + ' li').each(function() {
          items.push({
              id: $(this).data('value'),
              text: $(this).text()
          });
      });

      // === 3️⃣ Initialize Select2 (ONLY ON THIS DROPDOWN) ===
      $select.select2({
          data: items,
          width: '100%',
          closeOnSelect: true
      });

      // === 4️⃣ Add Select All / Remove All buttons (SCOPED) ===
      $select.on('select2:open', function() {
          let $dropdown = $(this);

          let buttons = `
          <div class="extra-buttons">
              <button class="select-all-button" type="button">Select All</button>
              <button class="remove-all-button" type="button">Remove All</button>
          </div>
          `;

          $('.select2-results .extra-buttons').remove();
          $('.select2-results').prepend(buttons);

          $('.select-all-button').off('click').on('click', function() {
              let allValues = $dropdown.find('option').map(function() {
                  return $(this).val();
              }).get();
              $dropdown.val(allValues).trigger('change');
          });

          $('.remove-all-button').off('click').on('click', function() {
              $dropdown.val(null).trigger('change');
          });
      });

      // === 5️⃣ Add search box (SCOPED) ===
      $select.on('select2:open', function() {

          let searchBoxHtml = `
          <div class="extra-search-container">
              <input type="text" class="extra-search-box" placeholder="Search...">
              <button class="clear-button" type="button">&times;</button>
          </div>
          `;

          if ($('.select2-results').find('.extra-search-container').length === 0) {
              $('.select2-results').prepend(searchBoxHtml);
          }

          $('.extra-search-box').off('input').on('input', function() {
              let searchTerm = $(this).val().toLowerCase();

              $('.select2-results__option').each(function() {
                  let text = $(this).text().toLowerCase();
                  $(this).toggle(text.includes(searchTerm));
              });
          });

          $('.clear-button').off('click').on('click', function() {
              $('.extra-search-box').val('').trigger('input');
          });
      });

      // === 6️⃣ Clear button PER DROPDOWN (not global) ===
      let clearButton = $('<span class="clear-btn">✖</span>');
      $select.next('.select2').append(clearButton);

      function toggleClearButton() {
          let val = $select.val();
          clearButton.toggle(!!(val && val.length));
      }

      $select.on('change', toggleClearButton);
      clearButton.on('click', function() {
          $select.val(null).trigger('change');
          toggleClearButton();
      });

      toggleClearButton();
    }

    function getAccreditationFields(ap,next_values){

      if(ap == ''){
        var selectedValues = $('.js-example-basic-multiple[data-list-id="accreditations_data-'+next_values+'"]').val();
      }else{
        var selectedValues = $('.js-example-basic-multiple_acc-'+next_values+'[data-list-id="accreditations_data-'+next_values+'"]').val();
      }
      

      $(".accreditions_data-"+next_values+" .subaccredition_list-"+next_values).each(function(i,val){
          var val1 = $(val).val();
          console.log("val",val1);
          if(selectedValues.includes(val1) == false){
              $(".accredition_main_div-"+next_values+val1).remove();
              
          }
      });

      for(var i=0;i<selectedValues.length;i++){
        if($(".accreditions_data-"+next_values+" .accredition_main_div-"+next_values+selectedValues[i]).length < 1){
          $.ajax({
              type: "GET",
              url: "{{ url('/healthcare-facilities/getAccreditationsData') }}",
              data: {id:selectedValues[i]},
              cache: false,
              success: function(data){
                  var data1 = JSON.parse(data);
                  console.log("data1",data1);

                  var accreditation_text = "";
                  for(var j=0;j<data1.accreditation_data.length;j++){
                  
                      accreditation_text += "<li data-value='"+data1.accreditation_data[j].id+"'>"+data1.accreditation_data[j].name+"</li>"; 
                  
                  }

                  
                  if(data1.accreditation_id != 6){
                    var ap = "ap";
                    $(".accreditions_data-"+next_values).append('\<div class="accredition_main_div accredition_main_div-'+next_values+data1.accreditation_id+'"><div class="subaccreditiondiv subaccreditiondiv-'+next_values+data1.accreditation_id+' form-group level-drp">\
                        <label class="form-label accredition_label accredition_label-'+next_values+data1.accreditation_id+'" for="input-1">'+data1.accreditation_name+'</label>\
                        <input type="hidden" name="subaccredition" class="subaccredition subaccredition-'+next_values+data1.accreditation_id+'" value="">\
                        <input type="hidden" name="subaccredition_list" class="subaccredition_list-'+next_values+'" value="'+data1.accreditation_id+'">\
                        <ul id="subaccredition_field-'+next_values+data1.accreditation_id+'" style="display:none;">'+accreditation_text+'</ul>\
                        <select class="js-example-basic-multiple'+next_values+data1.accreditation_id+' addAll_removeAll_btn accredition_valid accredition_valid-'+next_values+data1.accreditation_id+'" data-list-id="subaccredition_field-'+next_values+data1.accreditation_id+'" name="subaccreditation_data['+next_values+']['+data1.accreditation_id+'][]" multiple></select>\
                        <span id="reqsubaccredition-'+data1.accreditation_id+'" class="reqError text-danger valley"></span>\
                        </div><div class="showsubwpaccreditiondata showsubaccreditiondata-'+next_values+data1.accreditation_id+'"></div></div>');

                    
                    selectTwoFunction(next_values+data1.accreditation_id);
                  }else{
                    $(".accreditions_data").append('\<div class="accredition_main_div accredition_main_div-'+next_values+data1.accreditation_id+'"><div class="subaccreditiondiv subaccreditiondiv-'+next_values+data1.accreditation_id+' form-group level-drp">\
                      <label class="form-label accredition_label accredition_label-'+next_values+data1.accreditation_id+'" for="input-1">Other</label>\
                      <input type="hidden" name="subaccredition" class="subaccredition subaccredition-'+selectedValues[i]+'" value="">\
                      <input type="hidden" name="subaccredition_list" class="subaccredition_list" value="'+data1.accreditation_id+'">\
                      <input type="text" name="other_text" class="other_text">\
                      <span id="reqsubaccredition-'+selectedValues[i]+'" class="reqError text-danger valley"></span>\
                      </div><div class="showsubwpaccreditiondata showsubaccreditiondata-'+selectedValues[i]+'"></div></div>');
                  }
              }    
          });
        }    
      }
    }

    function getStates(value,location_no){
      console.log("value",value);
      console.log("location_no",location_no);
      $.ajax({
        type: "get",
        url: "{{ route('medical-facilities.getStates') }}",
        
        data: {country_code_value:value},
        success: function(data) {
            if(data != ""){
                var state_data = JSON.parse(data);
                console.log("state_data",state_data);
                var job_state = '';
                
                for(var i = 0;i<state_data.length;i++){
                    var job_selected_state = '<?php echo $user_data->site_data; ?>';
                    if(job_selected_state != ""){
                      var job_selected_state = JSON.parse(job_selected_state);

                      var sitesArray = Object.values(job_selected_state);

                      //console.log("job_selected_state",state_data);
                      console.log("job_selected_state",sitesArray[location_no-1].state);
                      if(state_data[i].id == sitesArray[location_no-1].state){
                        var selected_text = 'selected';
                      }else{
                        var selected_text = '';
                      }
                    }else{
                      var selected_text = '';
                    }
                    
                    job_state += '<option value='+state_data[i].id+' '+selected_text+'>'+state_data[i].name+'</option>';
                    
                }
                $(".job_state-"+location_no).html('<option value="">Select</option>'+job_state);
                //console.log("state_name",data.name);
            }
        }
      });  
    }

    function update_profile_form() {
      var isValid = true;

      if ($('.facility_name').val() == '') {

        document.getElementById("reqfacility_name").innerHTML = "* Please enter the Facility Name";
        isValid = false;

      }

      if ($('.sector_preferences').val() == '') {

        document.getElementById("reqsector_preferences").innerHTML = "* Please select the Sector Preferences";
        isValid = false;

      }

      if ($('.facworktype-1').val() == '') {
        
        document.getElementById("reqfacworktype").innerHTML = "* Please select the Facility Services & Care Areas";
        isValid = false;

      }

      if ($('.country_dropdown').val() == '') {
        
        document.getElementById("reqcountry").innerHTML = "* Please select the Operating Country";
        isValid = false;

      }

      var i = 1;
      $(".location_site_name").each(function(){

        if ($('.site_name-'+i).val() == '') {
        
          document.getElementById("reqsite_name-"+i).innerHTML = "* Please enter the site name";
          isValid = false;

        }

        if ($('.address-'+i).val() == '') {
        
          document.getElementById("reqaddress-"+i).innerHTML = "* Please enter the address (street/suburb/city)";
          isValid = false;

        }

        if ($('.state-'+i).val() == '') {
        
          document.getElementById("reqstate-"+i).innerHTML = "* Please select the state/region (country-specific)";
          isValid = false;

        }

        if ($('.post_code-'+i).val() == '') {
        
          document.getElementById("reqpost_code-"+i).innerHTML = "* Please enter the Postcode";
          isValid = false;

        }
        i++;
      });

      

      if (isValid == true) {
        $.ajax({
        url: "{{ route('medical-facilities.updateProfile') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#update_profile_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitProfile').prop('disabled', true);
          $('#submitProfile').text('Process....');
        },
        success: function(res) {
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Profile updated Successfully',
            }).then(function() {
              window.location.href = '';
              
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
          $('#submitProfile').prop('disabled', false);
          $('#submitProfile').text('Save Changes');
          console.log("errorss", errorss);
          
        }
      
        });
      }

      return false;
    }  

    if ($(".mainfactype-1").val() != "") {
      var mainfactype = JSON.parse($(".mainfactype-1").val());
      
      console.log("mainfactype",mainfactype);
      $('.js-example-basic-multiple[data-list-id="wp_data-1"]').select2().val(mainfactype).trigger('change');
      $(".subwork_list-1").each(function(){
        var subwork_list_val = $(this).val();
        if ($(".subworkjs-1"+subwork_list_val).val() != "") {
          
          var subfactype = JSON.parse($(".subworkjs-1"+subwork_list_val).val());
          
          console.log("subfactype",subfactype);
          $('.js-example-basic-multiple[data-list-id="subwork_field-1'+subwork_list_val+'"]').select2().val(subfactype).trigger('change');
          $(".subpwork_list-1").each(function(){
            var subwork_list_val = $(this).val();
            
            if ($(".subworkjs1-1"+subwork_list_val).val() != "") {
                
              var subfactype = JSON.parse($(".subworkjs1-1"+subwork_list_val).val());
              
              console.log("subfactype1",subfactype);
              $('.js-example-basic-multiple[data-list-id="subpwork_field-1'+subwork_list_val+'"]').select2().val(subfactype).trigger('change');
              
            }
            
          });
        }

        
        
      });  
    } 

    if ($(".show_emr_ehr").val() != "") {
      var show_emr_ehr = JSON.parse($(".show_emr_ehr").val());
      $('.js-example-basic-multiple[data-list-id="emr_ehr_data"]').select2().val(show_emr_ehr).trigger('change');
    }

    
    $(".accreditation_no").each(function(){
      var acc_val = $(this).val();
      if($(".acctype-"+acc_val).val() != ""){
        var acc_vals = JSON.parse($(".acctype-"+acc_val).val());  
        console.log("acc_vals",acc_vals);
        $('.js-example-basic-multiple[data-list-id="accreditations_data-'+acc_val+'"]').select2().val(acc_vals).trigger('change');

        $(".subaccredition_list-"+acc_val).each(function(){
          var subacc_val = $(this).val();
          if($(".subacctype-"+acc_val+subacc_val).val() != ""){
            var subacc_vals = JSON.parse($(".subacctype-"+acc_val+subacc_val).val());  
            console.log("acc_vals",subacc_vals);
            $('.js-example-basic-multiple[data-list-id="subaccredition_field-'+acc_val+subacc_val+'"]').select2().val(subacc_vals).trigger('change');
          }
          
        });
      }
      
    });
    
  </script>
@endsection