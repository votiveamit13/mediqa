@php
use Carbon\Carbon;
@endphp
@extends('nurse.layouts.layout')
@section('content')
<style>
.job-like-btn {
    cursor: pointer;
    font-size: 18px;
}

.status-bg {
    background: #fff4da;
    border-radius: 10px;
    padding: 25px;
    border: 1px solid #ffe0b2;
}

.status-bg h5 {
    font-weight: 600;
}

.btn-primary-custom {
    background: #000;
    color: #fff;
    border: none;
    padding: 14px 22px;
    border-radius: 6px;
    border: 1px solid #000;
    transition: all ease-in-out .3s;
}

.btn-primary-custom:hover {
    background: transparent;
    color: #000;
}

/* HEADLINE */
.dashboard-title {
    font-weight: 700;
}

.sub-text {
    color: #6c757d;
}

/* JOB CARD */
.job-card {
    background: #fff;
    border-radius: 14px;
    padding: 14px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    border: 1px solid #000;
    /* position:relative; */
    /* padding-bottom:50px; */
     display: flex;
    flex-direction: column;
    height: 100%; /* important */
}

/* Header */
.job-title {
    font-weight: 700;
    font-size: 18px;
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
/* .job-footer {
    margin-top: 12px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 20px;
    enter;
} */

    .job-footer {
    margin-top: auto; /* THIS pushes it to bottom */
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 20px;

}

.mt-12{
    margin-top:20px;
}

.match {
    font-size: 13px;
    color: #6c757d;
}

.nurse-apply-btn {
    background: #2c7a7b;
    /* border: 1px solid #2c7a7b; */
    padding: 12px;
    border-radius: 6px;
    font-size: 12px;
    display: inline;
    transition: all ease-in-out .3s
}

.nurse-apply-btn:hover {
    background: #fff;
    border: 1px solid #256b6c;
    color: #256b6c !important;
}

.section-title {
    font-weight: 600;
}

.view-all {
    font-size: 14px;
    font-weight: 500;
}

/* ========== */
/* 20/2  */
/* ======= filyter chips ======== */
/* Horizontal scroll container */
.chip-container {
    display: flex;
    overflow-x: auto;
    padding-bottom: 8px;
    gap: 10px;
}

/* Hide scrollbar (optional) */
.chip-container::-webkit-scrollbar {
    display: none;
}

/* Chip Style */
.filter-chip {
    border: 1px solid #e0e0e0;
    background: #fff;
    padding: 5px 10px;
    border-radius: 30px;
    font-weight: 500;
    white-space: nowrap;
    cursor: pointer;
    transition: .2s;
    color: #444;
    font-size: 12px;
}

.filter-chip i {
    margin-right: 2px;
    font-size: 10px;
}

/* Hover */
.filter-chip:hover {
    background: #f2f6ff;
}

/* ACTIVE CHIP */
.filter-chip.active {
    background: #2c7a7b;
    color: #fff;
    border-color: #2c7a7b;
    box-shadow: 0 2px 6px rgba(43, 109, 246, 0.25);
}

/* Urgent visual hint */
.filter-chip.urgent {
    border-color: #ffb3b3;
}

.status-verified {
    background-color: #16a34a;
    color: white;
}

.status-in-review {
    background-color: #ffe605;
    color: black !important;
}

.status-pending {
    background-color: #f97316;
}

.status-not-started {
    background-color: #9ca3af;
}

.status-incomplete {
    background-color: #dc2626;
}

.status-submitted {
    background-color: #2563eb;
}

.status-expired {
    background-color: #4b5563;
}

.modal-status-header {
    padding: 14px;
    color: white;
    font-weight: 600;
    border-radius: 6px 6px 0 0;
}

.status-not-started {
    background: #9ca3af;
}

.status-pending {
    background: #f97316;
}

.status-in-review {
    background: #ffe605;
    color: black;
}

.status-incomplete {
    background: #dc2626;
}

.status-expired {
    background: #4b5563;
}

/* .filter-chip[data-mode="top"]{
        margin-right:20px;
    } */
footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
}

