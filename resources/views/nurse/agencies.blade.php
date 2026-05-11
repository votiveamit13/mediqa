@extends('nurse.layouts.layout')
@section('css')

@section('content')
<main class="main">

<section class="section-box mb-70 bg-dark">
  <div class="banner-hero hero-1">
    <div class="banner-inner container">
      <div class="row align-items-center">
        <div class="col-xl-6 col-lg-6">
          <div class="block-banner text-left pb-40 pt-40 px-0">
            <h1 class="heading-banner wow animate__ animate__fadeInUp animated text-white" style="visibility: visible; animation-name: fadeInUp;">There Are <span class="color-brand-2">Talented </span><br class="d-none d-lg-block">Nurse Candidates Here For you!</h1>
            <p class="font-lg opacity_6 mt-20 text-white">Register, Post your jobs and contact top performers nurses, Find job and be contacted by the medical facilities.</p>
            <div class="mt-30 text-left"> 
              <a class="btn btn-default mr-15" href="{{ route('agencies.agencies-registraion')}}">Register Now</a>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-sm-12">
        <div class="box-image-job p-5">
          <!-- <img class="img-job-1" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/img-chart.png')}}"> -->
          {{-- <img class="img-job-2" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/img-chart.png')}}"> --}}
          <figure class="wow animate__ animate__fadeIn animated" style="visibility: visible; animation-name: fadeIn;"><img alt="jobBox" src="{{ asset('nurse/assets/imgs/img1.png')}}"></figure>
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
  </div>
</section>



 <!-- <section class="section-box overflow-visible mt-50 mb-0 bg-cat2">
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
</section> -->

<div class="banner-hero hero-1 pt-30 pb-30">
    <div class="banner-inner">
      <div class="row align-items-center">
        <div class="col-xl-8 col-lg-12">
          <div class="block-banner">
            <h1 class="heading-banner wow animate__animated animate__fadeInUp">Calling <span class="color-brand-2">All Nurses:</span><br class="">Post Your Dream Job Here!</h1>
            <div class="banner-description mt-20 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br> Donec nec justo a quam varius maximus. Maecenas <br> sodales tortor quis tincidunt commodo.</div>
            <div class="mt-30"> 
              <a href="{{ route('agencies.agencies-registraion')}}" class="btn btn-default mr-15">I want to hire</a>
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




<section class="section-box mt-70">
  <div class="container">
    <div class="text-center">
      <h2 class="section-title mb-10 wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">Top Candidates</h2>
      <p class="font-lg color-text-paragraph-2 wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">Jobs is a curated job board of the best jobs for developers, designers<br class="d-none d-lg-block">and marketers in the tech industry.</p>
    </div>
    <div class="mt-50 card-bg-white">
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="card-grid-2 hover-up">
            <div class="card-grid-2-image-left">
              <div class="card-grid-2-image-rd online"><a href="#">
                  <figure><img alt="jobBox" src="{{ asset('nurse/assets/imgs/page/candidates/user3.png')}}"></figure></a></div>
              <div class="card-profile pt-10"><a href="#">
                  <h5>Jane Cooper</h5></a><span class="font-xs color-text-mutted">Nurse</span>
                <div class="rate-reviews-small pt-5"><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span class="ml-10 color-text-mutted font-xs">(65)</span></div>
              </div>
            </div>
            <div class="card-block-info">
              <p class="font-xs color-text-paragraph-2">| Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero repellendus magni, atque delectus molestias quis?</p>
              
              <div class="employers-info align-items-center justify-content-center mt-15">
                <div class="row">
                  <div class="col-6"><span class="d-flex align-items-center"><i class="fi-rr-marker mr-5 ml-0"></i><span class="font-sm color-text-mutted">Chicago, US</span></span></div>
                  <div class="col-6"><span class="d-flex justify-content-end align-items-center"><i class="fi-rr-clock mr-5"></i><span class="font-sm color-brand-1">$45 / hour</span></span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="card-grid-2 hover-up">
            <div class="card-grid-2-image-left">
              <div class="card-grid-2-image-rd online"><a href="#">
                  <figure><img alt="jobBox" src="{{ asset('nurse/assets/imgs/page/candidates/user2.png')}}"></figure></a></div>
              <div class="card-profile pt-10"><a href="#">
                  <h5>Cody Fisher</h5></a><span class="font-xs color-text-mutted">Nurse</span>
                <div class="rate-reviews-small pt-5"><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span class="ml-10 color-text-mutted font-xs">(65)</span></div>
              </div>
            </div>
            <div class="card-block-info">
              <p class="font-xs color-text-paragraph-2">| Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero repellendus magni, atque delectus molestias quis?</p>
              
              <div class="employers-info align-items-center justify-content-center mt-15">
                <div class="row">
                  <div class="col-6"><span class="d-flex align-items-center"><i class="fi-rr-marker mr-5 ml-0"></i><span class="font-sm color-text-mutted">Chicago, US</span></span></div>
                  <div class="col-6"><span class="d-flex justify-content-end align-items-center"><i class="fi-rr-clock mr-5"></i><span class="font-sm color-brand-1">$45 / hour</span></span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="card-grid-2 hover-up">
            <div class="card-grid-2-image-left">
              <div class="card-grid-2-image-rd online"><a href="#">
                  <figure><img alt="jobBox" src="{{ asset('nurse/assets/imgs/page/candidates/user3.png')}}"></figure></a></div>
              <div class="card-profile pt-10"><a href="#">
                  <h5>Jerome Bell</h5></a><span class="font-xs color-text-mutted">Nurse</span>
                <div class="rate-reviews-small pt-5"><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span class="ml-10 color-text-mutted font-xs">(65)</span></div>
              </div>
            </div>
            <div class="card-block-info">
              <p class="font-xs color-text-paragraph-2">| Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero repellendus magni, atque delectus molestias quis?</p>
              
              <div class="employers-info align-items-center justify-content-center mt-15">
                <div class="row">
                  <div class="col-6"><span class="d-flex align-items-center"><i class="fi-rr-marker mr-5 ml-0"></i><span class="font-sm color-text-mutted">Chicago, US</span></span></div>
                  <div class="col-6"><span class="d-flex justify-content-end align-items-center"><i class="fi-rr-clock mr-5"></i><span class="font-sm color-brand-1">$45 / hour</span></span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="card-grid-2 hover-up">
            <div class="card-grid-2-image-left">
              <div class="card-grid-2-image-rd online"><a href="#">
                  <figure><img alt="jobBox" src="{{ asset('nurse/assets/imgs/page/candidates/user4.png')}}"></figure></a></div>
              <div class="card-profile pt-10"><a href="#">
                  <h5>Jane Cooper</h5></a><span class="font-xs color-text-mutted">Nurse</span>
                <div class="rate-reviews-small pt-5"><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span class="ml-10 color-text-mutted font-xs">(65)</span></div>
              </div>
            </div>
            <div class="card-block-info">
              <p class="font-xs color-text-paragraph-2">| Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero repellendus magni, atque delectus molestias quis?</p>
              
              <div class="employers-info align-items-center justify-content-center mt-15">
                <div class="row">
                  <div class="col-6"><span class="d-flex align-items-center"><i class="fi-rr-marker mr-5 ml-0"></i><span class="font-sm color-text-mutted">Chicago, US</span></span></div>
                  <div class="col-6"><span class="d-flex justify-content-end align-items-center"><i class="fi-rr-clock mr-5"></i><span class="font-sm color-brand-1">$45 / hour</span></span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="card-grid-2 hover-up">
            <div class="card-grid-2-image-left">
              <div class="card-grid-2-image-rd online"><a href="#">
                  <figure><img alt="jobBox" src="{{ asset('nurse/assets/imgs/page/candidates/user3.png')}}"></figure></a></div>
              <div class="card-profile pt-10"><a href="#">
                  <h5>Floyd Miles</h5></a><span class="font-xs color-text-mutted">Nurse</span>
                <div class="rate-reviews-small pt-5"><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span class="ml-10 color-text-mutted font-xs">(65)</span></div>
              </div>
            </div>
            <div class="card-block-info">
              <p class="font-xs color-text-paragraph-2">| Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero repellendus magni, atque delectus molestias quis?</p>
              
              <div class="employers-info align-items-center justify-content-center mt-15">
                <div class="row">
                  <div class="col-6"><span class="d-flex align-items-center"><i class="fi-rr-marker mr-5 ml-0"></i><span class="font-sm color-text-mutted">Chicago, US</span></span></div>
                  <div class="col-6"><span class="d-flex justify-content-end align-items-center"><i class="fi-rr-clock mr-5"></i><span class="font-sm color-brand-1">$45 / hour</span></span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="card-grid-2 hover-up">
            <div class="card-grid-2-image-left">
              <div class="card-grid-2-image-rd online"><a href="#">
                  <figure><img alt="jobBox" src="{{ asset('nurse/assets/imgs/page/candidates/user2.png')}}"></figure></a></div>
              <div class="card-profile pt-10"><a href="#">
                  <h5>Devon Lane</h5></a><span class="font-xs color-text-mutted">Nurse</span>
                <div class="rate-reviews-small pt-5"><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span class="ml-10 color-text-mutted font-xs">(65)</span></div>
              </div>
            </div>
            <div class="card-block-info">
              <p class="font-xs color-text-paragraph-2">| Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero repellendus magni, atque delectus molestias quis?</p>
              
              <div class="employers-info align-items-center justify-content-center mt-15">
                <div class="row">
                  <div class="col-6"><span class="d-flex align-items-center"><i class="fi-rr-marker mr-5 ml-0"></i><span class="font-sm color-text-mutted">Chicago, US</span></span></div>
                  <div class="col-6"><span class="d-flex justify-content-end align-items-center"><i class="fi-rr-clock mr-5"></i><span class="font-sm color-brand-1">$45 / hour</span></span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="card-grid-2 hover-up">
            <div class="card-grid-2-image-left">
              <div class="card-grid-2-image-rd online"><a href="#">
                  <figure><img alt="jobBox" src="{{ asset('nurse/assets/imgs/page/candidates/user3.png')}}"></figure></a></div>
              <div class="card-profile pt-10"><a href="#">
                  <h5>Jerome Bell</h5></a><span class="font-xs color-text-mutted">Nurse</span>
                <div class="rate-reviews-small pt-5"><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span class="ml-10 color-text-mutted font-xs">(65)</span></div>
              </div>
            </div>
            <div class="card-block-info">
              <p class="font-xs color-text-paragraph-2">| Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero repellendus magni, atque delectus molestias quis?</p>
              
              <div class="employers-info align-items-center justify-content-center mt-15">
                <div class="row">
                  <div class="col-6"><span class="d-flex align-items-center"><i class="fi-rr-marker mr-5 ml-0"></i><span class="font-sm color-text-mutted">Chicago, US</span></span></div>
                  <div class="col-6"><span class="d-flex justify-content-end align-items-center"><i class="fi-rr-clock mr-5"></i><span class="font-sm color-brand-1">$45 / hour</span></span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="card-grid-2 hover-up">
            <div class="card-grid-2-image-left">
              <div class="card-grid-2-image-rd online"><a href="#">
                  <figure><img alt="jobBox" src="{{ asset('nurse/assets/imgs/page/candidates/user4.png')}}"></figure></a></div>
              <div class="card-profile pt-10"><a href="#">
                  <h5>Eleanor</h5></a><span class="font-xs color-text-mutted">Nurse</span>
                <div class="rate-reviews-small pt-5"><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span><img src="{{ asset('nurse/assets/imgs/template/icons/star.svg')}}" alt="jobBox"></span><span class="ml-10 color-text-mutted font-xs">(65)</span></div>
              </div>
            </div>
            <div class="card-block-info">
              <p class="font-xs color-text-paragraph-2">| Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero repellendus magni, atque delectus molestias quis?</p>
              
              <div class="employers-info align-items-center justify-content-center mt-15">
                <div class="row">
                  <div class="col-6"><span class="d-flex align-items-center"><i class="fi-rr-marker mr-5 ml-0"></i><span class="font-sm color-text-mutted">Chicago, US</span></span></div>
                  <div class="col-6"><span class="d-flex justify-content-end align-items-center"><i class="fi-rr-clock mr-5"></i><span class="font-sm color-brand-1">$45 / hour</span></span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="{{ asset('nurse/assets/js/plugins/counterup.js')}}"></script>
</main>
@endsection
@section('js')

@endsection