@extends('nurse.layouts.layout')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ url('/public') }}/nurse/assets/css/jquery.ui.datepicker.monthyearpicker.css">
<link rel='stylesheet'
    href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<style>
    .loader {
        text-align: center;
        padding: 20px;
        font-size: 14px;
        color: #555;
    }
    .loader::after {
        content: "⏳ Loading nurses...";
        display: block;
        font-weight: bold;
    }
    #EditMoalOverlay {
    display: none; /* keep hidden until triggered */
    }
    .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    display: flex;
    justify-content: center; /* centers horizontally */
    align-items: center;     /* centers vertically */
    z-index: 99;
}
.modal-content {
    background: #fff;
    padding: 20px 30px;
    border-radius: 6px;
    width: 400px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    font-weight: bold;
    color: #000;
}

.close-modal {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
}

.modal-alert {
    background: #fff8e1;
    border: 1px solid #ffe082;
    padding: 10px;
    margin: 15px 0;
    font-size: 14px;
    color: #000;
}

.alert-icon {
    font-weight: bold;
    margin-right: 8px;
    color: #1976d2;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    font-weight: bold;
    color: #000;
}

.form-tip {
    font-size: 12px;
    color: #888;
}

.modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.btn-cancel {
    background: #fff;
    border: 1px solid #000;
    padding: 6px 12px;
    cursor: pointer;
}

.btn-save {
    background: #000;
    color: #fff;
    border: none;
    padding: 6px 12px;
    cursor: pointer;
}
      /* match circle  */
  .match-circle {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 85px;
    height: 85px;
    border-radius: 50%;
    background: conic-gradient(#16A34A calc(var(--percent) * 1%),
        #9CA3AF 0);
    display: flex;
    align-items: center;
    justify-content: center;
    /* position: relative; */
  }

  .match-inner {
    width: 70px;
    height: 70px;
    background: white;
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .match-inner .percent {
    font-size: 20px;
    font-weight: bold;
    color: #16A34A;
  }

  .match-inner .label {
    font-size: 12px;
    color: #16A34A;
  }
.pagination-wrapper .page-item.active .page-link {
    background-color: #000000ff;
    border-color: #000000ff;
    border-radius: 10px;
}

.pagination-wrapper .page-link {
    color: #000000ff;
}

.pagination-wrapper .page-item .page-link {
    border-radius: 10px;
}

.pagination-wrapper .pagination .active {
    background: #000000ff;
    border-radius: 10px;

}

.front-pagination {
    align-items: center;
}

/* ================= Job Tab ================= */

.find_job_div {
    background: #f5f6fa;
}

.no-jobs-box {
    padding: 20px;
    margin: 15px 0;
    border: 2px dashed #ccc;
    border-radius: 8px;
    background: #fafafa;
    text-align: center;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

.no-jobs-box h3 {
    margin: 0 0 10px;
    font-size: 18px;
    color: #444;
}

/* ================= FILTER BAR ================= */

.search-bar {
    /* display: flex; */
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 4 equal columns */
    gap: 14px;
    align-items: center;
    margin-top: 15px;
}
.search-bar .form-group {
    display: flex;
    flex-direction: column;
    width: 100%;
}

/* Dropdown + input fields */
.search-bar select,
.search-bar input {
    width: 100%; /* important */
    height: 44px;
    min-width: 223px;
    padding: 0 14px;
    font-size: 14px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    background: #f9fafb;
    color: #374151;
    outline: none;
    transition: all 0.2s ease;
}

/* Focus effect */
.search-bar select:focus,
.search-bar input:focus {
    border-color: #3b82f6;
    background: #ffffff;
}

/* Sort dropdown slightly smaller */
.sort_by_filter select {
    min-width: 160px;
}

/* ================= BUTTONS ================= */

#add-search-btn {
    background: #000;
    color: #fff;
    border: none;
    height: 42px;
    padding: 0 18px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
}

#add-search-btn:hover {
    background: #1f2937;
}

/* Top Matches Button */
.search-bar button {
    background: #000;
    color: #fff;
    border: none;
    height: 42px;
    padding: 0 18px;
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
}

/* ================= CONTAINER ALIGNMENT ================= */

.find-jobs-header {
    margin-bottom: 15px;
}

.find-jobs-title {
    font-size: 24px;
    font-weight: 700;
}

/* ================= TABS ================= */

.searchtabs {
    display: flex;
    align-items: center;
    /* remove space-between to avoid pushing right button off */
    gap: 10px;
    overflow: hidden;
    /* prevent parent from creating its own scrollbar */
}

.centered-filter {
    flex: 1;
    /* take up remaining space */
    display: flex;
    overflow-x: auto;
    /* only this section scrolls */
    gap: 10px;
    white-space: nowrap;
    /* keep tabs in one line */
    scrollbar-width: thin;
    /* Firefox */
}

.saved-search-tab {
    background: #f1f3f5;
    padding: 8px 16px;
    border-radius: 20px;
    cursor: pointer;
    font-size: 14px;
    flex-shrink: 0;
    /* prevent shrinking */
}

.saved-add-search {
    background: #e0f2fe;
    color: #0369a1;
    border: 1px dashed #7dd3fc;
    border-radius: 20px;
    padding: 6px 14px;
    flex-shrink: 0;
    /* keep fixed size */
}

/* ================= FILTER SIDEBAR ================= */

.filter-sidebar {
    border: 1px solid #ccc;
    border-radius: 6px;
    background: #fff;
}

.filter-header {
    padding: 12px;
    font-weight: bold;
    border-bottom: 1px solid #ddd;
}

.filter-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.filter-item {
    padding: 12px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    cursor: pointer;
}

/* ================= CARD ================= */

.candidate-card {
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #ccc;
    margin-bottom: 20px;
}

.profile-img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
}

