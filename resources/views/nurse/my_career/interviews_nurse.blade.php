@extends('nurse.layouts.layout')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ url('/public') }}/nurse/assets/css/jquery.ui.datepicker.monthyearpicker.css">
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
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
        border-radius: 10px;
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

    /* ===== 23/02 ===== */
    /* .font-xs {
                                            font-size: 12px;
                                            } */
    .req-box-height {
        max-height: 485px;
        height: 100%;
        overflow-y: auto;
    }

    /* Cards */
    .req-box {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        /* padding: 20px; */
        margin-bottom: 20px;
        border: 1px solid #dee2e6;
    }

    /* Alert section */
    .req-alert {
        background: #f1f3f5;
        border-radius: 8px;
        padding: 15px 20px;
    }

    /* badge */
    .req-badge-warning {
        background: #ffe9d6;
        color: #ff7a00;
        font-size: 12px;
        padding: 4px 12px;
        border-radius: 10px;
    }

    /* Document list */
    .req-doc-row {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        gap: 10px;
    }

    .req-doc-row i:hover {
        color: #ffffff !important;
    }

    .req-doc-status {
        width: 16px;
        height: 16px;
        border-radius: 5px;
        margin-right: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 10px;
        color: #fff;
    }

    .req-doc-done {
        background: #28a745;
    }

    .req-doc-missing {
        background: #dc3545;
    }

    .text-black {
        color: #000;
    }

    /* Buttons */
    .req-btn-green {
        background: #1f8f4e;
        color: #fff;
        border: none;
        padding: 10px 25px;
        margin-top: 10px;
    }

    .req-btn-green:hover {
        background: #18733e;
        color: #fff;
    }

    .btn-sm-space {
        padding: 8px 25px;
        font-size: 12px;
    }

    /* Interview layout */
    .req-interview-flex {
        display: flex;
        align-items: center;
        padding: 16px;
    }

    .req-interview-img {
        width: 100px;
        height: 100px;
        border-radius: 8px;
        object-fit: cover;
        margin-right: 15px;
    }

    /* Center modal vertically */
    .modal-dialog-centered {
        display: flex;
        align-items: center;
        min-height: calc(100% - 1rem);
    }

    .uploas-docs {
        height: 500px;
        width: 100%;
    }

    .uploas-docs form {
        width: 100%;
    }

    .uploas-docs .form-group input {
        height: auto;
        padding: 5px 10px;
        border-radius: 10px;
        font-size: 13px;
    }

    /*interview css 12/02 */
    /* Desktop underline */
    @media (min-width: 768px) {
        .custom-tabs .nav-link.active::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 3px;
            background-color: #000;
            border-radius: 2px;
        }
    }

    /* Mobile stacked style */
    .custom-tabs {
        border-bottom: 1px solid #eee;
    }

    .custom-tabs .nav-link {
        border: none;
        color: #555;
        font-weight: 500;
        position: relative;
        padding: 10px 20px;
    }

    .custom-tabs .nav-link.active {
        color: #000;
        background: transparent;
    }

    @media (max-width: 767.98px) {
        .custom-tabs {
            border-bottom: none;
            border-right: 1px solid #eee;
        }

        .custom-tabs .nav-link {
            text-align: left;
            border-left: 3px solid transparent;
        }

        .custom-tabs .nav-link.active {
            border-left: 3px solid #000;
            background-color: #f8f9fa;
        }
    }

    /* Badge */
    .custom-badge {
        background-color: #ffc107;
        color: #000;
        font-size: 12px;
        padding: 3px 8px;
        border-radius: 20px;
        margin-left: 6px;
        font-weight: 600;
    }

    .custom-badge-orange {
        background: #f59e0b;
    }

    .custom-badge-purple {
        background: #8b5cf6;
    }

    /*upcoming table css */
    .card-custom {
        border-radius: 10px;
        border: 1px solid #e5e5e5;
    }

    .upcoming-table .table th {
        font-weight: 600;
        font-size: 14px;
        color: #374151;
        border-top: none;
    }

    .upcoming-table .table td {
        /*vertical-align: middle;*/
        font-size: 14px;
    }

    .sub-text {
        font-size: 13px;
        color: #6c757d;
    }

    .badge-scheduled {
        background-color: #f4a261;
        color: #fff;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
    }

    .badge-confirmed {
        background-color: #6f42c1;
        color: #fff;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-light-outline {
        background: #fff;
        border: 1px solid #ced4da;
    }

    .btn-light-outline:hover {
        background: #f8f9fa;
    }

    .table-responsive {
        border-radius: 10px;
    }

    .note-box {
        background: #f1f3f5;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 13px;
        margin-top: 8px;
    }

    .color-black {
        color: #000000;
    }

    .text-14 {
        font-size: 14px;
    }

    .text-12 {
        font-size: 12px;
    }

    .btn-blue {
        background: #3b82f6;
    }

    footer {
        position: fixed;
        width: 100%;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 9;
    }

    .sidebar_profile {
        z-index: 99;
    }

    .main {
        padding-bottom: 100px;
    }

    /*calender css 13/02 */
    .calendar-wrapper {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .summary-box {
        background: #fff;
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        font-size: 14px;
    }

    .status-dot {
        height: 10px;
        width: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }

    .confirmed {
        background: #00A81C;
    }

    .scheduled {
        background: #DB6E00;
    }

    .selected {
        background: #009BFA;
    }

    .awaiting_feedback {
        background: #800080;
    }

    .rejected {
        background: #DC3545;
    }

    .fc-button {
        background-color: #2c3e50 !important;
        border: none !important;
    }

    .fc-button-active {
        background-color: #009BFA !important;
    }

    .fc-day-today {
        background-color: #eaf4ff !important;
    }

    @media (max-width: 768px) {
        .fc-toolbar {
            flex-direction: column;
            gap: 10px;
        }

        .fc-toolbar-title {
            font-size: 16px;
        }

        .fc-button {
            font-size: 12px !important;
            padding: 4px 6px !important;
        }
    }

    /*----- */
    .clock-icon {
        font-size: 8px;
    }

    .pl-1 {
        padding-left: 4px;
    }

    .w-fit {
        width: fit-content;
    }

    .p-1 {
        padding: 4px;
    }

    .btn-xs {
        padding: 8px;
        font-size: 12px;
    }

    .lhn {
        line-height: normal;
    }

    /*schedule button modal css */
    /* modal container */
    .schedmdl-wrapper .schedmdl-content {
        border-radius: 10px;
        border: none;
    }

    /* title */
    .schedmdl-title {
        font-weight: 600;
    }

    /* steps */
    .schedmdl-steps {
        font-size: 13px;
        color: #9aa0a6;
    }

    .schedmdl-steps span {
        margin-right: 14px;
    }

    .schedmdl-active {
        color: #f39c12;
        font-weight: 600;
    }

    /* hospital image */
    .schedmdl-img {
        width: 60px;
        height: 60px;
        border-radius: 6px;
        object-fit: cover;
    }

    /* right cards */
    .schedmdl-card {
        /*background:#f8f9fb;*/
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 12px;
    }

    /* badge */
    .schedmdl-badge {
        background: #fff3e6;
        color: #c87a1a;
        padding: 0px 12px;
        border-radius: 6px;
        font-size: 10px;
        display: inline-block;
    }

    /* notes */
    .schedmdl-note {
        /*border:1px solid #e5e5e5;*/
        border-radius: 8px;
        /*padding:12px;*/
        background: #fff;
    }

    /* mobile responsive */
    @media(max-width:768px) {
        .schedmdl-steps span {
            display: block;
            margin-bottom: 4px;
        }

        .schedmdl-img {
            width: 50px;
            height: 50px;
        }
    }

    /* wrapper */
    .schedstep-wrapper {
        display: flex;
        align-items: center;
        position: relative;
        border-bottom: 1px solid #e5e5e5;
        padding-bottom: 6px;
        flex-wrap: wrap;
    }

    /* each step */
    .schedstep-item {
        display: flex;
        align-items: center;
        margin-right: 30px;
        cursor: pointer;
        position: relative;
        color: #9aa0a6;
        font-size: 14px;
    }

    /* hide real radio */
    .schedstep-item input {
        display: none;
    }

    /* circle */
    .schedstep-circle {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #d6d9dd;
        margin-right: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 8px;
        color: #fff;
        font-weight: 600;
        transition: .3s;
    }

    /* ACTIVE STEP */
    .schedstep-item input:checked+.schedstep-circle {
        background: #f39c12;
    }

    /* active text */
    .schedstep-item input:checked+.schedstep-circle+.schedstep-label {
        color: #f39c12;
        font-weight: 600;
    }

    .schedstep-label {
        font-size: 12px;
    }

    /* underline indicator */
    .schedstep-item input:checked {
        position: relative;
    }

    .schedstep-item input:checked+.schedstep-circle::after {
        content: "";
        position: absolute;
        bottom: -12px;
        left: 0;
        width: 100%;
        height: 2px;
        background: #333;
    }

    /* responsive */
    @media(max-width:768px) {
        .schedstep-wrapper {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
    }

    .booking-toggle-wrapper {
        background: #f3f4f7;
        padding: 12px 16px;
        border-radius: 10px;
    }

    /* Hide checkbox */
    .toggle-switch input {
        display: none;
    }

    /* Toggle container */
    .toggle-switch {
        position: relative;
        width: 42px;
        height: 22px;
        display: inline-block;
    }

    /* Track */
    .toggle-slider {
        position: absolute;
        cursor: pointer;
        background-color: #ccc;
        border-radius: 20px;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        transition: 0.3s;
    }

    /* Circle */
    .toggle-slider::before {
        content: "";
        position: absolute;
        height: 18px;
        width: 18px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        border-radius: 50%;
        transition: 0.3s;
    }

    /* Active state */
    .toggle-switch input:checked+.toggle-slider {
        background-color: #007bff;
    }

    .toggle-switch input:checked+.toggle-slider::before {
        transform: translateX(20px);
    }

    .onsite_bg {
        background: #f8f9fb;
    }

    .schedmdl-card ul li {
        position: relative;
        padding-left: 12px;
        line-height: normal;
        font-size: 10px;
    }

    .schedmdl-card ul li::after {
        content: '';
        position: absolute;
        width: 8px;
        height: 8px;
        background: #d6d9dd;
        left: 0;
        top: 3px;
        border-radius: 100%;
    }

    .dot-orange {
        background-color: orange;
    }

    .dot-blue {
        background-color: #007bff;
    }

    .dot-purple {
        background-color: purple;
    }

    .dot-green {
        background-color: green;
    }

    .dot-red {
        background-color: red;
    }

    .dot-gray {
        background-color: gray;
    }

    .dot-dark {
        background-color: #343a40;
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
            <!-- Right section  -->
            <div class="container mt-5 pl-370">
                <div>
                    <ul class="nav custom-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#actionTab">
                                Action Needed
                                <span class="custom-badge custom-badge-orange text-white">1</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#upcomingTab">
                                Upcoming
                                <span class="custom-badge custom-badge-purple text-white">2</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#pastTab">
                                Past
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content mt-4">
                        <div class="tab-pane fade show active" id="actionTab">
                            <div class="row">
                                <div class="req-wrapper">
                                    <div class="mt-4">
                                        <!-- SECTION 1 -->
                                        <div class="req-alert mb-3">
                                            <strong>You have items requiring action.</strong><br>
                                            <small class="text-12">Complete the required tasks before your interview or offer can proceed.</small>
                                        </div>
                                        <!-- SECTION 2 : DOCUMENTS -->
                                        @foreach ($action_needed as $action_list)
                                        @if($action_list->job->documents_required != null)                        
                                        <div class="req-box-height">
                                            <div class="req-box p-4">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h5 class="mb-0">
                                                        <span><i class="fa fa-file-text" aria-hidden="true"></i></span>
                                                        Documents Required
                                                    </h5>
                                                    <span class="req-badge-warning">
                                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                        Required before <span class="text-dark">Conditional Offer</span>
                                                    </span>
                                                </div>
                                                <p class="text-dark">
                                                    <strong class="font-weight-bold">{{$action_list->health_care->name}}</strong>
                                                    requires you to provide these documents.
                                                </p>
                                                <div class="p-3 border rounded mt-4">
                                                    <div class="row">
                                                        @foreach ($document_list as $action_document_list )

                                                        <div class="col-md-8">
                                                            <a href="{{ url('public/uploads/needed_document/'.$action_document_list->document_path) }}" target="_blank" class="req-doc-name">
                                                                {{ $action_document_list->name }}
                                                            </a>
                                                            <!-- Delete File -->
                                                        <a href="javascript:void(0);" class="req-doc-edit text-danger" data-docname="{{ $action_document_list->name }}"
                                                            data-employer="{{ $action_list->employer_id }}" data-name="{{ $action_list->name }}"
                                                            data-toggle="modal" data-target="#reqUploadModal">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            
                                  
                                            <!-- SECTION 3 : INTERVIEW -->
                                    
                                            <div class="req-box">
                                                <div class="req-interview-flex">
                                                    @php
                                                    $profileImg = $action_list->health_care->profile_img;
                                                    $defaultImg = asset('nurse/assets/imgs/nurse06.png');
                                                    @endphp

                                                    @if (!empty($profileImg))
                                                    {{-- Show uploaded image --}}
                                                    <img src="{{ asset($profileImg) }}" class="req-interview-img">
                                                    @else
                                                    {{-- Show default image --}}
                                                    <img src="{{ $defaultImg }}" class="req-interview-img">
                                                    @endif
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">
                                                            Confirm Interview
                                                        </h6>
                                                        <h6 class="text-14">
                                                            {{ $action_list->job->job_title }}
                                                        </h6>
                                                        @php
                                                        $start = \Carbon\Carbon::parse(
                                                        $action_list->scheduled_at,
                                                        );
                                                        $end = $start
                                                        ->copy()
                                                        ->addMinutes($action_list->duration_minutes);
                                                        @endphp
                                                        <small class="text-muted d-block text-12 d-flex gap-1">
                                                            <span class="mr-2"><i class="fa fa-calendar-o" aria-hidden="true"></i></span>
                                                            {{-- 23 Feb • 11:24 AM --}}
                                                            <span>{{
                                                                \Carbon\Carbon::parse($action_list->scheduled_at)->format('d
                                                                M Y') }}</span>
                                                            <span>{{ $start->format('h:i A') }} -
                                                                {{ $end->format('h:i A') }}</span>
                                                        </small>
                                                        <small class="text-muted d-block text-12 d-flex gap-1">
                                                            <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                                            {{ $action_list->location_address }}
                                                        </small>
                                                        <small class="text-muted d-block mb-2 text-12 d-flex gap-1">
                                                            Meeting type : <span><i aria-hidden="true"></i></span>
                                                            {{ $action_list->meeting_type_label }}
                                                        </small>
                                                    </div>
                                                    <div class="d-flex flex-column gap-2">
                                                        <a href="#" class="req-badge-warning ml-3 d-flex gap-3">
                                                            <span data-schedule="{{ \Carbon\Carbon::parse($action_list->scheduled_at)->timezone(config('app.timezone'))->format('Y-m-d\TH:i:s') }}" class="countdown"></span>
                                                            {{-- <span>
                                                                Starts in <span class="text-black text-12">3 Days
                                                                    17h
                                                                    16m</span>
                                                            </span> --}}
                                                            <span class="text-black"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                                        </a>
                                                        <button class="btn btn-primary btn-sm-space">
                                                            Confirm Attendance
                                                        </button>
                                                        <button class="btn btn-outline-secondary btn-sm-space">
                                                            Request Reschedule
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade uploas-docs" id="reqUploadModal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <form id="upload-document" enctype="multipart/form-data">
                                    @csrf     
                                    <input type="hidden" name="employer_id" id="modal_employer_id">
                                    <input type="hidden" name="document_name" id="modal_document_name">                  
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Upload Documents</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- <div class="form-group">
                                                <label>Name of Document</label>
                                                <input type="text" name="document_name" placeholder="Resume,Police Clearance,NDIS Check " id="">
                                            </div> --}}
                                            <div class="form-group">
                                                <label>Upload Documents</label>
                                                <input type="file" name="document_file" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-sm btn-success">Upload
                                                Documents</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- upcoming tab  -->
                        <div class="tab-pane fade" id="upcomingTab">
                            <!-- filter  -->
                            <div class="row align-items-center mt-4">
                                <div class="col-12 col-lg-9 mb-3 mb-lg-0">
                                    <div class="d-flex flex-column filter-border flex-md-row">
                                        <div class="dropdown mb-md-0 mr-md-2 filter-item">
                                            <button class="btn dropdown-toggle w-100 filter-btn pt-7" data-toggle="dropdown">
                                                <i class="fas fa-search mr-1"></i> Status
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item status-filter" data-value="Confirmed">Confirmed</a>
                                                <a class="dropdown-item status-filter" data-value="Scheduled">Scheduled</a>
                                                <a class="dropdown-item status-filter" data-value="Reschedule Requested">Reschedule Requested</a>
                                                <a class="dropdown-item status-filter" data-value="Cancelled">Cancelled</a>
                                                <a class="dropdown-item status-filter" data-value="Completed">Completed</a>
                                                <a class="dropdown-item status-filter" data-value="">All</a>
                                            </div>
                                        </div>
                                        <div class="dropdown mb-md-0 mr-md-2 filter-item">
                                            <select id="dateFilter" class="form-control filter-btn">
                                                <option value="">All</option>
                                                <option value="7">Last 7 Days</option>
                                                <option value="30">Last 30 Days</option>
                                                <option value="180">Last 6 Months</option>
                                            </select>
                                        </div>
                                        <div class="position-relative flex-fill filter-item">
                                            <i class="fas fa-search position-absolute search-icon"></i>
                                            <input type="text" id="customSearch" class="form-control pl-4" placeholder="Search..." />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 filter-border pt-7">
                                    <button id="clearFilters" class="btn btn-light d-flex justify-content-between align-items-center w-100 filter-btn">
                                        <span>
                                            <i class="fas fa-sliders-h mr-1"></i> Clear Filters
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <!-- ----- -->
                            <!-- upcoming  -->
                            <div class="card p-3 mt-2 border-0">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0 font-weight-bold">Upcoming Interviews</h5>
                                </div>
                                <div class="table-responsive upcoming-table">
                                    <table id="upComingTable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Job Title</th>
                                                <th>Date & Time</th>
                                                <th>Location/Mode</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($upcoming_list as $current_list)
                                            <tr>
                                                <td>
                                                    <div>
                                                        <p class="color-black">{{ $current_list->job->job_title }}
                                                        </p>
                                                        {{-- <p>Canberra General Hospital</p>
                                                        <p class="text-12">+61 2 5515 3333</p>
                                                        <p class="text-12">sally.field@canberrahospital.au</p> --}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="color-black">
                                                        {{ \Carbon\Carbon::parse($current_list->scheduled_at)->format('d
                                                        M Y') }}
                                                    </p>
                                                    @php
                                                    $start = \Carbon\Carbon::parse(
                                                    $current_list->scheduled_at,
                                                    );
                                                    $end = $start
                                                    ->copy()
                                                    ->addMinutes($current_list->duration_minutes);
                                                    @endphp
                                                    <p class="color-black">{{ $start->format('h:i A') }} -
                                                        {{ $end->format('h:i A') }}</p>
                                                    <p class="text-12 p-0">
                                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                        <span class="pl-1">{{ $current_list->health_care->home_address
                                                            }}</span>
                                                    </p>
                                                    <p class="text-12 p-0">
                                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                        <span class="pl-1">{{ $current_list->health_care->email
                                                            }}</span>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="color-black">{{ $current_list->location_address }}
                                                    </p>
                                                    <p class="color-black">
                                                        {{ $current_list->meeting_type_label }}
                                                        <span><i class="fa fa-file-text pl-1" aria-hidden="true"></i></span>
                                                        <span><i class="fa fa-file-o pl-1" aria-hidden="true"></i></span>
                                                    </p>
                                                </td>
                                                @php
                                                $statusMap = [
                                                1 => ['label' => 'Scheduled', 'class' => 'dot-orange'],
                                                2 => [
                                                'label' => 'Reschedule Requested',
                                                'class' => 'dot-blue',
                                                ],
                                                3 => ['label' => 'Confirmed', 'class' => 'dot-purple'],
                                                4 => ['label' => 'Completed', 'class' => 'dot-green'],
                                                5 => ['label' => 'No Show', 'class' => 'dot-red'],
                                                6 => ['label' => 'Cancelled', 'class' => 'dot-gray'],
                                                ];
                                                $status = $statusMap[$current_list->status] ?? [
                                                'label' => 'Unknown',
                                                'class' => 'dot-dark',
                                                ];
                                                @endphp
                                                <td>
                                                    <button class="btn btn-xs text-white rounded  cursor-pointer active-status-moda {{ $status['class'] }}">
                                                        {{ $status['label'] }}
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">

                                                        @if($current_list->status == 1)
                                                        {{-- Scheduled --}}
                                                        <button class="btn btn-xs mb-1 btn-blue text-white action-modal" data-id="{{ $current_list->id }}">
                                                            Confirm Attendance
                                                        </button>

                                                        <button class="btn btn-xs btn-outline-secondary mb-1 action-modal" data-id="{{ $current_list->id }}">
                                                            Request Reschedule
                                                        </button>

                                                        <button class="btn btn-xs btn-outline-danger cancel-interview" data-id="{{ $current_list->id }}">
                                                            Cancel Interview
                                                        </button>

                                                        @elseif($current_list->status == 2)
                                                        {{-- Reschedule Requested --}}
                                                        <button class="btn btn-xs mb-1 btn-warning text-white" disabled>
                                                            Reschedule Requested
                                                        </button>

                                                        <button class="btn btn-xs btn-outline-danger cancel-interview" data-id="{{ $current_list->id }}">
                                                            Cancel Interview
                                                        </button>

                                                        @elseif($current_list->status == 3)
                                                        {{-- Confirmed --}}
                                                        <span class="badge bg-success mb-1">Confirmed</span>

                                                        <button class="btn btn-xs btn-outline-danger cancel-interview" data-id="{{$current_list->id }}"> Cancel Interview</button>
                                                        @elseif($current_list->status == 4)
                                                        <span class="badge bg-primary">Completed</span>

                                                        @elseif($current_list->status == 5)
                                                        <span class="badge bg-danger">No Show</span>

                                                        @elseif($current_list->status == 6)
                                                        <span class="badge bg-secondary">Cancelled</span>
                                                        @endif

                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="modalContainer"></div>
                        <!-- past tab  -->
                        <div class="tab-pane fade" id="pastTab">
                            <!-- <p>past content goes here...</p> -->
                            <!-- filter -->
                            <div class="row align-items-center mt-4">
                                <div class="col-12 col-lg-9 mb-3 mb-lg-0">
                                    <div class="d-flex flex-column filter-border flex-md-row">
                                        <div class="dropdown mb-md-0 mr-md-2 filter-item">
                                            <button class="btn dropdown-toggle w-100 filter-btn pt-7" data-toggle="dropdown">
                                                <i class="fas fa-search mr-1"></i> Status
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item past-status-filter" data-value="Confirmed">Confirmed</a>
                                                <a class="dropdown-item past-status-filter" data-value="Scheduled">Scheduled</a>
                                                <a class="dropdown-item past-status-filter" data-value="Reschedule Requested">Reschedule Requested</a>
                                                <a class="dropdown-item past-status-filter" data-value="Cancelled">Cancelled</a>
                                                <a class="dropdown-item past-status-filter" data-value="Completed">Completed</a>
                                                <a class="dropdown-item past-status-filter" data-value="">All</a>
                                            </div>
                                        </div>
                                        <div class="dropdown mb-md-0 mr-md-2 filter-item">
                                            <select id="pastdateFilter" class="form-control filter-btn">
                                                <option value="">All</option>
                                                <option value="7">Last 7 Days</option>
                                                <option value="30">Last 30 Days</option>
                                                <option value="180">Last 6 Months</option>
                                            </select>
                                        </div>
                                        <div class="position-relative flex-fill filter-item">
                                            <i class="fas fa-search position-absolute search-icon"></i>
                                            <input type="text" id="pastCustomSearch" class="form-control pl-4" placeholder="Search..." />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 filter-border pt-7">
                                    <button id="pastclearFilters" class="btn btn-light d-flex justify-content-between align-items-center w-100 filter-btn">
                                        <span>
                                            <i class="fas fa-sliders-h mr-1"></i> Clear Filters
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="table-responsive upcoming-table">
                                    <table id="pastTable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Job Title</th>
                                                <th>Date & Time</th>
                                                <th>Location/Mode</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($past_list as $past_show)
                                            <tr>
                                                <td>
                                                    <div>
                                                        <p class="color-black">{{ $past_show->job->job_title }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="color-black">
                                                        {{ \Carbon\Carbon::parse($past_show->scheduled_at)->format('d M
                                                        Y') }}
                                                    </p>
                                                    @php
                                                    $start = \Carbon\Carbon::parse(
                                                    $past_show->scheduled_at,
                                                    );
                                                    $end = $start
                                                    ->copy()
                                                    ->addMinutes($past_show->duration_minutes);
                                                    @endphp
                                                    <p class="color-black">{{ $start->format('h:i A') }} -
                                                        {{ $end->format('h:i A') }}</p>
                                                    <p class="text-12 p-0">
                                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                        <span class="pl-1">{{ $past_show->health_care->home_address
                                                            }}</span>
                                                    </p>
                                                    <p class="text-12 p-0">
                                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                        <span class="pl-1">{{ $past_show->health_care->email }}</span>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="color-black">{{ $past_show->location_address }}</p>
                                                    <p class="color-black">
                                                        {{ $past_show->meeting_type_label }}
                                                        <span><i class="fa fa-file-text pl-1" aria-hidden="true"></i></span>
                                                        <span><i class="fa fa-file-o pl-1" aria-hidden="true"></i></span>
                                                    </p>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        @php
                                                        $statusMap = [
                                                        1 => [
                                                        'label' => 'Scheduled',
                                                        'class' => 'dot-orange',
                                                        ],
                                                        2 => [
                                                        'label' => 'Reschedule Requested',
                                                        'class' => 'dot-blue',
                                                        ],
                                                        3 => [
                                                        'label' => 'Confirmed',
                                                        'class' => 'dot-purple',
                                                        ],
                                                        4 => [
                                                        'label' => 'Completed',
                                                        'class' => 'dot-green',
                                                        ],
                                                        5 => [
                                                        'label' => 'No Show',
                                                        'class' => 'dot-red',
                                                        ],
                                                        6 => [
                                                        'label' => 'Cancelled',
                                                        'class' => 'dot-gray',
                                                        ],
                                                        ];
                                                        $status = $statusMap[$past_show->status] ?? [
                                                        'label' => 'Unknown',
                                                        'class' => 'dot-dark',
                                                        ];
                                                        @endphp
                                                        <button class="btn btn-xs text-white rounded  cursor-pointer active-status-moda {{ $status['class'] }}">
                                                            {{ $status['label'] }}
                                                        </button>
                                                        <button class="btn btn-xs btn-light text-12 rounded cursor-pointer active-status-moda">
                                                            Add Note
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- ----- -->
                        </div>
                        <!-- ---- -->
                    </div>
                </div>
                <!-- ----- -->
                <!-- calender  -->
                <div class="container mt-4">
                    <h4 class="mb-3">Calendar</h4>
                    <!-- Summary Section -->
                    {{-- <div class="summary-box">
                        <strong>This Month:</strong>
                        <span id="scheduledCount">0</span> Confirmed,
                        <span id="pendingCount">0</span> Scheduled,
                        <span id="completedCount">0</span> Awaiting Feedback,
                        <span id="selectedCount">0</span> Selected
                        <span id="rejectedCount">0</span> Rejected
                    </div> --}}
                    <!-- Status Legend -->
                    <div class="mb-3 small">
                        <span><span class="status-dot confirmed"></span>Confirmed</span>
                        &nbsp;&nbsp;
                        <span><span class="status-dot scheduled"></span>Scheduled</span>
                        &nbsp;&nbsp;
                        <span><span class="status-dot awaiting_feedback"></span>Awaiting Feedback</span>
                        &nbsp;&nbsp;
                        <span><span class="status-dot selected"></span>Selected</span>
                        &nbsp;&nbsp;
                        <span><span class="status-dot rejected"></span>Rejected</span>
                    </div>
                    <div class="calendar-wrapper">
                        <div id="calendar"></div>
                    </div>
                </div>
                <!-- Bootstrap Modal -->
                <div class="modal fade" id="calenderModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitle"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                            </div>
                            <div class="modal-body">
                                <p><strong>Date:</strong> <span id="modalDate"></span></p>
                                <p><strong>Time:</strong> <span id="modalTime"></span></p>
                                <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                                {{-- <p><strong>Meeting Link:</strong> <span id="modalStatus"></span></p> --}}
                            </div>
                            {{-- <div class="modal-footer">
                                <button class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <!-- ----- -->
            </div>
            <!-- ---- -->
        </div>
    </section>
</main>
<!-- ----- -->
@endsection
@section('js')
<!-- jQuery (FIRST – required for almost everything below) -->
<!-- DataTables Bootstrap 4 CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
<script src="{{ url('/public') }}/nurse/assets/js/jquery.ui.datepicker.monthyearpicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
    $(document).on('click', '.cancel-interview', function () {
    let interviewId = $(this).data('id');

    Swal.fire({
        title: "Are you sure?",
        text: "You want to cancel this interview?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Cancel it!"
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: "{{ route('nurse.interview.cancel') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    interview_id: interviewId
                },
                success: function (response) {

                    Swal.fire({
                        title: "Cancelled!",
                        text: "Interview has been cancelled successfully.",
                        icon: "success"
                    }).then(() => {
                        location.reload();
                    });

                }
            });

        }

    });

});
</script>
<script>
    $(document).on('click', '#submitAttendanceBtn', function() {

        let interviewId = $('#interview_id').val();
        let selectedStatus = $('input[name="processStep"]:checked').val();

        if (!selectedStatus) {
            Swal.fire({
                icon: 'warning'
                , title: 'No Status Selected'
                , text: 'Please select a status before submitting.'
                , confirmButtonColor: '#3085d6'
            });
            return;
        }

        $.ajax({
            url: "{{ route('nurse.interview.updateStatus') }}"
            , type: "POST"
            , data: {
                _token: "{{ csrf_token() }}"
                , interview_id: interviewId
                , status: selectedStatus
            }
            , beforeSend: function() {
                Swal.fire({
                    title: 'Updating...'
                    , text: 'Please wait'
                    , allowOutsideClick: false
                    , didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
            , success: function(response) {

                if (response.success) {

                    Swal.fire({
                        icon: 'success'
                        , title: 'Success!'
                        , text: response.message
                        , confirmButtonColor: '#28a745'
                    }).then(() => {
                        window.location.reload();
                    });

                } else {

                    Swal.fire({
                        icon: 'error'
                        , title: 'Failed'
                        , text: response.message ? ? 'Something went wrong.'
                        , confirmButtonColor: '#d33'
                    });

                }

            }
            , error: function() {
                Swal.fire({
                    icon: 'error'
                    , title: 'Server Error'
                    , text: 'Something went wrong. Please try again.'
                    , confirmButtonColor: '#d33'
                });
            }
        });

    });

</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        function updateCountdowns() {
            document.querySelectorAll(".countdown").forEach(function(el) {

                let scheduleAt = new Date(el.dataset.schedule);
                let now = new Date();
                let diff = scheduleAt - now;

                if (diff <= 0) {
                    el.innerText = "Interview Started";
                    return;
                }

                let days = Math.floor(diff / (1000 * 60 * 60 * 24));
                let hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
                let minutes = Math.floor((diff / (1000 * 60)) % 60);

                el.innerText =
                    `Interview starts in: ${days} Days ${hours}h ${minutes}m`;
            });
        }

        updateCountdowns();
        setInterval(updateCountdowns, 60000);
    });

</script>
<script>
    $(document).ready(function () {
        // When upload icon is clicked → set hidden values
        $(document).on('click', '.req-doc-edit', function () {

            let docName = $(this).data('docname');
            let employerId = $(this).data('employer');
            let name = $(this).data('name');

            $('#modal_document_name').val(docName);
            $('#modal_employer_id').val(employerId);
            $('#modal_name').val(name);
        });


        // Form Submit (AJAX)
        $('#upload-document').on('submit', function (e) {

            e.preventDefault();

            let formData = new FormData(this); // ✅ FIXED

            $.ajax({
                url: "{{ route('nurse.action_needed.upload') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function (response) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Uploaded!',
                        text: response.message ? response.message : 'Document uploaded successfully!',
                        confirmButtonColor: '#28a745',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    $('#upload-document')[0].reset();
                    $('#reqUploadModal').modal('hide');

                    // Reload to show updated document
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                },

                error: function (xhr) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        confirmButtonColor: '#dc3545'
                    });
                }
            });
        });

    });

    $(document).on('click', '.req-doc-delete', function() {

        let docId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?'
            , text: "This document will be permanently deleted!"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#d33'
            , cancelButtonColor: '#6c757d'
            , confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ url('nurse/document/delete/') }}" + "/" + docId
                    , type: "GET"
                    , data: {
                        _token: "{{ csrf_token() }}"
                    },

                    success: function(response) {

                        // Remove row without reload
                        $('#doc-row-' + docId).fadeOut(500, function() {
                            $(this).remove();
                        });
                        window.location.reload();

                    },

                    error: function() {
                        Swal.fire({
                            icon: 'error'
                            , title: 'Oops...'
                            , text: 'Something went wrong!'
                        });
                    }
                });
            }
        });

    });

