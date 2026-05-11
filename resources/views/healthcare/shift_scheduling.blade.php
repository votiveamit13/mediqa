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

  form#language_skills_form ul.select2-selection__rendered {
    box-shadow: none;
    max-height: inherit;
    border: none;
    position: relative;
  }

  .sublang_main_div select{
    padding: 5px;
    border: 1px solid #dddddd;
    height: 50px;
  }

  .custom-select-wrapper {
  position: relative;
  width: 100%;
}

.custom-select {
  width: 100%;
  padding: 10px;
  appearance: none; /* Remove native arrow */
  -webkit-appearance: none;
  -moz-appearance: none;
  background: white;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
}

/* Custom arrow */
.custom-select-wrapper::after {
  content: "▼";
  position: absolute;
  top: 76%;
  right: 10px;
  transform: translateY(-50%);
  pointer-events: none;
  color: black;
  height: 36px !important;
  width: 20px;
}

form#shift_scheduling_form ul.select2-selection__rendered {
    box-shadow: none;
    max-height: inherit;
    border: none;
    position: relative;
  }

  .clear-btn{
    visibility: hidden;
  }

</style>
@endsection

@section('content')
<main class="main">
  <section class="section-box mt-0">
    <div class="">
      <div class="row m-0 profile-wrapper">
        <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">

        @include('healthcare.layouts.job_sidebar')
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 col-12 right_content">
          <div class="content-single content_profile">
            

            <div class="tab-content">
                <?php $user_id=''; $i = 0;?>

                <div class="tab-pane fade" id="tab-my-profile-setting" style="display: block;opacity:1;">

                    
                    <div class="card shadow-sm border-0 p-4 mt-30">
                      @include('healthcare.layouts.top_links')
                      <h3 class="mt-0 color-brand-1 mb-2">Shifts & Scheduling</h3>
    
                      <form id="shift_scheduling_form" method="POST" onsubmit="return shift_scheduling_form()">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::guard('healthcare_facilities')->user()->id }}">
                        <div class="form-group drp--clr">
                          <label class="form-label" for="input-1">Shift Types</label>
                          <input type="hidden" name="job_id" value="{{ $job_id }}">
                          <input type="hidden" name="shift_types_field" class="shift_types_field" value='@if(!empty($job_data)){{ $job_data->shift_type }}@endif'>
                          <ul id="shift_types_data" style="display:none;">
                            
                            <?php
                            $j = 1;
                            ?>
                            <li data-value="0">select</li>
                            @foreach($shift_types_data as $shift_types)
                            <li id="nursing_menus-{{ $j }}" data-value="{{ $shift_types->work_shift_id }}">{{ $shift_types->shift_name }}</li>
                            <?php
                            $j++;
                            ?>
                            @endforeach
                          </ul>

                          <select class="js-example-basic-multiple addAll_removeAll_btn nurse_type_field" data-list-id="shift_types_data" name="shift_types_data[]" multiple id="nurse_type"></select>
                          <span id="reqshift_types_data" class="reqError text-danger valley"></span>    
                        </div> 
                        <div class="form-group drp--clr">
                          <label class="form-label" for="input-1">Shift Length</label>
                          <input type="hidden" name="shift_types_field" class="shift_length_field" value='@if(!empty($job_data)){{ $job_data->shift_length }}@endif'>
                          <ul id="shift_length_data" style="display:none;">
                            
                            <?php
                            $j = 1;
                            ?>
                            <li data-value="0">select</li>
                            @foreach($shift_length_data as $shift_types)
                            <li id="nursing_menus-{{ $j }}" data-value="{{ $shift_types->work_shift_id }}">{{ $shift_types->shift_name }}</li>
                            <?php
                            $j++;
                            ?>
                            @endforeach
                          </ul>

                          <select class="js-example-basic-multiple addAll_removeAll_btn nurse_type_field" data-list-id="shift_length_data" name="shift_length_data[]" multiple id="nurse_type" onchange="getNurseType('main',0)"></select>
                          <span id="reqshift_length_data" class="reqError text-danger valley"></span>    
                        </div> 
                        <div class="form-group drp--clr">
                          <label class="form-label" for="input-1">Schedule Model</label>
                          <input type="hidden" name="schedule_model" class="schedule_model" value='@if(!empty($job_data)){{ $job_data->schedule_model }}@endif'>
                          <ul id="schedule_model_data" style="display:none;">
                            
                            <?php
                            $j = 1;
                            ?>
                            <li data-value="0">select</li>
                            @foreach($schedule_model_data as $shift_types)
                            <li id="nursing_menus-{{ $j }}" data-value="{{ $shift_types->work_shift_id }}">{{ $shift_types->shift_name }}</li>
                            <?php
                            $j++;
                            ?>
                            @endforeach
                          </ul>

                          <select class="js-example-basic-multiple addAll_removeAll_btn nurse_type_field" data-list-id="schedule_model_data" name="schedule_model_data[]" id="nurse_type" onchange="getNurseType('main',0)"></select>
                          <span id="reqschedule_model_data" class="reqError text-danger valley"></span>    
                        </div> 
                        <div class="form-group drp--clr">
                          <label class="form-label" for="input-1">Weekly Work Patterns</label>
                          <input type="hidden" name="weekly_work_patterns" class="weekly_work_patterns" value='@if(!empty($job_data)){{ $job_data->weekly_work_patterns }}@endif'>
                          <ul id="weekly_work_patters" style="display:none;">
                            
                            <?php
                            $j = 1;
                            ?>
                            <li data-value="0">select</li>
                            @foreach($weekly_work_patters as $shift_types)
                            <li id="nursing_menus-{{ $j }}" data-value="{{ $shift_types->work_shift_id }}">{{ $shift_types->shift_name }}</li>
                            <?php
                            $j++;
                            ?>
                            @endforeach
                          </ul>

                          <select class="js-example-basic-multiple addAll_removeAll_btn nurse_type_field" data-list-id="weekly_work_patters" name="weekly_work_patters[]" id="nurse_type" onchange="getNurseType('main',0)"></select>
                          <span id="reqweekly_work_patters" class="reqError text-danger valley"></span>    
                        </div> 
                        <div class="form-group drp--clr">
                          <label class="form-label" for="input-1">Shift Rotation & Cycle</label>
                          <input type="hidden" name="shift_rotation" class="shift_rotation" value='@if(!empty($job_data)){{ $job_data->shift_rotation }}@endif'>
                          <ul id="shift_rotation_data" style="display:none;">
                            
                            <?php
                            $j = 1;
                            ?>
                            <li data-value="0">select</li>
                            @foreach($shift_rotation_data as $shift_types)
                            <li id="nursing_menus-{{ $j }}" data-value="{{ $shift_types->work_shift_id }}">{{ $shift_types->shift_name }}</li>
                            <?php
                            $j++;
                            ?>
                            @endforeach
                          </ul>

                          <select class="js-example-basic-multiple addAll_removeAll_btn nurse_type_field" data-list-id="shift_rotation_data" name="shift_rotation_data[]" id="nurse_type" onchange="getNurseType('main',0)"></select>
                          <span id="reqshift_rotation_data" class="reqError text-danger valley"></span>    
                        </div> 
                        <div class="form-group drp--clr">
                          <label class="form-label" for="input-1">Specialty & Non-Traditional Shift</label>
                          <input type="hidden" name="non_trad_shift" class="non_trad_shift" value='@if(!empty($job_data)){{ $job_data->non_trad_shift }}@endif'>
                          <ul id="non_trad_shift" style="display:none;">
                            
                            <?php
                            $j = 1;
                            ?>
                            <li data-value="0">select</li>
                            @foreach($non_trad_shift as $shift_types)
                            <li id="nursing_menus-{{ $j }}" data-value="{{ $shift_types->work_shift_id }}">{{ $shift_types->shift_name }}</li>
                            <?php
                            $j++;
                            ?>
                            @endforeach
                          </ul>

                          <select class="js-example-basic-multiple addAll_removeAll_btn nurse_type_field" data-list-id="non_trad_shift" name="non_trad_shift[]" multiple id="nurse_type" onchange="getNurseType('main',0)"></select>
                          <span id="reqnon_trad_shift" class="reqError text-danger valley"></span>    
                        </div> 
                        <div class="form-group drp--clr">
                          <label class="form-label" for="input-1">Maternity & Midwifery Shift</label>
                          <input type="hidden" name="maternity_shift" class="maternity_shift" value='@if(!empty($job_data)){{ $job_data->maternity_shift }}@endif'>
                          <ul id="maternity_shift" style="display:none;">
                            
                            <?php
                            $j = 1;
                            ?>
                            <li data-value="0">select</li>
                            @foreach($maternity_shift as $shift_types)
                            <li id="nursing_menus-{{ $j }}" data-value="{{ $shift_types->work_shift_id }}">{{ $shift_types->shift_name }}</li>
                            <?php
                            $j++;
                            ?>
                            @endforeach
                          </ul>

                          <select class="js-example-basic-multiple addAll_removeAll_btn nurse_type_field" data-list-id="maternity_shift" name="maternity_shift[]" multiple id="nurse_type" onchange="getNurseType('main',0)"></select>
                          <span id="reqmaternity_shift" class="reqError text-danger valley"></span>    
                        </div> 
                        <div class="form-group drp--clr">
                          <label class="form-label" for="input-1">Days Off</label>
                          <input type="hidden" name="days_off" class="days_off" value='@if(!empty($job_data)){{ $job_data->days_off }}@endif'>
                          <ul id="days_off_data" style="display:none;">
                            
                            <?php
                            $j = 1;
                            ?>
                            <li data-value="0">select</li>
                            @foreach($days_off_data as $shift_types)
                            <li id="nursing_menus-{{ $j }}" data-value="{{ $shift_types->work_shift_id }}">{{ $shift_types->shift_name }}</li>
                            <?php
                            $j++;
                            ?>
                            @endforeach
                          </ul>

                          <select class="js-example-basic-multiple addAll_removeAll_btn nurse_type_field" data-list-id="days_off_data" name="days_off_data[]" multiple id="nurse_type" onchange="getNurseType('main',0)"></select>
                          <span id="reqdays_off_data" class="reqError text-danger valley"></span>    
                        </div>
                        
                        <div class="form-group drp--clr specific_days_off_subdata d-none">
                          <label class="form-label" for="input-1">Specific Days Off(Days Off)</label>
                          <input type="hidden" name="perticular_days_off" class="perticular_days_off" value='@if(!empty($job_data)){{ $job_data->perticular_days_off }}@endif'>
                          <ul id="specific_days_off_subdata" style="display:none;">
                            
                            <?php
                            $j = 1;
                            ?>
                            <li data-value="0">select</li>
                            @foreach($specific_days_off_subdata as $shift_types)
                            <li id="nursing_menus-{{ $j }}" data-value="{{ $shift_types->work_shift_id }}">{{ $shift_types->shift_name }}</li>
                            <?php
                            $j++;
                            ?>
                            @endforeach
                          </ul>

                          <select class="js-example-basic-multiple addAll_removeAll_btn nurse_type_field" data-list-id="specific_days_off_subdata" name="specific_days_off_subdata[]" multiple id="nurse_type" onchange="getNurseType('main',0)"></select>
                          <span id="reqspecific_days_off_data" class="reqError text-danger valley"></span>    
                        </div> 
                        <div class="form-group drp--clr">
                          <label class="form-label" for="input-1">Specific Days Off</label>
                          <input type="hidden" name="specific_days_off" class="specific_days_off" value='@if(!empty($job_data)){{ $job_data->specific_days_off }}@endif'>
                          <ul id="specific_days_off_data" style="display:none;">
                            
                            <?php
                            $j = 1;
                            ?>
                            <li data-value="0">select</li>
                            @foreach($specific_days_off_data as $shift_types)
                            <li id="nursing_menus-{{ $j }}" data-value="{{ $shift_types->work_shift_id }}">{{ $shift_types->shift_name }}</li>
                            <?php
                            $j++;
                            ?>
                            @endforeach
                          </ul>

                          <select class="js-example-basic-multiple addAll_removeAll_btn nurse_type_field" data-list-id="specific_days_off_data" name="specific_days_off_data[]" multiple id="nurse_type" onchange="getNurseType('main',0)"></select>
                          <span id="reqspecific_days_off_data" class="reqError text-danger valley"></span>    
                        </div> 
                        <h6 class="emergency_text">
                          Shift Details
                        </h6>
                        @if(!empty($job_data) && $job_data->main_emp_type == 3)
                        <div class="shift_details">
                          <div class=" drp--clr">
                            <label class="form-label" for="input-1">Shift Details</label>
                            <div class="shift_detail_input">
                              <input type="radio" name="shift_mode" value="single"> Single Shift
                              <input type="radio" name="shift_mode" value="range"> Date Range
                            </div>
                            <span id='reqshift_mode' class='reqError text-danger valley'></span>
                          </div>
                          <div class="temporary_shift_details single_shift_content d-none">
                            <div class="row">
                              <div class="form-group level-drp col-md-6">
                                <label class="form-label" for="input-1">Start date & time
                                </label>
                                <input class="form-control temporarysingle_start_date" type="datetime-local" name="temporarysingle_start_date" value="{{ $job_data->single_shift_start_datetime }}" id="temporary_hours_week">
                                <span id='reqtemporarysingle_start_date' class='reqError text-danger valley'></span>
                              </div>
                              <div class="form-group level-drp col-md-6">
                                <label class="form-label" for="input-1">End date & time
                                </label>
                                <input class="form-control temporarysingle_end_date" type="datetime-local" name="temporarysingle_end_date" value="{{ $job_data->single_shift_end_datetime }}" id="temporary_hours_week">
                                <span id='reqtemporarysingle_end_date' class='reqError text-danger valley'></span>
                              </div>
                            </div>
                          </div>
                          <div class="temporary_shift_details date_range_content d-none">
                            <div class="row">
                              <div class="form-group level-drp col-md-6">
                                <label class="form-label" for="input-1">Start date
                                </label>
                                <input class="form-control temporaryrangestart_date" type="date" name="temporaryrangestart_date" value="{{ $job_data->daterange_start_date }}" id="temporary_hours_week">
                                <span id='reqtemporaryrangestart_date' class='reqError text-danger valley'></span>
                              </div>
                              <div class="form-group level-drp col-md-6">
                                <label class="form-label" for="input-1">End date
                                </label>
                                <input class="form-control temporaryrangeend_date" type="date" name="temporaryrangeend_date" value="{{ $job_data->daterange_end_date }}" id="temporary_hours_week">
                                <span id='reqtemporaryrangeend_date' class='reqError text-danger valley'></span>
                              </div>
                              
                            </div>
                            <div class="form-group level-drp">
                              <label class="form-label" for="input-1">Number of shifts
                              </label>
                              <input class="form-control temporaryrangenoshifts" type="number" name="temporaryrangenoshifts" value="{{ $job_data->no_of_shifts }}" id="temporary_hours_week">
                              <span id='reqtemporaryrangenoshifts' class='reqError text-danger valley'></span>
                            </div>
                            <div class="form-group level-drp">
                              <label class="form-label" for="input-1">Notes
                              </label>
                              <textarea rows="5" class="form-control temporaryrangenotes" name="temporaryrangenotes" style="min-height:100px">{{ $job_data->notes }}</textarea>
                              <span id='reqtemporaryrangenotes' class='reqError text-danger valley'></span>
                            </div>
                          </div>
                        </div>
                        @endif
                        @if(!empty($job_data) && $job_data->main_emp_type == 1)
                        <div class="permanent_shift_details">
                          <div class="level-drp">
                            <label class="form-label" for="input-1">Start Date & Urgency
                            </label>
                            <div class="start_date_urgency_div">

                              <div class="form-check">
                                <input @if($job_data->start_date_urgency_permanent == "immediate") checked @endif class="form-check-input start_date_urgency" type="radio" name="start_date_urgency" id="urgency_immediate" value="immediate">
                                <label class="form-check-label" for="urgency_immediate">
                                  Immediate (as soon as possible)
                                </label>
                              </div>

                              <div class="form-check">
                                <input @if($job_data->start_date_urgency_permanent == "within_seven_week" || $job_data->start_date_urgency_permanent == "within_five_week" || $job_data->start_date_urgency_permanent == "within_two_week") checked @endif class="form-check-input start_date_urgency" type="radio" name="start_date_urgency" id="urgency_within_weeks" value="within_weeks">
                                <label class="form-check-label" for="urgency_within_weeks">
                                  Within weeks
                                </label>
                              </div>

                              <div class="permanent_shift_div within_weeks_div d-none ms-4">

                                <div class="form-check">
                                  <input @if($job_data->start_date_urgency_permanent == "within_two_week") checked @endif class="form-check-input within_weeks_radio" type="radio" name="within_weeks_radio" id="within_two_week" value="within_two_week">
                                  <label class="form-check-label" for="within_two_week">Within 2 weeks</label>
                                </div>

                                <div class="form-check">
                                  <input @if($job_data->start_date_urgency_permanent == "within_five_week") checked @endif class="form-check-input within_weeks_radio" type="radio" name="within_weeks_radio" id="within_five_week" value="within_five_week">
                                  <label class="form-check-label" for="within_five_week">Within 5 weeks</label>
                                </div>

                                <div class="form-check">
                                  <input @if($job_data->start_date_urgency_permanent == "within_seven_week") checked @endif class="form-check-input within_weeks_radio" type="radio" name="within_weeks_radio" id="within_seven_week" value="within_seven_week">
                                  <label class="form-check-label" for="within_seven_week">Within 7 weeks</label>
                                </div>

                              </div>

                              <div class="form-check">
                                <input class="form-check-input start_date_urgency" type="radio" name="start_date_urgency" id="urgency_scheduled" value="scheduled_date">
                                <label class="form-check-label" for="urgency_scheduled">
                                  Scheduled date
                                </label>
                              </div>
                              <span id='reqstart_date_urgency' class='reqError text-danger valley'></span>
                              <div class="permanent_shift_div form-group level-drp scheduled_date_field d-none">
                                
                                <input class="form-control scheduled_date" type="date" name="scheduled_date" value="{{ $job_data->start_date_urgency_permanent }}" id="scheduled_date">
                                <span id='reqscheduled_date' class='reqError text-danger valley'></span>
                              </div>
                            </div>

                          </div>
                        </div>
                        @endif
                        <input type="hidden" name="main_emp_type" class="main_emp_type" value="{{ $job_data->main_emp_type }}">
                        @if(!empty($job_data) && $job_data->main_emp_type == 2)
                        <div class="permanent_shift_details">
                          
                          <div class="level-drp">
                            <label class="form-label" for="input-1">Start Date & Urgency
                            </label>
                            <div class="start_date_urgency_div">

                              <div class="form-check">
                                <input @if($job_data->start_date_urgency_fixedterm == "immediate") checked @endif class="form-check-input start_date_urgency" type="radio" name="start_date_urgency" id="urgency_immediate" value="immediate">
                                <label class="form-check-label" for="urgency_immediate">
                                  Immediate (as soon as possible)
                                </label>
                              </div>

                              <div class="form-check">
                                <input @if($job_data->start_date_urgency_fixedterm == "within_seven_week" || $job_data->start_date_urgency_fixedterm == "within_five_week" || $job_data->start_date_urgency_fixedterm == "within_two_week") checked @endif class="form-check-input start_date_urgency" type="radio" name="start_date_urgency" id="urgency_within_weeks" value="within_weeks">
                                <label class="form-check-label" for="urgency_within_weeks">
                                  Within weeks
                                </label>
                              </div>

                              <div class="permanent_shift_div within_weeks_div d-none ms-4">

                                <div class="form-check">
                                  <input @if($job_data->start_date_urgency_fixedterm == "within_two_week") checked @endif class="form-check-input within_weeks_radio" type="radio" name="within_weeks_radio" id="within_two_week" value="within_two_week">
                                  <label class="form-check-label" for="within_two_week">Within 2 weeks</label>
                                </div>

                                <div class="form-check">
                                  <input @if($job_data->start_date_urgency_fixedterm == "within_five_week") checked @endif class="form-check-input within_weeks_radio" type="radio" name="within_weeks_radio" id="within_five_week" value="within_five_week">
                                  <label class="form-check-label" for="within_five_week">Within 5 weeks</label>
                                </div>

                                <div class="form-check">
                                  <input @if($job_data->start_date_urgency_fixedterm == "within_seven_week") checked @endif class="form-check-input within_weeks_radio" type="radio" name="within_weeks_radio" id="within_seven_week" value="within_seven_week">
                                  <label class="form-check-label" for="within_seven_week">Within 7 weeks</label>
                                </div>

                              </div>

                              <div class="form-check">
                                <input class="form-check-input start_date_urgency" type="radio" name="start_date_urgency" id="urgency_scheduled" value="scheduled_date">
                                <label class="form-check-label" for="urgency_scheduled">
                                  Scheduled date
                                </label>
                              </div>
                              <span id='reqstart_date_urgency' class='reqError text-danger valley'></span>
                              <div class="permanent_shift_div form-group level-drp scheduled_date_field d-none">
                                
                                <input class="form-control scheduled_date" type="date" name="scheduled_date" value="{{ $job_data->start_date_urgency_fixedterm }}" id="scheduled_date">
                                <span id='reqscheduled_date' class='reqError text-danger valley'></span>
                              </div>
                            </div>
                            <div class="form-group">
                                <label>Contract length <span class="required">*</span></label>
                                @php
                                  $result = explode(" ", $job_data->fixed_term_contract_length);
                                @endphp
                                <div style="display:flex; gap:10px;">
                                    <input type="number" name="contract_length_value" value="{{ $result[0] }}" min="1" id="contract_length_value" placeholder="e.g. 6">
                                    <span id='reqcontract_length_value' class='reqError text-danger valley'></span>
                                    <select name="contract_length_unit" id="contract_length_unit">
                                        <option value="months" @if(isset($result[1]) && $result[1] == "months") selected @endif>Months</option>
                                        <option value="years" @if(isset($result[1]) && $result[1] == "years") selected @endif>Years</option>
                                    </select>
                                    <span id='reqcontract_length_unit' class='reqError text-danger valley'></span>
                                </div>
                            </div>
                          </div>
                        </div>
                        @endif
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitShiftScheduling">Save Changes</button>
                        </div>
                      </form>
    
    
                    </div>
    
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>


