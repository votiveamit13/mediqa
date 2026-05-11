<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;
use Stripe\Stripe;
use Stripe\Invoice;
use Stripe\PaymentMethod;
use Carbon\Carbon;

class StripeController extends Controller
{
    public function webhook(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $payload = $request->getContent();
        $sig_header = $request->server('HTTP_STRIPE_SIGNATURE');
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (\UnexpectedValueException $e) {
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response('Invalid signature', 400);
        }

        switch ($event->type) {

            /**
             * 1) Checkout completed
             */
            case 'checkout.session.completed':
                $session = $event->data->object;

                DB::table('payments')->updateOrInsert(
                    ['stripe_checkout_session_id' => $session->id],
                    [
                        'user_id'                => $session->metadata->user_id ?? null,
                        'user_type'              => $session->metadata->user_type ?? 'healthcare_facilities',
                        'plan_id'                => $session->metadata->plan_id ?? null,
                        'plan_name'              => $session->metadata->plan_name ?? null,
                        'stripe_customer_id'     => $session->customer ?? null,
                        'stripe_subscription_id' => $session->subscription ?? null,
                        'amount'                 => isset($session->amount_total) ? ($session->amount_total / 100) : 0,
                        'currency'               => strtoupper($session->currency ?? 'AUD'),
                        'status'                 => $session->payment_status ?? 'pending',
                        'payment_method_type'    => 'pending',
                        'created_at'             => now(),
                        'updated_at'             => now(),
                    ]
                );

                break;

            /**
             * 2) Invoice paid (THIS is the important one)
             */
            case 'invoice.paid':
                $invoice = $event->data->object;

                // Get payment method details if available
                $paymentMethodType = null;
                $paymentMethodLast4 = null;

                if (!empty($invoice->payment_intent)) {
                    $paymentIntent = \Stripe\PaymentIntent::retrieve($invoice->payment_intent);

                    if (!empty($paymentIntent->payment_method)) {
                        $pm = PaymentMethod::retrieve($paymentIntent->payment_method);

                        $paymentMethodType = $pm->type ?? null;

                        if ($paymentMethodType == 'card') {
                            $paymentMethodLast4 = $pm->card->last4 ?? null;
                        } elseif ($paymentMethodType == 'au_becs_debit') {
                            $paymentMethodLast4 = $pm->au_becs_debit->last4 ?? null;
                        }
                    }
                }

                // Save payment table
                DB::table('payments')->updateOrInsert(
                    ['stripe_invoice_id' => $invoice->id],
                    [
                        'user_id'                => $invoice->subscription_details->metadata->user_id ?? null,
                        'user_type'              => $invoice->subscription_details->metadata->user_type ?? 'healthcare_facilities',
                        'plan_id'                => $invoice->subscription_details->metadata->plan_id ?? null,
                        'plan_name'              => $invoice->subscription_details->metadata->plan_name ?? null,
                        'stripe_customer_id'     => $invoice->customer ?? null,
                        'stripe_subscription_id' => $invoice->subscription ?? null,
                        'stripe_invoice_id'      => $invoice->id ?? null,
                        'amount'                 => isset($invoice->amount_paid) ? ($invoice->amount_paid / 100) : 0,
                        'currency'               => strtoupper($invoice->currency ?? 'AUD'),
                        'status'                 => 'paid',
                        'payment_method_type'    => $paymentMethodType,
                        'payment_method_last4'   => $paymentMethodLast4,
                        'paid_at'                => now(),
                        'created_at'             => now(),
                        'updated_at'             => now(),
                    ]
                );

                // Save invoice table
                DB::table('invoices')->updateOrInsert(
                    ['stripe_invoice_id' => $invoice->id],
                    [
                        'user_id'                => $invoice->subscription_details->metadata->user_id ?? null,
                        'stripe_customer_id'     => $invoice->customer ?? null,
                        'stripe_subscription_id' => $invoice->subscription ?? null,
                        'invoice_number'         => $invoice->number ?? null,
                        'stripe_invoice_id'      => $invoice->id ?? null,
                        'invoice_pdf'            => $invoice->invoice_pdf ?? null,
                        'hosted_invoice_url'     => $invoice->hosted_invoice_url ?? null,
                        'amount_due'             => isset($invoice->amount_due) ? ($invoice->amount_due / 100) : 0,
                        'amount_paid'            => isset($invoice->amount_paid) ? ($invoice->amount_paid / 100) : 0,
                        'currency'               => strtoupper($invoice->currency ?? 'AUD'),
                        'status'                 => $invoice->status ?? 'paid',
                        'invoice_date'           => isset($invoice->created) ? Carbon::createFromTimestamp($invoice->created) : now(),
                        'period_start'           => isset($invoice->period_start) ? Carbon::createFromTimestamp($invoice->period_start) : null,
                        'period_end'             => isset($invoice->period_end) ? Carbon::createFromTimestamp($invoice->period_end) : null,
                        'created_at'             => now(),
                        'updated_at'             => now(),
                    ]
                );

                // Optional: update user subscription status
                DB::table('healthcare_facilities')
                    ->where('id', $invoice->subscription_details->metadata->user_id ?? 0)
                    ->update([
                        'subscription_status' => 'active',
                        'updated_at' => now(),
                    ]);

                break;

            /**
             * 3) Invoice payment failed
             */
            case 'invoice.payment_failed':
                $invoice = $event->data->object;

                DB::table('payments')->updateOrInsert(
                    ['stripe_invoice_id' => $invoice->id],
                    [
                        'user_id'                => $invoice->subscription_details->metadata->user_id ?? null,
                        'user_type'              => $invoice->subscription_details->metadata->user_type ?? 'healthcare_facilities',
                        'plan_id'                => $invoice->subscription_details->metadata->plan_id ?? null,
                        'plan_name'              => $invoice->subscription_details->metadata->plan_name ?? null,
                        'stripe_customer_id'     => $invoice->customer ?? null,
                        'stripe_subscription_id' => $invoice->subscription ?? null,
                        'stripe_invoice_id'      => $invoice->id ?? null,
                        'amount'                 => isset($invoice->amount_due) ? ($invoice->amount_due / 100) : 0,
                        'currency'               => strtoupper($invoice->currency ?? 'AUD'),
                        'status'                 => 'failed',
                        'updated_at'             => now(),
                        'created_at'             => now(),
                    ]
                );

                DB::table('healthcare_facilities')
                    ->where('id', $invoice->subscription_details->metadata->user_id ?? 0)
                    ->update([
                        'subscription_status' => 'past_due',
                        'updated_at' => now(),
                    ]);

                break;
        }

        return response('Webhook handled', 200);
    }
}