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

  form#location_preferences_form ul.select2-selection__rendered {
    box-shadow: none;
    max-height: inherit;
    border: none;
    position: relative;
  }

  .location-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 10px;
      margin-bottom: 10px;
      position: relative;
      background: #f9f9f9;
    }
    .remove-btn {
      position: absolute;
      top: 5px;
      right: 10px;
      cursor: pointer;
      color: #000000;
      font-weight: bold;
    }
    #suggestions, .multi-suggestions {
      border: 1px solid #ccc;
      max-height: 150px;
      overflow-y: auto;
      display: none;
      background: #fff;
      position: absolute;
      z-index: 10;
    }
    #suggestions div, .multi-suggestions div {
      padding: 8px;
      cursor: pointer;
    }
    #suggestions div:hover, .multi-suggestions div:hover {
      background-color: #eee;
    }

    .form-group #singleDistance,.form-group .multiDistance{
      height: auto;
    }
    
</style>
@endsection

@section('content')
<main class="main">
  <section class="section-box mt-0">
    <div class="">
      <div class="row m-0 profile-wrapper">
        <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">

        @include('nurse.layouts.work_preferences_sidebar')
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
            {{-- @if(!email_verified())
            <div class="alert alert-success mt-2" role="alert">
              <span class="d-flex align-items-center justify-content-center ">Please verify your email first to access your account </span>
            </div>
            @endif --}}

            <div class="tab-content">
                <?php $user_id=''; $i = 0;?>

                <div class="tab-pane fade" id="tab-my-profile-setting" style="display: block;opacity:1;">

                    
                    <div class="card shadow-sm border-0 p-4 mt-30">
                      
                      <form id="location_preferences_form" method="POST" onsubmit="return update_location_preferences()">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">
                        <h3 class="mt-0 color-brand-1 mb-2">Location Preferences</h3>
                        <div class="form-check  mt-1  mb-2">
                          <input class="form-check-input" type="radio" value="Current Location area (not willing to relocate)" id="current_location" name="location_status" @if(!empty($work_preferences_data) && $work_preferences_data->location_status == "Current Location area (not willing to relocate)") checked @endif>
                          <label class="form-check-label" for="location_status">
                            Current Location area (not willing to relocate)
                          </label>
                        </div>
                        <div class="form-check  mt-1  mb-2">
                          <input class="form-check-input" type="radio" value="Multiple locations area (relocation within your country)" id="multiple_location" name="location_status" @if(!empty($work_preferences_data) && $work_preferences_data->location_status == "Multiple locations area (relocation within your country)") checked @endif>
                          <label class="form-check-label" for="location_status">
                            Multiple locations area (relocation within your country)
                          </label>
                        </div>
                        <div class="form-check  mt-1  mb-2">
                          <input class="form-check-input" type="radio" value="International relocation" id="international_location" name="location_status" @if(!empty($work_preferences_data) && $work_preferences_data->location_status == "International relocation") checked @endif>
                          <label class="form-check-label" for="location_status">
                            International relocation
                          </label>
                        </div>

                        <div class="location_finder current_location @if(empty($work_preferences_data) || $work_preferences_data->location_status != "Current Location area (not willing to relocate)") d-none @endif">
                          <h6 class="emergency_text">
                            Current Location area
                          </h6>
                          
                          <div class="work_preferences_text">
                            <p>
                              You are not willing to relocate.
                            </p>
                          </div>  
                          <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="autoDetect" name="autodetect_location" @if(!empty($work_preferences_data) && $work_preferences_data->auto_detect_location == "1") checked @endif>
                            <label class="form-check-label" for="autodetect_location">
                              Auto-Detect My Current Location
                            </label>
                          </div>
                          <div class="form-group level-drp">
                            <label class="form-label" for="input-1">Preferred Location</label>
                            <input type="text" name="prefered_location" id="singleLocationInput" class="form-control prefered_location" value="@if(!empty($work_preferences_data)) {{ $work_preferences_data->prefered_location_current }} @endif">
                            <span id="reqprefered_location" class="reqError text-danger valley"></span>
                            <div id="suggestions"></div>
                            
                          </div> 
                          <div class="form-group level-drp">
                            <label class="form-label" for="input-1">Maximum Travel Distance</label>
                            <?php
                                    
                             
                              if(!empty($work_preferences_data) && $work_preferences_data->prefered_distance != NULL){
                                $distance = explode(" ", $work_preferences_data->prefered_distance);
                                $distance1 = $distance[0];
                              }else{
                                $distance1 = '5';
                              }
                            ?>
                            <input type="range" id="singleDistance" min="5" max="50" step="5" value="{{ $distance1 }}">
                            <input type="hidden" name="singleDistance" class="singleDistanceValue" value="@if(!empty($work_preferences_data) && $work_preferences_data->prefered_distance != NULL) {{ $work_preferences_data->prefered_distance }} @else 5 km @endif">
                            <span id="singleDistanceValue">@if(!empty($work_preferences_data) && $work_preferences_data->prefered_distance != NULL) {{ $work_preferences_data->prefered_distance }} @else 5 km @endif</span>
                          </div> 
                        </div>
                        <div class="location_finder multiple_location @if(empty($work_preferences_data) || $work_preferences_data->location_status != "Multiple locations area (relocation within your country)") d-none @endif">
                          <h6 class="emergency_text">
                            Multiple locations area
                          </h6>
                          
                          <div class="work_preferences_text">
                            <p>
                              You are open to relocation within your country.
                            </p>
                          </div>  
                          <div id="multipleLocationsFields" class="section">
                            <div class="add_new_certification_div mb-3 mt-3">
                              <a style="cursor: pointer;" onclick="addLocation()">+ Add Location</a>
                            </div>
                            
                            <div id="locationsContainer">
                              @if(!empty($work_preferences_data) && $work_preferences_data->prefered_location != NULL)
                              <?php
                                $prefered_location = json_decode($work_preferences_data->prefered_location);
                                $i = 1;
                              ?>
                              @foreach ($prefered_location as $pre_loc)
                              <div class="location-card" id="locationCard{{ $i }}">
                                <div class="form-group level-drp">
                                  <div class="remove-btn" onclick="removeLocation('locationCard{{ $i }}')">x</div>
                                  <label class="form-label" for="input-1">Location:</label>
                                  <input type="text" placeholder="Type location..." name="multiLocationInput[]" value="{{ $pre_loc->location }}" class="form-control multiLocationInput" data-id="{{ $i }}" autocomplete="off">
                                  <div class="multi-suggestions" id="suggestions-{{ $i }}"></div>
                                </div>
                                
                                <div class="form-group level-drp travel_distance{{ $i }}">
                                  <label class="form-label" for="input-1">Travel Distance:</label>
                                  <?php
                                    
                                    $distance = explode(" ", $pre_loc->distance);
                                  ?>
                                  <input type="range" min="5" max="50" step="5" value="{{ $distance[0] }}" class="multiDistance">
                                  <input type="hidden" class="multiDistanceRange" name="multiDistance[]" value="{{ $pre_loc->distance }}">
                                  <span class="multiDistanceValue">{{ $pre_loc->distance }}</span>
                                </div>
                              </div>
                              @endforeach
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="location_finder internation_relocation @if(empty($work_preferences_data) || $work_preferences_data->location_status != "International relocation") d-none @endif">
                          <h6 class="emergency_text">
                            International relocation
                          </h6>
                          
                          <div class="work_preferences_text">
                            <p>
                                You are open to international relocation.

        
                            </p>
                            <p>
                                Mediqa currently has connections with a network of facilities in 10 countries, and we are actively working to expand our reach even further. Take advantage of this opportunity to connect with international employers and secure interviews with healthcare facilities abroad.

        
                            </p>
                          </div>  
                          

                          <div class="form-group level-drp">
                            <label class="form-label" for="input-1">Countries
                            </label>
                            <?php
                              if(!empty($work_preferences_data)){
                                  $countries_data_work = $work_preferences_data->countries;
                                  
                              }else{
                                  $countries_data_work = ''; 
                              }
                              
                              
                              
                            ?>
                            <input type="hidden" name="country_data" class="country_data" value='<?php echo $countries_data_work; ?>'>
                            <ul id="countries_data" style="display:none;">
                              
                              @if(!empty($countries_data))
                              @foreach($countries_data as $cdata)
                              <li data-value="{{ $cdata->id }}">{{ $cdata->name }}</li>
                              @endforeach
                              <li data-value="Other">Other</li>
                              @endif
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn countvalid" data-list-id="countries_data" name="countries[]" multiple></select>
                            <span id='reqcountry_preferences' class='reqError text-danger valley'></span>
                          </div>
                          <?php
                              if(!empty($work_preferences_data) && $work_preferences_data->other_countries != NULL){
                                  $countries_data_work_other = $work_preferences_data->other_countries;
                                  
                              }else{
                                  $countries_data_work_other = ''; 
                              }
                              
                              
                              
                          ?>
                          <div class="form-group level-drp @if(empty($countries_data_work_other)) d-none @endif countries_other_div">
                              <label class="form-label" for="input-1">Other
                              </label>
                              
                            <input type="hidden" name="country_data_other" class="country_data_other" value='<?php echo $countries_data_work_other; ?>'>
                              <ul id="countries_data_other" style="display:none;">
                              
                                  @if(!empty($countries_data_other))
                                  @foreach($countries_data_other as $cdata_other)
                                  <li data-value="{{ $cdata_other->id }}">{{ ucfirst($cdata_other->nicename) }}</li>
                                  @endforeach
                                  
                                  @endif
                              </ul>
                              <select class="js-example-basic-multiple addAll_removeAll_btn othercountvalid" data-list-id="countries_data_other" name="other_countries[]" multiple></select>
                              <span id='reqothercountry_preferences' class='reqError text-danger valley'></span>
                          </div>
                        </div>
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitLocationPreferences" @if(!email_verified()) disabled  @endif>Save Changes</button>
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
@include('nurse.front_profile_js');
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

    $("#international_location").click(function() {
      $(".location_finder").addClass("d-none");
      $(".internation_relocation").removeClass("d-none");
      
    });

    $("#multiple_location").click(function() {
      $(".location_finder").addClass("d-none");
      $(".multiple_location").removeClass("d-none");
      
    });

    $("#current_location").click(function() {
      $(".location_finder").addClass("d-none");
      $(".current_location").removeClass("d-none");
      
    });

    if ($(".country_data").val() != "") {
        var countvalid = JSON.parse($(".country_data").val());
        $('.js-example-basic-multiple[data-list-id="countries_data"]').select2().val(countvalid).trigger('change');
    }

    if ($(".countries_other_div").hasClass("d-none") == false) {
        if ($(".country_data_other").val() != "") {
            var othercountvalid = JSON.parse($(".country_data_other").val());
            $('.js-example-basic-multiple[data-list-id="countries_data_other"]').select2().val(othercountvalid).trigger('change');
        }
    }    
</script>
<script type="text/javascript">
    $('.js-example-basic-multiple[data-list-id="countries_data"]').on('change', function() {
        let selectedValues = $(this).val();
        console.log("selectedValues",selectedValues);

        if(selectedValues.includes("Other")){
            $(".countries_other_div").removeClass("d-none");
        }else{
            $('.js-example-basic-multiple[data-list-id="countries_data_other"]').select2().val([]).trigger('change');
            $(".countries_other_div").addClass("d-none");
        }
    });

    function update_location_preferences() {
      var isValid = true;

      if($(".internation_relocation").hasClass("d-none") == false){
        if ($(".countvalid").val() == '') {

          document.getElementById("reqcountry_preferences").innerHTML = "* Please select the countries.";
          isValid = false;

        }

        if ($(".countries_other_div").hasClass("d-none") == false && $(".othercountvalid").val() == '') {

          document.getElementById("reqothercountry_preferences").innerHTML = "* Please select the other countries.";
          isValid = false;

        }
      }

      if($(".current_location").hasClass("d-none") == false){
        if ($.trim($(".prefered_location").val()) == '') {

          document.getElementById("reqprefered_location").innerHTML = "* Please enter the location";
          isValid = false;

        }
      }
      
      if($(".multiple_location").hasClass("d-none") == false){
        var i = 1;
        $(".multiLocationInput").each(function(){
          if ($.trim($(".multiLocationInput-"+i).val()) == '') {

            document.getElementById("reqprefered_location-"+i).innerHTML = "* Please enter the location";
            isValid = false;

          }
          i++;
        });
        
      }

      if (isValid == true) {
        $.ajax({
        url: "{{ route('nurse.updateLocationPreferences') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#location_preferences_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitLocationPreferences').prop('disabled', true);
          $('#submitLocationPreferences').text('Process....');
        },
        success: function(res) {
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Location Preferences Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.locationPreferences') }}?page=locationPreferences";
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
          $('#submitLocationPreferences').prop('disabled', false);
          $('#submitLocationPreferences').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitLocationPreferences").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      
        });
      }

      return false;
    }

</script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
const workAreaRadios = document.getElementsByName('workArea');
const currentLocationFields = document.getElementById('currentLocationFields');
const multipleLocationsFields = document.getElementById('multipleLocationsFields');
const internationalFields = document.getElementById('internationalFields');
const autoDetect = document.getElementById('autoDetect');
const singleLocationInput = document.getElementById('singleLocationInput');
const suggestions = document.getElementById('suggestions');
const singleDistance = document.getElementById('singleDistance');
const singleDistanceValue = document.getElementById('singleDistanceValue');
const locationsContainer = document.getElementById('locationsContainer');




// Handle Work Area Selection
workAreaRadios.forEach(radio => {
  radio.addEventListener('change', () => {
    if (radio.checked) {
      if (radio.value === 'current') {
        currentLocationFields.style.display = 'block';
        multipleLocationsFields.style.display = 'none';
        internationalFields.style.display = 'none';
      } else if (radio.value === 'multiple') {
        currentLocationFields.style.display = 'none';
        multipleLocationsFields.style.display = 'block';
        internationalFields.style.display = 'none';
      } else {
        currentLocationFields.style.display = 'none';
        multipleLocationsFields.style.display = 'none';
        internationalFields.style.display = 'block';
      }
    }
  });
});

// Update Distance Slider
singleDistance.addEventListener('input', () => {
  singleDistanceValue.textContent = singleDistance.value === '50' ? '50 km+' : `${singleDistance.value} km`;
  $(".singleDistanceValue").val(singleDistance.value === '50' ? '50 km+' : `${singleDistance.value} km`);
});

