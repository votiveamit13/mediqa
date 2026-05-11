@extends('admin.layouts.layout')
@section('content')
<style>
    h6 {
        font-family: "Plus Jakarta Sans", sans-serif;
        font-style: normal;
        font-weight: 700;
        font-size: 16px;
        line-height: 26px;
        color: #000000;
    }

    .dropdown-list {
        background-color: white;
        color: white;
        max-height: 200px;
        /* Adjust the height as needed */
        overflow-y: auto;
        /* Add scrollbar if content overflows */
        padding: 0;
        list-style: none;
        margin: 0;
        border: 1px solid #f1f1f1;
        border-radius: 4px;
        background-color: #ffffff;
        padding: 11px 15px 13px 15px;
        width: 100%;
        color: #A0ABB8;

    }

    .dropdown-item-custom {
        padding: 10px;
        /* Add padding to list items */
        color: black;
        text-decoration: none;
        display: block;
    }

    .dropdown-item-custom:hover {
        background-color: white;
        /* Change the hover background color */
    }

    .vacc_rec_div {
        padding: 20px;
        width: 97%;
        margin: auto;
        margin-top: 20px;
        margin-bottom: 0;
    }

    .vacc_rec_div .record_v {
        border-bottom: solid 1px #80808045;
        margin-bottom: 15px;
    }

    .vacc_rec_div .record_v h6 {
        margin-bottom: 0px;
    }

    .vaccine-section {
        padding: 20px;
        width: 97%;
        margin: auto;
        padding-top: 0px;
        border-bottom: solid 1px #80808045;
        margin-bottom: 15px;
    }

    h6.other-vaccin {
        font-size: 18px;
    }
</style>

