@extends('admin.layouts.layout')
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8"> Profession Verification List</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted " href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Verification Management</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                       <div class="text-center mb-n5">
                            <img src="{{ asset('admin/dist/images/breadcrumb/ChatBc.png') }}" alt=""
                                class="img-fluid" style="height: 125px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card w-100  overflow-hidden ">
            <div class="card-body p-3 px-md-4">

                <div class="table-responsive rounded-2 mb-4">
                    <table class="table border table-striped table-bordered text-nowrap" id="dataTable">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Sn.</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Full Name</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Profession</h6>
                                </th>
                            
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Practitioner Type</h6>
                                </th>
                            
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Year Level</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Evidence Type</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Evidence Of Year Level</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0 text-end">Action</h6>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1 @endphp
                            @if (!blank($incommingVerificationData))
                                @foreach ($incommingVerificationData as $key => $item)
                                     <td>{{ $i }}</td>
                                     <td>
                                        <div class="">
                                            <span class="mb-0 fw-normal fs-3"><a href="{{route('admin.view-profile',['id' => $item->user_id])}}" target="_blank">{{getUserNameById($item->user_id)}}</a></span>
                                        </div>
                                     </td>
                                        
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">{{ specialty_name_by_id($item->profession) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">{{ specialty_name_by_id($item->practitioner_type) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">{{ getLevelYearNameById($item->year_level)}}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">{{getEvidenceTypeNameById($item->evidence_type)}}</span>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div class="">
                                                @if(isset($item->evidence_of_year_level) && $item->evidence_of_year_level)
                                                <a href="{{ asset($item->evidence_of_year_level)}}" target="_blank">
                                                    <img src="{{ asset($item->evidence_of_year_level)}}" alt="" style="height:50px;width:50px">
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <button type="button" class="btn btn-success "
                                                onclick="changeVerificationStatus({{ $item->id }},'1')">Approved
                                            </button>
                                            <button type="button" class="btn btn-danger "
                                                onclick="changeVerificationStatus({{ $item->id }},'2')">Reject
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
    </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        function changeVerificationStatus(id, status) {
            let reasonData = '';
            let swalText = (status == 1 ? "you want to Approve  Verification" : "You want to Reject  Verification") + ' ?';
            Swal.fire({
                title: 'Are you sure?',
                text: swalText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (status == 2) {
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

        function sendData(id, status, reasonData) {
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.changeProfessionVerificationStatus') }}",
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

    </script>
@endsection
