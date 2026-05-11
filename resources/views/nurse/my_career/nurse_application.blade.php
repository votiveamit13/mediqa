@extends('nurse.layouts.layout')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ url('/public') }}/nurse/assets/css/jquery.ui.datepicker.monthyearpicker.css">
<link rel='stylesheet'
  href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<style type="text/css">
  .hide_profile_image {
    display: none !important;
  }
  span.select2.select2-container {
    padding: 5px !important;
    width: 100% !important;
  }
  .select2-container--default .select2-selection--multiple {
    background-color: white !important;
    border: 1px solid #0000 !important;
    border-radius: 4px !important;
    cursor: text !important;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #000 !important;
    border: 1px solid #000 !important;
    border-radius: 4px !important;
    cursor: default !important;
    color: #fff !important;
    float: left;
    padding: 0;
    padding-right: 0.75rem;
    margin-top: calc(0.375rem - 2px);
    margin-right: 0.375rem;
    padding-bottom: 2px;
    white-space: normal;
    line-height: 20px;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff !important;
    font-size: 20px !important;
    float: left;
    padding-right: 3px;
    padding-left: 3px;
    margin-right: 1px;
    margin-left: 3px;
    font-weight: 700;
    line-height: 20px;
  }
  .registration_progress {
    font-weight: 900;
    background-color: black;
    color: #fff;
  }
  form#multi-step-form-nurseProfileForm ul.select2-selection__rendered {
    box-shadow: none;
    max-height: inherit;
    border: none;
    position: relative;
  }
  .category {
    margin-bottom: 1.5rem;
  }
  .label {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.4rem;
    font-weight: 600;
  }
  .progress-bar-bg {
    background: #e4e8ee;
    height: 16px;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
  }
  .progress-bar-fill {
    background: #000;
    height: 100%;
    border-radius: 10px;
    color: white;
    font-size: 12px;
    padding-left: 6px;
    display: flex;
    align-items: center;
  }
  /*07/02 */
  .status-badge {
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    /*white-space: nowrap;*/
    display: inline-block;
    text-align: center;
    min-width: 145px;
  }
  .under-review {
    background: #facc15;
    color: #856404;
  }
  .offer {
    background: #22c55e;
    color: #155724;
  }
  .shortlisted {
    background: #ef4444;
    color: #ffffff;
  }
  /* Right side modal */
  .modal.right .modal-dialog {
    position: fixed;
    right: 0;
    margin: 0;
    width: 420px;
    height: 100%;
    transform: translate3d(0%, 0, 0);
  }
  .modal.right .modal-content {
    height: 100%;
    border-radius: 0;
    border: none;
  }
  .timeline {
    position: relative;
    padding-left: 30px;
  }
  .timeline::before {
    content: '';
    position: absolute;
    left: 8px;
    top: 8px;
    bottom: 0;
    width: 2px;
    background: #e0e0e0;
  }
  .timeline-item {
    position: relative;
    margin-bottom: 20px;
  }
  .timeline-item::before {
    content: '';
    position: absolute;
    left: -26px;
    top: 8px;
    width: 10px;
    height: 10px;
    background: #facc15;
    border-radius: 50%;
  }
  .pl-370 {
    padding-left: 370px !important;
  }
  .application .nav-tabs .nav-link.active {
    color: #495057;
    background-color: #fff;
    border-color: #dee2e6 #dee2e6 #fff;
    border-bottom: 2px solid #000000;
    border-top: 0;
    border-left: 0;
    border-right: 0;
    border-radius: 0;
  }
  .application .nav-tabs .nav-link:focus,
  .nav-tabs .nav-link:hover {
    border-color: transparent;
    isolation: isolate;
  }
  .filter-btn {
    /*border: 1px solid #e5e7eb;*/
    font-size: 14px;
    padding: 6px 12px;
    background: #fff;
  }
  .filter-btn:hover {
    background: #f8f9fa;
  }
  .search-input {
    padding-left: 32px;
    height: 38px;
    font-size: 14px;
  }
  .search-icon {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 14px;
  }
  .filter-border {
    border: 1px solid #dee2e6;
    border-radius: 10px;
  }
  .filter-border .btn-light {
    border-color: transparent;
    padding-left: 10px;
  }
  .filter-border input {
    border: 0;
    padding-left: 32px;
    height: auto !important;
    padding: 11px 35px;
  }
  .filter-item:not(:last-child) {
    border-right: 1px solid #e5e7eb;
    padding: 7px 15px;
  }
  .filter-item i {
    margin-right: 8px !important;
  }
  .whitespace-nowrap {
    white-space: nowrap;
    padding: 7px 15px;
  }
  .pt-7 {
    padding: 7px 0;
  }
  .pl-20 {
    padding-left: 20px;
  }
  .application-table th {
    color: #6b7280;
  }
  .application-table .table-bordered,
  .table-bordered td {
    border: 1px solid #dee2e6 !important;
    padding: 15px;
  }
  .application-table .table-bordered>:not(caption)>*>* {
    border-width: inherit;
  }
  .application-table thead {
    border-bottom: transparent;
  }
  .table-nurse-head {
    font-size: 16px;
    color: #000000;
  }
  .application-table small {
    font-size: 12px !important;
  }
  .timeline-item small {
    font-size: 12px;
    color: #6b7280;
  }
  .progress-content {
    background: #60a5fa14;
    width: auto;
    padding: 20px;
    border-radius: 20px;
  }
  .close {
    border: 0;
    background: transparent;
  }
  .pending-offer-head {
    color: #60a5fa;
  }
  .pending-des {
    position: relative;
    padding-left: 15px;
    max-width: 160px;
    font-size: 12px;
  }
  .pending-des::before {
    content: '';
    position: absolute;
    left: 0;
    top: 10px;
    background: #6b7280;
    width: 8px;
    height: 8px;
    border-radius: 100%;
  }
  .status-badge.submitted {
    color: white;
    background: #6b7280;
  }
  .status-badge.under_review {
    color: white;
    background: #facc15;
  }
  .status-badge.shortlisted {
    color: white;
    background: #f59e0b;
  }
  .status-badge.interview_scheduled {
    color: white;
    background: #3b82f6;
  }
  .status-badge.interview_completed {
    color: white;
    background: #60a5fa;
  }
  .status-badge.conditional_offer {
    color: white;
    background: #3b82f6;
  }
  .status-badge.offer {
    color: white;
    background: #22c55e;
  }
  .status-badge.hired {
    color: white;
    background: #8b5cf6;
  }
  .status-badge.withdrawn {
    color: white;
    background: #374151;
  }
  .status-badge.rejected,
  .status-badge.declined {
    color: white;
    background: #ef4444;
  }
  /*10/02 */
  .offer-modal {
    border-radius: 12px;
  }
  .accept-box {
    background: linear-gradient(135deg, #eef8ff, #f9fcff);
  }
  .status-box {
    background: #f5f7f9;
  }
  .badge-success {
    background-color: #22b573;
  }
  .modal-footer .btn-success {
    background-color: #22b573;
    border: none;
  }
  /*view interview details */
  .process-modal {
    border-radius: 12px;
  }
  .interview-status {
    background: #fff3cd;
    border: none;
    border-radius: 8px;
    color: #664d03;
  }
  .process {
    position: relative;
    padding-left: 30px;
  }
  .process::before {
    content: "";
    position: absolute;
    left: 6px;
    top: 6px;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
  }
  .process-item {
    position: relative;
    display: flex;
    margin-bottom: 20px;
  }
  .process-item.last {
    margin-bottom: 0;
  }
  .process-item .dot {
    position: absolute;
    left: -30px;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: #ced4da;
    margin-top: 6px;
  }
  .process-item.active .dot {
    background: #007bff;
  }
  .process-item.orange .dot {
    background: #f0ad4e;
  }
  .process-item .content {
    padding-left: 10px;
  }
  .withdraw-text {
    font-size: 12px;
  }
  /*view details */
  .offer-review-modal {
    border-radius: 12px;
  }
  /* Left card */
  .left-card {
    background: #f8f9fa;
    /*border-radius: 10px;*/
  }
  /* Status alert */
  .status-alert {
    background: #fff4da;
    border-radius: 8px;
    padding: 14px 16px;
    color: #6b4e00;
  }
  /* Document cards */
  .doc-card {
    background: #f4f9fd;
    border-radius: 10px;
    padding: 14px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  #offerReviewModal small {
    font-size: 12px;
  }
  /*11/02 */
  /* Modal width like mobile design */
  .withdrawn-modal .modal-dialog {
    max-width: 580px;
  }
  .withdrawn-modal .modal-content {
    border-radius: 12px;
    padding: 20px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  }
  /* Header */
  .withdrawn-title {
    font-size: 18px;
    font-weight: 600;
    color: #212529;
  }
  /* Withdrawn pill top */
  .withdrawn-pill {
    display: inline-flex;
    align-items: center;
    background: #2f3e46;
    color: #fff;
    font-size: 13px;
    padding: 6px 14px;
    border-radius: 20px;
    margin-top: 10px;
    width: fit-content;
  }
  .withdrawn-pill::before {
    content: "−";
    /*display: inline-block;*/
    /* font-weight: bold; */
    margin-right: 6px;
    background: #ffffff;
    height: 16px;
    border-radius: 100%;
    width: 16px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #000000;
  }
  /* Info box */
  .withdrawn-info {
    background: #f1f1f1;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 12px;
    margin-top: 15px;
    color: #495057;
  }
  /* Timeline */
  .withdrawn-timeline {
    position: relative;
    margin-top: 20px;
    padding-left: 30px;
  }
  .withdrawn-timeline::before {
    content: "";
    position: absolute;
    left: 8px;
    top: 4px;
    bottom: 4px;
    width: 2px;
    background: #dee2e6;
  }
  .withdrawn-step {
    position: relative;
    margin-bottom: 22px;
    font-size: 12px;
    color: #212529;
  }
  .withdrawn-step:last-child {
    margin-bottom: 0;
  }
  .withdrawn-dot {
    position: absolute;
    left: -31px;
    top: 4px;
    width: 20px;
    height: 20px;
    background: #adb5bd;
    border-radius: 50%;
    border: 2px solid #fff;
    font-size: 12px;
  }
  .withdrawn-step small {
    font-size: 12px;
    color: #6c757d;
  }
  .withdrawn-step .withdrawn-date {
    float: right;
    font-size: 12px;
    color: #6c757d;
  }
  /* Withdrawn active step */
  .withdrawn-step.withdrawn-active .withdrawn-dot {
    background: #2f3e46;
  }
  .withdrawn-label {
    background: #2f3e46;
    color: #fff;
    font-size: 12px;
    padding: 4px 12px;
    border-radius: 20px;
    margin-right: 8px;
  }
  /* Job Card */
  .withdrawn-card {
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 16px;
    margin-top: 22px;
    font-size: 12px;
  }
  .withdrawn-card .withdrawn-status {
    background: #2f3e46;
    color: #fff;
    font-size: 11px;
    padding: 3px 8px;
    border-radius: 12px;
    margin-left: 10px;
  }
  .withdrawn-card hr {
    margin: 12px 0;
  }
  .withdrawn-card a {
    display: block;
    text-align: center;
    color: #007bff;
    font-weight: 500;
    text-decoration: none;
  }
  /* Footer */
  .withdrawn-footer {
    margin-top: 15px;
    /*display: flex;
      justify-content: flex-end;*/
  }
  .withdrawn-footer .btn {
    border-radius: 8px;
    padding: 6px 18px;
  }
  /*new */
  /* Make circle center content */
  .withdrawn-dot {
    display: flex;
    align-items: center;
    justify-content: center;
  }
  /* Hide icon by default */
  .withdrawn-dot i {
    display: none;
    color: #fff;
    font-size: 8px;
  }
  /* Show check for completed steps */
  .withdrawn-step.completed .withdrawn-dot {
    background: #6c757d;
  }
  .withdrawn-step.completed .withdrawn-dot i {
    display: block;
  }
  /*archived reject modal */
  /* Modal width like mobile design */
  .rejected-modal .modal-dialog {
    max-width: 580px;
  }
  .rejected-modal .modal-content {
    border-radius: 12px;
    padding: 20px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  }
  /* Header */
  .rejected-header {
    text-align: center;
    font-weight: 600;
    font-size: 18px;
    position: relative;
  }
  .rejected-header .close {
    position: absolute;
    right: 0;
    top: 0;
  }
  /* Title */
  .rejected-title {
    font-size: 18px;
    font-weight: 600;
    /*margin-top: 15px;*/
  }
  /* Status pill */
  .rejected-pill {
    display: inline-flex;
    align-items: center;
    background: #ef4444;
    color: #fff;
    font-size: 12px;
    padding: 3px 14px;
    border-radius: 20px;
    margin-top: 10px;
    width: fit-content;
  }
  .rejected-pill i {
    margin-right: 6px;
  }
  /* Rejected message box */
  .rejected-alert {
    background: #fdecea;
    padding: 15px;
    border-radius: 8px;
    margin-top: 15px;
  }
  .rejected-alert p {
    font-size: 12px;
    line-height: normal;
  }
  .rejected-alert strong {
    display: block;
    margin-bottom: 5px;
  }
  /* Timeline */
  .rejected-timeline {
    position: relative;
    margin-top: 20px;
    padding-left: 30px;
  }
  .rejected-timeline::before {
    content: "";
    position: absolute;
    left: 8px;
    top: 4px;
    bottom: 4px;
    width: 2px;
    background: #dee2e6;
  }
  .rejected-step {
    position: relative;
    margin-bottom: 20px;
    font-size: 12px;
  }
  .rejected-step:last-child {
    margin-bottom: 0;
  }
  .rejected-dot {
    position: absolute;
    left: -31px;
    top: 3px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #adb5bd;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .rejected-step.completed .rejected-dot {
    background: #6c757d;
  }
  .rejected-step.completed .rejected-dot i {
    color: #fff;
    font-size: 10px;
  }
  .rejected-step.rejected-active .rejected-dot {
    background: #ef4444;
  }
  .rejected-step.rejected-active .rejected-dot i {
    color: #fff;
    font-size: 10px;
  }
  .rejected-date {
    float: right;
    font-size: 12px;
    color: #6c757d;
  }
  /* Job Card */
  .rejected-card {
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 15px;
    margin-top: 20px;
    font-size: 12px;
  }
  .rejected-status {
    background: #ef4444;
    color: #fff;
    font-size: 11px;
    padding: 3px 8px;
    border-radius: 12px;
    margin-left: 6px;
  }
  .rejected-card a {
    display: block;
    text-align: center;
    color: #007bff;
    margin-top: 10px;
    font-weight: 500;
    text-decoration: none;
  }
  /* Footer */
  .rejected-footer {
    margin-top: 15px;
  }
  .rejected-footer btn {
    font-size: 12px;
  }
  /*archived hired modal */
  /* Modal width */
  .hired-modal .modal-dialog {
    max-width: 580px;
  }
  .hired-modal .modal-content {
    border-radius: 12px;
    padding: 20px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  }
  /* Header */
  .hired-header {
    text-align: center;
    font-weight: 600;
    font-size: 18px;
    position: relative;
  }
  .hired-header .close {
    position: absolute;
    right: 0;
    top: 0;
  }
  /* Title */
  .hired-title {
    font-size: 18px;
    font-weight: 600;
  }
  /* Purple pill */
  .hired-pill {
    display: inline-block;
    background: #8b5cf6;
    color: #fff;
    font-size: 13px;
    padding: 3px 16px;
    border-radius: 20px;
    margin-top: 10px;
    width: fit-content;
  }
  /* Message box */
  .hired-alert {
    background: #f2ecfb;
    padding: 15px;
    border-radius: 8px;
    margin-top: 15px;
  }
  .hired-alert p {
    font-size: 12px;
    line-height: normal;
  }
  .hired-alert strong {
    display: block;
    margin-bottom: 5px;
  }
  /* Timeline */
  .hired-timeline {
    position: relative;
    margin-top: 20px;
    padding-left: 30px;
  }
  .hired-timeline::before {
    content: "";
    position: absolute;
    left: 8px;
    top: 4px;
    bottom: 4px;
    width: 2px;
    background: #dee2e6;
  }
  .hired-step {
    position: relative;
    margin-bottom: 18px;
    font-size: 12px;
  }
  .hired-dot {
    position: absolute;
    left: -31px;
    top: 3px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 10px;
  }
  .dot-green {
    background: #22c55e;
  }
  .dot-orange {
    background: #f59e0b;
  }
  .dot-blue {
    background: #2563eb;
  }
  .hired-date {
    float: right;
    font-size: 12px;
    color: #6c757d;
  }
  /* Job Card */
  .hired-card {
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 15px;
    margin-top: 20px;
    font-size: 12px;
  }
  .hired-status {
    background: #8b5cf6;
    color: #fff;
    font-size: 11px;
    padding: 3px 8px;
    border-radius: 12px;
  }
  /* Buttons */
  /*.hired-actions {
      margin-top: 15px;
    }*/
  .hired-actions .btn {
    font-size: 12px !important;
    padding: 10px 25px;
  }
  .hired-actions .btn-primary {
    background: #2563eb;
    border: none;
  }
  .hired-footer .btn {
    font-size: 12px;
    padding: 10px 25px;
  }
</style>
@endsection
@section('content')
<main class="main">
  <section class="section-box mt-0">
    <div class="row m-0 profile-wrapper">
      <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">
        @include('nurse.layouts.career_sidebar')
      </div>
      <main class="main">
        <section class="section-box mt-0">
          <div class="row m-0 profile-wrapper">
            {{-- LEFT SIDEBAR --}}
            <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">
              @include('nurse.layouts.career_sidebar')
            </div>
            {{-- RIGHT CONTENT --}}
            <div class="container mt-5 pl-370 application">
              <!-- Header Row -->
              <div class="d-flex align-items-center mb-3 ">
                <h4 class="mb-0">Applications</h4>
                <!-- Tabs -->
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#active">
                      Active
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#archived">
                      Archived <span class="badge badge-light ml-1 under-review">12</span>
                    </a>
                  </li>
                </ul>
              </div>
              <!-- Tab Content (FULL WIDTH) -->
              <div class="tab-content">
                <!-- Active Tab -->
                <div class="tab-pane fade show active" id="active">
                  <!-- Filters row (optional) -->
                  <div class="d-flex w-100 align-items-center mb-3 gap-4">
                    <!-- Left Filters -->
                    <div class="d-flex align-items-center filter-border w-100">
                      <!-- Status Dropdown -->
                      <div class="dropdown mr-2 filter-item">
                        <button class="btn btn-light dropdown-toggle filter-btn" data-toggle="dropdown">
                          <span class=""><i class="fas fa-search"></span></i> Status
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item status-filter" data-value="Under Review">Under Review</a>
                          <a class="dropdown-item status-filter" data-value="Interview Scheduled">Interview Scheduled</a>
                          <a class="dropdown-item status-filter" data-value="Offer">Offer
                          </a>
                          <a class="dropdown-item status-filter" data-value="Conditional Offer">Conditional Offer</a>
                          <a class="dropdown-item status-filter" data-value="Shortlisted">Shortlisted</a>
                          <a class="dropdown-item status-filter" data-value="Submitted">Submitted</a>
                          <a class="dropdown-item status-filter" data-value="">All</a>
                        </div>
                      </div>
                      <!-- Date Dropdown -->
                    <div class="mr-2 filter-item">
                        {{-- <label for="dateFilter"><i class="far fa-calendar-alt mr-1"></i> Date Filter:</label> --}}
                        <select id="dateFilter" class="form-control filter-btn">
                            <option value="">All</option>
                            <option value="7">Last 7 Days</option>
                            <option value="30">Last 30 Days</option>
                            <option value="180">Last 6 Months</option>
                        </select>
                    </div>


                      <!-- Search -->
                      <div class="position-relative mr-2 filter-item">
                        <i class="fas fa-search search-icon"></i>
                       {{-- <input type="text" id="customSearch" class="form-control search-input" placeholder="Search..." /> --}}
                       <input type="text" id="customSearch" placeholder="Search...">

                      </div>
                    </div>
                    <!-- Clear Filters -->
                    <div class="filter-border pt-7">
                      <button id="clearFilters"
                        class="btn btn-light filter-btn d-flex align-items-center w-100 whitespace-nowrap filter-btn gap-4">
                        <span class="d-flex gap-2"> <i class="fas fa-sliders-h mr-1"></i> Clear
                          Filters</span>                 
                      </button>
                    </div>
                  </div>
                  <!-- Table -->
                  <div class="application-table">
                    {{-- <table class="table  bg-white"> --}}
                      {{-- <table id="applicationsTable" class="table bg-white"> --}}
                        <table id="applicationsTable" class="table table-bordered bg-white">

                      <thead>
                        <tr>
                          <th>Job Title</th>
                          <th>Facility</th>
                          <th>Type</th>
                          <th>Status</th>
                          <th>Date Applied </th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody >
                        @foreach ($active_list as $list)
                        <tr>
                          <td>
                            <p class="table-nurse-head"> {{ $list->job_title }}</p>
                          </td>
                          <td>
                            <p class="table-nurse-head"> {{ $list->job->health_careName ?? "N/A"}}</p>
                          </td>
                          <td>
                            <p class="table-nurse-head"> {{ implode(', ', $list->job->shift_names ?? "N/A") }}</p>
                          </td>
                          <td>
                            <span class="status-badge {{ $list->status_key }} active-status-modal"
                              data-id="{{ $list->id }}" data-toggle="modal" data-target="#underReviewModal">
                              {{ $list->status_label }}
                            </span>
                          </td>
                          <td>
                            <p>{{ \Carbon\Carbon::parse($list->applied_at)->format('j M Y') }}
                            </p>
                          </td>
                          <td>
                            @switch($list->status)
                            @case(1)
                            {{-- submitted --}}
                            @case(2)
                            {{-- under_review --}}
                            @case(3)
                            {{-- shortlisted --}}
                            <button class="btn btn-outline-danger status-badge active-withdrawModal" data-toggle="modal"
                              data-id="{{ $list->id }}" data-target="#withdrawModal">
                              Withdraw
                            </button>
                            @break
                            @case(4)
                            {{-- interview_scheduled --}}
                            <button class="btn btn-outline-primary status-badge view-interview-details" data-toggle="modal" data-id="{{ $list->id }}"
                              data-target="#interviewProcessModal">
                              View Interview Details
                            </button>
                            @break
                            @case(6)
                            {{-- conditional_offer --}}
                            <button class="btn btn-outline-info status-badge view-offer" data-toggle="modal" data-id="{{ $list->id }}"
                              data-target="#offerReviewModal">
                              View Offer
                            </button>
                            @break
                            @case(7)
                            {{-- offer --}}
                            <button class="btn btn-outline-success status-badge accept-offer" data-id="{{ $list->id }}" data-toggle="modal"
                              data-target="#acceptOfferModal">
                              Accept Offer
                            </button>
                            @break
                            @default
                            <span class="text-muted">—</span>
                            @endswitch
                          </td>
                        </tr>
                        <!-- ----- -->
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>

                <!-- modal offer timeline -->
                <div class="modal right fade" id="underReviewModal" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!-- Header -->
                      <div class="modal-header">
                        <h5 class="modal-title">
                          <span id="modalTitle"></span><br>
                          <small class="text-muted" id="modalFacility"></small>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <!-- Body -->
                      <div class="modal-body">
                        <!-- Loader -->
                        <div id="modalLoader" class="text-center my-4" style="display:none;">
                          <span class="spinner-border spinner-border-sm"></span> Loading...
                        </div>
                        <!-- Status Alert (dynamic later if needed) -->
                        {{-- <div class="alert alert-warning" id="modalStatus">
                          <strong>Under Review</strong><br>
                          Your application is currently being reviewed.
                        </div> --}}
                        <div id="modalStatus">
                          <span id="modalStatusLabel"></span><br>
                          <span id="modalStatusDesc"></span>
                        </div>
                        <!-- Timeline -->
                        <div class="timeline" id="modalContent">
                          <!-- JS injects timeline here -->
                        </div>
                      </div>
                      <!-- Footer -->
                      <div class="modal-footer" id="modalFooter">
                        <!-- JS injects action buttons here -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Archived Tab -->
                <div class="tab-pane fade" id="archived">
                  <div class="d-flex w-100 align-items-center mb-3 gap-4">
                    <!-- Left Filters -->
                    <div class="d-flex align-items-center filter-border w-100">
                      <!-- Status Dropdown -->
                      <div class="dropdown mr-2 filter-item">
                        <button class="btn btn-light dropdown-toggle filter-btn" data-toggle="dropdown">
                          <span class=""><i class="fas fa-search"></span></i> Status
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item archieved-status-filter" data-value="Withdrawn">Withdrawn</a>
                          <a class="dropdown-item archieved-status-filter" data-value="Hired">Hired</a>
                          <a class="dropdown-item archieved-status-filter" data-value="Rejected">Rejected
                          </a>
                          <a class="dropdown-item archieved-status-filter" data-value="">All</a>
                        </div>
                      </div>
                      <!-- Date Dropdown -->
                      <div class="mr-2 filter-item">
                          <select id="archieved-dateFilter" class="form-control filter-btn">
                              <option value="">All</option>
                              <option value="7">Last 7 Days</option>
                              <option value="30">Last 30 Days</option>
                              <option value="180">Last 6 Months</option>
                          </select>
                      </div>
                      <!-- Search -->
                      <div class="position-relative mr-2 filter-item">
                        <i class="fas fa-search search-icon"></i>
                          <input type="text" id="arhcustomSearch" placeholder="Search...">
                      </div>
                    </div>
                    <!-- Clear Filters -->
                    <div class="filter-border pt-7">
                      <button id="arch-clearFilters"
                        class="btn btn-light filter-btn d-flex align-items-center w-100 whitespace-nowrap filter-btn gap-4">
                        <span class="d-flex gap-2"> <i class="fas fa-sliders-h mr-1"></i> Clear
                          Filters</span>
                      </button>
                    </div>
                  </div>
                  <!-- Table -->
                  <div class="application-table table-responsive">
                    {{-- <table class="table bg-white"> --}}
                    <table id="archievedTable" class="table table-bordered bg-white">
                      <thead>
                        <tr>
                          <th>Job Title</th>
                          <th>Facility</th>
                          <th>Type</th>
                          <th>Status</th>
                          <th>Date Applied </th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody class="table-bordered">
                        @foreach ($archived_list as $list)
                        <tr>
                          <td>
                            <p class="table-nurse-head">{{ $list->job_title }}</p>
                          </td>
                          <td>
                            <p class="table-nurse-head"> {{ $list->job->health_careName ?? "N/A"}}</p>
                          </td>
                          <td>
                            <p class="table-nurse-head"> {{ implode(', ', $list->job->shift_names) ?? "N/A" }}</p>
                          </td>
                          <td>
                            <span class="status-badge {{ $list->status_key }} open-status-modal archieved-modal archived-status-modal"
                              data-id="{{ $list->id }}" data-toggle="modal" data-target="#underArchievedModal">
                              {{ $list->status_label }}
                            </span>
                          </td>
                          <td>
                            <p>{{ \Carbon\Carbon::parse($list->applied_at)->format('j M Y') }}</p>
                          </td>
                          <!-- <td>
                              <button class="btn btn-outline-secondary status-badge"  data-toggle="modal"
                                data-target="#withdrawnStatusModal">
                                  View Details
                              </button>
                          </td> -->
                          <td>
                            @switch($list->status)
                            @case(8)
                            {{-- hired --}}
                            <button class="btn btn-outline-secondary status-badge archieved-hireed" data-toggle="modal" data-id="{{$list->id}}"
                              data-target="#hiredModal">
                              View Details
                            </button>
                            @break
                            @case(9)
                            {{-- rejected --}}
                            <button class="btn btn-outline-secondary status-badge archieved-rejected" data-toggle="modal" data-id="{{$list->id}}"
                              data-target="#rejectedModal">
                              View Details
                            </button>
                            @break
                            @case(11)
                            {{-- withdrawn --}}
                            <button class="btn btn-outline-secondary status-badge archieved-withdrawn" data-toggle="modal" data-id="{{$list->id}}"
                              data-target="#withdrawnStatusModal">
                              View Details
                            </button>
                            @break
                            @case(10)
                            {{-- declined --}}
                            <button class="btn btn-outline-secondary status-badge">
                              View Details
                            </button>
                            @break
                            @default
                            <span class="text-muted">—</span>
                            @endswitch
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>

                <!-- view interview details modal -->
                <div id="modalContainer"></div>              
                <!-- Right Side Modal -->
                <div class="modal right fade" id="underArchievedModal" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <div class="modal-header">
                        <h5 class="modal-title">
                          <span id="archJobTitle"></span><br>
                          <small class="text-muted" id="archFacility"></small>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <div class="modal-body">

                        <!-- Loader INSIDE modal -->
                        <div id="archModalLoader" class="text-center my-4" style="display:none;">
                          <span class="spinner-border spinner-border-sm"></span> Loading...
                        </div>

                        <!-- Status Alert -->
                        <div id="archStatusBox"></div>

                        <!-- Timeline -->
                        <div class="timeline" id="archTimeline"></div>

                      </div>

                      <div class="modal-footer" id="archFooter"></div>

                    </div>
                  </div>
                </div>
    
              </div>
            </div>
        </section>
      </main>
    </div>
  </section>
</main>

<!-- ----- -->
@endsection
@section('js')

<!-- DataTables CSS (put in your layout head if possible) -->
<link rel="stylesheet"
 href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- jQuery (ONLY if not already loaded in layout) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script src="{{ url('/public') }}/nurse/assets/js/jquery.ui.datepicker.monthyearpicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

{{-- @include('nurse.front_profile_js'); --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>

<script>


    var table; // 👈 Declare globally

    $(document).ready(function () {

        table = $('#applicationsTable').DataTable({
            pageLength: 10,
            pagingType: "simple",
            ordering: true,
            searching: true,
            info: true,
            lengthChange: false,
            dom: 'rtip',
            responsive: true
        });

        // 👇 Move this INSIDE ready
        $('#customSearch').on('keyup', function () {
            table.search(this.value).draw();
        });

    });

    $('.status-filter').on('click', function () {
        var status = $(this).data('value');
        table.column(3).search(status).draw();
    });

    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {

            var selectedRange = $('#dateFilter').val();
            if (!selectedRange) return true;

            var appliedDate = moment(data[4], "D MMM YYYY");
            var today = moment();

            if (selectedRange === '7') {
                return appliedDate.isAfter(today.clone().subtract(7, 'days'));
            }

            if (selectedRange === '30') {
                return appliedDate.isAfter(today.clone().subtract(30, 'days'));
            }

            if (selectedRange === '180') {
                return appliedDate.isAfter(today.clone().subtract(6, 'months'));
            }

            return true;
        }
    );

    $('#dateFilter').on('change', function () {
        table.draw();
    });
    
    $('#clearFilters').on('click', function () {

        $('#customSearch').val('');
        $('#dateFilter').val('');

        table.search('');
        table.columns().search('');
        table.draw();

    });


    var table1; // 👈 Declare globally

    $(document).ready(function () {

        table1 = $('#archievedTable').DataTable({
            pageLength: 10,
            pagingType: "simple",
            ordering: true,
            searching: true,
            info: true,
            lengthChange: false,
            dom: 'rtip',
            responsive: true
        });

        // 👇 Move this INSIDE ready
        $('#arhcustomSearch').on('keyup', function () {
            table1.search(this.value).draw();
        });

    });

    $('.archieved-status-filter').on('click', function () {
        var status1 = $(this).data('value');
        table1.column(3).search(status1).draw();
    });

    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {

            var selectedRange = $('#archieved-dateFilter').val();
            if (!selectedRange) return true;

            var appliedDate = moment(data[4], "D MMM YYYY");
            var today = moment();

            if (selectedRange === '7') {
                return appliedDate.isAfter(today.clone().subtract(7, 'days'));
            }

            if (selectedRange === '30') {
                return appliedDate.isAfter(today.clone().subtract(30, 'days'));
            }

            if (selectedRange === '180') {
                return appliedDate.isAfter(today.clone().subtract(6, 'months'));
            }

            return true;
        }
    );

    $('#archieved-dateFilter').on('change', function () {
        table1.draw();
    });
    
    $('#arch-clearFilters').on('click', function () {

        $('#arhcustomSearch').val('');
        $('#archieved-dateFilter').val('');

        table1.search('');
        table1.columns().search('');
        table1.draw();

    });
</script>
<script>
  $(document).on('click', '.archived-status-modal', function () {

    let applicationId = $(this).data('id');
 
    $('#archJobTitle, #archFacility').html('');
    $('#archStatusBox').html('');
    $('#archTimeline').html('');
    $('#archFooter').html('');

    
    $('#archModalLoader').show(); 
    $.ajax({
        url: "{{ url('/nurse/application-archived-timeline') }}",
        type: "GET",
        data: { application_id: applicationId },

        success: function (res) {
            $('#archModalLoader').hide(); 
            // Title
            $('#archJobTitle').text(res.job_title);
            $('#archFacility').text(res.facility);

            // Status Alert
            let statusHtml = `
                <div class="alert alert-${res.status.class}">
                    <strong>${res.status.label}</strong><br>
                    ${res.status.desc}
                </div>
            `;
            $('#archStatusBox').html(statusHtml);

            // Timeline
            let timelineHtml = '';

            res.timeline.forEach(item => {

                timelineHtml += `
                    <div class="timeline-item">
                        <span>
                            <strong>${item.title}</strong>
                            ${item.progress ? `<small>(${item.progress})</small>` : ''}
                        </span><br>

                        ${item.highlight ? `
                            <div class="progress-content">
                                <small>${item.desc}</small>
                                <p>${item.date}</p>
                            </div>
                        ` : `
                            <small>${item.desc}</small>
                            <p>${item.date}</p>
                        `}
                    </div>
                `;
            });

            $('#archTimeline').html(timelineHtml);

            // Footer Action (only if needed)
            if (res.action) {
                $('#archFooter').html(`
                    <button class="btn ${res.action.class} btn-block">
                        ${res.action.label}
                    </button>
                `);
            }

        }
    });
});

</script>
<script>
  $(document).on('click', '.active-status-modal', function () {
    let applicationId = $(this).data('id');
    $('#modalLoader').show();
    $('#modalTitle, #modalFacility, #modalContent, #modalFooter,#modalStatusLabel').html('');
    $.ajax({
        url: "{{ url('/nurse/application-timeline') }}",
        type: "GET",
        data: { application_id: applicationId },
        success: function (res) {
          console.log(res);
            $('#modalLoader').hide();
            $('#modalTitle').text(res.job_title);
            $('#modalFacility').text(res.facility);
            if (res.status) {
                $('#modalStatus')
                    .removeClass('d-none alert-primary alert-warning alert-info alert-success alert-secondary')
                    .addClass('alert alert-' + res.status.class);
                $('#modalStatusLabel').text(res.status.label);
                $('#modalStatusDesc').text(res.status.desc);
            }
            /* Timeline */
            let timeline_html = '';
            res.timeline.forEach(item => {
                timeline_html += `
                    <div class="timeline-item">
                        <strong>${item.title}</strong>
                        <p>${item.desc}</p>
                        <small>${item.date}</small>
                    </div>
                `;
            });
            $('#modalContent').html(timeline_html);
            /* Footer Action */
            if (res.action) {
                $('#modalFooter').html(`
                    <button 
                        class="btn ${res.action.class} btn-block modal-action-btn"
                        data-action="${res.action.type}"
                        data-id="${applicationId}">
                        ${res.action.label}
                    </button>
                `);
            }
        }
    });
  });
  $(document).on('click', '.modal-action-btn', function () {
      let action = $(this).data('action');
      let applicationId = $(this).data('id');
      if (action === 'withdraw') {
          if (!confirm('Are you sure you want to withdraw this application?')) return;
          // AJAX → withdraw endpoint
          console.log('Withdraw', applicationId);
      }
      if (action === 'interview') {
          window.location.href = `/nurse/interview/${applicationId}`;
      }
      if (action === 'offer_view') {
          window.location.href = `/nurse/offer/${applicationId}`;
      }
      if (action === 'offer_accept') {
          window.location.href = `/nurse/offer/${applicationId}/accept`;
      }
  });
</script>

<script>

      function showModalLoader(modalId) {
          $(modalId).find('.modal-loader').show();
          $(modalId).find('.modal-content-data').hide();
      }

      function hideModalLoader(modalId) {
          $(modalId).find('.modal-loader').hide();
          $(modalId).find('.modal-content-data').show();
      }
      $(document).on('click', '.view-interview-details', function () {

        let $btn = $(this); 
        $btn.prop('disabled', true);
        $('#view-interview-details').empty();
        $('#modalContainer').empty();
        let applicationId = $(this).data('id');

        let modal = '#interviewProcessModal';

         $('#globalLoader').show();
        // $(modal).modal('show');
        // showModalLoader(modal);
   

        $.ajax({
            url: "{{ url('/nurse/action-application') }}",
            type: "GET",
            data: { application_id: applicationId ,modal_no:"1"},
            success: function (response) {

                $('#modalContainer').empty();   // 🔥 prevent stacking
                $('#modalContainer').html(response);

                $('#interviewProcessModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            $(modal).modal('show');
            $btn.prop('disabled', false);
            // Now loader exists in DOM
            showModalLoader(modal);

            // Hide loader after slight delay (simulate processing)
            setTimeout(function () {
                hideModalLoader(modal);
            }, 300);
            }
        });
    });

    $(document).on('hidden.bs.modal', '#interviewProcessModal', function () {
        $(this).remove();
    });

</script>
<script>
      $(document).on('click', '.view-offer', function () {
        let $btn = $(this); 
        $btn.prop('disabled', true);
        let applicationId = $(this).data('id');

        let modal = '#offerReviewModal';
        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/nurse/action-application') }}",
            type: "GET",
            data: { application_id: applicationId ,modal_no:"2" },
            success: function (response) {

                $('#modalContainer').empty(); 
                $('#modalContainer').html(response);

                $('#offerReviewModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

            $(modal).modal('show');
            $btn.prop('disabled', false);
            // Now loader exists in DOM
            showModalLoader(modal);

            // Hide loader after slight delay (simulate processing)
            setTimeout(function () {
                hideModalLoader(modal);
            }, 300);
                // $('#offerReviewModal').modal('show');
            }
        });
    });

    $(document).on('hidden.bs.modal', '#offerReviewModal', function () {
        $(this).remove();
    });

</script>
<script>
      $(document).on('click', '.accept-offer', function () {
        let $btn = $(this); 
        $btn.prop('disabled', true);
        let applicationId = $(this).data('id');

        let modal = '#acceptOfferModal';
        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/nurse/action-application') }}",
            type: "GET",
            data: { application_id: applicationId ,modal_no:"3" },
            success: function (response) {

                $('#modalContainer').empty(); 
                $('#modalContainer').html(response);

                $('#acceptOfferModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $(modal).modal('show');
                $btn.prop('disabled', false);
                // Now loader exists in DOM
                showModalLoader(modal);

                // Hide loader after slight delay (simulate processing)
                setTimeout(function () {
                    hideModalLoader(modal);
                }, 300);
                // $('#acceptOfferModal').modal('show');
            }
        });
    });

    $(document).on('hidden.bs.modal', '#acceptOfferModal', function () {
        $(this).remove();
    });
