@extends('nurse.layouts.layout')
@section('css')
<style>
  .reqError{
    color:red !important;
  }
</style>
@endsection

@section('content')


<main class="main">
      <section class="pt-30 login-register">

      	<div id="container" class="container mt-5">
          
		 

		  <form id="healthcare-registration-form" method="post" onsubmit="return dosignup()">

          @csrf
		     <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-12 mx-auto">
              

              <div class="banner-hero hero-1 banner-homepage5">
              <div class="banner-inner">
              <div class="banner-imgs">
                  <div class="banner-1 shape-1"><img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/nurse1.png')}}"></div>
                  <div class="banner-2 shape-2"><img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/nurse2.png')}}"></div>
                  <div class="banner-3 shape-3"><img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/nurse3.png')}}"></div>
                  <div class="banner-4 shape-3"><img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/nurse4.png')}}"></div>
                  <div class="banner-5 shape-2"><img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/nurse5.png')}}"></div>
                  <div class="banner-6 shape-1"><img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/nurse6.png')}}"></div>
                </div>
            </div>
            </div>
            </div>


            <div class="col-lg-5 col-md-6 col-sm-12 mx-auto">
              <div class="text-start">
                <!-- <p class="font-sm text-brand-2">Register </p> -->
                <h2 class="mt-10 mb-5 text-brand-1" style="line-height: 1.6em;">Healthcare Professional Registration</h2>
              </div>
              <div class="login-register text-start mt-20">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                  <label class="form-label" for="fullname">Hospital Name *</label>
                  <input class="form-control" id="fullname" type="text" name="hospital_name">
                  <span id="reqfullname" class="reqError valley"></span>
                </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                      <label class="form-label" for="emailaddress">Email address *</label>
                      <input class="form-control" id="emailaddress" type="email" name="emailaddress">
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
                    <div class="form-group">
                  <label class="form-label" for="confirm_password">Confirm Password *</label>
                  <input class="form-control" id="confirm_password" type="password" name="confirm_password">
                  <span id="reqconfirm_password" class="reqError valley"></span>
                </div>
                  </div>
                </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group level-drp">
                      <label class="form-label" for="input-1">Operating Country
                      </label>
                      <select class="form-control form-select country_dropdown" name="country" id="countryI" onchange="getStates(this.value,1)">
                        <option value="">Select Country</option>
                        @php $country_data=country_name_from_db();@endphp
                        @foreach ($country_data as $data)
                        <option value="{{$data->iso2}}"> {{$data->name}} </option>
                        @endforeach
                      </select>
                      <span id='reqcountry' class='reqError text-danger valley'></span>
                      
                    </div>
                </div>
               
                 <div class="d-flex align-items-center justify-content-between">
                
              <button class="btn btn-default px-5 py-8  rounded-2 mb-0 submit-btn-120" style="width:100%" id="healthcare_registration_btn" type="submit"><span class="resetpassword">Submit &amp; Register</span>
                    <div class="spinner-border submit-btn-1" role="status" style="display:none;">
                      <span class="sr-only">Loading...</span>
                    </div>
                  </button>
              </div>
              </div>

             


            </div>
          </div>


		      
		  </form>


		</div>

      </section>
    </main>






@endsection
@section('js')

<script>
  function dosignup(){
    var hospital_name = $("#fullname").val();
    var emailaddress = $("#emailaddress").val();
    var mobile_no = $("#mobile_no").val();
    var post_code = $("#post_code").val();
    var address = $("#address").val();
    var password = $("#password").val();
    var confirm_password = $("#confirm_password").val();
    var countryI = $("#countryI").val();

    var isValid = true;
    if(hospital_name == ""){
      $("#reqfullname").text("Please enter the Hospital Name");
      isValid = false;
    }

    if(emailaddress == ""){
      $("#reqemailaddress").text("Please enter the Email address");
      isValid = false;
    }

    if(mobile_no == ""){
      $("#reqmobile_no").text("Please enter the Mobile Number");
      isValid = false;
    }

    if(post_code == ""){
      $("#reqpost_code").text("Please enter the Post Code");
      isValid = false;
    }

    if(address == ""){
      $("#reqaddress").text("Please enter the Address");
      isValid = false;
    }

    if(password == ""){
      $("#reqpassword").text("Please enter the Password");
      isValid = false;
    }

    if(confirm_password == ""){
      $("#reqconfirm_password").text("Please enter the Confirm Password");
      isValid = false;
    }

    if(password != confirm_password){
      $("#reqconfirm_password").text("The password and confirm password do not match.");
      isValid = false;
    }

    if(countryI == ""){
      $("#reqcountry").text("Please select the operating country");
      isValid = false;
    }

    if (isValid == true) {
        $.ajax({
        url: "{{ route('medical-facilities.healthcareRegistration') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#healthcare-registration-form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#healthcare_registration_btn').prop('disabled', true);
          $('#healthcare_registration_btn').text('Process....');
        },
        success: function(res) {
          console.log("res",res);
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Congratulations! Your registration was successful. Please check your email; we have sent you a verification email to your registered address!',
            }).then(function() {
              window.location.href = res.redirect;
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
          $('#healthcare_registration_btn').prop('disabled', false);
          $('#healthcare_registration_btn').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#healthcare_registration_btn").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      
        });
      }

    return false;
  }
</script>
@endsection