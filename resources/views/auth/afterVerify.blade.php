@if($do==1)<h1>You Email has been verified You can <a href="{{ url('admin')}} ">Login </a> </h1>@else
        <h1>{{ $msg }} <a href="{{ url('')}} ">Home </a> </h1>
@endif