.name {
    font-size: 18px;
    font-weight: 700;
}

.sub-text {
    font-size: 14px;
    /* color: #777; */
}

/* ================= TAG ================= */

.job-tag {
    background: #f1f3f5;
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 600;
}

/* ================= BUTTON ================= */

.btn-custom {
    background: #000;
    color: #fff;
    /* border-radius: 6px;
    padding: 8px 16px; */
}

.btn-custom:hover {
    color: #fff;
}

/* ================= PROGRESS ================= */

.progress-circle {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: conic-gradient(#28a745 0% 95%, #e6e6e6 95% 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.progress-circle::before {
    content: "";
    width: 70px;
    height: 70px;
    background: #fff;
    border-radius: 50%;
    position: absolute;
}

.progress-text {
    position: absolute;
    text-align: center;
}

.progress-text h5 {
    margin: 0;
    font-weight: 700;
    color: #28a745;
}

.progress-text span {
    font-size: 12px;
    color: #777;
}

/* ================= JOB CARD ================= */

.job-card {
    border: 1px solid #E5E7EB;
    border-radius: 10px;
    padding: 16px;
    margin-bottom: 24px;
    background: #fff;
}

.job-logo {
    width: 48px;
    height: 48px;
    background: #007bff;
    border-radius: 8px;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
}

.job-footer {
    display: flex;
    justify-content: flex-end;
    border-top: 1px solid #eee;
    padding-top: 10px;
}

.apply-btn {
    background: #3C8093;
    color: #fff;
    padding: 8px 18px;
    border-radius: 6px;
    border: none;
}

.details-link {
    color: #0EA5E9;
    text-decoration: none;
    font-size: 14px;
}

/* ================= MATCH CIRCLE ================= */

.match-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: conic-gradient(#16A34A calc(var(--percent)*1%), #9CA3AF 0);
    display: flex;
    align-items: center;
    justify-content: center;
}

.match-inner {
    width: 65px;
    height: 65px;
    background: #fff;
    border-radius: 50%;
    text-align: center;
}

.match-inner .percent {
    font-size: 18px;
    font-weight: bold;
    color: #16A34A;
}

.match-inner .label {
    font-size: 12px;
}

.border-color {
    border-top: 1px solid #eee;
    padding-top: 16px;
}

.status-list {
    padding: 16px;
}

/* 1/4  */
/* Container */
.ss-wrapper {
    background: #fff;
    border-radius: 12px;
    padding: 20px 0;
    /* border: 1px solid #e6ecf2; */
}

/* Header */
.ss-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.ss-title {
    font-weight: 600;
    font-size: 18px;
}

/* .ss-delete-btn {
    background: #e63946;
    color: #fff;
    border-radius: 6px;
    padding: 6px 14px;
    font-size: 13px;
    border: none;
} */

/* Table */
.ss-table {
    width: 100%;
    /* border-collapse: separate; */
    border-spacing: 0 8px;
    border: 1px solid #e6ecf2;
}

.ss-table thead th {
    /* font-size: 13px; */
    /* color: #6b7280; */
    border: none;
    padding: 10px 16px;
    white-space: nowrap;
}

.ss-table thead {
    border: 1px solid #e6ecf2;
}

/* .ss-row {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    transition: 0.2s;
} */

.ss-row:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
}

/* Cells */
.ss-table td {
    padding: 12px 16px;
    vertical-align: middle;
    border-top: none;
}

/* Name */
.ss-name {
    font-weight: 500;
    color: #111827;
}

/* Type */
.ss-type {
    color: #6b7280;
    font-size: 13px;
}

/* Match badge */
.ss-match {
    background: #e0f2fe;
    color: #0284c7;
    border-radius: 50px;
    padding: 4px 10px;
    font-size: 12px;
}

/* Alert badge */
.ss-alert {
    background: #dcfce7;
    color: #16a34a;
    font-size: 12px;
    padding: 4px 10px;
    border-radius: 50px;
}

