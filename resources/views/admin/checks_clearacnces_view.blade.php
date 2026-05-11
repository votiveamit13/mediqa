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
                    <div class="row">
                        <div class=" w-100  overflow-hidden">
                            <div class="card-body p-3 px-md-4 pb-0">
                                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Checks and Clearances</h3>
                            </div>
                            <div class="card-body p-3 px-md-4">
                                <div class="col-md-12">
                                    
                                    <div class="row">
                                        @if($work_eligibility)
                                        <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Residency and Work Eligibility : </h4>
                                        @if(isset($work_eligibility->residency) && $work_eligibility->residency)

                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>Residency : </strong><span>{{ $work_eligibility->residency}}</span>
                                            </div>
                                        </div>
                                        @endif

                                        @if(isset($work_eligibility->passport_number) && $work_eligibility->passport_number)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>Passport Number : </strong>
                                                <span>{{$work_eligibility->passport_number}}</span>
                                            </div>
                                        </div>
                                        @endif

                                        @if(isset($work_eligibility->country_name) && $work_eligibility->country_name)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>Passport Country Of Issue: </strong>
                                                <span>{{$work_eligibility->country_name}}</span>
                                            </div>
                                        </div>
                                        @endif

                                        @if(isset($work_eligibility->sublcass_text) && $work_eligibility->sublcass_text)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>Visa Subclass Number : </strong>
                                                <span>{{$work_eligibility->sublcass_text}}</span>
                                            </div>
                                        </div>
                                        @endif

                                        @if(isset($work_eligibility->other_visa_type) && $work_eligibility->other_visa_type)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>Other Visa Type: </strong>
                                                <span>{{$work_eligibility->other_visa_type}}</span>
                                            </div>
                                        </div>
                                        @endif

                                        @if(isset($work_eligibility->visa_grant_number) && $work_eligibility->visa_grant_number)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>Visa grant number: </strong>
                                                <span>{{$work_eligibility->visa_grant_number}}</span>
                                            </div>
                                        </div>
                                        @endif

                                        @if(isset($work_eligibility->evidence_type) && $work_eligibility->evidence_type)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>Evience Type: </strong>
                                                <span>{{$work_eligibility->evidence_type}}</span>
                                            </div>
                                        </div>
                                        @endif

                                        @if(isset($work_eligibility->support_document) && $work_eligibility->support_document)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>Support Document:</strong>
                                                <a href="{{ asset('uploads/support_document/'.$work_eligibility->support_document) }}" target="_blank">
                                                    <span class="text-success">View Document</span>
                                                </a>
                                            </div>

                                        </div>
                                        @endif
                                        @else
                                        <div class="col-md-12">
                                            <div class="text-center text-danger fs-5">No data found</div>
                                        </div>

                                        @endif
                                        
                                        @if($ndis)
                                        <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">NDIS Worker Screening Check : </h4>
                                        @if(isset($ndis->state_id) && $ndis->state_id)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>State: </strong><span>{{ state_name($ndis->state_id)}}</span>
                                            </div>
                                        </div>
                                        @endif

                                        @if(isset($ndis->clearance_number) && $ndis->clearance_number)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>NDIS Worker Clearance Number: </strong><span>{{ $ndis->clearance_number}}</span>
                                            </div>
                                        </div>
                                        @endif

                                        @if(isset($ndis->expiry_date) && $ndis->expiry_date)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>Expiry date: </strong><span>{{ $ndis->expiry_date}}</span>
                                            </div>
                                        </div>
                                        @endif

                                        @if(isset($ndis->evidence_file) && $ndis->evidence_file)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>Support Document:</strong>
                                                <a href="{{ asset('uploads/support_document/'.$ndis->evidence_file) }}" target="_blank">
                                                    <span class="text-success">View Document</span>
                                                </a>
                                            </div>
                                        </div>
                                        @endif

                                        @else
                                        <div class="col-md-12">
                                            <div class="text-center text-danger fs-5">No data found</div>
                                        </div>

                                        @endif

                                        @if($ww_child)
                                        <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Working With Children Check : </h4>
                                        @foreach($ww_child as $child)
                                            
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>State: </strong><span>{{ state_name($child->state_id)}}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Clearance Number : </strong><span>{{ $child->clearance_number}}</span>
                                                </div>
                                            </div>   

                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Expiry Date: </strong> <span>{{$child->expiry_date}}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Support Document:</strong>
                                                    <a href="{{ asset('uploads/support_document/'.$child->wwcc_evidence) }}" target="_blank">
                                                        <span class="text-success">View Document</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                        @else
                                        <div class="col-md-12">
                                            <div class="text-center text-danger fs-5">No data found</div>
                                        </div>

                                        @endif


                                        @if($policy_check)
                                        <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Police check : </h4>
                                        
                                        @if(isset($policy_check->issuance_date) && $policy_check->issuance_date)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>Date : </strong><span>{{ $policy_check->issuance_date}}</span>
                                            </div>
                                        </div>
                                        @endif

                                        @if(isset($policy_check->evidence_file) && $policy_check->evidence_file)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>Police Clearance : </strong>
                                                <a href="{{ asset('uploads/support_document/'.$policy_check->evidence_file)}}" target="_blank">
                                                    <img src="{{ asset('uploads/support_document/'.$policy_check->evidence_file)}}" alt="" style="height:50px;width:50px">
                                                </a>
                                            </div>
                                        </div>
                                        @endif
                                                                
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>Status : </strong>
                                                @if($policy_check->status == 1)
                                                <span class="badge bg-success">Approvedee</span>
                                                @elseif($policy_check->status == 0)
                                                <span class="badge bg-danger">Pending</span>
                                                @elseif($policy_check->status == 2)
                                                <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        @if(isset($policy_check->status) && $policy_check->status == 2)
                                        <div class="col-md-12 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong>Reason : </strong>
                                                <span>{{$policy_check->reason}}</span>
                                            </div>
                                        </div>
                                        @endif
                                        @else
                                        <div class="col-md-12">
                                            <div class="text-center text-danger fs-5">No data found</div>
                                        </div>
                                        @endif


                                        @if($specialize)
                                        <h4 class="fw-bolder fs-6 lh-base d-flex align-items-center mt-3">Specialized Clearances : </h4>
                                        @foreach($specialize as $specialized)

                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>State: </strong><span>{{ state_name($specialized->clearance_state)}}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Specialized Clearance type: </strong> <span>{{$specialized->clearance_type}}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Specialized Clearance Number: </strong> <span>{{$specialized->clearance_number}}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Expiry Date: </strong> <span>{{$specialized->clearance_expiry_date}}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="d-flex gap-3 flex-wrap">
                                                    <strong>Support Document:</strong>
                                                    <a href="{{ asset('uploads/support_document/'.$specialized->clearance_evidence) }}" target="_blank">
                                                        <span class="text-success">View Document</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <hr>
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
            </div>
        </div>
    </div>
</div>

@endsection