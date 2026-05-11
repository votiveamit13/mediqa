@extends('nurse.layouts.layout')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ url('/public') }}/nurse/assets/css/jquery.ui.datepicker.monthyearpicker.css">
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

<style type="text/css">
  .hide_profile_image {
    display: none !important;
  }

  span.select2.select2-container {
    padding: 5px !important;
    width: 100% !important;
  }

  .select2-container--default .select2-selection--multiple {
    background-color: white !important;
    border: 1px solid #0000 !important;
    border-radius: 4px !important;
    cursor: text !important;
  }

  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #000 !important;
    border: 1px solid #000 !important;
    border-radius: 4px !important;
    cursor: default !important;
    color: #fff !important;
    float: left;
    padding: 0;
    padding-right: 0.75rem;
    margin-top: calc(0.375rem - 2px);
    margin-right: 0.375rem;
    padding-bottom: 2px;
    white-space: normal;
    line-height: 20px;
  }

  .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff !important;
    font-size: 20px !important;
    float: left;
    padding-right: 3px;
    padding-left: 3px;
    margin-right: 1px;
    margin-left: 3px;
    font-weight: 700;
    line-height: 20px;
  }

  .registration_progress {
    font-weight: 900;
    background-color: black;
    color: #fff;
  }

  .file-item {
    display: flex;
    align-items: unset;
    margin-bottom: 10px;
}

.file-item a {
    text-decoration: none;
    color: #333;
    margin-right: 10px;
    display: flex;
    align-items: center;
}

.file-item .fa-file {
    margin-right: 5px;
}

.file-item .close_btn.close_btn-0 {
    margin-left: 0;
}

i.fa.fa-file {
    position: relative;
    left: 0px;
    font-size: 14px;
    line-height: 25px;
    margin-right: 5px;
    color: #000000;
}
.close_btn i {
    display: block;
    position: relative;
    left: 0px;
    font-size: 14px;
    line-height: 25px;
    margin-right: 5px;
    color: #000000;
    top: 14px;
}

</style>
@endsection

