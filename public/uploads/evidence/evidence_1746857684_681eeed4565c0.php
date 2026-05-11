@extends('admin.layouts.layout')
@section('content')
<style>
    .modal1 {
        display: none; /* Hidden by default */
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
    }

    .modal-content1 {
        background-color: #fff;
        margin: 10% auto;
        padding: 30px;
        border-radius: 10px;
        width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        position: relative;
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .close {
        color: #999;
        font-size: 28px;
        position: absolute;
        right: 15px;
        top: 10px;
        cursor: pointer;
    }

    .close:hover {
        color: #000;
    }

    h2 {
        margin-top: 0;
        font-size: 22px;
        color: #333;
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .block_reason {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
    }

    .reason_submit {
        width: 100%;
        padding: 12px;
        background-color: #000000;
        border: none;
        color: white;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .reason_submit:hover {
        background-color: #000000;
    }


    </style>
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Approved Nurse List</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted " href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Approved Nurse List</li>
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
                                    <h6 class="fs-4 fw-semibold mb-0"> Full Name</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Profession</h6>
                                </th>
                            
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Practitioner Type</h6>
                            
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Phone</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Email</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Date</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0 text-end">Action</h6>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1 @endphp
                            @if ($activeNurseUsers)
                                @foreach ($activeNurseUsers as $key => $item)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">{{  ucwords($item->name) }}</span>
                                            </div>
                                        </td>
                                       <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">- - - </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3"> - - -</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                @if($item->phone)
                                                <span class="mb-0 fw-normal fs-3">+{{ isset($item->country_code) ? $item->country_code : ''}} {{ $item->phone }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">{{ $item->email }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                        
                                                @if ($item->status == '2')
                                                <span class="mb-0 fw-normal fs-3">Block</span>
                                                @else
                                                <span class="mb-0 fw-normal fs-3">Unblock</span>
                                                @endif

            
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1">
                                            <a href="{{ route('admin.view-profile',['id' => $item->id]) }}"
                                                class="btn btn-primary"
                                                     data-bs-toggle="tooltip" data-bs-trigger="hover" title="View">
                                                     View
                                            </a>
                                        @if ($item->status == '2')
                                        <button type="button" class="btn btn-success "
                                        onclick="changeStatusBlockUnblock({{ $item->id }},'1','')">Unblock</button>
                                        @else
                                        <button type="button" class="btn btn-danger "
                                            onclick="reasonModelOpen({{ $item->id }},'2')">Block
                                        </button>
                                        @endif
                                        <button type="button" class="btn btn-danger "
                                                onclick="changeStatus({{ $item->id }},'0')">Delete
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
        <div class="modal1" id="myModal">
            <div class="modal-content1">
                <span class="close" id="closeModal">&times;</span>
                <h2>Reason for Block</h2>
                <form method="post">
                    @csrf <!-- for Laravel -->
                    <div class="form-group">
                        <label for="block_reason">Reason:</label>
                        <textarea name="block_reason" id="block_reason" class="block_reason" placeholder="Enter reason" required></textarea>
                        {{-- <input type="text" name="block_reason" id="block_reason" class="block_reason" placeholder="Enter reason" required> --}}
                    </div>
                    <div class="form-group">
                        <input type="button" value="Submit" name="reason_submit" class="reason_submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        function closeModel(id){
            $(".modal-"+id).hide();
        }

        const modal = document.getElementsByClassName("modal1");
        window.onclick = function (event) {
            console.log("event",modal);
            if (event.target == modal) {
                
                $(".modal1").hide();
            }
        }

        function reasonModelOpen(id, status){
            Swal.fire({
                title: 'Provide a reason',
                input: 'text',
                inputLabel: 'Reason for Block',
                inputPlaceholder: 'Enter your reason here...',
                inputValidator: (value) => {
                    if (!value) {
                        return 'You must provide a reason for Block Nurse.';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    reasonData = result.value;
                    changeStatusBlockUnblock(id, status,reasonData);
                }
            });
            // $(".modal1").addClass("modal-"+id);
            // $(".modal-"+id).show();
            // $(".modal-"+id+" .close").attr("onclick","closeModel("+id+")");
            // $(".reason_submit").attr("onclick","changeStatusBlockUnblock("+id+","+status+")");
        }

        function changeStatusBlockUnblock(id, status,reasonData) {

            var reason_val = $(".block_reason").val();

            let title = 'Are you sure?';
            let text = status === '1' ? 'Do you want to unblock user?' : 'Do you want to block user?';
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin.change-status-block-unblock') }}",
                        data: {
                            id: id,
                            status: status,
                            reason_val:reasonData,
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
        function changeStatus(id, status) {
            let reasonData = '';
            let swalText = (status == 2 ? "you want to Approve the Nurse" : "You want to Delete The Nurse Profile") + ' ?';
            Swal.fire({
                title: 'Are you sure?',
                text: swalText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    sendData(id, status, reasonData);
                }
            });
        }
        function sendData(id, status, reasonData) {
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.change-status-delete') }}",
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
