@extends('admin.layouts.layout')
@section('content')
<style>
.ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable, .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
height: 19rem;
}
</style>
<x-card-component parentHeading="Seo Management" childHeading="Page List" parentUrl="{{route('admin.dashboard')}}" />
    <div class="card w-100  overflow-hidden ">
        <div class="card-header pb-0 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title fw-semibold mb-0">Page List</h5>
                </div>
                <div>
                    <a href="" data-bs-toggle="modal" data-bs-target="#add_seo" class="btn btn-primary text-nowrap">Add
                        page </a>
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
                                <h6 class="fs-4 fw-semibold mb-0"> Meta Title</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold ">Action</h6>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @if ($SeoData)
                            @foreach ($SeoData as $key => $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        <div class="">
                                            <span class="mb-0 fw-normal fs-3">{{ $item->meta_title }}</span>
                                        </div>
                                    </td>
                                    <td>
                                         <button class="btn {{ $item->status === 0 ? 'btn-success' : 'btn-danger' }}">
                                            {{ $item->status === 0 ? 'Active' : 'Inactive' }}
                                        </button>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <button href="javascript:void(0)" class="btn btn-success"  onclick="return getSeo({{ $item->id }})">
                                                Edit
                                            </button>
                                            <button type="button" onclick="return deleteSeo({{ $item->id }})"
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
    <div class="modal fade" id="add_seo" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="AddSeo" onsubmit="return addSeo()" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="myModalLabel">Add Page</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-4">
                            <label for="category">Meta Title</label>
                            <input type="text" class="form-control" placeholder="Please Meta title" name="meta_title" id="meta_title">
                            <span id="meta_title_error" class="text-danger"></span>
                        </div>
                        <div class="form-group mb-4">
                            <label for="category">Meta Description</label>
                            <textarea class="form-control" placeholder="Please Meta Description" name="meta_desc" id="editor"  style="height: 19rem!important;"></textarea>
                            <span id="meta_desc_error" class="text-danger"></span>
                        </div>
                        <div class="form-group mb-4">
                            <label for="category">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="">Select Status</option>
                                <option value="0">Active</option>
                                <option value="1">Inactive</option>
                            </select>
                            <span id="status_error" class="text-danger"></span>
                        </div>
                        <div class="form-group mb-4">
                            <label for="image">Image</label>
                            
                            <input type="file" class="form-control" name="image" id="image" accept="image/*">
                            <span id="image_error" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="modal-footer pt-0">
                        <button type="submit" class="btn btn-primary font-medium waves-effect" id="signup_btn_btn">
                            Add 
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="editSeo" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                     <form id="edit_Seo"  onsubmit="return EditSeo()">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="myModalLabel">Add Page</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         <input type="hidden" name="id" value="" id="edit_id" />
                        <div class="form-group mb-4">
                            <label for="category">Meta Title</label>
                            <input type="text" class="form-control" placeholder="Please Meta title" name="meta_title" id="meta_title1">
                            <span id="meta_title_error1" class="text-danger"></span>
                        </div>
                        <div class="form-group mb-4">
                            <label for="category">Meta Description</label>
                            <textarea class="form-control" placeholder="Please Meta Description" name="meta_desc" id="editor1"  style="height: 19rem!important;"></textarea>
                            <span id="meta_desc_error1" class="text-danger"></span>
                        </div>
                        <div class="form-group mb-4">
                            <label for="category">Status</label>
                            <select class="form-control" name="status" id="status1">
                                <option value="">Select Status</option>
                                <option value="0">Active</option>
                                <option value="1">Inactive</option>
                            </select>
                            <span id="status_error1" class="text-danger"></span>
                        </div>
                        <div class="form-group mb-4">
                            <label for="image">Image</label>
                            
                            <input type="file" class="form-control" name="image" id="image1" accept="image/*">
                            <span id="image_error1" class="text-danger"></span>
                        </div>
                        <div>
                            <img alt=""  id="feature_image" style="object-fit:cover;border-radius: 16px;display: block;width: 85px;height: 85px;" src=""> 
                        </div>

                    </div>
                    <div class="modal-footer pt-0">
                        <button type="submit" class="btn btn-primary font-medium waves-effect" id="edit_signup_btn_btn">
                            Add 
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script>
    // Ensure the editor is loaded after the page content
    window.onload = () => {
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log('Editor was initialized', editor);
            })
            .catch(error => {
                console.error('There was a problem initializing the editor.', error);
            });
    };
   </script>
   <script>

    // Store the editor instance in a global variable
    let editorInstance;

    window.onload = () => {
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor => {
                console.log('Editor was initialized', editor);
                editorInstance = editor; // Store the editor instance for later use
            })
            .catch(error => {
                console.error('There was a problem initializing the editor.', error);
            });
    };
   </script>
   <script>
    function addSeo() {
        var formData = new FormData($('#AddSeo')[0]);
            $.ajax({
                url: "{{ route('admin.addSeo') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
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
                            window.location.href = '{{ route("admin.SeoList") }}';
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
                        if (error.responseJSON.errors.meta_title) {
                            $('#meta_title_error').text(error.responseJSON.errors.meta_title [0]);
                           
                        } else {
                            $('#meta_title_error').text('');
                        }

                        if (error.responseJSON.errors.meta_desc) {
                            $('#meta_desc_error').text(error.responseJSON.errors.meta_desc[0]);
                           
                        } else {
                            $('#meta_desc_error').text('');
                        }

                        if (error.responseJSON.errors.status) {
                            $('#status_error').text(error.responseJSON.errors.status[0]);
                           
                        } else {
                            $('#status_error').text('');
                        }

                        if (error.responseJSON.errors.image) {
                            $('#image_error').text(error.responseJSON.errors.image[0]);
                           
                        } else {
                            $('#image_error').text('');
                        }
                        
                    }
                }
            });
            return false;
        }
    

        function EditSeo() {
            $.ajax({
                url: "{{ route('admin.updateSeo') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData($('#edit_Seo')[0]),
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
                            window.location.href = '{{ route('admin.SeoList') }}';
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
                        if (error.responseJSON.errors.meta_title) {
                            $('#meta_title_error').text(error.responseJSON.errors.meta_title [0]);
                           
                        } else {
                            $('#meta_title_error').text('');
                        }

                        if (error.responseJSON.errors.meta_desc) {
                            $('#meta_desc_error').text(error.responseJSON.errors.meta_desc[0]);
                           
                        } else {
                            $('#meta_desc_error').text('');
                        }

                        if (error.responseJSON.errors.status) {
                            $('#status_error').text(error.responseJSON.errors.status[0]);
                           
                        } else {
                            $('#status_error').text('');
                        }

                        // if (error.responseJSON.errors.image) {
                        //     $('#image_error').text(error.responseJSON.errors.image[0]);
                           
                        // } else {
                        //     $('#image_error').text('');
                        // }
                        
                    }
                   
                }
            });
            return false;
        }

        function deleteSeo(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to delete data ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin.deleteSeo') }}",
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

        function getSeo(id) {
            // Set a base URL variable using Laravel's url() helper
           const baseUrl = '{{ url('/') }}';
            $.ajax({
                url: "{{ route('admin.getSeo') }}",
                type: "POST",
                data: {
                     id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    $('#meta_title1').val(res.meta_title);
                    // $('#editor1').val(res.meta_des);
                   editorInstance.setData(res.meta_des);
                    $('#status1').val(res.status); // Ensure the correct dropdown ID is used
                    $('#feature_image').attr('src', baseUrl+ '/public'+res.image);
                    $('#edit_id').val(res.id);
                    $('#editSeo').modal('show');
                },
                error: function(error) {
                    console.log("errorr-", error);
                }
            });
            return false;
        }
     
    </script>
@endsection
