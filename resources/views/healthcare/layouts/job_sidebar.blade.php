<style>
 
  .support-button {
    background-color: #000000;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    margin-left: 10px;
  }
  
  
  .support-button:hover {
    background-color: #000000;
    color:white;
    transform: translateY(-1px);
  }

  .disabled-tab{
    pointer-events:none;
    opacity:.5;
    cursor:not-allowed;
  }
  
  @media only screen and (min-width:1050px) and (max-width:1350px)  {
   
   .support-button {
   background-color: #000000;
   color: white;
   border: none;
   padding: 10px 8px;
   border-radius: 20px;
   font-size: 13px !important;
   font-weight: 500;
   cursor: pointer;
   transition: background-color 0.3s ease, transform 0.2s ease;
   margin-left: 10px;
}

.logout-line .font-md {
   font-size: 13px !important;
   line-height: 24px !important;
}

 }
</style>
@php
 $user_id = Auth::guard('healthcare_facilities')->user()->id;
    $user_data = DB::table("users")->where("id",$user_id)->first();
@endphp
<div class="sidebar_profile">
  <div class="box-company-profile mb-20">
    <div class="image-compay-rel">
      @if($user_data->profile_img != "nurse/assets/imgs/nurse06.png" && $user_data->profile_img != "")  
      <img alt="{{  Auth::guard('healthcare_facilities')->user()->name }}" src="{{ asset( '/healthcareimg/uploads')}}/{{ Auth::guard('healthcare_facilities')->user()->profile_img }}">
      @else
      <img alt="{{  Auth::guard('healthcare_facilities')->user()->name }}" src="{{ asset( 'https://mediqa.com/public/nurse/assets/imgs/nurse06.png')}}">
      @endif
    </div>
    <div class="row mt-10">
      <div class="text-center">
        <h5 class="f-18">{{ Auth::guard('healthcare_facilities')->user()->preferred }}</h5>
        
      </div>
    </div>
  </div>

  <div class="profile-chklst">
    <span>Job Posting</span>
   
  </div>

  

  <div class="box-nav-tabs nav-tavs-profile mb-5 p-0 profile-icns">
    <ul class="nav" role="tablist">
      <li><a class="btn btn-border aboutus-icon mb-20 profile_tabs {{ request()->routeIs('medical-facilities.location_work_modal') ? 'active' : '' }}" href="{{ route('medical-facilities.location_work_modal') }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-marker"></i> Location & Work Model</a></li>
      
      <li><a class="disabled-tab role_basic_tab btn btn-border aboutus-icon mb-20 profile_tabs  {{ request()->routeIs('medical-facilities.job_posting') ? 'active' : '' }}" href="{{ route('medical-facilities.job_posting') }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-user"></i> Role & Basics</a></li>
      <li><a class="requirement_tab disabled-tab btn btn-border aboutus-icon mb-20 profile_tabs {{ request()->routeIs('medical-facilities.requirements') ? 'active' : '' }}" href="{{ route('medical-facilities.requirements') }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-clipboard-check"></i> Requirements</a></li>
      <li><a class="disabled-tab contarct_pay btn btn-border aboutus-icon mb-20 profile_tabs {{ request()->routeIs('medical-facilities.contract_pay') ? 'active' : '' }}" href="{{ route('medical-facilities.contract_pay') }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-document"></i> Contract & Pay</a></li>
      <li><a class="disabled-tab shift_scheduling btn btn-border aboutus-icon mb-20 profile_tabs {{ request()->routeIs('medical-facilities.shift_scheduling') ? 'active' : '' }}" href="{{ route('medical-facilities.shift_scheduling') }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-calendar-clock"></i> Shifts & Scheduling</a></li>
      <li><a class="disabled-tab benefits btn btn-border aboutus-icon mb-20 profile_tabs {{ request()->routeIs('medical-facilities.job_benefits') ? 'active' : '' }}" href="{{ route('medical-facilities.job_benefits') }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-gift"></i> Benefits</a></li>
      <li><a class="disabled-tab visiblity_apply_settings btn btn-border aboutus-icon mb-20 profile_tabs {{ request()->routeIs('medical-facilities.visiblity_settings') ? 'active' : '' }}" href="{{ route('medical-facilities.visiblity_settings') }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-eye"></i> Visibility & Apply Settings</a></li>
      <li><a class="disabled-tab job_description btn btn-border aboutus-icon mb-20 profile_tabs {{ request()->routeIs('medical-facilities.job_description') ? 'active' : '' }}" href="{{ route('medical-facilities.job_description') }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-align-left"></i> Job Description</a></li>
      <li><a class="disabled-tab review_publish btn btn-border aboutus-icon mb-20 profile_tabs {{ request()->routeIs('medical-facilities.reviewPublish') ? 'active' : '' }}" href="{{ route('medical-facilities.reviewPublish') }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-paper-plane"></i> Review & Publish</a></li>
      <div class="mt-0 mb-20 logout-line">
        <a class="link-red font-md" href="{{ route('nurse.logout') }}"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Log Out</a>
        
      </div>
    </ul>
  </div>
