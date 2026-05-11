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
		<link rel="shortcut icon" type="image/png" href="{{ asset('nurse/assets/imgs/template/favicon.png')}}" />
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
			 <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
				<div class="d-flex align-items-center justify-content-center w-100">
					<div class="row justify-content-center w-100">
						<div class="col-md-8 col-lg-6 col-xxl-3">
							<div class="card mb-0">
								<div class="card-body login-admin">
									<a href="javascript:void(0)" class="text-nowrap logo-img text-center d-block mb-5 w-100">
										<img src="{{ asset(env('LOGO_PATH') )}}" width="100" alt="">
									</a>
									<div class="logoutMessage">@if(session('message2')) {!! session('message2') !!} @endif</div>
									<form id="formAuthentication" onsubmit="return Login()" method="post"> @csrf <div class="mb-3">
											<label for="exampleInputEmail1" class="form-label">Email</label>
											<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
											<span id="emailErr" class="text-danger"></span>
										</div>
										<div class="mb-4">
											<label for="exampleInputPassword1" class="form-label">Password</label>
											<input type="password" class="form-control" id="password" name="password">
											<span id="passwordErr" class="text-danger"></span>
										</div>
										<button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign In </button>
									</form>
									<div style="margin-bottom:5px;margin-left:10px;text-align: center; ">
										<a class="text-primary fw-medium" href="{{route('admin.forgot-password')}}">Forgot Password ?</a>
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
		setTimeout(function() {
			document.querySelector('.logoutMessage').remove();
		}, 2000);

			function Login() {
				$.ajax({
					url: "{{ route('admin.loginAction') }}",
					type: 'POST',
					data: new FormData($('#formAuthentication')[0]),
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success: function(res) {
						console.log(res);
						if (res.status == '1') {
							Swal.fire({
								icon: 'success',
								title: 'Success',
								text: res.message,
								timer: 2000, 
								showConfirmButton: true 
							}).then(function() {
								window.location.href = '{{ route('admin.dashboard') }}';
							});
						}else {
							Swal.fire({
								icon: 'error',
								title: 'Error',
								text: 'Invalid Credential.'
							}).then(function() {
								 
							});
						}
					},
					error: function(error) {
						var email = document.getElementById("email").value;
						var password = document.getElementById("password").value;
						if (email == '') {
							$('#emailErr').text(error.responseJSON.errors.email);
						} else {
							$('#emailErr').text('');
						}
						if (password == '') {
							$('#passwordErr').text(error.responseJSON.errors.password);
						} else {
							$('#passwordErr').text('');
						}
					}
				});
				return false;
			}
		</script>
	</body>
</html>