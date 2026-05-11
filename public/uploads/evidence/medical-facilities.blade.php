@extends('nurse.layouts.layout')
@section('css')

@section('content')

<main class="main">
      <div class="bg-homepage1"></div>


      <section class="section-box pt-50 mb-70">
        <div class="banner-hero hero-1">
          <div class="banner-inner">
            <div class="row align-items-center">
              <div class="col-xl-8 col-lg-12" data-select2-id="12">
                <div class="block-banner" data-select2-id="11">
                  <h1 class="heading-banner wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">Hire <span class="color-brand-2"> Specialised</span><br class="d-none d-lg-block">Nurses</h1>
                  <div class="banner-description mt-20 wow animate__ animate__fadeInUp animated" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">Register, post and manage your positions, Quickly see and compare candidate results, Contact with top performers nurses.</div>

                  <div class="mt-30"> 
                    <a class="btn btn-default mr-15" href="{{ route('medical-facilities.medical-facilities-registraion') }}">Register Now</a>
                  </div>
                 
                </div>
              </div>
              <div class="col-xl-4 col-lg-12 d-none d-xl-block col-md-6">
                <div class="banner-imgs">
                  <div class="block-1 shape-1"><img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/banner1.png')}}"></div>
                  <div class="block-2 shape-2"><img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/banner2.png')}}"></div>
                  <div class="block-3 shape-3"><img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/icon-top-banner.png')}}"></div>
                  <div class="block-4 shape-3"><img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/icon-bottom-banner.png')}}"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


     


       <section class="section-box mt-70 mb-40">
        <div class="container">
          <div class="text-center">
            <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">How It Works</h2>
            <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">Just via some simple steps, you will find your ideal candidates you’r looking for!</p>
          </div>
          <div class="mt-70"> 
            <div class="row"> 
              <div class="col-lg-4">
                <div class="box-step step-1">
                  <h1 class="number-element">1</h1>
                  <h4 class="mb-20">Register an<br class="d-none d-lg-block">account to start</h4>
                  <p class="font-lg color-text-paragraph-2">Lorem ipsum dolor sit amet,<br class="d-none d-lg-block">consectetur adipisicing elit, sed do </p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="box-step step-2">
                  <h1 class="number-element">2</h1>
                  <h4 class="mb-20">Explore over<br class="d-none d-lg-block">thousands of resumes</h4>
                  <p class="font-lg color-text-paragraph-2">Lorem ipsum dolor sit amet,<br class="d-none d-lg-block">consectetur adipisicing elit, sed do </p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="box-step">
                  <h1 class="number-element">3</h1>
                  <h4 class="mb-20">Find the most<br class="d-none d-lg-block">suitable candidate</h4>
                  <p class="font-lg color-text-paragraph-2">Lorem ipsum dolor sit amet,<br class="d-none d-lg-block">consectetur adipisicing elit, sed do </p>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-50 text-center"><a href="{{ route('medical-facilities.medical-facilities-registraion') }}" class="btn btn-default">Get Started</a></div>
        </div>
      </section>






       <section class="section-box overflow-visible mt-50 mb-0 bg-cat2">
        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="text-center">
                <h1 class="color-brand-2"><span class="count">25</span><span> K+</span></h1>
                <h5>Completed Cases</h5>
                <p class="font-sm color-text-paragraph mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec justo a quam varius maximus. Maecenas sodales tortor quis tincidunt commodo.</p>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="text-center">
                <h1 class="color-brand-2"><span class="count">17</span><span> +</span></h1>
                <h5>Our Office</h5>
                <p class="font-sm color-text-paragraph mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec justo a quam varius maximus. Maecenas sodales tortor quis tincidunt commodo.</p>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="text-center">
                <h1 class="color-brand-2"><span class="count">86</span><span> +</span></h1>
                <h5>Skilled People</h5>
                <p class="font-sm color-text-paragraph mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec justo a quam varius maximus. Maecenas sodales tortor quis tincidunt commodo.</p>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="text-center">
                <h1 class="color-brand-2"><span class="count">28</span><span> +</span></h1>
                <h5>Happy Clients</h5>
                <p class="font-sm color-text-paragraph mt-10">We always provide people a <br class="d-none d-lg-block">complete solution upon focused of <br class="d-none d-lg-block">any business</p>
              </div>
            </div>
          </div>
        </div>
      </section>


      




      <div class="banner-hero hero-1 pt-30 pb-30">
          <div class="banner-inner">
            <div class="row align-items-center">
              <div class="col-xl-8 col-lg-12">
                <div class="block-banner">
                  <h1 class="heading-banner wow animate__animated animate__fadeInUp">Calling <span class="color-brand-2">All Nurses:</span><br class="">Post Your Dream Job Here!</h1>
                  <div class="banner-description mt-20 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br> Donec nec justo a quam varius maximus. Maecenas <br> sodales tortor quis tincidunt commodo.</div>
                  <div class="mt-30"> 
                    <a href="{{ route('medical-facilities.medical-facilities-registraion') }}"class="btn btn-default mr-15">I want to hire</a>
                    <!-- <a class="btn btn-border-brand-2">I want to hire</a> -->
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-12 d-none d-xl-block col-md-6">
                <div class="banner-imgs">
                  <div class="block-1 shape-1"><img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/banner1.png')}}"></div>
                  <div class="block-2 shape-2"><img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/banner2.png')}}"></div>
                  <div class="block-3 shape-3"><img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/icon-top-banner.png')}}"></div>
                  <div class="block-4 shape-3"><img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/icon-bottom-banner.png')}}"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <script src="{{ asset('nurse/assets/js/plugins/counterup.js')}}""></script>
    </main>

@endsection
@section('js')
@endsection