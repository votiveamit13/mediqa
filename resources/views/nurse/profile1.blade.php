hello2
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

    /*.left_menu {
  position: fixed;
  top: 65px;
  bottom: 10px;
  overflow: scroll;
}
.right_content {
  margin-left: 318px;
}*/
</style>
@endsection

@section('content')

<main class="main">

    <section class="mt-0">
        <div class="">
            <div class="row m-0 profile-wrapper">
                <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">
                    <!--<div id="preloader-active" style="display:none;"> <div class="preloader d-flex align-items-center justify-content-center"> <div class="preloader-inner position-relative"> <div class="text-center"><img src="https://nextjs.webwiders.in/mediqa/public/nurse/assets/imgs/template/loading.gif" alt="jobBox"></div> </div> </div> </div>-->

                    <div class="sidebar_profile">

                        <div class="box-company-profile mb-20">
                            <div class="image-compay-rel">

                                <img alt="{{  Auth::guard('nurse_middle')->user()->lastname }}" src="{{ asset( Auth::guard('nurse_middle')->user()->profile_img)}}">
                            </div>
                            <div class="row mt-10">
                                <div class="text-center">
                                    <h5 class="f-18">{{ Auth::guard('nurse_middle')->user()->preferred }}</h5>
                                    @if(Auth::guard('nurse_middle')->user()->state)
                                    <span class="card-location font-regular">{{ state_name(Auth::guard('nurse_middle')->user()->state) }} , {{ country_name(Auth::guard('nurse_middle')->user()->country) }}</span>
                                    @endif
                                    <p class="mt-0 font-md color-text-paragraph-2 mb-15">{{ specialty_name_by_id(1) }}, 2 years</p>
                                </div>
                            </div>
                        </div>

                        <div class="profile-chklst">
                            <span>Profile basicseee</span>

                            <?php
                            $get_myprofile_status = DB::table("users")->where("id", Auth::guard('nurse_middle')->user()->id)->first();
                            $get_educert_status = DB::table("user_education_cerification")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();

                            if (!empty($get_educert_status)) {
                                $get_educert_status1 = $get_educert_status->complete_status;
                            } else {
                                $get_educert_status1 = 0;
                            }

                            $get_experience_status = DB::table("user_experience")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();

                            if (!empty($get_experience_status)) {
                                $get_experience_status1 = $get_experience_status->complete_status;
                            } else {
                                $get_experience_status1 = 0;
                            }

                            $get_profile_status = $get_myprofile_status->basic_info_status + $get_myprofile_status->professional_info_status + $get_educert_status1 + $get_experience_status1;
                            $get_progress_status = round($get_profile_status / 14 * 100);

                            ?>
                            <div class="chart" id="graph1" data-percent="<?php echo $get_progress_status; ?>" data-color="#000"></div>
                        </div>

                        <!-- <div class="basic_profile dropdowns--set">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="preferences-profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Profile
          </button>
          <div class="dropdown-menu" aria-labelledby="preferences-profile">
            <a class="dropdown-item" style="cursor: pointer;" id="my_profile">Basic Information</a>
            <a class="dropdown-item" style="cursor: pointer;" id="settings">Setting</a>
          </div>
        </div>
      </div>

      <div class="prof-profile dropdowns--set">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="prof-profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Professional Profile
          </button>
          <div class="dropdown-menu" aria-labelledby="prof-profile">
          <a class="dropdown-item" id="my_profession" style="cursor: pointer;">Profession</a>
          <a class="dropdown-item" id="educert" style="cursor: pointer;">Education and Certification</a>
          <a class="dropdown-item" id="experience_info" style="cursor: pointer;">Experience</a>
          <a class="dropdown-item" id="financial_details" style="cursor: pointer;">Financial Details</a>
          <a class="dropdown-item" id="mand_training" style="cursor: pointer;">Mandatory Training</a>
          <a class="dropdown-item" id="vaccinations" style="cursor: pointer;">Vaccinations</a>
          <a class="dropdown-item" id="work_clearances" style="cursor: pointer;">Work Clearances</a>
          <a class="dropdown-item" id="professional_membership" style="cursor: pointer;">Memberships</a>
          <a class="dropdown-item" id="interview_references" style="cursor: pointer;">Interview and References</a>
          <a class="dropdown-item" id="additional_information" style="cursor: pointer;">Additional Information</a>
          </div>
        </div>
      </div>
      <div class="preferences-profile dropdowns--set">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="preferences-profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Preferences
          </button>
          <div class="dropdown-menu" aria-labelledby="preferences-profile">
            <a class="dropdown-item" style="cursor: pointer;" id="work_preferences">Find Work Preferences</a>
            <a class="dropdown-item" style="cursor: pointer;" id="personal_preferences">Personal Preferences</a>
          </div>
        </div>
      </div>
      <div class="testimonials-profile dropdowns--set">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="testimonials-profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Testimonials
          </button>
          <div class="dropdown-menu" id="testimonial_reviews" aria-labelledby="testimonials-profile">
          <a class="dropdown-item" href="#">Testimonials and Reviews</a>
          </div>
        </div>
      </div> -->

                        <div class="box-nav-tabs nav-tavs-profile mb-5 p-0 profile-icns">
                            <ul class="nav" role="tablist">
                                <li><a class="btn btn-border aboutus-icon mb-20 active profile_tabs" href="#tab-my-profile" id="my_profile" data-bs-toggle="tab" role="tab" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-user"></i> My Profileqqq</a></li>
                                <li><a class="btn btn-border recruitment-icon mb-20 profile_tabs" id="settings" href="#tab-my-profile-setting" data-bs-toggle="tab" role="tab" aria-controls="tab-my-profile-setting" aria-selected="false"><i class="fi fi-rr-settings"></i> Setting</a></li>
                                <li><a href="#tab-my-jobs" id="my_profession" class="btn btn-border recruitment-icon mb-20 profile_tabs" data-bs-toggle="tab" role="tab" aria-controls="tab-my-jobs" aria-selected="false"><i class="fi fi-rr-employee-man"></i> Profession</a></li>

                                <li><a class="btn btn-border people-icon mb-20" id="educert" data-bs-toggle="tab" role="tab" aria-controls="tab-saved-jobs" aria-selected="false"><i class="fi fi-rr-graduation-cap"></i> Education and Certifications</a></li>
                                <li><a href="#mand_training" id="mand_training" class="btn btn-border aboutus-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-chart-user"></i>Mandatory Training and Continuing Education</a></li>
                                <li><a href="#experience" id="experience_info" class="btn btn-border aboutus-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-suitcase-alt"></i> Experience</a></li>
                                <li><a href="#reference" id="reference_info" class="btn btn-border aboutus-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-suitcase-alt"></i> References</a></li>
                                <!-- <li><a href="#experience" id="experience_info" class="btn btn-border aboutus-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-chart-histogram"></i>  Financial Details</a></li> -->

                                <li><a href="#vaccinations" id="vaccinations" class="btn btn-border aboutus-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-chart-user"></i> Vaccinations</a></li>
                                <li><a href="#work_clearances" id="work_clearances" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-briefcase-arrow-right"></i> Work Clearances</a></li>
                                <li><a href="#professional_membership" id="professional_membership" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-membership-vip"></i> Professional Memberships</a></li>
                                <li><a href="#interview_references" id="interview_references" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-refer-arrow"></i> Interview</a></li>
                                <li><a href="#personal_preferences" id="personal_preferences" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-id-badge"></i> Personal Preferences</a></li>
                                <li><a href="#work_preferences" id="work_preferences" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-magnifying-glass-wave"></i>Job Search Preferences</a></li>
                                <li><a href="#testimonial_reviews" id="testimonial_reviews" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-feedback-review"></i> Testimonials and Reviews</a></li>
                                <li><a href="#additional_info" id="additional_info" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-guide-alt"></i> Additional Information</a></li>
                                <div class="mt-0 mb-20 logout-line"><a class="link-red font-md" href="{{ route("nurse.logout") }}"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Log Out</a></div>
                            </ul>


                        </div>

                    </div>


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
                        @if(!email_verified())

                        <div class="alert alert-success mt-2" role="alert">
                            <span class="d-flex align-items-center justify-content-center ">Please verify your email first to access your account </span>
                        </div>
                        @endif

                        <div class="tab-content">


                            <div class="tab-pane fade show active" id="tab-my-profile" role="tabpanel" aria-labelledby="tab-my-profile" style="display: none">
                                <div class="card shadow-sm border-0 p-4 mt-30">
                                    <h3 class="mt-0 mb-15 color-brand-1">My Account</h3>
                                    <div class="profile_update_heading">
                                        <a class="font-md color-text-paragraph-2" href="#">Update your profile</a>
                                    </div>

                                    <div class="mt-35 mb-40 box-info-profie d-flex align-items-center upload_image">

                                        <div class="image-profile">

                                            <form id="upload_profileimage" method="post" onsubmit="return upload_profileimage(event)">
                                                <img alt="{{  Auth::guard('nurse_middle')->user()->name }}" style="object-fit:cover;border-radius: 16px;display: block;width: 85px;height: 85px;" src="{{ asset( Auth::guard('nurse_middle')->user()->profile_img)}}">


                                        </div>
                                        <div class="position-relative overflow-hidden">
                                            <a class="btn btn-apply">Upload Avatar </a>
                                            @if(email_verified())
                                            <input type="file" name="image" id="fileInputs" class="position-absolute h-100" onchange="$('#upload_profileimage').submit()" accept="image/*" style="top: 0;left: 0;opacity: 0;cursor: pointer;">
                                            @endif
                                            <i class="fa fa-spinner fa-spin" id="preloadeer-active" style="display:none" aria-hidden="true"></i>

                                        </div>
                                        <!--<a class="btn btn-link">Delete</a>-->
                                        </form>
                                    </div>
                                    <div class="row form-contact">
                                        <div class="col-lg-12 col-md-12 update_profile">
                                            <form class="" id="EditProfile" onsubmit="return editedprofile()" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="font-sm color-text-mutted mb-10">First Name *</label>
                                                        <input class="form-control" type="text" name="fullname" id="firstNameI" placeholder="Steven Job" value="{{  Auth::guard('nurse_middle')->user()->name }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="font-sm color-text-mutted mb-10">Last Name *</label>
                                                        <input class="form-control" type="text" name="lastname" id="lastNameI" placeholder="Enter Your Last name" value="{{  Auth::guard('nurse_middle')->user()->lastname }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="font-sm color-text-mutted mb-10">Email *</label>
                                                        <input class="form-control" type="text" name="email" id="emailI" readonly value="{{  Auth::guard('nurse_middle')->user()->email }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="input-3">Mobile Number *</label>

                                                        <div class="row">
                                                            <!-- <div class="col-md-3">
                              <select name="countryCode" id="countryCode" class="form-control" placeholder="C. Code" aria-label="Default select example">
                                @php $country_phone_code = country_phone_code();@endphp
                                @forelse($country_phone_code as $cpc)
                                @if($cpc->phonecode!='0')
                                <option data-countryCode="GB" {{ Auth::guard('nurse_middle')->user()->country_code == $cpc->phonecode ? 'selected' : '' }} value="{{ $cpc->phonecode }}">(+{{ $cpc->phonecode }})</option>
                                <option data-countryCode="GB" {{ Auth::guard('nurse_middle')->user()->country_code == $cpc->phonecode ? 'selected' : '' }} value="{{ $cpc->phonecode }}">{{ $cpc->phonecode }}</option>
                                @endif
                                @empty
                                @endforelse
                              </select>
                            </div> -->
                                                            <div class="col-md-12 mob-adj">
                                                                <input type="hidden" name="countryCode" id="countryCode">
                                                                <input type="hidden" name="countryiso" id="country_iso" value="{{  Auth::guard('nurse_middle')->user()->country_iso }}">
                                                                <input class="form-control numbers" type="tel" required="" name="contact" id="contactI" value="{{  Auth::guard('nurse_middle')->user()->phone }}" maxlength="10">
                                                                <span id="reqTxtcontactI" class="reqError text-danger valley"></span>
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="font-sm color-text-mutted mb-10">Date Of Birth</label>
                                                            <input class="form-control" type="date" name="date_of_birth" id="date_of_birth" value="{{ Auth::guard('nurse_middle')->user()->date_of_birth }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="">
                                                            <label class="font-sm color-text-mutted mb-10">Gender</label>
                                                            <div class="gender_set">
                                                                <div class="form-check">
                                                                    <input type="radio" class="" id="gender" name="gender" value="Male" @if(Auth::guard("nurse_middle")->user()->gender == "Male") checked @endif>
                                                                    <label class="form-check-label" for="radio1">Male</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input type="radio" class="" id="gender" name="gender" value="Female" @if(Auth::guard('nurse_middle')->user()->gender == "Female") checked @endif>
                                                                    <label class="form-check-label" for="radio1">Female</label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!-- <div class="form-group col-md-12">
                          <label class="font-sm color-text-mutted mb-10">Bio</label>
                          <textarea class="form-control" rows="4" name="bio">{{ Auth::guard('nurse_middle')->user()->bio }}</textarea>
                        </div> -->
                                                    <div class="form-group">
                                                        <label class="font-sm color-text-mutted mb-10">Nationality</label>

                                                        <select name="nationality" class="form-control form-select ps-5">
                                                            <option value="">Select Nationality</option>
                                                            @php $country_data=country_name_from_db();@endphp
                                                            @foreach ($country_data as $data)
                                                            <option value="{{ $data->id }}" <?= isset(Auth::guard('nurse_middle')->user()->nationality) &&  Auth::guard('nurse_middle')->user()->nationality == $data->id ? 'selected' : '' ?>>{{ $data->nationality }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="font-sm color-text-mutted mb-10">Personal website</label>
                                                        <input class="form-control" type="text" name="website" value="{{  Auth::guard('nurse_middle')->user()->personal_website }}">
                                                    </div>
                                                </div>




                                                <div class="row">
                                                    <!--<div class="col-lg-6">-->
                                                    <!--  <div class="form-group">-->
                                                    <!--    <label class="font-sm color-text-mutted mb-10">Country</label>-->
                                                    <!--    <input class="form-control" type="text"  name="country" value="United States">-->
                                                    <!--  </div>-->
                                                    <!--</div>-->
                                                    <div class="form-group position-relative">
                                                        <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                                                        <label class="font-sm color-text-mutted mb-10">Country</label>
                                                        <select class="form-control form-select ps-5" name="country" id="countryI">
                                                            <option value="">Select Country</option>
                                                            @php $country_data=country_name_from_db();@endphp
                                                            @foreach ($country_data as $data)
                                                            <option value="{{$data->iso2}}" <?= isset(Auth::guard('nurse_middle')->user()->country) &&  Auth::guard('nurse_middle')->user()->country == $data->iso2 ? 'selected' : '' ?>> {{$data->name}} </option>
                                                            @endforeach


                                                        </select>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group position-relative">
                                                            <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                                                            <label>State *</label>
                                                            <select class="form-control form-select ps-5" name="state" id="stateI">
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
                                                            <!--<i class="fa-solid fa-location-dot position-absolute  start-0 translate-middle-y ms-3 fs-5 text-primary" style="    top: 25px!important;"></i>-->
                                                        </div>
                                                        <span id="reqTxtstateI" class="reqError text-danger valley"></span>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="font-sm color-text-mutted mb-10">City</label>
                                                            <input class="form-control" type="text" name="city" value="{{  Auth::guard('nurse_middle')->user()->city }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="font-sm color-text-mutted mb-10">Post code</label>
                                                            <input class="form-control post_code" type="text" name="post_code" value="{{  Auth::guard('nurse_middle')->user()->post_code }}" maxlength="10">
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="font-sm color-text-mutted mb-10">Home Address</label>
                                                            <input class="form-control" type="text" name="home_address" id="home_address" value="{{ Auth::guard('nurse_middle')->user()->home_address }}">
                                                        </div>
                                                    </div>
                                                    <h6 class="emergency_text">
                                                        Emergency Contact Information
                                                    </h6>
                                                    <div class="col-lg-6 row">
                                                        <div class="form-group">
                                                            <label class="font-sm color-text-mutted mb-10">Mobile No</label>

                                                            <div class="col-md-12 mob-adj">
                                                                <input type="hidden" name="emergency_countryCode" id="emergency_countryCode">
                                                                <input type="hidden" name="emergency_countryiso" id="emergency_country_iso">
                                                                <input class="form-control numbers" type="text" required="" name="emergency_conact_numeber" id="contactI_emergency" value="{{ Auth::guard('nurse_middle')->user()->emergency_conact_numeber }}" maxlength="10">
                                                                <span id="reqTxtcontactI" class="reqError valley"></span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 row">
                                                        <div class="form-group">
                                                            <label class="font-sm color-text-mutted mb-10">Email*</label>

                                                            <div class="col-md-12">

                                                                <input class="form-control" type="email" required="" name="emergergency_contact_email" id="emergergency_contact_email" placeholder="Email" value="{{ Auth::guard('nurse_middle')->user()->emergergency_contact_email }}">

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="box-button mt-15">
                                                        <button class="btn btn-apply-big font-md font-bold" @if(!email_verified()) disabled @endif type="submit" id="submitfrm">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="col-lg-12 col-md-12 change_password_div" style="display: none;">
                                            <!-- <div class="border-bottom pt-10 pb-10 mb-30"></div> -->
                                            <h6 class="mb-20">Change your password</h6>
                                            <form class="" id="ChangePassword" onsubmit="return ChangePassword()" method="POST">
                                                @csrf
                                                <div class="row">

                                                    <div class="form-group mb-3">

                                                        <label for="exampleInputEmail1" class="form-label">Old Password *</label>

                                                        <input type="password" name="old_password" id="old_password" class="form-control readonly-field" placeholder="">

                                                    </div>


                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label">New Password *</label>
                                                            <input class="form-control" type="password" name="password" id="password" class="form-control readonly-field" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Confirm New Password *</label>
                                                            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" class="form-control readonly-field" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border-bottom pt-10 pb-10"></div>

                                                <div class="box-button mt-15">
                                                    <button class="btn btn-apply-big font-md font-bold" @if(!email_verified()) disabled @endif>Update Password</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!--<div class="col-lg-6 col-md-12">-->
                                        <!--  <div class="box-skills">-->
                                        <!--    <h5 class="mt-0 color-brand-1">Skills</h5>-->
                                        <!--    <div class="form-contact">-->
                                        <!--      <div class="form-group">-->
                                        <!--        <input class="form-control search-icon" type="text" value="" placeholder="E.g. Angular, Laravel...">-->
                                        <!--      </div>-->
                                        <!--    </div>-->
                                        <!--    <div class="box-tags mt-30"><a class="btn btn-grey-small mr-10">Figma<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">Adobe XD<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">NextJS<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">React<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">App<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">Digital<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">NodeJS<span class="close-icon"></span></a></div>-->
                                        <!--    <div class="mt-40"> <span class="card-info font-sm color-text-paragraph-2">You can add up to 15 skills</span></div>-->
                                        <!--  </div>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tab-my-jobs" role="tabpanel" aria-labelledby="tab-my-jobs" style="display: none">


                                <div class="card shadow-sm border-0 p-4 mt-30">
                                    <h3 class="mt-0 color-brand-1 mb-2">Profession</h3>
                                    <!-- <a class="font-md color-text-paragraph-2" href="#">Add your profession/s here, and any relevant registrations and qualifications</a> -->
                                    <h6 class="emergency_text">
                                        Please Select all specialties you have experience in:

                                    </h6>
                                    <form id="profession_form" method="POST" onsubmit="return myFunction1()">
                                        @csrf
                                        <div class="condition_set">
                                            <div class="form-group drp--clr">
                                                <label class="form-label" for="input-1">Type of Nurse?</label>
                                                <input type="hidden" name="user_id" class="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                                                <input type="hidden" name="ntype" class="ntype" value="{{ Auth::guard('nurse_middle')->user()->nurseType }}">
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

                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="type-of-nurse" name="nurseType[]" id="nurse_type" multiple="multiple"></select>
                                            </div>
                                            <span id="reqnurseTypeId" class="reqError text-danger valley"></span>
                                        </div>


                                        <div class="result--show ">
                                            <div class="container p-0">
                                                <div class="row g-2">
                                                    @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                                                    <?php
                                                    $i = 1;
                                                    ?>
                                                    <input type="hidden" name="nursing_result_one" class="nursing_result_one" value="{{ Auth::guard('nurse_middle')->user()->entry_level_nursing }}">
                                                    <input type="hidden" name="nursing_result_two" class="nursing_result_two" value="{{ Auth::guard('nurse_middle')->user()->registered_nurses }}">
                                                    <input type="hidden" name="nursing_result_three" class="nursing_result_three" value="{{ Auth::guard('nurse_middle')->user()->advanced_practioner }}">
                                                    <input type="hidden" name="np_result" class="np_result" value="{{ Auth::guard('nurse_middle')->user()->nurse_prac }}">
                                                    <input type="hidden" name="specialties_result" class="specialties_result" value="{{ Auth::guard('nurse_middle')->user()->specialties }}">
                                                    <input type="hidden" name="adults_result" class="adults_result" value="{{ Auth::guard('nurse_middle')->user()->adults }}">
                                                    <input type="hidden" name="maternity_result" class="maternity_result" value="{{ Auth::guard('nurse_middle')->user()->maternity }}">
                                                    <input type="hidden" name="padneonatal_result" class="padneonatal_result" value="{{ Auth::guard('nurse_middle')->user()->paediatrics_neonatal }}">
                                                    <input type="hidden" name="community_result" class="community_result" value="{{ Auth::guard('nurse_middle')->user()->community }}">
                                                    <input type="hidden" name="surgical_preoperative_result" class="surgical_preoperative_result" value="{{ Auth::guard('nurse_middle')->user()->surgical_preoperative }}">
                                                    <input type="hidden" name="operatingroom_result" class="operatingroom_result" value="{{ Auth::guard('nurse_middle')->user()->operating_room }}">
                                                    <input type="hidden" name="operatingscout_result" class="operatingscout_result" value="{{ Auth::guard('nurse_middle')->user()->operating_room_scout }}">
                                                    <input type="hidden" name="operatingscrub_result" class="operatingscrub_result" value="{{ Auth::guard('nurse_middle')->user()->operating_room_scrub }}">
                                                    <input type="hidden" name="surgical_ob_result" class="surgical_ob_result" value="{{ Auth::guard('nurse_middle')->user()->surgical_obstrics_gynacology }}">
                                                    <input type="hidden" name="neonatal_care_result" class="neonatal_care_result" value="{{ Auth::guard('nurse_middle')->user()->neonatal_care }}">
                                                    <input type="hidden" name="paedia_surgical_result" class="paedia_surgical_result" value="{{ Auth::guard('nurse_middle')->user()->paedia_surgical_preoperative }}">
                                                    <input type="hidden" name="pad_op_room_result" class="pad_op_room_result" value="{{ Auth::guard('nurse_middle')->user()->pad_op_room }}">
                                                    <input type="hidden" name="pad_qr_scout_result" class="pad_qr_scout_result" value="{{ Auth::guard('nurse_middle')->user()->pad_qr_scout }}">
                                                    <input type="hidden" name="pad_qr_scrub_result" class="pad_qr_scrub_result" value="{{ Auth::guard('nurse_middle')->user()->pad_qr_scrub }}">
                                                    <input type="hidden" name="nurse_degree" class="nurse_degree" value="{{ Auth::guard('nurse_middle')->user()->degree }}">
                                                    @foreach($specialty as $spl)
                                                    <?php
                                                    $nursing_data = DB::table("practitioner_type")->where('parent', $spl->id)->orderBy('name')->get();
                                                    ?>
                                                    <input type="hidden" name="nursing_result" class="nursing_result-{{ $i }}" value="{{ $spl->id }}">
                                                    <div class="nursing_data form-group drp--clr col-md-4 d-none drpdown-set nursing_{{ $spl->id }}" id="nursing_level-{{ $i }}">
                                                        <label class="form-label" for="input-2">{{ $spl->name }}</label>
                                                        <ul id="nursing_entry-{{ $i }}" style="display:none;">
                                                            @foreach($nursing_data as $nd)
                                                            <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>

                                                            @endforeach
                                                            <!-- Add more list items as needed -->
                                                        </ul>
                                                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nursing_entry-{{ $i }}" name="nursing_type_{{ $i }}[]" multiple="multiple"></select>
                                                    </div>
                                                    <?php
                                                    $i++;
                                                    ?>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                        <div class="np_submenu d-none">

                                            <div class="form-group drp--clr">
                                                <?php
                                                $np_data = DB::table("practitioner_type")->where('parent', '179')->get();
                                                ?>

                                                <label class="form-label" for="input-1">Nurse Practitioner (NP):</label>
                                                <ul id="nurse_practitioner_menu" style="display:none;">
                                                    @foreach($np_data as $nd)
                                                    <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                                    @endforeach

                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nurse_practitioner_menu" name="nurse_practitioner_menu[]" multiple="multiple"></select>

                                            </div>

                                        </div>
                                        <div class="condition_set">
                                            <div class="form-group drp--clr">
                                                <input type="hidden" name="sub_speciality_value" class="sub_speciality_value" value="">
                                                <label class="form-label" for="input-1">Specialties</label>
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
                                            </div>
                                            <span id="reqspecialties" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="speciality_boxes row result--show">
                                            <?php
                                            $l = 1;
                                            ?>
                                            @foreach($JobSpecialties as $ptl)
                                            <?php
                                            $speciality_data = DB::table("speciality")->where('parent', $ptl->id)->get();
                                            ?>
                                            <input type="hidden" name="speciality_result" class="speciality_result-{{ $l }}" value="{{ $ptl->id }}">
                                            <div class="speciality_data form-group drp--clr drpdown-set d-none col-md-6 speciality_{{ $ptl->id }}" id="specility_level-{{ $l }}">
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

                                            <div class="surgical_row_data form-group drp--clr d-none col-md-12">
                                                <label class="form-label" for="input-1">Surgical Preoperative and Postoperative Care:</label>
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
                                        <div class="paediatric_surgical_div">

                                            <div class="surgicalpad_row_data form-group drp--clr d-none col-md-12">
                                                <label class="form-label" for="input-1">Paediatric Surgical Preop. and Postop. Care:
                                                </label>
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
                                        <div class="specialty_sub_boxes row">
                                            <?php
                                            $speciality_surgical_data = DB::table("speciality")->where('parent', '96')->get();
                                            $w = 1;
                                            ?>
                                            @foreach($speciality_surgical_data as $ssd)
                                            <input type="hidden" name="speciality_result" class="speciality_surgical_result-{{ $w }}" value="{{ $ssd->id }}">
                                            <div class="surgical_row-{{ $w }} surgicalopcboxes-{{ $ssd->id }} form-group drp--clr d-none drpdown-set col-md-4">
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
                                            <?php
                                            $speciality_surgical_datamater = DB::table("speciality")->where('parent', '233')->get();
                                            $p = 1;
                                            ?>

                                            <div class="surgicalobs_row form-group drp--clr d-none drpdown-set col-md-12">
                                                <label class="form-label" for="input-1">Surgical Obstetrics and Gynecology (OB/GYN):</label>

                                                <ul id="surgical_obs_care" style="display:none;">
                                                    @foreach($speciality_surgical_datamater as $ssd)
                                                    <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                                    @endforeach
                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_obs_care" name="surgical_obs_care[]" multiple="multiple"></select>
                                            </div>
                                            <?php
                                            $speciality_surgical_datamater = DB::table("speciality")->where('parent', '250')->get();

                                            ?>
                                            <div class="neonatal_row form-group drp--clr drpdown-set d-none col-md-12">
                                                <label class="form-label" for="input-1">Neonatal Care:</label>

                                                <ul id="neonatal_care" style="display:none;">
                                                    @foreach($speciality_surgical_datamater as $ssd)
                                                    <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                                    @endforeach
                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="neonatal_care" name="neonatal_care[]" multiple="multiple"></select>
                                            </div>
                                            <?php
                                            $speciality_surgical_datap = DB::table("speciality")->where('parent', '285')->get();
                                            $q = 1;
                                            ?>
                                            @foreach($speciality_surgical_datap as $ssd)
                                            <input type="hidden" name="speciality_result" class="surgical_rowp_result-{{ $q }}" value="{{ $ssd->id }}">
                                            <div class="surgical_rowp surgicalpad_row-{{ $ssd->id }} surgical_rowp-{{ $q }} form-group drp--clr d-none drpdown-set col-md-4">
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
                                            <?php
                                            $q++;
                                            ?>
                                            @endforeach
                                        </div>
                                        <div class="form-group level-drp">
                                            <label class="form-label" for="input-1">What is your overall level of experience in nursing/midwifery?
                                            </label>
                                            <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                                            <select class="form-input mr-10 select-active" name="assistent_level">

                                                @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}" @if(Auth::guard('nurse_middle')->user()->assistent_level == $i) selected @endif>{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                                                    @endfor
                                            </select>
                                        </div>
                                        <!-- <div class="" id="mid_select">
                    <div class="form-group drp--clr drpdown-set">
                      
                      <label class="form-label" for="input-1">Nurse & Midwife degree</label>
                       <?php
                        $nurse_midwife_degree = DB::table("degree")->where('status', '1')->orderBy('name')->get();
                        ?>
                        <ul id="nurse_degree" style="display:none;">
                             @foreach($nurse_midwife_degree as $ptl)
                              <li data-value="{{ $ptl->id }}">{{ $ptl->name }}</li>
                              
                              @endforeach
                        </ul>
                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nurse_degree" name="degree[]" multiple="multiple"></select>
                    </div>
                    <span id="reqdegree" class="reqError text-danger valley"></span>
                  </div>    -->

                                        <div class="professional_bio professional_employee_status">
                                            <div class="form-group col-md-12">
                                                <label class="form-label" for="input-1">Current Employment Status</label>
                                                <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                                                <select class="form-input mr-10 select-active" name="employee_status" onchange="employeeStatus(this.value)">
                                                    <option value="">Select Employee Status</option>
                                                    <option value="Permanent" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Permanent") selected @endif>Permanent</option>
                                                    <option value="Temporary" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Temporary") selected @endif>Temporary</option>

                                                </select>
                                            </div>
                                            <span id="reqemployee_status" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="professional_permanent" @if(Auth::guard('nurse_middle')->user()->permanent_status == NULL) style="display: none;" @endif>
                                            <div class="form-group col-md-12">
                                                <label class="form-label" for="input-1">Permanent</label>
                                                <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                                                <select class="form-input mr-10 select-active" name="permanent_status">
                                                    <option value="">Select</option>
                                                    <option value="Full-time" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Full-time") selected @endif>Full-time</option>
                                                    <option value="Part-time" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Part-time") selected @endif>Part-time</option>
                                                    <option value="Agency Nurse/Midwife" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Agency Nurse/Midwife") selected @endif>Agency Nurse/Midwife</option>
                                                    <option value="Freelance" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Freelance") selected @endif>Freelance</option>
                                                    <option value="Local" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Local") selected @endif>Local</option>
                                                    <option value="Volunteer" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Volunteer") selected @endif>Volunteer</option>

                                                </select>
                                            </div>
                                            <span id="reqemployee_status" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="professional_temporary" @if(Auth::guard('nurse_middle')->user()->temporary_status == NULL) style="display: none;" @endif>
                                            <div class="form-group col-md-12">
                                                <label class="form-label" for="input-1">Temporary</label>
                                                <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                                                <select class="form-input mr-10 select-active" name="temporary_status">
                                                    <option value="">Select</option>
                                                    <option value="Temporary" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Temporary") selected @endif>Temporary</option>
                                                    <option value="Contract" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Contract") selected @endif>Contract</option>
                                                    <option value="Term Contract" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Term Contract") selected @endif>Term Contract</option>
                                                    <option value="Travel" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Travel") selected @endif>Travel</option>
                                                    <option value="Per Diem" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Per Diem") selected @endif>Per Diem</option>
                                                    <option value="Local" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Local") selected @endif>Local</option>
                                                    <option value="On-Call" @if(Auth::guard('nurse_middle')->user()->temporary_status == "On-Call") selected @endif>On-Call</option>
                                                    <option value="PRN (Pro Re Nata)" @if(Auth::guard('nurse_middle')->user()->temporary_status == "PRN (Pro Re Nata)") selected @endif>PRN (Pro Re Nata)</option>
                                                    <option value="Casual" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Casual") selected @endif>Casual</option>
                                                    <option value="Locum tenens (temporary substitute)" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Locum tenens (temporary substitute)") selected @endif>Locum tenens (temporary substitute)</option>
                                                    <option value="Agency Nurse/Midwife" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Agency Nurse/Midwife") selected @endif>Agency Nurse/Midwife</option>
                                                    <option value="Seasonal" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Seasonal") selected @endif>Seasonal</option>
                                                    <option value="Freelance" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Freelance") selected @endif>Freelance</option>
                                                    <option value="Internship" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Internship") selected @endif>Internship</option>
                                                    <option value="Apprenticeship" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Apprenticeship") selected @endif>Apprenticeship</option>
                                                    <option value="Residency" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Residency") selected @endif>Residency</option>
                                                    <option value="Volunteer" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Volunteer") selected @endif>Volunteer</option>


                                                </select>
                                            </div>
                                            <span id="reqemployee_status" class="reqError text-danger valley"></span>
                                        </div>
                                        <script type="text/javascript">
                                            function employeeStatus(value) {
                                                if (value == "Permanent") {
                                                    $(".professional_permanent").show();
                                                    $(".professional_temporary").hide();
                                                } else {
                                                    if (value == "Temporary") {
                                                        $(".professional_temporary").show();
                                                        $(".professional_permanent").hide();
                                                    }
                                                }
                                            }
                                        </script>
                                        <div class="professional_bio">
                                            <div class="form-group col-md-12">
                                                <label class="font-sm color-text-mutted mb-10">Professional Bio</label>
                                                <textarea class="form-control" rows="4" name="bio">{{ Auth::guard('nurse_middle')->user()->bio }}</textarea>
                                            </div>
                                            <span id="reqprofessional_bio" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="declaration_box">
                                            <input type="checkbox" name="declare_information" class="declare_information" value="1" @if(!empty($educationData)) @if(Auth::guard('nurse_middle')->user()->declaration_status == 1) checked @endif @endif>
                                            <label for="declare_information">I declare that the information provided is true and correct</label>
                                        </div>
                                        <span id="reqdeclare_information" class="reqError text-danger valley"></span>
                                        <div class="box-button mt-15">
                                            <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitProfession">Save Changes</button>
                                        </div>
                                    </form>
                                </div>



                            </div>

                            <div class="tab-pane fade" id="tab-educert" role="tabpanel" aria-labelledby="tab-educert" style="display: none">
                                <div class="card shadow-sm border-0 p-4 mt-30">
                                    <h3 class="mt-0 color-brand-1 mb-20">Education and Certifications</h3>
                                    <h6 class="emergency_text">
                                        Educational Background
                                    </h6>
                                    <form id="educert_form" method="POST" novalidate onsubmit="return educert()">
                                        @csrf
                                        <?php
                                        $educationData = DB::table("user_education_cerification")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();

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
                                        <div class="form-group">
                                            <div class="" id="mid_select">
                                                <div class="form-group drp--clr drpdown-set">
                                                    <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                                                    <input type="hidden" name="nurse_degree_one" class="nurse_degree_one" value="{{ Auth::guard('nurse_middle')->user()->degree }}">
                                                    <label class="form-label" for="input-1">Nurse & Midwife degree</label>
                                                    <?php
                                                    $nurse_midwife_degree = DB::table("degree")->where('status', '1')->orderBy('name')->get();
                                                    ?>
                                                    <ul id="ndegree" style="display:none;">
                                                        @foreach($nurse_midwife_degree as $ptl)
                                                        <li data-value="{{ $ptl->id }}">{{ $ptl->name }}</li>

                                                        @endforeach
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="ndegree" name="ndegree[]" multiple="multiple"></select>
                                                </div>
                                                <span id="reqdegree" class="reqError text-danger valley"></span>
                                            </div>
                                        </div>

                                        <div class="form-group level-drp">
                                            <label class="form-label" for="input-1">Institutions (Please start with the most relevant)</label>
                                            <input class="form-control" type="text" name="institution" value="@if(!empty($educationData)){{ $educationData->institution }}@endif">
                                            <span id="reqinstitute" class="reqError text-danger valley"></span>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group level-drp">
                                                    <label class="form-label" for="input-1">Graduation Date</label>
                                                    <input class="form-control graduation_start_date" type="date" name="graduation_start_date" value="@if(!empty($educationData)){{ $educationData->graduate_start_date }}@endif" onchange="changeDate(event);">
                                                    <span id="reqstartdate" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group level-drp">
                                                    <label class="form-label" for="input-1">Upload Degree & Transcript</label>
                                                    <?php
                                                    $user_id = Auth::guard('nurse_middle')->user()->id;
                                                    ?>
                                                    <input class="form-control degree_transcript" type="file" name="degree_transcript[]" onchange="changeImg('{{ $user_id }}')" multiple="">
                                                    <div class="degree_transcript_imgs">
                                                        @if(!empty($educationData) && $educationData->degree_transcript)
                                                        <?php
                                                        $dtran_img = json_decode($educationData->degree_transcript);
                                                        //print_r($dtran_img);
                                                        $i = 1;
                                                        $user_id = Auth::guard('nurse_middle')->user()->id;
                                                        ?>

                                                        @if(!empty($dtran_img))
                                                        @foreach($dtran_img as $tranimg)
                                                        <div class="trans_img trans_img-{{ $i }}">
                                                            <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}" target="_blank"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                            <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg('{{ $i }}','{{ $user_id }}','{{ $tranimg }}')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                                        </div>
                                                        <?php
                                                        $i++;
                                                        ?>
                                                        @endforeach
                                                        @endif

                                                        @endif
                                                    </div>
                                                    <span id="reqdegreetranscript" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>

                                        </div>
                                        <h6 class="emergency_text">
                                            General Certifications/Licences:
                                        </h6>
                                        <div class="form-group level-drp">
                                            <input type="hidden" name="prof_cert_new" class="prof_cert_new" value="@if(!empty($educationData)){{ $educationData->professional_certifications }}@endif">
                                            <label class="form-label" for="input-1">Please select all that apply</label>
                                            <?php
                                            $certificates = DB::table("professional_certificate")->orderBy("ordering_id", "asc")->get();
                                            ?>
                                            <ul id="profess_cert" style="display:none;">
                                                @foreach($certificates as $cert)
                                                <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                                                @endforeach

                                            </ul>
                                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="profess_cert" name="professional_certification[]" multiple="multiple"></select>
                                        </div>
                                        <span id="reqcertificate" class="reqError text-danger valley"></span>
                                        <?php
                                        $education_data = DB::table("user_education_cerification")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
                                        //echo $education_data->acls_data;
                                        ?>
                                        <div class="professional_certification_div">


                                            <div class="form-group level-drp @if($educationData && $educationData->acls_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdiv">
                                                <input type="hidden" name="pro_cert_acls" class="pro_cert_acls" value="@if(!empty($educationData)){{ $a_data_json }}@endif">
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
                                                <?php
                                                $i = 0;
                                                ?>
                                                @if(!empty($acls_data1))
                                                @foreach($acls_data1 as $a_data)
                                                <?php
                                                $acls_first_word = strtok($a_data->acls_certification_id, " ");;

                                                $acls_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $acls_first_word));
                                                ?>

                                                <div class="acls_{{ $acls_first_word_one }}">
                                                    <h6>{{ $a_data->acls_certification_id }}</h6>
                                                    <div class="license_number_div row license_number_acls">

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
                                                            <input class="form-control acls_imgs_{{ $acls_first_word_one }} acls_upload_certification-{{ $i }}" type="file" name="acls_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','acls_imgs','{{ $acls_first_word_one }}')" multiple="">
                                                            <span id="reqaclsuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $acls_img = (array)json_decode($getedufieldsdata->acls_imgs);
                                                            } else {
                                                                $acls_img = '';
                                                            }


                                                            if (!empty($acls_img)) {
                                                                $acls_img_data = json_decode($acls_img[$acls_first_word_one]);
                                                            } else {
                                                                $acls_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
                                                            ?>
                                                            <div class="acls_imgs{{ $acls_first_word_one }}">
                                                                @if(!empty($acls_img_data))
                                                                @foreach($acls_img_data as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imgacls_imgs{{ $acls_first_word_one }}{{ $l }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $acls_first_word_one }}','acls_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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
                                                <?php
                                                $i++;
                                                ?>
                                                @endforeach
                                                @endif
                                            </div>

                                            <div class="form-group level-drp  @if($education_data && $education_data->bls_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivone">
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
                                                <span id="reqblsvalid" class="reqError text-danger valley"></span>
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
                                                    <h6>{{ $b_data->bls_certification_id }}</h6>
                                                    <div class="license_number_div row license_number_bls">

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                            <input type="hidden" name="blsnamearr[]" class="bls_input_{{ $b_data->bls_certification_id }}" value="{{ $b_data->bls_certification_id }}">
                                                            <input class="form-control bls_license_number bls_license_number-{{ $i }}" type="text" name="bls_license_number[]" value="{{ $b_data->bls_license_number }}">
                                                            <span id="reqblslicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Expiry</label>
                                                            <input class="form-control blsexpiry blsexpiry-{{ $i }}" type="date" name="bls_expiry[]" value="{{ $b_data->bls_expiry }}">
                                                            <span id="reqblsexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                            <input class="form-control degree_transcript bls_imgs_{{ $bls_first_word_one }} bls_upload_certification bls_upload_certification-{{ $i }}" type="file" name="bls_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','bls_imgs','{{ $bls_first_word_one }}')" multiple="">
                                                            <span id="reqblsuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $bls_img = (array)json_decode($getedufieldsdata->bls_imgs);
                                                            } else {
                                                                $bls_img = '';
                                                            }


                                                            if (!empty($bls_img)) {
                                                                $bls_img_data = json_decode($bls_img[$bls_first_word_one]);
                                                            } else {
                                                                $bls_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
                                                            ?>
                                                            <div class="bls_imgs{{ $bls_first_word_one }}">
                                                                @if(!empty($bls_img_data))
                                                                @foreach($bls_img_data as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imgbls_imgs{{ $bls_first_word_one }}{{ $l }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $bls_first_word_one }}','bls_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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
                                                <?php
                                                $i++;
                                                ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group level-drp @if($education_data && $education_data->cpr_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivtwo">
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
                                                <span id="reqcprvalid" class="reqError text-danger valley"></span>
                                            </div>

                                            <div class="cpr_certification_div">
                                                @if(!empty($cpr_data1))
                                                <?php
                                                $i = 0;
                                                ?>
                                                @foreach($cpr_data1 as $c_data)
                                                <?php
                                                $cpr_first_word = strtok($c_data->cpr_certification_id, " ");;

                                                $cpr_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $cpr_first_word));
                                                ?>

                                                <div class="cpr_{{ $cpr_first_word_one }}">
                                                    <h6>{{ $c_data->cpr_certification_id }}</h6>
                                                    <div class="license_number_div row license_number_cpr">

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                            <input type="hidden" name="cprnamearr[]" class="cpr_input_{{ $c_data->cpr_certification_id }}" value="{{ $c_data->cpr_certification_id }}">
                                                            <input class="form-control cpr_license_number cpr_license_number-{{ $i }}" type="text" name="cpr_license_number[]" value="{{ $c_data->cpr_license_number }}">
                                                            <span id="reqcprlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Expiry</label>
                                                            <input class="form-control cprexpiry cprexpiry-{{ $i }}" type="date" name="cpr_expiry[]" value="{{ $c_data->cpr_expiry }}">
                                                            <span id="reqcprexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                            <input class="form-control degree_transcript cpr_imgs_{{ $cpr_first_word_one }} cpr_upload_certification cpr_upload_certification-{{ $i }}" type="file" name="cpr_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','cpr_imgs','{{ $cpr_first_word_one }}')" multiple>
                                                            <span id="reqcpruploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $cpr_img = (array)json_decode($getedufieldsdata->cpr_imgs);
                                                            } else {
                                                                $cpr_img = '';
                                                            }



                                                            if (!empty($cpr_img)) {
                                                                $cpr_img_data = json_decode($cpr_img[$cpr_first_word_one]);
                                                            } else {
                                                                $cpr_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
                                                            ?>
                                                            <div class="cpr_imgs{{ $cpr_first_word_one }}">
                                                                @if(!empty($cpr_img_data))
                                                                @foreach($cpr_img_data as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imgcpr_imgs{{ $cpr_first_word_one }}{{ $l }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $cpr_first_word_one }}','cpr_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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
                                                <?php
                                                $i++;
                                                ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group level-drp @if($education_data && $education_data->nrp_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivthree">
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
                                                <span id="reqnrpvalid" class="reqError text-danger valley"></span>
                                            </div>

                                            <div class="nrp_certification_div">
                                                @if(!empty($nrp_data1))
                                                <?php
                                                $i = 0;
                                                ?>
                                                @foreach($nrp_data1 as $n_data)
                                                <?php
                                                $nrp_first_word = strtok($n_data->nrp_certification_id, " ");;

                                                $nrp_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $nrp_first_word));
                                                ?>

                                                <div class="nrp_{{ $nrp_first_word_one }}">
                                                    <h6>{{ $n_data->nrp_certification_id }}</h6>
                                                    <div class="license_number_div row license_number_nrp">

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                            <input type="hidden" name="nrpnamearr[]" class="nrp_input_{{ $n_data->nrp_certification_id }}" value="{{ $n_data->nrp_certification_id }}">
                                                            <input class="form-control nrp_license_number nrp_license_number-{{ $i }}" type="text" name="nrp_license_number[]" value="{{ $n_data->nrp_license_number }}">
                                                            <span id="reqnrplicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Expiry</label>
                                                            <input class="form-control nrpexpiry nrpexpiry-{{ $i }}" type="date" name="nrp_expiry[]" value="{{ $n_data->nrp_expiry }}">
                                                            <span id="reqnrpexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                            <input class="form-control degree_transcript nrp_imgs_{{ $nrp_first_word_one }} nrp_upload_certification nrp_upload_certification-{{ $i }}" type="file" name="nrp_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','nrp_imgs','{{ $nrp_first_word_one }}')" multiple="">
                                                            <span id="reqnrpuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $nrp_img = (array)json_decode($getedufieldsdata->nrp_imgs);
                                                            } else {
                                                                $nrp_img = '';
                                                            }

                                                            if (!empty($nrp_img)) {
                                                                $nrp_img_data = json_decode($nrp_img[$nrp_first_word_one]);
                                                            } else {
                                                                $nrp_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
                                                            ?>
                                                            <div class="nrp_imgs{{ $nrp_first_word_one }}">
                                                                @if(!empty($nrp_img_data))
                                                                @foreach($nrp_img_data as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imgnrp_imgs{{ $nrp_first_word_one }}{{ $l }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $nrp_first_word_one }}','nrp_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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
                                                <?php
                                                $i++;
                                                ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group level-drp @if($education_data && $education_data->pals_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivfour">
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
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="pls_data" name="pls_data[]" multiple="multiple"></select>
                                                <span id="reqplsvalid" class="reqError text-danger valley"></span>
                                            </div>
                                            <div class="pls_certification_div">
                                                @if(!empty($pls_data1))
                                                <?php
                                                $i = 0;
                                                ?>
                                                @foreach($pls_data1 as $p_data)
                                                <?php
                                                $pls_first_word = strtok($p_data->pls_certification_id, " ");;

                                                $pls_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $pls_first_word));
                                                ?>

                                                <div class="pls_{{ $pls_first_word_one }}">
                                                    <h6>{{ $p_data->pls_certification_id }}</h6>
                                                    <div class="license_number_div row license_number_pls">

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                            <input type="hidden" name="plsnamearr[]" class="pls_input_{{ $p_data->pls_certification_id }}" value="{{ $p_data->pls_certification_id }}">
                                                            <input class="form-control pls_license_number pls_license_number-{{ $i }}" type="text" name="pls_license_number[]" value="{{ $p_data->pls_license_number }}">
                                                            <span id="reqplslicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Expiry</label>
                                                            <input class="form-control plsexpiry plsexpiry-{{ $i }}" type="date" name="pls_expiry[]" value="{{ $p_data->pls_expiry }}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                            <input class="form-control degree_transcript pls_imgs_{{ $pls_first_word_one }} pls_upload_certification pls_upload_certification-{{ $i }}" type="file" name="pls_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','pls_imgs','{{ $pls_first_word_one }}')" multiple="">
                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $pls_img = (array)json_decode($getedufieldsdata->pls_imgs);
                                                            } else {
                                                                $pls_img = '';
                                                            }

                                                            if (!empty($pls_img)) {
                                                                $pls_img_data = json_decode($pls_img[$pls_first_word_one]);
                                                            } else {
                                                                $pls_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
                                                            ?>
                                                            <div class="pls_imgs{{ $pls_first_word_one }}">
                                                                @if(!empty($pls_img_data))
                                                                @foreach($pls_img_data as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imgpls_imgs{{ $pls_first_word_one }}{{ $l }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $pls_first_word_one }}','pls_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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
                                                <?php
                                                $i++;
                                                ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group level-drp @if($education_data && $education_data->rn_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivfive">
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
                                                <span id="reqrnvalid" class="reqError text-danger valley"></span>
                                            </div>
                                            <div class="rn_certification_div">
                                                @if(!empty($rn_data1))
                                                <?php
                                                $i = 0;
                                                ?>
                                                @foreach($rn_data1 as $r_data)
                                                <?php
                                                $rn_first_word = strtok($r_data->rn_certification_id, " ");;

                                                $rn_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $rn_first_word));
                                                ?>

                                                <div class="rn_{{ $rn_first_word_one }}">
                                                    <h6>{{ $r_data->rn_certification_id }}</h6>
                                                    <div class="license_number_div row license_number_rn">

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                            <input type="hidden" name="rnnamearr[]" class="rn_input_{{ $r_data->rn_certification_id }}" value="{{ $r_data->rn_certification_id }}">
                                                            <input class="form-control rn_license_number rn_license_number-{{ $i }}" type="text" name="rn_license_number[]" value="{{ $r_data->rn_license_number }}">
                                                            <span id="reqrnlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Expiry</label>
                                                            <input class="form-control rnexpiry rnexpiry-{{ $i }}" type="date" name="rn_expiry[]" value="{{ $r_data->rn_expiry }}">
                                                            <span id="reqrnexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                            <input class="form-control degree_transcript rn_imgs_{{ $rn_first_word_one }} rn_upload_certification rn_upload_certification-{{ $i }}" type="file" name="rn_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','rn_imgs','{{ $rn_first_word_one }}')" multiple="">
                                                            <span id="reqrnuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $rn_img = (array)json_decode($getedufieldsdata->rn_imgs);
                                                            } else {
                                                                $rn_img = '';
                                                            }

                                                            if (!empty($rn_img)) {
                                                                $rn_img_data = json_decode($rn_img[$rn_first_word_one]);
                                                            } else {
                                                                $rn_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
                                                            ?>
                                                            <div class="rn_imgs{{ $rn_first_word_one }}">
                                                                @if(!empty($rn_img_data))
                                                                @foreach($rn_img_data as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imgrn_imgs{{ $rn_first_word_one }}{{ $l }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $rn_first_word_one }}','rn_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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
                                                <?php $i++; ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group level-drp @if($education_data && $education_data->np_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivtwelfth">
                                                <input type="hidden" name="pro_cert_np" class="pro_cert_np" value="@if(!empty($educationData)){{ $np_data_json }}@endif">
                                                <label class="form-label" for="input-1">NP (Nurse Practioner) / (APRN) Advanced Practice Registered Nurse</label>
                                                <?php
                                                $np_data = DB::table("professional_certificate_table")->where("cert_id", "18")->get();
                                                ?>
                                                <ul id="np_data" style="display:none;">
                                                    @foreach($np_data as $data)
                                                    <li data-value="{{ $data->name }}">{{ $data->name }}</li>
                                                    @endforeach

                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="np_data" name="np_data[]" multiple="multiple"></select>
                                                <span id="reqnpvalid" class="reqError text-danger valley"></span>
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
                                                    <div class="license_number_div row license_number_np">

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                            <input type="hidden" name="npnamearr[]" class="np_input_{{ $n_data->np_certification_id }}" value="{{ $n_data->np_certification_id }}">
                                                            <input class="form-control np_license_number np_license_number-{{ $i }}" type="text" name="np_license_number[]" value="{{ $n_data->np_license_number }}">
                                                            <span id="reqnplicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Expiry</label>
                                                            <input class="form-control npexpiry npexpiry-{{ $i }}" type="date" name="np_expiry[]" value="{{ $n_data->np_expiry }}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                            <input class="form-control degree_transcript np_imgs_{{ $np_first_word_one }} np_upload_certification np_upload_certification-{{ $i }}" type="file" name="np_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','np_imgs','{{ $np_first_word_one }}')" multiple="">
                                                            <span id="reqnpuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $np_img = (array)json_decode($getedufieldsdata->np_imgs);
                                                            } else {
                                                                $np_img = '';
                                                            }

                                                            if (!empty($np_img)) {
                                                                $np_img_data = json_decode($np_img[$np_first_word_one]);
                                                            } else {
                                                                $np_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
                                                            ?>
                                                            <div class="np_imgs{{ $np_first_word_one }}">
                                                                @if(!empty($np_img_data))
                                                                @foreach($np_img_data as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imgnp_imgs{{ $np_first_word_one }}{{ $l }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $np_first_word_one }}','np_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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


                                            <div class="form-group level-drp @if($education_data && $education_data->cna_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivsix">
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
                                                <?php
                                                $i = 0;
                                                ?>
                                                @foreach($cna_data1 as $cn_data)
                                                <?php
                                                $cna_first_word = strtok($cn_data->cn_certification_id, " ");

                                                $cna_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $cna_first_word));
                                                ?>

                                                <div class="cna_{{ $cna_first_word_one }}">
                                                    <h6>{{ $cn_data->cn_certification_id }}</h6>
                                                    <div class="license_number_div row license_number_cna">

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                            <input type="hidden" name="cnnamearr[]" class="cn_input_{{ $cn_data->cn_certification_id }}" value="{{ $cn_data->cn_certification_id }}">
                                                            <input class="form-control cn_license_number cn_license_number-{{ $i }}" type="text" name="cn_license_number[]" value="{{ $cn_data->cn_license_number }}">
                                                            <span id="reqcnlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Expiry</label>
                                                            <input class="form-control cnexpiry cnexpiry-{{ $i }}" type="date" name="cn_expiry[]" value="{{ $cn_data->cn_expiry }}">
                                                            <span id="reqcnexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                            <input class="form-control degree_transcript cn_imgs_{{ $cna_first_word_one }} cn_upload_certification cn_upload_certification-{{ $i }}" type="file" name="cn_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','cn_imgs','{{ $cna_first_word_one }}')" multiple="">
                                                            <span id="reqcnuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $cn_img = (array)json_decode($getedufieldsdata->cn_imgs);
                                                            } else {
                                                                $cn_img = '';
                                                            }

                                                            if (!empty($cn_img)) {
                                                                $cn_img_data = json_decode($cn_img[$cna_first_word_one]);
                                                            } else {
                                                                $cn_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
                                                            ?>
                                                            <div class="cn_imgs{{ $cna_first_word_one }}">
                                                                @if(!empty($cn_img_data))
                                                                @foreach($cn_img_data as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imgcn_imgs{{ $cn_first_word_one }}{{ $l }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $cn_first_word_one }}','cn_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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
                                                <?php
                                                $i++;
                                                ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group level-drp @if($education_data && $education_data->lpn_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivseven">
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
                                            <div class="lpn_certification_div">
                                                @if(!empty($lpn_data1))
                                                <?php
                                                $i = 0;
                                                ?>
                                                @foreach($lpn_data1 as $l_data)
                                                <?php
                                                $lpn_first_word = strtok($l_data->lpn_certification_id, " ");;

                                                $lpn_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $lpn_first_word));
                                                ?>

                                                <div class="lpn_{{ $lpn_first_word_one }}">
                                                    <h6>{{ $l_data->lpn_certification_id }}</h6>
                                                    <div class="license_number_div row license_number_lpn">

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                            <input type="hidden" name="lpnnamearr[]" class="lpn_input_{{ $l_data->lpn_certification_id }}" value="{{ $l_data->lpn_certification_id }}">
                                                            <input class="form-control lpn_license_number lpn_license_number-{{ $i }}" type="text" name="lpn_license_number[]" value="{{ $l_data->lpn_license_number }}">
                                                            <span id="reqlpnlicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Expiry</label>
                                                            <input class="form-control lpnexpiry lpnexpiry-{{ $i }}" type="date" name="lpn_expiry[]" value="{{ $l_data->lpn_expiry }}">
                                                            <span id="reqlpnexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                            <input class="form-control degree_transcript lpn_imgs_{{ $lpn_first_word_one }} lpn_upload_certification lpn_upload_certification-{{ $i }}" type="file" name="lpn_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','lpn_imgs','{{ $lpn_first_word_one }}')" multiple="">
                                                            <span id="reqlpnuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $lpn_img = (array)json_decode($getedufieldsdata->lpn_imgs);
                                                            } else {
                                                                $lpn_img = '';
                                                            }

                                                            if (!empty($lpn_img)) {
                                                                $lpn_img_data = json_decode($lpn_img[$lpn_first_word_one]);
                                                            } else {
                                                                $lpn_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
                                                            ?>
                                                            <div class="lpn_imgs{{ $lpn_first_word_one }}">
                                                                @if(!empty($lpn_img_data))
                                                                @foreach($lpn_img_data as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imglpn_imgs{{ $lpn_first_word_one }}{{ $l }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $lpn_first_word_one }}','lpn_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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
                                                <?php
                                                $i++;
                                                ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group level-drp @if($education_data && $education_data->crna_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdiveight">
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
                                                <?php
                                                $i = 0;
                                                ?>
                                                @foreach($crna_data1 as $crna_data)
                                                <?php
                                                $crna_first_word = strtok($crna_data->crna_certification_id, " ");;

                                                $crna_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $crna_first_word));
                                                ?>

                                                <div class="crna_{{ $crna_first_word_one }}">
                                                    <h6>{{ $crna_data->crna_certification_id }}</h6>
                                                    <div class="license_number_div row license_number_crna">

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                                                            <input type="hidden" name="crnanamearr[]" class="crna_input_{{ $crna_data->crna_certification_id }}" value="{{ $crna_data->crna_certification_id }}">
                                                            <input class="form-control crna_license_number crna_license_number-{{ $i }}" type="text" name="crna_license_number[]" value="{{ $crna_data->crna_license_number }}">
                                                            <span id="reqcrnalicencevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Expiry</label>
                                                            <input class="form-control crnaexpiry crnaexpiry-{{ $i }}" type="date" name="crna_expiry[]" value="{{ $crna_data->crna_expiry }}">
                                                            <span id="reqcrnaexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                                            <input class="form-control degree_transcript crna_imgs_{{ $crna_first_word_one }} crna_upload_certification crna_upload_certification-{{ $i }}" type="file" name="crna_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','crna_imgs','{{ $crna_first_word_one }}')" multiple="">
                                                            <span id="reqcrnauploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $crna_img = (array)json_decode($getedufieldsdata->crna_imgs);
                                                            } else {
                                                                $crna_img = '';
                                                            }

                                                            if (!empty($crna_img)) {
                                                                $crna_img_data = json_decode($crna_img[$crna_first_word_one]);
                                                            } else {
                                                                $crna_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
                                                            ?>
                                                            <div class="crna_imgs{{ $crna_first_word_one }}">
                                                                @if(!empty($crna_img_data))
                                                                @foreach($crna_img_data as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imgcrna_imgs{{ $crna_first_word_one }}{{ $l }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $crna_first_word_one }}','crna_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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
                                                <?php
                                                $i++;
                                                ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group level-drp @if($education_data && $education_data->cnm_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivnine">
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
                                                <span id="reqcnmvalid" class="reqError text-danger valley"></span>
                                            </div>
                                            <div class="cnm_certification_div">
                                                @if(!empty($cnm_data1))
                                                <?php
                                                $i = 0;
                                                ?>
                                                @foreach($cnm_data1 as $cnm_data)
                                                <?php
                                                $cnm_first_word = strtok($cnm_data->cnm_certification_id, " ");;

                                                $cnm_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $cnm_first_word));
                                                ?>

                                                <div class="cnm_{{ $cnm_first_word_one }}">
                                                    <h6>{{ $cnm_data->cnm_certification_id }}</h6>
                                                    <div class="license_number_div row license_number_cnm">

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
                                                            <input class="form-control degree_transcript cnm_imgs_{{ $cnm_first_word_one }} cnm_upload_certification cnm_upload_certification-{{ $i }}" type="file" name="cnm_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','cnm_imgs','{{ $cnm_first_word_one }}')" multiple="">
                                                            <span id="reqcnmuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $cnm_img = (array)json_decode($getedufieldsdata->cnm_imgs);
                                                            } else {
                                                                $cnm_img = '';
                                                            }

                                                            if (!empty($cnm_img)) {
                                                                $cnm_img_data = json_decode($cnm_img[$cnm_first_word_one]);
                                                            } else {
                                                                $cnm_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
                                                            ?>
                                                            <div class="cnm_imgs{{ $cnm_first_word_one }}">
                                                                @if(!empty($cnm_img_data))
                                                                @foreach($cnm_img_data as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imgcnm_imgs{{ $cnm_first_word_one }}{{ $l }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $cnm_first_word_one }}','cnm_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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
                                                <?php
                                                $i++;
                                                ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group level-drp @if($education_data && $education_data->ons_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivten">
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
                                                <span id="reqonsvalid" class="reqError text-danger valley"></span>
                                            </div>
                                            <div class="ons_certification_div">
                                                @if(!empty($ons_data1))
                                                <?php
                                                $i = 0;
                                                ?>
                                                @foreach($ons_data1 as $ons_data)
                                                <?php
                                                $ons_first_word = strtok($ons_data->ons_certification_id, " ");;

                                                $ons_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $ons_first_word));
                                                ?>

                                                <div class="ons_{{ $ons_first_word_one }}">
                                                    <h6>{{ $ons_data->ons_certification_id }}</h6>
                                                    <div class="license_number_div row license_number_ons">

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
                                                            <input class="form-control degree_transcript ons_imgs_{{ $ons_first_word_one }} ons_upload_certification ons_upload_certification-{{ $i }}" type="file" name="ons_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','ons_imgs','{{ $ons_first_word_one }}')" multiple="">
                                                            <span id="reqonsuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $ons_img = (array)json_decode($getedufieldsdata->ons_imgs);
                                                            } else {
                                                                $ons_img = '';
                                                            }

                                                            if (!empty($ons_img)) {
                                                                $ons_img_data = json_decode($ons_img[$ons_first_word_one]);
                                                            } else {
                                                                $ons_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
                                                            ?>
                                                            <div class="ons_imgs{{ $ons_first_word_one }}">
                                                                @if(!empty($ons_img_data))
                                                                @foreach($ons_img_data as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imgons_imgs{{ $ons_first_word_one }}{{ $l }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $ons_first_word_one }}','ons_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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
                                                <?php
                                                $i++;
                                                ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group level-drp @if($education_data && $education_data->msw_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdiveleven">
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
                                                <?php
                                                $i = 0;
                                                ?>
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
                                                            <input class="form-control degree_transcript msw_imgs_{{ $msw_first_word_one }} msw_upload_certification msw_upload_certification-{{ $i }}" type="file" name="msw_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','msw_imgs','{{ $msw_first_word_one }}')" multiple>
                                                            <span id="reqmswuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $msw_img = (array)json_decode($getedufieldsdata->msw_imgs);
                                                            } else {
                                                                $msw_img = '';
                                                            }

                                                            if (!empty($msw_img)) {
                                                                $msw_img_data = json_decode($msw_img[$msw_first_word_one]);
                                                            } else {
                                                                $msw_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
                                                            ?>
                                                            <div class="msw_imgs{{ $msw_first_word_one }}">
                                                                @if(!empty($msw_img_data))
                                                                @foreach($msw_img_data as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imgacls_imgs{{ $acls_first_word_one }}{{ $l }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $msw_first_word_one }}','msw_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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
                                                <?php
                                                $i++;
                                                ?>
                                                @endif
                                            </div>
                                            <div class="form-group level-drp @if($education_data && $education_data->ain_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivthirteen">
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
                                                <?php
                                                $i = 0;
                                                ?>
                                                @foreach($ain_data1 as $ain_data)
                                                <?php
                                                $ain_first_word = strtok($ain_data->ain_certification_id, " ");;

                                                $ain_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $ain_first_word));
                                                ?>

                                                <div class="ain_{{ $ain_first_word_one }}">
                                                    <h6>{{ $ain_data->ain_certification_id }}</h6>
                                                    <div class="license_number_div row license_number_ain">

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
                                                            <input class="form-control degree_transcript ain_imgs_{{ $ain_first_word_one }} ain_upload_certification ain_upload_certification-{{ $i }}" type="file" name="ain_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','ain_imgs','{{ $ain_first_word_one }}')" multiple="">
                                                            <span id="reqainuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $ain_img = (array)json_decode($getedufieldsdata->ain_imgs);
                                                            } else {
                                                                $ain_img = '';
                                                            }

                                                            if (!empty($ain_img)) {
                                                                $ain_img_data = json_decode($ain_img[$ain_first_word_one]);
                                                            } else {
                                                                $ain_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
                                                            ?>
                                                            <div class="ain_imgs{{ $ain_first_word_one }}">
                                                                @if(!empty($ain_img_data))
                                                                @foreach($ain_img_data as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imgain_imgs{{ $ain_first_word_one }}{{ $l }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $ain_first_word_one }}','ain_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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
                                                <?php
                                                $i++;
                                                ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group level-drp @if($education_data && $education_data->rpn_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivfourteen">
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
                                                <?php
                                                $i = 0;
                                                ?>
                                                @foreach($rpn_data1 as $rpn_data)
                                                <?php
                                                $rpn_first_word = strtok($rpn_data->rpn_certification_id, " ");;

                                                $rpn_first_word_one = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $rpn_first_word));
                                                ?>

                                                <div class="rpn_{{ $rpn_first_word_one }}">
                                                    <h6>{{ $rpn_data->rpn_certification_id }}</h6>
                                                    <div class="license_number_div row license_number_rpn">

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
                                                            <input class="form-control degree_transcript rpn_imgs_{{ $rpn_first_word_one }} rpn_upload_certification rpn_upload_certification-{{ $i }}" type="file" name="rpn_upload_certification[{{ $i }}][]" onchange="changeImg1('{{ $user_id }}','{{ $i }}','rpn_imgs','{{ $rpn_first_word_one }}')" multiple="">
                                                            <span id="reqrpnuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $rpn_img = (array)json_decode($getedufieldsdata->rpn_imgs);
                                                            } else {
                                                                $rpn_img = '';
                                                            }

                                                            if (!empty($rpn_img)) {
                                                                $rpn_img_data = json_decode($rpn_img[$rpn_first_word_one]);
                                                            } else {
                                                                $rpn_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
                                                            ?>
                                                            <div class="rpn_imgs{{ $rpn_first_word_one }}">
                                                                @if(!empty($rpn_img_data))
                                                                @foreach($rpn_img_data as $tranimg)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imgrpn_imgs{{ $rpn_first_word_one }}{{ $l }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $tranimg }}"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $l }}','{{ $user_id }}','{{ $tranimg }}','{{ $rpn_first_word_one }}','rpn_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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
                                                <?php
                                                $i++;
                                                ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group level-drp @if($education_data && $education_data->nl_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivfiveteen">
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
                                        </div>
                                        <div class="another_certifications">
                                            <h6 class="emergency_text">
                                                Other certifications
                                            </h6>
                                            <?php
                                            if (!empty($educationData)) {
                                                $additional_certificate = json_decode($educationData->additional_certification);
                                            } else {
                                                $additional_certificate = "";
                                            }
                                            $i = 1;
                                            $l = 0;
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
                                                    <input class="form-control ano_certifi_imgs_certifi_{{$i}}" type="file" name="certificate_upload_certification[]" onchange="changeAnoImg('{{ $user_id }}','{{ $l }}','ano_certifi_imgs','certifi_{{$i}}')" multiple="">
                                                    <?php
                                                    $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                    if (!empty($getedufieldsdata)) {
                                                        $ano_certifi_img = (array)json_decode($getedufieldsdata->ano_certifi_imgs);
                                                    } else {
                                                        $ano_certifi_img = '';
                                                    }


                                                    if (!empty($ano_certifi_img)) {
                                                        // $ano_certifi_img_data = json_decode($ano_certifi_img["certifi_$i"]);
                                                        $key = "certifi_$i";
                                                        $ano_certifi_img_data = isset($ano_certifi_img[$key]) ? json_decode($ano_certifi_img[$key], true) : [];
                                                    } else {
                                                        $ano_certifi_img_data = "";
                                                    }
                                                    //print_r($acls_img[$acls_first_word_one]);


                                                    //print_r($dtran_img);

                                                    $user_id = Auth::guard('nurse_middle')->user()->id;
                                                    ?>
                                                    <div class="ano_certifi_imgscertifi_{{ $i }}">
                                                        @if(!empty($ano_certifi_img_data))
                                                        @foreach($ano_certifi_img_data as $ano_img)
                                                        <div class="trans_img edu_img-{{ $i }} edu_imgano_certifi_imgscertifi_{{ $l }}">
                                                            <a href="{{ url('/public/uploads/education_degree') }}/{{ $ano_img }}"><i class="fa fa-file"></i>{{ $ano_img }}</a>
                                                            <div class="close_btn close_btn-{{ $i }}" onclick="deleteanoImg1('{{ $l }}','{{ $user_id }}','{{ $ano_img }}','certifi_{{$i}}','ano_certifi_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                                                        </div>
                                                        <?php
                                                        $l++;
                                                        ?>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>

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
                                            function add_listcertfication() {
                                                var licence_div_count = $(".license_number_anothercertifications").length;
                                                console.log("licence_div_count", licence_div_count);
                                                licence_div_count++;
                                                var user_id = "{{ $user_id }}";
                                                var ano_cer_img_txt = 'ano_certifi_imgs'
                                                var name = 'certifi' + '_' + licence_div_count;
                                                // $(".another_certifications").append('<div class="license_number_div license_number_div_'+licence_div_count+' row license_number_anothercertifications"><div class="form-group col-md-6"><label class="form-label" for="input-1">Certificate '+licence_div_count+'</label><input class="form-control additional_certificate_field additional_certificate_field-'+licence_div_count+'" type="text" name="training_certificate[]"><span id="reqcertname-'+licence_div_count+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control cert_licence_num cert_licence_num-'+licence_div_count+'" type="text" name="certificate_license_number[]"><span id="reqcertlicense-'+licence_div_count+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control cert_expiry cert_expiry-'+licence_div_count+'" type="date" name="certificate_expiry[]"><span id="reqcertexpiry-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Regulating Body</label><input class="form-control additional_regulating_body additional_regulating_body-'+licence_div_count+'" type="text" name="regulating_body[]"><span id="reqcertregulating_body-'+licence_div_count+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control  ano_certifi_imgs_'+name+' additional_certifications-'+licence_div_count+'" type="file" name="certificate_upload_certification['+licence_div_count+'][]" onchange="changeAnoImg('+user_id+','+licence_div_count+',ano_certifi_imgs,'+name+')" multiple></div><div class="ano_certifi_imgs'+name+'" ></div><div class="col-md-12"><div class="add_new_certification_div mb-3 mt-3"><a style="cursor: pointer;" onclick="delete_certification1('+licence_div_count+')">- Delete certification/Licence</a></div></div></div>');
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
                                        <div class="add_new_certification_div mb-3 mt-3">
                                            <a style="cursor: pointer;" onclick="delete_certification1(${licence_div_count})">- Delete certification/Licence</a>
                                        </div>
                                    </div>
                                </div>
                            `);

                                            }
                                        </script>

                                        <span id="reqcertificate" class="reqError text-danger valley"></span>

                                        <!-- <h6 class="emergency_text">
                          Additional Training 
                        </h6>
            <div class="row">
              <?php
                if (!empty($educationData)) {
                    $certificate_data = json_decode($educationData->additional_training_data);
                } else {
                    $certificate_data = "";
                }

                ?>
              <div class="certification_box">
                <?php
                $i = 1;
                ?>
                @if(!empty($certificate_data))
                  <p>Please add most relevant courses/workshops</p>
                  @foreach($certificate_data as $c_data)
                    <h6>Certification/Licence {{ $i }}</h6>
                    
                    <div class="license_number_div row license_number_additional">
                        <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Courses/workshops</label>
                          <input class="form-control" type="text" name="training_courses[]" value="{{ $c_data->training_courses }}">
                        </div>
                        <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Certification/Licence Number</label>
                          <input class="form-control" type="text" name="additional_license_number[]" value="{{ $c_data->additional_license_number }}">
                        </div>
                        <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Expiry</label>
                          <input class="form-control" type="date" name="additional_expiry[]" value="{{ $c_data->additional_expiry }}">
                        </div>
                        <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Upload your certification/Licence</label>
                          <input class="form-control" type="file" name="additional_upload_certification[]">
                          @if($c_data->additional_upload_certification)
                          <img src="{{ url('/public/uploads/certificates') }}/{{ $c_data->additional_upload_certification }}" style="width:100px;height: 70px; object-fit: cover;">
                          @endif
                        </div>
                      </div>
                      <?php
                        $i++;
                        ?>
                  @endforeach
                @else
                <h6>Certification/Licence 1</h6>
                <div class="license_number_div row license_number_additional">
                        <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Courses/workshops</label>
                          <input class="form-control" type="text" name="training_courses[]">
                        </div>
                        <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Certification/Licence Number</label>
                          <input class="form-control" type="text" name="additional_license_number[]">
                        </div>
                        <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Expiry</label>
                          <input class="form-control" type="date" name="additional_expiry[]">
                        </div>
                        <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Upload your certification/Licence</label>
                          <input class="form-control" type="file" name="additional_upload_certification[]">
                        </div>
                      </div>
                @endif
                          
                          
                            
                          </div>
                          
                          <div class="add_new_certification_div mb-3 mt-3">
                            <a style="cursor: pointer;" onclick="add_certfication()">+ Add another certification/Licence</a>
                          </div>
                          <script type="text/javascript">
                            var licence_div_count = $(".license_number_additional").length;
                            console.log("licence_div_count",licence_div_count);
                            function add_certfication(){
                              licence_div_count++;
                              $(".certification_box").append('<h6>Certification/Licence '+licence_div_count+'</h6><div class="license_number_div row license_number_additional"><div class="form-group col-md-6"><label class="form-label" for="input-1">Courses/workshops</label><input class="form-control" type="text" name="training_courses[]"></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control" type="text" name="additional_license_number[]"></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control" type="date" name="additional_expiry[]"></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control" type="file" name="additional_upload_certification[]"></div></div>');
                              
                            }
                          </script>
                         
                        </div> -->
                                        {{-- CORRECT BY HARSHITA --}}
                                        {{-- </div> --}}
                                        <span id="reqcertificate" class="reqError text-danger valley"></span>
                                        <!-- <h6 class="emergency_text">
                          Licenses Information 
                        </h6>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">License Number</label>
                          <input class="form-control" type="text" name="license_number" value="@if(!empty($educationData)){{ $educationData->licence_number }}@endif">
                          <span id="reqlicensenum" class="reqError text-danger valley"></span>
                        </div>
                        <div class="row state-row">
                        <div class="form-group position-relative col-md-6">
                         
                          <label class="font-sm color-text-mutted mb-10">Country</label>
                          <select class="form-control form-select ps-5" name="country" id="countryLicense">
                            <option value="">Select Country</option>
                            @php $country_data=country_name_from_db();@endphp
                            <?php
                            $user_edudata = DB::table("user_education_cerification")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
                            ?>
                            @foreach ($country_data as $data)
                            <option value="{{$data->iso2}}" @if(!empty($educationData))@if($user_edudata->country == $data->iso2) selected @endif @endif> {{$data->name}} </option>
                            @endforeach


                          </select>
                          <span id="reqcountry" class="reqError text-danger valley"></span>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group position-relative">
                            
                            <label>State *</label>
                            <select class="form-control form-select ps-5" name="state" id="stateLicense">
                              @php
                              if(isset( $educationData->country)){
                              $state_data =state_name_array($educationData->country);
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
                            
                          </div>
                          <span id="reqTxtstateI" class="reqError text-danger valley"></span>
                        </div>
                        </div>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Expiration Date</label>
                          <input class="form-control" type="date" name="expiration_date" value="@if(!empty($educationData)){{ $educationData->expiration_date }}@endif">
                          <span id="reqexpiration_date" class="reqError text-danger valley"></span>
                        </div> -->
                                        <div class="declaration_box">
                                            <input type="checkbox" name="declare_information_edu" class="declare_information_edu" value="1" @if(!empty($educationData)) @if($educationData->declaration_status == 1) checked @endif @endif>
                                            <label for="declare_information1">I declare that the information provided is true and correct</label>
                                        </div>
                                        <span id="reqdeclare_information1" class="reqError text-danger valley"></span>

                                        <div class="box-button mt-15">
                                            <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitEducation">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-experience" role="tabpanel" aria-labelledby="tab-educert" style="display: none">
                                <div class="card shadow-sm border-0 p-4 mt-30">
                                    <h3 class="mt-0 color-brand-1 mb-2">Hello</h3>
                                    <h6>Please add your full nursing work experience to strengthen your profile and get hired faster. Please keep update as your experience grows:</h6>
                                    <?php
                                    $experienceData = DB::table("user_experience")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
                                    ?>
                                    <form id="experience_form" method="POST" novalidate onsubmit="return updateExperience()">
                                        @csrf
                                        <div class="form-group level-drp">
                                            <!-- <label class="form-label" for="input-1">Total Year of Experience</label> -->
                                            <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                                            <!-- <input class="form-control" type="text" required="" name="year_experience" value="@if(!empty($educationData))@endif"> -->
                                            <input type="hidden" name="nursing_result_one_experience" class="nursing_result_one_experience" value="{{ Auth::guard('nurse_middle')->user()->entry_level_nursing }}">
                                            <input type="hidden" name="nursing_result_two_experience" class="nursing_result_two_experience" value="{{ Auth::guard('nurse_middle')->user()->registered_nurses }}">
                                            <input type="hidden" name="nursing_result_three_experience" class="nursing_result_three_experience" value="{{ Auth::guard('nurse_middle')->user()->advanced_practioner }}">
                                            <input type="hidden" name="np_result_experience" class="np_result_experience" value="{{ Auth::guard('nurse_middle')->user()->nurse_prac }}">
                                            <input type="hidden" name="specialties_result_experience" class="specialties_result_experience" value="{{ Auth::guard('nurse_middle')->user()->specialties }}">
                                            <input type="hidden" name="adults_result_experience" class="adults_result_experience" value="{{ Auth::guard('nurse_middle')->user()->adults }}">
                                            <input type="hidden" name="maternity_result_experience" class="maternity_result_experience" value="{{ Auth::guard('nurse_middle')->user()->maternity }}">
                                            <input type="hidden" name="padneonatal_result_experience" class="padneonatal_result_experience" value="{{ Auth::guard('nurse_middle')->user()->paediatrics_neonatal }}">
                                            <input type="hidden" name="community_result_experience" class="community_result_experience" value="{{ Auth::guard('nurse_middle')->user()->community }}">
                                            <input type="hidden" name="surgical_preoperative_result_experience" class="surgical_preoperative_result_experience" value="{{ Auth::guard('nurse_middle')->user()->surgical_preoperative }}">
                                            <input type="hidden" name="operatingroom_result_experience" class="operatingroom_result_experience" value="{{ Auth::guard('nurse_middle')->user()->operating_room }}">
                                            <input type="hidden" name="operatingscout_result_experience" class="operatingscout_result_experience" value="{{ Auth::guard('nurse_middle')->user()->operating_room_scout }}">
                                            <input type="hidden" name="operatingscrub_result_experience" class="operatingscrub_result_experience" value="{{ Auth::guard('nurse_middle')->user()->operating_room_scrub }}">
                                            <input type="hidden" name="surgical_ob_result_experience" class="surgical_ob_result_experience" value="{{ Auth::guard('nurse_middle')->user()->surgical_obstrics_gynacology }}">
                                            <input type="hidden" name="neonatal_care_result_experience" class="neonatal_care_result_experience" value="{{ Auth::guard('nurse_middle')->user()->neonatal_care }}">
                                            <input type="hidden" name="paedia_surgical_result_experience" class="paedia_surgical_result_experience" value="{{ Auth::guard('nurse_middle')->user()->paedia_surgical_preoperative }}">
                                            <input type="hidden" name="pad_op_room_result_experience" class="pad_op_room_result_experience" value="{{ Auth::guard('nurse_middle')->user()->pad_op_room }}">
                                            <input type="hidden" name="pad_qr_scout_result_experience" class="pad_qr_scout_result_experience" value="{{ Auth::guard('nurse_middle')->user()->pad_qr_scout }}">
                                            <input type="hidden" name="pad_qr_scrub_result_experience" class="pad_qr_scrub_result_experience" value="{{ Auth::guard('nurse_middle')->user()->pad_qr_scrub }}">
                                        </div>

                                        <span id="reqlevelexpereience" class="reqError text-danger valley"></span>

                                        <?php
                                        if (!empty($experienceData)) {
                                            $work_experience_data = json_decode($experienceData->work_experience);
                                        } else {
                                            $work_experience_data = "";
                                        }

                                        ?>

                                        <div class="previous_employeers">
                                            <?php
                                            $i = 1;
                                            ?>
                                            @if(!empty($work_experience_data))
                                            @foreach($work_experience_data as $w_data)
                                            <h6 class="emergency_text">
                                                Previous Employers {{ $i }}
                                            </h6>
                                            <div class="form-group level-drp">

                                                <label class="form-label" for="input-1">Position Held</label>
                                                <select class="form-control" name="positions_held[]">
                                                    <option value="">Position Held</option>
                                                    <option value="Team Member" @if($w_data->positions_held1 == "Team Member") selected @endif>Team Member</option>
                                                    <option value="Team Leader" @if($w_data->positions_held1 == "Team Leader") selected @endif>Team Leader</option>
                                                    <option value="Educator" @if($w_data->positions_held1 == "Educator") selected @endif>Educator</option>
                                                    <option value="Manager" @if($w_data->positions_held1 == "Manager") selected @endif>Manager</option>
                                                    <option value="Clinical Specialist" @if($w_data->positions_held1 == "Clinical Specialist") selected @endif>Clinical Specialist</option>
                                                </select>
                                                <span id="reqpositionheld" class="reqError text-danger valley"></span>

                                            </div>
                                            <span id="reqpositionheld" class="reqError text-danger valley"></span>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">Employment Start Date</label>
                                                        <input class="form-control employeement_start_date employeement_start_date-{{ $i }}" type="date" name="start_date[]" value="{{ $w_data->start_date1 }}" onchange="changeEmployeementEndDate('{{ $i }}');" onkeydown="return false">
                                                        <span id="reqempsdate" class="reqError text-danger valley"></span>
                                                    </div>
                                                    <div class="declaration_box mb-3">
                                                        <input class="currently_position currently_position-{{ $i }}" type="checkbox" name="present_box[]" onclick="currently_position('{{ $i }}')" value="1" @if(!empty($w_data->present_box1 == 1 )) checked @endif>I am currently in this position at the moment

                                                    </div>
                                                </div>
                                                <div class="col-md-6 empl_end_date-{{ $i }}" @if($w_data->present_box1 == 1) style="display:none;" @endif>
                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">Employment End Date</label>
                                                        <input class="form-control employeement_end_date employeement_end_date-{{ $i }}" type="date" name="end_date[]" value="{{ $w_data->end_date1 }}" onkeydown="return false">
                                                        <span id="reqemployeementenddate" class="reqError text-danger valley"></span>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">Employment type</label>
                                                        <select class="form-control" name="employeement_type[]">
                                                            <option value="">Employment type</option>
                                                            <option value="Agency" @if($w_data->employeement_type1 == "Agency") selected @endif>Agency</option>
                                                            <option value="Staffing Agency" @if($w_data->employeement_type1 == "Staffing Agency") selected @endif>Staffing Agency</option>
                                                        </select>
                                                        <span id="reqemptype" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="emergency_text">
                                                Detailed Job Descriptions
                                            </h6>
                                            <div class="form-group level-drp">
                                                <label class="form-label" for="input-1">Responsibilities</label>
                                                <textarea class="form-control" name="job_responeblities[]">{{ $w_data->job_responeblities1 }}</textarea>
                                                <span id="reqresposiblities" class="reqError text-danger valley"></span>
                                            </div>
                                            <div class="form-group level-drp">
                                                <label class="form-label" for="input-1">Achievements</label>
                                                <textarea class="form-control" name="achievements[]">{{ $w_data->achievements1 }}</textarea>
                                                <span id="reqachievements" class="reqError text-danger valley"></span>
                                            </div>
                                            <?php
                                            $i++;
                                            ?>
                                            @endforeach
                                            @else

                                            <div class="condition_set">
                                                <h6 class="emergency_text previous_employeers_head">
                                                    Work Experienceeeqq 1
                                                </h6>
                                                <div class="form-group drp--clr">
                                                    <label class="form-label" for="input-1">Type of Nurse?</label>
                                                    <input type="hidden" name="user_id" class="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                                                    <input type="hidden" name="ntypeexperience" class="ntypeexperience" value="{{ Auth::guard('nurse_middle')->user()->nurseType }}">
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

                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="type-of-nurse-experience" name="nurseType[]" id="nurse_type_experience" multiple="multiple"></select>
                                                </div>
                                                <span id="reqnurseTypeId" class="reqError text-danger valley"></span>
                                            </div>
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
                                                        <input type="hidden" name="nursing_result_experience" class="nursing_result_experience-{{ $i }}" value="{{ $spl->id }}">
                                                        <div class="nursing_data form-group drp--clr col-md-12 d-none drpdown-set nursing_{{ $spl->id }}" id="nursing_level_experience-{{ $i }}">
                                                            <label class="form-label" for="input-2">{{ $spl->name }}</label>
                                                            <ul id="nursing_entry_experience-{{ $i }}" style="display:none;">
                                                                @foreach($nursing_data as $nd)
                                                                <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                                                @endforeach

                                                            </ul>
                                                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nursing_entry_experience-{{ $i }}" name="nursing_type_{{ $i }}[]" multiple="multiple"></select>
                                                        </div>
                                                        <?php
                                                        $i++;
                                                        ?>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
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
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nurse_practitioner_menu_experience" name="nurse_practitioner_menu_experience[]" multiple="multiple"></select>

                                                </div>

                                            </div>
                                            <div class="condition_set">
                                                <div class="form-group drp--clr">
                                                    <input type="hidden" name="sub_speciality_value" class="sub_speciality_value" value="">
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
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="specialties_experience" name="specialties_experience[]" multiple="multiple"></select>
                                                </div>
                                                <span id="reqspecialties" class="reqError text-danger valley"></span>
                                            </div>
                                            <div class="speciality_boxes row result--show">
                                                <?php
                                                $l = 1;
                                                ?>
                                                @foreach($JobSpecialties as $ptl)
                                                <?php
                                                $speciality_data = DB::table("speciality")->where('parent', $ptl->id)->get();
                                                ?>
                                                <input type="hidden" name="speciality_result" class="speciality_result_experience-{{ $l }}" value="{{ $ptl->id }}">
                                                <div class="speciality_data form-group drp--clr drpdown-set d-none col-md-6 speciality_{{ $ptl->id }}" id="specility_level_experience-{{ $l }}">
                                                    <label class="form-label" for="input-2">{{ $ptl->name }}</label>
                                                    <ul id="speciality_entry_experience-{{ $l }}" style="display:none;">
                                                        @foreach($speciality_data as $sd)
                                                        <li data-value="{{ $sd->id }}">{{ $sd->name }}</li>

                                                        @endforeach
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="speciality_entry_experience-{{ $l }}" name="speciality_entry_experience_{{ $l }}[]" multiple="multiple"></select>

                                                </div>
                                                <?php
                                                $l++;
                                                ?>
                                                @endforeach
                                            </div>
                                            <div class="specialty_entry_one_experience"></div>
                                            <div class="specialty_entry_two_experience"></div>
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
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_row_box_experience" name="surgical_row_box_experience[]" multiple="multiple"></select>
                                                </div>
                                            </div>
                                            <div class="paediatric_surgical_div_experience">

                                                <div class="surgicalpad_row_data_experience form-group drp--clr d-none col-md-12">
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
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_rowpad_box_experience" name="surgical_rowpad_box_experience[]" multiple="multiple"></select>
                                                </div>
                                            </div>
                                            <div class="specialty_sub_boxes_experience row">
                                                <?php
                                                $speciality_surgical_data = DB::table("speciality")->where('parent', '96')->get();
                                                $w = 1;
                                                ?>
                                                @foreach($speciality_surgical_data as $ssd)
                                                <input type="hidden" name="speciality_result" class="speciality_surgical_result_experience-{{ $w }}" value="{{ $ssd->id }}">
                                                <div class="surgical_row_experience-{{ $w }} surgicalopcboxes-{{ $ssd->id }} form-group drp--clr d-none drpdown-set">
                                                    <label class="form-label" for="input-1">{{ $ssd->name }}</label>
                                                    <?php
                                                    $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->get();
                                                    ?>
                                                    <ul id="surgical_operative_care_experience-{{ $w }}" style="display:none;">
                                                        @foreach($speciality_surgicalsub_data as $sssd)
                                                        <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_operative_care_experience-{{ $w }}" name="surgical_operative_care_{{ $w }}[]" multiple="multiple"></select>
                                                    @foreach($speciality_surgicalsub_data as $sssd)


                                                    <div class="d-none form-group level-drp level_id-{{ $sssd->id }}">
                                                        <label class="form-label" for="input-1">What is your Level of experience in {{ $sssd->name }}:

                                                        </label>
                                                        <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                                                        <select class="form-input mr-10 select-active" name="assistent_level">

                                                            @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}" @if(Auth::guard('nurse_middle')->user()->assistent_level == $i) selected @endif>{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                                                                @endfor
                                                        </select>
                                                    </div>

                                                    @endforeach
                                                </div>
                                                <?php
                                                $w++;
                                                ?>

                                                @endforeach
                                                <div class="surgical_operative_care_level_experience"></div>
                                                <div class="surgical_operative_care_level_experience_two"></div>
                                                <div class="surgical_operative_care_level_experience_three"></div>
                                                <?php
                                                $speciality_surgical_datamater = DB::table("speciality")->where('parent', '233')->get();
                                                $p = 1;
                                                ?>

                                                <div class="surgicalobs_row_experience form-group drp--clr d-none drpdown-set col-md-12">
                                                    <label class="form-label" for="input-1">Surgical Obstetrics and Gynecology (OB/GYN):</label>

                                                    <ul id="surgicalobs_row_data_experience" style="display:none;">
                                                        @foreach($speciality_surgical_datamater as $ssd)
                                                        <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgicalobs_row_data_experience" name="surgical_obs_care[]" multiple="multiple"></select>
                                                </div>
                                                <?php
                                                $speciality_surgical_datamater = DB::table("speciality")->where('parent', '250')->get();

                                                ?>
                                                <div class="neonatal_row_experience form-group drp--clr drpdown-set d-none col-md-12">
                                                    <label class="form-label" for="input-1">Neonatal Care:</label>

                                                    <ul id="neonatal_care_experience" style="display:none;">
                                                        @foreach($speciality_surgical_datamater as $ssd)
                                                        <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="neonatal_care_experience" name="neonatal_care_experience[]" multiple="multiple"></select>
                                                </div>
                                                <div class="neonatal_care_experience_level"></div>
                                                <?php
                                                $speciality_surgical_datap = DB::table("speciality")->where('parent', '285')->get();
                                                $q = 1;
                                                ?>
                                                @foreach($speciality_surgical_datap as $ssd)
                                                <input type="hidden" name="speciality_result" class="surgical_rowp_result_experience-{{ $q }}" value="{{ $ssd->id }}">
                                                <div class="surgical_rowp_experience surgicalpad_row_experience-{{ $ssd->id }} surgical_rowp_experience-{{ $q }} form-group drp--clr d-none drpdown-set col-md-4">
                                                    <label class="form-label" for="input-1">{{ $ssd->name }}</label>
                                                    <?php
                                                    $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->orderBy('name')->get();
                                                    ?>
                                                    <ul id="surgical_operative_carep_experience-{{ $q }}" style="display:none;">
                                                        @foreach($speciality_surgicalsub_data as $sssd)
                                                        <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_operative_carep_experience-{{ $q }}" name="surgical_operative_carep_experience_{{ $q }}[]" multiple="multiple"></select>
                                                </div>
                                                <?php
                                                $q++;
                                                ?>
                                                @endforeach
                                                <div class="surgical_operative_carep_level_one"></div>
                                                <div class="surgical_operative_carep_level_two"></div>
                                                <div class="surgical_operative_carep_level_three"></div>
                                            </div>
                                            <div class="form-group level-drp">
                                                <label class="form-label" for="input-1">What is your Level of experience in this specialty?
                                                </label>
                                                <select class="form-input mr-10 select-active" name="exper_assistent_level">

                                                    @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                                                        @endfor
                                                </select>
                                            </div>
                                            <div class="form-group level-drp">


                                                <div class="form-group level-drp">
                                                    <label class="form-label" for="input-1">Position Held</label>
                                                    <select class="form-control" name="positions_held[]">
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
                                                    <span id="reqpositionheld" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                            <span id="reqpositionheld" class="reqError text-danger valley"></span>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">Employment Start Date</label>
                                                        <input class="form-control employeement_start_date employeement_start_date-1" type="date" name="start_date[]" onchange="changeEmployeementEndDate(1)" onkeydown="return false">
                                                        <span id="reqempsdate" class="reqError text-danger valley"></span>
                                                    </div>
                                                    <div class="declaration_box">
                                                        <input class="currently_position currently_position-1" type="checkbox" name="present_box[]" value="1" onclick="currently_position(1)">I am currently in this position at the moment

                                                    </div>
                                                </div>
                                                <div class="col-md-6 empl_end_date-1">
                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">Employment End Date</label>
                                                        <input class="form-control employeement_end_date employeement_end_date-1" type="date" name="end_date[]" onkeydown="return false">
                                                        <span id="reqemployeementenddate-1" class="reqError text-danger valley"></span>
                                                    </div>

                                                </div>

                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">Employment type</label>
                                                        <select class="form-control" name="employeement_type[]" onchange="ExpEmpStatus(this.value)">
                                                            <option value="">select</option>
                                                            <option value="Permanent" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Permanent") selected @endif>Permanent</option>
                                                            <option value="Temporary" @if(Auth::guard('nurse_middle')->user()->current_employee_status == "Temporary") selected @endif>Temporary</option>
                                                        </select>
                                                        <span id="reqemptype" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="exp_permanent" @if(Auth::guard('nurse_middle')->user()->permanent_status == NULL) style="display: none;" @endif>
                                                <div class="form-group col-md-12">
                                                    <label class="form-label" for="input-1">Permanent</label>
                                                    <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                                                    <select class="form-input mr-10 select-active" name="permanent_status">
                                                        <option value="">Select</option>
                                                        <option value="Full-time" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Full-time") selected @endif>Full-time</option>
                                                        <option value="Part-time" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Part-time") selected @endif>Part-time</option>
                                                        <option value="Agency Nurse/Midwife" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Agency Nurse/Midwife") selected @endif>Agency Nurse/Midwife</option>
                                                        <option value="Freelance" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Freelance") selected @endif>Freelance</option>
                                                        <option value="Local" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Local") selected @endif>Local</option>
                                                        <option value="Volunteer" @if(Auth::guard('nurse_middle')->user()->permanent_status == "Volunteer") selected @endif>Volunteer</option>

                                                    </select>
                                                </div>
                                                <span id="reqemployee_status" class="reqError text-danger valley"></span>
                                            </div>
                                            <div class="exp_temporary" @if(Auth::guard('nurse_middle')->user()->temporary_status == NULL) style="display: none;" @endif>
                                                <div class="form-group col-md-12">
                                                    <label class="form-label" for="input-1">Temporary</label>
                                                    <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                                                    <select class="form-input mr-10 select-active" name="temporary_status">
                                                        <option value="">Select</option>
                                                        <option value="Temporary" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Temporary") selected @endif>Temporary</option>
                                                        <option value="Contract" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Contract") selected @endif>Contract</option>
                                                        <option value="Term Contract" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Term Contract") selected @endif>Term Contract</option>
                                                        <option value="Travel" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Travel") selected @endif>Travel</option>
                                                        <option value="Per Diem" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Per Diem") selected @endif>Per Diem</option>
                                                        <option value="Local" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Local") selected @endif>Local</option>
                                                        <option value="On-Call" @if(Auth::guard('nurse_middle')->user()->temporary_status == "On-Call") selected @endif>On-Call</option>
                                                        <option value="PRN (Pro Re Nata)" @if(Auth::guard('nurse_middle')->user()->temporary_status == "PRN (Pro Re Nata)") selected @endif>PRN (Pro Re Nata)</option>
                                                        <option value="Casual" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Casual") selected @endif>Casual</option>
                                                        <option value="Locum tenens (temporary substitute)" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Locum tenens (temporary substitute)") selected @endif>Locum tenens (temporary substitute)</option>
                                                        <option value="Agency Nurse/Midwife" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Agency Nurse/Midwife") selected @endif>Agency Nurse/Midwife</option>
                                                        <option value="Seasonal" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Seasonal") selected @endif>Seasonal</option>
                                                        <option value="Freelance" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Freelance") selected @endif>Freelance</option>
                                                        <option value="Internship" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Internship") selected @endif>Internship</option>
                                                        <option value="Apprenticeship" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Apprenticeship") selected @endif>Apprenticeship</option>
                                                        <option value="Residency" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Residency") selected @endif>Residency</option>
                                                        <option value="Volunteer" @if(Auth::guard('nurse_middle')->user()->temporary_status == "Volunteer") selected @endif>Volunteer</option>


                                                    </select>
                                                </div>
                                                <span id="reqemployee_status" class="reqError text-danger valley"></span>
                                            </div>
                                            <h6 class="emergency_text">
                                                Detailed Job Descriptions
                                            </h6>
                                            <div class="form-group level-drp">
                                                <label class="form-label" for="input-1">Responsibilities</label>
                                                <textarea class="form-control" name="job_responeblities[]"></textarea>
                                                <span id="reqresposiblities" class="reqError text-danger valley"></span>
                                            </div>
                                            <div class="form-group level-drp">
                                                <label class="form-label" for="input-1">Achievements</label>
                                                <textarea class="form-control" name="achievements[]"></textarea>
                                                <span id="reqachievements" class="reqError text-danger valley"></span>
                                            </div>

                                            @endif
                                        </div>

                                        <h6 class="emergency_text">
                                            Areas of Expertise
                                        </h6>
                                        <div class="form-group level-drp">
                                            <input type="hidden" name="skills_comp" class="skills_comp" value="@if(!empty($experienceData)) {{ $experienceData->skills_compantancies }}@endif">
                                            <label class="form-label" for="input-1">Specific skills and competencies</label>
                                            <?php
                                            $skills = DB::table("skills")->get();
                                            ?>
                                            <ul id="skills_compantancies" style="display:none;">
                                                @foreach($skills as $cert)
                                                <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                                                @endforeach

                                            </ul>
                                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="skills_compantancies" name="skills_compantancies[]" multiple="multiple"></select>
                                        </div>
                                        <span id="reqexpertise" class="reqError text-danger valley"></span>
                                        <div class="form-group level-drp">
                                            <input type="hidden" name="evidence_type" class="evidence_type" value="@if(!empty($experienceData)) {{ $experienceData->evidence_type }}@endif">
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
                                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="type_of_evidence" name="type_of_evidence[]" multiple="multiple"></select>
                                            <span id="reqtype_evidence" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="form-group level-drp">
                                            <label class="form-label" for="input-1">Upload evidence</label>

                                            <input class="form-control" type="file" name="upload_evidence">
                                            @if(!empty($experienceData) && $experienceData->upload_evidence != NULL)
                                            <img src="{{ url('/public/uploads/evidence') }}/{{ $experienceData->upload_evidence }}" style="width:100px;">
                                            @endif
                                            <!-- <span id="reqachievements" class="reqError text-danger valley"></span> -->
                                        </div>
                                        <div class="add_new_certification_div awe mb-3 mt-4">
                                            <a style="cursor: pointer;" onclick="add_work_experience1()">+ Add another work experience</a>
                                        </div>
                                        <div class="box-button mt-15">
                                            <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitExperience">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                                <script type="text/javascript">
                                    function changeEmployeementEndDate(i) {
                                        //alert(i);
                                        var start_date = $(".employeement_start_date-" + i).val();
                                        console.log("start_date", $(".employeement_start_date-" + i).val());
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
                                        document.getElementsByClassName("employeement_end_date-" + i)[0].setAttribute('min', new_date);
                                    }

                                    var i = 1;
                                    $(".employeement_start_date").each(function() {
                                        console.log("employeement_start_date", $(".employeement_start_date-" + i).val());
                                        var start_date = $(".employeement_start_date-" + i).val();

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
                                        document.getElementsByClassName("employeement_end_date-" + i)[0].setAttribute('min', new_date);
                                        i++;
                                    });

                                    function add_work_experience1() {
                                        alert('yt');
                                    }
                                </script>
                            </div>
                            <div class="tab-pane fade" id="tab-references" role="tabpanel" aria-labelledby="tab-references" style="display: none"><br>
                                <h3 class="mt-0 color-brand-1 mb-20">References</h3>
                                <h6 class="emergency_text">
                                    Please Add your professional References:
                                </h6>

                                <form id="reference_form" method="POST" onsubmit="return updateReference()">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                                    <div class="reference_form">
                                        <?php
                                        $get_reference_data = DB::table("referee")->where("user_id", Auth::guard('nurse_middle')->user()->id)->get();
                                        ?>
                                        @if(count($get_reference_data)>0)
                                        <?php
                                        $i = 1;
                                        ?>
                                        @foreach($get_reference_data as $referee_data)
                                        <div class="referee_data referee_data-{{ $i }}">
                                            <h6 class="mt-0 color-brand-1 mb-20 referee_no">REFEREE {{ $i }}</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">First name</label>
                                                        <input type="hidden" name="reference_no[]" value="{{ $i }}">
                                                        <input class="form-control first_name first_name-{{ $i }}" type="text" name="first_name[]" value="{{ $referee_data->first_name }}">
                                                        <span id="reqfname-{{ $i }}" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">Last name</label>
                                                        <input class="form-control last_name last_name-{{ $i }}" type="text" name="last_name[]" value="{{ $referee_data->last_name }}">
                                                        <span id="reqlname-{{ $i }}" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">Email</label>
                                                        <input class="form-control reference_email reference_email-{{ $i }}" type="text" name="email[]" value="{{ $referee_data->email }}">
                                                        <span id="reqemail-{{ $i }}" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">Phone number</label>
                                                        <input class="form-control phone_no phone_no-{{ $i }}" type="text" name="phone_no[]" value="{{ $referee_data->phone_no }}">
                                                        <span id="reqphoneno-{{ $i }}" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">Referee relationship to you</label>
                                                        <select class="form-input reference_relationship reference_relationship-{{ $i }}" name="reference_relationship[]">
                                                            <option value="" data-select2-id="9">select</option>
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
                                                <div class="col-md-6">
                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">You worked together at:</label>
                                                        <input class="form-control worked_together worked_together-{{ $i }}" type="text" name="worked_together[]" value="{{ $referee_data->worked_together }}">
                                                        <span id="reqworked_together-{{ $i }}" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">What was your position when you worked with this referee?</label>
                                                        <input class="form-control position_with_referee position_with_referee-{{ $i }}" type="text" name="position_with_referee[]" value="{{ $referee_data->position_with_referee }}">
                                                        <span id="reqpositionreferee-{{ $i }}" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">Start Date</label>
                                                        <input class="form-control referee_start_date referee_start_date-{{ $i }}" type="date" name="start_date[]" value="{{ $referee_data->start_date }}" onchange="startDate('{{ $i }}')" onkeydown="return false">
                                                        <span id="reqrefereesdate-{{ $i }}" class="reqError text-danger valley"></span>
                                                    </div>
                                                    <div class="declaration_box ">
                                                        <input class="still_working still_working-{{ $i }}" type="checkbox" name="still_working[]" @if($referee_data->still_working == 1) checked @endif onclick="stillWorking({{ $i }})">I'm still working with this referee
                                                        <span id="reqstillworking-{{ $i }}" class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group level-drp working-{{ $i }}" @if($referee_data->still_working == 1) style="display: none;" @endif>
                                                        <label class="form-label" for="input-1">End Date</label>
                                                        <input class="form-control end_date end_date-{{ $i }}" type="date" name="end_date[]" value="{{ $referee_data->end_date }}" onkeydown="return false">
                                                        <span id="reqrefereeedate-{{ $i }}" class="reqError text-danger valley"></span>
                                                    </div>



                                                </div>
                                            </div>
                                            @if($i != 1)
                                            <?php
                                            $user_id = Auth::guard('nurse_middle')->user()->id;
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
                                        <?php
                                        $i++;
                                        ?>
                                        @endforeach
                                        @else
                                        <h6 class="mt-0 color-brand-1 mb-20 referee_no">REFEREE 1</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group level-drp">
                                                    <label class="form-label" for="input-1">First name</label>
                                                    <input class="form-control first_name first_name-1" type="text" name="first_name[]">
                                                    <span id="reqfname-1" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group level-drp">
                                                    <label class="form-label" for="input-1">Last name</label>
                                                    <input class="form-control last_name last_name-1" type="text" name="last_name[]">
                                                    <span id="reqlname-1" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group level-drp">
                                                    <label class="form-label" for="input-1">Email</label>
                                                    <input class="form-control reference_email reference_email-1" type="text" name="email[]">
                                                    <span id="reqemail-1" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group level-drp">
                                                    <label class="form-label" for="input-1">Phone number</label>
                                                    <input class="form-control phone_no phone_no-1" type="text" name="phone_no[]">
                                                    <span id="reqphoneno-1" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group level-drp">
                                                    <label class="form-label" for="input-1">Referee relationship to you</label>
                                                    <select class="form-control reference_relationship reference_relationship-1" name="reference_relationship[]">
                                                        <option value="" data-select2-id="9">select</option>
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
                                            <div class="col-md-6">
                                                <div class="form-group level-drp">
                                                    <label class="form-label" for="input-1">You worked together at:</label>
                                                    <input class="form-control worked_together worked_together-1" type="text" name="worked_together[]">
                                                    <span id="reqworked_together-1" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group level-drp">
                                                    <label class="form-label" for="input-1">What was your position when you worked with this referee?</label>
                                                    <input class="form-control position_with_referee position_with_referee-1" type="text" name="position_with_referee[]">
                                                    <span id="reqpositionreferee-1" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group level-drp">
                                                    <label class="form-label" for="input-1">Start Date</label>
                                                    <input class="form-control start_date start_date-1" type="date" name="start_date[]" onkeydown="return false">
                                                    <span id="reqempsdate" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="declaration_box">
                                                    <input class="still_working-1" type="checkbox" name="still_working[]" onclick="stillWorking(1)">I'm still working with this referee
                                                    <span id="reqstillworking" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group level-drp working-1">
                                                    <label class="form-label" for="input-1">End Date</label>
                                                    <input class="form-control end_date end_date-1" type="date" name="end_date[]" onkeydown="return false">
                                                    <span id="reqempsdate" class="reqError text-danger valley"></span>
                                                </div>

                                            </div>
                                        </div>
                                        @endif

                                    </div> <br>
                                    <div class="add_new_certification_div mb-3 mt-3">
                                        <a style="cursor: pointer;" onclick="add_another_referee()">+ Add another Referee</a>
                                    </div>
                                    <div class="box-button mt-15">
                                        <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitReferences">Save Changes</button>
                                    </div>

                                </form>
                            </div>
                            <script type="text/javascript">
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



                                function add_another_referee() {
                                    var referee_div_count = $(".referee_no").length;
                                    console.log("licence_div_count", referee_div_count);
                                    referee_div_count++;
                                    $(".reference_form").append('<div class="referee_data referee_data-' + referee_div_count + '"><h6 class="mt-0 color-brand-1 mb-20 referee_no">REFEREE ' + referee_div_count + '</h6><div class="row"><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">First name</label><input class="form-control first_name first_name-' + referee_div_count + '" type="text" name="first_name[]"><span id="reqfname-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">Last name</label><input class="form-control last_name last_name-' + referee_div_count + '" type="text" name="last_name[]"><span id="reqlname-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div></div><div class="row"><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">Email</label><input class="form-control reference_email reference_email-' + referee_div_count + '" type="text" name="email[]"><span id="reqemail-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">Phone number</label><input class="form-control phone_no phone_no-' + referee_div_count + '" type="text" name="phone_no[]"><span id="reqphoneno-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div></div><div class="row"><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">Referee relationship to you</label><select class="form-input reference_relationship reference_relationship-' + referee_div_count + '" name="reference_relationship[]"><option value="" data-select2-id="9">select</option><option value="Worked in Same Group">Worked in Same Group</option><option value="Referee Managed Me">Referee Managed Me</option><option value="I Managed Referee">I Managed Referee</option><option value="Worked Together on a Project">Worked Together on a Project</option><option value="Worked Together in Different Departments">Worked Together in Different Departments</option><option value="Colleague">Colleague</option><option value="Peer Mentor">Peer Mentor</option><option value="Clinical Supervisor">Clinical Supervisor</option><option value="Educational Supervisor">Educational Supervisor</option><option value="Preceptor">Preceptor</option><option value="Instructor or Teacher">Instructor or Teacher</option><option value="Collaborated on Research">Collaborated on Research</option><option value="Clinical Educator">Clinical Educator</option><option value="Patient Advocate">Patient Advocate</option><option value="Coordinated Care Together">Coordinated Care Together</option><option value="Advisory Role">Advisory Role</option><option value="Worked Together on Committees">Worked Together on Committees</option><option value="Consultant Relationship">Consultant Relationship</option><option value="Professional Mentor">Professional Mentor</option><option value="Team Leader">Team Leader</option><option value="Subordinate in a Leadership Role">Subordinate in a Leadership Role</option><option value="Provided Professional Development Support">Provided Professional Development Support</option><option value="Oversaw my Certification Process">Oversaw my Certification Process</option><option value="External Collaborator">External Collaborator</option><option value="Other">Other</option></select><span id="reqreferencerel-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">You worked together at:</label><input class="form-control worked_together worked_together-' + referee_div_count + '" type="text" name="worked_together[]"><span id="reqworked_together-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div></div><div class="row"><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">What was your position when you worked with this referee?</label><input class="form-control position_with_referee position_with_referee-' + referee_div_count + '" type="text" name="position_with_referee[]"><span id="reqpositionreferee-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div></div><div class="row"><div class="col-md-6"><div class="form-group level-drp"><label class="form-label" for="input-1">Start Date</label><input class="form-control start_date start_date-' + referee_div_count + '" type="date" name="start_date[]" onchange="startDate(' + referee_div_count + ')" onkeydown="return false"><span id="reqrefereesdate-' + referee_div_count + '" class="reqError text-danger valley"></span><div class="declaration_box"><input class="still_working still_working-' + referee_div_count + '" type="checkbox" name="still_working[]" onclick="stillWorking(' + referee_div_count + ')">I am still working with this referee<span id="reqstillworking-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div></div><div class="col-md-6"><div class="form-group level-drp working-' + referee_div_count + '"><label class="form-label" for="input-1">End Date</label><input class="form-control end_date end_date-' + referee_div_count + '" type="date" name="end_date[]" onkeydown="return false"><span id="reqrefereeedate-' + referee_div_count + '" class="reqError text-danger valley"></span></div></div><div class="row"><div class="col-md-6"><div class="add_new_certification_div mb-3 mt-3"><a style="cursor: pointer;" onclick="delete_reference1(' + referee_div_count + ')">- Delete Referee</a></div></div></div></div>');

                                }
                            </script>
                            <div class="tab-pane fade" id="tab-mandtraining" role="tabpanel" aria-labelledby="tab-educert" style="display: none">
                                <div class="card shadow-sm border-0 p-4 mt-30">
                                    <h3 class="mt-0 color-brand-1 mb-20">Mandatory Training and Continuing Education</h3>
                                    <p>Mandatory Training and Continuing Education are vital for many nursing and midwifery roles. Keeping them up to date is crucial to maintaining your eligibility for employment opportunities</p>


                                    <?php
                                    $trainingData = DB::table("mandatory_training")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
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
                                    <form id="training_form" method="POST" onsubmit="return updateTraining()">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                                        <!-- <p>Please add required courses or certifications completed for compliance or safety</p> -->
                                        <h6 class="emergency_text">
                                            Completed Mandatory Training
                                        </h6>
                                        <!-- <div class="row"> -->
                                        <!-- <div class="col-md-6">
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Training Start Date</label>
                          <input class="form-control training_start_date" type="date" name="start_date" value="@if(!empty($trainingData)){{ $trainingData->start_date }}@endif" onchange="trainingStartDate(event);">
                          <span id="reqempsdate" class="reqError text-danger valley"></span>
                        </div>
                      </div> -->
                                        <!-- <div class="col-md-6">
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Training End Date</label>
                          <input class="form-control training_end_date" type="date" name="end_date" value="@if(!empty($trainingData)){{ $trainingData->end_date }}@endif" onchange="trainingEndDate(event);">
                          <span id="reqtrainingenddate" class="reqError text-danger valley"></span>
                        </div>
                        
                      </div> -->
                                        <!-- <script type="text/javascript">
                        function trainingEndDate(e){
                          var end_date = e.target.value;
                          var start_date = $('.training_start_date').val();

                          if(end_date < start_date){
                            $("#reqtrainingenddate").html("End date should not less than start date");
                          }else{
                            if(end_date == start_date){
                              $("#reqtrainingenddate").html("End date should not equal to start date");
                            }else{
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
                        if(month_len<2){
                          var show_month = 0+month_val;
                        }else{
                          var show_month = month_val;
                        }
                        const formattedDate2 = year_val+"-"+show_month+"-"+date_val;
                        console.log("month_val",formattedDate);
                        
                        document.getElementsClassByName("training_end_date")[0].setAttribute('min', formattedDate2);
                        function trainingStartDate(e){
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
                          if(month_len<2){
                            var show_month = 0+month_val;
                          }else{
                            var show_month = month_val
                          }
                          const formattedDate = year_val+"-"+show_month+"-"+date_val;
                          console.log("month_val",formattedDate);
                          
                          document.getElementsByClassName("training_end_date")[0].setAttribute('min', formattedDate);
                        }

                      </script> -->
                                        <!-- <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Institution</label>
                          <input class="form-control" type="text" name="institution" value="@if(!empty($trainingData)){{ $trainingData->institutions }}@endif">
                          
                        </div> -->

                                        <!-- <div class="form-group level-drp">
                           <label class="form-label" for="input-1">Mandatory Continuing Education</label>
                           <select class="form-control form-select ps-5" name="mand_continue_education" id="mand_continue_education">
                            <option value="">Select mandatory continuing education</option>
                            
                            
                            <option value="Ongoing" @if(!empty($trainingData)) @if(!empty($trainingData->continuing_education == "Ongoing")) selected @endif @endif>Ongoing</option>
                            <option value="Completed" @if(!empty($trainingData)) @if(!empty($trainingData->continuing_education == "Completed")) selected @endif @endif>Completed</option>


                          </select>          
                        </div> -->
                                        <!-- </div> -->
                                        <p>Please add required courses or certifications completed for compliance or safety</p>

                                        <h6 class="emergency_text">
                                            <!-- Mandatory Training -->
                                        </h6>
                                        <div class="form-group level-drp">
                                            <input type="hidden" name="man_training" class="man_training" value="@if(!empty($trainingData)) {{ $trainingData->man_training }}@endif">

                                            <label class="form-label" for="input-1">Please select all that apply</label>
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

                                        <div class="mandatory_sub_courses">
                                            <!-- cat-1 -->
                                            <?php
                                            $mandatory_sub_courses = DB::table('man_training_category')
                                                ->where('parent', 419)
                                                ->where('type', 'Training')
                                                ->get();

                                            ?>
                                            <div class="form-group level-drp mandatory_courses_div  mandatory_tr_div_1 @if($trainingData && $trainingData->well_sel_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif">
                                                <input type="hidden" name="well_sel_data" class="well_sel_data" value="@if(!empty($trainingData)){{ $well_data_json }}@endif">
                                                <label class="form-label" for="input-1">Wellness And Self-Care </label>

                                                <ul id="well_self_care_data" style="display:none;">
                                                    @foreach($mandatory_sub_courses as $ms_courses)
                                                    <li data-value="{{ $ms_courses->name }}">{{ $ms_courses->name }}</li>
                                                    @endforeach
                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="well_self_care_data" name="well_self_care_data[]" multiple="multiple"></select>
                                            </div>
                                            <span id="reqwellself" class="reqError text-danger valley"></span>

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
                                                            <input class="form-control well_tra_start_date well_tra_start_date-{{ $i }}" type="date" name="well_tra_start_date[]" value="{{ $well_data->well_tra_start_date }}">
                                                            <span id="well_tra_start_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Training End Date</label>
                                                            <input class="form-control well_tra_end_date well_tra_end_date-{{ $i }}" type="date" name="well_tra_end_date[]" value="{{ $well_data->well_tra_end_date }}">
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
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
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
                                            <div class="form-group level-drp mandatory_courses_div mandatory_courses_div_{{ $m_courses->id }} mandatory_tr_div_2 @if($trainingData && $trainingData->tech_innvo_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif">
                                                <input type="hidden" name="tech_innvo_data" class="tech_innvo_data" value="@if(!empty($trainingData)){{ $tech_data_json }}@endif">
                                                <label class="form-label" for="input-1">Technology and Innovation in Healthcare </label>
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
                                                            <input class="form-control tech_innvo_tra_start_date tech_innvo_tra_start_date-{{ $i }}" type="date" name="tech_innvo_tra_start_date[]" value="{{ $tech_data->tech_start_date }}">
                                                            <span id="tech_innvo_tra_start_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Training End Date</label>
                                                            <input class="form-control tech_innvo_tra_end_date tech_innvo_tra_end_date-{{ $i }}" type="date" name="tech_innvo_tra_end_date[]" value="{{ $tech_data->tech_end_date }}">
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
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
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
                                            <div class="form-group level-drp mandatory_courses_div mandatory_courses_div_{{ $m_courses->id }} mandatory_tr_div_3 @if($trainingData && $trainingData->leader_pro_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif">
                                                <input type="hidden" name="lead_data" class="lead_data" value="@if(!empty($trainingData)){{ $lead_data_json }}@endif">
                                                <label class="form-label" for="input-1">Leadership and Professional Development</label>
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
                                                            <input class="form-control leader_pro_tra_start_date leader_pro_tra_start_date-{{ $i }}" type="date" name="leader_pro_tra_start_date[]" value="{{ $lead_data->lead_start_date }}">
                                                            <span id="leader_pro_tra_start_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Training End Date</label>
                                                            <input class="form-control leader_pro_tra_end_date leader_pro_tra_end_date-{{ $i }}" type="date" name="leader_pro_tra_end_date[]" value="{{ $lead_data->lead_end_date }}">
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
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
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
                                            <div class="form-group level-drp mandatory_courses_div mandatory_courses_div_{{ $m_courses->id }} mandatory_tr_div_4 @if($trainingData && $trainingData->mid_spec_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif">
                                                <input type="hidden" name="mid_data" class="mid_data" value="@if(!empty($trainingData)){{ $mid_data_json }}@endif">
                                                <label class="form-label" for="input-1">Midwifery-Specific Training </label>
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
                                                            <input class="form-control mid_spec_tra_start_date mid_spec_tra_start_date-{{ $i }}" type="date" name="mid_spec_tra_start_date[]" value="{{ $mid_data->mid_spec_start_date }}">
                                                            <span id="mid_spec_tra_start_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Training End Date</label>
                                                            <input class="form-control mid_spec_tra_end_date mid_spec_tra_end_date-{{ $i }}" type="date" name="mid_spec_tra_end_date[]" value="{{ $mid_data->mid_spec_end_date }}">
                                                            <span id="mid_spec_tra_end_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Expiry</label>
                                                            <input class="form-control mid_spec_expiry mid_spec_expiry-{{ $i }}" type="date" name="mid_spec_expiry[]" value="{{ $mid_data->mis_spec_expiry }}">
                                                            <span id="midspecexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Upload Certificate</label>
                                                            <input class="form-control mid_spec_upload_certification mid_spec_imgs_{{ $mid_first_word }} mid_spec_upload_certification-{{ $i }}" type="file" name="mid_spec_upload_certification[{{ $i }}][]" onchange="changetraImg1({{ $user_id }},{{ $i }},'mid_spec_imgs','{{ $mid_first_word }}')">
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
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
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

                                            <!-- cat-5-->
                                            <div class="form-group level-drp mandatory_courses_div mandatory_courses_div_{{ $m_courses->id }} mandatory_tr_div_5 @if($trainingData && $trainingData->clinic_skill_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif">
                                                <input type="hidden" name="cli_data" class="cli_data" value="@if(!empty($trainingData)){{ $cli_data_json }}@endif">
                                                <label class="form-label" for="input-1">Clinical Skills and Core Competencies </label>
                                                <?php $mandatory_sub_courses = DB::table('man_training_category')
                                                    ->where('parent', 415)
                                                    ->where('type', 'Training')
                                                    ->get(); ?>

                                                <ul id="clinic_skill_core_data" style="display:none;">
                                                    @foreach($mandatory_sub_courses as $ms_courses)
                                                    <li data-value="{{ $ms_courses->name }}" data-id="{{ $ms_courses->id }}">{{ $ms_courses->name }}</li>
                                                    @endforeach

                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="clinic_skill_core_data" name="clinic_skill_core_data[]" multiple="multiple"></select>
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
                                                            <input class="form-control clinic_skill_tra_start_date clinic_skill_tra_start_date-0-{{ $i }}" type="date" name="clinic_skill_tra_start_date[]" value="{{ $cli_data->cli_skill_start_date }}">
                                                            <span id="clinic_skill_tra_start_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Training End Date</label>
                                                            <input class="form-control clinic_skill_tra_end_date clinic_skill_tra_end_date-{{ $i }}" type="date" name="clinic_skill_tra_end_date[]" value="{{ $cli_data->cli_skill_end_date }}">
                                                            <span id="clinic_skill_tra_end_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Expiry</label>
                                                            <input class="form-control clinic_skill_expiry clinic_skill_expiry-{{ $i }}" type="date" name="clinic_skill_expiry[]" value="{{ $cli_data->cli_skill_expiry }}">
                                                            <span id="clinicskillexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Upload Certificate</label>
                                                            <input class="form-control clinic_skill_upload_certification clinic_skill_imgs_{{ $cli_first_word }} clinic_skill_upload_certification-{{ $i }}" type="file" name="clinic_skill_upload_certification[{{ $i }}][]" onchange="changetraImg1({{ $user_id }},{{ $i }},'clinic_skill_imgs','{{ $cli_first_word }}')">
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
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
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
                                                    <input class="form-control tra_start_date tra_start_date-1" type="date" name="tra_start_date[]" value="@if(!empty($trainingData)){{ $a_data->training_end_date }}@endif">
                                                    <span id="reqtrastartdate-{{ $i }}" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="input-1">Training End Date</label>
                                                    <input class="form-control tra_end_date tra_end_date-{{ $i }}" type="date" name="tra_end_date[]" value="@if(!empty($trainingData)){{ $a_data->training_start_date }}@endif">
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

                                        <h6 class="mt-2">Mandatory Continuing Education</h6>
                                        <p>Continuing Professional Development (CPD) for Australian nurses and midwives involves annual training that covers ethics, infection control, and clinical skills updates</p>

                                        <div class="form-group level-drp">
                                            <input type="hidden" name="man_education" class="man_education" value="@if(!empty($trainingData)) {{ $trainingData->man_education }}@endif">
                                            <p>Please add required ongoing education to stay updated in your field and maintain licensure</p>
                                            <label class="form-label" for="input-1">Please select all that apply</label>
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

                                        <div class="mandatory_sub_education">
                                            <!-- cat-1 -->
                                            <?php
                                            $mandatory_sub_education = DB::table('man_training_category')
                                                ->where('parent', 440)
                                                ->where('type', 'Education')
                                                ->get();

                                            ?>
                                            <div class="form-group level-drp mandatory_sub_edu_div  mandatory_sub_edu_div_1 d-none">
                                                <input type="hidden" name="cli_data" class="cli_data" value="@if(!empty($trainingData)){{ $emr_data_json }}@endif">
                                                <label class="form-label" for="input-1">Core Mandatory Continuing Education </label>

                                                <ul id="core_man_con_data" style="display:none;">
                                                    @foreach($mandatory_sub_education as $ms_education)
                                                    <li data-value="{{ $ms_education->name }}" data-id="{{ $ms_education->id }}">{{ $ms_education->name }}</li>
                                                    @endforeach
                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="core_man_con_data" name="core_man_con_data[]" multiple="multiple"></select>
                                            </div>
                                            <span id="reqcoreman" class="reqError text-danger valley"></span>

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
                                                            <input class="form-control coreman_upload_certification core_man_imgs_{{ $core_man_first_word }} coreman_upload_certification-{{ $i }}" type="file" name="coreman_upload_certification[{{ $i }}][]" onchange="changetraImg1({{ $user_id }},{{ $i }},'core_man_imgs','{{ $core_man_first_word }}')">
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
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
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
                                            <div class="form-group level-drp mandatory_sub_edu_div  mandatory_sub_edu_div_2 @if($trainingData && $trainingData->mid_spe_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif">
                                                <input type="hidden" name="mid_spe_data" class="mid_spe_data" value="@if(!empty($trainingData)){{ $mid_spe_json }}@endif">
                                                <label class="form-label" for="input-1">Midwifery-Specific Mandatory Continuing Education </label>
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
                                            <span id="reqmidspe" class="reqError text-danger valley"></span>

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
                                                            <input class="form-control midspe_upload_certification mid_spe_imgs_{{ $mid_spe_first_word }} midspe_upload_certification-{{ $i }}" type="file" name="midspe_upload_certification[{{ $i }}][]" onchange="changetraImg1({{ $user_id }},{{ $i }},'mid_spe_imgs','{{ $mid_spe_first_word }}')">
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
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
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
                                            <div class="form-group level-drp mandatory_sub_edu_div  mandatory_sub_edu_div_3 @if($trainingData && $trainingData->spec_area_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif">
                                                <input type="hidden" name="spec_area_data" class="spec_area_data" value="@if(!empty($trainingData)){{ $spec_area_json }}@endif">
                                                <label class="form-label" for="input-1">Specialized Areas</label>
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
                                            <span id="reqspecarea" class="reqError text-danger valley"></span>

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
                                                            <input class="form-control specarea_upload_certification spec_area_imgs_{{ $spec_area_first_word }} specarea_upload_certification-{{ $i }}" type="file" name="specarea_upload_certification[{{ $i }}][]" onchange="changetraImg1({{ $user_id }},{{ $i }},'spec_area_imgs','{{ $spec_area_first_word }}')">
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
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
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

                                            <!-- cat-4 -->
                                            <div class="form-group level-drp mandatory_sub_edu_div  mandatory_sub_edu_div_4 @if($trainingData && $trainingData->safety_com_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif">
                                                <input type="hidden" name="safety_data" class="safety_data" value="@if(!empty($trainingData)){{ $safety_data_json }}@endif">
                                                <label class="form-label" for="input-1">Safety and Compliance Training</label>
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
                                            <span id="reqsafety" class="reqError text-danger valley"></span>

                                            <div class="safety_com_div">
                                                <?php
                                                $i = 0;
                                                ?>
                                                @if(!empty($safety_data1))
                                                @foreach($safety_data1 as $safe_data)
                                                <?php
                                                $first_word = strtok($safe_data->saf_edu_id, " ");

                                                $first_word  = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $first_word));



                                                $safe_first_word = $first_word;
                                                ?>
                                                <div class="safety_com_{{ $safe_first_word }} safety_com_{{ $safe_first_word }}">
                                                    <h6>{{ $safe_data->saf_edu_id }}</h6>
                                                    <div class="safety_com_institution  row safety_com_institution">
                                                        <div class="form-group col-md-12">
                                                            <label class="form-label" for="input-1">Institution/Regulating Body</label>
                                                            <input type="hidden" name="safetycomaarr[]" class="safety_com_input_{{ $safe_data->saf_edu_id }}" value="{{ $safe_data->saf_edu_id }}">
                                                            <input class="form-control safety_com_institution safety_com_institution-{{ $i }}" type="text" name="safety_com_institution[]" value="{{ $safe_data->safety_com_institution }}">
                                                            <span id="safetycominstitutionvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Start Date</label>
                                                            <input class="form-control safety_com_start_date safety_com_start_date-{{ $i }}" type="date" name="safety_com_start_date[]" value="{{ $safe_data->safety_com_start_date }}">
                                                            <span id="safety_com_start_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">End Date</label>
                                                            <input class="form-control safety_com_end_date safety_com_end_date-{{ $i }}" type="date" name="safety_com_end_date[]" value="{{ $safe_data->safety_com_end_date }}">
                                                            <span id="safety_com_end_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Status</label>
                                                            <select class="form-control safety_com_status safety_com_status-{{ $i }}" name="safety_com_status[]">
                                                                <option value="Completed" @if($safe_data->safety_com_status == 'Completed') selected @endif>Completed</option>
                                                                <option value="Ongoing" @if($safe_data->safety_com_status == 'Ongoing') selected @endif>Ongoing</option>
                                                                <option value="Pending" @if($safe_data->safety_com_status == 'Pending') selected @endif>Pending</option>
                                                            </select>
                                                            <span id="safety_com_statusvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Expiry</label>
                                                            <input class="form-control safety_com_expiry safety_com_expiry-{{ $i }}" type="date" name="safety_com_expiry[]" value="{{ $safe_data->safety_com_expiry }}">
                                                            <span id="safetycomexpiryvalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label class="form-label" for="input-1">Upload Certificate</label>
                                                            <input class="form-controlsafetycome_upload_certification safety_com_imgs_{{ $safe_first_word }} safetycome_upload_certification-{{ $i }}" type="file" name="safetycome_upload_certification[{{ $i }}][]" onchange="changetraImg1({{ $user_id }},{{ $i }},'safety_com_imgs','{{ $safe_first_word }}')">
                                                            <span id="reqmidspecuploadvalid-{{ $i }}" class="reqError text-danger valley"></span>

                                                            <?php
                                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                                                            if (!empty($getedufieldsdata)) {
                                                                $spec_img = (array)json_decode($getedufieldsdata->safety_com_imgs);
                                                            } else {
                                                                $spec_img = '';
                                                            }



                                                            if (!empty($spec_img)) {
                                                                $spec_img_data = json_decode($spec_img[$safe_first_word]);
                                                            } else {
                                                                $spec_img_data = "";
                                                            }
                                                            //print_r($acls_img[$acls_first_word_one]);


                                                            // //print_r($dtran_img);
                                                            $l = 1;
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
                                                            ?>
                                                            <div class="safety_com_imgs{{ $safe_first_word }}">
                                                                @if(!empty($spec_img_data))
                                                                @foreach($spec_img_data as $spec_img)
                                                                <div class="trans_img trans_img-{{ $i }} trans_imgsafety_com_imgs{{ $safe_first_word }}{{ $i }}">
                                                                    <a href="{{ url('/public/uploads/education_degree') }}/{{ $spec_img }}"><i class="fa fa-file"></i>{{ $spec_img }}</a>
                                                                    <div class="close_btn close_btn-{{ $i }}" onclick="deleteImg1('{{ $i }}','{{ $user_id }}','{{ $spec_img }}','{{ $safe_first_word }}','safety_com_imgs')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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

                                            <div class="form-group level-drp mandatory_sub_edu_div  mandatory_sub_edu_div_5 @if($trainingData && $trainingData->emerg_topic_data == NULL) d-none @endif @if(empty($trainingData)) d-none @endif ">
                                                <input type="hidden" name="emr_data" class="emr_data" value="@if(!empty($trainingData)){{ $emr_data_json }}@endif">

                                                <label class="form-label" for="input-1">Emerging Topics and Continuing Education</label>
                                                <?php $mandatory_sub_education = DB::table('man_training_category')
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
                                                            <input class="form-control eme_topic_start_date eme_topic_start_date-{{ $i }}" type="date" name="eme_topic_start_date[]" value="{{ $emr_data->eme_topic_start_date }}">
                                                            <span id="eme_topic_start_datevalid-{{ $i }}" class="reqError text-danger valley"></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="input-1">Training End Date</label>
                                                            <input class="form-control eme_topic_end_date eme_topic_end_date-{{ $i }}" type="date" name="eme_topic_end_date[]" value="{{ $emr_data->eme_topic_end_date }}">
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
                                                            <input class="form-control emetopic_upload_certification eme_topic_imgs_{{ $emr_first_word }} emetopic_upload_certification-{{ $i }}" type="file" name="emetopic_upload_certification[{{ $i }}][]" onchange="changetraImg1({{ $user_id }},{{ $i }},'eme_topic_imgs','{{ $emr_first_word }}')">
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
                                                            $user_id = Auth::guard('nurse_middle')->user()->id;
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
                                                    <input class="form-control start_date start_date-1" type="date" name="start_date[]" value="@if(!empty($trainingData)){{ $edu_data->education_start_date }}@endif">
                                                    <span id="reqstartdate--{{ $i }}" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="input-1">End Date</label>
                                                    <input class="form-control end_date end_date-{{ $i }}" type="date" name="end_date[]" value="@if(!empty($trainingData)){{ $edu_data->education_end_date }}@endif">
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
                                                    <input class="form-control edu_expiry edu_expiry-{{ $i }}" type="date" name="edu_expiry[]" value="@if(!empty($trainingData)){{$edu_data->education_exp}}@endif">
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

                                        <div class="box-button mt-15">
                                            <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitTraining">Save Changes</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-interview-references" role="tabpanel" aria-labelledby="tab-interview-references" style="display: none">
                                <h3 class="mt-30 color-brand-1 mb-50">Interview</h3>
                                <?php
                                $interviewReferenceData = DB::table("interview_references")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
                                ?>
                                <form id="interview_form" method="POST" onsubmit="return updateInterview()">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                                    <div class="form-group level-drp">
                                        <label class="form-label" for="input-1">Interview Availability </label>
                                        <input type="datetime-local" name="interview_availablity" class="form-control" value="@if(!empty($interviewReferenceData)){{ $interviewReferenceData->interview_availablity }}@endif">
                                        <span id="reqinterviewdate" class="reqError text-danger valley"></span>
                                    </div>
                                    <h6 class="emergency_text">
                                        Professional References
                                    </h6>
                                    <div class="form-group level-drp">
                                        <label class="form-label" for="input-1">Names</label>
                                        <input type="text" name="reference_name" class="form-control" value="@if(!empty($interviewReferenceData)){{ $interviewReferenceData->reference_name }}@endif">
                                        <span id="reqprofessionalnames" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group level-drp">
                                                <label class="form-label" for="input-1">Email</label>
                                                <input type="text" name="reference_email" class="form-control" value="@if(!empty($interviewReferenceData)){{ $interviewReferenceData->reference_email }}@endif">
                                                <span id="reqprofessionalemail" class="reqError text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="input-3">Mobile Number *</label>

                                            <div class="row">
                                                <div class="col-md-12 mob-adj">
                                                    <input type="hidden" name="reference_countryCode" id="reference_countryCode">
                                                    <input type="hidden" name="reference_countryiso" id="reference_countryiso" value="">
                                                    <input class="form-control numbers" type="tel" name="reference_contact" id="reference_contactI" value="@if(!empty($interviewReferenceData)){{ $interviewReferenceData->reference_contact }}@endif" maxlength="10">
                                                    <span id="reqTxtreferencecontactI" class="reqError text-danger valley"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group level-drp">
                                        <label class="form-label" for="input-1">Relationship</label>
                                        <select class="form-control form-select" name="reference_relationship" id="reference_relationship">
                                            <option value="">Select Relationship</option>
                                            <option value="Mother" @if(!empty($interviewReferenceData)) @if(!empty($interviewReferenceData->reference_relationship == "Mother")) selected @endif @endif>Mother</option>
                                            <option value="Father" @if(!empty($interviewReferenceData)) @if(!empty($interviewReferenceData->reference_relationship == "Father")) selected @endif @endif>Father</option>
                                            <option value="Brother" @if(!empty($interviewReferenceData)) @if(!empty($interviewReferenceData->reference_relationship == "Brother")) selected @endif @endif>Brother</option>
                                            <option value="Sister" @if(!empty($interviewReferenceData)) @if(!empty($interviewReferenceData->reference_relationship == "Sister")) selected @endif @endif>Sister</option>
                                            <option value="Cousin" @if(!empty($interviewReferenceData)) @if(!empty($interviewReferenceData->reference_relationship == "Cousin")) selected @endif @endif>Cousin</option>
                                            <option value="Uncle" @if(!empty($interviewReferenceData)) @if(!empty($interviewReferenceData->reference_relationship == "Uncle")) selected @endif @endif>Uncle</option>
                                            <option value="Aunt" @if(!empty($interviewReferenceData)) @if(!empty($interviewReferenceData->reference_relationship == "Aunt")) selected @endif @endif>Aunt</option>
                                        </select>
                                        <span id="reqprofessionalrelationship" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="box-button mt-15">
                                        <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitInterview">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="tab-personal-preferences" role="tabpanel" aria-labelledby="tab-interview-references" style="display: none">
                                <?php
                                $preferenceData = DB::table("personal_preferences")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
                                ?>
                                <h3 class="mt-30 color-brand-1 mb-50">Personal Preferences</h3>
                                <form id="preferences_form" method="POST" onsubmit="return updatePreferences()">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                                    <div class="form-group level-drp">
                                        <label class="form-label" for="input-1">Preferred Work Schedule</label>
                                        <select class="form-control form-select ps-5" name="preferred_work_schedule" id="preferred_work_schedule">
                                            <option value="">Select preferred work schedule</option>
                                            <option value="Full-time" @if(!empty($preferenceData)) @if(!empty($preferenceData->preferred_work_schedule == "Full-time")) selected @endif @endif>Full-time</option>
                                            <option value="Part-time" @if(!empty($preferenceData)) @if(!empty($preferenceData->preferred_work_schedule == "Part-time")) selected @endif @endif>Part-time</option>
                                            <option value="Shift preferences" @if(!empty($preferenceData)) @if(!empty($preferenceData->preferred_work_schedule == "Shift preferences")) selected @endif @endif>Shift preferences</option>

                                        </select>
                                        <span id="reqpreferecschedule" class="reqError text-danger valley"></span>
                                    </div>
                                    <h6 class="emergency_text">
                                        Preferred Work Locations
                                    </h6>
                                    <div class="row state-row">
                                        <div class="form-group position-relative col-md-6">
                                            <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                                            <label class="font-sm color-text-mutted mb-10">Country</label>
                                            <select class="form-control form-select ps-5" name="country" id="countryworkprefer">
                                                <option value="">Select Country</option>
                                                @php $country_data=country_name_from_db();@endphp

                                                @foreach ($country_data as $data)
                                                <option value="{{$data->iso2}}" @if(!empty($preferenceData))@if($preferenceData->country == $data->iso2) selected @endif @endif> {{$data->name}} </option>
                                                @endforeach


                                            </select>
                                            <span id="reqprecountry" class="reqError text-danger valley"></span>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group position-relative">
                                                <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                                                <label>State *</label>
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
                                                    <option value="{{$data_state->id}}" <?= isset(Auth::guard('nurse_middle')->user()->state) &&  Auth::guard('nurse_middle')->user()->state  == $data_state->id ? 'selected' : '' ?>> {{$data_state->name}} </option>
                                                    @endforeach
                                                    @endif

                                                </select>
                                                <!--<i class="fa-solid fa-location-dot position-absolute  start-0 translate-middle-y ms-3 fs-5 text-primary" style="    top: 25px!important;"></i>-->
                                            </div>
                                            <span id="reqprestateI" class="reqError text-danger valley"></span>
                                        </div>
                                    </div>
                                    <div class="form-group position-relative">
                                        <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                                        <label>Specific Facilities</label>
                                        <textarea name="specific_facilities" class="form-control">@if(!empty($preferenceData)){{ $preferenceData->specific_facilities }}@endif</textarea>
                                        <span id="reqspecificfacilities" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="form-group position-relative">
                                        <label>Work Environment Preferences </label>
                                        <select class="form-control form-select ps-5" name="work_environment" id="work_environment">
                                            <option value="">Select Work Environment Preferences</option>
                                            <option value="Hospital" @if(!empty($preferenceData)) @if(!empty($preferenceData->work_environment == "Hospital")) selected @endif @endif>Hospital</option>
                                            <option value="Clinic" @if(!empty($preferenceData)) @if(!empty($preferenceData->work_environment == "Clinic")) selected @endif @endif>Clinic</option>
                                            <option value="Home Health" @if(!empty($preferenceData)) @if(!empty($preferenceData->work_environment == "Home Healt")) selected @endif @endif>Home Health</option>
                                        </select>
                                        <span id="reqworkenvironement" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="form-group position-relative">
                                        <label>Shift Preferences</label>
                                        <select class="form-control form-select ps-5" name="shift_preferences" id="shift_preferences">
                                            <option value="">Select Shift Preferences</option>
                                            <option value="Day" @if(!empty($preferenceData)) @if(!empty($preferenceData->shift_preferences == "Day")) selected @endif @endif>Day</option>
                                            <option value="Clinic" @if(!empty($preferenceData)) @if(!empty($preferenceData->shift_preferences == "Evening")) selected @endif @endif>Evening</option>
                                            <option value="Night" @if(!empty($preferenceData)) @if(!empty($preferenceData->shift_preferences == "Night")) selected @endif @endif>Night</option>
                                        </select>
                                        <span id="reqshiftpreferences" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="box-button mt-15">
                                        <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitPersonalPreferences">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="tab-work-preferences" role="tabpanel" aria-labelledby="tab-interview-references" style="display: none">
                                <h3 class="mt-30 color-brand-1 mb-50">Job Search Preferences</h3>
                                <?php
                                $workpreferenceData = DB::table("work_preferences")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
                                ?>
                                <form id="workpreference_form" method="POST" onsubmit="return updateWorkPreference()">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                                    <div class="form-group level-drp">
                                        <label class="form-label" for="input-1">Desired Job Roles </label>
                                        <input type="hidden" name="desired_job_roles" class="desired_job_roles" value="@if(!empty($workpreferenceData)){{ $workpreferenceData->desired_job_role }}@endif">
                                        <?php
                                        $practitioner_type = DB::table("practitioner_type")->get();
                                        ?>
                                        <ul id="des_job_role" style="display:none;">
                                            @foreach($practitioner_type as $cert)
                                            <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                                            @endforeach

                                        </ul>
                                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="des_job_role" name="des_job_role[]" multiple="multiple"></select>

                                    </div>
                                    <span id="reqjobroles" class="reqError text-danger valley"></span>
                                    <div class="form-group level-drp">
                                        <label class="form-label" for="input-1">Salary Expectations</label>
                                        <input type="text" name="salary_expectation" class="form-control" value="@if(!empty($workpreferenceData)){{ $workpreferenceData->salary_expectations }}@endif">
                                        <span id="reqsalaryexp" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="form-group level-drp">
                                        <label class="form-label" for="input-1">Benefits Preferences </label>
                                        <input type="hidden" name="benefit_preferences" class="benefit_preferences" value="@if(!empty($workpreferenceData)){{ $workpreferenceData->benefits_preferences }}@endif">

                                        <ul id="benefit_prefer" style="display:none;">
                                            <li data-value="Health insurance">Health insurance</li>
                                            <li data-value="Retirement plans">Retirement plans</li>
                                        </ul>
                                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="benefit_prefer" name="benefit_prefer[]" multiple="multiple"></select>

                                    </div>
                                    <span id="reqbenefitsprefer" class="reqError text-danger valley"></span>
                                    <div class="box-button mt-15">
                                        <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitWorkPreferences">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="tab-addition-information" role="tabpanel" aria-labelledby="tab-interview-references" style="display: none">
                                <?php
                                $InfoData = DB::table("additional_information")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
                                ?>
                                <h3 class="mt-30 color-brand-1 mb-50">Additional Information</h3>
                                <form id="additional_info_form" method="POST" onsubmit="return additional_info_form()">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                                    <div class="form-group level-drp">
                                        <label class="form-label" for="input-1">Languages Spoken</label>
                                        <select class="form-control" name="additional_info_language" id="language-picker-select">
                                            <option lang="de" value="deutsch" @if(!empty($InfoData) && $InfoData->additional_info_language == "deutsch") selected @endif>Deutsch</option>
                                            <option lang="en" value="english" @if(!empty($InfoData) && $InfoData->additional_info_language == "english") selected @endif>English</option>
                                            <option lang="fr" value="francais" @if(!empty($InfoData) && $InfoData->additional_info_language == "francais") selected @endif>Français</option>
                                            <option lang="it" value="italiano" @if(!empty($InfoData) && $InfoData->additional_info_language == "italiano") selected @endif>Italiano</option>
                                        </select>
                                        <span id="reqinfolanguage" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="form-group level-drp">
                                        <label class="form-label" for="input-1">Volunteer Experience</label>
                                        <input type="text" name="volunteer_experience" class="form-control" value="@if(!empty($InfoData)){{ $InfoData->volunteer_experience }}@endif">
                                        <span id="reqvolexp" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="form-group level-drp">
                                        <label class="form-label" for="input-1">Hobbies and Interests</label>
                                        <textarea name="hobbies_interests" class="form-control">@if(!empty($InfoData)){{ $InfoData->hobbies_interests }}@endif</textarea>

                                        <span id="reqhobbiesint" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="box-button mt-15">
                                        <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitAdditionalInformation">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="tab-professional-membership" role="tabpanel" aria-labelledby="tab-interview-references" style="display: none">

                                <div class="card shadow-sm border-0 p-4 mt-30">
                                    <h3 class="mt-0 color-brand-1 mb-2">Professional Memberships</h3>
                                    <?php
                                    $MembershipData = DB::table("professional_membership")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
                                    ?>
                                    <form id="professional_memb_form" method="POST" onsubmit="return professional_membership_form()">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                                        <div class="form-group level-drp">
                                            <label class="form-label" for="input-1">Professional Associations </label>

                                            <input type="hidden" name="professional_as" class="professional_as" value="@if(!empty($MembershipData)){{ $MembershipData->des_profession_association }}@endif">
                                            <ul id="des_profession_association" style="display:none;">

                                                <li data-value="ANA">ANA</li>
                                                <li data-value="ENA">ENA</li>

                                            </ul>
                                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="des_profession_association" name="des_profession_association[]" multiple="multiple"></select>
                                            <span id="reqprofessassociation" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="form-group level-drp">
                                            <label class="form-label" for="input-1">Membership Numbers</label>
                                            <input type="text" name="prof_membership_numbers" class="form-control" value="@if(!empty($MembershipData)){{ $MembershipData->membership_numbers }}@endif">
                                            <span id="reqmembernumbers" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="form-group level-drp">
                                            <label class="form-label" for="input-1">Status</label>
                                            <select class="form-control" name="prof_membership_status" id="language-picker-select">
                                                <option value="">Select Status</option>
                                                <option value="Active" @if(!empty($MembershipData) && $MembershipData->membership_status == "Active") selected @endif>Active</option>
                                                <option value="Lapsed" @if(!empty($MembershipData) && $MembershipData->membership_status == "Lapsed") selected @endif>Lapsed</option>

                                            </select>
                                            <span id="reqmemberstatus" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="box-button mt-15">
                                            <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitProfessionalMembership">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-my-profile-setting" role="tabpanel" aria-labelledby="tab-my-profile-setting">

                                @if(email_verified())
                                @if(!account_verified())

                                <div class="alert alert-success mt-2" role="alert">
                                    <span class="d-flex align-items-center justify-content-center ">Your profile is in under review, Generally, it takes 2-3 business days. Until you can not make chnages in your profile setting. </span>
                                </div>
                                @endif
                                @endif
                                <div class="card shadow-sm border-0 p-4 mt-30">
                                    <h3 class="mt-0 color-brand-1 mb-2">Profile Setting</h3>

                                    <a class="font-md color-text-paragraph-2" href="#">You can make your profile visible for :</a>


                                    <form id="multi-step-form-nurseProfileForm" enctype="multipart/form-data">
                                        @csrf
                                        <!-- Other form fields -->

                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" value="1" id="visibleToMedicalFacilities"
                                                {{ Auth::guard('nurse_middle')->user()->medical_facilities=='Yes' ? 'checked' : '' }} name="medical_facilities">
                                            <label class="form-check-label" for="visibleToMedicalFacilities">
                                                Visible to Healthcare Facilities
                                            </label>
                                        </div>

                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" value="1" {{ Auth::guard('nurse_middle')->user()->agencies =='Yes'? 'checked' : '' }} id="visibleToAgencies" name="agencies">
                                            <label class="form-check-label" for="visibleToAgencies">
                                                Visible to Agencies
                                            </label>
                                        </div>
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" value="1" {{ Auth::guard('nurse_middle')->user()->individuals =='Yes'? 'checked' : '' }} id="visibleToIndividuals" name="individuals">
                                            <label class="form-check-label" for="visibleToAgencies">
                                                Visible to Individuals (Nurse care at home)
                                            </label>
                                        </div>
                                        <label class="form-check-label  mt-3" for="availableNow">
                                            <h6> Profile Status: </h6>
                                        </label>
                                        <div class="form-check  mt-1  mb-2">
                                            <input class="form-check-input" type="radio" value="1" id="availableNow" name="profile_status" @if(Auth::guard('nurse_middle')->user()->profile_status1 == '1') checked @endif >
                                            <label class="form-check-label" for="availableNow">
                                                Available Now
                                            </label>
                                        </div>

                                        <div class="form-check  mt-1  mb-2">
                                            <input class="form-check-input" type="radio" value="0" id="unavailableNow" name="profile_status" @if(Auth::guard('nurse_middle')->user()->profile_status1 == '0') checked @endif>
                                            <label class="form-check-label" for="unavailableNow">
                                                Unavailable for now
                                            </label>
                                        </div>
                                        <div class="form-group available_date_field d-none">
                                            <label for="available_start">When are you able to start?</label>
                                            <input type="date" name="available_date" class="form-control" value="{{ Auth::guard('nurse_middle')->user()->available_date }}">
                                        </div>
                                        <script type="text/javascript">
                                            $("#unavailableNow").click(function() {
                                                if ($("#unavailableNow").prop('checked') == true) {
                                                    $(".available_date_field").removeClass("d-none");
                                                } else {
                                                    $(".available_date_field").addClass("d-none");
                                                }
                                            });
                                            $("#availableNow").click(function() {
                                                $(".available_date_field").addClass("d-none");
                                            });
                                            if ($("#unavailableNow").prop('checked') == true) {
                                                $(".available_date_field").removeClass("d-none");
                                            }
                                        </script>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <button onclick="doprofessionSeting_update()" @if(!email_verified()) disabled @elseif(!account_verified()) disabled @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Update Setting</span>
                                                <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </button>
                                        </div>
                                    </form>


                                </div>

                            </div>
                            <div class="tab-pane fade" id="tab-vaccination" role="tabpanel" aria-labelledby="tab-educert" style="display: none">
                                <div class="card shadow-sm border-0 p-4 mt-30">
                                    <h3 class="mt-0 color-brand-1 mb-20">Vaccinations</h3>

                                    <?php
                                    $vaccinationData = DB::table("vaccination_front")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();
                                    //print_r($vaccinationData);
                                    ?>
                                    <form id="vaccination_form" method="POST" onsubmit="return vaccinationForm()">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group level-drp">

                                                    <label class="form-label" for="input-1">Vaccination Records</label>
                                                    <input type="hidden" name="vaccination_r" class="vaccination_r" value="@if(!empty($vaccinationData)){{ $vaccinationData->vaccination_records }}@endif">
                                                    <?php
                                                    $vaccination_record = DB::table("vaccination")->get();
                                                    ?>
                                                    <ul id="vaccination_record" style="display:none;">
                                                        @foreach($vaccination_record as $v_record)
                                                        <li data-value="{{ $v_record->id }}">{{ $v_record->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="vaccination_record" name="vaccination_record[]" multiple="multiple"></select>

                                                    <span id="reqempsdate" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="form-group level-drp">
                                                    <label class="form-label" for="input-1">Immunization Status </label>
                                                    <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                                                    <select class="form-input mr-10 select-active" name="immunization_status">
                                                        <option value="">Immunization Status</option>
                                                        <option value="Up-to-date" @if(!empty($vaccinationData)) @if($vaccinationData->immunization_status == "Up-to-date") selected @endif @endif>Up-to-date</option>
                                                        <option value="Pending" @if(!empty($vaccinationData)) @if($vaccinationData->immunization_status == "Pending") selected @endif @endif>Pending</option>
                                                    </select>
                                                </div>
                                                <div class="box-button mt-15">
                                                    <button class="btn btn-apply-big font-md font-bold" type="submitVaccination" id="submitVaccination" @if(!empty($experienceData)) @if($experienceData->complete_status != 1) disabled @endif @endif>Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-myclearance-jobs" role="tabpanel" aria-labelledby="tab-myclearance-jobs" style="display: none">


                                <div class="card shadow-sm border-0 p-4 mt-30">

                                    <h3 class="mt-2 color-brand-1 mb-2">Work Clearances</h3>
                                    <a class="font-md color-text-paragraph-2" href="#">Please provide your work clearances, as required for the roles you want to apply to. Find work you want, to learn what’s required. Keep your work clearances up-to-date to maintain your eligibility for jobs</a>
                                    <h6 class="mt-2 color-brand-1 mb-2">Eligibility To Work</h6>
                                    <a class="font-md color-text-paragraph-2" href="#">{{ env('APP_NAME') }} does not yet connect talent to sponsorship opportunities</a>
                                    <form id="multi-step-form-eligibility" enctype="multipart/form-data">
                                        @csrf
                                        @php
                                        $clearances_data =clearances_data();

                                        @endphp

                                        <?php $valesidency = '';
                                        if ($clearances_data != 'null') $valesidency = $clearances_data->residency; ?>
                                        <div class="form-group mt-3">
                                            <label class="form-label" for="input-1">Residency</label>
                                            <select class="form-control" name="residency" id="residencyId">
                                                <option value="">Select</option>
                                                <option value="Citizen" {{ $valesidency == "Citizen" ? 'selected' : '' }}>Citizen</option>
                                                <option value="Permanent Resident" {{ $valesidency == "Permanent Resident" ? 'selected' : '' }}>Permanent Resident</option>
                                                <option value="Visa Holder" {{ $valesidency == "Visa Holder" ? 'selected' : '' }}>Visa Holder</option>

                                            </select>
                                        </div>
                                        <span id="reqTxtresidencyId" class="reqError text-danger valley"></span>

                                        <div id="passport_detail" @if($valesidency=='Citizen' ) style="display:none;" @endif>
                                            <div class="form-group ">
                                                <?php $valvisa_subclass_numbery = '';
                                                if ($clearances_data != 'null') $valvisa_subclass_numbery = $clearances_data->visa_subclass_number; ?>
                                                <label class="font-sm color-text-mutted mb-10">Visa Subclass Number *</label>
                                                <input class="form-control" type="text" name="visa_subclass_number" id="visa_subclass_numberI" placeholder="" value="{{$valvisa_subclass_numbery }}">
                                            </div>


                                            <span id="reqTxtvisa_subclass_numberId" class="reqError text-danger valley"></span>
                                            <div class="form-group ">
                                                <?php $passport_number = '';
                                                if ($clearances_data != 'null') $passport_number = $clearances_data->passport_number; ?>
                                                <label class="font-sm color-text-mutted mb-10">Passport Number *</label>
                                                <input class="form-control" type="text" name="passport_number" id="passport_numberI" placeholder="" value="{{ $passport_number }}">
                                            </div>


                                            <span id="reqTxtpassport_numberI" class="reqError text-danger valley"></span>


                                            <div class="form-group position-relative">
                                                <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                                                <select class="form-control form-select" name="passport_country_of_Issue" id="passportcountryI">
                                                    <option value="">Select Country</option>
                                                    <?php $countryumber = Auth::guard('nurse_middle')->user()->country;
                                                    if ($clearances_data != 'null') $countryumber = $clearances_data->passport_country_of_Issue; ?>
                                                    @php $country_data=country_name_from_db();@endphp
                                                    @foreach ($country_data as $data)
                                                    <option value="{{$data->id}}" <?= $countryumber == $data->id ? 'selected' : '' ?>> {{$data->name}} </option>
                                                    @endforeach


                                                </select>
                                                <span id="reqTxtpassportcountryI" class="reqError text-danger valley"></span>
                                            </div>



                                            <div class="form-group ">
                                                <?php $visa_grant_number = '';
                                                if ($clearances_data != 'null') $visa_grant_number = $clearances_data->visa_grant_number; ?>
                                                <label class="font-sm color-text-mutted mb-10">Visa Grant Number*</label>
                                                <input class="form-control" type="text" name="visa_grant_number" id="visa_grant_numberI" placeholder="" value="{{ $visa_grant_number }}">
                                            </div>


                                            <span id="reqTxtvisa_grant_number" class="reqError text-danger valley"></span>

                                        </div>
                                        <div id="passport_detail_date" @if($valesidency !='Visa Holder' ) style="display:none;" @endif>
                                            <div class="form-group ">
                                                <?php $expiry_data = '';
                                                if ($clearances_data != 'null') $expiry_data = $clearances_data->expiry_date; ?>
                                                <label class="font-sm color-text-mutted mb-10">Expiry Date*</label>
                                                <input class="form-control" type="date" name="expiry_date" id="expiry_dataI" value="{{ $expiry_data }}" min="{{ date('Y-m-d') }}">
                                            </div>
                                            <span id="reqTxtexpiry_dataI" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="form-label" for="input-1">Support Document</label>
                                                <?php
                                                if ($clearances_data != 'null') {
                                                    $valspecialimage = $clearances_data->support_document;
                                                    if ($valspecialimage != 'null' && $valspecialimage != '') {
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
                                                <input type="file" name="image_support_document" id="image_support_documentI" class="form-control h-100" accept="image/*">
                                                <?php
                                                if ($clearances_data != 'null') {
                                                    $valspecialimage = $clearances_data->support_document;
                                                    if ($valspecialimage != 'null' && $valspecialimage != '') {
                                                ?>

                                                        <a href="{{ asset($valspecialimage) }}" target="_blank" class="mt-2">
                                                            <img src="{{ asset($valspecialimage) }}" width="50px;" height="50px" />

                                                        </a>

                                                <?php
                                                    }
                                                } else {
                                                    $valspecialimage = '/nurse/assets/imgs/evidence_of_year_level1712557746.png';
                                                }
                                                ?>
                                            </div>


                                            <span id="reqasupport_document" class="reqError text-danger valley"></span>

                                            <div class="d-flex align-items-center justify-content-between">
                                                <button onclick="doeligibility_to_work()" @if(!email_verified()) disabled @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                                                    <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                </button>

                                            </div>

                                    </form>
                                </div>
                                <!--==========-->
                                <!--Working With Children Check-->
                                <!--==========-->
                                <div class="card shadow-sm border-0 p-4 mt-30">
                                    <h3 class="mt-0 color-brand-1 mb-2">Working With Children Check</h3>
                                    <a class="font-md color-text-paragraph-2" href="#">Add your state specific working with children clearance/s as required. Refer to your profile checklist</a>
                                    <div><span class="btn-dark badge badge-dark">Optional</span> </div>
                                    <form id="multi-step-form-children" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            @php
                                            $working_data =working_data();

                                            @endphp
                                            <div class="form-group ">
                                                <?php $clearance_number = '';
                                                if ($working_data != 'null') $clearance_number = $working_data->clearance_number; ?>
                                                <label class="font-sm color-text-mutted mb-10">Clearance Number*</label>
                                                <input class="form-control" type="text" name="clearance_number" id="clearance_numberI" placeholder="" value="{{ $clearance_number }}">
                                            </div>
                                            <span id="reqTxtclearance_numberI" class="reqError text-danger valley"></span>

                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <!-- <textarea type="text" class="form-control ps-5" placeholder="Address"></textarea> -->
                                                    <label>State *</label>
                                                    <select class="form-control form-select" name="clearance_state" id="clearancestateI" id="stateI">
                                                        @php
                                                        if(isset( Auth::guard('nurse_middle')->user()->country)){
                                                        $state_data =state_name_array( Auth::guard('nurse_middle')->user()->country);
                                                        }else{
                                                        $state_data = '';
                                                        }
                                                        @endphp
                                                        <?php $state_data_child = Auth::guard('nurse_middle')->user()->state;
                                                        if ($working_data != 'null') $state_data_child = $working_data->expiry_date; ?>
                                                        @if(isset($state_data) && !empty($state_data))
                                                        @foreach ($state_data as $data_state)
                                                        <option value="{{$data_state->id}}" <?= $state_data_child  == $data_state->id ? 'selected' : '' ?>> {{$data_state->name}} </option>
                                                        @endforeach
                                                        @endif

                                                    </select>
                                                    <!--<i class="fa-solid fa-location-dot position-absolute  start-0 translate-middle-y ms-3 fs-5 text-primary" style="    top: 25px!important;"></i>-->
                                                </div>
                                                <span id="reqTxtclearancestateI" class="reqError text-danger valley"></span>
                                            </div>

                                            <div class="form-group ">
                                                <?php $workingexpiry_data = '';
                                                if ($working_data != 'null') $workingexpiry_data = $working_data->expiry_date; ?>
                                                <label class="font-sm color-text-mutted mb-10">Expiry Date*</label>
                                                <input class="form-control" type="date" name="clearance_expiry_date" id="clearance_expiry_dataI" value="{{ $workingexpiry_data }}" min="{{ date('Y-m-d') }}">
                                            </div>
                                            <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>

                                            <div class="col-md-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <button onclick="do_children_check()" @if(!email_verified()) disabled @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                                                        <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--==========-->
                                <!-- Police check -->
                                <!--==========-->
                                <div class="card shadow-sm border-0 p-4 mt-30">
                                    <h3 class="mt-0 color-brand-1 mb-2">Police check</h3>
                                    <a class="font-md color-text-paragraph-2 mb-2" href="#">Add your national police check certificate, if you have one already. The recency of the check required, will depend on the role you want. Find work you want, to learn what’s required. The check must be for employment purposes. Volunteer checks will not be accepted</a>
                                    <div><span class="btn-dark badge badge-dark">Optional</span> </div>
                                    <div class="mt-2 mb-2"><span class="btn-light badge badge-dark" style="color:#000;">Get new police check</span> <i class="fi fi-rr-info" onclick="get_new_plice_check()"></i></div>
                                    <div class="mb-2">
                                        <a href="https://secure.policecheckexpress.com.au/intercheck/landing/1389/507997" target="_blank">
                                            <span class="btn-secondary badge badge-secondary" target="_blank"><i class="fi fi-rr-info"></i> Get new police check </span>
                                        </a>
                                    </div>
                                    <form id="multi-step-form-police-check" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            @php
                                            $police_check_data =police_check_data();

                                            @endphp



                                            <div class="form-group ">
                                                <?php $date_acquired = '';
                                                if ($police_check_data != 'null') $date_acquired = $police_check_data->date; ?>
                                                <label class="font-sm color-text-mutted mb-10">Date Acquired*</label>
                                                <input class="form-control" type="date" name="date_acquired" id="date_acquiredI" value="{{ $date_acquired }}" max="{{ date('Y-m-d') }}">
                                            </div>
                                            <span id="reqTxtdate_acquiredI" class="reqError text-danger valley"></span>

                                            <div class="form-group">
                                                <label class="form-label" for="input-1">Police Check</label>
                                                <?php
                                                if ($police_check_data != 'null') {
                                                    $check_image = $police_check_data->image;
                                                    if ($check_image != 'null' && $check_image != '') {
                                                ?>

                                                        <a href="{{ asset($check_image) }}" target="_blank">

                                                            <span class="btn-primary badge badge-primary">Show</span>
                                                        </a>

                                                <?php
                                                    }
                                                } else {
                                                    $check_image = '/nurse/assets/imgs/evidence_of_year_level1712557746.png';
                                                }
                                                ?>
                                                <input type="file" name="image_support_document_police" id="image_support_document_policeI" class="form-control" accept="image/*">
                                                <?php
                                                if ($police_check_data != 'null') {
                                                    $check_image = $police_check_data->image;
                                                    if ($check_image != 'null' && $check_image != '') {
                                                ?>

                                                        <a href="{{ asset($check_image) }}" target="_blank" class="mt-2">
                                                            <img src="{{ asset($check_image) }}" width="50px;" height="50px" />

                                                        </a>

                                                <?php
                                                    }
                                                } else {
                                                    $check_image = '/nurse/assets/imgs/evidence_of_year_level1712557746.png';
                                                }
                                                ?>
                                            </div>

                                            <span id="reqTxtimage_support_documentI" class="reqError text-danger valley"></span>



                                            <?php
                                            if ($police_check_data != 'null') {
                                                $status = $police_check_data->status;
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
                                                            <button onclick="do_police_check()" class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Re-Submit</span>
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
                                                        <button onclick="doprofession()" @if(!email_verified()) disabled @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
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
                                                        <button onclick="do_police_check()" @if(!email_verified()) disabled @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                                                            <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                                                                <span class="sr-only">Loading...</span>
                                                            </div>
                                                        </button>

                                                    </div>
                                                </div>
                                            <?php

                                                    }
                                            ?>




                                        </div>
                                    </form>
                                </div>


                            </div>

                            <div class="tab-pane fade" id="tab-saved-jobs" role="tabpanel" aria-labelledby="tab-saved-jobs">
                                <h3 class="mt-30 color-brand-1 mb-50">Menu 3</h3>

                                <div class="row form-contact">
                                    <div class="col-lg-6 col-md-12">

                                        <h6 class="color-orange mb-20">Change your password</h6>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="font-sm color-text-mutted mb-10">Password</label>
                                                    <input class="form-control" type="password" value="123456789">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="font-sm color-text-mutted mb-10">Re-Password *</label>
                                                    <input class="form-control" type="password" value="123456789">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-bottom pt-10 pb-10"></div>
                                        <div class="box-agree mt-30">
                                            <label class="lbl-agree font-xs color-text-paragraph-2">
                                                <input class="lbl-checkbox" type="checkbox" value="1">Available for freelancers
                                            </label>
                                        </div>
                                        <div class="box-button mt-15">
                                            <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="box-skills">
                                            <h5 class="mt-0 color-brand-1">Speciality</h5>
                                            <div class="form-contact">
                                                <div class="form-group">
                                                    <input class="form-control search-icon" type="text" value="" placeholder="E.g. Angular, Laravel...">
                                                </div>
                                            </div>
                                            <div class="box-tags mt-30">
                                                <a class="btn btn-grey-small mr-10">Gen<span class="close-icon"></span></a>
                                                <a class="btn btn-grey-small mr-10">Gen Surg<span class="close-icon"></span></a>
                                                <a class="btn btn-grey-small mr-10">Gen Paeds<span class="close-icon"></span></a>
                                                <a class="btn btn-grey-small mr-10">Resp<span class="close-icon"></span></a>
                                                <a class="btn btn-grey-small mr-10">Cardio<span class="close-icon"></span></a>
                                                <a class="btn btn-grey-small mr-10">Gastro<span class="close-icon"></span></a>
                                                <a class="btn btn-grey-small mr-10">Surg<span class="close-icon"></span></a>
                                            </div>
                                            <div class="mt-40"> <span class="card-info font-sm color-text-paragraph-2">You can add up to 15 skills</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="tab-my-menu4" role="tabpanel" aria-labelledby="tab-my-menu4">
                                <h3 class="mt-30 mb-15 color-brand-1">My Account</h3><a class="font-md color-text-paragraph-2" href="#">Update your profile</a>
                                <div class="mt-35 mb-40 box-info-profie">
                                    <div class="image-profile"><img src="assets/imgs/nurse6.png" alt="jobbox"></div><a class="btn btn-apply">Upload Avatar</a><a class="btn btn-link">Delete</a>
                                </div>
                                <div class="row form-contact">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Full Name *</label>
                                            <input class="form-control" type="text" value="Steven Job">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Email *</label>
                                            <input class="form-control" type="text" value="stevenjob@gmail.com">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Contact number</label>
                                            <input class="form-control" type="text" value="01 - 234 567 89">
                                        </div>
                                        <!-- <div class="form-group">
                      <label class="font-sm color-text-mutted mb-10">Bio</label>
                      <textarea class="form-control" rows="4">We are AliThemes , a creative and dedicated group of individuals who love web development almost as much as we love our customers. We are passionate team with the mission for achieving the perfection in web design.</textarea>
                    </div> -->
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Personal website</label>
                                            <input class="form-control" type="url" value="https://alithemes.com/">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="font-sm color-text-mutted mb-10">Country</label>
                                                    <input class="form-control" type="text" value="United States">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="font-sm color-text-mutted mb-10">State</label>
                                                    <input class="form-control" type="text" value="New York">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="font-sm color-text-mutted mb-10">City</label>
                                                    <input class="form-control" type="text" value="Mcallen">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="font-sm color-text-mutted mb-10">Zip code</label>
                                                    <input class="form-control" type="text" value="82356">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="border-bottom pt-10 pb-10 mb-30"></div> -->
                                        <h6 class="color-orange mb-20">Change your password</h6>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="font-sm color-text-mutted mb-10">Password</label>
                                                    <input class="form-control" type="password" value="123456789">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="font-sm color-text-mutted mb-10">Re-Password *</label>
                                                    <input class="form-control" type="password" value="123456789">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-bottom pt-10 pb-10"></div>
                                        <div class="box-agree mt-30">
                                            <label class="lbl-agree font-xs color-text-paragraph-2">
                                                <input class="lbl-checkbox" type="checkbox" value="1">Available for freelancers
                                            </label>
                                        </div>
                                        <div class="box-button mt-15">
                                            <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="box-skills">
                                            <h5 class="mt-0 color-brand-1">Skills</h5>
                                            <div class="form-contact">
                                                <div class="form-group">
                                                    <input class="form-control search-icon" type="text" value="" placeholder="E.g. Angular, Laravel...">
                                                </div>
                                            </div>
                                            <div class="box-tags mt-30"><a class="btn btn-grey-small mr-10">Figma<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">Adobe XD<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">NextJS<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">React<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">App<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">Digital<span class="close-icon"></span></a><a class="btn btn-grey-small mr-10">NodeJS<span class="close-icon"></span></a></div>
                                            <div class="mt-40"> <span class="card-info font-sm color-text-paragraph-2">You can add up to 15 skills</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="tab-pane fade" id="tab-my-menu5" role="tabpanel" aria-labelledby="tab-my-menu5">


                                <div class="card shadow-sm border-0 p-4">
                                    <h3 class="mt-0 color-brand-1 mb-2">My Table</h3>
                                    <a class="font-md color-text-paragraph-2" href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>

                                    <table class="table table-hover mt-30">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">First</th>
                                                <th scope="col">Last</th>
                                                <th scope="col">Handle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Larry the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>




                            <div class="tab-pane fade" id="tab-saved-menu6" role="tabpanel" aria-labelledby="tab-saved-menu6">
                                <h3 class="mt-30 color-brand-1 mb-50">Menu 3</h3>

                                <div class="row form-contact">
                                    <div class="col-lg-6 col-md-12">

                                        <h6 class="color-orange mb-20">Change your password</h6>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="font-sm color-text-mutted mb-10">Password</label>
                                                    <input class="form-control" type="password" value="123456789">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="font-sm color-text-mutted mb-10">Re-Password *</label>
                                                    <input class="form-control" type="password" value="123456789">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-bottom pt-10 pb-10"></div>
                                        <div class="box-agree mt-30">
                                            <label class="lbl-agree font-xs color-text-paragraph-2">
                                                <input class="lbl-checkbox" type="checkbox" value="1">Available for freelancers
                                            </label>
                                        </div>
                                        <div class="box-button mt-15">
                                            <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="box-skills">
                                            <h5 class="mt-0 color-brand-1">Speciality</h5>
                                            <div class="form-contact">
                                                <div class="form-group">
                                                    <input class="form-control search-icon" type="text" value="" placeholder="E.g. Angular, Laravel...">
                                                </div>
                                            </div>
                                            <div class="box-tags mt-30">
                                                <a class="btn btn-grey-small mr-10">Gen<span class="close-icon"></span></a>
                                                <a class="btn btn-grey-small mr-10">Gen Surg<span class="close-icon"></span></a>
                                                <a class="btn btn-grey-small mr-10">Gen Paeds<span class="close-icon"></span></a>
                                                <a class="btn btn-grey-small mr-10">Resp<span class="close-icon"></span></a>
                                                <a class="btn btn-grey-small mr-10">Cardio<span class="close-icon"></span></a>
                                                <a class="btn btn-grey-small mr-10">Gastro<span class="close-icon"></span></a>
                                                <a class="btn btn-grey-small mr-10">Surg<span class="close-icon"></span></a>
                                            </div>
                                            <div class="mt-40"> <span class="card-info font-sm color-text-paragraph-2">You can add up to 15 skills</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>






                    </div>




                </div>
                <footer class="footer pt-0" style="margin: 0 11px;">

                    <div class="container">




                        <div class="footer-bottom ">

                            <div class="row footer_profile_cls">

                                <div class="col-md-6"><span class="font-xs color-text-paragraph">Copyright © 2024. Mediqa all right reserved</span></div>

                                <div class="col-md-6 text-md-end text-start privacy_option">

                                    <div class="footer-social"><a class="font-xs color-text-paragraph" href="#">Privacy Policy</a><a class="font-xs color-text-paragraph mr-30 ml-30" href="#">Terms &amp; Conditions</a></div>

                                </div>

                            </div>

                        </div>

                    </div>

                </footer>
            </div>
        </div>
    </section>

</main>

<?php
if (!empty($interviewReferenceData)) {
    $country_iso = $interviewReferenceData->contact_country_iso;
} else {
    $country_iso = "au";
}
?>
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


<!-- Add All button & Remove all button code End -->

<!-- <script>
        $(document).ready(function() {
            // Initialize Select2
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
        });
    </script> -->
<script type="text/javascript">
    $('.post_code').keypress(function(e) {

        var charCode = (e.which) ? e.which : event.keyCode

        if (String.fromCharCode(charCode).match(/[^0-9]/g))

            return false;

    });
    $('#contactI').keypress(function(e) {

        var charCode = (e.which) ? e.which : event.keyCode

        if (String.fromCharCode(charCode).match(/[^0-9]/g))

            return false;

    });
    $('#emergency_country_iso').keypress(function(e) {

        var charCode = (e.which) ? e.which : event.keyCode

        if (String.fromCharCode(charCode).match(/[^0-9]/g))

            return false;

    });
    $('.js-example-basic-multiple').each(function() {
        let listId = $(this).data('list-id');
        //alert(listId);
        let items = [];
        console.log("listId1", listId);
        $('#' + listId + ' li').each(function() {
            console.log("value1", $(this).text());
            items.push({
                id: $(this).data('value'),
                text: $(this).text()
            });
        });
        console.log("items1", items);
        $(this).select2({
            data: items
        });
        //$("#type-of-nurse").select2({'val': 3});          
    });
    //$("#type-of-nurse").val([1,2,3], null, false);
    //$("#type-of-nurse").select2().select 2("val", [1,2,3]);
    if ($(".ntype").val() != "") {
        var nurse_type = JSON.parse($(".ntype").val());
        $('#nurse_type').select2().val(nurse_type).trigger('change');
    }

    if ($(".ntypeexperience").val() != "") {
        var nurse_type = JSON.parse($(".ntypeexperience").val());
        $('#nurse_type_experience').select2().val(nurse_type).trigger('change');
    }



    if ($(".nursing_result_one").val() != "") {
        var entry_level = JSON.parse($(".nursing_result_one").val());
        $('.js-example-basic-multiple[data-list-id="nursing_entry-1"]').select2().val(entry_level).trigger('change');
    }

    if ($(".nursing_result_one_experience").val() != "") {
        var entry_level = JSON.parse($(".nursing_result_one_experience").val());
        $('.js-example-basic-multiple[data-list-id="nursing_entry_experience-1"]').select2().val(entry_level).trigger('change');
    }

    if ($(".nursing_result_two").val() != "") {
        var registered_nurses = JSON.parse($(".nursing_result_two").val());
        $('.js-example-basic-multiple[data-list-id="nursing_entry-2"]').select2().val(registered_nurses).trigger('change');
    }

    if ($(".nursing_result_two_experience").val() != "") {
        var registered_nurses = JSON.parse($(".nursing_result_two_experience").val());
        $('.js-example-basic-multiple[data-list-id="nursing_entry_experience-2"]').select2().val(registered_nurses).trigger('change');
    }

    if ($(".nursing_result_three").val() != "") {
        var advanced_practioner = JSON.parse($(".nursing_result_three").val());
        $('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2().val(advanced_practioner).trigger('change');
    }

    if ($(".nursing_result_three_experience").val() != "") {
        var advanced_practioner = JSON.parse($(".nursing_result_three_experience").val());
        $('.js-example-basic-multiple[data-list-id="nursing_entry_experience-3"]').select2().val(advanced_practioner).trigger('change');
    }

    if ($(".np_result").val() != "") {
        var nurse_prac = JSON.parse($(".np_result").val());
        $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(nurse_prac).trigger('change');
    }

    if ($(".np_result_experience").val() != "") {
        var nurse_prac = JSON.parse($(".np_result_experience").val());
        $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu_experience"]').select2().val(nurse_prac).trigger('change');
    }

    if ($(".specialties_result").val() != "") {
        var specialties = JSON.parse($(".specialties_result").val());
        $('.js-example-basic-multiple[data-list-id="specialties"]').select2().val(specialties).trigger('change');
    }

    if ($(".specialties_result_experience").val() != "") {
        var specialties = JSON.parse($(".specialties_result_experience").val());
        $('.js-example-basic-multiple[data-list-id="specialties_experience"]').select2().val(specialties).trigger('change');
    }

    if ($(".adults_result").val() != "") {
        var adults = JSON.parse($(".adults_result").val());
        $('.js-example-basic-multiple[data-list-id="speciality_entry-1"]').select2().val(adults).trigger('change');
    }

    if ($(".maternity_result").val() != "") {
        var maternity = JSON.parse($(".maternity_result").val());
        $('.js-example-basic-multiple[data-list-id="speciality_entry-2"]').select2().val(maternity).trigger('change');
    }

    if ($(".padneonatal_result").val() != "") {
        var paediatrics_neonatal = JSON.parse($(".padneonatal_result").val());
        $('.js-example-basic-multiple[data-list-id="speciality_entry-3"]').select2().val(paediatrics_neonatal).trigger('change');
    }

    if ($(".community_result").val() != "") {
        var community = JSON.parse($(".community_result").val());
        $('.js-example-basic-multiple[data-list-id="speciality_entry-4"]').select2().val(community).trigger('change');
    }

    if ($(".adults_result_experience").val() != "") {
        var adults = JSON.parse($(".adults_result_experience").val());
        $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-1"]').select2().val(adults).trigger('change');
    }

    if ($(".maternity_result_experience").val() != "") {
        var maternity = JSON.parse($(".maternity_result_experience").val());
        $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-2"]').select2().val(maternity).trigger('change');
    }

    if ($(".padneonatal_result_experience").val() != "") {
        var paediatrics_neonatal = JSON.parse($(".padneonatal_result_experience").val());
        $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-3"]').select2().val(paediatrics_neonatal).trigger('change');
    }

    if ($(".community_result_experience").val() != "") {
        var community = JSON.parse($(".community_result_experience").val());
        $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-4"]').select2().val(community).trigger('change');
    }

    if ($(".surgical_preoperative_result").val() != "") {
        var surgical_preoperative = JSON.parse($(".surgical_preoperative_result").val());
        $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(surgical_preoperative).trigger('change');
    }

    if ($(".surgical_preoperative_result_experience").val() != "") {
        var surgical_preoperative = JSON.parse($(".surgical_preoperative_result_experience").val());
        $('.js-example-basic-multiple[data-list-id="surgical_row_box_experience"]').select2().val(surgical_preoperative).trigger('change');
    }

    if ($(".operatingroom_result").val() != "") {
        var operating_room = JSON.parse($(".operatingroom_result").val());
        $('.js-example-basic-multiple[data-list-id="surgical_operative_care-1"]').select2().val(operating_room).trigger('change');
    }

    if ($(".operatingroom_result_experience").val() != "") {
        var operating_room = JSON.parse($(".operatingroom_result_experience").val());
        $('.js-example-basic-multiple[data-list-id="surgical_operative_care_experience-1"]').select2().val(operating_room).trigger('change');
    }

    if ($(".operatingscout_result").val() != "") {
        var operating_room_scout = JSON.parse($(".operatingscout_result").val());
        $('.js-example-basic-multiple[data-list-id="surgical_operative_care-2"]').select2().val(operating_room_scout).trigger('change');
    }

    if ($(".operatingscout_result_experience").val() != "") {
        var operating_room_scout = JSON.parse($(".operatingscout_result_experience").val());
        $('.js-example-basic-multiple[data-list-id="surgical_operative_care_experience-2"]').select2().val(operating_room_scout).trigger('change');
    }

    if ($(".operatingscrub_result").val() != "") {
        var operating_room_scrub = JSON.parse($(".operatingscrub_result").val());
        $('.js-example-basic-multiple[data-list-id="surgical_operative_care-3"]').select2().val(operating_room_scrub).trigger('change');
    }

    if ($(".operatingscrub_result_experience").val() != "") {
        var operating_room_scrub = JSON.parse($(".operatingscrub_result_experience").val());
        $('.js-example-basic-multiple[data-list-id="surgical_operative_care_experience-3"]').select2().val(operating_room_scrub).trigger('change');
    }

    if ($(".surgical_ob_result").val() != "") {
        var surgical_obstrics_gynacology = JSON.parse($(".surgical_ob_result").val());
        $('.js-example-basic-multiple[data-list-id="surgical_obs_care"]').select2().val(surgical_obstrics_gynacology).trigger('change');
    }

    if ($(".neonatal_care_result").val() != "") {
        var neonatal_care = JSON.parse($(".neonatal_care_result").val());
        $('.js-example-basic-multiple[data-list-id="neonatal_care"]').select2().val(neonatal_care).trigger('change');
    }

    if ($(".neonatal_care_result_experience").val() != "") {
        var neonatal_care = JSON.parse($(".neonatal_care_result_experience").val());
        $('.js-example-basic-multiple[data-list-id="neonatal_care_experience"]').select2().val(neonatal_care).trigger('change');
    }

    if ($(".paedia_surgical_result").val() != "") {
        var paedia_surgical_preoperative = JSON.parse($(".paedia_surgical_result").val());
        $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').select2().val(paedia_surgical_preoperative).trigger('change');
    }

    if ($(".paedia_surgical_result_experience").val() != "") {
        var paedia_surgical_preoperative = JSON.parse($(".paedia_surgical_result_experience").val());
        $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box_experience"]').select2().val(paedia_surgical_preoperative).trigger('change');
    }

    if ($(".pad_op_room_result").val() != "") {
        var pad_op_room = JSON.parse($(".pad_op_room_result").val());
        $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-1"]').select2().val(pad_op_room).trigger('change');
    }

    if ($(".pad_qr_scout_result").val() != "") {
        var pad_qr_scout = JSON.parse($(".pad_qr_scout_result").val());
        $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-2"]').select2().val(pad_qr_scout).trigger('change');
    }

    if ($(".pad_qr_scrub_result").val() != "") {
        var pad_qr_scrub = JSON.parse($(".pad_qr_scrub_result").val());
        $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-3"]').select2().val(pad_qr_scrub).trigger('change');
    }

    if ($(".pad_op_room_result_experience").val() != "") {
        var pad_op_room = JSON.parse($(".pad_op_room_result_experience").val());
        console.log("pad_op_room", pad_op_room);
        $('.js-example-basic-multiple[data-list-id="surgical_operative_carep_experience-1"]').select2().val(pad_op_room).trigger('change');
    }

    if ($(".pad_qr_scout_result_experience").val() != "") {
        var pad_qr_scout = JSON.parse($(".pad_qr_scout_result_experience").val());
        console.log("pad_qr_scout", pad_qr_scout);
        $('.js-example-basic-multiple[data-list-id="surgical_operative_carep_experience-2"]').select2().val(pad_qr_scout).trigger('change');
    }

    if ($(".pad_qr_scrub_result_experience").val() != "") {
        var pad_qr_scrub = JSON.parse($(".pad_qr_scrub_result_experience").val());
        $('.js-example-basic-multiple[data-list-id="surgical_operative_carep_experience-3"]').select2().val(pad_qr_scrub).trigger('change');
    }

    if ($(".nurse_degree_one").val() != "") {
        var nurse_degree = JSON.parse($(".nurse_degree_one").val());
        $('.js-example-basic-multiple[data-list-id="ndegree"]').select2().val(nurse_degree).trigger('change');
    }

    if ($(".prof_cert_new").val() != "") {
        var prof_cert_new = JSON.parse($(".prof_cert_new").val());
        $('.js-example-basic-multiple[data-list-id="profess_cert"]').select2().val(prof_cert_new).trigger('change');
    }

    // if($(".training_course").val() != ""){
    //   var training_course = JSON.parse($(".training_course").val());
    //   $('.js-example-basic-multiple[data-list-id="training_courses"]').select2().val(training_course).trigger('change');
    // }

    // if($(".training_workshops").val() != ""){
    //   var training_workshops = JSON.parse($(".training_workshops").val());
    //   $('.js-example-basic-multiple[data-list-id="training_workshop"]').select2().val(training_workshops).trigger('change');
    // }

    // if($(".position_held").val() != ""){
    //   var position_held = JSON.parse($(".position_held").val());
    //   $('.js-example-basic-multiple[data-list-id="positions_held"]').select2().val(position_held).trigger('change');
    // }

    if ($(".skills_comp").val() != "") {
        var skills_comp = JSON.parse($(".skills_comp").val());
        $('.js-example-basic-multiple[data-list-id="skills_compantancies"]').select2().val(skills_comp).trigger('change');
    }

    if ($(".evidence_type").val() != "") {
        var evidence_type = JSON.parse($(".evidence_type").val());
        $('.js-example-basic-multiple[data-list-id="type_of_evidence"]').select2().val(evidence_type).trigger('change');
    }

    if ($(".desired_job_roles").val() != "") {
        var desired_job_roles = JSON.parse($(".desired_job_roles").val());
        $('.js-example-basic-multiple[data-list-id="des_job_role"]').select2().val(desired_job_roles).trigger('change');
    }

    if ($(".benefit_preferences").val() != "") {
        var benefit_preferences = JSON.parse($(".benefit_preferences").val());
        $('.js-example-basic-multiple[data-list-id="benefit_prefer"]').select2().val(benefit_preferences).trigger('change');
    }

    if ($(".vaccination_r").val() != "") {
        var vaccination_record = JSON.parse($(".vaccination_r").val());
        $('.js-example-basic-multiple[data-list-id="vaccination_record"]').select2().val(vaccination_record).trigger('change');
    }

    if ($(".pro_cert_acls").val() != "") {
        var pro_cert_acls = JSON.parse($(".pro_cert_acls").val());
        console.log("pro_cert_acls", pro_cert_acls);
        $('.js-example-basic-multiple[data-list-id="acls_data"]').select2().val(pro_cert_acls).trigger('change');
    }

    if ($(".pro_cert_bls").val() != "") {
        var pro_cert_bls = JSON.parse($(".pro_cert_bls").val());
        console.log("pro_cert_bls", pro_cert_bls);
        $('.js-example-basic-multiple[data-list-id="bls_data"]').select2().val(pro_cert_bls).trigger('change');
    }

    if ($(".pro_cert_cpr").val() != "") {
        var pro_cert_cpr = JSON.parse($(".pro_cert_cpr").val());
        console.log("pro_cert_bls", pro_cert_cpr);
        $('.js-example-basic-multiple[data-list-id="cpr_data"]').select2().val(pro_cert_cpr).trigger('change');
    }

    if ($(".pro_cert_nrp").val() != "") {
        var pro_cert_nrp = JSON.parse($(".pro_cert_nrp").val());
        console.log("pro_cert_bls", pro_cert_nrp);
        $('.js-example-basic-multiple[data-list-id="nrp_data"]').select2().val(pro_cert_nrp).trigger('change');
    }

    if ($(".pro_cert_pals").val() != "") {
        var pro_cert_pals = JSON.parse($(".pro_cert_pals").val());
        console.log("pro_cert_bls", pro_cert_pals);
        $('.js-example-basic-multiple[data-list-id="pls_data"]').select2().val(pro_cert_pals).trigger('change');
    }

    if ($(".pro_cert_rn").val() != "") {
        var pro_cert_rn = JSON.parse($(".pro_cert_rn").val());
        console.log("pro_cert_bls", pro_cert_rn);
        $('.js-example-basic-multiple[data-list-id="rn_data"]').select2().val(pro_cert_rn).trigger('change');
    }

    if ($(".pro_cert_np").val() != "") {
        var pro_cert_np = JSON.parse($(".pro_cert_np").val());
        console.log("pro_cert_bls", pro_cert_np);
        $('.js-example-basic-multiple[data-list-id="np_data"]').select2().val(pro_cert_np).trigger('change');
    }

    if ($(".pro_cert_cna").val() != "") {
        var pro_cert_cna = JSON.parse($(".pro_cert_cna").val());
        console.log("pro_cert_bls", pro_cert_cna);
        $('.js-example-basic-multiple[data-list-id="cn_data"]').select2().val(pro_cert_cna).trigger('change');
    }

    if ($(".pro_cert_lpn").val() != "") {
        var pro_cert_lpn = JSON.parse($(".pro_cert_lpn").val());
        console.log("pro_cert_bls", pro_cert_lpn);
        $('.js-example-basic-multiple[data-list-id="lpn_data"]').select2().val(pro_cert_lpn).trigger('change');
    }

    if ($(".pro_cert_crna").val() != "") {
        var pro_cert_crna = JSON.parse($(".pro_cert_crna").val());
        console.log("pro_cert_bls", pro_cert_crna);
        $('.js-example-basic-multiple[data-list-id="crn_data"]').select2().val(pro_cert_crna).trigger('change');
    }

    if ($(".pro_cert_cnm").val() != "") {
        var pro_cert_cnm = JSON.parse($(".pro_cert_cnm").val());
        console.log("pro_cert_bls", pro_cert_cnm);
        $('.js-example-basic-multiple[data-list-id="cnm_data"]').select2().val(pro_cert_cnm).trigger('change');
    }

    if ($(".pro_cert_ons").val() != "") {
        var pro_cert_ons = JSON.parse($(".pro_cert_ons").val());
        console.log("pro_cert_bls", pro_cert_ons);
        $('.js-example-basic-multiple[data-list-id="ons_data"]').select2().val(pro_cert_ons).trigger('change');
    }

    if ($(".pro_cert_msw").val() != "") {
        var pro_cert_msw = JSON.parse($(".pro_cert_msw").val());
        console.log("pro_cert_bls", pro_cert_msw);
        $('.js-example-basic-multiple[data-list-id="msw_data"]').select2().val(pro_cert_msw).trigger('change');
    }

    if ($(".pro_cert_ain").val() != "") {
        var pro_cert_ain = JSON.parse($(".pro_cert_ain").val());
        console.log("pro_cert_bls", pro_cert_ain);
        $('.js-example-basic-multiple[data-list-id="ain_data"]').select2().val(pro_cert_ain).trigger('change');
    }

    if ($(".pro_cert_rpn").val() != "") {
        var pro_cert_rpn = JSON.parse($(".pro_cert_rpn").val());
        console.log("pro_cert_bls", pro_cert_rpn);
        $('.js-example-basic-multiple[data-list-id="rpn_data"]').select2().val(pro_cert_rpn).trigger('change');
    }

    if ($(".pro_cert_nl").val() != "") {
        var pro_cert_nl = JSON.parse($(".pro_cert_nl").val());
        console.log("pro_cert_bls", pro_cert_nl);
        $('.js-example-basic-multiple[data-list-id="nlc_data"]').select2().val(pro_cert_nl).trigger('change');
    }

    if ($(".professional_as").val() != "") {
        var professional_as = JSON.parse($(".professional_as").val());
        console.log("professional_as", professional_as);
        $('.js-example-basic-multiple[data-list-id="des_profession_association"]').select2().val(professional_as).trigger('change');
    }

    $(".surgical_row_data").insertAfter("#specility_level-1");
    $(".specialty_sub_boxes").insertAfter(".surgical_row_data");
    $(".surgicalobs_row").insertAfter("#specility_level-2");
    $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
    $(".paediatric_surgical_div").insertAfter("#specility_level-3");
    $(".neonatal_row").insertAfter("#specility_level-3");
    $(".surgical_rowp_data").insertAfter(".surgicalpad_row_data");

    console.log("nurse_type1", $('#nurse_type').select2("data"));

    var nurse_type_list = $('#nurse_type').select2("data");

    for (var x = 0; x < nurse_type_list.length; x++) {
        $(".nursing_" + nurse_type_list[x].id).removeClass('d-none');
    }

    var nurse_type_list_experience = $('#nurse_type_experience').select2("data");

    for (var x = 0; x < nurse_type_list_experience.length; x++) {
        $(".nursing_experience_" + nurse_type_list_experience[x].id).removeClass('d-none');
    }

    var advancedpractioner_list = $('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2("data");
    console.log("advancedpractioner_list", advancedpractioner_list);
    for (var a = 0; a < advancedpractioner_list.length; a++) {
        if (advancedpractioner_list[a].id == "179") {
            $(".np_submenu").removeClass('d-none');
        }
    }


    var specialties = $('.js-example-basic-multiple[data-list-id="specialties"]').select2("data");

    var adults_list = $('.js-example-basic-multiple[data-list-id="speciality_entry-1"]').select2("data");
    for (var b = 0; b < adults_list.length; b++) {
        if (adults_list[b].id == "96") {
            $(".surgical_row_data").removeClass('d-none');
        }
    }



    for (var y = 0; y < specialties.length; y++) {
        $(".speciality_" + specialties[y].id).removeClass('d-none');
    }

    var maternity_list = $('.js-example-basic-multiple[data-list-id="speciality_entry-2"]').select2("data");

    for (var b = 0; b < maternity_list.length; b++) {
        if (maternity_list[b].id == "233") {
            $(".surgicalobs_row").removeClass('d-none');
        }
    }


    var padneonatal_list = $('.js-example-basic-multiple[data-list-id="speciality_entry-3"]').select2("data");
    for (var c = 0; c < padneonatal_list.length; c++) {
        if (padneonatal_list[c].id == "250") {
            $(".neonatal_row").removeClass('d-none');
        }

        if (padneonatal_list[c].id == "285") {
            $(".surgicalpad_row_data").removeClass('d-none');
        }
    }




    var padneonatalsurgical_list = $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').select2("data");

    for (var l = 0; l < padneonatalsurgical_list.length; l++) {
        $(".surgicalpad_row-" + padneonatalsurgical_list[l].id).removeClass('d-none');
    }






    var surgicalpcare_list = $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2("data");
    console.log("surgicalpcare_list", surgicalpcare_list);
    for (var k = 0; k < surgicalpcare_list.length; k++) {
        $(".surgicalopcboxes-" + surgicalpcare_list[k].id).removeClass('d-none');
    }

    $("#tab-experience").insertAfter("#tab-educert");
    $("#tab-my-profile-setting").insertAfter("#tab-educert");
    $("#tab-mandtraining").insertAfter("#tab-educert");
    $("#tab-interview-references").insertAfter("#tab-educert");
    $("#tab-personal-preferences").insertAfter("#tab-educert");
    $("#tab-work-preferences").insertAfter("#tab-educert");
    $("#tab-addition-information").insertAfter("#tab-educert");
    $("#tab-professional-membership").insertAfter("#tab-educert");
    $("#tab-professional-membership").insertAfter("#tab-educert");
    $("#tab-vaccination").insertAfter("#tab-educert");
    $("#tab-myclearance-jobs").insertAfter("#tab-educert");
    $("#tab-references").insertAfter("#tab-educert");

    var nurse_array = [];
    // $('.js-example-basic-multiple[data-list-id="mandatory_courses"]').on('change', function() {
    //       let selectedValues = $(this).val();
    //       //alert("hello");
    //       var courses_len = $("#mandatory_courses li").length;

    //       $(".mandatory_training_value").each(function(){
    //         console.log("mandatory_training_value",$(this).val());
    //         var training_val = $(this).val();
    //         if(selectedValues.includes(training_val)){
    //           $(".mandatory_courses_div_"+training_val).show();
    //         }else{
    //           $(".mandatory_courses_div_"+training_val).hide();
    //         }
    //       });



    //   });
    // Show corresponding job lists when an option is selected in the first select
    $('.js-example-basic-multiple[data-list-id="type-of-nurse"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var nurse_len = $("#type-of-nurse li").length;
        console.log("nurse_len", nurse_len);

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues", selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        for (var i = 1; i <= nurse_len; i++) {
            var nurse_result_val = $(".nursing_result-" + i).val();
            //alert(nurse_result_val);
            if (selectedValues.includes(nurse_result_val)) {

                $('#nursing_level-' + i).removeClass('d-none');
            } else {
                $('#nursing_level-' + i).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="nursing_entry-' + i + '"]').select2().val(null).trigger('change');
            }
        }

        if (selectedValues.includes("3") == false) {
            $('.np_submenu').addClass('d-none');
            //$('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2().val(null).trigger('change');
            $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(null).trigger('change');
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

    $('.js-example-basic-multiple[data-list-id="type-of-nurse-experience"]').on('change', function() {

        let selectedValues = $(this).val();

        var nurse_len = $("#type-of-nurse-experience li").length;
        console.log("nurse_len", nurse_len);

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues", selectedValues);
        //$('.result--show .form-group').addClass('d-none');

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
    });

    $('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var nurse_len = $("#type-of-nurse li").length;
        console.log("nurse_len", nurse_len);

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
        if (selectedValues.includes("179")) {
            $('.np_submenu').removeClass('d-none');
            console.log("selectedValues", selectedValues);
        } else {
            $('.np_submenu').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(null).trigger('change');
        }



    });

    $('.js-example-basic-multiple[data-list-id="specialties"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_len = $("#specialties li").length;
        console.log("speciality_len", speciality_len);

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues", selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        for (var k = 1; k <= speciality_len; k++) {
            var speciality_result_val = $(".speciality_result-" + k).val();
            //alert(speciality_result_val);
            if (selectedValues.includes(speciality_result_val)) {

                $('#specility_level-' + k).removeClass('d-none');
                //$(".sub_speciality_value").val(k);

            } else {
                $('#specility_level-' + k).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="speciality_entry-' + k + '"]').select2().val(null).trigger('change');
            }
        }

        if (selectedValues.includes("1") == false) {
            $('.surgical_row').addClass('d-none');
            $('.surgical_row_data').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
        }
        if (selectedValues.includes("2") == false) {

            $('.surgicalobs_row').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
        }

        if (selectedValues.includes("3") == false) {

            $('.surgicalpad_row_data').addClass('d-none');
            $('.surgical_rowp_data').addClass('d-none');
            $('.neonatal_row').addClass('d-none');
            //$('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
        }


    });

    $('.js-example-basic-multiple[data-list-id="specialties_experience"]').on('change', function() {
        let selectedValues = $(this).val();
        var speciality_len = $("#specialties_experience li").length;
        console.log("speciality_len", speciality_len);

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues", selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        for (var k = 1; k <= speciality_len; k++) {
            var speciality_result_val = $(".speciality_result_experience-" + k).val();
            //alert(speciality_result_val);
            if (selectedValues.includes(speciality_result_val)) {

                $('#specility_level_experience-' + k).removeClass('d-none');
                //$(".sub_speciality_value").val(k);
                console.log('1');
            } else {
                console.log('2');
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
            console.log('5');
            $('.surgicalpad_row_data_experience').addClass('d-none');
            $('.surgical_rowp_data_experience').addClass('d-none');
            $('.neonatal_row_experience').addClass('d-none');
            //$('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
        }


    });

    $('.js-example-basic-multiple[data-list-id="nursing_entry_experience-3"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var nurse_len = $("#type-of-nurse li").length;
        console.log("nurse_len", nurse_len);

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
        if (selectedValues.includes("179")) {
            $('.np_submenu_experience').removeClass('d-none');
            console.log("selectedValues", selectedValues);
        } else {
            $('.np_submenu_experience').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu_experience"]').select2().val(null).trigger('change');
        }



    });

    var sub_specialty_data_val = $(".sub_speciality_value").val();
    console.log("specialty_data_len", sub_specialty_data_val);

    $('.js-example-basic-multiple[data-list-id="speciality_entry-1"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#speciality_entry-1 li").length;
        console.log("speciality_entry", speciality_entry);
        // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
        $(".surgical_row_data").insertAfter("#specility_level-1");
        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues", selectedValues.includes("96"));
        //$('.result--show .form-group').addClass('d-none');

        if (selectedValues.includes("96")) {
            $('.surgical_row_data').removeClass('d-none');
        } else {
            $('.surgical_row_data').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
        }

        if (selectedValues.includes("96") == false) {
            $('.surgical_row').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
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

    $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-1"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#speciality_entry_experience-1 li").length;
        console.log("speciality_entry", speciality_entry);
        // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
        $(".surgical_row_data_experience").insertAfter("#specility_level_experience-1");
        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues", selectedValues.includes("96"));
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
        console.log("speciality_entry", speciality_entry);
        // $(".surgicalobs_row").wrapAll("<div class='col-md-12 row surgicalobs_row_data'>");
        $(".surgicalobs_row_experience").insertAfter("#specility_level_experience-2");

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues", selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        if (selectedValues.includes("233")) {
            $('.surgicalobs_row_experience').removeClass('d-none');
        } else {
            $('.surgicalobs_row_experience').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="surgicalobs_row_data_experience"]').select2().val(null).trigger('change');
        }
    });

    $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#surgical_row_box li").length;
        console.log("speciality_entry", speciality_entry);
        // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
        $(".specialty_sub_boxes").insertAfter(".surgical_row_data");
        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues", selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        // if(selectedValues.includes("97")){
        //     $('.surgical_row').removeClass('d-none');
        // }else{
        //     $('.surgical_row').addClass('d-none');
        // }



        for (var k = 1; k <= speciality_entry; k++) {
            var speciality_result_val = $(".speciality_surgical_result-" + k).val();

            if (selectedValues.includes(speciality_result_val)) {

                $('.surgical_row-' + k).removeClass('d-none');

            } else {
                $('.surgical_row-' + k).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgical_operative_care-' + k + '"]').select2().val(null).trigger('change');
            }
        }
    });

    $('.js-example-basic-multiple[data-list-id="surgical_row_box_experience"]').on('change', function() {

        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#surgical_row_box_experience li").length;
        console.log("speciality_entry", speciality_entry);
        // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
        $(".specialty_sub_boxes_experience").insertAfter(".surgical_row_data_experience");
        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues", selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        // if(selectedValues.includes("97")){
        //     $('.surgical_row').removeClass('d-none');
        // }else{
        //     $('.surgical_row').addClass('d-none');
        // }



        for (var k = 1; k <= speciality_entry; k++) {
            var speciality_result_val = $(".speciality_surgical_result_experience-" + k).val();
            console.log("speciality_result_val", speciality_result_val);
            if (selectedValues.includes(speciality_result_val)) {

                $('.surgical_row_experience-' + k).removeClass('d-none');

            } else {
                $('.surgical_row_experience-' + k).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgical_operative_care_experience-' + k + '"]').select2().val(null).trigger('change');
            }
        }
    });

    $('.js-example-basic-multiple[data-list-id="speciality_entry-3"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#speciality_entry-3 li").length;
        console.log("speciality_entry", speciality_entry);
        $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
        $(".paediatric_surgical_div").insertAfter("#specility_level-3");


        //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
        $(".neonatal_row").insertAfter("#specility_level-3");

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues", selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        if (selectedValues.includes('250')) {
            $('.neonatal_row').removeClass('d-none');
        } else {
            $('.neonatal_row').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="neonatal_care"]').select2().val(null).trigger('change');
        }

        if (selectedValues.includes('285')) {
            $('.surgicalpad_row_data').removeClass('d-none');
        } else {
            $('.surgicalpad_row_data').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').select2().val(null).trigger('change');
        }

        if (selectedValues.includes("285") == false) {
            $('.surgical_rowp_data').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
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

    $('.js-example-basic-multiple[data-list-id="speciality_entry_experience-3"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#speciality_entry_experience-3 li").length;
        console.log("speciality_entry", speciality_entry);
        $(".surgical_rowp_experience").wrapAll("<div class='col-md-12 row surgical_rowp_data_experience'>");
        $(".paediatric_surgical_div_experience").insertAfter("#specility_level_experience-3");


        //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
        $(".neonatal_row_experience").insertAfter("#specility_level_experience-3");

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues", selectedValues);
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
            $('.js-example-basic-multiple[data-list-id="surgical_row_box_experience"]').select2().val(null).trigger('change');
        }

    });

    $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#surgical_rowpad_box li").length;
        console.log("speciality_entry", speciality_entry);
        // $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
        $(".surgical_rowp_data").insertAfter(".surgicalpad_row_data");


        //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
        //     $(".neonatal_row_data").insertAfter("#specility_level-3");

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues", selectedValues);
        //$('.result--show .form-group').addClass('d-none');



        for (var k = 1; k <= speciality_entry; k++) {
            var speciality_result_val = $(".surgical_rowp_result-" + k).val();
            //alert(speciality_result_val);
            if (selectedValues.includes(speciality_result_val)) {

                $('.surgical_rowp-' + k).removeClass('d-none');

            } else {
                $('.surgical_rowp-' + k).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-' + k + '"]').select2().val(null).trigger('change');
            }
        }
    });

    $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box_experience"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#surgical_rowpad_box_experience li").length;
        console.log("speciality_entry", speciality_entry);
        // $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
        $(".surgical_rowp_data_experience").insertAfter(".surgicalpad_row_data_experience");


        //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
        //     $(".neonatal_row_data").insertAfter("#specility_level-3");

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues", selectedValues);
        //$('.result--show .form-group').addClass('d-none');



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

    $('.js-example-basic-multiple[data-list-id="speciality_entry-2"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#speciality_entry-1 li").length;
        console.log("speciality_entry", speciality_entry);
        // $(".surgicalobs_row").wrapAll("<div class='col-md-12 row surgicalobs_row_data'>");
        $(".surgicalobs_row").insertAfter("#specility_level-2");

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues", selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        if (selectedValues.includes("233")) {
            $('.surgicalobs_row').removeClass('d-none');
        } else {
            $('.surgicalobs_row').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="surgical_obs_care"]').select2().val(null).trigger('change');
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
    $('.js-example-basic-multiple[data-list-id="profess_cert"]').on('change', function() {
        let selectedValues = $(this).val();

        console.log("selectedValues", selectedValues);
        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
        if (selectedValues.includes("6")) {
            $('.procertdiv').removeClass('d-none');
            $('.license_number_acls').removeClass('d-none');
        } else {
            $('.procertdiv').addClass('d-none');
            $('.license_number_acls').addClass('d-none');
            $('.acls_certification_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="acls_data"]').select2().val(null).trigger('change');
            var user_id = "{{ $user_id }}";
            deleteDatabaseImgs(user_id, "acls_imgs");
        }
        if (selectedValues.includes("7")) {
            $('.procertdivone').removeClass('d-none');
            $('.license_number_bls').removeClass('d-none');
        } else {
            $('.procertdivone').addClass('d-none');
            $('.license_number_bls').addClass('d-none');
            $('.bls_certification_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="bls_data"]').select2().val(null).trigger('change');
            var user_id = "{{ $user_id }}";
            deleteDatabaseImgs(user_id, "bls_imgs");
        }
        if (selectedValues.includes("8")) {
            $('.procertdivtwo').removeClass('d-none');
            $('.license_number_cpr').removeClass('d-none');
        } else {
            $('.procertdivtwo').addClass('d-none');
            $('.license_number_cpr').addClass('d-none');
            $('.cpr_certification_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="cpr_data"]').select2().val(null).trigger('change');
            var user_id = "{{ $user_id }}";
            deleteDatabaseImgs(user_id, "cpr_imgs");
        }
        if (selectedValues.includes("9")) {
            $('.procertdivthree').removeClass('d-none');
            $('.license_number_nrp').removeClass('d-none');

        } else {
            $('.procertdivthree').addClass('d-none');
            $('.license_number_nrp').addClass('d-none');
            $('.nrp_certification_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="nrp_data"]').select2().val(null).trigger('change');
            var user_id = "{{ $user_id }}";
            deleteDatabaseImgs(user_id, "nrp_imgs");

        }
        if (selectedValues.includes("10")) {
            $('.procertdivfour').removeClass('d-none');
            $('.license_number_pals').removeClass('d-none');


        } else {
            $('.procertdivfour').addClass('d-none');
            $('.license_number_pals').addClass('d-none');
            $('.pls_certification_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="pls_data"]').select2().val(null).trigger('change');
            var user_id = "{{ $user_id }}";
            deleteDatabaseImgs(user_id, "pls_imgs");
        }
        if (selectedValues.includes("11")) {
            $('.procertdivfive').removeClass('d-none');
            $('.license_number_rn').removeClass('d-none');

        } else {
            $('.procertdivfive').addClass('d-none');
            $('.license_number_rn').addClass('d-none');
            $('.rn_certification_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="rn_data"]').select2().val(null).trigger('change');
            var user_id = "{{ $user_id }}";
            deleteDatabaseImgs(user_id, "rn_imgs");
        }
        if (selectedValues.includes("12")) {
            $('.procertdivsix').removeClass('d-none');
            $('.license_number_cn').removeClass('d-none');
        } else {

            $('.procertdivsix').addClass('d-none');
            $('.license_number_cn').addClass('d-none');
            $('.cna_certification_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="cn_data"]').select2().val(null).trigger('change');
            var user_id = "{{ $user_id }}";
            deleteDatabaseImgs(user_id, "cn_imgs");
        }

        if (selectedValues.includes("13")) {
            $('.procertdivseven').removeClass('d-none');
            $('.license_number_lpn').removeClass('d-none');

        } else {
            $('.procertdivseven').addClass('d-none');
            $('.license_number_lpn').addClass('d-none');
            $('.lpn_certification_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="lpn_data"]').select2().val(null).trigger('change');
            var user_id = "{{ $user_id }}";
            deleteDatabaseImgs(user_id, "lpn_imgs");
        }
        if (selectedValues.includes("14")) {
            $('.procertdiveight').removeClass('d-none');
            $('.license_number_crn').removeClass('d-none');
        } else {
            $('.procertdiveight').addClass('d-none');
            $('.license_number_crn').addClass('d-none');
            $('.crn_certification_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="crn_data"]').select2().val(null).trigger('change');
            var user_id = "{{ $user_id }}";
            deleteDatabaseImgs(user_id, "crna_imgs");
        }
        if (selectedValues.includes("15")) {
            $('.procertdivnine').removeClass('d-none');
            $('.license_number_cnm').removeClass('d-none');
        } else {
            $('.procertdivnine').addClass('d-none');
            $('.license_number_cnm').addClass('d-none');
            $('.cnm_certification_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="cnm_data"]').select2().val(null).trigger('change');
            var user_id = "{{ $user_id }}";
            deleteDatabaseImgs(user_id, "cnm_imgs");
        }
        if (selectedValues.includes("16")) {
            $('.procertdivten').removeClass('d-none');
            $('.license_number_ons').removeClass('d-none');
        } else {
            $('.procertdivten').addClass('d-none');
            $('.license_number_ons').addClass('d-none');
            $('.ons_certification_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="ons_data"]').select2().val(null).trigger('change');
            var user_id = "{{ $user_id }}";
            deleteDatabaseImgs(user_id, "ons_imgs");
        }
        if (selectedValues.includes("17")) {
            $('.procertdiveleven').removeClass('d-none');
            $('.license_number_msw').removeClass('d-none');
        } else {
            $('.procertdiveleven').addClass('d-none');
            $('.license_number_msw').addClass('d-none');
            $('.msw_certification_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="msw_data"]').select2().val(null).trigger('change');
            var user_id = "{{ $user_id }}";
            deleteDatabaseImgs(user_id, "msw_imgs");
        }
        if (selectedValues.includes("18")) {
            $('.procertdivtwelfth').removeClass('d-none');
            $('.license_number_np').removeClass('d-none');
        } else {
            $('.procertdivtwelfth').addClass('d-none');
            $('.license_number_np').addClass('d-none');
            $('.np_certification_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="np_data"]').select2().val(null).trigger('change');
            var user_id = "{{ $user_id }}";
            deleteDatabaseImgs(user_id, "np_imgs");
        }
        if (selectedValues.includes("19")) {
            $('.procertdivthirteen').removeClass('d-none');
            $('.license_number_ain').removeClass('d-none');
        } else {
            $('.procertdivthirteen').addClass('d-none');
            $('.license_number_ain').addClass('d-none');
            $('.ain_certification_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="ain_data"]').select2().val(null).trigger('change');
            var user_id = "{{ $user_id }}";
            deleteDatabaseImgs(user_id, "ain_imgs");
        }
        if (selectedValues.includes("20")) {
            $('.procertdivfourteen').removeClass('d-none');
            $('.license_number_rpn').removeClass('d-none');
        } else {
            $('.procertdivfourteen').addClass('d-none');
            $('.license_number_rpn').addClass('d-none');
            $('.rpn_certification_div').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="rpn_data"]').select2().val(null).trigger('change');

        }
        if (selectedValues.includes("21")) {
            $('.procertdivfiveteen').removeClass('d-none');
            $('.license_number_nlc').removeClass('d-none');
        } else {
            $('.procertdivfiveteen').addClass('d-none');
            $('.license_number_nlc').addClass('d-none');

            $('.js-example-basic-multiple[data-list-id="nlc_data"]').select2().val(null).trigger('change');
        }



    });
    $('.js-example-basic-multiple[data-list-id="acls_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var acls_certification_array = [];
        $('.acls_certification_div').removeClass('d-none');
        $(".acls_certification_div h6").each(function() {
            var text = $(this).text();
            if (selectedValues.includes(text) == false) {
                let res = text.split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                $(".acls_" + res_one).remove();
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "acls_imgs");
            }
            acls_certification_array.push(text);
        });
        console.log("selectedValues", selectedValues);

        //$(".bls_certification_div").empty();
        for (var i = 0; i < selectedValues.length; i++) {
            var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
            let res = selectedValues[i].split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one", res_one);

            if (acls_certification_array.includes(selectedValues[i]) == false) {

                var user_id = "{{ $user_id }}";
                var img_text = "acls_imgs";
                $(".acls_certification_div").append('<div class="acls_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="aclsnamearr[]" class="bls_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control acls_license_number acls_license_number-' + i + '" type="text" name="acls_license_number[]"><span id="reqaclslicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control aclsexpiry aclsexpiry-' + i + '" type="date" name="acls_expiry[]"><span id="reqaclsexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control acls_upload_certification acls_imgs_' + res_one + ' acls_upload_certification-' + i + '" type="file" name="acls_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><span id="reqaclsuploadvalid-' + i + '" class="reqError text-danger valley"></span><div class="acls_imgs' + res_one + '"></div></div></div></div>');


            }
        }


    });
    $('.js-example-basic-multiple[data-list-id="bls_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var bls_certification_array = [];
        $('.bls_certification_div').removeClass('d-none');
        $(".bls_certification_div h6").each(function() {
            var text = $(this).text();
            if (selectedValues.includes(text) == false) {
                let res = text.split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one2", res_one);

                $(".bls_" + res_one).remove();
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "bls_imgs");
            }
            bls_certification_array.push(text);
        });
        console.log("selectedValues", selectedValues);

        //$(".bls_certification_div").empty();
        for (var i = 0; i < selectedValues.length; i++) {
            var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
            let res = selectedValues[i].split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one", res_one);
            if (bls_certification_array.includes(selectedValues[i]) == false) {
                var user_id = "{{ $user_id }}";
                var img_text = "bls_imgs";

                $(".bls_certification_div").append('<div class="bls_' + res_one + ' cert_div_' + selected_text + '"><h6>' + selectedValues[i] + '</h6><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control bls_license_number bls_license_number-' + i + '" type="text" name="bls_license_number[]"><span id="reqblslicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control blsexpiry blsexpiry-' + i + '" type="date" name="bls_expiry[]"><span id="reqblsexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control bls_upload_certification degree_transcript bls_imgs_' + res_one + ' bls_upload_certification-' + i + '" type="file" name="bls_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="bls_imgs' + res_one + '"></div><span id="reqblsuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');
            }
        }
    });
    $('.js-example-basic-multiple[data-list-id="cpr_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var cpr_certification_array = [];
        $('.cpr_certification_div').removeClass('d-none');
        $(".cpr_certification_div h6").each(function() {
            var text = $(this).text();

            if (selectedValues.includes(text) == false) {
                let res = text.split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                $(".cpr_" + res_one).remove();
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "cpr_imgs")
            }

            cpr_certification_array.push(text);
        });
        console.log("selectedValues", selectedValues);

        //$(".bls_certification_div").empty();
        for (var i = 0; i < selectedValues.length; i++) {
            var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
            let res = selectedValues[i].split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one", res_one);
            if (cpr_certification_array.includes(selectedValues[i]) == false) {
                var user_id = "{{ $user_id }}";
                var img_text = "cpr_imgs";

                $(".cpr_certification_div").append('<div class="cpr_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="cprnamearr[]" class="cpr_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control cpr_license_number cpr_license_number-' + i + '" type="text" name="cpr_license_number[]"><span id="reqcprlicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control cprexpiry cprexpiry-' + i + '" type="date" name="cpr_expiry[]"><span id="reqcprexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript cpr_imgs_' + res_one + ' cpr_upload_certification cpr_upload_certification-' + i + '" type="file" name="cpr_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="cpr_imgs' + res_one + '"></div><span id="reqcpruploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


            }
        }


    });
    $('.js-example-basic-multiple[data-list-id="nrp_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var nrp_certification_array = [];
        $('.nrp_certification_div').removeClass('d-none');
        $(".nrp_certification_div h6").each(function() {
            var text = $(this).text();

            if (selectedValues.includes(text) == false) {
                let res = text.split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                $(".nrp_" + res_one).remove();
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "nrp_imgs");
            }

            nrp_certification_array.push(text);
        });
        console.log("selectedValues", selectedValues);

        //$(".bls_certification_div").empty();
        for (var i = 0; i < selectedValues.length; i++) {
            var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
            let res = selectedValues[i].split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one", res_one);
            if (nrp_certification_array.includes(selectedValues[i]) == false) {
                var user_id = "{{ $user_id }}";
                var img_text = "nrp_imgs";

                $(".nrp_certification_div").append('<div class="nrp_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="nrpnamearr[]" class="cpr_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control nrp_license_number nrp_license_number-' + i + '" type="text" name="nrp_license_number[]"><span id="reqnrplicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control nrpexpiry nrpexpiry-' + i + '" type="date" name="nrp_expiry[]"><span id="reqnrpexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript nrp_imgs_' + res_one + ' nrp_upload_certification nrp_upload_certification-' + i + '" type="file" name="nrp_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="nrp_imgs' + res_one + '"></div><span id="reqnrpuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


            }
        }


    });

    $('.js-example-basic-multiple[data-list-id="pls_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var pls_certification_array = [];
        $('.pls_certification_div').removeClass('d-none');
        $(".pls_certification_div h6").each(function() {
            var text = $(this).text();

            if (selectedValues.includes(text) == false) {
                let res = text.split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                $(".pls_" + res_one).remove();
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "pls_imgs");
            }

            pls_certification_array.push(text);
        });
        console.log("selectedValues", selectedValues);

        //$(".bls_certification_div").empty();
        for (var i = 0; i < selectedValues.length; i++) {
            var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
            let res = selectedValues[i].split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one", res_one);
            if (pls_certification_array.includes(selectedValues[i]) == false) {
                var user_id = "{{ $user_id }}";
                var img_text = "pls_imgs";

                $(".pls_certification_div").append('<div class="pls_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="plsnamearr[]" class="pls_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control pls_license_number pls_license_number-' + i + '" type="text" name="pls_license_number[]"><span id="reqplslicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control plsexpiry plsexpiry-' + i + '" type="date" name="pls_expiry[]"><span id="reqplsexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript pls_imgs_' + res_one + ' pls_upload_certification pls_upload_certification-' + i + '" type="file" name="pls_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="pls_imgs' + res_one + '"></div><span id="reqplsuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


            }
        }


    });
    $('.js-example-basic-multiple[data-list-id="rn_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var rn_certification_array = [];
        $('.rn_certification_div').removeClass('d-none');
        $(".rn_certification_div h6").each(function() {
            var text = $(this).text();

            if (selectedValues.includes(text) == false) {

                let res = text.split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", ".rn_" + res_one);

                $(".rn_" + res_one).remove();
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "rn_imgs");
            }

            rn_certification_array.push(text);
        });
        console.log("selectedValues", selectedValues);

        //$(".bls_certification_div").empty();
        for (var i = 0; i < selectedValues.length; i++) {
            var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
            let res = selectedValues[i].split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one", res_one);

            if (rn_certification_array.includes(selectedValues[i]) == false) {
                var user_id = "{{ $user_id }}";
                var img_text = "rn_imgs";

                $(".rn_certification_div").append('<div class="rn_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="rnnamearr[]" class="rn_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control rn_license_number rn_license_number-' + i + '" type="text" name="rn_license_number[]"><span id="reqrnlicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control rnexpiry rnexpiry-' + i + '" type="date" name="rn_expiry[]"><span id="reqrnexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript rn_imgs_' + res_one + ' rn_upload_certification rn_upload_certification-' + i + '" type="file" name="rn_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="rn_imgs' + res_one + '"></div><span id="reqrnuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


            }
        }


    });
    $('.js-example-basic-multiple[data-list-id="np_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var np_certification_array = [];
        $('.np_certification_div').removeClass('d-none');
        $(".np_certification_div h6").each(function() {
            var text = $(this).text();

            if (selectedValues.includes(text) == false) {
                let res = text.split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                $(".np_" + res_one).remove();
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "np_imgs");
            }

            np_certification_array.push(text);
        });
        console.log("selectedValues", selectedValues);

        //$(".bls_certification_div").empty();
        for (var i = 0; i < selectedValues.length; i++) {
            var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
            let res = selectedValues[i].split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one", res_one);
            if (np_certification_array.includes(selectedValues[i]) == false) {
                var user_id = "{{ $user_id }}";
                var img_text = "np_imgs";

                $(".np_certification_div").append('<div class="np_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="npnamearr[]" class="np_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control np_license_number np_license_number-' + i + '" type="text" name="np_license_number[]"><span id="reqnplicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control npexpiry npexpiry-' + i + '" type="date" name="np_expiry[]"><span id="reqnpexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript np_imgs_' + res_one + ' np_upload_certification np_upload_certification-' + i + '" type="file" name="np_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="np_imgs' + res_one + '"></div><span id="reqnpuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


            }
        }


    });
    $('.js-example-basic-multiple[data-list-id="cn_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var cn_certification_array = [];
        $('.cna_certification_div').removeClass('d-none');
        $(".cna_certification_div h6").each(function() {
            var text = $(this).text();

            if (selectedValues.includes(text) == false) {
                let res = text.split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                $(".cna_" + res_one).remove();
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "cn_imgs");
            }

            cn_certification_array.push(text);
        });
        console.log("selectedValues", selectedValues);

        //$(".bls_certification_div").empty();
        for (var i = 0; i < selectedValues.length; i++) {
            var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
            let res = selectedValues[i].split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one", res_one);
            if (cn_certification_array.includes(selectedValues[i]) == false) {
                var user_id = "{{ $user_id }}";
                var img_text = "cn_imgs";

                $(".cna_certification_div").append('<div class="cn_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="cnnamearr[]" class="cn_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control cn_license_number cn_license_number-' + i + '" type="text" name="cn_license_number[]"><span id="reqcnlicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control cnexpiry cnexpiry-' + i + '" type="date" name="cn_expiry[]"><span id="reqcnexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript cn_imgs_' + res_one + ' cn_upload_certification cn_upload_certification-' + i + '" type="file" name="cn_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="cn_imgs' + res_one + '"></div><span id="reqcnuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


            }
        }


    });
    $('.js-example-basic-multiple[data-list-id="lpn_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var lpn_certification_array = [];
        $('.lpn_certification_div').removeClass('d-none');
        $(".lpn_certification_div h6").each(function() {
            var text = $(this).text();

            if (selectedValues.includes(text) == false) {
                let res = text.split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                $(".lpn_" + res_one).remove();
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "lpn_imgs");
            }

            lpn_certification_array.push(text);
        });
        console.log("selectedValues", selectedValues);

        //$(".bls_certification_div").empty();
        for (var i = 0; i < selectedValues.length; i++) {
            var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
            let res = selectedValues[i].split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one", res_one);
            if (lpn_certification_array.includes(selectedValues[i]) == false) {
                var user_id = "{{ $user_id }}";
                var img_text = "lpn_imgs";

                $(".lpn_certification_div").append('<div class="lpn_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="lpnnamearr[]" class="lpn_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control lpn_license_number lpn_license_number-' + i + '" type="text" name="lpn_license_number[]"><span id="reqlpnlicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control lpnexpiry lpnexpiry-' + i + '" type="date" name="lpn_expiry[]"><span id="reqlpnexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control lpn_upload_certification degree_transcript lpn_imgs_' + res_one + ' lpn_upload_certification-' + i + '" type="file" name="lpn_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="lpn_imgs' + res_one + '"></div><span id="reqlpnuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


            }
        }


    });
    $('.js-example-basic-multiple[data-list-id="crn_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var crna_certification_array = [];
        $('.crna_certification_div').removeClass('d-none');
        $(".crna_certification_div h6").each(function() {
            var text = $(this).text();

            if (selectedValues.includes(text) == false) {
                let res = text.split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                $(".crna_" + res_one).remove();
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "crna_imgs");

            }

            crna_certification_array.push(text);
        });
        console.log("selectedValues", selectedValues);

        //$(".bls_certification_div").empty();
        for (var i = 0; i < selectedValues.length; i++) {
            var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
            let res = selectedValues[i].split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one", res_one);
            if (crna_certification_array.includes(selectedValues[i]) == false) {
                var user_id = "{{ $user_id }}";
                var img_text = "crna_imgs";

                $(".crna_certification_div").append('<div class="crna_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="crnanamearr[]" class="lpn_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control crna_license_number crna_license_number-' + i + '" type="text" name="crna_license_number[]"><span id="reqcrnalicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control crnaexpiry crnaexpiry-' + i + '" type="date" name="crna_expiry[]"><span id="reqcrnaexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript crna_imgs_' + res_one + ' crna_upload_certification crna_upload_certification-' + i + '" type="file" name="crna_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="crna_imgs' + res_one + '"></div><span id="reqcrnauploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


            }
        }


    });

    $('.js-example-basic-multiple[data-list-id="cnm_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var cnm_certification_array = [];
        $('.cnm_certification_div').removeClass('d-none');
        $(".cnm_certification_div h6").each(function() {
            var text = $(this).text();

            if (selectedValues.includes(text) == false) {
                let res = text.split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                $(".cnm_" + res_one).remove();
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "cnm_imgs");
            }

            cnm_certification_array.push(text);
        });
        console.log("selectedValues", selectedValues);

        //$(".bls_certification_div").empty();
        for (var i = 0; i < selectedValues.length; i++) {
            var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
            let res = selectedValues[i].split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one", res_one);
            if (cnm_certification_array.includes(selectedValues[i]) == false) {
                var user_id = "{{ $user_id }}";
                var img_text = "cnm_imgs";

                $(".cnm_certification_div").append('<div class="cnm_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="cnmnamearr[]" class="cnm_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control cnm_license_number cnm_license_number-' + i + '" type="text" name="cnm_license_number[]"><span id="reqcnmlicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control cnmexpiry cnmexpiry-' + i + '" type="date" name="cnm_expiry[]"><span id="reqcnmexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript cnm_imgs_' + res_one + '" type="file" name="cnm_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="cnm_imgs' + res_one + '"></div><span id="reqcnmuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


            }
        }


    });

    $('.js-example-basic-multiple[data-list-id="ons_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var ons_certification_array = [];
        $('.ons_certification_div').removeClass('d-none');
        $(".ons_certification_div h6").each(function() {
            var text = $(this).text();

            if (selectedValues.includes(text) == false) {
                let res = text.split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                $(".ons_" + res_one).remove();
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "ons_imgs");
            }

            ons_certification_array.push(text);
        });
        console.log("selectedValues", selectedValues);

        //$(".bls_certification_div").empty();
        for (var i = 0; i < selectedValues.length; i++) {
            var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
            let res = selectedValues[i].split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one", res_one);
            if (ons_certification_array.includes(selectedValues[i]) == false) {
                var user_id = "{{ $user_id }}";
                var img_text = "ons_imgs";

                $(".ons_certification_div").append('<div class="ons_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="onsnamearr[]" class="ons_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control ons_license_number ons_license_number-' + i + '" type="text" name="ons_license_number[]"><span id="reqonslicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control onsexpiry onsexpiry-' + i + '" type="date" name="ons_expiry[]"><span id="reqonsexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript ons_imgs_' + res_one + '" type="file" name="ons_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="ons_imgs' + res_one + '"></div><span id="reqonsuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


            }
        }


    });

    $('.js-example-basic-multiple[data-list-id="msw_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var msw_certification_array = [];
        $('.msw_certification_div').removeClass('d-none');
        $(".msw_certification_div h6").each(function() {
            var text = $(this).text();

            if (selectedValues.includes(text) == false) {
                let res = text.split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                $(".msw_" + res_one).remove();
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "msw_imgs");
            }

            msw_certification_array.push(text);
        });
        console.log("selectedValues", selectedValues);

        //$(".bls_certification_div").empty();
        for (var i = 0; i < selectedValues.length; i++) {
            var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
            let res = selectedValues[i].split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one", res_one);

            if (msw_certification_array.includes(selectedValues[i]) == false) {
                var user_id = "{{ $user_id }}";
                var img_text = "msw_imgs";

                $(".msw_certification_div").append('<div class="msw_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="mswnamearr[]" class="msw_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control msw_license_number msw_license_number-' + i + '" type="text" name="msw_license_number[]"><span id="reqmswlicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control mswexpiry mswexpiry-' + i + '" type="date" name="msw_expiry[]"><span id="reqmswexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript msw_imgs_' + res_one + ' msw_upload_certification msw_upload_certification-' + i + '" type="file" name="msw_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="msw_imgs' + res_one + '"></div><span id="reqmswuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


            }
        }


    });

    $('.js-example-basic-multiple[data-list-id="ain_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var ain_certification_array = [];
        $('.ain_certification_div').removeClass('d-none');
        $(".ain_certification_div h6").each(function() {
            var text = $(this).text();

            if (selectedValues.includes(text) == false) {
                let res = text.split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                $(".ain_" + res_one).remove();
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "ain_imgs");
            }

            ain_certification_array.push(text);
        });
        console.log("selectedValues", selectedValues);

        //$(".bls_certification_div").empty();
        for (var i = 0; i < selectedValues.length; i++) {
            var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
            let res = selectedValues[i].split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one", res_one);
            if (ain_certification_array.includes(selectedValues[i]) == false) {
                var user_id = "{{ $user_id }}";
                var img_text = "ain_imgs";

                $(".ain_certification_div").append('<div class="ain_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="ainnamearr[]" class="ain_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control ain_license_number ain_license_number-' + i + '" type="text" name="ain_license_number[]"><span id="reqainlicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control ainexpiry ainexpiry-' + i + '" type="date" name="ain_expiry[]"><span id="reqainexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript ain_imgs_' + res_one + ' ain_upload_certification ain_upload_certification-' + i + '" type="file" name="ain_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="ain_imgs' + res_one + '"></div><span id="reqainuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


            }
        }


    });

    $('.js-example-basic-multiple[data-list-id="rpn_data"]').on('change', function() {
        let selectedValues = $(this).val();
        var rpn_certification_array = [];
        $('.rpn_certification_div').removeClass('d-none');
        $(".rpn_certification_div h6").each(function() {
            var text = $(this).text();

            if (selectedValues.includes(text) == false) {
                let res = text.split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                $(".rpn_" + res_one).remove();
                var user_id = "{{ $user_id }}";
                deleteDatabaseImgs(user_id, "rpn_imgs");
            }

            rpn_certification_array.push(text);
        });
        console.log("selectedValues", selectedValues);

        //$(".bls_certification_div").empty();
        for (var i = 0; i < selectedValues.length; i++) {
            var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
            let res = selectedValues[i].split(' ')[0];
            let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
            console.log("res_one", res_one);
            if (rpn_certification_array.includes(selectedValues[i]) == false) {
                var user_id = "{{ $user_id }}";
                var img_text = "rpn_imgs";

                $(".rpn_certification_div").append('<div class="rpn_' + res_one + ' cert_div_' + selected_text + '"><h6 class="cert_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="rpnnamearr[]" class="rpn_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control rpn_license_number rpn_license_number-' + i + '" type="text" name="rpn_license_number[]"><span id="reqrpnlicencevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control rpnexpiry rpnexpiry-' + i + '" type="date" name="rpn_expiry[]"><span id="reqrpnexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript rpn_imgs_' + res_one + ' rpn_upload_certification rpn_upload_certification-' + i + '" type="file" name="rpn_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><div class="rpn_imgs' + res_one + '"></div><span id="reqrpnuploadvalid-' + i + '" class="reqError text-danger valley"></span></div></div></div>');


            }
        }


    });

    $(".change_password_link").click(function() {

        window.history.replaceState(null, null, "?page=change_password");

        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("page");
        console.log(c);

        if (c == "change_password") {
            $(".upload_image").addClass("hide_profile_image");
            $(".profile_update_heading").hide();
            $(".update_profile").hide();
            $(".change_password_div").show();
        }

    });
    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if (c == "change_password") {
        $(".upload_image").addClass("hide_profile_image");
        $(".profile_update_heading").hide();
        $(".update_profile").hide();
        $(".change_password_div").show();
    }

    $("#my_profession").click(function(e) {
        //alert("hello");
        e.stopPropagation();
        // $(".prof-profile .dropdown").addClass("show");
        //   $(".prof-profile .dropdown-menu").addClass("show");
        window.history.replaceState(null, null, "?page=profession");

        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("page");
        console.log(c);

        if (c == "profession") {
            $(".tab-pane").hide();
            $("#tab-my-jobs").css("opacity", "1");
            $("#tab-my-jobs").show();

        }

    });

    $("#my_profile").click(function(e) {
        e.stopPropagation();
        window.history.replaceState(null, null, "?page=my_profile");

        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("page");
        console.log(c);

        if (c == "my_profile") {
            $(".tab-pane").hide();

            $("#tab-my-profile").show();
        }

    });

    $("#settings").click(function(e) {
        e.stopPropagation();
        window.history.replaceState(null, null, "?page=settings");

        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("page");
        console.log(c);

        if (c == "settings") {
            $(".tab-pane").hide();
            $("#tab-my-profile-setting").css("opacity", "1");
            $("#tab-my-profile-setting").show();
        }

    });
    $("#experience_info").click(function(e) {
        e.stopPropagation();
        window.history.replaceState(null, null, "?page=experience_info");

        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("page");
        console.log(c);

        if (c == "experience_info") {
            $(".tab-pane").hide();
            $("#tab-experience").css("opacity", "1");
            $("#tab-experience").show();
        }

    });
    $("#additional_info").click(function(e) {
        e.stopPropagation();
        window.history.replaceState(null, null, "?page=additional_info");

        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("page");
        console.log(c);

        if (c == "additional_info") {
            $(".tab-pane").hide();
            $("#tab-addition-information").css("opacity", "1");
            $("#tab-addition-information").show();
        }

    });
    $("#educert").click(function(e) {
        e.stopPropagation();
        window.history.replaceState(null, null, "?page=educert");

        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("page");
        console.log(c);

        if (c == "educert") {
            $(".tab-pane").hide();
            $("#tab-educert").css("opacity", "1");
            $("#tab-educert").show();
        }

    });

    $("#mand_training").click(function(e) {
        e.stopPropagation();
        window.history.replaceState(null, null, "?page=mandatory_training");

        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("page");
        console.log(c);

        if (c == "mandatory_training") {
            $(".tab-pane").hide();
            $("#tab-mandtraining").css("opacity", "1");
            $("#tab-mandtraining").show();
        }

    });

    $("#reference_info").click(function(e) {
        e.stopPropagation();
        window.history.replaceState(null, null, "?page=reference_info");

        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("page");
        console.log(c);

        if (c == "reference_info") {
            $(".tab-pane").hide();
            $("#tab-references").css("opacity", "1");
            $("#tab-references").show();
        }

    });

    $("#work_clearances").click(function(e) {
        e.stopPropagation();
        window.history.replaceState(null, null, "?page=work_clearances");

        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("page");
        console.log(c);

        if (c == "work_clearances") {
            $(".tab-pane").hide();
            $("#tab-myclearance-jobs").css("opacity", "1");
            $("#tab-myclearance-jobs").show();
        }

    });
    $("#interview_references").click(function(e) {
        e.stopPropagation();
        window.history.replaceState(null, null, "?page=interview_references");

        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("page");
        console.log(c);

        if (c == "interview_references") {

            $(".tab-pane").hide();
            $("#tab-interview-references").css("opacity", "1");
            $("#tab-interview-references").show();
        }

    });

    $("#personal_preferences").click(function(e) {
        e.stopPropagation();
        window.history.replaceState(null, null, "?page=personal_preferences");

        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("page");
        console.log(c);

        if (c == "personal_preferences") {

            $(".tab-pane").hide();
            $("#tab-personal-preferences").css("opacity", "1");
            $("#tab-personal-preferences").show();
        }

    });
    $("#work_preferences").click(function(e) {
        e.stopPropagation();
        window.history.replaceState(null, null, "?page=work_preferences");

        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("page");
        console.log(c);

        if (c == "work_preferences") {

            $(".tab-pane").hide();
            $("#tab-work-preferences").css("opacity", "1");
            $("#tab-work-preferences").show();
        }

    });

    $("#vaccinations").click(function(e) {
        e.stopPropagation();
        window.history.replaceState(null, null, "?page=vaccinations");

        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("page");
        console.log(c);

        if (c == "vaccinations") {

            $(".tab-pane").hide();
            $("#tab-vaccination").css("opacity", "1");
            $("#tab-vaccination").show();
        }

    });

    $("#professional_membership").click(function(e) {
        e.stopPropagation();
        window.history.replaceState(null, null, "?page=professional_membership");

        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("page");
        console.log(c);

        if (c == "professional_membership") {

            $(".tab-pane").hide();
            $("#tab-professional-membership").css("opacity", "1");
            $("#tab-professional-membership").show();
        }

    });

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    console.log(c);

    if (c == "profession") {
        $("#tab-my-profile").hide();
        $("#tab-my-jobs").css("opacity", "1");
        $("#tab-my-jobs").show();
        $(".profile_tabs").removeClass("active");
        $("#my_profession").addClass("active");

        $(".prof-profile .dropdown").addClass("show");
        $(".prof-profile .dropdown-menu").addClass("show");

    }

    if (c == "settings") {
        $(".tab-pane").hide();
        $("#tab-my-profile-setting").css("opacity", "1");
        $("#tab-my-profile-setting").show();
        $(".profile_tabs").removeClass("active");
        $("#settings").addClass("active");
        $(".prof-profile .dropdown").addClass("show");
        $(".prof-profile .dropdown-menu").addClass("show");
    }

    if (c == "my_profile") {
        $(".tab-pane").hide();
        $("#tab-my-profile").css("opacity", "1");
        $("#tab-my-profile").show();
        $(".profile_tabs").removeClass("active");
        $("#my_profile").addClass("active");
        $(".prof-profile .dropdown").addClass("show");
        $(".prof-profile .dropdown-menu").addClass("show");
    }

    if (c == "educert") {
        $(".tab-pane").hide();
        $("#tab-educert").css("opacity", "1");
        $("#tab-educert").show();
        $(".profile_tabs").removeClass("active");
        $("#educert").addClass("active");
        $(".prof-profile .dropdown").addClass("show");
        $(".prof-profile .dropdown-menu").addClass("show");
    }

    if (c == "experience_info") {
        $(".tab-pane").hide();
        $("#tab-experience").css("opacity", "1");
        $("#tab-experience").show();
        $(".profile_tabs").removeClass("active");
        $("#experience_info").addClass("active");
        $(".prof-profile .dropdown").addClass("show");
        $(".prof-profile .dropdown-menu").addClass("show");
    }

    if (c == "mandatory_training") {
        $(".tab-pane").hide();
        $("#tab-mandtraining").css("opacity", "1");
        $("#tab-mandtraining").show();
        $(".profile_tabs").removeClass("active");
        $("#mand_training").addClass("active");
        $(".prof-profile .dropdown").addClass("show");
        $(".prof-profile .dropdown-menu").addClass("show");
    }

    if (c == "reference_info") {
        $(".tab-pane").hide();
        $("#tab-references").css("opacity", "1");
        $("#tab-references").show();
        $(".profile_tabs").removeClass("active");
        $("#reference_info").addClass("active");
    }

    if (c == "work_clearances") {
        $(".tab-pane").hide();
        $("#tab-myclearance-jobs").css("opacity", "1");
        $("#tab-myclearance-jobs").show();
        $(".profile_tabs").removeClass("active");
        $("#work_clearances").addClass("active");
    }

    if (c == "interview_references") {
        $(".tab-pane").hide();
        $("#tab-interview-references").css("opacity", "1");
        $("#tab-interview-references").show();
        $(".profile_tabs").removeClass("active");
        $("#interview_references").addClass("active");
    }

    if (c == "personal_preferences") {

        $(".tab-pane").hide();
        $("#tab-personal-preferences").css("opacity", "1");
        $("#tab-personal-preferences").show();
        $(".profile_tabs").removeClass("active");
        $("#personal_preferences").addClass("active");
        $(".preferences-profile .dropdown").addClass("show");
        $(".preferences-profile .dropdown-menu").addClass("show");

    }

    if (c == "work_preferences") {

        $(".tab-pane").hide();
        $("#tab-work-preferences").css("opacity", "1");
        $("#tab-work-preferences").show();
        $(".profile_tabs").removeClass("active");
        $("#work_preferences").addClass("active");
        $(".preferences-profile .dropdown").addClass("show");
        $(".preferences-profile .dropdown-menu").addClass("show");
    }

    if (c == "vaccinations") {

        $(".tab-pane").hide();
        $("#tab-vaccination").css("opacity", "1");
        $("#tab-vaccination").show();
        $(".profile_tabs").removeClass("active");
        $("#vaccinations").addClass("active");
        $(".prof-profile .dropdown").addClass("show");
        $(".prof-profile .dropdown-menu").addClass("show");
    }

    if (c == "additional_info") {
        $(".tab-pane").hide();
        $("#tab-addition-information").css("opacity", "1");
        $("#tab-addition-information").show();
        $(".profile_tabs").removeClass("active");
        $("#additional_info").addClass("active");

    }

    if (c == "professional_membership") {

        $(".tab-pane").hide();
        $("#tab-professional-membership").css("opacity", "1");
        $("#tab-professional-membership").show();
        $(".profile_tabs").removeClass("active");
        $("#professional_membership").addClass("active");

    }

    var phoneInputID = "#contactI_emergency";
    var input = document.querySelector(phoneInputID);
    var iti = window.intlTelInput(input, {
        // allowDropdown: false,
        // autoHideDialCode: false,
        // autoPlaceholder: "off",
        // dropdownContainer: document.body,
        // excludeCountries: ["us"],
        formatOnDisplay: false,
        // geoIpLookup: function(callback) {
        //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        hiddenInput: "full_number",
        initialCountry: "{{ Auth::guard('nurse_middle')->user()->emergency_country_iso }}",
        // localizedCountries: { 'de': 'Deutschland' },
        // nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        preferredCountries: ['AU'],
        // separateDialCode: true,
        utilsScript: ""
    });

    $(phoneInputID).on("countrychange", function(event) {

        // Get the selected country data to know which country is selected.
        var selectedCountryData = iti.getSelectedCountryData();
        console.log("selectedCountryData", selectedCountryData.dialCode);
        $("#emergency_countryCode").val(selectedCountryData.dialCode);
        $("#emergency_country_iso").val(selectedCountryData.iso2);
        //alert($("#contactI").intlTelInput("getSelectedCountryData").dialCode);
        // Get an example number for the selected country to use as placeholder.
        // newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),

        //   // Reset the phone number input.
        //   iti.setNumber("");

        // // Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
        // mask = newPlaceholder.replace(/[1-9]/g, "0");

        // // Apply the new mask for the input
        // $(this).mask(mask);
    });


    // When the plugin loads for the first time, we have to trigger the "countrychange" event manually, 
    // but after making sure that the plugin is fully loaded by associating handler to the promise of the 
    // plugin instance.

    iti.promise.then(function() {
        $(phoneInputID).trigger("countrychange");
    });

    var phoneInputID1 = "#contactI";
    var input1 = document.querySelector(phoneInputID1);
    var iti1 = window.intlTelInput(input1, {
        // // allowDropdown: false,
        autoHideDialCode: false,
        // // autoPlaceholder: "off",
        // // dropdownContainer: document.body,
        // // excludeCountries: ["us"],
        formatOnDisplay: false,
        // // geoIpLookup: function(callback) {
        //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        // hiddenInput: "full_number",
        initialCountry: "{{ Auth::guard('nurse_middle')->user()->country_iso }}",
        // // localizedCountries: { 'de': 'Deutschland' },
        nationalMode: false,
        // // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // // placeholderNumberType: "MOBILE",
        // preferredCountries: ['AU'],
        //separateDialCode: true,
        // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
    });

    $(phoneInputID1).on("countrychange", function(event) {

        // Get the selected country data to know which country is selected.
        var selectedCountryData = iti1.getSelectedCountryData();
        console.log("selectedCountryData", selectedCountryData.dialCode);
        $("#countryCode").val(selectedCountryData.dialCode);
        $("#country_iso").val(selectedCountryData.iso2);
        //alert($("#contactI").intlTelInput("getSelectedCountryData").dialCode);
        // Get an example number for the selected country to use as placeholder.
        // newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),

        //   // Reset the phone number input.
        //   iti.setNumber("");

        // // Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
        // mask = newPlaceholder.replace(/[1-9]/g, "0");

        // // Apply the new mask for the input
        // $(this).mask(mask);
    });


    // When the plugin loads for the first time, we have to trigger the "countrychange" event manually, 
    // but after making sure that the plugin is fully loaded by associating handler to the promise of the 
    // plugin instance.

    iti1.promise.then(function() {
        $(phoneInputID1).trigger("countrychange");
    });

    var phoneInputID2 = "#reference_contactI";
    var input2 = document.querySelector(phoneInputID2);
    var iti2 = window.intlTelInput(input2, {
        // allowDropdown: false,
        // autoHideDialCode: false,
        // autoPlaceholder: "off",
        // dropdownContainer: document.body,
        // excludeCountries: ["us"],
        formatOnDisplay: false,
        // geoIpLookup: function(callback) {
        //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        hiddenInput: "full_number",
        initialCountry: "<?php echo $country_iso; ?>",
        // localizedCountries: { 'de': 'Deutschland' },
        // nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        preferredCountries: ['AU'],
        // separateDialCode: true,
        utilsScript: ""
    });

    $(phoneInputID2).on("countrychange", function(event) {

        // Get the selected country data to know which country is selected.
        var selectedCountryData = iti2.getSelectedCountryData();
        console.log("selectedCountryData", selectedCountryData.dialCode);
        $("#reference_countryCode").val(selectedCountryData.dialCode);
        $("#reference_countryiso").val(selectedCountryData.iso2);
        //alert($("#contactI").intlTelInput("getSelectedCountryData").dialCode);
        // Get an example number for the selected country to use as placeholder.
        // newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),

        //   // Reset the phone number input.
        //   iti.setNumber("");

        // // Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
        // mask = newPlaceholder.replace(/[1-9]/g, "0");

        // // Apply the new mask for the input
        // $(this).mask(mask);
    });


    // When the plugin loads for the first time, we have to trigger the "countrychange" event manually, 
    // but after making sure that the plugin is fully loaded by associating handler to the promise of the 
    // plugin instance.

    iti2.promise.then(function() {
        $(phoneInputID2).trigger("countrychange");
    });



    $(document).ready(function() {
        $('#specialtyId').change(function() {
            var specialtyId = $(this).val();
            if (specialtyId !== '') {
                // Show the subspecialty select input group

                // Fetch the subspecialties based on the selected specialty
                $.ajax({
                    url: '{{ route("nurse.fetch-subspecialty")}}',
                    method: 'GET',
                    data: {
                        specialty_id: specialtyId
                    },
                    success: function(response) {
                        // Clear existing options
                        $('#subspecialtyId').empty();
                        // Check if there are subspecialties available
                        if (response.subspecialty.length > 0) {
                            // If there are subspecialties available, show the subspecialty select input group
                            $('#subspecialtyGroup').show();
                            // Add new options
                            $.each(response.subspecialty, function(index, subspecialty) {
                                $('#subspecialtyId').append('<option value="' + subspecialty.id + '">' + subspecialty.name + '</option>');
                            });
                        } else {
                            // If no subspecialties are available, hide the subspecialty select input group
                            $('#subspecialtyGroup').hide();
                        }

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                // If no specialty is selected, hide the subspecialty select input group

                // Clear options of subspecialty select input
                $('#subspecialtyId').empty();

                // Hide the subspecialty select input group
                $('#subspecialtyGroup').hide();
            }
        });
    });
    $(document).ready(function() {
        $('#residencyId').change(function() {
            var residencyId = $(this).val();
            $('#passport_detail_date').hide();
            $('#passport_detail').hide();
            if (residencyId !== 'Citizen') {
                if (residencyId == 'Visa Holder') {
                    $('#passport_detail_date').show();
                }
                $('#passport_detail').show();

            }
        });
    });
</script>
<script>
    function do_police_check() {

        event.preventDefault();

        $(".valley").html("");

        $('.submit-btn-120').prop('disabled', true);

        $('.submit-btn-1').show();

        $('.resetpassword').hide();

        var returnValue;

        var date_acquiredI = document.getElementById("date_acquiredI").value;
        var image_support_document_policeI = document.getElementById("image_support_document_policeI").value;

        var checkbox = document.getElementById('confirmationCheckboxPoliceCheck');


        returnValue = true;

        if (date_acquiredI.trim() == "") {

            document.getElementById("reqTxtdate_acquiredI").innerHTML = "* Please Select  the date of  Acquired.";

            returnValue = false;

        }

        if (image_support_document_policeI.trim() == "") {

            document.getElementById("reqTxtimage_support_documentI").innerHTML = "* Please Upload the Police Check File.";

            returnValue = false;

        }

        if (!checkbox.checked) {
            alert('Please confirm your action.');
            document.getElementById("reqTxtconfirmationCheckboxPoliceCheckI").innerHTML = "Required field: Confirmation required.";

            returnValue = false;
        }

        if (returnValue == false) {

            $('.submit-btn-120').prop('disabled', false);

            $('.submit-btn-1').hide();

            $('.resetpassword').show();

        }



        if (returnValue == true) {

            let formData = new FormData($('#multi-step-form-police-check')[0]);



            $.ajax({

                type: 'POST',

                url: "{{route('nurse.update-profession-user-police-check')}}",

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

                        // $('#multi-step-form-police-check')[0].reset();



                        Swal.fire({

                            icon: 'success',

                            title: 'Successfully!',

                            text: resp.message,

                        }).then(function() {

                            window.location = resp.url;

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



    }

    function do_children_check() {

        event.preventDefault();

        $(".valley").html("");

        $('.submit-btn-120').prop('disabled', true);

        $('.submit-btn-1').show();

        $('.resetpassword').hide();

        var returnValue;

        var clearance_numberI = document.getElementById("clearance_numberI").value;
        var clearancestateI = document.getElementById("clearancestateI").value;
        var clearance_expiry_dataI = document.getElementById("clearance_expiry_dataI").value;

        returnValue = true;

        if (clearance_numberI.trim() == "") {

            document.getElementById("reqTxtclearance_numberI").innerHTML = "* Please Enter the Clearance Number.";

            returnValue = false;

        }

        if (clearancestateI.trim() == "") {

            document.getElementById("reqTxtclearancestateI").innerHTML = "* Please Select  the state.";

            returnValue = false;

        }
        if (clearance_expiry_dataI.trim() == "") {

            document.getElementById("reqTxtclearance_expiry_dataI").innerHTML = "* Please Select the Expiry Date.";

            returnValue = false;


        }


        if (returnValue == false) {

            $('.submit-btn-120').prop('disabled', false);

            $('.submit-btn-1').hide();

            $('.resetpassword').show();

        }



        if (returnValue == true) {

            let formData = new FormData($('#multi-step-form-children')[0]);



            $.ajax({

                type: 'POST',

                url: "{{route('nurse.update-profession-user-children')}}",

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

                        // $('#multi-step-form-children')[0].reset();



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



    }

    function doeligibility_to_work() {

        event.preventDefault();

        $(".valley").html("");

        $('.submit-btn-120').prop('disabled', true);

        $('.submit-btn-1').show();

        $('.resetpassword').hide();

        var returnValue;

        var residencyId = document.getElementById("residencyId").value;
        var image_support_documentI = document.getElementById("image_support_documentI").value;

        var visa_subclass_numberI = document.getElementById("visa_subclass_numberI").value;
        var passport_numberI = document.getElementById("passport_numberI").value;
        var passportcountryI = document.getElementById("passportcountryI").value;
        var visa_grant_numberI = document.getElementById("visa_grant_numberI").value;

        var expiry_dataI = document.getElementById("expiry_dataI").value;

        returnValue = true;

        if (residencyId.trim() == "") {

            document.getElementById("reqTxtresidencyId").innerHTML = "* Please Select the Residency.";

            returnValue = false;

        }
        if (residencyId.trim() != 'Citizen') {
            if (visa_subclass_numberI.trim() == "") {

                document.getElementById("reqTxtvisa_subclass_numberId").innerHTML = "* Please Enter  the Subclass Number.";

                returnValue = false;

            }
            if (passport_numberI.trim() == "") {

                document.getElementById("reqTxtpassport_numberI").innerHTML = "* Please Enter  the Passport Number .";

                returnValue = false;

            }
            if (passportcountryI.trim() == "") {

                document.getElementById("reqTxtpassportcountryI").innerHTML = "* Please Select the Passport Country .";

                returnValue = false;

            }
            if (visa_grant_numberI.trim() == "") {

                document.getElementById("reqTxtvisa_grant_number").innerHTML = "* Please Enter  the Passport Number .";

                returnValue = false;

            }
            if (residencyId.trim() == 'Visa Holder') {

                if (expiry_dataI.trim() == "") {

                    document.getElementById("reqTxtexpiry_dataI").innerHTML = "* Please Select the Expiry Date.";

                    returnValue = false;

                }
            }

        }



        if (image_support_documentI.trim() == "") {

            document.getElementById("reqasupport_document").innerHTML = "* Please Upload the Support Document.";

            returnValue = false;

        }

        if (returnValue == false) {

            $('.submit-btn-120').prop('disabled', false);

            $('.submit-btn-1').hide();

            $('.resetpassword').show();

        }



        if (returnValue == true) {

            let formData = new FormData($('#multi-step-form-eligibility')[0]);



            $.ajax({

                type: 'POST',

                url: "{{route('nurse.update-profession-user-eligibility')}}",

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

                        $('#multi-step-form-eligibility')[0].reset();



                        Swal.fire({

                            icon: 'success',

                            title: 'Successfully!',

                            text: resp.message,

                        }).then(function() {

                            window.location = resp.url;

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



    }

    function doprofessionregistration() {

        event.preventDefault();

        $(".valley").html("");

        $('.submit-btn-120').prop('disabled', true);

        $('.submit-btn-1').show();

        $('.resetpassword').hide();

        var returnValue;

        var ahpra_numberI = document.getElementById("ahpra_numberI").value;

        returnValue = true;

        if (ahpra_numberI.trim() == "") {

            document.getElementById("reqTxtahpra_numberI").innerHTML = "* Please Enter the AHPRA Registration number.";

            returnValue = false;

        }

        if (returnValue == false) {

            $('.submit-btn-120').prop('disabled', false);

            $('.submit-btn-1').hide();

            $('.resetpassword').show();

        }



        if (returnValue == true) {

            let formData = new FormData($('#multi-step-form-registration')[0]);



            $.ajax({

                type: 'POST',

                url: "{{route('nurse.update-profession-user-ahpra_numberI')}}",

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

                        $('#multi-step-form-registration')[0].reset();



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

    function doprofession() {

        event.preventDefault();

        $(".valley").html("");

        $('.submit-btn-120').prop('disabled', true);

        $('.submit-btn-1').show();

        $('.resetpassword').hide();

        var returnValue;

        var specialtyId = document.getElementById("specialtyId").value;
        var subspecialtyId = document.getElementById("subspecialtyId").value;
        var assistent_level = document.getElementById("assistent_level").value;
        var evidence_type = document.getElementById("evidence_type").value;
        var image_evidenceI = document.getElementById("image_evidenceI").value;





        returnValue = true;

        if (specialtyId.trim() == "") {

            document.getElementById("reqTxtspecialtyId").innerHTML = "* Please Select Profession.";

            returnValue = false;

        }
        if (subspecialtyId.trim() == "") {

            document.getElementById("reqsubspecialtyId").innerHTML = "* Please Select Practitioner Type  .";

            returnValue = false;

        }
        if (assistent_level.trim() == "") {

            document.getElementById("reqassistent_level").innerHTML = "* Please Select the Year Level.";

            returnValue = false;

        }
        if (evidence_type.trim() == "") {

            document.getElementById("reqevidence_type").innerHTML = "* Please Select the Evidence Type.";

            returnValue = false;

        }

        if (image_evidenceI.trim() == "") {
            document.getElementById("reqaimage_evidence").textContent = "* Please Upload the Evidence of year level.";
            returnValue = false;
        }

        if (returnValue == false) {

            $('.submit-btn-120').prop('disabled', false);

            $('.submit-btn-1').hide();

            $('.resetpassword').show();

        }



        if (returnValue == true) {

            let formData = new FormData($('#multi-step-form')[0]);



            $.ajax({

                type: 'POST',

                url: "{{route('nurse.update-profession')}}",

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

                        $('#multi-step-form')[0].reset();



                        Swal.fire({

                            icon: 'success',

                            title: 'Successfully!',

                            text: resp.message,

                        }).then(function() {

                            window.location = resp.url;

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



    }

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
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_csTJjYCU5V2Fk4jE4XSqgsc3T-FrtVU&callback=initAutocomplete&libraries=places&v=weekly"
    defer></script>
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
    //   let autocomplete;
    // let address1Field;
    // let address2Field;
    // let postalField;

    // function initAutocomplete() {
    //   address1Field = document.querySelector("#home_address");
    //   address2Field = document.querySelector("#address2");
    //   postalField = document.querySelector("#postcode");
    //   // Create the autocomplete object, restricting the search predictions to
    //   // addresses in the US and Canada.
    //   autocomplete = new google.maps.places.Autocomplete(address1Field, {

    //     types: ["address"],
    //   });
    //   address1Field.focus();
    //   // When the user selects an address from the drop-down, populate the
    //   // address fields in the form.
    //   autocomplete.addListener("place_changed", fillInAddress);
    // }

    // function fillInAddress() {
    //   // Get the place details from the autocomplete object.
    //   const place = autocomplete.getPlace();
    //   let address1 = "";
    //   let postcode = "";

    //   // Get each component of the address from the place details,
    //   // and then fill-in the corresponding field on the form.
    //   // place.address_components are google.maps.GeocoderAddressComponent objects
    //   // which are documented at http://goo.gle/3l5i5Mr
    //   for (const component of place.address_components) {
    //     // @ts-ignore remove once typings fixed
    //     const componentType = component.types[0];

    //     switch (componentType) {
    //       case "street_number": {
    //         address1 = `${component.long_name} ${address1}`;
    //         break;
    //       }

    //       case "route": {
    //         address1 += component.short_name;
    //         break;
    //       }

    //       case "postal_code": {
    //         postcode = `${component.long_name}${postcode}`;
    //         break;
    //       }

    //       case "postal_code_suffix": {
    //         postcode = `${postcode}-${component.long_name}`;
    //         break;
    //       }
    //       case "locality":
    //         document.querySelector("#locality").value = component.long_name;
    //         break;
    //       case "administrative_area_level_1": {
    //         document.querySelector("#state").value = component.short_name;
    //         break;
    //       }
    //       case "country":
    //         document.querySelector("#country").value = component.long_name;
    //         break;
    //     }
    //   }

    //   address1Field.value = address1;
    //   postalField.value = postcode;
    //   // After filling the form with address components from the Autocomplete
    //   // prediction, set cursor focus on the second address line to encourage
    //   // entry of subpremise information such as apartment, unit, or floor number.
    //   address2Field.focus();
    // }

    // window.initAutocomplete = initAutocomplete;
</script>

@endsection