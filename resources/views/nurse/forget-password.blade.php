@extends('nurse.layouts.layout')
@section('content')
<main class="main">


<section class="pt-100 login-register">
        <div class="container"> 
          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
              <div class="text-center">
                <!-- <p class="font-sm text-brand-2">Welcome back! </p> -->
                <h2 class="mt-10 mb-5 text-brand-1">Forget Password</h2>
                <!-- <p class="font-sm text-muted mb-30">Access to all features. No credit card required.</p> -->
                <!-- <button class="btn social-login hover-up mb-20"><img src="assets/imgs/template/icons/icon-google.svg" alt="jobbox"><strong>Sign in with Google</strong></button>
                <div class="divider-text-center"><span>Or continue with</span></div> -->
              </div>
              
                                        @if (session()->has('message'))



                                        <?php echo session()->get('message'); ?>



                                        @endif
               <form class="login-register text-start mt-20"  id="form-1" onsubmit="return submit_form_step1()" action="" method="POST">

                                            @csrf

                                            @if( Session::has('error'))

                                            <div class="alert alert-danger mt-3" role="alert">

                                                <?= Session::get('error') ?>

                                            </div>

                                            @endif
            
                <div class="form-group">
                  <label class="form-label" for="input-1">Email address *</label>
                  <input class="form-control" type="text" required=""   name="email"  id="email" value="{{ old('email') }}"placeholder="Enter Email Address">
                @if ($errors->has('email'))

                                                <li style="color: red;">{{ $errors->first('email') }}</li>

                                                @endif
                </div>
                
               
                 
                <div class="form-group">
                      <!--<a class="btn btn-brand-1 hover-up w-100" href="{{ route('nurse.dashboard')}}" type="submit" name="login">Login</a>-->
                  <a href="{{ route('nurse.dashboard')}}"> <button type="submit" class="btn btn-brand-1 hover-up w-100"> Reset Password</button></a>
                </div>
                <div class="text-muted text-center"><a href='{{ route("nurse.login")}}'>Back to sign in</a></div>
              </form>
            </div>
            <!-- <div class="img-1 d-none d-lg-block"><img class="shape-1" src="assets/imgs/page/login-register/img-4.svg" alt="JobBox"></div> -->
            <!-- <div class="img-2"><img src="assets/imgs/page/login-register/img-3.svg" alt="JobBox"></div> -->
          </div>
        </div>
      </section>


</main>
@endsection
@section('js')
<script>
    function submit_form_step1() {

        let formData = new FormData($('#form-1')[0]);

        console.log(formData);

        $.ajax({

            type: 'POST',

            url: "{{url('nurse/forgot-password')}}",

            data: formData,

            dataType: 'JSON',

            processData: false,

            contentType: false,

            cache: false,

            beforeSend: function() {

                $('.submit-btn-1').prop('disabled', true);

                $('.submit-btn-1').show();

                $('.resetpassword').hide();

                // $('.submit-btn-1').html('<div class="spinner-border text-info" role="status"><span class="visually-hidden">Loading...</span></div>');

                $('.error').html('');

            },

            success: function(resp) {

                $('.submit-btn-1').prop('disabled', false);

                // $('.submit-btn-1').html('Reset Password');

                $('.submit-btn-1').hide();

                $('.resetpassword').show();



                if (resp.status == 1) {

                    $('#email').val('');

                    Swal.fire({

                        icon: 'success',

                        title: 'Sent',

                        text: resp.message,

                    })

                } else {



                    Swal.fire({

                        icon: 'error',

                        title: 'Wrong',

                        text: resp.message,

                    })

                    $('.error').html(resp.message);

                }

            }

        });

        return false;

    }
</script>
@endsection
