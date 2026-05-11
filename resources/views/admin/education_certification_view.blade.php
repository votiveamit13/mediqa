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
        </div>
    </div>
</div>
@endsection