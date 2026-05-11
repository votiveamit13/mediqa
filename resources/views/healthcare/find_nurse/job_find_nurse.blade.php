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

.select2-container{
    width:100% !important;
    z-index:9999; !important;
}

#residency_work_status ul.select2-selection__rendered {
    box-shadow: none !important;
    max-height: inherit !important;
    border: none !important;
    position: relative !important;
  }

 .salary-container {
  width: 400px;
  margin: 40px auto;
  text-align: center;
}

/* Slider track */
#salary-slider {
  margin: 30px 20px;
  height: 6px;
  background: #ddd;
  border: none;
  border-radius: 5px;
}

/* Selected range */
.ui-slider-range {
  background: #000000;
  height: 100%;
  border-radius: 5px;
}

/* 🔲 Square Handles (MAIN PART) */
.ui-slider-handle {
  width: 22px !important;
  height: 22px !important;
  background: #fff !important;
  border: 2px solid #000000 !important;
  border-radius: 6px !important; /* small rounding like your UI */
  top: -8px !important;
  cursor: pointer;
  outline: none;
}

/* Inner square effect */
.ui-slider-handle::after {
  content: "";
  width: 10px;
  height: 10px;
  background: #000000;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

/* Hover effect */
.ui-slider-handle:hover {
  transform: scale(1.1);
}

/* Salary text */
.salary-text {
  margin-top: 15px;
  font-size: 18px;
}

#salary_expectation_model .ui-slider-handle{
    display: block !important;
}

.filter-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    background: #f8f9fb;
    border-bottom: 1px solid #e5e7eb;
    border-radius: 8px 8px 0 0;
}

.filter_heading {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    display: flex;
    align-items: center;
    gap: 8px;
}

#reset-filter-button {
    background: transparent;
    border: 1px solid #d1d5db;
    color: #000000;
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.reset-btn i {
    margin-right: 5px;
}

#reset-filter-button:hover {
    background: #000000;
    color: #fff;
    border-color: #000000;
}

.job-criteria-reset{
    padding-right:35px;
}
.form-select {
  height: 45px;
  border-radius: 8px;
  font-size: 15px;
}
.modal_criteria span.select2.select2-container{
    padding: 7px 15px 8px 2px;
}
.center-modal{
        display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}
/* APPLY MODAL */
.apply-overlay {
    position: fixed;
    top:0; left:0;
    width:100%; height:100%;
    background: rgba(0,0,0,0.5);
    display:none;
    justify-content:center;
    align-items:center;
    z-index: 9999;
}

.apply-box {
    width:450px;
    background:#fff;
    padding:20px;
    border-radius:10px;
}

.apply-header {
    display:flex;
    justify-content:space-between;
    border-bottom: 1px solid #d9d9d9;
    padding-bottom: 10px;
}

.apply-alert {
    background:#ecfdf5;
    padding:10px;
    margin:10px 0;
}

.apply-field {
   border: 1px solid #f1f1f1;
    padding: 8px 12px;
    border-radius: 10px;
    font-size: 12px;
    margin-bottom:6px;
}
.apply-msg{
    padding: 0;
}
.apply-msg textarea{
       min-height: auto;
       font-size: 12px;

}

.apply-footer {
    text-align: right;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top:20px;
}

.apply-send {
    background:green;
    color:#fff;
}

/* INTERVIEW MODAL */
.interview-overlay {
    position: fixed;
    top:0; left:0;
    width:100%; height:100%;
    background: rgba(0,0,0,0.6);
    display:none;
    justify-content:center;
    align-items:center;
    z-index:9999;
}

.interview-box {
    width:450px;
    background:#fff;
    padding:20px;
    border-radius:10px;
    border-top:5px solid blue;
}

.interview-header {
    display:flex;
    justify-content:space-between;
}

.interview-alert {
    background:#eff6ff;
    padding:10px;
    margin:10px 0;
}

.interview-field {
    margin-bottom:10px;
}

.interview-footer {
    text-align:right;
}

