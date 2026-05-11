@if($modal_no == 1)

<div class="modal fade" id="interviewProcessModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content process-modal">
      <!-- Header -->
      <div class="modal-header border-b d-flex flex-column">
        <div class="d-flex justify-content-between w-100">
          <h5 class="mb-1 font-weight-bold" id="modalTitle"> {{ $application->job_title }} Interview </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="d-flex justify-content-between w-100">
          <small class="text-muted ml-auto mr-3">{{ \Carbon\Carbon::parse($application->applied_at)->format('j M Y')}}</small>
          <small class="text-muted">{{$application->health_care->name}}</small>
        </div>
      </div>
      <!-- <hr class="my-0"> -->
      <!-- Body -->
      <div class="modal-body">
            <div class="modal-loader text-center my-4" style="display:none;">
        <span class="spinner-border spinner-border-sm"></span> Loading...
    </div>
        <!-- Status -->
        <div class="alert interview-status mb-4">
          <strong>Interview Scheduled</strong><br>
          Your application is currently being reviewed.
        </div>
        <div class="row">
          <!--INTERVIEW RIGHT PROCESS CARD -->
          <div class="col-md-12">
            <div class="border rounded px-3 py-2">
              <h6 class="font-weight-bold mb-2">
                Interview Details</h6>
              <div class="process">
                <div class="process-item orange">
                  <span class="dot"></span>
                  <div class="content">
                    <small><strong>{{$application->health_care->name}}</strong></small><br>
                    <small class="text-muted">
                      {{$application->interview->location_address}}
                    </small>
                  </div>
                </div>
                <div class="process-item active">
                  <span class="dot"></span>
                  <div class="content">
                    <small> <strong>Date:</strong>
                      {{ \Carbon\Carbon::parse($application->interview->scheduled_at)->format('j M Y') }}</small> <br>
                    <small> <strong>Time: {{ \Carbon\Carbon::parse($application->interview->scheduled_at)->format('h:i
                        A') }}</strong>
                    </small>
                  </div>
                </div>
                <div class="process-item last">
                  <span class="dot"></span>
                  <div class="content">
                    <small>
                      <strong>Interviewer:</strong><br>
                      {{$application->interview->interviewer_name}}</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <div class="modal-footer border-t d-flex justify-content-center">
        <button class="btn btn-danger px-4">
          Withdraw Application
        </button>
        <button class="btn btn-outline-secondary px-4">
          Message Employer
        </button>
      </div>
    </div>
  </div>
</div>

@endif

@if($modal_no == 2)
<!-- View Details Modal  -->
<div class="modal fade" id="offerReviewModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content offer-review-modal">
      <!-- Header -->
      <div class="modal-header border-b d-flex justify-content-between flex-column">
        <div class="d-flex justify-content-between w-100">
          <h5 class="mb-1 font-weight-bold">{{ $application->job_title }}</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="d-flex justify-content-between w-100">
          <small class="text-muted ml-auto mr-3">{{ \Carbon\Carbon::parse($application->applied_at)->format('j M Y')}}</small>
          <small class="text-muted">{{$application->health_care->name}}</small>
        </div>
      </div>
      <!-- <hr class="my-0"> -->
      <!-- Body -->
      <div class="modal-body">
        <div class="row">
          <!-- LEFT PANEL -->
          <div class="col-md-4 mb-3 mb-md-0">
            <span class="mb-3 px-3 py-2 text-black">
              Offer Review
            </span>
            <div class="border rounded mt-2">
              <div class="left-card p-3">
                <h6 class="font-weight-bold mb-2">{{$application->health_care->name}}</h6>
                <small class="text-muted mb-2">
                     {{$application->interview->location_address}}
                </small>
              </div>
              <div class="p-3">
                <p> <small class="mb-1">Casual / Part Time</small></p>
                <p> <small class="mb-0 text-muted font-weight-bold">
                    Full-Time ✓
                  </small>
                </p>
              </div>
            </div>
          </div>
          <!-- RIGHT PANEL -->
          <div class="col-md-8">
            <div class="status-alert mb-4">
              <strong>Under Review</strong><br>
              Your application is currently being reviewed.
            </div>
            <h6 class="font-weight-bold mb-3">
              Document Requirements
            </h6>
            <div class="doc-card mb-3">
              <small>
                <strong>Police Check</strong>
              </small>
              <small class="text-muted">
                No documents requested yet
              </small>
            </div>
            <div class="doc-card">
              <small>
                <strong>Vaccination Record</strong>
              </small>
              <small class="text-muted">
                No documents requested yet
              </small>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <div class="modal-footer border-t justify-content-center">
        <button class="btn btn-outline-secondary px-4">
          Message Employer
        </button>
        <button class="btn btn-danger px-4">
          Withdraw Application
        </button>
      </div>
    </div>
  </div>
</div>
@endif

@if ( $modal_no == 3)
<!-- Accept offer modal  -->
<div class="modal fade" id="acceptOfferModal" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered">
  <div class="modal-content offer-modal">
    <!-- Header -->
    <div class="modal-header border-0 flex w-100 justify-content-between flex-column">
      <div class="d-flex justify-content-between w-100">
        <h5 class="mb-1 font-weight-bold">{{ $application->job_title }}
        </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="d-flex justify-content-between w-100">
        <small class="text-muted">
          {{$application->health_care->name}}, {{ implode(', ', $application->job->shift_names) }}
        </small>
        <small class="text-muted ml-auto mr-3"> {{ \Carbon\Carbon::parse($application->applied_at)->format('j M Y')}}</small>
      </div>
    </div>
    <hr class="my-0">
    <!-- Body -->
    <div class="modal-body">
      <div class="row">
        <!-- Left Content -->
        <div class="col-md-8">
          <div class="d-flex gap-2 mb-3">
            <!-- <span class="py-2 offer-process"></span> -->
            <span class="pl-2">Offer</span>
          </div>
          <!-- Offer Card -->
          <div class="border rounded p-3">
            <div class="row">
              <div class="col-sm-8">
                <div class="d-flex justify-content-between w-100">
                  <div>
                    <small class="text-muted">Start date:</small>
                    <small>21 Nov 2025</small>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <small>$85,000/year</small>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-8">
                <div class="d-flex justify-content-between w-100">
                  <div>
                    <small class="text-muted">Shift:</small>
                    <small>Days</small>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <small>$85,000/year</small>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-8">
                <div class="d-flex justify-content-between w-100">
                  <div>
                    <small class="text-muted">Shift:</small>
                    <small>Days</small>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <small>$85,000/year</small>
              </div>
            </div>
          </div>
        </div>
        <!-- Right Status -->
        <div class="col-md-4">
          <div class="border rounded">
            <div class="status-box p-3">
              <div class="d-flex align-items-center gap-2">
                <h6 class="font-weight-bold">
                  Status</h6>
                {{-- <small>3 kev</small> --}}
              </div>
              <span class="badge badge-success px-3 py-2 d-inline-block">
                Offer
              </span>
            </div>
            <div class="p-3">
              <p class="mb-2">
                <small class="text-muted">Date applied</small><br>
                 {{ \Carbon\Carbon::parse($application->applied_at)->format('j M Y')}}
              </p>
            </div>
          </div>
        </div>
        <div>
          <h6 class="font-weight-bold mb-3 text-center">
            Accept Job Offer?</h6>
          <div class="accept-box p-3 rounded text-center">
            <div>
              <small class="mb-2">
                <strong><small>Starting:</small></strong>
                <span class="text-success ml-1">●</span>
                21 Nov 2025
              </small>
            </div>
            <div>
              <small class="mb-2">
                <strong>Salary:</strong>
                $85,000/year casual rate
              </small>
            </div>
            <div>
              <div class="mb-2 d-flex justify-content-center align-items-center">
                <small> <strong>Shifts:</strong>
                </small>
                <span> <small> Days &
                    Evenings</small></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <div class="modal-footer border-0">
        <button class="btn btn-success px-5">
          Accept Offer
        </button>
        <button class="btn btn-outline-secondary" data-dismiss="modal">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>
</div> 
@endif

@if($modal_no == 4)
<!-- withdraw  -->
<form id="withdrawn-application">
@csrf
<input type="hidden" value="{{$application->id}}" name="application_id">
<div class="modal fade" id="withdrawModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content withdraw-modal">
      <!-- Header -->
      <div class="modal-header border-b d-flex justify-content-between flex-column">
        <div class="d-flex justify-content-between w-100">
          <h5 class="mb-1 font-weight-bold">Withdraw
            Application</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="d-flex justify-content-between w-100">
          <small class="text-muted ml-auto mr-3">{{ \Carbon\Carbon::parse($application->applied_at)->format('j M Y')}}</small>
          <small class="text-muted">{{$application->health_care->name}} ·
            {{ $application->job->employment_type }}</small>
        </div>
      </div>
      <!-- <hr class="my-0"> -->
      <!-- Body -->
      <div class="modal-body">
        <h6 class="font-weight-bold mb-2">
          Withdraw This Application?
        </h6>
        <small class="text-muted mb-4">
          Are you sure you want to withdraw your
          application for the
          Registered Nurse position at St. John Hospital?
          This action
          cannot be undone.
        </small>
        <div class="form-group">
          <small> <label class="font-weight-bold mt-2">
              Reason for Withdraw <span class="text-muted">(Required):</span>
            </label></small>
          <select class="form-control withdraw-text">
            <option selected disabled class="withdraw-text">Select a reason for withdrawing...
            </option>
            <option class="withdraw-text">Accepted
              another offer</option>
            <option class="withdraw-text">Position no
              longer suitable</option>
            <option class="withdraw-text">Change in
              availability</option>
            <option class="withdraw-text">Other
            </option>
          </select>
        </div>
      </div>
      <!-- Footer -->
      <div class="modal-footer border-0 justify-content-start pt-0">
        <button type="button" id="withdrawBtn"  class="btn btn-danger px-4">
          Withdraw Application
        </button>
        <button class="btn btn-outline-secondary px-4" data-dismiss="modal">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>
</form>
@endif

{{-- Archieved Modal --}}

@if($modal_no == 5)
  <!-- Archived withdrawn modal  -->
<div class="modal fade withdrawn-modal" id="withdrawnStatusModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="withdrawn-title">
        {{ $application->job_title }} Application
         <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <small class="withdrawn-pill">Withdrawn</small>
      <div class="withdrawn-info">
        You have withdrawn your application for this position on {{ \Carbon\Carbon::parse($application->job->created_at)->format('j M Y')}}.
      </div>
      <!-- Timeline -->
      <!-- Timeline + Job Card Row -->
      <div class="row">
        <!-- Timeline -->
        <div class="col-12 col-md-6">
          <div class="withdrawn-timeline">
            <div class="withdrawn-step completed">
              <span class="withdrawn-dot">
                <i class="fa fa-check"></i>
              </span>
              Application Submitted
              <span class="withdrawn-date">{{ \Carbon\Carbon::parse($application->applied_at)->format('j M Y')}}</span>
            </div>
            <div class="withdrawn-step completed">
              <span class="withdrawn-dot">
                <i class="fa fa-check"></i>
              </span>
              Under Review
            </div>
            <div class="withdrawn-step completed">
              <span class="withdrawn-dot">
                <i class="fa fa-check"></i>
              </span>
              Shortlisted
            </div>
            <div class="withdrawn-step withdrawn-active">
              <span class="withdrawn-dot"></span>
              <span class="withdrawn-label">Withdrawn</span>
              <small>{{ \Carbon\Carbon::parse($application->withdrawn_at)->format('j M Y')}}</small>
              <div>
                <small>{{Auth::guard("nurse_middle")->user()->name}} - {{ \Carbon\Carbon::parse($application->withdrawn_at)->format('j M Y')}}</small>
              </div>
            </div>
          </div>
        </div>
        <!-- Job Card -->
        <div class="col-12 col-md-6 mt-4 mt-md-0">
          <div class="withdrawn-card">
            <div><strong>Job Title</strong> {{ $application->job_title }}</div>
            <div class="mt-2 d-flex justify-content-between">
              <div>{{$application->health_care->name}}</div>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2">
              <div>
                <strong class="mr-2">Status</strong>
                <span class="withdrawn-status">Withdrawn</span>
              </div>
              <div class="text-muted">
                9 Nov 2025
              </div>
            </div>
            <div class="mt-3 text-center">
              <a href="#">View full job details ></a>
            </div>
          </div>
        </div>
      </div>
      <div class="withdrawn-footer d-flex justify-content-end">
        <!-- <button class="btn btn-light border">Close</button> -->
        <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 
@endif

@if($modal_no == 6)
<!-- Archived Rejected modal -->
<div class="modal fade rejected-modal" id="rejectedModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Header -->
      <div class="rejected-header">
        <!-- ©MEDIQA -->
       <button type="button" class="btn-close" data-bs-dismiss="modal"></button>      
      </div>
      <!-- Title -->
      <div class="rejected-title">
        {{ $application->job_title }} Application
      </div>
      <!-- Status Pill -->
      <div class="rejected-pill">
        <i class="fa fa-times-circle"></i> Rejected
      </div>
      <!-- Alert -->
      <div class="rejected-alert">
        <strong>Application Rejected</strong>
        <p>
          Your application was not successful. St. John Hospital has moved forward
          with another candidate. We encourage you to apply to other opportunities.
        </p>
      </div>
      <div class="row">
        <!-- Timeline -->
        <div class="col-12 col-md-6">
          <div class="rejected-timeline">
            <div class="rejected-step completed">
              <span class="rejected-dot">
                <i class="fa fa-check"></i>
              </span>
              <p>Application Submitted</p>
              <span class="rejected-date">{{ \Carbon\Carbon::parse($application->applied_at)->format('j M Y')}}</span>
            </div>
            <div class="rejected-step completed">
              <span class="rejected-dot">
                <i class="fa fa-check"></i>
              </span>
              Under Review
            </div>
            <div class="rejected-step completed">
              <span class="rejected-dot">
                <i class="fa fa-check"></i>
              </span>
              Shortlisted
            </div>
            <div class="rejected-step rejected-active">
              <span class="rejected-dot">
                <i class="fa fa-times"></i>
              </span>
              <span class="text-danger font-weight-bold">
                Application Rejected
              </span>
              <span class="rejected-date">{{ \Carbon\Carbon::parse($application->rejected_at)->format('j M Y')}}</span>
              <div>
                <small class="text-muted">Employer rejection - {{ \Carbon\Carbon::parse($application->rejected_at)->format('j M Y')}}</small>
              </div>
            </div>
          </div>
        </div>
        <!-- Job Card -->
        <div class="col-12 col-md-6 mt-4 mt-md-0">
          <div class="rejected-card">
            <div><strong>Job Title</strong> {{ $application->job_title }}</div>
            <div class="mt-2 d-flex justify-content-between">
              <div>{{$application->health_care->name}}</div>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2 mb-3">
              <div>
                <strong>Status</strong>
                <span class="rejected-status ml-2">Rejected</span>
              </div>
              <div class="text-muted">
                5 Nov 2025
              </div>
            </div>
            <hr class="my-0">
            <a href="#">View full job details ></a>
          </div>
        </div>
      </div>
      <div class="rejected-footer d-flex justify-content-end">
   
      </div>
    </div>
  </div>
</div>
@endif

@if($modal_no == 7)
  <!-- Archived hired modal -->
<div class="modal fade hired-modal" id="hiredModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Header -->
      <div class="hired-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>    
      </div>
      <!-- Title -->
      <div class="hired-title">
        {{ $application->job_title }} Application
      </div>
      <!-- Status pill -->
      <div class="hired-pill">Hired</div>
      <!-- Message box -->
      <div class="hired-alert">
        <strong>You’ve been hired!</strong>
        <p> Congratulations you have accepted the offer and are now hired as a
          Midwife at Royal Women's Hospital. Your new employer will contact you
          soon for onboarding instructions.
        </p>
      </div>
      <div class="row">
        <div class="col-12 col-md-6">
          <!-- Timeline -->
          <div class="hired-timeline">
            <div class="hired-step">
              <span class="hired-dot dot-green">
                <i class="fa fa-check"></i>
              </span>
              Application Submitted
              <span class="hired-date">{{ \Carbon\Carbon::parse($application->applied_at)->format('j M Y')}}</span>
            </div>
            <div class="hired-step">
              <span class="hired-dot dot-orange">
                <i class="fa fa-check"></i>
              </span>
              Under Review
            </div>
            <div class="hired-step">
              <span class="hired-dot dot-orange">
                <i class="fa fa-check"></i>
              </span>
              Shortlisted
            </div>
            <div class="hired-step">
              <span class="hired-dot dot-blue">
                <i class="fa fa-check"></i>
              </span>
              Interview Scheduled
              <span class="hired-date">{{ \Carbon\Carbon::parse()->now()->format('j M Y')}}</span>
            </div>
            <div class="hired-step">
              <span class="hired-dot dot-blue">
                <i class="fa fa-check"></i>
              </span>
              Offer Extended
              <small class="text-muted">Offer Details viewed - {{ \Carbon\Carbon::parse()->now()->format('j M Y')}}</small>
            </div>
            <div class="hired-step">
              <span class="hired-dot dot-green">
                <i class="fa fa-check"></i>
              </span>
              <strong>Hired</strong>
            </div>
          </div>
        </div>
        <!-- Job Card -->
        <div class="col-12 col-md-6 mt-4 mt-md-0">
          <div class="hired-card">
            <div><strong>Job Title</strong> {{ $application->job_title }}</div>
            <div class="d-flex justify-content-between align-items-center mt-2">
              <div>
                <strong>Status</strong>
                <span class="hired-status ml-2">Hired</span>
              </div>
              <div class="text-muted">
                {{ \Carbon\Carbon::parse()->now()->format('j M Y')}}
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Actions -->
      <div class="hired-actions d-flex justify-content-between gap-2">
        <button class="btn btn-light border w-100">
          Message Employer
        </button>
        <button class="btn btn-primary w-100">
          Submit Documents
        </button>
      </div>
    </div>
  </div>
</div>
  
@endif

<script>
  $(document).on('click', '#withdrawBtn', function () {

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to withdraw this application.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, withdraw it!'
    }).then((result) => {

        if (result.isConfirmed) {

            let formData = $('#withdrawn-application').serialize();

            $.ajax({
                url: "{{ route('nurse.application.withdraw') }}",
                type: "POST",
                data: formData,
                beforeSend: function () {
                    $('.modal-loader').show();
                },
                success: function (response) {
                    $('.modal-loader').hide();

                    if (response.success) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Withdrawn!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#interviewProcessModal').modal('hide');

                        setTimeout(function () {
                            location.reload();
                        }, 2000);

                    } else {
                        Swal.fire(
                            'Error!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function () {
                    $('.modal-loader').hide();

                    Swal.fire(
                        'Error!',
                        'Something went wrong.',
                        'error'
                    );
                }
            });

        }
    });
});
</script>