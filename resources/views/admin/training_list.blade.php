@extends('admin.layouts.layout')
@section('content')
<x-card-component parentHeading="Training Management" childHeading="Training List" parentUrl="{{route('admin.dashboard')}}" />
    <div class="card w-100  overflow-hidden ">
        <div class="card-header pb-0 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title fw-semibold mb-0">Training List</h5>
                </div>
                <div>
                    <a href="" data-bs-toggle="modal" data-bs-target="#add_Training" class="btn btn-primary text-nowrap">Add
                        Training </a>
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
                                <h6 class="fs-4 fw-semibold mb-0"> Training</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0"> Type</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold ">Action</h6>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @if ($trainingData)
                            @foreach ($trainingData as $key => $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        <div class="">
                                            <span class="mb-0 fw-normal fs-3">{{ $item->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="">
                                            <span class="mb-0 fw-normal fs-3">{{ $item->type }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <button href="javascript:void(0)" class="btn btn-success"  onclick="return getTraining({{ $item->id }})">
                                                Edit
                                            </button>
                                            <button type="button" onclick="return deleteTraining({{ $item->id }})"
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
    <div class="modal fade" id="add_Training" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="AddTraining"  onsubmit="return addTraining()">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="myModalLabel">Add Training </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Training</label>
                            <input type="text" class="form-control" placeholder="Write training name" name="training"
                                id="training ">
                            <span id="DegreeErr" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="category">Training Type</label>
                            <select class="form-control" name="type" id="type">
                                <option value="">Select training type</option>
                                <option value="Course">Course</option>
                                <option value="workshop">Workshop</option>
                                <!-- Add more options as needed -->
                            </select>
                            <span id="TypeErr" class="text-danger"></span>
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
    
    <div class="modal fade" id="edit_Training" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="EditTraining"  onsubmit="return editTraining()">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="myModalLabel">Edit Training </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Training </label>
                            <input type="hidden" name="id" value="" id="edit_id" />
                            <input type="text" class="form-control" placeholder="Write training name" name="training"
                                id="edit_training">
                            <span id="edit_DegreeErr" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="category">Training Type</label>
                            <select class="form-control" name="type" id="type_val">
                                <option value="">Select training type</option>
                                <option value="Course">Course</option>
                                <option value="workshop">Workshop</option>
                                <!-- Add more options as needed -->
                            </select>
                            <span id="TypeErr" class="text-danger"></span>
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
        function addTraining() {
            $.ajax({
                url: "{{ route('admin.addTraining') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData($('#AddTraining')[0]),
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
                            window.location.href = '{{ route("admin.TrainingList") }}';
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
                        if (error.responseJSON.errors.training) {
                            $('#DegreeErr').text(error.responseJSON.errors.training [0]);
                           
                        } else {
                            $('#DegreeErr').text('');
                        }

                        if (error.responseJSON.errors.type) {
                            $('#TypeErr').text(error.responseJSON.errors.type[0]);
                           
                        } else {
                            $('#TypeErr').text('');
                        }
                        
                    }
                }
            });
            return false;
        }

        function editTraining() {
            $.ajax({
                url: "{{ route('admin.updateTraining') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData($('#EditTraining')[0]),
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
                            window.location.href = '{{ route("admin.TrainingList") }}';
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
                        if (error.responseJSON.errors.training) {
                            $('#edit_DegreeErr').text(error.responseJSON.errors.training[0]);
                        } else {
                            $('#edit_DegreeErr').text('');
                        }

                        if (error.responseJSON.errors.type) {
                            $('#TypeErr').text(error.responseJSON.errors.type[0]);
                           
                        } else {
                            $('#TypeErr').text('');
                        }
                        
                    }
                   
                }
            });
            return false;
        }

        function deleteTraining(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to delete Degree ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin.deleteTraining') }}",
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
        window.getTraining = function(id) {
            $.ajax({
                url: "{{ route('admin.getTraining') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    console.log(res.type);
                    $('#edit_training').val(res.name);
                    $('#edit_id').val(res.id);
                    $('#type_val').val(res.type); // Ensure the correct dropdown ID is used
                    $('#edit_Training').modal('show');
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
