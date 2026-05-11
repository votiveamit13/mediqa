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

  form#multi-step-form-nurseProfileForm ul.select2-selection__rendered {
    box-shadow: none;
    max-height: inherit;
    border: none;
    position: relative;
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

            <div class="tab-content">
                <?php $user_id=''; $i = 0;?>

                <div class="tab-pane fade" id="tab-my-profile-setting">

                    {{-- @if(email_verified())
                    @if(!account_verified())
    
                    <div class="alert alert-success mt-2" role="alert">
                      <span class="d-flex align-items-center justify-content-center ">Your profile is in under review, Generally, it takes 2-3 business days. Until you can not make chnages in your profile setting. </span>
                    </div>
                    @endif
                    @endif --}}
                    <div class="card shadow-sm border-0 p-4 mt-30">
                      <h3 class="mt-0 color-brand-1 mb-2">Setting & Availability</h3>
    
                      <a class="font-md color-text-paragraph-2" href="#">You can make your profile visible for :</a>
    
    
                      <form id="multi-step-form-nurseProfileForm" enctype="multipart/form-data">
                        @csrf
                        <!-- Other form fields -->
    
                        <div class="form-check mt-3">
                          <input class="form-check-input" type="checkbox" value="1" id="visibleToMedicalFacilities"
                            {{ Auth::guard('nurse_middle')->user()->medical_facilities=='Yes' ? 'checked' : '' }} name="medical_facilities">
                          <label class="form-check-label" for="visibleToMedicalFacilities">
                            Visible to Healthcare Facilities
                          </label>
                        </div>
    
                        <div class="form-check mt-3">
                          <input class="form-check-input" type="checkbox" value="1" {{ Auth::guard('nurse_middle')->user()->agencies =='Yes'? 'checked' : '' }} id="visibleToAgencies" name="agencies">
                          <label class="form-check-label" for="visibleToAgencies">
                            Visible to Agencies
                          </label>
                        </div>
                        <!-- <div class="form-check mt-3">
                          <input class="form-check-input" type="checkbox" value="1" {{ Auth::guard('nurse_middle')->user()->individuals =='Yes'? 'checked' : '' }} id="visibleToIndividuals" name="individuals">
                          <label class="form-check-label" for="visibleToAgencies">
                            Visible to Individuals (Nurse care at home)
                          </label>
                        </div> -->
                        <label class="form-check-label  mt-3" for="availableNow">
                          <h6> Profile Status: </h6>
                        </label>
                        <div class="form-check  mt-1  mb-2">
                          <input class="form-check-input" type="radio" value="1" id="availableNow" name="profile_status" @if(Auth::guard('nurse_middle')->user()->profile_status1 == '1') checked @endif >
                          <label class="form-check-label" for="availableNow">
                            Available Now
                          </label>
                        </div>
    
                        <div class="form-check  mt-1  mb-2">
                          <input class="form-check-input" type="radio" value="0" id="unavailableNow" name="profile_status" @if(Auth::guard('nurse_middle')->user()->profile_status1 == '0') checked @endif>
                          <label class="form-check-label" for="unavailableNow">
                            Unavailable for now
                          </label>
                        </div>
                        <div class="form-group available_date_field d-none">
                          <label for="available_start">When are you able to start?</label>
                          <input type="date" id="available_date" name="available_date" class="form-control" value="{{ Auth::guard('nurse_middle')->user()->available_date }}" onkeydown="return false">
                        </div>
                        <div class="form-group level-drp d-none available_start_dropdown">
                            <label class="form-label" for="input-1">When are you available to start a new job?</label>
                            <?php
                                $user = Auth::guard('nurse_middle')->user();
                            ?>
                            <select class="form-control" name="start_job_dropdown" id="start_job_dropdown">
                                <option value="">Select</option>

                                <option value="1" @if(empty($user) || $user->start_job_dropdown == "1") selected @endif>
                                    Flexible (default)
                                </option>
                                <option value="2" @if(!empty($user) && $user->start_job_dropdown == "2") selected @endif>
                                    Same-day (Instant Connect)
                                </option>
                                <option value="3" @if(!empty($user) && $user->start_job_dropdown == "3") selected @endif>
                                    Within 48h (Last Minute)
                                </option>
                                <option value="4" @if(!empty($user) && $user->start_job_dropdown == "4") selected @endif>
                                    Within 7 Days (Immediate Start)
                                </option>
                                <option value="5" @if(!empty($user) && $user->start_job_dropdown == "5") selected @endif>
                                    Within 2 Weeks
                                </option>
                                <option value="6" @if(!empty($user) && $user->start_job_dropdown == "6") selected @endif>
                                    Within 5 Weeks
                                </option>
                                <option value="7" @if(!empty($user) && $user->start_job_dropdown == "7") selected @endif>
                                    Within 7 Weeks
                                </option>
                            </select>    
                        </div>
                        <div class="form-group drp--clr">
                            <label class="form-label" for="input-1">Do you need help with any of the following? </label>
                            
                            <input type="hidden" name="any_help_input" class="any_help_input" value='{{ $user->any_help }}'>
                            <ul id="any_help" style="display:none;">
                              
                              <li data-value="Updating my resume / CV">Updating my resume / CV</li>
                              <li data-value="Preparing for interviews">Preparing for interviews</li>
                              <li data-value="Finding job opportunities">Finding job opportunities</li>
                              <li data-value="Licensing & certification requirements">Licensing & certification requirements</li>
                              <li data-value="Networking with healthcare employers">Networking with healthcare employers</li>
                              
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="any_help" name="any_help[]" multiple="multiple"></select>
                            {{-- <span id="any_help" class="reqError text-danger valley"></span> --}}
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                          <button onclick="doprofessionSeting_update()" @if(!email_verified()) disabled @endif class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Update Setting</span>
                            <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                              <span class="sr-only">Loading...</span>
                            </div>
                          </button>
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
</script>
<script type="text/javascript">
    $("#unavailableNow").click(function() {
      if ($("#unavailableNow").prop('checked') == true) {
        $(".available_date_field").removeClass("d-none");
        $(".available_start_dropdown").addClass("d-none");
      } else {
        $(".available_date_field").addClass("d-none");
      }
    });
    $("#availableNow").click(function() {
      $(".available_date_field").addClass("d-none");
      $(".available_start_dropdown").removeClass("d-none");
    });
    if ($("#unavailableNow").prop('checked') == true) {
      $(".available_date_field").removeClass("d-none");
      $(".available_start_dropdown").addClass("d-none");
    }

    if ($("#availableNow").prop('checked') == true) {
        $(".available_start_dropdown").removeClass("d-none");
    }

    $("#start_job_dropdown").change(function(){
        //alert($(this).val());
        var value = $(this).val();
        if(value == "More than 1 month"){
            $('#unavailableNow').prop('checked', true);
            $(".available_start_dropdown").addClass("d-none");
            $(".available_date_field").removeClass("d-none");
            $("#available_date").val('');
        }
    });

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("page");
    if (c == "setting_availablity") {

        $(".tab-pane").hide();
        $("#tab-my-profile-setting").css("opacity", "1");
        $("#tab-my-profile-setting").show();
        $(".profile_tabs").removeClass("active");
        //$("#professional_membership").addClass("active");

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

  if ($(".any_help_input").val() != "") {
    var any_help_data = JSON.parse($(".any_help_input").val());
    $('.js-example-basic-multiple[data-list-id="any_help"]').select2().val(any_help_data).trigger('change');
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