/* Toggle */
.ss-toggle {
    width: 36px;
    height: 20px;
    background: #22c55e;
    border-radius: 50px;
    position: relative;
    display: inline-block;
}

.ss-toggle::after {
    content: "";
    width: 16px;
    height: 16px;
    background: #fff;
    border-radius: 50%;
    position: absolute;
    top: 2px;
    right: 2px;
}

/* Actions */
.ss-actions .btn {
    font-size: 12px;
    padding: 4px 10px;
    border-radius: 6px;
}

.ss-run {
    background: #f1f5f9;
}

.ss-edit {
    background: #dbeafe;
    color: #1d4ed8;
}

.ss-duplicate {
    background: #fef9c3;
    color: #854d0e;
}

.ss-delete {
    background: #fee2e2;
    color: #991b1b;
    padding: 13px;
}

/* Checkbox */
.ss-checkbox {
    transform: scale(1.2);
}

/* Read more */
.ss-read {
    font-size: 12px;
    color: #2563eb;
}

.candidate-card p {
    color: #000;
}

.bg-delete-selected {
    background: #e63946;
    color: #fff;
    border: 1px solid #e63946;
    transition: all ease-in-out .3s;
    font-weight: 600;
}

.bg-delete-selected:hover {
    background: #fff;
    color: #e63946;
    border: 1px solid #e63946
}

.border-top {
    border-top: 1px solid #eee !important;
    padding: 16px 0 0;
}
@media (max-width: 1024px) {
    .search-bar {
        grid-template-columns: repeat(2, 1fr); /* 2 per row */
    }
}

