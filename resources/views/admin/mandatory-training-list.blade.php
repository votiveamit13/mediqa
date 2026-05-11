@extends('admin.layouts.layout')
@section('content')
<x-card-component parentHeading="Mandatory Training and Education List" childHeading="Mandatory Training and Education List" parentUrl="{{route('admin.dashboard')}}" />
    <div class="card w-100  overflow-hidden ">
        <div class="card-header pb-0 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title fw-semibold mb-0">Mandatory Training and Education List</h5>
                </div>
                <div>
                    <a href="" data-bs-toggle="modal" data-bs-target="#add_Training" class="btn btn-primary text-nowrap btn-sm">Add
                       Training and education</a>
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
                                <h6 class="fs-4 fw-semibold mb-0">Training and Education Type</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold ">Action</h6>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @if(!blank($mantrainingData))
                            @foreach ($mantrainingData as $key => $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        <div class="">
                                            <span class="mb-0 fw-normal fs-3">{{ $item->name }}</span>
                                            @if($item->is_featured == 1) <span class="badge bg-success"> Trending</span> @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <button href="javascript:void(0)" class="btn btn-success btn-sm"  onclick="return getManTraining({{ $item->id }})">
                                                Edit
                                            </button>
                                            <button type="button" onclick="return deleteMantra({{ $item->id }})"
                                                class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                                aria-label="Delete" data-bs-original-title="Delete">
                                                Delete
                                            </button>
                                            <a href="{{route('admin.subManTrainingList', ['id'=>$item->id])}}" class="btn btn-secondary btn-sm" id="add_sub_speciality">
                                                View sub training and education type
                                            </a>
                                        </div>
                                    </td>
                                
                                    @php $i++ @endphp
                                </tr>

                                
                            @endforeach
                        @else
                           
                        @endif


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_Training" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="AddMantraining"  onsubmit="return addMantraining()">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="myModalLabel">Add Training and Education</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Training or Education </label>
                            <input type="text" class="form-control" placeholder="Write Training or Eduction" name="man_training"
                                id="speciality">
                            <span id="man_training_Err" class="text-danger"></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="category">Type</label>
                            <select class="form-control" name="type" id="type">
                                <option value="">Select type</option>
                                <option value="Training">Training</option>
                                <option value="Education">Education</option>
                                <!-- Add more options as needed -->
                            </select>
                            <span id="TypeErr" class="text-danger"></span>
                        </div>
                         <!-- Trending Checkbox -->
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" value="1" id="trendingCheckbox" name="trending">
                            <label class="form-check-label" for="trendingCheckbox">
                               Is Trending
                            </label>
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

    <div class="modal fade" id="edit_Man_tra_model" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="EditManTraining" onsubmit="return editManTran()">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="myModalLabel">Edit Training and Education </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Training Or Education </label>
                            <input type="hidden" name="id" value="" id="edit_id"/>
                            <input type="text" class="form-control" placeholder="Write Training Or Education" name="man_training"
                                id="edit_man_training">
                            <span id="man_training_Err" class="text-danger"></span>
                        </div>

                        <div class="form-group mt-3">
                            <label for="category">Type</label>
                            <select class="form-control" name="type" id="typevalue">
                                <option value="">Select type</option>
                                <option value="Training">Training</option>
                                <option value="Education">Education</option>
                                <!-- Add more options as needed -->
                            </select>
                            <span id="Type_edit_Err" class="text-danger"></span>
                        </div>

                        <!-- Trending Checkbox -->
                        <div class="form-check mt-3">
                        <div class="form-group">
                                <label class="form-group" for="trendingCheckbox">
                                    Trending
                                </label>
                                <input class="form-check-input " type="checkbox" value="1" id="edit_trendingCheckbox" name="trending">
                            </div>
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
        function addMantraining() {
            $.ajax({
                url: "{{ route('admin.addManTraining') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData($('#AddMantraining')[0]),
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
                            window.location.href = '{{ route('admin.traeductionList') }}';
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
                        if (error.responseJSON.errors.man_training) {
                            $('#man_training_Err').text(error.responseJSON.errors.man_training[0]);
                        } else {
                            $('#man_training_Err').text('');
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

        function editManTran() {
            $.ajax({
                url: "{{ route('admin.updateManTraining') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData($('#EditManTraining')[0]),
                dataType: 'json',
                beforeSend: function() {
                    $('#edit_signup_btn_btn').prop('disabled', true);
                    $('#edit_signup_btn_btn').text('Process....');
                },
                success: function(res) {
                    $('#edit_signup_btn_btn').prop('disabled', false);
                    $('#edit_signup_btn_btn').text('Add');
                    if (res.status == '2') {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                        }).then(function() {
                            window.location.href = '{{ route('admin.traeductionList') }}';
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
                        if (error.responseJSON.errors.man_training) {
                            $('#man_training_Err').text(error.responseJSON.errors.man_training[0]);
                        } else {
                            $('#man_training_Err').text('');
                        }

                        if (error.responseJSON.errors.type) {
                            $('#Type_edit_Err').text(error.responseJSON.errors.type[0]);
                        } else {
                            $('#Type_edit_Err').text('');
                        }
                        
                    }
                   
                }
            });
            return false;
        }

        function deleteMantra(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to delete This Training Or Education type?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin.deleteManTraining') }}",
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

        function getManTraining(id) {
           
            $.ajax({
                url: "{{ route('admin.getManTraining') }}",
                type: "POST",
                data: {
                     id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    $('#edit_man_training').val(res.name);
                    $('#edit_id').val(res.id);
                    $('#edit_trendingCheckbox').prop('checked', res.is_featured);
                    $('#edit_Man_tra_model').modal('show');
                    $('#typevalue').val(res.type);
                },
                error: function(error) {
                    console.log("errorr-", error);
                }
            });
            return false;
        }

     
    </script>
@endsection
