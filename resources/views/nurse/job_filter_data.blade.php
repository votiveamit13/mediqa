@php
use Carbon\Carbon;
@endphp
<style>
.urgent-tag {
    background: #000000ff;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 12px;
    height: fit-content;
    position: absolute;
    margin-top: -68px;
    width: 8%;
    margin-left: -67px;
    display: flex;
    justify-content: space-around;
    }
</style>
@foreach ($jobs as $job)
<div class="job-card " >
        <!-- Top Row: Company Logo & Position -->
    
        <div class="job-card-header">
            <div class="job-company">
                <div class="job-logo">🏥</div>
                <div class="job-details d-flex align-items-center justify-content-between">
                    <?php
                        $nurse_type = json_decode($job->nurse_type);
                        $nurse_arr = array();  
                        if(!empty($nurse_type)){
                        foreach($nurse_type as $nt){
                            $nurse_type = DB::table("practitioner_type")->where("id",$nt)->first();
                            $nurse_arr[] = (!empty($nurse_type))?$nurse_type->name:"";
                        }
                        }
                        
                        $nurse_arr_string = implode(",",$nurse_arr);
                        
                        
                        $emplyeement_positions = json_decode($job->emplyeement_positions);
                        
                        // $emp_pos_arr = array();  
                        // if(!empty($emplyeement_positions)){
                        //   foreach($emplyeement_positions as $emppos){
                        //     $emp_position = DB::table("employee_positions")->where("position_id",$emppos)->first();
                        //     $emp_pos_arr[] = $emp_position->position_name;
                        //   }
                        // }
                        
                        // $emp_pos_arr_string = implode(",",$emp_pos_arr);
                        
                        $emplyeement_type = json_decode($job->emplyeement_type, true);
                        
                        if (is_string($emplyeement_type)) {
                            $emplyeement_type = json_decode($emplyeement_type, true);
                        }
                        $emplyeement_type_arr = array();  
                        if(!empty($emplyeement_type)){
                        foreach($emplyeement_type as $emptype){
                            
                            $emp_type = DB::table("employeement_type_preferences")->where("emp_prefer_id",$emptype)->first();
                            
                            $emplyeement_type_arr[] = $emp_type->emp_type;
                        }
                        }
                        
                        $emplyeement_type_arr_string = implode(",",$emplyeement_type_arr);
                        
                        
                        $shift_type = json_decode($job->shift_type);
                        
                        $shift_type_arr = array();  
                        if(!empty($shift_type)){
                        foreach($shift_type as $shifttype){
                            
                            $shiftty = DB::table("work_shift_preferences")->where("work_shift_id",$shifttype)->first();
                            
                            $shift_type_arr[] = $shiftty->shift_name;
                        }
                        }
                        
                        $shift_type_arr_string = implode(",",$shift_type_arr);
                        
                        $work_environment = json_decode($job->work_environment, true);

                        $work_environment_arr = [];

                        if (!empty($work_environment)) {

                            $ids = collect($work_environment)->flatten()->filter()->values();

                            if ($ids->isNotEmpty()) {
                                $work_environment_arr = DB::table("work_enviornment_preferences")
                                    ->whereIn("prefer_id", $ids)
                                    ->pluck("env_name")
                                    ->toArray();
                            }
                        }

                        $work_environment_arr_string = implode(",", $work_environment_arr);
                        
                        $benefits = json_decode($job->benefits);
                        
                        $benefits_arr = array();  
                        if(!empty($benefits)){
                        foreach($benefits as $benefit){
                            
                            $benefit_data = DB::table("benefits_preferences")->where("benefits_id",$benefit)->first();
                            
                            $benefits_arr[] = $benefit_data->benefits_name;
                        }
                        }
                        
                        $benefits_arr_string = implode(",",$benefits_arr);

                        
                        
                        $specialityies = json_decode($job->typeofspeciality, true);

                        if (is_string($specialityies)) {
                            $specialityies = json_decode($specialityies, true);
                        }

                        $speciality_name = DB::table("speciality")->where("id",$specialityies[0])->first();
                        
                        $speciality_arr = array();  
                        if(!empty($specialityies)){
                        foreach($specialityies as $special){
                            
                            $speciality_data = DB::table("speciality")->where("id",$special)->first();
                            
                            //$speciality_arr[] = $speciality_data?->name : '';
                        }
                        }
                        $speciality_arr_string = implode(",",$speciality_arr);
                        ?>
                    <div>
                        {{-- <strong class="fs-5">{{ $nurse_arr_string }}</strong> --}}
                        <strong class="fs-5">{{ $job->job_title }}</strong>
                    </div>
                    <div>
                        <div class="heart-toggle" data-active="0">
                            @php
                            $user_id = Auth::guard("nurse_middle")->user()->id;
                            $liked = DB::table('nurse_job_likes')
                            ->where('nurse_id', $user_id)
                            ->where('job_id', $job->id)
                            ->exists();
                            @endphp
                            <a href="javascript:void(0)" class="job-like-btn" data-job="{{$job->id}}">
                                <i class="{{ $liked ? 'fas fa-heart text-danger' : 'far fa-heart' }}"></i>
                            </a>
                        </div>
                        @if($job->urgent_hire == 1)
                        <div class="urgent-tag">Urgent Hiring</div>
                        @endif
                    </div>
                    {{-- <script>
                        document.addEventListener("DOMContentLoaded", () => {
                                          lucide.createIcons();
    
                                          document.querySelectorAll('.heart-toggle').forEach(el => {
                                              el.addEventListener('click', () => {
                                                  el.classList.toggle('active');
                                              });
                                          });
                                      });
                    </script> --}}
                </div>
            </div>
        </div>
        <hr>
        <!-- Job Role / Hospital Name -->
        <!-- <div class="job-role">{{ $job->agency_name }}</div> -->
        <!-- Main Job Info -->
        <!-- <div class="job-meta">
                                <span><strong>Position:</strong> </span>
                                <span class="salary"><strong>Salary:</strong> ${{ $job->salary }}/hr</span>
                              </div> -->
        <!-- Expanded Job Details -->
        <div class="job-info-details col-12 d-flex">
            <div class="col-4">
                {{-- <div class="job-role">{{ $job->job_title }}</div> --}}
                <div class="location d-flex align-items-center"><i data-lucide="map-pin" width="18" height="18"></i> {{
                    country_name($job->location_country) }}</div>
            </div>
            <div class="col-4">
                {{-- <div class="job-meta">
                    <span><strong>Position:</strong> {{ $emp_pos_arr_string }}</span>
                </div> --}}
            </div>
            <div class="col-4">
                <div class="priority-tags" data-tags='[
                                          {"key":"new","label":"New"},
                                          {"key":"urgent","label":"Urgent"},
                                          {"key":"last_minute","label":"Last Minute"},
                                          {"key":"immediate","label":"Immediate Start"}
                                        ]'>
                </div>
    
            </div>
            <script>
                function renderTagsBySpace(container) {
                                    const tags = JSON.parse(container.dataset.tags || "[]");
    
                                    container.innerHTML = "";
                                    container.style.position = "relative";
    
                                    const hidden = [];
    
                                    const more = document.createElement("span");
                                    more.className = "tag-more";
                                    more.textContent = "+0 more";
                                    more.style.visibility = "hidden";
                                    container.appendChild(more);
    
                                    const availableWidth = container.clientWidth;
                                    let usedWidth = more.offsetWidth;
    
                                    tags.forEach(tag => {
                                        const el = document.createElement("span");
                                        el.className = `tag tag-${tag.key}`;
                                        el.textContent = tag.label;
                                        container.insertBefore(el, more);
    
                                        const tagWidth = el.offsetWidth + 6;
    
                                        if (usedWidth + tagWidth > availableWidth) {
                                            container.removeChild(el);
                                            hidden.push(tag);
                                        } else {
                                            usedWidth += tagWidth;
                                        }
                                    });
    
                                    if (hidden.length) {
                                        more.textContent = `+${hidden.length} more`;
                                        more.style.visibility = "visible";
    
                                        const tooltip = document.createElement("div");
                                        tooltip.className = "tags-tooltip";
    
                                        hidden.forEach(tag => {
                                            const pill = document.createElement("span");
                                            pill.className = `tag tag-${tag.key}`;
                                            pill.textContent = tag.label;
                                            tooltip.appendChild(pill);
                                        });
    
                                        more.appendChild(tooltip);
                                    } else {
                                        container.removeChild(more);
                                    }
                                }
    
                                function initPriorityTags() {
                                    document.querySelectorAll(".priority-tags").forEach(container => {
                                        renderTagsBySpace(container);
                                    });
                                }
    
                                window.addEventListener("load", () => {
                                    requestAnimationFrame(() => {
                                        initPriorityTags();
    
                                        const observer = new ResizeObserver(() => {
                                            initPriorityTags();
                                        });
    
                                        document.querySelectorAll(".priority-tags").forEach(el => {
                                            observer.observe(el);
                                        });
                                    });
                                });
            </script>
        </div>
        <div class="job-info-details col-12 d-flex">
            <div class="col-8 job_detail_data">
                <div><strong>Employment Type:</strong> {{ $emplyeement_type_arr_string ?? "N/A"}} </div>
                <div><strong>Shift Type:</strong> {{ $shift_type_arr_string ?? "N/A" }}</div>
                <div><strong>Sector:</strong> {{ $job->sector ?? "N/A" }}</div>
                <div><strong>Work Environment:</strong> {{ $work_environment_arr_string ?? "N/A"}}</div>
                <!--<div><strong>Benefits:</strong> </div>-->
                <div><strong>Specialty:</strong> {{ $speciality_name->name ?? "N/A" }}</div>
                <div><strong>Experience Required:</strong> {{ $job->experience_level }}{{ $job->experience_level
                    == 1 ? 'st' : ($job->experience_level == 2 ? 'nd' : ($job->experience_level == 3 ? 'rd' : 'th'))
                    }} Year</div>
                <div>
                    @php
                        if ($job->main_emp_type == 1) {
                        $min = $job->per_salary_min;
                        $max = $job->per_salary_max;
                        $per = $job->salary_permanent;
                        } elseif ($job->main_emp_type == 2) {
                        $min = $job->fixed_term_salary_min;
                        $max = $job->fixed_term_salary_max;
                        $per = $job->salary_range_fix_term;
                        } elseif ($job->main_emp_type == 3) {
                        $min = $job->temporary_salary_min;
                        $max = $job->temporary_salary_max;
                        $per = $job->salary_range_temporary;
                        }
                    @endphp
                    <span class="salary"><strong>Salary:</strong> ${{ $min }} - {{ $max }} {{ $per }} </span>
                </div>
                <div class="last-date"><strong>Last Date :</strong>
                 {{ \Carbon\Carbon::parse($job->custom_expiry_date)->format('d M Y') ?? "N/A"}}
                </div>
            </div>
    
            <div class="col-4 job-right-col">
                @php
                $benefitIds = json_decode($job->benefits, true) ?? [];
    
                $benefits = [];
                if (!empty($benefitIds)) {
                $benefits = DB::table('benefits_preferences')
                ->whereIn('benefits_id', $benefitIds)
                ->get();
                }
    
                $visibleBenefits = $benefits->take(3);
                $extraBenefitsCount = $benefits->count() - 3;
                @endphp
                <div class="job-features">
                    <div><strong>Benefits:</strong></div>
    
                    @foreach($visibleBenefits as $benefit)
                    <div class="feature-item">
                        @if($benefit->icon)
                        <img src="{{ asset('uploads/benefits/'.$benefit->icon) }}" alt="{{ $benefit->benefits_name }}">
                        @endif
                        <span>{{ $benefit->benefits_name }}</span>
                    </div>
                    @endforeach
    
                    @if($extraBenefitsCount > 0)
                    <button class="btn btn-link p-0 show-more-btn" data-bs-toggle="modal"
                        data-bs-target="#benefitsModal-{{ $job->id }}">
                        +{{ $extraBenefitsCount }} more
                    </button>
                    @endif
                </div>
                <div class="modal fade" id="benefitsModal-{{ $job->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <div class="modal-content modal-content-custom">
                            <div class="modal-header">
                                <h5 class="modal-title">All Benefits</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
    
                            <div class="modal-body">
                                <div class="job-features">
                                    @foreach($benefits as $benefit)
                                    <div class="feature-item">
                                        @if($benefit->icon)
                                        <img src="{{ asset('uploads/benefits/'.$benefit->icon) }}"
                                            alt="{{ $benefit->benefits_name }}">
                                        @endif
                                        <span>{{ $benefit->benefits_name }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
    
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <?php
                                      $sector_percent = (!empty($work_preferences_data) && $work_preferences_data->sector_preferences == $job->sector) ? 1 : 0;
                                      $emptype_preferences = (!empty($work_preferences_data))?$work_preferences_data->emptype_preferences:'';
                                      $emp_type = (array)json_decode($emptype_preferences);
                                      $mainIndex = array_key_first($emp_type);
                                      
                                      if($mainIndex != ""){
                                        $ids = $emp_type[$mainIndex];
                                      }else{
                                        $ids = [0];
                                      }
                                      
                                      $names = DB::table('employeement_type_preferences')
                                                  ->whereIn('emp_prefer_id', $ids)
                                                  ->pluck('emp_type')
                                                  ->toArray();
                                      $mainIndexName = DB::table('employeement_type_preferences')
                                                        ->where('emp_prefer_id', $mainIndex)
                                                        ->value('emp_type');        
                                                        
                                      $result = [
                                        "main_index" => $mainIndexName,
                                        "children"   => $names
                                      ];             
                                      
                                      $searchValues = array_map('trim', explode(',', $emplyeement_type_arr_string));
                                      //print_r($searchValues);
                                      $getEmp = '';
                                      foreach ($searchValues as $searchValue) {
                                          if ($result['main_index'] === $searchValue) {
                                              $getEmp = 1;
                                          } elseif (in_array($searchValue, $result['children'])) {
                                              $getEmp = 1;
                                          } else {
                                              $getEmp = 0;
                                          }
                                      }
                                      
                                      $shift_values = (array)json_decode($job->shift_type);
                                      $shift_percent = '';
                                      foreach ($shift_values as $shiftKey) {
                                        $work_shift_preferences = (!empty($work_preferences_data))?$work_preferences_data->work_shift_preferences:'';        
                                        if (array_key_exists($shiftKey, (array)json_decode($work_shift_preferences))) {
                                          $shift_percent = 1;
                                        } else {
                                          $shift_percent = 0;
                                        }
                                      }
                                      
                                      $match_percent_add = $sector_percent + $getEmp + $shift_percent;
                                      
                                      $total_percent = $match_percent_add * 100/10;
                                      
                                      
                                      $work_environment_preferences = (!empty($work_preferences_data))?$work_preferences_data->work_environment_preferences:'';        
                                      $workEnvPrefs = (array)json_decode($work_environment_preferences);
                                      ?>
                    <div class="match-circle" data-value="{{ $job->match_percentage }}">
                        <div class="match-inner">
                            {{-- <div class="percent">{{ $total_percent }}%</div> --}}
                            <div class="percent">{{ round($job->match_percentage) }}%</div>
                            <div class="label">Match</div>
                        </div>
                    </div>
                    <script>
                        document.querySelectorAll('.match-circle').forEach(el => {
                                            const val = el.getAttribute('data-value') || 0;
                                            el.style.setProperty('--percent', val);
                                        });
                    </script>
                </div>
            </div>
        </div>
        <!-- Footer: Match & Apply -->
        <?php
                                $user_id = Auth::guard("nurse_middle")->user()->id;
                                
                                // $apply_job_data = DB::table("job_apply")->where("user_id",$user_id)->where("job_id",$job->id)->first();
                                $apply_job_data = DB::table("nurse_applications")->where("nurse_id",$user_id)->where("job_id",$job->id)->first();
                                //print_r($names);
                                ?>
        <!-- Footer: Match & Apply -->
        <div class="job-footer">
            <!-- <div class="match-score">{{ $total_percent }}% Match</div> -->
            <!-- <button class="apply-btn apply-btn-{{ $job->id }} @if(!empty($apply_job_data)) applied @endif" onclick="applyNow('{{ $user_id }}','{{ $job->id }}')">
                                  @if(!empty($apply_job_data))
                                  Applied
                                  @else
                                  Apply Now
                                  @endif
                                  </button> -->
            <div class="action-row">
                <button class="apply-btn apply-btn-{{ $job->id }} 
                                        @if(!empty($apply_job_data)) applied @endif" @if(empty($apply_job_data))
                    onclick="applyNow('{{ $user_id }}','{{ $job->id }}')" @else disabled @endif>
                    @if(!empty($apply_job_data))
                    Applied
                    @else
                    Apply Now
                    @endif
                </button>
    
                <a href="{{ route('nurse.job_details',['job_id'=>$job->id]) }}" class="details-link">
                    <i data-lucide="bookmark"></i>
                    View Details
                </a>
            </div>
        </div>
    </div>
@endforeach
<div class="pagination-wrapper">
    {{ $jobs->links('pagination::bootstrap-4') }}
</div>