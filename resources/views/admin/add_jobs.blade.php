@extends('admin.layouts.layout')
@section('content')
<style>
    .select2-container{
        width:100% !important;
    }
</style>
<div class="container-fluid">
    <div class="back_arrow" onclick="history.back()" title="Go Back">
        <i class="fa fa-arrow-left"></i>
    </div>
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Add Jobs</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted " href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Add Jobs</li>
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
            <form method="post" id="AddJobs" onsubmit="return addJobs()">
                @csrf
                <div class="form-group">
                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Type of Nurse</strong></label>
                    <ul id="type-of-nurse" style="display:none;">
                        <?php
                            $nurse_type_list = DB::table("practitioner_type")->where("status","1")->get();
                            $j = 1;
                        ?>
                        @foreach($nurse_type_list as $nurse_type)
                        <li id="nursing_menus-{{ $j }}" data-value="{{ $nurse_type->id }}">{{ $nurse_type->name }}</li>
                        <?php
                            $j++;
                        ?>
                        @endforeach

                    </ul>
                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="type-of-nurse" name="nurse_type[]" multiple="multiple" id="type_nurse"></select>
                    
                </div>
                <div class="form-group">
                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Speciality</strong></label>
                    <ul id="type-of-speciality" style="display:none;">
                        <?php
                            $speciality = DB::table("speciality")->where("status","1")->get();
                            $j = 1;
                        ?>
                        @foreach($speciality as $nurse_speciality)
                        <li id="nursing_menus-{{ $j }}" data-value="{{ $nurse_type->id }}">{{ $nurse_speciality->name }}</li>
                        <?php
                            $j++;
                        ?>
                        @endforeach

                    </ul>
                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="type-of-speciality" name="typeofspeciality[]" multiple="multiple" id="type_nurse"></select>
                    
                </div>
                <div class="form-group">
                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Location</strong></label>
                    <input type="text" class="form-control" name="location_name"
                                id="edit_location_name">
                </div>
                <div class="form-group">
                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Agency Name</strong></label>
                    <input type="text" class="form-control" name="agency_name"
                                id="edit_agency_name">
                </div>
                <div class="form-group">
                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Experience Required</strong></label>
                    <select class="form-control" name="experience_level">
                        <option value="">Please Select</option>
                        @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                          @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Sector</strong></label>
                    <select class="form-control" name="sector">
                        <option value="">Please Select</option>
                        <option value="Public & Government">Public & Government</option>
                        <option value="Private">Private</option>
                        <option value="Public Government & Private">Public Government & Private</option>
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Position</strong></label>
                    <ul id="emplyeement_positions" style="display:none;">
                        <?php
                            $getPosition = DB::table("employee_positions")->get();
                            $j = 1;
                        ?>
                        @foreach($getPosition as $getPos)
                        <li id="nursing_menus-{{ $j }}" data-value="{{ $getPos->position_id }}">{{ $getPos->position_name }}</li>
                        <?php
                            $j++;
                        ?>
                        @endforeach

                    </ul>
                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="emplyeement_positions" name="emplyeement_positions[]" multiple="multiple" id="type_nurse"></select>
                    
                </div>
                <div class="form-group">
                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Employment Type</strong></label>
                    <ul id="emplyeement_type" style="display:none;">
                        <?php
                            $getEmployeementType = DB::table("employeement_type_preferences")->get();
                            $j = 1;
                        ?>
                        @foreach($getEmployeementType as $getEmployeement)
                        <li id="nursing_menus-{{ $j }}" data-value="{{ $getEmployeement->emp_prefer_id }}">{{ $getEmployeement->emp_type }}</li>
                        <?php
                            $j++;
                        ?>
                        @endforeach

                    </ul>
                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="emplyeement_type" name="emplyeement_type[]" multiple="multiple" id="type_nurse"></select>
                    
                </div>
                <div class="form-group">
                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Shift Type</strong></label>
                    <ul id="shift_type" style="display:none;">
                        <?php
                            $shiftType = DB::table("work_shift_preferences")->get();
                            $j = 1;
                        ?>
                        @foreach($shiftType as $shiftTy)
                        <li id="nursing_menus-{{ $j }}" data-value="{{ $shiftTy->work_shift_id }}">{{ $shiftTy->shift_name }}</li>
                        <?php
                            $j++;
                        ?>
                        @endforeach

                    </ul>
                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="shift_type" name="shift_type[]" multiple="multiple" id="type_nurse"></select>
                    
                </div>
                <div class="form-group">
                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Work Environment</strong></label>
                    <ul id="work_environment" style="display:none;">
                        <?php
                            $getWorkEnvironment = DB::table("work_enviornment_preferences")->get();
                            $j = 1;
                        ?>
                        @foreach($getWorkEnvironment as $getWork)
                        <li id="nursing_menus-{{ $j }}" data-value="{{ $getWork->prefer_id }}">{{ $getWork->env_name }}</li>
                        <?php
                            $j++;
                        ?>
                        @endforeach

                    </ul>
                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="work_environment" name="work_environment[]" multiple="multiple" id="type_nurse"></select>
                    
                </div>
                <div class="form-group">
                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Benefits</strong></label>
                    <ul id="benefits" style="display:none;">
                        <?php
                            $benefits_preferences = DB::table("benefits_preferences")->get();
                            $j = 1;
                        ?>
                        @foreach($benefits_preferences as $benefits)
                        <li id="nursing_menus-{{ $j }}" data-value="{{ $benefits->benefits_id }}">{{ $benefits->benefits_name }}</li>
                        <?php
                            $j++;
                        ?>
                        @endforeach

                    </ul>
                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="benefits" name="benefits[]" multiple="multiple" id="type_nurse"></select>
                    
                </div>
                <div class="form-group">
                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Salary</strong></label>
                    <input type="text" class="form-control" name="salary">
                </div>    
                <div class="form-group">
                    <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Application Submission Date</strong></label>
                    <input type="date" class="form-control" name="application_submission_date">
                </div>    
                <div class="form-group">
                    <input type="checkbox" name="urgent_hire_tag">Urgent Hire
                </div>

                <button type="submit" class="btn btn-primary font-medium waves-effect" id="job_submit_btn">
                            Submit 
                        </button>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

    function addJobs(){
        $.ajax({
            url: "{{ route('admin.addJobs') }}",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('#AddJobs')[0]),
            dataType: 'json',
            beforeSend: function() {
                $('#job_submit_btn').prop('disabled', true);
                $('#job_submit_btn').text('Process....');
            },
            success: function(res) {
                $('#job_submit_btn').prop('disabled', false);
                $('#job_submit_btn').text('Add ');
                if (res.status == '1') {

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                    }).then(function() {
                        window.location.href = '{{ route("admin.add_jobs") }}';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: res.message,
                    })
                }
            },
            error: function(error) {
                $('#job_submit_btn').prop('disabled', false);
                $('#job_submit_btn').text('Add');

                if (error.responseJSON.errors) {
                    console.log("errors",error.responseJSON.errors);
                    if (error.responseJSON.errors) {
                        $('#editbenefit_nameErr').text(error.responseJSON.errors.benefit_name[0]);
                        
                    } else {
                        $('#editbenefit_nameErr').text('');
                        
                    }
                    
                }
                
            }
        });

        return false;
    }
</script>
@endsection