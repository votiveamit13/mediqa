<?php

namespace App\Http\Controllers\admin;
use App\Http\Requests\AddnewsletterRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Log;
use App\Services\User\AuthServices;
use App\Http\Requests\UserUpdateProfile;
use App\Http\Requests\UserChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Support\Str;
use Helpers;
use Mail;
use Validator;
use DB;
use URL;
use Session;
use File;
use App\Services\Admins\SpecialityServices;
use Illuminate\Support\Facades\Storage;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Price;
use Stripe\Subscription;
use Stripe\Product;

class HealthcareController extends Controller
{
    public function index()
    {
        $data['healthcare_list'] = User::where("role",2)->where('email_verify','1')->where('user_stage','1')->orderBy('created_at','desc')->get();
        return view("admin.healthcare.healthcare_list")->with($data);
    }

    public function healthcare_details(Request $request){
        $healthcare_id = $request->id;
        $data['healthcare_data'] = DB::table("users")->where("id", $healthcare_id)->first();
        //print_r($data);die;
        // $data['healthcare_data'] = User::where("id",$data['jobs']->healthcare_id)->first();
        // $data['state_data'] = DB::table("states")->where("id",$data['jobs']->location_state)->first();
        return view('admin.healthcare.view_healthcare_profile')->with($data);
    }
    
    public function recruiter_list()
    {
        $data['recruiter_list'] = User::where("role",5)->where('email_verify','1')->where('user_stage','1')->orderBy('created_at','desc')->get();
        return view("admin.healthcare.recruiter_list")->with($data);
    }

    public function plan_list()
    {
        //$data['plan_list'] = DB::table("plan_management")->orderBy('created_at','desc')->get();
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $data['plan_list'] = DB::table("plan_management")->get();
        return view("admin.healthcare.plan_list")->with($data);
    }

    public function add_plans()
    {
        $data['product'] = "";

        $data['prices'] = "";
        return view("admin.healthcare.add_plans")->with($data);
    }

    public function add_healthcare()
    {
        
        return view("admin.healthcare.add_healthcare");
    }

    public function edit_healthcare(Request $request)
    {
        $data['user_data'] = DB::table("users")->where("id",$request->id)->first(); 
        return view("admin.healthcare.add_healthcare")->with($data);
    }

    public function post_healthcare(Request $request)
    {
        
        if($request->user_id){
            $user_post = User::find($request->user_id);
        
            $user_post->name = $request->hospital_name;
            $user_post->email = $request->emailaddress;
            $user_post->password = Hash::make($request->password);
            $user_post->country_iso = $request->country;
        
            $run = $user_post->save();
        }else{
            $user_post = new User;
        
            $user_post->name = $request->hospital_name;
            $user_post->role = 2;
            $user_post->email = $request->emailaddress;
            $user_post->password = Hash::make($request->password);
            $user_post->country_iso = $request->country;
        
            $run = $user_post->save();
        }
        

        if ($run) {
            $json['status'] = 1;
            
            
        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);
    }

    public function update_plans(Request $request)
    {
        $product_id = base64_decode($request->id);

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $data['product'] = DB::table("plan_management")->where("plan_id",$request->id)->first();
        //print_r($data['product']->product_id);die;
        //print_r($data);die;
        $data['prices'] = \Stripe\Price::all([
                                        'product' => $data['product']->stripe_product_id
                                    ]);

        return view("admin.healthcare.add_plans")->with($data);
    }

