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
                            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Professional Memberships & Awards</h3>
                        </div>
                        <div class="card-body p-3 px-md-4">
                            <div class="col-md-12">
                                <div class="row">
                                    @if(!empty($professional_membership))
                                        <div class="professional_membership_details">
                                            <h4>Professional Membership Details</h4>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Organization Country</label>
                                                <?php
                                                    if(!empty($professional_membership)){
                                                        $organization_data = json_decode($professional_membership->organization_data);
                                                        
                                                    }else{
                                                        $organization_data = array(); 
                                                    }
                                                    
                                                    
                                                    
                                                    $o_data = (array)$organization_data;
                                                    $p_memb_arr = array();
                                                    $p_membid_arr = array();
                                                    if(!empty($organization_data)){
                                                        foreach ($organization_data as $index=>$p_memb) {
                                                        
                                                            $memb_name = DB::table("professional_organization")->where("organization_id",$index)->first();
                                                            $p_membid_arr[] = $index;
                                                            $p_memb_arr[] = $memb_name->organization_name;
                                                        
                                                        }
                                                    }

                                                    //print_r($p_membid_arr);
                                                    
                                                    ?>
                                                <div>
                                                    @foreach($p_memb_arr as $p_memb_name)
                                                    <span class="badge bg-dark me-1">{{ $p_memb_name }}</span>
                                                    @endforeach
                                                </div>
                                               
                                               
                                            </div>
                                            @foreach ($p_membid_arr as $p_arr)
                                            <?php
                                                //print_r($o_data[$p_arr]);
                                                $country_name = DB::table("professional_organization")->where("organization_id",$p_arr)->first();
                                                $organization_list = DB::table("professional_organization")->where("country_organiztions",$p_arr)->where("sub_organiztions","0")->orderBy('organization_country', 'ASC')->get();
                                                
                                                $os_data = (array)$o_data[$p_arr];
                                                $sub_countid_arr = array();
                                                $sub_count_arr = array();

                                                foreach ($os_data as $index=>$p_memb) {
                                                    $memb_name = DB::table("professional_organization")->where("organization_id",$index)->first();
                                                    $sub_countid_arr[] = $index;
                                                    $sub_count_arr[] = $memb_name->organization_country;
                                                }
                                                //print_r($sub_count_arr);
                                            ?>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">{{ $country_name->organization_name }}</label>
                                                <div>
                                                    @foreach($sub_count_arr as $p_memb_name)
                                                    <span class="badge bg-dark me-1">{{ $p_memb_name }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @foreach ($sub_countid_arr as $p_arr1)
                                            <?php
                                            $country_name = DB::table("professional_organization")->where("organization_id",$p_arr1)->first();
                                            $organization_list = DB::table("professional_organization")->where("country_organiztions",$p_arr)->where("sub_organiztions",$p_arr1)->orderBy('organization_country', 'ASC')->get();
                                            
                                            $oss_data = (array)$os_data[$p_arr1];
                                            $subsub_count_arr = array();
                                            $subsub_countid_arr = array();
                                            
                                            foreach ($oss_data as $index => $p_memb) {
                                                $memb_name = DB::table("professional_organization")->where("organization_id",$index)->first();
                                                $subsub_countid_arr[] = $index;
                                                $subsub_count_arr[] = $memb_name->organization_country;
                                            }
                                            
                                            
                                            ?>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">{{ $country_name->organization_country }}</label>
                                                <div>
                                                    @foreach($subsub_count_arr as $p_memb_name)
                                                    <span class="badge bg-dark me-1">{{ $p_memb_name }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @foreach ($subsub_countid_arr as $p_arr2)
                                            <?php
                                                $country_name = DB::table("professional_organization")->where("organization_id",$p_arr2)->first();
                                                $osm_data = (array)$oss_data[$p_arr2];
                                                $memb_typeid_arr = array();
                                                $memb_type_arr = array();

                                                foreach ($osm_data as $index =>$m_type_arr) {
                                                    $memb_name = DB::table("membership_type")->where("membership_id",$index)->first();
                                                    $memb_typeid_arr[] = $index;
                                                    $memb_type_arr[] = $memb_name->membership_name;
                                                }
                                                
                                            ?>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Membership Type({{ $country_name->organization_country }})</label>
                                                <div>
                                                    @foreach($memb_type_arr as $p_memb_name)
                                                    <span class="badge bg-dark me-1">{{ $p_memb_name }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @foreach ($memb_typeid_arr as $p_arr3)
                                            <?php
                                                $membership_name = DB::table("membership_type")->where("membership_id",$p_arr3)->first();
                                                $submembership_type_list = DB::table("membership_type")->where("submember_id",$p_arr3)->orderBy('membership_name', 'ASC')->get();
                                                $ossm_data = (array)$osm_data[$p_arr3];
                                                $submemb_type_arr = array();
                                                $submemb_typeid_arr = array();

                                                foreach ($ossm_data as $m_type_arr) {
                                                    $memb_name = DB::table("membership_type")->where("membership_id",$m_type_arr)->first();
                                                    $submemb_typeid_arr[] = $m_type_arr;
                                                    $submemb_type_arr[] = $memb_name->membership_name;
                                                }

                                            ?>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">{{ $membership_name->membership_name }}</label>
                                                <div>
                                                    @foreach($submemb_type_arr as $p_memb_name)
                                                    <span class="badge bg-dark me-1">{{ $p_memb_name }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach
                                            @endforeach
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <?php
                                                        $date_joined = (array)json_decode($professional_membership->date_joined);
                                                        $membership_status = (array)json_decode($professional_membership->membership_status);
                                                        
                                                    ?>
                                                    <strong>Date Joined:</strong>
                                                    <span>
                                                        {{ $date_joined[$p_arr2] }}
                                                    </span> 
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>Status:</strong>
                                                    <span>
                                                        {{ $membership_status[$p_arr2] }}
                                                    </span> 
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="evidence_img_list">
                                                        <p><strong>Evidence:</strong>
                                                        <ul>
                                                            <?php
                                                                if($professional_membership->evidence_imgs){
                                                                    $evidence_imgs = (array)json_decode($professional_membership->evidence_imgs);
                                                                    $evorgimg = $evidence_imgs[$p_arr2];
                                                                    //print_r($evidence_imgs);die;
                                                                    $i = 0;
                                                                    ?>
                                                                    @if(!empty($evorgimg))
                                                                    @foreach ($evorgimg as $ev_img)
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
                                            @endforeach
                                            <h4>Award Details</h4>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Awards & Recognitions</label>
                                                <?php
                                                    if(!empty($professional_membership)){
                                                        $award_recognitions = (array)json_decode($professional_membership->award_recognitions);
                                                    }else{
                                                        $award_recognitions = '';
                                                    }
                                                    

                                                    if(!empty($award_recognitions)){
                                                        $award_data = (array)$award_recognitions;
                                                        
                                                    }else{
                                                        $award_data = array();
                                                    }
                                                    
                                                    //print_r($award_data);
                                                    $awardid_arr = array();
                                                    $award_arr = array();

                                                    foreach ($award_data as $index =>$aw_data) {
                                                        $award_name = DB::table('awards_recognitions')->where("award_id",$index)->first();
                                                        $awardid_arr[] = $index;
                                                        $award_arr[] = $award_name->award_name;
                                                    }
                                                
                                                ?>
                                                <div>
                                                    @foreach ($award_arr as $awardname_arr)
                                                    <span class="badge bg-dark me-1">{{ $awardname_arr }}</span>    
                                                    @endforeach
                                                    
                                                </div>
                                               
                                               
                                            </div>
                                            @foreach ($awardid_arr as $a_reg_arr)
                                            <?php
                                            $subawards_name = DB::table("awards_recognitions")->where("award_id",$a_reg_arr)->first();
                                            $subawards_recognition = DB::table("awards_recognitions")->where("sub_award_id",$a_reg_arr)->orderBy('award_name', 'ASC')->get();

                                            if(!empty($award_recognitions)){
                                                $subaward_data = (array)$award_recognitions[$a_reg_arr];
                                                
                                            }else{
                                                $subaward_data = array();
                                            }

                                            $subaward_arr = array();
                                            $subawardid_arr = array();

                                            foreach ($subaward_data as $index =>$subaw_data) {
                                                $award_name = DB::table('awards_recognitions')->where("award_id",$index)->first();
                                                $subawardid_arr[] = $index;
                                                $subaward_arr[] = $award_name->award_name;
                                            }
                                        
                                            ?>
                                            
                                            
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">{{ $subawards_name->award_name }}</label>
                                                <div>
                                                    @foreach ($subaward_arr as $awardname_arr)
                                                    <span class="badge bg-dark me-1">{{ $awardname_arr }}</span>    
                                                    @endforeach
                                                    
                                                </div>
                                            </div>    
                                            @foreach($subawardid_arr as $insreg)
                                            <?php
                                                $subawards_name1 = DB::table("awards_recognitions")->where("award_id",$insreg)->first();
                                                
                                                if(!empty($award_recognitions)){
                                                    $insaward_data = (array)$subaward_data[$insreg];
                                                    
                                                }else{
                                                    $insaward_data = '';
                                                }
                                                
                                            ?>
                                            <h5>{{ $subawards_name1->award_name }}</h5>
                                            <div class="col-md-6">
                                                <strong>Issuing Institution/Organization:</strong>
                                                <span>
                                                   {{ $insaward_data[0] }}
                                                </span> 
                                            </div>   
                                            
                                            <div class="col-md-6">
                                                <div class="evidence_img_list">
                                                    <p><strong>Evidence:</strong>
                                                    <ul>
                                                        <?php
                                                            if($professional_membership->evidence_imgs){
                                                                $evidence_imgs = (array)json_decode($professional_membership->award_evidence_imgs);
                                                                if(isset($evidence_imgs[$insreg])){
                                                                    $evorgimg = $evidence_imgs[$insreg];
                                                                }else{
                                                                    $evorgimg = array();
                                                                }
                                                                //print_r($evidence_imgs);die;
                                                                $i = 0;
                                                                ?>
                                                                @if(!empty($evorgimg))
                                                                @foreach ($evorgimg as $ev_img)
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