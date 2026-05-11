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

    .clear-btn{
        display: none;
    }

    .trans_img1
    {
        margin-bottom: 5px;
        display: flex;
    }

    .trans_img1 .close_btn i {
        margin-left: 10px;
        line-height: 22px;
    }

    .trans_img1 i.fa {
        position: relative;
        left: 0px;
        font-size: 14px;
        line-height: 25px;
        margin-right: 5px;
        color: #000000;
    }

    .btn-apply-big {
        background-color: #000000;
        color: #ffffff;
        padding: 9px 8px;
        border-radius: 4px;
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
                            <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center ">Professional Memberships & Awards</h3>
                        </div>
                        <div class="card-body p-3 px-md-4">
                            <form id="professional_memb_form" method="POST" onsubmit="return professional_membership_form()">
                                @csrf
                                
                                <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                                <h6 class="emergency_text">
                                Do you have any Professional Memberships? 
            
                                </h6>
                                <div class="form-group level-drp">
                                <label class="form-label" for="input-1">Please include all, even those that are Lapsed, Expired, Suspended, Inactive, Non-Renewed, Pending Approval, or Renewal Pending.
                                    </label> 
                                    
                                <select class="form-control profmemaward" name="profmemaward">
                                    <option value="">select</option>
                                    <option value="Yes" @if(!empty($professional_membership) && $professional_membership->membership_question == "Yes") selected @endif>Yes</option>
                                    <option value="No" @if(!empty($professional_membership) && $professional_membership->membership_question == "No") selected @endif>No</option>
                                </select> 
                                <span id="professional_awards" class="reqError text-danger valley"></span>
                                </div>
                                <div class="profess_fields  @if(empty($professional_membership) || $professional_membership->membership_question == "No") d-none @endif">
                                <div class="form-group level-drp">
                                    <label class="form-label" for="input-1">Organization Country:</label>
                                    <?php
                                    if(!empty($professional_membership)){
                                        $organization_data = json_decode($professional_membership->organization_data);
                                        
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
                                    

                                    
                                    $p_memb_json = json_encode($p_memb_arr);
                                    ?>
                                    
                                    <input type="hidden" name="org_country" class="org_country" value='<?php echo $p_memb_json; ?>'>
                                    <ul id="organization_country" style="display:none;">
                                    @if(!empty($organization_country))
                                    @foreach($organization_country as $org_country)
                                    <li data-value="{{ $org_country->organization_id }}">{{ $org_country->organization_country }}</li>
                                    
                                    @endforeach
                                    @endif
                                    </ul>
                                    <select class="js-example-basic-multiple addAll_removeAll_btn organization_country" data-list-id="organization_country" name="organization_country[]" multiple="multiple"></select>
                                    <span id="reqorganization_country" class="reqError text-danger valley"></span>
                                </div>
                                <div class="show_country_org">
                                    <?php
                                    $i = 0;
                                    ?>
                                    
                                    @foreach ($p_memb_arr as $p_arr)
                                    <?php
                                        //print_r($o_data[$p_arr]);
                                        $country_name = DB::table("professional_organization")->where("organization_id",$p_arr)->first();
                                        $organization_list = DB::table("professional_organization")->where("country_organiztions",$p_arr)->where("sub_organiztions","0")->orderBy('organization_country', 'ASC')->get();
                                        
                                        $os_data = (array)$o_data[$p_arr];
                                        $sub_count_arr = array();

                                        foreach ($os_data as $p_memb) {
                                        $sub_count_arr[] = array_search($p_memb, $os_data);
                                        }
                                        
                                        
                                        $p_memb_json = json_encode($sub_count_arr);
                                    ?>
                                    <div class="country_whole_div country_whole_div-{{ $p_arr }}" data-name="{{ $p_arr }}">
                                    <div class="form-group level-drp organization_country_div organization_country_div-{{ $p_arr }}">
                                        <label class="form-label organization_country_label organization_country_label-{{ $p_arr }}" for="input-1">{{ $country_name->organization_name }}</label>
                                        <input type="hidden" name="country_org_list" class="country_org_list country_org_list-{{ $p_arr }}" value='{{ $p_arr }}'>
                                        <input type="hidden" name="country_org" class="country_org-{{ $p_arr }}" value='<?php echo $p_memb_json; ?>'>
                                        <ul id="country_organization-{{ $p_arr }}" style="display:none;">
                                        @if(!empty($organization_list))
                                        @foreach($organization_list as $org_list)
                                        <li data-value="{{ $org_list->organization_id }}">{{ $org_list->organization_country }}</li>
                                        
                                        @endforeach
                                        @endif
                                        </ul>
                                        <select class="country_org_valid country_org_valid-{{ $p_arr }} js-example-basic-multiple addAll_removeAll_btn" data-list-id="country_organization-{{ $p_arr }}" name="country_organization[{{ $p_arr }}][]" onchange="sub_organization('edit',{{ $p_arr }}, {{ $i+1 }})" multiple="multiple"></select>
                                        <span id="reqcountry_org-{{ $p_arr }}" class="reqError text-danger valley"></span>
                                    </div>
                                    <div class="show_subcountry_org-{{ $p_arr }}">
                                        <?php
                                        $j = 0;
                                        
                                    ?>
                                    
                                    @foreach ($sub_count_arr as $p_arr1)
                                        <?php
                                        $country_name = DB::table("professional_organization")->where("organization_id",$p_arr1)->first();
                                        $organization_list = DB::table("professional_organization")->where("country_organiztions",$p_arr)->where("sub_organiztions",$p_arr1)->orderBy('organization_country', 'ASC')->get();
                                        
                                        $oss_data = (array)$os_data[$p_arr1];
                                        $subsub_count_arr = array();
                                        
                                        foreach ($oss_data as $index => $p_memb) {
                                            
                                            $subsub_count_arr[] = $index;
                                        }
                                        
                                        
                                        $p_memb_json = json_encode($subsub_count_arr);
                                        
                                        ?>
                                        <div class="sub_country_div sub_country_div-{{ $p_arr1 }}" data-name="@if(!empty($country_name)){{ $country_name->organization_country }}@endif">
                                        <div class="form-group level-drp o_country_div-{{ $p_arr }} o_subcountry_div-{{ $p_arr1 }} o_subcountry_div-{{ $p_arr1 }} organization_subcountry_div organization_subcountry_div-{{ $p_arr1 }}">
                                        <label class="form-label organization_subcountry_label organization_subcountry_label-{{ $p_arr }}{{ $p_arr1 }}" for="input-1">@if(!empty($country_name)){{ $country_name->organization_country }}@endif</label>
                                        <input type="hidden" name="subcountry_org_list" class="subcountry_org_list subcountry_org_list-{{ $p_arr1 }}" value='{{ $p_arr1 }}'>
                                        <input type="hidden" name="subcountry_org" class="subcountry_org-{{ $p_arr }}{{ $p_arr1 }}" value='<?php echo $p_memb_json; ?>'>
                                        <ul id="subcountry_organization-{{ $p_arr }}{{ $p_arr1 }}" style="display:none;">
                                            @if(!empty($organization_list))
                                            @foreach($organization_list as $org_list)
                                            <li data-value="{{ $org_list->organization_id }}">{{ $org_list->organization_country }}</li>
                                            
                                            @endforeach
                                            @endif
                                        </ul>
                                        <select class="sub_country_org sub_country_org-{{ $p_arr }}{{ $p_arr1 }} js-example-basic-multiple addAll_removeAll_btn" data-list-id="subcountry_organization-{{ $p_arr }}{{ $p_arr1 }}" name="subcountry_organization[{{ $p_arr }}][{{ $p_arr1 }}][]" onchange="memberships_type('edit','{{ $p_arr }}','{{ $p_arr1 }}',{{ $i+1 }},{{{ $j+1 }}})" multiple="multiple">
                                        </select>
                                        <span id="reqsubcountry_org-{{ $p_arr }}{{ $p_arr1 }}" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="show_membership_type-{{ $p_arr }}{{ $p_arr1 }}">
                                        <?php
                                            $k = 0;  
                                        ?>
                                        @foreach ($subsub_count_arr as $p_arr2)
                                        <?php
                                            $membership_type = DB::table("membership_type")->where("submember_id","0")->orderBy('membership_name', 'ASC')->get();
                                            $osm_data = (array)$oss_data[$p_arr2];
                                            $memb_type_arr = array();

                                            foreach ($osm_data as $index =>$m_type_arr) {
                                            $memb_type_arr[] = $index;
                                            }
                                        
                                        
                                            $p_memb_json = json_encode($memb_type_arr);
                                        ?>
                                        <div class="membership_type_div-{{ $p_arr2 }}">
                                        <div class="form-group level-drp o_subcountry_div-{{ $p_arr1 }} o_country_div-{{ $p_arr }} membership_type_div membership_type_div-{{ $p_arr2 }}">
                                            <label class="form-label membership_type_label membership_type_label-{{ $p_arr }}{{ $p_arr2 }}" for="input-1">Membership Type(@if(!empty($country_name)){{ $country_name->organization_country }}@endif)</label>
                                            <input type="hidden" name="subsubcountry_org_list" class="subsubcountry_org_list subsubcountry_org_list-{{ $p_arr2 }}" value='{{ $p_arr2 }}'>
                                            <input type="hidden" name="memb_type_input" class="memb_type_input-{{ $p_arr2 }}" value='<?php echo $p_memb_json; ?>'>
                                            <ul id="membership_type-{{ $p_arr2 }}" style="display:none;">
                                            @if(!empty($membership_type))
                                            @foreach($membership_type as $m_type)
                                            <li data-value="{{ $m_type->membership_id }}">{{ $m_type->membership_name }}</li>
                                            
                                            @endforeach
                                            @endif
                                            </ul><select class="membership_type_org membership_type_org-{{ $p_arr }}{{ $p_arr2 }} js-example-basic-multiple addAll_removeAll_btn" data-list-id="membership_type-{{ $p_arr2 }}" name="membership_type[{{ $p_arr }}][{{ $p_arr1 }}][{{ $p_arr2 }}][]" onchange="submemberships_type('edit','{{ $p_arr }}','{{ $p_arr2 }}','{{ $p_arr1 }}',{{ $i+1 }},{{ $j+1 }},{{ $k+1 }})" multiple="multiple">
                                            </select>
                                            <span id="reqmembershiptype-{{ $p_arr }}{{ $p_arr2 }}" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="show_submembership_type-{{ $p_arr }}{{ $p_arr1 }}{{ $p_arr2 }}">
                                            @foreach ($memb_type_arr as $p_arr3)
                                            <?php
                                            $membership_name = DB::table("membership_type")->where("membership_id",$p_arr3)->first();
                                            $submembership_type_list = DB::table("membership_type")->where("submember_id",$p_arr3)->orderBy('membership_name', 'ASC')->get();
                                            $ossm_data = (array)$osm_data[$p_arr3];
                                            $memb_type_arr = array();
                                            
                                            foreach ($ossm_data as $m_type_arr) {
                                                $memb_type_arr[] = $m_type_arr;
                                                
                                            }

                                            
                                            $p_memb_json = json_encode($memb_type_arr);
                                            ?>
                                            <div class="submembership_type_div-{{ $p_arr3 }}-{{ $p_arr3 }}">
                                            <div class="form-group level-drp o_membtype_div-{{ $p_arr2 }} o_subcountry_div-{{ $p_arr1 }} o_country_div-{{ $p_arr }} submembership_type_div submembership_type_div-{{ $p_arr3 }}">
                                            <label class="form-label submembership_type_label submembership_type_label-{{ $p_arr }}-{{ $p_arr3 }}" for="input-1">{{ $membership_name->membership_name }}</label>
                                            <input type="hidden" name="submemb_list" class="submemb_list submemb_list-{{ $p_arr3 }}" value='{{ $p_arr3 }}'>
                                            <input type="hidden" name="submemb_type_input" class="submemb_type_input-{{ $p_arr2 }}-{{ $p_arr3 }}" value='<?php echo $p_memb_json; ?>'>
                                            <ul id="submembership_type-{{ $p_arr3 }}-{{ $p_arr2 }}" style="display:none;">
                                                @if(!empty($submembership_type_list))
                                                @foreach($submembership_type_list as $msub_type)
                                                <li data-value="{{ $msub_type->membership_id }}">{{ $msub_type->membership_name }}</li>
                                                
                                                @endforeach
                                                @endif
                                            </ul><select class="submemb_valid submemb_valid-{{ $p_arr }}-{{ $p_arr3 }} js-example-basic-multiple addAll_removeAll_btn" data-list-id="submembership_type-{{ $p_arr3 }}-{{ $p_arr2 }}" name="submembership_type[{{ $p_arr }}][{{ $p_arr1 }}][{{ $p_arr2 }}][{{ $p_arr3 }}][]" multiple="multiple">
                                            </select>
                                            <span id="reqsubmem_org-{{ $p_arr }}-{{ $p_arr3 }}" class="reqError text-danger valley"></span>
                                            </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <?php
                                            $k++;
                                        ?>
                                        
                                        <?php
                                            $date_joined = (array)json_decode($professional_membership->date_joined);
                                            $membership_status = (array)json_decode($professional_membership->membership_status);
                                            
                                        ?>
                                        <div class="form-group level-drp">
                                            <label class="form-label" for="input-1">Date Joined</label>
                                            <input class="form-control graduation_start_date graduation_start_date-{{ $p_arr }}{{ $p_arr2 }}" type="date" name="date_joined[{{ $p_arr2 }}]" value="@if(!empty($professional_membership)){{ $date_joined[$p_arr2] }}@endif" onchange="changeDate(event);">
                                            <span id="reqjoined_date-{{ $p_arr }}{{ $p_arr2 }}" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="form-group level-drp">
                                            <label class="form-label" for="input-1">Status</label>
                                            <select class="form-control profmemstatus profmemstatus-{{ $p_arr }}{{ $p_arr2 }}" name="prof_membership_status[{{ $p_arr2 }}]" id="language-picker-select">
                                            <option value="">Select Status</option>
                                            <option value="Active - Current Member" @if(!empty($professional_membership) && $membership_status[$p_arr2] == "Active - Current Member") selected @endif>Active - Current Member</option>
                                            <option value="Lapsed Member" @if(!empty($professional_membership) && $membership_status[$p_arr2] == "Lapsed Member") selected @endif>Lapsed Member</option>
                                            <option value="Expired Member" @if(!empty($professional_membership) && $membership_status[$p_arr2] == "Expired Member") selected @endif>Expired Member</option>
                                            <option value="Suspended Member" @if(!empty($professional_membership) && $membership_status[$p_arr2] == "Suspended Member") selected @endif>Suspended Member</option>
                                            <option value="Inactive Member" @if(!empty($professional_membership) && $membership_status[$p_arr2] == "Inactive Member") selected @endif>Inactive Member</option>
                                            <option value="Non-Renewed Member" @if(!empty($professional_membership) && $membership_status[$p_arr2] == "Non-Renewed Member") selected @endif>Non-Renewed Member</option>
                                            <option value="Pending Membership Approval" @if(!empty($professional_membership) && $membership_status[$p_arr2] == "Pending Membership Approval") selected @endif>Pending Membership Approval</option>
                                            <option value="Membership Renewal Pending" @if(!empty($professional_membership) && $membership_status[$p_arr2] == "Membership Renewal Pending") selected @endif>Membership Renewal Pending</option>
                    
                                            </select>
                                            <span id="reqmembership_status-{{ $p_arr }}{{ $p_arr2 }}" class="reqError text-danger valley"></span>
                                        </div>
                                        
                                            <div class="form-group level-drp">
                                            <?php
                                                $user_id = Auth::guard('nurse_middle')->user()->id;  
                                            ?>
                                            <label class="form-label" for="input-1">Upload Evidence</label>
                                            <input class="form-control membership_evidence-{{ $p_arr2 }}" type="file" name="membership_evidence[{{ $p_arr2 }}][]" onchange="changeEvidenceImg({{ $user_id }},{{ $p_arr2 }})" multiple>
                                            </div>
                                            <div class="memb_evdence-{{ $p_arr2 }}">
                                            <?php
                                                if($professional_membership->evidence_imgs){
                                                $evidence_imgs = (array)json_decode($professional_membership->evidence_imgs);
                                                $evorgimg = $evidence_imgs[$p_arr2];
                                                //print_r($evorgimg);
                                                $i = 0;
                                                ?>
                                                @if(!empty($evorgimg))
                                                @foreach ($evorgimg as $ev_img)
                                                <div class="trans_img trans_img-{{ $i+1 }}">
                                                    <a href=""><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                                    <div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}',{{ $p_arr2 }})" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                                </div>
                                                <?php
                                                    $i++;
                                                ?>
                                                @endforeach
                                                @endif
                                                <?php
                                                }
                                                //print_r($evidence_imgs);
                                            ?>
                                            </div>
                                        
                                            
                                        </div>
                                        @endforeach
                                        
                                        </div>  
                                        <?php
                                        $j++
                                        ?>
                                        </div>
                                    @endforeach
                                    
                                    </div>
                                    
                                    <?php
                                        $i++
                                    ?>
                                    </div>
                                    @endforeach
                                </div>
                                </div>
                                <h6 class="emergency_text">
                                Do you have any Recognitions or Awards? 
            
                                </h6>
                                <div class="form-group level-drp">
                                <label class="form-label" for="input-1">Please select</label> 
                                <select class="form-control award_question" name="award_question">
                                    <option value="">select</option>
                                    <option value="Yes" @if(!empty($professional_membership) && $professional_membership->award_question == "Yes") selected @endif>Yes</option>
                                    <option value="No" @if(!empty($professional_membership) && $professional_membership->award_question == "No") selected @endif>No</option>
                                </select> 
                                <span id="professional_awards_que" class="reqError text-danger valley"></span>
                                </div> 
                                <div class="awards_fields @if(empty($professional_membership) || $professional_membership->award_question == "No") d-none @endif">
                                <div class="form-group level-drp">
                                    <label class="form-label award_recognition_label" for="input-1">Awards & Recognitions:</label>
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
                                    $award_arr = array();

                                    foreach ($award_data as $index =>$aw_data) {
                                        $award_arr[] = $index;
                                    }
                                
                                    
                                    $award_json = json_encode($award_arr);
                                    ?>
                                    {{-- <input type="hidden" name="award_list" class="award_list award_list-{{ $p_arr2 }}" value="{{ $p_arr2 }}">    --}}
                                    <input type="hidden" name="awards_recognition_input" class="awards_recognition_input" value='<?php echo $award_json; ?>'>
                                    <ul id="awards_recognitions" style="display:none;">
                                    @if(!empty($awards_recognitions))
                                    @foreach($awards_recognitions as $a_reg)
                                    <li data-value="{{ $a_reg->award_id }}">{{ $a_reg->award_name }}</li>
                                    
                                    @endforeach
                                    @endif
                                    </ul>
                                    <select class="award_recog js-example-basic-multiple addAll_removeAll_btn" data-list-id="awards_recognitions" name="awards_recognitions[]" multiple="multiple"></select>
                                    <span id="reqawards_recognitions" class="reqError text-danger valley"></span>
                                </div>
                                <div class="show_award_reg">
                                    @foreach ($award_arr as $a_reg_arr)
                                    
                                    <?php
                                    $subawards_name = DB::table("awards_recognitions")->where("award_id",$a_reg_arr)->first();
                                    $subawards_recognition = DB::table("awards_recognitions")->where("sub_award_id",$a_reg_arr)->orderBy('award_name', 'ASC')->get();

                                    if(!empty($award_recognitions)){
                                        $subaward_data = (array)$award_recognitions[$a_reg_arr];
                                        
                                    }else{
                                        $subaward_data = array();
                                    }

                                    $subaward_arr = array();

                                    foreach ($subaward_data as $index =>$subaw_data) {
                                        $subaward_arr[] = $index;
                                    }
                                
                                    
                                    $subaward_json = json_encode($subaward_arr);
                                    ?>
                                    <div class="award_regc_div award_regc_div-{{ $a_reg_arr }}">
                                    <div class="form-group level-drp award_div award_country_div-{{ $a_reg_arr }}">
                                        <label class="form-label subaward_label subaward_label-{{ $a_reg_arr }}" for="input-1">{{ $subawards_name->award_name }}</label>
                                        <input type="hidden" name="sub_award_list" class="subaward_list subaward_list-{{ $a_reg_arr }}" value='<?php echo $a_reg_arr; ?>'>
                                        <input type="hidden" name="subawards_recognition_input" class="subawards_recognition_input-{{ $a_reg_arr }}" value='<?php echo $subaward_json; ?>'>
                                        <ul id="award_reg-{{ $a_reg_arr }}" style="display:none;">
                                        @if(!empty($subawards_recognition))
                                        
                                        @foreach($subawards_recognition as $a_reg)
                                        <li data-value="{{ $a_reg->award_id }}" class='sub_award_text-{{ $a_reg->award_id }}'>{{ $a_reg->award_name }}</li>
                                        @endforeach
                                        @endif
                                        </ul><select class="sub_award_org sub_award_org-{{ $a_reg_arr }} js-example-basic-multiple addAll_removeAll_btn" data-list-id="award_reg-{{ $a_reg_arr }}" id="award_organization_select-{{ $a_reg_arr }}" name="award_organization[{{ $a_reg_arr }}][]"  onchange="subaward_recognitions('edit',{{ $a_reg_arr }})" multiple="multiple">
                                        </select>
                                        <span id="reqsubawards_recognitions-{{ $a_reg_arr }}" class="reqError text-danger valley"></span>
                                    </div>  
                                    
                                    <div class="institution_evidence-{{ $a_reg_arr }}">
                                        @foreach($subaward_arr as $insreg)
                                        <?php
                                        $subawards_name1 = DB::table("awards_recognitions")->where("award_id",$insreg)->first();
                                        
                                        if(!empty($award_recognitions)){
                                            $insaward_data = (array)$subaward_data[$insreg];
                                            
                                        }else{
                                            $insaward_data = '';
                                        }
                                        $user_id = Auth::guard('nurse_middle')->user()->id;
                                        ?>
                                        <div class='subaward_institution subaward_institution-{{ $insreg }}'><input type='hidden' name='insev' class='insev insev-{{ $a_reg_arr }}' value='{{ $insreg }}'>
                                        <div class='inslabtext strong_text'><strong>{{ $subawards_name1->award_name }}</strong></div><div class='form-group level-drp'>
                                            <label class='form-label institution_label' for='input-1'>Issuing Institution/Organization</label>
                                            <input type='hidden' name='ins_ev1' class='ins_ev1 ins_ev1-{{ $insreg }}' value='{{ $insreg }}'>
                                            <input class='form-control issue_ins issue_ins-{{ $insreg }}' type='text' name='inst_org[{{ $a_reg_arr }}][{{ $insreg }}]' value="{{ $insaward_data[0] }}">
                                            <span id='reqins_recognitions-{{ $insreg }}' class='reqError text-danger valley'></span>
                                            </div>
                                            <div class='form-group level-drp'>
                                                <label class='form-label' for='input-1'>Upload Evidence</label>
                                                <input class='form-control award_evidence award_evidence-{{ $insreg }}' type='file' name='award_evidence[{{ $insreg }}][]' onchange="changeAwardEvidenceImg({{ $user_id }},'{{ $insreg }}')" multiple=''>
                                            </div>
                                            <div class='award_evdence-{{ $insreg }}'>
                                            <?php
                                                
                                                if(!empty($professional_membership) && $professional_membership->award_evidence_imgs){
                                                    $evidence_imgs = (array)json_decode($professional_membership->award_evidence_imgs);
                                                    

                                                    if(isset($evidence_imgs[$insreg])){
                                                    $evorgimg = $evidence_imgs[$insreg];
                                                    }else{
                                                    $evorgimg = array();
                                                    }
                                                    //print_r($evorgimg);
                                                    $i = 0;
                                                    ?>
                                                    @if(!empty($evorgimg))
                                                    @foreach ($evorgimg as $ev_img)
                                                    <div class="trans_img1 trans_img1-{{ $i+1 }}">
                                                    <a href=""><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                                    <div class="close_btn close_btn-' + i + '" onclick="deleteAwardEvidenceImg({{ $i+1 }},{{ $user_id }},'{{ $ev_img }}',{{ $insreg }})" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                                    </div>
                                                    <?php
                                                    $i++;
                                                    ?>
                                                    @endforeach
                                                    @endif
                                                    <?php
                                                }
                                                //print_r($evidence_imgs);
                                                ?>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    </div>
                                    @endforeach
                                </div>
                                </div>
                                
                                
                                
                                <div class="box-button mt-4">
                                    <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitProfessionalMembership" @if(!email_verified()) disabled  @endif>Save Changes</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js">
</script>
<script>
  $(document).ready(function() {

    // Add an additional search box and extra buttons to the dropdown
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

  });
</script>
<script>
  function changeEvidenceImg(user_id,sub_org_id) {
    
    var files = $('.membership_evidence-'+sub_org_id)[0].files;
    console.log("files", files);
    var form_data = "";
    form_data = new FormData();

    for (var i = 0; i < files.length; i++) {
      form_data.append("membership_evidence["+sub_org_id+"][]", files[i], files[i]['name']);
    }

    form_data.append("user_id", user_id);
    form_data.append("sub_org_id", sub_org_id);
    form_data.append("_token", '{{ csrf_token() }}');
    
    $.ajax({
      type: "post",
      url: "{{ route('admin.uploadMembershipImgs') }}",
      cache: false,
      contentType: false,
      processData: false,
      async: true,
      data: form_data,

      success: function(data) {
        var image_array = JSON.parse(data);
        console.log("degree_transcript", image_array[sub_org_id].length);
        var htmlData = '';
        for (var i = 0; i < image_array[sub_org_id].length; i++) {
          //console.log("degree_transcript", image_array[i]);
          var img_name = image_array[sub_org_id][i];
          console.log("img_name", 'deleteImg(' + (i + 1) + ',' + user_id + ',"' + img_name + '")');
          htmlData += '<div class="trans_img trans_img-' + (i + 1) + '"><a href="{{ url("/public") }}/uploads/education_degree/' + img_name + '" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>' + image_array[sub_org_id][i] + '</a><div class="close_btn close_btn-' + i + '" onclick="deleteEvidenceImg(' + (i + 1) + ',' + user_id + ',\'' + img_name + '\','+sub_org_id+')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div></div>';
        }
        $(".memb_evdence-"+sub_org_id).html(htmlData);
      }
    });
  }

  function changeAwardEvidenceImg(user_id,award_org_id) {
    
    var files = $('.award_evidence-'+award_org_id)[0].files;
    console.log("files", files);
    var form_data = "";
    form_data = new FormData();

    for (var i = 0; i < files.length; i++) {
      form_data.append("award_evidence["+award_org_id+"][]", files[i], files[i]['name']);
    }

    form_data.append("user_id", user_id);
    form_data.append("award_org_id", award_org_id);
    form_data.append("_token", '{{ csrf_token() }}');
    
    $.ajax({
      type: "post",
      url: "{{ route('admin.uploadAwardImgs') }}",
      cache: false,
      contentType: false,
      processData: false,
      async: true,
      data: form_data,

      success: function(data) {
        var image_array = JSON.parse(data);
        console.log("degree_transcript", image_array[award_org_id].length);
        var htmlData = '';
        for (var i = 0; i < image_array[award_org_id].length; i++) {
          //console.log("degree_transcript", image_array[i]);
          var img_name = image_array[award_org_id][i];
          console.log("img_name", 'deleteImg(' + (i + 1) + ',' + user_id + ',"' + img_name + '")');
          htmlData += '<div class="trans_img1 trans_img1-' + (i + 1) + '"><a href="{{ url("/public") }}/uploads/education_degree/' + img_name + '" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>' + image_array[award_org_id][i] + '</a><div class="close_btn close_btn-' + i + '" onclick="deleteAwardEvidenceImg(' + (i + 1) + ',' + user_id + ',\'' + img_name + '\','+award_org_id+')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div></div>';
        }
        $(".award_evdence-"+award_org_id).html(htmlData);
      }
    });
  }

  function deleteEvidenceImg(i, user_id, img,sub_org_id) {
    $.ajax({
      type: "post",
      url: "{{ route('admin.deleteEvidenceImg') }}",
      data: {
        user_id: user_id,
        img: img,
        sub_org_id: sub_org_id,
        _token: '{{ csrf_token() }}'
      },
      cache: false,
      success: function(data) {
        if (data == 1) {
          $(".trans_img-" + i).remove();
        }
      }
    });
  }

  function deleteAwardEvidenceImg(i, user_id, img,award_org_id) {
    $.ajax({
      type: "post",
      url: "{{ route('admin.deleteAwardEvidenceImg') }}",
      data: {
        user_id: user_id,
        img: img,
        award_org_id: award_org_id,
        _token: '{{ csrf_token() }}'
      },
      cache: false,
      success: function(data) {
        if (data == 1) {
          $(".trans_img1-" + i).remove();
        }
      }
    });
  }
  $(document).ready(function() {

    // Add an additional search box to the dropdown
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
  });

  var $wrapper = $('.show_country_org');

$wrapper.find('.country_whole_div').sort(function (a, b) {
    return +a.dataset.name - +b.dataset.name;
})
.appendTo( $wrapper );


$('.profmemaward').on('change', function() {
  console.log( this.value );
  var value = this.value;

  if(value == "Yes"){
    $(".profess_fields").removeClass("d-none");
  }else{
    $(".profess_fields").addClass("d-none");
  }
});

$('.award_question').on('change', function() {
  console.log( this.value );
  var value = this.value;

  if(value == "Yes"){
    $(".awards_fields").removeClass("d-none");
  }else{
    $(".awards_fields").addClass("d-none");
  }
});
 
  
  $('.js-example-basic-multiple[data-list-id="organization_country"]').on('change', function() {
    let selectedValues = $(this).val();
    console.log("selectedValues",selectedValues);
    //$(".show_country_org").empty();

    
    $(".country_org_list").each(function(i,val){
      var val = $(val).val();
      console.log("val",$(val).val());
      if(selectedValues.includes(val) == false){
        $(".country_whole_div-"+val).remove();
        
      }
    });
    
    
    for(var i=0;i<selectedValues.length;i++){
      //alert($(".organization_input-"+selectedValues[i]).val());

      
      if($(".show_country_org .organization_country_div-"+selectedValues[i]).length < 1 ){
        $("#submitProfessionalMembership").attr("disabled", true);
        $.ajax({
          type: "GET",
          url: "{{ url('/admin/getCountryOrgnizations') }}",
          data: {organization_id:selectedValues[i],id:i},
          cache: false,
          success: function(data){
            var data1 = JSON.parse(data);
            
            console.log("data1",data1);
            
            var org_text = "";
            for(var j=0;j<data1.country_organiztions.length;j++){
              //console.log("data",data1.country_organiztions[j].organization_id);
              org_text += "<li data-value='"+data1.country_organiztions[j].organization_id+"'>"+data1.country_organiztions[j].organization_country+"</li>"; 
              // $(".organization_country_div").removeClass("d-none");
              // $("#country_organization").append("<li data-value="+data1.country_organiztions[j].organization_id+">"+data1.country_organiztions[j].organization_country+"</li>");
              // $("#country_organization_select").append("<option value="+data1.country_organiztions[j].organization_id+">"+data1.country_organiztions[j].organization_country+"</option>");
            }
            //alert($(".organization_country_div-"+data1.organization_id).length);
            
              $(".show_country_org").append('<div class="country_whole_div country_whole_div-'+data1.organization_id+'" data-name="'+data1.organization_id+'"><div class="form-group level-drp o_country_div-'+data1.organization_id+' organization_country_div organization_country_div-'+data1.organization_id+'"><label class="form-label organization_country_label organization_country_label-'+data1.organization_id+'" for="input-1">'+data1.country_name+'</label><input type="hidden" name="country_org_list" class="country_org_list country_org_list-'+data1.organization_id+'" value="'+data1.organization_id+'"><ul id="country_organization-'+data1.organization_id+'" style="display:none;">'+org_text+'</ul><select class="country_org_valid country_org_valid-'+data1.organization_id+' js-example-basic-multiple'+data1.organization_id+' addAll_removeAll_btn" data-list-id="country_organization-'+data1.organization_id+'" id="country_organization_select-'+data1.organization_id+'" name="country_organization['+data1.organization_id+'][]" multiple="multiple"></select><span id="reqcountry_org-'+data1.organization_id+'" class="reqError text-danger valley"></span></div><div class="show_subcountry_org-'+data1.organization_id+'"></div></div>');
            
            
              var $wrapper = $('.show_country_org');

              $wrapper.find('.country_whole_div').sort(function (a, b) {
                  return +a.dataset.name - +b.dataset.name;
              })
              .appendTo( $wrapper );
            
            
            selectTwoFunction(data1.organization_id);
            sub_organization('',data1.organization_id,i);
            $("#submitProfessionalMembership").removeAttr("disabled");
          }
        });
      }
    }
    
        
      });

 
  
  function sub_organization(ed,country_org,k){
    
    
    if(ed == "edit"){
      let selectedValues = $('.js-example-basic-multiple[data-list-id="country_organization-'+country_org+'"]').val();
      console.log("selectedValues",selectedValues);


      $(".show_subcountry_org-"+country_org+" .subcountry_org_list").each(function(i,val){
        var val1 = $(val).val();
        console.log("val",val1);
        if(selectedValues.includes(val1) == false){
          $(".sub_country_div-"+val1).remove();
          
        }
      });
      
      
      
      for(var i=0;i<selectedValues.length;i++){

        

        if($(".show_subcountry_org-"+country_org+" .organization_subcountry_div-"+selectedValues[i]).length < 1){
          $("#submitProfessionalMembership").attr("disabled", true);
          $.ajax({
            type: "GET",
            url: "{{ url('/admin/getCountrySubOrgnizations') }}",
            data: {organization_id:selectedValues[i],country_org_id:country_org},
            cache: false,
            success: function(data){
              var data1 = JSON.parse(data);
              
              console.log("data1",data1);
              
              var org_text = "";
              for(var j=0;j<data1.country_organiztions.length;j++){
                
                org_text += "<li data-value='"+data1.country_organiztions[j].organization_id+"'>"+data1.country_organiztions[j].organization_country+"</li>"; 
                
              }
              $(".show_subcountry_org-"+country_org).append('\<div class="sub_country_div sub_country_div-'+data1.organization_id+'" data-name="'+data1.country_name+'">\
                  <div class="form-group level-drp o_country_div-'+country_org+' ed-o_subcountry_div-'+data1.organization_id+' organization_subcountry_div organization_subcountry_div-'+data1.organization_id+' ed-organization_subcountry_div-'+data1.organization_id+'">\
                    <label class="form-label organization_subcountry_label organization_subcountry_label-'+country_org+data1.organization_id+'" for="input-1">'+data1.country_name+':</label>\
                    <input type="hidden" name="subcountry_org_list" class="subcountry_org_list subcountry_org_list-'+data1.organization_id+'" value="'+data1.organization_id+'">\
                    <ul id="subcountry_organization-'+country_org+data1.organization_id+'" style="display:none;">'+org_text+'</ul>\
                    <select class="sub_country_org sub_country_org-'+country_org+data1.organization_id+' js-example-basic-multiple'+country_org+data1.organization_id+' addAll_removeAll_btn" data-list-id="subcountry_organization-'+country_org+data1.organization_id+'" name="subcountry_organization['+country_org+']['+data1.organization_id+'][]" multiple="multiple"></select>\
                    <span id="reqsubcountry_org-'+country_org+data1.organization_id+'" class="reqError text-danger valley"></span>\
                    </div><div class="show_membership_type-'+country_org+data1.organization_id+'"></div>');
              
                    let $fields = $(".show_subcountry_org-"+country_org+" .sub_country_div");

                let sortedFields = $fields.sort(function (a, b) {
                    return $(a).find(".organization_subcountry_label").text().localeCompare($(b).find(".organization_subcountry_label").text());
                });

                $(".show_subcountry_org-"+country_org).append(sortedFields);
                    

              selectTwoFunction(country_org+data1.organization_id);
              
              memberships_type('',country_org,data1.organization_id,k,i);
              $("#submitProfessionalMembership").removeAttr("disabled");
            }
          });
        }
      }
    }else{

     
    

      $('.js-example-basic-multiple'+country_org+'[data-list-id="country_organization-'+country_org+'"]').on('change', function() {
      
        let selectedValues = $(this).val();
        console.log("selectedValues","hello");

        
        $(".show_subcountry_org-"+country_org+" .subcountry_org_list").each(function(i,val){
          var val1 = $(val).val();
          console.log("val",val1);
          if(selectedValues.includes(val1) == false){
            $(".sub_country_div-"+val1).remove();
            
          }
        });
        

        
        
        
        for(var i=0;i<selectedValues.length;i++){
         
          
          if($(".show_subcountry_org-"+country_org+" .organization_subcountry_div-"+selectedValues[i]).length < 1){
            $("#submitProfessionalMembership").attr("disabled", true);
            $.ajax({
              type: "GET",
              url: "{{ url('/admin/getCountrySubOrgnizations') }}",
              data: {organization_id:selectedValues[i],country_org_id:country_org},
              cache: false,
              success: function(data){
                var data1 = JSON.parse(data);
                console.log("data1",data1);
                
                var org_text = "";
                for(var j=0;j<data1.country_organiztions.length;j++){
                  
                  org_text += "<li data-value='"+data1.country_organiztions[j].organization_id+"'>"+data1.country_organiztions[j].organization_country+"</li>"; 
                  
                }
                

                $(".show_subcountry_org-"+country_org).append('\<div class="sub_country_div  sub_country_div-'+data1.organization_id+'" data-site="'+data1.country_name+'">\
                  <div class="form-group level-drp o_country_div-'+country_org+' ed-o_subcountry_div-'+data1.organization_id+' organization_subcountry_div organization_subcountry_div-'+data1.organization_id+' ed-organization_subcountry_div-'+data1.organization_id+'">\
                    <label class="form-label organization_subcountry_label organization_subcountry_label-'+country_org+data1.organization_id+'" for="input-1">'+data1.country_name+':</label>\
                    <input type="hidden" name="subcountry_org_list" class="subcountry_org_list subcountry_org_list-'+data1.organization_id+'" value="'+data1.organization_id+'">\
                    <ul id="subcountry_organization-'+country_org+data1.organization_id+'" style="display:none;">'+org_text+'</ul>\
                    <select class="sub_country_org sub_country_org-'+country_org+data1.organization_id+' js-example-basic-multiple'+country_org+data1.organization_id+' addAll_removeAll_btn" data-list-id="subcountry_organization-'+country_org+data1.organization_id+'" name="subcountry_organization['+country_org+']['+data1.organization_id+'][]" multiple="multiple"></select>\
                    <span id="reqsubcountry_org-'+country_org+data1.organization_id+'" class="reqError text-danger valley"></span>\
                    </div><div class="show_membership_type-'+country_org+data1.organization_id+'"></div>');
                
                    let $fields = $(".show_subcountry_org-"+country_org+" .sub_country_div");

                let sortedFields = $fields.sort(function (a, b) {
                    return $(a).find(".organization_subcountry_label").text().localeCompare($(b).find(".organization_subcountry_label").text());
                });

                $(".show_subcountry_org-"+country_org).append(sortedFields);

                selectTwoFunction(country_org+data1.organization_id);
                
                memberships_type('',country_org,data1.organization_id,k,i);

                $("#submitProfessionalMembership").removeAttr("disabled");
              }
            });
          }
        }
      });
    }
  }

  
  function memberships_type(ed,country_org,organization_id,k,l){
    
    if(ed == "edit"){
      let selectedValues = $('.js-example-basic-multiple[data-list-id="subcountry_organization-'+country_org+organization_id+'"]').val();
      console.log("selectedValues_mem",selectedValues);
      
      $(".show_membership_type-"+country_org+organization_id+" .subsubcountry_org_list").each(function(i,val){
        var val1 = $(val).val();
        console.log("val",val1);
        if(selectedValues.includes(val1) == false){
          $(".membership_type_div-"+val1).remove();
          
        }
      });
    
      for(var i=0;i<selectedValues.length;i++){
        if($(".show_membership_type-"+country_org+organization_id+" .membership_type_div-"+selectedValues[i]).length < 1){
          $("#submitProfessionalMembership").attr("disabled", true);
          $.ajax({
            type: "GET",
            url: "{{ url('/admin/getMembershipData') }}",
            data: {organization_id:selectedValues[i]},
            cache: false,
            success: function(data){
              var data1 = JSON.parse(data);
              
              console.log("data1",data1);
              
              var membership_text = "";
              for(var j=0;j<data1.membership_type.length;j++){
                
                membership_text += "<li data-value='"+data1.membership_type[j].membership_id+"'>"+data1.membership_type[j].membership_name+"</li>"; 
                
              }

              var awards_text = "";
              for(var k=0;k<data1.award_recognitions.length;k++){
                
                awards_text += "<li data-value='"+data1.award_recognitions[k].award_id+"'>"+data1.award_recognitions[k].award_name+"</li>"; 
                
              }
              
              
              var user_id = "<?php echo Auth::guard('nurse_middle')->user()->id; ?>";

                $(".show_membership_type-"+country_org+organization_id).append('\<div class="membership_type_divs-'+data1.organization_id+'">\
                  <div class="form-group level-drp o_country_div-'+country_org+' ed-o_subcountry_div-'+organization_id+' membership_type_div membership_type_div-'+data1.organization_id+' ed-membership_type_div-'+data1.organization_id+'">\
                    <label class="form-label membership_type_label membership_type_label-'+country_org+data1.organization_id+'" for="input-1">Membership Type('+data1.organization_name+')</label>\
                    <input type="hidden" name="subsubcountry_org_list" class="subsubcountry_org_list subsubcountry_org_list-'+data1.organization_id+'" value="'+data1.organization_id+'">\
                    <ul id="membership_type-'+data1.organization_id+'" style="display:none;">'+membership_text+'</ul>\
                    <select class="membership_type_org membership_type_org-'+country_org+data1.organization_id+' js-example-basic-multiple'+country_org+data1.organization_id+' addAll_removeAll_btn" data-list-id="membership_type-'+data1.organization_id+'" name="membership_type['+country_org+']['+organization_id+']['+data1.organization_id+'][]" multiple="multiple"></select>\
                    <span id="reqmembershiptype-'+country_org+data1.organization_id+'" class="reqError text-danger valley"></span>\
                    </div><div class="show_submembership_type-'+country_org+organization_id+data1.organization_id+'"></div>\
                    <div class="form-group level-drp">\
                    <label class="form-label" for="input-1">Date Joined</label>\
                    <input class="form-control graduation_start_date graduation_start_date-'+country_org+data1.organization_id+'" type="date" name="date_joined['+data1.organization_id+']">\
                    <span id="reqjoined_date-'+country_org+data1.organization_id+'" class="reqError text-danger valley"></span></div></div><div class="form-group level-drp">\
                      <label class="form-label" for="input-1">Status</label>\
                      <select class="form-control profmemstatus profmemstatus-'+country_org+data1.organization_id+'" name="prof_membership_status['+data1.organization_id+']" id="language-picker-select">\
                        <option value="">Select Status</option>\
                        <option value="Active - Current Member">Active - Current Member</option>\
                        <option value="Lapsed Member">Lapsed Member</option>\
                        <option value="Expired Member">Expired Member</option>\
                        <option value="Suspended Member">Suspended Member</option>\
                        <option value="Inactive Member">Inactive Member</option>\
                        <option value="Non-Renewed Member">Non-Renewed Member</option>\
                        <option value="Pending Membership Approval">Pending Membership Approval</option>\
                        <option value="Membership Renewal Pending">Membership Renewal Pending</option>\
                      </select>\
                      <span id="reqmembership_status-'+country_org+data1.organization_id+'" class="reqError text-danger valley"></span>\
                    </div></div>\
                    <div class="form-group level-drp">\
                      <label class="form-label" for="input-1">Upload Evidence</label>\
                      <input class="form-control membership_evidence" type="file" name="membership_evidence['+data1.organization_id+'][]" multiple="">\
                    </div></div>');

                   

                    
                selectTwoFunction(country_org+data1.organization_id);
                submemberships_type('',country_org,data1.organization_id,organization_id,k,l,i);
                subaward_recognitions('',country_org,data1.organization_id);

                $("#submitProfessionalMembership").removeAttr("disabled");
            }
          });
        
        }
      }
    }else{
      
      $('.js-example-basic-multiple'+country_org+organization_id+'[data-list-id="subcountry_organization-'+country_org+organization_id+'"]').on('change', function() {
        let selectedValues = $(this).val();
        console.log("selectedValues",organization_id);

        $(".show_membership_type-"+country_org+organization_id+" .subsubcountry_org_list").each(function(i,val){
        var val1 = $(val).val();
        console.log("val",val1);
        if(selectedValues.includes(val1) == false){
          $(".membership_type_div-"+val1).remove();
          
        }
      });
        

        for(var i=0;i<selectedValues.length;i++){
          if($(".show_membership_type-"+country_org+organization_id+" .membership_type_div-"+selectedValues[i]).length < 1){
            $("#submitProfessionalMembership").attr("disabled", true);
            $.ajax({
              type: "GET",
              url: "{{ url('/admin/getMembershipData') }}",
              data: {organization_id:selectedValues[i]},
              cache: false,
              success: function(data){
                var data1 = JSON.parse(data);
                
                console.log("data1",data1);
                
                var membership_text = "";
                for(var j=0;j<data1.membership_type.length;j++){
                  
                  membership_text += "<li data-value='"+data1.membership_type[j].membership_id+"'>"+data1.membership_type[j].membership_name+"</li>"; 
                  
                }

                var awards_text = "";
                for(var k=0;k<data1.award_recognitions.length;k++){
                  
                  awards_text += "<li data-value='"+data1.award_recognitions[k].award_id+"'>"+data1.award_recognitions[k].award_name+"</li>"; 
                  
                }
                
                var user_id = "<?php echo Auth::guard('nurse_middle')->user()->id; ?>";

                $(".show_membership_type-"+country_org+organization_id).append('\<div class="membership_type_div membership_type_div-'+data1.organization_id+'">\
    <div class="form-group level-drp o_country_div-'+country_org+' ed-o_subcountry_div-'+organization_id+' membership_type_div membership_type_div-'+data1.organization_id+' ed-membership_type_div-'+data1.organization_id+'">\
        <label class="form-label membership_type_label membership_type_label-'+country_org+data1.organization_id+'" for="input-1">Membership Type('+data1.organization_name+')</label>\
        <input type="hidden" name="subsubcountry_org_list" class="subsubcountry_org_list subsubcountry_org_list-'+data1.organization_id+'" value="'+data1.organization_id+'">\
        <ul id="membership_type-'+data1.organization_id+'" style="display:none;">'+membership_text+'</ul>\
        <select class="membership_type_org membership_type_org-'+country_org+data1.organization_id+' js-example-basic-multiple'+country_org+data1.organization_id+' addAll_removeAll_btn" data-list-id="membership_type-'+data1.organization_id+'" name="membership_type['+country_org+']['+organization_id+']['+data1.organization_id+'][]" multiple="multiple"></select>\
        <span id="reqmembershiptype-'+country_org+data1.organization_id+'" class="reqError text-danger valley"></span>\
    </div>\
    <div class="show_submembership_type-'+country_org+organization_id+data1.organization_id+'"></div>\
    <div class="form-group level-drp">\
        <label class="form-label" for="input-1">Date Joined</label>\
        <input class="form-control graduation_start_date graduation_start_date-'+country_org+data1.organization_id+'" type="date" name="date_joined['+data1.organization_id+']">\
        <span id="reqjoined_date-'+country_org+data1.organization_id+'" class="reqError text-danger valley"></span></div>\
    <div class="form-group level-drp">\
        <label class="form-label" for="input-1">Status</label>\
        <select class="form-control profmemstatus profmemstatus-'+country_org+data1.organization_id+'" name="prof_membership_status['+data1.organization_id+']" id="language-picker-select">\
                        <option value="">Select Status</option>\
                        <option value="Active - Current Member">Active - Current Member</option>\
                        <option value="Lapsed Member">Lapsed Member</option>\
                        <option value="Expired Member">Expired Member</option>\
                        <option value="Suspended Member">Suspended Member</option>\
                        <option value="Inactive Member">Inactive Member</option>\
                        <option value="Non-Renewed Member">Non-Renewed Member</option>\
                        <option value="Pending Membership Approval">Pending Membership Approval</option>\
                        <option value="Membership Renewal Pending">Membership Renewal Pending</option>\
                      </select>\
        <span id="reqmembership_status-'+country_org+data1.organization_id+'" class="reqError text-danger valley"></span>\
    </div>\
    <div class="form-group level-drp">\
        <label class="form-label" for="input-1">Upload Evidence</label>\
        <input class="form-control membership_evidence-'+data1.organization_id+'" type="file" name="membership_evidence['+data1.organization_id+'][]" onchange="changeEvidenceImg('+user_id+','+data1.organization_id+')" multiple="">\
    </div>\
    <div class="memb_evdence-'+data1.organization_id+'"></div>\
</div>');

                   

                selectTwoFunction(country_org+data1.organization_id);
                submemberships_type('',country_org,data1.organization_id,organization_id,k,l,i);
                subaward_recognitions('',country_org,data1.organization_id);

                $("#submitProfessionalMembership").removeAttr("disabled");
              }
            });
          
          }
        }
      });
    }
  }

  $('.js-example-basic-multiple[data-list-id="awards_recognitions"]').on('change', function() {
    
    let selectedValues = $(this).val();
    console.log("selectedValues",selectedValues);

    $(".show_award_reg .subaward_list").each(function(i,val){
      var val1 = $(val).val();
      console.log("val",val1);
      if(selectedValues.includes(val1) == false){
        $(".award_regc_div-"+val1).remove();
        
      }
    });

    for(var i=0;i<selectedValues.length;i++){
  
      if($(".show_award_reg .award_country_div-"+selectedValues[i]).length < 1){
        $("#submitProfessionalMembership").attr("disabled", true);
        $.ajax({
          type: "GET",
          url: "{{ url('/admin/getawardsRecognitions') }}",
          data: {award_id:selectedValues[i]},
          cache: false,
          success: function(data){
            var data1 = JSON.parse(data);
            
            console.log("data1",data1);
            
            var org_text = "";
            for(var j=0;j<data1.award.length;j++){
              //console.log("data",data1.country_organiztions[j].organization_id);
              org_text += "<li data-value='"+data1.award[j].award_id+"' class='sub_award_text-"+data1.award[j].award_id+"'>"+data1.award[j].award_name+"</li>"; 
              // $(".organization_country_div").removeClass("d-none");
              // $("#country_organization").append("<li data-value="+data1.country_organiztions[j].organization_id+">"+data1.country_organiztions[j].organization_country+"</li>");
              // $("#country_organization_select").append("<option value="+data1.country_organiztions[j].organization_id+">"+data1.country_organiztions[j].organization_country+"</option>");
            }
            //alert($(".organization_country_div-"+data1.organization_id).length);
            var user_id = "<?php echo Auth::guard('nurse_middle')->user()->id; ?>";

            $(".show_award_reg").append('<div class="award_regc_div award_regc_div-'+data1.organization_id+'"><div class="form-group level-drp award_div award_country_div-'+data1.organization_id+'"><label class="form-label subaward_label subaward_label-'+data1.organization_id+'" for="input-1">'+data1.award_name+'</label><input type="hidden" name="subaward_list" class="subaward_list subaward_list-'+data1.organization_id+'" value="'+data1.organization_id+'"><ul id="award_reg-'+data1.organization_id+'" style="display:none;">'+org_text+'</ul><select class="sub_award_org sub_award_org-'+data1.organization_id+' js-example-basic-multiple'+data1.organization_id+' addAll_removeAll_btn" data-list-id="award_reg-'+data1.organization_id+'" id="award_organization_select-'+data1.organization_id+'" name="award_organization['+data1.organization_id+'][]" multiple="multiple"></select><span id="reqsubawards_recognitions-'+data1.organization_id+'" class="reqError text-danger valley"></span></div><div class="institution_evidence institution_evidence-'+data1.organization_id+'"></div></div>');
            
            let $fields = $(".show_award_reg .award_regc_div");

            let sortedFields = $fields.sort(function (a, b) {
                return $(a).find(".subaward_label").text().localeCompare($(b).find(".subaward_label").text());
            });

            $(".show_award_reg").append(sortedFields);

            subaward_recognitions('',data1.organization_id);
            selectTwoFunction(data1.organization_id);
            $("#submitProfessionalMembership").removeAttr("disabled");
          }
        });
      }
    }
    
  });

  function subaward_recognitions(ed,award_id){
    
    if(ed == "edit"){
      let selectedValues = $('.js-example-basic-multiple[data-list-id="award_reg-'+award_id+'"]').val();
      console.log("selectedValues",selectedValues);
      
      $(".insev-"+award_id).each(function(i,val){
        var val1 = $(val).val();
        console.log("val",val1);
        if(selectedValues.includes(val1) == false){
          $(".subaward_institution-"+val1).remove();
          
        }
      });

      var user_id = "<?php echo Auth::guard('nurse_middle')->user()->id; ?>";
      
      for(var i=0;i<selectedValues.length;i++){
        if($(".subaward_institution-"+selectedValues[i]).length < 1){
          
          var label_text = $(".sub_award_text-"+selectedValues[i]).text();
          //$('.award_country_div-'+award_id).after('\<div class="institution_evidence institution_evidence-'+selectedValues[i]+'"></div>');
          $(".institution_evidence-"+award_id).append("\<div class='subaward_institution subaward_institution-"+selectedValues[i]+"'><input type='hidden' name='insev' class='insev insev-"+award_id+"' value='"+selectedValues[i]+"'><div class='strong_text inslabtext'><strong>"+label_text+"</strong></div><div class='form-group level-drp'>\
            <label class='form-label institution_label' for='input-1'>Issuing Institution/Organization</label>\
            <input type='hidden' name='ins_ev1' class='ins_ev1 ins_ev1-"+selectedValues[i]+"' value='"+selectedValues[i]+"'>\
            <input class='form-control issue_ins issue_ins-"+selectedValues[i]+"' type='text' name='inst_org["+award_id+"]["+selectedValues[i]+"]'>\
            <span id='reqins_recognitions-"+selectedValues[i]+"' class='reqError text-danger valley'></span>\
            </div>\
            <div class='form-group level-drp'>\
                <label class='form-label' for='input-1'>Upload Evidence</label>\
                <input class='form-control award_evidence award_evidence-"+selectedValues[i]+"' type='file' name='award_evidence["+selectedValues[i]+"][]' onchange='changeAwardEvidenceImg("+user_id+","+selectedValues[i]+")' multiple=''>\
            </div>\
            <div class='award_evdence-"+selectedValues[i]+"'></div></div>\
            ");

            let $fields = $(".institution_evidence-"+award_id+" .subaward_institution");

            let sortedFields = $fields.sort(function (a, b) {
                return $(a).find(".inslabtext strong").text().localeCompare($(b).find(".inslabtext strong").text());
            });
            console.log("sortedFields",sortedFields);
            $(".institution_evidence-"+award_id).append(sortedFields);
        }  
      }
    }else{
      $('.js-example-basic-multiple'+award_id+'[data-list-id="award_reg-'+award_id+'"]').on('change', function() {
        let selectedValues = $(this).val();
        console.log("selectedValues",selectedValues);
        
        $(".insev-"+award_id).each(function(i,val){
          var val1 = $(val).val();
          console.log("val",val1);
          if(selectedValues.includes(val1) == false){
            $(".subaward_institution-"+val1).remove();
            
          }
        });

        var user_id = "<?php echo Auth::guard('nurse_middle')->user()->id; ?>";
        
        for(var i=0;i<selectedValues.length;i++){
          if($(".subaward_institution-"+selectedValues[i]).length < 1){
            
            var label_text = $(".sub_award_text-"+selectedValues[i]).text();
            //$('.award_country_div-'+award_id).after('\<div class="institution_evidence institution_evidence-'+selectedValues[i]+'"></div>');
            $(".institution_evidence-"+award_id).append("\<div class='subaward_institution subaward_institution-"+selectedValues[i]+"'><input type='hidden' name='insev' class='insev insev-"+award_id+"' value='"+selectedValues[i]+"'><div class='strong_text inslabtext'><strong>"+label_text+"</strong></div><div class='form-group level-drp'>\
              <label class='form-label institution_label' for='input-1'>Issuing Institution/Organization</label>\
              <input type='hidden' name='ins_ev1' class='ins_ev1 ins_ev1-"+selectedValues[i]+"' value='"+selectedValues[i]+"'>\
              <input class='form-control issue_ins issue_ins-"+selectedValues[i]+"' type='text' name='inst_org["+award_id+"]["+selectedValues[i]+"]'>\
              <span id='reqins_recognitions-"+selectedValues[i]+"' class='reqError text-danger valley'></span>\
              </div>\
              <div class='form-group level-drp'>\
                  <label class='form-label' for='input-1'>Upload Evidence</label>\
                  <input class='form-control award_evidence award_evidence-"+selectedValues[i]+"' type='file' name='award_evidence["+selectedValues[i]+"][]' onchange='changeAwardEvidenceImg("+user_id+","+selectedValues[i]+")' multiple=''>\
              </div>\
              <div class='award_evdence-"+selectedValues[i]+"'></div></div>\
              ");

              let $fields = $(".institution_evidence-"+award_id+" .subaward_institution");

            let sortedFields = $fields.sort(function (a, b) {
                return $(a).find(".inslabtext strong").text().localeCompare($(b).find(".inslabtext strong").text());
            });

            $(".institution_evidence-"+award_id).append(sortedFields);
          }  
        }
      });
    }
    
  }


  function submemberships_type(ed, country_org,organization_id,organization_id1,k,l,m){
    
    if(ed == "edit"){
      let selectedValues = $('.js-example-basic-multiple[data-list-id="membership_type-'+organization_id+'"]').val();
      console.log("selectedValues",selectedValues);
      
      $(".show_submembership_type-"+country_org+organization_id1+organization_id+" .submemb_list").each(function(i,val){
        var val1 = $(val).val();
        console.log("val",val1);
        if(selectedValues.includes(val1) == false){
          $(".submembership_type_div-"+val1).remove();
          
        }
      });

      for(var i=0;i<selectedValues.length;i++){
        if($(".show_submembership_type-"+country_org+organization_id1+organization_id+" .submembership_type_div-"+selectedValues[i]).length < 1){
          $("#submitProfessionalMembership").attr("disabled", true);
          $.ajax({
            type: "GET",
            url: "{{ url('/admin/getSubMembershipData') }}",
            data: {organization_id:selectedValues[i]},
            cache: false,
            success: function(data){
              var data1 = JSON.parse(data);
              
              console.log("data1",organization_id);
              
              var membership_text = "";
              for(var j=0;j<data1.membership_type.length;j++){
                
                membership_text += "<li data-value='"+data1.membership_type[j].membership_id+"'>"+data1.membership_type[j].membership_name+"</li>"; 
                
              }
              $(".show_submembership_type-"+country_org+organization_id1+organization_id).append('<div class="submembership_type_div-'+country_org+'-'+data1.organization_id+'"><div class="form-group level-drp o_country_div-'+country_org+' ed-o_subcountry_div-'+organization_id1+' ed-o_membtype_div-'+organization_id+' submembership_type_div submembership_type_div-'+data1.organization_id+' ed-submembership_type_div-'+data1.organization_id+'"><label class="form-label submembership_type_label submembership_type_label-'+country_org+'-'+data1.organization_id+'" for="input-1">'+data1.organization_name+'</label><input type="hidden" name="submemb_list" class="submemb_list submemb_list-'+country_org+'-'+data1.organization_id+'" value="'+data1.organization_id+'"><ul id="submembership_type-'+data1.organization_id+'-'+organization_id+'" style="display:none;">'+membership_text+'</ul><select class="submemb_valid submemb_valid-'+country_org+'-'+data1.organization_id+' js-example-basic-multiple'+country_org+organization_id1+organization_id+' addAll_removeAll_btn" data-list-id="submembership_type-'+data1.organization_id+'-'+organization_id+'" name="submembership_type['+country_org+']['+organization_id1+']['+organization_id+']['+data1.organization_id+'][]" multiple="multiple"></select><span id="reqsubmem_org-'+country_org+'-'+data1.organization_id+'" class="reqError text-danger valley"></span></div>');
              selectTwoFunction(country_org+organization_id1+organization_id);
              
              $("#submitProfessionalMembership").removeAttr("disabled");
              
            }
          });
        }
        //$(".show_membership_type").append('<div class="form-group level-drp organization_subcountry_div"><label class="form-label organization_subcountry_label" for="input-1">'+data1.country_name+':</label><ul id="subcountry_organization-'+data1.organization_id+'" style="display:none;">'+org_text+'</ul><select class="js-example-basic-multiple2 addAll_removeAll_btn" data-list-id="subcountry_organization-'+data1.organization_id+'" id="subcountry_organization_select" name="subcountry_organization[]" multiple="multiple"></select></div>');
        
      }
    }else{
      $('.js-example-basic-multiple'+country_org+organization_id+'[data-list-id="membership_type-'+organization_id+'"]').on('change', function() {
        let selectedValues = $(this).val();
        console.log("selectedValues",selectedValues);

        $(".show_submembership_type-"+country_org+organization_id1+organization_id+" .submemb_list").each(function(i,val){
          var val1 = $(val).val();
          console.log("val",val1);
          if(selectedValues.includes(val1) == false){
            $(".submembership_type_div-"+val1).remove();
            
          }
        });
        

        for(var i=0;i<selectedValues.length;i++){
          if($(".show_submembership_type-"+country_org+organization_id1+organization_id+" .submembership_type_div-"+selectedValues[i]).length < 1){
            $("#submitProfessionalMembership").attr("disabled", true);
            $.ajax({
              type: "GET",
              url: "{{ url('/admin/getSubMembershipData') }}",
              data: {organization_id:selectedValues[i]},
              cache: false,
              success: function(data){
                var data1 = JSON.parse(data);
                
                console.log("data1",organization_id);
                
                var membership_text = "";
                for(var j=0;j<data1.membership_type.length;j++){
                  
                  membership_text += "<li data-value='"+data1.membership_type[j].membership_id+"'>"+data1.membership_type[j].membership_name+"</li>"; 
                  
                }
                $(".show_submembership_type-"+country_org+organization_id1+organization_id).append('<div class="submembership_type_div submembership_type_div-'+country_org+'-'+data1.organization_id+'"><div class="form-group level-drp o_country_div-'+country_org+' ed-o_subcountry_div-'+organization_id1+' ed-o_membtype_div-'+organization_id+' submembership_type_div submembership_type_div-'+data1.organization_id+' ed-submembership_type_div-'+data1.organization_id+'"><label class="form-label submembership_type_label submembership_type_label-'+country_org+'-'+data1.organization_id+'" for="input-1">'+data1.organization_name+'</label><input type="hidden" name="submemb_list" class="submemb_list submemb_list-'+country_org+'-'+data1.organization_id+'" value="'+data1.organization_id+'"><ul id="submembership_type-'+data1.organization_id+'-'+organization_id+'" style="display:none;">'+membership_text+'</ul><select class="submemb_valid submemb_valid-'+country_org+'-'+data1.organization_id+' js-example-basic-multiple'+country_org+organization_id1+organization_id+' addAll_removeAll_btn" data-list-id="submembership_type-'+data1.organization_id+'-'+organization_id+'" name="submembership_type['+country_org+']['+organization_id1+']['+organization_id+']['+data1.organization_id+'][]" multiple="multiple"></select><span id="reqsubmem_org-'+country_org+'-'+data1.organization_id+'" class="reqError text-danger valley"></span></div>');
                
                let $fields = $(".show_submembership_type-"+country_org+organization_id1+organization_id+" .submembership_type_div");

let sortedFields = $fields.sort(function (a, b) {
    return $(a).find(".submembership_type_label").text().localeCompare($(b).find(".submembership_type_label").text());
});

$(".show_submembership_type-"+country_org+organization_id1+organization_id).append(sortedFields);

                selectTwoFunction(country_org+organization_id1+organization_id);
                
                $("#submitProfessionalMembership").removeAttr("disabled");
              }
            });
          }
          //$(".show_membership_type").append('<div class="form-group level-drp organization_subcountry_div"><label class="form-label organization_subcountry_label" for="input-1">'+data1.country_name+':</label><ul id="subcountry_organization-'+data1.organization_id+'" style="display:none;">'+org_text+'</ul><select class="js-example-basic-multiple2 addAll_removeAll_btn" data-list-id="subcountry_organization-'+data1.organization_id+'" id="subcountry_organization_select" name="subcountry_organization[]" multiple="multiple"></select></div>');
          
        }
      });
    }
  }
  

  function selectTwoFunction(select_id){
    
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
    $('.addAll_removeAll_btn').on('select2:open', function() {
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

            $('.js-example-basic-multiple'+select_id).select2();

            // Dynamically add the clear button
            const clearButton = $('<span class="clear-btn">✖</span>');
            $('.select2-container').append(clearButton);

            // Handle the visibility of the clear button
            function toggleClearButton() {

                const selectedOptions = $('.js-example-basic-multiple'+select_id).val();
                if (selectedOptions && selectedOptions.length > 0) {
                    clearButton.show();
                } else {
                    clearButton.hide();
                }
            }

            // Attach change event to select2
            $('.js-example-basic-multiple'+select_id).on('change', toggleClearButton);

            // Clear button click event
            clearButton.click(function() {

                $('.js-example-basic-multiple'+select_id).val(null).trigger('change');
                toggleClearButton();
            });

            // Initial check
            toggleClearButton();
            $('.js-example-basic-multiple'+select_id).each(function() {
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
          }
</script>



<script type="text/javascript">
  $('.js-example-basic-multiple').each(function() {
    let listId = $(this).data('list-id');
    let items = [];
    console.log("listId1", listId);
    $('#' + listId + ' li').each(function() {
      console.log("value1", $(this).text());
      items.push({
        id: $(this).data('value'),
        text: $(this).text()
      });
    });
    console.log("items1", items);
    $(this).select2({
      data: items
    });
  });

  // $('.js-example-basic-multiple[data-list-id="organization_country"]').select2().val([1,2]).trigger('change');
  // $('.js-example-basic-multiple2[data-list-id="country_organization-2"]').select2().val([14,15]).trigger('change');
  // if ($(".professional_as").val() != "") {
  //   var professional_as = JSON.parse($(".professional_as").val());
  //   console.log("professional_as", professional_as);
  //   $('.js-example-basic-multiple[data-list-id="des_profession_association"]').select2().val(professional_as).trigger('change');
  // }
  // var org_country = JSON.parse($(".org_country").val());
  // console.log("org_country", org_country);

  // var or_count = [];
  // for(var i=0;i<org_country.length;i++){
  //   or_count.push(org_country[i].organization_country);

  // }
  // console.log("org_country1", or_count);

  

  // if ($(".subawards_recognition_input").val() != "") {
  //   var awards_recognition_input = JSON.parse($(".awards_recognition_input").val());
  //   $('.js-example-basic-multiple[data-list-id="awards_recognitions"]').select2().val(awards_recognition_input).trigger('change');
  // }

  // if ($(".organization_name").val() != "") {
  //   var organization_name = JSON.parse($(".organization_name").val());
  //   $('.js-example-basic-multiple[data-list-id="des_profession_association"]').select2().val(organization_name).trigger('change');
  // }
 
  if ($(".org_country").val() != "") {
    var org_country = JSON.parse($(".org_country").val());
    $('.js-example-basic-multiple[data-list-id="organization_country"]').select2().val(org_country).trigger('change');
    
    for(var i=0;i<org_country.length;i++){
      if ($(".country_org-"+org_country[i]).val() != "") {
        var suborg_country = JSON.parse($(".country_org-"+org_country[i]).val());
        $('.js-example-basic-multiple[data-list-id="country_organization-'+org_country[i]+'"]').select2().val(suborg_country).trigger('change');
        
        for(var j=0;j<suborg_country.length;j++){
          var scountorg = org_country[i].toString() + suborg_country[j].toString();
          if ($(".subcountry_org-"+scountorg).val() != "") {
            var subsuborg_country = JSON.parse($(".subcountry_org-"+scountorg).val());
            
            console.log("subsuborg_country"+scountorg,subsuborg_country);
            $('.js-example-basic-multiple[data-list-id="subcountry_organization-'+scountorg+'"]').select2().val(subsuborg_country).trigger('change');
            
            for(var k=0;k<subsuborg_country.length;k++){
              if ($(".memb_type_input-"+subsuborg_country[k]).val() != "") {
                var membership_type = JSON.parse($(".memb_type_input-"+subsuborg_country[k]).val());
                $('.js-example-basic-multiple[data-list-id="membership_type-'+subsuborg_country[k]+'"]').select2().val(membership_type).trigger('change');

                for(var l=0;l<membership_type.length;l++){
                  var submembership_type = JSON.parse($(".submemb_type_input-"+subsuborg_country[k]+"-"+membership_type[l]).val());
                  
                  $('.js-example-basic-multiple[data-list-id="submembership_type-'+membership_type[l]+"-"+subsuborg_country[k]+'"]').select2().val(submembership_type).trigger('change');
                }
              }
              
            }

          }
        }
      }  
    }
  }

  if ($(".awards_recognition_input").val() != "") {
    var awards_recognition_input = JSON.parse($(".awards_recognition_input").val());
    
    $('.js-example-basic-multiple[data-list-id="awards_recognitions"]').select2().val(awards_recognition_input).trigger('change');
    for(var m=0;m<awards_recognition_input.length;m++){
      if ($(".subawards_recognition_input-"+awards_recognition_input[m]).val() != "") {
        var subawards_recognition_input = JSON.parse($(".subawards_recognition_input-"+awards_recognition_input[m]).val());
        console.log("subawards_recognition_input",awards_recognition_input[m]);
        $('.js-example-basic-multiple[data-list-id="award_reg-'+awards_recognition_input[m]+'"]').select2().val(subawards_recognition_input).trigger('change');
      }
    }
  }
  
  
  



  $("#tab-professional-membership").insertAfter("#tab-educert");
  $("#tab-vaccination").insertAfter("#tab-educert");

  // Function to initialize Select2 for dynamically created select elements
  function initializeSelect2($dropdown) {
    $dropdown.on('select2:open', function() {
      var $currentDropdown = $(this);
      var searchBoxHtml = `
      <div class="extra-buttons">
        <button class="select-all-button" type="button">Select All</button>
        <button class="remove-all-button" type="button">Remove All</button>
      </div>`;

      // Add select all/remove all buttons
      $('.select2-results').prepend(searchBoxHtml);

      $('.select-all-button').on('click', function() {
        var allValues = $currentDropdown.find('option').map(function() {
          return $(this).val();
        }).get();
        $currentDropdown.val(allValues).trigger('change');
      });

      $('.remove-all-button').on('click', function() {
        $currentDropdown.val(null).trigger('change');
      });
    });
  }

  var url_string = window.location.href;
  var url = new URL(url_string);
  var c = url.searchParams.get("page");
  if (c == "professional_membership") {

    $(".tab-pane").hide();
    $("#tab-professional-membership").css("opacity", "1");
    $("#tab-professional-membership").show();
    $(".profile_tabs").removeClass("active");
    $("#professional_membership").addClass("active");

  }

  $(document).ready(function() {
    $('#residencyId').change(function() {
      var residencyId = $(this).val();
      $('#passport_detail_date').hide();
      $('#passport_detail').hide();
      if (residencyId !== 'Citizen') {
        if (residencyId == 'Visa Holder') {
          $('#passport_detail_date').show();
        }
        $('#passport_detail').show();

      }
    });
  });

  function professional_membership_form() {
    var isValid = true;

    var profess_award = $(".profmemaward").val();
    var award = $(".award_question").val();

    if ($('[name="profmemaward"]').val() == '') {

      document.getElementById("professional_awards").innerHTML = "* Please select Yes or No";
      isValid = false;

    }

    if ($('[name="award_question"]').val() == '') {

      document.getElementById("professional_awards_que").innerHTML = "* Please select Yes or No";
      isValid = false;

    }

    if(profess_award == "Yes"){

      if ($('[name="organization_country[]"]').val() == '') {

        document.getElementById("reqorganization_country").innerHTML = "* Please select the Organization Country";
        isValid = false;

      }

      
      $(".country_org_list").each(function(i,val) {
        console.log("val",$(this).val());
        var val1 = $(this).val();
        var label_name1 = $(".organization_country_label-"+val1).text();
        if ($(".country_org_valid-" + val1).length > 0) {
          //console.log("reference_relationship-" + m, $(".reference_relationship-" + m).val());
          if ($(".country_org_valid-" + val1).val() == '') {
            document.getElementById("reqcountry_org-" + val1).innerHTML = "* Please enter the "+label_name1;
            isValid = false;
          }
        }

        $(".subcountry_org_list").each(function(i,val) {
          console.log("val",$(this).val());
          var val2 = $(this).val();
          var label_name2 = $(".organization_subcountry_label-"+val1+val2).text();
          if ($(".sub_country_org-" + val1+val2).length > 0) {
            //console.log("reference_relationship-" + m, $(".reference_relationship-" + m).val());
            if ($(".sub_country_org-" + val1+val2).val() == '') {
              document.getElementById("reqsubcountry_org-" + val1+val2).innerHTML = "* Please enter the "+label_name2;
              isValid = false;
            }
          }

          
        });

        $(".subsubcountry_org_list").each(function(i,val) {
          console.log("val",$(this).val());
          var val3 = $(this).val();
          var label_name3 = $(".membership_type_label-"+val1+val3).text();
          if ($(".membership_type_org-" + val1+val3).length > 0) {
            //console.log("reference_relationship-" + m, $(".reference_relationship-" + m).val());
            if ($(".membership_type_org-" + val1+val3).val() == '') {
              document.getElementById("reqmembershiptype-" + val1+val3).innerHTML = "* Please enter the "+label_name3;
              isValid = false;
            }
          }
          $(".graduation_start_date").each(function(i,val) {
            console.log("val12",val1+val3);
            var val5 = $(this).val();
            
            if ($(".graduation_start_date-"+val1+val3).length > 0) {
              //console.log("reference_relationship-" + m, $(".reference_relationship-" + m).val());
              if ($(".graduation_start_date-"+val1+val3).val() == '') {
                document.getElementById("reqjoined_date-"+val1+val3).innerHTML = "* Please enter the Joined Date";
                isValid = false;
              }
            }
          });

          $(".profmemstatus").each(function(i,val) {
            console.log("val12",val1+val3);
            var val5 = $(this).val();
            
            if ($(".profmemstatus-"+val1+val3).length > 0) {
              //console.log("reference_relationship-" + m, $(".reference_relationship-" + m).val());
              if ($(".profmemstatus-"+val1+val3).val() == '') {
                document.getElementById("reqmembership_status-"+val1+val3).innerHTML = "* Please enter the Membership Status";
                isValid = false;
              }
            }
          });

          

          
        });

        $(".submemb_list").each(function(i,val) {
          console.log("val",$(this).val());
          var val4 = $(this).val();
          var label_name4 = $(".submembership_type_label-"+val1+"-"+val4).text();
          if ($(".submemb_valid-"+val1+"-"+val4).length > 0) {
            //console.log("reference_relationship-" + m, $(".reference_relationship-" + m).val());
            if ($(".submemb_valid-"+val1+"-"+val4).val() == '') {
              document.getElementById("reqsubmem_org-"+val1+"-"+val4).innerHTML = "* Please enter the "+label_name4;
              isValid = false;
            }
          }
        });

        
      });
    }

    if(award == "Yes"){
      
      if ($('[name="awards_recognitions[]"]').val() == '') {
        document.getElementById("reqawards_recognitions").innerHTML = "* Please enter the Awards & Recognitions";
        isValid = false;
      }

      $(".subaward_list").each(function(i,val) {
            
        console.log("val",$(this).val());
        var val6 = $(this).val();
        var label_name5 = $(".subaward_label-"+val6).text();
        if ($(".sub_award_org-"+val6).length > 0) {
          //console.log("reference_relationship-" + m, $(".reference_relationship-" + m).val());
          if ($(".sub_award_org-"+val6).val() == '') {
            document.getElementById("reqsubawards_recognitions-"+val6).innerHTML = "* Please enter the "+label_name5;
            isValid = false;
          }
        }

        
      });

      $(".ins_ev1").each(function(i,val) {
            
        console.log("val",$(this).val());
        var val6 = $(this).val();
        //var label_name5 = $(".subaward_label-"+val6).text();
        if ($(".issue_ins-"+val6).length > 0) {
          //console.log("reference_relationship-" + m, $(".reference_relationship-" + m).val());
          
          if ($(".issue_ins-"+val6).val() == '') {
            document.getElementById("reqins_recognitions-"+val6).innerHTML = "* Please enter the Issuing Institution/Organization";
            isValid = false;
          }
        }
      });
    }
    
    if ($(".professional_declare_information").prop('checked') == false) {
      
      document.getElementById("reqdeclare_information_profess").innerHTML = "* Please check this checkbox";
      isValid = false;
    }

   
    
    if (isValid == true) {

      $.ajax({
        url: "{{ route('admin.updateProfessionalMembership') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#professional_memb_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitProfessionalMembership').prop('disabled', true);
          $('#submitProfessionalMembership').text('Process....');
        },
        success: function(res) {
          $('#submitProfessionalMembership').prop('disabled', false);
          $('#submitProfessionalMembership').text('Update Profile');
          console.log("res.status",res.status);
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Professional Membership Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('admin.professional_membership_awards',['id'=>$user_id]) }}";
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
        $('#submitProfessionalMembership').prop('disabled', false);
        $('#submitProfessionalMembership').text('Save Changes');
        console.log("errorss", errorss);
        for (var err in errorss.responseJSON.errors) {
          $("#submitProfessionalMembership").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
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

