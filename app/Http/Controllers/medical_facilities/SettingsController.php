<?php

namespace App\Http\Controllers\medical_facilities;

use App\Models\CountryModel;
use App\Models\User;
use App\Models\ProfessionModel;
use App\Models\EligibilityToWorkModel;
use App\Models\WorkingChildrenCheckModel;
use App\Models\PoliceCheckModel;
use App\Models\PractitionerTypeModel;

use App\Models\WorkPreferModel;
use App\Models\JobsModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NurseApplication;

use Illuminate\Support\Facades\Log;
use App\Services\User\AuthServices;
use App\Http\Requests\UserUpdateProfile;
use App\Http\Requests\UserChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Str;
use Mail;
use Validator;
use DB;
use URL;
use Illuminate\Support\Facades\Session;
use Helpers;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Barryvdh\DomPDF\Facade\Pdf;

use Stripe\Customer;


class SettingsController extends Controller
{
    public function index()
    {
        $user_id = Auth::guard('healthcare_facilities')->user()->id;
        // $data['healtcare_data'] = DB::table("users")->where("id",$user_id)->first();
        // $data['recruiter_data'] = DB::table("users")->where("healthcare_id",$user_id)->get();
        $data['recruiter_data'] = DB::table('users')
    ->where(function($query) use ($user_id){
        $query->where('id', $user_id)
              ->orWhere('healthcare_id', $user_id);
    })
    ->get();
        return view('healthcare.settings.access_control')->with($data);
    }

    public function inviteUser(Request $request)
    {
        $email = $request->email;

        
        $token = Str::random(40);

        $password = Str::random(10);

        $user_data = User::where("email",$email)->first(); 

        $user_id = Auth::guard('healthcare_facilities')->user()->id;

        if(empty($user_data)){
            $user = new User;
            $user->healthcare_id = $user_id;
            $user->email = $email;
            $user->role = "5";
            $user->emailToken = $token; 
            $user->password = Hash::make($password); 
            $run = $user->save();
        }else{
            $run = 0;
        }

        if ($run) {
            $htmlBody = view('email.invite-user', [
                'role' => 'Recruiter',
                'password'=>$password,
                'invite_link' => url('/healthcare-facilities/login?token='.$token)
            ])->render();

            try {
                \App\Helpers\ZeptoMailHelper::sendMail(
                    $email,
                    "User Invitation",
                    $htmlBody
                );

                \Log::info("Invitation email sent", ['email' => $email]);
            } catch (\Throwable $ex) {
                \Log::error("Failed to send verification email", [
                    'user_id' => $email,
                    'error'   => $ex->getMessage()
                ]);
            }

            $json['status'] = 1;
            
            
        } else {
            $json['status'] = 0;
            $json['message'] = 'Email is already exists.!';
        }

        echo json_encode($json);
    }

    public function accept_invitation(Request $request)
    {
        
        $user_id = Auth::guard('healthcare_facilities')->user()->id;
        $user = User::find($user_id);
        $user->email_verify = 1;
        $user->emailVerified = '1';
        $user->user_stage = '1'; 
         
        $run = $user->save();

        if ($run) {
            $json['status'] = 1;
        }else {
            $json['status'] = 0;
        }

        echo json_encode($json);
    }

    public function deactivate_user(Request $request)
    {
        $user_id = $request->user_id;
        $status = $request->status;
        $user = User::find($user_id);
        $user->status = $status;
        
         
        $run = $user->save();

        if ($run) {
            $json['status'] = 1;
            $json['user_status'] = $status;
        }else {
            $json['status'] = 0;
        }

        echo json_encode($json);
    }

    public function delete_user(Request $request)
    {
        $user_id = $request->user_id;
        
        $user = User::find($user_id);
        
        
         
        $run = $user->delete();

        if ($run) {
            $json['status'] = 1;
            
        }else {
            $json['status'] = 0;
        }

        echo json_encode($json);
    }

    public function billing(Request $request)
    {
        $user = Auth::guard('healthcare_facilities')->user();
        $data['plan_data'] = DB::table("plan_management")->where("active",1)->get();

        $data['invoices'] = DB::table('invoices')
        ->where('user_id', $user->id)
        ->orderBy('id', 'desc')
        ->get();
        
        return view('healthcare.settings.billing')->with($data);
    }

    public function payment_page(Request $request)
    {
        
        $product_id = $request->product_id;
        $data['plan_data'] = DB::table("plan_management")->where("stripe_product_id",$product_id)->first();
        
        return view('healthcare.settings.payment')->with($data);
    }

    public function notification(Request $request)
    {
        $user_id = Auth::guard("healthcare_facilities")->user()->id;
        $data['notification_data'] = DB::table("users")->where("id",$user_id)->first();
        return view('healthcare.settings.notification')->with($data);
    }

    public function notification_switch(Request $request)
    {
        $user_id = Auth::guard("healthcare_facilities")->user()->id;
        $email_notification = $request->email_notification;
        $app_notification = $request->app_notification;

        

        DB::table("users")->where("id",$user_id)->update(["email_notification"=>$email_notification,"app_notification"=>$app_notification]);

        
    }

