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
<div class="sidebar_profile">
    <div class="box-company-profile mb-20">
      <div class="image-compay-rel">
        <img alt="{{  Auth::guard('nurse_middle')->user()->lastname }}" src="{{ asset( Auth::guard('nurse_middle')->user()->profile_img)}}">
      </div>
      <div class="row mt-10">
        <div class="text-center">
          <h5 class="f-18">{{ Auth::guard('nurse_middle')->user()->preferred }}</h5>
          @if(Auth::guard('nurse_middle')->user()->state)
          <span class="card-location font-regular">{{ state_name(Auth::guard('nurse_middle')->user()->state) }} , {{ country_name(Auth::guard('nurse_middle')->user()->country) }}</span>
          @endif
          <p class="mt-0 font-md color-text-paragraph-2 mb-15">{{ specialty_name_by_id(1) }}, 2 years</p>
        </div>
      </div>
    </div>

    <div class="profile-chklst">
      <span>Work Preferences & Flexibility</span>
      <?php
      $get_myprofile_status = DB::table("users")->where("id", Auth::guard('nurse_middle')->user()->id)->first();
      $get_educert_status = DB::table("user_education_cerification")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();

      if (!empty($get_educert_status)) {
        $get_educert_status1 = $get_educert_status->complete_status;
      } else {
        $get_educert_status1 = 0;
      }

      $get_experience_status = DB::table("user_experience")->where("user_id", Auth::guard('nurse_middle')->user()->id)->first();

      if (!empty($get_experience_status)) {
        $get_experience_status1 = $get_experience_status->complete_status;
      } else {
        $get_experience_status1 = 0;
      }

      $get_profile_status = $get_myprofile_status->basic_info_status + $get_myprofile_status->professional_info_status + $get_educert_status1 + $get_experience_status1;
      $get_progress_status = round($get_profile_status / 14 * 100);

      ?>
      {{-- <div class="chart" id="graph1" data-percent="1" data-color="#000"></div> --}}
    </div>

    
    
    <div class="box-nav-tabs nav-tavs-profile mb-5 p-0 profile-icns">
      <ul class="nav" role="tablist">
        <li><a class="{{ request()->is('nurse/position_preferences') ?'active':'' }} btn btn-border recruitment-icon mb-20 profile_tabs" href="{{ route('nurse.position_preferences', ['page' => 'position_preferences']) }}"><i class="fi fi-rr-id-badge"></i> Specialty Preferences</a></li>
        {{-- <li><a class="btn btn-border aboutus-icon mb-20 profile_tabs" href="#"><i class="fi fi-rr-percentage"></i>Match Percentage</a></li> --}}
        <li><a class="{{ request()->is('nurse/sector_preferences') ?'active':'' }} btn btn-border recruitment-icon mb-20 profile_tabs" href="{{ route('nurse.sector_preferences', ['page' => 'sector_preferences']) }}"><i class="fi fi-rr-stethoscope"></i> Sector Preferences</a></li>
        <li><a class="{{ request()->is('nurse/work_environment_preferences') ?'active':'' }} btn btn-border recruitment-icon mb-20 profile_tabs" href="{{ route('nurse.work_environment_preferences', ['page' => 'work_environment_preferences']) }}"><i class="fi fi-rr-handshake"></i> Work Environment Preferences</a></li>
        <li><a class="{{ request()->is('nurse/employeement_type_preferences') ?'active':'' }} btn btn-border recruitment-icon mb-20 profile_tabs" href="{{ route('nurse.employeement_type_preferences', ['page' => 'employeement_type_preferences']) }}"><i class="fi fi-rr-briefcase"></i> Employment type Preferences</a></li>
        <li><a class="{{ request()->is('nurse/WorkShiftPreferences') ?'active':'' }} btn btn-border recruitment-icon mb-20 profile_tabs" href="{{ route('nurse.WorkShiftPreferences', ['page' => 'WorkShiftPreferences']) }}"><i class="fi fi-rr-calendar-clock"></i> Work-Life Balance & Shift Preferences</a></li>
        
        <li><a class="{{ request()->is('nurse/benefitsPreferences') ?'active':'' }} btn btn-border recruitment-icon mb-20 profile_tabs" href="{{ route('nurse.benefitsPreferences', ['page' => 'benefitsPreferences']) }}"><i class="fi fi-rr-shield-check"></i> Benefits Preferences</a></li>
        <li><a class="{{ request()->is('nurse/locationPreferences') ?'active':'' }} btn btn-border recruitment-icon mb-20 profile_tabs" href="{{ route('nurse.locationPreferences', ['page' => 'locationPreferences']) }}"><i class="fi fi-rr-building"></i> Location Preferences</a></li>
        <li><a class="{{ request()->is('nurse/salaryExpectations') ?'active':'' }} btn btn-border recruitment-icon mb-20 profile_tabs" href="{{ route('nurse.salaryExpectations', ['page' => 'salaryExpectations']) }}"><i class="fi fi-rr-money"></i> Salary Expectation</a></li>
        
        
        <div class="mt-0 mb-20 logout-line">
          <a class="link-red font-md" href="{{ route('nurse.logout') }}"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Log Out</a>
          <a class="support-button font-md" href="{{ route('contact') }}">Need support?</a>
        </div>
      </ul>
    </div>
  </div>