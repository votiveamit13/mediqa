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

form#job_posting_form ul.select2-selection__rendered {
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
                      <h3 class="mt-0 color-brand-1 mb-2">Contract & Pay</h3>
    
                      <form id="contract_pay_form" method="POST" onsubmit="return contract_pay_form()">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::guard('healthcare_facilities')->user()->id }}">
                        <input type="hidden" name="job_id" value="{{ $job_id }}">
                        <div class="emptypediv form-group level-drp">
                            <label class="form-label emptype_label" for="input-1">Employment type</label>
                            <input type="hidden" name="emptypemain" class="emptypemain" value="@if(!empty($job_data) && $job_data->main_emp_type != NULL){{ json_encode((string)$job_data->main_emp_type) }}@endif">
                            <ul id="mainemptype_field" style="display:none;">
                                @if(!empty($employeement_type_preferences))
                                <li data-value="0">select</li>
                                @foreach($employeement_type_preferences as $emptype_data)
                                <li data-value="{{ $emptype_data->emp_prefer_id }}">{{ $emptype_data->emp_type }}</li>  
                                @endforeach
                                @endif
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn emptype_valid-1" id="mainemptype_fields" data-list-id="mainemptype_field" name="emptype_preferences" onchange="empType(this.value)"></select>
                            <span id="reqemptype_prefer" class="reqError text-danger valley"></span>
                        </div>
                        <div class="emp_data">
                          @if(!empty($job_data) && $job_data->main_emp_type != NULL)
                          @php
                            $sumemptype = (array)json_decode($job_data->emplyeement_type);
                            $emp_data_id = isset($sumemptype[0])?($sumemptype[0]):0;

                            $emp_type_list = DB::table("employeement_type_preferences")->where("sub_prefer_id",$job_data->main_emp_type)->get();
                            $emp_type_name = DB::table("employeement_type_preferences")->where("emp_prefer_id",$job_data->main_emp_type)->first();
                          @endphp
                          <div class="emptype_main_div emptype_main_div-{{ $job_data->main_emp_type }}">
                            <div class="emptypediv emptypediv-{{ $job_data->main_emp_type }} form-group level-drp">
                              <label class="form-label emptype_label emptype_label-{{ $job_data->main_emp_type }}" for="input-1">{{ $emp_type_name->emp_type }}</label>
                              <input type="hidden" name="emptypesub" class="emptypesub" value="{{ $job_data->emplyeement_type }}">
                              <input type="hidden" name="subrefer_list" class="subrefer_list" value="{{ $job_data->main_emp_type }}">
                              <ul id="emptype_field-{{ $job_data->main_emp_type }}" style="display:none;">
                              @if(!empty($emp_type_list))
                                <li data-value="0">select</li>
                                @foreach($emp_type_list as $emptype_data)
                                <li data-value="{{ $emptype_data->emp_prefer_id }}">{{ $emptype_data->emp_type }}</li>  
                                @endforeach
                                @endif

                              </ul>
                              <select class="js-example-basic-multiple addAll_removeAll_btn emptype_valid-1" data-list-id="emptype_field-{{ $job_data->main_emp_type }}" id="subemptypefield" name="subemptype" onchange="open_emp_type({{ $job_data->main_emp_type }})"></select>
                              <span id="reqsubemptype" class="reqError text-danger valley"></span>
                            </div>
                          </div>
                          @endif
                        </div>
                        <div class="emp_type_fields permanent_fields @if(!empty($job_data->main_emp_type != 1)) d-none @endif">
                            <div class="form-group level-drp">
                                <label class="form-label" for="input-1">Hours per week
                                </label>
                                <input class="form-control per_hours_per_week" type="number" name="per_hours_week" id="per_hours_week" value="{{ $job_data->hours_per_week_permanent }}">
                                <span id='reqhoursweek' class='reqError text-danger valley'></span>
                            </div>
                            <div class="form-group level-drp">
                                <label class="form-label" for="input-1">Salary format
                                </label>
                                <select class="form-input mr-10 select-active" name="per_salary_format" id="per_salary_format">
                                    <option value="">select</option>
                                    <option value="Annual salary" @if($job_data->salary_permanent == "Annual salary") selected @endif>Annual salary</option>
                                    <option value="Annual salary range" @if($job_data->salary_permanent == "Annual salary range") selected @endif>Annual salary range</option>
                                    
                                </select>
                                <span id='reqper_salary_format' class='reqError text-danger valley'></span>
                            </div>
                            <div class="row">
                                <div class="form-group level-drp col-md-6">
                                    <label class="form-label" for="input-1">Salary(min)
                                    </label>
                                    <input class="form-control per_salary_min" type="number" name="per_salary_min" id="per_salary_min" value="{{ $job_data->per_salary_min }}">
                                    <span id='reqper_salary_min' class='reqError text-danger valley'></span>
                                </div>
                                <div class="form-group level-drp col-md-6">
                                    <label class="form-label" for="input-1">Salary(max)
                                    </label>
                                    <input class="form-control per_salary_max" type="number" name="per_salary_max" id="per_salary_max" value="{{ $job_data->per_salary_max }}">
                                    <span id='reqper_salary_max' class='reqError text-danger valley'></span>
                                </div>
                            </div>
                        </div>
                        <div class="emp_type_fields fixed_term_fields d-none">
                            <div class="form-group">
                                <label>Contract length <span class="required">*</span></label>
                                <div style="display:flex; gap:10px;">
                                    <input type="number" name="contract_length_value" min="1" id="contract_length_value" placeholder="e.g. 6" value="{{ $job_data->contract_length_fixed_term }}">
                                    <span id='reqcontract_length_value' class='reqError text-danger valley'></span>
                                    <select name="contract_length_unit" id="contract_length_unit">
                                        <option value="months" @if($job_data->contract_length_unit_fixed_term == 'months') selected @endif>Months</option>
                                        <option value="years" @if($job_data->contract_length_unit_fixed_term == 'years') selected @endif>Years</option>
                                    </select>
                                    <span id='reqcontract_length_unit' class='reqError text-danger valley'></span>
                                </div>
                            </div>
                            <div class="form-group level-drp">
                                <label class="form-label" for="input-1">Hours per week
                                </label>
                                <input class="form-control fixed_term_hours_per_week" id="fixed_term_hours_week" type="text" name="fixed_term_hours_week" value="{{ $job_data->hours_per_week_fixed_term }}">
                                <span id='reqfixed_term_hours_week' class='reqError text-danger valley'></span>
                            </div>
                            <div class="form-group level-drp">
                                <label class="form-label" for="input-1">Salary format
                                </label>
                                <select class="form-input mr-10 select-active" name="fixed_term_salary_format" id="fixed_term_salary_format">
                                    <option value="">select</option>
                                    <option value="Annual" @if($job_data->salary_range_fix_term == 'Annual') selected @endif>Annual</option>
                                    <option value="Weekly" @if($job_data->salary_range_fix_term == 'Weekly') selected @endif>Weekly</option>
                                    <option value="Hourly" @if($job_data->salary_range_fix_term == 'Hourly') selected @endif>Hourly</option>
                                </select>
                                <span id='reqfixed_term_salary_format' class='reqError text-danger valley'></span>
                            </div>
                            <div class="row">
                                <div class="form-group level-drp col-md-6">
                                    <label class="form-label" for="input-1">Salary(min)
                                    </label>
                                    <input class="form-control fixed_term_salary_min" type="text" name="fixed_term_salary_min" id="fixed_term_salary_min" value="{{ $job_data->fixed_term_salary_min }}">
                                    <span id='reqfixed_term_salary_min' class='reqError text-danger valley'></span>
                                </div>
                                <div class="form-group level-drp col-md-6">
                                    <label class="form-label" for="input-1">Salary(max)
                                    </label>
                                    <input class="form-control per_salary_max" type="text" name="fixed_term_salary_max" id="fixed_term_salary_max" value="{{ $job_data->fixed_term_salary_max }}">
                                    <span id='reqfixed_term_salary_max' class='reqError text-danger valley'></span>
                                </div>
                            </div>
                        </div>
                        <div class="emp_type_fields temporary_fields d-none">
                            
                            <div class="form-group level-drp">
                                <label class="form-label" for="input-1">Shift dates & times
                                </label>
                                <input class="form-control temporary_hours_per_week" type="datetime-local" name="temporary_hours_week" value="{{ $job_data->shift_date_time_temporary }}" id="temporary_hours_week">
                                <span id='reqtemporary_hours_per_week' class='reqError text-danger valley'></span>
                            </div>
                            <div class="form-group level-drp">
                                <label class="form-label" for="input-1">Salary format
                                </label>
                                <select class="form-input mr-10 select-active" name="temporary_salary_format" id="temporary_salary_format">
                                    <option value="">select</option>
                                    <option value="Hourly" @if($job_data->salary_range_temporary == 'Hourly') selected @endif>Hourly (recommended)</option>
                                    <option value="Weekly" @if($job_data->salary_range_temporary == 'Weekly') selected @endif>Weekly</option>
                                    
                                </select>
                                <span id='reqtemporary_salary_format' class='reqError text-danger valley'></span>
                            </div>
                            <div class="row">
                                <div class="form-group level-drp col-md-6">
                                    <label class="form-label" for="input-1">Salary(min)
                                    </label>
                                    <input class="form-control temporary_salary_min" type="text" name="temporary_salary_min" value="{{ $job_data->temporary_salary_min }}" id="temporary_salary_min">
                                    <span id='reqtemporary_salary_min' class='reqError text-danger valley'></span>
                                </div>
                                <div class="form-group level-drp col-md-6">
                                    <label class="form-label" for="input-1">Salary(max)
                                    </label>
                                    <input class="form-control temporary_salary_max" type="text" name="temporary_salary_max" value="{{ $job_data->temporary_salary_max }}" id="temporary_salary_max">
                                    <span id='reqtemporary_salary_max' class='reqError text-danger valley'></span>
                                </div>
                            </div>
                        </div>
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitContractPay">Save Changes</button>
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
                      <select class="js-example-basic-multiple'+emp_prefer_data.employeement_type_id+' addAll_removeAll_btn emptype_valid-1" data-list-id="emptype_field-'+emp_prefer_data.employeement_type_id+'" id="subemptypefield" name="subemptype" onchange="open_emp_type('+value+')"></select>\
                      <span id="reqsubemptype" class="reqError text-danger valley"></span>\
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

    function contract_pay_form() {
      var isValid = true;

      if ($('#mainemptype_fields').val() == '0') {

        document.getElementById("reqemptype_prefer").innerHTML = "* Please enter the Employment type";
        isValid = false;

      }

      if ($('#subemptypefield').val() == '0') {

        document.getElementById("reqsubemptype").innerHTML = "* Please enter the Employment type";
        isValid = false;

      }

      var mainempfield = $('#mainemptype_fields').val();
      

      if(mainempfield == "1"){
        if ($('#per_hours_week').val() == '') {

          document.getElementById("reqhoursweek").innerHTML = "* Please enter the Hours per week";
          isValid = false;

        }

        

        if ($('#per_salary_format').val() == '') {

          document.getElementById("reqper_salary_format").innerHTML = "* Please select the Salary format";
          isValid = false;

        }

        if ($('#per_salary_min').val() == '') {

          document.getElementById("reqper_salary_min").innerHTML = "* Please enter the minimum salary";
          isValid = false;

        }

        if ($('#per_salary_max').val() == '') {

          document.getElementById("reqper_salary_max").innerHTML = "* Please enter the maximum salary";
          isValid = false;

        }
      }

      if(mainempfield == "2"){
        if ($('#contract_length_value').val() == '') {

          document.getElementById("reqcontract_length_value").innerHTML = "* Please enter the Contract length";
          isValid = false;

        }

        if ($('#contract_length_unit').val() == '') {

          document.getElementById("reqcontract_length_unit").innerHTML = "* Please select the contract length unit";
          isValid = false;

        }

        if ($('#fixed_term_hours_week').val() == '') {

          document.getElementById("reqfixed_term_hours_week").innerHTML = "* Please enter the hours per week";
          isValid = false;

        }

        if ($('#fixed_term_salary_format').val() == '') {

          document.getElementById("reqfixed_term_salary_format").innerHTML = "* Please select the Salary format";
          isValid = false;

        }

        if ($('#fixed_term_salary_min').val() == '') {

          document.getElementById("reqfixed_term_salary_min").innerHTML = "* Please enter the minimum salary";
          isValid = false;

        }

        if ($('#fixed_term_salary_max').val() == '') {

          document.getElementById("reqfixed_term_salary_max").innerHTML = "* Please enter the maximum salary";
          isValid = false;

        }
      }

      if(mainempfield == "3"){
        if ($('#temporary_hours_week').val() == '') {

          document.getElementById("reqtemporary_hours_per_week").innerHTML = "* Please enter the Shift dates & times";
          isValid = false;

        }

        if ($('#temporary_salary_format').val() == '') {

          document.getElementById("reqtemporary_salary_format").innerHTML = "* Please select the Salary format";
          isValid = false;

        }

        if ($('#temporary_salary_min').val() == '') {

          document.getElementById("reqtemporary_salary_min").innerHTML = "* Please enter the Salary(min)";
          isValid = false;

        }

        if ($('#temporary_salary_max').val() == '') {

          document.getElementById("reqtemporary_salary_max").innerHTML = "* Please select the Salary(max)";
          isValid = false;

        }

      }

      

      if (isValid == true) {
        $.ajax({
        url: "{{ route('medical-facilities.updateContractPay') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#contract_pay_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitContractPay').prop('disabled', true);
          $('#submitContractPay').text('Process....');
        },
        success: function(res) {
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Contract & Pay added Successfully',
            }).then(function() {

              const params = new URLSearchParams(window.location.search);
              const jobId = params.get("job_id");

              if(jobId){
                window.location.href = "{{ route('medical-facilities.contract_pay') }}?job_id="+jobId;
              }else{
                window.location.href = "{{ route('medical-facilities.contract_pay') }}";
              }
              
              var tab_name = sessionStorage.getItem("tab-one");
              if(tab_name != "job_description"){

                
                sessionStorage.setItem("tab-one","contarct_pay");
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
          $('#submitJobPosting').prop('disabled', false);
          $('#submitJobPosting').text('Save Changes');
          console.log("errorss", errorss);
          
        }
      
        });
      }

      return false;
    }  

    if ($(".emptypemain").val() != "") {
      var emptypemain = JSON.parse($(".emptypemain").val());
      $('#mainemptype_fields').select2().val(emptypemain).trigger('change');
    }

    if ($(".emptypesub").val() != "") {
      var emptypesub = JSON.parse($(".emptypesub").val());
      $('#subemptypefield').select2().val(emptypesub).trigger('change');
    }
  </script>
@endsection