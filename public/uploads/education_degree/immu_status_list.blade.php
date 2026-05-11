@extends('admin.layouts.layout')
@section('content')
<x-card-component parentHeading="Vaccination Management" childHeading="Immunization Status List" parentUrl="{{route('admin.dashboard')}}" />
<div class="card w-100  overflow-hidden ">
    <div class="card-header pb-0 p-4">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5 class="card-title fw-semibold mb-0">Immunization Status List</h5>
            </div>
            <div>
                <a href="" data-bs-toggle="modal" data-bs-target="#add_immu_status" class="btn btn-primary text-nowrap">Add Immunization Status</a>
            </div>
        </div>
    </div>
    <div class="card-body p-3 px-md-4">

        <div class="table-responsive rounded-2 mb-4">
            <table class="table border table-striped table-bordered text-nowrap">
                <thead class="text-dark fs-4">
                    <tr>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Sn.</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Immunization Status</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold ">Action</h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                    @if ($immstatusData)
                    @foreach ($immstatusData as $key => $item)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>
                            <div class="">
                                <span class="mb-0 fw-normal fs-3">{{ $item->name }}</span>
                            </div>
                        </td>

                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <button href="javascript:void(0)" class="btn btn-success" onclick="return getImmStatus({{ $item->id }})">
                                    Edit
                                </button>
                                <button type="button" onclick="return deleteImmStatus({{ $item->id }})"
                                    class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top"
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
<div class="modal fade" id="add_immu_status" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="addImmstatus" onsubmit="return addImmstatus()">
                @csrf
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myModalLabel">Add Immunization Status</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category">Immunization Status</label>
                        <input type="text" class="form-control" placeholder="Write Immunization Status name" name="immu_status"
                            id="evidence">
                        <span id="immustatusErr" class="text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer pt-0">
                    <button type="submit" class="btn btn-primary font-medium waves-effect" id="signup_btn_btn">
                        Add
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="edit_Imm_status" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="EditImmStatus" onsubmit="return editImmStatus()">
                @csrf
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myModalLabel">Edit Immunization Status</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category">Immunization Status</label>
                        <input type="hidden" name="id" value="" id="imm_status_id" />
                        <input type="text" class="form-control" placeholder="Write immunization status name" name="immu_status"
                            id="edit_imm_stat">
                        <span id="edit_immstatusErr" class="text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer pt-0">
                    <button type="submit" class="btn btn-primary font-medium waves-effect" id="edit_signup_btn_btn">
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
    function addImmstatus() {
        $.ajax({
            url: "{{ route('admin.addImmStatus') }}",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('#addImmstatus')[0]),
            dataType: 'json',
            beforeSend: function() {
                $('#signup_btn_btn').prop('disabled', true);
                $('#signup_btn_btn').text('Process....');
            },
            success: function(res) {
                $('#signup_btn_btn').prop('disabled', false);
                $('#signup_btn_btn').text('Add');
                if (res.status == '2') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                    }).then(function() {
                        window.location.href = '{{ route("admin.imStatusList") }}';
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
                console.log()
                $('#signup_btn_btn').prop('disabled', false);
                $('#signup_btn_btn').text('Add');
                if (error.responseJSON.errors) {
                    if (error.responseJSON.errors.immu_status) {
                        $('#immustatusErr').text(error.responseJSON.errors.immu_status[0]);
                    } else {
                        $('#immustatusErr').text('');
                    }
                }
            }
        });
        return false;
    }

    function editImmStatus() {
        $.ajax({
            url: "{{ route('admin.updateImmStatus') }}",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('#EditImmStatus')[0]),
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
                        window.location.href = '{{ route("admin.imStatusList") }}';
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
                    if (error.responseJSON.errors.immu_status) {
                        $('#edit_immstatusErr').text(error.responseJSON.errors.immu_status[0]);
                    } else {
                        $('#edit_immstatusErr').text('');
                    }
                }

            }
        });
        return false;
    }

    function deleteImmStatus(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to delete Immunization Status ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.deleteImmStatus') }}",
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
    $(document).ready(function() {
        window.getImmStatus = function(id) {
            $.ajax({
                url: "{{ route('admin.getImmStatus') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    $('#edit_imm_stat').val(res.name);
                    $('#imm_status_id').val(res.id);
                    $('#edit_Imm_status').modal('show');
                },
                error: function(error) {
                    console.log("error-", error);
                }
            });
        }

        // Example call to the function
        // getTraining(1); // Pass the appropriate ID here
    });
</script>
@endsection