@extends('nurse.layouts.layout')
@section('content')
<main class="main">


<section class="pt-100 login-register">
        <div class="container"> 
          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
              <div class="text-center">
                <!-- <p class="font-sm text-brand-2">Welcome back! </p> -->
                <h2 class="mt-10 mb-5 text-brand-1">Reset Password</h2>
             
                <!-- <button class="btn social-login hover-up mb-20"><img src="assets/imgs/template/icons/icon-google.svg" alt="jobbox"><strong>Sign in with Google</strong></button>
                <div class="divider-text-center"><span>Or continue with</span></div> -->
              </div>
              
                                      
                                        @if (session()->has('message'))

                                        <?php echo session()->get('message'); ?>

                                        @endif

                                        @if(!isset($hide_form))
                <form id="form-1" action="{{url('nurse/reset-password')}}" method="POST">
        @csrf
                  @if( Session::has('error'))
                  <div class="alert alert-danger mt-3" role="alert">
                    <?= Session::get('error') ?>
                  </div>
                  @endif
  <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <input type="hidden" name="email" value="{{ $request->route('lp') }}">
            <input type="hidden" name="row" value="{{ $request->route('lp') }}">
                                            
            
               
                
                <div class="form-group">
                  <label class="form-label" for="input-4">Password *</label>
                  <input class="form-control" id="input-4" type="password" required="" name="password" id="password" placeholder="Enter Password">
                 
                </div>
                <div class="form-group">
                  <label class="form-label" for="input-4">Confirm Password *</label>
                  <input class="form-control" id="input-4" type="password" required="" name="password_confirmation" id="password_confirmation" placeholder="Enter Password">
             
                </div>
                
                              
                                       
                <div class="form-group">
                    
                  <a href="{{ route('nurse.dashboard')}}"> <button type="submit" class="btn btn-brand-1 hover-up w-100">Change Password</button></a>
                </div>
                <div class="text-muted text-center"><a href='{{ route("nurse.login")}}'>Back to sign in</a></div>
                   
                                        </form>
                                        @endif
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
