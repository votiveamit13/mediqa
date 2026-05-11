@extends('admin.layouts.layout')
@section('css')
<style type="text/css">
    .modal-body.modal-body-custom {
        overflow-x: auto;
        overflow-y: auto;
        height: 500px;
    }
</style>
@endsection
@section('content')
<x-card-component parentHeading="Incoming Nurse List" childHeading="Incoming Nurse List" parentUrl="{{route('admin.dashboard')}}" />
    <div class="card w-100  overflow-hidden ">
        <div class="card-header pb-0 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title fw-semibold mb-0">Incoming Nurse List</h5>
                </div>
                <div>
                    <a href="{{ route('admin.add_nurse')}}"  class="btn btn-primary text-nowrap">Add
                        Nurse </a>
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
                                    <h6 class="fs-4 fw-semibold mb-0"> Full Name</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Profession</h6>
                                </th>
                            
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Practitioner Type</h6>
                                </th>
                            
                                {{-- <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Phone</h6>
                                </th> --}}
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Email</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Registered Country</h6>
                                </th>
                                <th class="fs-4 fw-semibold mb-0">Date</th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0 text-end">Action</h6>
                                </th>

                        </tr>
                    </thead>
                    <tbody>
                         @php $i=1 @endphp
                            @if ($incomingNurseUsers)
                                @foreach ($incomingNurseUsers as $key => $item)
                                     <td>{{ $i }}</td>
                                        
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">{{  ucwords($item->name) }} {{  ucwords($item->lastname) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3"> - - - </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3"> - - - </span>
                                            </div>
                                        </td>
                                        {{-- <td>
                                            <div class="">
                                                @if($item->phone)
                                                <span class="mb-0 fw-normal fs-3">+{{ isset($item->country_code) ? $item->country_code : ''}} {{ $item->phone }}</span>
                                                @endif
                                            </div>
                                        </td> --}}
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">{{ $item->email }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <button 
                                                    class="btn btn-primary w-100"
                                                    onclick="viewRegisteredCountries({{ $item->id }})">
                                                    View
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</span>
                                            </div>
                                        </td>
                                        <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <a href="{{ route('admin.view-profile', ['id' => $item->id]) }}"
                                                class="btn btn-primary" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                title="View">
                                                View
                                            </a>
                                            <a href="{{ route('admin.edit_nurse', ['id' => $item->id]) }}"
                                                class="btn btn-primary" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                title="View">
                                                Edit
                                            </a>
                                            {{-- <button type="button" class="btn btn-success "
                                                onclick="changeStatus({{ $item->id }},'2')">Approve
                                            </button> --}}
                                            <button type="button" class="btn btn-danger "
                                                onclick="changeStatus({{ $item->id }},'0')">Reject
                                            </button>
                                            <button type="button" class="btn btn-success"
                                                onclick="sendRemainder('{{ $item->name }}','{{ $item->lastname }}','{{ $item->email }}')">Send reminder
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
    <div class="modal fade" id="add_Skill" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="AddSkill"  onsubmit="return addSkill()">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="myModalLabel">Add Skill </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Skill </label>
                            <input type="text" class="form-control" placeholder="Write Speciality" name="skill"
                                id="skill">
                            <span id="skillErr" class="text-danger"></span>
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
    
    <div class="modal fade" id="edit_Skill" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="EditSkill"  onsubmit="return editSkill()">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="myModalLabel">Edit Skill </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Skill </label>
                            <input type="hidden" name="id" value="" id="edit_id" />
                            <input type="text" class="form-control" placeholder="Write Speciality" name="skill"
                                id="edit_skill">
                            <span id="edit_skillErr" class="text-danger"></span>
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
    
    {{-- registered country modal  --}}
        <div class="modal fade" id="registeredCountryModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registered Countries</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body modal-body-custom">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Country of Registration</th>
                                    <th>Mobile Number</th>
                                    <th>Jurisdiction / Registration Authority</th>
                                    <th>License / Registration Number</th>
                                    <th>Expiry Date</th>
                                    <th>Evidence</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="registeredCountryBody">
                                <tr>
                                    <td colspan="6" class="text-center">Loading...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        function changeStatus(id, status) {
            let reasonData = '';
            let swalText = (status == 2 ? "you want to Approve the Nurse" : "You want to Reject The Nurse") + ' ?';
            Swal.fire({
                title: 'Are you sure?',
                text: swalText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (status == 0) {
                        Swal.fire({
                            title: 'Provide a reason',
                            input: 'text',
                            inputLabel: 'Reason for rejection',
                            inputPlaceholder: 'Enter your reason here...',
                            inputValidator: (value) => {
                                if (!value) {
                                    return 'You must provide a reason for rejection.';
                                }
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                reasonData = result.value;
                                sendData(id, status, reasonData);
                            }
                        });
                    } else {
                        sendData(id, status, reasonData);
                    }
                }
            });
        }

         function sendRemainder(fname,lastname,email){
            
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.send_remainder') }}",
                data: {
                    name: fname+" "+lastname,
                    email:email,
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
                    console.log(error);
                }
            });
            return false;
        }

        function sendData(id, status, reasonData) {
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.change-status') }}",
                data: {
                    reasonData: reasonData,
                    id: id,
                    status: status,
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
                    console.log(error);
                }
            });
            return false;
        }
        
                function viewRegisteredCountries(userId) {
            $('#registeredCountryBody').html(
                '<tr><td colspan="6" class="text-center">Loading...</td></tr>'
            );

            $.ajax({
                url: "{{ route('admin.get-registered-countries') }}",
                type: "POST",
                data: {
                    user_id: userId,
                    _token: "{{ csrf_token() }}"
                },
                success: function (res) {
                    console.log(res);
                    let html = '';

                    if (res.data.length === 0) {
                        html = '<tr><td colspan="6" class="text-center">No Data Found</td></tr>';
                    } else {
                        res.data.forEach(item => {
                            let disableDropdown = [1, 2, 7].includes(item.status);

                            html += `
                            <tr>
                                <td>${item.country_name ?? '-'}</td>
                                <td>${item.mobile_number ?? '-'}</td>
                                <td>${item.registration_authority_name ?? '-'}</td>
                                <td>${item.registration_number ?? '-'}</td>
                                <td>${item.expiry_date ?? '-'}</td>
                                <td>
                                    ${
                                        item.upload_evidence
                                        ? JSON.parse(item.upload_evidence).map((file, index) => {
                                            return `
                                                <a 
                                                    href="{{ asset('/uploads/registration') }}/${file}" 
                                                    target="_blank" 
                                                    class="d-block fw-semibold">
                                                    View File ${index + 1}
                                                </a>
                                            `;
                                        }).join('')
                                        : '-'
                                    }
                                </td>
                                <td class="w-100">
                                    <select class="form-select"
                                        ${disableDropdown ? 'disabled' : ''}
                                        onchange="updateCountryStatus(${item.id}, this.value)">
                                        <option value="4" ${item.status == 3 ? 'selected' : ''} disabled>Submitted</option>
                                        <option value="4" ${item.status == 4 ? 'selected' : ''}>Review</option>
                                        <option value="5" ${item.status == 5 ? 'selected' : ''}>Approve</option>
                                        <option value="6" ${item.status == 6 ? 'selected' : ''}>Reject</option>
                                        <option value="7" ${item.status == 7 ? 'selected' : ''} disabled>Expired</option>
                                    </select>
                                </td>
                            </tr>
                            `;

                        });
                    }

                    $('#registeredCountryBody').html(html);
                    $('#registeredCountryModal').modal('show');
                }
            });
        }

        function updateCountryStatus(id, status) {
            $.ajax({
                url: "{{ route('admin.update-registered-country-status') }}",
                type: "POST",
                data: {
                    id: id,
                    status: status,
                    _token: "{{ csrf_token() }}"
                },
                success: function (res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated',
                        text: res.message
                    });
                }
            });
        }

    </script>
@endsection