@media (max-width: 640px) {
    .search-bar {
        grid-template-columns: 1fr; /* 1 per row */
    }
}
</style>
@endsection
@section('content')
<main class="main find_job_div">
    <section class="section-box mt-30">
        <div class="container">
            <div class="saved-searches-row" id="search-tabs">
                <div class="searchtabs">
                    <!-- Fixed left tab -->
                    <div class="saved-search-tab" id="browse_all">
                        Browse All Nurse
                    </div>
                    @if(count($jobs) <= 0) 
                    <div id="no-job-post-hf" class="saved-search-tab" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="You don’t have active job postings yet.">
                        Post a Job
                    </div>
                     @endif
                    <!-- Scrollable center -->
                    <div class="centered-filter">
                        @forelse ($jobs as $job)
                        <div class="saved-search-tab" data-id="{{ $job->job_box_id }}">
                            {{ $job->job_box_id }}
                        </div> 
                        @empty   
                        @endforelse
                        @forelse ($list_saved_searches as $manage_list)
                        <div class="saved-search-tab" data-id="{{ $manage_list->id }}">
                            {{ $manage_list->name }}
                        </div> 
                        @empty   
                        @endforelse           
                    </div>          
                    <!-- Fixed right button -->
                    <div class="add-new">
                        <button class="saved-add-search">+ Save New</button>
                    </div>
                </div>
            </div>
         @include('healthcare.find_nurse.modal_saved_searches')
        <div>
            <div class="job_tabs">
                <ul class="tab-nav">
                    <li class="active" data-tab="tab1">Find Nurse</li>
                    <li data-tab="tab2">Manage Saved Searches</li>
                </ul>
            </div>
            <div id="tab1" class="tab-content-jobs active">
                <div class="find-jobs-header d-flex justify-content-between align-items-center mb-3">
                    <h2 class="find-jobs-title mb-0 fw-bold">Find Nurse</h2>
                    {{-- <button id="add-search-btn">+ Save Search</button> --}}
                </div>
                <div class="search-bar">

                    <div class="form-group top_filter location_filter">
                        <label for="job_start">Role / Speciality</label>
                        <input type="text" id="role_speciality" placeholder="Search by Nurse type or Speciality">
                    </div>
                    <div class="form-group top_filter location_filter">
                        <label for="job_start">Available to Start</label>
                        <select id="available_to_start" name="available_to_start" class="form-control">
                            <option value="" selected>Any (default)</option>
                            <option value="2">Same-day (Instant Connect)</option>
                            <option value="3">Within 48h (Last Minute)</option>
                            <option value="4">Within 7 Days (Immediate Start)</option>
                            <option value="5">Within 2 Weeks</option>
                            <option value="6">Within 5 Weeks</option>
                            <option value="7">Within 7 Weeks</option>
                        </select>
                    </div>

                    <!-- <input type="hidden" id="selectedLocations" name="locations"> -->
                    <div class="form-group top_filter location_filter">
                        <label for="sort">Search Nurse</label>
                        <input type="text" id="nurse_registration" placeholder="Search by Name or Registration Number">
                    </div>
                    <div class="form-group top_filter location_filter">
                        <label for="sort_by">Sort By</label>
                        <select id="sort_by" name="sort_by" class="form-control">
                            <option value="highest_experience">Highest Experience</option>
                            <option value="top_matches">Top Matches</option>
                            <option value="available_soonest">Available Soonest</option>
                        </select>
                    </div>
                    <!-- <div class="top_filter sort_by_filter"> -->
                    {{-- <button class="form-group top_filter location_filter" id="add-search-btn">Top Matches</button> --}}
                    <!-- </div> -->
                </div>
                <div class="row">
                    <div class="filters col-md-4">
                        <div class="filter-sidebar">
                            <div class="filter-header">Filters</div>
                            <ul class="filter-list">
                                <li class="filter-item nurse-type-modal">
                                    <span>Type of Nurse</span>
                                    <span class="arrow">›</span>
                                </li>
                                <li class="filter-item view-speciality-modal" data-id="1">
                                    <span>Specialty</span>
                                    <span class="arrow">›</span>
                                </li>
                                <li class="filter-item view-work-environment-details" data-id="2">
                                    <span>Work Environment</span>
                                    <span class="arrow">›</span>
                                </li>
                                <li class="filter-item" id="yearOfExpBtn">
                                    <span>Years of Experience</span>
                                    <span class="arrow">›</span>
                                </li>
                                <li class="filter-item">
                                    <span>Compliance status</span>
                                    <span class="arrow">›</span>
                                </li>
                                <li class="filter-item view-employeement-type">
                                    <span>Employment Type</span>
                                    <span class="arrow">›</span>
                                </li>
                                <li class="filter-item shift-type-modal">
                                    <span>Shift Type</span>
                                    <span class="arrow">›</span>
                                </li>
                                <li class="filter-item">
                                    <span>Salary Expectations </span>
                                    <span class="arrow">›</span>
                                </li>
                                <li class="filter-item">
                                    <span>Education </span>
                                    <span class="arrow">›</span>
                                </li>
                                <li class="filter-item">
                                    <span>Registration & Licences </span>
                                    <span class="arrow">›</span>
                                </li>
                                <li class="filter-item" id="checksClearanceBtn">
                                    <span>Checks & Clearances</span>
                                    <span class="arrow">›</span>
                                </li>
                                 <li class="filter-item view-certification">
                                    <span>Certifications </span>
                                    <span class="arrow">›</span>
                                </li>
                                 <li class="filter-item language-modal">
                                    <span>Language </span>
                                    <span class="arrow">›</span>
                                </li>
                                 <li class="filter-item">
                                    <span>Location Preferences  </span>
                                    <span class="arrow">›</span>
                                </li>
                                 <li class="filter-item">
                                    <span>Residency/work Status </span>
                                    <span class="arrow">›</span>
                                </li>
                                 <li class="filter-item">
                                    <span>International hiring </span>
                                    <span class="arrow">›</span>
                                </li>
                            </ul>
                        </div>
                        <div id="modalContainer"></div>
                    </div>

                <!-- Add Filters Modal  -->

                <!-- Checks & Clearances Modal -->
              <div class="modal fade" id="checksModal" tabindex="-1">
                <div class="modal-dialog modal-bottom">
                    <div class="modal-content">                
                    <div class="modal-header">
                        <h5 class="modal-title">Checks & Clearances</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label class="mb-2">Select Checks</label>
                        <ul id="checks_filter" class="list-unstyled">
                        <li class="mb-2">
                            <label class="d-flex align-items-center">
                            <input type="checkbox" name="checks[]" value="ndis" class="me-2">
                            NDIS Worker Screening Check
                            </label>
                        </li>
                        <li class="mb-2">
                            <label class="d-flex align-items-center">
                            <input type="checkbox" name="checks[]" value="wwcc" class="me-2">
                            Working With Children Check (WWCC)
                            </label>
                        </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="applyChecks">
                            Apply
                        </button>
                    </div>
                    </div>
                 </div>
              </div>
                     
                <!-- Year of Experience -->
              <div class="modal fade" id="yearExperienceModal" tabindex="-1">
                <div class="modal-dialog modal-bottom">
                    <div class="modal-content">                
                    <div class="modal-header">
                        <h5 class="modal-title">Years of Experience</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <select class="form-control assistent_level" name="assistent_level">
                            <option value="">Please Select</option>
                            @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}" @if(!empty($user_data) && $user_data->assistent_level == $i) selected @endif>{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                            @endfor
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="applyYearExp">
                            Apply
                        </button>
                    </div>
                    </div>
                 </div>
              </div>

                    <!-- Job Listings -->
                    <div class="job-listings col-md-8 normal-pagination">
                        @forelse($nurse_list as $list)
                        <div class="candidate-card">
                            <!-- TOP -->
                            <div class="d-flex justify-content-between mb-2">
                                <div class="d-flex gap-3">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg"
                                        class="profile-img mr-3">
                                    <div>
                                        <div class="name">{{$list->name}} {{$list->lastname}}</div>
                                        <div class="sub-text">
                                            <i class="fa fa-map-marker"></i> Los Angeles,
                                            {{ country_name($list->country) }}
                                        </div>
                                        <div class="sub-text mt-1">
                                            <i class="fa fa-briefcase"></i> 15 yrs Exp · ICU · ACLS, BLS
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <i class="fa fa-heart-o" style="font-size:20px;"></i>
                                </div>
                            </div>
                            <!-- <hr> -->
                            <!-- JOB TAG -->
                            <div class="d-flex justify-content-between align-items-center border-top">
                                <div>
                                    <span class="job-tag">
                                        <i class="fa fa-briefcase"></i> ICU RN · MQ-01425
                                    </span>
                                    <span class="ml-2 btn btn-light btn-sm">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                </div>
                            </div>
                            <!-- <hr> -->
                            <!-- STATUS -->
                            <div class="row">
                                <div class="col-md-10 status-list">
                                    <p><i class="fa fa-check text-success"></i> <strong>Compliance:</strong> Verified
                                    </p>
                                    <p><i class="fa fa-check text-success"></i> <strong> Vaccinated:</strong> Up to Date
                                    </p>
                                    <p><i class="fa fa-check text-success"></i> <strong> Availability: </strong> Within
                                        48h (Last
                                        Minute)</p>
                                </div>
                                 @if(!empty($list->match_percentage) && $list->match_percentage > 0)
                                <div class="col-md-2">
                                    <!-- PROGRESS -->                            
                                    <div class="match-circle progress-circle" data-value="{{ $list->match_percentage }}">
                                        <div class="match-inner progress-text">
                                            <div class="percent">{{ round($list->match_percentage) }}%</div>
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
                                @endif
                            </div>
                            <!-- <hr> -->
                            <!-- BUTTONS -->
                            <div class="d-flex gap-4 justify-content-end border-top">
                                <button class="btn btn-custom mr-2" >
                                    <i class="fa fa-user"></i> Invite to Apply
                                </button>
                                <button class="btn btn-custom" >
                                    <i class="fa fa-comments" ></i> Invite to Interview
                                </button>
                            </div>
                        </div>
                        @empty
                        <div id="no-jobs" class="no-jobs-box">
                            <h3>🚫 No Nurse Found</h3>
                            <p>Sorry, no nurses match your search.</p>
                        </div>
                        @endforelse
                        <div class="pagination-wrapper front-pagination">
                            {{ $nurse_list->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                    <div class="job-listings col-md-8 ajax-pagination d-none"></div>
                </div>
            </div>
        </div>

        <div id="tab2" class="tab-content-jobs">

            <div class="container mt-5">

                <div class="ss-wrapper">

                    <!-- Header -->
                    <div class="ss-header">
                        <div class="ss-title">Manage Saved Searches</div>
                        <!-- <a href='#'>
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a> -->
                        <button class="btn ss-delete bg-delete-selected" id="deleteSelected">
                            <!-- <i class="fi fi-rr-trash mr-1"></i> -->
                            Delete Selected
                        </button>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table  id="savedSearchTable" class="ss-table border">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll" class="ss-checkbox"></th>
                                    <th>Name</th>
                                    <!-- <th>Search Type</th> -->
                                    <th>Filters Summary</th>
                                    <th>Matches Count</th>
                                    <!-- <th>Alert</th> -->
                                    <th>Created</th>
                                    <th>Last Run</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                                @php
                                 $i = 1;
                                @endphp
                            <tbody>

                                @forelse($list_saved_searches as $search_list)
                             
                                <!-- Row -->
                                <tr data-id="{{ $i }}" data-name="{{ $search_list->id }}" class="ss-row">
                                    <td><input type="checkbox" class="ss-checkbox select-item"></td>
                                    <td class="ss-name">{{ucfirst($search_list->name)}}</td>
                                    <td class="ss-type">Read more</td>
                                    <td><span class="ss-match">0</span></td>
                                    @php
                                      $dateOnly = date('Y-m-d', strtotime($search_list->created_at));
                                    @endphp
                                    <td>{{$dateOnly}}</td>
                                    <!-- <td><span class="ss-alert">Realtime</span></td> -->
                                    <td>-</td>
                                    <td class="ss-actions">
                                        <button class="btn ss-run">
                                            Run
                                        </button>
                                        <button class="btn ss-edit" id="SearchEditBtn">
                                            Edit
                                        </button>
                                        <button class="btn ss-duplicate btn-duplicate">
                                            Duplicate
                                        </button>
                                        <button  class="btn ss-delete btn-delete" data-name="single-delete">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No Record Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- edit filter saved search -->
                    <div id="EditMoalOverlay"  class="modal-overlay">
                        <div id="verticalFilterModal" class="side-modal">
                            <div class="side-modal-content">
                                <div class="modal-header">
                                    <h3>Edit Filter</h3>
                                    <span class="close-btn" id="closeEditFilterType" data-close="verticalFilterModal">&times;</span>
                                </div>
                                <div id="editTypeBody" class="modal-body">
                                    <div id="layer-0" class="layer" style="display:block;">
                                    <ul class="filter-list">
                                        <li class="filter-item edit-nurse-type">
                                            <span>Type of Nurse</span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item" data-id="1">
                                            <span>Specialty</span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item" data-id="2">
                                            <span>Work Environment</span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item" >
                                            <span>Years of Experience</span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item">
                                            <span>Compliance status</span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item">
                                            <span>Employment Type</span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item">
                                            <span>Shift Type</span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item">
                                            <span>Salary Expectations </span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item">
                                            <span>Education </span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item">
                                            <span>Registration & Licences </span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item">
                                            <span>Checks & Clearances</span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item">
                                            <span>Certifications </span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item">
                                            <span>Language </span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item">
                                            <span>Location Preferences  </span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item">
                                            <span>Residency/work Status </span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item">
                                            <span>International hiring </span>
                                            <span class="arrow">›</span>
                                        </li>
                                    </ul>
                                    </div>
                                </div>
                                <div id="editmodalContainer"></div> 
                                <div class="modal-footer">
                                    <button type="button" id="closeEditFilterType" class="btn btn-default"> Cancel </button>
                                    <button type="button" onclick="applyEditType()" class="btn btn-default"> Apply </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    </section>
</main>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script src="{{ url('/public') }}/nurse/assets/js/jquery.ui.datepicker.monthyearpicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

</script>
<script>
    $(document).on('click', '.ss-edit', function () {
        $('#EditMoalOverlay').show();
        $('#verticalFilterModal').show();
    });
    $(document).on('click', '#closeEditFilterType', function () {
        $('#EditMoalOverlay').hide();
        $('#verticalFilterModal').hide();
    });

    $(document).on('click', '#backToEditFilter', function () {
        // Hide nurse modal
        $('#nurseTypeModal').hide();
        $('#nursemodalOverlay').removeClass('modal-overlay');


        // Show the main Edit Filter modal again
        $('#verticalFilterModal').show();
    });


    $(document).on('click', '.edit-nurse-type', function () {

        let $btn = $(this); 
        $btn.css('pointer-events', 'none'); // disable click

        $('#modalContainer').empty();

        let applicationId = $btn.data('id');
        let modal = '#nurseTypeModal';

        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/nurse_type_edit') }}",
            type: "GET",
            data: { application_id: applicationId, modal_no: 1 },

            success: function (response) {

                $('#editmodalContainer').html(response);

                $(modal).fadeIn(); // since it's a custom side modal

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
            }
        });
    });

