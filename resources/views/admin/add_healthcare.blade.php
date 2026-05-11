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
                    <h4 class="fw-semibold mb-8">Add Healthcare</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted " href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Add Healthcare</li>
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
               <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                  <label class="form-label" for="fullname">Hospital Name *</label>
                  <input type="hidden" name="user_id" value="@if(!empty($user_data)) {{ $user_data->id }}@endif">
                  <input class="form-control" id="fullname" type="text" name="hospital_name" value="@if(!empty($user_data)) {{ $user_data->name }}@endif">
                  <span id="reqfullname" class="reqError valley"></span>
                </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                      <label class="form-label" for="emailaddress">Email address *</label>
                      <input class="form-control" id="emailaddress" type="email" name="emailaddress" value="@if(!empty($user_data)) {{ $user_data->email }}@endif">
                      <span id="reqemailaddress" class="reqError valley"></span>
                    </div>
                  </div>
                  <!-- <div class="col-md-6">
                    <div class="form-group">
                  <label class="form-label" for="mobile_no">Mobile Number *</label>
                  <input class="form-control" id="mobile_no" type="text" name="mobile_no">
                  <span id="reqmobile_no" class="reqError valley"></span>
                </div>
                  </div> -->
                  <!-- <div class="col-md-6">
                    <div class="form-group">
                  <label class="form-label" for="post_code">Post Code *</label>
                  <input class="form-control" id="post_code" type="text" name="post_code">
                  <span id="reqpost_code" class="reqError valley"></span>
                </div>
                  </div> -->


                  <!-- <div class="col-md-12">
                    <div class="form-group">
                  <label class="form-label" for="address">Address</label>
                  <textarea class="form-control" id="address" rows="2" name="address"></textarea>
                  <span id="reqaddress" class="reqError valley"></span> -->
                  <!-- <input class="form-control" id="input-4" type="text" required="" name="password" placeholder="123456"> -->
                  <!-- </div>
                </div> -->

                  <div class="col-md-6">
                    <div class="form-group">
                  <label class="form-label" for="password">Password *</label>
                  <input class="form-control" id="password" type="password" name="password">
                  <span id="reqpassword" class="reqError valley"></span>
                </div>
                
                  </div>
                  <div class="col-md-6">
                  <div class="form-group level-drp">
                      <label class="form-label" for="input-1">Operating Country
                      </label>
                      <select class="form-control form-select country_dropdown" name="country" id="countryI">
                        <option value="">Select Country</option>
                        @php $country_data=country_name_from_db();@endphp
                        @foreach ($country_data as $data)
                        <option value="{{$data->iso2}}" @if(!empty($user_data) && $user_data->country_iso == $data->iso2) selected @endif> {{$data->name}} </option>
                        @endforeach
                      </select>
                      <span id='reqcountry' class='reqError text-danger valley'></span>
                      
                    </div>
                </div>
                
                  </div>
                  
                </div>
                </div>
                
               
                 <div class="d-flex align-items-center justify-content-between">
                
              <button class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" style="width:100%" id="healthcare_registration_btn" type="submit"><span class="resetpassword">Submit &amp; Register</span>
                    <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                      <span class="sr-only">Loading...</span>
                    </div>
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
            url: "{{ route('admin.post_healthcare') }}",
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
                        text: 'Helathcare user added successfully',
                    }).then(function() {
                        window.location.href = '{{ route("admin.add_healthcare") }}';
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