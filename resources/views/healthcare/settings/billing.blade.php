@extends('nurse.layouts.layout')

@section('css')
<style>
    .subscription-container{
        padding:40px;
        background:#f5f7fb;
        text-align:center;
    }

    .title{
        font-size:28px;
        margin-bottom:35px;
    }

    .plan-wrapper{
        display:flex;
        justify-content:center;
        gap:30px;
        flex-wrap:wrap;
    }

    .plan-card{
        background:#fff;
        width:320px;
        padding:30px;
        border-radius:12px;
        box-shadow:0 4px 20px rgba(0,0,0,0.05);
        position:relative;
    }

    .highlight{
        border:2px solid #2563eb;
    }

    .badge{
        position:absolute;
        top:-12px;
        left:50%;
        transform:translateX(-50%);
        background:#2563eb;
        color:#fff;
        padding:4px 12px;
        border-radius:20px;
        font-size:12px;
    }

    .plan-name{
        font-size:20px;
        margin-bottom:10px;
    }

    .plan-price{
        font-size:34px;
        font-weight:700;
        margin-bottom:10px;
    }

    .plan-price span{
        font-size:14px;
        color:#777;
    }

    .plan-desc{
        font-size:14px;
        color:#666;
        margin-bottom:20px;
    }

    .plan-features{
        list-style:none;
        padding:0;
        text-align:left;
        margin-bottom:25px;
    }

    .plan-features li{
        margin-bottom:8px;
    }

    .btn-plan{
        border:1px solid #2563eb;
        background:#fff;
        color:#2563eb;
        padding:10px 20px;
        border-radius:6px;
        cursor:pointer;
    }

    .btn-plan.primary{
        background:#2563eb;
        color:#fff;
    }

    .active-plan {
    border: 2px solid #000;
    box-shadow: 0 10px 30px rgba(0,0,0,0.10);
}
</style>
@endsection

@section('content')
<main class="main">
    <section class="section-box mt-0">
        <div class="">
            <div class="row m-0 profile-wrapper">
                <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">

                    @include('healthcare.settings.sidebar')
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 right_content">
                    <div class="subscription-container">

                        <h2 class="title">Subscription Plans</h2>

                        <div class="plan-wrapper">

                            <!-- Starter Plan -->
                            @foreach($plan_data as $plandata)
                            @php
                                $user_id = Auth::guard("healthcare_facilities")->user()->id;
                                $invoice_data = DB::table("invoices")->where("user_id",$user_id)->where("product_id",$plandata->stripe_product_id)->first();
                                $price_data = DB::table("stripe_prices")->where("stripe_price_id",$plandata->default_price_id)->first();    

                                
                            @endphp
                            <div class="plan-card @if(!empty($invoice_data)) active-plan @endif">
                                <h3 class="plan-name">{{ $plandata->name }}</h3>
                                
                                    
                                    <div class="plan-price">
                                    ${{ $price_data->unit_amount/100 }} <span>/{{ $price_data->interval }}</span>
                                    </div>

                                <p class="plan-desc">
                                    @php
                                        $employer_types = json_decode($plandata->employer_types);

                                        $emp_name_arr = [];
                                        foreach($employer_types as $emp_type){
                                            $emp_name = DB::table("employer_type")->where("id",$emp_type)->first();
                                            $emp_name_arr[] = $emp_name->name;
                                        }
                                        echo implode(",",$emp_name_arr);
                                    @endphp
                                </p>

                                <!-- <ul class="plan-features">
                                    <li>Up to 10 active jobs</li>
                                    <li>Smart ranking & matching</li>
                                    <li>Access verified nurse profiles</li>
                                    <li>Instant Connect</li>
                                    <li>Compliance tracking insights</li>
                                    <li>In-app messaging</li>
                                    <li>Basic support</li>
                                </ul> -->
                                <div class="plan-features">
                                    {!! $plandata->features !!}
                                </div>
                                
                                @if(empty($invoice_data))
                                <!-- <a href="{{ route('medical-facilities.payment_page',['product_id'=>$plandata->stripe_product_id]) }}" class="btn-plan">Choose Plan</a> -->
                                 <a href="{{ route('medical-facilities.subscribe', $plandata->default_price_id) }}" class="btn btn-dark">
    Choose Plan
</a>
                               
                                @endif
                            </div>
                            @endforeach

                            <!-- Professional Plan -->
                            <!-- <div class="plan-card highlight">

                                <div class="badge">Most Popular</div>

                                <h3 class="plan-name">Professional</h3>

                                <div class="plan-price">
                                    $500 <span>/month</span>
                                </div>

                                <p class="plan-desc">
                                    Hospitals and agencies with ongoing recruitment
                                </p>

                                <ul class="plan-features">
                                    <li>Unlimited jobs</li>
                                    <li>Multi-site hiring support</li>
                                    <li>Team access (multiple recruiters)</li>
                                    <li>Priority support</li>
                                </ul>

                                <button class="btn-plan primary">Choose Plan</button>

                            </div> -->

                        </div>
                        <hr style="margin:50px 0;">

                            <h2 class="title">Invoices</h2>

                            <div class="table-responsive">
                                <table class="table table-bordered" style="background:#fff;">
                                    <thead style="background:#f1f1f1;">
                                        <tr>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Invoice</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($invoices as $invoice)
                                            <tr>
                                                <td>{{ date('d M Y', strtotime($invoice->created_at)) }}</td>

                                                <td>
                                                    ${{ number_format($invoice->total_amount / 100, 2) }}
                                                </td>

                                                <td>
                                                    @if($invoice->status == 'paid')
                                                        <span style="color:green; font-weight:bold;">Paid</span>
                                                    @else
                                                        <span style="color:red; font-weight:bold;">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('medical-facilities.invoice.download', $invoice->id) }}" target="_blank" 
                            style="background:#2563eb;color:#fff;padding:6px 12px;border-radius:5px;text-decoration:none;">
                            PDF
                            </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No invoices found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>    
                    </div>
                    
                </div>
            </div>
        </div>
        
    </section>
</main>
@endsection