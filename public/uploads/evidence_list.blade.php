@extends('admin.layouts.layout')
@section('content')
<x-card-component parentHeading="Vaccination Management" childHeading="Evidence List" parentUrl="{{route('admin.dashboard')}}" />
<div class="card w-100  overflow-hidden ">
    <div class="card-header pb-0 p-4">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5 class="card-title fw-semibold mb-0">Evidence List</h5>
            </div>
            <div>
                <a href="" data-bs-toggle="modal" data-bs-target="#add_Evidence" class="btn btn-primary text-nowrap">Add Evidence </a>
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
                            <h6 class="fs-4 fw-semibold mb-0">Evidence</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold ">Action</h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                    @if ($eviData)
                    @foreach ($eviData as $key => $item)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>
                            <div class="">
                                <span class="mb-0 fw-normal fs-3">{{ $item->name }}</span>
                            </div>
                        </td>

                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <button href="javascript:void(0)" class="btn btn-success" onclick="return getEvidence({{ $item->id }})">
                                    Edit
                                </button>
                                <button type="button" onclick="return deleteEvidence({{ $item->id }})"
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
<div class="modal fade" id="add_Evidence" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="AddEvidence" onsubmit="return addEvidence()">
                @csrf
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myModalLabel">Add Evidence</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category">Evidence</label>
                        <input type="text" class="form-control" placeholder="Write evidence name" name="evidence"
                            id="evidence">
                        <span id="evidenceErr" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="category">Evidence Type</label>
                        <select class="form-control" name="type" id="exampleSelect">
                            <?php
                            $vacc_data = DB::table("vaccination")->get();
                            ?>
                            <option value="">Select Evidence type</option>
                            @foreach($vacc_data as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        <span id="evitypeErr" class="text-danger"></span>
                    </div>
                    <div class="form-group" style="display:none" id="covid_dose">
                        <label for="category">Dose</label>
                        <select class="form-control" name="dose" id="dose_id">
                            <option value="1">dose-1</option>
                            <option value="2">dose-2</option>
                            <option value="3">dose-3</option>
                            <option value="4">dose-4</option>
                            <option value="5">dose-5</option>
                            <option value="6">dose-6</option>
                        </select>
                        <span id="dose_error" class="text-danger"></span>
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

<div class="modal fade" id="edit_Evidence" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="EditEvidence" onsubmit="return editEvidence()">
                @csrf
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myModalLabel">Edit Evidence</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category">Evidence</label>
                        <input type="hidden" name="id" value="" id="edit_evi_id" />
                        <input type="text" class="form-control" placeholder="Write evidence name" name="evidence"
                            id="edit_evi">
                        <span id="edit_EviErr" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="category">Evidence Type</label>
                        <select class="form-control" name="type" id="type_evi">
                            <?php
                            $vacc_data = DB::table("vaccination")->get();
                            ?>
                            <option value="">Select Evidence type</option>
                            @foreach($vacc_data as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        <span id="evitypeErr" class="text-danger"></span>
                    </div>
                    <div class="form-group" id="covid_dose_edit">
                        <label for="category">Dose</label>
                        <select class="form-control" name="dose" id="dose_id">
                            <option value="1">dose-1</option>
                            <option value="2">dose-2</option>
                            <option value="3">dose-3</option>
                            <option value="4">dose-4</option>
                            <option value="5">dose-5</option>
                            <option value="6">dose-6</option>
                        </select>
                        <span id="dose_error" class="text-danger"></span>
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
    function addEvidence() {
        $.ajax({
            url: "{{ route('admin.addEvidence') }}",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('#AddEvidence')[0]),
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
                        window.location.href = '{{ route("admin.EvidenceList") }}';
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
                    if (error.responseJSON.errors.evidence) {
                        $('#evidenceErr').text(error.responseJSON.errors.evidence[0]);
                    } else {
                        $('#evidenceErr').text('');
                    }

                    if (error.responseJSON.errors.type) {
                        $('#evitypeErr').text(error.responseJSON.errors.type[0]);
                    } else {
                        $('#evitypeErr').text('');
                    }
                }
            }
        });
        return false;
    }

    function editEvidence() {
        $.ajax({
            url: "{{ route('admin.updateEvidence') }}",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('#EditEvidence')[0]),
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
                        window.location.href = '{{ route("admin.EvidenceList") }}';
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
                    if (error.responseJSON.errors.evidence) {
                        $('#edit_EviErr').text(error.responseJSON.errors.evidence[0]);
                    } else {
                        $('#edit_EviErr').text('');
                    }

                    if (error.responseJSON.errors.type) {
                        $('#evitypeErr').text(error.responseJSON.errors.type[0]);
                    } else {
                        $('#evitypeErr').text('');
                    }
                }
            }
        });
        return false;
    }

    function deleteEvidence(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to delete Evidence ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.deleteEvidence') }}",
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
        window.getEvidence = function(id) {
            $.ajax({
                url: "{{ route('admin.getEvidence') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#edit_evi').val(res.name);
                    $('#edit_evi_id').val(res.id);
                    $('#type_evi').val(res.type); // Corrected: Select the dropdown correctly
                    $('#type_evi').trigger('change');
                    // Handle dose logic
                    if (parseInt(res.type, 10) === 12) {
                        $("#covid_dose_edit").show(); // Show the Dose section if dose is 12
                        $('#dose_id').val(res.dose); // Pre-select dose if necessary
                    } else {
                        $("#covid_dose_edit").hide(); // Hide the Dose section otherwise
                    }
                    $('#edit_Evidence').modal('show');
                },
                error: function(error) {
                    console.log("error-", error);
                }
            });
        }

        // Example call to the function
        // getTraining(1); // Pass the appropriate ID here
    });

    $('#exampleSelect').on('change', function() {
        // Get the selected value
        let selectedValue = $(this).val();
        if (selectedValue == 12) {
            $("#covid_dose").show();
        } else {
            $("#covid_dose").none();
        }
    });
</script>
@endsection