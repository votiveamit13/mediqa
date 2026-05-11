<!DOCTYPE html>
<html lang="en">
	<head>
     <!--  Title -->
     <title>{{ config('app.name') }}</title>
     <!--  Required Meta Tag -->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="handheldfriendly" content="true" />
		<meta name="MobileOptimized" content="width" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset(env('LOGO_PATH') )}}" />
		<!-- Core Css -->
		<link id="themeColors" rel="stylesheet" href="{{ asset('assets/admin/dist/css/style.min.css')}}" />
	</head>
	<body>
		<!-- Preloader -->
		<div class="preloader">
			<img src="{{ asset(env('LOGO_PATH') )}}" alt="loader" class="lds-ripple img-fluid" />
		</div>
		<!-- Preloader -->
		<div class="preloader">
			<img src="{{ asset(env('LOGO_PATH') )}}" alt="loader" class="lds-ripple img-fluid" />
		</div>
		<!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
      @if(session('message2'))
      {!! session('message2') !!}
      @endif
      <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
          <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-3">
              <div class="card mb-0">
                <div class="card-body login-admin">
                  <a href="index.html" class="text-nowrap logo-img text-center d-block mb-5
                     w-100">
                    <img src="{{ asset(env('LOGO_PATH') )}}" width="150" alt="">
                  </a>
                  <form id="formAuthentication" method="post" onsubmit="return sendPassword()">
                  @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email</label>
                      <input type="email" class="form-control"  id="email"  name="email" aria-describedby="emailHelp">
                      <span id="emailErr" class="text-danger"></span>
                    </div>
                    <button type="submit" id="buttonF" class="btn btn-primary w-100 py-8 mb-0 rounded-2">Verify</button>
  
                  </form>
                  <div class="mt-7 ml-6" style="text-align: center; margin-top: 20px !important;">
                    <a class="text-primary fw-medium" href="{{route('admin.login')}}">Back ?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
		<!--  Import Js Files -->
		<script src="{{ asset('assets/admin/dist/libs/jquery/dist/jquery.min.js')}}"></script>
		<script src="{{ asset('assets/admin/dist/libs/simplebar/dist/simplebar.min.js')}}"></script>
		<script src="{{ asset('assets/admin/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
		<!--  core files -->
		<script src="{{ asset('assets/admin/dist/js/app.min.js')}}"></script>
		<script src="{{ asset('assets/admin/dist/js/app.init.js')}}"></script>
		<script src="{{ asset('assets/admin/dist/js/app-style-switcher.js')}}"></script>
		<script src="{{ asset('assets/admin/dist/js/sidebarmenu.js')}}"></script>
		<script src="{{ asset('assets/admin/dist/js/custom.js')}}"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script>
		function sendPassword() {
       $.ajax({
           url: "{{ route('admin.verifyEmail') }}",
           type: 'POST',
           data: new FormData($('#formAuthentication')[0]),
           dataType: 'json',
           cache: false,
           contentType: false,
           processData: false,
           beforeSend: function() {
                   $('#buttonF').prop('disabled', true);
                   $('#buttonF').text('Process....');
               },
           success: function(res) {
            $('#buttonF').prop('disabled', false);
            $('#buttonF').text('Verify');
               if (res.status == '1') {
                   Swal.fire({
                       icon: 'success',
                       title: 'Success',
                       text: "Please Chcek your registered mail id. We have sent you a temporary password.",
                   }).then(function() {
                       window.location.href = '{{ route('admin.login') }}';
                   });
               } else {
                   Swal.fire({
                       icon: 'error',
                       title: 'Error',
                       text: "This Email does not exits !",
                   }).then(function() {
                      
                   });
               }
           },
           error: function(error) {
               $('#buttonF').prop('disabled', false);
               $('#buttonF').text('Verify');
               var email = document.getElementById("email").value;
               if (email == '') {
                   $('#emailErr').text(error.responseJSON.errors.email);

               } else {
                   $('#emailErr').text('');
               }
              

           }
       });
       return false;
   }

		</script>
	</body>
</html>