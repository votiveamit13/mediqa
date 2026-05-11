@extends('admin.layouts.layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
.add_new_certification_div {
    margin-top: 3rem !important;
    margin-bottom: 1rem !important;
}

button.clear-button {
    position: absolute;
    right: 5px;
    top: 10px;
    background: none;
    border: none;
}

 h6 {
    font-family: "Plus Jakarta Sans", sans-serif;
    font-style: normal;
    font-weight: 700;
    font-size: 16px;
    line-height: 26px;
    color: #000000;
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
    /*position: relative;*/
    left: 0px;
    font-size: 14px;
    line-height: 25px;
    margin-right: 5px;
    color: #000000;
    top: 14px;
}
  span.select2.select2-container {
    padding: 5px !important;
    width: 100% !important;
  }
  .d-none {
    display: none !important;
    /* visibility: hidden !important;; */
  }


  .select2-container--default .select2-selection--multiple {
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

.vacc_rec_div {
    padding-top: 15px;
}

.record_v {
    padding-bottom: 20px;
    border-bottom: solid 1px #80808045;
    margin-bottom: 30px;
}

.row.vacc_rec_institution label {
    line-height: 1.8;
}
.vacc_rec_div .record_v h6 {
    margin-bottom: 0px !important;
}
.extra-info {
    padding-bottom: 15px;
}

.vaccine-section {
    padding-bottom: 20px;
    margin-bottom: 15px;
    border-bottom: solid 1px #80808045;
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
                <ul class="nav nav-pills nav-fill mt-4 tabs-feat" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-1']) }}"
                            aria-selected="true">
                            <span>Basic Details</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-2']) }}" aria-selected="false" >
                            <span>Setting</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-3']) }}" aria-selected="false" >
                            <span>Profession</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-4']) }}" aria-selected="false" >
                            <span>Education and Certifications</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-5']) }}" aria-selected="false" >
                            <span>Experience</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-6']) }}" aria-selected="false" >
                            <span>References</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-7']) }}" aria-selected="false" >
                            <span>Mandatory Training</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" href="{{ route('admin.updateVaccinationRecord', ['id' => $profileData->id ?? null, 'tab' => 'tab-8']) }}" aria-selected="false">
                            <span>Vaccinations</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-9']) }}" aria-selected="false">
                            <span>Work Clearances</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-10']) }}" aria-selected="false" >
                            <span>Professional Memberships</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-11']) }}" aria-selected="false" >
                            <span>Interview</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-12']) }}" aria-selected="false" >
                            <span>Personal Preferences</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-13']) }}" aria-selected="false" >
                            <span>Job Search Preferences</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-14']) }}" aria-selected="false"
                            tabindex="-1">
                            <span>Testimonials and Reviews</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ?? null, 'tab' => 'tab-15']) }}" aria-selected="false" >
                            <span>Additional Information</span>
                        </a>
                    </li>


                </ul>

                <!-- Tab panes -->
                <div class="tab-content border mt-2">
                    <div class="p-3">
                        <div class="row">
                            <div >
                                <div class="card-body p-3 px-md-4 pb-0">
                                    <h3 class="fw-bolder fs-6 lh-base d-flex align-items-center">Vaccinations</h3>
                                </div>
                                <form method="POST" id="edit_vacc_form">
                                <input type="hidden" value="tab6" name="tab">
                                <input type="hidden" value="{{ $profileData->id ?? null }}" name="user_id">
                                <div class="card-body p-3 px-md-4">
                                    <div class="col-md-12">
                                        <div class="row">
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="input-1">Vaccination Records</label>
                                                @php
                                                    $vacc = [];
                                                @endphp

                                                @if(!empty($vaccinationData))
                                                    @foreach($vaccinationData as $vcdata)
                                                        @php $vacc[] = $vcdata->vaccination_id; @endphp
                                                    @endforeach
                                                @endif
                                                <input type="hidden" name="vaccination_r" class="vaccination_r" value="{{ json_encode($vacc) }}">

                                                <ul id="vaccination_record" style="display:none;">
                                                    @foreach($vaccination_record as $v_record)
                                                    <li data-value="{{ $v_record->id }}" data-id="{{ $v_record->name }}">{{ $v_record->name }}</li>
                                                    @endforeach
                                                </ul>
                                                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="vaccination_record" name="vaccination_record[]" multiple="multiple"></select>
                                                <span id="vaccination_error" class="text-danger valley"></span>
                                            </div>
                                        </div>
                                        <div class="vacc_rec_div"></div>

                                        <!--[ADD OTHER VACCINE START]-->
                                        <div class="row" id="vaccine-section-container">
                                            <h6>Other Vaccination </h6>
                                            @php $ci = 1; @endphp
                                                @if($other_vaccine)
                                                @foreach($other_vaccine as $other)
                                                <div class="vaccine-section">
                                                <div class="col-md-12">
                                                    <input type="hidden" name="other_id[]" value="{{$other->id}}">
                                                    <h6>Vaccination {{$ci}}</h6>
                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">Vaccination Name </label>
                                                        <input class="form-control  vaccination-name" type="text" name="vaccination_name[]" value="{{$other->vaccination_name}}">
                                                        <span class="reqError text-danger valley"></span>
                                                    </div>

                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">Immunization Status</label>
                                                        <select class="form-control mr-10 change_clr select-active immunization-status" name="immunization_status[]">
                                                            <option value="" disabled selected>Immunization Status</option>
                                                            <?php
                                                            $get_imm_status = DB::table("imm_status")->get();
                                                            foreach ($get_imm_status as $status) { ?>
                                                                <option value="<?= $status->id ?>" {{$other->immunization_status==$status->id?'selected':''}}><?= htmlspecialchars($status->name) ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="reqError text-danger valley"></span>
                                                    </div>

                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">Evidence Type</label>
                                                        <select class="form-control mr-10 change_clr select-active evidence-type" name="evidence_type[]">
                                                            <option value="" disabled selected>Evidence type</option>
                                                            <option value="Immunization Certificate" {{$other->evidence_type=='Immunization Certificate'?'selected':''}}>Immunization Certificate</option>
                                                            <option value="Vaccination Card/Record" {{$other->evidence_type=='Vaccination Card/Record'?'selected':''}}>Vaccination Card/Record</option>
                                                            <option value="Medical Letter or Certificate from GP" {{$other->evidence_type=='Medical Letter or Certificate from GP'?'selected':''}}>Medical Letter or Certificate from GP</option>
                                                            <option value="Vaccination Record from My Health Record" {{$other->evidence_type=='Vaccination Record from My Health Record'?'selected':''}}>Vaccination Record from My Health Record</option>
                                                            <option value="Serology Test Results" {{$other->evidence_type=='Serology Test Results'?'selected':''}}>Serology Test Results</option>
                                                            <option value="Immunization History Statement from the Australian Immunisation Register (AIR)" {{$other->evidence_type=='Immunization History Statement from the Australian Immunisation Register (AIR)'?'selected':''}}>Immunization History Statement from the Australian Immunisation Register (AIR)</option>
                                                            <option value="Employer or Facility Letter" {{$other->evidence_type=='Employer or Facility Letter'?'selected':''}}>Employer or Facility Letter</option>
                                                        </select>
                                                        <span class="reqError text-danger valley"></span>
                                                    </div>

                                                    <div class="form-group level-drp">
                                                        <label class="form-label" for="input-1">Upload Evidence</label>
                                                        <input class="form-control fileInputo" id="fileInputo" type="file" name="evidence_file[]">
                                                        <div id="fileListo" class="file-list">
                                                        @if($other->evidence_file!='')
                                                            <div class="file-item">
                                                            <a href="{{ asset('uploads/evidence/' . $other->evidence_file) }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i> {{$other->evidence_file}}</a>
                                                            <div class="close_btn close_btn-0 del_eve_f" other_id="{{$other->id}}" style="cursor: pointer;">
                                                                <i class="fa fa-close" aria-hidden="true"></i>
                                                            </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <span class="reqError text-danger valley"></span>
                                                    </div>
                                                </div>
                                                <div class="add_new_certification_div mb-3 mt-3">
                                                    <a style="cursor: pointer;" class="remove-vaccine" other_id="{{$other->id}}">- Delete Vaccine</a>
                                                </div>
                                            </div>
                                            @php $ci++; @endphp
                                            @endforeach
                                            @endif
                                            </div>
                                            <div class="add_new_certification_div mb-3 mt-3">
                                                <a style="cursor: pointer;" id="add-vaccine">+ Add Another Vaccine</a>
                                            </div>
                                            <!--[ADD OTHER VACCINE END]-->

                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <button type="submit" class="btn btn-default  align-items-center justify-content-between" data-target="#navpill-8">Next</button>
                                        </div>
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

    </div>

@endsection
@section('js')

    <script type="text/javascript"
        src="https://nextjs.webwiders.in/pindrow/public/advertiser/dist/libs/owl.carousel/dist/owl.carousel.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>





@include('admin.edit_script');
<script>
    $(document).ready(function(){
        $('.del_eve_f').on('click',function(){
            const other_id=$(this).attr('other_id');
            $.ajax({
                    url: "{{ url('/admin') }}/removeEvidance",
                    type: 'GET',
                    data: { id: other_id }, // Pass the ID as a parameter
                    success: function (response) {

                        $(`.del_eve_f`).closest('.file-item').remove();
                    },
                    error: function (xhr, status, error) {
                        console.error(`Failed to fetch data for ID: `, error);
                    },
                });
        });
    });

     $(document).ready(function() {
    if ($(".vaccination_r").val() != "") {
     var vaccination_record = JSON.parse($(".vaccination_r").val());
     console.log(vaccination_record);
     $('.js-example-basic-multiple[data-list-id="vaccination_record"]').select2().val(vaccination_record).trigger('change');
   }

    function evidance_content() {

        $('.extra-info').hide();

        let selectedValues = $('.js-example-basic-multiple[data-list-id="vaccination_record"]').val() || [];
        console.log('Selected Values content:', selectedValues);

        // Check if the dropdown includes '8'
        if (selectedValues.includes('8')) {
        // Check if the evidence-types radio button with value '3' is selected
        let isEvidenceType3Selected = $('input.evidence-types[value="3"]:checked').length > 0;

        if (isEvidenceType3Selected) {
            $('.extra-info').show();

        } else {
            $('.extra-info').hide(); // Hide the extra-info div if evidence type 3 is not selected

        }
        } else {
        $('.extra-info').hide(); // Hide the extra-info div if dropdown does not include '8'

        }
    }
    $(document).on('click', '.evidence-types', function() {
        evidance_content();
    })
    function initializeVaccinationRecords() {
        let selectedValues = $('.js-example-basic-multiple[data-list-id="vaccination_record"]').val() || []; // Get initially selected values
        console.log('Initial selectedValues:', selectedValues);
        let userId = $('input[name="user_id"]').val();
        // Sort selectedValues to ensure ascending order
        selectedValues.sort((a, b) => a - b);

        // Loop through sorted selected values and make AJAX calls for each ID
        selectedValues.forEach(function (id) {
            // Check if the div for this ID already exists
            if ($(`.vacc_rec_${id}`).length === 0) {
                // Make an AJAX call to fetch the HTML content for this ID
                $.ajax({
                    url: "{{ url('/admin') }}/getVaccinationData",
                    type: 'GET',
                    data: { id: id, user_id: userId }, // Pass the ID as a parameter
                    success: function (response) {
                        // Check if the response contains valid content
                        if (response.html) {
                            // Append the new HTML to the vaccination record container
                            let appended = false;
                            $(".vacc_rec_div > div").each(function () {
                                let existingId = $(this).find("h6").data("id");
                                if (parseInt(existingId) > parseInt(id)) {
                                    $(this).before(response.html); // Insert before the first larger ID
                                    appended = true;
                                    return false; // Break the loop
                                }
                            });
                            if (!appended) {
                                $(".vacc_rec_div").append(response.html); // Append to the end if no larger ID found
                            }
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(`Failed to fetch data for ID: ${id}`, error);
                    },
                });
            }
        });

    }

    // Call the initialization function on page load
    initializeVaccinationRecords();
    evidance_content();

    $('.js-example-basic-multiple[data-list-id="vaccination_record"]').on('change', function () {
        let selectedValues = $(this).val() || []; // Get selected values (IDs)
        console.log('selectedValues : ', selectedValues);

        // Sort selectedValues to ensure ascending order
        selectedValues.sort((a, b) => a - b);

        // Remove divs for deselected IDs
        $(".vacc_rec_div > div").each(function () {
            let id = $(this).find("h6").data("id");
            if (!selectedValues.includes(String(id))) {
                $(this).remove(); // Remove div for deselected ID
            }
        });

        // Loop through sorted selected values and make AJAX calls for new IDs
        selectedValues.forEach(function (id) {
            // Check if the div for this ID already exists
            if ($(`.vacc_rec_${id}`).length === 0) {
                // Make an AJAX call to fetch the HTML content for this ID
                $.ajax({
                    url: "{{ url('/admin') }}/getVaccinationData",
                    type: 'GET',
                    data: { id: id }, // Pass the ID as a parameter
                    success: function (response) {
                        // Check if the response contains valid content
                        if (response.html) {
                            // Append the new HTML to the vaccination record container
                            let appended = false;
                            $(".vacc_rec_div > div").each(function () {
                                let existingId = $(this).find("h6").data("id");
                                if (parseInt(existingId) > parseInt(id)) {
                                    $(this).before(response.html); // Insert before the first larger ID
                                    appended = true;
                                    return false; // Break the loop
                                }
                            });
                            if (!appended) {
                                $(".vacc_rec_div").append(response.html); // Append to the end if no larger ID found

                            }
                            evidance_content();
                            initializeFileUpload();
                        }

                    },
                    error: function (xhr, status, error) {
                        console.error(`Failed to fetch data for ID: ${id}`, error);
                    },
                });
            }
        });
        evidance_content();
    });
});
function initializeFileUpload() {
    $(".fileInput").each(function () {

    const fileInput = $(this);
    const fileList = $(`#fileList${fileInput.attr("id").replace("fileInput", "")}`);
    const selectedFiles = new DataTransfer();

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

$(document).ready(function () {
        // Function to add a new vaccine section
        let i = <?php echo count($other_vaccine)+1 ?>;
        $('#add-vaccine').click(function () {

            $('#vaccine-section-container').append(`<div class="vaccine-section">
                              <div class="col-md-12">
                              <h6>Vaccination ${i}</h6>
                                  <div class="form-group level-drp">
                                      <label class="form-label" for="input-1">Vaccination Name</label>
                                      <input class="form-control vaccination-name" type="text" name="vaccination_name[]" value="">
                                      <span class="reqError text-danger valley"></span>
                                  </div>

                                  <div class="form-group level-drp">
                                      <label class="form-label" for="input-1">Immunization Status</label>
                                      <select class="form-control mr-10 change_clr immunization-status" name="immunization_status[]">
                                          <option value="" disabled selected>Select Immunization Status</option>
                                          <?php
                                          $get_imm_status = DB::table("imm_status")->get();
                                          foreach ($get_imm_status as $status) { ?>
                                              <option value="<?= $status->id ?>" ><?= htmlspecialchars($status->name) ?></option>
                                          <?php } ?>
                                      </select>
                                      <span class="reqError text-danger valley"></span>
                                  </div>

                                  <div class="form-group level-drp">
                                      <label class="form-label" for="input-1">Evidence Type</label>
                                      <select class="form-control mr-10 change_clr evidence-type" name="evidence_type[]">
                                          <option value="" disabled selected>Select Evidence type</option>
                                          <option value="Immunization Certificate" >Immunization Certificate</option>
                                          <option value="Vaccination Card/Record" >Vaccination Card/Record</option>
                                          <option value="Medical Letter or Certificate from GP" >Medical Letter or Certificate from GP</option>
                                          <option value="Vaccination Record from My Health Record" >Vaccination Record from My Health Record</option>
                                          <option value="Serology Test Results" >Serology Test Results</option>
                                          <option value="Immunization History Statement from the Australian Immunisation Register (AIR)" >Immunization History Statement from the Australian Immunisation Register (AIR)</option>
                                          <option value="Employer or Facility Letter" >Employer or Facility Letter</option>
                                      </select>
                                      <span class="reqError text-danger valley"></span>
                                  </div>

                                  <div class="form-group level-drp">
                                      <label class="form-label" for="input-1">Upload Evidence</label>
                                      <input class="form-control evidence-file" type="file" name="evidence_file[]">
                                      <span class="reqError text-danger valley"></span>
                                  </div>
                              </div>
                              <div class="add_new_certification_div mb-3 mt-3">
                                <a style="cursor: pointer;" class="remove-vaccine">- Delete Vaccine</a>
                              </div>

                          </div>`);
                          i++;
        });

        // Function to remove a vaccine section
        $(document).on('click', '.remove-vaccine', function () {

          const otherId = $(this).attr('other_id');

          if (otherId)
          {

            $.ajax({
              url: "{{ url('/admin') }}/removeVaccine",
                type: 'POST',
                data: {
                  _token: "{{ csrf_token() }}",
                    id: otherId
                },
                success: function (response)
                {
                    if (response.success) {
                        // On successful deletion from the database, remove the HTML
                        alert('Vaccine removed successfully!');
                        $(this).closest('.vaccine-section').remove();

                        $('#vaccine-section-container .vaccine-section').each(function (index) {
                            $(this).find('h6').text(`Vaccination ${index + 1}`);
                        });

                        // Adjust the counter to reflect the number of vaccine sections + 1
                        i = $('#vaccine-section-container .vaccine-section').length + 1;
                    } else {
                        alert('Failed to remove vaccine. Please try again.');
                    }
                }.bind(this), // Bind `this` to refer to the button element
                error: function () {
                    alert('An error occurred. Please try again.');
                }
            });
        } else {
            // If `other_id` is not present, just remove the HTML
            $(this).closest('.vaccine-section').remove();
            $('#vaccine-section-container .vaccine-section').each(function (index) {
                $(this).find('h6').text(`Vaccination ${index + 1}`);
            });

            // Adjust the counter to reflect the number of vaccine sections + 1
            i = $('#vaccine-section-container .vaccine-section').length + 1;
        }
  });

  $('.js-example-basic-multiple').on('select2:open', function() {
      var searchBoxHtml = `
                    <div class="extra-search-container">
                        <input type="text" class="form-control  extra-search-box" placeholder="Search...">
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
@endsection
