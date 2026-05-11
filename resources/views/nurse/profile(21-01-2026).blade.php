@extends('nurse.layouts.layout')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ url('/public') }}/nurse/assets/css/jquery.ui.datepicker.monthyearpicker.css">
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

<style type="text/css">
.profession-table-ui {
    padding-left: 0px !important;
    line-height: 23px !important;
    font-size: 15px !important;
    color: #212529 !important;
    list-style: disc !important;
    position: relative !important;
    /* z-index: 2 !important; */
    list-style: none !important;
    text-align: left !important;
    padding: 0 !important;
    margin: 0 0 0 -1px !important;
    box-shadow: 0px 0px 0px rgb(0 0 0 / 20%) !important;
    background-color: #ffffff00 !important;
    border: 0px solid #ccc !important;
    white-space: nowrap !important;
    max-height: 200px !important;
    overflow-y: hidden !important;
    width: 185px !important;
    overflow-x: hidden !important;
    white-space: normal !important;
}
  .disabled-link {
      pointer-events: none;       /* Prevent clicking */
      opacity: 0.5;              /* Dimmed look */
      cursor: not-allowed;
    }

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

  form#reference_form ul.select2-selection__rendered {
    box-shadow: none;
    max-height: inherit;
    border: none;
    position: relative;
  }

  .professional_temporary .select2-selection__arrow b,.professional_permanent .select2-selection__arrow b,
  .exp_permanent .select2-selection__arrow b,.exp_temporary .select2-selection__arrow b, .exp_permanent .select2-selection__arrow b,.professional_employee_status .select2-selection__arrow b{
    margin-top: 0px !important;
  }

  .support-button {
    background-color: #000000;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    margin-left: 10px;
  }
  
  
  .support-button:hover {
    background-color: #000000;
    color:white;
    transform: translateY(-1px);
  }

  span.d-flex.align-items-center.justify-content-center {
    font-size: 13px;
    gap: 15px;
  }

  @media only screen and (min-width:1050px) and (max-width:1350px)  {
   
    .support-button {
    background-color: #000000;
    color: white;
    border: none;
    padding: 10px 8px;
    border-radius: 20px;
    font-size: 13px !important;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    margin-left: 10px;
}

.logout-line .font-md {
    font-size: 13px !important;
    line-height: 24px !important;
}

  }

.custom-select-wrapper select{
    padding: 5px;
    border: 1px solid #dddddd;
    height: 50px;
  }

.info { display:inline-block; width:22px; height:22px; text-align:center; line-height:16px; cursor:help; font-size:12px; margin-left:5px; }
  .tooltip_speciality_status {
    display: none;
    position: absolute;
    top: 22px; /* adjust */
    left: 0;   /* show exactly below icon/label */
    background: white;
    padding: 8px;
    border: 1px solid #ccc;
    z-index: 9999 !important;
    border-radius: 6px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    max-height: 200px;
    overflow-y: hidden !important;
    width: 516px !important;
    overflow-x: hidden !important;
  }
  .profession-row {
        display: none;
    }
    .profession-row.show {
        display: table-row;
    }
    
    .profession-onboard-banner {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  background: #f0f6ff;
  border-left: 4px solid #3b82f6;
  padding: 14px 16px;
  border-radius: 6px;
  margin-bottom: 20px;
  font-size: 14px;
  position: relative;
}

.banner-icon {
  font-size: 20px;
  line-height: 1;
}

.banner-content p {
  margin: 6px 0 8px;
}

.banner-content ol {
  margin: 0;
  list-style-type: disc;
  padding-left: 18px;
}

.banner-content li {
  margin-bottom: 4px;
}

.banner-close {
  position: absolute;
  top: 8px;
  right: 10px;
  border: none;
  background: none;
  font-size: 16px;
  cursor: pointer;
  color: #555;
}