</script>
<script>
    $('#yearOfExpBtn').on('click', function () {
       $('#yearExperienceModal').modal('show');
    });

    $('#applyYearExp').on('click', function () {
        // Get selected year of experience
        let selectedYearExp = $('select[name="assistent_level"]').val();

        // Retrieve existing filters from sessionStorage
        var filter_data = sessionStorage.getItem("filters_data");
        var filters_data = filter_data ? JSON.parse(filter_data) : {};

        // Save year of experience into filters_data
        filters_data.year_experience = selectedYearExp;

        // Update sessionStorage
        sessionStorage.setItem('filters_data', JSON.stringify(filters_data));

        // Close modal
        $('#yearExperienceModal').modal('hide');

        // Call API / function
        fetchNurse();
    });


</script>
<script>
    $('#checksClearanceBtn').on('click', function () {
       $('#checksModal').modal('show');
    });

    $('#applyChecks').on('click', function () {
        let selectedChecks = [];
        // Get all checked values
        $('input[name="checks[]"]:checked').each(function () {
            selectedChecks.push($(this).val());
        });

        var filter_data = sessionStorage.getItem("filters_data");
        var filters_data = filter_data ? JSON.parse(filter_data) : {};

        filters_data.check_clearance = selectedChecks;
      
        sessionStorage.setItem('filters_data', JSON.stringify(filters_data));

        // Close modal
        $('#checksModal').modal('hide');

        // Call API / function
        fetchNurse();
    });
