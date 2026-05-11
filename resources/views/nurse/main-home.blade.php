@extends('nurse.layouts.layout')
@section('css')

@section('content')
<style>
  .box-swiper .swiper-container a {
    width: 250px;
  }
  .banner-hero.hero-2{
    padding: 80px 0px 60px 0px;

  }
  .image-left{
    background: #fff;
    border-radius: 5px;
    padding: 4px;
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 17px #ffffff50;
  }
  .tranding-jobs a .item-logo{
    padding: 5px 15px 5px 8px;
  }
  .tranding-jobs a .item-logo h4{
    font-size: 14px;
  }
  .tranding-jobs a .item-logo{
    gap: 6px;
  }
  p.font-sm.color-text-paragraph-2 {
    color: #517396;
}
</style>

<main class="main">
  <!-- <div class="bg-homepage1"></div> -->


  <section class="section-box">
    <div class="banner-hero hero-2">
      <div class="banner-inner">
        <div class="block-banner">
          <h1 class="text-36 color-white wow animate__animated animate__fadeInUp" style="font-size:35px;">The AI powered job matching Platform for Nurses & Midwives</h1>
          <div class="font-lg font-regular color-white mt-20 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">Reinventing Healthcare Recruitment</div>

          <div class="mt-30">
            <a href="{{ route('nurse.home') }}" class="btn btn-default mr-15">Find Jobs</a>
            <a href="{{ route('medical-facilities.medical_facilities_home_main') }}" class="btn btn-border-brand-2">Hire Nurses & Midwives</a>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- <section class="section-box pt-50 pb-50 bg-light">
    <div class="container">
      <div class="text-center">
        <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">A SPECIALIZED NURSE AT HOME WHEN YOUR NEED
        </h2>
         <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">Whether you're living with a disability, an older adult, recovering from surgery, expecting a baby, a new mother, managing a chronic illness, needing palliative or hospice care, dealing with mental health issues, fighting an infection, recovering post-surgery, or caring for a child with special needs, having a specialized nurse at home can help you stay independent and well-supported.
        </p><br>
        <a class="btn btn-default btn-shadow need_support_btn" style="cursor: pointer;">I need support</a>
      </div>
      <div class="nurse_support_slider" style="display:none">
        <div class="owl-carousel owl-theme" id="nurse_support">
          <div class="item">
            <a href="#">Home Health Nurse Practitioner</a>
          </div>
          <div class="item">
            <a href="#">Disability Children</a>
          </div>
          <div class="item">
            <a href="#">Disability Adults</a>
          </div>
          <div class="item">
            <a href="#">Diabetes Education</a>
          </div>
          <div class="item">
            <a href="#">Chronic Pain Nurse</a>
          </div>
          <div class="item">
            <a href="#">Day Infusion Treatments Nurse
</a>
          </div>
          <div class="item">
            <a href="#">Diabetes Nurse</a>
          </div>
          <div class="item">
            <a href="#">Health Assessment Nurse</a>
          </div>
          <div class="item">
            <a href="#">Hematology Nurse</a>
          </div>
          <div class="item">
            <a href="#">Holistic Care Nurse
</a>
          </div>
          <div class="item">
            <a href="#">Home Health Nurse</a>
          </div>
          <div class="item">
            <a href="#">Infusion Nurse</a>
          </div>
          <div class="item">
            <a href="#">Midwife Nurse</a>
          </div>
          <div class="item">
            <a href="#">Mother-Baby Ostomy Nurse
</a>
          </div>
          <div class="item">
            <a href="#">Pain Management Nurse</a>
          </div>
          <div class="item">
            <a href="#">Postpartum Nurse</a>
          </div>
          <div class="item">
            <a href="#">Telehealth Nurse
