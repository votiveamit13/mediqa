@extends('nurse.layouts.layout')

@section('content')
<main class="main">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height:600px;">
            <div class="col-md-12">
                <div class="box-newsletter">
                    <div class="text-center">

                        <h2 class="mb-4 text-white">MediQa</h2>

                        {{-- Message --}}
                        <p class="text-white font-md mb-4">
                            <i class="bi bi-exclamation-triangle-fill text-warning"></i>
                            {!! $message !!}
                        </p>

                        <p class="text-white w-75 mx-auto" style="opacity:0.8">
                            This verification link is no longer valid.  
                            If your email is already verified, you can log in directly.
                        </p>

                        <div class="mt-4">
                            <a href="{{ route('nurse.login') }}" class="btn btn-border-brand-2">
                                Go to Login
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
