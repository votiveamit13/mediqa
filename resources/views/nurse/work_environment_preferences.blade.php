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

  form#work_environment_form ul.select2-selection__rendered {
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
                      <h3 class="mt-0 color-brand-1 mb-2">Work Environment Preferences</h3>
                      <div class="work_preferences_text">
                        <p>
                            By selecting your workplace environment with multiple choices, you define your <strong>Preferred Specialties</strong> (e.g., Pediatrics, Mental Health, Aged Care, ICU, Maternity, Emergency), your <strong>Desired Patient Demographic</strong> (e.g., Children, Elderly, NDIS Participants, Indigenous Communities), and your <strong>Skill-Based Preferences</strong>—areas where you want to focus, such as wound care, vaccinations, or chronic disease management.

    
                        </p>
                        <p>
                            While you are free to choose any facility you prefer, selecting environments where you have <strong>proven experience</strong>—as indicated in your <strong>Profession tab</strong>—will increase the likelihood of getting job matches and interview requests.

    
                        </p>
                      </div>  
                      <form id="work_environment_form" method="POST" onsubmit="return update_work_preferences()">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">

                        <div class="form-group level-drp">
                          
                            <label class="form-label" for="input-1">Work Environment Preferences</label>
                            <?php
                                $user_id = Auth::guard('nurse_middle')->user()->id;
                                $workplace_data = DB::table('work_enviornment_preferences')->where("sub_env_id",0)->orderBy("env_name","asc")->get();
                                
                                if(!empty($work_preferences_data)){
                                  $facility_type = (array)json_decode($work_preferences_data->work_environment_preferences);
                                }else{
                                  $facility_type = array();
                                }
                                
                                

                                $p_memb_arr = array();

                                if(!empty($facility_type) && !in_array("444", (array)$facility_type[1])){
                                    foreach ($facility_type[1] as $index => $p_memb) {
                                    
                                        //print_r($p_memb);
                                        $p_memb_arr[] = $index;
                                        
                                    }
                                }else{
                                  if(isset($facility_type[1])){
                                    $p_memb_arr[] = $facility_type[1];
                                  }
                                  
                                }

                                $p_memb_json = json_encode($p_memb_arr);
                            ?>
                            <input type="hidden" name="mainfactype" class="mainfactype mainfactype-1" value="{{ $p_memb_json }}">
                            <ul id="wp_data-1" style="display:none;">
                             
                              @if(!empty($workplace_data))
                              @foreach($workplace_data as $wp_data)
                              <li data-value="{{ $wp_data->prefer_id }}">{{ $wp_data->env_name }}</li>
                              @endforeach
                              @endif
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn facworktype facworktype-1" data-list-id="wp_data-1" name="subworkthlevel[1][]" multiple onchange="getWpData('',1)"></select>
                            <span id="reqfacworktype" class="reqError text-danger valley"></span>
                          
                        </div>
                        <div class="wp_data-1">
                            @if(isset($facility_type[1]) && !in_array("444", (array)$facility_type[1]))
                            @foreach ($p_memb_arr as $p_arr)
                            <?php
                                $sdata = (array)$facility_type[1];
                                $subface_data = (array)$sdata[$p_arr];
                                $environment_list = DB::table("work_enviornment_preferences")->where("sub_env_id",$p_arr)->where("sub_envp_id","0")->get();
                                $environment_name = DB::table("work_enviornment_preferences")->where("prefer_id",$p_arr)->first();
                                
                                $p_memb_arr = array();

                                if (array_key_exists(0, $subface_data)){
                                if(!empty($subface_data)){
                                    foreach ($subface_data as $index => $s_data) {
                                
                                    //print_r($p_memb);
                                    $p_memb_arr[] = $s_data;
                                    
                                    }
                                }
                                }else{
                                    if(!empty($subface_data)){
                                        foreach ($subface_data as $index => $s_data) {
                                    
                                        //print_r($p_memb);
                                        $p_memb_arr[] = $index;
                                        
                                        }
                                    }
                                }
                                

                                
                                //print_r($p_memb_arr);
                                $p_memb_json = json_encode($p_memb_arr);
                            ?>
                            <div class="wp_main_div wp_main_div-{{ $p_arr }}"><div class="subworkdiv subworkdiv-{{ $p_arr }} form-group level-drp">
                                <label class="form-label work_label work_label-1{{ $p_arr }}" for="input-1">{{ $environment_name->env_name }}</label>
                                <input type="hidden" name="subwork" class="subwork subwork-{{ $p_arr }}" value="1">
                                <input type="hidden" name="subwork_list" class="subwork_list subwork_list-1" value="{{ $p_arr }}">
                                <input type="hidden" name="subworkjs" class="subworkjs-1 subworkjs-1{{ $p_arr }}" value="{{ $p_memb_json }}">
                                <ul id="subwork_field-1{{ $p_arr }}" style="display:none;">
                                @if(!empty($environment_list))
                                @foreach($environment_list as $env_list)
                                <li data-value="{{ $env_list->prefer_id }}">{{ $env_list->env_name }}</li>
                                
                                @endforeach
                                @endif
                                </ul>
                                <select class="js-example-basic-multiple addAll_removeAll_btn work_valid-1 work_valid-1{{ $p_arr }}" data-list-id="subwork_field-1{{ $p_arr }}" name="subworkthlevel[1][{{ $p_arr }}][]" onchange="getWpSubData('',1,{{ $p_arr }})" multiple></select>
                                <span id="reqsubwork-1{{ $p_arr }}" class="reqError text-danger valley"></span>
                                </div>
                                <div class="showsubwpdata showsubwpdata-1{{ $p_arr }}">
                                @if(array_key_exists(0, $subface_data) == false)
                                @if(!empty($p_memb_arr))
                                @foreach ($p_memb_arr as $p_arr1)
                                <?php
                                    $subface_data1 = $subface_data[$p_arr1];
                                    $environment_list = DB::table("work_enviornment_preferences")->where("sub_env_id",$p_arr)->where("sub_envp_id",$p_arr1)->get();
                                    $environment_name = DB::table("work_enviornment_preferences")->where("prefer_id",$p_arr1)->first();
                                    
                                    

                                    $p_memb_json = json_encode($subface_data1);
                                ?>
                                <div class="subpworkdiv subpworkdiv-{{ $p_arr1 }} form-group level-drp">
                                    <label class="form-label pwork_label pwork_label-1{{ $p_arr1 }}" for="input-1">{{ $environment_name->env_name }}</label>
                                    <input type="hidden" name="subpwork" class="subpwork subpwork-{{ $p_arr1 }}" value="1">
                                    <input type="hidden" name="subpwork_list" class="subpwork_list subpwork_list-1" value="{{ $p_arr1 }}">
                                    <input type="hidden" name="subworkjs1" class="subworkjs1-1 subworkjs1-1{{ $p_arr1 }}" value="{{ $p_memb_json }}">
                                    <ul id="subpwork_field-1{{ $p_arr1 }}" style="display:none;">
                                    @if(!empty($environment_list))
                                    @foreach($environment_list as $env_list)
                                    <li data-value="{{ $env_list->prefer_id }}">{{ $env_list->env_name }}</li>
                                    
                                    @endforeach
                                    @endif
                                    </ul>
                                    <select class="js-example-basic-multiple addAll_removeAll_btn pwork_valid-{{ $p_arr1 }} pwork_valid-1{{ $p_arr1 }}" data-list-id="subpwork_field-1{{ $p_arr1 }}" name="subworkthlevel[1][{{ $p_arr }}][{{ $p_arr1 }}][]" multiple></select>
                                    <span id="reqsubpwork-1{{ $p_arr1 }}" class="reqError text-danger valley"></span>
                                </div>
                                @endforeach
                                @endif
                                @endif
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitWorkPreferences" @if(!email_verified()) disabled  @endif>Save Changes</button>
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

    if ($(".mainfactype-1").val() != "") {
      var mainfactype = JSON.parse($(".mainfactype-1").val());
      
      console.log("mainfactype",mainfactype);
      $('.js-example-basic-multiple[data-list-id="wp_data-1"]').select2().val(mainfactype).trigger('change');
      $(".subwork_list-1").each(function(){
        var subwork_list_val = $(this).val();
        if ($(".subworkjs-1"+subwork_list_val).val() != "") {
          
          var subfactype = JSON.parse($(".subworkjs-1"+subwork_list_val).val());
          
          console.log("subfactype",subfactype);
          $('.js-example-basic-multiple[data-list-id="subwork_field-1'+subwork_list_val+'"]').select2().val(subfactype).trigger('change');
          $(".subpwork_list-1").each(function(){
            var subwork_list_val = $(this).val();
            
            if ($(".subworkjs1-1"+subwork_list_val).val() != "") {
                
              var subfactype = JSON.parse($(".subworkjs1-1"+subwork_list_val).val());
              
              console.log("subfactype1",subfactype);
              $('.js-example-basic-multiple[data-list-id="subpwork_field-1'+subwork_list_val+'"]').select2().val(subfactype).trigger('change');
              
            }
            
          });
        }

        
        
      });  
    }  
