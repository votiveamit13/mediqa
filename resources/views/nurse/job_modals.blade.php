<!-- Modal Overlay -->
        <div id="employmentModal" class="modal-overlay" style="display: none;">
          <div class="modal-content modal-content-preferences">
           
          
          </div>
          
        </div>

        <div id="shiftModal" class="modal-overlay" style="display: none;">
          <div class="modal-content work_environment_modal" style="display:none">
            <div class="modal-header">
              <h2>Work Environment</h2>
              <button class="btn-cross" onclick="closeModal()"><i class="fi fi-rr-cross"></i></button>
              <button class="edit-btns edit-btn-work_environment_modals" style="display:none;" onclick="editSector()"><i class="fa fa-pencil" aria-hidden="true"></i></button>
              </div>
              
              <div class="modal-body">
                <p class="modal-subtext">Your saved preferences are pre-filled. You can adjust below.</p>
                <input type="text" id="employmentSearch" placeholder="Search employment type..." onkeyup="filterAllEmployment()" class="search-box" />
                <?php
                  $work_environment_preferences = (!empty($work_preferences_data))?$work_preferences_data->work_environment_preferences:'';
                  $result = (array)json_decode($work_environment_preferences,true); 
                  //print_r($result);
                  $i = 0;
                ?>
                @foreach($work_environment_data as $work_environment)
                <div class="accordion-section">
                 <div class="accordion-header">
                   <strong>{{ $work_environment->env_name }}</strong>
                   <div class="actions">
                      <button type="button" onclick="selectAll(event, {{ $work_environment->prefer_id }})" class="select-all" data-target="perm">Select All</button>
                      <button type="button" onclick="clearAll(event, {{ $work_environment->prefer_id }})" class="clear-all" data-target="perm">Clear All</button>
                    </div>
                 </div>
                 <?php
                    $sub_work_environment = DB::table("work_enviornment_preferences")
                                            ->where("sub_env_id", $work_environment->prefer_id)
                                            ->where("sub_envp_id", 0)
                                            ->get();
                 ?>
                 <div class="accordion-content work_environment-checkbox" id="work_environment-{{ $work_environment->prefer_id }}">
                  @foreach($sub_work_environment as $sub_work)
                  <label>
                    <input type="checkbox" value="{{ $sub_work->prefer_id }}" class="work_environment_modals filter_checkbox" id="filter_checkbox_{{ $sub_work->prefer_id }}" onclick="showFilters({{ $sub_work->prefer_id }})"> {{ $sub_work->env_name }}
                  </label>
                  <?php
                      $subsub_work_environment = DB::table("work_enviornment_preferences")
                                              ->where("sub_env_id", $work_environment->prefer_id)
                                              ->where("sub_envp_id", $sub_work->prefer_id)
                                              ->get();
                  ?>
                  <div class="third-level third-level-{{ $sub_work->prefer_id }}" id="subsub_{{ $sub_work->prefer_id }}" style="display:none">
                    @foreach($subsub_work_environment as $subsub_work)
                    <label><input type="checkbox" name="subwork_environment" class="work_environment_modals filter_checkbox" value="{{ $subsub_work->prefer_id }}"> {{ $subsub_work->env_name }}</label>
                    @endforeach
                  </div>
                  
                  @endforeach
                 </div>
                </div>
                <?php
                  $i++;
                ?>
                @endforeach
              </div>
              <div class="modal-footer">
                <button id="cancelBtn" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                <button class="apply-btn apply-filter-btn" id="applySector" onclick="applyShiftData('work_environment','work_environment_modals')">Apply</button>
              </div>
          </div>
          <div class="modal-content work_shift_modal" style="display:none">
            <div class="modal-header">
              <h2>Shift Type</h2>
              <button class="btn-cross" onclick="closeModal()"><i class="fi fi-rr-cross"></i></button>
              <button class="edit-btns edit-btn-shift_modal" style="display:none;" onclick="editSector()"><i class="fa fa-pencil" aria-hidden="true"></i></button>
            </div>
              
              <div class="modal-body">
                <p class="modal-subtext">Your saved preferences are pre-filled. You can adjust below.</p>
              <!-- 🔍 Global Search -->
                <input type="text" id="" placeholder="Search employment type..." onkeyup="filterAllEmployment()" class="search-box employmentSearch" />
                <?php
                  $work_shift_preferences = (!empty($work_preferences_data))?$work_preferences_data->work_shift_preferences:'';      
                  $result = array_values((array)json_decode($work_shift_preferences)); 
                  $i = 0;      
                  
                ?>
                @foreach($work_shift_data as $work_shift)
                <div class="accordion-section">
                 <div class="accordion-header">
                   <strong>{{ $work_shift->shift_name }}</strong>
                    <div class="actions">
                      <button type="button" onclick="selectAll(event, {{ $work_shift->work_shift_id }})" class="select-all" data-target="perm">Select All</button>
                      <button type="button" onclick="clearAll(event, {{ $work_shift->work_shift_id }})" class="clear-all" data-target="perm">Clear All</button>
                    </div>
                 </div>
                 <?php
                    $sub_work_shift = DB::table("work_shift_preferences")
                                            ->where("shift_id", $work_shift->work_shift_id)
                                            ->where("sub_shift_id", NULL)
                                            ->get();
                    
                             
                 ?>
                 <div class="accordion-content" id="shift_type-{{ $work_shift->work_shift_id }}">
                  @foreach($sub_work_shift as $sub_works)
                  <label>
                    <input type="checkbox" class="filter_checkbox shift_modal shift_modal-{{ $sub_works->work_shift_id }}" value="{{ $sub_works->work_shift_id }}"  @if(isset($result[$i]) && in_array($sub_works->work_shift_id, $result[$i])) checked @endif id="filter_checkbox_{{ $sub_works->work_shift_id }}" onclick="showFilters({{ $sub_works->work_shift_id }})"> {{ $sub_works->shift_name }}
                  </label>
                  <?php
                      $subsub_work_shift = DB::table("work_shift_preferences")
                                              ->where("shift_id", $work_shift->work_shift_id)
                                              ->where("sub_shift_id", $sub_works->work_shift_id)
                                              ->get();
                      $subwork_shift_preferences = (!empty($work_preferences_data))?$work_preferences_data->work_environment_preferences:'';  
                      $subworkshiftdata = json_decode($work_preferences_data->subwork_shift_preferences, true);
                      
                      if(isset($subworkshiftdata[$work_shift->work_shift_id][$sub_works->work_shift_id])){
                        $subworkshiftdata1 = $subworkshiftdata[$work_shift->work_shift_id][$sub_works->work_shift_id];
                        
                      }else{
                        $subworkshiftdata1 = '';
                      }
                      
                      
                                              
                  ?>
                  <div class="third-level third-level-{{ $sub_works->work_shift_id }}" id="subsub_{{ $sub_works->work_shift_id }}" @if(empty($work_preferences_data->subwork_shift_preferences)) style="display:none" @else style="display:block" @endif>
                    @foreach($subsub_work_shift as $subsub_works)
                    <label><input type="checkbox" class="shift_modal" @if(is_array($subworkshiftdata1) && in_array($subsub_works->work_shift_id, $subworkshiftdata1)) checked @endif value="{{ $subsub_works->work_shift_id }}"> {{ $subsub_works->shift_name }}</label>
                    @endforeach
                  </div>
                  
                  @endforeach
                 </div>
                </div>
                <?php
                  $i++;
                ?>
                @endforeach
              </div>
              <div class="modal-footer">
                <button id="cancelBtn" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                <button class="apply-btn apply-filter-btn" id="applySector" onclick="applyShiftData('shift_type','shift_modal')">Apply</button>
              </div>
          </div>
          <div class="modal-content work_benefits_modal" style="display:none">
              <div class="modal-header">
                  <h2>Benefits</h2>
                  <button class="btn-cross" onclick="closeModal()"><i class="fi fi-rr-cross"></i></button>
                  <button class="edit-btns edit-btn-benefits" style="display:none;" onclick="editSector()">
                      <i class="fa fa-pencil"></i>
                  </button>
              </div>

              <div class="modal-body">
                  <p class="modal-subtext">Your saved preferences are pre-filled. You can adjust below.</p>

                  <!-- 🔍 Search -->
                  <input type="text"
                        placeholder="Search benefits..."
                        class="search-box employmentSearch" />

                  @php
                      // saved benefits (example: [1,2,5])
                      $savedBenefits = !empty($work_preferences_data->benefits_preferences)
                          ? json_decode($work_preferences_data->benefits_preferences, true)
                          : [];

                      // Parent benefits
                      $parentBenefits = DB::table('benefits_preferences')
                                          ->where('subbenefit_id', 0)
                                          ->get();
                  @endphp

                  @foreach($parentBenefits as $parent)
                      @php
                          $subBenefits = DB::table('benefits_preferences')
                                          ->where('subbenefit_id', $parent->benefits_id)
                                          ->get();
                      @endphp

                      <div class="accordion-section">
                                     <div class="accordion-header">
                                      <strong>{{ $work_shift->shift_name }}</strong>
                                        <div class="actions">
                                          <button type="button" onclick="selectAll(event, {{ $work_shift->work_shift_id }})" class="select-all" data-target="perm">Select All</button>
                                          <button type="button" onclick="clearAll(event, {{ $work_shift->work_shift_id }})" class="clear-all" data-target="perm">Clear All</button>
                                        </div>
                                    </div>
                          <div class="accordion-header">
                              <strong>{{ $parent->benefits_name }}</strong>
                              <div class="actions">
                                  <button type="button"
                                          onclick="selectAll(event, {{ $parent->benefits_id }})"
                                          class="select-all">
                                      Select All
                                  </button>
                                  <button type="button"
                                          onclick="clearAll(event, {{ $parent->benefits_id }})"
                                          class="clear-all">
                                      Clear All
                                  </button>
                              </div>
                          </div>

                          <div class="accordion-content"
                              id="benefit-{{ $parent->benefits_id }}">

                              @foreach($subBenefits as $sub)
                                  <label>
                                      <input type="checkbox"
                                            class="filter_checkbox benefit_checkbox benefit_{{ $parent->benefits_id }}"
                                            value="{{ $sub->benefits_id }}"
                                            {{ in_array($sub->benefits_id, $savedBenefits ?? []) ? 'checked' : '' }}>
                                      {{ $sub->benefits_name }}
                                  </label>
                              @endforeach

                          </div>
                      </div>
                  @endforeach
              </div>

              <div class="modal-footer">
                  <button class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                  <button class="apply-btn apply-filter-btn"
                          onclick="applyBenefits()">
                      Apply
                  </button>
              </div>
          </div>

        </div>

        <div class="modal-overlay" id="nurse_modal" style="display: none;">
            <div class="modal-content row">
                <!-- Left Panel -->
                <div class="panel left col-md-6">
                    <div class="modal-header">Type of Nurse</div>
                    <div class="search-box">
                        <input type="text" placeholder="Search" id="nurseSearch">
                    </div>
                    <div class="nurseList">
                    @foreach($type_of_nurse as $nurse)
                    <div class="list-item" onclick="getNurseData({{ $nurse->id }},'{{ $nurse->name }}')">{{ $nurse->name }}</div>
                    @endforeach
                    </div>
                </div>

                <!-- Right Panel -->
                <div class="panel right col-md-6">
                    <div class="modal-header nurse_modal_header"><span>Registered Nurses (RNs)</span>
                      <button class="btn-cross" onclick="closeModal()"><i class="fi fi-rr-cross"></i></button>
                    </div>
                    <div class="search-box">
                        <input type="text" placeholder="Search" id="sub_nurseSearch">
                    </div>

                    <div class="select-bar">
                        <div>Select all that apply</div>
                        <span id="selectAll" onclick="selectAll(event, 2)">Select All</span>
                    </div>

                    <div class="checkbox-list" id="entry_level-2">
                        <?php
                            $sub_nurse_data = DB::table("practitioner_type")->where("parent","1")->get();
                        ?>
                        
                        @foreach($sub_nurse_data as $nurse_data)
                        
                        <label class="nurse_list_name"><input type="checkbox" value="{{ $nurse_data->id }}" class="nurseCheck specialty nurse_type_data-{{ $nurse_data->id }}">{{ $nurse_data->name }}</label>
                        @endforeach
                        
                    </div>

                    <div class="modal-actions">
                        <button class="cancel-btn" id="cancelModal">Cancel</button>
                        <button class="apply-btn apply-filter-btn" onclick="applyNurse()">Apply</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-overlay" id="speciality_modal" style="display: none;">
            <div class="modal-content row">
                <!-- Left Panel -->
                <div class="panel left col-md-6">
                    <div class="modal-header">Speciality</div>
                    <div class="search-box">
                        <input type="text" placeholder="Search" id="specialitySearch">
                    </div>
                    <div class="specialityList">
                    @foreach($speciality as $spec)
                    <div class="list-item" onclick="getSpecialityData({{ $spec->id }},'{{ $spec->name }}')">{{ $spec->name }}</div>
                    @endforeach
                    </div>
                </div>

                <!-- Right Panel -->
                <div class="panel right col-md-6">
                    <div class="modal-header speciality_modal_header">
                      <span>Adults</span>
                      <button class="btn-cross" onclick="closeModal()"><i class="fi fi-rr-cross"></i></button>
                    </div>
                    <div class="search-box">
                        <input type="text" placeholder="Search" id="sub_specialitySearch">
                    </div>

                    <div class="select-bar">
                        <div>Select all that apply</div>
                        <span id="selectAll">Select All</span>
                    </div>

                    <div class="checkbox-list-spec">
                        <?php
                            $sub_speciality_data = DB::table("speciality")->where("parent","1")->get();
                        ?>
                        
                        @foreach($sub_speciality_data as $speciality_data)
                        <?php
                          $get_spec_count = DB::table("speciality")->where("parent",$speciality_data->id)->get();

                          if(count($get_spec_count)>0){
                            $get_spec_count_result = count($get_spec_count);
                          }
                        ?>
                        <label class="speciality_list_name"><input type="checkbox" class="specialty_check speciality_data-{{ $speciality_data->id }}" value="{{ $speciality_data->id }}">{{ $speciality_data->name }}
                          @if(count($get_spec_count)>0)
                          <span><i class="fa fa-angle-right"></i></span>
                          @endif
                      
                        </label>
                        @endforeach
                    </div>

                    <div class="modal-actions">
                        <button class="cancel-btn" id="cancelModal">Cancel</button>
                        <button class="apply-btn" onclick="applySpeciality()">Apply</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-overlay" id="sectorModal" style="display: none;">
          <div class="modal-content">
            <div class="modal-header">
              <h2>Select Sector</h2>
              <button class="btn-cross" onclick="closeModal()"><i class="fi fi-rr-cross"></i></button>
              <button class="edit-btns edit-btn" onclick="editSector()"><i class="fa fa-pencil" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
              <label><input type="radio" class="sector_checkbox sector_data_checkbox" name="sector" value="1" @if(!empty($work_preferences_data) && $work_preferences_data->sector_preferences == "1") checked @endif> Public & Government </label><br>
              <label><input type="radio" class="sector_checkbox sector_data_checkbox" name="sector" value="2" @if(!empty($work_preferences_data) && $work_preferences_data->sector_preferences == "2") checked @endif> Private </label><br>
              <label><input type="radio" class="sector_checkbox sector_data_checkbox" name="sector" value="3" @if(!empty($work_preferences_data) && $work_preferences_data->sector_preferences == "3") checked @endif> Public Government & Private</label>
            </div>
            <div class="modal-footer">
              <button id="cancelBtn" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
              <button class="apply-btn apply-filter-btn" id="applySector" onclick="applySector('sector')">Apply</button>
            </div>
          </div>
        </div>

        <div class="modal-overlay" id="salaryModal" style="display: none;">
          <div class="modal-content">
            <div class="modal-header">
              <h2>Salary Range ($/hr)</h2>
              <button class="btn-cross" onclick="closeModal()"><i class="fi fi-rr-cross"></i></button>
              <button class="edit-btns edit-btn-salary" style="display:none;" onclick="editSector()"><i class="fa fa-pencil" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
              <div id="salarySlider" style="margin: 10px 0;"></div>
              <p id="salaryAmount">$100 - $500</p>
              <input type="hidden" id="minSalary" name="min_salary" value="100">
              <input type="hidden" id="maxSalary" name="max_salary" value="500">
            </div>
            <div class="modal-footer">
              <button id="cancelBtn" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
              <button class="apply-btn" id="applySector"  onclick="applySalary()">Apply</button>
            </div>
          </div>
        </div>

        <div class="modal-overlay" id="yearExperienceModal" style="display: none;">
          <div class="modal-content">
            <div class="modal-header">
              <h2>Years of Experience</h2>
              <button class="btn-cross" onclick="closeModal()"><i class="fi fi-rr-cross"></i></button>
               <button class="edit-btns edit-btn-experience-modal" style="display: none;" onclick="editSector()"><i class="fa fa-pencil" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
              <select class="form-control assistent_level" name="assistent_level">
                <option value="">Please Select</option>
                @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}" @if(!empty($user_data) && $user_data->assistent_level == $i) selected @endif>{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                  @endfor
              </select>
            </div>
            <div class="modal-footer">
              <button id="cancelBtn" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
              <button class="apply-btn apply-filter-btn" id="applySector" onclick="applyExperience()">Apply</button>
            </div>
          </div>
        </div>

        <div class="modal-overlay" id="locationModal" style="display: none;">
          <div class="modal-content">
            <div class="modal-header">
              <h2>Location Preferences</h2>
              <button class="btn-cross" onclick="closeModal()"><i class="fi fi-rr-cross"></i></button>
            </div>
            <div class="modal-body">
              <!-- Quick Toggle -->
              <div class="d-flex justify-content-between align-items-center mb-3">
                <label class="form-label fw-bold mb-0">Use My Preferences</label>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="usePreferencesToggle" checked>
                </div>
              </div>
              

              <!-- Summary View -->
              @if(!empty($work_preferences_data) && $work_preferences_data->location_status == "Current Location area (not willing to relocate)")
              <div id="preferencesSummary" class="p-3 border rounded bg-light mb-3">
                <p class="mb-1"><strong>Current Location:</strong> {{ $work_preferences_data->prefered_location_current }} – within {{ $work_preferences_data->prefered_distance }}</p>
                <p class="mb-1"><strong>Relocation:</strong> Not willing to relocate</p>
                <a href="{{ route('nurse.locationPreferences') }}?page=locationPreferences" class="btn btn-sm btn-outline-primary mt-2">Edit Preferences</a>
              </div>        
              @endif

              <!-- Customize View -->
              <div id="customizeSearch" style="display:none;">

                <!-- Location Mode -->
                <div class="mb-3">
                  <label class="form-label fw-bold">Location Mode</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="locationMode" value="current" checked>
                    <label class="form-check-label">Current Location (Auto-detect optional)</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="locationMode" value="multiple">
                    <label class="form-check-label">Multiple Locations</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="locationMode" value="international">
                    <label class="form-check-label">International</label>
                  </div>
                </div>

                <!-- International Countries -->
                <div id="internationalCountries" class="mb-3" style="display:none;">
                  <label class="form-label fw-bold">Select Countries</label>
                  <div class="row">
                    <div class="col-6 col-md-4">
                      <div class="form-check"><input type="checkbox" class="form-check-input"> Canada</div>
                      <div class="form-check"><input type="checkbox" class="form-check-input"> Hong Kong</div>
                      <div class="form-check"><input type="checkbox" class="form-check-input"> Ireland</div>
                      <div class="form-check"><input type="checkbox" class="form-check-input"> Jamaica</div>
                    </div>
                    <div class="col-6 col-md-4">
                      <div class="form-check"><input type="checkbox" class="form-check-input"> New Zealand</div>
                      <div class="form-check"><input type="checkbox" class="form-check-input"> Singapore</div>
                      <div class="form-check"><input type="checkbox" class="form-check-input"> South Africa</div>
                    </div>
                    <div class="col-6 col-md-4">
                      <div class="form-check"><input type="checkbox" class="form-check-input"> United Kingdom</div>
                      <div class="form-check"><input type="checkbox" class="form-check-input"> United States</div>
                    </div>
                  </div>
                </div>

                <!-- Preferred Location Input -->
                <div id="preferredLocationInput" class="mb-3">
                  <label class="form-label fw-bold">Preferred Location</label>
                  <input type="text" id="locationSearch" class="form-control" value="{{ $work_preferences_data->prefered_location_current }}" placeholder="Search city / postcode / hospital">
                  <div id="locationTags" class="mt-2"></div>
                </div>

                <!-- Travel Distance Slider -->
                <div id="travelDistanceContainer" class="mb-3">
                  <label class="form-label fw-bold">Maximum Travel Distance</label>
                  <input type="range" id="travelDistance" min="5" max="100" step="5" value="20" class="form-range">
                  <span id="distanceValue" class="fw-semibold">20 km</span>
                </div>

              </div><!-- /customizeSearch -->

            </div>
            <div class="modal-footer">
              <button class="apply-btn" id="applySector" onclick="applyExperience()">Apply</button>
            </div>
          </div>
        </div>

        
