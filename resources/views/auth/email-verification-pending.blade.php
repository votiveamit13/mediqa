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
          <p class="text-white font-md mb-4"><i class="bi bi-check-circle-fill text-success"></i> Your account has been successfully registered.</p>
          <p class="text-white w-75 pl-50 pr-50 mx-auto" style="opacity:0.8">We’ve sent you a verification email. Please Click the link inside to activate your account.Didn’t get the email? Please click Resend below.</p>
          <!--<a class="btn btn-border-brand-2 mt-3" href="find_work.php">Verify Account</a>-->
          <button class="btn btn-border-brand-2 mt-3" id="email_link" onclick="return resendEmailLink()"> Resend</button>
        </div>
      </div>
    </div>
  </div>
</div>

</main>

@endsection
@section('js')
<script type="text/javascript">
      function resendEmailLink() {
        $.ajax({
          url: "{{route('nurse.resent-verification-link')}}",
          type: "get",
          dataType: 'json',
          beforeSend: function() {
            $('#email_link').prop('disabled', true);
            $('#email_link').text('Process');
          },
          success: function(data) {
            $('#email_link').prop('disabled', false);
            $('#email_link').text('Click here');
            if (data.status == 1) {
              Swal.fire(
                'Success',
                'Email verification link has been sent!!',
                'success'
              )
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