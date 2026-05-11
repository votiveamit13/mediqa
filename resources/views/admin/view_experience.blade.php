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
                            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Experience</h3>
                        </div>
                        <div class="card-body p-3 px-md-4">
                            <?php $i = 1; ?>
                            @if(!empty($experienceData))
                            @foreach ($experienceData as $exp_data)
                            <div class="exp_details">
                                <h5>Work Experience {{ $i }}</h5>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Facility / Workplace Type</label>
                                    <?php
                                        
                                        
                                        $facility_type = (array)json_decode($exp_data->facility_workplace_type);

                                        //print_r($facility_type);

                                        $p_memb_arr = array();

                                        if(!empty($facility_type)){
                                            foreach ($facility_type as $index => $p_memb) {
                                            
                                                //print_r($p_memb);
                                                $p_memb_arr[] = $index;
                                                
                                            }
                                        }

                                        
                                        
                                    ?>
                                    <div>
                                    @foreach($p_memb_arr as $p_arr)    
                                    <?php
                                        $facdata = DB::table("work_enviornment_preferences")->where("prefer_id",$p_arr)->first();
                                    ?>
                                    <span class="badge bg-dark me-1">{{ $facdata->env_name }}</span>
                                    
                                    @endforeach
                                    </div>
                                </div>
                                @foreach ($p_memb_arr as $p_arr)
                                <?php
                                    $subface_data = (array)$facility_type[$p_arr];
                                    
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
                                    
                                ?>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">{{ $environment_name->env_name }}</label>
                                    
                                    <div>
                                    @foreach($p_memb_arr as $p_arr)    
                                    <?php
                                        $facdata = DB::table("work_enviornment_preferences")->where("prefer_id",$p_arr)->first();
                                    ?>
                                    <span class="badge bg-dark me-1">{{ $facdata->env_name }}</span>
                                    
                                    @endforeach
                                    </div>
                                </div>     
                                @if(array_key_exists(0, $subface_data) == false)
                                @if(!empty($p_memb_arr))
                                @foreach ($p_memb_arr as $p_arr1)
                                <?php
                                    $subface_data1 = $subface_data[$p_arr1];
                                    
                                    $environment_name = DB::table("work_enviornment_preferences")->where("prefer_id",$p_arr1)->first();
                                    
                                ?>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">{{ $environment_name->env_name }}</label>
                                    <div>
                                    @foreach($subface_data1 as $sub_data)
                                    <?php
                                        $environment_name = DB::table("work_enviornment_preferences")->where("prefer_id",$sub_data)->first();   
                                    ?>
                                    <span class="badge bg-dark me-1">{{ $environment_name->env_name }}</span>
                                    @endforeach
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                @endif
                                @endforeach
                                <div class="row">
                                    <div class="col-md-12 registration_no">
                                        <strong>Facility / Workplace Name:</strong>
                                        <span>{{ $exp_data->facility_workplace_name }}</span>
                                    </div>
                                </div>
                                <div class="nurse_type_view mt-3">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Type of Nurse?</label>
                                        <?php
                                            $nurse_type = (array)json_decode($exp_data->nurseType);
                                        ?>
                                        <div>
                                        @foreach($nurse_type as $ntype)
                                        <?php
                                            $ntype_name = DB::table("practitioner_type")->where("id",$ntype)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $ntype_name->name }}</span>
                                        @endforeach
                                        </div>
                                    </div>
                                    @if($exp_data->entry_level_nursing != "null")
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Entry level nursing</label>
                                        <?php
                                            $entry_level_nursing = (array)json_decode($exp_data->entry_level_nursing);
                                        ?>
                                        <div>
                                        @foreach($entry_level_nursing as $entry_type)
                                        <?php
                                            $ntype_name = DB::table("practitioner_type")->where("id",$entry_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $ntype_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->registered_nurses != "null")
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Registered Nurses (RNs)</label>
                                        <?php
                                            $registered_nursing = (array)json_decode($exp_data->registered_nurses);
                                        ?>
                                        <div>
                                        @foreach($registered_nursing as $registered_type)
                                        <?php
                                            $ntype_name = DB::table("practitioner_type")->where("id",$registered_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $ntype_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->advanced_practioner != "null")
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Advanced Practice Registered Nurses (APRNs)</label>
                                        <?php
                                            $advanced_nursing = (array)json_decode($exp_data->advanced_practioner);
                                        ?>
                                        <div>
                                        @foreach($advanced_nursing as $advanced_type)
                                        <?php
                                            $ntype_name = DB::table("practitioner_type")->where("id",$advanced_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $ntype_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->nurse_prac != "null")
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nurse Practitioner (NP)</label>
                                        <?php
                                            $nurse_prac_nursing = (array)json_decode($exp_data->nurse_prac);
                                        ?>
                                        <div>
                                        @foreach($nurse_prac_nursing as $nurse_prac_type)
                                        <?php
                                            $ntype_name = DB::table("practitioner_type")->where("id",$nurse_prac_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $ntype_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->specialties != "null")
                                    <div class="mb-3 mt-5">
                                        <label class="form-label fw-semibold">Specialties</label>
                                        <?php
                                            $specialties = (array)json_decode($exp_data->specialties);
                                        ?>
                                        <div>
                                        @foreach($specialties as $specialties_type)
                                        <?php
                                            $specialties_name = DB::table("speciality")->where("id",$specialties_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $specialties_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->adults != "null")
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Adults</label>
                                        <?php
                                            $adults = (array)json_decode($exp_data->adults);
                                        ?>
                                        <div>
                                        @foreach($adults as $adults_type)
                                        <?php
                                            $specialties_name = DB::table("speciality")->where("id",$adults_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $specialties_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->surgical_preoperative != "null")
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Surgical Preoperative and Postoperative Care</label>
                                        <?php
                                            $surgical_preoperative = (array)json_decode($exp_data->surgical_preoperative);
                                        ?>
                                        <div>
                                        @foreach($surgical_preoperative as $adults_type)
                                        <?php
                                            $specialties_name = DB::table("speciality")->where("id",$adults_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $specialties_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->operating_room != "null")
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Operating Room (OR)</label>
                                        <?php
                                            $operating_room = (array)json_decode($exp_data->operating_room);
                                        ?>
                                        <div>
                                        @foreach($operating_room as $adults_type)
                                        <?php
                                            $specialties_name = DB::table("speciality")->where("id",$adults_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $specialties_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->operating_room_scout != "null")
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Operating Room (OR): Scout (Circulating Nurse)</label>
                                        <?php
                                            $operating_room_scout = (array)json_decode($exp_data->operating_room_scout);
                                        ?>
                                        <div>
                                        @foreach($operating_room_scout as $adults_type)
                                        <?php
                                            $specialties_name = DB::table("speciality")->where("id",$adults_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $specialties_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->operating_room_scrub != "null")
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Operating Room (OR): Scrub (Technician Nurse)</label>
                                        <?php
                                            $operating_room_scrub = (array)json_decode($exp_data->operating_room_scrub);
                                        ?>
                                        <div>
                                        @foreach($operating_room_scrub as $adults_type)
                                        <?php
                                            $specialties_name = DB::table("speciality")->where("id",$adults_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $specialties_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->maternity != "null")
                                    <div class="mb-3 mt-5">
                                        <label class="form-label fw-semibold">Maternity OB/GYN/MFM</label>
                                        <?php
                                            $maternity = (array)json_decode($exp_data->maternity);
                                        ?>
                                        <div>
                                        @foreach($maternity as $adults_type)
                                        <?php
                                            $specialties_name = DB::table("speciality")->where("id",$adults_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $specialties_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->surgical_obstrics_gynacology != "null")
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Surgical Obstetrics and Gynecology (OB/GYN)</label>
                                        <?php
                                            $surgical_obstrics_gynacology = (array)json_decode($exp_data->surgical_obstrics_gynacology);
                                        ?>
                                        <div>
                                        @foreach($surgical_obstrics_gynacology as $adults_type)
                                        <?php
                                            $specialties_name = DB::table("speciality")->where("id",$adults_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $specialties_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->paediatrics_neonatal != "null")
                                    <div class="mb-3 mt-5">
                                        <label class="form-label fw-semibold">Paediatrics Neonatal Perinatal</label>
                                        <?php
                                            $paediatrics_neonatal = (array)json_decode($exp_data->paediatrics_neonatal);
                                        ?>
                                        <div>
                                        @foreach($paediatrics_neonatal as $adults_type)
                                        <?php
                                            $specialties_name = DB::table("speciality")->where("id",$adults_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $specialties_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->neonatal_care != "null")
                                    <div class="mb-3 mt-5">
                                        <label class="form-label fw-semibold">Paediatrics Neonatal Perinatal</label>
                                        <?php
                                            $neonatal_care = (array)json_decode($exp_data->neonatal_care);
                                        ?>
                                        <div>
                                        @foreach($neonatal_care as $adults_type)
                                        <?php
                                            $specialties_name = DB::table("speciality")->where("id",$adults_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $specialties_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->pad_op_room != "null")
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Paediatric Operating Room (OR)</label>
                                        <?php
                                            $pad_op_room = (array)json_decode($exp_data->pad_op_room);
                                        ?>
                                        <div>
                                        @foreach($pad_op_room as $adults_type)
                                        <?php
                                            $specialties_name = DB::table("speciality")->where("id",$adults_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $specialties_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->pad_qr_scout != "null")
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Paediatric OR: Scout (Circulating Nurse)</label>
                                        <?php
                                            $pad_qr_scout = (array)json_decode($exp_data->pad_qr_scout);
                                        ?>
                                        <div>
                                        @foreach($pad_qr_scout as $adults_type)
                                        <?php
                                            $pad_qr_scout = DB::table("speciality")->where("id",$adults_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $specialties_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->pad_qr_scrub != "null")
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Paediatric OR: Scrub (Technician Nurse)</label>
                                        <?php
                                            $pad_qr_scrub = (array)json_decode($exp_data->pad_qr_scrub);
                                        ?>
                                        <div>
                                        @foreach($pad_qr_scrub as $adults_type)
                                        <?php
                                            $pad_qr_scout = DB::table("speciality")->where("id",$adults_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $specialties_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    @if($exp_data->community != "null")
                                    <div class="mb-3 mt-5">
                                        <label class="form-label fw-semibold">Community</label>
                                        <?php
                                            $community = (array)json_decode($exp_data->community);
                                        ?>
                                        <div>
                                        @foreach($community as $adults_type)
                                        <?php
                                            $specialties_name = DB::table("speciality")->where("id",$adults_type)->first();   
                                        ?>
                                        <span class="badge bg-dark me-1">{{ $specialties_name->name }}</span>
                                        @endforeach
                                        </div> 
                                    </div>       
                                    @endif
                                    <div class="col-md-12">
                                        <strong>What is your Level of experience in this specialty?:</strong>
                                        <span>
                                            {{ $exp_data->assistent_level }} {{ $exp_data->assistent_level == 1 ? 'st' : ($exp_data->assistent_level == 2 ? 'nd' : ($exp_data->assistent_level == 3 ? 'rd' : 'th')) }} Year
                                        </span> 
                                    </div>  
                                    @if(isset($exp_data->position_held) && $exp_data->position_held)
                                    <div class="col-md-12 mt-3 mb-3">
                                        <label class="form-label">Position Held </label>
                                        <?php
                                            $position_referee = (array)json_decode($exp_data->position_held);

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
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Employment Start Date:</strong>
                                        <span>
                                            {{ $exp_data->employeement_start_date }}
                                        </span> 
                                    </div>   
                                    @if($exp_data->pre_box_status != 1)
                                    <div class="col-md-6">
                                        <strong>Employment End Date:</strong>
                                        <span>
                                            {{ $exp_data->employeement_end_date }}
                                        </span> 
                                    </div> 
                                    @endif  
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <strong>Employment type:</strong>
                                        <span>
                                            {{ $exp_data->employeement_type }}
                                        </span> 
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Permanent:</strong>
                                        <span>
                                            {{ $exp_data->permanent_status }}
                                        </span> 
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Temporary:</strong>
                                        <span>
                                            {{ $exp_data->temporary_status }}
                                        </span> 
                                    </div>
                                </div>
                                <h6 class="mt-3">Detailed Job Descriptions</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Responsibilities:</strong>
                                        <span>
                                            {{ $exp_data->responsiblities }}
                                        </span> 
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Achievements:</strong>
                                        <span>
                                            {{ $exp_data->achievements }}
                                        </span> 
                                    </div>
                                    
                                </div>
                                <h6 class="mt-3">Areas of Expertise</h6>
                                
                                @if($exp_data->skills_compantancies != "null")
                                
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Specific skills and competencies</label>
                                    <?php
                                        $skills_compantancies = (array)json_decode($exp_data->skills_compantancies);
                                    ?>
                                    <div>
                                    @foreach($skills_compantancies as $skills_compantancies_type)
                                    <?php
                                        $skills_name = DB::table("skills")->where("id",$skills_compantancies_type)->first();   
                                    ?>
                                    <span class="badge bg-dark me-1">{{ $skills_name->name }}</span>
                                    @endforeach
                                    </div> 
                                </div>       
                                @endif
                                @if($exp_data->inter_and_em_skill != "null")
                                
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Interpersonal and Emotional Skills</label>
                                    <?php
                                        $skills_compantancies = (array)json_decode($exp_data->inter_and_em_skill);
                                    ?>
                                    <div>
                                    @foreach($skills_compantancies as $skills_compantancies_type)
                                    <?php
                                        $skills_name = DB::table("skills")->where("id",$skills_compantancies_type)->first();   
                                    ?>
                                    <span class="badge bg-dark me-1">{{ $skills_name->name }}</span>
                                    @endforeach
                                    </div> 
                                </div>       
                                @endif
                                @if($exp_data->org_and_any_skill != "null")
                                
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Organizational and Analytical Skills</label>
                                    <?php
                                        $skills_compantancies = (array)json_decode($exp_data->org_and_any_skill);
                                    ?>
                                    <div>
                                    @foreach($skills_compantancies as $skills_compantancies_type)
                                    <?php
                                        $skills_name = DB::table("skills")->where("id",$skills_compantancies_type)->first();   
                                    ?>
                                    <span class="badge bg-dark me-1">{{ $skills_name->name }}</span>
                                    @endforeach
                                    </div> 
                                </div>       
                                @endif
                                @if($exp_data->lead_and_ment_skill != "null")
                                
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Leadership and Mentorship Skills</label>
                                    <?php
                                        $skills_compantancies = (array)json_decode($exp_data->lead_and_ment_skill);
                                    ?>
                                    <div>
                                    @foreach($skills_compantancies as $skills_compantancies_type)
                                    <?php
                                        $skills_name = DB::table("skills")->where("id",$skills_compantancies_type)->first();   
                                    ?>
                                    <span class="badge bg-dark me-1">{{ $skills_name->name }}</span>
                                    @endforeach
                                    </div> 
                                </div>       
                                @endif
                                @if($exp_data->tech_and_soft_pro != "null")
                                
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Technology and Software Proficiency</label>
                                    <?php
                                        $skills_compantancies = (array)json_decode($exp_data->tech_and_soft_pro);
                                    ?>
                                    <div>
                                    @foreach($skills_compantancies as $skills_compantancies_type)
                                    <?php
                                        $skills_name = DB::table("skills")->where("id",$skills_compantancies_type)->first();   
                                    ?>
                                    <span class="badge bg-dark me-1">{{ $skills_name->name }}</span>
                                    @endforeach
                                    </div> 
                                </div>       
                                @endif
                                @if($exp_data->evidence_type != "null")
                                
                                <div class="mb-3 mt-3">
                                    <label class="form-label fw-semibold">Type of evidence</label>
                                    <?php
                                        $evidence_type = (array)json_decode($exp_data->evidence_type);
                                    ?>
                                    <div>
                                    @foreach($evidence_type as $evi_type)
                                    
                                    <span class="badge bg-dark me-1">{{ $evi_type }}</span>
                                    @endforeach
                                    </div> 
                                </div>       
                                @endif
                                <div class="col-md-6">
                                    <div class="evidence_img_list">
                                        <p><strong>Evidence:</strong>
                                        <ul>
                                            <?php
                                                if($exp_data->upload_evidence){
                                                    $evidence_imgs = (array)json_decode($exp_data->upload_evidence);
                                                    
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
@endsection