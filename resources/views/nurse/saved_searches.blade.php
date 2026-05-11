
<div class="modal-overlay" id="save-search-modal" style="display: none;">
    <div class="modal-content">
        <h3 id="modal-title">Save Search</h3>
        <form method="post" id="add_saved_searches" method="POST" onsubmit="return add_saved_searches()">
        @csrf
        <div class="form-group level-drp">
            <label for="search-name">Search Name</label>

            <div class="tag-input-wrapper">
                <div class="smart-input-wrapper" id="smartInput">
                    <input
                        type="text"
                        id="search-name"
                        name="search_name"
                        placeholder="Type Sndney,Night shifts,ICU....."
                    >
                </div>
            </div>

            <span id='reqsearch-name' class='reqError text-danger valley'></span>
        </div>

        <div class="form-group level-drp">
                      
            <input type="hidden" id="suggestion-search-name" name="suggestion_search_name" class="form-control"> 
            <input type="hidden" id="search_type" name="search_type" class="form-control"> 
        </div>                  
        <!-- <div class="form-group level-drp">
            <label for="search-type">Search Type</label>              
            <select id="search-type" name="search_type" class="form-control">
                <option value="">Select</option>
                <option value="snapshot">Snapshot</option>
                <option value="hybrid">Hybrid</option>
                <option value="dynamic">Dynamic</option>
                
            </select>
            <span id='reqsearch-type' class='reqError text-danger valley'></span>
        </div>       -->
        <div class="form-group level-drp">
            <label for="alert-frequency">Alert Frequency</label>
            <select id="alert-frequency" name="alert_frequency" class="form-control">
                <option value="">Select</option>
                <option value="Off">Off</option>
                <option value="Realtime">Realtime</option>
                <option value="Daily">Daily</option>
                <option value="Weekly">Weekly</option>
            </select>
            <span id='reqalert-frequency' class='reqError text-danger valley'></span>
        </div>
        <div class="form-group level-drp">
            <label for="delivery-method">Delivery Method</label>
            <select id="delivery-method" name="delivery_method" class="form-control">
                <option value="">Select</option>
                <option value="Email">Email</option>
                <option value="In-app">In-app</option>
                <option value="SMS">SMS</option>
            </select>
            <span id='reqdelivery-method' class='reqError text-danger valley'></span>
        </div>
        <div class="modal-actions">
            <button type="button" class="btn-cancel">Cancel</button>
            <button type="submit" id="submitSavedSearches" class="btn-save">Save</button>
        </div>
        </form>
    </div>
</div>
<!-- DELETE CONFIRM MODAL -->
<div class="modal-overlay" id="delete-modal" style="display: none;">
    <div class="modal-content p-4">
        <p class="fs-4 p-0">This action cannot be undone.</p></br>
        <p class="fs-5 p-0">Are you sure?</p></br>
        <div class="d-flex align-items-center gap-2">
            <button class="modal-confirm" id="delete-confirm">Delete</button>
            <button class="modal-cancel" id="delete-cancel">Cancel</button>
        </div>
    </div>
</div>
<!-- Rename Modal -->
<div id="renameModal" class="modal-overlay" style="display:none;">
  <div class="modal-content">
    <h3>Rename Saved Search</h3>
    <input type="text" id="renameInput" class="form-control" placeholder="Enter new name">
    <div class="modal-actions">
      <button class="btn-cancel" id="renameCancel">Cancel</button>
      <button class="btn-save" id="renameSave1">Save</button>
    </div>
  </div>