@section('content')
<main class="main">
  <section class="section-box mt-0">
    <div class="">
      <div class="row m-0 profile-wrapper">
        <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">
          @include('nurse.sidebar_profile')
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 col-12 right_content">
          <div class="content-single content_profile">
            @if(!email_verified())
              <div class="container-fluid">
                <div class="alert alert-warning mt-2" role="alert">
                  <span class="d-flex align-items-center justify-content-center "><img src="{{ asset('nurse/assets/imgs/info.png') }}" width="25px;" alt="info" class="mx-2"> Thank you for signing up with us. To get full access, please verify your email first. If you didn't receive the email, <a href="javascript:void(0);" class="link-opacity-100 mx-1" style="color: black;text-decoration-line: underline;
                    text-decoration-style: straight;" onclick="return resendEmailLink()"><b> click here to resend it.</b></a></span>
                </div>
              </div>
            @endif
            @if(!account_verified())
              <div class="container-fluid">
                <div class="alert alert-warning mt-2" role="alert">
                  <span class="d-flex align-items-center justify-content-center "><img src="{{ asset('nurse/assets/imgs/info.png') }}" width="25px;" alt="info" class="mx-2">Thank you for verifying your email!<br>Please complete your profile, and once approved, you will be able to apply for jobs and make your profile visible.
                  </span>
                </div>
              </div>
            @endif
            @if(!completeProfile())
            <div class="container-fluid">
              <div class="alert alert-warning mt-2" role="alert">
                <span class="d-flex align-items-center justify-content-center "><img src="{{ asset('nurse/assets/imgs/info.png') }}" width="25px;" alt="info" class="mx-2">Thank you for completing your profile.<br>We are currently reviewing your details and will get in touch with you shortly.
                </span>
              </div>
            </div>
            @endif
            @if(!approvedProfile())
            <div class="container-fluid">
              <div class="alert alert-warning mt-2" role="alert">
                <span class="d-flex align-items-center justify-content-center "><img src="{{ asset('nurse/assets/imgs/info.png') }}" width="25px;" alt="info" class="mx-2">Congratulations! Your profile has been successfully approved.<br>You can now apply for jobs, connect with employers, and receive interview requests.
                </span>
              </div>
            </div>
            @endif
            {{-- @if(!email_verified())
              <div class="alert alert-success mt-2" role="alert">
                <span class="d-flex align-items-center justify-content-center ">Please verify your email first to access your account </span>
              </div>
            @endif --}}

            
              <?php
                $i=0;
                $user_id = Auth::guard('nurse_middle')->user()->id;
                
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
              
                <div class="card shadow-sm border-0 p-4 mt-30">
                  <h3 class="mt-2 color-brand-1 mb-2">Residency and Work Eligibility</h3>
                  
                  <form id="multi-step-form-eligibility" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group mt-3">
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
                      <div class="form-group ">
                        <label class="font-sm color-text-mutted mb-10">Type of Evidence *</label>
                        <select class="form-control" name="evidence_type" id="aus_evidence_type" >
                          <option value="">Select Evidence</option>
                          <option value="Australian Passport" {{($work_eligibility)?($work_eligibility['evidence_type']=='Australian Passport'?'selected':''):''}}>Australian Passport (Photo identification page)</option>
                          <option value="Australian Citizenship Certificate" {{($work_eligibility)?($work_eligibility['evidence_type']=='Australian Citizenship Certificate'?'selected':''):''}}>Australian Citizenship Certificate</option>
                          <option value="Full Australian Birth Certificate" {{($work_eligibility)?($work_eligibility['evidence_type']=='Full Australian Birth Certificate'?'selected':''):''}}>Full Australian Birth Certificate</option>
                        </select>

                        <span id="reqTxtvisa_subclass_numberId" class="reqError text-danger valley"></span>
                      </div>

                      <div class="form-group">
                        <label class="form-label" for="input-1">Upload Evidence</label>
                        <input type="file" name="upload_evidence0[]" id="{{$support_document0==''?'upload_evidence0':''}}" class="form-control h-100 fileInput" multiple>
                        <span id="reqasupport_document" class="reqError text-danger valley"></span>
                        <div id="fileList" class="file-list file-list-0">
                          <?php if(count($work_evidence)>0){
                            $wevdata = DB::table("eligibility_to_work")->where("id",$work_evidence[0]->type_id)->first();
                            ?>  
                            @if($wevdata->residency == "Australian Citizen")
                            @foreach ($work_evidence as $work_imgs)
                              <div class="file-item file-item-{{ $work_imgs->id }}">
                                <a href="{{ asset('uploads/support_document/' . $work_imgs->evidence_file) }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i> {{ $work_imgs->original_name }}</a>
                                <div class="close_btn close_btn-0 del_eve del_eve-{{ $work_imgs->id }}" eve_id="{{ $work_imgs->id }}" style="cursor: pointer;"">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </div>
                            </div>
                            @endforeach
                            @endif
                          <?php } ?>
                        </div>
                        
                      </div>
                    </div>

                    <div id="permanent_resident">
                      <div class="form-group ">
                          <label class="font-sm color-text-mutted mb-10">Passport Number *</label>
                          <input class="form-control" type="text" name="passport_number" id="perm_passport_number" placeholder="Passport Number" value="{{ $passport_number}}">

                          <span id="reqTxtvisa_grant_number" class="reqError text-danger valley"></span>
                      </div>
                      

                      <div class="form-group">
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
                      

                      <div class="form-group">
                        <label class="font-sm color-text-mutted mb-10">Visa Subclass *</label>
                        <select name="visa_subclass" class="form-control js-example-basic-multiple" id="perm_visa_subclass">
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
                      

                      <div class="form-group ">
                          <label class="font-sm color-text-mutted mb-10">Visa Grant Number *</label>
                          <input class="form-control" type="text" name="visa_grant_number" id="perm_visa_grant_number" placeholder="Visa Grant Number" value="{{ $visa_grant_number }}">
                          <span id="reqTxtvisa_grant_number" class="reqError text-danger valley"></span>
                      </div>
                      

                      <div class="form-group ">
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
                      
                      <div class="form-group">
                        <label class="form-label" for="input-1">Upload Evidence</label>
                        <input type="file" name="upload_evidence1[]" id="{{$support_document1==''?'upload_evidence1':''}}" class="form-control h-100 fileInput" multiple>
                        <span id="reqasupport_document" class="reqError text-danger valley"></span>
                        <div id="fileList" class="file-list file-list-1">
                          <?php if(count($work_evidence)>0){
                            $wevdata = DB::table("eligibility_to_work")->where("id",$work_evidence[0]->type_id)->first();
                            ?>  
                            @if($wevdata->residency == "Permanent Resident")
                            @foreach ($work_evidence as $work_imgs)
                            <div class="file-item">
                                <a href="{{ asset('uploads/support_document/' . $work_imgs->evidence_file) }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i> {{ $work_imgs->original_name }}</a>
                                <div class="close_btn close_btn-0 del_eve del_eve-{{ $work_imgs->id }}" eve_id="{{ $work_imgs->id }}" style="cursor: pointer;">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </div>
                            </div>
                            @endforeach
                            @endif
                          <?php } ?>
                        </div>
                        
                      </div>
                    </div>
                    
                    <div id="visa_holder" >
                      <div class="form-group ">
                        
                        <label class="font-sm color-text-mutted mb-10">Passport Number *</label>
                        <input class="form-control" type="text" name="passport_number1" id="hold_passport_number" value="{{ $passport_number1}}" >
                        <span id="reqTxtpassport_number" class="reqError text-danger valley"></span>
                      </div>
                      

                      <div class="form-group">
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
                      

                      <div class="form-group ">
                        <label class="font-sm color-text-mutted mb-10">Visa Subclass *</label>
                        <select class="form-control js-example-basic-multiple" name="visa_subclass1" id="visa_holder_subcls" >
                          <option value="">Select Visa Subclass</option>
                            @foreach($visaholderSubclasses as $visa_sub)
                              <option value="{{ $visa_sub->id }}" {{$visa_subclass==$visa_sub->id?'selected':''}}>{{ $visa_sub->sublcass_text }}</option>
                            @endforeach
                        </select>
                        <span id="reqTxtvisa_subclass_numberId" class="reqError text-danger valley"></span>
                      </div>
                      
                      
                      <div class="form-group" id="other_visa_type">
                        <label class="font-sm color-text-mutted mb-10">Please specify your Visa type </label>
                        <input class="form-control" type="text" name="other_visa_type" id="hold_visa_type" placeholder="" value="{{($work_eligibility)?$work_eligibility['other_visa_type']:''}}">
                        <span id="reqTxtvisa_subclass_numberId" class="reqError text-danger valley"></span>
                      </div>

                      <div class="form-group ">
                        <label class="font-sm color-text-mutted mb-10">Visa Grant Number </label>
                        <input class="form-control" type="text" name="visa_grant_number1" id="hold_visa_grant_number" placeholder="" value="{{ $visa_grant_number1}}">
                        <span id="reqTxtvisa_subclass_numberId" class="reqError text-danger valley"></span>
                      </div>

                      <div class="form-group ">
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
                      
                      <div class="form-group">
                        <label class="form-label" for="input-1">Upload Evidence</label>
                        <input type="file" name="upload_evidence2[]" id="{{$support_document2==''?'upload_evidence2':''}}" class="form-control h-100 fileInput" multiple>
                        <span id="reqasupport_document" class="reqError text-danger valley"></span>
                        <div id="fileList" class="file-list file-list-2">
                          <?php if(count($work_evidence)>0){
                            $wevdata = DB::table("eligibility_to_work")->where("id",$work_evidence[0]->type_id)->first();
                            ?>  
                            @if($wevdata->residency == "Visa Holder")
                            @foreach ($work_evidence as $work_imgs)
                            <div class="file-item">
                                <a href="{{ asset('uploads/support_document/' . $work_imgs->evidence_file) }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>{{ $work_imgs->original_name }}</a>
                                <div class="close_btn close_btn-0 del_eve del_eve-{{ $work_imgs->id }}" eve_id="{{ $work_imgs->id }}" style="cursor: pointer;">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </div>
                            </div>
                            
                            @endforeach
                            @endif
                          <?php } ?>
                        </div>
                        
                      </div>

                    </div>
                    
                      <div class="d-flex align-items-center justify-content-between">
                        <button onclick="doeligibility_to_work()" @if(!email_verified()) disabled @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
                          <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                            <span class="sr-only">Loading...</span>
                          </div>
                        </button>
                      </div>
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
                        <div class="form-group position-relative">
                          <label>State *</label>
                          <select class="form-control form-select" name="ndis_state" id="ndis_state">
                            <option value="">Select State</option>
                            @php
                            if(isset( Auth::guard('nurse_middle')->user()->country)){
                            $state_data =state_name_array( Auth::guard('nurse_middle')->user()->country);
                            }else{
                            $state_data = '';
                            }
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
                        
                      
                      <div class="form-group ">
                        <label class="font-sm color-text-mutted mb-10">NDIS Worker Clearance Number *</label>
                        <input class="form-control" type="text" name="ndis_worker_clearance_number" id="ndis_worker_clearance_number" value="{{ $ndis!=''? $ndis['clearance_number']:'' }}">
                        <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>
                      </div>
                      

                      <div class="form-group ">
                        <label class="font-sm color-text-mutted mb-10">Expiry Date*</label>
                        <input class="form-control" type="date" name="ndis_expiry_date" id="ndis_expiry_date" value="{{ $ndis!=''? $ndis['expiry_date']:'' }}" min="{{ date('Y-m-d') }}">
                        <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>
                      </div>
                      

                      <div class="form-group ">
                        <label class="font-sm color-text-mutted mb-10">Upload Evidence*</label>
                        <input class="form-control fileInput" type="file" name="ndis_evidence[]" id="{{ $ndis!=''?($ndis['evidence_file']!=''?'':'ndis_evidence'):'ndis_evidence'}}" multiple>
                        <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>
                        <div id="fileList" class="file-list file-list-ndis">
                          <?php if($ndis!=''){ if(!empty($work_evidence_ndis)){ ?>  
                            @foreach ($work_evidence_ndis as $work_imgs)
                            <div class="file-item">
                                <a href="{{ asset('uploads/support_document/' . $work_imgs->evidence_file) }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i> {{ $work_imgs->original_name }}</a>
                                <div class="close_btn close_btn-0 del_ndis_eve" eve_id="{{ $work_imgs->id }}" style="cursor: pointer;">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </div>
                            </div>
                            @endforeach
                          <?php } } ?>
                        </div>
                        
                      </div>
                      

                      <div class="col-md-3">
                        <div class="d-flex align-items-center justify-content-between">
                          <button onclick="ndisupdates()"  @if(!email_verified()) disabled @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
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
                      <?php
                        $ww_child_count = count($ww_child);
                      ?>
                      <div id="wwcc_more" >
                        <?php if($ww_child!=''){
                          $k=1;
                          foreach($ww_child as $work_child){ ?>

                        <div class="add_wwcc" >
                          <h6>WWCC {{$k}}</h6>
                          <div class="col-md-12">
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

                          <div class="form-group ">
                            <label class="font-sm color-text-mutted mb-10 state_label">Clearance Number*</label>
                            <input class="form-control wwcc_clearance" type="text" name="wwcc_clearance_number[]" placeholder="" value="{{ $work_child->clearance_number}}">
                          </div>
                          <span id="reqTxtclearance_numberI" class="reqError text-danger valley"></span>

                          <div class="form-group ">
                            
                            <label class="font-sm color-text-mutted mb-10">Expiry Date*</label>
                            <input class="form-control clearance_expiry" type="date" name="wwcc_expiry_date[]" value="{{ $work_child->expiry_date }}" min="{{ date('Y-m-d') }}">
                          </div>
                          <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>

                          <div class="form-group ">
                            <label class="font-sm color-text-mutted mb-10">Upload Evidence*</label>
                            <input class="form-control fileInput {{ $work_child->wwcc_evidence==''?'wwcc_evidence':'' }}" type="file" name="wwcc_evidence[{{ $k-1 }}][]" value="{{ $work_child->evidence_original_name }}" multiple>
                            <?php
                              $work_evidence_ww   = DB::table("work_evidance")->where('type_id', $work_child->id)->get();
                            ?>
                            <div id="fileList" class="file-list file-list-wc-{{ $k }}">
                              <?php if(!empty($work_evidence_ww)){ ?>  
                                @foreach ($work_evidence_ww as $work_imgs)
                                <div class="file-item">
                                    <a href="{{ asset('uploads/support_document/' . $work_imgs->evidence_file) }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i> {{$work_imgs->original_name}}</a>
                                    <div class="close_btn close_btn-0 del_wwcc_eve" eve_id="{{ $work_imgs->id }}" style="cursor: pointer;">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </div>
                                </div>
                                @endforeach
                              <?php } ?>
                            </div>
                            
                          </div>
                          <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>
                          
                          <div class="add_new_certification_div mb-3 mt-3">
                                <a style="cursor: pointer;" class="remove-wwcc" wwcc_id="{{ $work_child->id }}">- Delete WWCC</a>
                          </div>
                        </div>
                        <?php $k++;  } } ?>
                      </div>
                      <div class="add_new_certification_div mb-3 mt-3">
                            <a style="cursor: pointer;" id="add-wwcc">+ 
                              @if ($ww_child_count>0)
                              Add another WWCC
                              @else
                              Add a WWCC 
                              @endif
                              </a>
                      </div>

                      <div class="col-md-3">
                        <div class="d-flex align-items-center justify-content-between">
                          <button onclick="do_children_check()" @if(!email_verified()) disabled @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
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
                      <?php
                      
                      $issuance_date=$evidence_file='';$is_declare=0;
                      if($policy_check!='' || $policy_check!=null){
                        $issuance_date=$policy_check['issuance_date'];
                        $evidence_file=$policy_check['evidence_file'];
                        $is_declare=$policy_check['is_declare'];
                      } ?>
                      <div class="form-group ">
                        <label class="font-sm color-text-mutted mb-10">Date of issuance *</label>
                        <input class="form-control" type="date" name="issuance_date" id="issuance_date" value="{{$issuance_date}}" max="{{ date('Y-m-d') }}">
                        <span id="reqTxtdate_acquiredI" class="reqError text-danger valley"></span>     
                      </div>
                      
                      <div class="form-group">
                        <label class="form-label" for="input-1">Police Clearance</label>
                        <input type="file" name="clearance_document[]" id="{{$evidence_file!=''?($evidence_file!=''?'':'clearance_document'):'clearance_document'}}" class="form-control fileInput" multiple>
                        <span id="reqTxtimage_support_documentI" class="reqError text-danger valley"></span>
                        <div id="fileList" class="file-list file-list-police">
                          
                          <?php if(!empty($work_evidence_police)){ ?>
                            @foreach ($work_evidence_police as $work_imgs)
                            <div class="file-item">
                                <a href="{{ asset('uploads/support_document/' . $work_imgs->evidence_file) }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i> {{ $work_imgs->original_name }}</a>
                                <div class="close_btn close_btn-0 del_pc_eve" eve_id="{{ $work_imgs->id }}" style="cursor: pointer;">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </div>
                            </div>
                            @endforeach
                          <?php } ?>
                        </div>

                        
                        
                      </div>
                      <div class="col-lg-12 col-md-12 declaration_box mb-3">
                      <label>
                      
                            <input class="float-start mr-5 mt-6" type="checkbox" id="policy_confirm" name="is_declare" {{ $is_declare!=0?'checked':'' }}> I declare that my Police Clearance and legal record remain unchanged since the date of issue.
                           <br> <span id="reqTxtconfirmationCheckboxPoliceCheckI" class="reqError text-danger valley"></span>
                          </label>
                      </div>
                      <div class="col-lg-12 col-md-12">
                        <div class="d-flex align-items-center justify-content-between">
                          <button onclick="do_police_check()" @if(!email_verified()) disabled @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
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
                      
                      <div id="specialized_more" >
                        <?php
                          $specialize_count = count($specialize);
                          ?>
                        <?php if($specialize!=''){
                          $s=1;
                          foreach($specialize as $svalue){ ?>
                        <div class="add_specialized" >
                          <h6>Specialized Clearances {{$s}}</h6>
                          <div class="col-md-12">
                            <div class="form-group position-relative">
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

                          <div class="form-group ">
                            <label class="font-sm color-text-mutted mb-10 state_label">Specialized Clearance type*</label>
                            <input class="form-control clearance_type" type="text" name="clearance_type[]"  placeholder="" value="{{$svalue->clearance_type}}">
                          </div>
                          <span id="reqTxtclearance_numberI" class="reqError text-danger valley"></span>

                          <div class="form-group ">
                            <label class="font-sm color-text-mutted mb-10 state_label">Specialized Clearance Number*</label>
                            <input class="form-control clearance_number" type="text" name="clearance_number[]" placeholder="" value="{{$svalue->clearance_number}}">
                          </div>
                          <span id="reqTxtclearance_numberI" class="reqError text-danger valley"></span>

                          <div class="form-group ">
                            <label class="font-sm color-text-mutted mb-10">Expiry Date*</label>
                            <input class="form-control clearance_expiry_date" type="date" name="clearance_expiry_date[]" value="{{$svalue->clearance_expiry_date}}" min="{{ date('Y-m-d') }}">
                          </div>
                          <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>

                          <div class="form-group ">
                            <label class="font-sm color-text-mutted mb-10">Upload Evidence*</label>
                            <input class="form-control fileInput {{$svalue->clearance_evidence==''?'clearance_evidence':''}}" type="file" name="clearance_evidence[{{ $s-1}}][]" multiple>
                            
                            <?php
                              $work_evidence_specialized   = DB::table("work_evidance")->where('type_id', $svalue->id)->get(); 
                            ?>
                            <div id="fileList" class="file-list file-list-specialized-{{ $s }}">
                              <?php if(!empty($work_evidence_specialized)){ ?>  
                                @foreach ($work_evidence_specialized as $work_imgs)
                                <div class="file-item">
                                    <a href="{{ asset('uploads/support_document/' . $work_imgs->evidence_file) }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i> {{$work_imgs->original_name}}</a>
                                    <div class="close_btn close_btn-0 del_sc_eve" eve_id="{{$work_imgs->id}}" style="cursor: pointer;">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </div>
                                </div>
                                @endforeach
                              <?php } ?>
                            </div>
                          </div>
                          <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>

                          <div class="add_new_certification_div mb-3 mt-3">
                                <a style="cursor: pointer;" class="remove-specialized" clearance_id="{{$svalue->id}}">- Delete specialized Clearance</a>
                          </div>
                        </div>
                        <?php $s++;  } } ?>
                      </div>
                      <div class="add_new_certification_div mb-3 mt-3">
                            <a style="cursor: pointer;" id="add-specialized">+ 
                              @if($specialize_count>0)
                              Add another Specialized Clearances
                              @else
                              Add a Specialized Clearances
                              @endif
                            </a>
                      </div>

                      <div class="col-md-3">
                        <div class="d-flex align-items-center justify-content-between">
                          <button onclick="updateSpecializedClearance()"  @if(!email_verified()) disabled @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit</span>
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
  </section>
