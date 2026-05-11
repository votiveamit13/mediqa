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
                        
                        <div class="card-body p-3 px-md-4">
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
                                                                        <?php
                                                                            $other_evidence_data = DB::table("other_evidance")->where("other_vcc_id",$other->id)->get();    
                                                                        ?>
                                                                        @if(!empty($other_evidence_data))
                                                                        @foreach ($other_evidence_data as $other_evidence)
                                                                        <div class="file-item">
                                                                            <a href="{{ asset('uploads/evidence/' . $other_evidence->original_name) }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i> {{$other_evidence->original_name}}</a>
                                                                        </div>
                                                                        @endforeach
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection