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
                      <h3 class="mt-0 color-brand-1 mb-2">Visibility & Settings</h3>
    
                      <form id="visiblity_settings_form" method="POST" onsubmit="return visiblity_settings_form()">
                        @csrf
                        <input type="hidden" name="job_id" value="{{ $job_id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::guard('healthcare_facilities')->user()->id }}">
                        <div class="visiblity_box">
                            <div class=" drp--clr">
                                <label class="form-label" for="input-1">Visibility</label>
                                <div class="visiblity_input">
                                    <div class="form-check">
                                        <input @if($job_data->visiblity == "1") checked @endif type="radio" name="visiblity_mode" value="1" checked>
                                        <label class="form-check-label" for="urgency_immediate">
                                        Nurses & Agencies
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input @if($job_data->visiblity == "2") checked @endif type="radio" name="visiblity_mode" value="2">
                                        <label class="form-check-label" for="Nurse-only">
                                        Nurse-only
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input @if($job_data->visiblity == "3") checked @endif type="radio" name="visiblity_mode" value="3">
                                        <label class="form-check-label" for="Agency-only">
                                        Agency-only
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input @if($job_data->visiblity == "4") checked @endif type="radio" name="visiblity_mode" value="4">
                                        <label class="form-check-label" for="Invite-only">
                                        Invite-only
                                        </label>
                                    </div>
                                    
                                </div>
                                <span id='reqvisiblity_mode' class='reqError text-danger valley'></span>
                            </div>
                            <div class="form-group level-drp">
                              <label class="form-label" for="input-1">Application deadline (optional)
                              </label>
                              <input class="form-control temporary_hours_per_week" type="date" name="application_deadline" value="{{ $job_data->application_deadline }}" id="application_deadline">
                              <span id='reqtemporaryrangenotes' class='reqError text-danger valley'></span>
                            </div>
                            <div class="level-drp">
                              <label class="form-label" for="input-1">Priority Tags
                              </label>
                              
                              <div class="form-check">
                                  <input type="checkbox" name="priority_tags" value="1" @if($job_data->urgent_hire == 1) checked @endif id="priority_tags">
                                  <label class="form-check-label" for="7 days">
                                  Urgent
                                  </label>
                              </div>
                            </div>
                            <div class=" drp--clr">
                                <label class="form-label" for="input-1">Listing expiry</label>
                                <div class="visiblity_input">
                                    <div class="form-check">
                                        <input type="radio" name="listing_expiry" value="1" @if($job_data->main_emp_type == "3" || $job_data->expiry_date == "1") checked @endif>
                                        <label class="form-check-label" for="7 days">
                                        7 days (default 7 days for Temporary employment)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input @if($job_data->expiry_date == "2") checked @endif type="radio" name="listing_expiry" value="2">
                                        <label class="form-check-label" for="14 days">
                                        14 days
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input @if($job_data->expiry_date == "3") checked @endif type="radio" name="listing_expiry" value="3" @if($job_data->main_emp_type == "1" || $job_data->main_emp_type == "2" || $job_data->expiry_date == "3") checked @endif>
                                        <label class="form-check-label" for="Agency-only">
                                        30 days (default 30 days for Permanent and fixed-Term employment)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input @if($job_data->expiry_date == "4") checked @endif type="radio" name="listing_expiry" value="4">
                                        <label class="form-check-label" for="60 days">
                                        60 days 
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input @if($job_data->expiry_date == "5") checked @endif type="radio" name="listing_expiry" value="5">
                                        <label class="form-check-label" for="Custom date">
                                        Custom date
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group level-drp custom_date_box @if($job_data->expiry_date != '5') d-none @endif">
                                    <label class="form-label" for="input-1">Custom date
                                    </label>
                                    <input class="form-control temporary_hours_per_week" type="date" name="custom_date" value="{{ $job_data->custom_expiry_date }}" id="custom_date">
                                    <span id='reqcustom_date' class='reqError text-danger valley'></span>
                                </div>
                                
                            </div>
                        </div>
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitVisiblitySettings">Save Changes</button>
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

    $(document).on('change', 'input[name="listing_expiry"]', function () {
      $('input[name="listing_expiry"]').removeAttr("checked");
      var listing_expiry_value = $(this).val();
      if(listing_expiry_value == "5"){
        $(".custom_date_box").removeClass('d-none');
      }else{
        $(".custom_date_box").addClass('d-none');
      }
    });

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

   

    function visiblity_settings_form() {
      var isValid = true;

      var listing_expiry_value = $('input[name="listing_expiry"]:checked').val();
      
      
      if(listing_expiry_value == "5"){
        if ($('#custom_date').val() === "") {
          
          document.getElementById("reqcustom_date").innerHTML = "* Please enter the Custom date";
          isValid = false;
        }
      }

      
      if (isValid == true) {
        $.ajax({
        url: "{{ route('medical-facilities.updateVisiblitySettings') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#visiblity_settings_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitVisiblitySettings').prop('disabled', true);
          $('#submitVisiblitySettings').text('Process....');
        },
        success: function(res) {
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Visiblity & Settings updated Successfully',
            }).then(function() {
              const jobId = params.get("job_id");

              if(jobId){
                window.location.href = "{{ route('medical-facilities.visiblity_settings') }}?job_id="+jobId;
                
              }else{
                window.location.href = "{{ route('medical-facilities.visiblity_settings') }}";
              }
              
              
              var tab_name = sessionStorage.getItem("tab-one");
              if(tab_name != "job_description"){
                sessionStorage.setItem("tab-one","visiblity_apply_settings");
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
  </script>
@endsection