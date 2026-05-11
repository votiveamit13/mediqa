     @if (!Auth::guard('nurse_middle')->check() && !Auth::guard('healthcare_facilities')->check()) 
    <footer class="footer mt-50">

      <div class="container">


            <div class="row footer_hide">

          <div class="col-md-3 col-sm-12">

            <a href='index.php'><img alt="jobBox" src="{{ asset(env('LOGO_PATH'))}}" style="width:100px;"></a>

            <div class="mt-20 mb-20 font-sm">Mediqa connects nurses, midwives, healthcare facilities, agencies, and families with seamless, efficient hiring and care solutions.</div>

          </div>

          <div class="col-md-2 col-xs-6"></div>

          <div class="col-md-2 col-xs-6">

            <h6 class="mb-20">Discover</h6>

            <ul class="menu-footer">

              <li><a  href='{{ route("about") }}''>About Us</a></li>

              <li><a  href='{{ route("contact") }}''>Contact Us</a></li>

              <li><a  href='{{ route("privacy") }}'>Privacy Policy</a></li>

              <li><a  href='{{ route("term-and-condition") }}'' >Terms & Conditions</a></li>

            </ul>

          </div>

          <div class="col-md-2 col-xs-6">

            <h6 class="mb-20">Explore</h6>

            <ul class="menu-footer">

              <li><a href="{{ route('nurse.home') }}">Find the best Jobs</a></li>

              <li><a href='{{ route("medical-facilities.medical_facilities_home_main") }}'>Hire the best Talent</a></li>

              <li><a  href='{{ route("agencies.agencies_home_main") }}'>Agencies Workforce Hub</a></li>

              <li><a  href='{{ route("nurseCareHome") }}'>In-Home Private Nursing</a></li>

            </ul>

          </div>

          <div class="col-md-3 col-sm-12">

            <h6 class="mb-20">Contact</h6>



            <ul class="mb-20">

              <li class="mb-10">

                <div class="d-flex gap-3 align-items-center">

                  <svg width="20" height="20" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">

                  <path d="M19.8862 15.154L29.9999 21.5477V8.49023L19.8862 15.154Z" fill="#000"/>

                  <path d="M0 8.49023V21.5477L10.1138 15.154L0 8.49023Z" fill="#000000"/>

                  <path d="M28.1234 4.6875H1.87344C0.937813 4.6875 0.195312 5.385 0.0546875 6.28313L14.9984 16.1287L29.9422 6.28313C29.8016 5.385 29.0591 4.6875 28.1234 4.6875Z" fill="#000000"/>

                  <path d="M18.1673 16.2861L15.5142 18.0336C15.3567 18.1367 15.1786 18.1873 14.9986 18.1873C14.8186 18.1873 14.6405 18.1367 14.483 18.0336L11.8298 16.2842L0.0585938 23.7298C0.202969 24.6204 0.941719 25.3123 1.87359 25.3123H28.1236C29.0555 25.3123 29.7942 24.6204 29.9386 23.7298L18.1673 16.2861Z" fill="#000"/>

                  </svg>



                  <p class="m-0">info@mediqa.com.au</p>

                </div>

              </li>



              <li >

                <div class="d-flex gap-3 align-items-center">

                  <img src="{{ asset('nurse/assets/imgs/template/icons/call.svg')}}" style="height: 20px;">

                  <p class="m-0">+61(0) 426 925 259</p>

                </div>

              </li>

              

            </ul>

              

            <div class="footer-social">

              <a class="icon-socials icon-facebook" href="https://www.facebook.com/profile.php?id=61580019696973 "></a>

              <a class="icon-socials icon-twitter" href="https://x.com/MediQaPlatform"></a>

              <a class="icon-socials icon-instagram" href="https://www.instagram.com/mediqaplatform/"></a>

              <a class="icon-socials icon-linkedin" href="https://www.linkedin.com/company/mediqaplatform/"></a>

              <a class="icon-socials icon-youtube" href="https://www.youtube.com/@MediQaPlatform"></a>

            </div>

          </div>

        </div>

      

        <div class="footer-bottom mt-50">

          <div class="row footer_profile_cls">

            <div class="col-md-6 cpy_profile"><span class="font-xs color-text-paragraph">Copyright &copy; {{ date('Y') }}. Mediqa all right reserved</span></div>

            <div class="col-md-6 text-md-end text-start privacy_option">

              <div class="footer-social"><a class="font-xs color-text-paragraph"  href='{{ route("privacy") }}'>Privacy Policy</a><a class="font-xs color-text-paragraph mr-30 ml-30"  href='{{ route("term-and-condition") }}'>Terms &amp; Conditions</a></div>

            </div>

          </div>

        </div>

      </div>

    </footer> @else
    <?php
      $url = $_SERVER['REQUEST_URI'];
    if(strpos($url, "my-profile") == false){
     ?>
    <footer class="footer pt-0">

      <div class="container">


      

        <div class="footer-bottom ">

          <div class="row footer_profile_cls">

            <div class="col-md-6 cpy_profile"><span class="font-xs color-text-paragraph">Copyright &copy; {{ date('Y') }}. Mediqa all right reserved</span></div>

            <div class="col-md-6 text-md-end text-start privacy_option">

              <div class="footer-social"><a class="font-xs color-text-paragraph" href="#">Privacy Policy</a><a class="font-xs color-text-paragraph mr-30 ml-30" href="#">Terms &amp; Conditions</a></div>

            </div>

          </div>

        </div>

      </div>

    </footer>
    <?php
      }
    ?>
    @endif

    <script src="{{ asset('nurse/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>

    <script src="{{ asset('nurse/assets/js/vendor/jquery-3.6.0.min.js')}}"></script>

    <script src="{{ asset('nurse/assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>

    <script src="{{ asset('nurse/assets/js/vendor/bootstrap.bundle.min.js')}}"></script>

    <script src="{{ asset('nurse/assets/js/plugins/waypoints.js')}}"></script>

    <script src="{{ asset('nurse/assets/js/plugins/wow.js')}}"></script>

    <script src="{{ asset('nurse/assets/js/plugins/magnific-popup.js')}}"></script>

    <script src="{{ asset('nurse/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>

    <script src="{{ asset('nurse/assets/js/plugins/select2.min.js')}}"></script>

    <script src="{{ asset('nurse/assets/js/plugins/isotope.js')}}"></script>

    <script src="{{ asset('nurse/assets/js/plugins/scrollup.js')}}"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="{{ asset('nurse/assets/js/plugins/swiper-bundle.min.js')}}"></script>

    <script src="{{ asset('nurse/assets/js/plugins/counterup.js')}}"></script>

     <script src="{{ asset('nurse/assets/js/noUISlider.js')}}"></script>

    <script src="{{ asset('nurse/assets/js/slider.js')}}"></script>

    <script src="{{ asset('nurse/assets/js/main8c94.js?v=4.1')}}"></script>
	<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap-select JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
<script>
  $(document).ready(function() {
    $('.selectpicker').selectpicker();
  });
</script>





    <script> $(document).ready(function() { 

      // Get the current page URL 

      var currentUrl = window.location.href;

     // Find the navigation link that matches the current URL

      $('.menu-link').each(function() { 

        if (currentUrl.includes($(this).attr('href'))){

         $(this).addClass('active');

     // Add 'active' class to the matched item 

    } 

  }); 

    });

  </script>


<script type="text/javascript">
      function resendEmailLink() {
        $.ajax({
          url: "{{route('nurse.resent-verification-link')}}",
          type: "get",
          dataType: 'json',
          beforeSend: function() {
            $('#email_link').prop('disabled', true);
            $('#email_link').text('Process');
          },
          success: function(data) {
            $('#email_link').prop('disabled', false);
            $('#email_link').text('Click here');
            if (data.status == 1) {
              Swal.fire(
                'Success',
                'Email verification link has been sent!!',
                'success'
              )
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
              })
            }
          }
        });
        return false;
      }
    </script>

  </body>



</html>