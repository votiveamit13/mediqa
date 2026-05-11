@extends('user.layouts.app')

@section('title', 'Verification')


@section('content')
<style type="text/css">
    .bg-dark {
        background-color: #fff !important;
        box-shadow: 0px 1px 28px -18px grey;
    }
</style>
<div class="container-fluid p-0">
    <div class="row g-0">
        <div class="col-lg-6 m-auto mt-5 mb-5">
            <div class="bg-dark p-5">
                <div class="mb-3 text-center">
                    <h3 class="mb-3 text-white">Verification</h3>
                    <?php echo $message; ?>
                </div>
                @if($status==1)
                <div class="row g-3">
                    <div class="col-lg-12 text-center">
                        <a type="button" id="" class="tw-100 btn btn-primary" href="{{url('login')}}">Dashboard</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
