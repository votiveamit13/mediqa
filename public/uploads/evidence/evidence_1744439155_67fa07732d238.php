@extends('nurse.layouts.layout')
@section('css')
<style>
  .live_chat_btn{
    margin-top: 10px;
  }
  .live_chat_btn a{
   
    width: 90px;
    padding: 0.375rem 0.2rem !important;
  }
  .user_btns a{
    margin-left: 10px;
  }

  .gt_touch a{
    color: #4f5e64;
  }
</style>
@endsection

@section('content')

<main class="main">
  <section class="section-box">
    <div class="breacrumb-cover bg-img-about">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h2 class="mb-10">Contact Us</h2>
            <p class="font-lg color-text-paragraph-2">Get the latest news, updates and tips</p>
          </div>
          <div class="col-lg-6 text-lg-end">
            <ul class="breadcrumbs mt-40">
              <li><a class="home-icon" href="{{ route('home_main')}}">Home</a></li>
              <li>Contact Us</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-box mt-70">
    <div class="container">
      <div class="row" style="text-align: center;">
        <div class="col-lg-12 mb-40 gt_touch">
          <h2 class="mt-5 mb-10">Get in touch</h2>
          <p class="font-md color-text-paragraph-2"><strong>Need support? Have a question? We’re here to help.</strong></p>
          <p class="font-md color-text-paragraph-2"><a href="mailto:info@mediqa.com.au">info@mediqa.com.au</a></p>
          <p class="font-md color-text-paragraph-2"><a href="tel:+61 426 925 259">+61 426 925 259</a></p>
          <div class="live_chat_btn">
            <h6><a href="https://api.whatsapp.com/send?phone=33626541818" target="_blank">Let's chat now</a></h6>
          </div>
        </div>
        <div class="col-lg-12 mb-40">
          <div class="user_btns">
            <a href="#" class="btn btn-default btn-shadow hover-up">Nurses & Midwives</a>
            <a href="#" class="btn btn-default btn-shadow hover-up">Healthcare Facilities</a>
            <a href="#" class="btn btn-default btn-shadow hover-up">Agencies</a>
            <a href="#" class="btn btn-default btn-shadow hover-up">Families & Individuals</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>



@endsection
@section('js')
<!-- <script>
  var swiper = new Swiper(".swiper-group-5", {
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  }); 

<script> -->
  <script>
  function addContactUs() {
    $.ajax({
    url: "{{ route('save-contact') }}",
    type: "POST",
    data: new FormData($('#contact-form')[0]),
    cache: false,
    contentType: false,
    processData: false,
    dataType: 'json',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function() {
        $('#signup_btn').prop('disabled', true);
        $('#signup_btn').text('Processing...');
    },
    success: function(res) {
        $('#signup_btn').prop('disabled', false);
        $('#signup_btn').text('Send message');
        $('#contact-form')[0].reset();
        if (res.status == '2') {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: res.message,
            }).then(function() {
                window.location.href = '{{ route("contact") }}';
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: res.message,
            })
        }
    },
    error: function(error) {
        $('#signup_btn').prop('disabled', false);
        $('#signup_btn').text('Send Now');

        var name = document.getElementById("name").value;
        var lastname = document.getElementById("lastnames").value;
        var email = document.getElementById("email").value;
        var message = document.getElementById("message").value;
        var phone_no = document.getElementById("phone_no").value;
        
        if (name == '') {
            $('#nameErr').text(error.responseJSON.errors.name);

        } else {
            $('#nameErr').text('');
        }
        if (lastname == '') {
            $('#lastnameErr').text(error.responseJSON.errors.lastname);

        } else {
            $('#lastnameErr').text('');
        }
        if (email == '') {
            $('#emailErr').text(error.responseJSON.errors.email);

        } else {
            $('#emailErr').text('');
        }
       
        if (message == '') {
            $('#messageErr').text(error.responseJSON.errors.message);

        } else {
            $('#messageErr').text('');
        }
        if (phone_no == '') {
            $('#phone_noErr').text(error.responseJSON.errors.phone_no);

        } else {
            $('#phone_noErr').text('');
        }
    }
});

            return false;
        }
</script> 
@endsection