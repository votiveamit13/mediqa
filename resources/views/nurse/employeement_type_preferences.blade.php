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

  form#employeementtype_form ul.select2-selection__rendered {
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

        @include('nurse.layouts.work_preferences_sidebar')
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
            {{-- @if(!email_verified())
            <div class="alert alert-success mt-2" role="alert">
              <span class="d-flex align-items-center justify-content-center ">Please verify your email first to access your account </span>
            </div>
            @endif --}}

            <div class="tab-content">
                <?php $user_id=''; $i = 0;?>

                <div class="tab-pane fade" id="tab-my-profile-setting" style="display: block;opacity:1;">

                    
                    <div class="card shadow-sm border-0 p-4 mt-30">
                      <h3 class="mt-0 color-brand-1 mb-2">Employment type preferences</h3>
                      
                      <form id="employeementtype_form" method="POST" onsubmit="return update_emptype_preferences()">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">

                        
                          <?php
                              $employee_type_data = DB::table('employeement_type_preferences')->where("sub_prefer_id",0)->get();
                              
                              if(!empty($work_preferences_data) && $work_preferences_data->emptype_preferences != NULL){
                                  $emp_data = (array)json_decode($work_preferences_data->emptype_preferences);
                              }else{
                                  $emp_data = array();
                              }
                              
                              //print_r($emp_data);

                              $emparr = array();

                              foreach ($emp_data as $index => $edata){
                                  $emparr[] = $index;
                              }
                              
                              
                              $x = 1;
                              $em_arr = json_encode($emparr);
                          ?>
                          <div class="emptypediv form-group level-drp">
                            <label class="form-label emptype_label" for="input-1">Employment type Preferences</label>
                            <input type="hidden" class="mainemptypedata" value='<?php echo $em_arr; ?>'>
                            <ul id="mainemptype_field" style="display:none;">
                              @if(!empty($employeement_type_preferences))
                              @foreach($employeement_type_preferences as $emptype_data)
                              <li data-value="{{ $emptype_data->emp_prefer_id }}">{{ $emptype_data->emp_type }}</li>  
                              @endforeach
                              @endif
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn emptype_valid-1" data-list-id="mainemptype_field" name="emptype_preferences[]" onchange="empType()" multiple></select>
                            <span id="reqemptype_prefer" class="reqError text-danger valley"></span>
                          </div>
                          
                        <div class="emp_data">
                          @if(!empty($emptypedata))
                          @foreach($emptypedata as $index=>$emp_type)
                           <?php
                              $empname = DB::table("employeement_type_preferences")->where("emp_prefer_id",$index)->first();
                              $subemptypedata = DB::table("employeement_type_preferences")->where("sub_prefer_id",$index)->get();
                           ?>
                           <div class="emptype_main_div emptype_main_div-{{ $index }}">
                            <div class="emptypediv emptypediv-{{ $index }} form-group level-drp">
                              <label class="form-label emptype_label emptype_label-{{ $index }}" for="input-1">{{ $empname->emp_type }}</label>
                              <input type="hidden" class="subemptype-{{ $index }}" value='<?php echo json_encode($emp_type); ?>'>
                              <input type="hidden" class="subemptypeid" value='<?php echo $index; ?>'>
                              <ul id="emptype_field-{{ $index }}" style="display:none;">
                                @if(!empty($subemptypedata))
                                @foreach($subemptypedata as $subemptype_data)
                                <?php
                                  $subemptype_data_name = DB::table("employeement_type_preferences")->where("emp_prefer_id",$subemptype_data->emp_prefer_id)->first();

                                ?>
                                <li data-value="{{ $subemptype_data->emp_prefer_id }}">{{ $subemptype_data_name->emp_type }}</li>  
                                @endforeach
                                @endif
                              </ul>
                              <select class="js-example-basic-multiple addAll_removeAll_btn emptype_valid-1" data-list-id="emptype_field-{{ $index }}" name="emptypelevel[{{ $index }}][]" multiple></select>
                              <span id="reqemptype-1" class="reqError text-danger valley"></span>
                            </div>
                          </div>
                          
                          @endforeach
                          @endif
                          
                        </div>
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" @if(!email_verified()) disabled  @endif id="submitEmptypePreferences">Save Changes</button>
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

    $(".subemptypeid").each(function(){
      var emp_id = $(this).val();
      if ($(".subemptypeid").length > 0) {
      //console.log("reference_relationship-" + m, $(".reference_relationship-" + m).val());
      
      if ($(".subemptype-"+emp_id).val() != "") {
        var subemptype = JSON.parse($(".subemptype-"+emp_id).val());
        console.log("subemptype",subemptype);
        $('.js-example-basic-multiple[data-list-id="emptype_field-'+emp_id+'"]').select2().val(subemptype).trigger('change');
      }
    }
    });

    if ($(".mainemptypedata").val() != "") {
      var mainemptypedata = JSON.parse($(".mainemptypedata").val());
      console.log("mainemptypedata",mainemptypedata);
      $('.js-example-basic-multiple[data-list-id="mainemptype_field"]').select2().val(mainemptypedata).trigger('change');
    }

    

    
  
    
    