</script>
<script>
      $(document).on('click', '.active-withdrawModal', function () {
        let applicationId = $(this).data('id');
         let $btn = $(this); 
        $btn.prop('disabled', true);

        let modal = '#withdrawModal';
        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/nurse/action-application') }}",
            type: "GET",
            data: { application_id: applicationId ,modal_no:"4" },
            success: function (response) {

                $('#modalContainer').empty(); 
                $('#modalContainer').html(response);

                $('#withdrawModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $(modal).modal('show');
                $btn.prop('disabled', false);
                // Now loader exists in DOM
                showModalLoader(modal);

                // Hide loader after slight delay (simulate processing)
                setTimeout(function () {
                    hideModalLoader(modal);
                }, 300);
                // $('#withdrawModal').modal('show');
            }
        });
    });

    $(document).on('hidden.bs.modal', '#withdrawModal', function () {
        $(this).remove();
    });
</script>
<script>
      $(document).on('click', '.archieved-withdrawn', function () {

        let $btn = $(this); 
        $btn.prop('disabled', true);
        let applicationId = $(this).data('id');

        let modal = '#withdrawnStatusModal';
        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/nurse/action-application') }}",
            type: "GET",
            data: { application_id: applicationId ,modal_no:"5" },
            success: function (response) {

                $('#modalContainer').empty(); 
                $('#modalContainer').html(response);

                $('#withdrawnStatusModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $(modal).modal('show');
                $btn.prop('disabled', false);
                // Now loader exists in DOM
                showModalLoader(modal);

                // Hide loader after slight delay (simulate processing)
                setTimeout(function () {
                    hideModalLoader(modal);
                }, 300);
                // $('#withdrawnStatusModal').modal('show');
            }
        });
    });

    $(document).on('hidden.bs.modal', '#withdrawnStatusModal', function () {
        $(this).remove();
    });