    public function process(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        //echo $request->product_id;die;
        $payment_data = DB::table("plan_management")->where("stripe_product_id",$request->product_id)->first();
        $price_data = DB::table("stripe_prices")->where("stripe_price_id",$payment_data->default_price_id)->first();
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => (int) ($price_data->unit_amount*100), // ₹500 (in paise)
                'currency' => 'USD',
                'payment_method' => $request->payment_method_id,
                
                'confirm' => true,
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never', // ✅ FIX
                ],
            ]);

            if ($paymentIntent->status == 'succeeded') {

                $payment_id = DB::table("payments")->insertGetId([
                    'payment_intent_id' => $paymentIntent->id,
                    'product_id' => $request->product_id,
                    'amount' => $paymentIntent->amount/100,
                    'currency' => $paymentIntent->currency,
                    'status' => $paymentIntent->status,
                    'payment_method' => $paymentIntent->payment_method,
                ]);

                $user = Auth::guard('healthcare_facilities')->user();
                // ✅ Create Invoice
                $invoice_id = DB::table("invoices")->insertGetId([
                    'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
                    'user_id' => $user->id,
                    'payment_id' => $payment_id,
                    'product_id' => $request->product_id,
                    'plan_name' => $payment_data->name, // ✅ ADD THIS
                    'amount' => $paymentIntent->amount/100,
                    'tax' => 0,
                    'total_amount' => $paymentIntent->amount/100,
                    'currency' => $paymentIntent->currency,
                    'billing_name' => $user->name,
                    'billing_email' => $user->email,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            $data['invoice'] = DB::table("invoices")->where("id",$invoice_id)->first();   
            $data['user'] = Auth::guard('healthcare_facilities')->user();    

            $htmlBody = view('email.payment_success', $data)->render();    

            try {
                \App\Helpers\ZeptoMailHelper::sendMail(
                    $data['user']->email,
                    "Payment Confirmation - Mediqa",
                    $htmlBody
                );

                \Log::info("Payment Confirmation email sent", ['user_id' => $data['user']->id]);
            } catch (\Throwable $ex) {
                \Log::error("Failed to send Payment Confirmation email", [
                    'user_id' => $data['user']->id,
                    'error'   => $ex->getMessage()
                ]);
            }
            }

            return response()->json([
                'success' => true,
                'message' => 'Payment successful',
                'data' => $paymentIntent
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function invoices()
    {
        $user = Auth::guard('healthcare_facilities')->user();

        $invoices = DB::table('invoices')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('healthcare.settings.index', compact('invoices'));
    }

    public function downloadInvoice($id)
    {
        $invoice = DB::table('invoices')->where('id', $id)->first();

        if (!$invoice) {
            abort(404);
        }

        $pdf = Pdf::loadView('healthcare.settings.invoices.pdf', compact('invoice'));

        return $pdf->download('invoice-'.$invoice->invoice_number.'.pdf');
    }

    public function subscribe($price_id)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $user = Auth::guard("healthcare_facilities")->user();

    // Create Stripe customer if not exists
    if (!$user->stripe_customer_id) {
        $customer = Customer::create([
            'name'  => $user->name,
            'email' => $user->email,
        ]);

        $user->stripe_customer_id = $customer->id;
        $user->save();
    }

    // Optional: get your local plan data
    $plan = DB::table('plan_management')->where('default_price_id', $price_id)->first();

    $session = \Stripe\Checkout\Session::create([
    'mode' => 'subscription',
    'customer' => $user->stripe_customer_id,

    'line_items' => [[
        'price' => $price_id,
        'quantity' => 1,
    ]],

    'payment_method_types' => ['card', 'au_becs_debit'],

    'success_url' => url('/healthcare-facilities/payment-success?session_id={CHECKOUT_SESSION_ID}'),
    'cancel_url' => url('/payment-cancel'),

    // ✅ Add this also
    'metadata' => [
        'user_id' => $user->id,
        'user_type' => 'healthcare_facilities',
        'plan_id' => $plan->id ?? null,
        'plan_name' => $plan->name ?? null,
    ],

    // ✅ Keep this also
    'subscription_data' => [
        'metadata' => [
            'user_id' => $user->id,
            'user_type' => 'healthcare_facilities',
            'plan_id' => $plan->id ?? null,
            'plan_name' => $plan->name ?? null,
        ],
    ],
]);

    return redirect($session->url);
}

  public function success(Request $request)
{
    //dd($request->all());
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    $session_id = $request->session_id;

    $payment = DB::table('payments')
        ->where('stripe_checkout_session_id', $session_id)
        ->latest()
        ->first();

    $invoice = null;

    // If webhook has not inserted payment yet, fetch from Stripe directly
    if (!$payment && $session_id) {
        try {
            $session = \Stripe\Checkout\Session::retrieve($session_id, [
                'expand' => ['subscription', 'customer']
            ]);

            $payment = (object)[
                'stripe_checkout_session_id' => $session->id ?? null,
                'stripe_customer_id' => $session->customer->id ?? $session->customer ?? null,
                'stripe_subscription_id' => $session->subscription->id ?? $session->subscription ?? null,
                'amount' => isset($session->amount_total) ? ($session->amount_total / 100) : 0,
                'currency' => strtoupper($session->currency ?? 'AUD'),
                'status' => $session->payment_status ?? 'paid',
                'product_name' => data_get($session, 'metadata.plan_name'),
                'product_id' => data_get($session, 'metadata.plan_id'),
                'user_id' => data_get($session, 'metadata.user_id'),
            ];
        } catch (\Exception $e) {
            \Log::error('Success page Stripe fetch failed', [
                'message' => $e->getMessage(),
                'session_id' => $session_id,
            ]);
        }
    }

    // If webhook inserted invoice already
    if ($payment && !empty($payment->stripe_invoice_id)) {
        $invoice = DB::table('invoices')
            ->where('stripe_invoice_id', $payment->stripe_invoice_id)
            ->first();
    }

    return view('healthcare.settings.payment-success', compact('payment', 'invoice'));
}

    public function cancel()
    {
        return view('payment-cancel');
    }

    public function compliance_security()
    {
        $data['content'] = DB::table("compliance_security")->first();
        return view('healthcare.settings.compliance_security')->with($data);
    }

    public function support()
    {
        //$data['content'] = DB::table("compliance_security")->where('tab_name', "support")->first();
        return view('healthcare.settings.support');
    }

}