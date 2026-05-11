@extends('admin.layouts.layout')
@section('content')
<x-card-component parentHeading="Professional Membership Management" childHeading="Membership Type" parentUrl="{{route('admin.dashboard')}}" />
    <div class="card w-100  overflow-hidden ">
        <div class="card-header pb-0 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title fw-semibold mb-0">Membership Type List</h5>
                </div>
                <div>
                    <a href="" data-bs-toggle="modal" data-bs-target="#add_country" class="btn btn-primary text-nowrap">Add
                        Membership</a>
                </div>
            </div>
        </div>
        <div class="card-body p-3 px-md-4">

            <div class="table-responsive rounded-2 mb-4">
                <table  class="table border table-striped table-bordered text-nowrap">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Sn.</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Membership Name</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold ">Action</h6>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @if ($membershipData)
                            @foreach ($membershipData as $key => $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        <div class="">
                                            <span class="mb-0 fw-normal fs-3">{{ $item->membership_name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            
                                            <a href="{{ route('admin.submembershipType', ['id' => $item->membership_id]) }}"
                                                class="btn btn-primary" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                title="View">
                                                View
                                            </a>
                                            <button href="javascript:void(0)" class="btn btn-success"  onclick="return getCountry({{ $item->membership_id }})">
                                                Edit
                                            </button>
                                            <button type="button" onclick="return deleteCountry({{ $item->membership_id }})"
                                                class="btn btn-danger " data-bs-toggle="tooltip" data-bs-placement="top"
                                                aria-label="Delete" data-bs-original-title="Delete">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                
                                    @php $i++ @endphp
                                </tr>

                                
                            @endforeach
                        @else
                            {{ 'No Data Found' }}
                        @endif


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_country" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="AddCountry"  onsubmit="return addCountry()">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="myModalLabel">Add Membership Type </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Membership Type </label>
                            
                            <input type="hidden" name="sub_membershiptype" value="0">
                            <input type="text" class="form-control" placeholder="Write membership type" name="membership_type"
                                id="membership_type">
                            <span id="membership_typeErr" class="text-danger"></span>
                        </div>
                        
                    </div>
                    <div class="modal-footer pt-0">
                        <button type="submit" class="btn btn-primary font-medium waves-effect" id="signup_btn_btn"
                            >
                            Add 
                        </button>
                    </div>
                </form>
            </div>

            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    <div class="modal fade" id="edit_membership_type" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="EditMembership"  onsubmit="return editCountry()">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="myModalLabel">Edit Membership Type </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Membership Type </label>
                            <input type="hidden" name="id" value="" id="edit_id" />
                            <input type="text" class="form-control" placeholder="Write Membership Type" name="membership_type"
                                id="membership_type_edit">
                            <span id="editmembership_typeErr" class="text-danger"></span>
                        </div>
                        
                    </div>
                    <div class="modal-footer pt-0">
                        <button type="submit" class="btn btn-primary font-medium waves-effect" id="edit_signup_btn_btn"
                           >
                            Add 
                        </button>
                    </div>
                </form>
            </div>

            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function addCountry() {
            
            $.ajax({
                url: "{{ route('admin.addMembershipType') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData($('#AddCountry')[0]),
                dataType: 'json',
                beforeSend: function() {
                    $('#signup_btn_btn').prop('disabled', true);
                    $('#signup_btn_btn').text('Process....');
                },
                success: function(res) {
                    $('#signup_btn_btn').prop('disabled', false);
                    $('#signup_btn_btn').text('Add ');
                    if (res.status == '2') {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                        }).then(function() {
                            window.location.href = '{{ route("admin.membershipType") }}';
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
                    $('#signup_btn_btn').text('Add');
                    if (error.responseJSON.errors) {
                        console.log("errors",error.responseJSON.errors);
                        if (error.responseJSON.errors) {
                            $('#membership_typeErr').text(error.responseJSON.errors.membership_type[0]);
                            
                        } else {
                            $('#membership_typeErr').text('');
                            
                        }
                        
                    }
                }
            });
            return false;
        }

        function editCountry() {
            
            $.ajax({
                url: "{{ route('admin.updateMembership') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData($('#EditMembership')[0]),
                dataType: 'json',
                beforeSend: function() {
                    $('#edit_signup_btn_btn').prop('disabled', true);
                    $('#edit_signup_btn_btn').text('Process....');
                },
                success: function(res) {
                    $('#edit_signup_btn_btn').prop('disabled', false);
                    $('#edit_signup_btn_btn').text('Add ');
                    if (res.status == '2') {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                        }).then(function() {
                            window.location.href = '{{ route("admin.membershipType") }}';
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
                    $('#edit_signup_btn_btn').prop('disabled', false);
                    $('#edit_signup_btn_btn').text('Add');

                    if (error.responseJSON.errors) {
                        console.log("errors",error.responseJSON.errors);
                        if (error.responseJSON.errors) {
                            $('#editmembership_typeErr').text(error.responseJSON.errors.membership_type[0]);
                            
                        } else {
                            $('#editmembership_typeErr').text('');
                            
                        }
                        
                    }
                   
                }
            });
            return false;
        }

        function deleteCountry(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to delete Membership ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin.deleteMembership') }}",
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(res) {
                            console.log(res);
                            if (res.status == '2') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: res.message,
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: res.message,
                                });
                            }
                        },
                        error: function(error) {
                            console.log(error); // Handle error response
                            // swal
                        }
                    });
                    return false;
                } else {
                    console.log("you press no button");
                }
            });

        }

        function getCountry(id) {
            
            $.ajax({
                url: "{{ route('admin.getMembership') }}",
                type: "POST",
                data: {
                     id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    console.log("res",res.organization_country);
                    $('#membership_type_edit').val(res.membership_name);
                    $('#edit_id').val(res.membership_id);
                    $('#edit_membership_type').modal('show');
                },
                error: function(error) {
                    console.log("errorr-", error);
                }
            });
            return false;
        }
     
    </script>
@endsection
