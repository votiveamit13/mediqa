<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Stripe\Webhook;
use Stripe\Stripe;
use Stripe\Product;
use Stripe\Price;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
{
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    $payload = $request->getContent();
    $sigHeader = $request->server('HTTP_STRIPE_SIGNATURE');
    $endpointSecret = env('STRIPE_WEBHOOK_SECRET');

    $event = json_decode($payload);

    try {
        switch ($event->type) {

            /*
            |--------------------------------------------------------------------------
            | PRODUCT EVENTS
            |--------------------------------------------------------------------------
            */
            case 'product.created':
            case 'product.updated':
                $product = $event->data->object;

                DB::table('plan_management')->updateOrInsert(
                    ['stripe_product_id' => $product->id],
                    [
                        'name' => $product->name ?? null,
                        'description' => $product->description ?? null,
                        'active' => $product->active ?? 0,
                        'default_price_id' => is_string($product->default_price) ? $product->default_price : null,
                        'metadata' => json_encode($product->metadata ?? []),
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
                break;

            case 'product.deleted':
                $product = $event->data->object;

                DB::table('plan_management')
                    ->where('stripe_product_id', $product->id)
                    ->delete();
                break;

            /*
            |--------------------------------------------------------------------------
            | PRICE EVENTS
            |--------------------------------------------------------------------------
            */
            case 'price.created':
            case 'price.updated':
                $price = $event->data->object;

                DB::table('plan_management')->updateOrInsert(
                    ['stripe_price_id' => $price->id],
                    [
                        'stripe_product_id' => $price->product,
                        'currency' => $price->currency ?? null,
                        'unit_amount' => $price->unit_amount ?? null,
                        'type' => $price->type ?? null,
                        'interval' => $price->recurring->interval ?? null,
                        'interval_count' => $price->recurring->interval_count ?? null,
                        'active' => $price->active ?? 0,
                        'metadata' => json_encode($price->metadata ?? []),
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
                break;

            /*
            |--------------------------------------------------------------------------
            | CHECKOUT COMPLETED
            |--------------------------------------------------------------------------
            */
            case 'checkout.session.completed':
                $session = $event->data->object;

                \Log::info('checkout.session.completed', [
                    'session_id' => $session->id,
                    'customer' => $session->customer,
                    'subscription' => $session->subscription,
                ]);

                DB::table('payments')->updateOrInsert(
                    ['stripe_checkout_session_id' => $session->id],
                    [
                        'user_id'                => $session->metadata->user_id ?? null,
                        'user_type'              => $session->metadata->user_type ?? 'healthcare_facilities',
                        'product_id'                => $session->metadata->plan_id ?? null,
                        'product_name'              => $session->metadata->plan_name ?? null,
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

            /*
            |--------------------------------------------------------------------------
            | INVOICE PAID
            |--------------------------------------------------------------------------
            */
            case 'invoice.paid':
                $invoice = $event->data->object;

                \Log::info('invoice.paid', [
                    'invoice_id' => $invoice->id,
                    'customer' => $invoice->customer,
                    'subscription' => $invoice->subscription,
                ]);

                $paymentMethodType = null;
                $paymentMethodLast4 = null;

                if (!empty($invoice->payment_intent)) {
                    $paymentIntent = \Stripe\PaymentIntent::retrieve($invoice->payment_intent);

                    if (!empty($paymentIntent->payment_method)) {
                        $pm = \Stripe\PaymentMethod::retrieve($paymentIntent->payment_method);

                        $paymentMethodType = $pm->type ?? null;

                        if ($paymentMethodType == 'card') {
                            $paymentMethodLast4 = $pm->card->last4 ?? null;
                        } elseif ($paymentMethodType == 'au_becs_debit') {
                            $paymentMethodLast4 = $pm->au_becs_debit->last4 ?? null;
                        }
                    }
                }

                DB::table('payments')->updateOrInsert(
                    ['stripe_invoice_id' => $invoice->id],
                    [
                        'user_id'                => $invoice->subscription_details->metadata->user_id ?? null,
                        'user_type'              => $invoice->subscription_details->metadata->user_type ?? 'healthcare_facilities',
                        'product_id'                => $invoice->subscription_details->metadata->plan_id ?? null,
                        'product_name'              => $invoice->subscription_details->metadata->plan_name ?? null,
                        'stripe_customer_id'     => $invoice->customer ?? null,
                        'stripe_subscription_id' => $invoice->subscription ?? null,
                        'stripe_invoice_id'      => $invoice->id ?? null,
                        'amount'                 => isset($invoice->amount_paid) ? ($invoice->amount_paid / 100) : 0,
                        'currency'               => strtoupper($invoice->currency ?? 'AUD'),
                        'status'                 => 'paid',
                        'payment_method_type'    => $paymentMethodType,
                        'payment_method_last4'   => $paymentMethodLast4,
                        'paid_at'                => now(),
                        'updated_at'             => now(),
                        'created_at'             => now(),
                    ]
                );

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
                        'invoice_date'           => isset($invoice->created) ? date('Y-m-d H:i:s', $invoice->created) : now(),
                        'period_start'           => isset($invoice->period_start) ? date('Y-m-d H:i:s', $invoice->period_start) : null,
                        'period_end'             => isset($invoice->period_end) ? date('Y-m-d H:i:s', $invoice->period_end) : null,
                        'updated_at'             => now(),
                        'created_at'             => now(),
                    ]
                );

                // DB::table('healthcare_facilities')
                //     ->where('id', $invoice->subscription_details->metadata->user_id ?? 0)
                //     ->update([
                //         'subscription_status' => 'active',
                //         'updated_at' => now(),
                //     ]);

                break;

            /*
            |--------------------------------------------------------------------------
            | INVOICE PAYMENT FAILED
            |--------------------------------------------------------------------------
            */
            case 'invoice.payment_failed':
                $invoice = $event->data->object;

                \Log::info('invoice.payment_failed', [
                    'invoice_id' => $invoice->id,
                ]);

                DB::table('payments')->updateOrInsert(
                    ['stripe_invoice_id' => $invoice->id],
                    [
                        'user_id'                => $invoice->subscription_details->metadata->user_id ?? null,
                        'user_type'              => $invoice->subscription_details->metadata->user_type ?? 'healthcare_facilities',
                        'product_id'                => $invoice->subscription_details->metadata->plan_id ?? null,
                        'product_name'              => $invoice->subscription_details->metadata->plan_name ?? null,
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

                // DB::table('healthcare_facilities')
                //     ->where('id', $invoice->subscription_details->metadata->user_id ?? 0)
                //     ->update([
                //         'subscription_status' => 'past_due',
                //         'updated_at' => now(),
                //     ]);

                break;
        }

    } catch (\Exception $e) {
    \Log::error('Stripe Webhook DB Error', [
        'message' => $e->getMessage(),
        'line' => $e->getLine(),
        'file' => $e->getFile(),
    ]);

    return response('Webhook DB Error: ' . $e->getMessage(), 500);
}

    return response('Webhook Handled', 200);
}

    public function syncStripeProducts()
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $products = Product::all(['limit' => 100]);

    foreach ($products->data as $product) {
        DB::table('plan_management')->updateOrInsert(
            ['stripe_product_id' => $product->id],
            [
                'name' => $product->name ?? null,
                'description' => $product->description ?? null,
                'active' => $product->active ?? 0,
                'default_price_id' => is_string($product->default_price) ? $product->default_price : null,
                'metadata' => json_encode($product->metadata ?? []),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        $prices = Price::all([
            'product' => $product->id,
            'limit' => 100
        ]);

        foreach ($prices->data as $price) {
            DB::table('stripe_prices')->updateOrInsert(
                ['stripe_price_id' => $price->id],
                [
                    'stripe_product_id' => $price->product,
                    'currency' => $price->currency ?? null,
                    'unit_amount' => $price->unit_amount ?? null,
                    'type' => $price->type ?? null,
                    'interval' => $price->recurring->interval ?? null,
                    'interval_count' => $price->recurring->interval_count ?? null,
                    'active' => $price->active ?? 0,
                    'metadata' => json_encode($price->metadata ?? []),
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }

    return "Stripe products synced successfully.";
}

}