@section('js')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>

function applySalary() {

    let minSalary = $("#minSalary").val();
    let maxSalary = $("#maxSalary").val();
    console.log("Salary values:", minSalary, maxSalary);

    let filters = JSON.parse(sessionStorage.getItem("filters_data")) || {
        sector: [],
        emp_type: [],
        shift_modal: [],
        work_environment_modals: [],
        benefits: [],
        nurse_type: [],
        experience: ""
    };

    filters.salary_min = Number(minSalary)
    filters.salary_max = Number(maxSalary)
    sessionStorage.setItem("filters_data", JSON.stringify(filters));

    console.log("Updated filters_data:", filters);

    $("#salaryModal").hide();
}


function applyBenefits() {

    let filters = JSON.parse(sessionStorage.getItem("filters_data")) || {
        sector: [],
        emp_type: [],
        shift_modal: [],
        work_environment_modals: [],
        nurse_type: [],
        benefits: []
    };

    let selected = [];

    $(".benefit_checkbox:checked").each(function () {
        selected.push($(this).val());
    });

    filters.benefits = selected;

    sessionStorage.setItem("filters_data", JSON.stringify(filters));

    console.log("Saved benefits:", filters.benefits);

    closeModal();
    fetchJobs(1);
}

function applySector(filter_name) {
    let filters = getFiltersData();
    let selectedValues = [];

    $(".sector_data_checkbox:checked").each(function () {
        selectedValues.push($(this).val());
    });

    filters.sector = selectedValues; // ✅ save in single object
    saveFiltersData(filters);

    $(".edit-btn").show();
    $("#sectorModal").hide();

    console.log("filters_data", filters);
}


  // ✅ Select All
