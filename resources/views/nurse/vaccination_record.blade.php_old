<div class="vacc_rec_{{ $id }}">

    <h6 class="vacc_rec_head_{{ $id }}" data-id="{{ $id }}">{{ $vaccination->name }}</h6>
    <input type="hidden" name="vaccination_id[]" class="vacc_rec_input_{{ $id }}" value="{{ $id }}">
    <input type="hidden" name="record_id[{{ $id }}][]" value="{{$vaccination_data!=''?$vaccination_data->id:''}}">
    <div class="row vacc_rec_institution">
        <!-- Level of Requirement -->
        @if($id!=12)
        <div class="extra-info" style="margin-top: 10px;">
            <label>If vaccination records are missing, a NSW Health Hepatitis B Vaccination Declaration form, signed by an approved assessor, may be accepted in certain cases. However, it is not sufficient by itself; additional evidence, such as serology results showing immunity, is usually required for full compliance
                <br>
                <a href="https://www.health.nsw.gov.au/immunisation/Documents/Occupational/appendix-9-declaration.pdf" style="
                        color: #0662bb; text-decoration: underline; font-weight: 800;">appendix-9-declaration</a>
            </label>
        </div>
        @else
        <div class="extra-info-covid" style="margin-top: 10px;">
            <label>The COVID-19 vaccination mandate for healthcare workers has been revoked across all states. However, individual healthcare employers, especially those in high-risk settings, may still enforce vaccination policies based on their risk assessments and workplace safety regulations. Nurses and midwives may therefore be required to stay up to date with their COVID-19 vaccinations by specific employers
                <br>
            </label>
        </div>
        @endif

        <div class="form-group col-md-12">
            <label class="form-label">Level of Requirement : </label>
            <div>
                @foreach ($vcc_level_req as $level)
                    <label>{{ $level->level_req }}</label><br>
                @endforeach
            </div>
        </div>

        <!-- Immunization Status -->
        <div class="form-group col-md-12">
            <label class="form-label">Immunization Status</label>
            <select class="form-control mid_spe_status immunization-status" name="imm_status_status[{{ $id }}][]">
                <option value="">Select Immunization Status</option>
                @foreach ($imm_status as $status)
                    <option value="{{ $status->id }}" {{$vaccination_data!=''?($vaccination_data->immunization_status==$status->id?'selected':''):''}}>{{ $status->name }}</option>
                @endforeach
            </select>
            <span class="reqError text-danger valley"></span>
        </div>
        <div class="form-group col-md-12" style="display: {{$id == 12 ? 'block' : 'none'}}">
            <label class="form-label" for="dose-${i}">How many doses of a TGA-recognised COVID-19 vaccine have you received?</label>
            <select class="form-control mid_spe_status" id='covid-dose' name="covid_dose[{{$id}}]"  onchange="handleDoseChange(this, {{ $id }})">
                <option value="None">None</option>
                <option value="1" {{$vaccination_data!=''?($vaccination_data->covid_dose==1?'selected':''):''}}>1 dose</option>
                <option value="2" {{$vaccination_data!=''?($vaccination_data->covid_dose==2?'selected':''):''}}>2 dose</option>
                <option value="3" {{$vaccination_data!=''?($vaccination_data->covid_dose==3?'selected':''):''}}>3 dose</option> 
                <option value="4" {{$vaccination_data!=''?($vaccination_data->covid_dose==4?'selected':''):''}}>4 dose</option>
                <option value="5" {{$vaccination_data!=''?($vaccination_data->covid_dose==5?'selected':''):''}}>5 dose</option>
                <option value="6" {{$vaccination_data!=''?($vaccination_data->covid_dose==6?'selected':''):''}}>6 dose</option>
            </select>
            <span id="coviddosevalid" class="reqError text-danger valley"></span>
        </div>
        <!-- Evidence Required -->
        @if($id!=12)
        <div class="col-md-12" >
            <label class="form-label">Evidence Required:</label>
            <div>
                @foreach ($evidence_types as $evidence)
                    <input type="radio" class="evidence-types" name="evidence_required[{{ $id }}][]" value="{{ $evidence->id }}" {{$vaccination_data!=''?($vaccination_data->evidance_type==$evidence->id?'checked':''):''}}>
                    <label>{{ $evidence->name }}</label><br>
                @endforeach
            </div>
            <span class="reqError text-danger valley"></span>
        </div>
        
        @endif
        @if($id==12)
        <div class="col-md-12" id="evidence_required_container">
            <label class="form-label">Evidence Required:</label>
            <div id="evidence_div">
                <?php
                if($vaccination_data!='' && $vaccination_data->covid_dose!=0){
                    $evidences = DB::table("evidence_type")->where('dose', $vaccination_data->covid_dose)->get();
                    foreach ($evidences as $evidence1){ ?>
                    <input type="radio" class="evidence-required" name="evidence_required[{{ $id }}][]" value="{{ $evidence1->id }}" {{$vaccination_data!=''?($vaccination_data->evidance_type==$evidence1->id?'checked':''):''}}>
                    <label>{{ $evidence->name }}</label><br>
                    <?php }
                }
                ?>
            </div>
            <span class="reqError text-danger valley"></span>
        </div>
        @endif
        
        <!-- Evidence Upload -->
        <div class="form-group col-md-12">
            <label class="form-label">Upload Evidence</label>
            <input class="form-control fileInput" id="fileInput{{ $id }}" type="file" name="evidancefile{{ $id }}[]" multiple>
            <div id="fileList{{ $id }}" class="file-list">
            <?php
                if($vaccination_data!='')
                {
                    $vcc_front_id=$vaccination_data->id;
                    $getevidancedata = DB::table("evidance_file")->where("vcc_front_id", $vcc_front_id)->get();
                    if($getevidancedata->isNotEmpty())
                    {
                        foreach($getevidancedata as $vals)
                        {
                        ?>
                            <div class="file-item">
                                <a href="{{ asset('uploads/evidence/' . $vals->file_name) }}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i> {{$vals->original_name}}</a>
                                <div class="close_btn close_btn-0 del_eve" eve_id="{{$vals->id}}" style="cursor: pointer;">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </div>
                            </div>
                        <?php
                        }
                    }
                }
            ?>
            </div>
        </div>
    </div>
