@extends('nurse.layouts.layout')
@section('content')
<main class="main">


<section class="pt-100 login-register">
        <div class="container"> 
          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
              <div class="text-center">
                <!-- <p class="font-sm text-brand-2">Welcome back! </p> -->
                <h2 class="mt-10 mb-5 text-brand-1">Login</h2>
                <!-- <p class="font-sm text-muted mb-30">Access to all features. No credit card required.</p> -->
                <!-- <button class="btn social-login hover-up mb-20"><img src="assets/imgs/template/icons/icon-google.svg" alt="jobbox"><strong>Sign in with Google</strong></button>
                <div class="divider-text-center"><span>Or continue with</span></div> -->
              </div>
              
                                        @if(isset($message))

                                        <!-- <div class="alert alert-warning mt-3" role="alert"> -->

                                            <?= $message ?>

                                        <!-- </div> -->
                                         @endif

                                        @if (session()->has('message_pass'))

                                        <?php echo session()->get('message_pass'); ?>

                                        @endif

                                        <!-- <h5 class="mb-4"> <a href="index.php" class="d-inline-block text-primary"> SignsBig</a></h5> -->

                                        @if(session('message'))

                                        <?= session('message') ?>

                                        @endif
               <form class="login-register text-start mt-20" method="post" action="{{ route('nurse.userloginAction') }}">

                                            @csrf

                                            @if( Session::has('error'))

                                            <div class="alert alert-danger mt-3" role="alert">

                                                <?= Session::get('error') ?>

                                            </div>

                                            @endif
            
                <div class="form-group">
                  <label class="form-label" for="input-1">Username or Email address *</label>
                  <input class="form-control" type="text" required=""   name="email"  id="email" @if(isset($_COOKIE['email'])) value="{{ $_COOKIE['email'] }}" @endif placeholder="Enter Email Address">
                 @if ($errors->has('email'))

                                                <li style="color: red;">{{ $errors->first('email') }}</li>

                                                @endif
                </div>
                
               
                
                <div class="form-group">
                  <label class="form-label" for="input-4">Password *</label>
                  <input class="form-control" id="input-4" type="password" required="" name="password" id="password" placeholder="Enter Password" @if(isset($_COOKIE['password'])) value="{{ $_COOKIE['password'] }}" @endif>
                  
                @if ($errors->has('password'))

                                                <li style="color: red;">{{ $errors->first('password') }}</li>

                                                @endif
                </div>
                
                                                <!--<div class="d-flex justify-content-end"><a href="{{ route('nurse.forgot-password')}}">Forget password?</a></div>-->
                <div class="login_footer form-group d-flex justify-content-between">
                  <label class="cb-container">
                    <input type="checkbox" name="remember_me" value="1" @if(isset($_COOKIE['email'])) checked @endif><span class="text-small"> Remember me</span><span class="checkmark" style="border-color: #000000 !important"></span>
                  </label><a class='text-muted' href="{{ route('nurse.forgot-password')}}">Forgot Password?</a>
                  
                  
                </div>
                <div class="form-group">
                      <!--<a class="btn btn-brand-1 hover-up w-100" href="{{ route('nurse.dashboard')}}" type="submit" name="login">Login</a>-->
                  <a href="{{ route('nurse.dashboard')}}"> <button type="submit" class="btn btn-brand-1 hover-up w-100"> Login</button></a>
                </div>
                <div class="text-muted text-center">Don't have an Account? <a href='{{ route("nurse.nurse-register")}}'>Sign up</a></div>
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

@endsection
