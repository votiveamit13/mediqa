<!DOCTYPE html>
<html>
<head>
    <title>Secure Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
        }

        .payment-container {
            width: 400px;
            margin: 60px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-size: 14px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .input-box {
            border: 1px solid #ddd;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            background: #fafafa;
        }

        .row {
            display: flex;
            gap: 10px;
        }

        .row .col {
            flex: 1;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #635bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #4a45d1;
        }

        #card-errors {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="payment-container">
    <h2>💳 Secure Payment</h2>

    <form id="payment-form">
        <input type="hidden" name="product_id" id="product_id" value="{{ $plan_data->stripe_product_id }}">
        <label>Cardholder Name</label>
        <input type="text" id="name" class="input-box" value placeholder="John Doe" required>

        <label>Card Number</label>
        <div id="card-number" class="input-box"></div>

        <div class="row">
            <div class="col">
                <label>Expiry Date</label>
                <div id="card-expiry" class="input-box"></div>
            </div>

            <div class="col">
                <label>CVV</label>
                <div id="card-cvc" class="input-box"></div>
            </div>
        </div>

        <button type="submit">Pay Now</button>

        <div id="card-errors"></div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();

    const style = {
        base: {
            fontSize: '16px',
            color: '#32325d',
            '::placeholder': {
                color: '#a0aec0'
            }
        }
    };

    const cardNumber = elements.create('cardNumber', { style });
    const cardExpiry = elements.create('cardExpiry', { style });
    const cardCvc = elements.create('cardCvc', { style });

    cardNumber.mount('#card-number');
    cardExpiry.mount('#card-expiry');
    cardCvc.mount('#card-cvc');

    document.getElementById('payment-form').addEventListener('submit', async (e) => {
        e.preventDefault();

        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardNumber,
            billing_details: {
                name: document.getElementById('name').value
            }
        });

        if (error) {
            document.getElementById('card-errors').textContent = error.message;
        } else {
            fetch('{{ route("medical-facilities.process") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    payment_method_id: paymentMethod.id,
                    product_id: '{{ $plan_data->stripe_product_id }}'
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "Payment Successful. Please check email to download invoice",
                    }).then(function() {
                    window.location.href = '{{ route("medical-facilities.billing") }}';
                    }); 
                } else {
                    alert(data.message);
                }
            });
        }
    });
</script>

</body>
</html>