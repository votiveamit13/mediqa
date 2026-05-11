<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
            font-size: 13px;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .header {
            width: 100%;
            margin-bottom: 20px;
        }

        .header-left {
            float: left;
        }

        .header-right {
            float: right;
            text-align: right;
        }

        .clear {
            clear: both;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
        }

        .section {
            margin-top: 20px;
        }

        .box {
            border: 1px solid #ddd;
            padding: 12px;
            border-radius: 5px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th {
            background: #f4f6f8;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .right {
            text-align: right;
        }

        .total-box {
            margin-top: 20px;
            width: 100%;
        }

        .total-box td {
            padding: 8px;
        }

        .grand-total {
            font-size: 16px;
            font-weight: bold;
        }

        .status {
            margin-top: 15px;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #777;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <div class="header-left">
            <div class="title">Mediqa</div>
            <div>Healthcare Hiring Platform</div>
        </div>

        <div class="header-right">
            <div><strong>INVOICE</strong></div>
            <div>#{{ $invoice->invoice_number }}</div>
            <div>{{ date('d M Y', strtotime($invoice->created_at)) }}</div>
        </div>

        <div class="clear"></div>
    </div>

    <!-- Billing Info -->
    <div class="section box">
        <strong>Billed To:</strong><br><br>
        {{ $invoice->billing_name }}<br>
        {{ $invoice->billing_email }}
    </div>

    <!-- Subscription Details -->
    <div class="section">
        <table class="table">
            <thead>
                <tr>
                    <th>Plan</th>
                    <th>Billing Cycle</th>
                    <th class="right">Amount</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>{{ $invoice->plan_name ?? 'Subscription Plan' }}</td>
                    <td>{{ ucfirst($invoice->plan_type ?? 'monthly') }}</td>
                    <td class="right">${{ number_format($invoice->amount / 100, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Totals -->
    <div class="section">
        <table class="total-box">
            <tr>
                <td width="80%" class="right">Subtotal</td>
                <td class="right">${{ number_format($invoice->amount / 100, 2) }}</td>
            </tr>

            @if($invoice->tax > 0)
            <tr>
                <td class="right">Tax</td>
                <td class="right">${{ number_format($invoice->tax / 100, 2) }}</td>
            </tr>
            @endif

            <tr>
                <td class="right grand-total">Total</td>
                <td class="right grand-total">${{ number_format($invoice->total_amount / 100, 2) }}</td>
            </tr>
        </table>
    </div>

    <!-- Status -->
    <div class="status">
        Status: {{ strtoupper($invoice->status) }}
    </div>

    <!-- Footer -->
    <div class="footer">
        Thank you for choosing Mediqa.<br>
        © {{ date('Y') }} Mediqa. All rights reserved.
    </div>

</div>

</body>
</html>