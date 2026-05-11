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
    <div class="back_arrow" onclick="history.back()" title="Go Back">
        <i class="fa fa-arrow-left"></i>
    </div>
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
                                        <div class="upload-pic">
                                            <div class="mt-35 mb-40 box-info-profie d-flex align-items-center upload_image">

                                                <div class="image-profile">
                                                    <img alt="" id="profileImage" style="object-fit:cover;border-radius: 16px;display: block;width: 85px;height: 85px;" src="{{asset('assets/admin/dist/images/profile/nurse06.png')}}">
                                                    <div class="position-relative overflow-hidden">
                                                        <a class="btn btn-apply" id="uploadButton">Upload Avatar</a>
                                                        <input type="file" name="profile_image" id="profile_image" class="position-absolute h-100" accept="image/*" style="top: 0;left: 0;opacity: 0;cursor: pointer;">
                                                        <i class="fa fa-spinner fa-spin" id="preloadeer-active" style="display:none" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <span id="profile_image_error" class="reqError text-danger valley "></span>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>First Name</strong></label>
                                                <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name">
                                                <span id="first_name_error" class="reqError text-danger valley "></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Last Name</strong></label>
                                                <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name">
                                                <span id="last_name_error" class="reqError text-danger valley "></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Email Address</strong></label>
                                                <input type="text" class="form-control" placeholder="Email Address" name="email" id="email">
                                                <span id="email_error" class="reqError text-danger valley "></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3 phone--drpdwns">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Phone Number</strong></label>
                                                <input type="hidden" value="" name="country_code" id="country_code_phone">
                                                <input type="hidden" value="" name="country_name" id="country_name_phone">
                                                <input type="hidden" value="" name="country_iso" id="country_iso_phone">
                                                <input class="form-control numbers" type="tel" required="" name="contact" id="contact" placeholder="1234567890" placeholder="1234567890" maxlength="10" pattern="[0-9]{4}" style="width: ">
                                                <span id="contact_error" class="reqError text-danger valley "></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Date of Birth</strong></label>
                                                <input type="date" class="form-control" placeholder="Date of Birth" name="dob" id="dob">
                                                <span id="date_error" class="reqError text-danger valley "></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="gender" class="d-flex gap-3 flex-wrap"><strong>Gender</strong></label>
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male">
                                                        <label class="form-check-label" for="genderMale">
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female">
                                                        <label class="form-check-label" for="genderFemale">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>
                                                <span id="genderErr" class="reqError text-danger valley "></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Nationality</strong></label>
                                                <select name="nationality" class="form-control form-select ps-5" id="nationality">
                                                    <option value="">Select Nationality</option>
                                                    @php $country_data=country_name_from_db();@endphp
                                                    @foreach ($country_data as $data)
                                                    <option value="{{ $data->professionalcert_id }}" <?= isset(Auth::guard('nurse_middle')->user()->nationality) &&  Auth::guard('nurse_middle')->user()->nationality == $data->professionalcert_id ? 'selected' : '' ?>>{{ $data->nationality }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Personal website</strong></label>
                                                <input class="form-control" type="url" required="" name="per_website" id="per_website" placeholder="Personal website">
                                                <span id="per_website_error" class="reqError text-danger valley "></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Country</strong></label>
                                                <select class="form-control form-select ps-5" name="country" id="countryI">
                                                    <option value="">Select Country</option>
                                                    @php $country_data=country_name_from_db();@endphp
                                                    @foreach ($country_data as $data)
                                                    <option value="{{$data->iso2}}" <?= isset(Auth::guard('nurse_middle')->user()->country) &&  Auth::guard('nurse_middle')->user()->country == $data->iso2 ? 'selected' : '' ?>> {{$data->name}} </option>
                                                    @endforeach
                                                </select>
                                                <span id="country_error" class="reqError text-danger valley "></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>State</strong></label>
                                                <select class="form-control form-select ps-5" name="state" id="stateI" id="stateI">
                                                    @php
                                                    if(isset( Auth::guard('nurse_middle')->user()->country)){
                                                    $state_data =state_name_array( Auth::guard('nurse_middle')->user()->country);
                                                    }else{
                                                    $state_data = '';
                                                    }
                                                    @endphp

                                                    @if(isset($state_data) && !empty($state_data))
                                                    @foreach ($state_data as $data_state)
                                                    <option value="{{$data_state->id}}" <?= isset(Auth::guard('nurse_middle')->user()->state) &&  Auth::guard('nurse_middle')->user()->state  == $data_state->id ? 'selected' : '' ?>> {{$data_state->name}} </option>
                                                    @endforeach
                                                    @endif

                                                </select>
                                                <span id="state_error" class="reqError text-danger valley "></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>City</strong></label>
                                                <input class="form-control" type="text" required="" name="city" id="city" placeholder="City">
                                                <span id="city_error" class="reqError text-danger valley "></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Zip code</strong></label>
                                                <input class="form-control" type="text" required="" name="zip_code" id="zip_code" placeholder="Zip code">
                                                <span id="zip_code_error" class="reqError text-danger valley "></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Home Address</strong></label>
                                                <input class="form-control" type="text" required="" name="home_address" id="home_address" placeholder="Home Address">
                                                <span id="home_address_error" class="reqError text-danger valley "></span>
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
                                                <input type="hidden" value="" name="emr_county_code" id="country_code_mobile">
                                                <input type="hidden" value="" name="emr_country_name" id="country_name_mobile">
                                                <input type="hidden" value="" name="emr_country_iso" id="country_iso_mobile">
                                                <input class="form-control numbers" type="tel" required="" name="emrg_contact" id="emrg_contact" placeholder="1234567890" placeholder="1234567890" maxlength="10" pattern="[0-9]{4}" style="width: ">
                                                <span id="emrg_contact_error" class="reqError text-danger valley "></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Email</strong></label>
                                                <input type="text" class="form-control" id="emrg_email" name="emrg_email" placeholder="Email" accept="image/*">
                                                <span id="emrg_email_error" class="reqError text-danger valley "></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <button type="button" class="btn btn-default next-step-1 align-items-center justify-content-between" data-target="#navpill-2">Next</button>
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
                                                <input class="form-check-input" type="checkbox" value="1" id="visibleToMedicalFacilities">
                                                <label class="form-check-label" for="visibleToMedicalFacilities">
                                                    Visible to Healthcare Facilities
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" value="1" id="visibleToAgencies" name="agencies">
                                                <label class="form-check-label" for="visibleToAgencies">
                                                    Visible to Agencies
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <input class="form-check-input" type="checkbox" value="1" id="visibleToIndividuals" name="individuals">
                                                <label class="form-check-label" for="visibleToAgencies">
                                                    Visible to Individuals (Nurse care at home)
                                                </label>
                                            </div>
                                        </div>

                                        <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Profile Status:</h4>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <input class="form-check-input" type="radio" value="1" id="availableNow" name="profile_status">
                                                <label class="form-check-label" for="availableNow">
                                                    Available Now
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <input class="form-check-input" type="radio" value="0" id="unavailableNow" name="profile_status">
                                                <label class="form-check-label" for="unavailableNow">
                                                    Unavailable for now
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3 available_date_field d-none">
                                            <div class="form-group">
                                                <label for="gender" class="d-flex gap-3 flex-wrap"><strong>When are you able to start?</strong></label>
                                                <input type="date" name="available_date" class="form-control">
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <button type="button" class="btn btn-default next-step-2 align-items-center justify-content-between" data-target="#navpill-3">Next</button>
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
                            <form method="POST" id="professs_form" data-target="#navpill-4">
                                @csrf
                                <input type="hidden" name="tab" value="tab2">
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
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
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="type-of-nurse" name="states[]" multiple="multiple" id="type_nurse"></select>
                                                    <span id="reqnurseTypeId" class="reqError text-danger valley "></span>
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
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nursing_entry-{{ $i }}" name="nursing_type_{{ $i }}[]" multiple="multiple"></select>
                                                    <span id="photo_id" class="reqError text-danger valley "></span>
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
                                                    <span id="photo_id" class="reqError text-danger valley "></span>
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
                                                    <span id="specialties_error" class="reqError text-danger valley "></span>
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
                                                        @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                                                            @endfor
                                                    </select>
                                                    <span id="experience_error" class="reqError text-danger valley "></span>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Current Employment Status</strong></label>
                                                    <select class="form-control mr-10 select-active" name="employee_status" id="employee_status">
                                                        <option value="">Select Employee Status</option>
                                                        <option value="Permanent Full-Time">Permanent Full-Time</option>
                                                        <option value="Permanent Part-Time">Permanent Part-Time</option>
                                                        <option value="Temporary / Contract">Temporary / Contract</option>
                                                        <option value="Travel">Travel</option>
                                                        <option value="Per Diem / Local">Per Diem / Local</option>
                                                        <option value="On-Call / PRN (Pro Re Nata)">On-Call / PRN (Pro Re Nata)</option>
                                                        <option value="Casual">Casual</option>
                                                        <option value="Agency / Staffing Agency">Agency / Staffing Agency</option>
                                                        <option value="Seasonal">Seasonal</option>
                                                        <option value="Intern / Residency">Intern / Residency</option>
                                                        <option value="Self-Employed / Private Practice">Self-Employed / Private Practice</option>
                                                        <option value="Volunteer">Volunteer</option>
                                                        <option value="Unemployed">Unemployed</option>
                                                    </select>
                                                    <span id="status_error" class="reqError text-danger valley "></span>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Temporary</strong></label>
                                                    <select class="form-control mr-10 select-active" name="temporary_status" id="temporary_status">
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
                                                    <span id="temp_status_error" class="reqError text-danger valley "></span>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Professional Bio</strong></label>
                                                    <textarea class="form-control" rows="4" name="bio" id="bio"></textarea>
                                                    <span id="bio_error" class="reqError text-danger valley "></span>
                                                </div>
                                            </div>

                                            <div class="declaration_box  mt-3">
                                                <input type="checkbox" name="declare_information" class="declare_information" id="declare_information">
                                                <label for="declare_information">I declare that the information provided is true and correct</label>
                                                <span id="diclare_error" class="reqError text-danger valley "></span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-3">
                                                <button type="submit" class="btn btn-default next-step-33 align-items-center justify-content-between">Next</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane p-3" id="tab-4" role="tabpanel">
                    <?php
                    $sessid = ''; // Default value

                    if (Session::has('nurseemail')) {
                        $email = Session::get('nurseemail');
                        $post = DB::table("users")->where('email', $email)->first();
                        if ($post) {
                            $sessid = $post->id;
                        }
                    }

                    ?>
                    <div class="row">
                        <div class="w-100  overflow-hidden">
                            <div class="card-body p-3 px-md-4 pb-0">
                                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Education and Certification
                                </h3>
                                <input type="hidden" value="{{$sessid}}">
                            </div>

                            <div class="card-body p-3 px-md-4">
                                <form id="educert_form" method="POST">
                                    @csrf
                                    <input type="hidden" name='tab' value="tab3">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Educational Background
                                            </h4>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
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
                                                    <span id="ndegree_error" class="reqError text-danger valley "></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Institutions(Please start with the most relevant)</strong></label>
                                                    <input class="form-control" type="text" name="institution" id="most_relevant">
                                                    <span id="relevant_error" class="reqError text-danger valley "></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">

                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Upload Degree & Transcript</strong></label>
                                                    <input class="form-control" type="file" name="upload_degree[]" id="upload_degree" onchange="changeDegreeImg('<?= $sessid ?>')">
                                                    <span id="upload_degree_error" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="degree_transcript_imgs"></div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Graduation Date</strong></label>
                                                    <input class="form-control" type="date" name="graduation_start_date" value="" id="graduation_start_date">
                                                    <span id="gra_start_date_error" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>


                                            <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">General Certifications/Licences:
                                            </h4>

                                            <div class="col-md-12 mt-3">
                                                <div class="form-group level-drp">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Please select all that apply</strong></label>
                                                    <?php
                                                    $certificates = DB::table("professional_certificate")->orderBy("ordering_id", "asc")->get();
                                                    ?>
                                                    <ul id="profess_cert" style="display:none;">
                                                        @foreach($certificates as $cert)
                                                        <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="profess_cert" name="professional_certification[]" multiple="multiple"></select>
                                                    <span id="profess_cert_error" class="reqError text-danger valley "></span>
                                                </div>
                                            </div>

                                            <div class="professional_certification_div">


                                                <div class="form-group level-drp  d-none procertdiv">

                                                    <label class="form-label" for="input-1">ACLS (Advanced Cardiovascular Life Support)</label>
                                                    <?php
                                                    $acls_data = DB::table("professional_certificate_table")->where("cert_id", "6")->get();
                                                    ?>
                                                    <ul id="acls_data" style="display:none;">
                                                        @foreach($acls_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="acls_data" name="acls_data[]" multiple="multiple"></select>
                                                    <span id="reqaclsvalid" class="reqError text-danger valley"></span>
                                                </div>

                                                <div class="acls_certification_div">
                                                </div>

                                                <div class="form-group level-drp d-none procertdivone">
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
                                                    <span id="reqblsvalid" class="reqError text-danger valley"></span>
                                                </div>

                                                <div class="bls_certification_div">
                                                </div>
                                                <div class="form-group level-drp d-none procertdivtwo">

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
                                                    <span id="reqcprvalid" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="cpr_certification_div"></div>

                                                <div class="form-group level-drp d-none procertdivthree">
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
                                                    <span id="reqnrpvalid" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="nrp_certification_div"></div>

                                                <div class="form-group level-drp d-none procertdivfour">
                                                    <label class="form-label" for="input-1">PALS (Pediatric Advanced Life Support)</label>
                                                    <?php
                                                    $pls_data = DB::table("professional_certificate_table")->where("cert_id", "10")->get();
                                                    ?>
                                                    <ul id="pls_data" style="display:none;">
                                                        @foreach($pls_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="pals_data" name="pals_data[]" multiple="multiple"></select>
                                                    <span id="reqplsvalid" class="reqError text-danger valley"></span>
                                                </div>

                                                <div class="pls_certification_div"></div>

                                                <div class="form-group level-drp d-none procertdivfive">
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
                                                    <span id="reqrnvalid" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="rn_certification_div"></div>

                                                <div class="form-group level-drp d-none procertdivtwelfth">

                                                    <label class="form-label" for="input-1">NP (Nurse Practioner) / (APRN) Advanced Practice Registered Nurse</label>
                                                    <?php
                                                    $rn_data = DB::table("professional_certificate_table")->where("cert_id", "18")->get();
                                                    ?>
                                                    <ul id="np_data" style="display:none;">
                                                        @foreach($rn_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="np_data" name="np_data[]" multiple="multiple"></select>
                                                    <span id="reqnpvalid" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="np_certification_div"></div>

                                                <div class="form-group level-drp d-none procertdivsix">
                                                    <label class="form-label" for="input-1">CNA (Certified Nursing Assistant) / EN (Enrolled Nurse)</label>
                                                    <?php
                                                    $cn_data = DB::table("professional_certificate_table")->where("cert_id", "12")->get();
                                                    ?>
                                                    <ul id="rn_data" style="display:none;">
                                                        @foreach($cn_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="cn_data" name="cn_data[]" multiple="multiple"></select>
                                                    <span id="reqcnvalid" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="cna_certification_div"></div>

                                                <div class="form-group level-drp d-none procertdivseven">
                                                    <label class="form-label" for="input-1">LPN (Licensed Practical Nurse) / LVN (Licensed Vocational Nurse)</label>
                                                    <?php
                                                    $lpn_data = DB::table("professional_certificate_table")->where("cert_id", "13")->get();
                                                    ?>
                                                    <ul id="rn_data" style="display:none;">
                                                        @foreach($lpn_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="lpn_data" name="lpn_data[]" multiple="multiple"></select>
                                                    <span id="reqlpnvalid" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="lpn_certification_div"></div>

                                                <div class="form-group level-drp d-none procertdiveight">
                                                    <label class="form-label" for="input-1">CRNA (Certified Registered Nurse Anesthetist)</label>
                                                    <?php
                                                    $crn_data = DB::table("professional_certificate_table")->where("cert_id", "14")->get();
                                                    ?>
                                                    <ul id="rn_data" style="display:none;">
                                                        @foreach($crn_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach

                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="crn_data" name="crn_data[]" multiple="multiple"></select>
                                                    <span id="reqcrnavalid" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="crna_certification_div"></div>

                                                <div class="form-group level-drp d-none procertdivnine">
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
                                                    <span id="reqcnmvalid" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="cnm_certification_div"></div>

                                                <div class="form-group level-drp d-none procertdivten">
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
                                                <div class="ons_certification_div"></div>

                                                <div class="form-group level-drp d-none procertdiveleven">
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
                                                </div>
                                                <div class="msw_certification_div"></div>

                                                <div class="form-group level-drp d-none procertdivthirteen">
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
                                                </div>
                                                <div class="ain_certification_div"></div>

                                                <div class="form-group level-drp d-none procertdivfourteen">
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
                                                </div>
                                                <div class="rpn_certification_div"></div>
                                            </div>


                                            <div class="another_certifications">
                                                <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Other certifications</h4>
                                            </div>

                                            <div class="add_new_certification_div">
                                                <a style="cursor: pointer;" onclick="add_certfication()">+ Add another certification/Licence</a>
                                            </div>
                                            <script type="text/javascript">
                                                function add_certfication() {
                                                    var licence_div_count = $(".license_number_anothercertifications").length;
                                                    console.log("licence_div_count", licence_div_count);
                                                    var ano_cer_img_txt = 'ano_certifi_imgs'
                                                    var name = 'certifi' + '_' + licence_div_count;
                                                    var user_id = "{{ $sessid }}";
                                                    licence_div_count++;
                                                    // $(".certification_box").append('<h6>Certification/Licence '+licence_div_count+'</h6><div class="license_number_div row license_number_additional"><div class="form-group col-md-6"><label class="form-label" for="input-1">Courses/workshops</label><input class="form-control" type="text" name="training_courses[]"></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control" type="text" name="additional_license_number[]"></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control" type="date" name="additional_expiry[]"></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control" type="file" name="additional_upload_certification[]"></div></div>');
                                                    $(".another_certifications").append(`
                                                        <div class="license_number_div license_number_div_${licence_div_count} row license_number_anothercertifications">
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Certificate ${licence_div_count}</label>
                                                                <input class="form-control additional_certificate_field additional_certificate_field-${licence_div_count}" type="text" name="training_certificate[]">
                                                                <span id="reqcertname-${licence_div_count}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                                <input class="form-control cert_licence_num cert_licence_num-${licence_div_count}" type="text" name="certificate_license_number[]">
                                                                <span id="reqcertlicense-${licence_div_count}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Expiry</label>
                                                                <input class="form-control cert_expiry cert_expiry-${licence_div_count}" type="date" name="certificate_expiry[]">
                                                                <span id="reqcertexpiry-${licence_div_count}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Regulating Body</label>
                                                                <input class="form-control additional_regulating_body additional_regulating_body-${licence_div_count}" type="text" name="regulating_body[]">
                                                                <span id="reqcertregulating_body-${licence_div_count}" class="reqError text-danger valley"></span>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                                <input class="form-control ano_certifi_imgs_${name} additional_certifications-${licence_div_count}" 
                                                                    type="file" 
                                                                    name="certificate_upload_certification[${licence_div_count}][]" 
                                                                    onchange="changeAnoImg(${user_id}, ${licence_div_count}, 'ano_certifi_imgs', '${name}')" 
                                                                    multiple>
                                                            </div>
                                                            <div class="ano_certifi_imgs${name}"></div>
                                                            <div class="col-md-12">
                                                                <div class="add_new_certification_div">
                                                                    <a style="cursor: pointer;" onclick="delete_certification1(${licence_div_count})">- Delete certification/Licence</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    `);
                                                }
                                            </script>
                                            <div class="declaration_box mt-3">
                                                <input type="checkbox" name="declare_information_edu" class="declare_information_edu" value="1">
                                                <label for="declare_information1">I declare that the information provided is true and correct</label>
                                            </div>
                                            <span id="reqdeclare_information1" class="reqError text-danger valley"></span>

                                            <div class="d-flex align-items-center justify-content-between mt-3">
                                                <button class="btn btn-default next-step-4 align-items-center justify-content-between" type="submit" id="submitEducation" data-target="#navpill-5">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane p-3" id="navpill-5" role="tabpanel">
                    <form id="experience_form" method="POST">
                        @csrf
                        <input type="hidden" name="tab" value="tab4">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Experience</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="previous_employeers">
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

                                                <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Previous Employers</h4>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Organisation Name</strong></label>
                                                        <input class="form-control" type="text" name="previous_employer_name[]">
                                                        <span id="reqnames" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Position Held</strong></label>
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
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Employment Start Date</strong></label>
                                                        <input class="form-control employeement_start_date employeement_start_date-1" type="date" name="start_date[]" onchange="changeEmployeementEndDate(1)" onkeydown="return false">
                                                        <span id="reqempsdate" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Employment End Date</strong></label>
                                                        <input class="form-control employeement_end_date employeement_end_date-1" type="date" name="end_date[]" onkeydown="return false">
                                                        <span id="reqemployeementenddate-1" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>

                                                <div class="present_check mt-3">
                                                    <input class="currently_position currently_position-1" type="checkbox" name="present_box[]" value="1" onclick="currently_position(1)">I am currently in this position at the moment
                                                </div>
                                                <span id="present_box_error" class="reqError text-danger valley "></span>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Employment type</strong></label>
                                                        <select class="form-control" name="employeement_type[]">
                                                            <option value="">Employment type</option>
                                                            <option value="Agency">Agency</option>
                                                            <option value="Staffing Agency">Staffing Agency</option>
                                                        </select>
                                                        <span id="reqemptype" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>



                                                <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Detailed Job Descriptions</h4>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Responsibilities</strong></label>
                                                        <textarea class="form-control" name="job_responeblities[]"></textarea>
                                                        <span id="reqresposiblities" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Achievements</strong></label>
                                                        <textarea class="form-control" name="achievements[]"></textarea>
                                                        <span id="reqachievements" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="add_new_certification_div awe mb-3 mt-4">
                                                <a style="cursor: pointer;" onclick="add_work_experience()">+ Add another work experience</a>
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
                                                    <span id="skills_compantancies_error" class="reqError text-danger valley "></span>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Type of evidence</strong></label>
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
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="type_of_evidence" name="type_of_evidence[]" multiple="multiple"></select>
                                                    <span id="reqtype_evidence" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Upload evidence</strong></label>
                                                    <input class="form-control" type="file" name="upload_evidence">
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between mt-3">
                                                <button type="submit" class="btn btn-default next-step-56 align-items-center justify-content-between" data-target="#navpill-6">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane p-3" id="navpill-5.1" role="tabpanel">
                    <div class="row">
                        <div class=" w-100  overflow-hidden">
                            <div class="card-body p-3 px-md-4 pb-0">
                                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">References</h3>
                            </div>
                            <div class="card-body p-3 px-md-4">
                                <form id="reference_form1" method="POST">
                                    @csrf
                                    <input type="hidden" value="tab15" name="tab">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="reference_form">
                                                <h6 class="fw-bolder fs-6 lh-base d-flex align-items-center ">References 1</h6>
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
                                                        <input class="form-control phone_no phone_no-1" type="text" name="phone_no[]">
                                                        <span id="reqphoneno-1" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Relationship</strong></label>
                                                        <select class="form-control reference_relationship reference_relationship-1" name="reference_relationship[]">
                                                            <option value="">Select Reference Relationship</option>
                                                            <option value="Brother">Brother</option>
                                                            <option value="Sister">Sister</option>
                                                            <option value="Cousin">Cousin</option>
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
                                                        <input class="form-control position_with_referee-1 position_with_referee" type="text" name="position_with_referee[]">
                                                        <span id="reqpositionreferee-1" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Start Date</strong></label>
                                                        <input class="form-control start_date start_date-1" type="date" name="start_date[]" onkeydown="return false">
                                                        <span id="reqempsdate" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                                <div class="declaration_box">
                                                    <input class="still_working-1" type="checkbox" name="still_working[]" onclick="stillWorking(1)">I'm still working with this referee
                                                    <span id="reqstillworking" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>End Date</strong></label>
                                                        <input class="form-control  end_date end_date-1" type="date" name="end_date[]" onkeydown="return false">
                                                        <span id="reqempsdate" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>

                                                <div class="add_new_certification_div mb-3 mt-3">
                                                    <a style="cursor: pointer;" onclick="add_another_referee()">+ Add another Referee</a>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <button class="btn btn-default  align-items-center justify-content-between" type="submit" id="submitReferencesjjj">Save Changes</button>
                                        </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-3" id="tab-6" role="tabpanel">
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
                                            <div class="col-md-12 mt-3 level-drp mandatory_courses_div  mandatory_tr_div_1 d-none">

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
                                            <div class="well_self_care_div"></div>

                                            <!-- cat-2 -->
                                            <div class="col-md-12 mt-3 level-drp mandatory_courses_div  mandatory_tr_div_2 d-none">
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
                                            <div class="tech_innvo_health_div"></div>

                                            <!-- cat-3 -->
                                            <div class="col-md-12 mt-3 level-drp mandatory_courses_div  mandatory_tr_div_3 d-none">
                                                <div class="form-group">
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
                                            <div class="leader_pro_dev_div"></div>

                                            <!-- cat-4 -->
                                            <div class="col-md-12 mt-3 level-drp mandatory_courses_div  mandatory_tr_div_4 d-none">
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
                                            <div class="mid_spec_tra_div"></div>

                                            <!-- cat-5 -->
                                            <div class="col-md-12 mt-3 level-drp mandatory_courses_div  mandatory_tr_div_5 d-none">
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
                                        <div class="clinic_skill_core_div"></div>

                                        <div class="another_com_training">
                                            <h6 class="fw-bolder fs-6 d-flex align-items-center mt-2">Other Trainings</h6>
                                        </div>

                                        <div class="add_new_cmp_training_div  mt-3" style="margin-bottom: 3rem !important;margin-top: 2rem !important;">
                                            <a style="cursor: pointer;" onclick="add_listtraining()">+ Add another Completed Training</a>
                                        </div>

                                        <h6 class="fw-bolder fs-6 d-flex align-items-center">Mandatory Continuing Education</h6>


                                        <div class="col-md-12 mt-3">
                                            <p>Please add required ongoing education to stay updated in your field and maintain licensure</p>
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Please select all that apply</strong></label>
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
                                            <div class="core_man_con_data_div"></div>

                                            <!-- cat-2 -->
                                            <div class="col-md-12 mt-3 level-drp mandatory_sub_edu_div  mandatory_sub_edu_div_2 d-none">
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
                                            <div class="mid_spe_mandotry_div"></div>


                                            <!-- cat-3 -->
                                            <div class="col-md-12 mt-3 level-drp mandatory_sub_edu_div  mandatory_sub_edu_div_4 d-none">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Specialized Area</strong></label>
                                                    <?php $mandatory_sub_education = DB::table('man_training_category')
                                                        ->where('parent', 442)
                                                        ->where('type', 'Education')
                                                        ->get(); ?>

                                                    <ul id="spec_area_data" style="display:none;">
                                                        @foreach($mandatory_sub_education as $ms_education)
                                                        <li data-value="{{ $ms_education->name }}">{{ $ms_education->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="spec_area_data" name="spec_area[]" multiple="multiple"></select>
                                                </div>
                                            </div>
                                            <div class="spec_area_div"></div>

                                            <!-- cat-4-->
                                            <div class="col-md-12 mt-3 level-drp mandatory_sub_edu_div  mandatory_sub_edu_div_5 d-none">
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
                                            <div class="emerging_topic_div"></div>

                                            <!-- cat-5-->
                                            <div class="col-md-12 mt-3 level-drp mandatory_sub_edu_div  mandatory_sub_edu_div_4 d-none">
                                                <div class="form-group">
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
                                        </div>
                                        <div class="add_new_education_div mt-3" style="margin-bottom: 3rem !important;margin-top: 2rem !important;">
                                            <a style="cursor: pointer;" onclick="add_listeduction()">+Add another Continuing Education</a>
                                        </div>
                                        <div class="declaration_box mt-2">
                                            <input type="checkbox" name="declare_information" class="declare_information_man" value="1" @if(!empty($trainingData)) @if($trainingData->declaration_status == 1) checked @endif @endif>
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
            <div class="tab-pane p-3" id="navpill-7" role="tabpanel">
                <div class="row">
                    <div class=" w-100  overflow-hidden">
                        <div class="card-body p-3 px-md-4 pb-0">
                            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Vaccinations</h3>
                        </div>
                        <div class="card-body p-3 px-md-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 mt-3">
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
                                            <span id="vaccination_error" class="reqError text-danger valley "></span>
                                        </div>
                                    </div>
                                    <div class="vacc_rec_div"></div>

                                    <!--[ADD OTHER VACCINE START]-->
                                    <div class="row" id="vaccine-section-container">
                                        <h6>Other Vaccination </h6>
                                    </div>
                                    <div class="add_new_certification_div mb-3 mt-3">
                                        <a style="cursor: pointer;" id="add-vaccine">+ Add Another Vaccine</a>
                                    </div>
                                    <!--[ADD OTHER VACCINE END]-->


                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <button type="button" class="btn btn-default next-step-7 align-items-center justify-content-between" data-target="#navpill-8">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="tab-pane p-3" id="navpill-8" role="tabpanel">
                <div class="row">
                    <div class="w-100  overflow-hidden">
                        <div class="card-body p-3 px-md-4 pb-0">
                            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Work Clearances</h3>
                        </div>
                        <div class="card-body p-3 px-md-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <h6 class="mt-2 color-brand-1 mb-2">Eligibility To Work</h6>
                                    <a class="font-md color-text-paragraph-2" href="#">{{ env('APP_NAME') }} does not yet connect talent to sponsorship opportunities</a>

                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Residency</strong></label>
                                            <select class="form-control" name="residency" id="residencyId">
                                                <option value="">Select</option>
                                                <option value="Citizen">Citizen</option>
                                                <option value="Permanent Resident">Permanent Resident</option>
                                                <option value="Visa Holder">Visa Holder</option>
                                            </select>
                                            <span id="residency_error" class="text-danger reqError valley"></span>
                                        </div>
                                    </div>


                                    <div id="passport_detail" style="display: none">
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <label class="d-flex gap-3 flex-wrap"><strong>Visa Subclass Number *</strong></label>
                                                <input class="form-control" type="text" name="visa_subclass_number" id="visa_subclass_numberI" placeholder="" value="">
                                            </div>
                                            <span id="visa_subclass_error" class="text-danger  reqError valley"></span>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <div class="form-group ">
                                                <label class="d-flex gap-3 flex-wrap"><strong>Passport Number *</strong></label>
                                                <input class="form-control" type="text" name="passport_number" id="passport_numberI" placeholder="" value="">
                                            </div>
                                            <span id="passport_number_error" class="text-danger reqError valley"></span>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <div class="form-group position-relative">
                                                <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                                                <select class="form-control form-select ps-5" name="passport_country_of_Issue" id="passportcountryI">
                                                    <option value="">Select Country</option>
                                                    @php $country_data=country_name_from_db();@endphp
                                                    @foreach ($country_data as $data)
                                                    <option value="{{$data->id}}"> {{$data->name}} </option>
                                                    @endforeach
                                                </select>
                                                <span id="passport_country_error" class="reqError text-danger valley"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <div class="form-group ">
                                                <label class="d-flex gap-3 flex-wrap"><strong>Visa Grant Number*</strong></label>
                                                <input class="form-control" type="text" name="visa_grant_number" id="visa_grant_numberI" placeholder="" value="">
                                            </div>
                                            <span id="visa_grant_error" class="reqError text-danger valley"></span>
                                        </div>
                                    </div>

                                    <div id="passport_detail_date" style="display:none;">
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group ">
                                                <label class="d-flex gap-3 flex-wrap"><strong>Expiry Date*</strong></label>
                                                <input class="form-control" type="date" name="expiry_date" id="expiry_dataI" value="" min="{{ date('Y-m-d') }}">
                                            </div>
                                            <span id="expiry_date_error" class="reqError text-danger valley"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <div class="form-group ">
                                            <label class="d-flex gap-3 flex-wrap"><strong>Support Document*</strong></label>
                                            <input type="file" name="image_support_document" id="image_support_documentI" class="form-control h-100" accept="image/*">
                                        </div>
                                        <span id="image_support_error" class="reqError text-danger valley"></span>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <button type="button" class="btn btn-default eligibility_work align-items-center justify-content-between" data-target="#navpill-8">Save</button>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <h6 class="mt-2 color-brand-1 mb-2">Working With Children Check</h6>
                                    <a class="font-md color-text-paragraph-2" href="#">Add your state specific working with children clearance/s as required. Refer to your profile checklist</a>
                                    <span class="btn-dark badge badge-dark">Optional</span>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Clearance Number</strong></label>
                                            <input class="form-control" type="text" name="clearance_number" id="clearance_numberI" placeholder="" value="">
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
                                                    ?>
                                                    @if(isset($state_data) && !empty($state_data))
                                                    @foreach ($state_data as $data_state)
                                                    <option value="{{$data_state->id}}"> {{$data_state->name}} </option>
                                                    @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                            <span id="reqTxtclearancestateI" class="text-danger  reqError valley"></span>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <div class="form-group ">
                                                <label class="d-flex gap-3 flex-wrap"><strong>Expiry Date*</strong></label>
                                                <input class="form-control" type="date" name="clearance_expiry_date" id="clearance_expiry_dataI" value="" min="{{ date('Y-m-d') }}">
                                            </div>
                                            <span id="reqTxtclearance_expiry_dataI" class="text-danger reqError valley"></span>
                                        </div>

                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <button type="button" class="btn btn-default children_check align-items-center justify-content-between" data-target="#navpill-8">Save</button>
                                    </div>
                                </div>

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
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Date Acquired*</strong></label>
                                            <input class="form-control" type="date" name="date_acquired" id="date_acquiredI" value="" max="{{ date('Y-m-d') }}">
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

                                    <div class="col-md-12 mt-3">
                                        <label class="ml-20">
                                            <input class="float-start mr-5 mt-6" type="checkbox" id="confirmationCheckboxPoliceCheck"> Since I obtained this National Police Check, I confirm that there have been no changes to my criminal history, and that I have not been charged with an offence punishable by 12 months imprisonment or more, or convicted, pleaded guilty to, or found guilty of an offence punishable by imprisonment in Australia and/or overseas.
                                        </label>
                                        <span id="reqTxtconfirmationCheckboxPoliceCheckI" class="reqError text-danger valley"></span>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <button type="button" class="btn btn-default police_check align-items-center justify-content-between" data-target="#navpill-9">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-3" id="navpill-9" role="tabpanel">
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
                                            <input type="text" name="membership_numbers" class="form-control" id="membership_numbers">
                                            <span id="membership_numbers_error" class="reqError text-danger valley"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Status</strong></label>
                                            <select class="form-control" name="membership_status" id="membership_status">
                                                <option value="Active">Active</option>
                                                <option value="Lapsed">Lapsed</option>
                                            </select>
                                            <span id="membership_status_error" class="reqError text-danger valley"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <button type="button" class="btn btn-default next-step-9 align-items-center justify-content-between" data-target="#navpill-10">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-3" id="navpill-10" role="tabpanel">
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
                                            <input type="datetime-local" name="interview_availablity" class="form-control" value="" id="interview_availablity">
                                            <span id="reqinterviewdate" class="reqError text-danger valley"></span>
                                        </div>
                                    </div>

                                    <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Professional References</h4>

                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Names</strong></label>
                                            <input type="text" name="reference_name" class="form-control" value="" id="reference_name">
                                            <span id="reqprofessionalnames" class="reqError text-danger valley"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Email</strong></label>
                                            <input type="text" name="reference_email" class="form-control" value="" id="reference_email">
                                            <span id="reqprofessionalemail" class="reqError text-danger valley"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Mobile Number *</strong></label>
                                            <div class="mob-adj">
                                                <input type="hidden" name="reference_countryCode" id="reference_countryCode">
                                                <input type="hidden" name="reference_countryiso" id="reference_countryiso" value="">
                                                <input class="form-control numbers" type="tel" name="reference_contact" id="reference_contactI" value="" maxlength="10" style="padding-right: 20rem">
                                                <span id="reqTxtreferencecontactI" class="reqError text-danger valley"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Relationship</strong></label>
                                            <select class="form-control form-select ps-5" name="reference_relationship" id="reference_relationship">
                                                <option value="">Select Relationship</option>
                                                <option value="Mother">Mother</option>
                                                <option value="Father">Father</option>
                                                <option value="Brother">Brother</option>
                                                <option value="Sister">Sister</option>
                                                <option value="Cousin">Cousin</option>
                                                <option value="Uncle">Uncle</option>
                                                <option value="Aunt">Aunt</option>
                                            </select>
                                            <span id="reqprofessionalrelationship" class="reqError text-danger valley"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <button type="button" class="btn btn-default next-step-10 align-items-center justify-content-between" data-target="#navpill-11">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-3" id="navpill-11" role="tabpanel">
                <div class="row">
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
                                                <option value="Full-time">Full-time</option>
                                                <option value="Part-time">Part-time</option>
                                                <option value="Shift preferences">Shift preferences</option>
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
                                                <option value="{{$data->iso2}}"> {{$data->name}} </option>
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
                                                if(isset( $preferenceData->country)){
                                                $state_data =state_name_array($preferenceData->country);
                                                }else{
                                                $state_data = '';
                                                }
                                                @endphp
                                                @if(isset($state_data) && !empty($state_data))
                                                @foreach ($state_data as $data_state)
                                                <option value="{{$data_state->id}}" ?>> {{$data_state->name}} </option>
                                                @endforeach
                                                @endif

                                            </select>
                                            <span id="reqprestateI" class="reqError text-danger valley"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Specific Facilities</strong></label>
                                            <textarea name="specific_facilities" class="form-control" id="specific_facilities"></textarea>
                                            <span id="reqspecificfacilities" class="reqError text-danger valley"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Work Environment Preferences</strong></label>
                                            <select class="form-control form-select ps-5" name="work_environment" id="work_environment">
                                                <option value="">Select Work Environment Preferences</option>
                                                <option value="Hospital">Hospital</option>
                                                <option value="Clinic">Clinic</option>
                                                <option value="Home Health">Home Health</option>
                                            </select>
                                            <span id="reqworkenvironement" class="reqError text-danger valley"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Shift Preferences</strong></label>
                                            <select class="form-control form-select ps-5" name="shift_preferences" id="shift_preferences">
                                                <option value="">Select Shift Preferences</option>
                                                <option value="Day">Day</option>
                                                <option value="Clinic">Evening</option>
                                                <option value="Night">Night</option>
                                            </select>
                                            <span id="reqshiftpreferences" class="reqError text-danger valley"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <button type="button" class="btn btn-default next-step-11 align-items-center justify-content-between" data-target="#navpill-12">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-3" id="navpill-12" role="tabpanel">
                <div class="row">
                    <div class=" w-100  overflow-hidden">
                        <div class="card-body p-3 px-md-4 pb-0">
                            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Job Search & Personal Preferences</h3>
                        </div>
                        <div class="card-body p-3 px-md-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
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
                                            <input type="text" name="salary_expectation" class="form-control" id="salary_expectation">
                                            <span id="reqsalaryexp" class="reqError text-danger valley"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Benefits Preferences</strong></label>
                                            <ul id="benefit_prefer" style="display:none;">
                                                <li data-value="Health insurance">Health insurance</li>
                                                <li data-value="Retirement plans">Retirement plans</li>
                                            </ul>
                                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="benefit_prefer" name="benefit_prefer[]" multiple="multiple"></select>
                                            <span id="reqbenefitsprefer" class="reqError text-danger valley"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <button type="button" class="btn btn-default next-step-12 align-items-center justify-content-between" data-target="#navpill-14">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    //This script is for vaccination record
    function evidance_content() {

        $('.extra-info').hide();

        let selectedValues = $('.js-example-basic-multiple[data-list-id="vaccination_record"]').val() || [];
        console.log('Selected Values content:', selectedValues);

        // Check if the dropdown includes '8'
        if (selectedValues.includes('8')) {
            // Check if the evidence-types radio button with value '3' is selected
            let isEvidenceType3Selected = $('input.evidence-types[value="3"]:checked').length > 0;

            if (isEvidenceType3Selected) {
                $('.extra-info').show();

            } else {
                $('.extra-info').hide(); // Hide the extra-info div if evidence type 3 is not selected

            }
        } else {
            $('.extra-info').hide(); // Hide the extra-info div if dropdown does not include '8'

        }
    }
    $(document).on('click', '.evidence-types', function() {
        evidance_content();
    });

    $('.js-example-basic-multiple[data-list-id="vaccination_record"]').on('change', function() {
        let selectedValues = $(this).val() || []; // Get selected values (IDs)
        console.log('selectedValues : ', selectedValues);

        // Sort selectedValues to ensure ascending order
        selectedValues.sort((a, b) => a - b);

        // Remove divs for deselected IDs
        $(".vacc_rec_div > div").each(function() {
            let id = $(this).find("h6").data("id");
            if (!selectedValues.includes(String(id))) {
                $(this).remove(); // Remove div for deselected ID
            }
        });

        // Loop through sorted selected values and make AJAX calls for new IDs
        selectedValues.forEach(function(id) {
            // Check if the div for this ID already exists
            if ($(`.vacc_rec_${id}`).length === 0) {
                // Make an AJAX call to fetch the HTML content for this ID
                $.ajax({
                    url: "{{ url('/admin') }}/getVaccinationData",
                    type: 'GET',
                    data: {
                        id: id
                    }, // Pass the ID as a parameter
                    success: function(response) {
                        // Check if the response contains valid content
                        if (response.html) {
                            // Append the new HTML to the vaccination record container
                            let appended = false;
                            $(".vacc_rec_div > div").each(function() {
                                let existingId = $(this).find("h6").data("id");
                                if (parseInt(existingId) > parseInt(id)) {
                                    $(this).before(response.html); // Insert before the first larger ID
                                    appended = true;
                                    return false; // Break the loop
                                }
                            });
                            if (!appended) {
                                $(".vacc_rec_div").append(response.html); // Append to the end if no larger ID found

                            }
                            evidance_content();
                            initializeFileUpload();
                        }

                    },
                    error: function(xhr, status, error) {
                        console.error(`Failed to fetch data for ID: ${id}`, error);
                    },
                });
            }
        });
        evidance_content();
    });

    function initializeFileUpload() {
        $(".fileInput").each(function() {
            const fileInput = $(this);
            const fileList = $(`#fileList${fileInput.attr("id").replace("fileInput", "")}`);
            const selectedFiles = new DataTransfer();

            fileInput.off("change").on("change", function(event) {

                Array.from(event.target.files).forEach((file) => {
                    selectedFiles.items.add(file);

                    // Create a file item container
                    const fileDiv = $("<div>").addClass("file-item");

                    // Create a link to the file with the file name
                    const fileLink = $("<a>")
                        .attr("href", URL.createObjectURL(file)) // Use Blob URL to link the file
                        .attr("target", "_blank")
                        .html(`<i class="fa fa-file" aria-hidden="true"></i> ${file.name}`);

                    // Create the close button
                    const closeButton = $("<div>").addClass("close_btn close_btn-0").css("cursor", "pointer");
                    const closeIcon = $("<i>").addClass("fa fa-close").attr("aria-hidden", "true");

                    // Append the close icon to the close button
                    closeButton.append(closeIcon);

                    // Add event listener to remove the file item when clicked
                    closeButton.on("click", function() {
                        for (let i = 0; i < selectedFiles.items.length; i++) {
                            if (selectedFiles.items[i].getAsFile().name === file.name) {
                                selectedFiles.items.remove(i);
                                break;
                            }
                        }
                        fileInput[0].files = selectedFiles.files;

                        // Remove the file div from the list
                        fileDiv.remove();
                    });

                    // Append the link and close button to the file div
                    fileDiv.append(fileLink).append(closeButton);

                    // Append the file div to the file list container
                    fileList.append(fileDiv);
                });

                // Update the file input with the modified FileList
                fileInput[0].files = selectedFiles.files;
            });
        });
    }
    $(document).ready(function() {
        // Function to add a new vaccine section
        let i = 1;
        $('#add-vaccine').click(function() {

            $('#vaccine-section-container').append(`<div class="vaccine-section">
                              <div class="col-md-12">
                              <h6>Vaccination ${i}</h6>
                                  <div class="form-group level-drp">
                                      <label class="form-label" for="input-1">Vaccination Name</label>
                                      <input class="form-control vaccination-name" type="text" name="vaccination_name[]" value="">
                                      <span class="reqError text-danger valley"></span>
                                  </div>

                                  <div class="form-group level-drp">
                                      <label class="form-label" for="input-1">Immunization Status</label>
                                      <select class="form-control mr-10 imm_status" name="immunization_status[]">
                                          <option value="" disabled selected>Select Immunization Status</option>
                                          <?php
                                            $get_imm_status = DB::table("imm_status")->get();
                                            foreach ($get_imm_status as $status) { ?>
                                              <option value="<?= $status->id ?>" ><?= htmlspecialchars($status->name) ?></option>
                                          <?php } ?>
                                      </select>
                                      <span class="reqError text-danger valley"></span>
                                  </div>

                                  <div class="form-group level-drp">
                                      <label class="form-label" for="input-1">Evidence Type</label>
                                      <select class="form-control mr-10 ev_type" name="evidence_type[]">
                                          <option value="" disabled selected>Select Evidence type</option>
                                          <option value="Immunization Certificate" >Immunization Certificate</option>
                                          <option value="Vaccination Card/Record" >Vaccination Card/Record</option>
                                          <option value="Medical Letter or Certificate from GP" >Medical Letter or Certificate from GP</option>
                                          <option value="Vaccination Record from My Health Record" >Vaccination Record from My Health Record</option>
                                          <option value="Serology Test Results" >Serology Test Results</option>
                                          <option value="Immunization History Statement from the Australian Immunisation Register (AIR)" >Immunization History Statement from the Australian Immunisation Register (AIR)</option>
                                          <option value="Employer or Facility Letter" >Employer or Facility Letter</option>
                                      </select>
                                      <span class="reqError text-danger valley"></span>
                                  </div>

                                  <div class="form-group level-drp">
                                      <label class="form-label" for="input-1">Upload Evidence</label>
                                      <input class="form-control ev-file" type="file" name="evidence_file[]">
                                      <span class="reqError text-danger valley"></span>
                                  </div>
                              </div>
                              <div class="add_new_certification_div mb-3 mt-3">
                                <a style="cursor: pointer;" class="remove-vaccine">- Delete Vaccine</a>
                              </div>

                          </div>`);
            i++;
        });

        // Function to remove a vaccine section
        $(document).on('click', '.remove-vaccine', function() {


            $(this).closest('.vaccine-section').remove();
            $('#vaccine-section-container .vaccine-section').each(function(index) {
                $(this).find('h6').text(`Vaccination ${index + 1}`);
            });

            // Adjust the counter to reflect the number of vaccine sections + 1
            i = $('#vaccine-section-container .vaccine-section').length + 1;

        });
    });
</script>

@include('admin.script');

@endsection