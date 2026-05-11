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
                <div class="tab-pane fade" id="tab-my-profile-setting" style="display: block;opacity:1;">
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
                                        @if(isset($data->end_date) && $data->end_date && $data->still_working != 1)
                                        <div class="col-md-6 mt-3">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <strong> End Date : </strong><span>{{ \Carbon\Carbon::parse($data->end_date)->format('d/m/Y') }}</span>
                                            </div>
                                        </div>
                                        @endif
                                        @if(isset($data->position_with_referee) && $data->position_with_referee)
                                        <div class="col-md-12 mt-3 mb-3">
                                            <label class="form-label">What was your position when you worked with this referee?: </label>
                                            <?php
                                                $position_referee = (array)json_decode($data->position_with_referee);

                                                $pos_refree_arr = array();

                                                if(!empty($position_referee)){
                                                    foreach ($position_referee as $index => $pos_referee) {
                                                        $pos_refree_arr[] = $index;
                                                    }
                                                }
                                                //print_r($pos_refree_arr);
                                                
                                            ?>
                                            
                                            <div>
                                            @foreach ($pos_refree_arr as $pos_referee)   
                                            <?php
                                                $pos_referee_name = DB::table("employee_positions")->where("position_id",$pos_referee)->first();
                                            ?>
                                            <span class="badge bg-dark me-1">{{ $pos_referee_name->position_name }}</span>
                                            
                                            @endforeach
                                            </div>
                                            {{-- <div class="mb-1">{{ $sublanguage_name->language_name }}: <strong>{{ $prof_level[0] }}</strong></div> --}}
                                        </div>
                                        @endif
                                        @foreach ($pos_refree_arr as $pos_referee)   
                                        <?php
                                            $pos_referee_name = DB::table("employee_positions")->where("position_id",$pos_referee)->first();
                                            $subpos_referee = $position_referee[$pos_referee];

                                            //print_r($subpos_referee);
                                        ?>
                                        
                                        <div class="col-md-12 mt-3 mb-3">
                                            <label class="form-label">{{ $pos_referee_name->position_name }} </label>
                                            
                                            <div>
                                                @foreach($subpos_referee as $subpos)   
                                                <?php
                                                    $pos_referee_name = DB::table("employee_positions")->where("position_id",$subpos)->first();
                                                ?> 
                                                <span class="badge bg-dark me-1">{{ $pos_referee_name->position_name }}</span>
                                                
                                                @endforeach
                                            </div>
                                            
                                        </div>
                                        
                                        
                                        @endforeach    
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
            </div>
        </div>
    </div>
</div>

@endsection