.interview-send {
    background:blue;
    color:#fff;
}
.check-content {
    font-size: 10px;
    padding-left: 23px;
}
.mr-1{
    margin-right:5px;
}
.select-job-label label{
font-size:12px;
}
.apply-alert strong {
    color: #000000;
    font-weight: 600;
}
.select-job-label .date-field{
    border: 1px solid #f1f1f1;
    padding: 8px 12px;
    border-radius: 10px;
    font-size: 12px;
    margin-bottom: 6px;
    height: auto;
}
.interview-heading {
    font-size: 14px;
    margin: 6px 0px;
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
                            <div class="filter-header" style="display:flex">
                                <div class="filter_heading">Filters</div>
                                
                                <button class="btn btn-default" id="reset-filter-button">Reset Filter</button>
                                
                                
                            </div>
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
                                
                                <li class="filter-item view-employeement-type">
                                    <span>Employment Type</span>
                                    <span class="arrow">›</span>
                                </li>
                                <li class="filter-item shift-type-modal">
                                    <span>Shift Type</span>
                                    <span class="arrow">›</span>
                                </li>
                                 <li class="filter-item view-salary-expectation">
                                    <span>Salary Expectations </span>
                                    <span class="arrow">›</span>
                                </li>
                                <li class="filter-item view-degree">
                                    <span>Education </span>
                                    <span class="arrow">›</span>
                                </li>
                                <li class="filter-item view-registration-licenses">
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
                                 <li class="filter-item view-location-preferences">
                                    <span>Location Preferences  </span>
                                    <span class="arrow">›</span>
                                </li>
                                 <li class="filter-item view-residency-work-status">
                                    <span>Residency/work Status </span>
                                    <span class="arrow">›</span>
                                </li>
                                 <li class="filter-item view-international-hiring">
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

              <!-- Residency/work Status -->
              <div class="modal fade" id="residency_work_status" tabindex="-1" style="">
                <div class="modal-dialog modal-bottom">
                    <div class="modal-content">                
                    <div class="modal-header">
                        <h5 class="modal-title">Residency/work Status</h5>
                        <span class="close-btn work-status-close" data-close="residency_work_status">&times;</span>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                    </div>
                    <div class="modal-body">
                        <div class="form-group level-drp">
                            
                            
                            
                            <ul id="residency_status" style="display:none;">
                                
                                <li data-value="Australian Citizen">Citizen</li>
                                <li data-value="Permanent resident">Permanent resident</li>
                                <li data-value="Visa Holder">Visa Holder</li>
                                
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="residency_status" name="residency_status[]" multiple></select>
                            
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="applyWorkStatus()">
                            Apply
                        </button>
                    </div>
                    </div>
                 </div>
              </div>
               <!-- Salary Expectation -->
              <div class="modal fade" id="salary_expectation_model" tabindex="-1" style="">
                <div class="modal-dialog modal-bottom">
                    <div class="modal-content">                
                    <div class="modal-header">
                        <h5 class="modal-title">Salary Expectations</h5>
                        <span class="close-btn salary-expectation-close" data-close="salary_expectation_status">&times;</span>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                    </div>
                    <div class="modal-body">
                        <div class="form-group level-drp">
                            
                            <div id="salary-slider"></div>

                            <p style="margin-top:10px;">
                                $<span id="minSalary">41600</span> -
                                $<span id="maxSalary">312000</span> 
                            </p>
                        
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="applySalaryExpectation()">
                            Apply
                        </button>
                    </div>
                    </div>
                 </div>
              </div>

              <!-- Registration & Licences  -->
              <div class="modal fade" id="registration_licenses_model" tabindex="-1" style="">
                <div class="modal-dialog modal-bottom">
                    <div class="modal-content">                
                    <div class="modal-header">
                        <h5 class="modal-title">Registration & Licences</h5>
                        <span class="close-btn registration-close" data-close="registration_status">&times;</span>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                    </div>
                    <div class="modal-body">
                        <div class="form-group level-drp">
                            
                            
                            
                            <ul id="licenses" style="display:none;">
                                
                                <li data-value="1">NDIS-registered provider</li>
                                <li data-value="2">Bills under Medicare / MBS (NP/Midwife)</li>
                                <li data-value="3">PBS Prescriber</li>
                                <li data-value="4">Immunisation Provider</li>
                                <li data-value="5">Uses radiation equipment</li>
                                
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="licenses" name="licenses[]" multiple></select>
                            
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="applyRegistrationLicenses()">
                            Apply
                        </button>
                    </div>
                    </div>
                 </div>
               </div>
                <div id="locationPreferencesModal" class="modal-overlay" style="display: none;z-index:99!important">
                    <div class="modal-content modal-content-preferences">
                        <div class="modal-header">
                            <h4>Location Preferences</h4>
                            <span class="close-btn" id="closelanguage" data-close="languageModal" onclick="closeLocationPreferences()">&times;</span>
                        </div>
                        <div class="modal-body">
                            <div class="international_hiring_drop form-group level-drp source_countries">
                                <label class="form-label" for="input-1">Country
                                </label>
                                <input type="hidden" name="state_lat" class="state_lat" value="">
                                <input type="hidden" name="state_long" class="state_long" value="">
                                @php
                                    $get_countries = country_name_from_db();
                                @endphp
                                <input type="hidden" name="hf_country" class="hf_country" value="">
                                
                                <select class="form-control form-select filter_country" name="hf_filter_coutry[]" onchange="getStates()">
                                    <option value=""></option>
                                    @foreach($get_countries as $countries)
                                     <option value="{{ $countries->iso2 }}">{{ $countries->name }}</option>               
                                    @endforeach
                                </select>
                                <span id='reqsector_preferences' class='reqError text-danger valley'></span>
                                
                            </div>
                            <div class="form-group level-drp">
                                <label class="form-label" for="input-1">State / Region
                                </label>
                                @php
                                    $user_data = Auth::guard('healthcare_facilities')->user();

                                    $site_data = json_decode($user_data->site_data);

                                    //print_r($site_data);

                                @endphp
                                <select class="form-control form-select" name="job_state" id="job_state" onchange="changeState(this.value)">
                                    <option value="">Select</option>  
                                    @foreach($site_data as $s_data)
                                        @php
                                            $state_data = DB::table("states")->where("id",$s_data->state)->first();
                                        @endphp
                                        <option value="{{ $state_data->id }}">{{ $state_data->name }}</option> 
                                    @endforeach
                                </select>
                                <span id='reqjob_state' class='reqError text-danger valley'></span>
                            </div> 
                            
                            <!-- <div class="form-group level-drp">
                                <label class="form-label" for="input-1">City / Suburb
                                </label>
                                <input type="hidden" name="city_lat" class="city_lat" value="">
                                        <input type="hidden" name="city_long" class="city_long" value="">
                                <select class="form-control form-select city_suburb" name="city_suburb" id="city_suburb" onchange="changeCity(this.value)">

                                </select>
                                <input class="form-control city_suburb" type="text" name="city_suburb" id="city_suburb" value="@if(!empty($job_data)){{ $job_data->location_city }}@endif">
                                <span id='reqcity_suburb' class='reqError text-danger valley'></span>
                            </div>    -->
                            <div class="radius-filter">
                                <label class="form-label">
                                    Postcode Radius: <strong><span id="radiusValue">25</span> km</strong>
                                </label>
                                <input type="hidden" name="radiusInput" class="radiusInput" value="25">
                                <input type="range"
                                    id="radiusSlider"
                                    min="5"
                                    max="100"
                                    step="5"
                                    value="25"
                                    class="radius-slider">

                                <div class="radius-labels">
                                    <span>5 km</span>
                                    <span>100 km</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            
                            <button class="apply-btn apply-filter-btn" id="applySector" onclick="applyLocationFilter()">Apply</button>
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
                                @if($jobs_count)
                                <button class="btn btn-custom mr-2 open-apply-popup" data-id="{{$list->id}}">
                                    <i class="fa fa-user"></i> Invite to Apply
                                </button>
                                @else
                                <button class="btn btn-custom mr-2 btn-save-invite no_job_invite" 
                                        data-id="{{$list->id}}"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="You don’t have active job postings yet.">
                                    <i class="fa fa-user"></i> Invite to Apply
                                </button>

                                @endif
                               @if($jobs_count)
                                <button class="btn btn-custom mr-2 open-interview-popup" data-id="{{$list->id}}">
                                    <i class="fa fa-comments"></i> Invite to Interview
                                </button>
                                @else
                                <button class="btn btn-custom mr-2 btn-save-interview no_job_interview" 
                                        data-id="{{$list->id}}"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="You don’t have active job postings yet.">
                                    <i class="fa fa-comments"></i> Invite to Interview
                                </button>
                                @endif
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
                                    {{-- <th>Matches Count</th> --}}
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
                                    <td class="ss-type">
                                        @php 
                                            $filter_data = (array)json_decode($search_list->filter_summary);
                                            //print_r($search_list->filter_summary);


                                            

                                            $filter_summury = filterSummuryNurseData($filter_data);

                                            //($filter_summury);
                                        
                                        @endphp
                                        <a href="#" data-id="{{ $search_list->id }}" data-filters='{{ $filter_summury }}'  style="color:black;text-decoration:underline" class="btn-readmore">Read more</a>    
                                    </td>
                                    {{-- <td><span class="ss-match">0</span></td> --}}
                                    @php
                                      $dateOnly = date('Y-m-d', strtotime($search_list->created_at));
                                    @endphp
                                    <td>{{$dateOnly}}</td>
                                    <!-- <td><span class="ss-alert">Realtime</span></td> -->
                                    <td class="last_run_at-{{ $search_list->id }}">
                                        @php
                                            $datetime = $search_list->last_run_at;
                                            $date = date('Y-m-d', strtotime($datetime));

                                            echo $date;
                                        @endphp
                                    </td>
                                    <td class="ss-actions">
                                        <button class="btn ss-run" data-id="{{ $search_list->id }}">
                                            Run
                                        </button>
                                        <button class="btn ss-primary" data-name="{{ $search_list->id }}"  id="jobCriteriaBtn">
                                            Reset to Job Criteria
                                        </button>
                                        <button class="btn ss-edit"  data-name="{{ $search_list->id }}">
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

                               <!-- job criteria  -->
                    <div class="modal fade modal_criteria" centered id="jobCrieteriaModal" tabindex="-1">
                        <div class="modal-dialog modal-bottom center-modal">
                            <div class="modal-content">                
                            <div class="modal-header">
                                <h5 class="modal-title">Job Post Listing</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="edit_job_criteria" name="job_criteria_show" class='w-100'>
                                @if($jobs_count)
                                <select class="form-select job-criteria-reset" name="job_criteria">
                                    <option value="">Please Select</option>
                                     @foreach($jobs as $job_list)
                                      <option value="{{$job_list->id}}">{{$job_list->job_title}}</option>
                                     @endforeach
                                </select>
                                @else
                                     <p>You don't have active job postings yet</p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                @if($jobs_count)
                                <button type="button" class="btn btn-default" id="applyJobCriteria">
                                    Apply
                                </button>
                                 @else
                                <button type="button" class="btn btn-default" id="applyJobCriteria">
                                    Cancel
                                </button>
                                 @endif
                            </div>
                            </div>
                        </div>
                    </div>
                    <div id="readMoreOverlay"  class="modal-overlay" style="display:none;">
                        <div id="readMoreModal" class="side-modal">
                            <div class="side-modal-content">
                                <div class="modal-header">
                                    <h3>Filters summary</h3>
                                    <span class="close-btn closeModalFilter" id="closereadMore" data-close="readMoreModal">&times;</span>
                                </div>
                                <div id="readMoreBody" class="modal-body">
                                    <div id="modalContent"></div>
                                </div>
                                
                         
                            </div>
                        </div>
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
                                     <input type="hidden" id="selected_search_id" name="selected_search_id">
                                    <ul class="filter-list">
                                        <li class="filter-item edit-nurse-type">
                                            <span>Type of Nurse</span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item edit-specialty" data-id="1">
                                            <span>Specialty</span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item edit-work-environment" data-id="2">
                                            <span>Work Environment</span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item year-experience" >
                                            <span>Years of Experience</span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item edit-employment-type">
                                            <span>Employment Type</span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item edit-shift-type">
                                            <span>Shift Type</span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item salary-expect">
                                            <span>Salary Expectations </span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item degree-edit">
                                            <span>Education </span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item registration-licenses-edit">
                                            <span>Registration & Licences </span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item check-clearances">
                                            <span>Checks & Clearances</span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item edit-certifications">
                                            <span>Certifications </span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item language-type">
                                            <span>Language </span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item location-preferences-edit">
                                            <span>Location Preferences  </span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item residency_status_edit">
                                            <span>Residency/work Status </span>
                                            <span class="arrow">›</span>
                                        </li>
                                        <li class="filter-item international_hiring_edit">
                                            <span>International hiring </span>
                                            <span class="arrow">›</span>
                                        </li>    
                                    </ul>
                                    <div class="modal-footer">
                                        <button type="button" id="closeEditFilterType" class="btn btn-default"> Cancel </button>
                                        <button type="button" onclick="applyEditType()" class="btn btn-default"> Apply </button>
                                    </div> 
                                    </div>
                                </div>
                                <div id="editmodalContainer"></div>
                         
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
    function interviewInviteSend(){
        let healthcareId = $('input[name="healthcare_id"]').val();
        let preferred_date = $('input[name="preferred_date"]').val();
        let nurseId = $('input[name="nurse_id"]').val();
        let jobId = $('.apply-field').val();
        let meeting_mode = $('.meeting_mode').val();
        let message = $('.apply-msg textarea').val();

        if (!jobId) {
            Swal.fire({
                icon: 'warning',
                title: 'Select a Job',
                text: 'Please choose a job before sending the invite.'
            });
            return;
        }
        $.ajax({
            url: "{{ url('/healthcare-facilities/interview_invite_form') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                healthcare_id: healthcareId,
                nurse_id: nurseId,
                meeting_mode: meeting_mode,
                job_id: jobId,
                preferred_date: preferred_date,
                message: message
            },
            beforeSend: function () {
                $('.btn-save-invite').prop('disabled', true).text('Sending...');
            },
            success: function (response) {
                if(response.status == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Invitation Sent',
                        text: response.message || 'The nurse has been invited successfully.'
                    });
                }else if(response.status == 0){
                    Swal.fire({
                        icon: 'Error',
                        title: 'Already Invitation Sent',
                        text: response.message || 'The nurse has been invited successfully.'
                    });
                }
        
                $('#interviewPopup').hide(); // close modal
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.message || 'Something went wrong.'
                });
            },
            complete: function () {
                $('.btn-save').prop('disabled', false).text('Send Invite');
            }
        });
    }
    $(document).on('click', '.no_job_interview', function () {
        let nurseId = $(this).data('id');

        $.ajax({
            url: "{{ url('/healthcare-facilities/interview_invite_message') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                nurse_id: nurseId,
                job_id: null, // no job
                message: "You’re a strong match for this role and are invited to apply."
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Invitation Sent',
                    text: 'The nurse has received your invitation through email even though no job was selected.'
                });
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.message || 'Something went wrong.'
                });
            }
        });
    });

    $(document).on('click', '.open-interview-popup', function() {
        let $btn = $(this);
        $btn.css('pointer-events', 'none'); // disable click
        $('#modalContainer').empty();
        let modal = '#interviewPopup';
        var nurse_id = $(this).data('id');

        $('#globalLoader').show();
        $.ajax({
            url: "{{ url('/healthcare-facilities/modal_invite_interview') }}",
            type: "GET",
            data: {
                modal_no: 18,
                nurse_id: nurse_id
            },
            success: function(response) {
                $('#modalContainer').html(response);
                $(modal).fadeIn(); // since it's a custom side modal
                
                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
            }
        });
    });

    // $(document).on('click', '.open-interview-popup', function() {
    //     $('#interviewPopup').fadeIn();
    // });
    $(document).on('click', '.interview-close', function() {
        $('#interviewPopup').fadeOut();
    });
