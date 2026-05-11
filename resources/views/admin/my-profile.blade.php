@extends('admin.layouts.layout')
@section('content')
 <x-card-component parentHeading="My Profile" childHeading="My Profile" parentUrl="{{route('admin.dashboard')}}" />
    <div class="d-flex gap-1">
        <div class="card w-50  overflow-hidden ">
            <div class="px-4 py-3 border-bottom">
                <h5 class="card-title fw-semibold mb-0 lh-sm">My Profile</h5>
            </div>

            <div class="card-body p-4">
                <div>
                    <form id="EditProfile" enctype='multipart/form-data'>
                        @csrf
                        <div class="tab-pane fade show active" id="pills-personal-info" role="tabpanel"
                            aria-labelledby="pills-personal-info-tab" tabindex="0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-4 row align-items-center">
                                        <label for="exampleInputPassword1"
                                            class="form-label fw-semibold col-sm-3 col-form-label">Name<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="John" value="{{ auth()->guard('admin')->user()->name }}">
                                            <span id="nameErr" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4 row align-items-center">
                                        <label for="exampleInputPassword1"
                                            class="form-label fw-semibold col-sm-3 col-form-label">Email<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="email" name="email"
                                                placeholder="Denial@gmail.com"
                                                value="{{ auth()->guard('admin')->user()->email }}" readonly>
                                            <span id="emailErr" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4 row align-items-center">
                                        <label for="exampleInputPassword1"
                                            class="form-label fw-semibold col-sm-3 col-form-label">Image </label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" id="image" name="file_image"
                                                placeholder="" accept='image/*'>
                                            @if (auth()->guard('admin')->user()->image)
                                                <img class="mt-3"
                                                    src="{{ url('storage/app/public/' . auth()->guard('admin')->user()->image) }}"
                                                    alt="{{ auth()->guard('admin')->user()->name }}"
                                                    style="height: 100px;width:100px">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 justify-content-end">
                            <button type="button" id="signup_btn_btn" onclick="return Profile()"
                                class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card w-50  overflow-hidden ">
            <div class="px-4 py-3 border-bottom">
                <h5 class="card-title fw-semibold mb-0 lh-sm">Change Password</h5>
            </div>

            <div class="card-body p-4">
                <form method="post" onsubmit="return changePassword()" id="ChangePassword">
                    @csrf
                    <div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4 row align-items-center">
                                    <label for="exampleInputPassword1"
                                        class="form-label fw-semibold col-sm-3 col-form-label">Old Password<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="password" name="old_password" class="form-control" id="old_password"
                                            placeholder="*****">
                                        <span id="old_passwordErr" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <p id="old_pass" class="text-danger"></p>
                            <div class="col-lg-12">
                                <div class="mb-4 row align-items-center">
                                    <label for="exampleInputPassword1"
                                        class="form-label fw-semibold col-sm-3 col-form-label">New Password<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="******">
                                        <span id="passwordErr" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">

                                <div class="mb-4 row align-items-center">
                                    <label for="exampleInputPassword1"
                                        class="form-label fw-semibold col-sm-3 col-form-label">Confirm Password<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="password_confirmation" placeholder="******">
                                        <span id="password_confirmationErr" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex align-items-center gap-3 justify-content-end">
                            <button type="submit" id="signup_btn" class="btn btn-primary">Update</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function Profile() {
            $.ajax({
                url: "{{ route('admin.update-profile') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData($('#EditProfile')[0]),
                dataType: 'json',
                beforeSend: function() {
                    $('#signup_btn_btn').prop('disabled', true);
                    $('#signup_btn_btn').text('Process....');
                },
                success: function(res) {
                    $('#signup_btn_btn').prop('disabled', false);
                    $('#signup_btn_btn').text('Update');
                    if (res.status == '2') {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                        }).then(function() {
                            window.location.href = '{{ route('admin.my-profile') }}';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message,
                        })
                    }
                },
                error: function(error) {
                    $('#signup_btn_btn').prop('disabled', false);
                    $('#signup_btn_btn').text('Update');

                    var name = document.getElementById("name").value;
                    var email = document.getElementById("email").value;
                    if (name == '') {
                        $('#nameErr').text(error.responseJSON.errors.name);

                    } else {
                        $('#nameErr').text('');
                    }
                    if (email == '') {
                        $('#emailErr').text(error.responseJSON.errors.email);

                    } else {
                        $('#emailErr').text('');
                    }
                }
            });
            return false;
        }

        function changePassword() {
            $('#ChangePassword').find('.text-danger').hide();
            $.ajax({
                url: "{{ route('admin.change-password') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData($('#ChangePassword')[0]),
                dataType: 'json',
                beforeSend: function() {
                    $('#signup_btn').prop('disabled', true);
                    $('#signup_btn').text('Process...');
                },
                success: function(data) {
                    $('#signup_btn').prop('disabled', false);
                    $('#signup_btn').text('Update');
                    if (data.status == 2) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                        }).then(function() {
                            window.location.href = '{{ route('admin.my-profile') }}';
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                        });
                    }
                },
                error: function(eror) {
                    $('#signup_btn').prop('disabled', false);
                    $('#signup_btn').text('Update');
                    console.log(eror);
                    for (var err in eror.responseJSON.errors) {

                        $("#ChangePassword").find("[name='" + err + "']").after("<div  class='text-danger'>" +
                            eror.responseJSON.errors[err] + "</div>");
                    }
                }
            });
            return false;
        }
    </script>
@endsection
