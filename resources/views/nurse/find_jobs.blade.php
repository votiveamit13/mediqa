@extends('nurse.layouts.layout')
@section('css')
@php
use Carbon\Carbon;
@endphp
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3/dist/style.min.css" />
<style>
  
  .agency_filter_show .select2-container {
  width: 100% !important;
  }
  
  .agency_filter_show .select2-selection--multiple {
  min-height: 42px;
  border-radius: 6px;
  }
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
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
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
    border: 1px solid #E5E7EB;
    border-radius: 10px;
    padding: 16px;
    margin-bottom: 24px;
    background: #FFFFFF;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
  }

  .job-card.item {
    margin-top: 0px;
    margin-bottom: 24px;
    position: relative;
  }

  .job-company {
    display: flex;
    width: 100% !important;
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
    margin-right: 10px;
    font-size: 20px;
  }

  .job-details .location {
    color: #555;
    font-size: 0.9rem;
  }

  .job-details.d-flex.align-items-center.justify-content-between {
    width: 100%;
  }

  .job-sort-dropdown select {
    font-size: 0.85rem;
    padding: 5px 8px;
  }

  .job-role {
    font-size: 1.1rem;
    font-weight: bold;
    /* margin-top: 12px; */
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
    justify-content: end;
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
    background-color: #3C8093;
    color: white;
    border: none;
    padding: 6px 14px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
  }

  .apply-btn:hover {
    background-color: #326A7A;
  }

  .apply-btn.applied {
    background: #7BA9B7;
    color: #28a745;
    /* green */
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
    border: none;
    cursor: default;
    padding: 0;
  }

  .apply-btn.applied::before {
    content: "✔";
    /* check icon */
    font-weight: bold;
  }

  .search-bar label {
    font-size: 12px;
    margin-bottom: 4px;
    font-weight: 500;
  }

  .find_job_div {
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
  .switch input:checked+.slider {
    background-color: black;
  }

  /* Checked position of the slider circle */
  .switch input:checked+.slider:before {
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

  .modal-content-custom {
    width: 100% !important;
  }

  button.btn.btn-link.p-0.show-more-btn {
    text-align: left;
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

  .third-level {
    display: none;
    margin-left: 20px;
  }

  .panel {
    width: 50%;
    padding: 10px;
  }

  .panel.left {
    border-right: 1px solid #ddd;
  }

  .panel.left,
  .panel.right {
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

  .checkbox-list,
  .checkbox-list-spec {
    max-height: 60vh;
    overflow-y: auto;
    padding-right: 10px;
  }

  .checkbox-list label,
  .checkbox-list-spec label {
    display: flex;
    align-items: center;
    margin: 6px 0;
  }

  .checkbox-list input[type="checkbox"],
  .checkbox-list-spec input[type="checkbox"] {
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

  .auto_fill_message {
    color: #28a745;
    display: none;
  }

  .auto_empty_message {
    color: #28a745;
    display: none;
  }

  .tooltip_preferences {
    background: #333;
    color: #fff;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 12px;
    white-space: nowrap;
    margin-left: 10px;
    display: none;
    /* hidden by default */
  }

  .btn-secondary {
    background-color: #f1f1f1;
    color: #333;
    border: 1px solid #ccc;
  }

  .urgent-tag {
    background: #000000ff;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
    padding: 4px 10px;
    border-radius: 12px;
    height: fit-content;
    position: absolute;
    margin-top: -68px;
    width: 14%;
    margin-left: -30px;
  }

  .urgent-tag-new {
    width: auto;
    margin-left: -62px;
  }

  .custom-multiselect {
    position: relative;
    width: 220px;
    /* same as other selects */
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
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  }

  .checkbox-options label {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 6px;
    /* spacing between checkbox & text */
    font-size: 14px;
    padding: 4px 8px;
    cursor: pointer;
    width: 100%;
  }

  .checkbox-options input[type="checkbox"] {
    margin: 0;
    width: 14px;
    height: 14px;
    accent-color: #0d6efd;
    /* Bootstrap primary color */
  }

  .checkbox-options input {
    flex: none;
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

  .no-jobs-box p {
    margin: 0;
    font-size: 14px;
    color: #777;
  }

  .last-date {
    font-size: 13px;
    font-weight: 500;
    color: #dc3545;
    /* red */
    margin-top: 4px;
  }

  .item {
    display: none;
    margin: 5px;
    padding: 10px;
    border: 1px solid #ccc;
  }

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
    border-radius: 10px;
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

  .top_filter.agency_filter_show select#agency {
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
    /* padding-right: 8px; */
    margin-left: -10px;
    justify-content: space-between;
    width: 100% !important;
  }
  /* 23/03  */
  .top_filter{
    width: 100% !important;
  }
  .top_filter.keywords_filter input#keywords{
    width: 100% !important;
  }
  .form-group .top_filter .location_filter{
    width: 100% !important;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #000;
    border: 1px solid #000;
    color: #fff;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff !important;
}
/* ==================== */
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
    color: #dc3545;
    /* red on hover */
  }

  .edit-btns {
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

  #saveSearchModal .modal-content {
    width: 100%;
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

  /* action-row  */
  .action-row {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-left: 10px;
  }

  /* Apply Button */
  .apply-btn {
    background: #3C8093;
    color: white;
    padding: 8px 18px;
    border-radius: 8px;
    border: none;
    font-size: 14px;
    cursor: pointer;
  }

  .apply-btn.applied {
    background: #7BA9B7;
    color: white;
    padding: 8px 18px;
    border-radius: 8px;
    border: none;
    font-size: 14px;
    cursor: pointer;
  }

  /* Details link */
  .details-link {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #0EA5E9;
    text-decoration: none;
    font-size: 14px;
  }

  .details-link i {
    width: 18px;
    height: 18px;
    stroke-width: 1.7;
  }

  .details-link:hover {
    color: #0284C7;
  }

  /* heart icon  */
  .job-like-btn{
    width: 30px;
    height: 30px;
    margin-right: 10px;
    cursor:pointer;
    font-size:21px;
    }
  .heart-toggle {
    cursor: pointer;
    display: flex;
    align-items: center;
  }

  .heart-toggle svg {
    width: 30px;
    height: 30px;
    margin-right: 10px;
    stroke: #9CA3AF;
    fill: transparent;
    transition: 0.25s ease;
  }

  .job-like-btn:hover svg {
    stroke: #0EA5E9;
  }

  .heart-toggle.active svg {
    stroke: #3C8093;
    fill: #3C8093;
  }

  /* priority tag  */
  .priority-tags {
    display: flex;
    gap: 6px;
    align-items: center;
    position: relative;
  }

  .tag {
    padding: 2px 6px;
    font-size: 13.5px;
    font-weight: 500;
    border-radius: 10px;
    white-space: nowrap;
    flex-shrink: 0;
  }

  .tag-new {
    background: #D1FAE5;
    color: #065F46;
  }

  .tag-urgent {
    background: #FEE2E2;
    color: #B91C1C;
  }

  .tag-last_minute {
    background: #DBEAFE;
    color: #1E40AF;
  }

  .tag-immediate {
    background: #EDE9FE;
    color: #5B21B6;
  }

  .tag-more {
    padding: 2px 6px;
    background: #F3F4F6;
    color: #374151;
    border-radius: 10px;
    font-size: 13px;
    cursor: pointer;
    position: relative;
  }

  .tags-tooltip {
    position: absolute;
    top: 100%;
    right: 0;
    margin-top: 8px;
    background: #fff;
    border-radius: 10px;
    padding: 10px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, .12);
    display: none;
    flex-direction: column;
    gap: 8px;
    min-width: 200px;
    z-index: 10;
  }

  .tags-tooltip .tag {
    display: inline-flex;
    width: fit-content;
  }

  /* .tooltip-tag {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #374151;
    }

    .tooltip-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    } */

  .tag-more:hover .tags-tooltip {
    display: flex;
  }

  .job-right-col {
    position: relative;
    min-height: 200px;
  }

  /* Feature list */
  .job-features {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }

  .feature-item {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 14px;
    color: #374151;
  }

  .feature-item img {
    width: 30px;
    height: 30px;
    object-fit: contain;
  }

  .saved-add-search {
    background: #e0f2fe;
    color: #0369a1;
    border: 1px dashed #7dd3fc;
    font-weight: 500;
    border-radius: 20px;
    padding: 4px;
    width: 100%;
    text-wrap-mode: nowrap;
  }

  .chip-new {
    text-wrap-mode: nowrap;
    font-size: 0.9rem;
    font-weight: 500;
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

  .saved-search-tab {
    position: relative;
    display: inline-flex;
    align-items: center;
  }

  /* Tooltip */
  .saved-search-tab .tooltip-text {
    position: absolute;
    top: 50%;
    left: 105%;
    transform: translateY(-50%);
    background: #111;
    color: #fff;
    font-size: 12px;
    padding: 6px 10px;
    border-radius: 6px;
    white-space: nowrap;

    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity 0.2s ease;

    z-index: 999;
  }

  /* Show on hover */
  .saved-search-tab:hover .tooltip-text {
    opacity: 1;
    visibility: visible;
  }
  .facility_dropdown .select2-container{
  padding:0 !important;
  border:0 !important;
  }
  /* .jobTitle_filter{
    width: auto !important;
  } */
   .btn-cross{
      border: none;
      background: none;
   }

   .drawer-header-edit{
      display: flex;
      justify-content: space-between;
      align-items: center;
   }

   table.dataTable thead .sorting_desc:after {
    display: none !important;
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
</style>
@endsection
@section('content')

<main class="main find_job_div">
  <section class="section-box mt-30">
    <div class="container">
      <!-- <div id="oneTimeMessage" class="alert alert-info" 
            style="display:none;margin:10px 0; font-size:14px; padding:12px 40px 12px 12px; 
                    border-radius:6px; background:#e8f4fd; border:1px solid #b6e0fe; color:#084298; 
                    position:relative;">
            
            <span>
            <strong>Info!</strong> This alert box could indicate a neutral informative change or action.
            </span>
            
            
            <button id="dismissMessage" class="close" data-dismiss="alert" aria-label="close" 
                  style="position:absolute; top:8px; right:10px; background:none; 
                        border:none; font-size:16px; font-weight:bold; 
                        color:#084298; cursor:pointer;">
            ×
            </button>
            </div> -->
      <div class="saved-searches-row" id="search-tabs">
        <div class="searchtabs">

          @if($saved_searches_data->isNotEmpty())
          @php $i = 2; @endphp

          {{-- My Preferences (shown only once) --}}
          @if(!empty($saved_my_preference))
          <div id="my-prefernece-tab" class="saved-search-tab  tooltip-wrapper" data-id="{{ $saved_my_preference->searches_id }}">
            My Preferences
            <span class="tooltip-text">
              This search is always linked to your current preferences.
            </span>
          </div>
          @endif


          {{-- Other saved searches --}}
          @foreach($saved_searches_data as $saved_searches)

          @if($saved_searches->status_my_preference == 1)
          @continue
          @endif

          <div class="saved-search-tab" data-id="{{ $saved_searches->searches_id }}">
            @if(empty($saved_searches->name))
            Saved search {{ $i }}
            @else
            {{ $saved_searches->name }}
            @endif
          </div>

          @php $i++; @endphp
          @endforeach
          @endif

        </div>

        <div class="add-new" @if($saved_searches_data->isEmpty()) style="display:none;" @endif>
          <button class="saved-add-search">+ Save New</button>
        </div>
      </div>

      <div class="job_tabs">

        <ul class="tab-nav">
          <li class="active" data-tab="tab1">Find Jobs</li>
          <li data-tab="tab2">Manage Saved Searches</li>

        </ul>
      </div>

      <div id="tab1" class="tab-content-jobs active">
        <div class="find-jobs-header d-flex justify-content-between align-items-center mb-3">
          <h2 class="find-jobs-title mb-0 fw-bold">Find Jobs</h2>
          <button id="add-search-btn">+ Save Search</button>
        </div>
        <!-- Horizontal Search Bar with Labels -->
        <div class="search-bar">
          <div class="top_filter keywords_filter jobTitle_filter">
            <label for="keywords">Job Title</label>
            <input type="text" id="keywords" placeholder="Search by role or specialty">
          </div>

          <div class="form-group top_filter location_filter">
            <label for="job_start">Job Start</label>
              <select id="job_start" >
                <option value="any">Any</option>
                <option value="instant">Instant Connect</option>
                <option value="last_minute">Last Minute</option>
                <option value="immediate">Immediate Start</option>
              </select>
          </div>
          <!-- Hidden input to store selected values -->
          <input type="hidden" id="selectedLocations" name="locations">

          <div class="top_filter agency_filter_show facility_dropdown">
            <label for="agency">Facility / Agency</label>
            <ul id="agency_filter" style="display:none;">
                             
              @if(!empty($agencies_list))
              @foreach ($agencies_list as $agency)
              <li data-value="{{ $agency->healthcare_id }}">{{ $agency->health_care_name }}</li>
              @endforeach
              @endif
            </ul>
            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="agency_filter" name="agency_ids[]" multiple></select>
            <!-- <select class="js-example-basic-multiple addAll_removeAll_btn" id="agency" name="agency_ids[]" multiple="multiple"
              style="width:100%">
              @foreach ($agencies_list as $agency)
              <option value="{{ $agency->healthcare_id }}">
                {{ $agency->health_care_name }}
              </option>
              @endforeach
            </select> -->
          </div>
          {{-- <div class="top_filter agency_filter">
            <label for="agency">Facility/Agency</label>
            <select id="agency">
              <option value="">Select Agency</option>
                @foreach ($agencies_list as $agency)
                <option value="{{ $agency->healthcare_id }}">{{ $agency->health_care_name }}</option>
                @endforeach
            </select>
          </div> --}}
          <?php 
              $find_job_sort =  DB::table('find_job_sort')->where('status',1)->get();
          ?>
          <div class="top_filter sort_by_filter">
            <label for="sort">Sort By</label>
            <select onchange="sortBy(this.value)">
              @foreach ($find_job_sort as $sort_job )
              <option value="{{$sort_job->id}}">{{$sort_job->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row">
          <div class="filters col-md-4">
            <div class="filter-sidebar">
              <div class="filter-header" style="display:flex">
                <div class="filter_heading">Filters</div>
                
                <button class="btn btn-default" id="reset-filter-button">Reset Filter</button>
                
                
              </div>
              <ul class="filter-list">
                <li class="filter-item">
                  <label for="toggleRegisteredPreferences" class="toggle-label">
                    Use My Registered Preferences
                    {{-- <div class="auto_fill_message">Filters are Auto-filled from your preferences</div>
                    <div class="auto_empty_message">Filters are empty/default and not Auto-filled<br> from your
                      preferences</div> --}}
                  </label>
                  &nbsp;
                  <label class="switch">
                    <input type="checkbox" id="toggleRegisteredPreferences" checked>
                    <span class="slider round"></span>
                  </label>
                </li>
                <li class="filter-item">
                  <label for="toggleUpdatePreferences" class="toggle-label">
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
                <li class="filter-item"
                  onclick="openModal('Employment Type','employeement_type_preferences','sub_prefer_id','emp_prefer_id','emp_type')">
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
                <!-- <li class="filter-item" onclick="openModal('Position','employee_positions','subposition_id','position_id','position_name')">
                            <span>Position</span>
                            <span class="arrow">›</span>
                          </li> -->
                <li class="filter-item" onclick="openModal_enviroment('Benefits')">
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
            <!-- <div class="mt-2">
              <button class="btn btn-default" id="reset-filter-button">Reset Filter</button>
            </div> -->
          </div>
          <!-- Job Listings -->
          <div class="job-listings col-md-8">
            {{-- <div id="no-jobs" class="no-jobs-box" style="display:none;">
              <h3>🚫 No Jobs Found</h3>
              <p>Sorry, no jobs match your search.</p>
            </div> --}}
            <div class="job-container">
              <div class="job-listings normal-pagination">

                @if (count($jobs)>0)
                @foreach($jobs as $job)

                <div class="job-card item" data-location="{{ $job->location_name }}">
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
                            {{-- <i data-lucide="heart"></i> --}}
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
                      <div class="location d-flex align-items-center"><i data-lucide="map-pin" width="18"
                          height="18"></i> {{ country_name($job->location_country) }}</div>
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
                          <img src="{{ asset('uploads/benefits/'.$benefit->icon) }}"
                            alt="{{ $benefit->benefits_name }}">
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
                        @php
                          // $total_percent = 84;
                        @endphp
                  
                        <div class="match-circle" data-value="{{ $job->match_percentage }}">
                          <div class="match-inner">
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
                <div class="pagination-wrapper front-pagination">
                  {{ $jobs->links('pagination::bootstrap-4') }}
                </div>
                @else
                <div id="no-jobs" class="no-jobs-box">
                  <h3>🚫 No Jobs Found</h3>
                  <p>Sorry, no jobs match your search.</p>
                </div>
                @endif

              </div>
              <div class="job-listings ajax-pagination d-none"></div>
            </div>
            {{-- <div class="pagination"></div> --}}

          </div>
        </div>
      </div>
      <div id="tab2" class="tab-content-jobs">

        <div class="manage-section">
          <div class="manage-header">
            <h6>Manage Saved Searches</h6>
            <button id="deleteSelected" style="margin-top:10px;">Delete Selected</button>
          </div>
          <div class="table-responsive">
            <table id="savedSearchTable" class="table">
              <thead>
                <tr>
                  <th><input type="checkbox" id="selectAll"></th>
                  <th>Name</th>
                  <th>Search Type</th>
                  <th>Filters summary</th>
                  <th>Matches Today</th>
                  <th>Alert</th>
                  <th>Delivery</th>
                  <th>Created</th>
                  <th>Last run</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @if($saved_searches_data->isNotEmpty())
                @php
                $i = 1;
                @endphp
                @foreach($saved_searches_data as $saved_searches)
                 @php
                      $filters = json_decode($saved_searches->filters, true);

                      @endphp
                      @php
                          $nurse_type_ids = json_decode($saved_searches->filter_nurse_type, true) ?? [];
                          $specilaity_ids = json_decode($saved_searches->filter_speciality, true) ?? [];
                          $filter_employment_type = json_decode($saved_searches->filter_employment_type, true) ?? [];
                          $filter_sector = $saved_searches->filter_sector;
                          $filter_work_environment = json_decode($saved_searches->filter_work_environment, true) ?? [];
                          $filter_benefits_preferences = json_decode($saved_searches->filter_benefits_preferences, true) ?? [];
                          //$filter_benefits_preferences = json_decode($saved_searches->filter_benefits_preferences, true) ?? [];

                          
                          $nurse_type_names = [];
                          $specilaity_names = [];

                          if (!empty($nurse_type_ids) && is_array($nurse_type_ids)) {
                              $nurse_type_names = \DB::table('practitioner_type')
                                  ->whereIn('id', $nurse_type_ids)
                                  ->pluck('name')
                                  ->toArray();
                          }

                          

                          
                      @endphp 
                <tr data-id="{{ $i }}" data-value="{{ $saved_searches->searches_id }}"
                  data-filters='{{ $saved_searches->filters }}' 
                  data-nurse-type='@json($nurse_type_ids)'
                  data-speciality-type='@json($specilaity_ids)'
                  data-employeement-type='@json($filter_employment_type)'
                  data-sector-type='@json($filter_sector)'
                  data-environment-type='@json($filter_work_environment)'
                  data-benefits-type='@json($filter_benefits_preferences)'
                  >
                  <td>
                    @if($saved_searches->status_my_preference != 1 && $i != 0)
                    <input type="checkbox" class="select-item">
                    @endif
                  </td>
                  {{-- <td>Saved search {{ $i }}</td> --}}
                  <td>
                    {{-- My Preferences --}}
                    @if($saved_searches->status_my_preference == 1)
                    My Preferences

                    {{-- Named saved search --}}
                    @elseif(!empty($saved_searches->name))
                    {{ $saved_searches->name }}

                    {{-- Auto numbered --}}
                    @else
                    Saved search {{ $i }}
                    @endif
                  </td>
                  <td>{{ $saved_searches->type }}</td>
                  <td>
                    <div class="filter-summary">
                       @php 
                          $filter_data = (array)json_decode($saved_searches->filters);
                          //print_r($filter_data);


                          

                          $filter_summury = filterSummuryData($filter_data);

                          //($filter_summury);
                       
                       @endphp

                      @if(!empty($nurse_type_names))
                          <span class="chip-new">{{ $nurse_type_names[0] }}</span>
                          <a href="#" class="btn-readmore" data-id="{{ $saved_searches->searches_id }}"
                        data-filters='{{ $filter_summury }}' 
                        data-nurse-type='@json($nurse_type_names)'
                        data-speciality-type='@json($specilaity_names)'
                        data-employeement-type='@json($filter_employment_type)'
                        data-sector-type='@json($filter_sector)'
                        data-environment-type='@json($filter_work_environment)'
                        data-benefits-type='@json($filter_benefits_preferences)' style="color:black;text-decoration:underline"
                        >Read More</a>
                      @endif

                      
                      
                    </div>
                  </td>
                  <td>
                    <span class="match-count badge bg-info text-dark">
                      {{ $search->matches_today ?? 0 }}
                    </span>
                  </td>
                  <td><span class="alert-pill alert-on">{{ $saved_searches->alert }}</span></td>
                  <td>
                    @if($saved_searches->delivery === 'Email')
                    <i class="fa fa-envelope"></i>
                    @elseif($saved_searches->delivery === 'In-app')
                    <i class="fa fa-laptop"></i>
                    @elseif($saved_searches->delivery === 'SMS')
                    <i class="fa fa-comment"></i>
                    @endif
                    <!-- {{ $saved_searches->delivery }} -->
                  </td>
                  <td>
                    @php
                    $dateOnly = date('Y-m-d', strtotime($saved_searches->created_at));
                    $today = date('Y-m-d');
                    @endphp

                    @if($dateOnly === $today)
                    Today
                    @else
                    
                    {{ $dateOnly ? \Carbon\Carbon::parse($dateOnly)->format('d/m/Y') : '' }}
                    @endif
                  </td>
                  <td class="last_run_at-{{ $saved_searches->searches_id }}">
                    {{ $saved_searches->last_run_at ? \Carbon\Carbon::parse($saved_searches->last_run_at)->format('d/m/Y') : '' }}
                  </td>
                  <td class="actions">
                    <div class="alert_box d-flex align-items-center gap-1">
                      <div class="alert-toggle-wrapper">
                        <label class="alert-toggle">
                          <input type="checkbox" class="alert-toggle-input" @if($saved_searches->alert != "Off") checked
                          @endif data-id="{{ $saved_searches->searches_id }}">
                          <span class="alert-toggle-slider"></span>
                        </label>
                      </div>

                      <button class="btn-run" data-id="{{ $saved_searches->searches_id }}">Run</button>
                      <button class="btn-edit {{ ($saved_searches->status_my_preference == 1 && $i != 0) ? 'edit-search-btn' : '' }}"  data-id="{{ $saved_searches->searches_id }}"> Edit </button>                    
                    <button class="btn-duplicate">Duplicate</button>
                      @if($saved_searches->status_my_preference != 1 && $i != 0)
                      <button class="btn-delete" data-name="single-delete">Delete</button>
                      @endif

                    </div>
                  </td>
                </tr>

                @php
                $i++;
                @endphp
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
    @include('nurse.job_modals')
    @include('nurse.saved_searches')
  </section>
  <!-- Save Search Modal -->
  <div class="toast" id="toast"></div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>

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
            console.log("dropdown",$currentDropdown);
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
</script>
<script>
  // var filters_data_value = sessionStorage.getItem("filters_data");
  // if(filters_data_value == null){
    
  //   $("#reset-filter-button").prop("disabled", true);
  // }
  $("#reset-filter-button").click(function(){

    sessionStorage.removeItem("filters_data");
    //$("#reset-filter-button").prop("disabled", true);
    window.location.reload();
  });
  $(document).on('click','.job-like-btn',function(){

        let button = $(this);
        let job_id = button.data('job');

        $.ajax({
            url: "{{route('nurse.jobs.like')}}",
            type: "POST",
            data:{
                job_id:job_id,
                _token:"{{csrf_token()}}"
            },
            success:function(res){

                if(res.status == 'liked'){
                    button.find('i')
                    .removeClass('far fa-heart')
                    .addClass('fas fa-heart text-danger');
                }
                else{
                    button.find('i')
                    .removeClass('fas fa-heart text-danger')
                    .addClass('far fa-heart');
                }

            }
        });

    });
</script>
<script>
  $(document).ready(function(){
      $('.tab-nav li').click(function(){
        // Remove active classes
        $('.tab-nav li').removeClass('active');
        $('.tab-content-jobs').removeClass('active');

        // Add active class to clicked tab and corresponding content
        $(this).addClass('active');
        $('#' + $(this).data('tab')).addClass('active');
      });
      $('.tab-nav-edit li').click(function(){
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
  let editId = null;
   let deleteId = null;
   
   $('#add-search-btn, .add-new').on('click', function(e) {
      e.preventDefault();
      let selected = [];
      // Count existing saved searches (rows)
      const totalSearches = $('#savedSearchTable tbody tr').length;
      
     // Check limit
      if (totalSearches >= 50) {
        Swal.fire({
          icon: 'warning',
          title: 'Limit Reached',
          text: "You’ve reached the limit of saved searches. Delete one to add another.",
          confirmButtonColor: '#c80014'
        });
        return; // stop further execution
      }

     $('#modal-title').text('Save Search');
     $('#save-search-modal').fadeIn(200);
     editId = null;

      
      var emp_type = sessionStorage.getItem("emp_type_data-emp_type");
      let parts = emp_type.split(",");
      console.log(parts);
      var emp_type_json = JSON.stringify(parts);
      // $('#employmentModal .employee_type:checked, #employmentModal .employee_type:disabled:checked').each(function() {
      //     selected.push($(this).val());
      // });
      console.log(emp_type);
      

      $.ajax({
        type: "GET",
        url: "{{ url('/nurse/getEmptypeData') }}",
        data: {id_arr:emp_type_json},
        cache: false,
        success: function(data){

          if ($('#toggleRegisteredPreferences').is(':checked') == true && $('#toggleUpdatePreferences').is(':checked') == false) {
            var res_data = JSON.parse(data);
            var filter_data = [];
            $("#smartInput .tag").remove();
            for(var i=0;i<res_data.length;i++){
                $("#smartInput").prepend('<span class="tag">'+res_data[i]+'\
                <span class="remove-tag remove-tag-'+i+'">×</span>\
                </span>');
                //removeTag(res_data[i]);
                filter_data.push(res_data[i]);
            }
            
            $("#suggestion-search-name").val(JSON.stringify(filter_data));
            $("#search_type").val("Hybrid");
          }

          if ($('#toggleRegisteredPreferences').is(':checked') == false && $('#toggleUpdatePreferences').is(':checked') == false) {
            
            $("#smartInput .tag").remove();
            //$("#suggestion-search-name").val(JSON.stringify(filter_data));
            $("#search_type").val("snapshot");
            
          }

          
          
        }
      });  
   });
   
   // Cancel modal
   $('.btn-cancel').on('click', function() {
     $('#save-search-modal').fadeOut(200);
   });
   
   function addSearchToUI(id, name,filter_summury, alert_frequency, delivery) {
     let newTab = $(`<div class="saved-search-tab" data-id="${id}">${name}<div class="unsaved-dot"></div></div>`);
     
     if ($('.searchtabs').children().length === 0) {
       
        // div has no child elements
        $('.searchtabs').append(newTab);
        $('.add-new').show();
      } else {
        $('#search-tabs .add-new').before(newTab);
      }

      if(delivery == "SMS"){
        var delivery_method = '<i class="fa-solid fa-comment-sms"></i>';
      }

      if(delivery == "Email"){
        var delivery_method = '<i class="fa-solid fa-envelope"></i>';
      }

      if(delivery == "In-app"){
        var delivery_method = '<i class="fa-solid fa-laptop"></i>';
      }
     
     let row = `<tr data-id="${id}">
       <td><input type="checkbox" class="select-item"> </td> 
       <td>${name}</td>
       <td></td>
       <td>${filter_summury}</td>
       <td>
          <span class="match-count badge bg-info text-dark">
            0
          </span>
       </td>
       <td><span class="alert-pill ${alert_frequency === "Off" ? "alert-off" : "alert-on"}">${alert_frequency}</span></td>
       <td>${delivery_method}</td>
       <td>${new Date().toLocaleDateString()}</td>
       <td></td>
       <td class="actions">
         <button class="btn-run" data-id="${id}">Run</button>
         <button class="btn-edit">Edit</button>
         <button class="btn-duplicate">Duplicate</button>
         <button class="btn-delete">Delete</button>
       </td>
     </tr>`;
     $('#savedSearchTable tbody').append(row);
   }
   
   $('.btn-save').on('click', function() {
     const name = $('#search-name').val().trim() || 'New Search';
     const alert_frequency = $('#alert-frequency').val();
     const delivery = $('#delivery-method').val();
   
     if (editId) {
       const row = $(`#savedSearchTable tr[data-id="${editId}"]`);
       row.find('td:nth-child(1)').text(name);
       row.find('td:nth-child(2) .alert-pill').text(alert_frequency)
         .removeClass('alert-on alert-off')
         .addClass(alert_frequency === "Off" ? "alert-off" : "alert-on");
       row.find('td:nth-child(3)').text(delivery);
       $(`.saved-search-tab[data-id="${editId}"]`).text(name);
       $('#save-search-modal').fadeOut(200);
     }
   
     
     //$('#search-name').val('');
   });

   // Drawer tab switch
  $('.drawer .tab').click(function(){
    $('.drawer .tab').removeClass('active');
    $(this).addClass('active');
    $('.tab-content').removeClass('active');
    $('#' + $(this).data('tab')).addClass('active');
  });

    $(document).on('click', '.btn-edit', function(){
      editId = $(this).closest('tr').data('id');
      var search_id = $(this).closest('tr').data('value');
      const row = $(this).closest('tr');
      $('#drawer-title').text('Edit Search');
      $('#search-name').val(row.find('td:first').text());
      $('#alert-frequency').val(row.find('td:nth-child(2)').text().trim());
      $('#alert-delivery').val(row.find('td:nth-child(3)').text().trim());
      $('#filter-location').val('');
      $('#filter-shift').val('Day');
      $('#filter-preview').val(0);
      $('#alert-cap').val('');
      $('#quiet-start').val('');
      $('#quiet-end').val('');
      $('#search-notes').val('');
      $('#search_id').val(search_id);
      $('#drawer').addClass('open');
      $(".drawer-overlay").fadeIn(200);
      
      $.ajax({
        type: "GET",
        url: "{{ url('/nurse/getEditSearchData') }}",
        data: {id:search_id},
        cache: false,
        success: function(data){
          var data1 = JSON.parse(data);
          console.log("alert",data1);
          if(data1){
            
            $('#filter-location').val(data1.location);
            $('#filter-shift').val(data1.shift);
            $('#filter-preview').val(data1.preview_count);
            $('#alert-cap').val(data1.daily_cap);
            $('#quiet-start').val(data1.quite_hours_start);
            $('#quiet-end').val(data1.quite_hours_end);
            $('#search-notes').val(data1.notes);
            $('#edit-alert-frequency').val(data1.alert);
            $('#edit-alert-delivery').val(data1.delivery);
            $('#edit-search-name').val(data1.name);
            $('#search_id').val(data1.searches_id);
            var data_parse = data1.filters;
            $(`input[name="edit_sector"][value="${data_parse.sector}"]`).prop("checked", true);
            $(`input[name="edit_location"][value="${data_parse.sector}"]`).prop("checked", true);
            $(`#year_experience`).val(data_parse.experience_years);
            $(`#minSalary1`).val(data_parse.salary.min);
            $(`#maxSalary1`).val(data_parse.salary.max);
            $(`#minSalaryValue1`).text(data_parse.salary.min);
            $(`#maxSalaryValue1`).text(data_parse.salary.max);
            console.log("v",data_parse);
            $(".saved_filters").val(JSON.stringify(data_parse));
            let savedValues = JSON.parse(data1.filter_nurse_type);
            let sector = data1.filter_sector;
            let filter_employment_type = JSON.parse(data1.filter_employment_type);
            let shift_type = JSON.parse(data1.filter_work_shift);
            console.log("shift_type",shift_type);
            savedValues.forEach(function(value) {
                $(".nurse_type[value='" + value + "']").prop("checked", true);
            })
            filter_employment_type.forEach(function(value) {
                $(".employment_types[value='" + value + "']").prop("checked", true);
            });
      

            if (Array.isArray(shift_type) && shift_type.length > 0) {
                shift_type.forEach(function(value) {
                    $(".shift_types[value='" + value + "']").prop("checked", true);
                });
            }
             
            $(".edit_sector_radio").prop("checked", true);
            // $.each(data_parse, function (key, values) {
            //   if (Array.isArray(values)) {
                
            //     values.forEach(v => {
            //       console.log("key",key);
            //       console.log("values",v);
            //       $(`input[name="${key}[]"][value="${v}"]`).prop("checked", true);
                 
            //     });
                
            //   }
            // });
            
            
          }
        }
      });  
    });
   

    $('#drawer-save').click(function(){
      const name = $('#search-name').val() || 'New Search';
      const alert = $('#alert-frequency').val();
      const delivery = $('#alert-delivery').val();
      if(editId){
        const row = $(`#savedSearchTable tr[data-id="${editId}"]`);
        row.find('td:nth-child(1)').text(name);
        row.find('td:nth-child(2) .alert-pill').text(alert).removeClass('alert-on alert-off').addClass(alert==="Off"?"alert-off":"alert-on");
        row.find('td:nth-child(3)').text(delivery);
        $(`.saved-search-tab[data-id="${editId}"]`).text(name);
      } else {
        addSearch(Date.now(), name, alert, delivery);
      }
      $('#drawer').removeClass('open');
    });

    // Cancel drawer
    $('#drawer-cancel').click(function(){ 
      $('#drawer').removeClass('open'); 
      $(".drawer-overlay").hide();
    });

    // Duplicate
    let duplicateData = {}; // to store temporary data

// DUPLICATE BUTTON CLICK
$(document).on('click', '.btn-duplicate', function() {
  const row = $(this).closest('tr');
  const id = row.data('value');
  const originalName = row.find('td:nth-child(2)').text().trim();
  const filterSummary = row.find('td:nth-child(4)').html();
  const alertFreq = row.find('td:nth-child(6)').text().trim();
  
  console.log("filterSummary",filterSummary);

  // Get the full JSON filter from the row’s data attribute
  const filterJson = row.data('filters');
  const delivery = row.data('name');
  
  // Get the full JSON filter from the row’s data attribute
  const filter_nurse_type = row.data('nurse-type');
  const speciality_type = row.data('speciality-type');
  const benefits_type = row.data('benefits-type');
  const employeement_type = row.data('employeement-type');
  const sector_type = row.data('sector-type');
  const environment_type = row.data('environment-type');
 
  

  const totalSearches = $('#savedSearchTable tbody tr').length;
      
  // Check limit
  if (totalSearches >= 50) {
    Swal.fire({
      icon: 'warning',
      title: 'Limit Reached',
      text: "You’ve reached the limit of saved searches. Delete one to add another.",
      confirmButtonColor: '#c80014'
    });
    return; // stop further execution
  }
  
  // Store temporarily
  duplicateData = {
    id,
    name: originalName,
    filterSummary,
    filterJson,
    filter_nurse_type,
    speciality_type,
    benefits_type,
    employeement_type,
    sector_type,
    environment_type,
    alert: alertFreq,
    delivery
  };

  // Prefill modal
  $('#renameInput').val(originalName + " Copy");
  $('#renameModal').fadeIn(200).data('mode', 'duplicate');
});




// RENAME MODAL SAVE BUTTON CLICK
$('#renameSave1').off('click').on('click', function() {
  const newName = $('#renameInput').val().trim();
  if (!newName) {
    alert("⚠️ Please enter a name to duplicate.");
    return;
  }

  const mode = $('#renameModal').data('mode');

  if (mode === 'duplicate') {
    $.ajax({
      type: "POST",
      url: "{{ url('/nurse/duplicateSearch') }}",
      data: {
        _token: "{{ csrf_token() }}",
        searches_id: duplicateData.id,
        name: newName,
        filters: duplicateData.filterJson, // ✅ send full filters
        filter_nurse_type: JSON.stringify(duplicateData.filter_nurse_type), // ✅ send full filters
        speciality_type: JSON.stringify(duplicateData.speciality_type), // ✅ send full filters
        benefits_type: JSON.stringify(duplicateData.benefits_type), // ✅ send full filters
        employeement_type: JSON.stringify(duplicateData.employeement_type), // ✅ send full filters
        sector_type: JSON.stringify(duplicateData.sector_type), // ✅ send full filters
        environment_type: JSON.stringify(duplicateData.environment_type), // ✅ send full filters
        alert: duplicateData.alert,
        delivery: duplicateData.delivery
      },
      success: function(response) {
        if (response.success) {
          addSearchToUI(
            response.new_id,
            newName,
            duplicateData.filterSummary,
           
            duplicateData.alert,
            duplicateData.delivery
          );

          $('#renameModal').fadeOut(200);
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Search duplicated successfully!'
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "Something went wrong. Try again."
          });
        }
      },
      error: function(xhr) {
        console.error(xhr.responseText);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: "Error duplicating search."
        });
      }
    });
  }
});



// RENAME MODAL CANCEL BUTTON
$('#renameCancel').click(function() {
  $('#renameModal').fadeOut(200);
  duplicateData = {}; // clear stored data
});




    $(document).on('click', '.btn-delete', function() {
        deleteId = $(this).closest('tr').data('id');
        $('#delete-modal').fadeIn(200);
        $('#delete-confirm').attr("data-name","single-delete");
    });
    $('#delete-cancel').click(()=>$('#delete-modal').fadeOut(200));
    // $('#delete-confirm1').click(function(){
    //   alert("hello");
    //   if(deleteId){
    //     //delete searches[deleteId];
    //     let row = $(`#savedSearchTable tr[data-id="${deleteId}"]`).data('value');
    //     $(`#savedSearchTable tr[data-id="${deleteId}"]`).remove();
    //     $(`.saved-search-tab[data-id="${deleteId}"]`).remove();
        
    //     deleteId = null;
    //     $.ajax({
    //       type: "POST",
    //       url: "{{ url('/nurse/deleteSearchJobsData') }}",
    //       data: {searches_id:row,_token:"{{ csrf_token() }}"},
    //       cache: false,
    //       success: function(data){
    //         if(data == 1){
              
    //           Swal.fire({
    //           icon: 'success',
    //           title: 'Success',
    //           text: 'Save Search Deleted Successfully',
    //           }).then(function() {
                
    //             $('#delete-modal').fadeOut(200);
    //           //window.location.href = "{{ route('nurse.language_skills') }}?page=language_skills";
    //           });
              
    //         }
            
    //       }
    //     });
        
    //   }
      
    // });
    $('#deleteSelected').on('click', function() {
    selectedIds = [];

    $('.select-item:checked').each(function() {
      selectedIds.push($(this).closest('tr').data('value'));
    });

    if (selectedIds.length === 0) {
      alert("Please select at least one record to delete.");
      return;
    }
    $('#delete-confirm').attr("data-name","multiple-delete");
    // Open modal
    $('#delete-modal').fadeIn(200).css('display', 'flex');
  });
    $('#delete-confirm').on('click', function() {
      $('#delete-modal').fadeOut(200);
        var btn_name = $(this).data("name");
        //alert(btn_name);
        if(btn_name == "multiple-delete"){
          $.ajax({
          url: "{{ url('/nurse/deleteMultipleSearches') }}",
          type: "POST",
          data: {
            ids: selectedIds,
            _token: "{{ csrf_token() }}"
          },
          success: function(response) {
            if (response.status === 'success') {
              // Remove deleted rows from table
              $('.select-item:checked').each(function() {
                $(this).closest('tr').fadeOut(300, function() { $(this).remove(); });
              });
              $('#selectAll').prop('checked', false);
              Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Save Searches Deleted Successfully',
              }).then(function() {
                
                $('#delete-modal').fadeOut(200);
                location.reload(true);
              //window.location.href = "{{ route('nurse.language_skills') }}?page=language_skills";
              });
            } else {
              alert("Error deleting records.");
            }
          },
          error: function(xhr) {
            console.error(xhr.responseText);
            alert("Something went wrong. Please try again.");
          }
        });
      }else{
        let row = $(`#savedSearchTable tr[data-id="${deleteId}"]`).data('value');
        $(`#savedSearchTable tr[data-id="${deleteId}"]`).remove();
        $(`.saved-search-tab[data-id="${deleteId}"]`).remove();
        
        deleteId = null;
        $.ajax({
          type: "POST",
          url: "{{ url('/nurse/deleteSearchJobsData') }}",
          data: {searches_id:row,_token:"{{ csrf_token() }}"},
          cache: false,
          success: function(data){
            if(data == 1){
              
              Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Save Search Deleted Successfully',
              }).then(function() {
                
                $('#delete-modal').fadeOut(200);
                location.reload(true);
              //window.location.href = "{{ route('nurse.language_skills') }}?page=language_skills";
              });
              
            }
            
          }
        });
      }
      
    });

    // Switch active tab
    $(document).on('click', '.saved-search-tab', function() {
      if (!$(this).hasClass('add-new')) {
        $('.saved-search-tab').removeClass('active');
        $(this).addClass('active');
        $('#active-search-name').text($(this).text().trim());
      }
    });
   // $(document).ready(function(){
   
   //   const saveSearch = document.getElementById('createSearchBtn');
   //   const modal = document.getElementById('saveSearchModal');
   
   //   saveSearch.addEventListener('click', () => {
   //     const nameInput = document.getElementById('searchName');
   //     const name = nameInput.value.trim() || 'Saved Search';
   //     const newChip = document.createElement('div');
   //     newChip.className = 'chip';
   //     newChip.innerHTML = `<span>${name}</span>`;
   //     document.querySelector('.saved-searches').insertBefore(
   //       newChip,
   //       document.getElementById('btnAddNew')
   //     );
   //     nameInput.value = '';
   //     modal.classList.remove('active');
   //     $("#saveSearchModal").hide();
   //     $(".modal-backdrop").hide();
   //   });
   
     
   
       
   //   $('[data-bs-toggle="tooltip"]').tooltip();
   
   //   // Open modal
   //   $('#openSaveSearchModal, .add-new').click(function(){
   //     $('#saveSearchModal').modal('show');
   //   });
   
   //   // Chip active state (except My Preferences non-clickable)
   //   $('.saved-search-chip').not('.my-preferences').click(function(){
   //     $('.saved-search-chip').removeClass('active');
   //     $(this).addClass('active');
   //   });
   
   //   // Unsaved changes detection
   //   $('.filter-field').on('change', function(){
   //     $('#unsavedDot').removeClass('d-none');
   //     $('#updateSearchBtn').prop('disabled', false);
   //   });
   
    
   
   //   // Simulate save
   //   // $('#createSearchBtn').click(function(){
   //   //   $('#saveSearchModal').modal('hide');
   //   //   $('#unsavedDot').addClass('d-none');
   //   //   $('#updateSearchBtn').prop('disabled', true);
   //   //   alert('✅ Saved search created!');
   //   // });
   
   //   // Prevent deleting My Preferences (example safeguard)
   //   $('.saved-search-chip.my-preferences').on('contextmenu', function(e){
   //     e.preventDefault();
   //     alert('ℹ️ “My Preferences” search cannot be deleted.');
   //   });
   // });
</script>
<script>
  $(document).ready(function(){
       
     
         
     $('[data-bs-toggle="tooltip"]').tooltip();
   
     // Open modal
     $('#openSaveSearchModal, .add-new').click(function(){
       $('#saveSearchModal').modal('show');
     });
   
     // Chip active state (except My Preferences non-clickable)
     $('.saved-search-chip').not('.my-preferences').click(function(){
       $('.saved-search-chip').removeClass('active');
       $(this).addClass('active');
     });
   
     // Unsaved changes detection
     $('.filter-field').on('change', function(){
       $('#unsavedDot').removeClass('d-none');
       $('#updateSearchBtn').prop('disabled', false);
     });
   
     // Simulate save
     $('#createSearchBtn').click(function(){
       $('#saveSearchModal').modal('hide');
       $('#unsavedDot').addClass('d-none');
       $('#updateSearchBtn').prop('disabled', true);
       alert('✅ Saved search created!');
     });
   
     // Prevent deleting My Preferences (example safeguard)
     $('.saved-search-chip.my-preferences').on('contextmenu', function(e){
       e.preventDefault();
       alert('ℹ️ “My Preferences” search cannot be deleted.');
     });
   });
</script>
<script>
    $(document).ready(function () {   
      const urlParams = new URLSearchParams(window.location.search);
        let chipFilter = urlParams.get('chip_filter');
        if (chipFilter) {
        chipFilter = chipFilter.replace(/"/g, ''); // remove quotes
        if (chipFilter === 'top') {
        let tab = $('#my-prefernece-tab');    
        if (tab.length) {
        tab.trigger('click');
        }   
        }
      } 
    });

      let filters = {
          keywords: '',
          job_start: '',
          agency: [],
          sort_by: '',
          searchId:''
      };

      function removePageParam() {
          let url = window.location.protocol + "//" + window.location.host + window.location.pathname;
          window.history.replaceState({}, document.title, url);
      }

      let isAjaxMode = false;
    function fetchJobs(page = 1) {
          removePageParam();
          let filtersData = JSON.parse(sessionStorage.getItem("filters_data")) || {};
          isAjaxMode = true;
          $(".normal-pagination").addClass("d-none");
          $(".ajax-pagination").removeClass("d-none");
        $.ajax({
            type: "POST",
            url: "{{ url('/nurse/getJobsSorting') }}",
            data: {
                keywords: filters.keywords,
                filters_data: filtersData,
                job_start: filters.job_start,
                agency: filters.agency,
                sort_name: filters.sort_by,
                search_id: filters.searchId,
                page: page,
                _token: "{{ csrf_token() }}"
            },
          success: function (res) {
              $("#reset-filter-button").prop("disabled", false);
              if (!res.status) {
                  $(".ajax-pagination").html(`
                    <div class="no-jobs-box" >
                        <h3>🚫 No Jobs Found</h3>
                        <p>Sorry, no jobs match your search.</p>
                    </div>
                  `);
              } else {
                  $(".ajax-pagination").html(res.html);
              }
          }
        });
    }
    $("#keywords").on("keyup", function () {
        filters.keywords = $(this).val();
        fetchJobs(1);
    });

    // $("#agency").on("change", function () {
    //   filters.agency = $(this).val();
    //   fetchJobs(1);
    // });
    $(document).on("change", '[data-list-id="agency_filter"]', function () {
        filters.agency = $(this).val() || [];
        fetchJobs(1);
    });
   
    $("#job_start").on("change", function () {
        filters.job_start = $(this).val();
        fetchJobs(1);
    });

    $(document).on('click', '.saved-search-tab', function () {
      filters.searchId = $(this).data('id');
      fetchJobs(1);
    })

    $(document).on("click", ".ajax-pagination .pagination a", function (e) {
        e.preventDefault();
        let page = $(this).attr("href").split("page=")[1];
        fetchJobs(page);
    });

    function sortBy(value) {
        filters.sort_by = value;
    
        if(value == 'match_percent'){
            // Container holding all job cards
          var $container = $('.job-listings'); // replace with your actual wrapper id/class
      
          // Get all job cards
          var $cards = $container.children('.job-card');
      
          // Sort by match percentage
          $cards.sort(function (a, b) {
              var aVal = parseInt($(a).find('.match-score').text()); // "20% Match" → 20
              var bVal = parseInt($(b).find('.match-score').text());
      
              return bVal - aVal; // High to Low (swap if you want Low → High)
          });
      
          // Re-append in sorted order
          $container.html($cards);
        }
      
        if(value == 'highest_salary'){
          var $container = $('.job-listings');   // wrapper div of all job cards
          var $cards = $container.children('.job-card');
      
          $cards.sort(function (a, b) {
              // Extract numeric salary
              var aSalary = parseInt($(a).find('.salary').text().replace(/[^0-9]/g, ''));
              var bSalary = parseInt($(b).find('.salary').text().replace(/[^0-9]/g, ''));
      
              return bSalary - aSalary; // High → Low
          });
      
          $container.html($cards); // re-render sorted order
        }
      
          fetchJobs(1);
        if(value == 'nearest_location'){
          ensureLatLng(function () {
            getCurrentLocation(function (coords) {
              sortJobsByProximity(coords);
            });
          });
        }
    }
   
    //  $(document).on('click', '.pagination a', function (e) {
    //   e.preventDefault();

    //   let url = $(this).attr('href');

    //   $.ajax({
    //           type: "POST",
    //           url: url,
    //           data: {
    //               sort_name: currentSort,
    //               _token: "{{ csrf_token() }}"
    //           },
    //           success: function (html) {
    //               $(".job-listings").html(html);
    //           }
    //       });
    //   });


  //  $(document).ready(function () {
  //       $("#keywords, #location, #agency, #sortBy").on("change keyup", function () {
  //       let keywords = $("#keywords").val().trim();
  //       let location = $("#location").val();
  //       let agency   = $("#agency").val();
  //       let sortBy   = $("#sortBy").val();



  //       $.ajax({
  //           url: "/jobs/filter",
  //           type: "GET",
  //           data: {
  //               keywords: keywords,
  //               location: location,
  //               agency: agency,
  //               sort_by: sortBy,
  //               page: 1
  //           },
  //           success: function (res) {
  //               $(".job-listings").html(res.html);
  //               $(".pagination").html(res.pagination);
  //               $("#no-jobs").toggle(res.count === 0);
  //           }
  //       });
  //   });

    // $("#keywords").on("keyup", function () {
    //     var value = $(this).val().toLowerCase().trim();
    //     var $jobs = $(".job-listings .job-card");
    //     var hasResults = false;

    //     // If empty → reset
    //     if (value === "") {
    //         $jobs.show();
    //         $("#no-jobs").hide();      // FIXED
    //         $(".pagination").show();
    //         return;
    //     }

    //     // Check matches
    //     $jobs.each(function () {
    //         let match = $(this).text().toLowerCase().includes(value);
    //         $(this).toggle(match);
    //         if (match) hasResults = true;
    //     });

    //     // Show/Hide no-jobs-box
    //     if (!hasResults) {
    //         $("#no-jobs").show();      // FIXED
    //         $(".pagination").hide();
    //     } else {
    //         $("#no-jobs").hide();      // FIXED
    //         $(".pagination").show();
    //     }
    // });

  //  });
   
   
  //  let allLocations = [...new Set($('.location').map(function () {
  //    return $(this).text().trim();
  //  }).get())];
   
   // 2. Get all values from existing checkboxes
  //  let checkboxLocations = $('.location-checkbox').map(function () {
  //    return $(this).val().trim();
  //  }).get();
   
   // 3. Filter out locations that are already in checkboxes
  //  let remainingLocations = allLocations.filter(loc => !checkboxLocations.includes(loc));
   
  //  console.log("Remaining Locations:", remainingLocations);
   
   // Append options to dropdown
  //  let $dropdown = $('.location_boxes');
  //  remainingLocations.forEach(function(loc) {
  //      $dropdown.append('<label><input type="checkbox" class="location-checkbox" value="'+loc+'"> '+loc+'</label>');
  //  });
   
  //  function filterJobs() {
  //    // Get all checked locations
  //    let selectedLocations = $('.location-checkbox:checked').map(function () {
  //        return $(this).val().trim();
  //    }).get();
   
  //    if (selectedLocations.length === 0) {
  //        // If nothing is checked → show all jobs
  //        $('.job-card').show();
  //        return;
  //    }
   
  //    // Loop through job cards
  //    $('.job-card').each(function () {
  //        let jobLocation = $(this).find('.location').text().trim();
   
  //        if (selectedLocations.includes(jobLocation)) {
  //            $(this).show(); // match → show
  //        } else {
  //            $(this).hide(); // not match → hide
  //        }
  //    });
   
  //    // Update dropdown display text
  //    updateSelectedLocationsBox();
  //    checkIfNoJobs(); // ✅ check if all are hidden
  //  }
   
  //  function checkIfNoJobs() {
  //    if ($('.job-card:visible').length === 0) {
  //        $('#no-jobs').show();
  //    } else {
  //        $('#no-jobs').hide();
  //    }
  //  }
   
   // Run when checkboxes change
  //  $(document).on('change', '.location-checkbox', filterJobs);
   
  //  // Run once on page load (for auto-checked locations)
  //  $(document).ready(filterJobs);
   
  //  function updateSelectedLocationsBox() {
  //    let selected = $('.location-checkbox:checked').map(function () {
  //        return $(this).val().trim();
  //    }).get();
   
  //    if (selected.length > 0) {
  //        $('.select-box').text(selected.join(', '));
  //    } else {
  //        $('.select-box').text('Select Location');
  //    }
  //  }
   
   
   //For Agency
  //  let uniqueAgency = [...new Set($('.job-role').map(function() {
  //    return $(this).text().trim();
  //  }).get())];
   
  //  console.log("uniqueAgency",uniqueAgency);
   
   // Append options to dropdown
  //  let $dropdown_agency = $('#agency');
  //  uniqueAgency.forEach(function(agency) {
  //    $dropdown_agency.append('<option value="'+ agency +'">'+ agency +'</option>');
  //  });
   
  //  $('#agency').on('change', function() {
  //    let selectedAgency = $(this).val().trim();
   
  //    // Show all jobs if no location selected
  //    if (selectedAgency === "") {
  //        $('.job-card').show();
  //        return;
  //    }
   
  //    // Loop through each job card
  //    $('.job-card').each(function() {
  //        let jobAgency = $(this).find('.job-role').text().trim();
   
  //        if (jobAgency === selectedAgency) {
  //            $(this).show();
  //        } else {
  //            $(this).hide();
  //        }
  //    });
  //  });
   
  //  var selected = [];
  //  $(".location-checkbox:checked").each(function () {
  //      selected.push($(this).val());
  //  });
   
  //  console.log(selected); 
   
   
   $(document).on('change','#toggleUpdatePreferences',function(){

    if($(this).is(':checked')){
        // Toggle ON → show edit
        $('.edit-search-btn').show();
    }
    else{
        // Toggle OFF → hide edit
        $('.edit-search-btn').hide();
    }

  });
    $(document).ready(function(){

      if(!$('#toggleUpdatePreferences').is(':checked')){
          $('.edit-search-btn').hide();
      }

  });
   
   
   $('#toggleUpdatePreferences').on('change', function() {
     if($(this).is(':checked')) {
         // Update tooltip text for ON
         $(this).parent()
             .attr('data-bs-original-title', 'Your current filter choices are saved in your Work Preferences & Flexibility section. Your preferences are updated for future job matching')
             .tooltip('show');
     } else {
         // Update tooltip text for OFF
         $(this).parent()
             .attr('data-bs-original-title', 'Temporary filtering, your current filter choices are not saved')
             .tooltip('show');
     }
   
     // Auto hide after 4s (optional)
     setTimeout(() => {
         $(this).parent().tooltip('hide');
     }, 4000);
   });
   
   $('.dropdown-toggle').on('click', function() {
   $(this).next('.dropdown-menu').toggle();
   });

     $(document).on('change', '#toggleRegisteredPreferences', function () {

      let toggle = $(this);
      let isChecked = toggle.is(':checked');
      let message = isChecked 
          ? "Filters will be auto-filled from your registered preferences."
          : "Filters will be cleared and not linked to your saved preferences.";
      Swal.fire({
          title: 'Confirm Change',
          text: message,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, continue',
          cancelButtonText: 'Cancel'
      }).then((result) => {
          if (result.isConfirmed) {
              if (isChecked) {
                  $('.auto_fill_message').show();
                  $('.auto_empty_message').hide();
                  fetchFilters('prefill'); // common ajax
              } else {
                  $('.auto_fill_message').hide();
                  $('.auto_empty_message').show();
                  fetchFilters('clear'); // common ajax
              }
          } else {
              toggle.prop('checked', !isChecked);
          }
      });
  });

  function fetchFilters(mode)
  {
      $.ajax({
          url: "{{ url('/nurse/fetch-job-filters') }}",
          type: "POST",
          data: {
              mode: mode,
              _token: $('meta[name="csrf-token"]').attr('content')
          },
          success: function(res){

              if(res.status === 'success')
              {
    
                  Swal.fire({
                      icon: 'success',
                      title: 'Success',
                      text: res.message,
                      timer: 2000,
                      showConfirmButton: false
                  });
              }
              else
              {
                  Swal.fire({
                      icon: 'warning',
                      title: 'Notice',
                      text: res.message
                  });
              }

          }
      });
  }
   
   // Close dropdown if clicked outside
   $(document).on('click', function(e) {
   if (!$(e.target).closest('.dropdown').length) {
     $('.dropdown-menu').hide();
   }
   });
   // Toggle dropdown
   $('.select-box').on('click', function() {
   $(this).siblings('.checkbox-options').toggle();
   });
   
   // Close when clicking outside
   $(document).on('click', function(e) {
   if (!$(e.target).closest('.custom-multiselect').length) {
     $('.checkbox-options').hide();
   }
   });
   
   // Handle checkbox selection
   $('.checkbox-options input[type="checkbox"]').on('change', function() {
   let selected = [];
   $(this).closest('.checkbox-options')
          .find('input[type="checkbox"]:checked')
          .each(function() {
             selected.push($(this).val());
          });
   
   // Update display text
   let displayText = selected.length > 0 ? selected.join(', ') : "Select Location";
   $(this).closest('.custom-multiselect').find('.select-box').text(displayText);
   
   // Update hidden field
   $('#selectedLocations').val(selected.join(','));
   });
   
   
     // Get all checked values
     var selected = $(".location-checkbox:checked").map(function () {
         return $(this).val();
     }).get();
   
     if (selected.length === 0) {
         // If nothing selected, show all jobs
         $(".job-card").show();
     } else {
         // Otherwise, filter
         $(".job-card").each(function () {
             var jobLocation = $(this).data("location");
             if (selected.includes(jobLocation)) {
                 $(this).show();
             } else {
                 $(this).hide();
             }
         });
     }
   
    function applyNow(user_id, job_id) {
        $.ajax({
            type: "POST",
            url: "{{ url('/nurse/applyJobs') }}",
            data: {
                user_id: user_id,
                job_id: job_id,
                _token: '{{ csrf_token() }}'
            },
            cache: false,
            success: function (response) {

                if (response.status == true) {

                    let btn = $('.apply-btn-' + job_id);

                    btn.text('Applied');
                    btn.addClass('applied');
                    btn.prop('disabled', true);

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        confirmButtonColor: '#3085d6'
                    });

                } else {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: response.message,
                        confirmButtonColor: '#d33'
                    });

                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong!',
                });
            }
        });
    }
   
  //  $(document).ready(function () {
  //  var itemsPerPage = 2;
  //  var currentPage = 1;
   
  //  // Get filtered jobs based on location + keyword
  //    function getFilteredItems() {
  //      var selectedLocations = $(".location-checkbox:checked")
  //        .map(function () {
  //          return $(this).val();
  //        })
  //        .get();
   
  //      var selectedAgency = $("#agency").val().trim();
  //      var keyword = $("#keywords").val().toLowerCase().trim();
   
  //      return $(".job-card.item").filter(function () {
  //        var matchesLocation =
  //          selectedLocations.length === 0 ||
  //          selectedLocations.includes($(this).data("location"));
   
  //        var jobAgency = $(this).find(".job-role").text().trim();
  //        var matchesAgency =
  //          selectedAgency === "" || jobAgency === selectedAgency;
   
  //        var matchesKeyword =
  //          keyword === "" || $(this).text().toLowerCase().indexOf(keyword) > -1;
   
  //        return matchesLocation && matchesAgency && matchesKeyword;
  //      });
  //    }
   
  //  function showPage(page) {
  //    var items = getFilteredItems();
  //    var totalPages = Math.ceil(items.length / itemsPerPage);
  //    if (page < 1) page = 1;
  //    if (page > totalPages) page = totalPages;
   
  //    currentPage = page;
  //    $(".job-card.item").hide();
   
  //    var start = (page - 1) * itemsPerPage;
  //    var end = start + itemsPerPage;
  //    items.slice(start, end).show();
   
  //    $(".pagination button.page").removeClass("active");
  //    $(".pagination button.page[data-page='" + page + "']").addClass("active");
   
  //    $(".pagination button.prev").prop("disabled", page === 1);
  //    $(".pagination button.next").prop("disabled", page === totalPages);
  //  }
   
  //  function buildPagination() {
  //    var items = getFilteredItems();
  //    var totalPages = Math.ceil(items.length / itemsPerPage);
  //    $(".pagination").empty();
   
  //    if (items.length === 0) {
  //      $(".pagination").html("<p>No jobs fou</p>");
  //      return;
  //    }
   
  //    if (totalPages > 1) {
  //      $(".pagination").append("<button class='prev'>&laquo;</button>");
  //      for (var i = 1; i <= totalPages; i++) {
  //        $(".pagination").append(
  //          "<button class='page' data-page='" + i + "'>" + i + "</button>"
  //        );
  //      }
  //      $(".pagination").append("<button class='next'>&raquo;</button>");
  //    }
  //    showPage(1);
  //  }
   
   
   
  //  // Pagination click events
  //  $(".pagination").on("click", "button.page", function () {
  //    showPage($(this).data("page"));
  //  });
   
  //  $(".pagination").on("click", "button.prev", function () {
  //    showPage(currentPage - 1);
  //  });
   
  //  $(".pagination").on("click", "button.next", function () {
  //    showPage(currentPage + 1);
  //  });
   
  //  // Checkbox filter change
  //  $(document).on("change", ".location-checkbox", function () {
  //    buildPagination();
  //  });
   
  //  $("#keywords").on("keyup", function () {
  //    buildPagination();
  //  });
   
  //  $("#agency").on("change", function () {
  //    buildPagination();
  //  });
   
  //  // Initial load
  //  buildPagination();
   
  //  // Accordion toggle (only when clicking the header text, not buttons)
  //  $(document).on("click", ".accordion-header", function(e) {
  //  if ($(e.target).is("button")) return; // ignore if button clicked
  //  $(this).next(".accordion-content").slideToggle();
  //  });
   
  //  // Select All
  //  // $(document).on("click", ".select-all", function(e) {
  //  //   e.stopPropagation(); // prevent toggle
  //  //   var target = $(this).data("target");
  //  //   $("#" + target + " .sector_checkbox").prop("checked", true);
  //  // });
   
  //  // Clear All
  //  // $(document).on("click", ".clear-all", function(e) {
  //  //   e.stopPropagation(); // prevent toggle
  //  //   var target = $(this).data("target");
  //  //   $("#" + target + " .sector_checkbox").prop("checked", false);
  //  // });
   
  //  });
   // 📌 Haversine formula (distance in km)
   function getDistance(lat1, lon1, lat2, lon2) {
   var R = 6371; // Earth radius in km
   var dLat = (lat2 - lat1) * Math.PI / 180;
   var dLon = (lon2 - lon1) * Math.PI / 180;
   var a =
     Math.sin(dLat / 2) * Math.sin(dLat / 2) +
     Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
     Math.sin(dLon / 2) * Math.sin(dLon / 2);
   var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
   return R * c;
   }
   
   // 📌 Get current user location (via browser)
   function getCurrentLocation(callback) {
   if (navigator.geolocation) {
     navigator.geolocation.getCurrentPosition(function (position) {
       callback({
         lat: position.coords.latitude,
         lng: position.coords.longitude
       });
     }, function () {
       alert("Unable to fetch your location. Please enable GPS.");
     });
   } else {
     alert("Geolocation is not supported by this browser.");
   }
   }
   
   // 📌 Fetch lat/lng using Nominatim if missing
   function fetchLatLng(address, $jobCard, callback) {
   $.get("https://nominatim.openstreetmap.org/search", {
     q: address,
     format: "json",
     limit: 1
   }, function (data) {
     if (data && data.length > 0) {
       $jobCard.attr("data-lat", data[0].lat);
       $jobCard.attr("data-lng", data[0].lon);
     }
     if (callback) callback();
   });
   }
   
   // 📌 Ensure all jobs have lat/lng before sorting
   function ensureLatLng(callback) {
   var $jobs = $(".job-card.item");
   var remaining = $jobs.length;
   
   $jobs.each(function () {
     var $job = $(this);
     var lat = $job.attr("data-lat");
     var lng = $job.attr("data-lng");
   
     if (!lat || !lng) {
       var address = $job.data("location");
       fetchLatLng(address, $job, function () {
         if (--remaining === 0) callback();
       });
     } else {
       if (--remaining === 0) callback();
     }
   });
   }
   
   // 📌 Sort jobs by proximity to current location
   function sortJobsByProximity(userCoords) {
   var $jobs = $(".job-card.item");
   
   $jobs.sort(function (a, b) {
     var distA = getDistance(userCoords.lat, userCoords.lng,
       $(a).data("lat"), $(a).data("lng"));
     var distB = getDistance(userCoords.lat, userCoords.lng,
       $(b).data("lat"), $(b).data("lng"));
     return distA - distB;
   });
   
   $(".job-listings").html($jobs); // Re-render sorted jobs
   }
   
   
   
</script>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
  lucide.createIcons();
</script>
@endsection