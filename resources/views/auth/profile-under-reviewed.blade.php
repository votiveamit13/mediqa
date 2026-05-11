@extends('nurse.layouts.layout')
@section('content')
 <main class="main">

<div class="container">


  <div class="row justify-content-center align-items-center" style="min-height:600px;">
    <div class="col-md-12">
      <div class="box-newsletter">
        <div class="text-center"> 
          <!--<h2 class="mb-4 text-white">Pending verification!</h2>-->
          <!-- <p><i class="bi bi-check-circle-fill text-success"></i> Great, Set your password and you in</p> -->
          <h2 class="text-light">Thank you for verifying your email! </h2>
          <h6 class="text-light">Your MediQa account is now active.</h6>
          <!--<a class="btn btn-border-brand-2 mt-3" href="find_work.php">Verify Account</a>-->
            <p class="text-light my-3 text-center">You can now complete your profile and start applying for jobs.</p>
        </div>
      </div>
    </div>
  </div>
</div>

</main>

@endsection
@section('js')

@endsection