</script>
<script>
    let table;
    $(document).ready(function() {
        table = $('#upComingTable').DataTable({
            pageLength: 10
            , pagingType: "simple"
            , ordering: true
            , searching: true
            , info: true
            , lengthChange: false
            , dom: 'rtip'
            , responsive: true
        });
        // Custom search
        $('#customSearch').on('keyup', function() {
            table.search(this.value).draw();
        });
        // Status filter
        $('.status-filter').on('click', function() {
            var status = $(this).data('value');
            table.column(3).search(status).draw();
        });
        // Date range filter
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var selectedRange = $('#dateFilter').val();
            if (!selectedRange) return true;
            var appliedDate = moment(data[1], "DD MMM YYYY");
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
        });
        $('#dateFilter').on('change', function() {
            table.draw();
        });
        $('#clearFilters').on('click', function() {
            $('#customSearch').val('');
            $('#dateFilter').val('');
            table.search('');
            table.columns().search('');
            table.draw();
        });
    });
    let table1;
    $(document).ready(function() {
        table1 = $('#pastTable').DataTable({
            pageLength: 10
            , pagingType: "simple"
            , ordering: true
            , searching: true
            , info: true
            , lengthChange: false
            , dom: 'rtip'
            , responsive: true
        });
        // Custom search
        $('#pastCustomSearch').on('keyup', function() {
            table1.search(this.value).draw();
        });
        // Status filter
        $('.past-status-filter').on('click', function() {
            var status = $(this).data('value');
            table1.column(3).search(status).draw();
        });
        // // Date range filter
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var selectedRange = $('#pastdateFilter').val();
            if (!selectedRange) return true;
            var appliedDate = moment(data[1], "DD MMM YYYY");
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
        });
        $('#pastdateFilter').on('change', function() {
            table1.draw();
        });
        $('#pastclearFilters').on('click', function() {
            $('#customSearch').val('');
            $('#pastdateFilter').val('');
            table1.search('');
            table1.columns().search('');
            table1.draw();
        });
    });

