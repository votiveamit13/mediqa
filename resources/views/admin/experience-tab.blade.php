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

    .clear-btn{
        display: none;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />


<div class="container-fluid">
    <?php
    $sessid = ''; // Default value
    $expid = request()->route('id');
    if (Session::has('nurseemail')) {
        $email = Session::get('nurseemail');
        $post = DB::table("users")->where('email', $email)->first();
        if ($post) {
            $sessid = $post->id;
        }
    }

    ?>
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">@if(empty(!$expid)) {{'Edit Nurse' }} @else {{ 'Add Nurse' }} @endif</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted " href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">@if(empty(!$expid)) {{ 'Edit Nurse' }} @else {{ 'Add Nurse' }} @endif</li>
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

    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills nav-fill mt-4 tabs-feat" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ empty(!$expid) ? '' : 'disabled' }}"
                        href="{{ $expid ? route('admin.edit_nurse', ['id' => $expid, 'tab' => 'tab-1']) : '#tab-1' }}"
                        aria-selected="true">
                        <span>Basic Details</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ empty(!$expid) ? '' : 'disabled' }}" href="{{ $expid ? route('admin.edit_nurse', ['id' => $expid, 'tab' => 'tab-2']) : '#tab-2' }}" aria-selected="false"
                        tabindex="-1">
                        <span>Setting & Availability</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ empty(!$expid) ? '' : 'disabled' }}" href="{{ $expid ? route('admin.edit_nurse', ['id' => $expid, 'tab' => 'tab-2']) : '#tab-2' }}" aria-selected="false"
                        tabindex="-1">
                        <span>Registrations and Licences</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ empty(!$expid) ? '' : 'disabled' }}" href="{{ $expid ? route('admin.edit_nurse', ['id' => $expid, 'tab' => 'tab-3']) : '#tab-3' }}" aria-selected="false"
                        tabindex="-1">
                        <span>Profession</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ empty(!$expid) ? '' : 'disabled' }}" href="{{ $expid ? route('admin.edit_nurse', ['id' => $expid, 'tab' => 'tab-4']) : '#tab-4' }}" aria-selected="false"
                        tabindex="-1">
                        <span>Education and Certifications</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ empty(!$expid) ? '' : 'disabled' }}" href="{{ $expid ? route('admin.edit_nurse', ['id' => $expid, 'tab' => 'tab-6']) : '#tab-6' }}" aria-selected="false"
                        tabindex="-1">
                        <span>Mandatory Training</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('admin.exptab', ['tab' => 'tab-7']) }}" tabindex="-1">
                        <span>Experience</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ empty(!$expid) ? '' : 'disabled' }}" href="{{ $expid ? route('admin.edit_nurse', ['id' => $expid, 'tab' => 'navpill-5.1']) : '#navpill-5.1' }}" aria-selected="false"
                        tabindex="-1">
                        <span>References</span>
                    </a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ empty(!$expid) ? '' : 'disabled' }}" href="{{ $expid ? route('admin.edit_nurse', ['id' => $expid, 'tab' => 'navpill-7']) : '#navpill-7' }}" aria-selected="false"
                        tabindex="-1">
                        <span>Vaccinations</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ empty(!$expid) ? '' : 'disabled' }}" href="{{ $expid ? route('admin.edit_nurse', ['id' => $expid, 'tab' => 'navpill-8']) : '#navpill-8' }}" aria-selected="false"
                        tabindex="-1">
                        <span>Work Clearances</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ empty(!$expid) ? '' : 'disabled' }}" href="{{ $expid ? route('admin.edit_nurse', ['id' => $expid, 'tab' => 'navpill-9']) : '#navpill-9' }}" aria-selected="false"
                        tabindex="-1">
                        <span>Professional Memberships & Awards</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ empty(!$expid) ? '' : 'disabled' }}" href="{{ $expid ? route('admin.edit_nurse', ['id' => $expid, 'tab' => 'navpill-10']) : '#navpill-10' }}" aria-selected="false"
                        tabindex="-1">
                        <span>Language Skills</span>
                    </a>
                </li>
                
            </ul>

            <!-- Tab panes -->
            <div class="tab-content border mt-2">
                <div class="p-3">
                    <form id="experience_form" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $expid }}" id="expid">
                        <input type="hidden" name="tab" value="tab4">
                        <div class="row">
                            <div class="w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Experience</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <h6>Please add your full nursing work experience to strengthen your profile and get hired faster. Please keep update as your experience grows:</h6>
                                            <div class="previous_employeers">
                                                <input type="hidden" value="@if($experienceData) {{ count($experienceData) }}  @endif {{ '1'}}" id="exp_data_count">
                                                <input type="hidden" name="user_id" value="{{ $experienceData[0]->user_id }}">
                                                <div class="">
                                                    <?php
                                                    $i = 1;
                                                    ?>
                                                    @if($experienceData != "")
                                                    @foreach($experienceData as $data)
                                                    <input type="hidden" name="exp_id[{{$i}}]" value="{{ $data->experience_id }}">
                                                    
                                                    <div class="work_exp exp_tab exp_tab-{{$i}}">
                                                        <h6 class="fw-bolder fs-6 lh-base d-flex align-items-center emergency_text previous_employeers_head">
                                                            Work Experience {{ $i }}
                                                        </h6>
                                                        <div class="form-group level-drp">
                          
                                                            <label class="form-label" for="input-1">Facility / Workplace Type</label>
                                                            <?php
                                                                $user_id = Auth::guard('nurse_middle')->user()->id;
                                                                $workplace_data = DB::table('work_enviornment_preferences')->where("prefer_id","!=","444")->where("sub_env_id",0)->orderBy("env_name","asc")->get();
                                                                $facility_type = (array)json_decode($data->facility_workplace_type);

                                                                //print_r($facility_type);

                                                                $p_memb_arr = array();

                                                                if(!empty($facility_type)){
                                                                foreach ($facility_type as $index => $p_memb) {
                                                                
                                                                    //print_r($p_memb);
                                                                    $p_memb_arr[] = $index;
                                                                    
                                                                }
                                                                }

                                                                $p_memb_json = json_encode($p_memb_arr);
                                                                
                                                            ?>
                                                            <input type="hidden" name="mainfactype" class="mainfactype mainfactype-{{ $i }}" value="{{ $p_memb_json }}">
                                                            <ul id="wp_data-{{ $i }}" style="display:none;">
                                                            
                                                                @if(!empty($workplace_data))
                                                                @foreach($workplace_data as $wp_data)
                                                                <li data-value="{{ $wp_data->prefer_id }}">{{ $wp_data->env_name }}</li>
                                                                @endforeach
                                                                @endif
                                                            </ul>
                                                            <select class="js-example-basic-multiple addAll_removeAll_btn facworktype facworktype-{{ $i }}" data-list-id="wp_data-{{ $i }}" name="positions_held[{{ $i }}]" onchange="getWpData('',{{ $i }})" multiple></select>
                                                            <span id="reqfacworktype-{{$i}}" class="reqError text-danger valley"></span>
                                                        
                                                        </div>
                                                        <div class="wp_data-{{ $i }}">
                                                            @foreach ($p_memb_arr as $p_arr)
                                                            <?php
                                                                $subface_data = (array)$facility_type[$p_arr];
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
                                                            <div class="wp_main_div-{{ $p_arr }}"><div class="subworkdiv subworkdiv-{{ $p_arr }} form-group level-drp">
                                                                <label class="form-label work_label work_label-{{ $i }}{{ $p_arr }}" for="input-1">@if(!empty($environment_name)){{ $environment_name->env_name }}@endif</label>
                                                                <input type="hidden" name="subwork" class="subwork subwork-{{ $p_arr }}" value="{{ $i }}">
                                                                <input type="hidden" name="subwork_list" class="subwork_list subwork_list-{{ $i }}" value="{{ $p_arr }}">
                                                                <input type="hidden" name="subworkjs" class="subworkjs-{{ $i }} subworkjs-{{ $i }}{{ $p_arr }}" value="{{ $p_memb_json }}">
                                                                <ul id="subwork_field-{{ $i }}{{ $p_arr }}" style="display:none;">
                                                                @if(!empty($environment_list))
                                                                @foreach($environment_list as $env_list)
                                                                <li data-value="{{ $env_list->prefer_id }}">{{ $env_list->env_name }}</li>
                                                                
                                                                @endforeach
                                                                @endif
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn work_valid-{{ $i }} work_valid-{{ $i }}{{ $p_arr }}" data-list-id="subwork_field-{{ $i }}{{ $p_arr }}" name="subworkthlevel[{{ $i }}][{{ $p_arr }}][]" onchange="getWpSubData('',{{ $i }},{{ $p_arr }})" multiple></select>
                                                                <span id="reqsubwork-{{ $i }}{{ $p_arr }}" class="reqError text-danger valley"></span>
                                                                </div>
                                                                <div class="showsubwpdata showsubwpdata-{{ $i }}{{ $p_arr }}">
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
                                                                    <label class="form-label pwork_label pwork_label-{{ $i }}{{ $p_arr1 }}" for="input-1">{{ $environment_name->env_name }}</label>
                                                                    <input type="hidden" name="subpwork" class="subpwork subpwork-{{ $p_arr1 }}" value="{{ $i }}">
                                                                    <input type="hidden" name="subpwork_list" class="subpwork_list subpwork_list-{{ $i }}" value="{{ $p_arr1 }}">
                                                                    <input type="hidden" name="subworkjs1" class="subworkjs1-{{ $i }} subworkjs1-{{ $i }}{{ $p_arr1 }}" value="{{ $p_memb_json }}">
                                                                    <ul id="subpwork_field-{{ $i }}{{ $p_arr1 }}" style="display:none;">
                                                                    @if(!empty($environment_list))
                                                                    @foreach($environment_list as $env_list)
                                                                    <li data-value="{{ $env_list->prefer_id }}">{{ $env_list->env_name }}</li>
                                                                    
                                                                    @endforeach
                                                                    @endif
                                                                    </ul>
                                                                    <select class="js-example-basic-multiple addAll_removeAll_btn pwork_valid-{{ $p_arr1 }} pwork_valid-{{ $i }}{{ $p_arr1 }}" data-list-id="subpwork_field-{{ $i }}{{ $p_arr1 }}" name="subworkthlevel[{{ $i }}][{{ $p_arr }}][{{ $p_arr1 }}][]" multiple></select>
                                                                    <span id="reqsubpwork-{{ $i }}{{ $p_arr1 }}" class="reqError text-danger valley"></span>
                                                                </div>
                                                                @endforeach
                                                                @endif
                                                                @endif
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="form-group level-drp">
                                                            <label class="form-label" for="input-1">Facility / Workplace Name</label>
                                                            <input type="text" name="facility_workplace_name[{{ $i }}]" class="form-control facworkname facworkname-{{ $i }}" value="{{ $data->facility_workplace_name }}">
                                                            <span id="reqfaceworkname-{{$i}}" class="reqError text-danger valley"></span>
                                                        </div> 
                                                        <div class="form-group drp--clr nurse_exp_type nurse_exp_type-{{ $i }}">
                                                            <label class="form-label" for="input-1">Type of Nurse?</label>
                                                            <input type="hidden" name="user_id" class="user_id" value="{{ $data->user_id }}">
                                                            <input type="hidden" name="type_nurse" class="type_nurse_ep-{{ $i }}" value="{{ $data->nurseType }}">
                                                            <ul id="type-of-nurse-experience-{{$i}}" style="display:none;">
                                                                @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                                                                <?php
                                                                $j = 1;
                                                                ?>
                                                                @foreach($specialty as $spl)
                                                                <li id="nursing_menus-{{ $j }}" data-value="{{ $spl->id }}">{{ $spl->name }}</li>
                                                                <?php
                                                                $j++;
                                                                ?>
                                                                @endforeach
                                                            </ul>
                                                            <select class="js-example-basic-multiple addAll_removeAll_btn nurse_level_ep nurse_type_exp nurse_type_exp_{{$i}}" data-list-id="type-of-nurse-experience-{{$i}}" name="nurseType[{{$i}}][]" id="nurse_type_exp-{{ $i }}" multiple="multiple" onchange="handleNurseTypeChange('{{$i}}')"></select>
                                                        </div>
                                                        <span id="reqnurseTypeexpId-{{$i}}" class="reqError text-danger valley"></span>
                                                        <div class="result--show nurse-res-rex nurse-res-rex-{{ $i }}">
                                                            <input type="hidden" name="nursing_result_one_experience" class="nursing_result_one_experience_{{$i}}" value="{{$data->entry_level_nursing }}">
                                                            <input type="hidden" name="nursing_result_two_experience" class="nursing_result_two_experience_{{$i}}" value="{{ $data->registered_nurses }}">
                                                            <input type="hidden" name="nursing_result_three_experience" class="nursing_result_three_experience_{{$i}}" value="{{$data->advanced_practioner}}">
                                                            <div class="container p-0">
                                                                <div class="row g-2">
                                                                    @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                                                                    <?php
                                                                    $a = 1;
                                                                    ?>
                                                                    @foreach($specialty as $spl)
                                                                    <?php
                                                                    $nursing_data = DB::table("practitioner_type")->where('parent', $spl->id)->orderBy('name')->get();

                                                                    if ($data->nurseType != "") {
                                                                        if (in_array((string)$spl->id, json_decode($data->nurseType, true))) {
                                                                            $getn = '';
                                                                        } else {
                                                                            $getn = 'd-none';
                                                                        }
                                                                    } else {
                                                                        $getn = 'd-none';
                                                                    }
                                                                    ?>
                                                                    <input type="hidden" name="nursing_result_experience" class="nursing_result_experience-{{ $a }}" value="{{ $spl->id }}">
                                                                    <div class="nursing_data form-group drp--clr col-md-12 {{ $getn }} drpdown-set nursing_exp_{{ $spl->id }}" id="nursing_level_experience-{{ $a }}-{{$i}}">
                                                                        <label class="form-label" for="input-2">{{ $spl->name }}</label>
                                                                        <ul id="nursing_entry_experience-{{ $a }}" style="display:none;">
                                                                            @foreach($nursing_data as $nd)
                                                                            <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                        <select class="js-example-basic-multiple addAll_removeAll_btn nur_exp_res_{{ $spl->id }}_{{$i}}" data-list-id="nursing_entry_experience-{{ $a }}" name="nursing_type_{{ $a }}[{{ $i }}][]" multiple="multiple"></select>
                                                                    </div>
                                                                    <?php
                                                                    $a++;
                                                                    ?>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="np_submenu_experience d-none">
                                                            <input type="hidden" name="np_result_experience" class="np_result_experience_{{$i}}" value="{{ $data->nurse_prac }}">
                                                            <div class="form-group drp--clr">
                                                                <?php
                                                                $np_data = DB::table("practitioner_type")->where('parent', '179')->get();
                                                                ?>
                                                                <label class="form-label" for="input-1">Nurse Practitioner (NP):</label>
                                                                <ul id="nurse_practitioner_menu_experience" style="display:none;">
                                                                    @foreach($np_data as $nd)
                                                                    <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn nurse_prax_exp_{{$i}}" data-list-id="nurse_practitioner_menu_experience" name="nurse_practitioner_menu_experience[1][]" multiple="multiple"></select>
                                                            </div>
                                                        </div>
                                                        <div class="condition_set">
                                                            <div class="form-group drp--clr">
                                                                <input type="hidden" name="speciality_exp_value-{{$i}}" class="speciality_exp_value-{{$i}}" value="{{ $data->specialties }}">
                                                                <label class="form-label" for="input-1">Specialties</label>
                                                                <ul id="specialties_type_experience-1" style="display:none;">
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
                                                                <select class="js-example-basic-multiple  spec_exp spec_exp_{{$i}} specialties_experience addAll_removeAll_btn exp_spe_type_{{$i}}" index_value="{{ $i}}" data-list-id="specialties_type_experience-1" name="specialties_experience[{{ $i }}][]" multiple="multiple"></select>
                                                            </div>
                                                            <span id="reqspecialtiesexp-{{$i}}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="speciality_boxes row result--show">
                                                            <input type="hidden" name="adults_result_experience" class="adults_result_experience_{{$i}}" value="{{ $data->adults }}">
                                                            <input type="hidden" name="maternity_result_experience" class="maternity_result_experience_{{$i}}" value="{{ $data->maternity }}">
                                                            <input type="hidden" name="community_result_experience" class="community_result_experience_{{$i}}" value="{{ $data->community }}">
                                                            <input type="hidden" name="neonatal_care_result_experience" class="neonatal_care_result_experience_{{ $i }}" value="{{ $data->neonatal_care }}">
                                                            <input type="hidden" name="paediatrics_neonatal" class="paediatrics_neonatal_{{$i}}" value="{{ $data->paediatrics_neonatal }}">
                                                            <input type="hidden" name="paedia_surgical_preoperative" class="paedia_surgical_{{$i}}" value="{{ $data->paedia_surgical_preoperative }}">
                                                            <input type="hidden" name="pad_op_room_result_experience" class="pad_op_room_result_experience_{{ $i }}" value="{{ $data->pad_op_room }}">
                                                            <input type="hidden" name="pad_qr_scout_result_experience" class="pad_qr_scout_result_experience_{{ $i }}" value="{{ $data->pad_qr_scout }}">
                                                            <input type="hidden" name="pad_qr_scrub_result_experience" class="pad_qr_scrub_result_experience_{{ $i }}" value="{{ $data->pad_qr_scrub }}">
                                                            <?php
                                                            $l = 1;
                                                            ?>
                                                            @foreach($JobSpecialties as $ptl)
                                                            <?php
                                                            $speciality_data = DB::table("speciality")->where('parent', $ptl->id)->get();
                                                            if ($data->specialties != null) {
                                                                if (in_array((string)$ptl->id, json_decode($data->specialties, true))) {
                                                                    $d = '';
                                                                } else {
                                                                    $d = 'd-none';
                                                                }
                                                            } else {
                                                                $d = 'd-none';
                                                            }
                                                            ?>
                                                            <input type="hidden" value1="{{$data->specialties}}" name="speciality_exp_result" class="speciality_exp_result-{{ $l }}-{{$i}}" value="{{ $ptl->id }}">
                                                            <div class="speciality_data_exp form-group drp--clr drpdown-set {{ $d }} col-md-12 speciality_exp_{{ $ptl->id }}" id="specility_level_exp-{{ $l }}-{{$i}}">
                                                                <label class="form-label" for="input-2">{{ $ptl->name }}</label>
                                                                <ul id="speciality_entry_exp-{{ $l }}-{{ $i }}" style="display:none;">
                                                                    @foreach($speciality_data as $sd)
                                                                    <li data-value="{{ $sd->id }}">{{ $sd->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn  specilitysubtype specility_sub_type_{{ $ptl->id }}_{{$i}}" data-list-id="speciality_entry_exp-{{ $l }}-{{ $i }}" name="speciality_entry_experience_{{ $l }}[{{$i}}][]" index_name="{{ $i }}" multiple="multiple"></select>

                                                            </div>
                                                            <?php
                                                            $l++;
                                                            ?>
                                                            @endforeach
                                                        </div>
                                                        <div class="surgical_div_experience_{{$i}}">
                                                            <input type="hidden" name="surgical_preoperative_result_experience" class="surgical_preoperative_result_experience-{{$i}}" value="{{ $data->surgical_preoperative }}">
                                                            <div class="surgical_row_data_experience_{{$i}} form-group drp--clr d-none col-md-12">
                                                                <label class="form-label" for="input-1">Surgical Preoperative and Postoperative Care:</label>
                                                                <?php
                                                                $speciality_surgicalrow_data = DB::table("speciality")->where('parent', '96')->get();
                                                                $r = 1;
                                                                ?>
                                                                <ul id="surgical_row_box_exp_{{$i}}" style="display:none;">
                                                                    @foreach($speciality_surgicalrow_data as $ssrd)
                                                                    <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn sur_exp_{{ $i }} surgical_subtype" data-list-id="surgical_row_box_exp_{{$i}}" index_name="{{$i}}" name="surgical_row_box_experience[1][]" multiple="multiple"></select>
                                                            </div>
                                                        </div>
                                                        <div class="paediatric_surgical_div_expe_{{ $i }}">
                                                            <div class="surgicalpad_row_data_exp_{{ $i }} form-group drp--clr d-none col-md-12">
                                                                <label class="form-label" for="input-1">Paediatric Surgical Preop. and Postop. Care:</label>
                                                                <?php
                                                                $speciality_padsurgicalrow_data = DB::table("speciality")->where('parent', '285')->get();
                                                                $r = 1;
                                                                ?>
                                                                <ul id="surgical_rowpad_box_exp_{{$i}}" style="display:none;">
                                                                    @foreach($speciality_padsurgicalrow_data as $ssrd)
                                                                    <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn  pae_sur_pre pae_sur_preop_{{$i}}" data-list-id="surgical_rowpad_box_exp_{{$i}}" name="surgical_rowpad_box_experience[1][]" multiple="multiple" index_name="{{$i}}"></select>
                                                            </div>
                                                        </div>
                                                        <div class="specialty_sub_boxes_experience row">
                                                            <input type="hidden" name="operatingroom_result_experience" class="operatingroom_result_experience-{{ $i }}" value="{{ $data->operating_room }}">
                                                            <input type="hidden" name="operatingscout_result_experience" class="operatingscout_result_experience-{{$i}}" value="{{  $data->operating_room_scout }}">
                                                            <input type="hidden" name="operatingscrub_result_experience" class="operatingscrub_result_experience-{{$i}}" value="{{  $data->operating_room_scrub }}">
                                                            <?php
                                                            $speciality_surgical_data = DB::table("speciality")->where('parent', '96')->get();
                                                            $w = 1;
                                                            ?>
                                                            @foreach($speciality_surgical_data as $ssd)
                                                            <input type="hidden" name="speciality_result" class="speciality_surgical_result_experience-{{$i}}-{{ $w }}" value="{{ $ssd->id }}">
                                                            <div class="subvaluedata_{{$i}} surgical_row_exp-{{ $w }}-{{$i}} sur_sub_type_{{ $ssd->id }}_{{ $i }} d-none  form-group drp--clr drpdown-set">
                                                                <label class="form-label" for="input-1">{{ $ssd->name }}</label>
                                                                <?php
                                                                $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->get();
                                                                ?>
                                                                <ul id="surgical_operative_care_experience-{{ $w }}-{{$i}}" style="display:none;">
                                                                    @foreach($speciality_surgicalsub_data as $sssd)
                                                                    <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn spec_sub_value_{{ $ssd->id }}_{{$i}}" data-list-id="surgical_operative_care_experience-{{ $w }}-{{$i}}" name="surgical_operative_care_exp_{{ $w }}[1][]" multiple="multiple"></select>
                                                            </div>
                                                            <?php
                                                            $w++;
                                                            ?>
                                                            @endforeach
                                                            <?php
                                                            $speciality_surgical_datamater = DB::table("speciality")->where('parent', '233')->get();
                                                            $p = 1;
                                                            ?>
                                                            <input type="hidden" name="surgical_ob_result_experience" class="surgical_ob_result_experience_{{$i}}" value="{{ $data->surgical_obstrics_gynacology }}">
                                                            <div class="surgicalobs_div surgicalobs_row_exp_{{$i}} form-group drp--clr d-none drpdown-set col-md-12">
                                                                <label class="form-label" for="input-1">Surgical Obstetrics and Gynecology (OB/GYN):</label>
                                                                <ul id="surgicalobs_row_data_experience_{{$i}}" style="display:none;">
                                                                    @foreach($speciality_surgical_datamater as $ssd)
                                                                    <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn surgicalobs_row_{{$i}}" data-list-id="surgicalobs_row_data_experience_{{$i}}" name="surgical_obs_care_exp[1][]" multiple="multiple"></select>
                                                            </div>
                                                            <?php
                                                            $speciality_surgical_datamater = DB::table("speciality")->where('parent', '250')->get();
                                                            ?>
                                                            <div class="neonatal_row_exp_{{$i}} form-group drp--clr drpdown-set d-none col-md-12">
                                                                <label class="form-label" for="input-1">Neonatal Care:</label>

                                                                <ul id="neonatal_care_expe" style="display:none;">
                                                                    @foreach($speciality_surgical_datamater as $ssd)
                                                                    <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn neonatal_exp_{{ $i }}" data-list-id="neonatal_care_expe" name="neonatal_care_experience[1][]" multiple="multiple"></select>
                                                            </div>
                                                            <?php
                                                            $speciality_surgical_datap = DB::table("speciality")->where('parent', '285')->get();
                                                            $q = 1;
                                                            ?>
                                                            @foreach($speciality_surgical_datap as $ssd)
                                                            <?php
                                                            if ($data->paedia_surgical_preoperative != "null") {
                                                                if (in_array((string)$ssd->id, json_decode($data->paedia_surgical_preoperative, true))) {
                                                                    $getd = '';
                                                                } else {
                                                                    $getd = 'd-none';
                                                                }
                                                            } else {
                                                                $getd = 'd-none';
                                                            }
                                                            ?>
                                                            <input type="hidden" name="speciality_result" class="surgical_rowp_result_experience-{{ $i }}-{{ $q }}" value="{{ $ssd->id }}">
                                                            <div class="surgical_rowp_exp_{{$i}} surgicalpad_row_experience-{{ $ssd->id }} surgical_rowp_exp-{{ $q }}-{{$i}} form-group drp--clr {{$getd}} drpdown-set">
                                                                <label class="form-label" for="input-1">{{ $ssd->name }}</label>
                                                                <?php
                                                                $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->orderBy('name')->get();
                                                                ?>
                                                                <ul id="surgical_operative_carep_exp-{{ $q }}" style="display:none;">
                                                                    @foreach($speciality_surgicalsub_data as $sssd)
                                                                    <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn surgi_{{$ssd->id}}_{{$i}}" data-list-id="surgical_operative_carep_exp-{{ $q }}" name="surgical_operative_carep_experience_{{ $q }}[1][]" multiple="multiple"></select>
                                                            </div>
                                                            <?php
                                                            $q++;
                                                            ?>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <div class="form-group level-drp">
                                                                <label class="form-label" for="input-1">What is your Level of experience in this specialty?
                                                                </label>
                                                                <select class="form-control mr-10 select-active" name="exper_assistent_level[{{$i}}]">
                                                                    @for($l = 1; $l <= 30; $l++)
                                                                        <option value="{{ $l }}" {{ $l == $data->assistent_level ? 'selected' : '' }}>
                                                                        {{ $l }}{{ $l == 1 ? 'st' : ($l == 2 ? 'nd' : ($l == 3 ? 'rd' : 'th')) }}
                                                                        Year
                                                                        </option>
                                                                        @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group level-drp">
                          
                                                        <label class="form-label" for="input-1">Position Held</label>
                                                        <?php
                                                            $employee_postion_data = DB::table('employee_positions')->where("subposition_id",0)->orderBy("position_name","asc")->get();
                                                            $pos_data = (array)json_decode($data->position_held);

                                                            $parr = array();
                                                            if (!empty($pos_data)){
                                                                foreach ($pos_data as $index => $pdata){
                                                                    $parr[] = $index;
                                                                }
                                                            }
                                                            
                                                            
                                                            $x = 1;
                                                            $p_arr = json_encode($parr);
                                                        ?>
                                                        <input type="hidden" name="pos_hide" class="pos_hide pos_hide-{{ $i }}" value="{{ $p_arr }}">
                                                        <ul id="position_held_field-{{ $i }}" style="display:none;">
                                                        
                                                            @if(!empty($employee_postion_data))
                                                            @foreach($employee_postion_data as $emp_data)
                                                            <li data-value="{{ $emp_data->position_id }}">{{ $emp_data->position_name }}</li>
                                                            @endforeach
                                                            @endif
                                                        </ul>
                                                        <select class="js-example-basic-multiple addAll_removeAll_btn pos_held pos_held_{{ $i }}" data-list-id="position_held_field-{{ $i }}" name="positions_held[{{ $i }}]" id="position_held_field-{{ $i }}" onchange="getPostions('',{{ $i }})" multiple></select>
                                                        <span id="reqpositionheld-{{$i}}" class="reqError text-danger valley"></span>
                                                        
                                                        </div>
                                                        <div class="show_positions-{{ $i }}">
                                                        @foreach ($parr as $par)
                                                        <?php
                                                            $employee_positions = DB::table("employee_positions")->where("subposition_id",$par)->orderBy('position_name', 'ASC')->get();
                                                            $position_name = DB::table("employee_positions")->where("position_id",$par)->first();
                                                            $subposdata = json_encode($pos_data[$par]);
                                                            //print_r($subposdata);
                                                        ?>
                                                        @if($par != "34")
                                                        <div class="subposdiv subposdiv-{{ $position_name->position_id }} form-group level-drp">
                                                            <label class="form-label pos_label pos_label-{{ $i }}{{ $position_name->position_id }}" for="input-1">{{ $position_name->position_name }}</label>
                                                            <input type="hidden" name="subpos" class="subpos subpos-{{ $position_name->position_id }}" value="{{ $i }}">
                                                            <input type="hidden" name="subpos_list" class="subpos_list subpos_list-{{ $i }} subpos_list-{{ $i }}{{ $x }}" value="{{ $position_name->position_id }}">
                                                            <input type="hidden" name="subposdata" class="subposdata-{{ $i }} subposdata-{{ $i }}{{ $x }}" value="{{ $subposdata }}">
                                                            <ul id="subposition_held_field-{{ $i }}{{ $position_name->position_id }}" style="display:none;">
                                                            @if(!empty($employee_positions))
                                                            @foreach($employee_positions as $emp_pos)
                                                            <li data-value="{{ $emp_pos->position_id }}">{{ $emp_pos->position_name }}</li>
                                                            @endforeach
                                                            @endif
                                                            </ul>
                                                            <select class="js-example-basic-multiple addAll_removeAll_btn position_valid-{{ $i }}{{ $position_name->position_id }}" data-list-id="subposition_held_field-{{ $i }}{{ $position_name->position_id }}" name="subpositions_held[{{ $i }}][{{ $position_name->position_id }}][]" multiple></select>
                                                            <span id="reqsubpositionheld-{{ $i }}{{ $position_name->position_id }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        @else
                                                        <div class="subposdiv subposdiv-{{ $position_name->position_id }} form-group level-drp">
                                                            <label class="form-label pos_label pos_label-{{ $i }}{{ $position_name->position_id }}" for="input-1">Other</label>
                                                            <input type="hidden" name="subpos_list" class="subpos_list subpos_list-'+k+'" value="34">
                                                            <input type="text" name="subpositions_held[{{ $i }}][{{ $position_name->position_id }}][]" class="form-control position_other position_other-{{ $i }} position_valid-{{ $i }}{{ $position_name->position_id }}" value="<?php echo $pos_data[$par][0] ?>">
                                                            <span id="reqsubpositionheld-{{ $i }}{{ $position_name->position_id }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        @endif
                                                        <?php
                                                            $x++;
                                                        ?>
                                                        @endforeach
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group level-drp">
                                                                    <label class="form-label" for="input-1">Employment Start Date</label>
                                                                    <input class="form-control employeement_start_date_exp employeement_start_date_exp-{{$i}}" value="{{ $data->employeement_start_date }}" type="date" name="start_date[{{$i}}]" onkeydown="return false">
                                                                    <span id="reqempsdateexp-{{$i}}" class="reqError text-danger valley"></span>
                                                                </div>
                                                                <div class="declaration_box mt-2 mb-2">
                                                                    <input class="currently_position currently_position-{{$i}}" type="checkbox" name="present_box[{{$i}}]" value="{{ $data->pre_box_status }}" {{ ($data->pre_box_status == 1) ? 'checked' : '' }} onclick="currently_position_1('{{ $i }}')">I am currently in this position at the moment
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 empl_end_date-{{$i}} {{ ($data->pre_box_status == 1) ? 'd-none' : '' }} ">
                                                                <div class="form-group level-drp">
                                                                    <label class="form-label" for="input-1">Employment End Date</label>
                                                                    <input class="form-control employeement_end_date_exp employeement_end_date_exp-{{$i}}" type="date" value="{{ $data->employeement_end_date }}" name="end_date[{{ $i }}]" onkeydown="return false">
                                                                    <span id="reqemployeementenddateexp-{{$i}}" class="reqError text-danger valley"></span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-12">
                                                                <div class="form-group level-drp">
                                                                    <label class="form-label" for="input-1">Employment type</label>
                                                                    <select class="form-control emp_exp_type emp_exp_type-{{$i}}" name="employeement_type[{{$i}}]" onchange="ExpEmpStatus(this.value)">
                                                                        <option value="">select</option>
                                                                        <option value="Permanent" @if($data->employeement_type == "Permanent") selected @endif>Permanent</option>
                                                                        <option value="Temporary" @if($data->employeement_type == "Temporary") selected @endif>Temporary</option>
                                                                    </select>
                                                                    <span id="reqemptype-{{$i}}" class="reqError text-danger valley"></span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="exp_permanent exp_permanent-{{$i}}" @if($data->employeement_type != "Permanent") style="display: none;" @endif>
                                                                <div class="form-group level-drp col-md-12">
                                                                <label class="form-label" for="input-1">Permanent</label>
                                                                <input type="hidden" name="perfieldexp" class="perfieldexp perfieldexp-{{ $i }}" value="{{ $data->permanent_status }}">
                                                                <ul id="permanent_status_experience-{{ $i }}" style="display:none;">
                                                                    <li data-value="">select</li>
                                                                    <li data-value="Full-time (Permanent)">Full-time (Permanent)</li>
                                                                    <li data-value="Part-time (Permanent)">Part-time (Permanent)</li>
                                                                    <li data-value="Agency Nurse / Midwife (Permanent)">Agency Nurse / Midwife (Permanent)</li>
                                                                    <li data-value="Staffing Agency Nurse (Permanent)">Staffing Agency Nurse (Permanent)</li>
                                                                    <li data-value="Private Healthcare Agency Nurse (Permanent)">Private Healthcare Agency Nurse (Permanent)</li>
                                                                    <li data-value="Freelance (Permanent)">Freelance (Permanent)</li>
                                                                    <li data-value="Self-Employed (Permanent)">Self-Employed (Permanent)</li>
                                                                    <li data-value="Private Practice (Permanent)">Private Practice (Permanent)</li>
                                                                    <li data-value="Volunteer (Permanent)">Volunteer (Permanent)</li>
                                                                    
                                                                </ul>
                                                                <select class="js-example-basic-multiple form-control permanent_exp permanent_exp-{{ $i }}" data-list-id="permanent_status_experience-{{$i}}" name="permanent_status[{{$i}}]" id="permanent_status_experience"></select>
                                                                <span id="reqemployeep_statusexp-{{ $i }}" class="reqError text-danger valley"></span>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="exp_temporary exp_temporary-{{ $i }}" @if($data->employeement_type != "Temporary") style="display: none;" @endif>
                                                                <div class="form-group level-drp col-md-12">
                                                                <label class="form-label" for="input-1">Temporary</label>
                                                                <input type="hidden" name="temphfield" class="temphfieldexp temphfieldexp-{{ $i }}" value="{{ $data->temporary_status }}">
                                                            
                                                                <ul id="temporary_status_experience-{{ $i }}" style="display:none;">
                                                                    <li data-value="select">select</li>
                                                                    <li data-value="Full-time (Temporary)">Full-time (Temporary)</li>
                                                                    <li data-value="Part-time (Temporary)">Part-time (Temporary)</li>
                                                                    <li data-value="Agency Nurse/Midwife (Temporary)">Agency Nurse/Midwife (Temporary)</li>
                                                                    <li data-value="Staffing Agency Nurse (Temporary)">Staffing Agency Nurse (Temporary)</li>
                                                                    <li data-value="Private Healthcare Agency Nurse (Temporary)">Private Healthcare Agency Nurse (Temporary)</li>
                                                                    <li data-value="Travel">Travel</li>
                                                                    <li data-value="Per Diem (Daily Basis)">Per Diem (Daily Basis)</li>
                                                                    <li data-value="Float Pool & Relief Nursing (Multi-Department Work)">Float Pool & Relief Nursing (Multi-Department Work)
                                                                    <li data-value="On-Call (Immediate Availability)">On-Call (Immediate Availability)</li>
                                                                    <li data-value="PRN (Pro Re Nata /As Needed)">PRN (Pro Re Nata /As Needed)</li>
                                                                    <li data-value="Casual">Casual</li>
                                                                    <li data-value="Locum tenens (temporary substitute)">Locum tenens (temporary substitute)</li>
                                                                    <li data-value="Seasonal (Short-Term for Peak Demand)">Seasonal (Short-Term for Peak Demand)</li>
                                                                    <li data-value="Freelance (Temporary)">Freelance (Temporary)</li>
                                                                    <li data-value="Self-Employed (Temporary)">Self-Employed (Temporary)</li>
                                                                    <li data-value="Private Practice (Temporary)">Private Practice (Temporary)</li>
                                                                    <li data-value="Internship">Internship</li>
                                                                    <li data-value="Apprenticeship">Apprenticeship</li>
                                                                    <li data-value="Residency">Residency</li>
                                                                    <li data-value="Volunteer (Temporary)">Volunteer (Temporary)</li>
                                                                </ul>
                                                                <select class="js-example-basic-multiple form-control temporary_exp temporary_exp-{{ $i }}" data-list-id="temporary_status_experience-{{ $i }}" name="temporary_status[{{$i}}]" id="temporary_status_experience"></select>
                                                                <span id="reqemployeetexp_status-{{ $i }}" class="reqError text-danger valley"></span>
                                                                </div>
                                                                
                                                            </div>
                                                            <h6 class="fw-bolder fs-6 lh-base d-flex align-items-centere mt-2 mergency_text">
                                                                Detailed Job Descriptions
                                                            </h6>
                                                            <div class="form-group level-drp">
                                                                <label class="form-label" for="input-1">Responsibilities</label>
                                                                <textarea class="form-control res-exp res-exp-{{ $i }}" name="job_responeblities[{{$i}}]">{{$data->responsiblities}}</textarea>
                                                                <span id="reqresposiblitiesexp-{{$i}}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group level-drp">
                                                                <label class="form-label" for="input-1">Achievements</label>
                                                                <textarea class="form-control ach_exp ach_exp-{{ $i }}" name="achievements[{{$i}}]">{{$data->achievements}}</textarea>
                                                                <span id="reqachievementsexp-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <h6 class="emergency_text">
                                                                Areas of Expertise
                                                            </h6>
                                                            <div class="form-group level-drp">
                                                                <input type="hidden" value="{{ $data->skills_compantancies }}" id="spe_skill_{{ $i }}">
                                                                <label class="form-label" for="input-1">Specific skills and competencies</label>
                                                                <?php
                                                                $skills = DB::table("skills")->where("parent_id", "1")->get();
                                                                ?>
                                                                <ul id="skills_compantancies1" style="display:none;">
                                                                    @foreach($skills as $cert)
                                                                    <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn  spe_skill spe_skill_{{ $i }} specific_skill skill_com_{{ $i }}" data-list-id="skills_compantancies1" name="skills_compantancies[{{$i}}][]" multiple="multiple" index_name="{{ $i }}"></select>
                                                            </div>
                                                            <span id="reqexpertiseexp-{{ $i }}" class="reqError text-danger valley"></span>

                                                            <div class="form-group level-drp @if($data->inter_and_em_skill == 'null') d-none @endif interpersonal_{{$i}}">
                                                                <input type="hidden" value="{{ $data->inter_and_em_skill }}" id="inter_and_em_skill{{ $i }}">
                                                                <label class="form-label" for="input-1">Interpersonal and Emotional Skills</label>
                                                                <?php
                                                                $skills = DB::table("skills")->where("parent_id", "8")->get();
                                                                ?>
                                                                <ul id="inter_and_em_skill" style="display:none;">
                                                                    @foreach($skills as $cert)
                                                                    <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn inter_and_em_skill_{{ $i }}" data-list-id="inter_and_em_skill" name="sub_skills_compantancies-8[{{$i}}][]" multiple="multiple"></select>
                                                            </div>
                                                            <span id="reqexpertise" class="reqError text-danger valley"></span>

                                                            <div class="form-group level-drp @if($data->org_and_any_skill == 'null') d-none @endif analy_skill_{{$i}}">
                                                                <input type="hidden" value="{{ $data->org_and_any_skill }}" id="org_and_any_skill{{ $i }}">
                                                                <label class="form-label" for="input-1">Organizational and Analytical Skills</label>
                                                                <?php
                                                                $skills = DB::table("skills")->where("parent_id", "9")->get();
                                                                ?>
                                                                <ul id="org_and_any_skill" style="display:none;">
                                                                    @foreach($skills as $cert)
                                                                    <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn org_and_any_skill_{{ $i }}" data-list-id="org_and_any_skill" name="sub_skills_compantancies-9[{{$i}}][]" multiple="multiple"></select>
                                                            </div>
                                                            <span id="reqexpertise" class="reqError text-danger valley"></span>

                                                            <div class="form-group level-drp @if($data->lead_and_ment_skill === 'null') d-none @endif leader_skill_{{$i}}">
                                                                <input type="hidden" value="{{ $data->lead_and_ment_skill }}" id="lead_and_ment_skill_{{ $i }}">
                                                                <label class="form-label" for="input-1">Leadership and Mentorship Skills</label>
                                                                <?php
                                                                $skills = DB::table("skills")->where("parent_id", "10")->get();
                                                                ?>
                                                                <ul id="lead_and_ment_skill1" style="display:none;">
                                                                    @foreach($skills as $cert)
                                                                    <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn lead_and_ment_skill_{{ $i }}" data-list-id="lead_and_ment_skill1" name="sub_skills_compantancies-10[{{$i}}][]" multiple="multiple"></select>
                                                            </div>
                                                            <span id="reqexpertise" class="reqError text-danger valley"></span>

                                                            <div class="form-group level-drp  @if($data->tech_and_soft_pro == 'null')  d-none @endif tech_skill_{{$i}}">
                                                                <input type="hidden" value="{{ $data->tech_and_soft_pro }}" id="tech_and_soft_pro_{{ $i }}">
                                                                <label class="form-label" for="input-1">Technology and Software Proficiency</label>
                                                                <?php
                                                                $skills = DB::table("skills")->where("parent_id", "11")->get();
                                                                ?>
                                                                <ul id="tech_and_soft_pro" style="display:none;">
                                                                    @foreach($skills as $cert)
                                                                    <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn tech_and_soft_pro{{ $i }}" data-list-id="tech_and_soft_pro" name="sub_skills_compantancies-11[{{$i}}][]" multiple="multiple"></select>
                                                            </div>
                                                            <span id="reqexpertise" class="reqError text-danger valley"></span>
                                                            <div class="form-group level-drp">
                                                                <input type="hidden" value="{{ $data->evidence_type }}" id="evidence_type_{{ $i }}">
                                                                <label class="form-label" for="input-1">Type of evidence</label>
                                                                <?php
                                                                $skills = DB::table("skills")->get();
                                                                ?>
                                                                <ul id="type_of_evidence" style="display:none;">
                                                                    <li data-value="Statement of Service">Statement of Service</li>
                                                                    <li data-value="Statutory Declaration">Statutory Declaration</li>
                                                                    <li data-value="Award">Award</li>
                                                                    <li data-value="Transcript">Transcript</li>
                                                                    <li data-value="Certificate">Certificate</li>
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn type_of_evi type_of_evi_{{$i}} type_evi_{{ $i }}" data-list-id="type_of_evidence" name="type_of_evidence[{{$i}}][]" multiple="multiple"></select>
                                                                <span id="reqtype_evidenceexp-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group level-drp">
                                                                <?php
                                                                $user_id = $data->user_id;
                                                                ?>
                                                                <label class="form-label" for="input-1">Upload evidence</label>
                                                                <input class="form-control change_evi" type="file" name="upload_evidence[{{$i}}][]" multiple="" id="{{ $i }}">
                                                                <input type="hidden" name="old_file[{{ $i }}]" value="{{ $data->upload_evidence }}">
                                                                <div class="fileList  fileList_{{ $i }}">
                                                                    @if(!empty($data) && ($data->upload_evidence))
                                                                    <?php
                                                                    $evi_img = json_decode($data->upload_evidence);

                                                                    $m = 0;
                                                                    $user_id = $data->user_id;
                                                                    $getid = $data->experience_id;
                                                                    ?>
                                                                    @if(!empty($evi_img))
                                                                    @foreach($evi_img as $tranimg)
                                                                    <div class="trans_img trans_img-{{ $m }}">
                                                                        <a href="{{ url('/public/uploads/evidence') }}/{{ $tranimg }}" target="_blank"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                        <div class="close_btn close_btn-{{ $i }}" onclick="deletevdiImg('{{ $m }}','{{ $user_id }}','{{ $tranimg }}','{{ $getid }}')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                                                    </div>
                                                                    <?php
                                                                    $m++;
                                                                    ?>
                                                                    @endforeach
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <!-- Add Delete Button -->
                                                                <div class="add_new_certification_div_2">
                                                                    <a
                                                                        style="cursor: pointer; margin-bottom: 35px !important;"
                                                                        class="delete-work-experience"
                                                                        data-index="{{$data->experience_id}}">
                                                                        - Delete Work Experience
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br>
                                                        <?php
                                                        $i++;
                                                        ?>
                                                    </div>
                                                    @endforeach


                                                </div>
                                                @else
                                                <div class="work_exp">
                                                    <h6 class="emergency_text previous_employeers_head mt-3 fw-bolder fs-6 lh-base d-flex align-items-center">
                                                        Work Experience 1
                                                    </h6>

                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="input-1">Type of Nurse?</label>
                                                            <input type="hidden" name="user_id" class="user_id" value="">
                                                            <ul id="type-of-nurse-experience" style="display:none;">
                                                                @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                                                                <?php
                                                                $j = 1;
                                                                ?>
                                                                @foreach($specialty as $spl)
                                                                <li id="nursing_menus-{{ $j }}" data-value="{{ $spl->id }}">{{ $spl->name }}</li>
                                                                <?php
                                                                $j++;
                                                                ?>
                                                                @endforeach
                                                            </ul>
                                                            <select class="js-example-basic-multiple addAll_removeAll_btn nurse_type_exp nurse_type_exp_1" data-list-id="type-of-nurse-experience" name="nurseType[1][]" id="nurse_type_experience_1" multiple="multiple"></select>
                                                            <span id="reqnurseTypeexpId-1" class="reqError text-danger valley"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                                                            <?php
                                                            $i = 1;
                                                            ?>
                                                            @foreach($specialty as $spl)
                                                            <?php
                                                            $nursing_data = DB::table("practitioner_type")->where('parent', $spl->id)->orderBy('name')->get();
                                                            ?>
                                                            <input type="hidden" name="nursing_result_experience2" class="nursing_result_experience-{{ $i }}" value="{{ $spl->id }}">
                                                            <div class="nursing_data  drp--clr  d-none drpdown-set nursing_exp_{{ $spl->id }}" id="nursing_level_experience-{{ $i }}">
                                                                <label class="form-label" for="input-2">{{ $spl->name }}</label>
                                                                <ul id="nursing_entry_experience-{{ $i }}" style="display:none;">
                                                                    @foreach($nursing_data as $nd)
                                                                    <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nursing_entry_experience-{{ $i }}" name="nursing_type_{{ $i }}[1][]" multiple="multiple"></select>
                                                            </div>
                                                            <?php
                                                            $i++;
                                                            ?>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <div class="np_submenu_experience d-none">
                                                            <div class="form-group drp--clr">
                                                                <?php
                                                                $np_data = DB::table("practitioner_type")->where('parent', '179')->get();
                                                                ?>
                                                                <label class="form-label" for="input-1">Nurse Practitioner (NP):</label>
                                                                <ul id="nurse_practitioner_menu_experience" style="display:none;">
                                                                    @foreach($np_data as $nd)
                                                                    <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nurse_practitioner_menu_experience" name="nurse_practitioner_menu_experience[1][]" multiple="multiple"></select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <div class="drp--clr">
                                                                <label class="form-label" for="input-1">Specialties</label>
                                                                <ul id="specialties_experience" style="display:none;">
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
                                                                <select class="js-example-basic-multiple addAll_removeAll_btn spec_exp spec_exp_1 specialties_experience" data-list-id="specialties_experience" name="specialties_experience[1][]" multiple="multiple"></select>
                                                            </div>
                                                            <span id="reqspecialtiesexp-1" class="reqError text-danger valley"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <div class="speciality_boxes result--show">
                                                                <?php
                                                                $l = 1;
                                                                ?>
                                                                @foreach($JobSpecialties as $ptl)
                                                                <?php
                                                                $speciality_data = DB::table("speciality")->where('parent', $ptl->id)->get();
                                                                ?>
                                                                <input type="hidden" name="speciality_result" class="speciality_result_experience-{{ $l }}" value="{{ $ptl->id }}">
                                                                <div class="speciality_data drp--clr drpdown-set d-none speciality_y_{{ $ptl->id }}" id="specility_level_experience-{{ $l }}">
                                                                    <label class="form-label" for="input-2">{{ $ptl->name }}</label>
                                                                    <ul id="speciality_entry_experience-{{ $l }}" style="display:none;">
                                                                        @foreach($speciality_data as $sd)
                                                                        <li data-value="{{ $sd->id }}">{{ $sd->name }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="speciality_entry_experience-{{ $l }}" name="speciality_entry_experience_{{ $l }}[1][]" multiple="multiple"></select>
                                                                </div>
                                                                <?php
                                                                $l++;
                                                                ?>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <div class="surgical_div_experience">
                                                                <div class="surgical_row_data_experience form-group drp--clr d-none col-md-12">
                                                                    <label class="form-label" for="input-1">Surgical Preoperative and Postoperative Care:</label>
                                                                    <?php
                                                                    $speciality_surgicalrow_data = DB::table("speciality")->where('parent', '96')->get();
                                                                    $r = 1;
                                                                    ?>
                                                                    <ul id="surgical_row_box_experience" style="display:none;">
                                                                        @foreach($speciality_surgicalrow_data as $ssrd)
                                                                        <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_row_box_experience" name="surgical_row_box_experience[1][]" multiple="multiple"></select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <div class="paediatric_surgical_div_experience">
                                                                <div class="surgicalpad_row_data_experience drp--clr d-none ">
                                                                    <label class="form-label" for="input-1">Paediatric Surgical Preop. and Postop. Care:
                                                                    </label>
                                                                    <?php
                                                                    $speciality_padsurgicalrow_data = DB::table("speciality")->where('parent', '285')->get();
                                                                    $r = 1;
                                                                    ?>
                                                                    <ul id="surgical_rowpad_box_experience" style="display:none;">
                                                                        @foreach($speciality_padsurgicalrow_data as $ssrd)
                                                                        <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_rowpad_box_experience" name="surgical_rowpad_box_experience[1][]" multiple="multiple"></select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="specialty_sub_boxes_experience">
                                                        <div class="col-md-12 mt-3">
                                                            <div class="form-group">
                                                                <?php
                                                                $speciality_surgical_data = DB::table("speciality")->where('parent', '96')->get();
                                                                $w = 1;
                                                                ?>
                                                                @foreach($speciality_surgical_data as $ssd)
                                                                <input type="hidden" name="speciality_result" class="speciality_surgical_result_experience-{{ $w }}" value="{{ $ssd->id }}">
                                                                <div class="surgical_row_experience-{{ $w }} surgicalopcboxes1-{{ $ssd->id }} drp--clr d-none drpdown-set">
                                                                    <label class="form-label" for="input-1">{{ $ssd->name }}</label>
                                                                    <?php
                                                                    $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->get();
                                                                    ?>
                                                                    <ul id="surgical_operative_care_experience-{{ $w }}" style="display:none;">
                                                                        @foreach($speciality_surgicalsub_data as $sssd)
                                                                        <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_operative_care_experience-{{ $w }}" name="surgical_operative_care_exp_{{ $w }}[1][]" multiple="multiple"></select>

                                                                </div>
                                                                <?php
                                                                $w++;
                                                                ?>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <div class="form-group">
                                                                <?php
                                                                $speciality_surgical_datamater = DB::table("speciality")->where('parent', '233')->get();
                                                                $p = 1;
                                                                ?>
                                                                <div class="surgicalobs_row_experience drp--clr d-none drpdown-set">
                                                                    <label class="form-label" for="input-1">Surgical Obstetrics and Gynecology (OB/GYN):</label>
                                                                    <ul id="surgicalobs_row_data_experience" style="display:none;">
                                                                        @foreach($speciality_surgical_datamater as $ssd)
                                                                        <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgicalobs_row_data_experience" name="surgical_obs_care_exp[1][]" multiple="multiple"></select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <div class="form-group">
                                                                <?php
                                                                $speciality_surgical_datamater = DB::table("speciality")->where('parent', '250')->get();

                                                                ?>
                                                                <div class="neonatal_row_experience drp--clr drpdown-set d-none">
                                                                    <label class="form-label" for="input-1">Neonatal Care:</label>

                                                                    <ul id="neonatal_care_experience" style="display:none;">
                                                                        @foreach($speciality_surgical_datamater as $ssd)
                                                                        <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="neonatal_care_experience" name="neonatal_care_experience[1][]" multiple="multiple"></select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <div class="form-group">
                                                                <?php
                                                                $speciality_surgical_datap = DB::table("speciality")->where('parent', '285')->get();
                                                                $q = 1;
                                                                ?>
                                                                @foreach($speciality_surgical_datap as $ssd)
                                                                <input type="hidden" name="speciality_result" class="surgical_rowp_result_experience-{{ $q }}" value="{{ $ssd->id }}">
                                                                <div class="surgical_rowp_experience surgicalpad_row_experience-{{ $ssd->id }} surgical_rowp_experience-{{ $q }} drp--clr d-none drpdown-set">
                                                                    <label class="form-label" for="input-1">{{ $ssd->name }}</label>
                                                                    <?php
                                                                    $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->orderBy('name')->get();
                                                                    ?>
                                                                    <ul id="surgical_operative_carep_experience-{{ $q }}" style="display:none;">
                                                                        @foreach($speciality_surgicalsub_data as $sssd)
                                                                        <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_operative_carep_experience-{{ $q }}" name="surgical_operative_carep_experience_{{ $q }}[1][]" multiple="multiple"></select>
                                                                </div>
                                                                <?php
                                                                $q++;
                                                                ?>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>What is your level of experience?</strong></label>
                                                            <select class="form-control mr-10 select-active" name="assistent_level" id="assistent_level">
                                                                @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                                                                    @endfor
                                                            </select>
                                                            <span id="experience_error" class="reqError text-danger valley "></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group level-drp">
                                                            <label class="form-label" for="input-1">Position Held</label>
                                                            <select class="form-control pos_held pos_held_1" name="positions_held[1]">
                                                                <option value="">select</option>
                                                                <option value="Team Member">Team Member</option>
                                                                <option value="Team Leader">Team Leader</option>
                                                                <option value="Educator">Educator</option>
                                                                <option value="Manager">Manager</option>
                                                                <option value="Clinical Specialist">Clinical Specialist</option>
                                                                <option value="Charge Nurse">Charge Nurse</option>
                                                                <option value="Nurse Supervisor">Nurse Supervisor</option>
                                                                <option value="Nursing Director">Nursing Director</option>
                                                                <option value="Assistant Director of Nursing">Assistant Director of Nursing</option>
                                                                <option value="Head Nurse">Head Nurse</option>
                                                                <option value="Nurse Coordinator">Nurse Coordinator</option>
                                                                <option value="Staff Nurse">Staff Nurse</option>
                                                            </select>
                                                            <span id="reqpositionheld-1" class="reqError text-danger valley"></span>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Employment Start Date</strong></label>
                                                            <input class="form-control employeement_start_date_exp employeement_start_date_exp-1" type="date" name="start_date[1]" onkeydown="return false">
                                                            <span id="reqempsdateexp-1" class="reqError text-danger valley"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-3 empl_end_date-1">
                                                        <div class="form-group">
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Employment End Date</strong></label>
                                                            <input class="form-control employeement_end_date_exp employeement_end_date_exp-1" type="date" name="end_date[1]" onkeydown="return false">
                                                            <span id="reqemployeementenddateexp-1" class="reqError text-danger valley"></span>
                                                        </div>
                                                    </div>

                                                    <div class="present_check mt-3">
                                                        <input class="currently_position currently_position-1" type="checkbox" name="present_box[1]" value="1" onclick="currently_position(1)">I am currently in this position at the moment
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Employment type</strong></label>
                                                            <select class="form-control emp_exp_type emp_exp_type-1" name="employeement_type[1]" onchange="ExpEmpStatus(this.value)">
                                                                <option value="">select</option>
                                                                <option value="Permanent">Permanent</option>
                                                                <option value="Temporary">Temporary</option>
                                                            </select>
                                                            <span id="reqemptype-1" class="reqError text-danger valley"></span>
                                                        </div>
                                                    </div>
                                                    <div class="exp_permanent" style="display: none;">
                                                        <div class="form-group col-md-12">
                                                            <label class="form-label" for="input-1">Permanent</label>
                                                            <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                                                            <select class="form-input mr-10 select-active" name="permanent_status[1]">
                                                                <option value="">Select</option>
                                                                <option value="Full-time">Full-time</option>
                                                                <option value="Part-time">Part-time</option>
                                                                <option value="Agency Nurse/Midwife">Agency Nurse/Midwife</option>
                                                                <option value="Freelance">Freelance</option>
                                                                <option value="Local">Local</option>
                                                                <option value="Volunteer">Volunteer</option>

                                                            </select>
                                                        </div>
                                                        <span id="reqemployee_status" class="reqError text-danger valley"></span>
                                                    </div>

                                                    <div class="exp_temporary" style="display: none;">
                                                        <div class="form-group col-md-12">
                                                            <label class="form-label" for="input-1">Temporary</label>
                                                            <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                                                            <select class="form-input mr-10 select-active" name="temporary_status[1]">
                                                                <option value="">Select</option>
                                                                <option value="Temporary">Temporary</option>
                                                                <option value="Contract">Contract</option>
                                                                <option value="Term Contract">Term Contract</option>
                                                                <option value="Travel">Travel</option>
                                                                <option value="Per Diem">Per Diem</option>
                                                                <option value="Local">Local</option>
                                                                <option value="On-Call">On-Call</option>
                                                                <option value="PRN (Pro Re Nata)">PRN (Pro Re Nata)</option>
                                                                <option value="Casual">Casual</option>
                                                                <option value="Locum tenens (temporary substitute)">Locum tenens (temporary substitute)</option>
                                                                <option value="Agency Nurse/Midwife">Agency Nurse/Midwife</option>
                                                                <option value="Seasonal">Seasonal</option>
                                                                <option value="Freelance">Freelance</option>
                                                                <option value="Internship">Internship</option>
                                                                <option value="Apprenticeship">Apprenticeship</option>
                                                                <option value="Residency">Residency</option>
                                                                <option value="Volunteer">Volunteer</option>
                                                            </select>
                                                        </div>
                                                        <span id="reqemployee_status" class="reqError text-danger valley"></span>
                                                    </div>

                                                    <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Detailed Job Descriptions</h4>
                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Responsibilities</strong></label>
                                                            <textarea class="form-control res-exp res-exp-1" name="job_responeblities[1]"></textarea>
                                                            <span id="reqresposiblitiesexp-1" class="reqError text-danger valley"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Achievements</strong></label>
                                                            <textarea class="form-control ach_exp ach_exp-1" name="achievements[1]"></textarea>
                                                            <span id="reqachievementsexp-1" class="reqError text-danger valley"></span>
                                                        </div>
                                                    </div>
                                                    <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Areas of Expertise</h4>
                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group level-drp">
                                                            <label class="form-label" for="input-1">Specific skills and competencies</label>
                                                            <?php
                                                            $skills = DB::table("skills")->where("parent_id", "1")->get();
                                                            ?>
                                                            <ul id="skills_compantancies" style="display:none;">
                                                                @foreach($skills as $cert)
                                                                <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                                                                @endforeach
                                                            </ul>
                                                            <select class="js-example-basic-multiple addAll_removeAll_btn spe_skill spe_skill_1" data-list-id="skills_compantancies" name="skills_compantancies[1][]" multiple="multiple"></select>
                                                        </div>
                                                        <span id="reqexpertiseexp-1" class="reqError text-danger valley"></span>
                                                    </div>
                                                    <div class="skills_compantancies_dropdowns"></div>
                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group level-drp">
                                                            <label class="form-label" for="input-1">Type of evidence</label>
                                                            <ul id="type_of_evidence" style="display:none;">
                                                                <li data-value="Statement of Service">Statement of Service</li>
                                                                <li data-value="Statutory Declaration">Statutory Declaration</li>
                                                                <li data-value="Award">Award</li>
                                                                <li data-value="Transcript">Transcript</li>
                                                                <li data-value="Certificate">Certificate</li>
                                                            </ul>
                                                            <select class="js-example-basic-multiple addAll_removeAll_btn type_of_evi type_of_evi_1" data-list-id="type_of_evidence" name="type_of_evidence[1][]" multiple="multiple"></select>
                                                            <span id="reqtype_evidenceexp-1" class="reqError text-danger valley"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Upload evidence</strong></label>
                                                            <input class="form-control change_evi" type="file" name="upload_evidence[1][]" multiple="" id="1">
                                                            <div class="fileList  fileList_1"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <!-- Add Delete Button -->
                                                        <div class="add_new_certification_div_2">
                                                            <a
                                                                style="cursor: pointer; margin-bottom: 35px !important;"
                                                                class="delete-work-experience">
                                                                - Delete Work Experience
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="add_new_certification_div awe mb-3 mt-4">
                                            <a style="cursor: pointer;" onclick="add_work_experience()">+ Add another work experience</a>
                                        </div>

                                        <?php $decvalue = $experienceData;
                                        if ($experienceData) {
                                            foreach ($decvalue as $key => $value) {
                                                if ($key === 0) {
                                                    $firstValue = $value; // Get the first value
                                                    break; // Exit the loop
                                                }
                                            }
                                        }
                                        // dd($firstValue);
                                        ?>
                                        <div class="declaration_box">
                                            <input type="checkbox" name="exp_declare_information" class="exp_declare_information" value="1" @if(!empty($firstValue)) @if($firstValue->declaration_status == 1) checked onclick="return false;" @endif @endif>
                                            <label for="declare_information">I declare that the information provided is true and correct</label>
                                            @if(!empty($firstValue->declaration_status) && $firstValue->declaration_status == 1)
                                            <input type="hidden" name="exp_declare_information" value="1">
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <button type="submit" class="btn btn-default next-step-56 align-items-center justify-content-between" data-target="#navpill-6">Next</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="get_new_plice_checkModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-semibold" id="exampleModalLabel">GET NEW POLICE CHECK</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="paydatadata">A Police Check is a requirement for clinical practice in Australia. As this is also your identity check, uPaged can only accept checks via our preferred partner using the link below. The Police Check costs $42.90, and once you have completed 5 uPaged shifts we will reimburse you this cost if you email your invoice to hello@medica.com. HEADS UP: This will take you up to 15 minutes You’ll need 4 identification documents</p>
            </div>
            <!-- <a href="javascript:void(0);" class="btn btn-sm mybtn p-0 px-2 m-0 " data-bs-dismiss="modal" aria-label="Close" type="button">Ok</a>   -->
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript"
    src="https://nextjs.webwiders.in/pindrow/public/advertiser/dist/libs/owl.carousel/dist/owl.carousel.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').on('select2:open', function() {
            // Reference the currently opened Select2 dropdown
            var select2Container = $(this).data('select2').$dropdown;
            var resultsContainer = select2Container.find('.select2-results');

            // Adding additional search box
            var searchBoxHtml = `
            <div class="extra-search-container">
                <input type="text" class="extra-search-box" placeholder="Search...">
                <button class="clear-button" type="button">&times;</button>
            </div>`;

            var buttonsHtml = `
            <div class="extra-buttons">
                <button class="select-all-button" type="button">Select All</button>
                <button class="remove-all-button" type="button">Remove All</button>
            </div>`;

            // Remove any existing elements to avoid duplication
            resultsContainer.find('.extra-search-container').remove();
            resultsContainer.find('.extra-buttons').remove();

            // Prepend search box and buttons
            resultsContainer.prepend(buttonsHtml + searchBoxHtml);

            var $searchBox = resultsContainer.find('.extra-search-box');
            var $clearButton = resultsContainer.find('.clear-button');

            // Handle input event for search box
            $searchBox.on('input', function() {
                var searchTerm = $(this).val().toLowerCase();
                resultsContainer.find('.select2-results__option').each(function() {
                    var text = $(this).text().toLowerCase();
                    if (text.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                $clearButton.toggle($searchBox.val().length > 0);
            });

            // Clear button functionality
            $clearButton.on('click', function() {
                $searchBox.val('');
                $searchBox.trigger('input');
            });

            var $dropdown = $(this); // Reference the current dropdown

            // Handle Select All button
            resultsContainer.find('.select-all-button').on('click', function() {
                var allValues = $dropdown.find('option').map(function() {
                    return $(this).val();
                }).get();
                $dropdown.val(allValues).trigger('change');
            });

            // Handle Remove All button
            resultsContainer.find('.remove-all-button').on('click', function() {
                $dropdown.val(null).trigger('change');
            });
        });
    });

    // $(document).ready(function() {
    // Add an additional search box to the dropdown
    // $('.js-example-basic-multiple').on('select2:open', function() {
    //     var searchBoxHtml = `
    //     <div class="extra-search-container">
    //         <input type="text" class="extra-search-box" placeholder="Search...">
    //         <button class="clear-button" type="button">&times;</button>
    //     </div>`;

    //     if ($('.select2-results').find('.extra-search-container').length === 0) {
    //         $('.select2-results').prepend(searchBoxHtml);
    //     }

    //     var $searchBox = $('.extra-search-box');
    //     var $clearButton = $('.clear-button');

    //     $searchBox.on('input', function() {

    //         var searchTerm = $(this).val().toLowerCase();
    //         $('.select2-results__option').each(function() {
    //             var text = $(this).text().toLowerCase();
    //             if (text.includes(searchTerm)) {
    //                 $(this).show();
    //             } else {
    //                 $(this).hide();
    //             }
    //         });
    //         $clearButton.toggle($searchBox.val().length > 0);
    //     });

    //     $clearButton.on('click', function() {
    //         $searchBox.val('');
    //         $searchBox.trigger('input');
    //     });
    // });

    // });
</script>

<script>
    $(document).ready(function() {
        // $('.addAll_removeAll_btn').on('select2:open', function() {
        //     var $dropdown = $(this);
        //     // var $dropdown = $(this).data('select2').$dropdown;
        //     var searchBoxHtml = `
        //         <div class="extra-buttons">
        //             <button class="select-all-button" type="button">Select All</button>
        //             <button class="remove-all-button" type="button">Remove All</button>
        //         </div>`;

        //     // Remove any existing extra buttons before adding new ones
        //     $('.select2-results .extra-search-container').remove();
        //     $('.select2-results .extra-buttons').remove();

        //     // Append the new extra buttons and search box
        //     $('.select2-results').prepend(searchBoxHtml);

        //     // Handle Select All button for the current dropdown
        //     $('.select-all-button').on('click', function() {
        //         var $currentDropdown = $dropdown;
        //         var allValues = $currentDropdown.find('option').map(function() {
        //             return $(this).val();
        //         }).get();
        //         $currentDropdown.val(allValues).trigger('change');
        //     });

        //     // Handle Remove All button for the current dropdown
        //     $('.remove-all-button').on('click', function() {
        //         var $currentDropdown = $dropdown;
        //         $currentDropdown.val(null).trigger('change');
        //     });
        // });

    });

    $(document).ready(function() {
        $('.js-example-basic-multiple').each(function() {
            let listId = $(this).data('list-id');
            let items = [];
            ////console.log("listId1", listId);
            $('#' + listId + ' li').each(function() {
                let itemId = $(this).data('value');
                let itemText = $(this).text();
                ////console.log("value1", $(this).text());
                if (!items.some(item => item.id === itemId)) {
                    items.push({
                        id: $(this).data('value'),
                        text: $(this).text()
                    });
                }
            });
            ////console.log("items1", items);
            $(this).select2({
                data: items
            });
            //$("#type-of-nurse").select2({'val': 3});          
        });
    });
</script>

<script>
    let previous_employeers_head = parseInt($("#exp_data_count").val(), 10) + 1;
    //  for add another work exp js
    function add_work_experience() {
        // var previous_employeers_head = $(".previous_employeers_head").length;
        // previous_employeers_head++;
        $(".previous_employeers").append(`
            <div class="work_exp work_exp_${previous_employeers_head}">
                <h6 class="fw-bolder fs-6 lh-base d-flex align-items-center emergency_text previous_employeers_head">Work Experience ${previous_employeers_head}</h6>
                <div class="col-md-12 mt-3">
                    <div class="form-group drp--clr">
                        <label class="form-label" for="input-1">Type of Nurse?</label>
                        <input type="hidden" name="user_id" class="user_id" value="">
                        <ul id="type-of-nurse-experience-${previous_employeers_head}" style="display:none;">
                            @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                            <?php
                            $j = 1;
                            ?>
                            @foreach($specialty as $spl)
                            <li id="nursing_menus-{{ $j }}" data-value="{{ $spl->id }}">{{ $spl->name }}</li>
                            <?php
                            $j++;
                            ?>
                            @endforeach
                        </ul>
                        <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn nurse_type_exp nurse_type_exp_${previous_employeers_head}" data-list-id="type-of-nurse-experience-${previous_employeers_head}" name="nurseType[${previous_employeers_head}][]" id="nurse_type_experience_${previous_employeers_head}" multiple="multiple"></select>
                    </div>
                    <span id="reqnurseTypeexpId-${previous_employeers_head}" class="reqError text-danger valley"></span>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="result--show">
                        <div class="container p-0">
                            <div class="row g-2">
                            @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                            <?php
                            $i = 1;
                            ?>
                            @foreach($specialty as $spl)
                            <?php
                            $nursing_data = DB::table("practitioner_type")->where('parent', $spl->id)->orderBy('name')->get();
                            ?>
                            <input type="hidden" name="nursing_result_experience" class="nursing_result_experience-${previous_employeers_head}-{{ $i }}" value="{{ $spl->id }}">
                            <div class="nursing_data form-group drp--clr d-none drpdown-set nursing_expu_{{ $spl->id }}" id="nursing_level_experience1-${previous_employeers_head}-{{ $i }}">
                                <label class="form-label" for="input-2">{{ $spl->name }}</label>
                                <ul id="nursing_entry_experience-${previous_employeers_head}-{{ $i }}" style="display:none;">
                                    @foreach($nursing_data as $nd)
                                    <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                    @endforeach
                                </ul>
                                <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="nursing_entry_experience-${previous_employeers_head}-{{ $i }}" name="nursing_type_{{ $i }}[${previous_employeers_head}][]" multiple="multiple"></select>
                            </div>
                            <?php
                            $i++;
                            ?>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="np_submenu_experience_${previous_employeers_head} d-none">
                        <div class="form-group drp--clr">
                            <?php
                            $np_data = DB::table("practitioner_type")->where('parent', '179')->get();
                            ?>
                            <label class="form-label" for="input-1">Nurse Practitioner (NP):</label>
                            <ul id="nurse_practitioner_menu_experience-${previous_employeers_head}" style="display:none;">
                            @foreach($np_data as $nd)
                            <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                            @endforeach
                            </ul>
                            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="nurse_practitioner_menu_experience-${previous_employeers_head}" name="nurse_practitioner_menu_experience[${previous_employeers_head}][]" multiple="multiple"></select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <div class="condition_set">
                            <div class="form-group drp--clr">
                            <input type="hidden" name="sub_speciality_value" class="sub_speciality_value" value="">
                            <label class="form-label" for="input-1">Specialties</label>
                            <ul id="specialties_experience-${previous_employeers_head}" style="display:none;">
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
                            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn spec_exp spec_exp_${previous_employeers_head}" data-list-id="specialties_experience-${previous_employeers_head}" name="specialties_experience[${previous_employeers_head}][]" multiple="multiple"></select>
                            </div>
                            <span id="reqspecialtiesexp-${previous_employeers_head}" class="reqError text-danger valley"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <div class="speciality_boxes result--show">
                            <?php
                            $l = 1;
                            ?>
                            @foreach($JobSpecialties as $ptl)
                            <?php
                            $speciality_data = DB::table("speciality")->where('parent', $ptl->id)->get();
                            ?>
                            <input type="hidden" name="speciality_result" class="speciality_result_experience-${previous_employeers_head}-{{ $l }}" value="{{ $ptl->id }}">
                            <div class="speciality_data form-group drp--clr drpdown-set d-none col-md-12 speciality_{{ $ptl->id }}" id="specility_level_experience-${previous_employeers_head}-{{ $l }}">
                            <label class="form-label" for="input-2">{{ $ptl->name }}</label>
                            <ul id="speciality_entry_experience-${previous_employeers_head}-{{ $l }}" style="display:none;">
                                @foreach($speciality_data as $sd)
                                <li data-value="{{ $sd->id }}">{{ $sd->name }}</li>
                                @endforeach
                            </ul>
                            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="speciality_entry_experience-${previous_employeers_head}-{{ $l }}" name="speciality_entry_experience_{{ $l }}[${previous_employeers_head}][]" multiple="multiple"></select>
                            </div>
                            <?php
                            $l++;
                            ?>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="specialty_entry_one_experience"></div>
                <div class="specialty_entry_two_experience"></div>
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <div class="paediatric_surgical_div_experience-${previous_employeers_head}">
                            <div class="surgicalpad_row_data_experience-${previous_employeers_head} form-group drp--clr d-none col-md-12">
                            <label class="form-label" for="input-1">Paediatric Surgical Preop. and Postop. Care:
                            </label>
                            <?php
                            $speciality_padsurgicalrow_data = DB::table("speciality")->where('parent', '285')->get();
                            $r = 1;
                            ?>
                            <ul id="surgical_rowpad_box_experience-${previous_employeers_head}" style="display:none;">
                                @foreach($speciality_padsurgicalrow_data as $ssrd)
                                <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                                @endforeach
                            </ul>
                            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="surgical_rowpad_box_experience-${previous_employeers_head}" name="surgical_rowpad_box_experience[${previous_employeers_head}][]" multiple="multiple"></select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="specialty_sub_boxes_experience-${previous_employeers_head}">
                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <?php
                            $speciality_surgical_data = DB::table("speciality")->where('parent', '96')->get();
                            $w = 1;
                            ?>
                            @foreach($speciality_surgical_data as $ssd)
                            <input type="hidden" name="speciality_result" class="speciality_surgical_result_experience-${previous_employeers_head}-{{ $w }}" value="{{ $ssd->id }}">
                            <div class="surgical_row_experience-${previous_employeers_head}-{{ $w }} surgical_sub-${previous_employeers_head}  surgicalopcboxes-{{ $ssd->id }} form-group drp--clr d-none drpdown-set">
                            <label class="form-label" for="input-1">{{ $ssd->name }}</label>
                            <?php
                            $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->get();
                            ?>
                            <ul id="surgical_operative_care_experience-${previous_employeers_head}-{{ $w }}" style="display:none;">
                                @foreach($speciality_surgicalsub_data as $sssd)
                                <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                                @endforeach
                            </ul>
                            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="surgical_operative_care_experience-${previous_employeers_head}-{{ $w }}" name="surgical_operative_care_exp_{{ $w }}[${previous_employeers_head}][]" multiple="multiple"></select>
                            @foreach($speciality_surgicalsub_data as $sssd)
                            <div class="d-none form-group level-drp level_id-{{ $sssd->id }}">
                                <label class="form-label" for="input-1">What is your Level of experience in {{ $sssd->name }}:
                                </label>
                                <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                                <select class="form-input mr-10 select-active" name="assistent_level">
                                    @for($i = 1; $i <= 30; $i++) 
                                    <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                                    @endfor
                                </select>
                            </div>
                            @endforeach
                            </div>
                            <?php
                            $w++;
                            ?>
                            @endforeach
                        </div>
                    </div>
                    <div class="surgical_operative_care_level_experience"></div>
                    <div class="surgical_operative_care_level_experience_two"></div>
                    <div class="surgical_operative_care_level_experience_three"></div>
                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <?php
                            $speciality_surgical_datamater = DB::table("speciality")->where('parent', '233')->get();
                            $p = 1;
                            ?>
                            <div class="surgicalobs_row_experience-${previous_employeers_head} drp--clr d-none drpdown-set">
                            <label class="form-label" for="input-1">Surgical Obstetrics and Gynecology (OB/GYN):</label>
                            <ul id="surgicalobs_row_data_experience-${previous_employeers_head}" style="display:none;">
                                @foreach($speciality_surgical_datamater as $ssd)
                                <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                @endforeach
                            </ul>
                            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="surgicalobs_row_data_experience-${previous_employeers_head}" name="surgical_obs_care_exp[${previous_employeers_head}][]" multiple="multiple"></select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <?php
                            $speciality_surgical_datamater = DB::table("speciality")->where('parent', '250')->get();
                            ?>
                            <div class="neonatal_row_experience-${previous_employeers_head} form-group drp--clr drpdown-set d-none col-md-12">
                            <label class="form-label" for="input-1">Neonatal Care:</label>
                            <ul id="neonatal_care_experience-${previous_employeers_head}" style="display:none;">
                                @foreach($speciality_surgical_datamater as $ssd)
                                <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                @endforeach
                            </ul>
                            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="neonatal_care_experience-${previous_employeers_head}" name="neonatal_care_experience[${previous_employeers_head}][]" multiple="multiple"></select>
                            </div>
                        </div>
                        <div class="neonatal_care_experience_level-${previous_employeers_head}"></div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <?php
                            $speciality_surgical_datap = DB::table("speciality")->where('parent', '285')->get();
                            $q = 1;
                            ?>
                            @foreach($speciality_surgical_datap as $ssd)
                            <input type="hidden" name="speciality_result" class="surgical_rowp_result_experience-${previous_employeers_head}-{{ $q }}" value="{{ $ssd->id }}">
                            <div class="surgical_rowp_experience-${previous_employeers_head} surgicalpad_row_experience-{{ $ssd->id }} surgical_rowp_experience-${previous_employeers_head}-{{ $q }} drp--clr d-none drpdown-set">
                            <label class="form-label" for="input-1">{{ $ssd->name }}</label>
                            <?php
                            $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->orderBy('name')->get();
                            ?>
                            <ul id="surgical_operative_carep_experience-${previous_employeers_head}-{{ $q }}" style="display:none;">
                                @foreach($speciality_surgicalsub_data as $sssd)
                                <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                                @endforeach
                            </ul>
                            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="surgical_operative_carep_experience-${previous_employeers_head}-{{ $q }}" name="surgical_operative_carep_experience_{{ $q }}[${previous_employeers_head}][]" multiple="multiple"></select>
                            </div>
                            <?php
                            $q++;
                            ?>
                            @endforeach
                        </div>
                    </div>
                    <div class="surgical_operative_carep_level_one"></div>
                    <div class="surgical_operative_carep_level_two"></div>
                    <div class="surgical_operative_carep_level_three"></div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <div class="level-drp">
                            <label class="form-label" for="input-1">What is your Level of experience in this specialty?
                            </label>
                            <select class="form-control mr-10 select-active" name="exper_assistent_level[${previous_employeers_head}]">
                            @for($i = 1; $i <= 30; $i++) 
                            <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                            @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <div class="level-drp">
                            <label class="form-label" for="positions_held">Position Held</label>
                            <select class="form-control pos_held pos_held_${previous_employeers_head}" name="positions_held[${previous_employeers_head}]" id="positions_held">
                            <option value="">Position Held</option>
                            <option value="Team Member">Team Member</option>
                            <option value="Team Leader">Team Leader</option>
                            <option value="Educator">Educator</option>
                            <option value="Manager">Manager</option>
                            <option value="Clinical Specialist">Clinical Specialist</option>
                            </select>
                            <span id="reqpositionheld-${previous_employeers_head}" class="reqError text-danger valley"></span>
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="col-md-12">
                        <div class="form-group level-drp">
                            <label class="form-label" for="start_date_${previous_employeers_head}">Employment Start Date</label>
                            <input class="form-control employeement_start_date_exp employeement_start_date_exp-${previous_employeers_head}" 
                            type="date" 
                            name="start_date[${previous_employeers_head}]" 
                            id="start_date_${previous_employeers_head}" 
                            >
                            <span id="reqempsdateexp-${previous_employeers_head}" class="reqError text-danger valley"></span>
                        </div>
                    </div>

                    <div class="declaration_box mt-2 mb-2">
                        <input class="currently_position currently_position-${previous_employeers_head}" type="checkbox" name="present_box[${previous_employeers_head}][]" value="1" onclick="currently_position(${previous_employeers_head})">
                        I am currently in this position at the moment
                    </div>

                    <div class="col-md-12 empl_end_date-${previous_employeers_head}">
                        <div class="form-group level-drp">
                            <label class="form-label" for="end_date_${previous_employeers_head}">Employment End Date</label>
                            <input class="form-control employeement_end_date_exp employeement_end_date_exp-${previous_employeers_head}" 
                            type="date" 
                            name="end_date[${previous_employeers_head}]" 
                            id="end_date_${previous_employeers_head}">
                            <span id="reqemployeementenddateexp-${previous_employeers_head}" class="reqError text-danger valley"></span>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="col-md-12">
                        <div class="form-group level-drp">
                            <label class="form-label" for="employment_type">Employment type</label>
                            <select
                            class="form-control emp_exp_type emp_exp_type-${previous_employeers_head}"
                            name="employeement_type[${previous_employeers_head}]"
                            id="employment_type_${previous_employeers_head}"
                            ">
                            <option value="">select</option>
                            <option value="Permanent">Permanent</option>
                            <option value="Temporary">Temporary</option>
                            </select>
                            <span id="reqemptype-${previous_employeers_head}" class="reqError text-danger valley"></span>
                        </div>
                    </div>
                </div>
                <div class="exp_permanent_${previous_employeers_head}" style="display: none;" >
                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <label class="form-label" for="input-1">Permanent</label>
                            <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                            <select class="form-control" name="permanent_status[${previous_employeers_head}]">
                            <option value="">Select</option>
                            <option value="Full-time">Full-time</option>
                            <option value="Part-time">Part-time</option>
                            <option value="Agency Nurse/Midwife">Agency Nurse/Midwife</option>
                            <option value="Freelance">Freelance</option>
                            <option value="Local">Local</option>
                            <option value="Volunteer">Volunteer</option>
                            </select>
                        </div>
                        <span id="reqemployee_status" class="reqError text-danger valley"></span>
                    </div>
                </div>
                <div class="exp_temporary_${previous_employeers_head}" style="display: none; >
                    <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <label class="form-label" for="input-1">Temporary</label>               
                        <select class="form-control" name="temporary_status[${previous_employeers_head}]">
                            <option value="">Select</option>
                            <option value="Temporary">Temporary</option>
                            <option value="Contract">Contract</option>
                            <option value="Term Contract">Term Contract</option>
                            <option value="Travel">Travel</option>
                            <option value="Per Diem">Per Diem</option>
                            <option value="Local">Local</option>
                            <option value="On-Call">On-Call</option>
                            <option value="PRN (Pro Re Nata)">PRN (Pro Re Nata)</option>
                            <option value="Casual">Casual</option>
                            <option value="Locum tenens (temporary substitute)">Locum tenens (temporary substitute)</option>
                            <option value="Agency Nurse/Midwife">Agency Nurse/Midwife</option>
                            <option value="Seasonal" >Seasonal</option>
                            <option value="Freelance">Freelance</option>
                            <option value="Internship">Internship</option>
                            <option value="Apprenticeship">Apprenticeship</option>
                            <option value="Residency">Residency</option>
                            <option value="Volunteer">Volunteer</option>
                        </select>
                    </div>
                    <span id="reqemployee_status" class="reqError text-danger valley"></span>
                </div>
               
                <h6 class="emergency_text fw-bolder fs-6 lh-base d-flex align-items-center mt-2">Detailed Job Descriptions</h6>
                <div class="col-md-12 mt-3">
                <div class="form-group level-drp">
                    <label class="form-label" for="job_responsibilities">Responsibilities</label>
                    <textarea class="form-control res-exp res-exp-${previous_employeers_head}" name="job_responeblities[${previous_employeers_head}]" id="job_responsibilities"></textarea>
                    <span id="reqresposiblitiesexp-${previous_employeers_head}" class="reqError text-danger valley"></span>
                </div>
                </div>
                <div class="col-md-12 mt-3">
                <div class="form-group level-drp">
                    <label class="form-label" for="achievements">Achievements</label>
                    <textarea class="form-control ach_exp ach_exp-${previous_employeers_head}" name="achievements[${previous_employeers_head}]" id="achievements"></textarea>
                    <span id="reqachievementsexp-${previous_employeers_head}" class="reqError text-danger valley"></span>
                </div>
                </div>
                <h6 class="emergency_text">
                Areas of Expertise
                </h6>
                <div class="col-md-12 mt-3">
                <div class="form-group level-drp">
                    <label class="form-label" for="input-1">Specific skills and competencies</label>
                    <?php
                    $skills = DB::table("skills")->where("parent_id", "1")->get();
                    ?>
                    <ul id="skills_compantancies-${previous_employeers_head}" style="display:none;">
                        @foreach($skills as $cert)
                        <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                        @endforeach
                    </ul>
                    <select class="spe_skill spe_skill_${previous_employeers_head} js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="skills_compantancies-${previous_employeers_head}" name="skills_compantancies[${previous_employeers_head}][]" multiple="multiple"></select>
                </div>
                <span id="reqexpertiseexp-${previous_employeers_head}" class="reqError text-danger valley"></span>
                </div>
                <div class="skills_compantancies_dropdowns-${previous_employeers_head}"></div>
                <div class="col-md-12 mt-3">
                <div class="form-group level-drp">
                    <label class="form-label" for="input-1">Type of evidence</label>
                    <?php
                    $skills = DB::table("skills")->get();
                    ?>
                    <ul id="type_of_evidence" style="display:none;">
                        <li data-value="Statement of Service">Statement of Service</li>
                        <li data-value="Statutory Declaration">Statutory Declaration</li>
                        <li data-value="Award">Award</li>
                        <li data-value="Transcript">Transcript</li>
                        <li data-value="Certificate">Certificate</li>
                    </ul>
                    <select class="type_of_evi type_of_evi_${previous_employeers_head} js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn" data-list-id="type_of_evidence" name="type_of_evidence[${previous_employeers_head}][]" multiple="multiple"></select>
                    <span id="reqtype_evidenceexp-${previous_employeers_head}" class="reqError text-danger valley"></span>
                </div>
                </div>
                <div class="col-md-12 mt-3">
                <div class="form-group level-drp">
                    <label class="form-label" for="input-1">Upload evidence</label>
                    <input class="form-control change_evi" type="file" name="upload_evidence[${previous_employeers_head}][]" id="${previous_employeers_head}" multiple>
                    <div class="fileList  fileList_${previous_employeers_head}"></div>
                    <!-- <span id="reqachievements" class="reqError text-danger valley"></span> -->
                </div>
                </div>
                <div class="col-md-12">
                <!-- Add Delete Button -->
                <div class="add_new_certification_div_2">
                    <a style="cursor: pointer; margin-bottom: 35px !important;" 
                        class="delete-work-experience" 
                      ">
                    - Delete Work Experience
                    </a>
                </div>
                </div>
            </div>
        `);

        function ExpEmpStatus1(value, id) {
            if (value == "Permanent") {
                $(".exp_permanent_" + id).show();
                $(".exp_temporary_" + id).hide();
            } else {
                if (value == "Temporary") {
                    $(".exp_temporary_" + id).show();
                    $(".exp_permanent_" + id).hide();
                }
            }
        }

        $(document).on('change', '[id=employment_type_' + previous_employeers_head + ']', function() {
            var value = $(this).val();
            ExpEmpStatus1(value, previous_employeers_head);
        });


        $('.js-example-basic-multiple' + previous_employeers_head).each(function() {
            let listId1 = $(this).data('list-id');
            //alert(listId);
            let items1 = [];
            //console.log("listId1", listId1);
            $('#' + listId1 + ' li').each(function() {
                //console.log("value1", $(this).text());
                items1.push({
                    id: $(this).data('value'),
                    text: $(this).text()
                });
            });
            //console.log("items1", items1);
            $(this).select2({
                data: items1
            });
        });

        $(document).ready(function() {
            $('.js-example-basic-multiple' + previous_employeers_head).on('select2:open', function() {
                // Reference the currently opened Select2 dropdown
                var select2Container = $(this).data('select2').$dropdown;
                var resultsContainer = select2Container.find('.select2-results');

                // Adding additional search box
                var searchBoxHtml = `
            <div class="extra-search-container">
                <input type="text" class="extra-search-box" placeholder="Search...">
                <button class="clear-button" type="button">&times;</button>
            </div>`;

                var buttonsHtml = `
            <div class="extra-buttons">
                <button class="select-all-button" type="button">Select All</button>
                <button class="remove-all-button" type="button">Remove All</button>
            </div>`;

                // Remove any existing elements to avoid duplication
                resultsContainer.find('.extra-search-container').remove();
                resultsContainer.find('.extra-buttons').remove();

                // Prepend search box and buttons
                resultsContainer.prepend(buttonsHtml + searchBoxHtml);

                var $searchBox = resultsContainer.find('.extra-search-box');
                var $clearButton = resultsContainer.find('.clear-button');

                // Handle input event for search box
                $searchBox.on('input', function() {
                    var searchTerm = $(this).val().toLowerCase();
                    resultsContainer.find('.select2-results__option').each(function() {
                        var text = $(this).text().toLowerCase();
                        if (text.includes(searchTerm)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                    $clearButton.toggle($searchBox.val().length > 0);
                });

                // Clear button functionality
                $clearButton.on('click', function() {
                    $searchBox.val('');
                    $searchBox.trigger('input');
                });

                var $dropdown = $(this); // Reference the current dropdown

                // Handle Select All button
                resultsContainer.find('.select-all-button').on('click', function() {
                    var allValues = $dropdown.find('option').map(function() {
                        return $(this).val();
                    }).get();
                    $dropdown.val(allValues).trigger('change');
                });

                // Handle Remove All button
                resultsContainer.find('.remove-all-button').on('click', function() {
                    $dropdown.val(null).trigger('change');
                });
            });
        });


        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="type-of-nurse-experience-' + previous_employeers_head + '"]').on('change', function() {
            // Your code here

            let selectedValues = $(this).val();

            var nurse_len = $("#type-of-nurse-experience-" + previous_employeers_head + " li").length;

            //console.log("nurse_len", nurse_len);

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            for (var i = 1; i <= nurse_len; i++) {
                var nurse_result_val = $(".nursing_result_experience-" + previous_employeers_head + "-" + i).val();

                if (selectedValues.includes(nurse_result_val)) {
                    $('#nursing_level_experience1-' + previous_employeers_head + '-' + i).removeClass('d-none');
                } else {
                    $('#nursing_level_experience1-' + previous_employeers_head + '-' + i).addClass('d-none');
                    $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="nursing_entry_experience-' + previous_employeers_head + " - " + i + '"]').select2().val(null).trigger('change');
                }
            }

            if (selectedValues.includes("3") == false) {
                $('.np_submenu_experience_' + previous_employeers_head).addClass('d-none');
                //$('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2().val(null).trigger('change');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="nurse_practitioner_menu_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }
        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="nursing_entry_experience-' + previous_employeers_head + '-3"]').on('change', function() {
            let selectedValues = $(this).val();
            var nurse_len = $("#type-of-nurse-experience-" + previous_employeers_head + " li").length;
            //console.log("nurse_len", nurse_len);

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
            if (selectedValues.includes("179")) {
                $('.np_submenu_experience_' + previous_employeers_head).removeClass('d-none');
                //console.log("selectedValues", selectedValues);
            } else {
                $('.np_submenu_experience_' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="nurse_practitioner_menu_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }
        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="specialties_experience-' + previous_employeers_head + '"]').on('change', function() {

            let selectedValues = $(this).val();
            var speciality_len = $("#specialties_experience-" + previous_employeers_head + " li").length;

            //console.log("speciality_len", speciality_len);

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            for (var k = 1; k <= speciality_len; k++) {
                var speciality_result_val = $(".speciality_result_experience-" + previous_employeers_head + '-' + k).val();
                //alert(speciality_result_val);
                if (selectedValues.includes(speciality_result_val)) {
                    $('#specility_level_experience-' + previous_employeers_head + '-' + k).removeClass('d-none');
                    //$(".sub_speciality_value").val(k);

                } else {
                    $('#specility_level_experience-' + previous_employeers_head + '-' + k).addClass('d-none');
                    $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="speciality_entry_experience-' + previous_employeers_head + '-' + k + '"]').select2().val(null).trigger('change');

                    if (selectedValues.includes("1") == false) {
                        $('.surgical_row_experience-' + previous_employeers_head + k).addClass('d-none');
                        $('.surgical_row_data_experience-' + previous_employeers_head).addClass('d-none');
                        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_row_box_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
                    }
                }

            }

            if (selectedValues.includes("2") == false) {
                $('.surgicalobs_row_experience' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgicalobs_row_data_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("3") == false) {
                $('.surgicalpad_row_data_experience' + previous_employeers_head).addClass('d-none');
                $('.surgical_rowp_data_experience' + previous_employeers_head).addClass('d-none');
                $('.neonatal_row_experience' + previous_employeers_head).addClass('d-none');
                //$('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
            }


        });


        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="speciality_entry_experience-' + previous_employeers_head + '-1"]').on('change', function() {
            let selectedValues = $(this).val();
            var speciality_entry = $("#speciality_entry_experience-" + previous_employeers_head + "-1 li").length;
            //console.log("speciality_entry", speciality_entry);
            // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
            $(".surgical_row_data_experience-" + previous_employeers_head + "").insertAfter("#specility_level_experience-" + previous_employeers_head + "-1");
            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //console.log("selectedValues", selectedValues.includes("96"));
            //$('.result--show .form-group').addClass('d-none');

            if (selectedValues.includes("96")) {
                $('.surgical_row_data_experience-' + previous_employeers_head).removeClass('d-none');

            } else {
                $('.surgical_row_data_experience-' + previous_employeers_head).addClass('d-none ');
                $('.surgical_row_data_experience-' + previous_employeers_head).addClass('d-none ');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_row_box_experience' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("96") == false) {
                // $('.surgical_row_experience' + previous_employeers_head).addClass('d-none ');
                $('.surgical_sub' + previous_employeers_head).addClass('d-none ');
                $('.js-example-basic-multiple1[data-list-id="surgical_row_box_experience' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }
            // for(var k = 1;k<=speciality_entry;k++){
            //     var speciality_result_val = $(".speciality_result-"+k).val();
            //     //alert(speciality_result_val);
            //     if(selectedValues.includes(speciality_result_val)){

            //         $('#specility_level-'+k).removeClass('d-none');

            //     }else{
            //         $('#specility_level-'+k).addClass('d-none');
            //     }
            // }
        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_row_box_experience-' + previous_employeers_head + '"]').on('change', function() {
            let selectedValues = $(this).val();
            var speciality_entry = $("#surgical_row_box_experience-" + previous_employeers_head + " li").length;

            //console.log("surgical_row_data_experience-", previous_employeers_head);
            // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
            $(".specialty_sub_boxes_experience-" + previous_employeers_head).insertAfter(".surgical_row_data_experience-" + previous_employeers_head);
            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            // if(selectedValues.includes("97")){
            //     $('.surgical_row').removeClass('d-none');
            // }else{
            //     $('.surgical_row').addClass('d-none');
            // }

            for (var k = 1; k <= speciality_entry; k++) {
                var speciality_result_val = $(".speciality_surgical_result_experience-" + previous_employeers_head + '-' + k).val();

                if (selectedValues.includes(speciality_result_val)) {
                    $('.surgical_row_experience-' + previous_employeers_head + '-' + k).removeClass('d-none');
                } else {
                    $('.surgical_row_experience-' + previous_employeers_head + '-' + k).addClass('d-none');
                    $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_operative_care_experience-' + previous_employeers_head + '-' + k + '"]').select2().val(null).trigger('change');
                }
            }
        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="speciality_entry_experience-' + previous_employeers_head + '-2"]').on('change', function() {
            let selectedValues = $(this).val();

            var speciality_entry = $("#speciality_entry_experience-" + previous_employeers_head + "-2 li").length;

            //console.log("speciality_entry", speciality_entry);
            // $(".surgicalobs_row").wrapAll("<div class='col-md-12 row surgicalobs_row_data'>");
            $(".surgicalobs_row_experience-" + previous_employeers_head).insertAfter("#specility_level_experience-" + previous_employeers_head + "-2");

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            if (selectedValues.includes("233")) {
                $('.surgicalobs_row_experience-' + previous_employeers_head).removeClass('d-none');
            } else {
                $('.surgicalobs_row_experience-' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgicalobs_row_data_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }
        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="speciality_entry_experience-' + previous_employeers_head + '-3"]').on('change', function() {
            let selectedValues = $(this).val();

            var speciality_entry = $("#speciality_entry_experience-" + previous_employeers_head + "-2 li").length;
            //console.log("speciality_entry", speciality_entry);
            $(".surgical_rowp_experience-" + previous_employeers_head).wrapAll("<div class='col-md-12 row surgical_rowp_data_experience-" + previous_employeers_head + "'>");
            $(".paediatric_surgical_div_experience-" + previous_employeers_head).insertAfter("#specility_level_experience-" + previous_employeers_head + "-3");


            //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
            $(".neonatal_row_experience-" + previous_employeers_head).insertAfter("#specility_level_experience-" + previous_employeers_head + "-3");

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));


            //$('.result--show .form-group').addClass('d-none');

            if (selectedValues.includes('250')) {
                $('.neonatal_row_experience-' + previous_employeers_head).removeClass('d-none');
            } else {
                $('.neonatal_row_experience-' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="neonatal_care_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes('285')) {
                $('.surgicalpad_row_data_experience-' + previous_employeers_head).removeClass('d-none');
            } else {
                $('.surgicalpad_row_data_experience-' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_rowpad_box_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("285") == false) {
                $('.surgical_rowp_data_experience-' + previous_employeers_head).addClass('d-none');
                $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_row_box_experience-' + previous_employeers_head + '"]').select2().val(null).trigger('change');
            }

        });

        $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_rowpad_box_experience-' + previous_employeers_head + '"]').on('change', function() {
            let selectedValues = $(this).val();

            var speciality_entry = $("#surgical_rowpad_box_experience-" + previous_employeers_head + " li").length;
            //console.log("speciality_entry", speciality_entry);
            // $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
            $(".surgical_rowp_data_experience-" + previous_employeers_head).insertAfter(".surgicalpad_row_data_experience-" + previous_employeers_head);


            //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
            //     $(".neonatal_row_data").insertAfter("#specility_level-3");

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            //$('.result--show .form-group').addClass('d-none');



            for (var k = 1; k <= speciality_entry; k++) {
                var speciality_result_val = $(".surgical_rowp_result_experience-" + previous_employeers_head + '-' + k).val();
                //alert(speciality_result_val);
                if (selectedValues.includes(speciality_result_val)) {
                    $('.surgical_rowp_experience-' + previous_employeers_head + '-' + k).removeClass('d-none');
                } else {
                    $('.surgical_rowp_experience-' + previous_employeers_head + '-' + k).addClass('d-none');
                    $('.js-example-basic-multiple' + previous_employeers_head + '[data-list-id="surgical_operative_carep_experience-' + previous_employeers_head + '-' + k + '"]').select2().val(null).trigger('change');
                }
            }
        });

        // Event listener for change event on the main dropdown
        $('.js-example-basic-multiple' + previous_employeers_head + `[data-list-id="skills_compantancies-${previous_employeers_head}"]`).on('change', function() {
            // Get selected values from the main dropdown
            let selectedValues = $(this).val();

            // Track existing dropdowns
            let existingDropdowns = [];
            $(`.skills_compantancies_dropdowns-${previous_employeers_head} .js-example-basic-multiple${previous_employeers_head}`).each(function() {
                existingDropdowns.push($(this).data('list-id'));
            });

            // Loop through selected values to add new dropdowns
            selectedValues.forEach(function(value) {
                let dropdownId = `skills_compantancies-${previous_employeers_head}-${value}`;
                if (!existingDropdowns.includes(dropdownId)) {
                    // Fetch submenu data for new IDs
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/admin') }}/getSkillsData",
                        data: {
                            id: value,
                            _token: "{{ csrf_token() }}"
                        },
                        cache: false,
                        success: function(data) {
                            let skills = JSON.parse(data);
                            if (!skills || skills.length === 0) return; // Handle empty data

                            let skills_data = skills.map(skill => `<li data-value="${skill.id}">${skill.name}</li>`).join('');

                            // Create new dropdown HTML
                            let dropdownHtml = `
                        <div class="form-group level-drp">
                            <label class="form-label">${skills[0].parent_name}</label>
                            <ul id="${dropdownId}" style="display:none;">
                                ${skills_data}
                            </ul>
                            <select class="js-example-basic-multiple${previous_employeers_head} addAll_removeAll_btn"
                                    data-list-id="${dropdownId}"
                                    name="sub_skills_compantancies-${skills[0].parent_id}[${previous_employeers_head}][]"
                                    multiple="multiple">
                            </select>
                        </div>
                    `;

                            // Append the new dropdown
                            $(`.skills_compantancies_dropdowns-${previous_employeers_head}`).append(dropdownHtml);

                            // Initialize Select2 for the new dropdown
                            let $newDropdown = $(`[data-list-id="${dropdownId}"]`);
                            let items = skills.map(skill => ({
                                id: skill.id,
                                text: skill.name
                            }));

                            $newDropdown.select2({
                                data: items
                            });
                            initializeSelect22($newDropdown); // Add select all/remove all functionality
                        }
                    });
                }
            });

            // Remove dropdowns for deselected IDs
            $(`.skills_compantancies_dropdowns-${previous_employeers_head} .js-example-basic-multiple${previous_employeers_head}`).each(function() {
                let listId = $(this).data('list-id');
                let id = listId.split('-').pop(); // Extract the ID
                if (!selectedValues.includes(id)) {
                    $(this).closest('.form-group').remove(); // Remove dropdown if not selected
                }
            });
        });

        // Function to initialize Select2 with custom buttons
        function initializeSelect22($dropdown) {
            $dropdown.on('select2:open', function() {
                if (!$('.select2-container .extra-buttons').length) {
                    let searchBoxHtml = `
            <div class="extra-buttons">
                <button class="select-all-button" type="button">Select All</button>
                <button class="remove-all-button" type="button">Remove All</button>
            </div>
            `;

                    $('.select2-results').prepend(searchBoxHtml);

                    // Attach event listeners to the buttons
                    $('.select-all-button').on('click', function() {
                        let allValues = $dropdown.find('option').map(function() {
                            return $(this).val();
                        }).get();
                        $dropdown.val(allValues).trigger('change');
                    });

                    $('.remove-all-button').on('click', function() {
                        $dropdown.val(null).trigger('change');
                    });
                }
            });
        }

        $(document).on('click', '.delete-work-experience_' + previous_employeers_head, function() {
            delete_Exp(previous_employeers_head);
        });

        // Function to delete the work experience section
        function delete_Exp(previous_employeers_head) {
            $(".work_exp_" + previous_employeers_head).remove();
        }

        previous_employeers_head++;

    }

    function currently_position(i) {
        if ($(".currently_position-" + i).prop('checked') == true) {
            $(".empl_end_date-" + i).hide();
        } else {
            $(".empl_end_date-" + i).show();
            $(".employeement_end_date-" + i).val("");
        }
    }

    function currently_position_1(i) {
        if ($(".currently_position-" + i).prop('checked') == true) {
            $(".empl_end_date-" + i).addClass('d-none');
        } else {
            $(".empl_end_date-" + i).removeClass('d-none');
            $(".employeement_end_date-" + i).val("");
        }
    }

    $(document).ready(function() {
        $('.js-example-basic-multiple[data-list-id="type-of-nurse-experience"]').on('change', function() {
            let selectedValues = $(this).val();
            var nurse_len = $("#type-of-nurse-experience li").length;
            for (var i = 1; i <= nurse_len; i++) {
                var nurse_result_val = $(".nursing_result_experience-" + i).val();
                //alert(nurse_result_val);
                if (selectedValues.includes(nurse_result_val)) {
                    $('#nursing_level_experience-' + i).removeClass('d-none');
                } else {
                    $('#nursing_level_experience-' + i).addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="nursing_entry_experience-' + i + '"]').select2().val(null).trigger('change');
                }
            }

            if (selectedValues.includes("3") == false) {
                $('.np_submenu_experience').addClass('d-none');
                //$('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2().val(null).trigger('change');
                $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu_experience"]').select2().val(null).trigger('change');
            }


            // if (selectedValues.includes("Entry level nursing")) {
            //     $('#elnj').removeClass('d-none');
            // }
            // if (selectedValues.includes("Registered Nurses (RNs)")) {
            //     $('#rns').removeClass('d-none');
            // }
            // if (selectedValues.includes("Advanced Practice Registered Nurses (APRNs)")) {
            //     $('#aprns').removeClass('d-none');
            // }
        });

        $('.js-example-basic-multiple[data-list-id="nursing_entry_experience-3"]').on('change', function() {
            let selectedValues = $(this).val();
            //alert("hello");
            var nurse_len = $("#type-of-nurse li").length;
            ////console.log("nurse_len", nurse_len);

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
            if (selectedValues.includes("179")) {
                $('.np_submenu_experience').removeClass('d-none');
                ////console.log("selectedValues", selectedValues);
            } else {
                $('.np_submenu_experience').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu_experience"]').select2().val(null).trigger('change');
            }
        });

        $('.js-example-basic-multiple[data-list-id="specialties_experience"]').on('change', function() {
            let selectedValues = $(this).val();
            var speciality_len = $("#specialties_experience li").length;
            ////console.log("speciality_len", speciality_len);

            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
            ////console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            for (var k = 1; k <= speciality_len; k++) {
                var speciality_result_val = $(".speciality_result_experience-" + k).val();
                //alert(speciality_result_val);
                if (selectedValues.includes(speciality_result_val)) {

                    $('#specility_level_experience-' + k).removeClass('d-none');
                    //$(".sub_speciality_value").val(k);
                    ////console.log('1');
                } else {
                    ////console.log('2');
                    $('#specility_level_experience-' + k).addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-' + k + '"]').select2().val(null).trigger('change');
                }
            }

            if (selectedValues.includes("1") == false) {

                $('.surgical_row_experience').addClass('d-none');
                $('.surgical_row_data_experience').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgical_row_box_experience"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("2") == false) {

                $('.surgicalobs_row_experience').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgicalobs_row_data_experience"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("3") == false) {
                ////console.log('5');
                $('.surgicalpad_row_data_experience').addClass('d-none');
                $('.surgical_rowp_data_experience').addClass('d-none');
                $('.neonatal_row_experience').addClass('d-none');
                //$('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
            }


        });

        $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-1"]').on('change', function() {
            let selectedValues = $(this).val();
            //alert("hello");
            var speciality_entry = $("#speciality_entry_experience-1 li").length;
            ////console.log("speciality_entry", speciality_entry);
            // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
            $(".surgical_row_data_experience").insertAfter("#specility_level_experience-1");
            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
            ////console.log("selectedValues", selectedValues.includes("96"));
            //$('.result--show .form-group').addClass('d-none');
            if (selectedValues.includes("96")) {
                $('.surgical_row_data_experience').removeClass('d-none');
            } else {
                $('.surgical_row_data_experience').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgical_row_box_experience"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("96") == false) {
                $('.surgical_row_experience').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgical_row_box_experience"]').select2().val(null).trigger('change');
            }


            // for(var k = 1;k<=speciality_entry;k++){
            //     var speciality_result_val = $(".speciality_result-"+k).val();
            //     //alert(speciality_result_val);
            //     if(selectedValues.includes(speciality_result_val)){

            //         $('#specility_level-'+k).removeClass('d-none');

            //     }else{
            //         $('#specility_level-'+k).addClass('d-none');
            //     }
            // }
        });

        $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-2"]').on('change', function() {
            let selectedValues = $(this).val();
            var speciality_entry = $("#speciality_entry-1 li").length;
            $(".surgicalobs_row_experience").insertAfter("#specility_level_experience-2");
            if (selectedValues.includes("233")) {
                $('.surgicalobs_row_experience').removeClass('d-none');
            } else {
                $('.surgicalobs_row_experience').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgicalobs_row_data_experience"]').select2().val(null).trigger('change');
            }
        });

        $('.js-example-basic-multiple[data-list-id="surgical_row_box_experience"]').on('change', function() {

            let selectedValues = $(this).val();
            //alert("hello");
            var speciality_entry = $("#surgical_row_box_experience li").length;
            ////console.log("speciality_entry", speciality_entry);
            // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
            $(".specialty_sub_boxes_experience").insertAfter(".surgical_row_data_experience");
            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            ////console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            // if(selectedValues.includes("97")){
            //     $('.surgical_row').removeClass('d-none');
            // }else{
            //     $('.surgical_row').addClass('d-none');
            // }

            for (var k = 1; k <= speciality_entry; k++) {
                var speciality_result_val = $(".speciality_surgical_result_experience-" + k).val();
                ////console.log("speciality_result_val", speciality_result_val);
                if (selectedValues.includes(speciality_result_val)) {
                    $('.surgical_row_experience-' + k).removeClass('d-none');
                } else {
                    $('.surgical_row_experience-' + k).addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="surgical_operative_care_experience-' + k + '"]').select2().val(null).trigger('change');
                }
            }
        });

        $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-3"]').on('change', function() {
            let selectedValues = $(this).val();
            //alert("hello");
            var speciality_entry = $("#speciality_entry_experience-3 li").length;
            $(".surgical_rowp_experience").wrapAll("<div class='col-md-12 row surgical_rowp_data_experience'>");
            $(".paediatric_surgical_div_experience").insertAfter("#specility_level_experience-3");

            //$(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
            $(".neonatal_row_experience").insertAfter("#specility_level_experience-3");
            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

            ////console.log("selectedValues", selectedValues);
            //$('.result--show .form-group').addClass('d-none');

            if (selectedValues.includes('250')) {
                $('.neonatal_row_experience').removeClass('d-none');
            } else {
                $('.neonatal_row_experience').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="neonatal_care_experience"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes('285')) {
                $('.surgicalpad_row_data_experience').removeClass('d-none');
            } else {
                $('.surgicalpad_row_data_experience').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box_experience"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("285") == false) {
                $('.surgical_rowp_data_experience').addClass('d-none');
                // $('.js-example-basic-multiple[data-list-id="surgical_row_box_experience"]').select2().val(null).trigger('change');
            }

        });

        $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box_experience"]').on('change', function() {
            let selectedValues = $(this).val();
            //alert("hello");
            var speciality_entry = $("#surgical_rowpad_box_experience li").length;
            ////console.log("speciality_entry", speciality_entry);
            // $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
            $(".surgical_rowp_data_experience").insertAfter(".surgicalpad_row_data_experience");
            for (var k = 1; k <= speciality_entry; k++) {
                var speciality_result_val = $(".surgical_rowp_result_experience-" + k).val();
                //alert(speciality_result_val);
                if (selectedValues.includes(speciality_result_val)) {
                    $('.surgical_rowp_experience-' + k).removeClass('d-none');
                } else {
                    $('.surgical_rowp_experience-' + k).addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="surgical_operative_carep_experience-' + k + '"]').select2().val(null).trigger('change');
                }
            }
        });

        $('.js-example-basic-multiple[data-list-id="skills_compantancies"]').on('change', function() {
            // Get selected values from the main category dropdown
            let selectedValues = $(this).val();

            // Keep track of existing dropdowns
            let existingDropdowns = [];
            $('.skills_compantancies_dropdowns .js-example-basic-multiple1').each(function() {
                existingDropdowns.push($(this).data('list-id'));
            });

            var skillcount = 1;

            // Loop through selected values
            selectedValues.forEach(function(value) {
                // Check if the dropdown for this ID already exists
                if (!existingDropdowns.includes(`skills_compantancies-${value}`)) {
                    // Fetch submenu data for new IDs
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/admin') }}/getSkillsData",
                        data: {
                            id: value,
                            _token: "{{ csrf_token() }}"
                        },
                        cache: false,
                        success: function(data) {
                            var skills = JSON.parse(data);
                            var skills_data = '';
                            skills.forEach(function(skill) {
                                skills_data += '<li data-value="' + skill.id + '">' + skill.name + '</li>';
                            });

                            // Create submenu HTML
                            var dropdownHtml = `
                                <div class="form-group level-drp">
                                <label class="form-label" for="input-1">${skills[0].parent_name}</label>
                                <ul id="skills_compantancies-${skills[0].parent_id}" style="display:none;">
                                    ${skills_data}
                                </ul>
                                <select class="js-example-basic-multiple1 addAll_removeAll_btn" 
                                        data-list-id="skills_compantancies-${skills[0].parent_id}" 
                                        name="sub_skills_compantancies-${skills[0].parent_id}[1][]" multiple="multiple">
                                </select>
                                </div>
                            `;

                            // Append the new dropdown
                            $(".skills_compantancies_dropdowns").append(dropdownHtml);

                            // Populate the new dropdown with options
                            let listId = `skills_compantancies-${skills[0].parent_id}`;
                            let items = [];

                            $('#' + listId + ' li').each(function() {
                                items.push({
                                    id: $(this).data('value'),
                                    text: $(this).text()
                                });
                            });

                            let $newDropdown = $(`[data-list-id="${listId}"]`);
                            $newDropdown.select2({
                                data: items
                            });

                            // Add select all/remove all functionality
                            initializeSelect2($newDropdown);
                        }
                    });
                    count++;
                }
            });

            // Remove dropdowns for deselected IDs
            if (selectedValues && selectedValues.length > 0) {
                $('.skills_compantancies_dropdowns .js-example-basic-multiple1').each(function() {
                    let listId = $(this).data('list-id');
                    let id = listId.replace('skills_compantancies-', '');
                    if (!selectedValues.includes(id)) {
                        $(this).closest('.form-group').remove();
                    }
                });
            }
        });

        // Function to initialize Select2 for dynamically created select elements
        function initializeSelect2($dropdown) {
            $dropdown.on('select2:open', function() {
                var $currentDropdown = $(this);

                // Check if buttons already exist for this dropdown
                if ($('.extra-buttons').length === 0) {
                    // Create the buttons HTML
                    var searchBoxHtml = `
                <div class="extra-buttons">
                    <button class="select-all-button" type="button">Select All</button>
                    <button class="remove-all-button" type="button">Remove All</button>
                </div>
            `;

                    // Add select all/remove all buttons
                    $('.select2-results').prepend(searchBoxHtml);

                    // Attach event listeners to the buttons
                    $('.select-all-button').off('click').on('click', function() {
                        var allValues = $currentDropdown.find('option').map(function() {
                            return $(this).val();
                        }).get();
                        $currentDropdown.val(allValues).trigger('change');
                    });

                    $('.remove-all-button').off('click').on('click', function() {
                        $currentDropdown.val(null).trigger('change');
                    });
                }
            });
        }
    });