    public function update_plan(Request $request)
    {
        $plan_name = $request->plan_name;
        $product_id = $request->product_id;
        $price_id = $request->price_id;
        $slug = $request->slug;
        $key_features = $request->key_features;
        $description = $request->description;
        $plan_monthly_price = $request->plan_monthly_price;
        $plan_yearly_price = $request->plan_yearly_price;
        $trial_days = $request->trial_days;
        $employer_types = $request->employer_types;
        $job_limit = $request->job_limit;
        $unlimited_jobs = isset($request->unlimited_jobs)?true:false;
        $recruiter_limit = $request->recruiter_limit;
        $unlimited_recruiters = isset($request->unlimited_recruiters)?true:false;
        $status = $request->status;
        $billing_cycle_enabled = $request->billing_cycle_enabled;

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $employer_types_data = DB::table("employer_type")->whereIn("id",$employer_types)->get();

        $emp_type_arr = [];
        
        foreach($employer_types_data as $emp_type){
            $emp_type_arr[] = $emp_type->name;
        }

        $emp_str = implode(",",$emp_type_arr);

        if($product_id){
                
            $plan_data = DB::table('plan_management')->where("plan_id",$request->plan_id)->first();

            if($status == 1){
                $status1 = true;
            }else{
                $status1 = false;
            }

            $product = \Stripe\Product::update($product_id,[
                'name' => $plan_name,
                'description' => $description,
                //'marketing_features' => $key_features,
                "metadata"=>[
                    "slug" => $slug,
                    "trial_days" => $trial_days,
                    "employer_types" => $emp_str,
                    "job_limit" => $job_limit,
                    "key_features" => $key_features,
                    "unlimited_jobs" => $unlimited_jobs,
                    "recruiter_limit" => $recruiter_limit,
                    "unlimited_recruiters" => $unlimited_recruiters
                ],
                "active" => $status1
            ]);

            $price = \Stripe\Price::create([
                'unit_amount' => $plan_monthly_price*100, // $150
                'currency' => 'usd',
                'recurring' => ['interval' => $billing_cycle_enabled], // or 'year'
                'product' => $product->id,
            ]);

            // ===== Deactivate Old Prices =====
            if (!empty($plan_data->price_id)) {
                \Stripe\Price::update($plan_data->price_id, [
                    'active' => false
                ]);
            }
            
            $run = DB::table('plan_management')->where("plan_id",$request->plan_id)->update([
                'stripe_product_id' => $product->id,
                'default_price_id' => $price->id,
                'name' => $plan_name,
                'features' => $key_features,
                'slug' => $slug,
                'description' => $description,
                
                'trial_days' => $trial_days,
                'employer_types' => json_encode($employer_types),
                'job_limits' => $job_limit,
                'unlimited_jobs' => $unlimited_jobs,
                'recruiter_limits' => $recruiter_limit,
                'unlimited_recruiter' => $unlimited_recruiters,
                'active' => $status,
                
                'updated_at' => now()
            ]);
            DB::table('stripe_prices')->insert([
                'stripe_product_id' => $product->id,
                'stripe_price_id' => $price->id,
                'active' => $status,
                'currency' => 'aud',
                'type' => 'recurring',
                'interval_count' => '1',
                'unit_amount' => $plan_monthly_price*100,
                'interval' => $billing_cycle_enabled,
                'created_at' => now()
            ]);
        }else{
            

           if($status == 1){
                $status1 = true;
            }else{
                $status1 = false;
            }

            // Create Product
            $product = \Stripe\Product::create([
                'name' => $plan_name,
                'description' => $description,
                //'marketing_features' => $key_features,
                "metadata"=>[
                    "slug" => $slug,
                    "trial_days" => $trial_days,
                    "employer_types" => $emp_str,
                    "job_limit" => $job_limit,
                    "key_features" => $key_features,
                    "unlimited_jobs" => $unlimited_jobs,
                    "recruiter_limit" => $recruiter_limit,
                    "unlimited_recruiters" => $unlimited_recruiters
                ],
                "active" => $status1
            ]);

            // if($plan_monthly_price != ""){
            //     $price = $plan_yearly_price;
            // }

            // Create Price (monthly/yearly)
            $price = \Stripe\Price::create([
                'unit_amount' => $plan_monthly_price*100, // $150
                'currency' => 'usd',
                'recurring' => ['interval' => $billing_cycle_enabled], // or 'year'
                'product' => $product->id,
            ]);

            $run = DB::table('plan_management')->insert([
            'stripe_product_id' => $product->id,
            'default_price_id' => $price->id,
            'name' => $plan_name,
            'features' => $key_features,
            'slug' => $slug,
            'description' => $description,
            
            'trial_days' => $trial_days,
            'employer_types' => json_encode($employer_types),
            'job_limits' => $job_limit,
            'unlimited_jobs' => $unlimited_jobs,
            'recruiter_limits' => $recruiter_limit,
            'unlimited_recruiter' => $unlimited_recruiters,
            'active' => $status,
            
            'created_at' => now()
        ]);

        DB::table('stripe_prices')->insert([
            'stripe_product_id' => $product->id,
            'stripe_price_id' => $price->id,
            'active' => $status,
            'currency' => 'aud',
            'type' => 'recurring',
            'interval_count' => '1',
            'unit_amount' => $plan_monthly_price*100,
            'interval' => $billing_cycle_enabled,
            'created_at' => now()
        ]);
        }

        
        
        if ($product) {
            $json['status'] = 1;
            $json['product_id'] = $product_id;
            
        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);
    }

    public function show_customers()
    {
        

        $invoices = DB::table('invoices')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.healthcare.show_customers', compact('invoices'));
    }

    public function show_invoice()
    {
        

        $invoices = DB::table('invoices')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.healthcare.show_invoice', compact('invoices'));
    }


    public function add_compliance_security()
    {
        $data['content'] = DB::table("compliance_security")->first();
        return view('admin.healthcare.add_compliance_security')->with($data);
    }

    public function update_compliance_security(Request $request)
    {
        $compliance_content = $request->compliance_content;

        $content = DB::table("compliance_security")->first();

        if(!empty($content)){
            $run = DB::table("compliance_security")->update(["compliance_content"=>$compliance_content]);
        }else{
            $run = DB::table("compliance_security")->insert(["compliance_content"=>$compliance_content]);
        }
        

        if ($run) {
            $json['status'] = 1;
            
            
        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);
    }
}