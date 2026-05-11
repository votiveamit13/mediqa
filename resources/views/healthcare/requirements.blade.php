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

form#job_requirements_form ul.select2-selection__rendered {
    box-shadow: none;
    max-height: inherit;
    border: none;
    position: relative;
  }

  .clear-btn{
    visibility: hidden;
  }

  .checkbox-group label{
  display:block;
  margin-bottom:6px;
}

.table-bordered td,
.table-bordered th {
    border: 1px solid #dee2e6 !important;
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
                      <h3 class="mt-0 color-brand-1 mb-2">Requirements</h3>
                      <form id="job_requirements_form" method="POST" onsubmit="return job_requirements_form()">
                        @csrf    
                        <div class="level-drp">
                            <input type="hidden" name="job_id" value="{{ $job_id }}">
                            <div class="checkbox-group">
                                <label><input type="checkbox" name="education[]"  value="no_minimum"> General Certifications Evidence</label>
                                <div class="mandatory_training_checkbox">
                                    <label><input type="checkbox" name="education[]" class="mandatory_training_evidence" value="certificate"> Mandatory Training evidence</label>
                                    <div class="mandatory_training_block  d-none">
                                        <div class="form-group level-drp">
                                            

                                            <label class="form-label" for="input-1">Please select all that apply</label>
                                            <?php
                                            $mandatory_courses = DB::table('man_training_category')->where('type', 'Training')->where('parent', 0)->get();
                                            ?>
                                            
                                            <ul id="mandatory_courses_data" style="display:none;">
                                                @foreach($mandatory_courses as $m_courses)
                                                <li data-value="{{ $m_courses->id }}">{{ $m_courses->name }}</li>
                                                @endforeach
                                            </ul>
                                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="mandatory_courses_data" name="mandatory_courses[]" multiple="multiple" onchange="getSubCourses()"></select>
                                            <span id="reqmantra" class="reqError text-danger valley"></span>
                                        </div>
                                        <div class="mandatory_sub_courses"></div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="degree_requirements_checkbox">
                                    <label><input type="checkbox" name="education[]" class="degree_requirements" value="degree_requirements"> Degree certificate / transcript</label>
                                    <div class="level-drp education_requirements d-none">
                                        <h6>Education Requirements</h6>
                                        <label>Minimum qualification required:</label>
                                        <div class="checkbox-group">
                                            <label><input type="checkbox" name="education_req[]" value="no_minimum"> No minimum</label>
                                            <label><input type="checkbox" name="education_req[]" value="certificate"> Certificate / Diploma</label>
                                            <label><input type="checkbox" name="education_req[]" value="bachelor"> Bachelor Degree</label>
                                            <label><input type="checkbox" name="education_req[]" value="postgraduate"> Postgraduate Qualification</label>
                                            <label><input type="checkbox" name="education_req[]" value="masters"> Master’s Degree</label>
                                            <label><input type="checkbox" name="education_req[]" value="doctorate"> Doctorate</label>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="vaccination_checkbox">
                                   <label><input type="checkbox" name="education[]" class="vaccination_evidence" value="vaccination_evidence"> Vaccination evidence</label>
                                   <div class="vaccination_listing d-none">
                                        <table class="table table-bordered border">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    
                                                    <th>State Name</th>
                                                    <th>Vaccine</th>
                                                    <th>Required Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="vaccine_body">
                                                <input type="hidden" name="state_name" class="state_name" value="{{ $state_name }}">
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach($vaccine_data as $vcc_data)
                                                <tr>
                                                    <td>
                                                        
                                                        <input type="checkbox" name="vaccination_required[]" class="vaccination_required" value="{{ $vcc_data->id }}">
                                                    </td>
                                                    
                                                    <td>
                                                        @php
                                                        $state_data = DB::table("states")->where("id",$vcc_data->state_id)->first();
                                                        @endphp
                                                        {{ $state_data->name }}
                                                    </td>
                                                    <td>{{ $vcc_data->vaccine }}</td>
                                                    <td>{{ $vcc_data->required }}</td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                                @endforeach
                                               
                                            </tbody>
                                        </table>
                                        <div class="request_additional_vaccine">
                                            <label>
                                                <input type="checkbox" name="additional_vaccine[]" class="additional_vaccine" value="additional_vaccine"> Request additional vaccine 

                                            </label>
                                            <div class="additional_vaccine_div d-none">
                                                <div class="form-group level-drp additional_vaccine_field">
                                                    <label class="form-label" for="input-1">Additional Vaccine
                                                    </label>
                                                    
                                                    <input class="form-control additional_vaccine_text" type="text" name="additional_vaccine_text" id="additional_vaccine_text">
                                                    <span id="reqadditional_vaccine_text" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="add_vaccine">
                                                    <a href="#" class="btn btn-dark rounded px-3 py-2" onclick="addVaccine()">Add Vaccine</a>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div> 
                                    
                                </div>
                                
                                <div class="checks_clearances_checkbox">
                                    <label><input type="checkbox" name="education[]" class="checks_clearances" value="checks_clearances"> Checks & clearances</label>
                                    <div class="level-drp checks_clearances_block d-none">
                                        <h6>Checks & Clearances</h6>
                                        
                                        <div class="checkbox-group">
                                            <div class="residency_evidence_checkbox">
                                                <label><input type="checkbox" name="" class="residency_evidence" value="citizen"> Residency evidence</label>
                                                <div class="residency_evidence_block d-none">
                                                    <div class="checkbox-group">
                                                        <label><input type="checkbox" name="residency[]" value="citizen"> Citizen</label>
                                                        <label><input type="checkbox" name="residency[]" value="pr"> Permanent resident</label>
                                                        <label><input type="checkbox" name="residency[]" value="visa"> Visa Holder</label>
                                                        <label><input type="checkbox" name="residency[]" value="sponsorship"> Sponsorship Available</label>
                                                        <div class="overseas_qualified_checkbox">
                                                            <label>
                                                                <input type="checkbox" id="overseasToggle" name="overseas_allowed" value="overseas_allowed">
                                                                Overseas-qualified candidates considered
                                                            </label>
                                                            <div id="overseasOptions" class="d-none" style="margin-left:20px;">
                                                                <label><input type="checkbox" name="residency[]" value="overseasponsorship"> Sponsorship available</label>
                                                                <label><input type="checkbox" name="residency[]" value="bridging"> Bridging program supported</label>
                                                                <label><input type="checkbox" name="residency[]" value="supervised"> Supervised practice available</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <label><input type="checkbox" name="residency[]" value="ndis_screen_check"> NDIS Worker Screening Check evidence</label>
                                            <label><input type="checkbox" name="residency[]" value="working_children"> Working With Children Check (WWCC) evidence</label>
                                            <label><input type="checkbox" name="residency[]" value="police_clearance"> Police Clearance</label>
                                            <hr>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="registration_licenses_checkbox">
                                    <label><input type="checkbox" name="education[]" class="registration_licenses" value="registration_licenses"> Registration & Licences</label>
                                    <div class="level-drp registration_licence_block d-none">
                                        <h6>Registration & Licences</h6>
                                        
                                        <div class="checkbox-group">
                                            <label><input type="checkbox" name="reg_licenses_req[]" value="ndis_provider"> NDIS-registered provider evidence</label>
                                            <label><input type="checkbox" name="reg_licenses_req[]" value="medicare"> Medicare / MBS (NP/Midwife) evidence</label>
                                            <label><input type="checkbox" name="reg_licenses_req[]" value="pbs"> PBS Prescriber evidence</label>
                                            <label><input type="checkbox" name="reg_licenses_req[]" value="immunisation"> Immunisation Provider evidence</label>
                                            <label><input type="checkbox" name="reg_licenses_req[]" value="radiation"> Radiation Use Licence evidence</label>

                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="specialized_clearances_checkbox">
                                    <label><input type="checkbox" name="education[]" id="specialClearanceToggle" value="doctorate"> Specialized Clearances evidence</label>
                                    <div id="specialClearanceContainer" class="d-none" style="margin-left:20px;">
                                        <div id="clearanceList">
                                            <div class="specialized_clearances_block specialized_clearances_block-s">
                                                <div class="form-group drp--clr">
                                                    <label class="form-label" for="input-1">State</label>
                                                    
                                                    
                                                    <ul id="state_authorization" style="display:none;">
                                                        
                                                        <li data-value="NSW">New South Wales (NSW)</li>
                                                        <li data-value="VIC">Victoria (VIC)</li>
                                                        <li data-value="QLD">Queensland (QLD)</li>
                                                        <li data-value="WA">Western Australia (WA)</li>
                                                        <li data-value="SA">South Australia (SA)</li>
                                                        <li data-value="TAS">Tasmania (TAS)</li>
                                                        <li data-value="ACT">Australian Capital Territory (ACT)</li>
                                                        <li data-value="NT">Northern Territory (NT)</li>
                                                    </ul>
                                                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="state_authorization" name="specialied_clearances[1][state]" multiple="multiple"></select>
                                                    <span id="reqimmunization_state" class="reqError text-danger valley"></span>
                                                </div>
                                                <div class="form-group clearance-item">
                                                    <label class="form-label" for="input-1">Specialized Clearance type</label>
                                                    <input type="text" name="specialied_clearances[1][]" placeholder="Enter clearance type">
                                                    
                                                </div>
                                                <div class="delete-exp-btn">
                                                    <button type="button" class="btn btn-default" style="cursor: pointer;" onclick="removeClearance('s')">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add_specialized_clearances"></div>
                                        <div class="add_new_certification_div awe mb-3 mt-4">
                                            <button type="button" class="btn btn-default" style="cursor: pointer;" onclick="addClearance()">+ Add clearance</button>
                                        </div>  
                                        <hr>  
                                    </div>
                                </div>
                                <div class="language_evidence_checkbox">
                                    <label><input type="checkbox" name="education[]" class="specailized_language_evidence" value="doctorate"> Specialized Language evidence</label>
                                    <div class="language_evidence_block d-none">
                                        <div class="form-group level-drp">
                                            <label class="form-label" for="input-1">Language
                                            </label>
                                           
                                            <ul id="main_languages" style="display:none;">
                             
                                                @if(!empty($language_data))
                                                @foreach($language_data as $langdata)
                                                <li data-value="{{ $langdata->language_id }}">{{ $langdata->language_name }}</li>
                                                @endforeach
                                                @endif
                                            </ul>
                                            <select class="js-example-basic-multiple addAll_removeAll_btn main_languages_valid" data-list-id="main_languages" name="main_languages[]" multiple></select>
                                        </div>    
                                        <div class="sub_languages_div">

                                        </div>
                                        <div class="specailized_language_requirements">
                                            <h6>Specialized Language requirements</h6>
                                            <label>
                                                <input type="checkbox" name="special_lang_req[]" placeholder="Medical Terminology Proficiency" value="191">
                                                Medical Terminology Proficiency (Knows medical terms in selected languages.)
                                            </label>
                                            <label>
                                                <input type="checkbox" name="special_lang_req[]" placeholder="Sign Language" value="192">
                                                Sign Language (Auslan, ASL, BSL, etc.)
                                            </label>    
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="other_evidence_requirement">
                                    <label><input type="checkbox" name="" class="other_evidence" value="other_evidence"> Other evidence requirement</label>
                                    <div class="other_evidence_block d-none">
                                        <div class="form-group clearance-item">
                                            <div class="other_evidence_field other_evidence_field-0">
                                                <label class="form-label" for="input-1">Other Evidence</label>
                                                <input type="text" name="other_evidence[]" placeholder="Other Evidence"><br>
                                                <button class="btn btn-default mt-1" type="button" onclick="removeEvidence(0)">- Delete</button>
                                            </div>
                                            
                                            <div class="add_other_evidence"></div>
                                            <button class="btn btn-default mt-1" type="button" onclick="addEvidence()">+ Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="other_evidence_requirement">
                                    <div class="specailized_language_requirements">
                                        <h6>Required documents on application:</h6>
                                        <label>
                                            <input type="checkbox" name="documents_req[]" value="CV">
                                            CV
                                        </label>
                                        <label>
                                            <input type="checkbox" name="documents_req[]" value="AHPRA number">
                                            AHPRA number
                                        </label>    
                                    </div>
                                    
                                </div>
                            </div>
                        </div>    
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitJobRequirements">Save Changes</button>
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

    $(document).on("change", "#overseasToggle", function(){

        if ($(this).is(':checked')) {
            $("#overseasOptions").removeClass("d-none");
        } else {
            $("#overseasOptions").addClass("d-none");
        }

    });
    $(document).on("change", "#specialClearanceToggle", function(){

        if ($(this).is(':checked')) {
            $("#specialClearanceContainer").removeClass("d-none");
        } else {
            $("#specialClearanceContainer").addClass("d-none");
        }

    });

    $(document).on("change", ".degree_requirements", function(){

        if ($(this).is(':checked')) {
            $(".education_requirements").removeClass("d-none");
        } else {
            $(".education_requirements").addClass("d-none");
        }

    });

    $(document).on("change", ".registration_licenses", function(){

        if ($(this).is(':checked')) {
            $(".registration_licence_block").removeClass("d-none");
        } else {
            $(".registration_licence_block").addClass("d-none");
        }

    });

    $(document).on("change", ".checks_clearances", function(){

        if ($(this).is(':checked')) {
            $(".checks_clearances_block").removeClass("d-none");
        } else {
            $(".checks_clearances_block").addClass("d-none");
        }

    });

    $(document).on("change", ".vaccination_evidence", function(){

        if ($(this).is(':checked')) {
            $(".vaccination_listing").removeClass("d-none");
        } else {
            $(".vaccination_listing").addClass("d-none");
        }

    });

    $(document).on("change", ".additional_vaccine", function(){

        if ($(this).is(':checked')) {
            $(".additional_vaccine_div").removeClass("d-none");
        } else {
            $(".additional_vaccine_div").addClass("d-none");
        }

    });

    $(document).on("change", ".mandatory_training_evidence", function(){
        
        if ($(this).is(':checked')) {
            $(".mandatory_training_block").removeClass("d-none");
        } else {
            $(".mandatory_training_block").addClass("d-none");
        }

    });

    $(document).on("change", ".residency_evidence", function(){

        if ($(this).is(':checked')) {
            $(".residency_evidence_block").removeClass("d-none");
        } else {
            $(".residency_evidence_block").addClass("d-none");
        }

    });

    $(document).on("change", ".other_evidence", function(){

        if ($(this).is(':checked')) {
            $(".other_evidence_block").removeClass("d-none");
        } else {
            $(".other_evidence_block").addClass("d-none");
        }

    });

    $(document).on("change", ".specailized_language_evidence", function(){

        if ($(this).is(':checked')) {
            $(".language_evidence_block").removeClass("d-none");
        } else {
            $(".language_evidence_block").addClass("d-none");
        }

    });

    function addVaccine(){
        var additional_vaccine = $("#additional_vaccine_text").val();
        var state_name = $(".state_name").val();

        $("#vaccine_body").append('\<tr>\
                                <td>\
                                    <input type="checkbox" name="vaccination_required[]" class="vaccination_required" value="'+additional_vaccine+'">\
                                </td>\
                                <td>\
                                '+state_name+'\
                                </td>\
                                <td>'+additional_vaccine+'</td>\
                                <td>Yes</td>\
                            </tr>')
    }

    $('.js-example-basic-multiple[data-list-id="main_languages"]').on('change', function() {
        let selectedValues = $(this).val();
        console.log("selectedValues",selectedValues);

        $(".sub_languages_div .sublang_list").each(function(i,val){
            var val1 = $(val).val();
            console.log("val",val1);
            if(selectedValues.includes(val1) == false){
              $(".sublang_main_div-"+val1).remove();
                
                
            }
        });

        for(var i=0;i<selectedValues.length;i++){
            if($(".sub_languages_div .sub_lang_div-"+selectedValues[i]).length < 1){
                $.ajax({
                    type: "GET",
                    url: "{{ url('/healthcare-facilities/getLanguagesData') }}",
                    data: {language_id:selectedValues[i]},
                    cache: false,
                    success: function(data){
                        var data1 = JSON.parse(data);
                        console.log("data",data1.main_language_data.language_field);
                        if(data1.main_language_data.language_field == "text"){
                            var ap = '';
                            $(".sub_languages_div").append('\<div class="sublang_main_div sublang_main_div-'+data1.main_language_data.language_id+'">\
                            <div class="sub_lang_div sub_lang_div-'+data1.main_language_data.language_id+' form-group level-drp">\
                            <label class="form-label sub_lang_label sub_lang_label-'+data1.main_language_data.language_id+'" for="input-1">'+data1.main_language_data.language_name+'</label>\
                            <input type="hidden" name="sublang_list" class="sublang_list sublang_list-'+data1.main_language_data.language_id+'" value="'+data1.main_language_data.language_id+'">\
                            <input type="text" name="sub_languages['+data1.main_language_data.language_id+'][]" class="form-control fixed_salary_amount sub_lang_valid-'+data1.main_language_data.language_id+'" onkeyup="getProficiency_text(\''+ap+'\',\''+data1.main_language_data.language_id+'\')" value="">\
                            <span id="reqsublangvalid-'+data1.main_language_data.language_id+'" class="reqError text-danger valley"></span>\
                            </div>\
                            <div class="lang_proficiency_level-'+data1.main_language_data.language_id+'"></div>\
                            </div>');
                        }else{
                          if(data1.main_language_data.language_field == "dropdown"){
                            var sublang_text = "";
                            for(var j=0;j<data1.language_data.length;j++){
                            
                                sublang_text += "<li data-value='"+data1.language_data[j].language_id+"'>"+data1.language_data[j].language_name+"</li>"; 
                            
                            }
                            var ap = '';
                            $(".sub_languages_div").append('\<div class="sublang_main_div sublang_main_div-'+data1.main_language_data.language_id+'">\
                              <div class="sub_lang_div sub_lang_div-'+data1.main_language_data.language_id+' form-group level-drp">\
                                <label class="form-label sub_lang_label sub_lang_label-'+data1.main_language_data.language_id+'" for="input-1">'+data1.main_language_data.language_name+'</label>\
                                <input type="hidden" name="sublang_list" class="sublang_list sublang_list-'+data1.main_language_data.language_id+'" value="'+data1.main_language_data.language_id+'">\
                                <ul id="sub_lang_dropdown-'+data1.main_language_data.language_id+'" style="display:none;">'+sublang_text+'</ul>\
                                <select class="js-example-basic-multiple'+data1.main_language_data.language_id+' sub_lang_valid-'+data1.main_language_data.language_id+' addAll_removeAll_btn" data-list-id="sub_lang_dropdown-'+data1.main_language_data.language_id+'" name="sub_languages['+data1.main_language_data.language_id+'][]" onchange="getProficiency(\''+ap+'\',\''+data1.main_language_data.language_id+'\')" multiple="multiple"></select>\
                                <span id="reqsublangvalid-'+data1.main_language_data.language_id+'" class="reqError text-danger valley"></span>\
                              </div>\
                              <div class="lang_proficiency_level-'+data1.main_language_data.language_id+'"></div>\
                              </div>\
                            ');

                            
                            selectTwoFunction(data1.main_language_data.language_id);
                          }
                            
                        }
                        let $fields = $(".sub_languages_div .sublang_main_div");

                        let sortedFields = $fields.sort(function (a, b) {
                            return $(a).find(".sub_lang_label").text().localeCompare($(b).find(".sub_lang_label").text());
                        });
                        console.log("sortedFields",sortedFields);
                        $(".sub_languages_div").append(sortedFields);
                    }
                });
            }
        }
        
    });

    function getSubCourses(){
        let selectedValues = $('.js-example-basic-multiple[data-list-id="mandatory_courses_data"]').val();
        console.log("selectedValues",selectedValues);

        $(".well_sel_data").each(function(i,val){
          var val = $(val).val();
          console.log("val",$(val).val());
          if(selectedValues.includes(val) == false){
            $(".courses_div-"+val).remove();
            
          }
        });

        for(var i=0;i<selectedValues.length;i++){
            if($(".mandatory_sub_courses .courses_div-"+selectedValues[i]).length < 1 && selectedValues[i] != 564){
                $("#submitProfessionalMembership").attr("disabled", true);
                $.ajax({
                    type: "GET",
                    url: "{{ url('/healthcare-facilities/getMandatoryCourses') }}",
                    data: {courses_id:selectedValues[i],id:i},
                    cache: false,
                    success: function(data){
                        var data1 = JSON.parse(data);
                        console.log("data1",data1);
                        
                        var courses_text = "";
                        for(var j=0;j<data1.getCourses.length;j++){
                        
                            courses_text += "<li data-value='"+data1.getCourses[j].id+"'>"+data1.getCourses[j].name+"</li>"; 

                        }

                        var ap = '';
                        $(".mandatory_sub_courses").append('\<div class="courses_div courses_div-'+data1.courses_id+'"><div class="form-group level-drp mandatory_courses_div  mandatory_tr_div_1">\
                            <input type="hidden" name="well_sel_data" class="well_sel_data" value="'+data1.courses_id+'">\
                            <label class="form-label courses_label courses_label-'+data1.courses_id+'" for="input-1">'+data1.courses_name+'</label>\
                            <ul id="well_self_care_data-'+data1.courses_id+'" style="display:none;">'+courses_text+'</ul>\
                            <select class="js-example-basic-multiple'+data1.courses_id+' addAll_removeAll_btn" data-list-id="well_self_care_data-'+data1.courses_id+'" name="mandatory_training['+data1.courses_id+'][]" multiple="multiple"></select>\
                            <span id="reqsubcourses-'+data1.courses_id+'" class="reqError text-danger valley"></span>\
                        </div><div class="well_self_care_div-'+data1.courses_id+'"></div></div>');

                        let $fields = $(".mandatory_sub_courses .courses_div");

                        let sortedFields = $fields.sort(function (a, b) {
                            return $(a).find(".courses_label").text().localeCompare($(b).find(".courses_label").text());
                        });

                        $(".mandatory_sub_courses").append(sortedFields);

                        selectTwoFunction(data1.courses_id);
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

    var i = 0;
    function addClearance(){
        $(".add_specialized_clearances").append('<div class="specialized_clearances_block specialized_clearances_block-'+i+'">\
            <div class="form-group drp--clr">\
                <label class="form-label" for="input-1">State</label>\
                <ul id="state_authorization" style="display:none;">\
                    <li data-value="NSW">New South Wales (NSW)</li>\
                    <li data-value="VIC">Victoria (VIC)</li>\
                    <li data-value="QLD">Queensland (QLD)</li>\
                    <li data-value="WA">Western Australia (WA)</li>\
                    <li data-value="SA">South Australia (SA)</li>\
                    <li data-value="TAS">Tasmania (TAS)</li>\
                    <li data-value="ACT">Australian Capital Territory (ACT)</li>\
                    <li data-value="NT">Northern Territory (NT)</li>\
                </ul>\
                <select class="js-example-basic-multiple'+i+' addAll_removeAll_btn" data-list-id="state_authorization" name="immunization_state[]" multiple="multiple"></select>\
                <span id="reqimmunization_state" class="reqError text-danger valley"></span>\
            </div>\
            <div class="form-group clearance-item">\
                <label class="form-label" for="input-1">Specialized Clearance type</label>\
                <input type="text" name="special_clearances[]" placeholder="Enter clearance type">\
            </div>\
            <button type="button" class="btn btn-default" onclick="removeClearance('+i+')">Delete</button>\
        </div>');

        selectTwoFunction(i);
        i++;
    }

    function removeClearance(ival){
        
        $(".specialized_clearances_block-"+ival).remove();
    }

    var j = 1;
    function addEvidence(){
        $(".add_other_evidence").append('<div class="other_evidence_field other_evidence_field-'+j+'">\
            <div class="form-group evidence-item">\
                <label class="form-label" for="input-1">Other Evidence '+j+'</label>\
                <input type="text" name="special_clearances[]">\
            </div>\
            <button class="btn btn-default" type="button" onclick="removeEvidence('+j+')">Delete</button>\
        </div>');

        selectTwoFunction(i);
        j++;
    }

    function removeEvidence(jval){
        
        $(".other_evidence_field-"+jval).remove();
    }

    function job_requirements_form() {
      var isValid = true;

      // if ($('#sector_preferences').val() == '') {

      //   document.getElementById("reqsector_preferences").innerHTML = "* Please select the Sector Preferences.";
      //   isValid = false;

      // }


      if (isValid == true) {
        $.ajax({
        url: "{{ route('medical-facilities.updateJobRequirements') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#job_requirements_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitJobRequirements').prop('disabled', true);
          $('#submitJobRequirements').text('Process....');
        },
        success: function(res) {
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Job Requirements Updated Successfully',
            }).then(function() {
              

              const jobId = params.get("job_id");

              if(jobId){
                window.location.href = "{{ route('medical-facilities.requirements') }}?job_id="+jobId;
                
              }else{
                window.location.href = "{{ route('medical-facilities.requirements') }}";
              }
              var tab_name = sessionStorage.getItem("tab-one");
              if(tab_name != "job_description"){
                sessionStorage.setItem("tab-one","requirements");
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
          $('#submitJobRequirements').prop('disabled', false);
          $('#submitJobRequirements').text('Save Changes');
          console.log("errorss", errorss);
          
        }
      
        });
      }

      return false;
    }  
  </script>
@endsection