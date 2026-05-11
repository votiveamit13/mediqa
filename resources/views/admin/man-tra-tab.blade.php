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

    .add_new_certification_div {
        margin-top: 3rem !important;
        margin-bottom: 1rem !important;
    }

    button.clear-button {
        position: absolute;
        right: 5px;
        top: 10px;
        background: none;
        border: none;
    }

    h6 {
        font-family: "Plus Jakarta Sans", sans-serif;
        font-style: normal;
        font-weight: 700;
        font-size: 16px;
        line-height: 26px;
        color: #000000;
    }

    .file-item {
        display: flex;
        align-items: unset;
        margin-bottom: 10px;
    }

    .file-item a {
        text-decoration: none;
        color: #333;
        margin-right: 10px;
        display: flex;
        align-items: center;
    }

    .file-item .fa-file {
        margin-right: 5px;
    }

    .file-item .close_btn.close_btn-0 {
        margin-left: 0;
    }

    i.fa.fa-file {
        position: relative;
        left: 0px;
        font-size: 14px;
        line-height: 25px;
        margin-right: 5px;
        color: #000000;
    }

    .close_btn i {
        display: block;
        /*position: relative;*/
        left: 0px;
        font-size: 14px;
        line-height: 25px;
        margin-right: 5px;
        color: #000000;
        top: 14px;
    }

    .vaccine-section {
        padding-bottom: 20px;
        margin-bottom: 15px;
        border-bottom: solid 1px #80808045;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />


<div class="container-fluid">
    <?php
    $sessid = 125; // Default value
    $userid = request()->route('id');
    if (Session::has('nurseemail')) {
        $email = Session::get('nurseemail');
        $post = DB::table("users")->where('email', $email)->first();
        if ($post) {
            $sessid = $post->id;
        }
    }
    $user_id = request()->route('id');
    ?>
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Add Nurse</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted " href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Add Nurse</li>
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
                    <a class="nav-link active" data-bs-toggle="tab" href="#tab-1" role="tab"
                        aria-selected="true">
                        <span>Basic Details</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#tab-2" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Setting</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#tab-3" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Profession</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#tab-4" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Education and Certifications</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#tab-6" role="tab" aria-selected="false"
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
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-5.1" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>References</span>
                    </a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-7" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Vaccinations</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-8" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Work Clearances</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-9" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Professional</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-10" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Interview</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-11" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Personal Preferences</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-12" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Job Search & Personal Preferences</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-13" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Testimonials and Reviews</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-14" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Additional Information</span>
                    </a>
                </li>


            </ul>

            <!-- Tab panes -->
            <div class="tab-content border mt-2">
                <input type="hidden" value="{{ $userid }}" name="new_user_id" id="new_user_id">
                <?php
                $trainingData = DB::table("mandatory_training")->where("user_id", $userid)->first();
                if ($trainingData && $trainingData->well_sel_data) {
                    $well_data1 = json_decode($trainingData->well_sel_data);
                    $well_data_arr = array();
                    foreach ($well_data1 as $w_data) {
                        $well_data_arr[] = $w_data->well_tra_id;
                    }
                    $well_data_json = json_encode($well_data_arr);
                } else {
                    $well_data1 = "";
                    $well_data_json = "";
                }

                if ($trainingData && $trainingData->tech_innvo_data) {
                    $tech_data1 = json_decode($trainingData->tech_innvo_data);
                    $tech_data_arr = array();
                    foreach ($tech_data1 as $t_data) {
                        $tech_data_arr[] = $t_data->tech_tra_id;
                    }
                    $tech_data_json = json_encode($tech_data_arr);
                } else {
                    $tech_data1 = "";
                    $tech_data_json = "";
                }


                if ($trainingData && $trainingData->leader_pro_data) {
                    $lead_data1 = json_decode($trainingData->leader_pro_data);
                    $lead_data_arr = array();
                    foreach ($lead_data1 as $l_data) {
                        $lead_data_arr[] = $l_data->lead_pro_tra_id;
                    }
                    $lead_data_json = json_encode($lead_data_arr);
                } else {
                    $lead_data1 = "";
                    $lead_data_json = "";
                }

                if ($trainingData && $trainingData->mid_spec_data) {
                    $mid_data1 = json_decode($trainingData->mid_spec_data);
                    $mid_data_arr = array();
                    foreach ($mid_data1 as $m_data) {
                        $mid_data_arr[] = $m_data->mid_spec_tra_id;
                    }
                    $mid_data_json = json_encode($mid_data_arr);
                } else {
                    $mid_data1 = "";
                    $mid_data_json = "";
                }

                if ($trainingData && $trainingData->clinic_skill_data) {
                    $cli_data1 = json_decode($trainingData->clinic_skill_data);
                    $cli_data_arr = array();
                    foreach ($cli_data1 as $c_data) {
                        $cli_data_arr[] = $c_data->cli_skill_tra_id;
                    }
                    $cli_data_json = json_encode($cli_data_arr);
                } else {
                    $cli_data1 = "";
                    $cli_data_json = "";
                }

                if ($trainingData && $trainingData->emerg_topic_data) {
                    $emr_data1 = json_decode($trainingData->emerg_topic_data);
                    $emr_data_arr = array();
                    foreach ($emr_data1 as $emr_data) {
                        $emr_data_arr[] = $emr_data->emr_edu_id;
                    }
                    $emr_data_json = json_encode($emr_data_arr);
                } else {
                    $emr_data1 = "";
                    $emr_data_json = "";
                }

                if ($trainingData && $trainingData->safety_com_data) {
                    $safety_data1 = json_decode($trainingData->safety_com_data);
                    $safety_data_arr = array();
                    foreach ($safety_data1 as $safety_data) {
                        $safety_data_arr[] = $safety_data->saf_edu_id;
                    }
                    $safety_data_json = json_encode($safety_data_arr);
                } else {
                    $safety_data1 = "";
                    $safety_data_json = "";
                }

                if ($trainingData && $trainingData->spec_area_data) {
                    $spec_area_data1 = json_decode($trainingData->spec_area_data);
                    $spec_area_data_arr = array();
                    foreach ($spec_area_data1 as $spec_area_data) {
                        $spec_area_data_arr[] = $spec_area_data->spec_edu_id;
                    }
                    $spec_area_json = json_encode($spec_area_data_arr);
                } else {
                    $spec_area_data1 = "";
                    $spec_area_json = "";
                }

                if ($trainingData && $trainingData->mid_spe_data) {
                    $mid_spe_data1 = json_decode($trainingData->mid_spe_data);
                    $mid_spe_data_arr = array();
                    foreach ($mid_spe_data1 as $mid_spe_data) {
                        $mid_spe_data_arr[] = $mid_spe_data->mid_spe_edu_id;
                    }
                    $mid_spe_json = json_encode($mid_spe_data_arr);
                } else {
                    $mid_spe_data1 = "";
                    $mid_spe_json = "";
                }

                if ($trainingData && $trainingData->core_man_data) {
                    $core_man_data1 = json_decode($trainingData->core_man_data);
                    $core_man_data_arr = array();
                    foreach ($core_man_data1 as $core_man_data) {
                        $core_man_data_arr[] = $core_man_data->core_man_edu_id;
                    }
                    $core_man_json = json_encode($core_man_data_arr);
                } else {
                    $core_man_data1 = "";
                    $core_man_json = "";
                }

                ?>
                <div>
                    <form id="man_tra_form" method="post">
                        <input type="hidden" value="tab5" name="tab">
                        <input type="hidden" value="{{ $sessid }}" name="user_id">
                        <div class="row">
                            <div class="w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Mandatory Training and Continuing Education</h3>
                                    <p>Mandatory Training and Continuing Education are vital for many nursing and midwifery roles. Keeping them up to date is crucial to maintaining your eligibility for employment opportunities</p>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <h6 class="fw-bolder fs-6 d-flex align-items-center ">Completed training programs</h6>
                                            <p>Please add required courses or certifications completed for compliance or safety</p>
                                            <div class="col-md-12 mt-3">
                                                <input type="hidden" name="man_training" class="man_training" value="@if(!empty($trainingData)) {{ $trainingData->man_training }}@endif">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Please select all that apply</strong></label>
                                                    <?php
                                                    $mandatory_courses = DB::table('man_training_category')->where('type', 'Training')->where('parent', 0)->orderBy('id', 'desc')->get();
                                                    ?>
                                                    <ul id="mandatory_courses" style="display:none;">
                                                        @foreach($mandatory_courses as $m_courses)
                                                        <li data-value="{{ $m_courses->id }}">{{ $m_courses->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="mandatory_courses" name="mandatory_courses[]" multiple="multiple"></select>
                                                    <span id="reqmantra" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>

                                            <div class="mandatory_sub_courses">

                                                <?php
                                                $mandatory_sub_courses = DB::table('man_training_category')
                                                    ->where('parent', 419)
                                                    ->where('type', 'Training')
                                                    ->get();
                                                ?>

                                                <!-- cat-1 -->
                                                <div class="col-md-12 mt-3 level-drp mandatory_courses_div  mandatory_tr_div_1 @if($trainingData && $trainingData->well_sel_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif">
                                                    <input type="hidden" name="well_sel_data" class="well_sel_data" value="@if(!empty($trainingData)){{ $well_data_json }}@endif">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Wellness And Self-Care</strong></label>
                                                        <ul id="well_self_care_data" style="display:none;">
                                                            @foreach($mandatory_sub_courses as $ms_courses)
                                                            <li data-value="{{ $ms_courses->name }}">{{ $ms_courses->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="well_self_care_data" name="well_self_care_data[]" multiple="multiple"></select>
                                                    </div>
                                                </div>
                                                <div class="well_self_care_div">
                                                    <?php
                                                    $i = 0;
                                                    ?>
                                                    @if(!empty($well_data1))
                                                    @foreach($well_data1 as $well_data)

                                                    <?php
                                                    $well_first_word = strtok($well_data->well_tra_id, " ");

                                                    $well_first_word  = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $well_first_word));

                                                    ?>
                                                    <div class="well_self_care_{{ $well_first_word }} well_div_{{ $well_first_word }}">

                                                        <h6>{{ $well_data->well_tra_id }}</h6>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label class="form-label" for="input-1">Institution/Regulating Body</label>
                                                                <input type="hidden" name="wellnamearr[]" class="wellness_input_{{ $well_data->well_tra_id }}" value="{{ $well_data->well_tra_id }}">
                                                                <input class="form-control well_institution well_institution-{{ $i }}" type="text" name="well_institution[]" value="{{ $well_data->well_institution }}">
                                                                <span id="wellinstitutionvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Training Start Date</label>
                                                                <input class="form-control well_tra_start_date well_tra_start_date-{{ $i }}" type="date" name="well_tra_start_date[]" value="{{ $well_data->well_tra_start_date }}" onkeydown="return false">
                                                                <span id="well_tra_start_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Training End Date</label>
                                                                <input class="form-control well_tra_end_date well_tra_end_date-{{ $i }}" type="date" name="well_tra_end_date[]" value="{{ $well_data->well_tra_end_date }}" onkeydown="return false">
                                                                <span id="well_tra_end_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control well_expiry well_expiry-{{ $i }}" type="date" name="well_expiry[]" value="{{ $well_data->well_expiry }}">
                                                                <span id="wellexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload Certificate</label>
                                                                <input class="form-control well_upload_certification well_imgs_{{ $well_first_word }} well_upload_certification-{{ $i }}" type="file" name="well_upload_certification[{{ $i }}][]" onchange="changetraImg1({{ $user_id }},{{ $i }},'well_imgs','{{ $well_first_word }}')" multiple>
                                                                <span id="reqwelluploadvalid-{{ $i }}" class="reqError text-danger valley"></span>

                                                                <?php
                                                                $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                                if (!empty($getedufieldsdata)) {
                                                                    $well_img = (array)json_decode($getedufieldsdata->well_imgs);
                                                                } else {
                                                                    $well_img = '';
                                                                }


                                                                if (!empty($well_img)) {
                                                                    $well_img_data = json_decode($well_img[$well_first_word]);
                                                                } else {
                                                                    $well_img_data = "";
                                                                }
                                                                //print_r($acls_img[$acls_first_word_one]);


                                                                //print_r($dtran_img);
                                                                $l = 1;
                                                                $user_id = $user_id;
                                                                ?>
                                                                <div class="well_imgs{{ $well_first_word }}">
                                                                    @if(!empty($well_img_data))
                                                                    @foreach($well_img_data as $w_img)
                                                                    <div class="trans_img trans_img-{{ $i }} trans_imgwell_imgs{{ $well_first_word }}{{ $l }}">
                                                                        <a href="{{ url('/public/uploads/education_degree') }}/{{ $w_img }}"><i class="fa fa-file"></i>{{ $w_img }}</a>
                                                                        <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $w_img }}','{{ $well_first_word }}','well_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                                                    </div>
                                                                    <?php
                                                                    $l++;
                                                                    ?>

                                                                    @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>

                                                <!-- cat-2 -->
                                                <div class="col-md-12 mt-3 level-drp mandatory_courses_div  mandatory_tr_div_2 @if($trainingData && $trainingData->tech_innvo_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif">
                                                    <input type="hidden" name="tech_innvo_data" class="tech_innvo_data" value="@if(!empty($trainingData)){{ $tech_data_json }}@endif">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Technology and Innovation in Healthcare</strong></label>
                                                        <?php $mandatory_sub_courses = DB::table('man_training_category')
                                                            ->where('parent', 418)
                                                            ->where('type', 'Training')
                                                            ->get(); ?>

                                                        <ul id="tech_innvo_health_data" style="display:none;">
                                                            @foreach($mandatory_sub_courses as $ms_courses)
                                                            <li data-value="{{ $ms_courses->name }}">{{ $ms_courses->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="tech_innvo_health_data" name="tech_innvo_health_data[]" multiple="multiple"></select>
                                                    </div>
                                                </div>
                                                <span id="reqtechinno" class="reqError text-danger valley"></span>
                                                <div class="tech_innvo_health_div">
                                                    <?php
                                                    $i = 0;
                                                    ?>
                                                    @if(!empty($tech_data1))
                                                    @foreach($tech_data1 as $tech_data)

                                                    <?php
                                                    $tech_first_word = strtok($tech_data->tech_tra_id, " ");

                                                    $tech_first_word  = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $tech_first_word));

                                                    ?>
                                                    <div class="tech_innvo_health_{{ $tech_first_word }} tech_innvo_div_{{ $tech_first_word }}">

                                                        <h6>{{ $tech_data->tech_tra_id }}</h6>
                                                        <div class="tech_innvo_div row tech_innvo_institution">
                                                            <div class="form-group col-md-12">
                                                                <label class="form-label" for="input-1">Institution/Regulating Body</label>
                                                                <input type="hidden" name="techinnvonamearr[]" class="tech_innvo_input_{{ $tech_data->tech_tra_id }}" value="{{ $tech_data->tech_tra_id }}">
                                                                <input class="form-control tech_innvo_institution tech_innvo-{{ $i }}" type="text" name="tech_innvo_institution[]" value="{{ $tech_data->tech_institution }}">
                                                                <span id="techinnvoinstitutionvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Training Start Date</label>
                                                                <input class="form-control tech_innvo_tra_start_date tech_innvo_tra_start_date-{{ $i }}" type="date" name="tech_innvo_tra_start_date[]" value="{{ $tech_data->tech_start_date }}" onkeydown="return false">
                                                                <span id="tech_innvo_tra_start_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Training End Date</label>
                                                                <input class="form-control tech_innvo_tra_end_date tech_innvo_tra_end_date-{{ $i }}" type="date" name="tech_innvo_tra_end_date[]" value="{{ $tech_data->tech_end_date }}" onkeydown="return false">
                                                                <span id="tech_innvo_tra_end_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control tech_innvo_expiry tech_innvo_expiry-{{ $i }}" type="date" name="tech_innvo_expiry[]" value="{{ $tech_data->tech_expiry }}">
                                                                <span id="wellexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload Certificate</label>
                                                                <input class="form-control tech_innvo_upload_certification tech_innvo_imgs_{{ $tech_first_word }} tech_innvo_upload_certification-{{ $i }}" type="file" name="tech_innvo_upload_certification[{{ $i }}][]" onchange="changetraImg1({{ $user_id }},{{ $i }},'tech_innvo_imgs','{{ $tech_first_word }}')">
                                                                <span id="reqtechinnvouploadvalid-{{ $i }}" class="reqError text-danger valley"></span>

                                                                <?php
                                                                $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                                if (!empty($getedufieldsdata)) {
                                                                    $tech_img = (array)json_decode($getedufieldsdata->tech_innvo_imgs);
                                                                } else {
                                                                    $tech_img = '';
                                                                }


                                                                if (!empty($tech_img)) {
                                                                    $tech_img_data = json_decode($tech_img[$tech_first_word]);
                                                                } else {
                                                                    $tech_img_data = "";
                                                                }
                                                                //print_r($acls_img[$acls_first_word_one]);


                                                                //print_r($dtran_img);
                                                                $l = 1;
                                                                $user_id = $user_id;
                                                                ?>
                                                                <div class="tech_innvo_imgs{{ $tech_first_word }}">
                                                                    @if(!empty($tech_img_data))
                                                                    @foreach($tech_img_data as $t_img)
                                                                    <div class="trans_img trans_img-{{ $i }} trans_imgtech_innvo_imgs{{ $tech_first_word }}{{ $l }}">
                                                                        <a href="{{ url('/public/uploads/education_degree') }}/{{ $t_img }}"><i class="fa fa-file"></i>{{ $t_img }}</a>
                                                                        <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $t_img }}','{{ $tech_first_word }}','tech_innvo_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                                                    </div>
                                                                    <?php
                                                                    $l++;
                                                                    ?>

                                                                    @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>

                                                <!-- cat-3 -->
                                                <div class="col-md-12 mt-3 level-drp mandatory_courses_div  mandatory_tr_div_3 @if($trainingData && $trainingData->leader_pro_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif">
                                                    <div class="form-group">
                                                        <input type="hidden" name="lead_data" class="lead_data" value="@if(!empty($trainingData)){{ $lead_data_json }}@endif">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Leadership and Professional Development</strong></label>
                                                        <?php $mandatory_sub_courses = DB::table('man_training_category')
                                                            ->where('parent', 417)
                                                            ->where('type', 'Training')
                                                            ->get(); ?>

                                                        <ul id="leader_pro_dev_data" style="display:none;">
                                                            @foreach($mandatory_sub_courses as $ms_courses)
                                                            <li data-value="{{ $ms_courses->name }}">{{ $ms_courses->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="leader_pro_dev_data" name="leader_pro_dev_data[]" multiple="multiple"></select>
                                                    </div>
                                                </div>
                                                <span id="reqeaderpro" class="reqError text-danger valley"></span>
                                                <div class="leader_pro_dev_div">
                                                    <?php
                                                    $i = 0;
                                                    ?>
                                                    @if(!empty($lead_data1))
                                                    @foreach($lead_data1 as $lead_data)

                                                    <?php
                                                    $first_word = strtok($lead_data->lead_pro_tra_id, " ");

                                                    $first_word  = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $first_word));


                                                    $second_word = strtolower(preg_replace('/[^A-Za-z0-9]/', '', explode(' ', $lead_data->lead_pro_tra_id)[1] ?? ''));

                                                    // Get the first four characters of the second word
                                                    $second_word = substr($second_word, 0, 4);


                                                    $lead_first_word = $first_word . '_' . $second_word;

                                                    ?>
                                                    <div class="leader_pro_dev_{{ $lead_first_word }} leader_pro_div_{{ $lead_first_word }}">

                                                        <h6>{{ $lead_data->lead_pro_tra_id }}</h6>
                                                        <div class="leader_pro_div row leader_pro_institution">
                                                            <div class="form-group col-md-12">
                                                                <label class="form-label" for="input-1">Institution/Regulating Body</label>
                                                                <input type="hidden" name="leaderpronamearr[]" class="leader_pro_input_{{ $lead_data->lead_pro_tra_id }}" value="{{ $lead_data->lead_pro_tra_id }}">
                                                                <input class="form-control leader_pro_institution leader_pro-{{ $i }}" type="text" name="leader_pro_institution[]" value="{{ $lead_data->lead_pro_institution }}">
                                                                <span id="leaderproinstivalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Training Start Date</label>
                                                                <input class="form-control leader_pro_tra_start_date leader_pro_tra_start_date-{{ $i }}" type="date" name="leader_pro_tra_start_date[]" value="{{ $lead_data->lead_start_date }}" onkeydown="return false">
                                                                <span id="leader_pro_tra_start_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Training End Date</label>
                                                                <input class="form-control leader_pro_tra_end_date leader_pro_tra_end_date-{{ $i }}" type="date" name="leader_pro_tra_end_date[]" value="{{ $lead_data->lead_end_date }}" onkeydown="return false">
                                                                <span id="tech_innvo_tra_end_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control leader_pro_expiry leader_pro_expiry-{{ $i }}" type="date" name="leader_pro_expiry[]" value="{{ $lead_data->lead_expiry }}">
                                                                <span id="wellexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload Certificate</label>
                                                                <input class="form-control leader_pro_upload_certification leader_pro_imgs_{{ $lead_first_word }} leader_pro_upload_certification-{{ $i }}" type="file" name="leader_pro_upload_certification[{{ $i }}][]" onchange="changetraImg1({{ $user_id }},{{ $i }},'leader_pro_imgs','{{ $lead_first_word }}')" multiple>
                                                                <span id="reqleaderprouploadvalid-{{ $i }}" class="reqError text-danger valley"></span>

                                                                <?php
                                                                $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                                if (!empty($getedufieldsdata)) {
                                                                    $lead_img = (array)json_decode($getedufieldsdata->leader_pro_imgs);
                                                                } else {
                                                                    $lead_img = '';
                                                                }


                                                                if (!empty($lead_img)) {
                                                                    $lead_img_data = json_decode($lead_img[$lead_first_word]);
                                                                } else {
                                                                    $lead_img_data = "";
                                                                }
                                                                //print_r($acls_img[$acls_first_word_one]);


                                                                //print_r($dtran_img);
                                                                $l = 1;
                                                                $user_id = $user_id;
                                                                ?>
                                                                <div class="leader_pro_imgs{{ $lead_first_word }}">
                                                                    @if(!empty($lead_img_data))
                                                                    @foreach($lead_img_data as $l_img)
                                                                    <div class="trans_img trans_img-{{ $i }} trans_imgleader_pro_imgs{{ $lead_first_word }}{{ $l }}">
                                                                        <a href="{{ url('/public/uploads/education_degree') }}/{{ $l_img }}"><i class="fa fa-file"></i>{{ $l_img }}</a>
                                                                        <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $l_img }}','{{ $lead_first_word }}','leader_pro_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                                                    </div>
                                                                    <?php
                                                                    $l++;
                                                                    ?>

                                                                    @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>

                                                <!-- cat-4 -->
                                                <div class="col-md-12 mt-3 level-drp mandatory_courses_div  mandatory_tr_div_4 @if($trainingData && $trainingData->mid_spec_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif">
                                                    <input type="hidden" name="mid_data" class="mid_data1" value="@if(!empty($trainingData)){{ $mid_data_json }}@endif">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Midwifery-Specific Training</strong></label>
                                                        <?php $mandatory_sub_courses = DB::table('man_training_category')
                                                            ->where('parent', 416)
                                                            ->where('type', 'Training')
                                                            ->get(); ?>

                                                        <ul id="mid_spec_tra_data" style="display:none;">
                                                            @foreach($mandatory_sub_courses as $ms_courses)
                                                            <li data-value="{{ $ms_courses->name}}">{{ $ms_courses->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="mid_spec_tra_data" name="mid_spec_tra_data[]" multiple="multiple"></select>
                                                    </div>
                                                </div>
                                                <span id="reqmidwifespe" class="reqError text-danger valley"></span>
                                                <div class="mid_spec_tra_div">
                                                    <?php
                                                    $i = 0;
                                                    ?>
                                                    @if(!empty($mid_data1))
                                                    @foreach($mid_data1 as $mid_data)

                                                    <?php
                                                    $first_word = strtok($mid_data->mid_spec_tra_id, " ");

                                                    $first_word  = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $first_word));


                                                    $second_word = strtolower(preg_replace('/[^A-Za-z0-9]/', '', explode(' ', $mid_data->mid_spec_tra_id)[1] ?? ''));

                                                    // Get the first four characters of the second word
                                                    $second_word = substr($second_word, 0, 2);

                                                    $thired_word = strtolower(preg_replace('/[^A-Za-z0-9]/', '', explode(' ', $mid_data->mid_spec_tra_id)[1] ?? ''));

                                                    // Get the first four characters of the second word
                                                    $thired_word = substr($thired_word, 0, 4);
                                                    $mid_first_word = $first_word . '_' . $second_word . '_' . $thired_word;
                                                    ?>
                                                    <div class="mid_spec_tra_{{ $mid_first_word }} mid_spec_tra_{{ $mid_first_word }}">

                                                        <h6>{{ $mid_data->mid_spec_tra_id }}</h6>
                                                        <div class="mid_spec_div row mid_spec_institution">
                                                            <div class="form-group col-md-12">
                                                                <label class="form-label" for="input-1">Institution/Regulating Body</label>
                                                                <input type="hidden" name="midspecnamearr[]" class="mid_spec_input_{{ $mid_data->mid_spec_tra_id }}" value="{{ $mid_data->mid_spec_tra_id }}">
                                                                <input class="form-control mid_spec_institution mid_spec-{{ $i }}" type="text" name="mid_spec_institution[]" value="{{ $mid_data->mid_spec_institution }}">
                                                                <span id="midspecinstivalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Training Start Date</label>
                                                                <input class="form-control mid_spec_tra_start_date mid_spec_tra_start_date-{{ $i }}" type="date" name="mid_spec_tra_start_date[]" value="{{ $mid_data->mid_spec_start_date }}" onkeydown="return false">
                                                                <span id="mid_spec_tra_start_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Training End Date</label>
                                                                <input class="form-control mid_spec_tra_end_date mid_spec_tra_end_date-{{ $i }}" type="date" name="mid_spec_tra_end_date[]" value="{{ $mid_data->mid_spec_end_date }}" onkeydown="return false">
                                                                <span id="mid_spec_tra_end_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control mid_spec_expiry mid_spec_expiry-{{ $i }}" type="date" name="mid_spec_expiry[]" value="{{ $mid_data->mis_spec_expiry }}">
                                                                <span id="midspecexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload Certificate</label>
                                                                <input class="form-control mid_spec_upload_certification mid_spec_imgs_{{ $mid_first_word }} mid_spec_upload_certification-{{ $i }}" type="file" name="mid_spec_upload_certification[{{ $i }}][]" onchange="changetraImg1('{{ $user_id }}', '{{ $i }}', 'mid_spec_imgs', '{{ $mid_first_word }}')">
                                                                <span id="reqmidspecuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>

                                                                <?php
                                                                $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                                if (!empty($getedufieldsdata)) {
                                                                    $mid_img = (array)json_decode($getedufieldsdata->mid_spec_imgs);
                                                                } else {
                                                                    $mid_img = '';
                                                                }


                                                                if (!empty($mid_img)) {
                                                                    $mid_img_data = json_decode($mid_img[$mid_first_word]);
                                                                } else {
                                                                    $mid_img_data = "";
                                                                }

                                                                $l = 1;
                                                                $user_id = $user_id;
                                                                ?>
                                                                <div class="mid_spec_imgs{{ $mid_first_word }}">
                                                                    @if(!empty($mid_img_data))
                                                                    @foreach($mid_img_data as $m_img)
                                                                    <div class="trans_img trans_img-{{ $i }} trans_imgmid_spec_img{{ $mid_first_word }}{{ $l }}">
                                                                        <a href="{{ url('/public/uploads/education_degree') }}/{{ $m_img }}"><i class="fa fa-file"></i>{{ $m_img }}</a>
                                                                        <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $i }}','{{ $user_id }}','{{ $m_img }}','{{ $mid_first_word }}','mid_spec_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                                                    </div>
                                                                    <?php
                                                                    $l++;
                                                                    ?>
                                                                    @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>

                                                <!-- cat-5 -->
                                                <div class="col-md-12 mt-3 level-drp mandatory_courses_div  mandatory_tr_div_5  @if($trainingData && $trainingData->clinic_skill_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif">
                                                    <input type="hidden" name="cli_data" class="cli_data" value="@if(!empty($trainingData)){{ $cli_data_json }}@endif">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Clinical Skills and Core Competencies</strong></label>
                                                        <?php $mandatory_sub_courses = DB::table('man_training_category')
                                                            ->where('parent', 416)
                                                            ->where('type', 'Training')
                                                            ->get(); ?>

                                                        <ul id="mid_spec_tra_data" style="display:none;">
                                                            @foreach($mandatory_sub_courses as $ms_courses)
                                                            <li data-value="{{ $ms_courses->name}}">{{ $ms_courses->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="mid_spec_tra_data" name="mid_spec_tra_data[]" multiple="multiple"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <span id="reqcliniskill" class="reqError text-danger valley"></span>
                                            <div class="clinic_skill_core_div">
                                                <?php
                                                $i = 0;
                                                ?>
                                                @if(!empty($cli_data1))
                                                @foreach($cli_data1 as $cli_data)

                                                <?php
                                                $get_id = DB::table('man_training_category')
                                                    ->where('parent', 415)
                                                    ->where('type', 'Training')
                                                    ->where('name', '=', $cli_data->cli_skill_tra_id)
                                                    ->first();


                                                $cli_first = strtok($cli_data->cli_skill_tra_id, " ");

                                                $cli_first  = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $cli_first));

                                                $cli_first_word =  $cli_first . '_' . $get_id->id;
                                                ?>
                                                <div class="clinic_skill_{{ $cli_first_word }} clinic_skill_div_{{ $cli_first_word }}">

                                                    <h6>{{ $cli_data->cli_skill_tra_id }}</h6>
                                                    <div class="clinic_skill_div row clinic_skill_institution">
                                                        <div class="form-group col-md-12">
                                                            <label class="form-label" for="input-1">Institution/Regulating Body</label>
                                                            <input type="hidden" name="clinicskillnamearr[]" class="clinic_skill_{{ $cli_data->cli_skill_tra_id }}" value="{{ $cli_data->cli_skill_tra_id }}">
                                                            <input class="form-control clinic_skill_institution clinic_skill-{{ $i }}" type="text" name="clinic_skill_institution[]" value="{{ $cli_data->clinic_skill_institution }}">
                                                            <span id="cliskillinstivalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Training Start Date</label>
                                                            <input class="form-control clinic_skill_tra_start_date clinic_skill_tra_start_date-0-{{ $i }}" type="date" name="clinic_skill_tra_start_date[]" value="{{ $cli_data->cli_skill_start_date }}" onkeydown="return false">
                                                            <span id="clinic_skill_tra_start_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Training End Date</label>
                                                            <input class="form-control clinic_skill_tra_end_date clinic_skill_tra_end_date-{{ $i }}" type="date" name="clinic_skill_tra_end_date[]" value="{{ $cli_data->cli_skill_end_date }}" onkeydown="return false">
                                                            <span id="clinic_skill_tra_end_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Expiry</label>
                                                            <input class="form-control clinic_skill_expiry clinic_skill_expiry-{{ $i }}" type="date" name="clinic_skill_expiry[]" value="{{ $cli_data->cli_skill_expiry }}">
                                                            <span id="clinicskillexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Upload Certificate</label>
                                                            <input class="form-control clinic_skill_upload_certification clinic_skill_imgs_{{ $cli_first_word }} clinic_skill_upload_certification-{{ $i }}" type="file" name="clinic_skill_upload_certification[{{ $i }}][]" onchange="changetraImg1('{{ $user_id }}','{{ $i }}','clinic_skill_imgs','{{ $cli_first_word }}')">
                                                            <span id="reqtechinnvouploadvalid-{{ $i }}" class="reqError text-danger valley"></span>

                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $cli_img = (array)json_decode($getedufieldsdata->clinic_skill_imgs);
                                                            } else {
                                                                $cli_img = '';
                                                            }


                                                            if (!empty($cli_img)) {
                                                                $cli_img_data = json_decode($cli_img[$cli_first_word]);
                                                            } else {
                                                                $cli_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = $user_id;
                                                            ?>
                                                            <div class="clinic_skill_imgs{{ $cli_first_word }}">
                                                                @if(!empty($cli_img_data))
                                                                @foreach($cli_img_data as $cli_img)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imgclinic_skill_img{{ $cli_first_word }}{{ $l }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $cli_img }}"><i class="fa fa-file"></i>{{ $cli_img }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $i }}','{{ $user_id }}','{{ $cli_img }}','{{ $cli_first_word }}','clinic_skill_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                                                </div>
                                                                <?php
                                                                $l++;
                                                                ?>
                                                                @endforeach
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>

                                            <div class="another_com_training">
                                                <h6 class="fw-bolder fs-6 d-flex align-items-center mt-2">Other Trainings</h6>
                                                <?php
                                                if (!empty($trainingData)) {
                                                    $additional_tra_data = json_decode($trainingData->other_tra_data);
                                                } else {
                                                    $additional_tra_data = "";
                                                }
                                                $i = 1;
                                                $l = 0;
                                                ?>

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
                                                        <label class="form-label" for="input-1">Training {{ $i }}</label>
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

                                                        $user_id = $user_id;
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
                                                    $user_id = $user_id;
                                                    ?>
                                                    <div class="col-md-12">
                                                        <div class="add_new_cmp_training_div mb-3 mt-3"><a style="cursor: pointer;" onclick="delete_training('{{ $i }}','{{ $user_id }}','{{ $a_data->other_tra_id }}')">- Delete Training</a></div>
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

                                            <h6 class="fw-bolder fs-6 d-flex align-items-center">Mandatory Continuing Education</h6>

                                            <div class="col-md-12 mt-3">
                                                <p>Please add required ongoing education to stay updated in your field and maintain licensure</p>
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Please select all that apply</strong></label>
                                                    <input type="hidden" name="man_education" class="man_education" value="@if(!empty($trainingData)) {{ $trainingData->man_education }}@endif">
                                                    <?php
                                                    $mandatory_courses = DB::table('man_training_category')->where('type', 'Education')->where('parent', 0)->orderBy('id', 'desc')->get();
                                                    ?>
                                                    <ul id="mandatory_education" style="display:none;">
                                                        @foreach($mandatory_courses as $m_courses)
                                                        <li data-value="{{ $m_courses->id }}">{{ $m_courses->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="mandatory_education" name="mandatory_education[]" multiple="multiple"></select>
                                                    <span id="reqmanedu" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>

                                            <!-- cat-1 -->
                                            <?php
                                            $mandatory_sub_education = DB::table('man_training_category')
                                                ->where('parent', 440)
                                                ->where('type', 'Education')
                                                ->get();

                                            ?>

                                            <div class="mandatory_sub_education">
                                                <div class="col-md-12 mt-3 level-drp mandatory_sub_edu_div  mandatory_sub_edu_div_1 d-none">
                                                    <input type="hidden" name="cli_data" class="cli_data" value="@if(!empty($trainingData)){{ $emr_data_json }}@endif">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Core Mandatory Continuing Education</strong></label>
                                                        <ul id="core_man_con_data" style="display:none;">
                                                            @foreach($mandatory_sub_education as $ms_education)
                                                            <li data-value="{{ $ms_education->name }}" data-id="{{ $ms_education->id }}">{{ $ms_education->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="core_man_con_data" name="core_man_con_data[]" multiple="multiple"></select>
                                                    </div>
                                                </div>
                                                <div class="core_man_con_data_div">

                                                    <?php
                                                    $i = 0;
                                                    ?>
                                                    @if(!empty($core_man_data1))
                                                    @foreach($core_man_data1 as $core_man_data)
                                                    <?php
                                                    $first_word = strtok($core_man_data->core_man_edu_id, " ");

                                                    $first_word  = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $first_word));

                                                    $getname = DB::table('man_training_category')
                                                        ->where('parent', 440)
                                                        ->where('type', 'Education')
                                                        ->where('name', '=', $core_man_data->core_man_edu_id)
                                                        ->first();



                                                    $core_man_first_word = $first_word . '_' . $getname->id;
                                                    ?>
                                                    <div class="core_man_{{ $core_man_first_word }} core_man_{{ $core_man_first_word }}">
                                                        <h6>{{ $core_man_data->core_man_edu_id }}</h6>
                                                        <div class="core_man_div row core_man_institution">
                                                            <div class="form-group col-md-12">
                                                                <label class="form-label" for="input-1">Institution/Regulating Body</label>
                                                                <input type="hidden" name="coremanarr[]" class="coreman_input_{{ $core_man_data->core_man_edu_id }}" value="{{ $core_man_data->core_man_edu_id }}">
                                                                <input class="form-control core_man_institution core_man_institution-{{ $i }}" type="text" name="core_man_institution[]" value="{{ $core_man_data->core_man_institution }}">
                                                                <span id="coreinstitutionvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Start Date</label>
                                                                <input class="form-control coreman_start_date coreman_start_date-{{ $i }}" type="date" name="coreman_start_date[]" value="{{ $core_man_data->coreman_start_date }}">
                                                                <span id="coreman_start_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">End Date</label>
                                                                <input class="form-control coreman_end_date coreman_end_date-{{ $i }}" type="date" name="coreman_end_date[]" value="{{ $core_man_data->coreman_end_date }}">
                                                                <span id="coreman_end_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Status</label>
                                                                <select class="form-control coreman_status coreman_status-{{ $i }}" name="coreman_status[]">
                                                                    <option value="Completed" @if($core_man_data->coreman_status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ongoing" @if($core_man_data->coreman_status == 'Ongoing') selected @endif>Ongoing</option>
                                                                    <option value="Pending" @if($core_man_data->coreman_status == 'Pending') selected @endif>Pending</option>
                                                                </select>
                                                                <span id="coreman_statusvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control core_man_expiry core_man_expiry-{{ $i }}" type="date" name="core_man_expiry[]" value="{{ $core_man_data->core_man_expiry }}">
                                                                <span id="coremanexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label class="form-label" for="input-1">Upload Certificate</label>
                                                                <input class="form-control coreman_upload_certification core_man_imgs_{{ $core_man_first_word }} coreman_upload_certification-{{ $i }}" type="file" name="coreman_upload_certification[{{ $i }}][]" onchange="changetraImg1('{{ $user_id }}','{{ $i }}','core_man_imgs','{{ $core_man_first_word }}')">
                                                                <span id="reqmidspecuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>

                                                                <?php
                                                                $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                                if (!empty($getedufieldsdata)) {
                                                                    $core_man_img = (array)json_decode($getedufieldsdata->core_man_imgs);
                                                                } else {
                                                                    $core_man_img = '';
                                                                }



                                                                if (!empty($core_man_img)) {
                                                                    $core_man_img_data = json_decode($core_man_img[$core_man_first_word]);
                                                                } else {
                                                                    $core_man_img_data = "";
                                                                }
                                                                //print_r($acls_img[$acls_first_word_one]);


                                                                // //print_r($dtran_img);
                                                                $l = 1;
                                                                $user_id = $user_id;
                                                                ?>
                                                                <div class="core_man_imgs{{ $core_man_first_word }}">
                                                                    @if(!empty($core_man_img_data))
                                                                    @foreach($core_man_img_data as $core_man_img)
                                                                    <div class="trans_img trans_img-{{ $i }} trans_imgcore_man_imgs{{ $core_man_first_word }}{{ $i }}">
                                                                        <a href="{{ url('/public/uploads/education_degree') }}/{{ $core_man_img }}"><i class="fa fa-file"></i>{{ $core_man_img }}</a>
                                                                        <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $i }}','{{ $user_id }}','{{ $core_man_img }}','{{ $core_man_first_word  }}','core_man_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                                                    </div>
                                                                    <?php
                                                                    $l++;
                                                                    ?>
                                                                    @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>

                                                <!-- cat-2 -->
                                                <div class="col-md-12 mt-3 level-drp mandatory_sub_edu_div  mandatory_sub_edu_div_2 @if($trainingData && $trainingData->mid_spe_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif">
                                                    <input type="hidden" name="mid_spe_data" class="mid_spe_data" value="@if(!empty($trainingData)){{ $mid_spe_json }}@endif">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Midwifery-Specific Mandatory Continuing Education</strong></label>
                                                        <?php $mandatory_sub_education = DB::table('man_training_category')
                                                            ->where('parent', 441)
                                                            ->where('type', 'Education')
                                                            ->get(); ?>

                                                        <ul id="mid_spe_mandotry_data" style="display:none;">
                                                            @foreach($mandatory_sub_education as $ms_education)
                                                            <li data-value="{{ $ms_education->name }}">{{ $ms_education->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="mid_spe_mandotry_data" name="mid_spe_mandotry[]" multiple="multiple"></select>
                                                    </div>
                                                </div>
                                                <div class="mid_spe_mandotry_div">
                                                    <?php
                                                    $i = 0;
                                                    ?>
                                                    @if(!empty($mid_spe_data1))
                                                    @foreach($mid_spe_data1 as $mid_spe_data)
                                                    <?php
                                                    $first_word = strtok($mid_spe_data->mid_spe_edu_id, " ");

                                                    $first_word  = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $first_word));

                                                    $mid_spe_first_word = $first_word;
                                                    ?>
                                                    <div class="mid_spe_{{ $mid_spe_first_word }} mid_spe_{{ $mid_spe_first_word }}">
                                                        <h6>{{ $mid_spe_data->mid_spe_edu_id }}</h6>
                                                        <div class="mid_spe_div row mid_spe_institution">
                                                            <div class="form-group col-md-12">
                                                                <label class="form-label" for="input-1">Institution/Regulating Body</label>
                                                                <input type="hidden" name="midspearr[]" class="midspe_input_{{ $mid_spe_data->mid_spe_edu_id }}" value="{{ $mid_spe_data->mid_spe_edu_id }}">
                                                                <input class="form-control mid_spe_institution mid_spe_institution-{{ $i }}" type="text" name="mid_spe_institution[]" value="{{ $mid_spe_data->mid_spe_institution }}">
                                                                <span id="midspeinstitutionvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Start Date</label>
                                                                <input class="form-control mid_spe_start_date mid_spe_start_date-{{ $i }}" type="date" name="mid_spe_start_date[]" value="{{ $mid_spe_data->mid_spe_start_date }}">
                                                                <span id="mid_spe_start_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">End Date</label>
                                                                <input class="form-control mid_spe_end_date mid_spe_end_date-{{ $i }}" type="date" name="mid_spe_end_date[]" value="{{ $mid_spe_data->mid_spe_end_date }}">
                                                                <span id="mid_spe_end_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Status</label>
                                                                <select class="form-control mid_spe_status mid_spe_status-{{ $i }}" name="mid_spe_status[]">
                                                                    <option value="Completed" @if($mid_spe_data->mid_spe_status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ongoing" @if($mid_spe_data->mid_spe_status == 'Ongoing') selected @endif>Ongoing</option>
                                                                    <option value="Pending" @if($mid_spe_data->mid_spe_status == 'Pending') selected @endif>Pending</option>
                                                                </select>
                                                                <span id="mid_spe_statusvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control mid_spe_expiry mid_spe_expiry-{{ $i }}" type="date" name="mid_spe_expiry[]" value="{{ $mid_spe_data->mid_spe_expiry }}">
                                                                <span id="midspeexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label class="form-label" for="input-1">Upload Certificate</label>
                                                                <input class="form-control midspe_upload_certification mid_spe_imgs_{{ $mid_spe_first_word }} midspe_upload_certification-{{ $i }}" type="file" name="midspe_upload_certification[{{ $i }}][]" onchange="changetraImg1('{{ $user_id }}','{{ $i }}','mid_spe_imgs','{{ $mid_spe_first_word }}')">
                                                                <span id="reqmidspecuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>

                                                                <?php
                                                                $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                                if (!empty($getedufieldsdata)) {
                                                                    $mid_spe_img = (array)json_decode($getedufieldsdata->mid_spe_imgs);
                                                                } else {
                                                                    $mid_spe_img = '';
                                                                }



                                                                if (!empty($mid_spe_img)) {
                                                                    $mid_spe_img_data = json_decode($mid_spe_img[$mid_spe_first_word]);
                                                                } else {
                                                                    $mid_spe_img_data = "";
                                                                }
                                                                //print_r($acls_img[$acls_first_word_one]);


                                                                // //print_r($dtran_img);
                                                                $l = 1;
                                                                $user_id = $user_id;
                                                                ?>
                                                                <div class="mid_spe_imgs{{ $mid_spe_first_word }}">
                                                                    @if(!empty($mid_spe_img_data))
                                                                    @foreach($mid_spe_img_data as $mid_spe_img)
                                                                    <div class="trans_img trans_img-{{ $i }} trans_imgmid_spe_imgs{{ $mid_spe_first_word }}{{ $i }}">
                                                                        <a href="{{ url('/public/uploads/education_degree') }}/{{ $mid_spe_img }}"><i class="fa fa-file"></i>{{ $mid_spe_img }}</a>
                                                                        <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $i }}','{{ $user_id }}','{{ $mid_spe_img }}','{{ $mid_spe_first_word }}','mid_spe_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                                                    </div>
                                                                    <?php
                                                                    $l++;
                                                                    ?>
                                                                    @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>


                                                <!-- cat-3 -->
                                                <div class="col-md-12 mt-3 level-drp mandatory_sub_edu_div  mandatory_sub_edu_div_3 @if($trainingData && $trainingData->spec_area_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif">
                                                    <div class="form-group">
                                                        <input type="hidden" name="spec_area_data" class="spec_area_data" value="@if(!empty($trainingData)){{ $spec_area_json }}@endif">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Specialized Area</strong></label>
                                                        <?php
                                                        $mandatory_sub_education = DB::table('man_training_category')
                                                            ->where('parent', 442)
                                                            ->where('type', 'Education')
                                                            ->get();
                                                        ?>

                                                        <ul id="spec_area_data" style="display:none;">
                                                            @foreach($mandatory_sub_education as $ms_education)
                                                            <li data-value="{{ $ms_education->name }}">{{ $ms_education->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="spec_area_data" name="spec_area[]" multiple="multiple"></select>
                                                    </div>
                                                </div>
                                                <div class="spec_area_div">
                                                    <?php
                                                    $i = 0;
                                                    ?>
                                                    @if(!empty($spec_area_data1))
                                                    @foreach($spec_area_data1 as $spec_area_data)
                                                    <?php
                                                    $first_word = strtok($spec_area_data->spec_edu_id, " ");

                                                    $first_word  = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $first_word));



                                                    $spec_area_first_word = $first_word;
                                                    ?>
                                                    <div class="spec_area_{{ $spec_area_first_word }} spec_area_{{ $spec_area_first_word }}">
                                                        <h6>{{ $spec_area_data->spec_edu_id }}</h6>
                                                        <div class="spec_area_div row spec_area_institution">
                                                            <div class="form-group col-md-12">
                                                                <label class="form-label" for="input-1">Institution/Regulating Body</label>
                                                                <input type="hidden" name="specareaarr[]" class="spec_area_input_{{ $spec_area_data->spec_edu_id }}" value="{{ $spec_area_data->spec_edu_id }}">
                                                                <input class="form-control spec_area_institution spec_area_institution-{{ $i }}" type="text" name="spec_area_institution[]" value="{{ $spec_area_data->spec_edu_id }}">
                                                                <span id="specareainstitutionvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Start Date</label>
                                                                <input class="form-control spec_area_start_date spec_area_start_date-{{ $i }}" type="date" name="spec_area_start_date[]" value="{{ $spec_area_data->spec_area_start_date }}">
                                                                <span id="spec_area_start_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">End Date</label>
                                                                <input class="form-control spec_area_end_date spec_area_end_date-{{ $i }}" type="date" name="spec_area_end_date[]" value="{{ $spec_area_data->spec_area_end_date }}">
                                                                <span id="spec_area_end_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Status</label>
                                                                <select class="form-control spec_area_status spec_area_status-{{ $i }}" name="spec_area_status[]">
                                                                    <option value="Completed" @if($spec_area_data->spec_area_status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ongoing" @if($spec_area_data->spec_area_status == 'Ongoing') selected @endif>Ongoing</option>
                                                                    <option value="Pending" @if($spec_area_data->spec_area_status == 'Pending') selected @endif>Pending</option>
                                                                </select>
                                                                <span id="spec_area_statusvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control spec_area_expiry spec_area_expiry-{{ $i }}" type="date" name="spec_area_expiry[]" value="{{ $spec_area_data->spec_area_expiry }}">
                                                                <span id="specareaexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label class="form-label" for="input-1">Upload Certificate</label>
                                                                <input class="form-control specarea_upload_certification spec_area_imgs_{{ $spec_area_first_word }} specarea_upload_certification-{{ $i }}" type="file" name="specarea_upload_certification[{{ $i }}][]" onchange="changetraImg1('{{ $user_id }}','{{ $i }}','spec_area_imgs','{{ $spec_area_first_word }}')">
                                                                <span id="reqmidspecuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>

                                                                <?php
                                                                $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                                if (!empty($getedufieldsdata)) {
                                                                    $spec_area_img = (array)json_decode($getedufieldsdata->spec_area_imgs);
                                                                } else {
                                                                    $spec_area_img = '';
                                                                }



                                                                if (!empty($spec_area_img)) {
                                                                    $spec_area_img_data = json_decode($spec_area_img[$spec_area_first_word]);
                                                                } else {
                                                                    $spec_area_img_data = "";
                                                                }
                                                                //print_r($acls_img[$acls_first_word_one]);


                                                                // //print_r($dtran_img);
                                                                $l = 1;
                                                                $user_id = $user_id;
                                                                ?>
                                                                <div class="spec_area_imgs{{ $spec_area_first_word }}">
                                                                    @if(!empty($spec_area_img_data))
                                                                    @foreach($spec_area_img_data as $spec_area_img)
                                                                    <div class="trans_img trans_img-{{ $i }} trans_imgspec_area_imgs{{ $spec_area_first_word }}{{ $i }}">
                                                                        <a href="{{ url('/public/uploads/education_degree') }}/{{ $spec_area_img }}"><i class="fa fa-file"></i>{{ $spec_area_img }}</a>
                                                                        <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $i }}','{{ $user_id }}','{{ $spec_area_img }}','{{ $spec_area_first_word }}','spec_area_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                                                    </div>
                                                                    <?php
                                                                    $l++;
                                                                    ?>
                                                                    @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>

                                                <!-- cat-4-->
                                                <div class="col-md-12 mt-3 level-drp mandatory_sub_edu_div  mandatory_sub_edu_div_5  @if($trainingData && $trainingData->emerg_topic_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif">
                                                    <input type="hidden" name="emr_data" class="emr_data" value="@if(!empty($trainingData)){{ $emr_data_json }}@endif">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Emerging Topics and Continuing Education</strong></label>
                                                        <?php
                                                        $mandatory_sub_education = DB::table('man_training_category')
                                                            ->where('parent', 444)
                                                            ->where('type', 'Education')
                                                            ->get(); ?>

                                                        <ul id="emerging_topic_data" style="display:none;">
                                                            @foreach($mandatory_sub_education as $ms_education)
                                                            <li data-value="{{ $ms_education->name }}" data-id="{{ $ms_education->id }}">{{ $ms_education->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="emerging_topic_data" name="emerging_topic[]" multiple="multiple"></select>
                                                    </div>
                                                </div>
                                                <span id="reqemrtopic" class="reqError text-danger valley"></span>
                                                <div class="emerging_topic_div">
                                                    <?php
                                                    $i = 0;
                                                    ?>
                                                    @if(!empty($emr_data1))
                                                    @foreach($emr_data1 as $emr_data)

                                                    <?php
                                                    $first_word = strtok($emr_data->emr_edu_id, " ");

                                                    $first_word  = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $first_word));


                                                    // $second_word = strtolower(preg_replace('/[^A-Za-z0-9]/', '', explode(' ', $mid_data->mid_spec_tra_id)[1] ?? ''));

                                                    // // Get the first four characters of the second word
                                                    // $second_word = substr($second_word, 0, 2);

                                                    // $thired_word = strtolower(preg_replace('/[^A-Za-z0-9]/', '', explode(' ', $mid_data->mid_spec_tra_id)[1] ?? ''));

                                                    // // Get the first four characters of the second word
                                                    // $thired_word = substr($thired_word, 0, 4);
                                                    $emr_first_word = $first_word;
                                                    ?>
                                                    <div class="eme_topic_{{ $emr_first_word }} eme_topic_{{ $emr_first_word }}">

                                                        <h6>{{ $emr_data->emr_edu_id }}</h6>
                                                        <div class="eme_topic_div row eme_topic_institution">
                                                            <div class="form-group col-md-12">
                                                                <label class="form-label" for="input-1">Institution/Regulating Body</label>
                                                                <input type="hidden" name="emetopicarr[]" class="eme_topic_input_{{ $emr_data->emr_edu_id }}" value="{{ $emr_data->emr_edu_id }}">
                                                                <input class="form-control eme_topic_institution eme_topic_institution-{{ $i }}" type="text" name="eme_topic_institution[]" value="{{ $emr_data->eme_topic_institution }}">
                                                                <span id="emetopicinstitutionvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Training Start Date</label>
                                                                <input class="form-control eme_topic_start_date eme_topic_start_date-{{ $i }}" type="date" name="eme_topic_start_date[]" value="{{ $emr_data->eme_topic_start_date }}" onkeydown="return false">
                                                                <span id="eme_topic_start_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Training End Date</label>
                                                                <input class="form-control eme_topic_end_date eme_topic_end_date-{{ $i }}" type="date" name="eme_topic_end_date[]" value="{{ $emr_data->eme_topic_end_date }}" onkeydown="return false">
                                                                <span id="eme_topic_end_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Status</label>
                                                                <select class="form-control eme_topic_status eme_topic_status-{{ $i }}" name="eme_topic_status[]">
                                                                    <option value="Completed" @if($emr_data->eme_topic_status == 'Completed') selected @endif>Completed</option>
                                                                    <option value="Ongoing" @if($emr_data->eme_topic_status == 'Ongoing') selected @endif>Ongoing</option>
                                                                    <option value="Pending" @if($emr_data->eme_topic_status == 'Pending') selected @endif>Pending</option>
                                                                </select>
                                                                <span id="eme_topic_statusvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control eme_topic_expiry eme_topic_expiry-{{ $i }}" type="date" name="eme_topic_expiry[]" value="{{ $emr_data->eme_topic_expiry }}">
                                                                <span id="emetopicexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label class="form-label" for="input-1">Upload Certificate</label>
                                                                <input class="form-control emetopic_upload_certification eme_topic_imgs_{{ $emr_first_word }} emetopic_upload_certification-{{ $i }}" type="file" name="emetopic_upload_certification[{{ $i }}][]" onchange="changetraImg1('{{ $user_id }}','{{ $i }}','eme_topic_imgs','{{ $emr_first_word }}')">
                                                                <span id="reqmidspecuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>

                                                                <?php
                                                                $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                                if (!empty($getedufieldsdata)) {
                                                                    $eme_img = (array)json_decode($getedufieldsdata->eme_topic_imgs);
                                                                } else {
                                                                    $eme_img = '';
                                                                }


                                                                if (!empty($eme_img)) {
                                                                    $eme_img_data = json_decode($eme_img[$emr_first_word]);
                                                                } else {
                                                                    $eme_img_data = "";
                                                                }
                                                                //print_r($acls_img[$acls_first_word_one]);


                                                                //print_r($dtran_img);
                                                                $l = 1;
                                                                $user_id = $user_id;
                                                                ?>
                                                                <div class="eme_topic_imgs{{ $emr_first_word }}">
                                                                    @if(!empty($eme_img_data))
                                                                    @foreach($eme_img_data as $eme_img)
                                                                    <div class="trans_img trans_img-{{ $i }} trans_imgeme_topic_imgs{{ $emr_first_word }}{{ $i }}">
                                                                        <a href="{{ url('/public/uploads/education_degree') }}/{{ $eme_img }}"><i class="fa fa-file"></i>{{ $eme_img }}</a>
                                                                        <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $i }}','{{ $user_id }}','{{ $eme_img }}','{{ $emr_first_word }}','eme_topic_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                                                    </div>
                                                                    <?php
                                                                    $l++;
                                                                    ?>
                                                                    @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>

                                                <!-- cat-5-->
                                                <div class="col-md-12 mt-3 level-drp mandatory_sub_edu_div  mandatory_sub_edu_div_4 d-none">
                                                    <div class="form-group">
                                                        <input type="hidden" name="safety_data" class="safety_data" value="@if(!empty($trainingData)){{ $safety_data_json }}@endif">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Safety and Compliance Training</strong></label>
                                                        <?php $mandatory_sub_education = DB::table('man_training_category')
                                                            ->where('parent', 443)
                                                            ->where('type', 'Education')
                                                            ->get(); ?>

                                                        <ul id="safety_com_data" style="display:none;">
                                                            @foreach($mandatory_sub_education as $ms_education)
                                                            <li data-value="{{ $ms_education->name }}">{{ $ms_education->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="safety_com_data" name="safety_com[]" multiple="multiple"></select>
                                                    </div>
                                                </div>
                                                <div class="safety_com_div"></div>
                                            </div>
                                            <div class="another_education">
                                                <h6 class="fw-bolder fs-6 d-flex align-items-center  mt-2">Other Continuing Education</h6>
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
                                                        <label class="form-label" for="input-1">Course/Workshop {{ $i }}</label>
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

                                                        $user_id = $user_id;
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
                                                    $user_id = $user_id;
                                                    ?>
                                                    <div class="col-md-12">
                                                        <div class="add_new_cmp_training_div mb-3 mt-3"><a style="cursor: pointer;" onclick="delete_edu('{{ $i }}','{{ $user_id }}','{{ $edu_data->other_edu_id }}')">- Delete Continuing Education</a></div>
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
                                                <input type="checkbox" name="declare_information_man" class="declare_information_man" value="1" @if(!empty($trainingData)) @if($trainingData->declaration_status == 1) checked onclick="return false;" @endif @endif>
                                                <!-- Hidden Input to Ensure Value is Sent -->
                                                @if(!empty($trainingData) && $trainingData->declaration_status == 1)
                                                <input type="hidden" name="declare_information_man" value="1">
                                                @endif
                                                <label for="declare_information">I declare that the information provided is true and correct</label>
                                            </div>
                                            <span id="reqmantradeclare_information" class="reqError text-danger valley"></span>
                                            <div class="d-flex align-items-center justify-content-between mt-3">
                                                <button type="submit" class="btn btn-default next-step-61 align-items-center justify-content-between" data-target="#navpill-7">Next</button>
                                            </div>
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
    var referee_div_count = 1;
    console.log("licence_div_count", referee_div_count);

    function add_another_referee() {
        referee_div_count++;
        $(".reference_form").append('<div class="referee_data referee_data-' + referee_div_count + '"><h6 class="mt-0 color-brand-1 mb-20 referee_no">References ' + referee_div_count + '</h6><div class="row"><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">First name</label><input class="form-control first_name first_name-' + referee_div_count + '" type="text" name="first_name[]"><span id="reqfname-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">Last name</label><input class="form-control last_name last_name-' + referee_div_count + '" type="text" name="last_name[]"><span id="reqlname-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div></div><div class="row"><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">Email</label><input class="form-control reference_email reference_email-' + referee_div_count + '" type="text" name="email[]"><span id="reqemail-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">Phone number</label><input class="form-control phone_no phone_no-' + referee_div_count + '" type="text" name="phone_no[]"><span id="reqphoneno-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div></div><div class="row"><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">Relationship</label><select class="form-control reference_relationship reference_relationship-' + referee_div_count + '" name="reference_relationship[]"><option value="" data-select2-id="9">Select Reference Relationship</option><option value="Brother">Brother</option><option value="Sister">Sister</option><option value="Sister">Cousin</option></select><span id="reqreferencerel-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">You worked together at:</label><input class="form-control worked_together worked_together-' + referee_div_count + '" type="text" name="worked_together[]"><span id="reqworked_together-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div></div><div class="row"><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">What was your position when you worked with this referee?</label><input class="form-control position_with_referee position_with_referee-' + referee_div_count + '" type="text" name="position_with_referee[]"><span id="reqpositionreferee-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div></div><div class="row"><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">Start Date</label><input class="form-control start_date start_date-' + referee_div_count + '" type="date" name="start_date[]" onchange="startDate(' + referee_div_count + ')" onkeydown="return false"><span id="reqrefereesdate-' + referee_div_count + '" class="reqError text-danger valley"></span><div class="declaration_box"><input class="still_working still_working-' + referee_div_count + '" type="checkbox" name="still_working[]" onclick="stillWorking(' + referee_div_count + ')">I am still working with this referee<span id="reqstillworking-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div></div><div class="col-md-6"><div class="form-group level-drp working-' + referee_div_count + '"><label class="form-label" for="input-1">End Date</label><input class="form-control end_date end_date-' + referee_div_count + '" type="date" name="end_date[]" onkeydown="return false"><span id="reqrefereeedate-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div><div class="row"><div class="col-md-6"><div class="add_new_certification_div mb-3 mt-3"><a style="cursor: pointer;" onclick="delete_reference1(' + referee_div_count + ')">- Delete Referee</a></div></div></div></div>');
    }

    function delete_reference1(i) {
        $(".referee_data-" + i).remove();
    }


    var previous_employeers_head = $(".previous_employeers_head").length;

    function add_work_experience() {
        previous_employeers_head++;
        // $(".previous_employeers").append('<h6 class="emergency_text mt-3">Previous Employers '+previous_employeers_head+'</h6><div class="form-group level-drp"><label class="d-flex gap-3 flex-wrap" for="input-1"><strong>Organisation Name</strong></label><input class="form-control" type="text" name="previous_employer_name[]"><span id="reqnames" class="reqError text-danger valley"></span></div><div class="form-group level-drp"><div class="form-group level-drp"><label class="d-flex gap-3 flex-wrap" for="input-1"><strong>Position Held</strong></label><select class="form-control" name="positions_held[]"><option value="">Position Held</option><option value="Team Member">Team Member</option><option value="Team Leader">Team Leader</option><option value="Educator">Educator</option><option value="Manager">Manager</option><option value="Clinical Specialist">Clinical Specialist</option></select><span id="reqpositionheld" class="reqError text-danger valley"></span></div></div><span id="reqpositionheld" class="reqError text-danger valley"></span><div class="col-md-12"><div class="form-group level-drp"><label class="d-flex gap-3 flex-wrap" for="input-1"><strong>Employment Start Date</strong></label><input class="form-control employeement_start_date employeement_start_date-'+previous_employeers_head+'" type="date" name="start_date[]" onchange="changeEmployeementEndDate('+previous_employeers_head+')"><span id="reqempsdate" class="reqError text-danger valley"></span></div></div><div class="col-md-12"><div class="form-group level-drp"><label class="d-flex gap-3 flex-wrap" for="input-1"><strong>Employment End Date</strong></label><input class="form-control employeement_end_date-'+previous_employeers_head+'" type="date" name="end_date[]"><span id="reqemployeementenddate" class="reqError text-danger valley"></span></div><div class="declaration_box mt-3"><input class="declare_information" type="checkbox" name="present_box[]" value="1">I am currently in this position at the moment</div><div class="row"><div class="col-md-12"><div class="form-group level-drp"><label class="d-flex gap-3 flex-wrap" for="input-1">Employment type</label><select class="form-control" name="employeement_type[]"><option value="">Employment type</option><option value="Agency">Agency</option><option value="Staffing Agency">Staffing Agency</option></select><span id="reqemptype" class="reqError text-danger valley"></span></div></div></div><h4 class="emergency_text">Detailed Job Descriptions</h4><div class="form-group level-drp"><label class="d-flex gap-3 flex-wrap" for="input-1">Responsibilities</label><textarea class="form-control" name="job_responeblities[]"></textarea><span id="reqresposiblities" class="reqError text-danger valley"></span></div><div class="form-group level-drp"><label class="d-flex gap-3 flex-wrap" for="input-1">Achievements</label><textarea class="form-control" name="achievements[]"></textarea><span id="reqachievements" class="reqError text-danger valley"></span></div>');
        $(".previous_employeers").append(`
        <h4 class="emergency_text mt-3">Previous Employers ${previous_employeers_head}</h4>
        
        <div class="form-group level-drp mt-3">
            <label class="d-flex gap-3 flex-wrap" for="input-1"><strong>Organisation Name</strong></label>
            <input class="form-control" type="text" name="previous_employer_name[]">
            <span id="reqnames" class="reqError text-danger valley"></span>
        </div>

        <div class="form-group level-drp  mt-3">
            <label class="d-flex gap-3 flex-wrap" for="input-1"><strong>Position Held</strong></label>
            <select class="form-control" name="positions_held[]">
                <option value="">Position Held</option>
                <option value="Team Member">Team Member</option>
                <option value="Team Leader">Team Leader</option>
                <option value="Educator">Educator</option>
                <option value="Manager">Manager</option>
                <option value="Clinical Specialist">Clinical Specialist</option>
            </select>
            <span id="reqpositionheld" class="reqError text-danger valley"></span>
        </div>

        <div class="col-md-12  mt-3">
            <div class="form-group level-drp">
                <label class="d-flex gap-3 flex-wrap" for="input-1"><strong>Employment Start Date</strong></label>
                <input class="form-control employeement_start_date employeement_start_date-${previous_employeers_head}" type="date" name="start_date[]" onchange="changeEmployeementEndDate(${previous_employeers_head})">
                <span id="reqempsdate" class="reqError text-danger valley"></span>
            </div>
        </div>

        <div class="col-md-12  mt-3">
            <div class="form-group level-drp">
                <label class="d-flex gap-3 flex-wrap" for="input-1"><strong>Employment End Date</strong></label>
                <input class="form-control employeement_end_date employeement_end_date-${previous_employeers_head}" type="date" name="end_date[]">
                <span id="reqemployeementenddate" class="reqError text-danger valley"></span>
            </div>
        </div>

        <div class="declaration_box mt-3">
            <input class="declare_information" type="checkbox" name="present_box[]" value="1">I am currently in this position at the moment
        </div>

        <div class="row">
            <div class="col-md-12  mt-3">
                <div class="form-group level-drp">
                    <label class="d-flex gap-3 flex-wrap" for="input-1"><strong>Employment type</strong></label>
                    <select class="form-control" name="employeement_type[]">
                        <option value="">Employment type</option>
                        <option value="Agency">Agency</option>
                        <option value="Staffing Agency">Staffing Agency</option>
                    </select>
                    <span id="reqemptype" class="reqError text-danger valley"></span>
                </div>
            </div>
        </div>

        <h4 class="emergency_text mt-3">Detailed Job Descriptions</h4>

        <div class="form-group level-drp  mt-3">
            <label class="d-flex gap-3 flex-wrap" for="input-1"><strong>Responsibilities</strong></label>
            <textarea class="form-control" name="job_responeblities[]"></textarea>
            <span id="reqresposiblities" class="reqError text-danger valley"></span>
        </div>

        <div class="form-group level-drp mt-3">
            <label class="d-flex gap-3 flex-wrap" for="input-1"><strong>Achievements</strong></label>
            <textarea class="form-control" name="achievements[]"></textarea>
            <span id="reqachievements" class="reqError text-danger valley"></span>
        </div>
    `);

    }
</script>

<script>
    $(document).ready(function() {
        // Get the current query string parameter
        let urlParams = new URLSearchParams(window.location.search);
        let tabParam = urlParams.get('tab');
        // If no tab query string is present, default to tab-1
        if (!tabParam) {
            // Set the first tab as the default
            let defaultTab = 'tab-1';
            // Update the URL to include ?tab=tab-1
            let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + defaultTab;
            history.replaceState(null, null, newUrl);
            // Show the default tab
            $('.nav-link[href="#' + defaultTab + '"]').tab('show');
        } else {
            // If a tab query parameter exists, activate that tab
            $('.nav-link[href="#' + tabParam + '"]').tab('show');
        }
        // Update the URL with the tab ID as a query parameter when a tab is shown
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            let newTab = $(e.target).attr('href').substring(1); // Get tab ID without the #
            let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + newTab;
            history.replaceState(null, null, newUrl);
        });
    });
