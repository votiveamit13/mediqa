@extends('nurse.layouts.layout')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
<style type="text/css">

  #container {
    /*  max-width: 550px;  */
  }

  .reqError {
    color: red;
  }

  .step-container {
    position: relative;
    text-align: center;
    transform: translateY(-43%);
  }

  .step-circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #fff;
    border: 2px solid #000000;
    line-height: 30px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
    cursor: pointer;
    /* Added cursor pointer */
  }

  .step-line {
    position: absolute;
    top: 16px;
    left: 50px;
    width: calc(100% - 100px);
    height: 2px;
    background-color: #000000;
    z-index: -1;
  }

  #multi-step-form {
    overflow-x: hidden;
  }

  #multi-step-form .step-1:before,
  #multi-step-form .step-2:before {
    display: none;
  }


  .progress-bar {
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow: hidden;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    background-color: #000000;
    transition: width .6s ease;
  }

  .activ1,
  .activ {
    background: #000;
    color: #fff;
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
  padding-bottom: 0px;
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
.step-2 input{
  border: 1px solid #dedddd !important;
}
.assistent_level_field .clear-btn{
  display:none !important;
}
</style>
@endsection
@section('content')

<main class="main">
  <section class="pt-100 login-register nurse-reglog">

    <div id="container" class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="progress px-1" style="height: 3px;">
            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
          </div>


          <div class="step-container d-flex justify-content-between">
            <div class="step-circle first_step registration_progress" onclick="displayStep(1)">1</div>
            <div class="step-circle second_step" onclick="displayStep(2)">2</div>
            <!-- <div class="step-circle" onclick="displayStep(3)">3</div> -->
          </div>
        </div>
      </div>


      <form id="multi-step-form">
        @csrf
        <div class="step step-1">
          <!-- Step 1 form fields here -->
          <div class="row form-block">
            <div class="col-lg-12 col-md-6 col-sm-12 mx-auto">
              <div class="text-center">
                <!-- <p class="font-sm text-brand-2">Register </p> -->
                <h2 class="mt-10 mb-5 text-brand-1 fs_24">Please select your level and specialties<br>
        You can select multiple options</h2>

                <!-- <h2 class="mt-10 mb-5 text-brand-1 fs_24">Tell us about your qualifications</h2> -->

              </div>
              <div class="login-register text-start mt-20" action="#">


              <!-- <div class="form-group drp--clr">
                  <label class="form-label" for="input-1">Type of Nurse?</label>
                  <select class="form-input mr-10 country" name="nurseType[]"
                    multiple="true" id="nurseType"
                    > 
                      @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                    @foreach($specialty as $spl)
                    <option value="{{ $spl->id }}">{{ $spl->name }}</option>
                    @endforeach
                  </select> 
                  <!-- <select class="form-input mr-10 select-active" name="nurseType[]" id="nurseType" multiple>
                    @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                    @foreach($specialty as $spl)
                    <option value="{{ $spl->id }}">{{ $spl->name }}</option>
                    @endforeach
                 <!-- </select> -->
              <!-- </div> -->
         
         
       <div class="condition_set">   
   <div class="form-group drp--clr">
        <label class="form-label" for="input-1">Type of Nurse?</label>
            <ul id="type-of-nurse-0" style="display:none;">
                @php $specialty = specialty();$spcl=$specialty[0]->id;@endphp
                <?php
                    $j = 1;
                ?>
                @foreach($specialty as $spl)
                    <li id="nursing_menus-{{ $j }}" data-value="{{ $spl->id }}">{{ $spl->name }}</li>
                    <?php
                        $j++;
                    ?>
                @endforeach
                
            </ul>
        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="type-of-nurse-0" name="nurseType[type_0][]" multiple="multiple" onchange="getNurseType('main',0)"></select>
        <span id="reqnurseTypeId" class="reqError valley"></span>
   </div>
</div>
<div class="showNurseType-0"></div>

<div class="condition_set">   
   <div class="form-group drp--clr">
        <input type="hidden" name="sub_speciality_value" class="sub_speciality_value" value="">
        <label class="form-label" for="input-1">Specialties</label>
            <ul id="speciality_preferences-0" style="display:none;">
                @php $JobSpecialties = JobSpecialties(); @endphp
                <?php
                    $k = 1;
                ?>
                @foreach($JobSpecialties as $ptl)
                    <li id="nursing_menus-{{ $k }}" data-value="{{ $ptl->id }}">{{ $ptl->name }}</li>
                    <?php
                        $k++;
                    ?>
                @endforeach
                
            </ul>
        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="speciality_preferences-0" name="specialties[type_0][]" multiple="multiple" onchange="getSecialities('main',0)"></select>
        <span id="reqspecialties" class="reqError valley"></span>
   </div>
</div>
<div class="show_specialities-0"></div>
<div class="form-group level-drp assistent_level_field">
                    <label class="form-label" for="input-1">What is your overall level of experience in nursing/midwifery?</label>
                    <!-- <input class="form-control" type="text" required="" name="fullname" placeholder="Steven Job"> -->
                    <select class="form-input mr-10 select-active" name="assistent_level">
                      <option value="">select</option>
                      @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                        @endfor
                    </select>
                    <span id="reqassistent_level" class="reqError valley"></span>
                  </div>
                  <div class="" id="mid_select">
                    <div class="form-group">
                      <!-- <label class="form-label" for="input-1">Nurse & Midwife degree</label>
                      <select class="form-input mr-10 select-active" name="degree[]" multiple>
                        <?php
                          $nurse_midwife_degree = DB::table("degree")->where('status', '1')->orderBy('name')->get();
                        ?>
                        
                        @foreach($nurse_midwife_degree as $ptl)
                        <option value="{{ $ptl->id }}">{{ $ptl->name }}</option>
                        @endforeach
                      </select>
                      <span id="reqdegree" class="reqError valley"></span> -->
                      <!-- <label class="form-label" for="input-1">Nurse & Midwife degree</label>
                       <?php
                        $nurse_midwife_degree = DB::table("degree")->where('status', '1')->orderBy('name')->get();
                       ?>
                        <ul id="nurse_degree" style="display:none;">
                             @foreach($nurse_midwife_degree as $ptl)
                              <li data-value="{{ $ptl->id }}">{{ $ptl->name }}</li>
                              
                              @endforeach
                        </ul>
                    <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="nurse_degree" name="degree[]" multiple="multiple"></select>
                    <span id="reqdegree" class="reqError valley"></span> -->
                    </div>

                  </div>
          
          

  
  
  <!-- Add All button & Remove all button code start -->
<script>
    $(document).ready(function() {

        $(document).on('select2:open', '.addAll_removeAll_btn', function () {
    const $select = $(this);
    const select2 = $select.data('select2');

    // Avoid duplicate buttons
    if ($('.select2-results .extra-buttons').length === 0) {

        const buttonsHtml = `
            <div class="extra-buttons" style="padding:8px;border-bottom:1px solid #eee;">
                <button type="button" class="select-all-button">Select All</button>
                <button type="button" class="remove-all-button">Remove All</button>
            </div>
        `;

        $('.select2-results').prepend(buttonsHtml);
    }

    // Select All
    $('.select-all-button').off('click').on('click', function () {
        const allValues = [];

        $select.find('option').each(function () {
            allValues.push($(this).val());
        });

        $select.val(allValues).trigger('change');

        // ✅ CLOSE DROPDOWN
        $select.select2('close');
    });

    // Remove All
    $('.remove-all-button').off('click').on('click', function () {
        $select.val(null).trigger('change');

        // ✅ CLOSE DROPDOWN
        $select.select2('close');
    });
});


    });
</script>
<script>
        $(document).ready(function() {

            // Add an additional search box to the dropdown
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
        });
    </script>


<!-- Add All button & Remove all button code End -->
  
  <script>
        $(document).ready(function() {
            // Initialize Select2
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
        });
    </script>
  
<script>
$(document).ready(function() {
    // Initialize Select2 for each select element with class .js-example-basic-multiple
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
    var nurse_array = [];
    // Show corresponding job lists when an option is selected in the first select
    $('.js-example-basic-multiple[data-list-id="type-of-nurse"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var nurse_len = $("#type-of-nurse li").length;
        console.log("nurse_len",nurse_len);
         
        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues",selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        for(var i = 1;i<=nurse_len;i++){
            var nurse_result_val = $(".nursing_result-"+i).val();
            //alert(nurse_result_val);
            if(selectedValues.includes(nurse_result_val)){

                $('#nursing_level-'+i).removeClass('d-none');
            }else{
                $('#nursing_level-'+i).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="nursing_entry-'+i+'"]').select2().val(null).trigger('change');
            }
        }

        if(selectedValues.includes("3") == false){
          $('.np_submenu').addClass('d-none');
          //$('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2().val(null).trigger('change');
          $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(null).trigger('change');
        }
        
        
        
        // if (selectedValues.includes("Entry level nursing")) {
        //     $('#elnj').removeClass('d-none');
        // }
        // if (selectedValues.includes("Registered Nurses (RNs)")) {
        //     $('#rns').removeClass('d-none');
        // }
        // if (selectedValues.includes("Advanced Practice Registered Nurses (APRNs)")) {
        //     $('#aprns').removeClass('d-none');
        // }
    });
    $('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var nurse_len = $("#type-of-nurse li").length;
        console.log("nurse_len",nurse_len);

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
        if(selectedValues.includes("179")){
            $('.np_submenu').removeClass('d-none');
            console.log("selectedValues",selectedValues);
        }else{
            $('.np_submenu').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(null).trigger('change');
        }
        
        
        
    });
     
     $('.js-example-basic-multiple[data-list-id="specialties"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_len = $("#specialties li").length;
        console.log("speciality_len",speciality_len);

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues",selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        for(var k = 1;k<=speciality_len;k++){
            var speciality_result_val = $(".speciality_result-"+k).val();
            //alert(speciality_result_val);
            if(selectedValues.includes(speciality_result_val)){

                $('#specility_level-'+k).removeClass('d-none');
                //$(".sub_speciality_value").val(k);
                
            }else{
                $('#specility_level-'+k).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="speciality_entry-'+k+'"]').select2().val(null).trigger('change');
            }
        }

        if(selectedValues.includes("1") == false){
          $('.surgical_row').addClass('d-none');
          $('.surgical_row_data').addClass('d-none');
          $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
        }
        if(selectedValues.includes("2") == false){
          
          $('.surgicalobs_row').addClass('d-none');
          $('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
        }

        if(selectedValues.includes("3") == false){
          
          $('.surgicalpad_row_data').addClass('d-none');
          $('.surgical_rowp_data').addClass('d-none');
          $('.neonatal_row').addClass('d-none');
          $('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
        }
        
        
    });

    var sub_specialty_data_val =  $(".sub_speciality_value").val();
    console.log("specialty_data_len",sub_specialty_data_val);

    $('.js-example-basic-multiple[data-list-id="speciality_entry-1"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#speciality_entry-1 li").length;
        console.log("speciality_entry",speciality_entry);
        // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
        $(".surgical_row_data").insertAfter("#specility_level-1");
        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues",selectedValues.includes("96"));
        //$('.result--show .form-group').addClass('d-none');

        if(selectedValues.includes("96")){
            $('.surgical_row_data').removeClass('d-none');
        }else{
            $('.surgical_row_data').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
        }

        if(selectedValues.includes("96") == false){
          $('.surgical_row').addClass('d-none');
          $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
        }

        

        // for(var k = 1;k<=speciality_entry;k++){
        //     var speciality_result_val = $(".speciality_result-"+k).val();
        //     //alert(speciality_result_val);
        //     if(selectedValues.includes(speciality_result_val)){

        //         $('#specility_level-'+k).removeClass('d-none');
                
        //     }else{
        //         $('#specility_level-'+k).addClass('d-none');
        //     }
        // }
    });
    $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#surgical_row_box li").length;
        console.log("speciality_entry",speciality_entry);
        // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
        $(".specialty_sub_boxes").insertAfter(".surgical_row_data");
        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues",selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        // if(selectedValues.includes("97")){
        //     $('.surgical_row').removeClass('d-none');
        // }else{
        //     $('.surgical_row').addClass('d-none');
        // }

        

        for(var k = 1;k<=speciality_entry;k++){
            var speciality_result_val = $(".speciality_surgical_result-"+k).val();
            
            if(selectedValues.includes(speciality_result_val)){
                
                $('.surgical_row-'+k).removeClass('d-none');
                
            }else{
                $('.surgical_row-'+k).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgical_operative_care-'+k+'"]').select2().val(null).trigger('change');
            }
        }
    });

    $('.js-example-basic-multiple[data-list-id="speciality_entry-3"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#speciality_entry-3 li").length;
        console.log("speciality_entry",speciality_entry);
        $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
        $(".paediatric_surgical_div").insertAfter("#specility_level-3");

        
        //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
        $(".neonatal_row").insertAfter("#specility_level-3");

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues",selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        if(selectedValues.includes('250')){
            $('.neonatal_row').removeClass('d-none');
        }else{
            $('.neonatal_row').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="neonatal_care"]').select2().val(null).trigger('change');
        }

        if(selectedValues.includes('285')){
            $('.surgicalpad_row_data').removeClass('d-none');
        }else{
            $('.surgicalpad_row_data').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').select2().val(null).trigger('change');
        }

        if(selectedValues.includes("285") == false){
          $('.surgical_rowp_data').addClass('d-none');
          $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
        }

        // for(var k = 1;k<=speciality_entry;k++){
        //     var speciality_result_val = $(".speciality_result-"+k).val();
        //     //alert(speciality_result_val);
        //     if(selectedValues.includes(speciality_result_val)){

        //         $('#specility_level-'+k).removeClass('d-none');
                
        //     }else{
        //         $('#specility_level-'+k).addClass('d-none');
        //     }
        // }
    });

    $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#surgical_rowpad_box li").length;
        console.log("speciality_entry",speciality_entry);
        // $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
        $(".surgical_rowp_data").insertAfter(".surgicalpad_row_data");

        
        //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
        //     $(".neonatal_row_data").insertAfter("#specility_level-3");

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues",selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        

        for(var k = 1;k<=speciality_entry;k++){
            var speciality_result_val = $(".surgical_rowp_result-"+k).val();
            //alert(speciality_result_val);
            if(selectedValues.includes(speciality_result_val)){

                $('.surgical_rowp-'+k).removeClass('d-none');
                
            }else{
                $('.surgical_rowp-'+k).addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-'+k+'"]').select2().val(null).trigger('change');
            }
        }
    });

    $('.js-example-basic-multiple[data-list-id="speciality_entry-2"]').on('change', function() {
        let selectedValues = $(this).val();
        //alert("hello");
        var speciality_entry = $("#speciality_entry-1 li").length;
        console.log("speciality_entry",speciality_entry);
        // $(".surgicalobs_row").wrapAll("<div class='col-md-12 row surgicalobs_row_data'>");
        $(".surgicalobs_row").insertAfter("#specility_level-2");

        //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

        console.log("selectedValues",selectedValues);
        //$('.result--show .form-group').addClass('d-none');

        if(selectedValues.includes("233")){
            $('.surgicalobs_row').removeClass('d-none');
        }else{
            $('.surgicalobs_row').addClass('d-none');
            $('.js-example-basic-multiple[data-list-id="surgical_obs_care"]').select2().val(null).trigger('change');
        }

        // for(var k = 1;k<=speciality_entry;k++){
        //     var speciality_result_val = $(".speciality_result-"+k).val();
        //     //alert(speciality_result_val);
        //     if(selectedValues.includes(speciality_result_val)){

        //         $('#specility_level-'+k).removeClass('d-none');
                
        //     }else{
        //         $('#specility_level-'+k).addClass('d-none');
        //     }
        // }
    });

    
    
});
</script>



   
                

                




                
                


                
        
        <div class="step_nxt">
                <div class="d-flex align-items-center justify-content-between">
                  <!-- 
                  <button type="button" class="btn btn-border-brand-2 prev-step">Previous</button> -->

                  <button type="button" class="btn btn-default w-100 next-step">Next</button>
                  <!-- <button type="button" class="btn btn-default next-step">Next</button> -->
                </div>
        </div>
              </div>
            </div>

          </div>

