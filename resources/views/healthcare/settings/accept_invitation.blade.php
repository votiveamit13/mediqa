@extends('nurse.layouts.layout')
@section('content')
 <main class="main">

<div class="container">


  <div class="row justify-content-center align-items-center" style="min-height:600px;">
    <div class="col-md-12">
      <div class="box-newsletter">
        <div class="text-center">
          <h2 class="mb-4 text-white">Welcome to MediQa !</h2>
          <!-- <p><i class="bi bi-check-circle-fill text-success"></i> Great, Set your password and you in</p> -->
          <p class="text-white font-md mb-4"><i class="bi bi-check-circle-fill text-success"></i> You have been invited to join our team </p>
          <p class="text-white w-75 pl-50 pr-50 mx-auto" style="opacity:0.8">Click the button below to accept the invitation.</p>
          <!--<a class="btn btn-border-brand-2 mt-3" href="find_work.php">Verify Account</a>-->
          @php
            $user_id = Auth::guard('healthcare_facilities')->user()->id;
          @endphp
          <button class="btn btn-border-brand-2 mt-3" id="accept_link" onclick="acceptInvitation({{ $user_id }})">Accept</button>
        </div>
      </div>
    </div>
  </div>
</div>

</main>

@endsection
@section('js')
<script type="text/javascript">

      function acceptInvitation(user_id){
        //alert(user_id);
        $.ajax({
          url: "{{route('medical-facilities.acceptInvitation')}}",
          type: "get",
          
          
          data: {
              user_id: user_id
              
          },
          dataType: 'json',
          beforeSend: function() {
            $('#accept_link').prop('disabled', true);
            $('#accept_link').text('Processing');
          },
          success: function(data) {
            $('#accept_link').prop('disabled', false);
            //$('#email_link').text('Click here');
            if (data.status == 1) {
              Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Invitation Accepted Successfully',
              }).then(function() {
              window.location.href = '{{ route("medical-facilities.job_posting") }}';
              
            });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
              })
            }
          }
        });
        return false;
      }
      
    </script>
@endsection