</div>
<script>
  var tab_name = sessionStorage.getItem("tab-one");

  if(tab_name == "location_work_modal"){
    $(".role_basic_tab").removeClass("disabled-tab");
  }

  if(tab_name == "role_basics"){
    $(".role_basic_tab").removeClass("disabled-tab");
    $(".requirement_tab").removeClass("disabled-tab");
  }

  if(tab_name == "requirements"){
    $(".role_basic_tab").removeClass("disabled-tab");
    $(".requirement_tab").removeClass("disabled-tab");
    $(".contarct_pay").removeClass("disabled-tab");
  }

  if(tab_name == "contarct_pay"){
    $(".role_basic_tab").removeClass("disabled-tab");
    $(".requirement_tab").removeClass("disabled-tab");
    $(".contarct_pay").removeClass("disabled-tab");
    $(".shift_scheduling").removeClass("disabled-tab");
  }

  if(tab_name == "shift_scheduling"){
    $(".role_basic_tab").removeClass("disabled-tab");
    $(".requirement_tab").removeClass("disabled-tab");
    $(".contarct_pay").removeClass("disabled-tab");
    $(".shift_scheduling").removeClass("disabled-tab");
    $(".benefits").removeClass("disabled-tab");
  }

  if(tab_name == "benefits"){
    $(".role_basic_tab").removeClass("disabled-tab");
    $(".requirement_tab").removeClass("disabled-tab");
    $(".contarct_pay").removeClass("disabled-tab");
    $(".shift_scheduling").removeClass("disabled-tab");
    $(".benefits").removeClass("disabled-tab");
    $(".visiblity_apply_settings").removeClass("disabled-tab");
  }

  if(tab_name == "visiblity_apply_settings"){
    $(".role_basic_tab").removeClass("disabled-tab");
    $(".requirement_tab").removeClass("disabled-tab");
    $(".contarct_pay").removeClass("disabled-tab");
    $(".shift_scheduling").removeClass("disabled-tab");
    $(".benefits").removeClass("disabled-tab");
    $(".visiblity_apply_settings").removeClass("disabled-tab");
    $(".job_description").removeClass("disabled-tab");
  }

  if(tab_name == "job_description"){
    $(".role_basic_tab").removeClass("disabled-tab");
    $(".requirement_tab").removeClass("disabled-tab");
    $(".contarct_pay").removeClass("disabled-tab");
    $(".shift_scheduling").removeClass("disabled-tab");
    $(".benefits").removeClass("disabled-tab");
    $(".visiblity_apply_settings").removeClass("disabled-tab");
    $(".job_description").removeClass("disabled-tab");
    $(".review_publish").removeClass("disabled-tab");
  }

  const params = new URLSearchParams(window.location.search);
  const jobId = params.get("job_id");

  console.log(jobId); // 25
  if(jobId){
    $(".role_basic_tab").removeClass("disabled-tab");
    $(".requirement_tab").removeClass("disabled-tab");
    $(".contarct_pay").removeClass("disabled-tab");
    $(".shift_scheduling").removeClass("disabled-tab");
    $(".benefits").removeClass("disabled-tab");
    $(".visiblity_apply_settings").removeClass("disabled-tab");
    $(".job_description").removeClass("disabled-tab");
    $(".review_publish").removeClass("disabled-tab");

    document.querySelectorAll(".profile_tabs").forEach(link => {
      let url = new URL(link.href);
      url.searchParams.set("job_id", jobId);
      link.href = url.toString();
    });
  }
</script>