</div>
<div class="step step-2">
            <!-- Step 2 form fields here -->

            <div class="row ">
              <div class="col-lg-12 col-md-6 col-sm-12 mx-auto">
                <div class="text-center">
                  <!-- <p class="font-sm text-brand-2">Register </p> -->
                  <h2 class="mt-10 mb-5 text-brand-1 fs_24">You are moments away from job opportunities</h2>
                </div>

                <div class="login-register text-start mt-20" action="#">
                  
                  <div class="form-group">
                    <label class="form-label" for="input-1"> First Name *</label>
                    <input class="form-control" type="text" required="" name="fullname" id="firstNameI" placeholder="" onkeydown="return /[a-z]/i.test(event.key)">
                    <span id="reqTxtfirstNameI" class="reqError valley"></span>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="input-1">Last Name *</label>
                    <input class="form-control" type="text" required="" name="lastname" id="lastNameI" placeholder="" onkeydown="return /[a-z]/i.test(event.key)">
                    <span id="reqTxtlastNameI" class="reqError valley"></span>
                  </div>

                  <div class="form-group">
                    <label class="form-label" for="input-2">Email *</label>
                    <input class="form-control" type="email" name="email" id="emailI" onkeyup="emailVerifi()" placeholder="">
                    <span id="reqTxtemailI" class="reqError valley"></span>
                  </div>

                  <!-- <div class="form-group">
                    <label class="form-label" for="input-3">Confirm Email *</label>
                    <input class="form-control" type="email" name="confirmEmail" id="confirmEmail" onkeyup="emailVerification()" placeholder="stevenjob@gmail.com">
                    <span id="reqTxtconfirmEmail" class="reqError valley"></span>
                </div> -->
                  <!-- <div class="form-group">
                    <label class="form-label" for="input-3">Mobile Number *</label>

                    <div class="row"> -->
                      <!-- <div class="col-md-3">
                        <select name="countryCode" id="countryCode" class="form-control" placeholder="C. Code" aria-label="Default select example">
                          @php $country_phone_code = country_phone_code();@endphp
                          @forelse($country_phone_code as $cpc)
                          @if($cpc->phonecode!='0')
                          <option data-countryCode="GB" value="{{ $cpc->phonecode}}" @if($cpc->name == "Australia") selected @endif>(+{{ $cpc->phonecode}})</option>
                          @endif
                          @empty
                          @endforelse
                        </select>
                      </div> -->
                      <!-- <div class="col-md-12 mob-adj">
                        <input type="hidden" name="countryCode" id="countryCode">
                        <input type="hidden" name="countryiso" id="country_iso">
                        <input class="form-control numbers" type="text" required="" name="contact" id="contactI" placeholder="" maxlength="10" pattern="[0-9]{4}">
                        <span id="reqTxtcontactI" class="reqError valley"></span>
                      </div>
                    </div> -->



                  <!-- </div>
                  <div class="form-group">
                    <label class="form-label" for="input-4">Post Code *</label>
                    <input class="form-control numbers" type="text" required="" name="post_code" id="post_codeI" placeholder="" maxlength="10">
                    <span id="reqTxtpost_codeI" class="reqError valley"></span>
                  </div> -->
                  <div class="form-group">
                    <label class="form-label" for="input-4">Password *</label>
                    <input class="form-control" type="password" required="" name="password" id="passwordI" placeholder="">
                    <span id="reqTxtpasswordI" class="reqError valley"></span>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="input-4">Confirm Password *</label>
                    <input class="form-control" type="password" required="" id="confirm_passwordI" name="confirm_password" placeholder="">
                    <span id="reqTxtconfirm_passwordI" class="reqError valley"></span>
                  </div>

                  <!--<div class="login_footer form-group d-flex justify-content-between">-->
                  <!--  <label class="cb-container">-->
                  <!--    <input type="checkbox"><span class="text-small">Agree our terms and policy</span><span class="checkmark"></span>-->
                  <!--  </label><a class='text-muted' href='#'>Lean more</a>-->
                  <!--</div>-->
                </div>

                
        <div class="d-flex align-items-center justify-content-between">
                  <button type="button" class="btn btn-border-brand-2 prev-step">Previous</button>
                  <!--<a type="button" class="btn btn-default" href="email_verification.php">Submit &amp; Register</a>-->
                  <button onclick="dosignup()" class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" type="submit"><span class="resetpassword">Submit &amp; Register</span>
                    <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                      <span class="sr-only">Loading...</span>
                    </div>
                  </button>
                </div>
        



              </div>
            </div>



          </div>

          <div class="step step-3">

            <h1>Step 3</h1>


          </div>
