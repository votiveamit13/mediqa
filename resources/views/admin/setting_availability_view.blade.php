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
                            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Setting & Availability</h3>
                        </div>
                        <div class="card-body p-3 px-md-4">
                            <div class="col-md-12">
                                <div class="row">
                                    @if (!empty($profileData))
                                        
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                {{-- <strong>Do you have work rights in Austrailia? : </strong>
                                                    <span>{{ $profileData->work_right == 0 ? 'No' : 'Yes' }}</span> --}}
                                                <strong>User profile is visible for:</strong>
                                                <span>
                                                    @if($profileData->medical_facilities == "Yes")
                                                    Healthcare Facilities
                                                    @endif
                                                    @if($profileData->agencies == "Yes")
                                                    Agencies
                                                    @endif
                                                    @if($profileData->individuals == "Yes")
                                                    Individuals
                                                    @endif
                                                </span>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                {{-- <strong>Do you have work rights in Austrailia? : </strong>
                                                    <span>{{ $profileData->work_right == 0 ? 'No' : 'Yes' }}</span> --}}
                                                <strong>Profile Status:</strong>
                                                <span>
                                                    
                                                    @if($profileData->profile_status1 == 1)
                                                    Available Now
                                                    @else
                                                    Unavailable for now
                                                    @endif
                                                    
                                                </span>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            @if($profileData->profile_status1 == 1)
                                            <h5>If available</h5>
                                            <div class="d-flex gap-3 flex-wrap">
                                                <div class="user_status">
                                                    <strong>Availability:</strong>
                                                    <span>{{ $profileData->start_job_dropdown }}</span>
                                                </div>
                                                
                                            </div>
                                            @endif
                                            @if($profileData->profile_status1 == 0)
                                            <h5>If unavailable</h5>
                                            <div class="d-flex gap-3 flex-wrap">
                                                <div class="user_status">
                                                    <strong>Availability Start Date:</strong>
                                                    <span>{{ $profileData->available_date }}</span>
                                                </div>
                                                
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                {{-- <strong>Do you have work rights in Austrailia? : </strong>
                                                    <span>{{ $profileData->work_right == 0 ? 'No' : 'Yes' }}</span> --}}
                                                <strong>Any Help:</strong>
                                                <span>
                                                    @if($profileData->any_help)
                                                    <?php
                                                        $any_help = json_decode($profileData->any_help);
                                                        $help1 = '';
                                                        foreach($any_help as $help){
                                                            $help1 .= $help.", ";
                                                        }
                                                        echo $help1 = rtrim($help1, ', ');
                                                    ?>
                                                    
                                                    @endif
                                                    
                                                </span>
                                                
                                            </div>
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