</script>
<script>
    function applyInviteSend(){
        let healthcareId = $('input[name="healthcare_id"]').val();
        let nurseId = $('input[name="nurse_id"]').val();
        let jobId = $('.apply-field').val();
        let message = $('.apply-msg textarea').val();

        if (!jobId) {
            Swal.fire({
                icon: 'warning',
                title: 'Select a Job',
                text: 'Please choose a job before sending the invite.'
            });
            return;
        }
        $.ajax({
            url: "{{ url('/healthcare-facilities/apply_invite_form') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                healthcare_id: healthcareId,
                nurse_id: nurseId,
                job_id: jobId,
                message: message
            },
            beforeSend: function () {
                $('.btn-save-invite').prop('disabled', true).text('Sending...');
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Invitation Sent',
                    text: response.message || 'The nurse has been invited successfully.'
                });
                $('#applyPopup').hide(); // close modal
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.message || 'Something went wrong.'
                });
            },
            complete: function () {
                $('.btn-save').prop('disabled', false).text('Send Invite');
            }
        });
    }
    $(document).on('click', '.no_job_invite', function () {
        let nurseId = $(this).data('id');

        $.ajax({
            url: "{{ url('/healthcare-facilities/apply_invite_message') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                nurse_id: nurseId,
                job_id: null, // no job
                message: "You’re a strong match for this role and are invited to apply."
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Invitation Sent',
                    text: 'The nurse has received your invitation even though no job was selected.'
                });
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.message || 'Something went wrong.'
                });
            }
        });
    });

    $(document).on('click', '.open-apply-popup', function() {
        let $btn = $(this);
        $btn.css('pointer-events', 'none'); // disable click
        $('#modalContainer').empty();
        let modal = '#applyPopup';
        var nurse_id = $(this).data('id');

        $('#globalLoader').show();
        $.ajax({
            url: "{{ url('/healthcare-facilities/modal_invite_apply') }}",
            type: "GET",
            data: {
                modal_no: 17,
                nurse_id: nurse_id
            },
            success: function(response) {
                $('#modalContainer').html(response);
                $(modal).fadeIn(); // since it's a custom side modal
                
                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
            }
        });
    });

    $(document).on('click', '.apply-close', function() {
        $('#applyPopup').fadeOut();
    });