.main {
    padding-bottom: 100px !important;
}

/* match circle  */

/* match circle  */
.match-circle {
    /* position: absolute;
    bottom: 12px;
    left: 12px; */
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: conic-gradient(#16A34A calc(var(--percent) * 1%),
            #9CA3AF 0);
    display: flex;
    align-items: center;
    justify-content: center;
    /* position: relative; */
}

.match-inner {
    width: 55px;
    height: 55px;
    background: white;
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.match-inner .percent {
    font-size: 16px;
    font-weight: bold;
    color: #16A34A;
}

.match-inner .label {
    font-size: 12px;
    color: #16A34A;
}
</style>
<main class="main">
    <section class="section-box mt-30">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 float-right">
                    <div class="chip-container">
                        <button class="filter-chip" data-filter="top">
                            <i class="fas fa-star"></i> Top Matches
                        </button>
                        <button class="filter-chip" data-filter="instant">
                            <i class="fas fa-bolt"></i> Instant Connect
                        </button>
                        <button class="filter-chip" data-filter="last_minute">
                            <i class="far fa-clock"></i> Last Minute
                        </button>
                        <button class="filter-chip" data-filter="immediate">
                            <i class="fas fa-play"></i> Immediate Start
                        </button>
                        <button class="filter-chip" data-filter="urgent">
                            <i class="fas fa-exclamation-circle"></i> Urgent Hire
                        </button>
                        <button class="filter-chip" data-filter="new">
                            <i class="fas fa-certificate"></i> New
                        </button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                        <div>
                            <h3 class="dashboard-title">Your Job Matches</h3>
                            <div class="sub-text">Based on your preferences and availability</div>
                        </div>
                        {{-- <a href="{{ route('nurse.find_jobs') }}" class="view-all">
                        Go to Find Jobs →
                        </a> --}}
                    </div>
                    <div class="d-flex justify-content-between">
                        <h5 class="section-title">Recommended Jobs</h5>
                        <a href="{{ route('nurse.find_jobs') }}" id="viewAllBtn" class="view-all">View all →</a>
                        {{-- <a href="{{ route('nurse.find_jobs') }}?chip_filter={{ sessionStorage.getItem('chip_filter') }}">
                        View All
                        </a> --}}
                    </div>
                    <div class="row" id="main-job-list">
                        @forelse ($jobs_list as $jobs)
                        <!-- JOB CARD -->
                        <div class="col-lg-4 col-md-6 d-flex mt-12">
                            <div class="job-card w-100 mb-4">
                                <!-- Header -->
                                <div class="d-flex justify-content-between gap-2">
                                    <div class="job-title mb-0">{{ $jobs->job_title }}</div>
                                    @php
                                    $liked = DB::table('nurse_job_likes')
                                    ->where('nurse_id', $user_id)
                                    ->where('job_id', $jobs->id)
                                    ->exists();
                                    @endphp
                                    <a href="javascript:void(0)" class="job-like-btn" data-job="{{$jobs->id}}">
                                        <i class="{{ $liked ? 'fas fa-heart text-danger' : 'far fa-heart' }}"></i>
                                    </a>

                                </div>
                                <!-- Location & Type -->
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div class="d-flex gap-4">
                                        <span class="job-meta mr-3">
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ $jobs->state_name }},{{ $jobs->country_name }}
                                        </span>
                                        <span class="job-meta">
                                            <i class="far fa-circle"></i> {{ $jobs->employment_type }}
                                        </span>
                                    </div>
                                    <span class="badge badge-new">New</span>
                                </div>
                                <!-- Salary -->
                                <div class="d-flex justify-content-between mt-3">
                                    <div>
                                        <div class="nurse-salary mt-2">
                                            @php
                                            if ($jobs->main_emp_type == 1) {
                                            $min = $jobs->per_salary_min;
                                            $max = $jobs->per_salary_max;
                                            $per = $jobs->salary_permanent;
                                            } elseif ($jobs->main_emp_type == 2) {
                                            $min = $jobs->fixed_term_salary_min;
                                            $max = $jobs->fixed_term_salary_max;
                                            $per = $jobs->salary_range_fix_term;
                                            } elseif ($jobs->main_emp_type == 3) {
                                            $min = $jobs->temporary_salary_min;
                                            $max = $jobs->temporary_salary_max;
                                            $per = $jobs->salary_range_temporary;
                                            }
                                            @endphp
                                            @if (!empty($min))
                                            <span class="salary">$</span>
                                            <span>{{ $min }} - {{ $max }} {{ $per }}</span>
                                            @endif
                                        </div>
                                        @php
                                        $startDate = Carbon::parse($jobs->created_at);
                                        switch ($jobs->expiry_date) {
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
                                        $endDate = Carbon::parse($jobs->custom_expiry_date);
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
                                    </div>
                                    <div class="match-circle" data-value="{{ round($jobs->match_percentage) }}">
                                        <div class="match-inner">
                                            <div class="percent">{{ round($jobs->match_percentage) }}%</div>
                                            <div class="label">Match</div>
                                        </div>
                                    </div>
                                     <!-- <div class="match-circle" data-value="{{$jobs->match_percentage}}">
                                        <div class="match-inner">
                                            <div class="percent">{{$jobs->match_percentage}}% </div>
                                            <div class="label">Match</div>
                                        </div>
                                    </div> -->
                                     <script>
                                    document.querySelectorAll('.match-circle').forEach(el => {
                                        const val = el.getAttribute('data-value') || 0;
                                        el.style.setProperty('--percent', val);
                                    });
                                    </script>
                                </div>
                                <!-- Bullet Details -->
                                <div class="job-details">
                                    {{-- <div>
                                        <p>Single patient COVID care</p>
                                        <p>PPE provided</p>
                                    </div> --}}
                                    <!-- <div class="match">
                                        {{$jobs->match_percentage}}% match
                                    </div> -->
                                    <!-- =========== -->
                                    <!-- <div class="match-circle" data-value="{{$jobs->match_percentage}}">
                                        <div class="match-inner">
                                            <div class="percent">{{$jobs->match_percentage}}% </div>
                                            <div class="label">Match</div>
                                        </div>
                                    </div> -->
                                    <!-- <script>
                                    document.querySelectorAll('.match-circle').forEach(el => {
                                        const val = el.getAttribute('data-value') || 0;
                                        el.style.setProperty('--percent', val);
                                    });
                                    </script> -->

                                    <!-- ================ -->
                                </div>
                                <!-- Footer -->
                                <div class="job-footer">
                                    {{-- <button class="btn nurse-apply-btn text-white">
                                        Apply Now
                                    </button> --}}
                                    @php
                                    $apply_job_data = DB::table('nurse_applications')
                                    ->where('nurse_id', $user_id)
                                    ->where('job_id', $jobs->id)
                                    ->first();
                                    @endphp
                                    @php
                                    $registration = DB::table('registration_profiles_countries')
                                    ->where('user_id', $user_id)
                                    ->where('country_code', $jobs->location_country)
                                    ->first();
                                    $status = $registration->status ?? null;
                                    @endphp
                                    {{-- registered country --}}
                                    @if ($registration)
                                    @if ($status == 5)
                                    <button class="btn nurse-apply-btn apply-btn-{{ $jobs->id }} text-white
                                    @if (!empty($apply_job_data)) applied @endif" @if (empty($apply_job_data))
                                        onclick="applyNow('{{ $user_id }}','{{ $jobs->id }}')" @else disabled @endif>
                                        @if (!empty($apply_job_data))
                                        Applied
                                        @else
                                        Apply Now
                                        @endif
                                    </button>
                                    @elseif($status == 1)
                                    <button class="btn nurse-apply-btn text-white status-pill status-not-started"
                                        onclick="openStatusModal('not_started')">
                                        Complete Credentials to Apply
                                    </button>
                                    @elseif($status == 2)
                                    <button class="btn nurse-apply-btn text-white status-pill status-pending"
                                        onclick="openStatusModal('pending')">
                                        Complete Credentials to Apply
                                    </button>
                                    @elseif($status == 3 || $status == 4)
                                    <button class="btn nurse-apply-btn status-pill status-in-review"
                                        onclick="openStatusModal('review')">
                                        Verification in Progress
                                    </button>
                                    @elseif($status == 6)
                                    <button class="btn nurse-apply-btn text-white status-pill status-incomplete"
                                        onclick="openStatusModal('incomplete')">
                                        Fix Credentials to Apply
                                    </button>
                                    @elseif($status == 7)
                                    <button class="btn nurse-apply-btn text-white status-pill status-expired"
                                        onclick="openStatusModal('expired')">
                                        Renew Credentials to Apply
                                    </button>
                                    @endif
                                    @else
                                    <button class="btn nurse-apply-btn text-white status-pill status-not-started"
                                        onclick="openStatusModal('not_started')"> Complete Credentials to Apply
                                    </button>
                                    @endif
                                    {{-- <button class="btn text-white nurse-apply-btn {{ $jobs->id }}
                                    @if (!empty($apply_job_data)) applied @endif" @if (empty($apply_job_data))
                                    onclick="applyNow('{{ $user_id }}','{{ $jobs->id }}')" @else disabled @endif>
                                    @if (!empty($apply_job_data))
                                    Applied
                                    @else
                                    Apply Now
                                    @endif
                                    </button> --}}
                                    <div>
                                        <a href="{{ route('nurse.job_details', ['job_id' => $jobs->id]) }}"
                                            class="d-flex gap-2">
                                            <span><i class="fa fa-bookmark-o" aria-hidden="true"></i></span>
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center">
                            <h5>🚫 No Jobs Found</h5>
                            <p>Sorry, no jobs match your search.</p>
                        </div>
                        @endforelse
                    </div>
                    <div id="jobs-container"> </div>
                    <!-- ============== -->
                </div>
                {{-- <div class="col-lg-3 col-md-12 col-sm-12 col-12"></div> --}}
            </div>
        </div>
    </section>
</main>
{{-- City Selection Modal --}}
@if (Auth::guard('nurse_middle')->user()->active_country == null)
<div class="modal fade" id="registrationCountryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
            <!-- Success Icon -->
            <div class="modal-header border-0 justify-content-center">
                <div class="rounded-circle bg-success-subtle p-3">
                    <i class="bi bi-check-circle-fill text-success fs-1"></i>
                </div>
            </div>
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold w-100"> Please choose your registration country </h5>
            </div>
            <!-- Title -->
            <!-- Dropdown -->
            <div class="modal-body">
                <p class="mb-3">
                    This sets your search country and loads the right jurisdictions and checks. You can add more
                    countries later and switch anytime.
                </p>
                <select class="form-select" id="registration_country">
                    <option value="">Select Country</option>
                    @foreach ($countries as $country)
                    <option value="{{ $country->iso2 }}" @if ($country->iso2 === 'AU') selected @endif
                        data-id="{{ $country->id }}"
                        >{{ $country->name }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="country_id" id="country_id">
                <span class="text-danger d-block mt-2" id="countryError"></span>
            </div>
            <!-- Button -->
            <div class="modal-footer border-0">
                <button class="btn btn-dark w-100 fw-bold" id="saveCountry">
                    Continue
                </button>
            </div>
        </div>
    </div>
</div>
@endif
<div class="modal fade" id="modal_not_started">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-status-header status-not-started">
                Complete your credentials
            </div>
            <div class="p-4">
                <p>You must finish registration before applying to jobs.</p>
                <a href="{{ url('nurse/registration_licences?page=registration_licences') }}" class="btn btn-dark">
                    Continue Registration
                </a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_pending">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-status-header status-pending">
                You’re almost ready to apply
            </div>
            <div class="p-4">
                <p>Finish your credentials to unlock job applications.</p>
                <a href="{{ url('nurse/registration_licences?page=registration_licences') }}" class="btn btn-dark">
                    Continue Registration
                </a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_review">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-status-header status-in-review">
                Verification in Progress
            </div>
            <div class="p-4">
                <p>Your credentials are under review. Applying will unlock once verification completes.</p>
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_incomplete">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-status-header status-incomplete">
                Verification issue detected
            </div>
            <div class="p-4">
                <p>One or more credentials need correction.</p>
                <a href="{{ url('nurse/registration_licences?page=registration_licences') }}" class="btn btn-danger">
                    Review & Fix Credentials
                </a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_expired">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-status-header status-expired">
                Your verification has expired
            </div>
            <div class="p-4">
                <p>You must renew credentials before applying.</p>
                <a href="{{ url('nurse/registration_licences?page=registration_licences') }}" class="btn btn-warning">
                    Renew Credentials
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
$(document).on('click', '.job-like-btn', function() {

    let button = $(this);
    let job_id = button.data('job');

    $.ajax({
        url: "{{route('nurse.jobs.like')}}",
        type: "POST",
        data: {
            job_id: job_id,
            _token: "{{csrf_token()}}"
        },
        success: function(res) {

            if (res.status == 'liked') {
                button.find('i')
                    .removeClass('far fa-heart')
                    .addClass('fas fa-heart text-danger');
            } else {
                button.find('i')
                    .removeClass('fas fa-heart text-danger')
                    .addClass('far fa-heart');
            }

        }
    });

});
</script>
<script>
function openStatusModal(status) {
    if (status == 'not_started') {
        $('#modal_not_started').modal('show');
    }
    if (status == 'pending') {
        $('#modal_pending').modal('show');
    }
    if (status == 'review') {
        $('#modal_review').modal('show');
    }
    if (status == 'incomplete') {
        $('#modal_incomplete').modal('show');
    }
    if (status == 'expired') {
        $('#modal_expired').modal('show');
    }
}
</script>
<script>
let chipFilter = 'top';

function filterJobs() {
    sessionStorage.setItem("chip_filter", JSON.stringify(chipFilter));
    $.ajax({
        url: "{{ route('nurse.filter.jobs') }}",
        type: "POST",
        data: {
            filter: chipFilter,
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {

            $('#main-job-list').remove();
            $('#jobs-container').html(response);
        }
    });
}
$(document).on('click', '.filter-chip', function() {
    $('.filter-chip').removeClass('active');
    $(this).addClass('active');
    chipFilter = $(this).data('filter');
    filterJobs();
});
</script>
<script>
document.getElementById('viewAllBtn').addEventListener('click', function(e) {
    e.preventDefault();
    var chip_filter = sessionStorage.getItem('chip_filter');
    var url = "{{ route('nurse.find_jobs') }}" + "?chip_filter=" + chip_filter;
    window.location.href = url;
});
</script>
<script>
$(document).ready(function() {
    if (window.location.pathname.includes("/nurse/dashboard")) {
        $('#registrationCountryModal').modal('show');
    }
});
$('#registration_country').on('change', function() {
    let selectedId = $(this).find(':selected').data('id');
    $('#country_id').val(selectedId);
});
$('#saveCountry').on('click', function() {
    const country = $('#registration_country').val();
    const country_code = $('#country_id').val();
    if (!country) {
        $('#countryError').text('Please select a country');
        return;
    }
    $.ajax({
        url: "{{ route('nurse.saveRegistrationCountry') }}",
        type: "POST",
        data: {
            country_id: country,
            country_code: country_code,
            _token: "{{ csrf_token() }}"
        },
        success: function() {
            $('#registrationCountryModal').modal('hide');
            // Unlock UI
            $('.profession-tab').removeClass('disabled');
            // Redirect cleanly
            // window.location.href = "{{ route('nurse.my-profile') }}?page=my_profile";
            window.location.href = "{{ route('nurse.dashboard') }}";
        }
    });
});
</script>
<script>
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
        success: function(response) {
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
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong!',
            });
        }
    });
}
</script>
@endsection