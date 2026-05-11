@extends('nurse.layouts.layout') @section('content')
@php
use Carbon\Carbon;
@endphp
<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #f7f9fc;
}

/* HERO */
.hero {
    background: #f2f4f7;
}

.hero-title {
    font-size: 38px;
    font-weight: 700;
}

.hero-text {
    color: #666;
    font-size: 16px;
    font-weight: 500
}

.create-btn {
    /* background: #fff3cd; */
    background: #50b5a3;
    color: #fff;
    padding: 12px 20px;
    display: inline-block;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 500;
}

.hero-img {
    width: 90%;
    border-radius: 15px;
}

.new-hero-section .block-banner {
    background: transparent !important;
    padding: 20px !important;
}

.new-hero-section .block-banner .form-find {
    background: transparent !important;
    box-shadow: none;
}

.bg-white {
    background: white;
}

.shadow-white {
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
}

/* FILTER */
.filters {
    border-radius: 10px;
    /* display: grid;
                                                                                                                                grid-template-columns: repeat(5, 1fr); */
}

.filter-item {
    /* padding: 10px 0; */
    font-weight: 600;
    font-size: 15px;
    display: flex;
    gap: 10px;
    align-items: flex-start;
    justify-content: center;
}

.filter-item h4 {
    font-size: 14px;
    text-align: left;
}

.filter-item p {
    font-size: 12px;
    color: #888;
    margin: 0;
    text-align: left;
}

/* FEATURE CARDS */
.feature-card {
    background: #edf0f5;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
    width: 100%;
    height: 100%;
}

.feature-card h5 {
    font-size: 16px;
}

.nurse-card {
    display: flex;
    flex-direction: column;
}

.feature-card h4 {
    margin-bottom: 20px;
    font-weight: 700;
    font-size: 28px;
    line-height: 38px;
    text-align: center;
    margin-top: 15px;
}

.feature-card ul {
    margin-top: 6px;
    list-style: none;
    padding-left: 0;
    display: flex;
    flex-direction: column;
}

.feature-card li {
    position: relative;
    padding-left: 22px;
    margin-bottom: 6px;
    color: #666;
    /* display: inline-block; */
    text-align: left;
    font-weight: 500;
}

.feature-card li::after {
    content: "\f00c";
    font-family: "FontAwesome";
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    font-size: 12px;
    /* color: #50b5a3; */
    color: #000;
}

.feature-card a {
    color: #2d2de3d4;
    cursor: pointer;
    padding: 0 20px;
}

.mt-15 {
    margin-top: 30px !important;
}

/* JOB CARDS */
.job-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    display: flex;
    flex-direction: column;
    height: 100%;
}

.job-content {
    padding: 20px;
}

.job-price {
    font-weight: 600;
    color: #000;
    margin-top: 10px;
    background: #2d6cdf21;
    width: fit-content;
    padding: 5px 10px;
    border-radius: 10px;
    font-size: 14px;
}

.job-right-content {
    font-size: 14px;
    font-weight: 600;
    color: #000;

}

.job-content button {
    margin-top: 20px;
    width: 100%;
    background: #edf0f5;
}

.nurse-card i {
    /* color: #50b5a3; */
    color: #000;
    margin-right: 5px;
    font-size: 14px;
    text-align: center;
}

.hr-bg {
    background: #6666668c;
    margin: 12px 0;
}

.star {
    color: #ddbc52;
    font-size: 18px;
}

.circle-check i {
    color: #50b5a3;
}

.filter-item i {
    font-size: 22px;
    margin-top: 6px;
}

/* 10/03  */
.filters {
    border-radius: 14px;
    overflow: hidden;
}

.filters .col-md-2 {
    border-right: 1px solid #eceff4;
    transition: all .3s ease;
}

.filters .col-md-2:last-child {
    border-right: none;
}

.filter-item {
    transition: all .25s ease;
}

.filter-item:hover {
    transform: translateY(-3px);
}

/* icon circle */

.filter-item i {
    font-size: 18px;
}