</script>
<script>
    $(document).on('click', '.btn-readmore', function(e) {
        e.preventDefault();

        var modal_id = $(this).data('id');
        $('#readMoreOverlay').attr('data-id', modal_id);

        const filters = $(this).data('filters');
        const parsed = filters || {};
        let html = "";

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

        const sectionStyle = `margin-bottom:12px;`;

        if (!parsed || Object.keys(parsed).length === 0) {
            html = `<div style="padding:15px; text-align:center; color:#777;">
                        No data found
                    </div>`;
        } else {
                // ✅ Build chips dynamically
                $.each(parsed, function(key, value) {

                    if (Array.isArray(value) && value.length > 0) {
                        const heading = (typeof value[0] === 'object' && value[0].field_name)
                            ? value[0].field_name
                            : key.replace(/_/g, ' ');

                        html += `<div style="${sectionStyle}">`;
                        html += `<h6>${heading}</h6>`;

                        value.forEach(v => {

                            // ✅ Handle BOTH cases (object OR plain value)
                            const id   = (typeof v === 'object') ? v.id   : v;
                            const name = (typeof v === 'object') ? v.name : v;

                            html += `
                                <span class="chip" 
                                    data-key="${key}" 
                                    data-value="${id}" 
                                    style="${chipStyle}">
                                    ${name}
                                    <button class="chip-close" style="${closeStyle}">&times;</button>
                                </span>`;
                        });

                        html += `</div>`;
                    } 

                    else if (typeof value === 'object' && value !== null && value.min !== undefined) {
                        // ✅ Salary range
                        html += `<div style="${sectionStyle}">
                            <span class="chip" 
                                data-key="${key}" 
                                data-value='${JSON.stringify(value)}'
                                style="${chipStyle}">
                                $${value.min} – $${value.max}
                                <button class="chip-close" style="${closeStyle}">&times;</button>
                            </span>
                        </div>`;
                    } 

                    else if (value) {
                        // ✅ Single value fallback
                        html += `<div style="${sectionStyle}">
                            <span class="chip" 
                                data-key="${key}" 
                                data-value="${value}" 
                                style="${chipStyle}">
                                ${value}
                                <button class="chip-close" style="${closeStyle}">&times;</button>
                            </span>
                        </div>`;
                    }
                });
        }

        $('#modalContent').html(html);
        $('#readMoreOverlay').fadeIn();
        $("#readMoreModal").show();
    });

    $(".closeModalFilter").click(function(){
        $("#readMoreOverlay").hide();
    });

    $(document).on('click', '.chip-close', function () {
        const $chip = $(this).closest('.chip');

        const value = $chip.data('value'); 
        const key   = $chip.data('key');   // ✅ NEW

        // Remove from UI
        $chip.remove();

        // Uncheck checkbox
        $(`input[value="${value}"]`).prop("checked", false).trigger("change");

        const searchId = $('#readMoreOverlay').data('id'); 

        if (!searchId) {
            console.warn("No saved search ID found.");
            return;
        }

        let baseUrl = `{{ url('/healthcare-facilities/remove-filter') }}`;

        $.ajax({
            url: `${baseUrl}/${searchId}`,
            type: 'POST',
            data: {
                key: key,       // ✅ IMPORTANT
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
<script>
$('#jobCriteriaBtn').on('click', function () {
    $('#jobCrieteriaModal').modal('show');
    let searchId = $(this).data('name');
    $('#edit_job_criteria').val(searchId);
});

$(document).on('click', '#applyJobCriteria', function () {
    let selectedJob = $('select[name="job_criteria"]').val();
    let show_job_id = $('#edit_job_criteria').val();

    if (!selectedJob) {
        Swal.fire({
            icon: 'warning',
            title: 'No Selection',
            text: 'Please select a job before applying.'
        });
        return;
    }

    $('#globalLoader').show();

    $.ajax({
        url: "{{ url('/healthcare-facilities/apply_job_criteria') }}",
        type: "POST",
        data: {
            saved_search_id: show_job_id,
            job_id: selectedJob,
            _token: "{{ csrf_token() }}"
        },
        success: function (response) {
            $('#jobCrieteriaModal').modal('hide');
            $('#globalLoader').hide();

            // SweetAlert success popup
            Swal.fire({
                icon: 'success',
                title: 'Job Criteria Applied',
                text: 'Baseline filters have been re-applied. Temporary overrides cleared.',
                timer: 2000,
                showConfirmButton: false
            });

            // Optional: refresh job list or reset UI state
            // refreshJobs();
        },
        error: function () {
            $('#globalLoader').hide();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong while saving job criteria.'
            });
        }
    });
});

</script>
<script>

  $(document).on('click', '.ss-edit', function() {
        let searchId = $(this).data('name'); // get id

        // set hidden input value
        $('#selected_search_id').val(searchId);

        // 1. Clear previous filters_data_saved
        sessionStorage.removeItem('filters_data_saved');

        // 2. Fetch saved search filters from backend
        $.ajax({
            url: "{{ url('/healthcare-facilities/get_saved_search_filters') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                search_id: searchId
            },
            success: function(response) {
                if (response.status === 1 && response.filters) {
                    // Save new filters into sessionStorage
                    sessionStorage.setItem('filters_data_saved', JSON.stringify(response.filters));
                } else {
                    console.warn('No filters found for this saved search.');
                }
            },
            error: function(xhr) {
                console.error('Failed to fetch saved search filters:', xhr.responseText);
            }
        });

        // 3. Open modal
        $('#EditMoalOverlay').show();
        $('#verticalFilterModal').show();
    });

    $(document).on('click', '#closeEditFilterType', function () {
        $('#EditMoalOverlay').hide();
        $('#verticalFilterModal').hide();
    });

    $(document).on('click', '#backToEditFilter', function () {
        // Hide nurse modal
        $('#specialtyModal').hide();
        $('#employeement_type_modal').hide();
        $('#shiftTypeModal').hide();

        $('#editmodalOverlay').removeClass('modal-overlay');
        // Show the main Edit Filter modal again
        $('#verticalFilterModal').show();
    });


    $(document).on('click', '.edit-specialty', function () {

        let $btn = $(this); 
        $btn.css('pointer-events', 'none'); // disable click

        $('#modalContainer').empty();

        let applicationId = $btn.data('name');
        let modal = '#specialtyModal';

        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/speciality_edit') }}",
            type: "GET",
            data: { application_id: applicationId, modal_no: 2 },

            success: function (response) {

                $('#editmodalContainer').html(response);

                $(modal).fadeIn(); // since it's a custom side modal
                // console.log("Rohit123", response);
                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
                syncSpecialitySelections();
            }
        });
    });

    function syncSpecialitySelections() {
        var filter_data = sessionStorage.getItem("filters_data_saved");
        if (!filter_data) return;
 
        // console.log("rohit", filter_data);
        var filters_data = JSON.parse(filter_data);
        if (filters_data.specialty_type && Array.isArray(filters_data.specialty_type)) {
            filters_data.specialty_type.forEach(id => {
                let checkbox = document.querySelector(`#speciality-category-checked[value="${id}"]`);
                if (checkbox) {
                    checkbox.checked = true;
                    if (!selectedspecialtys.includes(id)) {
                        selectedspecialtys.push(id);
                    }
                }
            });
        }
    }