</form>


    </div>

  </section>
</main>





@endsection
@section('js')
<script type="text/javascript">
  function getNurseType(level,k){
    // alert();

    if(level == "main"){
      var selectedValues = $('.js-example-basic-multiple[data-list-id="type-of-nurse-'+k+'"]').val();
    }else{
      var selectedValues = $('.js-example-basic-multiple-nurse'+k+'[data-list-id="type-of-nurse-'+k+'"]').val();
    }
    
    console.log("selectedValues",level);

    $(".showNurseType-"+k+" .subnurse_list").each(function(i,val){
        var val1 = $(val).val();
        console.log("val",val1);
        if(selectedValues.includes(val1) == false){
          $(".subnurse_main_div-"+val1).remove();
            
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

            if(data1.sub_nurse_data.length > 0){
              $(".showNurseType-"+k).append('\<div class="subnurse_main_div subnurse_main_div-'+data1.main_nurse_id+'">\
                            <div class="subnurse_div subnurse_div-'+data1.main_nurse_id+' form-group level-drp">\
                            <label class="form-label subnurse_label subnurse_label-'+data1.main_nurse_id+'" for="input-1">'+data1.main_nurse_name+'</label>\
                            <input type="hidden" name="subnurse_list" class="subnurse_list subnurse_list-'+data1.main_nurse_id+'" value="'+data1.main_nurse_id+'">\
                            <ul id="type-of-nurse-'+data1.main_nurse_id+'" style="display:none;">'+nurse_text+'</ul>\
                            <select class="js-example-basic-multiple-nurse'+data1.main_nurse_id+' subnurse_valid-'+data1.main_nurse_id+' addAll_removeAll_btn" data-list-id="type-of-nurse-'+data1.main_nurse_id+'" name="nurseType[type_'+data1.main_nurse_id+'][]" onchange="getNurseType(\''+sub+'\',\''+data1.main_nurse_id+'\')" multiple="multiple"></select>\
                            <span id="reqsubnursevalid-'+data1.main_nurse_id+'" class="reqError text-danger valley"></span>\
                            </div>\
                            <div class="subnurse_level-'+data1.main_nurse_id+'"></div>\
                            </div><div class="show_nurse-'+data1.main_nurse_id+'"></div>');

                            selectTwoFunction("-nurse"+data1.main_nurse_id);
            }
            
          }
        });
      }
    }
  }

  function getSecialities(level,k){
      // alert();

      if(level == "main"){
        var selectedValues = $('.js-example-basic-multiple[data-list-id="speciality_preferences-'+k+'"]').val();
      }else{
        var selectedValues = $('.js-example-basic-multiple'+k+'[data-list-id="speciality_preferences-'+k+'"]').val();
      }
      
      console.log("selectedValues",selectedValues);

      $(".show_specialities-"+k+" .subspec_list").each(function(i,val){
            var val1 = $(val).val();
            console.log("val",val1);
            if(selectedValues.includes(val1) == false){
              $(".subspec_main_div-"+val1).remove();
                
            }
        });

      for(var i=0;i<selectedValues.length;i++){
        if($(".show_specialities-"+k+" .subspec_main_div-"+selectedValues[i]).length < 1){
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

              if(data1.sub_spciality_data.length > 0){
                $(".show_specialities-"+k).append('\<div class="subspec_main_div subspec_main_div-'+data1.main_speciality_id+'">\
                              <div class="subspec_div subspec_div-'+data1.main_speciality_id+' form-group level-drp">\
                              <label class="form-label subspec_label subspec_label-'+data1.main_speciality_id+'" for="input-1">'+data1.main_speciality_name+'</label>\
                              <input type="hidden" name="subspec_list" class="subspec_list subspec_list-'+data1.main_speciality_id+'" value="'+data1.main_speciality_id+'">\
                              <ul id="speciality_preferences-'+data1.main_speciality_id+'" style="display:none;">'+speciality_text+'</ul>\
                              <select class="js-example-basic-multiple'+data1.main_speciality_id+' subspec_valid-'+data1.main_speciality_id+' addAll_removeAll_btn" data-list-id="speciality_preferences-'+data1.main_speciality_id+'" name="specialties[type_'+data1.main_speciality_id+'][]" onchange="getSecialities(\''+sub+'\',\''+data1.main_speciality_id+'\')" multiple="multiple"></select>\
                              <span id="reqsubspecvalid-'+data1.main_speciality_id+'" class="reqError text-danger valley"></span>\
                              </div>\
                              <div class="subspec_level-'+data1.main_speciality_id+'"></div>\
                              </div><div class="show_specialities-'+data1.main_speciality_id+'"></div>');

                              selectTwoFunction(data1.main_speciality_id);
              
              }
            }
          });
        }
      }
    }

  function selectTwoFunction(select_id){
    
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
      $('.addAll_removeAll_btn').on('select2:open', function() {
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

      $('.js-example-basic-multiple'+select_id).select2();

      // Dynamically add the clear button
      const clearButton = $('<span class="clear-btn">✖</span>');
      $('.select2-container').append(clearButton);

      // Handle the visibility of the clear button
      function toggleClearButton() {

          const selectedOptions = $('.js-example-basic-multiple'+select_id).val();
          if (selectedOptions && selectedOptions.length > 0) {
              clearButton.show();
          } else {
              clearButton.hide();
          }
      }

      // Attach change event to select2
      $('.js-example-basic-multiple'+select_id).on('change', toggleClearButton);

      // Clear button click event
      clearButton.click(function() {

          $('.js-example-basic-multiple'+select_id).val(null).trigger('change');
          toggleClearButton();
      });

      // Initial check
      toggleClearButton();
      $('.js-example-basic-multiple'+select_id).each(function() {
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
  }
</script>  
<script type="text/javascript">
  $(document).ready(function() {
    $('.option1').on('click', function() {
      $('#nurse_select').removeClass('d-none');
    });

    $('.option2').on('click', function() {
      $('#mid_select').removeClass('d-none');
    });
  });
</script>



<script type="text/javascript">
  var currentStep = 1;
  var updateProgressBar;


  $(document).ready(function() {
    $('#multi-step-form').find('.step').slice(1).hide();
    var nurse_array = [];
    $(".next-step").click(function() {
   
      

      if (currentStep == 1) {
        
        if (validateForm() == false) {
          return false;
        } 
        window.scrollTo(0, 0);
        currentStep++;
        $(".step-" + currentStep).addClass("animate__animated animate__fadeOutLeft");

        setTimeout(function() {
          $(".step").removeClass("animate__animated animate__fadeOutLeft").hide();
          $(".step-" + currentStep).show().addClass("animate__animated animate__fadeInRight");
          updateProgressBar();
        }, 500);
      }
    });

    $(".prev-step").click(function() {
      if (currentStep > 1) {
        window.scrollTo(0, 0);
        $(".first_step").addClass("registration_progress");
      $(".second_step").removeClass("registration_progress");
        $(".step-" + currentStep).addClass("animate__animated animate__fadeOutRight");
        currentStep--;
        setTimeout(function() {
          $(".step").removeClass("animate__animated animate__fadeOutRight").hide();
          $(".step-" + currentStep).show().addClass("animate__animated animate__fadeInLeft");
          updateProgressBar();
        }, 500);
      }
    });

    updateProgressBar = function() {
      var progressPercentage = ((currentStep - 1) / 2) * 100;
      $(".progress-bar").css("width", progressPercentage + "%");
    }
  });
</script>
<script>
  function validate(step_no) {

  }
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#specialtyId').change(function() {
      var specialtyId = $(this).val();
      if (specialtyId !== '') {
        // Show the subspecialty select input group

        // Fetch the subspecialties based on the selected specialty
        $.ajax({
          url: '{{ route("nurse.fetch-subspecialty")}}',
          method: 'GET',
          data: {
            specialty_id: specialtyId
          },
          success: function(response) {
            // Clear existing options
            $('#subspecialtyId').empty();
            // Check if there are subspecialties available
            if (response.subspecialty.length > 0) {
              // If there are subspecialties available, show the subspecialty select input group
              $('#subspecialtyGroup').show();
              // Add new options
              $.each(response.subspecialty, function(index, subspecialty) {
                $('#subspecialtyId').append('<option value="' + subspecialty.id + '">' + subspecialty.name + '</option>');
              });
            } else {
              // If no subspecialties are available, hide the subspecialty select input group
              $('#subspecialtyGroup').hide();
            }

          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      } else {
        // If no specialty is selected, hide the subspecialty select input group

        // Clear options of subspecialty select input
        $('#subspecialtyId').empty();

        // Hide the subspecialty select input group
        $('#subspecialtyGroup').hide();
      }
    });
  });
</script>
<script>
  function validateForm() {
    var isValid = true;
    $('.reqError ').html("");
    $('[name="nurseType[]"]').next('.text-danger').remove();

    $('[name="nurseTypeJob[]"]').next('.text-danger').remove();

    $('[name="assistent_level"]').next('.text-danger').remove();
    $('[name="specialties[]"]').next('.text-danger').remove();
    $('[name="subSpecialties[]"]').next('.text-danger').remove();


    // Validate nurseType select
    if ($('[name="nurseType[]"]').val() == '') {
      document.getElementById("reqnurseTypeId").innerHTML = "* Please select one or more Type of nurse";
      isValid = false;
    }
    if ($('#nurse_select').css('display') !== 'none') {
      // Validate nurseTypeJob select nurseTypeJob
      if ($('[name="nurseTypeJob[]"]').val() == '') {
        document.getElementById("reqnurseTypeJobId").innerHTML = "* Please select one or more Type of Nursing Jobs";
        isValid = false;

      }

    }
    // Validate assistant level select
    if ($('[name="assistent_level"]').val() == '') {
      
      document.getElementById("reqassistent_level").innerHTML = "*  Please select on what level are you ?";
      isValid = false;
    }

    // Validate  Specialties type select
    if ($('[name="specialties[]"]').val() == '') {
      document.getElementById("reqspecialties").innerHTML = "* Please select one or more specialties.";
      isValid = false;
    }
    // Validate sub Specialties type select
    if ($('[name="subSpecialties[]"]').val() == '') {
      document.getElementById("reqsubSpecialties").innerHTML = "* Please select one or more sub-Specialties.";
      isValid = false;
    }

    

    // Validate  NURSE & MIDWIFE DEGREE type select
    if ($('[name="degree[]"]').val() == '') {
      document.getElementById("reqdegree").innerHTML = "* Please select one or more degree.";
      isValid = false;
    }

    if(isValid == true){
      $(".first_step").removeClass("registration_progress");
      $(".second_step").addClass("registration_progress");
    }

    

    return isValid;
  }
</script>
<script>
  function emailVerifi() {
    var mail = document.getElementById('emailI').value;


    $.ajax({
      type: 'POST',
      url: "{{route('nurse.mail-exist')}}",
      data: {
        "email": mail,
      },
      dataType: 'JSON',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(resp) {
        if (resp.status == 1) {
          document.getElementById("reqTxtemailI").innerHTML = "*" + resp.message;
          //  $('#emailI').val('');
          $('#nexres').prop('disabled', true);


        }
        if (resp.status == 0) {
          document.getElementById("reqTxtemailI").innerHTML = "";
          $('#nexres').prop('disabled', false);
        }
      }
    });

    return false;

  }
</script>
<script>
  function dosignup() {

    event.preventDefault();

    $(".valley").html("");

    $('.submit-btn-120').prop('disabled', true);

    $('.submit-btn-1').show();

    $('.resetpassword').hide();

    var returnValue;

    var firstNameI = document.getElementById("firstNameI").value;
    var lastNameI = document.getElementById("lastNameI").value;


    // var countryCode = document.getElementById("countryCode").value;

    // var contactI = document.getElementById("contactI").value;



    // var post_codeI = document.getElementById("post_codeI").value;
    var emailI = document.getElementById("emailI").value;
    //var confirmEmail = document.getElementById("confirmEmail").value;


    var passwordI = document.getElementById("passwordI").value;

    var confirm_passwordI = document.getElementById("confirm_passwordI").value;


    returnValue = true;
    if (emailI.trim() == "") {

      document.getElementById("reqTxtemailI").innerHTML = "* Please enter the Email address.";

      returnValue = false;

    }
    // if (confirmEmail.trim() == "") {

    //   document.getElementById("reqTxtconfirmEmail").innerHTML = "* Please enter the Confirm Email address.";

    //   returnValue = false;

    // }

    



    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (emailI.match(mailformat)) {

      returnValue = true;

    } else {

      document.getElementById("reqTxtemailI").innerHTML = "* Please enter the  Email address.";

      returnValue = false;

    }

   
    if (firstNameI.trim() == "") {

      document.getElementById("reqTxtfirstNameI").innerHTML = "* Please enter the First Name .";

      returnValue = false;

    }
    if (lastNameI.trim() == "") {

      document.getElementById("reqTxtlastNameI").innerHTML = "* Please enter the Last Name .";

      returnValue = false;

    }
    // if (post_codeI.trim() == "") {

    //   document.getElementById("reqTxtpost_codeI").innerHTML = "* Please enter the Post Code .";

    //   returnValue = false;

    // }

    // if (countryCode.trim() == "") {
    //   document.getElementById("reqTxtcountryCode").innerHTML = "*  Select the country code.";
    //   returnValue = false;
    // }


    // if (contactI.trim() == "") {

    //   document.getElementById("reqTxtcontactI").innerHTML = "* Please enter the Phone Number .";

    //   returnValue = false;

    // }









    if (passwordI == "") {

      document.getElementById("reqTxtpasswordI").innerHTML = "*  Please enter the PasswordI.";

      returnValue = false;

    }

    

    var pattern = /^.*(?=.{7,12})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&!-_]).*$/;

    if (!pattern.test(passwordI)) {

      document.getElementById("reqTxtpasswordI").innerHTML = "Password length should be 7 Characters with atleast 1 number, lower, upper & special(@#$%&!-_&) characters.";

      returnValue = false;

    }

    // for (var i=0; i<passwordI.length; i++) {

    //   if ( passwordI.indexOf(passwordI[i]) !== passwordI.lastIndexOf(passwordI[i]) ) {
    //     document.getElementById("reqTxtpasswordI").innerHTML = "Characters can not be repeat";
    //     returnValue = false;
    //   }
    // }

    if (confirm_passwordI == "") {

      document.getElementById("reqTxtconfirm_passwordI").innerHTML = "* Please Enter the Confirm password.";

      returnValue = false;

    }

    if (passwordI != confirm_passwordI) {

      document.getElementById("reqTxtconfirm_passwordI").innerHTML = "Password and Confirm password do not match.";

      returnValue = false;

    }

    // var emailError = document.getElementById("reqTxtemailI");
    //     var confirmEmailError = document.getElementById("reqTxtconfirmEmail");

    // if (emailI.trim() !== confirmEmail.trim()) {
    //         emailError.textContent = "Emails do not match";
    //         confirmEmailError.textContent = "Emails do not match";
    //         returnValue = false;
    //     } else {
    //         emailError.textContent = "";
    //         confirmEmailError.textContent = "";
    //     }

    if (returnValue == false) {

      $('.submit-btn-120').prop('disabled', false);

      $('.submit-btn-1').hide();

      $('.resetpassword').show();

    }



    if (returnValue == true) {

      let formData = new FormData($('#multi-step-form')[0]);



      $.ajax({

        type: 'POST',

        url: "{{route('nurse.do-nurse-register')}}",

        data: formData,

        dataType: 'JSON',

        processData: false,

        contentType: false,

        cache: false,

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        },

        beforeSend: function() {

          $('.submit-btn-120').prop('disabled', true);

          $('.submit-btn-1').show();

          $('.resetpassword').hide();



        },

        success: function(resp) {



          if (resp.status == 1) {

            $('.submit-btn-120').prop('disabled', false);

            $('.submit-btn-1').hide();

            $('.resetpassword').show();

            $('#multi-step-form')[0].reset();



            Swal.fire({

              icon: 'success',

              title: 'Registered Successfully',

              text: resp.message,

            }).then(function() {

              window.location = resp.url;

            });



          } else {

            $('.submit-btn-120').prop('disabled', false);

            $('.submit-btn-1').hide();

            $('.resetpassword').show();

            Swal.fire({

              'icon': 'error',

              'title': 'Error',

              'text': resp.message

            });

            printErrorMsg(resp.validation);

          }

        }

      });

      return false;

    }



  }



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