</script>

<script>
    const selectedFilesMap = {}; // This will hold selected files for each input by ID
    let count = 1;
    // Using event delegation to handle 'change' event for multiple inputs
    $(document).on('change', '.change_evi', function(event) {
        const id = this.id; // Get the ID of the input element

        if (!selectedFilesMap[id]) {
            selectedFilesMap[id] = new DataTransfer();
        }

        // Add selected files to the DataTransfer for this input
        Array.from(event.target.files).forEach((file) => {
            selectedFilesMap[id].items.add(file);
            const fileUrl = URL.createObjectURL(file);
            const fileName = file.name;

            // Create preview HTML
            const previewHtml = `
                <div class="trans_img trans_img-${count}" data-file="${fileName}">
                    <a href="${fileUrl}" target="_blank">
                        <i class="fa fa-file"></i> ${fileName}
                    </a>
                    <div class="close_btn" style="cursor: pointer;">
                        <i class="fa fa-close" onclick="deleteevImg(${count}, '${fileName}',${id})"></i>
                    </div>
                </div>
            `;

            $('.fileList_' + id).append(previewHtml);
            count++;
        });

        // Update the file input with the modified FileList for this specific input
        $('#' + id)[0].files = selectedFilesMap[id].files;
        // console.log(selectedFilesMap);
    });


    window.deleteevImg = function(sectionId, fileName, id) {
        // Remove the preview element of the selected file
        $(`.trans_img-${sectionId}`).remove();
        // Get the file input element and update the count
        const inputElement = $('.change_evi');
        const newFileCount = inputElement[0].files.length - 1; // Decrease the count
        $('#' + id)[0].files = new FileListItems([...inputElement[0].files].slice(0, newFileCount));
        console.log(`File ${fileName} deleted from section ${sectionId}`);
    };

    function FileListItems(files) {
        const dataTransfer = new DataTransfer();
        files.forEach(file => dataTransfer.items.add(file));
        return dataTransfer.files;
    }

    // Function to delete the work experience section
    function deletevdiImg(i, user_id, img, imgid) {
        $.ajax({
            type: "post",
            url: "{{route('nurse.deleteEvidence')}}",
            data: {
                user_id: user_id,
                img: img,
                imgid: imgid,
                _token: '{{ csrf_token() }}'
            },
            cache: false,
            success: function(data) {
                if (data == 1) {
                    $(".trans_img-" + i).remove();
                }
            }
        });

    }

    $(document).ready(function() {
        $('#experience_form').on('submit', function(event) {
            
            event.preventDefault();
            var isValid = true;
            var targetTab = '#navpill-6';
            var exp_id = $('#expid').val();

            
            var a = 1;
            $(".nurse_type_exp").each(function() {
                if ($(".nurse_type_exp_" + a).length > 0) {
                    if ($(".nurse_type_exp_" + a).val() == '') {
                        document.getElementById("reqnurseTypeexpId-" + a).innerHTML = "* Please select the type of nurse";
                        isValid = false;
                    }
                }
                a++;
            });

            
            var b = 1;
            $(".spec_exp").each(function() {
                if ($(".spec_exp_" + b).length > 0) {
                    if ($(".spec_exp_" + b).val() == '') {
                        document.getElementById("reqspecialtiesexp-" + b).innerHTML = "* Please select the specialties";
                        isValid = false;
                    }
                }
                b++;
            });
            

            var c = 1;
            $(".pos_held").each(function() {
                if ($(".pos_held_" + c).length > 0) {
                    if ($(".pos_held_" + c).val() == '') {
                        document.getElementById("reqpositionheld-" + c).innerHTML = "* Please select the position held";
                        isValid = false;
                    }
                }
                c++;
            });
            
            var d = 1;
            $(".employeement_start_date_exp").each(function() {
                if ($(".employeement_start_date_exp-" + d).length > 0) {
                    if ($(".employeement_start_date_exp-" + d).val() == '') {
                        document.getElementById("reqempsdateexp-" + d).innerHTML = "* Please enter the employment start date";
                        isValid = false;
                    }
                }
                d++;
            });

            var e = 1;
            $(".employeement_end_date_exp").each(function() {
                if ($(".empl_end_date-"+e).is(':visible') == true) {
                    if ($(".employeement_end_date_exp-" + e).val() == '') {
                        document.getElementById("reqemployeementenddateexp-" + e).innerHTML = "* Please enter the employment end date";
                        isValid = false;
                    }
                }
                e++;
            });

            
            
            var f = 1;
            $(".res-exp").each(function() {
                if ($(".res-exp-" + f).length > 0) {
                    if ($(".res-exp-" + f).val() == '') {
                        document.getElementById("reqresposiblitiesexp-" + f).innerHTML = "* Please enter the responsibilities";
                        isValid = false;
                    }
                }
                f++;
            });

            var g = 1;
            $(".ach_exp").each(function() {
                if ($(".ach_exp-" + g).length > 0) {
                    if ($(".ach_exp-" + g).val() == '') {
                        document.getElementById("reqachievementsexp-" + g).innerHTML = "* Please enter the achievements";
                        isValid = false;
                    }
                }
                g++;
            });


            var h = 1;
            $(".spe_skill").each(function() {
                if ($(".spe_skill_" + h).length > 0) {
                    if ($(".spe_skill_" + h).val() == '') {
                        document.getElementById("reqexpertiseexp-" + h).innerHTML = "* Please select the specific skills and competencies";
                        isValid = false;
                    }
                }
                h++;
            });

            var i = 1;
            $(".spe_skill").each(function() {
                if ($(".spe_skill_" + i).length > 0) {
                    if ($(".spe_skill_" + i).val() == '') {
                        document.getElementById("reqexpertiseexp-" + i).innerHTML = "* Please select the specific skills and competencies";
                        isValid = false;
                    }
                }
                i++;
            });


            var j = 1;
            $(".type_of_evi").each(function() {
                if ($(".type_of_evi_" + j).length > 0) {
                    if ($(".type_of_evi_" + j).val() == '') {
                        document.getElementById("reqtype_evidenceexp-" + j).innerHTML = "* Please select the type of evidence";
                        isValid = false;
                    }
                }
                j++;
            });


            var k = 1;
            $(".emp_exp_type").each(function() {
                if ($(".emp_exp_type-" + k).length > 0) {
                    if ($(".emp_exp_type-" + k).val() == '') {
                        document.getElementById("reqemptype-" + k).innerHTML = "* Please select the employment type";
                        isValid = false;
                    }
                }
                k++;
            });
            
            if (isValid == true) {
                
                var formData = new FormData($('#experience_form')[0]); // Create FormData object from the form
                $.ajax({
                    url: "{{ route('admin.exp-data') }}",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                    },
                    success: function(res) {

                        if (res.status == '2') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                            }).then(function() {
                                if (exp_id != "") {
                                    window.location.reload();
                                } else {
                                    window.location.href = "{{ route('admin.add_nurse', ['tab' => 'navpill-5.1']) }}";
                                }


                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                        // Show the target tab
                    },
                    error: function(error) {
                        // if(targetTab ==  '#navpill-2'){
                        if (error.responseJSON.errors) {
                            if (error.responseJSON.errors.previous_employer_name) {
                                $('#previous_employer_name_error').text(error.responseJSON.errors.previous_employer_name[0]);
                            } else {
                                $('#previous_employer_name_error').text('');
                            }

                            if (error.responseJSON.errors.positions_held) {
                                $('#positions_held_error').text(error.responseJSON.errors.positions_held[0]);
                            } else {
                                $('#positions_held_error').text('');
                            }

                            if (error.responseJSON.errors.start_date) {
                                $('#start_date_error').text(error.responseJSON.errors.start_date[0]);
                            } else {
                                $('#start_date_error').text('');
                            }

                            if (error.responseJSON.errors.end_date) {
                                $('#end_date_error').text(error.responseJSON.errors.end_date[0]);
                            } else {
                                $('#end_date_error').text('');
                            }

                            if (error.responseJSON.errors.job_responeblities) {
                                $('#job_responeblities_error').text(error.responseJSON.errors.job_responeblities[0]);
                            } else {
                                $('#job_responeblities_error').text('');
                            }


                            if (error.responseJSON.errors.achievements) {
                                $('#achievements_error').text(error.responseJSON.errors.achievements[0]);
                            } else {
                                $('#achievements_error').text('');
                            }

                            if (error.responseJSON.errors.skills_compantancies) {
                                $('#skills_compantancies_error').text(error.responseJSON.errors.skills_compantancies[0]);
                            } else {
                                $('#skills_compantancies_error').text('');
                            }

                            if (error.responseJSON.errors.present_box) {
                                $('#present_box_error').text(error.responseJSON.errors.present_box[0]);
                            } else {
                                $('#present_box_error').text('');
                            }
                            // }                        
                        }
                    }
                });

            }

        })
    });

    function ExpEmpStatus1(value, id) {
        if (value == "Permanent") {
            $(".exp_permanent_" + id).show();
            $(".exp_temporary_" + id).hide();
        } else {
            if (value == "Temporary") {
                $(".exp_temporary_" + id).show();
                $(".exp_permanent_" + id).hide();
            }
        }
    }

    $(document).on('change', '[id=employment_type_' + previous_employeers_head + ']', function() {
        var value = $(this).val();
        ExpEmpStatus1(value, previous_employeers_head);
    });

    function ExpEmpStatus(value) {
        if (value == "Permanent") {
            $(".exp_permanent").show();
            $(".exp_temporary").hide();
        } else {
            if (value == "Temporary") {
                $(".exp_temporary").show();
                $(".exp_permanent").hide();
            }
        }
    }
