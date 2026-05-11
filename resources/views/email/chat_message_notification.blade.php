<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Message Received</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family:Arial, sans-serif; width:100%;">

    <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0; padding:30px 0; background-color:#f4f4f4;">
        <tr>
            <td align="center">

                <!-- Fixed width wrapper -->
                <table role="presentation" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px; max-width:600px; background-color:#ffffff; border-collapse:collapse;">
                    
                    <!-- Header -->
                    <tr>
                        <td align="center" style="background-color:#000000; padding:30px 20px;">
                            <h2 style="margin:0; font-size:24px; line-height:32px; color:#ffffff; font-weight:bold;">
                                New Message Received
                            </h2>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:30px 30px 20px 30px; background-color:#ffffff;">

                            <p style="margin:0 0 20px 0; font-size:16px; line-height:26px; color:#333333;">
                                Hello {{ $receiver->name ?? 'User' }},
                            </p>

                            <p style="margin:0 0 20px 0; font-size:15px; line-height:26px; color:#555555;">
                                You have received a new message from:
                                <strong style="color:#111111;">{{ $sender->name ?? 'User' }}</strong>
                            </p>

                            <!-- Message Box -->
                            <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #e5e7eb; background-color:#f9f9f9; border-collapse:collapse; margin-bottom:25px;">
                                <tr>
                                    <td style="padding:18px 20px;">
                                        <p style="margin:0; font-size:15px; line-height:24px; color:#111111; word-wrap:break-word; word-break:break-word;">
                                            {{ $messageText ?? 'You have a new message.' }}
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Button -->
                            <table role="presentation" border="0" cellspacing="0" cellpadding="0" align="center" style="margin:0 auto 30px auto;">
                                <tr>
                                    <td align="center" style="background-color:#000000;">
                                        <a href="{{ url('/healthcare-facilities/chat') }}"
                                           style="display:inline-block; padding:14px 30px; font-size:15px; font-weight:bold; color:#ffffff; text-decoration:none;">
                                            Open Chat
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0; font-size:14px; line-height:24px; color:#777777;">
                                Regards,<br>
                                <strong style="color:#111111;">Mediqa Team</strong>
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background-color:#f9f9f9; padding:20px;">
                            <p style="margin:0; font-size:13px; line-height:22px; color:#888888;">
                                © {{ date('Y') }} Mediqa. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
                <!-- End fixed width wrapper -->

            </td>
        </tr>
    </table>

</body>
</html>