</script>
<script>
    function initLanguageSelect2() {
        $('.js-example-basic-multiple').each(function() {
            let listId = $(this).data('list-id');
            let items = [];
            $('#' + listId + ' li').each(function() {
                items.push({ id: $(this).data('value'), text: $(this).text() });
            });
            $(this).empty().select2({ data: items });
        });

        // Attach custom buttons/events again
        $('.js-example-basic-multiple').on('select2:open', function() {
            // same logic for search box and select/remove all buttons
        });
    }

        $(document).on('click', '.language-modal', function () {

        let $btn = $(this); 
        $btn.css('pointer-events', 'none'); // disable click

        $('#modalContainer').empty();
        let modal = '#shiftTypeModal';

        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/language_list') }}",
            type: "GET",
            data: { modal_no: 13 },

            success: function (response) {

                $('#modalContainer').html(response);

                $(modal).fadeIn(); // since it's a custom side modal
                initLanguageSelect2()
                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();

            }
        });
    });
</script>
<script>
    $(document).on('click', '.shift-type-modal', function () {

        let $btn = $(this); 
        $btn.css('pointer-events', 'none'); // disable click

        $('#modalContainer').empty();

        let applicationId = $btn.data('id');
        let modal = '#shiftTypeModal';

        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/shiftType_list') }}",
            type: "GET",
            data: { application_id: applicationId, modal_no: 7 },

            success: function (response) {

                $('#modalContainer').html(response);

                $(modal).fadeIn(); // since it's a custom side modal

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
                syncShiftTypeSelections();
            }
        });
    });
    function syncShiftTypeSelections() {
        // Get saved filters from sessionStorage
        var filter_data = sessionStorage.getItem("filters_data");
        var filters_data = filter_data ? JSON.parse(filter_data) : {};

        let savedValues = filters_data.shiftType || [];

        // Loop through all checkboxes and set checked state
        $(".shiftType-checkbox").each(function () {
            let val = $(this).val();
            if (savedValues.includes(val)) {
                $(this).prop("checked", true);
            } else {
                $(this).prop("checked", false);
            }
        });
    }

