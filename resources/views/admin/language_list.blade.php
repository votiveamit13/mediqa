@extends('admin.layouts.layout')
@section('content')
<x-card-component parentHeading="Language Skills Management" childHeading="Language List" parentUrl="{{route('admin.dashboard')}}" />
    <div class="card w-100  overflow-hidden ">
        <div class="card-header pb-0 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title fw-semibold mb-0">Language List</h5>
                </div>
                <div>
                    <a href="" data-bs-toggle="modal" data-bs-target="#add_country" class="btn btn-primary text-nowrap">Add
                        Languages</a>
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
                                <h6 class="fs-4 fw-semibold mb-0">Language Name</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold ">Action</h6>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @if ($languageData)
                            @foreach ($languageData as $key => $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        <div class="">
                                            <span class="mb-0 fw-normal fs-3">{{ $item->language_name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            @if($item->language_field == "dropdown")
                                            <a href="{{ route('admin.sub_language_list', ['id' => $item->language_id]) }}"
                                                class="btn btn-primary" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                title="View">
                                                View
                                            </a>
                                            @endif
                                            <button href="javascript:void(0)" class="btn btn-success"  onclick="return getCountry({{ $item->language_id }})">
                                                Edit
                                            </button>
                                            <button type="button" onclick="return deleteCountry({{ $item->language_id }})"
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
                        <h4 class="modal-title" id="myModalLabel">Add Languages </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Language Name</label>
                            
                            <input type="hidden" name="sub_language_id" value="">
                            <input type="hidden" name="test_id" value="">
                            <input type="hidden" name="form_type" value="basic_form">
                            <input type="text" class="form-control" placeholder="Write Language Name" name="language_name"
                                id="language_name">
                            <span id="languageNameErr" class="text-danger"></span>
                        </div><br>
                        <div class="form-group">
                            <label for="language_field_type">Language Field Type</label>
                            
                            <select id="language_field_type" class="form-control" name="language_field_type">
                                <option value="">select</option>
                                <option value="text">Text</option>
                                <option value="dropdown">Dropdown</option>
                                
                            </select>
                            <span id="language_fieldErr" class="text-danger"></span>
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
                        <h4 class="modal-title" id="myModalLabel">Edit Languages </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Language Name</label>
                            <input type="hidden" name="id" value="" id="edit_id" />
                            <input type="hidden" name="form_type" value="basic_form">
                            <input type="text" class="form-control" placeholder="Write Language Name" name="language_name"
                                id="edit_language_name">
                            <span id="editlanguageNameErr" class="text-danger"></span>
                        </div><br>
                        <div class="form-group">
                            <label for="language_field_type">Language Field Type</label>
                            
                            <select id="edit_language_field_type" class="form-control" name="language_field_type">
                                <option value="">select</option>
                                <option value="text">Text</option>
                                <option value="dropdown">Dropdown</option>
                                
                            </select>
                            <span id="edit_language_fieldErr" class="text-danger"></span>
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
                url: "{{ route('admin.addLanguages') }}",
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
                            window.location.href = '{{ route("admin.language_list") }}';
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
                            $('#languageNameErr').text(error.responseJSON.errors.language_name[0]);
                            $('#language_fieldErr').text(error.responseJSON.errors.language_field_type[0]);
                        } else {
                            $('#languageNameErr').text('');
                            $('#language_fieldErr').text('');
                            
                        }
                        
                    }
                }
            });
            return false;
        }

        function editCountry() {
            
            $.ajax({
                url: "{{ route('admin.updateLanguages') }}",
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
                            window.location.href = '{{ route("admin.language_list") }}';
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
                text: 'Do you want to delete languages ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin.deleteLanguages') }}",
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
                url: "{{ route('admin.getLanguages') }}",
                type: "POST",
                data: {
                     id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    
                    $('#edit_language_name').val(res.language_name);
                    $('#edit_language_field_type').val(res.language_field);
                    $('#edit_id').val(res.language_id);
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
