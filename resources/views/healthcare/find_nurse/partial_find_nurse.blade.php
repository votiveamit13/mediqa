@foreach ($nurse_list as $list )
<div class="candidate-card">
    <div class="d-flex justify-content-between">
        <div class="d-flex">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="profile-img mr-3">
            <div>
                <div class="name">{{$list->name}} {{$list->lastname}}</div>
                <div class="sub-text">
                    <i class="fa fa-map-marker"></i> Los Angeles, {{ country_name($list->country) }}
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
    <hr>
    <!-- JOB TAG -->
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <span class="job-tag">
                <i class="fa fa-briefcase"></i> ICU RN · MQ-01425
            </span>
            <span class="ml-2 btn btn-light btn-sm">
                <i class="fa fa-plus"></i>
            </span>
        </div>
    </div>
    <hr>
    <!-- STATUS -->
    <div class="row">
        <div class="col-md-10 status-list">
            <p><i class="fa fa-check text-success"></i> Compliance: Verified</p>
            <p><i class="fa fa-check text-success"></i> Vaccinated: Up to Date</p>
            <p><i class="fa fa-check text-success"></i> Availability: Within 48h (Lat
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
    <hr>
    <!-- BUTTONS -->
    <div class="d-flex gap-4 justify-content-end">
        <button class="btn btn-custom mr-2">
            <i class="fa fa-user"></i> Invite to Apply
        </button>
        <button class="btn btn-custom">
            <i class="fa fa-comments"></i> Invite to Interview
        </button>
    </div>
     <!-- @if(!empty($list->application_status) )
    <div class="d-flex gap-4 justify-content-end">
        <button class="btn btn-custom mr-2" disabled>
            <i class="fa fa-user"></i> Already Applied
        </button>
    </div>
    @else
    <div class="d-flex gap-4 justify-content-end">
        <button class="btn btn-custom mr-2">
            <i class="fa fa-user"></i> Invite to Apply
        </button>
        <button class="btn btn-custom">
            <i class="fa fa-comments"></i> Invite to Interview
        </button>
    </div>
    @endif -->
</div>
@endforeach
<div class="pagination-wrapper" id="rohit">
    {{ $nurse_list->links('pagination::bootstrap-4') }}
</div>