</script>
<script>
    $(document).on('click', '.nurse-type-modal', function () {

        let $btn = $(this); 
        $btn.css('pointer-events', 'none'); // disable click

        $('#modalContainer').empty();

        let applicationId = $btn.data('id');
        let modal = '#nurseTypeModal';

        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/nurseType_list') }}",
            type: "GET",
            data: { application_id: applicationId, modal_no: 1 },

            success: function (response) {

                $('#modalContainer').html(response);

                $(modal).fadeIn(); // since it's a custom side modal

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
                syncNurseTypeSelections();
            }
        });
    });
    function syncNurseTypeSelections() {
        // Get saved filters from sessionStorage
        var filter_data = sessionStorage.getItem("filters_data");
        var filters_data = filter_data ? JSON.parse(filter_data) : {};

        let savedValues = filters_data.nurseType || [];

        // Loop through all checkboxes and set checked state
        $(".nurseType-checkbox").each(function () {
            let val = $(this).val();
            if (savedValues.includes(val)) {
                $(this).prop("checked", true);
            } else {
                $(this).prop("checked", false);
            }
        });
    }

</script>
<script>
    $(document).on('click', '.view-speciality-modal', function () {

        let $btn = $(this); 
        $btn.css('pointer-events', 'none'); // disable click

        $('#modalContainer').empty();
        let modal = '#specialityModal';

        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/speciality_list') }}",
            type: "GET",
            data: { modal_no: 2 },

            success: function (response) {

                $('#modalContainer').html(response);

                $(modal).fadeIn(); // since it's a custom side modal

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
            }
        });
    });

</script>
<script>
    $(document).on('click', '.view-work-environment-details', function () {

        let $btn = $(this); 
        $btn.css('pointer-events', 'none'); // disable click

        $('#modalContainer').empty();

        let applicationId = $btn.data('id');
        let modal = '#work_environment_modal';

        $('#globalLoader').show();
        
        $.ajax({
            url: "{{ url('/healthcare-facilities/work_environment_list') }}",
            type: "GET",
            data: { application_id: applicationId, modal_no: 3 },

            success: function (response) {

                $('#modalContainer').html(response);

                $(modal).fadeIn(); // since it's a custom side modal

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
            }
        });
    });
</script>
<script>
    $(document).on('click', '.view-employeement-type', function () {

        let $btn = $(this); 
        $btn.css('pointer-events', 'none'); // disable click

        $('#modalContainer').empty();

        let applicationId = $btn.data('id');
        let modal = '#employeement_type_modal';

        $('#globalLoader').show();
        
        $.ajax({
            url: "{{ url('/healthcare-facilities/employeement_type_list') }}",
            type: "GET",
            data: { application_id: applicationId, modal_no: 6 },

            success: function (response) {

                $('#modalContainer').html(response);

                $(modal).fadeIn(); // since it's a custom side modal

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
                syncEmploymentTypeSelections();
            }
        });
    });
    
    function syncEmploymentTypeSelections() {
        //alert("hello");
        // Get saved filters from sessionStorage
        var filter_data = sessionStorage.getItem("filters_data");
        var filters_data = filter_data ? JSON.parse(filter_data) : {};

        let savedValues = filters_data.employment_type || [];
        console.log("savedValues",savedValues);    
        // Loop through all checkboxes and set checked state
        $(".employeement_type_checkbox").each(function () {
            let val = $(this).val();
            if (savedValues.includes(val)) {
                $(this).prop("checked", true);
            } else {
                $(this).prop("checked", false);
            }
        });
    }