</div>
<script>
    $('.del_eve').on('click',function(){
        const eve_id = $(this).attr('eve_id');
        $.ajax({
                url: "{{ url('/nurse') }}/removeEvidanceFile", 
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

    // Handle change event for dose selection
    function handleDoseChange(selectElement, i) {
        
    const selectedDose = selectElement.value; // Get the selected dose value
    const evidenceRequiredContainer = $(`#evidence_required_container`);
    const evidenceRequiredDiv = $(`#evidence_div`);
    
    // If "None" is selected, hide the evidence section
    if (selectedDose === "None") {
        evidenceRequiredContainer.hide(); // Hide the evidence container
        evidenceRequiredDiv.html(''); // Clear the evidence options
    } else {
        // Show the evidence section
        evidenceRequiredContainer.show();

        // Clear previous evidence before adding new ones
        evidenceRequiredDiv.html('');
        const  selectedEvidenceId=<?php echo $vaccination_data!=''?$vaccination_data->evidance_type:'' ?>
        
        // Fetch evidence types dynamically
        const evidenceTypes = <?php echo json_encode(DB::table("evidence_type")->where('type', 12)->get()); ?>;
        
        // Populate the evidence section dynamically
        
        $.each(evidenceTypes, function (index, data) {
            if (data.dose == selectedDose) { 
                // Match dose with the selected value
                evidenceRequiredDiv.append(`
                    <input type="radio" class="evidence-required" id="evidence_re-${index}-${i}" name="evidence_required[${data.type}][]" value="${data.id}" ${data.id == selectedEvidenceId ? 'checked' : ''}>
                    <label for="evidence_re-${index}-${i}">${data.name}</label><br>
                `);
            }
        });

        // If no evidence options found, display a fallback message
        if (evidenceRequiredDiv.html() === '') {
            evidenceRequiredDiv.append('<p>No evidence required for this dose.</p>');
        }
    }
}

    </script>