</script>
<script>
      $(document).on('click', '.archieved-rejected', function () {

        let applicationId = $(this).data('id');
        let $btn = $(this); 
        $btn.prop('disabled', true);

        let modal = '#rejectedModal';
        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/nurse/action-application') }}",
            type: "GET",
            data: { application_id: applicationId ,modal_no:"6" },
            success: function (response) {

                $('#modalContainer').empty(); 
                $('#modalContainer').html(response);

                $('#rejectedModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $(modal).modal('show');
                $btn.prop('disabled', false);
                // Now loader exists in DOM
                showModalLoader(modal);

                // Hide loader after slight delay (simulate processing)
                setTimeout(function () {
                    hideModalLoader(modal);
                }, 300);
                // $('#rejectedModal').modal('show');
            }
        });
    });

    $(document).on('hidden.bs.modal', '#rejectedModal', function () {
        $(this).remove();
    });
</script>
<script>
      $(document).on('click', '.archieved-hireed', function () {

        let applicationId = $(this).data('id');
        let $btn = $(this); 
        $btn.prop('disabled', true);

        let modal = '#hiredModal';
        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/nurse/action-application') }}",
            type: "GET",
            data: { application_id: applicationId ,modal_no:"7" },
            success: function (response) {

                $('#modalContainer').empty(); 
                $('#modalContainer').html(response);

                $('#hiredModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $(modal).modal('show');
                $btn.prop('disabled', false);
                // Now loader exists in DOM
                showModalLoader(modal);

                // Hide loader after slight delay (simulate processing)
                setTimeout(function () {
                    hideModalLoader(modal);
                }, 300);
                // $('#hiredModal').modal('show');
            }
        });
    });

    $(document).on('hidden.bs.modal', '#hiredModal', function () {
        $(this).remove();
    });
</script>
@endsection