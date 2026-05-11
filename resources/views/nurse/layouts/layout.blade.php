<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="msapplication-TileColor" content="#0E0E0E">
    <meta name="template-color" content="#0E0E0E">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('nurse/assets/imgs/template/favicon.png')}}">
	<meta name="csrf-token" content="{{ csrf_token() }}">

     <link rel="stylesheet" type="text/css" href="{{ asset('nurse/assets/css/stylecd4e.css?version=4.1')}}">
     <link rel="stylesheet" type="text/css" href="{{ asset('nurse/assets/css/new_style.css')}}">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
	 <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
	 <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
    <script src="https://kit.fontawesome.com/107d2907de.js" crossorigin="anonymous"></script>
	 <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    @if(Auth::guard('nurse_middle')->check() || Auth::guard('healthcare_facilities')->check() || Auth::check())
    <!-- Pusher & Echo -->
    <script src="https://js.pusher.com/8.4/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.min.js"></script>
    <script>
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ config("broadcasting.connections.pusher.key") }}',
            cluster: '{{ config("broadcasting.connections.pusher.options.cluster", "mt1") }}',
            forceTLS: true,
            encrypted: true,
            authEndpoint: '{{ url("/broadcasting/auth") }}',
            auth: {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                }
            },
            disableStats: true,
            enabledTransports: ['ws', 'wss'],
        });
        console.log('✅ Echo initialized in head');
    </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>


     <title>{{ env('APP_NAME') }}</title>
     <style>
        span.d-flex.align-items-center.justify-content-center {
            font-size: 13px;
            gap: 15px;
        }

        .floating-chat-wrapper {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9999;
        }

        .floating-chat-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #000;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 14px 20px;
            font-size: 15px;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.18);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .floating-chat-btn:hover {
            transform: translateY(-3px);
            background: #111;
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.25);
        }

        .floating-chat-btn svg {
            width: 22px;
            height: 22px;
        }

        @media (max-width: 768px) {
            .floating-chat-wrapper {
                bottom: 20px;
                right: 20px;
            }

            .floating-chat-btn {
                padding: 12px 16px;
                font-size: 14px;
            }

            .floating-chat-btn span {
                display: none;
            }

            .floating-chat-btn {
                border-radius: 50%;
                width: 56px;
                height: 56px;
                justify-content: center;
            }
        }
     </style>
  </head>

<body class="home">
    @php
      $user = Auth::guard("healthcare_facilities")->user();

      $nurse_user = Auth::guard("nurse_middle")->user();

    @endphp
    @if($user && $user->role == 2 && request()->routeIs('medical-facilities.notification'))
    <div class="floating-chat-wrapper">
      <a href="{{ route('healthcare.chat.index') }}" class="floating-chat-btn" id="openChatBtn">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M8 10H16M8 14H13M21 12C21 16.4183 16.9706 20 12 20C10.8562 20 9.76178 19.8078 8.75862 19.4552L4 20L4.72295 15.7824C4.26263 14.6475 4 13.3604 4 12C4 7.58172 8.02944 4 13 4C17.9706 4 21 7.58172 21 12Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <span>Chat</span>
      </a>
    </div>
    @endif

    @if($nurse_user && $nurse_user->role == 1 && !request()->routeIs('nurse.chat.index') && !request()->routeIs('nurse.chat.show'))
    @php
        $job_apply_data = DB::table("nurse_applications")->where("nurse_id",$nurse_user->id)->get();
    @endphp
    @if(count($job_apply_data) > 0)
    <div class="floating-chat-wrapper">
      <a href="{{ route('nurse.chat.index')}}" class="floating-chat-btn" id="openChatBtn">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M8 10H16M8 14H13M21 12C21 16.4183 16.9706 20 12 20C10.8562 20 9.76178 19.8078 8.75862 19.4552L4 20L4.72295 15.7824C4.26263 14.6475 4 13.3604 4 12C4 7.58172 8.02944 4 13 4C17.9706 4 21 7.58172 21 12Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <span>Chat</span>
      </a>
    </div>
    @endif

    @endif
    <div class="page-wrapper">
            @include('nurse.layouts.header')
             @yield('css')
            @include('nurse.layouts.style')
            @yield('content')

        @include('nurse.layouts.footer')
        @include('nurse.layouts.js')
        <!-- Bootstrap-select initialization -->
        <script>
          $(document).ready(function() {
            $('.selectpicker').selectpicker();
          });
        </script>

        @yield('js')
      </body>

</html>