function selectAll(event, targetId) {
  
  event.stopPropagation(); // stop accordion toggle
  $("#emp_type-" + targetId + " .sector_checkbox:not(:disabled)").prop("checked", true);
  $("#shift_type-" + targetId + " .filter_checkbox:not(:disabled)").prop("checked", true);
  $("#work_environment-" + targetId + " .filter_checkbox:not(:disabled)").prop("checked", true);
  $("#entry_level-" + targetId + " .nurseCheck:not(:disabled)").prop("checked", true);
  $("#benefit-" + targetId + " .filter_checkbox:not(:disabled)").prop("checked", true);
}


// ✅ Clear All
function clearAll(event, targetId) {
  event.stopPropagation(); // stop accordion toggle
  $("#emp_type-" + targetId + " .sector_checkbox:not(:disabled)").prop("checked", false);
  $("#shift_type-" + targetId + " .filter_checkbox:not(:disabled)").prop("checked", false);
  $("#benefit-" + targetId + " .filter_checkbox:not(:disabled)").prop("checked", false);
  $("#work_environment-" + targetId + " .filter_checkbox:not(:disabled)").prop("checked", false);
}


  function toggleSpecificDays() {
    const checkbox = document.getElementById("specificDaysToggle");
    const section = document.getElementById("specificDaysSection");
    section.style.display = checkbox.checked ? "block" : "none";
  }

  // function applyShiftData(filter_name,column_type){
  //   var selectedValues1 = [];
        
  //   // Get all checked checkboxes inside the modal
  //   $("."+column_type+":checked").each(function() {
  //       selectedValues1.push($(this).val());
  //   });

  //   sessionStorage.setItem("emp_type_data-"+column_type, selectedValues1);

  //   selectedValues = [...new Set(selectedValues1)];

  //   console.log("Unique selected values:", selectedValues);

  //   var shift_type_data = sessionStorage.getItem("emp_type_data-"+column_type);
  //   console.log("emp_type_data",shift_type_data);
  //   if(shift_type_data !== null){
      
  //       $("."+column_type).prop("disabled", true);
  //       $(".edit-btn-"+column_type).show();

  //   }

  //   $("#shiftModal").hide();
  // }
   function applyShiftData(filter_name, column_type) {
      let filters = getFiltersData();
      let selectedValues = [];

      $("." + column_type + ":checked").each(function () {
          selectedValues.push($(this).val());
      });

      filters[column_type] = [...new Set(selectedValues)]; // ✅ dynamic key
      saveFiltersData(filters);

      $("." + column_type).prop("disabled", true);
      $(".edit-btn-" + column_type).show();

      $("#shiftModal").hide();

      console.log("filters_data", filters);
  }


  var shift_type_data = sessionStorage.getItem("emp_type_data-shift_modal");
  console.log("emp_type_data",shift_type_data);
  if(shift_type_data !== null){
    
    $(".shift_modal").prop("disabled", true);
    $(".edit-btn-shift_modal").show();
    
    let shift_arr = shift_type_data.split(",");  

    shift_arr.forEach(function(val) {
      document.querySelectorAll(".shift_modal").forEach(function(checkbox) {
        if (checkbox.value === val) {
          checkbox.checked = true;  // ✅ mark it checked
        }
      });
    });
  }

  var work_environment_data = sessionStorage.getItem("emp_type_data-work_environment_modals");
  console.log("emp_type_data",work_environment_data);
  if(work_environment_data !== null){
    
    $(".work_environment_modals").prop("disabled", true);
    $(".edit-btn-work_environment_modals").show();
    
    let work_environment_arr = work_environment_data.split(",");  

    work_environment_arr.forEach(function(val) {
      document.querySelectorAll(".work_environment_modals").forEach(function(checkbox) {
        if (checkbox.value === val) {
          checkbox.checked = true;  // ✅ mark it checked
        }
      });
    });
  }

  $(document).ready(function () {
    let filters = getFiltersData();

    // Sector
    filters.sector.forEach(val => {
        $(".sector_data_checkbox[value='" + val + "']").prop("checked", true);
    });

    // Employment Type
    filters.emp_type.forEach(val => {
        $(".employee_type[value='" + val + "']").prop("checked", true);
    });

    // Shift Type
    filters.shift_modal.forEach(val => {
        $(".shift_modal[value='" + val + "']").prop("checked", true);
    });

    // Work Environment
    filters.work_environment_modals.forEach(val => {
        $(".work_environment_modals[value='" + val + "']").prop("checked", true);
    });
});


  function getFiltersData() {
    let data = sessionStorage.getItem("filters_data");
      return data ? JSON.parse(data) : {
          sector: [],
          emp_type: [],
          shift_modal: [],
          work_environment_modals: []
      };
  }

  function saveFiltersData(data) {
      sessionStorage.setItem("filters_data", JSON.stringify(data));
  }

  $(document).on("click", ".apply-filter-btn", function () {

    // ✅ Ensure filters are already saved in sessionStorage
    let filtersData = JSON.parse(sessionStorage.getItem("filters_data"));

      if (!filtersData) {
          console.warn("No filters found in sessionStorage");
          return;
      }

      // Optional: clear keyword/location when applying modal filters
      // filters.keywords = '';
      // filters.locations = [];

      fetchJobs(1); // 🚀 APPLY FILTERS
  });

  