</script>
<script type="text/javascript">
    function empType(){
        
        let emp_type = $('.js-example-basic-multiple[data-list-id="mainemptype_field"]').val();
        //alert(value);
        console.log("emp_type",emp_type);
        
        $(".emp_data .subrefer_list").each(function(i,val){
            var val1 = $(val).val();
            console.log("val",val1);
            if(emp_type.includes(val1) == false){
                $(".emptype_main_div-"+val1).remove();
                
            }
        });
        for(var i=0;i<emp_type.length;i++){

          if($(".emp_data .emptype_main_div-"+emp_type[i]).length < 1){
            $.ajax({
              type: "GET",
              url: "{{ url('/nurse/getEmpData') }}",
              data: {sub_prefer_id:emp_type[i]},
              cache: false,
              success: function(data){
                  const emp_prefer_data = JSON.parse(data);
                  console.log("emp_prefer_data",emp_prefer_data);

                  var emp_text = "";
                  for(var j=0;j<emp_prefer_data.employeement_type_preferences.length;j++){
                  
                      emp_text += "<li data-value='"+emp_prefer_data.employeement_type_preferences[j].emp_prefer_id+"'>"+emp_prefer_data.employeement_type_preferences[j].emp_type+"</li>"; 
                  
                  }
                  
                  $(".emp_data").append('\<div class="emptype_main_div emptype_main_div-'+emp_prefer_data.employeement_type_id+'"><div class="emptypediv emptypediv-'+emp_prefer_data.employeement_type_id+' form-group level-drp">\
                      <label class="form-label emptype_label emptype_label-'+emp_prefer_data.employeement_type_id+'" for="input-1">'+emp_prefer_data.employeement_type_name+'</label>\
                      <input type="hidden" name="subrefer_list" class="subrefer_list" value="'+emp_prefer_data.employeement_type_id+'">\
                      <ul id="emptype_field-'+emp_prefer_data.employeement_type_id+'" style="display:none;">'+emp_text+'</ul>\
                      <select class="js-example-basic-multiple'+emp_prefer_data.employeement_type_id+' addAll_removeAll_btn emptype_valid-1" data-list-id="emptype_field-'+emp_prefer_data.employeement_type_id+'" name="emptypelevel['+emp_prefer_data.employeement_type_id+'][]" multiple></select>\
                      <span id="reqemptype-1" class="reqError text-danger valley"></span>\
                      </div></div>');

                      
                  
                  selectTwoFunction(emp_prefer_data.employeement_type_id);
              }
              
          });
        }
        }
    }

    function update_emptype_preferences() {
      var isValid = true;

      if ($(".emptype_prefer").val() == '') {
        document.getElementById("reqemptype_prefer").innerHTML = "* Please select the Employment type Preferences";
        isValid = false;
      }

      if ($(".emptype_valid-1").val() == '') {
        var label = $(".emptype_label").text(); 
        document.getElementById("reqemptype-1").innerHTML = "* Please select the "+label;
        isValid = false;
      }


      if (isValid == true) {
        $.ajax({
        url: "{{ route('nurse.updateEmpTypePreferences') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#employeementtype_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitEmptypePreferences').prop('disabled', true);
          $('#submitEmptypePreferences').text('Process....');
        },
        success: function(res) {
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Employment Type Preferences Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.employeement_type_preferences') }}?page=employeement_type_preferences";
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
          $('#submitEmptypePreferences').prop('disabled', false);
          $('#submitEmptypePreferences').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitEmptypePreferences").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      
        });
      }

      return false;
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