</script>
<script>
    $(".ss-run").click(function(){
        const id = $(this).data('id');
        const baseUrl = `{{ url('/healthcare-facilities/getNurseSorting') }}`;
        $.ajax({
            url: `${baseUrl}`,
            type: 'POST',
            data: {
                search_id:id,
                _token: "{{ csrf_token() }}"
            },
            beforeSend: function() {
                console.log("Running saved search...");
            },
            success: function(res) {
                const now = new Date();

                const formattedDateTime =
                now.getFullYear() + '-' +
                String(now.getMonth() + 1).padStart(2, '0') + '-' +
                String(now.getDate()).padStart(2, '0');

                console.log(formattedDateTime);
                $(".last_run_at-"+id).text(formattedDateTime);
                
            },
            error: function(xhr) {
                console.error("Error:", xhr.responseText);
            }
        });
    });

</script>
<script>
    $(document).on('click', '.salary-expect', function () {
        let $btn = $(this); 
        $btn.css('pointer-events', 'none');

        $('#modalContainer').empty();
        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/commonModalEdit') }}",
            type: "GET",
            data: { modal_no: 8 },
            success: function (response) {
                // Inject modal HTML
                $('#editmodalContainer').html(response);

                // Show modal
                $('#editSalary_expect').fadeIn();

                // Get saved values if available
                let filters_data = JSON.parse(sessionStorage.getItem('filters_data_saved')) || {};
                let minVal = filters_data.salary?.min || 41600;
                let maxVal = filters_data.salary?.max || 312000;

                // Initialize slider AFTER modal HTML is injected
                $("#salary-slider-edit").slider({
                    range: true,
                    min: 41600,
                    max: 312000,
                    step: 1000,
                    values: [minVal, maxVal],

                    slide: function (event, ui) {
                        $("#minSalary").text(ui.values[0]);
                        $("#maxSalary").text(ui.values[1]);
                    },

                    change: function (event, ui) {
                        let filters_data = JSON.parse(sessionStorage.getItem('filters_data_saved')) || {};
                        filters_data.salary = {
                            min: ui.values[0],
                            max: ui.values[1]
                        };
                        sessionStorage.setItem('filters_data_saved', JSON.stringify(filters_data));
                    }
                });

                // Update labels initially
                $("#minSalary").text(minVal);
                $("#maxSalary").text(maxVal);

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
            }
        });
    });

</script>
<script>

    $(document).on('click', '.check-clearances', function () {
        let $btn = $(this); 
        $btn.css('pointer-events', 'none');

        $('#modalContainer').empty();

        let applicationId = $btn.data('name');
        let modal = '#editCheck_clearances';

        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/commonModalEdit') }}",
            type: "GET",
            data: { modal_no: 10 },

            success: function (response) {
                $('#editmodalContainer').html(response);

                $(modal).fadeIn();

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
            }
        });
    });

</script>
<script>

    $(document).on('click', '.year-experience', function () {
        let $btn = $(this); 
        $btn.css('pointer-events', 'none');

        $('#modalContainer').empty();

        let applicationId = $btn.data('name');
        let modal = '#editYearExperience';

        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/commonModalEdit') }}",
            type: "GET",
            data: { modal_no: 4 },

            success: function (response) {
                $('#editmodalContainer').html(response);

                // ✅ Initialize Select2
                $('.js-example-basic-multiple').select2();

                // ✅ Sync saved selections
         

                $(modal).fadeIn();

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
            }
        });
    });

</script>
<script>
    function populateLanguageDropdowns() {
        $(".js-example-basic-multiple").each(function () {
            let $select = $(this);
            let listId = $select.data("list-id");
            let $list = $("#" + listId);

            // Clear old options
            $select.empty();

            // Add new options from hidden <ul>
            $list.find("li").each(function () {
                let value = $(this).data("value");
                let text = $(this).text();
                $select.append(new Option(text, value));
            });
        });
    }

    $(document).on('click', '.language-type', function () {
        let $btn = $(this); 
        $btn.css('pointer-events', 'none');

        $('#modalContainer').empty();

        let applicationId = $btn.data('name');
        let modal = '#languageModal';

        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/language_edit') }}",
            type: "GET",
            data: { application_id: applicationId, modal_no: 13 },

            success: function (response) {
                $('#editmodalContainer').html(response);

                populateLanguageDropdowns();

                $('.js-example-basic-multiple').select2();

                syncLanguageSelections();

                $(modal).fadeIn();

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
            }
        });
    });

    function syncLanguageSelections() {
        var filter_data = sessionStorage.getItem("filters_data_saved");
        if (!filter_data) return;

        var filters_data = JSON.parse(filter_data);

        if (filters_data.language && Array.isArray(filters_data.language)) {
            // Apply saved values to both dropdowns
            $(".js-example-basic-multiple").each(function () {
                let $select = $(this);
                $select.val(filters_data.language).trigger('change'); // Select2 refresh
            });

            // Keep in-memory state consistent
            selectedFilters.language = filters_data.language;
        }
    }

</script>
<script>
    $(document).on('click', '.location-preferences-edit', function () {
        let $btn = $(this); 
        $btn.css('pointer-events', 'none');

        let applicationId = $btn.data('name');
        let modal = '#Location_prefer_modal';

        $('#modalContainer').empty();
        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/commonModalEdit') }}",
            type: "GET",
            data: { modal_no: 33 },
            success: function (response) {
                // Inject modal HTML
                $('#editmodalContainer').html(response);

                
                $(modal).fadeIn(); // since it's a custom side modal
                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
            }
        });
    });
</script>
<script>
    function populateResidencyDropdowns() {
        $(".js-example-basic-multiple").each(function () {
            let $select = $(this);
            let listId = $select.data("list-id");
            let $list = $("#" + listId);

            // Clear old options
            $select.empty();

            // Add new options from hidden <ul>
            $list.find("li").each(function () {
                let value = $(this).data("value");
                let text = $(this).text();
                $select.append(new Option(text, value));
            });
        });
    }

    $(document).on('click', '.residency_status_edit', function () {
        let $btn = $(this); 
        $btn.css('pointer-events', 'none');

        let applicationId = $btn.data('name');
        let modal = '#residency_status_modal';

        $('#modalContainer').empty();
        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/commonModalEdit') }}",
            type: "GET",
            data: { modal_no: 34 },
            success: function (response) {
                // Inject modal HTML
                $('#editmodalContainer').html(response);
                $('.js-example-basic-multiple').select2();
                populateResidencyDropdowns();
                $(modal).fadeIn(); // since it's a custom side modal
                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
            }
        });
    });
