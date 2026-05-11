@extends('admin.layouts.layout')
@section('content')
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
            @include("admin.layouts.nurse_view_tabs")
            <div class="tab-content border mt-2">
                <div class="tab-pane p-3 active show" id="navpill-1" role="tabpanel">
                    <div class=" w-100  overflow-hidden">
                        <div class="card-body p-3 px-md-4 pb-0">
                            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Registrations and Licences</h3>
                        </div>
                        <div class="card-body p-3 px-md-4">
                            <div class="col-md-12">
                                <div class="row">
                                    @if (!empty($licensesData))
                                        @if ($licensesData->ahpra_registration_status == "RN" || $licensesData->ahpra_registration_status == "RM" || $licensesData->ahpra_registration_status == "RN_RM" || $licensesData->ahpra_registration_status == "NP")
                                        <div class="col-md-12 mt-3">
                                            <div class="ahpra_details">
                                                <h5>
                                                    
                                                    @if ($licensesData->ahpra_registration_status == "RN")
                                                        Registered Nurse (RN)
                                                    @endif
                                                    @if ($licensesData->ahpra_registration_status == "RM")
                                                        Registered Midwife (RM)
                                                    @endif
                                                    @if ($licensesData->ahpra_registration_status == "RN_RM")
                                                        Registered Nurse and Midwife (RN/RM)
                                                    @endif
                                                    @if ($licensesData->ahpra_registration_status == "NP")
                                                        Nurse Practitioner (NP) (as endorsed under RN)
                                                    @endif
                                                </h5>
                                                <div class="row">
                                                    <div class="col-md-12 registration_no">
                                                        <strong>AHPRA Registration Number:</strong>
                                                        <span>{{ $licensesData->aphra_registration_no }}</span>
                                                    </div>
                                                </div><br>    
                                                <div class="ahpra_lookup_details">
                                                    <h5>Ahpra Lookup Details</h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Division:</strong>
                                                            <span>
                                                                @if ($licensesData->api_verify == "1")
                                                                    {{ $licensesData->register_division }}
                                                                @endif
                                                                @if ($licensesData->register_division == "RN")
                                                                    Registered Nurse (RN)
                                                                @endif
                                                                @if ($licensesData->register_division == "EN")
                                                                    Enrolled Nurse (EN)
                                                                @endif
                                                                @if ($licensesData->register_division == "RM")
                                                                    Registered Midwife (RM)
                                                                @endif
                                                                @if ($licensesData->register_division == "RN+RM")
                                                                    Registered Nurse and Midwife (RN+RM)
                                                                @endif
                                                            </span> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Endorsements:</strong>
                                                            <span>
                                                                @if ($licensesData->api_verify == "1")
                                                                    {{ $licensesData->register_endorsements }}
                                                                @endif
                                                                @if ($licensesData->register_endorsements == "NP")
                                                                    Nurse Practitioner (NP)
                                                                @endif
                                                                
                                                                @if ($licensesData->register_endorsements == "RIPRN")
                                                                    Scheduled Medicines – Midwife
                                                                @endif
                                                                @if ($licensesData->register_endorsements == "NP+Midwife")
                                                                    Scheduled Medicines – RN (Rural and Isolated Practice)
                                                                @endif
                                                                @if ($licensesData->register_endorsements == "IVs")
                                                                    Both NP and Endorsed Midwife
                                                                @endif
                                                                @if ($licensesData->register_endorsements == "meds")
                                                                    IV Endorsed - Enrolled Nurse (IVs)
                                                                @endif
                                                                @if ($licensesData->register_endorsements == "none")
                                                                    Medication Endorsed - Enrolled Nurse (meds)
                                                                @endif
                                                                @if ($licensesData->register_endorsements == "MidwifeMeds")
                                                                    No endorsed status
                                                                @endif
                                                            </span> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Registration Type:</strong>
                                                            <span>
                                                                {{ $licensesData->register_reg_type }}
                                                            </span> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Registration Status:</strong>
                                                            <span>
                                                                @if ($licensesData->register_reg_status == "Not registered")
                                                                    Not currently registered
                                                                @else
                                                                    {{ $licensesData->register_reg_status }}    
                                                                @endif
                                                            </span> 
                                                        </div>
                                                        @if ($licensesData->register_notations != NULL)
                                                        <div class="col-md-6">
                                                            <strong>Notations:</strong><br>
                                                            @if ($licensesData->api_verify == "1")
                                                                <span>{{ $licensesData->register_notations }}</span>
                                                            @endif
                                                            <?php
                                                                $notations = json_decode($licensesData->register_notations);
                                                                //print_r($notations);
                                                                $i = 1;
                                                            ?>
                                                            @if(!empty($notations))
                                                            @foreach ($notations as $nt)
                                                            <div class="notations">
                                                                
                                                                @if ($nt == "Other")
                                                                {{ $i }}. Other Notation- {{ $licensesData->register_other_notation_reason }}    
                                                                @else
                                                                {{ $i }}. {{ $nt }}
                                                                @endif
                                                            </div> 

                                                            <?php
                                                                $i++;
                                                            ?>                                                               
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                        @endif
                                                        @if ($licensesData->register_conditions != NULL)
                                                        <div class="col-md-6">
                                                            <strong>Conditions:</strong><br>
                                                            @if ($licensesData->api_verify == "1")
                                                                <span>{{ $licensesData->register_conditions }}</span>
                                                            @endif
                                                            <?php
                                                                $conditions = json_decode($licensesData->register_conditions);
                                                                //print_r($notations);
                                                                $i = 1;
                                                            ?>
                                                            @if(!empty($conditions))
                                                            @foreach ($conditions as $cond)
                                                            <div class="notations">
                                                               {{ $i }}. {{ $cond }}
                                                            </div> 

                                                            <?php
                                                                $i++;
                                                            ?>                                                               
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                        @endif
                                                        <div class="col-md-6">
                                                            <strong>Expiry:</strong><br>
                                                            <span>{{ $licensesData->register_expiry }}</span>
                                                             
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Principal Place of Practice:</strong><br>
                                                            <span>
                                                                @if ($licensesData->api_verify == "1")
                                                                    {{ $licensesData->register_conditions }}
                                                                @else
                                                                    {{ $licensesData->register_principal_place }}
                                                                @endif
                                                            </span>
                                                            
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Other Places of Practice:</strong><br>
                                                            <span>
                                                                <?php
                                                                    $other_place = json_decode($licensesData->register_other_place);
                                                                    //print_r($notations);
                                                                    $i = 1;
                                                                ?>
                                                                @if(!empty($other_place))
                                                                @foreach ($other_place as $place)
                                                                <div class="other_place">
                                                                    {{ $i }}. {{ $place }}
                                                                </div> 

                                                                <?php
                                                                    $i++;
                                                                ?>                                                               
                                                                @endforeach
                                                                @endif
                                                            </span>
                                                             
                                                        </div>
                                                        @if ($licensesData->register_upload_evidence != NULL)
                                                        <div class="col-md-6">
                                                            <strong>Evidence</strong>
                                                            <?php
                                                                $evidence = json_decode($licensesData->register_upload_evidence);
                                                                $i = 1;
                                                            ?>
                                                            <ul>
                                                            @foreach ($evidence as $evi)
                                                            <li>
                                                                
                                                                <a href="{{ url("/public") }}/uploads/education_degree/{{ $evi }}" target="_blank">
                                                                    <i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;{{ $evi }}
                                                                </a>
                                                            </li>    
                                                            <?php $i++; ?>
                                                            @endforeach
                                                            </ul>
                                                        </div>
                                                        @endif
                                                    </div><br>
                                                    <div class="form-group">
                                                    <label>
                                                        <input type="checkbox" id="isAdmin" @if($licensesData->ahpra_reverify == "1") checked @endif>&nbsp;&nbsp;Override the cooldown and force the Re-verify
                                                    </label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        @endif
                                        @if ($licensesData->ahpra_registration_status == "Graduate_RN" || $licensesData->ahpra_registration_status == "Graduate_RM" || $licensesData->ahpra_registration_status == "Student_Nurse" || $licensesData->ahpra_registration_status == "Student_Midwife")
                                        <div class="col-md-12 mt-3">
                                            <div class="graduate_details">
                                                <h5>
                                                    
                                                    @if ($licensesData->ahpra_registration_status == "Graduate_RN")
                                                        Graduate Nurse – Transitional Authorisation
                                                    @endif
                                                    @if ($licensesData->ahpra_registration_status == "Graduate_RM")
                                                        Graduate Midwife – Transitional Authorisation
                                                    @endif
                                                    @if ($licensesData->ahpra_registration_status == "Student_Nurse")
                                                        Student Nurse – AHPRA-registered (NMBA-approved course)
                                                    @endif
                                                    @if ($licensesData->ahpra_registration_status == "Student_Midwife")
                                                        Student Midwife – AHPRA-registered (NMBA-approved course)
                                                    @endif
                                                </h5>
                                                <div class="row">
                                                    <div class="col-md-12 registration_no">
                                                        <strong>AHPRA Registration Number:</strong>
                                                        <span>{{ $licensesData->graduate_student_reg_no }}</span>
                                                    </div>
                                                </div><br>    
                                                <div class="ahpra_lookup_details">
                                                    <h5>Ahpra Lookup Details</h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Division:</strong>
                                                            <span>
                                                                
                                                                @if ($licensesData->graduate_division == "RN")
                                                                    Registered Nurse (RN)
                                                                @endif
                                                                @if ($licensesData->graduate_division == "EN")
                                                                    Enrolled Nurse (EN)
                                                                @endif
                                                                @if ($licensesData->graduate_division == "RM")
                                                                    Registered Midwife (RM)
                                                                @endif
                                                                @if ($licensesData->graduate_division == "RN+RM")
                                                                    Registered Nurse and Midwife (RN+RM)
                                                                @endif
                                                            </span> 
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <strong>Registration Type:</strong>
                                                            <span>
                                                                @if ($licensesData->graduate_reg_type == "general")
                                                                    General
                                                                @endif
                                                                @if ($licensesData->graduate_reg_type == "limited")
                                                                    Limited
                                                                @endif
                                                                @if ($licensesData->graduate_reg_type == "provisional")
                                                                    Provisional
                                                                @endif
                                                                @if ($licensesData->graduate_reg_type == "student_nurse")
                                                                    Student Nurse
                                                                @endif
                                                                @if ($licensesData->graduate_reg_type == "student_midwife")
                                                                    Student Midwife
                                                                @endif
                                                                @if ($licensesData->graduate_reg_type == "non_practising")
                                                                    Non-practising
                                                                @endif
                                                            </span> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Registration Status:</strong>
                                                            <span>
                                                                @if ($licensesData->graduate_reg_status == "current")
                                                                    Current
                                                                @endif
                                                                @if ($licensesData->graduate_reg_status == "suspended")
                                                                    Suspended
                                                                @endif
                                                                @if ($licensesData->graduate_reg_status == "cancelled")
                                                                    Cancelled
                                                                @endif
                                                                @if ($licensesData->graduate_reg_status == "inactive")
                                                                    Inactive
                                                                @endif
                                                                @if ($licensesData->graduate_reg_status == "ineligible")
                                                                    Ineligible
                                                                @endif
                                                                @if ($licensesData->graduate_reg_status == "lapsed")
                                                                    Lapsed
                                                                @endif
                                                                @if ($licensesData->graduate_reg_status == "expired")
                                                                    Expired
                                                                @endif
                                                                @if ($licensesData->graduate_reg_status == "not_registered")
                                                                    Not currently registered
                                                                @endif
                                                            </span> 
                                                        </div>
                                                        @if ($licensesData->graduation_date != NULL)
                                                        <div class="col-md-6">
                                                            <strong>Graduation Date:</strong>
                                                            <span>{{ $licensesData->graduation_date }}</span>
                                                        </div>
                                                        @endif
                                                        @if ($licensesData->graduation_upload_evidence != NULL)
                                                        <div class="col-md-6">
                                                            <strong>Evidence</strong>
                                                            <?php
                                                                $evidence = json_decode($licensesData->graduation_upload_evidence);
                                                                $i = 1;
                                                            ?>
                                                            <ul>
                                                            @foreach ($evidence as $evi)
                                                            <li>
                                                                
                                                                <a href="{{ url("/public") }}/uploads/education_degree/{{ $evi }}" target="_blank">
                                                                    <i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;{{ $evi }}
                                                                </a>
                                                            </li>    
                                                            <?php $i++; ?>
                                                            @endforeach
                                                            </ul>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                        @endif    
                                        @if ($licensesData->ahpra_registration_status == "Overseas")
                                        <div class="col-md-12 mt-3">
                                            <div class="graduate_details">
                                                <h5>Overseas-Qualified Nurses and Midwives not currently registered with AHPRA</h5>
                                                <div class="col-md-12 mt-3">
                                                    
                                                    <span>
                                                        <?php
                                                            $overseas = json_decode($licensesData->overseas_qualified_specify);
                                                            //print_r($notations);
                                                            $i = 1;
                                                        ?>
                                                        @foreach ($overseas as $over_seas)
                                                        <div class="other_place">
                                                            {{ $i }}. 
                                                            @if ($over_seas == "recently_migrated")
                                                                I recently migrated to Australia and am preparing to apply for AHPRA
                                                            @endif
                                                            @if ($over_seas == "aphra_app")
                                                                I have submitted my AHPRA application and am awaiting outcome
                                                            @endif
                                                            @if ($over_seas == "aphra_assessment")
                                                                I am preparing documentation for AHPRA assessment
                                                            @endif
                                                            @if ($over_seas == "aphra_bridge")
                                                                I am studying to meet AHPRA bridging/re-entry requirements
                                                            @endif
                                                            @if ($over_seas == "other")
                                                                Other:- {{ $licensesData->other_overseas_qualified }}
                                                            @endif
                                                        </div> 

                                                        <?php
                                                            $i++;
                                                        ?>                                                               
                                                        @endforeach
                                                    </span>
                                                </div><br>        
                                                @if ($licensesData->overseas_upload_evidence != NULL)
                                                    <div class="col-md-6">
                                                        <strong>Evidence</strong>
                                                        <?php
                                                            $evidence = json_decode($licensesData->overseas_upload_evidence);
                                                            $i = 1;
                                                        ?>
                                                        <ul>
                                                        @foreach ($evidence as $evi)
                                                        <li>
                                                            
                                                            <a href="{{ url("/public") }}/uploads/education_degree/{{ $evi }}" target="_blank">
                                                                <i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;{{ $evi }}
                                                            </a>
                                                        </li>    
                                                        <?php $i++; ?>
                                                        @endforeach
                                                        </ul>
                                                    </div>
                                                    @endif    
                                            </div>    
                                        </div>
                                        @endif
                                        @if ($licensesData->ahpra_registration_status == "Not_Registered")
                                        <div class="col-md-12 mt-3">
                                            <div class="graduate_details">
                                                <h5>Not currently registered with AHPRA</h5>
                                                <?php
                                                    $not_registered = json_decode($licensesData->not_currently_registered_reason);
                                                    $i = 1;
                                                ?>
                                                <ul>
                                                @foreach ($not_registered as $nt)
                                                    <li>{{ $i }}. 
                                                        @if ($nt == "education_related")
                                                            Education-Related Reasons
                                                        @endif
                                                        @if ($nt == "returning_practice")
                                                            Returning to Practice
                                                        @endif
                                                        @if ($nt == "personal_career")
                                                            Personal or Career Reasons
                                                        @endif
                                                        @if ($nt == "other")
                                                            Other:- {{ $licensesData->other_not_registered_reason }}
                                                        @endif
                                                    </li>
                                                    <?php
                                                        $i++;
                                                    ?>
                                                @endforeach
                                                </ul>
                                            </div>
                                        </div>   
                                        @if ($licensesData->education_related_reason != "null")
                                        <div class="col-md-12 mt-3">
                                            <div class="graduate_details">
                                                <h5>Education-Related Reasons:</h5>
                                                <?php
                                                    $education_related_reason = json_decode($licensesData->education_related_reason);
                                                    $i = 1;
                                                ?>
                                                <ul>
                                                @foreach ($education_related_reason as $nt)
                                                    <li>{{ $i }}. 
                                                        @if ($nt == "startProgram")
                                                            I am about to begin an AHPRA-approved nursing/midwifery program
                                                        @endif
                                                        @if ($nt == "waitingAssessment")
                                                            I have completed my studies and am waiting for AHPRA assessment
                                                        @endif
                                                        @if ($nt == "studiedOutside")
                                                            I completed my studies outside Australia and have not applied yet
                                                        @endif
                                                        @if ($nt == "didNotComplete")
                                                            I did not complete my nursing/midwifery qualification
                                                        @endif
                                                    </li>
                                                    <?php
                                                        $i++;
                                                    ?>
                                                @endforeach
                                                </ul>
                                            </div>
                                        </div>    
                                        @endif 
                                        @if ($licensesData->returning_practice != "null")
                                        <div class="col-md-12 mt-3">
                                            <div class="graduate_details">
                                                <h5>Returning to Practice:</h5>
                                                <?php
                                                    $returning_practice = json_decode($licensesData->returning_practice);
                                                    $i = 1;
                                                ?>
                                                <ul>
                                                @foreach ($returning_practice as $nt)
                                                    <li>{{ $i }}. 
                                                        @if ($nt == "lapsed")
                                                            I previously held registration but let it lapse
                                                        @endif
                                                        @if ($nt == "reentryProgram")
                                                            I am currently completing a re-entry to practice program
                                                        @endif
                                                        @if ($nt == "waitingPlacement")
                                                            I am waiting for supervised practice placement approval
                                                        @endif
                                                        @if ($nt == "nonPractisingToGeneral")
                                                            I am transitioning from non-practising to general registration
                                                        @endif
                                                    </li>
                                                    <?php
                                                        $i++;
                                                    ?>
                                                @endforeach
                                                </ul>
                                            </div>
                                        </div>    
                                        @endif 
                                        @if ($licensesData->personal_career != "null")
                                        <div class="col-md-12 mt-3">
                                            <div class="graduate_details">
                                                <h5>Personal or Career Reasons:</h5>
                                                <?php
                                                    $personal_career = json_decode($licensesData->personal_career);
                                                    $i = 1;
                                                ?>
                                                <ul>
                                                @foreach ($personal_career as $nt)
                                                    <li>{{ $i }}. 
                                                        @if ($nt == "maternityLeave")
                                                            On maternity or extended personal leave
                                                        @endif
                                                        @if ($nt == "careerBreak")
                                                            Taking a career break
                                                        @endif
                                                        @if ($nt == "nonClinical")
                                                            Working in a non-clinical healthcare role (e.g. admin, education)
                                                        @endif
                                                        @if ($nt == "overseasPractice")
                                                            Practising in another country
                                                        @endif
                                                        @if ($nt == "nonHealth")
                                                            Working in a non-healthcare sector
                                                        @endif
                                                        @if ($nt == "notReturning")
                                                            I do not intend to practise again
                                                        @endif
                                                    </li>
                                                    <?php
                                                        $i++;
                                                    ?>
                                                @endforeach
                                                </ul>
                                               
                                            </div>
                                        </div>    
                                        @endif 
                                        @if ($licensesData->personal_career != "null")
                                        <div class="col-md-12 mt-3">
                                            <div class="graduate_details">
                                                <h5>Other Reason</h5>
                                                <?php
                                                    echo $other_not_registered_reason = $licensesData->other_not_registered_reason;
                                                    
                                                ?>
                                                
                                            </div>
                                        </div>    
                                        @endif 
                                         @if ($licensesData->not_registered_evidence_file != NULL)
                                            <div class="col-md-6 mt-3">
                                                <h5>Evidence</h5>
                                                <?php
                                                    $evidence = json_decode($licensesData->not_registered_evidence_file);
                                                    $i = 1;
                                                ?>
                                                <ul>
                                                @foreach ($evidence as $evi)
                                                <li>
                                                    
                                                    <a href="{{ url("/public") }}/uploads/education_degree/{{ $evi }}" target="_blank">
                                                        <i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;{{ $evi }}
                                                    </a>
                                                </li>    
                                                <?php $i++; ?>
                                                @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                        @endif
                                        
                                    
                                    
                                    <div class="col-md-12 mt-3">
                                        <div class="ndis_details">
                                            <h5>NDIS</h5>
                                            <div class="ndis_detail_block">
                                                <strong>NDIS status:</strong>
                                                <span>
                                                    <?php
                                                        $ndis_status = $licensesData->ndis_status;    
                                                    ?>
                                                    @if ($ndis_status == "registered")
                                                        I am an NDIS-registered provider
                                                    @endif
                                                    @if ($ndis_status == "compliant")
                                                        I am NDIS-compliant, but not registered
                                                    @endif
                                                    @if ($ndis_status == "not_compliant")
                                                        I am not NDIS-compliant
                                                    @endif
                                                </span>
                                            </div>
                                            @if ($ndis_status == "registered")
                                            <div class="ndis_registered_provider mt-1">
                                                <div class="ndis_number">
                                                    <strong>NDIS Registration Number:</strong>
                                                    <span>{{ $licensesData->ndis_registration_no }}</span>
                                                </div>
                                                <div class="ndis_evidence mt-1">
                                                    <strong>Evidence:</strong>
                                                    <?php
                                                        $i = 1;
                                                        $evidence = json_decode($licensesData->ndis_registration_evidence);
                                                    ?>
                                                    <ul>
                                                        @foreach ($evidence as $evi)
                                                        <li>
                                                            
                                                            <a href="{{ url("/public") }}/uploads/education_degree/{{ $evi }}" target="_blank">
                                                                <i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;{{ $evi }}
                                                            </a>
                                                        </li>    
                                                        <?php $i++; ?>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif
                                            
                                        </div>
                                    </div>        
                                    <div class="col-md-12 mt-3">
                                        @if ($licensesData->medical_provider_no != NULL)
                                        <div class="ndis_registered_provider mt-1">
                                            <h5>Medicare Provider</h5>
                                            <div class="ndis_number">
                                                <strong>Medicare Provider Number:</strong>
                                                <span>{{ $licensesData->medical_provider_no }}</span>
                                            </div>
                                            <div class="ndis_evidence mt-1">
                                                <strong>Evidence:</strong>
                                                <?php
                                                    $i = 1;
                                                    $evidence = json_decode($licensesData->medical_upload_evidence);
                                                ?>
                                                <ul>
                                                    @foreach ($evidence as $evi)
                                                    <li>
                                                        
                                                        <a href="{{ url("/public") }}/uploads/education_degree/{{ $evi }}" target="_blank">
                                                            <i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;{{ $evi }}
                                                        </a>
                                                    </li>    
                                                    <?php $i++; ?>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        @if ($licensesData->pbs_type != NULL)
                                        <div class="ndis_registered_provider mt-1">
                                            <h5>PBS Prescriber</h5>
                                            <div class="ndis_number">
                                                <strong>Prescriber Type:</strong>
                                                <?php
                                                    $pbs_type = $licensesData->pbs_type;
                                                ?>
                                                <span>
                                                    @if ($pbs_type == "nurse_prac")
                                                        Nurse Practitioner (NP)
                                                    @endif
                                                    @if ($pbs_type == "eligible_midwife")
                                                        Eligible Midwife
                                                    @endif
                                                    @if ($pbs_type == "endorsed_midwife")
                                                        Endorsed Midwife – Scheduled Medicines
                                                    @endif
                                                    @if ($pbs_type == "prescriber_under")
                                                        Prescriber under Collaborative Arrangement (under a doctor for PBS access)
                                                    @endif
                                                    @if ($pbs_type == "other_nursing")
                                                        Other (nursing/midwifery-specific role)
                                                    @endif
                                                    
                                                </span>
                                            </div>
                                            @if ($licensesData->pbs_type == "other_nursing")
                                            <div class="ndis_number mt-1">
                                                <strong>Other (nursing/midwifery-specific role):</strong>
                                                <span>{{ $licensesData->pbs_other_nursing }}</span>
                                            </div>
                                            @endif
                                            <div class="ndis_number mt-1">
                                                <strong>Prescriber Number:</strong>
                                                <span>{{ $licensesData->prescribe_no }}</span>
                                            </div>
                                            <div class="ndis_evidence mt-1">
                                                <strong>Evidence:</strong>
                                                <?php
                                                    $i = 1;
                                                    $evidence = json_decode($licensesData->prescribe_evidence);
                                                ?>
                                                <ul>
                                                    @foreach ($evidence as $evi)
                                                    <li>
                                                        
                                                        <a href="{{ url("/public") }}/uploads/education_degree/{{ $evi }}" target="_blank">
                                                            <i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;{{ $evi }}
                                                        </a>
                                                    </li>    
                                                    <?php $i++; ?>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        @if ($licensesData->authorizing_body_program != NULL)
                                        <div class="ndis_registered_provider mt-1">
                                            <h5>Immunisation Provider</h5>
                                            <?php
                                                $immunization_state_data = (array)json_decode($licensesData->immunization_state);
                                                $authorizing_body = (array)json_decode($licensesData->authorizing_body_program);
                                            ?>
                                            <div class="row">
                                            @foreach ($immunization_state_data as $imstate)
                                            <div class="state_data col-md-6">
                                                <div class="state_data_block">
                                                    <strong>State of Authorisation:</strong>
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
                                                    <span>{{ $state_name }}</span>
                                                </div>
                                                <div class="state_data_block mt-1">
                                                    <strong>Authorising Body or Program:</strong>
                                                    <span>@if(isset($authorizing_body[$imstate])){{ $imstate }}@endif</span>
                                                </div>
                                                <div class="state_data_block mt-1">
                                                    <strong>Date Authorised:</strong>
                                                    <span>@if(isset($authorizing_body[$imstate])){{ $authorizing_body[$imstate]->date_authorized }}@endif</span>
                                                </div>
                                                <div class="ndis_evidence mt-1">
                                                    <strong>Evidence:</strong>
                                                    @if(isset($authorizing_body[$imstate]) && $authorizing_body[$imstate]->evidence != NULL)
                                                    <?php
                                                        $i = 1;
                                                        $evidence = json_decode($authorizing_body[$imstate]->evidence);
                                                    ?>
                                                    <ul>
                                                        @foreach ($evidence as $evi)
                                                        <li>
                                                            
                                                            <a href="{{ url("/public") }}/uploads/education_degree/{{ $evi }}" target="_blank">
                                                                <i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;{{ $evi }}
                                                            </a>
                                                        </li>    
                                                        <?php $i++; ?>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        @if ($licensesData->radiation_licence_type != "null")
                                        <div class="ndis_registered_provider mt-1">
                                            <h5>Radiation Use Licence</h5>
                                            <?php
                               
                                            if(!empty($licensesData) && $licensesData->radiation_licence_type != NULL){
                                                $radiation_licence_type = json_decode($licensesData->radiation_licence_type);
                                                $radiation_licenses_no = (array)json_decode($licensesData->radiation_licenses_no);
                                                
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
                                            <div class="row">
                                            @foreach($radiation_licence_type as $licence_type)
                                            <div class="state_data col-md-6">
                                                <div class="state_data_block">
                                                    <strong>Licence Type:</strong>
                                                    <?php
                                                        $licence_name = $licenses_array[$licence_type];
                                                    ?>
                                                    <span>{{ $licence_name }}</span>
                                                </div>    
                                                @if($licence_type == "other")
                                                <div class="state_data_block mt-1">
                                                    <strong>Other Licence Type:</strong>
                                                    <span>{{ $licensesData->licenses_type_other }}</span>
                                                </div>    
                                                @endif
                                                <div class="state_data_block mt-1">
                                                    <strong>Licence Number:</strong>
                                                    <span>@if(!empty($licensesData) && isset($radiation_licenses_no['other'])){{ $radiation_licenses_no['other']->radiation_licenses_no }}@endif</span>
                                                </div> 
                                                
                                                <div class="state_data_block mt-1">
                                                    <strong>State of Issue:</strong>
                                                    @if(isset($radiation_licenses_no['other']->state_issue))
                                                    <?php
                                                        
                                                        $state_issue = $radiation_licenses_no['other']->state_issue;
                                                        //print_r($state_issue);
                                                        $i = 1;
                                                    ?>
                                                    <ul>
                                                        @foreach ($state_issue as $st)
                                                            <li>{{ $i }}. 
                                                                @if ($st == "NSW")
                                                                    New South Wales (NSW)
                                                                @endif
                                                                @if ($st == "VIC")
                                                                    Victoria (VIC)
                                                                @endif
                                                                @if ($st == "QLD")
                                                                    Queensland (QLD)
                                                                @endif
                                                                @if ($st == "WA")
                                                                    Western Australia (WA)
                                                                @endif
                                                                @if ($st == "SA")
                                                                    South Australia (SA)
                                                                @endif
                                                                @if ($st == "TAS")
                                                                    Tasmania (TAS)
                                                                @endif
                                                                @if ($st == "ACT")
                                                                    Australian Capital Territory (ACT)
                                                                @endif
                                                                @if ($st == "NT")
                                                                    Northern Territory (NT)
                                                                @endif
                                                            </li>
                                                            <?php
                                                                $i++;
                                                            ?>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </div> 
                                                <div class="state_data_block mt-1">
                                                    <strong>Licensing Body:</strong>
                                                    @if(isset($radiation_licenses_no['other']->licence_body))
                                                    <?php
                                                        $licensing_body = $radiation_licenses_no['other']->licence_body;
                                                        //print_r($state_issue);
                                                        $i = 1;
                                                    ?>
                                                    <ul>
                                                        @foreach ($licensing_body as $l_body)
                                                            <li>{{ $i }}. 
                                                                @if ($l_body == "environment_protection")
                                                                    EPA NSW – Environment Protection Authority
                                                                @endif
                                                                @if ($l_body == "radiation_safety")
                                                                    Department of Health – Radiation Safety
                                                                @endif
                                                                @if ($l_body == "radiation_health")
                                                                    Queensland Health – Radiation Health
                                                                @endif
                                                                @if ($l_body == "radiation_protection")
                                                                    SA EPA – Radiation Protection
                                                                @endif
                                                                @if ($l_body == "radiological_council")
                                                                    Radiological Council of WA
                                                                @endif
                                                                @if ($l_body == "health_department")
                                                                    Radiation Protection Unit – Department of Health
                                                                @endif
                                                                @if ($l_body == "health_nt")
                                                                    Department of Health NT Radiation Safety
                                                                @endif
                                                                @if ($l_body == "health_protection")
                                                                    Health Protection Service
                                                                @endif
                                                            </li>
                                                            <?php
                                                                $i++;
                                                            ?>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </div> 
                                                <div class="state_data_block">
                                                    <strong>Issue Date:</strong>
                                                    <span>@if(!empty($licensesData) && isset($radiation_licenses_no['other'])){{ $radiation_licenses_no['other']->radiation_issue_date }}@endif</span>
                                                </div> 
                                                <div class="state_data_block mt-1">
                                                    <strong>Expiry Date:</strong>
                                                    <span>@if(!empty($licensesData) && isset($radiation_licenses_no['other'])){{ $radiation_licenses_no['other']->radiation_expiry_date }}@endif</span>
                                                </div> 
                                                <div class="ndis_evidence mt-1">
                                                    <strong>Evidence:</strong>
                                                    @if(isset($radiation_licenses_no['other']) && $radiation_licenses_no['other']->evidence != NULL)
                                                    <?php
                                                        $i = 1;
                                                        $evidence = (array)json_decode($radiation_licenses_no['other']->evidence);
                                                        
                                                    ?>
                                                    <ul>
                                                        @foreach ($evidence as $evi)
                                                        <li>
                                                            
                                                            <a href="{{ url("/public") }}/uploads/education_degree/{{ $evi }}" target="_blank">
                                                                <i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;{{ $evi }}
                                                            </a>
                                                        </li>    
                                                        <?php $i++; ?>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </div>
                                            </div>    
                                            @endforeach
                                            </div>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $('#isAdmin').click(function(){
        if ($('#isAdmin').prop('checked')) {
            $.ajax({
                url: "{{ route('admin.ahpra_reverify') }}",  // or Laravel route
                type: 'POST',                  // or 'GET'
                data: {
                    ahpra_reverify: '1',
                    user_id: '{{ $licensesData->user_id }}',
                    _token:"{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log('Success:', response);
                    // You can update the DOM here
                    
                }
            });
        } else {
            $.ajax({
                url: "{{ route('admin.ahpra_reverify') }}",  // or Laravel route
                type: 'POST',                  // or 'GET'
                data: {
                    ahpra_reverify: '0',
                    user_id: '{{ $licensesData->user_id }}',
                    _token:"{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log('Success:', response);
                    // You can update the DOM here
                    
                }
            });
        }
    });
    
</script>
@endsection