</script>
<script>
    $(document).on('click', '.action-modal', function() {
        let $btn = $(this);
        $btn.prop('disabled', true);
        let interviewId = $(this).data('id');
        let modal = '#schedModal_1';
        $('#globalLoader').show();
        $.ajax({
            url: "{{ url('/nurse/action-interview') }}"
            , type: "GET"
            , data: {
                interview_id: interviewId
                , modal_no: "1"
            }
            , success: function(response) {
                $('#modalContainer').empty();
                $('#modalContainer').html(response);
                $('#schedModal_1').modal({
                    backdrop: 'static'
                    , keyboard: false
                });
                $(modal).modal('show');
                $btn.prop('disabled', false);
                // Now loader exists in DOM
                showModalLoader(modal);
                // Hide loader after slight delay (simulate processing)
                setTimeout(function() {
                    hideModalLoader(modal);
                }, 300);
                // $('#schedModal_1').modal('show');
            }
        });
    });
    $(document).on('hidden.bs.modal', '#schedModal_1', function() {
        $(this).remove();
    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            initialView: window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth'
            , height: 'auto'
            , headerToolbar: {
                left: 'prev,next today'
                , center: 'title'
                , right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            }
            , events: {
                url: "{{ route('nurse.calendar.events') }}"
                , method: 'GET'
            }
            , eventClick: function(info) {
                document.getElementById('modalTitle').innerText = info.event.title;
                document.getElementById('modalDate').innerText =
                    info.event.start.toLocaleDateString();
                document.getElementById('modalTime').innerText =
                    info.event.start.toLocaleTimeString([], {
                        hour: '2-digit'
                        , minute: '2-digit'
                    });
                document.getElementById('modalStatus').innerText =
                    info.event.extendedProps.status.toUpperCase();
                $('#calenderModal').modal('show');
            }
        });
        calendar.render();
    });
    calendar.on('eventsSet', function(events) {
        let counts = {
            scheduled: 0
            , confirmed: 0
            , completed: 0
            , cancelled: 0
            , reschedule_requested: 0
            , no_show: 0
        };
        events.forEach(event => {
            counts[event.extendedProps.status]++;
        });
        document.getElementById('scheduledCount').innerText = counts.confirmed;
        document.getElementById('pendingCount').innerText = counts.scheduled;
        document.getElementById('completedCount').innerText = counts.completed;
        document.getElementById('selectedCount').innerText = counts.reschedule_requested;
        document.getElementById('rejectedCount').innerText = counts.cancelled;
    });

</script>
<script>
    document.querySelector('.booking-toggle-wrapper')
        .addEventListener('click', function() {
            const toggle = this.querySelector('input');
            toggle.checked = !toggle.checked;
        });

</script>
@endsection