</main>
                        </div>
<?php
if (!empty($interviewReferenceData)) {
  $country_iso = $interviewReferenceData->contact_country_iso;
} else {
  $country_iso = "au";
}
?>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script src="{{ url('/public') }}/nurse/assets/js/jquery.ui.datepicker.monthyearpicker.js"></script>
@include('nurse.front_profile_js');
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js">
</script>
<script>
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
          $(this).text("+ Add another WWCC");
          $('#wwcc_more').append(`<div class="add_wwcc" >
                          <h6>WWCC ${i}</h6>
                          <div class="col-md-12">
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

                          <div class="form-group ">
                            <label class="font-sm color-text-mutted mb-10 state_label">Clearance Number*</label>
                            <input class="form-control wwcc_clearance" type="text" name="wwcc_clearance_number[]" placeholder="" value="">
                          </div>
                          <span id="reqTxtclearance_numberI" class="reqError text-danger valley"></span>

                          <div class="form-group ">
                            <label class="font-sm color-text-mutted mb-10">Expiry Date*</label>
                            <input class="form-control clearance_expiry" type="date" name="wwcc_expiry_date[]" value="" min="{{ date('Y-m-d') }}">
                          </div>
                          <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>

                          <div class="form-group ">
                            <label class="font-sm color-text-mutted mb-10">Upload Evidence*</label>
                            <input class="form-control wwcc_evidence fileInput" type="file" name="wwcc_evidence[${i-1}][]" multiple>
                            <div id="fileList" class="file-list file-list-wc-${i}"></div>
                          </div>
                          
                          <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>
                          <div class="add_new_certification_div mb-3 mt-3">
                                <a style="cursor: pointer;" class="remove-wwcc">- Delete WWCC</a>
                              </div>
                        </div>` );
                        initializeFileUpload();
                  i++;
        });

        

        $(document).on('click', '.remove-wwcc', function () {
          const otherId= $(this).attr('wwcc_id');
          if (otherId)
          {

            $.ajax({
              url: "{{ url('/nurse') }}/removeWwcc",
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

        let specialized_div_count = $("#specialized_more .add_specialized").length;
        console.log("specialized_div_count",specialized_div_count);
        
        $('#add-specialized').click(function(){
          $(this).text("+ Add another Specialized Clearances");
          $('#specialized_more').append(
            `<div class="add_specialized" >
                          <h6>Specialized Clearances ${l}</h6>
                          <div class="col-md-12">
                            <div class="form-group position-relative">
                              
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

                          <div class="form-group ">
                            <label class="font-sm color-text-mutted mb-10 state_label">Specialized Clearance type*</label>
                            <input class="form-control clearance_type" type="text" name="clearance_type[]"  placeholder="" value="">
                          </div>
                          <span id="reqTxtclearance_numberI" class="reqError text-danger valley"></span>

                          <div class="form-group ">
                            <label class="font-sm color-text-mutted mb-10 state_label">Specialized Clearance Number*</label>
                            <input class="form-control clearance_number" type="text" name="clearance_number[]" placeholder="" value="">
                          </div>
                          <span id="reqTxtclearance_numberI" class="reqError text-danger valley"></span>

                          <div class="form-group ">
                            <label class="font-sm color-text-mutted mb-10">Expiry Date*</label>
                            <input class="form-control clearance_expiry_date" type="date" name="clearance_expiry_date[]" value="" min="{{ date('Y-m-d') }}">
                          </div>
                          <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>

                          <div class="form-group ">
                            <label class="font-sm color-text-mutted mb-10">Upload Evidence*</label>
                            <input class="form-control clearance_evidence fileInput" type="file" name="clearance_evidence[${l-1}][]" multiple>

                            <div id="fileList" class="file-list file-list-specialized-${l}"></div>
                          </div>
                          
                          <span id="reqTxtclearance_expiry_dataI" class="reqError text-danger valley"></span>

                          <div class="add_new_certification_div mb-3 mt-3">
                                <a style="cursor: pointer;" class="remove-specialized">- Delete specialized Clearance</a>
                          </div>
                        </div>`);
                        initializeFileUpload();
                        l++;
        });

        $(document).on('click', '.remove-specialized', function () {
          const clearance_id=$(this).attr('clearance_id');
          if (clearance_id)
          {

            $.ajax({
              url: "{{ url('/nurse') }}/removeSpecialized",
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
</script>

<script>
  
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
</script>
<script>
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
      // if($('#upload_evidence0')[0]){
        
      //   if ($('#upload_evidence0')[0].files.length === 0) {
      //     console.log("upload_evidence0",$('#upload_evidence0')[0].files.length);
      //       isValid = false;
      //       $('#upload_evidence0').next('.reqError').text('Please upload an evidence file');
      //   } else {
      //       $('#upload_evidence0').next('.reqError').text('');
      //   }
      // }
      if($('.file-list-0 .file-item').length == 0){
        isValid = false;
        $('#upload_evidence0').next('.reqError').text('Please upload an evidence file');
      }else{
        $('#upload_evidence0').next('.reqError').text('');
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

      // if($('#upload_evidence1')[0]){
      //   if ($('#upload_evidence1')[0].files.length === 0) {
      //     isValid = false;
      //     $('#upload_evidence1').next('.reqError').text('Please upload an evidence file');
      //   } else {
      //       $('#upload_evidence1').next('.reqError').text('');
      //   }
      // }

      if($('.file-list-1 .file-item').length == 0){
        isValid = false;
        $('#upload_evidence1').next('.reqError').text('Please upload an evidence file');
      }else{
        $('#upload_evidence1').next('.reqError').text('');
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
      // if($('#upload_evidence2')[0]){
      //   if ($('#upload_evidence2')[0].files.length === 0) {
          
      //       isValid = false;
      //       $('#upload_evidence2').next('.reqError').text('Please upload an evidence file');
      //     } else {
      //         $('#upload_evidence2').next('.reqError').text('');
      //     }
      // }   
      if($('.file-list-2 .file-item').length == 0){
        isValid = false;
        $('#upload_evidence2').next('.reqError').text('Please upload an evidence file');
      }else{
        $('#upload_evidence2').next('.reqError').text('');
      }
    }
    


    
    if (isValid == true) {
      let formData = new FormData($('#multi-step-form-eligibility')[0]);
      $.ajax({
        type: 'POST',
        url: "{{route('nurse.update-profession-user-eligibility')}}",
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
              window.location = resp.url;
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
    // if($('#ndis_evidence')[0]){
      
    //   if ($('#ndis_evidence')[0].files.length === 0) {
    //     isValid = false;
    //     $('#ndis_evidence').next('.reqError').text('Please upload evidance file ');
    //   } else {
    //     $('#ndis_evidence').next('.reqError').text('');
    //   }
    // }
    if($('.file-list-ndis .file-item').length == 0){
      isValid = false;
      $('#ndis_evidence').next('.reqError').text('Please upload an evidence file');
    }else{
      $('#ndis_evidence').next('.reqError').text('');
    }

    if (isValid == true) {
      let formData = new FormData($('#multi-step-form-ndis')[0]);
      $.ajax({
        type: 'POST',
        url: "{{route('nurse.update-ndis')}}",
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
              window.location = resp.url;
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

    var k = 1;
    $('.wwcc_evidence').each(function () {
      let errorSpan = $(this).closest('.form-group').next('.reqError');
        console.log("file-list-wc",$(".file-list-wc-"+k+" .file-item").length);
        if ($(".file-list-wc-"+k+" .file-item").length == 0) {
          isValid = false;
          errorSpan.text('Please upload an evidence file');
        } else {
          errorSpan.text('');
        }
        k++;
    });
    
    if (isValid == true) {
      $(".valley").html("");
      $('.submit-btn-120').prop('disabled', true);
      $('.submit-btn-1').show();
      $('.resetpassword').hide();

      let formData = new FormData($('#multi-step-form-children')[0]);
      $.ajax({
        type: 'POST',
        url: "{{route('nurse.update-profession-user-children')}}",
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
              window.location = resp.url;
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

    // if($('#clearance_document')[0]){
      
    //   if ($('#clearance_document')[0].files.length === 0) {
    //     isValid = false;
    //     $('#clearance_document').next('.reqError').text('Policy Clearance document is required ');
    //   } else {
    //     $('#clearance_document').next('.reqError').text('');
    //   }
    // }

    if($('.file-list-police .file-item').length == 0){
      isValid = false;
      $('#clearance_document').next('.reqError').text('Policy Clearance document is required ');
    }else{
      $('#clearance_document').next('.reqError').text('');
    }

    if (!$('#policy_confirm').is(':checked')) {
      isValid = false;
      $('#reqTxtconfirmationCheckboxPoliceCheckI').text('Please check this checkbox');
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
        url: "{{route('nurse.update-profession-user-police-check')}}",
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
              window.location = resp.url;
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
    
    
    var s = 1;
    $('.clearance_evidence').each(function () {
      let errorSpan = $(this).closest('.form-group').next('.reqError');
        if ($(".file-list-specialized-"+s+" .file-item").length == 0) {
            isValid = false;
            errorSpan.text('Please upload an evidence file');
        } else {
          errorSpan.text('');
        }
        s++;
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
        url: "{{route('nurse.updateSpecializedClearance')}}",
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
              window.location = resp.url;
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
 
  function doprofessionregistration() {
    event.preventDefault();
    $(".valley").html("");
    $('.submit-btn-120').prop('disabled', true);
    $('.submit-btn-1').show();
    $('.resetpassword').hide();
    var returnValue;
    var ahpra_numberI = document.getElementById("ahpra_numberI").value;
    returnValue = true;
    if (ahpra_numberI.trim() == "") {
      document.getElementById("reqTxtahpra_numberI").innerHTML = "* Please Enter the AHPRA Registration number.";
      returnValue = false;
    }

    if (returnValue == false) {
      $('.submit-btn-120').prop('disabled', false);
      $('.submit-btn-1').hide();
      $('.resetpassword').show();
    }



    if (returnValue == true) {

      let formData = new FormData($('#multi-step-form-registration')[0]);

      $.ajax({
        type: 'POST',
        url: "{{route('nurse.update-profession-user-ahpra_numberI')}}",
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
            $('#multi-step-form-registration')[0].reset();
            Swal.fire({
              icon: 'success',
              title: 'Successfully!',
              text: resp.message,
            }).then(function() {
              // window.location = resp.url;
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

  function doprofessionSeting_update() {
    event.preventDefault();
    $(".valley").html("");
    $('.submit-btn-120').prop('disabled', true);
    $('.submit-btn-1').show();
    $('.resetpassword').hide();

    let formData = new FormData($('#multi-step-form-nurseProfileForm')[0]);
    $.ajax({
      type: 'POST',
      url: "{{route('nurse.update-profession-profile-setting')}}",
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
          // $('#multi-step-form')[0].reset();
          Swal.fire({
            icon: 'success',
            title: 'Successfully!',
            text: resp.message,
          }).then(function() {
            // window.location = resp.url;
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

  function doprofession() {
    event.preventDefault();
    $(".valley").html("");
    $('.submit-btn-120').prop('disabled', true);
    $('.submit-btn-1').show();
    $('.resetpassword').hide();

    var returnValue;

    var specialtyId = document.getElementById("specialtyId").value;
    var subspecialtyId = document.getElementById("subspecialtyId").value;
    var assistent_level = document.getElementById("assistent_level").value;
    var evidence_type = document.getElementById("evidence_type").value;
    var image_evidenceI = document.getElementById("image_evidenceI").value;

    returnValue = true;

    if (specialtyId.trim() == "") {
      document.getElementById("reqTxtspecialtyId").innerHTML = "* Please Select Profession.";
      returnValue = false;
    }

    if (subspecialtyId.trim() == "") {
      document.getElementById("reqsubspecialtyId").innerHTML = "* Please Select Practitioner Type  .";
      returnValue = false;
    }

    if (assistent_level.trim() == "") {
      document.getElementById("reqassistent_level").innerHTML = "* Please Select the Year Level.";
      returnValue = false;
    }

    if (evidence_type.trim() == "") {
      document.getElementById("reqevidence_type").innerHTML = "* Please Select the Evidence Type.";
      returnValue = false;
    }

    if (image_evidenceI.trim() == "") {
      document.getElementById("reqaimage_evidence").textContent = "* Please Upload the Evidence of year level.";
      returnValue = false;
    }

    if (returnValue == false) {
      $('.submit-btn-120').prop('disabled', false);
      $('.submit-btn-1').hide();
      $('.resetpassword').show();
    }

    if (returnValue == true) {
      let formData = new FormData($('#multi-step-form')[0]);
      $.ajax({
        type: 'POST',
        url: "{{route('nurse.update-profession')}}",
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
            $('#multi-step-form')[0].reset();
            Swal.fire({
              icon: 'success',
              title: 'Successfully!',
              text: resp.message,
            }).then(function() {
              window.location = resp.url;
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

  function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $(".error").remove();
    $.each(msg, function(key, value) {
      $('#district_id').after('<span class="error">' + value + '</span>');
      $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
    });
  }

  function initializeFileUpload() {
    $(".fileInput").each(function () {
        
        const fileInput = $(this);
        const fileList = fileInput.siblings(".file-list"); // Select the correct file list
        const selectedFiles = new DataTransfer(); // Maintain a single file
        
        fileInput.off("change").on("change", function (event) {
          Array.from(event.target.files).forEach((file) => {
                selectedFiles.items.add(file);

                // Create a file item container
                const fileDiv = $("<div>").addClass("file-item");

                // Create a link to the file with the file name
                const fileLink = $("<a>")
                    .attr("href", URL.createObjectURL(file))  // Use Blob URL to link the file
                    .attr("target", "_blank")
                    .html(`<i class="fa fa-file" aria-hidden="true"></i> ${file.name}`);

                // Create the close button
                const closeButton = $("<div>").addClass("close_btn close_btn-0").css("cursor", "pointer");
                const closeIcon = $("<i>").addClass("fa fa-close").attr("aria-hidden", "true");

                // Append the close icon to the close button
                closeButton.append(closeIcon);

                // Add event listener to remove the file item when clicked
                closeButton.on("click", function () {
                    for (let i = 0; i < selectedFiles.items.length; i++) {
                        if (selectedFiles.items[i].getAsFile().name === file.name) {
                            selectedFiles.items.remove(i);
                            break;
                        }
                    }
                    fileInput[0].files = selectedFiles.files;

                    // Remove the file div from the list
                    fileDiv.remove();
                });

                // Append the link and close button to the file div
                fileDiv.append(fileLink).append(closeButton);

                // Append the file div to the file list container
                fileList.append(fileDiv);
            });

            // Update the file input with the modified FileList
            fileInput[0].files = selectedFiles.files;
            
        });
    });
}

// Call the function when the document is ready
$(document).ready(function () {
    initializeFileUpload();
});


    $('.del_eve').on('click',function(){
        const eve_id = $(this).attr('eve_id');
        $.ajax({
                url: "{{ url('/nurse') }}/removeEligibilityFile", 
                type: 'GET',
                data: { id: eve_id }, // Pass the ID as a parameter
                success: function (response) {
                    
                    $(`.del_eve[eve_id="${eve_id}"]`).closest('.file-item').remove();
                },
                error: function (xhr, status, error) {
                    console.error(`Failed to fetch data for ID: ${eve_id}`, error);
                },
            });
    });

    $('.del_ndis_eve').on('click', function () {
      const eve_id = $(this).attr('eve_id'); // Get the file id

      $.ajax({
          url: "{{ url('/nurse') }}/removendisFile",
          type: 'GET',
          data: { id: eve_id }, // Pass the file id as a parameter
          success: function (response) {
              // Find the file item and remove it
              $(`.del_ndis_eve[eve_id="${eve_id}"]`).closest('.file-item').remove();
          },
          error: function (xhr, status, error) {
              console.error(`Failed to fetch data for ID: ${eve_id}`, error);
          },
      });
    });

    $('.del_wwcc_eve').on('click', function () {
      const eve_id = $(this).attr('eve_id'); // Get the file id

      $.ajax({
          url: "{{ url('/nurse') }}/removewwccFile",
          type: 'GET',
          data: { id: eve_id }, // Pass the file id as a parameter
          success: function (response) {
              // Find the file item and remove it
              $(`.del_wwcc_eve[eve_id="${eve_id}"]`).closest('.file-item').remove();
          },
          error: function (xhr, status, error) {
              console.error(`Failed to fetch data for ID: ${eve_id}`, error);
          },
      });
    });

    $('.del_pc_eve').on('click', function () {
      const eve_id = $(this).attr('eve_id'); // Get the file id

      $.ajax({
          url: "{{ url('/nurse') }}/removePolicyFile",
          type: 'GET',
          data: { id: eve_id }, // Pass the file id as a parameter
          success: function (response) {
              // Find the file item and remove it
              $(`.del_pc_eve[eve_id="${eve_id}"]`).closest('.file-item').remove();
          },
          error: function (xhr, status, error) {
              console.error(`Failed to fetch data for ID: ${eve_id}`, error);
          },
      });
    });

    $('.del_sc_eve').on('click', function () {
      const eve_id = $(this).attr('eve_id'); // Get the file id

      $.ajax({
          url: "{{ url('/nurse') }}/removeSpecializedFile",
          type: 'GET',
          data: { id: eve_id }, // Pass the file id as a parameter
          success: function (response) {
              // Find the file item and remove it
              $(`.del_sc_eve[eve_id="${eve_id}"]`).closest('.file-item').remove();
          },
          error: function (xhr, status, error) {
              console.error(`Failed to fetch data for ID: ${eve_id}`, error);
          },
      });
    });
    
    
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