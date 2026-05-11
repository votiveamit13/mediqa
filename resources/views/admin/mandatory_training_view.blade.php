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
                                <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Mandatory Training and Continuing Education</h3>
                            </div>
                            <div class="card-body p-3 px-md-4">
                                @if (!empty($trainingData))
                                <?php
                                    if(!empty($trainingData)){
                                        $organization_data = json_decode($trainingData->training_data);
                                        
                                    }else{
                                        $organization_data = array(); 
                                    }
                                    
                                    
                                    $o_data = (array)$organization_data;
                                    $p_memb_arr = array();

                                    if(!empty($organization_data)){
                                        foreach ($organization_data as $p_memb) {
                                        
                                        //print_r($p_memb);
                                            $p_memb_arr[] = array_search($p_memb, (array)$organization_data);
                                        
                                        }
                                    }
                                
                                ?>
                               
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Completed Mandatory Training</label>
                                    <div>
                                        @foreach($p_memb_arr as $p_memb)
                                        <?php
                                            $training_name = DB::table("man_training_category")->where("id",$p_memb)->first();
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $training_name->name }}</span>
                                        @endforeach
                                    </div>
                                </div>   
                                @foreach ($p_memb_arr as $p_arr)
                                <?php
                                    //print_r($o_data[$p_arr]);
                                    $country_name = DB::table("man_training_category")->where("id",$p_arr)->first();
                                    
                                    $os_data = (array)$o_data[$p_arr];
                                    $sub_count_arr = array();
        
                                    foreach ($os_data as $p_memb) {
                                        $sub_count_arr[] = array_search($p_memb, $os_data);
                                    }
                                    
                                ?>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">{{ $country_name->name }}</label>
                                    <div>
                                        @foreach($sub_count_arr as $p_memb)
                                        <?php
                                            $training_name = DB::table("man_training_category")->where("id",$p_memb)->first();
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $training_name->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                @foreach ($sub_count_arr as $p_arr1)
                                <?php

                                    $country_name = DB::table("man_training_category")->where("id",$p_arr1)->first();
                                    
                                    $oss_data = (array)$os_data[$p_arr1];
                                    //print_r($oss_data['institution']);die;
                                ?>
                                <h5>{{ $country_name->name }}</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Institution/Regulating Body:</strong>
                                        <span>
                                            {{ $oss_data['institution'] }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Training Start Date:</strong>
                                        <span>
                                            {{ $oss_data['training_start_date'] }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Training End Date:</strong>
                                        <span>
                                            {{ $oss_data['training_end_date'] }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Expiry:</strong>
                                        <span>
                                            {{ $oss_data['training_expiry_date'] }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Upload Certificate:</strong>
                                        <ul>
                                            <?php
                                                if(isset($oss_data['evidence_imgs']) && $oss_data['evidence_imgs']){
                                                    $evidence_imgs = (array)json_decode($oss_data['evidence_imgs']);
                                                    
                                                    //print_r($evidence_imgs);die;
                                                    $i = 0;
                                                    ?>
                                                    @if(!empty($evidence_imgs))
                                                    @foreach ($evidence_imgs as $ev_img)
                                                    <li>
                                                        
                                                        <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank" style="color: #000000; text-decoration: none;">
                                                            📄 {{ $ev_img }}
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                    @endif
                                            <?php
                                                }
                                            
                                            ?>
                                            
                                        
                                        </ul>
                                        
                                    </div>
                                </div>
                                @endforeach
                                <h4>Other Trainings</h4>
                                <?php
                                if (!empty($trainingData)) {
                                  $additional_tra_data = json_decode($trainingData->other_tra_data);
                                } else {
                                  $additional_tra_data = "";
                                }
                                $i = 1;
                                $l = 0;
                                ?>
                                <div class="row">
                                    @if(!empty($additional_tra_data))
                                    @foreach($additional_tra_data as $a_data)
                                    
                                    <div class="col-md-6">
                                        <strong>Training {{ $i }}:</strong>
                                        <span>
                                            {{ $a_data->training_name }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Institution/Regulating Body:</strong>
                                        <span>
                                            {{ $a_data->training_ins }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Training Start Date:</strong>
                                        <span>
                                            {{ $a_data->training_start_date }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Training End Date:</strong>
                                        <span>
                                            {{ $a_data->training_end_date }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Expiry:</strong>
                                        <span>
                                            {{ $a_data->tra_exp }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Upload your certification/Licence:</strong>
                                        <?php
                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $trainingData->user_id)->first();
                
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
                                            
                                        ?>
                                        <ul>
                                            
                                        @if(!empty($other_tra_img_data))
                                        @foreach ($other_tra_img_data as $ev_img)
                                        <li>
                                            
                                            <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank" style="color: #000000; text-decoration: none;">
                                                📄 {{ $ev_img }}
                                            </a>
                                        </li>
                                        @endforeach
                                        @endif
                                            
                                        </ul>
                                        
                                    </div>
                                    
                                    @endforeach
                                    @endif
                                    <?php
                                        $i++;
                                    ?>
                                    @endforeach
                                </div>
                                <h4>Mandatory Continuing Education</h4>
                                <?php
                                    
                                    
                                    if(!empty($trainingData)){
                                      $organization_data = json_decode($trainingData->education_data);
                                      
                                    }else{
                                      $organization_data = array(); 
                                    }
                                    
                                    
                                    $o_data = (array)$organization_data;
                                    $p_memb_arr = array();

                                    if(!empty($organization_data)){
                                      foreach ($organization_data as $p_memb) {
                                      
                                        //print_r($p_memb);
                                        $p_memb_arr[] = array_search($p_memb, (array)$organization_data);
                                        
                                      }
                                    }
                                    
                                    
                                ?>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Education Name</label>
                                    <div>
                                        @foreach($p_memb_arr as $p_memb)
                                        <?php
                                            $training_name = DB::table("man_training_category")->where("id",$p_memb)->first();
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $training_name->name }}</span>
                                        @endforeach
                                    </div>
                                </div>   
                                @foreach ($p_memb_arr as $p_arr)
                                <?php
                                    //print_r($o_data[$p_arr]);
                                    $country_name = DB::table("man_training_category")->where("id",$p_arr)->first();
                                    
                                    $os_data = (array)$o_data[$p_arr];
                                    $sub_count_arr = array();
        
                                    foreach ($os_data as $p_memb) {
                                        $sub_count_arr[] = array_search($p_memb, $os_data);
                                    }
                                    
                                ?>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">{{ $country_name->name }}</label>
                                    <div>
                                        @foreach($sub_count_arr as $p_memb)
                                        <?php
                                            $training_name = DB::table("man_training_category")->where("id",$p_memb)->first();
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $training_name->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                @foreach ($sub_count_arr as $p_arr1)
                                <?php

                                    $country_name = DB::table("man_training_category")->where("id",$p_arr1)->first();
                                    
                                    $oss_data = (array)$os_data[$p_arr1];
                                    //print_r($oss_data['institution']);die;
                                ?>
                                <h5>{{ $country_name->name }}</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Institution/Regulating Body:</strong>
                                        <span>
                                            {{ $os_data[$p_arr1]->institution }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Start Date:</strong>
                                        <span>
                                            {{ $os_data[$p_arr1]->start_date }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>End Date:</strong>
                                        <span>
                                            {{ $os_data[$p_arr1]->end_date }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Status:</strong>
                                        <span>
                                            {{ $os_data[$p_arr1]->status }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Expiry:</strong>
                                        <span>
                                            {{ $os_data[$p_arr1]->expiry_date }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Upload Certificate:</strong>
                                        <ul>
                                            <?php
                                                if(isset($os_data['evidence_imgs']) && $os_data['evidence_imgs']){
                                                    $evidence_imgs = (array)json_decode($os_data['evidence_imgs']);
                                                    
                                                    //print_r($evidence_imgs);die;
                                                    $i = 0;
                                                    ?>
                                                    @if(!empty($evidence_imgs))
                                                    @foreach ($evidence_imgs as $ev_img)
                                                    <li>
                                                        
                                                        <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank" style="color: #000000; text-decoration: none;">
                                                            📄 {{ $ev_img }}
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                    @endif
                                            <?php
                                                }
                                            
                                            ?>
                                            
                                        
                                        </ul>
                                        
                                    </div>
                                </div>
                                @endforeach
                                @endforeach
                                <h4>Other Continuing Education</h4>
                                <?php
                                    if (!empty($trainingData)) {
                                        $additional_edu_data = json_decode($trainingData->other_edu_data);
                                    } else {
                                        $additional_edu_data = "";
                                    }
                                    $i = 1;
                                   
                                
                                ?>
                                <div class="row">
                                    @if(!empty($additional_edu_data))
                                    @foreach($additional_edu_data as $edu_data)
                                    
                                    <div class="col-md-6">
                                        <strong>Course/Workshop {{ $i }}:</strong>
                                        <span>
                                            {{ $edu_data->education_name }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Institution/Regulating Body:</strong>
                                        <span>
                                            {{ $edu_data->education_ins }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Start Date:</strong>
                                        <span>
                                            {{ $edu_data->education_start_date }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>End Date:</strong>
                                        <span>
                                            {{ $edu_data->education_end_date }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Status:</strong>
                                        <span>
                                            {{ $edu_data->education_status }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Expiry:</strong>
                                        <span>
                                            {{ $edu_data->education_exp }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Upload your certification/Licence:</strong>
                                        <?php
                                            $getedufieldsdata = DB::table("edu_fields")->where("user_id", $trainingData->user_id)->first();
                
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
                                            
                                        ?>
                                        <ul>
                                            
                                        @if(!empty($ano_education_img_data))
                                        @foreach ($ano_education_img_data as $ev_img)
                                        <li>
                                            
                                            <a href="{{ url("/public") }}/uploads/education_degree/{{ $ev_img }}" target="_blank" style="color: #000000; text-decoration: none;">
                                                📄 {{ $ev_img }}
                                            </a>
                                        </li>
                                        @endforeach
                                        @endif
                                            
                                        </ul>
                                        
                                    </div>
                                    <?php
                                        $i++;
                                    ?>
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
        </div>
    </div>
</div>

@endsection