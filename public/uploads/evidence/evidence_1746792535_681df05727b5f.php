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
    /* border-radius: 4px !important; */
    /* cursor: default !important;
    color: #fff !important; */
  /* float: left; */
    /* padding: 0;
    padding-right: 0.75rem;
    margin-top: calc(0.375rem - 2px);
    margin-right: 0.375rem;
  padding-bottom: 0px;
  white-space: normal;
    line-height: 20px; */
  }

  /* .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff !important;
    font-size: 20px !important;
  float: left;
    padding-right: 3px;
    padding-left: 3px;
    margin-right: 1px;
    margin-left: 3px;
    font-weight: 700;
  line-height: 20px; */
  /* }     */

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

    <div class="container-fluid">
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
                        <a class="nav-link active" data-bs-toggle="tab" href="#navpill-1" role="tab"
                            aria-selected="true">
                            <span>Basic Details</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-2" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Setting</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-3" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Profession</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-4" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Education and Certifications</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-5" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Experience and References</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#navpill-6" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Mandatory Training</span>
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
                <form method="post" enctype="multipart/form-data" id="AddNurse">
                <!-- Tab panes -->
                <div class="tab-content border mt-2">
                    <div class="tab-pane p-3 active show" id="navpill-1" role="tabpanel">
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
													<img alt=""  id="profileImage" style="object-fit:cover;border-radius: 16px;display: block;width: 85px;height: 85px;" src="{{asset('assets/admin/dist/images/profile/nurse06.png')}}"> 
													<div class="position-relative overflow-hidden">
														<a class="btn btn-apply" id="uploadButton">Upload Avatar</a>													  
														<input type="file" name="profile_image" id="profile_image" class="position-absolute h-100" accept="image/*" style="top: 0;left: 0;opacity: 0;cursor: pointer;">
														<i class="fa fa-spinner fa-spin" id="preloadeer-active" style="display:none" aria-hidden="true"></i>									
													</div>
													</div>
												</div>
											<span id="profile_image_error" class="text-danger"></span>
											</div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>First Name</strong></label>
                                                    <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name">
                                                    <span id="first_name_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Last Name</strong></label>
                                                    <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name">
                                                    <span id="last_name_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Email Address</strong></label>
                                                    <input type="text" class="form-control" placeholder="Email Address" name="email" id="email">
                                                    <span id="email_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3 phone--drpdwns">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Phone Number</strong></label>
                                                    <input type="hidden" value="" name="country_code" id="country_code_phone">
                                                    <input type="hidden" value="" name="country_name" id="country_name_phone">
                                                    <input type="hidden" value="" name="country_iso" id="country_iso_phone">
                                                    <input class="form-control numbers" type="tel" required="" name="contact" id="contact" placeholder="1234567890" placeholder="1234567890" maxlength="10" pattern="[0-9]{4}" style="width: ">
                                                    <span id="contact_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Date of Birth</strong></label>
                                                    <input type="date" class="form-control" placeholder="Date of Birth" name="dob" id="dob">
                                                    <span id="date_error" class="text-danger"></span>
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
                                                    <span id="genderErr" class="text-danger"></span>
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
                                                    <span id="per_website_error" class="text-danger"></span>
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
                                                    <span id="country_error" class="text-danger"></span>
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
                                                    <span id="state_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>City</strong></label>
                                                    <input class="form-control" type="text" required="" name="city" id="city" placeholder="City">
                                                    <span id="city_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Zip code</strong></label>
                                                    <input class="form-control" type="text" required="" name="zip_code" id="zip_code" placeholder="Zip code">
                                                    <span id="zip_code_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Home Address</strong></label>
                                                    <input class="form-control" type="text" required="" name="home_address" id="home_address" placeholder="Home Address">
                                                    <span id="home_address_error" class="text-danger"></span>
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
                                                    <span id="emrg_contact_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Email</strong></label>
                                                   <input type="text" class="form-control" id="emrg_email" name="emrg_email" placeholder="Email" accept="image/*">
                                                    <span id="emrg_email_error" class="text-danger"></span>
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
                    <div class="tab-pane p-3" id="navpill-2" role="tabpanel">
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
                                                    <input class="form-check-input" type="checkbox" value="1"  id="visibleToAgencies" name="agencies">
                                                    <label class="form-check-label" for="visibleToAgencies">
                                                        Visible to Agencies
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <input class="form-check-input" type="checkbox" value="1"   id="visibleToIndividuals" name="individuals">
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
                                    
                    <div class="tab-pane p-3" id="navpill-3" role="tabpanel">
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
                                                            <span id="type_nurse_error" class="text-danger"></span>
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
                                                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nursing_entry-{{ $i }}" name="states[]" multiple="multiple"></select>
                                                        <span id="photo_id" class="text-danger"></span>
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
                                                            <span id="photo_id" class="text-danger"></span>
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
                                                            <span id="specialties_error" class="text-danger"></span>
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
                                                        <div class="speciality_data form-group d-none drpdown-set drp--clr"  id="specility_level-{{ $l }}">
                                                    
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
                                                            @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}"  >{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                                                                @endfor
                                                            </select>
                                                            <span id="experience_error" class="text-danger"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-2">
                                                        <div class="form-group">
                                                            <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Current Employment Status</strong></label>
                                                            <select class="form-control mr-10 select-active" name="employee_status" id="employee_status">
                                                            <option value="">Select Employee Status</option>
                                                            <option value="Permanent Full-Time" >Permanent Full-Time</option>
                                                            <option value="Permanent Part-Time">Permanent Part-Time</option>
                                                            <option value="Temporary / Contract">Temporary / Contract</option>
                                                            <option value="Travel">Travel</option>
                                                            <option value="Per Diem / Local">Per Diem / Local</option>
                                                            <option value="On-Call / PRN (Pro Re Nata)">On-Call / PRN (Pro Re Nata)</option>
                                                            <option value="Casual">Casual</option> 
                                                            <option value="Agency / Staffing Agency">Agency / Staffing Agency</option>
                                                            <option value="Seasonal">Seasonal</option>
                                                            <option value="Intern / Residency">Intern / Residency</option>
                                                            <option value="Self-Employed / Private Practice" >Self-Employed / Private Practice</option>
                                                            <option value="Volunteer" >Volunteer</option>
                                                            <option value="Unemployed" >Unemployed</option>
                                                            </select>
                                                            <span id="status_error" class="text-danger"></span>
                                                        </div>

                                                        <div class="col-md-12 mt-2">
                                                            <div class="form-group">
                                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Professional Bio</strong></label>
                                                                <textarea class="form-control" rows="4" name="bio" id="bio"></textarea>
                                                                <span id="bio_error" class="text-danger"></span>
                                                            </div>
                                                        </div>

                                                        <div class="declaration_box  mt-3">
                                                            <input type="checkbox" name="declare_information" class="declare_information" id="declare_information">
                                                            <label for="declare_information">I declare that the information provided is true and correct</label>
                                                            <span id="diclare_error" class="text-danger"></span>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                                            <button type="button" class="btn btn-default next-step-3 align-items-center justify-content-between" data-target="#navpill-4">Next</button>
                                                        </div>  
                                                    </div>
                                            </div>
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="navpill-4" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Education and Certification 
                                    </h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
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
                                                    <span id="ndegree_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Institutions (Please start with the most relevant)</strong></label>
                                                   <input class="form-control" type="text" name="institution" value="" id="institution">
                                                    <span id="institution_error" class="text-danger"></span>
                                                </div>
                                            </div>            
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Please start with the most relevant</strong></label>
                                                   <input class="form-control" type="text" name="most_relevant" value="" id="most_relevant">
                                                    <span id="relevant_error" class="text-danger"></span>
                                                </div>
                                            </div>    
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Graduation Date</strong></label>
                                                    <input class="form-control" type="date" name="graduation_start_date" value="" id="graduation_start_date">
                                                    <span id="gra_start_date_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    {{-- <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Upload Degree & Transcript</strong></label>

                                                    <input type="file" name="upload_degree" id="upload_degree" class="" accept="image/*">  --}}
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Upload Degree & Transcript</strong></label>
                                                    <input class="form-control" type="file" name="upload_degree" id="upload_degree">
                                                    <span id="upload_degree" class="text-danger"></span>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Graduation End Date</strong></label>
                                                    <input class="form-control" type="date" name="graduation_end_date" value="" id="graduation_end_date">
                                                    <span id="gra_end_date_error" class="text-danger"></span>
                                                </div>
                                            </div> --}}
                                            <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">General Certifications/Licences:
                                            </h4>

                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Please select all that apply</strong></label>
                                                    <?php
                                                        $certificates = DB::table("professional_certificate")->orderBy("ordering_id","asc")->get();
                                                        ?>
                                                        <ul id="profess_cert" style="display:none;">
                                                            @foreach($certificates as $cert)
                                                            <li data-value="{{$cert->id}}">{{$cert->name}}</li>
                                                            @endforeach                        
                                                        </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="profess_cert" name="professional_certification[]" multiple="multiple"></select>
                                                    <span id="profess_cert_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="professional_certification_div">
                                                <div class="form-group level-drp d-none procertdiv">                        
                                                    <label class="form-label" for="input-1">ACLS(Advanced Cardiovascular Life Support)</label>
                                                    <?php
                                                        $acls_data = DB::table("professional_certificate_table")->where("cert_id","6")->get();
                                                    ?>
                                                    <ul id="acls_data" style="display:none;">
                                                        @foreach($acls_data as $data)
                                                        <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="acls_data" name="acls_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_acls d-none">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                    <input class="form-control" type="text" name="acls_license_number" id="acls_license_number">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="input-1">Expiry</label>
                                                    <input class="form-control" type="date" name="acls_expiry" id="acls_expiry">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                    <input class="form-control" type="file" name="acls_upload_certification" id="acls_upload_certification" accept="image/*">
                                                </div>
                                                </div>
                                                <div class="form-group level-drp d-none procertdivone">                            
                                                    <label class="form-label" for="input-1">BLS (Basic Life Support)</label>
                                                    <?php
                                                        $bls_data = DB::table("professional_certificate_table")->where("cert_id","7")->get();
                                                    ?>
                                                    <ul id="bls_data" style="display:none;">
                                                        @foreach($bls_data as $data)
                                                        <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                        @endforeach                                                        
                                                    </ul>
                                                   <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="bls_data" name="bls_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_bls d-none">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="bls_license_number" id="bls_license_number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="bls_expiry" id="bls_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="bls_upload_certification" id="bls_upload_certification">
                                                    </div>
                                                </div>
                                                <div class="form-group level-drp d-none procertdivtwo">
                            
                                                    <label class="form-label" for="input-1">CPR (Cardiopulmonary Resuscitation)</label>
                                                    <?php
                                                        $cpr_data = DB::table("professional_certificate_table")->where("cert_id","8")->get();
                                                    ?>
                                                    <ul id="cpr_data" style="display:none;">
                                                        @foreach($cpr_data as $data)
                                                        <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="cpr_data" name="cpr_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_cpr d-none">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="cpr_license_number" id="cpr_license_number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="cpr_expiry" id="cpr_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="cpr_upload_certification" id="cpr1_upload_certification">
                                                    </div>
                                                </div>
                                                <div class="form-group level-drp d-none procertdivthree">
                            
                                                    <label class="form-label" for="input-1">NRP (Neonatal Resuscitation Program)</label>
                                                    <?php
                                                        $nrp_data = DB::table("professional_certificate_table")->where("cert_id","9")->get();
                                                    ?>
                                                    <ul id="nrp_data" style="display:none;">
                                                        @foreach($nrp_data as $data)
                                                        <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                   <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nrp_data" name="nrp_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_nrp d-none">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="nrp_license_number" id="nrp_license_number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="nrp_expiry" id="nrp_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="nrp_upload_certification" id="nrp_upload_certification">
                                                    </div>
                                                </div>
                                                <div class="form-group level-drp d-none procertdivfour">                            
                                                    <label class="form-label" for="input-1">PALS (Pediatric Advanced Life Support)</label>
                                                    <?php
                                                        $pls_data = DB::table("professional_certificate_table")->where("cert_id","10")->get();
                                                    ?>
                                                    <ul id="pls_data" style="display:none;">
                                                        @foreach($pls_data as $data)
                                                        <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="pals_data" name="pals_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_pals d-none">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="pals_license_number" id="pals_license_number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="pals_expiry" id="pals_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="pals_upload_certification" id="pals_upload_certification">
                                                    </div>
                                                </div>
                                                <div class="form-group level-drp d-none procertdivfive">                        
                                                    <label class="form-label" for="input-1">RN (Registered Nurse)</label>
                                                    <?php
                                                        $rn_data = DB::table("professional_certificate_table")->where("cert_id","11")->get();
                                                    ?>
                                                    <ul id="rn_data" style="display:none;">
                                                        @foreach($rn_data as $data)
                                                        <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="rn_data" name="rn_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_rn d-none">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="rn_license_number" id="rn_license_number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="rn_expiry" id="rn_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="rn_upload_certification" id="rn_upload_certification">
                                                    </div>
                                                </div>
                                                <div class="form-group level-drp d-none procertdivtwelfth">
                            
                                                    <label class="form-label" for="input-1">NP (Nurse Practioner) / (APRN) Advanced Practice Registered Nurse</label>
                                                    <?php
                                                        $rn_data = DB::table("professional_certificate_table")->where("cert_id","18")->get();
                                                    ?>
                                                    <ul id="np_data" style="display:none;">
                                                        @foreach($rn_data as $data)
                                                        <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                   <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="np_data" name="np_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_np d-none">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="np_license_number" id="np_license_number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="np_expiry" id="np_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="np_upload_certification" id="np_upload_certification">
                                                    </div>
                                                </div>
                                                <div class="form-group level-drp d-none procertdivfive">
                            
                                                    <label class="form-label" for="input-1">NP (Nurse Practioner) / (APRN) Advanced Practice Registered Nurse</label>
                                                    <?php
                                                        $rn_data = DB::table("professional_certificate_table")->where("cert_id","11")->get();
                                                    ?>
                                                    <ul id="rn_data" style="display:none;">
                                                        @foreach($rn_data as $data)
                                                        <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                   <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="rn_data" name="rn_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_rn d-none">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="rn_license_number" id="rn_license_number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="rn_expiry" id="rn_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="rn_upload_certification" id="rn_upload_certification">
                                                    </div>
                                                </div>
                                                <div class="form-group level-drp d-none procertdivsix">                            
                                                    <label class="form-label" for="input-1">CNA (Certified Nursing Assistant) / EN (Enrolled Nurse)</label>
                                                    <?php
                                                        $cn_data = DB::table("professional_certificate_table")->where("cert_id","12")->get();
                                                    ?>
                                                    <ul id="rn_data" style="display:none;">
                                                        @foreach($cn_data as $data)
                                                        <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="cn_data" name="cn_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_cn d-none">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="cn_license_number" id="cn_license_number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="cn_expiry" id="cn_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="cn_upload_certification" id="cn_upload_certification">
                                                    </div>
                                                </div>
                                                <div class="form-group level-drp d-none procertdivseven">                        
                                                    <label class="form-label" for="input-1">LPN (Licensed Practical Nurse) / LVN (Licensed Vocational Nurse)</label>
                                                    <?php
                                                        $lpn_data = DB::table("professional_certificate_table")->where("cert_id","13")->get();
                                                    ?>
                                                    <ul id="rn_data" style="display:none;">
                                                        @foreach($lpn_data as $data)
                                                        <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                   <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="lpn_data" name="lpn_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_lpn d-none">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="lpn_license_number" id="lpn_license_number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="lpn_expiry" id="lpn_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="lpn_upload_certification" id="lpn_upload_certification">
                                                    </div>
                                                </div>
                                                <div class="form-group level-drp d-none procertdiveight">                            
                                                        <label class="form-label" for="input-1">CRNA (Certified Registered Nurse Anesthetist)</label>
                                                        <?php
                                                            $crn_data = DB::table("professional_certificate_table")->where("cert_id","14")->get();
                                                        ?>
                                                        <ul id="rn_data" style="display:none;">
                                                            @foreach($crn_data as $data)
                                                            <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                            @endforeach
                                                            
                                                        </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="crn_data" name="crn_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_crn d-none">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="crn_license_number" id="crn_license_number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="crn_expiry" id="crn_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="crn_upload_certification" id="crn_upload_certification">
                                                    </div>
                                                </div>
                                                <div class="form-group level-drp d-none procertdivnine">                    
                                                    <label class="form-label" for="input-1">CNM (Certified Nurse Midwife)</label>
                                                    <?php
                                                        $cnm_data = DB::table("professional_certificate_table")->where("cert_id","15")->get();
                                                    ?>
                                                    <ul id="cnm_data" style="display:none;">
                                                        @foreach($cnm_data as $data)
                                                        <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="cnm_data" name="cnm_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_cnm d-none">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="cnm_license_number" id="cnm_license_number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="cnm_expiry" id="cnm_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="cnm_upload_certification" id="cnm_upload_certification">
                                                    </div>
                                                </div>
                                                <div class="form-group level-drp d-none procertdivten">                        
                                                    <label class="form-label" for="input-1">ONS/ONCC (Oncology Nursing Society/Oncology Nursing Certification Corporation)</label>
                                                    <?php
                                                        $ons_data = DB::table("professional_certificate_table")->where("cert_id","16")->get();
                                                    ?>
                                                    <ul id="ons_data" style="display:none;">
                                                        @foreach($ons_data as $data)
                                                        <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                        @endforeach                                                    
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="ons_data" name="ons_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_ons d-none">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="ons_license_number" id="ons_license_number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="ons_expiry" id="ons_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="ons_upload_certification" id="ons_upload_certification">
                                                    </div>
                                                </div>
                                                <div class="form-group level-drp d-none procertdiveleven">                            
                                                    <label class="form-label" for="input-1">MSW/AiM (Maternity Support Worker/Assistant in Midwifery ) / Midwife Assistant</label>
                                                    <?php
                                                        $msw_data = DB::table("professional_certificate_table")->where("cert_id","17")->get();
                                                    ?>
                                                    <ul id="msw_data" style="display:none;">
                                                        @foreach($msw_data as $data)
                                                        <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                     <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="msw_data" name="msw_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_ons d-none">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="msw_license_number" id="msw_license_number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="msw_expiry" id="msw_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="msw_upload_certification" id="msw_upload_certification">
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="form-group level-drp d-none procertdivthirteen">                    
                                                    <label class="form-label" for="input-1">AIN (Assistant in Nursing) / NA (Nurse Associate) / HCA (Healthcare Assistant)</label>
                                                    <?php
                                                        $msw_data = DB::table("professional_certificate_table")->where("cert_id","19")->get();
                                                    ?>
                                                    <ul id="ain_data" style="display:none;">
                                                        @foreach($msw_data as $data)
                                                        <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="ain_data" name="ain_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_ain d-none">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="ain_license_number" id="ain_license_number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="ain_expiry" id="ain_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="ain_upload_certification" id="ain_upload_certification">
                                                    </div>
                                                </div>
                                                <div class="form-group level-drp d-none procertdivfourteen">                    
                                                    <label class="form-label" for="input-1">RPN (Registered Practical Nurse) / RGN (Registered General Nurse)</label>
                                                    <?php
                                                        $msw_data = DB::table("professional_certificate_table")->where("cert_id","20")->get();
                                                    ?>
                                                    <ul id="rpn_data" style="display:none;">
                                                        @foreach($msw_data as $data)
                                                        <li data-value="{{ $data->professionalcert_id }}">{{ $data->name }}</li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                     <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="rpn_data" name="rpn_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_rpn d-none">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="rpn_license_number" id="rpn_license_number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="rpn_expiry" id="rpn_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="rpn_upload_certification" id="rpn_upload_certification">
                                                    </div>
                                                </div>
                                                <div class="form-group level-drp d-none procertdivfiveteen">
                            
                                                    <label class="form-label" for="input-1">No License/Certification</label>
                                                    <?php
                                                        $nlc_data = DB::table("professional_certificate_table")->where("cert_id","21")->get();
                                                    ?>
                                                    <ul id="nlc_data" style="display:none;">
                                                        @foreach($nlc_data as $data)
                                                        <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                   <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nlc_data" name="nlc_data[]" multiple="multiple"></select>
                                                </div>
                                                <div class="license_number_div row license_number_nlc d-none">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="nlc_license_number" id="nlc_license_number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="nlc_expiry" id="nlc_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="nlc_upload_certification" id="nlc_upload_certification">
                                                    </div>
                                                </div>
                                              
                                               <div class="another_certifications">
                                                    <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">
                                                        Another Certifications 
                                                    </h4>
                                                    <div class="license_number_div row license_number_anothercertifications">
                                                        <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certificate 1</label>
                                                        <input class="form-control" type="text" name="training_certificate[]" value="@if(!empty($educationData)){{ $c_data->training_certificate }}@endif">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                        <input class="form-control" type="text" name="certificate_license_number[]" value="@if(!empty($educationData)){{ $c_data->certificate_license_number }}@endif">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Expiry</label>
                                                        <input class="form-control" type="date" name="certificate_expiry[]" value="@if(!empty($educationData)){{ $c_data->certificate_expiry }}@endif">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                        <input class="form-control" type="file" name="certificate_upload_certification[]">                        
                                                        {{-- <img src="{{ url('/public/uploads/certificates') }}/{{ $c_data->certificate_upload_certification }}" style="width:100px;"> --}}                          
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add_new_certification_div mb-3 mt-3">
                                                    <a style="cursor: pointer;" onclick="add_listcertfication()">+ Add another certification/Licence</a>
                                                </div>

                                                <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Additional Training</h4>
                                               <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Please add most relevant courses/workshops</strong></label>
                                                        <?php
                                                                $courses = DB::table("additional_training")->get();
                                                            ?>
                                                            <ul id="training_courses" style="display:none;">
                                                                @foreach($courses as $c)
                                                                <li data-value="{{ $c->id }}">{{ $c->name }}</li>
                                                                @endforeach        
                                                            </ul>
                                                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="training_courses" name="training_courses[]" multiple="multiple"></select>
                                                        <span id="training_course_error" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-3">
                                                    <button type="button" class="btn btn-default next-step-4 align-items-center justify-content-between" data-target="#navpill-5">Next</button>
                                                </div>
                                        </div>                     
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="navpill-5" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Experience and References</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>What is your level of experience?</strong></label>
                                                    <select class="form-control mr-10 select-active" name="assistent_level" id="assistent_level">                      
                                                    @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}"  >{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                                                        @endfor
                                                    </select>
                                                    <span id="experience_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                             <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Previous Employers</h4>

                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Names</strong></label>
                                                    <input class="form-control" type="text" name="previous_employer_name"  id="previous_employer_name">
                                                    <span id="previous_employer_name_error" class="text-danger"></span>
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
                                                    <span id="positions_held_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Employment Start Date</strong></label>
                                                    <input class="form-control" type="date" name="start_date" id="start_date">
                                                    <span id="start_date_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Employment End Date</strong></label>
                                                    <input class="form-control" type="date" name="end_date" id="end_date">
                                                    <span id="end_date_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="present_check mt-3">
                                                <input type="checkbox" name="present_box" value="1" id="present_box">Present Here
                                            </div>
                                            <span id="present_box_error" class="text-danger"></span>

                                            <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Detailed Job Descriptions</h4>

                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Responsibilities</strong></label>
                                                    <textarea class="form-control" name="job_responeblities" id="job_responeblities"></textarea>
                                                    <span id="job_responeblities_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Achievements</strong></label>
                                                    <textarea class="form-control" name="achievements" id="achievements"></textarea>
                                                    <span id="achievements_error" class="text-danger"></span>
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
                                                    <span id="skills_compantancies_error" class="text-danger"></span>
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
                    <div class="tab-pane p-3" id="navpill-6" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Mandatory Training</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        <div class="row">
                                        <h6 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Completed training programs</h6>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Training Start Date</strong></label>
                                                <input class="form-control" type="date" name="tra_start_date"  id="tra_start_date">
                                                <span id="tra_start_date_error" class="text-danger"></span>
                                            </div>
                                        </div> 
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Training End Date</strong></label>
                                                <input class="form-control" type="date" name="tra_end_date" id="tra_end_date">
                                                <span id="tra_end_date_error" class="text-danger"></span>
                                            </div>
                                        </div>   
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Institution</strong></label>
                                                <input class="form-control" type="text" name="institution"  id="institution1">
                                                <span id="institution_error_2" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Mandatory Continuing Education</strong></label>
                                                <select class="form-control form-select ps-5" name="mand_continue_education" id="mand_continue_education">
                                                    <option value="">Select mandatory continuing education</option>                                                    
                                                    <option value="Ongoing">Ongoing</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                                <span id="mand_continue_education_error" class="text-danger"></span>
                                            </div>
                                        </div> 
                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <button type="button" class="btn btn-default next-step-6 align-items-center justify-content-between" data-target="#navpill-7">Next</button>
                                        </div>
                                    </div>                     
                                    </div>                    
                                </div>
                            </div>
                        </div>
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
                                                <span id="vaccination_error" class="text-danger"></span>
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
                                                <span id="immunization_status_error" class="text-danger"></span>
                                            </div>
                                        </div>   
                                        
                            
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
                                                        <option value="{{$data->id}}" > {{$data->name}} </option>
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
                                                <input class="form-control numbers" type="tel" name="reference_contact" id="reference_contactI" value=""  maxlength="10" style="padding-right: 20rem">
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
                                                <input type="text" name="salary_expectation" class="form-control"  id="salary_expectation">
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
            </form>
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
@include('admin.script');
    
@endsection