</script>
<script>
    $(document).on('click', '.international_hiring_edit', function () {
        let $btn = $(this); 
        $btn.css('pointer-events', 'none');

        let applicationId = $btn.data('name');
        let modal = '#hiring_edit_modal';

        $('#modalContainer').empty();
        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/commonModalEdit') }}",
            type: "GET",
            data: { modal_no: 35 },
            success: function (response) {
                // Inject modal HTML
                $('#editmodalContainer').html(response);
                $('.js-example-basic-multiple').select2();
                //populateResidencyDropdowns();
                $(modal).fadeIn(); // since it's a custom side modal
                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
            }
        });
    });
</script>    
<script>
    $(document).on('click', '.edit-shift-type', function () {

        let $btn = $(this); 
        $btn.css('pointer-events', 'none'); // disable click

        $('#modalContainer').empty();

        let applicationId = $btn.data('name');
        let modal = '#shiftTypeModal';

        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/shift_type_edit') }}",
            type: "GET",
            data: { application_id: applicationId, modal_no: 7 },

            success: function (response) {

                $('#editmodalContainer').html(response);

                $(modal).fadeIn(); // since it's a custom side modal

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
                syncShiftCategorySelections();
            }
        });
    });

    function syncShiftCategorySelections() {
        var filter_data = sessionStorage.getItem("filters_data_saved");
        if (!filter_data) return;

        var filters_data = JSON.parse(filter_data);
        if (filters_data.shiftType && Array.isArray(filters_data.shiftType)) {
            filters_data.shiftType.forEach(id => {
                let checkbox = document.querySelector(`.shiftType-checkbox[value="${id}"]`);
                if (checkbox) {
                    checkbox.checked = true;
                    // ✅ push into selectedFilters.shiftType, not a missing variable
                    if (!selectedFilters.shiftType.includes(id)) {
                        selectedFilters.shiftType.push(id);
                    }
                }
            });
        }
    }

    
</script>
<script>
    function populateRegistrationDropdowns() {
        $(".js-example-basic-multiple").each(function () {
            let $select = $(this);
            let listId = $select.data("list-id");
            let $list = $("#" + listId);

            // Clear old options
            $select.empty();

            // Add new options from hidden <ul>
            $list.find("li").each(function () {
                let value = $(this).data("value");
                let text = $(this).text();
                $select.append(new Option(text, value));
            });
        });
    }

    $(document).on('click', '.registration-licenses-edit', function () {
        let $btn = $(this); 
        $btn.css('pointer-events', 'none');

        $('#modalContainer').empty();

        //let applicationId = $btn.data('name');
        let modal = '#editRegistration';

        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/commonModalEdit') }}",
            type: "GET",
            data: { modal_no: 23 },

            success: function (response_lic) {
                $('#editmodalContainer').html(response_lic);

                populateRegistrationDropdowns();

                $('.js-example-basic-multiple').select2();

                //syncLanguageSelections();

                $(modal).fadeIn();
                //initSelect2();

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
            }
        });
    });

    // $(document).on('wheel.select2fix', '.select2-results__options', function (e) {
    //     e.stopPropagation();
    // });

    function syncRegistrationSelections() {
        var filter_data = sessionStorage.getItem("filters_data_saved");
        if (!filter_data) return;

        var filters_data = JSON.parse(filter_data);

        if (filters_data.language && Array.isArray(filters_data.language)) {
            // Apply saved values to both dropdowns
            $(".js-example-basic-multiple").each(function () {
                let $select = $(this);
                $select.val(filters_data.language).trigger('change'); // Select2 refresh
            });

            // Keep in-memory state consistent
            selectedFilters.language = filters_data.language;
        }
    }

</script>
<script>

    $(document).on('click', '.degree-edit', function () {

        let $btn = $(this); 
        $btn.css('pointer-events', 'none');

        $('#modalContainer').empty();

        let applicationId = $btn.data('name');
        let modal = '#degreeModal';

        $('#globalLoader').show();

        

        $.ajax({
            url: "{{ url('/healthcare-facilities/commonModalEdit') }}",
            type: "GET",
            data: { modal_no: 24 },
            success: function (response) {
                // Inject modal HTML
                $('#editmodalContainer').html(response);
                populateLanguageDropdowns();
                $('.js-example-basic-multiple').select2();        
                // Show modal
                $(modal).fadeIn();

                

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
            }
        });
    });

    function syncShiftCategorySelections() {
        var filter_data = sessionStorage.getItem("filters_data_saved");
        if (!filter_data) return;

        var filters_data = JSON.parse(filter_data);
        if (filters_data.shiftType && Array.isArray(filters_data.shiftType)) {
            filters_data.shiftType.forEach(id => {
                let checkbox = document.querySelector(`.shiftType-checkbox[value="${id}"]`);
                if (checkbox) {
                    checkbox.checked = true;
                    // ✅ push into selectedFilters.shiftType, not a missing variable
                    if (!selectedFilters.shiftType.includes(id)) {
                        selectedFilters.shiftType.push(id);
                    }
                }
            });
        }
    }

    
</script>

<script>
    $(document).on('click', '.edit-work-environment', function () {

        let $btn = $(this); 
        $btn.css('pointer-events', 'none'); // disable click

        $('#modalContainer').empty();

        let applicationId = $btn.data('id');
        let modal = '#workEnvironmentSavedModal';

        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/work_environment_edit') }}",
            type: "GET",
            data: { application_id: applicationId, modal_no: 3 },

            success: function (response) {

                $('#editmodalContainer').html(response);

                $(modal).fadeIn(); // since it's a custom side modal

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();

                //syncMainCategorySelections();
            }
        });
    });
</script>
<script>
    $(document).on('click', '.edit-certifications', function () {

        let $btn = $(this); 
        $btn.css('pointer-events', 'none'); // disable click

        $('#modalContainer').empty();

        let applicationId = $btn.data('name');
        let modal = '#certificatonSavedModal';

        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/certification_edit') }}",
            type: "GET",
            data: { application_id: applicationId, modal_no: 12 },

            success: function (response) {

                $('#editmodalContainer').html(response);

                $(modal).fadeIn(); // since it's a custom side modal

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
                //syncMainCategorySelections();
            }
        });
    });

    // function syncMainCategorySelections() {
    //     var filter_data = sessionStorage.getItem("filters_data_saved");
    //     if (!filter_data) return;

    //     var filters_data = JSON.parse(filter_data);
    //     if (filters_data.nurse_type && Array.isArray(filters_data.nurse_type)) {
    //         filters_data.nurse_type.forEach(id => {
    //             let checkbox = document.querySelector(`#main-category-checked[value="${id}"]`);
    //             if (checkbox) {
    //                 checkbox.checked = true;
    //                 if (!selectedNurseTypes.includes(id)) {
    //                     selectedNurseTypes.push(id);
    //                 }
    //             }
    //         });
    //     }
    // }
    