</script>




<script>
    $(document).ready(function() {

        // Add an additional search box to the dropdown
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
    });
</script>
<script>
    $(document).ready(function() {

        // Add an additional search box and extra buttons to the dropdown
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
    $(document).ready(function() {
        // Mandatory Training and Education
        $('.js-example-basic-multiple[data-list-id="mandatory_courses"]').on('change', function() {
            let selectedValues = $(this).val();

            console.log("selectedValues", selectedValues);
            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
            if (selectedValues.includes("419")) {
                $('.mandatory_tr_div_1').removeClass('d-none');
                // $('.license_number_acls').removeClass('d-none');
            } else {
                $('.mandatory_tr_div_1').addClass('d-none');
                // $('.license_number_acls').addClass('d-none');
                $('.well_self_care_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="well_self_care_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("418")) {
                $('.mandatory_tr_div_2').removeClass('d-none');
                // $('.license_number_bls').removeClass('d-none');
            } else {
                $('.mandatory_tr_div_2').addClass('d-none');
                // $('.license_number_bls').addClass('d-none');
                $('.tech_innvo_health_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="tech_innvo_health_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("417")) {
                $('.mandatory_tr_div_3').removeClass('d-none');
                // $('.license_number_cpr').removeClass('d-none');
            } else {
                $('.mandatory_tr_div_3').addClass('d-none');
                // $('.license_number_cpr').addClass('d-none');
                $('.leader_pro_dev_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="leader_pro_dev_data"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("416")) {
                $('.mandatory_tr_div_4').removeClass('d-none');
                // $('.license_number_nrp').removeClass('d-none');

            } else {
                $('.mandatory_tr_div_4').addClass('d-none');
                // $('.license_number_nrp').addClass('d-none');
                $('.mid_spec_tra_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="mid_spec_tra_data"]').select2().val(null).trigger('change');

            }
            if (selectedValues.includes("415")) {
                $('.mandatory_tr_div_5').removeClass('d-none');
                // $('.license_number_pals').removeClass('d-none');


            } else {
                $('.mandatory_tr_div_5').addClass('d-none');
                // $('.license_number_pals').addClass('d-none'); 
                $('.clinic_skill_core_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="clinic_skill_core_data"]').select2().val(null).trigger('change');
            }

        });

        $('.js-example-basic-multiple[data-list-id="well_self_care_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var well_self_care = [];
            $('.well_self_care_div').removeClass('d-none');
            $(".well_self_care_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    $(".well_self_care_" + res_one).remove();
                }
                well_self_care.push(text);
            });
            console.log("selectedValues", selectedValues);

            // $(".well_self_care_div").empty();

            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                if (well_self_care.includes(selectedValues[i]) == false) {

                    var user_id = "{{ $sessid }}";
                    var img_text = "well_imgs";
                    $(".well_self_care_div").append('<div class="well_self_care_' + res_one + ' well_div_' + selected_text + '"><h6 class="well_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="wellnamearr[]" class="wellness_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="wellness_inst_div row wellness_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control well_institution well_institution-' + i + '" type="text" name="well_institution[]"><span id="wellinstitutionvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control well_tra_start_date well_tra_start_date-' + i + '" type="date" name="well_tra_start_date[]"><span id="well_tra_start_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control well_tra_end_date well_tra_end_date-' + i + '" type="date" name="well_tra_end_date[]"><span id="well_tra_end_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control well_expiry well_expiry-' + i + '" type="date" name="well_expiry[]"><span id="wellexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control well_upload_certification well_imgs_' + res_one + ' well_upload_certification-' + i + '" type="file" name="well_upload_certification[' + i + '][]" onchange="changetraImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><span id="reqwelluploadvalid-' + i + '" class="reqError text-danger valley"></span><div class="well_imgs' + res_one + '"></div></div></div></div>');
                }
            }


        });

        $('.js-example-basic-multiple[data-list-id="tech_innvo_health_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var tech_innvo_health = [];
            $('.tech_innvo_health_div').removeClass('d-none');
            $(".tech_innvo_health_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    $(".tech_innvo_health_" + res_one).remove();
                }
                tech_innvo_health.push(text);
            });
            console.log("selectedValues", selectedValues);

            // $(".tech_innvo_health_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                if (tech_innvo_health.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "tech_innvo_imgs";
                    $(".tech_innvo_health_div").append('<div class="tech_innvo_health_' + res_one + ' tech_innvo_div_' + selected_text + '"><h6 class="tech_innvo_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="techinnvonamearr[]" class="tech_innvo_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="tech_innvo_div row tech_innvo_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control tech_innvo_institution tech_innvo-' + i + '" type="text" name="tech_innvo_institution[]"><span id="techinnvoinstitutionvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control tech_innvo_tra_start_date tech_innvo_tra_start_date-' + i + '" type="date" name="tech_innvo_tra_start_date[]"><span id="tech_innvo_tra_start_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control tech_innvo_tra_end_date tech_innvo_tra_end_date-' + i + '" type="date" name="tech_innvo_tra_end_date[]"><span id="tech_innvo_tra_end_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control tech_innvo_expiry tech_innvo_expiry-' + i + '" type="date" name="tech_innvo_expiry[]"><span id="techinnvoexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control tech_innvo_upload_certification tech_innvo_imgs_' + res_one + ' tech_innvo_upload_certification-' + i + '" type="file" name="tech_innvo_upload_certification[' + i + '][]" onchange="changetraImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><span id="reqtechinnvouploadvalid-' + i + '" class="reqError text-danger valley"></span><div class="tech_innvo_imgs' + res_one + '"></div></div></div></div>');
                }
            }
        });

        $('.js-example-basic-multiple[data-list-id="leader_pro_dev_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var leader_pro_dev = [];
            $('.leader_pro_dev_div').removeClass('d-none');
            $(".leader_pro_dev_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    // alert(text);

                    let res = text.split(' ')[0];

                    let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                    let res_2 = text.split(' ')[1];

                    res_2 = res_2.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                    let chunks = res_2.substring(0, 4);

                    let res_one = res_1 + '_' + chunks;

                    $(".leader_pro_dev_" + res_one).remove();
                }
                leader_pro_dev.push(text);
            });
            console.log("selectedValues", selectedValues);

            // $(".leader_pro_dev_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();

                let res = selectedValues[i].split(' ')[0];

                let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                let res_2 = selectedValues[i].split(' ')[1];

                res_2 = res_2.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                let chunks = res_2.substring(0, 4);

                let res_one = res_1 + '_' + chunks;

                if (leader_pro_dev.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "leader_pro_imgs";
                    $(".leader_pro_dev_div").append('<div class="leader_pro_dev_' + res_one + ' leader_pro_div_' + selected_text + '"><h6 class="leader_pro_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="leaderpronamearr[]" class="leader_pro_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="leader_pro_div row leader_pro_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control leader_pro_institution leader_pro-' + i + '" type="text" name="leader_pro_institution[]"><span id="leaderproinstivalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control leader_pro_tra_start_date leader_pro_tra_start_date-' + i + '" type="date" name="leader_pro_tra_start_date[]"><span id="leader_pro_tra_start_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control leader_pro_tra_end_date leader_pro_tra_end_date-' + i + '" type="date" name="leader_pro_tra_end_date[]"><span id="leader_pro_tra_end_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control leader_pro_expiry leader_pro_expiry-' + i + '" type="date" name="leader_pro_expiry[]"><span id="leaderproexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control leader_pro_upload_certification leader_pro_imgs_' + res_one + ' leader_pro_upload_certification-' + i + '" type="file" name="leader_pro_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><span id="reqleaderprouploadvalid-' + i + '" class="reqError text-danger valley"></span><div class="leader_pro_imgs' + res_one + '"></div></div></div></div>');
                }
            }
        });

        $('.js-example-basic-multiple[data-list-id="mid_spec_tra_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var mid_spec_tra = [];
            $('.mid_spec_tra_div').removeClass('d-none');
            $(".mid_spec_tra_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                    let res_2 = text.split(' ')[1];
                    res_2 = res_2.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    res_2 = res_2.substring(0, 2);

                    let res_3 = text.split(' ')[1];
                    res_3 = res_3.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    res_3 = res_3.substring(0, 4)

                    let res_one = res_1 + '_' + res_2 + '_' + res_3;

                    $(".mid_spec_tra_" + res_one).remove();
                }
                mid_spec_tra.push(text);
            });
            console.log("selectedValues", selectedValues);

            // $(".mid_spec_tra_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();


                let res_2 = selectedValues[i].split(' ')[1];
                res_2 = res_2.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                res_2 = res_2.substring(0, 2);

                let res_3 = selectedValues[i].split(' ')[1];
                res_3 = res_3.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                res_3 = res_3.substring(0, 4)

                let res_one = res_1 + '_' + res_2 + '_' + res_3;

                if (mid_spec_tra.includes(selectedValues[i]) == false) {

                    var user_id = "{{ $sessid }}";
                    var img_text = "mid_spec_imgs";
                    $(".mid_spec_tra_div").append('<div class="mid_spec_tra_' + res_one + ' mid_spec_div_' + selected_text + '"><h6 class="mid_spec_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="midspecnamearr[]" class="mid_spec_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="mid_spec_div row mid_spec_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control mid_spec_institution mid_spec-' + i + '" type="text" name="mid_spec_institution[]"><span id="midspecinstivalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control mid_spec_tra_start_date mid_spec_tra_start_date-' + i + '" type="date" name="mid_spec_tra_start_date[]"><span id="mid_spec_tra_start_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control mid_spec_tra_end_date mid_spec_tra_end_date-' + i + '" type="date" name="mid_spec_tra_end_date[]"><span id="mid_spec_tra_end_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control mid_spec_expiry mid_spec_expiry-' + i + '" type="date" name="mid_spec_expiry[]"><span id="midspecexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control mid_spec_upload_certification mid_spec_imgs_' + res_one + ' mid_spec_upload_certification-' + i + '" type="file" name="mid_spec_upload_certification[' + i + '][]" onchange="changetraImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><span id="reqmidspecuploadvalid-' + i + '" class="reqError text-danger valley"></span><div class="mid_spec_imgs' + res_one + '"></div></div></div></div>');
                }
            }
        });

        $('.js-example-basic-multiple[data-list-id="clinic_skill_core_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var clinic_skill_core = [];
            let selectedIds = [];
            let selectedDataIds = [];


            selectedValues.forEach(function(value) {
                // Use jQuery to find the <li> element by its text and get the data-value
                let dataId = $('#clinic_skill_core_data li').filter(function() {
                    return $(this).text() === value;
                }).data('id');

                // Add the found dataId to the selectedIds array if it exists
                if (dataId !== undefined) {
                    selectedIds.push(dataId);
                }
            });

            $('.clinic_skill_core_div').removeClass('d-none');
            $(".clinic_skill_core_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    // console.log("res_one",res_one);

                    // Find the corresponding dataId for the text from the list
                    let dataId = $('#clinic_skill_core_data li').filter(function() {
                        return $(this).text() === text;
                    }).data('id'); // Get the associated data-id

                    let res_one = res_1 + '_' + dataId;

                    $(".clinic_skill_" + res_one).remove();
                }
                clinic_skill_core.push(text);
            });
            console.log("selectedValues", selectedValues);

            // $(".clinic_skill_core_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                // Get the corresponding selectedId
                let selectedId = selectedIds[i];

                let res_one = res_1 + '_' + selectedId;

                if (clinic_skill_core.includes(selectedValues[i]) == false) {

                    var user_id = "{{ $sessid }}";
                    var img_text = "clinic_skill_imgs";
                    $(".clinic_skill_core_div").append('<div class="clinic_skill_' + res_one + ' clinic_skill_div_' + selected_text + '"><h6 class="clinic_skill_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="clinicskillnamearr[]" class="clinic_skill_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="clinic_skill_div row clinic_skill_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control clinic_skill_institution clinic_skill-' + i + '" type="text" name="clinic_skill_institution[]"><span id="cliskillinstivalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control clinic_skill_tra_start_date clinic_skill_tra_start_date-' + i + '" type="date" name="clinic_skill_tra_start_date[]"><span id="clinic_skill_tra_start_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control clinic_skill_tra_end_date clinic_skill_tra_end_date-' + i + '" type="date" name="clinic_skill_tra_end_date[]"><span id="clinic_skill_tra_end_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control clinic_skill_expiry clinic_skill_expiry-' + i + '" type="date" name="clinic_skill_expiry[]"><span id="clinicskillexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control clinic_skill_upload_certification clinic_skill_imgs_' + res_one + ' clinic_skill_upload_certification-' + i + '" type="file" name="clinic_skill_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><span id="reqclinskilluploadvalid-' + i + '" class="reqError text-danger valley"></span><div class="clinic_skill_imgs' + res_one + '"></div></div></div></div>');
                }
            }
        });

        $('.js-example-basic-multiple[data-list-id="mandatory_education"]').on('change', function() {
            let selectedValues = $(this).val();
            console.log("selectedValues", selectedValues);
            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
            if (selectedValues.includes("440")) {
                $('.mandatory_sub_edu_div_1').removeClass('d-none');
                // $('.license_number_acls').removeClass('d-none');
            } else {
                $('.mandatory_sub_edu_div_1').addClass('d-none');
                // $('.license_number_acls').addClass('d-none');
                $('.core_man_con_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="core_man_con_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("441")) {
                $('.mandatory_sub_edu_div_2').removeClass('d-none');
                // $('.license_number_bls').removeClass('d-none');
            } else {
                $('.mandatory_sub_edu_div_2').addClass('d-none');
                // $('.license_number_bls').addClass('d-none');
                $('.mid_spe_mandotry_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="mid_spe_mandotry_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("442")) {
                $('.mandatory_sub_edu_div_3').removeClass('d-none');
                // $('.license_number_cpr').removeClass('d-none');
            } else {
                $('.mandatory_sub_edu_div_3').addClass('d-none');
                // $('.license_number_cpr').addClass('d-none');
                $('.spec_area_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="spec_area_data"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("443")) {
                $('.mandatory_sub_edu_div_4').removeClass('d-none');
                // $('.license_number_nrp').removeClass('d-none');
            } else {
                $('.mandatory_sub_edu_div_4').addClass('d-none');
                // $('.license_number_nrp').addClass('d-none');
                $('.safety_com_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="safety_com_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("444")) {
                $('.mandatory_sub_edu_div_5').removeClass('d-none');
                // $('.license_number_pals').removeClass('d-none'); 
            } else {
                $('.mandatory_sub_edu_div_5').addClass('d-none');
                // $('.license_number_pals').addClass('d-none'); 
                $('.emerging_topic_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="emerging_topic_data"]').select2().val(null).trigger('change');
            }

        });

        $('.js-example-basic-multiple[data-list-id="core_man_con_data"]').on('change', function() {
            let selectedValues = $(this).val();
            let selectedIds = [];
            let selectedDataIds = [];


            selectedValues.forEach(function(value) {
                // Use jQuery to find the <li> element by its text and get the data-value
                let dataId = $('#core_man_con_data li').filter(function() {
                    return $(this).text() === value;
                }).data('id');

                // Add the found dataId to the selectedIds array if it exists
                if (dataId !== undefined) {
                    selectedIds.push(dataId);
                }
            });
            var core_man_con_data = [];
            $('.core_man_con_data_div').removeClass('d-none');
            $(".core_man_con_data_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    // console.log("res_one",res_one);
                    // Find the corresponding dataId for the text from the list
                    let dataId = $('#core_man_con_data li').filter(function() {
                        return $(this).text() === text;
                    }).data('id'); // Get the associated data-id

                    let res_one = res_1 + '_' + dataId;

                    $(".core_man_" + res_one).remove();
                }
                core_man_con_data.push(text);
            });
            console.log("selectedValues", selectedValues);

            // $(".core_man_con_data_div").empty();

            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                let selectedId = selectedIds[i];
                let res_one = res_1 + '_' + selectedId;

                if (core_man_con_data.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "core_man_imgs";

                    // $(".core_man_con_data_div").append('<div class="core_man_'+res_one+' core_man_'+selected_text+'"><h6 class="core_man_head_'+selected_text+'">'+selectedValues[i]+'</h6><input type="hidden" name="coremanarr[]" class="coreman_input_'+selectedValues[i]+'" value="'+selectedValues[i]+'"><div class="core_man_div row core_man_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control core_man_institution core_man_institution-'+i+'" type="text" name="core_man_institution[]"><span id="coreinstitutionvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Start Date</label><input class="form-control coreman_start_date coreman_start_date-'+i+'" type="date" name="coreman_start_date[]"><span id="coreman_start_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">End Date</label><input class="form-control coreman_end_date coreman_end_date-'+i+'" type="date" name="coreman_end_date[]"><span id="coreman_end_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control well_expiry well_expiry-'+i+'" type="date" name="well_expiry[]"><span id="wellexpiryvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control well_upload_certification well_imgs_'+res_one+' well_upload_certification-'+i+'" type="file" name="well_upload_certification['+i+'][]" onchange="changeImg1('+user_id+','+i+',\''+img_text+'\',\''+res_one+'\')" multiple><span id="reqwelluploadvalid-'+i+'" class="reqError text-danger valley"></span><div class="well_imgs'+res_one+'"></div></div></div></div>');
                    $(".core_man_con_data_div").append(`
              <div class="core_man_${res_one} core_man_${selected_text}">
                  <h6 class="core_man_head_${selected_text}">${selectedValues[i]}</h6>
                  <input type="hidden" name="coremanarr[]" class="coreman_input_${selectedValues[i]}" value="${selectedValues[i]}">
                  
                  <div class="core_man_div row core_man_institution">
                      <!-- Institution/Regulating Body -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Institution/Regulating Body</label>
                          <input class="form-control core_man_institution core_man_institution-${i}" type="text" name="core_man_institution[]">
                          <span id="coreinstitutionvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Start Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Start Date</label>
                          <input class="form-control coreman_start_date coreman_start_date-${i}" type="date" name="coreman_start_date[]">
                          <span id="coreman_start_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- End Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">End Date</label>
                          <input class="form-control coreman_end_date coreman_end_date-${i}" type="date" name="coreman_end_date[]">
                          <span id="coreman_end_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Status -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Status</label>
                          <select class="form-control coreman_status coreman_status-${i}" name="coreman_status[]">
                              <option value="Completed">Completed</option>
                              <option value="Ongoing">Ongoing</option>
                              <option value="Pending">Pending</option>
                          </select>
                          <span id="coreman_statusvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Expiry -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Expiry</label>
                          <input class="form-control core_man_expiry core_man_expiry-${i}" type="date" name="core_man_expiry[]">
                          <span id="coremanexpiryvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Upload Certificate/Licence -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Upload Certificate/Licence</label>
                          <input class="form-control coreman_upload_certification core_man_imgs_${res_one} coreman_upload_certification-${i}" 
                                type="file" name="coreman_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                          <span id="reqcoremanuploadvalid-${i}" class="reqError text-danger valley"></span>
                          <div class="core_man_imgs${res_one}"></div>
                      </div>
                  </div>
              </div>
          `);
                }
            }


        });

        $('.js-example-basic-multiple[data-list-id="mid_spe_mandotry_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var mid_spe_mandotry_data = [];
            $('.mid_spe_mandotry_div').removeClass('d-none');
            $(".mid_spe_mandotry_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);
                    $(".mid_spe_" + res_one).remove();
                }
                mid_spe_mandotry_data.push(text);
            });
            console.log("selectedValues", selectedValues);

            // $(".mid_spe_mandotry_div").empty();

            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                if (mid_spe_mandotry_data.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "mid_spe_imgs";
                    $(".mid_spe_mandotry_div").append(`
              <div class="mid_spe_${res_one} mid_spe_${selected_text}">
                  <h6 class="mid_spe_head_${selected_text}">${selectedValues[i]}</h6>
                  <input type="hidden" name="midspearr[]" class="midspe_input_${selectedValues[i]}" value="${selectedValues[i]}">
                  
                  <div class="mid_spe_div row mid_spe_institution">
                      <!-- Institution/Regulating Body -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Institution/Regulating Body</label>
                          <input class="form-control mid_spe_institution mid_spe_institution-${i}" type="text" name="mid_spe_institution[]">
                          <span id="midspeinstitutionvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Start Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Start Date</label>
                          <input class="form-control mid_spe_start_date mid_spe_start_date-${i}" type="date" name="mid_spe_start_date[]">
                          <span id="mid_spe_start_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- End Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">End Date</label>
                          <input class="form-control mid_spe_end_date coreman_end_date-${i}" type="date" name="mid_spe_end_date[]">
                          <span id="mid_spe_end_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Status -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Status</label>
                          <select class="form-control mid_spe_status mid_spe_status-${i}" name="mid_spe_status[]">
                              <option value="Completed">Completed</option>
                              <option value="Ongoing">Ongoing</option>
                              <option value="Pending">Pending</option>
                          </select>
                          <span id="mid_spe_statusvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Expiry -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Expiry</label>
                          <input class="form-control mid_spe_expiry mid_spe_expiry-${i}" type="date" name="mid_spe_expiry[]">
                          <span id="midspeexpiryvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Upload Certificate/Licence -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Upload Certificate/Licence</label>
                          <input class="form-control midspe_upload_certification mid_spe_imgs_${res_one} midspe_upload_certification-${i}" 
                                type="file" name="midspe_upload_certification[${i}][]" 
                                onchange="changetraImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                          <span id="reqmidspeuploadvalid-${i}" class="reqError text-danger valley"></span>
                          <div class="mid_spe_imgs${res_one}"></div>
                      </div>
                  </div>
              </div>
          `);
                }
            }
        });

        $('.js-example-basic-multiple[data-list-id="spec_area_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var spec_area_data = [];

            // Hide and clear unnecessary elements
            $('.spec_area_div').removeClass('d-none');
            $(".spec_area_div h6").each(function() {
                var text = $(this).text();
                if (!selectedValues.includes(text)) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    $(".spec_area_" + res_one).remove();
                }
                spec_area_data.push(text);
            });

            console.log("selectedValues", selectedValues);

            // Accumulate HTML in a variable
            var newContent = "";

            // Loop through selected values and generate the necessary fields
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                console.log("res_one", res_one);

                if (spec_area_data.indexOf(selectedValues[i]) === -1) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "spec_area_imgs";

                    // Append HTML content for this selection
                    newContent += `
                <div class="spec_area_${res_one} spec_area_${selected_text}">
                    <h6 class="mid_spe_head_${selected_text}">${selectedValues[i]}</h6>
                    <input type="hidden" name="specareaarr[]" class="spec_area_input_${selectedValues[i]}" value="${selectedValues[i]}">
                    
                    <div class="spec_area_div row spec_area_institution">
                        <!-- Institution/Regulating Body -->
                        <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Institution/Regulating Body</label>
                            <input class="form-control spec_area_institution spec_area_institution-${i}" type="text" name="spec_area_institution[]">
                            <span id="specareainstitutionvalid-${i}" class="reqError text-danger valley"></span>
                        </div>

                        <!-- Start Date -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Start Date</label>
                            <input class="form-control spec_area_start_date spec_area_start_date-${i}" type="date" name="spec_area_start_date[]">
                            <span id="spec_area_start_datevalid-${i}" class="reqError text-danger valley"></span>
                        </div>

                        <!-- End Date -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">End Date</label>
                            <input class="form-control spec_area_end_date spec_area_end_date-${i}" type="date" name="spec_area_end_date[]">
                            <span id="spec_area_end_datevalid-${i}" class="reqError text-danger valley"></span>
                        </div>

                        <!-- Status -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Status</label>
                            <select class="form-control spec_area_status spec_area_status-${i}" name="spec_area_status[]">
                                <option value="Completed">Completed</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Pending">Pending</option>
                            </select>
                            <span id="spec_area_statusvalid-${i}" class="reqError text-danger valley"></span>
                        </div>

                        <!-- Expiry -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Expiry</label>
                            <input class="form-control spec_area_expiry spec_area_expiry-${i}" type="date" name="spec_area_expiry[]">
                            <span id="specareaexpiryvalid-${i}" class="reqError text-danger valley"></span>
                        </div>

                        <!-- Upload Certificate/Licence -->
                        <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Upload Certificate/Licence</label>
                            <input class="form-control specarea__upload_certification spec_area_imgs_${res_one} specarea_upload_certification-${i}" 
                                type="file" name="specarea_upload_certification[${i}][]" 
                                onchange="changetraImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                            <span id="reqspecarea uploadvalid-${i}" class="reqError text-danger valley"></span>
                            <div class="spec_area_imgs${res_one}"></div>
                        </div>
                    </div>
                </div>`;
                }
            }

            // Append all new content at once
            $(".spec_area_div").append(newContent);
        });


        $('.js-example-basic-multiple[data-list-id="safety_com_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var safety_com_data = [];
            $('.safety_com_div').removeClass('d-none');
            $(".safety_com_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);
                    $(".safety_com_" + res_one).remove();
                }
                safety_com_data.push(text);
            });
            console.log("selectedValues", selectedValues);

            // $(".safety_com_div").empty();

            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                if (safety_com_data.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "safety_com_imgs";
                    $(".safety_com_div").append(`
              <div class="safety_com_${res_one} safety_com_${selected_text}">
                  <h6 class="safety_com_head_${selected_text}">${selectedValues[i]}</h6>
                  <input type="hidden" name="safetycomaarr[]" class="safety_com_input_${selectedValues[i]}" value="${selectedValues[i]}">
                  
                  <div class="safety_com_div row safety_com_institution">
                      <!-- Institution/Regulating Body -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Institution/Regulating Body</label>
                          <input class="form-control safety_com_institution safety_com_institution-${i}" type="text" name="safety_com_institution[]">
                          <span id="safetycominstitutionvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Start Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Start Date</label>
                          <input class="form-control safety_com_start_date safety_com_start_date-${i}" type="date" name="safety_com_start_date[]">
                          <span id="safety_com_start_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- End Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">End Date</label>
                          <input class="form-control safety_com_end_date safety_com_end_date-${i}" type="date" name="safety_com_end_date[]">
                          <span id="safety_com_end_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Status -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Status</label>
                          <select class="form-control safety_com_status safety_com_status-${i}" name="safety_com_status[]">
                              <option value="Completed">Completed</option>
                              <option value="Ongoing">Ongoing</option>
                              <option value="Pending">Pending</option>
                          </select>
                          <span id="safety_com_statusvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Expiry -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Expiry</label>
                          <input class="form-control safety_com_expiry safety_com_expiry-${i}" type="date" name="safety_com_expiry[]">
                          <span id="safetycomexpiryvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Upload Certificate/Licence -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Upload Certificate/Licence</label>
                          <input class="form-control safetycome_upload_certification safety_com_imgs_${res_one} safetycome_upload_certification-${i}" 
                                type="file" name="safetycome_upload_certification[${i}][]" 
                                onchange="changetraImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                          <span id="reqsafetycome uploadvalid-${i}" class="reqError text-danger valley"></span>
                          <div class="safety_com_imgs${res_one}"></div>
                      </div>
                  </div>
              </div>
          `);


                }
            }
        });

        $('.js-example-basic-multiple[data-list-id="emerging_topic_data"]').on('change', function() {
            let selectedValues = $(this).val();
            //     let selectedIds = [];
            //      let selectedDataIds = [];


            //    selectedValues.forEach(function(value) {
            //         // Use jQuery to find the <li> element by its text and get the data-value
            //         let dataId = $('#emerging_topic_data li').filter(function() {
            //             return $(this).text() === value;
            //         }).data('id');

            //         // Add the found dataId to the selectedIds array if it exists
            //         if (dataId !== undefined) {
            //             selectedIds.push(dataId);
            //         }
            //     });

            var emerging_topic_data = [];
            $('.emerging_topic_div').removeClass('d-none');
            $(".emerging_topic_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    // Find the corresponding dataId for the text from the list
                    // let dataId = $('#emerging_topic_data li').filter(function() {
                    //     return $(this).text() === text;
                    // }).data('id');  // Get the associated data-id

                    // let res_one = res_1 + '_' +dataId;

                    $(".eme_topic_" + res_one).remove();
                }
                emerging_topic_data.push(text);
            });
            console.log("selectedValues", selectedValues);

            // $(".emerging_topic_div").empty();

            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                //   let selectedId = selectedIds[i];

                //   let res_one = res_1+'_'+selectedId;

                if (emerging_topic_data.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "eme_topic_imgs";
                    $(".emerging_topic_div").append(`
              <div class="eme_topic_${res_one} eme_topic_${selected_text}">
                  <h6 class="eme_topic_head_${selected_text}">${selectedValues[i]}</h6>
                  <input type="hidden" name="emetopicarr[]" class="eme_topic_input_${selectedValues[i]}" value="${selectedValues[i]}">
                  
                  <div class="eme_topic_div row eme_topic_institution">
                      <!-- Institution/Regulating Body -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Institution/Regulating Body</label>
                          <input class="form-control eme_topic_institution eme_topic_institution-${i}" type="text" name="eme_topic_institution[]">
                          <span id="emetopicinstitutionvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Start Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Start Date</label>
                          <input class="form-control eme_topic_start_date eme_topic_start_date-${i}" type="date" name="eme_topic_start_date[]">
                          <span id="eme_topic_start_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- End Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">End Date</label>
                          <input class="form-control eme_topic_end_date eme_topic_end_date-${i}" type="date" name="eme_topic_end_date[]">
                          <span id="eme_topic_end_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Status -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Status</label>
                          <select class="form-control eme_topic_status eme_topic_status-${i}" name="eme_topic_status[]">
                              <option value="Completed">Completed</option>
                              <option value="Ongoing">Ongoing</option>
                              <option value="Pending">Pending</option>
                          </select>
                          <span id="eme_topic_statusvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Expiry -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Expiry</label>
                          <input class="form-control eme_topic_expiry eme_topic_expiry-${i}" type="date" name="eme_topic_expiry[]">
                          <span id="emetopicexpiryvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Upload Certificate/Licence -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Upload Certificate/Licence</label>
                          <input class="form-control emetopic_upload_certification eme_topic_imgs_${res_one} emetopic_upload_certification-${i}" 
                                type="file" name="emetopic_upload_certification[${i}][]" 
                                onchange="changetraImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                          <span id="reqemetopic uploadvalid-${i}" class="reqError text-danger valley"></span>
                          <div class="eme_topic_imgs${res_one}"></div>
                      </div>
                  </div>
              </div>
          `);


                }
            }
        });

        if ($(".man_training").val() != "") {

            var man_training = JSON.parse($(".man_training").val());
            $('.js-example-basic-multiple[data-list-id="mandatory_courses"]').select2().val(man_training).trigger('change');
        }

        if ($(".man_education").val() != "") {
            var man_education = JSON.parse($(".man_education").val());
            $('.js-example-basic-multiple[data-list-id="mandatory_education"]').select2().val(man_education).trigger('change');
        }
        if ($(".emr_data").val() != "") {
            var emr_data = JSON.parse($(".emr_data").val());
            $('.js-example-basic-multiple[data-list-id="emerging_topic_data"]').select2().val(emr_data).trigger('change');
        }
        if ($(".safety_data").val() != "") {
            var safety_data = JSON.parse($(".safety_data").val());
            //console.log(safety_data);
            $('.js-example-basic-multiple[data-list-id="safety_com_data"]').select2().val(safety_data).trigger('change');
        }

        if ($(".well_sel_data").val() != "") {
            var well_data = JSON.parse($(".well_sel_data").val());
            $('.js-example-basic-multiple[data-list-id="well_self_care_data"]').select2().val(well_data).trigger('change');
        }

        if ($(".tech_innvo_data").val() != "") {
            var tech_data = JSON.parse($(".tech_innvo_data").val());
            $('.js-example-basic-multiple[data-list-id="tech_innvo_health_data"]').select2().val(tech_data).trigger('change');
        }

        if ($(".lead_data").val() != "") {
            var lead_data = JSON.parse($(".lead_data").val());
            $('.js-example-basic-multiple[data-list-id="leader_pro_dev_data"]').select2().val(lead_data).trigger('change');
        }

        if ($(".mid_data1").val() != "") {
            var mid_data = JSON.parse($(".mid_data1").val());
            $('.js-example-basic-multiple[data-list-id="mid_spec_tra_data"]').select2().val(mid_data).trigger('change');
        }

        if ($(".cli_data").val() != "") {
            var cli_data = JSON.parse($(".cli_data").val());
            $('.js-example-basic-multiple[data-list-id="clinic_skill_core_data"]').select2().val(cli_data).trigger('change');
        }

        if ($(".spec_area_data").val() != "") {
            var spec_area_data = JSON.parse($(".spec_area_data").val());
            $('.js-example-basic-multiple[data-list-id="spec_area_data"]').select2().val(spec_area_data).trigger('change');
        }

        if ($(".mid_spe_data").val() != "") {
            var mid_spe_data = JSON.parse($(".mid_spe_data").val());
            $('.js-example-basic-multiple[data-list-id="mid_spe_mandotry_data"]').select2().val(mid_spe_data).trigger('change');
        }



    });

    $('#man_tra_form').on('submit', function(event) {
        event.preventDefault();
        var targetTab = $('#man_tra_form').data('target');
        var new_user_id = $('#new_user_id').val();
        // Function to enable the next tab

        var isValid = true;

        if ($('[name="mandatory_courses[]"]').val() == '') {
            document.getElementById("reqmantra").innerHTML = "*Please Select training";
            isValid = false;
        }
        if ($(".mandatory_tr_div_1").hasClass("d-none") == false) {
            if ($('[name="well_self_care_data[]"]').val() == '') {
                document.getElementById("reqwellself").innerHTML = "* Please Select Wellness And Self-Care";
                isValid = false;
            }
        }
        var i = 0;
        $(".well_institution").each(function() {
            if ($(".well_institution-" + i).length > 0) {
                if ($(".well_institution-" + i).val() == '') {
                    document.getElementById("wellinstitutionvalid-" + i).innerHTML = "* Please enter the institution/regulating body";
                    isValid = false;
                }
            }
            i++;
        });

        var j = 0;
        $(".well_institution").each(function() {
            if ($(".well_institution-" + j).length > 0) {
                if ($(".well_institution-" + j).val() == '') {
                    document.getElementById("wellinstitutionvalid-" + j).innerHTML = "* Please enter the institution/regulating body";
                    isValid = false;
                }
            }
            j++;
        });
        var k = 0;
        $(".well_tra_start_date").each(function() {
            if ($(".well_tra_start_date-" + k).length > 0) {
                if ($(".well_tra_start_date-" + k).val() == '') {
                    document.getElementById("well_tra_start_datevalid-" + k).innerHTML = "* Please enter the training start date";
                    isValid = false;
                }
            }
            k++;
        });
        var l = 0;
        $(".well_tra_end_date").each(function() {
            if ($(".well_tra_end_date-" + l).length > 0) {
                if ($(".well_tra_end_date-" + l).val() == '') {
                    document.getElementById("well_tra_end_datevalid-" + l).innerHTML = "* Please enter the training end date";
                    isValid = false;
                }
            }
            l++;
        });
        var m = 0;
        $(".well_expiry").each(function() {
            if ($(".well_expiry-" + m).length > 0) {
                if ($(".well_expiry-" + m).val() == '') {
                    document.getElementById("wellexpiryvalid-" + m).innerHTML = "* Please enter the expiry date";
                    isValid = false;
                }
            }
            m++;
        });
        if ($(".mandatory_tr_div_2").hasClass("d-none") == false) {
            if ($('[name="tech_innvo_health[]"]').val() == '') {
                document.getElementById("reqtechinno").innerHTML = "* Please Select Technology and Innovation in Healthcare";
                isValid = false;
            }
        }

        var i = 0;
        $(".tech_innvo_institution").each(function() {
            if ($(".tech_innvo-" + i).length > 0) {
                if ($(".tech_innvo-" + i).val() == '') {
                    document.getElementById("techinnvoinstitutionvalid-" + i).innerHTML = "* Please enter the institution/regulating body";
                    isValid = false;
                }
            }
            i++;
        });

        var k = 0;
        $(".tech_innvo_tra_start_date").each(function() {
            if ($(".tech_innvo_tra_start_date-" + k).length > 0) {
                if ($(".tech_innvo_tra_start_date-" + k).val() == '') {
                    document.getElementById("tech_innvo_tra_start_datevalid-" + k).innerHTML = "* Please enter the training start date";
                    isValid = false;
                }
            }
            k++;
        });
        var l = 0;
        $(".tech_innvo_tra_end_date").each(function() {
            if ($(".tech_innvo_tra_end_date-" + l).length > 0) {
                if ($(".tech_innvo_tra_end_date-" + l).val() == '') {
                    document.getElementById("tech_innvo_tra_end_datevalid-" + l).innerHTML = "* Please enter the training end date";
                    isValid = false;
                }
            }
            l++;
        });
        var m = 0;
        $(".tech_innvo_expiry ").each(function() {
            if ($(".tech_innvo_expiry-" + m).length > 0) {
                if ($(".tech_innvo_expiry-" + m).val() == '') {
                    document.getElementById("wellexpiryvalid-" + m).innerHTML = "* Please enter the expiry date";
                    isValid = false;
                }
            }
            m++;
        });

        if ($(".mandatory_tr_div_3").hasClass("d-none") == false) {
            if ($('[name="leader_pro_dev_data[]"]').val() == '') {
                document.getElementById("reqeaderpro").innerHTML = "*Please Select Leadership and Professional Development";
                isValid = false;
            }
        }
        var i = 0;
        $(".leader_pro_institution").each(function() {
            if ($(".leader_pro-" + i).length > 0) {
                if ($(".leader_pro-" + i).val() == '') {
                    document.getElementById("leaderproinstivalid-" + i).innerHTML = "* Please enter the institution/regulating body";
                    isValid = false;
                }
            }
            i++;
        });


        var k = 0;
        $(".leader_pro_tra_start_date ").each(function() {
            if ($(".leader_pro_tra_start_date-" + k).length > 0) {
                if ($(".leader_pro_tra_start_date-" + k).val() == '') {
                    document.getElementById("leader_pro_tra_start_datevalid-" + k).innerHTML = "* Please enter the training start date";
                    isValid = false;
                }
            }
            k++;
        });
        var l = 0;
        $(".leader_pro_tra_end_date ").each(function() {
            if ($(".leader_pro_tra_end_date-" + l).length > 0) {
                if ($(".leader_pro_tra_end_date-" + l).val() == '') {
                    document.getElementById("leader_pro_tra_end_datevalid-" + l).innerHTML = "* Please enter the training end date";
                    isValid = false;
                }
            }
            l++;
        });
        var m = 0;
        $(".leader_pro_expiry").each(function() {
            if ($(".leader_pro_expiry-" + m).length > 0) {
                if ($(".leader_pro_expiry-" + m).val() == '') {
                    document.getElementById("leaderproexpiryvalid-" + m).innerHTML = "* Please enter the expiry date";
                    isValid = false;
                }
            }
            m++;
        });
        if ($(".mandatory_tr_div_4").hasClass("d-none") == false) {
            if ($('[name="mid_spec_tra_data[]"]').val() == '') {
                document.getElementById("reqmidwifespe").innerHTML = "*Please Select Midwifery-Specific Training";
                isValid = false;
            }
        }
        var i = 0;
        $(".mid_spec_institution").each(function() {
            if ($(".mid_spec-0-" + i).length > 0) {
                if ($(".lmid_spec-0-" + i).val() == '') {
                    document.getElementById("midspecinstivalid-" + i).innerHTML = "* Please enter the institution/regulating body";
                    isValid = false;
                }
            }
            i++;
        });


        var k = 0;
        $(".mid_spec_tra_start_date ").each(function() {
            if ($(".mid_spec_tra_start_date-" + k).length > 0) {
                if ($(".mid_spec_tra_start_date-" + k).val() == '') {
                    document.getElementById("mid_spec_tra_start_datevalid-" + k).innerHTML = "* Please enter the training start date";
                    isValid = false;
                }
            }
            k++;
        });
        var l = 0;
        $(".mid_spec_tra_end_date ").each(function() {
            if ($(".mid_spec_tra_end_date-" + l).length > 0) {
                if ($(".mid_spec_tra_end_date-" + l).val() == '') {
                    document.getElementById("mid_spec_tra_end_datevalid-" + l).innerHTML = "* Please enter the training end date";
                    isValid = false;
                }
            }
            l++;
        });
        var m = 0;
        $(".mid_spec_expiry").each(function() {
            if ($(".mid_spec_expiry-" + m).length > 0) {
                if ($(".mid_spec_expiry-" + m).val() == '') {
                    document.getElementById("midspecexpiryvalid-" + m).innerHTML = "* Please enter the expiry date";
                    isValid = false;
                }
            }
            m++;
        });
        if ($(".mandatory_tr_div_5").hasClass("d-none") == false) {
            if ($('[name="clinic_skill_core_data[]"]').val() == '') {
                document.getElementById("reqcliniskill").innerHTML = "*Please Select Clinical Skills and Core Competencies";
                isValid = false;
            }
        }

        var i = 0;
        $(".clinic_skill_institution").each(function() {
            if ($(".clinic_skill-0-" + i).length > 0) {
                if ($(".clinic_skill-0-" + i).val() == '') {
                    document.getElementById("cliskillinstivalid-" + i).innerHTML = "* Please enter the institution/regulating body";
                    isValid = false;
                }
            }
            i++;
        });


        var k = 0;
        $(".clinic_skill_tra_start_date ").each(function() {
            if ($(".clinic_skill_tra_start_date-" + k).length > 0) {
                if ($(".clinic_skill_tra_start_date-" + k).val() == '') {
                    document.getElementById("clinic_skill_tra_start_datevalid-" + k).innerHTML = "* Please enter the training start date";
                    isValid = false;
                }
            }
            k++;
        });
        var l = 0;
        $(".clinic_skill_tra_end_date ").each(function() {
            if ($(".clinic_skill_tra_end_date-" + l).length > 0) {
                if ($(".clinic_skill_tra_end_date-" + l).val() == '') {
                    document.getElementById("clinic_skill_tra_end_datevalid-" + l).innerHTML = "* Please enter the training end date";
                    isValid = false;
                }
            }
            l++;
        });
        var m = 0;
        $(".clinic_skill_expiry").each(function() {
            if ($(".clinic_skill_expiry-" + m).length > 0) {
                if ($(".clinic_skill_expiry-" + m).val() == '') {
                    document.getElementById("clinicskillexpiryvalid-" + m).innerHTML = "* Please enter the expiry date";
                    isValid = false;
                }
            }
            m++;
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

        if ($('[name="mandatory_education[]"]').val() == '') {
            document.getElementById("reqmanedu").innerHTML = "*Please Select continuing education";
            isValid = false;
        }

        if ($(".mandatory_sub_edu_div_5").hasClass("d-none") == false) {
            if ($('[name="emerging_topic[]"]').val() == '') {
                document.getElementById("reqemrtopic").innerHTML = "* Please Select Emerging Topics and Continuing Education";
                isValid = false;
            }
        }

        var i = 0;
        $(".well_institution").each(function() {
            if ($(".well_institution-" + i).length > 0) {
                if ($(".well_institution-" + i).val() == '') {
                    document.getElementById("wellinstitutionvalid-" + i).innerHTML = "* Please enter the institution/regulating body";
                    isValid = false;
                }
            }
            i++;
        });

        var j = 0;
        $(".eme_topic_institution ").each(function() {
            if ($(".eme_topic_institution-" + j).length > 0) {
                if ($(".eme_topic_institution-" + j).val() == '') {
                    document.getElementById("emetopicinstitutionvalid-" + j).innerHTML = "* Please enter the institution/regulating body";
                    isValid = false;
                }
            }
            j++;
        });
        var k = 0;
        $(".eme_topic_start_date").each(function() {
            if ($(".eme_topic_start_date-" + k).length > 0) {
                if ($(".eme_topic_start_date-" + k).val() == '') {
                    document.getElementById("eme_topic_start_datevalid-" + k).innerHTML = "* Please enter the start date";
                    isValid = false;
                }
            }
            k++;
        });
        var l = 0;
        $(".eme_topic_end_date").each(function() {
            if ($(".eme_topic_end_date-" + l).length > 0) {
                if ($(".eme_topic_end_date-" + l).val() == '') {
                    document.getElementById("eme_topic_end_datevalid-" + l).innerHTML = "* Please enter the end date";
                    isValid = false;
                }
            }
            l++;
        });

        var m = 0;
        $(".eme_topic_expiry").each(function() {
            if ($(".eme_topic_expiry-" + m).length > 0) {
                if ($(".eme_topic_expiry-" + m).val() == '') {
                    document.getElementById("emetopicexpiryvalid-" + m).innerHTML = "* Please enter the expiry date";
                    isValid = false;
                }
            }
            m++;
        });
        var n = 0;
        $(".eme_topic_status").each(function() {
            if ($(".eme_topic_status-" + n).length > 0) {
                if ($(".eme_topic_status-" + n).val() == '') {
                    document.getElementById("eme_topic_statusvalid-" + n).innerHTML = "* Please select status";
                    isValid = false;
                }
            }
            n++;
        });


        var j = 0;
        $(".safety_com_institution ").each(function() {
            if ($(".safety_com_institution-" + j).length > 0) {
                if ($(".safety_com_institution-" + j).val() == '') {
                    document.getElementById("safetycominstitutionvalid-" + j).innerHTML = "* Please enter the institution/regulating body";
                    isValid = false;
                }
            }
            j++;
        });
        var k = 0;
        $(".safety_com_start_date").each(function() {
            if ($(".safety_com_start_date-" + k).length > 0) {
                if ($(".safety_com_start_date-" + k).val() == '') {
                    document.getElementById("safety_com_start_datevalid-" + k).innerHTML = "* Please enter the start date";
                    isValid = false;
                }
            }
            k++;
        });
        var l = 0;
        $(".safety_com_end_date").each(function() {
            if ($(".safety_com_end_date-" + l).length > 0) {
                if ($(".safety_com_end_date-" + l).val() == '') {
                    document.getElementById("safety_com_end_datevalid-" + l).innerHTML = "* Please enter the end date";
                    isValid = false;
                }
            }
            l++;
        });

        var m = 0;
        $(".safety_com_expiry").each(function() {
            if ($(".safety_com_expiry-" + m).length > 0) {
                if ($(".safety_com_expiry-" + m).val() == '') {
                    document.getElementById("safetycomexpiryvalid-" + m).innerHTML = "* Please enter the expiry date";
                    isValid = false;
                }
            }
            m++;
        });
        var n = 0;
        $(".safety_com_status").each(function() {
            if ($(".safety_com_status-" + n).length > 0) {
                if ($(".safety_com_status-" + n).val() == '') {
                    document.getElementById("safety_com_statusvalid-" + n).innerHTML = "* Please select status";
                    isValid = false;
                }
            }
            n++;
        });

        var j = 0;
        $(".mid_spe_institution").each(function() {
            if ($(".mid_spe_institution-" + j).length > 0) {
                if ($(".mid_spe_institution-" + j).val() == '') {
                    document.getElementById("midspeinstitutionvalid-" + j).innerHTML = "* Please enter the institution/regulating body";
                    isValid = false;
                }
            }
            j++;
        });
        var k = 0;
        $(".mid_spe_start_date").each(function() {
            if ($(".mid_spe_start_date-" + k).length > 0) {
                if ($(".mid_spe_start_date-" + k).val() == '') {
                    document.getElementById("mid_spe_start_datevalid-" + k).innerHTML = "* Please enter the start date";
                    isValid = false;
                }
            }
            k++;
        });
        var l = 0;
        $(".mid_spe_end_date").each(function() {
            if ($(".mid_spe_end_date-" + l).length > 0) {
                if ($(".mid_spe_end_date-" + l).val() == '') {
                    document.getElementById("mid_spe_end_datevalid-" + l).innerHTML = "* Please enter the end date";
                    isValid = false;
                }
            }
            l++;
        });

        var m = 0;
        $(".mid_spe_expiry").each(function() {
            if ($(".mid_spe_expiry-" + m).length > 0) {
                if ($(".mid_spe_expiry-" + m).val() == '') {
                    document.getElementById("midspeexpiryvalid-" + m).innerHTML = "* Please enter the expiry date";
                    isValid = false;
                }
            }
            m++;
        });
        var n = 0;
        $(".mid_spe_status").each(function() {
            if ($(".mid_spe_status-" + n).length > 0) {
                if ($(".mid_spe_status-" + n).val() == '') {
                    document.getElementById("mid_spe_statusvalid-" + n).innerHTML = "* Please select status";
                    isValid = false;
                }
            }
            n++;
        });


        var j = 0;
        $(".spec_area_institution ").each(function() {
            if ($(".spec_area_institution-" + j).length > 0) {
                if ($(".spec_area_institution-" + j).val() == '') {
                    document.getElementById("specareainstitutionvalid-" + j).innerHTML = "* Please enter the institution/regulating body";
                    isValid = false;
                }
            }
            j++;
        });
        var k = 0;
        $(".spec_area_start_date").each(function() {
            if ($(".spec_area_start_date-" + k).length > 0) {
                if ($(".spec_area_start_date-" + k).val() == '') {
                    document.getElementById("spec_area_start_datevalid-" + k).innerHTML = "* Please enter the start date";
                    isValid = false;
                }
            }
            k++;
        });
        var l = 0;
        $(".spec_area_end_date").each(function() {
            if ($(".spec_area_end_date-" + l).length > 0) {
                if ($(".spec_area_end_date-" + l).val() == '') {
                    document.getElementById("spec_area_end_datevalid-" + l).innerHTML = "* Please enter the end date";
                    isValid = false;
                }
            }
            l++;
        });

        var m = 0;
        $(".spec_area_status").each(function() {
            if ($(".spec_area_status-" + m).length > 0) {
                if ($(".spec_area_status-" + m).val() == '') {
                    document.getElementById("spec_area_statusvalid-" + m).innerHTML = "*Please select status ";
                    isValid = false;
                }
            }
            m++;
        });
        var n = 0;
        $(".spec_area_expiry").each(function() {
            if ($(".spec_area_expiry-" + n).length > 0) {
                if ($(".spec_area_expiry-" + n).val() == '') {
                    document.getElementById("specareaexpiryvalid-" + n).innerHTML = "*Please enter the expiry date";
                    isValid = false;
                }
            }
            n++;
        });


        var j = 0;
        $(".core_man_institution ").each(function() {
            if ($(".core_man_institution-" + j).length > 0) {
                if ($(".core_man_institution-" + j).val() == '') {
                    document.getElementById("coreinstitutionvalid-" + j).innerHTML = "* Please enter the institution/regulating body";
                    isValid = false;
                }
            }
            j++;
        });
        var k = 0;
        $(".coreman_start_date").each(function() {
            if ($(".coreman_start_date-" + k).length > 0) {
                if ($(".coreman_start_date-" + k).val() == '') {
                    document.getElementById("coreman_start_datevalid-" + k).innerHTML = "* Please enter the start date";
                    isValid = false;
                }
            }
            k++;
        });
        var l = 0;
        $(".coreman_end_date").each(function() {
            if ($(".coreman_end_date-" + l).length > 0) {
                if ($(".coreman_end_date-" + l).val() == '') {
                    document.getElementById("coreman_end_datevalid-" + l).innerHTML = "* Please enter the end date";
                    isValid = false;
                }
            }
            l++;
        });

        var m = 0;
        $(".coreman_status").each(function() {
            if ($(".coreman_status-" + m).length > 0) {
                if ($(".coreman_status-" + m).val() == '') {
                    document.getElementById("coreman_statusvalid-" + m).innerHTML = "*Please select status";
                    isValid = false;
                }
            }
            m++;
        });
        var n = 0;
        $(".core_man_expiry ").each(function() {
            if ($(".core_man_expiry-" + n).length > 0) {
                if ($(".core_man_expiry-" + n).val() == '') {
                    document.getElementById("coremanexpiryvalid-" + n).innerHTML = "*Please enter the expiry date";
                    isValid = false;
                }
            }
            n++;
        });

        if ($(".declare_information_man").prop('checked') == false) {
            document.getElementById("reqmantradeclare_information").innerHTML = "* Please check this checkbox";
            isValid = false;
        }

        if (isValid == true) {
            var formdata = new FormData($('#man_tra_form')[0]);
            // var formdata = new FormData($('#man_tra_form')[0]);

            // // Log the FormData entries for debugging
            // for (var pair of formdata.entries()) {
            //     console.log(pair[0] + ': ' + pair[1]); // Logs each key-value pair
            // }
            $.ajax({
                url: "{{ route('admin.man-tr-data') }}",
                type: "POST",
                data: formdata,
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
                            if (new_user_id != "") {
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
                error: function(error) {}
            });

        }

    });
</script>
@include('admin.script');

@endsection