</script>
<script>
    
    // exp tab changes
    $(document).ready(function() {
        var u = 1;
    $(".mainfactype").each(function(){

        if ($(".mainfactype-"+u).val() != "") {
        var mainfactype = JSON.parse($(".mainfactype-"+u).val());
        
        console.log("mainfactype",u);
        $('.js-example-basic-multiple[data-list-id="wp_data-'+u+'"]').select2().val(mainfactype).trigger('change');
        $(".subwork_list-"+u).each(function(){
        var subwork_list_val = $(this).val();
            if ($(".subworkjs-"+u+subwork_list_val).val() != "") {
            
            var subfactype = JSON.parse($(".subworkjs-"+u+subwork_list_val).val());
            
            console.log("subfactype",subfactype);
            $('.js-example-basic-multiple[data-list-id="subwork_field-'+u+subwork_list_val+'"]').select2().val(subfactype).trigger('change');
            $(".subpwork_list-"+u).each(function(){
                var subwork_list_val = $(this).val();
                if ($(".subworkjs1-"+u+subwork_list_val).val() != "") {
                
                var subfactype = JSON.parse($(".subworkjs1-"+u+subwork_list_val).val());
                
                console.log("subfactype1",subfactype);
                $('.js-example-basic-multiple[data-list-id="subpwork_field-'+u+subwork_list_val+'"]').select2().val(subfactype).trigger('change');
                
                }
                
            });
            }

            
            
        });
        }

        
        u++;
    });

    var i = 1;
  $(".perfieldexp").each(function(){

    if ($(".perfieldexp-"+i).val() != "") {
      var perhfield = $(".perfieldexp-"+i).val();
      
      console.log("perhfield",perhfield);
      $('.js-example-basic-multiple[data-list-id="permanent_status_experience-'+i+'"]').select2().val(perhfield).trigger('change');
      
    }
    i++;
  });

  var j = 1;

  $(".temphfieldexp").each(function(){

    if ($(".temphfieldexp-"+j).val() != "") {
      var temphfieldexp = $(".temphfieldexp-"+j).val();
      
      console.log("temphfieldexp",temphfieldexp);
      $('.js-example-basic-multiple[data-list-id="temporary_status_experience-'+j+'"]').select2().val(temphfieldexp).trigger('change');
      
    }
    j++;
  });

     var k = 1;
  $(".pos_hide").each(function(){

    if ($(".pos_hide-"+k).val() != "") {
      var posfield = JSON.parse($(".pos_hide-"+k).val());
      
      console.log("posfield",posfield);
      $('.js-example-basic-multiple[data-list-id="position_held_field-'+k+'"]').select2().val(posfield).trigger('change');
      
      var l = 1;
      $(".subposdata-"+k).each(function(){
        var position_id = $(".subpos_list-"+k+l).val();
        console.log("position_id",k+position_id);
        if ($(".subposdata-"+k+l).val() != "") {
          var subposfield = JSON.parse($(".subposdata-"+k+l).val());
          
          console.log("subposfield",subposfield);
          
          $('.js-example-basic-multiple[data-list-id="subposition_held_field-'+k+position_id+'"]').select2().val(subposfield).trigger('change');
        }
        l++;
      });
    }
    k++;
  });

        var l = 1;
        $(".nurse_exp_type").each(function() {
            if ($(".nurse_exp_type-" + l).length > 0) {
                if ($(".type_nurse_ep-" + l).val() != "") {
                    // Initialize select2
                    var nurse_type1 = JSON.parse($(".type_nurse_ep-" + l).val());
                    $('#nurse_type_exp-' + l).select2().val(nurse_type1).trigger('change');
                }
            }
            l++;
        });

        var a = 1;
        var triggerCount = 0; // Initialize the counter
        $(".nurse-res-rex").each(function() {
            if ($(".nurse-res-rex-" + a).length > 0) {
                if ($(".nursing_result_one_experience_" + a).val() != "") {
                    // Initialize select2
                    var nurse_res1 = JSON.parse($(".nursing_result_one_experience_" + a).val());
                    $('.nur_exp_res_2_' + a).select2().val(nurse_res1).trigger('change');
                }
            }
            a++;
        });


        var b = 1;
        $(".nurse-res-rex").each(function() {
            if ($(".nurse-res-rex-" + b).length > 0) {
                if ($(".nursing_result_two_experience_" + b).val() != "") {
                    var nurse_res2 = JSON.parse($(".nursing_result_two_experience_" + b).val());
                    $('.nur_exp_res_1_' + b).select2().val(nurse_res2).trigger('change');
                }
            }
            b++;
        });

        var c = 1;
        $(".nurse-res-rex").each(function() {
            if ($(".nurse-res-rex-" + c).length > 0) {
                if ($(".nursing_result_three_experience_" + c).val() != "") {
                    var nurse_res3 = JSON.parse($(".nursing_result_three_experience_" + c).val());
                    $('.nur_exp_res_3_' + c).select2().val(nurse_res3).trigger('change');
                    if (Array.isArray(nurse_res3) && nurse_res3.includes("179")) {
                        if ($(".np_result_experience_" + c).val() != "") {
                            var nurse_res4 = JSON.parse($(".np_result_experience_" + c).val());
                            $('.nurse_prax_exp_' + c).select2().val(nurse_res4).trigger('change');
                        }
                        $('.np_submenu_experience').removeClass('d-none');
                    } else {
                        $('.np_submenu_experience').addClass('d-none');
                    }
                }
            }
            c++;
        });


        var d = 1;
        $(".condition_set").each(function() {
            if ($(".exp_tab-" + d).length > 0) {
                if ($(".speciality_exp_value-" + d).val() != "") {
                    var spec_type = JSON.parse($(".speciality_exp_value-" + d).val());
                    $('.exp_spe_type_' + d).select2().val(spec_type).trigger('change');
                }
            }
            d++;
        });


        var e = 1;
        $(".exp_tab").each(function() {
            if ($(".exp_tab-" + e).length > 0) {
                if ($(".adults_result_experience_" + e).val() != "") {
                    var adult_type = JSON.parse($(".adults_result_experience_" + e).val());
                    $('.specility_sub_type_1_' + e).select2().val(adult_type).trigger('change');
                }
            }
            e++;
        });

        var g = 1; // Initialize the counter
        $(".exp_tab").each(function() {
            if ($(".exp_tab-" + g).length > 0) {
                // Check if the value is not empty
                if ($(".maternity_result_experience_" + g).val() != "") {
                    $(".surgicalobs_row_exp_" + g).insertAfter("#specility_level_exp-2-" + g);
                    // (".surgicalobs_row_exp_" + g).insertAfter("#specility_level_exp-2");
                    var maternityt_type = JSON.parse($(".maternity_result_experience_" + g).val());
                    $('.specility_sub_type_2_' + g).select2().val(maternityt_type).trigger('change');
                    if (Array.isArray(maternityt_type) && maternityt_type.includes("233")) {
                        if ($(".surgical_ob_result_experience_" + g).val() != "") {
                            var surgical_ob = JSON.parse($(".surgical_ob_result_experience_" + g).val());
                            $('.surgicalobs_row_' + g).select2().val(surgical_ob).trigger('change');
                        }
                        $('.surgicalobs_row_exp_' + g).removeClass('d-none');
                    } else {
                        $('.surgicalobs_row_exp_' + g).addClass('d-none');
                    }
                }
            }
            g++; // Increment the counter after the logic block
        });

        var h = 1;
        $(".exp_tab").each(function() {
            if ($(".exp_tab-" + h).length > 0) {
                if ($(".community_result_experience_" + h).val() != "") {
                    var community_result = JSON.parse($(".community_result_experience_" + h).val());
                    $('.specility_sub_type_4_' + h).select2().val(community_result).trigger('change');
                }
            }
            h++;
        });

        var i = 1;
        $(".exp_tab").each(function() {
            if ($(".exp_tab-" + i).length > 0) {
                if ($(".paediatrics_neonatal_" + i).val() != "") {

                    var paedia_result = JSON.parse($(".paediatrics_neonatal_" + i).val());

                    $(".paediatric_surgical_div_expe_" + i).insertAfter("#specility_level_exp-3-" + i);
                    $(".neonatal_row_exp_" + i).insertAfter("#specility_level_exp-3-" + i);
                    $(".surgical_rowp_exp_" + i).insertAfter(".surgicalpad_row_data_exp_" + i);

                    $('.specility_sub_type_3_' + i).select2().val(paedia_result).trigger('change');
                    if (Array.isArray(paedia_result) && paedia_result.includes("250")) {
                        $('.neonatal_row_exp_' + i).removeClass('d-none');
                    } else {
                        $('.neonatal_row_exp_' + i).addClass('d-none');
                    }

                    if (Array.isArray(paedia_result) && paedia_result.includes("285")) {
                        $('.surgicalpad_row_data_exp_' + i).removeClass('d-none');
                    } else {
                        $('.surgicalpad_row_data_exp_' + i).addClass('d-none');
                    }
                }
            }
            i++;
        });

        var j = 1;
        $(".exp_tab").each(function() {
            if ($(".exp_tab-" + j).length > 0) {
                if ($(".neonatal_care_result_experience_" + j).val() != "") {
                    var neonatal_care_result = JSON.parse($(".neonatal_care_result_experience_" + j).val());
                    $('.neonatal_exp_' + j).select2().val(neonatal_care_result).trigger('change');
                }
            }
            j++;
        });

        var k = 1;
        $(".exp_tab").each(function() {
            if ($(".exp_tab-" + k).length > 0) {
                if ($(".paedia_surgical_" + k).val() != "") {
                    var paedia_result = JSON.parse($(".paedia_surgical_" + k).val());
                    $('.pae_sur_preop_' + k).select2().val(paedia_result).trigger('change');
                }
            }
            k++;
        });

        var l = 1; // Initialize the counter
        $(".exp_tab").each(function(index) {
            if ($(".exp_tab-" + l).length > 0) {
                var paediaResult = $(".paedia_surgical_" + l).val();
                if (paediaResult != "") {
                    var paedia_type = JSON.parse(paediaResult);

                    if (Array.isArray(paedia_type) && paedia_type.includes("286")) {
                        var paediasubvalue = $(".pad_op_room_result_experience_" + l).val();
                        if (paediasubvalue != "") {
                            var paediavalue1 = JSON.parse($(".pad_op_room_result_experience_" + l).val());
                            $('.surgi_286_' + l).select2().val(paediavalue1).trigger('change');
                        }
                    }

                    if (Array.isArray(paedia_type) && paedia_type.includes("287")) {
                        var scoutvalue1 = $(".pad_qr_scout_result_experience_" + l).val();
                        if (scoutvalue1 != "") {
                            var scoutvalue2 = JSON.parse($(".pad_qr_scout_result_experience_" + l).val());

                            $('.surgi_287_' + l).select2().val(scoutvalue2).trigger('change');
                        }
                    }
                    if (Array.isArray(paedia_type) && paedia_type.includes("288")) {
                        var scrubvalue = $(".pad_qr_scrub_result_experience_" + l).val();
                        if (scrubvalue != "") {
                            var scrubvalue3 = JSON.parse($(".pad_qr_scrub_result_experience_" + l).val());
                            $('.surgi_288_' + l).select2().val(scrubvalue3).trigger('change');
                        }
                    }
                } else {
                    // Optional: Handle case when the value is empty
                    // $('.surgical_row_data_experience_' + f).addClass('d-none');
                    // $('.js-example-basic-multiple[data-list-id="surgical_obs_care"]').select2().val(null).trigger('change');
                }
            }
            l++; // Increment the counter inside the loop
        });

        var e = 1; // Initialize the counter
        $(".exp_tab").each(function(index) {
            if ($(".exp_tab-" + e).length > 0) {
                if ($(".adults_result_experience_" + e).val() != "") {
                    $(".surgical_div_experience_" + e).insertAfter("#specility_level_exp-1-" + e);
                    $(".subvaluedata_" + e).insertAfter(".surgical_div_experience_" + e);
                    var adult_type = JSON.parse($(".adults_result_experience_" + e).val());
                    // if (adult_type) {
                    $('.specility_sub_type_1_' + e).select2().val(adult_type).trigger('change');

                    if (Array.isArray(adult_type) && adult_type.includes("96")) {
                        $('.surgical_row_data_experience_' + e).removeClass('d-none');
                        var sur_type = JSON.parse($(".surgical_preoperative_result_experience-" + e).val());
                        $('.sur_exp_' + e).select2().val(sur_type).trigger('change');
                    } else {
                        $('.surgical_row_data_experience_' + e).addClass('d-none');
                    }
                    // }
                } else {
                    $('.surgical_row_data_experience_' + e).addClass('d-none');
                    // Optional: Uncomment this line if you want to clear the select2 values
                    // $('.js-example-basic-multiple[data-list-id="surgical_obs_care"]').select2().val(null).trigger('change');
                }
            }
            e++; // Increment the counter inside the loop
        });

        var f = 1; // Initialize the counter
        $(".exp_tab").each(function(index) {
            if ($(".exp_tab-" + f).length > 0) {
                var surgicalResult = $(".surgical_preoperative_result_experience-" + f).val();
                if (surgicalResult != "") {
                    var sur_opr_type = JSON.parse(surgicalResult);

                    if (Array.isArray(sur_opr_type) && sur_opr_type.includes("97")) {
                        $('.sur_sub_type_97_' + f).removeClass('d-none');
                        var surgicalsubvalue = $(".operatingroom_result_experience-" + f).val();
                        if (surgicalsubvalue != "") {
                            var getvalue1 = JSON.parse($(".operatingroom_result_experience-" + f).val());

                            $('.spec_sub_value_97_' + f).select2().val(getvalue1).trigger('change');
                        }
                    }

                    if (Array.isArray(sur_opr_type) && sur_opr_type.includes("98")) {
                        $('.sur_sub_type_98_' + f).removeClass('d-none');
                        var surgicalsubvalue1 = $(".operatingscout_result_experience-" + f).val();
                        if (surgicalsubvalue1 != "") {
                            var getvalue2 = JSON.parse($(".operatingscout_result_experience-" + f).val());

                            $('.spec_sub_value_98_' + f).select2().val(getvalue2).trigger('change');
                        }
                    }
                    if (Array.isArray(sur_opr_type) && sur_opr_type.includes("99")) {
                        $('.sur_sub_type_99_' + f).removeClass('d-none');
                        var surgicalsubvalue2 = $(".operatingscrub_result_experience-" + f).val();
                        if (surgicalsubvalue2 != "") {
                            var getvalue3 = JSON.parse($(".operatingscrub_result_experience-" + f).val());
                            $('.spec_sub_value_99_' + f).select2().val(getvalue3).trigger('change');
                        }
                    }
                } else {
                    // Optional: Handle case when the value is empty
                    // $('.surgical_row_data_experience_' + f).addClass('d-none');
                    // $('.js-example-basic-multiple[data-list-id="surgical_obs_care"]').select2().val(null).trigger('change');
                }
            }
            f++; // Increment the counter inside the loop
        });

        var m = 1; // Initialize the counter
        $(".exp_tab").each(function(index) {
            if ($(".exp_tab-" + m).length > 0) {
                var skillResult = $("#spe_skill_" + m).val();
                if (skillResult != "") {

                    var getskillw = JSON.parse($("#spe_skill_" + m).val());
                    // alert(getskillw);
                    $('.skill_com_' + m).select2().val(getskillw).trigger('change');
                }
            }
            m++; // Increment the counter inside the loop
        });

        var n = 1;
        $(".exp_tab").each(function() {
            if ($(".exp_tab-" + n).length > 0) {
                if ($("#lead_and_ment_skill_" + n).val() != "") {
                    var lead_and_ment_skill = JSON.parse($("#lead_and_ment_skill_" + n).val());
                    $('.lead_and_ment_skill_' + n).select2().val(lead_and_ment_skill).trigger('change');
                }
            }
            n++;
        });

        var o = 1;
        $(".exp_tab").each(function() {
            if ($(".exp_tab-" + o).length > 0) {
                if ($("#inter_and_em_skill" + o).val() != "") {
                    var inter_and_em_skill_ = JSON.parse($("#inter_and_em_skill" + o).val());
                    $('.inter_and_em_skill_' + o).select2().val(inter_and_em_skill_).trigger('change');
                }
            }
            o++;
        });

        var p = 1;
        $(".exp_tab").each(function() {
            if ($(".exp_tab-" + p).length > 0) {
                if ($("#org_and_any_skill" + p).val() != "") {
                    var org_and_any_skill = JSON.parse($("#org_and_any_skill" + p).val());
                    $('.org_and_any_skill_' + p).select2().val(org_and_any_skill).trigger('change');
                }
            }
            p++;
        });

        var p = 1;
        $(".exp_tab").each(function() {
            if ($(".exp_tab-" + p).length > 0) {
                if ($("#tech_and_soft_pro_" + p).val() != "") {
                    var tech_and_soft_pro = JSON.parse($("#tech_and_soft_pro_" + p).val());
                    $('.tech_and_soft_pro' + p).select2().val(tech_and_soft_pro).trigger('change');
                }
            }
            p++;
        });

        var q = 1;
        $(".exp_tab").each(function() {
            if ($(".exp_tab-" + q).length > 0) {
                if ($("#evidence_type_" + q).val() != "") {
                    var evidence_type = JSON.parse($("#evidence_type_" + q).val());
                    $('.type_evi_' + q).select2().val(evidence_type).trigger('change');
                }
            }
            q++;
        });
    })

    function handleNurseTypeChange(index) {
        // Get the select element using the index
        let selectElement = document.getElementById(`nurse_type_exp-${index}`);
        // Get the associated `data-list-id` for the current dropdown
        let listId = selectElement.getAttribute('data-list-id');
        // Retrieve selected values from the dropdown
        let selectedValues = $(selectElement).val() || []; // Ensure selectedValues is an array
        // Get the length of nursing result items
        let nurseLen = $(`#${listId} li`).length;
        for (let i = 1; i <= nurseLen; i++) {
            let nurseResultVal = $(`.nursing_result_experience-${i}`).val();

            if (Array.isArray(selectedValues) && selectedValues.includes(nurseResultVal)) {
                // Show the corresponding section
                $(`#nursing_level_experience-${i}-${index}`).removeClass('d-none');
            } else {
                // Hide the section and clear associated select2 values
                $(`#nursing_level_experience-${i}-${index}`).addClass('d-none');
                $(`.js-example-basic-multiple[data-list-id="nursing_entry_experience-${i}"]`)
                    .select2()
                    .val(null)
                    .trigger('change');
            }
        }

        if (selectedValues.includes("3") == false) {
            $('.np_submenu_experience').addClass('d-none');
            //$('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2().val(null).trigger('change');
            // $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(null).trigger('change');
        }
    }

    $(document).on('change', '.specialties_experience', function() {
        let selectedValues = $(this).val();
        let index = $(this).attr('index_value');
        var speciality_len = $("#specialties_type_experience-1 li").length;

        for (var k = 1; k <= speciality_len; k++) {
            var speciality_result_val = $(".speciality_exp_result-" + k + '-' + index).val();
            if (selectedValues.includes(speciality_result_val)) {
                $('#specility_level_exp-' + k + '-' + index).removeClass('d-none');
            } else {
                $('#specility_level_exp-' + k + '-' + index).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="speciality_entry_exp-' + k + '-' + index + '"]').select2().val(null).trigger('change');
            }
        }

        if (!selectedValues.includes("1")) {
            $('.subvaluedata_' + index).addClass('d-none');
            $('.surgical_row_data_experience_' + index).addClass('d-none');
            $('.sur_exp_' + index).select2().val(null).trigger('change');
        }

        if (selectedValues.includes("2") == false) {
            $('.surgicalobs_row_exp_' + index).addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="surgicalobs_row_data_experience_' + index + '"]').select2().val(null).trigger('change');
        }

        if (selectedValues.includes("3") == false) {
            $('.surgicalpad_row_data_exp_' + index).addClass('d-none');
            $('.surgical_rowp_exp_' + index).addClass('d-none');
            $('.neonatal_row_exp_' + index).addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box_exp_' + index + '"]').select2().val(null).trigger('change');
            $('.js-example-basic-multiple[data-list-id="surgical_operative_care_experience-' + k + '-' + index + '"]').select2().val(null).trigger('change');
            //$('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
        }
    });

    $(document).on('change', '.surgical_subtype', function() {
        let selectedValues = $(this).val(); // Get selected values
        let index = $(this).attr('index_name'); // Get the index name
        let liCount = $("#surgical_row_box_exp_" + index).children("li").length; // Count <li> elements

        for (let k = 1; k <= liCount; k++) {
            // Get the value for the current surgical subtype
            let speciality_result_val = $(".speciality_surgical_result_experience-" + index + "-" + k).val();

            if (selectedValues.includes(speciality_result_val)) {
                // Show the row if the value is included
                $('.surgical_row_exp-' + k + '-' + index).removeClass('d-none');
            } else {
                // Hide the row if the value is not included
                $('.surgical_row_exp-' + k + '-' + index).addClass('d-none');
            }
        }
    });

    $(document).on('change', '.specilitysubtype', function() {
        let index = $(this).attr('index_name');
        let data_list_id = $(this).attr('data-list-id');

        if (data_list_id === 'speciality_entry_exp-2-' + index) {
            let selectedValues = $(this).val(); // Gets the selected value(s)
            let liCount = $("#speciality_entry_exp-2-" + index).children("li").length; // Number of child `li` elements
            console.log(selectedValues);
            // Check if selected value is '233'
            if (selectedValues.includes('233')) {
                $('.surgicalobs_row_exp_' + index).removeClass('d-none');
            } else {
                $('.surgicalobs_row_exp_' + index).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgicalobs_row_data_experience_' + index + '"]')
                    .select2()
                    .val(null)
                    .trigger('change');
            }
        }

        if (data_list_id === 'speciality_entry_exp-1-' + index) {
            let selectedValues = $(this).val();
            if (selectedValues.includes('96')) {
                $('.surgical_row_data_experience_' + index).removeClass('d-none');
            } else {
                $('.surgical_row_data_experience_' + index).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgical_row_box_exp_' + index + '"]')
                    .select2()
                    .val(null)
                    .trigger('change');
            }
        }

        if (data_list_id === 'speciality_entry_exp-3-' + index) {
            let selectedValues = $(this).val();
            if (selectedValues.includes('285')) {
                $('.surgicalpad_row_data_exp_' + index).removeClass('d-none');
            } else {
                $('.surgicalpad_row_data_exp_' + index).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box_exp_' + index + '"]')
                    .select2()
                    .val(null)
                    .trigger('change');
            }

            if (selectedValues.includes('250')) {
                $('.neonatal_row_exp_' + index).removeClass('d-none');
            } else {
                $('.neonatal_row_exp_' + index).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="neonatal_care_expe"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("285") == false) {
                $('.surgical_rowp_exp_' + index).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgical_operative_carep_exp-' + index + '"]')
                    .select2()
                    .val(null)
                    .trigger('change');
            }
        }
    });

    $(document).on('change', '.pae_sur_pre', function() {
        let selectedValues = $(this).val(); // Get selected values
        let index = $(this).attr('index_name'); // Get the index name
        let liCount = $("#surgical_rowpad_box_exp_" + index).children("li").length; // Count <li> elements
        for (let k = 1; k <= liCount; k++) {
            // Get the value for the current surgical subtype
            let surgical_rowp_val = $(".surgical_rowp_result_experience-" + index + "-" + k).val();
            if (selectedValues.includes(surgical_rowp_val)) {
                // Show the row if the value is included
                $('.surgical_rowp_exp-' + k + '-' + index).removeClass('d-none');
            } else {
                // Hide the row if the value is not included
                $('.surgical_rowp_exp-' + k + '-' + index).addClass('d-none');
            }
        }
    });

    $(document).on('change', '.specific_skill', function() {
        let selectedValues = $(this).val(); // Get selected values
        let index = $(this).attr('index_name'); // Get the index name
        if (selectedValues.includes('8')) {
            // Show the row if the value is included
            $('.interpersonal_' + index).removeClass('d-none');
        } else {
            // Hide the row if the value is not included
            $('.interpersonal_' + index).addClass('d-none');
        }

        if (selectedValues.includes('9')) {
            // Show the row if the value is included
            $('.analy_skill_' + index).removeClass('d-none');
        } else {
            // Hide the row if the value is not included
            $('.analy_skill_' + index).addClass('d-none');
        }

        if (selectedValues.includes('10')) {
            // Show the row if the value is included
            $('.leader_skill_' + index).removeClass('d-none');
        } else {
            // Hide the row if the value is not included
            $('.leader_skill_' + index).addClass('d-none');
        }

        if (selectedValues.includes('11')) {
            // Show the row if the value is included
            $('.tech_skill_' + index).removeClass('d-none');
        } else {
            // Hide the row if the value is not included
            $('.tech_skill_' + index).addClass('d-none');
        }

    });

    $(document).on('click', '.delete-work-experience', function() {
        var id = $(this).attr('data-index');
        if (id) {
            $(this).closest('.work_exp').remove();
            $('.previous_employeers .work_exp').each(function(index) {
                $(this).find('.previous_employeers_head').text(`Work Experience ${index + 1}`);
            });
            previous_employeers_head = $('.previous_employeers .work_exp').length + 1;
        } else {
            $(this).closest('.work_exp').remove();
            $('.previous_employeers .work_exp').each(function(index) {
                $(this).find('.previous_employeers_head').text(`Work Experience ${index + 1}`);
            });
            previous_employeers_head = $('.previous_employeers .work_exp').length + 1;
        }
    });

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
                    url: "{{ url('/nurse/getWorkplaceData') }}",
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
                    url: "{{ url('/nurse/getSubWorkplaceData') }}",
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

    function getPostions(ap, k){
        
        if(ap == 'ap'){
            var selectedValues = $('.js-example-basic-multiple'+k+'[data-list-id="position_held_field-'+k+'"]').val();
        }else{
            var selectedValues = $('.js-example-basic-multiple[data-list-id="position_held_field-'+k+'"]').val();
        }
        
        console.log("selectedValues",selectedValues);

        $(".show_positions-"+k+" .subpos_list").each(function(i,val){
          var val1 = $(val).val();
          console.log("val",val1);
          if(selectedValues.includes(val1) == false){
            $(".subposdiv-"+val1).remove();
            
          }
        });

        for(var i=0;i<selectedValues.length;i++){
            if($(".show_positions-"+k+" .subposdiv-"+selectedValues[i]).length < 1 && selectedValues[i] != "35"){
                $("#submitExperience").attr("disabled", true);
                $.ajax({
                    type: "GET",
                    url: "{{ url('/nurse/getEmployeePositions') }}",
                    data: {postion_id:selectedValues[i]},
                    cache: false,
                    success: function(data){
                        var data1 = JSON.parse(data);
                        console.log("data1",data1);
                        
                        var pos_text = "";
                        for(var j=0;j<data1.employee_positions.length;j++){
                        
                            pos_text += "<li data-value='"+data1.employee_positions[j].position_id+"'>"+data1.employee_positions[j].position_name+"</li>"; 
                        
                        }

                        $('.js-example-basic-multiple[data-list-id="position_held_field-1"]').removeAttr("name");
                        
                        if(data1.postion_id != "34"){

                            $(".show_positions-"+k).append('\<div class="subposdiv subposdiv-'+data1.postion_id+' form-group level-drp">\
                            <label class="form-label pos_label pos_label-'+k+data1.postion_id+'" for="input-1">'+data1.position_name+'</label>\
                            <input type="hidden" name="subpos" class="subpos subpos-'+data1.postion_id+'" value="'+k+'">\
                            <input type="hidden" name="subpos_list" class="subpos_list subpos_list-'+k+'" value="'+data1.postion_id+'">\
                            <ul id="subposition_held_field-'+data1.postion_id+'" style="display:none;">'+pos_text+'</ul>\
                            <select class="js-example-basic-multiple'+k+data1.postion_id+' addAll_removeAll_btn position_valid-'+k+data1.postion_id+'" data-list-id="subposition_held_field-'+data1.postion_id+'" name="subpositions_held['+k+']['+data1.postion_id+'][]" id="subposition_held_field-{{ $i }}" multiple></select>\
                            <span id="reqsubpositionheld-'+k+data1.postion_id+'" class="reqError text-danger valley"></span>\
                            </div>');
                        }else{
                            $(".show_positions-"+k).append('<div class="subposdiv subposdiv-'+data1.postion_id+' form-group level-drp">\
                            <label class="form-label pos_label pos_label-'+k+data1.postion_id+'" for="input-1">Other</label>\
                            <input type="hidden" name="subpos_list" class="subpos_list subpos_list-'+k+'" value="34">\
                            <input type="text" name="subpositions_held['+k+']['+data1.postion_id+'][]" class="form-control position_other position_other-'+k+' position_valid-'+k+data1.postion_id+'">\
                            <span id="reqsubpositionheld-'+k+data1.postion_id+'" class="reqError text-danger valley"></span>\
                            </div>');
                        }
                        
                        let $fields = $(".show_positions-"+k+" .subposdiv");

                        let sortedFields = $fields.sort(function (a, b) {
                            return $(a).find(".pos_label").text().localeCompare($(b).find(".pos_label").text());
                        });

                        $(".show_positions-"+k).append(sortedFields);

                        selectTwoFunction(k+data1.postion_id);
                        

                        $("#submitExperience").removeAttr("disabled");
                    }
                });
           }
        }
        
    }

    function selectTwoFunction(select_id){
    
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
        $('.addAll_removeAll_btn').on('select2:open', function() {
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

        $('.js-example-basic-multiple'+select_id).select2();

        // Dynamically add the clear button
        const clearButton = $('<span class="clear-btn">✖</span>');
        $('.select2-container').append(clearButton);

        // Handle the visibility of the clear button
        function toggleClearButton() {

            const selectedOptions = $('.js-example-basic-multiple'+select_id).val();
            if (selectedOptions && selectedOptions.length > 0) {
                clearButton.show();
            } else {
                clearButton.hide();
            }
        }

        // Attach change event to select2
        $('.js-example-basic-multiple'+select_id).on('change', toggleClearButton);

        // Clear button click event
        clearButton.click(function() {

            $('.js-example-basic-multiple'+select_id).val(null).trigger('change');
            toggleClearButton();
        });

        // Initial check
        toggleClearButton();
        $('.js-example-basic-multiple'+select_id).each(function() {
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
    }
</script>
@endsection