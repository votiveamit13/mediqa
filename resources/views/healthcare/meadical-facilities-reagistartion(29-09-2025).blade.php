@extends('nurse.layouts.layout')
@section('css')

@section('content')


<main class="main">
      <section class="pt-30 login-register">

      	<div id="container" class="container mt-5">
          
		 

		  <form id="multi-step-form">

		  
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
              <div class="login-register text-start mt-20" action="#">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                  <label class="form-label" for="input-1">Hospital Name *</label>
                  <input class="form-control" id="input-1" type="text" required="" name="fullname" placeholder="Steven Job">
                </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                  <label class="form-label" for="input-2">Email address *</label>
                  <input class="form-control" id="input-2" type="email" required="" name="emailaddress" placeholder="stevenjob@gmail.com">
                </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                  <label class="form-label" for="input-3">Mobile Number *</label>
                  <input class="form-control" id="input-3" type="text" required="" name="username" placeholder="+123 1234567890">
                </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                  <label class="form-label" for="input-4">Post Code *</label>
                  <input class="form-control" id="input-4" type="text" required="" name="password" placeholder="123456">
                </div>
                  </div>


                  <div class="col-md-12">
                    <div class="form-group">
                  <label class="form-label" for="input-4">Address</label>
                  <textarea class="form-control" rows="2"></textarea>
                  <!-- <input class="form-control" id="input-4" type="text" required="" name="password" placeholder="123456"> -->
                  </div>
                </div>

                  <div class="col-md-6">
                    <div class="form-group">
                  <label class="form-label" for="input-4">Password *</label>
                  <input class="form-control" id="input-4" type="password" required="" name="password" placeholder="********">
                </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                  <label class="form-label" for="input-4">Confirm Password *</label>
                  <input class="form-control" id="input-4" type="password" required="" name="password" placeholder="********">
                </div>
                  </div>
                </div>
                </div>
                
               
                
                
                
                

                <div class="login_footer form-group d-flex justify-content-between">
                  <label class="cb-container">
                    <input type="checkbox"><span class="text-small">Agree our terms and policy</span><span class="checkmark"></span>
                  </label><a class='text-muted' href='#'>Lean more</a>
                </div>
                 <div class="d-flex align-items-center justify-content-between">
                
              <a type="button" class="btn btn-default w-100" href="email_verification_hospital.php">Submit &amp; Register</a>
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
@endsection