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
  
  .status-pill {
        padding: 4px 28px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        color: #fff;
        display: inline-block;
        white-space: nowrap;
    }

    .status-verified   { background-color: #16a34a; color: white; }
    .status-in-review  { background-color: #ffe605; color: black; }
    .status-pending    { background-color: #f97316; }
    .status-not-started{ background-color: #9ca3af; }
    .status-incomplete { background-color: #dc2626; }
    .status-submitted  { background-color: #2563eb; }
    .status-expired    { background-color: #4b5563; }

    .status-dropdown {
        border: 1px solid #f1f1f1;
        border-radius: 4px;
        background-color: #ffffff;
        width: 100%;
        color: #a0abb8;
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

                  @php
              $user = Auth::guard('nurse_middle')->user();

              $registrations = \DB::table('registration_profiles_countries')
                  ->where('user_id', $user->id)
           
                  ->orderBy('created_at')
                  ->get();
              @endphp
             @php
              $statusMap = [
                  1 => ['label' => 'Not Started', 'class' => 'status-not-started'],
                  2 => ['label' => 'Pending', 'class' => 'status-pending'],
                  3 => ['label' => 'Submitted', 'class' => 'status-submitted'],
                  4 => ['label' => 'In Review', 'class' => 'status-in-review'],
                  5 => ['label' => 'Verified', 'class' => 'status-verified'],
                  6 => ['label' => 'Incomplete', 'class' => 'status-incomplete'],
                  7 => ['label' => 'Expired', 'class' => 'status-expired'],
              ];

              $activeCountry = $user->active_country;

              $activeRegistration = $registrations->firstWhere(
                  'country_code',
                  $activeCountry
              );

              if (!$activeRegistration) {
                  $activeRegistration = $registrations->first();
              }

              $activeStatus = $activeRegistration->status ?? 1;
              @endphp

        <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
            <div>
              <span id="statusPill"
                    class="status-pill {{ $statusMap[$activeStatus]['class'] }}">
                  {{ $statusMap[$activeStatus]['label'] }}
              </span>
            </div>
            <div>
              @php
              $activeCountry = $user->active_country;
              @endphp

              <select class="form-select" id="countrySwitcher">
                  @forelse ($registrations as $registration)
                      <option value="{{ $registration->country_code }}"
                              data-status="{{ $registration->status ?? 1 }}"
                              {{ $activeCountry === $registration->country_code ? 'selected' : '' }}>
                          {{ country_name($registration->country_code) }}
                      </option>
                  @empty
                      <option disabled selected>No registered countries</option>
                  @endforelse
              </select>
            </div>
        </div>
    <div class="profile-chklst">
      <span>My Career</span>
      
    </div>   
    <div class="box-nav-tabs nav-tavs-profile mb-5 p-0 profile-icns">
      <ul class="nav" role="tablist">
        
        <li><a class="{{ request()->is('nurse/match_percentage') ?'active':'' }} btn btn-border recruitment-icon mb-20 profile_tabs" href="{{ route('nurse.match_percentage') }}"><i class="fi fi-rr-stethoscope"></i> Overall Match</a></li>
        <li><a class="{{ request()->is('nurse/application') ?'active':'' }} btn btn-border recruitment-icon mb-20 profile_tabs" href="{{ route('nurse.application') }}"><i class="fi fi-rr-handshake"></i> Applications</a></li>
        <li><a class="{{ request()->is('nurse/interviews') ?'active':'' }} btn btn-border recruitment-icon mb-20 profile_tabs" href="{{ route('nurse.interviews') }}"><i class="fi fi-rr-briefcase"></i> Interviews</a></li>
         <li><a class="{{ request()->is('nurse/MyJobs') ?'active':'' }} btn btn-border recruitment-icon mb-20 profile_tabs" href="{{ route('nurse.MyJobs') }}"><i class="fi fi-rr-calendar-clock"></i> My Jobs</a></li>
        <li><a class="{{ request()->is('nurse/matchedJobs') ?'active':'' }} btn btn-border recruitment-icon mb-20 profile_tabs" href="{{ route('nurse.matchedJobs') }}"><i class="fi fi-rr-calendar-clock"></i> Matched Jobs</a></li>
        
        
        <div class="mt-0 mb-20 logout-line">
          <a class="link-red font-md" href="{{ route('nurse.logout') }}"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Log Out</a>
          <a class="support-button font-md" href="{{ route('contact') }}">Need support?</a>
        </div>
      </ul>
    </div>
  </div>