@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script src="{{ url('/public') }}/nurse/assets/js/jquery.ui.datepicker.monthyearpicker.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js">
</script>
<script>
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

    $('.js-example-basic-multiple').select2();

    // Dynamically add the clear button
    const clearButton = $('<span class="clear-btn">✖</span>');
    $('.select2-container').append(clearButton);

    // Handle the visibility of the clear button
    function toggleClearButton() {

        const selectedOptions = $('.js-example-basic-multiple').val();
        if (selectedOptions && selectedOptions.length > 0) {
            clearButton.show();
        } else {
            clearButton.hide();
        }
    }

    // Attach change event to select2
    $('.js-example-basic-multiple').on('change', toggleClearButton);

    // Clear button click event
    clearButton.click(function() {

        $('.js-example-basic-multiple').val(null).trigger('change');
        toggleClearButton();
    });

    // Initial check
    toggleClearButton();
    $('.js-example-basic-multiple').each(function() {
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

    function getOrdinalSuffix(i) {
      if (i % 100 >= 11 && i % 100 <= 13) {
          return 'th';
      }
      switch (i % 10) {
          case 0: return '';
          case 1: return 'st';
          case 2: return 'nd';
          case 3: return 'rd';
          default: return 'th';
      }
    }

    $('.js-example-basic-multiple[data-list-id="days_off_data"]').on('change', function() {
      let selectedValues = $(this).val();
      console.log("selectedValues",selectedValues);

      if(selectedValues.includes("61")){
        $(".specific_days_off_subdata").removeClass("d-none");
      }else{
        $(".specific_days_off_subdata").addClass("d-none");
      }
    });

    function getNurseType(level,k){
      //alert("hello");

      if(level == "main"){
        var selectedValues1 = $('.js-example-basic-multiple[data-list-id="type-of-nurse-'+k+'"]').val();
      }else{
        var selectedValues1 = $('.js-example-basic-multiple'+k+'[data-list-id="type-of-nurse-'+k+'"]').val();
      }
      
      

      let selectedValues = Array.isArray(selectedValues1) ? selectedValues1 : [selectedValues1];

      console.log("selectedValues",selectedValues1);


      $(".showNurseType-"+k+" .subnurse_list").each(function(i,val){
          var val1 = $(val).val();
          console.log("val",val1);
          if(selectedValues.includes(val1) == false){
            $(".showNurseType-" + k).find(".subnurse_main_div-" + val1).remove();
              
          }
      });
      
      $(".subspecnurse_list").each(function () {

          var val1 = $(this).val();
          console.log("selectedValues_status", selectedValues);
          console.log("val1_specStatus", val1);
          if(selectedValues.includes(val1) == false){

            
            $(".showNurseSpeciality-" + k)
            .find(".nurse_specialities-" + val1)
            .remove();
            
          }
      });

      for(var i=0;i<selectedValues.length;i++){
        if($(".showNurseType-"+k+" .subnurse_main_div-"+selectedValues[i]).length < 1){
          $.ajax({
            type: "GET",
            url: "{{ url('/nurse/getNurseDatas') }}",
            data: {nurse_id:selectedValues[i]},
            cache: false,
            success: function(data){
              var data1 = JSON.parse(data);
              console.log("data1",data1);

              var nurse_text = "";
              for(var j=0;j<data1.sub_nurse_data.length;j++){
                
                nurse_text += "<li data-value='"+data1.sub_nurse_data[j].id+"'>"+data1.sub_nurse_data[j].name+"</li>"; 
                
              }
              var sub = 'sub';
              var experience_text = "";
              for(var i=1;i<=30;i++){
                experience_text += "<option value='" + i + "'>" + i + getOrdinalSuffix(i) + " Year</option>";
              }

              if(data1.sub_nurse_data.length > 0){
                
                $(".showNurseType-"+k).append('\<div class="subnurse_main_div subnurse_main_div-'+data1.main_nurse_id+'">\
                              <div class="subnurse_div subnurse_div-'+data1.main_nurse_id+' form-group level-drp">\
                              <label class="form-label subnurse_label subnurse_label-'+data1.main_nurse_id+'" for="input-1">'+data1.main_nurse_name+'</label>\
                              <input type="hidden" name="subnurse_list" class="subnurse_list subnurse_list-'+data1.main_nurse_id+'" value="'+data1.main_nurse_id+'">\
                              <ul id="type-of-nurse-'+data1.main_nurse_id+'" style="display:none;">\
                              <li data-value="">select</li>\
                              '+nurse_text+'</ul>\
                              <select class="js-example-basic-multiple'+data1.main_nurse_id+' subnurse_valid-'+data1.main_nurse_id+' addAll_removeAll_btn" data-list-id="type-of-nurse-'+data1.main_nurse_id+'" name="subnursetype[]" onchange="getNurseType(\''+sub+'\',\''+data1.main_nurse_id+'\')"></select>\
                              <span id="reqsubnursevalid-'+data1.main_nurse_id+'" class="reqError text-danger valley"></span>\
                              </div>\
                              <div class="subnurse_level-'+data1.main_nurse_id+'"></div>\
                              <div class="showNurseType-'+data1.main_nurse_id+'"></div>\
                              <div class="showNurseSpeciality-'+data1.main_nurse_id+'"></div>\
                              </div>\
                              ');
                selectTwoFunction(data1.main_nurse_id);
                              
              }

              
              
            }
          });
        }
      }
    }

    function getSecialities(level,k,specialities_type,multiple){
      // alert();

      if(level == "main"){
        var selectedValues1 = $('.js-example-basic-multiple[data-list-id="speciality_preferences-'+specialities_type+"-"+k+'"]').val();
      }else{
        var selectedValues1 = $('.js-example-basic-multiple'+k+'[data-list-id="speciality_preferences-'+specialities_type+"-"+k+'"]').val();
      }


      
      let selectedValues = Array.isArray(selectedValues1) ? selectedValues1 : [selectedValues1];
    
      console.log("selectedValues",selectedValues1);

      $(".show_specialities-"+specialities_type+"-"+k+" .subspec_list-"+specialities_type).each(function(i,val){
          var val1 = $(val).val();
          console.log("subspec_listval",val1);
          if(selectedValues.includes(val1) == false){
            $(".subspec_main_div-"+val1).remove();
              
          }
      });

      $(".subspecprofpart_list-"+specialities_type+"-"+k).each(function () {
            
          var val1 = $(this).val();
          console.log("selectedValues_status", selectedValues);
          console.log("val1_specStatus", val1);
          if(selectedValues.includes(val1) == false){

            
            $(".subexper_div-"+val1).remove();
            
          }
      });

      for(var i=0;i<selectedValues.length;i++){
        
        if($(".show_specialities-"+specialities_type+"-"+k+" .subspec_main_div-"+selectedValues[i]).length < 1){
          
          $.ajax({
            type: "GET",
            url: "{{ url('/nurse/getSpecialityDatas1') }}",
            data: {speciality_id:selectedValues[i]},
            cache: false,
            success: function(data){
              var data1 = JSON.parse(data);
              console.log("data1",data1);

              var speciality_text = "";
              for(var j=0;j<data1.sub_spciality_data.length;j++){
                
                speciality_text += "<li data-value='"+data1.sub_spciality_data[j].id+"'>"+data1.sub_spciality_data[j].name+"</li>"; 
                
              }

              
              
              var sub = 'sub';

              if(specialities_type == "primary"){
                var name = "subspeciality";
              }else{
                var name = "speciality["+data1.main_speciality_id+"][]";
              }


              if(data1.sub_spciality_data.length > 0){
                $(".show_specialities-"+specialities_type+"-"+k).append('\<div class="subspec_main_div subspec_main_div-'+data1.main_speciality_id+'">\
                              <div class="subspec_div subspec_div-'+data1.main_speciality_id+' form-group level-drp">\
                              <label class="form-label subspec_label subspec_label-'+data1.main_speciality_id+'" for="input-1">'+data1.main_speciality_name+'</label>\
                              <input type="hidden" name="subspec_list" class="subspec_list-'+specialities_type+' subspec_list-'+specialities_type+"-"+data1.main_speciality_id+'" value="'+data1.main_speciality_id+'">\
                              <ul id="speciality_preferences-'+specialities_type+"-"+data1.main_speciality_id+'" style="display:none;">\
                              <li data-value="">select</li>\
                              '+speciality_text+'</ul>\
                              <select class="js-example-basic-multiple'+data1.main_speciality_id+' subspec_valid-'+data1.main_speciality_id+' addAll_removeAll_btn" name="subspeciality['+specialities_type+']['+data1.main_speciality_id+'][]" data-list-id="speciality_preferences-'+specialities_type+"-"+data1.main_speciality_id+'" onchange="getSecialities(\''+sub+'\',\''+data1.main_speciality_id+'\',\''+specialities_type+'\',\''+multiple+'\')" '+multiple+'></select>\
                              <span id="reqsubspecvalid-'+data1.main_speciality_id+'" class="reqError text-danger valley"></span>\
                              </div>\
                              <div class="subspec_level-'+data1.main_speciality_id+'"></div>\
                              <div class="show_specialities-'+specialities_type+"-"+data1.main_speciality_id+'"></div>\
                              <div class="show_specialities_experience-'+specialities_type+"-"+data1.main_speciality_id+'"></div>\
                              </div>');

                              selectTwoFunction(data1.main_speciality_id);
              
              }else{

                var experience_text = "";
                for(var i=0;i<=30;i++){
                  experience_text += "<option value='" + i + "'>" + i + getOrdinalSuffix(i) + " Year</option>";
                }

                if ($(".subexper_div-" + data1.main_speciality_id).length === 0 && specialities_type == "primary") {

                  $(".show_specialities_experience-"+specialities_type+"-"+k).append('\<div class="subexper_div subexper_div-'+data1.main_speciality_id+'">\
                  <div class="custom-select-wrapper form-group level-drp">\
                    <label class="form-label" for="input-1">Minimum Specialty Experience\
                    </label>\
                    <input type="hidden" name="subspecprof_list" class="subspecprof_list subspecprofpart_list-'+specialities_type+"-"+k+' subspecprof_listProfession subspecprof_listProfession-'+data1.main_speciality_id+' subspecprof_list-'+k+'" value="'+data1.main_speciality_id+'">\
                    <select class="custom-select experience_level-'+data1.main_speciality_id+'" name="speciality_experience">\
                      <option value="">Please Select</option>\
                      '+experience_text+'\
                    </select>\
                    <span id="reqassistentlevel'+data1.main_speciality_id+'" class="reqError text-danger valley"></span>\
                    <div class="experience_helper">Set 0 for Graduate or Transition roles.Tick “Willing to upskill” if you’ll consider near-fit candidates.</div>\
                  </div>\
                </div>');

                }

              }

              
            }
          });
        }
      }
    }

    function getWpData(ap, k){
        if(ap == 'ap'){
            var selectedValues = $('.js-example-basic-multiple'+k+'[data-list-id="wp_data-'+k+'"]').val();
        }else{
            var selectedValues = $('.js-example-basic-multiple[data-list-id="wp_data-'+k+'"]').val();
        }

        console.log("selectedValueswp",selectedValues);

        $(".wp_data-"+k+" .subwork_list").each(function(i,val){
            var val1 = $(val).val();
            console.log("val",val1);
            if(selectedValues.includes(val1) == false){
                $(".wp_main_div-"+val1).remove();
                
            }
        });

        for(var i=0;i<selectedValues.length;i++){
            if($(".wp_data-"+k+" .wp_main_div-"+selectedValues[i]).length < 1 && selectedValues[i] != "444"){
                $.ajax({
                    type: "GET",
                    url: "{{ url('/healthcare-facilities/getWorkplaceData') }}",
                    data: {place_id:selectedValues[i]},
                    cache: false,
                    success: function(data){
                        var data1 = JSON.parse(data);
                        console.log("data1",data1);

                        var wp_text = "";
                        for(var j=0;j<data1.work_data.length;j++){
                        
                            wp_text += "<li data-value='"+data1.work_data[j].prefer_id+"'>"+data1.work_data[j].env_name+"</li>"; 
                        
                        }

                        $('.js-example-basic-multiple[data-list-id="wp_data-1"]').removeAttr("name");
                        
                        var ap = "ap";
                        $(".wp_data-"+k).append('\<div class="wp_main_div wp_main_div-'+data1.prefer_id+'"><div class="subworkdiv subworkdiv-'+data1.prefer_id+' form-group level-drp">\
                            <label class="form-label work_label work_label-'+k+data1.prefer_id+'" for="input-1">'+data1.env_name+'</label>\
                            <input type="hidden" name="subwork" class="subwork subwork-'+data1.prefer_id+'" value="'+k+'">\
                            <input type="hidden" name="subwork_list" class="subwork_list subwork_list-'+k+'" value="'+data1.prefer_id+'">\
                            <ul id="subwork_field-'+k+data1.prefer_id+'" style="display:none;">'+wp_text+'</ul>\
                            <select class="js-example-basic-multiple'+k+data1.prefer_id+' addAll_removeAll_btn work_valid-'+k+' work_valid-'+k+data1.prefer_id+'" data-list-id="subwork_field-'+k+data1.prefer_id+'" name="subworkthlevel['+k+']['+data1.prefer_id+'][]" onchange="getWpSubData(\''+ap+'\',\''+k+'\',\''+data1.prefer_id+'\')" multiple></select>\
                            <span id="reqsubwork-'+k+data1.prefer_id+'" class="reqError text-danger valley"></span>\
                            </div><div class="showsubwpdata showsubwpdata-'+k+data1.prefer_id+'"></div></div>');

                            let $fields = $(".wp_data-"+k+" .wp_main_div");

                            let sortedFields = $fields.sort(function (a, b) {
                                return $(a).find(".work_label").text().localeCompare($(b).find(".work_label").text());
                            });

                            $(".wp_data-"+k).append(sortedFields);
                        
                        selectTwoFunction(k+data1.prefer_id);
                    }    
                });            
            }
        }
    }

    $(document).on('change', 'input[name="shift_mode"]', function () {
        let value = $(this).val();
        console.log(value); // single OR range
        if(value == 'single'){
          $(".temporary_shift_details").addClass('d-none');
          $(".single_shift_content").removeClass('d-none');
        }else{
          if(value == 'range'){
            $(".temporary_shift_details").addClass('d-none');
            $(".date_range_content").removeClass('d-none');
          }
        }
    });

    $(document).on('change', 'input[name="start_date_urgency"]', function () {
        let value = $(this).val();
        console.log(value); // single OR range
        if(value == 'within_weeks'){
          $(".permanent_shift_div").addClass('d-none');
          $(".within_weeks_div").removeClass('d-none');
          
        }else{
          if(value == 'scheduled_date'){
            $(".permanent_shift_div").addClass('d-none');
            $(".scheduled_date_field").removeClass('d-none');
          }else{
            if(value == 'immediate'){
              $(".permanent_shift_div").addClass('d-none');
              
            }
            
          }
          
        }
    });

    

    function empType(value){
        $(".emp_type_fields").addClass('d-none');
        let emp_type = $('.js-example-basic-multiple[data-list-id="mainemptype_field"]').val();
        //alert(value);
        console.log("emp_type",emp_type);
        
        $(".emp_data .subrefer_list").each(function(i,val){
            var val1 = $(val).val();
            console.log("val",val1);
            if(emp_type.includes(val1) == false){
                $(".emptype_main_div-"+val1).remove();
                
            }
        });
        for(var i=0;i<emp_type.length;i++){

          if($(".emp_data .emptype_main_div-"+emp_type[i]).length < 1){
            $.ajax({
              type: "GET",
              url: "{{ url('/healthcare-facilities/getEmpData') }}",
              data: {sub_prefer_id:emp_type[i]},
              cache: false,
              success: function(data){
                  const emp_prefer_data = JSON.parse(data);
                  console.log("emp_prefer_data",emp_prefer_data);

                  var emp_text = "";
                  for(var j=0;j<emp_prefer_data.employeement_type_preferences.length;j++){
                  
                      emp_text += "<li data-value='"+emp_prefer_data.employeement_type_preferences[j].emp_prefer_id+"'>"+emp_prefer_data.employeement_type_preferences[j].emp_type+"</li>"; 
                  
                  }
                  
                  $(".emp_data").append('\<div class="emptype_main_div emptype_main_div-'+emp_prefer_data.employeement_type_id+'"><div class="emptypediv emptypediv-'+emp_prefer_data.employeement_type_id+' form-group level-drp">\
                      <label class="form-label emptype_label emptype_label-'+emp_prefer_data.employeement_type_id+'" for="input-1">'+emp_prefer_data.employeement_type_name+'</label>\
                      <input type="hidden" name="subrefer_list" class="subrefer_list" value="'+emp_prefer_data.employeement_type_id+'">\
                      <ul id="emptype_field-'+emp_prefer_data.employeement_type_id+'" style="display:none;">\
                      <li data-value="0">select</li>\
                      '+emp_text+'</ul>\
                      <select class="js-example-basic-multiple'+emp_prefer_data.employeement_type_id+' addAll_removeAll_btn emptype_valid-1" data-list-id="emptype_field-'+emp_prefer_data.employeement_type_id+'" name="subemptype" onchange="open_emp_type('+value+')"></select>\
                      <span id="reqemptype-1" class="reqError text-danger valley"></span>\
                      </div></div>');

                      
                  
                  selectTwoFunction(emp_prefer_data.employeement_type_id);
              }
              
          });
        }
        }
    }

    function open_emp_type(value){
        if(value == 1){
            $(".emp_type_fields").addClass('d-none');
            $(".permanent_fields").removeClass('d-none');
        }else{
            if(value == 2){
                $(".emp_type_fields").addClass('d-none');
                $(".fixed_term_fields").removeClass('d-none');
            }else{
                if(value == 3){
                    $(".emp_type_fields").addClass('d-none');
                    $(".temporary_fields").removeClass('d-none');
                }
            }
        }
    }

    

    function getWpSubData(ap,k,l){
        $('#submitContractPay').prop('disabled', true);
        if(ap == 'ap'){
            var selectedValues = $('.js-example-basic-multiple'+k+l+'[data-list-id="subwork_field-'+k+l+'"]').val();
        }else{
            var selectedValues = $('.js-example-basic-multiple[data-list-id="subwork_field-'+k+l+'"]').val();
        }

        console.log("selectedValues",selectedValues);

        $(".showsubwpdata-"+k+l+" .subpwork_list").each(function(i,val){
            var val1 = $(val).val();
            console.log("val",val1);
            if(selectedValues.includes(val1) == false){
                $(".subpworkdiv-"+val1).remove();
                
            }
        });

        var ne_st = k.toString() + l.toString();
        
        if($.trim($(".showsubwpdata-"+ne_st).html()) != ''){
           $('.js-example-basic-multiple[data-list-id="subwork_field-'+k+l+'"]').removeAttr("name");
        }

        for(var i=0;i<selectedValues.length;i++){
            if($(".showsubwpdata-"+k+l+" .subpworkdiv-"+selectedValues[i]).length < 1){
                $.ajax({
                    type: "GET",
                    url: "{{ url('/healthcare-facilities/getSubWorkplaceData') }}",
                    data: {place_id:l,subplace_id:selectedValues[i]},
                    cache: false,
                    success: function(data){
                        var data1 = JSON.parse(data);
                        console.log("data1",data1);
                        
                            
                        if(data1.work_data.length > 0){
                            var wp_text = "";
                            for(var j=0;j<data1.work_data.length;j++){
                            
                                wp_text += "<li data-value='"+data1.work_data[j].prefer_id+"'>"+data1.work_data[j].env_name+"</li>"; 
                            
                            }
                            
                            $('.js-example-basic-multiple'+k+l+'[data-list-id="subwork_field-'+k+l+'"]').removeAttr("name");
                            
                            
                            var ap = "";
                            $(".showsubwpdata-"+k+l).append('\<div class="subpworkdiv subpworkdiv-'+data1.subplace_id+' form-group level-drp">\
                                <label class="form-label pwork_label pwork_label-'+k+data1.subplace_id+'" for="input-1">'+data1.env_name+'</label>\
                                <input type="hidden" name="subpwork" class="subpwork subpwork-'+data1.subplace_id+'" value="'+k+'">\
                                <input type="hidden" name="subpwork_list" class="subpwork_list subpwork_list-'+k+'" value="'+data1.subplace_id+'">\
                                <ul id="subpwork_field-'+k+data1.subplace_id+'" style="display:none;">'+wp_text+'</ul>\
                                <select class="js-example-basic-multiple'+k+data1.subplace_id+' addAll_removeAll_btn pwork_valid-'+k+' pwork_valid-'+k+data1.subplace_id+'" data-list-id="subpwork_field-'+k+data1.subplace_id+'" name="subworkthlevel['+k+']['+l+']['+data1.subplace_id+'][]" multiple></select>\
                                <span id="reqsubpwork-'+k+data1.subplace_id+'" class="reqError text-danger valley"></span>\
                            </div>');

                            let $fields = $(".showsubwpdata-"+k+l+" .subpworkdiv");

                            let sortedFields = $fields.sort(function (a, b) {
                                return $(a).find(".pwork_label").text().localeCompare($(b).find(".pwork_label").text());
                            });

                            $(".showsubwpdata-"+k+l).append(sortedFields);

                            selectTwoFunction(k+data1.subplace_id);

                            $('#submitContractPay').prop('disabled', false);
                        }
                    }    
                });            
            }
        }
    }
    
    function selectTwoFunction(select_id) {

      let $select = $('.js-example-basic-multiple' + select_id);

      // === 1️⃣ Initialize ONLY if not already initialized ===
      if ($select.data('select2')) {
          return; // VERY IMPORTANT: stops re-init
      }

      // === 2️⃣ Load options from UL (clone per dropdown) ===
      let listId = $select.data('list-id');
      let items = [];

      $('#' + listId + ' li').each(function() {
          items.push({
              id: $(this).data('value'),
              text: $(this).text()
          });
      });

      // === 3️⃣ Initialize Select2 (ONLY ON THIS DROPDOWN) ===
      $select.select2({
          data: items,
          width: '100%',
          closeOnSelect: true
      });

      // === 4️⃣ Add Select All / Remove All buttons (SCOPED) ===
      $select.on('select2:open', function() {
          let $dropdown = $(this);

          let buttons = `
          <div class="extra-buttons">
              <button class="select-all-button" type="button">Select All</button>
              <button class="remove-all-button" type="button">Remove All</button>
          </div>
          `;

          $('.select2-results .extra-buttons').remove();
          $('.select2-results').prepend(buttons);

          $('.select-all-button').off('click').on('click', function() {
              let allValues = $dropdown.find('option').map(function() {
                  return $(this).val();
              }).get();
              $dropdown.val(allValues).trigger('change');
          });

          $('.remove-all-button').off('click').on('click', function() {
              $dropdown.val(null).trigger('change');
          });
      });

      // === 5️⃣ Add search box (SCOPED) ===
      $select.on('select2:open', function() {

          let searchBoxHtml = `
          <div class="extra-search-container">
              <input type="text" class="extra-search-box" placeholder="Search...">
              <button class="clear-button" type="button">&times;</button>
          </div>
          `;

          if ($('.select2-results').find('.extra-search-container').length === 0) {
              $('.select2-results').prepend(searchBoxHtml);
          }

          $('.extra-search-box').off('input').on('input', function() {
              let searchTerm = $(this).val().toLowerCase();

              $('.select2-results__option').each(function() {
                  let text = $(this).text().toLowerCase();
                  $(this).toggle(text.includes(searchTerm));
              });
          });

          $('.clear-button').off('click').on('click', function() {
              $('.extra-search-box').val('').trigger('input');
          });
      });

      // === 6️⃣ Clear button PER DROPDOWN (not global) ===
      let clearButton = $('<span class="clear-btn">✖</span>');
      $select.next('.select2').append(clearButton);

      function toggleClearButton() {
          let val = $select.val();
          clearButton.toggle(!!(val && val.length));
      }

      $select.on('change', toggleClearButton);
      clearButton.on('click', function() {
          $select.val(null).trigger('change');
          toggleClearButton();
      });

      toggleClearButton();
    }

    function shift_scheduling_form() {
      var isValid = true;

      if ($('[name="shift_types_data[]"]').val() == '') {
        //alert("hello");
        document.getElementById("reqshift_types_data").innerHTML = "* Please select the Shift Types";
        isValid = false;

      }

      if ($('[name="schedule_model_data[]"]').val() == '0') {
        //alert("hello");
        document.getElementById("reqschedule_model_data").innerHTML = "* Please select the Schedule Model";
        isValid = false;

      }

      if($(".main_emp_type").val() == 2){
        if ($('[name="start_date_urgency"]:checked').length === 0) {
          //alert("hello");
          document.getElementById("reqstart_date_urgency").innerHTML = "* Please select the Start Date & Urgency";
          isValid = false;

        }

        if ($('[name="contract_length_value"]').val() === '') {
          //alert("hello");
          document.getElementById("reqcontract_length_value").innerHTML = "* Please select the Contract length";
          isValid = false;

        }
      }

      if($(".main_emp_type").val() == 1){
        if ($('[name="start_date_urgency"]:checked').length === 0) {
          //alert("hello");
          document.getElementById("reqstart_date_urgency").innerHTML = "* Please select the Start Date & Urgency";
          isValid = false;

        }

        if ($('[name="start_date_urgency"]:checked').val() === 'scheduled_date') {

          if ($('[name="scheduled_date"]').val() === '') {
              $("#reqscheduled_date").text("* Please enter the Scheduled date");
              isValid = false;
          } else {
              $("#reqscheduled_date").text("");
          }

        }


      }

      
      if($(".main_emp_type").val() == 3){
        if ($('[name="shift_mode"]:checked').length === 0) {
          //alert("hello");
          document.getElementById("reqshift_mode").innerHTML = "* Please select the Shift Mode";
          isValid = false;

        }

        if ($('[name="shift_mode"]:checked').val() === 'single') {
          if ($('[name="temporarysingle_start_date"]').val() === '') {
            //alert("hello");
            document.getElementById("reqtemporarysingle_start_date").innerHTML = "* Please select the Start date & time";
            isValid = false;

          }

          if ($('[name="temporarysingle_end_date"]').val() === '') {
            //alert("hello");
            document.getElementById("reqtemporarysingle_end_date").innerHTML = "* Please select the End date & time";
            isValid = false;

          }
        }

        if ($('[name="shift_mode"]:checked').val() === 'range') {
          if ($('[name="temporaryrangestart_date"]').val() === '') {
            //alert("hello");
            document.getElementById("reqtemporaryrangestart_date").innerHTML = "* Please enter the Start date";
            isValid = false;

          }

          if ($('[name="temporaryrangeend_date"]').val() === '') {
            //alert("hello");
            document.getElementById("reqtemporaryrangeend_date").innerHTML = "* Please enter the End date";
            isValid = false;

          }

          if ($('[name="temporaryrangenoshifts"]').val() === '') {
            //alert("hello");
            document.getElementById("reqtemporaryrangenoshifts").innerHTML = "* Please enter the number of shifts";
            isValid = false;

          }

          if ($('[name="temporaryrangenotes"]').val() === '') {
            //alert("hello");
            document.getElementById("reqtemporaryrangenotes").innerHTML = "* Please enter the notes";
            isValid = false;

          }
        }
      }
      

      

      if (isValid == true) {
        $.ajax({
        url: "{{ route('medical-facilities.updateShiftScheduling') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#shift_scheduling_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitShiftScheduling').prop('disabled', true);
          $('#submitShiftScheduling').text('Process....');
        },
        success: function(res) {
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Shifts & Scheduling form added Successfully',
            }).then(function() {
              const jobId = params.get("job_id");

              if(jobId){
                window.location.href = "{{ route('medical-facilities.shift_scheduling') }}?job_id="+jobId;
                
              }else{
                window.location.href = "{{ route('medical-facilities.shift_scheduling') }}";
              }
              
              
              var tab_name = sessionStorage.getItem("tab-one");
              if(tab_name != "job_description"){
                sessionStorage.setItem("tab-one","shift_scheduling");
              }
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
          $('#submitShiftScheduling').prop('disabled', false);
          $('#submitShiftScheduling').text('Save Changes');
          console.log("errorss", errorss);
          
        }
      
        });
      }

      return false;
    }  

    if ($(".shift_types_field").val() != "") {
      var shift_types_field = JSON.parse($(".shift_types_field").val());
      console.log("shift_types_field", shift_types_field);
      $('.js-example-basic-multiple[data-list-id="shift_types_data"]').select2().val(shift_types_field).trigger('change');
    }

    if ($(".shift_length_field").val() != "") {
      var shift_length_field = JSON.parse($(".shift_length_field").val());
      $('.js-example-basic-multiple[data-list-id="shift_length_data"]').select2().val(shift_length_field).trigger('change');
    }

    if ($(".schedule_model").val() != "") {
      var schedule_model = JSON.parse($(".schedule_model").val());
      $('.js-example-basic-multiple[data-list-id="schedule_model_data"]').select2().val(schedule_model).trigger('change');
    }

    if ($(".weekly_work_patterns").val() != "") {
      var weekly_work_patterns = JSON.parse($(".weekly_work_patterns").val());
      $('.js-example-basic-multiple[data-list-id="weekly_work_patters"]').select2().val(weekly_work_patterns).trigger('change');
    }

    if ($(".shift_rotation").val() != "") {
      var shift_rotation = JSON.parse($(".shift_rotation").val());
      $('.js-example-basic-multiple[data-list-id="shift_rotation_data"]').select2().val(shift_rotation).trigger('change');
    }

    if ($(".non_trad_shift").val() != "") {
      var non_trad_shift = JSON.parse($(".non_trad_shift").val());
      $('.js-example-basic-multiple[data-list-id="non_trad_shift"]').select2().val(non_trad_shift).trigger('change');
    }

    if ($(".maternity_shift").val() != "") {
      var maternity_shift = JSON.parse($(".maternity_shift").val());
      $('.js-example-basic-multiple[data-list-id="maternity_shift"]').select2().val(maternity_shift).trigger('change');
    }

    if ($(".days_off").val() != "") {
      var days_off = JSON.parse($(".days_off").val());
      $('.js-example-basic-multiple[data-list-id="days_off_data"]').select2().val(days_off).trigger('change');
    }

    if ($(".perticular_days_off").val() != "") {
      var perticular_days_off = JSON.parse($(".perticular_days_off").val());
      $('.js-example-basic-multiple[data-list-id="specific_days_off_subdata"]').select2().val(perticular_days_off).trigger('change');
    }

    if ($(".specific_days_off").val() != "") {
      var specific_days_off = JSON.parse($(".specific_days_off").val());
      $('.js-example-basic-multiple[data-list-id="specific_days_off_data"]').select2().val(specific_days_off).trigger('change');
    }
    var schedule_date = $("#scheduled_date").val();
    if(schedule_date !=""){
      $('.scheduled_date_field').removeClass('d-none');
      $('#urgency_scheduled').prop('checked', true);
    }

    if ($('#urgency_within_weeks').is(':checked')) {
        $('.within_weeks_div').removeClass('d-none');
    }

    var temporarysingle_start_date = $(".temporarysingle_start_date").val();
    var temporarysingle_end_date = $(".temporarysingle_end_date").val();

    if (temporarysingle_start_date != "" && temporarysingle_end_date != "") {
      $('.single_shift_content').removeClass('d-none');
      $('input[name="shift_mode"][value="single"]').prop('checked', true);
    }

    var temporaryrangestart_date = $(".temporaryrangestart_date").val();
    var temporaryrangeend_date = $(".temporaryrangeend_date").val();

    if (temporaryrangestart_date != "" && temporaryrangeend_date != "") {
      $('.date_range_content').removeClass('d-none');
      $('input[name="shift_mode"][value="range"]').prop('checked', true);
    }
  </script>
@endsection