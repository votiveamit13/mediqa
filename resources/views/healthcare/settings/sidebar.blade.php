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

  .public{
    background-color:black;
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

  @php


    $visiblity = "";
    if($user_data->profile_visiblity == 1){
      $visiblity = "Public";
    }

    if($user_data->profile_visiblity == 2){
      $visiblity = "Private";
    }
  @endphp

  <div class="profile-chklst">
    <span>Profile</span>
    <span class="badge public">{{ $visiblity }}</span>
  </div>



  <div class="box-nav-tabs nav-tavs-profile mb-5 p-0 profile-icns">
    <ul class="nav" role="tablist">
      <li><a class="btn btn-border aboutus-icon mb-20 profile_tabs {{ request()->routeIs('medical-facilities.my-profile') ? 'active' : '' }}" href="{{ route('medical-facilities.my-profile') }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-user"></i> Profile</a></li>

      <li><a class="btn btn-border aboutus-icon mb-20 profile_tabs {{ request()->routeIs('medical-facilities.users') ? 'active' : '' }}" href="{{ route('medical-facilities.users') }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-user"></i> Users</a></li>
      <li><a class="btn btn-border aboutus-icon mb-20 profile_tabs {{ request()->routeIs('medical-facilities.billing') ? 'active' : '' }}" href="{{ route('medical-facilities.billing') }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-credit-card"></i> Billing</a></li>
      <li><a class="btn btn-border aboutus-icon mb-20 profile_tabs {{ request()->routeIs('medical-facilities.notification') ? 'active' : '' }}" href="{{ route('medical-facilities.notification') }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-bell"></i> Notifications</a></li>
      <li><a class="btn btn-border aboutus-icon mb-20 profile_tabs {{ request()->routeIs('medical-facilities.compliance_security') ? 'active' : '' }}" href="{{ route('medical-facilities.compliance_security') }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-shield-check"></i> Compliance & Security</a></li>
      <li><a class="btn btn-border aboutus-icon mb-20 profile_tabs" href="{{ route('medical-facilities.support') }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-headset"></i> Support</a></li>
      <div class="mt-0 mb-20 logout-line">
        <a class="link-red font-md" href="{{ route('nurse.logout') }}"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Log Out</a>
      </div>
    </ul>
  </div>
</div>
