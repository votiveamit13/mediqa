<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f8fafc, #eef2ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .success-wrapper {
            width: 100%;
            max-width: 650px;
        }

        .success-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 50px 40px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0,0,0,0.08);
            position: relative;
            overflow: hidden;
        }

        .success-card::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 220px;
            height: 220px;
            background: rgba(34, 197, 94, 0.08);
            border-radius: 50%;
        }

        .success-card::after {
            content: '';
            position: absolute;
            bottom: -90px;
            left: -90px;
            width: 250px;
            height: 250px;
            background: rgba(59, 130, 246, 0.06);
            border-radius: 50%;
        }

        .icon-circle {
            width: 95px;
            height: 95px;
            margin: 0 auto 25px;
            border-radius: 50%;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.35);
            position: relative;
            z-index: 2;
        }

        .icon-circle i {
            color: #fff;
            font-size: 42px;
        }

        .success-title {
            font-size: 34px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
        }

        .success-text {
            font-size: 17px;
            color: #6b7280;
            line-height: 1.8;
            margin-bottom: 30px;
            position: relative;
            z-index: 2;
        }

        .info-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            padding: 25px;
            margin-bottom: 30px;
            text-align: left;
            position: relative;
            z-index: 2;
        }

        .info-box h4 {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 18px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 14px;
            font-size: 15px;
            color: #374151;
            border-bottom: 1px dashed #e5e7eb;
            padding-bottom: 10px;
        }

        .info-row:last-child {
            margin-bottom: 0;
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-row span:first-child {
            font-weight: 600;
            color: #6b7280;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            position: relative;
            z-index: 2;
        }

        .btn-main {
            background: #111827;
            color: #fff;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            transition: 0.3s ease;
            display: inline-block;
        }

        .btn-main:hover {
            background: #000;
            transform: translateY(-2px);
        }

        .btn-outline {
            background: #fff;
            color: #111827;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            border: 1px solid #d1d5db;
            transition: 0.3s ease;
            display: inline-block;
        }

        .btn-outline:hover {
            background: #f3f4f6;
            transform: translateY(-2px);
        }

        .note-text {
            margin-top: 25px;
            font-size: 14px;
            color: #9ca3af;
            line-height: 1.7;
            position: relative;
            z-index: 2;
        }

        @media (max-width: 768px) {
            .success-card {
                padding: 35px 22px;
            }

            .success-title {
                font-size: 28px;
            }

            .success-text {
                font-size: 15px;
            }

            .info-row {
                flex-direction: column;
                gap: 4px;
            }
        }
    </style>
</head>
<body>

<div class="success-wrapper">
    <div class="success-card">
        <div class="icon-circle">
            <i class="fa-solid fa-check"></i>
        </div>

        <h1 class="success-title">Payment Successful</h1>
        <p class="success-text">
            Your subscription has been activated successfully.
            Thank you for choosing <strong>Mediqa</strong>.
        </p>

        <div class="info-box">
            <h4>Payment Summary</h4>

            <div class="info-row">
                <span>Status</span>
                <span>Successful</span>
            </div>

            <div class="info-row">
                <span>Plan</span>
                <span>{{ $plan_name ?? 'Subscription Plan' }}</span>
            </div>

            <div class="info-row">
                <span>Amount</span>
                <span>{{ $amount ?? 'AUD 0.00' }}</span>
            </div>

            <div class="info-row">
                <span>Payment Method</span>
                <span>{{ $payment_method ?? 'Card / AU BECS Direct Debit' }}</span>
            </div>

            <div class="info-row">
                <span>Date</span>
                <span>{{ date('d M Y') }}</span>
            </div>
        </div>

        <div class="btn-group">
            <a href="{{ url('/billing') }}" class="btn-main">Go to Billing</a>
            <a href="{{ url('/dashboard') }}" class="btn-outline">Go to Dashboard</a>
        </div>

        <p class="note-text">
            A confirmation email and invoice may be sent to your registered email address.
            If you paid using AU BECS Direct Debit, bank processing may take additional time.
        </p>
    </div>
</div>

</body>
</html>