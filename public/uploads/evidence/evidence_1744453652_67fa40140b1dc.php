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
              <span>Profile basics</span>
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
              <div class="chart" id="graph1" data-percent="<?php echo $get_progress_status; ?>" data-color="#000"></div>
            </div>

            

            <div class="box-nav-tabs nav-tavs-profile mb-5 p-0 profile-icns">
              <ul class="nav" role="tablist">
                <li><a class="btn btn-border aboutus-icon mb-20 profile_tabs" href="{{ route('nurse.my-profile', ['page' => 'my_profile']) }}" aria-controls="tab-my-profile" aria-selected="true"><i class="fi fi-rr-user"></i> My Profile</a></li>
                <li><a class="{{ request()->is('nurse/setting_availablity') ?'active':'' }} btn btn-border recruitment-icon mb-20" href="{{ route('nurse.setting_availablity', ['page' => 'setting_availablity']) }}"><i class="fi fi-rr-settings"></i> Setting</a></li>
                <li><a href="{{ route('nurse.my-profile', ['page' => 'profession']) }}"  class="btn btn-border recruitment-icon mb-20 profile_tabs" aria-controls="tab-my-jobs" aria-selected="false"><i class="fi fi-rr-employee-man"></i> Profession</a></li>

                <li><a href="{{ route('nurse.my-profile', ['page' => 'educert']) }}" class="btn btn-border people-icon mb-20" aria-controls="tab-saved-jobs" aria-selected="false"><i class="fi fi-rr-graduation-cap"></i> Education and Certifications</a></li>
                <li><a href="{{ route('nurse.my-profile', ['page' => 'mandatory_training']) }}" class="btn btn-border aboutus-icon mb-20" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-chart-user"></i>Mandatory Training and Continuing Education</a></li>
                <li><a href="{{ route('nurse.my-profile', ['page' => 'experience_info']) }}" class="btn btn-border aboutus-icon mb-20" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-suitcase-alt"></i> Experience</a></li>
                <li><a href="{{ route('nurse.my-profile', ['page' => 'reference_info']) }}" class="btn btn-border aboutus-icon mb-20" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-suitcase-alt"></i> References</a></li>


                <li><a href="{{ route('nurse.profileVaccination', ['page' => 'vaccinations']) }}" class="{{ request()->is('nurse/profileVaccination') ?'active':'' }} btn btn-border aboutus-icon mb-20 " aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-chart-user"></i> Vaccinations</a></li>
                <li><a href="{{ route('nurse.workClearances', ['page' => 'work_clearances']) }}" class="{{ request()->is('nurse/workClearances') ?'active':'' }} btn btn-border recruitment-icon mb-20" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-briefcase-arrow-right"></i> Checks and Clearances</a></li>
                <li><a href="{{ route('nurse.professionalMembership', ['page' => 'professional_membership']) }}" class="{{ request()->is('nurse/professionalMembership') ?'active':'' }} btn btn-border recruitment-icon mb-20" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-membership-vip"></i> Professional Memberships & Awards</a></li>
                <li><a href="{{ route('nurse.language_skills', ['page' => 'language_skills']) }}" class="{{ request()->is('nurse/language_skills') ?'active':'' }} btn btn-border recruitment-icon mb-20" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-membership-vip"></i> Language Skills</a></li>
                {{-- <li><a href="{{ route('nurse.my-profile', ['page' => 'work_preferences']) }}" id="work_preferences" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-magnifying-glass-wave"></i>Work Preferences & Flexibility</a></li> --}}
                
                <!--li><a href="{{ route('nurse.my-profile', ['page' => 'interview_references']) }}" class="btn btn-border recruitment-icon mb-20" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-refer-arrow"></i> Interview</a></li-->
                <!--li><a href="{{ route('nurse.my-profile', ['page' => 'personal_preferences']) }}" class="btn btn-border recruitment-icon mb-20" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-id-badge"></i> Personal Preferences</a></li>
                <li><a href="{{ route('nurse.my-profile', ['page' => 'work_preferences']) }}" id="work_preferences" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-magnifying-glass-wave"></i>Job Search Preferences</a></li-->
                <!--li><a href="{{ route('nurse.my-profile', ['page' => 'testimonial_reviews']) }}" id="testimonial_reviews" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-feedback-review"></i> Testimonials and Reviews</a></li-->
                <!-- <li><a href="#experience" id="experience_info" class="btn btn-border aboutus-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-my-menu4" aria-selected="true"><i class="fi fi-rr-chart-histogram"></i>  Financial Details</a></li> -->

                {{-- <li><a href="{{ route('nurse.my-profile', ['page' => 'additional_info']) }}" id="additional_info" class="btn btn-border recruitment-icon mb-20" data-bs-toggle="tab" role="tab" aria-controls="tab-myclearance-jobs" aria-selected="false"><i class="fi fi-rr-guide-alt"></i> Additional Information</a></li> --}}
                <div class="mt-0 mb-20 logout-line"><a class="link-red font-md" href="{{ route('nurse.logout') }}"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Log Out</a></div>
              </ul>
            </div>
          </div>