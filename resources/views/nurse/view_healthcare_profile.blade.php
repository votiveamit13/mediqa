@extends('nurse.layouts.layout')
<style>
   

    .job-header {
        display: flex;
        justify-content: space-between;
        padding: 20px;
        background: #fff;
        border-bottom: 1px solid #eee;
    }

    .job-detail-left {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .facility-logo {
        width: 48px;
        height: 48px;
        border-radius: 10px;
    }

    .job-meta span,
    .job-submeta span {
        margin-right: 10px;
        font-size: 14px;
        color: #666;
    }

    .match-ring {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 6px solid #4CAF50;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .facts-strip {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 15px;
        background: #fff;
        border-bottom: 1px solid #eee;
    }

    .fact {
        background: #f1f1f1;
        padding: 8px 12px;
        border-radius: 8px;
    }

    .main-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        padding: 20px;
    }

    .card {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .card h2 {
        font-size: 18px;
    }

    .card h4 {
        font-size: 16px;
    }

    .card ul li {
        list-style-type: disc;
    }

    .apply-btn {
        background: #000;
        color: #fff;
        border: none;
        padding: 12px 18px;
        border-radius: 8px;
        cursor: pointer;
    }

    .sticky-footer {
        position: sticky;
        bottom: 0;
        background: #fff;
        padding: 15px;
        text-align: center;
        border-top: 1px solid #eee;
    }

    /* 26/2 */
    .job-detail-save {
        display: inline;
        background: #3b82f6;
        padding: 8px 16px;
        border: 0;
        border-radius: 10px;
        color: #fff;
    }

    .job-right {
        display: flex;
        flex-direction: column;
        gap: 10px;
        justify-content: end;
        align-items: center;
    }

    .match-ring-bg {
        border: 6px solid #3b82f6;
    }
       .job-detail-left img {
            width: 200px;
            height: 200px;
        }

    .badge{
        padding:4px 10px;
        border-radius:20px;
        font-size:12px;
        font-weight:600;
        color:#fff;
    }

    .public{
        background-color:black;
    }

</style>
@section('content')
    <main class="main job_detail_div">
        <section class="section-box mt-30">
            <div class="container">
                <div class="job-header">

                    <div class="job-detail-left">

                        <img alt="{{ $healthcare_data->name }}" src="{{ asset('healthcareimg/uploads') }}/{{ $healthcare_data->profile_img }}">

                        <div class="title-wrap">
                            <h1 class="job-title">{{ $healthcare_data->name }}</h1>

                            <div class="job-submeta">
                                @php
                                    if($healthcare_data->sector == 1){
                                        $sector = 'Public & Government';
                                    }

                                    if($healthcare_data->sector == 2){
                                        $sector = 'Private';
                                    }

                                    if($healthcare_data->sector == 3){
                                        $sector = 'Public Government & Private';
                                    }

                                    $country = DB::table("country")->where("iso2",$healthcare_data->country_iso)->first();
                                    
                                    $work_environment_data = (array) json_decode($healthcare_data->facility_services);

                                    $work_environment_arr = [];

                                    foreach ($work_environment_data as $work_environment) {
                                        $work_environment_arr = array_merge($work_environment_arr, (array)$work_environment);
                                    }
                                    $work_name_arr = [];
                                    foreach ($work_environment_arr as $work_env) {
                                        $work_enviornment_preferences = DB::table('work_enviornment_preferences')
                                            ->where('prefer_id', $work_env)
                                            ->first();
                                        $work_name_arr[] = $work_enviornment_preferences->env_name;
                                    }

                                    $commaSeparated_work = implode(',', $work_name_arr);
                                @endphp
                                <div>Sector: {{ $sector }}</div>
                                <div>Operating Country: {{ $country->name }}</div>
                                <div>Facility Services & Care Areas: {{ $commaSeparated_work  }}</div>
                            </div>
                                    
                        </div>
                    </div>


                    
                </div>
                <div class="main-grid">
                    <div class="left-col">
                        @if($healthcare_data->site_data != NULL)
                        <div class="card">
                            <h2>Locations (Sites)</h2>
                            @php
                                $site_data = (array) json_decode($healthcare_data->site_data);
                                $i = 1;
                            @endphp
                            @if($healthcare_data->site_data != NULL)
                            @foreach($site_data as $sdata)

                            @php
                                $state_data = DB::table("states")->where("id",$sdata->state)->first();
                                //$i = 1;
                            @endphp
                            <h4>Site {{ $i }}</h4>
                            <p>
                                <strong>{{ $sdata->site_name }}</strong><br>
                                {{ $sdata->address }}<br>
                                {{ $country->name }}, {{ $state_data->name }} {{ $sdata->post_code }}
                            </p>
                            @php
                                $i++;
                            @endphp
                            @endforeach
                            @endif
                        </div>
                        @endif
                        <div class="card">
                            <h2>Accreditations & Certifications:</h2>
                            @php
                            $get_accreditation = (!empty($healthcare_data->accreditations_certifications))?json_decode($healthcare_data->accreditations_certifications):[];  
                            //print_r($get_accreditation);
                            @endphp
                            
                            @foreach($get_accreditation as $accreditation)
                                @foreach($accreditation as $index=>$accred)
                                    @php
                                        $accred_data = DB::table("accreditation_certifications")->where("id",$index)->first();
                                    @endphp
                                    <h4>{{ $accred_data->name }}</h4>
                                    <ul>
                                        @foreach ($accred as $ac_data)
                                            @php
                                                $accred_data1 = DB::table("accreditation_certifications")->where("id",$ac_data)->first();
                                            @endphp
                                            <li>{{ $accred_data1->name }}</li>
                                        @endforeach
                                    </ul>
                                @endforeach
                            @endforeach
                        </div>
                        <div class="card">
                            <h2>Work Environment Details</h2>
                            <h4>Size</h4>
                            @php
                              $work_environment_size = '';      
                              
                              if($healthcare_data->work_environment_size == 1){
                                $work_environment_size = 'Small clinic';
                              }  
                              if($healthcare_data->work_environment_size == 2){
                                
                                $work_environment_size = 'Medium hospital';
                              }  
                              if($healthcare_data->work_environment_size == 3){
                                $work_environment_size = 'Large tertiary centre';
                              }      
                              echo "<p>".$work_environment_size."</p>";

                              $staff_data = DB::table("healthcare_profile_dropdowns")->where("id",$healthcare_data->staff_wellbeing_programs)->first(); 
                            @endphp
                            <h4>Staff wellbeing programs</h4>
                            <p>{{ $staff_data->name }}</p>
                        </div>
                        <div class="card">
                            <h2>Technology & Equipment</h2>
                            <h4>EMR/EHR System</h4>
                            <ul>
                                @foreach (json_decode($healthcare_data->technology_emr_system) as $technology_emr_system)
                                    @php
                                        $emr_data = DB::table("healthcare_profile_dropdowns")->where("id",$technology_emr_system)->first(); 
                                    @endphp
                                    <li>{{ $emr_data->name }}</li>
                                @endforeach
                            </ul>
                            <h4>Equipment & Facilities</h4>
                            @php
                                $equipment_data = DB::table("healthcare_profile_dropdowns")->where("id",$healthcare_data->equipment_facilities)->first(); 
                            @endphp
                            <p>{{ $equipment_data->name }}</p>
                            <h4>Digital Health Integration</h4>
                            <ul>
                                @foreach (json_decode($healthcare_data->digital_health_integration) as $digital_health_integration)
                                    @php
                                        $digital_health_data = DB::table("healthcare_profile_dropdowns")->where("id",$digital_health_integration)->first(); 
                                    @endphp
                                    <li>{{ $digital_health_data->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        
                    </div>
                    <div class="right-col">
                        <div class="card">
                            <h2>Professional Development</h2>
                            @php
                                $professional_data = DB::table("healthcare_profile_dropdowns")->where("id",$healthcare_data->professional_development)->first(); 
                            @endphp
                            <p>{{ $professional_data->name }}</p>
                        </div>
                        <div class="card">
                            <h2>Facility Profile Visibility</h2>
                            @php
                                $visiblity = "";
                                if($healthcare_data->profile_visiblity == 1){
                                    $visiblity = "Public";
                                }

                                if($healthcare_data->profile_visiblity == 2){
                                    $visiblity = "Private";
                                }

                                $role_position_data = DB::table("role_position")->where("id",$healthcare_data->role_position)->first(); 
                            @endphp
                            <p><span class="badge public">{{ $visiblity }}</span></p>
                        </div>
                        <div class="card">
                            <h2>Contact Person</h2>
                            <p><b>Name:</b> {{ $healthcare_data->contact_person_name }}</p>
                            <p><b>Role:</b> {{ $role_position_data->name }}</p>
                            <p><b>Email:</b> {{ $healthcare_data->email }}</p>
                            <p><b>Phone:</b> {{ $healthcare_data->phone }}</p>
                            <h4>Preferred Communication Method</h4>
                            <ul>
                                @foreach (json_decode($healthcare_data->communication_method) as $communication_method)
                                    @if($communication_method == 1)
                                    <li>Email</li>
                                    @endif
                                    @if($communication_method == 2)
                                    <li>Phone</li>
                                    @endif
                                    @if($communication_method == 3)
                                    <li>In App</li>
                                    @endif
                                @endforeach
                            </ul>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </div>
        <script>
            function applyNow(user_id, job_id) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('/nurse/applyJobs') }}",
                    data: {
                        user_id: user_id,
                        job_id: job_id,
                        _token: '{{ csrf_token() }}'
                    },
                    cache: false,
                    success: function (response) {

                        if (response.status == true) {

                            let btn = $('.apply-btn');

                            btn.text('Applied');
                            btn.addClass('applied');
                            btn.prop('disabled', true);

                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                confirmButtonColor: '#3085d6'
                            });

                        } else {

                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: response.message,
                                confirmButtonColor: '#d33'
                            });

                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong!',
                        });
                    }
                });
            }
        </script>
    @endsection