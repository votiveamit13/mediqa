@php
use Carbon\Carbon;
@endphp
<div class="row">
    @forelse ($jobs_list as $jobs)
    <div class="col-lg-4 col-md-6 d-flex">
        <div class="job-card w-100 mb-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center">
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
            {{-- <div class="nurse-salary mt-2">
                <span class="salary"> $ </span> <span> 55/hr </span>
            </div> --}}
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
            <!-- Bullet Details -->
            <div class="job-details">
                {{-- <div>
                    <p>Single patient COVID care</p>
                    <p>PPE provided</p>
                </div> --}}
                <div class="match">
                   {{$jobs->match_percentage}}% match
                </div>
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
                <button class="btn nurse-apply-btn  status-pill status-in-review"
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
                    <a href="{{ route('nurse.job_details', ['job_id' => $jobs->id]) }}" class="d-flex gap-2">
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