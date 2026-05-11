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
.custom-toggle {
    position: relative;
    display: inline-block;
    /* width: 64px;
            height: 34px; */
    width: 56px;
    height: 28px;
}

.custom-toggle input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    cursor: pointer;
    inset: 0;
    background-color: #d1d5db;
    transition: 0.3s;
    border-radius: 50px;
}

.toggle-slider:before {
    position: absolute;
    content: "";
    /* height: 26px;
    width: 26px;
    left: 4px;
    top: 4px; */
    height: 23px;
    width: 23px;
    left: 1px;
    top: 2px;
    background-color: white;
    transition: 0.3s;
    border-radius: 50%;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

.custom-toggle input:checked+.toggle-slider {
    background-color: #000;
}

.custom-toggle input:checked+.toggle-slider:before {
    transform: translateX(30px);
}

.toggle-status {
    font-size: 13px;
    font-weight: 600;
    color: #111827;
    margin-top: 10px;
    text-align: center;
}

.notification-list li {
    font-size: 14px;
    color: #4b5563;
    margin-bottom: 8px;
    line-height: 1.6;
    list-style: disc;
}

.notification-list li:last-child {
    margin-bottom: 0;
}

.notify_about ul {
    border: none;
    overflow-y: hidden;
    position: relative;
    box-shadow: none;
    margin-bottom:12px !important;
}
.strong_text strong{
    font-size:18px;
}
.strong_text{
    margin-top:12px;
}
.top-space{
    padding-top:16px
}
.notify_about {
    padding-top: 10px;
}
.emergency_text {
    font-size: 18px;
}
</style>
@endsection

@section('content')
<main class="main">
    <section class="section-box mt-0">
        <div class="">
            <div class="row m-0 profile-wrapper">
                <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">

                    @include('healthcare.settings.sidebar')
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 right_content">
                    <div class="content-single content_profile">


                        <div class="tab-content">
                            <?php $user_id = '';
                                $i = 0; ?>

                            <div class="tab-pane fade" id="tab-my-profile-setting" style="display: block;opacity:1;">


                                <div class="card shadow-sm border-0 p-4">
                                    <h3 class="mt-0 color-brand-1 mb-2">Notifications</h3>

                                    <div class="notification_toggle">
                                        <h6 class="emergency_text">How you’re notified</h6>

                                        <div class="form-check mt-2 d-flex gap-3 align-items-center">
                                            <div for="email_toggle">Email</div>
                                            <label class="custom-toggle mt-2">
                                                <input type="checkbox" id="emailNotificationToggle"
                                                    @if(empty($notification_data)) checked @endif
                                                    @if(!empty($notification_data) &&
                                                    $notification_data->email_notification == 1) checked @endif
                                                onchange="emailNoftify()">
                                                <span class="toggle-slider"></span>
                                            </label>

                                        </div>
                                        <div class="form-check mt-2 d-flex gap-3 align-items-center">
                                            <div for="email_toggle">In-app notifications</div>
                                            <label class="custom-toggle mt-2">
                                                <input type="checkbox" id="appNotificationToggle"
                                                    @if(!empty($notification_data) &&
                                                    $notification_data->app_notification == 1) checked @endif
                                                onchange="emailNoftify()">
                                                <span class="toggle-slider"></span>
                                            </label>

                                        </div>
                                    </div>
                                    <div class="notify_about">
                                        <h6 class="emergency_text">What Mediqa will notify you about</h6>
                                        <div class="strong_text">
                                            <strong class="top-space">Applications</strong>
                                            <ul class="notification-list mb-0 ps-3">
                                                <li>New application received</li>
                                                <li>Candidate shortlisted</li>
                                            </ul>
                                            <strong class="top-space">Interviews</strong>
                                            <ul class="notification-list mb-0 ps-3">
                                                <li>Interview scheduled or changed</li>

                                            </ul>
                                            <strong class="top-space">Compliance</strong>
                                            <ul class="notification-list mb-0 ps-3">
                                                <li>Missing or expiring documents</li>

                                            </ul>
                                            <strong class="top-space">Billing</strong>
                                            <ul class="notification-list mb-0 ps-3">
                                                <li>Invoice issued</li>
                                                <li>Payment failed</li>
                                            </ul>
                                            <strong>Messages</strong>
                                            <ul class="notification-list mb-0 ps-3">
                                                <li>New message received (when chat is enabled)</li>

                                            </ul>
                                        </div>

                                    </div>
                                    <div class="notify_about">
                                        <h6 class="emergency_text">Chat / Messaging</h6>
                                        <div class="strong_text">

                                            <ul class="notification-list mb-0 ps-3">
                                                <li>Messaging is available only after Conditional Offer, Offer, or Hired
                                                </li>
                                                <li>Used for offer clarification, onboarding, and
                                                    job coordination </li>
                                                <li>New messages trigger email and in-app notifications </li>
                                            </ul>

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
function updateToggleStatus(toggleId, statusId) {
    const toggle = document.getElementById(toggleId);
    const status = document.getElementById(statusId);

    function updateText() {
        status.textContent = toggle.checked ? 'On' : 'Off';
    }

    toggle.addEventListener('change', updateText);
    updateText();
}

updateToggleStatus('emailNotificationToggle', 'emailStatus');
updateToggleStatus('appNotificationToggle', 'appStatus');

function emailNoftify() {
    let email_notifications = $('#emailNotificationToggle').is(':checked') ? 1 : 0;
    let app_notifications = $('#appNotificationToggle').is(':checked') ? 1 : 0;

    $.ajax({
        url: "{{ route('medical-facilities.notification_switch') }}",
        type: "POST",
        data: {
            email_notification: email_notifications,
            app_notification: app_notifications,
            _token: "{{ csrf_token() }}"
        },
        dataType: 'json',
        success: function(res) {

        }
    });
}
</script>
@endsection