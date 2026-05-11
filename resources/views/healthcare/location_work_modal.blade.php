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

  .switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

.switch input { display:none; }

.slider {
  position:absolute;
  cursor:pointer;
  background:#ccc;
  border-radius:24px;
  top:0; left:0; right:0; bottom:0;
  transition:.3s;
}

.slider:before {
  content:"";
  position:absolute;
  height:18px;
  width:18px;
  left:3px;
  bottom:3px;
  background:white;
  border-radius:50%;
  transition:.3s;
}

input:checked + .slider {
  background:black;
}

input:checked + .slider:before {
  transform: translateX(26px);
}

.toggle-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.switch_remote {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

.switch_remote input { display:none; }

.slider_remote {
  position:absolute;
  cursor:pointer;
  background:#ccc;
  border-radius:24px;
  top:0; left:0; right:0; bottom:0;
  transition:.3s;
}

.slider_remote:before {
  content:"";
  position:absolute;
  height:18px;
  width:18px;
  left:3px;
  bottom:3px;
  background:white;
  border-radius:50%;
  transition:.3s;
}

input:checked + .slider_remote {
  background:black;
}

input:checked + .slider_remote:before {
  transform: translateX(26px);
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
                      <h3 class="mt-0 color-brand-1 mb-2">Location & Work Model</h3>
    
                        <form id="location_model_form" method="POST" onsubmit="return location_model_form()">
                            @csrf
                            <div class="form-group level-drp">
                                <input type="hidden" name="user_id" value="{{ Auth::guard('healthcare_facilities')->user()->id }}">
                                <input type="hidden" name="job_id" value="{{ $job_id }}">
                                <label class="form-label" for="input-1">Country
                                </label>
                                @php
                                  $country_data = DB::table("country")->where("iso2",Auth::guard('healthcare_facilities')->user()->country_iso)->first();
                                @endphp
                                <input class="country_code" type="hidden" name="country_code" id="country_code" value="{{ Auth::guard('healthcare_facilities')->user()->country_iso }}">
                                <input class="form-control job_country" type="text" name="job_country" id="job_country" readonly value="@if(!empty($country_data)){{ $country_data->name }}@endif">
                                <span id='reqhoursweek' class='reqError text-danger valley'></span>
                            </div>      
                            <div class="form-group level-drp">
                                <label class="form-label" for="input-1">State / Region
                                </label>
                                <select class="form-control form-select" name="job_state" id="job_state" onchange="changeState(this.value)">

                                </select>
                                <span id='reqjob_state' class='reqError text-danger valley'></span>
                            </div>     
                            <div class="form-group level-drp">
                                <label class="form-label" for="input-1">City / Suburb
                                </label>
                                <input type="hidden" name="city_lat" class="city_lat" value="@if(!empty($job_data)){{ $job_data->city_lat }}@endif">
                                <input type="hidden" name="city_long" class="city_long" value="@if(!empty($job_data)){{ $job_data->city_long }}@endif">
                                <select class="form-control form-select city_suburb" name="city_suburb" id="city_suburb" onchange="changeCity(this.value)">

                                </select>
                                <!-- <input class="form-control city_suburb" type="text" name="city_suburb" id="city_suburb" value="@if(!empty($job_data)){{ $job_data->location_city }}@endif"> -->
                                <span id='reqcity_suburb' class='reqError text-danger valley'></span>
                            </div>   
                            <div class="form-group level-drp">
                                <label class="form-label" for="input-1">Primary Hiring Site
                                </label>
                                
                                <input class="form-control primary_hiring_site" type="text" name="primary_hiring_site" id="primary_hiring_site" value="@if(!empty($job_data)){{ $job_data->location_primary_hiring_site }}@endif">
                                <span id='reqprimary_hiring_site' class='reqError text-danger valley'></span>
                            </div>   
                            <div class="toggle-group">
                                <label for="site_rotation">Multi-site / Rotation</label>

                                <label class="switch">
                                    <input type="checkbox" id="site_rotation" name="site_rotation" @if(!empty($job_data) && $job_data->multi_site_rotation == 1) checked @endif>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group level-drp additional_site_box @if(empty($job_data)) d-none @else @if($job_data->multi_site_rotation == 0) d-none @endif @endif">
                                <label class="form-label" for="input-1">Additional Sites
                                </label>
                                
                                <input class="form-control additional_sites" type="text" name="additional_sites" id="additional_sites" value="@if(!empty($job_data)){{ $job_data->additional_sites }}@endif">
                                <span id='reqhoursweek' class='reqError text-danger valley'></span>
                            </div>
                            <div class="form-group level-drp">
                                <label class="form-label" for="input-1">Work Model
                                </label>
                                <select class="form-control form-select" name="work_modal" id="work_modal">
                                    <option value="">select</option>
                                    <option value="On-site" @if(!empty($job_data) && $job_data->work_model == "On-site") selected @endif>On-site</option>
                                    <option value="Hybrid" @if(!empty($job_data) && $job_data->work_model == "Hybrid") selected @endif>Hybrid</option>
                                    <option value="Remote" @if(!empty($job_data) && $job_data->work_model == "Remote") selected @endif>Remote</option>
                                </select>
                                <span id='reqwork_modal' class='reqError text-danger valley'></span>
                            </div>   
                            <div class="toggle-group">
                                <label for="site_rotation">Remote/Telehealth component</label>

                                <label class="switch_remote">
                                    <input type="checkbox" id="remote_teleneath_component" name="remote_teleneath_component" @if(!empty($job_data) && $job_data->remote_teleneath_work == 1) checked @endif>
                                    <span class="slider_remote"></span>
                                </label>
                            </div>
                            <div class="form-group level-drp @if(empty($job_data)) d-none @else @if($job_data->remote_teleneath_work == 0) d-none @endif @endif remote_teleneath_work">
                                <label class="form-label" for="input-1">Remote/Telehealth work
                                </label>
                                <select class="form-control form-select" name="remote_teleneath_modal" id="remote_teleneath_modal">
                                    <option value="">select</option>
                                    <option value="Hybrid" @if(!empty($job_data) && $job_data->remote_work_type == "Hybrid") selected @endif>Hybrid</option>
                                    <option value="Fully remote" @if(!empty($job_data) && $job_data->remote_work_type == "Fully remote") selected @endif>Fully remote</option>
                                    
                                </select>
                                
                            </div>   
                            <div class="form-group level-drp @if(empty($job_data)) d-none @else @if($job_data->remote_teleneath_work == 0 || $job_data->remote_work_type != 'Hybrid') d-none @endif @endif remote_percent_box">
                                <label class="form-label" for="input-1">Remote(in %)
                                </label>
                                <select class="form-control form-select" name="remote_percent" id="remote_percent">
                                    <option value="">select</option>
                                    <option value="10" @if(!empty($job_data) && $job_data->percent_remote == "10") selected @endif>10</option>
                                    <option value="25" @if(!empty($job_data) && $job_data->percent_remote == "25") selected @endif>25</option>
                                    <option value="50" @if(!empty($job_data) && $job_data->percent_remote == "50") selected @endif>50</option>
                                    <option value="75" @if(!empty($job_data) && $job_data->percent_remote == "75") selected @endif>75</option>
                                </select>
                                
                            </div>   
                            <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitLocationModel">Save Changes</button>
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

    $(document).ready(function () {
        var country_code_value = $(".country_code").val();
        console.log("country_code_value", country_code_value);

        $.ajax({
            type: "get",
            url: "{{ route('medical-facilities.getStates') }}",
            
            data: {country_code_value:country_code_value},
            success: function(data) {
                if(data != ""){
                    var state_data = JSON.parse(data);
                    var job_state = '';
                    var job_selected_state = "<?php echo (!empty($job_data))?$job_data->location_state:0; ?>";
                    console.log("job_selected_state",job_selected_state);
                    for(var i = 0;i<state_data.length;i++){
                        if(state_data[i].id == job_selected_state){
                          var selected_text = 'selected';
                        }else{
                          var selected_text = '';
                        }
                        job_state += '<option value='+state_data[i].id+' '+selected_text+'>'+state_data[i].name+'</option>';
                        
                    }
                    $("#job_state").append('<option value="">Select</option>'+job_state);
                    //console.log("state_name",data.name);
                }
            }
        });  

        var job_city_state = "<?php echo (!empty($job_data))?$job_data->location_state:0; ?>";
        $.ajax({
          type: "get",
          url: "{{ route('medical-facilities.getCities') }}",
          
          data: {state_code_value:job_city_state},
          success: function(data) {
              if(data != ""){
                  var city_data = JSON.parse(data);
                  var job_city = '';
                  var job_selected_city = "<?php echo (!empty($job_data))?$job_data->location_city:0; ?>";
                  console.log("job_selected_city",job_selected_city);
                  for(var i = 0;i<city_data.length;i++){
                      if(city_data[i].city_id == job_selected_city){
                        var selected_text = 'selected';
                      }else{
                        var selected_text = '';
                      }
                      job_city += '<option value='+city_data[i].city_id+' '+selected_text+'>'+city_data[i].city_name+'</option>';
                      
                  }
                  $("#city_suburb").html('<option value="">Select</option>'+job_city);
                  //console.log("state_name",data.name);
              }
          }
      }); 

        $("#site_rotation").change(function () {
            
            if ($("#site_rotation").is(":checked")) {
                $(".additional_site_box").removeClass("d-none");
            } else {
                $(".additional_site_box").addClass("d-none");
            }
        });

        $("#remote_teleneath_component").change(function () {
            
            if ($("#remote_teleneath_component").is(":checked")) {
                $(".remote_teleneath_work").removeClass("d-none");
            } else {
                $(".remote_teleneath_work").addClass("d-none");
                $(".remote_percent_box").addClass("d-none"); 
            }
        });

        $("#remote_teleneath_modal").change(function () {
            var remote_val = $("#remote_teleneath_modal").val();
            if(remote_val == "Hybrid"){
                $(".remote_percent_box").removeClass("d-none");
            }else{
                $(".remote_percent_box").addClass("d-none");   
            }
        });
        
    });
    
    function changeState(value){
    //alert(value);
      $.ajax({
          type: "get",
          url: "{{ route('medical-facilities.getCities') }}",
          
          data: {state_code_value:value},
          success: function(data) {
              if(data != ""){
                  var city_data = JSON.parse(data);
                  var job_city = '';
                  var job_selected_city = "<?php echo (!empty($job_data))?$job_data->location_city:0; ?>";
                  console.log("job_selected_city",job_selected_city);
                  for(var i = 0;i<city_data.length;i++){
                      if(city_data[i].id == job_selected_city){
                        var selected_text = 'selected';
                      }else{
                        var selected_text = '';
                      }
                      job_city += '<option value='+city_data[i].city_id+' '+selected_text+'>'+city_data[i].city_name+'</option>';
                      
                  }
                  $("#city_suburb").html('<option value="">Select</option>'+job_city);
                  //console.log("state_name",data.name);
              }
          }
      }); 

    }

    function changeCity(value){
      $.ajax({
          type: "get",
          url: "{{ route('medical-facilities.getCitiesLat') }}",
          
          data: {city_code_value:value},
          success: function(data) {
              if(data != ""){
                  var city_data = JSON.parse(data);
                  
                  console.log("city_data",city_data.latitude);
                  $(".city_lat").val(city_data.latitude);
                  $(".city_long").val(city_data.longitude);
                  //console.log("state_name",data.name);
              }
          }
      });
    }

    function location_model_form() {
      var isValid = true;

      if ($('[name="job_state"]').val() == '') {

        document.getElementById("reqjob_state").innerHTML = "* Please select the State / Region";
        isValid = false;

      }  

      if ($('[name="city_suburb"]').val() == '') {

        document.getElementById("reqcity_suburb").innerHTML = "* Please enter the City / Suburb";
        isValid = false;

      }  

      if ($('[name="primary_hiring_site"]').val() == '') {

        document.getElementById("reqprimary_hiring_site").innerHTML = "* Please select the Primary Hiring Site";
        isValid = false;

      }  
      

      if (isValid == true) {
        $.ajax({
        url: "{{ route('medical-facilities.updateLocationModel') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#location_model_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitLocationModel').prop('disabled', true);
          $('#submitLocationModel').text('Process....');
        },
        success: function(res) {
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Location & Work Model added Successfully',
            }).then(function() {
              const jobId = params.get("job_id");

              if(jobId){
                window.location.href = "{{ route('medical-facilities.location_work_modal') }}?job_id="+jobId;
                
              }else{
                window.location.href = "{{ route('medical-facilities.location_work_modal') }}";
              }
              
              sessionStorage.setItem("tab-one","location_work_modal");
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
          $('#submitLocationModel').prop('disabled', false);
          $('#submitLocationModel').text('Save Changes');
          console.log("errorss", errorss);
          
        }
      
        });
      }

      return false;
    }  
  </script>
@endsection