</div>
<div class="drawer-overlay"></div>
<div class="edit_side_drawer">
    
    <div class="drawer" id="drawer">
        <div class="drawer-header-edit">
            <h3 id="drawer-title">Edit Search</h3>
            <button class="btn-cross" id="drawer-cancel"><i class="fi fi-rr-cross"></i></button>
        </div>
        
        <div class="tabs">
            <ul class="tab-nav-edit">
                <li class="active" data-tab="tab3">Filters</li>
                <li data-tab="tab4">Alerts</li>
                <li data-tab="tab5">Name & Notes</li>
            </ul>
            
        </div>
        <form method="post" id="update_saved_searches" method="POST" onsubmit="return update_saved_searches()">
            @csrf
            <input type="hidden" name="search_id" id="search_id">
            <div class="tab-content-edit active" id="tab3">
                <input type="hidden" name="saved_filters" class="saved_filters">
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Type of nurse</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        @php
                        $type_of_nurse = DB::table("practitioner_type")->where("parent","=","0")->get();
                        @endphp
                        @foreach($type_of_nurse as $nurse_type)
                        <label class="sub-heading nurse-type-{{ $nurse_type->id }}" data-name="Nurse Type" data-filter="nurse_type" data-value="{{ $nurse_type->id }}">
                            <input type="checkbox" name="nurse_type[]" class="nurse_type" value="{{ $nurse_type->id }}"> {{ $nurse_type->name }}</label>
                        
                        @endforeach
                        
                    </div>
                    <div class="subpagedata-nurse_type">
                        @foreach($type_of_nurse as $nurse_type)
                            @php
                                $subtype_of_nurse = DB::table("practitioner_type")
                                    ->where("parent", "=", $nurse_type->id)
                                    ->get();
                            @endphp

                            <div class="subpage subpage-nurse_type-{{ $nurse_type->id }}">
                                <div class="subpage-header">
                                    <span class="back-btn">‹</span>
                                    <h4>{{ $nurse_type->name }}</h4>
                                </div>

                                <div class="subpage-content">
                                    @foreach($subtype_of_nurse as $sub_nurse)
                                        <label class="sub-heading sub-heading-nurse_type-{{ $sub_nurse->id }}"
                                            data-name="{{ $sub_nurse->name }}"
                                            data-filter="nurse_type"
                                            data-value="{{ $sub_nurse->id }}">
                                            <input type="checkbox" class="nurse_type" value="{{ $sub_nurse->id }}" name="nurse_type[]">
                                            {{ $sub_nurse->name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Sector</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        <label><input type="radio" class="edit_sector_radio" name="edit_sector" value="1" {{ ($filters['sector'] ?? '') === 'Public & Government' ? 'checked' : '' }}> Public & Government </label>
                        <label><input type="radio" class="edit_sector_radio" name="edit_sector" value="2" {{ ($filters['sector'] ?? '') === 'Private' ? 'checked' : '' }}> Private </label>
                        <label><input type="radio" class="edit_sector_radio" name="edit_sector" value="3" {{ ($filters['sector'] ?? '') === 'Public Government & Private' ? 'checked' : '' }}> Public Government & Private</label>
                    </div>
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Employment Type</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        @php
                        $employeement_type_data = DB::table("employeement_type_preferences")->where("sub_prefer_id","=","0")->get();
                        @endphp
                        @foreach($employeement_type_data as $emp_data)
                        <label class="sub-heading emp-type-{{ $emp_data->emp_prefer_id }}" data-name="Employment Type" data-filter="employment_type" data-value="{{ $emp_data->emp_prefer_id }}">
                        <input type="checkbox" class="employment_types" name="employment_type[]"  value="{{ $emp_data->emp_prefer_id }}"
                            {{ in_array($emp_data->emp_prefer_id, $filters['employment_type'] ?? []) ? 'checked' : '' }}> {{ $emp_data->emp_type }}</label>
                        
                        @endforeach
                        
                    </div>
                    <div class="subpagedata-employment_type">
                        @foreach($employeement_type_data as $emp_data)
                            @php
                                $subemployeement_type_data = DB::table("employeement_type_preferences")->where("sub_prefer_id","=",$emp_data->emp_prefer_id)->get();
                            @endphp

                            <div class="subpage subpage-employment_type-{{ $emp_data->emp_prefer_id }}">
                                <div class="subpage-header">
                                    <span class="back-btn">‹</span>
                                    <h4>{{ $emp_data->emp_type }}</h4>
                                </div>

                                <div class="subpage-content">
                                    @foreach($subemployeement_type_data as $subemployeement_type)
                                        <label class="sub-heading sub-heading-employment_type-{{ $subemployeement_type->emp_prefer_id }}"
                                            data-name="{{ $subemployeement_type->emp_type }}"
                                            data-filter="employment_type"
                                            data-value="{{ $subemployeement_type->emp_prefer_id }}">
                                            <input type="checkbox" class="employment_types" value="{{ $subemployeement_type->emp_prefer_id }}" name="employment_type[]">
                                            {{ $subemployeement_type->emp_type }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Shift Type</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        @php
                        $work_shift_data = DB::table("work_shift_preferences")->where("shift_id","=","0")->get();
                        @endphp
                        @foreach($work_shift_data as $work_shift)
                        <label class="sub-heading shift-type-{{ $work_shift->work_shift_id }}" data-filter="work_shift"
                            data-value="{{ $work_shift->work_shift_id }}"
                            data-name="Shift Type">
                            <input type="checkbox" name="work_shift[]" class="work_shift_types" value="{{ $work_shift->work_shift_id }}"> {{ $work_shift->shift_name }}</label>
                        
                        @endforeach
                        
                    </div>
                    <div class="subpagedata-work_shift">
                         @foreach($work_shift_data as $work_shift)
                            @php
                                $work_shift_subdata = DB::table("work_shift_preferences")->where("shift_id","=",$work_shift->work_shift_id)->get();
                            @endphp

                            <div class="subpage subpage-work_shift-{{ $work_shift->work_shift_id }}">
                                <div class="subpage-header">
                                    <span class="back-btn">‹</span>
                                    <h4>{{ $work_shift->shift_name }}</h4>
                                </div>

                                <div class="subpage-content">
                                    @foreach($work_shift_subdata as $work_shift_sub)
                                        <label class="sub-heading sub-heading-shift_type-{{ $work_shift_sub->work_shift_id }}"
                                            data-name="{{ $work_shift_sub->shift_name }}"
                                            data-filter="work_shift"
                                            data-value="{{ $work_shift_sub->work_shift_id }}">
                                            <input type="checkbox" class="shift_types" value="{{ $work_shift_sub->work_shift_id }}" name="work_shift[]">
                                            {{ $work_shift_sub->shift_name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Work Environment</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        @php
                        $work_environment_data = DB::table("work_enviornment_preferences")->where("sub_env_id","=","0")->get();
                        @endphp
                        @foreach($work_environment_data as $work_environment)
                        <label class="sub-heading work-environment-{{ $work_environment->prefer_id }}" 
                            data-name="Work Environment" 
                            data-filter="work_environment" 
                            data-value="{{ $work_environment->prefer_id }}">
                            <input type="checkbox" name="work_environment[]" value="{{ $work_environment->prefer_id }}"> {{ $work_environment->env_name }}
                        </label>
                        @endforeach

                        
                    </div>
                    <div class="subpagedata-work_environment">
                        @foreach($work_environment_data as $work_environment)
                            @php
                                $work_environment_data = DB::table("work_enviornment_preferences")->where("sub_env_id","=",$work_environment->prefer_id)->get();
                            @endphp

                            <div class="subpage subpage-work_environment-{{ $work_environment->prefer_id }}">
                                <div class="subpage-header">
                                    <span class="back-btn">‹</span>
                                    <h4>{{ $work_environment->env_name }}</h4>
                                </div>

                                <div class="subpage-content">
                                    @foreach($work_environment_data as $work_environment_sub)
                                        <label class="sub-heading sub-heading-work_environment-{{ $work_environment_sub->prefer_id }}"
                                            data-name="{{ $work_environment_sub->env_name }}"
                                            data-filter="work_environment"
                                            data-value="{{ $work_environment_sub->prefer_id }}">
                                            <input type="checkbox" class="shift_types" value="{{ $work_environment_sub->prefer_id }}" name="work_environment[]">
                                            {{ $work_environment_sub->env_name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Benefits</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        @php
                        $benefits_preferences = DB::table("benefits_preferences")->where("subbenefit_id","=","0")->get();
                        @endphp
                        @foreach($benefits_preferences as $benprefer)
                        <label class="sub-heading benefits_preferences-{{ $benprefer->benefits_id }}" 
                            data-name="Benefit Preferences" 
                            data-filter="benefits_preferences" 
                            data-value="{{ $benprefer->benefits_id }}">
                            <input type="checkbox" name="benefits_preferences[]" value="{{ $benprefer->benefits_id }}" {{ in_array($benprefer->benefits_id, $filters['benefits_preferences'] ?? []) ? 'checked' : '' }}> {{ $benprefer->benefits_name }}
                        </label>
                        @endforeach

                        
                    </div>
                    <div class="subpagedata-benefits_preferences">
                        @foreach($benefits_preferences as $benprefer)
                            @php
                                $benefits_preferences = DB::table("benefits_preferences")->where("subbenefit_id","=",$benprefer->benefits_id)->get();
                            @endphp

                            <div class="subpage subpage-benefits_preferences-{{ $benprefer->benefits_id }}">
                                <div class="subpage-header">
                                    <span class="back-btn">‹</span>
                                    <h4>{{ $benprefer->benefits_name }}</h4>
                                </div>

                                <div class="subpage-content">
                                    @foreach($benefits_preferences as $benefits_prefer)
                                        <label class="sub-heading sub-heading-benefits_preferences-{{ $benefits_prefer->benefits_id }}"
                                            data-name="{{ $benefits_prefer->benefits_name }}"
                                            data-filter="benefits_preferences"
                                            data-value="{{ $benefits_prefer->benefits_id }}">
                                            <input type="checkbox" class="benefits_preferences" value="{{ $benefits_prefer->benefits_id }}" name="benefits_preferences[]">
                                            {{ $benefits_prefer->benefits_name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Location Preferences</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        <label><input type="radio" class="edit_location_radio" name="edit_location" value="Current Location (Auto-detect optional)" {{ ($filters['location_type'] ?? '') === 'Current Location (Auto-detect optional)' ? 'checked' : '' }}> Current Location (Auto-detect optional) </label>
                        <label><input type="radio" class="edit_location_radio" name="edit_location" value="Multiple Locations" {{ ($filters['location_type'] ?? '') === 'Multiple Locations' ? 'checked' : '' }}> Multiple Locations </label>
                        <label><input type="radio" class="edit_location_radio" name="edit_location" value="International" {{ ($filters['location_type'] ?? '') === 'International' ? 'checked' : '' }}> International</label>
                    </div>
                    <div class="subpagedata">
                        <div class="subpage subpage-current">
                            <div class="subpage-header">
                                <span class="back-btn">&#8249;</span>
                                <h4>Current Location</h4>
                            </div>
                            <div class="subpage-content">
                                <div id="preferredLocationInput" class="mb-3">
                                    <label class="form-label fw-bold">Preferred Location</label>
                                    <input type="text" id="locationSearch" class="form-control" value="{{ $work_preferences_data->prefered_location_current }}" placeholder="Search city / postcode / hospital">
                                    <div id="locationTags" class="mt-2"></div>
                                </div>

                                
                                <div id="travelDistanceContainer" class="mb-3">
                                    <label class="form-label fw-bold">Maximum Travel Distance</label>
                                    <input type="range" id="travelDistance" min="5" max="100" step="5" value="20" class="form-range">
                                    <span id="distanceValue" class="fw-semibold">20 km</span>
                                </div>
                            </div>
                        </div>
                        <div class="subpage subpage-multiple">
                            <div class="subpage-header">
                                <span class="back-btn">&#8249;</span>
                                <h4>Multiple Location</h4>
                            </div>
                            <div class="subpage-content">
                                <div id="preferredLocationInput" class="mb-3">
                                    <label class="form-label fw-bold">Preferred Location</label>
                                    <input type="text" id="locationSearch" class="form-control" value="{{ $work_preferences_data->prefered_location_current }}" placeholder="Search city / postcode / hospital">
                                    <div id="locationTags" class="mt-2"></div>
                                </div>

                            </div>
                        </div>
                        <div class="subpage subpage-international">
                            <div class="subpage-header">
                                <span class="back-btn">&#8249;</span>
                                <h4>International Location</h4>
                            </div>
                            <div class="subpage-content">
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
                        </div>
                    </div>
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Specialty</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        @php
                        $speciality = DB::table("speciality")->where("parent","=","0")->get();
                        @endphp
                        @foreach($speciality as $spec)
                        <label class="sub-heading nurse-type-{{ $spec->id }}" data-name="Speciality" data-filter="speciality" data-value="{{ $spec->id }}">
                            <input type="checkbox" name="speciality[]" value="{{ $spec->id }}" {{ in_array($spec->id, $filters['speciality'] ?? []) ? 'checked' : '' }}> {{ $spec->name }}</label>
                        
                        @endforeach
                        
                    </div>
                    <div class="subpagedata-speciality">
                        @foreach($speciality as $spec)
                            @php
                                $speciality = DB::table("speciality")->where("parent","=",$spec->id)->get();
                            @endphp

                            <div class="subpage subpage-benefits_preferences-{{ $spec->id }}">
                                <div class="subpage-header">
                                    <span class="back-btn">‹</span>
                                    <h4>{{ $benprefer->benefits_name }}</h4>
                                </div>

                                <div class="subpage-content">
                                    @foreach($benefits_preferences as $benefits_prefer)
                                        <label class="sub-heading sub-heading-benefits_preferences-{{ $benefits_prefer->benefits_id }}"
                                            data-name="{{ $benefits_prefer->benefits_name }}"
                                            data-filter="benefits_preferences"
                                            data-value="{{ $benefits_prefer->benefits_id }}">
                                            <input type="checkbox" class="benefits_preferences" value="{{ $benefits_prefer->benefits_id }}" name="benefits_preferences[]">
                                            {{ $benefits_prefer->benefits_name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Years of Experience</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        <div class="form-group level-drp">
                            <label>Experience(In Year)</label>
                            <input type="number" id="year_experience" class="form-control" name="year_experience"value="{{ $filters['experience_years'] ?? '' }}">
                        </div>
                        
                    </div>
                </div>
                <div class="filter-section">
                    <div class="filter-title">
                        <span>Salary Range</span>
                        <span class="icon">&#8250;</span>
                    </div>
                    <div class="filter-options">
                        <div class="salary-range-wrapper">
                            <label class="filter-label">Salary Range</label>
                            <div class="range-container">
                                <div class="slider-track"></div>
                                <input type="range" name="minSalary1" id="minSalary1" min="0" max="200000" step="1000" value="{{ $filters['salary']['min'] ?? 0 }}">
                                <input type="range" name="maxSalary1" id="maxSalary1" min="0" max="200000" step="1000"  value="{{ $filters['salary']['max'] ?? 0 }}">
                            </div>
                            <div class="salary-values">
                                <span id="minSalaryValue1">₹30,000</span> - 
                                <span id="maxSalaryValue1">₹1,20,000</span>
                            </div>
                        </div>


                        
                    </div>
                </div>
                
            </div>
            <div class="tab-content-edit" id="tab4">
                <div class="form-group level-drp">
                    <label for="alert-frequency">Frequency</label>
                    <select id="edit-alert-frequency" class="form-control" name="alert_frequency">
                        <option value="Off">Off</option>
                        <option value="Realtime">Realtime</option>
                        <option value="Daily">Daily</option>
                        <option value="Weekly">Weekly</option>
                    </select>
                </div>
                <div class="form-group level-drp">
                    <label>Delivery</label>
                    <select id="edit-alert-delivery" class="form-control" name="delivery_method">
                        <option>Email</option>
                        <option>In-app</option>
                        <option>SMS</option>
                    </select>
                </div>    
                <!-- <div class="form-group level-drp">
                    <label>Daily Cap</label>
                    <input type="number" id="alert-cap" class="form-control" name="edit_alert_cap" min="0">
                </div> -->
                <div class="form-group level-drp">
                    <label>Quiet Hours</label>
                    <input type="time" id="quiet-start" class="form-control" name="edit_quiet_start"> - <input type="time" id="quiet-end" class="form-control" name="edit_quiet_end">
                </div>
            </div>
            <div class="tab-content-edit" id="tab5">
                <div class="form-group level-drp">
                    <label>Name</label>
                    <input type="text" id="edit-search-name" class="form-control" name="search_name">
                </div>
                <div class="form-group level-drp">
                    <label>Notes</label>
                    <input type="text" id="search-notes" class="form-control" name="edit_search_notes">
                </div>
            </div>
            <div class="buttons">
                <button type="button" class="btn-cancel" id="drawer-cancel">Cancel</button>
                <button type="submit" class="btn-save" id="drawer-save">Save Changes</button>
            </div>
        </form>
    </div>
</div>
<div id="filterModal" class="modal-overlay" style="display:none;">
  <div class="modal-content">
    <button id="closeModal" class="close"
      onmouseover="this.style.background='#f2f2f2'"
      onmouseout="this.style.background='#f8f8f8'"
    >
      ×
    </button>
    <h3>Filters summary</h3>
    <div id="modalContent"></div>
  </div>
</div>

<script>
    // Pass PHP filters JSON safely to JavaScript
    window.savedFilters = @json($filters ?? []);
</script>
<script>
   $(document).ready(function () {
    // if ($('#toggleRegisteredPreferences').is(':checked')) {
    //     console.log('Checkbox is checked');

    //     $.ajax({
    //         url: '{{ route("nurse.get_filters_data") }}',
    //         type: 'POST',
    //         data: {
    //             _token: "{{ csrf_token() }}"
    //         },
    //         success: function(res) {
                
    //             var res_data = JSON.parse(res);
    //             var filter_data = [];
    //             for(var i=0;i<res_data.length;i++){
    //                 $("#smartInput").prepend('<span class="tag">'+res_data[i]+'\
    //                 <span class="remove-tag remove-tag-'+i+'">×</span>\
    //                 </span>');
    //                 //removeTag(res_data[i]);
    //                 filter_data.push(res_data[i]);
    //             }
                
    //             $("#suggestion-search-name").val(JSON.stringify(filter_data));
    //             $("#search_type").val("Dynamic");
    //             //console.log("res_data", res_data);
    //         }
    //     });     
    // }
    let availableTags = [];

    // $.ajax({
    //     url: '{{ route("nurse.get_tags") }}',
    //     type: 'POST',
    //     data: {
    //         _token: "{{ csrf_token() }}"
    //     },
    //     success: function(res) {
            
    //         var res_data = JSON.parse(res);
            
    //         availableTags = res_data;
            

    //         //console.log("availableTags", availableTags);
    //     }
    // });     



    // let selectedTags = [];

    // // 🔹 Autocomplete setup
    // $("#search-name").autocomplete({
    //     source: function(request, response) {
    //     const term = request.term.toLowerCase();
    //     const filtered = availableTags.filter(tag => 
    //         tag.toLowerCase().includes(term) && !selectedTags.includes(tag)
    //     );
    //     response(filtered);
    //     },
    //     select: function(event, ui) {
    //     addTag(ui.item.value);
    //     $(this).val('');
    //     return false;
    //     }
    // });

    // 🔹 Add tag to UI
    // function addTag(tagText) {
        
    //     if (!selectedTags.includes(tagText)) {
    //         selectedTags.push(tagText);
    //         const tagEl = $('<span class="tag"></span>').text(tagText);
    //         const removeBtn = $('<span class="remove-tag">&times;</span>').click(function() {
    //             removeTag(tagText);
    //         });
    //         tagEl.append(removeBtn);
    //         $("#smartInput").prepend(tagEl);
    //         //updateSuggestion();
    //         updateHiddenField();
    //     }
    // }

    // 🔹 Remove tag
    // function removeTag(tagText) {
    //     selectedTags = selectedTags.filter(tag => tag !== tagText);
    //     $(".tag").filter(function() { return $(this).text().includes(tagText); }).remove();
    //     //updateSuggestion();
    //     updateHiddenField();
    // }

    // 🔹 Update suggestion dynamically
    // function updateSuggestion() {
    //     if (selectedTags.length === 0) {
    //     $("#suggestion-search-name").val("–");
    //     } else {
    //     $("#suggestion-search-name").val(selectedTags.join(" • "));
    //     }
    // }

    // function updateHiddenField() {
    //     $("#suggestion-search-name").val(JSON.stringify(selectedTags));
    // }

    // 🔹 Press Enter to add text manually
    // $("#search-name").on("keydown", function(e) {
    //     if (e.key === "Enter" && this.value.trim() !== "") {
    //     e.preventDefault();
    //     addTag(this.value.trim());
    //     this.value = "";
    //     }
    // });

    
    
    $(document).on('change', '#selectAll', function() {
        const isChecked = $(this).is(':checked');
        $('.select-item').prop('checked', isChecked);
    });

    $(document).on('click', '.btn-run', function(e) {
        //alert("hello");
        e.preventDefault();
        const id = $(this).data('id');
        const baseUrl = `{{ url('/nurse/run-saved-search') }}`;
        $.ajax({
            url: `${baseUrl}/${id}`,
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            beforeSend: function() {
                console.log("Running saved search...");
            },
            success: function(res) {
                const now = new Date();

                const formattedDateTime =
                now.getFullYear() + '/' +
                String(now.getMonth() + 1).padStart(2, '0') + '/' +
                String(now.getDate()).padStart(2, '0');

                console.log(formattedDateTime);
                $(".last_run_at-"+id).text(formattedDateTime);
                if (res.success) {
                    // Example: display job cards dynamically
                    renderJobResults(res.jobs);
                } else {
                    alert("No jobs found.");
                }
            },
            error: function(xhr) {
                console.error("Error:", xhr.responseText);
            }
        });
    });

    // function renderJobResults(jobs) {
    //     let html = '';
    //     if (jobs.length === 0) {
    //         html = `<p>No matching jobs found.</p>`;
    //     } else {
    //         jobs.forEach(job => {
    //             html += `
    //                 <div class="job-card">
    //                     <h4>${job.title}</h4>
    //                     <p>${job.location}</p>
    //                     <p>${job.pay_range}</p>
    //                     <button class="apply-now">Apply Now</button>
    //                 </div>
    //             `;
    //         });
    //     }
    //     $('#jobResultsContainer').html(html);
    // }

    // $(document).on('change', '.alert-toggle-input', function() {
    //     const $this = $(this); // the toggle that changed
    //     const search_id = $this.data('id'); 
    //     const baseUrl = `{{ url('/nurse/updateAlert') }}`;

    //     // Check if this specific toggle is checked
    //     const frequency = $this.is(':checked') ? "Realtime" : "Off";

    //     $.ajax({
    //         type: "POST",
    //         url: `${baseUrl}/${search_id}`,
    //         data: {
    //             search_id: search_id,
    //             frequency_value: frequency,
    //             _token: "{{ csrf_token() }}"
    //         },
    //         cache: false,
    //         success: function (data) {
    //             console.log("Updated alert:", frequency);
    //         },
    //         error: function (xhr) {
    //             console.error("Error:", xhr.responseText);
    //         }
    //     });
    // });

    //$('.filter-options input[type="checkbox"]:checked').prop('disabled', true);
    // Toggle filter sections
    $('.filter-title').click(function () {
        const $current = $(this);
        const $options = $current.next('.filter-options');

        // Close all other sections
        $('.filter-title').not($current).removeClass('active');
        $('.filter-options').not($options).slideUp(200);

        // Toggle current section
        $current.toggleClass('active');
        $options.slideToggle(200);
    });


    const subpageStack = []; // Track navigation history

    // Handle first-level filter click
    $(document).on("click", ".sub-heading[data-value]", function (e) {
        
        const $this = $(this);
        const id = $this.data("value");
        const filterType = $this.data("filter");
        const filterName = $this.data("name");

        // Only trigger if checkbox is checked
        if (!$this.find('input[type="checkbox"]').prop('checked')) return;
        
        // if ($('.emp-type-'+id+' input').attr('checked') == 'checked') {
            
        //     $('.emp-type-'+id+' input').prop('disabled', true);
        // }
           
            fetchAndBuildSubPage(filterName, filterType, id);
        

        
        //const uniqueKey = `${filterType}-${id}`;
        //fetchAndBuildSubPage(filterName, filterType, id);
    });


    function fetchAndBuildSubPage(filterName, filterType, id) {
        const uniqueKey = `${filterType}-${id}`; // 👈 unique per filterType + id
        //alert(uniqueKey);
        $.ajax({
            type: "GET",
            url: "{{ url('/nurse/getEmpDataSearch') }}",
            data: {
                filter_name: filterName,
                sub_prefer_id: id,
                filter_type: filterType
            },
            cache: false,
            success: function (data) {
                if (!data.main || !data.subtypes || data.subtypes.length === 0) {
                    const savedValues = savedFilters && savedFilters[filterType]
                        ? savedFilters[filterType]
                        : [];

                    console.log("savedValues",savedFilters);    
                    showToast("No data found for this filter.");
                    return;
                }
                buildSubPage(data, filterType, uniqueKey);
            },
            error: function (xhr) {
                console.error("Error:", xhr.responseText);
            }
        });
    }

    function buildSubPage(filterData, filterType, uniqueKey) {
        console.log("filterData",filterData);
        const mainId = filterData.main.id;
        const mainName = filterData.main.name;

        

        const savedValues = savedFilters && savedFilters[filterType]
            ? savedFilters[filterType]
            : [];

        console.log("savedValues",savedValues);    

        // Hide current active page (if any)
        const $activePage = $(".subpage.active");
        if ($activePage.length) {
            subpageStack.push($activePage);
            $activePage.removeClass("active");
        }

        // Avoid duplicates
        if ($(".subpage-" + uniqueKey).length) {
            $(".subpage-" + uniqueKey).addClass("active");
            return;
        }

        

        // Build sub-options with pre-checked state
        let subOptions = '';
        filterData.subtypes.forEach(function (sub) {
            console.log("sub.id",savedValues);    
            const isChecked = Array.isArray(savedValues) && savedValues.includes(sub.id)
                ? 'checked'
                : '';

            subOptions += `
                <label class="sub-heading sub-heading-${filterType}-${sub.id}" 
                    data-name="${sub.name}" 
                    data-filter="${filterType}" 
                    data-value="${sub.id}">
                    <input type="checkbox" value="${sub.id}" name="${filterType}[]" ${isChecked}> 
                    ${sub.name}
                </label>`;
        });

        // Create new subpage (with uniqueKey)
        const subpageHTML = `
            <div class="subpage subpage-${uniqueKey}">
                <div class="subpage-header">
                    <span class="back-btn">&#8249;</span>
                    <h4>${mainName}</h4>
                </div>
                <div class="subpage-content">
                    ${subOptions}
                </div>
            </div>`;

        //$(".subpagedata-" + filterType).append(subpageHTML);
        const $newPage = $(".subpage-" + uniqueKey);
        $newPage.addClass("active");

        

        // Back button handler
        $newPage.find(".back-btn").on("click", function () {
            $newPage.removeClass("active");

            if (subpageStack.length > 0) {
                const $prevPage = subpageStack.pop();
                $prevPage.addClass("active");
            }
        });

        // Nested checkbox subtypes
        $newPage.find(".sub-heading input[type='checkbox']").off('change').on('change', function () {
            const $label = $(this).closest('.sub-heading');
            const subId = $label.data("value");
            const subName = $label.data("name");
            const subFilterType = $label.data("filter");

            if (this.checked) {
                fetchAndBuildSubPage(subName, subFilterType, subId);
            }
        });
    }



        const $min = $('#minSalary1');
        const $max = $('#maxSalary1');
        const $minVal = $('#minSalaryValue1');
        const $maxVal = $('#maxSalaryValue1');
        const $track = $('.slider-track');

        const minLimit = parseInt($min.attr('min'));
        const maxLimit = parseInt($max.attr('max'));

        function formatCurrency(value) {
            return '₹' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function updateValues() {
            let min = parseInt($min.val());
            let max = parseInt($max.val());
            
            if (min > max - 1000) {
                min = max - 1000;
                $min.val(min);
            }

            const percent1 = ((min - minLimit) / (maxLimit - minLimit)) * 100;
            const percent2 = ((max - minLimit) / (maxLimit - minLimit)) * 100;

            $track.css({
                background: `linear-gradient(to right, #ccc ${percent1}%, #e63946 ${percent1}%, #e63946 ${percent2}%, #ccc ${percent2}%)`
            });

            $minVal.text(formatCurrency(min));
            $maxVal.text(formatCurrency(max));
        }

        $('input[type="range"]').on('input change', updateValues);
        updateValues();

        $('.edit_location_radio').on('change', function () {
            const selected = $(this).val();
            // Show drawer based on selected radio
            if (selected === 'Current Location (Auto-detect optional)') {
                $('.subpage-current').addClass("active");
            } else if (selected === 'Multiple Locations') {
                $('.subpage-multiple').addClass("active");
            } else if (selected === 'International') {
                $('.subpage-international').addClass("active");
            }
            
        });
        $(".subpage .back-btn").on("click", function () {
            $(this).closest(".subpage").removeClass("active");
        });

 $(document).on('click', '.btn-readmore', function(e) {
            e.preventDefault();
            var modal_id = $(this).data('id');
            //alert(modal_id);
            $('#filterModal').attr('data-id', modal_id);
            const filters = $(this).data('filters');
            const parsed = filters || {};
            let html = "";

            // Common inline styles
            const chipStyle = `
                display:inline-flex;
                align-items:center;
                gap:6px;
                margin:4px 6px 4px 0;
                padding:6px 12px;
                background:#f4f4f4;
                border-radius:999px;
                font-size:14px;
                color:#333;
                line-height:1.4;
                border:1px solid #e0e0e0;
                font-weight:500;
                white-space:nowrap;
            `;

            const closeStyle = `
                background:none;
                border:none;
                color:#666;
                cursor:pointer;
                font-size:16px;
                line-height:1;
                margin-left:4px;
            `;

            const sectionStyle = `
                margin-bottom:12px;
            `;

            const headingStyle = `
                font-weight:600;
                font-size:14px;
                text-transform:capitalize;
                margin-bottom:6px;
                color:#111;
                display:block;
            `;

            // Build chips dynamically
            $.each(parsed, function(key, value) {
                if (Array.isArray(value)) {
                    html += `<div style="${sectionStyle}">`
                             
                    value.forEach(v => {
                        html += `
                            <span class="chip" 
                                data-key="${key}" 
                                data-value="${v}" 
                                style="${chipStyle}">
                                ${v}
                                <button class="chip-close" style="${closeStyle}">&times;</button>
                            </span>`;
                    });
                    html += `</div>`;
                } 
                else if (typeof value === 'object' && value !== null && value.min !== undefined) {
                    // Salary range object
                    html += `<div style="${sectionStyle}">
                                
                                <span class="chip" data-key="${key}" style="${chipStyle}">
                                    $${value.min} – $${value.max}
                                </span>
                            </div>`;
                } 
                else if (value) {
                    // Single string or number
                    html += `<div style="${sectionStyle}">
                                
                                <span class="chip" data-key="${key}" data-value="${value}" style="${chipStyle}">
                                    ${value}
                                    <button class="chip-close" style="${closeStyle}">&times;</button>
                                </span>
                            </div>`;
                }
            });

            $('#modalContent').html(html);
            $('#filterModal').fadeIn();
        });
        $(document).on('click', '.chip-close', function () {
            const $chip = $(this).closest('.chip');
            const value = $chip.data('value'); // Each chip has value text

            // Remove from UI
            $chip.remove();

            // Uncheck corresponding checkbox/radio
            $(`input[value="${value}"]`).prop("checked", false).trigger("change");

            // Get the saved search ID
            const searchId = $('#filterModal').data('id'); 

            if (!searchId) {
                console.warn("No saved search ID found.");
                return;
            }

            let baseUrl = `{{ url('/nurse/remove-filter') }}`;

            // AJAX call to update backend
            $.ajax({
                url: `${baseUrl}/${searchId}`,
                type: 'POST',
                data: {
                    value: value,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log('Filter removed successfully:', response);
                    showToast('Filter removed successfully');
                },
                error: function (xhr) {
                    console.error('Error removing filter:', xhr.responseText);
                }
            });
        });





            $(document).on('click', '.close', function() {
            $('#filterModal').fadeOut();
            });

            $(window).on('click', function(e) {
            if ($(e.target).is('#filterModal')) $('#filterModal').fadeOut();
            });


        });

    function add_saved_searches() {
        var isValid = true;

        // if ($('[name="search_name"]').val() == '') {

        //     document.getElementById("reqsearch-name").innerHTML = "* Please enter the Search Name";
        //     isValid = false;

        // }

        // if ($('[name="search_type"]').val() == '') {

        //     document.getElementById("reqsearch-type").innerHTML = "* Please select the Search Type";
        //     isValid = false;

        // }

        // if ($('[name="alert_frequency"]').val() == '') {

        //     document.getElementById("reqalert-frequency").innerHTML = "* Please select the Alert Frequency";
        //     isValid = false;

        // }

        // if ($('[name="delivery_method"]').val() == '') {

        //     document.getElementById("reqdelivery-method").innerHTML = "* Please select the Delivery Method";
        //     isValid = false;

        // }

        if (isValid == true) {
            const name = $('#search-name').val().trim() || 'New Search';
            const alert_frequency = $('#alert-frequency').val();
            const delivery = $('#delivery-method').val();
            const newId = Date.now();
            addSearchToUI(newId, name,'', alert_frequency, delivery);
            $.ajax({
            url: "{{ route('nurse.addSavedSearches') }}",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('#add_saved_searches')[0]),
            dataType: 'json',
            beforeSend: function() {
            $('#submitSavedSearches').prop('disabled', true);
            $('#submitSavedSearches').text('Process....');
            },
            success: function(res) {
             
            if (res.status == '1') {
                $('#savedSearchTable tr').each(function() {
                    if ($(this).is('[data-value]') == false) {
                        $(this).attr('data-value', res.id);
                    }
                });
                $('#submitSavedSearches').text('Save');
                $('#save-search-modal').hide();
                showToast('Save Search Added Successfully');
                
            } else {
                showToast(res.message);
                
            }
            },
            error: function(errorss) {
            $('#submitSavedSearches').prop('disabled', false);
            $('#submitSavedSearches').text('Save Changes');
            console.log("errorss", errorss);
            for (var err in errorss.responseJSON.errors) {
                $("#submitSavedSearches").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
            }
            }
        
            });
        }
        return false;
    }

    function update_saved_searches() {
        var isValid = true;

        // if ($('[name="search_name"]').val() == '') {

        //     document.getElementById("reqsearch-name").innerHTML = "* Please enter the Search Name";
        //     isValid = false;

        // }

        // if ($('[name="alert_frequency"]').val() == '') {

        //     document.getElementById("reqalert-frequency").innerHTML = "* Please select the Alert Frequency";
        //     isValid = false;

        // }

        // if ($('[name="delivery_method"]').val() == '') {

        //     document.getElementById("reqdelivery-method").innerHTML = "* Please select the Delivery Method";
        //     isValid = false;

        // }

        // let filterData = {};

        // // 1️⃣ SECTOR (radio)
        // const selectedSector = $('input[name="edit_sector"]:checked').val();
        // if (selectedSector) filterData['sector'] = selectedSector;

        // // 2️⃣ EMPLOYMENT TYPE (checkboxes)
        // const empTypes = [];
        // $('[data-filter="employment_type"] input[type="checkbox"]:checked, .emp-type input[type="checkbox"]').each(function () {
        //     if ($(this).is(':checked')) empTypes.push($(this).val());
        // });
        // if (empTypes.length) filterData['employment_type'] = empTypes;

        // // 3️⃣ WORK SHIFT
        // const workShifts = [];
        // $('[data-filter="work_shift"] input[type="checkbox"]:checked').each(function () {
        //     workShifts.push($(this).val());
        // });
        // if (workShifts.length) filterData['work_shift'] = workShifts;

        // // 4️⃣ WORK ENVIRONMENT
        // const workEnvs = [];
        // $('[data-filter="work_environment"] input[type="checkbox"]:checked').each(function () {
        //     workEnvs.push($(this).val());
        // });
        // if (workEnvs.length) filterData['work_environment'] = workEnvs;

        // // 5️⃣ POSITION
        // const positions = [];
        // $('[data-filter="employee_positions"] input[type="checkbox"]:checked').each(function () {
        //     positions.push($(this).val());
        // });
        // if (positions.length) filterData['employee_positions'] = positions;

        // // 6️⃣ BENEFITS
        // const benefits = [];
        // $('[data-filter="benefits_preferences"] input[type="checkbox"]:checked').each(function () {
        //     benefits.push($(this).val());
        // });
        // if (benefits.length) filterData['benefits_preferences'] = benefits;

        // // 7️⃣ LOCATION PREFERENCE (radio)
        // const locationType = $('input[name="edit_location"]:checked').val();
        // if (locationType) {
        //     filterData['location_type'] = locationType;

        //     // Handle sub-drawers for each location type
        //     if (locationType.includes('Current Location')) {
        //         filterData['preferred_location'] = $('#locationSearch').val() || '';
        //         filterData['max_travel_distance'] = $('#travelDistance').val() + ' km';
        //     }
        //     else if (locationType.includes('Multiple')) {
        //         filterData['preferred_locations'] = $('#locationSearch').val() || '';
        //     }
        //     else if (locationType.includes('International')) {
        //         const countries = [];
        //         $('.subpage-international input[type="checkbox"]:checked').each(function () {
        //             countries.push($(this).parent().text().trim());
        //         });
        //         filterData['international_countries'] = countries;
        //     }
        // }

        // // 8️⃣ TYPE OF NURSE
        // const nurseTypes = [];
        // $('[data-filter="nurse_type"] input[type="checkbox"]:checked').each(function () {
        //     nurseTypes.push($(this).val());
        // });
        // if (nurseTypes.length) filterData['nurse_type'] = nurseTypes;

        // // 9️⃣ SPECIALTY
        // const specialties = [];
        // $('[data-filter="speciality"] input[type="checkbox"]:checked').each(function () {
        //     specialties.push($(this).val());
        // });
        // if (specialties.length) filterData['speciality'] = specialties;

        // // 🔟 YEARS OF EXPERIENCE
        // const experience = $('#year_experience').val();
        // if (experience) filterData['years_of_experience'] = experience;

        // // 1️⃣1️⃣ SALARY RANGE
        // const minSalary = $('#minSalary1').val();
        // const maxSalary = $('#maxSalary1').val();
        // filterData['salary_range'] = {
        //     min: parseInt(minSalary),
        //     max: parseInt(maxSalary)
        // };

        // // ✅ OUTPUT JSON
        // console.log("FILTER JSON:", filterData);
        // console.log("JSON STRING:", JSON.stringify(filterData, null, 2));

        let selectedValues = [];
        // 🔹 Get all checked checkboxes
        $(".edit_side_drawer input[type='checkbox']:checked").each(function() {
            selectedValues.push($(this).val());
        });

        // 🔹 Get all checked radios
        $(".edit_side_drawer input[type='radio']:checked").each(function() {
            selectedValues.push($(this).val());
        });

        // 🔹 Convert to JSON string
        let jsonData = JSON.stringify(selectedValues);

        // 🔹 Store JSON in hidden field (if you want to submit it)
        //$("#selectedData").val(jsonData);

        // 🔹 Optional: log it
        console.log("Selected JSON:", jsonData);

        

        let formData = new FormData($('#update_saved_searches')[0]);

        // Make sure you add the filters JSON
        formData.append('filters', jsonData);

        // Log all data before sending (to verify)
        for (let pair of formData.entries()) {
        console.log(pair[0] + ':', pair[1]);
        }

        if (isValid) {
            $.ajax({
                url: "{{ route('nurse.addSavedSearches') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                $('#drawer-save').prop('disabled', true).text('Processing...');
                },
                success: function(res) {
                if (res.status == '1') {
                    showToast("Search Updated Successfully");
                } else {
                    showToast(res.message);
                }
                $(".drawer-overlay, .edit_side_drawer").hide();
                },
                error: function(errorss) {
                $('#drawer-save').prop('disabled', false).text('Save Changes');
                console.log("errorss", errorss);
                }
            });
        }


        return false;
    }

    function showToast(msg, error = false) {
        const t = $('#toast');
        t.stop(true, true) // stop any ongoing animations
        .text(msg)
        .removeClass('error')
        .toggleClass('error', error)
        .css('opacity', '1')
        .fadeIn(200); // quick appear
        setTimeout(() => t.fadeOut(400), 2000);
    }
</script>