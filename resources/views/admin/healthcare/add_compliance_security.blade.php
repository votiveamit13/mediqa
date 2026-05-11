@extends('admin.layouts.layout')
@section('content')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
                    <h4 class="fw-semibold mb-8">Update Compliance Security</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted " href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Compliance Security</li>
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
            <form method="post" id="compliance_content" onsubmit="return update_compliance_content()">
                @csrf
                
                <div class="form-group level-drp">
                    <label class="form-label" for="input-1">Content
                    </label>
                    
                    <div id="editor_compliance_content"></div>
                    <input type="hidden" name="compliance_content" id="compliance_content_data">
                    
                    <span id='reqcompliance_content' class='reqError text-danger valley'></span>
                </div> 
                <button type="submit" class="btn btn-primary font-medium waves-effect mt-2" id="compliance_submit_btn">
                    Submit 
                </button>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js">
</script>    
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

    var editor_compliance_content = new Quill('#editor_compliance_content', {
    theme: 'snow',
    placeholder: 'Write compliance content',
    modules: {
        toolbar: [
            ['bold','italic','underline'],
            [{ list: 'bullet' }, { list: 'ordered' }],
            ['link']
        ]
    }
});

// Update hidden input whenever editor content changes
editor_compliance_content.root.innerHTML = '@if(!empty($content)){!! $content->compliance_content !!}@endif';
editor_compliance_content.on('text-change', function() {
    $('#compliance_content_data').val(editor_compliance_content.root.innerHTML);
});

    function update_compliance_content(){
        
        $.ajax({
            url: "{{ route('admin.update_compliance_security') }}",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('#compliance_content')[0]),
            dataType: 'json',
            beforeSend: function() {
                $('#compliance_submit_btn').prop('disabled', true);
                $('#compliance_submit_btn').text('Process....');
            },
            success: function(res) {
                $('#compliance_submit_btn').prop('disabled', false);
                $('#compliance_submit_btn').text('Add');
                if (res.status == '1') {

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                    }).then(function() {
                        window.location.href = '{{ route("admin.add_compliance_security") }}';
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
                $('#compliance_submit_btn').prop('disabled', false);
                $('#compliance_submit_btn').text('Add');

                // if (error.responseJSON.errors) {
                //     console.log("errors",error.responseJSON.errors);
                //     if (error.responseJSON.errors) {
                //         $('#editbenefit_nameErr').text(error.responseJSON.errors.benefit_name[0]);
                        
                //     } else {
                //         $('#editbenefit_nameErr').text('');
                        
                //     }
                    
                // }
                
            }
        });

        return false;
    }
</script>
@endsection