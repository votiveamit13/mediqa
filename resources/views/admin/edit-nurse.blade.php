@extends('admin.layouts.layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

    .trans_img {
        margin-bottom: 5px;
        display: flex;
    }

    .trans_img i.fa {
        position: relative;
        left: 0px;
        font-size: 14px;
        line-height: 25px;
        margin-right: 5px;
        color: #000000;
    }

    .trans_img .close_btn i {
        margin-left: 10px;
        line-height: 22px;
    }

    .badge {
        display: inline-block;
        padding: .35em .65em;
        font-size: .75em;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25rem;
    }

    .btn-warning {
        color: #000;
        background-color: #ffc107;
        border-color: #ffc107;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

<div class="container-fluid">
    <div class="back_arrow" onclick="history.back()" title="Go Back">
        <i class="fa fa-arrow-left"></i>
    </div>
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Edit Nurse</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted " href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Edit Nurse</li>
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
            @include("admin.layouts.edit_nurse_tabs")
            {{-- <form method="post" enctype="multipart/form-data" id="AddNurse"> --}}
            <!-- Tab panes -->
            <div class="tab-content border mt-2">
                <div class="tab-pane p-3 active show" id="tab-1" role="tabpanel">
                    <div class="row">
                        <div class=" w-100  overflow-hidden">
                            <div class="card-body p-3 px-md-4 pb-0">
                                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Basic Details</h3>
                            </div>
                            <div class="card-body p-3 px-md-4">
                                <div class="col-md-12">
                                    <div class="row">
                                        <input type="hidden" value="{{isset($profileData->id)? $profileData->id : ''}}" id="nurse_id">
                                        <div class="upload-pic">
                                            <div class="mt-35 mb-40 box-info-profie d-flex align-items-center upload_image">

                                                <div class="image-profile">
                                                    <img alt="" id="profileImage" style="object-fit: cover; border-radius: 16px; display: block; width: 85px; height: 85px;"
                                                        src="{{ isset($profileData->profile_img) ? asset($profileData->profile_img) : asset('assets/admin/dist/images/profile/nurse06.png') }}">
                                                    <div class="position-relative overflow-hidden">
                                                        <a class="btn btn-apply" id="uploadeditButton">Upload Avatar</a>
                                                        <input type="file" name="profile_image" id="update_profile_image" class="position-absolute h-100" accept="image/*" style="top: 0;left: 0;opacity: 0;cursor: pointer;">
                                                        <i class="fa fa-spinner fa-spin" id="preloadeer-active" style="display:none" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <span id="profile_image_error" class="text-danger valley"></span>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>First Name</strong></label>
                                                <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" value="{{isset($profileData->name)? $profileData->name : ''}}">
                                                <span id="first_name_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Last Name</strong></label>
                                                <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" value="{{isset($profileData->lastname)? $profileData->lastname : ''}}">
                                                <span id="last_name_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Email Address</strong></label>
                                                <input type="text" class="form-control" placeholder="Email Address" name="email" id="email" value="{{isset($profileData->email )? $profileData->email  : ''}}">
                                                <span id="email_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3 phone--drpdwns">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Phone Number</strong></label>
                                                <input type="hidden" value="" name="country_code" id="country_code_phone">
                                                <input type="hidden" value="" name="country_name" id="country_name_phone">
                                                <input type="hidden" value="" name="country_iso" id="country_iso_phone" value="{{isset($profileData->country_iso )? $profileData->country_iso  : ''}}">
                                                <input class="form-control numbers" type="tel" required="" name="contact" id="contact" placeholder="1234567890" placeholder="1234567890" maxlength="10" pattern="[0-9]{4}" style="width:" value="{{isset($profileData->phone )? $profileData->phone  : ''}}">
                                                <span id="contact_error" class="text-danger valley"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Date of Birth</strong></label>
                                                <input type="date" class="form-control" placeholder="Date of Birth" name="dob" id="dob" value="{{isset($profileData->date_of_birth )? $profileData->date_of_birth  : ''}}">
                                                <span id="date_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="gender" class="d-flex gap-3 flex-wrap"><strong>Gender</strong></label>
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male" @if($profileData->gender == "Male") checked @endif>
                                                        <label class="form-check-label" for="genderMale">
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female" @if($profileData->gender == "Female") checked @endif>
                                                        <label class="form-check-label" for="genderFemale">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>
                                                <span id="genderErr" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Nationality</strong></label>
                                                <select name="nationality" class="form-control form-select ps-5" id="nationality">
                                                    <option value="">Select Nationality</option>
                                                    @php $country_data=country_name_from_db();@endphp
                                                    @foreach ($country_data as $data)
                                                    <option value="{{ $data->id }}" <?= isset($profileData->nationality) &&  $profileData->nationality == $data->id ? 'selected' : '' ?>>{{ $data->nationality }}</option>
                                                    @endforeach
                                                </select>
                                                <span id="nationality_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Personal website</strong></label>
                                                <input class="form-control" type="url" required="" name="per_website" id="per_website" placeholder="Personal website" value="{{isset($profileData->personal_website )? $profileData->personal_website  : ''}}">
                                                <span id="per_website_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Country</strong></label>
                                                <select class="form-control form-select ps-5" name="country" id="countryI">
                                                    <option value="">Select Country</option>
                                                    @php $country_data=country_name_from_db();@endphp
                                                    @foreach ($country_data as $data)
                                                    <option value="{{$data->iso2}}" <?= isset($profileData->country) &&  $profileData->country == $data->iso2 ? 'selected' : '' ?>> {{$data->name}} </option>
                                                    @endforeach
                                                </select>
                                                <span id="country_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>State</strong></label>
                                                <select class="form-control form-select ps-5" name="state" id="stateI" id="stateI">
                                                    @php
                                                    if(isset( $profileData->country)){
                                                    $state_data = state_list();
                                                    }else{
                                                    $state_data = '';
                                                    }
                                                    @endphp

                                                    @if(isset($state_data) && !empty($state_data))
                                                    @foreach ($state_data as $data_state)
                                                    <option value="{{$data_state->id}}" <?= isset($profileData->state) &&  $profileData->state  == $data_state->id ? 'selected' : '' ?>> {{$data_state->name}} </option>
                                                    @endforeach
                                                    @endif

                                                </select>
                                                <span id="state_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>City</strong></label>
                                                <input class="form-control" type="text" required="" name="city" id="city" placeholder="City" value="{{isset($profileData->city )? $profileData->city  : ''}}">
                                                <span id="city_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Zip code</strong></label>
                                                <input class="form-control" type="text" required="" name="zip_code" id="zip_code" placeholder="Zip code" value="{{isset($profileData->post_code )? $profileData->post_code  : ''}}">
                                                <span id="zip_code_error" class="text-danger valley"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Home Address</strong></label>
                                                <input class="form-control" type="text" required="" name="home_address" id="home_address" placeholder="Home Address" value="{{isset($profileData->home_address )? $profileData->home_address  : ''}}">
                                                <span id="home_address_error" class="text-danger valley"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Password</strong></label>
                                                <input class="form-control" type="password" required="" name="password" id="passwordI" placeholder="">
                                                <span id="reqTxtpasswordI" class="reqError valley text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Confirm Password *</strong></label>
                                                <input class="form-control" type="password" required="" id="confirm_passwordI" name="confirm_password" placeholder="">
                                                <span id="reqTxtconfirm_passwordI" class="reqError valley text-danger"></span>
                                            </div>
                                        </div>

                                        <h4 class="mt-3">Emergency Contact Information</h4>
                                        <div class="col-md-6 mt-3 phone--drpdwns">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Mobile No</strong></label>
                                                <input type="hidden" value="" name="emr_county_code" id="country_code_mobile" value="{{isset($profileData->emegency_country_code )? $profileData->emegency_country_code  : ''}}">
                                                <input type="hidden" value="" name="emr_country_name" id="country_name_mobile">
                                                <input type="hidden" value="" name="emr_country_iso" id="country_iso_mobile" value="{{isset($profileData->emergency_country_iso )? $profileData->emergency_country_iso  : ''}}">
                                                <input class="form-control numbers" type="tel" required="" name="emrg_contact" id="emrg_contact" placeholder="1234567890" placeholder="1234567890" maxlength="10" pattern="[0-9]{4}" style="width: " value="{{isset($profileData->emergency_conact_numeber )? $profileData->emergency_conact_numeber  : ''}}">
                                                <span id="emrg_contact_error" class="text-danger valley"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Email</strong></label>
                                                <input type="text" class="form-control" id="emrg_email" name="emrg_email" placeholder="Email" value="{{isset($profileData->emergergency_contact_email )? $profileData->emergergency_contact_email  : ''}}">
                                                <span id="emrg_email_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <button type="button" class="btn btn-default edit-form-1 align-items-center justify-content-between" data-target="#tab-1">Save</button>
                                    </div>
                                </div>

                                {{-- <div class="mt-3">
                                        <!-- PROGRESSBAR START -->
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100">12%</div>
                                        </div>
                                        <!-- PROGRESSBAR END -->
                                    </div> --}}

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane p-3" id="tab-2" role="tabpanel">
                    <div class="row">
                        <div class=" w-100  overflow-hidden">
                            <div class="card-body p-3 px-md-4 pb-0">
                                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Setting</h3>
                            </div>
                            <div class="card-body p-3 px-md-4">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" id="visibleToMedicalFacilities" name="medical_facilities" id="medical_facilities" {{ $profileData->medical_facilities=='Yes' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="visibleToMedicalFacilities">
                                                    Visible to Healthcare Facilities
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" id="visibleToAgencies" name="agencies" {{ $profileData->agencies =='Yes'? 'checked' : '' }}>
                                                <label class="form-check-label" for="visibleToAgencies">
                                                    Visible to Agencies
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" id="visibleToIndividuals" name="individuals" {{ $profileData->individuals =='Yes'? 'checked' : '' }}>
                                                <label class="form-check-label" for="visibleToAgencies">
                                                    Visible to Individuals (Nurse care at home)
                                                </label>
                                            </div>
                                        </div>

                                        <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Profile Status:</h4>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <input class="form-check-input" type="radio" value="1" id="availableNow" name="profile_status" @if($profileData->profile_status1 == '1') checked @endif >
                                                <label class="form-check-label" for="availableNow">
                                                    Available Now
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <input class="form-check-input" type="radio" value="0" id="unavailableNow" name="profile_status" @if($profileData->profile_status1 == '0') checked @endif>
                                                <label class="form-check-label" for="unavailableNow">
                                                    Unavailable for now
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3 available_date_field d-none">
                                            <div class="form-group">
                                                <label for="gender" class="d-flex gap-3 flex-wrap"><strong>When are you able to start?</strong></label>
                                                <input type="date" name="available_date" class="form-control" value="{{ $profileData->available_date }}">
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <button type="button" class="btn btn-default edit-form-2 align-items-center justify-content-between" data-target="#tab-2">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane p-3" id="tab-3" role="tabpanel">
                    <div class="row">
                        <div class=" w-100  overflow-hidden">
                            <div class="card-body p-3 px-md-4 pb-0">
                                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Profession
                                </h3>
                            </div>
                            <div class="card-body p-3 px-md-4">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <input type="hidden" name="user_id" class="user_id" value="{{ $profileData->id }}">
                                                <input type="hidden" name="ntype" class="ntype" value="{{$profileData->nurseType }}">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Type of Nurse</strong></label>
                                                <ul id="type-of-nurse" style="display:none;">
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
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="type-of-nurse" name="states[]" multiple="multiple" id="nurse_type"></select>
                                                <span id="type_nurse_error" class="text-danger valley"></span>
                                            </div>
                                        </div>

                                        @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                                        <?php
                                        $i = 1;
                                        ?>
                                        @foreach($specialty as $spl)
                                        <?php
                                        $nursing_data = DB::table("practitioner_type")->where('parent', $spl->id)->get();

                                        ?>
                                        <input type="hidden" name="nursing_result_one" class="nursing_result_one" value="{{ $profileData->entry_level_nursing }}">
                                        <input type="hidden" name="nursing_result_two" class="nursing_result_two" value="{{ $profileData->registered_nurses }}">
                                        <input type="hidden" name="nursing_result_three" class="nursing_result_three" value="{{ $profileData->advanced_practioner }}">
                                        <input type="hidden" name="np_result" class="np_result" value="{{ $profileData->nurse_prac }}">
                                        <input type="hidden" name="specialties_result" class="specialties_result" value="{{ $profileData->specialties }}">
                                        <input type="hidden" name="adults_result" class="adults_result" value="{{ $profileData->adults }}">
                                        <input type="hidden" name="maternity_result" class="maternity_result" value="{{ $profileData->maternity }}">
                                        <input type="hidden" name="padneonatal_result" class="padneonatal_result" value="{{ $profileData->paediatrics_neonatal }}">
                                        <input type="hidden" name="community_result" class="community_result" value="{{ $profileData->community }}">
                                        <input type="hidden" name="surgical_preoperative_result" class="surgical_preoperative_result" value="{{ $profileData->surgical_preoperative }}">
                                        <input type="hidden" name="operatingroom_result" class="operatingroom_result" value="{{ $profileData->operating_room }}">
                                        <input type="hidden" name="operatingscout_result" class="operatingscout_result" value="{{ $profileData->operating_room_scout }}">
                                        <input type="hidden" name="operatingscrub_result" class="operatingscrub_result" value="{{ $profileData->operating_room_scrub }}">
                                        <input type="hidden" name="surgical_ob_result" class="surgical_ob_result" value="{{ $profileData->surgical_obstrics_gynacology }}">
                                        <input type="hidden" name="neonatal_care_result" class="neonatal_care_result" value="{{ $profileData->neonatal_care }}">
                                        <input type="hidden" name="paedia_surgical_result" class="paedia_surgical_result" value="{{ $profileData->paedia_surgical_preoperative }}">
                                        <input type="hidden" name="pad_op_room_result" class="pad_op_room_result" value="{{ $profileData->pad_op_room }}">
                                        <input type="hidden" name="pad_qr_scout_result" class="pad_qr_scout_result" value="{{ $profileData->pad_qr_scout }}">
                                        <input type="hidden" name="pad_qr_scrub_result" class="pad_qr_scrub_result" value="{{ $profileData->pad_qr_scrub }}">
                                        <input type="hidden" name="nurse_degree" class="nurse_degree" value="{{ $profileData->degree }}">
                                        <div class="">
                                            <input type="hidden" name="nursing_result" class="nursing_result-{{ $i }}" value="{{ $spl->id }}">
                                            <div class="form-group d-none col-md-12 mt-3" id="nursing_level-{{ $i }}">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>{{ $spl->name }}</strong></label>
                                                <ul id="nursing_entry-{{ $i }}" style="display:none;">
                                                    @foreach($nursing_data as $nd)
                                                    <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                                    @endforeach
                                                    <!-- Add more list items as needed -->
                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nursing_entry-{{ $i }}" name="states[]" multiple="multiple"></select>
                                                <span id="photo_id" class="text-danger valley"></span>
                                            </div>
                                            <?php
                                            $i++;
                                            ?>
                                        </div>
                                        @endforeach
                                        <div class="">
                                            <div class="form-group col-md-12 mt-3 np_submenu d-none">
                                                <?php
                                                $np_data = DB::table("practitioner_type")->where('parent', '179')->get();
                                                ?>
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Nurse Practitioner (NP):</strong></label>
                                                <ul id="nurse_practitioner_menu" style="display:none;">
                                                    @foreach($np_data as $nd)
                                                    <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                                    @endforeach

                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nurse_practitioner_menu" name="nurse_practitioner_menu[]" multiple="multiple"></select>
                                                <span id="photo_id" class="text-danger valley"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <input type="hidden" name="sub_speciality_value" class="sub_speciality_value" value="">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Specialties :</strong></label>
                                                <ul id="specialties" style="display:none;">
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
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="specialties" name="specialties[]" multiple="multiple"></select>
                                                <span id="specialties_error" class="text-danger valley"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3  result--show speciality_boxes">
                                            <?php
                                            $l = 1;
                                            ?>
                                            @foreach($JobSpecialties as $ptl)
                                            <?php
                                            $speciality_data = DB::table("speciality")->where('parent', $ptl->id)->get();
                                            ?>
                                            <input type="hidden" name="speciality_result" class="speciality_result-{{ $l }}" value="{{ $ptl->id }}">
                                            <div class="speciality_data form-group d-none drpdown-set drp--clr" id="specility_level-{{ $l }}">

                                                <label class="form-label" for="input-2">{{ $ptl->name }}</label>
                                                <ul id="speciality_entry-{{ $l }}" style="display:none;">
                                                    @foreach($speciality_data as $sd)
                                                    <li data-value="{{ $sd->id }}">{{ $sd->name }}</li>

                                                    @endforeach
                                                    <!-- Add more list items as needed -->
                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="speciality_entry-{{ $l }}" name="speciality_entry_{{ $l }}[]" multiple="multiple"></select>
                                            </div>
                                            <?php
                                            $l++;
                                            ?>
                                            @endforeach
                                        </div>

                                        <div class="surgical_div">

                                            <div class="surgical_row_data form-group d-none drp--clr col-md-12 mt-3">

                                                <label class="form-label" for="input-2">Surgical Preoperative and Postoperative Care:</label>
                                                <?php
                                                $speciality_surgicalrow_data = DB::table("speciality")->where('parent', '96')->get();
                                                $r = 1;
                                                ?>
                                                <ul id="surgical_row_box" style="display:none;">
                                                    @foreach($speciality_surgicalrow_data as $ssrd)
                                                    <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                                                    @endforeach
                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_row_box" name="surgical_row_box[]" multiple="multiple"></select>
                                            </div>
                                        </div>

                                        <div class="specialty_sub_boxes">

                                            <?php
                                            $speciality_surgical_data = DB::table("speciality")->where('parent', '96')->get();
                                            $w = 1;
                                            ?>
                                            @foreach($speciality_surgical_data as $ssd)
                                            <input type="hidden" name="speciality_result" class="speciality_surgical_result-{{ $w }}" value="{{ $ssd->id }}">
                                            <div class="col-md-12 mt-3 surgical_row surgical_row-{{ $w }} form-group d-none drp--clr">
                                                <label class="form-label" for="input-1">{{ $ssd->name }}</label>
                                                <?php
                                                $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->get();
                                                ?>
                                                <ul id="surgical_operative_care-{{ $w }}" style="display:none;">
                                                    @foreach($speciality_surgicalsub_data as $sssd)
                                                    <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                                                    @endforeach
                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_operative_care-{{ $w }}" name="surgical_operative_care_{{ $w }}[]" multiple="multiple"></select>
                                            </div>
                                            <?php
                                            $w++;
                                            ?>
                                            @endforeach
                                        </div>

                                        <div class="paediatric_surgical_div">
                                            <div class="col-md-12 mt-3 surgicalpad_row_data form-group drp--clr d-none">
                                                <input type="hidden" name="sub_speciality_value" class="sub_speciality_value" value="">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Paediatric Surgical Preop. and Postop. Care :</strong></label>
                                                <?php
                                                $speciality_padsurgicalrow_data = DB::table("speciality")->where('parent', '285')->get();
                                                $r = 1;
                                                ?>
                                                <ul id="surgical_rowpad_box" style="display:none;">
                                                    @foreach($speciality_padsurgicalrow_data as $ssrd)
                                                    <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                                                    @endforeach
                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_rowpad_box" name="surgical_rowpad_box[]" multiple="multiple"></select>
                                            </div>
                                        </div>

                                        <?php
                                        $speciality_surgical_datamater = DB::table("speciality")->where('parent', '250')->get();
                                        ?>
                                        <div class="">
                                            <div class="col-md-12 mt-3 d-none neonatal_row drp--clr drpdown-set form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Neonatal Care :</strong></label>
                                                <ul id="neonatal_care" style="display:none;">
                                                    @foreach($speciality_surgical_datamater as $ssd)
                                                    <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                                    @endforeach
                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="neonatal_care" name="neonatal_care[]" multiple="multiple"></select>
                                            </div>
                                        </div>

                                        <?php
                                        $speciality_surgical_datamater = DB::table("speciality")->where('parent', '233')->get();
                                        $p = 1;
                                        ?>
                                        <div class="">
                                            <div class="col-md-12 mt-3 d-none surgicalobs_row drp--clr drpdown-set form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Surgical Obstetrics and Gynecology (OB/GYN) :</strong></label>
                                                <ul id="surgical_obs_care" style="display:none;">
                                                    @foreach($speciality_surgical_datamater as $ssd)
                                                    <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                                    @endforeach
                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_obs_care" name="surgical_obs_care[]" multiple="multiple"></select>
                                            </div>
                                        </div>

                                        <?php
                                        $speciality_surgical_datap = DB::table("speciality")->where('parent', '285')->get();
                                        $q = 1;
                                        ?>
                                        @foreach($speciality_surgical_datap as $ssd)
                                        <input type="hidden" name="speciality_result" class="surgical_rowp_result-{{ $q }}" value="{{ $ssd->id }}">
                                        <div class="">
                                            <div class="col-md-12 mt-3 surgical_rowp surgical_rowp-{{ $q }} drp--clr drpdown-set form-group drp--clr drpdown-set d-none">
                                                <label class="form-label" for="input-1">{{ $ssd->name }}</label>
                                                <?php
                                                $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->orderBy('name')->get();
                                                ?>
                                                <ul id="surgical_operative_carep-{{ $q }}" style="display:none;">
                                                    @foreach($speciality_surgicalsub_data as $sssd)
                                                    <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                                                    @endforeach
                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_operative_carep-{{ $q }}" name="surgical_operative_carep_{{ $q }}[]" multiple="multiple"></select>
                                            </div>
                                        </div>
                                        <?php
                                        $q++;
                                        ?>
                                        @endforeach

                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>What is your level of experience?</strong></label>
                                                <select class="form-control mr-10 select-active" name="assistent_level" id="assistent_level">
                                                    @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}" @if($profileData->assistent_level == $i) selected @endif>{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                                                        @endfor
                                                </select>
                                                <span id="experience_error" class="text-danger valley"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Current Employment Status</strong></label>
                                                <select class="form-control mr-10 select-active" name="employee_status" id="employee_status">
                                                    <option value="">Select Employee Status</option>
                                                    <option value="Permanent Full-Time" @if($profileData->current_employee_status == "Permanent Full-Time") selected @endif>Permanent Full-Time</option>
                                                    <option value="Permanent Part-Time" @if($profileData->current_employee_status == "Permanent Part-Time") selected @endif>Permanent Part-Time</option>
                                                    <option value="Temporary / Contract" @if($profileData->current_employee_status == "Temporary / Contract") selected @endif>Temporary / Contract</option>
                                                    <option value="Travel" @if($profileData->current_employee_status == "Travel") selected @endif>Travel</option>
                                                    <option value="Per Diem / Local" @if($profileData->current_employee_status == "Per Diem / Local") selected @endif>Per Diem / Local</option>
                                                    <option value="On-Call / PRN (Pro Re Nata)" @if($profileData->current_employee_status == "On-Call / PRN (Pro Re Nata)") selected @endif>On-Call / PRN (Pro Re Nata)</option>
                                                    <option value="Casual" @if($profileData->current_employee_status == "Casual") selected @endif>Casual</option>

                                                    <option value="Agency / Staffing Agency" @if($profileData->current_employee_status == "Agency / Staffing Agency") selected @endif>Agency / Staffing Agency</option>
                                                    <option value="Seasonal" @if($profileData->current_employee_status == "Seasonal") selected @endif>Seasonal</option>
                                                    <option value="Intern / Residency" @if($profileData->current_employee_status == "Intern / Residency") selected @endif>Intern / Residency</option>
                                                    <option value="Self-Employed / Private Practice" @if($profileData->current_employee_status == "Self-Employed / Private Practice") selected @endif>Self-Employed / Private Practice</option>
                                                    <option value="Volunteer" @if($profileData->current_employee_status == "Volunteer") selected @endif>Volunteer</option>
                                                    <option value="Unemployed" @if($profileData->current_employee_status == "Unemployed") selected @endif>Unemployed</option>
                                                </select>
                                                <span id="status_error" class="text-danger valley"></span>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Professional Bio</strong></label>
                                                    <textarea class="form-control" rows="4" name="bio" id="bio">{{ $profileData->bio }}</textarea>
                                                    <span id="bio_error" class="text-danger valley"></span>
                                                </div>
                                            </div>

                                            <div class="declaration_box  mt-3">
                                                <input type="checkbox" name="declare_information" class="declare_information" id="declare_information" @if($profileData->declaration_status == 1) checked @endif>
                                                <label for="declare_information">I declare that the information provided is true and correct</label>
                                                <span id="diclare_error" class="text-danger valley"></span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-3">
                                                <button type="button" class="btn btn-default edit-form-3 align-items-center justify-content-between" data-target="#navpill-4">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane p-3" id="tab-4" role="tabpanel">
                    <form method="POST" id="edit_education_form">
                        @csrf
                        <input type="hidden" value="tab3" name="tab">
                        <input type="hidden" value="{{ $educationData->user_id ?? ""}}" name="user_id">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Education and Certification
                                    </h3>
                                </div>
                                <?php
                                if ($educationData && $educationData->acls_data) {
                                    $acls_data1 = json_decode($educationData->acls_data);
                                    $a_data_arr = array();
                                    foreach ($acls_data1 as $a_data) {
                                        $a_data_arr[] = $a_data->acls_certification_id;
                                    }
                                    $a_data_json = json_encode($a_data_arr);
                                } else {
                                    $acls_data1 = "";
                                    $a_data_json = "";
                                }

                                if ($educationData && $educationData->bls_data) {
                                    $bls_data1 = json_decode($educationData->bls_data);
                                    $b_data_arr = array();
                                    foreach ($bls_data1 as $b_data) {
                                        $b_data_arr[] = $b_data->bls_certification_id;
                                    }
                                    $b_data_json = json_encode($b_data_arr);
                                } else {
                                    $bls_data1 = "";
                                    $b_data_json = "";
                                }

                                if ($educationData && $educationData->cpr_data) {
                                    $cpr_data1 = json_decode($educationData->cpr_data);
                                    $c_data_arr = array();
                                    foreach ($cpr_data1 as $c_data) {
                                        $c_data_arr[] = $c_data->cpr_certification_id;
                                    }
                                    $c_data_json = json_encode($c_data_arr);
                                } else {
                                    $cpr_data1 = "";
                                    $c_data_json = "";
                                }

                                if ($educationData && $educationData->nrp_data) {
                                    $nrp_data1 = json_decode($educationData->nrp_data);
                                    $n_data_arr = array();
                                    foreach ($nrp_data1 as $n_data) {
                                        $n_data_arr[] = $n_data->nrp_certification_id;
                                    }
                                    $n_data_json = json_encode($n_data_arr);
                                } else {
                                    $nrp_data1 = "";
                                    $n_data_json = "";
                                }

                                if ($educationData && $educationData->pals_data) {
                                    $pls_data1 = json_decode($educationData->pals_data);
                                    $p_data_arr = array();
                                    foreach ($pls_data1 as $p_data) {
                                        $p_data_arr[] = $p_data->pls_certification_id;
                                    }
                                    $p_data_json = json_encode($p_data_arr);
                                } else {
                                    $pls_data1 = "";
                                    $p_data_json = "";
                                }

                                if ($educationData && $educationData->rn_data) {
                                    $rn_data1 = json_decode($educationData->rn_data);
                                    $r_data_arr = array();
                                    foreach ($rn_data1 as $r_data) {
                                        $r_data_arr[] = $r_data->rn_certification_id;
                                    }
                                    $r_data_json = json_encode($r_data_arr);
                                } else {
                                    $rn_data1 = "";
                                    $r_data_json = "";
                                }

                                if ($educationData && $educationData->np_data) {
                                    $np_data1 = json_decode($educationData->np_data);
                                    $n_data_arr = array();
                                    foreach ($np_data1 as $n_data) {
                                        $n_data_arr[] = $n_data->np_certification_id;
                                    }
                                    $np_data_json = json_encode($n_data_arr);
                                } else {
                                    $np_data1 = "";
                                    $np_data_json = "";
                                }

                                if ($educationData && $educationData->cna_data) {
                                    $cna_data1 = json_decode($educationData->cna_data);
                                    $cn_data_arr = array();
                                    foreach ($cna_data1 as $cn_data) {
                                        $cn_data_arr[] = $cn_data->cn_certification_id;
                                    }
                                    $cna_data_json = json_encode($cn_data_arr);
                                } else {
                                    $cna_data1 = "";
                                    $cna_data_json = "";
                                }

                                if ($educationData && $educationData->lpn_data) {
                                    $lpn_data1 = json_decode($educationData->lpn_data);
                                    $lpn_data_arr = array();
                                    foreach ($lpn_data1 as $lpn_data) {
                                        $lpn_data_arr[] = $lpn_data->lpn_certification_id;
                                    }
                                    $lpn_data_json = json_encode($lpn_data_arr);
                                } else {
                                    $lpn_data1 = "";
                                    $lpn_data_json = "";
                                }

                                if ($educationData && $educationData->crna_data) {
                                    $crna_data1 = json_decode($educationData->crna_data);
                                    $crna_data_arr = array();
                                    foreach ($crna_data1 as $crna_data) {
                                        $crna_data_arr[] = $crna_data->crna_certification_id;
                                    }
                                    $crna_data_json = json_encode($crna_data_arr);
                                } else {
                                    $crna_data1 = "";
                                    $crna_data_json = "";
                                }

                                if ($educationData && $educationData->cnm_data) {
                                    $cnm_data1 = json_decode($educationData->cnm_data);
                                    $cnm_data_arr = array();
                                    foreach ($cnm_data1 as $cnm_data) {
                                        $cnm_data_arr[] = $cnm_data->cnm_certification_id;
                                    }
                                    $cnm_data_json = json_encode($cnm_data_arr);
                                } else {
                                    $cnm_data1 = "";
                                    $cnm_data_json = "";
                                }

                                if ($educationData && $educationData->ons_data) {
                                    $ons_data1 = json_decode($educationData->ons_data);
                                    $ons_data_arr = array();
                                    foreach ($ons_data1 as $ons_data) {
                                        $ons_data_arr[] = $ons_data->ons_certification_id;
                                    }
                                    $ons_data_json = json_encode($ons_data_arr);
                                } else {
                                    $ons_data1 = "";
                                    $ons_data_json = "";
                                }

                                if ($educationData && $educationData->msw_data) {
                                    $msw_data1 = json_decode($educationData->msw_data);
                                    $msw_data_arr = array();
                                    foreach ($msw_data1 as $msw_data) {
                                        $msw_data_arr[] = $msw_data->msw_certification_id;
                                    }
                                    $msw_data_json = json_encode($msw_data_arr);
                                } else {
                                    $msw_data1 = "";
                                    $msw_data_json = "";
                                }

                                if ($educationData && $educationData->ain_data) {
                                    $ain_data1 = json_decode($educationData->ain_data);
                                    $ain_data_arr = array();
                                    foreach ($ain_data1 as $ain_data) {
                                        $ain_data_arr[] = $ain_data->ain_certification_id;
                                    }
                                    $ain_data_json = json_encode($ain_data_arr);
                                } else {
                                    $ain_data1 = "";
                                    $ain_data_json = "";
                                }

                                if ($educationData && $educationData->rpn_data) {
                                    $rpn_data1 = json_decode($educationData->rpn_data);
                                    $rpn_data_arr = array();
                                    foreach ($rpn_data1 as $rpn_data) {
                                        $rpn_data_arr[] = $rpn_data->rpn_certification_id;
                                    }
                                    $rpn_data_json = json_encode($rpn_data_arr);
                                } else {
                                    $rpn_data1 = "";
                                    $rpn_data_json = "";
                                }

                                if ($educationData && $educationData->nl_data) {
                                    $nl_data_new = $educationData->nl_data;
                                } else {
                                    $nl_data_new = "";
                                }

                                ?>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">

                                        <div class="row">
                                            <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Educational Background
                                            </h4>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <input type="hidden" name="nurse_degree_one" class="nurse_degree_one" value="{{ $profileData->degree }}">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Nurse & Midwife degree</strong></label>
                                                    <?php
                                                    $nurse_midwife_degree = DB::table("degree")->where('status', '1')->orderBy('name')->get();
                                                    ?>
                                                    <ul id="ndegree" style="display:none;">
                                                        @foreach($nurse_midwife_degree as $ptl)
                                                        <li data-value="{{ $ptl->id }}">{{ $ptl->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="ndegree" name="ndegree[]" multiple="multiple"></select>
                                                    <span id="ndegree_error" class="text-danger valley"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Institutions</strong></label>
                                                    <input class="form-control" type="text" name="institution" id="institution" value="@if(!empty($educationData)){{ $educationData->institution }}@endif">
                                                    <span id="institution_error" class="text-danger valley"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Graduation Start Date</strong></label>
                                                    <input class="form-control" type="date" name="graduation_start_date" id="graduation_start_date" value="@if(!empty($educationData)){{ $educationData->graduate_start_date }}@endif" onchange="changeDate(event);">
                                                    <span id="gra_start_date_error" class="text-danger valley"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Upload Degree & Transcript</strong></label>
                                                    <input class="form-control degree_transcript" type="file" name="degree_transcript[]" multiple="">
                                                    <span id="upload_degree_error" class="reqError text-danger valley "></span>
                                                </div>

                                                <div class="mt-3">
                                                    @if(!empty($educationData) && $educationData->degree_transcript)
                                                    <?php
                                                    $dtran_img = (array)json_decode($educationData->degree_transcript);
                                                    //print_r($dtran_img);
                                                    $i = 1;
                                                    $user_id = $educationData->user_id;
                                                    ?>
                                                    @if(!empty($dtran_img))
                                                    @foreach($dtran_img as $tranimg)
                                                    <div class="trans_img trans_img-{{ $i }}">
                                                        <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                        <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg('{{ $i }}','{{ $user_id }}','{{ $tranimg }}')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                                    </div>
                                                    <?php
                                                    $i++;
                                                    ?>
                                                    @endforeach
                                                    @endif
                                                    @endif
                                                </div>
                                            </div>

                                            <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">General Certifications/Licences:
                                            </h4>

                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Please select all that apply</strong></label>
                                                    <input type="hidden" name="prof_cert_new" class="prof_cert_new" value="@if(!empty($educationData)){{ $educationData->professional_certifications }}@endif">
                                                    <?php
                                                    $certificates = DB::table("professional_certificate")->orderBy("ordering_id", "asc")->get();
                                                    ?>
                                                    <ul id="profess_cert" style="display:none;">
                                                        @foreach($certificates as $cert)
                                                        <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="profess_cert" name="professional_certification[]" multiple="multiple"></select>
                                                    <span id="profess_cert_error" class="text-danger valley"></span>
                                                </div>
                                            </div>

                                            <div class="professional_certification_div">
                                                <div class="form-group level-drp @if($educationData && $educationData->acls_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdiv">
                                                    <label class="d-flex gap-3 flex-wrap" for="input-1"><strong>ACLS (Advanced Cardiovascular Life Support)</strong></label>
                                                    <input type="hidden" name="pro_cert_acls" class="pro_cert_acls" value="@if(!empty($educationData)){{ $a_data_json }}@endif">
                                                    <?php
                                                    $acls_data = DB::table("professional_certificate_table")->where("cert_id", "6")->get();
                                                    ?>
                                                    <ul id="acls_data" style="display:none;">
                                                        @foreach($acls_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn acls_data" data-list-id="acls_data" name="acls_data[]" multiple="multiple"></select>
                                                </div>

                                                <div class="acls_certification_div">

                                                    @if(!empty($acls_data1))
                                                    <?php $i = 0; ?>
                                                    @foreach($acls_data1 as $a_data)
                                                    <?php
                                                    $acls_first_word = strtok($a_data->acls_certification_id, " ");
                                                    $acls_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $acls_first_word));
                                                    ?>

                                                    <div class="acls_{{ $acls_first_word_one }}">
                                                        <h4 class="mt-3">{{ $a_data->acls_certification_id }}</h4>
                                                        <div class="license_number_div row license_number_acls d-none">
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                                <input type="hidden" name="aclsnamearr[]" class="acls_input_{{ $a_data->acls_certification_id }}" value="{{ $a_data->acls_certification_id }}">
                                                                <input class="form-control acls_license_number acls_license_number-{{ $i }}" type="text" name="acls_license_number[]" value="{{ $a_data->acls_license_number }}">
                                                                <span id="reqaclslicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control aclsexpiry aclsexpiry-{{ $i }}" type="date" name="acls_expiry[]" value="{{ $a_data->acls_expiry }}">
                                                                <span id="reqaclsexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                                <input class="form-control acls_upload_certification acls_upload_certification-{{ $i }}" type="file" name="acls_upload_certification[{{ $i }}][]" multiple="">
                                                                <span id="reqaclsuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                                <?php
                                                                $acls_data_imgs = json_decode($a_data->acls_upload_certification);

                                                                //print_r($dtran_img);
                                                                $l = 1;
                                                                $user_id = $educationData->user_id;
                                                                ?>
                                                                @if(!empty($acls_data_imgs))
                                                                @foreach($acls_data_imgs as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImgCert('{{ $i }}','{{ $user_id }}','{{ $tranimg }}')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                                                </div>
                                                                <?php
                                                                $l++;
                                                                ?>
                                                                @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $i++;
                                                    ?>
                                                    @endforeach
                                                    @endif
                                                </div>

                                                <div class="form-group level-drp @if($educationData && $educationData->bls_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivone mt-3">
                                                    <input type="hidden" name="pro_cert_bls" class="pro_cert_bls" value="@if(!empty($educationData)){{ $b_data_json }}@endif">
                                                    <label class="form-label" for="input-1">BLS (Basic Life Support)</label>
                                                    <?php
                                                    $bls_data = DB::table("professional_certificate_table")->where("cert_id", "7")->get();
                                                    ?>
                                                    <ul id="bls_data" style="display:none;">
                                                        @foreach($bls_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="bls_data" name="bls_data[]" multiple="multiple"></select>
                                                </div>

                                                <div class="bls_certification_div">
                                                    @if(!empty($bls_data1))
                                                    <?php
                                                    $i = 0;
                                                    ?>
                                                    @foreach($bls_data1 as $b_data)
                                                    <?php
                                                    $bls_first_word = strtok($b_data->bls_certification_id, " ");;

                                                    $bls_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $bls_first_word));
                                                    ?>

                                                    <div class="bls_{{ $bls_first_word_one }}">
                                                        <h4>{{ $b_data->bls_certification_id }}</h4>
                                                        <div class="license_number_div row license_number_bls d-none">
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                                <input type="hidden" name="blsnamearr[]" class="bls_input_{{ $b_data->bls_certification_id }}" value="{{ $b_data->bls_certification_id }}">
                                                                <input class="form-control bls_license_number bls_license_number-{{ $i }}" type="text" name="bls_license_number" id="bls_license_number" value="{{ $b_data->bls_license_number }}">
                                                                <span id="reqblslicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control blsexpiry blsexpiry-{{ $i }}" type="date" name="bls_expiry" id="bls_expiry" value="{{ $b_data->bls_expiry }}">
                                                                <span id="reqblsexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                                <input class="form-control bls_upload_certification bls_upload_certification-{{ $i }}" type="file" name="bls_upload_certification" id="bls_upload_certification" multiple="">
                                                                <span id="reqblsuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>

                                                                <?php
                                                                $bls_data_imgs = json_decode($b_data->bls_upload_certification);

                                                                //print_r($dtran_img);
                                                                $l = 1;
                                                                $user_id = $educationData->user_id;
                                                                ?>
                                                                @if(!empty($bls_data_imgs))
                                                                @foreach($bls_data_imgs as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImgCert('{{ $l }}','{{ $user_id }}','{{ $tranimg }}')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                                                </div>

                                                                <?php
                                                                $l++;
                                                                ?>
                                                                @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $i++;
                                                    ?>
                                                    @endforeach
                                                    @endif

                                                </div>
                                                <div class="form-group level-drp @if($educationData && $educationData->cpr_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivtwo">
                                                    <input type="hidden" name="pro_cert_cpr" class="pro_cert_cpr" value="@if(!empty($educationData)){{ $c_data_json }}@endif">
                                                    <label class="form-label" for="input-1">CPR (Cardiopulmonary Resuscitation)</label>
                                                    <?php
                                                    $cpr_data = DB::table("professional_certificate_table")->where("cert_id", "8")->get();
                                                    ?>
                                                    <ul id="cpr_data" style="display:none;">
                                                        @foreach($cpr_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="cpr_data" name="cpr_data[]" multiple="multiple"></select>
                                                </div>

                                                <div class="cpr_certification_div">
                                                    @if(!empty($cpr_data1))
                                                    <?php $i = 0; ?>
                                                    @foreach($cpr_data1 as $c_data)
                                                    <?php
                                                    $cpr_first_word = strtok($c_data->cpr_certification_id, " ");;

                                                    $cpr_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $cpr_first_word));
                                                    ?>
                                                    <div class="cpr_{{ $cpr_first_word_one }}">
                                                        <h6>{{ $c_data->cpr_certification_id }}</h6>
                                                        <div class="license_number_div row license_number_cpr d-none">
                                                            <div class="form-group col-md-6">
                                                                <input type="hidden" name="cprnamearr[]" class="cpr_input_{{ $c_data->cpr_certification_id }}" value="{{ $c_data->cpr_certification_id }}">
                                                                <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                                <input class="form-control cpr_license_number cpr_license_number-{{ $i }}" type="text" name="cpr_license_number" id="cpr_license_number" value="{{ $c_data->cpr_license_number }}">
                                                                <span id="reqcprlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control cprexpiry cprexpiry-{{ $i }}" type="date" name="cpr_expiry" id="cpr_expiry" value="{{ $c_data->cpr_expiry }}">
                                                                <span id="reqcprexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                                <input class="form-control cpr_upload_certification cpr_upload_certification-{{ $i }}" type="file" name="cpr_upload_certification" id="cpr1_upload_certification" multiple>
                                                                <?php
                                                                $cpr_data_imgs = json_decode($c_data->cpr_upload_certification);

                                                                //print_r($dtran_img);
                                                                $l = 1;
                                                                $user_id = $educationData->user_id;
                                                                ?>
                                                                @if(!empty($cpr_data_imgs))
                                                                @foreach($cpr_data_imgs as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImgCert('{{ $l }}','{{ $user_id }}','{{ $tranimg }}')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                                                </div>

                                                                <?php
                                                                $l++;
                                                                ?>
                                                                @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $i++;
                                                    ?>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                <div class="form-group level-drp @if($educationData && $educationData->nrp_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivthree">
                                                    <input type="hidden" name="pro_cert_nrp" class="pro_cert_nrp" value="@if(!empty($educationData)){{ $n_data_json }}@endif">
                                                    <label class="form-label" for="input-1">NRP (Neonatal Resuscitation Program)</label>
                                                    <?php
                                                    $nrp_data = DB::table("professional_certificate_table")->where("cert_id", "9")->get();
                                                    ?>
                                                    <ul id="nrp_data" style="display:none;">
                                                        @foreach($nrp_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nrp_data" name="nrp_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="nrp_certification_div">
                                                    @if(!empty($nrp_data1))
                                                    @foreach($nrp_data1 as $n_data)
                                                    <?php
                                                    $nrp_first_word = strtok($n_data->nrp_certification_id, " ");;

                                                    $nrp_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $nrp_first_word));
                                                    ?>
                                                    <div class="nrp_{{ $nrp_first_word_one }}">
                                                        <h6>{{ $n_data->nrp_certification_id }}</h6>
                                                        <div class="license_number_div row license_number_nrp d-none">
                                                            <div class="form-group col-md-6">
                                                                <input type="hidden" name="nrpnamearr[]" class="nrp_input_{{ $n_data->nrp_certification_id }}" value="{{ $n_data->nrp_certification_id }}">
                                                                <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                                <input class="form-control nrp_license_number nrp_license_number-{{ $i }}" type="text" name="nrp_license_number" id="nrp_license_number" value="{{ $n_data->nrp_license_number }}">
                                                                <span id="reqnrplicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control nrpexpiry nrpexpiry-{{ $i }}" type="date" name="nrp_expiry" id="nrp_expiry" value="{{ $n_data->nrp_expiry }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                                <input class="form-control nrp_upload_certification nrp_upload_certification-{{ $i }}" type="file" name="nrp_upload_certification" id="nrp_upload_certification">
                                                                @if($n_data->nrp_upload_certification)
                                                                <img src="{{ url('/public/uploads/certificates') }}/{{ $n_data->nrp_upload_certification }}" style="width:100px;" class="mt-3">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                <div class="form-group level-drp @if($educationData && $educationData->pals_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivfour">
                                                    <input type="hidden" name="pro_cert_pals" class="pro_cert_pals" value="@if(!empty($educationData)){{ $p_data_json }}@endif">
                                                    <label class="form-label" for="input-1">PALS (Pediatric Advanced Life Support)</label>
                                                    <?php
                                                    $pls_data = DB::table("professional_certificate_table")->where("cert_id", "10")->get();
                                                    ?>
                                                    <ul id="pls_data" style="display:none;">
                                                        @foreach($pls_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="pls_data" name="pals_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="pls_certification_div">
                                                    @if(!empty($pls_data1))
                                                    @foreach($pls_data1 as $p_data)
                                                    <?php
                                                    $pls_first_word = strtok($p_data->pls_certification_id, " ");;

                                                    $pls_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $pls_first_word));
                                                    ?>

                                                    <div class="pls_{{ $pls_first_word_one }}">
                                                        <h6>{{ $p_data->pls_certification_id }}</h6>
                                                        <div class="license_number_div row license_number_pals d-none">
                                                            <div class="form-group col-md-6">
                                                                <input type="hidden" name="plsnamearr[]" class="pls_input_{{ $p_data->pls_certification_id }}" value="{{ $p_data->pls_certification_id }}">
                                                                <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                                <input class="form-control" type="text" name="pals_license_number" id="pals_license_number" value="{{ $p_data->pls_license_number }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control plsexpiry plsexpiry-{{ $i }}" type="date" name="pals_expiry" id="pals_expiry" value="{{ $p_data->pls_expiry }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                                <input class="form-control pls_upload_certification pls_upload_certification-{{ $i }}" type="file" name="pals_upload_certification" id="pals_upload_certification">
                                                                @if($p_data->pls_upload_certification)
                                                                <img src="{{ url('/public/uploads/certificates') }}/{{ $p_data->pls_upload_certification }}" style="width:100px;" class="mt-3">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                <div class="form-group level-drp @if($educationData && $educationData->rn_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivfive">
                                                    <input type="hidden" name="pro_cert_rn" class="pro_cert_rn" value="@if(!empty($educationData)){{ $r_data_json }}@endif">
                                                    <label class="form-label" for="input-1">RN (Registered Nurse)</label>
                                                    <?php
                                                    $rn_data = DB::table("professional_certificate_table")->where("cert_id", "11")->get();
                                                    ?>
                                                    <ul id="rn_data" style="display:none;">
                                                        @foreach($rn_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="rn_data" name="rn_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="rn_certification_div">
                                                    @if(!empty($rn_data1))
                                                    @foreach($rn_data1 as $r_data)
                                                    <?php
                                                    $rn_first_word = strtok($r_data->rn_certification_id, " ");;

                                                    $rn_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $rn_first_word));
                                                    ?>
                                                    <div class="rn_{{ $rn_first_word_one }}">
                                                        <h6>{{ $r_data->rn_certification_id }}</h6>
                                                        <div class="license_number_div row license_number_rn d-none">
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                                <input type="hidden" name="rnnamearr[]" class="rn_input_{{ $r_data->rn_certification_id }}" value="{{ $r_data->rn_certification_id }}">
                                                                <input class="form-control" type="text" name="rn_license_number" id="rn_license_number" value="{{ $r_data->rn_license_number }}">
                                                                <span id="reqrnlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control rnexpiry rnexpiry-{{ $i }}" type="date" name="rn_expiry" id="rn_expiry" value="{{ $r_data->rn_expiry }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                                <input class="form-control rn_upload_certification rn_upload_certification-{{ $i }}" type="file" name="rn_upload_certification" id="rn_upload_certification">
                                                                <span id="reqrnuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                                @if($r_data->rn_upload_certification)
                                                                <img src="{{ url('/public/uploads/certificates') }}/{{ $r_data->rn_upload_certification }}" style="width:100px;" class="mt-3">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                <div class="form-group level-drp @if($educationData && $educationData->np_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivtwelfth">
                                                    <label class="form-label" for="input-1">NP (Nurse Practioner) / (APRN) Advanced Practice Registered Nurse</label>
                                                    <input type="hidden" name="pro_cert_np" class="pro_cert_np" value="@if(!empty($educationData)){{ $np_data_json }}@endif">
                                                    <?php
                                                    $rn_data = DB::table("professional_certificate_table")->where("cert_id", "18")->get();
                                                    ?>
                                                    <ul id="np_data" style="display:none;">
                                                        @foreach($rn_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="np_data" name="np_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="np_certification_div">
                                                    @if(!empty($np_data1))
                                                    @foreach($np_data1 as $n_data)
                                                    <?php
                                                    $np_first_word = strtok($n_data->np_certification_id, " ");;

                                                    $np_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $np_first_word));
                                                    ?>

                                                    <div class="np_{{ $np_first_word_one }}">
                                                        <h6>{{ $n_data->np_certification_id }}</h6>

                                                        <div class="license_number_div row license_number_np d-none">
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                                <input type="hidden" name="npnamearr[]" class="np_input_{{ $n_data->np_certification_id }}" value="{{ $n_data->np_certification_id }}">
                                                                <input class="form-control np_license_number np_license_number-{{ $i }}" type="text" name="np_license_number" id="np_license_number" value="{{ $n_data->np_license_number }}">
                                                                <span id="reqnplicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control npexpiry npexpiry-{{ $i }}" type="date" name="np_expiry" id="np_expiry" value="{{ $n_data->np_expiry }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label np_upload_certification np_upload_certification-{{ $i }}" for="input-1">Upload your certification/Licence</label>
                                                                <input class="form-control" type="file" name="np_upload_certification" id="np_upload_certification">
                                                                <span id="reqnpuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                                @if($n_data->np_upload_certification)
                                                                <img src="{{ url('/public/uploads/certificates') }}/{{ $n_data->np_upload_certification }}" style="width:100px;" class="mt-3">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                <div class="form-group level-drp @if($educationData && $educationData->cna_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivsix">
                                                    <input type="hidden" name="pro_cert_cna" class="pro_cert_cna" value="@if(!empty($educationData)){{ $cna_data_json }}@endif">
                                                    <label class="form-label" for="input-1">CNA (Certified Nursing Assistant) / EN (Enrolled Nurse)</label>
                                                    <?php
                                                    $cn_data = DB::table("professional_certificate_table")->where("cert_id", "12")->get();
                                                    ?>
                                                    <ul id="cn_data" style="display:none;">
                                                        @foreach($cn_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="cn_data" name="cn_data[]" multiple="multiple"></select>
                                                    <span id="reqcnvalid" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="cna_certification_div">
                                                    @if(!empty($cna_data1))
                                                    @foreach($cna_data1 as $cn_data)
                                                    <?php
                                                    $cna_first_word = strtok($cn_data->cn_certification_id, " ");;

                                                    $cna_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $cna_first_word));
                                                    ?>
                                                    <div class="cna_{{ $cna_first_word_one }}">
                                                        <h6>{{ $cn_data->cn_certification_id }}</h6>
                                                        <div class="license_number_div row license_number_cn d-none">
                                                            <div class="form-group col-md-6">
                                                                <input type="hidden" name="cnnamearr[]" class="cn_input_{{ $cn_data->cn_certification_id }}" value="{{ $cn_data->cn_certification_id }}">
                                                                <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                                <input class="form-control cn_license_number cn_license_number-{{ $i }}" type="text" name="cn_license_number" id="cn_license_number" value="{{ $cn_data->cn_license_number }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control cnexpiry cnexpiry-{{ $i }}" type="date" name="cn_expiry" id="cn_expiry" value="{{ $cn_data->cn_expiry }}">
                                                                <span id="reqcnexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                                <input class="form-control cn_upload_certification cn_upload_certification-{{ $i }}" type="file" name="cn_upload_certification" id="cn_upload_certification">
                                                                <span id="reqcnuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                                @if($cn_data->cn_upload_certification)
                                                                <img src="{{ url('/public/uploads/certificates') }}/{{ $cn_data->cn_upload_certification }}" style="width:100px;" class="mt-3">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>

                                                <div class="form-group level-drp  @if($educationData && $educationData->lpn_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivseven">
                                                    <input type="hidden" name="pro_cert_lpn" class="pro_cert_lpn" value="@if(!empty($educationData)){{ $lpn_data_json }}@endif">
                                                    <label class="form-label" for="input-1">LPN (Licensed Practical Nurse) / LVN (Licensed Vocational Nurse)</label>
                                                    <?php
                                                    $lpn_data = DB::table("professional_certificate_table")->where("cert_id", "13")->get();
                                                    ?>
                                                    <ul id="lpn_data" style="display:none;">
                                                        @foreach($lpn_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="lpn_data" name="lpn_data[]" multiple="multiple"></select>
                                                    <span id="reqlpnvalid" class="reqError text-danger valley"></span>
                                                </div>

                                                {{-- lpn Div --}}
                                                <div class="lpn_certification_div">
                                                    @if(!empty($lpn_data1))
                                                    @foreach($lpn_data1 as $l_data)
                                                    <?php
                                                    $lpn_first_word = strtok($l_data->lpn_certification_id, " ");;

                                                    $lpn_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $lpn_first_word));
                                                    ?>

                                                    <div class="lpn_{{ $lpn_first_word_one }}">
                                                        <h6>{{ $l_data->lpn_certification_id }}</h6>
                                                        <div class="license_number_div row license_number_lpn d-none">
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                                <input type="hidden" name="lpnnamearr[]" class="lpn_input_{{ $l_data->lpn_certification_id }}" value="{{ $l_data->lpn_certification_id }}">
                                                                <input class="form-control lpn_license_number lpn_license_number-{{ $i }}" type="text" name="lpn_license_number" id="lpn_license_number" value="{{ $l_data->lpn_license_number }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control lpnexpiry lpnexpiry-{{ $i }}" type="date" name="lpn_expiry" id="lpn_expiry" value="{{ $l_data->lpn_expiry }}">
                                                                <span id="reqlpnexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                                <input class="form-control lpn_upload_certification lpn_upload_certification-{{ $i }}" type="file" name="lpn_upload_certification" id="lpn_upload_certification">
                                                                <span id="reqlpnuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                                @if($l_data->lpn_upload_certification)
                                                                <img src="{{ url('/public/uploads/certificates') }}/{{ $l_data->lpn_upload_certification }}" style="width:100px;" class="mt-3">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                {{-- end div --}}

                                                {{-- crna div --}}
                                                <div class="form-group level-drp @if($educationData && $educationData->crna_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdiveight">
                                                    <input type="hidden" name="pro_cert_crna" class="pro_cert_crna" value="@if(!empty($educationData)){{ $crna_data_json }}@endif">
                                                    <label class="form-label" for="input-1">CRNA (Certified Registered Nurse Anesthetist)</label>
                                                    <?php
                                                    $crn_data = DB::table("professional_certificate_table")->where("cert_id", "14")->get();
                                                    ?>
                                                    <ul id="crn_data" style="display:none;">
                                                        @foreach($crn_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="crn_data" name="crn_data[]" multiple="multiple"></select>
                                                    <span id="reqcrnavalid" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="crna_certification_div">
                                                    @if(!empty($crna_data1))
                                                    @foreach($crna_data1 as $crna_data)
                                                    <?php
                                                    $crna_first_word = strtok($crna_data->crna_certification_id, " ");;

                                                    $crna_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $crna_first_word));
                                                    ?>
                                                    <div class="crna_{{ $crna_first_word_one }}">
                                                        <h6>{{ $crna_data->crna_certification_id }}</h6>
                                                        <div class="license_number_div row license_number_crn d-none">
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                                <input type="hidden" name="crnanamearr[]" class="crna_input_{{ $crna_data->crna_certification_id }}" value="{{ $crna_data->crna_certification_id }}">
                                                                <input class="form-control crna_license_number crna_license_number-{{ $i }}" type="text" name="crn_license_number" id="crn_license_number" value="{{ $crna_data->crna_license_number }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control crnaexpiry crnaexpiry-{{ $i }}" type="date" name="crna_expiry[]" value="{{ $crna_data->crna_expiry }}">
                                                                <span id="reqcrnaexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                                <input class="form-control crna_upload_certification crna_upload_certification-{{ $i }}" type="file" name="crn_upload_certification" id="crn_upload_certification">
                                                                <span id="reqcrnauploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                                @if($crna_data->crna_upload_certification)
                                                                <img src="{{ url('/public/uploads/certificates') }}/{{ $crna_data->crna_upload_certification }}" style="width:100px;" class="mt-3">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                {{-- end div --}}


                                                {{-- cnm div --}}
                                                <div class="form-group level-drp @if($educationData && $educationData->cnm_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivnine">
                                                    <input type="hidden" name="pro_cert_cnm" class="pro_cert_cnm" value="@if(!empty($educationData)){{ $cnm_data_json }}@endif">
                                                    <label class="form-label" for="input-1">CNM (Certified Nurse Midwife)</label>
                                                    <?php
                                                    $cnm_data = DB::table("professional_certificate_table")->where("cert_id", "15")->get();
                                                    ?>
                                                    <ul id="cnm_data" style="display:none;">
                                                        @foreach($cnm_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="cnm_data" name="cnm_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="cnm_certification_div">
                                                    @if(!empty($cnm_data1))
                                                    @foreach($cnm_data1 as $cnm_data)
                                                    <?php
                                                    $cnm_first_word = strtok($cnm_data->cnm_certification_id, " ");;

                                                    $cnm_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $cnm_first_word));
                                                    ?>
                                                    <div class="cnm_{{ $cnm_first_word_one }}">
                                                        <h6>{{ $cnm_data->cnm_certification_id }}</h6>
                                                        <div class="license_number_div row license_number_cnm d-none">
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                                <input type="hidden" name="cnmnamearr[]" class="cnm_input_{{ $cnm_data->cnm_certification_id }}" value="{{ $cnm_data->cnm_certification_id }}">
                                                                <input class="form-control cnm_license_number cnm_license_number-{{ $i }}" type="text" name="cnm_license_number[]" value="{{ $cnm_data->cnm_license_number }}">
                                                                <span id="reqcnmlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control cnmexpiry cnmexpiry-{{ $i }}" type="date" name="cnm_expiry[]" value="{{ $cnm_data->cnm_expiry }}">
                                                                <span id="reqcnmexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                                <input class="form-control cnm_upload_certification cnm_upload_certification-{{ $i }}" type="file" name="cnm_upload_certification[]">
                                                                <span id="reqcnmuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                                @if($cnm_data->cnm_upload_certification)
                                                                <img src="{{ url('/public/uploads/certificates') }}/{{ $cnm_data->cnm_upload_certification }}" style="width:100px;" class="mt-3">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                {{-- end div --}}

                                                {{-- ons div --}}
                                                <div class="form-group level-drp @if($educationData && $educationData->ons_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivten">
                                                    <input type="hidden" name="pro_cert_ons" class="pro_cert_ons" value="@if(!empty($educationData)){{ $ons_data_json }}@endif">
                                                    <label class="form-label" for="input-1">ONS/ONCC (Oncology Nursing Society/Oncology Nursing Certification Corporation)</label>
                                                    <?php
                                                    $ons_data = DB::table("professional_certificate_table")->where("cert_id", "16")->get();
                                                    ?>
                                                    <ul id="ons_data" style="display:none;">
                                                        @foreach($ons_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="ons_data" name="ons_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="ons_certification_div">
                                                    @if(!empty($ons_data1))
                                                    @foreach($ons_data1 as $ons_data)
                                                    <?php
                                                    $ons_first_word = strtok($ons_data->ons_certification_id, " ");;

                                                    $ons_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $ons_first_word));
                                                    ?>
                                                    <div class="ons_{{ $ons_first_word_one }}">
                                                        <h6>{{ $ons_data->ons_certification_id }}</h6>
                                                        <div class="license_number_div row license_number_ons d-none">
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                                <input type="hidden" name="onsnamearr[]" class="ons_input_{{ $ons_data->ons_certification_id }}" value="{{ $ons_data->ons_certification_id }}">
                                                                <input class="form-control ons_license_number ons_license_number-{{ $i }}" type="text" name="ons_license_number[]" value="{{ $ons_data->ons_license_number }}">
                                                                <span id="reqonslicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control onsexpiry onsexpiry-{{ $i }}" type="date" name="ons_expiry[]" value="{{ $ons_data->ons_expiry }}">
                                                                <span id="reqonsexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                                <input class="form-control ons_upload_certification ons_upload_certification-{{ $i }}" type="file" name="ons_upload_certification[]">
                                                                <span id="reqonsuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                                @if($ons_data->ons_upload_certification)
                                                                <img src="{{ url('/public/uploads/certificates') }}/{{ $ons_data->ons_upload_certification }}" style="width:100px;" class="mt-3">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                {{-- end div --}}

                                                {{-- msw div --}}
                                                <div class="form-group level-drp @if($educationData && $educationData->msw_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdiveleven">
                                                    <input type="hidden" name="pro_cert_msw" class="pro_cert_msw" value="@if(!empty($educationData)){{ $msw_data_json }}@endif">
                                                    <label class="form-label" for="input-1">MSW/AiM (Maternity Support Worker/Assistant in Midwifery ) / Midwife Assistant</label>
                                                    <?php
                                                    $msw_data = DB::table("professional_certificate_table")->where("cert_id", "17")->get();
                                                    ?>
                                                    <ul id="msw_data" style="display:none;">
                                                        @foreach($msw_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="msw_data" name="msw_data[]" multiple="multiple"></select>
                                                    <span id="reqmswvalid" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="msw_certification_div">
                                                    @if(!empty($msw_data1))
                                                    @foreach($msw_data1 as $msw_data)
                                                    <?php
                                                    $msw_first_word = strtok($msw_data->msw_certification_id, " ");;

                                                    $msw_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $msw_first_word));
                                                    ?>
                                                    <div class="msw_{{ $msw_first_word_one }}">
                                                        <h6>{{ $msw_data->msw_certification_id }}</h6>
                                                        <div class="license_number_div row license_number_msw">
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                                <input type="hidden" name="mswnamearr[]" class="msw_input_{{ $msw_data->msw_certification_id }}" value="{{ $msw_data->msw_certification_id }}">
                                                                <input class="form-control msw_license_number msw_license_number-{{ $i }}" type="text" name="msw_license_number[]" value="{{ $msw_data->msw_license_number }}">
                                                                <span id="reqmswlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control mswexpiry mswexpiry-{{ $i }}" type="date" name="msw_expiry[]" value="{{ $msw_data->msw_expiry }}">
                                                                <span id="reqmswexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                                <input class="form-control msw_upload_certification msw_upload_certification-{{ $i }}" type="file" name="msw_upload_certification[]">
                                                                <span id="reqmswuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                                @if($msw_data->msw_upload_certification)
                                                                <img src="{{ url('/public/uploads/certificates') }}/{{ $msw_data->msw_upload_certification }}" style="width:100px;">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                {{-- end div --}}

                                                {{-- ain div --}}
                                                <div class="form-group level-drp  @if($educationData && $educationData->ain_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivthirteen">
                                                    <input type="hidden" name="pro_cert_ain" class="pro_cert_ain" value="@if(!empty($educationData)){{ $ain_data_json }}@endif">
                                                    <label class="form-label" for="input-1">AIN (Assistant in Nursing) / NA (Nurse Associate) / HCA (Healthcare Assistant)</label>
                                                    <?php
                                                    $msw_data = DB::table("professional_certificate_table")->where("cert_id", "19")->get();
                                                    ?>
                                                    <ul id="ain_data" style="display:none;">
                                                        @foreach($msw_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="ain_data" name="ain_data[]" multiple="multiple"></select>
                                                    <span id="reqainvalid" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="ain_certification_div">
                                                    @if(!empty($ain_data1))
                                                    @foreach($ain_data1 as $ain_data)
                                                    <?php
                                                    $ain_first_word = strtok($ain_data->ain_certification_id, " ");;

                                                    $ain_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $ain_first_word));
                                                    ?>
                                                    <div class="ain_{{ $ain_first_word_one }}">
                                                        <h6>{{ $ain_data->ain_certification_id }}</h6>
                                                        <div class="license_number_div row license_number_ain d-none">
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                                <input type="hidden" name="ainnamearr[]" class="ain_input_{{ $ain_data->ain_certification_id }}" value="{{ $ain_data->ain_certification_id }}">
                                                                <input class="form-control ain_license_number ain_license_number-{{ $i }}" type="text" name="ain_license_number[]" value="{{ $ain_data->ain_license_number }}">
                                                                <span id="reqainlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control ainexpiry ainexpiry-{{ $i }}" type="date" name="ain_expiry[]" value="{{ $ain_data->ain_expiry }}">
                                                                <span id="reqainexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                                <input class="form-control ain_upload_certification ain_upload_certification-{{ $i }}" type="file" name="ain_upload_certification[]">
                                                                <span id="reqainuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                                @if($ain_data->ain_upload_certification)
                                                                <img src="{{ url('/public/uploads/certificates') }}/{{ $ain_data->ain_upload_certification }}" style="width:100px;" class="mt-3">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                {{-- end div --}}

                                                {{-- rpn div --}}
                                                <div class="form-group level-drp @if($educationData && $educationData->rpn_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivfourteen">
                                                    <input type="hidden" name="pro_cert_rpn" class="pro_cert_rpn" value="@if(!empty($educationData)){{ $rpn_data_json }}@endif">
                                                    <label class="form-label" for="input-1">RPN (Registered Practical Nurse) / RGN (Registered General Nurse)</label>
                                                    <?php
                                                    $msw_data = DB::table("professional_certificate_table")->where("cert_id", "20")->get();
                                                    ?>
                                                    <ul id="rpn_data" style="display:none;">
                                                        @foreach($msw_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="rpn_data" name="rpn_data[]" multiple="multiple"></select>
                                                    <span id="reqrpnvalid" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="rpn_certification_div">
                                                    @if(!empty($rpn_data1))
                                                    @foreach($rpn_data1 as $rpn_data)
                                                    <?php
                                                    $rpn_first_word = strtok($rpn_data->rpn_certification_id, " ");;

                                                    $rpn_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $rpn_first_word));
                                                    ?>
                                                    <div class="license_number_div row license_number_rpn d-none">
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                            <input type="hidden" name="rpnnamearr[]" class="rpn_input_{{ $rpn_data->rpn_certification_id }}" value="{{ $rpn_data->rpn_certification_id }}">
                                                            <input class="form-control rpn_license_number rpn_license_number-{{ $i }}" type="text" name="rpn_license_number[]" value="{{ $rpn_data->rpn_license_number }}">
                                                            <span id="reqrpnlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Expiry</label>
                                                            <input class="form-control rpnexpiry rpnexpiry-{{ $i }}" type="date" name="rpn_expiry[]" value="{{ $rpn_data->rpn_expiry }}">
                                                            <span id="reqrpnexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                            <input class="form-control rpn_upload_certification rpn_upload_certification-{{ $i }}" type="file" name="rpn_upload_certification[]">
                                                            <span id="reqrpnuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            @if($rpn_data->rpn_upload_certification)
                                                            <img src="{{ url('/public/uploads/certificates') }}/{{ $rpn_data->rpn_upload_certification }}" style="width:100px;" class="mt-3">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                {{-- end div --}}

                                                <div class="form-group level-drp @if($educationData && $educationData->nl_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivfiveteen">
                                                    <input type="hidden" name="pro_cert_nl" class="pro_cert_nl" value="@if(!empty($educationData)){{ $nl_data_new }}@endif">
                                                    <label class="form-label" for="input-1">No License/Certification</label>
                                                    <?php
                                                    $nlc_data = DB::table("professional_certificate_table")->where("cert_id", "21")->get();
                                                    ?>
                                                    <ul id="nlc_data" style="display:none;">
                                                        @foreach($nlc_data as $data)
                                                        <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nlc_data" name="nl_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="another_certifications">
                                                    <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Other certifications</h4>
                                                    <?php
                                                    if (!empty($educationData)) {
                                                        $additional_certificate = json_decode($educationData->additional_certification);
                                                    } else {
                                                        $additional_certificate = "";
                                                    }
                                                    $i = 1;
                                                    ?>


                                                    @if(!empty($additional_certificate))
                                                    @foreach($additional_certificate as $c_data)
                                                    <div class="license_number_div license_number_div_{{ $i }} row license_number_anothercertifications">
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Certificate {{ $i }}</label>
                                                            <input class="form-control additional_certificate_field additional_certificate_field-{{ $i }}" type="text" name="training_certificate[]" value="@if(!empty($educationData)){{ $c_data->training_certificate }}@endif">
                                                            <span id="reqcertname-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                            <input class="form-control cert_licence_num cert_licence_num-{{ $i }}" type="text" name="certificate_license_number[]" value="@if(!empty($educationData)){{ $c_data->certificate_license_number }}@endif">
                                                            <span id="reqcertlicense-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Expiry</label>
                                                            <input class="form-control cert_expiry cert_expiry-{{ $i }}" type="date" name="certificate_expiry[]" value="@if(!empty($educationData)){{ $c_data->certificate_expiry }}@endif">
                                                            <span id="reqcertexpiry-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Regulating Body</label>
                                                            <input class="form-control additional_regulating_body additional_regulating_body-{{ $i }}" type="text" name="regulating_body[]" value="@if(!empty($educationData)){{ $c_data->regulating_body }}@endif">
                                                            <span id="reqcertregulating_body-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                            <input class="form-control" type="file" name="certificate_upload_certification[]">
                                                            @if($c_data->certificate_upload_certification)
                                                            <img src="{{ url('/public/uploads/certificates') }}/{{ $c_data->certificate_upload_certification }}" style="width:100px;">
                                                            @endif
                                                        </div>
                                                        <?php
                                                        $user_id = $educationData->user_id;
                                                        ?>
                                                        <div class="col-md-12">
                                                            <div class="add_new_certification_div mb-3 mt-3"><a style="cursor: pointer;" onclick="delete_certification('{{ $i }}','{{ $user_id }}','{{ $c_data->certificate_id }}')">- Delete certification/Licence</a></div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $i++;
                                                    ?>
                                                    @endforeach

                                                    @endif


                                                </div>

                                                <div class="add_new_certification_div mb-3 mt-3">
                                                    <a style="cursor: pointer;" onclick="add_listcertfication()">+ Add another certification/Licence</a>
                                                </div>

                                                <script type="text/javascript">
                                                    var licence_div_count = $(".license_number_anothercertifications").length;

                                                    console.log("licence_div_count", licence_div_count);

                                                    function add_listcertfication() {
                                                        licence_div_count++;

                                                        $(".another_certifications").append('<div class="license_number_div license_number_div_' + licence_div_count + ' row license_number_anothercertifications"><div class="form-group col-md-6"><label class="form-label" for="input-1">Certificate ' + licence_div_count + '</label><input class="form-control additional_certificate_field additional_certificate_field-' + licence_div_count + '" type="text" name="training_certificate[]"><span id="reqcertname-' + licence_div_count + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control cert_licence_num cert_licence_num-' + licence_div_count + '" type="text" name="certificate_license_number[]"><span id="reqcertlicense-' + licence_div_count + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control cert_expiry cert_expiry-' + licence_div_count + '" type="date" name="certificate_expiry[]"><span id="reqcertexpiry-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Regulating Body</label><input class="form-control additional_regulating_body additional_regulating_body-' + licence_div_count + '" type="text" name="regulating_body[]"><span id="reqcertregulating_body-' + licence_div_count + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control" type="file" name="certificate_upload_certification[]"></div><div class="col-md-12"><div class="add_new_certification_div mb-3 mt-3"><a style="cursor: pointer;" onclick="delete_certification1(' + licence_div_count + ')">- Delete certification/Licence</a></div></div></div>');

                                                    }
                                                </script>

                                            </div>
                                            <div class="declaration_box">
                                                <input type="checkbox" name="declare_information_edu" class="declare_information_edu" value="1" @if(!empty($educationData)) @if($educationData->declaration_status == 1) checked @endif @endif>
                                                <label for="declare_information1">I declare that the information provided is true and correct</label>
                                            </div>
                                            <span id="reqdeclare_information1" class="reqError text-danger valley"></span>

                                            <div class="d-flex align-items-center justify-content-between mt-3">
                                                <button type="submit" class="btn btn-default next-step-44 align-items-center justify-content-between" data-target="#navpill-5">Next</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane p-3" id="navpill-5" role="tabpanel">
                <div class="row">
                    <div class=" w-100  overflow-hidden">
                        <div class="card-body p-3 px-md-4 pb-0">
                            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Experience</h3>
                        </div>
                        <div class="card-body p-3 px-md-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>What is your level of experience?</strong></label>
                                            <select class="form-control mr-10 select-active" name="assistent_level" id="assistent_level">
                                                @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                                                    @endfor
                                            </select>
                                            <span id="experience_error" class="text-danger valley"></span>
                                        </div>
                                    </div>

                                    <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Previous Employers</h4>

                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Names</strong></label>
                                            <input class="form-control" type="text" name="previous_employer_name" id="previous_employer_name">
                                            <span id="previous_employer_name_error" class="text-danger valley"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Position Held</strong></label>
                                            <?php
                                            $practitioner_type = DB::table("practitioner_type")->get();
                                            ?>
                                            <ul id="positions_held" style="display:none;">
                                                @foreach($practitioner_type as $cert)
                                                <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                                                @endforeach

                                            </ul>
                                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="positions_held" name="positions_held[]" multiple="multiple"></select>
                                            <span id="positions_held_error" class="text-danger valley"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Employment Start Date</strong></label>
                                            <input class="form-control" type="date" name="start_date" id="start_date">
                                            <span id="start_date_error" class="text-danger valley"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Employment End Date</strong></label>
                                            <input class="form-control" type="date" name="end_date" id="end_date">
                                            <span id="end_date_error" class="text-danger valley"></span>
                                        </div>
                                    </div>

                                    <div class="present_check mt-3">
                                        <input type="checkbox" name="present_box" value="1" id="present_box">Present Here
                                    </div>
                                    <span id="present_box_error" class="text-danger valley"></span>

                                    <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Detailed Job Descriptions</h4>

                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Responsibilities</strong></label>
                                            <textarea class="form-control" name="job_responeblities" id="job_responeblities"></textarea>
                                            <span id="job_responeblities_error" class="text-danger valley"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Achievements</strong></label>
                                            <textarea class="form-control" name="achievements" id="achievements"></textarea>
                                            <span id="achievements_error" class="text-danger valley"></span>
                                        </div>
                                    </div>

                                    <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Areas of Expertise</h4>

                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Specific skills and competencies</strong></label>
                                            <?php
                                            $skills = DB::table("skills")->get();
                                            ?>
                                            <ul id="skills_compantancies" style="display:none;">
                                                @foreach($skills as $cert)
                                                <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                                                @endforeach

                                            </ul>
                                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="skills_compantancies" name="skills_compantancies[]" multiple="multiple"></select>
                                            <span id="skills_compantancies_error" class="text-danger valley"></span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <button type="button" class="btn btn-default next-step-5 align-items-center justify-content-between" data-target="#navpill-6">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-3" id="tab-6" role="tabpanel">
                <div class="row">
                    <div class=" w-100  overflow-hidden">
                        <div class="card-body p-3 px-md-4 pb-0">
                            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">References</h3>
                        </div>
                        <form method="post" id="edit_reference_form">
                            <input type="hidden" name="tab" value="tab15">
                            <input type="hidden" value="{{isset($profileData->id)? $profileData->id : ''}}" id="user_id" name="user_id">
                            <div class="card-body p-3 px-md-4">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="reference_form">
                                            @if(count($RefereData)>0)
                                            <?php
                                            $i = 1;
                                            ?>
                                            @foreach($RefereData as $referee_data)
                                            <div class="referee_data referee_data-{{ $i }}">
                                                <h6 class="fw-bolder fs-6 lh-base d-flex align-items-center referee_no">REFEREE {{ $i }}</h6>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>First name</strong></label>
                                                        <input type="hidden" name="reference_no[]" value="{{ $i }}">
                                                        <input class="form-control first_name first_name-{{ $i }}" type="text" name="first_name[]" value="{{ $referee_data->first_name }}">
                                                        <span id="reqfname-{{ $i }}" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Last name</strong></label>
                                                        <input class="form-control last_name last_name-{{ $i }}" type="text" name="last_name[]" value="{{ $referee_data->last_name }}">
                                                        <span id="reqlname-{{ $i }}" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Email</strong></label>
                                                        <input class="form-control reference_email reference_email-{{ $i }}" type="text" name="email[]" value="{{ $referee_data->email }}">
                                                        <span id="reqemail-{{ $i }}" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Phone number</strong></label>
                                                        <input class="form-control  phone_no phone_no-{{ $i }}" type="text" name="phone_no[]" value="{{ $referee_data->phone_no }}">
                                                        <span id="reqphoneno-1" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Referee relationship to you</strong></label>
                                                        <select class="form-control reference_relationship reference_relationship-{{ $i }}" name="reference_relationship[]">
                                                            <option value="">Select</option>
                                                            <option value="Worked in Same Group" @if($referee_data->relationship == "Worked in Same Group") selected @endif>Worked in Same Group</option>
                                                            <option value="Referee Managed Me" @if($referee_data->relationship == "Referee Managed Me") selected @endif>Referee Managed Me</option>
                                                            <option value="I Managed Referee" @if($referee_data->relationship == "I Managed Referee") selected @endif>I Managed Referee</option>
                                                            <option value="Worked Together on a Project" @if($referee_data->relationship == "Worked Together on a Project") selected @endif>Worked Together on a Project</option>
                                                            <option value="Worked Together in Different Departments" @if($referee_data->relationship == "Worked Together in Different Departments") selected @endif>Worked Together in Different Departments</option>
                                                            <option value="Colleague" @if($referee_data->relationship == "Colleague") selected @endif>Colleague</option>
                                                            <option value="Peer Mentor" @if($referee_data->relationship == "Peer Mentor") selected @endif>Peer Mentor</option>
                                                            <option value="Clinical Supervisor" @if($referee_data->relationship == "Clinical Supervisor") selected @endif>Clinical Supervisor</option>
                                                            <option value="Educational Supervisor" @if($referee_data->relationship == "Educational Supervisor") selected @endif>Educational Supervisor</option>
                                                            <option value="Preceptor" @if($referee_data->relationship == "Preceptor") selected @endif>Preceptor</option>
                                                            <option value="Instructor or Teacher" @if($referee_data->relationship == "Instructor or Teacher") selected @endif>Instructor or Teacher</option>
                                                            <option value="Collaborated on Research" @if($referee_data->relationship == "Collaborated on Research") selected @endif>Collaborated on Research</option>
                                                            <option value="Clinical Educator" @if($referee_data->relationship == "Clinical Educator") selected @endif>Clinical Educator</option>
                                                            <option value="Patient Advocate" @if($referee_data->relationship == "Patient Advocate") selected @endif>Patient Advocate</option>
                                                            <option value="Coordinated Care Together" @if($referee_data->relationship == "Coordinated Care Together") selected @endif>Coordinated Care Together</option>
                                                            <option value="Advisory Role" @if($referee_data->relationship == "Advisory Role") selected @endif>Advisory Role</option>
                                                            <option value="Worked Together on Committees" @if($referee_data->relationship == "Worked Together on Committees") selected @endif>Worked Together on Committees</option>
                                                            <option value="Consultant Relationship" @if($referee_data->relationship == "Consultant Relationship") selected @endif>Consultant Relationship</option>
                                                            <option value="Professional Mentor" @if($referee_data->relationship == "Professional Mentor") selected @endif>Professional Mentor</option>
                                                            <option value="Team Leader" @if($referee_data->relationship == "Team Leader") selected @endif>Team Leader</option>
                                                            <option value="Subordinate in a Leadership Role" @if($referee_data->relationship == "Subordinate in a Leadership Role") selected @endif>Subordinate in a Leadership Role</option>
                                                            <option value="Provided Professional Development Support" @if($referee_data->relationship == "Provided Professional Development Support") selected @endif>Provided Professional Development Support</option>
                                                            <option value="Oversaw my Certification Process" @if($referee_data->relationship == "Oversaw my Certification Process") selected @endif>Oversaw my Certification Process</option>
                                                            <option value="External Collaborator" @if($referee_data->relationship == "External Collaborator") selected @endif>External Collaborator</option>
                                                            <option value="Other" @if($referee_data->relationship == "Other") selected @endif>Other</option>
                                                        </select>
                                                        <span id="reqreferencerel-{{ $i }}" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>You worked together at:</strong></label>
                                                        <input class="form-control worked_together worked_together-{{ $i }}" type="text" name="worked_together[]" value="{{ $referee_data->worked_together }}">
                                                        <span id="reqworked_together-{{ $i }}" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>What was your position when you worked with this referee?</strong></label>
                                                        <input class="form-control  position_with_referee position_with_referee-{{ $i }}" type="text" name="position_with_referee[]" value="{{ $referee_data->position_with_referee }}">
                                                        <span id="reqpositionreferee-{{ $i }}" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Start Date</strong></label>
                                                        <input class="form-control referee_start_date referee_start_date-{{ $i }}" type="date" name="start_date[]" value="{{ $referee_data->start_date }}" onchange="startDate('{{ $i }}')" onkeydown="return false">
                                                        <span id="reqempsdate" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group level-drp working-{{ $i }}">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>End Date</strong></label>
                                                        <input class="form-control end_date end_date-{{ $i }}" type="date" name="end_date[]" value="{{ $referee_data->end_date }}" onkeydown="return false">
                                                        <span id="reqrefereeedate-{{ $i }}" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                                <div class="declaration_box">
                                                    <input class="still_working still_working-{{ $i }}" type="checkbox" name="still_working[]" @if($referee_data->still_working == 1) checked @endif onclick="stillWorking({{ $i }})">I'm still working with this referee
                                                    <span id="reqstillworking-{{ $i }}" class="reqError text-danger valley"></span>
                                                </div>
                                                @if($i != 1)
                                                <?php
                                                $user_id = $referee_data->user_id;
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="add_new_certification_div mb-3 mt-3">
                                                            <a style="cursor: pointer;" onclick="delete_reference('{{ $i }}','{{ $user_id }}','{{ $referee_data->referee_id }}')">- Delete Referee</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            {{-- <div class="add_new_certification_div mb-3 mt-3">
                                            <a style="cursor: pointer;" onclick="add_another_referee()">+ Add another Referee</a>
                                        </div> --}}
                                            <?php
                                            $i++;
                                            ?>
                                            @endforeach
                                            @else
                                            <h6 class="fw-bolder fs-6 lh-base d-flex align-items-center referee_no">REFEREE 1</h6>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>First name</strong></label>
                                                    <input class="form-control first_name first_name-1" type="text" name="first_name[]">
                                                    <span id="reqfname-1" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Last name</strong></label>
                                                    <input class="form-control last_name last_name-1" type="text" name="last_name[]">
                                                    <span id="reqlname-1" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Email</strong></label>
                                                    <input class="form-control reference_email reference_email-1" type="text" name="email[]">
                                                    <span id="reqemail-1" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Phone number</strong></label>
                                                    <input class="form-control  phone_no phone_no-1" type="text" name="phone_no[]">
                                                    <span id="reqphoneno-1" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Referee relationship to you</strong></label>
                                                    <select class="form-control reference_relationship reference_relationship-{{ $i }}" name="reference_relationship[]">
                                                        <option value="">Select</option>
                                                        <option value="Worked in Same Group">Worked in Same Group</option>
                                                        <option value="Referee Managed Me">Referee Managed Me</option>
                                                        <option value="I Managed Referee">I Managed Referee</option>
                                                        <option value="Worked Together on a Project">Worked Together on a Project</option>
                                                        <option value="Worked Together in Different Departments">Worked Together in Different Departments</option>
                                                        <option value="Colleague">Colleague</option>
                                                        <option value="Peer Mentor">Peer Mentor</option>
                                                        <option value="Clinical Supervisor">Clinical Supervisor</option>
                                                        <option value="Educational Supervisor">Educational Supervisor</option>
                                                        <option value="Preceptor">Preceptor</option>
                                                        <option value="Instructor or Teacher">Instructor or Teacher</option>
                                                        <option value="Collaborated on Research">Collaborated on Research</option>
                                                        <option value="Clinical Educator">Clinical Educator</option>
                                                        <option value="Patient Advocate">Patient Advocate</option>
                                                        <option value="Coordinated Care Together">Coordinated Care Together</option>
                                                        <option value="Advisory Role">Advisory Role</option>
                                                        <option value="Worked Together on Committees">Worked Together on Committees</option>
                                                        <option value="Consultant Relationship">Consultant Relationship</option>
                                                        <option value="Professional Mentor">Professional Mentor</option>
                                                        <option value="Team Leader">Team Leader</option>
                                                        <option value="Subordinate in a Leadership Role">Subordinate in a Leadership Role</option>
                                                        <option value="Provided Professional Development Support">Provided Professional Development Support</option>
                                                        <option value="Oversaw my Certification Process">Oversaw my Certification Process</option>
                                                        <option value="External Collaborator">External Collaborator</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                    <span id="reqreferencerel-1" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>You worked together at:</strong></label>
                                                    <input class="form-control worked_together worked_together-1" type="text" name="worked_together[]">
                                                    <span id="reqworked_together-1" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>What was your position when you worked with this referee?</strong></label>
                                                    <input class="form-control  position_with_referee position_with_referee-1" type="text" name="position_with_referee[]">
                                                    <span id="reqpositionreferee-1" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Start Date</strong></label>
                                                    <input class="form-control referee_start_date referee_start_date-1" type="date" name="start_date[]" onchange="startDate('1')" onkeydown="return false">
                                                    <span id="reqempsdate" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group level-drp working-1">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>End Date</strong></label>
                                                    <input class="form-control end_date end_date-1" type="date" name="end_date[]" onkeydown="return false">
                                                    <span id="reqrefereeedate-1" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                            <div class="declaration_box">
                                                <input class="still_working still_working-1" type="checkbox" name="still_working[]" onclick="stillWorking(1)">I'm still working with this referee
                                                <span id="reqstillworking-1" class="reqError text-danger valley"></span>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="add_new_certification_div mb-3 mt-3">
                                            <a style="cursor: pointer;" onclick="add_another_referee()">+ Add another Referee</a>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <button type="submit" class="btn btn-default  align-items-center justify-content-between">Next</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-3" id="tab-7" role="tabpanel">
                <?php $trainingdata =  $mandatorytrainingData;
                ?>
                <div class="row">
                    <div class=" w-100  overflow-hidden">
                        <div class="card-body p-3 px-md-4 pb-0">
                            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Mandatory Training</h3>
                        </div>
                        <form method="POST" id="edit_man_tra_form">
                            <input type="hidden" value="tab5" name="tab">
                            <input type="hidden" value="{{ $profileData->id }}" name="user_id">
                            <?php $trainingData = $mandatorytrainingData; ?>

                            <div class="card-body p-3 px-md-4">
                                <div class="col-md-12">
                                    <div class="row">
                                        <h6 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Completed training programs</h6>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Training Start Date</strong></label>
                                                <input class="form-control training_start_date" type="date" name="start_date" value="@if(!empty($trainingData)){{ $trainingData->start_date }}@endif" onchange="trainingStartDate(event);">
                                                <span id="reqempsdate" class="reqError text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Training End Date</strong></label>
                                                <input class="form-control training_end_date" type="date" name="end_date" value="@if(!empty($trainingData)){{ $trainingData->end_date }}@endif" onchange="trainingEndDate(event);">
                                                <span id="reqtrainingenddate" class="reqError text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Institution</strong></label>
                                                <input class="form-control" type="text" name="institution" value="@if(!empty($trainingData)){{ $trainingData->institutions }}@endif">
                                                <span id="institution_error_2" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Mandatory Continuing Education</strong></label>
                                                <select class="form-control form-select ps-5" name="mand_continue_education" id="mand_continue_education">
                                                    <option value="">Select mandatory continuing education</option>
                                                    <option value="Ongoing" @if(!empty($trainingData)) @if(!empty($trainingData->continuing_education == "Ongoing")) selected @endif @endif>Ongoing</option>
                                                    <option value="Completed" @if(!empty($trainingData)) @if(!empty($trainingData->continuing_education == "Completed")) selected @endif @endif>Completed</option>
                                                </select>
                                                <span id="mand_continue_education_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        {{-- <div class="add_new_certification_div mb-3 mt-3">
                                            <a style="cursor: pointer;" onclick="add_another_referee()">+ Add another Referee</a>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                    <button type="submit" class="btn btn-default next-step-61 align-items-center justify-content-between" data-target="#navpill-7">Next</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane p-3" id="tab-8" role="tabpanel">
                <div class="row">
                    <div class=" w-100  overflow-hidden">
                        <div class="card-body p-3 px-md-4 pb-0">
                            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Vaccinations</h3>
                        </div>
                        <form method="POST" id="edit_vacc_form">
                            <input type="hidden" value="tab6" name="tab">
                            <input type="hidden" value="{{ $profileData->id }}" name="user_id">
                            <div class="card-body p-3 px-md-4">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 mt-3">
                                            <input type="hidden" name="vaccination_r" class="vaccination_r" value="@if(!empty($vaccinationData)){{ $vaccinationData->vaccination_records }}@endif">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Vaccination Records</strong></label>
                                                <?php
                                                $vaccination_record = DB::table("vaccination")->get();
                                                ?>
                                                <ul id="vaccination_record" style="display:none;">
                                                    @foreach($vaccination_record as $v_record)
                                                    <li data-value="{{ $v_record->id }}">{{ $v_record->name }}</li>
                                                    @endforeach
                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="vaccination_record" name="vaccination_record[]" multiple="multiple"></select>
                                                <span id="vaccination_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Immunization Status</strong></label>
                                                <select class="form-control mr-10 select-active" name="immunization_status" id="immunization_status">
                                                    <option value="">Immunization Status</option>
                                                    <option value="Up-to-date" @if(!empty($vaccinationData)) @if($vaccinationData->immunization_status == "Up-to-date") selected @endif @endif>Up-to-date</option>
                                                    <option value="Pending" @if(!empty($vaccinationData)) @if($vaccinationData->immunization_status == "Pending") selected @endif @endif>Pending</option>
                                                </select>
                                                <span id="immunization_status_error" class="text-danger valley"></span>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <button type="submit" class="btn btn-default  align-items-center justify-content-between" data-target="#navpill-8">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-3" id="tab-9" role="tabpanel">
                <div class="row">
                    <form method="POST" id="work_clearances">
                        <div class="w-100  overflow-hidden">
                            <div class="card-body p-3 px-md-4 pb-0">
                                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Work Clearances</h3>
                            </div>
                            <input type="hidden" value="tab7" name="tab">
                            <input type="hidden" value="eligibility_work" name="type">
                            <input type="hidden" value="{{ $profileData->id }}" name="user_id">
                            <div class="card-body p-3 px-md-4">
                                <div class="col-md-12">
                                    <div class="row">
                                        <h6 class="mt-2 color-brand-1 mb-2">Eligibility To Work</h6>
                                        <a class="font-md color-text-paragraph-2" href="#">{{ env('APP_NAME') }} does not yet connect talent to sponsorship opportunities</a>
                                        @php
                                        // dd($eligibilityToWorkData);
                                        // $eligibilityToWorkData =clearances_data();
                                        @endphp
                                        <?php $valesidency = '';
                                        if (!empty($eligibilityToWorkData)) $valesidency = $eligibilityToWorkData->residency;
                                        ?>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Residency</strong></label>
                                                <select class="form-control" name="residency" id="residencyId">
                                                    <option value="">Select</option>
                                                    <option value="Citizen" {{ $valesidency == "Citizen" ? 'selected' : '' }}>Citizen</option>
                                                    <option value="Permanent Resident" {{ $valesidency == "Permanent Resident" ? 'selected' : '' }}>Permanent Resident</option>
                                                    <option value="Visa Holder" {{ $valesidency == "Visa Holder" ? 'selected' : '' }}>Visa Holder</option>
                                                </select>
                                                <span id="residency_error" class="text-danger reqError valley"></span>
                                            </div>
                                        </div>


                                        <div id="passport_detail" @if($valesidency !='null' && $valesidency=='Citizen' ) style="display:none;" @else style="display:none;" @endif>

                                            <div class="col-md-12 mt-3">
                                                <?php $valvisa_subclass_numbery = '';

                                                if ($eligibilityToWorkData != NULL) $valvisa_subclass_numbery = $eligibilityToWorkData->visa_subclass_number; ?>
                                                <div class="form-group">
                                                    <label class="d-flex gap-3 flex-wrap"><strong>Visa Subclass Number *</strong></label>
                                                    <input class="form-control" type="text" name="visa_subclass_number" id="visa_subclass_numberI" placeholder="" value="{{$valvisa_subclass_numbery }}">
                                                </div>
                                                <span id="visa_subclass_error" class="text-danger  reqError valley"></span>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <?php $passport_number = '';
                                                if ($eligibilityToWorkData != NULL) $passport_number = $eligibilityToWorkData->passport_number; ?>
                                                <div class="form-group ">
                                                    <label class="d-flex gap-3 flex-wrap"><strong>Passport Number *</strong></label>
                                                    <input class="form-control" type="text" name="passport_number" id="passport_numberI" placeholder="" value="{{ $passport_number }}">
                                                </div>
                                                <span id="passport_number_error" class="text-danger reqError valley"></span>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <div class="form-group position-relative">
                                                    <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                                                    <?php $countryumber = $profileData->country;
                                                    if ($eligibilityToWorkData != NULL) $countryumber = $eligibilityToWorkData->passport_country_of_Issue; ?>
                                                    <select class="form-control form-select ps-5" name="passport_country_of_Issue" id="passportcountryI">
                                                        <option value="">Select Country</option>
                                                        @php $country_data=country_name_from_db();@endphp
                                                        @foreach ($country_data as $data)
                                                        <option value="{{$data->id}}" <?= $countryumber == $data->id ? 'selected' : '' ?>> {{$data->name}} </option>
                                                        @endforeach
                                                    </select>
                                                    <span id="passport_country_error" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <?php $visa_grant_number = '';
                                                if ($eligibilityToWorkData != NULL) $visa_grant_number = $eligibilityToWorkData->visa_grant_number; ?>
                                                <div class="form-group ">
                                                    <label class="d-flex gap-3 flex-wrap"><strong>Visa Grant Number*</strong></label>
                                                    <input class="form-control" type="text" name="visa_grant_number" id="visa_grant_numberI" placeholder="" value="{{ $visa_grant_number }}">
                                                </div>
                                                <span id="visa_grant_error" class="reqError text-danger valley"></span>
                                            </div>
                                        </div>

                                        <div id="passport_detail_date" @if($valesidency !='Visa Holder' ) style="display:none;" @else style="display:none;" @endif>
                                            <div class="col-md-12 mt-3">
                                                <?php $expiry_data = '';
                                                if ($eligibilityToWorkData != NULL) $expiry_data = $eligibilityToWorkData->expiry_date; ?>
                                                <div class="form-group ">
                                                    <label class="d-flex gap-3 flex-wrap"><strong>Expiry Date*</strong></label>
                                                    <input class="form-control" type="date" name="expiry_date" id="expiry_dataI" value="{{ $expiry_data }}" min="{{ date('Y-m-d') }}">
                                                </div>
                                                <span id="expiry_date_error" class="reqError text-danger valley"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <?php
                                            if ($eligibilityToWorkData != NULL) {
                                                $valspecialimage = $eligibilityToWorkData->support_document;
                                                if ($valspecialimage != NULL && $valspecialimage != '') {
                                            ?>
                                                    <a href="{{ asset($valspecialimage) }}" target="_blank">

                                                        <span class="btn-primary badge badge-primary">Show</span>
                                                    </a>

                                            <?php
                                                }
                                            } else {
                                                $valspecialimage = '/nurse/assets/imgs/evidence_of_year_level1712557746.png';
                                            }
                                            ?>
                                            <div class="form-group ">
                                                <label class="d-flex gap-3 flex-wrap"><strong>Support Document*</strong></label>
                                                <input type="file" name="image_support_document" id="image_support_documentI" class="form-control h-100" accept="image/*">
                                            </div>
                                            <input type="hidden" value="{{ $valspecialimage}}" id="old_supp_doc">
                                            <span id="image_support_error" class="reqError text-danger valley"></span>
                                        </div>
                                        <?php
                                        if ($eligibilityToWorkData != NULL) {
                                            $valspecialimage = $eligibilityToWorkData->support_document;
                                            if ($valspecialimage != NULL && $valspecialimage != '') {
                                        ?>

                                                <a href="{{ asset($valspecialimage) }}" target="_blank" class="mt-3">
                                                    <img src="{{ asset($valspecialimage) }}" width="50px;" height="50px" />

                                                </a>

                                        <?php
                                            }
                                        } else {
                                            $valspecialimage = '/nurse/assets/imgs/evidence_of_year_level1712557746.png';
                                        }
                                        ?>

                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <button type="submit" class="btn btn-default eligibility_workttt align-items-center justify-content-between">Save</button>
                                        </div>
                                    </div>
                    </form>

                    <form method="post" id="work_with_children">
                        <input type="hidden" value="tab7" name="tab">
                        <input type="hidden" value="children_check" name="type">
                        <input type="hidden" value="{{ $profileData->id }}" name="user_id">
                        <div class="row mt-3">
                            <h6 class="mt-2 color-brand-1 mb-2">Working With Children Check</h6>
                            <a class="font-md color-text-paragraph-2" href="#">Add your state specific working with children clearance/s as required. Refer to your profile checklist</a>
                            <span class="btn-dark badge badge-dark">Optional</span>
                            <div class="col-md-12 mt-3">
                                <?php $clearance_number = '';
                                if ($workingChildrenCheckData != NULL) $clearance_number = $workingChildrenCheckData->clearance_number; ?>
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Clearance Number</strong></label>
                                    <input class="form-control" type="text" name="clearance_number" id="clearance_numberI" placeholder="" value="{{ $clearance_number }}">
                                    <span id="reqTxtclearance_numberI" class="text-danger reqError valley"></span>
                                </div>
                            </div>


                            <div id="passport_detail">
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">

                                        <label class="d-flex gap-3 flex-wrap"><strong>State *</strong></label>
                                        <select class="form-control form-select" name="clearance_state" id="clearancestateI" id="stateI">
                                            @php

                                            $state_data =state_list();

                                            @endphp
                                            <?php
                                            $state_data_child = $profileData->state;
                                            ?>
                                            @if(isset($state_data) && !empty($state_data))
                                            @foreach ($state_data as $data_state)
                                            <option value="{{$data_state->id}}" <?= $state_data_child  == $data_state->id ? 'selected' : '' ?>> {{$data_state->name}} </option>
                                            @endforeach
                                            @endif

                                        </select>
                                    </div>
                                    <span id="reqTxtclearancestateI" class="text-danger  reqError valley"></span>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <?php $workingexpiry_data = '';
                                    if ($workingChildrenCheckData != NULL) $workingexpiry_data = $workingChildrenCheckData->expiry_date; ?>
                                    <div class="form-group ">
                                        <label class="d-flex gap-3 flex-wrap"><strong>Expiry Date*</strong></label>
                                        <input class="form-control" type="date" name="clearance_expiry_date" id="clearance_expiry_dataI" value="{{ $workingexpiry_data }}" min="{{ date('Y-m-d') }}">
                                    </div>
                                    <span id="reqTxtclearance_expiry_dataI" class="text-danger reqError valley"></span>
                                </div>

                            </div>

                            <div class="d-flex align-items-center justify-content-between mt-3">
                                <button type="submit" class="btn btn-default children_check11 align-items-center justify-content-between" data-target="#navpill-8">Save</button>
                            </div>
                        </div>
                    </form>


                    <form method="POST" id="police_check">
                        <input type="hidden" value="tab7" name="tab">
                        <input type="hidden" value="police_check" name="type">
                        <input type="hidden" value="{{ $profileData->id }}" name="user_id">
                        <div class="row mt-3">
                            <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center">Police check</h4>
                            <a class="font-md color-text-paragraph-2" href="#">Add your national police check certificate, if you have one already. The recency of the check required, will depend on the role you want. Find work you want, to learn what’s required. The check must be for employment purposes. Volunteer checks will not be accepted</a>
                            <div><span class="btn-dark badge badge-dark">Optional</span> </div>
                            <div class=""><span class="btn-light badge badge-dark">Get new police check</span> <i class="fi fi-rr-info" onclick="get_new_plice_check()"></i></div>
                            <div class="">
                                <a href="https://secure.policecheckexpress.com.au/intercheck/landing/1389/507997" target="_blank">
                                    <span class="btn-secondary badge badge-secondary" target="_blank"><i class="fi fi-rr-info"></i> Get new police check </span>
                                </a>
                            </div>

                            <div class="col-md-12 mt-3">
                                <?php $date_acquired = '';

                                if ($policeCheckVerificationData !== null) {
                                    $date_acquired = $policeCheckVerificationData->date;
                                }
                                ?>
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Date Acquired*</strong></label>
                                    <input class="form-control" type="date" name="date_acquired" id="date_acquiredI" max="{{ date('Y-m-d') }}">
                                    <span id="reqTxtdate_acquiredI" class="text-danger reqError valley"></span>
                                </div>
                            </div>


                            <div class="col-md-12 mt-3">
                                <div class="form-group ">
                                    <label class="d-flex gap-3 flex-wrap"><strong>Police Check</strong></label>
                                    <input type="file" name="image_support_document_police" id="image_support_document_policeI" class="form-control" accept="image/*">
                                </div>
                                <span id="reqTxtimage_support_documentI" class="reqError text-danger valley"></span>
                            </div>
                            <?php
                            if ($policeCheckVerificationData !== null) {
                                $check_image = $policeCheckVerificationData->image;
                                if ($check_image != 'null' && $check_image != '') {
                            ?>

                                    <a href="{{ asset($check_image) }}" target="_blank" class="mt-3">
                                        <img src="{{ asset($check_image) }}" width="50px;" height="50px" />

                                    </a>

                            <?php
                                }
                            } else {
                                $check_image = '/nurse/assets/imgs/evidence_of_year_level1712557746.png';
                            }
                            ?>
                            <?php
                            if ($policeCheckVerificationData !== null) {
                                $status = $policeCheckVerificationData->status;
                                if ($status == '2') {

                                    echo  '<br> <div>Status:  <span class="btn-danger badge badge-danger">Rejected</span></div>';
                            ?>
                                    <input type="hidden" name="action" value="1">
                                    <div class="alert alert-danger mt-2" role="alert">Reason : Your Detail has been rejectd due
                                        <b> {{ $police_check_data->reason }} </b> . Please Resubmit the details.
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <label class="">
                                            <input class="float-start mr-5 mt-6" type="checkbox" id="confirmationCheckboxPoliceCheck"> Since I obtained this National Police Check, I confirm that there have been no changes to my criminal history, and that I have not been charged with an offence punishable by 12 months imprisonment or more, or convicted, pleaded guilty to, or found guilty of an offence punishable by imprisonment in Australia and/or overseas.
                                        </label>
                                        <span id="reqTxtconfirmationCheckboxPoliceCheckI" class="reqError text-danger valley"></span>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <button class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Re-Submit</span>
                                                <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </button>

                                        </div>
                                    </div>
                                <?php    } elseif ($status == '0') {
                                    echo  '<div> Status: <span class="btn-warning badge badge-warning">Pending</span> </div>';
                                    echo ' <div class="alert alert-warning mt-2 " role="alert">
                                                                Your request has been successfully submitted.Its in pending state, We will back to you as soon as possible.
                                                        </div>';
                                } elseif ($status == '1') {
                                    echo  '<div>Status: <span class="btn-success badge badge-success">Approved</span> </div>';
                                } else {
                                ?>


                                    <div class="d-flex align-items-center justify-content-between">
                                        <button class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Save</span>
                                            <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </button>
                                    </div><?php
                                        }
                                    } else {
                                            ?>
                                <div class="col-lg-12 col-md-12 declaration_box mb-3">
                                    <input type="checkbox" id="confirmationCheckboxPoliceCheck">
                                    <label class="">Since I obtained this National Police Check, I confirm that there have been no changes to my criminal history, and that I have not been charged with an offence punishable by 12 months imprisonment or more, or convicted, pleaded guilty to, or found guilty of an offence punishable by imprisonment in Australia and/or overseas.
                                    </label>
                                    <span id="reqTxtconfirmationCheckboxPoliceCheckI" class="reqError text-danger valley"></span>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Save</span>
                                            <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </button>

                                    </div>
                                </div>
                            <?php

                                    }
                            ?>

                            {{-- <div class="col-md-12 mt-3">
                                            <label class="ml-20">
                                            <input class="float-start mr-5 mt-6" type="checkbox" id="confirmationCheckboxPoliceCheck"> Since I obtained this National Police Check, I confirm that there have been no changes to my criminal history, and that I have not been charged with an offence punishable by 12 months imprisonment or more, or convicted, pleaded guilty to, or found guilty of an offence punishable by imprisonment in Australia and/or overseas.
                                            </label>
                                              <span id="reqTxtconfirmationCheckboxPoliceCheckI" class="reqError text-danger valley"></span>
                                            </div> --}}

                            {{-- <div class="d-flex align-items-center justify-content-between mt-3">
                                              <button type="button" class="btn btn-default police_check align-items-center justify-content-between" data-target="#navpill-9">Save</button>
                                            </div>  --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="tab-pane p-3" id="tab-10" role="tabpanel">
    <form method="POST" id="profess_membership">
        <input type="hidden" value="tab8" name="tab">
        <input type="hidden" value="{{ $profileData->id }}" name="user_id">
        <div class="row">
            <div class=" w-100  overflow-hidden">
                <div class="card-body p-3 px-md-4 pb-0">
                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Professional Memberships</h3>
                </div>
                <div class="card-body p-3 px-md-4">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <input type="hidden" name="professional_as" class="professional_as" value="@if(!empty($proMembershipData)){{ $proMembershipData->des_profession_association }}@endif">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Professional Associations</strong></label>
                                    <ul id="des_profession_association" style="display:none;">
                                        <li data-value="ANA">ANA</li>
                                        <li data-value="ENA">ENA</li>
                                    </ul>
                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="des_profession_association" name="des_profession_association[]" multiple="multiple"></select>
                                    <span id="des_profession_error" class="text-danger valley"></span>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Membership Numbers</strong></label>
                                    <input type="text" name="membership_numbers" class="form-control" id="membership_numbers" value="@if(!empty($proMembershipData)){{ $proMembershipData->membership_numbers }}@endif">
                                    <span id="membership_numbers_error" class="reqError text-danger valley"></span>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Status</strong></label>
                                    <select class="form-control" name="membership_status" id="membership_status">
                                        <option value="Active" @if(!empty($proMembershipData) && $proMembershipData->membership_status == "Active") selected @endif>Active</option>
                                        <option value="Lapsed" @if(!empty($proMembershipData) && $proMembershipData->membership_status == "Lapsed") selected @endif>Lapsed</option>
                                    </select>
                                    <span id="membership_status_error" class="reqError text-danger valley"></span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-3">
                                <button type="submit" class="btn btn-default next-step-91 align-items-center justify-content-between" data-target="#navpill-10">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="tab-pane p-3" id="tab-11" role="tabpanel">
    <form method="POST" id="interview_form">
        <input type="hidden" value="tab9" name="tab">
        <input type="hidden" value="{{ $profileData->id }}" name="user_id">
        <div class="row">
            <div class=" w-100  overflow-hidden">
                <div class="card-body p-3 px-md-4 pb-0">
                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Interview</h3>
                </div>
                <div class="card-body p-3 px-md-4">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Interview Availability</strong></label>
                                    <input type="datetime-local" name="interview_availablity" class="form-control" value="@if(!empty($interviewrefData)){{ $interviewrefData->interview_availablity }}@endif" id="interview_availablity">
                                    <span id="reqinterviewdate" class="reqError text-danger valley"></span>
                                </div>
                            </div>

                            <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Professional References</h4>

                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Names</strong></label>
                                    <input type="text" name="reference_name" class="form-control" value="@if(!empty($interviewrefData)){{ $interviewrefData->reference_name }}@endif" id="reference_name">
                                    <span id="reqprofessionalnames" class="reqError text-danger valley"></span>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Email</strong></label>
                                    <input type="text" name="reference_email" class="form-control" id="reference_email" value="@if(!empty($interviewrefData)){{ $interviewrefData->reference_email }}@endif">
                                    <span id="reqprofessionalemail" class="reqError text-danger valley"></span>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Mobile Number *</strong></label>
                                    <div class="mob-adj">
                                        <input type="hidden" name="reference_countryCode" id="reference_countryCode">
                                        <input type="hidden" name="reference_countryiso" id="reference_countryiso" value="">
                                        <input class="form-control numbers" type="tel" name="reference_contact" id="reference_contactI" value="@if(!empty($interviewrefData)){{ $interviewrefData->reference_contact }}@endif" maxlength="10" style="padding-right: 20rem">
                                        <span id="reqTxtreferencecontactI" class="reqError text-danger valley"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Relationship</strong></label>
                                    <select class="form-control form-select ps-5" name="reference_relationship" id="reference_relationship">
                                        <option value="">Select Relationship</option>
                                        <option value="Mother" @if(!empty($interviewrefData)) @if(!empty($interviewrefData->reference_relationship == "Mother")) selected @endif @endif>Mother</option>
                                        <option value="Father" @if(!empty($interviewrefData)) @if(!empty($interviewrefData->reference_relationship == "Father")) selected @endif @endif>Father</option>
                                        <option value="Brother" @if(!empty($interviewrefData)) @if(!empty($interviewrefData->reference_relationship == "Brother")) selected @endif @endif>Brother</option>
                                        <option value="Sister" @if(!empty($interviewrefData)) @if(!empty($interviewrefData->reference_relationship == "Sister")) selected @endif @endif>Sister</option>
                                        <option value="Cousin" @if(!empty($interviewrefData)) @if(!empty($interviewrefData->reference_relationship == "Cousin")) selected @endif @endif>Cousin</option>
                                        <option value="Uncle" @if(!empty($interviewrefData)) @if(!empty($interviewrefData->reference_relationship == "Uncle")) selected @endif @endif>Uncle</option>
                                        <option value="Aunt" @if(!empty($interviewrefData)) @if(!empty($interviewrefData->reference_relationship == "Aunt")) selected @endif @endif>Aunt</option>
                                    </select>
                                    <span id="reqprofessionalrelationship" class="reqError text-danger valley"></span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-3">
                                <button type="submit" class="btn btn-default next-step-1044 align-items-center justify-content-between" data-target="#navpill-11">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="tab-pane p-3" id="tab-12" role="tabpanel">
    <div class="row">
        <form id="personal_pre_form" method="POST">
            <input type="hidden" value="tab10" name="tab">
            <input type="hidden" value="{{ $profileData->id }}" name="user_id">
            <div class=" w-100  overflow-hidden">
                <div class="card-body p-3 px-md-4 pb-0">
                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Personal Preferences</h3>
                </div>
                <div class="card-body p-3 px-md-4">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Preferred Work Schedule</strong></label>
                                    <select class="form-control form-select ps-5" name="preferred_work_schedule" id="preferred_work_schedule">
                                        <option value="">Select preferred work schedule</option>
                                        <option value="Full-time" @if(!empty($personalprefData)) @if(!empty($personalprefData->preferred_work_schedule == "Full-time")) selected @endif @endif>Full-time</option>
                                        <option value="Part-time" @if(!empty($personalprefData)) @if(!empty($personalprefData->preferred_work_schedule == "Part-time")) selected @endif @endif>Part-time</option>
                                        <option value="Shift preferences" @if(!empty($personalprefData)) @if(!empty($personalprefData->preferred_work_schedule == "Shift preferences")) selected @endif @endif>Shift preferences</option>
                                    </select>
                                    <span id="reqpreferecschedule" class="reqError text-danger valley"></span>
                                </div>
                            </div>

                            <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Preferred Work Locations</h4>

                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Country</strong></label>
                                    <select class="form-control form-select ps-5" name="country" id="countryworkprefer">
                                        <option value="">Select Country</option>
                                        @php $country_data=country_name_from_db();@endphp

                                        @foreach ($country_data as $data)
                                        <option value="{{$data->iso2}}" @if(!empty($personalprefData))@if($personalprefData->country == $data->iso2) selected @endif @endif> {{$data->name}} </option>
                                        @endforeach
                                    </select>
                                    <span id="reqprecountry" class="reqError text-danger valley"></span>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>State *</strong></label>
                                    <select class="form-control form-select ps-5" name="state" id="stateworkprefer">
                                        @php
                                        if(isset( $personalprefData->country)){
                                        $state_data =state_name_array($personalprefData->country);
                                        }else{
                                        $state_data = '';
                                        }
                                        @endphp
                                        @if(isset($state_data) && !empty($state_data))
                                        @foreach ($state_data as $data_state)
                                        <option value="{{$data_state->id}}" <?= isset($personalprefData->state) &&  $personalprefData->state  == $data_state->id ? 'selected' : '' ?>> {{$data_state->name}} </option>
                                        @endforeach
                                        @endif

                                    </select>
                                    <span id="reqprestateI" class="reqError text-danger valley"></span>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Specific Facilities</strong></label>
                                    <textarea name="specific_facilities" class="form-control" id="specific_facilities">@if(!empty($personalprefData)){{ $personalprefData->specific_facilities }}@endif</textarea>
                                    <span id="reqspecificfacilities" class="reqError text-danger valley"></span>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Work Environment Preferences</strong></label>
                                    <select class="form-control form-select ps-5" name="work_environment" id="work_environment">
                                        <option value="">Select Work Environment Preferences</option>
                                        <option value="Hospital" @if(!empty($personalprefData)) @if(!empty($personalprefData->work_environment == "Hospital")) selected @endif @endif>Hospital</option>
                                        <option value="Clinic" @if(!empty($personalprefData)) @if(!empty($personalprefData->work_environment == "Clinic")) selected @endif @endif>Clinic</option>
                                        <option value="Home Health" @if(!empty($personalprefData)) @if(!empty($personalprefData->work_environment == "Home Healt")) selected @endif @endif>Home Health</option>
                                    </select>
                                    <span id="reqworkenvironement" class="reqError text-danger valley"></span>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Shift Preferences</strong></label>
                                    <select class="form-control form-select ps-5" name="shift_preferences" id="shift_preferences">
                                        <option value="">Select Shift Preferences</option>
                                        <option value="Day" @if(!empty($personalprefData)) @if(!empty($personalprefData->shift_preferences == "Day")) selected @endif @endif>Day</option>
                                        <option value="Clinic" @if(!empty($personalprefData)) @if(!empty($personalprefData->shift_preferences == "Evening")) selected @endif @endif>Evening</option>
                                        <option value="Night" @if(!empty($personalprefData)) @if(!empty($personalprefData->shift_preferences == "Night")) selected @endif @endif>Night</option>
                                    </select>
                                    <span id="reqshiftpreferences" class="reqError text-danger valley"></span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-3">
                                <button type="submit" class="btn btn-default next-step-11444 align-items-center justify-content-between" data-target="#navpill-12">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="tab-pane p-3" id="tab-13" role="tabpanel">
    <div class="row">
        <form method="POST" id="job_serach_form">
            <input type="hidden" value="tab11" name="tab">
            <input type="hidden" value="{{ $profileData->id }}" name="user_id">
            <div class=" w-100  overflow-hidden">
                <div class="card-body p-3 px-md-4 pb-0">
                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Job Search Preferences</h3>
                </div>
                <div class="card-body p-3 px-md-4">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <input type="hidden" name="desired_job_roles" class="desired_job_roles" value="@if(!empty($findworkData)){{ $findworkData->desired_job_role }}@endif">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Desired Job Roles</strong></label>
                                    <?php
                                    $practitioner_type = DB::table("practitioner_type")->get();
                                    ?>
                                    <ul id="des_job_role" style="display:none;">
                                        @foreach($practitioner_type as $cert)
                                        <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                                        @endforeach
                                    </ul>
                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="des_job_role" name="des_job_role[]" multiple="multiple"></select>
                                    <span id="reqjobroles" class="reqError text-danger valley"></span>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Salary Expectations</strong></label>
                                    <input type="text" name="salary_expectation" class="form-control" id="salary_expectation" value="@if(!empty($findworkData)){{ $findworkData->salary_expectations }}@endif">
                                    <span id="reqsalaryexp" class="reqError text-danger valley"></span>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Benefits Preferences</strong></label>
                                    <input type="hidden" name="benefit_preferences" class="benefit_preferences" value="@if(!empty($findworkData)){{ $findworkData->benefits_preferences }}@endif">
                                    <ul id="benefit_prefer" style="display:none;">
                                        <li data-value="Health insurance">Health insurance</li>
                                        <li data-value="Retirement plans">Retirement plans</li>
                                    </ul>
                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="benefit_prefer" name="benefit_prefer[]" multiple="multiple"></select>
                                    <span id="reqbenefitsprefer" class="reqError text-danger valley"></span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-3">
                                <button type="submit" class="btn btn-default next-step-124 align-items-center justify-content-between" data-target="#navpill-14">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="tab-pane p-3" id="navpill-14" role="tabpanel">
    <div class="row">
        <div class=" w-100  overflow-hidden">
            <div class="card-body p-3 px-md-4 pb-0">
                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Additional Information</h3>
            </div>
            <div class="card-body p-3 px-md-4">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Languages Spoken</strong></label>
                                <select class="form-control" name="additional_info_language" id="language-picker-select">
                                    <option lang="de" value="deutsch">Deutsch</option>
                                    <option lang="en" value="english">English</option>
                                    <option lang="fr" value="francais">Français</option>
                                    <option lang="it" value="italiano">Italiano</option>
                                </select>
                                <span id="reqinfolanguage" class="reqError text-danger valley"></span>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Volunteer Experience</strong></label>
                                <input type="text" name="volunteer_experience" class="form-control" value="" id="volunteer_experience">
                                <span id="reqvolexp" class="reqError text-danger valley"></span>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Hobbies and Interests</strong></label>
                                <textarea name="hobbies_interests" class="form-control"></textarea>
                                <span id="reqhobbiesint" class="reqError text-danger valley"></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <button type="button" class="btn btn-default next-step-14 align-items-center justify-content-between" data-target="#navpill-14">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
{{-- </form> --}}
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

        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("tab");
        if (c == "tab-3") {

            $(".tab-pane").hide();
            
            $("#tab-3").show();
            $(".nav-link").removeClass("active");
            $("#profession_link").addClass("active");

        }

        if (c == "tab-1") {
            
            $(".tab-pane").hide();
            
            $("#tab-1").show();
            $(".nav-link").removeClass("active");
            $("#basic_details_link").addClass("active");

        }

        if (c == "tab-4") {
            
            $(".tab-pane").hide();
            
            $("#tab-4").show();
            $(".nav-link").removeClass("active");
            $("#edu_cert_link").addClass("active");

        }

        if (c == "tab-6") {
            
            $(".tab-pane").hide();
            
            $("#tab-6").show();
            $(".nav-link").removeClass("active");
            $("#references_link").addClass("active");

        }
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


    function deleteImg(i, user_id, img) {
        //alert(img);    
        $.ajax({
            type: "post",
            url: "{{ route('admin.delete_cer_img') }}",
            data: {
                user_id: user_id,
                img: img,
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

    var referee_div_count = $(".referee_no").length;

    function add_another_referee() {
        referee_div_count++;
        // $(".reference_form").append('<div class="referee_data referee_data-'+referee_div_count+'"><h6 class="mt-0 color-brand-1 mb-20 referee_no">References '+referee_div_count+'</h6><div class="row"><div class="col-md-12"><div class="form-group level-drp"><label class="form-label" for="input-1">First name</label><input class="form-control first_name first_name-'+referee_div_count+'" type="text" name="first_name[]"><span id="reqfname-'+referee_div_count+'" class="reqError text-danger valley"></span></div></div><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">Last name</label><input class="form-control last_name last_name-'+referee_div_count+'" type="text" name="last_name[]"><span id="reqlname-'+referee_div_count+'" class="reqError text-danger valley"></span></div></div></div><div class="row"><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">Email</label><input class="form-control reference_email reference_email-'+referee_div_count+'" type="text" name="email[]"><span id="reqemail-'+referee_div_count+'" class="reqError text-danger valley"></span></div></div><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">Phone number</label><input class="form-control phone_no phone_no-'+referee_div_count+'" type="text" name="phone_no[]"><span id="reqphoneno-'+referee_div_count+'" class="reqError text-danger valley"></span></div></div></div><div class="row"><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">Relationship</label><select class="form-control reference_relationship reference_relationship-'+referee_div_count+'" name="reference_relationship[]"><option value="" data-select2-id="9">Select Reference Relationship</option><option value="Brother">Brother</option><option value="Sister">Sister</option><option value="Sister">Cousin</option></select><span id="reqreferencerel-'+referee_div_count+'" class="reqError text-danger valley"></span></div></div><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">You worked together at:</label><input class="form-control worked_together worked_together-'+referee_div_count+'" type="text" name="worked_together[]"><span id="reqworked_together-'+referee_div_count+'" class="reqError text-danger valley"></span></div></div></div><div class="row"><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">What was your position when you worked with this referee?</label><input class="form-control position_with_referee position_with_referee-'+referee_div_count+'" type="text" name="position_with_referee[]"><span id="reqpositionreferee-'+referee_div_count+'" class="reqError text-danger valley"></span></div></div></div><div class="row"><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">Start Date</label><input class="form-control start_date start_date-'+referee_div_count+'" type="date" name="start_date[]" onchange="startDate('+referee_div_count+')" onkeydown="return false"><span id="reqrefereesdate-'+referee_div_count+'" class="reqError text-danger valley"></span><div class="declaration_box"><input class="still_working still_working-'+referee_div_count+'" type="checkbox" name="still_working[]" onclick="stillWorking('+referee_div_count+')">I am still working with this referee<span id="reqstillworking-'+referee_div_count+'" class="reqError text-danger valley"></span></div></div></div><div class="col-md-6"><div class="form-group level-drp working-'+referee_div_count+'"><label class="form-label" for="input-1">End Date</label><input class="form-control end_date end_date-'+referee_div_count+'" type="date" name="end_date[]" onkeydown="return false"><span id="reqrefereeedate-'+referee_div_count+'" class="reqError text-danger valley"></span></div></div><div class="row"><div class="col-md-6"><div class="add_new_certification_div mb-3 mt-3"><a style="cursor: pointer;" onclick="delete_reference1('+referee_div_count+')">- Delete Referee</a></div></div></div></div>');   
        $(".reference_form").append('<div class="referee_data referee_data-' + referee_div_count + '"><h6 class="mt-0 color-brand-1 mb-20 referee_no">References ' + referee_div_count + '</h6><div><div class="col-md-12 mt-3"><div class="form-group level-drp"><label class="d-flex gap-3 flex-wrap" for="input-1"><strong>First name</strong></label><input class="form-control first_name first_name-' + referee_div_count + '" type="text" name="first_name[]"><span id="reqfname-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div><div class="col-md-12 mt-3"><div class="form-group level-drp"><label class="d-flex gap-3 flex-wrap" for="input-1"><strong>Last name</strong></label><input class="form-control last_name last_name-' + referee_div_count + '" type="text" name="last_name[]"><span id="reqlname-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div></div><div><div class="col-md-12"><div class="form-group level-drp"><label class="d-flex gap-3 flex-wrap" for="input-1"><strong>Email</strong></label><input class="form-control reference_email reference_email-' + referee_div_count + '" type="text" name="email[]"><span id="reqemail-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div><div class="col-md-12"><div class="form-group level-drp"><label class="d-flex gap-3 flex-wrap" for="input-1"><strong>Phone number</strong></label><input class="form-control phone_no phone_no-' + referee_div_count + '" type="text" name="phone_no[]"><span id="reqphoneno-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div></div><div><div class="col-md-12 mt-3"><div class="form-group level-drp"><label class="d-flex gap-3 flex-wrap" for="input-1"><strong>Relationship</strong></label><select class="form-control reference_relationship reference_relationship-' + referee_div_count + '" name="reference_relationship[]"><option value="" data-select2-id="9">Select Reference Relationship</option><option value="Brother">Brother</option><option value="Sister">Sister</option><option value="Sister">Cousin</option></select><span id="reqreferencerel-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div><div class="col-md-12 mt-3"><div class="form-group level-drp"><label class="d-flex gap-3 flex-wrap" for="input-1"><strong>You worked together at:</strong></label><input class="form-control worked_together worked_together-' + referee_div_count + '" type="text" name="worked_together[]"><span id="reqworked_together-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div></div><div><div class="col-md-12 mt-3"><div class="form-group level-drp"><label class="d-flex gap-3 flex-wrap" for="input-1"><strong>What was your position when you worked with this referee?</strong></label><input class="form-control position_with_referee position_with_referee-' + referee_div_count + '" type="text" name="position_with_referee[]"><span id="reqpositionreferee-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div></div><div><div class="col-md-12 mt-3"><div class="form-group level-drp"><label class="d-flex gap-3 flex-wrap" for="input-1"><strong>Start Date</strong></label><input class="form-control start_date start_date-' + referee_div_count + '" type="date" name="start_date[]" onchange="startDate(' + referee_div_count + ')" onkeydown="return false"><span id="reqrefereesdate-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div><div class="col-md-12 mt-3"><div class="form-group level-drp working-' + referee_div_count + '"><label class="d-flex gap-3 flex-wrap" for="input-1"><strong>End Date</strong></label><input class="form-control end_date end_date-' + referee_div_count + '" type="date" name="end_date[]" onkeydown="return false"><span id="reqrefereeedate-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div><div><div class="declaration_box"><input class="still_working still_working-' + referee_div_count + '" type="checkbox" name="still_working[]" onclick="stillWorking(' + referee_div_count + ')">I am still working with this referee<span id="reqstillworking-' + referee_div_count + '" class="reqError text-danger valley"></span></div><div class="col-md-12 mt-3"><div class="add_new_certification_div mb-3"><a style="cursor: pointer;" onclick="delete_reference1(' + referee_div_count + ')">- Delete Referee</a></div></div></div></div>');
    }

    function delete_reference1(i) {
        $(".referee_data-" + i).remove();
    }

    var i = 1;
    $(".referee_start_date").each(function() {
        console.log("start_date", $(".referee_start_date-" + i).val());
        var start_date = $(".referee_start_date-" + i).val();

        var date = new Date(start_date);

        date.setDate(date.getDate() + 1);


        var start_date1 = new Date(date);
        var month = start_date1.getMonth() + 1;
        if (month.toString().length == 1) {
            var month1 = "0" + month;
        } else {
            var month1 = month;
        }
        var day = start_date1.getDate();

        if (day.toString().length == 1) {

            var day1 = "0" + day;

        } else {

            var day1 = day;

        }
        var year = start_date1.getFullYear();
        var new_date = year + "-" + month1 + "-" + day1;
        console.log("refree_start_date", $('.working-' + i).is(':visible'));
        if ($('.working-' + i).is(':visible')) {
            document.getElementsByClassName("end_date-" + i)[0].setAttribute('min', new_date);
        }
        i++;
    });

    function stillWorking(i) {
        if ($(".still_working-" + i).prop('checked') == true) {
            $(".working-" + i).hide();
        } else {
            $(".working-" + i).show();
            $(".end_date-" + i).val("");
        }
    }

    function startDate(i) {
        //alert(i);
        var start_date = $(".start_date-" + i).val();
        console.log("start_date", $(".start_date-" + i).val());
        var date = new Date(start_date);

        date.setDate(date.getDate() + 1);


        var start_date1 = new Date(date);
        var month = start_date1.getMonth() + 1;
        if (month.toString().length == 1) {
            var month1 = "0" + month;
        } else {
            var month1 = month;
        }
        var day = start_date1.getDate();

        if (day.toString().length == 1) {

            var day1 = "0" + day;

        } else {

            var day1 = day;

        }
        var year = start_date1.getFullYear();
        var new_date = year + "-" + month1 + "-" + day1;
        console.log("refree_start_date", new_date);
        document.getElementsByClassName("end_date-" + i)[0].setAttribute('min', new_date);
    }
</script>
<script type="text/javascript">
    function trainingEndDate(e) {
        var end_date = e.target.value;
        var start_date = $('.training_start_date').val();

        if (end_date < start_date) {
            $("#reqtrainingenddate").html("End date should not less than start date");
        } else {
            if (end_date == start_date) {
                $("#reqtrainingenddate").html("End date should not equal to start date");
            } else {
                $("#reqtrainingenddate").html("");
            }

        }

    }
    var start_date = $('.training_start_date').val();

    var date = new Date(start_date);



    // Add five days to current date
    date.setDate(date.getDate() + 1);
    var date1 = new Date(date);


    //var str = date1.toLocaleDateString();
    var year_val = `${date1.getFullYear()}`;
    var month_val = `${date1.getMonth() + 1}`;
    var date_val = `${date1.getDate()}`;

    var month_len = month_val.length;
    if (month_len < 2) {
        var show_month = 0 + month_val;
    } else {
        var show_month = month_val;
    }
    const formattedDate2 = year_val + "-" + show_month + "-" + date_val;
    // console.log("month_val",formattedDate);

    // jQuery equivalent
    $(".training_end_date").eq(0).attr("min", formattedDate2);

    function trainingStartDate(e) {
        var start_date = e.target.value;
        var date = new Date(start_date);
        // Add five days to current date
        date.setDate(date.getDate() + 1);
        var date1 = new Date(date);


        //var str = date1.toLocaleDateString();
        var year_val = `${date1.getFullYear()}`;
        var month_val = `${date1.getMonth() + 1}`;
        var date_val = `${date1.getDate()}`;

        var month_len = month_val.length;
        if (month_len < 2) {
            var show_month = 0 + month_val;
        } else {
            var show_month = month_val
        }
        const formattedDate = year_val + "-" + show_month + "-" + date_val;
        // console.log("month_val",formattedDate);

        document.getElementsByClassName("training_end_date")[0].setAttribute('min', formattedDate);
    }
</script>

@include('admin.edit_script');

@endsection