</a>
          </div>
        </div>
      </div>
    </div>
  </section>       -->
  <section class="section-box pt-50 pb-50 bg-light">
    <div class="container">
      <div class="text-center">
        <h2 class="trending_job_heading section-title mb-10 wow animate__animated animate__fadeInUp">Trending Jobs</h2>
        <!--  <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">Just via some simple steps, you will find your ideal candidates you’r looking for!</p> -->
      </div>
      <div class="tranding-jobs mt-40 ">
        @if ($trendingData)
        @foreach ($trendingData as $key => $item)
        <a href='{{ route("nurse.login") }}'>
          <div class="item-logo flex-nowrap flex-row align-items-center">
            <div class="image-left"><i class="fa-solid fa-briefcase text-black" style="font-size: 14px;" aria-hidden="true"></i></div>
            <div class="text-info-right">
              <h4>{{ $item->name}}</h4>
            </div>
          </div>
        </a>
        @endforeach
        @if($trendingData2)
        @foreach ($trendingData2 as $key => $items)
        <a href='{{ route("nurse.login") }}'>
          <div class="item-logo flex-nowrap flex-row align-items-center">
            <div class="image-left"><i class="fa-solid fa-briefcase text-black" style="font-size: 14px;" aria-hidden="true"></i></div>
            <div class="text-info-right">
              <h4>{{ $items->name}}</h4>
            </div>
          </div>
        </a>
        @endforeach
        @endif
        
        @else
        @if ($trendingData2)
        @foreach ($trendingData2 as $key => $item)
        <a href='{{ route("nurse.login") }}'>
          <div class="item-logo flex-nowrap flex-row align-items-center">
            <div class="image-left"><i class="fa-solid fa-briefcase text-black fs-5" aria-hidden="true"></i></div>
            <div class="text-info-right">
              <h4>{{ $item->name}}</h4>
            </div>
          </div>
        </a>
        @endforeach
        @else
        {{ 'No Data Found' }}
        @endif

        @endif
      </div>
    </div>
  </section>


  <section class="section-box mt-70 mb-40">
    <div class="container">
      <div class="text-center">
        <!-- <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">How It Works</h2> -->
        <!--  <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">Just via some simple steps, you will find your ideal candidates you’r looking for!</p> -->
      </div>
      <div class="mt-70">
        <div class="row">
          <div class="col-lg-4">
            <div class="box-step step-1">
              <h1 class="number-element">1</h1>
              <h4 class="mb-20">Nurses love <br class="d-none d-lg-block">Mediqa</h4>
              <p class="font-sm color-text-paragraph-2">
                Create your nurse profile for free
              </p>
              <p class="font-sm color-text-paragraph-2">
                Apply directly for the ideal shift or permanent position
              </p>
              <p class="font-sm color-text-paragraph-2">
                Have the option to make your profile visible to thousands of medical facilities and agencies.
              </p>
              <p class="font-sm color-text-paragraph-2">
                Employers and Agencies apply to nurses and compete for you
              </p>
              <p class="font-sm color-text-paragraph-2">
                Compare multiple offers, refine and choose the right fit for you.
              </p>
              <p class="font-sm color-text-paragraph-2">
                Accept or decline interview requests that come to you
              </p>
              <h6 class="font-lg">You are hired 3 times faster </h6>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="box-step step-2">
              <h1 class="number-element">2</h1>
              <h4 class="mb-20">AI-powered candidate<br class="d-none d-lg-block"> matching features</h4>
              <p class="font-sm color-text-paragraph-2">
                Review the most qualified candidates
              </p>
              <p class="font-sm color-text-paragraph-2">
                Allows employers to shortlist candidates for interviews with ease
              </p>
              <p class="font-sm color-text-paragraph-2">
                To measure how closely candidates match the relevant job description.
              </p>
              <p class="font-sm color-text-paragraph-2">
                Streamline and expedite the hiring process for both candidates, healthcare facilities and agencies
              </p>
              <p class="font-sm color-text-paragraph-2">
                Our platform will provide you with in-depth hiring insights so that you can identify the best individual for the job.
              </p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="box-step">
              <h1 class="number-element">3</h1>
              <h4 class="mb-20">Hospitals and Agencies<br class="d-none d-lg-block">save money</h4>
              <p class="font-sm color-text-paragraph-2">
                Hospitals Save on travel nurse, overtime, and HR expenses
              </p>
              <p class="font-sm color-text-paragraph-2">
                Hire qualified, permanent nurses faster.
              </p>
              <p class="font-sm color-text-paragraph-2">
                Access to the right specialized Nurse profiles and send interview requests.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-50 text-center"><a href="{{ route('nurse.nurse-register') }}"class="btn btn-default">Get Started</a></div>
    </div>
  </section>


  <section class="section-box bg-15 pt-50 pb-50 mt-80">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 text-center"><img class="img-job-search mt-20" src="{{ asset('nurse/assets/imgs/page/homepage3/img-job-search.png')}}" alt="jobBox"></div>
        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12">
          <h2 class="mb-40 text-white">Explore Mediqa AI-powered software</h2>
          <div class="box-checkbox mb-30">
            <h6 class="text-white">Bypass resume and phone screening</h6>
            <p class="text-white font-sm opacity_6">Resume parsing technology to automatically extract information from resumes submitted by candidates. This saves time by populating the application form with the candidate's details, reducing the need for manual data entry.
            </p>
          </div>
          <div class="box-checkbox mb-30">
            <h6 class="text-white">Automated screening criteria</h6>
            <p class="text-white font-sm opacity_6">Based on the requirements for nursing positions
              Filter and prioritize candidates who meet the specified qualifications, credentials, and experience levels.
            </p>
          </div>
          <div class="box-checkbox mb-30">
            <h6 class="text-white">Skills Assessments</h6>
            <p class="text-white font-sm opacity_6">Evaluate candidates' clinical knowledge and proficiency in various nursing tasks.</p>
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
            <h1 class="heading-banner wow animate__animated animate__fadeInUp">Save <span class="color-brand-2">time and money</span>, interview qualified, permanent and travel nurses faster!</h1>
            <div class="banner-description mt-20 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">Cut costs on travel nursing, overtime, and HR expenses
              Quickly recruit qualified, permanent nurses
              Boost your retention rate
            </div>
            <div class="mt-30">
              <a href="{{ route('medical-facilities.medical_facilities_home_main') }}" class="btn btn-default mr-15">I want to hire</a>
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


  <!-- <div class="mt-100"></div> -->


  <div class="section-box mb-30">
    <div class="container">
      <div class="box-we-hiring">
        <div class="text-1"><span class="text-we-are">We are</span><span class="text-hiring">Hiring</span></div>
        <div class="text-2">Let&rsquo;s <span class="color-brand-1">Work</span> Together<br> &amp; <span class="color-brand-1">Explore</span> Opportunities</div>
        <div class="text-3">
          <!-- <div class="btn btn-apply btn-apply-icon" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm"> -->
            <a href="{{ route('nurse.nurse-register') }}" class="btn btn-apply btn-apply-icon">Apply now </a>
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>

  <section class="section-box overflow-visible mt-30 mb-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-sm-12">
          <div class="box-image-job">
            <!-- <img class="img-job-1" alt="jobBox"  src="{{ asset('nurse/assets/imgs/page/homepage1/img-chart.png')}}"> -->
            {{-- <img class="img-job-2" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/img-chart.png')}}"> --}}
            <figure class="wow animate__animated animate__fadeIn"><img alt="jobBox" src="{{ asset('nurse/assets/imgs/img1.png')}}"></figure>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12">
          <div class="content-job-inner">
            <h2 class="text-52 wow animate__animated animate__fadeInUp">You have the power, receive tailored job offers fast!</h2>
            <div class="mt-20 pr-50 text-md-lh28 wow animate__animated animate__fadeInUp">Accept or reject interview invitations. Evaluate multiple offers from leading hospitals. Select the best match for your needs.</div>
            <div class="mt-20">
              <div class="wow animate__animated animate__fadeInUp"><a class='btn btn-default' href="{{ route('nurse.home') }}">Get Interviews</a></div>
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


  <!-- <section class="section-box mt-30 mb-40">
    <div class="container">
      <h2 class="text-center mb-15 wow animate__animated animate__fadeInUp">Customer Reviews</h2>
      <div class="row mt-50">
        <div class="box-swiper">
          <div class="swiper-container swiper-group-3 swiper">
            <div class="swiper-wrapper pb-70 pt-5">
              <div class="swiper-slide">
                <div class="card-grid-6 hover-up">
                  <div class="card-text-desc mt-10">
                    <p class="font-md color-text-paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae neque metus. Vivamus consectetur ultricies commodo. Pellentesque at nisl sit amet neque finibus egestas ut at magna. Cras tincidunt tortor sed eros aliquam eleifend.</p>
                  </div>
                  <div class="card-image">
                    <div class="image">
                      <figure><img alt="jobBox" src="{{ asset('nurse/assets/imgs/page/about/user1.png')}}"></figure>
                    </div>
                    <div class="card-profile">
                      <h6>Mark Adair</h6><span>Nurse</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="card-grid-6 hover-up">
                  <div class="card-text-desc mt-10">
                    <p class="font-md color-text-paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae neque metus. Vivamus consectetur ultricies commodo. Pellentesque at nisl sit amet neque finibus egestas ut at magna. Cras tincidunt tortor sed eros aliquam eleifend.</p>
                  </div>
                  <div class="card-image">
                    <div class="image">
                      <figure><img alt="jobBox" src="{{ asset('nurse/assets/imgs/page/about/user2.png')}}"></figure>
                    </div>
                    <div class="card-profile">
                      <h6>Mark Adair</h6><span>Hospital</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="card-grid-6 hover-up">
                  <div class="card-text-desc mt-10">
                    <p class="font-md color-text-paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae neque metus. Vivamus consectetur ultricies commodo. Pellentesque at nisl sit amet neque finibus egestas ut at magna. Cras tincidunt tortor sed eros aliquam eleifend.</p>
                  </div>
                  <div class="card-image">
                    <div class="image">
                      <figure><img alt="jobBox" src="{{ asset('nurse/assets/imgs/page/about/user3.png')}}"></figure>
                    </div>
                    <div class="card-profile">
                      <h6>Mark Adair</h6><span>Recruiter</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-pagination swiper-pagination3"></div>
          </div>
        </div>
      </div>
    </div>
  </section> -->



  @include('nurse.component.newsletter')




  <!-- <div class="section-box mt-70">
    <div class="container">
      <div class="box-trust">
        <div class="">
          <div class="right-logos">
            <div class="box-swiper">
              <div class="swiper-container swiper-group-7 swiper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide"><a href="#"><img src="{{ asset('nurse/assets/imgs/slider/logo1.png')}}" alt="jobBox"></a></div>
                  <div class="swiper-slide"><a href="#"><img src="{{ asset('nurse/assets/imgs/slider/logo2.png')}}" alt="jobBox"></a></div>
                  <div class="swiper-slide"><a href="#"><img src="{{ asset('nurse/assets/imgs/slider/logo3.png')}}" alt="jobBox"></a></div>
                  <div class="swiper-slide"><a href="#"><img src="{{ asset('nurse/assets/imgs/slider/logo1.png')}}" alt="jobBox"></a></div>
                  <div class="swiper-slide"><a href="#"><img src="{{ asset('nurse/assets/imgs/slider/logo2.png')}}" alt="jobBox"></a></div>
                  <div class="swiper-slide"><a href="#"><img src="{{ asset('nurse/assets/imgs/slider/logo1.png')}}" alt="jobBox"></a></div>
                  <div class="swiper-slide"><a href="#"><img src="{{ asset('nurse/assets/imgs/slider/logo3.png')}}" alt="jobBox"></a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <script src="{{ asset('nurse/assets/js/plugins/counterup.js')}}"></script>
</main>

@endsection
@section('js')

@endsection