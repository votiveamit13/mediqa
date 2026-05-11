@extends('nurse.layouts.layout')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ url('/public') }}/nurse/assets/css/jquery.ui.datepicker.monthyearpicker.css">
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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

form#job_posting_form ul.select2-selection__rendered {
    box-shadow: none;
    max-height: inherit;
    border: none;
    position: relative;
  }

  .clear-btn{
    visibility: hidden;
  }


.ql-toolbar{
  border-radius:8px 8px 0 0;
}
.ql-container{
  border-radius:0 0 8px 8px;
  min-height:180px;
}

.trans_img1{
    margin-bottom: 5px;
    display: flex;
  }

  .trans_img1 .close_btn i {
    margin-left: 10px;
    line-height: 22px;
  }

  .trans_img1 i.fa {
    position: relative;
    left: 0px;
    font-size: 14px;
    line-height: 25px;
    margin-right: 5px;
    color: #000000;
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
                      <h3 class="mt-0 color-brand-1 mb-2">Job Description</h3>
    
                        <form id="job_description_form" method="POST" onsubmit="return job_description_form()">
                            @csrf
                            <div class="form-group level-drp">
                                <label class="form-label" for="input-1">About the Role
                                </label>
                                <input type="hidden" name="job_id" value="{{ $job_id }}">
                                <input type="hidden" name="job_id" id="job_id" value="{{ $job_id }}">
                                <div id="editor_role"></div>
                                <input type="hidden" name="about_role" id="about_role">
                                
                                <span id='reqabout_role' class='reqError text-danger valley'></span>
                            </div> 
                            <div class="form-group level-drp">
                                <label class="form-label" for="input-1">Key Responsibilities
                                </label>
                                <div id="editor_responsiblities"></div>
                                <input type="hidden" name="key_responsiblities" id="key_responsiblities">
                                
                                <span id='' class='reqError text-danger valley'></span>
                            </div> 
                            <div class="form-group level-drp">
                                <label class="form-label" for="input-1">Role-Specific Work Environment Notes
                                </label>
                                <div id="editor_role_specific"></div>
                                <input type="hidden" name="role_specific" id="role_specific">
                                
                                <span id='' class='reqError text-danger valley'></span>
                            </div>      
                            <div class="form-group level-drp">
                                <label class="form-label" for="input-1">Contact Person
                                </label>
                                
                                <input class="form-control contact_person" type="text" name="contact_person" value="{{ $job_data->contact_person_role }}" id="contact_person">
                                <span id='reqcontact_person' class='reqError text-danger valley'></span>
                            </div>  

                            <div class="form-group">
                                <label>Attachments</label>
                                <input type="hidden" name="job_attachments_file" class="job_attachments_file" value="{{ $job_data->attachments }}">
                                <input type="file"
                                  class="form-control job_attachments"
                                  multiple onchange="changeAttachment({{ $job_data->id }})">
                                <div class="job_attachments_imgs">
                                  <?php
                                    
                                      if($job_data->attachments != NULL){
                                        $evidence_imgs = (array)json_decode($job_data->attachments);
                                        

                                        if(isset($evidence_imgs)){
                                          $evorgimg = $evidence_imgs;
                                        }else{
                                          $evorgimg = array();
                                        }
                                        //print_r($evorgimg);
                                        $i = 0;
                                        ?>
                                        @if(!empty($evorgimg))
                                        @foreach ($evorgimg as $ev_img)
                                        <div class="trans_img1 trans_img1-{{ $i+1 }}">
                                          <a href=""><i class="fa fa-file" aria-hidden="true"></i>{{ $ev_img }}</a>
                                          <div class="close_btn close_btn-' + i + '" onclick="deleteAwardEvidenceImg({{ $i+1 }},{{ $job_data->id }},'{{ $ev_img }}')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                        </div>
                                        <?php
                                          $i++;
                                        ?>
                                        @endforeach
                                        @endif
                                        <?php
                                      }
                                      //print_r($evidence_imgs);
                                    ?>
                                </div>
                            </div>
                            
                            <div class="box-button mt-15">
                                <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitJobDescription">Save Changes</button>
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
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
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

    $(document).ready(function () {
        var country_code_value = $(".country_code").val();
        console.log("country_code_value", country_code_value);

        $.ajax({
            type: "get",
            url: "{{ route('medical-facilities.getStates') }}",
            
            data: {country_code_value:country_code_value},
            success: function(data) {
                if(data != ""){
                    var state_data = JSON.parse(data);
                    var job_state = '';
                    for(var i = 0;i<state_data.length;i++){
                        job_state += '<option value='+state_data[i].id+'>'+state_data[i].name+'</option>';
                        
                    }
                    $("#job_state").append('<option value="">Select</option>'+job_state);
                    //console.log("state_name",data.name);
                }
            }
        });  

        $("#site_rotation").change(function () {
            
            if ($("#site_rotation").is(":checked")) {
                $(".additional_site_box").removeClass("d-none");
            } else {
                $(".additional_site_box").addClass("d-none");
            }
        });

        $("#remote_teleneath_component").change(function () {
            
            if ($("#remote_teleneath_component").is(":checked")) {
                $(".remote_teleneath_work").removeClass("d-none");
            } else {
                $(".remote_teleneath_work").addClass("d-none");
                $(".remote_percent_box").addClass("d-none"); 
            }
        });

        $("#remote_teleneath_modal").change(function () {
            var remote_val = $("#remote_teleneath_modal").val();
            if(remote_val == "Hybrid"){
                $(".remote_percent_box").removeClass("d-none");
            }else{
                $(".remote_percent_box").addClass("d-none");   
            }
        });
        
    });
    
     /* Initialize editors */
    var editor_role = new Quill('#editor_role', {
        theme: 'snow',
        placeholder: 'Write about the role...',
        modules: {
            toolbar: [
                ['bold','italic','underline'],
                [{ list: 'bullet' }, { list: 'ordered' }],
                ['link']
            ]
        }
    });

    editor_role.root.innerHTML = `{!! $job_data->about_role !!}`;
    $('#about_role').val(editor_role.root.innerHTML);

    var editor_responsiblities = new Quill('#editor_responsiblities', {
        theme: 'snow',
        placeholder: 'Enter responsibilities...',
        modules: {
            toolbar: [
                ['bold','italic','underline'],
                [{ list: 'bullet' }, { list: 'ordered' }],
                ['link']
            ]
        }
    });

    editor_responsiblities.root.innerHTML = `{!! $job_data->key_responsiblities !!}`;
    $('#key_responsiblities').val(editor_responsiblities.root.innerHTML);

    var editor_role_specific = new Quill('#editor_role_specific', {
        theme: 'snow',
        placeholder: 'Write environment notes...',
        modules: {
            toolbar: [
                ['bold','italic','underline'],
                [{ list: 'bullet' }, { list: 'ordered' }],
                ['link']
            ]
        }
    });

    editor_role_specific.root.innerHTML = `{!! $job_data->role_specific_work_environments !!}`;
    $('#role_specific').val(editor_role_specific.root.innerHTML);

    var selectedFiles1 = [];

    function changeAttachment(job_id){
      if (!selectedFiles1) {
        selectedFiles1 = [];
      }

      const newFiles = Array.from($('.job_attachments')[0].files);

      newFiles.forEach(file => {
        const exists = selectedFiles1.some(f => f.name === file.name && f.lastModified === file.lastModified);
        if (!exists) {
            selectedFiles1.push(file);
        }
      });

      console.log("selectedFiles",selectedFiles1);

      var form_data = "";
      form_data = new FormData();

      for (var i = 0; i < selectedFiles1.length; i++) {
        form_data.append("job_attachments[]", selectedFiles1[i], selectedFiles1[i]['name']);
      }

      form_data.append("job_id", job_id);
      form_data.append("_token", '{{ csrf_token() }}');

      $.ajax({
        type: "post",
        url: "{{ route('medical-facilities.uploadJobImgs') }}",
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        data: form_data,

        success: function(data) {
          var image_array = JSON.parse(data);
          console.log("image_array", image_array);
          var htmlData = '';
          for (var i = 0; i < image_array.length; i++) {
            //console.log("degree_transcript", image_array[i]);
            var img_name = image_array[i];
            //console.log("img_name", 'deleteImg(' + (i + 1) + ',' + user_id + ',"' + img_name + '")');
            htmlData += '<div class="trans_img1 trans_img1-' + (i + 1) + '"><a href="{{ url("/public") }}/uploads/education_degree/' + img_name + '" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>' + image_array[i] + '</a><div class="close_btn close_btn-' + i + '" onclick="deleteAwardEvidenceImg(' + (i + 1) + ',\'' + img_name + '\')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div></div>';
          }
          $(".job_attachments_imgs").html(htmlData);
          $(".job_attachments_file").val(data);
        }
      });
    }




    function job_description_form() {
      var isValid = true;

      document.getElementById("about_role").value =
      editor_role.root.innerHTML;

      document.getElementById("key_responsiblities").value =
          editor_responsiblities.root.innerHTML;

      document.getElementById("role_specific").value =
          editor_role_specific.root.innerHTML;


      /* Optional validation */
      if (editor_role.getText().trim() === "") {
          
          document.getElementById("reqabout_role").innerHTML = "* Please enter About Role";
          isValid = false;
      }

      if ($("#contact_person").val() === "") {
          
          document.getElementById("reqcontact_person").innerHTML = "* Please enter the contact person";
          isValid = false;
      }
      


      if (isValid == true) {
        $.ajax({
        url: "{{ route('medical-facilities.updateJobDescription') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#job_description_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitJobDescription').prop('disabled', true);
          $('#submitJobDescription').text('Process....');
        },
        success: function(res) {
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Job Description added Successfully',
            }).then(function() {
              const jobId = params.get("job_id");

              if(jobId){
                window.location.href = "{{ route('medical-facilities.job_description') }}?job_id="+jobId;
                
              }else{
                window.location.href = "{{ route('medical-facilities.job_description') }}";
              }
              
              sessionStorage.setItem("tab-one","job_description");
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
          $('#submitJobDescription').prop('disabled', false);
          $('#submitJobDescription').text('Save Changes');
          console.log("errorss", errorss);
          
        }
      
        });
      }

      return false;
    }  
  </script>
@endsection