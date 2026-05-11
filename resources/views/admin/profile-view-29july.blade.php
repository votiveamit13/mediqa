@extends('admin.layouts.layout')
@section('content')
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
                                    <h5 class="fs-5 mb-2 fw-bolder"> {{ ucwords($profileData->name) }} </h5>
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
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills nav-fill mt-4" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#navpill-111" role="tab"
                            aria-selected="true">
                            <span>Details</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-222" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Profession Verification </span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-333" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span> Police Check Verification</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-444" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Eligibility For Work</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#navpill-555" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span>Children Work</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content border mt-2">
                    <div class="tab-pane p-3 active show" id="navpill-111" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Details </h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Do you have work rights in Austrailia? : </strong>
                                                    <span>{{ $profileData->work_right == 0 ? 'No' : 'Yes' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                <!-- specialty_name_by_id -->
                                                    <strong>Profession : </strong><span> - - - </span>
                                                </div>
                                            </div>
                    
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Practitioner type : </strong>
                                                    <!-- specialty_name_by_id -->
                                                   <span> - - -  </span>
                                                </div>
                                            </div>
                    
                    
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong> Assistant in Nursing level : </strong> <span>{{ $profileData->assistent_level}}</span>
                                                </div>
                                            </div>
                                            @if($profileData->country_code)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong> Country  : </strong> <span>{{ country_name($profileData->country_code)}}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($profileData->state)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong> State  : </strong> <span>{{ state_name($profileData->state)}}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($profileData->city)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong> City   : </strong> <span>{{ $profileData->city }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($profileData->personal_website)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>  Personal website   : </strong> <span>{{ $profileData->personal_website }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($profileData->bio)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong> Bio   : </strong> <span>{{ $profileData->bio }}</span>
                                                    </div>
                                                </div>
                                            @endif
                    
                                            @if ($profileData->specialty != 'null')
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
                                            @endif
                                        </div>
                    
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="navpill-222" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Profession Verification 
                                    </h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        @if($professionVerificationData)
                                            <div class="row">
                                                @if($professionVerificationData->profession)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Profession : </strong><span> - - - </span>
                                                    </div>
                                                </div>
                                                @endif
                                                @if($professionVerificationData->practitioner_type)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Practitioner type : </strong>
                                                    <span> - - - </span>
                                                    </div>
                                                </div>
                                                @endif

                                                @if($professionVerificationData->year_level)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong> Year Level : </strong> <span>{{  getLevelYearNameById($professionVerificationData->year_level)}}</span>
                                                    </div>
                                                </div>
                                                @endif
                                                @if($professionVerificationData->evidence_type)
                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong> Evidence Type  : </strong> <span>{{ getEvidenceTypeNameById($professionVerificationData->evidence_type)}}</span>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($professionVerificationData->evidence_of_year_level)
                                                    <div class="col-md-6 mt-3">
                                                        <div class="d-flex gap-3 flex-wrap">
                                                            <strong> Evidence Of Year Level  : </strong> 
                                                            <a href="{{ asset($professionVerificationData->evidence_of_year_level)}}" target="_blank">
                                                                <img src="{{ asset($professionVerificationData->evidence_of_year_level)}}" alt="" style="height:50px;width:50px">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(isset($professionVerificationData->status) && $professionVerificationData->status)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Status : </strong>
                                                        @if($professionVerificationData->status == 1)
                                                        <span class="badge bg-success">Approved</span>
                                                        @elseif($professionVerificationData->status == 2)
                                                        <span class="badge bg-danger">Rejected</span>
                                                        @else 
                                                        @endif
                                                  
                                                    </div>
                                                </div>
                                                @endif
                                                @if(isset($professionVerificationData->status) && $professionVerificationData->status == 2)
                                                <div class="col-md-6 mt-3">
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <strong>Reason : </strong>
                                                        <span>{{$professionVerificationData->reason}}</span>
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
                    <div class="tab-pane p-3" id="navpill-333" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center "> Police Check Verification 
                                    </h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        @if($policeCheckVerificationData)
                                            <div class="row">
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
                    <div class="tab-pane p-3" id="navpill-444" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Eligibility For Work</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                            @if($eligibilityToWorkData)
                                                <div class="row">
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
                                                            <span>{{country_name($eligibilityToWorkData->passport_country_of_Issue)}}</span>
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
                    <div class="tab-pane p-3" id="navpill-555" role="tabpanel">
                        <div class="row">
                            <div class=" w-100  overflow-hidden">
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Children Work</h3>
                                </div>
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        @if($workingChildrenCheckData)
                                        <div class="row">
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
@endsection