</script>
<script type="text/javascript">
    

    function update_work_preferences() {
      var isValid = true;

      if ($(".facworktype").val() == '') {
        document.getElementById("reqfacworktype").innerHTML = "* Please select the work environment preferences";
        isValid = false;
      }

      var t = 1;
      $(".wp_data-1 .subwork_list-1").each(function() {
        var work_valid = $(this).val();
        console.log("work_valid",work_valid);
        var work_label = $(".work_label-1"+work_valid).text();
        if ($(".work_valid-1"+work_valid).length > 0) {
          if ($(".work_valid-1"+work_valid).val() == '') {
            document.getElementById("reqsubwork-1"+work_valid).innerHTML = "* Please select the "+work_label;
            isValid = false;
          }
        }

        var u = 0;
        $(".wp_data-1 .subpwork_list-1").each(function() {
          var work_valid = $(this).val();
          console.log("work_valid",work_valid);
          var work_label = $(".pwork_label-1"+work_valid).text();
          if ($(".pwork_valid-1"+work_valid).length > 0) {
            if ($(".pwork_valid-1"+work_valid).val() == '') {
              document.getElementById("reqsubpwork-1"+work_valid).innerHTML = "* Please select the "+work_label;
              isValid = false;
            }
          }
          u++;
        });
        t++;
      });

      if (isValid == true) {
        $.ajax({
        url: "{{ route('nurse.updateWorkPreferences') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#work_environment_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitWorkPreferences').prop('disabled', true);
          $('#submitWorkPreferences').text('Process....');
        },
        success: function(res) {
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Work Environment Preferences Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.work_environment_preferences') }}?page=work_environment_preferences";
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
          $('#submitWorkPreferences').prop('disabled', false);
          $('#submitWorkPreferences').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitWorkPreferences").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      
        });
      }

      return false;
    }

    let $fields = $(".wp_data-1 .wp_main_div");

    let sortedFields = $fields.sort(function (a, b) {
        return $(a).find(".work_label").text().localeCompare($(b).find(".work_label").text());
    });
    

    $(".wp_data-1").append(sortedFields);

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
