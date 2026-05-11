@extends('admin.layouts.layout')
@section('content')
<style>
    .modal1 {
        display: none;
        /* Hidden by default */
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
    .status-badge.submitted {
        color: white;
        background: #6b7280;
    }
    .status-badge.under_review {
        color: white;
        background: #facc15;
    }
    .status-badge.shortlisted {
        color: white;
        background: #f59e0b;
    }
    .status-badge.interview_scheduled {
        color: white;
        background: #3b82f6;
    }
    .status-badge.interview_completed {
        color: white;
        background: #60a5fa;
    }
    .status-badge.conditional_offer {
        color: white;
        background: #3b82f6;
    }
    .status-badge.offer {
        color: white;
        background: #22c55e;
    }
    .status-badge.hired {
        color: white;
        background: #8b5cf6;
    }
    .status-badge.withdrawn {
        color: white;
        background: #374151;
    }
    .status-badge.rejected,
    .status-badge.declined {
        color: white;
        background: #ef4444;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
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
                    <h4 class="fw-semibold mb-8">Nurse Application List</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted "
                                    href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Nurse Application List</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('admin/dist/images/breadcrumb/ChatBc.png') }}" alt="" class="img-fluid"
                            style="height: 125px;">
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
                                <h6 class="fs-4 fw-semibold mb-0"> Job Title</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">HealthCare Name</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Date Applied</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Applied Status</h6>
                            </th>


                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @if ($nurse_application)
                        @foreach ($nurse_application as $key => $item)
                        <tr>
                            <td>{{ $i }}</td>

                            <td>
                                <div class="">
                                    <span class="mb-0 fw-normal fs-3">{{ ucwords($item->job_title) }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    <span class="mb-0 fw-normal fs-3">{{ ucwords($item->health_care->name) }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    <span class="mb-0 fw-normal fs-3"> {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</span>
                                </div>
                            </td>
                            <td>
                            {{-- <button class="btn w-100 text-white {{ $status['class'] }}">
                                {{ $status['label'] }}
                            </button>    
                                                  --}}

                            <button class="btn w-100 status-badge {{ $item->status_key }} active-status-modal" data-id="{{ $item->id }}" disabled >
                                {{ $item->status_label }}
                            </button>
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


@endsection
@section('js')

@endsection