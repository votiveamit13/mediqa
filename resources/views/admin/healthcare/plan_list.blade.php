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
    
    .modal-body.modal-body-custom {
        overflow-x: auto;
        overflow-y: auto;
        height: 500px;
    }


    </style>
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Plan Management</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted " href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Plan List</li>
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
        <div class="card-header pb-0 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title fw-semibold mb-0">Plan List</h5>
                </div>
                <div>
                    <a href="{{ route('admin.add_plans') }}" class="btn btn-primary text-nowrap">Add
                        Plans</a>
                </div>
            </div>
        </div>
        <div class="card w-100  overflow-hidden ">
            <div class="card-body p-3 px-md-4">

                <div class="table-responsive rounded-2 mb-4">
                    <table class="table border table-striped table-bordered text-nowrap" id="dataTable">
                        <thead class="text-dark fs-4">
                           <tr>
                                <th>Sno</th>
                                
                                <th>Plan Name</th>
                                
                                <th>Price</th>
                                <th>Employer Type</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($plan_list as $plan_data)
                            
                            <!-- User Row -->
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                
                                <td>{{ $plan_data->name }}</td>

                                <td>
                                    @php
                                        $price_data = DB::table("stripe_prices")->where("stripe_price_id",$plan_data->default_price_id)->first();
                                    @endphp
                                    ${{ $price_data->unit_amount/100 }}
                                    
                                    
                                </td>

                                <td>
                                    @php
                                    $employer_types = json_decode($plan_data->employer_types);

                                    $emp_name_arr = [];
                                    if(!empty($employer_types)){
                                        foreach($employer_types as $emp_type){
                                            $emp_name = DB::table("employer_type")->where("id",$emp_type)->first();
                                            $emp_name_arr[] = $emp_name->name;
                                        }
                                        echo implode(",",$emp_name_arr);
                                    }    
                                    @endphp
                                    
                                </td>

                                <td>
                                    @if($plan_data->active == 1)
                                        Active
                                    @else
                                        Deactive    
                                    @endif
                                    </td>

                                <td class="text-end">

                                    @php
                                        $product_id = $plan_data->plan_id;
                                    @endphp
                                    
                                    <a href="{{ route('admin.update_plans',['id'=>$product_id]) }}" class="btn btn-primary">
                                        Edit
                                    </a>
                                    <a href="#" class="btn btn-danger">
                                        Archive
                                    </a>
                                    
                                </td>
                            </tr>
                            @endforeach


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