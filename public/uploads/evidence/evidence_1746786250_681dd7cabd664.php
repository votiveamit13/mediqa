@extends('admin.layouts.layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

    .trans_img {
        margin-bottom: 5px;
        display: flex;
    }

    .trans_img i.fa {
        position: relative;
        left: 0px;
        font-size: 14px;
        line-height: 25px;
        margin-right: 5px;
        color: #000000;
    }

    .trans_img .close_btn i {
        margin-left: 10px;
        line-height: 22px;
    }

    .badge {
        display: inline-block;
        padding: .35em .65em;
        font-size: .75em;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25rem;
    }

    .btn-warning {
        color: #000;
        background-color: #ffc107;
        border-color: #ffc107;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Edit Nurse</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted " href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Edit Nurse</li>
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
    <div class="card">
        <div class="card-body">
          <?php 
            $expid = request()->route('id');
          ?>
            <ul class="nav nav-pills nav-fill mt-4 tabs-feat" role="tablist">
                
                <li class="nav-item " role="presentation">
                    <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-1']): route('admin.add_nurse', ['tab' => 'tab-1'])}}"
                        aria-selected="true">
                        <span>Basic Details</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-2']): route('admin.add_nurse', ['tab' => 'tab-2'])}}" aria-selected="false" >
                        <span>Setting</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-3']): route('admin.add_nurse', ['tab' => 'tab-3'])}}" aria-selected="false" >
                        <span>Profession</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-4']): route('admin.add_nurse', ['tab' => 'tab-4'])}}" aria-selected="false" >
                        <span>Education and Certifications</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link  {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-5']): route('admin.add_nurse', ['tab' => 'tab-7'])}}" aria-selected="false" >
                        <span>Experience</span>
                    </a>
                </li>
                
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-6']): route('admin.add_nurse', ['tab' => 'navpill-5.1'])}}" aria-selected="false" >
                        <span>References</span>
                    </a>
                </li>
                
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-7']): route('admin.add_nurse', ['tab' => 'tab-6'])}}" aria-selected="false" >
                        <span>Mandatory Training</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link  {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-8']): route('admin.add_nurse', ['tab' => 'navpill-7'])}}" aria-selected="false">
                        <span>Vaccinations</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link  {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-9']): route('admin.add_nurse', ['tab' => 'navpill-8'])}}" aria-selected="false">
                        <span>Checks and Clearances</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-10']): route('admin.add_nurse', ['tab' => 'navpill-9'])}}" aria-selected="false" >
                        <span>Professional Memberships</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-11']): route('admin.add_nurse', ['tab' => 'navpill-10'])}}" aria-selected="false" >
                        <span>Interview</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-12']): route('admin.add_nurse', ['tab' => 'navpill-11'])}}" aria-selected="false" >
                        <span>Personal Preferences</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-13']): route('admin.add_nurse', ['tab' => 'navpill-12'])}}" aria-selected="false" >
                        <span>Job Search Preferences</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link  {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-14']): route('admin.add_nurse', ['tab' => 'navpill-13'])}}" aria-selected="false"
                        tabindex="-1">
                        <span>Testimonials and Reviews</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link  {{ $expid!='' ? '' : 'disabled' }}" href="{{ $expid!=''?route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-15']): route('admin.add_nurse', ['tab' => 'navpill-14'])}}" aria-selected="false" >
                        <span>Additional Information</span>
                    </a>
                </li>
            </ul>

            <?php
                $passport_number=$country_id=$visa_grant_number=$support_document1=$support_document0='';
                $visa_subclass=$passport_number1=$country_id1=$visa_grant_number1=$support_document2='';
                
                if($work_eligibility)
                {
                if($work_eligibility['residency']=='Australian Citizen')
                {
                    $support_document0=$work_eligibility['support_document'];
                }
                if($work_eligibility['residency']=='Permanent Resident')
                {
                    $passport_number=$work_eligibility['passport_number'];
                    $country_id=$work_eligibility['country_id'];
                    $visa_grant_number=$work_eligibility['visa_grant_number'];
                    $support_document1=$work_eligibility['support_document'];
                    $visa_subclass=$work_eligibility['visa_subclass'];
                }
                
                if($work_eligibility['residency']=='Visa Holder')
                {
                    $passport_number1=$work_eligibility['passport_number'];
                    $country_id1=$work_eligibility['country_id'];
                    $visa_grant_number1=$work_eligibility['visa_grant_number'];
                    $support_document2=$work_eligibility['support_document'];
                    $visa_subclass=$work_eligibility['visa_subclass'];
                }
                }
            ?>
            
            <div class="tab-pane p-3" id="tab-9" role="tabpanel">
                <div class="row">
                    <div class="card shadow-sm border-0 p-4 mt-30">
                        <h3 class="mt-2 color-brand-1 mb-2">Residency and Work Eligibility</h3>
                        <form id="multi-step-form-eligibility" enctype="multipart/form-data">
                        @csrf
                        
                            <div class="form-group mt-3">
                            <input type="hidden" value="{{ $profileData->id ?? null }}" name="user_id">
                            <label class="form-label" for="input-1">Residency</label>
                            <select class="form-control" name="residency" id="residency_text">
                                <option value="">Select</option>
                                <option value="Australian Citizen" {{($work_eligibility)?($work_eligibility['residency']=='Australian Citizen'?'selected':''):''}}>Australian Citizen</option>
                                <option value="Permanent Resident" {{($work_eligibility)?($work_eligibility['residency']=='Permanent Resident'?'selected':''):''}}>Permanent Resident</option>
                                <option value="Visa Holder" {{($work_eligibility)?($work_eligibility['residency']=='Visa Holder'?'selected':''):''}}>Visa Holder</option>
                            </select>
                            <span id="reqTxtresidencyId" class="reqError text-danger valley"></span>
                            </div>
                        
                            <div id="australian_citizen">
                            <div class="form-group mt-3">
                                <label class="font-sm color-text-mutted mb-10">Type of Evidence *</label>
                                <select class="form-control" name="evidence_type" id="aus_evidence_type" >
                                <option value="">Select Evidence</option>
                                <option value="Australian Passport" {{($work_eligibility)?($work_eligibility['evidence_type']=='Australian Passport'?'selected':''):''}}>Australian Passport (Photo identification page)</option>
                                <option value="Australian Citizenship Certificate" {{($work_eligibility)?($work_eligibility['evidence_type']=='Australian Citizenship Certificate'?'selected':''):''}}>Australian Citizenship Certificate</option>
                                <option value="Full Australian Birth Certificate" {{($work_eligibility)?($work_eligibility['evidence_type']=='Full Australian Birth Certificate'?'selected':''):''}}>Full Australian Birth Certificate</option>
                                </select>

                                <span id="reqTxtvisa_subclass_numberId" class="reqError text-danger valley"></span>
                            </div>

                            <div class="form-group mt-3">
                                <label class="form-label" for="input-1">Upload Evidence</label>
                            
                                <?php if($support_document0!=''){ ?>
                                <a href="{{ asset('uploads/support_document/'.$support_document0) }}" target="_blank"><span class="btn-primary badge badge-primary">Show</span></a>
                                <?php } ?>
            
                                <input type="file" name="upload_evidence0" id="{{$support_document0==''?'upload_evidence0':''}}" class="form-control h-100" accept="image/*">
                                
                                <?php if($support_document0!=''){ ?>  
                                <a href="{{ asset('uploads/support_document/'.$support_document0) }}" target="_blank" class="mt-2"> <img src="{{ asset('uploads/support_document/'.$support_document0) }}" width="50px;" height="50px" /> </a>
                                <?php } ?>
                                <span id="reqasupport_document" class="reqError text-danger valley"></span>
                            </div>
                            </div>

                            <div id="permanent_resident">
                            <div class="form-group mt-3">
                                <label class="font-sm color-text-mutted mb-10">Passport Number *</label>
                                <input class="form-control" type="text" name="passport_number" id="perm_passport_number" placeholder="Passport Number" value="{{ $passport_number}}">

                                <span id="reqTxtvisa_grant_number" class="reqError text-danger valley"></span>
                            </div>
                            

                            <div class="form-group mt-3">
                                <label class="font-sm color-text-mutted mb-10">Country *</label>
                                <select class="form-control form-select" name="country_id" id="perm_country_id">
                                <option value="">Select Country</option>
                                
                                @php $country_data=country_name_from_db();@endphp
                                @foreach ($country_data as $data)
                                <option value="{{$data->id}}" <?= $country_id == $data->id ? 'selected' : '' ?>> {{$data->name}} </option>
                                @endforeach
                                </select>
                                <span id="reqTxtpassportcountryI" class="reqError text-danger valley"></span>
                            </div>
                            

                            <div class="form-group mt-3">
                                <label class="font-sm color-text-mutted mb-10">Visa Subclass *</label>
                                <select name="visa_subclass" class="form-control" id="perm_visa_subclass">
                                <option value="" disabled>Select Visa Subclass</option>
                                @foreach($visaSubclasses as $head => $subclasses)
                                    <optgroup label="{{ $head }}">
                                        @foreach($subclasses as $subclass)
                                            <option value="{{ $subclass->id }}" {{$visa_subclass==$subclass->id?'selected':''}} >{{ $subclass->sublcass_text }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                                </select>
                                <span id="reqTxtpassportcountryI" class="reqError text-danger valley"></span>
                            </div>
                            

                            <div class="form-group mt-3">
                                <label class="font-sm color-text-mutted mb-10">Visa Grant Number *</label>
                                <input class="form-control" type="text" name="visa_grant_number" id="perm_visa_grant_number" placeholder="Visa Grant Number" value="{{ $visa_grant_number }}">
                                <span id="reqTxtvisa_grant_number" class="reqError text-danger valley"></span>
                            </div>
                            

                            <div class="form-group mt-3">
                                <label class="font-sm color-text-mutted mb-10">Type of Evidence *</label>
                                <select class="form-control" name="evidence_type1" id="perm_evidence_type" >
                                <option value="">Select Evidence</option>
                                <option value="Permanent Residency visa grant letter" {{($work_eligibility)?($work_eligibility['evidence_type']=='Permanent Residency visa grant letter'?'selected':''):''}}>Permanent Residency visa grant letter</option>
                                <option value="VEVO (Visa Entitlement Verification Online) status report" {{($work_eligibility)?($work_eligibility['evidence_type']=='VEVO (Visa Entitlement Verification Online) status report'?'selected':''):''}}>VEVO (Visa Entitlement Verification Online) status report</option>
                                <option value="Passport bio-data page and visa pages" {{($work_eligibility)?($work_eligibility['evidence_type']=='Passport bio-data page and visa pages'?'selected':''):''}}>Passport bio-data page and visa pages</option>
                                <option value="Medicare card" {{($work_eligibility)?($work_eligibility['evidence_type']=='Medicare card'?'selected':''):''}}>Medicare card</option>
                                </select>
                                <span id="reqTxtvisa_subclass_numberId" class="reqError text-danger valley"></span>
                            </div>
                            
                            <div class="form-group mt-3">
                                <label class="form-label" for="input-1">Upload Evidence</label>
                            
                                <?php if($support_document1!=''){ ?>
                                <a href="{{ asset('uploads/support_document/'.$support_document1) }}" target="_blank"><span class="btn-primary badge badge-primary">Show</span></a>
                                <?php } ?>
            
                                <input type="file" name="upload_evidence1" id="{{$support_document1==''?'upload_evidence1':''}}" class="form-control h-100" accept="image/*">
                                
                                <?php if($support_document1!=''){ ?>  
                                <a href="{{ asset('uploads/support_document/'.$support_document1) }}" target="_blank" class="mt-2"> <img src="{{ asset('uploads/support_document/'.$support_document1) }}" width="50px;" height="50px" /> </a>
                                <?php } ?>
                                <span id="reqasupport_document" class="reqError text-danger valley"></span>
                            </div>
                            </div>
                            
                            <div id="visa_holder" >
                            <div class="form-group mt-3">
                                
                                <label class="font-sm color-text-mutted mb-10">Passport Number *</label>
                                <input class="form-control" type="text" name="passport_number1" id="hold_passport_number" value="{{ $passport_number1}}" >
                                <span id="reqTxtpassport_number" class="reqError text-danger valley"></span>
                            </div>
                            

                            <div class="form-group mt-3">
                                <label class="font-sm color-text-mutted mb-10">Country *</label>
                                <select class="form-control form-select" name="country_id1" id="hold_country_id">
                                <option value="">Select Country</option>
                                
                                @php $country_data=country_name_from_db();@endphp
                                @foreach ($country_data as $data)
                                <option value="{{$data->id}}" <?= $country_id1 == $data->id ? 'selected' : '' ?>> {{$data->name}} </option>
                                @endforeach
                                </select>
                                <span id="reqTxtpassportcountryI" class="reqError text-danger valley"></span>
                            </div>
                            

                            <div class="form-group mt-3">
                                <label class="font-sm color-text-mutted mb-10">Visa Subclass *</label>
                                <select class="form-control" name="visa_subclass1" id="visa_holder_subcls" >
                                <option value="">Select Visa Subclass</option>
                                    @foreach($visaholderSubclasses as $visa_sub)
                                    <option value="{{ $visa_sub->id }}" {{$visa_subclass==$visa_sub->id?'selected':''}}>{{ $visa_sub->sublcass_text }}</option>
                                    @endforeach
                                </select>
                                <span id="reqTxtvisa_subclass_numberId" class="reqError text-danger valley"></span>
                            </div>
                            
                            
                            <div class="form-group mt-3" id="other_visa_type">
                                <label class="font-sm color-text-mutted mb-10">Please specify your Visa type </label>
                                <input class="form-control" type="text" name="other_visa_type" id="hold_visa_type" placeholder="" value="{{($work_eligibility)?$work_eligibility['other_visa_type']:''}}">
                                <span id="reqTxtvisa_subclass_numberId" class="reqError text-danger valley"></span>
                            </div>

                            <div class="form-group mt-3">
                                <label class="font-sm color-text-mutted mb-10">Visa Grant Number </label>
                                <input class="form-control" type="text" name="visa_grant_number1" id="hold_visa_grant_number" placeholder="" value="{{ $visa_grant_number1}}">
                                <span id="reqTxtvisa_subclass_numberId" class="reqError text-danger valley"></span>
                            </div>

                            <div class="form-group mt-3">
                                <label class="font-sm color-text-mutted mb-10">Type of Evidence *</label>
                                <select class="form-control" name="evidence_type2" id="hold_evidence_type" >
                                <option value="">Select Evidence</option>
                                <option value="New Zealand Passport" {{($work_eligibility)?($work_eligibility['evidence_type']=='New Zealand Passport'?'selected':''):''}}>New Zealand Passport (Photo identification page)</option>
                                <option value="Visa grant letter" {{($work_eligibility)?($work_eligibility['evidence_type']=='Visa grant letter'?'selected':''):''}}>Visa grant letter</option>
                                <option value="VEVO (Visa Entitlement Verification Online) status report" {{($work_eligibility)?($work_eligibility['evidence_type']=='VEVO (Visa Entitlement Verification Online) status report'?'selected':''):''}}>VEVO (Visa Entitlement Verification Online) status report</option>
                                <option value="Passport bio-data page and visa pages" {{($work_eligibility)?($work_eligibility['evidence_type']=='Passport bio-data page and visa pages'?'selected':''):''}}>Passport bio-data page and visa pages</option>
                                </select>
                                <span id="reqTxtvisa_subclass_numberId" class="reqError text-danger valley"></span>
                            </div>
                            
                            <div class="form-group mt-3">
                                <label class="form-label" for="input-1">Upload Evidence</label>
                            
                                <?php if($support_document2!=''){ ?>
                                <a href="{{ asset('uploads/support_document/'.$support_document2) }}" target="_blank"><span class="btn-primary badge badge-primary">Show</span></a>
                                <?php } ?>
            
                                <input type="file" name="upload_evidence2" id="{{$support_document2==''?'upload_evidence2':''}}" class="form-control h-100" accept="image/*">
                                
                                <?php if($support_document2!=''){ ?>  
                                <a href="{{ asset('uploads/support_document/'.$support_document2) }}" target="_blank" class="mt-2"> <img src="{{ asset('uploads/support_document/'.$support_document2) }}" width="50px;" height="50px" /> </a>
                                <?php } ?>
                                <span id="reqasupport_document" class="reqError text-danger valley"></span>
                            </div>

                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-3">
                                <button onclick="doeligibility_to_work()"  class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                                    <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!--[NDIS Worker Screening Check]-->
                    <div class="card shadow-sm border-0 p-4 mt-30">
                        <h3 class="mt-0 color-brand-1 mb-2">NDIS Worker Screening Check</h3>
                        <span>A <strong>NDIS Worker Screening Clearance</strong> is nationally recognized and can be used across all states and territories in Australia. It is required for aged care workers who are involved with National Disability Insurance Scheme (NDIS) participants.</span>
                        
                        <form id="multi-step-form-ndis" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group mt-3">
                                <input type="hidden" value="{{ $profileData->id ?? null }}" name="user_id">
                                <label>State *</label>
                                <select class="form-control form-select" name="ndis_state" id="ndis_state">
                                    <option value="">Select State</option>
                                    @php
                                      $state_data =state_name_array( $profileData->country);
                                    @endphp
                                    <?php $ndis_state_id=$ndis!=''? $ndis['state_id']:''; ?>
                                    @if(isset($state_data) && !empty($state_data))
                                    @foreach ($state_data as $data_state)
                                    <option value="{{$data_state->id}}" <?= $ndis_state_id  == $data_state->id ? 'selected' : '' ?>> {{$data_state->name}} </option>
                                    @endforeach
                                    @endif
                                </select>
                                <span id="reqTxtclearancestateI" class="reqError text-danger valley"></span>
                                </div>
                                
                            
                            <div class="form-group mt-3">
                                <label class="font-sm color-text-mutted mb-10">NDIS Worker Clearance Number *</label>
                                <input class="form-control" type="text" name="ndis_worker_clearance_number" id="ndis_worker_clearance_number" value="{{ $ndis!=''? $ndis['clearance_number']:'' }}">
                                <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>
                            </div>
                            

                            <div class="form-group mt-3">
                                <label class="font-sm color-text-mutted mb-10">Expiry Date*</label>
                                <input class="form-control" type="date" name="ndis_expiry_date" id="ndis_expiry_date" value="{{ $ndis!=''? $ndis['expiry_date']:'' }}" min="{{ date('Y-m-d') }}">
                                <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>
                            </div>
                            

                            <div class="form-group mt-3">
                                <label class="font-sm color-text-mutted mb-10">Upload Evidence*</label>
                                <input class="form-control" type="file" name="ndis_evidence" id="{{$ndis!=''?($ndis['evidence_file']!=''?'':'ndis_evidence'):'ndis_evidence'}}">

                                <?php if($ndis!=''){ ?>  
                                <a href="{{ asset('uploads/support_document/'.$ndis['evidence_file']) }}" target="_blank" class="mt-2"> <img src="{{ asset('uploads/support_document/'.$ndis['evidence_file']) }}" width="50px;" height="50px" /> </a>
                                <?php } ?>

                                <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>
                            </div>
                            

                            <div class="col-md-3 mt-3">
                                <div class="d-flex align-items-center justify-content-between">
                                <button onclick="ndisupdates()" class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                                    <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                                    <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>


                    <!--[Working With Children Check]-->
                    <div class="card shadow-sm border-0 p-4 mt-30">
                    <h3 class="mt-0 color-brand-1 mb-2">Working With Children Check (WWCC)</h3>
                    <div>In Australia <strong>WWCC</strong> or equivalent clearances are generally not transferable between states and territories.</div>
                    <form id="multi-step-form-children" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        @php
                        $state_data =state_name_array( 'AU');
                        @endphp
                        <input type="hidden" value="{{ $profileData->id ?? null }}" name="user_id">
                        <div id="wwcc_more" >
                            <?php if($ww_child!=''){
                            $k=1;
                            foreach($ww_child as $work_child){ ?>

                            <div class="add_wwcc" >
                            <h6>WWCC {{$k}}</h6>
                            <div class="col-md-12 mt-3">
                                <input type="hidden" name="wwcc_id[]" value="{{ $work_child->id }}"/>
                                <div class="form-group position-relative">
                                
                                <label>State *</label>
                                <select class="form-control form-select wwcc_state" name="wwcc_state[]"  >
                                    <option value="">Select State</option>
                                    @if(isset($state_data) && !empty($state_data))
                                    @foreach ($state_data as $data_state)
                                    <option value="{{$data_state->id}}" {{$work_child->state_id==$data_state->id?'selected':''}} > {{$data_state->name}} </option>
                                    @endforeach
                                    @endif
                                </select>
                                </div>
                                <span id="reqTxtclearancestateI" class="reqError text-danger valley"></span>
                            </div>

                            <div class="form-group mt-3">
                                <label class="font-sm color-text-mutted mb-10 state_label">Clearance Number*</label>
                                <input class="form-control wwcc_clearance" type="text" name="wwcc_clearance_number[]" placeholder="" value="{{ $work_child->clearance_number}}">
                            </div>
                            <span id="reqTxtclearance_numberI" class="reqError text-danger valley"></span>

                            <div class="form-group mt-3">
                                
                                <label class="font-sm color-text-mutted mb-10">Expiry Date*</label>
                                <input class="form-control clearance_expiry" type="date" name="wwcc_expiry_date[]" value="{{ $work_child->expiry_date }}" min="{{ date('Y-m-d') }}">
                            </div>
                            <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>

                            <div class="form-group mt-3">
                                <label class="font-sm color-text-mutted mb-10">Upload Evidence*</label>
                                <input class="form-control {{ $work_child->wwcc_evidence==''?'wwcc_evidence':'' }}" type="file" name="wwcc_evidence[]" value="{{ $work_child->evidence_original_name }}">
                                <?php if($work_child->wwcc_evidence!=''){ ?>  
                                <a href="{{ asset('uploads/support_document/'.$work_child->wwcc_evidence) }}" target="_blank" class="mt-2"> <img src="{{ asset('uploads/support_document/'.$work_child->wwcc_evidence) }}" width="50px;" height="50px" /> </a>
                                <?php } ?>
                            </div>
                            <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>
                            
                            <div class="add_new_certification_div mb-3">
                                    <a style="cursor: pointer;" class="remove-wwcc" wwcc_id="{{ $work_child->id }}">- Delete WWCC</a>
                            </div>
                            </div>
                            <?php $k++;  } } ?>
                        </div>
                        <div class="add_new_certification_div mb-3">
                                <a style="cursor: pointer;" id="add-wwcc">+ Add Another WWCC </a>
                        </div>

                        <div class="col-md-3 mt-3">
                            <div class="d-flex align-items-center justify-content-between">
                            <button onclick="do_children_check()"  class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                                <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                                <span class="sr-only">Loading...</span>
                                </div>
                            </button>
                            </div>
                        </div>
                        </div>
                    </form>
                    </div>
                    
                    <!-- [Police Clearance] -->
                    <div class="card shadow-sm border-0 p-4 mt-30">
                      <h3 class="mt-0 color-brand-1 mb-2">Police Clearance</h3>
                      <span>A National Police Clerance is a point-in-time check, meaning it is accurate only as of the issue date and does not track offenses committed afterward. Most employers or agencies typically consider it valid for 3 to 12 months from the issue date.</span>
                      <form id="multi-step-form-police-check" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          <input type="hidden" value="{{ $profileData->id ?? null }}" name="user_id">
                          <?php
                          
                          $issuance_date=$evidence_file='';
                          if($policy_check!='' || $policy_check!=null){
                              $issuance_date=$policy_check['issuance_date'];
                              $evidence_file=$policy_check['evidence_file'];
                          } ?>
                          <div class="form-group mt-3">
                              <label class="form-label">Date of issuance *</label>
                              <input class="form-control" type="date" name="issuance_date" id="issuance_date" value="{{$issuance_date}}" max="{{ date('Y-m-d') }}">
                              <span id="reqTxtdate_acquiredI" class="reqError text-danger valley"></span>     
                          </div>
                            
                          <div class="form-group mt-3">
                              <label class="form-label" for="input-1">Police Clearance</label>
                              <input type="file" name="clearance_document" id="clearance_document" class="form-control" accept="image/*">
                              <span id="reqTxtimage_support_documentI" class="reqError text-danger valley"></span>
                              <?php if($evidence_file!=''){ ?>
                              <a href="{{ asset('uploads/support_document/'.$evidence_file) }}" target="_blank" class="mt-2"> <img src="{{ asset('uploads/support_document/'.$evidence_file) }}" width="50px;" height="50px" /> </a>
                              <?php } ?>
                          </div>
                          <div class="col-lg-12 col-md-12  mt-3">
                              <label>
                                  <input class="mt-3" type="checkbox" id="policy_confirm" name="is_declare"> I declare that my Police Clearance and legal record remain unchanged since the date of issue.
                                  <br> <span id="reqTxtconfirmationCheckboxPoliceCheckI" class="reqError text-danger valley"></span>
                              </label>
                              

                              <div class="d-flex align-items-center justify-content-between mt-3">
                                  <button onclick="do_police_check()" class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                                      <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                                          <span class="sr-only">Loading...</span>
                                      </div>
                                  </button>                            
                              </div>
                          </div>
                        </div>
                      </form>
                    </div>
            
                    <!-- [Specialized Clearances] -->
                    <div class="card shadow-sm border-0 p-4 mt-30">
                    <h3 class="mt-0 color-brand-1 mb-2">Specialized Clearances</h3>
                    <div><strong>State or Territory-Specific Registrations: </strong> Highlight any additional clearances, such as restricted drug licenses.</div>
                    <form id="multi-step-form-specialized" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        @php
                        $state_data =state_name_array( 'AU');
                        @endphp
                        <input type="hidden" value="{{ $profileData->id ?? null }}" name="user_id">
                        <div id="specialized_more" >
                            <?php if($specialize!=''){
                            $s=1;
                            foreach($specialize as $svalue){ ?>
                            <div class="add_specialized" >
                            <h6>Specialized Clearances {{$s}}</h6>
                            <div class="col-md-12">
                                <div class="form-group mt-3">
                                  <input type="hidden" name="s_clearance_id[]" value="{{$svalue->id}}"/>
                                  <label>State *</label>
                                  <select class="form-control form-select clearance_state" name="clearance_state[]">
                                      <option value="">Select State</option>
                                      @if(isset($state_data) && !empty($state_data))
                                      @foreach ($state_data as $data_state)
                                      <option value="{{$data_state->id}}" {{$svalue->clearance_state==$data_state->id?'selected':''}} > {{$data_state->name}} </option>
                                      @endforeach
                                      @endif
                                  </select>
                                </div>
                                <span id="reqTxtclearancestateI" class="reqError text-danger valley"></span>
                            </div>

                            <div class="form-group mt-3 ">
                                <label class="font-sm color-text-mutted mb-10 state_label">Specialized Clearance type*</label>
                                <input class="form-control clearance_type" type="text" name="clearance_type[]"  placeholder="" value="{{$svalue->clearance_type}}">
                            </div>
                            <span id="reqTxtclearance_numberI" class="reqError text-danger valley"></span>

                            <div class="form-group  mt-3">
                                <label class="font-sm color-text-mutted mb-10 state_label">Specialized Clearance Number*</label>
                                <input class="form-control clearance_number" type="text" name="clearance_number[]" placeholder="" value="{{$svalue->clearance_number}}">
                            </div>
                            <span id="reqTxtclearance_numberI" class="reqError text-danger valley"></span>

                            <div class="form-group  mt-3">
                                <label class="font-sm color-text-mutted mb-10">Expiry Date*</label>
                                <input class="form-control clearance_expiry_date" type="date" name="clearance_expiry_date[]" value="{{$svalue->clearance_expiry_date}}" min="{{ date('Y-m-d') }}">
                            </div>
                            <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>

                            <div class="form-group  mt-3">
                                <label class="font-sm color-text-mutted mb-10">Upload Evidence*</label>
                                <input class="form-control {{$svalue->clearance_evidence==''?'clearance_evidence':''}}" type="file" name="clearance_evidence[]">
                                <?php if($svalue->clearance_evidence!=''){ ?>  
                                <a href="{{ asset('uploads/support_document/'.$svalue->clearance_evidence) }}" target="_blank" class="mt-2"> <img src="{{ asset('uploads/support_document/'.$svalue->clearance_evidence) }}" width="50px;" height="50px" /> </a>
                                <?php } ?>
                            </div>
                            <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>

                            <div class="add_new_certification_div mb-3">
                                    <a style="cursor: pointer;" class="remove-specialized" clearance_id="{{$svalue->id}}">- Delete specialized Clearance</a>
                            </div>
                            </div>
                            <?php $s++;  } } ?>
                        </div>
                        <div class="add_new_certification_div mb-3 ">
                                <a style="cursor: pointer;" id="add-specialized">+ Add Another Specialized Clearance </a>
                        </div>

                        <div class="col-md-3 mt-3">
                            <div class="d-flex align-items-center justify-content-between">
                            <button onclick="updateSpecializedClearance()"   class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                                <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                                <span class="sr-only">Loading...</span>
                                </div>
                            </button>
                            </div>
                        </div>
                        </div>
                    </form>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@section('js')




<script>
    $(document).ready(function() {
        // Get the current query string parameter
        let urlParams = new URLSearchParams(window.location.search);
        let tabParam = urlParams.get('tab');
        // If no tab query string is present, default to tab-1
        if (!tabParam) {
            // Set the first tab as the default
            let defaultTab = 'tab-1';
            // Update the URL to include ?tab=tab-1
            let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + defaultTab;
            history.replaceState(null, null, newUrl);
            // Show the default tab
            $('.nav-link[href="#' + defaultTab + '"]').tab('show');
        } else {
            // If a tab query parameter exists, activate that tab
            $('.nav-link[href="#' + tabParam + '"]').tab('show');
        }
        // Update the URL with the tab ID as a query parameter when a tab is shown
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            let newTab = $(e.target).attr('href').substring(1); // Get tab ID without the #
            let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + newTab;
            history.replaceState(null, null, newUrl);
        });
    });
</script>
<script type="text/javascript">
    
    $(document).ready(function() {
    changeResidency();

    $('#residency_text').on('change',function(){
      changeResidency();
    });

    $('#visa_holder_subcls').on('change',function(){
      if($('#visa_holder_subcls').val()=='40')
      {
        $('#other_visa_type').show();
      }
      else{
        $('#other_visa_type').hide();
      }
    });
  });
  
    
  function changeResidency()
  {
    
    $('#australian_citizen').hide();
    $('#permanent_resident').hide();
    $('#visa_holder').hide();

    var residencyId = $('#residency_text').val();
    if(residencyId=='Australian Citizen')
    {
      $('#australian_citizen').show();
    }
    if(residencyId=='Permanent Resident')
    {
      $('#permanent_resident').show();
    }
    if(residencyId=='Visa Holder')
    {
      $('#other_visa_type').hide();
      if($('#visa_holder_subcls').val()=='40')
      {
        $('#other_visa_type').show();
      }
      $('#visa_holder').show();
    }
  }

  $(document).ready(function() {
        function updateLabelAndPlaceholder(selectElement) {
            // Find the closest block (ensuring changes affect only the current section)
            var block = selectElement.closest('.add_wwcc');

            // Find related elements within the same block
            var label = block.find('.state_label');
            var input = block.find('.state_input');

            // Get selected option text
            var selectedval = selectElement.find('option:selected').val();

            if(selectedval=='195')
            {
              label.text(" Working With Vulnerable People (WWVP) Registration Card Number *"); 
              input.attr("placeholder", "Enter " +  "WWVP Registration Card Number"); 
            }
            else if(selectedval=='196')
            {
              label.text(" WWCC Clearance Number *"); 
              input.attr("placeholder", "Enter " +  "WWCC Clearance Number"); 
            }
            else if(selectedval=='197')
            {
              label.text(" Ochre Card Number *"); 
              input.attr("placeholder", "Enter " +  "Ochre Card Number"); 
            }
            else if(selectedval=='198')
            {
              label.text(" Blue Card Number *"); 
              input.attr("placeholder", "Enter " +  "Blue Card Number"); 
            }
            else if(selectedval=='199')
            {
              label.text(" WWCC Certificate Number *"); 
              input.attr("placeholder", "Enter " +  "WWCC Certificate Number"); 
            }
            else if(selectedval=='200')
            {
              label.text(" Registration to Work With Vulnerable People (RWVP) Card Number *"); 
              input.attr("placeholder", "Enter " +  "RWVP Card Number"); 
            }
            else if(selectedval=='201')
            {
              label.text(" WWCC Card Number *"); 
              input.attr("placeholder", "Enter " +  "WWCC Card Number"); 
            }
            else if(selectedval=='202')
            {
              label.text(" WWCC Card Number *"); 
              input.attr("placeholder", "Enter " +  "WWCC Card Number"); 
            }
            else {
                label.text("WWCC Card Number*"); 
                input.attr("placeholder", ""); 
            }
        }

        // Call function on page load
        $(".wwcc_state").each(function() {
            updateLabelAndPlaceholder($(this));
        });

        // Call function on dropdown change
        $(document).on("change", ".wwcc_state", function() {
            updateLabelAndPlaceholder($(this));
        });
        
        let i = <?php echo count($ww_child)+1 ?>;
        $('#add-wwcc').click(function(){
          $('#wwcc_more').append(`<div class="add_wwcc" >
                          <h6>WWCC ${i}</h6>
                          <div class="col-md-12 mt-3">
                            <div class="form-group position-relative">
                              
                              <label>State *</label>
                              <select class="form-control form-select wwcc_state" name="wwcc_state[]"  >
                                <option value="">Select State</option>
                                @if(isset($state_data) && !empty($state_data))
                                @foreach ($state_data as $data_state)
                                <option value="{{$data_state->id}}" > {{$data_state->name}} </option>
                                @endforeach
                                @endif
                              </select>
                            </div>
                            <span id="reqTxtclearancestateI" class="reqError text-danger valley"></span>
                          </div>

                          <div class="form-group mt-3">
                            <label class="font-sm color-text-mutted mb-10 state_label">Clearance Number*</label>
                            <input class="form-control wwcc_clearance" type="text" name="wwcc_clearance_number[]" placeholder="" value="">
                          </div>
                          <span id="reqTxtclearance_numberI" class="reqError text-danger valley"></span>

                          <div class="form-group mt-3">
                            <label class="font-sm color-text-mutted mb-10">Expiry Date*</label>
                            <input class="form-control clearance_expiry" type="date" name="wwcc_expiry_date[]" value="" min="{{ date('Y-m-d') }}">
                          </div>
                          <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>

                          <div class="form-group mt-3">
                            <label class="font-sm color-text-mutted mb-10">Upload Evidence*</label>
                            <input class="form-control wwcc_evidence" type="file" name="wwcc_evidence[]" >
                          </div>
                          <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>
                          <div class="add_new_certification_div mb-3">
                                <a style="cursor: pointer;" class="remove-wwcc">- Delete WWCC</a>
                              </div>
                        </div>` );
                  i++;
        });

        

        $(document).on('click', '.remove-wwcc', function () {
          const otherId= $(this).attr('wwcc_id');
          if (otherId)
          {

            $.ajax({
              url: "{{ url('/admin') }}/removeWwcc",
                type: 'POST',
                data: {
                  _token: "{{ csrf_token() }}",
                    id: otherId
                },
                success: function (response)
                {
                    if (response.success) {
                        // On successful deletion from the database, remove the HTML
                        alert('WWCC record removed successfully!');
                    } else {
                        alert('Failed to remove wwcc record. Please try again.');
                    }
                }.bind(this), // Bind `this` to refer to the button element
                error: function () {
                    alert('An error occurred. Please try again.');
                }
            });
          }

          $(this).closest('.add_wwcc').remove();

          $('#wwcc_more .add_wwcc').each(function (index) {
              $(this).find('h6').text(`WWCC ${index + 1}`);
          });

          // Adjust the counter to reflect the number of vaccine sections + 1
          i = $('#wwcc_more .add_wwcc').length + 1;
        });


        //speacilized clearence add more section 
        
        let l = <?php echo count($specialize)+1 ?>;
        
        $('#add-specialized').click(function(){
          $('#specialized_more').append(
            `<div class="add_specialized" >
                          <h6>Specialized Clearances ${l}</h6>
                          <div class="col-md-12">
                            <div class="form-group mt-3">
                              
                              <label>State *</label>
                              <select class="form-control form-select clearance_state" name="clearance_state[]">
                                <option value="">Select State</option>
                                @if(isset($state_data) && !empty($state_data))
                                @foreach ($state_data as $data_state)
                                <option value="{{$data_state->id}}" > {{$data_state->name}} </option>
                                @endforeach
                                @endif
                              </select>
                            </div>
                            <span id="reqTxtclearancestateI" class="reqError text-danger valley"></span>
                          </div>

                          <div class="form-group mt-3">
                            <label class="font-sm color-text-mutted mb-10 state_label">Specialized Clearance type*</label>
                            <input class="form-control clearance_type" type="text" name="clearance_type[]"  placeholder="" value="">
                          </div>
                          <span id="reqTxtclearance_numberI" class="reqError text-danger valley"></span>

                          <div class="form-group mt-3">
                            <label class="font-sm color-text-mutted mb-10 state_label">Specialized Clearance Number*</label>
                            <input class="form-control clearance_number" type="text" name="clearance_number[]" placeholder="" value="">
                          </div>
                          <span id="reqTxtclearance_numberI" class="reqError text-danger valley"></span>

                          <div class="form-group mt-3">
                            <label class="font-sm color-text-mutted mb-10">Expiry Date*</label>
                            <input class="form-control clearance_expiry_date" type="date" name="clearance_expiry_date[]" value="" min="{{ date('Y-m-d') }}">
                          </div>
                          <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>

                          <div class="form-group mt-3">
                            <label class="font-sm color-text-mutted mb-10">Upload Evidence*</label>
                            <input class="form-control clearance_evidence" type="file" name="clearance_evidence[]">
                          </div>
                          <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>

                          <div class="add_new_certification_div mb-3">
                                <a style="cursor: pointer;" class="remove-specialized">- Delete specialized Clearance</a>
                          </div>
                        </div>`);
                        l++;
        });

        $(document).on('click', '.remove-specialized', function () {
          const clearance_id=$(this).attr('clearance_id');
          if (clearance_id)
          {

            $.ajax({
              url: "{{ url('/admin') }}/removeSpecialized",
                type: 'POST',
                data: {
                  _token: "{{ csrf_token() }}",
                    id: clearance_id
                },
                success: function (response)
                {
                    if (response.success) {
                        // On successful deletion from the database, remove the HTML
                        alert('Clearance record removed successfully!');
                    } else {
                        alert('Failed to remove Clearance record. Please try again.');
                    }
                }.bind(this), // Bind `this` to refer to the button element
                error: function () {
                    alert('An error occurred. Please try again.');
                }
            });
          }

          $(this).closest('.add_specialized').remove();

          $('#specialized_more .add_specialized').each(function (index) {
              $(this).find('h6').text(`Specialized Clearances ${index + 1}`);
          });

          // Adjust the counter to reflect the number of vaccine sections + 1
          l = $('#specialized_more .add_specialized').length + 1;
          
        });

    });

    let currentUrl = window.location.href;
    let match = currentUrl.match(/updateWorkClreance\/(\d+)/);
    if (match && match[1]) 
    {
      let workClearanceId = match[1];
      var targetTab = 'tab-9';
      var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + targetTab;
    }
    else
    {
      let workClearanceId = '';

      let fullPath = window.location.pathname;
      let pathParts = fullPath.split("/").filter(part => part !== "");
      //let uriSegment = pathParts[0] + "/" + pathParts[1];
      let uriSegment = pathParts[0];
      var targetTab = 'navpill-9';
      var newUrl = window.location.protocol + "//" + window.location.host +'/'+uriSegment+  '/professionalMembership?tab=' + targetTab;
    }
  
  function doeligibility_to_work() {
        event.preventDefault();
        let isValid = true;

        if ($('#residency_text').val().trim() === '') {
            isValid = false;
            $('#residency_text').next('.reqError').text('Please select residency');
        } else {
            $('#residency_text').next('.reqError').text('');
        }

        
        ////Australian Citizen
        if($('#residency_text').val()=='Australian Citizen')
        {

        if ($('#aus_evidence_type').val().trim() === '') {
            isValid = false;
            $('#aus_evidence_type').next('.reqError').text('Please select evidence type');
        } else {
            $('#aus_evidence_type').next('.reqError').text('');
        }
        if($('#upload_evidence0')[0]){
            if ($('#upload_evidence0')[0].files.length === 0) {
            alert('govinda');
                isValid = false;
                $('#upload_evidence0').next('.reqError').text('Please upload an evidence file');
            } else {
                $('#upload_evidence0').next('.reqError').text('');
            }
        }
        
        }
        
        
        ///Permanent Resident
        if($('#residency_text').val()=='Permanent Resident')
        {
        
        if ($('#perm_passport_number').val().trim() === '') {
            isValid = false;
            $('#perm_passport_number').next('.reqError').text('Please enter passport number');
        } else {
            $('#perm_passport_number').next('.reqError').text('');
        }
        
        if ($('#perm_country_id').val().trim() === '') {
            isValid = false;
            $('#perm_country_id').next('.reqError').text('Please select country');
        } else {
            $('#perm_country_id').next('.reqError').text('');
        }
        
        if ($('#perm_visa_subclass').val().trim() === '') {
            isValid = false;
            $('#perm_visa_subclass').next('.reqError').text('Please select visa subclass');
        } else {
            $('#perm_visa_subclass').next('.reqError').text('');
        }
        
        if ($('#perm_visa_grant_number').val().trim() === '') {
            isValid = false;
            $('#perm_visa_grant_number').next('.reqError').text('Please enter visa grant number');
        } else {
            $('#perm_visa_grant_number').next('.reqError').text('');
        }
        
        if ($('#perm_evidence_type').val().trim() === '') {
            isValid = false;
            $('#perm_evidence_type').next('.reqError').text('Please select evidence type');
        } else {
            $('#perm_evidence_type').next('.reqError').text('');
        }

        if($('#upload_evidence1')[0]){
            if ($('#upload_evidence1')[0].files.length === 0) {
            isValid = false;
            $('#upload_evidence1').next('.reqError').text('Please upload an evidence file');
            } else {
                $('#upload_evidence1').next('.reqError').text('');
            }
        }
        
        }

        /////Visa Holder
        if($('#residency_text').val()=='Visa Holder')
        {
        if ($('#hold_passport_number').val().trim() === '') {
            isValid = false;
            $('#hold_passport_number').next('.reqError').text('Please enter passport number');
        } else {
            $('#hold_passport_number').next('.reqError').text('');
        }
        
        if ($('#hold_country_id').val().trim() === '') {
            isValid = false;
            $('#hold_country_id').next('.reqError').text('Please select country');
        } else {
            $('#hold_country_id').next('.reqError').text('');
        }
        
        if ($('#visa_holder_subcls').val().trim() === '') {
            isValid = false;
            $('#visa_holder_subcls').next('.reqError').text('Please select visa subclass');
        } else {
            $('#visa_holder_subcls').next('.reqError').text('');
        }

        if($('#visa_holder_subcls').val()=='40'){
            //if select other visa sub class
            if ($('#hold_visa_type').val().trim() === '') {
            isValid = false;
            $('#hold_visa_type').next('.reqError').text('Please enter visa type');
            } else {
            $('#hold_visa_type').next('.reqError').text('');
            }
        }
        
        if ($('#hold_visa_grant_number').val().trim() === '') {
            isValid = false;
            $('#hold_visa_grant_number').next('.reqError').text('Please enter visa grant number');
        } else {
            $('#hold_visa_grant_number').next('.reqError').text('');
        }
        
        if ($('#hold_evidence_type').val().trim() === '') {
            isValid = false;
            $('#hold_evidence_type').next('.reqError').text('Please select evidence type');
        } else {
            $('#hold_evidence_type').next('.reqError').text('');
        }
        if($('#upload_evidence2')[0]){
            if ($('#upload_evidence2')[0].files.length === 0) {
            
                isValid = false;
                $('#upload_evidence2').next('.reqError').text('Please upload an evidence file');
            } else {
                $('#upload_evidence2').next('.reqError').text('');
            }
        }   
        }
    
    
        if (isValid == true) {
        let formData = new FormData($('#multi-step-form-eligibility')[0]);
        $.ajax({
            type: 'POST',
            url: "{{route('admin.update-profession-user-eligibility')}}",
            data: formData,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            cache: false,
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            beforeSend: function() {
            $('.submit-btn-120').prop('disabled', true);
            $('.submit-btn-1').show();
            $('.resetpassword').hide();
            },

            success: function(resp) {
            if (resp.status == 1) {
                $('.submit-btn-120').prop('disabled', false);
                $('.submit-btn-1').hide();
                $('.resetpassword').show();
                $('#multi-step-form-eligibility')[0].reset();
                Swal.fire({
                icon: 'success',
                title: 'Successfully!',
                text: resp.message,
                }).then(function() {
                  window.location.href = newUrl;
                });
            } else {
                $('.submit-btn-120').prop('disabled', false);
                $('.submit-btn-1').hide();
                $('.resetpassword').show();
                Swal.fire({
                'icon': 'error',
                'title': 'Error',
                'text': resp.message
                });
                printErrorMsg(resp.validation);
            }
            }
        });
        return false;
        }
  }

  function ndisupdates()
  {
    event.preventDefault();
    
    isValid = true;
  
    if ($('#ndis_state').val().trim() === '') {
      isValid = false;
      $('#ndis_state').next('.reqError').text('Please select state');
    } else {
      $('#ndis_state').next('.reqError').text('');
    }

    if ($('#ndis_worker_clearance_number').val().trim() === '') {
      isValid = false;
      $('#ndis_worker_clearance_number').next('.reqError').text('Please enter worker clearance number');
    } else {
      $('#ndis_worker_clearance_number').next('.reqError').text('');
    }

    if ($('#ndis_expiry_date').val().trim() === '') {
      isValid = false;
      $('#ndis_expiry_date').next('.reqError').text('Please enter exipry date');
    } else {
      $('#ndis_expiry_date').next('.reqError').text('');
    }
    if($('#ndis_evidence')[0]){
      if ($('#ndis_evidence')[0].files.length === 0) {
        isValid = false;
        $('#ndis_evidence').next('.reqError').text('Please upload evidance file ');
      } else {
        $('#ndis_evidence').next('.reqError').text('');
      }
    }

    if (isValid == true) {
      let formData = new FormData($('#multi-step-form-ndis')[0]);
      $.ajax({
        type: 'POST',
        url: "{{route('admin.update-ndis')}}",
        data: formData,
        dataType: 'JSON',
        processData: false,
        contentType: false,
        cache: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        beforeSend: function() {
          $('.submit-btn-120').prop('disabled', true);
          $('.submit-btn-1').show();
          $('.resetpassword').hide();
        },

        success: function(resp) {
          if (resp.status == 1) {
            $('.submit-btn-120').prop('disabled', false);
            $('.submit-btn-1').hide();
            $('.resetpassword').show();
            $('#multi-step-form-ndis')[0].reset();
            Swal.fire({
              icon: 'success',
              title: 'Successfully!',
              text: resp.message,
            }).then(function() {
              window.location.href = newUrl;
            });
          } else {
            $('.submit-btn-120').prop('disabled', false);
            $('.submit-btn-1').hide();
            $('.resetpassword').show();
            Swal.fire({
              'icon': 'error',
              'title': 'Error',
              'text': resp.message
            });
            printErrorMsg(resp.validation);
          }
        }
      });
      return false;
    }

  }
  
  function do_children_check() {
    let isValid = true;
    event.preventDefault();
    $('.wwcc_state').each(function () {
      let errorSpan = $(this).closest('.form-group').next('.reqError');
        if ($(this).val() === null || $(this).val().trim() === '') {
            isValid = false;
            errorSpan.text('Please select State');
        } else {
          errorSpan.text('');
        }
    });

    $('.wwcc_clearance').each(function () {
      let errorSpan = $(this).closest('.form-group').next('.reqError');
        if ($(this).val().trim() === '') {
            isValid = false;
            errorSpan.text('Clearance number is required');
        } else {
          errorSpan.text('');
        }
    });

    $('.clearance_expiry').each(function () {
      let errorSpan = $(this).closest('.form-group').next('.reqError');
        if ($(this).val().trim() === '') {
            isValid = false;
            errorSpan.text('Expiry Date is required');
        } else {
          errorSpan.text('');
        }
    });

    $('.wwcc_evidence').each(function () {
      let errorSpan = $(this).closest('.form-group').next('.reqError');
        if ($(this).val().trim() === '') {
            isValid = false;
            errorSpan.text('Please upload an evidence file');
        } else {
          errorSpan.text('');
        }
    });

    if (isValid == true) {
      $(".valley").html("");
      $('.submit-btn-120').prop('disabled', true);
      $('.submit-btn-1').show();
      $('.resetpassword').hide();

      let formData = new FormData($('#multi-step-form-children')[0]);
      $.ajax({
        type: 'POST',
        url: "{{route('admin.update-profession-user-children')}}",
        data: formData,
        dataType: 'JSON',
        processData: false,
        contentType: false,
        cache: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        beforeSend: function() {
          $('.submit-btn-120').prop('disabled', true);
          $('.submit-btn-1').show();
          $('.resetpassword').hide();
        },

        success: function(resp) {
          if (resp.status == 1) {
            $('.submit-btn-120').prop('disabled', false);
            $('.submit-btn-1').hide();
            $('.resetpassword').show();
            Swal.fire({
              icon: 'success',
              title: 'Successfully!',
              text: resp.message,
            }).then(function() {
              window.location.href = newUrl;
            });
          } else {
            $('.submit-btn-120').prop('disabled', false);
            $('.submit-btn-1').hide();
            $('.resetpassword').show();
            Swal.fire({
              'icon': 'error',
              'title': 'Error',
              'text': resp.message
            });
            printErrorMsg(resp.validation);
          }
        }
      });
      return false;
    }
  }

  function do_police_check() {
    event.preventDefault();
    isValid = true;
    if ($('#issuance_date').val().trim() === '') {
      isValid = false;
      $('#issuance_date').next('.reqError').text('Issuance date is required');
    } else {
      $('#issuance_date').next('.reqError').text('');
    }

    if($('#clearance_document')[0]){
      if ($('#clearance_document')[0].files.length === 0) {
        isValid = false;
        $('#clearance_document').next('.reqError').text('Policy Clearance document is required ');
      } else {
        $('#clearance_document').next('.reqError').text('');
      }
    }

    if (!$('#policy_confirm').is(':checked')) {
      isValid = false;
      $('#reqTxtconfirmationCheckboxPoliceCheckI').text('You must confirm before proceeding');
    } else {
        $('#reqTxtconfirmationCheckboxPoliceCheckI').text('');
    }
    
    if (isValid == false) {
      $('.submit-btn-120').prop('disabled', false);
      $('.submit-btn-1').hide();
      $('.resetpassword').show();
    }

    if (isValid == true) {
      let formData = new FormData($('#multi-step-form-police-check')[0]);
      $.ajax({
        type: 'POST',
        url: "{{route('admin.update-profession-user-police-check')}}",
        data: formData,
        dataType: 'JSON',
        processData: false,
        contentType: false,
        cache: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        beforeSend: function() {
          $('.submit-btn-120').prop('disabled', true);
          $('.submit-btn-1').show();
          $('.resetpassword').hide();
        },
        success: function(resp) {
          if (resp.status == 1) {
            $('.submit-btn-120').prop('disabled', false);
            $('.submit-btn-1').hide();
            $('.resetpassword').show();
            Swal.fire({
              icon: 'success',
              title: 'Successfully!',
              text: resp.message,
            }).then(function() {
              window.location.href = newUrl;
            });
          } else {
            $('.submit-btn-120').prop('disabled', false);
            $('.submit-btn-1').hide();
            $('.resetpassword').show();
            Swal.fire({
              'icon': 'error',
              'title': 'Error',
              'text': resp.message
            });
            printErrorMsg(resp.validation);
          }
        }
      });
      return false;
    }
  }

  function updateSpecializedClearance()
  {
    let isValid = true;
    event.preventDefault();
    $('.clearance_state').each(function () {
      let errorSpan = $(this).closest('.form-group').next('.reqError');
        if ($(this).val() === null || $(this).val().trim() === '') {
            isValid = false;
            errorSpan.text('Please select State');
        } else {
          errorSpan.text('');
        }
    });

    $('.clearance_type').each(function () {
      let errorSpan = $(this).closest('.form-group').next('.reqError');
        if ($(this).val().trim() === '') {
            isValid = false;
            errorSpan.text('Specialized Clearance type is required');
        } else {
          errorSpan.text('');
        }
    });

    $('.clearance_number').each(function () {
      let errorSpan = $(this).closest('.form-group').next('.reqError');
        if ($(this).val().trim() === '') {
            isValid = false;
            errorSpan.text('Specialized Clearance number is required');
        } else {
          errorSpan.text('');
        }
    });

    $('.clearance_expiry_date').each(function () {
      let errorSpan = $(this).closest('.form-group').next('.reqError');
        if ($(this).val().trim() === '') {
            isValid = false;
            errorSpan.text('Specialized Clearance expiry date is required');
        } else {
          errorSpan.text('');
        }
    });
    
    
    $('.clearance_evidence').each(function () {
      let errorSpan = $(this).closest('.form-group').next('.reqError');
        if ($(this).val().trim() === '') {
            isValid = false;
            errorSpan.text('Please upload an evidence file');
        } else {
          errorSpan.text('');
        }
    });

    if (isValid == false) {
      $('.submit-btn-120').prop('disabled', false);
      $('.submit-btn-1').hide();
      $('.resetpassword').show();
    }

    if (isValid == true) {
      let formData = new FormData($('#multi-step-form-specialized')[0]);
      $.ajax({
        type: 'POST',
        url: "{{route('admin.updateSpecializedClearance')}}",
        data: formData,
        dataType: 'JSON',
        processData: false,
        contentType: false,
        cache: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        beforeSend: function() {
          $('.submit-btn-120').prop('disabled', true);
          $('.submit-btn-1').show();
          $('.resetpassword').hide();
        },
        success: function(resp) {
          if (resp.status == 1) {
            $('.submit-btn-120').prop('disabled', false);
            $('.submit-btn-1').hide();
            $('.resetpassword').show();
            Swal.fire({
              icon: 'success',
              title: 'Successfully!',
              text: resp.message,
            }).then(function() {
              window.location.href = newUrl;
            });
          } else {
            $('.submit-btn-120').prop('disabled', false);
            $('.submit-btn-1').hide();
            $('.resetpassword').show();
            Swal.fire({
              'icon': 'error',
              'title': 'Error',
              'text': resp.message
            });
            printErrorMsg(resp.validation);
          }
        }
      });
      return false;
    }
  }
</script>

@include('admin.edit_script');

@endsection