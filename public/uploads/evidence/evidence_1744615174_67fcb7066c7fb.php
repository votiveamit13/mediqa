@extends('nurse.layouts.layout')
@section('css')

@section('content')


<main class="main">
      <section class="section-box">
        <div class="breacrumb-cover bg-img-about">
          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <h2 class="mb-10">About Us</h2>
                <p class="font-lg color-text-paragraph-2">Learn More About MediQa</p>
              </div>
              <div class="col-lg-6 text-lg-end">
                <ul class="breadcrumbs mt-40">
                <li><a class="home-icon" href="{{ route('home_main')}}">Home</a></li>
                  <li>About Us</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section-box mt-50">
        <div class="post-loop-grid">
          <div class="container">
            <div class="text-center">
              <h6 class="f-18 color-text-mutted text-uppercase">About Us</h6>
              <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">Who We Are?</h2>
              <p class="font-sm color-text-paragraph wow animate__animated animate__fadeInUp w-lg-50 mx-auto">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ligula ante, dictum non aliquet eu, dapibus ac quam. Morbi vel ante viverra orci tincidunt tempor eu id ipsum. Sed consectetur, risus a blandit tempor, velit magna pellentesque risus, at congue tellus dui quis nisl.</p>
            </div>
            <div class="row mt-70 align-items-center">
              <div class="col-lg-6 col-md-12 col-sm-12">
              <div class="box-image-job">
                <!-- <img class="img-job-1" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/img-chart.png')}}"> -->
                <img class="img-job-2" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/img-chart.png')}}">
                <figure class="wow animate__ animate__fadeIn animated" style="visibility: visible; animation-name: fadeIn;"><img alt="jobBox" src="{{ asset('nurse/assets/imgs/img1.png')}}"></figure>
              </div>  

              </div>
              <div class="col-lg-6 col-md-12 col-sm-12 ps-5">
                <h3 class="mt-15">What we can do?</h3>
                <div class="mt-20">
                  <p class="font-md color-text-paragraph mt-20">Aenean sollicituin, lorem quis bibendum auctor nisi elit consequat ipsum sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet maurisorbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctora ornare odio.</p>
                  <p class="font-md color-text-paragraph mt-20">Aenean sollicituin, lorem quis bibendum auctor nisi elit consequat ipsum sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet maurisorbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctora ornare odio.</p>
                  <p class="font-md color-text-paragraph mt-20">Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis non nisi purus. Integer sit nostra, per inceptos himenaeos.</p>
                  <p class="font-md color-text-paragraph mt-20">Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis non nisi purus. Integer sit nostra, per inceptos himenaeos.</p>
                </div>
              
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section-box mt-50">
        <div class="post-loop-grid">
          <div class="container">
          
            <div class="row mt-70 align-items-center">
             
              <div class="col-lg-6 col-md-12 col-sm-12 ps-5">
                <h3 class="mt-15">Our Mission</h3>
                <div class="mt-20">
                  <p class="font-md color-text-paragraph mt-20">Aenean sollicituin, lorem quis bibendum auctor nisi elit consequat ipsum sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet maurisorbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctora ornare odio.</p>
                  <p class="font-md color-text-paragraph mt-20">Aenean sollicituin, lorem quis bibendum auctor nisi elit consequat ipsum sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet maurisorbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctora ornare odio.</p>
                  <p class="font-md color-text-paragraph mt-20">Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis non nisi purus. Integer sit nostra, per inceptos himenaeos.</p>
                  <p class="font-md color-text-paragraph mt-20">Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis non nisi purus. Integer sit nostra, per inceptos himenaeos.</p>
                </div>
              
              </div>
              <div class="col-lg-6 col-md-12 col-sm-12">
              <div class="box-image-job">
                <!-- <img class="img-job-2" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/img-chart.png')}}"> -->
                <figure class="wow animate__ animate__fadeIn animated" style="visibility: visible; animation-name: fadeIn;"><img alt="jobBox" src="{{ asset('nurse/assets/imgs/nurse7.png')}}"></figure>
              </div>  

              </div>
            </div>
          </div>
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
      
    </main>
@endsection
@section('js')
@endsection