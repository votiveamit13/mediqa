  @if (!Auth::guard('nurse_middle')->check())
  <header class="header sticky-bar">
    <div class="container">
      <div class="main-header">
        <div class="header-left">
          <div class="header-logo"><a class='d-flex' href='{{ route("home_main") }}'><img alt="jobBox" src="{{ url('/public') }}/nurse/assets/imgs/logo.png"></a></div>
        </div>
        <div class="header-nav">
          <nav class="nav-main-menu">
            <ul class="main-menu">
              <!--  <li class="">
                  <a class='menu-link hover-up' href='{{ route("nurse.home") }}'>Home</a>
                </li> -->
              <li class="has-children">

                <a class='menu-link hover-up' href='{{ route("nurse.home") }}'>Nurses</a>
                <ul class="sub-menu">
                  @php $nurseTypeData =nurse_Type_header();@endphp
                  @if($nurseTypeData)
                  @foreach ($nurseTypeData as $key => $items)
                  <li> <a href='{{ route("nurse.login") }}' class="active"> {{ $items->name}}</a></li>
                  @endforeach
                  @endif
                  <li> <a href='{{ route("nurse.login") }}'>JOBS by specialties <i class="fa-solid fa-caret-right fs-6"></i></a>
                    <ul class="sub-menu">
                      @php $nurseTypeSpecialData =practitioner_type_header();@endphp
                      @if($nurseTypeSpecialData)
                      @foreach ($nurseTypeSpecialData as $key => $itemSps)
                      <li> <a href='{{ route("nurse.login") }}'>{{ $itemSps->name }}</a></li>
                      @endforeach
                      @endif

                    </ul>
                  </li>

                </ul>
              </li>

              <li class="">
                <a class='{{ request()->is('medical-facilities') ?"active":"" }} hover-up' href='{{ route("medical-facilities.medical_facilities_home_main") }}'>Healthcare Facilities</a>
              </li>
              <li class="">
                <a class='{{ request()->is('agencies') ?"active":"" }} hover-up' href='{{ route("agencies.agencies_home_main") }}'>Agencies</a>
              </li>
              <li class="">

                <a class='{{ request()->is('nurseCareHome') ?"active":"" }} hover-up' href='{{ route("nurseCareHome") }}'>Nurse Care at Home
                 </a>
              </li>
              <li class="">

                <a class='{{ request()->is('contact') ?"active":"" }} hover-up' href='{{ route("contact") }}'>Contact</a>
              </li>
            </ul>
          </nav>
          <div class="burger-icon burger-icon-white">
            <span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span>
          </div>
        </div>
        <div class="header-right">
          <div class="block-signin d-flex align-items-center gap-3 justify-content-end">
            <!-- <a class='text-link-bd-btom hover-up' href='nurse_signup.php'>Become a Nurse</a> -->
            <a class='btn btn-default btn-shadow hover-up' href='{{ route("nurse.login") }}'>Log in</a>
            <a class='btn btn-default btn-shadow hover-up' href='{{ route("nurse.nurse-register") }}'>Sign up</a>
            <!-- @if(request()->is('') || request()->is('/'))
            <a class='btn btn-default btn-shadow hover-up' href='{{ route("nurse.home") }}'>Sign in</a>
            @elseif(request()->is('nurse'))
            <a class='btn btn-default btn-shadow hover-up' href='{{ route("nurse.login") }}'>Sign in</a>
            @endif -->

          </div>
        </div>
      </div>
    </div>
  </header>

  @else
  <header class="header sticky-bar  border-bottom">
    <div class="container">
      <div class="main-header">
        <div class="header-left">
          <div class="header-logo"><a class='d-flex' href='{{ route("home_main") }}'><img alt="jobBox" src="{{ url('/public') }}/nurse/assets/imgs/logo.png"></a></div>
        </div>
        <div class="header-nav">
          <nav class="nav-main-menu">
            <ul class="main-menu">
              <li class="">
                <a class='menu-link hover-up' href='{{ route("nurse.dashboard") }}'>Find Jobs</a>
              </li>
              <li class="">
                <a class='hover-up' href='{{ route("nurse.dashboard") }}'>My Jobs</a>
              </li>
              <!-- <li class="">
                  <a class='' href='recruiter_signup.php'>Agencies Sign Up</a>
                </li> -->
              <li class="">
                <a class=' hover-up' href='{{ route("nurse.dashboard") }}'>Community</a>
              </li>

              <li>

                <a class="{{ request()->is('nurse/my-profile') ?"active":"" }}  hover-up " href='{{ route("nurse.my-profile") }}?page=my_profile'>Profile</a>

              </li>

            </ul>
          </nav>
          <div class="burger-icon burger-icon-white">
            <span class="burger-icon-top"></span><span class="burger-icon-mid"></span><span class="burger-icon-bottom"></span>
          </div>
        </div>
        <div class="header-right">
          <div class="block-signin d-flex align-items-center gap-3 justify-content-end">
            <!-- <a class='text-link-bd-btom hover-up' href='nurse_signup.php'>Become a Nurse</a> -->
            <div class="dropdown d-inline-block">
              <a class="btn btn-notify" id="dropdownNotify" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">
                <i class="fa-regular fa-bell"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownNotify">
                <li><a class="dropdown-item active" href="#">0 notifications</a></li>
                <li><a class="dropdown-item" href="#">0 messages</a></li>
                <li><a class="dropdown-item" href="#">0 replies</a></li>
              </ul>
            </div>


            <div class="member-login d-flex align-items-center gap-1">
             
              <div class="info-member">
                <div class="dropdown">

                  <a class="font-xs color-text-paragraph-2 icon-down" data-bs-toggle="dropdown" style="cursor:pointer;"> <img alt="{{  Auth::guard('nurse_middle')->user()->name }}" src="{{ asset( Auth::guard('nurse_middle')->user()->profile_img)}}"><strong class="color-brand-1" >{{ Auth::guard('nurse_middle')->user()->name }}</strong></a>
                  <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownProfisle">
                    <!-- <li> --><a href='{{ route("nurse.my-profile") }}?page=my_profile' class="dropdown-item">Profile</a><!-- </li> -->
                    <!--  <li> --><a class="dropdown-item change_password_link" style="cursor: pointer;">change Password</a><!-- </li> -->
                    <!-- <li> --><a href='{{ route("nurse.logout") }}' class="dropdown-item">Logout</a><!-- </li> -->
                  </ul>
                </div>
              </div>
            </div>
            <!-- <a class='btn btn-default btn-shadow hover-up' href='#'>Sign in</a> -->
          </div>
        </div>
      </div>
    </div>
  </header>
  @if(!email_verified())
  <div class="container-fluid">
    <div class="alert alert-warning mt-2" role="alert">
      <span class="d-flex align-items-center justify-content-center "><img src="{{ asset('nurse/assets/imgs/info.png') }}" width="25px;" alt="info" class="mx-2"> Thank you for signing up with us. To get full access, please verify your email first. If you didn't receive the email, <a href="javascript:void(0);" class="link-opacity-100 mx-1" style="color: black;text-decoration-line: underline;
  text-decoration-style: straight;" onclick="return resendEmailLink()"><b> click here to resend it.</b></a></span>
    </div>
  </div>
  @endif
  @if(!account_verified())
  <div class="container-fluid">
    <div class="alert alert-warning mt-2" role="alert">
      <span class="d-flex align-items-center justify-content-center "><img src="{{ asset('nurse/assets/imgs/info.png') }}" width="25px;" alt="info" class="mx-2">Thank you for verifying your email!<br>Please complete your profile, and once approved, you will be able to apply for jobs and make your profile visible.
</span>

    </div>
  </div>
  @endif
  @endif