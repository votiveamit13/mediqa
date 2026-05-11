@extends('admin.layouts.layout')

@section('content')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
 </style>   

<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Plan Management</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted " href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Add Plans</li>
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
        <div class="card-header pb-0 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title fw-semibold mb-0">Add
                        Plans</h5>
                </div>
                
            </div>
        </div>
        <div class="card w-100  overflow-hidden ">
            <div class="card-body p-3 px-md-4">
                <form method="post" id="plan_form" onsubmit="return planForm()">
                    @csrf
                    @php
                        if(!empty($product)){
                            foreach($prices->data as $price){
                                $price1 = $price->unit_amount / 100;
                                $price_id = $price->id;
                            }
                            
                        }else{
                            $price1 = "";
                            $price_id = "";
                        }
                    @endphp
                    <input type="hidden" name="plan_id" value="@if(!empty($product)) {{ $product->plan_id }} @endif">
                    <input type="hidden" name="product_id" value="@if(!empty($product)) {{ $product->stripe_product_id }} @endif">
                    <input type="hidden" name="price_id" value="{{ $price_id }}">
                    <div class="form-group">
                        <input type="hidden" name="product_id" value="@if(!empty($product)) {{ $product->stripe_product_id }} @endif">
                        
                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Plan Name</strong></label>
                        <input type="text" class="form-control" placeholder="Plan Name" name="plan_name" id="plan_name" value="@if(!empty($product)) {{ $product->name }}@endif">
                        <span id="date_error" class="reqError text-danger valley "></span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Slug</strong></label>
                        <input type="text" class="form-control" placeholder="Slug" name="slug" id="slug" value="@if(!empty($product)) {{ $product->slug }}@endif">
                        <span id="date_error" class="reqError text-danger valley "></span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Description</strong></label>
                        <div id="editor_key_description"></div>
                        <input type="hidden" name="description" id="description">
                        <span id="date_error" class="reqError text-danger valley "></span>
                    </div>
                    <div class="form-group mt-2">
                        @php
                            if(!empty($product)){
                                $price_data = DB::table("stripe_prices")->where("stripe_price_id",$product->default_price_id)->first();
                                $unit_amount = $price_data->unit_amount/100;
                            }else{
                                $price_data = "";
                                $unit_amount = "";
                            }
                            
                        @endphp
                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Monthly Price ($)</strong></label>
                        <input type="number" class="form-control" placeholder="Monthly Price ($)" name="plan_monthly_price" id="plan_monthly_price" value="@if(!empty($product)){{ $unit_amount }}@endif">
                        <span id="date_error" class="reqError text-danger valley "></span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Yearly Price ($)</strong></label>
                        <input type="number" class="form-control" placeholder="Yearly Price ($)" name="plan_yearly_price" id="plan_yearly_price" value="@if(!empty($product)){{ $product->yearly_price }}@endif">
                        <span id="date_error" class="reqError text-danger valley "></span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Trial Days</strong></label>
                        <input type="number" class="form-control" placeholder="Trial Days" name="trial_days" id="trial_days" value="@if(!empty($product)){{ $product->trial_days }}@endif">
                        <span id="date_error" class="reqError text-danger valley "></span>
                    </div>

                    <div class="form-group mt-2">
                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Employer Types</strong></label>
                        @php
                               $employer_data = DB::table("employer_type")->where("status","1")->get(); 

                               if(!empty($product)){
                                $employer_types = json_decode($product->employer_types);

                                $emp_name_arr = [];
                                if(!empty($employer_types)){
                                    foreach($employer_types as $emp_type){
                                    
                                        $emp_name_arr[] = $emp_type;
                                    }
                                }
                                

                                $emparrjson = json_encode($emp_name_arr);
                               }else{
                                $emparrjson = "";
                               }     
                               //print_r($emp_arr);
                            @endphp
                            <input type="hidden" name="" class="employer_types" value="{{ $emparrjson }}">    
                        <ul id="employer_types" style="display:none;">
                            
                            @if(!empty($employer_data))
                            @foreach($employer_data as $emp_data)
                            <li data-value="{{ $emp_data->id }}">{{ $emp_data->name }}</li>
                            @endforeach
                            @endif
                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn facworktype facworktype-1" data-list-id="employer_types" name="employer_types[]" multiple></select>
                        <span id="date_error" class="reqError text-danger valley "></span>
                    </div>
                    
                    <div class="form-group mt-2">
                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Key Features</strong></label>
                        <div id="editor_key_features"></div>
                                <input type="hidden" name="key_features" id="key_features">
                        <span id="date_error" class="reqError text-danger valley "></span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Job Limit</strong></label>
                        <input type="number" class="form-control" placeholder="Job Limit" name="job_limit" id="job_limit" value="@if(!empty($product)){{ $product->job_limits }}@endif">
                        <span id="date_error" class="reqError text-danger valley "></span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="skill" class="d-flex gap-3 flex-wrap">
                            <input type="checkbox" name="unlimited_jobs" @if(!empty($product) && $product->unlimited_jobs == 1) checked @endif>
                            <strong>Unlimited Jobs</strong>
                        </label>
                        
                        <span id="date_error" class="reqError text-danger valley "></span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Recruiter Limit</strong></label>
                        <input type="number" class="form-control" placeholder="Recruiter Limit" name="recruiter_limit" id="recruiter_limit" value="@if(!empty($product)){{ $product->recruiter_limits }}@endif">
                        <span id="date_error" class="reqError text-danger valley "></span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="skill" class="d-flex gap-3 flex-wrap">
                            <input type="checkbox" name="unlimited_recruiters" @if(!empty($product) && $product->unlimited_recruiter == 1) checked @endif>
                            <strong>Unlimited Recruiters</strong>
                        </label>
                        
                        <span id="date_error" class="reqError text-danger valley "></span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Status</strong></label>
                        <select name="status" class="form-control">
                            <option value="1" @if(!empty($product) && $product->active == 1) selected @endif>Active</option>
                            <option value="0" @if(!empty($product) && $product->active == 0) selected @endif>Inactive</option>
                        </select>
                        <span id="date_error" class="reqError text-danger valley "></span>
                    </div>
                    <!-- <div class="form-group">
                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Sort Order</strong></label>
                        <input type="number" class="form-control" placeholder="Sort Order" name="sort_order" id="sort_order">
                        <span id="date_error" class="reqError text-danger valley "></span>
                    </div> -->
                    @php
                        if(!empty($product)){
                            $selectedInterval = $price_data->interval;
                        }else{
                            $selectedInterval = "";
                        }
                    @endphp
                    <div class="form-group mt-2">
                        <label for="skill" class="d-flex gap-3 flex-wrap"><strong>Billing Cycle Enabled</strong></label>
                        <select name="billing_cycle_enabled" class="form-control">
                            <option value="month" {{ $selectedInterval == 'month' ? 'selected' : '' }}>Monthly</option>
                            <option value="year" {{ $selectedInterval == 'year' ? 'selected' : '' }}>Yearly</option>
                        </select>
                        <span id="date_error" class="reqError text-danger valley "></span>
                    </div>
                    <button type="submit" class="btn btn-primary font-medium waves-effect mt-2" id="plan_submit_btn">
                        Submit 
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

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
    var editor_key_features = new Quill('#editor_key_features', {
        theme: 'snow',
        placeholder: 'Enter Key Features',
        modules: {
            toolbar: [
                ['bold','italic','underline'],
                [{ list: 'bullet' }, { list: 'ordered' }],
                ['link']
            ]
        }
    });

    editor_key_features.root.innerHTML = "@if(!empty($product) && isset($product->features)){!! $product->features !!} @endif";
    $('#key_features').val(editor_key_features.root.innerHTML);

    
    var editor_key_description = new Quill('#editor_key_description', {
        theme: 'snow',
        placeholder: 'Enter Description',
        modules: {
            toolbar: [
                ['bold','italic','underline'],
                [{ list: 'bullet' }, { list: 'ordered' }],
                ['link']
            ]
        }
    });

    editor_key_description.root.innerHTML = "@if(!empty($product) && isset($product->description)){!! $product->description !!} @endif";
    $('#description').val(editor_key_description.root.innerHTML);

    function planForm(){
        
        $('#key_features').val(editor_key_features.root.innerHTML);
        $('#description').val(editor_key_description.root.innerHTML);
        $.ajax({
            url: "{{ route('admin.updatePlan') }}",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('#plan_form')[0]),
            dataType: 'json',
            beforeSend: function() {
                $('#plan_submit_btn').prop('disabled', true);
                $('#plan_submit_btn').text('Process....');
            },
            success: function(res) {
                $('#plan_submit_btn').prop('disabled', false);
                $('#plan_submit_btn').text('Add ');
                if (res.status == '1') {

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "Plan added successfully",
                    }).then(function() {
                        if(res.product_id){
                            var product_id = res.product_id;
                            //.location.href = '{{ route("admin.update_plans",["id"=>'+product_id+']) }}';
                        }else{
                            window.location.href = '{{ route("admin.add_plans") }}';
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
            error: function(error) {
                $('#plan_submit_btn').prop('disabled', false);
                $('#plan_submit_btn').text('Add');

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

    if ($(".employer_types").val() != "") {
      var employer_types = JSON.parse($(".employer_types").val());
      console.log("employer_types",employer_types);
      $('.js-example-basic-multiple[data-list-id="employer_types"]').select2().val(employer_types).trigger('change');
    }
</script>
@endsection