<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Job Alert</title>
</head>
<body style="margin:0; padding:0; background:#f4f6f8; font-family: Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f4f6f8; padding:30px 0;">
        <tr>
            <td align="center">

                <table width="700" cellpadding="0" cellspacing="0" border="0" style="background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.06);">

                    <!-- Header -->
                    <tr>
                        <td style="background:#0d6efd; padding:30px; text-align:center;">
                            <img src="{{ asset('/nurse/assets/imgs/logo.png') }}" alt="Logo" style="max-height:50px; margin-bottom:10px;">
                            <h1 style="color:#ffffff; margin:0; font-size:28px;">New Job Alert</h1>
                            <p style="color:#dce7ff; margin:8px 0 0; font-size:15px;">
                                Jobs matching your saved search are now available
                            </p>
                        </td>
                    </tr>

                    <!-- Intro -->
                    <tr>
                        <td style="padding:30px;">
                            <p style="font-size:16px; color:#333; margin:0 0 15px;">
                                Hi {{ $user->name ?? 'Nurse' }},
                            </p>

                            <p style="font-size:15px; color:#555; line-height:1.7; margin:0 0 15px;">
                                We found <strong>{{ count($jobs) }}</strong> new job(s) matching your saved search:
                                <strong>{{ $savedSearch->name ?? 'Saved Search' }}</strong>.
                            </p>

                            <p style="font-size:15px; color:#555; line-height:1.7; margin:0;">
                                Here are your latest matches:
                            </p>
                        </td>
                    </tr>

                    <!-- Job Cards -->
                    <tr>
                        <td style="padding:0 30px 30px;">

                            @foreach($jobs as $job)
                                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #e5e7eb; border-radius:10px; margin-bottom:20px; overflow:hidden;">
                                    <tr>
                                        <td style="padding:20px;">
                                            <h3 style="margin:0 0 10px; font-size:20px; color:#111827;">
                                                {{ $job->job_title ?? 'Job Title' }}
                                            </h3>

                                            @php
                                                $company = DB::table("users")->where("id",$job->healthcare_id)->first();
                                            @endphp
                                            <p style="margin:0 0 8px; font-size:14px; color:#6b7280;">
                                                <strong>Employer:</strong> {{ $company->name ?? 'N/A' }}
                                            </p>

                                            <!-- <p style="margin:0 0 8px; font-size:14px; color:#6b7280;">
                                                <strong>Location:</strong> {{ $job->location ?? 'N/A' }}
                                            </p>

                                            <p style="margin:0 0 8px; font-size:14px; color:#6b7280;">
                                                <strong>Shift Type:</strong> {{ $job->shift_label ?? 'N/A' }}
                                            </p>

                                            <p style="margin:0 0 15px; font-size:14px; color:#6b7280;">
                                                <strong>Salary:</strong> {{ $job->salary ?? 'N/A' }}
                                            </p> -->

                                            <a href="{{ url('/job-details/' . $job->id) }}"
                                               style="display:inline-block; background:#0d6efd; color:#ffffff; text-decoration:none; padding:12px 22px; border-radius:8px; font-size:14px; font-weight:bold;">
                                                View Job
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            @endforeach

                        </td>
                    </tr>

                    <!-- CTA -->
                    <tr>
                        <td style="padding:0 30px 30px; text-align:center;">
                            <a href="{{ url('/saved-searches') }}"
                               style="display:inline-block; background:#111827; color:#ffffff; text-decoration:none; padding:14px 28px; border-radius:8px; font-size:15px; font-weight:bold;">
                                Manage Saved Searches
                            </a>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f9fafb; padding:25px 30px; text-align:center; border-top:1px solid #e5e7eb;">
                            <p style="font-size:13px; color:#6b7280; margin:0 0 10px;">
                                You are receiving this email because you enabled job alerts.
                            </p>

                            <p style="font-size:13px; color:#6b7280; margin:0 0 10px;">
                                <a href="{{ url('/notification-settings') }}" style="color:#0d6efd; text-decoration:none;">Manage Alerts</a>
                                &nbsp; | &nbsp;
                                <a href="{{ url('/unsubscribe-job-alerts/' . $user->id) }}" style="color:#0d6efd; text-decoration:none;">Unsubscribe</a>
                            </p>

                            <p style="font-size:12px; color:#9ca3af; margin:0;">
                                © {{ date('Y') }} Your Website Name. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>