p.highlight-text {
    background-color: yellow;
}
.status-pill {
        padding: 4px 28px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        color: #fff;
        display: inline-block;
        white-space: nowrap;
    }

    .status-verified   { background-color: #16a34a; color: white; }
    .status-in-review  { background-color: #ffe605; color: black; }
    .status-pending    { background-color: #f97316; }
    .status-not-started{ background-color: #9ca3af; }
    .status-incomplete { background-color: #dc2626; }
    .status-submitted  { background-color: #2563eb; }
    .status-expired    { background-color: #4b5563; }

    .status-dropdown {
        border: 1px solid #f1f1f1;
        border-radius: 4px;
        background-color: #ffffff;
        width: 100%;
        color: #a0abb8;
    }

    ul.select2-selection__rendered {
    border: 0px !important;
        background: none;
    box-shadow: none;
}
.iti input, .iti input[type=text], .iti input[type=tel] {
    padding-left: 80px !important;
}

</style>
@endsection

@section('content')
<main class="main">
  <section class="section-box mt-0">
    <div class="">
      <div class="row m-0 profile-wrapper">
        <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">
          <!--<div id="preloader-active" style="display:none;"> <div class="preloader d-flex align-items-center justify-content-center"> <div class="preloader-inner position-relative"> <div class="text-center"><img src="https://nextjs.webwiders.in/mediqa/public/nurse/assets/imgs/template/loading.gif" alt="jobBox"></div> </div> </div> </div>-->
          <div class="sidebar_profile">
            <div class="box-company-profile">
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
              @php
              $user = Auth::guard('nurse_middle')->user();

              $registrations = \DB::table('registration_profiles_countries')
                  ->where('user_id', $user->id)
           
                  ->orderBy('created_at')
                  ->get();
              @endphp
             @php
              $statusMap = [
                  1 => ['label' => 'Not Started', 'class' => 'status-not-started'],
                  2 => ['label' => 'Pending', 'class' => 'status-pending'],
                  3 => ['label' => 'Submitted', 'class' => 'status-submitted'],
                  4 => ['label' => 'In Review', 'class' => 'status-in-review'],
                  5 => ['label' => 'Verified', 'class' => 'status-verified'],
                  6 => ['label' => 'Incomplete', 'class' => 'status-incomplete'],
                  7 => ['label' => 'Expired', 'class' => 'status-expired'],
              ];

              $activeCountry = $user->active_country;

              $activeRegistration = $registrations->firstWhere(
                  'country_code',
                  $activeCountry
              );

              if (!$activeRegistration) {
                  $activeRegistration = $registrations->first();
              }

              $activeStatus = $activeRegistration->status ?? 1;
              @endphp

              <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                  <div>
                    <span id="statusPill"
                          class="status-pill {{ $statusMap[$activeStatus]['class'] }}">
                        {{ $statusMap[$activeStatus]['label'] }}
                    </span>
                  </div>
                  <div>
                    @php
                    $activeCountry = $user->active_country;
                    @endphp

                    <select class="form-select" id="countrySwitcher">
                        @forelse ($registrations as $registration)
                            <option value="{{ $registration->country_code }}"
                                    data-status="{{ $registration->status ?? 1 }}"
                                    {{ $activeCountry === $registration->country_code ? 'selected' : '' }}>
                                {{ country_name($registration->country_code) }}
                            </option>
                        @empty
                            <option disabled selected>No registered countries</option>
                        @endforelse
                    </select>
                  </div>
              </div>


            <div class="profile-chklst">
              <span>Profile basics</span>
              <?php
              

              $get_myprofile_status = DB::table("updated_tab_name")->where("user_id", Auth::guard('nurse_middle')->user()->id)->get();

              $get_progress_status = round(count($get_myprofile_status)/15 * 100);

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
                <li><a class="btn btn-border aboutus-icon mb-20 profile_tabs" href="#tab-my-profile" id="my_profile" data-bs-toggle="tab" role="tab" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-user"></i> My Profile</a></li>
                <li><a href="{{ route('nurse.setting_availablity', ['page' => 'setting_availablity']) }}" class="btn btn-border recruitment-icon mb-20" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-membership-vip"></i> Setting & Availability</a></li>
                <li><a class="{{ request()->is('nurse/registration_licences') ?'active':'' }} btn btn-border recruitment-icon mb-20" href="{{ route('nurse.registration_licences', ['page' => 'registration_licences']) }}"><i class="fi fi-rr-settings"></i> Registrations and Licences</a></li>
                <li><a href="#tab-my-jobs" id="my_profession" class="btn btn-border recruitment-icon mb-20 profile_tabs" data-bs-toggle="tab" role="tab" aria-controls="tab-my-jobs" aria-selected="false"><i class="fi fi-rr-employee-man"></i> Profession</a></li>
                <li><a class="btn btn-border people-icon mb-20" id="educert" data-bs-toggle="tab" role="tab" aria-controls="tab-saved-jobs" aria-selected="false"><i class="fi fi-rr-graduation-cap"></i> Education and Certifications</a></li>
                <li><a href="{{ route('nurse.mandatory_training', ['page' => 'mandatory_training']) }}" class="{{ request()->is('nurse/mandatory_training') ?'active':'' }} btn btn-border aboutus-icon mb-20"><i class="fi fi-rr-chart-user"></i>Mandatory Training and Continuing Education</a></li>
                <li><a href="#experience" id="experience_info" class="btn btn-border aboutus-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-suitcase-alt"></i> Experience</a></li>
                <li><a href="#reference" id="reference_info" class="btn btn-border aboutus-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-suitcase-alt"></i> References</a></li>
                <!-- <li><a href="#experience" id="experience_info" class="btn btn-border aboutus-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-chart-histogram"></i>  Financial Details</a></li> -->
                <!-- <li><a href="#vaccinations" id="vaccinations" class="btn btn-border aboutus-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-chart-user"></i> Vaccinations</a></li> -->
                <li><a href="{{ route('nurse.profileVaccination', ['page' => 'vaccinations']) }}" class="btn btn-border aboutus-icon mb-20" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-chart-user"></i> Vaccinations</a></li>
                <li><a href="{{ route('nurse.workClearances', ['page' => 'work_clearances']) }}" class="btn btn-border recruitment-icon mb-20" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-briefcase-arrow-right"></i> Checks and Clearances</a></li>
                <li><a href="{{ route('nurse.professionalMembership', ['page' => 'professional_membership']) }}" class="btn btn-border recruitment-icon mb-20" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-membership-vip"></i> Professional Memberships & Awards</a></li>
                <li><a href="{{ route('nurse.language_skills', ['page' => 'language_skills']) }}" class="btn btn-border recruitment-icon mb-20" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-membership-vip"></i> Language Skills</a></li>
                {{-- <li><a href="#interview_references" id="interview_references" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-refer-arrow"></i> Interview</a></li>
                <li><a href="#personal_preferences" id="personal_preferences" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-id-badge"></i> Personal Preferences</a></li>
                <li><a href="#work_preferences" id="work_preferences" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-magnifying-glass-wave"></i>Job Search Preferences</a></li>
                <li><a href="#testimonial_reviews" id="testimonial_reviews" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-feedback-review"></i> Testimonials and Reviews</a></li>
                <li><a href="#additional_info" id="additional_info" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-guide-alt"></i> Additional Information</a></li> --}}
                <div class="mt-0 mb-20 logout-line">
                  <a class="link-red font-md" href="{{ route('nurse.logout') }}"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Log Out</a>
                  <a class="support-button font-md" href="{{ route('contact') }}">Need support?</a>
                </div>
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
                              <div class="col-md-12 mob-adj">
                                <input type="hidden" name="countryCode" id="countryCode">
                                <input type="hidden" name="countryiso" id="country_iso" value="{{  Auth::guard('nurse_middle')->user()->country_iso }}">
                                <input class="form-control numbers" type="tel" name="contact" id="contactI" value="{{  Auth::guard('nurse_middle')->user()->phone }}" maxlength="14">
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
                            <div class="form-group">
                                <label class="font-sm color-text-mutted mb-10">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="Female" {{ Auth::guard('nurse_middle')->user()->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Male" {{ Auth::guard('nurse_middle')->user()->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Non-binary" {{ Auth::guard('nurse_middle')->user()->gender == 'Non-binary' ? 'selected' : '' }}>Non-binary</option>
                                    <option value="Other" {{ Auth::guard('nurse_middle')->user()->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                    <option value="Prefer not to say" {{ Auth::guard('nurse_middle')->user()->gender == 'Prefer not to say' ? 'selected' : '' }}>Prefer not to say</option>
                                </select>
                            </div>
                        </div>
                          <!-- <div class="form-group col-md-12">
                          <label class="font-sm color-text-mutted mb-10">Bio</label>
                          <textarea class="form-control" rows="4" name="bio">{{ Auth::guard('nurse_middle')->user()->bio }}</textarea>
                        </div> -->
                          {{-- <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Nationality</label>

                            <select name="nationality" class="form-control form-select ps-5">
                              <option value="">Select Nationality</option>
                              @php $country_data=country_name_from_db();@endphp
                              @foreach ($country_data as $data)
                              <option value="{{ $data->id }}" <?= isset(Auth::guard('nurse_middle')->user()->nationality) &&  Auth::guard('nurse_middle')->user()->nationality == $data->id ? 'selected' : '' ?>>{{ $data->nationality }}</option>
                              @endforeach
                            </select>
                          </div> --}}
                          {{-- <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Personal website</label>
                            <input class="form-control" type="text" name="website" value="{{  Auth::guard('nurse_middle')->user()->personal_website }}">
                          </div> --}}
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
                            <label class="font-sm color-text-mutted mb-10">Country of Residence</label>
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


                          {{-- <div class="col-lg-6">
                            <div class="form-group">
                              <label class="font-sm color-text-mutted mb-10">Home Address</label>
                              <input class="form-control" type="text" name="home_address" id="home_address" value="{{ Auth::guard('nurse_middle')->user()->home_address }}">
                            </div>
                          </div> --}}
                          {{-- <h6 class="emergency_text">
                            Emergency Contact Information
                          </h6> --}}
                          <div class="col-lg-6 row" style="display: none;">
                            <div class="form-group">
                              <label class="font-sm color-text-mutted mb-10">Mobile No</label>

                              <div class="col-md-12 mob-adj">
                                <input type="hidden" name="emergency_countryCode" id="emergency_countryCode">
                                <input type="hidden" name="emergency_countryiso" id="emergency_country_iso">
                                <input class="form-control numbers" type="text" name="emergency_conact_numeber" id="contactI_emergency" value="{{ Auth::guard('nurse_middle')->user()->emergency_conact_numeber }}" maxlength="10">
                                <span id="reqTxtcontactI" class="reqError valley"></span>
                              </div>

                            </div>
                          </div>
                          {{-- <div class="col-lg-6 row">
                            <div class="form-group">
                              <label class="font-sm color-text-mutted mb-10">Email*</label>

                              <div class="col-md-12">

                                <input class="form-control" type="email" required="" name="emergergency_contact_email" id="emergergency_contact_email" placeholder="Email" value="{{ Auth::guard('nurse_middle')->user()->emergergency_contact_email }}">

                              </div>

                            </div>
                          </div> --}}
                          <div class="box-button mt-15">
                            <button class="btn btn-apply-big font-md font-bold" @if(!email_verified()) disabled @endif type="submit" id="submitfrm">Save Changes</button>
                          </div>
                        </div>
                      </form>
                    </div>

       
                    {{-- <div class="col-lg-12 col-md-12 update_profile">
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
                    </div>  --}}

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
                  <div class="profession_banner">
                    @php
                      $profession_banner_status = $user_data->profession_banner_status;         
                    @endphp
                    @if($profession_banner_status == 1)
                      <div class="profession-onboard-banner">
                        <div class="banner-icon">ℹ️</div>

                        <div class="banner-content">
                          <strong>We pre-filled this from signup.</strong>
                          <p>Please review and complete your professional details:</p>

                          <ol>
                            <li>Confirm, edit, or remove your prefilled <b>Type(s)</b> and <b>Specialties</b></li>
                            <li>Add more specialties using multi-select</li>
                            <li>Mark your <b>Primary specialty</b></li>
                            <li>Add <b>years of experience (0–30)</b> and optional <b>last year practiced</b> per specialty</li>
                            <li>If experience is <b>0 years</b>, you can toggle <b>“Willing to upskill”</b></li>
                          </ol>
                        </div>

                        <button class="banner-close" onclick="this.parentElement.style.display='none'">✕</button>
                      </div>         
                    @endif
                  </div>
                  <div class="profession_summury_table">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">S. No.</th>
                          <th scope="col">Type of Nurse</th>
                          <th scope="col">Specialty</th>
                          <th scope="col">Status</th>
                          <th scope="col">Years of Experience</th>
                          <th scope="col">End Date / Last Practiced</th>
                          <th scope="col">Employment Type</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(count($profession_data) > 0)
                        @foreach ($profession_data as $exp_data)
                        @php
                         $nurse_data = DB::table("practitioner_type")->where("id",$exp_data->nurse_data)->first();
                         $speciality_data = DB::table("speciality")->where("id",$exp_data->specialties)->first();
                          
                          
                          
                          
                        @endphp
                        
                        <tr class="profession-row">
                          <td class="sno"></td>
                          <td>
                            {{ $nurse_data->name ?? '' }}
                          </td>  
                          <td>
                            {{ $speciality_data->name ?? '' }}
                          </td>  
                          <td>
                            {{ $exp_data->speciality_status }}
                          </td>  
                          <td>
                            {{ $exp_data->assistent_level }} Years
                          </td>
                          <td>
                            -
                          </td>  
                          <td>
                            {{ $exp_data->current_employee_status }}
                          </td>  
                          <td><a href="{{ url('/nurse/my-profile') }}?page=profession&&btn=edit&&profession_id={{ $exp_data->profession_id }}" class="btn btn-dark px-4 py-2">Edit</a></td>
                        </tr>       
                         
                        @endforeach
                        @else
                        @foreach ($specialities_data as $spec)
                        <tr class="profession-row">
                          <td>{{ $loop->iteration }}</td>            
                          <td>
                            
                            <ol type="1" style="list-style: decimal;">
                              @foreach ($nurse_data as $values)
                              @php
                                $nurse_datas = DB::table("practitioner_type")->where("id",$values)->first();
                              @endphp
                              <li>{{ $nurse_datas->name }}</li>
                             
                              @endforeach
                            </ol>
                          </td>
                          <td>
                            
                              
                              @php
                                $speciality_datas = DB::table("speciality")->where("id",$spec)->first();
                              @endphp
                              {{ $speciality_datas->name }}
                            
                          </td>
                          <td>
                            
                            
                              
                              @php
                                
                                $speciality_status = isset($specialities_type['speciality_status'])?(array)$specialities_type['speciality_status']:[];
                                
                              @endphp
                              @foreach($speciality_status as $key=>$s_status)
                                <?php
                                  $parts1 = explode('_', $key);
                                  $sp_data_name = DB::table("speciality")->where('id', $parts1[1])->first();
                                  $speciality_status_data = DB::table("speciality_status")->get();
                                ?>
                                @if ($parts1[1] == $spec)
                                {{ $s_status->status }}
                                @endif
                              @endforeach
                              
                             
                            
                          </td>
                          <td>{{ $user_data->assistent_level }} years</td>
                          <td>
                            -
                          </td>
                          <td>{{ $user_data->current_employee_status }}</td>
                          <td><a href="{{ url('/nurse/my-profile') }}?page=profession&&btn=edit&&profession_id=" class="btn btn-dark px-4 py-2">Edit</a></td>
                        </tr>
                        @endforeach
                        
                        @endif
                      </tbody>
                    </table>
                    
                    <div class="d-flex justify-content-end align-items-center mt-3 mt-3">
                        <button type="button" class="btn btn-outline-dark" id="toggleProfession">
                            Show More
                        </button>
                    </div>
                    <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const rows = document.querySelectorAll(".profession-row");
                        const toggleBtn = document.getElementById("toggleProfession");
                    
                        if (rows.length <= 2) {
                            toggleBtn.style.display = "none";
                            rows.forEach(r => r.classList.add("show"));
                            return;
                        }
                    
                        let expanded = false;
                    
                        function showLimited() {
                            rows.forEach((row, index) => {
                                row.classList.toggle("show", index < 2);
                            });
                            toggleBtn.innerText = "Show More";
                            expanded = false;
                        }
                    
                        function showAll() {
                            rows.forEach(row => row.classList.add("show"));
                            toggleBtn.innerText = "Show Less";
                            expanded = true;
                        }
                    
                        showLimited();
                    
                        toggleBtn.addEventListener("click", function () {
                            expanded ? showLimited() : showAll();
                        });
                    });
                    </script>
                  </div>
                  <h6 class="emergency_text">
                        Please Select all specialties you have experience in:
    
                      </h6>
                  <form id="profession_form" method="POST" onsubmit="return myFunction1()">
                    @csrf
                    <div class="condition_set">
                      <div class="form-group drp--clr">
                        <label class="form-label" for="input-1">Type of Nurse?</label>
                        @php
                            $user = Auth::guard('nurse_middle')->user();

                            if(!empty($profession_single_data)){
                              $nurse_type = (array)json_decode($profession_single_data->nurse_data);
                              $specialities_type = (array)json_decode($profession_single_data->specialties);
                            }else{
                              $nurse_type = (array)json_decode($user->nurse_data);
                              $specialities_type = (array)json_decode($user->specialties);
                            }

                            
                            
                            
                            $btn_name = isset($_GET['btn'])?$_GET['btn']:'';

                            $profession_nurse_id = ($btn_name != '')?$profession_single_data->nurse_data:0;
                            $profession_specility_id = ($btn_name != '')?$profession_single_data->specialties:0;
                            $practitioner_data = DB::table("practitioner_type")->where("id",$profession_nurse_id)->first();
                            $mainnurse_json = (!empty($practitioner_data))?json_encode($practitioner_data->parent):'';
                            $subnurse_json = (!empty($profession_single_data))?json_encode($profession_single_data->nurse_data):'';

                            $specility_data = DB::table("speciality")->where("id",$profession_specility_id)->first();
                            
                            $mainspecility_json = (!empty($specility_data))?json_encode((string)$specility_data->parent):'';
                            $subspecility_json = (!empty($profession_single_data))?json_encode($profession_single_data->specialties):'';
                        @endphp
                        <input type="hidden" name="btn_name" value="@if($btn_name != '') edit @endif">
                        <input type="hidden" name="user_id" class="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                        <input type="hidden" name="ntype" class="ntype" value="{{ $btn_name == 'edit' ?$mainnurse_json:'' }}">
                        <ul id="type-of-nurse-0" style="display:none;">
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

                        <select class="js-example-basic-multiple addAll_removeAll_btn nurse_type_field" data-list-id="type-of-nurse-0" name="nurseType[type_0][]" id="nurse_type" multiple="multiple" onchange="getNurseType('main',0)"></select>
                        <span id="reqnurseTypeId" class="reqError text-danger valley"></span>    
                      </div>
                      
                    </div>

                    <div class="showNurseType-0">

                     
                      @if($btn_name == 'edit') 
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
                          <select class="js-example-basic-multiple subnurse_valid-{{ $practitioner_data->parent }} addAll_removeAll_btn" data-list-id="type-of-nurse-{{ $practitioner_data->parent }}" name="nurseType[type_{{ $practitioner_data->parent }}][]" onchange="getNurseType('main',{{ $practitioner_data->parent }})" multiple="multiple"></select>
                          <span id="reqsubnursevalid-{{ $practitioner_data->parent }}" class="reqError text-danger valley"></span>
                          </div>
                          <div class="subnurse_level-{{ $practitioner_data->parent }}"></div>
                      </div>
                      <div class="showNurseType-{{ $profession_single_data->nurse_data }}"></div>
                      <div class="showNurseSpeciality-{{ $profession_single_data->nurse_data }}">
                        <div class="condition_set nurse_specialities nurse_specialities-{{ $profession_single_data->nurse_data }}">
                          <div class="form-group drp--clr">
                            <label class="form-label" for="input-1">Specialties</label>
                            <input type="hidden" name="subspecialitynurse_list" class="subspecialitynurse_list" value="{{ $profession_single_data->nurse_data }}">
                            <input type="hidden" name="speciality_value" class="speciality_value" value="{{ $btn_name == 'edit' ? $mainspecility_json:'' }}">
                            <ul id="speciality_preferences-{{ $profession_single_data->nurse_data }}-0" style="display:none;">
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
                            <select class="js-example-basic-multiple addAll_removeAll_btn speciality_type_field" data-list-id="speciality_preferences-{{ $profession_single_data->nurse_data }}-0" name="nurseType[{{ $profession_single_data->nurse_data }}][type_0][]" multiple="multiple" onchange="getSecialities('sub',{{ $profession_single_data->nurse_data }},0)"></select>
                            <span id="reqspecialties" class="reqError text-danger valley"></span>
                          </div>
                          <div class="show_specialities-{{ $profession_single_data->nurse_data }}-{{ $specility_data->parent }}">
                            <div class="subspec_main_div subspec_main_div-{{ $profession_single_data->nurse_data }}-{{ $specility_data->parent }}"
                             >
                             <?php
                                $sp_data_name = DB::table("speciality")->where('id', $specility_data->parent)->first();
                                $sp_data = DB::table("speciality")->where('parent', $specility_data->parent)->get();
                              ?>
                              <input type="hidden" name="subspectype" class="subspectype-{{ $specility_data->parent }}" value="{{ $subspecility_json }}">
                              <div class="subspec_div form-group level-drp">
                                <label class="form-label">{{ $sp_data_name->name }}</label>

                                <input type="hidden" class="subspec_list subspec_listProf-{{ $profession_single_data->specialties }} subspec_list-{{ $profession_single_data->specialties }}" value="{{ $specility_data->parent }}">

                                <ul id="speciality_preferences-{{ $profession_single_data->nurse_data }}-{{ $specility_data->parent }}" style="display:none;">
                                  @foreach($sp_data as $sd)
                                  <li data-value="{{ $sd->id }}">{{ $sd->name }}</li>
                                  @endforeach
                                </ul>

                                <select class="js-example-basic-multiple subspec_valid-{{ $specility_data->parent }} addAll_removeAll_btn"
                                        data-list-id="speciality_preferences-{{ $profession_single_data->nurse_data }}-{{ $specility_data->parent }}"
                                        name="nurseType[{{ $profession_single_data->nurse_data }}][type_{{ $specility_data->parent }}][]"
                                        multiple
                                        onchange="getSecialities('sub', {{ $profession_single_data->nurse_data }}, {{ $specility_data->parent }})">
                                </select>
                              </div>
                              <span id="reqsubspecvalid-{{ $specility_data->parent }}" class="reqError text-danger valley"></span>
                              <div class="show_specialities-{{ $profession_single_data->nurse_data }}-{{ $specility_data->parent }}"></div>
                              <div class="show_specialitiesStatus-{{ $profession_single_data->nurse_data }}-{{ $specility_data->parent }}">
                                <div class="subspecprofdiv subspecprofdiv-{{ $profession_single_data->nurse_data }}-{{ $profession_single_data->specialties }}">
                            <div class="custom-select-wrapper">
                                 <?php
                                    $sp_data_name_status = DB::table("speciality")->where('id', $profession_single_data->specialties)->first();
                                    $speciality_status_data = DB::table("speciality_status")->get();
                                  ?>
                                <label class="form-label">
                                    Specialty Status ({{ $sp_data_name_status->name }})
                                    
                                    <span class="info tooltip-btn" tabindex="0" aria-describedby="statusTooltip">ⓘ</span>
                                    <ul class="tooltip_speciality_status" style="padding-left:18px; margin:8px 0 0 0">
                                      <li><strong>Status definitions:</strong></li>
                                      <li><strong>Current:</strong> Actively practicing, used in present or most recent job.</li>
                                      <li><strong>Principal:</strong> Main/strongest specialty (only one allowed).</li>
                                      <li><strong>First:</strong> First-ever specialty after qualification.</li>
                                      <li><strong>Former:</strong> Previously practiced.</li>
                                      <li><strong>Upskilling / Transitioning / Training:</strong> Moving into this specialty.</li>
                                      <li><strong>—</strong> (No status selected — default when nurse doesn’t pick one).</li>
                                    </ul>
                                </label>
                                <input type="hidden" name="subspecprof_list" class="subspecprof_list subspecprofpart_list-{{ $profession_single_data->specialties }} subspecprof_listProfession subspecprof_listProfession-{{ $specility_data->parent }} subspecprof_list-{{ $specility_data->parent }}" value="{{ $specility_data->parent }}">
                                
                                <select class="custom-select speciality_status_columns-{{ $profession_single_data->specialties }}"
                                    name="nurseType[{{ $profession_single_data->nurse_data }}][speciality_status][type_{{ $profession_single_data->specialties }}][status]">
                                    <option value="">select</option>
                                    @foreach($speciality_status_data as $s_status_data)
                                       
                                        <option value="{{ $s_status_data->status_name }}" @if($s_status_data->status_name == $profession_single_data->speciality_status) selected @endif>{{ $s_status_data->status_name }}</option>
                                        @endforeach
                                </select>
                                <span id="reqsubspeclevelvalid-{{ $specility_data->parent }}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="custom-select-wrapper form-group level-drp">
                              <label class="form-label" for="input-1">What is your overall level of experience in nursing/midwifery?
                              </label>
                              <select class="custom-select" name="nurseType[{{ $profession_single_data->nurse_data }}][speciality_status][type_{{ $profession_single_data->specialties }}][assistent_level]">
                                <option value="">Please Select</option>
                                @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}" @if($profession_single_data->assistent_level == $i && $btn_name != '') selected @endif>{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                                @endfor
                              </select>
                              <span id="reqassistentlevel" class="reqError text-danger valley"></span>
                            </div>
                            <div class="professional_bio professional_employee_status">
                            <div class="custom-select-wrapper form-group level-drp col-md-12">
                              <label class="form-label" for="input-1">Current Employment Status</label>
                              <select class="custom-select" name="nurseType[{{ $profession_single_data->nurse_data }}][speciality_status][type_{{ $profession_single_data->specialties }}][employee_status]" onchange="employeeStatus(this.value,{{ $profession_single_data->nurse_data }},{{ $specility_data->parent }})">
                                <option value="">select</option>
                                <option value="Permanent" @if($profession_single_data->current_employee_status == "Permanent") selected @endif>Permanent</option>
                                <option value="Fixed-term" @if($profession_single_data->current_employee_status == "Fixed-term") selected @endif>Fixed-term</option>
                                <option value="Temporary" @if($profession_single_data->current_employee_status == "Temporary") selected @endif>Temporary</option>
                                <option value="Unemployed" @if($profession_single_data->current_employee_status == "Unemployed") selected @endif>Unemployed</option>
                              </select>
                            </div>
                            <span id="reqemployee_status" class="reqError text-danger valley"></span>
                          </div>
                          <div class="professional_permanent-{{ $profession_single_data->nurse_data }}-{{ $profession_single_data->specialties }}" @if($profession_single_data->permanent_status == "select") style="display:none;" @endif>
                            <div class="form-group level-drp col-md-12">
                              <label class="form-label" for="input-1">Permanent</label>
                              <input type="hidden" name="perhfield" class="perhfield" value="{{ $profession_single_data->permanent_status }}">
                              <ul id="permanent_status_profession" style="display:none;">
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
                              <select class="js-example-basic-multiple" data-list-id="permanent_status_profession" name="nurseType[{{ $profession_single_data->nurse_data }}][speciality_status][type_{{ $specility_data->parent }}][permanent_status]" id="permanent_status"></select>
                              <span id="reqemployeep_status" class="reqError text-danger valley"></span>
                            </div>
                          </div>
                          <div class="professional_temporary-{{ $profession_single_data->nurse_data }}-{{ $profession_single_data->specialties }}"  @if($profession_single_data->temporary_status == "select") style="display:none;" @endif>
                            <div class="form-group level-drp col-md-12">
                              <label class="form-label" for="input-1">Temporary</label>
                              <input type="hidden" name="temphfield" class="temphfield" value="">
                              
                              <ul id="temporary_status_profession" style="display:none;">
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
                              <select class="js-example-basic-multiple" data-list-id="temporary_status_profession" name="nurseType[{{ $profession_single_data->nurse_data }}][speciality_status][type_{{ $profession_single_data->specialties }}][temporary_status]" id="temporary_status_profession"></select>
                              <span id="reqemployeet_status" class="reqError text-danger valley"></span>
                            </div>
                            
                          </div>
                          <div class="custom-select-wrapper professional_unemplyeed-{{ $profession_single_data->nurse_data }}-{{ $profession_single_data->specialties }}" @if($profession_single_data->unemployeed_reason == NULL) style="display:none;" @endif>
                            <div class="form-group level-drp col-md-12">
                              <label class="form-label" for="input-1">Reason for Unemployment</label>
                              <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                              <select class="custom-select mr-10 select-active unemployeement_reason" name="nurseType[{{ $profession_single_data->nurse_data }}][speciality_status][type_{{ $profession_single_data->specialties }}][unemployeement_reason]" id="unemployeement_reason" onchange="reasonUnemployeement(this.value,{{ $profession_single_data->nurse_data }},{{ $profession_single_data->specialties }})">
                                <option value="">select</option>
                                <option value="Recently graduated" @if($profession_single_data->current_employee_status == "Recently graduated") selected @endif>Recently graduated</option>
                                <option value="Career break (maternity leave, family reasons, etc.)" @if($profession_single_data->current_employee_status == "Career break (maternity leave, family reasons, etc.)") selected @endif>Career break (maternity leave, family reasons, etc.)</option>
                                <option value="Transitioning from another job" @if($profession_single_data->current_employee_status == "Transitioning from another job") selected @endif>Transitioning from another job</option>
                                <option value="Retired but seeking work" @if($profession_single_data->current_employee_status == "Retired but seeking work") selected @endif>Retired but seeking work</option>
                                <option value="Laid off / Contract ended" @if($profession_single_data->current_employee_status == "Laid off / Contract ended") selected @endif>Laid off / Contract ended</option>
                                <option value="Other (Please specify)" @if($profession_single_data->current_employee_status == "Other (Please specify)") selected @endif>Other (Please specify)</option>
                              </select>
                            </div>
                            <span id="requnempreason" class="reqError text-danger valley"></span>
                          </div>
                          <div class="form-group @if($profession_single_data->unemployeed_reason == NULL) d-none @endif specify_reason_div-{{ $profession_single_data->nurse_data }}-{{ $profession_single_data->specialties }}">
                            <label class="form-label" for="input-1">Other (Please specify)</label>
                            
                            <input class="form-control" type="text" name="specify_reason" value="">
                            <span id="otherspecify_reason" class="reqError text-danger valley"></span>
                          </div>
                          <div class="custom-select-wrapper long_unemplyeed-{{ $profession_single_data->nurse_data }}-{{ $profession_single_data->specialties }}  @if($profession_single_data->long_unemplyeed == NULL) d-none @endif">
                            <div class="form-group level-drp col-md-12">
                              <label class="form-label" for="input-1">How long have you been unemployed?</label>
                              <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                              <select class="custom-select long_unemployeed" name="nurseType[{{ $profession_single_data->nurse_data }}][speciality_status][type_{{ $profession_single_data->specialties }}][long_unemployeed]" id="long_unemployeed">
                                <option value="">select</option>
                                <option value="Less than 1 month" @if($profession_single_data->current_employee_status == "Less than 1 month") selected @endif>Less than 1 month</option>
                                <option value="1 to 3 months" @if($profession_single_data->current_employee_status == "1 to 3 months") selected @endif>1 to 3 months</option>
                                <option value="3 to 6 months" @if($profession_single_data->current_employee_status == "3 to 6 months") selected @endif>3 to 6 months</option>
                                <option value="6 months to 1 year" @if($profession_single_data->current_employee_status == "6 months to 1 year") selected @endif>6 months to 1 year</option>
                                <option value="More than 1 year" @if($profession_single_data->current_employee_status == "More than 1 year") selected @endif>More than 1 year</option>
                                
                              </select>
                              <span id="reqlong_unemp" class="reqError text-danger valley"></span>
                            </div>
                            
                          </div>
                          </div>
                              </div>
                            
                            </div>
                          </div>
                        </div>
                      </div>      
                      @endif      
                    
                    </div>
                    <div class="result--show d-none">
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
                          
                          <div class="nursing_data form-group drp--clr col-md-4 d-none drpdown-set nursing_{{ $spl->id }}" id="nursing_level-{{ $i }}">
                            <label class="form-label" for="input-2">{{ $spl->name }}</label>
                            <ul id="nursing_entry-{{ $i }}" style="display:none;">
                              @foreach($nursing_data as $nd)
                              <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>

                              @endforeach
                              <!-- Add more list items as needed -->
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nursing_entry-{{ $i }}" name="nursing_type_{{ $i }}[]" multiple="multiple"></select>
                            <span id="reqnursesubcat_{{ $i }}" class="reqError text-danger valley"></span>
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
                        <span id="reqnurseprac" class="reqError text-danger valley"></span>
                      </div>

                    </div>
                    <div class="condition_set" style="display:none">
                      <div class="form-group drp--clr">
                        <input type="hidden" name="speciality_value" class="speciality_value" value="{{ isset($specialities_type['type_0'])?json_encode($specialities_type['type_0']):'' }}">
                        <label class="form-label" for="input-1">Specialties</label>
                        <ul id="speciality_preferences-0" style="display:none;">
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
                        <select class="js-example-basic-multiple addAll_removeAll_btn speciality_type_field" data-list-id="speciality_preferences-0" name="specialties[type_0][]" multiple="multiple" onchange="getSecialities('main',0)"></select>
                        <span id="reqspecialties" class="reqError text-danger valley"></span>
                      </div>
                      
                    </div>
                    <div class="show_specialities-0" style="display:none">
                      

                      @php
                        
                        
                        $specTypes = [];
                        if(!empty($specialities_type)){        
                          foreach ($specialities_type as $key => $value) {
                              $parts = explode('_', $key); // ["type", "0"]
                              
                              if (isset($parts[1]) && (int)$parts[1] !== 0) {
                                  $specTypes[$key] = $value;
                              }
                          }
                        }
                        
                      @endphp

                      @if(!empty($specTypes))
                      @foreach($specTypes as $key => $stypes)
                        @php
                          $parts = explode('_', $key);
                          
                          $s_data = json_encode($stypes);

                          $parentId  = getParentSpecialityId($specialities_type, $parts[1]);
                          
                        @endphp
                        <input type="hidden" name="subspectype" class="subspectype-{{ $parts[1] }}" value="{{ $s_data }}">
                        <div data-id="{{ $parts[1] }}" data-parent="{{ $parentId }}" class="subspec_main_div subspec_main_div-{{ $parts[1] }}">
                          <?php
                            $sp_data_name = DB::table("speciality")->where('id', $parts[1])->first();
                            $sp_data = DB::table("speciality")->where('parent', $parts[1])->get();
                          ?>
                          <div class="subspec_div subspec_div-{{ $parts[1] }} form-group level-drp">
                          <label class="form-label subspec_label subspec_label-{{ $parts[1] }}" for="input-1">{{ $sp_data_name->name }}</label>
                          <input type="hidden" name="subspec_list" class="subspec_list subspec_listProf-{{ $parentId }} subspec_list-{{ $parts[1] }}" value="{{ $parts[1] }}">
                          <ul id="speciality_preferences-{{ $parts[1] }}" style="display:none;">
                            @foreach($sp_data as $sd)
                            <li data-value="{{ $sd->id }}">{{ $sd->name }}</li>
                            @endforeach
                          </ul>
                          <select class="js-example-basic-multiple subspec_valid-{{ $parts[1] }} addAll_removeAll_btn" data-list-id="speciality_preferences-{{ $parts[1] }}" name="specialties[type_{{ $parts[1] }}][]" multiple="multiple" onchange="getSecialities('main',{{ $parts[1] }},'edit')"></select>
                          <span id="reqsubspecvalid-{{ $parts[1] }}" class="reqError text-danger valley"></span>
                          
                          <div class="subspec_level-{{ $parts[1] }}"></div>
                          <div class="show_specialities-{{ $parts[1] }}"></div>
                          <div class="show_specialitiesStatus-{{ $parts[1] }}">
                            <?php
                                  
                                  $speciality_status = isset($specialities_type['speciality_status'])?(array)$specialities_type['speciality_status']:[];
                                  //print_r($specialities_type['speciality_status']);

                                  
                                ?>

                                @foreach($speciality_status as $key=>$s_status)

                                    <?php
                                      $parts1 = explode('_', $key);
                                      $sp_data_name = DB::table("speciality")->where('id', $parts1[1])->first();
                                      $speciality_status_data = DB::table("speciality_status")->get();
                                    ?>
                                    @if (in_array($parts1[1], $stypes))
                                    <div class="custom-select-wrapper subspecprofdiv subspecprofdiv-{{ $parts1[1] }} form-group level-drp" style="margin-bottom: 5px;">
                                      <label class="form-label subspeclabel-{{ $parts1[1] }}" for="input-1">
                                        Specialty Status ({{ $sp_data_name->name }}) 
                                        <span class="info tooltip-btn" tabindex="0" aria-describedby="statusTooltip">ⓘ</span>
                                        
                                          <ul class="tooltip_speciality_status" style="padding-left:18px; margin:8px 0 0 0">
                                            <li><strong>Status definitions:</strong></li>
                                            <li><strong>Current:</strong> Actively practicing, used in present or most recent job.</li>
                                            <li><strong>Principal:</strong> Main/strongest specialty (only one allowed).</li>
                                            <li><strong>First:</strong> First-ever specialty after qualification.</li>
                                            <li><strong>Former:</strong> Previously practiced.</li>
                                            <li><strong>Upskilling / Transitioning / Training:</strong> Moving into this specialty.</li>
                                            <li><strong>—</strong> (No status selected — default when nurse doesn’t pick one).</li>
                                          </ul>
                                        
                                      </label>
                                      <input type="hidden" name="subspecprof_list" class="subspecprof_list subspecprof_listProfession subspecprof_listProfession-{{ $parts1[1] }} subspecprof_list-{{ $parts1[1] }}" value="{{ $parts1[1] }}">
                                      <input type="hidden" name="subspecprof_list" class="subspecprofpart_list subspecprofpart_list-{{ $parts[1] }}" value="{{ $parts1[1] }}">
                                      <select class="custom-select speciality_status_column speciality_status_column-{{ $parts[1] }} speciality_status_columns-{{ $parts1[1] }} form-input mr-10 langprof_level_valid-{{ $parts1[1] }}" name="specialties[speciality_status][type_{{ $parts1[1] }}][status]" onchange="changeSpecialityStatus(this.value,{{ $parts1[1] }},{{ $parts[1] }})">
                                        <option value="">select</option>
                                        @foreach($speciality_status_data as $s_status_data)
                                       
                                        <option value="{{ $s_status_data->status_name }}" @if($s_status_data->status_name == $s_status->status) selected @endif>{{ $s_status_data->status_name }}</option>
                                        @endforeach
                                        
                                      </select>
                                      <input type="hidden" class="speciality_flag-{{ $parts1[1] }} is_current_{{ $parts1[1] }}" name="specialties[speciality_status][type_{{ $parts1[1] }}][is_current]" value="0">
                                      <input type="hidden" class="speciality_flag-{{ $parts1[1] }} is_principal_{{ $parts1[1] }}" name="specialties[speciality_status][type_{{ $parts1[1] }}][is_principal]" value="0">
                                      <input type="hidden" class="speciality_flag-{{ $parts1[1] }} is_first_{{ $parts1[1] }}" name="specialties[speciality_status][type_{{ $parts1[1] }}][is_first]" value="0">
                                      <input type="hidden" class="speciality_flag-{{ $parts1[1] }} is_former_{{ $parts1[1] }}" name="specialties[speciality_status][type_{{ $parts1[1] }}][is_former]" value="0">
                                      <input type="hidden" class="speciality_flag-{{ $parts1[1] }} is_upskilling_{{ $parts1[1] }}" name="specialties[speciality_status][type_{{ $parts1[1] }}][is_upskilling]" value="0">
                                    </div>
                                    
                                    <span id="reqsubspeclevelvalid-{{ $parts1[1] }}" class="reqError text-danger valley"></span>
                                    @endif
                                    
                                    

                                @endforeach
                          </div>
                          </div>
                        </div>

                      @endforeach
                      @endif
                    
                    </div>
                    <div class="speciality_boxes row result--show d-none">
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
                        <span id="reqspecialtiessubtype-{{ $l }}" class="reqError text-danger valley"></span>
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
                        <span id="reqsurgical_row_box" class="reqError text-danger valley"></span>
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
                        <span id="reqsurgical_rowpad_box" class="reqError text-danger valley"></span>
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
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_operative_care-{{ $w }}" name="surgical_operative_care{{ $w }}[]" multiple="multiple"></select>
                        <span id="reqsurgical_operative_care-{{ $w }}" class="reqError text-danger valley"></span>
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
                        <span id="reqsurgical_obs_care" class="reqError text-danger valley"></span>
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
                        <span id="reqneonatal_care" class="reqError text-danger valley"></span>
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
                        <span id="reqsurgical_operative_{{ $q }}" class="reqError text-danger valley"></span>
                      </div>
                      <?php
                      $q++;
                      ?>
                      @endforeach
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

                    
                    <div class="professional_bio">
                      <div class="form-group col-md-12">
                        <label class="font-sm color-text-mutted mb-10">Professional Bio</label>
                        <textarea class="form-control" rows="4" name="bio">{{ Auth::guard('nurse_middle')->user()->bio }}</textarea>
                      </div>
                      <span id="reqprofessional_bio" class="reqError text-danger valley"></span>
                    </div>
                    <div class="career_advancement_goals">
                      <div class="form-group col-md-12">
                        <label class="font-sm color-text-mutted mb-10">Career Advancement Goals</label>
                        <textarea class="form-control car_adv_goals" rows="4" name="career_advancement_goals">{{ Auth::guard('nurse_middle')->user()->career_advancement_goals }}</textarea>
                      </div>
                      <span id="reqcareergoals" class="reqError text-danger valley"></span>
                    </div>
                    <div class="declaration_box">
                      <input type="checkbox" name="declare_information" class="declare_information" value="1" @if(Auth::guard('nurse_middle')->user()->declaration_status == 1) checked @endif>
                      <label for="declare_information">I declare that the information provided is true and correct</label>
                    </div>
                    <span id="reqdeclare_information" class="reqError text-danger valley"></span>
                    <div class="box-button mt-15">
                      <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitProfession" @if(!email_verified()) disabled @endif>Save Changes</button>
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
                              <input class="form-control aclsexpiry aclsexpiry-{{ $i }}" type="date" name="acls_expiry[]" value="{{ $a_data->acls_expiry }}" onkeydown="return false">
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
                              <input class="form-control blsexpiry blsexpiry-{{ $i }}" type="date" name="bls_expiry[]" value="{{ $b_data->bls_expiry }}" onkeydown="return false">
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
                              <input class="form-control cprexpiry cprexpiry-{{ $i }}" type="date" name="cpr_expiry[]" value="{{ $c_data->cpr_expiry }}" onkeydown="return false">
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
                              <input class="form-control nrpexpiry nrpexpiry-{{ $i }}" type="date" name="nrp_expiry[]" value="{{ $n_data->nrp_expiry }}" onkeydown="return false">
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
                              <input class="form-control plsexpiry plsexpiry-{{ $i }}" type="date" name="pls_expiry[]" value="{{ $p_data->pls_expiry }}" onkeydown="return false">
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
                              <input class="form-control rnexpiry rnexpiry-{{ $i }}" type="date" name="rn_expiry[]" value="{{ $r_data->rn_expiry }}" onkeydown="return false">
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
                              <input class="form-control npexpiry npexpiry-{{ $i }}" type="date" name="np_expiry[]" value="{{ $n_data->np_expiry }}" onkeydown="return false">
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
                              <input class="form-control cnexpiry cnexpiry-{{ $i }}" type="date" name="cn_expiry[]" value="{{ $cn_data->cn_expiry }}" onkeydown="return false">
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
                              <input class="form-control lpnexpiry lpnexpiry-{{ $i }}" type="date" name="lpn_expiry[]" value="{{ $l_data->lpn_expiry }}" onkeydown="return false">
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
                              <input class="form-control crnaexpiry crnaexpiry-{{ $i }}" type="date" name="crna_expiry[]" value="{{ $crna_data->crna_expiry }}" onkeydown="return false">
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
                              <input class="form-control cnmexpiry cnmexpiry-{{ $i }}" type="date" name="cnm_expiry[]" value="{{ $cnm_data->cnm_expiry }}" onkeydown="return false">
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
                              <input class="form-control onsexpiry onsexpiry-{{ $i }}" type="date" name="ons_expiry[]" value="{{ $ons_data->ons_expiry }}" onkeydown="return false">
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
                              <input class="form-control mswexpiry mswexpiry-{{ $i }}" type="date" name="msw_expiry[]" value="{{ $msw_data->msw_expiry }}" onkeydown="return false">
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
                              <input class="form-control ainexpiry ainexpiry-{{ $i }}" type="date" name="ain_expiry[]" value="{{ $ain_data->ain_expiry }}" onkeydown="return false">
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
                              <input class="form-control rpnexpiry rpnexpiry-{{ $i }}" type="date" name="rpn_expiry[]" value="{{ $rpn_data->rpn_expiry }}" onkeydown="return false">
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
                      {{-- <div class="form-group level-drp @if($education_data && $education_data->nl_data == NULL) d-none @endif @if(empty($educationData)) d-none @endif procertdivfiveteen">
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
                      </div> --}}
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
                          <label class="form-label certificate_label" for="input-1">Certificate {{ $i }}</label>
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
                          <input class="form-control cert_expiry cert_expiry-{{ $i }}" type="date" name="certificate_expiry[]" value="@if(!empty($educationData)){{ $c_data->certificate_expiry }}@endif" onkeydown="return false">
                          <span id="reqcertexpiry-{{ $i }}" class="reqError text-danger valley"></span>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Regulating Body</label>
                          <input class="form-control additional_regulating_body additional_regulating_body-{{ $i }}" type="text" name="regulating_body[]" value="@if(!empty($educationData)){{ $c_data->regulating_body }}@endif">
                          <span id="reqcertregulating_body-{{ $i }}" class="reqError text-danger valley"></span>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Upload your certification/Licence</label>
                          <input type="hidden" name="certificate_upload_certification[{{$i}}]" class="certificate_upload_certification-{{$i}}" value="{{ $c_data->certificate_upload_certification }}">
                          <input class="form-control ano_certifi_imgs_certifi_{{$i}}" type="file" name="certificate_upload_certification[]" onchange="changeAnoImg_cert('{{ $user_id }}','{{ $i }}')" multiple="">
                          <?php
                          $getedufieldsdata = DB::table("edu_fields")->where("user_id", $user_id)->first();

                          if (!empty($educationData)) {
                            $ano_certifi_img = (array)json_decode($c_data->certificate_upload_certification);
                          } else {
                            $ano_certifi_img = '';
                          }


                          
                          //print_r($acls_img[$acls_first_word_one]);
                          //print_r($dtran_img);
                          $user_id = Auth::guard('nurse_middle')->user()->id;
                          ?>
                          <div class="ano_certifi_imgscertifi_{{ $i }}">
                            @if(!empty($ano_certifi_img))
                            @foreach($ano_certifi_img as $ano_img)
                            <div class="trans_img edu_img-{{ $i }} edu_imgano_certifi_imgscertifi_{{ $l }}">
                              <a href="{{ url('/public/uploads/education_degree') }}/{{ $ano_img }}"><i class="fa fa-file"></i>{{ $ano_img }}</a>
                              <div class="close_btn close_btn-{{ $i }}" onclick="deleteanoImgcert('{{ $l }}',{{ $i }},'{{ $user_id }}','{{ $ano_img }}')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
                            </div>
                            <?php
                            $l++;
                            ?>
                            @endforeach
                            @endif
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="add_new_certification_div mb-3 mt-3"><a style="cursor: pointer;" class="delete_certification" data-index="{{ $c_data->certificate_id }}">- Delete certification/Licence</a></div>
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
                        licence_div_count++;
                        var user_id = "{{ $user_id }}";
                        var ano_cer_img_txt = 'ano_certifi_imgs'
                        var name = 'certifi' + '_' + licence_div_count;
                        // $(".another_certifications").append('<div class="license_number_div license_number_div_'+licence_div_count+' row license_number_anothercertifications"><div class="form-group col-md-6"><label class="form-label" for="input-1">Certificate '+licence_div_count+'</label><input class="form-control additional_certificate_field additional_certificate_field-'+licence_div_count+'" type="text" name="training_certificate[]"><span id="reqcertname-'+licence_div_count+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control cert_licence_num cert_licence_num-'+licence_div_count+'" type="text" name="certificate_license_number[]"><span id="reqcertlicense-'+licence_div_count+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control cert_expiry cert_expiry-'+licence_div_count+'" type="date" name="certificate_expiry[]"><span id="reqcertexpiry-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Regulating Body</label><input class="form-control additional_regulating_body additional_regulating_body-'+licence_div_count+'" type="text" name="regulating_body[]"><span id="reqcertregulating_body-'+licence_div_count+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control  ano_certifi_imgs_'+name+' additional_certifications-'+licence_div_count+'" type="file" name="certificate_upload_certification['+licence_div_count+'][]" onchange="changeAnoImg('+user_id+','+licence_div_count+',ano_certifi_imgs,'+name+')" multiple></div><div class="ano_certifi_imgs'+name+'" ></div><div class="col-md-12"><div class="add_new_certification_div mb-3 mt-3"><a style="cursor: pointer;" onclick="delete_certification1('+licence_div_count+')">- Delete certification/Licence</a></div></div></div>');
                        $(".another_certifications").append(`
                                <div class="license_number_div license_number_div_${licence_div_count} row license_number_anothercertifications">
                                    <div class="form-group col-md-6">
                                        <label class="form-label certificate_label" for="input-1">Certificate ${licence_div_count}</label>
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
                                        <input class="form-control cert_expiry cert_expiry-${licence_div_count}" type="date" name="certificate_expiry[]" onkeydown="return false">
                                        <span id="reqcertexpiry-${licence_div_count}" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="input-1">Regulating Body</label>
                                        <input class="form-control additional_regulating_body additional_regulating_body-${licence_div_count}" type="text" name="regulating_body[]">
                                        <span id="reqcertregulating_body-${licence_div_count}" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                                        <input type="hidden" name="certificate_upload_certification[${licence_div_count}]" class="certificate_upload_certification-${licence_div_count}" value="">
                                        <input class="form-control ano_certifi_imgs_${name} additional_certifications-${licence_div_count}" 
                                              type="file" 
                                              name="" 
                                              onchange="changeAnoImg_cert(${user_id}, ${licence_div_count})" 
                                              multiple>
                                    </div>
                                    <div class="ano_certifi_imgs${name}"></div>
                                    <div class="col-md-12">
                                        <div class="add_new_certification_div mb-3 mt-3">
                                            <a style="cursor: pointer;" class="delete_certification">- Delete certification/Licence</a>
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
                      <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitEducation" @if(!email_verified()) disabled @endif>Save Changes</button>
                    </div>
                  </form>
                </div>
              </div>
                            <div class="tab-pane fade" id="tab-experience" role="tabpanel" aria-labelledby="tab-educert" style="display: none">
                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-0 color-brand-1 mb-2">Experience</h3>
                  <h6>Please add your full nursing work experience to strengthen your profile and get hired faster. Please keep update as your experience grows:</h6>
                  <?php
                  $experienceData = DB::table("user_experience")->where("user_id", Auth::guard('nurse_middle')->user()->id)->get();
                  ?>
                  <form id="experience_form" method="POST" novalidate onsubmit="return updateExperience()">
                    @csrf
                    <div class="form-group level-drp">
                      <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                      <input type="hidden" name="nursing_result_two_experience" class="nursing_result_two_experience" value="{{ Auth::guard('nurse_middle')->user()->registered_nurses }}">
                      <input type="hidden" name="nursing_result_three_experience" class="nursing_result_three_experience" value="{{ Auth::guard('nurse_middle')->user()->advanced_practioner }}">
                    </div>
                    <span id="reqlevelexpereience" class="reqError text-danger valley"></span>
                    <div class="previous_employeers">
                      <input type="hidden" value="{{count($experienceData)}}" id="exp_data_count">
                      <?php
                      $i = 1;
                      ?>
                      @if($experienceData->isNotEmpty())
                      @foreach($experienceData as $data)
                      <input type="hidden" name="exp_id[{{$i}}]" value="{{ $data->experience_id }}">
                      <div class="work_exp exp_tab exp_tab-{{$i}}">
                        <h6 class="emergency_text previous_employeers_head">
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
                          <select class="js-example-basic-multiple addAll_removeAll_btn facworktype facworktype-{{ $i }}" data-list-id="wp_data-{{ $i }}" name="positions_held[{{ $i }}]" id="wp_data-{{ $i }}" multiple onchange="getWpData('',{{ $i }})"></select>
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
                          @php
                            $nurse_typeExperience = (array)json_decode($data->nurseType);
                            //print_r($nurse_typeExperience);
                            
                          @endphp
                          
                          <input type="hidden" name="user_id" class="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                          <input type="hidden" name="type_nurse" class="type_nurse_ep-{{ $i }}" value="{{ isset($nurse_typeExperience['type_0'])?json_encode($nurse_typeExperience['type_0']):'' }}">
                          <ul id="type-of-nurse-experience-{{$i}}-0" style="display:none;">
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
                          <select class="js-example-basic-multiple addAll_removeAll_btn nurse_level_ep nurse_type_exp nurse_type_exp_{{$i}}" data-list-id="type-of-nurse-experience-{{$i}}-0" name="nurseType[{{$i}}][type_0][]" id="nurse_type_exp-{{ $i }}-0" multiple="multiple" onchange="getNurseTypeExperience('main',0,{{ $i }})"></select>
                          <span id="reqnurseTypeexpId-{{$i}}" class="reqError text-danger valley"></span>
                        </div>
                        <div class="showNurseTypeExperience-{{$i}}-0">
                          <input type="hidden" name="nursetype_list_experience_count" class="nursetype_list_experience_count" value="{{ $i }}">
                          @php
                            $nurse_typeExperience = json_decode($data->nurseType);
                            $nurseTypesExperience = [];
                            if(!empty($nurse_typeExperience)){        
                              foreach ($nurse_typeExperience as $key => $value) {
                                  $parts = explode('_', $key); // ["type", "0"]
                                  
                                  if (isset($parts[1]) && (int)$parts[1] !== 0) {
                                      $nurseTypesExperience[$key] = $value;
                                  }
                              }
                            }
                          @endphp

                          @if(!empty($nurseTypesExperience))
                          @foreach($nurseTypesExperience as $key => $ntypes)
                            @php
                              $parts = explode('_', $key);
                              
                              $n_data = json_encode($ntypes);
                            @endphp
                            
                            <div class="subnurse_main_div subnurse_main_div-{{ $parts[1] }}">
                                <?php
                                  $np_data_name = DB::table("practitioner_type")->where('id', $parts[1])->first();
                                  $np_data = DB::table("practitioner_type")->where('parent', $parts[1])->get();
                                ?>
                                <input type="hidden" name="subnursetype" class="subnursetype_experiences-{{ $parts[1] }}-{{ $i }}" value="{{ $n_data }}">
                                <div class="subnurse_div subnurse_div-{{ $parts[1] }} form-group level-drp">
                                <label class="form-label subnurse_label subnurse_label-{{ $parts[1] }}" for="input-1">{{ $np_data_name->name }}</label>
                                <input type="hidden" name="subnurse_list" class="subnurse_list_experiences-{{ $i }} subnurse_list_experience-{{ $parts[1] }}" value="{{ $parts[1] }}">
                                <ul id="type-of-nurse-{{ $parts[1] }}-{{ $i }}" style="display:none;">
                                  @foreach($np_data as $nd)
                                  <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                  @endforeach
                                </ul>
                                <select class="js-example-basic-multiple subnurse_valid-{{ $parts[1] }} addAll_removeAll_btn" data-list-id="type-of-nurse-{{ $parts[1] }}-{{ $i }}" id="type-of-nurse-experience-{{ $parts[1] }}-{{ $i }}" name="nurseType[{{$i}}][type_{{ $parts[1] }}][]" id="nurse_type_exp-{{ $i }}-{{ $parts[1] }}" multiple="multiple"></select>
                                <span id="reqsubnursevalid-{{ $parts[1] }}" class="reqError text-danger valley"></span>
                                </div>
                                <div class="subnurse_level-{{ $parts[1] }}"></div>
                            </div>
                            <div class="show_nurse-{{ $parts[1] }}"></div>
                          

                          @endforeach
                          @endif
                        </div>
                        
                        <div class="result--show nurse-res-rex nurse-res-rex-{{ $i }}" style="display:none;">
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
                              if ($data->nurseType != 'null') {
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
                              <div class="nursing_data form-group drp--clr col-md-12 {{ $getn }} drpdown-set nursing_exp_{{ $spl->id }} nursing_exps_{{ $i }}{{ $a }}" id="nursing_level_experience-{{ $a }}-{{$i}}">
                                <label class="form-label nursing_type_label-{{ $i }}{{ $a }}" for="input-2">{{ $spl->name }}</label>
                                <input type="hidden" name="type_nurse_input" class="type_nurse_input type_nurse_input-{{ $i }}" value="{{ $a }}">
                                <ul id="nursing_entry_experience-{{ $i }}{{ $a }}" style="display:none;">
                                  @foreach($nursing_data as $nd)
                                  <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                  @endforeach
                                </ul>
                                <select class="subtype_nurses-{{ $i }} subtype_nurses-{{ $i }}{{ $a }} js-example-basic-multiple addAll_removeAll_btn nur_exp_res_{{ $spl->id }}_{{$i}}" data-list-id="nursing_entry_experience-{{ $i }}{{ $a }}" name="nursing_type_{{ $a }}[{{ $i }}][]" onchange="getAdvancedData({{ $i }})" multiple="multiple"></select>
                                <span id="reqnsubtypenurse-{{ $i }}{{ $a }}" class="reqError text-danger valley"></span>
                              </div>
                              <?php
                              $a++;
                              ?>
                              @endforeach
                            </div>
                          </div>
                        </div>
                        <div class="np_submenu_experience np_submenu_experience_{{$i}} d-none">
                          <input type="hidden" name="np_result_experience" class="np_result_experience_{{$i}}" value="{{ $data->nurse_prac }}">
                          <div class="form-group drp--clr">
                            <?php
                            $np_data = DB::table("practitioner_type")->where('parent', '179')->get();
                            ?>
                            <label class="form-label" for="input-1">Nurse Practitioner (NP):</label>
                            <ul id="nurse_practitioner_menu_experience{{$i}}" style="display:none;">
                              @foreach($np_data as $nd)
                              <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="nurse_prac_valid nurse_prac_valid_{{$i}} js-example-basic-multiple addAll_removeAll_btn nurse_prax_exp_{{$i}}" data-list-id="nurse_practitioner_menu_experience{{$i}}" name="nurse_practitioner_menu_experience[{{$i}}][]" multiple="multiple"></select>
                            <span id="reqnp-{{ $i }}" class="reqError text-danger valley"></span>
                          </div>
                        </div>
                        <div class="condition_set">
                          <div class="form-group drp--clr">
                            @php
                              $specialities_typeExperience = (array)json_decode($data->specialties);
                            @endphp  
                            <input type="hidden" name="speciality_exp_value-{{$i}}" class="speciality_exp-{{$i}}" value="{{ isset($specialities_typeExperience['type_0'])?json_encode($specialities_typeExperience['type_0']):'' }}">
                            <label class="form-label" for="input-1">Specialties</label>
                            
                            
                            <ul id="specialties_type_experience-{{ $i }}-0" style="display:none;">
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
                            <select id="specialties_experienceID" class="js-example-basic-multiple  spec_exp spec_exp_{{$i}} specialties_experience addAll_removeAll_btn exp_spe_type_{{$i}}" index_value="{{ $i}}" data-list-id="specialties_type_experience-{{ $i }}-0" name="specialties_experience[{{ $i }}][type_0][]" multiple="multiple" onchange="getSecialitiesExperience('main',0,{{ $i }})"></select>
                          </div>
                          <span id="reqspecialtiesexp-{{ $i }}" class="reqError text-danger valley"></span>
                        </div>
                        <div class="show_specialitiesExperience-{{ $i }}-0">
                          <input type="hidden" name="subspec_list_experience" class="subspec_list_experience_count" value="{{ $i }}">
                          @php
                            
                            $specTypesExperience = [];
                            if(!empty($specialities_typeExperience)){        
                              foreach ($specialities_typeExperience as $key => $value) {
                                  $parts = explode('_', $key); // ["type", "0"]
                                  
                                  if (isset($parts[1]) && (int)$parts[1] !== 0) {
                                      $specTypesExperience[$key] = $value;
                                  }
                              }
                            }
                          @endphp

                          @if(!empty($specTypesExperience))
                          @foreach($specTypesExperience as $key => $stypes)
                            @php
                              $parts = explode('_', $key);
                              
                              $s_data = json_encode($stypes);

                              $parentId  = getParentSpecialityId($specialities_typeExperience, $parts[1]);
                            @endphp
                            <input type="hidden" name="subspectype" class="subspectype_experience-{{ $i }} subspectype_experience-{{ $parts[1] }}-{{ $i }}" value="{{ $s_data }}">
                            <div class="subspec_main_div_experience subspec_main_div_experience-{{ $parts[1] }}">
                              <?php
                                $sp_data_name = DB::table("speciality")->where('id', $parts[1])->first();
                                $sp_data = DB::table("speciality")->where('parent', $parts[1])->get();
                              ?>
                              <div class="subspec_div subspec_div-{{ $parts[1] }} form-group level-drp">
                              <label class="form-label subspec_label subspec_label-{{ $parts[1] }}" for="input-1">{{ $sp_data_name->name }}</label>
                              
                              <input type="hidden" name="subspec_list_experience" class="subspec_list_experiences-{{ $i }} subspec_list_experiencess-{{ $i }}-{{ $parentId }} subspec_list_experience-{{ $parts[1] }}" value="{{ $parts[1] }}">
                              <ul id="specialties_type_experience-{{ $i }}-{{ $parts[1] }}" style="display:none;">
                                @foreach($sp_data as $sd)
                                <li data-value="{{ $sd->id }}">{{ $sd->name }}</li>
                                @endforeach
                              </ul>
                              <select class="js-example-basic-multiple subspec_valid-{{ $parts[1] }} addAll_removeAll_btn" data-list-id="specialties_type_experience-{{ $i }}-{{ $parts[1] }}" id="specialties_type_exp-{{ $parts[1] }}-{{ $i }}" name="specialties_experience[{{ $i }}][type_{{ $parts[1] }}][]" multiple="multiple" onchange="getSecialitiesExperience('main',{{ $parts[1] }},{{ $i }})"></select>
                              <span id="reqsubspecvalid-{{ $parts[1] }}" class="reqError text-danger valley"></span>
                              </div>
                              <div class="subspec_level-{{ $parts[1] }}"></div>
                              <div class="show_specialitiesStatusExperience-{{ $i }}-{{ $parts[1] }}">
                              <?php
                                $speciality_status = isset($specialities_typeExperience['speciality_status'])?(array)$specialities_typeExperience['speciality_status']:[];
                                

                                
                              ?>

                              @foreach($speciality_status as $key=>$s_status)

                                  <?php
                                    $parts1 = explode('_', $key);
                                    $sp_data_name = DB::table("speciality")->where('id', $parts1[1])->first();
                                    $speciality_status_data = DB::table("speciality_status")->get();
                                  ?>
                                  @if (in_array($parts1[1], $stypes))
                                  <div class="custom-select-wrapper subspecprofdiv subspecdivexp-{{ $parts1[1] }} subspecprofdiv-{{ $parts1[1] }} form-group level-drp" style="margin-bottom: 5px;">
                                    <label class="form-label subspeclabel-{{ $parts1[1] }}" for="input-1">
                                      Specialty Status ({{ $sp_data_name->name }}) 
                                      <span class="info tooltip-btn" tabindex="0" aria-describedby="statusTooltip">ⓘ</span>
                                        <ul class="tooltip_speciality_status" style="padding-left:18px; margin:8px 0 0 0">
                                          <li><strong>Status definitions:</strong></li>
                                          <li><strong>Current:</strong> Actively practicing, used in present or most recent job.</li>
                                          <li><strong>Principal:</strong> Main/strongest specialty (only one allowed).</li>
                                          <li><strong>First:</strong> First-ever specialty after qualification.</li>
                                          <li><strong>Former:</strong> Previously practiced.</li>
                                          <li><strong>Upskilling / Transitioning / Training:</strong> Moving into this specialty.</li>
                                          <li><strong>—</strong> (No status selected — default when nurse doesn’t pick one).</li>
                                        </ul>
                                    </label>
                                    <input type="hidden" name="subspecprof_list" class="subspecprof_list subspecstatusexp_list-{{ $i }}-{{ $parts[1] }} subspecprof_list-{{ $parts1[1] }}" value="{{ $parts1[1] }}">
                                    <select class="custom-select speciality_status_column speciality_status_column-{{ $parts1[1] }} speciality_status_columns-{{ $parts1[1] }} form-input mr-10 select-active langprof_level_valid-{{ $parts1[1] }}" name="specialties_experience[{{ $i }}][speciality_status][type_{{ $parts1[1] }}][status]" onchange="changeSpecialityStatus(this.value,{{ $parts1[1] }})">
                                      <option value="">select</option>
                                      @foreach($speciality_status_data as $s_status_data)
                                      <option value="{{ $s_status_data->status_name }}" @if($s_status_data->status_name == $s_status->status) selected @endif>{{ $s_status_data->status_name }}</option>
                                      @endforeach
                                      
                                    </select>
                                    <input type="hidden" class="speciality_flag-{{ $parts1[1] }} is_current_{{ $parts1[1] }}" name="specialties[speciality_status][type_{{ $parts1[1] }}][is_current]" value="0">
                                    <input type="hidden" class="speciality_flag-{{ $parts1[1] }} is_principal_{{ $parts1[1] }}" name="specialties[speciality_status][type_{{ $parts1[1] }}][is_principal]" value="0">
                                    <input type="hidden" class="speciality_flag-{{ $parts1[1] }} is_first_{{ $parts1[1] }}" name="specialties[speciality_status][type_{{ $parts1[1] }}][is_first]" value="0">
                                    <input type="hidden" class="speciality_flag-{{ $parts1[1] }} is_former_{{ $parts1[1] }}" name="specialties[speciality_status][type_{{ $parts1[1] }}][is_former]" value="0">
                                    <input type="hidden" class="speciality_flag-{{ $parts1[1] }} is_upskilling_{{ $parts1[1] }}" name="specialties[speciality_status][type_{{ $parts1[1] }}][is_upskilling]" value="0">
                                  </div>
                                  
                                  <span id="reqsubspeclevelvalid-{{ $parts1[1] }}" class="reqError text-danger valley"></span>
                                  @endif
                                  
                                  

                              @endforeach
                            </div>
                            </div>
                            
                          

                          @endforeach
                          @endif
                        </div>
                        <div class="speciality_boxes row result--show" style="display:none;">
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
                          
                        </div>
                        <div class="surgical_div_experience_{{$i}}">
                          <input type="hidden" name="surgical_preoperative_result_experience" class="surgical_preoperative_result_experience-{{$i}}" value="{{ $data->surgical_preoperative }}">
                          <div class="surgical_row_data_experience_{{$i}} form-group drp--clr d-none col-md-12 surgicalp_experience-{{ $i }}1">
                            <label class="form-label surgicalprelabel-{{ $i }}1" for="input-1">Surgical Preoperative and Postoperative Care:</label>
                            <?php
                            $speciality_surgicalrow_data = DB::table("speciality")->where('parent', '96')->get();
                            $r = 1;
                            ?>
                            <input type="hidden" name="surgicalp_input" class="surgicalp_input surgicalp_input-{{ $i }}" value="1">
                            <ul id="surgical_row_box_exp_{{$i}}" style="display:none;">
                              @foreach($speciality_surgicalrow_data as $ssrd)
                              <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="surgicalspec-{{ $i }} surgicalspec-{{ $i }}1 js-example-basic-multiple addAll_removeAll_btn sur_exp_{{ $i }} surgical_subtype" data-list-id="surgical_row_box_exp_{{$i}}" index_name="{{$i}}" name="surgical_row_box_experience[{{$i}}][]" multiple="multiple"></select>
                            <span id="reqnsurgicalspecialities-{{ $i }}1" class="reqError text-danger valley"></span>
                          </div>
                        </div>
                        <div class="paediatric_surgical_div_expe_{{ $i }}">
                          <div class="surgicalpad_row_data_exp_{{ $i }} form-group drp--clr d-none col-md-12 surgicalp_experience-{{ $i }}2">
                            <label class="form-label surgicalprelabel-{{ $i }}2" for="input-1">Paediatric Surgical Preop. and Postop. Care:</label>
                            <?php
                            $speciality_padsurgicalrow_data = DB::table("speciality")->where('parent', '285')->get();
                            $r = 1;
                            ?>
                            <input type="hidden" name="surgicalp_input" class="surgicalp_input surgicalp_input-{{$i}}" value="2">
                            <ul id="surgical_rowpad_box_exp_{{$i}}" style="display:none;">
                              @foreach($speciality_padsurgicalrow_data as $ssrd)
                              <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="surgicalspec-{{$i}} surgicalspec-{{$i}}2 js-example-basic-multiple addAll_removeAll_btn  pae_sur_pre pae_sur_preop_{{$i}}" data-list-id="surgical_rowpad_box_exp_{{$i}}" name="surgical_rowpad_box_experience[{{$i}}][]" multiple="multiple" index_name="{{$i}}"></select>
                            <span id="reqnsurgicalspecialities-{{$i}}2" class="reqError text-danger valley"></span>
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
                          <div class="subvaluedata_{{$i}} surgical_row_exp-{{ $w }}-{{$i}} sur_sub_type_{{ $ssd->id }}_{{ $i }} d-none  form-group drp--clr drpdown-set surgicalspeciality_exps_{{ $i }}{{ $w }}">
                            <label class="form-label surgicalspeciality_name_label-{{$i}}{{ $w }}" for="input-1">{{ $ssd->name }}</label>
                            <?php
                            $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->get();
                            ?>
                            <input type="hidden" name="surgical_specialities_input" class="surgical_specialities_input surgical_specialities_input-{{ $i }}" value="{{ $w }}">
                            <ul id="surgical_operative_care_experience-{{ $w }}-{{$i}}" style="display:none;">
                              @foreach($speciality_surgicalsub_data as $sssd)
                              <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="surgicalspecialities-{{$i}} surgicalspecialities-{{$i}}{{ $w }} js-example-basic-multiple addAll_removeAll_btn spec_sub_value_{{ $ssd->id }}_{{$i}}" data-list-id="surgical_operative_care_experience-{{ $w }}-{{$i}}" name="surgical_operative_care_exp_{{ $w }}[{{ $i }}][]" multiple="multiple"></select>
                            <span id="reqsurgicalspecialities-{{$i}}{{ $w }}" class="reqError text-danger valley"></span>
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
                          <div class="surgicalobs_div surgicalobs_row_experience-{{$i}} surgicalobs_row_exp_{{$i}} form-group drp--clr d-none drpdown-set col-md-12">
                            <label class="form-label" for="input-1">Surgical Obstetrics and Gynecology (OB/GYN):</label>
                            <ul id="surgicalobs_row_data_experience_{{$i}}" style="display:none;">
                              @foreach($speciality_surgical_datamater as $ssd)
                              <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="js-example-basic-multiple surgicalobstrics surgicalobstrics-{{$i}} addAll_removeAll_btn surgicalobs_row_{{$i}}" data-list-id="surgicalobs_row_data_experience_{{$i}}" name="surgical_obs_care_exp[{{$i}}][]" multiple="multiple"></select>
                            <span id="reqsurgicalobstrics-{{$i}}" class="reqError text-danger valley"></span>
                          </div>
                          <?php
                          $speciality_surgical_datamater = DB::table("speciality")->where('parent', '250')->get();

                          ?>
                          <div class="neonatal_row_exp_{{$i}} form-group drp--clr drpdown-set d-none col-md-12">
                            <label class="form-label" for="input-1">Neonatal Care:</label>

                            <ul id="neonatal_care_expe{{$i}}" style="display:none;">
                              @foreach($speciality_surgical_datamater as $ssd)
                              <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn neonatal_exp neonatal_exp_{{ $i }}" data-list-id="neonatal_care_expe{{$i}}" name="neonatal_care_experience[{{$i}}][]" multiple="multiple"></select>
                            <span id="reqneonatal-{{ $i }}" class="reqError text-danger valley"></span>
                          </div>
                          <?php
                          $speciality_surgical_datap = DB::table("speciality")->where('parent', '285')->get();
                          $q = 1;
                          ?>
                          @foreach($speciality_surgical_datap as $ssd)
                          <?php
                          if ($data->paedia_surgical_preoperative != 'null') {
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
                          <div class="surgical_rowp_exp_{{$i}} surgicalpad_row_experience-{{ $ssd->id }} surgical_rowp_exp-{{ $q }}-{{$i}} form-group drp--clr {{$getd}} drpdown-set padsurgicalspeciality_exps_{{ $i }}{{ $q }} col-md-4">
                            <label class="form-label padsurgicalspeciality_name_label-{{$i}}{{ $q }}" for="input-1">{{ $ssd->name }}</label>
                            <?php
                            $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->orderBy('name')->get();
                            ?>
                            <input type="hidden" name="surgical_specialities_input" class="padsurgical_specialities_input padsurgical_specialities_input-{{$i}}" value="{{ $q }}">
                            <ul id="surgical_operative_carep_exp-{{ $q }}" style="display:none;">
                              @foreach($speciality_surgicalsub_data as $sssd)
                              <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="padsurgicalspecialities-{{$i}} padsurgicalspecialities-{{$i}}{{ $q }} js-example-basic-multiple addAll_removeAll_btn surgi_{{$ssd->id}}_{{$i}}" data-list-id="surgical_operative_carep_exp-{{ $q }}" name="surgical_operative_carep_experience_{{ $q }}[{{$i}}][]" multiple="multiple"></select>
                            <span id="reqpadsurgicalspecialities-{{$i}}{{ $q }}" class="reqError text-danger valley"></span>
                          </div>
                          <?php
                          $q++;
                          ?>
                          @endforeach
                        </div>
                        <div class="form-group level-drp level_exp_field-{{ $i }}">
                          <label class="form-label" for="input-1">What is your Level of experience in this specialty?
                          </label>
                          <select class="form-input mr-10 select-active reqlevelexp reqlevelexp-{{$i}}" name="exper_assistent_level[{{$i}}]">
                            <option value="select">select</option>
                            @for($l = 1; $l <= 30; $l++)
                              <option value="{{ $l }}" {{ $l == $data->assistent_level ? 'selected' : '' }}>
                              {{ $l }}{{ $l == 1 ? 'st' : ($l == 2 ? 'nd' : ($l == 3 ? 'rd' : 'th')) }}
                              Year
                              </option>
                              @endfor
                          </select>
                          <span id="reqlevelexp-{{$i}}" class="reqError text-danger valley"></span>
                        </div>
                        <!-- <div class="form-group level-drp">
                          
                          <label class="form-label" for="input-1">Position Held</label>
                          <?php
                            $employee_postion_data = DB::table('employee_positions')->where("position_id","!=","35")->where("subposition_id",0)->orderBy("position_name","asc")->get();
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
                          <select class="js-example-basic-multiple addAll_removeAll_btn pos_held pos_held_{{ $i }}" data-list-id="position_held_field-{{ $i }}" name="positions_held[{{ $i }}]" id="position_held_field-{{ $i }}" multiple onchange="getPostions('',{{ $i }})"></select>
                          <span id="reqpositionheld-{{$i}}" class="reqError text-danger valley"></span>
                        
                        </div> -->
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group level-drp">
                              <label class="form-label" for="input-1">Employment Start Date</label>
                              <input class="form-control employeement_start_date_exp employeement_start_date_exp-{{$i}}" value="{{ $data->employeement_start_date }}" type="date" name="start_date[{{$i}}]" onchange="changeEmployeementEndDate('{{$i}}')">
                              <span id="reqempsdateexp-{{$i}}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="declaration_box mt-2 mb-2">
                              <input class="currently_position currently_position-{{$i}}" type="checkbox" name="present_box[{{$i}}]" value="{{ $data->pre_box_status }}" {{ ($data->pre_box_status == 1) ? 'checked' : '' }} onclick="currently_position_1('{{ $i }}')">I am currently in this position at the moment
                            </div>
                          </div>
                          <div class="col-md-6 empl_end_date-{{$i}} {{ ($data->pre_box_status == 1) ? 'd-none' : '' }} ">
                            <div class="form-group level-drp">
                              <label class="form-label" for="input-1">Employment End Date</label>
                              <input class="form-control employeement_end_date_exp employeement_end_date_exp-{{$i}}" type="date" value="{{ $data->employeement_end_date }}" name="end_date[{{ $i }}]">
                              <span id="reqemployeementenddateexp-{{$i}}" class="reqError text-danger valley"></span>
                            </div>
                          </div>
                          
                             <?php
                              $employee_type_data = DB::table('employeement_type_preferences')->where("sub_prefer_id",0)->get();
                              
                              if(!empty($data->employeement_type)){
                                  $emp_data = (array)json_decode($data->employeement_type);
                              }else{
                                  $emp_data = array();
                              }
                              
                              //print_r($emp_data);

                              $emparr = array();

                              foreach ($emp_data as $index => $edata){
                                  $emparr[] = $index;
                              }
                              
                              
                              $x = 1;
                              $em_arr = json_encode($emparr);
                          ?>
                          <div class="form-group level-drp">
                            <label class="form-label" for="input-1">Employment type</label>
                            <input type="hidden" class="mainemptypedata mainemptypedata-{{ $i }}" value='<?php echo $em_arr; ?>'>
                            
                            <ul id="employeement_type_experience-{{ $i }}" style="display:none;">
                              @if(!empty($employeement_type_preferences))
                              @foreach($employeement_type_preferences as $emptype_data)
                              <li data-value="{{ $emptype_data->emp_prefer_id }}">{{ $emptype_data->emp_type }}</li>
                              @endforeach
                              @endif
                              
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn employeement_type_exp employeement_type_exp-{{ $i }}" data-list-id="employeement_type_experience-{{$i}}" name="employeement_type[{{$i}}]" multiple onchange="showEmpType(this.value,{{ $i }},'')"></select>
                          </div>  
                          
                          <div class="show_emp_data-{{ $i }}">
                            <?php
                              $emptypedata = (array)json_decode($data->employeement_type);
                            ?>
                            @if(!empty($emptypedata))
                            @foreach($emptypedata as $index=>$emptype)
                            <?php
                              $empname = DB::table("employeement_type_preferences")->where("emp_prefer_id",$index)->first();
                              $subemptypedata = DB::table("employeement_type_preferences")->where("sub_prefer_id",$index)->get();
                            ?>
                            <div class="emptype_main_div emptype_main_div-{{ $index }}">
                              <div class="emptypediv emptypediv-{{ $index }} form-group level-drp">
                                <label class="form-label emptype_label emptype_label-{{ $index }}" for="input-1">{{ $empname->emp_type }}</label>
                                <input type="hidden" class="subemptype-{{ $index }}" value='<?php echo json_encode($emptype); ?>'>
                                <input type="hidden" class="subemptypeid-{{ $i }}" value='<?php echo $index; ?>'>
                                <input type="hidden" name="subrefer_list" class="subrefer_list" value="{{ $empname->emp_prefer_id }}">
                                <ul id="emptype_field-{{ $index }}" style="display:none;">
                                  @if(!empty($subemptypedata))
                                  @foreach($subemptypedata as $subemptype_data)
                                  <?php
                                    $subemptype_data_name = DB::table("employeement_type_preferences")->where("emp_prefer_id",$subemptype_data->emp_prefer_id)->first();
                                    

                                  ?>
                                  <li data-value="{{ $subemptype_data->emp_prefer_id }}">{{ $subemptype_data_name->emp_type }}</li>  
                                  @endforeach
                                  @endif
                                </ul>
                                <select class="js-example-basic-multiple addAll_removeAll_btn emptype_valid-1" data-list-id="emptype_field-{{ $index }}" name="emptypelevel[{{ $i }}][{{ $index }}][]" multiple></select>
                                <span id="reqemptype-1" class="reqError text-danger valley"></span>
                              </div>
                            </div>
                            @endforeach
                            @endif
                          </div> 
                          <h6 class="emergency_text">
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

                          <div class="form-group level-drp @if($data->inter_and_em_skill == 'null') d-none @endif interpersonal_{{$i}} analy_skill_{{ $i }}8">
                            <input type="hidden" value="{{ $data->inter_and_em_skill }}" id="inter_and_em_skill{{ $i }}">
                            <label class="form-label analy_skill_label-{{ $i }}8" for="input-1">Interpersonal and Emotional Skills</label>
                            <?php
                            $skills = DB::table("skills")->where("parent_id", "8")->get();
                            ?>
                            <input type="hidden" value="8" class="area_skills-{{ $i }}">
                            <ul id="inter_and_em_skill" style="display:none;">
                              @foreach($skills as $cert)
                              <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                              @endforeach
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn spc_comp spc_comp-{{ $i }}8 inter_and_em_skill_{{ $i }}" data-list-id="inter_and_em_skill" name="sub_skills_compantancies-8[{{$i}}][]" multiple="multiple"></select>
                            <span id="reqanaskills-{{ $i }}8" class="reqError text-danger valley"></span>
                          </div>
                          

                          <div class="form-group level-drp @if($data->org_and_any_skill == 'null') d-none @endif analy_skill_{{$i}} analy_skill_{{ $i }}9">
                            <input type="hidden" value="{{ $data->org_and_any_skill }}" id="org_and_any_skill{{ $i }}">
                            <label class="form-label analy_skill_label-{{ $i }}9" for="input-1">Organizational and Analytical Skills</label>
                            <?php
                            $skills = DB::table("skills")->where("parent_id", "9")->get();
                            ?>
                            <input type="hidden" value="9" class="area_skills-{{ $i }}">
                            <ul id="org_and_any_skill" style="display:none;">
                              @foreach($skills as $cert)
                              <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                              @endforeach
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn spc_comp spc_comp-{{ $i }}9 org_and_any_skill_{{ $i }}" data-list-id="org_and_any_skill" name="sub_skills_compantancies-9[{{$i}}][]" multiple="multiple"></select>
                            <span id="reqanaskills-{{ $i }}9" class="reqError text-danger valley"></span>
                          </div>
                          

                          <div class="form-group level-drp @if($data->lead_and_ment_skill === 'null') d-none @endif leader_skill_{{$i}} analy_skill_{{$i}}10">
                            <input type="hidden" value="{{ $data->lead_and_ment_skill }}" id="lead_and_ment_skill_{{ $i }}">
                            <label class="form-label analy_skill_label-{{ $i }}10" for="input-1">Leadership and Mentorship Skills</label>
                            <?php
                            $skills = DB::table("skills")->where("parent_id", "10")->get();
                            ?>
                            <input type="hidden" value="10" class="area_skills-{{ $i }}">
                            <ul id="lead_and_ment_skill1" style="display:none;">
                              @foreach($skills as $cert)
                              <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                              @endforeach
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn spc_comp spc_comp-{{ $i }}10 lead_and_ment_skill_{{ $i }}" data-list-id="lead_and_ment_skill1" name="sub_skills_compantancies-10[{{$i}}][]" multiple="multiple"></select>
                            <span id="reqanaskills-{{ $i }}10" class="reqError text-danger valley"></span>
                          </div>
                          

                          <div class="form-group level-drp  @if($data->tech_and_soft_pro == 'null')  d-none @endif tech_skill_{{$i}} analy_skill_{{$i}}11">
                            <input type="hidden" value="{{ $data->tech_and_soft_pro }}" id="tech_and_soft_pro_{{ $i }}">
                            <label class="form-label analy_skill_label-{{ $i }}11" for="input-1">Technology and Software Proficiency</label>
                            <?php
                            $skills = DB::table("skills")->where("parent_id", "11")->get();
                            ?>
                            <input type="hidden" value="11" class="area_skills-{{ $i }}">
                            <ul id="tech_and_soft_pro" style="display:none;">
                              @foreach($skills as $cert)
                              <li data-value="{{ $cert->id }}">{{ $cert->name }}</li>
                              @endforeach
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn spc_comp spc_comp-{{ $i }}11 tech_and_soft_pro{{ $i }}" data-list-id="tech_and_soft_pro" name="sub_skills_compantancies-11[{{$i}}][]" multiple="multiple"></select>
                            <span id="reqanaskills-{{ $i }}11" class="reqError text-danger valley"></span>
                          </div>
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
                            $user_id = Auth::guard('nurse_middle')->user()->id;
                            $getid = $data->experience_id;
                            ?>
                            <label class="form-label" for="input-1">Upload evidence</label>
                            <input class="form-control upload_evidence-{{ $i }}" type="file" name="" onchange="changeExpEvidenceImg({{ Auth::guard('nurse_middle')->user()->id }},{{ $i }},{{ $getid }})" multiple="" id="{{ $i }}">
                            <input type="hidden" class="old_files-{{ $i }}" name="upload_evidence[{{$i}}]" value="{{ $data->upload_evidence }}">
                            <div class="fileList  fileList_{{ $i }}">
                              @if(!empty($data) && ($data->upload_evidence))
                              <?php
                              $evi_img = json_decode($data->upload_evidence);

                              $m = 0;
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              
                              ?>
                              @if(!empty($evi_img))
                              @foreach($evi_img as $tranimg)
                              <div class="trans_img trans_img-{{ $m }}">
                                <a href="{{ url('/public/uploads/evidence') }}/{{ $tranimg }}" target="_blank"><i class="fa fa-file"></i>{{ $tranimg }}</a>
                                <div class="close_btn close_btn-{{ $i }}" onclick="deletevdiImg('{{ $i }}','{{ $m }}','{{ $user_id }}','{{ $tranimg }}','{{ $getid }}')" style="cursor: pointer;"><i class="fa fa-close"></i></div>
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
                      @else
                      <div class="work_exp exp_tab-1">
                        <div class="condition_set">
                          <h6 class="emergency_text previous_employeers_head">
                            Work Experience 1
                          </h6>
                          <div class="form-group level-drp">
                          
                            <label class="form-label" for="input-1">Facility / Workplace Type</label>
                            <?php
                              $user_id = Auth::guard('nurse_middle')->user()->id;
                              $workplace_data = DB::table('work_enviornment_preferences')->where("prefer_id","!=","444")->where("sub_env_id",0)->orderBy("env_name","asc")->get();
                              
                              
                            ?>
                            
                            <ul id="wp_data-1" style="display:none;">
                             
                              @if(!empty($workplace_data))
                              @foreach($workplace_data as $wp_data)
                              <li data-value="{{ $wp_data->prefer_id }}">{{ $wp_data->env_name }}</li>
                              @endforeach
                              @endif
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn facworktype facworktype-1" data-list-id="wp_data-1" name="positions_held[1]" multiple onchange="getWpData('',1)"></select>
                            <span id="reqfacworktype-1" class="reqError text-danger valley"></span>
                          
                          </div>
                          <div class="wp_data-1"></div>
                          <div class="form-group level-drp">
                            <label class="form-label" for="input-1">Facility / Workplace Name</label>
                            <input type="text" name="facility_workplace_name[1]" class="form-control facworkname facworkname-1" value="{{ $data->facility_workplace_name }}">
                            <span id="reqfaceworkname-1" class="reqError text-danger valley"></span>
                          </div>  
                          <div class="form-group drp--clr nurse_exp_type nurse_exp_type-1">
                            <label class="form-label" for="input-1">Type of Nurse?</label>
                            @php
                              $user_data = Auth::guard('nurse_middle')->user();
                              $nurse_data = (array)json_decode($user_data->nurse_data);
                              $ndata = json_encode($nurse_data['type_0']);
                              //print_r($ndata);
                            @endphp
                            <input type="hidden" name="user_id" class="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                            <input type="hidden" name="type_nurse" class="type_nurse_ep-1" value="{{ $ndata }}">
                            <ul id="type-of-nurse-experience-1-0" style="display:none;">
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
                            <select class="js-example-basic-multiple addAll_removeAll_btn nurse_type_exp nurse_type_exp_1" data-list-id="type-of-nurse-experience-1-0" name="nurseType[1][type_0][]" id="nurse_type_exp-1-0" onchange="getNurseTypeExperience('main',0,1)" multiple="multiple"></select>
                            <span id="reqnurseTypeexpId-1" class="reqError text-danger valley"></span>
                          </div>
                          <div class="showNurseTypeExperience-1-0">
                              <input type="hidden" name="nursetype_list_experience_count" class="nursetype_list_experience_count" value="1">
                              @php
                                $nurse_typeExperience = json_decode($user_data->nurse_data);
                                $nurseTypesExperience = [];
                                if(!empty($nurse_typeExperience)){        
                                  foreach ($nurse_typeExperience as $key => $value) {
                                      $parts = explode('_', $key); // ["type", "0"]
                                      
                                      if (isset($parts[1]) && (int)$parts[1] !== 0) {
                                          $nurseTypesExperience[$key] = $value;
                                      }
                                  }
                                }
                              @endphp

                              @if(!empty($nurseTypesExperience))
                              @foreach($nurseTypesExperience as $key => $ntypes)
                                @php
                                  $parts = explode('_', $key);
                                  
                                  $n_data = json_encode($ntypes);
                                @endphp
                                
                                <div class="subnurse_main_div subnurse_main_div-{{ $parts[1] }}">
                                    <?php
                                      $np_data_name = DB::table("practitioner_type")->where('id', $parts[1])->first();
                                      $np_data = DB::table("practitioner_type")->where('parent', $parts[1])->get();
                                    ?>
                                    <input type="hidden" name="subnursetype" class="subnursetype_experiences-{{ $parts[1] }}-1" value="{{ $n_data }}">
                                    <div class="subnurse_div subnurse_div-{{ $parts[1] }} form-group level-drp">
                                    <label class="form-label subnurse_label subnurse_label-{{ $parts[1] }}" for="input-1">{{ $np_data_name->name }}</label>
                                    <input type="hidden" name="subnurse_list" class="subnurse_list_experiences-1 subnurse_list_experience-{{ $parts[1] }}" value="{{ $parts[1] }}">
                                    <ul id="type-of-nurse-{{ $parts[1] }}-1" style="display:none;">
                                      @foreach($np_data as $nd)
                                      <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                      @endforeach
                                    </ul>
                                    <select class="js-example-basic-multiple subnurse_valid-{{ $parts[1] }} addAll_removeAll_btn" data-list-id="type-of-nurse-{{ $parts[1] }}-1" id="type-of-nurse-experience-{{ $parts[1] }}-1" name="nurseType[1][type_{{ $parts[1] }}][]" id="nurse_type_exp-1-{{ $parts[1] }}" multiple="multiple"></select>
                                    <span id="reqsubnursevalid-{{ $parts[1] }}" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="subnurse_level-{{ $parts[1] }}"></div>
                                </div>
                                <div class="show_nurse-{{ $parts[1] }}"></div>
                              

                              @endforeach
                              @endif
                            </div>

                          </div>

                          </div>
                        </div>
                        <div class="result--show result_show_nurse">
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
                              <input type="hidden" name="nursing_result_experience2" class="nursing_result_experience-{{ $i }}" value="{{ $spl->id }}">
                              <div class="nursing_data form-group drp--clr col-md-12 d-none drpdown-set nursing_exp_{{ $spl->id }} nursing_exps_1{{ $i }}" id="nursing_level_experience-{{ $i }}">
                                <label class="form-label nursing_type_label-1{{ $i }}" for="input-2">{{ $spl->name }}</label>
                                <input type="hidden" name="type_nurse_input" class="type_nurse_input type_nurse_input-1" value="{{ $i }}">
                                <ul id="nursing_entry_experience-{{ $i }}" style="display:none;">
                                  @foreach($nursing_data as $nd)
                                  <li data-value="{{ $nd->id }}">{{ $nd->name }}</li>
                                  @endforeach
                                </ul>
                                <select class="subtype_nurses-1 subtype_nurses-1{{ $i }} js-example-basic-multiple addAll_removeAll_btn" data-list-id="nursing_entry_experience-{{ $i }}" name="nursing_type_{{ $i }}[1][]" multiple="multiple"></select>
                                <span id="reqnsubtypenurse-1{{ $i }}" class="reqError text-danger valley"></span>
                              </div>
                              <?php
                              $i++;
                              ?>
                              @endforeach
                            </div>
                          </div>
                        </div>
                        <div class="np_submenu_experience np_submenu_experience_1 d-none">
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
                            <select class="nurse_prac_valid nurse_prac_valid_1 js-example-basic-multiple addAll_removeAll_btn" data-list-id="nurse_practitioner_menu_experience" name="nurse_practitioner_menu_experience[1][]" multiple="multiple"></select>
                            <span id="reqnp-1" class="reqError text-danger valley"></span>
                          </div>
                        </div>
                        <div class="condition_set">
                          <div class="form-group drp--clr">
                            <label class="form-label" for="input-1">Specialties</label>
                            @php
                              $specialities_typeExperience = (array)json_decode($user->specialties);
                              $specialties_data = isset($specialities_typeExperience['type_0'])?json_encode($specialities_typeExperience['type_0']):'';
                              //print_r($specialties_data);
                            @endphp 
                            <input type="hidden" name="speciality_exp_value-1" class="speciality_exp-1" value="{{ $specialties_data }}">
                            <ul id="specialties_type_experience-1-0" style="display:none;">
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
                            <select class="js-example-basic-multiple addAll_removeAll_btn spec_exp spec_exp_1 specialties_experience exp_spe_type_1" data-list-id="specialties_type_experience-1-0" name="specialties_experience[1][type_0][]" multiple="multiple" onchange="getSecialitiesExperience('main',0,1)"></select>
                            <span id="reqspecialtiesexp-1" class="reqError text-danger valley"></span>
                          </div>
                          
                        </div>
                        <div class="show_specialitiesExperience-1-0">
                          <input type="hidden" name="subspec_list_experience" class="subspec_list_experience_count" value="1">
                          @php
                            
                            $specTypesExperience = [];
                            if(!empty($specialities_typeExperience)){        
                              foreach ($specialities_typeExperience as $key => $value) {
                                  $parts = explode('_', $key); // ["type", "0"]
                                  
                                  if (isset($parts[1]) && (int)$parts[1] !== 0) {
                                      $specTypesExperience[$key] = $value;
                                  }
                              }
                            }
                          @endphp

                          @if(!empty($specTypesExperience))
                          @foreach($specTypesExperience as $key => $stypes)
                            @php
                              $parts = explode('_', $key);
                              
                              $s_data = json_encode($stypes);

                              $parentId  = getParentSpecialityId($specialities_typeExperience, $parts[1]);
                            @endphp
                            
                            <input type="hidden" name="subspectype" class="subspectype_experience-1 subspectype_experience-{{ $parts[1] }}-1" value="{{ $s_data }}">
                            <div class="subspec_main_div_experience subspec_main_div_experience-{{ $parts[1] }}">
                              <?php
                                $sp_data_name = DB::table("speciality")->where('id', $parts[1])->first();
                                $sp_data = DB::table("speciality")->where('parent', $parts[1])->get();
                              ?>
                              <div class="subspec_div subspec_div-{{ $parts[1] }} form-group level-drp">
                              <label class="form-label subspec_label subspec_label-{{ $parts[1] }}" for="input-1">{{ $sp_data_name->name }}</label>
                              
                              <input type="hidden" name="subspec_list_experience" class="subspec_list_experiences-1 subspec_list_experiencess-1-{{ $parentId }} subspec_list_experience-{{ $parts[1] }}" value="{{ $parts[1] }}">
                              <ul id="specialties_type_experience-1-{{ $parts[1] }}" style="display:none;">
                                @foreach($sp_data as $sd)
                                <li data-value="{{ $sd->id }}">{{ $sd->name }}</li>
                                @endforeach
                              </ul>
                              <select class="js-example-basic-multiple subspec_valid-{{ $parts[1] }} addAll_removeAll_btn" data-list-id="specialties_type_experience-1-{{ $parts[1] }}" id="specialties_type_exp-{{ $parts[1] }}-1" name="specialties_experience[1][type_{{ $parts[1] }}][]" multiple="multiple" onchange="getSecialitiesExperience('main',{{ $parts[1] }},1)"></select>
                              <span id="reqsubspecvalid-{{ $parts[1] }}" class="reqError text-danger valley"></span>
                              </div>
                              <div class="subspec_level-{{ $parts[1] }}"></div>
                            
                              <div class="show_specialitiesStatusExperience-{{ $parts[1] }}">
                                  <?php
                                    
                                    $speciality_status = isset($specialities_typeExperience['speciality_status'])?(array)$specialities_typeExperience['speciality_status']:[];
                                    //print_r($specialities_type['speciality_status']);

                                    //print_r($speciality_status);
                                  ?>

                                  @foreach($speciality_status as $key=>$s_status)

                                      <?php
                                        $parts1 = explode('_', $key);
                                        $sp_data_name = DB::table("speciality")->where('id', $parts1[1])->first();
                                        $speciality_status_data = DB::table("speciality_status")->get();
                                        
                                      ?>
                                      @if (in_array($parts1[1], $stypes))
                                      <div class="custom-select-wrapper subspecprofdiv subspecprofdiv-{{ $parts1[1] }} form-group level-drp" style="margin-bottom: 5px;">
                                        <label class="form-label subspeclabel-{{ $parts1[1] }}" for="input-1">
                                          Specialty Status ({{ $sp_data_name->name }}) 
                                          <span class="info tooltip-btn" tabindex="0" aria-describedby="statusTooltip">ⓘ</span>
                                          
                                            <ul class="tooltip_speciality_status" style="padding-left:18px; margin:8px 0 0 0">
                                              <li><strong>Status definitions:</strong></li>
                                              <li><strong>Current:</strong> Actively practicing, used in present or most recent job.</li>
                                              <li><strong>Principal:</strong> Main/strongest specialty (only one allowed).</li>
                                              <li><strong>First:</strong> First-ever specialty after qualification.</li>
                                              <li><strong>Former:</strong> Previously practiced.</li>
                                              <li><strong>Upskilling / Transitioning / Training:</strong> Moving into this specialty.</li>
                                              <li><strong>—</strong> (No status selected — default when nurse doesn’t pick one).</li>
                                            </ul>
                                          
                                        </label>
                                        <input type="hidden" name="subspecprof_list" class="subspecprof_list subspecprof_listProfession subspecprof_listProfession-{{ $parts1[1] }} subspecprof_list-{{ $parts1[1] }}" value="{{ $parts1[1] }}">
                                        <input type="hidden" name="subspecprof_list" class="subspecprofpart_list subspecprofpart_list-{{ $parts[1] }}" value="{{ $parts1[1] }}">
                                        <select class="custom-select speciality_status_column speciality_status_column-{{ $parts[1] }} speciality_status_columns-{{ $parts1[1] }} form-input mr-10 langprof_level_valid-{{ $parts1[1] }}" name="specialties_experience[1][speciality_status][type_{{ $parts1[1] }}][status]" onchange="changeSpecialityStatus(this.value,{{ $parts1[1] }},{{ $parts[1] }})">
                                          <option value="">select</option>
                                          @foreach($speciality_status_data as $s_status_data)
                                        
                                          <option value="{{ $s_status_data->status_name }}" @if($s_status_data->status_name == $s_status->status) selected @endif>{{ $s_status_data->status_name }}</option>
                                          @endforeach
                                          
                                        </select>
                                        <input type="hidden" class="speciality_flag-{{ $parts1[1] }} is_current_{{ $parts1[1] }}" name="specialties[speciality_status][type_{{ $parts1[1] }}][is_current]" value="0">
                                        <input type="hidden" class="speciality_flag-{{ $parts1[1] }} is_principal_{{ $parts1[1] }}" name="specialties[speciality_status][type_{{ $parts1[1] }}][is_principal]" value="0">
                                        <input type="hidden" class="speciality_flag-{{ $parts1[1] }} is_first_{{ $parts1[1] }}" name="specialties[speciality_status][type_{{ $parts1[1] }}][is_first]" value="0">
                                        <input type="hidden" class="speciality_flag-{{ $parts1[1] }} is_former_{{ $parts1[1] }}" name="specialties[speciality_status][type_{{ $parts1[1] }}][is_former]" value="0">
                                        <input type="hidden" class="speciality_flag-{{ $parts1[1] }} is_upskilling_{{ $parts1[1] }}" name="specialties[speciality_status][type_{{ $parts1[1] }}][is_upskilling]" value="0">
                                      </div>
                                      
                                      <span id="reqsubspeclevelvalid-{{ $parts1[1] }}" class="reqError text-danger valley"></span>
                                      @endif
                                      
                                      

                                  @endforeach
                              </div>
                            </div>

                          @endforeach
                          @endif
                        </div>
                        
                        <div class="speciality_boxes row result--show">
                          <?php
                          $l = 1;
                          ?>
                          @foreach($JobSpecialties as $ptl)
                          <?php
                          $speciality_data = DB::table("speciality")->where('parent', $ptl->id)->get();
                          ?>
                          <input type="hidden" name="speciality_result" class="speciality_result_experience-{{ $l }} " value="{{ $ptl->id }}">
                          <div class="speciality_data form-group drp--clr drpdown-set d-none col-md-6 speciality_y_{{ $ptl->id }} speciality_exps_1{{ $l }}" id="specility_level_experience-{{ $l }}">
                            <label class="form-label speciality_name_label-1{{ $l }}" for="input-2">{{ $ptl->name }}</label>
                            <input type="hidden" name="type_specialities_input" class="type_specialities_input type_specialities_input-1" value="{{ $l }}">
                            <ul id="speciality_entry_experience-{{ $l }}" style="display:none;">
                              @foreach($speciality_data as $sd)
                              <li data-value="{{ $sd->id }}">{{ $sd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="subspecialities-1 subspecialities-1{{ $l }} js-example-basic-multiple addAll_removeAll_btn" data-list-id="speciality_entry_experience-{{ $l }}" name="speciality_entry_experience_{{ $l }}[1][]" multiple="multiple"></select>
                            <span id="reqnsubspecialities-1{{ $l }}" class="reqError text-danger valley"></span>
                          </div>
                          <?php
                          $l++;
                          ?>
                          @endforeach
                        </div>
                        
                        <div class="specialty_entry_one_experience"></div>
                        <div class="specialty_entry_two_experience"></div>
                        <div class="surgical_div_experience">
                          <div class="surgical_row_data_experience form-group drp--clr d-none col-md-12 surgicalp_experience-11">
                            <label class="form-label surgicalprelabel-11" for="input-1">Surgical Preoperative and Postoperative Care:</label>
                            <?php
                            $speciality_surgicalrow_data = DB::table("speciality")->where('parent', '96')->get();
                            $r = 1;
                            ?>
                            <input type="hidden" name="surgicalp_input" class="surgicalp_input surgicalp_input-1" value="1">
                            <ul id="surgical_row_box_experience" style="display:none;">
                              @foreach($speciality_surgicalrow_data as $ssrd)
                              <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="surgicalspec-1 surgicalspec-11 js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_row_box_experience" name="surgical_row_box_experience[1][]" multiple="multiple"></select>
                            <span id="reqnsurgicalspecialities-11" class="reqError text-danger valley"></span>
                          </div>
                        </div>
                        <div class="paediatric_surgical_div_experience">
                          <div class="surgicalpad_row_data_experience form-group drp--clr d-none col-md-12 surgicalp_experience-12">
                            <label class="form-label surgicalprelabel-12" for="input-1">Paediatric Surgical Preop. and Postop. Care:
                            </label>
                            <?php
                            $speciality_padsurgicalrow_data = DB::table("speciality")->where('parent', '285')->get();
                            $r = 1;
                            ?>
                            <input type="hidden" name="surgicalp_input" class="surgicalp_input surgicalp_input-1" value="2">
                            <ul id="surgical_rowpad_box_experience" style="display:none;">
                              @foreach($speciality_padsurgicalrow_data as $ssrd)
                              <li data-value="{{ $ssrd->id }}">{{ $ssrd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="surgicalspec-1 surgicalspec-12 js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_rowpad_box_experience" name="surgical_rowpad_box_experience[1][]" multiple="multiple"></select>
                            <span id="reqnsurgicalspecialities-12" class="reqError text-danger valley"></span>
                          </div>
                        </div>
                        
                        <div class="specialty_sub_boxes_experience row">
                          <?php
                          $speciality_surgical_data = DB::table("speciality")->where('parent', '96')->get();
                          $w = 1;
                          ?>
                          @foreach($speciality_surgical_data as $ssd)
                          <input type="hidden" name="speciality_result" class="speciality_surgical_result_experience-{{ $w }}" value="{{ $ssd->id }}">
                          <div class="surgical_row_experience-{{ $w }} surgicalopcboxes1-{{ $ssd->id }} form-group drp--clr d-none drpdown-set surgicalspeciality_exps_1{{ $w }}">
                            <label class="form-label surgicalspeciality_name_label-1{{ $w }}" for="input-1">{{ $ssd->name }}</label>
                            <?php
                            $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->get();
                            ?>
                            <input type="hidden" name="surgical_specialities_input" class="surgical_specialities_input surgical_specialities_input-1" value="{{ $w }}">
                            <ul id="surgical_operative_care_experience-{{ $w }}" style="display:none;">
                              @foreach($speciality_surgicalsub_data as $sssd)
                              <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="surgicalspecialities-1 surgicalspecialities-1{{ $w }} js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_operative_care_experience-{{ $w }}" name="surgical_operative_care_exp_{{ $w }}[1][]" multiple="multiple"></select>
                            <span id="reqsurgicalspecialities-1{{ $w }}" class="reqError text-danger valley"></span>
                            @foreach($speciality_surgicalsub_data as $sssd)
                            <div class="d-none form-group level-drp level_id-{{ $sssd->id }}">
                              <label class="form-label" for="input-1">What is your Level of experience in {{ $sssd->name }}:
                              </label>
                              <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                              <select class="form-input mr-10 select-active" name="assistent_level[1][]">
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
                          <div class="surgicalobs_row_experience surgicalobs_row_experience-1 form-group drp--clr d-none drpdown-set col-md-12">
                            <label class="form-label" for="input-1">Surgical Obstetrics and Gynecology (OB/GYN):</label>

                            <ul id="surgicalobs_row_data_experience" style="display:none;">
                              @foreach($speciality_surgical_datamater as $ssd)
                              <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="js-example-basic-multiple surgicalobstrics surgicalobstrics-1 addAll_removeAll_btn" data-list-id="surgicalobs_row_data_experience" name="surgical_obs_care_exp[1][]" multiple="multiple"></select>
                            <span id="reqsurgicalobstrics-1" class="reqError text-danger valley"></span>
                          </div>
                          <?php
                          $speciality_surgical_datamater = DB::table("speciality")->where('parent', '250')->get();

                          ?>
                          <div class="neonatal_row_exp_1 form-group drp--clr drpdown-set d-none col-md-12 surgicalp_experience-13">
                            <label class="form-label surgicalprelabel-13" for="input-1">Neonatal Care:</label>
                            {{-- <input type="hidden" name="surgicalp_input" class="surgicalp_input surgicalp_input-1" value="3"> --}}
                            <ul id="neonatal_care_experience" style="display:none;">
                              @foreach($speciality_surgical_datamater as $ssd)
                              <li data-value="{{ $ssd->id }}">{{ $ssd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="surgicalspec-1 surgicalspec-13 js-example-basic-multiple neonatal_exp neonatal_exp_1 addAll_removeAll_btn" data-list-id="neonatal_care_experience" name="neonatal_care_experience[1][]" multiple="multiple"></select>
                            <span id="reqneonatal-1" class="reqError text-danger valley"></span>
                          </div>
                          <div class="neonatal_care_experience_level"></div>
                          <?php
                          $speciality_surgical_datap = DB::table("speciality")->where('parent', '285')->get();
                          $q = 1;
                          ?>
                          @foreach($speciality_surgical_datap as $ssd)
                          <input type="hidden" name="speciality_result" class="surgical_rowp_result_experience-{{ $q }}" value="{{ $ssd->id }}">
                          <div class="surgical_rowp_experience surgicalpad_row_experience-{{ $ssd->id }} surgical_rowp_experience-{{ $q }} form-group drp--clr d-none drpdown-set padsurgicalspeciality_exps_1{{ $q }} col-md-4">
                            <label class="form-label padsurgicalspeciality_name_label-1{{ $q }}" for="input-1">{{ $ssd->name }}</label>
                            <?php
                            $speciality_surgicalsub_data = DB::table("speciality")->where('parent', $ssd->id)->orderBy('name')->get();
                            ?>
                            <input type="hidden" name="surgical_specialities_input" class="padsurgical_specialities_input padsurgical_specialities_input-1" value="{{ $q }}">
                            <ul id="surgical_operative_carep_experience-{{ $q }}" style="display:none;">
                              @foreach($speciality_surgicalsub_data as $sssd)
                              <li data-value="{{ $sssd->id }}">{{ $sssd->name }}</li>
                              @endforeach
                            </ul>
                            <select class="padsurgicalspecialities-1 padsurgicalspecialities-1{{ $q }} js-example-basic-multiple addAll_removeAll_btn" data-list-id="surgical_operative_carep_experience-{{ $q }}" name="surgical_operative_carep_experience_{{ $q }}[1][]" multiple="multiple"></select>
                            <span id="reqpadsurgicalspecialities-1{{ $q }}" class="reqError text-danger valley"></span>
                          </div>
                          <?php
                          $q++;
                          ?>
                          @endforeach
                          <div class="surgical_operative_carep_level_one"></div>
                          <div class="surgical_operative_carep_level_two"></div>
                          <div class="surgical_operative_carep_level_three"></div>
                        </div>
                        <div class="form-group level-drp level_exp_field-1">
                          <label class="form-label" for="input-1">What is your Level of experience in this specialty?
                          </label>
                          
                          <select class="form-input mr-10 select-active reqlevelexp reqlevelexp-1" name="exper_assistent_level[1]">
                            <option value="select">select</option>
                            @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                              @endfor
                          </select>
                          <span id="reqlevelexp-1" class="reqError text-danger valley"></span>
                        </div>
                        <!-- <div class="form-group level-drp">
                          
                          <label class="form-label" for="input-1">Position Held</label>
                          <?php
                            $employee_postion_data = DB::table('employee_positions')->where("position_id","!=","35")->where("subposition_id",0)->orderBy("position_name","asc")->get();
                            
                          ?>
                          
                          <ul id="position_held_field-1" style="display:none;">
                           
                            @if(!empty($employee_postion_data))
                            @foreach($employee_postion_data as $emp_data)
                            <li data-value="{{ $emp_data->position_id }}">{{ $emp_data->position_name }}</li>
                            @endforeach
                            @endif
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn pos_held pos_held_1" data-list-id="position_held_field-1" name="positions_held[1]" id="position_held_field-1" multiple onchange="getPostions('',1)"></select>
                          <span id="reqpositionheld-1" class="reqError text-danger valley"></span>
                        
                        </div> -->
                        <div class="show_positions-1"></div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group level-drp">
                              <label class="form-label" for="input-1">Employment Start Date</label>
                              <input class="form-control employeement_start_date_exp employeement_start_date_exp-1" type="date" name="start_date[1]" onchange="changeEmployeementEndDate(1)">
                              <span id="reqempsdateexp-1" class="reqError text-danger valley"></span>
                            </div>
                            <div class="declaration_box mt-2 mb-2">
                              <input class="currently_position currently_position-1" type="checkbox" name="present_box[1]" value="1" onclick="currently_position(1)">I am currently in this position at the moment
                            </div>
                          </div>
                          <div class="col-md-6 empl_end_date-1">
                            <div class="form-group level-drp">
                              <label class="form-label" for="input-1">Employment End Date</label>
                              <input class="form-control employeement_end_date_exp employeement_end_date_exp-1" type="date" name="end_date[1]">
                              <span id="reqemployeementenddateexp-1" class="reqError text-danger valley"></span>
                            </div>
                          </div>
                        </div>
                        <br>
                        
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Employment type</label>
                          
                          <ul id="employeement_type_experience-1" style="display:none;">
                            @if(!empty($employeement_type_preferences))
                            @foreach($employeement_type_preferences as $emptype_data)
                            <li data-value="{{ $emptype_data->emp_prefer_id }}">{{ $emptype_data->emp_type }}</li>
                            @endforeach
                            @endif
                            
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn employeement_type_exp employeement_type_exp-1" data-list-id="employeement_type_experience-1" name="employeement_type[1]" multiple onchange="showEmpType(this.value,1,'')"></select>
                        </div>  
                        <div class="show_emp_data-1"></div>  
                          
                        <div class="exp_permanent-1 exp_permanent" style="display: none;">
                          <div class="form-group level-drp col-md-12">
                            <label class="form-label" for="input-1">Permanent</label>
                            <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                            <input type="hidden" name="subrefer_list" class="subrefer_list" value="1">\
                            <ul id="permanent_status_experience-1" style="display:none;">
                              <li data-value="">select</li>
                              <li data-value="Full-time (Permanent)">Full-time (Permanent)</li>
                              <li data-value="2">Part-time (Permanent)</li>
                              <li data-value="Agency Nurse / Midwife (Permanent)">Agency Nurse / Midwife (Permanent)</li>
                              <li data-value="Staffing Agency Nurse (Permanent)">Staffing Agency Nurse (Permanent)</li>
                              <li data-value="Private Healthcare Agency Nurse (Permanent)">Private Healthcare Agency Nurse (Permanent)</li>
                              <li data-value="Freelance (Permanent)">Freelance (Permanent)</li>
                              <li data-value="Self-Employed (Permanent)">Self-Employed (Permanent)</li>
                              <li data-value="Private Practice (Permanent)">Private Practice (Permanent)</li>
                              <li data-value="Volunteer (Permanent)">Volunteer (Permanent)</li>
                              
                            </ul>
                            <select class="js-example-basic-multiple permanent_exp permanent_exp-1" data-list-id="permanent_status_experience-1" name="permanent_status[1]" id="permanent_status_experience"></select>
                            <span id="reqemployeep_statusexp-1" class="reqError text-danger valley"></span>
                          </div>
                          
                        </div>
                        <div class="exp_temporary-1 exp_temporary" style="display: none;">
                          <div class="form-group level-drp col-md-12">
                            <label class="form-label" for="input-1">Temporary</label>
                            <input type="hidden" name="temphfield" class="temphfield" value="{{ Auth::guard('nurse_middle')->user()->temporary_status }}">
                        
                            <ul id="temporary_status_experience-1" style="display:none;">
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
                            <select class="js-example-basic-multiple temporary_exp temporary_exp-1" data-list-id="temporary_status_experience-1" name="temporary_status[1]" id="temporary_status_experience"></select>
                            <span id="reqemployeetexp_status-1" class="reqError text-danger valley"></span>
                          </div>
                          
                        </div>
                        <h6 class="emergency_text">
                          Detailed Job Descriptions
                        </h6>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Responsibilities</label>
                          <textarea class="form-control res-exp res-exp-1" name="job_responeblities[1]"></textarea>
                          <span id="reqresposiblitiesexp-1" class="reqError text-danger valley"></span>
                        </div>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Achievements</label>
                          <textarea class="form-control ach_exp ach_exp-1" name="achievements[1]"></textarea>
                          <span id="reqachievementsexp-1" class="reqError text-danger valley"></span>
                        </div>
                        <h6 class="emergency_text">
                          Areas of Expertise
                        </h6>
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
                        <div class="skills_compantancies_dropdowns"></div>
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
                          <select class="js-example-basic-multiple addAll_removeAll_btn type_of_evi type_of_evi_1" data-list-id="type_of_evidence" name="type_of_evidence[1][]" multiple="multiple"></select>
                          <span id="reqtype_evidenceexp-1" class="reqError text-danger valley"></span>
                        </div>
                        <!-- <div class="form-group level-drp">
                          <?php
                          $user_id = Auth::guard('nurse_middle')->user()->id;
                          ?>
                          <label class="form-label" for="input-1">Upload evidence</label>
                          <input class="form-control" type="file" name="upload_evidence[1][]" onchange="changeEviImg('{{ $user_id }}')" multiple="">
                        </div> -->
                        <div class="form-group level-drp">
                          <?php
                          $user_id = Auth::guard('nurse_middle')->user()->id;
                          ?>
                          <label class="form-label" for="input-1">Upload evidence</label>
                          <input type="hidden" name="upload_evidence[1]" class="old_files-1" value="">
                          <input class="form-control upload_evidence-1" type="file" name=""  onchange="changeExpEvidenceImg({{ Auth::guard('nurse_middle')->user()->id }},1,0)" multiple="" id="1">
                          <div class="fileList  fileList_1"></div>
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
                      @endif


                    </div>

                    <div class="add_new_certification_div awe mb-3 mt-4">
                      <a style="cursor: pointer;" onclick="add_work_experience()">+ Add another work experience</a>
                    </div>
                    <?php $decvalue = $experienceData;
                    foreach ($decvalue as $key => $value) {
                      if ($key === 0) {
                        $firstValue = $value; // Get the first value
                        break; // Exit the loop
                      }
                    }
                    ?>
                    <div class="declaration_box">
                      <input type="checkbox" name="exp_declare_information" class="exp_declare_information" value="1" @if(!empty($firstValue)) @if($firstValue->declaration_status == 1) checked @endif @endif>
                      <label for="declare_information">I declare that the information provided is true and correct</label>
                      @if(!empty($firstValue->declaration_status) && $firstValue->declaration_status == 1)
                      <input type="hidden" name="exp_declare_information" value="1">
                      @endif
                    </div>
                    <span id="reqdeclare_information_exp" class="reqError text-danger valley"></span>
                    <div class="box-button mt-15">
                      <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitExperience" @if(!email_verified()) disabled @endif>Save Changes</button>
                    </div>
                  </form>
                </div>
              </div>
              <script type="text/javascript">
                function changeEmployeementEndDate(i) {
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

                  document.getElementsByClassName("employeement_end_date_exp-" + i)[0].setAttribute('min', new_date);
                }

                var i = 1;
                $(".employeement_start_date").each(function() {
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
                  document.getElementsByClassName("employeement_end_date_exp-" + i)[0].setAttribute('min', new_date);
                  i++;
                });
              </script>
              <script>
                document.addEventListener("DOMContentLoaded", function () {
                    $(document).on(
                        'select2:unselect select2:clear',
                        '.nurse_type_exp',
                        function (e) {

                            if (!e.params || !e.params.data) return;

                            var removedId = e.params.data.id;
                            $('.subnurse_main_div-' + removedId).remove();
                            $('.show_nurse-' + removedId).remove();
                        }
                    );
                });
              </script>

              <div class="tab-pane fade" id="tab-references" role="tabpanel" aria-labelledby="tab-references" style="display: none"><br>
                  <h3 class="mt-0 color-brand-1 mb-20">References</h3>
                  <h6 class="emergency_text">
                      Please Add your professional References:
                  </h6>
                  <?php
                  $isFromExperience = request()->has('experience_id') && request()->experience_id;
                  ?>
                  <?php
                  $expId = request()->experience_id;

                  $experience = null;

                  if ($expId) {
                      $experience = DB::table('user_experience')
                          ->where('experience_id', $expId)
                          ->where('user_id', Auth::guard('nurse_middle')->user()->id)
                          ->first();
                  }
                  
                  // Get nurse types from taxonomy - FIXED: Changed from practitioner_type to correct table name
                  $nurseTypes = DB::table('practitioner_type')->orderBy('name', 'asc')->get();
                  ?>
                  
                  <form id="reference_form" method="POST" onsubmit="return updateReference()">
                      @csrf
                      
                      <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                      <div class="reference_form">
                          <?php
                            if ($isFromExperience) {
                                $get_reference_data = collect();
                            } else {
                                $get_reference_data = DB::table("referee")
                                    ->where("user_id", Auth::guard('nurse_middle')->user()->id)
                                    ->get();
                            }
                            ?>
                          @if(count($get_reference_data)>0)
                              <?php
                              $i = 1;
                              ?>
                              @foreach($get_reference_data as $referee_data)
                                  <?php
                                  $isLinked = $referee_data->experience_id && $referee_data->experience_id != 0;
                                  $linkedExperience = null;
                                  $nurseTypeName = '';
                                  $nurseTypeId = null;
                                  $specialtyName = '';
                                  $specialtyId = null;
                                  $startDate = '';
                                  $endDate = '';
                                  
                                  if ($isLinked) {
                                      $linkedExperience = DB::table('user_experience')
                                          ->where('experience_id', $referee_data->experience_id)
                                          ->first();
                                          
                                      if ($linkedExperience) {
                                          // Get nurse type
                                          if (!empty($linkedExperience->nurseType)) {
                                              $nurseTypeArray = json_decode($linkedExperience->nurseType, true);

                                              $firstGroup = collect($nurseTypeArray)->first(); // ["2"]

                                              $nurseTypeId = is_array($firstGroup) ? ($firstGroup[0] ?? null) : null;

                                              $nurseTypeName = $nurseTypeId
                                                  ? DB::table('practitioner_type')->where('id', $nurseTypeId)->value('name')
                                                  : '';

                                          }
                                          
                                          // Get specialty
                                          if (!empty($linkedExperience->specialties)) {
                                              $specialtyArray = json_decode($linkedExperience->specialties, true);

                                              $firstGroup = collect($specialtyArray)->first(); // ["12"]

                                              $specialtyId = is_array($firstGroup) ? ($firstGroup[0] ?? null) : null;

                                              $specialtyName = $specialtyId
                                                  ? DB::table('speciality')->where('id', $specialtyId)->value('name')
                                                  : '';

                                          }
                                          
                                          // Get dates
                                          $startDate = $linkedExperience->employeement_start_date ?? '';
                                          $endDate = $linkedExperience->employeement_end_date ?? '';
                                      }
                                  }
                                  ?>
                                  
                                  <div class="referee_data referee_data-{{ $i }}" data-index="{{ $i }}">
                                      <h6 class="mt-0 color-brand-1 mb-20 referee_no">
                                          REFEREE {{ $i }}
                                          @if($isLinked)
                                              <span class="badge bg-success ms-2">Linked to Experience</span>
                                          @endif
                                      </h6>
                                      
                                      <!-- Unlink checkbox for linked referees -->
                                      @if($isLinked)
                                          <div class="row mb-3">
                                              <div class="col-md-12">
                                                  <div class="form-check">
                                                      <input class="form-check-input unlink-referee" type="checkbox" 
                                                            id="unlink-referee-{{ $i }}"
                                                            data-index="{{ $i }}"
                                                            onchange="handleUnlinkCheckbox(this)">
                                                      <label class="form-check-label" for="unlink-referee-{{ $i }}">
                                                          Unlink from experience record
                                                      </label>
                                                  </div>
                                              </div>
                                          </div>
                                      @endif
                                      
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group level-drp">
                                                  <label class="form-label" for="input-1">First name *</label>
                                                  <input type="hidden" name="experience_id[]" value="{{ $referee_data->experience_id }}" 
                                                        class="exp-id-input exp-id-input-{{ $i }}">
                                                  <input type="hidden" name="reference_no[]" value="{{ $i }}">
                                                  <input type="hidden" name="referee_no[]" value="{{ $referee_data->referee_no }}">
                                                  <input class="form-control first_name first_name-{{ $i }}" type="text" 
                                                        name="first_name[]" value="{{ $referee_data->first_name }}">
                                                  <span id="reqfname-{{ $i }}" class="reqError text-danger valley"></span>
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group level-drp">
                                                  <label class="form-label" for="input-1">Last name *</label>
                                                  <input class="form-control last_name last_name-{{ $i }}" type="text" 
                                                        name="last_name[]" value="{{ $referee_data->last_name }}">
                                                  <span id="reqlname-{{ $i }}" class="reqError text-danger valley"></span>
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group level-drp">
                                                  <label class="form-label" for="input-1">Email *</label>
                                                  <input class="form-control reference_email reference_email-{{ $i }}" type="email" 
                                                        name="email[]" value="{{ $referee_data->email }}">
                                                  <span id="reqemail-{{ $i }}" class="reqError text-danger valley"></span>
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group level-drp">
                                                  <label class="form-label" for="input-1">Referee relationship to you *</label>
                                                  <select class="form-input reference_relationship reference_relationship-{{ $i }}" 
                                                          name="reference_relationship[]">
                                                      <option value="" data-select2-id="9">Select</option>
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
                                                  @if($isLinked && $linkedExperience)
                                                      <input class="form-control worked_together worked_together-{{ $i }}" 
                                                            type="text" value="{{ $linkedExperience->facility_workplace_name ?? '' }}" 
                                                            readonly>
                                                      <input type="hidden" name="worked_together[]" 
                                                            value="{{ $linkedExperience->facility_workplace_name ?? '' }}">
                                                  @else
                                                      <input class="form-control worked_together worked_together-{{ $i }}" 
                                                            type="text" name="worked_together[]" 
                                                            value="{{ $referee_data->worked_together ?? '' }}">
                                                  @endif
                                                  <span id="reqworked_together-{{ $i }}" class="reqError text-danger valley"></span>
                                              </div>
                                          </div>
                                      </div>
                                      
                                      <!-- Role Section -->
                                      <div class="row role-section">
                                          @if($isLinked)
                                              <!-- For linked referees: Show info message -->
                                                  <div class="col-md-6">
                                                    <div class="form-group level-drp">
                                                        <label class="form-label">Type of Nurse</label>
                                                        <input type="text"
                                                              class="form-control"
                                                              value="{{ $nurseTypeName }}"
                                                              disabled>

                                                        <input type="hidden"
                                                              name="nurse_type[]"
                                                              value="{{ $nurseTypeId }}">
                                                    </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <div class="form-group level-drp">
                                                      <label class="form-label">Specialty</label>

                                                      <input type="text"
                                                            class="form-control"
                                                            value="{{ $specialtyName }}"
                                                            disabled>

                                                      <input type="hidden"
                                                            name="specialty[]"
                                                            value="{{ $specialtyId }}">
                                                    </div>
                                                  </div>
                                                  
                                                  <div class="row mt-3">
                                                      <div class="col-md-6">
                                                          <div class="form-group level-drp">
                                                              <label class="form-label">Start Date</label>
                                                              <input class="form-control start_date start_date-{{ $i }}" 
                                                                    type="date" name="start_date[]" 
                                                                    value="{{ $startDate }}" 
                                                                    readonly
                                                                    onchange="startDate('{{ $i }}')">
                                                          </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="form-group level-drp">
                                                              <label class="form-label">End Date</label>
                                                              <input class="form-control end_date end_date-{{ $i }}" 
                                                                    type="date" name="end_date[]" 
                                                                    value="{{ $endDate }}" 
                                                                    readonly>
                                                          </div>
                                                      </div>
                                                  </div>
                                          @else
                                              <!-- For unlinked referees: Type of Nurse dropdown -->
                                              <div class="col-md-12">
                                                  <div class="form-group level-drp">
                                                      <label class="form-label" for="input-1">What was your role at the time? *</label>
                                                      <select class="form-control nurse_type nurse_type-{{ $i }}" 
                                                              name="nurse_type[]">
                                                          <option value="">Select your role</option>
                                                          @foreach($nurseTypes as $type)
                                                              <option value="{{ $type->id }}" 
                                                                  {{ isset($referee_data->position_with_referee) && $referee_data->position_with_referee == $type->id ? 'selected' : '' }}>
                                                                  {{ $type->name }}
                                                              </option>
                                                          @endforeach
                                                      </select>
                                                      <span id="reqnursetype-{{ $i }}" class="reqError text-danger valley"></span>
                                                  </div>
                                                  
                                                  <!-- Optional fields for unlinked referees -->
                                                  <div class="row mt-3">
                                                      <div class="col-md-6">
                                                          <div class="form-group level-drp">
                                                              <label class="form-label">Start Date</label>
                                                              <input class="form-control start_date start_date-{{ $i }}" 
                                                                    type="date" name="start_date[]" 
                                                                    value="{{ $referee_data->start_date ?? '' }}" 
                                                                    onchange="startDate('{{ $i }}')">
                                                          </div>
                                                      </div>
                                                      <div class="col-md-6 end_date_container-{{ $i }}">
                                                        <div class="form-group level-drp">
                                                            <label class="form-label">End Date</label>
                                                            <input class="form-control end_date end_date-{{ $i }}" 
                                                                  type="date" name="end_date[]" 
                                                                  value="{{ $referee_data->end_date ?? '' }}">
                                                        </div>
                                                    </div>
                                                  </div>
                                              </div>
                                          @endif
                                      </div>
                                      
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="declaration_box mt-3">
                                                  <input type="hidden" name="still_working1[]" 
                                                        class="still_working1-{{ $i }}" 
                                                        value="{{ $referee_data->still_working ?? 0 }}" />
                                                  <input class="still_working still_working-{{ $i }}" 
                                                        type="checkbox" 
                                                        name="still_working[]" 
                                                        value="1"
                                                        {{ isset($referee_data->still_working) && $referee_data->still_working == 1 ? 'checked' : '' }}
                                                        onclick="toggleEndDate(this, {{ $i }})">
                                                  I'm still working with this referee
                                                  <span id="reqstillworking-{{ $i }}" class="reqError text-danger valley"></span>
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
                                                      <a style="cursor: pointer;" class="deleteReferee" 
                                                        data-index="{{ $referee_data->referee_id ?? '' }}">
                                                          - Delete Referee
                                                      </a>
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
                              <!-- New referee form -->
                              <div class="referee_data referee_data-1" data-index="1">
                                  <h6 class="mt-0 color-brand-1 mb-20 referee_no">REFEREE 1</h6>
                                  
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group level-drp">
                                              <label class="form-label" for="input-1">First name *</label>
                                              <input type="hidden" name="experience_id[]" value="{{ request()->get('experience_id') ?? 0 }}" 
                                                    class="exp-id-input exp-id-input-1">
                                              <input class="form-control first_name first_name-1" type="text" name="first_name[]">
                                              <span id="reqfname-1" class="reqError text-danger valley"></span>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group level-drp">
                                              <label class="form-label" for="input-1">Last name *</label>
                                              <input class="form-control last_name last_name-1" type="text" name="last_name[]">
                                              <span id="reqlname-1" class="reqError text-danger valley"></span>
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group level-drp">
                                              <label class="form-label" for="input-1">Email *</label>
                                              <input class="form-control reference_email reference_email-1" 
                                                    type="email" name="email[]">
                                              <span id="reqemail-1" class="reqError text-danger valley"></span>
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group level-drp">
                                              <label class="form-label" for="input-1">Referee relationship to you *</label>
                                              <select class="form-control reference_relationship reference_relationship-1" 
                                                      name="reference_relationship[]">
                                                  <option value="" data-select2-id="9">Select</option>
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
                                              @if($experience)
                                                  <input class="form-control worked_together worked_together-1" 
                                                        type="text" 
                                                        value="{{ $experience->facility_workplace_name ?? '' }}" 
                                                        readonly>
                                                  <input type="hidden" name="worked_together[]" 
                                                        value="{{ $experience->facility_workplace_name ?? '' }}">
                                              @else
                                                  <input class="form-control worked_together worked_together-1" 
                                                        type="text" 
                                                        name="worked_together[]">
                                              @endif
                                              <span id="reqworked_together-1" class="reqError text-danger valley"></span>
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <!-- Role Section -->
                                  <div class="row role-section">
                                      @if($experience)
                                          <!-- Linked referee -->
                                          <?php
                                          $nurseTypeName = '';
                                          $nurseTypeId = null;
                                          $specialtyName = '';
                                          $specialtyId = null;
                                          
                                          if (!empty($experience->nurseType)) {
                                              $nurseTypeArray = (array) json_decode($experience->nurseType, true);

                                              // Get first value safely
                                              $decoded = json_decode($experience->nurseType, true);
                                              $firstGroup = collect($decoded)->first(); // ["2"]

                                              if (is_array($firstGroup) && count($firstGroup) > 0) {
                                                  $nurseTypeId = is_array($firstGroup) ? ($firstGroup[0] ?? null) : null;

                                                  $nurseTypeName = DB::table('practitioner_type')
                                                      ->where('id', $nurseTypeId)
                                                      ->value('name');
                                              }
                                          }
                                          
                                          if (!empty($experience->specialties)) {
                                                $specialtyArray = (array) json_decode($experience->specialties, true);

                                                $firstGroup = collect($specialtyArray)->first(); // ["1"]

                                                if (is_array($firstGroup) && count($firstGroup) > 0) {
                                                    $specialtyId = $firstGroup[0];

                                                    $specialtyName = DB::table('speciality')
                                                        ->where('id', $specialtyId)
                                                        ->value('name');
                                                }
                                            }
                                          ?>
                                          
                                          <div class="col-md-6">
                                              <div class="form-group level-drp">
                                                  <label class="form-label">Type of Nurse</label>
                                                  <input type="text"
                                                        class="form-control"
                                                        value="{{ $nurseTypeName }}"
                                                        disabled>

                                                  <input type="hidden"
                                                        name="nurse_type[]"
                                                        value="{{ $nurseTypeId }}">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group level-drp">
                                                  <label class="form-label">Specialty</label>
                                                  <input type="text"
                                                        class="form-control"
                                                        value="{{ $specialtyName }}"
                                                        disabled>

                                                  <input type="hidden"
                                                        name="specialty[]"
                                                        value="{{ $specialtyId }}">
                                              </div>
                                          </div>
                                          
                                          <div class="row mt-3">
                                              <div class="col-md-6">
                                                  <div class="form-group level-drp">
                                                      <label class="form-label">Start Date</label>
                                                      <input class="form-control start_date start_date-1" 
                                                            type="date" 
                                                            name="start_date[]"
                                                            onchange="startDate('1')"
                                                            value="{{ $experience->employeement_start_date ?? '' }}" 
                                                            readonly>
                                                  </div>
                                              </div>
                                              <div class="col-md-6">
                                                  <div class="form-group level-drp">
                                                      <label class="form-label">End Date</label>
                                                      <input class="form-control end_date end_date-1" 
                                                            type="date" 
                                                            name="end_date[]"
                                                            value="{{ $experience->employeement_end_date ?? '' }}" 
                                                            readonly>
                                                  </div>
                                              </div>
                                          </div>
                                      @else
                                          <!-- Unlinked referee: Type of Nurse dropdown -->
                                          <div class="col-md-12">
                                              <div class="form-group level-drp">
                                                  <label class="form-label" for="input-1">What was your role at the time? *</label>
                                                  <select class="form-control nurse_type nurse_type-1" name="nurse_type[]">
                                                      <option value="">Select your role</option>
                                                      @foreach($nurseTypes as $type)
                                                          <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                      @endforeach
                                                  </select>
                                                  <span id="reqnursetype-1" class="reqError text-danger valley"></span>
                                              </div>
                                              
                                              <!-- Optional dates for unlinked referees -->
                                              <div class="row mt-3">
                                                  <div class="col-md-6">
                                                      <div class="form-group level-drp">
                                                          <label class="form-label">Start Date</label>
                                                          <input class="form-control start_date start_date-1" 
                                                                type="date" 
                                                                name="start_date[]"
                                                                onchange="startDate('1')">
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6 end_date_container-1">
                                                    <div class="form-group level-drp">
                                                        <label class="form-label">End Date</label>
                                                        <input class="form-control end_date end_date-1" 
                                                              type="date" 
                                                              name="end_date[]">
                                                    </div>
                                                </div>
                                              </div>
                                          </div>
                                      @endif
                                  </div>
                                  
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="declaration_box mt-3">
                                              <input type="hidden" name="still_working1[]" 
                                                    class="still_working1-1" 
                                                    value="{{ $experience->pre_box_status ?? 0 }}" />
                                              <input class="still_working-1" 
                                                    type="checkbox" 
                                                    name="still_working[]" 
                                                    value="1"
                                                    {{ isset($experience->pre_box_status) && $experience->pre_box_status == 1 ? 'checked' : '' }}
                                                    onclick="toggleEndDate(this, 1)">
                                              I'm still working with this referee
                                              <span id="reqstillworking" class="reqError text-danger valley"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          @endif
                      </div>
                      
                      <br>
                      <div class="add_new_certification_div mb-3 mt-3">
                          <a style="cursor: pointer;" onclick="add_another_referee()">+ Add another Referee</a>
                      </div>
                      
                      <div class="declaration_box declaration_bottom">
                          <input class="declare" type="checkbox" name="declare"
                            {{ optional($get_reference_data->first())->is_declare == 1 ? 'checked' : '' }}>
                          <label for="declare_information">I declare that the information provided is true and correct</label>
                          <br>
                      </div>
                      
                      <span id="reqreference" class="reqError text-danger valley"></span>
                      <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitReferences" 
                                  @if(!function_exists('email_verified') || !email_verified()) disabled @endif>
                              Save Changes
                          </button>
                      </div>
                  </form>
              </div>

              <?php
              // Only include if these variables are needed elsewhere
              if(isset($employee_postion_data)) {
                  $emp_data = json_encode($employee_postion_data);
              }
              ?>

              <script type="text/javascript">
                  function toggleEndDate(checkbox, index) {
                  const isChecked = checkbox.checked;
                  const endDateContainer = $(`.end_date_container-${index}`);
                  
                    if (isChecked) {
                        // Hide end date and clear its value
                        endDateContainer.hide();
                        $(`.end_date-${index}`).val('');
                        $(`.still_working1-${index}`).val('1');
                    } else {
                        // Show end date
                        endDateContainer.show();
                        $(`.still_working1-${index}`).val('0');
                    }
                  }

                  // Initialize on page load
                  $(document).ready(function() {
                      // For each checkbox, trigger the toggle to set initial state
                      $('.still_working').each(function() {
                          const classList = $(this).attr('class');
                          const match = classList.match(/still_working-(\d+)/);
                          if (match && match[1]) {
                              toggleEndDate(this, match[1]);
                          }
                      });
                  });
                  // Function to add another referee
                  function add_another_referee() {
                      var referee_div_count = $(".referee_no").length;
                      var params = new URLSearchParams(window.location.search);
                      var experience_id = params.get('experience_id');
                      
                      // Default to unlinked referee
                      referee_div_count++;
                      
                      // Get nurse types from PHP variable
                      var nurseTypes = @json($nurseTypes ?? []);
                      
                      var nurseTypeOptions = '';
                      if (nurseTypes && nurseTypes.length > 0) {
                          nurseTypes.forEach(function(type) {
                              nurseTypeOptions += '<option value="' + type.id + '">' + (type.name || type.type_name) + '</option>';
                          });
                      }
                      
                      var newRefereeHtml = `
                          <div class="referee_data referee_data-${referee_div_count}" data-index="${referee_div_count}">
                              <h6 class="mt-0 color-brand-1 mb-20 referee_no">REFEREE ${referee_div_count}</h6>
                              
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group level-drp">
                                          <input type="hidden" name="experience_id[]" value="0" class="exp-id-input exp-id-input-${referee_div_count}">
                                          <input type="hidden" name="reference_no[]" value="${referee_div_count}">
                                          <label class="form-label">First name *</label>
                                          <input class="form-control first_name first_name-${referee_div_count}" type="text" name="first_name[]">
                                          <span id="reqfname-${referee_div_count}" class="reqError text-danger valley"></span>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group level-drp">
                                          <label class="form-label">Last name *</label>
                                          <input class="form-control last_name last_name-${referee_div_count}" type="text" name="last_name[]">
                                          <span id="reqlname-${referee_div_count}" class="reqError text-danger valley"></span>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group level-drp">
                                          <label class="form-label">Email *</label>
                                          <input class="form-control reference_email reference_email-${referee_div_count}" 
                                                type="email" name="email[]">
                                          <span id="reqemail-${referee_div_count}" class="reqError text-danger valley"></span>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group level-drp">
                                          <label class="form-label">Referee relationship to you *</label>
                                          <select class="form-control reference_relationship reference_relationship-${referee_div_count}" 
                                                  name="reference_relationship[]">
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
                                          <span id="reqreferencerel-${referee_div_count}" class="reqError text-danger valley"></span>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group level-drp">
                                          <label class="form-label">You worked together at:</label>
                                          <input class="form-control worked_together worked_together-${referee_div_count}" 
                                                type="text" name="worked_together[]">
                                          <span id="reqworked_together-${referee_div_count}" class="reqError text-danger valley"></span>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="row role-section">
                                  <div class="col-md-12">
                                      <div class="form-group level-drp">
                                          <label class="form-label">What was your role at the time? *</label>
                                          <select class="form-control nurse_type nurse_type-${referee_div_count}" name="nurse_type[]">
                                              <option value="">Select your role</option>
                                              ${nurseTypeOptions}
                                          </select>
                                          <span id="reqnursetype-${referee_div_count}" class="reqError text-danger valley"></span>
                                      </div>
                                      
                                      <div class="row mt-3">
                                          <div class="col-md-6">
                                              <div class="form-group level-drp">
                                                  <label class="form-label">Start Date</label>
                                                  <input class="form-control start_date start_date-${referee_div_count}" 
                                                        type="date" name="start_date[]" 
                                                        onchange="startDate('${referee_div_count}')">
                                              </div>
                                          </div>
                                          <div class="col-md-6 end_date_container-${referee_div_count}">
                                              <div class="form-group level-drp">
                                                  <label class="form-label">End Date</label>
                                                  <input class="form-control end_date end_date-${referee_div_count}" 
                                                        type="date" name="end_date[]">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="declaration_box mt-3">
                                          <input type="hidden" name="still_working1[]" class="still_working1-${referee_div_count}" value="0" />
                                          <input class="still_working still_working-${referee_div_count}" type="checkbox" 
                                                name="still_working[]" onclick="toggleEndDate(this, ${referee_div_count})">
                                          I'm still working with this referee
                                          <span id="reqstillworking-${referee_div_count}" class="reqError text-danger valley"></span>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="add_new_certification_div mb-3 mt-3">
                                          <a style="cursor: pointer;" class="deleteReferee" onclick="$(this).closest('.referee_data').remove()">
                                              - Delete Referee
                                          </a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      `;
                      
                      $(".reference_form").append(newRefereeHtml);
                  }
                  
                  // Function to handle unlink checkbox
                  function handleUnlinkCheckbox(checkbox) {
                      const index = $(checkbox).data('index');
                      const isChecked = $(checkbox).is(':checked');
                      
                      if (isChecked) {
                          // Unlink from experience
                          $(`.exp-id-input-${index}`).val('0');
                          
                          // Make worked together editable
                          const workedTogetherInput = $(`.worked_together-${index}`);

                          // Find hidden input
                          let hiddenWorkedTogether = $(`.referee_data-${index} input[type="hidden"][name="worked_together[]"]`);

                          if (hiddenWorkedTogether.length === 0) {
                              // If hidden input does not exist, create it
                              hiddenWorkedTogether = $('<input>', {
                                  type: 'hidden',
                                  name: 'worked_together[]'
                              }).appendTo(`.referee_data-${index}`);
                          }

                          // Keep hidden input as the real submitted field
                          workedTogetherInput.prop('readonly', false);
                          workedTogetherInput.val('');

                          // Sync visible input → hidden input
                          workedTogetherInput.on('input', function () {
                              hiddenWorkedTogether.val($(this).val());
                          });

                          // Clear old value
                          hiddenWorkedTogether.val('');
                          
                          // Remove linked badge if exists
                          $(`.referee_data-${index} .badge`).remove();
                          
                          // Hide the linked experience info
                          $(`.referee_data-${index} .linked-experience-info`).remove();
                          
                          // Check if nurse type dropdown already exists
                          if ($(`.nurse_type-${index}`).length === 0) {
                              // Get nurse types from PHP variable
                              var nurseTypes = @json($nurseTypes ?? []);
                              var nurseTypeOptions = '<option value="">Select your role</option>';
                              
                              if (nurseTypes && nurseTypes.length > 0) {
                                  nurseTypes.forEach(function(type) {
                                      nurseTypeOptions += '<option value="' + type.id + '">' + (type.name || type.type_name) + '</option>';
                                  });
                              }
                              
                              // Add nurse type dropdown
                              const nurseTypeHtml = `
                                  <div class="form-group level-drp">
                                      <label class="form-label">What was your role at the time? *</label>
                                      <select class="form-control nurse_type nurse_type-${index}" name="nurse_type[]">
                                          ${nurseTypeOptions}
                                      </select>
                                      <span id="reqnursetype-${index}" class="reqError text-danger valley"></span>
                                  </div>
                                  <div class="row mt-3">
                                      <div class="col-md-6">
                                          <div class="form-group level-drp">
                                              <label class="form-label">Start Date</label>
                                              <input class="form-control start_date start_date-${index}" 
                                                    type="date" name="start_date[]">
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group level-drp">
                                              <label class="form-label">End Date</label>
                                              <input class="form-control end_date end_date-${index}" 
                                                    type="date" name="end_date[]">
                                          </div>
                                      </div>
                                  </div>
                              `;
                              
                              // Replace the role section
                              $(`.referee_data-${index} .role-section`).html(nurseTypeHtml);
                          }
                      }
                  }
                  
                  // Function to show/hide end date based on still working checkbox
                  function stillWorking(index) {
                      var isChecked = $(`.still_working-${index}`).is(":checked");
                      if (isChecked) {
                          $(`.working-${index}`).hide();
                          $(`.end_date-${index}`).val('');
                          $(`.still_working1-${index}`).val('1');
                      } else {
                          $(`.working-${index}`).show();
                          $(`.still_working1-${index}`).val('0');
                      }
                  }
                  
                  // Function to validate start date
                  function startDate(i) {
                      var start_date = $(`.start_date-${i}`).val();
                      if (start_date) {
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
                          $(`.end_date-${i}`).attr('min', new_date);
                      }
                  }
                  
                  // Initialize on page load
                  $(document).ready(function() {
                      // Initialize date validations
                      $(".start_date").each(function() {
                          var classList = $(this).attr('class');
                          var match = classList.match(/start_date-(\d+)/);
                          if (match && match[1]) {
                              startDate(match[1]);
                          }
                      });
                  });
              </script>
              
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
                    <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitInterview" @if(!email_verified()) disabled @endif>Save Changes</button>
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
                    <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitPersonalPreferences" @if(!email_verified()) disabled @endif>Save Changes</button>
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
                    <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitAdditionalInformation" @if(!email_verified()) disabled @endif>Save Changes</button>
                  </div>
                </form>
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
                      <input type="date" id="available_date" name="available_date" class="form-control" value="{{ Auth::guard('nurse_middle')->user()->available_date }}" onkeydown="return false">
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
                        <p class="">Please upload all your vaccination records as required for your desired roles and state. You may also add non-mandatory vaccines and any additional vaccinations not listed. Keeping your vaccinations up to date will help maintain your eligibility for your role.</p>
                        <p class="mt-2">To ensure your evidence is compliant, please refer to our guide Vaccination Compliance and Evidence Requirements by State.</p>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Vaccination Records</label>
                          <input type="hidden" name="vaccination_r" class="vaccination_r" value="@if(!empty($vaccinationData)){{ $vaccinationData->vaccination_records }}@endif">
                          <?php
                          $vaccination_record = DB::table("vaccination")->get();
                          ?>
                          <ul id="vaccination_record" style="display:none;">
                            @foreach($vaccination_record as $v_record)
                            <li data-value="{{ $v_record->id }}" data-id="{{ $v_record->name }}">{{ $v_record->name }}</li>
                            @endforeach
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="vaccination_record" name="vaccination_record[]" multiple="multiple"></select>
                          <span id="reqempsdate" class="reqError text-danger valley"></span>
                        </div>
                        <div class="vacc_rec_div"></div>
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
                          <button class="btn btn-apply-big font-md font-bold" type="submitVaccination" id="submitVaccination" @if(!email_verified()) disabled @endif>Save Changes</button>
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
                        <input class="form-control" type="date" name="expiry_date" id="expiry_dataI" value="{{ $expiry_data }}" min="{{ date('Y-m-d') }}" onkeydown="return false">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
@include('nurse.front_profile_js');

<script>
    $(document).ready(function() {

        $(document).on('select2:open', '.addAll_removeAll_btn', function () {
    const $select = $(this);
    const select2 = $select.data('select2');

    // Avoid duplicate buttons
    if ($('.select2-results .extra-buttons').length === 0) {

        const buttonsHtml = `
            <div class="extra-buttons" style="padding:8px;border-bottom:1px solid #eee;">
                <button type="button" class="select-all-button">Select All</button>
                <button type="button" class="remove-all-button">Remove All</button>
            </div>
        `;

        $('.select2-results').prepend(buttonsHtml);
    }

    // Select All
    $('.select-all-button').off('click').on('click', function () {
        const allValues = [];

        $select.find('option').each(function () {
            allValues.push($(this).val());
        });

        $select.val(allValues).trigger('change');

        // ✅ CLOSE DROPDOWN
        $select.select2('close');
    });

    // Remove All
    $('.remove-all-button').off('click').on('click', function () {
        $select.val(null).trigger('change');

        // ✅ CLOSE DROPDOWN
        $select.select2('close');
    });
});


    });
</script>
<script>
  $(document).ready(function() {
    // Add an additional search box to the dropdown
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


  if ($(".ntype").val() != "") {
    var nurse_type = JSON.parse($(".ntype").val());
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

  if ($(".speciality_value").val() != "") {
    var speciality_value = JSON.parse($(".speciality_value").val());
    var subspecialitynurse_list = $(".subspecialitynurse_list").val();
    console.log("speciality_value",speciality_value);
    $('.js-example-basic-multiple[data-list-id="speciality_preferences-'+subspecialitynurse_list+'-0"]').select2().val(speciality_value).trigger('change');
  }

  $(".subspec_list").each(function(){
    var subspec_val = $(this).val();
    if ($(".subspectype-"+subspec_val).val() != "") {
      var spec_type = JSON.parse($(".subspectype-"+subspec_val).val());
      console.log("spec_types",spec_type);
      var subspecialitynurse_list = $(".subspecialitynurse_list").val();
      $('.js-example-basic-multiple[data-list-id="speciality_preferences-'+subspecialitynurse_list+"-"+subspec_val+'"]').select2().val(spec_type).trigger('change');
    }
  });

  

  if ($(".nursing_result_one").val() != "") {
    var entry_level = JSON.parse($(".nursing_result_one").val());
    $('.js-example-basic-multiple[data-list-id="nursing_entry-1"]').select2().val(entry_level).trigger('change');
  }


  if ($(".nursing_result_two").val() != "") {
    var registered_nurses = JSON.parse($(".nursing_result_two").val());
    $('.js-example-basic-multiple[data-list-id="nursing_entry-2"]').select2().val(registered_nurses).trigger('change');
  }

  // if ($(".nursing_result_two_experience").val() != "") {
  //   var registered_nurses = JSON.parse($(".nursing_result_two_experience").val());
  //   $('.js-example-basic-multiple[data-list-id="nursing_entry_experience-2"]').select2().val(registered_nurses).trigger('change');
  // }

  if ($(".nursing_result_three").val() != "") {
    var advanced_practioner = JSON.parse($(".nursing_result_three").val());
    $('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2().val(advanced_practioner).trigger('change');
  }

  // if ($(".nursing_result_three_experience").val() != "") {
  //   var advanced_practioner = JSON.parse($(".nursing_result_three_experience").val());
  //   $('.js-example-basic-multiple[data-list-id="nursing_entry_experience-3"]').select2().val(advanced_practioner).trigger('change');
  // }

  if ($(".np_result").val() != "") {
    var nurse_prac = JSON.parse($(".np_result").val());
    $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(nurse_prac).trigger('change');
  }

  // if ($(".np_result_experience").val() != "") {
  //   var nurse_prac = JSON.parse($(".np_result_experience").val());
  //   $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu_experience"]').select2().val(nurse_prac).trigger('change');
  // }

  

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


  if ($(".surgical_preoperative_result").val() != "") {
    var surgical_preoperative = JSON.parse($(".surgical_preoperative_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(surgical_preoperative).trigger('change');
  }

  if ($(".operatingroom_result").val() != "") {
    var operating_room = JSON.parse($(".operatingroom_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_care-1"]').select2().val(operating_room).trigger('change');
  }



  if ($(".operatingscout_result").val() != "") {
    var operating_room_scout = JSON.parse($(".operatingscout_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_care-2"]').select2().val(operating_room_scout).trigger('change');
  }


  if ($(".operatingscrub_result").val() != "") {
    var operating_room_scrub = JSON.parse($(".operatingscrub_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_operative_care-3"]').select2().val(operating_room_scrub).trigger('change');
  }


  if ($(".surgical_ob_result").val() != "") {
    var surgical_obstrics_gynacology = JSON.parse($(".surgical_ob_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_obs_care"]').select2().val(surgical_obstrics_gynacology).trigger('change');
  }

  if ($(".neonatal_care_result").val() != "") {
    var neonatal_care = JSON.parse($(".neonatal_care_result").val());
    $('.js-example-basic-multiple[data-list-id="neonatal_care"]').select2().val(neonatal_care).trigger('change');
  }

  if ($(".paedia_surgical_result").val() != "") {
    var paedia_surgical_preoperative = JSON.parse($(".paedia_surgical_result").val());
    $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').select2().val(paedia_surgical_preoperative).trigger('change');
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

  // if ($(".skills_comp").val() != "") {
  //   var skills_comp = JSON.parse($(".skills_comp").val());
  //   $('.js-example-basic-multiple[data-list-id="skills_compantancies"]').select2().val(skills_comp).trigger('change');
  // }

  // if ($(".evidence_type").val() != "") {
  //   var evidence_type = JSON.parse($(".evidence_type").val());
  //   $('.js-example-basic-multiple[data-list-id="type_of_evidence"]').select2().val(evidence_type).trigger('change');
  // }


  

  if ($(".vaccination_r").val() != "") {
    var vaccination_record = JSON.parse($(".vaccination_r").val());
    $('.js-example-basic-multiple[data-list-id="vaccination_record"]').select2().val(vaccination_record).trigger('change');
  }

  if ($(".pro_cert_acls").val() != "") {
    var pro_cert_acls = JSON.parse($(".pro_cert_acls").val());
    ////console.log("pro_cert_acls", pro_cert_acls);
    $('.js-example-basic-multiple[data-list-id="acls_data"]').select2().val(pro_cert_acls).trigger('change');
  }

  if ($(".pro_cert_bls").val() != "") {
    var pro_cert_bls = JSON.parse($(".pro_cert_bls").val());
    ////console.log("pro_cert_bls", pro_cert_bls);
    $('.js-example-basic-multiple[data-list-id="bls_data"]').select2().val(pro_cert_bls).trigger('change');
  }

  if ($(".pro_cert_cpr").val() != "") {
    var pro_cert_cpr = JSON.parse($(".pro_cert_cpr").val());
    ////console.log("pro_cert_bls", pro_cert_cpr);
    $('.js-example-basic-multiple[data-list-id="cpr_data"]').select2().val(pro_cert_cpr).trigger('change');
  }

  if ($(".pro_cert_nrp").val() != "") {
    var pro_cert_nrp = JSON.parse($(".pro_cert_nrp").val());
    ////console.log("pro_cert_bls", pro_cert_nrp);
    $('.js-example-basic-multiple[data-list-id="nrp_data"]').select2().val(pro_cert_nrp).trigger('change');
  }

  if ($(".pro_cert_pals").val() != "") {
    var pro_cert_pals = JSON.parse($(".pro_cert_pals").val());
    ////console.log("pro_cert_bls", pro_cert_pals);
    $('.js-example-basic-multiple[data-list-id="pls_data"]').select2().val(pro_cert_pals).trigger('change');
  }

  if ($(".pro_cert_rn").val() != "") {
    var pro_cert_rn = JSON.parse($(".pro_cert_rn").val());
    ////console.log("pro_cert_bls", pro_cert_rn);
    $('.js-example-basic-multiple[data-list-id="rn_data"]').select2().val(pro_cert_rn).trigger('change');
  }

  if ($(".pro_cert_np").val() != "") {
    var pro_cert_np = JSON.parse($(".pro_cert_np").val());
    ////console.log("pro_cert_bls", pro_cert_np);
    $('.js-example-basic-multiple[data-list-id="np_data"]').select2().val(pro_cert_np).trigger('change');
  }

  if ($(".pro_cert_cna").val() != "") {
    var pro_cert_cna = JSON.parse($(".pro_cert_cna").val());
    ////console.log("pro_cert_bls", pro_cert_cna);
    $('.js-example-basic-multiple[data-list-id="cn_data"]').select2().val(pro_cert_cna).trigger('change');
  }

  if ($(".pro_cert_lpn").val() != "") {
    var pro_cert_lpn = JSON.parse($(".pro_cert_lpn").val());
    ////console.log("pro_cert_bls", pro_cert_lpn);
    $('.js-example-basic-multiple[data-list-id="lpn_data"]').select2().val(pro_cert_lpn).trigger('change');
  }

  if ($(".pro_cert_crna").val() != "") {
    var pro_cert_crna = JSON.parse($(".pro_cert_crna").val());
    ////console.log("pro_cert_bls", pro_cert_crna);
    $('.js-example-basic-multiple[data-list-id="crn_data"]').select2().val(pro_cert_crna).trigger('change');
  }

  if ($(".pro_cert_cnm").val() != "") {
    var pro_cert_cnm = JSON.parse($(".pro_cert_cnm").val());
    ////console.log("pro_cert_bls", pro_cert_cnm);
    $('.js-example-basic-multiple[data-list-id="cnm_data"]').select2().val(pro_cert_cnm).trigger('change');
  }

  if ($(".pro_cert_ons").val() != "") {
    var pro_cert_ons = JSON.parse($(".pro_cert_ons").val());
    ////console.log("pro_cert_bls", pro_cert_ons);
    $('.js-example-basic-multiple[data-list-id="ons_data"]').select2().val(pro_cert_ons).trigger('change');
  }

  if ($(".pro_cert_msw").val() != "") {
    var pro_cert_msw = JSON.parse($(".pro_cert_msw").val());
    ////console.log("pro_cert_bls", pro_cert_msw);
    $('.js-example-basic-multiple[data-list-id="msw_data"]').select2().val(pro_cert_msw).trigger('change');
  }

  if ($(".pro_cert_ain").val() != "") {
    var pro_cert_ain = JSON.parse($(".pro_cert_ain").val());
    ////console.log("pro_cert_bls", pro_cert_ain);
    $('.js-example-basic-multiple[data-list-id="ain_data"]').select2().val(pro_cert_ain).trigger('change');
  }

  if ($(".pro_cert_rpn").val() != "") {
    var pro_cert_rpn = JSON.parse($(".pro_cert_rpn").val());
    ////console.log("pro_cert_bls", pro_cert_rpn);
    $('.js-example-basic-multiple[data-list-id="rpn_data"]').select2().val(pro_cert_rpn).trigger('change');
  }

  

  
  if ($(".perhfield").val() != "") {
    var perhfield = $(".perhfield").val();
    
    console.log("perhfield",$(".perhfield").val());
    $('.js-example-basic-multiple[data-list-id="permanent_status_profession"]').select2().val(perhfield).trigger('change');
    
  }

  if ($(".temphfield").val() != "") {
    var temphfield = $(".temphfield").val();
    
    console.log("temphfield",$(".temphfield").val());
    $('.js-example-basic-multiple[data-list-id="temporary_status_profession"]').select2().val(temphfield).trigger('change');
    
  }

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

  var k = 1;
  $(".pos_hider").each(function(){

    if ($(".pos_hider-"+k).val() != "") {
      var posfield = JSON.parse($(".pos_hider-"+k).val());
      
      console.log("posfield",posfield);
      $('.js-example-basic-multiple[data-list-id="position_held_fieldr-'+k+'"]').select2().val(posfield).trigger('change');
      
      var l = 1;
      $(".subposdatar-"+k).each(function(){
        var position_id = $(".show_positionsr-"+k+" .subpos_list-"+k+l).val();
        console.log("position_id",position_id);
        if ($(".subposdatar-"+k+l).val() != "") {
          var subposfield = JSON.parse($(".subposdatar-"+k+l).val());
          
          console.log("subposfieldr","subposition_held_fieldr-"+k+position_id);
          
          $('.js-example-basic-multiple[data-list-id="subposition_held_fieldr-'+k+position_id+'"]').select2().val(subposfield).trigger('change');
        }
        l++;
      });
    }
    k++;
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

  var u = 1;

  $(".mainfactype").each(function(){

    if ($(".mainfactype-"+u).val() != "") {
      var mainfactype = JSON.parse($(".mainfactype-"+u).val());
      
      console.log("mainfactype",mainfactype);
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

  var x = 1; 
  $(".mainemptypedata").each(function(){
    var val = $(this).val();
    if(val != ""){
      var mainemptype = JSON.parse(val);
      console.log("mainemptype",mainemptype);
      $('.js-example-basic-multiple[data-list-id="employeement_type_experience-'+x+'"]').select2().val(mainemptype).trigger('change');
    }

    $(".subemptypeid-"+x).each(function(){
      var val = $(this).val();
      var subempdata = $(".subemptype-"+val).val();
      if(subempdata != ""){
        var subemptype = JSON.parse(subempdata);
        console.log("subemptype",subemptype);
        $('.js-example-basic-multiple[data-list-id="emptype_field-'+val+'"]').select2().val(subemptype).trigger('change');
      }
    });


    x++;
  });

  function ExpEmpStatus(value,i){
    if (value == "Permanent") {
        $(".exp_permanent-"+i).show();
        $(".exp_temporary-"+i).hide();
        $('.js-example-basic-multiple[data-list-id="temporary_status_experience-'+i+'"]').select2().val("select").trigger('change');
    } else {
        if (value == "Temporary") {
            $(".exp_temporary-"+i).show();
            $(".exp_permanent-"+i).hide();
            $('.js-example-basic-multiple[data-list-id="permanent_status_experience-'+i+'"]').select2().val("select").trigger('change');
        }
    }
  }

  // if ($(".pro_cert_nl").val() != "") {
  //   var pro_cert_nl = JSON.parse($(".pro_cert_nl").val());
  //   ////console.log("pro_cert_bls", pro_cert_nl);
  //   $('.js-example-basic-multiple[data-list-id="nlc_data"]').select2().val(pro_cert_nl).trigger('change');
  // }

  // if ($(".professional_as").val() != "") {
  //   var professional_as = JSON.parse($(".professional_as").val());
  //   ////console.log("professional_as", professional_as);
  //   $('.js-example-basic-multiple[data-list-id="des_profession_association"]').select2().val(professional_as).trigger('change');
  // }

  $(".surgical_row_data").insertAfter("#specility_level-1");
  $(".specialty_sub_boxes").insertAfter(".surgical_row_data");
  $(".surgicalobs_row").insertAfter("#specility_level-2");
  $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
  $(".paediatric_surgical_div").insertAfter("#specility_level-3");
  $(".neonatal_row").insertAfter("#specility_level-3");
  $(".surgical_rowp_data").insertAfter(".surgicalpad_row_data");

  ////console.log("nurse_type1", $('#nurse_type').select2("data"));

  var nurse_type_list = $('#nurse_type').select2("data");

  for (var x = 0; x < nurse_type_list.length; x++) {
    ////console.log('gtyht', nurse_type_list[x]);
    $(".nursing_" + nurse_type_list[x].id).removeClass('d-none');
  }



  var advancedpractioner_list = $('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2("data");
  ////console.log("advancedpractioner_list", advancedpractioner_list);
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
  ////console.log("surgicalpcare_list", surgicalpcare_list);
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

  function getOrdinalSuffix(i) {
    if (i % 100 >= 11 && i % 100 <= 13) {
        return 'th';
    }
    switch (i % 10) {
        case 1: return 'st';
        case 2: return 'nd';
        case 3: return 'rd';
        default: return 'th';
    }
}

  var nurse_array = [];

  function getNurseType(level,k){
    // alert();

    if(level == "main"){
      var selectedValues = $('.js-example-basic-multiple[data-list-id="type-of-nurse-'+k+'"]').val();
    }else{
      var selectedValues = $('.js-example-basic-multiple'+k+'[data-list-id="type-of-nurse-'+k+'"]').val();
    }
    
    console.log("selectedValues",level);

    $(".showNurseType-"+k+" .subnurse_list").each(function(i,val){
        var val1 = $(val).val();
        console.log("val",val1);
        if(selectedValues.includes(val1) == false){
          $(".subnurse_main_div-"+val1).remove();
            
        }
    });
    
    $(".subspecnurse_list").each(function () {

        var val1 = $(this).val();
        console.log("selectedValues_status", selectedValues);
        console.log("val1_specStatus", val1);
        if(selectedValues.includes(val1) == false){

          
          $(".nurse_specialities-"+val1).remove();
          
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
                            <ul id="type-of-nurse-'+data1.main_nurse_id+'" style="display:none;">'+nurse_text+'</ul>\
                            <select class="js-example-basic-multiple'+data1.main_nurse_id+' subnurse_valid-'+data1.main_nurse_id+' addAll_removeAll_btn" data-list-id="type-of-nurse-'+data1.main_nurse_id+'" name="nurseType[type_'+data1.main_nurse_id+'][]" onchange="getNurseType(\''+sub+'\',\''+data1.main_nurse_id+'\')" multiple="multiple"></select>\
                            <span id="reqsubnursevalid-'+data1.main_nurse_id+'" class="reqError text-danger valley"></span>\
                            </div>\
                            <div class="subnurse_level-'+data1.main_nurse_id+'"></div>\
                            <div class="showNurseType-'+data1.main_nurse_id+'"></div>\
                            <div class="showNurseSpeciality-'+data1.main_nurse_id+'"></div>\
                            </div>\
                            ');
              selectTwoFunction(data1.main_nurse_id);
                            
            }else{

              
                  var speciality_text = "";
                  for(var j=0;j<data1.specialities_data.length;j++){
                    
                    speciality_text += "<li data-value='"+data1.specialities_data[j].id+"'>"+data1.specialities_data[j].name+"</li>"; 
                    
                  }
                  var sub = 'sub';  
                  if ($(".nurse_specialities-" + data1.main_nurse_id).length === 0) {
                    $(".showNurseSpeciality-"+k).append('\<div class="condition_set nurse_specialities nurse_specialities-'+data1.main_nurse_id+'">\
                                <div class="form-group drp--clr">\
                                  <label class="form-label" for="input-1">Specialties</label>\
                                  <input type="hidden" name="subspecnurse_list" class="subspecnurse_list subspecnurse_list-'+data1.main_nurse_id+'" value="'+data1.main_nurse_id+'">\
                                  <ul id="speciality_preferences-'+data1.main_nurse_id+'-0" style="display:none;">'+speciality_text+'</ul>\
                                  <select class="js-example-basic-multiple'+data1.main_nurse_id+'-0 addAll_removeAll_btn speciality_type_field" data-list-id="speciality_preferences-'+data1.main_nurse_id+'-0" name="nurseType['+data1.main_nurse_id+'][type_0][]" multiple="multiple" onchange="getSecialities(\''+sub+'\',\''+data1.main_nurse_id+'\',0)"></select>\
                                  <span id="reqspecialties" class="reqError text-danger valley"></span>\
                                </div>\
                                <div class="show_specialities-'+data1.main_nurse_id+'-0"></div>\
                              </div>');
                  }            
                  selectTwoFunction(data1.main_nurse_id+"-"+0);
               
                
            }

            
            
          }
        });
      }
    }
  }

  function getNurseTypeExperience(level,k,x){
    // alert();
    console.log("nurse_type_experience","type-of-nurse-experience-"+x+"-"+k);

    
    if(level == "main"){
      
      var selectedValues = $('.js-example-basic-multiple[data-list-id="type-of-nurse-experience-'+x+"-"+k+'"]').val();
    }else{
      if(level == "add"){
        var selectedValues = $('.js-example-basic-multiple'+x+'[data-list-id="type-of-nurse-experience-'+x+"-"+k+'"]').val();
      }else{
        var selectedValues = $('.js-example-basic-multiple'+k+'[data-list-id="type-of-nurse-experience-'+x+"-"+k+'"]').val();
      }
      
    }
    
    console.log("selectedValues_nurse",selectedValues);

    $(".showNurseTypeExperience-"+x+"-"+k+" .subnurse_list").each(function(i,val){
        var val1 = $(val).val();
        console.log("val",val1);
        if(selectedValues.includes(val1) == false){
          $(".subnurse_main_div-"+val1).remove();
            
        }
    });

    for(var i=0;i<selectedValues.length;i++){
      if($(".showNurseTypeExperience-"+x+"-"+k+" .subnurse_main_div-"+selectedValues[i]).length < 1){
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

            if(data1.sub_nurse_data.length > 0){
              $(".showNurseTypeExperience-"+x+"-"+k).append('\<div class="subnurse_main_div subnurse_main_div-'+data1.main_nurse_id+'">\
                            <div class="subnurse_div subnurse_div-'+data1.main_nurse_id+' form-group level-drp">\
                            <label class="form-label subnurse_label subnurse_label-'+data1.main_nurse_id+'" for="input-1">'+data1.main_nurse_name+'</label>\
                            <input type="hidden" name="subnurse_list" class="subnurse_list subnurse_list-'+data1.main_nurse_id+'" value="'+data1.main_nurse_id+'">\
                            <ul id="type-of-nurse-experience-'+data1.main_nurse_id+"-"+x+'" style="display:none;">'+nurse_text+'</ul>\
                            <select class="js-example-basic-multiple'+data1.main_nurse_id+' subnurse_valid-'+data1.main_nurse_id+' addAll_removeAll_btn" data-list-id="type-of-nurse-experience-'+data1.main_nurse_id+"-"+x+'" name="nurseType['+x+'][type_'+data1.main_nurse_id+'][]" onchange="getNurseTypeExperience(\''+sub+'\',\''+data1.main_nurse_id+'\',\''+x+'\')" multiple="multiple"></select>\
                            <span id="reqsubnursevalid-'+data1.main_nurse_id+'" class="reqError text-danger valley"></span>\
                            </div>\
                            <div class="subnurse_level-'+data1.main_nurse_id+'"></div>\
                            </div><div class="show_nurse-'+data1.main_nurse_id+'"></div>');

                            selectTwoFunction(data1.main_nurse_id);
            }
            
          }
        });
      }
    }
  }

  // function getSecialities(level,k){
  //     // alert();

  //     if(level == "main"){
  //       var selectedValues = $('.js-example-basic-multiple[data-list-id="speciality_preferences-'+k+'"]').val();
  //     }else{
  //       var selectedValues = $('.js-example-basic-multiple'+k+'[data-list-id="speciality_preferences-'+k+'"]').val();
  //     }
      
  //     console.log("selectedValues",selectedValues);

  //     $(".show_specialities-"+k+" .subspec_list").each(function(i,val){
  //           var val1 = $(val).val();
  //           console.log("val",val1);
  //           if(selectedValues.includes(val1) == false){
  //             $(".subspec_main_div-"+val1).remove();
                
  //           }
  //       });

  //       $(".show_specialitiesStatus-"+k+" .subspecprof_list").each(function(i,val){
  //           var val2 = $(val).val();
  //           console.log("val2",val2);
  //           if(selectedValues.includes(val2) == false){
              
  //             $(".subspecprofdiv-"+val2).remove();
                
  //           }
  //       });

  //     for(var i=0;i<selectedValues.length;i++){
  //       if($(".show_specialities-"+k+" .subspec_main_div-"+selectedValues[i]).length < 1){
  //         $.ajax({
  //           type: "GET",
  //           url: "{{ url('/nurse/getSpecialityDatas1') }}",
  //           data: {speciality_id:selectedValues[i]},
  //           cache: false,
  //           success: function(data){
  //             var data1 = JSON.parse(data);
  //             console.log("data1",data1);

  //             var speciality_text = "";
  //             for(var j=0;j<data1.sub_spciality_data.length;j++){
                
  //               speciality_text += "<li data-value='"+data1.sub_spciality_data[j].id+"'>"+data1.sub_spciality_data[j].name+"</li>"; 
                
  //             }
  //             var sub = 'sub';

  //             if(data1.sub_spciality_data.length > 0){
  //               $(".show_specialities-"+k).append('\<div class="subspec_main_div subspec_main_div-'+data1.main_speciality_id+'">\
  //                             <div class="subspec_div subspec_div-'+data1.main_speciality_id+' form-group level-drp">\
  //                             <label class="form-label subspec_label subspec_label-'+data1.main_speciality_id+'" for="input-1">'+data1.main_speciality_name+'</label>\
  //                             <input type="hidden" name="subspec_list" class="subspec_list subspec_list-'+data1.main_speciality_id+'" value="'+data1.main_speciality_id+'">\
  //                             <ul id="speciality_preferences-'+data1.main_speciality_id+'" style="display:none;">'+speciality_text+'</ul>\
  //                             <select class="js-example-basic-multiple'+data1.main_speciality_id+' subspec_valid-'+data1.main_speciality_id+' addAll_removeAll_btn" data-list-id="speciality_preferences-'+data1.main_speciality_id+'" name="specialties[type_'+data1.main_speciality_id+'][]" onchange="getSecialities(\''+sub+'\',\''+data1.main_speciality_id+'\')" multiple="multiple"></select>\
  //                             <span id="reqsubspecvalid-'+data1.main_speciality_id+'" class="reqError text-danger valley"></span>\
  //                             </div>\
  //                             <div class="subspec_level-'+data1.main_speciality_id+'"></div>\
  //                             <div class="show_specialities-'+data1.main_speciality_id+'"></div>\
  //                             <div class="show_specialitiesStatus-'+data1.main_speciality_id+'"></div>\
  //                             </div>');

  //                             selectTwoFunction(data1.main_speciality_id);
              
  //             }else{
                
  //               if($(".show_specialitiesStatus-"+k+" .subspecprofdiv-"+data1.main_speciality_id).length < 1){
                  
  //                 $(".show_specialitiesStatus-"+k).append('<div class="custom-select-wrapper subspecprofdiv subspecprofdiv-'+data1.main_speciality_id+' form-group level-drp" style="margin-bottom: 5px;">\
  //                   <label class="form-label subspeclabel-'+data1.main_speciality_id+'" for="input-1">\
  //                   Specialty Status ('+data1.main_speciality_name+')\
  //                   <span class="info tooltip-btn" tabindex="0" aria-describedby="statusTooltip">ⓘ</span>\
  //                     <ul class="tooltip_speciality_status" style="padding-left:18px; margin:8px 0 0 0">\
  //                       <li><strong>Status definitions:</strong></li>\
  //                       <li><strong>Current:</strong> Actively practicing, used in present or most recent job.</li>\
  //                       <li><strong>Principal:</strong> Main/strongest specialty (only one allowed).</li>\
  //                       <li><strong>First:</strong> First-ever specialty after qualification.</li>\
  //                       <li><strong>Former:</strong> Previously practiced.</li>\
  //                       <li><strong>Upskilling / Transitioning / Training:</strong> Moving into this specialty.</li>\
  //                       <li><strong>—</strong> (No status selected — default when nurse doesn’t pick one).</li>\
  //                     </ul>\
  //                   </label>\
  //                   <input type="hidden" name="subspecprof_list" class="subspecprof_list subspecprof_list-'+data1.main_speciality_id+' subspecprof_listProfession subspecprof_listProfession-'+data1.main_speciality_id+'" value="'+data1.main_speciality_id+'">\
  //                   <select data-id="'+data1.main_speciality_id+'" class="custom-select speciality_status_column  speciality_status_columns-'+data1.main_speciality_id+' speciality_status_column-'+k+' form-input mr-10 langprof_level_valid-'+data1.main_speciality_id+'" name="specialties[speciality_status][type_'+data1.main_speciality_id+'][status]" onchange="changeSpecialityStatus(this.value,'+data1.main_speciality_id+','+k+')">\
  //                     <option value="">select</option>\
  //                     <option value="Current">Current</option>\
  //                     <option value="Principal">Principal</option>\
  //                     <option value="First">First</option>\
  //                     <option value="Former">Former</option>\
  //                     <option value="Upskilling / Transitioning / Training">Upskilling / Transitioning / Training</option>\
  //                   </select>\
  //                   <input type="hidden" class="speciality_flag-'+data1.main_speciality_id+' is_current_'+data1.main_speciality_id+'" name="specialties[speciality_status][type_'+data1.main_speciality_id+'][is_current]" value="0">\
  //                   <input type="hidden" class="speciality_flag-'+data1.main_speciality_id+' is_principal_'+data1.main_speciality_id+'" name="specialties[speciality_status][type_'+data1.main_speciality_id+'][is_principal]" value="0">\
  //                   <input type="hidden" class="speciality_flag-'+data1.main_speciality_id+' is_first_'+data1.main_speciality_id+'" name="specialties[speciality_status][type_'+data1.main_speciality_id+'][is_first]" value="0">\
  //                   <input type="hidden" class="speciality_flag-'+data1.main_speciality_id+' is_former_'+data1.main_speciality_id+'" name="specialties[speciality_status][type_'+data1.main_speciality_id+'][is_former]" value="0">\
  //                   <input type="hidden" class="speciality_flag-'+data1.main_speciality_id+' is_upskilling_'+data1.main_speciality_id+'" name="specialties[speciality_status][type_'+data1.main_speciality_id+'][is_upskilling]" value="0">\
  //                   </div>\
  //                   <span id="reqsubspeclevelvalid-'+data1.main_speciality_id+'" class="reqError text-danger valley"></span>\
  //                   ');

  //                   document.querySelectorAll('.tooltip-btn').forEach(btn => {
  //                       const tooltip = btn.parentElement.querySelector('.tooltip_speciality_status');

  //                       btn.addEventListener('mouseenter', () => {
  //                           tooltip.style.display = 'block';
  //                       });

  //                       btn.addEventListener('mouseleave', () => {
  //                           tooltip.style.display = 'none';
  //                       });
  //                   });
  //               }  
  //             }
  //           }
  //         });
  //       }
  //     }
  //   }

function getSecialitiesExperience(level,k,x){
       
      console.log("specialties_type_experience",level);
      if(level == "main"){
       
        var selectedValues = $('.js-example-basic-multiple[data-list-id="specialties_type_experience-'+x+"-"+k+'"]').val();
      }else{
        if(level == "add"){
          var selectedValues = $('.js-example-basic-multiple'+x+'[data-list-id="specialties_type_experience-'+x+"-"+k+'"]').val();
        }else{
          var selectedValues = $('.js-example-basic-multiple'+k+'[data-list-id="specialties_type_experience-'+x+"-"+k+'"]').val();
        }
        
      }
      
      console.log("selectedValues_spec",selectedValues);

      $(".subspec_list_experiencess-"+x+"-"+k).each(function () {

        var val1 = $(this).val();
        console.log("selectedValues_fun_exp", selectedValues);
        console.log("val1_spec_exp", val1);
        if(selectedValues.includes(val1) == false){

          //alert("hell");
          $(".subspec_main_div_experience-"+val1).remove();
          
        }
      });

      $(".subspecstatusexp_list-"+x+"-"+k).each(function () {

            var val1 = $(this).val();
            console.log("selectedValues_status_exp", selectedValues);
            console.log("val1_specStatus_exp", val1);
            if(selectedValues.includes(val1) == false){

              
              $(".subspecdivexp-"+val1).remove();
              
            }
        });

      for(var i=0;i<selectedValues.length;i++){
        if($(".show_specialitiesExperience-"+x+"-"+k+" .subspec_main_div_experience-"+selectedValues[i]).length < 1){
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
                $(".show_specialitiesExperience-"+x+"-"+k).append('\<div class="subspec_main_div_experience subspec_main_div_experience-'+data1.main_speciality_id+'">\
                              <div class="subspec_div subspec_div-'+data1.main_speciality_id+' form-group level-drp">\
                              <label class="form-label subspec_label subspec_label-'+data1.main_speciality_id+'" for="input-1">'+data1.main_speciality_name+'</label>\
                              <input type="hidden" name="subspec_list" class="subspec_list subspec_list_experiencess-'+x+"-"+k+' subspec_list-'+x+"-"+data1.main_speciality_id+' subspec_list-'+data1.main_speciality_id+'" value="'+data1.main_speciality_id+'">\
                              <ul id="specialties_type_experience-'+x+"-"+data1.main_speciality_id+'" style="display:none;">'+speciality_text+'</ul>\
                              <select class="js-example-basic-multiple'+data1.main_speciality_id+' subspec_valid-'+data1.main_speciality_id+' addAll_removeAll_btn" data-list-id="specialties_type_experience-'+x+"-"+data1.main_speciality_id+'" name="specialties_experience['+x+'][type_'+data1.main_speciality_id+'][]" onchange="getSecialitiesExperience(\''+sub+'\',\''+data1.main_speciality_id+'\',\''+x+'\')" multiple="multiple"></select>\
                              <span id="reqsubspecvalid-'+data1.main_speciality_id+'" class="reqError text-danger valley"></span>\
                              </div>\
                              <div class="subspec_level-'+data1.main_speciality_id+'"></div>\
                              <div class="show_specialitiesExperience-'+x+"-"+data1.main_speciality_id+'"></div>\
                              <div class="show_specialitiesStatusExperience-'+x+"-"+data1.main_speciality_id+'"></div>\
                              </div>');

                              selectTwoFunction(data1.main_speciality_id);
              
              }else{
                
                if($(".show_specialitiesStatusExperience-"+x+"-"+k+" .subspecprofdiv-"+data1.main_speciality_id).length < 1){
                  
                  $(".show_specialitiesStatusExperience-"+x+"-"+k).append('<div class="custom-select-wrapper subspecprofdivexp subspecprofdivexp-'+data1.main_speciality_id+' form-group level-drp" style="margin-bottom: 5px;">\
                    <label class="form-label subspeclabel-'+data1.main_speciality_id+'" for="input-1">\
                    Specialty Status ('+data1.main_speciality_name+')\
                    <span class="info tooltip-btn" tabindex="0" aria-describedby="statusTooltip">ⓘ</span>\
                     <ul class="tooltip_speciality_status" style="padding-left:18px; margin:8px 0 0 0">\
                      <li><strong>Status definitions:</strong></li>\
                      <li><strong>Current:</strong> Actively practicing, used in present or most recent job.</li>\
                      <li><strong>Principal:</strong> Main/strongest specialty (only one allowed).</li>\
                      <li><strong>First:</strong> First-ever specialty after qualification.</li>\
                      <li><strong>Former:</strong> Previously practiced.</li>\
                      <li><strong>Upskilling / Transitioning / Training:</strong> Moving into this specialty.</li>\
                      <li><strong>—</strong> (No status selected — default when nurse doesn’t pick one).</li>\
                    </ul>\
                    </label>\
                    <input type="hidden" name="subspecprof_list" class="subspecprof_list subspecprof_list-'+data1.main_speciality_id+'" value="'+data1.main_speciality_id+'">\
                    <select data-id="'+data1.main_speciality_id+'" class="custom-select speciality_status_column speciality_status_column-'+data1.main_speciality_id+' form-input mr-10 select-active langprof_level_valid-'+data1.main_speciality_id+'" name="specialties_experience['+x+'][speciality_status][type_'+data1.main_speciality_id+'][status]" onchange="changeSpecialityStatus(this.value,'+data1.main_speciality_id+')">\
                      <option value="">select</option>\
                      <option value="Current">Current</option>\
                      <option value="Principal">Principal</option>\
                      <option value="First">First</option>\
                      <option value="Former">Former</option>\
                      <option value="Upskilling / Transitioning / Training">Upskilling / Transitioning / Training</option>\
                    </select>\
                    <input type="hidden" class="speciality_flag-'+data1.main_speciality_id+' is_current_'+data1.main_speciality_id+'" name="specialties[speciality_status][type_'+data1.main_speciality_id+'][is_current]" value="0">\
                    <input type="hidden" class="speciality_flag-'+data1.main_speciality_id+' is_principal_'+data1.main_speciality_id+'" name="specialties[speciality_status][type_'+data1.main_speciality_id+'][is_principal]" value="0">\
                    <input type="hidden" class="speciality_flag-'+data1.main_speciality_id+' is_first_'+data1.main_speciality_id+'" name="specialties[speciality_status][type_'+data1.main_speciality_id+'][is_first]" value="0">\
                    <input type="hidden" class="speciality_flag-'+data1.main_speciality_id+' is_former_'+data1.main_speciality_id+'" name="specialties[speciality_status][type_'+data1.main_speciality_id+'][is_former]" value="0">\
                    <input type="hidden" class="speciality_flag-'+data1.main_speciality_id+' is_upskilling_'+data1.main_speciality_id+'" name="specialties[speciality_status][type_'+data1.main_speciality_id+'][is_upskilling]" value="0">\
                    </div>\
                    <span id="reqsubspeclevelvalid-'+data1.main_speciality_id+'" class="reqError text-danger valley"></span>\
                    ');

                    document.querySelectorAll('.tooltip-btn').forEach(btn => {
                        const tooltip = btn.parentElement.querySelector('.tooltip_speciality_status');

                        btn.addEventListener('mouseenter', () => {
                            tooltip.style.display = 'block';
                        });

                        btn.addEventListener('mouseleave', () => {
                            tooltip.style.display = 'none';
                        });
                    });
                }  
              }
            }
          });
        }
      }
    }
  //   // $(".").each(function(){

  //   // });

  //  document.querySelectorAll('.tooltip-btn').forEach(btn => {
  //     const tooltip = btn.parentElement.querySelector('.tooltip_speciality_status');

  //     btn.addEventListener('mouseenter', () => {
  //         tooltip.style.display = 'block';
  //     });

  //     btn.addEventListener('mouseleave', () => {
  //         tooltip.style.display = 'none';
  //     });
  // });
 var specialityTree = {};
var specialityStatus = {};

try {
    specialityTree = JSON.parse(@json($user_data->specialties));
    specialityStatus = specialityTree.speciality_status || {};
} catch (e) {}

$('.show_specialitiesStatus').remove(); // remove previously attached ones
console.log("specialityTree",specialityTree);
$.each(specialityTree, function (parentKey, children) {

    if (parentKey === 'speciality_status') return;
    if (!Array.isArray(children)) return;

    const parentId = parentKey.replace('type_', '');

    children.forEach(function (childId) {

        $('.subspec_main_div-' + childId).not(':first').remove();

        const $parentDiv = $('.subspec_main_div-' + parentId);
        const $childDiv  = $('.subspec_main_div-' + childId);
        if (!$parentDiv.length || !$childDiv.length) return;

        let $wrapper = $parentDiv.children('.show_specialities-' + parentId);
        if (!$wrapper.length) {
            $wrapper = $('<div/>', {
                class: 'show_specialities show_specialities-' + parentId
            }).appendTo($parentDiv);
        }

        /* destroy select2 before move */
        $childDiv.find('select').each(function () {
            if ($(this).data('select2')) {
                $(this).select2('destroy');
            }
        });

        $wrapper.append($childDiv);

        /* 🔥 GET ONE STATUS TEMPLATE */
        let $statusTemplate = $('.status-template').first();
        if (!$statusTemplate.length) return;

        // /* clone */
        let $statusClone = $statusTemplate.clone(true, true);

        // /* make visible */
        $statusClone.removeClass('d-none status-template');

        // /* clean select2 */
        $statusClone.find('select')
        .removeClass('select2-hidden-accessible')
        .removeAttr('data-select2-id')
        .next('.select2').remove();

        // /* set saved value */
        let savedStatus = specialityStatus['type_' + childId]?.status || '';
        $statusClone.find('select').val(savedStatus);

        /* attach */
        $childDiv.after($statusClone);

        /* init select2 */
        $statusClone.find('select').select2({ width: '100%' });
        $childDiv.find('select').select2({ width: '100%' });

        console.log("childId",childId);
        
    });

    children.forEach(function (childId) {

       
        var j = 1;
        $(".subspec_list_experience_count").each(function(){
        //for experience
        $('.subspec_main_div_experience-' + childId).not(':first').remove();

        const $parentDiv_exp = $('.subspec_main_div_experience-' + parentId);
        const $childDiv_exp  = $('.subspec_main_div_experience-' + childId);
        if (!$parentDiv_exp.length || !$childDiv_exp.length) return;

        let $wrapper_exp = $parentDiv_exp.children('.show_specialitiesExperience-'+j+'-' + parentId);
        if (!$wrapper_exp.length) {
            $wrapper_exp = $('<div/>', {
                class: 'show_specialitiesExperience show_specialitiesExperience-'+j+'-' + parentId
            }).appendTo($parentDiv_exp);
        }

        /* destroy select2 before move */
        $childDiv_exp.find('select').each(function () {
            if ($(this).data('select2')) {
                $(this).select2('destroy');
            }
        });

        $wrapper_exp.append($childDiv_exp);

        /* 🔥 GET ONE STATUS TEMPLATE */
        let $statusTemplate_exp = $('.status-template-exp').first();
        if (!$statusTemplate_exp.length) return;

        /* clone */
        let $statusClone_exp = $statusTemplate_exp.clone(true, true);

        /* make visible */
        $statusClone_exp.removeClass('d-none status-template-exp');

        /* clean select2 */
        $statusClone_exp.find('select')
            .removeClass('select2-hidden-accessible')
            .removeAttr('data-select2-id')
            .next('.select2').remove();

        /* set saved value */
        let savedStatus_exp = specialityStatus['type_' + childId]?.status || '';
        $statusClone_exp.find('select').val(savedStatus);

        /* attach */
        $childDiv_exp.after($statusClone_exp);

        /* init select2 */
        $statusClone_exp.find('select').select2({ width: '100%' });
        $childDiv_exp.find('select').select2({ width: '100%' });
        j++;
        });
    });
});
  function getSecialities(level,nurse_id, k) {

    

    if (level === "main") {
        var selectedValues = $('.js-example-basic-multiple[data-list-id="speciality_preferences-' + nurse_id + '"]').val() || [];
    } else {
        var selectedValues = $('.js-example-basic-multiple' + nurse_id+"-" +k+ '[data-list-id="speciality_preferences-' + nurse_id+"-"+k+ '"]').val() || [];
    }

    

    console.log("selectedValues", selectedValues);

    /* ===============================
       ✅ SAFE REMOVAL (CHILD ONLY)
    =============================== */

    $(".subspec_listProf-"+k).each(function () {

            var val1 = $(this).val();
            console.log("selectedValues_fun", selectedValues);
            console.log("val1_spec", val1);
            if(selectedValues.includes(val1) == false){

              //alert("hell");
              console.log("val1_spec1", val1);
              $(".subspec_main_div-"+nurse_id+"-"+val1).remove();
              
            }
        });

        $(".subspecprofpart_list-"+k).each(function () {

            var val1 = $(this).val();
            console.log("selectedValues_status", selectedValues);
            console.log("val1_specStatus", val1);
            if(selectedValues.includes(val1) == false){

              
              $(".subspecprofdiv-"+nurse_id+"-"+val1).remove();
              
            }
        });

    /* ===============================
       ✅ ADD NEW SELECTIONS
    =============================== */

    selectedValues.forEach(function (specId) {

        if ($(".subspec_main_div-"+nurse_id+"-"+ specId).length > 0) return;

        $.ajax({
            type: "GET",
            url: "{{ url('/nurse/getSpecialityDatas1') }}",
            data: { speciality_id: specId },
            cache: false,
            success: function (data) {

                const data1 = JSON.parse(data);

                let speciality_text = "";
                data1.sub_spciality_data.forEach(function (s) {
                    speciality_text += "<li data-value='" + s.id + "'>" + s.name + "</li>";
                });

                /* ===== HAS SUB SPECIALTIES ===== */
                if (data1.sub_spciality_data.length > 0) {

                    $(".show_specialities-"+nurse_id+"-" + k).append(`
                        <div class="subspec_main_div subspec_main_div-${nurse_id}-${data1.main_speciality_id}"
                             data-id="${data1.main_speciality_id}"
                             data-parent="${k}">

                            <div class="subspec_div form-group level-drp">
                                <label class="form-label">${data1.main_speciality_name}</label>

                                <input type="hidden" class="subspec_list subspec_listProf-${k} subspec_list-${k}" value="${data1.main_speciality_id}">

                                <ul id="speciality_preferences-${nurse_id}-${data1.main_speciality_id}" style="display:none;">
                                    ${speciality_text}
                                </ul>

                                <select class="js-example-basic-multiple${nurse_id}-${data1.main_speciality_id} subspec_valid-${data1.main_speciality_id} addAll_removeAll_btn"
                                        data-list-id="speciality_preferences-${nurse_id}-${data1.main_speciality_id}"
                                        name="nurseType[${nurse_id}][type_${data1.main_speciality_id}][]"
                                        multiple
                                        onchange="getSecialities('sub', ${nurse_id}, ${data1.main_speciality_id})">
                                </select>
                            </div>
                            <span id="reqsubspecvalid-${data1.main_speciality_id}" class="reqError text-danger valley"></span>
                            <div class="show_specialities-${nurse_id}-${data1.main_speciality_id}"></div>
                            <div class="show_specialitiesStatus-${nurse_id}-${data1.main_speciality_id}"></div>
                            
                        </div>
                    `);

                    selectTwoFunction(nurse_id+"-"+data1.main_speciality_id);
                }
                /* ===== LEAF NODE (STATUS) ===== */
                else {

                    var experience_text = "";
                    for(var i=1;i<=30;i++){
                      experience_text += "<option value='" + i + "'>" + i + getOrdinalSuffix(i) + " Year</option>";
                    }

                    if ($(".subspecprofdiv-" + data1.main_speciality_id).length === 0) {

                        $(".show_specialitiesStatus-"+nurse_id+"-" + k).append(`<div class="subspecprofdiv subspecprofdiv-${nurse_id}-${data1.main_speciality_id}">
                            <div class="custom-select-wrapper
                                 data-id="${data1.main_speciality_id}"
                                 data-parent="${k}">
                                 
                                <label class="form-label">
                                    Specialty Status (${data1.main_speciality_name})
                                    
                                    <span class="info tooltip-btn" tabindex="0" aria-describedby="statusTooltip">ⓘ</span>
                                    <ul class="tooltip_speciality_status" style="padding-left:18px; margin:8px 0 0 0">
                                      <li><strong>Status definitions:</strong></li>
                                      <li><strong>Current:</strong> Actively practicing, used in present or most recent job.</li>
                                      <li><strong>Principal:</strong> Main/strongest specialty (only one allowed).</li>
                                      <li><strong>First:</strong> First-ever specialty after qualification.</li>
                                      <li><strong>Former:</strong> Previously practiced.</li>
                                      <li><strong>Upskilling / Transitioning / Training:</strong> Moving into this specialty.</li>
                                      <li><strong>—</strong> (No status selected — default when nurse doesn’t pick one).</li>
                                    </ul>
                                </label>
                                <input type="hidden" name="subspecprof_list" class="subspecprof_list subspecprofpart_list-${k} subspecprof_listProfession subspecprof_listProfession-${data1.main_speciality_id} subspecprof_list-${data1.main_speciality_id}" value="${data1.main_speciality_id}">
                                
                                <select class="custom-select speciality_status_columns-${data1.main_speciality_id}"
                                    name="nurseType[${nurse_id}][speciality_status][type_${data1.main_speciality_id}][status]">
                                    <option value="">select</option>
                                    <option value="Current">Current</option>
                                    <option value="Principal">Principal</option>
                                    <option value="First">First</option>
                                    <option value="Former">Former</option>
                                    <option value="Upskilling / Transitioning / Training">
                                        Upskilling / Transitioning / Training
                                    </option>
                                </select>
                                <span id="reqsubspeclevelvalid-${data1.main_speciality_id}" class="reqError text-danger valley"></span>
                            </div>
                            <div class="custom-select-wrapper form-group level-drp">
                              <label class="form-label" for="input-1">What is your overall level of experience in nursing/midwifery?
                              </label>
                              <select class="custom-select" name="nurseType[${nurse_id}][speciality_status][type_${data1.main_speciality_id}][assistent_level]">
                                <option value="">Please Select</option>
                                ${experience_text}
                              </select>
                              <span id="reqassistentlevel" class="reqError text-danger valley"></span>
                            </div>
                            <div class="professional_bio professional_employee_status">
                            <div class="custom-select-wrapper form-group level-drp col-md-12">
                              <label class="form-label" for="input-1">Current Employment Status</label>
                              <select class="custom-select" name="nurseType[${nurse_id}][speciality_status][type_${data1.main_speciality_id}][employee_status]" onchange="employeeStatus(this.value,${nurse_id},${data1.main_speciality_id})">
                                <option value="">select</option>
                                <option value="Permanent">Permanent</option>
                                <option value="Fixed-term">Fixed-term</option>
                                <option value="Temporary">Temporary</option>
                                <option value="Unemployed">Unemployed</option>
                              </select>
                            </div>
                            <span id="reqemployee_status" class="reqError text-danger valley"></span>
                          </div>
                          <div class="professional_permanent-${nurse_id}-${data1.main_speciality_id}" style="display:none;">
                            <div class="form-group level-drp col-md-12">
                              <label class="form-label" for="input-1">Permanent</label>
                              <input type="hidden" name="perhfield" class="perhfield" value="">
                              <ul id="permanent_status_profession-${nurse_id}-${data1.main_speciality_id}" style="display:none;">
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
                              <select class="js-example-basic-multiple${nurse_id}-${data1.main_speciality_id}" data-list-id="permanent_status_profession-${nurse_id}-${data1.main_speciality_id}" name="nurseType[${nurse_id}][speciality_status][type_${data1.main_speciality_id}][permanent_status]" id="permanent_status"></select>
                              <span id="reqemployeep_status" class="reqError text-danger valley"></span>
                            </div>
                          </div>
                          <div class="professional_temporary-${nurse_id}-${data1.main_speciality_id}" style="display: none;">
                            <div class="form-group level-drp col-md-12">
                              <label class="form-label" for="input-1">Temporary</label>
                              <input type="hidden" name="temphfield" class="temphfield" value="">
                              
                              <ul id="temporary_status_profession-${nurse_id}-${data1.main_speciality_id}" style="display:none;">
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
                              <select class="js-example-basic-multiple${nurse_id}-${data1.main_speciality_id}" data-list-id="temporary_status_profession-${nurse_id}-${data1.main_speciality_id}" name="nurseType[${nurse_id}][speciality_status][type_${data1.main_speciality_id}][temporary_status]" id="temporary_status_profession"></select>
                              <span id="reqemployeet_status" class="reqError text-danger valley"></span>
                            </div>
                            
                          </div>
                          <div class="custom-select-wrapper professional_unemplyeed-${nurse_id}-${data1.main_speciality_id}" style="display: none;">
                            <div class="form-group level-drp col-md-12">
                              <label class="form-label" for="input-1">Reason for Unemployment</label>
                              <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                              <select class="custom-select mr-10 select-active unemployeement_reason" name="nurseType[${nurse_id}][speciality_status][type_${data1.main_speciality_id}][unemployeement_reason]" id="unemployeement_reason" onchange="reasonUnemployeement(this.value,${nurse_id},${data1.main_speciality_id})">
                                <option value="">select</option>
                                <option value="Recently graduated">Recently graduated</option>
                                <option value="Career break (maternity leave, family reasons, etc.)">Career break (maternity leave, family reasons, etc.)</option>
                                <option value="Transitioning from another job">Transitioning from another job</option>
                                <option value="Retired but seeking work">Retired but seeking work</option>
                                <option value="Laid off / Contract ended">Laid off / Contract ended</option>
                                <option value="Other (Please specify)">Other (Please specify)</option>
                              </select>
                            </div>
                            <span id="requnempreason" class="reqError text-danger valley"></span>
                          </div>
                          <div class="form-group d-none specify_reason_div-${nurse_id}-${data1.main_speciality_id}">
                            <label class="form-label" for="input-1">Other (Please specify)</label>
                            
                            <input class="form-control" type="text" name="specify_reason" value="">
                            <span id="otherspecify_reason" class="reqError text-danger valley"></span>
                          </div>
                          <div class="custom-select-wrapper long_unemplyeed-${nurse_id}-${data1.main_speciality_id} d-none">
                            <div class="form-group level-drp col-md-12">
                              <label class="form-label" for="input-1">How long have you been unemployed?</label>
                              <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                              <select class="custom-select long_unemployeed" name="nurseType[${nurse_id}][speciality_status][type_${data1.main_speciality_id}][long_unemployeed]" id="long_unemployeed">
                                <option value="">select</option>
                                <option value="Less than 1 month">Less than 1 month</option>
                                <option value="1 to 3 months">1 to 3 months</option>
                                <option value="3 to 6 months">3 to 6 months</option>
                                <option value="6 months to 1 year">6 months to 1 year</option>
                                <option value="More than 1 year">More than 1 year</option>
                                
                              </select>
                              <span id="reqlong_unemp" class="reqError text-danger valley"></span>
                            </div>
                            
                          </div>
                          </div>
                        `);
                        selectTwoFunction(nurse_id+"-"+data1.main_speciality_id);
                    }
                }
            }
        });
    });
  }

  function reasonUnemployeement(value,nurse_id,speciality_id){
    if(value == "Other (Please specify)"){
      $(".specify_reason_div-"+nurse_id+"-"+speciality_id).removeClass("d-none");
    }else{
      $(".specify_reason_div-"+nurse_id+"-"+speciality_id).addClass("d-none");
    }
  }

  function employeeStatus(value,nurse_id,speciality_id) {
                        
    if (value == "Permanent") {
      $(".professional_permanent-"+nurse_id+"-"+speciality_id).show();
      $(".professional_temporary-"+nurse_id+"-"+speciality_id).hide();
      $(".professional_unemplyeed-"+nurse_id+"-"+speciality_id).hide();
      $(".specify_reason_div-"+nurse_id+"-"+speciality_id).addClass("d-none");
      $(".long_unemplyeed-"+nurse_id+"-"+speciality_id).addClass('d-none');
      
    } else {
      if (value == "Temporary") {
        $(".professional_temporary-"+nurse_id+"-"+speciality_id).show();
        $(".professional_permanent-"+nurse_id+"-"+speciality_id).hide();
        $(".professional_unemplyeed-"+nurse_id+"-"+speciality_id).hide();
        $(".long_unemplyeed-"+nurse_id+"-"+speciality_id).addClass('d-none');
        $(".specify_reason_div-"+nurse_id+"-"+speciality_id).addClass("d-none");
      }else{
        $(".professional_temporary-"+nurse_id+"-"+speciality_id).hide();
        $(".professional_permanent-"+nurse_id+"-"+speciality_id).hide();
        $(".professional_unemplyeed-"+nurse_id+"-"+speciality_id).show();
        $(".long_unemplyeed-"+nurse_id+"-"+speciality_id).removeClass('d-none');

        var value = $("#unemployeement_reason").val();
        if(value == "Other (Please specify)"){
          $(".specify_reason_div-"+nurse_id+"-"+speciality_id).removeClass("d-none");
        }else{
          $(".specify_reason_div-"+nurse_id+"-"+speciality_id).addClass("d-none");
        }
      }
    }
  }
  function removeSpecialityTree(id) {

      $(".show_specialities-" + id + " > .subspec_main_div").each(function () {
          removeSpecialityTree($(this).data("id"));
      });

      $(".subspecprofdiv-" + id).remove();
      $(".subspec_main_div-" + id).remove();
  }

    function changeSpecialityStatus(selectedValue,data_id,k){
      $(".speciality_flag-"+data_id).val(0);
      
      // Reset all hidden inputs first
      
      // Set selected flag
      if (selectedValue === "Current") {
        //wrapper.find(`[name="specialty[${data_id}][is_current]"]`).value = 1;
        $(".is_current_"+data_id).val(1);
      }
      if (selectedValue === "First") {
        
        $(".is_first_"+data_id).val(1);
      }
      if (selectedValue === "Former") {
        $(".is_former_"+data_id).val(1);
      }
      if (selectedValue === "Upskilling") {
        $(".is_upskilling_"+data_id).val(1);
      }
      // If user selects Principal, validate
      if (selectedValue === "Principal") {

          $(".is_principal_"+data_id).val(1);

          let countPrincipal = 0;

          $(".speciality_status_column-"+k).each(function () {
              if ($(this).val() === "Principal") {
                  countPrincipal++;
              }
          });
          
          if (countPrincipal > 1) {
              // Show message
              //alert("You can mark only one specialty as Principal, please select your main one.");
              $("#reqsubspeclevelvalid-"+data_id).text("You can mark only one specialty as Principal, please select your main one.");
              // Reset the current dropdown to previous value
              //alert(".speciality_status_columns-"+data_id);
              $(".speciality_status_columns-"+data_id).val("");
              

          }
      }
    }



    document.querySelectorAll('.tooltip-btn').forEach(btn => {
      const tooltip = btn.parentElement.querySelector('.tooltip_speciality_status');

      btn.addEventListener('mouseenter', () => {
          tooltip.style.display = 'block';
      });

      btn.addEventListener('mouseleave', () => {
          tooltip.style.display = 'none';
      });
    });
  // $('.js-example-basic-multiple[data-list-id="mandatory_courses"]').on('change', function() {
  //       let selectedValues = $(this).val();
  //       //alert("hello");
  //       var courses_len = $("#mandatory_courses li").length;

  //       $(".mandatory_training_value").each(function(){
  //         ////console.log("mandatory_training_value",$(this).val());
  //         var training_val = $(this).val();
  //         if(selectedValues.includes(training_val)){
  //           $(".mandatory_courses_div_"+training_val).show();
  //         }else{
  //           $(".mandatory_courses_div_"+training_val).hide();
  //         }
  //       });



  //   });
  // Show corresponding job lists when an option is selected in the first select
  

  // $('.js-example-basic-multiple[data-list-id="skills_compantancies"]').on('change', function() {

  //   let selectedValues = $(this).val();

  //   $('.skills_compantancies_dropdowns').empty();
  //   ////console.log("skills_data", selectedValues);
  //   for (var i = 0; i < selectedValues.length; i++) {

  //     $.ajax({
  //       type: "POST",
  //       url: "{{ url('/nurse') }}/getSkillsData",
  //       data: {
  //         id: selectedValues[i],
  //         _token: "{{ csrf_token() }}"
  //       },
  //       cache: false,
  //       success: function(data) {

  //         var skills = JSON.parse(data);
  //         ////console.log("selectedValues", skills[0].parent_id);
  //         var skills_data = '';
  //         for (var j = 0; j < skills.length; j++) {
  //           skills_data += '<li data-value="' + skills[j]['id'] + '">' + skills[j]['name'] + '</li>';
  //         }
  //         ////console.log("skills_data", skills_data);
  //         $(".skills_compantancies_dropdowns").append('<div class="form-group level-drp" ><label class="form-label" for="input-1">' + skills[0].parent_name + '</label><ul id="skills_compantancies-' + skills[0].parent_id + '" style="display:none;">' + skills_data + '</ul><select class="js-example-basic-multiple1 addAll_removeAll_btn" data-list-id="skills_compantancies-' + skills[0].parent_id + '" name="skills_compantancies[]" multiple="multiple"></select></div>');

  //         $('.addAll_removeAll_btn').on('select2:open', function() {
  //           var $dropdown = $(this);
  //           var searchBoxHtml = `

  //                   <div class="extra-buttons">
  //                       <button class="select-all-button" type="button">Select All</button>
  //                       <button class="remove-all-button" type="button">Remove All</button>
  //                   </div>`;

  //           // Remove any existing extra buttons before adding new ones
  //           $('.select2-results .extra-search-container').remove();
  //           $('.select2-results .extra-buttons').remove();

  //           // Append the new extra buttons and search box
  //           $('.select2-results').prepend(searchBoxHtml);

  //           // Handle Select All button for the current dropdown
  //           $('.select-all-button').on('click', function() {
  //             var $currentDropdown = $dropdown;
  //             var allValues = $currentDropdown.find('option').map(function() {
  //               return $(this).val();
  //             }).get();
  //             $currentDropdown.val(allValues).trigger('change');
  //           });

  //           // Handle Remove All button for the current dropdown
  //           $('.remove-all-button').on('click', function() {
  //             var $currentDropdown = $dropdown;
  //             $currentDropdown.val(null).trigger('change');
  //           });
  //         });

  //         $('.js-example-basic-multiple1').on('select2:open', function() {
  //           var searchBoxHtml = `
  //                   <div class="extra-search-container">
  //                       <input type="text" class="extra-search-box" placeholder="Search...">
  //                       <button class="clear-button" type="button">&times;</button>
  //                   </div>`;

  //           if ($('.select2-results').find('.extra-search-container').length === 0) {
  //             $('.select2-results').prepend(searchBoxHtml);
  //           }

  //           var $searchBox = $('.extra-search-box');
  //           var $clearButton = $('.clear-button');

  //           $searchBox.on('input', function() {

  //             var searchTerm = $(this).val().toLowerCase();
  //             $('.select2-results__option').each(function() {
  //               var text = $(this).text().toLowerCase();
  //               if (text.includes(searchTerm)) {
  //                 $(this).show();
  //               } else {
  //                 $(this).hide();
  //               }
  //             });

  //             $clearButton.toggle($searchBox.val().length > 0);
  //           });

  //           $clearButton.on('click', function() {
  //             $searchBox.val('');
  //             $searchBox.trigger('input');
  //           });
  //         });

  //         $('.js-example-basic-multiple1').each(function() {
  //           let listId = $(this).data('list-id');
  //           //alert(listId);
  //           let items = [];
  //           ////console.log("listId1", listId);
  //           $('#' + listId + ' li').each(function() {
  //             ////console.log("value1", $(this).text());
  //             items.push({
  //               id: $(this).data('value'),
  //               text: $(this).text()
  //             });
  //           });
  //           ////console.log("items1", items);
  //           $(this).select2({
  //             data: items
  //           });

  //           //$("#type-of-nurse").select2({'val': 3});

  //         });

  //       }
  //     });

  //   }

  // });

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
          url: "{{ url('/nurse') }}/getSkillsData",
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
            <div class="form-group level-drp analy_skill_1">
              <label class="form-label analy_skill_label-1${skills[0].parent_id}" for="input-1">${skills[0].parent_name}</label>
              <ul id="skills_compantancies-${skills[0].parent_id}" style="display:none;">
                ${skills_data}
              </ul>
              <input type="hidden" value="${skills[0].parent_id}" class="area_skills-1">
              <select class="js-example-basic-multiple1 addAll_removeAll_btn spc_comp spc_comp-1${skills[0].parent_id}" 
                      data-list-id="skills_compantancies-${skills[0].parent_id}" 
                      name="sub_skills_compantancies-${skills[0].parent_id}[1][]" multiple="multiple">
              </select>
              <span id="reqanaskills-1${skills[0].parent_id}" class="reqError text-danger valley"></span>
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
    // if (selectedValues && selectedValues.length > 0) {
      $('.skills_compantancies_dropdowns .js-example-basic-multiple1').each(function() {
        let listId = $(this).data('list-id');
        let id = listId.replace('skills_compantancies-', '');
        if (!selectedValues.includes(id)) {
          $(this).closest('.form-group').remove();
        }
      });
    // }
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
  }


  $('.js-example-basic-multiple[data-list-id="type-of-nurse-experience"]').on('change', function() {
    // alert();
    let selectedValues = $(this).val();

    var nurse_len = $("#type-of-nurse-experience li").length;
    ////console.log("nurse_len", nurse_len);

    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

    ////console.log("selectedValues", selectedValues);
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

  $('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').on('change', function() {
    let selectedValues = $(this).val();
    //alert("hello");
    var nurse_len = $("#type-of-nurse li").length;
    ////console.log("nurse_len", nurse_len);

    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
    if (selectedValues.includes("179")) {
      $('.np_submenu').removeClass('d-none');
      ////console.log("selectedValues", selectedValues);
    } else {
      $('.np_submenu').addClass('d-none');
      $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(null).trigger('change');
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

  function getAdvancedData(i){
      $('.js-example-basic-multiple[data-list-id="nursing_entry_experience-'+i+'3"]').on('change', function() {
      let selectedValues = $(this).val();
      
      

      //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
      if (selectedValues.includes("179")) {
        $('.np_submenu_experience_'+i).removeClass('d-none');
        ////console.log("selectedValues", selectedValues);
      } else {
        
        $('.np_submenu_experience_'+i).addClass('d-none');
        $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu_experience'+i+'"]').select2().val(null).trigger('change');
      }



    });

  
  }
  var ji = 1;
  // $(".work_exp").each(function(){
  //   console.log("nursing_entry_experience", ji);
  //   $('.js-example-basic-multiple[data-list-id="nursing_entry_experience-'+ji+'3"]').on('change', function() {
  //     let selectedValues = $(this).val();
      
  //     var nurse_len = $("#type-of-nurse li").length;
  //     ////console.log("nurse_len", nurse_len);

  //     //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
  //     if (selectedValues.includes("179")) {
  //       $('.np_submenu_experience_'+i).removeClass('d-none');
  //       ////console.log("selectedValues", selectedValues);
  //     } else {
        
  //       $('.np_submenu_experience_2').addClass('d-none');
  //       $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu_experience'+i+'"]').select2().val(null).trigger('change');
  //     }



  //   });

  //   ji++;
  // });
  

  var sub_specialty_data_val = $(".sub_speciality_value").val();

  $('.js-example-basic-multiple[data-list-id="speciality_entry-1"]').on('change', function() {
    let selectedValues = $(this).val();
    //alert("hello");
    var speciality_entry = $("#speciality_entry-1 li").length;
    ////console.log("speciality_entry", speciality_entry);
    // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
    $(".surgical_row_data").insertAfter("#specility_level-1");
    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

    ////console.log("selectedValues", selectedValues.includes("96"));
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

  function showEmpType(value,j,ap){
    if(ap == ''){
      
      var emp_type = $('.js-example-basic-multiple[data-list-id="employeement_type_experience-'+j+'"]').val();
    }else{
      var emp_type = $('.js-example-basic-multiple'+j+'[data-list-id="employeement_type_experience-'+j+'"]').val();
    }
        //alert(value);
    console.log("emp_type",emp_type);
    
     $(".show_emp_data-"+j+" .subrefer_list").each(function(i,val){
        var val1 = $(val).val();
        console.log("val",val1);
        if(emp_type.includes(val1) == false){
            $(".emptype_main_div-"+val1).remove();
            
        }
    });

    for(var i=0;i<emp_type.length;i++){

        if($(".show_emp_data-"+j+" .emptype_main_div-"+emp_type[i]).length < 1){
          $.ajax({
            type: "GET",
            url: "{{ url('/nurse/getEmpDataExp') }}",
            data: {sub_prefer_id:emp_type[i],circle_value:j},
            cache: false,
            success: function(data){
                const emp_prefer_data = JSON.parse(data);
                console.log("emp_prefer_data",j);

                var emp_text = "";
                for(var j=0;j<emp_prefer_data.employeement_type_preferences.length;j++){
                
                    emp_text += "<li data-value='"+emp_prefer_data.employeement_type_preferences[j].emp_prefer_id+"'>"+emp_prefer_data.employeement_type_preferences[j].emp_type+"</li>"; 
                
                }
                
                $(".show_emp_data-"+emp_prefer_data.circle_value).append('\<div class="emptype_main_div emptype_main_div-'+emp_prefer_data.employeement_type_id+'"><div class="emptypediv emptypediv-'+emp_prefer_data.employeement_type_id+' form-group level-drp">\
                    <label class="form-label emptype_label emptype_label-'+emp_prefer_data.employeement_type_id+'" for="input-1">'+emp_prefer_data.employeement_type_name+'</label>\
                    <input type="hidden" name="subrefer_list" class="subrefer_list" value="'+emp_prefer_data.employeement_type_id+'">\
                    <ul id="emptype_field-'+emp_prefer_data.employeement_type_id+'" style="display:none;">'+emp_text+'</ul>\
                    <select class="js-example-basic-multiple'+emp_prefer_data.employeement_type_id+' addAll_removeAll_btn emptype_valid-1" data-list-id="emptype_field-'+emp_prefer_data.employeement_type_id+'" name="emptypelevel['+emp_prefer_data.circle_value+']['+emp_prefer_data.employeement_type_id+'][]" multiple></select>\
                    <span id="reqemptype-1" class="reqError text-danger valley"></span>\
                    </div></div>');

                    
                
                selectTwoFunction(emp_prefer_data.employeement_type_id);
            }
            
          });
        }
      }
  }

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
    ////console.log("speciality_entry", speciality_entry);
    // $(".surgicalobs_row").wrapAll("<div class='col-md-12 row surgicalobs_row_data'>");
    $(".surgicalobs_row_experience").insertAfter("#specility_level_experience-2");

    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

    ////console.log("selectedValues", selectedValues);
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
    ////console.log("speciality_entry", speciality_entry);
    // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
    $(".specialty_sub_boxes").insertAfter(".surgical_row_data");
    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

    ////console.log("selectedValues", selectedValues);
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

  $('.js-example-basic-multiple[data-list-id="speciality_entry-3"]').on('change', function() {
    let selectedValues = $(this).val();
    //alert("hello");
    var speciality_entry = $("#speciality_entry-3 li").length;
    ////console.log("speciality_entry", speciality_entry);
    $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
    $(".paediatric_surgical_div").insertAfter("#specility_level-3");


    //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
    $(".neonatal_row").insertAfter("#specility_level-3");

    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

    ////console.log("selectedValues", selectedValues);
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
    ////console.log("speciality_entry", speciality_entry);
    $(".surgical_rowp_experience").wrapAll("<div class='col-md-12 row surgical_rowp_data_experience'>");
    $(".paediatric_surgical_div_experience").insertAfter("#specility_level_experience-3");


    //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
    $(".neonatal_row_exp_1").insertAfter("#specility_level_experience-3");

    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

    ////console.log("selectedValues", selectedValues);
    //$('.result--show .form-group').addClass('d-none');

    if (selectedValues.includes('250')) {
      $('.neonatal_row_exp_1').removeClass('d-none');
    } else {
      $('.neonatal_row_exp_1').addClass('d-none');
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

  $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').on('change', function() {
    let selectedValues = $(this).val();
    //alert("hello");
    var speciality_entry = $("#surgical_rowpad_box li").length;
    ////console.log("speciality_entry", speciality_entry);
    // $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
    $(".surgical_rowp_data").insertAfter(".surgicalpad_row_data");


    //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
    //     $(".neonatal_row_data").insertAfter("#specility_level-3");

    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

    ////console.log("selectedValues", selectedValues);
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
    ////console.log("speciality_entry", speciality_entry);
    // $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
    $(".surgical_rowp_data_experience").insertAfter(".surgicalpad_row_data_experience");


    //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
    //     $(".neonatal_row_data").insertAfter("#specility_level-3");

    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

    ////console.log("selectedValues", selectedValues);
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
    ////console.log("speciality_entry", speciality_entry);
    // $(".surgicalobs_row").wrapAll("<div class='col-md-12 row surgicalobs_row_data'>");
    $(".surgicalobs_row").insertAfter("#specility_level-2");

    //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

    ////console.log("selectedValues", selectedValues);
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

    ////console.log("selectedValues", selectedValues);
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
        ////console.log("res_one", res_one);

        $(".acls_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "acls_imgs");
      }
      acls_certification_array.push(text);
    });
    ////console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      ////console.log("res_one", res_one);

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
        ////console.log("res_one2", res_one);

        $(".bls_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "bls_imgs");
      }
      bls_certification_array.push(text);
    });
    ////console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      ////console.log("res_one", res_one);
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
        ////console.log("res_one", res_one);

        $(".cpr_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "cpr_imgs")
      }

      cpr_certification_array.push(text);
    });
    ////console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      ////console.log("res_one", res_one);
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
        ////console.log("res_one", res_one);

        $(".nrp_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "nrp_imgs");
      }

      nrp_certification_array.push(text);
    });
    ////console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      ////console.log("res_one", res_one);
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
        ////console.log("res_one", res_one);

        $(".pls_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "pls_imgs");
      }

      pls_certification_array.push(text);
    });
    ////console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      ////console.log("res_one", res_one);
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
        ////console.log("res_one", ".rn_" + res_one);

        $(".rn_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "rn_imgs");
      }

      rn_certification_array.push(text);
    });
    ////console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      ////console.log("res_one", res_one);

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
        ////console.log("res_one", res_one);

        $(".np_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "np_imgs");
      }

      np_certification_array.push(text);
    });
    ////console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      ////console.log("res_one", res_one);
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
        ////console.log("res_one", res_one);

        $(".cna_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "cn_imgs");
      }

      cn_certification_array.push(text);
    });
    ////console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      ////console.log("res_one", res_one);
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
        ////console.log("res_one", res_one);

        $(".lpn_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "lpn_imgs");
      }

      lpn_certification_array.push(text);
    });
    ////console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      ////console.log("res_one", res_one);
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
        ////console.log("res_one", res_one);

        $(".crna_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "crna_imgs");

      }

      crna_certification_array.push(text);
    });
    ////console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      ////console.log("res_one", res_one);
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
        ////console.log("res_one", res_one);

        $(".cnm_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "cnm_imgs");
      }

      cnm_certification_array.push(text);
    });
    ////console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      ////console.log("res_one", res_one);
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
        ////console.log("res_one", res_one);

        $(".ons_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "ons_imgs");
      }

      ons_certification_array.push(text);
    });
    ////console.log("selectedValues", selectedValues);

    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
      ////console.log("res_one", res_one);
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
        $(".msw_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "msw_imgs");
      }

      msw_certification_array.push(text);
    });


    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();


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


        $(".ain_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "ain_imgs");
      }

      ain_certification_array.push(text);
    });


    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

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


        $(".rpn_" + res_one).remove();
        var user_id = "{{ $user_id }}";
        deleteDatabaseImgs(user_id, "rpn_imgs");
      }

      rpn_certification_array.push(text);
    });


    //$(".bls_certification_div").empty();
    for (var i = 0; i < selectedValues.length; i++) {
      var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
      let res = selectedValues[i].split(' ')[0];
      let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

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

    if (c == "professional_membership") {

      $(".tab-pane").hide();
      $("#tab-professional-membership").css("opacity", "1");
      $("#tab-professional-membership").show();
    }

  });

  var url_string = window.location.href;
  var url = new URL(url_string);
  var c = url.searchParams.get("page");

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
      document.getElementById("reqsubspecialtyId").innerHTML = "* Please Select Practitioner Type.";
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
    
    setTimeout(function() {
        var profile_percent = $("#graph1 span").text().replace('%', '');
        console.log("profile_percent", profile_percent);
        
        if(profile_percent<100){
            $(".main-menu a").each(function(){
                var link_text = $(this).text();
                console.log("link_text", link_text);
                
                if ($.trim($(this).text()) == "Find Jobs" || $.trim($(this).text()) == "Saved Jobs" || $.trim($(this).text()) == "My Career" || $.trim($(this).text()) == "Community") {
                    $(this)
                      .addClass("disabled-link")
                      .attr("title", "Complete your profile to access this section");
                  }
            });
            //$(".main-menu a").addClass("disabled-link").attr("title", "Complete your profile to access this section");
        }
      }, 100);
  });
  // let autocomplete;
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