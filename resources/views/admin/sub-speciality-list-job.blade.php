@extends('admin.layouts.layout')
@section('content')
@php
$nameSpeciality = str_replace("'", "", $speciality->name);
@endphp
<div class="back_arrow" onclick="history.back()" title="Go Back">
    <i class="fa fa-arrow-left"></i>
</div>
<x-card-component parentHeading="Job Specialities Subtype({{$nameSpeciality}})" childHeading="Job Specialities Subtype  Management" parentUrl="{{route('admin.dashboard')}}" />
    <div class="card w-100  overflow-hidden ">
        <div class="card-header pb-0 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title fw-semibold mb-0">Sub Job Specialities List</h5>
                </div>
                <div>
                    <a href="" data-bs-toggle="modal" data-bs-target="#add_Subspeciality" class="btn btn-primary text-nowrap btn-sm">Add
                    Sub Job Specialities Type </a>
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
                                <h6 class="fs-4 fw-semibold mb-0"> Job Specialities Type</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold ">Action</h6>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @if ($subspecialityData)
                            @foreach ($subspecialityData as $key => $item)
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
                                            <button href="javascript:void(0)" class="btn btn-success btn-sm"  onclick="return getSubspeciality({{ $item->id }})">
                                                Edit
                                            </button>
                                            <button type="button" onclick="return deleteSubspeciality({{ $item->id }})"
                                                class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                                aria-label="Delete" data-bs-original-title="Delete">
                                                Delete
                                            </button>
                                            <a href="{{route('admin.SubsubjobSpecialitiesList', ['id'=>$item->id])}}" class="btn btn-secondary btn-sm" id="add_sub_speciality">
                                                View job specialities subtype
                                            </a>
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
    <div class="modal fade" id="add_Subspeciality" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="AddSubspeciality" onsubmit="return addSubspeciality()">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="myModalLabel">Add sub speciality Job </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Speciality  </label>
                            <select class="form-control" placeholder="Write Profession" name="speciality"
                                id="speciality" disabled>
                                @if($specialityData)
                                @foreach ($specialityData as  $speData)
                                <option value="{{$speData->id}}" {{ $speciality->id == $speData->id ? 'selected' : '' }}>{{$speData->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
        
                        <div class="form-group mt-3">
                            <label for="category">Sub Job Specialities </label>
                            <input type="text" class="form-control" placeholder="Write Sub Job Specialities" name="subspeciality"
                                id="subspeciality">
                            <span id="subspecialityErr" class="text-danger"></span>
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

    <div class="modal fade" id="edit_Subspeciality_model" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="EditSubspeciality" onsubmit="return editSubspeciality()">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="myModalLabel">Edit Specialities Job </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Specialities job  </label>
                            <select class="form-control" placeholder="Write Specialities" name="speciality"
                                id="edit_speciality" disabled>
                                @if($specialityData)
                                @foreach ($specialityData as  $speData)
                                <option value="{{$speData->id}}">{{$speData->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
        
                        <div class="form-group mt-3">
                            <label for="category">Sub Specialities Job </label>
                            <input type="text" class="form-control" placeholder="Write Practitioner Type" name="subspeciality"
                                id="edit_subspeciality">
                            <input type="hidden" name="id" value="" id="edit_id" />
                            <span id="edit_subspecialityErr" class="text-danger"></span>
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
        function addSubspeciality() {
            document.getElementById('speciality').removeAttribute('disabled');
            $.ajax({
                url: "{{ route('admin.addSubspecialityJob') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData($('#AddSubspeciality')[0]),
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
                        if (error.responseJSON.errors.subspeciality) {
                            $('#subspecialityErr').text(error.responseJSON.errors.subspeciality[0]);
                        } else {
                            $('#subspecialityErr').text('');
                        }
                        
                    }
                }
            });
            return false;
        }

        function editSubspeciality() {
            document.getElementById('edit_speciality').removeAttribute('disabled');
            $.ajax({
                url: "{{ route('admin.updateSubspecialityJob') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData($('#EditSubspeciality')[0]),
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
                        if (error.responseJSON.errors.subspeciality) {
                            $('#edit_subspecialityErr').text(error.responseJSON.errors.subspeciality[0]);
                        } else {
                            $('#edit_subspecialityErr').text('');
                        }
                        
                    }
                   
                }
            });
            return false;
        }

        function deleteSubspeciality(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to delete Specialities Job Type ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin.deleteNewSpeciality') }}",
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

        function getSubspeciality(id) {
            $.ajax({
                url: "{{ route('admin.getSubspecialityJob') }}",
                type: "POST",
                data: {
                     id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    $('#edit_speciality').val(res.parent);
                    $('#edit_subspeciality').val(res.name);
                    $('#edit_trendingCheckbox').prop('checked', res.is_featured);
                    $('#edit_id').val(res.id);
                    $('#edit_Subspeciality_model').modal('show');
                },
                error: function(error) {
                    console.log("errorr-", error);
                }
            });
            return false;
        }
     
    </script>
@endsection
