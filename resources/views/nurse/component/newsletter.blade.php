<section class="section-box mt-0 mb-20">
    <div class="container">
      <div class="box-newsletter">
        <div class="row">
          <div class="col-xl-3 col-12 text-center d-none d-xl-block"><img src="{{ asset('nurse/assets/imgs/template/newsletter-left.png')}}" alt="joxBox"></div>
          <div class="col-lg-12 col-xl-6 col-12">
            <h2 class="text-md-newsletter text-center">Get the Latest from Mediqa</h2>
            <div class="box-form-newsletter mt-40">
              <form class="form-newsletter" id="addnewsletter"  onsubmit="return addnewsletter()">
                @csrf
                <input class="input-newsletter" type="email" value=""id="emailNewsletter" name="emailNewsletter"placeholder="Enter your email here">
               
                <button type="submit" class="btn btn-default font-heading icon-send-letter" id="signup_btn_btn">Subscribe</button>
                   
                </form>
            </div>
            <span id="emailNewsletterErr" class="text-danger"></span>
          </div>
          <div class="col-xl-3 col-12 text-center d-none d-xl-block"><img src="{{ asset('nurse/assets/imgs/template/newsletter-right.png')}}" alt="joxBox"></div>
        </div>
      </div>
    </div>
  </section>


<script type="text/javascript">
        function addnewsletter() {
            $.ajax({
                url: "{{ route('nurse.addnewsletter') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData($('#addnewsletter')[0]),
                dataType: 'json',
                beforeSend: function() {
                    $('#signup_btn_btn').prop('disabled', true);
                    $('#signup_btn_btn').text('Subscribing....');
                    $('#emailNewsletterErr').text('');
                },
                success: function(res) {
                    $('#signup_btn_btn').prop('disabled', false);
                    $('#signup_btn_btn').text('Subscribe ');
                    if (res.status == '2') {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                        }).then(function() {
                           
                        });
                        $('#addnewsletter')[0].reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message,
                        })
                    }
                },
                error: function(error) {
                    $('#signup_btn_btn').prop('disabled', false);
                    $('#signup_btn_btn').text('Subscribe');
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.emailNewsletter) {
                            $('#emailNewsletterErr').text(error.responseJSON.errors.emailNewsletter[0]);
                        } else {
                            $('#emailNewsletterErr').text('');
                        }
                        
                    }
                }
            });
            return false;
        }
    
    </script>