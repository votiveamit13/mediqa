@extends('admin.layouts.layout')
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8"> Content Management</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted "
                                        href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Contactus List</li>
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
            <div class="card-header pb-0 p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title fw-semibold mb-0">Contactus List</h5>
                    </div>
                    
                </div>
            </div>
            <div class="card-body p-3 px-md-4">

                <div class="table-responsive rounded-2 mb-4">
                    <table class="table" id="dataTable">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Sn.</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">User Name</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Email</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Phone No.</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Message</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Message Date</h6>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1 ; @endphp
                          
                                @forelse($contactData as $key => $item)
                                
                                    <tr>
                                        <td>{{ $i }}</td>
                                       
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">{{ $item->name }} {{ $item->lastname }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">{{ $item->email }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                              $phoneCode = DB::table('country')->where('id', $item->phone_code_id)->get()->value('phonecode');
                                            @endphp
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">+{{isset($phoneCode) ? $phoneCode : ''}} {{ $item->phone_no }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">{{ $item->message }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">{{ $item->created_at->format('d-m-y') }}</span>
                                            </div>
                                        </td>
                                        @php $i++ @endphp
                                    </tr>
                               
                            @empty
                                {{ 'No Data Found' }}
                        @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
@endsection
