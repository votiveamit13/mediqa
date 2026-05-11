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

form#benefits_preferences_form ul.select2-selection__rendered {
    box-shadow: none;
    max-height: inherit;
    border: none;
    position: relative;
  }

  .clear-btn{
    visibility: hidden;
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
                      <h3 class="mt-0 color-brand-1 mb-2">Benefits</h3>
    
                      <form id="benefits_preferences_form" method="POST" onsubmit="return benefits_preferences_form()">
                        @csrf
                        <input type="hidden" name="job_id" value="{{ $job_id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::guard('healthcare_facilities')->user()->id }}">
                        @if(!empty($benefits_preferences_data))
                        @foreach ($benefits_preferences_data as $benefits_data)
                        <div class="form-group level-drp work_prefer_div-{{ $benefits_data->benefits_id }}">
                          <label class="form-label benefits_label benefits_label-{{ $benefits_data->benefits_id }}" for="input-1">{{ $benefits_data->benefits_name }}
                          </label>
                          <?php
                            $subbenefits_preferences_data = DB::table("benefits_preferences")->where("subbenefit_id",$benefits_data->benefits_id)->get();
                            
                            if(!empty($job_data) && $job_data->benefits != NULL){
                                $benefitspreferences = (array)json_decode($job_data->benefits);
                            }else{
                                $benefitspreferences = array();
                            }
                            
                            $benefitsprefer_data = '';
                            if(!empty($benefitspreferences) && isset($benefitspreferences[$benefits_data->benefits_id])){
                                $benefitsprefer_data = json_encode($benefitspreferences[$benefits_data->benefits_id]);
                            }else{
                                $benefitsprefer_data = '';
                            }
                          ?>
                          <input type="hidden" name="benefits_input" class="benefits_input benefits_input-{{ $benefits_data->benefits_id }}" value="{{ $benefits_data->benefits_id }}">
                          <input type="hidden" name="benefits_data" class="benefits_data benefits_data-{{ $benefits_data->benefits_id }}" value="{{ $benefitsprefer_data }}">
                          <ul id="benefits_preferences-{{ $benefits_data->benefits_id }}" style="display:none;">
                             
                            @if(!empty($subbenefits_preferences_data))
                            @foreach($subbenefits_preferences_data as $subbenefits)
                            <li data-value="{{ $subbenefits->benefits_id }}">{{ $subbenefits->benefits_name }}</li>
                            @endforeach
                            @endif
                          </ul>
                          <select class="js-example-basic-multiple addAll_removeAll_btn benefits_prefer_valid benefits_prefer_valid-{{ $benefits_data->benefits_id }}" data-list-id="benefits_preferences-{{ $benefits_data->benefits_id }}" name="benefits_preferences[{{ $benefits_data->benefits_id }}][]" multiple></select>
                          <span id='reqbenefits_preferences-{{ $benefits_data->benefits_id }}' class='reqError text-danger valley'></span>
                        </div>
                        
                        @endforeach
                        @endif
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitbenefitsPreferences">Save Changes</button>
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

    function getOrdinalSuffix(i) {
      if (i % 100 >= 11 && i % 100 <= 13) {
          return 'th';
      }
      switch (i % 10) {
          case 0: return '';
          case 1: return 'st';
          case 2: return 'nd';
          case 3: return 'rd';
          default: return 'th';
      }
    }

    function getNurseType(level,k){
      //alert("hello");

      if(level == "main"){
        var selectedValues1 = $('.js-example-basic-multiple[data-list-id="type-of-nurse-'+k+'"]').val();
      }else{
        var selectedValues1 = $('.js-example-basic-multiple'+k+'[data-list-id="type-of-nurse-'+k+'"]').val();
      }
      
      

      let selectedValues = Array.isArray(selectedValues1) ? selectedValues1 : [selectedValues1];

      console.log("selectedValues",selectedValues1);


      $(".showNurseType-"+k+" .subnurse_list").each(function(i,val){
          var val1 = $(val).val();
          console.log("val",val1);
          if(selectedValues.includes(val1) == false){
            $(".showNurseType-" + k).find(".subnurse_main_div-" + val1).remove();
              
          }
      });
      
      $(".subspecnurse_list").each(function () {

          var val1 = $(this).val();
          console.log("selectedValues_status", selectedValues);
          console.log("val1_specStatus", val1);
          if(selectedValues.includes(val1) == false){

            
            $(".showNurseSpeciality-" + k)
            .find(".nurse_specialities-" + val1)
            .remove();
            
          }
      });

      for(var i=0;i<selectedValues.length;i++){
        if($(".showNurseType-"+k+" .subnurse_main_div-"+selectedValues[i]).length < 1){
          $.ajax({
            type: "GET",
            url: "{{ url('/nurse/getNurseDatas') }}",
            data: {nurse_id:selectedValues[i]},
            cache: false,
            success: function(data){
              var data1 = JSON.parse(data);
              console.log("data1",data1);

              var nurse_text = "";
              for(var j=0;j<data1.sub_nurse_data.length;j++){
                
                nurse_text += "<li data-value='"+data1.sub_nurse_data[j].id+"'>"+data1.sub_nurse_data[j].name+"</li>"; 
                
              }
              var sub = 'sub';
              var experience_text = "";
              for(var i=1;i<=30;i++){
                experience_text += "<option value='" + i + "'>" + i + getOrdinalSuffix(i) + " Year</option>";
              }

              if(data1.sub_nurse_data.length > 0){
                
                $(".showNurseType-"+k).append('\<div class="subnurse_main_div subnurse_main_div-'+data1.main_nurse_id+'">\
                              <div class="subnurse_div subnurse_div-'+data1.main_nurse_id+' form-group level-drp">\
                              <label class="form-label subnurse_label subnurse_label-'+data1.main_nurse_id+'" for="input-1">'+data1.main_nurse_name+'</label>\
                              <input type="hidden" name="subnurse_list" class="subnurse_list subnurse_list-'+data1.main_nurse_id+'" value="'+data1.main_nurse_id+'">\
                              <ul id="type-of-nurse-'+data1.main_nurse_id+'" style="display:none;">\
                              <li data-value="">select</li>\
                              '+nurse_text+'</ul>\
                              <select class="js-example-basic-multiple'+data1.main_nurse_id+' subnurse_valid-'+data1.main_nurse_id+' addAll_removeAll_btn" data-list-id="type-of-nurse-'+data1.main_nurse_id+'" id="subnursetype" name="subnursetype[]" onchange="getNurseType(\''+sub+'\',\''+data1.main_nurse_id+'\')"></select>\
                              <span id="reqsubnursevalid-'+data1.main_nurse_id+'" class="reqError text-danger valley"></span>\
                              </div>\
                              <div class="subnurse_level-'+data1.main_nurse_id+'"></div>\
                              <div class="showNurseType-'+data1.main_nurse_id+'"></div>\
                              <div class="showNurseSpeciality-'+data1.main_nurse_id+'"></div>\
                              </div>\
                              ');
                selectTwoFunction(data1.main_nurse_id);
                              
              }

              
              
            }
          });
        }
      }
    }

    function updateJobTitle() {
      let nurseTypeText = $('#subnursetype option:selected').text();
      let specialityText = $('#subspecialities option:selected').text();

      if (
          $('#nurse_type').val() !== '' &&
          $('#subspecialities').val() !== ''
      ) {
          // Remove abbreviation if needed
          nurseTypeText = nurseTypeText.replace(/\s*\(.*?\)/g, '');

          $('.job_title').val(nurseTypeText + ' – ' + specialityText);
      } else {
          $('.job_title').val('');
      }
    }

    function getSecialities(level,k,specialities_type,multiple){
      // alert();

      if(level == "main"){
        var selectedValues1 = $('.js-example-basic-multiple[data-list-id="speciality_preferences-'+specialities_type+"-"+k+'"]').val();
      }else{
        var selectedValues1 = $('.js-example-basic-multiple'+k+'[data-list-id="speciality_preferences-'+specialities_type+"-"+k+'"]').val();
        updateJobTitle();
      }


      
      let selectedValues = Array.isArray(selectedValues1) ? selectedValues1 : [selectedValues1];
    
      console.log("selectedValues",selectedValues1);

      $(".show_specialities-"+specialities_type+"-"+k+" .subspec_list-"+specialities_type).each(function(i,val){
          var val1 = $(val).val();
          console.log("subspec_listval",val1);
          if(selectedValues.includes(val1) == false){
            $(".subspec_main_div-"+val1).remove();
              
          }
      });

      $(".subspecprofpart_list-"+specialities_type+"-"+k).each(function () {
            
          var val1 = $(this).val();
          console.log("selectedValues_status", selectedValues);
          console.log("val1_specStatus", val1);
          if(selectedValues.includes(val1) == false){

            
            $(".subexper_div-"+val1).remove();
            
          }
      });

      for(var i=0;i<selectedValues.length;i++){
        
        if($(".show_specialities-"+specialities_type+"-"+k+" .subspec_main_div-"+selectedValues[i]).length < 1){
          
          $.ajax({
            type: "GET",
            url: "{{ url('/nurse/getSpecialityDatas1') }}",
            data: {speciality_id:selectedValues[i]},
            cache: false,
            success: function(data){
              var data1 = JSON.parse(data);
              console.log("data1",data1);

              var speciality_text = "";
              for(var j=0;j<data1.sub_spciality_data.length;j++){
                
                speciality_text += "<li data-value='"+data1.sub_spciality_data[j].id+"'>"+data1.sub_spciality_data[j].name+"</li>"; 
                
              }

              
              
              var sub = 'sub';

              if(specialities_type == "primary"){
                var name = "subspeciality";
              }else{
                var name = "speciality["+data1.main_speciality_id+"][]";
              }


              if(data1.sub_spciality_data.length > 0){
                $(".show_specialities-"+specialities_type+"-"+k).append('\<div class="subspec_main_div subspec_main_div-'+data1.main_speciality_id+'">\
                              <div class="subspec_div subspec_div-'+data1.main_speciality_id+' form-group level-drp">\
                              <label class="form-label subspec_label subspec_label-'+data1.main_speciality_id+'" for="input-1">'+data1.main_speciality_name+'</label>\
                              <input type="hidden" name="subspec_list" class="subspec_list-'+specialities_type+' subspec_list-'+specialities_type+"-"+data1.main_speciality_id+'" value="'+data1.main_speciality_id+'">\
                              <ul id="speciality_preferences-'+specialities_type+"-"+data1.main_speciality_id+'" style="display:none;">\
                              <li data-value="">select</li>\
                              '+speciality_text+'</ul>\
                              <select class="js-example-basic-multiple'+data1.main_speciality_id+' subspec_valid-'+data1.main_speciality_id+' addAll_removeAll_btn" name="subspeciality['+specialities_type+']['+data1.main_speciality_id+'][]" data-list-id="speciality_preferences-'+specialities_type+"-"+data1.main_speciality_id+'" id="subspecialities" onchange="getSecialities(\''+sub+'\',\''+data1.main_speciality_id+'\',\''+specialities_type+'\',\''+multiple+'\')" '+multiple+'></select>\
                              <span id="reqsubspecvalid-'+data1.main_speciality_id+'" class="reqError text-danger valley"></span>\
                              </div>\
                              <div class="subspec_level-'+data1.main_speciality_id+'"></div>\
                              <div class="show_specialities-'+specialities_type+"-"+data1.main_speciality_id+'"></div>\
                              <div class="show_specialities_experience-'+specialities_type+"-"+data1.main_speciality_id+'"></div>\
                              </div>');

                              selectTwoFunction(data1.main_speciality_id);
              
              }else{

                var experience_text = "";
                for(var i=0;i<=30;i++){
                  experience_text += "<option value='" + i + "'>" + i + getOrdinalSuffix(i) + " Year</option>";
                }

                if ($(".subexper_div-" + data1.main_speciality_id).length === 0 && specialities_type == "primary") {

                  $(".show_specialities_experience-"+specialities_type+"-"+k).append('\<div class="subexper_div subexper_div-'+data1.main_speciality_id+'">\
                  <div class="custom-select-wrapper form-group level-drp">\
                    <label class="form-label" for="input-1">Minimum Specialty Experience\
                    </label>\
                    <input type="hidden" name="subspecprof_list" class="subspecprof_list subspecprofpart_list-'+specialities_type+"-"+k+' subspecprof_listProfession subspecprof_listProfession-'+data1.main_speciality_id+' subspecprof_list-'+k+'" value="'+data1.main_speciality_id+'">\
                    <select class="custom-select experience_level-'+data1.main_speciality_id+'" name="speciality_experience">\
                      <option value="">Please Select</option>\
                      '+experience_text+'\
                    </select>\
                    <span id="reqassistentlevel'+data1.main_speciality_id+'" class="reqError text-danger valley"></span>\
                    <div class="experience_helper">Set 0 for Graduate or Transition roles.Tick “Willing to upskill” if you’ll consider near-fit candidates.</div>\
                  </div>\
                </div>');

                }

              }

              
            }
          });
        }
      }
    }

    function getWpData(ap, k){
        if(ap == 'ap'){
            var selectedValues = $('.js-example-basic-multiple'+k+'[data-list-id="wp_data-'+k+'"]').val();
        }else{
            var selectedValues = $('.js-example-basic-multiple[data-list-id="wp_data-'+k+'"]').val();
        }

        console.log("selectedValueswp",selectedValues);

        $(".wp_data-"+k+" .subwork_list").each(function(i,val){
            var val1 = $(val).val();
            console.log("val",val1);
            if(selectedValues.includes(val1) == false){
                $(".wp_main_div-"+val1).remove();
                
            }
        });

        for(var i=0;i<selectedValues.length;i++){
            if($(".wp_data-"+k+" .wp_main_div-"+selectedValues[i]).length < 1 && selectedValues[i] != "444"){
                $.ajax({
                    type: "GET",
                    url: "{{ url('/healthcare-facilities/getWorkplaceData') }}",
                    data: {place_id:selectedValues[i]},
                    cache: false,
                    success: function(data){
                        var data1 = JSON.parse(data);
                        console.log("data1",data1);

                        var wp_text = "";
                        for(var j=0;j<data1.work_data.length;j++){
                        
                            wp_text += "<li data-value='"+data1.work_data[j].prefer_id+"'>"+data1.work_data[j].env_name+"</li>"; 
                        
                        }

                        $('.js-example-basic-multiple[data-list-id="wp_data-1"]').removeAttr("name");
                        
                        var ap = "ap";
                        $(".wp_data-"+k).append('\<div class="wp_main_div wp_main_div-'+data1.prefer_id+'"><div class="subworkdiv subworkdiv-'+data1.prefer_id+' form-group level-drp">\
                            <label class="form-label work_label work_label-'+k+data1.prefer_id+'" for="input-1">'+data1.env_name+'</label>\
                            <input type="hidden" name="subwork" class="subwork subwork-'+data1.prefer_id+'" value="'+k+'">\
                            <input type="hidden" name="subwork_list" class="subwork_list subwork_list-'+k+'" value="'+data1.prefer_id+'">\
                            <ul id="subwork_field-'+k+data1.prefer_id+'" style="display:none;">'+wp_text+'</ul>\
                            <select class="js-example-basic-multiple'+k+data1.prefer_id+' addAll_removeAll_btn work_valid-'+k+' work_valid-'+k+data1.prefer_id+'" data-list-id="subwork_field-'+k+data1.prefer_id+'" name="subworkthlevel['+k+']['+data1.prefer_id+'][]" onchange="getWpSubData(\''+ap+'\',\''+k+'\',\''+data1.prefer_id+'\')" multiple></select>\
                            <span id="reqsubwork-'+k+data1.prefer_id+'" class="reqError text-danger valley"></span>\
                            </div><div class="showsubwpdata showsubwpdata-'+k+data1.prefer_id+'"></div></div>');

                            let $fields = $(".wp_data-"+k+" .wp_main_div");

                            let sortedFields = $fields.sort(function (a, b) {
                                return $(a).find(".work_label").text().localeCompare($(b).find(".work_label").text());
                            });

                            $(".wp_data-"+k).append(sortedFields);
                        
                        selectTwoFunction(k+data1.prefer_id);
                    }    
                });            
            }
        }
    }

    

    function getWpSubData(ap,k,l){
        if(ap == 'ap'){
            var selectedValues = $('.js-example-basic-multiple'+k+l+'[data-list-id="subwork_field-'+k+l+'"]').val();
        }else{
            var selectedValues = $('.js-example-basic-multiple[data-list-id="subwork_field-'+k+l+'"]').val();
        }

        console.log("selectedValues",selectedValues);

        $(".showsubwpdata-"+k+l+" .subpwork_list").each(function(i,val){
            var val1 = $(val).val();
            console.log("val",val1);
            if(selectedValues.includes(val1) == false){
                $(".subpworkdiv-"+val1).remove();
                
            }
        });

        var ne_st = k.toString() + l.toString();
        
        if($.trim($(".showsubwpdata-"+ne_st).html()) != ''){
           $('.js-example-basic-multiple[data-list-id="subwork_field-'+k+l+'"]').removeAttr("name");
        }

        for(var i=0;i<selectedValues.length;i++){
            if($(".showsubwpdata-"+k+l+" .subpworkdiv-"+selectedValues[i]).length < 1){
                $.ajax({
                    type: "GET",
                    url: "{{ url('/healthcare-facilities/getSubWorkplaceData') }}",
                    data: {place_id:l,subplace_id:selectedValues[i]},
                    cache: false,
                    success: function(data){
                        var data1 = JSON.parse(data);
                        console.log("data1",data1);
                        
                            
                        if(data1.work_data.length > 0){
                            var wp_text = "";
                            for(var j=0;j<data1.work_data.length;j++){
                            
                                wp_text += "<li data-value='"+data1.work_data[j].prefer_id+"'>"+data1.work_data[j].env_name+"</li>"; 
                            
                            }
                            
                            $('.js-example-basic-multiple'+k+l+'[data-list-id="subwork_field-'+k+l+'"]').removeAttr("name");
                            
                            
                            var ap = "";
                            $(".showsubwpdata-"+k+l).append('\<div class="subpworkdiv subpworkdiv-'+data1.subplace_id+' form-group level-drp">\
                                <label class="form-label pwork_label pwork_label-'+k+data1.subplace_id+'" for="input-1">'+data1.env_name+'</label>\
                                <input type="hidden" name="subpwork" class="subpwork subpwork-'+data1.subplace_id+'" value="'+k+'">\
                                <input type="hidden" name="subpwork_list" class="subpwork_list subpwork_list-'+k+'" value="'+data1.subplace_id+'">\
                                <ul id="subpwork_field-'+k+data1.subplace_id+'" style="display:none;">'+wp_text+'</ul>\
                                <select class="js-example-basic-multiple'+k+data1.subplace_id+' addAll_removeAll_btn pwork_valid-'+k+' pwork_valid-'+k+data1.subplace_id+'" data-list-id="subpwork_field-'+k+data1.subplace_id+'" name="subworkthlevel['+k+']['+l+']['+data1.subplace_id+'][]" multiple></select>\
                                <span id="reqsubpwork-'+k+data1.subplace_id+'" class="reqError text-danger valley"></span>\
                            </div>');

                            let $fields = $(".showsubwpdata-"+k+l+" .subpworkdiv");

                            let sortedFields = $fields.sort(function (a, b) {
                                return $(a).find(".pwork_label").text().localeCompare($(b).find(".pwork_label").text());
                            });

                            $(".showsubwpdata-"+k+l).append(sortedFields);

                            selectTwoFunction(k+data1.subplace_id);
                        }
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

    function benefits_preferences_form() {
        var isValid = true;

        // $(".benefits_input").each(function(){
        //     var val = $(this).val();
        //     var label = $(".benefits_label-"+val).text();
        //     console.log("val",val);
        //     if ($('.benefits_prefer_valid-'+val).val() == '') {

        //         document.getElementById("reqbenefits_preferences-"+val).innerHTML = "* Please select the "+label;
        //         isValid = false;

        //     }

        // });


        if (isValid == true) {
            $.ajax({
            url: "{{ route('medical-facilities.updateBenefitsPreferences') }}",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('#benefits_preferences_form')[0]),
            dataType: 'json',
            beforeSend: function() {
            $('#submitbenefitsPreferences').prop('disabled', true);
            $('#submitbenefitsPreferences').text('Process....');
            },
            success: function(res) {
            if (res.status == '1') {
                Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Benefits Updated Successfully',
                }).then(function() {
                const jobId = params.get("job_id");

                if(jobId){
                  window.location.href = "{{ route('medical-facilities.job_benefits') }}?job_id="+jobId;
                  
                }else{
                  window.location.href = "{{ route('medical-facilities.job_benefits') }}";
                }
                
                var tab_name = sessionStorage.getItem("tab-one");
                if(tab_name != "job_description"){
                  sessionStorage.setItem("tab-one","benefits");
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
            $('#submitbenefitsPreferences').prop('disabled', false);
            $('#submitbenefitsPreferences').text('Save Changes');
            console.log("errorss", errorss);
            for (var err in errorss.responseJSON.errors) {
                $("#submitbenefitsPreferences").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
            }
            }
        
            });
        }

        return false;
    }

    $(".benefits_input").each(function(){
      var val = $(this).val();
      if ($(".benefits_data-"+val).val() != "") {
          var benefits_data = JSON.parse($(".benefits_data-"+val).val());
          console.log("benefits_data",benefits_data);
          
          $('.js-example-basic-multiple[data-list-id="benefits_preferences-'+val+'"]').select2().val(benefits_data).trigger('change');
          
      
      }
        
    });
  </script>
@endsection