// Auto-Detect Location
autoDetect.addEventListener('change', () => {
  if (autoDetect.checked && navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(async (position) => {
      const { latitude, longitude } = position.coords;
      const res = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`);
      const data = await res.json();
      singleLocationInput.value = data.display_name || 'Detected Location';
    }, (err) => {
      alert('Could not detect your location.');
      console.error(err);
    });
  }
});

// Smart Search Suggestions for Single Location
singleLocationInput.addEventListener('input', async (e) => {
  const query = e.target.value;
  if (query.length < 3) {
    suggestions.style.display = 'none';
    return;
  }

  const res = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`);
  const results = await res.json();

  suggestions.innerHTML = '';
  if (results.length > 0) {
    results.forEach(location => {
      const div = document.createElement('div');
      div.textContent = location.display_name;
      div.addEventListener('click', () => {
        singleLocationInput.value = location.display_name;
        suggestions.style.display = 'none';
      });
      suggestions.appendChild(div);
    });
    suggestions.style.display = 'block';
  } else {
    suggestions.style.display = 'none';
  }
});

var id = 1;
$("#locationsContainer .location-card").each(function(){
  var card = document.getElementById("locationCard"+id);
  console.log("card",card);
  const input = card.querySelector(".multiLocationInput");
  const suggestions = card.querySelector(`#suggestions-${id}`);
  setupAutocomplete(input, suggestions);

  const slider = card.querySelector(".multiDistance");
  const display = card.querySelector(".multiDistanceValue");
  slider.addEventListener("input", () => {
    display.textContent = slider.value === "50" ? "50 km+" : `${slider.value} km`;
  });
  id++;
});


// Add Multiple Location Cards
function addLocation() {
  let id = $("#locationsContainer .location-card").length;
  id++;
  const container = document.getElementById("locationsContainer");

  const card = document.createElement("div");
  card.className = "location-card";
  card.id = `loc${id}`;
  card.innerHTML = `
    <div class="form-group">
      <div class="remove-btn" onclick="removeLocation('loc${id}')">x</div>
      <label>Location</label>
      <input type="text" class="form-control multiLocationInput multiLocationInput-${id}" name="multiLocationInput[]" placeholder="Type location..." data-id="${id}">
      <div class="multi-suggestions" id="suggestions-${id}"></div>
      <span id="reqprefered_location-${id}" class="reqError text-danger valley"></span>
    </div>
    <div class="form-group">
    <label>Travel Distance</label>
    <input type="range" class="multiDistance" min="5" max="50" step="5" value="15">
    <input type="hidden" class="multiDistanceRange" name="multiDistance[]" value="25 km">
    <span class="multiDistanceValue">15 km</span>
    </div>
  `;
  container.appendChild(card);
  console.log("card",card);
  const input = card.querySelector(".multiLocationInput");
  const suggestions = card.querySelector(`#suggestions-${id}`);
  setupAutocomplete(input, suggestions);

  const slider = card.querySelector(".multiDistance");
  const display = card.querySelector(".multiDistanceValue");
  slider.addEventListener("input", () => {
    display.textContent = slider.value === "50" ? "50 km+" : `${slider.value} km`;
  });
}

// Remove Location
function removeLocation(id) {
  
  document.getElementById(id).remove();
}

// ======= Smart search & location autocomplete =======
function setupAutocomplete(inputElement, suggestionsElement) {
  inputElement.addEventListener("input", async function () {
    const query = inputElement.value;
    if (query.length < 3) {
      suggestionsElement.innerHTML = '';
      suggestionsElement.style.display = 'none';
      return;
    }

    const res = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`);
    const results = await res.json();
    suggestionsElement.innerHTML = '';

    results.forEach(place => {
      const div = document.createElement('div');
      div.textContent = place.display_name;
      div.addEventListener('click', () => {
        inputElement.value = place.display_name;
        suggestionsElement.innerHTML = '';
        suggestionsElement.style.display = 'none';
      });
      suggestionsElement.appendChild(div);
    });
    suggestionsElement.style.display = results.length ? 'block' : 'none';
  });
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
  
  

@endsection
