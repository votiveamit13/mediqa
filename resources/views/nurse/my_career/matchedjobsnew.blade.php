@extends('nurse.layouts.layout')
@section('css')

<style>
   /* Search bar */
   .search-bar {
   display: flex;
   gap: 10px;
   margin-bottom: 20px;
   }
   .search-bar input,
   .search-bar select,
   .search-bar button {
   padding: 10px;
   font-size: 14px;
   border: 1px solid #ccc;
   border-radius: 5px;
   }
   .search-bar input {
   flex: 2;
   }
   .search-bar select {
   flex: 1;
   }
   .search-bar button {
   background-color: black;
   color: white;
   border: none;
   cursor: pointer;
   }
   /* Layout */
   .content {
   display: flex;
   gap: 20px;
   }
   .filters {
   background: white;
   padding: 10px 10px;
   border-radius: 8px;
   box-shadow: 0 0 10px rgba(0,0,0,0.05);
   }
   .filter-sidebar {
   border: 1px solid #ccc;
   border-radius: 6px;
   font-family: Arial, sans-serif;
   background-color: #fff;
   overflow: hidden;
   }
   .filter-header {
   padding: 12px 16px;
   font-weight: bold;
   border-bottom: 1px solid #ccc;
   background-color: #f9f9f9;
   }
   .filter-list {
   list-style: none;
   margin: 0;
   padding: 0;
   }
   .filter-item {
   display: flex;
   justify-content: space-between;
   align-items: center;
   padding: 12px 16px;
   border-bottom: 1px solid #eee;
   cursor: pointer;
   font-size: 14px;
   }
   .filter-item:hover {
   background-color: #f0f0f0;
   }
   .arrow {
   font-size: 16px;
   color: #888;
   }
   .toggle {
   display: flex;
   align-items: center;
   margin: 15px 0;
   }
   .toggle input {
   margin-right: 10px;
   }
   .job-card {
   border: 1px solid #ddd;
   border-radius: 10px;
   padding: 16px;
   margin-bottom: 16px;
   background: #fff;
   box-shadow: 0 1px 3px rgba(0,0,0,0.05);
   }
   .job-card-header {
   display: flex;
   justify-content: space-between;
   align-items: start;
   }
   .job-company {
   display: flex;
   align-items: center;
   }
   .job-logo {
   width: 40px;
   height: 40px;
   background: #007bff;
   border-radius: 8px;
   color: white;
   display: flex;
   align-items: center;
   justify-content: center;
   margin-right: 10px;
   font-size: 20px;
   }
   .job-details .location {
   color: #555;
   font-size: 0.9rem;
   }
   .job-sort-dropdown select {
   font-size: 0.85rem;
   padding: 5px 8px;
   }
   .job-role {
   font-size: 1.1rem;
   font-weight: bold;
   margin-top: 12px;
   }
   .job-meta {
   display: flex;
   justify-content: space-between;
   font-size: 0.95rem;
   color: #555;
   margin-top: 4px;
   }
   .job-matches {
   display: flex;
   flex-wrap: wrap;
   gap: 10px;
   font-size: 0.85rem;
   color: #333;
   margin: 12px 0;
   }
   .dot {
   display: inline-block;
   width: 8px;
   height: 8px;
   border-radius: 50%;
   margin-right: 6px;
   }
   .dot.blue {
   background-color: #007bff;
   }
   .dot.grey {
   background-color: #ccc;
   }
   .job-footer {
   display: flex;
   justify-content: space-between;
   align-items: center;
   border-top: 1px solid #eee;
   padding-top: 10px;
   margin-top: 10px;
   }
   .match-score {
   font-weight: bold;
   color: #28a745;
   font-size: 0.95rem;
   }
   .apply-btn {
   background-color: black;
   color: white;
   border: none;
   padding: 6px 14px;
   border-radius: 6px;
   cursor: pointer;
   font-weight: 500;
   }
   .apply-btn:hover {
   background-color: #0056b3;
   }
   .apply-btn.applied {
   background: none;
   color: #28a745; /* green */
   font-weight: 600;
   display: flex;
   align-items: center;
   gap: 6px;
   border: none;
   cursor: default;
   padding: 0;
   }
   .apply-btn.applied::before {
   content: "✔"; /* check icon */
   font-weight: bold;
   }
   .search-bar label {
   font-size: 12px;
   margin-bottom: 4px;
   font-weight: 500;
   }
   .find_job_div{
   background: #f5f6fa;
   }
   .toggle-container {
   display: flex;
   align-items: center;
   margin-bottom: 20px;
   font-family: 'Segoe UI', sans-serif;
   }
   .toggle-label {
   font-weight: 500;
   }
   /* The switch - the box around the slider */
   .switch {
   position: relative;
   display: inline-block;
   width: 44px;
   height: 24px;
   }
   /* Hide default HTML checkbox */
   .switch input {
   opacity: 0;
   width: 0;
   height: 0;
   }
   /* The slider */
   .slider {
   position: absolute;
   cursor: pointer;
   background-color: #ccc;
   border-radius: 34px;
   top: 0;
   left: 0;
   right: 0;
   bottom: 0;
   transition: 0.4s;
   }
   /* Slider circle */
   .slider:before {
   position: absolute;
   content: "";
   height: 18px;
   width: 18px;
   left: 3px;
   bottom: 3px;
   background-color: white;
   transition: 0.4s;
   border-radius: 50%;
   }
   /* Checked background */
   .switch input:checked + .slider {
   background-color: black;
   }
   /* Checked position of the slider circle */
   .switch input:checked + .slider:before {
   transform: translateX(20px);
   }
   /* Rounded style */
   .slider.round {
   border-radius: 34px;
   }
   .modal-overlay {
   position: fixed;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background: rgba(0, 0, 0, 0.4);
   display: flex;
   justify-content: center;
   align-items: center;
   z-index: 999;
   }
   .modal-content {
   background: #fff;
   width: 50%;
   max-height: 90vh;
   border-radius: 8px;
   padding: 16px;
   overflow-y: auto;
   }
   .modal-header {
   display: flex;
   justify-content: space-between;
   align-items: center;
   }
   .modal-header h2 {
   margin: 0;
   font-size: 18px;
   }
   .modal-subtext {
   font-size: 0.9rem;
   color: #555;
   margin-bottom: 12px;
   }
   .close-btn {
   font-size: 20px;
   background: none;
   border: none;
   cursor: pointer;
   }
   .accordion-section {
   margin-bottom: 16px;
   }
   .accordion-header {
   display: flex;
   justify-content: space-between;
   align-items: center;
   cursor: pointer;
   background: #f7f7f7;
   padding: 8px;
   border-radius: 4px;
   }
   .accordion-content {
   margin-top: 8px;
   padding-left: 12px;
   }
   .accordion-content label {
   display: block;
   margin-bottom: 6px;
   font-size: 0.95rem;
   }
   .action-links {
   font-size: 0.85rem;
   color: #007bff;
   }
   .action-links a {
   margin-left: 4px;
   cursor: pointer;
   text-decoration: none;
   }
   .third-level{
   display:none;
   margin-left:20px;
   }
   .panel {
   width: 50%;
   padding: 10px;
   }
   .panel.left {
   border-right: 1px solid #ddd;
   }
   .panel.left, .panel.right {
   padding: 16px;
   overflow-y: auto;
   }
   .search-box {
   width: 100%;
   padding: 8px;
   margin: 10px 0;
   /* border: 1px solid #ccc; */
   border-radius: 6px;
   }
   .search-box input {
   width: 100%;
   padding: 6px;
   border: 1px solid #ccc;
   border-radius: 4px;
   }
   .list-item {
   padding: 8px;
   cursor: pointer;
   border-radius: 4px;
   }
   .list-item:hover {
   background-color: #f2f2f2;
   }
   .checkbox-list,.checkbox-list-spec {
   max-height: 60vh;
   overflow-y: auto;
   padding-right: 10px;
   }
   .checkbox-list label, .checkbox-list-spec label {
   display: flex;
   align-items: center;
   margin: 6px 0;
   }
   .checkbox-list input[type="checkbox"], .checkbox-list-spec input[type="checkbox"] {
   margin-right: 10px;
   }
   .modal-actions {
   margin-top: 15px;
   text-align: right;
   }
   .modal-actions button {
   padding: 8px 14px;
   margin-left: 10px;
   border: none;
   border-radius: 4px;
   cursor: pointer;
   }
   .cancel-btn {
   background-color: #f0f0f0;
   }
   .apply-btn {
   background-color: #1e293b;
   color: white;
   }
   .modal-header {
   font-weight: bold;
   margin-bottom: 10px;
   }
   .select-bar {
   display: flex;
   justify-content: space-between;
   font-size: 13px;
   margin-bottom: 5px;
   }
   .select-bar span {
   color: #1e293b;
   cursor: pointer;
   }
   .filter-item {
   list-style: none;
   border-bottom: 1px solid #ddd;
   padding: 12px 16px;
   }
   .filter-label {
   display: flex;
   justify-content: space-between;
   align-items: center;
   cursor: pointer;
   font-weight: 600;
   }
   .arrow {
   transition: transform 0.3s ease;
   }
   .arrow.rotated {
   transform: rotate(90deg);
   }
   .sector-options {
   display: none;
   margin-top: 10px;
   padding-left: 10px;
   }
   .sector-options label {
   display: block;
   margin-bottom: 8px;
   font-size: 14px;
   }
   .auto_fill_message{
   color:#28a745;
   display:none;
   }
   .auto_empty_message{
   color:#28a745;
   display:none;
   }
   .tooltip_preferences {
   background: #333;
   color: #fff;
   padding: 6px 10px;
   border-radius: 6px;
   font-size: 12px;
   white-space: nowrap;
   margin-left: 10px;
   display: none; /* hidden by default */
   }
   .btn-secondary {
   background-color: #f1f1f1;
   color: #333;
   border: 1px solid #ccc;
   }
   .urgent-tag {
   background: #000000ff; /* red */
   color: #fff;
   font-size: 12px;
   font-weight: bold;
   padding: 4px 10px;
   border-radius: 12px;
   height: fit-content;
   }
   .custom-multiselect {
   position: relative;
   width: 220px; /* same as other selects */
   }
   .select-box {
   background: #fff;
   border: 1px solid #ced4da;
   border-radius: 6px;
   padding: 6px 12px;
   cursor: pointer;
   font-size: 14px;
   line-height: 1.5;
   }
   .custom-multiselect .select-box::after {
   content: "▾";
   position: absolute;
   right: 2px;
   top: 50%;
   transform: translateY(-50%);
   pointer-events: none;
   color: #6c757d;
   font-size: 20px;
   }
   .checkbox-options {
   display: none;
   position: absolute;
   background: #fff;
   border: 1px solid #ced4da;
   border-radius: 6px;
   margin-top: 2px;
   padding: 8px;
   z-index: 1000;
   width: 100%;
   max-height: 200px;
   overflow-y: auto;
   box-shadow: 0 2px 6px rgba(0,0,0,0.15);
   }
   .checkbox-options label {
   display: flex;
   align-items: center;
   justify-content: flex-start;
   gap: 6px; /* spacing between checkbox & text */
   font-size: 14px;
   padding: 4px 8px;
   cursor: pointer;
   width: 100%;
   }
   .checkbox-options input[type="checkbox"] {
   margin: 0;
   width: 14px;
   height: 14px;
   accent-color: #0d6efd; /* Bootstrap primary color */
   }
   .checkbox-options input{
   flex:none;
   }
   .no-jobs-box {
   padding: 20px;
   margin: 15px 0;
   border: 2px dashed #ccc;
   border-radius: 8px;
   background: #fafafa;
   text-align: center;
   box-shadow: 0 2px 6px rgba(0,0,0,0.05);
   }
   .no-jobs-box h3 {
   margin: 0 0 10px;
   font-size: 18px;
   color: #444;
   }
   .no-jobs-box p {
   margin: 0;
   font-size: 14px;
   color: #777;
   }
   .last-date {
   font-size: 13px;
   font-weight: 500;
   color: #dc3545; /* red */
   margin-top: 4px;
   }
   .item {margin: 5px; padding: 10px; border: 1px solid #ccc; }
   .pagination { 
   margin-top: 20px;
   justify-content: center; 
   align-items: center; 
   gap: 6px; 
   }
   .pagination button {
   padding: 5px 10px;
   margin: 2px;
   border: 1px solid #333;
   cursor: pointer;
   background: #f2f2f2;
   }
   .pagination .active {
   background: #333;
   color: #fff;
   }
   .accordion-header .actions button {
   margin-left: 5px;
   padding: 2px 8px;
   font-size: 12px;
   border: 1px solid #ccc;
   background: #fff;
   cursor: pointer;
   border-radius: 4px;
   }
   .accordion-header .actions button:hover {
   background: #eee;
   }
   .form-group.top_filter.location_filter .select-box {
   background: #fff;
   border: 1px solid #ced4da;
   border-radius: 6px;
   padding: 8px 12px;
   cursor: pointer;
   font-size: 14px;
   line-height: inherit;
   height: 43px;
   color: #666666;
   }
   .top_filter.agency_filter select#agency {
   background: #fff;
   height: 43px;
   color: #666666;
   border: 1px solid #ced4da;
   }
   .top_filter.sort_by_filter select {
   background: #fff;
   height: 43px;
   color: #666666;
   border: 1px solid #ced4da;
   }
   .top_filter.keywords_filter {
   width: 35%;
   }
   .top_filter.keywords_filter input#keywords {
   background: #fff;
   height: 43px;
   color: #666666;
   border: 1px solid #ced4da;
   }
   .search-bar {
   display: flex;
   gap: 10px;
   margin-bottom: 20px;
   padding-right: 8px;
   margin-left: -10px;
   justify-content: space-between;
   }
   .job-card.item {
   margin-top: 0px;
   }
   .row.filters_jobs {
   margin-bottom: 40px;
   }
   .tag-badge {
   display: inline-flex;
   align-items: center;
   background-color: #e9f5ff;
   color: #0d6efd;
   padding: 6px 12px;
   border-radius: 20px;
   margin: 4px;
   font-size: 14px;
   font-weight: 500;
   }
   .tag-badge .remove-tag {
   margin-left: 8px;
   cursor: pointer;
   font-weight: bold;
   color: #0d6efd;
   }
   .tag-badge .remove-tag:hover {
   color: #dc3545; /* red on hover */
   }
   .edit-btns{
   background: #ffffffff;
   border: none;
   border-radius: 50%;
   width: 40px;
   height: 40px;
   cursor: pointer;
   display: flex;
   align-items: center;
   justify-content: center;
   transition: background 0.3s ease, transform 0.2s ease;
   }
   #saveSearchModal .modal-content{
   width:100%;
   }
