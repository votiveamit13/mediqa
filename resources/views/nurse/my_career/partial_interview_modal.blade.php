<!-- schedule button modal  -->
@if ( $modal_no == 1)
<form>
    <input type="hidden" id="interview_id" value="{{ $interviews->id }}">
<div class="modal fade schedmdl-wrapper" id="schedModal_1" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content schedmdl-content">
            <!-- HEADER -->
            <div class="modal-header schedmdl-header border-0">
                <div>
                    <h5 class="schedmdl-title">
                        {{$interviews->job->job_title}}
                    </h5>
                    <div class="schedstep-wrapper mt-2">

                        <label class="schedstep-item">
                            <input type="radio" name="processStep" value="1" {{ $interviews->status == 1 ? 'checked' : '' }}>
                            <span class="schedstep-circle">1</span>
                            <span class="schedstep-label">Scheduled</span>
                        </label>

                        <label class="schedstep-item">
                            <input type="radio" name="processStep" value="2" {{ $interviews->status == 2 ? 'checked' : '' }}>
                            <span class="schedstep-circle">2</span>
                            <span class="schedstep-label">Reschedule Requested</span>
                        </label>

                        <label class="schedstep-item">
                            <input type="radio" name="processStep" value="3" {{ $interviews->status == 3 ? 'checked' : '' }}>
                            <span class="schedstep-circle">3</span>
                            <span class="schedstep-label">Confirmed</span>
                        </label>

                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>            </div>
            <!-- BODY -->
            <div class="modal-body schedmdl-body">
                <div class="row">
                    <!-- LEFT -->
                    <div class="col-lg-6">
                        <div class="d-flex gap-2 mb-2">
                                @php
                                    $profileImg = $interviews->health_care->profile_img;
                                    $defaultImg = asset('nurse/assets/imgs/nurse06.png'); 
                                @endphp

                                @if(!empty($profileImg))
                                    {{-- Show uploaded image --}}
                                    <img src="{{ asset($profileImg) }}" class="schedmdl-img mr-3">
                                @else
                                    {{-- Show default image --}}
                                    <img src="{{ $defaultImg }}" class="schedmdl-img mr-3">
                                @endif                                   
                            <div>
                                <h6> {{$interviews->job->job_title}}</h6>
                                {{-- <small class="text-muted text-12 lhn">
                                    Canberra General Hospital
                                </small> --}}
                                <small class="text-muted text-12 lhn">
                                      {{$interviews->location_address}}
                                </small>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 text-muted text-12">Scheduled</div>
                            <div class="col-8 text-12">
                                <p>{{ \Carbon\Carbon::parse($interviews->scheduled_at)->format('d M Y') }}</p>
                                    @php
                                        $start = \Carbon\Carbon::parse($interviews->scheduled_at);
                                        $end   = $start->copy()->addMinutes($interviews->duration_minutes);
                                    @endphp
                                <p>{{ $start->format('h:i A') }} - {{ $end->format('h:i A') }}</p>
                            </div>
                        </div>
                        <div class="row mb-2 text-12">
                            <div class="col-4 text-muted">Type</div>
                            <div class="col-8 text-muted">{{$interviews->meeting_type_label}} Interview</div>
                        </div>
                        <div class="row mb-3 text-12">
                            <div class="col-4 text-muted">Phone</div>
                            <div class="col-8 text-muted">{{Auth::guard("nurse_middle")->user()->phone}}</div>
                        </div>
                        <hr>
                        <!-- Notes -->
                        <div class="schedmdl-note">
                            <div class="text-blck"><span><i class="fa fa-sticky-note-o text-blck mr-2"
                                        aria-hidden="true"></i></span>
                                Add a note...</div>
                            <textarea class="form-control mt-2 text-12" rows="3"
                                placeholder="Write your note"></textarea>
                        </div>
                    </div>
                    <!-- RIGHT -->
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-end">
                            <div data-schedule="{{ \Carbon\Carbon::parse($interviews->scheduled_at)->timezone(config('app.timezone'))->format('Y-m-d\TH:i:s') }}"  class="schedmdl-badge mb-3 text-12 countdown">                
                            </div>
                            
                        </div>
                        <div class="onsite_bg p-2">
                            <div class="form-check form-switch d-flex gap-2">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label text-12 mb-0" for="flexSwitchCheckChecked"><small>On-site
                                        Canberra, ACT</small>
                                </label>
                            </div>
                        </div>
                        <div class="schedmdl-card mt-2">
                            <!-- <strong>Contact</strong> -->
                            <div class="text-12 text-muted d-flex gap-2 align-items-center"><i class="fa fa-user"
                                    aria-hidden="true"></i>Sally Field</div>
                            <div class="text-12 text-muted d-flex gap-2 align-items-center"><i class="fa fa-envelope-o"
                                    aria-hidden="true"></i> sally.field@canberra.au</div>
                            <div class="text-12 text-muted d-flex gap-2 align-items-center"><i class="fa fa-phone"
                                    aria-hidden="true"></i> +61 25555 3333 </div>
                        </div>
                        <div class="schedmdl-card mt-2">
                            <h6 class="text-14">Notes</h6>
                            <ul class="text-12 text-muted mt-2">
                                <li>bring a copy of your AHPRA RN registraion</li>
                                <li>bring a copy of your AHPRA RN registraion</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FOOTER -->
            <div class="modal-footer schedmdl-footer">
                {{-- <button class="btn btn-xs btn-light" id="schedModal_close" data-dismiss="modal">
                    Cancel
                </button> --}}
                {{-- <button class="btn btn-sm status-badge conditional_offer">
                    Submit Attendance
                </button> --}}
                <button type="button" class="btn btn-sm status-badge conditional_offer" id="submitAttendanceBtn">
                    Submit Attendance
                </button>
            </div>
        </div>
    </div>
</div>
</form>
@endif

