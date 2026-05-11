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

form#job_posting_form ul.select2-selection__rendered {
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

        @include('healthcare.layouts.job_sidebar')
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 col-12 right_content">
          <div class="content-single content_profile">
            

            <div class="tab-content">
                <?php $user_id=''; $i = 0;?>

                <div class="tab-pane fade" id="tab-my-profile-setting" style="display: block;opacity:1;">

                    
                    <div class="card shadow-sm border-0 p-4 mt-30">
                      @include('healthcare.layouts.top_links')
                      <h3 class="mt-0 color-brand-1 mb-2">Post a Job</h3>
    
                      <form id="job_posting_form" method="POST" onsubmit="return job_posting_form()">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::guard('healthcare_facilities')->user()->id }}">
                        <input type="hidden" name="job_id" value="{{ $job_id }}">
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Sector Preferences
                          </label>
                          <select class="form-input mr-10 select-active" name="sector_preferences" id="sector_preferences">
                            <option value="">select</option>
                            <option value="1" @if(!empty($job_data) && $job_data->sector == "1") selected @endif>Public & Government</option>
                            <option value="2" @if(!empty($job_data) && $job_data->sector == "2") selected @endif>Private</option>
                            <option value="3" @if(!empty($job_data) && $job_data->sector == "3") selected @endif>Public Government & Private</option>
                          </select>
                          <span id='reqsector_preferences' class='reqError text-danger valley'></span>
                        </div>
                        <div class="form-group drp--clr">
                          <label class="form-label" for="input-1">Type of Nurse?</label>
                          @php
                            $profession_nurse_id = (!empty($job_data))?(array)json_decode((string)$job_data->nurse_type_id):[];
                            $practitioner_data = DB::table("practitioner_type")->where("id",isset($profession_nurse_id[0])?$profession_nurse_id[0]:0)->first();
                            $mainnurse_json = (!empty($practitioner_data))?json_encode($practitioner_data->parent):'';
                            $subnurse_json = (!empty($job_data))?$job_data->nurse_type_id:'';

                            $profession_speciality_id = (!empty($job_data))?(array)json_decode((string)$job_data->typeofspeciality):[];
                            $speciality_data = DB::table("speciality")->where("id",isset($profession_speciality_id[0])?$profession_speciality_id[0]:0)->first();
                            $mainspeciality_json = (!empty($speciality_data))?json_encode((string)$speciality_data->parent):'';
                            
                            $subspeciality_json = (!empty($job_data))?$job_data->typeofspeciality:'';

                            $typeofspeciality = (array)$subspeciality_json;
                            
                          @endphp
                          <input type="hidden" name="nurse_type" class="nurse_type" value='@if(!empty($job_data)){{ $mainnurse_json }}@endif'>
                          <ul id="type-of-nurse-0" style="display:none;">
                            @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                            <?php
                            $j = 1;
                            ?>
                            <li data-value="0">select</li>
                            @foreach($specialty as $spl)
                            <li id="nursing_menus-{{ $j }}" data-value="{{ $spl->id }}">{{ $spl->name }}</li>
                            <?php
                            $j++;
                            ?>
                            @endforeach
                          </ul>

                          <select class="js-example-basic-multiple addAll_removeAll_btn nurse_type_field" data-list-id="type-of-nurse-0" name="nurseType[type_0][]" id="nurse_type" onchange="getNurseType('main',0)"></select>
                          <span id="reqnurseTypeId" class="reqError text-danger valley"></span>    
                        </div>    
                        <div class="showNurseType-0">

                      
                          @if(!empty($job_data) && $job_data->nurse_type_id != NULL) 
                          <div class="subnurse_main_div subnurse_main_div-{{ $practitioner_data->parent }}">
                              <?php
                                $np_data_name = DB::table("practitioner_type")->where('id', $practitioner_data->parent)->first();
                                $np_data = DB::table("practitioner_type")->where('parent', $practitioner_data->parent)->get();
                              ?>
                              <input type="hidden" name="subnursetype" class="subnursetype-{{ $practitioner_data->parent }}" value="{{ $subnurse_json }}">
                              <div class="subnurse_div subnurse_div-{{ $practitioner_data->parent }} form-group level-drp">
                              <label class="form-label subnurse_label subnurse_label-{{ $practitioner_data->parent }}" for="input-1">{{ $np_data_name->name }}</label>
                              <input type="hidden" name="subnurse_list" class="subnurse_list subnurse_list-{{ $practitioner_data->parent }}" value="{{ $practitioner_data->parent }}">
                              <ul id="type-of-nurse-{{ $practitioner_data->parent }}" style="display:none;">
                                @foreach($np_data as $nd)
                                <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                @endforeach
                              </ul>
                              <select class="js-example-basic-multiple subnurse_valid-{{ $practitioner_data->parent }} addAll_removeAll_btn" data-list-id="type-of-nurse-{{ $practitioner_data->parent }}" name="subnursetype" onchange="getNurseType('main',{{ $practitioner_data->parent }})"></select>
                              <span id="reqsubnursevalid-{{ $practitioner_data->parent }}" class="reqError text-danger valley"></span>
                              </div>
                              
                          </div>   
                          @endif      
                        
                        </div>
                        <div class="form-group drp--clr">
                          <label class="form-label" for="input-1">Primary Specialty</label>
                          <input type="hidden" name="speciality_type" class="speciality_type" value='@if(!empty($job_data)){{ $mainspeciality_json }}@endif'>
                          <ul id="speciality_preferences-primary-0" style="display:none;">
                            @php $JobSpecialties = JobSpecialties(); @endphp
                            <li data-value="0">select</li>
                            <?php
                            $k = 1;
                            ?>
                            @foreach($JobSpecialties as $ptl)
                            <li id="nursing_menus-{{ $k }}" data-value="{{ $ptl->id }}">{{ $ptl->name }}</li>
                            <?php
                            $k++;
                            ?>
                            @endforeach
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn speciality_type_field" data-list-id="speciality_preferences-primary-0" name="nurseType[]" onchange="getSecialities('main',0,'primary','')"></select>
                          <span id="reqspecialties" class="reqError text-danger valley"></span>
                        </div>
                        
                        <div class="show_specialities-primary-0">
                          @if(!empty($job_data) && $job_data->typeofspeciality != NULL) 
                          <?php
                            $sp_data_name = DB::table("speciality")->where('id', $speciality_data->parent)->first();
                            $sp_data = DB::table("speciality")->where('parent', $speciality_data->parent)->get();
                          ?>
                          <div class="subspec_main_div subspec_main_div-primary-{{ $speciality_data->parent }}">
                            <div class="subspec_div subspec_div-{{ $speciality_data->parent }} form-group level-drp">
                              <input type="hidden" name="subspecialitytype" class="subspecialitytype-{{ $speciality_data->parent }}" value="{{ $subspeciality_json }}">
                              <label class="form-label subspec_label subspec_label-{{ $speciality_data->parent }}" for="input-1">{{ $sp_data_name->name }}</label>
                              <input type="hidden" name="subspec_list" class="subspec_list-primary subspec_list-primary-{{ $speciality_data->parent }}" value="{{ $speciality_data->parent }}">
                              <ul id="speciality_preferences-primary-{{ $speciality_data->parent }}" style="display:none;">
                                <li data-value="0">select</li>
                                <?php
                                $k = 1;
                                ?>
                                @foreach($sp_data as $ptl)
                                <li id="nursing_menus-{{ $k }}" data-value="{{ $ptl->id }}">{{ $ptl->name }}</li>
                                <?php
                                $k++;
                                ?>
                                @endforeach
                              </ul>
                              <select class="js-example-basic-multiple subspec_valid-primary' subspec_valid-{{ $speciality_data->parent }} addAll_removeAll_btn" name="subspeciality[primary][{{ $speciality_data->parent }}][]" data-list-id="speciality_preferences-primary-{{ $speciality_data->parent }}" id="subspecialities" onchange="getSecialities('main',{{ $speciality_data->parent }},'primary','')"></select>
                              <span id="reqsubspecvalid-primary" class="reqError text-danger valley"></span>
                            </div>
                            <div class="subspec_level-{{ $speciality_data->parent }}"></div>
                            <div class="show_specialities-primary-{{ $speciality_data->parent }}"></div>
                            <div class="show_specialities_experience-primary-{{ $typeofspeciality[0] }}">
                              <div class="subexper_div subexper_div-{{ $typeofspeciality[0] }}">
                                <div class="custom-select-wrapper form-group level-drp">
                                  <label class="form-label" for="input-1">Minimum Specialty Experience
                                  </label>
                                  <input type="hidden" name="subspecprof_list" class="subspecprof_list  subspecprof_listProfession subspecprof_listProfession-{{ $typeofspeciality[0] }} subspecprof_list-'+k+'" value="{{ $typeofspeciality[0] }}">
                                  <select class="custom-select experience_level-{{ $typeofspeciality[0] }}" name="speciality_experience">
                                    <option value="">Please Select</option>
                                    @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}" @if($job_data->experience_level == $i) selected @endif>{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                                                @endfor
                                  </select>
                                  <span id="reqassistentlevel{{ $typeofspeciality[0] }} class="reqError text-danger valley"></span>
                                  <div class="experience_helper">Set 0 for Graduate or Transition roles.Tick “Willing to upskill” if you’ll consider near-fit candidates.</div>
                                </div>
                              </div>
                            </div>
                          </div>

                          @endif
                        </div>
                        <div class="declaration_box mt-2 mb-2">
                          <input class="currently_position currently_position" name="willing_upskill" type="checkbox" @if(!empty($job_data) && $job_data->willing_to_upskill == 1) checked @endif>Willing to Upskill
                        </div>
                        <div class="experience_helper">Facility is open to candidates who do not yet meet the minimum specialty experience and can provide orientation or training.</div>
                        <div class="form-group drp--clr">
                          <label class="form-label" for="input-1">Secondary Specialty</label>
                          @php
                            $secondary_speciality = (!empty($job_data))?(array)json_decode($job_data->secondary_speciality):[];

                            $sec_spec_arr = [];
                            foreach($secondary_speciality as $index=>$sec_speciality){
                              $sec_spec_arr[] = $index;
                            }
                            //print_r($sec_spec_arr);


                          @endphp
                          <input type="hidden" name="sec_spec" class="sec_spec" value="{{ json_encode($sec_spec_arr) }}">
                          <ul id="speciality_preferences-secondary-0" style="display:none;">
                            @php $JobSpecialties = JobSpecialties(); @endphp
                            
                            <?php
                            $k = 1;
                            ?>
                            @foreach($JobSpecialties as $ptl)
                            <li id="nursing_menus-{{ $k }}" data-value="{{ $ptl->id }}">{{ $ptl->name }}</li>
                            <?php
                            $k++;
                            ?>
                            @endforeach
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn secondary_specialities" data-list-id="speciality_preferences-secondary-0" name="nurseType[]" multiple onchange="getSecialities('main',0,'secondary','multiple')"></select>
                          <span id="reqsecondaryspecialties" class="reqError text-danger valley"></span>
                          <div class="experience_helper">Secondary specialties are considered a plus, not a requirement.</div>
                        </div>
                        <div class="show_specialities-secondary-0">
                          @foreach($sec_spec_arr as $sec_arr)
                          <?php
                            $sp_data_name = DB::table("speciality")->where('id', $sec_arr)->first();
                            $sp_data = DB::table("speciality")->where('parent', $sec_arr)->get();
                            $sec_spec = json_encode($secondary_speciality[$sec_arr]);
                            //print_r($sec_spec);
                          ?>
                          <div class="subspec_main_div subspec_main_div-secondary-{{ $sec_arr }}">
                            <div class="subspec_div subspec_div-{{ $sec_arr }} form-group level-drp">
                            <label class="form-label subspec_label subspec_label-{{ $sec_arr }}" for="input-1">{{ $sp_data_name->name }}</label>
                            <input type="hidden" name="subspec_list" class="subspec_list-secondary subspec_list-secondary-{{ $sec_arr }}" value="{{ $sec_arr }}">
                            <input type="hidden" name="subspecialitytype" class="subspecialitysecondarytype-{{ $sec_arr }}" value="{{ $sec_spec }}">
                            <ul id="speciality_preferences-secondary-{{ $sec_arr }}" style="display:none;">
                              <?php
                              $k = 1;
                              ?>
                              @foreach($sp_data as $ptl)
                              <li id="nursing_menus-{{ $k }}" data-value="{{ $ptl->id }}">{{ $ptl->name }}</li>
                              <?php
                              $k++;
                              ?>
                              @endforeach

                            </ul>
                            <select class="js-example-basic-multiple subspec_valid-secondary-{{ $sec_arr }}' subspec_valid-{{ $index }} addAll_removeAll_btn" name="subspeciality[secondary][{{ $sec_arr }}][]" data-list-id="speciality_preferences-secondary-{{ $sec_arr }}" id="subspecialities" onchange="getSecialities('main',{{ $sec_arr }},'secondary','multiple')" multiple></select>
                            <span id="reqsubspecvalid-{{ $sec_arr }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="subspec_level-{{ $sec_arr }}"></div>
                            <div class="show_specialities-secondary-{{ $sec_arr }}"></div>
                            
                          </div>
                          @endforeach
                        </div>
                        
                        <div class="form-group level-drp">
                          
                            <label class="form-label" for="input-1">Work Environment Preferences</label>
                            <?php
                                
                                $workplace_data = DB::table('work_enviornment_preferences')->where("sub_env_id",0)->orderBy("env_name","asc")->get();
                                
                                if(!empty($job_data)){
                                  $facility_type = (array)json_decode($job_data->work_environment);
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
                        <div class="form-group">
                          <label class="form-label" for="input-1">Job Title</label>
                          
                          <input class="form-control job_title" type="text" name="job_title"  value="@if(!empty($job_data)){{ $job_data->job_title }}@endif">
                          <span id="reqotherjob_title" class="reqError text-danger valley"></span>
                        </div>
                        <div class="form-group">
                          <label class="form-label" for="input-1">Positions Open</label>
                          
                          <input class="form-control position_open" type="number" name="position_open" value="@if(!empty($job_data)){{ $job_data->position_open }}@endif">
                          <span id="reqposition_open" class="reqError text-danger valley"></span>
                        </div>
                        
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitJobPosting">Save Changes</button>
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

    function getOrdinalSuffix(i) {
      if (i % 100 >= 11 && i % 100 <= 13) {
          return 'th';
      }
      switch (i % 10) {
          case 0: return '';
          case 1: return 'st';
          case 2: return 'nd';
          case 3: return 'rd';
          default: return 'th';
      }
    }

    function getNurseType(level,k){
      //alert("hello");

      if(level == "main"){
        var selectedValues1 = $('.js-example-basic-multiple[data-list-id="type-of-nurse-'+k+'"]').val();
      }else{
        var selectedValues1 = $('.js-example-basic-multiple'+k+'[data-list-id="type-of-nurse-'+k+'"]').val();
      }
      
      

      let selectedValues = Array.isArray(selectedValues1) ? selectedValues1 : [selectedValues1];

      console.log("selectedValues",selectedValues1);


      $(".showNurseType-"+k+" .subnurse_list").each(function(i,val){
          var val1 = $(val).val();
          console.log("val",val1);
          if(selectedValues.includes(val1) == false){
            $(".showNurseType-" + k).find(".subnurse_main_div-" + val1).remove();
              
          }
      });
      
      $(".subspecnurse_list").each(function () {

          var val1 = $(this).val();
          console.log("selectedValues_status", selectedValues);
          console.log("val1_specStatus", val1);
          if(selectedValues.includes(val1) == false){

            
            $(".showNurseSpeciality-" + k)
            .find(".nurse_specialities-" + val1)
            .remove();
            
          }
      });

      for(var i=0;i<selectedValues.length;i++){
        if($(".showNurseType-"+k+" .subnurse_main_div-"+selectedValues[i]).length < 1){
          $.ajax({
            type: "GET",
            url: "{{ url('/nurse/getNurseDatas') }}",
            data: {nurse_id:selectedValues[i]},
            cache: false,
            success: function(data){
              var data1 = JSON.parse(data);
              console.log("data1",data1);

              var nurse_text = "";
              for(var j=0;j<data1.sub_nurse_data.length;j++){
                
                nurse_text += "<li data-value='"+data1.sub_nurse_data[j].id+"'>"+data1.sub_nurse_data[j].name+"</li>"; 
                
              }
              var sub = 'sub';
              var experience_text = "";
              for(var i=1;i<=30;i++){
                experience_text += "<option value='" + i + "'>" + i + getOrdinalSuffix(i) + " Year</option>";
              }

              if(data1.sub_nurse_data.length > 0){
                
                $(".showNurseType-"+k).append('\<div class="subnurse_main_div subnurse_main_div-'+data1.main_nurse_id+'">\
                              <div class="subnurse_div subnurse_div-'+data1.main_nurse_id+' form-group level-drp">\
                              <label class="form-label subnurse_label subnurse_label-'+data1.main_nurse_id+'" for="input-1">'+data1.main_nurse_name+'</label>\
                              <input type="hidden" name="subnurse_list" class="subnurse_list subnurse_list-'+data1.main_nurse_id+'" value="'+data1.main_nurse_id+'">\
                              <ul id="type-of-nurse-'+data1.main_nurse_id+'" style="display:none;">\
                              <li data-value="0">select</li>\
                              '+nurse_text+'</ul>\
                              <select class="js-example-basic-multiple'+data1.main_nurse_id+' subnurse_valid subnurse_valid-'+data1.main_nurse_id+' addAll_removeAll_btn" data-list-id="type-of-nurse-'+data1.main_nurse_id+'" name="subnursetype" id="subnursetype" onchange="getNurseType(\''+sub+'\',\''+data1.main_nurse_id+'\')"></select>\
                              <span id="reqsubnursevalid" class="reqError text-danger valley"></span>\
                              </div>\
                              <div class="subnurse_level-'+data1.main_nurse_id+'"></div>\
                              <div class="showNurseType-'+data1.main_nurse_id+'"></div>\
                              <div class="showNurseSpeciality-'+data1.main_nurse_id+'"></div>\
                              </div>\
                              ');
                selectTwoFunction(data1.main_nurse_id);
                              
              }

              
              
            }
          });
        }
      }
    }

    function updateJobTitle() {
      let nurseTypeText = $('#subnursetype option:selected').text();
      let specialityText = $('#subspecialities option:selected').text();

      if (
          $('#nurse_type').val() !== '' &&
          $('#subspecialities').val() !== ''
      ) {
          // Remove abbreviation if needed
          nurseTypeText = nurseTypeText.replace(/\s*\(.*?\)/g, '');

          $('.job_title').val(nurseTypeText + ' – ' + specialityText);
      } else {
          $('.job_title').val('');
      }
    }

    function getSecialities(level,k,specialities_type,multiple){
      // alert();

      if(level == "main"){
        var selectedValues1 = $('.js-example-basic-multiple[data-list-id="speciality_preferences-'+specialities_type+"-"+k+'"]').val();
      }else{
        var selectedValues1 = $('.js-example-basic-multiple'+specialities_type+'-'+k+'[data-list-id="speciality_preferences-'+specialities_type+"-"+k+'"]').val();
        updateJobTitle();
      }
      
      let selectedValues = Array.isArray(selectedValues1) ? selectedValues1 : [selectedValues1];
    
      console.log("selectedValues",selectedValues1);

      $(".show_specialities-"+specialities_type+"-"+k+" .subspec_list-"+specialities_type).each(function(i,val){
          var val1 = $(val).val();
          console.log("subspec_listval",val1);
          if(selectedValues.includes(val1) == false){
            $(".subspec_main_div-"+specialities_type+'-'+val1).remove();
              
          }
      });

      $(".subspecprofpart_list-"+specialities_type+"-"+k).each(function () {
            
          var val1 = $(this).val();
          console.log("selectedValues_status", selectedValues);
          console.log("val1_specStatus", val1);
          if(selectedValues.includes(val1) == false){

            
            $(".subexper_div-"+val1).remove();
            
          }
      });

      for(var i=0;i<selectedValues.length;i++){
        
        if($(".show_specialities-"+specialities_type+"-"+k+" .subspec_main_div-"+specialities_type+'-'+selectedValues[i]).length < 1){
          
          $.ajax({
            type: "GET",
            url: "{{ url('/nurse/getSpecialityDatas1') }}",
            data: {speciality_id:selectedValues[i]},
            cache: false,
            success: function(data){
              var data1 = JSON.parse(data);
              console.log("data1",data1);

              var speciality_text = "";
              for(var j=0;j<data1.sub_spciality_data.length;j++){
                
                speciality_text += "<li data-value='"+data1.sub_spciality_data[j].id+"'>"+data1.sub_spciality_data[j].name+"</li>"; 
                
              }

              
              
              var sub = 'sub';

              


              if(data1.sub_spciality_data.length > 0){
                if(specialities_type == 'primary'){
                  var select_text = '<li data-value="0">select</li>';
                  var valid_text = '<span id="reqsubspecvalid-'+specialities_type+'" class="reqError text-danger valley"></span>';
                  var class_text = '';  
                }else{
                  var select_text = '';
                  var valid_text = '<span id="reqsubspecvalid-'+data1.main_speciality_id+'" class="reqError text-danger valley"></span>';
                  var class_text = '-'+data1.main_speciality_id;  
                }
                $(".show_specialities-"+specialities_type+"-"+k).append('\<div class="subspec_main_div subspec_main_div-'+specialities_type+'-'+data1.main_speciality_id+'">\
                              <div class="subspec_div subspec_div-'+data1.main_speciality_id+' form-group level-drp">\
                              <label class="form-label subspec_label subspec_label-'+data1.main_speciality_id+'" for="input-1">'+data1.main_speciality_name+'</label>\
                              <input type="hidden" name="subspec_list" class="subspec_list-'+specialities_type+' subspec_list-'+specialities_type+"-"+data1.main_speciality_id+'" value="'+data1.main_speciality_id+'">\
                              <ul id="speciality_preferences-'+specialities_type+"-"+data1.main_speciality_id+'" style="display:none;">\
                              '+select_text+'\
                              '+speciality_text+'</ul>\
                              <select class="js-example-basic-multiple'+specialities_type+"-"+data1.main_speciality_id+' subspec_valid-'+specialities_type+class_text+' subspec_valid-'+data1.main_speciality_id+' addAll_removeAll_btn" name="subspeciality['+specialities_type+']['+data1.main_speciality_id+'][]" data-list-id="speciality_preferences-'+specialities_type+"-"+data1.main_speciality_id+'" id="subspecialities" onchange="getSecialities(\''+sub+'\',\''+data1.main_speciality_id+'\',\''+specialities_type+'\',\''+multiple+'\')" '+multiple+'></select>\
                              '+valid_text+'\
                              </div>\
                              <div class="subspec_level-'+data1.main_speciality_id+'"></div>\
                              <div class="show_specialities-'+specialities_type+"-"+data1.main_speciality_id+'"></div>\
                              <div class="show_specialities_experience-'+specialities_type+"-"+data1.main_speciality_id+'"></div>\
                              </div>');

                              selectTwoFunction(specialities_type+"-"+data1.main_speciality_id);
              
              }else{

                var experience_text = "";
                for(var i=0;i<=30;i++){
                  experience_text += "<option value='" + i + "'>" + i + getOrdinalSuffix(i) + " Year</option>";
                }

                if ($(".subexper_div-" + data1.main_speciality_id).length === 0 && specialities_type == "primary") {

                  $(".show_specialities_experience-"+specialities_type+"-"+k).append('\<div class="subexper_div subexper_div-'+data1.main_speciality_id+'">\
                  <div class="custom-select-wrapper form-group level-drp">\
                    <label class="form-label" for="input-1">Minimum Specialty Experience\
                    </label>\
                    <input type="hidden" name="subspecprof_list" class="subspecprof_list subspecprofpart_list-'+specialities_type+"-"+k+' subspecprof_listProfession subspecprof_listProfession-'+data1.main_speciality_id+' subspecprof_list-'+k+'" value="'+data1.main_speciality_id+'">\
                    <select class="custom-select experience_level-'+data1.main_speciality_id+'" name="speciality_experience">\
                      <option value="">Please Select</option>\
                      '+experience_text+'\
                    </select>\
                    <span id="reqassistentlevel'+data1.main_speciality_id+'" class="reqError text-danger valley"></span>\
                    <div class="experience_helper">Set 0 for Graduate or Transition roles.Tick “Willing to upskill” if you’ll consider near-fit candidates.</div>\
                  </div>\
                </div>');

                }

              }

              
            }
          });
        }
      }
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

    function job_posting_form() {
      var isValid = true;

      if ($('#sector_preferences').val() == '') {

        document.getElementById("reqsector_preferences").innerHTML = "* Please select the Sector Preferences.";
        isValid = false;

      }

      if ($('.nurse_type_field').val() == '0') {
        
        document.getElementById("reqnurseTypeId").innerHTML = "* Please select the Type of Nurse?";
        isValid = false;

      }

      if ($('.subnurse_valid').val() == '0') {
        
        document.getElementById("reqsubnursevalid").innerHTML = "* Please select the Type of Nurse?";
        isValid = false;

      }

      if ($('.speciality_type_field').val() == '0') {
        
        document.getElementById("reqspecialties").innerHTML = "* Please select the Primary Specialty";
        isValid = false;

      }

      if ($('.subspec_valid-primary').val() == '0') {
        
        document.getElementById("reqsubspecvalid-primary").innerHTML = "* Please select the Primary Specialty";
        isValid = false;

      }

      // if ($('.secondary_specialities').val() == '') {
        
      //   document.getElementById("reqsecondaryspecialties").innerHTML = "* Please select the Secondary Specialties";
      //   isValid = false;

      // }

      // $(".subspec_list-secondary").each(function(){
      //   var secondary_val = $(this).val();
      //   if ($('.subspec_valid-secondary-'+secondary_val).val() == '') {
        
      //     document.getElementById("reqsubspecvalid-"+secondary_val).innerHTML = "* Please select the Secondary Specialties";
      //     isValid = false;

      //   }
      // });

      

      if ($('.facworktype-1').val() == '') {
        
        document.getElementById("reqfacworktype").innerHTML = "* Please select the Work Environment Preferences";
        isValid = false;

      }

      if ($('.job_title').val() == '') {
        
        document.getElementById("reqotherjob_title").innerHTML = "* Please enter the Job Title";
        isValid = false;

      }

      if ($('.position_open').val() == '') {
        
        document.getElementById("reqposition_open").innerHTML = "* Please enter the Positions Open";
        isValid = false;

      }

      if (isValid == true) {
        $.ajax({
        url: "{{ route('medical-facilities.updateBasicJobs') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#job_posting_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitJobPosting').prop('disabled', true);
          $('#submitJobPosting').text('Process....');
        },
        success: function(res) {
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Job Post Successfully',
            }).then(function() {
              const jobId = params.get("job_id");

              if(jobId){
                window.location.href = "{{ route('medical-facilities.job_posting') }}?job_id="+jobId;
                
              }else{
                window.location.href = "{{ route('medical-facilities.job_posting') }}";
              }
              

              var tab_name = sessionStorage.getItem("tab-one");
              if(tab_name != "job_description"){
                sessionStorage.setItem("tab-one","role_basics");
              }
              
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
          $('#submitJobPosting').prop('disabled', false);
          $('#submitJobPosting').text('Save Changes');
          console.log("errorss", errorss);
          
        }
      
        });
      }

      return false;
    }  

    if ($(".nurse_type").val() != "") {
      var nurse_type = JSON.parse($(".nurse_type").val());
      $('#nurse_type').select2().val(nurse_type).trigger('change');
    }

    $(".subnurse_list").each(function(){
      var subnurse_val = $(this).val();
      if ($(".subnursetype-"+subnurse_val).val() != "") {
        var nurse_type = JSON.parse($(".subnursetype-"+subnurse_val).val());
        console.log("nurse_type",nurse_type);
        $('.js-example-basic-multiple[data-list-id="type-of-nurse-'+subnurse_val+'"]').select2().val(nurse_type).trigger('change');
      }
    });

    if ($(".speciality_type").val() != "") {
      var speciality_type = JSON.parse($(".speciality_type").val());
      $('.speciality_type_field').select2().val(speciality_type).trigger('change');
    }

    $(".subspec_list-primary").each(function(){
      var subspec_list_primary = $(this).val();
      if ($(".subspecialitytype-"+subspec_list_primary).val() != "") {
        var subspecialitytype = JSON.parse($(".subspecialitytype-"+subspec_list_primary).val());
        console.log("subspecialitytype",subspecialitytype);
        $('.js-example-basic-multiple[data-list-id="speciality_preferences-primary-'+subspec_list_primary+'"]').select2().val(subspecialitytype).trigger('change');
      }
    });

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

    if ($(".sec_spec").val() != "") {
      var sec_spec = JSON.parse($(".sec_spec").val());
      $('.secondary_specialities').select2().val(sec_spec).trigger('change');
    }

    $(".subspec_list-secondary").each(function(){
      var secondary_speciality_val = $(this).val();

      if ($(".subspecialitysecondarytype-"+secondary_speciality_val).val() != "") {
        var sec_spec_secondary = JSON.parse($(".subspecialitysecondarytype-"+secondary_speciality_val).val());
        console.log("secondary_speciality_val",sec_spec_secondary);
        $('.js-example-basic-multiple[data-list-id="speciality_preferences-secondary-'+secondary_speciality_val+'"]').select2().val(sec_spec_secondary).trigger('change');
      }

    });
    
  </script>
@endsection