<script type="text/javascript">
  $(document).ready(function() {
    $('#yes').click(function() {
      $('.yes_btn').addClass('activ1').siblings().removeClass('activ');
    });
    $('#no').click(function() {
      $('.no_btn').addClass('activ').siblings().removeClass('activ1');
    });
  });
</script>
 <script src= 
"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"> 
       </script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
<script>
    $(document).ready(function() {
  var phoneInputID = "#contactI";
  var input = document.querySelector(phoneInputID);
  var iti = window.intlTelInput(input, {
    // allowDropdown: false,
    // autoHideDialCode: false,
    // autoPlaceholder: "off",
    // dropdownContainer: document.body,
    // excludeCountries: ["us"],
    formatOnDisplay: true,
    // geoIpLookup: function(callback) {
    //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
    //     var countryCode = (resp && resp.country) ? resp.country : "";
    //     callback(countryCode);
    //   });
    // },
    hiddenInput: "full_number",
    initialCountry: "AU",
    // localizedCountries: { 'de': 'Deutschland' },
    // nationalMode: false,
    // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
    // placeholderNumberType: "MOBILE",
    preferredCountries: ['AU'],
    // separateDialCode: true,
    utilsScript: ""
  });


  $(phoneInputID).on("countrychange", function(event) {

    // Get the selected country data to know which country is selected.
    var selectedCountryData = iti.getSelectedCountryData();
    console.log("selectedCountryData",selectedCountryData.dialCode);
    $("#countryCode").val(selectedCountryData.dialCode);
    $("#country_iso").val(selectedCountryData.iso2);
    //alert($("#contactI").intlTelInput("getSelectedCountryData").dialCode);
    // Get an example number for the selected country to use as placeholder.
    // newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),

    //   // Reset the phone number input.
    //   iti.setNumber("");

    // // Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
    // mask = newPlaceholder.replace(/[1-9]/g, "0");

    // // Apply the new mask for the input
    // $(this).mask(mask);
  });


  // When the plugin loads for the first time, we have to trigger the "countrychange" event manually, 
  // but after making sure that the plugin is fully loaded by associating handler to the promise of the 
  // plugin instance.

  iti.promise.then(function() {
    $(phoneInputID).trigger("countrychange");
  });

});
   $(document).ready(function () { 
                //Select2 
                $(".country").select2(); 
                $(".specialties").select2();
                $("#nurseTypeJob").select2();
                $("#subSpecialties").select2();
                $("#surgicalsubSpecialties").select2();
                
                $(".country").change(function () {
                  var selectedValues = $(this).val();
                  if (selectedValues && selectedValues.length > 0) {
                    $.ajax({
                      url: "{{ route('getNurseTypeJobs') }}",
                      type: "POST",
                      data: {
                        nurseTypes: selectedValues,
                        _token: '{{ csrf_token() }}'
                      },
                      dataType: 'json',
                      success: function(response) {
                        $('#nurse_select').show();
                        $('#nurseTypeJob').empty();
                        $.each(response, function(index, job) {
                          $('#nurseTypeJob').append('<option value="' + job.id + '">' + job.name + '</option>');
                        });
                      },
                      error: function(xhr, status, error) {
                        console.error(error);
                      }
                    });
                  } else {
                    $('#nurse_select').hide();
                    $('#nurseTypeJob').empty();
                  }
                });
                $(".surgicalSpec").hide();
                $(".surgicalSubSpec").hide();
                var subSpecialtiesArray = [];
                $("#subSpecialties").change(function () {
                  var selectedValues = $(this).val();
                  if (selectedValues && selectedValues.length > 0) {
                    $.ajax({
                      url: "{{ route('getsurgicalSpeciality') }}",
                      type: "POST",
                      data: {
                        surgical_speciality: selectedValues,
                        _token: '{{ csrf_token() }}'
                      },
                      dataType: 'json',
                      success: function(response) {

                        if(response.length>0){
                          var selectedValuesText = $("#subSpecialties option:selected").text();
                          subSpecialtiesArray.push(selectedValuesText);
                           
                          console.log("selectedValuesText",subSpecialtiesArray.join(","));
                          $(".sub_speciality").text(subSpecialtiesArray);
                          $(".surgicalSpec").show();
                        }
                        $('#surgicalsubSpecialties').empty();
                        $.each(response, function(index, job) {
                          $('#surgicalsubSpecialties').append('<option value="' + job.id + '">' + job.name + '</option>');
                        });
                      },
                      error: function(xhr, status, error) {
                        console.error(error);
                      }
                    });
                  } else {
                    $('#nurse_select').hide();
                    $('#nurseTypeJob').empty();
                  }
                });
                var sub_subSpecialtiesArray = [];
                $("#surgicalsubSpecialties").change(function () {

                  var selectedValues = $(this).val();
                  console.log("selectedValues",selectedValues);
                  if (selectedValues && selectedValues.length > 0) {
                    $.ajax({
                      url: "{{ route('getsurgicalSubSpeciality') }}",
                      type: "POST",
                      data: {
                        surgical_sub_speciality: selectedValues,
                        _token: '{{ csrf_token() }}'
                      },
                      dataType: 'json',
                      success: function(response) {
                        console.log("response",response);
                        if(response.length>0){
                          var selectedValuesText = $("#surgicalsubSpecialties option:selected").text();
                          sub_subSpecialtiesArray.push(selectedValuesText) 
                          console.log("selectedValuesText",sub_subSpecialtiesArray.join(","));
                          $(".sub_sub_speciality").text(sub_subSpecialtiesArray);
                          $(".surgicalSubSpec").show();
                          
                          
                        }
                        $('#surgicalsuboneSpecialties').empty();
                        $.each(response, function(index, job) {
                          $('#surgicalsuboneSpecialties').append('<option value="' + job.id + '">' + job.name + '</option>');
                        });
                      },
                      error: function(xhr, status, error) {
                        console.error(error);
                      }
                    });
                  } else {
                    $('#nurse_select').hide();
                    $('#nurseTypeJob').empty();
                  }
                });
            }); 
 $('#nurse_practitioner').hide(); 
 $("#nurseTypeJob").change(function () {
  var selectedValues = $(this).val();
  $.ajax({
    url: "{{ route('getNursepractitionorSpecialities') }}",
    type: "POST",
    data: {
      nurseTypeSpecialities: selectedValues,
      _token: '{{ csrf_token() }}'
    },
    dataType: 'json',
    success: function(response) {
      if(response.length>0){
        $('#nurse_practitioner').show();
      }
      // $('#nurseTypeJob').empty();
      $.each(response, function(index, job) {
        $('#nurse_practitioner_speciality').append('<option value="' + job.id + '">' + job.name + '</option>');
      });
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
 });
  // $(document).ready(function() {
  //   $('#nurseType').change(function() {
  //     var selectedValues = $(this).val();
  //     if (selectedValues && selectedValues.length > 0) {
  //       $.ajax({
  //         url: "{{ route('getNurseTypeJobs') }}",
  //         type: "POST",
  //         data: {
  //           nurseTypes: selectedValues,
  //           _token: '{{ csrf_token() }}'
  //         },
  //         dataType: 'json',
  //         success: function(response) {
  //           $('#nurse_select').show();
  //           $('#nurseTypeJob').empty();
  //           $.each(response, function(index, job) {
  //             $('#nurseTypeJob').append('<option value="' + job.id + '">' + job.name + '</option>');
  //           });
  //         },
  //         error: function(xhr, status, error) {
  //           console.error(error);
  //         }
  //       });
  //     } else {
  //       $('#nurse_select').hide();
  //       $('#nurseTypeJob').empty();
  //     }
  //   });
  // });
</script>
<script>
  $(document).ready(function() {
    $('#specialties').change(function() {
      var selectedValues = $(this).val();
      $('#subSpecialties').empty(); // Clear sub-specialties dropdown
      if (selectedValues && selectedValues.length > 0) {
        // Make an AJAX request to fetch sub-specialties based on selected specialties
        $.ajax({
          url: "{{ route('getSubSpecialties') }}",
          type: "POST",
          data: {
            specialties: selectedValues,
            // Add CSRF token to the data
            _token: '{{ csrf_token() }}'
          },
          dataType: 'json',
          success: function(response) {
            $.each(response, function(index, subSpecialty) {
              $('#subSpecialties').append('<option value="' + subSpecialty.id + '">' + subSpecialty.name + '</option>');
            });
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      }
    });
  });
</script>
<script>
    function emailVerification() {
        var email = document.getElementById("emailI").value;
        var confirmEmail = document.getElementById("confirmEmail").value;
        var emailError = document.getElementById("reqTxtemailI");
        var confirmEmailError = document.getElementById("reqTxtconfirmEmail");

        if (email !== confirmEmail) {
            emailError.textContent = "Emails do not match";
            confirmEmailError.textContent = "Emails do not match";
        } else {
            emailError.textContent = "";
            confirmEmailError.textContent = "";
        }
    }
</script>

@endsection