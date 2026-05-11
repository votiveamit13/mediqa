<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Payment Confirmation</title>
</head>
<body style="margin:0; padding:0; background:#f5f7fb; font-family:Arial, sans-serif;">

<table width="100%" bgcolor="#f5f7fb" cellpadding="0" cellspacing="0">
<tr>
<td align="center">

```
<!-- Container -->
<table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; margin:30px auto; border-radius:8px; overflow:hidden;">

    <!-- Header -->
    <tr>
        <td style="background:#2563eb; color:#ffffff; padding:20px; text-align:center; font-size:22px; font-weight:bold;">
            Mediqa
        </td>
    </tr>

    <!-- Title -->
    <tr>
        <td style="padding:20px; text-align:center;">
            <h2 style="margin:0;">Payment Successful 🎉</h2>
            <p style="color:#555;">Your subscription is now active</p>
        </td>
    </tr>

    <!-- Greeting -->
    <tr>
        <td style="padding:0 30px 20px;">
            <p>Hi {{ $user->name }},</p>
            <p>Your payment has been successfully processed. Here are your payment details:</p>
        </td>
    </tr>

    <!-- Payment Details -->
    <tr>
        <td style="padding:0 30px;">
            <table width="100%" cellpadding="10" cellspacing="0" style="border:1px solid #eee; border-radius:6px;">
                
                <tr>
                    <td><strong>Invoice Number</strong></td>
                    <td align="right">{{ $invoice->invoice_number }}</td>
                </tr>

                <tr style="background:#f9f9f9;">
                    <td><strong>Plan</strong></td>
                    <td align="right">{{ $invoice->plan_name }}</td>
                </tr>

                <tr>
                    <td><strong>Billing Cycle</strong></td>
                    <td align="right">{{ ucfirst($invoice->plan_type ?? 'Monthly') }}</td>
                </tr>

                <tr style="background:#f9f9f9;">
                    <td><strong>Amount Paid</strong></td>
                    <td align="right">${{ number_format($invoice->total_amount / 100, 2) }}</td>
                </tr>

                <tr>
                    <td><strong>Date</strong></td>
                    <td align="right">{{ date('d M Y', strtotime($invoice->created_at)) }}</td>
                </tr>

            </table>
        </td>
    </tr>

    <!-- Button -->
    <tr>
        <td align="center" style="padding:30px;">
            <a href="{{ route('medical-facilities.invoice.download', $invoice->id) }}" 
               style="background:#2563eb; color:#fff; padding:12px 25px; text-decoration:none; border-radius:5px; font-weight:bold;">
               Download Invoice
            </a>
        </td>
    </tr>

    <!-- Info -->
    <tr>
        <td style="padding:0 30px 20px;">
            <p>You can now access all features included in your plan.</p>
            <p>If you have any questions, feel free to contact our support team.</p>
        </td>
    </tr>

    <!-- Footer -->
    <tr>
        <td style="background:#f1f1f1; padding:20px; text-align:center; font-size:12px; color:#777;">
            © {{ date('Y') }} Mediqa. All rights reserved.
        </td>
    </tr>

</table>
```

</td>
</tr>
</table>

</body>
</html>