</script>
<script>
    $(document).on('click', '.edit-employment-type', function () {

        let $btn = $(this); 
        $btn.css('pointer-events', 'none'); // disable click

        $('#modalContainer').empty();

        let applicationId = $btn.data('name');
        let modal = '#employeement_type_modal';

        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/employment_type_edit') }}",
            type: "GET",
            data: { application_id: applicationId, modal_no: 6 },

            success: function (response) {

                $('#editmodalContainer').html(response);

                $(modal).fadeIn(); // since it's a custom side modal

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
                syncMainEmploySelections();
            }
        });
    });

    function syncMainEmploySelections() {
        var filter_data = sessionStorage.getItem("filters_data_saved");
        if (!filter_data) return;

        var filters_data = JSON.parse(filter_data);
        if (filters_data.employment_type && Array.isArray(filters_data.employment_type)) {
            filters_data.employment_type.forEach(id => {
                let checkbox = document.querySelector(`#main-category-checked[value="${id}"]`);
                if (checkbox) {
                    checkbox.checked = true;
                    if (!selectedemploymentType.includes(id)) {
                        selectedemploymentType.push(id);
                    }
                }
            });
        }
    }
    
</script>
<script>
    $(document).on('click', '#closeEditFilterType', function () {
        $('#EditMoalOverlay').hide();
        $('#verticalFilterModal').hide();
    });

    $(document).on('click', '#backToEditFilter', function () {
        // Hide nurse modal
        $('#nurseTypeModal').hide();
        $('#employeement_type_modal').hide();
        $('#shiftTypeModal').hide();
        $('#workEnvironmentSavedModal').hide();
        $('#certificatonSavedModal').hide();

        $('#editmodalOverlay').removeClass('modal-overlay');
        // Show the main Edit Filter modal again
        $('#verticalFilterModal').show();
    });


    $(document).on('click', '.edit-nurse-type', function () {

        let $btn = $(this); 
        $btn.css('pointer-events', 'none'); // disable click

        $('#modalContainer').empty();

        let applicationId = $btn.data('name');
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
                syncMainCategorySelections();
            }
        });
    });

    function syncMainCategorySelections() {
        var filter_data = sessionStorage.getItem("filters_data_saved");
        if (!filter_data) return;

        var filters_data = JSON.parse(filter_data);
        if (filters_data.nurse_type && Array.isArray(filters_data.nurse_type)) {
            filters_data.nurse_type.forEach(id => {
                let checkbox = document.querySelector(`#main-category-checked[value="${id}"]`);
                if (checkbox) {
                    checkbox.checked = true;
                    if (!selectedNurseTypes.includes(id)) {
                        selectedNurseTypes.push(id);
                    }
                }
            });
        }
    }

  function applyEditType() {
    removePageParam();
    let selected_search_id = document.getElementById("selected_search_id").value;
    let filters_data_saved = JSON.parse(sessionStorage.getItem("filters_data_saved")) || {};
    console.log(filters_data_saved);
    isAjaxMode = true;

    $.ajax({
        type: "POST",
        url: "{{ url('/healthcare-facilities/apply_saved_search') }}",
        data: {
            filters_data_saved: filters_data_saved,
            selected_search_id: selected_search_id,
            _token: "{{ csrf_token() }}"
        },
        success: function (res) {

            sessionStorage.removeItem("filters_data_saved");
            document.getElementById("EditMoalOverlay").remove(); 
            window.location.reload();
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

</script>
<script>
    $('.addAll_removeAll_btn').on('select2:open', function() {
        var $dropdown = $(this);
        var searchBoxHtml = `
            
            <div class="extra-buttons">
                <button class="select-all-button" type="button">Select All</button>
                <button class="remove-all-button" type="button">Remove All</button>
            </div>`;

        // Remove any existing extra buttons before adding new ones
        $('.select2-results .extra-search-container').remove();
        $('.select2-results .extra-buttons').remove();

        // Append the new extra buttons and search box
        $('.select2-results').prepend(searchBoxHtml);

        // Handle Select All button for the current dropdown
        $('.select-all-button').on('click', function() {
            var $currentDropdown = $dropdown;
            var allValues = $currentDropdown.find('option').map(function() {
                return $(this).val();
            }).get();
            $currentDropdown.val(allValues).trigger('change');
        });

        // Handle Remove All button for the current dropdown
        $('.remove-all-button').on('click', function() {
            var $currentDropdown = $dropdown;
            $currentDropdown.val(null).trigger('change');
        });
    });
    $('.js-example-basic-multiple').on('select2:open', function() {
        var searchBoxHtml = `
            <div class="extra-search-container">
                <input type="text" class="extra-search-box" placeholder="Search...">
                <button class="clear-button" type="button">&times;</button>
            </div>`;
        
        if ($('.select2-results').find('.extra-search-container').length === 0) {
            $('.select2-results').prepend(searchBoxHtml);
        }

        var $searchBox = $('.extra-search-box');
        var $clearButton = $('.clear-button');

        $searchBox.on('input', function() {

            var searchTerm = $(this).val().toLowerCase();
            $('.select2-results__option').each(function() {
                var text = $(this).text().toLowerCase();
                if (text.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            $clearButton.toggle($searchBox.val().length > 0);
        });

        $clearButton.on('click', function() {
            $searchBox.val('');
            $searchBox.trigger('input');
        });
    });

    $('.js-example-basic-multiple').select2();

    // Dynamically add the clear button
    const clearButton = $('<span class="clear-btn">✖</span>');
    $('.select2-container').append(clearButton);

    // Handle the visibility of the clear button
    function toggleClearButton() {

        const selectedOptions = $('.js-example-basic-multiple').val();
        if (selectedOptions && selectedOptions.length > 0) {
            clearButton.show();
        } else {
            clearButton.hide();
        }
    }

    // Attach change event to select2
    $('.js-example-basic-multiple').on('change', toggleClearButton);

    // Clear button click event
    clearButton.click(function() {

        $('.js-example-basic-multiple').val(null).trigger('change');
        toggleClearButton();
    });

    // Initial check
    toggleClearButton();
    $('.js-example-basic-multiple').each(function() {
        let listId = $(this).data('list-id');

        let items = [];
        console.log("listId",listId);
        $('#' + listId + ' li').each(function() {
            console.log("value",$(this).data('value'));
            items.push({ id: $(this).data('value'), text: $(this).text() });
        });
        console.log("items",items);
        $(this).select2({
            data: items
        });
    });

    $("#reset-filter-button").click(function(){

        sessionStorage.removeItem("filters_data");
        $("#reset-filter-button").prop("disabled", true);
        window.location.reload();
    });
</script>
<script>
    $(document).ready(function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
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
    $('.view-residency-work-status').on('click', function () {
       $('#residency_work_status').modal('show');
    });

    function applyWorkStatus(){
        var work_status_value = $('.js-example-basic-multiple[data-list-id="residency_status"]').val();

        // Retrieve existing filters from sessionStorage
        var filter_data = sessionStorage.getItem("filters_data");
        var filters_data = filter_data ? JSON.parse(filter_data) : {};

        // Save year of experience into filters_data
        filters_data.residency_status = work_status_value;

        // Update sessionStorage
        sessionStorage.setItem('filters_data', JSON.stringify(filters_data));

        // Close modal
        $('#residency_work_status').modal('hide');

        // Call API / function
        fetchNurse();
    }

    $(".work-status-close").click(function(){
        $('#residency_work_status').modal('hide');
    });
</script>
<script>
    $(document).on('click', '.view-salary-expectation', function () {
        $('#salary_expectation_model').modal('show');

        $("#salary-slider").slider({
            range: true,
            min: 41600,
            max: 312000,
            step: 1000,
            values: [41600, 312000],

            slide: function (event, ui) {
                $("#minSalary").text(ui.values[0]);
                $("#maxSalary").text(ui.values[1]);
            },

            change: function (event, ui) {
                // Store in your filters_data
                let filters_data = JSON.parse(sessionStorage.getItem('filters_data')) || {};

                filters_data.salary = {
                    min: ui.values[0],
                    max: ui.values[1]
                };

                //sessionStorage.setItem('filters_data', JSON.stringify(filters_data));
            }
        });
    });

    $(document).on('click', '.salary-expectation-close', function () {
        $('#salary_expectation_model').modal('hide');
    });

    function applySalaryExpectation(){
        let values = $("#salary-slider").slider("values");

        let minSalary = parseInt(values[0]);
        let maxSalary = parseInt(values[1]);

        // Get existing filters or create new
        let filters_data = JSON.parse(sessionStorage.getItem('filters_data')) || {};

        // Save salary range
        filters_data.salary = {
            min: minSalary,
            max: maxSalary
        };

        // Store back
        sessionStorage.setItem('filters_data', JSON.stringify(filters_data));

        // Close modal
        $('#salary_expectation_model').modal('hide');

        // Call API / function
        fetchNurse();
    }

</script>
<script>
    $(document).on('click', '.view-registration-licenses', function () {
        $('#registration_licenses_model').modal('show');

        
    });

    $(document).on('click', '.registration-close', function () {
        $('#registration_licenses_model').modal('hide');
    });

    function applyRegistrationLicenses(){
        var registration_values = $('.js-example-basic-multiple[data-list-id="licenses"]').val();
        // Get existing filters or create new
        let filters_data = JSON.parse(sessionStorage.getItem('filters_data')) || {};

        // Save salary range
        filters_data.registration_values = registration_values;

        // Store back
        sessionStorage.setItem('filters_data', JSON.stringify(filters_data));

        // Close modal
        $('#registration_licenses_model').modal('hide');

        // Call API / function
        fetchNurse();
    }

</script>
<script>
    // function getStates() {
    //     var countries = $('.filter_country').val();

    //     // ✅ Reset dropdown immediately
    //     $("#job_state").html('<option value="">Loading...</option>');

    //     // ✅ Reset variable
    //     var job_state = '';

    //     $.ajax({
    //         type: "get",
    //         url: "{{ route('medical-facilities.getStatesLat') }}",
    //         data: { country_code_value: countries },

    //         success: function(data) {
    //             var state_data = JSON.parse(data);

    //             // ✅ Clear again before adding
    //             $("#job_state").empty();

    //             job_state += '<option value="">Select</option>';

    //             for (var i = 0; i < state_data.length; i++) {
    //                 job_state += '<option value="' + state_data[i].id + '">' + state_data[i].name + '</option>';
    //             }

    //             $("#job_state").html(job_state);
    //         }
    //     });
    // }

    function changeState(value){
    //alert(value);
      $.ajax({
          type: "get",
          url: "{{ route('medical-facilities.getStatesLat') }}",
          
          data: {state_code_value:value},
          success: function(data) {
              if(data != ""){
                  var state_data = JSON.parse(data);
                  $(".state_lat").val(state_data.latitude);
                  $(".state_long").val(state_data.longitude);
                  //console.log("state_name",data.name);
              }
          }
      }); 

    }

    function changeCity(value){
      $.ajax({
          type: "get",
          url: "{{ route('medical-facilities.getCitiesLat') }}",
          
          data: {city_code_value:value},
          success: function(data) {
              if(data != ""){
                  var city_data = JSON.parse(data);
                  
                  console.log("city_data",city_data.latitude);
                  $(".city_lat").val(city_data.latitude);
                  $(".city_long").val(city_data.longitude);
                  //console.log("state_name",data.name);
              }
          }
      });
    }

    const slider = document.getElementById("radiusSlider");
    const radiusText = document.getElementById("radiusValue");
    const radiusInput = document.getElementsByClassName("radiusInput")[0];

    

    // On change
    slider.addEventListener("input", function () {

        radiusText.innerText = this.value;
        radiusInput.value = this.value;

        
    });

    $(".view-location-preferences").click(function(){
        $("#locationPreferencesModal").show();
    });

    function applyLocationFilter(){
        var state_lat = $(".state_lat").val();
        var state_long = $(".state_long").val();
        var radius = $(".radiusInput").val();

        var country = $(".filter_country").val();

        var location = {
            country:country,
            lat: state_lat,
            lng: state_long,
            radius:radius
        };

        var filter_data = sessionStorage.getItem("filters_data");
        var filters_data = filter_data ? JSON.parse(filter_data) : {};

        filters_data.location = location;

        sessionStorage.setItem("filters_data", JSON.stringify(filters_data));

        console.log(filters_data);

        //var filters_data1 = sessionStorage.getItem("filters_data");

        $("#locationPreferencesModal").hide();
        fetchNurse(1);
    }

    function closeLocationPreferences(){
        $("#locationPreferencesModal").hide();
    }


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
    $(document).on('click', '.view-international-hiring', function () {

        let $btn = $(this); 
        $btn.css('pointer-events', 'none'); // disable click

        $('#modalContainer').empty();

        let applicationId = $btn.data('id');
        let modal = '#internationalHiringModal';

        //$("#internationalHiringModal").show();

        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/international_hiring') }}",
            type: "GET",
            data: { application_id: applicationId, modal_no: 16 },

            success: function (response) {

                $('#modalContainer').html(response);

                $(modal).fadeIn(); // since it's a custom side modal

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
                //syncNurseTypeSelections();
                initLanguageSelect2()
                // var i = 1;
                // $(".international_hiring_drop").each(function(){
                //     selectTwoFunction(i);
                //     i++;
                // });
                
                
                
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
    $(document).on('click', '.view-degree', function () {
        let $btn = $(this); 
        $btn.css('pointer-events', 'none'); // disable click

        $('#modalContainer').empty();

        
        let modal = '#degreeModal';

        $('#globalLoader').show();
        
        $.ajax({
            url: "{{ url('/healthcare-facilities/degree_list') }}",
            type: "GET",
            data: { modal_no: 9 },

            success: function (response) {

                $('#modalContainer').html(response);

                $(modal).fadeIn(); // since it's a custom side modal

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
                initLanguageSelect2();
                //syncEmploymentTypeSelections();
            }
        });
    });
    $(document).on('click', '#closedegreeModal', function () {
        $("#modalOverlay").hide();
        $('#degreeModal').hide();
    });
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


    $('.job-criteria-reset').select2({
  dropdownParent: $('#jobCrieteriaModal'),
  width: '100%'
});

</script>
@endsection