$(document).on("change", ".nurseCheck", function () {

    // get existing filters or default structure
    let filters = JSON.parse(sessionStorage.getItem("filters_data")) || {
        sector: [],
        emp_type: [],
        shift_modal: [],
        work_environment_modals: [],
        nurse_type: []
    };

    let value = $(this).val();

    // ensure nurse_type is always an array
    filters.nurse_type = filters.nurse_type || [];

    if ($(this).is(":checked")) {
        // ✅ ADD only if not already present
        if (!filters.nurse_type.includes(value)) {
            filters.nurse_type.push(value);
        }
    } else {
        // ✅ REMOVE only the unchecked value
        filters.nurse_type = filters.nurse_type.filter(id => id !== value);
    }

    // save updated filters
    sessionStorage.setItem("filters_data", JSON.stringify(filters));

    console.log("Updated nurse_type:", filters.nurse_type);
});


function applyNurse() {
    $("#nurse_modal").hide();
    fetchJobs(1); // apply using already saved session data
}

  //   function applyNurse(){
  //   var selectedValues = [];

  //   $(".nurseCheck:checked").each(function(){
  //       selectedValues.push($(this).val());
  //   });

  //   console.log(selectedValues);
    
  //   if(selectedValues.length > 0){
        
  //     $.ajax({
  //       type: "POST",
  //       url: "{{ url('/nurse/getFilterNurseData') }}",
  //       data: {nurse_data:selectedValues,_token:'{{ csrf_token() }}'},
  //       cache: false,
  //       success: function(data){
  //         $(".job-listings").html(data);
  //         $("#nurse_modal").hide();
          
  //       }
  //     });    
  //   }
  // }


   $('#sectorFilter').on('click', function() {
    // Toggle the checkboxes
    $('.sector-options').slideToggle(200);

    // Rotate the arrow
    $(this).find('.arrow').toggleClass('rotated');
  });     

    function openSectorModal(){
      $('#sectorModal').show();
    }

    function openSalaryModal(){
      $('#salaryModal').show();
    }

    function openYearExperienceModal(){
      $('#yearExperienceModal').show();
    }

    function openLocationModel(){
      $("#locationModal").show();

      // Toggle ON/OFF main sections
      $("#usePreferencesToggle").change(function() {
        if ($(this).is(":checked")) {
          $("#preferencesSummary").show();
          $("#customizeSearch").hide();
        } else {
          $("#preferencesSummary").hide();
          $("#customizeSearch").show();
        }
      });

      // Handle radio mode switching
      $("input[name='locationMode']").change(function() {
        let mode = $(this).val();

        if (mode === "international") {
          $("#internationalCountries").show();
          $("#preferredLocationInput").hide();
          $("#travelDistanceContainer").hide();
        } 
        else if (mode === "multiple") {
          $("#internationalCountries").hide();
          $("#preferredLocationInput").show();
          $("#travelDistanceContainer").hide();
        } 
        else { // current location
          $("#internationalCountries").hide();
          $("#preferredLocationInput").show();
          $("#travelDistanceContainer").show();
        }
      });

      // Distance slider display
      $("#travelDistance").on("input", function() {
        $("#distanceValue").text($(this).val() + " km");
      });

      // Simple tag chip system for preferred location input
      $("#locationSearch").keypress(function(e) {
        if (e.which === 13) { // Enter key
          e.preventDefault();
          let val = $(this).val().trim();
          if (val) {
            $("#locationTags").append(
              `<span class="tag-badge">${val} <span class="remove-tag">x</span></span>`
            );
            $(this).val("");
          }
        }
      });

      // Remove tag
      $(document).on("click", ".remove-tag", function() {
        $(this).parent().remove();
      });

      let selectedMode = $("input[name='locationMode']:checked").val();

      if(selectedMode == "current"){
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            function (position) {
              let lat = position.coords.latitude;
              let lng = position.coords.longitude;

              // Show raw coords (for debugging)
              $("#locationSearch").val(
                `Latitude: ${lat.toFixed(4)}, Longitude: ${lng.toFixed(4)} <br> Fetching city...`
              );

              // Reverse Geocoding (OpenStreetMap / Nominatim API)
              fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                  let city = data.address.city || data.address.town || data.address.village || "";
                  let state = data.address.state || "";
                  let country = data.address.country || "";

                  $("#locationSearch").val(
                    `${city}, ${state} (${country})`
                  );
                })
                .catch(err => {
                  $("#locationSearch").val("Unable to fetch location details.");
                });
            },
            function (error) {
              $("#locationSearch").val("Location access denied or unavailable.");
            }
          );
        } else {
          $("#locationSearch").val("Geolocation is not supported by your browser.");
        }

        $("#locationTags").hide();
      }

      $("input[name='locationMode']").click(function(){
        let selected_val = $(this).val();
        if(selected_val == "multiple"){
          $("#locationSearch").val("");
          $("#locationTags").show();
        }

      });

    }

    $("#salarySlider").slider({
      range: true,
      min: 0,
      max: 1000,
      step: 10,
      values: [100, 500],
      slide: function(event, ui) {
        $("#salaryAmount").text("$" + ui.values[0] + " - $" + ui.values[1]);
        $("#minSalary").val(ui.values[0]);
        $("#maxSalary").val(ui.values[1]);
      }
    });

    $('#specialitySearch').on('keyup', function() {
      var value = $(this).val().toLowerCase();
      
      $('.specialityList .list-item').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });

    $('#sub_specialitySearch').on('keyup', function() {
      var value = $(this).val().toLowerCase();
      
      $('.speciality_list_name').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });

    $('#nurseSearch').on('keyup', function() {
      var value = $(this).val().toLowerCase();
      
      $('.nurseList .list-item').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });

    $('#sub_nurseSearch').on('keyup', function() {
      var value = $(this).val().toLowerCase();
      
      $('.nurse_list_name').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });

    function openNurseModal(){
        $('#nurse_modal').show();
    }

    

    function openSpecialityModal(){
        $('#speciality_modal').show();
    }
    
    $('#cancelModal').on('click', function () {
        $('#nurse_modal').hide();
    });
  function openModal(filter_type,table_name,column_name,main_column_id,column_type) {
    // var modal_heading = $("#"+filter_id+" .modal-header h2").text();
    console.log("modal_heading",column_type);
    // if(filter_type == modal_heading){
    //   $(".modal-content").hide();
    //   $("#"+filter_id).show();
    // }
    document.getElementById("employmentModal").style.display = "flex";

    
    $.ajax({
      type: "post",
      url: "{{ url('/nurse/getWorkFlexiblityData') }}",
      data: {filter_type:filter_type,table_name:table_name,column_name:column_name,main_column_id:main_column_id,column_type:column_type,_token:"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
        var data2 = JSON.parse(data);
        
        var data1 = data2.filters;
        var data3 = data2.preferences;
        // var data4 = JSON.parse(data3[work_preferences_column]);
        // var data6 = Object.values(data4[1]);
        if(filter_type == "Position" && data3.position_preferences != null){
          var data4 = JSON.parse(data3.position_preferences);
          var data6 = Object.values(data4[1]);
           
          console.log("data6",data1);
        }else{
          if (filter_type === "Benefits") {

            var data6 = [];

            if (data3 && data3.length > 0) {
                data3.forEach(function (row) {
                    if (row.subbenefit_id) {
                        data6.push(String(row.subbenefit_id));
                    }
                });
            }
        }else{
            var data4 = JSON.parse(data3.emptype_preferences);
            var data6 = Object.values(data4);
            var data5 = data6[0];
            console.log("data",data6[0]);
          }
          
        }
        
        
        
        var accordian_section = '';

        for(var i = 0;i<data1.length;i++){
          var sub_types = data1[i].sub_types;
          var sub_data = '';
          
          for(var j = 0;j<sub_types.length;j++){
            let found = data6.some(sub => sub.includes(String(sub_types[j].id)));
            console.log("sub_types[j].id",sub_types[j].id);
            if (found) {
              var checked = "checked";
              
            } else {
              var checked = "";
              
            }
            

            sub_data += '<label><input type="checkbox" class="sector_checkbox employee_type" value="'+sub_types[j].id+'" '+checked+'> '+sub_types[j].name+'</label>'
          }
          console.log("data.id",data1[i].id);
          if(data1[i].name != "Other" && data1[i].name != "All/No Preference"){
            var perm = "perm";
            accordian_section += '<div class="accordion-section employment-list">\
                <div class="accordion-header">\
                  <strong>'+data1[i].name+'</strong>\
                  <div class="actions">\
                    <button type="button" onclick="selectAll(event, '+data1[i].id+')" class="select-all select-all-'+data1[i].id+'" data-target="perm">Select All</button>\
                    <button type="button" onclick="clearAll(event, '+data1[i].id+')" class="clear-all clear-all-'+data1[i].id+'" data-target="perm">Clear All</button>\
                  </div>\
                </div>\
                <div class="accordion-content" id="emp_type-'+data1[i].id+'">'+sub_data+'</div>\
              </div>';
          }

        }


        var emp_type = "emp_type";
        $(".modal-content-preferences").html('\<div class="modal-header">\
              <h2>'+filter_type+'</h2>\
              <button class="btn-cross" onclick="closeModal()"><i class="fi fi-rr-cross"></i></button>\
              <button class="edit-btns edit-btn-emp-type" onclick="editSector()"><i class="fa fa-pencil" aria-hidden="true"></i></button>\
            </div>\
            <p class="modal-subtext">Your saved preferences are pre-filled. You can adjust below.</p>\
            <input type="text" id="employmentSearch" placeholder="Search employment type..." class="search-box" />\
            <div class="modal-body">'+accordian_section+'</div>\
            <div class="modal-footer" style="text-align: right; margin-top: 10px;">\
              <button id="cancelBtn" class="btn btn-secondary" onclick="closeModal()">Cancel</button>\
              <button class="apply-btn apply-filter-btn" onclick="applySector1(\''+filter_type+'\',\''+column_type+'\')">Apply</button>\
            </div>');

        var emp_type_data = sessionStorage.getItem("emp_type_data-"+column_type);

        if(emp_type_data != null){
          let arr = emp_type_data.split(",");
          $("input.employee_type").prop("checked", false); // uncheck all first
          arr.forEach(function(val) {
              console.log("employee_type",val); 
              $("input.employee_type[value='" + val + "']").prop("checked", true);
               
          });

          $("input.employee_type").prop("disabled", true);

          console.log("input.employee_type",$("input.employee_type").length);

         

          // if(selected_emp_type_data != ""){
            
          //   getEmpFilterData('Employment Type',arr)
          // }
                                                    
        }else{
          $(".edit-btn-emp-type").hide();
        }    

  

           
      }
    });      

    
    // This goes outside AJAX, runs once globally
    $(document).on("keyup", "#employmentSearch", function () {
        var value = $(this).val().toLowerCase().trim();

        console.log("Search typed:", value);

        $(".accordion-content label").each(function () {
            var text = $(this).text().toLowerCase();
            if (value === "" || text.indexOf(value) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    

  }

function filterAllEmployment() {
   
  var input = document.getElementById("employmentSearch");
  var filter = input.value.toLowerCase().trim();
  
  // Get ALL labels inside ALL accordions
  var labels = document.querySelectorAll(".accordion-content label");

  labels.forEach(function(label) {
    var text = label.textContent.toLowerCase();
    if (text.indexOf(filter) > -1) {
      label.style.display = "block"; // show
    } else {
      label.style.display = "none"; // hide
    }
  });
}




function openModal_enviroment(filter_type) {
    // alert(filter_type);

    // hide all modals first
    $(".work_shift_modal, .work_environment_modal, .work_benefits_modal").hide();

    if (filter_type === "Work Environment") {
        $(".work_environment_modal").show();
    }

    if (filter_type === "Benefits") {
        $(".work_benefits_modal").show();

        // ✅ CHECK SAVED BENEFITS FROM SESSION
        let filters = JSON.parse(sessionStorage.getItem("filters_data")) || {};
        let savedBenefits = filters.benefits || [];

        // uncheck all first
        $(".benefit_checkbox").prop("checked", false);

        // check only saved ones
        savedBenefits.forEach(function (id) {
            $(".benefit_checkbox[value='" + id + "']").prop("checked", true);
        });
    }

    if (filter_type === "Shift Type") {
        $(".work_shift_modal").show();
    }

    // open modal wrapper
    document.getElementById("shiftModal").style.display = "flex";

    // 🔍 search
    $(document).off("keyup", ".employmentSearch").on("keyup", ".employmentSearch", function () {
        let value = $(this).val().toLowerCase().trim();

        $(".accordion-content label").each(function () {
            let text = $(this).text().toLowerCase();
            $(this).toggle(value === "" || text.includes(value));
        });
    });
}


  function showFilters(prefer_id){

    if ($("#filter_checkbox_"+prefer_id).prop('checked')) {
      $(".third-level-"+prefer_id).show();
    } else {
      $(".third-level-"+prefer_id).hide();
    }
    
  }

  

  function getNurseData(nurse_id,nurse_type_name){
    $(".nurse_modal_header span").text(nurse_type_name);
    let filters = JSON.parse(sessionStorage.getItem("filters_data")) || { nurse_type: [] };
    let selectedNurseTypes = filters.nurse_type || [];
    $.ajax({
      type: "post",
      url: "{{ url('/nurse/getNurseData') }}",
      data: {nurse_id:nurse_id,_token:"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
        var data1 = JSON.parse(data);
        console.log("data1",data1);
        var sub_nurse_data = '';
        for(var i = 0;i<data1.length;i++){
            let isChecked = selectedNurseTypes.includes(String(data1[i].id))
                    ? 'checked'
                    : '';
            if(data1[i].get_nurse_count == 0){
              var get_nurse_count = '';
            }else{
              var get_nurse_count = '<span><i class="fa fa-angle-right"></i></span>'
            }
            var get_nurse = data1[i].get_nurse;
            var subsub_nurse_data = '';
            if(get_nurse.length>0){
              for(var j=0;j<get_nurse.length;j++){
                subsub_nurse_data += '<label class="subsub_checkbox subsub_checkbox-'+data1[i].id+'" style="display:none;"><input type="checkbox" class="specialty">'+get_nurse[j].name+'</label>'; 
              }
              console.log("subsub_nurse_data",subsub_nurse_data);
              var data_name = data1[i].name;
              var type = "nurse_type";
              var onclickfun = 'showSubCheckbox('+data1[i].id+',\''+data_name+'\',\''+type+'\')';
            }else{
              var onclickfun = '';
            }
            
            sub_nurse_data += '<label class="sub_checkbox"><input type="checkbox" value="'+data1[i].id+'" class="nurseCheck sub_checkbox-'+data1[i].id+'"  ' +isChecked + '  onclick="'+onclickfun+'">'+data1[i].name+get_nurse_count+'</label>'+subsub_nurse_data; 
        }
        $(".checkbox-list").html(sub_nurse_data);
      }
    });
  }

  function getSpecialityData(speciality_id,speciality_name){
    $(".speciality_modal_header span").text(speciality_name);
    $.ajax({
      type: "post",
      url: "{{ url('/nurse/getSpecialityData') }}",
      data: {speciality_id:speciality_id,_token:"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
        var data1 = JSON.parse(data);
        console.log("data1",data1);
        var sub_spec_data = '';
        for(var i = 0;i<data1.length;i++){
            if(data1[i].get_spec_count == 0){
              var get_spec_count = '';
            }else{
              var get_spec_count = '<span><i class="fa fa-angle-right"></i></span>'
            }
            var get_spec = data1[i].get_spec;
            var subsub_spec_data = '';
            if(get_spec.length>0){
              for(var j=0;j<get_spec.length;j++){
                subsub_spec_data += '<label class="subsub_checkbox  subsub_checkbox-'+data1[i].id+'" style="display:none;"><input type="checkbox" class="sub_speciality_checkbox specialty" value="'+data1[i].id+'">'+get_spec[j].name+'</label>'; 
              }
              console.log("subsub_spec_data",subsub_spec_data);
              var data_name = data1[i].name;
              var type = "speciality_type";
              var onclickfun = 'showSubCheckbox('+data1[i].id+',\''+data_name+'\',\''+type+'\')';
            }else{
              var onclickfun = '';
            }
            
            sub_spec_data += '<label class="sub_checkbox"><input type="checkbox" class="specialty sub_speciality_check sub_checkbox-'+data1[i].id+'" value="'+data1[i].id+'" onclick="'+onclickfun+'">'+data1[i].name+get_spec_count+'</label>'+subsub_spec_data; 
        }
        $(".checkbox-list-spec").html(sub_spec_data);
      }
    });
  }


function applySpeciality() {

    let selectedValues = [];

    $(".sub_speciality_check:checked").each(function () {
        selectedValues.push($(this).val());
    });

    // get existing filters or default structure
    let filters = JSON.parse(sessionStorage.getItem("filters_data")) || {
        sector: [],
        emp_type: [],
        shift_modal: [],
        work_environment_modals: [],
        nurse_type: [],
        benefits: [],
        speciality: [],
        experience: "",
        salary: {}
    };

    // remove duplicates
    filters.speciality = [...new Set(selectedValues)];

    // save to sessionStorage
    sessionStorage.setItem("filters_data", JSON.stringify(filters));

    console.log("Saved speciality filter:", filters.speciality);

    // close modal
    $("#speciality_modal").hide();

    // reload jobs (same as other filters)
    fetchJobs(1);
}


  function showSubCheckbox(check_value,check_name,type){
    
    if(type == "speciality_type"){
      
      var nurse_modal_header = $(".speciality_modal_header span").text();
      $(".speciality_modal_header span").text(nurse_modal_header+" > "+check_name);
    }else{
      var nurse_modal_header = $(".nurse_modal_header span").text();
      $(".nurse_modal_header span").text(nurse_modal_header+" > "+check_name);
    }
    
    
    if ($('.sub_checkbox-'+check_value).is(':checked')) {
        $(".sub_checkbox").hide();
        $(".subsub_checkbox-"+check_value).show();
    }
  }

 


  function closeModal() {
    $(".modal-overlay").hide();
    //document.getElementsByClassName("modal-overlay").style.display = "none";
    //document.getElementById("shiftModal").style.display = "none";
  }

 // Accordion open/close
function toggleAccordion(header) {
  var content = $(header).next(".accordion-content");
  $(".accordion-content").not(content).slideUp();
  content.slideToggle();
}


  // function applySector1(filter_name,column_type){
  //   var selectedValues1 = [];
        
  //   // Get all checked checkboxes inside the modal
  //   $(".employee_type:checked").each(function() {
  //       selectedValues1.push($(this).val());
  //   });

  //   // 3️⃣ Remove duplicates
  //   selectedValues = [...new Set(selectedValues)];
  //   // 4️⃣ Save into work_environment_modals ✅
  //   filters.work_environment_modals = selectedValues;
  //   // 5️⃣ Save back to sessionStorage
  //   sessionStorage.setItem("filters_data", JSON.stringify(filters));

  //   console.log("Unique selected values:", selectedValues);

  //   getEmpFilterData(filter_name,selectedValues);

    

    
  // }

  function applySector1(filter_name, column_type) {

    // 1️⃣ Get existing filters_data OR default structure
    let filters = JSON.parse(sessionStorage.getItem("filters_data")) || {
        sector: [],
        emp_type: [],
        shift_modal: [],
        work_environment_modals: []
    };

    // 2️⃣ Collect checked values
    let selectedValues = [];

    $(".employee_type:checked").each(function () {
        selectedValues.push($(this).val());
    });

    // 3️⃣ Remove duplicates
    selectedValues = [...new Set(selectedValues)];

    // 4️⃣ Save into work_environment_modals ✅
    filters.emp_type = selectedValues;

    // 5️⃣ Save back to sessionStorage
    sessionStorage.setItem("filters_data", JSON.stringify(filters));

    console.log("filters_data updated:", filters);
    $("#employmentModal").hide();
    // 6️⃣ Optional: Call existing function
    // getEmpFilterData(filter_name, selectedValues);
}


  function getEmpFilterData(filter_name,selectedValues){
    console.log("selectedValues",selectedValues);
    $.ajax({
      type: "POST",
      url: "{{ url('/nurse/getFilterData') }}",
      data: {filter_name:filter_name,selectedValues:selectedValues,_token:'{{ csrf_token() }}'},
      cache: false,
      success: function(data){
        
        if(data == ""){
          
          $(".job-listings").html('\<div id="no-jobs" class="no-jobs-box">\
                    <h3>🚫 No Jobs Found</h3>\
                    <p>Sorry, no jobs match your search.</p>\
                  </div>');
        }else{
          $(".job-listings").append(data);
          
          
        }
        
        $("#sectorModal").hide();
        $("#employmentModal").hide();
        
        
        
      }
    });    
  }

  var emp_type_data = sessionStorage.getItem("emp_type_data-emp_type");
  console.log("emp_type_data",emp_type_data);
  if(emp_type_data != null){
    let arr = emp_type_data.split(",");
      
    getEmpFilterData('Employment Type',arr)
    
                                             
  }

  function getFilterDataAjax(filter_name,selectedValues){
    
    $.ajax({
      type: "POST",
      url: "{{ url('/nurse/getFilterData') }}",
      data: {filter_name:filter_name,selectedValues:selectedValues,_token:'{{ csrf_token() }}'},
      cache: false,
      success: function(data){
        if(data == ""){
          
          $(".job-listings").html('\<div id="no-jobs" class="no-jobs-box">\
                    <h3>🚫 No Jobs Found</h3>\
                    <p>Sorry, no jobs match your search.</p>\
                  </div>');
        }else{
          $("#no-jobs").remove();
          $(".job-listings").append(data);
          
          
        }
        
        $("#sectorModal").hide();
        $("#employmentModal").hide();
        $("input[name='sector']").prop("disabled", true);
        $("#oneTimeMessage").fadeIn();

        setTimeout(function() {
          
          $("#oneTimeMessage").fadeOut();
        }, 5000);
      }
    });    
  }

  let selected_sector_data = sessionStorage.getItem("sector_data");
  console.log("selected_sector_data",selected_sector_data);

  let selected_arr = [selected_sector_data];
  //applySector('sector'); 
  if(selected_sector_data != null){
    getFilterDataAjax('sector',selected_arr);
  }


  function editSector(){
    $("input[name='sector']").prop("disabled", false);
    $(".employee_type").prop("disabled", false);
    $(".shift_modal").prop("disabled", false);
    $(".assistent_level").prop("disabled", false);
    $(".work_environment_modals").prop("disabled", false);
  }

  // var sector_data = sessionStorage.getItem("sector_data");

  // if(sector_data){
  //   $("input[name='sector']")
  //       .prop("checked", false)   // uncheck all (actual state)
  //       .removeAttr("checked");   // also remove the HTML attribute

  //   $("input[name='sector'][value='" + sector_data + "']")
  //       .prop("checked", true)    // check the right one
  //       .attr("checked", "checked"); // reflect in HTML
  //   $("input[name='sector']").prop("disabled", true);
  // }

  $(document).ready(function() {
    let selected_sector_data = sessionStorage.getItem("sector_data");
    console.log("selected_sector_data", selected_sector_data);

    if (selected_sector_data) {
        // uncheck all first
        $("input[name='sector']").prop("disabled", false);

        // uncheck all
        $("input[name='sector']").prop("checked", false).removeAttr("checked");

        // check only the sessionStorage value
        $("input[name='sector'][value='" + selected_sector_data + "']")
            .prop("checked", true)
            .attr("checked", "checked");
        $("input[name='sector']").prop("disabled", true);    
    }

    if(selected_sector_data == null){
    
    $(".edit-btn").hide();
  }
});
  
  

  

  $("#toggleUpdatePreferences").click(function(){
    console.log("sector_data",sector_data);
    if ($(this).prop("checked")) {
      $.ajax({
        type: "POST",
        url: "{{ url('/nurse/updateSectorData') }}",
        data: {sector_data:sector_data,_token:'{{ csrf_token() }}'},
        cache: false,
        success: function(data){
          
          sessionStorage.removeItem("sector_data");
          $(".edit-btn").hide();
          $("input[name='sector']").prop("disabled", false);
        }
      });    
    }
  });

  var experience_data = sessionStorage.getItem("experience_value");
  console.log("experience_data",experience_data);

  if(experience_data !== null){
    
      $(".assistent_level").prop("disabled", true);
      $(".edit-btn-experience-modal").show();

  }

  function applyExperience() {

    let experience = $(".assistent_level").val();

    // get existing filters or create structure
    let filters = JSON.parse(sessionStorage.getItem("filters_data")) || {
        sector: [],
        emp_type: [],
        shift_modal: [],
        work_environment_modals: [],
        nurse_type: [],
        speciality: [],
        experience: null
    };

    // save experience
    filters.experience = Number(experience);

    // store back to sessionStorage
    sessionStorage.setItem("filters_data", JSON.stringify(filters));

    console.log("Updated filters_data (experience):", filters);

    // UI handling
    if (experience !== null && experience !== "") {
        $(".assistent_level").prop("disabled", true);
        $(".edit-btn-experience-modal").show();
    }

    // APPLY FILTERS USING EXISTING AJAX FLOW
    $("#yearExperienceModal").hide();
    fetchJobs(1);   // ✅ single source of truth
}

</script>

@endsection