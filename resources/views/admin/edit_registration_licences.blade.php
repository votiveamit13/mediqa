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
                            <form id="register_licenses_form" method="POST" onsubmit="return update_register_licenses()">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">What is your current AHPRA registration status?</label>
                          <select id="registration-status" name="ahpra_registration_status" class="form-control">
                            <option value="">-- Select Registration Status --</option>
                            <option value="RN" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "RN") selected @endif>Registered Nurse (RN)</option>
                            <option value="RM" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "RM") selected @endif>Registered Midwife (RM)</option>
                            <option value="RN_RM" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "RN_RM") selected @endif>Registered Nurse and Midwife (RN/RM)</option>
                            <option value="NP" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "NP") selected @endif>Nurse Practitioner (NP) (as endorsed under RN)</option>
                            <option value="Graduate_RN" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "Graduate_RN") selected @endif>Graduate Nurse – Transitional Authorisation</option>
                            <option value="Graduate_RM" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "Graduate_RM") selected @endif>Graduate Midwife – Transitional Authorisation</option>
                            <option value="Student_Nurse" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "Student_Nurse") selected @endif>Student Nurse – AHPRA-registered (NMBA-approved course)</option>
                            <option value="Student_Midwife" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "Student_Midwife") selected @endif>Student Midwife – AHPRA-registered (NMBA-approved course)</option>
                            <option value="Overseas" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "Overseas") selected @endif>Overseas-Qualified Nurses and Midwives not currently registered with AHPRA</option>
                            <option value="Not_Registered" @if(!empty($licenses_data) && $licenses_data->ahpra_registration_status == "Not_Registered") selected @endif>Not currently registered with AHPRA</option>
                          </select>
                          <span id="register_status" class="reqError text-danger valley"></span>
                        </div>
                        <!-- Conditional AHPRA Input Group -->
                        
                        <div id="ahpra-details-group" style="display: none;">
                          <div class="form-group level-drp mt-2" id="ahpra-number">
                            <!-- AHPRA Number -->
                            <label class="form-label" for="ahpra-number">Please Enter your AHPRA Registration Number:</label>
                            <input class="form-control ahpra_number" type="text" name="ahpra_number"
                                  placeholder="e.g. NMW0001234567" value="@if(!empty($licenses_data)){{ $licenses_data->aphra_registration_no }}@endif"/>
                            <small style="color: gray;">Format: NMW followed by 10 digits (e.g., NMW0001234567)</small>
                            <div class="group_one_aphrano">
                              <span id="group_one_aphrano" class="reqError text-danger valley"></span>
                            </div>
                            
                          </div>  
                          <!-- Consent Checkbox -->
                          <div class="declaration_box mt-2">
                           
                              <input type="checkbox" name="ahpra_consent" class="declare_information" id="ahpra-consent" @if(!empty($licenses_data) && $licenses_data->aphra_verifying_checkbox == "1") checked @endif/>
                              
                            <label for="declare_information">&nbsp;&nbsp;I consent to Mediqa verifying my AHPRA registration via the public AHPRA register.</label>
                            
                            
                          </div>
                          <span id="aphra_checkbox" class="reqError text-danger valley"></span>
                          <div class="add_new_certification_div mb-3 mt-4">
                            
                            <a style="cursor: pointer;" class="lookup-ahpra-btn">
                              <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true" id="lookupSpinner"></span>
                              <span id="lookupSpinnerText">Lookup AHPRA Registration</span>
                            </a>
                            
                          </div>
                          <span id="reqaphra_reg" class="reqError text-danger valley"></span>

                          <div style="margin-top: 15px;" class="mt-4 manual_entry_div">
                            <p style="margin-bottom: 10px;color: black;">
                              <strong>Can’t find your AHPRA registration?</strong><br>
                              You can enter your details manually below.
                            </p>
                            <button type="button" id="manualEntryBtn" class="btn btn-outline-dark">
                              Enter AHPRA Details Manually
                            </button>
                          </div>
                          <div class="ahpra-lookup">
                            <input type="hidden" name="api_division" class="api_division" value="@if(!empty($licenses_data)){{ $licenses_data->register_division }}@endif">
                            <input type="hidden" name="api_endorsements" class="api_endorsements" value="@if(!empty($licenses_data)){{ $licenses_data->register_endorsements }}@endif">
                            <input type="hidden" name="api_reg_type" class="api_reg_type" value="@if(!empty($licenses_data)){{ $licenses_data->register_reg_type }}@endif">
                            <input type="hidden" name="api_reg_status" class="api_reg_status" value="@if(!empty($licenses_data)){{ $licenses_data->register_reg_status }}@endif">
                            <input type="hidden" name="api_notations" class="api_notations" value="@if(!empty($licenses_data)){{ $licenses_data->register_notations }}@endif">
                            <input type="hidden" name="api_conditions" class="api_conditions" value="@if(!empty($licenses_data)){{ $licenses_data->register_conditions }}@endif">
                            <input type="hidden" name="api_expiry" class="api_expiry" value="@if(!empty($licenses_data)){{ $licenses_data->register_expiry }}@endif">
                            <input type="hidden" name="api_principal_practice" class="api_principal_practice" value="@if(!empty($licenses_data)){{ $licenses_data->register_principal_place }}@endif">
                            <input type="hidden" name="api_other_practices" class="api_other_practices" value="@if(!empty($licenses_data)){{ $licenses_data->register_other_place }}@endif">
                            
                            <div id="ahpra-lookup-result" style="margin-top: 30px; border-top: 1px solid #ccc; padding-top: 20px;display: none;">
                              <h6>AHPRA Registration Details</h6>
                              <p id="successful_ahpra" style="display: none;">Your AHPRA registration is verified successfully, please review the retrieved data below.</p>
                              {{-- <div><strong>Division:</strong> <span id="division">@if(!empty($licenses_data)){{ $licenses_data->register_division }}@endif</span></div>
                              <div><strong>Endorsements:</strong> <span id="endorsements">@if(!empty($licenses_data)){{ $licenses_data->register_endorsements }}@endif</span></div>
                              <div><strong>Registration Type:</strong> <span id="reg_type">@if(!empty($licenses_data)){{ $licenses_data->register_reg_type }}@endif</span></div>
                              <div><strong>Registration Status:</strong> <span id="reg_status">@if(!empty($licenses_data)){{ $licenses_data->register_reg_status }}@endif</span></div>
                              <div><strong>Notations:</strong> <span id="notations">@if(!empty($licenses_data)){{ $licenses_data->register_notations }}@endif</span></div>
                              <div><strong>Conditions:</strong> <span id="conditions">@if(!empty($licenses_data)){{ $licenses_data->register_conditions }}@endif</span></div>
                              <div><strong>Expiry:</strong> <span id="expiry"></span>@if(!empty($licenses_data)){{ $licenses_data->register_expiry }}@endif</div>
                              <div><strong>Principal Place of Practice:</strong> <span id="principal_practice">@if(!empty($licenses_data)){{ $licenses_data->register_principal_place }}@endif</span></div>
                              <div><strong>Other Places of Practice:</strong> <span id="other_practices">@if(!empty($licenses_data)){{ $licenses_data->register_other_place }}@endif</span></div> --}}

                              <!-- Confirmation of Source -->

                              <table class="table table-bordered table-striped mt-3">
                                  <tbody>
                                    <tr>
                                      <th><strong>Division</strong></th>
                                      <td id="division">@if(!empty($licenses_data)){{ $licenses_data->register_division }}@endif</td>
                                    </tr>
                                    <tr>
                                      <th><strong>Endorsements</strong></th>
                                      <td id="endorsements">@if(!empty($licenses_data)){{ $licenses_data->register_endorsements }}@endif</td>
                                    </tr>
                                    <tr>
                                      <th><strong>Registration Type</strong></th>
                                      <td id="reg_type">@if(!empty($licenses_data)){{ $licenses_data->register_reg_type }}@endif</td>
                                    </tr>
                                    <tr>
                                      <th><strong>Registration Status</strong></th>
                                      <td id="reg_status">@if(!empty($licenses_data)){{ $licenses_data->register_reg_status }}@endif</td>
                                    </tr>
                                    <tr>
                                      <th><strong>Notations</strong></th>
                                      <td id="notations">@if(!empty($licenses_data)){{ $licenses_data->register_notations }}@endif</td>
                                    </tr>
                                    <tr>
                                      <th><strong>Conditions</strong></th>
                                      <td id="conditions">@if(!empty($licenses_data)){{ $licenses_data->register_conditions }}@endif</td>
                                    </tr>
                                    <tr>
                                      <th><strong>Expiry</strong></th>
                                      <td id="expiry">@if(!empty($licenses_data)){{ $licenses_data->register_expiry }}@endif</td>
                                    </tr>
                                    <tr>
                                      <th><strong>Principal Place of Practice</strong></th>
                                      <td id="principal_practice">@if(!empty($licenses_data)){{ $licenses_data->register_principal_place }}@endif</td>
                                    </tr>
                                    
                                  </tbody>
                                </table>
                              <div>
                                Data retrieved from <strong>AHPRA’s public register</strong>.
                              </div>

                              <div class="alert alert-info" role="alert" style="background-color: #e6f2ff; border-left: 5px solid #3399ff;">
                              <div>
                                <strong>Please stay actively compliant.</strong><br>
                                To ensure your profile remains up to date and match-ready, re-verify your professional registration regularly, especially during key events like job applications or expiring certifications.
                                <br><br>

                                <!-- Flex row: left = "Last verified", right = Button -->
                                <div class="d-flex justify-content-between align-items-center">
                                  <div>
                                    <strong>Last verified:</strong> 
                                    <input type="hidden" name="last_verified_date" class="last_verified_date" value="@if(!empty($licenses_data)){{ $licenses_data->last_verified }}@endif">
                                    @if(!empty($licenses_data) && $licenses_data->last_verified != NULL)
                                    <span id="lastVerified">{{ $licenses_data->last_verified }}</span>
                                    @else
                                    <span id="lastVerified">Not yet verified</span>
                                    @endif
                                  </div>

                                  <span class="reverify_tooltip" data-toggle="tooltip" title="This registration has already been verified. You can re-check after 24 hours.">
                                    <a id="reverifyBtn" data-placement="top" class="btn btn-primary btn-sm" style="background-color: #000;border-color: #000">
                                      <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true" id="lookupSpinner_reverify"></span>
                                      Re-verify now
                                    </a>
                                    <span id="lookup_data_error" class="reqError text-danger valley"></span>
                                  </span>
                                </div>
                              </div>
                            </div>
                            </div>
                            <div class="manual_ahpra_lookup mt-2" style="display: none;">
                              <div class="manual_reverify_error" style="display:none;background-color: #fff3cd; border-left: 5px solid #ffecb5; padding: 15px; margin-top: 20px; border-radius: 5px;">
                                <strong>We couldn't verify your AHPRA registration automatically.</strong><br>
                                Please complete the fields manually and upload your registration certificate as evidence of your current professional status.
                              </div>
                            
                            <div class="form-group level-drp" id="ahpra-number">
                            
                                <input type="hidden" name="api_verify" class="api_verify" value="@if(!empty($licenses_data)){{ $licenses_data->api_verify }}@endif">
                                <label for="ahpra-number" class="form-label">Division:</label>
                                <select class="form-control" id="division" name="division">
                                <option value="">Select Division</option>
                                <option value="RN" @if(!empty($licenses_data) && $licenses_data->register_division == "RN") selected @endif>Registered Nurse (RN)</option>
                                <option value="EN" @if(!empty($licenses_data) && $licenses_data->register_division == "EN") selected @endif>Enrolled Nurse (EN)</option>
                                <option value="RM" @if(!empty($licenses_data) && $licenses_data->register_division == "RM") selected @endif>Registered Midwife (RM)</option>
                                <option value="RN+RM" @if(!empty($licenses_data) && $licenses_data->register_division == "RN+RM") selected @endif>Registered Nurse and Midwife (RN+RM)</option>
                                </select>
                                <span id="register_division" class="reqError text-danger valley"></span>
                            </div>  
                          <div class="form-group level-drp mt-2" id="ahpra-number">
                            <!-- AHPRA Number -->
                            <label for="endorsements" class="form-label">Endorsements:</label>
                            <select class="form-control" id="endorsements" name="endorsements">
                              <option value="">Select Endorsement</option>
                              <option value="NP" @if(!empty($licenses_data) && $licenses_data->register_endorsements == "NP") selected @endif>Nurse Practitioner (NP)</option>
                              <option value="MidwifeMeds" @if(!empty($licenses_data) && $licenses_data->register_endorsements == "MidwifeMeds") selected @endif>Scheduled Medicines – Midwife</option>
                              <option value="RIPRN" @if(!empty($licenses_data) && $licenses_data->register_endorsements == "RIPRN") selected @endif>Scheduled Medicines – RN (Rural and Isolated Practice)</option>
                              <option value="NP+Midwife" @if(!empty($licenses_data) && $licenses_data->register_endorsements == "NP+Midwife") selected @endif>Both NP and Endorsed Midwife</option>
                              <option value="IVs" @if(!empty($licenses_data) && $licenses_data->register_endorsements == "IVs") selected @endif>IV Endorsed - Enrolled Nurse (IVs)</option>
                              <option value="meds" @if(!empty($licenses_data) && $licenses_data->register_endorsements == "meds") selected @endif>Medication Endorsed - Enrolled Nurse (meds)</option>
                              <option value="none" @if(!empty($licenses_data) && $licenses_data->register_endorsements == "none") selected @endif>No endorsed status</option>
                            </select>
                            <span id="register_endorsment" class="reqError text-danger valley"></span>
                          </div>  
                          <div class="form-group level-drp mt-2" id="ahpra-number">
                            <!-- AHPRA Number -->
                            <label for="regType" class="form-label">Registration Type:</label>
                            <select class="form-control" id="regType" name="reg_registration_type">
                              <option value="">Select Registration Type</option>
                              <option value="General" @if(!empty($licenses_data) && $licenses_data->register_reg_type == "General") selected @endif>General</option>
                              <option value="Limited" @if(!empty($licenses_data) && $licenses_data->register_reg_type == "Limited") selected @endif>Limited</option>
                              <option value="Provisional" @if(!empty($licenses_data) && $licenses_data->register_reg_type == "Provisional") selected @endif>Provisional</option>
                              <option value="Student Nurse" @if(!empty($licenses_data) && $licenses_data->register_reg_type == "Student Nurse") selected @endif>Student Nurse</option>
                              <option value="Student Midwife" @if(!empty($licenses_data) && $licenses_data->register_reg_type == "Student Midwife") selected @endif>Student Midwife</option>
                              <option value="Non-practising" @if(!empty($licenses_data) && $licenses_data->register_reg_type == "Non-practising") selected @endif>Non-practising</option>
                            </select>
                            <span id="reg_registration_type" class="reqError text-danger valley"></span>
                          </div>  
                          <div class="form-group level-drp mt-2" id="ahpra-number">
                            <!-- AHPRA Number -->
                            <label for="regStatus" class="form-label">Registration Status:</label>
                            <select class="form-control" id="regStatus" name="reg_registration_status">
                              <option value="">Select Registration Status</option>
                              <option value="Current" @if(!empty($licenses_data) && $licenses_data->register_reg_status == "Current") selected @endif>Current</option>
                              <option value="Suspended" @if(!empty($licenses_data) && $licenses_data->register_reg_status == "Suspended") selected @endif>Suspended</option>
                              <option value="Cancelled" @if(!empty($licenses_data) && $licenses_data->register_reg_status == "Cancelled") selected @endif>Cancelled</option>
                              <option value="Inactive" @if(!empty($licenses_data) && $licenses_data->register_reg_status == "Inactive") selected @endif>Inactive</option>
                              <option value="Ineligible" @if(!empty($licenses_data) && $licenses_data->register_reg_status == "Ineligible") selected @endif>Ineligible</option>
                              <option value="Lapsed" @if(!empty($licenses_data) && $licenses_data->register_reg_status == "Lapsed") selected @endif>Lapsed</option>
                              <option value="Expired" @if(!empty($licenses_data) && $licenses_data->register_reg_status == "Expired") selected @endif>Expired</option>
                              <option value="Not registered" @if(!empty($licenses_data) && $licenses_data->register_reg_status == "Not registered") selected @endif>Not currently registered</option>
                            </select>
                            <span id="reg_registration_status" class="reqError text-danger valley"></span>
                          </div>  
                          <div class="form-group level-drp mt-2">
                            <label class="form-label" for="negotiable">Do you have any notations on your AHPRA registration? </label><br>
                            <label class="switch">
                              <input type="checkbox" id="toggleCheckbox" name="notation_toggle" @if(!empty($licenses_data) && $licenses_data->register_notations != NULL) checked @endif>
                              <span class="slider"></span>
                              
                            </label>
                          </div>
                          <?php
                            if(!empty($licenses_data) && $licenses_data->register_notations != NULL){
                              $register_notations = json_decode($licenses_data->register_notations);
                            }else{
                              $register_notations = array();
                            }
                          ?>
                            <!-- Conditional Notations Field (Hidden by Default) -->
                          <div id="notationsSection" style="display: none;">
                            <div class="mb-3 mt-2">
                              <label class="form-label">Notations:</label>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notations[]" value="Must practise under supervision" @if(is_array($register_notations) && in_array("Must practise under supervision", $register_notations) == true) checked @endif id="notation1">
                                <label class="form-check-label" for="notation1">Must practise under supervision</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notations[]" value="May not administer medications" @if(is_array($register_notations) && in_array("May not administer medications", $register_notations) == true) checked @endif id="notation2">
                                <label class="form-check-label" for="notation2">May not administer medications</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notations[]" value="Authorised as a student" @if(is_array($register_notations) && in_array("Authorised as a student", $register_notations) == true) checked @endif id="notation3">
                                <label class="form-check-label" for="notation3">Authorised as a student</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notations[]" value="Endorsed as a midwife — may prescribe under certain conditions" @if(is_array($register_notations) && in_array("Endorsed as a midwife — may prescribe under certain conditions", $register_notations) == true) checked @endif id="notation4">
                                <label class="form-check-label" for="notation4">Endorsed as a midwife — may prescribe under certain conditions</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notations[]" value="May only practise in area of approved qualification" @if(is_array($register_notations) && in_array("May only practise in area of approved qualification", $register_notations) == true) checked @endif id="notation5">
                                <label class="form-check-label" for="notation5">May only practise in area of approved qualification</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notations[]" value="May not work in high-risk settings" @if(is_array($register_notations) && in_array("May not work in high-risk settings", $register_notations) == true) checked @endif id="notation6">
                                <label class="form-check-label" for="notation6">May not work in high-risk settings</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notations[]" value="Other" @if(is_array($register_notations) && in_array("Other", $register_notations) == true) checked @endif id="notationOther">
                                <label class="form-check-label" for="notationOther">Other</label>
                              </div>
                            </div>
                            <span id="reg_notations" class="reqError text-danger valley"></span>
                            <!-- Conditional Other Notation Text Input -->
                            <div class="form-group level-drp mb-3 mt-2" id="otherNotationText" style="display: none;">
                              <label for="otherNotation" class="form-label">Please specify:</label>
                              <input type="text" class="form-control" id="otherNotation" name="other_notation" placeholder="Enter your other notation" value="@if(!empty($licenses_data)){{ $licenses_data->register_other_notation_reason }}@endif">
                              <span id="other_notation" class="reqError text-danger valley"></span>
                            </div>
                          </div>
                        
                          <div class="form-group level-drp mt-2">
                            <label class="form-label" for="negotiable">Do you have any AHPRA-imposed conditions on your registration? </label><br>
                            <label class="switch">
                              <input type="checkbox" id="toggleCheckbox_conditions"  name="condition_toggle" @if(!empty($licenses_data) && $licenses_data->register_conditions != NULL) checked @endif>
                              <span class="slider"></span>
                              
                            </label>
                          </div>
                          <?php
                            if(!empty($licenses_data) && $licenses_data->register_conditions != "null"){
                              $register_conditions = json_decode($licenses_data->register_conditions);
                            }else{
                              $register_conditions = [];
                            }
                          ?>
                          <!-- Conditional Conditions List -->
                          <div id="conditionsSection" style="display: none;">
                            <div class="mb-3 mt-2">
                              <label class="form-label">Conditions:</label>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must practise under supervision" id="condition1" @if(is_array($register_conditions) && in_array("Must practise under supervision", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition1">Must practise under supervision</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Restricted to specific clinical area" id="condition2" @if(is_array($register_conditions) && in_array("Restricted to specific clinical area", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition2">Restricted to specific clinical area</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must not administer medications" id="condition3" @if(is_array($register_conditions) && in_array("Must not administer medications", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition3">Must not administer medications</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must complete a supervised practice program" id="condition4" @if(is_array($register_conditions) && in_array("Must complete a supervised practice program", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition4">Must complete a supervised practice program</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must complete education or training" id="condition5" @if(is_array($register_conditions) && in_array("Must complete education or training", $register_conditions) == true) checked @endif>
                                <label clasmanual_ahpra_lookups="form-check-label" for="condition5">Must complete education or training</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must not work as a sole practitioner" id="condition6" @if(is_array($register_conditions) && in_array("Must not work as a sole practitioner", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition6">Must not work as a sole practitioner</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must not practise in a high-risk setting" id="condition7" @if(is_array($register_conditions) && in_array("Must not practise in a high-risk setting", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition7">Must not practise in a high-risk setting</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must attend health/therapy or monitoring program" id="condition8" @if(is_array($register_conditions) && in_array("Must attend health/therapy or monitoring program", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition8">Must attend health/therapy or monitoring program</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="May only practise with employer notification to AHPRA" id="condition9" @if(is_array($register_conditions) && in_array("May only practise with employer notification to AHPRA", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition9">May only practise with employer notification to AHPRA</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Cannot supervise students or junior staff" id="condition10" @if(is_array($register_conditions) && in_array("Cannot supervise students or junior staff", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition10">Cannot supervise students or junior staff</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must undergo regular performance review" id="condition11" @if(is_array($register_conditions) && in_array("Must undergo regular performance review", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition11">Must undergo regular performance review</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Must not prescribe medications" id="condition12" @if(is_array($register_conditions) && in_array("Must not prescribe medications", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition12">Must not prescribe medications</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Practice hours must be logged and submitted" id="condition13" @if(is_array($register_conditions) && in_array("Practice hours must be logged and submitted", $register_conditions) == true) checked @endif>
                                <label class="form-check-label" for="condition13">Practice hours must be logged and submitted</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="conditions[]" value="Other" @if(is_array($register_conditions) && in_array("Other", $register_conditions) == true) checked @endif id="conditionOther">
                                <label class="form-check-label" for="condition14">Other</label>
                              </div>
                            </div>
                            <span id="reg_conditions" class="reqError text-danger valley"></span>
                            <div class="form-group level-drp mb-3 mt-2" id="otherConditionText" style="display: none;">
                              <label for="otherCondition" class="form-label">Please specify:</label>
                              <input type="text" class="form-control" id="otherCondition" name="other_condition" placeholder="Enter your other condition" value="@if(!empty($licenses_data)){{ $licenses_data->register_other_condition_reason }}@endif">
                              <span id="other_condition" class="reqError text-danger valley"></span>
                            </div>
                              
                            </div>
                            <div class="form-group level-drp mt-2" id="ahpra-number">
                              <label for="expiryDate" class="form-label">Expiry:</label>
                              <input type="date" class="form-control" id="expiryDate" name="expiry_date" value="@if(!empty($licenses_data)){{ $licenses_data->register_expiry }}@endif">
                              <span id="reg_expiry_date" class="reqError text-danger valley"></span>
                            </div>  
                            <div class="form-group level-drp mt-2" id="ahpra-number">
                                <label for="principalPractice" class="form-label">Principal Place of Practice:</label>
                                <select class="form-control" id="principalPractice" name="principal_place">
                                  <option value="">-- Select a State --</option>
                                  <option value="NSW" @if(!empty($licenses_data) && $licenses_data->register_principal_place =="NSW") selected @endif>New South Wales (NSW)</option>
                                  <option value="VIC" @if(!empty($licenses_data) && $licenses_data->register_principal_place =="VIC") selected @endif>Victoria (VIC)</option>
                                  <option value="QLD" @if(!empty($licenses_data) && $licenses_data->register_principal_place =="QLD") selected @endif>Queensland (QLD)</option>
                                  <option value="WA" @if(!empty($licenses_data) && $licenses_data->register_principal_place =="WA") selected @endif>Western Australia (WA)</option>
                                  <option value="SA" @if(!empty($licenses_data) && $licenses_data->register_principal_place =="SA") selected @endif>South Australia (SA)</option>
                                  <option value="TAS" @if(!empty($licenses_data) && $licenses_data->register_principal_place =="TAS") selected @endif>Tasmania (TAS)</option>
                                  <option value="ACT" @if(!empty($licenses_data) && $licenses_data->register_principal_place =="ACT") selected @endif>Australian Capital Territory (ACT)</option>
                                  <option value="NT" @if(!empty($licenses_data) && $licenses_data->register_principal_place =="NT") selected @endif>Northern Territory (NT)</option>
                                </select>
                                <span id="principal_place" class="reqError text-danger valley"></span>
                            </div>  
                            <div class="form-group drp--clr mt-2">
                                <label class="form-label" for="input-1">Other Places of Practice:</label>
                                
                                <input type="hidden" name="register_other_place" class="register_other_place" value="@if(!empty($licenses_data)) {{ $licenses_data->register_other_place }} @endif">
                                <ul id="other_places" style="display:none;">
                                  <li data-value="">select</li>
                                  <li data-value="NSW">New South Wales (NSW)</li>
                                  <li data-value="VIC">Victoria (VIC)</li>
                                  <li data-value="QLD">Queensland (QLD)</li>
                                  <li data-value="WA">Western Australia (WA)</li>
                                  <li data-value="SA">South Australia (SA)</li>
                                  <li data-value="TAS">Tasmania (TAS)</li>
                                  <li data-value="ACT">Australian Capital Territory (ACT)</li>
                                  <li data-value="NT">Northern Territory (NT)</li>
                                </ul>
                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="other_places" name="other_places[]" multiple="multiple"></select>
                                <span id="reg_other_places" class="reqError text-danger valley"></span>
                            </div>
                            </div>
                            <div class="form-group level-drp mt-2">
                              <label class="form-label" for="input-1">Upload Evidence</label>
                              
                              <?php
                                $user_id = Auth::guard('nurse_middle')->user()->id;
                              ?>
                              <input type="hidden" name="registration_upload" class="registration_upload-group1" value="@if(!empty($licenses_data)) {{ $licenses_data->register_upload_evidence }} @endif">
                              <input class="form-control upload_evidence-group1" type="file" name="" onchange="changeEvidenceImg({{ $user_id }},'group1','register_upload_evidence')" multiple="">
                              <div class="evidence-group1">
                                <?php
                                  if(!empty($licenses_data) && $licenses_data->register_upload_evidence != NULL){
                                    $evidence_imgs = (array)json_decode($licenses_data->register_upload_evidence);
                                    $i = 0;
                                  ?>
                                    @if (!empty($evidence_imgs))
                                      @foreach ($evidence_imgs as $ev_img)
                                      <div class="trans_img trans_img-{{ $i+1 }}">
                                        <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                        <div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}','group1','register_upload_evidence')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                      </div>    
                                      <?php
                                        $i++;
                                      ?>                                    
                                      @endforeach
                                    @endif
                                  <?php  

                                  }  
                                ?>
                              </div>
                            </div>
                            

                            <!-- Manual Entry Section -->
                            
                          </div>
                        </div>

                        <div id="manualAHPRAFields" style="display: none;">

                          <div class="form-group level-drp mb-3 mt-2">
                            <label for="ahpraNumber" class="form-label">Please Enter your AHPRA Registration Number:</label>
                            <input type="text" class="form-control" id="ahpraNumber" name="graduate_ahpra_number" placeholder="e.g. NMW0001234567" value="@if(!empty($licenses_data)){{ $licenses_data->graduate_student_reg_no }}@endif" pattern="^NMW\d{10}$">
                            <span id="graduate_ahpra_number" class="reqError text-danger valley"></span>
                            <div class="form-text">Your AHPRA number was issued when you enrolled in your approved program.<br>
                               <small style="color: gray;">Format: NMW followed by 10 digits (e.g., NMW0001234567)</small>
                            </div>
                          </div>

                          <!-- Division -->
                          <div class="form-group level-drp mb-3">
                            <label class="form-label">Division:</label>
                            <select class="form-control" name="graduate_division">
                              <option value="">select</option>
                              <option value="RN" @if(!empty($licenses_data) && $licenses_data->graduate_division == "RN") selected @endif>Registered Nurse (RN)</option>
                              <option value="EN" @if(!empty($licenses_data) && $licenses_data->graduate_division == "EN") selected @endif>Enrolled Nurse (EN)</option>
                              <option value="RM" @if(!empty($licenses_data) && $licenses_data->graduate_division == "RM") selected @endif>Registered Midwife (RM)</option>
                              <option value="RN+RM" @if(!empty($licenses_data) && $licenses_data->graduate_division == "RN+RM") selected @endif>Registered Nurse and Midwife (RN+RM)</option>
                            </select>
                            <span id="graduate_division" class="reqError text-danger valley"></span>
                          </div>

                          <!-- Registration Type -->
                          <div class="form-group level-drp mb-3">
                            <label class="form-label">Registration Type:</label>
                            <select class="form-control" name="graduate_registration_type">
                              <option value="">select</option>
                              <option value="general" @if(!empty($licenses_data) && $licenses_data->graduate_reg_type == "general") selected @endif>General</option>
                              <option value="limited" @if(!empty($licenses_data) && $licenses_data->graduate_reg_type == "limited") selected @endif>Limited</option>
                              <option value="provisional" @if(!empty($licenses_data) && $licenses_data->graduate_reg_type == "provisional") selected @endif>Provisional</option>
                              <option value="student_nurse" @if(!empty($licenses_data) && $licenses_data->graduate_reg_type == "student_nurse") selected @endif>Student Nurse</option>
                              <option value="student_midwife" @if(!empty($licenses_data) && $licenses_data->graduate_reg_type == "student_midwife") selected @endif>Student Midwife</option>
                              <option value="non_practising" @if(!empty($licenses_data) && $licenses_data->graduate_reg_type == "non_practising") selected @endif>Non-practising</option>
                            </select>
                            <span id="graduate_registration_type" class="reqError text-danger valley"></span>
                          </div>

                          <!-- Registration Status -->
                          <div class="form-group level-drp mb-3">
                            <label class="form-label">Registration Status:</label>
                            <select class="form-select form-control" name="graduate_registration_status">
                              <option value="">select</option>
                              <option value="current" @if(!empty($licenses_data) && $licenses_data->graduate_reg_status == "current") selected @endif>Current</option>
                              <option value="suspended" @if(!empty($licenses_data) && $licenses_data->graduate_reg_status == "suspended") selected @endif>Suspended</option>
                              <option value="cancelled" @if(!empty($licenses_data) && $licenses_data->graduate_reg_status == "cancelled") selected @endif>Cancelled</option>
                              <option value="inactive" @if(!empty($licenses_data) && $licenses_data->graduate_reg_status == "inactive") selected @endif>Inactive</option>
                              <option value="ineligible" @if(!empty($licenses_data) && $licenses_data->graduate_reg_status == "ineligible") selected @endif>Ineligible</option>
                              <option value="lapsed" @if(!empty($licenses_data) && $licenses_data->graduate_reg_status == "lapsed") selected @endif>Lapsed</option>
                              <option value="expired" @if(!empty($licenses_data) && $licenses_data->graduate_reg_status == "expired") selected @endif>Expired</option>
                              <option value="not_registered" @if(!empty($licenses_data) && $licenses_data->graduate_reg_status == "not_registered") selected @endif>Not currently registered</option>
                            </select>
                            <span id="graduate_registration_status" class="reqError text-danger valley"></span>
                          </div>
                          <!-- Expected Graduation Date -->
                          <div class="form-group level-drp mb-3" id="graduationDateGroup" style="display: none;">
                            <label class="form-label">What is your expected graduation date?</label>
                            <input type="date" class="form-control" name="graduation_expected_date" value="@if(!empty($licenses_data)){{ $licenses_data->graduation_date }}@endif">
                            <span id="graduation_expected_date" class="reqError text-danger valley"></span>
                          </div>

                          <!-- Upload Evidence -->
                          <div class="form-group level-drp mb-3" id="uploadEvidenceGroup">
                            <label class="form-label">Upload evidence</label>
                            <input type="hidden" name="upload_graduation_evidence" class="registration_upload-group2" value="@if(!empty($licenses_data)) {{ $licenses_data->graduation_upload_evidence }} @endif">
                            <input type="file" class="form-control upload_evidence-group2" name="" onchange="changeEvidenceImg({{ $user_id }},'group2','graduation_upload_evidence')" multiple>
                            <div class="evidence-group2">
                              <?php
                                  if(!empty($licenses_data) && $licenses_data->graduation_upload_evidence != NULL){
                                  $evidence_imgs = (array)json_decode($licenses_data->graduation_upload_evidence);
                                  $i = 0;
                                  ?>
                                  @if (!empty($evidence_imgs))
                                    @foreach ($evidence_imgs as $ev_img)
                                    <div class="trans_img trans_img-{{ $i+1 }}">
                                    <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                    <div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}','group2','graduation_upload_evidence')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                    </div>    
                                    <?php
                                    $i++;
                                    ?>                                    
                                    @endforeach
                                  @endif
                                  <?php  

                                  }  
                              ?>
                              </div>
                          </div>
                          

                        </div>
                        

                        <!-- Overseas Qualified Section -->
                        <div id="overseasQualifiedSection" style="display: none;">
                          <div class="form-group level-drp overseas_block">
                            <label class="form-label">Please specify:</label>
                            <input type="hidden" name="" class="overseas_qualified_field" value="@if(!empty($licenses_data)){{ $licenses_data->overseas_qualified_specify }}@endif">
                            <ul id="overseas_qualified" style="display:none;">
                              <li data-value="recently_migrated">I recently migrated to Australia and am preparing to apply for AHPRA</li>
                              <li data-value="aphra_app">I have submitted my AHPRA application and am awaiting outcome</li>
                              <li data-value="aphra_assessment">I am preparing documentation for AHPRA assessment</li>
                              <li data-value="aphra_bridge">I am studying to meet AHPRA bridging/re-entry requirements</li>
                              <li data-value="other">Other</li>
                              
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="overseas_qualified" name="overseas_qualified[]" multiple="multiple"></select>
                            <span id="overseas_qualified_error" class="reqError text-danger valley"></span>
                          </div>
                          <div class="other_text_block">
                            <div id="overseasOtherText" class="mt-2 form-group level-drp" style="display: none;">
                              <label class="form-check-label">Other Reason</label>
                              <input type="text" class="form-control" name="overseas_other_textreason" placeholder="Please specify" value="@if(!empty($licenses_data)){{ $licenses_data->other_overseas_qualified }}@endif">
                              <span id="overseas_qualified_reason" class="reqError text-danger valley"></span>
                            </div>
                            <!-- Upload -->
                            <div class="form-group level-drp mb-3 mt-3">
                              <label class="form-label">Upload evidence</label>
                              <input type="hidden" name="upload_overseas_evidence" class="registration_upload-group3" value="@if(!empty($licenses_data)) {{ $licenses_data->overseas_upload_evidence }} @endif">
                              <input type="file" class="form-control upload_evidence-group3" name="" multiple onchange="changeEvidenceImg({{ $user_id }},'group3','overseas_upload_evidence')">
                              <div class="evidence-group3">
                                <?php
                                    if(!empty($licenses_data) && $licenses_data->overseas_upload_evidence != NULL){
                                    $evidence_imgs = (array)json_decode($licenses_data->overseas_upload_evidence);
                                    $i = 0;
                                    ?>
                                    @if (!empty($evidence_imgs))
                                        @foreach ($evidence_imgs as $ev_img)
                                        <div class="trans_img trans_img-{{ $i+1 }}">
                                        <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                        <div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}','group3','overseas_upload_evidence')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                        </div>    
                                        <?php
                                        $i++;
                                        ?>                                    
                                        @endforeach
                                    @endif
                                    <?php  

                                    }  
                                ?>
                                </div>
                            </div>
                          </div>
                          
                        </div>
                        <div class="not_registered_block" style="display: none;">
                          <div class="form-group level-drp not_registered mt-2">
                            <label class="form-label">Why you're not currently registered with AHPRA:</label>
                              <input type="hidden" name="" class="not_registered_field" value="@if(!empty($licenses_data)){{ $licenses_data->not_currently_registered_reason }}@endif">
                              <ul id="not_registered_div" style="display:none;">
                                
                                <li data-value="education_related">Education-Related Reasons</li>
                                <li data-value="returning_practice">Returning to Practice</li>
                                <li data-value="personal_career">Personal or Career Reasons</li>
                                <li data-value="other">Other</li>
                                
                              </ul>
                              <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="not_registered_div" name="not_registered[]" multiple="multiple"></select>
                              <span id="not_registered_error" class="reqError text-danger valley"></span>    
                          </div>
                          <div class="form-group level-drp edu_related_reasons" style="display:none;">
                            <label class="form-label">Education-Related Reasons:</label>
                            <input type="hidden" name="" class="education_related_field" value="@if(!empty($licenses_data)){{ $licenses_data->education_related_reason }}@endif">  
                            <ul id="education_related" style="display:none;">
                              
                              <li data-value="startProgram">I am about to begin an AHPRA-approved nursing/midwifery program</li>
                              <li data-value="waitingAssessment">I have completed my studies and am waiting for AHPRA assessment</li>
                              <li data-value="studiedOutside">I completed my studies outside Australia and have not applied yet</li>
                              <li data-value="didNotComplete">I did not complete my nursing/midwifery qualification</li>
                              
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="education_related" name="education_related[]" multiple="multiple"></select>
                            <span id="education_related_error" class="reqError text-danger valley"></span> 
                          </div>
                          <div class="form-group level-drp returning_to_practice" style="display:none;">
                            <label class="form-label">Returning to Practice:</label>
                            <input type="hidden" name="" class="returning_practice_field" value="@if(!empty($licenses_data)){{ $licenses_data->returning_practice }}@endif">    
                            <ul id="returning_practice" style="display:none;">
                              
                              <li data-value="lapsed">I previously held registration but let it lapse</li>
                              <li data-value="reentryProgram">I am currently completing a re-entry to practice program</li>
                              <li data-value="waitingPlacement">I am waiting for supervised practice placement approval</li>
                              <li data-value="nonPractisingToGeneral">I am transitioning from non-practising to general registration</li>
                              
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="returning_practice" name="returning_practice[]" multiple="multiple"></select>
                            <span id="returning_practice_error" class="reqError text-danger valley"></span>
                          </div>
                          <div class="form-group level-drp personal_career_reasons" style="display:none;">
                            <label class="form-label">Personal or Career Reasons:</label>
                            <input type="hidden" name="" class="personal_career_field" value="@if(!empty($licenses_data)){{ $licenses_data->personal_career }}@endif">      
                            <ul id="personal_career" style="display:none;">
                              
                              <li data-value="maternityLeave">On maternity or extended personal leave</li>
                              <li data-value="careerBreak">Taking a career break</li>
                              <li data-value="nonClinical">Working in a non-clinical healthcare role (e.g. admin, education)</li>
                              <li data-value="overseasPractice">Practising in another country</li>
                              <li data-value="nonHealth">Working in a non-healthcare sector</li>
                              <li data-value="notReturning">I do not intend to practise again</li>
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="personal_career" name="personal_career[]" multiple="multiple"></select>
                            <span id="personal_career_error" class="reqError text-danger valley"></span>
                          </div>
                          <div class="other_text_block_registered">
                            <div id="registeredOtherText" class="mt-2 form-group level-drp" style="display: none;">
                              <label class="form-check-label">Other Reason</label>
                              <input type="text" class="form-control" name="not_registered_other" placeholder="Please specify" value="@if(!empty($licenses_data)){{ $licenses_data->other_not_registered_reason }}@endif">
                              <span id="not_registered_other" class="reqError text-danger valley"></span>
                            </div>
                          </div>  
                          <!-- Upload -->
                          <div class="form-group level-drp mb-3 mt-3 registered_evidence">
                            <label class="form-label">Upload evidence</label>
                            <input type="hidden" name="upload_not_reg_evidence" class="registration_upload-group4" value="@if(!empty($licenses_data)) {{ $licenses_data->not_registered_evidence_file }} @endif">
                            <input type="file" class="form-control upload_evidence-group4" name="" multiple onchange="changeEvidenceImg({{ $user_id }},'group4','not_registered_evidence_file')">
                            <div class="evidence-group4">
                            <?php
                                if(!empty($licenses_data) && $licenses_data->not_registered_evidence_file != NULL){
                                $evidence_imgs = (array)json_decode($licenses_data->not_registered_evidence_file);
                                $i = 0;
                                ?>
                                @if (!empty($evidence_imgs))
                                    @foreach ($evidence_imgs as $ev_img)
                                    <div class="trans_img trans_img-{{ $i+1 }}">
                                    <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                    <div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}','group4','not_registered_evidence_file')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                    </div>    
                                    <?php
                                    $i++;
                                    ?>                                    
                                    @endforeach
                                @endif
                                <?php  

                                }  
                            ?>
                            </div>
                          </div>
                        
                        </div>
                        <div class="ndis_main_div">
                          <h6 class="emergency_text mt-2">NDIS</h6>
                          <div class="level-drp">
                            <label class="form-label" for="input-1">What is your NDIS status?</label>
                            <div class="form-check  mt-1  mb-2">
                              <input class="form-check-input" type="radio" value="registered" id="availableNow" name="ndis_status" @if(!empty($licenses_data) && $licenses_data->ndis_status == "registered") checked @endif>
                              <label class="form-check-label" for="availableNow">
                                I am an NDIS-registered provider
                              </label>
                            </div>
                            <div class="form-check  mt-1  mb-2">
                              <input class="form-check-input" type="radio" value="compliant" id="availableNow" name="ndis_status" @if(!empty($licenses_data) && $licenses_data->ndis_status == "compliant") checked @endif>
                              <label class="form-check-label" for="availableNow">
                                 I am NDIS-compliant, but not registered
                              </label>
                            </div>
                            <div class="form-check  mt-1  mb-2">
                              <input class="form-check-input" type="radio" value="not_compliant" id="availableNow" name="ndis_status" @if(!empty($licenses_data) && $licenses_data->ndis_status == "not_compliant") checked @endif>
                              <label class="form-check-label" for="availableNow">
                                 I am not NDIS-compliant
                              </label>
                            </div>
                            <span id="ndis_status" class="reqError text-danger valley"></span>
                          </div>    
                        </div>
                        <!-- Registered Provider Section -->
                        <div id="ndis_registered_fields" class="ndis-section" style="display:none;">
                          <div class="alert-info">
                            <strong>NDIS Scope of Work:</strong> Agency-managed, Plan-managed, and Self-managed clients
                          </div>
                          <div class="form-group level-drp">
                            <label for="ndis_number">NDIS Registration Number <span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="ndis_number" name="ndis_number" value="@if(!empty($licenses_data)){{ $licenses_data->ndis_registration_no }}@endif">
                            <span id="ndis_status_number" class="reqError text-danger valley"></span>
                          </div>  
                          <div class="form-group level-drp">
                            <label>Upload Registration Evidence:</label>
                            <input type="hidden" name="upload_ndis_evidence" class="registration_upload-ndis" value="@if(!empty($licenses_data)){{ $licenses_data->ndis_registration_evidence }}@endif">
                            <input type="file" class="form-control upload_evidence-ndis" name="" onchange="changeEvidenceImg({{ $user_id }},'ndis','ndis_registration_evidence')" multiple>
                            <div class="evidence-ndis">
                            <?php
                                if(!empty($licenses_data) && $licenses_data->ndis_registration_evidence != NULL){
                                $evidence_imgs = (array)json_decode($licenses_data->ndis_registration_evidence);
                                $i = 0;
                                ?>
                                @if (!empty($evidence_imgs))
                                    @foreach ($evidence_imgs as $ev_img)
                                    <div class="trans_img trans_img-{{ $i+1 }}">
                                    <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                    <div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}','ndis','ndis_registration_evidence')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                    </div>    
                                    <?php
                                    $i++;
                                    ?>                                    
                                    @endforeach
                                @endif
                                <?php  

                                }  
                            ?>
                            </div>
                          </div>
                          <div class="alert-helper">
                            You can showcase your skills and qualifications in <strong>Profession</strong> under <em>Specialties → Community</em>.<br>
                            Please add your Orientation Module and other relevant NDIS training under <strong>Mandatory Training</strong>, and your Screening Check under <strong>Checks and Clearances</strong>.
                          </div>
                        </div>
                        <!-- Compliant but Not Registered Section -->
                        <div id="ndis_compliant_fields" class="ndis-section" style="display:none;">
                          <div class="alert-info">
                            <strong>NDIS Scope of Work:</strong> Self-managed and Plan-managed clients
                          </div>

                          <div class="alert-helper">
                            You can showcase your skills and qualifications in <strong>Profession</strong> under <em>Specialties → Community</em>.<br>
                            Please add your Orientation Module under <strong>Mandatory Training</strong> and your Screening Check under <strong>Checks and Clearances</strong>.
                          </div>
                        </div>
                        <!-- Not Compliant Section -->
                        <div id="ndis_not_compliant_fields" class="ndis-section" style="display:none;">
                          <div class="alert-info">
                            <strong>NDIS Scope of Work:</strong> You are not currently eligible to deliver NDIS-funded services.
                          </div>

                          <p>
                            To begin working with NDIS participants, you must complete both the <strong>NDIS Worker Orientation Module</strong> and the <strong>NDIS Worker Screening Check</strong>.<br>
                            Once compliant, you may work with plan-managed and self-managed clients.<br>
                            You can then choose to become an NDIS-registered provider if you wish to work with agency-managed clients.<br>
                            <a href="https://www.ndis.gov.au/providers/becoming-ndis-provider/how-register" target="_blank" style="color: #0000EE;text-decoration: underline;">
                              Learn how to register as an NDIS provider
                            </a>
                          </p>
                        </div>
                        <div class="medical_provider_main_div">
                          <h6 class="emergency_text mt-2">Medicare Provider</h6>
                          <div class="form-group level-drp">
                            <label class="form-label" for="negotiable">Do you have a Medicare Provider Number</label><br>
                            <label class="switch">
                              <input type="checkbox" id="toggleCheckbox_medical" name="meadical_provider_toggle" @if(!empty($licenses_data) && $licenses_data->medical_provider_no != NULL) checked @endif>
                              <span class="slider"></span>
                              
                            </label>
                          </div>
                          <div class="medical_provider_content" style="display: none;">
                            <div class="form-group level-drp mt-2">
                              <label for="ndis_number">Medicare Provider Number:</label>
                              <input type="text" class="form-control" id="ndis_number" name="medical_provider_no" value="@if(!empty($licenses_data)){{ $licenses_data->medical_provider_no }}@endif">
                              <span id="medical_provider_no" class="reqError text-danger valley"></span>
                            </div>  
                            <div class="form-group level-drp mt-2">
                              <label>Upload Evidence</label>
                              <input type="hidden" name="medical_upload_evidence" class="registration_upload-medical" value="@if(!empty($licenses_data)) {{ $licenses_data->medical_upload_evidence }} @endif">
                              <input type="file" class="form-control upload_evidence-medical" onchange="changeEvidenceImg({{ $user_id }},'medical','medical_upload_evidence')" multiple>
                              <div class="evidence-medical">
                                <?php
                                  if(!empty($licenses_data) && $licenses_data->medical_upload_evidence != NULL){
                                    $evidence_imgs = (array)json_decode($licenses_data->medical_upload_evidence);
                                    $i = 0;
                                  ?>
                                    @if (!empty($evidence_imgs))
                                      @foreach ($evidence_imgs as $ev_img)
                                      <div class="trans_img trans_img-{{ $i+1 }}">
                                        <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                        <div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}','medical','medical_upload_evidence')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                      </div>    
                                      <?php
                                        $i++;
                                      ?>                                    
                                      @endforeach
                                    @endif
                                  <?php  

                                  }  
                                ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="pbs_prescriber_main_div">
                          <h6 class="emergency_text mt-2">PBS Prescriber</h6>
                          <div class="form-group level-drp">
                            <label class="form-label" for="negotiable">Do you have authority to prescribe under the PBS?</label><br>
                            <label class="switch">
                              <input type="checkbox" id="toggleCheckbox_prescribe" name="toggleCheckbox_prescribe" @if(!empty($licenses_data) && $licenses_data->pbs_type != NULL) checked @endif>
                              <span class="slider"></span>
                              
                            </label>
                          </div>
                          <div class="prescriber_content" style="display: none;">
                            <div class="form-group level-drp mb-3 mt-2">
                              <label class="form-label">Prescriber Type</label>
                              <select class="form-control perscribe_type" name="pbs_type">
                                <option value="">select</option>
                                <option value="nurse_prac" @if(!empty($licenses_data) && $licenses_data->pbs_type == "nurse_prac") selected @endif>Nurse Practitioner (NP)</option>
                                <option value="eligible_midwife" @if(!empty($licenses_data) && $licenses_data->pbs_type == "eligible_midwife") selected @endif>Eligible Midwife</option>
                                <option value="endorsed_midwife" @if(!empty($licenses_data) && $licenses_data->pbs_type == "endorsed_midwife") selected @endif>Endorsed Midwife – Scheduled Medicines</option>
                                <option value="prescriber_under" @if(!empty($licenses_data) && $licenses_data->pbs_type == "prescriber_under") selected @endif>Prescriber under Collaborative Arrangement (under a doctor for PBS access)</option>
                                <option value="other_nursing" @if(!empty($licenses_data) && $licenses_data->pbs_type == "other_nursing") selected @endif>Other (nursing/midwifery-specific role) </option>
                                
                              </select>
                              <span id="reqpbs_type" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group level-drp other_nursing_midwife" style="display: none;">
                              <label for="ndis_number">Other (nursing/midwifery-specific role)</label>
                              <input type="text" class="form-control" id="ndis_number" name="pbs_other_nursing" value="@if(!empty($licenses_data)){{ $licenses_data->pbs_other_nursing }}@endif">
                              <span id="reqpbs_other_nursing" class="reqError text-danger valley"></span>
                            </div>  
                            <div class="form-group level-drp mt-2">
                              <label for="ndis_number">Prescriber Number:</label>
                              <input type="text" class="form-control" id="ndis_number" name="prescribe_no" value="@if(!empty($licenses_data)){{ $licenses_data->prescribe_no }}@endif">
                              <span id="reqprescribe_no" class="reqError text-danger valley"></span>
                            </div>  
                            <div class="form-group level-drp mt-2">
                              <label>Upload Evidence</label>
                              <input type="hidden" name="prescribe_evidence" class="registration_upload-prescribe" value="@if(!empty($licenses_data)) {{ $licenses_data->prescribe_evidence }} @endif">
                              <input type="file" class="form-control upload_evidence-prescribe" name="" onchange="changeEvidenceImg({{ $user_id }},'prescribe','prescribe_evidence')" multiple>
                              <div class="evidence-prescribe">
                                <?php
                                  if(!empty($licenses_data) && $licenses_data->prescribe_evidence != NULL){
                                    $evidence_imgs = (array)json_decode($licenses_data->prescribe_evidence);
                                    $i = 0;
                                  ?>
                                    @if (!empty($evidence_imgs))
                                      @foreach ($evidence_imgs as $ev_img)
                                      <div class="trans_img trans_img-{{ $i+1 }}">
                                        <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                        <div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}','prescribe','prescribe_evidence')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                      </div>    
                                      <?php
                                        $i++;
                                      ?>                                    
                                      @endforeach
                                    @endif
                                  <?php  

                                  }  
                                ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="immunisation_provider_main_div">
                          <h6 class="emergency_text mt-2">Immunisation Provider</h6>
                          <p>
                            An authorised Immunisation Provider is a nurse or midwife who meets the requirements to independently administer vaccines in their state/territory. This typically requires completing approved immunisation training and registering with a state health program. 
                          </p>
                          <div class="form-group level-drp">
                            <label class="form-label" for="negotiable">Are you an authorised Immunisation Provider?</label><br>
                            <label class="switch">
                              <input type="checkbox" id="toggleCheckbox_immunization" name="toggleCheckbox_immunization" @if(!empty($licenses_data) && $licenses_data->immunization_state != NULL) checked @endif>
                              <span class="slider"></span>
                              
                            </label>
                          </div>
                          <div class="immunization_content" style="display: none;">
                            <div class="form-group drp--clr mt-2">
                              <label class="form-label" for="input-1">State of Authorisation</label>
                              
                              <input type="hidden" name="" class="immunization_state" value="@if(!empty($licenses_data)) {{ $licenses_data->immunization_state }} @endif">
                              <ul id="state_authorization" style="display:none;">
                                
                                <li data-value="NSW">New South Wales (NSW)</li>
                                <li data-value="VIC">Victoria (VIC)</li>
                                <li data-value="QLD">Queensland (QLD)</li>
                                <li data-value="WA">Western Australia (WA)</li>
                                <li data-value="SA">South Australia (SA)</li>
                                <li data-value="TAS">Tasmania (TAS)</li>
                                <li data-value="ACT">Australian Capital Territory (ACT)</li>
                                <li data-value="NT">Northern Territory (NT)</li>
                              </ul>
                              <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="state_authorization" name="immunization_state[]" multiple="multiple"></select>
                              <span id="reqimmunization_state" class="reqError text-danger valley"></span>
                            </div>
                            <div class="authorizing_body">
                              @if (!empty($licenses_data) && $licenses_data->authorizing_body_program != NULL)
                              <?php
                                $immunization_state = (array)json_decode($licenses_data->immunization_state);
                                $authorizing_body = (array)json_decode($licenses_data->authorizing_body_program);
                                //print_r($immunization_state);
                              ?>
                              @foreach ($immunization_state as $imstate)
                              <?php
                                if($imstate == "NSW"){
                                  $state_name = "New South Wales (NSW)";
                                }
                                if($imstate == "VIC"){
                                  $state_name = "Victoria (VIC)";
                                }
                                if($imstate == "QLD"){
                                  $state_name = "Queensland (QLD)";
                                }
                                if($imstate == "WA"){
                                  $state_name = "Western Australia (WA)";
                                }
                                if($imstate == "SA"){
                                  $state_name = "South Australia (SA)";
                                }
                                if($imstate == "TAS"){
                                  $state_name = "Tasmania (TAS)";
                                }
                                if($imstate == "ACT"){
                                  $state_name = "Australian Capital Territory (ACT)";
                                }
                                if($imstate == "NT"){
                                  $state_name = "Northern Territory (NT)";
                                }
                              ?>
                              <div class="author_div author_div-{{ $imstate }}">
                                <div class="strong_text inslabtext"><strong>{{ $state_name }}</strong></div>
                                <input type="hidden" name="immunization_list" class="immunization_list immunization_list-{{ $imstate }}" value="@if(isset($authorizing_body[$imstate])){{ $imstate }}@endif">
                                <div class="form-group level-drp">
                                  <label for="ndis_number">Authorising Body or Program</label>
                                  <input type="text" class="form-control" id="ndis_number" name="authorizing_body_program[{{ $imstate }}][authorizing_body]" value="@if(isset($authorizing_body[$imstate])){{ $authorizing_body[$imstate]->authorizing_body }}@endif">
                                  <span id="reqauthorizing_body_program" class="reqError text-danger valley"></span>
                                </div>
                                <div class="form-group level-drp mt-2">
                                  <label for="ndis_number">Date Authorised</label>
                                  <input type="date" class="form-control" id="ndis_number" name="authorizing_body_program[{{ $imstate }}][date_authorized]" value="@if(isset($authorizing_body[$imstate])){{ $authorizing_body[$imstate]->date_authorized }}@endif">
                                  <span id="reqdate_authorised" class="reqError text-danger valley"></span>
                                </div>
                                <div class="form-group level-drp mt-2">
                                  <label>Upload Evidence</label>
                                  <input type="hidden" name="authorizing_body_program[{{ $imstate }}][evidence]" class="registration_upload-immunization-{{ $imstate }}" value="@if(isset($authorizing_body[$imstate])){{ $authorizing_body[$imstate]->evidence }}@endif">
                                  <input type="file" class="form-control upload_evidence-immunization-{{ $imstate }}" name="" onchange="changeEvidenceImg({{ $user_id }},'immunization-{{ $imstate }}','authorizing_body_program')" multiple>
                                  <div class="evidence-immunization-{{ $imstate }}">
                                    <?php
                                      if(isset($authorizing_body[$imstate]) && $authorizing_body[$imstate]->evidence != NULL){
                                        $evidence_imgs = (array)json_decode($authorizing_body[$imstate]->evidence);
                                        $i = 0;
                                      ?>
                                        @if (!empty($evidence_imgs))
                                          @foreach ($evidence_imgs as $ev_img)
                                          <div class="trans_img trans_img-{{ $i+1 }}">
                                            <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                            <div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}','immunization-{{ $imstate }}','authorizing_body_program')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                          </div>    
                                          <?php
                                            $i++;
                                          ?>                                    
                                          @endforeach
                                        @endif
                                      <?php  

                                      }  
                                    ?>
                                  </div>
                                </div>
                              </div>  
                              @endforeach
                              @endif
                            </div>
                            {{-- <div class="form-group level-drp">
                              <label for="ndis_number">Authorising Body or Program</label>
                              <input type="text" class="form-control" id="ndis_number" name="authorizing_body_program" value="@if(!empty($licenses_data)){{ $licenses_data->authorizing_body_program }}@endif">
                              <span id="reqauthorizing_body_program" class="reqError text-danger valley"></span>
                            </div>  
                            <div class="form-group level-drp">
                              <label for="ndis_number">Date Authorised</label>
                              <input type="date" class="form-control" id="ndis_number" name="date_authorised" value="@if(!empty($licenses_data)){{ $licenses_data->date_authorised }}@endif">
                              <span id="reqdate_authorised" class="reqError text-danger valley"></span>
                            </div>  
                            <div class="form-group level-drp">
                              <label>Upload Evidence</label>
                              <input type="hidden" name="immuzination_evidence" class="registration_upload-immunization" value="@if(!empty($licenses_data)) {{ $licenses_data->immuzination_evidence }} @endif">
                              <input type="file" class="form-control upload_evidence-immunization" name="" onchange="changeEvidenceImg({{ $user_id }},'immunization','immuzination_evidence')" multiple>
                              <div class="evidence-immunization">
                                <?php
                                  if(!empty($licenses_data) && $licenses_data->immuzination_evidence != NULL){
                                    $evidence_imgs = (array)json_decode($licenses_data->immuzination_evidence);
                                    $i = 0;
                                  ?>
                                    @if (!empty($evidence_imgs))
                                      @foreach ($evidence_imgs as $ev_img)
                                      <div class="trans_img trans_img-{{ $i+1 }}">
                                        <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                        <div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}','immunization','immuzination_evidence')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                      </div>    
                                      <?php
                                        $i++;
                                      ?>                                    
                                      @endforeach
                                    @endif
                                  <?php  

                                  }  
                                ?>
                              </div>
                            </div> --}}
                          </div>
                        </div>  
                        <div class="radiation_main_div">
                          <h6 class="emergency_text mt-2">Radiation Use Licence</h6>
                          <p>
                            A Radiation Use Licence is required for nurses and midwives who operate ionising radiation equipment (e.g. limited X-rays, neonatal portable scans). Licensing requirements and scope vary by jurisdiction. Please refer to your state or territory’s licence conditions for specific authorisation limits.
                          </p>
                          <div class="form-group level-drp">
                            <label class="form-label" for="negotiable">Do you hold a current Radiation Use Licence?</label><br>
                            <label class="switch">
                              <input type="checkbox" id="toggleCheckbox_radiation" name="toggleCheckbox_radiation" @if(!empty($licenses_data) && $licenses_data->radiation_licence_type != NULL) checked @endif>
                              <span class="slider"></span>
                              
                            </label>
                          </div>
                          <div class="radiation_content" style="display: none;">
                            <div class="form-group drp--clr">
                              <label class="form-label" for="input-1">Licence Type</label>
                              
                              <input type="hidden" name="" class="radiation_licence_type" value="@if(!empty($licenses_data)) {{ $licenses_data->radiation_licence_type }} @endif">
                              <ul id="licenses_type" style="display:none;">
                                
                                <li data-value="medical_r">Medical Radiation Use Licence – Restricted</li>
                                <li data-value="diagnostic_radiography_restricted">Diagnostic Radiography - Restricted</li>
                                <li data-value="limited_xray_operator">Limited X-ray Operator</li>
                                <li data-value="mobile_xray_operator">Mobile X-ray Operator</li>
                                <li data-value="neonatal_xray_operator">Neonatal X-ray Operator</li>
                                <li data-value="fluoroscopy_assistive_restricted">Fluoroscopy – Assistive Use (Restricted)</li>
                                <li data-value="bone_mineral_restricted">Bone Mineral Densitometry (DEXA) – Restricted</li>
                                <li data-value="ct_mri_support_non_operator">CT or MRI Support Role (Non-operator)</li>
                                <li data-value="radiation_use_trainee_student">Radiation Use Licence – Trainee / Student</li>
                                <li data-value="radiation_use_educational">Radiation Use Licence – Educational Purposes</li>
                                <li data-value="diagnostic_ultrasound">Diagnostic Ultrasound</li>
                                <li data-value="other">Other</li>
                              </ul>
                              <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="licenses_type" name="radiation_licence_type[]" multiple="multiple"></select>
                              <span id="reqlicenses_type" class="reqError text-danger valley"></span>
                            </div>
                            <div class="other_radiation" style="display: none;">
                              <?php
                                  
                                if(!empty($licenses_data)){
                                  $licence_other_data = (array)json_decode($licenses_data->radiation_licenses_no);
                                }else{
                                  $licence_other_data = array();
                                }

                              ?>
                              <div class="form-group level-drp">
                                <label for="ndis_number">Other</label>
                                <input type="text" class="form-control" id="ndis_number" name="licenses_type_other" value="@if(!empty($licenses_data)){{ $licenses_data->licenses_type_other }}@endif">
                                <span id="reqlicenses_type_other" class="reqError text-danger valley"></span>
                              </div> 
                              <div class="licence_content licence_content-other">
                                
                                <input type="hidden" name="licence_type_list" class="licence_type_list licence_type_list-other" value="other">
                                
                                <div class="form-group drp--clr">
                                  <label class="form-label" for="input-1">State of Issue</label>
                                  <input type="hidden" class="state_issue_hide state_issue_hide-other" value="@if(!empty($licenses_data) && isset($licence_other_data['other']) && isset($licence_other_data['other']->state_issue)){{ json_encode($licence_other_data['other']->state_issue) }}@endif">
                                  <ul id="state_issue-other" style="display:none;">
                                    <li data-value="NSW">New South Wales (NSW)</li>
                                    <li data-value="VIC">Victoria (VIC)</li>
                                    <li data-value="QLD">Queensland (QLD)</li>
                                    <li data-value="WA">Western Australia (WA)</li>
                                    <li data-value="SA">South Australia (SA)</li>
                                    <li data-value="TAS">Tasmania (TAS)</li>
                                    <li data-value="ACT">Australian Capital Territory (ACT)</li>
                                    <li data-value="NT">Northern Territory (NT)</li>
                                  </ul>
                                  <select class="state_issue_other js-example-basic-multiple addAll_removeAll_btn" data-list-id="state_issue-other" name="radiation_licenses_data[other][state_issue][]" onchange="stateIssue('other','ap')" multiple="multiple"></select>
                                  <span id="reqstate_issue_other" class="reqError text-danger valley"></span>
                                </div>
                                <div class="form-group drp--clr">
                                  <label class="form-label" for="input-1">Licensing Body</label>
                                  <input type="hidden" class="licence_body_hide licence_body_hide-other" value="@if(!empty($licenses_data) && isset($licence_other_data['other']) && isset($licence_other_data['other']->licence_body)){{ json_encode($licence_other_data['other']->licence_body) }}@endif">
                                  <ul id="licence_body-other" style="display:none;">
                                    <li data-value="environment_protection">EPA NSW – Environment Protection Authority</li>
                                    <li data-value="radiation_safety">Department of Health – Radiation Safety</li>
                                    <li data-value="radiation_health">Queensland Health – Radiation Health</li>
                                    <li data-value="radiation_protection">SA EPA – Radiation Protection</li>
                                    <li data-value="radiological_council">Radiological Council of WA</li>
                                    <li data-value="health_department">Radiation Protection Unit – Department of Health</li>
                                    <li data-value="health_nt">Department of Health NT Radiation Safety</li>
                                    <li data-value="health_protection">Health Protection Service</li>
                                  </ul>
                                  <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="licence_body-other" name="radiation_licenses_data[other][licence_body][]" multiple="multiple"></select>
                                  <span id="reqstate_issue" class="reqError text-danger valley"></span>
                                </div>
                                <div class="licensec-data-other">
                                  <?php
                                    if(!empty($licenses_data) && $licenses_data->radiation_state_data != NULL){
                                      $radiation_state_type = json_decode($licenses_data->radiation_state_data);
                                      //$radiation_licenses_no = (array)json_decode($licenses_data->radiation_licenses_no);
                                      
                                    }else{
                                      $radiation_state_type = array(); 
                                    }
                                    $state_options = [
                                        'NSW' => 'New South Wales (NSW)',
                                        'VIC' => 'Victoria (VIC)',
                                        'QLD' => 'Queensland (QLD)',
                                        'WA'  => 'Western Australia (WA)',
                                        'SA'  => 'South Australia (SA)',
                                        'TAS' => 'Tasmania (TAS)',
                                        'ACT' => 'Australian Capital Territory (ACT)',
                                        'NT'  => 'Northern Territory (NT)',
                                    ];
                                  ?>
                                  @if(isset($radiation_state_type->other))
                                  @foreach ($radiation_state_type->other as $index=>$radiation_state)
                                <div class="licenses_state_data licenses_state_data-{{ $index }}">
                                  <div class="licence_content licence_content-{{ $index }}">
                                  <div class="strong_text inslabtext"><strong>{{ $state_options[$index] }}</strong></div>
                                  <input type="hidden" name="licence_state_type_list" class="licence_state_type_list licence_state_type_list-{{ $index }}" value="{{ $index }}">
                                  <div class="form-group level-drp mt-2">
                                    <label for="ndis_number">Licence Number</label>
                                    <input type="text" class="form-control licence_no_{{ $index }}" id="radiation_licenses_no" name="radiation_state_data['other'][{{ $index }}][radiation_licenses_no]" value="{{ $radiation_state->radiation_licenses_no }}">
                                    <span id="reqradiation_licenses_no_{{ $index }}" class="reqError text-danger valley"></span>
                                  </div>
                                  <div class="form-group level-drp mt-2">
                                      <label for="ndis_number">Issue Date</label>
                                      <input type="date" class="form-control issue_date_{{ $index }}" id="ndis_number" name="radiation_state_data['other'][{{ $licence_type }}][{{ $index }}][radiation_issue_date]" value="{{ $radiation_state->radiation_issue_date }}">
                                      <span id="reqradiation_issue_date_{{ $index }}" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="form-group level-drp mt-2">
                                      <label for="ndis_number">Expiry Date</label>
                                      <input type="date" class="form-control expiry_date_{{ $index }}" id="ndis_number" name="radiation_state_data['other'][{{ $licence_type }}][{{ $index }}][radiation_expiry_date]" value="{{ $radiation_state->radiation_expiry_date }}">
                                      <span id="reqradiation_expiry_date_{{ $index }}" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="form-group level-drp mt-2">
                                      <label>Upload Evidence</label>
                                      <input type="hidden" name="radiation_state_data['other'][{{ $licence_type }}][{{ $index }}][evidence]" class="registration_upload-other-{{ $index }}" value="{{ $radiation_state->evidence }}">
                                      <input type="file" class="form-control upload_evidence-other-{{ $index }}" name="" onchange="changeEvidenceImg({{ $user_id }},'other-{{ $index }}','radiation_state_data')" multiple>
                                      <div class="evidence-other-{{ $index }}">
                                        <?php
                                          if(isset($radiation_state->evidence) && $radiation_state->evidence != NULL){
                                            $evidence_imgs = (array)json_decode($radiation_state->evidence);
                                            $i = 0;
                                          ?>
                                            @if (!empty($evidence_imgs))
                                              @foreach ($evidence_imgs as $ev_img)
                                              <div class="trans_img trans_img-{{ $i+1 }}">
                                                <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                                <div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}','other-{{ $index }}','radiation_state_data')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                              </div>    
                                              <?php
                                                $i++;
                                              ?>                                    
                                              @endforeach
                                            @endif
                                          <?php  

                                          }  
                                        ?>
                                      </div>
                                    </div>
                                </div>
                                
                                </div>
                                @endforeach
                                @endif
                                </div>
                              </div>
                            </div>
                             
                            <div class="liccence_type_program">
                            <?php
                               
                              if(!empty($licenses_data) && $licenses_data->radiation_licence_type != NULL){
                                $radiation_licence_type = json_decode($licenses_data->radiation_licence_type);
                                $radiation_licenses_no = (array)json_decode($licenses_data->radiation_licenses_no);
                                
                              }else{
                                $radiation_licence_type = array(); 
                              }

                              $licenses_array = [
                                  'medical_r' => 'Medical Radiation Use Licence – Restricted',
                                  'diagnostic_radiography_restricted' => 'Diagnostic Radiography - Restricted',
                                  'limited_xray_operator' => 'Limited X-ray Operator',
                                  'mobile_xray_operator' => 'Mobile X-ray Operator',
                                  'neonatal_xray_operator' => 'Neonatal X-ray Operator',
                                  'fluoroscopy_assistive_restricted' => 'Fluoroscopy – Assistive Use (Restricted)',
                                  'bone_mineral_restricted' => 'Bone Mineral Densitometry (DEXA) – Restricted',
                                  'ct_mri_support_non_operator' => 'CT or MRI Support Role (Non-operator)',
                                  'radiation_use_trainee_student' => 'Radiation Use Licence – Trainee / Student',
                                  'radiation_use_educational' => 'Radiation Use Licence – Educational Purposes',
                                  'diagnostic_ultrasound' => 'Diagnostic Ultrasound',
                                  'other' => 'Other'
                              ];


                            ?>  
                            @if(!empty($radiation_licence_type))
                            @foreach($radiation_licence_type as $licence_type)
                            <?php
                              $licence_name = $licenses_array[$licence_type];
                            ?>
                            @if($licence_type != "other")
                              <div class="licence_content licence_content-{{ $licence_type }}">   
                                <div class="strong_text inslabtext"><strong>{{ $licence_name }}</strong></div>
                                <input type="hidden" name="licence_type_list" class="licence_type_list licence_type_list-{{ $licence_type }}" value="{{ $licence_type }}">
                                <div class="form-group drp--clr">
                                  <label class="form-label" for="input-1">State of Issue</label>
                                  <input type="hidden" class="state_issue_hide state_issue_hide-{{ $licence_type }}" value="@if(isset($radiation_licenses_no[$licence_type])  && isset($radiation_licenses_no[$licence_type]->state_issue)){{ json_encode($radiation_licenses_no[$licence_type]->state_issue) }}@endif">
                                  <ul id="state_issue-{{ $licence_type }}" style="display:none;">
                                    <li data-value="NSW">New South Wales (NSW)</li>
                                    <li data-value="VIC">Victoria (VIC)</li>
                                    <li data-value="QLD">Queensland (QLD)</li>
                                    <li data-value="WA">Western Australia (WA)</li>
                                    <li data-value="SA">South Australia (SA)</li>
                                    <li data-value="TAS">Tasmania (TAS)</li>
                                    <li data-value="ACT">Australian Capital Territory (ACT)</li>
                                    <li data-value="NT">Northern Territory (NT)</li>
                                  </ul>
                                  <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="state_issue-{{ $licence_type }}" name="radiation_licenses_data[{{ $licence_type }}][state_issue][]" onchange="stateIssue('{{ $licence_type }}','ap')" multiple="multiple"></select>
                                  <span id="reqstate_issue" class="reqError text-danger valley"></span>
                                </div>
                                <div class="form-group drp--clr">
                                  <label class="form-label" for="input-1">Licensing Body</label>
                                  <input type="hidden" class="licence_body_hide licence_body_hide-{{ $licence_type }}" value="@if(isset($radiation_licenses_no[$licence_type]) && isset($radiation_licenses_no[$licence_type]->licence_body)){{ json_encode($radiation_licenses_no[$licence_type]->licence_body) }}@endif">
                                  <ul id="licence_body-{{ $licence_type }}" style="display:none;">
                                    <li data-value="environment_protection">EPA NSW – Environment Protection Authority</li>
                                    <li data-value="radiation_safety">Department of Health – Radiation Safety</li>
                                    <li data-value="radiation_health">Queensland Health – Radiation Health</li>
                                    <li data-value="radiation_protection">SA EPA – Radiation Protection</li>
                                    <li data-value="radiological_council">Radiological Council of WA</li>
                                    <li data-value="health_department">Radiation Protection Unit – Department of Health</li>
                                    <li data-value="health_nt">Department of Health NT Radiation Safety</li>
                                    <li data-value="health_protection">Health Protection Service</li>
                                  </ul>
                                  <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="licence_body-{{ $licence_type }}" name="radiation_licenses_data[{{ $licence_type }}][licence_body][]" multiple="multiple"></select>
                                  <span id="reqstate_issue" class="reqError text-danger valley"></span>
                                </div>
                                <?php
                                  if(!empty($licenses_data) && $licenses_data->radiation_state_data != NULL){
                                    $radiation_state_type = (array)json_decode($licenses_data->radiation_state_data);
                                    //$radiation_licenses_no = (array)json_decode($licenses_data->radiation_licenses_no);
                                    
                                  }else{
                                    $radiation_state_type = array(); 
                                  }
                                  $state_options = [
                                      'NSW' => 'New South Wales (NSW)',
                                      'VIC' => 'Victoria (VIC)',
                                      'QLD' => 'Queensland (QLD)',
                                      'WA'  => 'Western Australia (WA)',
                                      'SA'  => 'South Australia (SA)',
                                      'TAS' => 'Tasmania (TAS)',
                                      'ACT' => 'Australian Capital Territory (ACT)',
                                      'NT'  => 'Northern Territory (NT)',
                                  ];
                                  //print_r($radiation_state_type);die;
                                ?>
                                <div class="licensec-data-{{ $licence_type }}">
                                @foreach ($radiation_state_type[$licence_type] as $index=>$radiation_state)
                                <div class="licenses_state_data licenses_state_data-{{ $index }}">
                                  <div class="licence_content licence_content-{{ $index }}">
                                  <div class="strong_text inslabtext"><strong>{{ $state_options[$index] }}</strong></div>
                                  <input type="hidden" name="licence_state_type_list" class="licence_state_type_list licence_state_type_list-{{ $index }}" value="{{ $index }}">
                                  <div class="form-group level-drp mt-2">
                                    <label for="ndis_number">Licence Number</label>
                                    <input type="text" class="form-control licence_no_{{ $index }}" id="radiation_licenses_no" name="radiation_state_data[{{ $licence_type }}][{{ $index }}][radiation_licenses_no]" value="{{ $radiation_state->radiation_licenses_no }}">
                                    <span id="reqradiation_licenses_no_{{ $index }}" class="reqError text-danger valley"></span>
                                  </div>
                                  <div class="form-group level-drp mt-2">
                                      <label for="ndis_number">Issue Date</label>
                                      <input type="date" class="form-control issue_date_{{ $index }}" id="ndis_number" name="radiation_state_data[{{ $licence_type }}][{{ $index }}][radiation_issue_date]" value="{{ $radiation_state->radiation_issue_date }}">
                                      <span id="reqradiation_issue_date_{{ $index }}" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="form-group level-drp mt-2">
                                      <label for="ndis_number">Expiry Date</label>
                                      <input type="date" class="form-control expiry_date_{{ $index }}" id="ndis_number" name="radiation_state_data[{{ $licence_type }}][{{ $index }}][radiation_expiry_date]" value="{{ $radiation_state->radiation_expiry_date }}">
                                      <span id="reqradiation_expiry_date_{{ $index }}" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="form-group level-drp mt-2">
                                      <label>Upload Evidence</label>
                                      <input type="hidden" name="radiation_state_data[{{ $licence_type }}][{{ $index }}][evidence]" class="registration_upload-{{ $licence_type }}-{{ $index }}" value="{{ $radiation_state->evidence }}">
                                      <input type="file" class="form-control upload_evidence-{{ $licence_type }}-{{ $index }}" name="" onchange="changeEvidenceImg({{ $user_id }},'{{ $licence_type }}-{{ $index }}','radiation_state_data')" multiple>
                                      <div class="evidence-{{ $licence_type }}-{{ $index }}">
                                        <?php
                                          if(isset($radiation_state->evidence) && $radiation_state->evidence != NULL){
                                            $evidence_imgs = (array)json_decode($radiation_state->evidence);
                                            $i = 0;
                                          ?>
                                            @if (!empty($evidence_imgs))
                                              @foreach ($evidence_imgs as $ev_img)
                                              <div class="trans_img trans_img-{{ $i+1 }}">
                                                <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                                <div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}','{{ $licence_type }}-{{ $index }}','radiation_state_data')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                              </div>    
                                              <?php
                                                $i++;
                                              ?>                                    
                                              @endforeach
                                            @endif
                                          <?php  

                                          }  
                                        ?>
                                      </div>
                                    </div>
                                </div>
                                </div>
                                @endforeach
                                </div>
                              {{-- <div class="form-group level-drp">
                                <label>Upload Evidence</label>
                                <input type="hidden" name="radiation_licenses_data[{{ $licence_type }}][evidence]" class="registration_upload-radiation-{{ $licence_type }}" value="@if(isset($radiation_licenses_no[$licence_type])  && isset($radiation_licenses_no[$licence_type]->evidence)){{ $radiation_licenses_no[$licence_type]->evidence }}@endif">
                                <input type="file" class="form-control upload_evidence-radiation-{{ $licence_type }}" name="" onchange="changeEvidenceImg({{ $user_id }},'radiation-{{ $licence_type }}','radiation_licenses_no')" multiple>
                                <div class="evidence-radiation-{{ $licence_type }}">
                                  <?php
                                      if(isset($radiation_licenses_no[$licence_type]) && $radiation_licenses_no[$licence_type]->evidence != NULL){
                                        $evidence_imgs = (array)json_decode($radiation_licenses_no[$licence_type]->evidence);
                                        $i = 0;
                                      ?>
                                        @if (!empty($evidence_imgs))
                                          @foreach ($evidence_imgs as $ev_img)
                                          <div class="trans_img trans_img-{{ $i+1 }}">
                                            <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                            <div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}','radiation-{{ $licence_type }}','radiation_licenses_no')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                          </div>    
                                          <?php
                                            $i++;
                                          ?>                                    
                                          @endforeach
                                        @endif
                                      <?php  

                                      }  
                                    ?>
                                </div>
                              </div> --}}
                            </div>
                            @endif
                            @endforeach
                            @endif
                            </div>
                            {{-- 
                            <div class="form-group level-drp">
                              <label for="ndis_number">Licence Number</label>
                              <input type="text" class="form-control" id="radiation_licenses_no" name="radiation_licenses_no" value="@if(!empty($licenses_data)){{ $licenses_data->radiation_licenses_no }}@endif">
                              <span id="reqradiation_licenses_no" class="reqError text-danger valley"></span>
                            </div>
                            <div class="form-group drp--clr">
                              <label class="form-label" for="input-1">State of Issue</label>
                              
                              <input type="hidden" name="" class="radiation_state_issue" value="@if(!empty($licenses_data)) {{ $licenses_data->radiation_state_issue }} @endif">
                              <ul id="state_issue" style="display:none;">
                                
                                <li data-value="NSW">New South Wales (NSW)</li>
                                <li data-value="VIC">Victoria (VIC)</li>
                                <li data-value="QLD">Queensland (QLD)</li>
                                <li data-value="WA">Western Australia (WA)</li>
                                <li data-value="SA">South Australia (SA)</li>
                                <li data-value="TAS">Tasmania (TAS)</li>
                                <li data-value="ACT">Australian Capital Territory (ACT)</li>
                                <li data-value="NT">Northern Territory (NT)</li>
                              </ul>
                              <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="state_issue" name="radiation_state_issue[]" multiple="multiple"></select>
                              <span id="reqstate_issue" class="reqError text-danger valley"></span>
                            </div>  
                            <div class="form-group level-drp">
                              <label for="ndis_number">Issue Date</label>
                              <input type="date" class="form-control" id="ndis_number" name="radiation_issue_date" value="@if(!empty($licenses_data)){{ $licenses_data->radiation_issue_date }}@endif">
                              <span id="reqradiation_issue_date" class="reqError text-danger valley"></span>
                            </div>  
                            <div class="form-group level-drp">
                              <label for="ndis_number">Expiry Date</label>
                              <input type="date" class="form-control" id="ndis_number" name="radiation_expiry_date" value="@if(!empty($licenses_data)){{ $licenses_data->radiation_expiry_date }}@endif">
                              <span id="reqradiation_expiry_date" class="reqError text-danger valley"></span>
                            </div>  
                            <div class="form-group level-drp">
                              <label>Upload Evidence</label>
                              <input type="hidden" name="radiation_evidence" class="registration_upload-radiation" value="@if(!empty($licenses_data)) {{ $licenses_data->radiation_evidence }} @endif">
                              <input type="file" class="form-control upload_evidence-radiation" name="" onchange="changeEvidenceImg({{ $user_id }},'radiation','radiation_evidence')" multiple>
                              <div class="evidence-radiation">
                                <?php
                                  if(!empty($licenses_data) && $licenses_data->radiation_evidence != NULL){
                                    $evidence_imgs = (array)json_decode($licenses_data->radiation_evidence);
                                    $i = 0;
                                  ?>
                                    @if (!empty($evidence_imgs))
                                      @foreach ($evidence_imgs as $ev_img)
                                      <div class="trans_img trans_img-{{ $i+1 }}">
                                        <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                        <div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}','radiation','radiation_evidence')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                      </div>    
                                      <?php
                                        $i++;
                                      ?>                                    
                                      @endforeach
                                    @endif
                                  <?php  

                                  }  
                                ?>
                            </div>
                          </div> --}}
                        </div>  
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitRegistrationLicenses" @if(!email_verified()) disabled  @endif>Save Changes</button>
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
@include('nurse.front_profile_js');
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

    
    if ($.trim($(".register_other_place").val()) != "") {
      var register_other_place = JSON.parse($(".register_other_place").val());
      console.log("register_other_place",register_other_place);
      $('.js-example-basic-multiple[data-list-id="other_places"]').select2().val(register_other_place).trigger('change');
      
    }

    if ($.trim($(".overseas_qualified_field").val()) != "") {
      var overseas_qualified_field = JSON.parse($(".overseas_qualified_field").val());
      console.log("overseas_qualified_field",overseas_qualified_field);
      $('.js-example-basic-multiple[data-list-id="overseas_qualified"]').select2().val(overseas_qualified_field).trigger('change');
      
    }

    if ($.trim($(".not_registered_field").val()) != "") {
      var not_registered_field = JSON.parse($(".not_registered_field").val());
      console.log("not_registered_field",not_registered_field);
      $('.js-example-basic-multiple[data-list-id="not_registered_div"]').select2().val(not_registered_field).trigger('change');
      
    }

    if ($.trim($(".education_related_field").val()) != "") {
      var education_related_field = JSON.parse($(".education_related_field").val());
      console.log("not_registered_field",education_related_field);
      $('.js-example-basic-multiple[data-list-id="education_related"]').select2().val(education_related_field).trigger('change');
      
    }

    if ($.trim($(".returning_practice_field").val()) != "") {
      var returning_practice_field = JSON.parse($(".returning_practice_field").val());
      console.log("returning_practice_field",returning_practice_field);
      $('.js-example-basic-multiple[data-list-id="returning_practice"]').select2().val(returning_practice_field).trigger('change');
      
    }

    if ($.trim($(".personal_career_field").val()) != "") {
      var personal_career_field = JSON.parse($(".personal_career_field").val());
      console.log("personal_career_field",personal_career_field);
      $('.js-example-basic-multiple[data-list-id="personal_career"]').select2().val(personal_career_field).trigger('change');
      
    }

    if ($.trim($(".immunization_state").val()) != "") {
      var immunization_state = JSON.parse($(".immunization_state").val());
      console.log("immunization_state",immunization_state);
      $('.js-example-basic-multiple[data-list-id="state_authorization"]').select2().val(immunization_state).trigger('change');
      
    }

    if ($.trim($(".radiation_licence_type").val()) != "") {
      var radiation_licence_type = JSON.parse($(".radiation_licence_type").val());
      console.log("radiation_licence_type",radiation_licence_type);
      $('.js-example-basic-multiple[data-list-id="licenses_type"]').select2().val(radiation_licence_type).trigger('change');
      
    }

    // if ($.trim($(".radiation_state_issue").val()) != "") {
    //   var radiation_state_issue = JSON.parse($(".radiation_state_issue").val());
    //   console.log("radiation_state_issue",radiation_state_issue);
    //   $('.js-example-basic-multiple[data-list-id="state_issue"]').select2().val(radiation_state_issue).trigger('change');
      
    // }

    $(".licence_type_list").each(function(){
      var licence_type_val = $(this).val();
      console.log("licence_type_val",$(".state_issue_hide-"+licence_type_val).val());
      if($.trim($(".state_issue_hide-"+licence_type_val).val()) != ""){
        let state_issue_hide = JSON.parse($(".state_issue_hide-"+licence_type_val).val());
        console.log("state_issue_hide",state_issue_hide);
        $('.js-example-basic-multiple[data-list-id="state_issue-'+licence_type_val+'"]').select2().val(state_issue_hide).trigger('change');
      }

      if($.trim($(".licence_body_hide-"+licence_type_val).val()) != ""){
        let licence_body_hide = JSON.parse($(".licence_body_hide-"+licence_type_val).val());
        console.log("licence_body_hide",licence_body_hide);
        $('.js-example-basic-multiple[data-list-id="licence_body-'+licence_type_val+'"]').select2().val(licence_body_hide).trigger('change');
      }

      $('.js-example-basic-multiple[data-list-id="state_issue-'+licence_type_val+'"]').on('change', function() {
        var selectedValues = $(this).val();

        var licence_body_values = [];

        if (selectedValues.includes('NSW')) {
            licence_body_values.push("environment_protection");
        }
        if (selectedValues.includes('VIC')) {
            licence_body_values.push("radiation_safety");
        }
        if (selectedValues.includes('QLD')) {
            licence_body_values.push("radiation_health");
        }
        if (selectedValues.includes('WA')) {
            licence_body_values.push("radiation_protection");
        }
        if (selectedValues.includes('SA')) {
            licence_body_values.push("radiological_council");
        }
        if (selectedValues.includes('TAS')) {
            licence_body_values.push("health_department");
        }
        if (selectedValues.includes('ACT')) {
            licence_body_values.push("health_nt");
        }
        if (selectedValues.includes('NT')) {
            licence_body_values.push("health_protection");
        }

        $('.js-example-basic-multiple[data-list-id="licence_body-'+licence_type_val+'"]').select2().val(licence_body_values).trigger('change');

        console.log("licence_body_values",licence_body_values);
      });

    });

    function stateIssue(selected_values,ap){

      if(ap == 'ap'){
        var selectedValues = $('.js-example-basic-multiple[data-list-id="state_issue-'+selected_values+'"]').val();
      }else{
        var selectedValues = $('.js-example-basic-multiple'+selected_values+'[data-list-id="state_issue-'+selected_values+'"]').val();
      }
      
      $(".licensec-data-"+selected_values+" .licence_state_type_list").each(function(i,val){
        var val1 = $(val).val();
        console.log("val",val1);
        if(selectedValues.includes(val1) == false){
            $(".licenses_state_data-"+val1).remove();
        }
      });
      console.log("selectedValues",selectedValues);
      var licence_body_values = [];
      var state_name = '';
      if (selectedValues.includes('NSW')) {
          
          licence_body_values.push("environment_protection");
      }
      if (selectedValues.includes('VIC')) {
          
          licence_body_values.push("radiation_safety");
      }
      if (selectedValues.includes('QLD')) {
          
          licence_body_values.push("radiation_health");
      }
      if (selectedValues.includes('WA')) {
          
          licence_body_values.push("radiation_protection");
      }
      if (selectedValues.includes('SA')) {
          
          licence_body_values.push("radiological_council");
      }
      if (selectedValues.includes('TAS')) {
          
          licence_body_values.push("health_department");
      }
      if (selectedValues.includes('ACT')) {
          
          licence_body_values.push("health_nt");
      }
      if (selectedValues.includes('NT')) {
          
          licence_body_values.push("health_protection");
      }

      $('.js-example-basic-multiple'+selected_values+'[data-list-id="licence_body-'+selected_values+'"]').select2().val(licence_body_values).trigger('change');

      console.log("licence_body_values",licence_body_values);

      var licenseMap = [];

      $('#state_issue-'+selected_values+' li').each(function() {
        var key = $(this).data('value');
        var value = $(this).text();
        licenseMap[key] = value;
      });

      for(var i=0;i<selectedValues.length;i++){
        var licence_type_name = licenseMap[selectedValues[i]];
        var user_id = "{{ $user_id }}";
        var evidence_name = "radiation_state_data";
        if($(".licensec-data-"+selected_values+" .licenses_state_data-"+selectedValues[i]).length < 1){
          $(".licensec-data-"+selected_values).append('<div class="licenses_state_data licenses_state_data-'+selectedValues[i]+'">\
              <div class="licence_content licence_content-'+selectedValues[i]+'">\
                <div class="strong_text inslabtext"><strong>'+licence_type_name+'</strong></div>\
                <input type="hidden" name="licence_state_type_list" class="licence_state_type_list licence_state_type_list-'+selectedValues[i]+'" value="'+selectedValues[i]+'">\
                <div class="form-group level-drp">\
                  <label for="ndis_number">Licence Number</label>\
                  <input type="text" class="form-control licence_no_'+selectedValues[i]+'" id="radiation_licenses_no" name="radiation_state_data['+selected_values+']['+selectedValues[i]+'][radiation_licenses_no]">\
                  <span id="reqradiation_licenses_no_'+selectedValues[i]+'" class="reqError text-danger valley"></span>\
                </div>\
                <div class="form-group level-drp">\
                    <label for="ndis_number">Issue Date</label>\
                    <input type="date" class="form-control issue_date_'+selectedValues[i]+'" id="ndis_number" name="radiation_state_data['+selected_values+']['+selectedValues[i]+'][radiation_issue_date]">\
                    <span id="reqradiation_issue_date_'+selectedValues[i]+'" class="reqError text-danger valley"></span>\
                  </div>\
                  <div class="form-group level-drp">\
                    <label for="ndis_number">Expiry Date</label>\
                    <input type="date" class="form-control expiry_date_'+selectedValues[i]+'" id="ndis_number" name="radiation_state_data['+selected_values+']['+selectedValues[i]+'][radiation_expiry_date]">\
                    <span id="reqradiation_expiry_date_'+selectedValues[i]+'" class="reqError text-danger valley"></span>\
                  </div>\
                  <div class="form-group level-drp">\
                    <label>Upload Evidence</label>\
                    <input type="hidden" name="radiation_state_data['+selected_values+']['+selectedValues[i]+'][evidence]" class="registration_upload-'+selected_values+"-"+selectedValues[i]+'">\
                    <input type="file" class="form-control upload_evidence-'+selected_values+"-"+selectedValues[i]+'" name="" onchange="changeEvidenceImg(\''+user_id+'\',\''+selected_values+"-"+selectedValues[i]+'\',\''+evidence_name+'\')" multiple>\
                    <div class="evidence-'+selected_values+"-"+selectedValues[i]+'"></div>\
                </div>\
            </div>');
          }
      }
      
    }

    $('.ahpra_number').on('keyup', function() {
      $('.lookup-ahpra-btn')
              .removeClass('disabled')
              .css('pointer-events', '')
              .css('opacity', '');
    });


    // $('.js-example-basic-multiple[data-list-id="licenses_type"]').on('change', function() {
    //   var selectedValues = $(this).val();

    //   if(selectedValues.includes("other")){
    //     $(".other_radiation").show();
    //   }else{
    //     $(".other_radiation").hide();
    //   }
    // });
    

    $('#toggleCheckbox').click(function(){
      if ($('#toggleCheckbox').is(':checked')) {
        // Checkbox is checked
        console.log('Checked!');
        $("#notationsSection").show();
      } else {
        // Checkbox is not checked
        console.log('Not checked!');
        $("#notationsSection").hide();
        $("#otherNotation").val("");
       
      }
    });

    if ($('#toggleCheckbox').is(':checked')) {
      // Checkbox is checked
      console.log('Checked!');
      $("#notationsSection").show();
    } else {
      // Checkbox is not checked
      console.log('Not checked!');
      $("#notationsSection").hide();
    }

    if ($('#toggleCheckbox_medical').is(':checked')) {
      // Checkbox is checked
      console.log('Checked!');
      $(".medical_provider_content").show();
    } else {
      // Checkbox is not checked
      console.log('Not checked!');
      $(".medical_provider_content").hide();
    }
    $('#toggleCheckbox_medical').click(function(){
      if ($('#toggleCheckbox_medical').is(':checked')) {
        // Checkbox is checked
        console.log('Checked!');
        $(".medical_provider_content").show();
      } else {
        // Checkbox is not checked
        console.log('Not checked!');
        $(".medical_provider_content").hide();
      }
    });

    $('#toggleCheckbox_prescribe').click(function(){
      if ($('#toggleCheckbox_prescribe').is(':checked')) {
        // Checkbox is checked
        console.log('Checked!');
        $(".prescriber_content").show();
      } else {
        // Checkbox is not checked
        console.log('Not checked!');
        $(".prescriber_content").hide();
      }
    });
    if ($('#toggleCheckbox_prescribe').is(':checked')) {
        // Checkbox is checked
        console.log('Checked!');
        $(".prescriber_content").show();
      } else {
        // Checkbox is not checked
        console.log('Not checked!');
        $(".prescriber_content").hide();
      }
    $('#toggleCheckbox_radiation').click(function(){
      if ($('#toggleCheckbox_radiation').is(':checked')) {
        // Checkbox is checked
        console.log('Checked!');
        $(".radiation_content").show();
      } else {
        // Checkbox is not checked
        console.log('Not checked!');
        $(".radiation_content").hide();
      }
    });
    if ($('#toggleCheckbox_radiation').is(':checked')) {
        // Checkbox is checked
        console.log('Checked!');
        $(".radiation_content").show();
      } else {
        // Checkbox is not checked
        console.log('Not checked!');
        $(".radiation_content").hide();
      }
    $('#toggleCheckbox_immunization').click(function(){
      if ($('#toggleCheckbox_immunization').is(':checked')) {
        // Checkbox is checked
        console.log('Checked!');
        $(".immunization_content").show();
      } else {
        // Checkbox is not checked
        console.log('Not checked!');
        $(".immunization_content").hide();
      }
    });
    if ($('#toggleCheckbox_immunization').is(':checked')) {
        // Checkbox is checked
        console.log('Checked!');
        $(".immunization_content").show();
      } else {
        // Checkbox is not checked
        console.log('Not checked!');
        $(".immunization_content").hide();
      }

    $('.perscribe_type').on('change', function () {
        let perscribe_type = $(this).val();
        if(perscribe_type == "other_nursing"){
          $(".other_nursing_midwife").show();
        }
    });

    $('#toggleCheckbox_conditions').click(function(){
      if ($('#toggleCheckbox_conditions').is(':checked')) {
        // Checkbox is checked
        console.log('Checked!');
        $("#conditionsSection").show();
      } else {
        // Checkbox is not checked
        console.log('Not checked!');
        $("#conditionsSection").hide();
        $("#otherCondition").val("");
      }
    });
    
    if ($('#toggleCheckbox_conditions').is(':checked')) {
        // Checkbox is checked
        console.log('Checked!');
        $("#conditionsSection").show();
      } else {
        // Checkbox is not checked
        console.log('Not checked!');
        $("#conditionsSection").hide();
      }
  
    document.getElementById('reverifyBtn').addEventListener('click', function () {
    // Simulate re-verification process (replace this with your actual logic, API, etc.)
    $("#lookupSpinner_reverify").removeClass('d-none');
    const now = new Date();
    const formatted = now.toLocaleDateString('en-GB') + ' – ' + now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

    // Overwrite the stored last verified date (UI + backend)

    const reg_number = "<?php if(!empty($licenses_data)){ echo $licenses_data->aphra_registration_no; } ?>";
    
    var user_registration_data = JSON.parse(localStorage.getItem("user_registration_data"));
    //console.log("registrationNumber",user_registration_data.registrationNumber);
    if (!user_registration_data || user_registration_data.registrationNumber != ahpraNumber) {    
    $.ajax({
            url: "{{ route('admin.getAhpraDetails') }}",
            type: "POST",
            cache: false,
            data: {reg_number:reg_number,reverify_text:1,lastVerified:formatted,_token:"{{ csrf_token() }}"},
            success: function(res) {
              var data = res.data;
              console.log("data",res.error);
              $('#submitRegistrationLicenses').prop('disabled', false);
              $("#lookupSpinner").addClass('d-none');
              $("#lookupSpinnerText").text('Lookup AHPRA Registration');
              if(res?.error == "No matching"){
                $("#ahpra-lookup-result").hide();
                $(".manual_ahpra_lookup").show();
                $(".manual_reverify_error").show();
                $("#reqaphra_reg").text("No matching registration found, please check the AHPRA number and try again.");
              }

              if(res?.error == "failed"){
                $("#ahpra-lookup-result").hide();
                $(".manual_ahpra_lookup").show();
                
                $("#reqaphra_reg").text("Ahpra service is temporarily unavailable. Please try again after sometime");
              }

              if(res?.data){
                
                $(".api_verify").val(1);
                $("#ahpra-lookup-result").show();
                $("#successful_ahpra").show();
                $(".manual_ahpra_lookup").hide();
                $("#reqaphra_reg").text("");
                $("#division").html(data.division);
                $("#endorsements").html(data.endorsements);
                $("#reg_type").html(data.registration_type);
                $("#reg_status").html(data.registrationStatus);
                $("#notations").html(data.notations);
                $("#conditions").html(data.conditions);
                $("#expiry").html(data.expiryDate);
                $("#principal_practice").html(data.suburb+","+data.state+","+data.postcode+","+data.country);
                //$("#other_practices").html(data.other_places);
                $(".api_division").val(data.division);
                $(".api_endorsements").val(data.endorsements);
                $(".api_reg_type").val(data.registration_type);
                $(".api_reg_status").val(data.registrationStatus);
                $(".api_notations").val(data.notations);
                $(".api_conditions").val(data.conditions);
                $(".api_expiry").val(data.expiryDate);
                $(".api_principal_practice").val(data.suburb+","+data.state+","+data.postcode+","+data.country);
                $(".api_other_practices").val(res.other_places);
                   $('#reverifyBtn')
                .addClass('disabled')
                .css('pointer-events', 'none')
                .css('opacity', '0.6');
                localStorage.setItem("user_registration_data", JSON.stringify(data));
                localStorage.setItem("reverifyCooldown", Date.now().toString());
                document.getElementById('lastVerified').innerText = formatted;
                $(".last_verified_date").val(formatted);
              }

              

            }
          });
        } else {
          
            
            $("#division").html(user_registration_data.division);
            $("#endorsements").html(user_registration_data.endorsements);
            $("#reg_type").html(user_registration_data.registration_type);
            $("#reg_status").html(user_registration_data.registrationStatus);
            $("#notations").html(user_registration_data.notations);
            $("#conditions").html(user_registration_data.conditions);
            $("#expiry").html(user_registration_data.expiryDate);
            $("#principal_practice").html(user_registration_data.suburb+","+user_registration_data.state+","+user_registration_data.postcode+","+user_registration_data.country);
            //$("#other_practices").html(data.other_places);
            $(".api_division").val(user_registration_data.division);
            $(".api_endorsements").val(user_registration_data.endorsements);
            $(".api_reg_type").val(user_registration_data.registration_type);
            $(".api_reg_status").val(user_registration_data.registrationStatus);
            $(".api_notations").val(user_registration_data.notations);
            $(".api_conditions").val(user_registration_data.conditions);
            $(".api_expiry").val(user_registration_data.expiryDate);
            $(".api_principal_practice").val(user_registration_data.suburb+","+user_registration_data.state+","+user_registration_data.postcode+","+user_registration_data.country);
            //$("#lookupSpinner").addClass('d-none');
            $('#reverifyBtn')
                .addClass('disabled')
                .css('pointer-events', 'none')
                .css('opacity', '0.6');
          
        }

    // TODO: Add AJAX call or form submission to update the backend
    // Example:
    /*
    fetch('/update-verification', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ nurse_id: 123, last_verified: now.toISOString() })
    }).then(...);

    */

    //alert('Your AHPRA registration has been re-verified.');
  });
    
  const registrationStatus = document.getElementById("registration-status");
  const ahpraGroup = document.getElementById("ahpra-details-group");
  const ahpraGroup_group2 = document.getElementById("manualAHPRAFields");
  const graduation_date = document.getElementById("graduationDateGroup");
  const upload_graduation_evidence = document.getElementById("uploadEvidenceGroup");
  const ahpraGroup_overseas = document.getElementById("overseasQualifiedSection");
  const ahpraotherbox = document.getElementById("overseasOtherText");
  const not_registered = document.getElementsByClassName("not_registered");

  const allowedStatuses = ["RN", "RM", "RN_RM", "NP"];

  const allowedStatuses_group2 = ["Graduate_RN", "Graduate_RM", "Student_Nurse", "Student_Midwife"];

  const allowedStatuses_group3 = ["Overseas"];

  const allowedStatuses_group4 = ["Not_Registered"];
  
  const allowedStatuses_graduate = ["Graduate_RN", "Graduate_RM"];
  

  registrationStatus.addEventListener("change", function () {
    console.log("registrationStatus",registrationStatus.value);
    if (allowedStatuses.includes(this.value)) {
      
      ahpraGroup.style.display = "block";
      $("#manualAHPRAFields").hide();
      $("#overseasQualifiedSection").hide();
      $(".not_registered_block").hide();
    } else {
      
      ahpraGroup.style.display = "none";
    }

    if (allowedStatuses_group2.includes(this.value)) {
      
      if(allowedStatuses_graduate.includes(this.value)){
        ahpraGroup_group2.style.display = "block";
        graduation_date.style.display = "none";
        $("#ahpra-details-group").hide();
        $("#overseasQualifiedSection").hide();
        $(".not_registered_block").hide();
      }else{
        ahpraGroup_group2.style.display = "block";
        
        graduation_date.style.display = "block";
      }
      
    } else {
      
      ahpraGroup_group2.style.display = "none";
    }

    if (allowedStatuses_group3.includes(this.value)) {
      
      ahpraGroup_overseas.style.display = "block";
      $("#ahpra-details-group").hide();
      $("#manualAHPRAFields").hide();
      $(".not_registered_block").hide();
    } else {
      
      ahpraGroup_overseas.style.display = "none";
    }

    if (allowedStatuses_group4.includes(this.value)) {
      $("#ahpra-details-group").hide();
      $("#manualAHPRAFields").hide();
      $("#overseasQualifiedSection").hide();
      $(".not_registered_block").show();
    } else {
      
      $(".not_registered_block").hide();
    }
    
    
  });

  var reg_status = $("#registration-status").val();
  console.log("reg_status",reg_status);

  if(reg_status == "RN" || reg_status == "RM" || reg_status == "RN_RM" || reg_status == "NP"){
    $("#ahpra-details-group").show();
    $("#manualAHPRAFields").hide();
    $("#overseasQualifiedSection").hide();
    $(".not_registered_block").hide();
  }else{
    $("#ahpra-details-group").hide();
  }

  if(reg_status == "Graduate_RN" || reg_status == "Graduate_RM" || reg_status == "Student_Nurse" || reg_status == "Student_Midwife"){
    $("#ahpra-details-group").hide();
    $("#manualAHPRAFields").show();
    $("#overseasQualifiedSection").hide();
    $(".not_registered_block").hide();
    if(reg_status == "Graduate_RN" || reg_status == "Graduate_RM"){
      $("#graduationDateGroup").hide();
    }else{
      $("#graduationDateGroup").show();
    }
  }else{
    $("#manualAHPRAFields").hide();
  }

  if(reg_status == "Overseas"){
    $("#ahpra-details-group").hide();
    $("#manualAHPRAFields").hide();
    $("#overseasQualifiedSection").show();
    $(".not_registered_block").hide();
  }else{
    $("#overseasQualifiedSection").hide();
  }

  if(reg_status == "Not_Registered"){
    $("#ahpra-details-group").hide();
    $("#manualAHPRAFields").hide();
    $("#overseasQualifiedSection").hide();
    $(".not_registered_block").show();
  }else{
    $(".not_registered_block").hide();
  }

  var ndis_status = $('input[name="ndis_status"]:checked').val();

  if(ndis_status == "registered"){
    $("#ndis_registered_fields").show();
    $("#ndis_compliant_fields").hide();
    $("#ndis_not_compliant_fields").hide();
  }

  if(ndis_status == "compliant"){
    $("#ndis_registered_fields").hide();
    $("#ndis_compliant_fields").show();
    $("#ndis_not_compliant_fields").hide();
  }

  if(ndis_status == "not_compliant"){
    $("#ndis_registered_fields").hide();
    $("#ndis_compliant_fields").hide();
    $("#ndis_not_compliant_fields").show();
  }



  $('input[name="ndis_status"]').on('change', function () {
      const value = $(this).val();

      $('.ndis-section').hide(); // hide all sections

      if (value === 'registered') {
          $('#ndis_registered_fields').show();
      } else if (value === 'compliant') {
          $('#ndis_compliant_fields').show();
      } else if (value === 'not_compliant') {
          $('#ndis_not_compliant_fields').show();
      }
  });

  let selectedValues = $('.js-example-basic-multiple[data-list-id="overseas_qualified"]').val();
  console.log("selectedValues",selectedValues);
  if(selectedValues.includes("other")){
    $("#overseasOtherText").show();
  }else{
    $("#overseasOtherText").hide();
  }
  $('.js-example-basic-multiple[data-list-id="overseas_qualified"]').on('change', function() {
    let selectedValues = $(this).val();
    console.log("selectedValues",selectedValues);

    if(selectedValues.includes("other")){
      $("#overseasOtherText").show();
    }else{
      $("#overseasOtherText").hide();
    }
  });

  var pbs_type = $(".perscribe_type").val(); 

  if(pbs_type == "other_nursing"){
    $(".other_nursing_midwife").show();
  }else{
    $(".other_nursing_midwife").hide();
  }

  $('.js-example-basic-multiple[data-list-id="state_authorization"]').on('change', function() {
    let selectedValues = $(this).val();
    console.log("selectedValues",selectedValues);

    $(".authorizing_body .immunization_list").each(function(i,val){
      var val1 = $(val).val();
      console.log("val",val1);
      if(selectedValues.includes(val1) == false){
          $(".author_div-"+val1).remove();
      }
    });

    for(var i=0;i<selectedValues.length;i++){
      if(selectedValues[i] == "NSW"){
        var state_name = "New South Wales (NSW)";
      }
      if(selectedValues[i] == "VIC"){
        var state_name = "Victoria (VIC)";
      }
      if(selectedValues[i] == "QLD"){
        var state_name = "Queensland (QLD)";
      }
      if(selectedValues[i] == "WA"){
        var state_name = "Western Australia (WA)";
      }
      if(selectedValues[i] == "SA"){
        var state_name = "South Australia (SA)";
      }
      if(selectedValues[i] == "TAS"){
        var state_name = "Tasmania (TAS)";
      }
      if(selectedValues[i] == "ACT"){
        var state_name = "Australian Capital Territory (ACT)";
      }
      if(selectedValues[i] == "NT"){
        var state_name = "Northern Territory (NT)";
      }
      if($(".authorizing_body .author_div-"+selectedValues[i]).length < 1){
        var immunization_evi = "immunization-"+selectedValues[i];
        var authorizing_program = "authorizing_body_program";
        $(".authorizing_body").append('\<div class="author_div author_div-'+selectedValues[i]+'">\
          <div class="strong_text inslabtext"><strong>'+state_name+'</strong></div>\
          <input type="hidden" name="immunization_list" class="immunization_list immunization_list-'+selectedValues[i]+'" value="'+selectedValues[i]+'">\
          <div class="form-group level-drp">\
            <label for="ndis_number">Authorising Body or Program</label>\
            <input type="text" class="form-control authorizing_body_program-'+selectedValues[i]+'" id="ndis_number" name="authorizing_body_program['+selectedValues[i]+'][authorizing_body]">\
            <span id="reqauthorizing_body_program-'+selectedValues[i]+'" class="reqError text-danger valley"></span>\
          </div>\
          <div class="form-group level-drp">\
            <label for="ndis_number">Date Authorised</label>\
            <input type="date" class="form-control date_authorized-'+selectedValues[i]+'" id="ndis_number" name="authorizing_body_program['+selectedValues[i]+'][date_authorized]">\
            <span id="reqdate_authorised-'+selectedValues[i]+'" class="reqError text-danger valley"></span>\
          </div>\
          <div class="form-group level-drp">\
            <label>Upload Evidence</label>\
            <input type="hidden" name="authorizing_body_program['+selectedValues[i]+'][evidence]" class="registration_upload-immunization-'+selectedValues[i]+'">\
            <input type="file" class="form-control upload_evidence-immunization-'+selectedValues[i]+'" name="" onchange="changeEvidenceImg({{ $user_id }},\''+immunization_evi+'\',\''+authorizing_program+'\')" multiple>\
            <div class="evidence-immunization-'+selectedValues[i]+'"></div>\
          </div>\
        </div>');
      }
    }

  });

  var licenses_type_data = $('.js-example-basic-multiple[data-list-id="licenses_type"]').val();

  if(licenses_type_data.includes('other')){
    $(".other_radiation").show();
  }else{
    $(".other_radiation").hide();
  }

  $('.js-example-basic-multiple[data-list-id="licenses_type"]').on('change', function() {
    let selectedValues = $(this).val();
    console.log("selectedValues",selectedValues);

    $(".liccence_type_program .licence_type_list").each(function(i,val){
      var val1 = $(val).val();
      console.log("val",val1);
      if(selectedValues.includes(val1) == false){
          $(".licence_content-"+val1).remove();
      }
    });

    var licenseMap = [];

    $('#licenses_type li').each(function() {
      var key = $(this).data('value');
      var value = $(this).text();
      licenseMap[key] = value;
    });

    console.log("licenseMap",licenseMap.medical_r);

    for(var i=0;i<selectedValues.length;i++){
      if(selectedValues[i] == "other"){
        $(".other_radiation").show();
      }else{
        $(".other_radiation").hide();
        var licence_type_name = licenseMap[selectedValues[i]];
        var licence_type_key = selectedValues[i];
        if($(".liccence_type_program .licence_content-"+selectedValues[i]).length < 1){
          var immunization_evi = "radiation-"+selectedValues[i];
          var authorizing_program = "radiation_licenses_no";
          var ap = '';
          $(".liccence_type_program").append('\<div class="licence_content licence_content-'+selectedValues[i]+'">\
                              <div class="strong_text inslabtext"><strong>'+licence_type_name+'</strong></div>\
                              <input type="hidden" name="licence_type_list" class="licence_type_list licence_type_list-'+selectedValues[i]+'" value="'+selectedValues[i]+'">\
                              <div class="form-group drp--clr">\
                                <label class="form-label" for="input-1">State of Issue</label>\
                                <ul id="state_issue-'+selectedValues[i]+'" style="display:none;">\
                                  <li data-value="NSW">New South Wales (NSW)</li>\
                                  <li data-value="VIC">Victoria (VIC)</li>\
                                  <li data-value="QLD">Queensland (QLD)</li>\
                                  <li data-value="WA">Western Australia (WA)</li>\
                                  <li data-value="SA">South Australia (SA)</li>\
                                  <li data-value="TAS">Tasmania (TAS)</li>\
                                  <li data-value="ACT">Australian Capital Territory (ACT)</li>\
                                  <li data-value="NT">Northern Territory (NT)</li>\
                                </ul>\
                                <select class="state_issue_'+selectedValues[i]+' js-example-basic-multiple'+selectedValues[i]+' addAll_removeAll_btn" data-list-id="state_issue-'+selectedValues[i]+'" onchange="stateIssue(\''+selectedValues[i]+'\',\''+ap+'\')" name="radiation_licenses_data['+selectedValues[i]+'][state_issue][]" multiple="multiple"></select>\
                                <span id="reqstate_issue_'+selectedValues[i]+'" class="reqError text-danger valley"></span>\
                              </div>\
                              <div class="form-group drp--clr">\
                                  <label class="form-label" for="input-1">Licensing Body</label>\
                                  <ul id="licence_body-'+selectedValues[i]+'" style="display:none;">\
                                    <li data-value="environment_protection">EPA NSW – Environment Protection Authority</li>\
                                    <li data-value="radiation_safety">Department of Health – Radiation Safety</li>\
                                    <li data-value="radiation_health">Queensland Health – Radiation Health</li>\
                                    <li data-value="radiation_protection">SA EPA – Radiation Protection</li>\
                                    <li data-value="radiological_council">Radiological Council of WA</li>\
                                    <li data-value="health_department">Radiation Protection Unit – Department of Health</li>\
                                    <li data-value="health_nt">Department of Health NT Radiation Safety</li>\
                                    <li data-value="health_protection">Health Protection Service</li>\
                                  </ul>\
                                  <select class="js-example-basic-multiple'+selectedValues[i]+' addAll_removeAll_btn" data-list-id="licence_body-'+selectedValues[i]+'" name="radiation_licenses_data['+selectedValues[i]+'][licence_body][]" multiple="multiple"></select>\
                                  <span id="reqstate_issue" class="reqError text-danger valley"></span>\
                                </div>\
                                <div class="licensec-data-'+selectedValues[i]+'"></div>\
                              </div>');
                            selectTwoFunction(selectedValues[i]);
        }                    
      }
      
    }

    

  });  

  $('.js-example-basic-multiple[data-list-id="not_registered_div"]').on('change', function() {
    let selectedValues = $(this).val();
    console.log("selectedValues",selectedValues);

    if(selectedValues.includes("education_related")){
      $(".edu_related_reasons").show();
    }else{
      $(".edu_related_reasons").hide();
    }

    if(selectedValues.includes("returning_practice")){
      $(".returning_to_practice").show();
    }else{
      $(".returning_to_practice").hide();
    }

    if(selectedValues.includes("personal_career")){
      $(".personal_career_reasons").show();
    }else{
      $(".personal_career_reasons").hide();
    }

    if(selectedValues.includes("other")){
      $("#registeredOtherText").show();
      $(".register_evidence").show();
    }else{
      $("#registeredOtherText").hide();
      $(".register_evidence").hide();
    }
  });

  let selectedValues_not_reg = $('.js-example-basic-multiple[data-list-id="not_registered_div"]').val();

  if(selectedValues_not_reg.includes("education_related")){
      $(".edu_related_reasons").show();
    }else{
      $(".edu_related_reasons").hide();
    }

    if(selectedValues_not_reg.includes("returning_practice")){
      $(".returning_to_practice").show();
    }else{
      $(".returning_to_practice").hide();
    }

    if(selectedValues_not_reg.includes("personal_career")){
      $(".personal_career_reasons").show();
    }else{
      $(".personal_career_reasons").hide();
    }

    if(selectedValues_not_reg.includes("other")){
      $("#registeredOtherText").show();
      $(".register_evidence").show();
    }else{
      $("#registeredOtherText").hide();
      $(".register_evidence").hide();
    }

  // Show/hide "Other" notation input field
  document.getElementById('notationOther').addEventListener('change', (e) => {
    const otherText = document.getElementById('otherNotationText');
    otherText.style.display = e.target.checked ? 'block' : 'none';
    
    if ($('#notationOther').is(':checked') == false) {
      // Checkbox is checked
      $("#otherNotation").val("");
      
    }

  });

  document.getElementById('conditionOther').addEventListener('change', (e) => {
    const otherText = document.getElementById('otherConditionText');
    otherText.style.display = e.target.checked ? 'block' : 'none';
    if ($('#conditionOther').is(':checked')) {
      $("#otherCondition").val("");
    }
  });

    if ($('#notationOther').is(':checked')) {
      // Checkbox is checked
      console.log('Checked!');
      $("#otherNotationText").show();
    } else {
      // Checkbox is not checked
      console.log('Not checked!');
      $("#otherNotationText").hide();
    }

    if ($('#conditionOther').is(':checked')) {
      // Checkbox is checked
      console.log('Checked!');
      $("#otherConditionText").show();
    } else {
      // Checkbox is not checked
      console.log('Not checked!');
      $("#otherConditionText").hide();
    }

    var api_verify = $(".api_verify").val();

    if(api_verify == '0'){
      $(".manual_ahpra_lookup").show();
    }else{
      if(api_verify == '1'){
        $("#ahpra-lookup-result").show();
        
      }
      
    }

    $('[name="division"]').change(function(){
      
      $(".manual_reverify_error").hide();
      $(".manual_entry_div").hide();
    });

    $(".lookup-ahpra-btn").click(function(){
      var ahpraNumber = $(".ahpra_number").val().trim();
      console.log("ahpraNumber",ahpraNumber);

      $('#submitRegistrationLicenses').prop('disabled', true);

      var isValid = true;

      if ($('[name="ahpra_number"]').val() == '') {

        document.getElementById("group_one_aphrano").innerHTML = "* Please Enter your AHPRA Registration Number.";
        isValid = false;

      }

      const ahpraNumber1 = $('.ahpra_number').val().trim();
      const pattern = "/^NMW\d{10}$/";

      
      if (!ahpraNumber1 || !ahpraNumber1.startsWith('NMW') || ahpraNumber1.length !== 13) {
        document.getElementById("group_one_aphrano").innerHTML = "* Please Enter the valid AHPRA Registration Number.";
        isValid = false;
      }

      if ($('#ahpra-consent').is(':checked') == false) {
        document.getElementById("aphra_checkbox").innerHTML = "* Please Enter your AHPRA Registration Number.";
        isValid = false;
      }
      
      if(isValid == true){
        $("#lookupSpinner").removeClass('d-none');
        $("#lookupSpinnerText").text('Checking AHPRA register');
        var user_registration_data = JSON.parse(localStorage.getItem("user_registration_data"));
        //console.log("registrationNumber",user_registration_data.registrationNumber);
        $("#ahpra-lookup-result").hide();
        $(".manual_ahpra_lookup").hide();
        
        if (!user_registration_data || user_registration_data.registrationNumber != ahpraNumber) {
          $.ajax({
            url: "{{ route('admin.getAhpraDetails') }}",
            type: "POST",
            cache: false,
            data: {reg_number:ahpraNumber,_token:"{{ csrf_token() }}"},
            success: function(res) {
              var data = res.data;
              console.log("data",res.error);
              $('#submitRegistrationLicenses').prop('disabled', false);
              $("#lookupSpinner").addClass('d-none');
              $("#lookupSpinnerText").text('Lookup AHPRA Registration');
              if(res?.error == "No matching"){
                $("#ahpra-lookup-result").hide();
                $(".manual_ahpra_lookup").show();
                $(".manual_reverify_error").show();
                $(".manual_entry_div").hide();
                $("#reqaphra_reg").text("No matching registration found, please check the AHPRA number and try again.");
                $('#ahpra-consent').prop('checked', false);
              }

              if(res?.error == "failed"){
                $("#ahpra-lookup-result").hide();
                $(".manual_ahpra_lookup").show();
                $(".manual_reverify_error").show();
                $(".manual_entry_div").hide();
                $('#ahpra-consent').prop('checked', false);
                $("#reqaphra_reg").text("Ahpra service is temporarily unavailable. Please try again after sometime");
              }

              if(res?.data){
                
                $(".api_verify").val(1);
                $("#ahpra-lookup-result").show();
                $("#successful_ahpra").show();
                $(".manual_ahpra_lookup").hide();
                $(".manual_entry_div").hide();
                $("#reqaphra_reg").text("");
                $("#division").html(data.division);
                $("#endorsements").html(data.endorsements);
                $("#reg_type").html(data.registration_type);
                $("#reg_status").html(data.registrationStatus);
                $("#notations").html(data.notations);
                $("#conditions").html(data.conditions);
                $("#expiry").html(data.expiryDate);
                $("#principal_practice").html(data.suburb+","+data.state+","+data.postcode+","+data.country);
                //$("#other_practices").html(data.other_places);
                $(".api_division").val(data.division);
                $(".api_endorsements").val(data.endorsements);
                $(".api_reg_type").val(data.registration_type);
                $(".api_reg_status").val(data.registrationStatus);
                $(".api_notations").val(data.notations);
                $(".api_conditions").val(data.conditions);
                $(".api_expiry").val(data.expiryDate);
                $(".api_principal_practice").val(data.suburb+","+data.state+","+data.postcode+","+data.country);
                $(".api_other_practices").val(res.other_places);
                   $('#reverifyBtn')
                .addClass('disabled')
                .css('pointer-events', 'none')
                .css('opacity', '0.6');
                localStorage.setItem("user_registration_data", JSON.stringify(data));
                localStorage.setItem("reverifyCooldown", Date.now().toString());
              }

              

            }
          });
        } else {
          
            $("#lookupSpinner").addClass('d-none');
            $("#division").html(user_registration_data.division);
            $("#endorsements").html(user_registration_data.endorsements);
            $("#reg_type").html(user_registration_data.registration_type);
            $("#reg_status").html(user_registration_data.registrationStatus);
            $("#notations").html(user_registration_data.notations);
            $("#conditions").html(user_registration_data.conditions);
            $("#expiry").html(user_registration_data.expiryDate);
            $("#principal_practice").html(user_registration_data.suburb+","+user_registration_data.state+","+user_registration_data.postcode+","+user_registration_data.country);
            //$("#other_practices").html(data.other_places);
            $(".api_division").val(user_registration_data.division);
            $(".api_endorsements").val(user_registration_data.endorsements);
            $(".api_reg_type").val(user_registration_data.registration_type);
            $(".api_reg_status").val(user_registration_data.registrationStatus);
            $(".api_notations").val(user_registration_data.notations);
            $(".api_conditions").val(user_registration_data.conditions);
            $(".api_expiry").val(user_registration_data.expiryDate);
            $(".api_principal_practice").val(user_registration_data.suburb+","+user_registration_data.state+","+user_registration_data.postcode+","+user_registration_data.country);
            $("#lookupSpinner").addClass('d-none');
            $('#reverifyBtn')
                .addClass('disabled')
                .css('pointer-events', 'none')
                .css('opacity', '0.6');
          
        }
            
      }  
      
   });

   $("#manualEntryBtn").click(function(){
    $(".manual_ahpra_lookup").show();
    $('#ahpra-consent').prop('checked', false);
   });

   $('[data-toggle="tooltip"]').tooltip();
   const cooldownHours = 12; 
   const lastVerified = localStorage.getItem("reverifyCooldown");
   const btn = $('.reverify_tooltip');
  if (lastVerified) {
    const diffMs = Date.now() - parseInt(lastVerified, 10);
    const diffHours = diffMs / (1000 * 60 * 60);

    if (diffHours < cooldownHours) {
      disableBtn(btn, `You can re-check after ${Math.ceil(cooldownHours - diffHours)} hours`);
    } else {
      enableBtn(btn);
    }
  }

  var ahpra_reverify = "<?php if(!empty($licenses_data)){ echo $licenses_data->ahpra_reverify; } ?>";
  
  if(ahpra_reverify == "1"){
    const lastVerified = localStorage.removeItem("reverifyCooldown");
  }

  function disableBtn($el, tooltipText) {
    $('#reverifyBtn')
              .addClass('disabled')
              .css('pointer-events', 'none')
              .css('opacity', '0.6');
    //$el.attr('title', tooltipText).tooltip();
  }

  function enableBtn($el) {
    $('#reverifyBtn')
              .removeClass('disabled')
              .css('pointer-events', '')
              .css('opacity', '');
    $el.removeAttr('title')
    localStorage.removeItem("user_registration_data");
  }
   

   

   let selectedEvidenceFiles = [];

   function changeEvidenceImg(user_id,group_name,evidence_name){
    if (!selectedEvidenceFiles[group_name]) {
        selectedEvidenceFiles[group_name] = [];
      }
      
      const newFiles = Array.from($('.upload_evidence-'+group_name)[0].files);

      console.log("newFiles",newFiles);

      newFiles.forEach(file => {
        const exists = selectedEvidenceFiles[group_name].some(f => f.name === file.name && f.lastModified === file.lastModified);
        if (!exists) {
            selectedEvidenceFiles[group_name].push(file);
        }
      });

      

        const count = selectedEvidenceFiles[group_name].length;
          console.log("evidence_count", count);
    
      // var files = $('.upload_evidence-'+language_id)[0].files;
      // console.log("files", files);
      var form_data = "";
      form_data = new FormData();

      for (var i = 0; i < selectedEvidenceFiles[group_name].length; i++) {
        if(evidence_name == "authorizing_body_program" || evidence_name == "radiation_state_data"){
          form_data.append(evidence_name+"["+group_name+"][]", selectedEvidenceFiles[group_name][i], selectedEvidenceFiles[group_name][i]['name']);
        }else{
          form_data.append(evidence_name+"[]", selectedEvidenceFiles[group_name][i], selectedEvidenceFiles[group_name][i]['name']);
        }
        
      }

      form_data.append("user_id", user_id);
      
      form_data.append("img_field", group_name);
      form_data.append("evidence_name", evidence_name);
      form_data.append("_token", '{{ csrf_token() }}');
      
      $.ajax({
        type: "post",
        url: "{{ route('admin.uploadLicensesEvidenceImgs') }}",
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        data: form_data,

        success: function(data) {
          $(".registration_upload-"+group_name).val(data);
          var image_array = JSON.parse(data);
          console.log("evidence_imgs", data);
          var htmlData = '';
          for (var i = 0; i < image_array.length; i++) {
            //console.log("degree_transcript", image_array[i]);
            var img_name = image_array[i];
            var img_field = "group1";
            console.log("img_name", 'deleteImg(' + (i + 1) + ',' + user_id + ',"' + img_name + '")');
            htmlData += '<div class="trans_img trans_img-' + (i + 1) + '"><a href="{{ url("/public") }}/uploads/education_degree/' + img_name + '" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>' + image_array[i] + '</a><div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg(' + (i + 1) + ',' + user_id + ',\'' + img_name + '\',\''+group_name+'\',\''+evidence_name+'\')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div></div>';
          }
          $(".evidence-"+group_name).html(htmlData);
          selectedEvidenceFiles[group_name] = [];
          
        }
      });
   }

   function deleteEvidenceImg(i,user_id,img,group_name,evidence_name){
    $.ajax({
        type: "post",
        url: "{{ route('admin.deleteLicensesEvidenceImg') }}",
        data: {
          user_id: user_id,
          img: img,
          img_field: group_name,
          evidence_name: evidence_name,
          _token: '{{ csrf_token() }}'
        },
        cache: false,
        success: function(data) {
          if (data == 1) {
            var old_files = JSON.parse($(".registration_upload-"+group_name).val());
            console.log("old_files",old_files);
            const itemToRemove = img;

            const result = old_files.filter(item => item !== itemToRemove);

            console.log(result); // [1, 2, 4, 5]
            $(".registration_upload-"+group_name).val(JSON.stringify(result));
            $(".evidence-"+group_name+" .trans_img-"+i).remove();

            
          }
        }
      });
   }

   function update_register_licenses(){

    var isValid = true;

    if ($('[name="ahpra_registration_status"]').val() == '') {

      document.getElementById("register_status").innerHTML = "* Please select the current AHPRA registration status.";
      isValid = false;

    }

    if ($('#ahpra-details-group').is(':visible')) {
      if ($('[name="ahpra_number"]').val() == '') {

        document.getElementById("group_one_aphrano").innerHTML = "* Please Enter your AHPRA Registration Number.";
        isValid = false;

      }

      const ahpraNumber = $('.ahpra_number').val().trim();
      const pattern = "/^NMW\d{10}$/";

      
      if (!ahpraNumber || !ahpraNumber.startsWith('NMW') || ahpraNumber.length !== 13) {
        document.getElementById("group_one_aphrano").innerHTML = "* Please Enter the valid AHPRA Registration Number.";
        isValid = false;
      }

      // if ($('#ahpra-consent').is(':checked') == false) {
      //   document.getElementById("aphra_checkbox").innerHTML = "* Please Enter your AHPRA Registration Number.";
      //   isValid = false;
      // }

      if ($('[name="api_division"]').val() == '') {

        if ($('[name="division"]').val() == '') {

          document.getElementById("register_division").innerHTML = "* Please select the register division.";
          document.getElementById("reqaphra_reg").innerHTML = "* Please fill the ahpra registration details.";
          isValid = false;

        }

        if ($('[name="endorsements"]').val() == '') {

          document.getElementById("register_endorsment").innerHTML = "* Please select the register endorsements.";
          isValid = false;

        }

        if ($('[name="reg_registration_type"]').val() == '') {

          document.getElementById("reg_registration_type").innerHTML = "* Please select the Registration Type.";
          isValid = false;

        }

        if ($('[name="reg_registration_status"]').val() == '') {

          document.getElementById("reg_registration_status").innerHTML = "* Please select the Registration Status.";
          isValid = false;

        }

        if ($('#toggleCheckbox').is(':checked') == true) {
          if ($('input[name="notations[]"]:checked').length === 0) {
            document.getElementById("reg_notations").innerHTML = "* Please select at least one notation.";
            isValid = false;
          }

          if ($('input[name="notations[]"][value="Other"]').is(':checked')) {
            if ($('[name="other_notation"]').val() == '') {

              document.getElementById("other_notation").innerHTML = "* Please select the other notation.";
              isValid = false;

            }
          }
        }

        if ($('#toggleCheckbox_conditions').is(':checked') == true) {
          if ($('input[name="conditions[]"]:checked').length === 0) {
            document.getElementById("reg_conditions").innerHTML = "* Please select at least one condition.";
            isValid = false;
          }
        }

        if ($('[name="expiry_date"]').val() == '') {

          document.getElementById("reg_expiry_date").innerHTML = "* Please select the Registration Expiry Date.";
          isValid = false;

        }

        if ($('[name="principal_place"]').val() == '') {

          document.getElementById("principal_place").innerHTML = "* Please select the Principal Place of Practice.";
          isValid = false;

        }

        if ($('[name="other_places[]"]').val() == '') {

          document.getElementById("reg_other_places").innerHTML = "* Please select the Other Places of Practice.";
          isValid = false;

        }
      }
    }

    if ($('#manualAHPRAFields').is(':visible')) {
      if ($('[name="graduate_ahpra_number"]').val() == '') {

        document.getElementById("graduate_ahpra_number").innerHTML = "* Please Enter your AHPRA Registration Number.";
        isValid = false;

      }

      const ahpraNumber = $('#ahpraNumber').val().trim();
      const pattern = "/^NMW\d{10}$/";

      
      if (!ahpraNumber || !ahpraNumber.startsWith('NMW') || ahpraNumber.length !== 13) {
        document.getElementById("group_one_aphrano").innerHTML = "* Please Enter the valid AHPRA Registration Number.";
        isValid = false;
      }

      if ($('[name="graduate_division"]').val() == '') {

        document.getElementById("graduate_division").innerHTML = "* Please select the register division.";
        isValid = false;

      }

      if ($('[name="graduate_registration_type"]').val() == '') {

        document.getElementById("graduate_registration_type").innerHTML = "* Please select the Registration Type.";
        isValid = false;

      }

      if ($('[name="graduate_registration_status"]').val() == '') {

        document.getElementById("graduate_registration_status").innerHTML = "* Please select the Registration Status.";
        isValid = false;

      }

      if ($('#graduationDateGroup').is(':visible')) {
        if ($('[name="graduation_expected_date"]').val() == '') {

          document.getElementById("graduation_expected_date").innerHTML = "* Please select the graduation date.";
          isValid = false;

        }
      }
    }

    if ($('#overseasQualifiedSection').is(':visible')) {
      if ($('[name="overseas_qualified[]"]').val() == '') {

        document.getElementById("overseas_qualified_error").innerHTML = "* Please select the Overseas-Qualified Nurses and Midwives.";
        isValid = false;

      }
      var overseas_values = $(".js-example-basic-multiple[data-list-id=overseas_qualified]").val();
      if(overseas_values.includes("other")){
        if ($('[name="overseas_other_textreason"]').val() == '') {

          document.getElementById("overseas_qualified_reason").innerHTML = "* Please select the other overseas qualified reason.";
          isValid = false;

        }
      }
      
    }

    if ($('.not_registered_block').is(':visible')) {
      if ($('[name="not_registered[]"]').val() == '') {

        document.getElementById("not_registered_error").innerHTML = "* Please select the why you're not currently registered with AHPRA.";
        isValid = false;

      }

      var not_registered_values = $(".js-example-basic-multiple[data-list-id=not_registered_div]").val();
      if(not_registered_values.includes("education_related")){
        if ($('[name="education_related[]"]').val() == '') {

          document.getElementById("education_related_error").innerHTML = "* Please select the Education-Related Reasons.";
          isValid = false;

        }
      }

      if(not_registered_values.includes("returning_practice")){
        if ($('[name="returning_practice[]"]').val() == '') {

          document.getElementById("returning_practice_error").innerHTML = "* Please select the Returning to Practice.";
          isValid = false;

        }
      }

      if(not_registered_values.includes("personal_career")){
        if ($('[name="personal_career[]"]').val() == '') {

          document.getElementById("personal_career_error").innerHTML = "* Please select the Personal or Career Reasons.";
          isValid = false;

        }
      }

      if(not_registered_values.includes("other")){
        if ($('[name="not_registered_other"]').val() == '') {

          document.getElementById("not_registered_other").innerHTML = "* Please select the Other Reason.";
          isValid = false;

        }
      }
    }

    if ($('input[name="ndis_status"]:checked').length === 0) {
      document.getElementById("ndis_status").innerHTML = "* Please select the ndis status.";
      isValid = false;
    }

    if ($('input[name="ndis_status"][value="registered"]').is(':checked')) {
      
      if ($('[name="ndis_number"]').val() == '') {

        document.getElementById("ndis_status_number").innerHTML = "* Please enter the ndis registration number.";
        isValid = false;

      }
    }

    if ($('#toggleCheckbox_medical').is(':checked') == true) {
        if ($('[name="medical_provider_no"]').val() == '') {

          document.getElementById("medical_provider_no").innerHTML = "* Please enter the Medicare Provider Number.";
          isValid = false;

        }

    }

    if ($('#toggleCheckbox_prescribe').is(':checked') == true) {
        if ($('[name="pbs_type"]').val() == '') {

          document.getElementById("reqpbs_type").innerHTML = "* Please select the Prescriber Type.";
          isValid = false;

        }

        if ($('[name="prescribe_no"]').val() == '') {

          document.getElementById("reqprescribe_no").innerHTML = "* Please enter the Prescriber Number.";
          isValid = false;

        }

    }

    if ($('#toggleCheckbox_immunization').is(':checked') == true) {
      if ($('[name="immunization_state[]"]').val() == '') {

        document.getElementById("reqimmunization_state").innerHTML = "* Please select the State of Authorisation.";
        isValid = false;

      }

      $(".immunization_list").each(function(){
        var immunization_list = $(this).val();
        if($(".authorizing_body_program-"+immunization_list).val() == ""){
          document.getElementById("reqauthorizing_body_program-"+immunization_list).innerHTML = "* Please enter the Authorising Body or Program.";
          isValid = false;
        }

        if($(".date_authorized-"+immunization_list).val() == ""){
          document.getElementById("reqdate_authorised-"+immunization_list).innerHTML = "* Please enter the Date Authorised.";
          isValid = false;
        }
      });

    }

    if ($('#toggleCheckbox_radiation').is(':checked') == true) {

      if ($('[name="radiation_licence_type[]"]').val() == '') {

        document.getElementById("reqlicenses_type").innerHTML = "* Please select the Licence Type.";
        isValid = false;

      }
      
      $(".licence_type_list").each(function(){
        var licence_type_list = $(this).val();
        
        if(licence_type_list != "other"){
          if($(".licence_no_"+licence_type_list).val() == ""){
            document.getElementById("reqradiation_licenses_no_"+licence_type_list).innerHTML = "* Please enter the Licence Number.";
            isValid = false;
          }

          if($(".state_issue_"+licence_type_list).val() == ""){
            document.getElementById("reqstate_issue_"+licence_type_list).innerHTML = "* Please enter the State of Issue.";
            isValid = false;
          }

          if($(".issue_date_"+licence_type_list).val() == ""){
            document.getElementById("reqradiation_issue_date_"+licence_type_list).innerHTML = "* Please enter the Issue Date.";
            isValid = false;
          }

          if($(".expiry_date_"+licence_type_list).val() == ""){
            document.getElementById("reqradiation_expiry_date_"+licence_type_list).innerHTML = "* Please enter the Expiry Date.";
            isValid = false;
          }
        }

      });
       
    }
    
    if(isValid == true){
      $.ajax({
        url: "{{ route('admin.update_registration_licenses') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#register_licenses_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitRegistrationLicenses').prop('disabled', true);
          $('#submitRegistrationLicenses').text('Process....');
        },
        success: function(res) {
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Registration & Licenses Information Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('admin.add_registration_licences',['id'=>$licenses_data->user_id]) }}";
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
          $('#submitRegistrationLicenses').prop('disabled', false);
          $('#submitRegistrationLicenses').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitRegistrationLicenses").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      
      });
    }

    return false;
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