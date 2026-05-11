@extends('nurse.layouts.layout')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
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

  form#salary_expectations_form ul.select2-selection__rendered {
    box-shadow: none;
    max-height: inherit;
    border: none;
    position: relative;
  }

  #salary_expectations_form .ui-slider-handle{
    display: block !important;
  }

  .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide the default checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* Style for the slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  transition: 0.4s;
  border-radius: 34px;
}

/* The circle inside the slider */
.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  border-radius: 50%;
  left: 4px;
  bottom: 4px;
  background-color: white;
  transition: 0.4s;
}

/* When the checkbox is checked, move the slider */
input:checked + .slider {
  background-color: black; /* Green */
}

/* When the checkbox is checked, move the circle */
input:checked + .slider:before {
  transform: translateX(26px);
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
                      <h3 class="mt-0 color-brand-1 mb-2">Salary Expectation</h3>
    
                      <form id="salary_expectations_form" method="POST" onsubmit="return salary_expectations_form()">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::guard('nurse_middle')->user()->id }}">

                        <div class="form-group level-drp payment_frequency_div" @if(!empty($salary_expectation_data) && $salary_expectation_data->fixed_salary != NULL) style="pointer-events: none; opacity: 0.5;" @endif>
                          <label class="form-label" for="input-1">Payment Frequency
                          </label>
                          <select class="form-input mr-10 select-active payment_frequency" name="payment_frequency" onchange="changeFrequency(this.value)">
                            <option value="">select</option>
                            <option value="hourly" @if(!empty($salary_expectation_data) && $salary_expectation_data->payment_frequency == "hourly") selected @endif>Hourly</option>
                            <option value="weekly" @if(!empty($salary_expectation_data) && $salary_expectation_data->payment_frequency == "weekly") selected @endif>Weekly</option>
                            <option value="monthly" @if(!empty($salary_expectation_data) && $salary_expectation_data->payment_frequency == "monthly") selected @endif>Monthly</option>
                            <option value="annually" @if(!empty($salary_expectation_data) && $salary_expectation_data->payment_frequency == "annually") selected @endif>Annually</option>
                          </select>
                          <span id='reqpayment_frequency' class='reqError text-danger valley'></span>

                          
                        </div>
                        
                        <div class="form-group level-drp salary_range_div">
                            <label class="form-label" for="input-1">Salary range</label>
                            <p>Selected Salary Range: <span id="amount"></span></p>
                            <?php
                              if(!empty($salary_expectation_data) && $salary_expectation_data->salary_range){
                                $salary_range = json_encode(explode("-",$salary_expectation_data->salary_range));
                                //print_r($salary_range);
                              }else{
                                $salary_range = '';
                              }
                            ?>
                            <div id="slider"></div>
                            <input type="hidden" name="salary_range" class="salary_range">
                        </div>
                        
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Or enter a fixed amount in AUD</label>
                          <input type="text" name="fixed_salary_amount" class="form-control fixed_salary_amount" value="@if(!empty($salary_expectation_data) && $salary_expectation_data->fixed_salary != NULL) {{ $salary_expectation_data->fixed_salary }} @endif">
                        </div>
                        <div class="">
                          <label class="form-label" for="negotiable">Negotiable Salary:</label>
                          <label class="switch">
                            <input type="checkbox" id="toggleCheckbox" name="negotiable_salary" @if(!empty($salary_expectation_data) && $salary_expectation_data->negotiable_salary == "1") checked @endif>
                            <span class="slider"></span>
                            
                          </label>
                          
                          <div class="helper_text @if(empty($salary_expectation_data) || $salary_expectation_data->negotiable_salary == 0) d-none @endif"><strong>You have selected a negotiable salary. We will show you jobs both within and outside your preferred range.</strong></div>
                          
                        </div><br>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Hourly Salary</label>
                          <input type="text" name="hourly_salary_amount" class="form-control hourly_salary_amount" value="@if(!empty($salary_expectation_data) && $salary_expectation_data->hourly_salary != NULL) {{ $salary_expectation_data->hourly_salary }} @endif" readonly>
                        </div>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Weekly Salary</label>
                          <input type="text" name="weekly_salary_amount" class="form-control weekly_salary_amount" value="@if(!empty($salary_expectation_data) && $salary_expectation_data->weekly_salary != NULL) {{ $salary_expectation_data->weekly_salary }} @endif" readonly>
                        </div>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Monthly Salary</label>
                          <input type="text" name="monthly_salary_amount" class="form-control monthly_salary_amount" value="@if(!empty($salary_expectation_data) && $salary_expectation_data->monthly_salary != NULL) {{ $salary_expectation_data->monthly_salary }} @endif" readonly>
                        </div>
                        <div class="form-group level-drp">
                          <label class="form-label" for="input-1">Annual Salary</label>
                          <input type="text" name="annual_salary_amount" class="form-control annual_salary_amount" value="@if(!empty($salary_expectation_data) && $salary_expectation_data->annual_salary != NULL) {{ $salary_expectation_data->annual_salary }} @endif" readonly>
                        </div>
                        <div class="box-button mt-15">
                          <button class="btn btn-apply-big font-md font-bold" type="submit" id="submitSalaryExpectations" @if(!email_verified()) disabled  @endif>Save Changes</button>
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

    const salaryRanges = {
            hourly: { min: 20, max: 150, values: [20, 150] },
            weekly: { min: 800, max: 6000, values: [800, 6000] },
            monthly: { min: 3467, max: 26000, values: [3467, 26000] },
            annually: { min: 41600, max: 312000, values: [41600, 312000] }
        };
        
        
        function calculateSalary(frequency,salary1, salary2){
          const hoursPerWeek = 40;
          const weeksPerYear = 52;
          const weeksPerMonth = 4.33;

          if(frequency == "hourly"){
            let hourlyMin = salary1;
            let hourlyMax = salary2;
            let weeklyMin, weeklyMax,monthlyMin, monthlyMax, annualMin, annualMax;

            weeklyMin = hourlyMin * hoursPerWeek;
            weeklyMax = hourlyMax * hoursPerWeek;
            monthlyMin = hourlyMin * hoursPerWeek * weeksPerMonth;
            monthlyMax = hourlyMax * hoursPerWeek * weeksPerMonth;
            annualMin = hourlyMin * hoursPerWeek * weeksPerYear;
            annualMax = hourlyMax * hoursPerWeek * weeksPerYear;
            console.log("monthlyMin",monthlyMin);
            console.log("monthlyMax",monthlyMax);
            $(".hourly_salary_amount").val("$"+Math.round(hourlyMin)+"- $"+Math.round(hourlyMax));
            $(".weekly_salary_amount").val("$"+Math.round(weeklyMin)+"- $"+Math.round(weeklyMax));
            $(".monthly_salary_amount").val("$"+Math.round(monthlyMin)+"- $"+Math.round(monthlyMax));
            $(".annual_salary_amount").val("$"+Math.round(annualMin)+"- $"+Math.round(annualMax));
            $(".salary_range_div").css("pointer-events","");
          }

          if(frequency == "weekly"){
            let weeklyMin = salary1;
            let weeklyMax = salary2;
            let hourlyMin, hourlyMax,monthlyMin, monthlyMax, annualMin, annualMax;

            hourlyMin = weeklyMin/40;
            hourlyMax = weeklyMax/40;
            monthlyMin = hourlyMin * hoursPerWeek * weeksPerMonth;
            monthlyMax = hourlyMax * hoursPerWeek * weeksPerMonth;
            annualMin = hourlyMin * hoursPerWeek * weeksPerYear;
            annualMax = hourlyMax * hoursPerWeek * weeksPerYear;
            console.log("monthlyMin",monthlyMin);
            console.log("monthlyMax",monthlyMax);
            $(".hourly_salary_amount").val("$"+Math.round(hourlyMin)+"- $"+Math.round(hourlyMax));
            $(".weekly_salary_amount").val("$"+Math.round(weeklyMin)+"- $"+Math.round(weeklyMax));
            $(".monthly_salary_amount").val("$"+Math.round(monthlyMin)+"- $"+Math.round(monthlyMax));
            $(".annual_salary_amount").val("$"+Math.round(annualMin)+"- $"+Math.round(annualMax));
            
          }

          if(frequency == "monthly"){
            let monthlyMin = salary1;
            let monthlyMax = salary2;
            let hourlyMin, hourlyMax,weeklyMin, weeklyMax, annualMin, annualMax;

            
            weeklyMin = monthlyMin/4.33;
            weeklyMax = monthlyMax/4.33;
            hourlyMin = weeklyMin/40;
            hourlyMax = weeklyMax/40;
            annualMin = hourlyMin * hoursPerWeek * weeksPerYear;
            annualMax = hourlyMax * hoursPerWeek * weeksPerYear;
            console.log("monthlyMin",monthlyMin);
            console.log("monthlyMax",monthlyMax);
            $(".hourly_salary_amount").val("$"+Math.round(hourlyMin)+"- $"+Math.round(hourlyMax));
            $(".weekly_salary_amount").val("$"+Math.round(weeklyMin)+"- $"+Math.round(weeklyMax));
            $(".monthly_salary_amount").val("$"+Math.round(monthlyMin)+"- $"+Math.round(monthlyMax));
            $(".annual_salary_amount").val("$"+Math.round(annualMin)+"- $"+Math.round(annualMax));
            
          }

          if(frequency == "annually"){
            let annualMin = salary1;
            let annualMax = salary2;
            let hourlyMin, hourlyMax,weeklyMin, weeklyMax, monthlyMin, monthlyMax;

            monthlyMin = annualMin/12;
            monthlyMax = annualMax/12;
            weeklyMin = monthlyMin/4.33;
            weeklyMax = monthlyMax/4.33;
            hourlyMin = weeklyMin/40;
            hourlyMax = weeklyMax/40;
            
            console.log("monthlyMin",monthlyMin);
            console.log("monthlyMax",monthlyMax);
            $(".hourly_salary_amount").val("$"+Math.round(hourlyMin)+"- $"+Math.round(hourlyMax));
            $(".weekly_salary_amount").val("$"+Math.round(weeklyMin)+"- $"+Math.round(weeklyMax));
            $(".monthly_salary_amount").val("$"+Math.round(monthlyMin)+"- $"+Math.round(monthlyMax));
            $(".annual_salary_amount").val("$"+Math.round(annualMin)+"- $"+Math.round(annualMax));
            
          }
        }
        

        function updateSlider(range,frequency) {
            console.log("range",range);
            $("#slider").slider({
                range: true,
                min: salaryRanges[frequency].min,
                max: salaryRanges[frequency].max,
                values: range.values,
                slide: function(event, ui) {
                  console.log("ui1",ui.values);
                  
                  if(ui.values[1] == "150" || ui.values[1] == "6000" || ui.values[1] == "26000" || ui.values[1] == "312000"){
                    $("#amount").text("$"+ui.values[0] + " - $" + ui.values[1] + "+");
                  }else{
                    $("#amount").text("$"+ui.values[0] + " - $" + ui.values[1]);
                  }
                  
                  $(".salary_range").val(ui.values[0] + " - " + ui.values[1]);
                  calculateSalary(frequency,ui.values[0],ui.values[1]);
                  
                }  
            });
            $("#amount").text("$"+range.values[0] + " - $" + range.values[1] + "+");
            $(".salary_range").val(range.values[0] + " - " + range.values[1]);
        }

        var sal_range = '<?php echo $salary_range; ?>';
        if(sal_range != ""){
          var salary_range = JSON.parse('<?php echo $salary_range; ?>');
        }else{
          var salary_range = [];
        }

        
        if(salary_range.length > 0){
          var salary_range1 = salary_range;
        }else{
          var salary_range1 = [0,0];
        }
        
        
            var salary_min = "<?php echo $salary_min; ?>";
            var salary_min1 = salary_min.replace(/\s+/g, '');
            var salary_max = "<?php echo $salary_max; ?>";
            var salarymax1 = salary_max.replace(/\s+/g, '');
            

            

            var payment_frequency = $(".payment_frequency").val();
            if(payment_frequency == ""){
              var salary_min2 = 20;
              var salarymax2 = 150;
            }

            if(payment_frequency == "hourly"){
              var salary_min2 = 20;
              var salarymax2 = 150;
            }

            if(payment_frequency == "weekly"){
              var salary_min2 = 800;
              var salarymax2 = 6000
            }

            if(payment_frequency == "monthly"){
              var salary_min2 = 3467;
              var salarymax2 = 26000
            }

            if(payment_frequency == "annually"){
              var salary_min2 = 41600;
              var salarymax2 = 312000
            }

            $("#slider").slider({
                range: true,
                min: salary_min2,
                max: salarymax2,
                values: [salary_min1,salarymax1],
                slide: function(event, ui) {
                  
                  if(ui.values[1] == "150" || ui.values[1] == "6000" || ui.values[1] == "26000" || ui.values[1] == "312000"){
                    console.log("ui",ui.values[1]);
                    $("#amount").text("$"+ui.values[0] + " - $" + ui.values[1] + "+");
                  }else{
                    $("#amount").text("$"+ui.values[0] + " - $" + ui.values[1]);
                  }
                  
                  $(".salary_range").val(ui.values[0] + " - " + ui.values[1]);
                  
                  calculateSalary("<?php echo $payment_frequency; ?>",ui.values[0],ui.values[1]);

                 
                }
            });
            //$("#amount").text("$"+$("#slider").slider("values", 0) + " - $" + $("#slider").slider("values", 1));
            if(salarymax1 == "150" || salarymax1 == "6000" || salarymax1 == "26000" || salarymax1 == "312000"){
              //console.log("salary_range",[$("#slider").slider("values", 0),$("#slider").slider("values", 1)]);
                $("#amount").text("$"+$("#slider").slider("values", 0) + " - $" + $("#slider").slider("values", 1) + "+");
              }else{
                
                $("#amount").text("$"+$("#slider").slider("values", 0) + " - $" + $("#slider").slider("values", 1));
              }
            

            
          function changeFrequency(value){
            
            console.log("salaryRanges",salaryRanges[value].min);
            calculateSalary(value,salaryRanges[value].min,salaryRanges[value].max);
            updateSlider(salaryRanges[value],value);

          }

          $('#toggleCheckbox').change(function() {
              if ($(this).is(':checked')) {
                  console.log("Checked: ON");
                  $(".helper_text").removeClass("d-none");
              } else {
                  console.log("Unchecked: OFF");
                  $(".helper_text").addClass("d-none");
              }
          });

          $(".fixed_salary_amount").on("keyup",function(){
            // $(".payment_frequency_div .select2-container").remove();
            // $('.payment_frequency').select2().val("hourly").trigger('change');
            $(".salary_range_div").css("pointer-events","none");
            $(".salary_range_div").css("opacity","0.5");
            $(".salary_range").prop("disabled", true);
            $(".payment_frequency_div").css("pointer-events","none");
            $(".payment_frequency_div").css("opacity","0.5");
            var value = $(this).val();
            if(value == ""){
              $(".salary_range_div").css("pointer-events","");
              $(".salary_range_div").css("opacity","");
              $(".salary_range").prop("disabled", false);
              $(".payment_frequency_div").css("pointer-events","");
              $(".payment_frequency_div").css("opacity","");
            }

            var payment_frequency = $(".payment_frequency").val();

            const hoursPerWeek = 40;
            const weeksPerYear = 52;
            const weeksPerMonth = 4.33;
            console.log("payment_frequency",payment_frequency);
            if(payment_frequency == "hourly"){
              

              let hourlyMin = value;
              
              let weeklyMin, monthlyMin, annualMin;

              weeklyMin = hourlyMin * hoursPerWeek;
              
              monthlyMin = hourlyMin * hoursPerWeek * weeksPerMonth;
              
              annualMin = hourlyMin * hoursPerWeek * weeksPerYear;
              
              
              $(".hourly_salary_amount").val("$"+Math.round(hourlyMin));
              $(".weekly_salary_amount").val("$"+Math.round(weeklyMin));
              $(".monthly_salary_amount").val("$"+Math.round(monthlyMin));
              $(".annual_salary_amount").val("$"+Math.round(annualMin));
            }

            if(payment_frequency == "weekly"){
              let weeklyMin = value;
              
              let hourlyMin, monthlyMin, annualMin;

              hourlyMin = weeklyMin/40;

              monthlyMin = hourlyMin * hoursPerWeek * weeksPerMonth;
              
              annualMin = hourlyMin * hoursPerWeek * weeksPerYear;
              
              
              $(".hourly_salary_amount").val("$"+Math.round(hourlyMin));
              $(".weekly_salary_amount").val("$"+Math.round(weeklyMin));
              $(".monthly_salary_amount").val("$"+Math.round(monthlyMin));
              $(".annual_salary_amount").val("$"+Math.round(annualMin));
            }

            if(payment_frequency == "monthly"){
              let monthlyMin = value;
              
              let hourlyMin, weeklyMin, annualMin;

              weeklyMin = monthlyMin/4.33;
              
              hourlyMin = weeklyMin/40;
              
              annualMin = hourlyMin * hoursPerWeek * weeksPerYear;
              
              
              
              $(".hourly_salary_amount").val("$"+Math.round(hourlyMin));
              $(".weekly_salary_amount").val("$"+Math.round(weeklyMin));
              $(".monthly_salary_amount").val("$"+Math.round(monthlyMin));
              $(".annual_salary_amount").val("$"+Math.round(annualMin));
            }

            if(payment_frequency == "annually"){
              let annualMin = value;
              
              let hourlyMin, weeklyMin, monthlyMin;

              monthlyMin = annualMin/12;
              
              weeklyMin = monthlyMin/4.33;
              
              hourlyMin = weeklyMin/40;
              
              
              
              
              $(".hourly_salary_amount").val("$"+Math.round(hourlyMin));
              $(".weekly_salary_amount").val("$"+Math.round(weeklyMin));
              $(".monthly_salary_amount").val("$"+Math.round(monthlyMin));
              $(".annual_salary_amount").val("$"+Math.round(annualMin));
            }
          });
    
</script>
<script type="text/javascript">
    

    function salary_expectations_form() {
      var isValid = true;
      
      if ($('[name="payment_frequency"]').val() == '') {

        document.getElementById("reqpayment_frequency").innerHTML = "* Please select the Payment Frequency.";
        isValid = false;

      }

      if (isValid == true) {
        $.ajax({
        url: "{{ route('nurse.updatesalaryExpectations') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#salary_expectations_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitSalaryExpectations').prop('disabled', true);
          $('#submitSalaryExpectations').text('Process....');
        },
        success: function(res) {
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Salary Expectation Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.salaryExpectations') }}?page=salaryExpectations";
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
          $('#submitSalaryExpectations').prop('disabled', false);
          $('#submitSalaryExpectations').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitSalaryExpectations").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      
        });
      }

      return false;
    }

</script>
<script>
    
    
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