.circle-check i,
.clock i {
    background: #eef7f5;
    color: #50b5a3;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

/* star */

.star {
    background: #fff5da;
    color: #d7b64b;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

/* headings */

.filter-item h4 {
    font-size: 14px;
    font-weight: 600;
    margin: 0;
}

.filter-item p {
    font-size: 12px;
    color: #8a8f98;
}

.mb-20 {
    margin-bottom: 20px;
}

/* modal  */
.side-modal {
    display: none;
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: rgba(0, 0, 0, 0.4);
}

.side-modal-content {
    position: absolute;
    right: 0;
    top: 0;
    width: 420px;
    max-width: 100%;
    height: 100%;
    background: #fff;
    padding: 25px;
    overflow-y: auto;
    animation: slideInRight 0.3s ease;
}

@keyframes slideInRight {
    from {
        right: -420px;
    }

    to {
        right: 0;
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.close-btn {
    font-size: 22px;
    cursor: pointer;
}

.submenu {
    list-style: none;
    padding: 0;
}

.submenu li {
    margin-bottom: 12px;
}

.submenu li a {
    text-decoration: none;
    color: #333;
}

.more-btn a {
    background: #000;
    color: #fff;
    padding: 6px 10px !important;
    border-radius: 20px;
    margin: 6px 0 0;
    font-weight: 500;
    font-size: 12px;
    display: inline;
}

/* ========================= */
.text-30 {
    font-size: 28px;
    font-weight: 700;
}

.credential i {
    /* color: #50b5a3; */
    color: #000;
    margin-right: 6px;
}

.credential h4 {
    font-size: 16px;
    margin-top: 12px;
}

.latest-job-card {
    position: relative;
}

.latest-job-card .top-note {
    position: absolute;
    top: 6px;
    left: 9px;
}

.top-note p {
    background: #50b5a3;
    color: #fff;
    padding: 0px 10px;
    font-size: 12px;
    border-radius: 8px;
    font-weight: 500;
}

.stop h4 {
    font-size: 16px;
}

.stop h4 span {
    font-size: 20px;
    font-weight: 800;
    margin-left: 4px;
}

.score-cards {
    padding: 20px;
    border-radius: 10px;
    width: 100%;
}

.tooltip-circle {
    background: #50b5a3;
    /* padding: 1px 9px; */
    border-radius: 100%;
    width: 100%;
    display: inline-flex;
    width: fit-content;
    justify-content: center;
    align-items: center;
    width: 18px;
    height: 18px;
}

.tooltip-circle i {
    font-size: 10px;
}

.step1 {
    background: #cfe8df;
    color: #2f9c7a;
}

.step2 {
    background: #dbe9f8;
    color: #2d74c4;
}

.step3 {
    background: #fde7c7;
    color: #e59e26;
}

.card-box {
    background: #fff;
    border-radius: 10px;
}

.list-item {
    background: #f5f7fa;
    padding: 8px 15px;
    border-radius: 8px;
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13px;
    font-weight: 500;
}

.check-list li {
    margin-bottom: 10px;
}

.info-icon {
    color: #fff;
    cursor: pointer;
}

/* ======== */

.tooltip-container {
    position: relative;
    display: inline-block;
}

.tooltip-btn {
    cursor: pointer;
    margin-left: 5px;
    color: #2563eb;
    font-weight: bold;
}

.tooltip_speciality_status {
    display: none;
    position: absolute;
    top: 25px;
    /* left: 0; */
    right: 0;
    width: 320px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 10px;
    font-size: 12px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
    z-index: 999;
}

.tooltip_speciality_status ul {
    padding-left: 18px;
    margin: 0;
}

/* Show on hover */
.tooltip-container:hover .tooltip_speciality_status {
    display: block;
}

/* shift structure  */
.extra-shift {
    display: none;
}

.nurse-card.show-all .extra-shift {
    display: list-item;
}

.show-more-btn {
    color: #2d2de3d4;
    cursor: pointer;
    font-size: 14px;
}

/* ====================== */
/* JOB CARD */
.job-card {
    background: #fff;
    border-radius: 14px;
    padding: 14px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    border: 1px solid #000;
}

/* Header */
.job-title {
    font-weight: 700;
    font-size: 16px;
}

.heart {
    font-size: 18px;
    color: #bbb;
    cursor: pointer;
}

.heart:hover {
    color: #e74c3c;
}

/* Location & type */
.job-meta {
    font-size: 12px;
    color: #6c757d;
}

.job-meta i {
    margin-right: 4px;
    font-size: 11px;
}

/* Salary */
.salary {
    color: #0a7c86;
}

.nurse-salary {
    font-size: 16px;
    font-weight: 700;
}

/* Badge */
.badge-new {
    background: #d4f5ea;
    color: #198754;
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 20px;
    font-weight: 600;
    height: fit-content;
}

.badge-temporary {
    background: #FEE2E2;
    color: #B91C1C;
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 20px;
    font-weight: 600;
    height: fit-content;
}

.badge-fixed-term {
    background: #DBEAFE;
    color: #1E40AF;
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 20px;
    font-weight: 600;
    height: fit-content;
}

/* Details list */
.job-details {
    font-size: 12px;
    margin-top: 8px;
    color: #495057;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}


/* Footer */
.job-footer {
    margin-top: auto;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 20px;
    enter;
}

.match {
    font-size: 13px;
    color: #6c757d;
}

.nurse-apply-btn {
    background: #000;
    color: #fff;
    /* border: 1px solid #2c7a7b; */
    padding: 12px;
    border-radius: 6px;
    font-size: 12px;
    display: inline;
    transition: all ease-in-out .3s
}

.nurse-apply-btn:hover {
    background: #fff;
    border: 1px solid #000;
    color: #000 !important;
}

.create-space {
    padding-right: 14px;
}

.pt-scroll {
    padding-top: 40px;
}

.more-btn a:hover {
    text-decoration: underline;
}

.feature-card a {
    color: transparent;
    cursor: pointer;
    padding: unset;
}

.icon_modalRight i {
    font-size: 10px;
}

.box-image-job .img-job-2 {
    position: absolute;
    bottom: -70px;
    right: -80px;
    width: 300px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
    border-radius: 16px;
}

.sec-essential {
    padding: 48px 0 100px;
}

.matching-hover {
    padding: 0 !important;
    width: auto !important;
}

.feature-card .tooltip_speciality_status li::after {
    top: 14px !important;

}

/* card section 30/3/26  */
/* SECTION */
.section-card {
    border-top: 1px solid #eee;
    /* padding: 12px 0; */
    transition: all ease-in-out .3s;
}

.section-card p {
    position: relative;
    padding-left: 22px;
    margin-bottom: 6px;
    color: #666;
    /* display: inline-block; */
    text-align: left;
    font-weight: 500;
}

.section-card p::after {
    content: "\f00c";
    font-family: "FontAwesome";
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    font-size: 12px;
    /* color: #50b5a3; */
    color: #000;
}

/* HEADER */
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
}

.section-header i {
    font-size: 10px;
    /* margin-right: 10px; */
}

.section-title {
    font-weight: 600;
    display: flex;
    align-items: center;
}

.section-title i {
    font-size: 16px;
    margin-right: 8px;
}

/* CHEVRON */
.chevron {
    transition: 0.3s;
}

.rotate {
    transform: rotate(90deg);
}

/* CONTENT */
.section-content {
    max-height: 0;
    overflow: hidden;
    margin-top: 0;
    background: #fff;
    border-radius: 10px;
    padding: 0 20px;
    /* remove vertical padding initially */
    opacity: 0;

    transition:
        max-height 0.4s ease,
        opacity 0.3s ease,
        padding 0.3s ease,
        margin 0.3s ease;
}

/* OPEN STATE */
.section-card.active .section-content {
    max-height: fit-content;
    /* adjust if needed */
    opacity: 1;
    margin-top: 10px;
    padding: 10px 20px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
}

.section-content p {
    margin: 4px 0;
    font-size: 14px;
}

.section-card.active .chevron {
    transform: rotate(90deg);
}

/* CTA */
.cta-btn {
    background: #000;
    color: #fff;
    padding: 12px 30px;
    border-radius: 8px;
    margin-top: 30px;
    display: inline-block;
    font-weight: 600;
}

.res-space {
    padding: 3rem;
}

/* 16/4/26  */
/* === HERO SECTION RESPONSIVE === */

/* Desktop: banner-imgs uses absolute positioning from the theme */
/* Tablet & below: give it real height so images show */

@media (max-width: 991.98px) {
    .banner-hero.hero-1 .banner-imgs {
        display: block !important;
    }
}

@media (max-width: 991px) {

    /* Give the image column a defined height so positioned images are visible */
    .hero-banner-col {
        display: block !important;
        margin-top: 30px;
    }

    .banner-imgs {
        position: relative;
        width: 100%;
        height: 320px;
        /* enough room for the stacked nurse images */
        overflow: hidden;
        border-radius: 16px;
    }

    /* Center the text column on tablet */
    .hero-wrapper {
        text-align: center;
    }

    .hero-wrapper .btn {
        display: inline-block;
        width: auto;
    }

    /* Reduce bottom margin on the search box wrapper */
    .box-search-2 {
        margin-bottom: 0 !important;
    }

    .hero-banner-col {
        display: block !important;
        margin-top: 30px;
    }

    .hero-banner-col .banner-imgs {
        position: relative !important;
        display: block !important;
        width: 100%;
        height: 380px;
        /* force height so absolute children appear */
        overflow: visible;
        /* don't clip the positioned images */
    }

    /* Scale down the individual nurse image shapes to fit smaller screen */
    .hero-banner-col .banner-imgs img {
        max-width: 130px;
    }

    .res-space {
        padding: 2rem;
    }

    .feature-card h4 {
        margin-bottom: 16px;
        font-size: 18px;
        line-height: 30px;
        margin-top: 5px;
    }

    /* .res-h4 {
    margin-bottom: 16px;
    font-size: 18px;
    line-height: 30px;
    margin-top: 5px;
} */
    .feature-card svg {
        width: 60px;
        height: 60px;
    }
}

@media (max-width: 768px) {

    .banner-imgs {
        height: 260px;
    }

    .hero-title {
        font-size: 24px;
        line-height: 34px;
    }

    .hero-text {
        font-size: 14px;
    }

    /* Stack text left on small mobile */
    .hero-wrapper {
        text-align: left;
    }

    /* .hero-wrapper .btn {
        width: 100%;
        text-align: center;
        display: block;
        margin-bottom: 20px;
    } */

    /* Reduce section top/bottom padding */
    .banner-hero {
        padding: 24px 0 !important;
    }

    .new-hero-section {
        padding: 0 !important;
    }

    .hero-banner-col .banner-imgs {
        height: 300px;
    }

    .hero-banner-col .banner-imgs img {
        max-width: 100px;
    }

    .hero-title {
        font-size: 24px;
        line-height: 34px;
    }

    .hero-text {
        font-size: 14px;
    }



    .banner-hero {
        padding: 24px 0 !important;
    }

    .box-search-2 {
        margin-bottom: 0 !important;
    }

    .new-hero-section .block-banner {
        padding: 0 !important;
    }

    .filter-item {
        justify-content: start;
        padding-left: 14px;
    }

    .star {
        width: 30px;
        height: 30px;
    }

    .filter-item i {
        font-size: 14px;
    }

    .banner-hero.hero-1 h1 {
        font-size: 36px;
        line-height: 68px;
    }

    .res-space h2 {
        font-size: 28px;
        /* line-height: 45px; */

    }

    .box-search-2 {
        margin-bottom: 16px !important;
    }

    .feature-card li {
        padding-left: 16px;
        margin-bottom: 6px;
        font-size: 13px;
    }

    .icon_modalRight i {
        font-size: 8px;
    }

    .section-title {
        font-size: 13px;
    }

    .card-main-icons i {
        font-size: 13px !important;
    }

    .feature-card {
        padding: 20px 14px;
    }

    .section-header i {
        font-size: 8px;
    }

    .btn.btn-default {
        line-height: 22px;
        padding: 6px 16px;
        font-size: 12px;
    }

    .sec-essential {
        padding: 48px 0 0;
    }
    .score-cards h5{
        font-size: 16px;
    }
    .mt-15 {
    margin-top: 14px !important;
}

    /* .section-header i {
    font-size: 8px;
} */

}

@media (max-width: 480px) {

    .banner-imgs {
        height: 220px;
    }

    .hero-title {
        font-size: 20px;
        line-height: 40px !important;
    }

    .hero-banner-col .banner-imgs {
        height: 240px;
    }

    .hero-banner-col .banner-imgs img {
        max-width: 80px;
    }

    .hero-title {
        font-size: 20px;
        line-height: 30px;
    }

    .new-hero-section .block-banner .form-find {
        margin-top: 0 !important;
    }

    .banner-hero.hero-1 h1 {
        font-size: 28px !important;
    }

    .filter-item {
        justify-content: flex-start;
    }

    .res-space {
        padding: 1rem;
    }

    .mb-20 {
        margin-bottom: 0px !important;
    }

    h2 {
        font-size: 18px;
    }

    .mt-15 {
        margin-top: 20px !important;
    }

    .feature-card h4 {
        margin-bottom: 10px;
        font-size: 20px;
        line-height: 30px;
        margin-top: 8px;
    }

    .hero-wrapper .btn {
        /* width: 100%; */
        text-align: center;
        display: block;
    }

    .res-space h2 {
        font-size: 20px;
    }

    .build {
        font-size: 18px;
    }

    .sec-essential {
        padding: 32px 0 0;
    }
 .content-job-inner {
    padding: 16px 16px 0;
}
.text-30 {
    font-size: 20px;
}
.hr-bg {
    margin: 6px 0;
}
  .hero-wrapper {
        text-align: left;
    }

}
</style>
<main class="main">
    <div class="bg-homepage4"></div>
    {{-- <section class="section-box mb-70">
		<div class="banner-hero hero-1 banner-homepage5">
			<div class="banner-inner">
				<div class="row align-items-center">
					<div class="col-xl-7 col-lg-12">
						<div class="block-banner pt-0">
							<div class="box-search-2 mb-40">
								<div class="block-banner p-0">
									<div class="form-find  wow animate__animated animate__fadeIn w-100"
                                            data-wow-delay=".2s">
										<form class="search-form">
											<div class="w-100 ">
												<label for="" class="form-label">What</label>
												<input class="form-input input-keysearch mr-10 py-0"
                                                        style="height: unset;" type="text"
                                                        placeholder="Job Title, Keywords, Specialty">
												</div>
												<div class="form-find-select mr-10">
													<label for="" class="form-label">Where</label>
													<select class="form-input mr-10 select-active" style="height: unset;">
														<option value="">Job Location</option>
														<option value="AX">option 1</option>
														<option value="AF">option 2</option>
													</select>
												</div>
												<a class="btn btn-default btn-find font-sm"
                                                    href='{{ route('nurse.login') }}'></a>
    </form>
    </div>
    </div>
    </div>
    <!-- <h1 class="heading-banner wow animate__animated animate__fadeInUp"> Register and<br class="d-none d-lg-block">create your profile</h1> -->
    <div class="banner-description mt-20 wow animate__animated animate__fadeInUp" data-wow-delay=".1s"> Refine your
        search by specialty, location, time, and assignment duration. Apply directly for the ideal shift or permanent
        position. Connect with Medical facilities and agencies. </div>
    <div class="mt-30">
        <a class="btn btn-default mr-15" href="{{ route('nurse.nurse-register') }}">Register in 1 Minute</a>
    </div>
    </div>
    </div>
    <div class="col-xl-5 col-lg-12 d-none d-xl-block col-md-6">
        <div class="banner-imgs">
            <div class="banner-1 shape-1">
                <img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/nurse1.png') }}">
            </div>
            <div class="banner-2 shape-2">
                <img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/nurse2.png') }}">
            </div>
            <div class="banner-3 shape-3">
                <img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/nurse3.png') }}">
            </div>
            <div class="banner-4 shape-3">
                <img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/nurse4.png') }}">
            </div>
            <div class="banner-5 shape-2">
                <img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/nurse5.png') }}">
            </div>
            <div class="banner-6 shape-1">
                <img class="img-responsive" alt="jobBox" src="{{ asset('nurse/assets/imgs/nurse6.png') }}">
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </section> --}}
    {{-- <section class="section-box mt-70 mb-40">
									<div class="container">
										<div class="text-center">
											<h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">You're crucial!</h2>
                    {{-- 
											<p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">Just via some simple steps, you will find your ideal candidates you’r looking for!" : You're crucial!</p> --}}
    {{-- <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">With just a few simple
                        steps, you'll find the ideal nursing and midwifery jobs you are looking for!</p>
										</div>
										<div class="mt-70">
											<div class="row">
												<div class="col-lg-4">
													<div class="box-step step-1">
														<h1 class="number-element">1</h1>
														<h4 class="mb-10">You have the 
															<br>power
															</h4>
															<p class="font-lg color-text-paragraph-2">Customize your profile with personal 
																<br>
                                    information, certifications, preferences, specified qualifications, credentials,
																	<br>
                                    experience levels, references and any other relevant details.
                                
																	</p>
																</div>
															</div>
															<div class="col-lg-4">
																<div class="box-step step-2">
																	<h1 class="number-element">2</h1>
																	<h4 class="mb-10">We stay in 
																		<br>touch
																		</h4>
																		<p class="font-lg color-text-paragraph-2">Behind our software using latest 
																			<br> Ai
                                    technology, we are here to understand 
																				<br> your needs and help you to go 
																					<br>through
                                    this fast process. 
																					</p>
																				</div>
																			</div>
																			<div class="col-lg-4">
																				<div class="box-step">
																					<h1 class="number-element">3</h1>
																					<h4 class="mb-10">Receive tailored 
																						<br>job offers fast
																						</h4>
																						<p class="font-lg color-text-paragraph-2">Medical facilities and agencies 
																							<br> are actively
                                    competing, prompting 
																								<br> them to move quickly
																								</p>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div> --}}
    {{-- </section>  --}}
    {{-- <section class="section-box mt-50">
																			<div class="section-box wow animate__animated animate__fadeIn">
																				<div class="container">
																					<div class="text-center">
																						<h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">Latest Jobs</h2>
																					</div>
																					<div class="row mt-50">
																						<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
																							<div class="card-grid-2 grid-bd-16 hover-up">
																								<div class="card-grid-2-image">
																									<span
                                        class="lbl-hot bg-green">
																										<span>Anaesthetics</span>
																									</span>
																									<div class="image-box">
																										<figure>
																											<img src="{{ asset('nurse/assets/imgs/page/homepage2/img1.png') }}" alt="jobBox"> </figure>
    </div>
    </div>
    <div class="card-block-info">
        <h5>
            <a href='#'>Anaesthetics</a>
        </h5>
        <div class="mt-5">
            <span class="card-location mr-15">New York, US</span>
            <span class="card-time">7:00 AM - 5:30 PM</span>
        </div>
        <div class="card-2-bottom mt-20">
            <div class="row">
                <div class="col-xl-7 col-md-7 mb-2">
                    <a class='btn btn-tags-sm mr-5' href='#'>Start Application</a>
                </div>
                <div class="col-xl-5 col-md-5 text-lg-end">
                    <span class="card-text-price">$90 - $120</span>
                    <span class="text-muted">/Hour</span>
                </div>
            </div>
        </div>
        <p class="font-sm color-text-paragraph mt-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Recusandae architecto eveniet, dolor quo repellendus pariatur</p>
    </div>
    </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
        <div class="card-grid-2 grid-bd-16 hover-up">
            <div class="card-grid-2-image">
                <span class="lbl-hot">
                    <span>Full time</span>
                </span>
                <div class="image-box">
                    <figure>
                        <img src="{{ asset('nurse/assets/imgs/page/homepage2/img2.png') }}" alt="jobBox">
                    </figure>
                </div>
            </div>
            <div class="card-block-info">
                <h5>
                    <a href='#'>Gen Med/Gen Surg Ward</a>
                </h5>
                <div class="mt-5">
                    <span class="card-location mr-15">New York, US</span>
                    <span class="card-time">7:00 AM - 5:30 PM</span>
                </div>
                <div class="card-2-bottom mt-20">
                    <div class="row">
                        <div class="col-xl-7 col-md-7 mb-2">
                            <a class='btn btn-tags-sm mr-5' href='#'>Start Application</a>
                        </div>
                        <div class="col-xl-5 col-md-5 text-lg-end">
                            <span class="card-text-price">$80 - $150</span>
                            <span class="text-muted">/Hour</span>
                        </div>
                    </div>
                </div>
                <p class="font-sm color-text-paragraph mt-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Recusandae architecto eveniet, dolor quo repellendus pariatur</p>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
        <div class="card-grid-2 grid-bd-16 hover-up">
            <div class="card-grid-2-image">
                <span class="lbl-hot">
                    <span>Full time</span>
                </span>
                <div class="image-box">
                    <figure>
                        <img src="{{ asset('nurse/assets/imgs/page/homepage2/img3.png') }}" alt="jobBox">
                    </figure>
                </div>
            </div>
            <div class="card-block-info">
                <h5>
                    <a href='#'>Anaesthetics</a>
                </h5>
                <div class="mt-5">
                    <span class="card-location mr-15">New York, US</span>
                    <span class="card-time">7:00 AM - 5:30 PM</span>
                </div>
                <div class="card-2-bottom mt-20">
                    <div class="row">
                        <div class="col-xl-7 col-md-7 mb-2">
                            <a class='btn btn-tags-sm mr-5' href='#'>Start Application</a>
                        </div>
                        <div class="col-xl-5 col-md-5 text-lg-end">
                            <span class="card-text-price">$120 - $150</span>
                            <span class="text-muted">/Hour</span>
                        </div>
                    </div>
                </div>
                <p class="font-sm color-text-paragraph mt-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Recusandae architecto eveniet, dolor quo repellendus pariatur</p>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
        <div class="card-grid-2 grid-bd-16 hover-up">
            <div class="card-grid-2-image">
                <span class="lbl-hot">
                    <span>Full time</span>
                </span>
                <div class="image-box">
                    <figure>
                        <img src="{{ asset('nurse/assets/imgs/page/homepage2/img4.png') }}" alt="jobBox">
                    </figure>
                </div>
            </div>
            <div class="card-block-info">
                <h5>
                    <a href='#'>Gen Med/Gen Surg Ward</a>
                </h5>
                <div class="mt-5">
                    <span class="card-location mr-15">New York, US</span>
                    <span class="card-time">7:00 AM - 5:30 PM</span>
                </div>
                <div class="card-2-bottom mt-20">
                    <div class="row">
                        <div class="col-xl-7 col-md-7 mb-2">
                            <a class='btn btn-tags-sm mr-5' href='#'>Start Application</a>
                        </div>
                        <div class="col-xl-5 col-md-5 text-lg-end">
                            <span class="card-text-price">$80 - $150</span>
                            <span class="text-muted">/Hour</span>
                        </div>
                    </div>
                </div>
                <p class="font-sm color-text-paragraph mt-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Recusandae architecto eveniet, dolor quo repellendus pariatur</p>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
        <div class="card-grid-2 grid-bd-16 hover-up">
            <div class="card-grid-2-image">
                <span class="lbl-hot">
                    <span>Full time</span>
                </span>
                <div class="image-box">
                    <figure>
                        <img src="{{ asset('nurse/assets/imgs/page/homepage2/img5.png') }}" alt="jobBox">
                    </figure>
                </div>
            </div>
            <div class="card-block-info">
                <h5>
                    <a href='#'>Anaesthetics</a>
                </h5>
                <div class="mt-5">
                    <span class="card-location mr-15">New York, US</span>
                    <span class="card-time">7:00 AM - 5:30 PM</span>
                </div>
                <div class="card-2-bottom mt-20">
                    <div class="row">
                        <div class="col-xl-7 col-md-7 mb-2">
                            <a class='btn btn-tags-sm mr-5' href='#'>Start Application</a>
                        </div>
                        <div class="col-xl-5 col-md-5 text-lg-end">
                            <span class="card-text-price">$80 - $150</span>
                            <span class="text-muted">/Hour</span>
                        </div>
                    </div>
                </div>
                <p class="font-sm color-text-paragraph mt-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Recusandae architecto eveniet, dolor quo repellendus pariatur</p>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
        <div class="card-grid-2 grid-bd-16 hover-up">
            <div class="card-grid-2-image">
                <span class="lbl-hot">
                    <span>Full time</span>
                </span>
                <div class="image-box">
                    <figure>
                        <img src="{{ asset('nurse/assets/imgs/page/homepage2/img6.png') }}" alt="jobBox">
                    </figure>
                </div>
            </div>
            <div class="card-block-info">
                <h5>
                    <a href='#'>Gen Med/Gen Surg Ward</a>
                </h5>
                <div class="mt-5">
                    <span class="card-location mr-15">New York, US</span>
                    <span class="card-time">7:00 AM - 5:30 PM</span>
                </div>
                <div class="card-2-bottom mt-20">
                    <div class="row">
                        <div class="col-xl-7 col-md-7 mb-2">
                            <a class='btn btn-tags-sm mr-5' href='#'>Start Application</a>
                        </div>
                        <div class="col-xl-5 col-md-5 text-lg-end">
                            <span class="card-text-price">$80 - $150</span>
                            <span class="text-muted">/Hour</span>
                        </div>
                    </div>
                </div>
                <p class="font-sm color-text-paragraph mt-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Recusandae architecto eveniet, dolor quo repellendus pariatur</p>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </section> --}}
    <!-- <section class="section-box overflow-visible mt-50 mb-0 bg-cat2"><div class="container"><div class="row"><div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12"><div class="text-center"><h1 class="color-brand-2"><span class="count">25</span><span> K+</span></h1><h5>Completed Cases</h5><p class="font-sm color-text-paragraph mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec justo a quam varius maximus. Maecenas sodales tortor quis tincidunt commodo.</p></div></div><div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12"><div class="text-center"><h1 class="color-brand-2"><span class="count">17</span><span> +</span></h1><h5>Our Office</h5><p class="font-sm color-text-paragraph mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec justo a quam varius maximus. Maecenas sodales tortor quis tincidunt commodo.</p></div></div><div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12"><div class="text-center"><h1 class="color-brand-2"><span class="count">86</span><span> +</span></h1><h5>Skilled People</h5><p class="font-sm color-text-paragraph mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec justo a quam varius maximus. Maecenas sodales tortor quis tincidunt commodo.</p></div></div><div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12"><div class="text-center"><h1 class="color-brand-2"><span class="count">28</span><span> +</span></h1><h5>Happy Clients</h5><p class="font-sm color-text-paragraph mt-10">We always provide people a <br class="d-none d-lg-block">complete solution upon focused of <br class="d-none d-lg-block">any business</p></div></div></div></div></section> -->
    {{-- <section class="section-box overflow-visible mt-80 mb-100">
																									<div class="container">
																										<div class="row">
																											<div class="col-lg-6 col-sm-12">
																												<div class="box-image-job">
																													<!-- <img class="img-job-1" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/img-chart.png') }}">
    --> {{-- <img class="img-job-2" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/img-chart.png')}}">
    --}} {{-- <figure class="wow animate__ animate__fadeIn animated"
                                style="visibility: visible; animation-name: fadeIn;">
																															<img alt="jobBox"
                                    src="{{ asset('nurse/assets/imgs/img1.png') }}"> </figure>
    </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="content-job-inner">
            <h2 class="text-52 wow animate__ animate__fadeInUp animated"
                style="visibility: visible; animation-name: fadeInUp;">You have the power, receive tailored job offers
                fast!</h2>
            <div class="mt-20 pr-50 text-md-lh28 wow animate__ animate__fadeInUp animated"
                style="visibility: visible; animation-name: fadeInUp;">Accept or reject interview invitations. Evaluate
                multiple offers from leading hospitals. Select the best match for your needs.</div>
            <div class="mt-20">
                <div class="wow animate__ animate__fadeInUp animated"
                    style="visibility: visible; animation-name: fadeInUp;">
                    <a class="btn btn-default" href='{{ route('nurse.login') }}'>Get Interviews</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div> --}} {{-- </section>  --}}
    {{-- <section class="section-box bg-15 pt-50 pb-50 mt-80">
																											<div class="container">
																												<div class="row align-items-center">
																													<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 text-center">
																														<img class="img-job-search mt-20"
                            src="{{ asset('nurse/assets/imgs/page/homepage3/img-job-search.png') }}" alt="jobBox">
    </div>
    <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12">
        <h2 class="mb-40 text-white">Job search for people passionate about startup</h2>
        <div class="box-checkbox mb-30">
            <h6 class="text-white">Create an account</h6>
            <p class="text-white font-sm opacity_6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec
                justo a quam varius maximus. Maecenas sodales tortor quis tincidunt commodo. </p>
        </div>
        <div class="box-checkbox mb-30">
            <h6 class="text-white">Search for Jobs</h6>
            <p class="text-white font-sm opacity_6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec
                justo a quam varius maximus. Maecenas sodales tortor quis tincidunt commodo. </p>
        </div>
        <div class="box-checkbox mb-30">
            <h6 class="text-white">Save &amp; Apply</h6>
            <p class="text-white font-sm opacity_6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec
                justo a quam varius maximus. Maecenas sodales tortor quis tincidunt commodo. </p>
        </div>
    </div>
    </div>
    </div>
    </section> --}} {{-- New Home page 9/03 --}}
    <div>
        <!-- HERO -->
        {{-- <section class="hero py-5">
																													<div class="container">
																														<div class="row align-items-center">
																															<div class="col-lg-7 col-sm-12">
																																<h1 class="hero-title">Find Jobs That Actually Match You</h1>
																																<p class="hero-text"> Powered by your preferences, credentials, and flexibility.</p>
																																<p class="hero-text mt-4"> 
                                No more endless scrolling. Mediqe uses your profile Compliance and availability to show the roles you're most likely t get.
                            </p>
																																<a class="create-btn mt-3">Create Your Free Profile</a>
																															</div>
																															<div class="col-xl-5 col-lg-12 d-none d-xl-block col-md-6">
																																<img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54" class="hero-img">
																																</div>
																															</div>
																														</div>
																													</section> --}}
        <section class="section-box mb-20">
            <div class="banner-hero hero-1 banner-homepage5">
                <div class="banner-inner container">
                    <div class="row align-items-center new-hero-section">
                        <div class="col-12 col-lg-7">
                            <div class="block-banner pt-0">
                                <div class="box-search-2 mb-40">
                                    <div class="block-banner p-0">
                                        <div class="form-find  wow animate__animated animate__fadeIn w-100"
                                            data-wow-delay=".2s">
                                            <div class="hero-wrapper">
                                                <h1 class="hero-title">Find Jobs That Actually Match You</h1>
                                                <p class="hero-text"> Powered by your preferences, credentials, and
                                                    flexibility.</p>
                                                <p class="hero-text mt-2">
                                                    <!-- No more endless scrolling. Mediqa uses your
                                                    profile, compliance, and availability to show the roles you’re most
                                                    likely to get.  -->
                                                    No more endless scrolling or applying to jobs that don’t fit.
                                                </p>
                                                <a class="btn btn-default btn-shadow hover-up mt-3">Create Your Free
                                                    Profile</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class="banner-imgs">
                                <div class="banner-1 shape-1">
                                    <img class="img-responsive" alt="jobBox"
                                        src="{{ asset('nurse/assets/imgs/nurse1.png') }}">
                                </div>
                                <div class="banner-2 shape-2">
                                    <img class="img-responsive" alt="jobBox"
                                        src="{{ asset('nurse/assets/imgs/nurse2.png') }}">
                                </div>
                                <div class="banner-3 shape-3">
                                    <img class="img-responsive" alt="jobBox"
                                        src="{{ asset('nurse/assets/imgs/nurse3.png') }}">
                                </div>
                                <div class="banner-4 shape-3">
                                    <img class="img-responsive" alt="jobBox"
                                        src="{{ asset('nurse/assets/imgs/nurse4.png') }}">
                                </div>
                                <div class="banner-5 shape-2">
                                    <img class="img-responsive" alt="jobBox"
                                        src="{{ asset('nurse/assets/imgs/nurse5.png') }}">
                                </div>
                                <div class="banner-6 shape-1">
                                    <img class="img-responsive" alt="jobBox"
                                        src="{{ asset('nurse/assets/imgs/nurse6.png') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- FILTER TAGS -->
        <section>
            <div class="container res-space">
                <div class="row text-center filters py-4 bg-white shadow-white">
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="filter-item">
                            {{-- ⭐ --}}
                            <div>
                                <i class="fa fa-star star" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h4>Top Matches</h4>
                                <p>Based on profile</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="filter-item">
                            {{-- ✔  --}}
                            <div class="circle-check">
                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h4>Instant Connect</h4>
                                <p>Same day shifts</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="filter-item">
                            {{-- ⏱  --}}
                            <div class="">
                                <i class="fa fa-clock-o star" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h4> Last Minute</h4>
                                <p>Within 48h</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="filter-item">
                            {{-- ▶ --}}
                            <div class="circle-check">
                                <i class="fa fa-play" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h4> Immediate Start </h4>
                                <p>Within 7 days</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="filter-item">
                            {{-- ▶ --}}
                            <div class="">
                                <i class="fa fa-briefcase star"></i>
                            </div>
                            <div>
                                <h4> Urgent Hire </h4>
                                <p>Employer priority</p>
                            </div>

                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="filter-item">
                            {{-- ＋  --}}
                            <div class="circle-check">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h4> New </h4>
                                <p>Recently posted</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row text-center filters py-2">
          <div class="filter-item col-md-2">
            <p>Based on profile</p>
          </div>
          <div class="filter-item col-md-2">
            <p>Same day shifts</p>
          </div>
          <div class="filter-item col-md-2">
            <p>Within 48h</p>
          </div>
          <div class="filter-item col-md-2">
            <p>Within 7 days</p>
          </div>
          <div class="filter-item col-md-2">
            <p>Recently posted</p>
          </div>
        </div> --}}
            </div>
        </section>
        <!-- WHY SECTION -->
        <section class="res-space bg-white">
            <div class="container ">
                <h2 class="text-center">Smarter Matching. Better Jobs. Faster Hiring. </h2>
                <div class="row d-flex mt-15">
                    <div class="col-md-4 mb-3">
                        <div class="feature-card">
                            <div class="text-center">
                                <svg width="90" height="90" viewBox="0 0 120 120">

                                    <path d="M60 10 L100 28 V60 C100 85 78 104 60 110 C42 104 20 85 20 60 V28 Z"
                                        fill="#9fd6d3" stroke="#6fb8b5" stroke-width="4" />

                                    <path d="M60 25 L85 36 V58 C85 72 72 85 60 90 C48 85 35 72 35 58 V36 Z"
                                        fill="#2b7c84" />

                                    <circle cx="80" cy="70" r="10" fill="#ffffff" />
                                    <rect x="78" y="64" width="4" height="12" fill="#2b7c84" />
                                    <rect x="74" y="68" width="12" height="4" fill="#2b7c84" />
                                </svg>
                            </div>

                            <h4 class="res-h4">Your Role, Growth & Environment </h4>

                            <div class="nurse-card">
                                <ul>
                                    <li class="d-flex gap-2 justify-content-between">Type of Nurse
                                        <span>
                                            <a href="javascript:void(0)" class="browse_menu flyout icon_modalRight"
                                                data-open="typeOfNurseModal">

                                                <i class="fa fa-play" aria-hidden="true"></i>
                                            </a>
                                        </span>

                                    </li>
                                    <li class="d-flex gap-2 justify-content-between">Primary Specialty

                                        <a href="javascript:void(0)" class="browse_menu flyout icon_modalRight"
                                            data-open="primarySpecialty">

                                            <i class="fa fa-play" aria-hidden="true"></i>
                                        </a>

                                    </li>
                                    <li class="d-flex gap-2 justify-content-between">Willing to Upskill
                                        <a href="javascript:void(0)" class="browse_menu flyout icon_modalRight"
                                            data-open="willingtoUpskill">

                                            <i class="fa fa-play" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    {{-- <a href="#" data-toggle="modal" data-target="#filterModal">
                                            see more
                                        </a> --}}

                                </ul>
                            </div>
                            <!-- <hr class="hr-bg">
                            <div class="nurse-card">
                                <h5>
                                    <i class="fa fa-level-up" aria-hidden="true"></i> Willing to Upskill
                                </h5>
                                <ul>
                                    <li>Location </li>
                                    <li>Primary Specialty</li>
                                </ul>
                            </div> -->

                            <hr class="hr-bg">

                            <div class="nurse-card">
                                <!-- <div class="section-header" onclick="toggle(this)">
                                    <h5>
                                        <i class="fa fa-graduation-cap" aria-hidden="true"></i> Graduate Friendly
                                    </h5>
                                    <i class="fa fa-play" aria-hidden="true"></i>
                                </div>
                                <ul class="section-content">
                                    <li>Residencies</li>
                                    <li>Fellowships</li>
                                    <li>Sponsorship</li>
                                </ul> -->
                                <div class="section-card">
                                    <div class="section-header" onclick="toggle(this)">
                                        <div class="section-title card-main-icons">
                                            <i class="fas fa-globe"></i> International Opportunities
                                        </div>
                                        <i class="fa fa-play chevron"></i>
                                    </div>
                                    <div class="section-content">
                                        <p>Countries of interest</p>
                                        <p>Sponsorship</p>
                                        <p>Bridging program</p>
                                        <p>Supervised practice</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-bg">
                            <div class="nurse-card">
                                <!-- <h5>
                                    <i class="fa fa-users" aria-hidden="true"></i> Work Environment
                                </h5>
                                <ul>
                                    <li>Location Preferences
                                        <span>
                                            <a href="javascript:void(0)" class="browse_menu flyout icon_modalRight"
                                                data-open="workEnvironment">
                                                <i class="fa fa-play" aria-hidden="true"></i>
                                            </a>
                                        </span>

                                    </li>
                                 
                                </ul> -->
                                <div class="section-card">
                                    <div class="section-header" onclick="toggle(this)">
                                        <div class="section-title card-main-icons">
                                            <i class="fa fa-graduation-cap" aria-hidden="true"></i> Career Growth
                                        </div>
                                        <i class="fa fa-play chevron"></i>
                                    </div>
                                    <div class="section-content">
                                        <p>Graduate Positions </p>
                                        <p>Student Positions </p>
                                        <p>Residencies </p>
                                        <p>Fellowships </p>
                                        <p>Paid CPD </p>
                                        <p>Willing to Upskill </p>
                                    </div>
                                </div>
                            </div>

                            {{-- <ul>
																																									<li>Type of Nurse</li>
																																									<li>Primary Specialty</li>
																																									<li>Graduate Friendly</li>
																																									<li>Work Environment</li>
																																	</ul> --}}
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="feature-card">
                            <div class="text-center">
                                <svg width="90" height="90" viewBox="0 0 120 120">
                                    <path
                                        d="M60 22
                                                                                                                                    C60 18 55 14 50 18
                                                                                                                                    C45 22 48 30 60 38
                                                                                                                                    C72 30 75 22 70 18
                                                                                                                                    C65 14 60 18 60 22Z"
                                        fill="#ff6b6b" />

                                    <rect x="25" y="45" width="70" height="45" rx="6" fill="#4a5f73" />

                                    <rect x="45" y="35" width="30" height="12" rx="4" fill="#4a5f73" />

                                    <rect x="56" y="65" width="8" height="8" fill="#f6c64f" />
                                </svg>
                            </div>
                            <div class="nurse-card">
                                <h4>Work That Fits Your Life</h4>
                                <!-- <div class="d-flex gap-3 flex-wrap"> -->
                                <div class="nurse-card">
                                    <!-- <h5>
                                            <i class="fa fa-plus-square" aria-hidden="true"></i>Sector
                                        </h5>
                                        <ul>
                                            <li>Public</li>
                                            <li>Government</li>
                                            <li>Private</li>
                                        </ul> -->
                                    <div class="section-card">
                                        <div class="section-header" onclick="toggle(this)">
                                            <div class="section-title card-main-icons">
                                                <i class="fa fa-graduation-cap" aria-hidden="true"></i> Career
                                                Growth
                                            </div>
                                            <i class="fa fa-play chevron"></i>
                                        </div>
                                        <div class="section-content">
                                            <p>Public / Government </p>
                                            <p>Private</p>
                                        </div>
                                    </div>
                                </div>
                                <hr class="hr-bg">
                                <div class="nurse-card">
                                    <!-- <h5>
                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> Employment Type
                                        </h5>
                                        <ul>
                                            <li>Permanent </li>
                                            <li>Fixed-term </li>
                                            <li>Temporary </li>
                                        </ul> -->
                                    <div class="section-card">
                                        <div class="section-header" onclick="toggle(this)">
                                            <div class="section-title card-main-icons">
                                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Employment Type
                                            </div>
                                            <i class="fa fa-play chevron"></i>
                                        </div>
                                        <div class="section-content">
                                            <p>Permanent </p>
                                            <p>Fixed-term </p>
                                            <p>Temporary </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- </div> -->

                                <hr class="hr-bg">
                                <div class="nurse-card">
                                    <!-- <h5>
                                        <i class="fa fa-bars" aria-hidden="true"></i>Shift Structure
                                    </h5>
                                    <ul class="shift-list">
                                        <li>Shift Types</li>
                                        <li>Shift Length</li>

                                        <li class="extra-shift">Schedule Model</li>
                                        <li class="extra-shift">Weekly Work Patterns</li>
                                        <li class="extra-shift">Shift Rotation & Cycle</li>
                                        <li class="extra-shift">Non-Traditional Shift </li>
                                        <li class="extra-shift">Maternity & Midwifery Shift</li>
                                        <li class="extra-shift">Days Off</li>
                                        <li class="extra-shift">Specific Days Off</li>
                                    </ul> -->
                                    <div class="section-card">
                                        <div class="section-header" onclick="toggle(this)">
                                            <div class="section-title card-main-icons">
                                                <i class="fa fa-bars" aria-hidden="true"></i> Shift Structure
                                            </div>
                                            <i class="fa fa-play chevron"></i>
                                        </div>
                                        <div class="section-content">
                                            <p>Shift Types </p>
                                            <p>Shift Length </p>
                                            <p>Schedule Model </p>
                                            <p>Weekly Work Patterns </p>
                                            <p>Shift Rotation & Cycle</p>
                                            <p>Non-Traditional Shift</p>
                                            <p>Maternity & Midwifery Shift </p>
                                            <p>Days Off </p>
                                            <p>Specific Days Off</p>
                                        </div>
                                    </div>
                                    <!-- <div class="more-btn">
                                        <a href="javascript:void(0)" class="show-more-btn">+ See more</a>
                                    </div> -->
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="feature-card">
                            <div class="text-center">
                                <svg width="90" height="90" viewBox="0 0 120 120">

                                    <rect x="35" y="30" width="55" height="70" rx="8" fill="#eef1f5" stroke="#b8c0cc"
                                        stroke-width="3" />

                                    <rect x="50" y="20" width="25" height="15" rx="4" fill="#5a6573" />

                                    <line x1="45" y1="55" x2="80" y2="55" stroke="#8a94a3" stroke-width="3" />
                                    <line x1="45" y1="68" x2="80" y2="68" stroke="#8a94a3" stroke-width="3" />
                                    <line x1="45" y1="81" x2="70" y2="81" stroke="#8a94a3" stroke-width="3" />

                                    <circle cx="40" cy="60" r="15" fill="#f6c64f" />
                                    <text x="40" y="65" text-anchor="middle" font-size="16" fill="#2c3e50">$</text>
                                </svg>
                            </div>
                            <div class="nurse-card">
                                <h4>Extra Tags</h4>
                                <!-- <div class="d-flex gap-3 flex-wrap"> -->
                                <div class="nurse-card">
                                    <!-- <h5>
                                            <i class="fa fa-suitcase" aria-hidden="true"></i>Financial
                                        </h5>
                                        <ul class="shift-list">
                                            <li>Overtime</li>
                                            <li>Shift Loading </li>
                                            <li class="extra-shift">Bonuses</li>
                                            <li class="extra-shift">Sign-On Bonus</li>
                                        </ul>
                                        <div class="more-btn">
                                            <a href="javascript:void(0)" class="show-more-btn">+ See more</a>
                                        </div> -->
                                    <div class="section-card">
                                        <div class="section-header" onclick="toggle(this)">
                                            <div class="section-title card-main-icons">
                                                <i class="fa fa-suitcase" aria-hidden="true"></i>Financial
                                            </div>
                                            <i class="fa fa-play chevron"></i>
                                        </div>
                                        <div class="section-content">
                                            <p>Overtime</p>
                                            <p>Shift Loading </p>
                                            <p>Bonuses</p>
                                            <p>Sign-On Bonus </p>
                                            <p>Leave Benefits </p>
                                        </div>
                                    </div>
                                </div>
                                <hr class="hr-bg">
                                <div class="nurse-card">
                                    <!-- <h5>
                                            <i class="fa fa-file" aria-hidden="true"></i> Work-Life:
                                        </h5>
                                        <ul class="shift-list">
                                            <li>Flexible Rosters </li>
                                            <li>Self-Scheduling</li>
                                            <li class="extra-shift">Paid Time Off</li>
                                            <li class="extra-shift">Work-from-Home</li>
                                            <li class="extra-shift">Childcare</li>
                                        </ul>
                                        <div class="more-btn">
                                            <a href="javascript:void(0)" class="show-more-btn">+ See more</a>
                                        </div> -->
                                    <div class="section-card">
                                        <div class="section-header" onclick="toggle(this)">
                                            <div class="section-title card-main-icons">
                                                <i class="fa fa-file" aria-hidden="true"></i> Work-Life:
                                            </div>
                                            <i class="fa fa-play chevron"></i>
                                        </div>
                                        <div class="section-content">
                                            <p>Flexible Rosters </p>
                                            <p>Self-Scheduling</p>
                                            <p>Paid Time Off</p>
                                            <p>Work-from-Home</p>
                                            <p>Childcare</p>
                                        </div>
                                    </div>

                                </div>
                                <!-- </div> -->
                                <hr class="hr-bg">
                                <!-- <div class="d-flex gap-3 flex-wrap"> -->
                                <!-- <div class="nurse-card">
                                    <h5>
                                        <i class="fa fa-sun-o" aria-hidden="true"></i> Career Growth
                                    </h5>
                                    <ul class="shift-list">
                                        <li>Paid CPD </li>
                                        <li>Residencies </li>
                                        <li class="extra-shift">Fellowships </li>
                                        <li class="extra-shift">Graduate </li>
                                        <li class="extra-shift">Friendly</li>
                                        <li class="extra-shift">Student Friendly </li>
                                    </ul>
                                    <div class="more-btn">
                                        <a href="javascript:void(0)" class="show-more-btn">+ See more</a>
                                    </div>
                                </div> -->
                                <div class="nurse-card">
                                    <!-- <h5>
                                        <i class="fa fa-globe" aria-hidden="true"></i> Travel & Support
                                    </h5>
                                    <ul class="shift-list">
                                        <li>Relocation </li>
                                        <li>Housing</li>
                                        <li class="extra-shift">Travel Allowance</li>
                                        <li class="extra-shift">Sponsorship</li>
                                        <li class="extra-shift">Paid Flights </li>
                                        <li class="extra-shift">Car allowance</li>
                                        <li class="extra-shift">Fuel allowance </li>
                                    </ul>
                                    <div class="more-btn">
                                        <a href="javascript:void(0)" class="show-more-btn">+ See more</a>
                                    </div> -->
                                    <div class="section-card">
                                        <div class="section-header" onclick="toggle(this)">
                                            <div class="section-title card-main-icons">
                                                <i class="fa fa-globe" aria-hidden="true"></i> Travel & Support
                                            </div>
                                            <i class="fa fa-play chevron"></i>
                                        </div>
                                        <div class="section-content">
                                            <p>Relocation</p>
                                            <p>Housing</p>
                                            <p>Travel Allowance </p>
                                            <p>Sponsorship</p>
                                            <p>Paid Flights </p>
                                            <p>Car allowance </p>
                                            <p>Fuel allowance </p>
                                        </div>
                                    </div>

                                </div>
                                <!-- </div> -->
                                <hr class="hr-bg">
                                <!-- <div class="d-flex gap-3 flex-wrap"> -->
                                <div class="nurse-card">
                                    <!-- <h5>
                                            <i class="fa fa-lock" aria-hidden="true"></i> Protection
                                        </h5>
                                        <ul>
                                            <li>PII</li>
                                            <li>EAP</li>
                                            <li>PPE Provided</li>
                                        </ul> -->
                                    <div class="section-card">
                                        <div class="section-header" onclick="toggle(this)">
                                            <div class="section-title card-main-icons">
                                                <i class="fa fa-lock" aria-hidden="true"></i> Protection
                                            </div>
                                            <i class="fa fa-play chevron"></i>
                                        </div>
                                        <div class="section-content">
                                            <p>PII </p>
                                            <p>EAP</p>
                                            <p>PPE Provided </p>
                                        </div>
                                    </div>

                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href='#' class="btn btn-default btn-shadow hover-up mt-15">Create Your Free Profile</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="res-space">
            <div class="container">
                <h2 class="text-center">How Mediqa Matching Works </h2>
                <div class="row mt-4 d-flex align-items-stretch">
                    <!-- Step 1 -->
                    <div class="col-md-6 col-sm-12 mb-4 d-flex">
                        <div class="bg-white score-cards h-100">
                            <div class="d-flex mb-3">
                                <div class="ml-3">
                                    <h5 class="build">Build Your Profile - 100% Free</h5>
                                    <!-- <div class="mt-2">
                                        <p>Your qualifications and preferences become your matching blueprint</p>
                                        <p>Data securely stored and ready: </p>
                                    </div> -->
                                </div>
                            </div>
                            <div class="card-box">
                                <div class="list-item">
                                    {{-- </span> --}}
                                    {{-- <label class="form-label"> --}}
                                    Specialty Status
                                    <span class="tooltip-container feature-card matching-hover">
                                        <span class="info tooltip-btn tooltip-circle">
                                            <i class="fa fa-info info-icon" aria-hidden="true"></i>
                                        </span>
                                        <div class="tooltip_speciality_status ">
                                            <ul>
                                                <!-- <li><strong>For every specialty you choose, tell us how it fits into
                                                        your career today: </strong></li> -->
                                                <li><strong>Principal :</strong> Your main area of practice </li>
                                                <li><strong>Current :</strong> Actively practising in this specialty
                                                </li>
                                                <li><strong>First:</strong> Your original or foundational specialty
                                                </li>
                                                <li><strong>Former :</strong> Previously practised but not current
                                                </li>
                                                <li><strong>Upskilling / Transitioning:</strong> Moving into this
                                                    specialty </li>
                                            </ul>
                                        </div>
                                    </span>
                                    {{-- </label> --}}


                                </div>
                                <div class="list-item">
                                    {{-- <label class="form-label"> --}}
                                    Registration & Licences
                                    <span class="tooltip-container feature-card matching-hover">
                                        <span class="info tooltip-btn tooltip-circle">
                                            <i class="fa fa-info info-icon" aria-hidden="true"></i>
                                        </span>
                                        <div class="tooltip_speciality_status">
                                            <ul>

                                                <li><strong>AHPRA:</strong>Verified registration, endorsements,
                                                    conditions, expiry </li>
                                                <li><strong>NDIS :</strong> registered provider status required
                                                </li>
                                                <li>Bills under Medicare / MBS (NP/Midwife)
                                                </li>
                                                <li>PBS Prescriber
                                                </li>
                                                <li>Immunisation Provider</li>
                                                <li>Uses radiation equipment </li>
                                            </ul>
                                        </div>
                                    </span>
                                    {{-- </label> --}}
                                </div>
                                <div class="list-item">
                                    Checks & Clearances
                                    <span class="tooltip-container feature-card matching-hover">
                                        <span class="info tooltip-btn tooltip-circle">
                                            <i class="fa fa-info info-icon" aria-hidden="true"></i>
                                        </span>
                                        <div class="tooltip_speciality_status">
                                            <ul>

                                                <li>Residency </li>
                                                <li>NDIS Worker Screening Check
                                                </li>
                                                <li>Working With Children Check (WWCC)
                                                </li>
                                                <li>Police Clearance required
                                                </li>
                                                <li>Specialized Clearances </li>
                                            </ul>
                                        </div>
                                    </span>
                                </div>
                                <div class="list-item">
                                    General Certifications
                                    <span class="tooltip-container feature-card matching-hover">
                                        <span class="info tooltip-btn tooltip-circle">
                                            <i class="fa fa-info info-icon" aria-hidden="true"></i>
                                        </span>
                                        <div class="tooltip_speciality_status">
                                            <ul>
                                                <li>Life Support </li>
                                                <li>Medication & Clinical Skills
                                                </li>
                                                <li>Wound & Clinical Care
                                                </li>
                                                <li>Aged Care / Communi</li>
                                                <li>Clinical Skills and Core Competencies</li>
                                                <li>Midwifery-Specific Training</li>
                                                <li>Leadership and Professional Development</li>
                                                <li>Technology and Innovation in Healthcare</li>
                                                <li>Wellness and Self-Care</li>
                                                <li>NDIS Mandatory Training</li>
                                            </ul>
                                        </div>
                                    </span>
                                </div>
                                <div class="list-item">
                                    Mandatory Training
                                    <span class="tooltip-container feature-card matching-hover">
                                        <span class="info tooltip-btn tooltip-circle">
                                            <i class="fa fa-info info-icon" aria-hidden="true"></i>
                                        </span>
                                        <div class="tooltip_speciality_status">
                                            <ul>
                                                <li>Clinical Skills
                                                </li>
                                                <li>Midwifery </li>
                                                <li>Leadership </li>
                                                <li>Technology </li>
                                                <li>Wellness </li>
                                                <li>NDIS </li>
                                            </ul>
                                        </div>
                                    </span>
                                </div>
                                <div class="list-item">
                                    Vaccination
                                    <span class="tooltip-container feature-card matching-hover">
                                        <span class="info tooltip-btn tooltip-circle">
                                            <i class="fa fa-info info-icon" aria-hidden="true"></i>
                                        </span>
                                        <div class="tooltip_speciality_status">
                                            <ul>
                                                <li>State-specific
                                                    <!-- Each state has a predefined vaccination profile. -->
                                                </li>
                                                <li>System-defined</li>
                                            </ul>
                                        </div>
                                    </span>
                                </div>
                                <div class="list-item">
                                    Shift & Lifestyle Preferences
                                    <span class="tooltip-container feature-card matching-hover">
                                        <span class="info tooltip-btn tooltip-circle">
                                            <i class="fa fa-info info-icon" aria-hidden="true"></i>
                                        </span>
                                        <div class="tooltip_speciality_status">
                                            <ul>
                                                <li>Shift Types </li>
                                                <li>Shift Length</li>
                                                <li>Schedule Model </li>
                                                <li>Weekly Patterns</li>
                                                <li>Shift Rotation & Cycle </li>
                                                <li>Specialty & Non-Traditional Shift </li>
                                                <li>Maternity & Midwifery Shift </li>
                                                <li>Days Off </li>
                                            </ul>
                                        </div>
                                    </span>
                                </div>
                                <div class="list-item">
                                    Location Radius
                                    <span class="tooltip-container feature-card matching-hover">
                                        <span class="info tooltip-btn tooltip-circle">
                                            <i class="fa fa-info info-icon" aria-hidden="true"></i>
                                        </span>
                                        <div class="tooltip_speciality_status">
                                            <ul>
                                                <li>Suburb </li>
                                                <li>State </li>
                                                <li>International </li>
                                            </ul>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Step 2 -->
                    <div class="col-md-6 col-sm-12 mb-4 d-flex">
                        <div class="h-100 d-flex flex-column w-100">
                            <div class="bg-white score-cards flex-fill ">
                                <div class="d-flex mb-3">
                                    <div class="ml-3">
                                        <h5>Intelligent Match Scoring</h5>
                                    </div>
                                </div>
                                <div class="card-box">
                                    <div class="list-item">
                                        {{-- </span> --}}
                                        {{-- <label class="form-label"> --}}
                                        Every job is scored against your real profile, not keywords.
                                        We don’t rely on CV text. We measure alignment across 7 key factors
                                        Each factor is weighted.
                                        Each job is evaluated in real time.

                                        <!-- We don’t guess based on CV text -->
                                        <span class="tooltip-container feature-card matching-hover">
                                            <span class="info tooltip-btn tooltip-circle">
                                                <i class="fa fa-info info-icon" aria-hidden="true"></i>
                                            </span>
                                            <div class="tooltip_speciality_status">
                                                <ul>
                                                    <li><Strong>We measure structured alignment across: </Strong></li>
                                                    <li>Specialty & specialty status</li>
                                                    <li>Years of experience in each area </li>
                                                    <li>AHPRA registration & endorsements
                                                    </li>
                                                    <li>Compliance readiness (vaccines, checks, training)
                                                    </li>
                                                    <li>Shift compatibility
                                                    </li>
                                                    <li>Location radius </li>
                                                    <li>Benefits alignment </li>
                                                    <li>Each factor is weighted.
                                                        Each job is evaluated in real time.
                                                        When you see a high match, you know why. </li>
                                                </ul>
                                            </div>
                                        </span>
                                        {{-- </label> --}}
                                    </div>
                                    <div class="list-item">
                                        {{-- </span> --}}
                                        {{-- <label class="form-label"> --}}
                                        When you see a high match, you know why.
                                        <span class="tooltip-container feature-card matching-hover">
                                            <span class="info tooltip-btn tooltip-circle">
                                                <i class="fa fa-info info-icon" aria-hidden="true"></i>
                                            </span>
                                            <div class="tooltip_speciality_status">
                                                <ul>
                                                    <li>Specialty & role fit
                                                    </li>
                                                    <li>Experience by specialty </li>
                                                    <li>Registration & endorsements</li>
                                                    <li>Compliance readiness (vaccines, checks, training) </li>
                                                    <li>Shift compatibility </li>
                                                    <li>Location & travel radius </li>
                                                    <li>Benefits alignment </li>
                                                </ul>
                                            </div>
                                        </span>
                                        {{-- </label> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white score-cards mt-4 flex-fill">
                                <div class="d-flex mb-3">
                                    <div class="ml-3">
                                        <h5>Apply with confidence </h5>
                                    </div>
                                </div>
                                <div class="card-box">
                                    <div class="list-item">
                                        {{-- </span> --}}
                                        {{-- <label class="form-label"> --}}
                                        Move Faster, High-match candidates stand out immediately
                                        <span class="tooltip-container feature-card matching-hover">
                                            <span class="info tooltip-btn tooltip-circle">
                                                <i class="fa fa-info info-icon" aria-hidden="true"></i>
                                            </span>
                                            <div class="tooltip_speciality_status">
                                                <ul>
                                                    <!-- <li><Strong>Medical facilities and Agencies can see your: </Strong>
                                                    </li> -->
                                                    <li>Verified registration </li>
                                                    <li>Compliance readiness </li>
                                                    <li>Specialty alignment </li>
                                                    <li>Shift compatibility </li>
                                                    <!-- <li>That means fewer delays, and faster decisions. </li> -->
                                                </ul>
                                            </div>
                                        </span>
                                        {{-- </label> --}}
                                    </div>
                                    <!-- <p>Receive Instant Opportunities </p> -->
                                    <div class="ml-3 mb-3">
                                        <h5>Receive Instant Opportunities</h5>
                                    </div>

                                    <div class="list-item">
                                        {{-- </span> --}}
                                        {{-- <label class="form-label"> --}}
                                        When timing matters, MediQa makes it visible.
                                        <span class="tooltip-container feature-card matching-hover">
                                            <span class="info tooltip-btn tooltip-circle">
                                                <i class="fa fa-info info-icon" aria-hidden="true"></i>
                                            </span>
                                            <div class="tooltip_speciality_status">
                                                <ul>
                                                    <li>Instant Connect → Same-day shifts</Strong></li>
                                                    <li>Last Minute → Starts within 48h </li>
                                                    <li>Immediate Start → Within 7 days </li>
                                                    <li>Urgent Hire → Employer priority </li>
                                                </ul>
                                            </div>
                                        </span>
                                        {{-- </label> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- <section class="bg-white overflow-visible py-5">
            <div class="container">
                <h2 class="text-center"> Create Your Professional Profile </h2>
                <div class="row align-items-center pt-scroll">
                    <div class="col-lg-6 col-sm-12">
                        <div class="box-image-job">
                            <figure class="wow animate__ animate__fadeIn animated"
                                style="visibility: visible; animation-name: fadeIn;">
                                <img alt="jobBox" src="{{ asset('nurse/assets/imgs/scroll6.jpg') }}">
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="content-job-inner">
                            <h2 class="text-30 wow animate__ animate__fadeInUp animated"
                                style="visibility: visible; animation-name: fadeInUp;"> Stop scrolling </h2>
                            <h2 class="text-30 wow animate__ animate__fadeInUp animated"
                                style="visibility: visible; animation-name: fadeInUp;"> Start matching </h2>
                            <div class="mt-20 pr-50 text-md-lh28 wow animate__ animate__fadeInUp animated"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <div class="stop d-flex align-items-center flex-wrap">
                                    {{-- <h4 class="create-space">Create Your </h4> --}}
                                    {{-- <a href="#"> Professional Profile </a> --}}
                                    <span> <a class="btn btn-default btn-shadow hover-up">Create Your Professional
                                            Profile</a></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- LATEST JOBS -->
        <section class="bg-white jobs res-space">
            <div class="container">
                <h2 class="text-center">Latest Jobs</h2>
                <div class="row mt-15">
                    <!-- JOB CARD -->

                    <div class="col-lg-4 col-md-6 d-flex mb-3">
                        <div class="job-card w-100 ">
                            <!-- Header -->
                            <div class="d-flex justify-content-between gap-2">
                                {{-- <div class="job-title mb-0">Advanced Midwife – Community Health</div> --}}
                                <div class="job-title mb-0">{{$jobs['permanent']->job_title}}</div>
                                <span class="badge badge-new">Permanent</span>
                            </div>
                            <!-- Location & Type -->
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="d-flex gap-4">
                                    <span class="job-meta mr-3">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $jobs['permanent']->state_name }},{{ $jobs['permanent']->country_name }}
                                    </span>
                                    <span class="job-meta">
                                        <i class="far fa-circle"></i> {{ $jobs['permanent']->employment_type }}
                                    </span>
                                </div>

                            </div>
                            <div class="nurse-salary mt-2">
                                @php
                                if ($jobs['permanent']->main_emp_type == 1) {
                                $min = $jobs['permanent']->per_salary_min;
                                $max = $jobs['permanent']->per_salary_max;
                                $per = $jobs['permanent']->salary_permanent;
                                } elseif ($jobs['permanent']->main_emp_type == 2) {
                                $min = $jobs['permanent']->fixed_term_salary_min;
                                $max = $jobs['permanent']->fixed_term_salary_max;
                                $per = $jobs['permanent']->salary_range_fix_term;
                                } elseif ($jobs['permanent']->main_emp_type == 3) {
                                $min = $jobs['permanent']->temporary_salary_min;
                                $max = $jobs['permanent']->temporary_salary_max;
                                $per = $jobs['permanent']->salary_range_temporary;
                                }
                                @endphp
                                @if (!empty($min))
                                <span class="salary">$</span>
                                <span>{{ $min }} - {{ $max }} {{ $per }}</span>
                                @endif
                            </div>

                            <!-- Shift Dates -->
                            @php
                            $startDate = Carbon::parse($jobs['permanent']->created_at);
                            switch ($jobs['permanent']->expiry_date) {
                            case 1:
                            $endDate = $startDate->copy()->addDays(7);
                            break;
                            case 2:
                            $endDate = $startDate->copy()->addDays(14);
                            break;
                            case 3:
                            $endDate = $startDate->copy()->addDays(30);
                            break;
                            case 4:
                            $endDate = $startDate->copy()->addDays(60);
                            break;
                            case 5:
                            $endDate = Carbon::parse($jobs['permanent']->custom_expiry_date);
                            break;
                            default:
                            $endDate = null;
                            }
                            $start = $startDate->format('d M Y');
                            $end = $endDate ? $endDate->format('d M Y') : '';
                            $date_range = $start . ' – ' . $end;
                            @endphp
                            <!-- Shift Dates -->
                            <div class="job-meta mt-1">
                                {{ $date_range }}
                            </div>
                            <!-- Bullet Details -->

                            <!-- Footer -->
                            <div class="job-footer">
                                <a href="{{route('nurse.login')}}"> <button class="btn nurse-apply-btn text-white">
                                        Complete Credentials to Apply
                                    </button></a>
                                <div>
                                    <a href="#" class="d-flex gap-2">
                                        <span><i class="fa fa-bookmark-o" aria-hidden="true"></i></span>
                                        Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex mb-3">
                        <div class="job-card w-100">

                            <div class="d-flex justify-content-between gap-2">
                                <div class="job-title mb-0">{{$jobs['fixed']->job_title}}</div>
                                <span class="badge badge-fixed-term">Fixed Term</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="d-flex gap-4">
                                    <span class="job-meta mr-3">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $jobs['fixed']->state_name }},{{ $jobs['fixed']->country_name }}
                                    </span>

                                    <span class="job-meta">
                                        <i class="far fa-circle"></i> {{ $jobs['fixed']->employment_type }}
                                    </span>
                                </div>
                            </div>

                            <div class="nurse-salary mt-2">

                                @php
                                $min = $jobs['fixed']->fixed_term_salary_min;
                                $max = $jobs['fixed']->fixed_term_salary_max;
                                $per = $jobs['fixed']->salary_range_fix_term;
                                @endphp

                                @if(!empty($min))
                                <span class="salary">$</span>
                                <span>{{ $min }} - {{ $max }} {{ $per }}</span>
                                @endif

                            </div>

                            @php
                            $startDate = Carbon::parse($jobs['fixed']->created_at);

                            switch ($jobs['fixed']->expiry_date) {
                            case 1: $endDate = $startDate->copy()->addDays(7); break;
                            case 2: $endDate = $startDate->copy()->addDays(14); break;
                            case 3: $endDate = $startDate->copy()->addDays(30); break;
                            case 4: $endDate = $startDate->copy()->addDays(60); break;
                            case 5: $endDate = Carbon::parse($jobs['fixed']->custom_expiry_date); break;
                            default: $endDate = null;
                            }

                            $start = $startDate->format('d M Y');
                            $end = $endDate ? $endDate->format('d M Y') : '';
                            @endphp

                            <div class="job-meta mt-1">
                                {{ $start }} – {{ $end }}
                            </div>

                            <div class="job-footer">
                                <a href="{{route('nurse.login')}}">
                                    <button class="btn nurse-apply-btn text-white">
                                        Complete Credentials to Apply
                                    </button>
                                </a>

                                <div>
                                    <a href="#" class="d-flex gap-2">
                                        <span><i class="fa fa-bookmark-o"></i></span>
                                        Details
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex mb-3">
                        <div class="job-card w-100">

                            <div class="d-flex justify-content-between gap-2">
                                <div class="job-title mb-0">{{$jobs['temporary']->job_title}}</div>
                                <span class="badge badge-temporary">Temporary</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="d-flex gap-4">

                                    <span class="job-meta mr-3">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $jobs['temporary']->state_name }},{{ $jobs['temporary']->country_name }}
                                    </span>

                                    <span class="job-meta">
                                        <i class="far fa-circle"></i> {{ $jobs['temporary']->employment_type }}
                                    </span>

                                </div>
                            </div>

                            <div class="nurse-salary mt-2">

                                @php
                                $min = $jobs['temporary']->temporary_salary_min;
                                $max = $jobs['temporary']->temporary_salary_max;
                                $per = $jobs['temporary']->salary_range_temporary;
                                @endphp

                                @if(!empty($min))
                                <span class="salary">$</span>
                                <span>{{ $min }} - {{ $max }} {{ $per }}</span>
                                @endif

                            </div>

                            @php
                            $startDate = Carbon::parse($jobs['temporary']->created_at);

                            switch ($jobs['temporary']->expiry_date) {
                            case 1: $endDate = $startDate->copy()->addDays(7); break;
                            case 2: $endDate = $startDate->copy()->addDays(14); break;
                            case 3: $endDate = $startDate->copy()->addDays(30); break;
                            case 4: $endDate = $startDate->copy()->addDays(60); break;
                            case 5: $endDate = Carbon::parse($jobs['temporary']->custom_expiry_date); break;
                            default: $endDate = null;
                            }

                            $start = $startDate->format('d M Y');
                            $end = $endDate ? $endDate->format('d M Y') : '';
                            @endphp

                            <div class="job-meta mt-1">
                                {{ $start }} – {{ $end }}
                            </div>

                            <div class="job-footer">
                                <a href="{{route('nurse.login')}}">
                                    <button class="btn nurse-apply-btn text-white">
                                        Complete Credentials to Apply
                                    </button>
                                </a>

                                <div>
                                    <a href="#" class="d-flex gap-2">
                                        <span><i class="fa fa-bookmark-o"></i></span>
                                        Details
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-box overflow-visible sec-essential">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="box-image-job">
                            {{-- <!-- <img class="img-job-1" alt="jobBox" src="{{ asset('nurse/assets/imgs/page/homepage1/img-chart.png') }}">
                            --> --}}
                            <!-- src="{{ asset('nurse/assets/imgs/page/homepage1/img-chart.png') }} -->
                            <!-- src="{{ asset('nurse/assets/imgs/page/homepage1/shift-shield1.png') }} -->
                            <img class="img-job-2" alt="jobBox"
                                src="{{ asset('nurse/assets/imgs/page/homepage1/shift-shield1.png') }}">
                            <figure class="wow animate__ animate__fadeIn animated"
                                style="visibility: visible; animation-name: fadeIn;">
                                <img alt="jobBox" src="{{ asset('nurse/assets/imgs/img1.png') }}">
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="content-job-inner">
                            <h2 class="text-30 wow animate__ animate__fadeInUp animated"
                                style="visibility: visible; animation-name: fadeInUp;">You’re Essential. Your Career
                                Should Fit You.</h2>
                            <div class="mt-20 pr-50 text-md-lh28 wow animate__ animate__fadeInUp animated"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <div class="credential">
                                    <p><i class="fa fa-check-circle" aria-hidden="true"></i> Your skills and experience
                                        matter
                                    </p>
                                    <p><i class="fa fa-check-circle" aria-hidden="true"></i> Your flexibility matters
                                    </p>
                                    <p><i class="fa fa-check-circle" aria-hidden="true"></i> Your preferences matter
                                    </p>
                                    <h4>Mediqa connects you with the right opportunities.</h4>
                                </div>


                            </div>
                            <div class="mt-20">
                                <div class="wow animate__ animate__fadeInUp animated"
                                    style="visibility: visible; animation-name: fadeInUp;">
                                    <a class="btn btn-default" href='{{ route('nurse.login') }}'>Create Your Free
                                        Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>


    {{-- <div class="modal fade" id="filterModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Filters</h5>
                        <button class="modal-close-btn" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        Your content here
                    </div>
                </div>
            </div>
        </div> --}}
    <div id="typeOfNurseModal" class="side-modal">
        <div class="side-modal-content">

            <div class="modal-header">
                <h3>Type of Nurse</h3>
                <span class="close-btn" data-close="typeOfNurseModal">&times;</span>
            </div>

        </div>
    </div>
    <div id="primarySpecialty" class="side-modal">
        <div class="side-modal-content">

            <div class="modal-header">
                <h3>Primary Specialty</h3>
                <span class="close-btn" data-close="primarySpecialty">&times;</span>
            </div>

        </div>
    </div>

    {{-- modal 2 Work environment  --}}
    <div id="workEnvironment" class="side-modal">
        <div class="side-modal-content">

            <div class="modal-header">
                <h3>Work Environment</h3>
                <span class="close-btn" data-close="workEnvironment">&times;</span>
            </div>

        </div>
    </div>

    {{-- modal 3 Work environment  --}}
    <div id="willingtoUpskill" class="side-modal">
        <div class="side-modal-content">

            <div class="modal-header">
                <h3>Willing to Upskill</h3>
                <span class="close-btn" data-close="willingtoUpskill">&times;</span>
            </div>

        </div>
    </div>

    <script src="{{ asset('nurse/assets/js/plugins/counterup.js') }}"></script>
</main>
@endsection @section('js')
<script>
document.addEventListener("DOMContentLoaded", function() {

    /* OPEN MODAL */
    document.querySelectorAll("[data-open]").forEach(btn => {

        btn.addEventListener("click", function(e) {
            e.preventDefault();

            const modalId = this.getAttribute("data-open");
            const modal = document.getElementById(modalId);

            if (modal) {
                modal.style.display = "block";
            }

        });

    });


    /* CLOSE MODAL */
    document.querySelectorAll("[data-close]").forEach(btn => {

        btn.addEventListener("click", function() {

            const modalId = this.getAttribute("data-close");
            const modal = document.getElementById(modalId);

            if (modal) {
                modal.style.display = "none";
            }

        });

    });


    /* CLICK OUTSIDE CLOSE */
    window.addEventListener("click", function(e) {

        document.querySelectorAll(".side-modal").forEach(modal => {

            if (e.target === modal) {
                modal.style.display = "none";
            }

        });

    });

});

// shift structure 
document.querySelectorAll('.show-more-btn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();

        const card = this.closest('.nurse-card');

        card.classList.toggle('show-all');

        if (card.classList.contains('show-all')) {
            this.textContent = "See less";
        } else {
            this.textContent = "See more";
        }
    });
});

// cards toggle 
function toggle(el) {
    let content = el.nextElementSibling;
    let icon = el.querySelector(".chevron");

    if (content) {
        content.style.display = content.style.display === "block" ? "none" : "block";
        icon.classList.toggle("rotate");
    }
}
</script>
<script>
function toggle(el) {
    const parent = el.closest(".section-card");

    // OPTIONAL: close others (accordion behavior)
    document.querySelectorAll(".section-card").forEach(card => {
        if (card !== parent) {
            card.classList.remove("active");
        }
    });

    parent.classList.toggle("active");
}
</script>
@endsection