</style>
@endsection
@section('content')
<main class="main find_job_div">
   <section class="section-box mt-30">
      <div class="container">
        <div class="find-jobs-header d-flex justify-content-between align-items-center mb-3">
            <h2 class="find-jobs-title mb-0 fw-bold">Matched Job Score</h2>
            
        </div>
        <div class="row">
            <div class="filters col-md-4">
                <div class="filter-sidebar">
                    <div class="filter-header">Filters</div>
                    <ul class="filter-list">
                        <li class="filter-item">
                        <label for="toggleRegisteredPreferences" class="toggle-label">
                            Use My Registered Preferences
                            <div class="auto_fill_message">Filters are Auto-filled from your preferences</div>
                            <div class="auto_empty_message">Filters are empty/default and not Auto-filled<br> from your preferences</div>
                        </label>
                        &nbsp;
                        <label class="switch">
                        <input type="checkbox" id="toggleRegisteredPreferences" checked>
                        <span class="slider round"></span>
                        </label>
                        </li>
                        <li class="filter-item">
                        <label for="toggleRegisteredPreferences" class="toggle-label">
                            Update My Preferences
                            <!-- <div class="tooltip_preferences" id="tooltipPref">
                                Temporary filtering, your current filter choices are not saved
                                </div> -->
                        </label>
                        &nbsp;
                        <label class="switch update_switch" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Your current filter choices are saved in your Work Preferences & Flexibility section. Your preferences are updated for future job matching">
                        <input type="checkbox" id="toggleUpdatePreferences">
                        <span class="slider round"></span>
                        </label>
                        </li>
                        <li class="filter-item" onclick="openSectorModal()">
                        <span>Sector</span>
                        <span class="arrow">›</span>
                        </li>
                        <li class="filter-item" onclick="openModal('Employment Type','employeement_type_preferences','sub_prefer_id','emp_prefer_id','emp_type')">
                        <span>Employment Type</span>
                        <span class="arrow">›</span>
                        </li>
                        <li class="filter-item" onclick="openModal_enviroment('Shift Type')">
                        <span>Shift Type</span>
                        <span class="arrow">›</span>
                        </li>
                        <li class="filter-item" onclick="openModal_enviroment('Work Environment')">
                        <span>Work Environment</span>
                        <span class="arrow">›</span>
                        </li>
                        <li class="filter-item" onclick="openModal('Position','employee_positions','subposition_id','position_id','position_name')">
                        <span>Position</span>
                        <span class="arrow">›</span>
                        </li>
                        <li class="filter-item" onclick="openModal('Benefits','benefits_preferences','subbenefit_id','benefits_id','benefits_name')">
                        <span>Benefits</span>
                        <span class="arrow">›</span>
                        </li>
                        <li class="filter-item" onclick="openLocationModel()">
                        <span>Location Preferences</span>
                        <span class="arrow">›</span>
                        </li>
                        <li class="filter-item" onclick="openNurseModal('Type of nurse')">
                        <span>Type of nurse</span>
                        <span class="arrow">›</span>
                        </li>
                        <li class="filter-item" onclick="openSpecialityModal('Speciality')">
                        <span>Specialty</span>
                        <span class="arrow">›</span>
                        </li>
                        <li class="filter-item" onclick="openYearExperienceModal()">
                        <span>Years of Experience</span>
                        <span class="arrow">›</span>
                        </li>
                        <!-- <li class="filter-item">
                        <span>Certifications</span>
                        <span class="arrow">›</span>
                        </li> -->
                        <li class="filter-item" onclick="openSalaryModal()">
                        <span>Salary Range</span>
                        <span class="arrow">›</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="job-listings col-md-8">
                    <div id="no-jobs" class="no-jobs-box" style="display:none;">
                      <h3>🚫 No Jobs Found</h3>
                      <p>Sorry, no jobs match your search.</p>
                    </div>
                    <div class="job-container match-grid">
                        @foreach($jobs as $job)
                            <!-- Card 1 -->
                            <div class="match-card">
                                @php
                                    $nurse_data = (array)json_decode($job->nurse_type);
                                    $nursearr = [];

                                    foreach($nurse_data as $ndata){
                                        
                                        $nurse_type = DB::table("practitioner_type")->where("id",$ndata)->first();
                                        
                                        $nursearr[] = $nurse_type->name ?? null;
                                    }
                                    //print_r($nursearr);
                                    $user = Auth::guard("nurse_middle")->user();
                                    $helper = new \App\Helpers\CustomHelper;
                                    $workPercent = $helper->matchWorkPercent($job,$user);
                                    $vaccinationRecordPercent = $helper->matchVaccinationRecord($job,$user);
                                    $clearacesPercent = $helper->matchclearacesPercent($job,$user);
                                    $eduCertPercent = $helper->matcheduCertPercent($job,$user);
                                    
                                    $total_match = $workPercent + $vaccinationRecordPercent + $clearacesPercent;
                                    //echo $found_sector;
                                    
                                @endphp
                                <h3 class="job-title">{{ $nursearr[0] }} – {{ $job->agency_name }}</h3>

                                <div class="match-row">
                                    <span>Type & Role</span>
                                    <span>0%</span>
                                </div>

                                <div class="match-row">
                                    <span>Specialties</span>
                                    <span>0%</span>
                                </div>

                                <div class="match-row">
                                    <span>Experience</span>
                                    <span>0%</span>
                                </div>

                                <div class="match-row">
                                    <span>Education</span>
                                    <span>5%</span>
                                </div>

                                <div class="match-row">
                                    <span>Vaccinations</span>
                                    <span>{{ $vaccinationRecordPercent }}%</span>
                                </div>

                                <div class="match-row">
                                    <span>Clearances</span>
                                    <span>{{ $clearacesPercent }}%</span>
                                </div>

                                <div class="match-row">
                                    <span>Preferences</span>
                                    <span>{{ $workPercent }}%</span>
                                </div>

                                <div class="total-score">Total Match Score: <span>{{ $total_match }}%</span></div>
                            </div>
                            @endforeach
                    </div>
                    <div class="pagination"></div>
                </div>
        </div>
        @include('nurse.job_modals')
      
      </div> 

    </section>  
</main>    
@endsection