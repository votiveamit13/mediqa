<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invitation</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, Helvetica, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:30px 0;">
        <tr>
            <td align="center">
                <table width="100%" max-width="600" cellpadding="0" cellspacing="0"
                    style="max-width:600px; background:#ffffff; border-radius:8px; overflow:hidden;">

                    <!-- Header -->
                    <tr>
                            <td style="background:#000; padding:20px; text-align:center;">
                                <h1 style="margin:0; color:#ffffff; font-size:22px;">
                                    MediQa
                                </h1>
                            </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:30px; color:#333333;">
                            <p>Hello,</p>

                            <p>You have been invited as <strong>{{ $role }}</strong>.</p>
                            <p>Your Password is <strong>{{ $password }}</strong>.</p>

                            <p>
                            <a href="{{ $invite_link }}" 
                            style="background:#0d6efd;color:white;padding:10px 20px;text-decoration:none;border-radius:5px;">
                            Accept Invitation
                            </a>
                            </p>

                            <p>If the button doesn't work, copy this link:</p>

                            <p>{{ $invite_link }}</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f0f0f0; padding:15px; text-align:center; font-size:12px; color:#777;">
                            © ' . '2024' . ' Mediqa. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>