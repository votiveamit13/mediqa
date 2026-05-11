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
                    <h4 class="fw-semibold mb-8">Setting</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted " href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Setting & Availability</li>
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
            @include("admin.layouts.edit_nurse_tabs")
            <div class="tab-pane p-3" id="tab-9" role="tabpanel">
                <div class="row">
                    <div class="card shadow-sm border-0 p-4 mt-30">
                        <h3 class="mt-2 color-brand-1 mb-2">Setting & Availability</h3>
                        <form id="multi-step-form-nurseProfileForm" enctype="multipart/form-data">
                        @csrf
                        <!-- Other form fields -->
                        <input type="hidden" name="user_email" class="user_email" value="">    
                        <div class="form-check mt-3">
                          <input class="form-check-input" type="checkbox" value="1" id="visibleToMedicalFacilities"
                             name="medical_facilities">
                          <label class="form-check-label" for="visibleToMedicalFacilities">
                            Visible to Healthcare Facilities
                          </label>
                        </div>
    
                        <div class="form-check mt-3">
                          <input class="form-check-input" type="checkbox" value="1" id="visibleToAgencies" name="agencies">
                          <label class="form-check-label" for="visibleToAgencies">
                            Visible to Agencies
                          </label>
                        </div>
                        <div class="form-check mt-3">
                          <input class="form-check-input" type="checkbox" value="1" id="visibleToIndividuals" name="individuals">
                          <label class="form-check-label" for="visibleToAgencies">
                            Visible to Individuals (Nurse care at home)
                          </label>
                        </div>
                        <label class="form-check-label  mt-3" for="availableNow">
                          <h6> Profile Status: </h6>
                        </label>
                        <div class="form-check  mt-1  mb-2">
                          <input class="form-check-input" type="radio" value="1" id="availableNow" name="profile_status">
                          <label class="form-check-label" for="availableNow">
                            Available Now
                          </label>
                        </div>
    
                        <div class="form-check  mt-1  mb-2">
                          <input class="form-check-input" type="radio" value="0" id="unavailableNow" name="profile_status">
                          <label class="form-check-label" for="unavailableNow">
                            Unavailable for now
                          </label>
                        </div>
                        <div class="form-group available_date_field d-none">
                          <label for="available_start">When are you able to start?</label>
                          <input type="date" id="available_date" name="available_date" class="form-control" value="" onkeydown="return false">
                        </div>
                        <div class="form-group level-drp d-none available_start_dropdown">
                            <label class="form-label" for="input-1">When are you available to start a new job?</label>
                            
                            <select class="form-control" name="start_job_dropdown" id="start_job_dropdown">
                                <option value="">Select</option>
                                <option value="Immediately">Immediately</option>
                                <option value="Within 2 weeks">Within 2 weeks</option>
                                <option value="Within 1 month">Within 1 month</option>
                                <option value="More than 1 month">More than 1 month</option>
                            </select>    
                        </div>        
                        <div class="form-group drp--clr">
                            <label class="form-label" for="input-1">Do you need help with any of the following? </label>
                            
                            <input type="hidden" name="any_help_input" class="any_help_input">
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
                          <button onclick="doprofessionSeting_update()" class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Update Setting</span>
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
@endsection
@section('js')
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

    var email = sessionStorage.getItem("email");
    $(".user_email").val(email);
    function doprofessionSeting_update() {
    event.preventDefault();
    $(".valley").html("");
    $('.submit-btn-120').prop('disabled', true);
    $('.submit-btn-1').show();
    $('.resetpassword').hide();

    let formData = new FormData($('#multi-step-form-nurseProfileForm')[0]);
    $.ajax({
      type: 'POST',
      url: "{{route('admin.update-profession-profile-setting')}}",
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
            let currentTab = 'tab-2';
            let targetTab = 'tab-3';
            let newUrl = window.location.protocol + "//" + window.location.host + "/admin/add-nurse?tab=" + targetTab;
          
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
</script>
@endsection