<div class="container-fluid">
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
            <ul class="nav nav-pills nav-fill mt-4 tabs-feat" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#navpill-1" role="tab"
                        aria-selected="true">
                        <span>Basic Details</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-2" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Professional Information</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-3" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Education and Certifications</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-4" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Experience</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-4.1" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>References</span>
                    </a>
                </li>
                {{-- <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-5" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Financial Details</span>
                        </a>
                    </li> --}}
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-5" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Mandatory Training</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-6" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Vaccinations</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-7" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Work Clearances</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-8" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Professional Memberships</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-9" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Interview and References</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-10" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Personal Preferences</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-11" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span>Find Work Preferences</span>
                    </a>
                </li>
            </ul>
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
                                        @if($profileData->date_of_birth && $profileData->gender && $profileData->state && $profileData->city
                                        && $profileData->personal_website && $profileData->home_address && $profileData->emergency_conact_numeber)
                                        @if($profileData->date_of_birth)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                {{-- <strong>Do you have work rights in Austrailia? : </strong>
                                                    <span>{{ $profileData->work_right == 0 ? 'No' : 'Yes' }}</span> --}}
                                                <strong>Date of Birth : </strong>
                                                <span>{{ \Carbon\Carbon::parse($profileData->date_of_birth)->format('d/m/Y') }}</span>
                                            </div>
                                        </div>
                                        @endif
                                        @if($profileData->gender)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <!-- specialty_name_by_id -->
                                                <strong>Gender: </strong><span>{{ $profileData->gender }}</span>
                                            </div>
                                        </div>
                                        @endif
                                        {{-- <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Nationality: </strong>
                                                    <!-- specialty_name_by_id -->
                                                   <span> - - -  </span>
                                                </div>
                                            </div> --}}


                                        {{-- <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong> Home Address : </strong> <span> - - -  </span>
                                                </div>
                                            </div> --}}

                                        @if($profileData->state)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong> State : </strong> <span>{{ state_name($profileData->state)}}</span>
                                            </div>
                                        </div>
                                        @endif
                                        @if($profileData->city)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong> City : </strong> <span>{{ $profileData->city }}</span>
                                            </div>
                                        </div>
                                        @endif
                                        @if($profileData->personal_website)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong> Personal website : </strong> <span>{{ $profileData->personal_website }}</span>
                                            </div>
                                        </div>
                                        @endif
                                        @if($profileData->home_address)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>Home Address : </strong> <span>{{ $profileData->home_address }}</span>
                                            </div>
                                        </div>
                                        @endif
                                        {{-- @if($profileData->bio)
                                                <div class="col-md-12 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Bio   : </strong> <span>{{ $profileData->bio }}</span>
                                    </div>
                                </div>
                                @endif --}}
                                <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center  mt-3">Emergency Contact Information : </h4>
                                @if($profileData->emergency_conact_numeber)
                                <div class="col-md-6 mt-3">
                                    <div class="d-flex gap-3 flex-wrap">
                                        <strong>Mobile No :</strong> <span>
                                            +{{ $profileData->emegency_country_code }}{{ " "}}
                                            {{ $profileData->emergency_conact_numeber }}
                                        </span>
                                    </div>
                                </div>
                                @endif
                                @if($profileData->emergergency_contact_email)
                                <div class="col-md-6 mt-3">
                                    <div class="d-flex gap-3 flex-wrap">
                                        <strong>Email :</strong> <span>
                                            {{ $profileData->emergergency_contact_email }}
                                        </span>
                                    </div>
                                </div>
                                @endif


                                {{-- @if ($profileData->specialty != 'null')
                                                @php $subspecialty=json_decode($profileData->specialty); @endphp
                                                @if (is_array($subspecialty))
                                                    <div class="col-md-12 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong> Specialty : </strong>
                                                            @forelse($subspecialty as $key => $ubspecialty)
                                                            <span>{{ practitioner_type_by_id($ubspecialty) }} , </span>@empty
                                @endforelse
                            </div>
                        </div>
                        @endif
                        @endif --}}
                        @else
                        <div class="col-md-12">
                            <div class="text-center text-danger fs-5">No data found</div>
                        </div>

                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<div class="tab-pane p-3" id="navpill-2" role="tabpanel">
    <div class="row">
        <div class=" w-100  overflow-hidden">
            <div class="card-body p-3 px-md-4 pb-0">
                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Professional Information
                </h3>
            </div>
            <div class="card-body p-3 px-md-4">
                <div class="col-md-12">

                    @if($profileData->nurseType && $profileData->specialties)
                    <div class="row">

                        @if ($profileData->nurseType != 'null')
                        @php $nurseType=json_decode($profileData->nurseType); @endphp
                        @if (is_array($nurseType))
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Profession : </strong>
                                <ul class="dropdown-list">
                                    @forelse($nurseType as $key => $ubspecialty)
                                    <li><span class="dropdown-item-custom">{{ specialty_name_by_id_NEW($ubspecialty) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No specialties available</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif
                        @endif
                        @if ($profileData->nurseType != 'null')
                        @php
                        $nurseType = json_decode($profileData->nurseType);

                        // Ensure $nurseType is an array
                        $nurseType = is_array($nurseType) ? $nurseType : [];
                        $nursepra = [];

                        @endphp

                        @foreach($nurseType as $key => $ubspecialty)
                        @php

                        $specialtyName = specialty_name_by_id_NEW($ubspecialty);

                        $normalizedSpecialty = strtolower(str_replace('_', ' ', $specialtyName));

                        // Define strings to compare
                        $string1 = 'entry level nursing';
                        $string2 = 'registered nurses';
                        $string3 = 'advanced practitioner';

                        // Extract words from normalized specialty
                        $words = explode(' ', $normalizedSpecialty);
                        $firstWord = isset($words[0]) ? strtolower($words[0]) : '';
                        $secondWord = isset($words[1]) ? strtolower($words[1]) : '';
                        $firstTwoWords = $firstWord . ' ' . $secondWord;

                        // Determine the correct nurse sub-job type
                        if ($normalizedSpecialty === $string1) {
                        $nursesubjobType = json_decode($profileData->entry_level_nursing);

                        } elseif ($firstTwoWords === strtolower($string2)) {
                        $nursesubjobType = json_decode($profileData->registered_nurses);
                        } elseif ($firstWord === 'advanced') {
                        $nursepra = $profileData->advanced_practioner;
                        $nursesubjobType = json_decode($profileData->advanced_practioner);
                        } else {
                        $nursesubjobType = json_decode($profileData->advanced_practioner); // Default case
                        }

                        // Ensure $nursesubjobType is an array
                        $nursesubjobType = is_array($nursesubjobType) ? $nursesubjobType : [];
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>{{ $specialtyName }}:</strong>

                                {{-- @forelse($nursesubjobType as $key => $subtype)
                                <span>{{ specialty_name_by_id($subtype) }} ,</span>
                                @empty
                                <span>No sub-job types found</span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($nursesubjobType as $key => $subtype)

                                    <li><span class="dropdown-item-custom">{{ specialty_name_by_id_NEW($subtype) }} , </span></li>

                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endforeach
                        @endif

                        <?php
                        // Decode the JSON strings to associative arrays
                        // $nursepraArray = json_decode($nursepra, true); // `true` to return an associative array
                        $nursepraArray = is_string($nursepra) ? json_decode($nursepra, true) : (is_array($nursepra) ? $nursepra : []);

                        // Ensure $profileData is not null and has the required properties
                        $profileData = $profileData ?? new stdClass();
                        // $nurse_prac = isset($profileData->nurse_prac) ? json_decode($profileData->nurse_prac, true) : [];
                        $nurse_prac = isset($profileData->nurse_prac)
                            ? (is_string($profileData->nurse_prac)
                                ? json_decode($profileData->nurse_prac, true)
                                : (is_array($profileData->nurse_prac)
                                    ? $profileData->nurse_prac
                                    : []))
                            : [];
                        ?>

                        @if(is_array($nursepraArray) && in_array(179, $nursepraArray))
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Nurse Practitioner (NP) : </strong>
                                {{-- @forelse($nurse_prac as $key => $ubspecialty)
                                                        <span>{{ specialty_name_by_id_NEW($ubspecialty) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}

                                <ul class="dropdown-list">
                                    @forelse($nurse_prac as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ specialty_name_by_id_NEW($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif

                        @if ($profileData->specialties != 'null')
                        @php $specialties=json_decode($profileData->specialties); @endphp
                        @if (is_array($specialties))
                        <div class="col-md-12 mt-4">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Specialties : </strong>
                                {{-- @forelse($specialties as $key => $ubspecialty)
                                                            <span>{{ practitioner_type_by_id($ubspecialty) }} , </span>@empty
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($specialties as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif
                        @endif

                        @if ($profileData->specialties != 'null')
                        @php
                        $specialties = json_decode($profileData->specialties);

                        // Ensure $nurseType is an array
                        $specialties = is_array($specialties) ? $specialties : [];
                        $surgical_preoperative = [];
                        $surgical_obstrics_gynacology = [];
                        $neonatal_care = [];
                        $paedia_surgical_preoperative = [];
                        $i= 1;
                        @endphp

                        @foreach($specialties as $key => $ubspecialty)
                        @php

                        $specialtyName = practitioner_type_by_id($ubspecialty);

                        $normalizedSpecialty = strtolower(str_replace('_', ' ', $specialtyName));

                        // Define strings to compare
                        $string1 = 'adults';
                        $string2 = 'maternity';
                        $string3 = 'paediatrics neonatal';
                        $string4 = 'community';

                        // Extract words from normalized specialty
                        $words = explode(' ', $normalizedSpecialty);
                        $firstWord = isset($words[0]) ? strtolower($words[0]) : '';
                        $secondWord = isset($words[1]) ? strtolower($words[1]) : '';
                        $firstTwoWords = $firstWord . ' ' . $secondWord;

                        // Determine the correct nurse sub-job type
                        if ($normalizedSpecialty === $string1) {
                        $surgical_preoperative = $profileData->adults;
                        $specsubType = json_decode($profileData->adults);
                        } elseif ($firstWord === strtolower($string2)) {
                        $surgical_obstrics_gynacology = $profileData->maternity;
                        $specsubType = json_decode($profileData->maternity);
                        } elseif ($firstTwoWords === strtolower($string3)) {
                        $neonatal_care = $profileData->paediatrics_neonatal;
                        $paedia_surgical_preoperative = $profileData->paediatrics_neonatal;
                        $specsubType = json_decode($profileData->paediatrics_neonatal);
                        } elseif ($firstWord === strtolower($string4)) {


                        $specsubType = json_decode($profileData->community);
                        }else {
                        $specsubType = json_decode($profileData->community); // Default case
                        }

                        // Ensure $nursesubjobType is an array
                        $specsubType = is_array($specsubType) ? $specsubType : [];
                        @endphp

                        <div class="col-md-12 mt-4" id="cat_{{ $i}}">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>{{ $specialtyName }}:</strong>

                                {{-- @forelse($specsubType as $key => $subtype)

                                   <span>{{ practitioner_type_by_id($subtype) ;}} ,</span>
                                @empty
                                <span></span>
                                @endforelse --}}

                                <ul class="dropdown-list">
                                    @forelse($specsubType as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>

                            </div>
                        </div>
                        <?php $i++; ?>
                        @endforeach

                        @endif

                        <?php


                        $surgicalArray = is_string($surgical_preoperative) ? json_decode($surgical_preoperative, true) : (is_array($surgical_preoperative) ? $surgical_preoperative : []);

                        $profileData = $profileData ?? new stdClass();
                        $sargicaldata = isset($profileData->surgical_preoperative) ? json_decode($profileData->surgical_preoperative, true) : [];
                        $operating_room = isset($profileData->operating_room) ? json_decode($profileData->operating_room, true) : [];
                        $operating_room_scout = isset($profileData->operating_room_scout) ? json_decode($profileData->operating_room_scout, true) : [];
                        $operating_room_scrub = isset($profileData->operating_room_scrub) ? json_decode($profileData->operating_room_scrub, true) : [];
                        ?>

                        @if(is_array($surgicalArray) && in_array(96, $surgicalArray))
                        <div class="col-md-12 mt-3" id="sugical_care">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Surgical Preoperative and Postoperative Care : </strong>
                                {{-- @forelse($sargicaldata as $key => $ubspecialty)
                                                        <span>{{ practitioner_type_by_id($ubspecialty) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}

                                <ul class="dropdown-list">
                                    @forelse($sargicaldata as $key => $ubspecialty)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($ubspecialty) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3" id="Operating_Room">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Operating Room (OR) : </strong>
                                {{-- @forelse($operating_room as $key => $operating_rooms)
                                                        <span>{{ practitioner_type_by_id($operating_rooms) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($operating_room as $key => $operating_rooms)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($operating_rooms) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3" id="paediatric_oR">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Paediatric OR: Scout (Circulating Nurse) : </strong>
                                {{-- @forelse($operating_room_scout as $key => $operating_room_scouts)
                                                        <span>{{ practitioner_type_by_id($operating_room_scouts) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($operating_room_scout as $key => $operating_room_scouts)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($operating_room_scouts) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap" id="Technician_Nurse">
                                <strong> Paediatric OR: Scrub (Technician Nurse) : </strong>
                                {{-- @forelse($operating_room_scrub as $key => $operating_room_scrubs)
                                                        <span>{{ practitioner_type_by_id($operating_room_scrubs) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($operating_room_scrub as $key => $operating_room_scrubs)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($operating_room_scrubs) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        @endif

                        <?php

                        $gynacologyArray = is_string($surgical_obstrics_gynacology) ? json_decode($surgical_obstrics_gynacology, true) : (is_array($surgical_obstrics_gynacology) ? $surgical_obstrics_gynacology : []);

                        $profileData = $profileData ?? new stdClass();
                        $surgical_preoperative = isset($profileData->surgical_obstrics_gynacology) ? json_decode($profileData->surgical_obstrics_gynacology, true) : [];
                        ?>

                        @if(is_array($gynacologyArray) && in_array(233, $gynacologyArray))
                        <div class="col-md-12 mt-3" id="Surgical_Obstetrics">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Surgical Obstetrics and Gynecology (OB/GYN) : </strong>
                                {{-- @forelse($surgical_preoperative as $key => $subtype)
                                                        <span>{{ practitioner_type_by_id($subtype) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($surgical_preoperative as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif

                        <?php
                        $neonatalcareArray = is_string($neonatal_care) ? json_decode($neonatal_care, true) : (is_array($neonatal_care) ? $neonatal_care : []);
                        $profileData = $profileData ?? new stdClass();
                        $neonatal_care = isset($profileData->neonatal_care) ? json_decode($profileData->neonatal_care, true) : [];
                        ?>

                        @if(is_array($neonatalcareArray) && in_array(250, $neonatalcareArray))
                        <div class="col-md-12 mt-3" id="Neonatal_Care">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Neonatal Care : </strong>
                                {{-- @forelse($neonatal_care as $key => $neonatal_careS)
                                                        <span>{{ practitioner_type_by_id($neonatal_careS) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($neonatal_care as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif

                        <?php
                        $paediaArray = is_string($paedia_surgical_preoperative) ? json_decode($paedia_surgical_preoperative, true) : (is_array($paedia_surgical_preoperative) ? $paedia_surgical_preoperative : []);
                        $profileData = $profileData ?? new stdClass();
                        $paedia_surgical_preoperative = isset($profileData->paedia_surgical_preoperative) ? json_decode($profileData->paedia_surgical_preoperative, true) : [];
                        $pad_op_room = isset($profileData->pad_op_room) ? json_decode($profileData->pad_op_room, true) : [];
                        $pad_qr_scout = isset($profileData->pad_qr_scout) ? json_decode($profileData->pad_qr_scout, true) : [];
                        $pad_qr_scrub = isset($profileData->pad_qr_scrub) ? json_decode($profileData->pad_qr_scrub, true) : [];
                        ?>

                        @if(is_array($paediaArray) && in_array(285, $paediaArray))
                        <div class="col-md-12 mt-3" id="Surgical_Preop">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Paediatric Surgical Preop. and Postop. Care : </strong>
                                {{-- @forelse($paedia_surgical_preoperative as $key => $ubspecialty)
                                                        <span>{{ practitioner_type_by_id($ubspecialty) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($paedia_surgical_preoperative as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3" id="Paediatric_Operating">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Paediatric Operating Room (OR) : </strong>
                                {{-- @forelse($pad_op_room as $key => $pad_op_rooms)
                                                        <span>{{ practitioner_type_by_id($pad_op_rooms) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($pad_op_room as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3" id="Paediatric_Operating_Scout">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Paediatric OR: Scout (Circulating Nurse) : </strong>
                                {{-- @forelse($pad_qr_scout as $key => $pad_qr_scouts)
                                                        <span>{{ practitioner_type_by_id($pad_qr_scouts) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($pad_qr_scout as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3" id="Paediatric_Operating_Scrub">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Paediatric OR: Scrub (Technician Nurse) : </strong>
                                <ul class="dropdown-list">
                                    @forelse($pad_qr_scrub as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        @endif

                        @if($profileData->bio)
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Professional Bio : </strong> <span>{{ $profileData->bio }}</span>
                            </div>
                        </div>
                        @endif

                        @if($profileData->current_employee_status)
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Current Employee Status : </strong> <span>{{ $profileData->current_employee_status }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="col-md-12">
                        <div class="text-center text-danger fs-5">No data found</div>
                    </div>

                    @endif


                </div>

            </div>
        </div>
    </div>
</div>
<div class="tab-pane p-3" id="navpill-3" role="tabpanel">
    <div class="row">
        <div class=" w-100  overflow-hidden">
            <div class="card-body p-3 px-md-4 pb-0">
                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center "> Education and Certifications
                </h3>
            </div>
            <div class="card-body p-3 px-md-4">
                <div class="col-md-12">
                    @if($educationData && $profileData)
                    <div class="row">

                        <h4 class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center">Educational Background : </h4>
                        @if ($profileData->degree != 'null')
                        @php $degree = json_decode($profileData->degree);
                        // print_r($degree);die;
                        @endphp
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Nurse & Midwife degree: </strong>
                                <ul class="dropdown-list">
                                    @forelse($degree as $key => $value)
                                    <li><span class="dropdown-item-custom">{{ nurse_midwife_degree_by_id($value) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif
                        @if(isset($educationData->institution) && $educationData->institution)
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Institution : </strong>
                                <span class="">{{ $educationData->institution }}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($educationData->graduate_start_date) && $educationData->graduate_start_date)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Graduation Start Date : </strong>
                                <span class="">{{ \Carbon\Carbon::parse($educationData->graduate_start_date)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($educationData->graduate_end_date) && $educationData->graduate_end_date)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Graduation End Date : </strong>
                                <span class="">{{ \Carbon\Carbon::parse($educationData->graduate_end_date)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        @endif
                        @if ($educationData->professional_certifications != 'null')
                        @php $certifications = json_decode($educationData->professional_certifications);
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Professional Certifications :</strong>
                                <?php
                                $certificates = DB::table("professional_certificate")->orderBy("ordering_id", "asc")->get();
                                ?>

                                <ul class="dropdown-list">
                                    @forelse($certificates as $certificate)
                                    @if(in_array($certificate->id,$certifications))
                                    <li><span class="dropdown-item-custom">{{ $certificate->name }} , </span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No certifications found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif

                        @if($educationData->acls_data && $educationData->acls_data != 'null')
                        @php
                        if($educationData && $educationData->acls_data){
                        $acls_data1 = json_decode($educationData->acls_data);
                        $a_data_arr = array();
                        foreach ($acls_data1 as $a_data) {
                        $a_data_arr[] = $a_data->acls_certification_id;
                        }
                        $a_data_json = json_encode($a_data_arr);
                        }else{
                        $acls_data1 = "";
                        $a_data_json = "";

                        }
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>ACLS (Advanced Cardiovascular Life Support) :</strong>
                                <?php
                                $acls_datas = DB::table("professional_certificate_table")
                                    ->where("cert_id", "6")
                                    ->get();
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($acls_datas as $acls_data)
                                    @if($a_data->acls_certification_id == $acls_data->name)
                                    <li><span class="dropdown-item-custom">{{ $acls_data->name }} , </span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No certifications found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number :</strong>
                                <span class="">{{ $a_data->acls_license_number  }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry :</strong>
                                <span class="">{{ $a_data->acls_expiry  }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Image :</strong>
                                @if($a_data->acls_upload_certification )
                                <a href="{{ asset('uploads/certificates/'.$a_data->acls_upload_certification ) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="text-success">View Image</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($educationData->bls_data && $educationData->bls_data != 'null')
                        @php
                        if($educationData && $educationData->bls_data){
                        $bls_data1 = json_decode($educationData->bls_data);
                        $b_data_arr = array();
                        foreach ($bls_data1 as $b_data) {
                        $b_data_arr[] = $b_data->bls_certification_id;
                        }
                        $b_data_json = json_encode($b_data_arr);
                        }else{
                        $bls_data1 = "";
                        $b_data_json = "";

                        }
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>BLS (Basic Life Support) :</strong>
                                <?php
                                $bls_datas = DB::table("professional_certificate_table")
                                    ->where("cert_id", "7")
                                    ->get();
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($bls_datas as $bls_data)
                                    @if($b_data->bls_certification_id == $bls_data->name)
                                    <li><span class="dropdown-item-custom">{{ $bls_data->name }} , </span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No certifications found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number :</strong>
                                <span class="">{{ $b_data->bls_license_number }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry :</strong>
                                <span class="">{{ $b_data->bls_expiry }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Image :</strong>
                                @if($b_data->bls_upload_certification)
                                <a href="{{ asset('uploads/certificates/'.$b_data->bls_upload_certification) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="text-success">No Image</span>
                                @endif

                            </div>
                        </div>
                        @endif

                        @if($educationData->cpr_data && $educationData->cpr_data != 'null')
                        @php
                        if($educationData && $educationData->cpr_data){
                        $cpr_data1 = json_decode($educationData->cpr_data);
                        $c_data_arr = array();
                        foreach ($cpr_data1 as $c_data) {
                        $c_data_arr[] = $c_data->cpr_certification_id;
                        }
                        $c_data_json = json_encode($c_data_arr);
                        }else{
                        $cpr_data1 = "";
                        $c_data_json = "";
                        }
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>CPR (Cardiopulmonary Resuscitation) :</strong>
                                <?php
                                $cpr_datas = DB::table("professional_certificate_table")
                                    ->where("cert_id", "8")
                                    ->get();
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($cpr_datas as $cpr_data)
                                    @if($c_data->cpr_certification_id == $cpr_data->name)
                                    <li><span class="dropdown-item-custom">{{ $cpr_data->name }} , </span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number :</strong>
                                <span class="">{{ $c_data->cpr_license_number }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry :</strong>
                                <span class="">{{ $c_data->cpr_expiry }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Image :</strong>
                                @if($c_data->cpr_upload_certification)
                                <a href="{{ asset('uploads/certificates/'.$c_data->cpr_upload_certification) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="">No Image</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($educationData->nrp_data && $educationData->nrp_data != 'null')
                        @php
                        if($educationData && $educationData->nrp_data){
                        $nrp_data1 = json_decode($educationData->nrp_data);
                        $n_data_arr = array();
                        foreach ($nrp_data1 as $n_data) {
                        $n_data_arr[] = $n_data->nrp_certification_id;
                        }
                        $n_data_json = json_encode($n_data_arr);
                        }else{
                        $nrp_data1 = "";
                        $n_data_json = "";
                        }
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>NRP (Neonatal Resuscitation Program) :</strong>
                                <?php
                                $nrp_datas = DB::table("professional_certificate_table")
                                    ->where("cert_id", "9")
                                    ->get();
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($nrp_datas as $nrp_data)
                                    @if($n_data->nrp_certification_id == $nrp_data->name )
                                    <li><span class="dropdown-item-custom">{{ $nrp_data->name }} , </span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number :</strong>
                                <span class="">{{ $n_data->nrp_license_number }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry :</strong>
                                <span class="">{{$n_data->nrp_expiry }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Image :</strong>
                                @if($n_data->nrp_upload_certification)
                                <a href="{{ asset('uploads/certificates/'.$n_data->nrp_upload_certification) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="">No Image</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($educationData->pals_data && $educationData->pals_data != 'null')
                        @php
                        if($educationData && $educationData->pals_data){
                        $pls_data1 = json_decode($educationData->pals_data);
                        $p_data_arr = array();
                        foreach ($pls_data1 as $p_data) {
                        $p_data_arr[] = $p_data->pls_certification_id;
                        }
                        $p_data_json = json_encode($p_data_arr);
                        }else{
                        $pls_data1 = "";
                        $p_data_json = "";
                        }
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>PALS (Pediatric Advanced Life Support) :</strong>
                                @if($palsData)
                                <?php
                                $pals_datas = DB::table("professional_certificate_table")
                                    ->where("cert_id", "10")
                                    ->get();
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($pals_datas as $pals_data)
                                    @if($p_data->pls_certification_id == $pals_data->name)
                                    <li><span class="dropdown-item-custom">{{ $pals_data->name }} , </span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                    @endforelse
                                </ul>
                                @else
                                <ul class="dropdown-list">

                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>

                                </ul>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number :</strong>
                                <span class="">{{ $p_data->pls_license_number }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry :</strong>
                                <span class="">{{ $p_data->pls_expiry }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Image :</strong>
                                @if($p_data->pls_upload_certification)
                                <a href="{{ asset('uploads/certificates/'.$p_data->pls_upload_certification) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="">No Image</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($educationData->rn_data && $educationData->rn_data != 'null')
                        @php
                        if($educationData && $educationData->rn_data){
                        $rn_data1 = json_decode($educationData->rn_data);
                        $r_data_arr = array();
                        foreach ($rn_data1 as $r_data) {
                        $r_data_arr[] = $r_data->rn_certification_id;
                        }
                        $r_data_json = json_encode($r_data_arr);
                        }else{
                        $rn_data1 = "";
                        $r_data_json = "";
                        }
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>RN (Registered Nurse) :</strong>

                                <?php
                                $rn_datas = DB::table("professional_certificate_table")
                                    ->where("cert_id", "11")
                                    ->get();
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($rn_datas as $rn_data)
                                    @if($r_data->rn_certification_id == $rn_data->name )
                                    <li><span class="dropdown-item-custom">{{ $rn_data->name }} , </span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number :</strong>
                                <span class="">{{ $r_data->rn_license_number  }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry :</strong>
                                <span class="">{{ $r_data->rn_expiry  }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Image :</strong>
                                @if($r_data->rn_certification_id )
                                <a href="{{ asset('uploads/certificates/'.$r_data->rn_upload_certification ) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="">No Image</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($educationData->np_data && $educationData->np_data != 'null')
                        @php
                        if($educationData && $educationData->np_data){
                        $np_data1 = json_decode($educationData->np_data);
                        $n_data_arr = array();
                        foreach ($np_data1 as $n_data) {
                        $n_data_arr[] = $n_data->np_certification_id;
                        }
                        $np_data_json = json_encode($n_data_arr);
                        }else{
                        $np_data1 = "";
                        $np_data_json = "";
                        }
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>NP (Nurse Practioner) / (APRN) Advanced Practice Registered Nurse :</strong>

                                <?php
                                $np_datas = DB::table("professional_certificate_table")
                                    ->where("cert_id", "12")
                                    ->get();
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($np_datas as $np_data)
                                    @if($n_data->np_certification_id == $np_data->name)
                                    <li><span class="dropdown-item-custom">{{ $np_data->name }} , </span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number :</strong>
                                <span class="">{{ $n_data->np_license_number  }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry :</strong>
                                <span class="">{{ $n_data->np_expiry }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Image :</strong>
                                @if($rn_file)
                                <a href="{{ asset('uploads/certificates/'.$n_data->np_upload_certification) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="">No Image</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($educationData->cna_data && $educationData->cna_data != 'null')
                        @php
                        if($educationData && $educationData->cna_data){
                        $cna_data1 = json_decode($educationData->cna_data);
                        $cn_data_arr = array();
                        foreach ($cna_data1 as $cn_data) {
                        $cn_data_arr[] = $cn_data->cn_certification_id;
                        }
                        $cna_data_json = json_encode($cn_data_arr);
                        }else{
                        $cna_data1 = "";
                        $cna_data_json = "";
                        }
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>CNA (Certified Nursing Assistant) / EN (Enrolled Nurse) :</strong>

                                <?php
                                $cna_datas = DB::table("professional_certificate_table")
                                    ->where("cert_id", "13")
                                    ->get();
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($cna_datas as $cna_data)
                                    @if($cn_data->cn_certification_id == $cna_data->name)
                                    <li><span class="dropdown-item-custom">{{ $cna_data->name }} ,</span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number :</strong>
                                <span class="">{{ $cn_data->np_license_number }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry :</strong>
                                <span class="">{{ $cn_data->np_expiry }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Image :</strong>
                                @if($cna_file)
                                <a href="{{ asset('uploads/certificates/'.$cn_data->np_upload_certification) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="">No Image</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($educationData->lpn_data && $educationData->lpn_data != 'null')
                        @php
                        if($educationData && $educationData->lpn_data){
                        $lpn_data1 = json_decode($educationData->lpn_data);
                        $lpn_data_arr = array();
                        foreach ($lpn_data1 as $lpn_data) {
                        $lpn_data_arr[] = $lpn_data->lpn_certification_id;
                        }
                        $lpn_data_json = json_encode($lpn_data_arr);
                        }else{
                        $lpn_data1 = "";
                        $lpn_data_json = "";
                        }
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>LPN (Licensed Practical Nurse) / LVN (Licensed Vocational Nurse) :</strong>

                                <?php
                                $lpn_datas = DB::table("professional_certificate_table")
                                    ->where("cert_id", "14")
                                    ->get();
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($lpn_datas as $lpn_data)
                                    @if($lpn_data->lpn_certification_id == $lpn_data->name)
                                    <li><span class="dropdown-item-custom">{{ $lpn_data->name }},</span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number :</strong>
                                <span class="">{{ $lpn_data->lpn_license_number }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry :</strong>
                                <span class="">{{ $lpn_data->lpn_expiry }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Image :</strong>
                                @if($lpn_data->lpn_upload_certification)
                                <a href="{{ asset('uploads/certificates/'.$lpn_data->lpn_upload_certification) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="">No Image</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($educationData->crna_data && $educationData->crna_data != 'null')
                        @php
                        if($educationData && $educationData->crna_data){
                        $crna_data1 = json_decode($educationData->crna_data);
                        $crna_data_arr = array();
                        foreach ($crna_data1 as $crna_data) {
                        $crna_data_arr[] = $crna_data->crna_certification_id;
                        }
                        $crna_data_json = json_encode($crna_data_arr);
                        }else{
                        $crna_data1 = "";
                        $crna_data_json = "";
                        }
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>CRNA (Certified Registered Nurse Anesthetist) :</strong>

                                <?php
                                $crna_datas = DB::table("professional_certificate_table")
                                    ->where("cert_id", "15")
                                    ->get();
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($crna_datas as $crna_data)
                                    @if($crna_data->crna_certification_id == $crna_data->name)
                                    <li><span class="dropdown-item-custom">{{ $crna_data->name }} , </span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number :</strong>
                                <span class="">{{ $crna_data->crna_license_number }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry :</strong>
                                <span class="">{{ $crna_data->crna_expiry }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Image :</strong>
                                @if($crna_file)
                                <a href="{{ asset('uploads/certificates/'.$crna_data->crna_upload_certification) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="">No Image</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($educationData->cnm_data && $educationData->cnm_data != 'null')
                        @php
                        if($educationData && $educationData->cnm_data){
                        $cnm_data1 = json_decode($educationData->cnm_data);
                        $cnm_data_arr = array();
                        foreach ($cnm_data1 as $cnm_data) {
                        $cnm_data_arr[] = $cnm_data->cnm_certification_id;
                        }
                        $cnm_data_json = json_encode($cnm_data_arr);
                        }else{
                        $cnm_data1 = "";
                        $cnm_data_json = "";
                        }
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>CNM (Certified Nurse Midwife) :</strong>

                                <?php
                                $cnm_datas = DB::table("professional_certificate_table")
                                    ->where("cert_id", "16")
                                    ->get();
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($cnm_datas as $cnm_data)
                                    @if($cnm_data->cnm_certification_id == $cnm_data->name)
                                    <li><span class="dropdown-item-custom">{{ $cnm_data->name }} , </span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number :</strong>
                                <span class="">{{ $cnm_data->cnm_license_number }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry :</strong>
                                <span class="">{{ $cnm_data->cnm_expiry }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Image :</strong>
                                @if($cnm_data->cnm_upload_certification)
                                <a href="{{ asset('uploads/certificates/'.$cnm_data->cnm_upload_certification) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="">No Image</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($educationData->ons_data && $educationData->ons_data != 'null')
                        @php
                        if($educationData && $educationData->ons_data){
                        $ons_data1 = json_decode($educationData->ons_data);
                        $ons_data_arr = array();
                        foreach ($ons_data1 as $ons_data) {
                        $ons_data_arr[] = $ons_data->ons_certification_id;
                        }
                        $ons_data_json = json_encode($ons_data_arr);
                        }else{
                        $ons_data1 = "";
                        $ons_data_json = "";
                        }
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>ONS/ONCC (Oncology Nursing Society/Oncology Nursing Certification Corporation) :</strong>

                                <?php
                                $ons_datas = DB::table("professional_certificate_table")
                                    ->where("cert_id", "17")
                                    ->get();
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($ons_datas as $ons_data)
                                    @if($ons_data->ons_certification_id == $ons_data->name )
                                    <li><span class="dropdown-item-custom">{{ $ons_data->name }} , </span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number :</strong>
                                <span class="">{{ $ons_data->ons_license_number }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry :</strong>
                                <span class="">{{ $ons_data->ons_expiry }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Image :</strong>
                                @if($cnm_file)
                                <a href="{{ asset('uploads/certificates/'.$ons_data->ons_upload_certification) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="">No Image</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($educationData->msw_data && $educationData->msw_data != 'null')
                        @php
                        if($educationData && $educationData->msw_data){
                        $msw_data1 = json_decode($educationData->msw_data);
                        $msw_data_arr = array();
                        foreach ($msw_data1 as $msw_data) {
                        $msw_data_arr[] = $msw_data->msw_certification_id;
                        }
                        $msw_data_json = json_encode($msw_data_arr);
                        }else{
                        $msw_data1 = "";
                        $msw_data_json = "";
                        }
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>MSW/AiM (Maternity Support Worker/Assistant in Midwifery ) / Midwife Assistant :</strong>

                                <?php
                                $msw_datas = DB::table("professional_certificate_table")
                                    ->where("cert_id", "18")
                                    ->get();
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($msw_datas as $msw_data)
                                    @if($msw_data->msw_certification_id == $msw_data->name)
                                    <li><span class="dropdown-item-custom">{{ $msw_data->name }} , </span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number :</strong>
                                <span class="">{{ $msw_data->msw_license_number }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry :</strong>
                                <span class="">{{ $msw_data->msw_expiry }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Image :</strong>
                                @if($msw_data->msw_certification_id)
                                <a href="{{ asset('uploads/certificates/'.$msw_data->msw_upload_certification) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="">No Image</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($educationData->ain_data && $educationData->ain_data != 'null')
                        @php
                        if($educationData && $educationData->ain_data){
                        $ain_data1 = json_decode($educationData->ain_data);
                        $ain_data_arr = array();
                        foreach ($ain_data1 as $ain_data) {
                        $ain_data_arr[] = $ain_data->ain_certification_id;
                        }
                        $ain_data_json = json_encode($ain_data_arr);
                        }else{
                        $ain_data1 = "";
                        $ain_data_json = "";
                        }
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>AIN (Assistant in Nursing) / NA (Nurse Associate) / HCA (Healthcare Assistant) :</strong>

                                <?php
                                $ain_datas = DB::table("professional_certificate_table")
                                    ->where("cert_id", "19")
                                    ->get();
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($ain_datas as $ain_data)
                                    @if($ain_data->ain_certification_id == $ain_data->name)
                                    <li><span class="dropdown-item-custom">{{ $ain_data->name }} , </span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number :</strong>
                                <span class="">{{ $ain_data->ain_license_number }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry :</strong>
                                <span class="">{{ $ain_data->ain_expiry }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Image :</strong>
                                @if($ain_file)
                                <a href="{{ asset('uploads/certificates/'.$ain_data->ain_upload_certification) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="">No Image</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($educationData->rpn_data && $educationData->rpn_data != 'null')
                        @php
                        if($educationData && $educationData->rpn_data){
                        $rpn_data1 = json_decode($educationData->rpn_data);
                        $rpn_data_arr = array();
                        foreach ($rpn_data1 as $rpn_data) {
                        $rpn_data_arr[] = $rpn_data->rpn_certification_id;
                        }
                        $rpn_data_json = json_encode($rpn_data_arr);
                        }else{
                        $rpn_data1 = "";
                        $rpn_data_json = "";
                        }
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>RPN (Registered Practical Nurse) / RGN (Registered General Nurse) :</strong>

                                <?php
                                $rpn_datas = DB::table("professional_certificate_table")
                                    ->where("cert_id", "20")
                                    ->get();
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($rpn_datas as $rpn_data)
                                    @if($rpn_data->rpn_certification_id == $rpn_data->name)
                                    <li><span class="dropdown-item-custom">{{ $rpn_data->name }} , </span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number :</strong>
                                <span class="">{{ $rpn_data->rpn_license_number }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry :</strong>
                                <span class="">{{ $rpn_data->rpn_expiry }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Image :</strong>
                                @if($rpn_data->rpn_upload_certification)
                                <a href="{{ asset('uploads/certificates/'.$rpn_data->rpn_upload_certification) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="">No Image</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($educationData->nl_data && $educationData->nl_data != 'null')
                        @php
                        $nl_data_ids = json_decode($educationData->nl_data, true); // Decode the acls_data field into an array
                        $nlData = json_decode($nl_data_ids['nl_data'], true);
                        $nl_licence_num = $nl_data_ids['nl_licence_num'];
                        $nl_licence_expiry = $nl_data_ids['nl_licence_expiry'];
                        $nl_file = $nl_data_ids['nl_file'];
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>No License/Certification :</strong>

                                <?php
                                $nl_datas = DB::table("professional_certificate_table")
                                    ->where("cert_id", "21")
                                    ->get();
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($nl_datas as $nl_data)
                                    @if(is_array($nl_data_ids) && in_array($nl_data->professionalcert_id,$nlData))
                                    <li><span class="dropdown-item-custom">{{ $nl_data->name }} , </span></li>
                                    @endif
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No Data found</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number :</strong>
                                <span class="">{{ $nl_licence_num }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry :</strong>
                                <span class="">{{ $nl_licence_expiry }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Image :</strong>
                                @if($nl_file)
                                <a href="{{ asset('uploads/'.$nl_file) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="">No Image</span>
                                @endif
                            </div>
                        </div>
                        @endif





                        @if($educationData->licence_number && $educationData->country &&
                        $educationData->state && $educationData->expiration_date )
                        <h4 class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center">Licenses: </h4>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>licence_number : </strong>
                                <span class="">{{ $educationData->licence_number }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Country : </strong>
                                <span class="">{{$educationData->country}} </span>
                                {{-- <span class="">{{country_name($educationData->country)}} </span> --}}
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>State : </strong>
                                <span class="">{{ state_name( $educationData->state)}}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiration Date : </strong>
                                <span class="">{{ \Carbon\Carbon::parse($educationData->expiration_date)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        @endif

                        @php
                        // $training_workshops = json_decode($educationData->training_workshops);
                        @endphp
                        <?php
                        if (!empty($educationData)) {
                            $certificate_data = json_decode($educationData->additional_training_data);
                        } else {
                            $certificate_data = "";
                        }

                        ?>
                        <?php
                        $i = 1;
                        ?>
                        @if(!empty($certificate_data))
                        @foreach($certificate_data as $c_data)
                        <h4 class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center">Additional Training :</h4>

                        <h6>Certification/Licence {{ $i }}</h6>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Courses/workshops : </strong>
                                <span class="">{{ $c_data->training_courses }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Certification/Licence Number : </strong>
                                <span class="">{{ $c_data->additional_license_number }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry : </strong>
                                <span class="">{{ $c_data->additional_expiry }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Upload your certification/Licence : </strong>
                                @if($c_data->additional_upload_certification)
                                <a href="{{ asset('uploads/certificates/'.$c_data->additional_upload_certification) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @else
                                <span class="">No Image</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @endif



                    </div>
                    @else
                    <div class="col-md-12">
                        <div class="text-center text-danger fs-5">No data found</div>
                    </div>

                    @endif


                </div>

            </div>
        </div>
    </div>
</div>
<div class="tab-pane p-3" id="navpill-4" role="tabpanel">
    <div class="row">
        <div class=" w-100  overflow-hidden">
            <div class="card-body p-3 px-md-4 pb-0">
                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Experience</h3>
            </div>
            <div class="card-body p-3 px-md-4">
                <div class="col-md-12">
                    <div class="row">
                        @if($experienceData)
                        <?php $i = 1; ?>
                        @foreach($experienceData as $data)
                        <h6 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-2">
                            Work Experience {{ $i }}
                        </h6>
                        @if ($data->nurseType != 'null')
                        @php $nurseType=json_decode($data->nurseType); @endphp
                        @if (is_array($nurseType))
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Type of Nurse? : </strong>
                                <ul class="dropdown-list">
                                    @forelse($nurseType as $key => $ubspecialty)
                                    <li><span class="dropdown-item-custom">{{ specialty_name_by_id_NEW($ubspecialty) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No specialties available</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif
                        @endif

                        @if ($data->nurseType != 'null')
                        @php
                        $nurseType = json_decode($data->nurseType);

                        // Ensure $nurseType is an array
                        $nurseType = is_array($nurseType) ? $nurseType : [];
                        $nursepra = [];

                        @endphp

                        @foreach($nurseType as $key => $ubspecialty)
                        @php

                        $specialtyName = specialty_name_by_id_NEW($ubspecialty);

                        $normalizedSpecialty = strtolower(str_replace('_', ' ', $specialtyName));

                        // Define strings to compare
                        $string1 = 'entry level nursing';
                        $string2 = 'registered nurses';
                        $string3 = 'advanced practitioner';

                        // Extract words from normalized specialty
                        $words = explode(' ', $normalizedSpecialty);
                        $firstWord = isset($words[0]) ? strtolower($words[0]) : '';
                        $secondWord = isset($words[1]) ? strtolower($words[1]) : '';
                        $firstTwoWords = $firstWord . ' ' . $secondWord;

                        // Determine the correct nurse sub-job type
                        if ($normalizedSpecialty === $string1) {
                        $nursesubjobType = json_decode($data->entry_level_nursing);

                        } elseif ($firstTwoWords === strtolower($string2)) {
                        $nursesubjobType = json_decode($data->registered_nurses);
                        } elseif ($firstWord === 'advanced') {
                        $nursepra = $data->advanced_practioner;
                        $nursesubjobType = json_decode($data->advanced_practioner);
                        } else {
                        $nursesubjobType = json_decode($data->advanced_practioner); // Default case
                        }

                        // Ensure $nursesubjobType is an array
                        $nursesubjobType = is_array($nursesubjobType) ? $nursesubjobType : [];
                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>{{ $specialtyName }}:</strong>

                                {{-- @forelse($nursesubjobType as $key => $subtype)

                                                                    <span>{{ specialty_name_by_id($subtype) }} ,</span>
                                @empty
                                <span>No sub-job types found</span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($nursesubjobType as $key => $subtype)

                                    <li><span class="dropdown-item-custom">{{ specialty_name_by_id_NEW($subtype) }} , </span></li>

                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endforeach
                        @endif

                        <?php
                        // Decode the JSON strings to associative arrays
                        // $nursepraArray = json_decode($nursepra, true); // `true` to return an associative array
                        $nursepraArray = is_string($nursepra) ? json_decode($nursepra, true) : (is_array($nursepra) ? $nursepra : []);

                        // Ensure $profileData is not null and has the required properties
                        $data = $data ?? new stdClass();
                        // $nurse_prac = isset($profileData->nurse_prac) ? json_decode($profileData->nurse_prac, true) : [];
                        $nurse_prac = isset($data->nurse_prac)
                            ? (is_string($data->nurse_prac)
                                ? json_decode($data->nurse_prac, true)
                                : (is_array($data->nurse_prac)
                                    ? $data->nurse_prac
                                    : []))
                            : [];
                        ?>

                        @if(is_array($nursepraArray) && in_array(179, $nursepraArray))
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Nurse Practitioner (NP) : </strong>
                                {{-- @forelse($nurse_prac as $key => $ubspecialty)
                                                        <span>{{ specialty_name_by_id_NEW($ubspecialty) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}

                                <ul class="dropdown-list">
                                    @forelse($nurse_prac as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ specialty_name_by_id_NEW($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif

                        @if ($data->specialties != 'null')
                        @php $specialties=json_decode($data->specialties); @endphp
                        @if (is_array($specialties))
                        <div class="col-md-12 mt-4">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Specialties : </strong>
                                {{-- @forelse($specialties as $key => $ubspecialty)
                                                            <span>{{ practitioner_type_by_id($ubspecialty) }} , </span>@empty
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($specialties as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif
                        @endif

                        @if ($data->specialties != 'null')
                        @php
                        $specialties = json_decode($data->specialties);

                        // Ensure $nurseType is an array
                        $specialties = is_array($specialties) ? $specialties : [];
                        $surgical_preoperative = [];
                        $surgical_obstrics_gynacology = [];
                        $neonatal_care = [];
                        $paedia_surgical_preoperative = [];
                        $i= 1;
                        @endphp

                        @foreach($specialties as $key => $ubspecialty)
                        @php

                        $specialtyName = practitioner_type_by_id($ubspecialty);

                        $normalizedSpecialty = strtolower(str_replace('_', ' ', $specialtyName));

                        // Define strings to compare
                        $string1 = 'adults';
                        $string2 = 'maternity';
                        $string3 = 'paediatrics neonatal';
                        $string4 = 'community';

                        // Extract words from normalized specialty
                        $words = explode(' ', $normalizedSpecialty);
                        $firstWord = isset($words[0]) ? strtolower($words[0]) : '';
                        $secondWord = isset($words[1]) ? strtolower($words[1]) : '';
                        $firstTwoWords = $firstWord . ' ' . $secondWord;

                        // Determine the correct nurse sub-job type
                        if ($normalizedSpecialty === $string1) {
                        $surgical_preoperative = $data->adults;
                        $specsubType = json_decode($data->adults);
                        } elseif ($firstWord === strtolower($string2)) {
                        $surgical_obstrics_gynacology = $data->maternity;
                        $specsubType = json_decode($data->maternity);
                        } elseif ($firstTwoWords === strtolower($string3)) {
                        $neonatal_care = $data->paediatrics_neonatal;
                        $paedia_surgical_preoperative = $data->paediatrics_neonatal;
                        $specsubType = json_decode($data->paediatrics_neonatal);
                        } elseif ($firstWord === strtolower($string4)) {


                        $specsubType = json_decode($data->community);
                        }else {
                        $specsubType = json_decode($data->community); // Default case
                        }

                        // Ensure $nursesubjobType is an array
                        $specsubType = is_array($specsubType) ? $specsubType : [];
                        @endphp

                        <div class="col-md-12 mt-4" id="cat_{{ $i}}">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>{{ $specialtyName }}:</strong>

                                {{-- @forelse($specsubType as $key => $subtype)

                                                                    <span>{{ practitioner_type_by_id($subtype) ;}} ,</span>
                                @empty
                                <span></span>
                                @endforelse --}}

                                <ul class="dropdown-list">
                                    @forelse($specsubType as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>

                            </div>
                        </div>
                        <?php  ?>
                        @endforeach

                        @endif

                        <?php
                        $surgicalArray = is_string($surgical_preoperative) ? json_decode($surgical_preoperative, true) : (is_array($surgical_preoperative) ? $surgical_preoperative : []);

                        $data = $data ?? new stdClass();
                        $sargicaldata = isset($data->surgical_preoperative) ? json_decode($data->surgical_preoperative, true) : [];
                        $operating_room = isset($data->operating_room) ? json_decode($data->operating_room, true) : [];
                        $operating_room_scout = isset($data->operating_room_scout) ? json_decode($data->operating_room_scout, true) : [];
                        $operating_room_scrub = isset($data->operating_room_scrub) ? json_decode($data->operating_room_scrub, true) : [];
                        ?>

                        @if(is_array($surgicalArray) && in_array(96, $surgicalArray))
                        <div class="col-md-12 mt-3" id="sugical_care">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Surgical Preoperative and Postoperative Care : </strong>
                                {{-- @forelse($sargicaldata as $key => $ubspecialty)
                                                        <span>{{ practitioner_type_by_id($ubspecialty) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}

                                <ul class="dropdown-list">
                                    @forelse($sargicaldata as $key => $ubspecialty)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($ubspecialty) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3" id="Operating_Room">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Operating Room (OR) : </strong>
                                {{-- @forelse($operating_room as $key => $operating_rooms)
                                                        <span>{{ practitioner_type_by_id($operating_rooms) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($operating_room as $key => $operating_rooms)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($operating_rooms) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3" id="paediatric_oR">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Paediatric OR: Scout (Circulating Nurse) : </strong>
                                {{-- @forelse($operating_room_scout as $key => $operating_room_scouts)
                                                        <span>{{ practitioner_type_by_id($operating_room_scouts) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($operating_room_scout as $key => $operating_room_scouts)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($operating_room_scouts) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap" id="Technician_Nurse">
                                <strong> Paediatric OR: Scrub (Technician Nurse) : </strong>
                                {{-- @forelse($operating_room_scrub as $key => $operating_room_scrubs)
                                                        <span>{{ practitioner_type_by_id($operating_room_scrubs) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($operating_room_scrub as $key => $operating_room_scrubs)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($operating_room_scrubs) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        @endif

                        <?php

                        $gynacologyArray = is_string($surgical_obstrics_gynacology) ? json_decode($surgical_obstrics_gynacology, true) : (is_array($surgical_obstrics_gynacology) ? $surgical_obstrics_gynacology : []);

                        $data = $data ?? new stdClass();
                        $surgical_preoperative = isset($data->surgical_obstrics_gynacology) ? json_decode($data->surgical_obstrics_gynacology, true) : [];
                        ?>

                        @if(is_array($gynacologyArray) && in_array(233, $gynacologyArray))
                        <div class="col-md-12 mt-3" id="Surgical_Obstetrics">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Surgical Obstetrics and Gynecology (OB/GYN) : </strong>
                                {{-- @forelse($surgical_preoperative as $key => $subtype)
                                                        <span>{{ practitioner_type_by_id($subtype) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($surgical_preoperative as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif

                        <?php
                        $neonatalcareArray = is_string($neonatal_care) ? json_decode($neonatal_care, true) : (is_array($neonatal_care) ? $neonatal_care : []);
                        $data = $data ?? new stdClass();
                        $neonatal_care = isset($data->neonatal_care) ? json_decode($data->neonatal_care, true) : [];
                        ?>

                        @if(is_array($neonatalcareArray) && in_array(250, $neonatalcareArray))
                        <div class="col-md-12 mt-3" id="Neonatal_Care">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Neonatal Care : </strong>
                                {{-- @forelse($neonatal_care as $key => $neonatal_careS)
                                                        <span>{{ practitioner_type_by_id($neonatal_careS) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($neonatal_care as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif

                        <?php
                        $paediaArray = is_string($paedia_surgical_preoperative) ? json_decode($paedia_surgical_preoperative, true) : (is_array($paedia_surgical_preoperative) ? $paedia_surgical_preoperative : []);
                        $data = $data ?? new stdClass();
                        $paedia_surgical_preoperative = isset($data->paedia_surgical_preoperative) ? json_decode($data->paedia_surgical_preoperative, true) : [];
                        $pad_op_room = isset($data->pad_op_room) ? json_decode($data->pad_op_room, true) : [];
                        $pad_qr_scout = isset($data->pad_qr_scout) ? json_decode($data->pad_qr_scout, true) : [];
                        $pad_qr_scrub = isset($data->pad_qr_scrub) ? json_decode($data->pad_qr_scrub, true) : [];
                        ?>

                        @if(is_array($paediaArray) && in_array(285, $paediaArray))
                        <div class="col-md-12 mt-3" id="Surgical_Preop">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Paediatric Surgical Preop. and Postop. Care : </strong>
                                {{-- @forelse($paedia_surgical_preoperative as $key => $ubspecialty)
                                                        <span>{{ practitioner_type_by_id($ubspecialty) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($paedia_surgical_preoperative as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3" id="Paediatric_Operating">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Paediatric Operating Room (OR) : </strong>
                                {{-- @forelse($pad_op_room as $key => $pad_op_rooms)
                                                        <span>{{ practitioner_type_by_id($pad_op_rooms) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($pad_op_room as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3" id="Paediatric_Operating_Scout">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Paediatric OR: Scout (Circulating Nurse) : </strong>
                                {{-- @forelse($pad_qr_scout as $key => $pad_qr_scouts)
                                                        <span>{{ practitioner_type_by_id($pad_qr_scouts) }} , </span>
                                @empty
                                <span></span>
                                @endforelse --}}
                                <ul class="dropdown-list">
                                    @forelse($pad_qr_scout as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3" id="Paediatric_Operating_Scrub">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Paediatric OR: Scrub (Technician Nurse) : </strong>
                                <ul class="dropdown-list">
                                    @forelse($pad_qr_scrub as $key => $subtype)
                                    <li><span class="dropdown-item-custom">{{ practitioner_type_by_id($subtype) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        @endif

                        @if(isset($data->assistent_level))

                        @php
                        $levels = [
                        1 => '1st Year', 2 => '2nd Year', 3 => '3rd Year', 4 => '4th Year',
                        5 => '5th Year', 6 => '6th Year', 7 => '7th Year', 8 => '8th Year',
                        9 => '9th Year', 10 => '10th Year', 11 => '11th Year', 12 => '12th Year',
                        13 => '13th Year', 14 => '14th Year', 15 => '15th Year', 16 => '16th Year',
                        17 => '17th Year', 18 => '18th Year', 19 => '19th Year', 20 => '20th Year',
                        21 => '21st Year', 22 => '22nd Year', 23 => '23rd Year', 24 => '24th Year',
                        25 => '25th Year', 26 => '26th Year', 27 => '27th Year', 28 => '28th Year',
                        29 => '29th Year', 30 => '30th Year'
                        ];
                        $expre = $levels[$data->assistent_level] ?? '30th Year';
                        @endphp

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>What is your Level of experience in this specialty? : </strong><span>{{ $expre }}</span>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Position Held : </strong>
                                <span>
                                    @if($data->position_held == "Team Member")
                                    Team Member
                                    @elseif($data->position_held == "Team Leader")
                                    Team Leader
                                    @elseif($data->position_held == "Educator")
                                    Educator
                                    @elseif($data->position_held == "Manager")
                                    Manager
                                    @elseif($data->position_held == "Clinical Specialist")
                                    Clinical Specialist
                                    @else
                                    No position selected
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Employment Start Date : </strong>
                                <span>{{ \Carbon\Carbon::parse($data->employeement_start_date )->format('d/m/Y') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Employment End Date : </strong>
                                <span>{{ \Carbon\Carbon::parse($data->employeement_end_date)->format('d/m/Y') }}</span>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3" id="Paediatric_Operating_Scrub">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Employment type : </strong>
                                <ul class="dropdown-list">
                                    <li><span class="dropdown-item-custom">{{ $data->employeement_type }}</span></li>

                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3" id="Paediatric_Operating_Scrub" @if($data->employeement_type != 'Permanent') style="display:none;" @endif>
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Permanent : </strong>
                                <ul class="dropdown-list">
                                    <li><span class="dropdown-item-custom">{{ $data->permanent_status }}</span></li>

                                </ul>
                            </div>
                        </div>


                        <div class="col-md-12 mt-3" id="Paediatric_Operating_Scrub" @if($data->employeement_type != 'Temporary') style="display:none;" @endif>
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> Temporary : </strong>
                                <ul class="dropdown-list">
                                    <li><span class="dropdown-item-custom">{{ $data->temporary_status }}</span></li>

                                </ul>
                            </div>
                        </div>

                        <h6 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-2">
                            Detailed Job Descriptions
                        </h6>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Responsibilities :</strong>
                                <textarea style="resize: none;" id="visa_grant_number" name="visa_grant_number" class="form-control" rows="2" readonly>{{ $data->responsiblities }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Achievements :</strong>
                                <textarea style="resize: none;" id="visa_grant_number" name="visa_grant_number" class="form-control" rows="2" readonly>{{ $data->achievements }}</textarea>
                            </div>
                        </div>

                        <h6 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-2">
                            Areas of Expertise
                        </h6>

                        @if(isset($data->skills_compantancies) && $data->skills_compantancies)
                        <h4 class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center">Areas of Expertise :</h4>
                        @php $skills_compantancies=json_decode($data->skills_compantancies); @endphp
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Specific skills and competencies : </strong>

                                <ul class="dropdown-list">
                                    @foreach($skills_compantancies as $skill)
                                    <li><span class="dropdown-item-custom">{{ skill_name_by_id($skill)}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif

                        @if(isset($data->inter_and_em_skill) && ($data->inter_and_em_skill != 'null'))
                        <h4 class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center">Areas of Expertise :</h4>
                        @php $inter_and_em_skill=json_decode($data->inter_and_em_skill); @endphp
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Interpersonal and Emotional Skills : </strong>
                                <ul class="dropdown-list">
                                    @foreach($inter_and_em_skill as $inter)
                                    <li><span class="dropdown-item-custom">{{ skill_name_by_id($inter)}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif


                        @if(isset($data->org_and_any_skill) && ($data->org_and_any_skill != 'null'))

                        @php $org_and_any_skill=json_decode($data->org_and_any_skill);

                        @endphp
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Organizational and Analytical Skills : </strong>
                                <ul class="dropdown-list">
                                    @foreach($data->org_and_any_skill as $org)
                                    <li><span class="dropdown-item-custom">{{ skill_name_by_id($org)}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif


                        @if(isset($data->lead_and_ment_skill) && ($data->lead_and_ment_skill != 'null'))
                        @php $lead_and_ment_skill=json_decode($data->lead_and_ment_skill);

                        @endphp
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Leadership and Mentorship Skills : </strong>
                                <ul class="dropdown-list">
                                    @foreach($lead_and_ment_skill as $lead)

                                    <li><span class="dropdown-item-custom">{{ skill_name_by_id($lead)}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif


                        @if(isset($data->tech_and_soft_pro) && ($data->tech_and_soft_pro != 'null'))
                        @php $tech_and_soft_pro=json_decode($data->tech_and_soft_pro); @endphp
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Technology and Software Proficiency : </strong>
                                <ul class="dropdown-list">
                                    @foreach($tech_and_soft_pro as $tech)
                                    <li><span class="dropdown-item-custom">{{ skill_name_by_id($tech)}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif

                        @if(isset($data->evidence_type) && ($data->evidence_type != 'null'))
                        @php $evidence_types=json_decode($data->evidence_type);

                        @endphp

                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Type of evidence: </strong>
                                <ul class="dropdown-list">
                                    @foreach($evidence_types as $evidences)
                                    <li><span class="dropdown-item-custom">{{ print_r($evidences) }}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Evidence Image :</strong>
                                @if($data->upload_evidence )
                                @php $upload_evidence=json_decode($data->upload_evidence); @endphp
                                @foreach($upload_evidence as $evidenceimg)
                                <a href="{{ asset('uploads/evidence/'.$evidenceimg ) }}" target="_blank">
                                    <span class="text-success">View Image</span>
                                </a>
                                @endforeach


                                @else
                                <span class="text-success">View Image</span>
                                @endif
                            </div>
                        </div>





                        <?php $i++; ?>
                        @endforeach
                        @else
                        <div class="col-md-12">
                            <div class="text-center text-danger fs-5">No data found</div>
                        </div>

                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="tab-pane p-3" id="navpill-4.1" role="tabpanel">
    <div class="row">
        <div class=" w-100  overflow-hidden">
            <div class="card-body p-3 px-md-4 pb-0">
                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">References</h3>
            </div>
            <div class="card-body p-3 px-md-4">
                <div class="col-md-12">
                    @if(!empty($RefereData))
                    <?php
                    $i = 1;
                    ?>
                    @foreach($RefereData as $data)
                    <div class="row">
                        <h4>References {{ $i}}</h4>
                        @if(isset($data->first_name) && $data->first_name)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>First name: </strong>
                                <span>{{$data->first_name}}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($data->last_name) && $data->last_name)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Last name: </strong>
                                <span>{{$data->last_name}}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($data->email) && $data->email)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Email: </strong>
                                <span>{{$data->email}}</span>
                            </div>
                        </div>
                        @endif

                        @if(isset($data->phone_no) && $data->phone_no)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Last name: </strong>
                                <span>{{$data->phone_no}}</span>
                            </div>
                        </div>
                        @endif

                        @if(isset($data->relationship) && $data->relationship)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Relationship: </strong>
                                <span>{{$data->relationship}}</span>
                            </div>
                        </div>
                        @endif

                        @if(isset($data->worked_together) && $data->worked_together)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>You worked together at: </strong>
                                <span>{{$data->worked_together}}</span>
                            </div>
                        </div>
                        @endif


                        @if(isset($data->start_date) && $data->start_date)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Start Date : </strong><span>{{ \Carbon\Carbon::parse($data->start_date)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($data->end_date) && $data->end_date)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong> End Date : </strong><span>{{ \Carbon\Carbon::parse($data->end_date)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($data->position_with_referee) && $data->position_with_referee)
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>What was your position when you worked with this referee?: </strong>
                                <span>{{$data->position_with_referee}}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    <?php
                    $i++;
                    ?>
                    @endforeach
                    @else
                    <div class="col-md-12">
                        <div class="text-center text-danger fs-5">No data found</div>
                    </div>

                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
<div class="tab-pane p-3" id="navpill-5" role="tabpanel">
    <div class="row">
        <div class=" w-100  overflow-hidden">
            <div class="card-body p-3 px-md-4 pb-0">
                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Mandatory Training</h3>
            </div>
            <div class="card-body p-3 px-md-4">
                <div class="col-md-12">
                    @if($mandatorytrainingData)
                    <div class="row">
                        <h4>Completed training programs</h4>
                        @if(isset($mandatorytrainingData->start_date) && $mandatorytrainingData->start_date)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Training Start Date : </strong><span>{{ \Carbon\Carbon::parse($mandatorytrainingData->start_date)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($mandatorytrainingData->end_date) && $mandatorytrainingData->end_date)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Training End Date : </strong><span>{{ \Carbon\Carbon::parse($mandatorytrainingData->end_date)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        @endif

                        @if(isset($mandatorytrainingData->institutions) && $mandatorytrainingData->institutions)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Institution: </strong>
                                <span>{{$mandatorytrainingData->institutions}}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($mandatorytrainingData->continuing_education) && $mandatorytrainingData->continuing_education)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Mandatory Continuing Education: </strong>
                                <span>{{$mandatorytrainingData->continuing_education}}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="col-md-12">
                        <div class="text-center text-danger fs-5">No data found</div>
                    </div>

                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
<div class="tab-pane p-3" id="navpill-6" role="tabpanel">
    <div class="row">
        <div class=" w-100  overflow-hidden">
            <div class="card-body p-3 px-md-4 pb-0">
                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Vaccinations</h3>
            </div>
            <div class="card-body p-3 px-md-4">
                <div class="col-md-12">
                    @if($vaccinationData)
                    <div class="row">
                        @php
                        $vacc = [];
                        @endphp

                        @if(!empty($vaccinationData))
                        @foreach($vaccinationData as $vcdata)
                        @php $vacc[] = $vcdata->vaccination_id; @endphp
                        @endforeach
                        @endif

                        @if(count($vacc)>0)
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Vaccination Records : </strong>

                                <ul class="dropdown-list">
                                    @forelse($vaccinationData as $value)
                                    <li><span class="dropdown-item-custom">{{ vaccination_name_by_id($value->vaccination_id) }} </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif
                        <div class="vacc_rec_div">
                            <?php
                            if (!empty($vccdata)) {
                                foreach ($vccdata as $vcvalue) { ?>

                                    <div class="record_v">
                                        <h6>{{ $vcvalue->vaccination_name }}</h6>
                                        <div class="row vacc_rec_institution">
                                            <div class="form-group col-md-12">
                                                @php
                                                $vcc_level_req = DB::table("vcc_level_req")->where("type", $vcvalue->vaccination_id)->get();
                                                @endphp
                                                <label class="form-label">Level of Requirement : </label>
                                                <div>
                                                    @foreach ($vcc_level_req as $level)
                                                    <label>{{ $level->level_req }}</label><br>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="form-label">Immunization Status :</label>
                                                <label class="form-label">{{ $vcvalue->imm_status }}</label>
                                            </div>
                                            @if($vcvalue->covid_dose !=0)
                                            <div class="form-group col-md-12">
                                                <label class="form-label">How many doses of a TGA-recognised COVID-19 vaccine have you received? : </label>
                                                <label class="form-label">{{ $vcvalue->covid_dose }} dose</label>
                                            </div>
                                            @endif

                                            <div class="form-group col-md-12">
                                                <label class="form-label">Evidence Required:</label>
                                                <label class="form-label">{{ $vcvalue->evidence_type_name }}</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="form-label">Evidence : </label>
                                                <div id="fileList" class="file-list">
                                                    <?php
                                                    $getevidancedata = DB::table("evidance_file")->where("vcc_front_id", $vcvalue->id)->get();
                                                    if ($getevidancedata->isNotEmpty()) {
                                                        foreach ($getevidancedata as $vals) { ?>
                                                            <div class="file-item">
                                                                <a href="{{ asset('uploads/evidence/' . $vals->file_name) }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i> {{$vals->original_name}}</a>
                                                            </div>
                                                    <?php }
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php  }
                            } ?>
                        </div>

                        <!--[ADD OTHER VACCINE START]-->
                        <div class="row" id="vaccine-section-container">
                            <h6 class="other-vaccin">Other Vaccination </h6>
                            @php $ci = 1; @endphp
                            @if($other_vaccine)
                            @foreach($other_vaccine as $other)
                            <div class="vaccine-section">
                                <div class="col-md-12">
                                    <input type="hidden" name="other_id[]" value="{{$other->id}}">
                                    <h6>Vaccination {{$ci}}</h6>
                                    <div class="form-group level-drp">
                                        <label class="form-label" for="input-1">Vaccination Name : </label>
                                        <label class="form-label" for="input-1">{{$other->vaccination_name}} </label>
                                    </div>

                                    <div class="form-group level-drp">
                                        <label class="form-label" for="input-1">Immunization Status : </label>
                                        <label class="form-label" for="input-1">
                                            <?php
                                            $get_imm_status = DB::table("imm_status")->get();
                                            foreach ($get_imm_status as $status) {
                                                if ($other->immunization_status == $status->id) {
                                                    echo $status->name;
                                                }
                                            } ?>
                                        </label>
                                    </div>
                                    <div class="form-group level-drp">
                                        <label class="form-label" for="input-1">Evidence Type : </label>
                                        <label class="form-label" for="input-1">{{ $other->evidence_type }}</label>
                                    </div>
                                    <div class="form-group level-drp">
                                        <label class="form-label" for="input-1">Upload Evidence : </label>
                                        <div id="fileListo" class="file-list">
                                            @if($other->evidence_file!='')
                                            <div class="file-item">
                                                <a href="{{ asset('uploads/evidence/' . $other->evidence_file) }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i> {{$other->evidence_file}}</a>
                                            </div>
                                            @endif
                                        </div>
                                        <span class="reqError text-danger valley"></span>
                                    </div>
                                </div>
                            </div>
                            @php $ci++; @endphp
                            @endforeach
                            @endif
                        </div>
                        <!--[ADD OTHER VACCINE END]-->
                    </div>
                    @else
                    <div class="col-md-12">
                        <div class="text-center text-danger fs-5">No data found</div>
                    </div>

                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
<div class="tab-pane p-3" id="navpill-7" role="tabpanel">
    <div class="row">
        <div class=" w-100  overflow-hidden">
            <div class="card-body p-3 px-md-4 pb-0">
                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Work Clearances</h3>
            </div>
            <div class="card-body p-3 px-md-4">
                <div class="col-md-12">
                    @if($eligibilityToWorkData)
                    <div class="row">
                        <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Eligibility For Work : </h4>
                        @if(isset($eligibilityToWorkData->residency) && $eligibilityToWorkData->residency)

                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Residency : </strong><span>{{ $eligibilityToWorkData->residency}}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($eligibilityToWorkData->support_document) && $eligibilityToWorkData->support_document)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Support Document:</strong>
                                <a href="{{ asset($eligibilityToWorkData->support_document) }}" target="_blank">
                                    <span class="text-success">View Document</span>
                                </a>
                            </div>

                        </div>
                        @endif

                        @if(isset($eligibilityToWorkData->visa_subclass_number) && $eligibilityToWorkData->visa_subclass_number)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Visa Subclass Number : </strong>
                                <span>{{$eligibilityToWorkData->visa_subclass_number}}</span>
                            </div>
                        </div>
                        @endif

                        @if(isset($eligibilityToWorkData->passport_number) && $eligibilityToWorkData->passport_number)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Passport Number : </strong>
                                <span>{{$eligibilityToWorkData->passport_number}}</span>
                            </div>
                        </div>
                        @endif


                        @if(isset($eligibilityToWorkData->visa_grant_number) && $eligibilityToWorkData->visa_grant_number)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Visa grant number: </strong>
                                <span>{{$eligibilityToWorkData->visa_grant_number}}</span>
                            </div>
                        </div>
                        @endif

                        @if(isset($eligibilityToWorkData->passport_country_of_Issue) && $eligibilityToWorkData->passport_country_of_Issue)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Passport Country Of Issue: </strong>
                                <span>{{country_name_new($eligibilityToWorkData->passport_country_of_Issue)}}</span>
                            </div>
                        </div>
                        @endif

                        @if(isset($eligibilityToWorkData->expiry_date) && $eligibilityToWorkData->expiry_date)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry Date: </strong>
                                <span>{{$eligibilityToWorkData->expiry_date}}</span>
                            </div>
                        </div>
                        @endif
                        <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Working With Children Check : </h4>
                        @if($workingChildrenCheckData)
                        @if(isset($workingChildrenCheckData->clearance_number) && $workingChildrenCheckData->clearance_number)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Clearance Number : </strong><span>{{ $workingChildrenCheckData->clearance_number}}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($workingChildrenCheckData->state) && $workingChildrenCheckData->state)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>State: </strong><span>{{ state_name($workingChildrenCheckData->state)}}</span>
                            </div>

                        </div>
                        @endif

                        @if(isset($workingChildrenCheckData->expiry_date) && $workingChildrenCheckData->expiry_date)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Expiry Date: </strong>
                                <span>{{$workingChildrenCheckData->expiry_date}}</span>
                            </div>
                        </div>
                        @endif

                        @else
                        <div class="col-md-12">
                            <div class="text-center text-danger fs-5">No data found</div>
                        </div>

                        @endif
                        <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Police check : </h4>
                        @if($policeCheckVerificationData)
                        @if(isset($policeCheckVerificationData->date) && $policeCheckVerificationData->date)
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Date : </strong><span>{{ $policeCheckVerificationData->date}}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($policeCheckVerificationData->image) && $policeCheckVerificationData->image)
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Image : </strong>
                                <a href="{{ asset($policeCheckVerificationData->image)}}" target="_blank">
                                    <img src="{{ asset($policeCheckVerificationData->image)}}" alt="" style="height:50px;width:50px">
                                </a>
                            </div>
                        </div>
                        @endif
                        @if(isset($policeCheckVerificationData->status) && $policeCheckVerificationData->status)
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Status : </strong>
                                @if($policeCheckVerificationData->status == 1)
                                <span class="badge bg-success">Approved</span>
                                @elseif($policeCheckVerificationData->status == 2)
                                <span class="badge bg-danger">Rejected</span>
                                @else
                                @endif

                            </div>
                        </div>
                        @endif
                        @if(isset($policeCheckVerificationData->status) && $policeCheckVerificationData->status == 2)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Reason : </strong>
                                <span>{{$policeCheckVerificationData->reason}}</span>
                            </div>
                        </div>
                        @endif


                        @else
                        <div class="col-md-12">
                            <div class="text-center text-danger fs-5">No data found</div>
                        </div>

                        @endif




                    </div>
                    @else
                    <div class="col-md-12">
                        <div class="text-center text-danger fs-5">No data found</div>
                    </div>

                    @endif


                </div>

            </div>
        </div>
    </div>
</div>
<div class="tab-pane p-3" id="navpill-8" role="tabpanel">
    <div class="row">
        <div class=" w-100  overflow-hidden">
            <div class="card-body p-3 px-md-4 pb-0">
                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Professional Memberships</h3>
            </div>
            <div class="card-body p-3 px-md-4">
                <div class="col-md-12">
                    @if($proMembershipData)
                    <div class="row">
                        @if(isset($proMembershipData->des_profession_association) && $proMembershipData->des_profession_association)
                        <?php $data = json_decode($proMembershipData->des_profession_association, true) ?>
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Professional Associations : </strong>
                                <ul class="dropdown-list">
                                    @forelse($data as $key => $value)
                                    <li><span class="dropdown-item-custom">{{ $value }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom"></a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif
                        @if(isset($proMembershipData->membership_numbers) && $proMembershipData->membership_numbers)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Membership Numbers : </strong><span>{{ $proMembershipData->membership_numbers }}</span>
                            </div>
                        </div>
                        @endif

                        @if(isset($proMembershipData->membership_status) && $proMembershipData->membership_status)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Status: </strong>
                                <span>{{$proMembershipData->membership_status}}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="col-md-12">
                        <div class="text-center text-danger fs-5">No data found</div>
                    </div>

                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
<div class="tab-pane p-3" id="navpill-9" role="tabpanel">
    <div class="row">
        <div class=" w-100  overflow-hidden">
            <div class="card-body p-3 px-md-4 pb-0">
                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Interview and References</h3>
            </div>
            <div class="card-body p-3 px-md-4">
                <div class="col-md-12">
                    @if($interviewrefData)
                    <div class="row">

                        @if(isset($interviewrefData->interview_availablity) && $interviewrefData->interview_availablity)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Interview Availability : </strong><span>{{ \Carbon\Carbon::parse($interviewrefData->interview_availablity)->format('d/m/y H:i') }}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($interviewrefData->reference_name) && $interviewrefData->reference_name)
                        <h4 class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center">Professional References</h4>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Names : </strong><span>{{ $interviewrefData->reference_name }}</span>
                            </div>
                        </div>
                        @endif

                        @if(isset($interviewrefData->reference_email) && $interviewrefData->reference_email)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Email: </strong>
                                <span>{{$interviewrefData->reference_email}}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($interviewrefData->contact_country_code) && $interviewrefData->contact_country_code)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Mobile Number : </strong>
                                <span>+{{ $interviewrefData->contact_country_code }}{{ " "}}
                                    {{ $interviewrefData->reference_contact }}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($interviewrefData->reference_relationship) && $interviewrefData->reference_relationship)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Relationship : </strong>
                                <span>{{ $interviewrefData->reference_relationship }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="col-md-12">
                        <div class="text-center text-danger fs-5">No data found</div>
                    </div>

                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
<div class="tab-pane p-3" id="navpill-10" role="tabpanel">
    <div class="row">
        <div class=" w-100  overflow-hidden">
            <div class="card-body p-3 px-md-4 pb-0">
                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Personal Preferences</h3>
            </div>
            <div class="card-body p-3 px-md-4">
                <div class="col-md-12">
                    @if($personalprefData)
                    <div class="row">

                        @if(isset($personalprefData->preferred_work_schedule) && $personalprefData->preferred_work_schedule)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Preferred Work Schedule : </strong><span>{{ $personalprefData->preferred_work_schedule }}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($personalprefData->country) && $personalprefData->country)
                        <h4 class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center">Preferred Work Locations</h4>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Country : </strong><span>{{ country_name($personalprefData->country)}}</span>
                            </div>
                        </div>
                        @endif

                        @if(isset($personalprefData->state) && $personalprefData->state)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>State: </strong>
                                <span>{{ state_name($personalprefData->state)}}</span>
                            </div>
                        </div>
                        @endif

                        @if(isset($personalprefData->work_environment) && $personalprefData->work_environment)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Work Environment Preferences : </strong>
                                <span>{{ $personalprefData->work_environment }}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($personalprefData->shift_preferences) && $personalprefData->shift_preferences)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Shift Preferences : </strong>
                                <span>{{ $personalprefData->shift_preferences }}</span>
                            </div>
                        </div>
                        @endif
                        @if(isset($personalprefData->specific_facilities) && $personalprefData->specific_facilities)
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Specific Facilities : </strong>
                                <textarea name="specific_facilities" class="form-control">{{ $personalprefData->specific_facilities }}</textarea>
                            </div>
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="col-md-12">
                        <div class="text-center text-danger fs-5">No data found</div>
                    </div>

                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
<div class="tab-pane p-3" id="navpill-11" role="tabpanel">
    <div class="row">
        <div class=" w-100  overflow-hidden">
            <div class="card-body p-3 px-md-4 pb-0">
                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Find Work Preferences</h3>
            </div>
            <div class="card-body p-3 px-md-4">
                <div class="col-md-12">
                    @if($findworkData)
                    <div class="row">

                        @if(isset($findworkData->desired_job_role) && $findworkData->desired_job_role)
                        <?php
                        $desired_job_roles = json_decode($findworkData->desired_job_role);
                        ?>
                        <div class="col-md-12 mt-3">

                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Desired Job Role : </strong>
                                <ul class="dropdown-list">
                                    @forelse($desired_job_roles as $key => $desired_job_role)
                                    <li><span class="dropdown-item-custom">{{ specialty_name_by_id_NEW($desired_job_role) }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No specialties available</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @endif


                        @if(isset($findworkData->benefits_preferences) && $findworkData->benefits_preferences)
                        <div class="col-md-12 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Benefits Preferences : </strong>
                                <?php
                                $benefits_preferences = json_decode($findworkData->benefits_preferences);
                                ?>
                                <ul class="dropdown-list">
                                    @forelse($benefits_preferences as $key => $benefits_prefere)
                                    <li><span class="dropdown-item-custom">{{ $benefits_prefere }} , </span></li>
                                    @empty
                                    <li><a href="#" class="dropdown-item-custom">No specialties available</a></li>
                                    @endforelse
                                </ul>

                            </div>
                        </div>
                        @endif
                        @if(isset($findworkData->salary_expectations) && $findworkData->salary_expectations)
                        {{-- <h4 class="mt-4 fw-bolder fs-6 lh-base d-flex align-items-center">Preferred Work Locations</h4> --}}
                        <div class="col-md-6 mt-3">
                            <div class="d-flex gap-3 flex-wrap">
                                <strong>Salary Expectations : </strong><span>{{ $findworkData->salary_expectations}}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="col-md-12">
                        <div class="text-center text-danger fs-5">No data found</div>
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
@endsection
@section('js')
<script type="text/javascript"
    src="https://nextjs.webwiders.in/pindrow/public/advertiser/dist/libs/owl.carousel/dist/owl.carousel.min.js">
</script>

<script type="text/javascript"></script>
<script>
    $(document).ready(function() {
        // cate_1
        $('#cat_1').after(sugical_care);
        $('#sugical_care').after(Operating_Room);
        $('#Operating_Room').after(paediatric_oR);
        $('#paediatric_oR').after(Technician_Nurse);

        // For cat 2
        $('#cat_2').after(Surgical_Obstetrics);

        // For cat 3
        $('#cat_3').after(Neonatal_Care);
        $('#Neonatal_Care').after(Surgical_Preop);
        $('#Surgical_Preop').after(Paediatric_Operating);
        $('#Paediatric_Operating').after(Paediatric_Operating_Scout);
        $('#Paediatric_Operating_Scout').after(Paediatric_Operating_Scrub);
    });
</script>
@endsection