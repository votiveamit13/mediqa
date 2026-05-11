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
</style>
@section('content')
    <main class="main job_detail_div">
        <section class="section-box mt-30">
            <div class="container">
                <div class="job-header">

                    <div class="job-detail-left">

                        <img alt="{{ $healthcare_data->name }}" src="{{ asset('healthcareimg/uploads') }}/{{ $healthcare_data->profile_img }}">

                        <div class="title-wrap">
                            <h1 class="job-title">{{ $jobs->job_title }}</h1>

                            <div class="job-meta">
                                <span>Job ID: {{ $jobs->job_box_id }}</span>
                                <span>{{ $healthcare_data->name }}</span>
                                <span>{{ $healthcare_data->country }}, {{ $state_data->state_code }}</span>
                            </div>

                            <div class="job-submeta">
                                @php
                                    $subnurse_json = (array) json_decode($jobs->nurse_type);
                                    $subspeciality_json = json_decode($jobs->typeofspeciality);
                                    $secondary_speciality = (array) json_decode($jobs->secondary_speciality);

                                    if (is_string($subspeciality_json)) {
                                        $subspeciality_json = json_decode($subspeciality_json, true);
                                    }
                                    
                                    $speciality_data_sec = DB::table('speciality')
                                        ->where('id', $subspeciality_json[0])
                                        ->first();

                                        //print_r($speciality_data_sec);die;
                                    $merged = [];

                                    foreach ($secondary_speciality as $sec_spec) {
                                        $merged = array_merge($merged, $sec_spec);
                                    }
                                    $merged_name_arr = [];
                                    foreach ($merged as $spec) {
                                        $speciality_data = DB::table('speciality')->where('id', $spec)->first();
                                        $merged_name_arr[] = $speciality_data->name;
                                    }

                                    $commaSeparated = implode(',', $merged_name_arr);

                                    $work_environment_data = (array)json_decode($jobs->work_environment);

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
                                <div>Type: {{ $subnurse_json[0] }}</div>
                                <div>Specialty: {{ $speciality_data_sec->name }}</div>
                                <div>Work Environment / Setting: {{ $commaSeparated_work }}</div>
                                <div>Sector: {{ $jobs->sector }}</div>
                                <div>Experience: {{ $jobs->experience_level }} Year</div>
                                <div>Number of Position: {{ $jobs->position_open }}</div>
                                @if ($jobs->willing_to_upskill == 1)
                                    <div class="badge upskill">
                                        Willing to Upskill
                                    </div>
                                @endif
                            </div>

                            <div class="job-extra">
                                Other specialties: {{ $commaSeparated }}
                            </div>
                        </div>
                    </div>


                    <div class="job-detail-right job-right">



                        {{-- <div class="match-ring match-ring-bg">
                            <span>87%</span>
                            <small>Match</small>
                        </div> --}}
                        <button class="save-btn job-detail-save">❤️ Save</button>

                        <!-- <div class="priority-tags">
                                    <span class="tag new">New</span>
                                    <span class="tag urgent">Urgent</span>
                                    <span class="tag immediate">Immediate Start</span>
                                    <span class="tag more">+2 more</span>
                                </div> -->
                        @php
                            $user_id = Auth::guard('nurse_middle')->user()->id;  
                            $apply_job_data = DB::table("nurse_applications")->where("nurse_id",$user_id)->where("job_id",$jobs->id)->first();      
                        @endphp
                        <button @if(empty($apply_job_data)) onclick="applyNow('{{ $user_id }}','{{ $jobs->id }}')" @else disabled @endif class="apply-btn">
                            @if(!empty($apply_job_data))
                            Applied
                            @else
                            Apply Now
                            @endif
                        </button>

                    </div>
                </div>
                <div class="main-grid">
                    <div class="left-col">

                        <!-- ABOUT -->
                        <div class="card">
                            <h2>About the Role</h2>
                            <div class="rich-text">
                                {!! $jobs->about_role !!}
                            </div>
                        </div>


                        <!-- RESPONSIBILITIES -->
                        <div class="card">
                            <h2>Key Responsibilities</h2>
                            <div class="rich-text">
                                {!! $jobs->key_responsiblities !!}
                            </div>
                        </div>


                        <!-- ENVIRONMENT -->
                        <div class="card">
                            <h2>Work Environment</h2>
                            {!! $jobs->role_specific_work_environments !!}
                        </div>



                        <!-- REQUIREMENTS -->
                        <div class="card">
                            <h2>Requirements</h2>
                            @if($jobs->mandatory_training_req != "null")
                            @php
                                $mandatory_training_req = (array) json_decode($jobs->mandatory_training_req);

                                $merged_training = [];

                                foreach ($mandatory_training_req as $mandatory_training) {
                                    $merged_training = array_merge($merged_training, $mandatory_training);
                                }

                                
                                $merged_training_arr = [];
                                foreach ($merged_training as $training) {
                                    
                                    $training_data1 = DB::table('man_training_category')->where('id', $training)->first();
                                    
                                    $merged_training_arr[] = $training_data1->name;
                                }

                                $commaSeparated_training = implode(',', $merged_training_arr);

                                


                                
                            @endphp
                             <h4>Mandatory Training</h4>
                             <div class="training_data">{{ $commaSeparated_training }}</div>
                             @endif
                             @if($jobs->degree_req != "null")
                             @php
                                $degree_req = json_decode($jobs->degree_req);

                                $degeree_arr = [];

                                foreach($degree_req as $degreer){
                                    if($degreer == "no_minimum"){
                                        $degeree_arr[] = "No minimum";
                                    }

                                    if($degreer == "certificate"){
                                        $degeree_arr[] = "Certificate / Diploma";
                                    }

                                    if($degreer == "bachelor"){
                                        $degeree_arr[] = "Bachelor Degree";
                                    }

                                    if($degreer == "postgraduate"){
                                        $degeree_arr[] = "Postgraduate Qualification";
                                    }

                                    if($degreer == "masters"){
                                        $degeree_arr[] = "Master’s Degree";
                                    }

                                    if($degreer == "doctorate"){
                                        $degeree_arr[] = "Doctorate";
                                    }
                                }
                                //print_r($degeree_arr);
                                $commaSeparated_degree = implode(',', $degeree_arr);
                             @endphp
                             <h4>Degree Requirement</h4>
                             <div class="training_data">{{ $commaSeparated_degree }}</div>
                            @endif
                           @if($jobs->reg_licenses_req != "null")
                            @php
                                $registration_licenses = json_decode($jobs->reg_licenses_req);

                                $reg_licenses_arr = [];

                                foreach($registration_licenses as $reg_licenses){
                                    if($reg_licenses == "ndis_provider"){
                                        $reg_licenses_arr[] = "NDIS-registered provider evidence";
                                    }

                                    if($reg_licenses == "medicare"){
                                        $reg_licenses_arr[] = "Medicare / MBS (NP/Midwife) evidence";
                                    }

                                    if($reg_licenses == "pbs"){
                                        $reg_licenses_arr[] = "PBS Prescriber evidence";
                                    }

                                    if($reg_licenses == "immunisation"){
                                        $reg_licenses_arr[] = "Immunisation Provider evidence";
                                    }

                                    if($reg_licenses == "radiation"){
                                        $reg_licenses_arr[] = "Radiation Use Licence evidence";
                                    }

                                }

                                $commaSeparated_licenses = implode(',', $reg_licenses_arr);
                            @endphp    
                                <h4>Registration Licences Requirement</h4>
                                <div class="training_data">{{ $commaSeparated_licenses }}</div>
                            @endif
                        </div>



                        <!-- BENEFITS -->
                        <div class="card">
                            <h2>Benefits</h2>
                            @php
                                $job_benefits = (array) json_decode($jobs->benefits);
                            @endphp
                            @foreach ($job_benefits as $index => $benefits)
                                @php
                                    $benefits_data = DB::table('benefits_preferences')
                                        ->where('benefits_id', $index)
                                        ->first();
                                @endphp
                                <h4>{{ $benefits_data->benefits_name }}</h4>
                                <ul>
                                    @foreach ($benefits as $benefit)
                                        @php
                                            $benefits_name_data = DB::table('benefits_preferences')
                                                ->where('benefits_id', $benefit)
                                                ->first();
                                        @endphp
                                        <li>{{ $benefits_name_data->benefits_name }}</li>
                                    @endforeach
                                </ul>
                            @endforeach

                        </div>



                        <!-- ATTACHMENTS -->
                        <div class="card">
                            <h2>Attachments</h2>
                            <ul class="files">
                                @if($jobs->attachments != NULL)
                                @foreach(json_decode($jobs->attachments) as $attachments)
                                <li><a href="{{ url('/public/uploads/education_degree') }}/{{ $attachments }}">📄 {{ $attachments }}</a></li>
                                @endforeach
                                @endif
                                
                            </ul>
                        </div>

                    </div>
                    <div class="right-col">

                        <!-- CONTACT -->
                        <!--<div class="card">-->
                        <!--    <h2>Contact Person</h2>-->
                        <!--    <p><b>Name:</b> {{ $jobs->contact_person_role }}</p>-->
                        <!--    <p><b>Role:</b> -</p>-->
                        <!--    <p><b>Contact:</b> -</p>-->
                        <!--    <a href="{{ route('nurse.healthcare_details',['id'=>$jobs->healthcare_id])}}">View Facility Profile</a>-->
                        <!--</div>-->
                        @php
                            $healthcare_data = DB::table("users")->where("id",$jobs->healthcare_id)->first();
                            $role_position_data = DB::table("role_position")->where("id",$healthcare_data->role_position)->first(); 
                        @endphp
                        <div class="card">
                            <h2>Contact Person</h2>
                            <p><b>Name:</b> {{ $healthcare_data->contact_person_name }}</p>
                            <p><b>Role:</b> {{ $role_position_data->name }}</p>
                            <p><b>Email:</b> {{ $healthcare_data->email }}</p>
                            <p><b>Phone:</b> {{ $healthcare_data->phone }}</p>
                            <a href="{{ route('nurse.healthcare_details',['id'=>$jobs->healthcare_id])}}">View Facility Profile</a>
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



                        <!-- REQUIRED DOCS -->
                        <div class="card">
                            <h2>Documents Required</h2>
                      @php
                    $documents_required = json_decode($jobs->documents_required, true) ?? [];
                    @endphp
                    
                    <ul>
                        @forelse ($documents_required as $rq_doc)
                        <li>{{ $rq_doc }}</li>
                        @empty
                        <li>No Record Found</li>
                        @endforelse
                    </ul>
                        </div>



                        <!-- STATUS -->
                        <div class="card">
                            <h2>Status & Dates</h2>
                            @php
                                $datetime = $jobs->created_at;
                                $formatted = date("d M Y", strtotime($datetime));  

                                if($jobs->expiry_date == 1){
                                    $date = $jobs->created_at;

                                    $newDate = date('Y-m-d', strtotime($date . ' +7 days'));

                                    $formatted_expires = date("d M Y", strtotime($newDate)); 

                                }

                                
                            
                                if($jobs->expiry_date == 2){
                                    $date = $jobs->created_at;

                                    $newDate = date('Y-m-d', strtotime($date . ' +14 days'));

                                    $formatted_expires = date("d M Y", strtotime($newDate)); 

                                }

                                if($jobs->expiry_date == 3){
                                    $date = $jobs->created_at;

                                    $newDate = date('Y-m-d', strtotime($date . ' +30 days'));

                                    $formatted_expires = date("d M Y", strtotime($newDate)); 

                                }

                                if($jobs->expiry_date == 4){
                                    $date = $jobs->created_at;

                                    $newDate = date('Y-m-d', strtotime($date . ' +60 days'));

                                    $formatted_expires = date("d M Y", strtotime($newDate)); 

                                }
                                
                                if($jobs->expiry_date == 5){
                                    $date = $jobs->created_at;

                                    $newDate = date('Y-m-d', strtotime($jobs->custom_expiry_date));

                                    $formatted_expires = date("d M Y", strtotime($newDate)); 

                                }


                                $start = new DateTime($datetime);
                                $end   = new DateTime($newDate);

                                $diff = $start->diff($end);

                                
                            @endphp
                            <p>Posted: {{ $formatted }}</p>
                            <p>Expires: {{ $formatted_expires }}</p>
                            <p class="closing">Closes in {{ $diff->days+1 . " days" }}</p>
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