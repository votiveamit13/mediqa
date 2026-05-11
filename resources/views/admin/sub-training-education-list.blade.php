@extends('admin.layouts.layout')
@section('content')
@php
$nameSpeciality = str_replace("'", "", $mantraining->name);
@endphp
<div class="back_arrow" onclick="history.back()" title="Go Back">
    <i class="fa fa-arrow-left"></i>
</div>
<x-card-component parentHeading="Mandatory Training and Education Subtype ({{$nameSpeciality}})" childHeading="Mandatory Training and Education Subtype" parentUrl="{{route('admin.dashboard')}}" />
    <div class="card w-100  overflow-hidden ">
        <div class="card-header pb-0 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title fw-semibold mb-0">Mandatory Training and Education Subtype List</h5>
                </div>
                <div>
                    <a href="" data-bs-toggle="modal" data-bs-target="#add_Submantraining" class="btn btn-primary text-nowrap btn-sm">Add
                    Sub Training and Education Type </a>
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
                            <!-- <th>
                                <h6 class="fs-4 fw-semibold mb-0">Job Specialities </h6>
                            </th> -->
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
                        @if ($submantrainingData)
                            @foreach ($submantrainingData as $key => $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <!-- <td>
                                        <div class="">
                                            <span class="mb-0 fw-normal fs-3">{{ isset($item->prentSpecialityName) && isset($item->prentSpecialityName->name) ? $item->prentSpecialityName->name : ''}}</span>
                                        </div>
                                    </td> -->
                                    <td>
                                        <div class="">
                                            <span class="mb-0 fw-normal fs-3">{{ $item->name}}</span>
                                            @if($item->is_featured == 1) <span class="badge bg-success"> Trending</span> @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <button href="javascript:void(0)" class="btn btn-success btn-sm"  onclick="return getSubMantraining({{ $item->id }})">
                                                Edit
                                            </button>
                                            <button type="button" onclick="return deleteSubmantraining({{ $item->id }})"
                                                class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                                aria-label="Delete" data-bs-original-title="Delete">
                                                Delete
                                            </button>   
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
    <div class="modal fade" id="add_Submantraining" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="AddSubmantraining" onsubmit="return addSubmantraining()">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="myModalLabel">Add sub  training or education</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Training or Education Type</label>
                            <select class="form-control" placeholder="Write Profession" name="speciality"
                                id="speciality" disabled>
                                @if($mantrainingData)
                                @foreach ($mantrainingData as  $speData)
                                <option value="{{$speData->id}}" {{ $mantraining->id == $speData->id ? 'selected' : '' }}>{{$speData->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
        
                        <div class="form-group mt-3">
                            <label for="category">Training or Education SubType</label>
                            <input type="text" class="form-control" placeholder="Write Sub Training or Education" name="subtrainingeducation"
                                id="submantraining">
                            <span id="submantrainingErr" class="text-danger"></span>
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
                                Trending
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

    <div class="modal fade" id="edit_Submantraining_model" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="EditSubmantraining" onsubmit="return editSubmantraining()">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="myModalLabel">Edit Training or Education Type</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Training or Education Type</label>
                            <select class="form-control" placeholder="Write Specialities" name="speciality"
                                id="edit_speciality" disabled>
                                @if($mantrainingData)
                                @foreach ($mantrainingData as  $speData)
                                <option value="{{$speData->id}}">{{$speData->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
        
                        <div class="form-group mt-3">
                            <label for="category">Training or Education Sub Type</label>
                            <input type="text" class="form-control" placeholder="Write training or Education Sub Type" name="subtrainingeducation"
                                id="edit_sub_man_tra">
                            <input type="hidden" name="id" value="" id="edit_id" />
                            <span id="tra_edu_Err" class="text-danger"></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="category">Type</label>
                            <select class="form-control" name="type" id="type_val">
                                <option value="">Select type</option>
                                <option value="Training">Training</option>
                                <option value="Education">Education</option>
                                <!-- Add more options as needed -->
                            </select>
                            <span id="TypeErr" class="text-danger"></span>
                        </div>
                          <!-- Trending Checkbox -->
                          <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" value="1" id="edit_trendingCheckbox" name="trending">
                            <label class="form-check-label" for="trendingCheckbox">
                                Trending
                            </label>
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
        function addSubmantraining() {
            document.getElementById('speciality').removeAttribute('disabled');
            $.ajax({
                url: "{{ route('admin.addSubMantraining') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData($('#AddSubmantraining')[0]),
                dataType: 'json',
                beforeSend: function() {
                    $('#signup_btn_btn').prop('disabled', true);
                    $('#signup_btn_btn').text('Process....');
                },
                success: function(res) {
                    document.getElementById('speciality').setAttribute('disabled', 'disabled');
                    $('#signup_btn_btn').prop('disabled', false);
                    $('#signup_btn_btn').text('Add ');
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
                        })
                    }
                },
                error: function(error) {
                    $('#signup_btn_btn').prop('disabled', false);
                    $('#signup_btn_btn').text('Add');
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.subtrainingeducation) {
                            $('#submantrainingErr').text(error.responseJSON.errors.subtrainingeducation[0]);
                        } else {
                            $('#submantrainingErr').text('');
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

        function editSubmantraining() {
            document.getElementById('edit_speciality').removeAttribute('disabled');
            $.ajax({
                url: "{{ route('admin.updateSubMantraining') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData($('#EditSubmantraining')[0]),
                dataType: 'json',
                beforeSend: function() {
                    $('#edit_signup_btn_btn').prop('disabled', true);
                    $('#edit_signup_btn_btn').text('Process....');
                },
                success: function(res) {
                    document.getElementById('edit_speciality').setAttribute('disabled', 'disabled');
                    $('#edit_signup_btn_btn').prop('disabled', false);
                    $('#edit_signup_btn_btn').text('Update ');
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
                        })
                    }
                },
                error: function(error) {
                    $('#edit_signup_btn_btn').prop('disabled', false);
                    $('#edit_signup_btn_btn').text('Update');

                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.subtrainingeducation) {
                            $('#tra_edu_Err').text(error.responseJSON.errors.subtrainingeducation[0]);
                        } else {
                            $('#tra_edu_Err').text('');
                        }
                        
                    }
                   
                }
            });
            return false;
        }

        function deleteSubmantraining(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to delete Training and Eduction sub Type ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin.deleteSubMantraining') }}",
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

        function getSubMantraining(id) {
            $.ajax({
                url: "{{ route('admin.getSubMantraining') }}",
                type: "POST",
                data: {
                     id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    $('#edit_speciality').val(res.parent);
                    $('#edit_sub_man_tra').val(res.name);
                    $('#edit_trendingCheckbox').prop('checked', res.is_featured);
                    $('#edit_id').val(res.id);
                    $('#type_val').val(res.type);
                    $('#edit_Submantraining_model').modal('show');
                },
                error: function(error) {
                    console.log("errorr-", error);
                }
            });
            return false;
        }
     
    </script>
@endsection