</script> 
<script>
    $(document).on('click', '.view-certification', function () {

        let $btn = $(this); 
        $btn.css('pointer-events', 'none'); // disable click

        $('#modalContainer').empty();

        
        let modal = '#certification_modal';

        $('#globalLoader').show();
        
        $.ajax({
            url: "{{ url('/healthcare-facilities/certification_list') }}",
            type: "GET",
            data: { modal_no: 12 },

            success: function (response) {

                $('#modalContainer').html(response);

                $(modal).fadeIn(); // since it's a custom side modal

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
                //syncEmploymentTypeSelections();
            }
        });
    });
    
    function syncEmploymentTypeSelections() {
        //alert("hello");
        // Get saved filters from sessionStorage
        var filter_data = sessionStorage.getItem("filters_data");
        var filters_data = filter_data ? JSON.parse(filter_data) : {};

        let savedValues = filters_data.employment_type || [];
        console.log("savedValues",savedValues);    
        // Loop through all checkboxes and set checked state
        $(".employeement_type_checkbox").each(function () {
            let val = $(this).val();
            if (savedValues.includes(val)) {
                $(this).prop("checked", true);
            } else {
                $(this).prop("checked", false);
            }
        });
    }
</script>        
<script>
$(document).ready(function() {
    $('.tab-nav li').click(function() {
        // Remove active classes
        $('.tab-nav li').removeClass('active');
        $('.tab-content-jobs').removeClass('active');
        // Add active class to clicked tab and corresponding content
        $(this).addClass('active');
        $('#' + $(this).data('tab')).addClass('active');
    });
    $('.tab-nav-edit li').click(function() {
        // Remove active classes
        $('.tab-nav-edit li').removeClass('active');
        $('.tab-content-edit').removeClass('active');
        // Add active class to clicked tab and corresponding content
        $(this).addClass('active');
        $('#' + $(this).data('tab')).addClass('active');
    });
});
</script>
<script>
    $(document).on('click', '.saved-search-tab', function() {
      if (!$(this).hasClass('add-new')) {
        $('.saved-search-tab').removeClass('active');
        $(this).addClass('active');
        $('#active-search-name').text($(this).text().trim());
      }
    });

    $(document).on('click', '#browse_all', function() {
        window.location.reload();
    });
    let filters = {
        nurse_registration: '',
        role_speciality: '',
        sort_by: '',
        available_to_start: '',
        searchId:''
        };

    function removePageParam() {
        let url = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({}, document.title, url);
        }
    let isAjaxMode = false;
    function fetchNurse(page = 1) {
        removePageParam();

        let filtersData = JSON.parse(sessionStorage.getItem("filters_data")) || {};
        isAjaxMode = true;
        $(".normal-pagination").addClass("d-none");
        $(".ajax-pagination").removeClass("d-none");

        // Show loader before request
        $(".ajax-pagination").html(`<div class="loader"></div>`);

        $.ajax({
            type: "POST",
            url: "{{ url('/healthcare-facilities/getNurseSorting') }}",
            data: {
                filters_data: filtersData,
                nurse_registration: filters.nurse_registration,
                sort_by: filters.sort_by,
                role_speciality: filters.role_speciality,
                available_to_start: filters.available_to_start,
                search_id: filters.searchId,
                page: page,
                _token: "{{ csrf_token() }}"
            },
            success: function (res) {
                if (!res.status) {
                    $(".ajax-pagination").html(`
                        <div class="no-jobs-box">
                            <h3>🚫 No Nurse Found</h3>
                            <p>Sorry, no nurses match your search.</p>
                        </div>
                    `);
                } else {
                    $(".ajax-pagination").html(res.html);
                }
            },
            error: function() {
                $(".ajax-pagination").html(`
                    <div class="no-jobs-box">
                        <h3>❌ Error</h3>
                        <p>Something went wrong while fetching nurses.</p>
                    </div>
                `);
            }
        });
    }

    $("#nurse_registration").on("keyup", function () {
        filters.nurse_registration = $(this).val();
        fetchNurse(1);
    });

    $("#role_speciality").on("keyup", function () {
        filters.role_speciality = $(this).val();
        fetchNurse(1);
    });

    $("#available_to_start").on("change", function () {
        filters.available_to_start = $(this).val();
        fetchNurse(1);
     });

    $("#sort_by").on("change", function () {
        filters.sort_by = $(this).val();
        fetchNurse(1);
     });

    $(document).on('click', '.saved-search-tab', function () {
        filters.searchId = $(this).data('id');
        fetchNurse(1);
    })

    $(document).on("click", ".ajax-pagination .pagination a", function (e) {
        e.preventDefault();
        let page = $(this).attr("href").split("page=")[1];
        fetchNurse(page);
    });
</script>
@endsection